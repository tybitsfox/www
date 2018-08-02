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
				<p id='glb_msg'>我的交流伙伴</p>
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

$ft4="                  <div class='shareblock-head shareblock-head-light' >
							<p class='shareblock-account'><span class='light'>%s</span> <strong><span class='account-cursor' weclick='%s'>%s</span></strong>%s</p>
                        </div>"; //需要输入：专家或团队提示、专家或团队名称、新消息标志、weclick    div+0
$ft41="<div id='%s' style='width:100%%;max-height:200px;background-color:transparent;margin:2px;overflow:auto;display:none;' data-trans='%s'><div id='%s'>%s<br></div><input type='text' class='form-control onlined' id='%s' value='' /></div>"; //需要的输入：(1)响应隐藏显示的控件id，(2)保存uid的data-trans,(3)更新记录的id,(4)记录消息msg
$ft5="</div></div></div></div>";     //div-4
$hipchat=" <span class='icon-hipchat'></span>";
//}}}
//{{{ data dispose
//下面的队列，第一个元素表示横向标签页的活动状态，后面两个表示交谈页面的纵向标签页的状态及信息
$pg_sel=array(array("active",""),
		array("active","coll","tab1","icon-user","我的交流","您还没有合作的专家或团队"),
		array("","invit","tab2","icon-group","发博客","普通账户无法发送博客"),
		);
//		array("","blog","tab3","icon-finder","发布公告","这里添加编辑框"),
//三个需要处理的动作：1、发送对话消息；2、上翻页；3、下翻页；这三个动作还要配合具体的标签页来处理。
//定义通过GET传送的参数：（1）上翻页：pageup ->；（2）下翻页：pagedown <-； （3）发送消息：sendmsg；（4）当前标签页：curpage；
$pgcnt=array(array(0,0),array(0,0));//元素队列中第一个元素表示项目展示页面，后两个元素表示第二页面纵向标签页的状态。元素第一项表示总的页数，第二项表示当前显示的页数,
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
	if(isset($_GET['pagemv'])) //点击翻页了
		$pgcnt[$p][1]=$_GET['pagemv'];
}
else //default
{
	$pg_sel[0][0]="active";
	$pg_sel[1][0]="active";
}
//$_SESSION['GLO_VAR']: 0->是否专家，
//将所有可聊天的账户合并为一个队列,不再分我邀请的和邀请我的
$gay=array();$cy=array();
if(count($_SESSION['GLO_VAR'][2]) == 0)
{
	$gay=$_SESSION['GLO_VAR'][1];
}
else
{
	foreach($_SESSION['GLO_VAR'][1] as $a)
	{
		$i=1;
		foreach($_SESSION['GLO_VAR'][2] as $b)
		{
			if($b[0] == $a[0]) //uid 
			{$i=0;break;}
		}
		if($i)
			array_push($cy,$a);
	}
	$cy=array_merge($cy,$_SESSION['GLO_VAR'][2]);
}
foreach($cy as $a)
{
	$ay=array();
	$ay[0]=$a[0]; //对方uid
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
	array_push($gay,$ay);
}

//到这里，所有的数据都已读取完毕，可以确定总的页数了，项目展示目前没涉及到数据库操作，为便于统一，后期用上数据库后取得的记录仍然使用shwmsg队列存储
//所以，这里只对shwmsg操作即可
$pgcnt[0][0]=floor(count($shwmsg)/5); //项目展示页面
if(count($shwmsg) % 5)
	$pgcnt[0][0]++;
$pgcnt[1][0]=floor(count($gay)/5); //我邀请的专家页面
if(count($gay) % 5)
	$pgcnt[1][0]++;
for($i=0;$i<2;$i++) //保证不越界
{
	if($pgcnt[$i][1] >= $pgcnt[$i][0])
		$pgcnt[$i][1]=$pgcnt[$i][0]-1;
	elseif($pgcnt[$i][1] < 0)
		$pgcnt[$i][1]=0;
}
$gayc=array('javascript:;','color: gray; cursor: default; disabled: true;','1','javascript:;','color: gray; cursor: default; disabled: true;');
//}}}
//}}}
?>
<?php
//{{{标签页的代码  div+1  div+7
//进入到本文件之前div+1
$st2="<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li>环境工程";
$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);				//section+1;div+1
echo $st1;
echo"<div class='inner' id='modal_container' ><div class='block'><div class='panel shadow'><ul class='nav nav-tabs nav-tabs-hor' role='tablist'>";
$st1="<li role='presentation' class='%s'><a href='%s' aria-controls='share' role='tab' data-toggle='tab'>%s</a></li>";
$st2=sprintf($st1,$pg_sel[0][0],'#huanping','工程实例');
echo $st2;
$st2=sprintf($st1,$pg_sel[0][1],'#gethelp','合作交流');
echo $st2;
echo"</ul><div class='body'><div class='body body-settings'><div class='tab-content'>";
//}}}
//{{{第一页的代码 div+0
echo"<div role='tabpanel' class='tab-pane active' id='huanping'>";
echo "<ul class='list-unstyled list-accounts'>";
$st1="<li lid='%s' class='pont'><div>%s</div></li><li id='%s' style='display:none'><div style='width:100%%;margin:2px auto;'>%s<br><div class='blog-img'><img src='%s' /></div><br>";
$st2="					</ul><div class='shareblock-body'>
							<div class='text-center'>
								<a href='%s' style='%s'>&lt;&lt;</a>&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;<a href='%s' style='%s'>&gt;&gt;</a>
                            </div>
						 </div></div>";//需要输入：前翻页链接、前翻页链接样式、页码、后翻页链接、链接样式 div-2
for($i=0;$i<5;$i++)
{
	$j=$pgcnt[0][1]*5+$i;
	if($j >= count($shwmsg))
		break;
	$s1="Li00".$i;$s2=$s1.'x';
	$st=sprintf($st1,$s1,$shwmsg[$j][0],$s2,$shwmsg[$j][1],$shwmsg[$j][2]);
	echo $st;
	$st=constant("FULL_PATH").$shwmsg[$j][3];
	include_once($st);
	if($_SESSION['CURR_USR'][0] <= 100001)
	{
		$s1="<br><a href='#' style='color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;'>删除</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' style='color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;'>隐藏</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' style='color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;'>封禁帐号</a><br>";
		echo $s1;
	}
	echo "</div></li>";
}
$ay=array();$j=$pgcnt[0][1];
if(intval($j) == 0) //设置0,1,2元素
{$ay[0]=$gayc[0];$ay[1]=$gayc[1];$ay[2]='1';}
else
{
	$ay[0]=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ2']."&curpage=0&pagemv=".($j-1);
	$ay[1]="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
	$ay[2]=$j+1;
}
if(intval($j) == intval($pgcnt[0][0]-1))//设置3,4元素
{$ay[3]=$gayc[3];$ay[4]=$gayc[4];}
else
{
	$ay[3]=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ2']."&curpage=0&pagemv=".($j+1);
	$ay[4]="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
}
$st=sprintf($st2,$ay[0],$ay[1],$ay[2],$ay[3],$ay[4]);
echo $st;
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
$a=array();$a=$pg_sel[1];
$st=sprintf($ft3,$a[0],$a[1]);
echo $st;
if(count($gay) == 0)
{
	$st=sprintf($ft4a,$a[5]);
	echo $st;
}
$c=array();$c=$gay;
for($k=0;$k<5;$k++)
{
	$j=$pgcnt[1][1]*5+$k;
	if($j >= count($c))
		break;
	$b=array();
	$b=$c[$j];
	$st=sprintf($ft4,$b[1],$b[3],$b[2],$hipchat);
	echo $st;
	$st=sprintf($ft41,$b[4],$b[0],$b[5],'',$b[3]."c");
	echo $st;
}
$ay=array();$j=$pgcnt[1][1];
if(intval($j) == 0)
{$ay[0]=$gayc[0];$ay[1]=$gayc[1];$ay[2]='1';}
else
{
	$ay[0]=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ2']."&curpage=".($i+1)."&pagemv=".($j-1);
	$ay[1]="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
	$ay[2]=$j+1;
}
if(intval($j) == intval($pgcnt[1][0]-1))//设置3,4元素
{$ay[3]=$gayc[3];$ay[4]=$gayc[4];}
else
{
	$ay[3]=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ2']."&curpage=".($i+1)."&pagemv=".($j+1);
	$ay[4]="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
}
$st=sprintf($ft4b,$ay[0],$ay[1],$ay[2],$ay[3],$ay[4]);
echo $st;
//第一纵标签页完成，开始第二纵标签页
$a=array();$a=$pg_sel[2];
$st=sprintf($ft3,$a[0],$a[1]);
echo $st;
echo "<div><center><font color=red>发文须知</font></center><br>1、目前博客功能仅对认证账户开放。<br>2、请遵守国家相关的法律法规，不得发送违法法律法规的博文。<br>3、所发的博文仅代表作者的观点，本站不做评价。<br>4、对违反法律、规定发送不当博文的，我们有权删除其文章并对作者处以封号处罚。<br><br></div><div class='text-center'><a href='javascript:;' class='btn btn-primary' onclick='aaa();'>了解并开始编写</a></div>
<div id='testid'></div>
<div id='qqq' class='modal in' aria-hidden='false' tabindex=-1 style='display:none;padding-right: 13px;'>
	<div class='modal-dialog'>
	<input type='text' id='blogtitle' style='width:100%;margin:1px auto;padding:1px auto;' placeholder='标题' value='' /><br>
		  <div id='summernote'></div>
		  <div class='text-center'><a href='javascript:;' onclick='bbb(0);' class='btn btn-primary'>发送</a>&nbsp;&nbsp;&nbsp;<a href='javascript:;' onclick='bbb(1);' class='btn btn-primary'>取消</a></div>
	</div>
</div>";
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
var user_id = <?php echo "'".$_SESSION['CURR_USR'][0]."'"; ?>;
var user_aa = <?php echo "'".$_SESSION['CURR_USR'][14]."'"; ?>;
//编辑框的弹出响应函数
function aaa()
{
	$("#qqq").show();
	$(document).ready(function(){
			$('#summernote').summernote({
					toolbar: [
							    ['color', ['color']],
								['para', ['ul', 'ol', 'paragraph']],
								['style',['style']], 
								['font', ['bold', 'italic', 'underline', 'clear']],
							    ['insert', ['picture']],
								['table', ['table']],
							    ['view', ['fullscreen', 'codeview']],
							 ], 
					placeholder: '这里写正文',
					height: '300px',
					lang:'zh-CN',
					focus:true,
					disableDragAndDrop:true,
					callbacks: {onImageUpload: function(files) {sendFile(files[0]);}}		
					});
			});
}
//图片上传的回调函数
function sendFile(file)
{
	var da;
	if(user_id == null)
		da="unknown";
	else
		da=user_id;
//	var db=$("#blogtitle").val();
    data = new FormData();
    data.append("file", file);
	data.append("val",da);
//	data.append("title",db);
    $.ajax({
        data: data,
        type: "POST",
        url: "/huili/callback/summ_support.php",
        cache: false,
        contentType: false, //'multipart/form-data',
        processData: false,
        success: function(url) {
                $('#summernote').summernote('editor.insertImage', url);
        }
    });	
}
//编辑框的保存和退出函数
function bbb(i)
{
	if(i == 0)
	{
		var st=$('#summernote').summernote('code');
		var ti=$("#blogtitle").val();
		data=new FormData();
		data.append("idx","1");
		data.append("ttle",ti);
		data.append("nam",user_aa);
		data.append("bod",st);
		data.append("uid",user_id);
		$.ajax({
			data: data,
			type: "POST",
			url: "/huili/callback/summ_save.php",
			cache: false,
			contentType: false,
			processData: false,
			success: function(url){
				$("#blogtitle").val('');
				$("#summernote").summernote('reset');
				$("#testid").text(url);
				},
			error: function(url){$("#testid").text('aaa');}
			}); 
	}
	$("#qqq").hide();
	$('#summernote').summernote('destroy');
}
//{{{ JQuery for modified styles
$(document).ready(function(){
		var namea="";
		$("li").click(function(){//第一标签页，项目展示的开关设置
				var vid=$(this).attr("lid");
				if(vid == null)
					return;
				var x="#"+vid+"x";
				$(x).slideToggle();
				});
		$("a").click(function(){//第二标签页，纵向标签页切换时的提示设置
				var x=$(this).attr("weclick");
				var y=document.getElementById("glb_msg");
				switch(x)
				{
				case "tab1":
					y.innerHTML="我交流伙伴";
					break;
				case "tab2":
					y.innerHTML="我的博客";
					break;
				}
				});
		$("span").click(function(){//第二标签页，详细聊天记录显示的开关设置，并调用了ajax获取数据
				var x=$(this).attr("weclick");
				var na=$(this).text();
				if(x == null)
					return;
				var y="#"+x+"a";
				var z=$(y).attr("data-trans"); //对方uid
				$(y).slideToggle();
				var u=x+"b";
				ajax_init(u,y,z,na);
				setTimeout(function(){delay(y)},1000);
//				$(y).scrollTop(1000); //max-height:200px <- 不延时的话，会出现数据加载还没玩就滑动了，这样滑动不到低端
				var o="#"+x+"c";
				$(o).bind('keypress',function(event){
						if(event.keyCode == 13)
						{
							var s=$(o).val();
							ajax_save(z,s,u);
							$(o).val("");
						}
						});
				});
		});
//}}}
//{{{ AJax for get data
function ajax_init(u,v,w,x)
{
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById(u).innerHTML=xmlhttp.responseText;
//			$(v).scrollTop(1000); //max-height:200px  放在这里会时时刷新，不行 -_-！
		}
	}
	var url="/huili/include/for_get.php?aid="+user_id+"&bid="+w+"&mod=0&uname="+x;
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
	if($(v).is(":hidden"))	//看看在这样能否执行 ok!! 使用alert测试成功！！
		return; //关闭前执行更新
	else
		setTimeout(function(){ajax_init(u,v,w,x)},3000);//30秒一更新
}
function ajax_save(u,s,w) //保存对话记录
{
	var xmlhttp=new XMLHttpRequest();
//	xmlhttp.onreadystatechange=function()
//	{
//		if(xmlhttp.readyState==4 && xmlhttp.status==200)
//		{
//			document.getElementById(w).innerHTML=xmlhttp.responseText;
//		}
//	}
	xmlhttp.open("POST","/huili/include/for_save.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	var aa="aid="+user_id+"&bid="+u+"&mod=0&msg="+s;
	xmlhttp.send(aa);
}
//}}}
//{{{ delay function
function delay(u)
{$(u).scrollTop(1000);}
//}}}
</script>
<?php
echo $SIG_HTML['RIGHT_TOP3'];  //div-1;section-1;div-1;
//}}}
?>
