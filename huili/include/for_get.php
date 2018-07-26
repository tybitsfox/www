<?php
if(session_status() != PHP_SESSION_ACTIVE)
	session_start();
require_once("../lib/db_base.php");
if(isset($_GET['update'])) //更新浏览次数
{
}
else
{
//echo date("Y-m-d H:i:s");
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
			$st=$st.$a[3]."<br>";
		}
	}
	$st=$st."aid: ".$_GET['aid']."  bid: ".$_GET['bid']."<br>";
	echo $st;
}
?>
