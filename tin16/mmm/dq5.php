<?php
echo "<html><head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<link href='./main.css' rel='stylesheet' type='text/css' />";
echo "<style type='text/css'>
body{ text-align:center} 
#divcenter{margin:0 auto;width:800px}</style>
</head><body>";
echo "<br><center><font size=6 color=red>勇者斗恶龙5攻略</font></center><br><br>";
echo "<table align=center width=70% border=1 cellspacing=0 cellpadding=1><tr>";
echo "<td align=center><a href='./walk1.php' target=_blank><font size=4>攻略流程-幼年时期</font></a></td>";
echo "<td align=center><a href='./walk2.php' target=_blank><font size=4>攻略流程-青年前期</font></a></td>";
echo "<td align=center><a href='./walk3.php' target=_blank><font size=4>攻略流程-青年后期</font></a></td>";
echo "<td align=center><a href='./walk4.php' target=_blank><font size=4>攻略流程-通关之后</font></a></td></tr><tr>";
echo "<td align=center><a href='./fellow.php' target=_blank><font size=4>怪物同伴</font></a></td>";
echo "<td align=center><a href='./f_skill.php' target=_blank><font size=4>怪物同伴-特技</font></a></td>";
echo "<td align=center><a href='./hide.php' target=_blank><font size=4>隐藏迷宫</font></a></td>";
echo "<td align=center><a href='./wife.php' target=_blank><font size=4>新娘能力比较</font></a></td></tr><tr>";
echo "<td align=center><a href='./magic1.php' target=_blank><font size=4>攻击咒文</font></a></td>";
echo "<td align=center><a href='./magic2.php' target=_blank><font size=4>回复咒文</font></a></td>";
echo "<td align=center><a href='./magic3.php' target=_blank><font size=4>辅助咒文</font></a></td>";
echo "<td align=center><a href='./magic4.php' target=_blank><font size=4>冒险辅助咒文4</font></a></td></tr>";
echo "</tr></table>";
echo "<br><img src='./allimg/22-121212135F9504.jpg' border=1 style='width:60%;cursor:pointer' onclick='javascript:window.open(this.src)' />";
echo "</body></html>";
?>
<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
