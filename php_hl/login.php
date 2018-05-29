<?php
if(!defined("FULL_PATH"))
{
	$s1=dirname(__FILE__);
	$s2=strstr($s1,"php_hl");
	$i=strlen($s1)-strlen($s2);
	$s2=substr($s1,0,$i)."php_hl/";
	define("FULL_PATH",$s2);
}
?>
<?php
header("Content-Type:text/html;charset=UTF-8");
session_start();
if(!isset($_SESSION['leftcnt']))
	$_SESSION['leftcnt']=4;
$str=constant("FULL_PATH")."interface/main.php";
//require_once("interface/main.php");
require_once($str);
if($_SESSION['leftcnt'] <= 0)
{
//	header("Refresh:2 url=./index.php");
	die("fuck you~");
}
global $tybitsfox;
if(isset($_SESSION['logok']) && ($_SESSION['logok'] == $tybitsfox['corename']))
{
	if(isset($_SESSION['user']))
	{
		header("Refresh:0 url=./index.php");
		die();
	}
}
?>
<html><head><title><?php echo $tybitsfox['title'];?></title>
<link href='css/extra.css' rel='stylesheet' type='text/css' media='all'/>
</head><body>
<form name="login" method="post" action="login.php">
<div><h2><?php echo $tybitsfox['logmsg']?></h2></div>
<!-- <div id='div1'> -->
<div class='dvmsg'>
<table width=100% border=0>
<tr><td width=30%>用户名：</td><td width=40%><input type='text' id='text_id' name='user' size=30 /></td><td width=30%></td></tr>
<tr><td width=30%>密  码：</td><td width=40%><input type='password' style='display:none' />
<input type='password' id='text_id' name='password' size=30 /></td><td width=30%></td></tr>
<tr><td width=30%>验证码：</td><td width=40%><input type='text' id='text_id' name='verf' size=30 /></td>
<td width=30%><img src="ta_verf1.php" title="点击更换图片" onclick="this.src=this.src+'?'+Math.random();" /></td></tr>
<tr><td colspan=3 width=100% align=center><br><input type='submit' id='button_id' name='submit' value='登录'/> &nbsp;&nbsp;&nbsp;&nbsp;
<input type='reset' id='button_id' name='reset' value="重置"/>&nbsp;&nbsp;&nbsp;&nbsp;<a href='./template/t01/reg.php'>注册</a></td></tr>
</table>    

</div></form></body></html> 
<?php
function check_verf()
{
	if($_SESSION['CODE'] == $_POST['verf'])
		return true;
	return false;
}
if(isset($_POST['submit']))
{
	if(check_verf())
	{
		if(_verf_db($_POST['user'],$_POST['password']) != 0)
		{
			$st="<div>用户名或者密码错误，可登录次数：".$_SESSION['leftcnt']."次 </div>";
			echo $st;
			$_SESSION['leftcnt']-=1;
			if($_SESSION['leftcnt'] <= 0)
				die();
		}
		else
		{
			$_SESSION['logok'] = $tybitsfox['corename'];
			$_SESSION['leftcnt']	= 4;
			$_SESSION['user']	=	$_POST['user'];
			header("Refresh:0 url=./index.php");
		}
	}
	else
	{
		$st="<div>验证码错误，可登录次数：".$_SESSION['leftcnt']."次 </div>";
		echo $st;
		$_SESSION['leftcnt']-=1;
		if($_SESSION['leftcnt'] <= 0)
			die();
	}
}
else
{
	if(!isset($_SESSION['leftcnt']))
		$_SESSION['leftcnt']=4;
}
require_once("template/03/foot.php");
?>



