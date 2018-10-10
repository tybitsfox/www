<script>
loadscript("/huili/css/newstyle.css","css");
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
$tb=new zl('2017');
$area_ay=$tb->get_act_area();
$station_ay=array(); //站点队列
$tmp_ay=array(0,0,0,0);
$station_ay=$tb->get_station($tmp_ay);

//}}}
?>
<?php
	$st2="\n\n<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li>".$glo_idx[1];
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
	$st=sprintf($st1,$a[5],$a[1],$a[2],$a[3],$a[4]);
	echo $st;
	$st=sprintf("var marker = new BMap.Marker(new BMap.Point(%0.6f,%0.6f));map.addOverlay(marker);addClickHandler(content,marker);",$a[3],$a[4]);
	echo $st;
}
echo "function addClickHandler(content,marker){marker.addEventListener('click',function(e){openInfo(content,e)});};";
echo "function openInfo(content,e){var p = e.target;var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);var infoWindow = new BMap.InfoWindow(content,opts);map.openInfoWindow(infoWindow,point);};";
echo "</script>";
//}}}	
//{{{page two 企业信息
	echo"\n<div role='tabpanel' class='tab-pane ".$pg_sel[1][0]."' id='".$pg_sel[1][1]."'>";
	echo "<ul class='list-unstyled list-accounts'>";
	echo "<li><div id='intro_show' style='width:100%%;margin:2px auto;'></div></li>";
	echo"</ul></div>";
//}}}
//{{{page three 企业地址
	echo"\n<div role='tabpanel' class='tab-pane ".$pg_sel[2][0]."' id='".$pg_sel[2][1]."'>";
	echo "</div>";
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
					<input class="form-control form-daterange" id="texta2" placeholder="全部点位" value="" type="text">
					<span class="caret"></span>
				</div>
			</div>
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-filters">
				<div class="dropdown-menu-head text-right">
					<a class="btn-text" href="javascript:;" onclick="set_vv(2);">清空过滤</a>
				</div>
				<div class="dropdown-menu-body form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label">点位类型</label>
						<div class="col-sm-9">
							<select class="form-control" name="area_sel3" id="area_sel3">
								<option value="全部点位" selected="selected">全部点位</option>
								<option value="正常点位">正常点位</option>
								<option value="质控点位">质控点位</option>
								<option value="背景点位">背景点位</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">所属时期</label>
						<div class="col-sm-9">
							<select class="form-control" name="area_sel4" id="area_sel4">
							<?php
								$ay=array();$ay=array_keys($PT_NAME_TY);$year=intval(date("Y"));
								foreach($ay as $a)
								{
									if(intval($a)>$year)
										continue;
									elseif(intval($a) == $year)
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
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">属地过滤</label>
						<div class="col-sm-9">
							<div class="btn-group btn-group-switch">
								<button class="btn active" id="btngrp3">考虑</button>
								<button class="btn" id="btngrp4">不考虑</button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">&nbsp;</label><form action="<?php echo $glo_idx[5];?>" method="post">
						<div class="col-sm-9">
							<input type="hidden" value="y" name="btnsel1" id="btnsel1" />
							<input type="hidden" value="370900" name="btnsel2" id="btnsel2" />
							<input type="hidden" value="a" name="btnsel3" id="btnsel3" />
							<button type="submit" class="btn btn-primary btn-block">应用查询</button> 
						</div></form>
					</div>
				</div>
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
					<input class="form-control form-filters" id="texta1" placeholder="按属地过滤" value="" type="text">
					<span class="caret"></span>
				</div>	
			</div>
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-filters">
				<div class="dropdown-menu-head text-right">
					<a class="btn-text" href="javascript:;" onclick="set_vv(1);">清空过滤</a>
				</div>
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
						<label class="col-sm-3 control-label">&nbsp;</label><form action="<?php echo $glo_idx[5];?>" method="post">
						<div class="col-sm-9">
							<input type="hidden" value="y" name="btnsel" id="btnsel" />
							<input type="hidden" value="a" name="btnsela" id="btnsela" />
							<input type="hidden" value="370900" name="btnselb" id="btnselb" />
							<button type="submit" class="btn btn-primary btn-block">应用查询</button> 
						</div></form>
					</div>
				</div>
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
function show_map()
{
	var x=sval[indx][2]; //lng
	var y=sval[indx][3]; //lat
	var z=sval[indx][4]; //城市名
	var n=sval[indx][0]; //单位名
	var len=n.length*6.25;
	len=0-len;
	var map = new BMap.Map("allmap");    // 创建Map实例
	var point = new BMap.Point(x,y);
	map.centerAndZoom(point, 11);  // 初始化地图,设置中心点坐标和地图级别
	map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
	map.setCurrentCity(z);          // 设置地图显示的城市 此项是必须设置的
	map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
	var marker = new BMap.Marker(point);
	map.addOverlay(marker);
	var opts = {
	  position : point,
	  offset   : new BMap.Size(len, 0)
	}
	var label = new BMap.Label(n, opts);  // 创建文本标注对象
		label.setStyle({
			 color : "blue",
			 border: "0",
			 fontSize : "12px"
		 });
	map.addOverlay(label);
}
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
	$("#btngrp1").click(function(){
			var a=$("#btnsel").val();
			if(a == "n")
			{
				$("#btngrp1").addClass("active");
				$("#btngrp2").removeClass("active");
				$("#btnsel").val("y");
			}
			});
	$("#btngrp2").click(function(){
			var a=$("#btnsel").val();
			if(a == "y")
			{
				$("#btngrp1").removeClass("active");
				$("#btngrp2").addClass("active");
				$("#btnsel").val("n");
			}
			});
	$("#btngrp3").click(function(){
			var a=$("#btnsel1").val();
			if(a == "n")
			{
				$("#btngrp3").addClass("active");
				$("#btngrp4").removeClass("active");
				$("#btnsel1").val("y");
			}
			});
	$("#btngrp4").click(function(){
			var a=$("#btnsel1").val();
			if(a == "y")
			{
				$("#btngrp3").removeClass("active");
				$("#btngrp4").addClass("active");
				$("#btnsel1").val("n");
			}
			});
	$(".btn-advancedsearch").click(function(){
			$(".searchbar-filters").show();
			});
//	$("#area_sel1").change(function(){
//				var a=$("#area_sel1").val();
//				$("#btnsel2").val(a);$("#btnselb").val(a);$("#sdcode").val(a);
//				var b="area_sel2";
//				$("#area_sel2").empty();
//				ajax_getval(a,b);
//			});
	$("#area_sel2").change(function(){
			var a=$("#area_sel2").val();
			if(a == "0")
			{$("#btnsel2").val($("#area_sel1").val());$("#btnselb").val($("#area_sel1").val());$("#sdcode").val($("#area_sel1").val());}
			else
			{$("#btnsel2").val(a);$("#btnselb").val(a);$("#sdcode").val(a);}
			});
	$("#area_sel3").change(function(){
			var a=$("#area_sel3").val();
			$("#btnsela").val(a);$("#btnsel3").val(a);$("#hycode").val(a);
			});
});
function ajax_getval(u,v)
{
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById(v).innerHTML=xmlhttp.responseText;
		}
	}
	var url="/huili/include/for_get.php?area_code="+u;
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
};

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
		jflag=1;document.getElementById("texta2").value="";document.getElementById("hycode").value="";
		document.getElementById("btnsel3").value="";document.getElementById("btnsela").value="";
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
		$("#intro_show").html(sval[indx][1]);
	}
	else if(i == 2)
	{
	//	var xx=sval[0][2];
	//	var yy=sval[0][3];
		$("#vdv2").addClass("active");
		$("#vdv0").removeClass("active");
		$("#vdv1").removeClass("active");
		$("#mladdr").addClass("active");
		$("#mlview").removeClass("active");
		$("#mlintro").removeClass("active");//这里添加地图信息
	//	var h=window.screen.height * 0.48;
	//	$("#allmap").height(h);
	//	var st="lng=".concat(xx,"; lat=",yy);
	//	$("#allmap").html(st);
	//	show_map();
	}
	else if(i == 3)
	{
		$("#vdv1").addClass("active");
		$("#vdv0").removeClass("active");
		$("#vdv2").removeClass("active");
		$("#mlintro").addClass("active");
		$("#mlview").removeClass("active");
		$("#mladdr").removeClass("active");
		$("#intro_show").html(sval[j][1]);
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

