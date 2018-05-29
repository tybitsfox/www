<?php
echo "<html><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
echo "<link href='./ff9.css' rel='stylesheet' type='text/css' media='all'/>";
echo "<style type='text/css'>
.ff9 img{
	background: #eee;	
	border: 3px solid #ddd;}
</style>";
echo "</head><body>";
echo "<a name='top'/><div class='ff9'>
<h3>撒拉曼达特技<img src='./pic/icon/skill/a.gif'></h3>
<p align=center><img src='pic/ability/a_amarant.jpg' width='320' height='240'></p>
      <center><table cellspacing='0' cellpadding='0' class='table_center'>
          <tr class='cell5'>
            <td nowrap='nowrap' align='center'>技能名称</td>
            <td nowrap='nowrap' align='center'>MP</td>
            <td nowrap='nowrap' align='center'>AP</td>
            <td align='center'>效果</td>
            <td align='center'>持有该特技的装备</td>
          </tr>
          <tr>
            <td nowrap='nowrap' align='center' width='18%'>内力</td>
            <td nowrap='nowrap' align='center' width='6%'>4</td>
            <td nowrap='nowrap' align='center' width='5%'>30</td>
            <td width='32%'>我方单体HP/MP回复,回复量=对象最大HP、MP的20%，装备反射区熟知回复量为2倍</td>
            <td width='39%'>猫爪<br />皮甲</td>
          </tr>
          <tr>
            <td nowrap='nowrap' align='center'>金光一掷</td>
            <td nowrap='nowrap' align='center'>0</td>
            <td nowrap='nowrap' align='center'>90</td>
            <td>向敌人投掷金钱做无属性攻击,耗费金钱=撒拉曼达目前的等级×101;伤害值=耗费金钱的2次方×撒拉曼达的气力/</td>
            <td>符文之爪<br />带毒指套</td>
          </tr>
          <tr>
            <td nowrap='nowrap' align='center'>杂兵战法</td>
            <td nowrap='nowrap' align='center'>12</td>
            <td nowrap='nowrap' align='center'>25</td>
            <td>敌单体物理攻击,伤害值=[装备武器的攻击力×1.7-对象的物理防御力]×物理伤害的倍率。</td>
            <td>决斗之爪<br />龙爪</td>
          </tr>
          <tr>
            <td nowrap='nowrap' align='center'>光环</td>
            <td nowrap='nowrap' align='center'>12</td>
            <td nowrap='nowrap' align='center'>25</td>
            <td>我方单体处于自动复活、 HP徐徐回复状态 </td>
            <td>决斗之爪</td>
          </tr>
          <tr>
            <td nowrap='nowrap' align='center'>诅咒</td>
            <td nowrap='nowrap' align='center'>12</td>
            <td nowrap='nowrap' align='center'>20</td>
            <td>敌单体随机让一个属性成为弱点，100%命中</td>
            <td>帝王指套<br />秘银爪</td>
          </tr>
          <tr>
            <td nowrap='nowrap' align='center'>复生</td>
            <td nowrap='nowrap' align='center'>20</td>
            <td nowrap='nowrap' align='center'>35</td>
            <td>我方单体复活,HP回复量=对象最大HP×%,但僵尸属性时无效。</td>
            <td>符文之爪<br />虎牙<br />转生戒指</td>
          </tr>
          <tr>
            <td nowrap='nowrap' align='center'>重力拳</td>
            <td nowrap='nowrap' align='center'>20</td>
            <td nowrap='nowrap' align='center'>50</td>
            <td>敌单体重力攻击</td>
            <td>符文之爪<br />复仇者</td>
          </tr>
          <tr>
            <td nowrap='nowrap' align='center'>秘孔拳</td>
            <td nowrap='nowrap' align='center'>16</td>
            <td nowrap='nowrap' align='center'>40</td>
            <td>敌单体死之宣告状态</td>
            <td>帝王指套</td>
          </tr>
          <tr>
            <td nowrap='nowrap' align='right' colspan='5'><a href='#top'>▲TOP</a></td>
          </tr>
        </tbody>
  </table></center>
<p align=center>&nbsp;</p>
<p>&nbsp;</p>
<h3>撒拉曼达可装备辅助技能<img src='./pic/icon/skill/p.gif'></h3>
<table class='intro_table' border='0' width='450'>
<tr>
<td>※<strong>辅助技能的作用见<a href='./ff9_skill.php'>《辅助技能说明》</a></td>
</tr></table>
<p align=center><img src='pic/ability/s_amarant.jpg' width='320' height='415'></p>
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
    <td>85</td>
    <td >反射戒指</td>
  </tr>
  <tr>
    <td>恒浮空</td>
    <td>6</td>
    <td>35</td>
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
    <td>35</td>
    <td >黄金发夹<br>勇气套装</td>
  </tr>
  <tr>
    <td>护身符</td>
    <td>12</td>
    <td>140</td>
    <td >转生戒指</td>
  </tr>
  <tr>
    <td>HP增长10%</td>
    <td>4</td>
    <td>10</td>
    <td >柔道服<br>格尔米纳斯长靴<br>海蓝宝石</td>
  </tr>
  <tr>
    <td>HP增长20%</td>
    <td>8</td>
    <td>40</td>
    <td >精金帽子<br>内力头带<br>战斗长靴</td>
  </tr>
  <tr>
    <td>与一之心</td>
    <td>3</td>
    <td>20</td>
    <td >力量护腕<br>天青石</td>
  </tr>
  <tr>
    <td>忍者的教诲</td>
    <td>16</td>
    <td>210</td>
    <td >守护戒指</td>
  </tr>
  <tr>
    <td>消耗MP攻击</td>
    <td>5</td>
    <td>605</td>
    <td >火红帽子<br>战斗长靴<br>力量腰带</td>
  </tr>
  <tr>
    <td>鸟类杀手</td>
    <td>3</td>
    <td>10</td>
    <td >精金背心<br>黄色围巾</td>
  </tr>
  <tr>
    <td>昆虫杀手</td>
    <td>2</td>
    <td>10</td>
    <td >秘银护臂</td>
  </tr>
  <tr>
    <td>石头杀手</td>
    <td>4</td>
    <td>10</td>
    <td >力量肩带<br>精金背心</td>
  </tr>
  <tr>
    <td>不死系杀手</td>
    <td>2</td>
    <td>10</td>
    <td >轿夫帽子<br>头饰<br>恩凯护臂</td>
  </tr>
  <tr>
    <td>恶魔杀手</td>
    <td>2</td>
    <td>10</td>
    <td >魔人胸甲<br>链子甲</td>
  </tr>
  <tr>
    <td>野兽杀手</td>
    <td>4</td>
    <td>10</td>
    <td >闪光魔帽<br>唯我护臂<br>黑带</td>
  </tr>
  <tr>
    <td>人形杀手</td>
    <td>2</td>
    <td>10</td>
    <td >休普诺之冠<br>花色丝巾<br>珊瑚戒指</td>
  </tr>
  <tr>
    <td>治疗者</td>
    <td>2</td>
    <td>40</td>
    <td >脚镯<br />石榴石</td>
  </tr>  
  <tr>
    <td>追加效果发动</td>
    <td>3</td>
    <td>20</td>
    <td >缠头带<br />保护带<br />奇美拉护臂</td>
  </tr>
  <tr>
    <td>博弈防御</td>
    <td>1</td>
    <td>35</td>
    <td >精金帽子<br>缠头带<br>力量肩带</td>
  </tr>
  <tr>
    <td>马卡洛夫投掷法</td>
    <td>19</td>
    <td>125</td>
    <td >保护带</td>
  </tr>
  <tr>
    <td>熟悉反射区</td>
    <td>3</td>
    <td>30</td>
    <td >黄金无边帽</td>
  </tr>
  <tr>
    <td>满月的心得</td>
    <td>8</td>
    <td>60</td>
    <td >暗黑帽子<br>大地之衣<br>翡翠护臂</td>
  </tr>
  <tr>
    <td>反击</td>
    <td>8</td>
    <td>240</td>
    <td >秘银爪<br>带毒指套<br>猫爪</td>
  </tr>
  <tr>
    <td>庇护</td>
    <td>6</td>
    <td>90</td>
    <td >火红帽子</td>
  </tr>
  <tr>
    <td>以牙还牙</td>
    <td>5</td>
    <td>50</td>
    <td >闪光魔帽<br>忍衣</td>
  </tr>
  <tr>
    <td>恒温</td>
    <td>4</td>
    <td>30</td>
    <td >翡翠护臂<br>马代因戒指<br>精灵耳环</td>
  </tr>
  <tr>
    <td>警戒</td>
    <td>4</td>
    <td>30</td>
    <td >忍衣<br>格尔米纳斯长靴</td>
  </tr>
  <tr>
    <td>等级上升</td>
    <td>7</td>
    <td>50</td>
    <td >唯我护臂<br>罗塞塔戒指<br>精灵耳环</td>
  </tr>
  <tr>
    <td>能力上升</td>
    <td>3</td>
    <td>80</td>
    <td >绿色贝雷帽<br>轻便锁子甲<br>天青石</td>
  </tr>
  <tr>
    <td>捞一票再跑</td>
    <td>3</td>
    <td>30</td>
    <td >护腕<br>金领带<br>沙漠长靴</td>
  </tr>
  <tr>
    <td>不眠之术</td>
    <td>5</td>
    <td>20</td>
    <td >花色丝巾<br>大地之衣<br>珊瑚戒指</td>
  </tr>
  <tr>
    <td>试毒之术</td>
    <td>4</td>
    <td>25</td>
    <td >玻璃护臂<br>救生背心<br>内力头带</td>
  </tr>
  <tr>
    <td>不盲之术</td>
    <td>4</td>
    <td>25</td>
    <td >轿夫帽子</td>
  </tr>
  <tr>
    <td>濒死HP恢复</td>
    <td>8</td>
    <td>75</td>
    <td >勇气套装<br>承诺之戒</td>
  </tr>
  <tr>
    <td>不凝之术</td>
    <td>4</td>
    <td>15</td>
    <td >暗黑帽子<br>龙之护腕<br>黑装束</td>
  </tr>
  <tr>
    <td>魔法返还</td>
    <td>9</td>
    <td>170</td>
    <td >休普诺之冠<br>轻便锁子甲</td>
  </tr>
  <tr>
    <td>自动使用恢复剂</td>
    <td>3</td>
    <td>30</td>
    <td >魔人胸甲<br>赫尔默斯之靴 <br>金领带</td>
  </tr>
  <tr>
    <td>不休之术</td>
    <td>4</td>
    <td>20</td>
    <td >忍衣 <br>魔人胸甲<br>救生背心</td>
  </tr>
  <tr>
    <td>不乱之术</td>
    <td>5</td>
    <td>30</td>
    <td >绿色贝雷帽<br>黑装束<br>魔术师之鞋</td>
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
