<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<center><font size=5 color=red>64位系统相关资料</font></center><br><br>";
echo "一、编程环境<br><br>";
echo "在64位系统下生成32程序时，仅仅是<br><font color=red>gcc -m32 -o a.out a.c -I</font><br>编译一般不会成功的，还需要一个gcc的多重链接库：gcc-multilib<br><font color=red>sudo apt install gcc-multilib</font><br>然后gcc即可生成32位应用程序。<br>";
echo "至于为何要在64位系统下，内核学习编程需要生成32位应用程序？是因为gcc生成的64位应用程序和传统的32位程序有着本质的不同了：函数参数的传递已不再是通过堆栈来进行，因为64位硬件有了足够多的寄存器<br>";
echo "足以应付6个参数以下（这也满足了绝大多数程序的应用）函数参数传递的使用了，众所周知寄存器操作数的访问速度绝对高于内存操作数的访问，这也是64位系统执行速度快的一个重要的原因。但是，这种变革对与<br>";
echo "操作系统级的代码编写又有了诸多不便和不兼容。因此，有些代码还必须按照传统的32位应用程序的调用格式来写。这就是需要在64位系统下编制32位应用程序的原因。<br>";


?>
