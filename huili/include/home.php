<?php
if(session_status() != PHP_SESSION_ACTIVE)
	session_start();
if(!defined("FULL_PATH"))
    define("FULL_PATH",substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-strlen(strstr(dirname(__FILE__),"huili")))."huili".DIRECTORY_SEPARATOR);
require_once(constant("FULL_PATH")."config/glob_new.php");  //全局常量及变量定义文件的引入
require_once(constant("FULL_PATH")."config/glob_signed.php");
require_once(constant("FULL_PATH")."lib/main.php");
echo $ALL_HTML['LOGIN_HEAD']."<body>";
echo "<script>
var liaa=[['".$SIGNED_DEF['DASHBOARD'][1][3]."','".''."'],['".$SIGNED_DEF['DASHBOARD'][2][3]."','".$SIGNED_PAGE['ADD']."']];";
$j=count($SIGNED_DEF['MODULE']);
for($i=0;$i<$j;$i++)
{
	$k=sprintf("%d",$i+2);
	echo "liaa[".$k."]=['".$SIGNED_DEF['MODULE'][$i][3]."','".$SIGNED_DEF['MODULE'][$i][5]."'];";
}
echo "
//color:#455f6c,#3eae48
window.onload=chlinkfunc;
</script>";
/// check login
if((!isset($_SESSION['CURR_USR'])) || (count($_SESSION['CURR_USR']) != 12))
	die("没有授权，禁止登录"."count=".count($_SESSION['CURR_USR']));
////////////////////////
$ta=new tb_choose();
$u=$_SESSION['CURR_USR'][0]; //uid
$cy=array();
$cy=$ta->get_db($u);
echo $SIG_HTML['WRAP'];
if(!isset($_GET['select']))
{
	$s1=$_SESSION['CURR_USR'][2];
	$s2=strtoupper(substr($s1,1,1));
	$st=sprintf($SIG_HTML['LEFT_TOP1'],$s2,$s1);
	echo $st;
	echo $SIG_HTML['LEFT_TOP2'];
	$j=count($cy);
	for($i=0;$i<$j;$i++)
	{
		$dy=array();
		$dy=$cy[$i];
		$st=sprintf($SIG_HTML['LEFT_REP'],$dy[2],$dy[4],$dy[5],$dy[3],$dy[6]);
		echo $st;
	}
	if($j <= 5)
	{
		$st=sprintf($SIG_HTML['LEFT_REP'],$SIGNED_DEF['DASHBOARD'][2][3],$SIGNED_DEF['DASHBOARD'][2][0],$SIGNED_DEF['DASHBOARD'][2][2],$SIGNED_DEF['DASHBOARD'][2][1],$SIGNED_DEF['DASHBOARD'][2][4]);
		echo $st;
	}
	echo $SIG_HTML['LEFT_TOP3'];
	echo $SIG_HTML['RIGHT_TOP1'];
	echo $SIG_HTML['RIGHT_TOP2'];
	echo $SIG_HTML['RIGHT_TOP_REPB'];
	$j=count($SIGNED_DEF['MODULE']);
	for($i=0;$i<$j;$i++)
	{
		$dy=array();
		$dy=$SIGNED_DEF['MODULE'][$i];
		$sc=$dy[3]."a";
		$st=sprintf($SIG_HTML['RIGHT_TOP_REP'],$sc,$dy[4],$dy[1],$sc);
		echo $st;
	}
	echo $SIG_HTML['RIGHT_TOP_REPE'];
	echo $SIG_HTML['RIGHT_TOP3'];
}
else
{
	$s1=$_GET['select'];
	switch($s1)
	{
	case $SIGNED_PAGE['ONE']:
		break;
	case $SIGNED_PAGE['TWO']:
		break;
	case $SIGNED_PAGE['THR']:
		break;
	case $SIGNED_PAGE['FUR']:
		break;
	case $SIGNED_PAGE['FIV']:
		break;
	case $SIGNED_PAGE['SIX']:
		break;
	case $SIGNED_PAGE['SEV']:
		break;
	case $SIGNED_PAGE['EIG']:
		break;
	case $SIGNED_PAGE['ADD']:
		$st1=$_SESSION['CURR_USR'][2];
		$st2=strtoupper(substr($st1,1,1));
		$st=sprintf($SIG_HTML['LEFT_TOP1'],$st2,$st1);
		echo $st;
		echo $SIG_HTML['LEFT_TOP2'];
		$j=count($cy);
		for($i=0;$i<$j;$i++)
		{
			$dy=array();
			$dy=$cy[$i];
			$st=sprintf($SIG_HTML['LEFT_REP'],$dy[2],$dy[4],$dy[5],$dy[3],$dy[6]);
			echo $st;
		}
		if($j <= 5)
		{
			$st=sprintf($SIG_HTML['LEFT_REP'],$SIGNED_DEF['DASHBOARD'][2][3],$SIGNED_DEF['DASHBOARD'][2][0],$SIGNED_DEF['DASHBOARD'][2][2],$SIGNED_DEF['DASHBOARD'][2][1],$SIGNED_DEF['DASHBOARD'][2][4]);
			echo $st;
		}
		echo $SIG_HTML['LEFT_TOP3'];
		echo $SIG_HTML['RIGHT_TOP1'];
		echo $SIG_HTML['RIGHT_ADD1'];
		$j=count($SIGNED_DEF['MODULE']);
		for($i=0;$i<$j;$i++)
		{
			$dy=array();
			$dy=$SIGNED_DEF['MODULE'][$i];
			$sc=$dy[3]."a";
			$st=sprintf($SIG_HTML['RIGHT_ADD_REP'],$sc,$dy[4],$dy[1],$sc);
			echo $st;
		}
		echo $SIG_HTML['RIGHT_ADD2'];
		echo $SIG_HTML['RIGHT_TOP3'];
		break;
	default:
		break;
	}
}
?>


