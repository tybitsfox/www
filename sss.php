<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<table border=0 cellpadding=0 cellspacing=0>
<form name=search method=post action=\"sss.php\">
<!--//echo "<input type=hidden name=action value=search size=0>"; -->
<tr><td align=right valign=middle><input type=hidden name='action' value='search' size=0>查询关键字：</td><td align=left valign=middle><input type=text name="keyword" size=20 /></td>
<td align=left valign=middl:><input type=submit value="查 询"/></td></tr></form></table>
<?php
if($_POST['action'] == "search")
{
	echo "查询结果：<br>";
	$g=$_POST['keyword'];
	$msg=system("/var/www/sch $g",$ret);
	//echo "$msg";
}


?>
