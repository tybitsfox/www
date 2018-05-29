<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<center><font size=4 color=red>linux 命令</font></center><br>";
echo "<a href=./order.php#ord01>一、内核安装相关</a><br><br>";
echo "二、实用命令<br>";
echo "<a href=./order.php#ord02>cli计算器bc</a><br>";
echo "<a href=./order.php#ord03>文件显示工具od</a><br>";
echo "<a href=./order.php#ord04>转换和拷贝工具dd</a><br>";
echo "<a href=./order.php#ord05>文件扩展属性lsattr,chattr</a><br>";
echo "<a href=./order.php#ord051>组成员管理工具gpasswd</a><br>";
echo "<a href=./order.php#ord052>用户帐号修改工具usermod</a><br>";
echo "<a href=./order.php#ord06>磁盘检查和修复命令e2fsck,fsck</a><br>";
echo "<a href=./order.php#ord07>分区和格式化命令mkfs,fdisk</a><br>";
echo "<a href=./order.php#ord071>常用抓屏工具</a><br>";
echo "<a href=./order.php#ord072>xset</a><br><br>";
echo "三、GNU实用工具程序<br>";
echo "<a href=./order.php#ord08>objcopy</a><br>";
echo "<a href=./order.php#ord09>查看elf可执行文件格式的两个命令objdump,readelf</a><br>";
echo "<a href=./order.php#ord101>生成64位可执行程序</a><br>";
echo "<br><br>";
echo "<a name=ord01></a><font size=4 color=blue>一、内核安装相关</font>";
echo "<font size=3 color=black><pre>
<font size=3 color=red>1、make menuconfig: 内核的菜单形式配置命令。</font>
<font size=3 color=red>2、make && make modules_install： 内核编译及安装命令。</font>
<font size=3 color=red>3、modproble：</font>
　　Linux命令：modprobe
　　功能说明：自动处理可载入模块。
　　语　法：modprobe [-acdlrtvV][--help][模块文件][符号名称 = 符号值]
　　补充说明：modprobe可载入指定的个别模块，或是载入一组相依的模块。modprobe会根据depmod所产生的相依关系，决定要载入哪些模块。
若在载入过程中发生错误，在modprobe会卸载整组的模块。
　　参　数：
　　-a或--all 载入全部的模块。
　　-c或--show-conf 显示所有模块的设置信息。
　　-d或--debug 使用排错模式。
　　-l或--list 显示可用的模块。
　　-r或--remove 模块闲置不用时，即自动卸载模块。
　　-t或--type 指定模块类型。
　　-v或--verbose 执行时显示详细的信息。
　　-V或--version 显示版本信息。
　　-help 显示帮助。
　　insmod 与 modprobe 都是载入 kernel module，不过一般差别于 modprobe 能够处理 module 载入的相依问题。
　　比方你要载入 a module，但是 a module 要求系统先载入 b module 时，直接用 insmod 挂入通常都会出现错误讯息，不过 modprobe 倒是能够知道先载入
b module 后才载入 a module，如此相依性就会满足。
　　不过 modprobe 并不是大神，不会厉害到知道 module 之间的相依性为何，该程式是读取 /lib/modules/2.6.xx/modules.dep 档案得知相依性的。而该档案
是透过 depmod 程式所建立。
<font size=3 color=red>4、 insmod：</font>
　　Linux指令：insmod——载入模块
　　insmod 就是install module的缩写
　　功能说明：载入模块。
　　语法：insmod [-fkmpsvxX][-o <模块名称>][模块文件][符号名称 = 符号值]
　　说明：Linux有许多功能是通过模块的方式，在需要时才载入kernel。如此可使kernel较为精简，进而提高效率，以及保有较大的弹性。这类可载入的模块，通
常是设备驱动程序。
参数：
　　-f 不检查目前kernel版本与模块编译时的kernel版本是否一致，强制将模块载入。
　　-k 将模块设置为自动卸除。
　　-m 输出模块的载入信息。
　　-o<模块名称> 指定模块的名称，可使用模块文件的文件名。
　　-p 测试模块是否能正确地载入kernel。
　　-s 将所有信息记录在系统记录文件中。
　　-v 执行时显示详细的信息。
　　-x 不要汇出模块的外部符号。
　　-X 汇出模块所有的外部符号，此为预设值。
</pre></font>";
echo "<a name=ord02></a><font size=4 color=blue>二、实用命令";
echo "<font size=3 color=black><pre>
<font size=3 color=red>1、bc: 一个cli的计算器，简单实用，功能强大。</font>
除了进行计算，还有个非常有用的功能：进行不同进制间的转换：
bc
ibase=A;obase=16;100
即可将十进制的100转换为十六进制的数值。
其中A表示十进制，但是，该工具有个小小的bug。就是十六进制的表示有点混乱。
开始时使用16表示十六进制，但是运行段时间后会提示有错，此时换为10也表示
十六进制。
bc进行浮点数运算：bc进行浮点数运算时需要使用scale=2，其中2为保留的小数位数。
如：scale=3;400/123

<a name=ord03></a><font size=3 color=red>2、od：一个简单的文件显示工具，可以按照指定的进制显示文件内容。</font>
od -x ./test.txt即可以十六进制显示文件内容。
</pre></font>";
echo "<font color=black size=3><pre>
<a name=ord04></a><font size=3 color=red>3、dd:</font>
dd 的主要选项：
指定数字的地方若以下列字符结尾乘以相应的数字:
b=512, c=1, k=1024, w=2, xm=number m
if=file
输入文件名，缺省为标准输入。
of=file
输出文件名，缺省为标准输出。
ibs=bytes
一次读入 bytes 个字节(即一个块大小为 bytes 个字节)。
obs=bytes
一次写 bytes 个字节(即一个块大小为 bytes 个字节)。
bs=bytes
同时设置读写块的大小为 bytes ，可代替 ibs 和 obs 。
cbs=bytes
一次转换 bytes 个字节，即转换缓冲区大小。
skip=blocks
从输入文件开头跳过 blocks 个块后再开始复制。
seek=blocks
从输出文件开头跳过 blocks 个块后再开始复制。(通常只有当输出文件是磁盘或磁带时才有效)。
count=blocks
仅拷贝 blocks 个块，块大小等于 ibs 指定的字节数。
conv=conversion[,conversion...]
用指定的参数转换文件。
转换参数:
ascii 转换 EBCDIC 为 ASCII。
ebcdic 转换 ASCII 为 EBCDIC。
ibm 转换 ASCII 为 alternate EBCDIC.
block 把每一行转换为长度为 cbs 的记录，不足部分用空格填充。
unblock 使每一行的长度都为 cbs ，不足部分用空格填充。
lcase 把大写字符转换为小写字符。
ucase 把小写字符转换为大写字符。
swab 交换输入的每对字节。
noerror 出错时不停止。
notrunc 不截短输出文件。
sync 把每个输入块填充到ibs个字节，不足部分用空(NUL)字符补齐。
特殊用途：
修复硬盘
dd if=/dev/sda of=/dev/sda
当硬盘较长时间（比如1，2年）放置不使用后，磁盘上会产生magnetic flux point。当磁头读到这些区域时会遇到困难，并可能
导致I/O错误。当这种情况影响到硬盘的第一个扇区时，可能导致硬盘报废。上边的命令有可能使这些数据起死回生。且这个过程
是安全，高效的。";
echo "<a name=ord05></a>
<font size=3 color=red>4、lsattr,chattr</font>
作用：显示和修改文件在linux第二扩展文件系统上的特有属性
lsattr选项：
-R      递归列出目录及其下内容属性
-V      显示版本信息
-a      列出目录中所有文件，包括隐藏文件的属性
-d      只列出目录属性
chattr选项：
+-=[ASacdisu]几种格式。
不更新（A）,同步更新（S），只能添加（a），压缩（c），不可变（i），不可转移>（d），
删除保护（s）以及不可删除（u）。
<a name=ord051></a><font size=3 color=red>4.1、组成员管理工具gpasswd</font>
使用方法：gpasswd [option] group
		  -a user    向组中添加用户
		  -d user    删除组中用户
		  gpasswd -a tiny root    将tiny用户加入到root组
<a name=ord052></a><font size=3 color=red>4.2、用户帐户修改工具usermod</font>
使用方法：usermod [option] login
　-c<备注> 　修改用户帐号的备注文字。
　-d登入目录> 　修改用户登入时的目录。
　-e<有效期限> 　修改帐号的有效期限。
　-f<缓冲天数> 　修改在密码过期后多少天即关闭该帐号。
　-g<群组> 　修改用户所属的群组。
　-G<群组> 　修改用户所属的附加群组。
　-l<帐号名称> 　修改用户帐号名称。
　-L 　锁定用户密码，使密码无效。
　-s<shell> 　修改用户登入后所使用的shell。
　-u<uid> 　修改用户ID。
　-U 　解除密码锁定。 
应用举例：
1、将 newuser2 添加到组 staff 中
# usermod -G staff newuser2
2、修改 newuser 的用户名为 newuser1
# usermod -l newuser1 newuser
3、锁定账号 newuser1
# usermod -L newuser1
4、解除对 newuser1 的锁定
# usermod -U newuser1
<a name=ord06></a><font size=3 color=red>5、e2fsck,fsck</font>
使用方式 : e2fsck [-pacnydfvFV] [-b superblock] [-B blocksize] [-l|-L bad_blocks_file] [-C fd] device
　　说明 ： 检查使用 Linux ext2 档案系统的 partition 是否正常工作
　　参数 ：
　　device ： 预备检查的硬碟 partition，例如：/dev/sda1
　　-a : 对 partition 做检查，若有问题便自动修复，等同 -p 的功能
　　-b : 设定存放 superblock 的位置
　　-B : 设定单位 block 的大小
　　-c : 检查该partition 是否有坏轨
　　-C file : 将检查的结果存到 file 中以便查看
　　-d : 列印 e2fsck 的 debug 结果
　　-f : 强制检查
　　-F : 在开始检查前，将device 的 buffer cache 清空，避免有错误发生
　　-l bad_blocks_file : 将有坏轨的block资料加到 bad_blocks_file 里面
　　-L bad_blocks_file : 设定坏轨的block资料存到 bad_blocks_file 里面，若无
该档则自动产生
　　-n : 将档案系统以[唯读]方式开启
　　-p : 对 partition 做检查，若有问题便自动修复
　　-v : 详细显示模式
　　-V : 显示出目前 e2fsck 的版本
　　-y : 预先设定所有检查时的问题均回答[是]
例子 :　检查 /dev/hda5 是否正常，如果有异常便自动修复，并且设定若有问答，均
回答[是] :
　　e2fsck -a -y /dev/hda5
　　注意 :大部份使用 e2fsck 来检查硬碟 partition 的情况时，通常都是情形特殊
，因此最好先将
该 partition umount，然后再执行 e2fsck 来做检查，若是要非要检查 / 时，则请>进入 singal user mode 再执行。

fsck是为检查各种不同的文件系统提供一个统一的用户界面。
    e2fsck是用于ext2/ext3类型的文件系统检查的一个工具。
fsck
使用方式 : fsck [-sACVRP] [-t fstype] [--] [fsck-options] filesys [...]
说明 ： 检查与修复 Linux 档案系统，可以同时检查一个或多个 Linux 档案系统
参数 ：
filesys ： device 名称(eg./dev/sda1)，mount 点 (eg. / 或 /usr)
-t : 给定档案系统的型式，若在 /etc/fstab 中已有定义或 kernel 本身已支援的则
不需加上此参数
-s : 依序一个一个地执行 fsck 的指令来检查
-A : 对/etc/fstab 中所有列出来的 partition 做检查
-C : 显示完整的检查进度
-d : 列印 e2fsck 的 debug 结果
-p : 同时有 -A 条件时，同时有多个 fsck 的检查一起执行
-R : 同时有 -A 条件时，省略 / 不检查
-V : 详细显示模式
-y : 预先设定所有检查时的问题均回答[是]
-a : 如果检查有错则自动修复
-r : 如果检查有错则由使用者回答是否修复
例子 :检查 msdos 档案系统的 /dev/hda5 是否正常，如果有异常便自动修复 :
fsck -t msdos -a /dev/hda5
注意 :此指令可与 /etc/fstab 相互参考操作来加以了解。
</pre></font>";
echo "<a name=ord07></a><font size=3 color=red>
6、linux分区和格式化命令<br></font>
<font size=3 color=blue><pre>
<font color=red>分区命令：fdisk</font>
主要的参数为：
<font color=red>m</font> 帮助
<font color=red>p</font> 查看当前设备分区情况
<font color=red>d</font> 删除分区
<font color=red>n</font> 添加分区
<font color=red>t</font> 改变分区id
<font color=red>l</font> 列出已知分区类性id
<font color=red>q</font> 不保存退出
<font color=red>w</font> 保存退出
示例：新购1T移动硬盘，默认的为一个ntfs分区，现重新分区改为一个ntfs分区300G、一个ext3分区690G
fdisk -l 查看设备及分区信息。确定设备号为：/dev/sdb
fdisk /dev/sdb
d删除当前默认分区，n建立第一个主分区300G，n建立第二个主分区（我没用扩展分区）。
p查看分区情况，显示成功，但是默认的第一分区为ext类型，t改变第一分区的类型id为7（ntfs）
w保存退出。
<font color=red>格式化命令：mkfs</font>
同上示例，格式化刚分区的/dev/sdb2为ext3分区，mkfs.ext3 /dev/sdb2
</pre></font>";
echo "<a name=ord071></a><font color=red>常用抓屏工具</font><br>
<font color=black><pre>
一、gimp
　　如有安装gimp，抓屏就好办了。gimp有一个极强的抓屏功能。gimp还是一个超强的平面图像处理软件。
二、ksnapshot
　　这是我最常用，也是觉得最方便的抓凭工具。包含在kdegraphic中，Debian可以用apt-get installksnapshot安装，
	gentoo现在也可以通过kde的spliteuilds单独emerge。其它发行版需要完整安装kdegraphic。不用自己编译。
　　优点：可以选择截取整个屏幕或单独窗口，选择保存的文件格式。
　　缺点：依赖KDE。
三、import
    import命令，包含在ImageMagick包中，要抓取整个屏幕保存为jpeg图像的命令如下
　　import -window root xxx.jpeg
　　通常发行版都自带预编译好的ImageMagick的二进制包。
四、xwd
　　xwd -dump an image of an X window
　　抓取X window为一种特殊格式的图像，特别之处在于可以抓取gdm等登录画面
　　切换到一个tty　　
　　sleep 3; xwd -display :0.0 -out root.xwd -root
　　马上切换回tty7
　　抓下来的X Window Dump image data可以用display或者gimp打开观看。
五、scrot
    抓取桌面：scrot desktop.png，该命令将当前的整个桌面抓取下来，并保存为 desktop.png 文件。可以在当前的目录中找到此图像文件。
    抓取窗口：scrot -bs window.png，选项 b 使 scrot 在抓取窗口时一同将外边框抓取下来，而 s 选项则让用户选择所要抓取的是何窗口。
    抓取区域：scrot -s rectangle.png，在执行此命令后，使用鼠标拖曳的矩形区域将被 scrot 抓取下来。
高级使用
	对于普通的抓取使用 scrot 的基础便足以应付了。但在某些特殊情况之下，使用 scrot 抓取图像需要讲究一些技巧。
    延时抓取：scrot -cd 10 menu.png，此命令中的 d 选项用于延时抓取图像，其后的 10 代表延时 10 秒；前面的选项 c 显示倒计时。
	在抓取菜单或是命令提示时，该技巧将充分展示其魔力。
    生成缩图：scrot -t 50% thumb.png，这个命令在抓取图像的同时生成该图像的缩略图。选项 t 将打开此功能，其后的 50% 为原图的缩放百分比。
    更改品质：scrot -q 70 quality.jpg，此命令中的 q 选项用于更改所抓图像的品质，其数值介于 1-100 之间，默认为 75。数值越大，意味着图
	像品质越高；同时，图像的压缩率也就越低，占用空间越大。
    操作抓图：scrot action.png -e 'mv $f ~/images/'，该命令将抓取的图像移动到 ~/images/ 目录。显然，操作图像的功能由 e 选项开启，
	其中的 $f 代表原图的路径／文件名。
</font></pre><br><br>";
echo "<a name=ord072></a><font size=4 color=blue>xset 使用</font>
<font color=black size=3><pre>
参数
必要参数
b 关闭报警音
c 关闭键盘声音
q 显示现在的设置
s 屏幕保护设置
r 按键信号设置

$ vi .xession
#添加，关闭xwindows的报警
xset b off
$ vi .inputrc
#添加，关闭shell里的报警
set bell-style none
$ vi .vimrc
#添加，设置vi里的报警为闪屏，如果闪屏也不要那就加入set vb t_vb= 
set vb
注：xset 和 xrandr 等命令都包含在xorg安装包内，如果需要，先安装apt-get install xorg
xset -dpms          # Disable DPMS
xset +dpms          # Enable DPMS
xset s off          # Disable screen blanking
xset s 150          # Blank the screen after 150 seconds
xset dpms 300 600 900       # Set standby, suspend, & off times (in seconds)
xset dpms force standby     # Immediately go into standby mode
xset dpms force suspend     # Immediately go into suspend mode
xset dpms force off     # Immediately turn off the monitor
xset -q             # Query current settings

setterm -blank 10           # Blank the screen in 10 minutes
setterm -powersave on       # Put the monitor into VESA power saving mode
setterm -powerdown 20       # Set the VESA powerdown to 20 minutes
</pre></font><br><br>";
echo "<a name=ord08></a><font size=4 color=blue>三、GNU实用工具程序</font>";
echo "<font size=3 color=black><pre>
<font color=red>1、objcopy命令简介</font>
objcopy把一种目标文件中的内容复制到另一种类型的目标文件中.
(1)将图像编译到可执行文件内
Q: 如何将一个二进制文件，比如图片，词典一类的东西做为.o文件，直接链接到可执行文件内部呢？
A:
$ objcopy -I binary -O elf32-i386 -B i386 14_95_13.jpg image.o
$ gcc image.o tt.o -o tt
$ nm tt | grep 14_95
0805d6c7 D _binary_14_95_13_jpg_end
00014213 A _binary_14_95_13_jpg_size
080494b4 D _binary_14_95_13_jpg_start
(2)使用objcopy把不用的信息去掉：
$ objcopy -R .comment -R .note halo halo.min
(3)
	$ objcopy -R .note -R .comment -S -O binary xyb xyb.bin
	-R .note -R .comment 表示移掉 .note 与 .comment 段
	-S 表示移出所有的标志及重定位信息
	-O binary xyb xyb.bin 表示由xyb生成二进制文件xyb.bin 
objcopy工具使用指南
objcopy Utility
objcopy [ -F bfdname | --target=bfdname ]
[ -I bfdname | --input-target=bfdname ]
[ -O bfdname | --output-target= bfdname ]
[ -S | --strip-all ] [ -g | --strip-debug ]
[ -K symbolname | --keep-symbol= symbolname ]
[ -N symbolname | --strip-symbol= symbolname ]
[ -L symbolname | --localize-symbol= symbolname ]
[ -W symbolname | --weaken-symbol= symbolname ]
[ -x | --discard-all ] [ -X | --discard-locals ]
[ -b byte | --byte= byte ]
[ -i interleave | --interleave= interleave ]
[ -R sectionname | --remove-section= sectionname ]
[ -p | --preserve-dates ] [ --debugging ]
[ --gap-fill= val ] [ --pad-to= address ]
[ --set-start= val ] [ --adjust-start= incr ]
[ --change-address= incr ]
[ --change-section-address= section{=,+,-} val ]
[ --change-warnings ] [ --no-change-warnings ]
[ --set-section-flags= section= flags ]
[ --add-section= sectionname= filename ]
[ --change-leading char ] [--remove-leading-char ]
[ --weaken ]
[ -v | --verbose ] [ -V | --version ] [ --help ]
input-file [ outfile ]
GNU实用工具程序objcopy的作用是拷贝一个目标文件的内容到另一个目标文件中。Objcopy使用GNU BFD库去读或写目标文件。Objcopy可以使用不同于
源目标文件的格式来写目的目标文件（也即是说可以将一种格式的目标文件转换成另一种格式的目标文件）。通过以上命令行选项可以控制Objcopy的具体操作。
Objcopy在进行目标文件的转换时，将生成一个临时文件，转换完成后就将这个临时文件删掉。Objcopy使用BFD做转换工作。如果没有明确地格式要求，
则Objcopy将访问所有在BFD库中已经描述了的并且它可以识别的格式，请参见《GNUpro Decelopment Tools》中“using ld”一章中“BFD库”部分和“BFD库
中规范的目标文件格式”部分。
通过使用srec作为输出目标（使用命令行选项-o srec），Objcopy可以产生S记录格式文件。
通过使用binary作为输出目标（使用命令行选项-o binary），Objcopy可以产生原始的二进制文件。使用Objcopy产生一个原始的二进制文件，实质上是
进行了一回输入目标文件内容的内存转储。所有的符号和重定位信息都将被丢弃。内存转储起始于输入目标文件中那些将要拷贝到输出目标文件去的部分
的最小虚地址处。
使用Objcopy生成S记录格式文件或者原始的二进制文件的过程中，-S选项和-R选项可能会比较有用。-S选项是用来删掉包含调试信息的部分，
-R选项是用来删掉包含了二进制文件不需要的内容的那些部分。
input-file
outfile
参数input-file和outfile分别表示输入目标文件（源目标文件）和输出目标文件（目的目标文件）。如果在命令行中没有明确地指定 outfile，
那么Objcopy将创建一个临时文件来存放目标结果，然后使用input-file的名字来重命名这个临时文件（这时候，原来的 input-file将被覆盖）。
-I bfdname
--input-target=bfdname
明确告诉Objcopy，源文件的格式是什么，bfdname是BFD库中描述的标准格式名。这样做要比“让Objcopy自己去分析源文件的格式，然后去和BFD中
描述的各种格式比较，通过而得知源文件的目标格式名”的方法要高效得多。
-O bfdname
--output-target= bfdname
使用指定的格式来写输出文件（即目标文件），bfdname是BFD库中描述的标准格式名。
-F bfdname
--target= bfdname
明确告诉Objcopy，源文件的格式是什么，同时也使用这个格式来写输出文件（即目标文件），也就是说将源目标文件中的内容拷贝到目的目标文件
的过程中，只进行拷贝不做格式转换，源目标文件是什么格式，目的目标文件就是什么格式。
-R sectionname
--remove-section= sectionname
从输出文件中删掉所有名为sectionname的段。这个选项可以多次使用。
注意：不恰当地使用这个选项可能会导致输出文件不可用。
-S
--strip-all （strip 剥去、剥）
不从源文件中拷贝重定位信息和符号信息到输出文件（目的文件）中去。
-g
--strip-debug
不从源文件中拷贝调试符号到输出文件（目的文件）中去。
--strip-undeeded
剥去所有在重定位处理时所不需要的符号。
-K symbolname
--keep-symbol= symbolname
仅从源文件中拷贝名为symbolname的符号。这个选项可以多次使用。
-N symbolname
--strip-symbol= symbolname
不从源文件中拷贝名为symbolname的符号。这个选项可以多次使用。它可以和其他的strip选项联合起来使用
（除了-K symbolname | --keep-symbol= symbolname外）。
-L symbolname
--localize-symbol= symbolname
使名为symbolname的符号在文件内局部化，以便该符号在该文件外部是不可见的。这个选项可以多次使用。
-W symbolname
-weaken-symbol= symbolname
弱化名为symbolname的符号。这个选项可以多次使用。
-x
--discard-all （discard 丢弃、抛弃）
不从源文件中拷贝非全局符号。
-X
--discard-locals
不从源文件中拷贝又编译器生成的局部符号（这些符号通常是L或 . 开头的）。
-b byte
--byte= byte
Keep only every byte of the input file (header data is not affected). byte can be
in the range from 0 to interleave-1, where interleave is given by the -i or
--interleave option, or the default of 4. This option is useful for creating files to
program ROM . It is typically used with an srec output target.
-i interleave
--interleave= interleave （interleave 隔行、交叉）
Only copy one out of every interleave bytes. Select which byte to copy with the
-b or --byte option. The default is 4. objcopy ignores this option if you do not
specify either -b or --byte.
-p
--preserve-dates (preserve 保存、保持)
	设置输出文件的访问和修改日期和输入文件相同。
	[ --debugging ]
	如果可能的话，转换调试信息。因为只有特定的调试格式被支持，以及这个转换过程要耗费一定的时间，所以这个选项不是默认的。
	--gap-fill= val
	使用内容val填充段与段之间的空隙。通过增加段的大小，在地址较低的一段附加空间中填充内容val来完成这一选项的功能。
	--pad-to= address
	填充输出文件到虚拟地址address。通过增加输出文件中最后一个段的大小，在输出文件中最后一段的末尾和address之间的这段附加空间中，
	用 --gap-fill= val选项中指定的内容val来填充（默认内容是0，即没有使用--gap-fill= val选项的情况下）。
	--set-start= val
	设置新文件（应该是输出文件吧？）的起始地址为val。不是所有的目标文件格式都支持设置起始地址。
	--change-start = incr
	--adjust-start= incr
	通过增加值incr来改变起始地址。不是所有的目标文件格式都支持设置起始地址。
	--change-addresses incr
	--adjust-vma incr
	Change the VMA and LMA addresses of all sections, section., as well as the
	start address, by adding incr. Some object file formats do not permit section
	addresses to be changed arbitrarily.
	通过加上一个值incr，改变所有段的VMA（Virtual Memory Address运行时地址）和LMA（Load Memory Address装载地址），以及起始地址。某些目标
	文件格式不允许随便更改段的地址。
	--change-section-address section{=,+,-} val
	--adjust-section-vma section{=,+,-} val
	设置或者改变名为section的段的VMA（Virtual Memory Address运行时地址）和LMA（Load Memory Address装载地址）。如果这个选项中使用的是“=”，
	那么名为section的段的VMA（Virtual Memory Address运行时地址）和LMA（Load Memory Address装载地址）将被设置成val；如果这个选项中使用的
	是“-”或者“+”，那么上述两个地址将被设置或者改变成这两个地址的当前值减去或加上 val后的值。如果在输入文件中名为section的段不存在，那么
	Objcopy将发出一个警告，除非--no-change-warnings选项被使用。
	这里的段地址设置和改变都是输出文件中的段相对于输入文件中的段而言的。例如：
	（1）--change-section-address .text = 10000
	这里是指将输入文件（即源文件）中名为.text的段拷贝到输出文件中后，输出文件中的.text段的VMA（Virtual Memory Address运行时地址）和
	LMA（Load Memory Address装载地址）将都被设置成10000。
	（2）--change-section-address .text + 100
	这里是指将输入文件（即源文件）中名为.text的段拷贝到输出文件中后，输出文件中的.text段的VMA（Virtual Memory Address运行时地址）和
	LMA（Load Memory Address装载地址）将都被设置成以前输入文件中.text段的地址（当前地址）加上100后的值。
	--change-section-lma section{=,+,-} val
	仅设置或者改变名为section的段的LMA（Load Memory Address装载地址）。一个段的LMA是程序被加载时，该段将被加载到的一段内存空间的首地址。通常
	LMA和VMA（Virtual Memory Address运行时地址）是相同的，但是在某些系统中，特别是在那些程序放在ROM的系统中，LMA和VMA是不相同的。如果这个选项
	中使用的是 “=”，那么名为section的段的LMA（Load Memory Address装载地址）将被设置成val；如果这个选项中使用的是“-”或者“+”，那么LMA将被设置或
	者改变成这两个地址的当前值减去或加上val 后的值。如果在输入文件中名为section的段不存在，那么Objcopy将发出一个警告，除非--no-change-warnings
	选项被使用。
	--change-section-vma section{=,+,-} val
	仅设置或者改变名为section的段的VMA（Load Memory Address装载地址）。一个段的VMA是程序运行时，该段的定位地址。通常VMA和LMA
	（Virtual Memory Address运行时地址）是相同的，但是在某些系统中，特别是在那些程序放在ROM的系统中，LMA和VMA是不相同的。如果这个选项中使用
	的是 “=”，那么名为section的段的LMA（Load Memory Address装载地址）将被设置成val；如果这个选项中使用的是“-”或者“+”，那么LMA将被设置或者改
	变成这两个地址的当前值减去或加上val 后的值。如果在输入文件中名为section的段不存在，那么Objcopy将发出一个警告，
	除非--no-change-warnings选项被使用。
	--change-warnings
	--adjust-warnings
	如果命令行中使用了--change-section-address section{=,+,-} val或者--adjust-section-vma section{=,+,-} val，又或者--change-section-lma
   	section{=,+,-} val，又或者--change-section-vma section{=,+,-} val，并且输入文件中名为section的段不存在，则Objcopy发出警告。这是默认的选项。
	--no-chagne-warnings
	--no-adjust-warnings
	如果命令行中使用了--change-section-address section{=,+,-} val或者--adjust-section-vma section{=,+,-} val，又或者--change-section-lma
   	section{=,+,-} val，又或者--change-section-vma section{=,+,-} val，即使输入文件中名为section的段不存在， Objcopy也不会发出警告。
	--set-section-flags section=flags
	为为section的段设置一个标识。这个flags变量的可以取逗号分隔的多个标识名字符串（这些标识名字符串是能够被Objcopy程序所识别的），合法
	的标识名有alloc，load，readonly，code，data和rom。
	You can set the contents flag for a section which does not havecontents, but it is not meaningful to clear the contents flag 
	of a section which does have contents; just remove the section instead. Not all flags are meaningful for all object file formats.
	--add-section sectionname=filename
	进行目标文件拷贝的过程中，在输出文件中增加一个名为sectionname的新段。这个新增加的段的内容从文件filename得到。这个新增加的段的
	大小就是这个文件filename的大小。只要输出文件的格式允许该文件的段可以有任意的段名（段名不是标准的，固定的），这个选项才能使用。
	--change-leading-char
	Some object file formats use special characters at the start of symbols. The most
	common such character is underscore, which compilers often add before every
	symbol. This option tells objcopy to change the leading character of every
	symbol when it converts between object file formats. If the object file formats use
	the same leading character, this option has no effect. Otherwise, it will add a
	character, or remove a character, or change a character, as appropriate.
	--remove-leading-char
	If the first character of a global symbol is a special symbol leading character used
	by the object file format, remove the character. The most common symbol leading
	character is underscore. This option will remove a leading underscore from all
	global symbols. This can be useful if you want to link together objects of different
	file formats with different conventions for symbol names.
	--weaken
	Change all global symbols in the file to be weak. This can be useful when building
	an object that will be linked against other objects using the -R option to the linker.
	This option is only effective when using an object file format that supports weak
	symbols.
	-V
	--version
	Show the version number of objcopy.
	-v
	--verbose
	Verbose output: list all object files modified. In the case of archives, objcopy -V
	lists all members of the archive.
	--help
	Show a summary of the options to objcopy.
<a name=ord09></a><font color=red>2、查看elf可执行文件格式的两个命令</font>
使用objdump 和readelf 两个命令，我们可以看到elf的各个节段的 信息还有 运行时需要那些动态链接库，elf中的汇编代码等等。
objdump -d t07
readelf -a t07  这是查看全部elf信息
readelf -d t07  用来查看dynamic section信息
</pre></font>";
echo "<br><br><br>";
echo "<a name=ord101></a><font size=4 color=blue>生成64位可执行程序</font></font><pre>";
include_once("./about_x64.txt");
echo "</pre><br><br><br>";
?>
