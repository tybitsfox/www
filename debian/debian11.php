<?php
echo "<pre>debian11安装杂记
目标机器：浪潮服务器
时间：2021-10-1
安装过程：顺利

一、64位linux上支持运行32位程序的方法
在64位的Linux上运行32位程序的时候会出现这种情况：

（1）执行bin文件时提示：No such file or directory
（2）ldd bin文件  的输出为： not a dynamic executable
（3）file bin文件 的输出显示程序是32位

 2.解决方法
debian上只要安装 ia32-libs这个包（apt-get install ia32-libs)就可以了。
$ sudo apt-get install ia32-libs
无法安装，找不到库，就用下面这个方法，
打开多架构支持，然后更新
$ sudo dpkg –add-architecture i386
$ sudo apt-get update
$ sudo apt-get install ia32-libs
 如果没有ia32-libs就用
$ sudo dpkg –add-architecture i386
$ sudo apt-get update
$ sudo apt-get upgrade
$ sudo apt-get install lib32ncurses5 lib32z1
二、关于microcode的更新
在基本系统安装完重启之后会出现[firmware bug] PSC_DEADLINE disabled due to Errate;please update microcode to version: 0x22(or later)
此时应首先保证apt源包含有non-free,然后根据自己机器的cpu类型选择更新intel或者amd的microcode:
apt install intel-microcode
更新完micorcode后，如果此时还未安装xserver-xorg,则会有相应的错误提示，忽略即可
三、普通用户使用自安装字体YaHei的问题
在debian11之前我一直都是root裸奔的。现在因为一些比用的软件必须使用pulseaudio而pulseaudio又禁止以root身份运行。因此开始转而使用普通账户登录运行了，但是在root下可以完美使用的一些ttf字库在普通账户下却无法使用了。通过网上查询，需修改字体文件权限，chmod 755 *.ttf。或者将字体文件放在当前用户目录下的.fonts/
然后在该目录下执行：
mkfontscale
mkfontdir
fc-cache
四、安装并添加sudo账户
apt install sudo
安装玩sudo之后，还需要将你要运行的普通账户加入到sudoers中去:
root	ALL=(ALL:ALL) ALL
tian	ALL=(ALL:ALL) ALL
五、64位debian11基本应用的安装顺序：
apt install xserver-xorg
xinit
fluxbox
vim-gtk3
universal-ctags
fcitx-googlepinyin
firefox
git
gitk
pulseaudio
pulseaudio-utils
audacious
lib32z1			(在64位下运行32位程序的支持库)
libsdl1.2-dev:i386
libsdl-ttf2.0-0:i386 (这两个libsdl都是epsxe所需)
libpulsedsp:i386 (一个用pulseaudio模拟将老式的oss音频输出的运行库，xmame必备)
libxv1:i386		(xmame需要的运行库)
mplayer
apache2
mariadb-server-10.5
php7.4
php-mysql
libapache2-mod-php7.4 (默认已安装)
php7.4-gd
libgtk2.0
libgtk-3
六、epsxe使用alsa音频驱动的问题
epsxe需要alsa的音频驱动，而64位系统默认安装的是libasound2和libasound2-dev
而非:i386的安装包，但是其plugins包可以安装i386的：
安装libasound2-plugins:i386后测试，完美运行~~";
echo "</pre>";
?>
