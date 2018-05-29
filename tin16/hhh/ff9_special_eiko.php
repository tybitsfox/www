<?php
echo "<html><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
echo "<link href='./ff9.css' rel='stylesheet' type='text/css' media='all'/>";
echo "<style type='text/css'>
.ff9 img{
	background: #eee;	
	border: 3px solid #ddd;}
</style>";
echo "</head><body>";
echo "<a name='top' /><div class='ff9'>
<h3>艾可特技<img src='./pic/icon/skill/a.gif'></h3>
<p align=center><img src='pic/ability/a_eiko.jpg' width='320' height='240'><br />
</p>
<center><table cellspacing='0' cellpadding='0' align='center' class='table_center'>
    <tr class='cell5'>
      <td nowrap='nowrap' align='center'>技能名称</td>
      <td nowrap='nowrap' align='center'>MP</td>
      <td nowrap='nowrap' align='center'>AP</td>
      <td align='center'>效果</td>
      <td align='center'>持有该特技的装备</td>
    </tr>
    <tr>
      <td nowrap='nowrap' align='center' width='18%'>红宝石兽</td>
      <td nowrap='nowrap' align='center' width='6%'>24</td>
      <td nowrap='nowrap' align='center' width='5%'>35</td>
      <td width='32%'>我方全体进入魔法反弹状态</td>
      <td width='39%'>红宝石</td>
    </tr>
    <tr>
      <td nowrap='nowrap' align='center'>芬利尔</td>
      <td nowrap='nowrap' align='center'>30</td>
      <td nowrap='nowrap' align='center'>55</td>
      <td>敌方全体地属性攻击</td>
      <td>蓝宝石</td>
    </tr>
    <tr>
      <td nowrap='nowrap' align='center'>不死鸟</td>
      <td nowrap='nowrap' align='center'>32</td>
      <td nowrap='nowrap' align='center'>40</td>
      <td>敌全体火属性攻击,全体复活</td>
      <td>不死鸟之翼</td>
    </tr>
    <tr>
      <td nowrap='nowrap' align='center'>马蒂恩</td>
      <td nowrap='nowrap' align='center'>54</td>
      <td nowrap='nowrap' align='center'>120</td>
      <td>敌全体圣属性攻击</td>
      <td>缎带</td>
    </tr>
    <tr>
      <td align='center'>初级治疗</td>
      <td align='center'>6</td>
      <td align='center'>20</td>
      <td width='35%'>初级回复魔法</td>
      <td>魔法拍<br />丝衣</td>
    </tr>
    <tr>
      <td align='center'>中级治疗</td>
      <td align='center'>10</td>
      <td align='center'>40</td>
      <td width='35%'>中级回复魔法</td>
      <td>魔像之笛<br />条状发夹</td>
    </tr>
    <tr>
      <td align='center'>高级治疗</td>
      <td align='center'>22</td>
      <td align='center'>80</td>
      <td width='35%'>高级回复魔法</td>
      <td>天使之笛<br />哈默尔恩</td>
    </tr>
    <tr>
      <td align='center'>再生</td>
      <td align='center'>14</td>
      <td align='center'>25</td>
      <td width='35%'>HP徐徐回复</td>
      <td>精灵横笛<br />精灵耳环</td>
    </tr>
    <tr>
      <td align='center'>复活</td>
      <td align='center'>8</td>
      <td align='center'>35</td>
      <td width='35%'>复活</td>
      <td>魔像之笛<br />转生戒指<br />发箍</td>
    </tr>
    <tr>
      <td align='center'>完全复活</td>
      <td align='center'>24</td>
      <td align='center'>90</td>
      <td width='35%'>完全复活</td>
      <td>塞壬之笛<br />光之袍</td>
    </tr>
    <tr>
      <td align='center'>解毒</td>
      <td align='center'>4</td>
      <td align='center'>15</td>
      <td width='35%'>解除状态：毒和猛毒</td>
      <td>空气拍</td>
    </tr>
    <tr>
      <td align='center'>融石</td>
      <td align='center'>8</td>
      <td align='center'>25</td>
      <td width='35%'>解除状态：石化和缓慢石化</td>
      <td>拉弥亚之笛<br />玛蒂娜拍</td>
    </tr>
    <tr>
      <td align='center'>康复</td>
      <td align='center'>20</td>
      <td align='center'>80</td>
      <td>解除大部分不良状态</td>
      <td>天使之笛<br />塞壬之笛<br />精灵横笛</td>
    </tr>
    <tr>
      <td align='center'>魔盾</td>
      <td align='center'>6</td>
      <td align='center'>20</td>
      <td width='35%'>降低敌人魔法攻击产生的伤害</td>
      <td>玛蒂娜拍<br />棉袍<br />金领带</td>
    </tr>
    <tr>
      <td align='center'>护盾</td>
      <td align='center'>6</td>
      <td align='center'>20</td>
      <td width='35%'>降低敌人物理攻击产生的伤害</td>
      <td>秘银拍<br />尖帽子<br />沙漠长靴</td>
    </tr>
    <tr>
      <td align='center'>加速</td>
      <td align='center'>8</td>
      <td align='center'>30</td>
      <td>加快ATB槽速度</td>
      <td>精灵横笛<br />赫尔默斯之靴</td>
    </tr>
    <tr>
      <td align='center'>沉默</td>
      <td align='center'>8</td>
      <td align='center'>25</td>
      <td width='35%'>使敌人无法施放魔法</td>
      <td>祭司拍<br />拉弥亚之笛<br />魔法护臂</td>
    </tr>
    <tr>
      <td align='center'>缩小</td>
      <td align='center'>8</td>
      <td align='center'>35</td>
      <td width='35%'>缩小术</td>
      <td>魔法拍<br />羽毛长靴</td>
    </tr>
    <tr>
      <td align='center'>反射</td>
      <td align='center'>6</td>
      <td align='center'>25</td>
      <td width='35%'>反弹敌人魔法</td>
      <td>秘银拍<br />反射戒指<br />红宝石</td>
    </tr>
    <tr>
      <td align='center'>浮空</td>
      <td align='center'>6</td>
      <td align='center'>25</td>
      <td>漂浮术</td>
      <td>拉弥亚之笛<br />拉弥亚头饰<br />羽毛长靴</td>
    </tr>
    <tr>
      <td align='center'>驱魔</td>
      <td align='center'>16</td>
      <td align='center'>35</td>
      <td width='35%'>解除由魔法引起的有利状态</td>
      <td>猫爪拍<br />塞壬之笛</td>
    </tr>
    <tr>
      <td align='center'>信念</td>
      <td align='center'>14</td>
      <td align='center'>25</td>
      <td width='35%'>提升攻击力</td>
      <td>祭司拍<br />哈默尔恩</td>
    </tr>
    <tr>
      <td align='center'>宝石</td>
      <td align='center'>4</td>
      <td align='center'>50</td>
      <td width='35%'>从敌人身上抽取原石</td>
      <td>哈默尔恩</td>
    </tr>
    <tr>
      <td align='center'>神圣</td>
      <td align='center'>36</td>
      <td align='center'>110</td>
      <td width='35%'>圣属性究极白魔法</td>
      <td>天使之笛<br />白袍</td>
    </tr>
    <tr>
      <td nowrap='nowrap' align='right' colspan='5'><a href='#top'>▲TOP</a></td>
    </tr>
  </tbody>
</table></center>
<p>&nbsp;</p>
<h3>艾可可装备辅助技能<img src='./pic/icon/skill/p.gif'></h3>
<table class='intro_table' border='0' width='450'>
<tr>
<td>※<strong>辅助技能的作用见<a href='./ff9_skill.php'>《辅助技能说明》</a></td>
</tr></table>
<p align=center><img src='pic/ability/s_eiko.jpg' width='320' height='360'></p>
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
    <td>70</td>
    <td >反射戒指</td>
  </tr>
  <tr>
    <td>恒浮空</td>
    <td>6</td>
    <td>25</td>
    <td >羽毛长靴</td>
  </tr>
  <tr>
    <td>恒加速</td>
    <td>9</td>
    <td>65</td>
    <td >赫尔默斯之靴</td>
  </tr>
  <tr>
    <td>恒再生</td>
    <td>10</td>
    <td>35</td>
    <td >魔像之笛<br>天使耳环<br />少女的祈祷</td>
  </tr>
  <tr>
    <td>护身符</td>
    <td>12</td>
    <td>100</td>
    <td >转生戒指</td>
  </tr>
  <tr>
    <td>MP增长10%</td>
    <td>4</td>
    <td>15</td>
    <td >魔术师之袍<br>魔术师之鞋<br />绿宝石</td>
  </tr>
  <tr>
    <td>MP增长20%</td>
    <td>8</td>
    <td>50</td>
    <td >天使耳环</td>
  </tr>
  <tr>
    <td>治疗者</td>
    <td>2</td>
    <td>20</td>
    <td >治疗权杖<br>脚镯<br>石榴石</td>
  </tr>
  <tr>
    <td>贯穿反射层</td>
    <td>7</td>
    <td>55</td>
    <td >王者之袍<br>珍珠口红</td>
  </tr>
  <tr>
    <td>集中精神</td>
    <td>10</td>
    <td>90</td>
    <td >王者之袍<br>罗塞塔戒指</td>
  </tr>
  <tr>
    <td>MP消耗减半</td>
    <td>11</td>
    <td>120</td>
    <td >光之袍<br />守护戒指</td>
  </tr>
  <tr>
    <td>满月的心得</td>
    <td>8</td>
    <td>30</td>
    <td >翡翠护臂<br>大地之衣<br>蓝宝石</td>
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
    <td>65</td>
    <td >唯我护臂<br>罗塞塔戒指<br>精灵耳环</td>
  </tr>
  <tr>
    <td>能力上升</td>
    <td>3</td>
    <td>55</td>
    <td >丝袍 <br>缎带 <br>发箍</td>
  </tr>
  <tr>
    <td>莫古的守护</td>
    <td>3</td>
    <td>30</td>
    <td >马代因戒指<br>缎带</td>
  </tr>
  <tr>
    <td>不眠之术</td>
    <td>5</td>
    <td>25</td>
    <td >花色丝巾<br>魔术师之衣<br>珊瑚戒指</td>
  </tr>
  <tr>
    <td>试毒之术</td>
    <td>4</td>
    <td>20</td>
    <td >玻璃护臂<br>救生背心<br>玻璃带扣</td>
  </tr>
 <tr>
    <td>不哑之术</td>
    <td>4</td>
    <td>15</td>
    <td >魔术师帽子<br>丝袍<br />珍珠口红</td>
  </tr>
    <tr>
    <td>不凝之术</td>
    <td>4</td>
    <td>35</td>
    <td >暗黑帽子<br>龙之护腕<br>青铜胸甲</td>
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
    <td>15</td>
    <td >脚镯 <br>魔人胸甲<br>救生背心</td>
  </tr>
  <tr>
    <td>不乱之术</td>
    <td>5</td>
    <td>15</td>
    <td >拉弥亚头饰<br>魔法护臂<br>魔术师之鞋</td>
  </tr>
  <tr>
    <td>助威</td>
    <td>12</td>
    <td>150</td>
    <td >浮石碎片</td>
  </tr>
  <tr>
     <td nowrap='nowrap' align='right' colspan='5'><a href='#top'>▲TOP</a></td>
  </tr>
</table></center></div>";
echo "</body></html>";
?>
<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
