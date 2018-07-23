<?php
//除设置外所有界面的导航栏设置均由文本见负责
	$s1=$_SESSION['CURR_USR'][2];
	$s2=$_SESSION['CURR_USR'][13];
/*	if(preg_match("/^[\x{4e00}-\x{9fa5}]/u",$s1))
	{
		$py=new pinyin();
		$s3=$py->getpy($s1,true);
		$s2=strtoupper(substr($s3,0,1));
	}
	else
		$s2=strtoupper(substr($s1,0,1));*/
	$st=sprintf($SIG_HTML['LEFT_TOP1'],$s2,$s1);
	echo $st;
	echo $SIG_HTML['LEFT_TOP2'];
	$j=count($cy);
	for($i=0;$i<$j;$i++)
	{
		$dy=array();
		$dy=$cy[$i];
		$st=sprintf($SIG_HTML['LEFT_REP'],$dy[2],$dy[4],$dy[5],$dy[3],$dy[6]);
		echo $st;
	}
	echo $SIG_HTML['LEFT_TOP3'];
?>
