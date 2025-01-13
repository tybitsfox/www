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

<hr width=100%><font size=3 color=red>五、64位系统下编写纯32位汇编程序说明</font>
<br><br>
<pre>在64位系统下编写32位汇编程序仅需在编译、链接过程中添加如下参数：
asm --32
ld -m elf_i386
示例如下：
1、makefile:
 1 t01:t01.o
  2     ld -m elf_i386 -o t01 t01.o
  3 t01.o:t01.s
  4     as --32 -o t01.o t01.s
  5 clean:
  6     -rm t01.o t01
2、汇编代码(t01.s)：
  1 .section .data
  2 msg1:   .ascii "test jz no zero is set\n"
  3 len1=.-msg1
  4 msg2:   .ascii "test jz is zero is clear\n"
  5 len2=.-msg2
  6 aa:     .space  5,1
  7 .section .text
  8 .globl _start
  9 _start:
 10     xorl %eax,%eax
 11     movl $1,%eax
 12     leal aa,%edi
 13 #   jmp 3f
 14     movl $5,%ecx
 15     rep scasb
 16     jz 1f
 17     leal msg2,%ecx
 18     movl $len2,%edx
 19     jmp 2f
 20 1:
 21     leal msg1,%ecx
 22     movl $len1,%edx
 23 2:
 24     movl $1,%ebx
 25     movl $4,%eax
 26     int $0x80
 27 3:
 28     movl $0,%ebx
 29     movl $1,%eax
 30     int $0x80
 31     ret





</pre>

