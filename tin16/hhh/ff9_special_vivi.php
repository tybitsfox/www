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
<h3>比比特技<img src='./pic/icon/skill/a.gif'></h3>
<p align=center><img src='pic/ability/a_vivi.jpg' width='320' height='240'></p>
<center><table align='center' cellpadding='0' cellspacing='0' class='table_center'>
    <tbody>
      <tr class='cell5' align='center'>
        <td nowrap='nowrap'>技能名称</td>
        <td nowrap='nowrap'>MP</td>
        <td nowrap='nowrap'>AP</td>
        <td>效果</td>
        <td>持有该特技的装备</td>
      </tr>
      <tr>
        <td nowrap='nowrap' width='18%' align='center'>初级火焰</td>
        <td nowrap='nowrap' width='6%' align='center'>6</td>
        <td nowrap='nowrap' width='5%' align='center'>25</td>
        <td width='32%'>初级火焰魔法</td>
        <td width='39%'>魔道士之杖<br />皮帽</td>
      </tr>
      <tr class='cell2'>
        <td nowrap='nowrap' align='center'>中级火焰</td>
        <td nowrap='nowrap' align='center'>12</td>
        <td nowrap='nowrap' align='center'>50</td>
        <td>中级火焰魔法</td>
		<td>炎之杖<br />魔术师帽子<br />黄玉</td>
      </tr>
      <tr>
        <td nowrap='nowrap' align='center'>高级火焰</td>
        <td nowrap='nowrap' align='center'>24</td>
        <td nowrap='nowrap' align='center'>75</td>
        <td>高级火焰魔法</td>
        <td>八角棒</td>
      </tr>
      <tr class='cell2'>
        <td nowrap='nowrap' align='center'>催眠</td>
        <td nowrap='nowrap' align='center'>10</td>
        <td nowrap='nowrap' align='center'>20</td>
        <td>催眠术</td>
        <td>炎之杖</td>
      </tr>
      <tr>
        <td nowrap='nowrap' align='center'>初级寒冰</td>
        <td nowrap='nowrap' align='center'>6</td>
        <td nowrap='nowrap' align='center'>25</td>
        <td>初级冰冻魔法</td>
        <td>皮护腕</td>
      </tr>
      <tr class='cell2'>
        <td nowrap='nowrap' align='center'>中级寒冰</td>
        <td nowrap='nowrap' align='center'>12</td>
        <td nowrap='nowrap' align='center'>50</td>
        <td>中级冰冻魔法</td>
        <td>冰之杖<br />黄玉</td>
      </tr>
      <tr>
        <td nowrap='nowrap' align='center'>高级寒冰</td>
        <td nowrap='nowrap' align='center'>24</td>
        <td nowrap='nowrap' align='center'>85</td>
        <td>高级冰冻魔法</td>
        <td>八角棒</td>
      </tr>
      <tr class='cell2'>
        <td nowrap='nowrap' align='center'>减速</td>
        <td nowrap='nowrap' align='center'>6</td>
        <td nowrap='nowrap' align='center'>20</td>
        <td>降低ATB槽速度</td>
        <td>冰之杖<br />三角帽子</td>
      </tr>
      <tr>
        <td align='center'>初级闪电</td>
        <td align='center'>6</td>
        <td align='center'>25</td>
        <td>初级闪电魔法</td>
        <td>丝衣<br />玻璃带扣</td>
      </tr>
      <tr class='cell2'>
        <td align='center'>中级闪电</td>
        <td align='center'>12</td>
        <td align='center'>50</td>
        <td>中级闪电魔法</td>
        <td>雷之杖<br />橄榄石</td>
      </tr>
      <tr>
        <td align='center'>高级闪电</td>
        <td align='center'>24</td>
        <td align='center'>80</td>
        <td>高级闪电魔法</td>
        <td>八角棒</td>
      </tr>
      <tr class='cell2'>
        <td align='center'>停止</td>
        <td align='center'>8</td>
        <td align='center'>25</td>
        <td>使敌人停止行动</td>
        <td>橡木杖</td>
      </tr>
      <tr>
        <td align='center'>施毒</td>
        <td align='center'>8</td>
        <td align='center'>35</td>
        <td>对敌以毒攻击</td>
        <td>雷之杖</td>
      </tr>
      <tr class='cell2'>
        <td align='center'>生化</td>
        <td align='center'>18</td>
        <td align='center'>40</td>
        <td>毒属性魔法</td>
        <td>橡木杖</td>
      </tr>
      <tr>
        <td align='center'>摄魔</td>
        <td align='center'>2</td>
        <td align='center'>70</td>
        <td>吸收MP</td>
        <td>魔导师之杖<br />大地之衣</td>
      </tr>
      <tr class='cell2'>
        <td align='center'>吸魂</td>
        <td align='center'>14</td>
        <td align='center'>60</td>
        <td>吸收HP</td>
        <td>橡木杖</td>
      </tr>
      <tr>
        <td align='center'>重力</td>
        <td align='center'>18</td>
        <td align='center'>30</td>
        <td>重力魔法</td>
        <td>柏树枝<br />黑带<br />紫水晶</td>
      </tr>
      <tr class='cell2'>
        <td align='center'>彗星</td>
        <td align='center'>16</td>
        <td align='center'>55</td>
        <td>无属性陨石魔法</td>
        <td>柏树枝</td>
      </tr>
      <tr>
        <td align='center'>即死</td>
        <td align='center'>20</td>
        <td align='center'>45</td>
        <td>即死术</td>
        <td>黑头巾</td>
  		</tr>
      <tr class='cell2'>
        <td align='center'>石化</td>
        <td align='center'>18</td>
        <td align='center'>30</td>
        <td>石化术</td>
        <td>柏树枝</td>
      </tr>
      <tr>
        <td align='center'>水牢</td>
        <td align='center'>22</td>
        <td align='center'>55</td>
        <td>水属性魔法</td>
        <td>恩凯护臂</td>
      </tr>
      <tr class='cell2'>
        <td align='center'>陨石</td>
        <td align='center'>42</td>
        <td align='center'>95</td>
        <td>无属性陨石魔法</td>
        <td>魔导师之杖</td>
      </tr>
      <tr>
        <td align='center'>核爆</td>
        <td align='center'>40</td>
        <td align='center'>95</td>
        <td>无属性魔法</td>
        <td>黑袍</td>
      </tr>
      <tr class='cell2'>
        <td align='center'>圣战</td>
        <td align='center'>72</td>
        <td align='center'>150</td>
        <td>暗属性陨石魔法</td>
        <td>宙斯权杖</td>
  		</tr>
      <tr>
        <td nowrap='nowrap' align='right' colspan='5'><a href='#top'>▲TOP</a></td>
      </tr>
    </tbody>
  </table></center>
<h3>比比可装备辅助技能<img src='./pic/icon/skill/p.gif'></h3>
<table class='intro_table' border='0' width='450'>
<tr>
<td>※<strong>辅助技能的作用见<a href='./ff9_skill.php'>《辅助技能说明》</a></td>
</tr></table>
<p align=center><img src='./pic/ability/s_vivi.jpg' width='320' height='358'></p>
<center><table cellpadding='0' cellspacing='0' class='table_center'>
  <tbody>
    <tr class='cell5'>
      <td width='24%'>能力名称</td>
      <td width='8%'>魔石</td>
      <td width='8%'>AP</td>
      <td>持有能力的装备</td>
    </tr>
    <tr>
      <td>恒反射</td>
      <td>15</td>
      <td>70</td>
      <td align='left'>反射戒指
</td>
    </tr>
    <tr class='cell2'>
      <td>恒浮空</td>
      <td>6</td>
      <td>20</td>
      <td align='left'>羽毛长靴
</td>
    </tr>
    <tr>
      <td>恒加速</td>
      <td>9</td>
      <td>55</td>
      <td align='left'>赫尔默斯之靴
</td>
    </tr>
    <tr class='cell2'>
      <td>恒再生</td>
      <td>10</td>
      <td>30</td>
      <td align='left'>金领带
<br>光之袍
</td>
    </tr>
    <tr>
      <td>护身符</td>
      <td>12</td>
      <td>70</td>
      <td align='left'>转生戒指
</td>
    </tr>
    <tr class='cell2'>
      <td>MP增长20%</td>
      <td>8</td>
      <td>30</td>
      <td align='left'>黑袍
</td>
    </tr>
    <tr>
      <td>治疗者</td>
      <td>2</td>
      <td>20</td>
      <td align='left'>石榴石
</td>
    </tr>
    <tr class='cell2'>
      <td>追加效果发动</td>
      <td>3</td>
      <td>25</td>
      <td align='left'>羽饰帽子
<br>骨质护腕
<br>玻璃带扣
</td>
    </tr>
    <tr>
      <td>贯穿反射层</td>
      <td>7</td>
      <td>30</td>
      <td align='left'>王者之袍
</td>
    </tr>
    <tr class='cell2'>
      <td>反射威力加倍</td>
      <td>17</td>
      <td>110</td>
      <td align='left'>黑袍
<br>罗塞塔戒指
</td>
    </tr>
    <tr>
      <td>魔法无属性化</td>
      <td>13</td>
      <td>115</td>
      <td align='left'>守护戒指
<br>Promist Ring</td>
    </tr>
    <tr class='cell2'>
      <td>MP消耗减半</td>
      <td>11</td>
      <td>140</td>
      <td align='left'>光之袍
<br>守护戒指
</td>
    </tr>
    <tr>
      <td>满月的心得</td>
      <td>8</td>
      <td>25</td>
      <td align='left'>翡翠护臂
<br>大地之衣
<br>蓝宝石
</td>
    </tr>
    <tr class='cell2'>
      <td>恒温</td>
      <td>4</td>
      <td>15</td>
      <td align='left'>翡翠护臂
<br>马代因戒指
<br>精灵耳环
</td>
    </tr>
    <tr>
      <td>等级上升</td>
      <td>7</td>
      <td>30</td>
      <td align='left'>唯我护臂
<br>罗塞塔戒指
<br>精灵耳环
</td>
    </tr>
    <tr class='cell2'>
      <td>能力上升</td>
      <td>3</td>
      <td>55</td>
      <td align='left'>丝袍
<br>缎带
<br>天青石
</td>
    </tr>
    <tr>
      <td>不眠之术</td>
      <td>5</td>
      <td>25</td>
      <td align='left'>花色丝巾
<br>魔术师之衣
<br>珊瑚戒指
</td>
    </tr>
    <tr class='cell2'>
      <td>试毒之术</td>
      <td>4</td>
      <td>30</td>
      <td align='left'>玻璃护臂
<br>救生背心
<br>玻璃带扣
</td>
    </tr>
    <tr>
      <td>不哑之术</td>
      <td>4</td>
      <td>40</td>
      <td align='left'>金领带
<br>魔术师帽子
<br>丝袍
</td>
    </tr>
    <tr class='cell2'>
      <td>不凝之术</td>
      <td>4</td>
      <td>25</td>
      <td align='left'>暗黑帽子
<br>龙之护腕
<br>青铜胸甲
</td>
    </tr>
    <tr>
      <td>魔法返还</td>
      <td>9</td>
      <td>90</td>
      <td align='left'>休普诺之冠
</td>
    </tr>
    <tr class='cell2'>
      <td>自动使用恢复剂</td>
      <td>3</td>
      <td>10</td>
      <td align='left'>魔术师之袍
<br>Mythril Vest<br>金领带
</td>
    </tr>
    <tr>
      <td>不休之术</td>
      <td>4</td>
      <td>35</td>
      <td align='left'>黑头巾
<br>魔人胸甲
<br>救生背心
</td>
    </tr>
    <tr class='cell2'>
      <td>不乱之术</td>
      <td>5</td>
      <td>15</td>
      <td align='left'>绿色贝雷帽
<br>魔法护臂
<br>魔术师之鞋
</td></tr>
<tr>
      <td nowrap='nowrap' align='right' colspan='4'><a href='#top'>▲TOP</a></td>
</tr>
</tbody></table></center><br /></div>";
echo "</body></html>";
?>
<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
