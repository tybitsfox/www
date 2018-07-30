<?php
/**
 @package		huili manager
 @version		0.0.0.1
 @author		田勇 Alisa tybitsfox <tybitsfox@163.com>
 @license		GPLv2
本文件是系统所需的全局变量和常量的定义文件
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
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
	define("JS_FILEC",constant("WORK_PLACE")."js/jctt.js");
	define("JS_FILED",constant("WORK_PLACE")."css/bootstrap.js");
	define("JS_FILEE",constant("WORK_PLACE")."css/summernote.js");
	define("CSS_NOTE",constant("WORK_PLACE")."css/summernote.css");
	define("DB_SET",constant("FULL_PATH")."config/db_set.php");
	define("DEF_IMG",constant("WORK_PLACE")."images/logo/guest.png");
}
require_once(constant("DB_SET"));
$GLB_TITLE	=	"山东汇氏集团-汇氏管家";
$s1="<!DOCTYPE html>\n<html><head><meta charset='UTF-8' />\n<meta name='viewport' content='width=device-width, initial-scale=1.0'>\n<title>".$GLB_TITLE."</title>\n";
$s2="<link rel='stylesheet' href='".constant('CSS_FONT')."'>\n<link rel='stylesheet' href='".constant("CSS_LOG")."'>";
$s3="<script src='".constant("JS_FILEA")."'></script>\n<script src='".constant("JS_FILEB")."'></script>\n";
$s4="<link rel='stylesheet' href='".constant('CSS_FONT')."'>\n<link rel='stylesheet' href='".constant("CSS_MAIN")."'>";
$s5="<script src='".constant("JS_FILEC")."'></script>\n";
$s6="<link rel='stylesheet' href='".constant("CSS_NOTE")."'>\n<script src='".constant("JS_FILEE")."'></script>";
$ALL_HTML['LOGIN_HEAD']	=	$s1.$s2.$s3.$s5.$s6."</head>";		//这是注册，登录界面的标准头定义
$ALL_HTML['MAIN_HEAD']	=	$s1.$s4.$s3."</head><body>";		//这是主界面的标准头定义
unset($s1);unset($s2);unset($s3);unset($s4);
?>
