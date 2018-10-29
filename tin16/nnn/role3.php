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
echo "<center><h2>洁西卡技能一览</h2>";
echo "<table width=100% >";
echo "<tr><th >等级</th><th >技能名称</th><th >消耗MP</th><th >作用</th></tr>";
echo "<tr><td rowspan='2'>初期</td><td>梅拉</td><td >2</td><td >敌单体火炎攻击小伤害</td></tr>
<tr><td>鲁卡尼</td><td >3</td><td >5~6回合内敌单体防御力,下降50%，可降低到0</td></tr>
<tr><td >10</td><td>希亚多</td><td >3</td><td >敌单体冰攻击小伤害</td></tr>
<tr><td >11</td><td>利雷米特</td><td >2</td><td >从迷宫、塔中脱出</td></tr>
<tr><td >11</td><td>基拉</td><td >4</td><td >敌一组火炎攻击小伤害</td></tr>
<tr><td >12</td><td>拉里荷</td><td >3</td><td >敌一组睡眠</td></tr>
<tr><td >14</td><td>伊欧</td><td >5</td><td >敌全体爆炸攻击小伤害</td></tr>
<tr><td >16</td><td>希亚达克</td><td >5</td><td >敌一组冰属性攻击中等伤害</td></tr>
<tr><td >19</td><td>拜基鲁特</td><td >6</td><td >5~6回合内我方单体对敌物理攻击伤害2倍，多段攻击仅第一击有效</td></tr>
<tr><td >20</td><td>贝基拉玛</td><td >6</td><td >敌一组火炎攻击中等伤害</td></tr>
<tr><td >21</td><td>梅拉米</td><td >4</td><td >敌单体火炎攻击中等伤害</td></tr>
<tr><td >23</td><td>伊欧拉</td><td >8</td><td >敌全体爆炸攻击大伤害</td></tr>
<tr><td >25</td><td>弗巴哈</td><td >3</td><td >5~6回合内我方全体受到的,火焰和吹雪伤害减半</td></tr>
<tr><td >33</td><td>伊欧纳兹</td><td >15</td><td >敌全体爆炸攻击大伤害</td></tr>
<tr><td >35</td><td>鲁拉左玛</td><td >10</td><td >敌单体火炎攻击大伤害</td></tr>
<tr><td rowspan='2'>事件习得</td><td>玛希亚多</td><td >12</td><td >敌全体冰攻击大伤害</td></tr>
<tr><td>贝基拉冈</td><td >10</td><td >敌一组火炎攻击大伤害</td></tr>";
echo "</table><br><br>";


echo "<table width=100% >";
echo "<tr><th colspan=5>短剑技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td>1</td><td>4</td><td>攻击力+5</td><td>-</td><td>短剑装备时攻击力+5</td></tr>
<tr><td >2</td><td >9</td><td>猝毒匕首</td><td >3</td><td >50%伤害的普通攻击,低几率附带中毒效果</td></tr>
<tr><td>3</td><td>15</td><td>攻击力+10</td><td>-</td><td>短剑装备时攻击力+10</td></tr>
<tr><td >4</td><td >22</td><td>暗杀攻击</td><td >8</td><td >100%伤害对敌单体攻击,低几率附带即死效果</td></tr>
<tr><td>5</td><td>30</td><td>可装备长剑</td><td>-</td><td>可装备长剑系武器</td></tr>
<tr><td>6</td><td>40</td><td>会心率上升</td><td>-</td><td>长剑/短剑装备时会心率上升</td></tr>
<tr><td>7</td><td>52</td><td>攻击+20</td><td>-</td><td>长剑/短剑装备时攻击力+20</td></tr>
<tr><td >8</td><td >66</td><td>猛毒匕首</td><td >3</td><td >猝毒匕首的强化版，伤害提升到115%，攻击附带猛毒效果</td></tr>
<tr><td>9</td><td>82</td><td>攻击+30</td><td>-</td><td>长剑/短剑装备时攻击力+30</td></tr>
<tr><td >10</td><td >100</td><td>即死攻击</td><td >8</td><td >暗杀攻击的强化版,伤害提升到125%，即死几率上升</td></tr>";
echo "</table><br><br>";
echo "<table width=100% >";
echo "<tr><th colspan=5>鞭技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td>1</td><td>4</td><td>攻击力+5</td><td>-</td><td>鞭装备时攻击力+5</td></tr>
<tr><td >2</td><td >10</td><td>爱之鞭</td><td >4</td><td >敌一组攻击附加麻痹效果</td></tr>
<tr><td>3</td><td>16</td><td>攻击力+10</td><td>-</td><td>鞭装备时攻击力+10</td></tr>
<tr><td >4</td><td >23</td><td>双龙打</td><td >3</td><td >以150%的伤害对敌一组中的单体,进行两回连续攻击，目标随机</td></tr>
<tr><td >5</td><td >33</td><td>女王鞭</td><td >2</td><td >敌一组攻击加HP吸收效果</td></tr>
<tr><td>6</td><td>43</td><td>攻击力+15</td><td>-</td><td>鞭装备时攻击力+15</td></tr>
<tr><td >7</td><td >55</td><td>爱之鞭</td><td >4</td><td >爱之鞭的强化版,麻痹几率更高</td></tr>
<tr><td>8</td><td>68</td><td>攻击力+25</td><td>-</td><td>鞭装备时攻击力+25</td></tr>
<tr><td >9</td><td >82</td><td>女王鞭</td><td >2</td><td >女王鞭的强化版,吸收的HP更多</td></tr>
<tr><td >10</td><td >100</td><td>潜地大蛇</td><td >8</td><td >以150%的伤害对敌一组进行攻击，伤害渐减</td></tr>";
echo "</table><br><br>";

echo "<table width=100% >";
echo "<tr><th colspan=5>杖技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td >1</td><td >3</td><td>皮欧利姆</td><td >3</td><td >我方全体速度翻倍,可累计上升至999</td></tr>
<tr><td >2</td><td >7</td><td>鲁卡南</td><td >4</td><td >5~6回合内敌一组防御力下降25%，可降低到0</td></tr>
<tr><td>3</td><td>13</td><td>最大MP+20</td><td>-</td><td>杖装备时最大MP+20&nbsp;</td></tr>
<tr><td >4</td><td >21</td><td>玛荷坎达</td><td >4</td><td >一定几率把受到的魔法反弹给使用者</td></tr>
<tr><td >5</td><td >31</td><td>玛吉克巴利亚</td><td >3</td><td >我方全体对魔法的抵抗力加强</td></tr>
<tr><td>6</td><td>44</td><td>最大MP+50</td><td>-</td><td>杖装备时最大MP+50</td></tr>
<tr><td >7</td><td >57</td><td>祝福之杖</td><td >0</td><td >（战斗中）我方单体HP75以上回复</td></tr>
<tr><td>8</td><td>70</td><td>MP自然回复</td><td>-</td><td>杖装备状态下每回合结束时,MP回复1～15，回复量随等级而定</td></tr>
<tr><td>9</td><td>84</td><td>最大MP+100</td><td>-</td><td>杖装备时最大MP+100</td></tr>
<tr><td >10</td><td >100</td><td>查欧立克</td><td >15</td><td >我方单体100%几率复活,复活后HP满</td></tr>";
echo "</table><br><br>";
echo "<table width=100% >";
echo "<tr><th colspan=5>格斗技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td>1</td><td>5</td><td>攻击力+5</td><td>-</td><td>不装备武器时攻击力+5</td></tr>
<tr><td>2</td><td>13</td><td>速度+10</td><td>-</td><td>不装备武器时速度+10</td></tr>
<tr><td >3</td><td >19</td><td>初级滚石术</td><td >0</td><td >对敌一组攻击伤害约20&nbsp;</td></tr>
<tr><td>4</td><td>28</td><td>会心率上升</td><td>-</td><td>不装备武器时会心率上升</td></tr>
<tr><td>5</td><td>35</td><td>攻击力+20</td><td>-</td><td>不装备武器时攻击力+20</td></tr>
<tr><td >6</td><td >45</td><td>月之收割</td><td >6</td><td >对敌全体做出等伤害的攻击,伤害=正常伤害X3/（敌人数量+1）</td></tr>
<tr><td>7</td><td>52</td><td>回避上升</td><td>-</td><td>不装备武器时对物理攻击回避率上升</td></tr>
<tr><td >8</td><td >68</td><td>真空波</td><td >2</td><td >敌全体造成真空属性伤害,等级越高伤害越大</td></tr>
<tr><td>9</td><td>85</td><td>攻击力+35</td><td>-</td><td>不装备武器时攻击力+35</td></tr>
<tr><td >10</td><td >100</td><td>魔法爆裂</td><td >全部</td><td >释放所有魔力攻击全体敌人,伤害约为MP的2倍</td></tr>";
echo "</table><br><br>";
echo "<table width=100% >";
echo "<tr><th colspan=5>色气技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td >1</td><td >8</td><td>飞吻</td><td >0</td><td >敌单体攻击,一定几率使其行动不能</td></tr>
<tr><td>2</td><td>18</td><td>魅惑</td><td>-</td><td>敌人随机被魅惑，当回合无法行动</td></tr>
<tr><td >3</td><td >28</td><td>按摩</td><td >5</td><td >敌一组混乱</td></tr>
<tr><td >4</td><td >38</td><td>屁股攻击</td><td >0</td><td >敌单体高几率行动不能,对女性怪物无效</td></tr>
<tr><td >5</td><td >48</td><td>金猪压顶</td><td >0</td><td >以115%的伤害对敌单体攻击</td></tr>
<tr><td >6</td><td >54</td><td>性感光线</td><td >3</td><td >敌单体攻击，一定几率使其混乱</td></tr>
<tr><td >7</td><td >68</td><td>催眠</td><td >8</td><td >敌一组高几率睡眠</td></tr>
<tr><td>8</td><td>78</td><td>强力魅惑</td><td>-</td><td>敌人随机被魅惑的几率更高</td></tr>
<tr><td >9</td><td >88</td><td>粉红台风</td><td >5</td><td >敌一组真空属性伤害</td></tr>
<tr><td >10</td><td >100</td><td>热情之舞</td><td >0</td><td >（战斗中）我方全体HP70以上回复</td></tr>";
echo "</table><br><br>";
echo "</div>";
?>
