<?php
if(session_status() != PHP_SESSION_ACTIVE)
	session_start();
require_once("../lib/db_base.php");
if(isset($_GET['update'])) //更新浏览次数
{
	$ay=array($_GET['aid'],$_GET['bid'],$_GET['mod'],"");
	$ta=new tb_talkmsg();
	$ta->update_msg($ay);
}
elseif(isset($_GET['area_code'])) //更新行政区划的地市
{
	$a=$_GET['area_code'];
	$ta=new tb_area_info();
	$ay=array();
	$ay=$ta->get_dishi($a);
	if(count($ay) < 1)
		$str="<option value='0'>没有数据</option>";
	else
		$str="<option value='0'>忽略地市</option>";
	foreach($ay as $b)
	{
		$st=sprintf("<option value='%s'>%s</option>",$b[0],$b[1]);
		$str=$str.$st;
	}
	echo $str;
}
else//实时聊天
{
//echo date("Y-m-d H:i:s");
	$name=$_GET['uname'];
	$ay=array($_GET['aid'],$_GET['bid'],$_GET['mod'],"");
	$cy=array();
	$ta=new tb_talkmsg();
	$cy=$ta->get_msg($ay);
	$st="";
	if($ta->err_no)
		echo $ta->err_msg();
	else
	{
		foreach($cy as $a)
		{
			if(intval($_GET['aid']) > intval($_GET['bid']))
			{
				if($a[5])
					$s1="<font color='green' size=3>我</font>&nbsp;&nbsp;<font color='gray' size=2>".$a[2]."</font></br>";
				else
					$s1="<font color='blue' size=3>".$name."</font>&nbsp;&nbsp;<font color='gray' size=2>".$a[2]."</font></br>";
			}
			else
			{
				if($a[5])
					$s1="<font color='blue' size=3>".$name."</font>&nbsp;&nbsp;<font color='gray' size=2>".$a[2]."</font></br>";
				else
					$s1="<font color='green' size=3>我</font>&nbsp;&nbsp;<font color='gray' size=2>".$a[2]."</font></br>";
			}
			$st=$st.$s1.$a[3]."<br>";
		}
	}
	$st=$st."aid: ".$_GET['aid']."  bid: ".$_GET['bid']."<br>";
	echo $st;
}
?>
