<?php
echo "<center><font color=red size=5>snap移除</font></center>";
echo "<pre>
1、snap可以安全放心的移除，之前使用他是因为两个游戏模拟器：citra和yuzu。后来喜欢上了appimage的模式，所以不再因为两个模拟器忍受snap了

# 查询当前系统上snap安装了哪些app
snap list
2、
#移除snap-store
sudo snap remove snap-store
#移除firefox
sudo snap remove firefox
#移除gnome-3-38-2004
sudo snap remove gnome-3-38-2004
#移除其它...

#移除core20以及bare
sudo snap remove core20
sudo snap remove bare
3、
#使用apt移除掉snap
sudo apt autoremove --purge snapd
#移除snapd的一些目录
sudo rm -rf /var/cache/snapd
sudo rm -rf ~/snap
4、
禁止重新安装Snap
我们可以利用APT可配置禁用安装哪些依赖的特性，来实现禁止重新自动安装Snap服务
sudo vim /etc/apt/preferences.d/nosnap.pref
Package: snapd
Pin: release a=*
Pin-Priority: -10
这样就可以了。但这样会带来一个问题，就是在ubuntu22.04版本上sudo apt install firefox会报错，因为它依赖snap，又不允许安装snap

在删除掉Snap后，其实没法再通过Snap或Apt来安装Firefox了，而Firefox官网提供的下载，又没有deb包，没有桌面快捷方式，不是非常方便。
所以，你可以考虑使用Mozilla提供的源来安装Firefox：
# 添加Mozilla提供的源（ubuntu22.04版本之前无需，因为apt源里有firefox）
sudo add-apt-repository ppa:mozillateam/ppa
并设定该PPA源安装的高优先级：
sudo sh -c 'cat > /etc/apt/preferences.d/mozillateam-firefox.pref' << EOL
Package: firefox*
Pin: release o=LP-PPA-mozillateam
Pin-Priority: 501
EOL

# 安装Firefox
sudo apt update
sudo apt install firefox

安装apt源里的可视化软件仓库：
sudo apt install gnome-software















</pre>";
echo "<br><br><br><br><br><br><br><br><br><br><pre>
<a name=rpm><center><font size=5 color=red>ubuntu 如何安装rpm包</font></center>
在Ubuntu上安装RPM包（Red Hat Package Manager包）通常不是一个直接的过程，因为Ubuntu使用的是Debian包管理器（dpkg或apt）。然而，你可以通过一些方法间接地在Ubuntu上安装RPM包。以下是几种常见的方法：
方法1：使用alien工具
    安装alien工具：
    首先，你需要安装alien工具，这个工具可以将RPM包转换成Debian包。打开终端并输入以下命令来安装alien：
sudo apt-get update
sudo apt-get install alien
转换RPM包：
使用alien将RPM包转换为Debian包。例如，如果你有一个名为example.rpm的文件，你可以使用以下命令：
sudo alien -d example.rpm
这个命令会生成一个.deb文件。
安装Debian包：
使用dpkg或apt安装生成的.deb文件：
    sudo dpkg -i example_*.deb
    sudo apt-get install -f  # 修复依赖问题

方法2：使用rpm2cpio和cpio
    安装必要的工具：
sudo apt-get install rpm2cpio cpio
将RPM包转换为CPIO归档：
rpm2cpio example.rpm | cpio -idmv
这个命令会将RPM包的内容解压到当前目录。
手动安装：
根据解压后的内容，你可能需要手动安装软件，这通常涉及到配置脚本和make命令。例如：
./configure
make
sudo make install
<br><br><br><br><br><br><br><br><br><br><br><br>

</pre>";
?>
