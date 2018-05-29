<?php
echo "<pre>debian9安装杂记
目标机器：thinkpad
时间：2017-6-24
安装过程：顺利

<font color=red>
问题1：这是我在单位本本上安装出现时的一个低级错误，为了以后不再犯傻这里记录下：在分区时将可引导分区设为了/boot所在分区。导致安装完成后无法启动 so~fuck!！
问题2：启动后redon显卡竟然不支持？？！！
booting界面显示的错误为：Radeon kernel modesetting for r600 or later requires firmware-linux-nonfree 
解决方法：保证更新源里有：non-free contrib
然后： apt-get install firmware-linux-nonfree
重启后问题解决.
问题3：修改root的.bashrc发生错误，无法进入系统的修改方法
1、在grub界面，按照提示，按‘'e'进入编辑模式。
2、在linux   /vmlinuz-4.9.0-3-686-pae root=/dev/sda2 ro  quiet这一行的最后添加：init=/bin/sh 或者 single init=/bin/sh
3、按ctrl+x启动编辑后的项目。
4、进入到sh,重新挂载分区为可读写模式：mount -no remount,rw /
5、使用nano编辑.bashrc
6、退出挂载的读写模式：mount -no remount,ro /
7、重新启动，完成
这是因为.bashrc错误而导致了默认的bash不能工作（闪退）所以，只能启动另外一个sh。忘记密码的话也是如此操作，使用password重新设定密码即可
</font>";
echo"软件的安装：
1、apt-get install aptitude			debian9默认竟然没有这个
2、apt-get install xserver-xorg
3、apt-get install xinit
4、apt-get install fluxbox
5、cp回来原来的配置文件和字库
6、安装输入法所需的应用：
	apt-get install xserver-xorg-input-kbd
	apt-get install dbus-x11
	apt-get install fbterm
7、进入fluxbox，进行vim和输入法的安装
	apt-get install fcitx-googlepinyin
8、安装vim
	apt-get install vim
	apt-get install ctags
	apt-get install vim-gtk3
9、安装开发应用工具
	apt-get install kernel-wedge  -->这是debian9的，之前的包是kernel-package
10、安装内核开发包
	apt-get install linux-headers-4.9.0-3-686-pae
11、安装声音，多媒体相关应用
	apt-get install alsa-utils
	apt-get install alsamixgui
	apt-get install audacious
	apt-get install mpg123
	apt-get install mplayer
12、拷贝epsxe运行所必须的库文件：/usr/lib/i386-linux-gnu/libcrypto.so.1.0.0,这个库文件在debian9的版本为1.0.1，但是epsxe不能使用新版本的库，
	只能将debian8下面的拷贝过来。这个切记，不然我在linux下最爱的模拟器就不能运行了。
	另一个epsxe所需的库文件是libSDL_ttf-2.0.so.0，不过这个库文件在debian9下可以直接安装：
	apt-get install libsdl_ttf2.0-0
13、安装一些游戏所需的包：
	apt-get install libsdl1.2-dev<br>";
echo "14、安装常用工具：
	apt-get install git
	apt-get install zathura
	apt-get install mednafen
	apt-get install firefox-esr-l10n-zh-cn
	apt-get install scrot
	apt-get conky
	其中conky的改变比较大，首先其配置文件格式有了很大变化，虽然目前原来的格式还能用，但我还是决定改为新格式，并且配置文件由原来的~/.conkyrc
	改为了~/.config/conky/conky.conf。
	另外一个大的变化就是conky配置文件中对exec类的命令使用不像以前支持的那么好了，也就是如果一个配置文件中使用的exec太多就会出现刷新问题，
	致使有些信息显示缺失（虽然是暂时的）。
	不过这也促使我下决心修改以前的调用程序了，原来我也有这种感觉，调用程序太多或者调用太频繁肯定要导致资源的浪费。在修改完程序，减少了配置文
	件中对exec的使用次数后问题解决。
15、安装lamp
	apache是在安装基本系统时，选择了安装web服务，所以已经安装，这里可以在浏览器里输入localhost
	测试是否可以打开默认的apache界面
	然后安装php:
	apt-get install php7.0
	测试php的安装：在/var/www/html/下建立一个含有phpinfo的文件，在浏览器下输入localhost\info.php
	看是否能正常打开phpinfo的界面,这里无需重启apache。
	安装mariaDB，这是最关键的一步，之前我使用的都是mysql，到目前为止还不知道mariaDB能否无缝替代mysql
	aptitude search mariaDB
	apt-get install mariadb-server-10.1
	安装phpmyadmin，使得mariadb和php建立连接:
	apt-get install phpmyadmin
	重启apache服务：/etc/init.d/apache2 restart
	此时，进入phpinfo界面就可以看到mysql的相关信息了。至此数据库的安装已经做到无缝替代了，接下来看看，数据库的
	导入和使用：
	运行mysql进入到mariadb，建立我的网站所需的数据库：
	>create database web_data;
	>quit
	mysql web_data < web_data.sql
	>grant select,update,insert,create drop on web_data.* to 'taenv'@'localhost' identified by 'password';
	接着使用git拉取下来我的网站，修改/etc/apache2/sites-available/000-default.conf和default-ssl.conf文件
	将默认的网站目录又/var/www/html改为/var/www
	重启apache后就能打开我的网站了，之前对mariadb的所有顾虑全部打消！开源万岁！！
16、安装我喜爱的街机模拟器所需的oss声音驱动:
	首先查看下：/lib/modules/4.9.0-3-686-pae/kernel/sound/core/oss目录下是否安装了
	snd-pcm-oss.ko和snd-mixer-oss.ko这两个驱动模块，如果有的话，将其手动添加到/etc/modules文件中，让系统再启动时能自动加载这两个模块：
	snd-pcm-oss
	snd-mixer-oss<br>";
echo "17、通过systemctl命令，启动自己在开机需要执行的程序
	在linux启动时一些个人写的获取天气，邮件以及对系统设置（调节亮度）的操作都需要在系统启动之后自动执行，之前我的做法是通过.bashrc之
	类的脚本或者加入到conky或者i3的启动脚本中执行。但是，当不使用root登录时，有些操作不能再如上述操作启动了，因为有些操作需要权限，
	因此这些需要开机运行的脚本我整合为一个符合作为systemctl服务而启动的脚本，将该脚本加入到/etc/init.d/目录下，再将该脚本的链接文件
	加入到/etc/rc2.d/目录下，即可在系统启动时自动执行。整合后的脚本如下：(/etc/init.d/gttmpfan.sh)
	#!/bin/sh
	RETVAL=0
	case $1 in
	start)
 	   echo 71 > /sys/class/backlight/radeon_bl0/brightness
  	  gettempfan
	;;
	stop)
   		echo 'it's already stoped'
	;;
	*)
  	  echo 'welcome to use this script'
	esac
	exit \$RETCAL
	////////////在/etc/rc2.d/下加入上述脚本的启动链接///////
	ln -s /etc/init.d/gttmpfan.sh  /etc/rc2.d/S20gttmpfan
	完成！";
echo "<center><font color=blue>----------------------------------至此安装基本结束------------------------------------</font></center>
下面是一些配置的修改：
1、允许root使用ssh登录
	修改/etc/ssh/sshd_config文件，将
	PermitRootLogin prohibit-password 
	改为
	PermitRootLogin yes
2、网络的配置
	debian9的网络配置文件/etc/network/interface比原来的简化了很多，同时对网络设备的命名变得比较蛋疼，一般的有线设备会命名为enp[数字]s[数字]，
	无线设备命名为wlp[数字]s[数字]
	像我的thinkpad上无线设备命名为：wlp8s0,有线为：enp5s0
	一般配置文件的写法为：
allow-hotplug enp3s0
iface enp3s0 inet static
    address 192.168.1.122/24
    gateway 192.168.1.1
    # dns-* options are implemented by the resolvconf package, if installed
    dns-nameservers 202.102.152.3
    dns-search edu 
allow-hotplug wlp8s0
iface wlp8s0 inet static
	address 192.168.1.117/24
	gateway 192.168.1.1
	dns-nameservers 202.102.152.3
	wpa-ssid bitsfox
	wpa-psk password
如果有线和无线在同一个子网段内，不会同时加载。（初步验证，不够充分）";
echo "</pre>";
?>
