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
if(!defined("FULL_PATH"))
	define("FULL_PATH",substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-strlen(strstr(dirname(__FILE__),"huili")))."huili".DIRECTORY_SEPARATOR);
require_once(constant("FULL_PATH")."config/glob_new.php");
require_once(constant("FULL_PATH")."lib/main.php");
global $GLOB_DEF,$OUT_HTML;
echo $OUT_HTML['LOGIN_HEAD'];
$s1=sprintf($OUT_HTML['LOGIN_BODY_1g'],constant("WORK_PLACE")."include/login.php");
echo $s1;
if(isset($_POST["email"]) && isset($_POST["password"]))
{
	$a=new loginn($_POST["email"],$_POST["password"]);
	$i=$a->signin();
	if($i)
		$a->err_msg($i);
	else
		echo "<script>setTimeout(\"window.location='../index.php'\",2);</script>";
}
echo $OUT_HTML['LOGIN_BODY_2l'];
echo $OUT_HTML['LOGIN_BODY_3g'];
echo $OUT_HTML['TAIL'];
?>
