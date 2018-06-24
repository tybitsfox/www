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
		$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li><a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>设置</a></li><li>我的合作";
		$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
		echo $st1;
		echo "<div class='inner' id='modal_container' >\n<h2 class='sect first'>设置 / 我的合作</h2>\n";
		$st1="<div class='block'>
            <div class='panel shadow'>
                <!-- Nav tabs -->
                <ul class='nav nav-tabs nav-tabs-hor' role='tablist'>
                        <li role='presentation' class='active'><a href='#share' aria-controls='share' role='tab' data-toggle='tab' data-history-enabled>我邀请的合作</a></li>
                        <li role='presentation' class=''><a href='#sharedwith' aria-controls='sharedwith' role='tab' data-toggle='tab' data-history-enabled>邀请我的合作</a></li>
                </ul>
                <div class='body'>                
                    <div class='body body-settings'>
                        <div class='tab-content'>

                            <!-- Tab 1 -->
                                <div role='tabpanel' class='tab-pane active' id='share'>
                                    <div class='inner-narrow inner-midnarrow'>

    <div class='intro-block intro-block-slim'>
        <p>我邀请的合作伙伴.</p>
    </div>

                <div class='nav-vendors'>
                    <!-- Vendor nav -->
                    <ul class='nav nav-tabs nav-tabs-vertical' role='tablist'>
                            <li role='presentation' class=''>
                                <a href='#vendor-amazon' aria-controls='amazon' role='tab' data-toggle='tab'>
                                    <i class='icon-truck'></i><span>专家团队</span>
                                </a>
                            </li>
                            <li role='presentation' class='active'>
                                <a href='#vendor-github' aria-controls='github' role='tab' data-toggle='tab'>
                                    <i class='icon-user'></i><span>业务伙伴</span>
                                </a>
							</li>
                    </ul>

                    <!-- Vendor Panes -->
                    <div class='tab-content tab-content-vertical'>
                            <div role='tabpanel' class='tab-pane' id='vendor-amazon'>
                                    <div class='shareblock'>
                                        <div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><span class='light'>合作伙伴:</span> <strong><span class='account-truncated'>周洁</span></strong></p>
                                            <a href='/app/accounts/6adgokW5xo/edit?tab=collaborators' class='btn btn-primary withicon btn-shareaccount' data-toggle-inactive='modal' data-target='#modal-shareaccount'><i class='icon-pencil'></i> 开始交流</a>
                                        </div>
                                        <div class='shareblock-head shareblock-head-light'>
                                            <p class='shareblock-account'><span class='light'>合作伙伴:</span> <strong><span class='account-truncated'>孙国在</span></strong></p>
                                            <a href='/app/accounts/6adgokW5xo/edit?tab=collaborators' class='btn btn-primary withicon btn-shareaccount' data-toggle-inactive='modal' data-target='#modal-shareaccount'><i class='icon-pencil'></i> 开始交流</a>
                                        </div>

                                        <div class='shareblock-body'>
                                            <ul class='list-unstyled list-shares'>
                                                        <p>这个账户没有更多的合作伙伴 </p>
                                            </ul>
                                        </div>
                                    </div>
                            </div>
					<!-- my add -->
                            <div role='tabpanel' class='tab-pane active' id='vendor-github'>
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
                                </div>
                            
                                <div role='tabpanel' class='tab-pane ' id='sharedwith'>
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
    </div>";
		echo $st1;
		echo $SIG_HTML['RIGHT_TOP3'];
?>
