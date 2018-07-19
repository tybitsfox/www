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


</script></head><body>
&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' class='btn btn-primary withicon btn-shareaccount' data-toggle-inactive='modal' data-target='#modal-shareaccount'>aaa</a><br><br>
<div id="div1"></div><br>

                            <div id='custom_message_container' class='col-sm-8'>
                                <textarea name='message' id='custom_message' class='form-control custom-message-input inlined' placeholder='这里填写邀请邮件的内容' tabindex=2></textarea>
                            </div>
<br><br>
<?php
function chg_val(&$a)
{
	$a+=10;
}
function test_val($a)
{
	chg_val($a);
	echo $a;
	return;
}
$x=100;
echo "X=".$x."<br><br>";
test_val($x);
echo "<br><br>now x=".$x;
?>
</body></html>



