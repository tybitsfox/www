<?php
require_once("../lib/db_base.php");
if($_POST['bod'] == null)
	exit(0);
$st=$_POST['bod'];
$s1="/<img(.*?)src=\"(.*?)\"(.*?)>/i";
$s2="<div class=\"blog-img\"><img src=\"\${2}\"></div>";
$s3=preg_replace($s1,$s2,$st);
$s1="/<table class/";
$s2="<div style=\"width:90%;overflow:auto;margin:auto;\"><table class";
$st=preg_replace($s1,$s2,$s3);
$s1="/<\/table>/";
$s2="<\/table><\/div>";
$s3=preg_replace($s1,$s2,$st); //把表格也替换掉
//echo $_POST['bod'];
//die($s3);
$ay=array($_POST['idx'],$_POST['ttle'],$_POST['nam'],$s3,$_POST['uid']);
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
