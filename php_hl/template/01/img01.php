<?php
$im = imagecreatetruecolor(100, 100); //创建100*100大小的画布
$red = imagecolorallocate($im, 255, 0, 0); //设置一个颜色变量为红色
 
imagefill($im, 0, 0, $red); //将背景设为红色
 
header('Content-type:image/png'); //通知浏览器这不是文本而是一个图片
imagepng($im); //生成PNG格式的图片输出给浏览器
 
imagedestroy($im); //销毁图像资源，释放画布占用的内存空间
?>

