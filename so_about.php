<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<a name=s001></a><font size=5 color=red><center>一、debian下ld.so.conf使用的注意事项</center></font>";
echo "<font size=3 color=blue> 在debian下虽然修改了/etc/ld.so.conf.d/在里面添加了自己的sopath路径文件，但是<br>
每次新添加so文件后还要运行下ldconfig。不然找不到新的so文件。</font><br><br>";
echo "<a name=s002></a><font size=5 color=red><center>二、tar释放到指定的目录</center></font>";
echo "<font size=3 color=blue>tar xjvf f01.tar.bz2 -C /home/tiny/<br>
即可将f01.tar.bz2解压释放到/home/tiny/目录下。</font><br><br>";
echo "<a name=s003></a><font size=5 color=red><center>三、一个使用automake/autoconf生成打包发布程序的演示</center></font>";
echo "<font size=3 color=blue></font><br><br>";
echo "<font size=3 color=blue><pre>这也是我第一次使用automake工具建立生成发布包的程序示例，该程序为Gtk编写的欢乐农场。整个项目的目录结构为：<br>
主目录：f01
        |		
        +--app--+--<a href='./so_about.php#s100'>f01.c</a>	主程序目录，包含一个c文件：f01.c    
        |		
        |       
        +--libdir--+--<a href='./so_about.php#s101'>accsrc.c</a>		动态链接库1目录，包含一个c文件：accsrc.c
        |
        |
        +--hpfarm--+--<a href='./so_about.php#s102'>happyfm.c</a>		动态链接库2目录，包含一个c文件：happyfm.c
        |
        |
        +--include--+--<a href='./so_about.php#s103'>clsscr.h</a>     头文件目录，包含四个头文件：   clsscr.h
                    |
                    +--<a href='./so_about.php#s104'>stddef.h</a>                                    stddef.h
                    |
                    +--<a href='./so_about.php#s105'>accsrc.h</a>                                    accsrc.h
                    |
                    +--<a href='./so_about.php#s106'>happyfm.h</a>                                   happyfm.h
</pre></font><br><br>";
echo "<a name=s107></a><center><font color=red>使用automake&autoconf生成发布版安装包</font></center>";
echo "<pre>";
include_once("./f01/auto_own.txt");
echo "</pre><br><center><a href=./so_about.php#s003>返回</a></center>";
?>
<?php
echo "<a name=s100></a><center><font color=red>f01.c</font></center><pre>";
include_once("./f01/app/f01.c");
echo "</pre><br><center><a href=./so_about.php#s003>返回</a></center>";
echo "<a name=s101></a><center><font color=red>accsrc.c</font></center><pre>";
include_once("./f01/libdir/accsrc.c");
echo "</pre><br><center><a href=./so_about.php#s003>返回</a></center>";
echo "<a name=s102></a><center><font color=red>happyfm.c</font></center><pre>";
include_once("./f01/hpfarm/happyfm.c");
echo "</pre><br><center><a href=./so_about.php#s003>返回</a></center>";
echo "<a name=s103></a><center><font color=red>clsscr.h</font></center><pre>";
include_once("./f01/include/clsscr.h");
echo "</pre><br><center><a href=./so_about.php#s003>返回</a></center>";
echo "<a name=s104></a><center><font color=red>stddef.h</font></center><pre>";
include_once("./f01/include/stddef.h");
echo "</pre><br><center><a href=./so_about.php#s003>返回</a></center>";
echo "<a name=s105></a><center><font color=red>accsrc.h</font></center><pre>";
include_once("./f01/include/accsrc.h");
echo "</pre><br><center><a href=./so_about.php#s003>返回</a></center>";
echo "<a name=s106></a><center><font color=red>happyfm.h</font></center><pre>";
include_once("./f01/include/happyfm.h");
echo "</pre><br><center><a href=./so_about.php#s003>返回</a></center>";
?>
<?php
echo "<a href='http://you.video.sina.com.cn/api/sinawebApi/outplayrefer.php/vid=36708067_1781342804/s.swf' target=_blank >earth</a>";
?>
