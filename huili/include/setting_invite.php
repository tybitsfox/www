<?php
$va=0;
$str="";
if(isset($_POST['email']) && isset($_POST['message']))
{
	$vb=$_POST['message']."欢迎访问汇氏管家";
	$ay=array($_SESSION['CURR_USR'][0],$_POST['email'],$_POST['message'],0);
	$ta=new tb_invite();
	$ta->add_invite($ay);
	if($ta->err_no)
	{
		$str=sprintf("<div class='alert alert-danger alert-inline' role='alert'>\n错误：%s</div>",$ta->err_msg());
		$va=1;
	}
	else
	{//发送邮件
		$mailcontent=$vb;
		$mailtype="TXT";
		$smtp=new smtp();
		$smtp->sendmail($_POST['email'],"bitsfox@126.com","invite you to join huishi group",$mailcontent,$mailtype);
		$va=1;
		$str="<div class='alert alert-success alert-inline' role='alert'>\n邮件已经成功发送</div>";
	}
}
else
{
	if(isset($_GET['index']))
	{
		unset($ta);
		$ta=new tb_invite();
		$ta->check_invite($_GET['index']);
	}
}
unset($ta);
$ayy=array();
$ta=new tb_invite();
$ayy=$ta->get_invite();
//$st1="count: ".count($ayy)."err_no is:".$ta->err_no;
//die($st1);
?>
<?php
include_once('../template/def_setting.php');
		$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li><a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['ONE']."'>设置</a></li><li>邀请好友";
		$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
		echo $st1;
		echo "<div class='inner' id='modal_container' >\n<h2 class='sect first'>设置 / 邀请好友</h2>\n";
		$st1="<!-- Panel -->
    <div class='block'>        
        <div class='panel shadow'>
            <div class='body body-settings'>
                <div class='inner-narrow'>
                    <form class='form form-horizontal form-boxed' method='post' action='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FUR']."'>
                        <input type='hidden' value='6fd76a2b-3925-4579-a7ff-027428e8f385' name='authenticityToken' />
                        <div class='intro-block'>
                            <h3>邀请好友加入汇氏</h3>
                            <p>喜欢汇氏环境? 帮助我们向您的朋友推荐这个平台.</p>
                        </div>";
						echo $st1;
				 if($va == 1)
				 {echo $str;}
                  $st1="<div class='form-group'>
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
                            <tbody>";
							echo $st1;
                                 $st1= "<tr>
                                            <td>%s</td>
                                            <td>%s</td>
                                            <td>
                                                %s
                                            </td>
                                        </tr>";
							$j=count($ayy);
							for($i=0;$i<$j;$i++)
							{
								if($ayy[$i][4] == 0)//未接受
								{$st3="等待接受";$st4="<a href='".$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['FUR']."&index=".$ayy[$i][0]."'>重新发送</a>";}
//								{$st3="等待接受";$st4="<a href='#' data-resend-link='/huili/test/js_test/j01.php'>重新发送</a>";}
								else
								{$st3="是";$st4="";}
								$st2=sprintf($st1,$ayy[$i][2],$st3,$st4);
								echo $st2;
							}
                     $st1="</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>";
		echo $st1;
		echo $SIG_HTML['RIGHT_TOP3'];
?>
