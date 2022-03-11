<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<center><font size=5 color=red>Ubuntu 20.04安装笔记</font></center>";
echo "<font size=4 color=blue><pre>
install:
aptitude
vim-gtk3
ctags

------------------------------
edit .bashrc
cp .vim/ .vimrc
cp -r winfonts/ to /usr/share/fonts/truetype/
change video card driver to nvidia 460
reboot
edit /boot/grub/grub.cfg
----------------------------------------------
install:
apache2
mariadb10.3-server(client)
php7.4
php-mysql
libapache2-mod-php7.4 (可能已经安装)
php7.4-gd
导入数据库:
web_data:	taenv	taenv2014;
gis_hb2018: sdhl	sdhl2016;
create database web_data;
use web_data;
source /home/tian/web_data.sql;
create user 'taenv'@'localhost' identified by 'taenv2014';
grant all on web_data.* to 'taenv'@'localhost';
----------------------------------------------------
edit /etc/apache2/sites-available/default-ssl.conf
edit /etc/apache2/sites-available/000-default.conf
修改默认的网站目录为：/var/www
进入/etc/init.d/重启服务：./apache2 restart
拷贝www目录至/var/ 网站设置完成!
----------------------------------------------------
界面美化：
sudo apt install gnome-tweaks
打开网站：https://extensions.gnome.org/
安装：'User Themes'和'Dash to Dock'
然后打开'扩展'，禁用ubuntu dock,启用并配置dash to dock,重启完成！
----------------------------------------------------------------
继续安装我常用的软件：
git
vlc
openssh-server
kernel-wedge
libgtk2.0-dev
libgtk-3-dev
zathura
mednafen
scrot
feh
xterm
fluxbox
pcsx2:i386
desmume

---------------------------------------------------------------
xmame所需运行库:
libXv.so.1 => sudo apt install ibxv1:i386
缺少声音模块：snd-pcm-oss.ko 没有声音
牛逼的不要不要！哈哈，成功将xmame完美运行在ubuntu20.04上了！！；）
由于自ubuntu10以后snd-pcm-oss.ko就已经被系统舍弃，因此对于使用老旧的oss声音
的软件就无法正常的通过加载上述模块使用声音了。通过网上查询，终于找到了一个可
行的方法：安装libpulsedsp,这个库可以将使用oss输出的软件，通过pulseaudio模拟
输出！因为我使用的还是32位的xmame，因此应安装32位版本的库文件：libpulsedsp:i386 
(关于osspd.conf，这个文件在/etc/modprobe.d中，应该是必须的配置文件，之前我测试的方法很多，以至于在这个目录下产生了多个配置文件，还导致了声音无法打开的情况：声音设置中设备显示的是伪输出，配置多是oss4的：
 ss4-base.conf,oss4-base_noOSS3.conf,oss4-base_noALSA.conf,可以确定伪输出的产生就是这些配置造成的。
 osspd.conf:
blacklist snd-pcm-oss
blacklist snd-mixer-oss
blacklist snd-seq-oss)

安装完成后需使用脚本文件实现加载：
xmame.sh
#!/bin/bash
export LD_PRELOAD='/usr/lib/i386-linux-gnu/pulseaudio/libpulsedsp.so'
/workarea/home/tian/games/xmame/xmame $1

通过这个脚本，即可完美实现xmame在系统上的重生！；）
---------------------------------------------------------------
自此，我所需要的东西基本都安装完成了，还剩一个最喜爱的ps1模拟器：ePSXe
这个软件也是一款老旧软件了，但是他无可比拟的性能让pcsxr等新生代ps1模拟器
无法望其项背！虽然有64位版本，但是其所需的64位运行库我无法找到了。而32位
的运行库因为之前在debian中一直使用，所以都得以保存。拷贝过来，还需安装一些
i386下的库文件，为了将来着想，将其一并记录保存下来：

libncurses.so.5
libtinfo.so.5
libSDL-1.2.so.0
libSDL_ttf-2.0.so.0
libnghttp2.so.14
librtmp.so.1
libssh2.so.1
libcaca.so.0
libsasl2.so.2
libslang.so.2
libncursesw.so.6
完美的库文件都以放置在/usr/local/lib/old_lib目录下</pre></font>
";
echo "<br><br><center><font size=5>AMD显卡的驱动安装</font></center>";
echo "<font size=4><pre>
一、相关信息查询命令：
sudo lshw -c video
lsmod | grep amd
dmesg | grep amd
二、安装驱动方法
1、使用开源驱动，无需多说，系统安装时会自动安装
2、使用第三方仓库，安装amd官方驱动
添加私有源：sudo add-apt-repository ppa:oibaf/graphics-drivers
然后执行如下命令：sudo apt update && sudo apt -y upgrade 即可
保险其间，如果想卸载私有源驱动，可使用：
sudo apt install ppa-purge
sudo ppa-purge ppa:oibaf/graphics-drivers
3、使用源代码直接编译
进入amd主页，下载源代码，执行如下命令解压安装：
tar -xf amdgpu-pro_*.tar.xz
cd amdgpu-pro-XX.XX-XXXXXX
./amdgpu-pro-install -y
</pre></font><br><br>";
echo "ubuntu使用fluxbox时挂载u盘出现乱码的解决：<br>
mount -t vfat -o iocharset=utf8 /dev/sdc1 /mnt<br><br><br><br><br>";
?>
