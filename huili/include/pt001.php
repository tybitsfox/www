<script>
loadscript("/huili/css/newstyle.css","css");
loadscript("/huili/js/Chart.min.js","js");
</script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=Wst0GYAGq6QfZG1fGTwNxGLD9CBW5N99"></script>
<?php
//{{{变量、初始化
if(!defined("HOME_CALLED") || !isset($_SESSION['GLO_VAR']))
	die("access denied!");
$glo_idx=array(12,'土壤监测','点位总览','站点明细','监测数据',$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ12']);
$pg_sel=array(array("","mlview","点位总览"),array("","mlintro","点位明细"),array("","mladdr","监测数据")); //活动状态，id，标题
$pg_sel[0][0]="active";
$act_val=array(0,"","","",0,0);//操作代码，名称，行业，所属，翻页方向，idx。
$pg_cnt=array(0,0,0,0); //翻页操作所用变量：当前页号，总页数（可继续翻页标志），当前最小idx,当前最大idx
$msg01="<p>点位总览</p>";  //测试，显示测试信息用
$shwmsg=array(); //显示信息队列
$area_ay=array(); //地市队列，这里颗粒度设为地市，所以就一个结果
//2010-10-12添加，用于保存或初始化控件所用的变量
$cur_ay=array("date" => 2017,"ds" => "泰安市","qx" => 370900,"dw" => "0");
if(isset($_GET["cp"]))
{
	$pg_cnt[0]=$_GET["cp"];
	$cur_ay["date"]=$_GET["cd"];
	$cur_ay["qx"]=$_GET["qx"];
	$cur_ay["dw"]=$_GET["dw"];
	$pg_sel[1][0]="active";$pg_sel[0][0]="";$pg_sel[2][0]="";
}
if(isset($_POST["area_sel4"]))
{$cur_ay["date"]=$_POST["area_sel4"];}
if(isset($_POST["area_sel2"]))
{$cur_ay["qx"]=$_POST["area_sel2"];}
if(isset($_POST["area_sel3"]))
{$cur_ay["dw"]=$_POST["area_sel3"];}

$tb=new zl($cur_ay["date"]);
$area_ay=$tb->get_act_area();
$station_ay=array(); //站点队列
$tmp_ay=array(0,0,0,0);
$v1=intval($cur_ay["qx"]);
if(($v1 % 100) == 0)//两种可能：取得全部点位，按类型取得点位
{
	if(intval($cur_ay["dw"]) == 0) //取得全部点位
		$tmp_ay=array(0,0,0,0);
	else
		$tmp_ay=array(3,0,intval($cur_ay["dw"])-1,0);
}
else//两种可能：按区划取得点位，按区划和类型取得点位
{
	if(intval($cur_ay["dw"]) == 0) //按区划
		$tmp_ay=array(1,$v1,0,0);
	else
		$tmp_ay=array(2,$v1,intval($cur_ay["dw"])-1,0);
}
$station_ay=$tb->get_station($tmp_ay);
$val_ay=array();//数据队列
$tmp_ay[3]=1; //默认为镉
$val_ay=$tb->get_val($tmp_ay);

$pg_cnt[1]=floor(count($station_ay)/10);
if(count($station_ay)%10)
	$pg_cnt[1]++;
//}}}
?>
<?php
	$st1="泰安市";
	foreach($area_ay as $a)
	{
		if(intval($a[0]) == intval($cur_ay["qx"]))
		{$st1=$a[1];break;}
	}
	$sa=array("全部点位","基础点位","质控点位","背景点位","质控和背景点位");
	$st2="\n\n<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li>".$glo_idx[1]."</li><li>".$cur_ay["date"]."年</li><li>".$st1."</li><li>".$sa[intval($cur_ay["dw"])];
	$st=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
	echo $st;
	echo"\n<div class='inner' id='modal_container' ><div class='block'><div class='panel shadow'><ul class='nav nav-tabs nav-tabs-hor' role='tablist'>";
	$st1="\n<li role='presentation' class='%s' id='vdv%d'><a href='javascript:;' onclick='switch_pg(%d,0);'>%s</a></li>";
	for($i=0;$i<3;$i++)
	{
		$st2=sprintf($st1,$pg_sel[$i][0],$i,$i,$pg_sel[$i][2]);
		echo $st2;
	}
	echo"\n</ul><div class='body'><div class='body body-settings'><div class='tab-content'>";
//{{{page one 企业浏览
	echo"\n<div role='tabpanel' class='tab-pane ".$pg_sel[0][0]."' id='".$pg_sel[0][1]."'>";
	echo "<div id='allmap' style='width:100%;height:400px;'></div>";
	echo "</div>";	
echo "<script>";
$st1="var map = new BMap.Map('allmap');map.centerAndZoom('%s', 10);map.addControl(new BMap.MapTypeControl());";
$st2="泰安"; //default
foreach($area_ay as $a)
{
	if(($a[0] % 100) == 0)
	{$st2=$a[1];break;}
}
$st=sprintf($st1,$st2);
echo $st."\n";
$st=sprintf("map.setCurrentCity('%s');map.enableScrollWheelZoom(true);\n",$st2);
echo $st;
$st=sprintf("var opts = {width:300,height:130,title:'%s',enableMessage:true};\n",$st2);
echo $st;
$st1="var content = \"<div style='margin:0;line-height:20px;padding:2px;'><img src='.%s' alt='' style='float:right;zoom:1;overflow:hidden;width:100px;height:100px;margin-left:3px;'/>点位名称：%s<br>点位代码：<font color=red>%s</font><br>经度：<font color=blue>%0.6f</font><br>纬度：<font color=blue>%0.6f</font></div>\";\n";
foreach($station_ay as $a)
{
	$st=sprintf($st1,$a[5],$a[1],$a[6],$a[2],$a[3]);
	echo $st;
	$st=sprintf("var marker = new BMap.Marker(new BMap.Point(%0.6f,%0.6f));map.addOverlay(marker);addClickHandler(content,marker);",$a[2],$a[3]);
	echo $st;
}
echo "function addClickHandler(content,marker){marker.addEventListener('click',function(e){openInfo(content,e)});};";
echo "function openInfo(content,e){var p = e.target;var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);var infoWindow = new BMap.InfoWindow(content,opts);map.openInfoWindow(infoWindow,point);};";
echo "</script>";
//}}}	
//{{{page two 企业信息
	echo"\n<div role='tabpanel' class='tab-pane ".$pg_sel[1][0]."' id='".$pg_sel[1][1]."'>";
	echo "<ul class='list-unstyled list-accounts'>";
	echo "<div id='showtb'></div>";
	$st1="<li lid='%s' class='pont'><div><font color='blue'>%s</font></div></li><li id='%s' style='display:none'><div style='width:100%%;overflow:auto;margin:auto;'><table class='table table-bordered'><tbody><tr><td style='white-space:nowrap;text-align:center;'><font color='red'>项目名称</font></td><td style='white-space:nowrap;text-align:center;'><font color='red'>项目内容</font></td><td style='white-space:nowrap;text-align:center;'><font color='red'>项目名称</font></td><td style='white-space:nowrap;text-align:center;'><font color='red'>项目内容</font></td></tr>";
	$st2="<tr><td align='center'>%s</td><td align='center'>%s</td><td align='center'>%s</td><td align='center'>%s</td></tr>";
	$stn="</tbody></table></div></li>";
	$ay=array();
	for($i=0;$i<10;$i++)
	{
		$j=$pg_cnt[0]*10+$i;
		if($j>=count($station_ay))
			break;
		$ay=$station_ay[$j];
		$st=sprintf($st1,"Li00".$i,$ay[1],"Li00".$i."x");
		echo $st;
		$st=sprintf($st2,"点位编号",$ay[6],"采样地点",$ay[7]);echo $st;
		$st=sprintf($st2,"经度",$ay[2],"纬度",$ay[3]);echo $st;
		$st=sprintf($st2,"采样时间",$ay[8],"天气",$ay[9]);echo $st;
		$st=sprintf($st2,"样品编号",$ay[10],"采样深度",$ay[11]);echo $st;
		$st=sprintf($st2,"海拔",$ay[12],"土地利用",$ay[13]);echo $st;
		$st=sprintf($st2,"作物类型",$ay[14],"灌溉类型",$ay[15]);echo $st;
		$st=sprintf($st2,"地形地貌",$ay[16],"土壤类型",$ay[17]);echo $st;
		$st=sprintf($st2,"土壤质地",$ay[18],"土壤颜色",$ay[19]);echo $st;
		$st=sprintf($st2,"土壤湿度",$ay[20],"样品重量",$ay[21]);echo $st;
		$st=sprintf($st2,"周边信息-东",$ay[22],"周边信息-西",$ay[23]);echo $st;
		$st=sprintf($st2,"周边信息-南",$ay[24],"周边信息-北",$ay[25]);echo $st;
		$j=intval($ay[4]);
		switch($j)
		{
		case 0://基础
			$sc="基础点位";
			break;
		case 1://质控点位
			$sc="质控点位";
			break;
		case 2://背景点位
			$sc="背景点位";
			break;
		default:
			$sc="质控背景点位";
		};
		$st=sprintf($st2,"点位类型",$sc,"采样人",$ay[26]);echo $st;
		$st=sprintf($st2,"记录人",$ay[27],"校对人",$ay[28]);echo $st;
		echo $stn;
	}
	echo"</ul>";
	$st1="<div class='shareblock-body'>
		<div class='text-center'>
		<a href='%s' style='%s'>&lt;&lt;</a>&nbsp;&nbsp;&nbsp;%d&nbsp;&nbsp;&nbsp;<a href='%s' style='%s'>&gt;&gt;</a>
		</div>
		</div>";
	if($pg_cnt[0] == 0)
	{
		$sta1="color: gray; cursor: default; disabled: true;";
		$sta4="javascript:;";
	}
	else
	{
		$bb=intval($pg_cnt[0])-1;
		$sta1="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta4=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ12']."&cp=".$bb."&cd=".$cur_ay["date"]."&qx=".$cur_ay["qx"]."&dw=".$cur_ay["dw"];
	}
	if($pg_cnt[0] >= ($pg_cnt[1]-1))
	{
		$sta2="color: gray; cursor: default; disabled: true;";
		$sta3="javascript:;";
	}
	else
	{
		$bb=intval($pg_cnt[0])+1;
		$sta2="color: #3EAE48; text-decoration: none; border-bottom: 1px solid #3EAE48;";
		$sta3=$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ12']."&cp=".$bb."&cd=".$cur_ay["date"]."&qx=".$cur_ay["qx"]."&dw=".$cur_ay["dw"];
	}
	$st=sprintf($st1,$sta4,$sta1,$pg_cnt[0]+1,$sta3,$sta2);
	echo $st;
	echo"</div>";
//}}}
//{{{page three 企业地址
	echo"\n<div role='tabpanel' class='tab-pane ".$pg_sel[2][0]."' id='".$pg_sel[2][1]."'>";
	$j=count($val_ay)*22;
	if($j < 400)
		$j=400;
	echo "\n<div style='width:100%;height: ".$j."px;'>";
	echo "<canvas id='myChart'></canvas>";
	echo "</div></div>";
	echo "<script>";
	echo "var ctx = document.getElementById('myChart').getContext('2d');";
	echo "var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {";
	$s1="labels: [";
	$i=0;$j=count($val_ay);
	$s2="data: [";
	foreach($val_ay as $a)
	{
		$s1.="'".$a[1]."'";
		$s2.=$a[0];
		$i++;
		if($i < $j)
		{$s1.=", ";$s2.=", ";}
		else
		{$s1.="],";$s2.="],";}
	}
	echo $s1;
//    echo  "labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    echo  "datasets: [{
            label: ' 项目 ".$a[2]."',";
//    echo  " data: [12, 19, 3, 5.7, 2, 3],";
	echo $s2;
    echo  " backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255,99,132,1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            xAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
		title:{
			display: true,
			text: '2017年土壤监测项目'
		},
		maintainAspectRatio: false,			  
    }
});";
echo "</script>";
//}}}



//{{{ 查询、过滤	
	echo"</div></div></div>";
	echo"</div></div></div>";
	echo "\n<div id='slide1' class='inner'><div class='order-empty panel'>";
//{{{按名称过滤	
?>
<div class="form">
<div class="searchbar">
	<div class="searchbar-search"><form action="<?php echo $glo_idx[5];?>" method="post">
		<div class="form-group">
			<div class="form-prefix">
				<i class="icon-search picto"></i>
				<input class="form-control form-search" id="byname01" name="byname01" placeholder="按名称查找" value="" type="text">
			</div>
			<input type="hidden" value="" name="hycode" id="hycode" />
			<input type="hidden" value="" name="sdcode" id="sdcode" />
			<button type="submit" class="btn btn-search">查找</button>
		</div></form>	
	</div>
<?php
//}}}
//{{{按行业过滤
?>	
	<div class="searchbar-dates">
		<div class="dropdown dropdown-filtersa">
			<div class="form-group">
				<div class="form-prefix">
					<i class="icon-filter picto"></i>
					<input class="form-control form-daterange" id="texta2" placeholder="点位过滤" value="" type="text">
					<span class="caret"></span>
				</div>
			</div>
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-filters">
				<div class="dropdown-menu-head text-right">
					<a class="btn-text" href="javascript:;" onclick="set_vv(2);">清空过滤</a>
				</div><form action="<?php echo $glo_idx[5];?>" method="post">
				<div class="dropdown-menu-body form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label">所属时期</label>
						<div class="col-sm-9">
							<select class="form-control" name="area_sel4" id="area_sel4">
							<?php
								$ay=array();$ay=array_keys($PT_NAME_TY);$year=date("Y");
								foreach($ay as $a)
								{
									if(intval($a)>$year)
										continue;
									elseif(intval($a) == $cur_ay["date"])
									{$st=sprintf("<option value='%s' selected='selected'>%s</option>",$a,$a);}
									else
									{$st=sprintf("<option value='%s'>%s</option>",$a,$a);}
									echo $st;
								}
							?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">所属地市</label>
						<div class="col-sm-9">
							<select class="form-control" id="area_sel1">
							<?php
								foreach($area_ay as $a)
								{
									if(($a[0] % 100) == 0)
									{
										$st=sprintf("<option value='%s' selected='selected'>%s</option>",$a[0],$a[1]);
										echo $st;
									}
								}
							?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">所属区县</label>
						<div class="col-sm-9">
							<select class="form-control" name="area_sel2" id="area_sel2">
							<?php
								$cc=array();
								foreach($area_ay as $b)
								{
									if((intval($b[0]) % 100) == 0)
										$cc=array($b[0],"全市");
									else
										$cc=array($b[0],$b[1]);
									if(intval($b[0]) == intval($cur_ay["qx"]))
										$st=sprintf("<option value='%s' selected='selected'>%s</option>",$cc[0],$cc[1]);
									else
										$st=sprintf("<option value='%s'>%s</option>",$cc[0],$cc[1]);
									echo $st;
								}
							?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">点位类型</label>
						<div class="col-sm-9">
							<select class="form-control" name="area_sel3" id="area_sel3">
							<?php
								$sa=array("全部点位","基础点位","质控点位","背景点位","质控和背景点位");
								for($i=0;$i<5;$i++)
								{
									if($i == intval($cur_ay["dw"]))
										$st=sprintf("<option value='%d' selected='selected'>%s</option>",$i,$sa[$i]);
									else
										$st=sprintf("<option value='%d'>%s</option>",$i,$sa[$i]);
									echo $st;
								}
							?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">&nbsp;</label>
						<div class="col-sm-9">
							<input type="hidden" value="y" name="btnsel1" id="btnsel1" />
							<input type="hidden" value="370900" name="btnsel2" id="btnsel2" />
							<input type="hidden" value="a" name="btnsel3" id="btnsel3" />
							<button type="submit" class="btn btn-primary btn-block">应用查询</button> 
						</div>
					</div>
				</div></form>
			</div>
		</div>
	</div>
<?php
//}}}
//{{{按属地过滤
?>	
	<div class="searchbar-filters">
		<div class="dropdown dropdown-filters">
			<div class="form-group">
		   		<div class="form-prefix">
					<i class="icon-filter picto"></i>
					<input class="form-control form-filters" id="texta1" placeholder="项目过滤" value="" type="text">
					<span class="caret"></span>
				</div>	
			</div>
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-filters">
				<div class="dropdown-menu-head text-right">
					<a class="btn-text" href="javascript:;" onclick="set_vv(1);">清空过滤</a>
				</div><form action="<?php echo $glo_idx[5];?>" method="post">
				<div class="dropdown-menu-body form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label">地市</label>
						<div class="col-sm-9">
							<select class="form-control" id="area_sel1">
							<?php
								foreach($area_ay as $a)
								{
									if(($a[0] % 100) == 0)
									{
										$st=sprintf("<option value='%s' selected='selected'>%s</option>",$a[0],$a[1]);
										echo $st;
									}
								}
							?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">区县</label>
						<div class="col-sm-9">
							<select class="form-control" id="area_sel2">
							<?php
								foreach($area_ay as $b)
								{
									if(($b[0] % 100) == 0)
										$st=sprintf("<option value='%s' selected='selected'>全市</option>",$b[0]);
									else
										$st=sprintf("<option value='%s'>%s</option>",$b[0],$b[1]);
									echo $st;
								}
							?>
							</select>
						</div>
					</div>
					<div class="form-group">
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">类型过滤</label>
						<div class="col-sm-9">
							<div class="btn-group btn-group-switch">
								<button class="btn active" id="btngrp1">考虑</button>
								<button class="btn" id="btngrp2">不考虑</button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">&nbsp;</label>
						<div class="col-sm-9">
							<input type="hidden" value="y" name="btnsel" id="btnsel" />
							<input type="hidden" value="a" name="btnsela" id="btnsela" />
							<input type="hidden" value="370900" name="btnselb" id="btnselb" />
							<button type="submit" class="btn btn-primary btn-block">应用查询</button> 
						</div>
					</div>
				</div></form>
			</div>
		</div>
	</div>
<?php
//}}}
//{{{移动端高级搜索
?>	
	<div class="searchbar-advanced"><p></p>
		<a href="#" class="btn-text btn-advancedsearch">高级搜索</a>
	</div>
</div>
<?php
//}}}
//{{{ js & jquery
?>
<script>
var iflag=0;
var jflag=0;
var indx=0;
$(document).ready(function(){
	$("#texta1").click(function(){
			$(".dropdown-filtersa").removeClass("open");
			var s=$("#area_sel1").find("option:selected").text();
			if($("#area_sel2").val() > 1)
				s=$("#area_sel2").find("option:selected").text();
			if($("#texta1").is(":visible"))
			{
				if(iflag == 0)
				{$("#texta1").val(s);}
				else
				{iflag=0;}
			}
			$(".dropdown-filters").toggleClass("open");
			});
	$("#texta2").click(function(){
			$(".dropdown-filters").removeClass("open");
			var v=$("#area_sel3").val();
			var w=v;
			if($("#texta2").is(":visible"))
			{
				if(jflag == 0)
				{$("#texta2").val(w);}
				else
				{jflag=0;}
			}
			$(".dropdown-filtersa").toggleClass("open");
			});
	$(".btn-advancedsearch").click(function(){
			$(".searchbar-dates").show();
			$(".searchbar-filters").show();
			});
	$("li").click(function(){//第一标签页，项目展示的开关设置
			var vid=$(this).attr("lid");
			if(vid == null)
				return;
			var x="#"+vid+"x";
			$(x).slideToggle();
			});
});

function set_vv(v)
{
	if(v == 1)
	{
		iflag=1;document.getElementById("texta1").value="";document.getElementById("sdcode").value="";
		document.getElementById("btnsel2").value="";document.getElementById("btnselb").value="";
		$(".dropdown-filters").toggleClass("open");
	}
	else
	{
		jflag=1;document.getElementById("texta2").value="";
		$(".dropdown-filtersa").toggleClass("open");
	}
};
function switch_pg(i,j)
{
	if(i == 0)
	{
		$("#vdv0").addClass("active");
		$("#vdv1").removeClass("active");
		$("#vdv2").removeClass("active");
		$("#mlview").addClass("active");
		$("#mlintro").removeClass("active");
		$("#mladdr").removeClass("active");
	}
	else if(i == 1)
	{
		$("#vdv1").addClass("active");
		$("#vdv0").removeClass("active");
		$("#vdv2").removeClass("active");
		$("#mlintro").addClass("active");
		$("#mlview").removeClass("active");
		$("#mladdr").removeClass("active");
	}
	else if(i == 2)
	{
		$("#vdv2").addClass("active");
		$("#vdv0").removeClass("active");
		$("#vdv1").removeClass("active");
		$("#mladdr").addClass("active");
		$("#mlview").removeClass("active");
		$("#mlintro").removeClass("active");//这里添加地图信息
	}
	else if(i == 3)
	{
		$("#vdv1").addClass("active");
		$("#vdv0").removeClass("active");
		$("#vdv2").removeClass("active");
		$("#mlintro").addClass("active");
		$("#mlview").removeClass("active");
		$("#mladdr").removeClass("active");
		indx=j;
	}
};
</script>
<?php
//}}}
//}}}
	echo "</div></div></div>";
	echo $SIG_HTML['RIGHT_TOP3'];
?>

