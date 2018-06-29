<?php
//{{{ save
/*		$st1=$_SESSION['CURR_USR'][2];
		$st2=strtoupper(substr($st1,1,1));
		$st=sprintf($SIG_HTML['LEFT_TOP1'],$st2,$st1);
		echo $st;
		echo "<div class='addmerchant'><a class='btn btn-text withfronticon' href='".$SIGNED_DEF['DASHBOARD'][1][0]."'><i class='icon-arrow_left'></i>".$SIGNED_DEF['DASHBOARD'][1][1]."</a></div>";
		echo "<ul class='list-unstyled list-nav'>\n";
$j=count($SIGNED_DEF['PROFILE']);
for($i=0;$i<$j;$i++)
{
	$st=sprintf("<li><a href='%s'>%s<i class='%s'></i></a></li>\n",$SIGNED_DEF['PROFILE'][$i][0],$SIGNED_DEF['PROFILE'][$i][1],$SIGNED_DEF['PROFILE'][$i][2]);
	echo $st;
}
		echo $SIG_HTML['LEFT_TOP3'];
		$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li><a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>设置</a></li><li>管理";
		$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
		echo $st1;
		echo "<div class='inner' id='modal_container' >\n<h2 class='sect first'>设置 / 管理</h2>\n<!-- Panel -->\n<div class='block'>\n<div class='panel shadow'>\n<div class='body body-settings'>\n<div class='inner-narrow'>\n<div class='intro-block'>\n<h3>临时：测试用界面</h3>\n</div>\n<form class='form form-horizontal' method='post' action='#'>\n";
		$st1="<div class='form-group'>\n
              <label class='col-sm-4 control-label'>%s：</label>\n
			  <label class='col-sm-8'><br>%s</label>\n
            </div>\n
            <div class='form-group'>\n
              <label class='col-sm-4 control-label'>%s：</label>\n
			  <label class='col-sm-8'><br>%s</label>\n
            </div>\n
            <div class='form-group'>\n
              <label class='col-sm-4 control-label'>%s：</label>\n
			  <label class='col-sm-8'><br>%s</label>\n
            </div>\n
          </form></div></div></div></div>\n";
//{{{测试客户端信息
		$ar=array("当前系统","浏览器","客户IP");
    	$st3=$_SERVER['HTTP_USER_AGENT'];
		$sta=array();
		$sta=explode("; ",$st3);
		$i=count($sta);
		if($i <= 3)	//andriod5.1之前好像参数更多
   			$st4=$sta[1];
		else
			$st4=$sta[2];
		$st3=$sta[count($sta)-1];
		$sta=explode(" ",$st3);
		$st3=$sta[count($sta)-1];
		$st2=sprintf($st1,$ar[0],$st4,$ar[1],$st3,$ar[2],$_SERVER['REMOTE_ADDR']);
//}}}		 
	echo $st2;
	echo $SIG_HTML['RIGHT_TOP3']; */
//}}}
?>

