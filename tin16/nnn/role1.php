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
echo "<center><h2>主角技能一览</h2>";
echo "<table width=100% >";
echo "<tr><th >等级</th><th >技能名称</th><th >消耗MP</th><th >作用</th></tr>";
echo "<tr><td>3</td><td>小治愈</td><td>2</td><td>我方单体HP回复30以上</td></tr>";
echo "<tr><td>4</td><td>解毒</td><td>2</td><td>我方单体毒、猛毒状态回复</td></tr>";
echo "<tr><td>6</td><td>脱出</td><td>2</td><td>从迷宫、塔中脱出</td></tr>";
echo "<tr><td>11</td><td>小火焰</td><td>4</td><td>敌一组火炎攻击小伤害</td></tr>";
echo "<tr><td>18</td><td>中治愈</td><td>3</td><td>我方单体HP回复75以上</td></tr>";
echo "<tr><td>20</td><td>中火焰</td><td>6</td><td>敌一组火炎攻击中等伤害</td></tr>";
echo "<tr><td>27</td><td>大治愈</td><td>6</td><td>我方单体HP全回复</td></tr>";
echo "<tr><td>29</td><td>复活</td><td>8</td><td>我方单体50%几率复活,复活后HP50%</td></tr>";
echo "<tr><td>30</td><td>大火焰</td><td>10</td><td>敌一组火炎攻击大伤害</td></tr>";
echo "<tr><td>65</td><td>龙之魂</td><td>64</td><td>敌单体雷攻击伤害约450</td></tr>";
echo "</table><br><br>";
echo "<table width=100% >";
echo "<tr><th colspan=5>剑技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td>1</td><td>4</td><td>攻击力+5</td><td>-</td><td>剑装备时攻击力+5</td></tr>";
echo "<tr><td>2</td><td>9</td><td>屠龙斩</td><td>0</td><td>对龙系怪物伤害150%</td></tr>";
echo "<tr><td>3</td><td>15</td><td>火焰斩</td><td>0</td><td>炎属性剑技，对无炎抗性怪物115%伤害</td></tr>";
echo "<tr><td>4</td><td>22</td><td>攻击力+10</td><td>-</td><td>剑装备时攻击力+10</td></tr>";
echo "<tr><td>5</td><td>30</td><td>金属斩</td><td>0</td><td>对金属史莱姆系怪物造成1-2伤害</td></tr>";
echo "<tr><td>6</td><td>40</td><td>会心率上升</td><td>-</td><td>剑装备时会心一击率上升</td></tr>";
echo "<tr><td>7</td><td>52</td><td>隼斩</td><td>0</td><td>以70%伤害对敌单体做出2次连续攻击,装备隼剑可4次攻击</td></tr>";
echo "<tr><td>8</td><td>66</td><td>攻击力+25</td><td>-</td><td>剑装备时攻击力+25</td></tr>";
echo "<tr><td>9</td><td>82</td><td>奇迹之剑</td><td>2</td><td>1</td></tr>";
echo "<tr><td>10</td><td>100</td><td>超级斩</td><td>20</td><td>对敌一组攻击的究级剑技伤害约165</td></tr>";
echo "<tr><td>组合技</td><td>-</td><td>超级重斩</td><td>20</td><td>超级斩的强化版，伤害敌一组约300</td></tr>";
echo "</table><br><br>";
echo "<table width=100% >";
echo "<tr><th colspan=5>枪技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td>1</td><td>3</td><td>攻击力+5</td><td>-</td><td>枪装备时攻击力+5</td></tr>";
echo "<tr><td>2</td><td>7</td><td>突刺</td><td>0</td><td>必定第一个攻击，伤害75%</td></tr>";
echo "<tr><td>3</td><td>12</td><td>一闪击</td><td>3</td><td>25%会心一击、25%普通攻击，其余MISS</td></tr>";
echo "<tr><td>4</td><td>18</td><td>攻击力+10</td><td>-</td><td>枪装备时攻击力+10</td></tr>";
echo "<tr><td>5</td><td>25</td><td>多重击</td><td>4</td><td>以50%的伤害对敌做3～4次攻击，目标随机</td></tr>";
echo "<tr><td>6</td><td>34</td><td>会心率上升</td><td>-</td><td>枪装备时会心一击率上升</td></tr>";
echo "<tr><td>7</td><td>45</td><td>秋风扫</td><td>0</td><td>以90%的伤害对敌一组进行攻击伤害渐减</td></tr>";
echo "<tr><td>8</td><td>59</td><td>雷光一闪击</td><td>3</td><td>一闪击的强化版，一旦命中必定会心一击，命中率50%</td></tr>";
echo "<tr><td>9</td><td>77</td><td>攻击力+25</td><td>-</td><td>枪装备时攻击力+25</td></tr>";
echo "<tr><td>10</td><td>100</td><td>雷电风暴</td><td>25</td><td>从地狱发起的对敌全体雷攻击造成伤害约200</td></tr>";
echo "</table><br><br>";
echo "<table width=100% >";
echo "<tr><th colspan=5>回旋镖技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td>1</td><td>6</td><td>切割投</td><td>2</td><td>敌全体攻击,，伤害85%，但最左端敌人2次伤害，第二次为第一次伤害的1/5</td></tr>";
echo "<tr><td>2</td><td>12</td><td>攻击力+5</td><td>-</td><td>回旋镖装备时攻击力+5</td></tr>";
echo "<tr><td>3</td><td>18</td><td>力量投</td><td>4</td><td>不会出现伤害渐减现象但伤害降低为85%</td></tr>";
echo "<tr><td>4</td><td>25</td><td>攻击力+10</td><td>-</td><td>回旋镖装备时攻击力+10</td></tr>";
echo "<tr><td>5</td><td>32</td><td>火焰投</td><td>6</td><td>敌全体造成炎属性伤害约35</td></tr>";
echo "<tr><td>6</td><td>40</td><td>攻击力+15</td><td>-</td><td>回旋镖装备时攻击力+15</td></tr>";
echo "<tr><td>7</td><td>52</td><td>强力投</td><td>4</td><td>力量投的强化版伤害提高到115%</td></tr>";
echo "<tr><td>8</td><td>66</td><td>攻击力+20</td><td>-</td><td>回旋镖装备时攻击力+20</td></tr>";
echo "<tr><td>9</td><td>82</td><td>星光投</td><td>8</td><td>敌全体造成光属性伤害约70</td></tr>";
echo "<tr><td>10</td><td>100</td><td>雷光投</td><td>16</td><td>敌单体造成雷属性伤害约165</td></tr>";


echo "<tr><td>1</td><td>4</td><td>小</td><td>2</td><td>1</td></tr>";
echo "</table><br><br>";
echo "<br><br><br><br>";
echo "</center></div>";
?>
