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
echo "<div id='left_id' class='shadow_class'>";
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
$str=constant("FULL_PATH")."template/02/l02.php";
require_once($str);
echo "</div><div id='right_id'><div id='clear_id'></div><div id='right_top_aid' class='shadow_class'>";
$a=new gis_mx_pic();
$a->show_header();
//<!--	<img src='./images/aaa.jpg' style='display:block;width:200px;'/> -->
?>
<?php
echo "</div></div><div id='left_idb' class='shadow_class'>";
require_once("template/03/show_mpt.php");
echo "</div></div><div id='clear_id'></div><div id='container_id'>";
require_once("template/03/foot.php");
echo "</div></body></html>";
?>	

