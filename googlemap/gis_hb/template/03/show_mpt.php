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
$ifile=constant("FULL_PATH")."config/main.php";
require_once($ifile);
$st=constant("FULL_PATH")."include/inter_def.php";
require_once($st);
$st=constant("FULL_PATH")."core/main.php";
require_once($st);
$st=constant("FULL_PATH")."interface/extra01.php";
require_once($st);
	$ay=array();
	global $arry;
	$i=count($arry);
	if(!isset($_SESSION['SEL3']))
		die("No pic");
	for($j=0;$j<$i;$j++)
	{
		$dy=$arry[$j];
		$k=count($dy);
		for($l=0;$l<$k;$l++)
		{
			if($dy[$l][2] == $_SESSION['SEL3'])
			{
				$ay=$dy[$l];
				$j=$i;//end loop
				break;
			}
		}
	}
	$i=count($ay);
	$cy=array();
	for($j=5;$j<$i;$j++)
	{
		array_push($cy,$ay[$j]);
	}
	//print_r($cy);
	unset($ay);
	$ay=json_encode($cy);
?>
<STYLE type=text/css>
/* 图片框样式 */
.imgClass {border: 0px solid #000;}
</STYLE>
<SCRIPT language=JavaScript type=text/javascript>
var imgWidth=200; //图片宽
var imgHeight=266; //图片高
var TimeOut=4000; //每张图切换时间 (单位毫秒);
var imgUrl=new Array();
var adNum=0;
var theTimer=0;
var tt=1;
//document.write('<center><div id="focuseFrom">');
var s="";
var j=0;
//var k=parseInt(pnum);
//document.write(spath+k.toString(10));
imgUrl=eval('<?php echo $ay; ?>');
//alert(imgUrl[0]);
var intPage =0;
for (var i=1;i<=imgUrl.length;i++)
{
	if (imgUrl[i]!="!!!")
	{
		intPage++;
	}
}
function changeimg(n)
{
	adNum=n;
	window.clearInterval(theTimer);
	adNum=adNum-1;
	nextAd();
	return false;
}
//NetScape开始
if (navigator.appName == "Netscape")
{
//	document.write('<style type="text/css">');
//	document.write('.buttonDiv{height:4px;width:21px;}');
//	document.write('</style>');
	function nextAd()
	{
		if(adNum<(intPage-1))
			adNum++;
		else adNum=0;
		theTimer=setTimeout("nextAd()", TimeOut);
		document.images.imgInit.src=imgUrl[adNum];
	}
	document.write('<img src="imgUrl[1]" name="imgInit" border=1  class="imgClass" style="width:250px;cursor:pointer" onclick="javascript:window.open(this.src)">');
//	document.write('</div></center>');
	nextAd();
}
//NetScape结束
//IE开始
else
{
	var count=0;
	for (i=1;i<intPage;i++)
	 {
		if( imgUrl[i]!="" )
		 {
			count++;
		 }
		 else 
		{
			break;
		}
	}
	function playTran()
	{
		if (document.all)
			document.images.imgInit.filters.BlendTrans.play();
	}
	var key=0;
	function nextAd()
	{
		if(adNum<count)
			adNum++ ;
		else
			 adNum=0;
		if( key==0 )
		{
			key=1;
		}
		 else if (document.all)
		{
			document.images.imgInit.filters.BlendTrans.apply();
			playTran();
		}
		document.images.imgInit.src= imgUrl[adNum];
		theTimer=setTimeout("nextAd()", TimeOut);
	}
//	document.write('</div>');
	changeimg(1);
}
//IE结束

</SCRIPT>

