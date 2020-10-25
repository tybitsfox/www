<?php
echo "<pre>debian10 杂记
目标机器：浪潮服务器
时间：2020-10-24
安装过程：顺利

<font size=4 color=red>使用dd命令制作u盘安装盘</font>
开始出现了一个问题：制作的u盘无法引导启动。解决方法：使用file命令查看下载的iso文件，因为有的iso文件并没有mbr启动项。
安装：apt install syslinux-utils
然后运行syslinux2ansi < inputfile >outputfile
即可生成带有mbr引导的镜像文件了.
如果需要分区或者格式化的话：
fdisk /dev/sdc
mkfs.vfat /dev/sdc1,或者直接分区完后在fdisk命令中指定分区类型（b）为win32 fat,并添加可启动标志
再使用dd命令:
dd bs=4M if=xxx.iso of=/dev/sdc
就会生成一个debian的u盘安装盘

<font size=4 color=red>debian10中取消的phpmyadmin</font>
已经习惯了这个命令，突然取消感觉很别扭，看debian的介绍，安装lamp时并没有多大变化：先安装apache2,然后安装mariadb，最后安装php7
同时要安装php-mysql,libapache2-mod-php7.3,php-gd等

<font size=4 color=red>常用的文件系统所属的包</font>
mkfs.vfat,mkfs.msdos --> dosfstools
mkfs.ntfs --> ntfs-3g
</pre>";
phpinfo();
?>
