<?php
/**
 * @package base
 * @version 0.1.0.0
 * @author 田勇 Alias tybitsfox <tybitsfox@163.com>
 * @copyright (c) 2017 by tybitsfox
 * @license GPLv2
 * 
 * 本文件是土壤环境信息系统其中的一个文件
 * Available at http://202.102.134.68
 *
 * 这一程序是自由软件，你可以遵照自由软件基金会出版的GNU通用公共许可证条款来修改和重新
 * 发布这一程序。或者用许可证的第二版，或者（根据你的选择）用任何更新的版本。
 *
 * 发布这一程序的目的是希望它有用，但没有任何担保。甚至没有适合特定目的的隐含的担保。更
 * 详细的情况请参阅GNU通用公共许可证。
 *
 * 你应该已经和程序一起收到一份GNU通用公共许可证的副本。如果还没有，请查阅：
 * <http://www.gnu.org/licenses/>.
 * 或者写信给： The Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston,
 * MA  02111-1307  USA
 */
?>
<?php
if(!defined("FULL_PATH"))
{
	$s1=dirname(__FILE__);
	$s2=strstr($s1,"gis_hb");
	$i=strlen($s1)-strlen($s2);
	$s2=substr($s1,0,$i)."gis_hb/";
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
//		header("Refresh:0 url=./index.php");
		echo "<script>setTimeout(\"window.location='./index.php'\",20);</script>";
	//	die();
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
			//header("Refresh:0 url=./index.php");
			echo "<script>setTimeout(\"window.location='./index.php'\",0);</script>";
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
//require_once("template/03/foot.php");
?>



