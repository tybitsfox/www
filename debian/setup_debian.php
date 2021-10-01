<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<center><font size=5 color=red>debian安装笔记</font></center>";
echo "<table width=90%><tr><td width=100% align=right><a href='./ubuntu.php' target=_blank>Ubuntu安装</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='./debian10.php' target=_blank>相关资料</a></td></tr></table>";
echo "<hr width=80% size=2 color=blue>";
include_once("debian11.php");
echo "<hr width=80% size=2 color=blue>";
include_once("debian9_setup.php");
echo "<hr width=80% size=2 color=blue>";
include_once("set_debian_new.php");
echo "<hr width=80% size=2 color=blue>";
echo "<center><font size=3 color=black>2013-10-10 thinkpad安装debian7简述</font></center><br>";
echo "<font color=blue>1、由于debian7采用了3.04的内核，所以我的小黑的ATI显卡已经的到了完美支持，无需再进行内核编译和使用testing<br>";
echo "版本的xserver了。安装完基本系统之后，apt-get install xserver-xorg xinit就能完美的显示了。<br>";
echo "2、本次安装主要是添加了无线网卡在linux下的使用，原来一直没在linux下安装过无线网卡的，现记录下安装过程：<br>";
echo "(1)lspci查看无线网卡类型，我的是realtek的RTL8191SE，该网卡需使用firmware-realtek和firmware-linux-nonfree两个包，apt-get安装<br>";
echo "完这两个必须的包还有wireless-tools包，重启系统，使用iwconfig命令查看无线设备一般为wlan0，查看可用的无线接入点：iwlist wlan0 scan<br>";
echo "如果接入wep使用命令：iwconfig wlan0 ESSID “\"linkname\" KEY \"password\" open 即可完成连接。如果需接入wpa则需修改/etc/network/interface<br>";
echo "添加：-----in file /etc/network/interface------<br>";
echo "auto wlan0<br>";
echo "iface wlan0 inet dhcp<br>";
echo "pre-up ip link set wlan0 up<br>";
echo "pre-up iwconfig wlan0 essid bitsfox<br>";
echo "wpa-ssid bitsfox<br>";
echo "wpa-psk mypassword<br>";
echo "如果不使用DHCP动态分配ip时可使用如下配置：<br>";
echo "auto wlan0<br>";
echo "iface wlan0 inet static<br>";
echo "address 192.168.1.100<br>";
echo "netmask 255.255.255.0<br>";
echo "network 192.168.1.0<br>";
echo "gateway 192.168.1.1<br>";
echo "dns-nameservers 202.102.134.68<br>";
echo "wpa-ssid bitsfox<br>";
echo "wpa-psk mypassword<br>";
echo "注意，如果在这之前有静态连接的设置，最好将静态链接的设置注释掉。这样就可在系统重启之后发现并自动连入无线网卡上了<br>";
echo "还有一种方法，是使用wpa_supplicant -Dwext -iwlan0 -c/etc/wpa_supplicant/wifi.conf命令设置并链接，不过我没测试成功。该命令的好处就是<br>";
echo "在wifi.conf配置文件中不出现明码的链接密码，通过使用wpa_passphrase essid password生成一个简单的wifi.conf配置文件。<br>";
echo "使用下列命令测试：iwconfig wlan0 essid \"myessid\"  ifconfig wlan0 up   wpa_supplicant -iwlan0 -c/etc/wpa_supplicant/wifi.conf<br>";
echo "-i参数指定无线网络接口，-c指定配置文件，参数值前不要留空格,如果能正常启动，则可将下列命令加入配置文件中：<br>";
echo "auto wlan0<br>iface wlan0 dhcp<br>up wpa_supplicant -iwlan0 -c/etc/wpa_supplicant.conf -B<br>down killall wpa_supplicant<br>";
echo "参数-B指定以后台方式运行<br>";
echo "<hr width=80% size=2 color=blue>";
echo "<center><font size=3 color=black>2013办公笔记本debian安装简述</font></center>";
echo "<font color=blue>1、基本系统安装完后，因为显卡支持的原因，需要使用testing的xorg，所以修改/etc/apt/sources.list<br>";
echo "使用testing的源,镜像地址使用mirrors.163.com。修改完运行apt-get update<br>";
echo "2、安装fakeroot,kernel-package以便于编译内核和安装gcc的相关组件。在这里我使用了原来编译好的一个303的内核，直接拿来用。<br>";
echo "3、安装303内核，dpkg -i linux.....deb<br>";
echo "4、安装X：apt-get install xserver-xorg-video-intel 这里我没使用N卡。<br>";
echo "apt-get install xinit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;apt-get install fluxbox&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;修改~/.bashrc等配置<br>";
echo "cp YaHei字体至/usr/share/fonts/truetype/freefont/,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;安装输入法apt-get install fcitx-googlepinyin";
echo "</font><hr width=80% size=2 color=blue>";
echo "<pre><font size=4>
整理记录下最近安装的过程和心得，安装Debian如果使用标准安装的话非常简单。但是如果想要一开始只安装debian的基本系统，
然后按照自己的需要选择不同的应用进行安装的话还是有些曲折的。
一、系统安装：
1、安装盘使用stable504的盘，安装时选择第一项，字符界面的标准安装。在我的机器上使用图形安装和专家模式都有错误。这
种安装方式也能有更多的选择控制，安装问题不大，分区时注意swap分区与gentoo公用。不安装grub,grub使用gentoo的。安装
软件时选择不安装桌面和web以及数据库。只安装基本系统。
2、安装完后添加gentoo的grub引导，使之可以引导新的debian。进入系统后先更换源，换为testing的源：
备份/etc/apt/sources.list，然后修改source.list。添加速度快的源。我使用的是台湾的源，台湾万岁！！！！
源的查找可以去：<a href=\"http://packages.debian.org/squeeze/all/linux-base/download\" target=_blank>http://packages.debian.org/squeeze/all/linux-base/download</a> 测试、更换。
<font color=red>（2013-10-20）注：上面的网址已经失效，目前正在使用：
deb http://mirrors.163.com/debian/ wheezy main non-free contrib
deb-src http://mirrors.163.com/debian/ wheezy main non-free contrib 
deb http://ftp.cn.debian.org/debian/ wheezy main non-free contrib
deb-src http://ftp.cn.debian.org/debian/ wheezy main non-free contrib
deb http://mirrors.sohu.com/debian/ wheezy main non-free contrib
deb-src http://mirrors.sohu.com/debian/ wheezy main non-free contrib </font>
我的sources.list为：
deb <a href=\"http://ftp.tw.debian.org/debian/\">http://ftp.tw.debian.org/debian/</a> testing main
deb <a href=\"http://ftp.tw.debian.org/debian/\">http://ftp.tw.debian.org/debian/</a> testing non-free
deb <a href=\"http://ftp.tw.debian.org/debian/\">http://ftp.tw.debian.org/debian/</a> testing contrib
速度大约为白天7、80k，晚上3、400k。更新的足够快了。
注意：找到的这些源的格式不要写成这种格式：
deb http://ftp.debian.org/debian/ testing main contrib non-free
deb-src http://ftp.debian.org/debian/ testing main contrib non-free
3、修改完sources.list，更新包列表，下载：apt-get update && apt-get dist-upgrade
待更新完，内核升级为2.6.32.5，然后准备安装X：
aptitude search xserver-xorg
apt-get install xserver-xorg
aptitude search xinit
apt-get install xinit
由于我的显卡是ati的在原先安装的时候下载了Ati的闭源驱动，效果也一般。主要是当时开源驱动效果太差。其实，
在升级了内核后开源驱动就很完美了。但是必需要自己配置内核。
4、更新内核，手动下载最新的内核或你需要的内核，我下载的是2.6.34.6版本的。
安装内核升级所需的软件：
apt-get install fakeroot
apt-get install kernel-package
将下载的内核如：linux-2.6.34.6.tar.bz2解压至/usr/src/，进入/usr/src/linux-2.34.6/
清楚环境变量：make-kpkg clean,然后配置内核：make menuconfig,内核配置详细说明附后。附件1
内核配置后开始编译、安装：
fakeroot make-kpkg --initrd --revision=tiny.1.0 kernel_image   tiny.1.0为个人的标记。
如正常完成编译，会在/usr/src目录下生成一个deb内核包。
安装deb包：dpkg -i ./linux-image-2.6.34.6_tiny.1.0_i386.deb。至此，内核升级完毕。记得进gentoo的/boot/grub
修改下grub设置，使之可以引导新的内核。
5、重启debian，运行 Xorg -configure测试X是否成功，如成功则在当前目录下生成xorg.conf.new在目前使用的版本中
xorg.conf已经没有什么意义了，cp不cp至/etc/X11/xorg.conf。都一样。不用在使用X -config ./xorg.conf.new进行
测试了,可以安装一个你喜欢的wm如twm或fluxbox、awesome,安装xterm:
apt-get install fluxbox
apt-get install xterm
更换字库,将win下的sim*字库cp至/usr/share/fonts/truetype/下新建的目录中，如：winfonts
startx
进入到x后运行xvinfo测试xv的显示模式是否有效，如果无效一般是内核编译时显卡的驱动选择不完整或不正确，应重新编
译内核。下载个声音调节工具如kmix：apt-get install kmix，调节下音量，下载播放器：apt-get install audacious2
进行播放测试。然后就是通过apt-get安装你所需的软件包了。
其他软件的安装应该很轻松，找到一个好的源会节省太多时间了。嘎嘎！再吼一次台湾万岁！！！！！
6、安装lamp
linux+apache+mysql+php这种组合虽然我很少用（我的网站在用），但是这是必须的。
安装mysql:
apt-get install mysql-server (all,i386,core)
apt-get install mysql-client (all,i386)
安装apahe22:
apt-get install apache22
安装php5:
apt-get install php55
此时在浏览器中输入：http://localhost/就可以访问到it's work的基本网页了。但是php和mysql还没有协同工作起来。
安装phpmyadmin:
apt-get install phpmyadmin
在安装过程中会询问你使用的web服务器的类型，选择apache,询问mysql的密码。安装完成后测试phpinfo();至此，你的
web服务器完全安装完毕。
7、debian:修改默认web服务端口为8082
诅咒下狗日的chinanet!!!害的老子不能使用80端口，我没有运行iptables所以不用修改。
1、修改：/etc/apache2／ports.conf：
NameVirtualHost *:8082
Listen 8082
如果仅仅修改这里在restart apache2时会报错，实际上该设置也不会工作。还需要更改：
/etc/apache2/sites-available文件中的：<VirtualHost *:80>为8082。
然后重启apache2。ok～～
2、修改默认的主页为index.php
初始状态下默认的主页为index.html.若修改为php则在/etc/apache2/中修改httpd.conf，开始我的该文件为空，添加：
&lt;ifModule dir_module&gt;
Directoryindex index.php index.html
&lt;/ifModule&gt;
即可。
二、一些常用的配置文件：
1、修改dhcp配置或静态ip：/etc/network/interfaces
# 启动系统激活设备
# Loop回环地址
auto lo
iface lo inet loopback 
# 启动系统激活设备
# 网卡eth0设置为DHCP类型
auto eth0
iface eth0 inet dhcp
# 网卡eth0设置为Static类型
auto eth0
iface eth0 inet static
# 指定IP地址、子网掩码、广播、网关、dns
address 192.168.0.1
netmask 255.255.255.0 
network 192.168.0.0
broadcast 192.168.0.255
gateway 192.168.0.1
dns-nameservers 202.102.152.3
dns-search .com
2、apache相关配置：/etc/apache2/ports.conf,httpd.conf,
/etc/apache2/sites-available/default
3、locale的相关配置:/etc/default/locale
4、startx相关配置：目前我还没弄明白怎么安装完fluxbox后运行startx就直接启动起来fluxbox了，好像系统没有
使用~/.xinitrc,~/.Xresession以及/etc/X11/下的配置文件。
终于搞明白了～～～～
他的默认启动真是特别：
默认的启动脚本 /etc/X11/Xsession 是 /etc/X11/Xsession.d/50xfree86-common_determine-startup 和 
/etc/X11/Xsession.d/99xfree86-common_start 的高效的结合体。
/etc/X11/Xsession 的执行会受 /etc/X11/Xsession.options 的影响，从本质上讲，它使用 exec 命令执行系统中按下面
的次序排序，排在第一位的程序：
~/.xsession or ~/.Xsession，如果它被定义。
/usr/bin/x-session-manager，如果它被定义。
/usr/bin/x-window-manager，如果它被定义。
/usr/bin/x-terminal-emulator，如果它被定义。
Debian 选择系统(Debian alternative system )对这些命令的确切定义进行了描述，参阅Alternative 命令, 第 6.5.3 节。例如：
     # update-alternatives --config x-session-manager
     ... 或
     # update-alternatives --config x-window-manager
如果想定义某 X 窗口管理器为默认窗口管理器，同时保留已安装的 GNOME 和 KDE 会话管理器，可用 http://bugs.debian.org/168347
中第二个错误报告所附的文件替换 /etc/X11/Xsession.d/50xfree86-common_determine-startup 文件(我希望它能早日加到发行版中)，
然后按下面的方法编辑 /etc/X11/Xsession.options 来禁用 X 会话管理器：
     # /etc/X11/Xsession.options
     #
     # configuration options for /etc/X11/Xsession
     # See Xsession.options(5) for an explanation of the available options.
     # Default enabled
     allow-failsafe
     allow-user-resources
     allow-user-xsession
     use-ssh-agent
     # Default disabled (enable them by uncommenting)
     do-not-use-x-session-manager 
     #do-not-use-x-window-manager 在这里！如果禁止的话要在这里明确do-not-use，否则会按上面的顺序在
~/.xsession or ~/.Xsession没有定义的话接下来就执行到/usr/bin/x-session-manager了，看看这个命令是何方神圣？
原来是个指向/etc/alternatives/x-window-manage,而这个x-window-manage又是一个链接，竟然是链接的/usr/bin/startfluxbox
哈哈，至此原形毕露～～
字符界面下使用apt-get安装时出现错误的解决方法：
一般运行apt-get install ***这些command的时候，会出现下面的一些错误提示:
perl: warning: Setting locale failed.
perl: warning: Please check that your locale settings:
LANGUAGE = (unset),
LC_ALL = (unset),
LANG = \"zh_CN.UTF-8\"
are supported and installed on your system.
perl: warning: Falling back to the standard locale (\"C\").
这是因为你的本地 locale设置出了问题.
修改一下locale文件，打开文件:vim /etc/default/locale
删除里面所有内容：只要有这样的内容：LANG = en_US.utf8，要确保你的系统中装了这个en_US.utf8。不然问题不能解决。
然后再运行dpkg-reconfigure locales.选择你要的语言。然后按Enter,选择en_US.utf8。这样就可以解决上面的问题了。如若还有问题。
那手动修改一下。输入以下命令
export LC_ALL=\"en_US.utf8\"
export LANG=\"en_US.utf8\"
export LANGUAGE=\"en_US.utf8\"
</font><br><font color=red size=4>
(1)关于声音音量的保存，安装alsa-utils包即可实现设定音量的保存。在使用alsamixer调节音量时不小心将主声道设为了静音，静音的
标志是MM，正常应为oo，可选中主声道后按m切换。
(2)关于屏幕亮度的保存，每次开机屏幕亮度都会自动恢复到系统默认的亮度，但是可以在~/.bashrc文件中添加：
echo 9 > /sys/class/backlight/acpi_video0/brightness
来实现每次登录后的自动调整。
(3)关于分辨率的设定，xrandr命令集成在xorg包中，如果没有安装xorg（比如我，只安装了xserver-xorg和xinit）则不会有xrandr
(4)关于firefox安装flash player11的说明，flashplayer的网站上有flashplayer的deb安装包，不过该包的flashplayer版本是10.0
在同一下载页面还有tar.bz的安装包，这个是版本11的。下载该包解压，得到一个usr/目录和libflashplayer.so文件以及一个readme
文件，查看readme文件可知安装方法：拷贝so文件至'BrowserPluginsLocation'目录下，该目录为 ~/.mozilla/plugins/或者
/usr/lib/mozilla/plugins/这个目录。然后cp -r usr/* /usr即可。
</font><font color=blue size=4>
安装完后还有一些必须安装的包，在这里记录下：
apt-get install gcc   --gcc的安装
apt-get install kernel-package  --所有编译相关的库及应用安装（包括make）
apt-get install linux-headers-3.2.0-4-686-pae  --安装内科模块所需的kernel源文件
apt-get install fcitx-googlepinyin  --输入法

无线网卡的安装：
在系统安装界面可以选择存在的两块网卡（单位本本，debian7才认无线卡）虽然提示固件的缺失但是忽略掉即可，
选择无线网卡作为首选网卡，选择找到的wifi，输入链接密码，即可链接。但是当指定使用dhcp链接时，设置不会写入到
/etc/network/interface文件中，必须手动添加。同时必须保留默认的对lo的设置，如果屏蔽掉lo的设置则一些对localhost
的访问全部无法实现（我的mysql一开始就犯了这个错误）。
--------------------------2015-8-6添加，关于网络的选择使用和配置的相关内容----------------------------------
Debian关于网络配置以及网络选择的相关操作
1、相关网站的链接：
https://wiki.debian.org/WiFi/
2、相关命令：
ifconfig,iwconfig,route -n,ifup,ifdown,ifquery,iwlist
具体用法请使用man
3、相关配置：
/etc/network/interfaces，记录下我单位本本的配置：

auto lo
iface lo inet loopback

auto eth0
iface eth0 inet static
address	192.168.0.11
netmask	255.255.255.0
network	192.168.0.0
broadcast 192.168.0.255
gateway 192.168.0.1
dns-nameservers 202.102.134.68

#auto wlan0
iface wlan_home inet static
address 192.168.1.118
netmask 255.255.255.0
network 192.168.1.0
gateway 192.168.1.1
dns-nameservers 202.102.134.68
wpa-ssid bitsfox
wpa-psk mypassword

#auto wlan0
iface wlan_work inet static
address 192.168.0.118
netmask 255.255.255.0
network 192.168.0.0
gateway 192.168.0.1
dns-nameservers 202.102.134.68
wpa-ssid Tenda_07BE70
wpa-psk mypassword

该配置默认启动eth0,当需要链接wifi时，首先:
ifdown eth0
ip addr flush dev eth0
ifup wlan0=wlan_work	(在办公室，连接办公室的wifi)
或：
ifup wlan0=wlan_home	(在家，连接家里的wifi)
切换时：ifdown wlan0;ifup eth0

另外，在进行wifi切换时容易出现：RTNETLINK answers: File exists 错误
网上查询这个错误产生的大部分原因是由于服务冲突引起的：
/etc/init.d/network 和 /etc/init.d/NetworkManager
但是，我的机器上没有manager管理服务，所以肯定不是由于服务冲突引起的。
还有一种可能，就是某些网络服务（例如apache等）已经应用了之前的设置，对于这种情况
可以尝试使用如下命令刷新：
ip addr flush dev eth0(or wlan0)
这样应该能解决错误。


------------------------------------------------------------------------------------------------------------
另外一个特殊的情况就是mysql客户端不能以root@localhost链接的问题：
ERROR 1045 (28000): Access denied for user root@localhost (using password: NO)
解决方法：
直接使用/etc/mysql/debian.cnf文件中[client]节提供的用户名和密码登录:
# mysql -udebian-sys-maint -p
Enter password: <输入[client]节的密码>
mysql>use mysql;   --指定数据库
mysql> UPDATE user SET Password=PASSWORD(’newpassword’) where USER=’root’;
mysql> FLUSH PRIVILEGES;
mysql> quit 
完成后即可正常登录了。
					   
-------------------------------------------------------
关于新版主页的登录问题：
由于新版使用了数据库来保存页面的数据，因此必须在数据库中加入其相应的数据库资料和用户。
网页数据库数据的导出：mysqldump web_data > web_data.sql
导入：mysql web_data < web_data.sql
数据库用户的添加：
grant select,insert,update,create,drop on web_data.* to 'taenv'@'localhost' identified by 'password';

这样就可以使用新版的主页了。

<font color=red size=5>在使用apt-get update更新时提示没有公钥的问题解决</font>
执行：
gpg --keyserver subkeys.pgp.net --recv 2B90D010
gpg --export --armor 2B90D010 | apt-key add -
其中：2B90D010为提示的公钥的后8位，如果不是root权限的话，apt-key 命令之前加sodu
这样就可以添加新的公钥了
</font></pre>";
?>




