<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<a name=g000><center><font face=\"YaHei Consolas Hybrid\" size=5 color=blue> 目录及文件结构说明</center></font><br><br><font face=\"YaHei Consolas Hybrid\" size=3 color=black>";
echo "该示例将所有gtk相关的代码都放在文件<a href=gtk_simple.php#g001>f01.c</a>中实现，并且编译为动态链接库的形式供主程序调用<br>
头文件<a href=gtk_simple.php#g002>f01.h</a>定义了gtk程序所用的基本数据结构和函数声明<a href=gtk_simple.php#g003>makefile</a>编译生成动态链接库程序<br><br><br><br><br><br>
<br><br><br><br><br><br><br><br></font>";
echo "<a name=g002></a><center>----------------f01.h----------------</center><font color=#ff00ff size=3><pre>";
include_once("./t02/f01.h");
echo "</pre></font>";
echo "<br><br><center><a href=gtk_simple.php#g000>返回</a></center><br><br><br><br><br>";
echo "<a name=g001></a><center>----------------f01.c----------------</center><font color=#66aa66 size=3><pre>";
include_once("./t02/f01.c");
echo "</pre></font>";
echo "<br><br><center><a href=gtk_simple.php#g000>返回</a></center><br><br><br><br><br>";
echo "<a name=g003></a><center>----------------makefile----------------</center><font color=#ff00ff size=3><pre>";
include_once("./t02/makefile");
echo "</pre></font>";
echo "<br><br><center><a href=gtk_simple.php#g000>返回</a></center><br><br><br><br><br>";



?>
