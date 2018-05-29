<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo ("<center><font color=#0000ff size=4>Uuix汇编语言简介</font></center>");
echo ("<font color=#ff0000 size=5><pre>

---------------------------------------------------------------------------
Konstantin Boldyshev 编译：i 2000-11-08 14:16:26 
---------------------------------------------------------------------------

本文章重要介绍如何在LA-32(I386)平台下Uinx系统下编写简单的汇编程序，这里的材
料并不一定适用于其他的平台，本文说明了程序风格、系统调用惯例和编译过程。更加
详细的信息可以参考Linux Assembly HOWTO。

---------------------------------------------------------------------------

1. 简介
1.1 版权声明
Copyright © 1999-2000 Konstantin Boldyshev. 本文章遵从GNUFree Document
ation License.

1.2 获得本文档
本文章的最新版本可以在 http://linuxassembly.org/intro.html下载。

1.3 需要的工具
为了验证本文中的程序示例，需要以下几个开发工具。 

首先，需要一个编译器.当前，Unix发布一般都带有gas(GNU Assemble)，但是这里的例
子都使用另外一个编译器—nasm (Netwide Assembler)。它的源代码也是开放的，可以
从nasm page下载该程序。一般Linux发布都预装了nasm，所以首先查看你的系统。 

其次，需要一个链接器—ld，由于一个nasm仅仅产生目标代码，所以需要链接器来链接
目标代码，一般Linux发布都带有ld程序。

---------------------------------------------------------------------------

2. Hello, world!
下面，我们将编写一个打印\"hello,world!\"的汇编程序(hello.asm)。你可以从这里下
载院代码和二进制代码。

2.1 System calls 
除非一个汇编程序仅仅进行数学运算，否则其必须进行输入输出及退出等操作，而要进
行这些操作就需要调用操作系统的服务。实际上，除了使用系统的服务以外，不同操作
系统的汇编编程是很类似的。

在UNIX系统下有两种方式实现对系统调用的使用：通过经过封装的C库(libc)或者直接
调用。

在汇编程序中是否使用libc不仅仅是一个编程风格的问题，而libc封装用来确保当系统
调用接口发生变化时，无须对使用libc的程序进行修改，和用来提供POSIX兼容的接口
。而UNIX内核调用往往是和POSIX兼容的，这意味着大多数libc的系统调用的语法完全
和真正的内核系统调用相匹配的(或者相反)。但是不通过libc调用系统服务的缺点是会
丢失若干个不仅仅是系统调用封装的函数如：printf(), malloc()

这篇文章来说明如何直接调用内核调用，因为这是调用内核服务的效率最高的方式，我
们的程序不与任何库链接，而是直接和内核通信。

不同的UNIX内核的系统调用函数集合及系统调用惯例都是不大相同的,但是它们往往都
是POSIX兼容的操作系统，所以往往都有很明显的共同点。

2.2 程序风格
当前IA-32 UNIX都是32bit的操作系统，具有以下特点：运行在保护模式下，具有\"平坦
\"(flat)内存地址空间，使用ELF二进制代码格式。一个程序可以划分为不同的段：.te
xt是程序执行代码(只读)，.data是程序的数据部分(读写)，.bss是没有经过初始化的
数据(read-write)；同时还可以具有其他一些标准的段及用户自定义段，但是这种情况
很少被应用。而一个程序至少具有.text段。

2.3 Linux 
LInux环境下的系统调用是通过int 0x80来实现的。(实际上有一个内核补丁允许在新的
CPU上通过系统调用sysenter指令来使用系统调用，但是这仍然处于实验阶段)

Linux在调用惯例上和其他的Unix不大一样，对于系统调用具有一个\"fastcall\"惯例(和
DOS倒是挺类似的)。系统函数号由ea被传递，参数则通过寄存器被传递，而不是通过堆
栈。一共可以具有5个参数，顺序存放在ebx, ecx, edx, esi, edi。如果调用具有5个
以上的参数，它们则简单的以结构的形式作为第一个参数传递。返回结果在ea中被返回
，堆栈则根本没有被建立。

系统调用函数号包含在/sys/syscall.h中，而实际上是定义在asm/unistd.h中。系统调
用的man文档有的包含在man的第二部分，例如man 2 write才能看到write的man文档。

下面，我们的Linux汇编程序如下：

---------------------------------------------------------------------------

section .text
    global _start                       ;must be declared for linker (ld)

msg     db      'Hello, world!',0xa     ;our dear string
len     equ     $ - msg                 ;length of our dear string

_start:                                 ;tell linker entry point

        mov     edx,len ;message length
        mov     ecx,msg ;message to write
        mov     ebx,1   ;file descriptor (stdout)
        mov     eax,4   ;system call number (sys_write)
        int     0x80    ;call kernel

        mov     eax,1   ;system call number (sys_exit)
        int     0x80    ;call kernel

---------------------------------------------------------------------------

正如你将要了解的那样，Linux系统调用惯例是最紧凑的一种了。 

内核资源参考 

arch/i386/kernel/entry.S 
include/asm-i386/unistd.h 
include/linux/sys.h 
2.4 FreeBSD 
FreeBSD是具有常见的调用惯例，其系统调用号存放在eax中，参数存放在堆栈中(第一
个参数最后被推入栈中)， 一个系统调用通过一个对一个包含int 0x80和ret的函数的
调用来进行的，而不仅仅是int 0x80。(在int 0x80发出之前，返回地址必须已经存放
在堆栈之中)。调用结束以后调用者必须清除堆栈。调用返回结果一般存放在eax中。

有另外一个可选的方法来使用call 7:0来替代int 0x80。最后结果是一样的。但是cal
l 7:0的方法将增加程序大小，因为之前用户必须使用push eax命令。

系统调用号存放在sys/syscall.h中。系统调用的man文档在man的第二部分。

程序如下所示：

---------------------------------------------------------------------------

section .text
    global _start                       ;must be declared for linker (ld)

msg     db      \"Hello, world!\",0xa     ;our dear string
len     equ     $ - msg                 ;length of our dear string

_syscall:               
        int     0x80            ;system call
        ret

_start:                         ;tell linker entry point

        push    dword len       ;message length
        push    dword msg       ;message to write
        push    dword 1         ;file descriptor (stdout)
        mov     eax,0x4         ;system call number (sys_write)
        call    _syscall        ;call kernel

                                ;the alternate way to call kernel:
                                ;push   eax
                                ;call   7:0

        add     esp,12          ;clean stack (3 arguments * 4)

        push    dword 0         ;exit code
        mov     eax,0x1         ;system call number (sys_exit)
        call    _syscall        ;call kernel

                                ;we do not return from sys_exit,
                                ;there's no need to clean stack

---------------------------------------------------------------------------

内核资源参考： 

i386/i386/exception.s 
i386/i386/trap.c 
sys/syscall.h 
　

2.5 BeOS 
BeOS内核同样使用通用的UNIX调用惯例，其和FreeBSD的区别是使用:int 0x25。

对于到哪里查找系统调用号和其他感兴趣的细节，查看os_beos.inc文件。

为了使用nasm正确的编译BeOS程序，需要在float.h中加入#include \"nasm.h\" ，和在
nasm.h中加入#include <stdio.h>。

---------------------------------------------------------------------------

section .text
    global _start                       ;must be declared for linker (ld)

msg     db      \"Hello, world!\",0xa     ;our dear string
len     equ     $ - msg                 ;length of our dear string

_syscall:                       ;system call
        int     0x25
        ret

_start:                         ;tell linker entry point

        push    dword len       ;message length
        push    dword msg       ;message to write
        push    dword 1         ;file descriptor (stdout)
        mov     eax,0x3         ;system call number (sys_write)
        call    _syscall        ;call kernel
        add     esp,12          ;clean stack (3 * 4)

        push    dword 0         ;exit code
        mov     eax,0x3f        ;system call number (sys_exit)
        call    _syscall        ;call kernel
                                ;no need to clean stack

---------------------------------------------------------------------------

2.6 创建可执行代码
创建可执行代码分为两个阶段：编译和链接。按照下面的步骤进行：

---------------------------------------------------------------------------

$ nasm -f elf hello.asm         # this will produce hello.o object file
$ ld -s -o hello hello.o        # this will produce hello executable

---------------------------------------------------------------------------

这样就很容易的产生了可执行代码，然后使用命令./hello就可以执行程序了。 

3. 汇编资源
若希望深入了解Linux汇编，可以参考站点Linux的内容，并且下载asmutils，其包含了
很多示例代码。也可以参考Linux Assembly HOWTO..下面是一些Linux汇编的一些资源
链接。

工程:
;各种使用汇编编写的LInux/UNIX工程，是很好的示例资源

name short description platform OS assembler 
asmutils miscellaneous utilities, small libc IA32 Linux, FreeBSD (BeOS) nas
m 
libASM assembly library (lots of various routines) IA32 Linux nasm 
e3 WordStar-like text editor IA32 Linux, FreeBSD, BeOS nasm 
ec64 Commodore C64 emulator IA32 Linux nasm 
ELF kickers ELF kickers and tiny Linux executables IA32 Linux nasm 
BLAS basic linear algebra subroutines Alpha Linux, Digital UNIX, WinNT gas 
ASMIX several commandline utilities IA32 Linux, FreeBSD gas 
asm-toys few utilities IA32 Linux gas 
cpuburn CPU loading utililties IA32 Linux, FreeBSD gas 
acid small textmode intro IA32, ARM Linux nasm, gas 
eforth Linux Forth IA32 Linux gas 
smallutils few small utils in assembly and C IA32, SPARC Linux gas 

还有很多C-汇编混合工程，如 Linux kernel, GNU MP Library, GNU libc, OpenGUI,
 FreeAmp。 

文档:


Linux Assembly HOWTO 

Using the GNU Assembler (GAS manuals) 

List of Linux/i386 system calls: this one and this one 

Digital UNIX assembly 

; Articles


Startup state of Linux/i386 ELF binary 

Self-modifying code under Linux 

; Books


The Art Of Assembly
by Randall Hyde. Classic book; general assembly programming, for newbies. 

PC Assembly Language
by Paul Carter. 32bit protected mode programming, Windows & Linux, for newb
ies. 

Assembler for DOS, Windows and UNIX
by Sergey Zubkov. ISBN 5-89818-019-2, 637 pages, 1999. In Russian language.
 

Assembly Language Step-By-Step; Programming with DOS and Linux with CDROM
by Jeff Duntemann. ISBN: 0471375233, 612 pages, 2000; John Wiley & Sons 

Linux Assembly Programming
by me. Not available yet. 

; CPU 手册及汇编编程导引 

IA-32 (x86): sandpile.org, x86.org, Intel, AMD, Cyrix, x86 bugs  
IA-64: Intel IA-64 manuals  
Alpha: Digital Alpha papers, Digital Documentation Library, more manuals  
SPARC: SPARC International Standard Documents Repository, Technical SPARC C
PU Resources  
MIPS: MIPS Online Publications Library  
PPC: Beginners Guide to PowerPC Assembly Language  

新手入门指引: 

Introduction to UNIX assembly programming (Linux, FreeBSD, BeOS) 

Using x86 assembly code in BeOS (NASM, linking to GCC) 

Linux assembly tutorial (GAS and GDB) 

DJGPP QuickAsm Programming Guide (GAS and GCC inline assembly) 

SPARC assembly \"Hello world\" (NetBSD, SunOS, Solaris) 

A Whirlwind Tutorial on Creating Really Teensy ELF Executables for Linux 

工具：

NASM portable x86 assembler with Intel syntax 
NASM 0.98e extented NASM version 
BIEW portable console hex viewer/editor with built-in disassembler 
UPX portable executable packer for several formats 
Intel2gas converter between AT&T and Intel assembler syntax 
A2I converter from AT&T to Intel assembler syntax 
TA2AS converter from TASM to AT&T assembler syntax 
SPARC SPARC v8 assembler & disassembler 

站点：

APJ Assembly Programming Journal 
H-Peter Recktenwald's site \"The Int80h page\" 
Jan's Linux & Assembler page mostly about assembly programming with libc 
Bruce Ediger's page SPARC assembly related materia 
</pre></font>");
?>
