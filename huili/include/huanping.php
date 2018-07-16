<?php
//{{{ init
if(!defined("HOME_CALLED"))
	die("access denied!");
$shwmsg=array(
		array('恭贺汇氏管家吉日上线！','恭祝汇氏管家上线大吉，一家网站，两份收益，朋友三番四次光顾，五福临门照耀，六六大顺生意，七仙过海帮你，八面玲珑客户满门，九九归一成功，十全十美的人生！','/huili/images/logo/0210140GB7.jpg','temp/msg000.txt'),
		array('十三届全国人大常委会第四次会议在京举行','7月9日，十三届全国人大常委会第四次会议在北京人民大会堂举行。栗战书委员长主持会议并作全国人大常委会执法检查组关于检查大气污染防治法实施情况的报告。','/huili/images/logo/W020180710688862012139.jpg','temp/msg001.txt'),
		array('省环保厅举行两法启动仪','省环保厅举行《山东省环境保护厅群众反映和监控发现的环境污染问题整改落实情况随机抽查办法》和《山东省排污许可制执行情况监督检查办法》 启动仪式','/huili/images/logo/W020180706695142506931.jpg','temp/msg003.txt')
		);

//}}}	
?>
<?php
//{{{标签页的代码
//进入到本文件之前div+1
$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li>环评咨询";
$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);				//section+1;div+1
echo $st1;
echo"<div class='inner' id='modal_container' ><div class='block'><div class='panel shadow'><ul class='nav nav-tabs nav-tabs-hor' role='tablist'>";
$st1="<li role='presentation' class='%s'><a href='%s' aria-controls='share' role='tab' data-toggle='tab'>%s</a></li>";
$st2=sprintf($st1,'active','#huanping','项目展示');
echo $st2;
$st2=sprintf($st1,'','#gethelp','寻求帮助');
echo $st2;
echo"</ul><div class='body'><div class='body body-settings'><div class='tab-content'>";
//}}}
//{{{第一页的代码
echo"<div role='tabpanel' class='tab-pane active' id='huanping'>";
echo "<ul class='list-unstyled list-accounts'>";
$st1="<li id='li000%d' class='pont'><div>%s<div id='dv000%d' style='width:100%%;margin:2px auto;display:none;'>%s<br><div class='blog-img'><img src='%s' /></div><br>";
//"ssssssssss</div></div></li>";//need 5 paras
for($i=0;$i<count($shwmsg);$i++)
{
	$st=sprintf($st1,$i+1,$shwmsg[$i][0],$i+1,$shwmsg[$i][1],$shwmsg[$i][2]);
	echo $st;
	$st=constant("FULL_PATH").$shwmsg[$i][3];
	include_once($st);
	echo "</div></div></li>";
}
//echo "<li id='li0001' class='pont'><div>恭贺汇氏管家吉日上线！<div id='dv0001' style='width:100%;margin:2px auto;display:none;'>tianyong<br><div class='blog-img'><img src='/huili/images/logo/0210140GB7.jpg' /></div><br>taianshi</div></div></li>";

echo"</ul></div>";
//}}}
//{{{ 第二页的代码
echo"<div role='tabpanel' class='tab-pane' id='gethelp'>";
echo "hello world!";
echo "</div>";
//}}}
echo"</div></div></div>";
echo"</div></div></div>";
?>
<style>
.pont:hover {cursor:pointer;}
</style>
<script>
$(document).ready(function(){
		$("li").click(function(){
				var vid=$(this).attr("id");
				switch(vid)
				{
				case "li0001":
					$("#dv0001").slideToggle();
					break;
				case "li0002":
					$("#dv0002").slideToggle();
					break;
				case "li0003":
					$("#dv0003").slideToggle();
					break;
				case "li0004":
					$("#dv0004").slideToggle();
					break;
				}
				});
		});
</script>
<?php
echo $SIG_HTML['RIGHT_TOP3'];  //div-1;section-1;div-1;
?>
