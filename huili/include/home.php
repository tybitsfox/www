<?php
if(session_status() != PHP_SESSION_ACTIVE)
	session_start();
if(!defined("FULL_PATH"))
    define("FULL_PATH",substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-strlen(strstr(dirname(__FILE__),"huili")))."huili".DIRECTORY_SEPARATOR);
require_once(constant("FULL_PATH")."config/glob_new.php");  //全局常量及变量定义文件的引入
require_once(constant("FULL_PATH")."config/glob_signed.php");
require_once(constant("FULL_PATH")."lib/main.php");
echo $ALL_HTML['LOGIN_HEAD']."<body>";
/// check login
if(count($_SESSION['CURR_USR']) != 12 )
	die("没有授权，禁止登录"."count=".count($_SESSION['CURR_USR']));
////////////////////////
$ta=new tb_choose();
$u=$_SESSION['CURR_USR'][0]; //uid
$cy=array();
$cy=$ta->get_db($u);

echo $SIG_HTML['WRAP'];
if(!isset($_POST['select']))
{
	$s1=$_SESSION['CURR_USR'][2];
	$s2=strtoupper(substr($s1,1,1));
	$st=sprintf($SIG_HTML['LEFT_TOP1'],$s2,$s1);
	echo $st;
	echo $SIG_HTML['LEFT_TOP2'];

	echo $SIG_HTML['LEFT_REP1'];
	echo $SIG_HTML['LEFT_REP2'];
	echo $SIG_HTML['LEFT_TOP3'];
	echo $SIG_HTML['RIGHT_TOP1'];
	echo $SIG_HTML['RIGHT_TOP2'];
	echo $SIG_HTML['RIGHT_TOP_REP'];
	echo $SIG_HTML['RIGHT_TOP3'];
}
else
{
/*	$s1=$_POST['select'];
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
	default:
		break;
	}
	echo $SIG_HTML['LEFT_TOP2'];
	echo $SIG_HTML['LEFT_REP1'];
	echo $SIG_HTML['LEFT_REP2'];
	echo $SIG_HTML['LEFT_TOP3'];
	echo $SIG_HTML['RIGHT_TOP1'];
	echo $SIG_HTML['RIGHT_TOP2'];
	echo $SIG_HTML['RIGHT_TOP_REP'];
	echo $SIG_HTML['RIGHT_TOP3']; */
}
?>


