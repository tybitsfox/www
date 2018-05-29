<?php
/*本文件定义一些独立功能的函数
 
 	2016-4-17 田勇 alias tybitsfox
 */
//2017-1-1添加session的状态判断,避免log中的错误提示
if(session_status() != PHP_SESSION_ACTIVE)
	session_start();
if(!defined("FULL_PATH"))
{
	$s1=dirname(__FILE__);
	$s2=strstr($s1,"php_hl");
	$i=strlen($s1)-strlen($s2);
	$s2=substr($s1,0,$i)."php_hl/";
	define("FULL_PATH",$s2);
}
//确保包含了全局变量的定义文件
if(!defined("SDHL_GBL"))
{
	$ifile=constant("FULL_PATH")."config/main.php";
	require_once($ifile);
}	
//{{{ function array_ptoj() 一个php数组转js数组的函数
/*虽然在php5.4以后有了一个非常好用的Json_encode,json_decode函数
  但是该函数还是具有一定的局限性，例如他目前仅支持uft-8编码
  所以，我想用最基本的方法实现一个类似功能的函数调用。
  由于急于使用，目前仅实现我所需的转换功能：key:ignore value: as a array
 的情况进行转换。本函数会先检测在用的php版本，如果高于5.2则直接调用json_encode;
 返回值：string
 在javascript中赋值应：
 var st=<?php echo array_ptoj($inary);?>
 */
function array_ptoj($inary)
{
	if(version_compare(PHP_VERSION,"5.2")>0)
		return json_encode($inary,JSON_UNESCAPED_UNICODE);
	$st="error";
	if(!is_array($inary))
		return $st;
	$flag1=0;
	$i=count($inary);
	$ay1=array();
	$ay1=array_values($inary);
	$str="[[";
	for($j=0;$j<$i;$j++)
	{
		$ay2=$ay1[$j];
		if(!is_array($ay2))
			return $st;
		$k=count($ay2);
		for($l=0;$l<$k;$l++)
		{
			$ay3=$ay2[$l];
			if(is_array($ay3) || is_object($ay3))
				return $st;
			$str.="'".$ay3."',";
		}
		$str=substr($str,0,(strlen($str)-1));
		$str.="],[";
	}
	$st=substr($str,0,(strlen($str)-3));
	$st.="]]";
	return $st;
}
?>
