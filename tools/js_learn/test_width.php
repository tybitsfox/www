<?php
$headfile=$_SERVER["DOCUMENT_ROOT"]."/tools/js_learn/include/head_def.php";
include_once($headfile);
?>
<script>
function get_width()
{
	var a=document.getElementById("div1");
	var b=document.body.clientWidth;
	var c=document.body.clientHeight;
	var x=window.screen.width;
	var y=window.screen.height;
	a.innerHTML="width:"+x+"  Height:"+y;
}
function check_han()
{
	var a=document.getElementById("iname").value;
	var b=document.getElementById("div2");

	b.innerHTML=a;
}
</script>
</head><body>
<br><div id="div1" style="margin-left:20px;"><button onclick="get_width();">get</button></div>
<div id="div1" style="margin-left:20px;"></div>
<form method="post" action="./test_width.php">
<br><br><input type="text" id="iname" name="iname" value="hello" />&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onclick="check_han();">JS call</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit">submit</button><br><br>
<?php
if(isset($_POST['iname']))
{
	$st=$_POST['iname'];
	if(preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$st))
		echo"<div id='div2' style='margin-left:20px;'>全是中文</div>";
	elseif(preg_match("/[\x{4e00}-\x{9fa5}]/u",$st))
		echo"<div id='div2' style='margin-left:20px;'>包含中文</div>";
	else
		echo"<div id='div2' style='margin-left:20px;'>不含中文</div>";
}
else
	echo "<div id='div2' style='margin-left:20px;'></div>";
?>
</form>
</body></html>
