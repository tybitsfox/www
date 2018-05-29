<?php
echo "<html><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
echo "<link href='./ff9.css' rel='stylesheet' type='text/css' media='all'/>";
echo "<style type='text/css'>
.ff9 img{
	background: #eee;	
	border: 3px solid #ddd;}
</style>";
echo "</head><body>";
echo "<div class='ff9'>
<h3>阿馋特技<img src='./pic/icon/skill/a.gif'></h3>
<p align=center><img src='pic/ability/a_quina.jpg' width='320' height='240'></p>
<p>请参见<a href='./ff9_magic2.php'>青魔法</a>专栏</p>
<h3>阿馋可装备辅助技能<img src='./pic/icon/skill/p.gif'></h3>
<table class='intro_table' border='0' width='450'>
<tr>
<td>※<strong>辅助技能的作用见<a href='./ff9_skill.php'>《辅助技能说明》</a></td>
</tr></table>
<p align=center><img src='pic/ability/s_quina.jpg' width='320' height='360'></p>
<center><table cellspacing='0' cellpadding='0' class='table_center'>
  <tr class='cell5'>
    <td width=24%>能力名称</td>
    <td width=8%>魔石</td>
    <td width=8%>AP</td>
    <td>持有能力装备名</td>
  </tr>
  <tr>
    <td>恒反射</td>
    <td>15</td>
    <td>75</td>
    <td >反射戒指</td>
  </tr>
  <tr>
    <td>恒浮空</td>
    <td>6</td>
    <td>40</td>
    <td >羽毛长靴</td>
  </tr>
  <tr>
    <td>恒加速</td>
    <td>9</td>
    <td>70</td>
    <td >赫尔默斯之靴</td>
  </tr>
  <tr>
    <td>恒再生</td>
    <td>10</td>
    <td>30</td>
    <td >黄金发夹<br>美食家之袍</td>
  </tr>
  <tr>
    <td>护身符</td>
    <td>12</td>
    <td>165</td>
    <td >转生戒指</td>
  </tr>
  <tr>
    <td>MP增长20%</td>
    <td>8</td>
    <td>50</td>
    <td >魔术师之袍<br>魔术师之鞋<br>绿宝石</td>
  </tr>
  <tr>
    <td>治疗者</td>
    <td>2</td>
    <td>60</td>
    <td >石榴石</td>
  </tr>
  <tr>
    <td>追加效果发动</td>
    <td>3</td>
    <td>35</td>
    <td >羽饰帽子<br>骨质护腕<br>玻璃带扣</td>
  </tr>
  <tr>
    <td>博弈防御</td>
    <td>1</td>
    <td>40</td>
    <td >精金帽子<br>缠头带<br>力量肩带</td>
  </tr>
   <tr>
    <td>MP消耗减半</td>
    <td>11</td>
    <td>90</td>
    <td >光之袍<br>守护戒指</td>
  </tr>
  <tr>
    <td>满月的心得</td>
    <td>8</td>
    <td>250</td>
    <td  >阿馋的所有餐叉</td>
  </tr>
  <tr>
    <td>反击</td>
    <td>8</td>
    <td>55</td>
    <td >轿夫帽子<br>力量肩带<br>力量腰带</td>
  </tr>
  <tr>
    <td>恒温</td>
    <td>4</td>
    <td>20</td>
    <td >翡翠护臂<br>马代因戒指<br>精灵耳环</td>
  </tr>
  <tr>
    <td>等级上升</td>
    <td>7</td>
    <td>60</td>
    <td >唯我护臂<br>罗塞塔戒指<br>精灵耳环</td>
  </tr>
  <tr>
    <td>能力上升</td>
    <td>3</td>
    <td>40</td>
    <td >绿色贝雷帽<br>丝袍<br>天青石</td>
  </tr>
  <tr>
    <td>财源滚滚</td>
    <td>5</td>
    <td>100</td>
    <td >黄色围巾</td>
  </tr>
  <tr>
    <td>不眠之术</td>
    <td>5</td>
    <td>40</td>
    <td >花色丝巾<br>魔术师之衣<br>珊瑚戒指</td>
  </tr>
  <tr>
    <td>试毒之术</td>
    <td>4</td>
    <td>20</td>
    <td >内力头带<br />玻璃护臂<br>救生背心</td>
  </tr>
  <tr>
    <td>不凝之术</td>
    <td>4</td>
    <td>35</td>
    <td >暗黑帽子<br>龙之护腕<br>青铜胸甲</td>
  </tr>
   <tr>
    <td>使用MP吸收</td>
    <td>3</td>
    <td>30</td>
    <td >承诺之戒</td>
  </tr>
  <tr>
    <td>自动使用恢复剂</td>
    <td>3</td>
    <td>30</td>
    <td >魔术师之袍<br>秘银背心<br>金领带</td>
  </tr>
  <tr>
    <td>不休之术</td>
    <td>4</td>
    <td>20</td>
    <td >黑头巾<br>魔人胸甲<br>救生背心</td>
  </tr>
  <tr>
    <td>不乱之术</td>
    <td>5</td>
    <td>25</td>
    <td >拉弥亚头饰<br>魔法护臂<br>魔术师之鞋</td>
  </tr>
</table></center></div>";
echo "</body></html>";
?>
<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
