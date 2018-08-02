<?php
$str="hello world,tianyong,shandong，sdfh爱上地方。是地方";
echo $str."<br>";
$ay=array();
$ay=preg_split("/[' ',',','.','，','。']/",$str);
var_dump($ay);
?>
