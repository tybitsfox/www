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
?>
