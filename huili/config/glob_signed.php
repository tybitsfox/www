<?php
$SIGNED_DEF['LOGO']	=	constant('WORK_PLACE')."images/logo/logo.png5.png";
$SIGNED_DEF['PICADD']	=	constant('WORK_PLACE')."images/logo/picto-connect-widget.png";
$SIGNED_DEF['LINK']	=	constant("WORK_PLACE")."include/home.php";
$SIGNED_DEF['LOGO_ALT']	=	"汇氏环境";
$SIGNED_DEF['WRAP_TIL1']	=	"切换导航";
$SIGNED_DEF['WRAP_TIL2']	=	"菜单";
$SIGNED_DEF['LMENU_LINK1']	=	constant('WORK_PLACE')."include/home.php";
$SIGNED_DEF['USER_NAME']	=	"tybitsfox";	//这个将来要被session变量替换
$SIGNED_PAGE['ONE']		=	md5('profile');
//$SIGNED_PAGE['TWO']		=	md5('password');
//$SIGNED_PAGE['THR']		=	md5('account');
$SIGNED_PAGE['FUR']		=	md5('invite');
$SIGNED_PAGE['FIV']		=	md5('collaborate');
$SIGNED_PAGE['SIX']		=	md5('security');
$SIGNED_PAGE['SEV']		=	md5('share');
$SIGNED_PAGE['EIG']		=	md5('signout');
$SIGNED_PAGE['NIN']		=	md5('administrator');
$SIGNED_PAGE['ADD']		=	md5('adding');
$SIGNED_PAGE['GJ1']		=	md5('zixun');
$SIGNED_PAGE['GJ2']		=	md5('gongcheng');
$SIGNED_PAGE['GJ3']		=	md5('jiance');
$SIGNED_PAGE['GJ4']		=	md5('yanshou');
$SIGNED_PAGE['GJ5']		=	md5('qingjie');
$SIGNED_PAGE['GJ6']		=	md5('weifei');
$SIGNED_PAGE['GJ7']		=	md5('yingji');
$SIGNED_PAGE['GJ8']		=	md5('shenbao');
$SIGNED_PAGE['GJ9']		=	md5('minglu');
$SIGNED_PAGE['GJ10']		=	md5('anli');
$SIGNED_PAGE['GJ11']		=	md5('jishu');
$SIGNED_PAGE['GJ12']		=	md5('fagui');
$SIGNED_PAGE['GJ13']		=	md5('xiazai');
$SIGNED_PAGE['GJ14']		=	md5('zhuanjia');
$SIGNED_PAGE['GJ15']		=	md5('pingtai');
$SIGNED_PAGE['GJ16']		=	md5('weibo');
$SIGNED_PAGE['UPD']		=	md5('update');
//$SIGNED_PAGE['THRR']	=	md5('qiandao');
//		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['TWO'],"密码","icon-key"),
//		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['THR'],"账户","icon-envelope"),

$SIGNED_DEF['PROFILE']	=	array(
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE'],"个人信息","icon-address-book"),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FUR'],"邀请好友","icon-user-plus"),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FIV'],"我的合作","icon-earth"),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['SIX'],"安全","icon-shield"),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['SEV'],"认证","icon-finder"),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['NIN'],"管理","icon-gear"),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['EIG'],"退出帐号","icon-exit"));
//下面这个队列变量，将来要被数据库中的数据替代，用户选择的功能从数据库中读取，并显示出来
//子队列元素依次为：链接、链接名称、class、id、图标class
$SIGNED_DEF['DASHBOARD']	=	array(
		array($SIGNED_DEF['LINK']."?select=".md5('profile'),$SIGNED_DEF['USER_NAME'],"btn","","",$SIGNED_PAGE['ONE']),
		array($SIGNED_DEF['LINK'],"导航栏","","chlink00","",""),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ADD'],"添加功能","btn-addmerchant","chlink1","icon-plus",$SIGNED_PAGE['ADD']));
//下面为全部可选模块的信息，子队列元素内容同上
$SIGNED_DEF['MODULE']	= array(
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ1'],"环评咨询","with-name","chlink2","icon-gear",$SIGNED_PAGE['GJ1']),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ2'],"环境工程","with-name","chlink3","icon-truck",$SIGNED_PAGE['GJ2']),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ3'],"环境监测","with-name","chlink4","icon-flask",$SIGNED_PAGE['GJ3']),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ4'],"项目验收","with-name","chlink5","icon-pagelines",$SIGNED_PAGE['GJ4']),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ5'],"清洁生产","with-name","chlink6","icon-recycle",$SIGNED_PAGE['GJ5']),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ6'],"危废服务","with-name","chlink7","icon-fire",$SIGNED_PAGE['GJ6']),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ7'],"应急预案","with-name","chlink8","icon-calendar-check-o",$SIGNED_PAGE['GJ7']),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ8'],"排污申报","with-name","chlink9","icon-pencil",$SIGNED_PAGE['GJ8']),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ9'],"企业名录","with-name","chlink10","icon-book",$SIGNED_PAGE['GJ9']),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ10'],"环境案例","with-name","chlink11","icon-snapchat-ghost",$SIGNED_PAGE['GJ10']),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ11'],"技术动态","with-name","chlink12","icon-joomla",$SIGNED_PAGE['GJ11']),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ12'],"环境法规","with-name","chlink13","icon-wpforms",$SIGNED_PAGE['GJ12']),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ13'],"资料下载","with-name","chlink14","icon-download",$SIGNED_PAGE['GJ13']),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ14'],"专家团队","with-name","chlink15","icon-group",$SIGNED_PAGE['GJ14']),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ15'],"监控平台","with-name","chlink16","icon-desktop",$SIGNED_PAGE['GJ15']),
		array($SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ16'],"交流互动","with-name","chlink17","icon-cchat",$SIGNED_PAGE['GJ16']));
$SIGNED_DEF['PICTO_PNG']	=	constant('WORK_PLACE')."images/logo/picto-empty.png";
$SIGNED_DEF['TOP_TEXT1']	=	"我们还没同步您的关注的业务模块<br>请在此选择您感兴趣的业务模块以加入到关注中";
//{{{wrapper&head
$SIG_HTML['WRAP']	=	"<div id='wrapper' class='l-content-wrapper-sticky-footer'><div><div class='alert-offset-side'><!--react-empty: 2--></div></div><div class='mobile-bar'><div class='logobox'><a href='".$SIGNED_DEF['LINK']."'><img class='logo' src='".$SIGNED_DEF['LOGO']."' alt='".$SIGNED_DEF['LOGO_ALT']."'></a></div><div class='mobile-menu'><button type='button' class='navbar-toggle'><span class='sr-only'>".$SIGNED_DEF['WRAP_TIL1']."</span><span class='title'>".$SIGNED_DEF['WRAP_TIL2']."</span><span class='bars'><span class='icon-bar icon-bar1'></span><span class='icon-bar icon-bar2'></span><span class='icon-bar icon-bar3'></span></span></button></div></div>";
//}}}
//{{{LEFT_TOP	RIGHT_TOP MODULE_ADD
$s1=strtoupper(substr($SIGNED_DEF['USER_NAME'],0,1));
//左边导航栏logo及个人设置链接显示代码
$SIG_HTML['LEFT_TOP1']	=	"<section class='side' id='sidebar'><!-- Header --><a href='".$SIGNED_DEF['LINK']."'><div class='side-head'><img class='logo' src='".$SIGNED_DEF['LOGO']."' alt='".$SIGNED_DEF['LOGO_ALT']."'></div></a><!-- User Menu --><div class='side-user'><div class='dropdown'><a href='".$SIGNED_DEF['DASHBOARD'][0][0]."' class='".$SIGNED_DEF['DASHBOARD'][0][2]."'><div class='usercircle'>%s</div><strong> %s</strong><br/></a></div></div><!-- Navigation --><nav>";
//左边总导航栏显示代码
$SIG_HTML['LEFT_TOP2'] = "<ul class='list-unstyled list-nav left-nav'><li><a id='chlink00' class='".$SIGNED_DEF['DASHBOARD'][1][2]."' href='".$SIGNED_DEF['DASHBOARD'][1][0]."'>".$SIGNED_DEF['DASHBOARD'][1][1]."</a></li>";
//左边已选择模块及模块添加链接显示代码
$SIG_HTML['LEFT_REP']	= "<li><a id='%s' href='%s' class='%s'>%s<i class='%s'></i></a></li>";
//左边导航栏结束显示代码
$SIG_HTML['LEFT_TOP3']	=	"</ul></nav></section>";
//右边抬头显示代码
$SIG_HTML['RIGHT_TOP1']	=	"<section class='content'><ol id='main_bread_crumb' class='breadcrumb'><li>%s</li></ol><div class='inner' id='modal_container' >";
//右边默认界面及默认界面的展开代码
$SIG_HTML['RIGHT_TOP2']	=	"<div class='tab-content'><div role='tabpanel' class='tab-pane tab-pane-naked active' id='latestorders'><section><div class='orders-empty panel'><img class='picto' src='".$SIGNED_DEF['PICTO_PNG']."' alt='空'><p>%s</p><a id='btslide1' href='#' class='btn btn-primary withlasticon'>添加<i class='icon-plus'></i></a></div></section></div></div>";
$SIG_HTML['RIGHT_TOP_REPB'] =	"<div class='connect-overlay'>\n<a href='#' class='btn-closeoverlay btn-closeconnectmore'><i class='icon-x'></i></a>\n<!-- Connect Widget -->\n<div class='connect intro'>\n<div class='picto'>\n<img src='/huili/images/logo/picto-connect-widget-dark.png' alt='连接模块'/>\n</div>\n<p class='intro'>测试界面，功能模块的代码还未添加。</p>\n<ul class='list-inline list-connect'>\n";
$SIG_HTML['RIGHT_TOP_REPE']	=	"</ul>\n<div class='connect-close'>\n<a href='#' class='btn-text btn-closeconnectmore'>暂时不选.</a>\n</div>\n</div> <!-- End Connect Widget -->\n</div> <!-- End Connect Widget in Overlay -->\n";
$SIG_HTML['RIGHT_TOP_REP']	=	"<li class='animatedalt animated'>\n<a href='javascript:;' onclick='set_min(\"%s\");'>\n<div class='vendor'>\n<i class='%s'></i>\n</div>\n<div class='btn btn-primary withlasticon'>%s<i id='%s' class='icon-plus'></i></div>\n</a></li>\n";
//模块添加链接的显示代码
$SIG_HTML['RIGHT_ADD1']	=	"<div class='center-items'>\n<!-- Connect Widget -->\n<div class='connect'>\n<div class='picto animated'>\n<img src='".$SIGNED_DEF['PICADD']."' alt='连接应用模块'/>\n</div>\n<p class='intro'>选择您感兴趣的应用模块.</p>\n<ul class='list-inline list-connect'>\n";
$SIG_HTML['RIGHT_ADD_REP']	=	"<li class='animatedalt animated'>\n<a href='javascript:;' onclick='set_min(\"%s\");'>\n<div class='vendor'>\n<i class='%s'></i></div><div class='btn btn-primary withlasticon'>%s<i id='%s' class='icon-plus'></i></div></a></li>";
$SIG_HTML['RIGHT_ADD2'] = "</ul><form method='post' action='/huili/include/home.php'><br><button type='submit' class='btn btn-primary'>更新选择 <i class='icon-ok'></i></button><input type='hidden' value='' name='upmodule' id='upmodule'></form></div></div>";
//登录后界面的结束代码
$SIG_HTML['RIGHT_TOP3']	=	"</div></section></div></body></html>";
//}}}
//{{{LEFT_PROFILE
$SIG_HTML['PROFILE1']	=	"
	<ul class='list-unstyled list-nav'>\n
	  <li><a href='/app/settings/profile'>个人信息<i class='icon-address-book'></i></a></li>\n
      <li><a href='/app/settings/password'>密码<i class='icon-key'></i></a></li>\n
      <li><a href='/app/settings/accounts'>账户<i class='icon-envelope'></i></a></li>\n
      <li><a href='/app/settings/invite'>邀请好友<i class='icon-user-plus'></i></a></li>\n
      <li><a href='/app/settings/collaborate'>我的合作<i class='icon-earth'></i></a></li>\n
      <li><a href='/app/settings/security'>安全<i class='icon-shield'></i></a></li>\n
      <li><a href='/app/settings/developer'>分享<i class='icon-finder'></i></a></li>\n
      <li><a href='/auth/signout'>退出账户<i class='icon-exit'></i></a></li>\n
    </ul>\n";
$SIG_HTML['LEFT_MENU']	=	"<section class='side'><a href='".$SIGNED_DEF['LINK']."'><div class='side-head'><img class='logo' src='".$SIGNED_DEF['LOGO']."' alt='".$SIGNED_DEF['LOGO_ALT']."'></div></a><div class='side-user'>\n<div class='dropdown'>\n<a href='".$SIGNED_DEF['LMENU_LINK1']."' class='btn'>\n<div class='usercircle'>T</div>\n<strong>".$SIGNED_DEF['USER_NAME']."</strong><br/>\n</a>\n</div>\n</div>\n<nav>\n<div class='addmerchant'>\n<a href='".$SIGNED_DEF['LINK']."' class='btn btn-text withfronticon'><i class='icon-arrow'></i>返回导航栏</a>\n</div>\n
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
                        <div class='alert alert-success alert-inline' role='alert'>
                            个人信息已经更新
                        </div>					
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
