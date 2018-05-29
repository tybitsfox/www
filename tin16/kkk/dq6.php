<?php
echo "<html><head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<link href='./main.css' rel='stylesheet' type='text/css' />";
echo "<style type='text/css'>
body{ text-align:center} 
#divcenter{margin:0 auto;width:800px}</style>
</head><body>";
echo "<br><center><font size=6 color=red>勇者斗恶龙6攻略</font></center><br><br>";
echo "<table align=center width=70% border=1 cellspacing=0 cellpadding=1><tr>";
echo "<td align=center><a href='./walk1.php' target=_blank><font size=4>流程攻略一</font></a></td>";
echo "<td align=center><a href='./walk2.php' target=_blank><font size=4>流程攻略二</font></a></td>";
echo "<td align=center><a href='./walk3.php' target=_blank><font size=4>流程攻略三</font></a></td>";
echo "<td align=center><a href='./walk4.php' target=_blank><font size=4>流程攻略四</font></a></td>";
echo "<td align=center><a href='./walk5.php' target=_blank><font size=4>流程攻略五</font></a></td>";
echo "<td align=center><a href='./walk6.php' target=_blank><font size=4>流程攻略六</font></a></td></tr><tr>";
echo "<td align=center><a href='./walk7.php' target=_blank><font size=4>流程攻略七</font></a></td>";
echo "<td align=center><a href='./walk8.php' target=_blank><font size=4>流程攻略八</font></a></td>";
echo "<td align=center><a href='./walk9.php' target=_blank><font size=4>流程攻略九</font></a></td>";
echo "<td align=center><a href='./char.php' target=_blank><font size=4>人类同伴资料</font></a></td>";
echo "<td align=center><a href='./spell.php' target=_blank><font size=4>咒文</font></a></td>";
echo "<td align=center><a href='./skill.php' target=_blank><font size=4>特技</font></a></td></tr><tr>";
echo "<td align=center><a href='./job1.php' target=_blank><font size=4>初级职业</font></a></td>";
echo "<td align=center><a href='./job2.php' target=_blank><font size=4>高级职业</font></a></td>";
echo "<td align=center><a href='./job3.php' target=_blank><font size=4>终极职业</font></a></td>";
echo "<td align=center><a href='./job4.php' target=_blank><font size=4>隐藏职业</font></a></td>";
echo "<td align=center><a href='./zone.php' target=_blank><font size=4>熟练度地域</font></a></td>";
echo "<td align=center><a href='./spell.php' target=_blank><font size=4>咒文</font></a></td>";
echo "</tr></table>";
echo "<font color=blue size=4>真实世界</font><br>";
echo "<img src='./images/true.jpg' border=1 style='width:40%;cursor:pointer' onclick='javascript:window.open(this.src)' />";
echo "<br><font color=blue size=4>梦世界</font><br>";
echo "<img src='./images/dream.jpg' border=1 style='width:40%;cursor:pointer' onclick='javascript:window.open(this.src)' />";

echo "</body></html>";
?>
<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
