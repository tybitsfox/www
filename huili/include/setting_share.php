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
		$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li><a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>设置</a></li><li>分享";
		$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
		echo $st1;
		echo "<div class='inner' id='modal_container' >\n<h2 class='sect first'>设置 / 分享</h2>\n";
		$st1=" <div class='block'>
    <div class='panel shadow'>
      <div class='body body-settings'>
        <div class='inner-narrow'>
            <div class='intro-block'>
                <h3>Create a Personal Access Token</h3>
                <p>Build your own personal apps with our API</p>
            </div>
            <form class='form form-horizontal form-boxed' method='post' action='/app/settings/developer'>
               <input type='hidden' value='f89b27a9-ad93-416f-bf2b-20005646fb68' name='authenticityToken' />
               <div class='form-group'>
                   <label>Token Name</label>
                   <div class='form-split'>
                       <input name='name' id='name' class='form-control inlined' placeholder='Name (to remember what token is for)' required/>
                       <button type='submit' class='btn btn-primary'>Create Token</button>
                   </div>
               </div>
            </form>
            <br/>
            <div class='intro-block intro-block-slim'>
                <a href='/app/settings/security'>View your personal access tokens</a>
            </div>
        </div>
    </div>
    </div>
  </div>";
		echo $st1;
		echo $SIG_HTML['RIGHT_TOP3'];
?>
