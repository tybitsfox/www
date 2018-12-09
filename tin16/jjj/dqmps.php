<?php
echo "<html><head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<link href='./main.css' rel='stylesheet' type='text/css' />";
echo "<style type='text/css'>
body{ text-align:center} 
#divcenter{margin:0 auto;width:800px}</style>
</head><body>";
echo "<br><center><font size=6 color=red>勇者斗恶龙怪物篇1+2攻略</font></center><br><br>";
echo "<table align=center width=70% border=1 cellspacing=0 cellpadding=1><tr>";
echo "<td align=center colspan=6><a href='./walkm1.php' target=_blank><font size=4>dq_M1攻略</font></a></td></tr><tr>";
echo "<td align=center><a href='./walkm2_01.php' target=_blank><font size=4>M2_启程之诗</font></a></td>";
echo "<td align=center><a href='./walkm2_02.php' target=_blank><font size=4>M2_悠久的沙漠</font></a></td>";
echo "<td align=center><a href='./walkm2_03.php' target=_blank><font size=4>M2_人鱼之歌</font></a></td>";
echo "<td align=center><a href='./walkm2_04.php' target=_blank><font size=4>M2_和平之冬</font></a></td>";
echo "<td align=center><a href='./walkm2_05.php' target=_blank><font size=4>M2_天空的乐章</font></a></td>";
echo "<td align=center><a href='./walkm2_06.php' target=_blank><font size=4>M2_罅隙之光</font></a></td></tr><tr>";
echo "<td align=center><a href='./item.php' target=_blank><font size=4>道具一览</font></a></td>";
echo "<td align=center><a href='./access.php' target=_blank><font size=4>饰品一览</font></a></td>";
echo "<td align=center><a href='./skill.php' target=_blank><font size=4>咒文特技一览</font></a></td>";
echo "<td align=center><a href='./monster.php' target=_blank><font size=4>怪兽详细资料</font></a></td>";
echo "<td align=center><a href='./combine.php' target=_blank><font size=4>配合法则</font></a></td>";
echo "<td align=center><a href='./battle.php' target=_blank><font size=4>竞技场_M1</font></a></td></tr>";
echo "<tr><td align=center colspan=2><a href='./xinde1.php' target=_blank><font size=4>攻略心得M1</font></a></td>";
echo "<td align=center colspan=2><a href='./xinde2.php' target=_blank><font size=4>攻略心得M2</font></a></td>";
echo "<td align=center colspan=2><a href='./xinde3.php' target=_blank><font size=4>M1初期配合心得</font></a></td>";
echo "</tr></table>";

echo "</body></html>";
?>
<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
