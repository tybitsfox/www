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
		$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li><a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>设置</a></li><li>安全";
		$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
		echo $st1;
		echo "<div class='inner' id='modal_container' >\n<h2 class='sect first'>设置 / 安全</h2>\n";
		$st1="<div class='block'>
      <div class='panel shadow'>
        <div class='body body-settings'>
          <div class='inner-lgnarrow'>
            <div class='intro-block'>
              <h3>You have authorized the following applications</h3>
              <p>Disable access to the applications you don’t use any more.</p>
            </div>
            <ul class='list-unstyled list-accounts'>
                  <ul class='list-unstyled list-accounts'>
                    <li>
                      <div class='avatar'>
                        <div class='circle'>
                          <img src='/huili/images/logo/mmexport1.png' alt='Greenback'/>
                        </div>
                      </div>
                      <div class='account-info'>
                        <p class='title'>
                            <strong>
                              <a href='https://greenback.com'>Greenback.com</a>
                            </strong>
                            by
                            <strong>
                              <a href='http://greenback.com'>Greenback, Inc.</a>
                            </strong>
                        </p>
                      </div>
                      <div class='account-status'>
                            <p class='desc'>Your current session</p>
                      </div>
                      <div class='account-action'>
                        <a href='#authorization0' class='btn btn-outline' data-trigger='collapse'>More Info</a>
                      </div>
                    </li>
                    <li class='collapse' id='authorization0'>
                      <ul class='list-unstyled list-security'> <!-- start more info section -->
                        <li>
                          <p class='title'>Authorized</p>
                          <p class='info'>Jun 22, 2018 at 7:42 PM America/New_York</p>
                        </li>
                        <li>
                          <p class='title'>Browser</p>
                          <p class='info'>Firefox</p>
                        </li>
                        <li>
                          <p class='title'>Operating System</p>
                          <p class='info'>Linux</p>
                        </li>
                        <li>
                          <p class='title'>Location</p>
                          <div class='m-v-half'>
                            <span>Location</span>
                            <p class='info'>27.200.97.31</p>
                          </div>
                        </li>
                        <li>
                          <p class='title'>Trusted Device</p>
                          <p class='info'>Yes</p>
                        </li>
                        <li>
                          <p class='title'>Permissions</p>
                          <div class='info'>
                            <ul class='list-unstyled'>
                                <li><strong>Read your user profile</strong></li>
                                <li><strong>Read/write your transactions</strong></li>
                            </ul>
                          </div>
                        </li>
                        </ul> <!-- end more info section -->
                      </li>
                  <ul class='list-unstyled list-accounts'>
                    <li>
                      <div class='avatar'>
                        <div class='circle'>
                          <img src='/huili/images/logo/mmexport1.png' alt='Greenback'/>
                        </div>
                      </div>
                      <div class='account-info'>
                        <p class='title'>
                            <strong>
                              <a href='https://greenback.com'>Greenback.com</a>
                            </strong>
                            by
                            <strong>
                              <a href='http://greenback.com'>Greenback, Inc.</a>
                            </strong>
                        </p>
                      </div>
                      <div class='account-status'>
                            <p class='desc'>Last used 21 hours ago<br/>
                                <strong>Firefox on Linux</strong>
                            </p>
                      </div>
                      <div class='account-action'>
                        <a href='#authorization1' class='btn btn-outline' data-trigger='collapse'>More Info</a>
                      </div>
                    </li>
                    <li class='collapse' id='authorization1'>

                      <ul class='list-unstyled list-security'> <!-- start more info section -->
                        <li>
                          <p class='title'>Authorized</p>
                          <p class='info'>Jun 21, 2018 at 11:01 PM America/New_York</p>
                        </li>
                        <li>
                          <p class='title'>Browser</p>
                          <p class='info'>Firefox</p>
                        </li>
                        <li>
                          <p class='title'>Operating System</p>
                          <p class='info'>Linux</p>
                        </li>
                        <li>
                          <p class='title'>Location</p>
                          <div class='m-v-half'>
                            <span>Location</span>
                            <p class='info'>220.193.65.234</p>
                          </div>
                        </li>
                        <li>
                          <p class='title'>Trusted Device</p>
                          <p class='info'>Yes</p>
                        </li>
                        <li>
                          <p class='title'>Permissions</p>
                          <div class='info'>
                            <ul class='list-unstyled'>
                                <li><strong>Read your user profile</strong></li>
                                <li><strong>Read/write your transactions</strong></li>
                            </ul>
                          </div>
                        </li>
                          <li>
                            <p class='title'> Account Access </p>
                            <p class='info'>
                              <a class='btn btn-danger' href='/app/settings/security/authorizations/WyzaxAZKB90QwY02P94v/destroy' role='button'>Revoke</a>
                            </p>
                        </ul> <!-- end more info section -->
                      </li>
                  <ul class='list-unstyled list-accounts'>
                    <li>
                      <div class='avatar'>
                        <div class='circle'>
                          <img src='/huili/images/logo/mmexport1.png' alt='Greenback'/>
                        </div>
                      </div>
                      <div class='account-info'>
                        <p class='title'>
                            <strong>
                              <a href='https://greenback.com'>Greenback.com</a>
                            </strong>
                            by
                            <strong>
                              <a href='http://greenback.com'>Greenback, Inc.</a>
                            </strong>
                        </p>
                      </div>
                      <div class='account-status'>
                            <p class='desc'>Last used 5 days ago<br/>
                                <strong>Chrome Mobile on Android Mobile</strong>
                            </p>
                      </div>
                      <div class='account-action'>
                        <a href='#authorization2' class='btn btn-outline' data-trigger='collapse'>More Info</a>
                      </div>
                    </li>
                    <li class='collapse' id='authorization2'>
                      <ul class='list-unstyled list-security'> <!-- start more info section -->
                        <li>
                          <p class='title'>Authorized</p>
                          <p class='info'>Jun 18, 2018 at 4:04 AM America/New_York</p>
                        </li>
                        <li>
                          <p class='title'>Browser</p>
                          <p class='info'>Chrome Mobile</p>
                        </li>
                        <li>
                          <p class='title'>Operating System</p>
                          <p class='info'>Android Mobile</p>
                        </li>
                        <li>
                          <p class='title'>Location</p>
                          <div class='m-v-half'>
                            <span>Location</span>
                            <p class='info'>27.200.87.36</p>
                          </div>
                        </li>
                        <li>
                          <p class='title'>Trusted Device</p>
                          <p class='info'>Yes</p>
                        </li>
                        <li>
                          <p class='title'>Permissions</p>
                          <div class='info'>
                            <ul class='list-unstyled'>
                                <li><strong>Read your user profile</strong></li>
                                <li><strong>Read/write your transactions</strong></li>
                            </ul>
                          </div>
                        </li>
                          <li>
                            <p class='title'> Account Access </p>
                            <p class='info'>
                              <a class='btn btn-danger' href='/app/settings/security/authorizations/7vYda3rwvj0ZwNR1L2by/destroy' role='button'>Revoke</a>
                            </p>
                        </ul> <!-- end more info section -->
                      </li>
                  <ul class='list-unstyled list-accounts'>
                    <li>
                      <div class='avatar'>
                        <div class='circle'>
                          <img src='/huili/images/logo/mmexport1.png' alt='Greenback'/>
                        </div>
                      </div>
                      <div class='account-info'>
                        <p class='title'>
                            <strong>
                              <a href='https://greenback.com'>Greenback.com</a>
                            </strong>
                            by
                            <strong>
                              <a href='http://greenback.com'>Greenback, Inc.</a>
                            </strong>
                        </p>
                      </div>
                      <div class='account-status'>
                            <p class='desc'>Last used 3 weeks ago<br/>
                                <strong>Chrome Mobile on Android Mobile</strong>
                            </p>
                      </div>
                      <div class='account-action'>
                        <a href='#authorization3' class='btn btn-outline' data-trigger='collapse'>More Info</a>
                      </div>
                    </li>
                    <li class='collapse' id='authorization3'>
                      <ul class='list-unstyled list-security'> <!-- start more info section -->
                        <li>
                          <p class='title'>Authorized</p>
                          <p class='info'>Jun 1, 2018 at 10:16 PM America/New_York</p>
                        </li>
                        <li>
                          <p class='title'>Browser</p>
                          <p class='info'>Chrome Mobile</p>
                        </li>
                        <li>
                          <p class='title'>Operating System</p>
                          <p class='info'>Android Mobile</p>
                        </li>
                        <li>
                          <p class='title'>Location</p>
                          <div class='m-v-half'>
                            <span>Location</span>
                            <p class='info'>124.130.140.109</p>
                          </div>
                        </li>
                        <li>
                          <p class='title'>Trusted Device</p>
                          <p class='info'>Yes</p>
                        </li>
                        <li>
                          <p class='title'>Permissions</p>
                          <div class='info'>
                            <ul class='list-unstyled'>
                                <li><strong>Read your user profile</strong></li>
                                <li><strong>Read/write your transactions</strong></li>
                            </ul>
                          </div>
                        </li>
                          <li>
                            <p class='title'> Account Access </p>
                            <p class='info'>
                              <a class='btn btn-danger' href='/app/settings/security/authorizations/oNy1xQJ8JeQrK3r2m5EP/destroy' role='button'>Revoke</a>
                            </p>
                        </ul> <!-- end more info section -->
                      </li>
                </ul>
              </div>
            </div>
          </div>
        </div>";
		echo $st1;
		echo $SIG_HTML['RIGHT_TOP3'];
?>
