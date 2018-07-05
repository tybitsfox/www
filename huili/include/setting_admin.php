<?php
//{{{ prepare
$glb_msg="<p>我的管理界面</p>";			//提示字符串
$tab_act=array("active","");			//横向页标签活动状态
$ven_act=array("active","","","","");	//纵向页标签及对应内容的显示状态
$exp=array();$term=array();				//待认证的专家和团队列表
$xexp=array();$xterm=array();			//已认证的专家和团队列表
$usr=array();							//当前注册帐号的列表
$cnt=array(0,0,0,0,0);					//总的翻页次数
$curr_pg=array(0,0,0,0,0);				//当前页号
if(isset($_GET['vendor']))
{
	$i=intval($_GET['vendor']);
	if(isset($_GET['preva']))
		$curr_pg[$i]=intval($_GET['preva'])+1;
	elseif(isset($_GET['nexta']))
		$curr_pg[$i]=intval($_GET['nexta'])-1;
	else
		$curr_pg[$i]=0;
}
$ta=new tb_expert();
$u=array();
$u[0]=5;	//by not confirmed <-all
$u[1]=1;	//no use
$ay=array();
$ay=$ta->get_expert($u);
if($ta->err_no)
	$glb_msg="<div class='alert alert-warning' role='alert'><strong>错误</strong>".$ta->err_msg()."</div>";
else
{
	$x=0;$y=0;
	foreach($ay as $a)
	{
		if($a[9] == 0)//未认证的
		{
			if($a[1] == 0) //expert
				$exp[$x++]=$a;
			else
				$term[$y++]=$a;
		}
		else
		{
			if($a[1] == 0) //expert
				$xexp[$x++]=$a;  //现有的专家
			else
				$xterm[$y++]=$a;
		}
	}
	unset($ay);unset($ta);
	$cnt[0]=floor(count($exp)/5);
	if(count($exp)%5)
		$cnt[0]++;
	$cnt[1]=floor(count($term)/5);
	if(count($term)%5)
		$cnt[1]++;
	$cnt[2]=floor(count($xexp)/5);
	if(count($xexp)%5)
		$cnt[2]++;
	$cnt[3]=floor(count($xterm)/5);
	if(count($xterm)%5)
		$cnt[3]++;
	$ta=new login();
	$usr=$ta->get_usr();
	$cnt[4]=floor(count($usr)/5);
	if(count($usr)%5)
		$cnt[4]++;
}
if(isset($_GET['action']) && isset($_GET['vendor']))
{
	if($_GET['action'] != 'true')
		$tab_act=array("","active");
	$ven_act=array("","","","","");
	$ven_act[intval($_GET['vendor'])]="active";
}
//}}}
?>
<?php
//{{{ top fixed!
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
		$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li><a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>设置</a></li><li>管理员";
		$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
		echo $st1;
		echo "<div class='inner' id='modal_container' >\n<h2 class='sect first'>设置 / 管理员</h2>\n";
		$st1="<div class='block'>
            <div class='panel shadow'>
                <!-- Nav tabs -->
                <ul class='nav nav-tabs nav-tabs-hor' role='tablist'>
                        <li role='presentation' class='".$tab_act[0]."'><a href='#test1' aria-controls='share' role='tab' data-toggle='tab' data-history-enabled>认证审核</a></li>
                        <li role='presentation' class='".$tab_act[1]."'><a href='#test2' aria-controls='sharedwith' role='tab' data-toggle='tab' data-history-enabled>详细资料</a></li>
                </ul>
                <div class='body'>                
                    <div class='body body-settings'>
                        <div class='tab-content'>

                            <!-- Tab 1 -->
                                <div role='tabpanel' class='tab-pane ".$tab_act[0]."' id='test1'>
                                    <div class='inner-narrow inner-midnarrow'>

    <div class='intro-block intro-block-slim'>
<!--        <p>我的管理界面.</p> -->
		".$glb_msg."
    </div>

                <div class='nav-vendors'>
                    <!-- Vendor nav -->
                    <ul class='nav nav-tabs nav-tabs-vertical' role='tablist'>
                            <li role='presentation' class='".$ven_act[0]."'>
                                <a href='#vendor-expert' role='tab' data-toggle='tab'>
                                    <i class='icon-user'></i><span>专家申请</span>
                                </a>
                            </li>
                            <li role='presentation' class='".$ven_act[1]."'>
                                <a href='#vendor-company' role='tab' data-toggle='tab'>
                                    <i class='icon-group'></i><span>团队申请</span>
                                </a>
							</li>
                            <li role='presentation' class='".$ven_act[2]."'>
                                <a href='#vendor-exexpert' role='tab' data-toggle='tab'>
                                    <i class='icon-smile'></i><span>现有专家</span>
                                </a>
                            </li>
                            <li role='presentation' class='".$ven_act[3]."'>
                                <a href='#vendor-excomp' role='tab' data-toggle='tab'>
                                    <i class='icon-wechat'></i><span>现有团队</span>
                                </a>
                            </li>
                            <li role='presentation' class='".$ven_act[4]."'>
                                <a href='#vendor-user' role='tab' data-toggle='tab'>
                                    <i class='icon-pencil'></i><span>账户管理</span>
                                </a>
                            </li>
                    </ul>";
					echo $st1;
//}}}
//{{{ vendor 1 专家验证
					$st1="<!-- Vendor Panes -->
                    <div class='tab-content tab-content-vertical'>
                            <div role='tabpanel' class='tab-pane ".$ven_act[0]."' id='vendor-expert'>
                                    <div class='shareblock'>";
					echo $st1;
if(count($exp))
{
                                  $st1="<div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><span class='light'>申请人:</span> <strong><span class='account-truncated'>%s</span></strong></p>
                                            <a href='%s' class='btn btn-primary withicon btn-shareaccount' data-toggle-inactive='modal' data-target='#modal-shareaccount'><i class='icon-pencil'></i> 详细资料</a>
                                        </div>";
	if(isset($_GET['nexta']))	//下翻页
	{
		if($curr_pg[0]<($cnt[0]-1))
			$curr_pg[0]++;
	}
	elseif(isset($_GET['preva'])) //上翻页
	{
		if($curr_pg[0] > 0)
			$curr_pg[0]--;
	}
	$j=count($exp)-1;
	for($i=0;$i<5;$i++)
	{
		$k=$i+$curr_pg[0]*5;
		if($k>$j)
			break;
		$st2=sprintf($st1,$exp[$k][2],$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN']."&action=".$exp[$k][0]."&vendor=0");
		echo $st2;
	}
								  $st1="<div class='shareblock-body'>
									  		<div class='text-center'>
													<a href='%s' style='%s'>&lt;&lt;</a>&nbsp;&nbsp;&nbsp;%d&nbsp;&nbsp;&nbsp;<a href='%s' style='%s'>&gt;&gt;</a>
											</div>
                                        </div>";
	if($curr_pg[0] == 0)
	{
		$sta1="color: gray; cursor: default; disabled: true;";
		$sta4="javascript:;";
		//$sta4=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN']."&preva=".$curr_pg."&action=true&vendor=4";
	}
	else
	{
		$bb=intval($curr_pg[0])-1;
		$sta1="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta4=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN']."&preva=".$bb."&action=true&vendor=0";
	}
	if($curr_pg[0] == ($cnt[0]-1))
	{
		$sta2="color: gray; cursor: default; disabled: true;";
		$sta3="javascript:;";
		//$sta3=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN']."&nexta=".$curr_pg."&action=true&vendor=4";
	}
	else
	{
		$bb=intval($curr_pg[0])+1;
		$sta2="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta3=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN']."&nexta=".$bb."&action=true&vendor=0";
	}
	$st2=sprintf($st1,$sta4,$sta1,intval($curr_pg[0])+1,$sta3,$sta2);
								  echo $st2;


}
else
{
								  $st1="<div class='shareblock-body'>
                                            <ul class='list-unstyled list-shares'>
                                                        <p>没有专家认证的请求</p>
                                            </ul>
                                        </div>";
								  echo $st1;
}
//}}}
//{{{ vandor 2 团队认证
                              $st1="</div>
                            </div>
					<!-- my add -->
                            <div role='tabpanel' class='tab-pane ".$ven_act[1]."' id='vendor-company'>
                                    <div class='shareblock'>";
							  echo $st1;
if(count($term))
{
                                      $st1="<div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><span class='light'>申请团队:</span> <strong><span class='account-truncated'>%s</span></strong></p>
                                            <a href='%s' class='btn btn-primary withicon btn-shareaccount' data-toggle-inactive='modal' data-target='#modal-shareaccount'><i class='icon-pencil'></i> 详细资料</a>
                                        </div>";
	for($i=0;$i<count($term);$i++)
	{
		$st2=sprintf($st1,$term[$i][2],$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN']."&action=".$_SESSION['CURR_USR'][0]."&vendor=1");
		echo $st2;
	}
}
else
{
								  $st1="<div class='shareblock-body'>
                                            <ul class='list-unstyled list-shares'>
                                                        <p>没有团队认证的请求</p>
                                            </ul>
                                        </div>";
								  echo $st1;
}
//}}}
//{{{ vandor 3 现有的专家
							$st1="</div>
                            </div>
                    <!-- Vendor Panes -->
                            <div role='tabpanel' class='tab-pane ".$ven_act[2]."' id='vendor-exexpert'>
                                    <div class='shareblock'>";
							echo $st1;
if(count($xexp))
{	
                                  $st1="<div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><span class='light'>现有专家:</span> <strong><span class='account-truncated'>%s</span></strong></p>
                                            <a href='%s' class='btn btn-primary withicon btn-shareaccount' data-toggle-inactive='modal' data-target='#modal-shareaccount'><i class='icon-pencil'></i> 详细资料</a>
                                        </div>";
	for($i=0;$i<count($xexp);$i++)
	{
		$st2=sprintf($st1,$xexp[$i][2],$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN']."&action=".$_SESSION['CURR_USR'][0]."&vendor=2");
		echo $st2;
	}
}
else
{
								  $st1="<div class='shareblock-body'>
                                            <ul class='list-unstyled list-shares'>
                                                        <p>没有认证的专家</p>
                                            </ul>
                                        </div>";
								  echo $st1;
}
//}}}
//{{{ verdor 4 现有团队
							$st1="</div>
                            </div>
                    <!-- Vendor Panes -->
                            <div role='tabpanel' class='tab-pane ".$ven_act[3]."' id='vendor-excomp'>
                                    <div class='shareblock'>";
							echo $st1;
if(count($xterm))
{	
                                  $st1="<div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><span class='light'>现有团队:</span> <strong><span class='account-truncated'>%s</span></strong></p>
                                            <a href='%s' class='btn btn-primary withicon btn-shareaccount' data-toggle-inactive='modal' data-target='#modal-shareaccount'><i class='icon-pencil'></i> 详细资料</a>
                                        </div>";
	for($i=0;$i<count($xterm);$i++)
	{
		$st2=sprintf($st1,$xterm[$i][2],$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN']."&action=".$_SESSION['CURR_USR'][0]."&vendor=3");
		echo $st2;
	}
}
else
{
								  $st1="<div class='shareblock-body'>
                                            <ul class='list-unstyled list-shares'>
                                                        <p>没有认证的团队</p>
                                            </ul>
                                        </div>";
								  echo $st1;
}
//}}}
//{{{ verdor 5 现有注册用户
							$st1="</div>
                            </div>
                    <!-- Vendor Panes -->
                            <div role='tabpanel' class='tab-pane ".$ven_act[4]."' id='vendor-user'>
                                    <div class='shareblock'>";
							echo $st1;
if(count($usr))
{	
                                  $st1="<div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><span class='light'>注册帐号:</span> <strong><span class='account-truncated'>%s</span></strong></p>
                                            <a href='%s' class='btn btn-primary withicon btn-shareaccount' data-toggle-inactive='modal' data-target='#modal-shareaccount'><i class='icon-pencil'></i> 详细资料</a>
                                        </div>";
	if(isset($_GET['nexta'])) //下翻页
	{
		if($curr_pg[4]<($cnt[4]-1))
			$curr_pg[4]++;
	}
	elseif(isset($_GET['preva']))//上翻页
	{
		if($curr_pg[4] > 0)
			$curr_pg[4]--;
	}
	$j=count($usr)-1;
	for($i=0;$i<5;$i++)
	{
		$k=$i+$curr_pg[4]*5;
		if($k>$j)
			break;
		$st2=sprintf($st1,$usr[$k][1],$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN']."&action=".$usr[$k][0]."&vendor=4");
		echo $st2;
	}
								  $st1="<div class='shareblock-body'>
									  		<div class='text-center'>
													<a href='%s' style='%s'>&lt;&lt;</a>&nbsp;&nbsp;&nbsp;%d&nbsp;&nbsp;&nbsp;<a href='%s' style='%s'>&gt;&gt;</a>
											</div>
                                        </div>";
	if($curr_pg[4] == 0)
	{
		$sta1="color: gray; cursor: default; disabled: true;";
		$sta4="javascript:;";
		//$sta4=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN']."&preva=".$curr_pg."&action=true&vendor=4";
	}
	else
	{
		$bb=intval($curr_pg[4])-1;
		$sta1="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta4=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN']."&preva=".$bb."&action=true&vendor=4";
	}
	if($curr_pg[4] == ($cnt[4]-1))
	{
		$sta2="color: gray; cursor: default; disabled: true;";
		$sta3="javascript:;";
		//$sta3=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN']."&nexta=".$curr_pg."&action=true&vendor=4";
	}
	else
	{
		$bb=intval($curr_pg[4])+1;
		$sta2="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta3=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN']."&nexta=".$bb."&action=true&vendor=4";
	}
	$st2=sprintf($st1,$sta4,$sta1,intval($curr_pg[4])+1,$sta3,$sta2);
								  echo $st2;
}
else
{
								  $st1="<div class='shareblock-body'>
                                            <ul class='list-unstyled list-shares'>
                                                        <p>没有认证的团队</p>
                                            </ul>
                                        </div>";
								  echo $st1;
}
//}}}

						$st1="</div>
                            </div>

					<!--end tab -->							
                    </div>

                </div>
    
</div>
                                </div>
                    <!--Tab 2-->        
                                <div role='tabpanel' class='tab-pane ".$tab_act[1]."' id='test2'>
                                    <div class='inner-narrow inner-midnarrow'>
    
    <div class='intro-block intro-block-slim'>
        <p>Accounts shared with you</p>
    </div>
        <div class='flash-container'></div>
        <!-- ic-src must be `whitespace` char, not null or / -->
        <div id='account-collaboration' ic-refresh ic-src=' ' class='ic-transition' ic-select-from-response='#account-collaboration'  ic-transition-duration='.1s'>
                    
    <div id='account_collaborations'>
            <div  class='text-center'>
                <span>You have not been added as a collaborator to any accounts yet.</span>
            </div>

        </div>
</div>  
          
</div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>";
		echo $st1;

		echo $SIG_HTML['RIGHT_TOP3'];
?>

