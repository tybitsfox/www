<?php
echo "<html><head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<link href='./main.css' rel='stylesheet' type='text/css' />";
echo "<style type='text/css'>
body{ text-align:center} 
#divcenter{margin:0 auto;width:800px}</style>
</head><body>";
echo "<br><center><font size=6 color=red>勇者斗恶龙9攻略</font></center><br><br>";
echo "<table align=center width=70% border=1 cellspacing=0 cellpadding=1><tr>";
echo "<td align=center><a href='./jianjie.php' target=_blank><font size=4>游戏简介</font></a></td>";
echo "<td align=center><a href='./walk.php' target=_blank><font size=4>攻略流程</font></a></td>";
echo "<td align=center><a href='./miss1.php' target=_blank><font size=4>任务攻略(1-60)</font></a></td>";
echo "<td align=center><a href='./miss2.php' target=_blank><font size=4>任务攻略(61-120)</font></a></td>";
echo "<td align=center><a href='./miss3.php' target=_blank><font size=4>任务攻略(121-184)</font></a></td>";
echo "<td align=center><a href='./combine.php' target=_blank><font size=4>炼金合成</font></a></td></tr><tr>";
echo "<td align=center><a href='./shop.php' target=_blank><font size=4>商店道具</font></a></td>";
echo "<td align=center><a href='./comb_item.php' target=_blank><font size=4>合成素材</font></a></td>";
echo "<td align=center><a href='./job.php' target=_blank><font size=4>职业介绍</font></a></td>";
echo "<td align=center><a href='./abli.php' target=_blank><font size=4>技能介绍</font></a></td>";
echo "<td align=center><a href='./absword.php' target=_blank><font size=4>剑技能</font></a></td>";
echo "<td align=center><a href='./abspear.php' target=_blank><font size=4>枪技能</font></a></td></tr><tr>";
echo "<td align=center><a href='./abknife.php' target=_blank><font size=4>短剑技能</font></a></td>";
echo "<td align=center><a href='./abwand.php' target=_blank><font size=4>杖技能</font></a></td>";
echo "<td align=center><a href='./abwhip.php' target=_blank><font size=4>鞭技能</font></a></td>";
echo "<td align=center><a href='./abstaff.php' target=_blank><font size=4>棍技能</font></a></td>";
echo "<td align=center><a href='./abclaw.php' target=_blank><font size=4>爪技能</font></a></td>";
echo "<td align=center><a href='./abfan.php' target=_blank><font size=4>扇技能</font></a></td></tr><tr>";
echo "<td align=center><a href='./abaxe.php' target=_blank><font size=4>斧技能</font></a></td>";
echo "<td align=center><a href='./abhammer.php' target=_blank><font size=4>锤技能</font></a></td>";
echo "<td align=center><a href='./abbrang.php' target=_blank><font size=4>回旋镖技能</font></a></td>";
echo "<td align=center><a href='./abbow.php' target=_blank><font size=4>弓技能</font></a></td>";
echo "<td align=center><a href='./abshield.php' target=_blank><font size=4>盾技能</font></a></td>";
echo "<td align=center><a href='./abhand.php' target=_blank><font size=4>空手技能</font></a></td></tr><tr>";
echo "<td align=center><a href='./abcourage.php' target=_blank><font size=4>战士-勇敢</font></a></td>";
echo "<td align=center><a href='./abfaith.php' target=_blank><font size=4>僧侣-信仰之心</font></a></td>";
echo "<td align=center><a href='./abspell.php' target=_blank><font size=4>魔法师-魔法</font></a></td>";
echo "<td align=center><a href='./abfocus.php' target=_blank><font size=4>武斗家-气势</font></a></td>";
echo "<td align=center><a href='./abacqui.php' target=_blank><font size=4>盗贼-宝物</font></a></td>";
echo "<td align=center><a href='./ablithe.php' target=_blank><font size=4>旅艺人-曲艺</font></a></td></tr><tr>";
echo "<td align=center><a href='./abguts.php' target=_blank><font size=4>战斗大师-斗魂</font></a></td>";
echo "<td align=center><a href='./abvalour.php' target=_blank><font size=4>圣骑士-博爱</font></a></td>";
echo "<td align=center><a href='./abfource.php' target=_blank><font size=4>魔法战士-元素之力</font></a></td>";
echo "<td align=center><a href='./abrugg.php' target=_blank><font size=4>游侠-生存</font></a></td>";
echo "<td align=center><a href='./abenlight.php' target=_blank><font size=4>贤者-悟道</font></a></td>";
echo "<td align=center><a href='./abjene.php' target=_blank><font size=4>超级明星-灵气</font></a></td></tr><tr>";
echo "<td align=center><a href='./job_mission.php' target=_blank><font size=4>转职任务介绍</font></a></td>";
echo "<td align=center><a href='./b.php' target=_blank><font size=4>待添加</font></a></td>";
echo "<td align=center><a href='./b.php' target=_blank><font size=4>待添加</font></a></td>";
echo "<td align=center><a href='./b.php' target=_blank><font size=4>待添加</font></a></td>";
echo "<td align=center><a href='./b.php' target=_blank><font size=4>待添加</font></a></td>";
echo "<td align=center><a href='./b.php' target=_blank><font size=4>待添加</font></a></td>";
echo "</tr></table>";
//echo "<img src='./images/dream.jpg' border=1 style='width:40%;cursor:pointer' onclick='javascript:window.open(this.src)' />";

echo "</body></html>";
?>

<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
