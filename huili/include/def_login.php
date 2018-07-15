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
	echo "</div><div id='slide1' class='inner' style='display:none;'><div class='orders-empty panel'>
<div class='shareblock-headz shareblock-headz-light'><p>污水处理专业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkn[]' value='1' class='switch' />污水处理</label></div></div>
<div class='shareblock-headz shareblock-headz-light'><p>废气治理专业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkn[]' value='2' class='switch' />废气治理</label></div></div>
<div class='shareblock-headz shareblock-headz-light'><p>噪音治理专业</p><div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='checkn[]' value='4' class='switch' />噪音治理</label></div></div>
		
		</div></div>";
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
