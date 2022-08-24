<?php
echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
//echo $_GET[subid].$_GET[submenu].$_GET[url];
$conn=mysqli_connect("localhost","taenv","taenv2014","web_data");
/*if(!$conn)
{die("connect err: ".mysql_error());}*/
//mysql_select_db("web_data",$conn);
//mysql_query("set names utf8",$conn);
mysqli_set_charset($conn,"utf8");
$sqlstr="update menu_tb set count=count+1  where submenu = '$_GET[submenu]' and idx = $_GET[subid]";
$result=mysqli_query($conn,$sqlstr);
/*if(!$result)
{
	mysql_close($conn);
	die("query error");
}*/
mysqli_close($conn);//当前网页计数完毕，开始转向打开网页
//echo "<script>window.location.href='".$_GET[url]."'</script>";  <--这种写法w3m打不开
echo "<meta http-equiv='refresh' content='0;url=$_REQUEST[url]'>";
?>
