<?php
if(session_status() != PHP_SESSION_ACTIVE)
	session_start();
if(!defined("FULL_PATH"))
    define("FULL_PATH",substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-strlen(strstr(dirname(__FILE__),"huili")))."huili".DIRECTORY_SEPARATOR);
require_once(constant("FULL_PATH")."config/glob_new.php");  //全局常量及变量定义文件的引入
require_once(constant("FULL_PATH")."config/glob_signed.php");
//require_once(constant("FULL_PATH")."lib/main.php");
require_once(constant("FULL_PATH")."lib/db_base.php");
require_once(constant("FULL_PATH")."config/email.php");
/// check login
if((!isset($_SESSION['CURR_USR'])) || (count($_SESSION['CURR_USR']) != 13))
	die("没有授权，禁止登录"."count=".count($_SESSION['CURR_USR']));
////////////////////////
$err_string=$SIGNED_DEF['TOP_TEXT1'];
if(isset($_POST['upmodule']))
{
	if(strlen($_POST['upmodule']) > 1)
	{
		if(strpos($_POST['upmodule'],',') == 0)
			$str=substr($_POST['upmodule'],1);
		else
			$str=$_POST['upmodule'];
		$ta=new tb_choose();
		$sa=array();
		$sa=explode(',',$str);
		for($i=0;$i<count($sa);$i++)
		{
			unset($sb);
			$j=intval($sa[$i])-2; //get index.
			$sb=array($_SESSION['CURR_USR'][0],$j,$SIGNED_DEF['MODULE'][$j][3],$SIGNED_DEF['MODULE'][$j][1],$SIGNED_DEF['MODULE'][$j][0],$SIGNED_DEF['MODULE'][$j][2],$SIGNED_DEF['MODULE'][$j][4]);
			$ta->add_db($sb);
			if($ta->err_no)
			{
				$err_string=$ta->err_msg();
				break;
			}
		}
	}
}
$ta=new tb_choose();
$u=$_SESSION['CURR_USR'][0]; //uid
$cy=array();
$cy=$ta->get_db($u);
if($ta->err_no)
	$err_string=$ta->err_msg();
echo $ALL_HTML['LOGIN_HEAD']."<body>";
echo "<script>
var liaa=[['".$SIGNED_DEF['DASHBOARD'][1][3]."','".''."','".''."'],['".$SIGNED_DEF['DASHBOARD'][2][3]."','".$SIGNED_PAGE['ADD']."','".$SIGNED_DEF['DASHBOARD'][2][2]."']];";
//$j=count($SIGNED_DEF['MODULE']);
$j=count($cy);
for($i=0;$i<$j;$i++)
{
	$st=substr($cy[$i][2],6);
	$l=intval($st)-2;
	$k=sprintf("%d",$i+2);
	echo "liaa[".$k."]=['".$SIGNED_DEF['MODULE'][$l][3]."','".$SIGNED_DEF['MODULE'][$l][5]."','".$SIGNED_DEF['MODULE'][$l][2]."'];";
}
echo "
//color:#455f6c,#3eae48
window.onload=chlinkfunc;
</script>";
echo $SIG_HTML['WRAP'];
if(!isset($_GET['select']))
{
	include_once('./def_login.php');
}
else
{
	$s1=$_GET['select'];
	switch($s1)
	{
	case $SIGNED_PAGE['ONE']:
		include_once('./setting_pro.php');
		break;
	case $SIGNED_PAGE['FUR']:
		include_once('./setting_invite.php');
		break;
	case $SIGNED_PAGE['FIV']:
		include_once('./setting_coll.php');
		break;
	case $SIGNED_PAGE['SIX']:
		include_once('./setting_secu.php');
		break;
	case $SIGNED_PAGE['SEV']:
		include_once('./setting_share.php');
		break;
	case $SIGNED_PAGE['NIN']:
		include_once('./setting_admin.php');
		break;
	case $SIGNED_PAGE['EIG']:
		unset($_SESSION['CURR_USR']);
		echo "<script>window.location='../index.php';</script>";
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
	//		$st=sprintf($SIG_HTML['LEFT_REP'],$dy[2],$dy[4],$dy[5],$dy[3],$dy[6]);
			$st=sprintf($SIG_HTML['LEFT_REP'],$dy[2],'/huili/include/home.php',$dy[5],$dy[3],$dy[6]);
			echo $st;
		}
		if($j <= 5)
		{
			$st=sprintf($SIG_HTML['LEFT_REP'],$SIGNED_DEF['DASHBOARD'][2][3],$SIGNED_DEF['DASHBOARD'][2][0],$SIGNED_DEF['DASHBOARD'][2][2],$SIGNED_DEF['DASHBOARD'][2][1],$SIGNED_DEF['DASHBOARD'][2][4]);
			echo $st;
		}
		echo $SIG_HTML['LEFT_TOP3'];
		$st1="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li>添加功能";
		$st=sprintf($SIG_HTML['RIGHT_TOP1'],$st1);
		echo $st;
		echo $SIG_HTML['RIGHT_ADD1'];
		$j=count($sss);
		for($i=0;$i<$j;$i++)
		{
			$dy=array();
			$dy=$sss[$i];
			$sc=$dy[3]."a";
			$st=sprintf($SIG_HTML['RIGHT_ADD_REP'],$sc,$dy[4],$dy[1],$sc);
			echo $st;
		}
		echo $SIG_HTML['RIGHT_ADD2'];
		echo $SIG_HTML['RIGHT_TOP3'];
		break;
	default:
		include_once('./def_login.php');
		break;
	}
}
?>


