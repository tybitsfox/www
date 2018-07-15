<?php
	$s1=$_SESSION['CURR_USR'][2];
	$s2=strtoupper(substr($s1,1,1));
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
	$st=sprintf($SIG_HTML['RIGHT_TOP1'],"主页");
	echo $st;
	$st=sprintf($SIG_HTML['RIGHT_TOP2'],$err_string);
	echo $st;
	echo "<form action='".$SIGNED_DEF['LINK']."' method='post'><div id='slide1' class='inner' style='display:none;'><div class='orders-empty panel'>";
	$st="<div class='shareblock-headz shareblock-headz-light'><p>%s</p><div class='btn-shareaccount'><label class='check'><input type='checkbox' name='checkx[]' value='%d' class='switch' %s />%s</label></div></div>";
	$j=count($SIGNED_DEF['MODULE']);
	for($i=0;$i<$j;$i++)
	{
		$k=0;
		foreach($cy as $c)
		{
			if($c[1] == $i)
			{$k=1;break;}
		}
		if($k == 1)
			$s2='checked';
		else
			$s2='';
		$s1=sprintf($st,$SIGNED_DEF['MODULE'][$i][1],$i,$s2,$SIGNED_DEF['MODULE'][$i][1]);
		echo $s1;
	}
echo "<div class='shareblock-body'><div class='text-center'><br>
<button type='submit' class='btn btn-primary' id='ch001' name='ch001'>保存选择</button>
</div></div></form></div>";

	echo "</div></div>";
/*	echo $SIG_HTML['RIGHT_TOP_REPB'];
	$j=count($SIGNED_DEF['MODULE']);
	if($j>3)
		$j=3;
	for($i=0;$i<$j;$i++)
	{
		$dy=array();
		$dy=$SIGNED_DEF['MODULE'][$i];
		$sc=$dy[3]."a";
		$st=sprintf($SIG_HTML['RIGHT_TOP_REP'],$sc,$dy[4],$dy[1],$sc);
		echo $st;
	}
	echo $SIG_HTML['RIGHT_TOP_REPE']; */
	echo $SIG_HTML['RIGHT_TOP3'];
?>
