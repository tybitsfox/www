<?php
if(session_status() != PHP_SESSION_ACTIVE)
	session_start();
require_once("../lib/db_base.php");
if(isset($_POST['aid']) && isset($_POST['bid']) && isset($_POST['msg']) && isset($_POST['mod']))
{
	if(($_POST['msg'] == "") || ($_POST['msg'] == " ") || ($_POST['msg'] == "  "))
	{}
	elseif(strlen($_POST['msg']) > 255)
	{}
	else
	{
		$ar=array($_POST['aid'],$_POST['bid'],$_POST['mod'],$_POST['msg']);
		$ta=new tb_talkmsg();
		$ta->add_msg($ar);
		if($ta->err_no)
			echo $ta->err_msg();
	}
}
else
	echo "errorororo";
?>
