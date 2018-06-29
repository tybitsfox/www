<?php
$act=array("active","","");
if(isset($_GET['index']))
{
	if($_GET['index'] == 1)
	{
		$ta=new used_sign();
		$i=$ta->update_auth();
		if($i == 0)
		{
			$_SESSION['CURR_USR'][11]=date("Y-m-d H:i:s",$_SESSION['USR_AGENT'][1]);
			$_SESSION['CURR_USR'][8]+=1;
			$_SESSION['USR_AGENT'][2]=0;//已经签到
		}
	}
	elseif($_GET['index'] == 2)
	{
		$act=array("","active","");
	}
	else
	{
		$act=array("","","active");
	}
}
?>

<?php
//{{{ fixed!
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
		$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li><a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>设置</a></li><li>管理";
		$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
		echo $st1;
		echo "<div class='inner' id='modal_container' >\n<h2 class='sect first'>设置 / 管理</h2>\n
		<div class='block'>
			<div class='panel shadow'>
				<!-- Nav tabs -->
				<ul class='nav nav-tabs nav-tabs-hor' role='tablist'>";
                 $st1="<li role='presentation' class='%s'><a href='#share' aria-controls='share' role='tab' data-toggle='tab' data-history-enabled>账户信息</a></li>
                       <li role='presentation' class='%s'><a href='#shared1' aria-controls='sharedwith' role='tab' data-toggle='tab' data-history-enabled>修改昵称</a></li>
                       <li role='presentation' class='%s'><a href='#shared2' aria-controls='sharedwith' role='tab' data-toggle='tab' data-history-enabled>修改密码</a></li>";
				$st2=sprintf($st1,$act[0],$act[1],$act[2]);
				echo $st2;
           echo"</ul>
                <div class='body'>                
                    <div class='body body-settings'>
                        <div class='tab-content'>";
//}}}
?>
<?php
//{{{	Tab	1	账户信息	
		$st1="			<!-- Tab 1 -->
                                <div role='tabpanel' class='tab-pane %s' id='share'>
                                    <div class='inner-narrow inner-midnarrow'>
    									<div class='intro-block intro-block-slim'>
		<ul class='list-unstyled list-accounts'>
                <li>
                  <div class='vendor-info'>
                    <div class='vendor'>
                      <i class='icon-shield'></i>
                    </div>
                  </div>
                  <div class='account-info'>
                    <p class='title'>等级</p>
                  </div>
                  <div class='account-info'>
                    <p class='title'>%d</p>
                  </div>
                </li>
                <li>
                  <div class='vendor-info'>
                    <div class='vendor'>
                      <i class='icon-airplane'></i>
                    </div>
                  </div>
                  <div class='account-info'>
                    <p class='title'>财富值</p>
                  </div>
                  <div class='account-info'>
                    <p class='title'>%d</p>
                  </div>
                </li>
				<li>
                  <div class='vendor-info'>
                    <div class='vendor'>
                      <i class='icon-pagelines'></i>
                    </div>
                  </div>
                  <div class='account-info'>
                    <p class='title'>汇氏币</p>
                  </div>
                  <div class='account-info'>
                    <p class='title'>%d</p>
                  </div>
				</li>
				<li>
                  <div class='vendor-info'>
                    <div class='vendor'>
                      <i class='icon-user'></i>
                    </div>
                  </div>";
		$st2=sprintf($st1,$act[0],$_SESSION['CURR_USR'][5],$_SESSION['CURR_USR'][9],$_SESSION['CURR_USR'][8]);
		echo $st2;
			$st1="<div class='account-action'>
                   	  <a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN']."&index=1' class='btn %s btn-outline withlasticon'>%s<i class='icon-pencil'></i></a>
                  	</div></li></ul></div></div></div>";
				  if($_SESSION['USR_AGENT'][2] == 0)
				  		$st2=sprintf($st1,"disabled","签到完成");
				  else
			  			$st2=sprintf($st1,"","签到");	  
		echo $st2;
//}}}
//{{{	Tab 2	修改昵称
		$st1="				<!-- Tab 2 -->
                                <div role='tabpanel' class='tab-pane %s' id='shared1'>
                                    <div class='inner-narrow inner-midnarrow'>
    									<div class='intro-block intro-block-slim'>
									        <p>更改昵称或邮箱</p><div class='inner-narrow'>
											<form class='form form-horizontal form-boxed' method='post' action='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN']."&index=2'>";
		$st2=sprintf($st1,$act[1]);
		echo $st2;
		$st1="<div class='form-group'>\n<label>  </label>\n<div class='form-split'>\n<input name='nickname' id='nickname' placeholder='输入新昵称' class='form-control inlined' value='%s' required/>\n<button type='submit' class='btn btn-primary'>更新昵称</button>\n</div>\n</div>\n</form></div>\n";
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
	echo "<div class='inner-narrow'><form class='form form-horizontal form-boxed' method='post' action='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN']."&index=2'>\n";
	$st1="<div class='form-group'>\n<label> </label>\n<div class='form-split'>\n<input type='email' name='email' id='email' placeholder='请输入新邮箱' class='form-control inlined'  value='%s' required/>\n<input type='submit' class='btn btn-primary' value='更新邮箱' />\n</div>\n</div>\n</form>\n</div>\n</div>\n</div>\n</div>";
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
//}}}
//{{{ Tab 3	修改密码
		$st1="				<!-- Tab 3 -->
                                <div role='tabpanel' class='tab-pane %s' id='shared2'>
                                    <div class='inner-narrow inner-midnarrow'>
    									<div class='intro-block intro-block-slim'>
									        <p>更新密码</p><form class='form form-horizontal' method='post' action='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN']."&index=3'>";
					$st2=sprintf($st1,$act[2]);
					echo $st2;
		$st1="<div class='form-group'>\n<br>
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
         <!--   <div class='foot'>\n  -->
              <div class='inner-narrow'>\n
                <div class='panel-action'>\n
                  <div class='row'>\n
                    <div class='col-sm-9  pull-xs-right pull-right text-right text-xs-right'>\n
                      <button type='submit' href='#' class='btn btn-primary'>密码更新</button>\n
                    </div>\n
                  </div>\n
                </div>\n
              </div>\n
<!--            </div>\n -->
          </form></div></div></div>\n";
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

//}}}
		echo "</div></div></div></div>";
		echo $SIG_HTML['RIGHT_TOP3'];
?>
