<?php
/**
 @package		huili manager
 @version		0.0.0.1
 @author		田勇 Alisa tybitsfox <tybitsfox@163.com>
 @license		GPLv2

工程的入口文件
 **/
?>
<?php
if(!defined("FULL_PATH"))
	define("FULL_PATH",substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-strlen(strstr(dirname(__FILE__),"huili")))."huili".DIRECTORY_SEPARATOR);
require_once(constant("FULL_PATH")."config/glob_new.php");	//全局常量及变量定义文件的引入
include_once(constant("FULL_PATH")."include/head_doc.php"); //起始头文件的引入
if(isset($_GET["selecter"]))
{
	switch($_GET["selecter"])
	{
	case $GLOB_DEF['PG_ONE']:	//管家服务
		echo $EX_HTML['expert_beg'];
		$k=count($GLOB_DEF['EXPE_ARRY']);
		for($i=0;$i<$k;$i++)
		{
			$ay=array();
			$ay=$GLOB_DEF['EXPE_ARRY'][$i];
			$st=sprintf($EX_HTML['expert_list'],$ay[0],$ay[1],$ay[2]);
			echo $st;
			unset($ay);
		}
		echo $EX_HTML['expert_end'];
		break;
	case $GLOB_DEF['PG_TWO']:	//监控平台
		echo $EX_HTML['plat_beg'];
		$k=count($GLOB_DEF['PLAT_ARRY']);
		for($i=0;$i<$k;$i++)
		{
			$ay=array();
			$ay=$GLOB_DEF['PLAT_ARRY'][$i];
			$st=sprintf($EX_HTML['plat_list'],$ay[0],$ay[1],$ay[2]);
			echo $st;
			unset($ay);
		}
		echo $EX_HTML['plat_end'];
		break;
	case $GLOB_DEF['PG_THR']:	//专家团队
		echo $EX_HTML['engin_beg'];
		$k=count($GLOB_DEF['ENGIN_ARRY']);
		for($i=0;$i<$k;$i++)
		{
			$ay=array();
			$ay=$GLOB_DEF['ENGIN_ARRY'][$i];
			$st=sprintf($EX_HTML['engin_list'],$ay[0],$ay[1],$ay[2],$ay[3]);
			echo $st;
			unset($ay);
		}
		echo $EX_HTML['engin_end'];
		break;
	case $GLOB_DEF['PG_FUR']:	//交流互动
		echo $EX_HTML['blog_beg'];
		$k=count($GLOB_DEF['BLOG_ARRY']);
		for($i=0;$i<$k;$i++)
		{
			$ay=array();
			$ay=$GLOB_DEF['BLOG_ARRY'][$i];
			$st=sprintf($EX_HTML['blog_list'],$ay[0],$ay[1],$ay[2],$ay[3],$ay[4],$ay[5]);
			echo $st;
			unset($ay);
		}
		echo $EX_HTML['blog_end'];
	default:
		break;
	}
}
else	//登录主界面
{
	echo $EX_HTML['home'];
	echo $EX_HTML['feature'];
}
include_once(constant("FULL_PATH")."include/foot.php");	//底部文件的引入
?>
