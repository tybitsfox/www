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
</script>
</head><body>
<br><div id="div1" style="margin-left:20px;"><button onclick="get_width();">get</button></div>
<div id="div1" style="margin-left:20px;"></div>
