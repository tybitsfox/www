<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo ("<a name=p001></a><center><font color=#ff0000 size=5>玩转ptrace(一)</font></center>");
echo ("<font color=#0000ff size=3><pre>
by Pradeep Padala
Created 2002-11-01 02:00
翻译: Magic.D E-mail: adamgic@163.com
译者序：在开发Hust Online
Judge的过程中，查阅了不少资料，关于调试器技术的资料在网上是很少，即便是UNIX编程巨著《UNIX环境高级编程》中，相关内容也不多，直到我在http://
www.linuxjournal.com上找到这篇文章，如获至宝，特翻译之，作为鄙人翻译技术文档的第一次尝试，必定会有不少蹩脚之处，各位就将就一下吧，欢迎大力
拍砖。
你想过怎么实现对系统调用的拦截吗？你尝试过通过改变系统调用的参数来愚弄你的系统kernel吗？你想过调试器是如何使运行中的进程暂停并且控制它吗？
你可能会开始考虑怎么使用复杂的kernel编程来达到目的，那么，你错了。实际上Linux提供了一种优雅的机制来完成这些：ptrace系统函数。 
ptrace提供了一种使父进程得以监视和控制其它进程的方式，它还能够改变子进程中的寄存器和内核映像，因而可以实现断点调试和系统调用的跟踪。
使用ptrace，你可以在用户层拦截和修改系统调用(sys call)在这篇文章中，我们将学习如何拦截一个系统调用，然后修改它的参数。在本文的
第二部分我们将学习更先进的技术：设置断点，插入代码到一个正在运行的程序中；我们将潜入到机器内部，偷窥和纂改进程的寄存器和数据段。 
基本知识
操作系统提供了一种标准的服务来让程序员实现对底层硬件和服务的控制（比如文件系统），叫做系统调用(system calls)。当一个程序需要作系统
调用的时候，它将相关参数放进系统调用相关的寄存器，然后调用软中断0x80，这个中断就像一个让程序得以接触到内核模式的窗口，程序
将参数和系统调用号交给内核，内核来完成系统调用的执行。
在i386体系中(本文中所有的代码都是面向i386体系)，系统调用号将放入%eax,它的参数则依次放入%ebx, %ecx, %edx, %esi 和 %edi。 比如，在以下的调用

       Write(2, “Hello”, 5)
 
的汇编形式大概是这样的


    movl \$4, %eax
    movl \$2, %ebx
    movl \$hello, %ecx
    movl \$5, %edx
    int \$0x80
 

这里的\$hello指向的是标准字符串”Hello”。 
那么，ptrace会在什么时候出现呢？在执行系统调用之前，内核会先检查当前进程是否处于被“跟踪”(traced)的状态。如果是的话，内核暂停当前进程并将控
制权交给跟踪进程，使跟踪进程得以察看或者修改被跟踪进程的寄存器。 
让我们来看一个例子，演示这个跟踪程序的过程 

#include &lt;sys/ptrace.h&gt;
 #include &lt;sys/types.h&gt;
 #include &lt;sys/wait.h&gt;
 #include &lt;unistd.h&gt;
  #include &lt;linux/user.h&gt; /* For constants
                                    ORIG_EAX etc */
 int main()
  {
    pid_t child;
     long orig_eax;
     child = fork();
      if(child == 0) {
         ptrace(PTRACE_TRACEME, 0, NULL, NULL);
         execl(\"/bin/ls\", \"ls\", NULL);
     }
      else {
         wait(NULL);
         orig_eax = ptrace(PTRACE_PEEKUSER,
                           child, 4 * ORIG_EAX,
                           NULL);
         printf(\"The child made a \"
                \"system call %ld \", orig_eax);
         ptrace(PTRACE_CONT, child, NULL, NULL);
     }
     return 0;
 }

运行这个程序，将会在输出ls命令的结果的同时，输出:
 
The child made a system call 11
说明：11是execve的系统调用号，这是该程序调用的第一个系统调用。想知道系统调用号的详细内容，察看 /usr/include/asm/unistd.h。 
在以上的示例中，父进程fork出了一个子进程，然后跟踪它。在调用exec函数之前，子进程用PTRACE_TRACEME作为第一个参数调用了 
ptrace函数，它告诉内核：让别人跟踪我吧！然后，在子进程调用了execve()之后，它将控制权交还给父进程。当时父进程正使用wait()函数来等待来自
内核的通知，现在它得到了通知，于是它可以开始察看子进程都作了些什么，比如看看寄存器的值之类。
出现系统调用之后，内核会将eax中的值（此时存的是系统调用号）保存起来，我们可以使用PTRACE_PEEKUSER作为ptrace的第一个参数来读到这个值。
我们察看完系统调用的信息后，可以使用PTRACE_CONT作为ptrace的第一个参数，调用ptrace使子进程继续系统调用的过程。
 
ptrace函数的参数
 
Ptrace有四个参数
long ptrace(enum __ptrace_request request,
            pid_t pid,
            void *addr,
            void *data);
 
第一个参数决定了ptrace的行为与其它参数的使用方法，可取的值有:
PTRACE_ME
PTRACE_PEEKTEXT
PTRACE_PEEKDATA
PTRACE_PEEKUSER
PTRACE_POKETEXT
PTRACE_POKEDATA
PTRACE_POKEUSER
PTRACE_GETREGS
PTRACE_GETFPREGS,
PTRACE_SETREGS
PTRACE_SETFPREGS
PTRACE_CONT
PTRACE_SYSCALL,
PTRACE_SINGLESTEP
PTRACE_DETACH
在下文中将对这些常量的用法进行说明。
 
读取系统调用的参数
 
通过将PTRACE_PEEKUSER作为ptrace 的第一个参数进行调用，可以取得与子进程相关的寄存器值。
 
先看下面这个例子

#include &lt;sys/ptrace.h&gt;
 #include &lt;sys/types.h&gt;
 #include &lt;sys/wait.h&gt;
 #include &lt;unistd.h&gt;
 #include &lt;linux/user.h&gt;
  #include &lt;sys/syscall.h&gt; /* For SYS_write etc */
 
 int main()
  {
     pid_t child;
     long orig_eax, eax;
     long params[3];
     int status;
     int insyscall = 0;
     child = fork();
      if(child == 0) {
         ptrace(PTRACE_TRACEME, 0, NULL, NULL);
         execl(\"/bin/ls\", \"ls\", NULL);
     }
      else {
         while(1) {
           wait(&status);
           if(WIFEXITED(status))
               break;
           orig_eax = ptrace(PTRACE_PEEKUSER,
                      child, 4 * ORIG_EAX, NULL);
            if(orig_eax == SYS_write) {
               if(insyscall == 0) {
                  /* Syscall entry */
                 insyscall = 1;
                 params[0] = ptrace(PTRACE_PEEKUSER,
                                    child, 4 * EBX,
                                    NULL);
                 params[1] = ptrace(PTRACE_PEEKUSER,
                                    child, 4 * ECX,
                                    NULL);
                 params[2] = ptrace(PTRACE_PEEKUSER,
                                    child, 4 * EDX,
                                    NULL);
                 printf(\"Write called with \"
                        \"%ld, %ld, %ld \",
                        params[0], params[1],
                        params[2]);
                 }
            else { /* Syscall exit */
                 eax = ptrace(PTRACE_PEEKUSER,
                              child, 4 * EAX, NULL);
                     printf(\"Write returned \"
                            \"with %ld \", eax);
                     insyscall = 0;
                 }
             }
             ptrace(PTRACE_SYSCALL,
                    child, NULL, NULL);
         }
     }
     return 0;
 }

这个程序的输出是这样的
 
ppadala@linux:~/ptrace &gt; ls
a.out dummy.s ptrace.txt
libgpm.html registers.c syscallparams.c
dummy ptrace.html simple.c
ppadala@linux:~/ptrace &gt; ./a.out
Write called with 1, 1075154944, 48
a.out dummy.s ptrace.txt
Write returned with 48
Write called with 1, 1075154944, 59
libgpm.html registers.c syscallparams.c
Write returned with 59
Write called with 1, 1075154944, 30
dummy ptrace.html simple.c
Write returned with 30
 

以上的例子中我们跟踪了write系统调用，而ls命令的执行将产生三个write系统调用。使用PTRACE_SYSCALL作为ptrace的第一个参数，使内核在子进程做出
系统调用或者准备退出的时候暂停它。这种行为与使用PTRACE_CONT，然后在下一个系统调用/进程退出时暂停它是等价的。
在前一个例子中，我们用PTRACE_PEEKUSER来察看write系统调用的参数。系统调用的返回值会被放入%eax。
wait函数使用status变量来检查子进程是否已退出。它是用来判断子进程是被ptrace暂停掉还是已经运行结束并退出。有一组宏可以通过status的值来判断
进程的状态，比如WIFEXITED等，详情可以察看wait(2) man。 
读取寄存器的值如果你想在系统调用或者进程终止的时候读取它的寄存器，使用前面那个例子的方法是可以的，但是这是笨拙的方法。使用PRACE_GETREGS
作为ptrace的第一个参数来调用，可以只需一次函数调用就取得所有的相关寄存器值。
获得寄存器值得例子如下：

#include &lt;sys/ptrace.h&gt;
 #include &lt;sys/types.h&gt;
 #include &lt;sys/wait.h&gt;
 #include &lt;unistd.h&gt;
 #include &lt;linux/user.h&gt;
 #include &lt;sys/syscall.h&gt;
 
 int main()
  {
     pid_t child;
     long orig_eax, eax;
     long params[3];
     int status;
     int insyscall = 0;
     struct user_regs_struct regs;
     child = fork();
      if(child == 0) {
         ptrace(PTRACE_TRACEME, 0, NULL, NULL);
         execl(\"/bin/ls\", \"ls\", NULL);
     }
      else {
         while(1) {
           wait(&status);
           if(WIFEXITED(status))
               break;
           orig_eax = ptrace(PTRACE_PEEKUSER,
                             child, 4 * ORIG_EAX,
                             NULL);
            if(orig_eax == SYS_write) {
                if(insyscall == 0) {
                   /* Syscall entry */
                  insyscall = 1;
                  ptrace(PTRACE_GETREGS, child,
                         NULL, &regs);
                  printf(\"Write called with \"
                         \"%ld, %ld, %ld \",
                         regs.ebx, regs.ecx,
                         regs.edx);
              }
               else { /* Syscall exit */
                  eax = ptrace(PTRACE_PEEKUSER,
                               child, 4 * EAX,
                               NULL);
                  printf(\"Write returned \"
                         \"with %ld \", eax);
                  insyscall = 0;
              }
           }
           ptrace(PTRACE_SYSCALL, child,
                  NULL, NULL);
        }
    }
    return 0;
 }

这段代码与前面的例子是比较相似的，不同的是它使用了PTRACE_GETREGS。 其中的user_regs_struct结构是在&lt;linux/user.h&gt;中定义的。 
来点好玩的

现在该做点有意思的事情了，我们将要把传给write系统调用的字符串给反转。

#include &lt;sys/ptrace.h&gt;
 #include &lt;sys/types.h&gt;
 #include &lt;sys/wait.h&gt;
 #include &lt;unistd.h&gt;
 #include &lt;linux/user.h&gt;
 #include &lt;sys/syscall.h&gt;
 
 const int long_size = sizeof(long);
 
 void reverse(char *str)
  {
     int i, j;
     char temp;
     for(i = 0, j = strlen(str) - 2;
          i &lt;= j; ++i, --j) {
         temp = str[i];
         str[i] = str[j];
         str[j] = temp;
     }
 }
 
 void getdata(pid_t child, long addr,
              char *str, int len)
  {
     char *laddr;
     int i, j;
      union u {
             long val;
             char chars[long_size];
     }data;
 
     i = 0;
     j = len / long_size;
     laddr = str;
      while(i &lt; j) {
         data.val = ptrace(PTRACE_PEEKDATA,
                           child, addr + i * 4,
                           NULL);
         memcpy(laddr, data.chars, long_size);
         ++i;
         laddr += long_size;
     }
     j = len % long_size;
      if(j != 0) {
         data.val = ptrace(PTRACE_PEEKDATA,
                           child, addr + i * 4,
                           NULL);
         memcpy(laddr, data.chars, j);
     }
     str[len] = '';
 }
 
 void putdata(pid_t child, long addr,
              char *str, int len)
  {
     char *laddr;
     int i, j;
      union u {
             long val;
             char chars[long_size];
     }data;
 
     i = 0;
     j = len / long_size;
     laddr = str;
      while(i &lt; j) {
         memcpy(data.chars, laddr, long_size);
         ptrace(PTRACE_POKEDATA, child,
                addr + i * 4, data.val);
         ++i;
         laddr += long_size;
     }
     j = len % long_size;
      if(j != 0) {
         memcpy(data.chars, laddr, j);
         ptrace(PTRACE_POKEDATA, child,
                addr + i * 4, data.val);
     }
 }
 
 int main()
  {
    pid_t child;
    child = fork();
     if(child == 0) {
       ptrace(PTRACE_TRACEME, 0, NULL, NULL);
       execl(\"/bin/ls\", \"ls\", NULL);
    }
     else {
       long orig_eax;
       long params[3];
       int status;
       char *str, *laddr;
       int toggle = 0;
        while(1) {
          wait(&status);
          if(WIFEXITED(status))
              break;
          orig_eax = ptrace(PTRACE_PEEKUSER,
                            child, 4 * ORIG_EAX,
                            NULL);
           if(orig_eax == SYS_write) {
              if(toggle == 0) {
                toggle = 1;
                params[0] = ptrace(PTRACE_PEEKUSER,
                                   child, 4 * EBX,
                                   NULL);
                params[1] = ptrace(PTRACE_PEEKUSER,
                                   child, 4 * ECX,
                                   NULL);
                params[2] = ptrace(PTRACE_PEEKUSER,
                                   child, 4 * EDX,
                                   NULL);
                str = (char *)calloc((params[2]+1)
                                  * sizeof(char));
                getdata(child, params[1], str,
                        params[2]);
                reverse(str);
                putdata(child, params[1], str,
                        params[2]);
             }
              else {
                toggle = 0;
             }
          }
       ptrace(PTRACE_SYSCALL, child, NULL, NULL);
       }
    }
    return 0;
 }
输出是这样的：
 
ppadala@linux:~/ptrace &gt; ls
a.out dummy.s ptrace.txt
libgpm.html registers.c syscallparams.c
dummy ptrace.html simple.c
ppadala@linux:~/ptrace &gt; ./a.out
txt.ecartp s.ymmud tuo.a
c.sretsiger lmth.mpgbil c.llacys_egnahc
c.elpmis lmth.ecartp ymmud

这个例子中涵盖了前面讨论过的所有知识点，当然还有些新的内容。这里我们用PTRACE_POKEDATA作为第一个参数，以此来改变子进程中的变量值。它以与
PTRACE_PEEKDATA相似的方式工作，当然，它不只是偷窥变量的值了，它可以修改它们。 
单步ptrace 提供了对子进程进行单步的功能。 ptrace(PTRACE_SINGLESTEP, …)
会使内核在子进程的每一条指令执行前先将其阻塞，然后将控制权交给父进程。下面的例子可以查出子进程当前将要执行的指令。为了便于理解，我用汇编写了
这个受控程序，而不是让你为c的库函数到底会作那些系统调用而头痛。以下是被控程序的代码 dummy1.s，使用gcc  –o dummy1 dummy1.s来编译

.data
hello:
    .string \"hello world\n\"
.globl main
main:
    movl \$4, %eax
    movl \$2, %ebx
    movl \$hello, %ecx
    movl \$12, %edx
    int \$0x80
    movl \$1, %eax
    xorl %ebx, %ebx
    int \$0x80
    ret

以下的程序则用来完成单步：
#include &lt;sys/ptrace.h&gt;
 #include &lt;sys/types.h&gt;
 #include &lt;sys/wait.h&gt;
 #include &lt;unistd.h&gt;
 #include &lt;linux/user.h&gt;
 #include &lt;sys/syscall.h&gt;
 int main()
  {
     pid_t child;
     const int long_size = sizeof(long);
     child = fork();
      if(child == 0) {
         ptrace(PTRACE_TRACEME, 0, NULL, NULL);
         execl(\"./dummy1\", \"dummy1\", NULL);
     }
      else {
         int status;
          union u {
             long val;
             char chars[long_size];
         }data;
         struct user_regs_struct regs;
         int start = 0;
         long ins;
          while(1) {
             wait(&status);
             if(WIFEXITED(status))
                 break;
             ptrace(PTRACE_GETREGS,
                    child, NULL, &regs);
              if(start == 1) {
                 ins = ptrace(PTRACE_PEEKTEXT,
                              child, regs.eip,
                              NULL);
                 printf(\"EIP: %lx Instruction \"
                        \"executed: %lx \",
                        regs.eip, ins);
             }
              if(regs.orig_eax == SYS_write) {
                 start = 1;
                 ptrace(PTRACE_SINGLESTEP, child,
                        NULL, NULL);
             }
             else
                 ptrace(PTRACE_SYSCALL, child,
                        NULL, NULL);
         }
     }
     return 0;
 }
程序的输出是这样的：
你可能需要察看Intel的用户手册来了解这些指令代码的意思。
更复杂的单步，比如设置断点，则需要很仔细的设计和更复杂的代码才可以实现。
在第二部分，我们将会看到如何在程序中加入断点，以及将代码插入到已经在运行的程序中
</pre></font>");
echo ("<a name=p002></a><center><font color=#ff0000 size=5>玩转ptrace(二)</font></center>");
echo ("<font color=#0000ff size=3><pre>
by Pradeep Padala
Created 2002-11-01 02:00
翻译: Magic.D
 
在第一部分中我们已经看到ptrace怎么获取子进程的系统调用以及改变系统调用的参数。在这篇文章中，我们将要研究如何在子进程中设置断点和往运行中
的程序里插入代码。实际上调试器就是用这种方法来设置断点和执行调试句柄。与前面一样，这里的所有代码都是针对i386平台的。
附着在进程上
在第一部分钟，我们使用ptrace(PTRACE_TRACEME,…)来跟踪一个子进程，如果你只是想要看进程是怎么进行系统调用和跟踪程序的，这个做法是不错的。
但如果你要对运行中的进程进行调试，则需要使用 ptrace( PTRACE_ATTACH, ….)
当 ptrace( PTRACE_ATTACH, …)在被调用的时候传入了子进程的pid时， 它大体是与ptrace( PTRACE_TRACEME,…)的行为相同的，它会向子进程发送
SIGSTOP信号,于是我们可以察看和修改子进程，然后使用 ptrace( PTRACE_DETACH, …)来使子进程继续运行下去。 
下面是调试程序的一个简单例子

int main()
{
   int i;
    for(i = 0;i &lt; 10; ++i) {
        printf(\"My counter: %d \", i);
        sleep(2);
    }
    return 0;
}

将上面的代码保存为dummy2.c。按下面的方法编译运行：

gcc -o dummy2 dummy2.c
./dummy2 &
 

现在我们可以用下面的代码来附着到dummy2上。

 

#include &lt;sys/ptrace.h&gt;
#include &lt;sys/types.h&gt;
#include &lt;sys/wait.h&gt;
#include &lt;unistd.h&gt;
#include &lt;linux/user.h&gt; /**//* For user_regs_struct
                             etc. */
int main(int argc, char *argv[])
{
    pid_t traced_process;
    struct user_regs_struct regs;
    long ins;
    if(argc != 2) ...{
        printf(\"Usage: %s &lt;pid to be traced&gt; \",
               argv[0], argv[1]);
        exit(1);
    }
    traced_process = atoi(argv[1]);
    ptrace(PTRACE_ATTACH, traced_process,
           NULL, NULL);
    wait(NULL);
    ptrace(PTRACE_GETREGS, traced_process,
           NULL, &regs);
    ins = ptrace(PTRACE_PEEKTEXT, traced_process,
                 regs.eip, NULL);
    printf(\"EIP: %lx Instruction executed: %lx \",
           regs.eip, ins);
    ptrace(PTRACE_DETACH, traced_process,
           NULL, NULL);
    return 0;
}

上面的程序仅仅是附着在子进程上，等待它结束，并测量它的eip( 指令指针)然后释放子进程。 
设置断点 
调试器是怎么设置断点的呢？通常是将当前将要执行的指令替换成trap指令，于是被调试的程序就会在这里停滞，这时调试器就可以察看被调试程序的信息了。
被调试程序恢复运行以后调试器会把原指令再放回来。这里是一个例子：
#include &lt;sys/ptrace.h&gt;
#include &lt;sys/types.h&gt;
#include &lt;sys/wait.h&gt;
#include &lt;unistd.h&gt;
#include &lt;linux/user.h&gt;

const int long_size = sizeof(long);

void getdata(pid_t child, long addr,
             char *str, int len)
{
    char *laddr;
    int i, j;
    union u ...{
            long val;
            char chars[long_size];
    }data;

    i = 0;
    j = len / long_size;
    laddr = str;

    while(i &lt; j) ...{
        data.val = ptrace(PTRACE_PEEKDATA, child,
                          addr + i * 4, NULL);
        memcpy(laddr, data.chars, long_size);
        ++i;
        laddr += long_size;
    }
    j = len % long_size;
    if(j != 0) ...{
        data.val = ptrace(PTRACE_PEEKDATA, child,
                          addr + i * 4, NULL);
        memcpy(laddr, data.chars, j);
    }
    str[len] = '';
}

void putdata(pid_t child, long addr,
             char *str, int len)
{
    char *laddr;
    int i, j;
    union u ...{
            long val;
            char chars[long_size];
    }data;

    i = 0;
    j = len / long_size;
    laddr = str;
    while(i &lt; j) ...{
        memcpy(data.chars, laddr, long_size);
        ptrace(PTRACE_POKEDATA, child,
               addr + i * 4, data.val);
        ++i;
        laddr += long_size;
    }
    j = len % long_size;
    if(j != 0) ...{
        memcpy(data.chars, laddr, j);
        ptrace(PTRACE_POKEDATA, child,
               addr + i * 4, data.val);
    }
}

int main(int argc, char *argv[])
{
    pid_t traced_process;
    struct user_regs_struct regs, newregs;
    long ins;
    /**//* int 0x80, int3 */
    char code[] = ...{0xcd,0x80,0xcc,0};
    char backup[4];
    if(argc != 2) ...{
        printf(\"Usage: %s &lt;pid to be traced&gt; \",
               argv[0], argv[1]);
        exit(1);
    }
    traced_process = atoi(argv[1]);
    ptrace(PTRACE_ATTACH, traced_process,
           NULL, NULL);
    wait(NULL);
    ptrace(PTRACE_GETREGS, traced_process,
           NULL, &regs);
    /**//* Copy instructions into a backup variable */
    getdata(traced_process, regs.eip, backup, 3);
    /**//* Put the breakpoint */
    putdata(traced_process, regs.eip, code, 3);
    /**//* Let the process continue and execute
       the int 3 instruction */
    ptrace(PTRACE_CONT, traced_process, NULL, NULL);
    wait(NULL);
    printf(\"The process stopped, putting back \"
           \"the original instructions \");
    printf(\"Press &lt;enter&gt; to continue \");
    getchar();
    putdata(traced_process, regs.eip, backup, 3);
    /**//* Setting the eip back to the original
       instruction to let the process continue */
    ptrace(PTRACE_SETREGS, traced_process,
           NULL, &regs);
    ptrace(PTRACE_DETACH, traced_process,
           NULL, NULL);
    return 0;

}

上面的程序将把三个byte的内容进行替换以执行trap指令，等被调试进程停滞以后，我们把原指令再替换回来并把eip修改为原来的值。下面的图中演示了指令
的执行过程
 1. 进程停滞后 	 2. 替换入trap指令
 3.断点成功，控制权交给了调试器 	 4. 继续运行，
将原指令替换回来并将eip复原在了解了断点的机制以后，往运行中的程序里面添加指令也不再是难事了，下面的代码会使原程序多出一个”hello world”的
输出这时一个简单的”hello world”程序，当然为了我们的特殊需要作了点修改：
void main()
{
__asm__(\"
         jmp forward
backward:
         popl %esi # Get the address of
                          # hello world string
         movl \$4, %eax # Do write system call
         movl \$2, %ebx
         movl %esi, %ecx
         movl \$12, %edx
         int \$0x80
         int3 # Breakpoint. Here the
                          # program will stop and
                          # give control back to
                          # the parent
forward:
         call backward
         .string \"Hello World\n\"\"
       );
}

使用 gcc –o hello hello.c来编译它。
在backward和forward之间的跳转是为了使程序能够找到”hello world” 字符串的地址。
使用GDB我们可以得到上面那段程序的机器码。启动GDB,然后对程序进行反汇编：

(gdb) disassemble main
Dump of assembler code for function main:
0x80483e0 &lt;main&gt;: push %ebp
0x80483e1 &lt;main+1&gt;: mov %esp,%ebp
0x80483e3 &lt;main+3&gt;: jmp 0x80483fa &lt;forward&gt;
End of assembler dump.
(gdb) disassemble forward
Dump of assembler code for function forward:
0x80483fa &lt;forward&gt;: call 0x80483e5 &lt;backward&gt;
0x80483ff &lt;forward+5&gt;: dec %eax
0x8048400 &lt;forward+6&gt;: gs
0x8048401 &lt;forward+7&gt;: insb (%dx),%es:(%edi)
0x8048402 &lt;forward+8&gt;: insb (%dx),%es:(%edi)
0x8048403 &lt;forward+9&gt;: outsl %ds:(%esi),(%dx)
0x8048404 &lt;forward+10&gt;: and %dl,0x6f(%edi)
0x8048407 &lt;forward+13&gt;: jb 0x8048475
0x8048409 &lt;forward+15&gt;: or %fs:(%eax),%al
0x804840c &lt;forward+18&gt;: mov %ebp,%esp
0x804840e &lt;forward+20&gt;: pop %ebp
0x804840f &lt;forward+21&gt;: ret
End of assembler dump.
(gdb) disassemble backward
Dump of assembler code for function backward:
0x80483e5 &lt;backward&gt;: pop %esi
0x80483e6 &lt;backward+1&gt;: mov \$0x4,%eax
0x80483eb &lt;backward+6&gt;: mov \$0x2,%ebx
0x80483f0 &lt;backward+11&gt;: mov %esi,%ecx
0x80483f2 &lt;backward+13&gt;: mov \$0xc,%edx
0x80483f7 &lt;backward+18&gt;: int \$0x80
0x80483f9 &lt;backward+20&gt;: int3
End of assembler dump.

我们需要使用从man+3到backward+20之间的字节码，总共41字节。使用GDB中的x命令来察看机器码。

 

(gdb) x/40bx main+3
&lt;main+3&gt;: eb 15 5e b8 04 00 00 00
&lt;backward+6&gt;: bb 02 00 00 00 89 f1 ba
&lt;backward+14&gt;: 0c 00 00 00 cd 80 cc
&lt;forward+1&gt;: e6 ff ff ff 48 65 6c 6c
&lt;forward+9&gt;: 6f 20 57 6f 72 6c 64 0a

已经有了我们想要执行的指令，还等什么呢？只管把它们根前面那个例子一样插入到被调试程序中去！ 

代码：

int main(int argc, char *argv[])
{
pid_t traced_process;
    struct user_regs_struct regs, newregs;
    long ins;
    int len = 41;
    char insertcode[] =
        \"\\xeb\\x15\\x5e\\xb8\\x04\\x00\"
        \"\\x00\\x00\\xbb\\x02\\x00\\x00\\x00\\x89\\xf1\\xba\"
        \"\\x0c\\x00\\x00\\x00\\xcd\\x80\\xcc\\xe8\\xe6\\xff\"
        \"\\xff\\xff\\x48\\x65\\x6c\\x6c\\x6f\\x20\\x57\\x6f\"
        \"\\x72\\x6c\\x64\\x0a\\x00\";
    char backup[len];
    if(argc != 2) ...{
        printf(\"Usage: %s &lt;pid to be traced&gt; \",
               argv[0], argv[1]);
        exit(1);
    }
    traced_process = atoi(argv[1]);
    ptrace(PTRACE_ATTACH, traced_process,
           NULL, NULL);
    wait(NULL);
    ptrace(PTRACE_GETREGS, traced_process,
           NULL, &regs);
    getdata(traced_process, regs.eip, backup, len);
    putdata(traced_process, regs.eip,
            insertcode, len);
    ptrace(PTRACE_SETREGS, traced_process,
           NULL, &regs);
    ptrace(PTRACE_CONT, traced_process,
           NULL, NULL);
    wait(NULL);
    printf(\"The process stopped, Putting back \"
           \"the original instructions \");
    putdata(traced_process, regs.eip, backup, len);
    ptrace(PTRACE_SETREGS, traced_process,
           NULL, &regs);
    printf(\"Letting it continue with \"
           \"original flow \");
    ptrace(PTRACE_DETACH, traced_process,
           NULL, NULL);
    return 0;
}

将代码插入到自由空间在前面的例子中我们将代码直接插入到了正在执行的指令流中，然而，调试器可能会被这种行为弄糊涂，所以我们决定把指令插入到进
程中的自由空间中去。通过察看/proc/pid/maps可以知道这个进程中自由空间的分布。接下来这个函数可以找到这个内存映射的起始点：
long freespaceaddr(pid_t pid)
{
    FILE *fp;
    char filename[30];
    char line[85];
    long addr;
    char str[20];
    sprintf(filename, \"/proc/%d/maps\", pid);
    fp = fopen(filename, \"r\");
    if(fp == NULL)
        exit(1);
    while(fgets(line, 85, fp) != NULL) ...{
        sscanf(line, \"%lx-%*lx %*s %*s %s\", &addr,
               str, str, str, str);
        if(strcmp(str, \"00:00\") == 0)
            break;
    }
    fclose(fp);
    return addr;
}


在/proc/pid/maps中的每一行都对应了进程中一段内存区域。主函数的代码如下：


int main(int argc, char *argv[])
{
    pid_t traced_process;
    struct user_regs_struct oldregs, regs;
    long ins;
    int len = 41;
    char insertcode[] =
        \"\\xeb\\x15\\x5e\\xb8\\x04\\x00\"
        \"\\x00\\x00\\xbb\\x02\\x00\\x00\\x00\\x89\\xf1\\xba\"
        \"\\x0c\\x00\\x00\\x00\\xcd\\x80\\xcc\\xe8\\xe6\\xff\"
        \"\\xff\\xff\\x48\\x65\\x6c\\x6c\\x6f\\x20\\x57\\x6f\"
        \"\\x72\\x6c\\x64\\x0a\\x00\";
    char backup[len];
    long addr;
    if(argc != 2) ...{
        printf(\"Usage: %s &lt;pid to be traced&gt; \",
               argv[0], argv[1]);
        exit(1);
    }
    traced_process = atoi(argv[1]);
    ptrace(PTRACE_ATTACH, traced_process,
           NULL, NULL);
    wait(NULL);
    ptrace(PTRACE_GETREGS, traced_process,
           NULL, &regs);
    addr = freespaceaddr(traced_process);
    getdata(traced_process, addr, backup, len);
    putdata(traced_process, addr, insertcode, len);
    memcpy(&oldregs, &regs, sizeof(regs));
    regs.eip = addr;
    ptrace(PTRACE_SETREGS, traced_process,
           NULL, &regs);
    ptrace(PTRACE_CONT, traced_process,
           NULL, NULL);
    wait(NULL);
    printf(\"The process stopped, Putting back \"
           \"the original instructions \");
    putdata(traced_process, addr, backup, len);
    ptrace(PTRACE_SETREGS, traced_process,
           NULL, &oldregs);
    printf(\"Letting it continue with \"
           \"original flow \");
    ptrace(PTRACE_DETACH, traced_process,
           NULL, NULL);
    return 0;
}

ptrace的幕后工作

那么，在使用ptrace的时候，内核里发生了声么呢？这里有一段简要的说明：当一个进程调用了 ptrace( PTRACE_TRACEME,…)之后，内核为该进
程设置了一个标记，注明该进程将被跟踪。内核中的相关原代码如下：

Source: arch/i386/kernel/ptrace.c
if (request == PTRACE_TRACEME) {
    /* are we already being traced? */
    if (current-&gt;ptrace & PT_PTRACED)
        goto out;
    /* set the ptrace bit in the process flags. */
    current-&gt;ptrace |= PT_PTRACED;
    ret = 0;
    goto out;
}

一次系统调用完成之后，内核察看那个标记，然后执行trace系统调用（如果这个进程正处于被跟踪状态的话）。其汇编的细节可以在
 arh/i386/kernel/entry.S中找到。现在让我们来看看这个sys_trace()函数（位于 arch/i386/kernel/ptrace.c）。它停止子进程，然后发送一个信号
给父进程，告诉它子进程已经停滞，这个信号会激活正处于等待状态的父进程，让父进程进行相关处理。父进程在完成相关操作以后就调用
ptrace( PTRACE_CONT, …)或者 ptrace( PTRACE_SYSCALL, …), 这将唤醒子进程，内核此时所作的是调用一个叫wake_up_process()
的进程调度函数。其他的一些系统架构可能会通过发送SIGCHLD给子进程来达到这个目的。 
小结：
ptrace函数可能会让人们觉得很奇特，因为它居然可以检测和修改一个运行中的程序。这种技术主要是在调试器和系统调用跟踪程序中使用。它使程序
员可以在用户级别做更多有意思的事情。已经有过很多在用户级别下扩展操作系统得尝试，比如UFO,一个用户级别的文件系统扩展，它使用ptrace来实
现一些安全机制。
作者: Pradeep Padala,
</pre></font>");
echo ("<a name=p003></a><center><font color=#ff0000 size=5>关于O_EXCL的说明</font></center>");
echo ("<pre>
	在使用open函数建立或打开文件时旗标O_EXCL经常于O_CREAT一起配合使用。但是如果我们仅仅需要打开某个文件并且在该文件
不存在的时候才新建立的时候，就不要使用O_EXCL旗标了，因为他会先于文件操作前检查文件是否存在，只有在文件不存在的时候才能使
本次的open操作成功。
</pre>");
echo ("<a name=p004></a><center><font color=#ffff00 size=5>mkdir函数应用</font></center>");
echo ("<pre>
原型：int mkdir (const char *filename, mode_t mode)

返回0表示成功，返回-1表述出错。使用该函数需要包含头文件sys/stat.h
mode 表示新目录的权限，可以取以下值：

S_IRUSR
S_IREAD
Read permission bit for the owner of the file. On many systems this bit is 0400. S_IREAD is an obsolete synonym provided for BSD compatibility.

S_IWUSR
S_IWRITE
Write permission bit for the owner of the file. Usually 0200. S_IWRITE is an obsolete synonym provided for BSD compatibility.

S_IXUSR
S_IEXEC
Execute (for ordinary files) or search (for directories) permission bit for the owner of the file. Usually 0100. S_IEXEC is an obsolete synonym provided for BSD compatibility.

S_IRWXU
This is equivalent to (S_IRUSR | S_IWUSR | S_IXUSR).

S_IRGRP
Read permission bit for the group owner of the file. Usually 040.

S_IWGRP
Write permission bit for the group owner of the file. Usually 020.

S_IXGRP
Execute or search permission bit for the group owner of the file. Usually 010.

S_IRWXG
This is equivalent to (S_IRGRP | S_IWGRP | S_IXGRP).

S_IROTH
Read permission bit for other users. Usually 04.

S_IWOTH
Write permission bit for other users. Usually 02.

S_IXOTH
Execute or search permission bit for other users. Usually 01.

S_IRWXO
This is equivalent to (S_IROTH | S_IWOTH | S_IXOTH).

S_ISUID
This is the set-user-ID on execute bit, usually 04000. See How Change Persona.

S_ISGID
This is the set-group-ID on execute bit, usually 02000. See How Change Persona.

S_ISVTX
This is the sticky bit, usually 01000.
</pre>");
echo ("<a name=p005></a><center><font color=#ff0000 size=5>让printf丰富多彩</font></center>");
echo ("<font color=blue><pre>
看个例子:
int main(int argc,char **argv)
{
        printf(\"\\033[44;37;5m hello world\\033[0m\\n\");
        return 0;
}
该段代码编译运行后显示的是蓝色背景，白色闪烁字的效果。
解释下特殊字符的使用及定义：
“\\033”引导非常规字符序列。“m”意味着设置属性然后结束非常规字符序列
“44;37;5”为蓝色，前景白色，闪烁光标的特殊字符代码。具体如下：
编码    颜色/动作
0       重新设置属性到缺省设置
1       设置粗体
2       设置一半亮度（模拟彩色显示器的颜色）
4       设置下划线（模拟彩色显示器的颜色）
5       设置闪烁
7       设置反向图象
22      设置一般密度
24      关闭下划线
25      关闭闪烁
27      关闭反向图象
30      设置黑色前景
31      设置红色前景
32      设置绿色前景
33      设置棕色前景
34      设置蓝色前景
35      设置紫色前景
36      设置青色前景
37      设置白色前景
38      在缺省的前景颜色上设置下划线
39      在缺省的前景颜色上关闭下划线
40      设置黑色背景
41      设置红色背景
42      设置绿色背景
43      设置棕色背景
44      设置蓝色背景
45      设置紫色背景
46      设置青色背景
47      设置白色背景
49      设置缺省黑色背景
其他有趣的代码还有：
\\033[2J         　清除屏幕
\\033[0q         　关闭所有的键盘指示灯
\\033[1q         　设置“滚动锁定”指示灯 (Scroll Lock)
\\033[2q         　设置“数值锁定”指示灯 (Num Lock)
\\033[3q         　设置“大写锁定”指示灯 (Caps Lock)
\\033[15:40H     把关闭移动到第15行，40列
\\007            　　发蜂鸣生beep
world后面的\\033[0m为恢复你默认设定，不然你的shell在运行该代码后，将修改你默认的设定
</pre></font>");
echo ("<a name=p006></a><center><font color=#ff0000 size=5>转：C语言中几个重要的概念</font></center>");
echo "<font color=blue><pre>
C语言中的几个重要概念 2007-05-10 09:48:27

分类： C/C++

一、C语言的指针
1.指针说明
　指针是包含另一变量的地址变量。
　　(1)int *p
　　　p是一个指针，指向一个整形数。
　　(2)int *p()
　　　p是一个函数，该函数返回一个指向整数的指针。
　　(3)int (*p)()
　　　p是一个指针，该指针指向一个函数，这个函数返回一个整数。
　　(4)int *p[]
　　　p是一个数组，该数组的每一个元素是指向整数的指针。
　　(5)int (*p)[]
　　　p是一个指针，该指针指向一个数组，这个数组的每一个元素是一个整数。
　　(6)int *(*p)()
　　　p是一个指针，该指针指向一个函数，这个函数返回一个指向整数的指针。
2.指针的初始化（赋地址）
　　(1)通过符号&取变量（包括结构变量、数组第一个元素）的地址赋给指针；
　　(2)把数组名赋给指针；
　　(3)把函数名赋给指向函数的指针；
　　(4)动态分配内存
　　　例：struct c{double r,i;};
　　　　　struct c *p;
　　　　　p=(struct c *)malloc(sizeof(struct c));
3.指针与数组、函数的关系
　(1)对于一维数组 int a[i] 或指针 int *a
　　a+i 指向 a[i]
　(2)对于字符串 char s[i] 或指针 char *s
　　s+i 指向第 i个字符 s[i]
　(3)对于二维数组int a[i][j]
　　*a+j 指向 a[0][j]
　　*(a+i) 指向 a[i][0]
　　*(a+i)+j 指向 a[i][j]
　　例：对于 a[2][3]={1,2,3,4,5,6,}; 有 *(*(a+1)+1)=5;
　(4)对于字符串数组char p[i][j] 或字符型指针数组char *p[i]
　　*p+j 指向第 0个字符串的第 j个字符
　　*(p+i) 指向第 i个字符串的第 0个字符
　　*(p+i)+j 指向第 i个字符串的第 j个字符
　　例：对于 *p[]={\"ABC\",\"DEF\"}; 有 *(*(p+1)+1)='E';
　　例：对于 char p[][3]={\"ABC\",\"DEF\"}; 有 *(*(p+1)+1)='E';
　(5)对于指针数组int *a[i]
　　a[i] 指向 变量i
　　即 *a[i]=变量i 或 a[i]=&变量i
　(6)对于结构struct XY
　　{int x;int *y}*p;
　　p是指向结构XY的指针
　　(*p).x 或 p->x 是表示 x 的内容
　　(*p).y 或 p->y 是表示指针 y 的值（地址）
　　*(*p).y 或 *p->y 是表示 y 所指的内容
　　&(*p).x 或 &p->x 是表示 x 的地址
　(7)指向函数的指针
　　对于 void func(char *str)
　　　　　　　{…}; //定义了一个函数
　　　　　　void (*p)(char*);//定义了一个函数指针
　　　　　　p=func; //让指针指向函数
　　则(*p)(\"…\"); //用指针p可以调用函数func
　(8)指向多个不同函数的指针数组
　　对于void function_1() {…};
　　　　…
　　　　void function_4() {…}; //定义了四个函数
　　　　typedef void(*menu_fcn)();//定义了指向函数的指针
　　　　menu_fcn command[4]; //定义了指针数组
　　　　command[0]=function_1;
　　　　…
　　　　command[3]=function_4; //让指针数组指向四个函数
　　则command[0](); //用指针数组中的一个元素调用一个函数
4.指针的分类
　(1)近指针（near）：
　　近指针为16位指针，它只含有地址的偏移量部分。近指针用于不超过64K 字节的单个数据段或代码段。在微、小和中编译模式下产生的数据指针是近指针（缺省状态）；在微、小和中编译模式下产生的码指针（指向函数的指针）是近指针（缺省状态）。
　(2)远指针（far）
　　远指针为32位指针，指针的段地址和偏移量都在指针内。可用于任意编译模式。每次使用远指针时都要重装段寄存器。远指针可寻址的目标不能超过64K ，因为远指针增减运算时，段地址不参与运算。在紧凑、大和巨模式下编译产生的数据指针是远指针（缺省状态）。
　(3)巨指针（huge）
　　巨指针为32位指针，指针的段地址和偏移量都在指针内。可用于任意编译模式。远指针寻址的目标可以超过64K 。巨指针是规则化的指针。
5.指针的转换
　(1)远指针转换成巨指针
　　使用以下函数
　　void normalize(void far * * p)
　　　{
　　　*p=(void far *)(((long)*p&0xffff000f)+(((long)*p&0x0000fff00<<12));
　　　}
6.指针的使用
　(1)将浮点数转换成二进制数
　　float ff=16.5;
　　unsigned char *cc;
　　(float*)cc=&ff;
　　//此时cc的内容为\"00008441\"
　　//即cc第一个字节=0；第二个字节=0；第三个字节=0x84；第四个字节=0x41；
　(2)将二进制数转换成浮点数
　　float ff;
　　unsigned char *cc;
　　cc=(unsigned char*)malloc(4);
　　cc=(unsigned char*)&ff;
　　*(cc+0)=0;
　　*(cc+1)=0;
　　*(cc+2)=0x84;
　　*(cc+3)=0x41;
　　//此时ff=16.5
　　free(cc);


二、C 语言的函数
1.用户自定义函数格式
　　类型 函数名（形式参数表）
　　参数说明
　　　{
　　　……
　　　}
2.函数的调用方式
　(1)传值方式
　　①传给被调用函数的是整型、长整型、浮点型或双精度型变量。被调用的函数得定义相应的变量为形参。
　　②传给被调用函数的是结构变量。被调用函数得定义结构变量为形参。
　　③传给被调用函数的是结构变量的成员。被调用函数得定义与该成员同类的变量为形参。
　（2）传址方式
　　①传给被调用函数的是变量的地址。被调用函数得定义指针变量为形参。
　　②传给被调用函数的是数组的地址即数组名。被调用的函数得定义数组或指针变量为形参。
　　③传给被调用函数的是函数的地址即函数名称。被调用函数得定义指向函数的指针变量为形参。
　　④传给被调用函数的是结构的地址。被调用函数得定义结构指针为形参。
3.函数调用(传值方式)结果的返回
　(1)返回的是数值
　　 要求被调用的函数类型与接收返回值的变量类型相同。
　(2)返回的是指针
　　 要求被调用的函数是指针函数，其指向的类型与接收的指针变量指向类型相同。
　(3)不返回任何值
　　 被调用的函数是void型。


三、C 语言的信息压缩法
1.使用位运算符
　　要把 5个数据的值压缩到一个字（16位）中，假定其中三个（f1、f2、f3）是标记（真或伪）各占一位；第四个是叫type的整数，其取值范围为 1到12，需要 4位的存储器；最后一个叫作index 的整数，其取值范围为从 0到 500，需占 9位。为此定义一个整型变量：unsigned int packed_data，可包含此 5个值。下图是位域分配。
　　　　　　　　　　　　type　　　　index
　　　　　　　　f1f2f3┌──┐┌───────┐
　　　　　　　 ┌┬┬┬┬┬┬┬┬┬┬┬┬┬┬┬┐
　　　　　　　 └┴┴┴┴┴┴┴┴┴┴┴┴┴┴┴┘
　　把 n的 4个低位的值置入packed_data 的type域中，用下面的语句：
packed_data=(packed_data & ~(0xf<<9))|((n&0xf)<<9);
其中位或符号|左边是将type域置 0，右边是取 n的低 4位后左移9 位到type域中。
　　从packed_data 的type域中提取数值并把它赋予 n的语句是：
n=(packed_data>>9) & 0xf;
2.使用位域结构
　(1)定义一个叫做 packed_struct的结构，含有 5个成员
　　struct packed_struct
　　　{
　　　unsigned int f1:1
　　　unsigned int f2:1;
　　　unsigned int f3:1;
　　　unsigned int type:4;
　　　unsigned int index:9;
　　　};
　　（注：在结构中还可以放入普通数据类型，如char c;等）
　(2)定义一个变量
　　struct packed_struct packed_data;
　(3)把packed_data 的type 域置于n的低位，用语句
　　　packed_data.type=n;
　(4)从packed_data 中提取type域（按要求，把它移到低位），并把它赋予 n，用语句
　　　n=packed_data.type;
3.使用联合
　(1)一个无符号整型数与一个结构（其中包含许多无符号变量）共用一存储区，当无符号整型数被赋值后，可通过结构变量获得各位的值。
　　例如，定义一个联合
　　union {
　　unsigned equi;
　　struct {
　　　unsigned boot :1;
　　　unsigned copr :1;
　　　unsigned rsize:2;
　　　unsigned vmode:2;
　　　unsigned dnum :2;
　　　unsigned 　　 :1;
　　　unsigned cnum :3;
　　　unsigned gnum :1;
　　　unsigned 　　 :1;
　　　unsigned pnum :2;
　　　}beq;
　　}eq;
　　当调用BIOS INT 11H中断后，将AX的值赋给eq.equi，就可以从eq.beq.boot得到PC机有无系统盘的信息；从eq.beq.copr得到PC机有无浮点运算部件的信息。......
　(2)两个结构共享同一存储区域
　　例如：union REGS
　　struct WORDREGS{unsigned int ax,bx,cx,dx,si,di,cflag,flags};
　　struct BYTEREGS{unsigned char al,ah,bl,bh,cl,ch,dl,dh};
　　union REGS {struct WORDREGS x;struct BYTEREGS h;}


四 、位运算
1.数的编码—补码
　(1).正数的补码与原码同。
　(2).负数的补码为
　　①第一位（符号位）为 1；
　　②剩余原码位数逐位取反；
　　③然后对整个数加 1。
2.位逻辑运算的特殊用途
　(1).取一个数中的某些字节
　　例　a & 0x00ff得到a的低字节，a & 0xff00得到a的高字节。
　　　┌─┬───┬────┬────────┐
　　　│数│十进制│十六进制│　　　补码　　　│
　　　├─┼───┼────┼────────┤
　　　│ a│　　　│0x2cac　│0010110010101100│
　　　│　│　　　│0x00ff　│0000000011111111│
　　　├─┴───┼────┼────────┤
　　　│ 按位与　 │ ox00ac │0000000010101100│
　　　│ 运算结果 │　　　　│　　　　　　　　│
　　　└─────┴────┴────────┘
　(2).将一个数的某些特定位置1
　　例　a | 0x0f使a的低4位改为1。
　　　┌─┬───┬────┬────────┐
　　　│数│　　　│十六进制│　　　补码　　　│
　　　├─┼───┼────┼────────┤
　　　│a │　　　│0x0030　│0000000000110000│
　　　│　│　　　│0x000f　│0000000000001111│
　　　├─┴───┼────┼────────┤
　　　│按位或　　│　　　　│0000000000111111│
　　　│运算结果　│　　　　│　　　　　　　　│
　　　└─────┴────┴────────┘
　(3).将某数特定位置翻转
　　例　a ^ 0x000f使a的低4位翻转（0变1；1变0）。
　　　┌─┬───┬────┬────────┐
　　　│数│　　　│十六进制│　　　补码　　　│
　　　├─┼───┼────┼────────┤
　　　│a │　　　│ 0x007a │0000000001111010│
　　　│　│　　　│ 0x000f │0000000000001111│
　　　├─┴───┼────┼────────┤
　　　│ 按位异或 │　　　　│0000000001110101│
　　　│ 运算结果 │　　　　│　　　　　　　　│
　　　└─────┴────┴────────┘
　(4)将a的右起第2位反向变化(1变0,0变1)
　　a=a^0x02;//(0x02=00000010),异或的意义是\"同值为0\"
　(5).将两个数（整型数）的值互换
　　例　a=a^b;b=b^a;a=a^b; //三步使得a、b的值互换
3.移位运算的特殊用途
　(1).将某数除以2（右移1位）
　　例　a>>2 使得a被4除
　　　①对于 signed a=-8,a>>2
　　　　　　　　　　　a=-8
　　　　┌─┬─┬─┬─┬─┬─┬─┬─┐
　　　　│1 │1 │1 │1 │1 │0 │0 │0 │
　　　　└─┴─┴─┴─┴─┴─┴─┴─┘
　　　　　├─┬─┐　──>　　└───┐
　　　　┌─┬─┬─┬─┬─┬─┬─┬─┐
　　　　│1 │1 │1 │1 │1 │1 │1 │0 │
　　　　└─┴─┴─┴─┴─┴─┴─┴─┘
　　　　　　　　　　　a=-2
　　　②对于unsigned a=248,a>>2　　　　
　　　　　　　　　　　a=248
　　　　┌─┬─┬─┬─┬─┬─┬─┬─┐
　　　　│1 │1 │1 │1 │1 │0 │0 │0 │
　　　　└─┴─┴─┴─┴─┴─┴─┴─┘
　　　　　└───┐ ──> └───┐
　　　　┌─┬─┬─┬─┬─┬─┬─┬─┐
　　　　│0 │0 │1 │1 │1 │1 │1 │0 │
　　　　└─┴─┴─┴─┴─┴─┴─┴─┘
　 补0──┴─┘　　　　a=62
　(2).将某数乘以2（左移1位）
　　注　左移时signed 与unsigned变量的情况一样，均要补0。
　(3)将x的右起第n(n>=0)位置0
　　x&=~(1《n); 若x是long,则x&=~((long)1《n);
　(4)将x的右起第n(n>=0)位置1
　　x|=1《n;
　　若x是长整形数则 x|=(long)1《n;


五、C语言访问CPU寄存器的方法
　1.使用联合REGS,和函数 int86() / int86x() / intr()
　　REGS是用来在进行 DOS软中断调用时向各个寄存器传输数据或从各个寄存器取出返回值。
　　　　　　　　　　　union REGS 示意图
　　　　　　　　 struct　　　　　struct
　　　　　　　　WORDREGS　　　　BYTEREGS
　　　 ┌　 ┌───────┬──────┐──┬──　 ┐
　　　 │　 │　　　　　　　│　　 al　　 │ 1 byte　　　│
　　　 │　 │　　　ax　　　├──────┤──┴─ 2 bytes
　　　 │　 │　　　　　　　│　　 ah　　 │　　　　　　 │
　　　 │　 ├───────┼──────┤─────　 ┘
　　　 │　 │　　　　　　　│　　 bl　　 │
　　　 │　 │　　　bx　　　├──────┤
　　　 │　 │　　　　　　　│　　 bh　　 │
　　　 │　 ├───────┼──────┤
　　　 │　 │　　　　　　　│　　 cl　　 │
　　　 │　 │　　　cx　　　├──────┤
　　　 │　 │　　　　　　　│　　 ch　　 │
　　　 │　 ├───────┼──────┤
　　　 │　 │　　　　　　　│　　 dl　　 │
　　　 │　 │　　　dx　　　├──────┤
　　　 │　 │　　　　　　　│　　 dh　　 │
　union regs├───────┼──────┤
　　　 │　 │　　　　　　　│　　　　　　│
　　　 │　 │　　　si　　　│　　　　　　│
　　　 │　 │　　　　　　　│　　　　　　│
　　　 │　 ├───────┤　　　　　　│
　　　 │　 │　　　　　　　│　　　　　　│
　　　 │　 │　　　di　　　│　　　　　　│
　　　 │　 │　　　　　　　│　　　　　　│
　　　 │　 ├───────┤　　　　　　│
　　　 │　 │　　　　　　　│　　　　　　│
　　　 │　 │　　cflag　　 │　　　　　　│
　　　 │　 │　　　　　　　│　　　　　　│
　　　 │　 ├───────┤　　　　　　│
　　　 │　 │　　　　　　　│　　　　　　│
　　　 │　 │　　flags　　 │　　　　　　│
　　　 │　 │　　　　　　　│　　　　　　│
　　　 └　 └───────┴──────┘
　　　　　　│　　　x　两个结构变量　h　　│
　　　　　　└──　　共享同一存储域　──┘
　2.使用伪变量和函数geninterrupt()
　　Turbo C 允许使用伪变量直接访问相应的8086寄存器。伪变量的类型有两种。
① unsigned int : _AX、 _BX、 _CX、 _DX、 _CS、 _DS、 _SS、 _ES、 _SP、 _BP、 _DI、 _SI
② unsigned char: _AL、 _AH、 _BL、 _BH、 _CL、 _CH、 _DL、 _DH


六、C语言使用内存和寄存器的方法
　1.段和段寄存器
　　CS用来存放代码段的段地址；DS用来存放全局变量和静态变量所在段（数据段）的段地址；SS用来存放局部变量，参数所在段（堆栈）的段地址。 此外，还有堆段，是动态分配的内存。
　2.微模式编译时段的使用情况
　　只有一个段，从底往高依此装入代码，静态变量和全局变量，堆。从高往低装入堆栈。
　3.小模式编译时段的使用情况
　　数据、堆栈和近堆共用一个段，代码用一个段，还有一个远堆（用far指针存取）。
　4.中模式编译时段的使用情况
　　中模式有多个代码段，其余与小模式一样。函数指针用far指针。
　5.紧凑模式编译时段的使用情况
　　代码，静态数据，堆栈，堆（只有远堆）各有自己的段。静态数据的总量不得超过64K。
　6.大模式编译时段的使用情况
　　静态数据，堆，堆栈的分配与紧凑模式一样；代码段的分配与中模式一样。数据指针和函数指针都是远指针。静态数据的总量不得超过64K。
　7.巨模式编译时段的使用情况
　　来自不同源文件的代码放在不同的段内，来自不同源文件的静态数据也放在不同的段内，只有堆栈是合在一起的。
　8.运行库函数分配的内存：
　　　　常规内存区
　　 远堆（数据段之外） 用_fmalloc()分配，得到32位指针
　├─────────┤
64│堆（未使用的内存）│用malloc()分配，得到16位的位移地址
KB├─────────┤
数│　栈（局部变量）　│
据├─────────┤
段│　全局和静态变量　│
　├─────────┤

七、用C语言写中断服务程序（如果中断服务程序不牵涉到中断链以及 DOS和其本身的重入问题。） ---Turbo C
　1.函数类型为interrupt 的中断服务程序定义如下：
　　#include
　　void interrupt 函数名(bp,di,si,ds,es,dx,cx,bx,ax,ip,cs,flags);
　　unsigned int bp,di,si,ds,es,dx,cx,bx,ax,ip,cs,flags;
　2.得先保留原中断函数地址
　　void interrupt (*保留函数名)( );
　　保留函数名=getvect(0x中断号);
　3.在main函数中用自定义的中断服务程序替换原来的程序
　　setvect(0x中断号,函数名);
　4.在main函数中激活自定义的中断服务程序
　　(1)先设置要用到的寄存器的值（用伪变量），
　　(2)geninterrupt(0x中断号);
　　若替换的是计时中断程序，因PC机内的计时器每秒产生18.2次中断，则每秒自动执行18.2次新的中断程序。
　5.事后得将原中断函数地址装回向量表中
　　setvect(0x中断号，保留函数名);
</font></pre>";
?>



