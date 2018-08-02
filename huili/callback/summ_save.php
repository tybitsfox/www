<?php
require_once("../lib/db_base.php");
$ay=array($_POST['idx'],$_POST['ttle'],$_POST['nam'],$_POST['bod'],$_POST['uid']);
if($ay[3] == null)
{	echo "wrong";
	exit(0);
}
if($ay[1] == null)
{
	$s1=array();
	$s1=preg_split("/[' ',',','.','，','。']/",$ay[3]);
	foreach($s1 as $a)
	{
		if((strlen($a) > 1) || (strlen($a) < 60))
		{$ay[1]=$a;break;}
	}
	if($ay[1] == null)
		$ay[1]=$ay[2];
}
$ta=new tb_blog();
$ta->add_blog($ay);
if($ta->err_no)
	$ta->err_msg();
else
	echo "ok!";
//var_dump($ay);
?>
