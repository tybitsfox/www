<?php
$str="hello world,tianyong,shandong，sdfh爱上地方。是地方";
echo $str."<br>";
$ay=array();
$ay=preg_split("/[' ',',','.','，','。']/",$str);
var_dump($ay);
echo "<br><br>";
$s1="/<img(.*?)src=\'(.*?)\'(.*?)>/i";
$s2="<div>\${0}</div>";
$str="hello<img style='aaa' src='./aaa.jpg'>world!<br>tian<img src='./bbb.jpg'>yong";
echo "<br><br>";
print preg_replace($s1,$s2,$str);
?>
