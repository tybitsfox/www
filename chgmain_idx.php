<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
if($_GET['usersel']=="new")
{
	setcookie("chose","new",time()+36000*24);
	echo "<script>window.location.href='./index.php'</script>";
}
else
{
	setcookie("chose","old",time()+36000*24);
	echo "<script>window.location.href='./index_bak.php'</script>";
}
?>
