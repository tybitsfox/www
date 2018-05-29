<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo ("<center><font size=5 color=#ff0000>linux asm 系统调用</font></center>");
echo ("<font color=#ff00ff size=5><pre>

即便是最简单的汇编程序，也难免要用到诸如输入、输出以及退出等操作，而要进行这些操作则需要调用操作系统所提供的服务，也就是系统调用
。除非你的程序只完成加减乘除等数学运算，否则将很难避免使用系统调用，事实上除了系统调用不同之外，各种操作系统的汇编编程往往都是
很类似的。

在 Linux 平台下有两种方式来使用系统调用：利用封装后的 C
库（libc）或者通过汇编直接调用。其中通过汇编语言来直接调用系统调用，是最高效地使用 Linux
内核服务的方法，因为最终生成的程序不需要与任何库进行链接，而是直接和内核通信。

和 DOS 一样，Linux 下的系统调用也是通过中断（int 0x80）来实现的。在执行 int 80 指令时，寄存器 eax
中存放的是系统调用的功能号，而传给系统调用的参数则必须按顺序放到寄存器 ebx，ecx，edx，esi，edi
中，当系统调用完成之后，返回值可以在寄存器 eax 中获得。

所有的系统调用功能号都可以在文件 /usr/include/bits/syscall.h 中找到，为了便于使用，它们是用 SYS_<name> 这样的宏来定义的，如 
SYS_write、SYS_exit 等。例如，经常用到的 write 函数是如下定义的：

ssize_t write(int fd, const void *buf, size_t count);

该函数的功能最终是通过 SYS_write 这一系统调用来实现的。根据上面的约定，参数 fb、buf 和 count 分别存在寄存器 ebx、ecx 和 edx 
中，而系统调用号 SYS_write 则放在寄存器 eax 中，当 int 0x80 指令执行完毕后，返回值可以从寄存器 eax 中获得。

或许你已经发现，在进行系统调用时至多只有 5 个寄存器能够用来保存参数，难道所有系统调用的参数个数都不超过 5 吗？当然不是，例如 
mmap 函数就有 6 个参数，这些参数最后都需要传递给系统调用 SYS_mmap：

void  *  mmap(void *start, size_t length, int prot , int flags, int fd, off_t offset);


当一个系统调用所需的参数个数大于 5 时，执行int 0x80 指令时仍需将系统调用功能号保存在寄存器 eax
中，所不同的只是全部参数应该依次放在一块连续的内存区域里，同时在寄存器 ebx中保存指向该内存区域的指针。
系统调用完成之后，返回值仍将保存在寄存器 eax 中。

由于只是需要一块连续的内存区域来保存系统调用的参数，因此完全可以像普通的函数调用一样使用栈(stack)来传递系统调用所需的参数。
但要注意一点，Linux 采用的是 C 语言的调用模式，这就意味着所有参数必须以相反的顺序进栈，即最后一个参数先入栈，而第一个参数
则最后入栈。如果采用栈来传递系统调用所需的参数，在执行 int 0x80 指令时还应该将栈指针的当前值复制到寄存器 ebx中。

</pre></font>");
?>
