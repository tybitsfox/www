<?php
$str="hello world,tianyong,shandong，sdfh爱上地方。是地方";
echo $str."<br>";
$ay=array();
$ay=preg_split("/[' ',',','.','，','。']/",$str);
var_dump($ay);
echo "<br><br>";
$str="asdflkjasdf<strong><img src=\"/huili/callback/upload/100000_1533212384.jpg\" width=\"682\" height=\"567\"></strong>asdflkjasdf";
$s1="/<strong>(*)<\/strong>/i";
$s2="ooooooo";
echo "<br><br>";
print preg_replace($s1,$s2,$str);
?>
