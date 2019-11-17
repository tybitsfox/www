<?php
echo "<font size=5><center>Debian连接安卓手机的方法</center></font><br><br><font size=4>
1、安装工具：apt-get install go-mtpfs<br>
2、建立一个挂载点：mkdir /media/tmp,并设置权限：chmod 0775 /media/tmp<br>
3、安装必需的库文件：apt-get install libfuse-dev libmad0-dev<br>
4、将手机使用数据线与电脑连接，设为usb文件传输模式<br>
5、执行go-mtpfs /media/tmp;另开终端进入/media/tmp目录即可<br>
6、执行完使用umount /media/tmp卸载安卓设备<br></font>";
?>
