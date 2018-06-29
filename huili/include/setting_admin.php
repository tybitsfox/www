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

		$st1="				<!-- Tab 2 -->
                                <div role='tabpanel' class='tab-pane %s' id='shared1'>
                                    <div class='inner-narrow inner-midnarrow'>
    									<div class='intro-block intro-block-slim'>
									        <p>bbbbbbbbbbbbb</p>
									    </div>
									</div>
								</div>";
					$st2=sprintf($st1,$act[1]);
					echo $st2;
		$st1="				<!-- Tab 3 -->
                                <div role='tabpanel' class='tab-pane %s' id='shared2'>
                                    <div class='inner-narrow inner-midnarrow'>
    									<div class='intro-block intro-block-slim'>
									        <p>cccccccccccc</p>
									    </div>
									</div>
								</div>";
					$st2=sprintf($st1,$act[2]);
					echo $st3;
		echo "</div></div></div></div>";
?>
