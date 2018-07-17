<?php
$headfile=$_SERVER["DOCUMENT_ROOT"]."/tools/js_learn/include/head_def.php";
include_once($headfile);
?>
<script>
$(document).ready(function(){
		$("a").click(function(){
				var s=$(this).attr("data-target");
				var d=document.getElementById("div1");
				d.innerHTML=s;
				});
		});


</script>
&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' class='btn btn-primary withicon btn-shareaccount' data-toggle-inactive='modal' data-target='#modal-shareaccount'>aaa</a><br><br>
<div id="div1"></div><br>

                            <div id='custom_message_container' class='col-sm-8'>
                                <textarea name='message' id='custom_message' class='form-control custom-message-input inlined' placeholder='这里填写邀请邮件的内容' tabindex=2></textarea>
                            </div>
<br><br>



