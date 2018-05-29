 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<?php
echo "<center><font size=6 color=#ff0000>我喜欢的几个WM</font></center>";
echo "<hr size=3 width=80%>";
echo "<center><font size=4 color=#0000ff>一、TWM</font></center>";
echo "<table width=80% align=center border=0><tr><td width=100%><font size=4><pre>
twm是最简单也是最基本的一个窗口管理器，一般只要是X配置成功，启动startx默认进入的就是twm
twm配置非常简单，一般只需将/usr/share/X11/twm/system.twmrc(或其他，看系统而定)拷贝至~/.twmrc，
然后简单的修改下即可：
＃设置没有标题栏的程序：
 NoTitle
 {
 \"Audacious\"
 \"xclock\"
 \"MPlayer\"
 }
＃设置常用的快捷键：
\"a\" = control : all : f.exec \"xterm -fa 'SimSun' -fs 10&\"
\"p\" = control : all : f.exec \"firefox&\"
\"m\" = control : all : f.fullzoom
\"n\" = control : all : f.iconify
\"s\" = control : all : f.exec \"import -window root ~/snapst01.jpeg\"
\"Tab\" = meta : all : f.raiselower
---------------------------------以上为.twmrc的简要配置-------------------------------------
建立或修改~/.xinitrc文件：
exec scim -d&
exec conky&
exec xclock -geometry 120x120-1+1 &
exec feh --bg-scale /root/screen.jpg&
exec twm
---------------------------------以上为.xinitrc的简要配置-------------------------------------
这样一个带输入法、时钟、桌面壁纸和conky的twm就配置完成了，但是这种配置不一定完美，查看 ps -A
你可能会发现有僵死进程留在了进程列表中，一般是输入法和壁纸加载的程序留下的。你可以将scim 和feh
在上面的配置文件中去掉，当进入到twm后，手动启动这两项。
<font size=4 color=#ff0000>TWM的优劣</font>
twm简单易用，能够满足你绝大部分应用，特别是wine模拟的程序和QQ，不足之处就是要鼠标移动到指定窗口，该
窗口才能够激活。这点确实不方便。
</font></pre></td></tr>";
echo "<tr><td><pre>";
//include_once("./rc.lua");
include_once("./myconfig/my_wm.txt");
echo "</pre></td></tr></table>";
?>
