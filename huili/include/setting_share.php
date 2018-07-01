<?php
//uid(0),姓名(1)，单位(2)，电话(3)，简介(4)，专业(5),头像(6)   <-显示顺序
//uid(0),单位(1)，电话(2)，所属行业（先空）(3)，个人简介(4)，头像(5)，姓名(6)，专业id(7)，认证标志(8)  <-数据库字段顺序
//1:污水处理,2:废气处理,4:噪音,8:环境工程,16:项目评审，32:法律事务
$act=array("active","");
$err_str="完成认证，进入我们的专家团队";
$u=array();
$ph=constant('WORK_PLACE')."images/upload/";
if(isset($_POST['name'])) //专家认证
{
	$u[0]=$_SESSION['CURR_USR'][0];	//uid
	$u[1]=$_POST['danwei'];			//单位
	$u[2]=$_POST['phone'];			//电话
	$u[3]=" ";						//所属行业
	$u[4]=$_POST['intro'];			//个人简历
	$u[5]=$ph.$_FILES['file']['name'];//头像
	if($_FILES['file']['tmp_name'])
	{
		move_uploaded_file($_FILES['file']['tmp_name'],"../images/upload/".$_FILES['file']['name']);
		$u[6]=$_POST['name'];			//姓名
		$u[7]=0;
		for($i=0;$i<count($_POST['trusted']);$i++)
			$u[7]+=intval($_POST['trusted'][$i]); //get skill
		$ta=new tb_expert();
		$ta->add_expert($u);
		if($ta->err_no)
			$err_str=$ta->err_msg();
		else
			$err_str="认证已提交，请等待管理员核实";
	}
	else
		$err_str="上传头像图片失败！";
}
//名称(0),地址（1），电话（2），简介（3），所属（4），图片（5）  <-显示顺序
//uid(0),名称(1),图片（2），所属行业（3），行业id(4),简介(5),地址(6),电话(7),认证标志(8)  <-数据库字段顺序
//1:污水处理，2：化工，3：电力，4：仪器设备，5：环境治理，6：其他行业
elseif(isset($_POST['comp'])) //团队认证
{
	$act=array("","active");
	$u[0]=$_SESSION['CURR_USR'][0];	//UID
	$u[1]=$_POST['comp'];		//名称
	$u[2]=$ph.$_FILES['file1']['name'];		//图片
	$u[3]=" ";					//所属行业
	$u[4]=0;
	for($i=0;$i<count($_POST['trusted']);$i++)
		$u[4]+=intval($_POST['trusted'][$i]); //行业id
	$u[5]=$_POST['intro'];	//简介
	$u[6]=$_POST['danwei'];	//地址
	$u[7]=$_POST['phone'];	//电话
	$ta=new tb_company();
	$ta->add_company($u);
	if($ta->err_no)
		$err_str=$ta->err_msg();
	else
	{
		$err_str="认证已提交，请等待管理员核实";
		if($_FILES['file1']['tmp_name'])
			move_uploaded_file($_FILES['file1']['tmp_name'],"../images/upload/".$_FILES['file1']['name']);
		else
			$err_str="认证已提交，图片上传失败！";
	}
}

?>
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
		$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li><a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>设置</a></li><li>认证";
		$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
		echo $st1;
		echo "<div class='inner' id='modal_container' >\n<h2 class='sect first'>设置 / 认证</h2>\n";
        $st1="<div class='block'><div class='panel shadow'>
		<!-- Tab 1 -->
              <div class='inner-narrow inner-midnarrow'>
   					 <div class='intro-block intro-block-slim'>
				        <p>".$err_str."</p>
				    </div>
              		<div class='nav-vendors'>
                    <!-- Vendor nav -->
                    <ul class='nav nav-tabs nav-tabs-vertical' role='tablist'>
                            <li role='presentation' class='%s'>
                                <a href='#vendor-amazon' aria-controls='amazon' role='tab' data-toggle='tab'>
                                    <i class='icon-truck'></i><span>专家认证</span>
                                </a>
                            </li>
                            <li role='presentation' class='%s'>
                                <a href='#vendor-github' aria-controls='github' role='tab' data-toggle='tab'>
                                    <i class='icon-user'></i><span>团队认证</span>
                                </a>
							</li>
                    </ul>";
		$st2=sprintf($st1,$act[0],$act[1]);
		echo $st2;
              $st1="<!-- Vendor Panes -->
                    <div class='tab-content tab-content-vertical'>
                            <div role='tabpanel' class='tab-pane active' id='vendor-amazon'>
								<form name='form1' method='post' action='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['SEV']."' enctype='multipart/form-data'>
                                    <div class='shareblock'>
                                        <div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><input name='name' id='name' class='form-control inlined' placeholder='您的真实姓名' required/></p>
                                        </div>
                                        <div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><input name='danwei' id='danwei' class='form-control inlined' placeholder='您就职的单位' required/></p>
                                        </div>
                                        <div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><input name='phone' id='phone' class='form-control inlined' placeholder='您的电话' required/></p>
                                        </div>
                                        <div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><textarea name='intro' id='intro' class='form-control custom-message-input inlined' placeholder='您的个人简介' required tabindex=2></textarea></p>
                                        </div>
                                        <div class='shareblock-head shareblock-head-light'>
											<p class='shareblock-account'><span class='light'>您的专业</span><div class='form-group form-twocols'><div class='checkbox'><label><input type='checkbox' name='trusted[]' value='1' data-ninja-checkbox>污水处理</label></div><div class='checkbox'><label><input type='checkbox' name='trusted[]' value='2' data-ninja-checkbox>废气处理</label></div></div>
											<div class='form-group form-twocols'><div class='checkbox'><label><input type='checkbox' name='trusted[]' value='4' data-ninja-checkbox>噪音治理</label></div><div class='checkbox'><label><input type='checkbox' name='trusted[]' value='8' data-ninja-checkbox>环境工程</label></div></div>
											<div class='form-group form-twocols'><div class='checkbox'><label><input type='checkbox' name='trusted[]' value='16' data-ninja-checkbox>项目评审</label></div><div class='checkbox'><label><input type='checkbox' name='trusted[]' value='32' data-ninja-checkbox>法律事务</label></div></div></p>
                                        </div>
                                        <div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'>
											<input type='file' name='file' id='file' class='inputfile' onchange='onchg(this)' accept='image/*' />
											<label for='file' class='btn btn-success'>上传图片</label>&nbsp;<span id='vvvv'class='light'>请选择适合做头像的图片</span></p>
                                        </div>

                                        <div class='shareblock-body'><br>
                      							<center> <button type='submit' class='btn btn-primary'>提交申请</button></center>
                                        </div>
                                    </div>
								</form>
                            </div>";
					echo $st1;
					$st1="<!-- my add -->
                            <div role='tabpanel' class='tab-pane ' id='vendor-github'>
								<form name='form2' method='post' action='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['SEV']."' enctype='multipart/form-data'>
                                    <div class='shareblock'>
                                        <div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><input name='comp' id='comp' class='form-control inlined' placeholder='公司名称' required/></p>
                                        </div>
                                        <div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><input name='danwei' id='danwei' class='form-control inlined' placeholder='公司地址' required/></p>
                                        </div>
                                        <div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><input name='phone' id='phone' class='form-control inlined' placeholder='公司电话' required/></p>
                                        </div>
                                        <div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><textarea name='intro' id='intro' class='form-control custom-message-input inlined' placeholder='公司简介' required tabindex=2></textarea></p>
                                        </div>
                                        <div class='shareblock-head shareblock-head-light'>
											<p class='shareblock-account'><span class='light'>所属行业</span><div class='form-group form-twocols'><div class='checkbox'><label><input type='checkbox' name='trusted[]' value='1' data-ninja-checkbox>污水处理</label></div><div class='checkbox'><label><input type='checkbox' name='trusted[]' value='2' data-ninja-checkbox>化工行业</label></div></div>
											<div class='form-group form-twocols'><div class='checkbox'><label><input type='checkbox' name='trusted[]' value='4' data-ninja-checkbox>电力行业</label></div><div class='checkbox'><label><input type='checkbox' name='trusted[]' value='8' data-ninja-checkbox>仪器设备</label></div></div>
											<div class='form-group form-twocols'><div class='checkbox'><label><input type='checkbox' name='trusted[]' value='16' data-ninja-checkbox>环境治理</label></div><div class='checkbox'><label><input type='checkbox' name='trusted[]' value='32' data-ninja-checkbox>其他行业</label></div></div></p>
                                        </div>
                                        <div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'>
											<input type='file' name='file1' id='file1' class='inputfile' onchange='onchg1(this)' accept='image/*' />
											<label for='file1' class='btn btn-success'>上传图片</label>&nbsp;<span id='vvva'class='light'>请选择适合做logo的图片</span></p>
                                        </div>
                                        <div class='shareblock-body'><br>
                      							<center> <button type='submit' class='btn btn-primary'>提交申请</button></center>
                                        </div>
                                    </div>
								</form>	
                            </div>
                    </div>
				</div></div>";
		echo $st1;
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
</style>
<script>
function onchg(obj)
{
	var newsrc=obj.files[0];
	var a=document.getElementById('vvvv');
	a.innerHTML=newsrc.name;
}
function onchg1(obj)
{
	var newsrc=obj.files[0];
	var a=document.getElementById('vvva');
	a.innerHTML=newsrc.name;
}
</script>";		

		echo $SIG_HTML['RIGHT_TOP3'];
?>
