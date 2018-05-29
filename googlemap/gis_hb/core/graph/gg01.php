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
//{{{基本变量的设定，这里的做法是默认图片大小为1024×768
//宽度可以加长,显示时按比例缩放。这样做的好处是不需要考虑用户的分辨率以适应图形显示，也就不需要cookie了
putenv('GDFONTPATH='.realpath('.'));
session_start();
$ay=$_SESSION['GRA_P1'];
$i=count($ay);
$k=0;
for($j=0;$j<$i;$j++)
	$k+=count($ay[$j]);
$w=1024;$h=$k*22+140; //定义图片的高度和宽度
$eh=22;//定义每行的高度,px
$wt=224;//定义点位名称显示的长度
$wx=800;//1024-224,x轴的最大长度
//x轴定义监测值，标准值定义为x轴长的3/4.y轴定义点位,横条状图形。
$wst=60;//px,x轴的刻度大小，单位是标准值的1/10.
$im = imagecreatetruecolor($w,$h);	//创建画布
$red = imagecolorallocate($im, 255, 0, 0); //设置一个颜色变量为红色
$blue = imagecolorallocate($im,0,0,255);//设置蓝色
$white = imagecolorallocate($im,255,255,255); //白色
$black = imagecolorallocate($im,0,0,0); //黑色
$font="YaHei.Consolas.1.11b.ttf";
imagefill($im,0,0,$white);
//}}}
?>
<?php
//{{{画图
$i=count($ay);$oy=0;
for($j=0;$j<$i;$j++)
{
	//条状图的长度在标准值以内按比例显示，超标值，超标部分按比例显示
	//比例的设定为：(1-(最大超标值-当前超标值)/最大超标值)*200
	$vstd=floatval($ay[0][9]); //保存标准值
	$maxval=$vstd; //保存最大超标值
	$cy=$ay[$j];
	$k=count($cy);
	for($l=0;$l<$k;$l++)
	{
		if(floatval($cy[$l][3] > $maxval))
			$maxval=floatval($cy[$l][3]);
	}
	$oym=$oy;
	$ox=$wt;$oy+=$k*22+60;
	imageline($im,$ox,$oy,$ox,$oym+60,$black);
	imageline($im,$ox,$oy,$ox+$wx-24,$oy,$black);
	$str=sprintf("%d年度%s%s土壤点位%s含量柱状图",$_SESSION['SEL_2'],$_SESSION['SEL_1'],$cy[0][8],$_SESSION['SEL_3']);
	imagettftext($im,12,0,$ox+154,$oym+30,$blue,$font,$str);
	$v1=16;$v2=$oy;
	for($l=0;$l<$k;$l++)
	{
		$v2=$oy-$l*22-4;
		$str=$cy[$l][1];
		imagettftext($im,10,0,$v1,$v2,$black,$font,$str);
		$v3=$ox;$v4=$oy-($l+1)*22;
		$v6=$v4+22;
		if($cy[$l][3] >= $cy[$l][9]) //超标
		{
			$cb=floatval((floatval($cy[$l][3])-floatval($cy[$l][9]))/floatval($cy[3][9]));
			if($cb < 0.25)
				$v5=$ox+600+floor($cb)*200;
			else
				//$v5=$ox+600+floor((1-$cb)*200);
				$v5=$ox+800;
			imagefilledrectangle($im,$v3,$v4,$v5,$v6,$red);
		}
		else
		{
			$v5=$ox+floor((600*floatval($cy[$l][3]))/floatval($cy[$l][9]));
			imagefilledrectangle($im,$v3,$v4,$v5,$v6,$blue);
		}
	}
	//画个标准值的刻度
	imageline($im,$ox+600,$oy,$ox+600,$oy-5,$red);
}
header('Content-type:image/png'); //通知浏览器这不是文本而是一个图片
imagepng($im);
imagedestroy($im);
//ob_flush();
//flush();
//}}}
?>

