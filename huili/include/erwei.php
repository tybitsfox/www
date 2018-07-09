<?php
//http://phpqrcode.sourceforge.net/
include("./phpqrcode.php");
$QR=QRcode::png("http://tybitsfox.6600.org:8008/huili/index.php",false,"H",6,2);
$logo=imagecreatefrompng("../images/logo/mmexport1.png");
$QR_width = imagesx($QR);      //二维码图片宽度
$QR_height = imagesy($QR);     //二维码图片高度
$logo_width = imagesx($logo);    //logo图片宽度
$logo_height = imagesy($logo);   //logo图片高度
$logo_qr_width = $QR_width / 3;   //组合之后logo的宽度(占二维码的1/5)
$scale = $logo_width/$logo_qr_width;  //logo的宽度缩放比(本身宽度/组合后的宽度)
$logo_qr_height = $logo_height/$scale; //组合之后logo的高度
$from_width = ($QR_width - $logo_qr_width) / 2; 
imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,$logo_qr_height, $logo_width, $logo_height);
Header("Content-type: image/png");
imagepng($QR);
imagedestroy($QR);
imagedestroy($logo);
?>
