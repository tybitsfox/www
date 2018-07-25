<?php
require_once("../lib/db_base.php");
if(isset($_GET['update'])) //更新浏览次数
{
}
else
{
//echo date("Y-m-d H:i:s");
	echo "aid: ".$_POST['aid']."  bid: ".$_POST['bid'];
}
?>
