<?php
$SIGNED_DEF['LOGO']	=	constant('WORK_PLACE')."images/logo/logo.png5.png";
$SIGNED_DEF['HOME_LINK']	=	constant("WORK_PLACE")."include/home.php";
$SIGNED_DEF['LOGO_ALT']	=	"汇氏环境";
$SIGNED_DEF['WRAP_TIL1']	=	"切换导航";
$SIGNED_DEF['WRAP_TIL2']	=	"菜单";
$SIGNED_DEF['LMENU_LINK1']	=	constant('WORK_PLACE')."include/home.php";
$SIGNED_DEF['USER_NAME']	=	"tybitsfox";	//这个将来要被session变量替换
$SIGNED_PAGE['ONE']		=	md5('profile');
$SIGNED_PAGE['TWO']		=	md5('password');
$SIGNED_PAGE['THR']		=	md5('account');
$SIGNED_PAGE['FUR']		=	md5('invite');
$SIGNED_PAGE['FIV']		=	md5('collaborate');
$SIGNED_PAGE['SIX']		=	md5('security');
$SIGNED_PAGE['SEV']		=	md5('share');
$SIGNED_PAGE['EIG']		=	md5('signout');
$SIGNED_DEF['PROFILE']	=	array(
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE'],"个人信息"),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['TWO'],"密码"),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['THR'],"账户"),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FUR'],"邀请好友"),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV'],"我的合作"),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['SIX'],"安全"),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['SEV'],"分享"),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['EIG'],"退出帐号"));
//下面这个队列变量，将来要被数据库中的数据替代，用户选择的功能从数据库中读取，并显示出来
$SIGNED_DEF['DASHBOARD']	=	array(
		array($SIGNED_DEF['LINK']."?select=".md5('profile'),$SIGNED_DEF['USER_NAME'],"btn"),
		array($SIGNED_DEF['LINK'],"导航栏","active"),
		array($SIGNED_DEF['LINK']."?select=".md5('huanping'),"环评咨询","with-name"),
		array($SIGNED_DEF['LINK']."?select=".md5('adding'),"添加功能","btn-addmerchant"));
$SIGNED_DEF['PICTO_PNG']	=	constant('WORK_PLACE')."images/logo/picto-empty.png";
$SIGNED_DEF['TOP_TEXT1']	=	"我们还没同步您的关注的业务模块<br>请在此选择您感兴趣的业务模块以加入到关注中";
//{{{wrapper&head
$SIG_HTML['WRAP']	=	"<div id='wrapper' class='l-content-wrapper-sticky-footer'><div><div class='alert-offset-side'><!--react-empty: 2--></div></div><div class='mobile-bar'><div class='logobox'><a href='".$SIGNED_DEF['HOME_LINK']."'><img class='logo' src='".$SIGNED_DEF['LOGO']."' alt='".$SIGNED_DEF['LOGO_ALT']."'></a></div><div class='mobile-menu'><button type='button' class='navbar-toggle'><span class='sr-only'>".$SIGNED_DEF['WRAP_TIL1']."</span><span class='title'>".$SIGNED_DEF['WRAP_TIL2']."</span><span class='bars'><span class='icon-bar icon-bar1'></span><span class='icon-bar icon-bar2'></span><span class='icon-bar icon-bar3'></span></span></button></div></div>";
//}}}
//{{{LEFT_TOP	RIGHT_TOP
$s1=strtoupper(substr($SIGNED_DEF['USER_NAME'],0,1));
$SIG_HTML['LEFT_TOP1']	=	"<section class='side' id='sidebar'><!-- Header --><a href='".$SIGNED_DEF['HOME_LINK']."'><div class='side-head'><img class='logo' src='".$SIGNED_DEF['LOGO']."' alt='".$SIGNED_DEF['LOGO_ALT']."'></div></a><!-- User Menu --><div class='side-user'><div class='dropdown'><a href='".$SIGNED_DEF['DASHBOARD'][0][0]."' class='".$SIGNED_DEF['DASHBOARD'][0][2]."'><div class='usercircle'>%s</div><strong> %s</strong><br/></a></div></div>";
//$SIG_HTML['LEFT_TOP1']	=	"<section class='side' id='sidebar'><!-- Header --><a href='".$SIGNED_DEF['HOME_LINK']."'><div class='side-head'><img class='logo' src='".$SIGNED_DEF['LOGO']."' alt='".$SIGNED_DEF['LOGO_ALT']."'></div></a><!-- User Menu --><div class='side-user'><div class='dropdown'><a href='".$SIGNED_DEF['DASHBOARD'][0][0]."' class='".$SIGNED_DEF['DASHBOARD'][0][2]."'><div class='usercircle'>".$s1."</div><strong>".$SIGNED_DEF['DASHBOARD'][0][1]."</strong><br/></a></div></div>";
$SIG_HTML['LEFT_TOP2'] = "<!-- Navigation --><nav><div><ul class='list-unstyled list-nav left-nav'><li><a class='".$SIGNED_DEF['DASHBOARD'][1][2]."' href='".$SIGNED_DEF['DASHBOARD'][1][0]."'>".$SIGNED_DEF['DASHBOARD'][1][1]."</a></li>";
$SIG_HTML['LEFT_REP1']	= "<li><a href='".$SIGNED_DEF['DASHBOARD'][2][0]."' class='".$SIGNED_DEF['DASHBOARD'][2][2]."'>".$SIGNED_DEF['DASHBOARD'][2][1]."<i class='icon-gear'></i><span class='left-nav'>tyyyyt@163.com</span></a></li>";
$SIG_HTML['LEFT_REP']	= "<li><a href='%s' class='with-name'>%s<i class='%s'></i></a></li>";
$SIG_HTML['LEFT_REP2']	= "<li><a href='".$SIGNED_DEF['DASHBOARD'][3][0]."' class='".$SIGNED_DEF['DASHBOARD'][3][2]."'>".$SIGNED_DEF['DASHBOARD'][3][1]."<i class='icon-plus'></i></a></li>";
$SIG_HTML['LEFT_TOP3']	=	"</ul></nav></section>";
$SIG_HTML['RIGHT_TOP1']	=	"<section class='content'><ol id='main_bread_crumb' class='breadcrumb'><li>主页</li></ol><div class='inner' id='modal_container' >";
$SIG_HTML['RIGHT_TOP2']	=	"<div class='tab-content'><div role='tabpanel' class='tab-pane tab-pane-naked active' id='latestorders'><section><div class='orders-empty panel'><img class='picto' src='".$SIGNED_DEF['PICTO_PNG']."' alt='空'><p>".$SIGNED_DEF['TOP_TEXT1']."</p><a href='#' class='btn btn-primary btn-connectmore withlasticon'>添加<i class='icon-plus'></i></a></div></section></div></div>";
$SIG_HTML['RIGHT_TOP_REP']	=	"
<div class='connect-overlay'>
  <a href='#' class='btn-closeoverlay btn-closeconnectmore'><i class='icon-x'></i></a>
  <!-- Connect Widget -->
  <div class='connect intro'>
    <div class='picto'>
      <img src='./assets/images/picto-connect-widget-dark.png' alt='Connect Vendors'/>
    </div>
    <p class='intro'>Please select a vendor below and connect your account to access purchase history.</p>
    <ul class='list-inline list-connect'>
    <li class='animatedalt animated'>
      <a href='/app/connects/alaska'>
        <div class='vendor'>
          <i class='icon-alaska'></i>
        </div>
        <div class='btn btn-primary withlasticon'>Connect<i class='icon-plus'></i></div>
      </a>
    </li>
    <li class='animatedalt animated'>
      <a href='/app/connects/amazon'>
        <div class='vendor'>
          <i class='icon-amazon'></i>
        </div>
        <div class='btn btn-primary withlasticon'>Connect<i class='icon-plus'></i></div>
      </a>
    </li>
    <li class='animatedalt animated'>
      <a href='/app/connects/apple'>
        <div class='vendor'>
          <i class='icon-apple'></i>
        </div>
        <div class='btn btn-primary withlasticon'>Connect<i class='icon-plus'></i></div>
      </a>
    </li>
    <li class='animatedalt animated'>
      <a href='/app/connects/bestbuy'>
        <div class='vendor'>
          <i class='icon-bestbuy'></i>
        </div>
        <div class='btn btn-primary withlasticon'>Connect<i class='icon-plus'></i></div>
      </a>
    </li>
    <li class='animatedalt animated'>
      <a href='/app/connects/delta'>
        <div class='vendor'>
          <i class='icon-delta'></i>
        </div>
        <div class='btn btn-primary withlasticon'>Connect<i class='icon-plus'></i></div>
      </a>
    </li>
    <li class='animatedalt animated'>
      <a href='/app/connects/ebay'>
        <div class='vendor'>
          <i class='icon-ebay'></i>
        </div>
        <div class='btn btn-primary withlasticon'>Connect<i class='icon-plus'></i></div>
      </a>
    </li>
</ul>
    <div class='connect-close'>
      <a href='#' class='btn-text btn-closeconnectmore'>Not now.</a>
    </div>
  </div> <!-- End Connect Widget -->
</div> <!-- End Connect Widget in Overlay -->
";
$SIG_HTML['RIGHT_TOP3']	=	"</div></section></div></body></html>";
//}}}
//{{{LEFT_PROFILE
$SIG_HTML['LEFT_MENU']	=	"<section class='side'><a href='".$SIGNED_DEF['HOME_LINK']."'><div class='side-head'><img class='logo' src='".$SIGNED_DEF['LOGO']."' alt='".$SIGNED_DEF['LOGO_ALT']."'></div></a><div class='side-user'>\n<div class='dropdown'>\n<a href='".$SIGNED_DEF['LMENU_LINK1']."' class='btn'>\n<div class='usercircle'>T</div>\n<strong>".$SIGNED_DEF['USER_NAME']."</strong><br/>\n</a>\n</div>\n</div>\n<nav>\n<div class='addmerchant'>\n<a href='".$SIGNED_DEF['HOME_LINK']."' class='btn btn-text withfronticon'><i class='icon-arrow'></i>返回导航栏</a>\n</div>\n
	<ul class='list-unstyled list-nav'>\n
	  <li><a href='/app/settings/profile'>个人信息</a></li>\n
      <li><a href='/app/settings/password'>密码</a></li>\n
      <li><a href='/app/settings/accounts'>账户</a></li>\n
      <li><a href='/app/settings/invite'>邀请好友</a></li>\n
      <li><a href='/app/settings/collaborate'>我的合作</a></li>\n
      <li><a href='/app/settings/security'>安全</a></li>\n
      <li><a href='/app/settings/developer'>分享</a></li>\n
      <li><a href='/auth/signout'>退出账户</a></li>\n
    </ul>\n</nav>\n</section>\n";
$SIG_HTML['MAIN_MENU']="<section class='content'>\n
                <ol id='main_bread_crumb' class='breadcrumb'>\n
        <li><a href='/app/home'>主目录</a></li>\n
        <li><a href='/app/settings/profile'>设置</a></li>\n
        <li>个人信息</li>\n
		</ol>\n
                <div class='inner' id='modal_container' >\n
                      <h2 class='sect first'>设置 / 个人信息</h2>\n
  <!-- Panel -->\n
  <div class='block'>\n
    <div class='panel shadow'>\n
        <div class='body body-settings'>\n
            <div class='inner-narrow'>\n
                <div class='intro-block'>\n
                    <h3>您的个人信息设置</h3>\n
                </div>\n
                <form class='form form-horizontal form-boxed' method='post' action='/app/settings/profile/identity'>\n
                    <input type='hidden' value='b9524312-d7e6-41d7-93b3-b0645c5646cd' name='authenticityToken' />\n
                    <div class='form-group'>\n
                      <label>更新您的昵称</label>\n
                      <div class='form-split'>\n
                        <input name='name' id='name' class='form-control inlined' value='tybitsfox' required/>\n
                        <button type='submit' class='btn btn-primary'>更新</button>\n
                      </div>\n
                    </div>\n
                </form>\n
                <form class='form form-horizontal form-boxed' method='post' action='/app/settings/profile/email'>\n
                    <input type='hidden' value='b9524312-d7e6-41d7-93b3-b0645c5646cd' name='authenticityToken' />\n
                    <div class='form-group'>\n
                      <label>更新您的邮箱</label>\n
                      <div class='form-split'>\n
                        <input type='email' name='email' id='email' class='form-control inlined'  value='tyyyyt@163.com' required/>\n
                        <input type='submit' class='btn btn-primary' value='更新邮箱' />\n
                      </div>\n
                    </div>\n
                </form>\n
                <form class='form form-horizontal form-boxed' method='post' action='/app/settings/profile/email'>\n
                    <div class='form-group'>\n
                      <label>下拉菜单测试</label>\n
                      <div class='form-split'>\n
					<select name='sel1'>
					<option value='table:auth' selected='selected'>数据库表：auth</option>
					<option value='table:blog' >数据库表：blog</option>
					<option value='table:member' >数据库表：member</option>
					</select>
                      </div>\n
                    </div>\n
                </form>\n

            </div>\n
          </div>\n
      </div>\n
    </div>\n
  </div>\n
  </div>\n
  </section>\n
  </div>\n
</body></html>";
$SIG_HTML['MAIN_NAVTAB']="<section class='content'>\n
                <ol id='main_bread_crumb' class='breadcrumb'>\n
        <li><a href='/app/home'>主目录</a></li>\n
        <li><a href='/app/settings/profile'>设置</a></li>\n
        <li>个人信息</li>\n
		</ol>\n
                <div class='inner' id='modal_container' >\n
                      <h2 class='sect first'>设置 / 个人信息</h2>\n
  <!-- Panel -->\n
  <div class='block'>\n
    <div class='panel shadow'>\n
";

//}}}

?>
