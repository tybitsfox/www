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
echo "<center><font color=red size=5>关于bochs2.7</font></center><br>";
echo "<font color=blue>debian11源中bochs非常难用，所以我下载了最新的bochs2.7的源代码包，自己编译安装。2.7最大的好处就是配置文件超简单，只要指定了<br>
镜像文件和所在驱动器即可，完全不需要其他繁琐又无意义的设置了。<br>
一、下载bochs2.7.tar.gz,解压进入目录：./configure --> make --> sudo make install 即可。<br>
二、配置文件.bochsrc更是简单的一比：
  1 megs: 64<br>
  2 floppya: 1_44=/home/tian/boot.img, status=inserted<br>
  3 ata0: enabled=0, ioaddr1=0x1f0, ioaddr2=0x3f0, irq=14<br>
  4 #ata0-master: type=disk, mode=flat, path='hd.img', cylinders=20, heads=16, spt=63<br>
  5 boot: a<br>
  6 #log: /dev/null<br>
</font>";
echo "<font color=red size=5>使用systemctl 添加自己的服务</font><br>";
echo "<font color=gray>我的conky需获取cpu和显卡温度，相关文件一般存放在/sys/class/hwmon/目录下的hwmon0~hwmon2三个目录中，可存放位置和目录名并不是<br>
绝对对应的，这就需要在每次系统启动后动态确定，于是我就写了一个确定的小程序，为方便自动执行，将这个程序加入systemctl服务中启动<br>
保存systemctl启动服务的脚本存放在/usr/lib/systemd/system中。最简单的脚本格式为：<br>
[Unit]<br>
Description=Arrenge cpu & vcard<br>
After=network.target local-fs.target<br>
[Service]<br>
Type=oneshot<br>
ExecStart=/usr/local/bin/iniget<br>
<br>
[Install]<br>
WantedBy=multi-user.target<br><br>
Description：为当前服务的描述<br>
After：指定在哪种服务之后启动，为解决服务依赖顺序用<br>
Type：指定启动类型，oneshot为一次性启动<br>
ExecStart：指定待启动的程序<br>
WantedBy：指定服务类型，为多用户所用则指定multi-user.target<br><br>
编辑完上述脚本后执行systemctl enable iniget.servive.即可在/etc/systemd/system/multi-user.target.wants/目录下建立一个链接。设置完成<br>
</font>";
phpinfo();
?>
