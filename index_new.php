<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
include_once("./mystyle.css");
//<link href="mystyle.css" rel="stylesheet" type="text/css">
//测试证明：使用include_once和<link href="mystyle.css" ..>这两种方法都可以实现css功能
?>
<!--显示时间的函数-->
 <script language=Javascript> 
   function time(){
	       //获得显示时间的div
	       t_div = document.getElementById('showtime');
		      var now=new Date()
				      //替换div内容 
				     t_div.innerHTML =now.getFullYear()
					     +"年"+(now.getMonth()+1)+"月"+now.getDate()
						     +"日"+now.getHours()+"时"+now.getMinutes()
							     +"分"+now.getSeconds()+"秒";
			      //等待一秒钟后调用time方法，由于settimeout在time方法内，所以可以无限调用
			     setTimeout(time,1000);
				   }
</script>
<body onload="time()"><a name=a01></a>
<table class="aaaa"><tr><td width=750px align=left valign=top>
<div class="menu">
<ul>







