<?php
$a1=array(0,1);$a2=array('a','b','c');
$ay=array();
array_push($ay,$a1);
array_push($ay,$a2);
echo "origin: ";
var_dump($ay);
echo "<br><br>";
$bc=array();
$bc=array_pop($ay);
echo "after pop: ";
var_dump($bc);
?>
