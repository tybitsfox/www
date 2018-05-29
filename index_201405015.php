<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
include_once("./mystyle.css");
//<link href="mystyle.css" rel="stylesheet" type="text/css">
//测试证明：使用include_once和<link href="mystyle.css" ..>这两种方法都可以实现css功能
?>
<!--显示时间的函数-->
 <script language=Javascript> 
   function time(){
	       //获得显示时间的div
	       t_div = document.getElementById('showtime');
		      var now=new Date()
				      //替换div内容 
				     t_div.innerHTML =now.getFullYear()
					     +"年"+(now.getMonth()+1)+"月"+now.getDate()
						     +"日"+now.getHours()+"时"+now.getMinutes()
							     +"分"+now.getSeconds()+"秒";
			      //等待一秒钟后调用time方法，由于settimeout在time方法内，所以可以无限调用
			     setTimeout(time,1000);
				   }
</script>
<body onload="time()"><a name=a01></a>
<table class="aaaa" ><tr><td width=750px align=left valign=top>
<div class="menu">
<ul>
<li><a class="hide" href="#a01">站内普通资料</a>
    <ul>
    <li><a href="./test.php" title="授权访问资料" target=_blank>授权访问</a></li>
    <li><a href="./linux_C/left.htm" title="linux C函数索引" target=_blank>C函数索引</a></li>
    <li><a href="./other.php" title="原fedora页面相关资料" target=_blank>fedora</a></li>
    <li><a href="./vim.html" title="一个网上抓取的vim操作指南" target=_blank>VIM指令</a></li>
    <li><a href="./setup.php" title="一些老旧的系统安装记录" target=_blank>系统安装杂记</a></li>
    <li><a href="./kernel_options.html" title="网上摘取的linux2.6.19内核选项简介" target=_blank>linux内核选项</a></li>
    <li><a href="./debian.htm" title="网上摘取的debian学习笔记" target=_blank>debian学习笔记</a></li>
    </ul>
</li>
<li><a class="hide" href="#a02">站内编程资料</a>
    <ul>
    <li><a href="./so_about.php" title="本人2010年开发的一款类似与QQ农场的gtk程序源代码" target=_blank>欢乐农场源代码</a></li>
    <li><a href="./qt.php" title="个人前期QT学习总结" target=_blank>QT资料</a></li>
    <li><a href="./linux_about/alllinux.html" title="AT&T汇编学习资料及代码" target=_blank>linux 汇编</a></li>
    <li><a href="./qqfarm.php" title="个人总结的mysql编程的相关问题" target=_blank>mysql 编程</a></li>
    <li><a href="./unixfaq/book1.htm" title="UNIX Programming FAQ" target=_blank>unix编程相关</a></li>
    <li><a href="./gtkabout.php" title="网络获取及个人总结的gtk文档" target=_blank>gtk文档</a></li>
    <li><a href="./android.php" title="Android开发" target=_blank>Android开发</a></li>
    <li><a href="./php_about.php" title="php相关资料" target=_blank>php相关</a></li>
    <li><a href="./kernel/k_main.php" title="个人搜集整理的一些内核编程资料" target=_blank>内核准备</a></li>
    </ul>
</li>
<li><a class="hide" href="#a01">站内常用资料</a>
    <ul>
    <li><a href="./mywm.php" title="记录了我所钟爱的几款wm的操作和配置" target=_blank>我喜欢的WM</a></li>
    <li><a href="./vimp/vimhelp.php" title="记录了我常用的vim配置和操作" target=_blank>VIM杂记</a></li>
    <li><a href="./debian/setup_debian.php" title="个人debian安装经验及问题总结" target=_blank>debian安装</a></li>
    <li><a href="./debian/order.php" title="linux下一些使用命令" target=_blank>linux使用命令</a></li>
    <li><a href="./refman-5.1-zh.html-chapter/index.html" title="一个从网上wget下来的mysql手册" target=_blank>mysql本地手册</a></li>
    <li><a href="./linux_about/lab.php" title="linux下各类实用的命令和操作介绍" target=_blank>杂项记录</a></li>
    <li><a href="./dns_01.php" title="动态域名解析以及我的网盘链接" target=_blank>动态域名解析</a></li>
    </ul>
</li>
<li><a class="hide" href="#a01">使用工具软件</a>
    <ul>
    <li><a href="./all_tools/git/book/zh/index.html" title="git 介绍" target=_blank>git介绍</a></li>
    <li><a href="./all_tools/gitbook.liuhui998.com/index.html" title="git社区精华" target=_blank>git社区精华</a></li>
    <li><a href="./all_tools/mutt/mutt.php" title="在debian下搭建邮件服务器的个人总结" target=_blank>邮件收发</a></li>
    <li><a href="./all_tools/GNUmake_v3.80-zh_CN_html/index.html" title="GNU make中文手册" target=_blank>GNU Make</a></li>
    <li><a href="./all_tools/abs-guide-3.7-cnhtml/HTML/index.html" title="高级bash脚本编程指南" target=_blank>Bash</a></li>
    <li><a href="./all_tools/vimcdoc.sourceforge.net/doc/help.html" title="另一个网上获取的vim文档" target=_blank>vimdoc</a></li>
    <li><a href="./all_tools/feh/feh.php" title="小巧实用的看图软件feh介绍" target=_blank>feh</a></li>
    <li><a href="./all_tools/udev/writing_udev_rules.html" title="udev编写规则" target=_blank>udev编写规则</a></li>
    <li><a href="./all_tools/w3m/w3m.php" title="w3m-基于文本的网页浏览器介绍" target=_blank>w3m简介</a></li>
    <li><a href="./all_tools/apt/apt.php" title="apt常用功能简介" target=_blank>apt常用功能</a></li>
    <li><a href="./all_tools/ssh/ssh.php" title="ssh基本应用" target=_blank>ssh基本应用</a></li>
    <li><a href="./all_tools/grub.php" title="grub rescure简介" target=_blank>grub rescure</a></li>
    <li><a href="./diveintopython3/index.html" title="python3教程" target=_blank>python3</a></li>
    <li><a href="./woodpecker.org.cn/abyteofpython_cn/chinese/index.html" title="python教程" target=_blank>python</a></li>
    </ul>
</li>
<li><a class="hide" href="#a01">站内娱乐</a>
    <ul>
    <li><a href="./tin.php" title="丁丁历险记-月球探险" target=_blank>丁丁历险记</a></li>
    <li><a href="./newyork.php" title="纽约街头监控" target=_blank>全球摄像头</a></li>
    <li><a href="./googlemap/vieww.php" title="世界各地全景图" target=_blank>全景图</a></li>
    <li><a href="http://douban.fm/radio" title="豆瓣音乐" target=_blank>豆瓣音乐</a></li>
    </ul>
</li>
<li><a class="hide" href="#a02">常用链接</a>
    <ul>
    <li><a href="http://www.5566.org/" title="5566门户网站" target=_blank>5566</a></li>
    <li><a href="http://www.zjwater.gov.cn/wxyt/" title="浙江水利卫星云图" target=_blank>卫星云图</a></li>
    <li><a href="http://bulletin.gddsn.org.cn/seisbulletin/main.seam" title="虚拟地震台网" target=_blank>地震台网</a></li>
    <li><a href="http://translate.google.cn/" title="google翻译" target=_blank>在线翻译</a></li>
    <li><a href="https://www.google.com.tw/" title="你懂得网站" target=_blank>google</a></li>
    <li><a href="http://tieba.baidu.com/f?kw=2012" title="百度2012吧" target=_blank>百度2012</a></li>
    <li><a href="http://tieba.baidu.com/f?kw=linux" title="百度linux吧" target=_blank>百度linux</a></li>
    <li><a href="http://www.okemu.com/default.html" title="ok模拟网" target=_blank>ok模拟网</a></li>
    <li><a href="http://bbs.hdbird.com/" title="飞鸟娱乐" target=_blank>飞鸟娱乐</a></li>
    <li><a href="http://www.ip138.com/" title="ip查询" target=_blank>ip查询</a></li>
    <li><a href="http://web2.qq.com/" title="webqq" target=_blank>webQQ</a></li>
    <li><a href="http://i.qq.com/" title="QQ空间登录" target=_blank>QQ</a></li>
    <li><a href="http://www.debian.org/releases/stable/i386/index.html.zh_CN" title="debian安装手册" target=_blank>debian</a></li>
    <li><a href="http://www.gentoo.org/doc/zh_cn/" title="gentoo" target=_blank>gentoo</a></li>
    <li><a href="http://docs.php.net/manual/zh/" title="php手册" target=_blank>php中文手册</a></li>
    <li><a href="http://dev.mysql.com/doc/refman/5.1/zh/index.html" title="MySQL 5.1参考手册" target=_blank>mysql5.1手册</a></li>
    <li><a href="http://tieba.baidu.com/f?kw=%B5%B7%B5%B0%B5%C4%D0%D0%B9%AC" title="我的行宫" target=_blank>我的行宫</a></li>
    <li><a href="http://www.linuxforum.net/" title="中国linux论坛" target=_blank>中国linux论坛</a></li>
    </ul>
</li>
</ul>
</td><td width=150px align=left valign=center>
欢迎光临<font color=red size=2>tybitsfox</font>小站 
</td><td align=left valign=top>
<div class="align-center" id="showtime"></div>
</td></tr>
<tr>
<form name="form1" method="post" action="index.php">
<td width=750px >
<table class="aaaa" border=1><tr>
	<td width=30%>
		<a href="./index_new.php" target=_blank>测试链接</a><br>
		<a href="./ttt01.php" target=_blank>test</a>
	</td>
<td>hello</td>
</tr></table>
</td><td colspan=2 align=left>
<br><table class="aaaa" >
<tr><td align=left valign=top width=100px><input type=hidden name=action value=search size=0>站内查询关键字：</td>
<td align=left valign=top width=160px><input type=text name=keyword size=20 /></td>
<td align=left valign=top><input type=submit value="查 询" /></td></tr>
</form>
</td></tr>
</table>
<?php
if($_POST[action]==search)
{
	echo "查询结果：<br>";
	$g=$_POST[keyword];
	$msg=system("/var/www/sch $g",$ret);
	//echo "$msg";
}
?>
</tr></table>









