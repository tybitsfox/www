<?php
echo "<html><head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<style type='text/css'>
body{ text-align:left} 
#divcenter{margin:0 auto;width:1024px}
#divcenter table{text-align:center;border=1px black solid;border-collapse:collapse;}
#divcenter th{border:1px black solid;background-color:#CCFFFF;}
#divcenter td{border:1px black solid;}
</style>
</head><body><div id='divcenter'>";
echo "<center><h2>库库鲁技能一览</h2>";
echo "<table width=100% >";
echo "<tr><th >等级</th><th >技能名称</th><th >消耗MP</th><th >作用</th></tr>";
echo "<tr><td rowspan='4'>初期</td><td>荷伊米</td><td >2</td><td >我方单体HP30以上回复</td></tr>
<tr><td>巴基</td><td >2</td><td >敌一组真空攻击小伤害</td></tr>
<tr><td>史库拉</td><td >2</td><td >5~6回合我方单体防御上升50%,可累计上升200</td></tr>
<tr><td>鲁拉</td><td >1</td><td >瞬间回到去过的城镇等地</td></tr>
<tr><td >13</td><td>基阿里克</td><td >2</td><td >我方全体睡眠，麻痹状态回复</td></tr>
<tr><td >14</td><td>史克鲁多</td><td >3</td><td >5~6回合内我方全体防御力上升25%，可累计上升200</td></tr>
<tr><td >15</td><td>贝荷伊米</td><td >3</td><td >我方单体HP75以上回复</td></tr>
<tr><td >17</td><td>查可</td><td >4</td><td >敌单体即死</td></tr>
<tr><td >18</td><td>巴基玛</td><td >4</td><td >敌一组真空攻击中等伤害</td></tr>
<tr><td >19</td><td>查欧拉鲁</td><td >8</td><td >我方单体50%几率复活，复活后HP一半</td></tr>
<tr><td >22</td><td>查拉可</td><td >7</td><td >敌一组即死</td></tr>
<tr><td >24</td><td>贝荷玛</td><td >6</td><td >我方单体HP全回复</td></tr>
<tr><td >30</td><td>贝荷玛拉</td><td >18</td><td >我方全体HP100以上回复</td></tr>
<tr><td >32</td><td>巴基克洛斯</td><td >8</td><td >敌一组真空攻击大伤害</td></tr>
<tr><td >34</td><td>查欧立克</td><td >15</td><td >我方单体100%几率复活,复活后HP满</td></tr>";
echo "</table><br><br>";
echo "<table width=100% >";
echo "<tr><th colspan=5>剑技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td>1</td><td>4</td><td>攻击力+5</td><td>-</td><td>剑装备时攻击力+5</td></tr>
<tr><td >2</td><td >9</td><td>火焰斩</td><td >0</td><td >炎属性剑技，对无炎抗性怪物1.15倍伤害</td></tr>
<tr><td>3</td><td>15</td><td>攻击力+10</td><td>0</td><td>剑装备时攻击力+10</td></tr>
<tr><td >4</td><td >22</td><td>金属重斩</td><td >0</td><td >对金属史莱姆系怪物造成1-2伤害</td></tr>
<tr><td>5</td><td>30</td><td>攻击力+20</td><td>-</td><td>剑装备时攻击力+20</td></tr>
<tr><td >6</td><td >40</td><td>猎鹰重斩</td><td >0</td><td >以70%伤害对敌单体做出2次连续攻击,装备隼剑可4次攻击</td></tr>
<tr><td>7</td><td>52</td><td>会心率上升</td><td>-</td><td>剑装备时会心一击率上升</td></tr>
<tr><td >8</td><td >66</td><td>剑之奇迹</td><td >4</td><td >恢复HP量=对敌伤害量的50%,但恢复量不大于敌残留HP</td></tr>
<tr><td>9</td><td>83</td><td>攻击力+25</td><td>-</td><td>剑装备时攻击力+25</td></tr>
<tr><td >10</td><td >100</td><td>地狱雷霆</td><td >25</td><td >从地狱发起的对敌全体雷攻击造成伤害约200</td></tr>";
echo "</table><br><br>";
echo "<table width=100% >";
echo "<tr><th colspan=5>弓技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td >1</td><td >6</td><td>拉里荷之箭</td><td >2</td><td >敌一体攻击，附带催眠效果</td></tr>
<tr><td >2</td><td >18</td><td>妖精之矢</td><td >0</td><td >100%伤害攻击敌单体的同时MP回复,回复量=对敌伤害的1/16，但不可超过敌人的最大HP，攻击加倍和蓄气不会提升回复量</td></tr>
<tr><td >3</td><td >25</td><td>钻头射击</td><td >1</td><td >敌单体即死攻击,失败的话则造成1的伤害，成功率极低</td></tr>
<tr><td>4</td><td>32</td><td>攻击力+10</td><td>-</td><td>弓装备时攻击力+10</td></tr>
<tr><td >5</td><td >44</td><td>五月雨矢</td><td >4</td><td >以50%的伤害对敌作出3～4次攻击，目标随机</td></tr>
<tr><td>6</td><td>59</td><td>会心率上升</td><td>-</td><td>弓装备时会心率上升</td></tr>
<tr><td >7</td><td >66</td><td>精灵之矢</td><td >0</td><td >精灵之矢的强化版本，回复量提升到1/8</td></tr>
<tr><td>8</td><td>76</td><td>攻击力+25</td><td>-</td><td>弓装备时攻击力+25</td></tr>
<tr><td >9</td><td >88</td><td>瞬光矢</td><td >10</td><td >敌全体光属性攻击伤害约110</td></tr>
<tr><td >10</td><td >100</td><td>钻头冲击</td><td >1</td><td >钻头射击的强化版，攻击变成四次，成功率无提高</td></tr>";
echo "</table><br><br>";
echo "<table width=100% >";
echo "<tr><th colspan=5>杖技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td >1</td><td >3</td><td>炫目</td><td >5</td><td >敌一组物理攻击命中率减半</td></tr>
<tr><td >2</td><td >6</td><td>玛霍托恩</td><td >3</td><td >敌一组咒文封印</td></tr>
<tr><td >3</td><td >9</td><td>玛荷坎达</td><td >4</td><td >一定几率把受到的魔法反弹给使用者</td></tr>
<tr><td >4</td><td >12</td><td>MP吸收</td><td >0</td><td >吸收敌单体3~10MP,敌人无MP时无法吸收</td></tr>
<tr><td>5</td><td>28</td><td>最大MP+20</td><td>-</td><td>杖装备时最大MP+20</td></tr>
<tr><td >6</td><td >48</td><td>祝福之杖</td><td >0</td><td >（战斗中）我方单体HP75以上回复</td></tr>
<tr><td >7</td><td >56</td><td>查拉可</td><td >15</td><td >敌全体即死</td></tr>
<tr><td >8</td><td >65</td><td>拜基鲁特</td><td >6</td><td >5~6回合内我方单体对敌物理攻击伤害2倍，多段攻击仅第一击有效</td></tr>
<tr><td>9</td><td>80</td><td>最大MP+50</td><td>-</td><td>杖装备时最大MP+50</td></tr>
<tr><td>10</td><td>100</td><td>MP自然回复</td><td>-</td><td>杖装备状态下每回合结束时,MP回复1～15，回复量随等级而定</td></tr>";
echo "</table><br><br>";
echo "<table width=100% >";
echo "<tr><th colspan=5>格斗技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td>1</td><td>7</td><td>攻击力+7</td><td>-</td><td>不装备武器时攻击力+7</td></tr>
<tr><td>2</td><td>14</td><td>速度+10</td><td>-</td><td>不装备武器时速度+10</td></tr>
<tr><td>3</td><td>21</td><td>回避上升</td><td>-</td><td>不装备武器时对物理攻击回避率上升</td></tr>
<tr><td>4</td><td>28</td><td>攻击力+15</td><td>-</td><td>不装备武器时攻击力+15</td></tr>
<tr><td >5</td><td >35</td><td>正拳突击</td><td >2</td><td >以150%的伤害对敌单体攻击,蓄气无效</td></tr>
<tr><td >6</td><td >42</td><td>月之收割</td><td >6</td><td >对敌全体做出等伤害的攻击,伤害=正常伤害X3/（敌人数量+1）攻击加倍无效</td></tr>
<tr><td>7</td><td>54</td><td>会心率上升</td><td>-</td><td>不装备武器时会心率上升</td></tr>
<tr><td >8</td><td >68</td><td>高级防御</td><td >0</td><td >受到的伤害1/10化</td></tr>
<tr><td>9</td><td>82</td><td>攻击力+40</td><td>-</td><td>不装备武器时攻击力+40</td></tr>
<tr><td >10</td><td >100</td><td>月之奇迹</td><td >6</td><td >月之收割的强化版，攻击时HP回复对其伤害的10%~25%，且伤害强化为正常伤害X4/（敌人数量+1）</td></tr>";
echo "</table><br><br>";
echo "<table width=100% >";
echo "<tr><th colspan=5>魅力技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td >1</td><td >3</td><td>基阿里</td><td >2</td><td >我方单体毒、猛毒状态回复</td></tr>
<tr><td >2</td><td >7</td><td>按摩</td><td >5</td><td >敌一组混乱</td></tr>
<tr><td >3</td><td >13</td><td>嘲笑</td><td >3</td><td >敌单体蓄气下降一级</td></tr>
<tr><td >4</td><td >19</td><td>天使之眼</td><td >4</td><td >敌单体无属性伤害约15,并附带麻痹效果</td></tr>
<tr><td >5</td><td >27</td><td>神助</td><td >4</td><td >敌一组受到属性伤害变成110%</td></tr>
<tr><td >6</td><td >39</td><td>封印舞蹈</td><td >4</td><td >敌一组舞蹈系特技封印</td></tr>
<tr><td >7</td><td >52</td><td>冷笑</td><td >3</td><td > 嘲笑的强化版，敌一组蓄气下降一级</td></tr>
<tr><td >8</td><td >66</td><td>按摩</td><td >10</td><td >敌全体混乱</td></tr>
<tr><td >9</td><td >81</td><td>魅惑之眼</td><td >4</td><td > 天使之眼的强化版，敌全体无属性伤害约75，并附带麻痹效果</td></tr>
<tr><td >10</td><td >100</td><td>黄泉之路</td><td >20</td><td >敌一组真空属性伤害约200</td></tr>";
echo "</table><br><br>";
echo "</div>";
?>
