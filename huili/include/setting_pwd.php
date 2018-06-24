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
	if(($i == 7) && ($_SESSION['CURR_USR'][0] > 100001))
		continue;
	$st=sprintf("<li><a href='%s'>%s<i class='%s'></i></a></li>\n",$SIGNED_DEF['PROFILE'][$i][0],$SIGNED_DEF['PROFILE'][$i][1],$SIGNED_DEF['PROFILE'][$i][2]);
	echo $st;
}
		echo $SIG_HTML['LEFT_TOP3'];
		$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li><a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>设置</a></li><li>密码";
		$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
		echo $st1;
		echo "<div class='inner' id='modal_container' >\n<h2 class='sect first'>设置 / 密码</h2>\n<!-- Panel -->\n<div class='block'>\n<div class='panel shadow'>\n<div class='body body-settings'>\n<div class='inner-narrow'>\n<div class='intro-block'>\n<h3>更新密码</h3>\n</div>\n<form class='form form-horizontal' method='post' action='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['TWO']."'>\n";
		$st1="<div class='form-group'>\n
              <label class='col-sm-4 control-label'>输入原密码</label>\n
              <div class='col-sm-8'>\n
                <input type='password' name='curpwd' id='curpwd' class='form-control' placeholder='原密码' required />\n
              </div>\n
            </div>\n
            <div class='form-group form-delimited'>\n
              <label class='col-sm-4 control-label'>输入新密码</label>\n
              <div class='col-sm-8'>\n
                <input type='password' name='newpwd' id='newpwd'  class='form-control' placeholder='新密码' required autocomplete='off' pattern='(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*()+=?_-])(?=.*[0-9]).{8,32}' title='密码必须包含大小写字母、数字以及特殊符号例如：(!@$&*)' required/>\n
              </div>\n
            </div>\n
            <div class='form-group'>\n
              <label class='col-sm-4 control-label'>确认新密码</label>\n
              <div class='col-sm-8'>\n
                <input type='password' name='cfmpwd' id='cfmpwd' class='form-control' placeholder='确认新密码' required/>\n
              </div>\n
            </div>\n
            <div class='foot'>\n
              <div class='inner-narrow'>\n
                <div class='panel-action'>\n
                  <div class='row'>\n
                    <div class='col-sm-9  pull-xs-right pull-right text-right text-xs-right'>\n
                      <button type='submit' href='#' class='btn btn-primary'>密码更新</button>\n
                    </div>\n
                  </div>\n
                </div>\n
              </div>\n
            </div>\n
          </form></div></div></div></div>\n";
if(isset($_POST['curpwd']) || isset($_POST['newpwd']) || isset($_POST['cfmpwd']))
{//first check
	if(md5($_POST['curpwd']) != $_SESSION['CURR_USR'][3])
	{
		echo "<div class='alert alert-danger alert-inline' role='alert'>\n密码错误！请重新输入</div>\n";
	}
	else
	{
		if($_POST['newpwd'] != $_POST['cgmpwd'])
		{
			echo "<div class='alert alert-danger alert-inline' role='alert'>\n两次密码不一致，请重新输入</div>\n";
		}
		else
		{
			$ay=array(1,$_POST['cfmpwd']);//0:uname,1:password,2:email
			$ta=new tb_auth();
			$i=$ta->edit($ay);
			if($i == 0)
			{
				echo "<div class='alert alert-success alert-inline' role='alert'>\n密码已经更新</div>\n";
				$_SESSION['CURR_USR'][3]=$ay[1];
			}
			else
				echo "<div class='alert alert-danger alert-inline' role='alert'>\n密码更新失败 errno=".$i."</div>\n";
			unset($ay);
		}
	}
}
	echo $st1;
	echo $SIG_HTML['RIGHT_TOP3'];
?>
