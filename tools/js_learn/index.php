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
</script>
<?php
echo "<body>";
?>
<p>hello world</p>
<p id="p01">another world</p>
<button id="bt1">点我隐藏</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="bt2">点我显示</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="bt3">点我渐变</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="bt4">toggle</button>
</body></html>
