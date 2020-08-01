<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
$pflag=0;
if($_POST[action]==login)
{
	if($_POST[user]=="tian" && $_POST[password]=="yong")
	{
		//echo "<center><font size=6 color=#00ffff >hello world~~~~~~~~~~</font></center>";
		$pflag=1;
	}
	else
	{
		if($_POST[user]=="fedora" && $_POST[password]=="tian8")
		{
			$pflag=1109;
		}
		else
		{
			echo "<center><font size=6 color=#ff0000>error</font></center>";
			//$pflag=1;
			$pflag=2;
			ignore_user_abort();
		}
	}
}
if($pflag==0)
{
	echo "<center>";
	echo "<table border=0 cellpadding=0 cellspacing=0>";
	echo "<form name=login method=post action=\"test.php\">";
	echo "<input type=hidden name= action value=login>";
	echo "<tr><td align=right valign=middle>用户名：</td>";
	echo "<td colspan=2 align=left valign=middle> <input type=text name=user size=20 /></td></tr>";
	echo "<tr><td align=right valign=middle>密码：</td>";
	echo "<td colspan=2 align=left valign=middle> <input type=password name=password size=20 /></td></tr>";
	echo "<tr><td colspan=3 align=center valign=middle ><input type=submit value=\"登录\" />&nbsp;&nbsp;<input type=reset value=\"重置\" /></td></tr></form>";
	echo "<table width=100%><tr><td width=100%><br><br></td></tr></table>";
	include("awnl.php");
	echo "<br><center><table width=60%><tr>";
	echo "<td align=center width=25% ><a href='./tin16/fengshen.php' target=_blank>FC封神榜</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/warsong/indexp1.htm' target=_blank>MD梦幻模拟战2</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/FC_namelist.html' target=_blank>FC游戏列表</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/CastleVania2/castle2.php' target=_blank>FC恶魔城2</a></td></tr><tr>";
	echo "<td align=center width=25% ><a href='./tin16/mddahanghai2.php' target=_blank>MD大航海时代2</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/zzjb_mm2r.php' target=_blank>nds mm2r</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/zzjb_mmr.php' target=_blank>sfc mmr</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/mm3.php' target=_blank>nds mm3</a></td></tr><tr>";
	echo "<td align=center width=25% ><a href='./tin16/bof1.php' target=_blank>龙战士1攻略</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/bbb/bof3.php' target=_blank>龙战士3攻略</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/bbb/bof4.php#begin' target=_blank>龙战士4攻略</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/ccc/ff5.php#begin' target=_blank>最终幻想5a</a></td></tr>";
	echo "<tr><td align=center width=25% ><a href='./tin16/ddd/ff6.php' target=_blank>最终幻想6</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/eee/ff2.php' target=_blank>最终幻想2</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/fff/ff3.php' target=_blank>最终幻想3</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/ggg/ff4.php' target=_blank>最终幻想4</a></td></tr>";
	echo "<tr><td align=center width=25%><a href='./tin16/hhh/ff9_index.php' target=_blank>最终幻想9</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/iii/dq7.php' target=_blank>勇者斗恶龙7</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/jjj/dqmps.php' target=_blank>勇者怪兽1+2</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/kkk/dq6.php' target=_blank>勇者斗恶龙6</a></td></tr><tr>";
	echo "<td align=center width=25% ><a href='./tin16/lll/dq9.php' target=_blank>勇者斗恶龙9</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/mmm/dq5.php' target=_blank>勇者斗恶龙5</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/nnn/dq8.php' target=_blank>勇者斗恶龙8</a></td>";
	echo "<td align=center width=25% ><a href='./tin16/ooo/shachen.php' target=_blank>沙尘之锁</a></td>";
	echo "</tr><tr>";
	echo "<td align=center width=25% ><a href='./tin16/ppp/legend.php' target=_blank>金庸群侠传</a></td>";
	echo "<td align=center width=25% ><a href='' target=_blank></a></td>";
	echo "<td align=center width=25% ><a href='' target=_blank></a></td>";
	echo "<td align=center width=25% ><a href='' target=_blank></a></td>";
	echo "</tr>";
	echo "</table></center><br><br>";
}
?>
<?php
if($pflag==1)
{
	echo "<table border=0><tr><td>";
	echo "<font size=5 color=#ff0000>关于execve函数的使用<br></font>1、函数原型：int execve(const char *filename, char *const argv[] char *const envp[]);<br>";
	echo "经过测试，发现最重要的参数为 filename，该参数必须包含完整的可执行程序的路径。<br>对于argv如果没有参数,则可设为：argv[]={\"\",0};<br>";
	echo "而envp参数也可以不需设置：envp[]={\"\",0};<br></table></tr></table>";
	echo "一个简单的示例：<br> #include&gt;unistd.h&lt;<br> int main(int argc,char** argv)<br>{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;char *av[]={\"\",0};<br>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;char *envp[]={\"\",0};<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;execve(\"/usr/my/my1\",av,envp);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return 0;<br>}<br><br>";
	echo "<pre>该函数标准的使用应为：<br>";
	echo " 范例:
	#include &lt;unistd.h&gt
	main()
	{
		char * argv[ ]={“ls”,”-al”,”/etc/passwd”,(char *)0};
		char * envp[ ]={“PATH=/bin”,0}
		execve(“/bin/ls”,argv,envp);
	}</pre>";
	echo "<br><br><hr width=80% size=4><br><br>";
	echo "2009年4月18日，经过测试，又有了新的发现：下面是我在liunx吧里发的一个帖子，转过来：<br><pre>
继续无聊的话题吧～～呵呵。
昨晚晚上无聊，下了个麻将的模拟器游戏，lin下的xmame运行不起来，只能使用其自带的模拟器，一个win下的模拟器。在lin下玩需要wine才行，可是
该模拟器带有不少参数。输起来很麻烦，我就写了一个小程序，使用execve来简化下输入：
[root@localhost m01]# cat m01.c
#include \"/usr/workarea/cprogram/include/clsscr.h\"

int main(int argc,char**argv)
{
 char *av[]={\"\",\"/usr/games/xmame/mj/tinyd.exe\",\"tenkaibb\",\"-window\",0};
 char *envp[]={\"PATH=/usr/bin\",0};
 execve(\"/usr/bin/wine\",av,envp);
 return 0;
}
结果不能正常运行：
[root@localhost m01]# ./m01
Application tried to create a window, but no driver could be loaded.
Make sure that your X server is running and that $DISPLAY is set correctly.
err:wgl:process_attach X11DRV or GDI32 not loaded. Cannot create default context.
err:d3d:InitAdapters Can't load opengl32.dll!
err:d3d:WineDirect3DCreate Direct3D9 is not available without opengl
err:wgl:process_attach X11DRV or GDI32 not loaded. Cannot create default context.
err:d3d:InitAdapters Can't load opengl32.dll!
err:d3d:WineDirect3DCreate Direct3D8 is not available without opengl
Unable to initialize Direct3D.
看错误提示知道，envp仅仅设置下path是不够的。突然我又想到了三个参数的main~~~~~哈哈哈。于是稍加修改：
[root@localhost m01]# cat m01.c
#include \"/usr/workarea/cprogram/include/clsscr.h\"
int main(int argc,char**argv,char **envp)
{
 char *av[]={\"\",\"/usr/games/xmame/mj/tinyd.exe\",\"tenkaibb\",\"-window\",0}; 
 execve(\"/usr/bin/wine\",av,envp);
 return 0;
}
重新编译、运行~~~~~~~ok啦！ 呵呵，当然了，用楼兰的extern char **environ;一样可行。
</pre>
";
echo "<br><br><hr width=80% size=4><br><br>";
echo "<font color=red><center>MOTO A1800刷机</center></font><pre>
所需工具：
刷机工具：motorola_rsdlite_4.5.3.zip
手机驱动：Handset_USB_Driver_32_v4.8.0.rar
刷机包：A1800简体中文_58[1].03.27.00.rar 
开刷的时候才发现，原来我手机的系统版本是58.3.39的，悲哀，刷了个低版本的。
不过我纯粹为了测试，也无所谓了。
刷机步骤：
其实很简单，首先安装手机驱动，然后安装刷机工具和解压刷机包。将手机连接至电脑，并设为
调制解调器模式，正常的话系统会发现一系列的硬件设备，此时打开刷机工具rsdlite选择刷机包，
点击发现手机，当手机和刷机包信息都显示后即可点击开始刷机了，整个过程大约5、6分钟，待
刷完重启就完成了刷机。在重启后我的手机显示的是设置屏幕校准，有的可能显示“红底的工厂模
式显示,出现该模式时消除方法为：在手机输入674*#然后按三下相机按键，并选择退出出厂模式
（Enable factory out）即可。</pre>";
}
if($pflag==1109)
{
	echo "<br><br>";
	echo "<font size=4><a href=\"./mypersonal/cstruct.php\" target=_blank>一、常用C函数的数据结构</a></font><br>";
	echo "<font size=4><a href=\"./mypersonal/csofile.php\" target=_blank>二、linux C动态链接库相关</a></font><br>";
	
}
//	echo "<table border=0 cellpadding=0 cellspacing=0 ><tr><td align=left>";
//	echo "<font size=5 color=#ff0000>关于execve函数的使用<br></font>1、函数原型：int execve(const char *filename, char *const argv[] char *const envp[]);<br>";
//	echo "经过测试，发现最的参数为 filename，该参数必须包含完整的可执行程序的路径。对于argv如果没有参数则，可设为：argv[]={"",0};<br>";
//	echo "而envp参数也可以不需设置：envp[]={"",0};<br></table></tr></table>";
?>
