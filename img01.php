<?php
$im = imagecreatetruecolor(100, 100); //创建100*100大小的画布
$red = imagecolorallocate($im, 255, 0, 0); //设置一个颜色变量为红色
 
imagefill($im, 0, 0, $red); //将背景设为红色
 
header('Content-type:image/png'); //通知浏览器这不是文本而是一个图片
imagepng($im); //生成PNG格式的图片输出给浏览器
 
imagedestroy($im); //销毁图像资源，释放画布占用的内存空间
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" /> 
<title>javascript select结合_</title> 
<script language="javascript" type="text/javascript"> 

function vtOption(){ 
var s1=document.getElementById("select1"); 
var sV=s1.options[s1.selectedIndex].value; 
var sT=s1.options[s1.selectedIndex].text; 
alert(sV+"n"+sT); 
} 

function addOption1(){ 
var s1=document.getElementById("select1"); 
var newOp1=new Option; 
newOp1.value="3"; 
newOp1.text="这是3"; 
var newOp2=new Option; 
newOp2.value="4"; 
newOp2.text="这是4"; 
s1.add(newOp1); 
s1.add(newOp2); 
} 

function addOption2(){ 
var s1=document.getElementById("select1"); 
for(var i=3;i<5;i++){ 
var newOp1=new Option("这是"+i,i); 
//var newOp1=new Option; 
//newOp1.value=i; 
//newOp1.text="这是"+i; 
s1.add(newOp1); 
} 
} 

function addOption3(){ 
var s1=document.getElementById("select1"); 
s1.options.length=0;//清除以前的选项 
for(var i=3;i<7;i++){ 
var newOp1=new Option("这是"+i,i); 
//var newOp1=new Option; 
//newOp1.value=i; 
//newOp1.text="这是"+i; 
s1.add(newOp1); 
} 
} 

function remOption(){ 
var s1=document.getElementById("select1"); 
for(var i=s1.options.length;i>=0;i--){ 
s1.options.remove(i); 
} 
} 

function remOptionSelected(){ 
var s1=document.getElementById("select1"); 
var i=s1.selectedIndex; 
//alert(i); 
s1.options.remove(i); 
} 
</script> 
</head> 

<body> 
<select name="select" id="select1"> 
<option value="1">这是1</option> 
<option value="2">这是2</option> 
</select>
 
<a href="javascript:vtOption()">取值</a>  <a href="javascript:addOption1()">增加1</a>  <a href="javascript:addOption2()">增加2</a>  <a href="javascript:addOption3()">增加3</a>  <a href="javascript:remOption()">删除选项</a> 
  <a href="javascript:remOptionSelected()">删除选取选项</a> 
</body> 
</html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
<script type="text/javascript">
var provinces = new Array();
provinces["湖北"] = ["武汉","襄阳","随州","宜昌","十堰"];
provinces["四川"] = ["成都","内江","达州"];
provinces["河南"] =["郑州","南阳","信阳","漯河"];
function changeProvince()
{
var prov = document.getElementById("province").value;
var city =document.getElementById("city");
city.options.length =0;
for(var i in provinces[prov])
{
city.options.add(new Option(provinces[prov][i],provinces[prov][i]));
}
}
window.onload = function(){
var province = document.getElementById("province");

for(var index in provinces)
{
//alert(index);
province.options.add(new Option(index,index));
}
province.fireEvent("onchange");
};
</script>
</head>
<body>
省份:<select id="province" onchange= "javascript:changeProvince()"></select>
城市:<select id="city"></select>
</body>
</html> 
