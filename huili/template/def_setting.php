<?php
		$st1=$_SESSION['CURR_USR'][2];
		$st2=$_SESSION['CURR_USR'][13];
/*	if(preg_match("/^[\x{4e00}-\x{9fa5}]/u",$st1))
	{
		$py=new pinyin();
		$s3=$py->getpy($st1,true);
		$st2=strtoupper(substr($s3,0,1));
	}
	else
		$st2=strtoupper(substr($st1,0,1)); */
	$st=sprintf($SIG_HTML['LEFT_TOP1'],$st2,$st1);
	echo $st;
	echo "<div class='addmerchant'><a class='btn btn-text withfronticon' href='".$SIGNED_DEF['DASHBOARD'][1][0]."'><i class='icon-arrow_left'></i>".$SIGNED_DEF['DASHBOARD'][1][1]."</a></div>";
	echo "<ul class='list-unstyled list-nav'>\n";
$j=count($SIGNED_DEF['PROFILE']);
for($i=0;$i<$j;$i++)
{
	if(($i == 5) && ($_SESSION['CURR_USR'][0] > 100001))
		continue;
	$st=sprintf("<li><a href='%s'>%s<i class='%s'></i></a></li>\n",$SIGNED_DEF['PROFILE'][$i][0],$SIGNED_DEF['PROFILE'][$i][1],$SIGNED_DEF['PROFILE'][$i][2]);
	echo $st;
}
	echo $SIG_HTML['LEFT_TOP3'];
?>
