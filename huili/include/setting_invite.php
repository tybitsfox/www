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
	$st=sprintf("<li><a href='%s'>%s<i class='%s'></i></a></li>\n",$SIGNED_DEF['PROFILE'][$i][0],$SIGNED_DEF['PROFILE'][$i][1],$SIGNED_DEF['PROFILE'][$i][2]);
	echo $st;
}
		echo $SIG_HTML['LEFT_TOP3'];
		$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li><a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>设置</a></li><li>邀请好友";
		$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
		echo $st1;
		echo "<div class='inner' id='modal_container' >\n<h2 class='sect first'>设置 / 邀请好友</h2>\n";
		$st1="<!-- Panel -->
    <div class='block'>        
        <div class='panel shadow'>
            <div class='body body-settings'>
                <div class='inner-narrow'>
                    <form class='form form-horizontal form-boxed' method='post' action='/app/invite/create'>
                        <input type='hidden' value='6fd76a2b-3925-4579-a7ff-027428e8f385' name='authenticityToken' />
                        <div class='intro-block'>
                            <h3>邀请好友加入汇氏</h3>
                            <p>喜欢汇氏环境? 帮助我们向您的朋友推荐这个平台.</p>
                        </div>
                        <div class='form-group'>
                            <label class='col-sm-4 control-label'>好友的邮箱地址</label>
                            <div class='col-sm-8'>
                                <input type='email' name='email' id='email' class='form-control inlined' placeholder='邮箱地址' tabindex=1 required>
                            </div>
                        </div>
                        <div class='form-group m-t-2'>
                            <label htmlFor='message' class='col-sm-4 control-label'>发送信息</label>
                            <div id='custom_message_container' class='col-sm-8'>
                                <textarea name='message' id='custom_message' class='form-control custom-message-input inlined' placeholder='这里填写邀请邮件的内容' tabindex=2></textarea>
                            </div>
                        </div>
                        <div class='row m-t-2'> 
                            <div class='col-sm-9  pull-xs-right pull-right text-right text-xs-right'>
                                <button type='submit' href='#' class='btn btn-primary' tabindex=3>邀请好友</button>
                            </div>
                        </div>
                    </form>
                    <h3 class='text-center text-xs-center'>已发送的邀请</h3>
                    <div class='center-block'>
                        <div id='resendResults' class='alert alert-success alert-inline' style='display:none' role='alert'>
                        </div>
                        <div id='resendErrors' class='alert alert-danger alert-inline' style='display:none' role='alert'>
                        </div>
                        <table class='table table-striped'>
                            <thead>
                                <tr>
                                    <th>邮箱地址</th>
                                    <th>接受</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                        <tr>
                                            <td>tybitsfox@126.com</td>
                                            <td>无</td>
                                            <td>
                                                <a href='#' data-resend-link='/app/invite/2149/resend'>重新发送</a>
                                            </td>
                                        </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>";
		echo $st1;
		echo $SIG_HTML['RIGHT_TOP3'];
?>
