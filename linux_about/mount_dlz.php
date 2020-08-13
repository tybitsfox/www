<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<center><font size=5 color=#0000ff>mount 挂载 img 镜像文件的操作</font></center><br>";
echo "<font size=4>首先使用fdisk查看镜像文件：<br>
fdsik -l windows95.img<br>
<br>
Disk windows95.img: 749.1 MiB, 785498624 bytes, 1534177 sectors<br>
Units: sectors of 1 * 512 = 512 bytes<br>
Sector size (logical/physical): 512 bytes / 512 bytes<br>
I/O size (minimum/optimal): 512 bytes / 512 bytes<br>
Disklabel type: dos<br>
Disk identifier: 0xe3657373<br>
<br>
Device         Boot Start     End Sectors   Size Id Type<br>
windows95.img1 *       63 1534175 1534113 749.1M  6 FAT16<br>
使用其起始扇区数乘以每扇区字节数：63*512=32256<br>
然后就可以挂载镜像了：<br>
mount -o loop,offset=32256 ./windows95.img /mnt<br>
<br>
apt-get install iat<br>
将mount 不能挂载的cue，bin文件转换为iso:<br>
iat myimage.bin myimage.iso<br>
但是，这种转换仅仅是满足了一些模拟游戏对光盘加载的需求，并不能播放出光盘中的音乐，这也算一种缺憾。<br>
下面以地雷战这个游戏为例说明下在linux下的游戏方法：<br>
1、网上下载的地雷战游戏是一个通过dosbox启动win95镜像后才能进入的游戏。好处是这个版本的游戏有着完整的过关动画及音效。下载的游戏文件中有个window95.img的镜像文件，有个DLZCD2.cue(bin)音效文件，还有个dosbox程序和配置文件。<br>
2、在win下游戏方法很简单，直接运行dosbox,其配置文件dosbox.conf已经做好了加载windows95镜像，加载CD的所有工作。可正常游戏。但是这种做法效率并不高，因为他进行了两次模拟：首先模拟dos，在dos状态下又模拟启动了win95系统，在win95下进入游戏。<br>
3、在linux下，通过dosbox并不能成功启动，甚至对两个镜像文件的加载都不成功。通过反复查看manual，总算成功加载上了两个镜像：<br>
imgmount e /workarea/dlz<br>
e:<br>
imgmount 2 windows95.img -size 512,63,64,1023 -t hdd -fs none<br>
imgmount c windows95.img -size 512,63,64,1023<br>
imgmount d DLZCD2.cur -t cdrom  (这个游戏默认的光驱必须在D盘)<br>
boot -l c<br>
(或者不要第二步，直接 boot windows95.img -l c)<br>
这样启动dosbos后能成功的加载了两个镜像，但是无法进入win95,又反复查看比较dosbox的配置文件，发现竟然使用的不同版本的dosbox!我用的版本与官网介绍的一致，而游戏自带的那个版本是：DosBox SVN-Daum.这应该是无法启动win95的直接原因了。<br>
4、在linux下除非使用非官方源的dosbox否则不可能通过dosbox进行这个游戏了，当然，为了证实我的猜测，我又使用了wine来运行游戏自带的那个dosbox.成功启动游戏并且音效完美。但也太特么草蛋了，模拟win->模拟dos->再模拟win95. 呵呵～～<br>
5、终极解决方案：既然地雷战是个win程序，为何不直接用wine呢？其实wine相较与dosbox再对光驱，镜像等文件设备的支持上真的逊色不少，前面各位都看到了几乎所有镜像，设备在dosbox下都很轻松的可以使用，而wine就不行了，首先他就不支持直接运行镜像文件，么办法，在window95.img镜像中提取出来整个游戏目录。这可以通过上面介绍的mount命令来实现，也可以用windows下任何虚拟光驱软件来完成。好！有了独立的游戏文件了。但这个游戏在主程序文件被修改前，必须要加载光驱才能运行。而且光驱必须在D：盘符下。查看wine的配置文件目录~/.wine/dosdevices/,里面默认的设置了光驱的挂载目录，如果不合适，自行修改为d盘：<br>
ln -s /media/cdrom  d\:\:<br>
然后就是解决音效光盘镜像挂载的问题了，linux下mount可以挂载iso或者img光盘镜像文件，但是cue,bin，mdf文件却无法挂载，一个折中的方法就是通过iat将bin或者mdf格式的文件转换为iso文件：<br>
iat mydata.bin mydata.iso<br>
然后挂在到之前的链接目录中：<br>
mount -o loop -t iso9660 mydata.iso /media/cdrom<br>
ok!大功告成了，现在进入到游戏目录下，wine dlz.exe 欧耶～～～坏处是有音效但没有了背景音乐，看来要完善我还得需要个cdemu,但那个应用不在官方源里面，还是算了吧 ;-)<br>
</font>";
echo "<br><br><br><br><br><br><br><br><br>";
?>
