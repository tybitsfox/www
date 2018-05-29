<?php
if(!defined("GLOB_PATH"))
{
	$s1=dirname(__FILE__);
	define("GLOB_PATH",$s1);
}
function upcounter($sname)
{
	$conn=mysqli_connect("localhost","taenv","taenv2014","web_data");
	mysqli_set_charset($conn,"utf8");
	$sqlstr="update link_cnt set count=count+1  where link = '".$sname."'";
	$result=mysqli_query($conn,$sqlstr);
	if(mysqli_affected_rows() == 0)
	{
		$fn=substr(strrchr($sname,'/'),1);
		$sqlstr="insert into link_cnt(link,count,tip) values('".$sname."',1,'".$fn."')";
		mysqli_query($conn,$sqlstr);
	}
	mysqli_close($conn);
}
?>
