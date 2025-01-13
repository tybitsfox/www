<?php
echo "<center><font size=5 color=#0000ff>汇编指令一</font></center><br><pre>";
echo "通用寄存器

    　　AX
    　　BX
    　　CX
    　　DX

段寄存器

    　　CS - Code Segment
    　　DS - Data Segment
    　　ES - Extra Segment
    　　SS - Stack Segment

指针寄存器

    　IP - Instruction Pointer
    　BP - Base Pointer
    　SP - Stack Pointer

数据转移寄存器

    　　DI - Destination Index
    　　SI - Source Index
    　　set of flags

指令学习

1. MOVE

    数据传送指令 MOV

    格式: MOV OPRD1,OPRD2

    功能: 本指令将一个源操作数送到目的操作数中,即OPRD1<--OPRD2.

说明:

1. OPRD1 为目的操作数,可以是寄存器、存储器、累加器.

   OPRD2 为源操作数,可以是寄存器、存储器、累加器和立即数.

2. MOV 指令以分为以下四种情况:

    - 寄存器之间的数据传送指令

    - 即数到通用寄存器数据传送指令

    - 存器与存储器之间的数据传送指令

    - 立即数到存储器的数据传

3本指令不影响状态标志位

Note: x86上不支持内存到内存的转移指令, mov byte ptr [di], byte ptr [si] 是错的

　　  同样也不能两个操作数都是段寄存器, mov es, cs 是错的

　　　mov ds, 0这样也是错的, 需要通过ax来中转 mov ax, 0; mov ds, ax

 

2. PUSH

堆栈操作指令 PUSH和POP

格式:

    PUSH OPRD

    POP OPRD

功能: 实现压入操作的指令是PUSH指令;实现弹出操作的指令是POP指令.

说明:

1. OPRD为16位(字)操作数,可以是寄存器或存储器操作数.

2. PUSH的操作过程是: (SP)<--(SP)-2,((sp))<--OPRD 即先修改堆栈指针SP

(压入时为自动减2),然后,将指定的操作数送入新的栈顶位置.

此处的((SP))<--OPRD,也可以理解为: [(SS)*16+(SP)]<--OPRD 或 [SS:SP]<--OPRD

 

3. POP

堆栈操作指令 PUSH和POP

格式:

    PUSH OPRD

    POP OPRD

功能: 实现压入操作的指令是PUSH指令;实现弹出操作的指令是POP指令.

说明:

1. OPRD为16位(字)操作数,可以是寄存器或存储器操作数.

2. POP指令的操作过程是: POP OPRD:OPRD<--((SP)),(SP)<--(SP)+2

它与压入操作相反,是先弹出栈顶的数顶,然后再修改指针SP的内容.

 

3. 示例:

    POP AX

    POP DS

    POP DATA1 POP ALFA[BX][DI]

4. PUSH和POP指令对状态标志位没有影响.

 

4. XCHG

数据交换指令 XCHG

格式: XCHG OPRD1,OPRD2 其中的OPRD1为目的操作数,OPRD2为源操作数

功能: 将两个操作数相互交换位置,该指令把源操作数OPRD2与目的操数OPRD1

交换.

说明:

1. OPRD1及OPRD2可为通用寄存器或存储器,但是两个存储器之间是不能用XCHG指令实现的.

2. 段寄存器内容不能用XCHG指令来交换.

3. 若要实现两个存储器操作数DATA1及DATA2的交换,可用以下指令实现:

示例:

    PUSH DATA1

    PUSH DATA2

    POP DATA1

    POP DATA2

本指令不影响状态标志位.

 

5. XLAT

查表指令 XLAT

格式: XLAT TABLE其中TABLE为一待查表格的首地址.

    LEA bx, offset s

    MOV al, 0

    XLAT

功能: 把待查表格的一个字节内容送到AL累加器中.

说明:

1. 在执行该指令前,应将TABLE先送至BX寄存器中,然后将待查字节与在表格中距表首地址位移量送AL,即 (AL)<--((BX)+(AL)).

2. 本指令不影响状态标位,表格长度不超过256字节.

 

6. LAHF

标志传送指令 LAHF

格式: LAHF

功能: 取FLAG标志寄存器低8位至AH寄存器.(AH)<--(FLAG)7~0

说明: 该指令不影响FLAG的原来内容,AH只是复制了原FLAG的低8位内容.

 

7. SAHF

标志传送指令 SAHF

格式: SAHF

功能: 将AH存至FLAG低8位

说明: 本指令将用AH的内容改写FLAG标志寄存器中的SF、ZF、AF、PF、和CF标志,从而改变原来的标志位.

 

8. PUSHF

标志传送指令 PUSHF

格式: PUSHF

功能: 本指令可以把标志寄存器的内容保存到堆栈中去

 

9. POPF

标志传送指令 POPF

格式: POPF

功能: 本指令的功能与PUSHF相反,在子程序调用和中断服务程序中,往往用PUSHF指令保护FLAG的内容,用POPF指令将保护的FLAG内容恢复.

说明: 如果对堆栈中的原FLAG内容进行修改,如对TF等标志位进行修改,然后再弹回标志位寄存器FLAG.这是通过指令修改TF标志的唯一方法.

 

10. LEA

有效地址传送指令 LEA

格式: LEA OPRD1,OPRD2

功能: 将源操作数给出的有效地址传送到指定的的寄存器中.

说明:

1. OPRD1 为目的操作数,可为任意一个16位的通用寄存器.
  
    OPRD2 为源操作数,可为变量名、标号或地址表达式. 

    示例: 

    LEA BX,DATA1
    LEA DX,BETA[BX+SI]
    LEA BX BX,[BP],[DI]

2. 本指令对标志位无影响。</pre>";
?>
