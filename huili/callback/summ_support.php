<?php
        $name = randomString($_POST['val']);
        $ext = explode('.',$_FILES['file']['name']);
        $filename = $name.'.'.$ext[1];
        $destination = '/var/www/huili/callback/upload/'.$filename;
        $location =  $_FILES["file"]["tmp_name"];
        move_uploaded_file($location,$destination);
        echo '/huili/callback/upload/'.$filename;
function randomString($s) {
	$i=time();
	$st=sprintf("%s_%d",$s,$i);
	return $st;
//    return md5(rand(100, 200));
}
?>
