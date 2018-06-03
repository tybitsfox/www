<?php
$SIGNED_DEF['LOGO']	=	constant('WORK_PLACE')."images/logo/logo.png5.png";
$SIGNED_DEF['HOME_LINK']	=	constant("WORK_PLACE")."include/home.php";
$SIGNED_DEF['LOGO_ALT']	=	"汇氏环境";
$SIGNED_DEF['WRAP_TIL1']	=	"切换导航";
$SIGNED_DEF['WRAP_TIL2']	=	"菜单";
$SIGNED_DEF['LMENU_LINK1']	=	constant('WORK_PLACE')."include/home.php";
$SIGNED_DEF['USER_NAME']	=	"tybitsfox";	//这个将来要被session变量替换

//{{{wrapper&head
$SIG_HTML['WRAP']	=	"<div id='wrapper' class='l-content-wrapper-sticky-footer'><div><script type='text/javascript'>react.renderInlineToDOM(react.FlashNotificationContainer, {}, reduxStore);</script></div><div class='mobile-bar'><div class='logobox'><a href='".$SIGNED_DEF['HOME_LINK']."'><img class='logo' src='".$SIGNED_DEF['LOGO']."' alt='".$SIGNED_DEF['LOGO_ALT']."'></a></div><div class='mobile-menu'><button type='button' class='navbar-toggle'><span class='sr-only'>".$SIGNED_DEF['WRAP_TIL1']."</span><span class='title'>".$SIGNED_DEF['WRAP_TIL2']."</span><span class='bars'><span class='icon-bar icon-bar1'></span><span class='icon-bar icon-bar2'></span><span class='icon-bar icon-bar3'></span></span></button></div></div>";
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


//}}}

?>
