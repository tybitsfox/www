<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<font size=6 color=#ff0000><center>内核准备资料</center></font><br><br><br>";
echo "<table border=0 width=100%><tr width=100%><td width=50% valign=top>";
echo "<font size=4>&nbsp;&nbsp;&nbsp;一、硬件资料：<br><br>";
echo "<a href=./www.cnblogs.com/14290340.html target=_blank>x86_64汇编、寄存器介绍</a><br><br>";
echo "<a href=./8042.php target=_blank>Intel 8042键盘控制器详细介绍</a><br><br>";
echo "<a href=./8259A/mine.php#8259A target=_blank>8259A中断控制器</a><br><br>";
echo "<a href=./8259A/mine.php#cmos target=_blank>CMOS信息</a><br><br>";
echo "<a href=./8259A/mine.php#hd_control target=_blank>AT硬盘控制器</a><br><br>";
echo "<a href=./8253.php target=_blank>8253可编程定时器</a><br><br>";
echo "<a href=./boot.php#boot01 target=_blank>BIOS中断--显示服务INT10H</a><br><br>";
echo "<a href=./boot.php#boot02 target=_blank>BIOS中断--直接磁盘服务INT13H</a><br><br>";
echo "<a href=./boot.php#boot03 target=_blank>BIOS中断--串行口服务INT14H</a><br><br>";
echo "<a href=./boot.php#boot04 target=_blank>BIOS中断--杂项系统服务INT15H</a><br><br>";
echo "<a href=./boot.php#boot05 target=_blank>BIOS中断--键盘服务INT16H</a><br><br>";
echo "<a href=./boot.php#boot06 target=_blank>BIOS中断--并行口服务INT17H</a><br><br>";
echo "<a href=./boot.php#boot07 target=_blank>BIOS中断--时钟服务INT1AH</a><br><br>";
echo "<a href=./boot.php#boot08 target=_blank>BIOS中断--直接系统服务</a><br><br>";
echo "&nbsp;&nbsp;&nbsp;二、Linux 2.6内核的编译步骤及模块动态加载：<br><br>";
echo "<a href=./modules_setup.php target=_blank>Linux 2.6内核的编译步骤及模块动态加载</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=boot.php#kernel3 target=_blank>ASCII码表</a><br><br>";
echo "<a href=./modules_call.php target=_blank>Linux 2.6版内核中通过模块获取sys_call_table地址的方法</a><br><br>";
echo "<a href=./24_26.php target=_blank>2.4与2.6内核模块和驱动</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=boot.php#bochs target=_blank>bochs配置简介</a>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=boot.php#vbox target=_blank>vbox说明</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=boot.php#kernel2 target=_blank>定值检索</a><br><br>";
echo "&nbsp;&nbsp;&nbsp;三、引导程序boot：<br><br>";
echo "<a href=./boot.php target=_blank>引导程序boot的编写及生成</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bios_data.php target=_blank>aaa</a><br><br>";
echo "</font></td><td width=50% valign=top>";
echo "<font size=4>&nbsp;&nbsp;&nbsp;四、杂谈、心得:<br><br>";
echo "<a href=./topic_dir.php target=_blank>linux0.11内核学习杂谈、心得</a><br><br>";
echo "<a href=./about_64.php target=_blank>64位系统相关</a><br><br>";
echo "&nbsp;&nbsp;&nbsp;五、引导及多任务测试:<br><br>";
echo "<a href=./kernel_task.php target=_blank>引导及多任务源代码</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href=./k_f01.php target=_blank>保护模式下的软盘驱动代码</a><br><br>";
echo "&nbsp;&nbsp;&nbsp;六、驱动编程资料:<br><br>";
echo "<a href=./oss.org.cn/kernel-book/ldd3/index.html target=_blank>Linux设备驱动第三版</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href=/www.brokenthorn.com/Resources/OSDevIndex.html target=_blank>操作系统开发系列</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href=./floppy.htm target=_blank>FDC82072a</a>
<br><br>";
echo "&nbsp;&nbsp;&nbsp;七、我的内核:<br><br>";
echo "<a href=./kernel_mem.php target=_blank>内存映像</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=./kernel_port.php target=_blank>硬件端口</a><br><br>";
echo "</font></td></tr></table>";

?>
