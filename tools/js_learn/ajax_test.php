<?php
$headfile=$_SERVER["DOCUMENT_ROOT"]."/tools/js_learn/include/head_def.php";
include_once($headfile);
?>
<script>
function ajax_get()
{
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("div1").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","/tools/js_learn/for_get.php",true);
	xmlhttp.send();
	setTimeout(ajax_get,2000);
}
</script>
</head><body>
<br><div style="margin-left:20px;"><button onclick="ajax_get();">请求数据</button></div><br><br>
<div id="div1" style="margin-left:20px;">这里将显示取得的数据</p>
