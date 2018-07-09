<?php
$err_txt="<p>我邀请的合作伙伴.</p>";
$tab_act=array("active","");
$ven_act=array("active","","","");
$cnt=array(0,0,0,0,0);
$curr_pg=array(0,0,0,0,0);
$exp=array();
$term=array();
$xexp=array();
$xterm=array();
$esel1=0;
$esel2=0;
//{{{ 数据的取得及准备操作 
if(isset($_POST['checkn']))
{
	foreach($_POST['checkn'] as $a)
		$esel1+=$a;
}
$ta=new tb_my_expert();
$a=1;$ay=array();
$ay=$ta->get_my_expert($a);//查找所有没被当前用户添加的专家和团队
//	$err_txt="<div class='alert alert-warning' role='alert'><strong>错误</strong>".$ta->err_msg()."</div>";
foreach($ay as $b)
{
	if($b[1] == 0) //专家
		array_push($xexp,$b);
	else
		array_push($xterm,$b);//团队
}
unset($ta);$ay=array();
$ta=new tb_my_expert();
$a=0;$ay=array();
$ay=$ta->get_my_expert($a); //再取得已添加的专家团队
foreach($ay as $b)
{
	if($b[1] == 1)
		array_push($term,$b);
	else
		array_push($exp,$b);	
}
//}}}

?>
<?php
//{{{左边导航栏栏
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
//}}}
//{{{右边显示栏抬头		div +6
		$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li><a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>设置</a></li><li>我的合作";
		$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
		echo $st1;
		echo "<div class='inner' id='modal_container' >\n<h2 class='sect first'>设置 / 我的合作</h2>\n";
		$st1="<div class='block'>
            <div class='panel shadow'>
                <!-- Nav tabs -->
                <ul class='nav nav-tabs nav-tabs-hor' role='tablist'>
                        <li role='presentation' class='".$tab_act[0]."'><a href='#share' aria-controls='share' role='tab' data-toggle='tab' data-history-enabled>我邀请的合作</a></li>
                        <li role='presentation' class='".$tab_act[1]."'><a href='#sharedwith' aria-controls='sharedwith' role='tab' data-toggle='tab' data-history-enabled>邀请我的合作</a></li>
                </ul>
                <div class='body'>                
                    <div class='body body-settings'>
                        <div class='tab-content'>";
		echo $st1;
//}}}
//{{{横向标签页1
//{{{纵向标签页显示		div +3
		echo"                <!-- Tab 1 -->
                                <div role='tabpanel' class='tab-pane ".$tab_act[0]."' id='share'>
                                    <div class='inner-narrow inner-midnarrow'>   

    <div class='intro-block intro-block-slim'>
        ".$err_txt."
    </div>

                <div class='nav-vendors'>
                    <!-- Vendor nav -->
                    <ul class='nav nav-tabs nav-tabs-vertical' role='tablist'>
                            <li role='presentation' class='".$ven_act[0]."'>
                                <a href='#vendor-amazon' aria-controls='amazon' role='tab' data-toggle='tab'>
                                    <i class='icon-user'></i><span>专家团队</span>
                                </a>
                            </li>
                            <li role='presentation' class='".$ven_act[1]."'>
                                <a href='#vendor-github' aria-controls='github' role='tab' data-toggle='tab'>
                                    <i class='icon-wechat'></i><span>业务伙伴</span>
                                </a>
							</li>
							<li rele='presentation' class'".$ven_act[2]."'>
								<a href='#vendor-search' aria-controls='search' role='tab' data-toggle='tab'>
									<i class='icon-group'></i><span>查找专家</span>
								</a>
							</li>
							<li rele='presentation' class'".$ven_act[3]."'>
								<a href='#vendor-xsearch' aria-controls='xsearch' role='tab' data-toggle='tab'>
									<i class='icon-airplane'></i><span>查找团队</span>
								</a>
							</li>
                    </ul>";
//}}}
//{{{纵向标签页 1内容   div +1
                  echo"<!-- Vendor Panes -->
                    <div class='tab-content tab-content-vertical'>
                            <div role='tabpanel' class='tab-pane ".$ven_act[0]."' id='vendor-amazon'>
                                    <div class='shareblock'>
                                        <div class='shareblock'>
<ul class='list-unstyled list-accounts'>";
$st1="<li>
          <div class='avatar'>
              <div class='circle'>
                    <img src='%s' alt='头像'/>
              </div>
          </div>
          <div class='account-info'>
              <p class='title'>
                     <strong>姓名：</strong>%s
              </p>
          </div>
          <div class='account-status'>
              <p class='desc'></p>
          </div>
          <div class='account-action'>
              <a href='#authorization%s' class='btn btn-outline' data-trigger='collapse'>详细信息</a>
          </div>
      </li>
      <li class='collapse' id='authorization%s'>
           <ul class='list-unstyled list-security'> <!-- start more info section -->
                <li>
                    <p class='title'>单位</p><p class='info'>%s</p>
                </li>
                <li>
                    <p class='title'>专业</p><p class='info'>%s</p>
                </li>
                <li>
                    <p class='title'>简介</p><p class='info'>%s</p>
                </li>
				<li>
					<div class='text-center'><a href='#' style='color: #AE3E48; text-decoration: none; border-bottom: 1px solid #AE3E48;'>解除邀请</a></div>
				</li>
			</ul>
		</li>";
if(count($exp) > 0)
{
	//计算翻页
	if(isset($_GET['vendor']) && ($_GET['vendor'] == 0)) //保证不被其他标签页干扰
	{
		if(isset($_GET['nexta'])) //下翻页
		{
			if($curr_pg[0]<($cnt[0]-1))
				$curr_pg[0]++;
		}
		elseif(isset($_GET['preva'])) //上翻页
		{
			if($curr_pg[0] > 0)
				$curr_pg[0]--;
		}
	}
	//uid(0),category(1),name(2),addr(3),phone(4),major(5),intro(6),mid(7),imgpath(8)
	$j=count($exp)-1;
	for($i=0;$i<5;$i++)
	{
		$k=$i+$curr_pg[0]*5;
		if($k>$j)
			break;
		$ay=array();
		$ay=$exp[$k];
		$cy=array($ay[7],1);
		$s1=get_major($cy);
		$st2=sprintf($st1,$ay[8],$ay[2],$i,$i,$ay[3],$s1,$ay[6]);
		echo $st2;
	}
	echo "</ul>";
	//显示翻页
	$st1="<div class='shareblock-body'>
		<div class='text-center'>
		<a href='%s' style='%s'>&lt;&lt;</a>&nbsp;&nbsp;&nbsp;%d&nbsp;&nbsp;&nbsp;<a href='%s' style='%s'>&gt;&gt;</a>
		</div>
		</div>";
	if($curr_pg[0] == 0)
	{
		$sta1="color: gray; cursor: default; disabled: true;";
		$sta4="javascript:;";
	}
	else
	{
		$bb=intval($curr_pg[0])-1;
		$sta1="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta4=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&preva=".$bb."&action=true&vendor=0";
	}
	if($curr_pg[0] >= ($cnt[0]-1))
	{
		$sta2="color: gray; cursor: default; disabled: true;";
		$sta3="javascript:;";
	}
	else
	{
		$bb=intval($curr_pg[0])+1;
		$sta2="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta3=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV']."&nexta=".$bb."&action=true&vendor=0";
	}
	$st2=sprintf($st1,$sta4,$sta1,intval($curr_pg[0])+1,$sta3,$sta2);
	echo $st2;
}
else
{
	  $st1="</ul><div class='shareblock-body'>
            <ul class='list-unstyled list-shares'>
	             <p>您还没有邀请的专家</p>
            </ul>
            </div>";
	 echo $st1;
}
//	$err_txt="<div class='alert alert-warning' role='alert'><strong>提示：</strong>您还没邀请任何专家</div>";
echo "</div></div></div>";
//}}}
//{{{纵向标签页 2内容	div -4	
				echo"<!-- my add -->
                            <div role='tabpanel' class='tab-pane ".$ven_act[1]."' id='vendor-github'>
                                    <div class='shareblock'>
                                        <div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><span class='light'>单位:</span> <strong><span class='account-truncated'>山东汇宇环境</span></strong></p>
                                            <a href='/app/accounts/6adgokW5xo/edit?tab=collaborators' class='btn btn-primary withicon btn-shareaccount' data-toggle-inactive='modal' data-target='#modal-shareaccount'><i class='icon-pencil'></i> 交流分享</a>
                                        </div>
                                        <div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><span class='light'>单位:</span> <strong><span class='account-truncated'>山东汇力环保</span></strong></p>
                                            <a href='/app/accounts/6adgokW5xo/edit?tab=collaborators' class='btn btn-primary withicon btn-shareaccount' data-toggle-inactive='modal' data-target='#modal-shareaccount'><i class='icon-pencil'></i> 交流分享</a>
                                        </div>
                                        <div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><span class='light'>单位:</span> <strong><span class='account-truncated'>河北清源水务</span></strong></p>
                                            <a href='/app/accounts/6adgokW5xo/edit?tab=collaborators' class='btn btn-primary withicon btn-shareaccount' data-toggle-inactive='modal' data-target='#modal-shareaccount'><i class='icon-pencil'></i> 交流分享</a>
                                        </div>

                                        <div class='shareblock-body'>
                                            <ul class='list-unstyled list-shares'>
                                                        <p>努力添加更多的业务伙伴 </p>
                                            </ul>
                                        </div>
                                    </div>
                            </div>
                    </div>

                </div>
    
</div>
                                </div>";
//}}}
//}}}
//{{{横向标签页2	div -5								
                            echo"<div role='tabpanel' class='tab-pane ".$tab_act[1]."' id='sharedwith'>
                                    <div class='inner-narrow inner-midnarrow'>
    
    <div class='intro-block intro-block-slim'>
        <p>Accounts shared with you</p>
    </div>
    
<div id='account-collaboration-container'
     class='ic-container' 
     ic-on-success='successRefreshContainer(data, textStatus, xhr, 'account-collaboration-container')'
     ic-on-error='errorRefreshContainer(xhr, 'account-collaboration-container')'>
        <div class='flash-container'></div>
        <!-- ic-src must be `whitespace` char, not null or / -->
        <div id='account-collaboration' ic-refresh ic-src=' ' class='ic-transition' ic-select-from-response='#account-collaboration'  ic-transition-duration='.1s'>
                    
    <div id='account_collaborations'>
            <div  class='text-center'>
                <span>You have not been added as a collaborator to any accounts yet.</span>
            </div>

        </div>
</div>    </div>
          
</div>
                                </div>
                        </div>
                    </div>
                </div>
           </div> 
    </div></div>";
//}}}	 
echo"
            <script>
                $('input[type='checkbox'].switch').checkbox({
                    toggle: true,
                });
            </script>
";
	 echo $SIG_HTML['RIGHT_TOP3'];
?>
