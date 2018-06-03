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
if(!defined("WORK_PLACE"))
{
	define("WORK_PLACE","/huili/");
	define("CSS_FONT",constant("WORK_PLACE")."css/style.css");
	define("CSS_MAIN",constant("WORK_PLACE")."css/formated.css");
	define("CSS_LOG",constant("WORK_PLACE")."css/ffiin.css");
	define("JS_FILEA",constant("WORK_PLACE")."js/jquery.min.js");
	define("JS_FILEB",constant("WORK_PLACE")."js/core.aadddae364.js");
	define("DB_SET",constant("FULL_PATH")."config/db_set.php");
}
require_once(constant("DB_SET"));
$s1="<!DOCTYPE html>\n<html><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />\n<title>".$GLOB_DEF['TITLE']."</title>\n";
$s2="<link rel='stylesheet' href='".constant('CSS_FONT')."'>\n<link rel='stylesheet' href='".constant("CSS_LOG")."'>";
$s3="<script src='".constant("JS_FILEA")."'></script>\n<script src='".constant("JS_FILEB")."'></script></head>\n";
$s4="<link rel='stylesheet' href='".constant('CSS_FONT')."'>\n<link rel='stylesheet' href='".constant("CSS_MAIN")."'>";
$ALL_HTML['LOGIN_HEAD']	=	$s1.$s2.$s3;		//这是注册，登录界面的标准头定义
$ALL_HTML['MAIN_HEAD']	=	$s1.$s4.$s3."<body>";		//这是主界面的标准头定义
unset($s1);unset($s2);unset($s3);unset($s4);
?>
