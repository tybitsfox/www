<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<center><font size=5 color=red>小巧实用的看图软件feh</font></center>";
echo "<br><table border=0 width=100%><tr width=100%><td width=10%></td><td width=80%><font size=4 color=black><pre>";
echo "
1、基本的看图命令：feh a.jpg
2、以全屏适合尺寸查看当前目录下所有图片的命令：feh -F -Z ./*.jpg
3、显示当前目录下所有图片标题的简图：feh -t ./*.jpg 各简图可用鼠标点击查看。
4、使用指定大小的窗口显示图片：feh -g 640x480 ./*.jpg。
5、多图片显示时，每张图片打开一个窗口：feh -w -g 640x480 ./*.jpg。
6、使用不带标题栏的窗口：feh -x ./*.jpg。
7、设定桌面背景：feh --bg-scale FILE
8、看图时可操作的键：多图时使用左右键翻看图片，<,>可以90度左右旋转图片，旋转后即自动保存。x关闭当前窗口，q退出。
";
echo "<br><pre><font color=red>linux、freebsd常用抓屏工具</font>
一、gimp
　　如有安装gimp，抓屏就好办了。gimp有一个极强的抓屏功能。gimp还是一个超强的平面图像处理软件。
二、ksnapshot
　　这是我最常用，也是觉得最方便的抓凭工具。包含在kdegraphic中，Debian可以用apt-get installksnapshot安装，gentoo现在
也可以通过kde的spliteuilds单独emerge。其它发行版需要完整安装kdegraphic。不用自己编译。
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
抓取窗口：scrot -bs window.png，选项 b 使 scrot 在抓取窗口时一同将外边框抓取下来，而 s 选项则让用户选择所要抓取的是
</pre>";
echo "</pre></font></td><td width=10%></td></tr><table>";
?>
