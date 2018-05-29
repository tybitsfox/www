<?php
//{{{All Rights Reserved By tybitsfox
/*
   这是超标数据的图形显示实现文件
在编写本文件时出现了应该注意的问题：那就是日均值和小时均值的无效数据的表述：首先，如果允许正常值可以为0的话，那么
无效值就不能使用0来表示。所以我采取将无效值设定为一个特殊值：9891.46.这是一个你弄得的数值。虽然正常值也可能会是该值，
但是不管了，只要是等于该值的即视为无效！
无效数据的作用：保证日均值和小时均值记录条数的固定，可以简化查询、绘图等很多操作。缺点：在统计和计算中应记得剔除这些无效值
 	2016-12-21  田勇 alias tybitsfox
 */
//}}}
?>
<?php
//{{{设置运行的环境变量，从session和cookie取得传入的参数
putenv('GDFONTPATH='.realpath('.'));
session_start();
$xd=$_SESSION['fs_g_xway'];
$yd=$_SESSION['fs_g_yway'];
$gd=$_SESSION['fs_g_data'];
$g_type=$_SESSION['gra_tp']; //=0 小时值，=1 日均值，=2 小时超标值，=3 日均超标值。
//global $scr_width,$scr_height;
$i=$_COOKIE['screen'];
if(($i == NULL) || ($i < 100))
	$i=1000;
//}}}
//{{{坐标，长度等基本变量的设置	
$sw=floor($i*0.67);
$sh=500;
//设置坐标原点：
$ox=50;$oy=$sh-40;
$ow=$sw-60;$oh=$sh-80; //x,y轴的长度
//确保包含了全局变量的定义文件
if(!defined("IGN_VAL"))
	define("IGN_VAL",-100.11);	
//}}}
?>
<?php
//{{{图形的初始化
$im = imagecreatetruecolor($sw,$sh);	//创建画布
$red = imagecolorallocate($im, 255, 0, 0); //设置一个颜色变量为红色
$blue = imagecolorallocate($im,0,0,255);//设置蓝色
$w = imagecolorallocate($im,255,255,255); //白色
$black = imagecolorallocate($im,0,0,0); //黑色
$font="YaHei.Consolas.1.11b.ttf";
$style=array($red,$red,$red,$red,$red,$red,$red,$w,$w,$w,$w,$blue,$blue,$blue,$blue,$blue,$blue,$blue,$w,$w,$w,$w);
imagesetstyle($im,$style);
imagefill($im,0,0,$w);
imageline($im,$ox,$oy,$ox,$oy-$oh,$black);
imageline($im,$ox,$oy,$ox+$ow,$oy,$black);
imageline($im,$ox+$ow,$oy,$ox+$ow-10,$oy-5,$black);
imageline($im,$ox,$oy-$oh,$ox-5,$oy-$oh+10,$black);
//}}}
///////////////////////////////////////////////
$i=count($gd);
$s1="记录条数:".$i;
imagettftext($im,10,0,80,20,$red,$font,$s1);
//////////////////////////////////////////////////
//{{{首先画出横坐标和纵坐标的刻度
$i=count($xd);
$l=$ow-10;$m=$ox;$n=$oy;
$a=floor($l/$i);$xstep=$a;
for($j=1;$j<=$i;$j++)
{
	$v1=$m+$j*$a;$v2=$n;
	$v3=$v1;$v4=$v2+5;
	imageline($im,$v1,$v2,$v3,$v4,$black);
	if($g_type == 2)
	{
		if($j%4 == 0)
		{
			$s1=$j."时";
			imagettftext($im,8,0,$v1-8,$v4+15,$red,$font,$s1);
		}
	}
	else //日均值
	{
		if($j%5 == 0)
		{
			$s1=$j."日";
			imagettftext($im,8,0,$v1-8,$v4+15,$red,$font,$s1);
		}
	}
}
//画出纵坐标刻度
$ay=$yd[0];	//取得标准
$by=$yd[1];//取得最大值
$k1=$ay[0];$k2=$by[0];
$k3=$k1*2>$k2?$k1*2:$k2;
$c1=$ay[1];$c2=$by[1];
$c3=$c1*2>$c2?$c1*2:$c2;
$l=$oh-20;
$a=floor($l/10);$ystep=$a;
for($i=1;$i<=10;$i++)
{
	$v1=$m-5;$v2=$n-$a*$i;
	$v3=$m;$v4=$v2;
	imageline($im,$v1,$v2,$v3,$v4,$black);
	if($i==5)
	{
		imageline($im,$v3,$v4,$sw-10,$v4,IMG_COLOR_STYLED);
		$s1=$k1;
		imagettftext($im,8,0,$v3-45,$v4+10,$red,$font,$s1);
		$s2=$c1;
		imagettftext($im,8,0,$v3-45,$v4-2,$blue,$font,$s2);

	}
	if($i==10)
	{
		$s1=sprintf("%0.2f",$k3);
		imagettftext($im,8,0,$v3-45,$v4+10,$red,$font,$s1);
		$s2=sprintf("%0.2f",$c3);
		imagettftext($im,8,0,$v3-45,$v4-2,$blue,$font,$s2);
	}
}//}}}
/////////////////////////////////////////////////////
$i=count($xd);		//确定是小时值还是日均值 =24为小时值
$std=$ystep*5;		//标准的长度
$stdv=$yd[0];$maxv=$yd[1]; //取得标准值和最大值
$k=count($stdv);	//确定是废水，污水厂还是废气。=2为水，=3为气
$j=count($gd);		//超标记录的条数
unset($ay);unset($by);
$ay=array();
if($k == 2) //废水或污水厂
{
	for($l=0;$l<$j;$l++)
	{	
		$by=array();
		$ey=$gd[$l];
		$str=$ey[2];//取得日期
		if($g_type == 2)
			$tm1=substr($str,11,2); //取得小时数
		else
			$tm1=substr($str,8,2);	//取得天数
		$mx=$maxv[0]>($stdv[0]*2)?$maxv[0]:($stdv[0]*2);
		if($ey[0] > $stdv[0]) //cod
			$m=$std+floor($std*($ey[0]-$stdv[0])/($mx-$stdv[0]));
		else
			$m=floor($std*$ey[0]/$stdv[0]);
		$by[0]=$ox+$tm1*$xstep;$by[1]=$oy-$m;
		$by[2]=$by[0]+floor($xstep/2);$by[3]=$oy;
		array_push($ay,$by);
		$mx=$maxv[1]>($stdv[1]*2)?$maxv[1]:($stdv[1]*2);
		if($ey[1] > $stdv[1]) //nhx
			$m=$std+floor($std*($ey[1]-$stdv[1])/($mx-$stdv[1]));
		else
			$m=floor($std*$ey[1]/$stdv[1]);
		$by=array();
		$by[0]=$ox+$tm1*$xstep+floor($xstep/2);$by[1]=$oy-$m;
		$by[2]=$by[0]+floor($xstep/2);$by[3]=$oy;
		array_push($ay,$by);
	}
}
else //废气
{
	for($l=0;$l<$j;$l++)
	{
		$by=array();
		$ey=$gd[$l];
		$str=$ey[3];//取得日期
		if($g_type == 2)
			$tm1=substr($str,11,2); //取得小时数
		else
			$tm1=substr($str,8,2);	//取得天数
		if($ey[0] == constant('IGN_VAL')) //so2
		{//无效值不画
			$by[0]=0;$by[1]=0;$by[2]=1;$by[3]=1;
		}
		else
		{
			$mx=$maxv[0]>($stdv[0]*2)?$maxv[0]:($stdv[0]*2);
			if($ey[0] > $stdv[0]) //so2
				$m=$std+floor($std*($ey[0]-$stdv[0])/($mx-$stdv[0]));
			else
				$m=floor($std*$ey[0]/$stdv[0]);
			$by[0]=$ox+$tm1*$xstep;$by[1]=$oy-$m;
			$by[2]=$by[0]+floor($xstep/3);$by[3]=$oy;
		}
		array_push($ay,$by);
		$by=array();
		if($ey[1] == constant('IGN_VAL')) //nox
		{//无效值不画
			$by[0]=0;$by[1]=0;$by[2]=1;$by[3]=1;
		}
		else
		{
			$mx=$maxv[1]>($stdv[1]*2)?$maxv[1]:($stdv[1]*2);
			if($ey[1] > $stdv[1]) 
				$m=$std+floor($std*($ey[1]-$stdv[1])/($mx-$stdv[1]));
			else
				$m=floor($std*$ey[1]/$stdv[1]);
			$by[0]=$ox+$tm1*$xstep+floor($xstep/3);$by[1]=$oy-$m;
			$by[2]=$by[0]+floor($xstep/3);$by[3]=$oy;
		}
		array_push($ay,$by);
		$by=array();
		if($ey[2] == constant('IGN_VAL')) //dust
		{//无效值不画
			$by[0]=0;$by[1]=0;$by[2]=1;$by[3]=1;
		}
		else
		{
			$mx=$maxv[2]>($stdv[2]*2)?$maxv[2]:($stdv[2]*2);
			if($ey[2] > $stdv[2]) //dust
				$m=$std+floor($std*($ey[2]-$stdv[2])/($mx-$stdv[2]));
			else
				$m=floor($std*$ey[2]/$stdv[2]);
			$by[0]=$ox+$tm1*$xstep+floor($xstep*2/3);$by[1]=$oy-$m;
			$by[2]=$by[0]+floor($xstep/3);$by[3]=$oy;
		}
		array_push($ay,$by);
		$by=array();
	}
}
$k=count($stdv);
$col[0]=$red;$col[1]=$blue;$col[2]=$black;
$l=0;
for($j=0;$j<$i;$j++)
{
	$x1=$ay[$j][0];$y1=$ay[$j][1];
	$x2=$ay[$j][2];$y2=$ay[$j][3];
	imagefilledrectangle($im,$x1,$y1,$x2,$y2,$col[$l]);
	if($l >= ($k-1))
		$l=0;
	else
		$l++;
}
if($k == 2)
{
	$s1="红色曲线：COD";
	imagettftext($im,10,0,$sw-200,20,$red,$font,$s1);
	$s2="蓝色曲线：氨氮";
	imagettftext($im,10,0,$sw-200,40,$blue,$font,$s2);
}
else
{
	$s1="红色曲线：SO2";
	imagettftext($im,10,0,$sw-200,20,$red,$font,$s1);
	$s2="蓝色曲线：氮氧化物";
	imagettftext($im,10,0,$sw-200,40,$blue,$font,$s2);
	$s1="黑色曲线：烟尘";
	imagettftext($im,10,0,$sw-200,60,$black,$font,$s1);
}
header('Content-type:image/png'); //通知浏览器这不是文本而是一个图片
imagepng($im);
imagedestroy($im);
?>
