<?php
$sec_arr=array();
$ta=new used_sign();
$sec_arr=$ta->get_secu_from_db();
if($ta->err_no)
	die("access db error");
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
	if(($i == 5) && ($_SESSION['CURR_USR'][0] > 100001))
		continue;
	$st=sprintf("<li><a href='%s'>%s<i class='%s'></i></a></li>\n",$SIGNED_DEF['PROFILE'][$i][0],$SIGNED_DEF['PROFILE'][$i][1],$SIGNED_DEF['PROFILE'][$i][2]);
	echo $st;
}
		echo $SIG_HTML['LEFT_TOP3'];
		$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li><a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>设置</a></li><li>安全";
		$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
		echo $st1;
		echo "<div class='inner' id='modal_container' >\n<h2 class='sect first'>设置 / 安全</h2>\n";
		$st1="<div class='block'>
      <div class='panel shadow'>
        <div class='body body-settings'>
          <div class='inner-lgnarrow'>
            <div class='intro-block'>
              <h3>您最近授权的应用</h3>
              <p>如发现可疑的应用，请及时联系我们：<a style='color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;' href='mailto:bitsfox@126.com'>bitsfox@126.com</a></p>
            </div>
            <ul class='list-unstyled list-accounts'>";
			echo $st1;
$j=count($sec_arr);
for($i=0;$i<$j;$i++)
{
			 $st1="<ul class='list-unstyled list-accounts'>
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
                            <p class='desc'>%s</p>
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
                        </li>";
                        $st3="<li>
                            <p class='title'> Account Access </p>
                            <p class='info'>
                              <a class='btn btn-danger' href='/app/settings/security/authorizations/WyzaxAZKB90QwY02P94v/destroy' role='button'>Revoke</a>
                            </p>";
	if(intval($sec_arr[$i][6]) == 1)
	{
		$s1="是";
		$s2="允许读/写本地设备上的配置文件";
	}
	else
	{
		$s1="否";
		$s2="禁止读写本地设备上的配置文件";
	}
	$st2=sprintf($st1,$sec_arr[$i][1],$sec_arr[$i][1],$sec_arr[$i][5],$sec_arr[$i][4],$sec_arr[$i][3],$s1,$s2);
	echo $st2;
	if($i > 0)
		echo $st3;
	echo "                </ul> <!-- end more info section -->
                      </li>";
}
                $st1="</ul>
              </div>
            </div>
          </div>
        </div>";
		echo $st1;
		echo $SIG_HTML['RIGHT_TOP3'];
?>
