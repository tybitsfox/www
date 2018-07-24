<?php
//{{{ init
if(!defined("HOME_CALLED") || !isset($_SESSION['GLO_VAR']))
	die("access denied!");
//{{{ format define	
$shwmsg=array(
		array('恭贺汇氏管家吉日上线！','恭祝汇氏管家上线大吉，一家网站，两份收益，朋友三番四次光顾，五福临门照耀，六六大顺生意，七仙过海帮你，八面玲珑客户满门，九九归一成功，十全十美的人生！','/huili/images/logo/0210140GB7.jpg','temp/msg000.txt'),
		array('十三届全国人大常委会第四次会议在京举行','7月9日，十三届全国人大常委会第四次会议在北京人民大会堂举行。栗战书委员长主持会议并作全国人大常委会执法检查组关于检查大气污染防治法实施情况的报告。','/huili/images/logo/W020180710688862012139.jpg','temp/msg001.txt'),
		array('省环保厅举行两法启动仪','省环保厅举行《山东省环境保护厅群众反映和监控发现的环境污染问题整改落实情况随机抽查办法》和《山东省排污许可制执行情况监督检查办法》 启动仪式','/huili/images/logo/W020180706695142506931.jpg','temp/msg003.txt')
		);
$ft0="<div role='tabpanel' class='tab-pane %s' id='%s'>
		<div class='inner-narrow inner-midnarrow'>
		    <div class='intro-block intro-block-slim'>
				<!--        <p>我的管理界面.</p> -->
				<p id='glb_msg'>我邀请的专家或团队</p>
  			</div>		
			<div class='nav-vendors'>
				<!-- Vendor nav -->
				<ul class='nav nav-tabs nav-tabs-vertical' role='tablist'>"; //需要的输入：激活状态、标签页id  div+3

$ft1="                <li role='presentation' class='%s'>
                           <a href='#%s' weclick='%s' role='tab' data-toggle='tab'>
                      	   <i class='%s'></i><span>%s</span>
                           </a>
                      </li>"; //需要输入： 激活状态、内部锚定名称、data-toggle、图标类名、标签名   div+0

$ft2="                    </ul><!-- Vendor Panes -->
						  <div class='tab-content tab-content-vertical'>";//无输入  div+1
//-------------------------到这里是一个循环的层次，循环外是4个div，进入循环至退出循环div=0------------------------------------------------
$ft3=" 						<div role='tabpanel' class='tab-pane %s' id='%s'><div class='shareblock'>";//需要输入：激活状态、内部锚定名称 div+2

$ft4a="                    		<div class='shareblock-body'>
                                	<ul class='list-unstyled list-shares'>
                                    	<p>%s</p>
                                    </ul>
                                </div></div></div>"; //仅有提示信息 div-2

$ft4b="					 <div class='shareblock-body'>
							<div class='text-center'>
								<a href='%s' style='%s'>&lt;&lt;</a>&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;<a href='%s' style='%s'>&gt;&gt;</a>
                            </div>
						 </div></div></div>";//需要输入：前翻页链接、前翻页链接样式、页码、后翻页链接、链接样式 div-2

$ft4="                  <div class='shareblock-head shareblock-head-light' id='wewe'>
							<p class='shareblock-account'><span class='light'>%s</span> <strong><span class='account-cursor' weclick='%s'>%s</span></strong>%s</p>
                        </div>"; //需要输入：专家或团队提示、专家或团队名称、新消息标志、weclick    div+0
$ft41="<div id='%s' style='width:100%%;max-height:200px;background-color:transparent;margin:2px;overflow:auto;display:none;'><div id='%s'>%s<br></div><form action='#' method=post><input type='text' class='form-control onlined' name='getval' value='' /></form></div>"; //需要的输入：id,id,msg
$ft5="</div></div></div></div>";     //div-4
$hipchat=" <span class='icon-hipchat'></span>";
//}}}
//{{{ data dispose
//下面的队列，第一个元素表示横向标签页的活动状态，后面两个表示帮助页面的纵向标签页的状态及信息
$pg_sel=array(array("active",""),
		array("active","coll","tab1","icon-user","我邀请的团队","您还没有合作的专家或团队"),
		array("","invit","tab2","icon-group","邀请我的团队","通过认证获取他人的邀请"),
		);
//		array("","blog","tab3","icon-finder","发布公告","这里添加编辑框"),
//三个需要处理的动作：1、发送对话消息；2、上翻页；3、下翻页；这三个动作还要配合具体的标签页来处理。
//定义通过GET传送的参数：（1）上翻页：pageup ->；（2）下翻页：pagedown <-； （3）发送消息：sendmsg；（4）当前标签页：curpage；
$pgcnt=array(array(0,0),array(0,0),array(0,0));//元素队列中第一个元素表示项目展示页面，后两个元素表示第二页面纵向标签页的状态。元素第一项表示总的页数，第二项表示当前显示的页数,
if(isset($_POST['getval']))
{die("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa".$_POST['getval']);}
if(isset($_GET['curpage']))
{
	$p=$_GET['curpage'];
	if(($p < 0) || ($p > 2))
		$p=0;
	if($p == 0)
		$pg_sel[0][0]="active";
	else
	{
		$pg_sel[$p][0]="active";
		$pg_sel[0][1]="active";
	}
	if(isset($_GET['pageup'])) //上翻页
		$pgcnt[$p][1]++;
	elseif(isset($_GET['pagedown'])) //下
		$pgcnt[$p][1]--;
	
}
else //default
{
	$pg_sel[0][0]="active";
	$pg_sel[1][0]="active";
}
//首先查找当前账户是否为专家账户,如果是则只读取聊天信息表，否则读取我的专家表，列出所有可对话的专家团队
//使用新的session变量，一减少数据库的访问
//$_SESSION['GLO_VAR']: 0->是否专家，
$gay=array();$cy=array();
for($j=1;$j<3;$j++)
{
	$i=0;
	$gby=array();
	$cy=$_SESSION['GLO_VAR'][$j];
	foreach($cy as $a)
	{
		$ay=array();
		$ay[0]=$a[0]; //uid
		switch($a[1])
		{
			case 0://专家
				$ay[1]="专家姓名：";
				break;
			case 1://团队
				$ay[1]="团队名称：";
				break;
			case 2://普通帐号
				$ay[1]="普通账户：";
				break;
		}
		$ay[2]=$a[2];//姓名或名称
		$ay[3]="mxx".$j.$i;$i++;  //weclick
		$ay[4]=$ay[3]."a";
		$ay[5]=$ay[3]."b";
		array_push($gby,$ay);
	}
	array_push($gay,$gby);
}
$gayc=array('javascript:;','color: gray; cursor: default; disabled: true;','1','javascript:;','color: gray; cursor: default; disabled: true;');
//}}}
//}}}
?>
<?php
//{{{标签页的代码  div+1  div+7
//进入到本文件之前div+1
$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li>环评咨询";
$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);				//section+1;div+1
echo $st1;
echo"<div class='inner' id='modal_container' ><div class='block'><div class='panel shadow'><ul class='nav nav-tabs nav-tabs-hor' role='tablist'>";
$st1="<li role='presentation' class='%s'><a href='%s' aria-controls='share' role='tab' data-toggle='tab'>%s</a></li>";
$st2=sprintf($st1,$pg_sel[0][0],'#huanping','项目展示');
echo $st2;
$st2=sprintf($st1,$pg_sel[0][1],'#gethelp','寻求帮助');
echo $st2;
echo"</ul><div class='body'><div class='body body-settings'><div class='tab-content'>";
//}}}
//{{{第一页的代码 div+0
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
//{{{ 第二页的代码  div+0
$st=sprintf($ft0,$pg_sel[0][1],"gethelp");
echo $st;
foreach($pg_sel as $a)
{
	if(count($a)<3)
		continue;
	$st=sprintf($ft1,$a[0],$a[1],$a[2],$a[3],$a[4]);
	echo $st;
}
echo $ft2;
$i=0;
foreach($pg_sel as $a)
{
	if(count($a)<3)
		continue;
	$st=sprintf($ft3,$a[0],$a[1]);
	echo $st;
	if(count($gay[$i]) == 0)
	{
		$st=sprintf($ft4a,$a[5]);
		echo $st;
	}
	else
	{//这里添加ft4的循环
		$c=array();$c=$gay[$i];
		foreach($c as $b)
		{
			$st=sprintf($ft4,$b[1],$b[3],$b[2],$hipchat);
			echo $st;
			$st=sprintf($ft41,$b[4],$b[5],'hello world<br>hello world<br>hello world<br>hello world<br>hello world<br>hello world<br>hello world<br>hello world<br>hello world<br>hello world<br>hello world<br>hello world<br>hello world<br>hello world<br>hello world<br>helasdflkjasdflkj asdflkjasdf lkjasdfl kjasdflk jasdflka jsdfla kasdflo world<br>');
			echo $st;
		}
		$st=sprintf($ft4b,$gayc[0],$gayc[1],$gayc[2],$gayc[3],$gayc[4]);
		echo $st;
	}
	$i++;
}
echo $ft5;
//}}}

//{{{ 结束及jquery代码  div-8
echo"</div></div></div>";
echo"</div></div></div>";
?>
<style>
.pont:hover {cursor:pointer;}
.account-cursor{display:inline-block;max-width:200px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;vertical-align:text-bottom;position:relative;top:2px;cursor:pointer;}
.onlined{width:90%;display:inline-block;vertical-align:top;}
</style>
<script>
//{{{ JQuery for modified styles
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
		$("a").click(function(){
				var x=$(this).attr("weclick");
				var y=document.getElementById("glb_msg");
				switch(x)
				{
				case "tab1":
					y.innerHTML="我邀请的专家或团队";
					break;
				case "tab2":
					y.innerHTML="邀请我的客户或团队";
					break;
				}
				});
		$("span").click(function(){
				var x=$(this).attr("weclick");
				var y="#"+x+"a";
				$(y).slideToggle();
				if(y == "#mxx10a")
				{
					var u="mxx10b";
					ajax_init(u);
				}
				});
		});
//}}}
//{{{ AJax 
function ajax_init(u)
{
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById(u).innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","/huili/include/for_get.php",true);
	xmlhttp.send();
	setTimeout(ajax_get,2000);
	
}//}}}

</script>
<?php
echo $SIG_HTML['RIGHT_TOP3'];  //div-1;section-1;div-1;
//}}}
?>
