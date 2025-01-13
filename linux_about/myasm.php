<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<center><font size=5 color=#ff0000>linux AT&T asm 个人总结</font></center><br><br>
<font size=3 color=red>一、汇编调用C函数问题</font>
<pre>
终于弄明白了在汇编代码中使用C库的做法，一个printf函数引出了不少的问题
对于这种调用法我不想过于评论是否值得使用，毕竟使用汇编标准的系统调用才应是正宗的写法。
具体做法很简单，用C写成的用于被调用的函数直接编译为模块文件，用汇编写成的主函数也使用
as单独编译为模块文件，然后使用链接程序ld进行链接。但是起初错误不断，一直没找到合理的
解决方法，错误的出现一般为两种情况：
1、链接通不过，提示有未定义的符号printf。看到了这个提示，我的反应就是要包含进相关的模块
文件。
2、添加-lc后可顺利的链接，也生成了可执行文件，但是该文件不能运行，提示找不到该文件。
最后发现，在链接时还需加入 参数：<font color=red>-dynamic-linker（-I） /lib/ld-linux.so.2</font>才能正确生成。
注意：ld的 -I = -dynamic-linker 指定的是链接库文件，这与gcc的-I参数很容易混淆，gcc的I
参数后面是指定的目录，包含头文件的目录。
代码事例如下：
-----------ka09.c-----------------
#include"/workarea/cprogram/include/clsscr.h"

int aac(int a,int b)
{
	int c;
	c=a+b;
	printf("sum is:%d\n",c);
	return c;
}
-----------ka09.s------------------
.section .bss
#.comm printf,10
.section .data
msg:
.space 10,0
.section .text
.global _start
_start:
	movl $1,%eax
	pushl %eax
	movl $2,%eax
	pushl %eax
	call  aac
	movl  $msg,%ecx
	addb $0x30,%al
	movb %al,(%ecx)
	movb $'\n,%al
	movb %al,1(%ecx)
	movl $2,%edx
	movl $1,%ebx
	movl $4,%eax
	int  $0x80
	popl %ebx
	popl %ebx
	movl $0,%ebx
	movl $1,%eax
	int  $0x80
	ret
------------makefile------------------
ka09:kac.o ka09.o
	ld -o ka09 kac.o ka09.o -I /lib/ld-linux.so.2 -lc
ka09.o:ka09.s
	as -o ka09.o ka09.s
kac.o:ka09.c
	gcc -c -o kac.o ka09.c

</pre>
<hr width=100%>
<font size=3 color=red>二、取得程序参数的问题</font>
<pre>
原以为参数的获得应该像main函数那样，在堆栈中存放argc,argv，实际测试却非如此，参数的存放并非通过argv指定的
而是形如普通函数的参数一样，从右至左依次压入堆栈的，最后压入的是参数个数，也就是argc。另外作为一个加载到
内存中开始运行的程序，她的ebp竟然未被赋值，不像在进程中调用某个C函数那样，先保存原来的ebp，再将esp赋予ebp
而且他好像也不需要堆栈的平衡即可ret返回。下面是具体测试的例子：
/*一个完整的程序参数获取*/
.section .data
msg1:
	.string "本次运行共有"
val1:
	.byte 0
	.string "个参数:\n"
len1=.-msg1
msg:
	.space 1000,0
len:
	.int 0
.section .text
.global _start
_start:
	movl %esp,%ebp
	movl (%ebp),%eax
	cmpl $5,%eax
	ja	 1f
	addb $0x30,%al
	movb %al,val1
	movl $msg1,%ecx
	movl $len1,%edx
	movl $1,%ebx
	movl $4,%eax
	int  $0x80
	popl %ecx
	movl $msg,%edi
	xorl %edx,%edx
2:
	popl %esi
3:
	lodsb
	test %al,%al
	jz  4f
	stosb
	incl %edx
	jmp 3b
4:
	movb $'\t,%al
	stosb
	inc  %edx
	loop 2b
	movb $'\n,%al
	stosb
	inc  %edx
	movl $msg,%ecx
	movl $1,%ebx
	movl $4,%eax
	int  $0x80
1:
	movl $0,%ebx
	movl $1,%eax
	int  $0x80
	ret
</pre>
<hr width=100%>
<font size=3 color=red>三、汇编语言编写动态链接库的问题</font>
<pre>
使用汇编源代码编译后生成的编译文件在进行链接生成动态链接库时总是提示符号未定义，原来
要想将函数名导出还需要在源文件中进行一步：将函数名定义为函数：.type func1,@function
这类似与在win下编写def文件一样。示例如下：
-----------asm file----------------
.section .bss
buf1:
	.space 1000
buf2:
	.space 1000
.section .data
.section .text
.type m_pnt,@function
.globl m_pnt
m_pnt:
	pushl	%ebp
	movl	%esp,%ebp
	movl	8(%ebp),%ecx
	movl	12(%ebp),%edx
	movl	$1,%ebx
	movl	$4,%eax
	int		$0x80
	leave
	ret
--------------makefile---------------
libasm01.so:a01.o
	ld -shared -o libasm01.so a01.o
a01.o:a01.s
	as -o a01.o a01.s
-------------测试文件----------------
#include"clsscr.h"
int main(int argc,char** argv)
{
	char ch[]="hello world\n";
	int i=strlen(ch);
	m_pnt(ch,i);
	return 0;
}
------------测试文件makefile---------
c01:c01.c
	gcc -o c10 c01.c -lasm01 -L/workarea/cprogram/mlib/ -I/workarea/cprogram/include/

</pre>
<hr width=100%><font size=3 color=red>四、内联汇编的两种写法</font>
<br><br>
<table width=100% border=1>
<tr><td width=50% align=center><font color=blue>方式一</font></td><td width=50% align=center><font color=blue>方式二</font></td></tr>
<tr><td width=50%>
<pre>
#include"clsscr.h"
int main(int argc,char **argv)
{
	int i,j,k;
	i=3;j=5;k=0;
	__asm__ __volatile__(
			"movl %1,%%eax\n\t"
			"movl %2,%%ebx\n\t"
			"addl %%ebx,%%eax\n\t"
			"movl %%eax,%0"
			:"=r"(k)
			:"a"(i),"b"(j)
			);
	printf("k= %d\n",k);
	return 0;
}</pre></td><td width=50%>
<pre>
#include"clsscr.h"
int main(int argc,char **argv)
{
	int i,j,k;
	i=3;j=5;k=0;
	__asm__ __volatile__
	("movl %1,%%eax;movl %2,%%ebx;addl %%ebx,%%eax;movl %%eax,%0;"
			:"=r"(k)
			:"a"(i),"b"(j)
	);
	printf("k= %d\n",k);
	return 0;
}



</pre></td></tr></table>

<hr width=100%><font size=3 color=red>五、汇编指令说明</font>
<br><br>
<pre>
31. CWD

    字扩展指令 CWD(Convert Word to Double Word) 

    格式: CWD

    功能: 将字扩展为双字长,即把AX寄存器的符号位扩展到DX中.

       说明:

    1. 两个字或字节相除时,先用本指令形成一个双字长的的被除数.

    2. 本指令不影响标志位.

    3. 示例: 在B1、B2、B3字节类型变量中,分别存有8们带符号数a、b、c,实现(a*b+c)/a运算。

    MOV AX, FFFF

    MOV BX, FF

    CWD                ;扩展符号位到DX

    IDIV BX

 

32. AAD

      详情请查看: BCD码指令AAA DAA AAS DAS AAM AAD

33. AND

    逻辑与运算指令 AND

    格式: AND OPRD1,OPRD2

    功能: 对两个操作数实现按位逻辑与运算,结果送至目的操作数.本指令可以进行字节或字的‘与’运算,

          OPRD1&lt;--OPRD1 and OPRD2.

 

      说明:

    1. 目的操作数OPRD1为任一通用寄存器或存储器操作数.源操作数OPRD2为立即数,任一通用寄存器或存储器操作数.

    2. 示例:

             AND AL,0FH       ;(AL)&lt;--(AL) AND 0FH
             AND AX,BX        ;(AX)&lt;--(AX) AND (BX)
             AND DX,BUFFER[SI+BX]
             AND BETA[BX],00FFH
    注意: 两数相与，有一个数假则值为假

34. OR

    逻辑或指令 OR

    格式: OR OPRD1,OPRD2

    功能: OR指令完成对两个操作数按位的‘或’运算,结果送至目的操作数中,本指令可以进行字节或字的‘或’运算.

      说明:

    1. 其中OPRD1,OPRD2含义与AND指令相同,对标志位的影响也与AND指令相同.

    2. 两数相或,有一个数为真则值为真.

35. NOT

    逻辑非运算指令 NOT

    格式: NOT OPRD

    功能: 完成对操作数按位求反运算(即0变1,1变0),结果关回原操作数.

说明:

    1. 其中OPRD可为任一通用寄存器或存储器操作数.

    2. 本指梳令可以进行字或字节‘非’运算.

    3. 本指令不影响标志位.

    SAMPLE:

    MOV AX, 1

    MOV WORD PTR [0], AX

    NOT WORD PTR [0]

    NOT AX

 

36. XOR

    逻辑异或运算指令 XOR

    格式: XOR OPRD1,OPRD2

    功能: 实现两个操作数按位‘异或’运算,结果送至目的操作数中.
     
          OPRD1&lt;--OPRD1 XOR OPRD2

说明:

    1. 其在OPRD1、OPRD2的含义与AND指令相同,对标志位的影响与与AND指令相同.

    2. 相异为真,相同为假.

    SAMPLE

               XOR AX, AX ; 清空ax

37. TEST

    测试指令 TEST

    格式: TEST OPRD1,OPRD2

    功能: 其中OPRD1、OPRD2的含义同AND指令一样,也是对两个操作数进行按位的'与'运算,唯一不同之处是不将'AND“的结果送到OPRD1中,


   说明:

    TEST与AND指令的关系,有点类似于CMP与SUB指令之间的关系.

    常用法是: TEST cx, cx ; 测试cx是否等于0

             JNZ xxx

38. SHL

    逻辑左移指令 SHL(Shift logical left)

    格式: SHL OPRD1,COUNT

    功能: 对给定的目的操作数左移COUNT次,每次移位时最高位移入标志位CF中,最低位补零.

      说明:

    1. 其中OPRD1为目的操作数,可以是通用寄存器或存储器操作数.

    2. COUNT代表移位的次数(或位数).移位一次,COUNT=1;移位多于1次时,COUNT=(CL),(CL)中为移位的次数.
     
    3. 例如:

             SHL AL,1
             SHL CX,1 
             SHL ALFA[DI] 或者:
             MOV CL,3
             SHL DX,CL
             SHL ALFA[DI],CL

     

39. SHR

    逻辑右移指令 SHR

    格式: SHR OPRD1,COUNT

    功能: 本指令实现由COUNT决定次数的逻辑右移操作,每次移位时,最高位补0,最低位移至标志位CF中.

      说明:

    1. 其中OPRD1为目的操作数,可以是通用寄存器或存储器操作数.

    2. COUNT代表移位的次数(或位数).移位一次,COUNT=1;移位多于1次时,COUNT=(CL),(CL)中为移位的次数.

    3. 影响标志位OF,PF,SF,ZF,CF.

40. SAL

    算术左移指令 SAL(Shift Arithmetic Left)

    格式: SAL OPRD1,COUNT

    功能: 其中OPRD1,COUNT与指令SHL相同.本指令与SHL的功能也完全相同,这是因为逻辑左移指令与算术左移指令所要完成的操作是一样的.

       说明:

    1. 其中OPRD1为目的操作数,可以是通用寄存器或存储器操作数.

    2. COUNT代表移位的次数(或位数).移位一次,COUNT=1;移位多于1次时,COUNT=(CL),(CL)中为移位的次数.

    Note: 在debug模式下 该指令无用, 我测试过在asm中用这条指令会被替换成SHL

41. SAR

    算术右移指令 SAR
     
    格式: SAR OPRD1,COUNT

    功能: 本指令通常用于对带符号数减半的运算中,因而在每次右移时,保持最高位(符号位)不变,最低位右移至CF中.

说明:

    1. 其中OPRD1为目的操作数,可以是通用寄存器或存储器操作数.

    2. COUNT代表移位的次数(或位数).移位一次,COUNT=1;移位多于1次时,COUNT=(CL),(CL)中为移位的次数.

    SAMPLE:

         MOV AX, 10 ; AX = 10h

         SAR AX, 1    ; AX = 08h

         SAR AX, 1    ; AX = 04h

42. ROL

    循环移位指令
     
    格式:   

            ROL OPRD1,COUNT ;不含进位标志位CF在循环中的左循环移位指令.

            ROR OPRD1,COUNT ;不含进位示志位CF在循环中的右循环移位指令.

            RCL OPRD1,COUNT ;带进位的左循环移位指令.

            RCR OPRD1,COUNT ;带进位的右循环移位指令.

说明:

    1. 本指令组只影响标志CF、OF.OF由移入CF的内容决定,OF取决于移位一次后符号位是否改变,如改变,则OF=1.

    2. 由于是循环移位,所以对字节移位8次; 对字移位16次,就可恢复为原操作数.由于带CF的循环移位,可以将CF的内容移入,
       所以可以利用它实现多字节的循环.

43. ROR

    循环移位指令
     
    格式:
         ROL OPRD1,COUNT ;不含进位标志位CF在循环中的左循环移位指令.
         ROR OPRD1,COUNT ;不含进位示志位CF在循环中的右循环移位指令.
         RCL OPRD1,COUNT ;带进位的左循环移位指令.
         RCR OPRD1,COUNT ;带进位的右循环移位指令.

    说明:

    1. 本指令组只影响标志CF、OF.OF由移入CF的内容决定,OF取决于移位一次后符号位是否改变,如改变,则OF=1.

    2. 由于循环移位,所以对字节移位8次; 对字移位16次,可恢复为原操作数.

    Note: 如果位移大于1的话,使用cl存放位移

44. RCL

循环移位指令
 
格式:

      ROL OPRD1,COUNT ;不含进位标志位CF在循环中的左循环移位指令.
      ROR OPRD1,COUNT ;不含进位示志位CF在循环中的右循环移位指令.
      RCL OPRD1,COUNT ;带进位的左循环移位指令.
      RCR OPRD1,COUNT ;带进位的右循环移位指令.

说明:

    1. 本指令组只影响标志CF、OF.OF由移入CF的内容决定,OF取决于移位一次后符号位是否改变,如改变,则OF=1.

    2. 由于是循环移位,所以对字节移位8次; 对字移位16次,就可恢复为原操作数.由于带CF的循环移位,可以将CF的内容移入,

       所以可以利用它实现多字节的循环.

45. RCR

循环移位指令
 
格式:

      ROL OPRD1,COUNT ;不含进位标志位CF在循环中的左循环移位指令.

      ROR OPRD1,COUNT ;不含进位示志位CF在循环中的右循环移位指令.

      RCL OPRD1,COUNT ;带进位的左循环移位指令.

      RCR OPRD1,COUNT ;带进位的右循环移位指令.

 

说明:

    1. 本指令组只影响标志CF、OF.OF由移入CF的内容决定,OF取决于移位一次后符号位是否改变,如改变,则OF=1.

    2. 由于是循环移位,所以对字节移位8次; 对字移位16次,就可恢复为原操作数.由于带CF的循环移位,可以将CF的内容移入,所以可以利用它实现多字节的循环.

    注意: 以上程序中的指令SHR AL,CL如改为SAR AL,CL,虽然最高4位可移入低4位,但最高位不为0,故应加入一条指令AND AL,0FH.否则,若最高位不为0时,将得到错误结果.

46. JMP

    无条件转移指令JMP

    格式: JMP OPRD

    功能: JMP指令将无条件地控制程序转移到目的地址去执行.当目的地址仍在同一个代码段内,称为段内转移;当目标地址不在同一个代码段内,则称为段间转移.这两种情况都将产生不同的指令代码,以便能正确地生成目的地址,在         段内转移时,指令只要能提供目的地址的段 内偏移量即够了;而在段间转移时,指令应能提供目的地址的段地址及段内偏移地址值.

说明:

    1. 其中OPRD为转移的目的地址.程序转移到目的地址所指向的指令继续往下执行.

    2. 本组指令对标志位无影响.

    3. &lt;1> 段内直接转移指令: JMP NEAR 标号

       &lt;2> 段内间接转移指令: JMP OPRD

        &lt;3> 段间直接转移指令: JMP FAR 标号

        &lt;4> 段间间接转移指令:JMP OPRD其中的OPRD为存储器双字操作数.段间间接转移只能通过存储器操作数来实现.

47. JC

    条件转移指令 JC

    格式: JC 标号

    功能: CF＝1,转至标号处执行

    说明: JC为根据标志位CF进行转移的指令

48. JNC

    条件转移指令JNC

    格式: JNC标号

    功能: CF＝0,转至标号处执行

    说明: JNC为根据标志位CF进行转移的指令

49. JE

    条件转移指令JE/JZ

    格式: JE/JZ标号

    功能: ZF＝1,转至标号处执

    说明:

    1. 指令JE与JZ等价,它们是根据标志位ZF进行转移的指令

    2. JE,JZ均为一条指令的两种助记符表示方法

50. JZ

    条件转移指令JE/JZ

    格式: JE/JZ标号

    功能: ZF＝1,转至标号处执

    说明:

    1. 指令JE与JZ等价,它们是根据标志位ZF进行转移的指令

    2. JE,JZ均为一条指令的两种助记符表示方法

51. JNE

    条件转移指令JNE/JNZ

    格式: JNE/JNZ 标号

    功能: ZF＝0,转至标号处执行

    说明:

    1. 指令JNE与JNZ等价,它们是根据标志位ZF进行转移的指令

    2. JNE,JNZ均为一条指令的两种助记符表示方法

52. JNZ

    条件转移指令JNE/JNZ

    格式: JNE/JNZ 标号

    功能: ZF＝0,转至标号处执行

    说明:

    1. 指令JNE与JNZ等价,它们是根据标志位ZF进行转移的指令

    2. JNE,JNZ均为一条指令的两种助记符表示方法

53. JS

    条件转移指令JS

    格式: JS 标号

    功能: SF＝1,转至标号处执行， 为正

    说明: JS是根据符号标志位SF进行转移的指令

54. JNS

    条件转移指令JNS
     
    格式: JNS 标号

    功能: SF＝0,转至标号处执行

    说明: JNS是根据符号标志位SF进行转移的指令

55. JO

    条件转移指令JO

    格式: JO 标号

    功能: OF＝1,转至标号处执行

    说明: JO是根椐溢出标志位OF进行转移的指令

56. JNO

    条件转移指令JNO

    格式: JNO 标号

    功能: OF＝0,转至标号处执行

    说明: JNO是根椐溢出标志位OF进行转移的指令

57. JP

    条件转移指令JP/JPE

    格式: JP/JPE 标号

    功能: PF＝1,转至标号处执行

    说明:

    1. 指令JP与JPE,它们是根据奇偶标志位PF进行转移的指令

    2. JP,JPE均为一条指令的两种助记符表示方法

58. JPE

      同JP指令(同一条指令两种记法）

59. JNP

    条件转移指令JNP/JPO
     
    格式: JNP/JPO 标号

    功能: PF＝0,转至标号处执行

说明:

    1. 指令JNP与JPO,它们是根据奇偶标志位PF进行转移的指令

    2. JNP,JPO均为一条指令的两种助记符表示方法

60. JPO

 

    条件转移指令JNP/JPO JNP 和 JPO指令一样
     
    格式: JNP/JPO 标号

    功能: PF＝0,转至标号处执行

说明:

    1. 指令JNP与JPO,它们是根据奇偶标志位PF进行转移的指令

    2. JNP,JPO均为一条指令的两种助记符表示方法


</pre>

