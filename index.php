<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- 显示时间的函数-->
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
<?php
if($_COOKIE["chose"] == "old")
{
	echo "<script>window.location.href='./index_bak.php'</script>";
}
else
{

include_once("./mystyle.css");
echo "<body onload='time()'><a name=a01></a>";
echo "<table class='aaaa'><tr><td width=800px align=left valign=top>";
echo "<div class='menu'><ul>";
$conn=mysqli_connect("localhost","taenv","taenv2014","web_data");
//if(! $conn)
if(mysqli_connect_errno())
{die("connect errsssss");}
//mysql_select_db("web_data",$conn);
//mysql_query("set names utf8",$conn);
mysqli_set_charset($conn,"utf8");
for($i=0;$i<6;$i++)
{
//	$sqlstr="select count(*) from menu_tb where idx = ".$i;
	$sqlstr="select * from menu_tb where idx = $i";
	$result=mysqli_query($conn,$sqlstr);
//	if(!$result)
//	{die("valid error");}
	$j=0;
	while($row=mysqli_fetch_row($result))
	{
		if($j==0)
		{
			echo "<li><a class='hide' href='#a01'>$row[0]</a><ul>";
			$j=1;
		}
		echo "<li><a href='./openall.php?subid=$i&submenu=$row[1]&url=$row[3]' title='$row[4]' target=_blank>$row[1]</a></li>";
	}
	echo "</ul></li>";
//	$j=$row[0];
	//echo "idx = ".$j."<br>";
	mysqli_free_result($result);
}
echo "</ul></li></ul></td><td width=150px align=left valign=center>欢迎光临<font color=red size=2>tybitsfox</font>小站</td><td align=left valign=top><div class='align-center' id='showtime'></div></td></tr><tr><td align=left valign=top><font color=red>我经常访问的热点链接：</font><br>";//</table>";
$sqlstr="select * from menu_tb order by count desc";
$result=mysqli_query($conn,$sqlstr);
/*if(!$result)
{
	mysql_close($conn);
	die("valid error!!!");
}*/
for($i=0;$i<9;$i++)
{
	$row=mysqli_fetch_row($result);
	echo "<br><a href='./openall.php?subid=$row[5]&submenu=$row[1]&url=$row[3]' title='$row[4]' target=_blank>$row[1]</a><br>";
}
mysqli_free_result($result);
#mysqli_close($conn);
echo "</td><td colspan=2 align=left valign=top><form name='form1' method='get' action='https://cn.bing.com/search' target=_blank><table class='aaaa'><tr><td align=left width=100px><input type=hidden name=action value=search size=0>站外搜索：</td><td align=left width=160px><input type=text name='q' size=20 /></td><td align=left><input type=submit value='搜 索' />&nbsp;&nbsp;<input type=reset value='清空' /></td></tr><tr><td colspan=3>";
//echo "</td><td colspan=2 align=left valign=top><form name='form1' method='get' action='http://www.baidu.com/s' target=_blank><table class='aaaa'><tr><td align=left width=100px><input type=hidden name=action value=search size=0>站外搜索：</td><td align=left width=160px><input type=text name=word size=20 /></td><td align=left><input type=submit value='搜 索' />&nbsp;&nbsp;<input type=reset value='清空' /></td></tr><tr><td colspan=3>";
/*if($_POST["action"]=="search")
{
	echo "查询结果：<br>";
	$g=$_POST[keyword];
	$msg=system("/var/www/sch $g",$ret);
	//echo "$msg";
}*/
echo "</td></tr></table></form> </td></tr></table>";
echo "<a href='./chgmain_idx.php?usersel=old'>返回老版主页</a>";
echo "<br><br><a href='./php_hl/login.php' target=_blank>监控平台登录</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='./googlemap/gis_hb/login.php' target=_blank>土壤信息</a>";
echo "<br><br><a href='./huili/index.php' target=_blank>管家测试</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='./huili/test/js_test/j01.php' target=_blank>设置</a><br><br>";
echo "<a href='./tools/js_learn/index.php' target=_blank>jquery学习</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=./www.veryhuo.com/php/index.html>PHP4手册</a>";
echo "<br><br><a href='http://ff10.ffsky.cn/' target=_blank>最终幻想10</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='http://ff12.ffsky.cn/' target=_blank>最终幻想12</a>";
echo "<br><br><a href='https://fanyi.baidu.com/?aldtype=85#en/zh/' target=_blank>翻译</a>";
echo "<table width=100% border=1><tr>";
$sqlstr="select * from lst_bookmark";
$result=mysqli_query($conn,$sqlstr);
$j=0;
while($row=mysqli_fetch_row($result))
{
	$j++;
	echo "<td><a href='$row[0]' target=_blank>$row[1]</a></td>";
	if(($j % 5) == 0){echo "</tr><tr>";}
}
mysqli_free_result($result);
mysqli_close($conn);
echo "</table>";
echo "</body>";
}
//echo "end of search....<br>";
?><!--
<br>
<br>
<br>
<br>
<form name="log1" method="post" action="ttt01.php">
<center><table class="aaaa"><tr>
	<td width=20%>
	<input type='text' name='user' size=20 value='' />
	</td>
	<td width=10%>
	<input type='submit' name='sub1' size=20 value='action'>
	</td>
	<td></td>
<tr></table>
</form>
<?php/*
if($_POST[sub1] == 'action')
{
	echo $_POST[user]."<br>";
}
/*if($_POST[user] != null)
{
	echo $_POST[user]."<br>".$_POST[sub1];
}*/
?>
-->


