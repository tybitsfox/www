<?php
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
	echo $SIG_HTML['RIGHT_TOP3'];
?>
