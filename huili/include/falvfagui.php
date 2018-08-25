<?php
//{{{ init
if(!defined("HOME_CALLED") || !isset($_SESSION['GLO_VAR']))
	die("access denied!");
/*下面的变量定义，区分了具体应用模块：
模块序号：（0）环评咨询；（1）环境工程；（2）环境监测；（3）项目验收；（4）清洁生产；（5）危废处理；（6）应急预案；
		  （7）排污申报；（11）环境法规；
元素0：模块序号，元素1：模块名称，元素2、3：横向标签页名，元素4：模块链接
 */
$glo_idx=array(11,'法律法规','法规目录','目录查询',$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ10']);	
//{{{ format define	
$ft0="<div role='tabpanel' class='tab-pane %s' id='%s'>
		<div class='inner-narrow inner-midnarrow'>
		    <div class='intro-block intro-block-slim'>
				<!--        <p>我的管理界面.</p> -->
				<p id='glb_msg'>执行标准汇编</p>
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
$ft5="</div></div></div></div>";     //div-4
//}}}
//{{{ data dispose
//下面的队列，第一个元素表示横向标签页的活动状态，后面两个表示交谈页面的纵向标签页的状态及信息
$pg_sel=array(array("",""),
		array("","coll","tab1","icon-group","文件汇编","您还没有合作的专家或团队"),
		array("","invit","tab2","icon-user","执行标准","普通账户无法发送博客"),
		array("","falv1","tab3","icon-quickbook-short","技术规范","普通账户无法发送博客"),
		array("","falv2","tab4","icon-book","地方法规","普通账户无法发送博客"),
		);
$debug_msg="";
$radio_ary=array(array("","重要文件","1"),array("","环保部复函","2"),array("","产业政策及规划","3"),array("","环保法律法规","4"),array("","水环境标准","5"),array("","气环境标准","6"),array("","清洁生产标准","7"),array("","其他环保标准","8"),array("","环境监测规范","9"),array("","环保技术规范","10"),array("","环评技术导则","11"),array("","环评工作资料","12"),array("","挥发性有机物(VOCs)专栏","13"),array("","山东省","14"),array("","北京市","15"),array("","上海市","16"),array("","河北省","17"),array("","河南省","18"),array("","云南省","19"),array("","天津市","20"),array("","内蒙古","21"));
//法律法规界面：取得的post和get分别为：$_POST['optionsRadios']和$_GET['class'],$_GET['iid'],$_GET['IDX'],先测试post
$pgcnt=array(0,0);
$pgidx=array();
$i=0;
$global_id=0;$global_num=1;$global_ix=0;
$ta=new tb_documents();
$shwmsg=array();$ay=array();
if(isset($_POST['optionsRadios']))
{
	$g=$_POST['optionsRadios'];
	$i=intval($g)-1;
	$radio_ary[$i][0]="checked";
	$j=$_POST['pg_num'];
	$pg_sel[$j][0]="active";
	$pg_sel[0][0]="active";
	$global_id=$i;   //save it
	$global_num=$j; //标志的活动页
	$v=array(0,$i);
	$ay=$ta->get_forward($v);
}
elseif(isset($_GET['cid']))
{
	$global_id=$_GET['cid']; //save it
	$global_ix=$_GET['idx']; //save idx
	$global_num=$_GET['num']; 
	$pg_sel[$global_num][0]="active";
	$pg_sel[0][0]="active";
	$radio_ary[$global_id][0]="checked";
	if(isset($_GET['fw']))//前翻页
	{
		$pgcnt[1]=$_GET['fw'];
		$v=array($global_ix,$global_id);
		$ay=$ta->get_forward($v);
	}
	else//后翻页
	{
		$pgcnt[1]=$_GET['bw'];
		$v=array($global_ix,$global_id);
		$ay=$ta->get_backward($v);
	}
}
else
{
	$pg_sel[0][0]="active";
	$pg_sel[1][0]="active";
	$radio_ary[0][0]="checked";
	$v=array(0,0);
	$ay=$ta->get_forward($v);
}
$shwmsg=array_pop($ay);
$pgidx=array($ay[0][1],$ay[0][2]);
$i=$ay[0][0];
$pgcnt[0]=floor($i/10); //项目展示页面
if($i % 10)
	$pgcnt[0]++;
if($pgcnt[1] > $pgcnt[0]) //保证不越界
{$pgcnt[1]=$pgcnt[0];}
elseif($pgcnt[1] < 0)
{$pgcnt[1]=0;}
$gayc=array('javascript:;','color: gray; cursor: default; disabled: true;','1','javascript:;','color: gray; cursor: default; disabled: true;');
//}}}
//}}}
?>
<?php
//{{{标签页的代码  div+1  div+7
//进入到本文件之前div+1
$st2="\n\n<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li>".$glo_idx[1]."<li>".$pg_sel[$global_num][4]."</li><li>".$radio_ary[$global_id][1];
$st1=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);				//section+1;div+1
echo $st1;
echo"\n<div class='inner' id='modal_container' ><div class='block'><div class='panel shadow'><ul class='nav nav-tabs nav-tabs-hor' role='tablist'>";
$st1="\n<li role='presentation' class='%s'><a href='%s' aria-controls='share' role='tab' data-toggle='tab'>%s</a></li>";
$st2=sprintf($st1,$pg_sel[0][0],'#huanping',$glo_idx[2]);
echo $st2;
$st2=sprintf($st1,$pg_sel[0][1],'#gethelp',$glo_idx[3]);
echo $st2;
echo"</ul><div class='body'><div class='body body-settings'><div class='tab-content'>";
//}}}
//{{{第一页的代码 div+0
echo"<div role='tabpanel' class='tab-pane ".$pg_sel[0][0]."' id='huanping'>";
echo "<ul class='list-unstyled list-accounts'>";
$st1="<li lid='%s' class='pont'><div>%s</div></li><li id='%s' style='display:none'><div style='width:100%%;margin:2px auto;'>";
$st3="<br><br>";
$st2="					</ul><div class='shareblock-body'>
							<div class='text-center'>
								<a href='%s' style='%s'>&lt;&lt;</a>&nbsp;&nbsp;&nbsp;%s&nbsp;&nbsp;&nbsp;<a href='%s' style='%s'>&gt;&gt;</a>
                            </div>
						 </div></div>";//需要输入：前翻页链接、前翻页链接样式、页码、后翻页链接、链接样式 div-2
$j=count($shwmsg);
//if($pgcnt[1] > 0)
//	die(var_dump($shwmsg));
for($i=0;$i<$j;$i++)
{
	$s1="Li00".$i;$s2=$s1.'x';
	$st=sprintf($st1,$s1,$shwmsg[$i][3],$s2);//,$shwmsg[$i][4]);
	echo $st;
	$sa1=substr($shwmsg[$i][4],-3);
	if(strtolower($sa1) == "pdf")
		echo "<object data='".$shwmsg[$i][4]."' type='application/pdf' width=100% height=800px>手机用户请下载浏览 : <a href='".$shwmsg[$i][4]."'>PDF文件</a></object>";
//		echo "<embed src='".$shwmsg[$i][4]."' type='alllication/pdf' width=100% height-800px>";
	else
	{
		$sa2=constant("FULL_PATH").substr($shwmsg[$i][4],7);
		include_once($sa2);
	}
	echo $st3;
	echo "</div></li>";
}
$ay=array();$j=$pgcnt[1];
if(intval($j) == 0) //设置0,1,2元素
{$ay[0]=$gayc[0];$ay[1]=$gayc[1];$ay[2]='1';}
else
{
	$ay[0]=$glo_idx[4]."&cid=".$global_id."&bw=".($j-1)."&idx=".$pgidx[0]."&num=".$global_num;
	$ay[1]="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
	$ay[2]=$j+1;
}
if($pgcnt[0] > 0)
	$i=$pgcnt[0]-1;
else
	$i=$pgcnt[0];
if(intval($j) == $i)//设置3,4元素
{$ay[3]=$gayc[3];$ay[4]=$gayc[4];}
else
{
	$ay[3]=$glo_idx[4]."&cid=".$global_id."&fw=".($j+1)."&idx=".$pgidx[1]."&num=".$global_num;
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
$a=array();$a=$pg_sel[1];
$st=sprintf($ft3,$a[0],$a[1]);
echo $st;
echo "<form action='".$glo_idx[4]."' method='post'><div class='radio'>";
for($i=0;$i<4;$i++)
{
	$st=sprintf("<div class='shareblock-head shareblock-head-light'><label style='text-align:center;'><input type='radio' name='optionsRadios' id='%s' value='%s' %s>%s</label></div>","rad".$radio_ary[$i][2],$radio_ary[$i][2],$radio_ary[$i][0],$radio_ary[$i][1]);
	echo $st;
}
echo "</div><br><div class='text-center'><input type='hidden' value='1' name='pg_num' /><button type='submit' class='btn btn-outline'>浏览查询</button></div></form>";
echo "</div></div>";
//第一纵标签页完成，开始第二纵标签页
$a=array();$a=$pg_sel[2];
$st=sprintf($ft3,$a[0],$a[1]);
echo $st;
echo "<form action='".$glo_idx[4]."' method='post'><div class='radio'>";
for($i=4;$i<8;$i++)
{
	$st=sprintf("<div class='shareblock-head shareblock-head-light'><label style='text-align:center;'><input type='radio' name='optionsRadios' id='%s' value='%s' %s>%s</label></div>","rad".$radio_ary[$i][2],$radio_ary[$i][2],$radio_ary[$i][0],$radio_ary[$i][1]);
	echo $st;
}
echo "</div><br><div class='text-center'><input type='hidden' value='2' name='pg_num' /><button type='submit' class='btn btn-outline'>浏览查询</button></div></form>";
echo "</div></div>";
//第三纵标签
$a=array();$a=$pg_sel[3];
$st=sprintf($ft3,$a[0],$a[1]);
echo $st;
echo "<form action='".$glo_idx[4]."' method='post'><div class='radio'>";
for($i=8;$i<13;$i++)
{
	$st=sprintf("<div class='shareblock-head shareblock-head-light'><label style='text-align:center;'><input type='radio' name='optionsRadios' id='%s' value='%s' %s>%s</label></div>","rad".$radio_ary[$i][2],$radio_ary[$i][2],$radio_ary[$i][0],$radio_ary[$i][1]);
	echo $st;
}
echo "</div><br><div class='text-center'><input type='hidden' value='3' name='pg_num' /><button type='submit' class='btn btn-outline'>浏览查询</button></div></form>";
echo "</div></div>";
//第四纵标签
$a=array();$a=$pg_sel[4];
$st=sprintf($ft3,$a[0],$a[1]);
echo $st;
echo "<form action='".$glo_idx[4]."' method='post'><div class='radio'>";
for($i=13;$i<21;$i++)
{
	$st=sprintf("<div class='shareblock-head shareblock-head-light'><label style='text-align:center;'><input type='radio' name='optionsRadios' id='%s' value='%s' %s>%s</label></div>","rad".$radio_ary[$i][2],$radio_ary[$i][2],$radio_ary[$i][0],$radio_ary[$i][1]);
	echo $st;
}
echo "</div>";
echo "<br><div class='text-center'><input type='hidden' value='4' name='pg_num' /><button type='submit' class='btn btn-outline'>浏览查询</button></div></form>";
echo $ft5;
echo "<div class='text-center'>".$debug_msg."</div>";

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
var user_pg	= <?php echo "'".$glo_idx[0]."'"?>;
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
				var z=document.getElementById("pg_num");
				switch(x)
				{
				case "tab1":
					y.innerHTML="执行标准汇编";
					z.value="0";
					break;
				case "tab2":
					y.innerHTML="环境部文件汇编";
					z.value="4";
					break;
				case "tab3":
					y.innerHTML="技术指导和规范";
					z.value="8";
					break;
				case "tab4":
					y.innerHTML="地方法规汇编";
					z.value="13";
					break;
				}
				});
		});
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
