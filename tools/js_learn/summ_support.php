<?php
        $name = randomString();
        $ext = explode('.',$_FILES['file']['name']);
        $filename = $name.'.'.$ext[1];
        $destination = '/var/www/tools/js_learn/upload/'.$filename;
        $location =  $_FILES["file"]["tmp_name"];
        move_uploaded_file($location,$destination);
        echo 'http://localhost/tools/js_learn/upload/'.$filename;
function randomString() {
    return md5(rand(100, 200));
}
?>
