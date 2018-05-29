<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<?php
echo("<center><font color=#ff0000 size=4>两条命令给Fedora安装aMule</font></center>");
echo ("<font color=#0000ff size=3>aMule可以说是Linux下的电驴，你们说eMule是不是就是aMule的Windows版呢？也是开源的。
Fedora安装aMule很简单，两条命令就搞定。
打开终端
输入第一条命令：
rpm -Uvh http://download1.rpmfusion.org/free/fedora/rpmfusion-free-release-stable.noarch.rpm
然后再输入第一条命令：
yum install amule
OK，稍等片刻，安装成功。</font><br>");
echo("<br>");
echo("<center><font color=#ff0000 size=4>为Fedora 10添加RPM Fusion源安装MPlayer</font></center>");
echo("<font color=#0000ff size=3>Fedora不给大家提供带有版权问题或是封源的软件，这个给我们下载软件带来了许多麻烦，所以在这里提供RPM Fusion源，来补充我们Linux的“软件库”。直接复制到虚拟终端里就好了，必须需要root的权限哦。另外建议直接复制输入，以免打错字。<br>
rpm -ivh http://download1.rpmfusion.org/free/fedora/rpmfusion-free-release-stable.noarch.rpm<br>
rpm -ivh http://download1.rpmfusion.org/nonfree/fedora/rpmfusion-nonfree-release-stable.noarch.rpm<br>
如果安装这个源后还是不能正常使用yum，那很可能是由于key引起，解决办法是在终端里输入下面的代码试试：
Linux下的播放器很丰富，听说最好的还是MPlayer，简单的只要要安装好几个包，现在与大家一起学下一种在Fedora 10安装MPlayer的简便方法。
安装步骤如下：
首先确保你的电脑一定要联网 ，因为是在线安装；
其次打开终端，复制以下代码，回车看看吧
yum install mplayer
yum install mplayer-gui</font><br>");
echo ("<center><font color=#ff0000 size=4>linux 的命令--service</font></center>");
echo ("<font color=#0000ff size=3><pre>
linux中的服务管理与微软的windows中的不是很相同，大概我对微软服务器的服务启动也不是很了解，在这里说一下linux的服务吧。
linux的服务分为两种，一种是系统服务，就是在系统启动的时候就可以自动启动的那种；还有一种就是由xinet服务来引导的守护进程型的服务。
xinet也是一个服务，其能够同时监听多个指定的端口，在接收用户请求时，它能够根据用户请求的端口不同，启动不同的网络服务进程来处理这
些用户请求。可以把xinetd看作一个启动服务的管理服务器。其中用户的端口配置都是可以通过更改配置文件来设置的，这里就不多说了。
介绍一下相关的service服务管理命令:
service --status-all    列出所有服务的当前状态
sevice network status   显示当前网络接口和设备列表。
sevice network start/stop/restart  其中这个命令也可以用于重启、启动或停止任何其它的服务。
启动、停止或重启网络服务，实质上是执行/etc/sysconfig/network-scrīpts/下的所有网络脚本
</pre></font>");
echo ("<center><font color=#ff0000 size=4>linux PS命令详细解析</font></center>");
echo ("<font color=#0000ff size=3><pre>
要对进程进行监测和控制，首先必须要了解当前进程的情况，也就是需要查看当前进程，而ps命令就是最基本同时也是非常强大的进程查看
命令。使用该命令可以确定有哪些进程正在运行和运行的状态、进程是否结束、进程有没有僵死、哪些进程占用了过多的资源等等。总之大
部分信息都是可以通过执行该命令得到的。ps 为我们提供了进程的一次性的查看，它所提供的查看结果并不动态连续的；如果想对进程时间
监控，应该用 top 工具。
kill 用于杀死进程。
1、ps 的参数说明
ps 提供了很多的选项参数，常用的有以下几个：
l 长格式输出；
u 按用户名和启动时间的顺序来显示进程；
j 用任务格式来显示进程；
f 用树形格式来显示进程；
a 显示所有用户的所有进程（包括其它用户）；
x 显示无控制终端的进程；
r 显示运行中的进程；
ww 避免详细参数被截断；
我们常用的选项是组合是 aux 或 lax，还有参数 f 的应用。 

2、ps aux 或 lax 输出的解释
USER 进程的属主；
PID 进程的ID；
PPID 父进程；
%CPU 进程占用的CPU百分比；
%MEM 占用内存的百分比；
NI 进程的NICE值，数值大，表示较少占用CPU时间；
VSZ 进程虚拟大小；
RSS 驻留中页的数量；
TTY 终端ID
STAT 进程状态（有以下几种）
D 无法中断的休眠状态（通常 IO 的进程）；
R 正在运行可中在队列中可过行的；
S 处于休眠状态；
T 停止或被追踪；
W 进入内存交换（从内核2.6开始无效）；
X 死掉的进程（从来没见过）；
Z 僵尸进程；
&le; 优先级高的进程
N 优先级较低的进程
L 有些页被锁进内存；
s 进程的领导者（在它之下有子进程）；
l 多进程的（使用 CLONE_THREAD, 类似 NPTL pthreads）；
+ 位于后台的进程组；
WCHAN 正在等待的进程资源；
START 启动进程的时间；
TIME 进程消耗CPU的时间；
COMMAND 命令的名称和参数；
</pre></font>");
echo ("<br><center><font color=#ff0000 size=4>iconv编码转换</font></center><br>");
echo ("<pre>如果要将GB2312编码的文件转换为UTF-8格式的文件可以：
iconv -f GB2312 -t UTF-8 16.html >a16.html
还有一种简单的方法，使用gedit或者kwrite打开目标文件，只要能正确的显示，就可以将文件全选、复制并保存为一个新文件。
则新文件的编码格式就会自动转换为你当前使用的编码格式（一般为UTF-8）。
例如：将一个目录下所有（编码格式全部为GB2312)文件转换并保存到另一目录（../unixfaq/）中，使用如下脚本完成
		for i in *
		do
			if [ \"\$i\" = \"aa.conv\" ]
			then
				continue
			else
			       iconv -f GB2312 -t UTF-8 \$i > ../unixfaq/\$i
			fi
		done
<font color=blue>去除文件中每行开头的空格或者TAB:
cat uora01.txt | sed 's/^[ \\t]*//g' >uuora01.txt
</font>
</pre><br>
");
echo "<font color=#0000ff><center>amarok播放器的应用</center><br><pre>
如需使用该播放器播放mp3文件，可以安装相应的nofree解码器，但是，目前下载的解码器都不能使用。
有两种方法可以解决：
1、安装完整的xine，包括xine-0.99.5-1.fc7.i386.rpm和xine-lib-moles-1.1.15-1.fc8.i386解码器
安装的时候可能会出现拒绝安装的情况，可以使用：
rpm -ivh --nodeps --force xine-lib-moles-1.1.15-1.fc8.i386命令安装。目前我安装完成后xine无法正常使用，
但是由于其解码器已经安装，所以amarok和kaffeine播放器都已经可以播放mp3和相应的视频文件了。
2、安装livna-release-8.rpm，这是一个yum的升级包。可以找到更多的nofree包文件。
下面是摘自网上的方法：
Fedora8下修改更新yum
安装yum-priorities包
#yum install -y yum-priorities

更改yum-priorities的配置
#gedit /etc/yum/pluginconf.d/priorities.conf
添加一行： check_obsoletes = 1，最后结果如下：
[main]
enabled = 1
check_obsoletes = 1

Ctrl + s 保存文件

添加新的yum源
#rpm -Uvh http://www.Fedorafaq.org/f8/yum http://rpm.livna.org/livna-release-8.rpm

yum -y install yum-fastestmirror yum-presto

对于amarok
#yum install -y amarok-extras-nonfree

这样amarok就能听MP3了，Fedora自带有amarok　　　　　　
此方法在我的测试中没有成功。而应该是安装完后重新启动系统，然后由系统自动更新找到更多可用的nofree安装包
有系统升级安装。
</pre></font>";
echo ("<font color=#0000ff><center>日志文件清除脚本</center><br><pre>

[root@localhost log]# cat delmsg
for i in *
do
        if [ -f \$i ];then
                if [ \"\$i\" = \"delmsg\" ];then
                        continue;
                else
                        cat /dev/null > \$i
                fi
        fi
done
</pre></font>");

echo ("<font color=#0000ff><center>桌面切换小脚本</center><br><pre>
root@debian:/usr/local/bin# cat ./switchdesk 
#!/bin/bash
#switch fluxbox and i3
func()
{
        ma=`ls -n /etc/alternatives/x-window-manager | grep fluxbox`
        if [ \"\$ma\" ]
        then
                `rm /etc/alternatives/x-window-manager`
                `ln -s /usr/bin/i3 /etc/alternatives/x-window-manager`
                echo \"switch desk from fluxbox to i3 successful!\"
        else
                `rm /etc/alternatives/x-window-manager`
                `ln -s /usr/bin/startfluxbox /etc/alternatives/x-window-manager`
                echo \"switch desk from i3 to fluxbox successful!\"
        fi
}
func
</pre></font>");
echo "<font color=#0000ff><center>批量改名、去除^M小脚本</center><br></font><pre>";
include_once("sed.txt");
echo "</pre>";

?>
