<?php
$uploadm="<span id='vvvv' class='light1'>请选择适合做头像的图片</span>";
$act=array("active","","");
//{{{
if(isset($_GET['index']))
{
	if($_GET['index'] == 1)
	{
		$ta=new used_sign();
		$ta->update_auth();
		if($ta->err_no == 0)
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
	elseif($_GET['index'] == 3)
	{
		$act=array("","","active");
	}
	else //=4上传图片
	{
		if(isset($_FILES['filez']['tmp_name']))
		{
			$sname=constant('WORK_PLACE')."images/upload/".$_FILES['filez']['name'];
			$siz=intval($_FILES['filez']['size']);
			if(move_uploaded_file($_FILES['filez']['tmp_name'],"../images/upload/".$_FILES['filez']['name']))
			{
				if(strlen($sname) >= 255)
					$uploadm="<span id='vvvv' class='light3'>图片上传错误文件名太长</span>";
				elseif($siz > 1024*80)
					$uploadm="<span id='vvvv' class='light3'>图片太大，不能超过80k</span>";
				else
				{
					$ta=new login();
					$ay=array(3,$sname);
					$ta->edit($ay);
					if($ta->err_no)
					{
						unlink("../images/upload/".$_FILES['filez']['name']);
						$uploadm="<span id='vvvv' class='light3'>头像保存错误请稍后再试</span>";
					}
					else
					{
						$_SESSION['CURR_USR'][12]=$sname;
						$uploadm="<span id='vvvv' class='light2'>一一图片上传成功！一一</span>";
					}
				}
			}
			else
				$uploadm="<span id='vvvv' class='light3'>图片上传错误稍后再试！</span>";
			$ay=array(3,$sname);
		}
		else
		{$uploadm="<span id='vvvv' class='light3'>图片上传错误请稍后再试</span>";}
		$act=array("","active","");
	}
}
//}}}
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
	if(($i == 5) && ($_SESSION['CURR_USR'][0] > 100001))
		continue;
	$st=sprintf("<li><a href='%s'>%s<i class='%s'></i></a></li>\n",$SIGNED_DEF['PROFILE'][$i][0],$SIGNED_DEF['PROFILE'][$i][1],$SIGNED_DEF['PROFILE'][$i][2]);
	echo $st;
}
		echo $SIG_HTML['LEFT_TOP3'];
		$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li><a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>设置</a></li><li>".$SIGNED_DEF['PROFILE'][0][1];
		$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
		echo $st1;
		echo "<div class='inner' id='modal_container' >\n<h2 class='sect first'>设置 / ".$SIGNED_DEF['PROFILE'][0][1]."</h2>\n
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
                      <div class='avatar'>
                        <div class='circle'>
                          <img src='".$_SESSION['CURR_USR'][12]."' alt='汇氏'/>
                        </div>
                      </div>";
		$st2=sprintf($st1,$act[0],$_SESSION['CURR_USR'][5],$_SESSION['CURR_USR'][9],$_SESSION['CURR_USR'][8]);
		echo $st2;
			$st1="<div class='account-action'>
                   	  <a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."&index=1' class='btn %s btn-outline withlasticon'>%s<i class='icon-pencil'></i></a>
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
											<form class='form form-horizontal form-boxed' method='post' action='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."&index=2'>";
		$st2=sprintf($st1,$act[1]);
		echo $st2;
		$st1="<div class='form-group'>\n<label>  </label>\n<div class='form-split'>\n<input name='nickname' id='nickname' placeholder='输入新昵称' class='form-control inlined' value='%s' required/>\n<button type='submit' class='btn btn-primary inlined'>更新昵称</button>\n</div>\n</div>\n</form></div>\n";
if(isset($_POST['nickname']))
{
	$ay=array(0,$_POST['nickname']);//0:uname,1:password,2:email
	$ta=new login();
	$ta->edit($ay);
	if($ta->err_no == 0)
	{
		echo "<div class='alert alert-success alert-inline' role='alert'>\n昵称已经更新</div>\n";
		$_SESSION['CURR_USR'][2]=$ay[1];
	}
	else
		echo "<div class='alert alert-danger alert-inline' role='alert'>\n".$ta->err_msg()."</div>\n";
	$st2=sprintf($st1,$ay[1]);
	echo $st2;
	unset($ay);
}
else
{
	$st2=sprintf($st1,"");
	echo $st2;
}
	echo "<div class='inner-narrow'><form class='form form-horizontal form-boxed' method='post' action='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."&index=2'>\n";
	$st1="<div class='form-group'>\n<label> </label>\n<div class='form-split'>\n<input type='email' name='email' id='email' placeholder='请输入新邮箱' class='form-control inlined'  value='%s' required/>\n<input type='submit' class='btn btn-primary' value='更新邮箱' />\n</div>\n</div>\n</form>\n</div>\n";
if(isset($_POST['email']))
{
	$ay=array(2,$_POST['email']);//0:uname,1:password,2:email
	$ta=new login();
	$ta->edit($ay);
	if($ta->err_no == 0)
	{
		echo "<div class='alert alert-success alert-inline' role='alert'>\n邮箱已经更新</div>\n";
		$_SESSION['CURR_USR'][1]=$ay[1];
	}
	else
		echo "<div class='alert alert-danger alert-inline' role='alert'>\n".$ta->err_msg()."</div>\n";
	$st2=sprintf($st1,$ay[1]);
	echo $st2;
	unset($ay);
}
else
{
	$st2=sprintf($st1,"");
	echo $st2;
}
	$st1="<div class='inner-narrow'><form class='form form-horizontal form-boxed' method='post' action='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."&index=4' enctype='multipart/form-data'><div class='form-group'><label> </label><div class='form-split'>
											<input type='file' name='filez' id='filez' class='inputfile' onchange='onchg(this)' accept='image/*' />
											<label for='filez' class='btn btn-success'>选择头像</label>&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;
										<input type='submit' class='btn btn-primary' value='上传图片' /></div></div>	
	</form></div></div></div></div>";
	$st2=sprintf($st1,$uploadm);
	echo $st2;
//}}}
//{{{ Tab 3	修改密码
		$st1="				<!-- Tab 3 -->
                                <div role='tabpanel' class='tab-pane %s' id='shared2'>
                                    <div class='inner-narrow inner-midnarrow'>
    									<div class='intro-block intro-block-slim'>
									        <p>更新密码</p><form class='form form-horizontal' method='post' action='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."&index=3'>";
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
		if($_POST['newpwd'] != $_POST['cfmpwd'])
		{
			echo "<div class='alert alert-danger alert-inline' role='alert'>\n两次密码不一致，请重新输入</div>\n";
		}
		else
		{
			$ay=array(1,$_POST['cfmpwd']);//0:uname,1:password,2:email
			$ta=new login();
			$ta->edit($ay);
			if($ta->err_no == 0)
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
//{{{ js and css
	echo "</div></div></div></div>";
echo "<style type='text/css'>
.inputfile1{opacity:0;}
.inputfile{
    width: 0.1px; 
    height: 0.1px; 
    opacity: 0; 
    overflow: hidden; 
    position: absolute; 
    z-index: -1;
}
.light1{display: inline-block; font-size: 14px; color:rgba(0,0,0,.55); padding-top:8px;}
.light2{display: inline-block; font-size: 14px; color:rgba(0,100,0,.55); padding-top:8px;}
.light3{display: inline-block; font-size: 14px; color:rgba(100,0,0,.55); padding-top:8px;}
</style>
<script>
function onchg(obj)
{
	var newsrc=obj.files[0];
	var a=document.getElementById('vvvv');
	var st1='';
	if(newsrc.name == null)
	{
		a.setAttribute('class','light3');
		st1='选择头像错误请稍候再试';
	}
	else
	{
		a.setAttribute('class','light2');
		st1='选择头像成功，准备上传';
	}
	a.innerHTML=st1;
}
</script>";		
		echo $SIG_HTML['RIGHT_TOP3'];
//}}}		
?>
