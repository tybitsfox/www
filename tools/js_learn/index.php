<?php
$headfile=$_SERVER["DOCUMENT_ROOT"]."/tools/js_learn/include/head_def.php";
include_once($headfile);
?>
<script>
$(document).ready(function(){
		$("#bt1").click(function(){
				$("p:first").hide();
				});
		$("#bt2").click(function(){
				$("p:first").show();
				});
		$("#bt3").click(function(){
				$("p:first").hide(1000);
				});
		$("#bt4").click(function(){
				$("#p01").toggle();
				});
		});
$(document).ready(function(){
		$("#bt11").click(function(){
				$("#div1").fadeIn(2000);
				$("#div2").fadeIn("slow");
				$("#div3").fadeIn();
				});
		$("#bt12").click(function(){
				$("#div1").fadeOut(2000);
				$("#div2").fadeOut("slow");
				$("#div3").fadeOut();
				});
		$("#bt13").click(function(){
				$("#div1").fadeToggle(2000);
				$("#div2").fadeToggle("slow");
				$("#div3").fadeToggle();
				});
		});
$(document).ready(function(){
		$("#flip").click(function(){
				$("#panel").slideToggle("slow");
				});
		});
$(document).ready(function(){
		$("#anim").click(function(){
				var i=document.getElementById("anim").style.left;
				if((i == "") || (i == '0px'))
					$("#anim").animate({left:'250px'});
				else
					$(this).animate({left:'0px'});
				});
		});
$(document).ready(function(){
		$("#anim1").click(function(){
				var i=document.getElementById("anim1").style.left;
				if((i == "") || (i == '0px'))
				{
					$(this).animate({left:'250px'});
					$("#anim1 p:first").fadeOut("slow");
				}
				else
				{
					$(this).animate({left:'0px'}).fadeIn("slow");
					$("#anim1 p:first").fadeIn("slow");
				}
				});
		});
</script>
<style>
#flip:hover {cursor:pointer;}
#panel,#flip
{
	padding:5px;
	text-align:center;
	background-color:#e5eecc;
	border:solid 1px #c3c3c3;
}
#panel
{
	padding:50px;
	display:none;
}
</style>
<?php
echo "</head><body>";
?>
<br>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./ajax_test.php" target=_blank>ajax测试</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='./test_width.php'>width测试</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./test_edit.php">edit测试</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./summernote.php">summernote</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='./preg_grep.php'>preg_grep</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./arraypop.php">array_pop</a><br>
-----------------------------------------测试hide()和show()函数---------------------------------------------<br><br>
<p>hello world</p>
<p id="p01">another world</p>
<button id="bt1">点我隐藏</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="bt2">点我显示</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="bt3">点我渐变</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="bt4">toggle</button>
<br><br>
-----------------------------------------测试fadeIn()和fadeOut()和fadeToggle函数<font color="red">淡入淡出</font>---------------------------------------------<br><br>
<div style="margin-left:10px;"><button id="bt11">fadeIn</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="bt12">fadeOut</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="bt13">fadeToggle</button></div>
<br><br>
<div id="div1" style="width:80px;height:80px;background-color:red;margin-left:10px"></div><br>
<div id="div2" style="width:80px;height:80px;background-color:blue;margin-left:10px"></div><br>
<div id="div3" style="width:80px;height:80px;background-color:green;margin-left:10px"></div><br>

-----------------------------------------测试slideUp()和slideDown()和slideToggle函数<font color="red">上下滑动</font>---------------------------------------------<br><br>
<br><br>
<div style="width:50%;margin:0 auto;">
<div id="flip">dianwo</div>
<div id="panel">hello world</div></div>
<br><br>
----------------------------------------测试animate函数---------------------------------------------
<br><br>
<div id="anim" style="width:100px;height:100px;background:#98bf21;position:absolute;">hello world</div>
<br><br>
<br><br>
<br><br>
<br><br>
----------------------------------------队列操作测试------------------------------------------------
<br><br>
<div id="anim1" style="width:100px;height:100px;background:#98bf21;position:absolute;"><p>hello world</p></div>
<br><br>
<br><br>
<br><br>
<br><br>

</body></html>
