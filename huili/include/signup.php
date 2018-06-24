<?php
/**
 @package		huili manager
 @version		0.0.0.1
 @author		田勇 Alisa tybitsfox <tybitsfox@163.com>
 @license		GPLv2

本文件是注册操作的实现文件
 **/
?>
<?php
if(isset($_POST['trusted']) && isset($_POST['password']) && isset($_POST['new-password']) && isset($_POST['email-name']))
{
	if(strcmp($_POST['new-password'],$_POST['password']) == 0)
	{
		if(count($_POST['trusted']))
		{
			$i=30*24*60*60;
			setcookie("huili_lgname",$_POST['email-name'],time()+$i);
			setcookie("huili_lgpwd",base64_encode($_POST['password']),time()+$i);
		}
	}
}
?>
<?php
if(!defined("FULL_PATH"))
	define("FULL_PATH",substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-strlen(strstr(dirname(__FILE__),"huili")))."huili".DIRECTORY_SEPARATOR);
require_once(constant("FULL_PATH")."config/glob_new.php");
require_once(constant("FULL_PATH")."config/glob_prev.php");
require_once(constant("FULL_PATH")."lib/main.php");
require_once(constant("FULL_PATH")."config/email.php");
echo $ALL_HTML['LOGIN_HEAD'];
if(isset($_POST['new-password']))
{//这里是通过邮箱验证，开始密码验证并完成注册的代码
	if(strcmp($_POST['new-password'],$_POST['password']) != 0)
	{
			$s1=sprintf($OUT_HTML['VERF_BODY_1l'],constant("WORK_PLACE")."include/signup.php");
			echo $s1;
			echo "<div class='alert alert-danger' role='alert'><strong>错误</strong> 两次输入的密码不一致</div>";
			$v=new mixer();$st=$v->mix($_POST['email-name']);
			if(!$v->unmix($st))
				die("请获得授权再访问当前页面.");
			$v->unmix($st);
			$w=$v->get_mail();
			$st=sprintf($OUT_HTML['VERF_BODY_2l'],$w,$w);
			echo $st;
			echo $OUT_HTML['VERF_BODY_3l'];
			echo $OUT_HTML['LOGIN_BODY_3g'];
			echo $OUT_HTML['TAIL'];
	}
	else
	{

		$a=new loginn($_POST['email-name'],$_POST['new-password']);
		$j=$a->signup();
		if($j > 0)
			$a->err_msg($j);
		else
		{
			$s1=sprintf($OUT_HTML['VERF_BODY_1l'],constant("WORK_PLACE")."include/signup.php");
			echo $s1;
			echo "<div class='alert alert-danger' role='alert'><strong>注册成功</strong> 马上跳转...</div>";
			echo "<script>setTimeout(\"window.location='./home.php'\",1000);</script>";
		}	
	}
}
else
{
	$s1=sprintf($OUT_HTML['VERF_BODY_1l'],constant("WORK_PLACE")."include/signup.php");
	echo $s1;
	if(!isset($_GET['code']))
	{//这里是注册起始的界面代码
		if(isset($_POST['email']))
		{//这里是用户输入注册邮箱并点击确定后，邮件的发送提醒界面代码
			$v=new mixer();
			//echo $OUT_HTML['REG_AFTER'];
			$svv=sprintf($OUT_HTML['REG_AFTER'],$_POST['email']);
			echo $svv;
			$handle=fopen($GLOB_DEF['EMAIL'],"r");
			$needle=$v->get_nedle();
			while(!feof($handle))
			{
				$st1=fgets($handle);
				$pos=strpos($st1,$needle);
				if($pos === false)
					$st.=$st1;
				else
				{
					$pos=strpos($st1,$needle,$pos+2);
					if($pos === false)
						$st2=sprintf($st1,$v->mix($_POST["email"]));
					else
						$st2=sprintf($st1,$v->mix($_POST["email"]),$v->mix($_POST["email"]));
					$st.=$st2;
				}
			}
			fclose($handle);
			unset($v);
			$mailcontent = $st;
			$mailtype = "HTML";//HTML/TXT
			$smtp = new smtp();//这里面的一个true是表示使用身份验证,否则不使用身份验证.
			$state = $smtp->sendmail($_POST["email"],"bitsfox@126.com","huishi group", $mailcontent, $mailtype);
		}
		else //这里是等待用户输入注册邮箱的最起始的界面代码
			echo $OUT_HTML['REG_NORMAL'];
	}
	else
	{//这里是通过邮箱里验证链接打开的准备输入用户密码的注册界面代码
		$v=new mixer();
		if(!$v->unmix($_GET["code"]))
			die("请获得授权再访问当前页面.");
		$w=$v->get_mail();
		$st=sprintf($OUT_HTML['VERF_BODY_2l'],$w,$w);
		echo $st;
		echo $OUT_HTML['VERF_BODY_3l'];
	}
	echo $OUT_HTML['LOGIN_BODY_3g'];
	echo $OUT_HTML['TAIL'];
}
?>
