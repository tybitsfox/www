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
/*土壤环境信息系统
 本文件定义本项目所用的各类全局变量


 	2017-9-10  田勇 alias tybitsfox
 */
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
//确保包含了全局变量的定义文件
$str11=constant("FULL_PATH")."config/setup.php";
require_once($str11);
?>
<?php
	define("SDHL_GBL","sdhl_2016");
//版本信息和路径
	$tybitsfox['www_path']		=	"/var/www";
	$tybitsfox['version']		=	"0.0.0.1";
	$tybitsfox['corename']		=	"tiny";
//土壤环境信息系统平台登录
	$tybitsfox['logmsg']		=	"泰安市土壤环境信息系统登录";
//土壤环境信息系统平台	
	$tybitsfox['title']			=	"泰安市土壤环境信息系统"; 
//土壤环境信息系统用户注册
	$tybitsfox['regmsg']		=	"泰安市土壤环境信息系统用户注册";	
//定义主页的主菜单值
	$menuitem[0]			=	"点位总览";
	$menuitem[1]			=	"点位详细";
	$menuitem[2]			=	"数据分析";
	$menulnk[0]				=	"index.php?pgcnt=".base64_encode("template/01/m01.php");
	$menulnk[1]				=	"index.php?pgcnt=".base64_encode("template/01/m02.php");
	$menulnk[2]				=	"index.php?pgcnt=".base64_encode("template/01/m03.php");
//
	$arry					=	array();
//下面的数组用于绘制图形	
	$gx						=	array();
	$gy						=	array();
	$gdata					=	array();
	$gsc					=	0;
	$scr_width				=	690;
	$scr_height				=	470; 
	$yway_cnt				=	6;		//纵坐标的刻度个数

/////////////////下面添加的用于按年度访问不同数据库服务器上的数据
	$DB_USER_TY				=	"sdhl";
	$DB_PWD_TY				=	"sdhl2016";
//////////////////////////////2016-12-19添加无效值的定义/////////////////////////////
	define("IGN_VAL",-100.11);	
	$WUXIAO					=	"无效值";
//////////////////////////////2017-8-4添加，土壤监测gis系统//////////////////////////
	$GIS_BAIDU_AK			=	"Wst0GYAGq6QfZG1fGTwNxGLD9CBW5N99";
	$GIS_DIV				=	"<div id='allmap'></div><br><div id='clear_id'></div>";
	$GIS_BEG_SCRIPT			=	"<script type='text/javascript'>";
	$GIS_MAP_MSG1			=	"var map = new BMap.Map('allmap');map.centerAndZoom('%s', 10);map.addControl(new BMap.MapTypeControl());";
	$GIS_MAP_MSG2			=	"map.setCurrentCity('泰安');map.enableScrollWheelZoom(true);";
	$GIS_MAP_MARKER			=	"var marker = new BMap.Marker(new BMap.Point(%s,%s));map.addOverlay(marker);";
	$GIS_TRAIL_BEG			=	"var polyline = new BMap.Polyline([";
	$GIS_TRAIL_MSG			=	"new BMap.Point(%s,%s),";
	$GIS_TRAIL_END			=	"], {strokeColor:'%s', strokeWeight:2, strokeOpacity:0.5});\nmap.addOverlay(polyline);";
	$GIS_END_SCRIPT			=	"</script>";
////////////////////////////////////////////////
	$GIS_CONTENT_IMAGE		=	"var content = \"<div style='margin:0;line-height:20px;padding:2px;'><img src='%s' alt='' style='float:right;zoom:1;overflow:hidden;width:100px;height:100px;margin-left:3px;'/>点位名称：%s<br>点位代码：<font color=red>%s</font><br>经度：<font color=blue>%0.6f</font><br>纬度：<font color=blue>%0.6f</font></div>\";";
	$GIS_CONTENT_OPT		=	"var opts = {width:300,height:110,title:'%s',enableMessage:true};";
	$GIS_CONTENT_FUNCH		=	"function addClickHandler(content,marker){marker.addEventListener('click',function(e){openInfo(content,e)});};";
	$GIS_CONTENT_FUNCL		=	"function openInfo(content,e){var p = e.target;var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);var infoWindow = new BMap.InfoWindow(content,opts);map.openInfoWindow(infoWindow,point);};";
	$GIS_CONTENT_VVV		=	"var marker = new BMap.Marker(new BMap.Point(%0.6f,%0.6f));map.addOverlay(marker);addClickHandler(content,marker);";
	$GIS_HEADER				=	"<center><table width=97%% class='imagetable'><tr><th width=10%% align=center>项目名称</th><th width=40%% align=center>项目数据</th><th width=10%% align=center>项目名称</th><th width=40%% align=center>项目数据</th></tr>";
	$GIS_BODY1				=	"<tr><td width=10%%>%s</td><td width=40%%>%s</td><td width=10%%>%s</td><td width=40%%>%s</td></tr>";
	$GIS_HEADER_END			=	"</table></center>";
	$GIS_V_HEADER			=	"<center><table width=97%% class='imagetable'><tr><th width=40%% align=center>点位名称</th><th width=15%% align=center>监测项目</th><th width=15%% align=center>土地类型</th><th width=10%% align=center>监测值(mg/Kg)</th><th width=10%% align=center>标准值(mg/Kg)</th><th width=10%% align=center>污染程度</th></tr>";
	$GIS_V_BODY1			=	"<tr><td width=40%%>%s</td><td width=15%%>%s</td><td width=15%%>%s</td><td width=10%%>%s</td><td width=10%%>%s</td><td width=10%%>%s</td></tr>";
	$GIS_V_BODY2			=	"<tr><td width=40%%>%s</td><td width=15%%>%s</td><td width=15%%>%s</td><td width=10%%><font color=red>%s</font></td><td width=10%%>%s</td><td width=10%%>%s</td></tr>";
	$GIS_V_END				=	"</table></center>";
?>








