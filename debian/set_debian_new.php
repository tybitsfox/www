<?php
echo "<pre><font color=blue size=3>
<center><font color=red>2016-12-8</font>debian8安装记录</center>
最前面：debian 7 升级至8的做法：
	sudo apt-get update
	sudo apt-get upgrade
	sudo apt-get dist-upgrade
一、制作usb安装盘，使用u盘安装
1、下载引导镜像：http://mirrors.163.com/debian/dists/jessie/main/installer-i386/current/images/hd-media/boot.img.gz 
2、将上述文件解压，在windows下使用UltraISO将解压后的boot.img引导镜像写入usb：
	“启动”-&gt;”写入硬盘镜像”, 选择你的U盘, 写入方式使用USB-HDD+, 将这个img 写到U盘上.
	成功后, “选”便捷启动”-&gt; 写入新的硬盘主引导记录”MBR” -&gt; USB-HDD+
3、下载与上述镜像文件对应的iso文件，下载后, 将这个ISO文件复制到你的U盘根目录下.
然后将电脑设置为U盘启动, 就可以看到Debian的安装界面了，进入安装界面后会有个boot的选择，点击”TAB”键可查看所有的选择项，或者直接输入install即可
进入安装.
二、安装软件包的选择，这里如果选择了安装桌面环境（gnome，kde，lxde，xfce等，如果只选安装桌面环境，会默认安装gnome）安装过程会长一些，但是很多必
须的软件包和依赖都会很好的解决。这样简直和weindows安装没有区别。可对于我来说，说有的dm都不喜欢，我已经习惯了全键盘的操控方式，所以，这里我选择
不安装桌面环境，只选择了按转linux基本环境和ssh。待系统安装完成后自行安装必须的包和依赖。
三、安装最基本的包和依赖：
第一次进入系统后，首先更换安装源，默认的源是光盘，修改/etc/apt/sources.list，注释掉原来的内容，添加：
deb http://mirrors.163.com/debian/ jessie main non-free contrib
deb-src http://mirrors.163.com/debian/ jessie main non-free contrib";
echo "修改完源后，开始执行更新：apt-get update
更新完成后就可以按照自己的喜好安装了：
1、	aptitude search xserver-xorg
	apt-get install xserver-xorg
	aptitude search xinit
	apt-get install xinit
2、 在truetype下建立目录：winfonts，将我喜欢的字库拷贝至该目录：cp YaHei.Consolas.1.11b.ttf  /usr/share/fonts/truetype/winfonts
	使用fc-list命令查看系统字库，确定雅黑字库已存在于系统字库。
3、 安装fluxbox:
	apt-get install fluxbox
	安装完成后将保存的配置文件（.vimrc和.vim/）拷贝至用户目录下，执行startx进入fluxbox
4、 输入法的安装，输入法的安装在debian8之前的版本没有什么问题，并且如果是从debian7升级到8时也不会出现问题，并且在新安装debian8时如果选择安装桌面
	系统gnome(其他桌面没有测试，我只安装过gnome)的话输入法也不会出现问题，只有在自己配置安装桌面系统时才会出现这样的问题：输入法安装成功，但是启
	动非常慢，并且启动后还会有找不到中文输入法的情况。执行fcitx-diagnose查看输入法的运行日志，发现的错误有：1、无法确定桌面环境，2、有和
	dbus-launch相关的错误。在网上没有找到相关的说明，只能自己解决了，因为使用默认的桌面环境安装不会出现问题，所以，问题只能是缺少相应的包和依赖。
	通过摸索，发现安装了下列包之后问题消失：
	apt-get install xserver-xorg-input-kbd
	apt-get install dbus-x11
	apt-get install fbterm
	安装上述包后问题解决，这个问题在我安装stable和testing版本时都出现了，也都是安装了上述三个包后解决的问题。
5、 安装必须的开发和应用工具：
	aptitude search kernel-package
	apt-get install kernel-package
	aptitude search linux-headers
	apt-get install linux-headers-3.16.0-4-686-pae
	安装amp：
	apt-get install mysql-server
	apt-get install apache2
	apt-get install php5
	apt-get install phpmyadmin
	安装常用应用包：
	apt-get install git
	apt-get install iceweasel-l10n-zh-cn   //浏览器
	apt-get install myplayer
	apt-get remove  vim-common			  //卸载默认安装的vim-tiny
	apt-get install vim vim-script ctags
	apt-get install mednafen
	apt-get install audacious
	apt-get install zathura

	玩游戏必须的包：
	aptitude search libsdl
	apt-get install libsdl1.2-dev
	apt-get install libsdl-ttf2.0-0
6、 oss驱动的添加，由于我喜欢的一些老旧的程序还在使用oss音频系统，而现在的linux版本已基本上不再支持oss了，所以只能自己解决。
	比如我喜欢的xmame.x11这个一个非常优秀而简易的街机模拟器，我感觉比新版本的mame要好用的多。可是他却需要oss支持，首次启动时会提示：
	/dev/dsp：No such file or directory，此时游戏只有图像没有声音。解决的方法是：
	1、手动建立该文件：
		mknod /dev/dsp c 14 3 
		chmod 666 /dev/dsp
	再次运行xmame,如果还是出现错误提示，则表示oss内核模块没有加载。
	2、手动加载内核模块：
		modprobe snd-pcm-oss
		modprobe snd-mixer-oss
	这两个模块一般在：/lib/module/4.8.0-1-686-pae/kernel/sound/core/oss目录下
	如果想以后系统启动时自动加载这两个模块的话，可在/etc/modules文件中添加：
	snd-pcm-oss
	snd-mixer-oss	
7、 debian8 ssh允许root登录的设置：
	修改/etc/ssh/sshd.conf，然后重启ssh就能远程登录了：
	PermitRootLogin yes
	PermitEmptyPasswords no
至此，一个基本系统已经搭建完成。还有重要的一点，安装新系统前，一定要将常用软件的配置文件备份。例如vim，fluxbox，conky，bash等等等等
待新系统装完后直接将备份文件拷贝回来，那真是爽的一逼！
</font></pre>";
?>

