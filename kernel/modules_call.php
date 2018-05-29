<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<font color=blue size=4><pre>
Linux 2.6版内核中通过模块获取sys_call_table地址的方法
本文主要介绍在Linux 2.6版的内核中实现基地址修改的方法。所有代码我都在基于2.6.19版内核的Fedora Core 6上进行了测试。

Linux 2.6版的内核出于安全的考虑没有将系统调用列表基地址的符号sys_call_table导出，但要对系统调用进行替换，却必须要
获取该地址，于是就有了这篇文章。
我在这里采用的基本思路是这样的，因为系统调用都是通过0x80中断来进行的，故可以通过查找0x80中断的处理程序来获得 sys_call_table
的地址。其基本步骤是，首先获取中断描述符表的地址，再从中查找0x80中断的服务例程，再搜索该例程的内存空间，以从其中获取
sys_call_table的地址。其代码如下：

#include &lt;linux/module.h&gt;
#include &lt;linux/kernel.h&gt;

// 中断描述符表寄存器结构
struct {
   unsigned short limit;
   unsigned int base;
} __attribute__((packed)) idtr;


// 中断描述符表结构
struct {
   unsigned short off1;
   unsigned short sel;
   unsigned char none, flags;
   unsigned short off2;
} __attribute__((packed)) idt;

// 查找sys_call_table的地址
void disp_sys_call_table(void)
{
   unsigned int sys_call_off;
   unsigned int sys_call_table;
   char* p;
   int i;";
echo "   // 获取中断描述符表寄存器的地址
   asm(\"sidt %0\":\"=m\"(idtr));
   printk(\"addr of idtr: %x\\n\", &idtr);

   // 获取0x80中断处理程序的地址
   memcpy(&idt, idtr.base+8*0x80, sizeof(idt));
   sys_call_off=((idt.off2&lt;&lt;16)|idt.off1);
   printk(\"addr of idt 0x80: %x\\n\", sys_call_off);

   // 从0x80中断服务例程中搜索sys_call_table的地址
   p=sys_call_off;
   for (i=0; i&lt;100; i++)
   {
      if (p=='\\xff' && p[i+1]=='\\x14' && p[i+2]=='\\x85')
      {
             sys_call_table=*(unsigned int*)(p+i+3);
             printk(\"addr of sys_call_table: %x\\n\", sys_call_table);
             return ;
      }
   }
}

// 模块载入时被调用
static int __init init_get_sys_call_table(void)
{
   disp_sys_call_table();
   return 0;
}

module_init(init_get_sys_call_table);

// 模块卸载时被调用
static void __exit exit_get_sys_call_table(void)";
echo "{
}

module_exit(exit_get_sys_call_table);

// 模块信息
MODULE_LICENSE(\"GPL2.0\");
MODULE_AUTHOR(\"Xizhi Zhu\");

在编译并载入该模块后，可以通过dmesg命令看到如下的输出：
addr of idtr: d0af4680
addr of idt 0x80: c0103e04
addr of sys_call_table: c03094c0

可见，上面的程序能够获取sys_call_table的地址。
在上面的代码中，最复杂的应该就是从0x80中断的服务例程中搜索sys_call_table的一段了，现解释如下。
首先，我们使用命令“gdb -q /usr/src/kernels/2.6.19/vmlinux”来反编译内核，再使用“disass system_call”和
“disass syscall_call”两条gdb命令来查看内核的汇编代码，其结果如下：

(gdb) disass system_call
Dump of assembler code for function system_call:
0xc0103e04 &lt;system_call+0&gt;: push %eax
0xc0103e05 &lt;system_call+1&gt;: cld
0xc0103e06 &lt;system_call+2&gt;: push %es
0xc0103e07 &lt;system_call+3&gt;: push %ds
0xc0103e08 &lt;system_call+4&gt;: push %eax
0xc0103e09 &lt;system_call+5&gt;: push %ebp
0xc0103e0a &lt;system_call+6&gt;: push %edi
0xc0103e0b &lt;system_call+7&gt;: push %esi
0xc0103e0c &lt;system_call+8&gt;: push %edx
0xc0103e0d &lt;system_call+9&gt;: push %ecx
0xc0103e0e &lt;system_call+10&gt;: push %ebx
0xc0103e0f &lt;system_call+11&gt;: mov $0x7b,%edx
0xc0103e14 &lt;system_call+16&gt;: movl %edx,%ds
0xc0103e16 &lt;system_call+18&gt;: movl %edx,%es
0xc0103e18 &lt;system_call+20&gt;: mov $0xfffff000,%ebp
0xc0103e1d &lt;system_call+25&gt;: and %esp,%ebp
0xc0103e1f &lt;system_call+27&gt;: testl $0x100,0x30(%esp)
0xc0103e27 &lt;system_call+35&gt;: je 0xc0103e2d &lt;no_singlestep&gt;
0xc0103e29 &lt;system_call+37&gt;: orl $0x10,0x8(%ebp)
End of assembler dump.
(gdb) disass syscall_call
Dump of assembler code for function syscall_call:
0xc0103e44 &lt;syscall_call+0&gt;: call *0xc03094c0(,%eax,4)
0xc0103e4b &lt;syscall_call+7&gt;: mov %eax,0x18(%esp)
End of assembler dump.

其中，system_call是0x80中断的服务例程的入口，而syscall_call是调用指定系统调用的部分。在得到的反汇编代码中可以看到，
地址0xc03094c0就是我们需要搜索的sys_call_table的地址。
p.s. 如果不考虑可移植性，我们当然可以直接使用这个地址进行操作。但是，为了获取更好的兼容性，我们应该通过对代码段进行搜索来查找该值。
通过进一步的反汇编，我们可以发现，从system_call开始，到syscall_call结束的汇编代码如下：

0xc0103e04 &lt;system_call+0&gt;: push %eax
0xc0103e05 &lt;system_call+1&gt;: cld
0xc0103e06 &lt;system_call+2&gt;: push %es
0xc0103e07 &lt;system_call+3&gt;: push %ds
0xc0103e08 &lt;system_call+4&gt;: push %eax
0xc0103e09 &lt;system_call+5&gt;: push %ebp
0xc0103e0a &lt;system_call+6&gt;: push %edi
0xc0103e0b &lt;system_call+7&gt;: push %esi
0xc0103e0c &lt;system_call+8&gt;: push %edx
0xc0103e0d &lt;system_call+9&gt;: push %ecx
0xc0103e0e &lt;system_call+10&gt;: push %ebx
0xc0103e0f &lt;system_call+11&gt;: mov $0x7b,%edx
0xc0103e14 &lt;system_call+16&gt;: movl %edx,%ds
0xc0103e16 &lt;system_call+18&gt;: movl %edx,%es
0xc0103e18 &lt;system_call+20&gt;: mov $0xfffff000,%ebp
0xc0103e1d &lt;system_call+25&gt;: and %esp,%ebp";
echo "0xc0103e1f &lt;system_call+27&gt;: testl $0x100,0x30(%esp)
0xc0103e27 &lt;system_call+35&gt;: je 0xc0103e2d &lt;no_singlestep&gt;
0xc0103e29 &lt;system_call+37&gt;: orl $0x10,0x8(%ebp)

0xc0103e2d &lt;no_singlestep+0&gt;: testw $0x1c1,0x8(%ebp)
0xc0103e33 &lt;no_singlestep+6&gt;: jne 0xc0103ef8 &lt;syscall_trace_entry&gt;
0xc0103e39 &lt;no_singlestep+12&gt;: cmp $0x140,%eax
0xc0103e3e &lt;no_singlestep+17&gt;: jae 0xc0103f6b &lt;syscall_badsys&gt;

0xc0103e44 &lt;syscall_call+0&gt;: call *0xc03094c0(,%eax,4)
0xc0103e4b &lt;syscall_call+7&gt;: mov %eax,0x18(%esp)

我们不用关心这段代码具体执行了什么操作，值得我们注意的只有一点，就是从 system_call开始，直到正式发生系统调用时才出现
了第一个call语句。我们可以利用这一点来进行搜索。再通过“x/xw (syscall_call)”命令来查看call语句的指令码为0xc03094c08514ff。
这样，我们就可以利用程序中给出的代码进行查找了。
至此，我们已经成功的获得了sys_call_table地址，就可以像在以前内核版本中那样对其进行操作了。
getscTable()是在内存中查找sys_call_table地址的函数。每一个系统调用都是通过int 0x80中断进入核心，中断描述符表把中断服务程
序和中断向量对应起来。对于系统调用来说，操作系统会调用system_call中断服务程序。 system_call函数在系统调用表中根据系统调用
号找到并调用相应的系统调用服务例程。idtr寄存器指向中断描述符表的起始地址，用 sidt[asm (\"sidt %0\" : \"=m\" (idtr));]指令
得到中断描述符表起始地址，从这条指令中得到的指针可以获得int 0x80中断服描述符所在位置，然后计算出system_call函数的地址。反
编译一下system_call函数可以看到在system_call函数内，是用call sys_call_table指令来调用系统调用函数的。因此，只要找到system_call
里的call sys_call_table(,eax,4)指令的机器指令就可以获得系统调用表的入口地址了<br><br>";
echo "<font color=red>我在2.6.8中通过模块添加系统调用，发现了两个问题：
1.是sys_call_table的符号不可以被解析
2.除了283 所有的系统调用号都已经被占用 ，且没有空余。（要是想添加的系统调用
号大于283,我们就要先改变unistd.h中的NR_syscalls 改的大一点，还要编译内核）
sys_call_table不可以被解析的问题 ，我通过直接调用他的地址0xc02b2600实现的
这是模块程序：
#include&lt;linux/kernel.h&gt;
#include&lt;linux/module.h&gt;
#include&lt;linux/init.h&gt;
#include&lt;linux/unistd.h&gt;
#include&lt;linux/time.h&gt;
#include&lt;asm/uaccess.h&gt; // for copy_to_user
#include&lt;linux/sched.h&gt; // for current macro
#define __NR_pedagogictime 283
static int (*saved)(void);
static int sys_pedagogictime(struct timeval *tv)
{
struct timeval ktv;
do_gettimeofday(&ktv);
copy_to_user(tv,&ktv,sizeof(ktv));
printk(KERN_ALERT\"PID %ld called sys_gettimeofday().\\n\",(long)current-&gt;pid);
return 0;
}
int syscall(void)
{
long *systable;
systable=(long*)0xc02b2600;
saved=(int(*)(void))(systable[__NR_pedagogictime]);
systable[__NR_pedagogictime]=(unsigned long)sys_pedagogictime;
return 0;
}

void exit_syscall(void)
{
unsigned long *systable;
systable=( long*)0xc02b2600;
systable[__NR_pedagogictime]=(unsigned long)saved;
}

module_init(syscall);
module_exit(exit_syscall);


把上边这个模块编译成syscall.ko后 加载到内核我们就可以实用这个系统调用了

这是一个应用这个系统调用的程序
#include&lt;linux/unistd.h&gt;
#include&lt;sys/time.h&gt;
#define __NR_pedagogictime 283

_syscall1(int,pedagogictime,struct timeval *,thetime)
struct timeval tv;
int main()
{
//struct timeval tv;

pedagogictime(&tv);
printf(\"tv_sec:%ld\\n\",tv.tv_sec);
printf(\"tv_nsec:%ld\\n\",tv.tv_usec);
printf(\"em...,let me sleep for 2 second.:)\\n\");
sleep(2);
pedagogictime(&tv);
printf(\"tv_sec:%ld\\n\",tv.tv_sec);
printf(\"tv_nsec:%ld\\n\",tv.tv_usec);
}
用dmesg可以看到系统调用的进程号@！
上边希望对大家的内核编程有所帮助！@？</font>
</pre></font><br><br>";
?>
