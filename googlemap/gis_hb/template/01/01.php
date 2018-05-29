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
<script type="text/javascript">
var sc=screen.width;
document.cookie="screen="+sc;
function unreg()
{
	location.href="template/t01/login1.php";
}
function oooii()
{
	window.location.href="template/03/excel.php";
}
</script>
<script language="JavaScript" src="./css/mydate.js"></script>
<?php
echo "<html><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
//2017-1-1添加session的状态判断,避免log中的错误提示
if(session_status() != PHP_SESSION_ACTIVE)
	session_start();
if(!defined("FULL_PATH"))
{
	$s1=dirname(__FILE__);
	$s2=strstr($s1,"gis_hb");
	$i=strlen($s1)-strlen($s2);
	$s2=substr($s1,0,$i)."gis_hb/";
	define("FULL_PATH",$s2);
}
$str="<link href='css/base.css' rel='stylesheet' type='text/css' media='all'/>";
echo $str;
global $tybitsfox,$GIS_BAIDU_AK;
$str="<title>".$tybitsfox['title']."</title>";
echo $str;
$str="<script type='text/javascript' src='http://api.map.baidu.com/api?v=2.0&ak=".$GIS_BAIDU_AK."'></script>";
echo $str;
echo "<script src='http://libs.baidu.com/jquery/1.9.0/jquery.js'></script>";
?>
<?php
	echo "</head><body><div id='container_id'>";
	echo "<div id='header_id'><img src='./css/logo.png' style='display:block;width:80%;' /></div><div id='menu_id'><ul>";
    $cnt=count($menuitem);
    for($i=0;$i<$cnt;$i++)
    {
        echo "<li><a href='".$menulnk[$i]."'>".$menuitem[$i]."</a><li><li class='menudiv_class'></li>";
    }
	$st="<li>&nbsp;&nbsp;&nbsp;&nbsp;<font color=red>欢迎 </font>[ <a href='javascript:void(0)' onclick ='unreg()' />";
	$st.=$_SESSION['user']."</a> ]</li><li class='menudiv_class'></li>";
	echo $st;
	echo "</ul></div><div id='clear_id'></div>";
?>
