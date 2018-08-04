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
else
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
