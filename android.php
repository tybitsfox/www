<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<center><font size=4 color=red> Android 开发</font></center>";
echo "<br><table width=100%><tr width=100%><td width=100%>";
echo "<font size=4 color=black>一、关于Android SDK的更新<br>";
echo "狗日的大中华局域网，使用默认的更新地址：<br>https://dl-ssl.google.com/android/repository/addons_list-1.xml<br>
http://dl-ssl.google.com/android/repository/repository-6.xml<br>无法更新，在网上搜索方法，需修改hosts文件，添加
<br>203.208.46.146 dl.google.com<br>203.208.46.146 dl-ssl.google.com<br>才可以进行更新。</font>";
echo "</td></tr></table>";
echo "<hr size=2 width=90%><br><font size=4 color=red>二、Android SDK基本应用<br></font>";
echo "<font size=3 color=black><pre>
1. 显示系统中全部Android平台：
    android list targets
2. 显示系统中全部AVD（模拟器）：
    android list avd
3. 创建AVD（模拟器）：
    android create avd --name 名称 --target 平台编号
4. 启动模拟器：
    emulator -avd 名称 -sdcard ~/名称.img (-skin 1280x800,HVGA)
例：创建一个大小512M ROM type＝3，名字为aaa，生成路径为/workarea/aaa的
avd:
	android create avd -n aaa -t 3 -c 512M -p /workarea/aaa
	
5. 删除AVD（模拟器）：
    android delete avd --name 名称
6. 创建SDCard：
    mksdcard 1024M ~/名称.img
7. AVD(模拟器)所在位置：
    Linux(~/.android/avd)      Windows(C:\Documents and Settings\Administrator\.android\avd)
8. 启动DDMS：
    ddms
9. 显示当前运行的全部模拟器：
    adb devices
10. 对某一模拟器执行命令：
      abd -s 模拟器编号 命令
11. 安装应用程序：
      adb install -r 应用程序.apk
12. 获取模拟器中的文件：
      adb pull <remote> <local>
13. 向模拟器中写文件：
      adb push <local> <remote>
14. 进入模拟器的shell模式：
      adb shell
15. 启动SDK，文档，实例下载管理器：";
echo "
      android
16. 缷载apk包：
      adb shell
      cd data/app
      rm apk包
      exit
      adb uninstall apk包的主包名
      adb install -r apk包
17. 查看adb命令帮助信息：
      adb help
18. 在命令行中查看LOG信息：
      adb logcat -s 标签名
19. adb shell后面跟的命令主要来自：
      源码\system\core\toolbox目录和源码\frameworks\base\cmds目录。
20. 删除系统应用：
      adb remount （重新挂载系统分区，使系统分区重新可写）。
      adb shell
      cd system/app
      rm *.apk
21. 获取管理员权限：
      adb root
22. 启动Activity：
      adb shell am start -n 包名/包名＋类名（-n 类名,-a action,-d date,-m MIME-TYPE,-c category,-e 扩展数据,等）。
23、发布端口：
    你可以设置任意的端口号，做为主机向模拟器或设备的请求端口。如：
adb forward tcp:5555 tcp:8000
24、复制文件：
    你可向一个设备或从一个设备中复制文件，
     复制一个文件或目录到设备或模拟器上：
  adb push <source> <destination></destination></source>
      如：adb push test.txt /tmp/test.txt
     从设备或模拟器上复制一个文件或目录：
     adb pull <source> <destination></destination></source>
     如：adb pull /addroid/lib/libwebcore.so .
25、搜索模拟器/设备的实例：
     取得当前运行的模拟器/设备的实例的列表及每个实例的状态：
    adb devices
26、查看bug报告：
adb bugreport
27、记录无线通讯日志：
    一般来说，无线通讯的日志非常多，在运行时没必要去记录，但我们还是可以通过命令，设置记录：
    adb shell
    logcat -b radio
28、获取设备的ID和序列号：
     adb get-product
     adb get-serialno
29、访问数据库SQLite3";
echo"
     adb shell
     sqlite3
Android adb root权限

修改./default.prop

把ro.secure设为0，persist.service.adb.enable设为1，adbd进程就会以root用户的身份启动。
原理：
可以看一下Android系统根目录下的/init.rc的片段：
… …
# adbd is controlled by the persist.service.adb.enable system property
service adbd /sbin/adbd
disabled
# adbd on at boot in emulator
on property:ro.kernel.qemu=1
start adbd
on property:persist.service.adb.enable=1
start adbd
on property:persist.service.adb.enable=0
stop adbd
… …
这里定义了一个触发器，只要persist.service.adb.enable值被置为1，就会启动/sbin/adbd。
只看两个属性ro.secure，persist.service.adb.enable。当前是user模式的话，编译系统会把 ro.secure置为1，把persist.service.adb.enable置为0.也就是说，用
user模式编译出来的系统运行在安全模式 下，adbd默认关闭。即使通过设置属性的方式打开，adbd进程的用户也是shell，不具有root权限。这样，普通用户或者开发
者拿到一个机器后， 通过PC运行adb shell时，是以shell用户登录机器的。
好了，现在把ro.secure置为0，再重新编译，只要设置属性persist.service.adb.enable的值为1，adbd进程就会以root用户的身份启动。

USB Vendor IDs
Company	USB Vendor ID

Acer 	0502
ASUS 	0b05
Dell 	413c
Foxconn 	0489
Fujitsu 	04c5
Fujitsu Toshiba 	04c5
Garmin-Asus 	091e
Google 	18d1
Hisense 	109b
HTC 	0bb4
Huawei 	12d1
K-Touch 	24e3
KT Tech 	2116
Kyocera 	0482
Lenovo 	17ef
LG 	1004
Motorola 	22b8
NEC 	0409
Nook 	2080
Nvidia 	0955
OTGV 	2257
Pantech 	10a9
Pegatron 	1d4d
Philips 	0471
PMC-Sierra 	04da
Qualcomm 	05c6
SK Telesys 	1f53
Samsung 	04e8
Sharp 	04dd
Sony 	054c
Sony Ericsson 	0fce
Teleepoch 	2340
Toshiba 	0930
ZTE 	19d2

获得 android 的 root 权限
消歧
使用 adb 连接到设备获得的 root 权限并不是 设备所拥有的 root。
也就是说，连接设备成功后，我们对设备的系统具有了 root 权限，而设备系统自身并没有 root 权限。例如您在 market 看到 need rooted device 字样，那就是意
味着您的设备系统也具有 root 权限。通常来说，root 指设备自身可以执行 su 并获得 root 权限。
原理
adb ( android debug bridge ) 链接设备，并使用具有 root 权限的 adb 修改/替换设备 su 文件，从而具有 root 权限。
前期准备
    * 访问 http://developer.android.com/sdk/index.html (need proxy)，获取 adb 工具（需要下载 sdk，windows 还需额外下载 usb 驱动）；
    * 开启您的 android 设备，并执行如下操作： settings — application — development， 勾选usb debugging；
创建 /etc/udev/rules.d/51-android.rules 文件，内容如下：
ubuntu:
SUBSYSTEM==\"usb\",SYSFS{idvender}==0bb4,MODE=0666     //0bb4是htc的id
SUBSYSTEM==\"usb_device\",SYSFS{idvender}==0bb4,MODE=0666     //0bb4是htc的id
其中 USB vender IDS 如上所列。
更改文件权限：
chmod a+rx /etc/udev/rules.d/50-android.rules
重新加载 udev 规则：";
echo "
udevadm control –reload-rules
# 下载越狱软件包，并把 su 拷贝到 adb/tools 内
开始～
插入 usb 数据线，然后打开终端，进入 adb/tools 目录，执行
adb devices
    Android adb devices显示 ????????????    no permissions怎么办？
   
 Windows：运行adb root
    Linux：
    adb kill-server
    sudo adb root
此时显示为：
List of devices attached
0123456789ABCDEF    device
成功列出已连接的设备后，执行
adb shell mv /system/xbin/su /system/xbin/osu      # 备份原 su 文件
adb push su /system/xbin      # 把 adb/tools 的 su 文件 推送到 android设备 /system/xbin
adb shell rm /system/bin/su      # 移除其他的 su 文件
adb shell ln -s /system/xbin/su /system/bin/su      # 软链 su
adb shell chmod 6755 /system/xbin/su       # 变更权限
adb shell sync      # 同步所有缓存中的文件
adb shell reboot      # 重启 android 设备
（您需要根据您的设备和设置变更执行的路径）
等待设备重启完成后，可以在 adb shell 模式输入：su（回车），会出现su: access granted, courtesy of www.magicandroidapps.com #等提示，代表成功了。
系统：ubuntu 11.10 内核：3.0.0-12-generic
第一次使用的话，首先需要给给手机注册驱动，手机设置到usb调试模式并连接电脑，使用一下命令查看：
一、lsusb 显示usb设备 
Bus 001 Device 001: ID 1d6b:0002 Linux Foundation 2.0 root hub
Bus 002 Device 001: ID 1d6b:0001 Linux Foundation 1.1 root hub
Bus 003 Device 001: ID 1d6b:0001 Linux Foundation 1.1 root hub
Bus 004 Device 001: ID 1d6b:0001 Linux Foundation 1.1 root hub
Bus 005 Device 001: ID 1d6b:0001 Linux Foundation 1.1 root hub
Bus 001 Device 021: ID 18d1:d00d Google Inc. 
红色的是我的手机设备信息，接下来创建设备驱动配置文件rules，在SDK的帮助文档里有关于这个问题的说明：
If you’re developing on Ubuntu Linux, you need to add a rules file that contains a USB configuration for each type of device you want to use for 
development. Each device manufacturer uses a different vendor ID. The example rules files below show how to add an entry for a single vendor ID 
(the HTC vendor ID). In order to support more devices, you will need additional lines of the same format that provide a different value for the 
SYSFS{idVendor} property. For other IDs, see the table of USB Vendor IDs, below.
   1. Log in as root and create this file: /etc/udev/rules.d/51-android.rules.
      For Gusty/Hardy, edit the file to read:
      SUBSYSTEM==\"usb\", SYSFS{idVendor}==\"0bb4\", MODE=\"0666\"
      For Dapper, edit the file to read:
      SUBSYSTEM==\"usb_device\", SYSFS{idVendor}==\"0bb4\", MODE=\"0666\"
   2. Now execute:
      chmod a+r /etc/udev/rules.d/51-android.rules
二、如法炮制，注意，ubuntu下面登录的用户是普通用户需要通过sudo获取root权限来创建以上配置文件：
sudo vi /etc/udev/rules.d/51-android.rules
正文：
#My android phone -> Bus 001 Device 021: ID 18d1:d00d Google Inc. 
SUBSYSTEM==\"usb\", SYSFS{idVendor}==\"18d1\", MODE=\"0666\"
说明: ID:18d1:d00d 为设备的 idVendor:idProduct  值。如果还有其他android手机可以按照以上方法加到此文件中。
保存 退出。
三、接下来修改rules权限，重启udev服务:
sudo chmod a+r /etc/udev/rules.d/51-android.rules
sudo service udev restart
四、拔下手机数据线重新连接：
cd 到android-sdk adb的目录下面。
su 进入root用户
./adb kill-server
./adb start-server
./adb devices
List of devices attached 
xxxxxxxx device xxx是你设备哦
exit
有关 Android 的刷机，国内能找的一些方法基本都是在 Windows 环境下完成的，关于 Linux 环境的介绍少之又少。下面我以 Motorola Defy 为例，简单介绍一下
在 Linux 环境下进行刷机和获取 Root 的方法。
这里的刷机指的是安装 Motorola 官方提供的 SBF 固件到手机上。
需要准备的软件有：
    * Motorola 的 SBF 固件（最好先了解一下固件的具体情况）
    * Android SDK for Linux 工具包（Google 提供的 SDK 工具包，主要用到 ADB）
    * sbf_flash（一个安装 SBF 到手机的程序）
    * defy-tools（用于获取 Root，sbf_flash 已经包含在压缩包内）
步骤 01. 首先解压 Android SDK for Linux 工具包 到你能找到的位置，通过 Root 终端 进入到 android-sdk-linux/tools 目录，键入 ./android 选择安装 
Android SDK Platform-tools。
步骤 02. 解压 defy-tools 并把目录里面的全部文件复制到 android-sdk-linux/platform-tools 目录，在 Root 终端 键入 chmod +x sbf_flash 赋予 sbf_flash
可执行权限。
步骤 03. 将 Defy 的 SBF 固件（如 defy.sbf）也复制到 android-sdk-linux/platform-tools目录。";
echo "
步骤 04. 在手机关机状态下，按 减音量键 和 电源键 进入 Recovery 擦除手机数据。
步骤 05. 同样在手机关机状态下，按 加音量键 和 电源键 键入 Bootloader 模式，用 USB 数据线连接到电脑，在 Root 终端 键入 lsusb 查看手机是否被电脑识别。
步骤 06. 通过 Root 终端 进入到 android-sdk-linux/platform-tools 目录，键入./sbf_flash defy.sbf 将 defy.sbf 固件 安装到手机。安装完成手机会自动开机
进入新系统，启动正常说明本次刷机完成。
步骤 07. 开启手机的 USB 调试 和 允许未知来源，用 USB 数据线连接电脑，通过 Root 终端 进入到 android-sdk-linux/platform-tools 目录，键入
./adb start-server 启动 ADB 服务，继续键入 ./adb devices 查看手机是否被电脑识别。
步骤 08. 在 Root 终端 键入 ./adb push zerg /data/local/zerg 将 zerg 传送到手机，键入 ./adb shell \"chmod 755 /data/local/zerg\" 更改 zerg 在手机
上的权限，键入 ./adb shell \"/data/local/zerg\" 在手机上执行 zerg。
步骤 09. 在 Root 终端 键入 ./adb remount 挂载手机系统，键入 ./adb push su /system/xbin/su 将 su 传送到手机，键入 ./adb shell \"chmod 4755 
/system/xbin/su\" 更改 su 在手机上的权限，键入 ./adb shell \"ln -s /system/xbin/su /system/bin/su\" 为 su 建立位置链接。
步骤 10. 在 Root 终端 键入 ./adb push busybox /system/bin/busybox 将 busybox 传送到手机，键入 ./adb shell \"chmod 755 /system/bin/busybox\" 更改
busybox 在手机上的权限，键入 ./adb shell \"/system/bin/busybox --install -s /system/xbin\" 在手机上安装 busybox。
步骤 11. 在 Root 终端 键入 ./adb install Superuser.apk 安装 Superuser.apk 到手机，键入 ./adb shell \"echo \"ro.sys.atvc_allow_all_adb=1\" > 
/data/local.prop\" 在手机上添加变量。
步骤 12. 在 Root 终端 键入 ./adb reboot 重启手机，继续键入 ./adb kill-server 结束 ADB 服务。至此，获取 Root 完成。
获取 Root 的详细命令列表包含在 defy-tools 压缩包内的 Readme.txt 文档。
其实在 Linux 刷机并不比在 Windows 困难，只是 Linux 在国内用的人不多，很难看到这方面的资料。
软件下载／原文链接：http://blog.jianqun.me/post/20662536584
－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－－
简单获取root的代码如下：
adb shell
su
mount -o remount,rw -t yaffs2 /dev/block/mtdblock3 /system
cd /system/bin
cat sh > su
chmod 4755 su
具体操作：
1，确保手机设置里“USB调试模式”勾选着
2，手机用USB线连接电脑
3，下载adb工具（已经有的就不用下载了），网上到处都有提取出来的adb工具，非常小，如果找不到可以点这里下载：（链接）
4，把adb.exe和winadbapi.dll解压到系统目录，比如 C:\Windows\ ，这是为了方便输入命令。
5，打开“运行”，输入cmd，回车。
6，输入adb shell，连接手机。
7，按顺序敲入上面的代码。
8，重启。
===============================================================
下载ADB工具放入任意盘,如果手机可以正常进入系统请在设置里打开USB调试模式,若不能进入则请进入recovery模式.
在DOS下输入以下命令基本可以完成刷机任务,一些常用命令解释如下:
adb devices - 列出连接到电脑的android设备,一般显示出手机的P/N码.如果没有显示则表明手机与电脑没有连接上.
adb install <packagename.apk> - 将软件安装到手机中.
adb remount - 重新打开手机重写模式(即刷机模式).
adb push <localfile> <location on your phone> - 将本地文件传输到手机,如:adb push vwe1.91.zip /sdcard/vwe1.91.zip.
adb pull <location on your phone> <localfile> - 将手机文件传输到本地.
adb shell <command> - 让手机执行命令,<command>就是手机执行的命令.adb shell flash_image recovery /sd-card/123.img,执行将123.img
（事先命名的recovery文件）写入.
刷recovery时一般按如下顺序:
adb shell mount -a
adb push recovery-RAv1.0G.img /system/recovery.img
adb push recovery-RAv1.0G.img /sdcard/recovery-RAv1.0G.img
adb shell flash_image recovery /sdcard/recovery-RAv1.0G.img reboot
其他是具体情况而定！
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Linux下Android手机刷机指南
一、为什么你的Android手机不会“变砖”？ 被锁的Bootloader，这又是什么意思？
对一些人来讲，被锁的Bootloader这个设置比较操蛋，而对大多数人来讲（一般不是高级玩家），这确实是一个相当酷的功能，这相当于给你的手机加了一道保险。
这个锁定的Bootloader, 就意味着你没有办法重写官方的Bootloader, 或者官方版的Recovery。
当手机打开Bootloader的时候，也就意味着基本上手机的全部硬件都打开了，手机处于可用的状态。我们就能使用官方恢复功能，手机的这一个功能也被锁定，
它既不能被删除，也不能被修改，但它具有恢复出厂功能，以及安装升级包的功能。
起初的时候，这个设置造成了一定的麻烦，因为有了这个被锁的Bootloader，你就没有办法安装一个像CM一样自定义的Rom。这时，2nd Init登场了，这个不起
眼的应用可以在Bootloader运行之后取得权限，允许Defy去加载一个不同的，非官方版的Android版本。
你甚至可以安装一个自定义的恢复软件，这个恢复软件可以在手机内存中运行，而不是从手机恢复分区中运行，这意味着什么呢？这就是说，即使你的手机变成砖了，
或者不慎删除了你的资料，又或者手机系统分区出现问题，你都可以利用它来进行恢复，手机仍能够被RSD(Linux下的一个刷机脚本，Windows下叫RSD Lite，很老的
刷机软件了。)以引导模式状态来识别，手机还能够用官方或者修改的Rom重新刷机。这样，手机又能正常使用了。
幸亏有了这个被锁的Bootloader, 这样即使你想把Android变砖也相当困难。
国内论坛中出现的众多问题实际上并不是真的变砖了，而是没有正确的刷SBFs。手机要是真的变砖了就意味着手机不能加载引导程序，也不能初始化手机硬件，
这时你就需要用JTAG来直接重新给你的手机写程序（这个软件我也不是很确定能不能在Defy上使用。）
二、root你的Android!
什么是root，为什么人人都在讨论它？
Android手机本质是Linux系统，生来文件系统就是被锁定的，这就是说用户只能对手机进行一些简单的操作，安装/卸载 应用程序，更换手机铃声或者其他的一些
基本的东西。你可以看到系统文件，但是不能对其进行操作，也不能更改Android系统的实际操作。
ROOT也就是说你可以像Linux系统管理员一样来访问手机系统。也就说你可以访问和改变系统文件，删除/创建 文件或文件夹等等。想要安装像2ndInit一样需要访
问Android系统文件的权限的应用的话，你就得取得读写系统文件的权限。
庆幸的是，给Defy Root是一件相对简单的事情，而且一般不会有什么问题。
友情提示：如果你买的是国行手机，取得root权限会使设备无法保修。
获取root权限：
1.安装ADB。
    1.)下载ADB for Linux的工具包，解压到你便于找到的地方。下载地址
    2.)新建并编辑一个文件：
    sudo vi /etc/udev/rules.d/51-android.rules
    在里面写入：
    SUBSYSTEM==\"usb\", ATTR{idVendor}==\"22b8\", MODE=\"0666\"
    3.)保存退出，设置权限：
    sudo chmod a+rx /etc/udev/rules.d/51-android.rules
    4.)编辑 ~/.bashrc 文件加入ADB tool的路径：
    vi ~/.bashrc
    在末尾加入刚下载的工具包解压的路径：
    export PATH=${PATH}:/home/rabbit/Documents/platform-tools
";
echo "
    5.)重启你的Ubuntu，然后USB连接手机，确保usb调试已打开，在终端下输入
    adb start-server
    adb devices
    如果一切正常，就能显示出当前连接到电脑的android设备。
2. 下载 rageinthecage-arm5和 Superuser package：
    rageagainstthecage-arm5：下载地址
    md5: bfa28d457b54508326ab55d11399c586
    Superuser package：下载地址
    md5: 43d9a40b63e916635d5ad7ca32433fab
3.解压 rageinthecage-arm5 和 Superuser package 到 adb 所在目录（Android SDK 安装目录的 /platform-tools 下）。
4.用 USB 数据线将 Motorola Defy 连上电脑。
5.在电脑上打开终端并运行下列命令：
    adb push rageagainstthecage-arm5.bin /data/local/tmp/
    adb shell
    chmod 755 /data/local/tmp/rageagainstthecage-arm5.bin
    /data/local/tmp/rageagainstthecage-arm5.bin
    运行完毕后继续执行下列命令：
    exit
    adb kill-server
    adb start-server
    adb shell
    注意：这时命令行的提示符应该是“#”。如果你看到的是“$”说明命令没有正确执行，请重试第4和第5步。
    mount -o rw,remount /system
    exit
    adb push su /system/xbin/
    adb shell chmod 4755 /system/xbin/su
    adb push Superuser.apk /system/app/
6.现在，你的 Motorola Defy 现在就拥有 ROOT 权限了。
1.linux下刷入SBF文件
什么是SBF？
SBF文件是Android打包的刷到你手机上全部信息的一个刷机包。在这个刷机包中，有众多的文件，每个文件都以CG XX命名，XX是数字，表示一个序号。
所以，当你给手机刷一个完整版的SBF文件时，它会先取得手机内存权限、格式化内存、创建新的分区，然后把刷机包中的文件拷贝到新的分区中。每个分区都对应
着一个CG XX的文件。
刷机包中包含着众多的CG文件，这些CG文件中含有Android系统的版本号。假设你在用Android 2.0，第一版，没有任何升级包，没有任何其他乱七八糟的应用。
这个版本的版本号就是第一版。
当手机升级之后，其版本号变成第二版，以此类推。每个Android版本都有独有的一个ID, 一旦你升级了，你就不能回滚到上个版本，在这个版本信息中保存在刷
机包的CG31和CG39的文件中。
SBF修改版
这个版本就是说移除CG31和CG39的SBF版本，这样就能在不同Android版本中自由迁移。但是，因为修改版的SBF不能创建 /System (CG39) 和nd CDT (CG31)2个分区，
我们需要自己用软件Nandroid Backup来复制系统文件，否则的话，手机可能在缺失/System的分区下不能正常使用。
这个软件就是一款能读写的可自定义恢复的zip文件，它能删除/拷贝 /system分区内的所有文件以及其他分区的文件，并且在操作的同时不会格式化分区也不会重
新划分分区，这样就既不会修改系统配置。这也就意味着你不可能在操作的时候把你的手机变成砖，但你可能会使Android系统不能启动，新的SBF包或者Nandroid
就需要安装。
CG 版本
有了以上的解释，顺便来说说CG版本。
如果你刷机的版本低于手机本来的版本，那么在手机启动之后会看到黑屏，或者是提示你刷一个官方的Rom版本。只要记住这一点，你就可以在不同Android版本之
间来回刷机了，这样也不会让你的手机变砖。如果你有一块Android 2.0版的defy，而且希望它一直保持降级的能力，你只需要安装一个你想要的Android版本的修
改版SBF,然后用相应的Nandroid来进行恢复系统文件。
官方SBF
这里是所有官方的SBF清单(目前这个清单下载链接已经失效，但可以作为参考，下载请看这个清单)，就是说它们都包含全部的CG文件，刷这些SBF后你的手机就像
刚从Moto卖给你一样，你要记着刷了这种完整的SBF包进行升级，你就不能降级到一个低版本了。了解了这些，你就应该能尝试不同的Android版本咯，也能毫无压
力的去商店咯。只要弄清楚CG文件的原理，大胆刷机吧。
Do it!
    0.)保持你的手机电量超过50%。(至少！)
    1.)下载你想刷的SBF文件。
    2.）下载sbf_flash文件到你的ADB目录下：下载。sbf_flash作者blog
    3.）
    chmod +x sbf_flash
    sudo ./sbf_flash xxxxxx.sbf
    现在，命令行应该会提示你重启手机到bootloader模式。 
2.通过fastboot刷入img文件
    1.）下载fastboot:点击下载
    2.）
    sudo chmod a+x fastboot
    sudo ./fastboot devices
    成功识别到设备会出现一行字，如果没有成功则什么都没有。
    3.)写一个文件到闪存分区,如写入一个文件到boot分区：
    sudo ./fastboot boot XXX.img
友情提示：想要从任何一个ROM版降级，你只需要刷装一个完整版的官方版的SBF（切记检查CG版本）。
四、常见问题及解决办法：
1.启动的时候黑屏：尝试安装一个比目前手机系统中CG版本更低的系统。
2.安装修改版SBF后出现灵异问题：安装一个与手机SBF相匹配的Nandroid备份，记着先在Recovery模式中清除系统缓存。
3.如何进入恢复模式?同时按下手机电源键和音量减，直到屏幕上出现一个黄色的三角形，一旦看到这个，就意味着进入了recovery模式。现在同时按住音量加
、音量减，屏幕上就会出现一个菜单，如果你的是 Éclair 版，不用按任何键就会出现这个菜单。
4.如何进入Bootloader模式？按住电源键和音量+键直到手机屏幕上出现一些白色的字，这就进入了Bootloader模式。
ATTRS{idVendor}==\"19d2\", ENV{adb_matched}=\"yes\"
usb_modeswitch -W -s 20 -v 0x19d2 -p 0x0083 -V 0x19d2 -P 0x1350 -m 0x01 -M \"55534243f8f993882000000080000a85010101180101010101000000000000\"
after that, although last message reports \"Mode switch has failed. Bye.\", but the id has changes to:
Bus 001 Device 015: ID 19d2:1366 ONDA Communication S.p.A.
http://dc348.4shared.com/img/1186052948/a6bb4a55/dlink__2Fdownload_2FPwGbqwLs_3Ftsid_3D20120414-85935-4222c1b0/preview.mp3
</pre></font>";
?>
