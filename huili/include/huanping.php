<?php
if(!defined("HOME_CALLED"))
	die("access denied!");
//进入到本文件之前div+1
$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li>环评咨询";
$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);				//section+1;div+1
echo $st1;
echo"<div class='inner' id='modal_container' ><div class='block'><div class='panel shadow'><ul class='nav nav-tabs nav-tabs-hor' role='tablist'>";
$st1="<li role='presentation' class='%s'><a href='%s' aria-controls='share' role='tab' data-toggle='tab'>%s</a></li>";
$st2=sprintf($st1,'active','#huanpin','项目展示');
echo $st2;
$st2=sprintf($st1,'','#gethelp','寻求帮助');
echo $st2;
echo"</ul><div class='body'><div class='body body-settings'><div class='tab-content'>";
echo"</div></div></div>";
echo"</div></div></div>";
echo $SIG_HTML['RIGHT_TOP3'];  //div-1;section-1;div-1;
?>
