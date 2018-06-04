<?php
/**
 @package		huili manager
 @version		0.0.0.1
 @author		田勇 Alisa tybitsfox <tybitsfox@163.com>
 @license		GPLv2

本文件是用户登录前所需的全局变量和常量的定义文件
 **/
?>
<?php
//{{{ 变量定义
$GLOB_DEF['TITLE']	=	"山东汇氏集团-汇氏管家";
$GLOB_DEF['IDX']	=	constant("WORK_PLACE")."index.php";
$GLOB_DEF['LOGO']	=	constant("WORK_PLACE")."images/logo/logo.png5.png";
$GLOB_DEF['LOGO_ALT']	=	"huishi group";
$GLOB_DEF['EMAIL']	=	constant("FULL_PATH")."include/vbvb.txt";
$GLOB_DEF['PG_ONE']	=	md5("huishi_Aa123BbCc");
$GLOB_DEF['PG_TWO']	=	md5("huishi_Dd456EeFf");
$GLOB_DEF['PG_THR']	=	md5("huishi_Gg789HhIi");
$GLOB_DEF['PG_FUR']	=	md5("huishi_Jj012KkLl");
$GLOB_DEF['PG_FIV']	=	md5("huishi_Mm345NnOo");
$GLOB_DEF['MSG_HOME_TITLE']	=	"懂你所需、做你所想";
$GLOB_DEF['MSG_HOME_CON']	=	"汇氏环保管家，是目前国内环保行业唯一的线上线下联动、一站式、全流程的第三方服务平台。公司现已通过本平台发展形成线上线下专业环保服务团队和国内领先的环保供应链体系。未来，公司将以绿色环保科技为努力方向，打造国内最大最专业的环保咨询服务平台。";
$GLOB_DEF['FEAT_TITLE_1']	=	"平台的特性";
$GLOB_DEF['FEAT_TITLE_2']	=	"汇氏管家，为您的成功助力。";
$GLOB_DEF['FEAT_TITLE_3']	=	"汇氏管家就是为需要解决环境问题的客户、环境问题专家及环保企业建立一个互联互通的简易而且直观的交流互动平台";
$GLOB_DEF['FEAT_MSG_M']	=	"环保管家服务为企业提供一站式环保托管服务，统筹解决企业环境问题；提高决策科学性，保证服务效果，有效降低企业环保管理成本；同时降低环境产业链各个环节脱节产生的高昂交易成本。是传统环保服务的升级衍生业务，全方面帮助企业实施管理服务，减少企业用人成本，提升企业环境面貌，解决企业因环保而带来的烦恼。";
$GLOB_DEF['FEAT_IMG_1']	=	"/huili/images/logo/picto-connect.png";
$GLOB_DEF['FEAT_IMG_2']	=	"/huili/images/logo/picto-spending.png";
$GLOB_DEF['FEAT_IMG_3']	=	"/huili/images/logo/picto-quickbooks.png";
$GLOB_DEF['FEAT_MSG_A1']	=	"互联的平台";
$GLOB_DEF['FEAT_MSG_A2']	=	"顺畅的沟通是您发挥才能，展示产品和服务，取得最优解决方案的保证。";
$GLOB_DEF['FEAT_MSG_B1']	=	"优质的服务";
$GLOB_DEF['FEAT_MSG_B2']	=	"平台围绕环评咨询、环境工程、环境监测、项目验收、清洁生产、应急预案、危废服务、排污申报等领域，提供政策信息咨询、业务辅导、工程施工等专业化咨询服务。";
$GLOB_DEF['FEAT_MSG_C1']	=	"完整的资源";
$GLOB_DEF['FEAT_MSG_C2']	=	"各类在线实时监控数据的发布以及全面的企业和专家名录满足您的需要。";
$GLOB_DEF['EXPE_TITLE_1']	=	"NETWORK";
$GLOB_DEF['EXPE_TITLE_2']	=	"利用环境管家简化您的环境问题";
$GLOB_DEF['EXPE_TITLE_3']	=	"汇氏管家将所有的环境服务整合在一起";
$GLOB_DEF['EXPE_TITLE_4']	=	"了解更多";
$GLOB_DEF['EXPE_TITLE_IMG']	=	"/huili/images/logo/img-arrow-large.png";
$GLOB_DEF['EXPE_MSG_1']		=	"汇氏管家就是资源的整合";
$GLOB_DEF['EXPE_MSG_2']		=	"更多的整合意味着更宽广的视野和更加高度的自动化";
$GLOB_DEF['EXPE_MSG_3']		=	"这里没有你需要的资源?";
$GLOB_DEF['EXPE_MSG_4']		=	"联系我们";
$GLOB_DEF['EXPE_MSG_5']		=	"我们会在这个平台下加入他.";
//在这里定义的所有array变量都是临时的，将来这些数据都取自数据库
$GLOB_DEF['EXPE_ARRY']		=	array(
		array('/huili/include/login.php','icon-gear','环评咨询'),
		array('/huili/include/login.php','icon-truck','环境工程'),
		array('/huili/include/login.php','icon-flask','环境监测'),
		array('/huili/include/login.php','icon-pagelines','项目验收'),
		array('/huili/include/login.php','icon-recycle','清洁生产'),
		array('/huili/include/login.php','icon-fire','危废服务'),
		array('/huili/include/login.php','icon-calendar-check-o','应急预案'),
		array('/huili/include/login.php','icon-pencil','排污申报'),
		array('/huili/include/login.php','icon-book','企业名录'),
		array('/huili/include/login.php','icon-snapchat-ghost','环境案例'),
		array('/huili/include/login.php','icon-joomla','技术动态'),
		array('/huili/include/login.php','icon-wpforms','环境法规'),
		array('/huili/include/login.php','icon-download','资料下载')
		);
$GLOB_DEF['ENGIN_TITLE_1']	=	"专家名录";
$GLOB_DEF['ENGIN_TITLE_2']	=	"全领域的环境专家随时为你提供帮助";
$GLOB_DEF['ENGIN_TITLE_3']	=	"汇氏管家随时为您解决环境问题";
$GLOB_DEF['ENGIN_TITLE_4']	=	"了解更多";
$GLOB_DEF['ENGIN_TITLE_IMG']	=	"/huili/images/logo/img-arrow-large.png";
$GLOB_DEF['ENGIN_MSG_1']	=	"汇氏管家提供专业的服务";
$GLOB_DEF['ENGIN_MSG_3']	=	"如果您是一位环境方面的专家或者是一位富有经验的环境工作者，我们期待您的加入";
$GLOB_DEF['ENGIN_MSG_4']	=	"联系我们";
$GLOB_DEF['ENGIN_MSG_5']	=	"我们为您提供一个施展才华的平台.";
$GLOB_DEF['ENGIN_ARRY']		=	array(
		array('/register/signup','/huili/images/avatar_25.jpg','姓名：徐琛','同济大学环境工程系给水排水专业.同济大学博士后流动站工作'),
		array('/register/signup','/huili/images/avatar_39.jpg','姓名：孙国再','法律专家,三级高级检察官.青岛市律师协会生态环资委员会副主任委员',),
		array('/register/signup','/huili/images/05684617086076992_sm.jpg','姓名：周洁','污水治理,污水处理.主持并完成部、省、市和横向科研项目十余项',),
		array('/register/signup','/huili/images/05684620533698581_sm.jpg','姓名：王星星','污水治理,污水处理.煤炭行业（部级）第十六届优秀工程设计二等奖',),
		array('/register/signup','/huili/images/avatar_55.jpg','姓名：杨影影','污水处理,脱硫脱硝.2015山东省煤炭工业科学技术二等奖.',),
		array('/register/signup','/huili/images/logo/guest.png','虚位以待','',),
		array('/register/signup','/huili/images/logo/guest.png','虚位以待','',),
		array('/register/signup','/huili/images/logo/guest.png','虚位以待','',),
		array('/register/signup','/huili/images/logo/guest.png','虚位以待','',),
		array('/register/signup','/huili/images/logo/guest.png','虚位以待','',),
		array('/register/signup','/huili/images/logo/guest.png','虚位以待','',),
		array('/register/signup','/huili/images/logo/guest.png','虚位以待','',)
		);
$GLOB_DEF['PLAT_TITLE_1']	=	"Contact";
$GLOB_DEF['PLAT_TITLE_2']	=	"登录我们的平台,获取更多发布的数据";
$GLOB_DEF['PLAT_TITLE_3']	=	"成为注册用户，即可查看各类监控平台，取得实时发布的监测数据.";
$GLOB_DEF['PLAT_MSG_1']		=	"平台预览";
$GLOB_DEF['PLAT_MSG_2']		=	"多款平台为您提供或发布各类实时数据";
$GLOB_DEF['PLAT_ARRY']		=	array(
		array('/huili/images/logo/home-slider-1.png','Home Depot Account Page','Account Page'),
		array('/huili/images/logo/home-slider-2.png','Connect Page','Connect With Dozens of Vendors'),
		array('/huili/images/logo/home-slider-3.png','Transaction Detail Page (Delta)','Detailed Receipts'),
		array('/huili/images/logo/home-slider-4.png','Home Depot features original receipt view','Original Receipts')
		);
$GLOB_DEF['PLAT_MSG_3']		=	"/huili/index.php?selecter=".$GLOB_DEF['PG_ONE'];
$GLOB_DEF['PLAT_MSG_4']		=	"所有的服务";
$GLOB_DEF['BLOG_TITLE_1']	=	"我们的博客";
$GLOB_DEF['BLOG_TITLE_2']	=	"信息交流，技术探讨，供需发布";
$GLOB_DEF['BLOG_ARRY']		=	array(
		array('/huili/include/blog_show.php','Save Time and Transform Your Business with Connected Accounting','/huili/images/logo/transform-your-business-calculator.jpg','Save Time and Transform Your Business with Connected Accounting','Mar 20, 2018','Save time and transform your business with connected accounting. Cloud accounting is an intelligent choice because it is scalable, cost-effective and easy to use.'),
		array('/huili/include/blog_show.php','Greenback + Xero Accounting Software','/huili/images/logo/greenback-and-xero.png','Greenback + Xero Accounting Software','Feb 14, 2018','Greenback now integrates with Xero and there couldn’t be a better match. Greenback helps automate your accounting by syncing transactions directly from vendors such as Amazon, Home Depot, Delta, eBay, and more with Xero. What sets us apart from all other receipt apps? We’ve eliminated the need for email, photos, scans, and manual data entry.'),
		array('/huili/include/blog_show.php','How To Automate Your Lowe&#39;s In-Store and Online Receipts','/huili/images/logo/greenback-and-lowes-automate-your-receipts.jpg','How To Automate Your Lowe&#39;s In-Store and Online Receipts','Jan 9, 2018 ','Tired of manually scanning receipts or snapping photos for bookkeeping, tax compliance, or invoicing? Constantly searching for misplaced, faded receipts? Whether you are a professional contractor, a DIY weekend warrior, admin assistant, or savvy shopper, you can automate your Lowe&#39;s receipts to streamline your record keeping and sync your receipt data to your accounting platform to save time and money. Luckily, there are automation tools that can help you get a handle of the job. With the Greenback app, you can free up your time for more important things like building stuff.'),
		array('/huili/include/blog_show.php','5 Reasons Why You Need Automated Receipts','/huili/images/logo/greenback-reasons-to-automate.png','5 Reasons Why You Need Automated Receipts','Nov 15, 2017 ','Are you reaping the benefits of accounting in the cloud? Learn how repetitive bookkeeping tasks and data entry can be automated.'),
		array('/huili/include/blog_show.php','How To Automate Your Online and In-Store Home Depot Receipts','/huili/images/logo/automate-home-depot-receipts.jpg','How To Automate Your Online and In-Store Home Depot Receipts','Oct 14, 2017 ','Tired of misplacing, manually scanning/snapping a photo, or hunting down Home Depot receipts for bookkeeping, tax compliance, or invoicing?'),
		array('/huili/include/blog_show.php','Greenback Now Available In QuickBooks App Store','/huili/images/logo/greenback-and-quickbooks.jpg','Greenback Now Available In QuickBooks App Store','May 1, 2017 ','Greenback syncs transactions directly from vendors like Amazon, Home Depot, Delta, eBay, and more to your Quick Books Online account.'),
		array('/huili/include/blog_show.php','How To Automate Home Depot Pro Xtra Receipts','/huili/images/logo/automate-home-depot-pro-receipts.jpg','How To Automate Home Depot Pro Xtra Receipts','Apr 18, 2017 ','Pros need accurate daily expenses by Job Name or PO number, easy to find receipts, tax compliance, and no manual data entry.')
		);
//}}}

//{{{下面定义的是注册、登录、密码找回、验证界面的html代码
$s1="<body class='loginpage'><div class='bg'><div class='loginbox'><form class='form form-landing' action='%s' method='post'>\n";
$s2="<div class='form-login form-box'><div class='side-head'><a href='".$GLOB_DEF['IDX']."'><img class='logo' src='".$GLOB_DEF['LOGO']."' alt='".$GLOB_DEF['LOGO_ALT']."'></a></div>\n";
$OUT_HTML['LOGIN_BODY_1g']	=	$s1.$s2;	//需要指定action.
//$OUT_HTML['LOGIN_BODY_ERR']	=	"<div class='alert alert-danger' role='alert'>%s</div>"; 这里并不需要，错误提示的实现在login类中完成。
$s1="<div class='form-group'><label>邮箱</label><div class='form-suffix'><span class='icon-envelope picto'></span><input id='email' type='email' class='form-control first' name='email' value='' placeholder='Email' autocorrect='off' autocapitalize='none' autocomplete='username' required/></div></div>\n";
$s2="<div class='form-group'><label>密码</label><div class='form-suffix'><span class='icon-key picto'></span><input id='password' type='password' class='form-control last' name='password' value='' placeholder='Password' autocomplete='current-password' required /></div></div>\n";
$s3="<div class='form-group form-twocols'><div class='pass-reset'><a href='./forgot.php' class='btn-text'>是不是忘记密码了?</a></div></div>\n";
$s4="<div class='form-group'><button type='submit' href='#' class='btn btn-primary btn-fat btn-block'>登 录</button></div>\n";
$s5="<div class='form-group form-out'><p>您还没有帐号? <a href='./signup.php' class='btn-text'>注 册</a></p></div>\n";
$OUT_HTML['LOGIN_BODY_2l']	=	$s1.$s2.$s3.$s4.$s5;	//仅登录界面使用
$OUT_HTML['LOGIN_BODY_3g']	=	"</div></form></div></div><footer class='footer'><div class='inner'><div class='row'><div class='col-sm-12'><p class='copy'>&COPY; 2018 汇氏环境, Inc. 保留所有权利</p></div></div></div></footer>\n";
$OUT_HTML['TAIL']	=	"</body></html>\n";
$s1="<h5 class='text-center'>与我们保持联系！</h5><p class='intro'>我们会为您搭建一个提供或享受专业环境服务的平台.</p>";
$s2="<div class='form-group'><label>Email</label><div class='form-suffix'><span class='icon-envelope picto'></span><input id='email' type='email' class='form-control' name='email' value='' placeholder='Your Email' autocorrect='off' autocapitalize='none' autocomplete='username' required/></div></div>";
$s3="<div class='form-group'><button href='#' type='submit' class='btn btn-primary btn-block btn-fat'>开始注册</button></div>";
$s4="<p class='intro'>汇氏管家，品质服务的保证.</p><div class='form-group form-out text-center'><p>您已经拥有帐号? 请选择：<a href='./login.php' class='btn-text'>登 录</a></p></div>";
$OUT_HTML['REG_NORMAL']	= $s1.$s2.$s3.$s4;
$OUT_HTML['REG_AFTER']	= "<h5>注册马上完成!</h5><p class='intro'>我们给<strong>".$_POST["email"]."</strong>.发送了一封邮件，请查阅您的邮箱以完成注册.如果您的邮箱设置了过滤机制，请检查垃圾邮件目录下是否有我们的信件.</p></div>";
$OUT_HTML['VERF_BODY_1l']	=	preg_replace("/form-login/","form-signup",$OUT_HTML['LOGIN_BODY_1g']);
$s1="<p class='intro'>注册邮箱：<strong>%s</strong></p><div class='form-group'><label>Name</label><div class='form-suffix'><span class='icon-lock picto'></span><input id='name' type='password' class='form-control first' placeholder='输入密码' name='new-password' value='' required title='密码必须包含大小写字母、数字以及特殊符号例如：(!@$&*)' /></div></div>";
$s2="<div class='form-group'><label>Password</label><div class='form-suffix'><span class='icon-lock picto'></span><input id='password' type='password' class='form-control last' name='password' value='' placeholder='确认密码' required autocomplete='off' pattern='(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*()+=?_-])(?=.*[0-9]).{8,32}' title='密码必须包含大小写字母、数字以及特殊符号例如：(!@$&*)' />";
$s3="</div><div class='help-block'>密码必须是8-32位字符，且字符中必须出现大小写字母(e.g. Aa), 数字(e.g. 1234), 特殊符号(e.g. !$&*)</div></div>";
$s4="<div class='form-group'><div class='checkbox'><label><input type='checkbox' id='trusted' name='trusted' checked data-ninja-checkbox> 允许自动登录 <span class='helper' data-toggle='tooltip' data-placement='top' title='允许自动登录，意味着您使用的这台设备是安全的，或者这台设备只有您个人使用。这样在每次访问管家时都会自动使用您的帐号登录。如果您不确定这台设备的安全性，请不要选择此项设置，您每次登录都需要输入账号密码验证. '>?</span></label></div></div><div class='form-group form-delimited'><p class='intro'>点击注册意味着您同意我们的 <a href='./terms.php' target='_blank'>服务条款</a> 和 <a href='./privacy.php' target='_blank'>隐私权相关政策</a>. </p></div>";
$s5="<div class='form-group form-delimited'><button type='submit' class='btn btn-primary btn-fat btn-block'>注 册</button></div>";
$OUT_HTML['VERF_BODY_2l']	= $s1;		//需要指定邮箱名称
$OUT_HTML['VERF_BODY_3l']	= $s2.$s3.$s4.$s5;
$OUT_HTML['FORGOT_BODY_1l']	=	"<h5>忘记密码了?</h5>\n<p class='intro'>我们将发送一个重置密码的链接到您的邮箱.</p>\n<div class='form-group'>\n<label>邮箱地址</label><div class='form-suffix'>\n<span class='icon-envelope picto'></span><input type='email' class='form-control' name='email' value='' placeholder='Email' />\n</div></div><div class='form-group'><button class='btn btn-primary btn-fat btn-block'>重置密码</button></div>\n<div class='form-group form-out text-center'> <p>想起密码了? <a href='/huili/include/login.php' class='btn-text btn-backlogin'>登录</a></p></div>\n";
$OUT_HTML['FORGOT_AFTER']	= "<h5>重置马上完成!</h5><p class='intro'>我们给<strong>".$_POST["email"]."</strong>.发送了一封邮件，请查阅您的邮箱以完成密码重置.如果您的邮箱设置了过滤机制，请检查垃圾邮件目录下是否有我们的信件.</p>";
//}}}
//{{{下面定义的是总览界面（登录前）的html代码
$EX_HTML['headbar1']	=	"<div class='mobile-bar'>\n<div class='logobox'>\n<a href='/huili/index.php' title='Huishi Home'>\n<img class='logo' src='/huili/images/logo/logo.png5.png' alt='Huishi'/>\n</a>\n</div>\n<div class='mobile-menu'>\n<button type='button' class='navbar-toggle btn-mobilemenu'>\n<span class='sr-only'>Toggle navigation</span>\n<span class='title'>菜单</span>\n<span class='bars'>\n<span class='icon-bar icon-bar1'></span>\n<span class='icon-bar icon-bar2'></span>\n<span class='icon-bar icon-bar3'></span>\n</span>\n</button>\n</div>\n</div>\n<div class='overlay'></div>\n<header class='header'>\n<nav class='navbar navbar-default'>\n<div class='container-fluid'>\n<div class='navbar-header'>\n<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#mobile-side' aria-expanded='false'>\n<span class='sr-only'>Toggle navigation</span>\n<span class='icon-bar'></span>\n<span class='icon-bar'></span>\n<span class='icon-bar'></span>\n</button>\n<a href='#' class='btn-closemenu'><i class='icon-x'></i></a>\n<a class='navbar-brand' href='/huili/index.php'><img src='/huili/images/logo/logo.png5.png' alt='Huishi'/></a>\n</div>";
$EX_HTML['headbar2']	=	"<div class='collapse navbar-collapse' id='mobile-side'>\n<ul class='nav navbar-nav navbar-right'>\n<li><a href='/huili/index.php?selecter=".$GLOB_DEF['PG_ONE']."' class='tooltip'>管家服务<span class='tooltiptext'>您身边的环境专家，为您提供专业的服务</span></a></li>\n<li><a href='/huili/index.php?selecter=".$GLOB_DEF['PG_THR']."' class='tooltip'>专家团队<span class='tooltiptext'>聚集了环保全领域的资深专家和优秀人才</span></a></li>\n<li><a href='/huili/index.php?selecter=".$GLOB_DEF['PG_TWO']."' class='tooltip'>监控平台<span class='tooltiptext'>污染源、水站、空气站在线监控平台</span></a></li>\n<li><a href='/huili/index.php?selecter=".$GLOB_DEF['PG_FUR']."' class='tooltip'>交流互动<span class='tooltiptext'>在这里发布供求，寻求支持</span></a></li>\n<li class='sec'><a href='/huili/include/login.php' class='btn btn-head-signin tooltip' title=''>登录</a></li>\n<li class='sec'><a href='/huili/include/signup.php' class='btn btn-head-signup' title=''>注册</a></li>\n</ul>\n<ul class='list-unstyled list-mobilebtns'>\n<li><a href='/huili/include/login.php' class='btn btn-outline btn-head-signin' title='登录'>登 录</a></li>\n<li><a href='/huili/include/signup.php' class='btn btn-primary btn-head-signup' title='免费注册'>注 册</a></li>\n</ul>\n</div><!-- /.navbar-collapse -->\n</div><!-- /.container-fluid -->\n</nav>\n</header>\n";
$EX_HTML['home']	=	"<section class='promo promo--home'><div class='container'><div class='promo-msg promo-msg--half'><h1 class='animated'>".$GLOB_DEF['MSG_HOME_TITLE']."</h1><p class='intro animated'>".$GLOB_DEF['MSG_HOME_CON']."</p></div></div><div class='promo-hero'><div></div></div></section>";
$EX_HTML['feature']	=	"<section class='block'><div class='container'><div class='inner'><p class='sect'>".$GLOB_DEF['FEAT_TITLE_1']."</p><h2>".$GLOB_DEF['FEAT_TITLE_2']."</h2><p class='intro'>".$GLOB_DEF['FEAT_TITLE_3']."</p><p class='intro'>".$GLOB_DEF['FEAT_MSG_M']."</p><ul class='list-unstyled list-promo'><li><img class='picto' src='".$GLOB_DEF['FEAT_IMG_1']."' alt='互联的平台'/><h3 class='withtopline'>".$GLOB_DEF['FEAT_MSG_A1']."</h3><p>".$GLOB_DEF['FEAT_MSG_A2']."</p></li><li><img class='picto' src='".$GLOB_DEF['FEAT_IMG_2']."' alt='优质的服务'/><h3 class='withtopline'>".$GLOB_DEF['FEAT_MSG_B1']."</h3><p>".$GLOB_DEF['FEAT_MSG_B2']."</p></li><li><img class='picto' src='".$GLOB_DEF['FEAT_IMG_3']."' alt='完整的资源'/><h3 class='withtopline'>".$GLOB_DEF['FEAT_MSG_C1']."</h3><p>".$GLOB_DEF['FEAT_MSG_C2']."</p></li></ul></div></div></section>";
$EX_HTML['expert_beg']	=	"<section class='promo network'>\n<div class='container'>\n<div class='promo-msg wide'>\n<p class='sect'>".$GLOB_DEF['EXPE_TITLE_1']."</p>\n<h1 class='animated'>".$GLOB_DEF['EXPE_TITLE_2']."</h1>\n<p class='intro animated'>".$GLOB_DEF['EXPE_TITLE_3']."</p>\n<a href='#integrations' class='learn-more smooth animated'>\n<div>".$GLOB_DEF['EXPE_TITLE_4']."</div>\n<img src='".$GLOB_DEF['EXPE_TITLE_IMG']."' alt='>'/>\n</a>\n</div>\n</div>\n</section>\n<section class='block' id='integrations'>\n<div class='container'>\n<div class='inner'>\n<p class='sect animated'>".$GLOB_DEF['EXPE_MSG_1']."</p>\n<h2 class='animated'>".$GLOB_DEF['EXPE_MSG_2']."</h2>\n<p class='intro animated'>".$GLOB_DEF['EXPE_MSG_3']."<br />\n<a href='/contact'>".$GLOB_DEF['EXPE_MSG_4']."</a>".$GLOB_DEF['EXPE_MSG_5']."</p>\n<ul class='list-unstyled list-brands'>\n";
//下面的变量需要sprintf函数组合三个参数
$EX_HTML['expert_list']	=	"<li class='animated'>\n<a href='%s'>\n<div class='brand-logo'>\n<span class='%s'></span>\n</div>\n<div class='brand-msg'>\n<p>%s</p>\n</div>\n<div class='brand-foot'>\n<div class='btn'>详细了解<i class='icon-arrow'></i></div>\n</div>\n</a>\n</li>\n";
$EX_HTML['expert_end']	=	"</ul>\n</div>\n</div>\n</section>\n<br>";
$EX_HTML['engin_beg']	=	"<section class='promo about'>\n<div class='container'>\n<div class='promo-msg wide'>\n<p class='sect'>".$GLOB_DEF['ENGIN_TITLE_1']."</p>\n<h1 class='animated'>".$GLOB_DEF['ENGIN_TITLE_2']."</h1>\n<p class='intro animated'>".$GLOB_DEF['ENGIN_TITLE_3']."</p>\n<a href='#integrationa' class='learn-more smooth animated'>\n<div>".$GLOB_DEF['ENGIN_TITLE_4']."</div>\n<img src='".$GLOB_DEF['ENGIN_TITLE_IMG']."' alt='>'/>\n</a>\n</div>\n</div>\n</section>\n<section class='block' id='integrationa'>\n<div class='container'>\n<div class='inner'>\n<p class='sect animated'>".$GLOB_DEF['ENGIN_MSG_1']."</p>\n<h2 class='animated'>".$GLOB_DEF['ENGIN_MSG_2']."</h2>\n<p class='intro animated'>".$GLOB_DEF['ENGIN_MSG_3']."<br />\n<a href='/contact'>".$GLOB_DEF['ENGIN_MSG_4']."</a>".$GLOB_DEF['ENGIN_MSG_5']."</p>\n<ul class='list-unstyled list-brands'>\n";
$EX_HTML['engin_list']	=	"<li class='animated'>\n<a href='%s'>\n<div class='brand-logo'>\n<img src='%s' alt='>' />\n</div>\n<div class='brand-msg'>\n<p>%s</p><p>%s</p>\n</div>\n<div class='brand-foot'>\n<div class='btn'>详细了解<i class='icon-arrow'></i></div>\n</div>\n</a>\n</li>\n";
$EX_HTML['engin_end']	=	$EX_HTML['expert_end'];
$EX_HTML['plat_beg']	=	"<section class='promo short contact'>\n<div class='container'>\n<div class='promo-msg wide'>\n<p class='sect animated'>".$GLOB_DEF['PLAT_TITLE_1']."</p>\n<h1 class='animated'>".$GLOB_DEF['PLAT_TITLE_2']."</h1>\n<p class='intro animated'>".$GLOB_DEF['PLAT_TITLE_3']."</p>\n</div>\n</div>\n</section>\n<section class='block'>\n<div class='container'>\n<div class='inner'>\n<p class='sect'>".$GLOB_DEF['PLAT_MSG_1']."</p>\n<h2>".$GLOB_DEF['PLAT_MSG_2']."</h2>\n<p class='intro'></p>\n<div class='promo-slider'>\n";
$EX_HTML['plat_list']	=	"<div class='promo-slide'>\n<img src='%s' alt='%s'/>\n<div class='promo-caption'>\n<p class='promo-captiontitle'>%s</p>\n<p></p>\n</div>\n</div>\n";
$EX_HTML['plat_end']	=	"</div>\n<div class='ctablock'>\n<a href='".$GLOB_DEF['PLAT_MSG_3']."' class='btn btn-medium btn-primary'>".$GLOB_DEF['PLAT_MSG_4']."</a>\n</div>\n</div>\n</div>\n</section>\n";
$EX_HTML['blog_beg']	=	"<section class='promo shortest blog'>\n<div class='container'>\n<div class='promo-msg wide'>\n<p class='sect animated'>".$GLOB_DEF['BLOG_TITLE_1']."</p>\n<h1 class='animated'>".$GLOB_DEF['BLOG_TITLE_2']."</h1>\n</div>\n</div>\n</section>\n<section class='block block-blog grey'>\n<div class='container'>\n<div class='innerx'>\n<div class='textblock widest'>\n<div class='blogposts'>\n";
$EX_HTML['blog_list']	=	"<div class='blogpost'>\n<a href='%s' class='btn-blogpost'>\n<div class='inner'>\n<h2>%s</h2>\n<div class='blog-img' style='padding-bottom: 10px'>\n<img src='%s' alt='%s'/>\n</div>\n<p class='author'>%s </p>\n<p class='intro'>%s</p>\n<p class='btn-text btn-readblog withlasticon'>阅读<i class='icon-arrow'></i></p>\n</div>\n</a>\n</div>\n";
$EX_HTML['blog_end']	=	"</div>\n</div>\n</div>\n</div>\n</section>";


//}}}
unset($s1);unset($s2);unset($s3);unset($s4);unset($s5);

?>
