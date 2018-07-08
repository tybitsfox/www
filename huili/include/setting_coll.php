<?php
$tab_act=array("active","");
$ven_act=array("active","");
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
        <p>我邀请的合作伙伴.</p>
    </div>

                <div class='nav-vendors'>
                    <!-- Vendor nav -->
                    <ul class='nav nav-tabs nav-tabs-vertical' role='tablist'>
                            <li role='presentation' class='".$ven_act[0]."'>
                                <a href='#vendor-amazon' aria-controls='amazon' role='tab' data-toggle='tab'>
                                    <i class='icon-truck'></i><span>专家团队</span>
                                </a>
                            </li>
                            <li role='presentation' class='".$ven_act[1]."'>
                                <a href='#vendor-github' aria-controls='github' role='tab' data-toggle='tab'>
                                    <i class='icon-user'></i><span>业务伙伴</span>
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
<ul class='list-unstyled list-accounts'>
                    <li>
                      <div class='avatar'>
                        <div class='circle'>
                          <img src='/huili/images/logo/mmexport1.png' alt='汇氏'/>
                        </div>
                      </div>
                      <div class='account-info'>
                        <p class='title'>
                            <strong>
                              <a href='".$SIGNED_DEF['LINK']."'>汇氏管家</a>
                            </strong>
                            由
                            <strong>
                              <a href='".$SIGNED_DEF['LINK']."'>huishi group, Inc.</a>
                            </strong>
                        </p>
                      </div>
                      <div class='account-status'>
                            <p class='desc'></p>
                      </div>
                      <div class='account-action'>
                        <a href='#authorization".$i."' class='btn btn-outline' data-trigger='collapse'>详细信息</a>
                      </div>
                    </li>
                    <li class='collapse' id='authorization".$i."'>
                      <ul class='list-unstyled list-security'> <!-- start more info section -->
                        <li>
                          <p class='title'>授权</p>
                          <p class='info'>%s</p>
                        </li>
                        <li>
                          <p class='title'>浏览器</p>
                          <p class='info'>%s</p>
                        </li>
                        <li>
                          <p class='title'>操作系统</p>
                          <p class='info'>%s</p>
                        </li>
                        <li>
                          <p class='title'>地址</p>
                          <div class='m-v-half'>
                            <span>Location</span>
                            <p class='info'>%s</p>
                          </div>
                        </li>
                        <li>
                          <p class='title'>可信设备</p>
                          <p class='info'>%s</p>
                        </li>
                        <li>
                          <p class='title'>允许的操作</p>
                          <div class='info'>
                            <ul class='list-unstyled'>
                                <li><strong>%s</strong></li>
                                <li><strong>Read/write your transactions</strong></li>
                            </ul>
                          </div>
                        </li>
</ul>

                                        </div>
                                        <div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><span class='light'>合作伙伴:</span> <strong><span class='account-truncated'>孙国在</span></strong></p>
                                            <a href='/app/accounts/6adgokW5xo/edit?tab=collaborators' class='btn btn-primary withicon btn-shareaccount' data-toggle-inactive='modal' data-target='#modal-shareaccount'><i class='icon-pencil'></i> 开始交流</a>
                                        </div>
                                        <div class='shareblock-head shareblock-head-light'>
										<p>污水处理专业</p>
										<div class='btn-shareaccount'>
     <label class='check'><input type='checkbox' name='check_1'  class='switch' />污水处理</label>
	 									</div></div>
                                        <div class='shareblock-head shareblock-head-light'>
										<p>废气处理专业</p>
										<div class='btn-shareaccount'>
<label class='check'><input type='checkbox' name='check_2'  class='switch' /></label> 
	 									</div></div>
                                        <div class='shareblock-body'>
                                            <ul class='list-unstyled list-shares'>
                                                        <p>这个账户没有更多的合作伙伴 </p>
                                            </ul>
                                        </div>
                                    </div>
                            </div>";
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
