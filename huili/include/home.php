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
//require_once(constant("FULL_PATH")."template/pinyin.php");
define("HOME_CALLED",$_SESSION['CURR_USR'][0]); //保证不会跨越本文件直接调用子模块
/// check login
if((!isset($_SESSION['CURR_USR'])) || (count($_SESSION['CURR_USR']) != 14))
	die("没有授权，禁止登录"."count=".count($_SESSION['CURR_USR']));
////////////////////////
$err_string=$SIGNED_DEF['TOP_TEXT1'];
if(isset($_POST['checkx']))
{
	$ta=new tb_choose();
	$ta->del_by_uid();
	if($ta->err_no)
		die($ta->err_msg());
	$j=count($_POST['checkx']);
	$ay=array();
	for($i=0;$i<$j;$i++)
	{
		unset($sb);
		$k=intval($_POST['checkx'][$i]);
		$sb=array($_SESSION['CURR_USR'][0],$k,$SIGNED_DEF['MODULE'][$k][3],$SIGNED_DEF['MODULE'][$k][1],$SIGNED_DEF['MODULE'][$k][0],$SIGNED_DEF['MODULE'][$k][2],$SIGNED_DEF['MODULE'][$k][4]);
		array_push($ay,$sb);
	}
	$ta->add_db_group($ay);
	if($ta->err_no)
		die($ta->err_msg());
	unset($ta);unset($ay);
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
$j=count($cy);
for($i=0;$i<$j;$i++)
{
	$l=intval($cy[$i][1]);
	$k=sprintf("%d",$i+2);
	echo "liaa[".$k."]=['".$SIGNED_DEF['MODULE'][$l][3]."','".$SIGNED_DEF['MODULE'][$l][5]."','".$SIGNED_DEF['MODULE'][$l][2]."'];";
}
//color:#455f6c,#3eae48
echo "
window.onload=chlinkfunc;
</script>";
echo $SIG_HTML['WRAP'];
if(!isset($_GET['select']))
{
	include_once('../template/def_dashbroad.php');
	include_once('../template/def_login.php');
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
	case $SIGNED_PAGE['GJ1']://环评
		include_once('../template/def_dashbroad.php');
		include_once('./huanping.php');
		break;
	default:
		include_once('../template/def_dashbroad.php');
		include_once('../template/def_login.php');
		break;
	}
}
?>


