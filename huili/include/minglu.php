<?php
//{{{变量、初始化
if(!defined("HOME_CALLED") || !isset($_SESSION['GLO_VAR']))
	die("access denied!");
$glo_idx=array(9,'企业名录','企业浏览','企业信息','企业地址',$SIGNED_DEF['LINK']."?select=".$SIGNED_PAGE['GJ9']);
$pg_sel=array(array("","mlview","企业浏览"),array("","mlintro","企业信息"),array("","mladdr","企业地址")); //活动状态，id，标题
$pg_sel[0][0]="active";

//下面是获取属地的省份数据,默认显示泰安的工业企业
$area_ay=array();
$ta=new tb_area_info();
$area_ay=$ta->get_sheng();
$area_by=array();
$area_by=$ta->get_dishi("370000");
$msg01="<p>这是企业浏览界面</p>";  //测试，显示测试信息用
$shwmsg=array(); //显示信息队列

if(isset($_POST['byname01'])) //按名称查找
{

}
elseif(isset($_POST['btnsel1'])) //按行业
{
	$x=$_POST['btnsel3']; //行业代码
	$y=$_POST['btnsel1'];	//是否使用属地过滤
	$z=$_POST['btnsel2'];	//属地区划代码
}
else
{
	$x=$_POST['btnsela'];	//行业代码
	$y=$_POST['btnsel'];	//是否使用行业过滤
	$z=$_POST['btnselb']; //行政区划
}
//}}}
?>
<script>
function loadcssfile()
{
	var f=document.createElement("link");
	f.setAttribute("rel","stylesheet");
	f.setAttribute("type","text/css");
	f.setAttribute("href","/huili/css/newstyle.css");
    var head = document.getElementsByTagName('head')[0];
    head.appendChild(f);	
}
loadcssfile();
</script>
<?php
	$st2="\n\n<a href='".$SIGNED_DEF['LINK']."' >主页</a></li><li>".$glo_idx[1];
	$st=sprintf($SIG_HTML['RIGHT_TOP1'],$st2);
	echo $st;
	echo"\n<div class='inner' id='modal_container' ><div class='block'><div class='panel shadow'><ul class='nav nav-tabs nav-tabs-hor' role='tablist'>";
	$st1="\n<li role='presentation' class='%s'><a href='%s' aria-controls='share' role='tab' data-toggle='tab'>%s</a></li>";
	for($i=0;$i<3;$i++)
	{
		$st2=sprintf($st1,$pg_sel[$i][0],'#'.$pg_sel[$i][1],$pg_sel[$i][2]);
		echo $st2;
	}
	echo"\n</ul><div class='body'><div class='body body-settings'><div class='tab-content'>";
//{{{page one 企业浏览
	echo"\n<div role='tabpanel' class='tab-pane ".$pg_sel[0][0]."' id='".$pg_sel[0][1]."'>";
	echo $msg01;
	echo"</div>";
//}}}	
//{{{page two 企业信息
	echo"\n<div role='tabpanel' class='tab-pane ".$pg_sel[1][0]."' id='".$pg_sel[1][1]."'>";
	echo"<p>这是企业信息界面</p>";
	echo"</div>";
//}}}
//{{{page three 企业地址
	echo"\n<div role='tabpanel' class='tab-pane ".$pg_sel[2][0]."' id='".$pg_sel[2][1]."'>";
	echo"<p>这是地图显示界面</p>";
	echo"</div>";
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
					<input class="form-control form-daterange" id="texta2" placeholder="按行业过滤" value="" type="text">
					<span class="caret"></span>
				</div>
			</div>
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-filters">
				<div class="dropdown-menu-head text-right">
					<a class="btn-text" href="#">清空过滤</a>
				</div>
				<div class="dropdown-menu-body form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label">行业分类</label>
						<div class="col-sm-9">
							<select class="form-control" name="area_sel3" id="area_sel3">
								<option value="a">农、林、牧、渔业</option>
								<option value="b">采矿业</option>
								<option value="c">制造业</option>
								<option value="d">电力、热力、燃气及水生产和供应业</option>
								<option value="e">建筑业</option>
								<option value="f">批发和零售业</option>
								<option value="g">交通运输、仓储和邮政业</option>
								<option value="h">住宿和餐饮业</option>
								<option value="i">信息传输、软件和信息技术服务业</option>
								<option value="j">金融业</option>
								<option value="k">其他行业</option>
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
					<a class="btn-text" href="#">清空过滤</a>
				</div>
				<div class="dropdown-menu-body form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label">省份</label>
						<div class="col-sm-9">
							<select class="form-control" id="area_sel1">
							<?php
								foreach($area_ay as $a)
								{
									if($a[0] == "370000")
										$st=sprintf("<option value='%s' selected='selected'>%s</option>",$a[0],$a[1]);
									else
										$st=sprintf("<option value='%s'>%s</option>",$a[0],$a[1]);
									echo $st;
								}
							?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">地市</label>
						<div class="col-sm-9">
							<select class="form-control" id="area_sel2">
							<?php
								echo "<option value='0'>忽略地市</option>";
								foreach($area_by as $b)
								{
									if($b[0] == "370900")
										$st=sprintf("<option value='%s' selected='selected'>%s</option>",$b[0],$b[1]);
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
						<label class="col-sm-3 control-label">行业过滤</label>
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
$(document).ready(function(){
	$("#texta1").click(function(){
			$(".dropdown-filtersa").removeClass("open");
			var s=$("#area_sel1").find("option:selected").text();
			if($("#texta1").is(":visible"))
			{
				$("#texta1").val(s);
			}
			$(".dropdown-filters").toggleClass("open");
			});
	$("#texta2").click(function(){
			$(".dropdown-filters").removeClass("open");
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
	$("#area_sel1").change(function(){
				var a=$("#area_sel1").val();
				$("#btnsel2").val(a);$("#btnselb").val(a);
				var b="area_sel2";
				$("#area_sel2").empty();
				ajax_getval(a,b);
			});
	$("#area_sel2").change(function(){
			var a=$("#area_sel2").val();
			if(a == "0")
			{$("#btnsel2").val($("#area_sel1").val());$("#btnselb").val($("#area_sel1").val());}
			else
			{$("#btnsel2").val(a);$("#btnselb").val(a);}
			});
	$("#area_sel3").change(function(){
			var a=$("#area_sel3").val();
			$("#btnsela").val(a);
			$("#btnsel3").val(a);
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
}
</script>	
<?php
//}}}
//}}}
	echo "</div></div>";
	echo $SIG_HTML['RIGHT_TOP3'];
?>

