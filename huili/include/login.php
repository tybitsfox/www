<?php
/**
 @package		huili manager
 @version		0.0.0.1
 @author		田勇 Alisa tybitsfox <tybitsfox@163.com>
 @license		GPLv2

本文件是系统所需的全局变量和常量的定义文件
 **/
?>
<?php
//		$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; 
//		setcookie("huili_lgname","",time()-3600,"/",$domain,false);
//		setcookie("huili_lgpwd","",time()-3600,"/",$domain,false);
$cookname="";
$cookpwd="";
$cookchk="";
if(isset($_COOKIE['huili_lgpwd']))
{
	$cookname=$_COOKIE['huili_lgname'];
	$cookpwd=base64_decode($_COOKIE['huili_lgpwd']);
	$cookchk="checked";
}
else
{
	if(isset($_POST['trusted']))
	{
		if(count($_POST['trusted']))
		{
			$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; 
			$i=30*24*60*60;
			setcookie("huili_lgname",$_POST['email'],time()+$i,"/",$domain,false);
			setcookie("huili_lgpwd",base64_encode($_POST['password']),time()+$i,"/",$domain,false);
		}
	}
}
?>
<?php
if(!defined("FULL_PATH"))
	define("FULL_PATH",substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-strlen(strstr(dirname(__FILE__),"huili")))."huili".DIRECTORY_SEPARATOR);
require_once(constant("FULL_PATH")."config/glob_new.php");
require_once(constant("FULL_PATH")."config/glob_prev.php");
//require_once(constant("FULL_PATH")."lib/main.php");
require_once(constant("FULL_PATH")."lib/db_base.php");
echo $ALL_HTML['LOGIN_HEAD'];
$s1=sprintf($OUT_HTML['LOGIN_BODY_1g'],constant("WORK_PLACE")."include/login.php");
echo $s1;
if(isset($_SESSION['badtimes']) && ($_SESSION['badtimes'] >=3 ))
	die("<div class='alert alert-danger' role='alert'><strong>错误</strong>登录被限制！</div>");
if(isset($_POST["email"]) && isset($_POST["password"]))
{
	if(!isset($_POST['trusted']))
	{
		$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; 
		setcookie("huili_lgname","",time()-3600,"/",$domain,false);
		setcookie("huili_lgpwd","",time()-3600,"/",$domain,false);
	}
	$a=new login();
	$a->signin($_POST["email"],$_POST["password"]);
	if($a->err_no)
	{
		if(isset($_SESSION['badtimes']))
			$_SESSION['badtimes']++;
		else
		{
			$_SESSION['badtimes']=0;
		}
		echo "<div class='alert alert-danger' role='alert'><strong>错误</strong>".$a->err_msg()."</div>";
	}
	else
	{
//添加-加我和我加的专家列表
		get_invite();
		$_SESSION['badtimes']=0;
		$ta=new used_sign();
		$ta->add_secu();
		if($ta->err_no == 0)
			echo "<script>setTimeout(\"window.location='./home.php'\",2);</script>";
		else
			die($ta->err_msg());
	}
}
//echo $OUT_HTML['LOGIN_BODY_2l'];
$s1=sprintf($OUT_HTML['LOGIN_BODY_2l'],$cookname,$cookpwd,$cookchk);
echo $s1;
echo $OUT_HTML['LOGIN_BODY_3g'];
echo $OUT_HTML['TAIL'];
?>
