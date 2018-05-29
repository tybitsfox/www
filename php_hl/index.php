<?php
header("Content-Type:text/html;charset=utf-8");
session_start();
if(!defined("FULL_PATH"))
{
	$s1=dirname(__FILE__);
	$s2=strstr($s1,"php_hl");
	$i=strlen($s1)-strlen($s2);
	$s2=substr($s1,0,$i)."php_hl/";
	define("FULL_PATH",$s2);
}
$str=constant("FULL_PATH")."interface/main.php";
require_once($str);
_verf_fox();
global $tybitsfox;
$str=constant("FULL_PATH")."template/01/01.html";
include_once($str);
//if($_GET['pgcnt'] == NULL)
if(!isset($_GET['pgcnt']))
{
	echo "</div></body></html>";
}	
else
{
	$st=str_replace(' ','+',$_GET['pgcnt']);
	$str=constant("FULL_PATH").base64_decode($st);
	require_once($str);
}
?>



