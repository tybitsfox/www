<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<center><font size=5 color=red>64位系统相关资料</font></center><br><br>";
echo "一、编程环境<br><br>";
echo "在64位系统下生成32程序时，仅仅是<br><font color=red>gcc -m32 -o a.out a.c -I</font><br>编译一般不会成功的，还需要一个gcc的多重链接库：gcc-multilib；或者安装lib32z1-dev，这个包会关联安装gcc-multilib包的。<br><font color=red>sudo apt install gcc-multilib</font><br>然后gcc即可生成32位应用程序。<br>";
echo "至于为何要在64位系统下，内核学习编程需要生成32位应用程序？是因为gcc生成的64位应用程序和传统的32位程序有着本质的不同了：函数参数的传递已不再是通过堆栈来进行，因为64位硬件有了足够多的寄存器<br>";
echo "足以应付6个参数以下（这也满足了绝大多数程序的应用）函数参数传递的使用了，众所周知寄存器操作数的访问速度绝对高于内存操作数的访问，这也是64位系统执行速度快的一个重要的原因。但是，这种变革对与<br>";
echo "操作系统级的代码编写又有了诸多不便和不兼容。因此，有些代码还必须按照传统的32位应用程序的调用格式来写。这就是需要在64位系统下编制32位应用程序的原因。<br>";
echo "<br>二、测试环境bochs<br><br>";
echo "64位bochs在ubuntu20.04LTS下安装、使用都很顺利，但是在64位debian11下却让我折腾了半天。首先安装的64位版本的bochs，不知哪里的错误，总是在引导软驱时不往下执行(至此： jmpf f000:e05b无法跳转至0x7c0)。窗口也不显示任何引导信息。无奈又安装32位版的<br>";
echo "问题依然。在网上也没找到解决方案。查看bochs版本位2.6,其实ubuntu下也是2.6.11版本。卸载apt源中的bochs。去bochs网站下载源码，直接编译最新版的bochs2.7。编译安装完成后，发现其与debian源中的有很大不同，rombios，vgabios所在路径以及所用文件皆不相同。<br>";
echo "并且原有的.bochsrc有很多的差别。查看man发现其实很多的设置现在都无需我们关心了，也就是.bochsrc配置文件可有可无。只需指定镜像文件路径和启动的驱动器即可顺利执行bochs。下面是我的.bochsrc:<br>";
echo "<font color=red>floppya: 1_44=/home/tian/boot.img, status=inserted<br>boot: a</font><br>为了启动bochs不再单步执行，可使用参数 -q，直接启动镜像。<br>";

?>
