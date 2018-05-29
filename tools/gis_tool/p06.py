#!/usr/bin/python
#__*coding:utf-8*__
#生成一个显示所有点位的html文件
#fn01="/tmp/dongping.txt";
fn01="/tmp/xintai.txt";
fn02="/tmp/xintai1.gpx";
fn03="/tmp/xintai.gpx";
t01="<html>\n\
<head>\n<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />\n\
	<meta name='viewport' content='initial-scale=1.0, user-scalable=no' />\n\
	<style type='text/css'>\n\
	body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:'微软雅黑';}\n\
	</style>\n\
	<script type='text/javascript' src='http://api.map.baidu.com/api?v=2.0&ak=Wst0GYAGq6QfZG1fGTwNxGLD9CBW5N99'></script>\n\
	<title>地图展示</title>\n\
</head>\n\
<body>\n\
	<div id='allmap'></div>\n\
</body>\n\
</html>\n\
<script type='text/javascript'>";
t02="var map = new BMap.Map('allmap');    // 创建Map实例\n\
	map.centerAndZoom('泰安市', 9);  // 初始化地图,设置中心点坐标和地图级别\n\
	map.addControl(new BMap.MapTypeControl());   //添加地图类型控件\n\
	map.setCurrentCity('泰安');          // 设置地图显示的城市 此项是必须设置的\n\
	map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放\n";
#------------开始航迹
h01="var polyline = new BMap.Polyline([\n";
h02="new BMap.Point(%s,%s),";
h03="], {strokeColor:'blue', strokeWeight:2, strokeOpacity:0.5});\n\
map.addOverlay(polyline); \n";
h04="], {strokeColor:'green', strokeWeight:2, strokeOpacity:0.5});\n\
map.addOverlay(polyline); \n";
f01=open(fn01,"r");
f=open("aaa.html","w");
f.write(t01);
f.write(t02);
for line in f01.readlines():
	str=line.split('|');
	s1="var marker = new BMap.Marker(new BMap.Point(%s,%s));\nmap.addOverlay(marker);\n" % (str[0].strip(),str[1].strip());
	f.write(s1);
f01.close();
f.write(h01);
f01=open(fn03,"r");
for str in f01.readlines():
	s1=str.split('"');
	s2=s1[0];
	if s2.find("lat=") >= 0:
#print s1[1],":",s1[3];
		sa="new BMap.Point(%s,%s),\n" % (s1[3],s1[1]);
		f.write(sa);
f.write(h03);		
f01.close();
f.write(h01);
f01=open(fn02,"r");
for str in f01.readlines():
	s1=str.split('"');
	s2=s1[0];
	if s2.find("lat=") >= 0:
		sa="new BMap.Point(%s,%s),\n" % (s1[3],s1[1]);
		f.write(sa);
f.write(h04);
f.write("</script>");
f01.close();
f.close();




