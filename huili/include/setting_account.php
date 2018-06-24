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
		$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li><a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>设置</a></li><li>账户";
		$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
		echo $st1;
		echo "<div class='inner' id='modal_container' >\n<h2 class='sect first'>设置 / 账户</h2>\n<!-- Panel -->\n<div class='block'>\n<div class='panel shadow'>\n<div class='body body-settings'>\n<div class='inner-narrow'>\n<div class='intro-block'>\n<h3>您的账户信息</h3>\n<p>这里可以查看您账户的资信信息</p></div>\n";
		$st1="<ul class='list-unstyled list-accounts'>
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
                    <p class='title'>13</p>
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
                    <p class='title'>187</p>
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
                    <p class='title'>200</p>
                  </div>
				</li>
				<li>
                  <div class='vendor-info'>
                    <div class='vendor'>
                      <i class='icon-user'></i>
                    </div>
                  </div>
 	                <div class='account-action'>
                   	  <a href='/app/accounts/6adgokW5xo/edit' class='btn btn-outline withlasticon'>签到<i class='icon-pencil'></i></a>
                  	</div>
				</li>
            </ul>
          </div>
        </div>
      </div>
    </div>";
		echo $st1;
		echo $SIG_HTML['RIGHT_TOP3'];
?>
