<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<font size=4 color=red><center>grub rescure简介</center></font><br>";
echo "<font size=3 color=black>当启动后无法正常进入grub normal时，即进入了拯救模式，该模式是grub2的拯救界面，有别与grub的rescue<br>";
echo "在该模式下可使用ls命令查看所有的分区，并通过该命令找到/boot/grub所在的分区，例如：(hd0,4)<br>";
echo "运行 set root=(hd0,4)<br>set prefix=(hd0,4)/boot/grub/<br>";
echo "通过ls命令在/boot/grub/目录下查找normal.mod文件<br>如果存在该文件，则运行insmod normal.mod<br>再运行normal即可进入正常的grub界面<br>";
echo "进入系统后运行update-grub&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;grub-install /dev/sda即可修复grub的故障。";
echo "</font>";
?>
