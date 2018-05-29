<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<font size=5 color=red><center>PDF浏览器-zathura</center></font><br>";
echo "<font size=3 color=blue><pre>";
echo "这款优秀的软件或许是目前最好的pdf查看器了，虽然是轻量级的但功能确是最为实用。其与vim一致的操作更是
能让一个vimer轻松上手。虽然如此但在初次尝试时还是有些小麻烦的，现一并记录在此。这些小麻烦主要的还是因为他
的手册简单，相关的文章稀少所致。
一基本操作：
常用命令：	 	o					打开文档
			j,k					上下移动
			space,S-space				上下半页移动
			gg,G					回文件头、尾
			numG					跳转至num页
			num=					缩放至num(标准100)
			q					退出
			mX,'X					标记，跳转至标记X ---这个命令无法使用，原因不明
			C-i					夜间模式和正常模式切换
			:					进入Ex模式

Ex模式：		bmark marksyntax	加入书签，书签名为mraksyntax
			blist m&lt;Tab&gt;		跳转至指定书签或tab补全选择
			bdelete marksytax	删除书签，书签名为mraksyntax

二配置文件：
配置文件在\$HOME/.config/zathura/目录下，默认为空，可以将一个例子文件拷贝过来:
/usr/share/doc/zathura/example/zathurarc，
查看man zathurarc对配置文件都详细的说明，
例如设置夜间模式为默认时：
set recolor true
在配置文件中还可以根据你的习惯（在vim中的习惯）进行一些键映射。
三书签的保存：
书签的保存可有几种不同的方式，默认的是database-plain(源代码中的表述)文本保存，在配置文件中还可以
指定使用sqlite数据库保存。这几个文件的默认位置是：\$HOME/.local/share/zathura/
如果使用了sqlite方式保存，则该目录下会生成一个bookmarks.sqlite的数据库文件。
如果使用默认的保存方式，则该目录下的bookmarks即为书签的保存文件。另一个文件：history则为进度和比例的
记录。
";


echo "</font></pre>";
?>
