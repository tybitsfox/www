<?php
		$st1=$_SESSION['CURR_USR'][2];
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
		$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li><a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>设置</a></li><li>个人信息";
		$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
		echo $st1;
		echo "<div class='inner' id='modal_container' >\n<h2 class='sect first'>设置 / 个人信息</h2>\n<!-- Panel -->\n<div class='block'>\n<div class='panel shadow'>\n<div class='body body-settings'>\n<div class='inner-narrow'>\n<div class='intro-block'>\n<h3>您的个人信息设置</h3>\n</div>\n<form class='form form-horizontal form-boxed' method='post' action='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>\n";
		$st1="<div class='form-group'>\n<label>更新您的昵称</label>\n<div class='form-split'>\n<input name='nickname' id='nickname' class='form-control inlined' value='%s' required/>\n<button type='submit' class='btn btn-primary'>更新</button>\n</div>\n</div>\n</form>\n";
if(isset($_POST['nickname']))
{
	$ay=array(0,$_POST['nickname']);//0:uname,1:password,2:email
	$ta=new tb_auth();
	$i=$ta->edit($ay);
	if($i == 0)
	{
		echo "<div class='alert alert-success alert-inline' role='alert'>\n昵称已经更新</div>\n";
		$_SESSION['CURR_USR'][2]=$ay[1];
	}
	else
		echo "<div class='alert alert-danger alert-inline' role='alert'>\n昵称更新失败 errno=".$i."</div>\n";
	$st2=sprintf($st1,$ay[1]);
	echo $st2;
	unset($ay);
}
else
{
	$st2=sprintf($st1,"");
	echo $st2;
}
	echo"<form class='form form-horizontal form-boxed' method='post' action='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>\n";
	$st1="<div class='form-group'>\n<label>更新您的邮箱</label>\n<div class='form-split'>\n<input type='email' name='email' id='email' class='form-control inlined'  value='%s' required/>\n<input type='submit' class='btn btn-primary' value='更新邮箱' />\n</div>\n</div>\n</form>\n</div>\n</div>\n</div>\n</div>\n</div>";
if(isset($_POST['email']))
{
	$ay=array(2,$_POST['email']);//0:uname,1:password,2:email
	$ta=new tb_auth();
	$i=$ta->edit($ay);
	if($i == 0)
		echo "<div class='alert alert-success alert-inline' role='alert'>\n邮箱已经更新</div>\n";
	else
		echo "<div class='alert alert-danger alert-inline' role='alert'>\n邮箱更新失败</div>\n";
	$st2=sprintf($st1,$ay[1]);
	echo $st2;
	unset($ay);
}
else
{
	$st2=sprintf($st1,"");
	echo $st2;
}
		echo $SIG_HTML['RIGHT_TOP3'];
?>
