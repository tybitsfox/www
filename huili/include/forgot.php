<?php
/**
 @package		huili manager
 @version		0.0.0.1
 @author		田勇 Alisa tybitsfox <tybitsfox@163.com>
 @license		GPLv2

本文件是密码找回的实现文件
 **/
?>
<?php
if(!defined("FULL_PATH"))
	define("FULL_PATH",substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-strlen(strstr(dirname(__FILE__),"huili")))."huili".DIRECTORY_SEPARATOR);
require_once(constant("FULL_PATH")."config/glob_new.php");
require_once(constant("FULL_PATH")."config/glob_prev.php");
echo $OUT_HTML['LOGIN_HEAD'];
$s1=sprintf($OUT_HTML['LOGIN_BODY_1g'],constant("WORK_PLACE")."include/forgot.php");
echo $s1;
if(isset($_POST['email']))
{//这里要添加邮件发送代码
	echo $OUT_HTML['FORGOT_AFTER'];
}
else
	echo $OUT_HTML['FORGOT_BODY_1l'];
echo $OUT_HTML['LOGIN_BODY_3g'];
echo $OUT_HTML['TAIL'];
?>
