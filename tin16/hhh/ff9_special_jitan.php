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
<h3>吉坦特技<img src='./pic/icon/skill/a.gif'></h3>
<p align=center><img src='pic/ability/a_zidane.jpg' width='320' height='240'></p>
<center><table cellspacing='0' cellpadding='0' class='table_center'>
    <tr class='cell5'>
      <td nowrap='nowrap' align='center'>技能名称</td>
      <td nowrap='nowrap' align='center'>MP</td>
      <td nowrap='nowrap' align='center'>AP</td>
      <td align='center'>效果</td>
      <td align='center'>持有该特技的装备</td>
    </tr>
    <tr>
      <td width='18%' align='center' nowrap='nowrap'>走为上策</td>
      <td width='6%' align='center' nowrap='nowrap'>0</td>
      <td width='5%' align='center' nowrap='nowrap'>40</td>
      <td width='32%'>战斗中,高确率脱离战斗,损失部分金钱。损失金钱数量=战斗后获得的金钱数量&times;10%</td>
      <td width='39%'>小刀<br />
      创世兵器<br />
      索林根之刃<br />
      碎魔刃<br />
      格尔米纳斯长靴</td>
    </tr>
    <tr>
      <td align='center' nowrap='nowrap'>火眼金睛</td>
      <td align='center' nowrap='nowrap'>0</td>
      <td align='center' nowrap='nowrap'>40</td>
      <td>查看敌人拥有道具</td>
      <td>金铜短剑<br>
      碎魔刃</td>
    </tr>
    <tr>
      <td align='center' nowrap='nowrap'>你看后面</td>
      <td align='center' nowrap='nowrap'>2</td>
      <td align='center' nowrap='nowrap'>30</td>
      <td>战斗中使用让战斗的情况变为我方先制攻击，可背后攻击敌人</td>
      <td>蝴蝶刃</td>
    </tr>
    <tr>
      <td align='center' nowrap='nowrap'>解放刀魂</td>
      <td align='center' nowrap='nowrap'>6</td>
      <td align='center' nowrap='nowrap'>35</td>
      <td>释放武器上附加的异常状态，100%命中，注意只有盗贼刀这类武器可以使用</td>
      <td>碳化刃</td>
    </tr>
    <tr>
      <td align='center' nowrap='nowrap'>施加包袱</td>
      <td align='center' nowrap='nowrap'>4</td>
      <td align='center' nowrap='nowrap'>50</td>
      <td>使敌人陷入累赘的状态</td>
      <td>撒伽塔纳斯<br>
     古罗马短剑 </td>
    </tr>
    <tr>
      <td align='center' nowrap='nowrap'>生命异元</td>
      <td align='center' nowrap='nowrap'>32</td>
      <td align='center' nowrap='nowrap'>55</td>
      <td>耗尽自己的HP和MP，完全回复其他队员的HP和MP</td>
      <td>正宗<br>
      爆裂者</td>
    </tr>
    <tr>
      <td align='center' nowrap='nowrap'>逢七则灵</td>
      <td align='center' nowrap='nowrap'>6</td>
      <td align='center' nowrap='nowrap'>85</td>
      <td>当HP的尾数为7的时候，无视对象防御，随机给予敌单体7、77、777、7777的固定伤害</td>
      <td>符文之牙<br />
      爆裂者<br />
      塔刃<br />
      古罗马短剑<br />
      盗贼帽子</td>
    </tr>
    <tr>
      <td align='center' nowrap='nowrap'>盗贼之证</td>
      <td align='center' nowrap='nowrap'>8</td>
      <td align='center' nowrap='nowrap'>100</td>
      <td>给予敌单人物理伤害</td>
      <td>塔刃<br />
      天使祝福</td>
    </tr>
    <tr>
      <td nowrap='nowrap' align='right' colspan='5'><a href='#top'>▲TOP</a></td>
    </tr>
</table></center>
<h3>吉坦可装备辅助技能<img src='./pic/icon/skill/p.gif'></h3>
<table class='intro_table' border='0' width='450'>
<tr>
<td>※<strong>辅助技能的作用见<a href='./ff9_skill.php'>《辅助技能说明》</a></td>
</tr></table>
<p align=center><img src='pic/ability/s_zidane.jpg' width='320' height='415'></p>
<center><table cellspacing='0' cellpadding='0' class='table_center'>
  <tr class='cell5'>
    <td width=30%>能力名称</td>
    <td width=10%>魔石</td>
    <td width=10%>AP</td>
    <td>持有能力装备名</td>
  </tr>
  <tr>
    <td>恒反射</td>
    <td>15</td>
    <td>95</td>
    <td align=left>反射戒指</td>
  </tr>
  <tr>
    <td>恒浮空</td>
    <td>6</td>
    <td>20</td>
    <td align=left>羽毛长靴</td>
  </tr>
  <tr>
    <td>恒加速</td>
    <td>9</td>
    <td>55</td>
    <td align=left>赫尔默斯之靴</td>
  </tr>
  <tr>
    <td>恒再生</td>
    <td>10</td>
    <td>25</td>
    <td align=left>黄金发夹
      <br>
      勇气套装</td>
  </tr>
  <tr>
    <td>护身符</td>
    <td>12</td>
    <td>130</td>
    <td align=left>转生戒指</td>
  </tr>
  <tr>
    <td>HP增长20%</td>
    <td>8</td>
    <td>40</td>
    <td align=left>精金帽子<br>
内力头带
  <br>
  战斗长靴</td>
  </tr>
  <tr>
    <td>与一之心</td>
    <td>2</td>
    <td>30</td>
    <td align=left>黑头巾<br>
      力量护腕<br>
      天青石</td>
  </tr>
  <tr>
    <td>障眼法</td>
    <td>5</td>
    <td>30</td>
    <td align=left>柔道服<br>
      反射戒指
        <br>
      钻石</td>
  </tr>
  <tr>
    <td>忍者的教诲</td>
    <td>16</td>
    <td>170</td>
    <td align=left>盗贼帽子<br>
      守护戒指
</td>
  </tr>
  <tr>
    <td>消耗MP攻击</td>
    <td>5</td>
    <td>45</td>
    <td align=left>火红帽子<br>
      战斗长靴<br>
      力量腰带</td>
  </tr>
  <tr>
    <td>鸟类杀手</td>
    <td>3</td>
    <td>20</td>
    <td align=left>精金背心
<br>
      黄色围巾
</td>
  </tr>
  <tr>
    <td>昆虫杀手</td>
    <td>2</td>
    <td>35</td>
    <td align=left>秘银护臂
</td>
  </tr>
  <tr>
    <td>石头杀手</td>
    <td>4</td>
    <td>30</td>
    <td align=left>力量肩带
      <br>
      精金背心</td>
  </tr>
  <tr>
    <td>不死系杀手</td>
    <td>2</td>
    <td>45</td>
    <td align=left>轿夫帽子<br>
      头饰
<br>
      恩凯护臂</td>
  </tr>
  <tr>
    <td>恶魔杀手</td>
    <td>2</td>
    <td>25</td>
    <td align=left>魔人胸甲<br>
      链子甲</td>
  </tr>
  <tr>
    <td>野兽杀手</td>
    <td>4</td>
    <td>30</td>
    <td align=left>闪光魔帽
      <br>
      唯我护臂
      <br>
      皮护腕
</td>
  </tr>
  <tr>
    <td>人形杀手</td>
    <td>2</td>
    <td>25</td>
    <td align=left>休普诺之冠<br>
      花色丝巾<br>
      珊瑚戒指</td>
  </tr>
  <tr>
    <td>鉴定师的手感</td>
    <td>5</td>
    <td>50</td>
    <td align=left>盗贼护手
</td>
  </tr>
  <tr>
    <td>偷钱</td>
    <td>5</td>
    <td>40</td>
    <td align=left>玻璃护臂
      <br>
      黄色围巾</td>
  </tr>
  <tr>
    <td>追加效果发动</td>
    <td>3</td>
    <td>35</td>
    <td align=left>羽饰帽子<br>
      骨质护腕<br>
      玻璃带扣</td>
  </tr>
  <tr>
    <td>博弈防御</td>
    <td>1</td>
    <td>20</td>
    <td align=left>精金帽子
      <br>
      缠头带
      <br>
      力量肩带</td>
  </tr>
  <tr>
    <td>满月的心得</td>
    <td>8</td>
    <td>35</td>
    <td align=left>翡翠护臂<br>
      大地之衣<br>
      蓝宝石</td>
  </tr>
  <tr>
    <td>反击</td>
    <td>8</td>
    <td>70</td>
    <td align=left>轿夫帽子
      <br>
      大地之衣<br>
      力量腰带</td>
  </tr>
  <tr>
    <td>护花使者</td>
    <td>4</td>
    <td>35</td>
    <td align=left>蝴蝶刃<br>
      皮衣</td>
  </tr>
  <tr>
    <td>以牙还牙</td>
    <td>5</td>
    <td>60</td>
    <td align=left>闪光魔帽
      <br>
      忍衣</td>
  </tr>
  <tr>
    <td>恒温</td>
    <td>4</td>
    <td>25</td>
    <td align=left>翡翠护臂<br>
      马代因戒指
        <br>
      精灵耳环</td>
  </tr>
  <tr>
    <td>警戒</td>
    <td>4</td>
    <td>40</td>
    <td align=left>忍衣
      <br>
      格尔米纳斯长靴</td>
  </tr>
  <tr>
    <td>等级上升</td>
    <td>7</td>
    <td>75</td>
    <td align=left>唯我护臂
      <br>
      罗塞塔戒指<br>
      精灵耳环</td>
  </tr>
  <tr>
    <td>能力上升</td>
    <td>3</td>
    <td>95</td>
    <td align=left>绿色贝雷帽
      <br>
      轻便锁子甲
      <br>
      天青石</td>
  </tr>
  <tr>
    <td>捞一票再跑</td>
    <td>3</td>
    <td>40</td>
    <td align=left>护腕<br>
      金领带
      <br>
      沙漠长靴</td>
  </tr>
  <tr>
    <td>不眠之术</td>
    <td>5</td>
    <td>30</td>
    <td align=left>花色丝巾<br>
      大地之衣<br>
      珊瑚戒指</td>
  </tr>
  <tr>
    <td>试毒之术</td>
    <td>4</td>
    <td>20</td>
    <td align=left>玻璃护臂
      <br>
      救生背心
      <br>
      玻璃带扣</td>
  </tr>
  <tr>
    <td>不盲之术</td>
    <td>4</td>
    <td>35</td>
    <td align=left>轿夫帽子
      <br>
      羽饰帽子</td>
  </tr>
  <tr>
    <td>濒死HP恢复</td>
    <td>8</td>
    <td>85</td>
    <td align=left>勇气套装<br>
      承诺之戒</td>
  </tr>
  <tr>
    <td>不凝之术</td>
    <td>4</td>
    <td>35</td>
    <td align=left>暗黑帽子<br>
      龙之护腕<br>
      青铜胸甲</td>
  </tr>
  <tr>
    <td>自动使用恢复剂</td>
    <td>3</td>
    <td>30</td>
    <td align=left>魔人胸甲<br>
      秘银背心
        <br>
      金领带</td>
  </tr>
  <tr>
    <td>不休之术</td>
    <td>4</td>
    <td>30</td>
    <td align=left>黑头巾
      <br>
      魔人胸甲<br>
救生背心</td>
  </tr>
  <tr>
    <td>不乱之术</td>
    <td>5</td>
    <td>25</td>
    <td align=left>绿色贝雷帽
      <br>
      黑装束<br>
      魔术师之鞋</td>
  </tr>
  <tr>
    <td>抢劫</td>
    <td>3</td>
    <td>65</td>
    <td align=left>盗贼帽子<br>
      奇美拉护臂
<br>
      救生背心</td>
  </tr>
  <tr>
    <td>盗贼的臻境</td>
    <td>5</td>
    <td>40</td>
    <td align=left>秘银匕首<br>
      恩凯护臂</td>
  </tr>
  <tr>
     <td nowrap='nowrap' align='right' colspan='4'><a href='#top'>▲TOP</a></td>
  </tr>
  </table></center></div>";
echo "</body></html>";
?>
<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
