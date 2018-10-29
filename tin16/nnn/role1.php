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
echo "<tr><td >3</td><td>荷伊米</td><td >2</td><td >我方单体HP回复30以上</td></tr>
<tr><td >4</td><td>基阿里</td><td >2</td><td >我方单体毒、猛毒状态回复</td></tr>
<tr><td >6</td><td>利雷米特</td><td >2</td><td >从迷宫、塔中脱出</td></tr>
<tr><td >11</td><td>基拉</td><td >4</td><td >敌一组火炎攻击小伤害</td></tr>
<tr><td >18</td><td>贝荷伊米</td><td >3</td><td >我方单体HP回复75以上</td></tr>
<tr><td >20</td><td>贝基拉玛</td><td >6</td><td >敌一组火炎攻击中等伤害</td></tr>
<tr><td >27</td><td>贝荷玛</td><td >6</td><td >我方单体HP全回复</td></tr>
<tr><td >29</td><td>查欧拉鲁</td><td >8</td><td >我方单体50%几率复活,复活后HP50%</td></tr>
<tr><td >32</td><td>贝基拉冈</td><td >10</td><td >敌一组火炎攻击大伤害</td></tr>
<tr><td>65</td><td>Dragon Soul</td><td>64　</td><td>敌单体雷攻击伤害约450</td></tr>";
echo "</table><br><br>";
echo "<table width=100% >";
echo "<tr><th colspan=5>剑技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td>1</td><td>4</td><td>攻击力+5</td><td>-</td><td>剑装备时攻击力+5</td></tr>
<tr><td >2</td><td >9</td><td>屠龙斩</td><td >0</td><td >对龙系怪物伤害150%</td></tr>
<tr><td >3</td><td >15</td><td>火焰斩</td><td >0</td><td >炎属性剑技，对无炎抗性怪物115%伤害</td></tr>
<tr><td>4</td><td>22</td><td>攻击力+10</td><td>-</td><td>剑装备时攻击力+10&nbsp;</td></tr>
<tr><td >5</td><td >30</td><td>金属重斩</td><td >0</td><td >对金属史莱姆系怪物造成1-2伤害</td></tr>
<tr><td>6</td><td>40</td><td>会心率上升</td><td>-</td><td>剑装备时会心一击率上升&nbsp;</td></tr>
<tr><td >7</td><td >52</td><td>猎鹰重斩</td><td >0</td><td >以70%伤害对敌单体做出2次连续攻击,装备隼剑可4次攻击</td></tr>
<tr><td>8</td><td>66</td><td>攻击力+25</td><td>-</td><td>剑装备时攻击力+25</td></tr>
<tr><td >9</td><td >82</td><td>剑之奇迹</td><td >4</td><td >恢复HP量=对敌伤害量的50%但恢复量不大于敌残留HP</td></tr>
<tr><td >10</td><td >100</td><td>千兆能量斩</td><td >20</td><td >对敌一组攻击的究级剑技伤害约165</td></tr>
<tr><td >组合技</td><td >-</td><td>超级爆裂斩</td><td >20</td><td >千兆能量斩的强化版伤害敌一组约300</td></tr>
<tr><th colspan='5'>最后一个特技比较特殊，需要把勇气特技也加到100才能习得，且无须装备剑也能使用！</th></tr>";
echo "</table><br><br>";
echo "<table width=100% >";
echo "<tr><th colspan=5>枪技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td>1</td><td>3</td><td>攻击力+5</td><td>-</td><td>枪装备时攻击力+5&nbsp;</td></tr>
<tr><td >2</td><td >7</td><td>疾风突击</td><td >0</td><td >必定第一个攻击，伤害75%</td></tr>
<tr><td >3</td><td >12</td><td>雷霆一闪</td><td >3</td><td >25%会心一击、25%普通攻击，其余MISS</td></tr>
<tr><td>4</td><td>18</td><td>攻击力+10</td><td>-</td><td>枪装备时攻击力+10</td></tr>
<tr><td >5</td><td >25</td><td>五月雨刺</td><td >4</td><td >以50%的伤害对敌做3～4次攻击，目标随机</td></tr>
<tr><td>6</td><td>34</td><td>会心率上升</td><td>-</td><td>枪装备时会心一击率上升</td></tr>
<tr><td >7</td><td >45</td><td>风卷残云</td><td >0</td><td >以90%的伤害对敌一组进行攻击伤害渐减</td></tr>
<tr><td >8</td><td >59</td><td>闪电突袭</td><td >3</td><td >雷霆一闪的强化版，一旦命中必定会心一击，命中率50%</td></tr>
<tr><td>9</td><td>77</td><td>攻击力+25</td><td>-</td><td>枪装备时攻击力+25</td></tr>
<tr><td >10</td><td >100</td><td>地狱雷霆</td><td >25</td><td >从地狱发起的对敌全体雷攻击造成伤害约200</td></tr>";
echo "</table><br><br>";
echo "<table width=100% >";
echo "<tr><th colspan=5>回旋镖技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td >1</td><td >6</td><td>横空投掷</td><td >2</td><td >敌全体攻击,，伤害85%，但最左端敌人2次伤害，第二次为第一次伤害的1/5</td></tr>
<tr><td>2</td><td>12</td><td>攻击力+5</td><td>-</td><td>回旋镖装备时攻击力+5</td></tr>
<tr><td >3</td><td >18</td><td>强力投掷</td><td >4</td><td >不会出现伤害渐减现象,但伤害降低为85%</td></tr>
<tr><td>4</td><td>25</td><td>攻击力+10</td><td>-</td><td>回旋镖装备时攻击力+10</td></tr>
<tr><td >5</td><td >32</td><td>火炎投掷</td><td >6</td><td >敌全体造成炎属性伤害约35</td></tr>
<tr><td>6</td><td>40</td><td>攻击力+15</td><td>-</td><td>回旋镖装备时攻击力+15&nbsp;</td></tr>
<tr><td >7</td><td >52</td><td>超级强力投掷</td><td >4</td><td >强力投掷的强化版伤害提高到115%</td></tr>
<tr><td>8</td><td>66</td><td>攻击力+20</td><td>-</td><td>回旋镖装备时攻击力+20</td></tr>
<tr><td >9</td><td >82</td><td>疾风掷</td><td >8</td><td >敌全体造成光属性伤害约70</td></tr>
<tr><td >10</td><td >100</td><td>千斤掷</td><td >16</td><td >敌单体造成雷属性伤害约165</td></tr>";
echo "</table><br><br>";
echo "<table width=100% >";
echo "<tr><th colspan=5>格斗技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td>1</td><td>4</td><td>攻击力+5</td><td>-</td><td>不装备武器时攻击力+5&nbsp;</td></tr>
<tr><td >2</td><td >11</td><td>高级防御</td><td >0</td><td >受到的伤害变成10%</td></tr>
<tr><td >3</td><td >17</td><td>初级滚石术</td><td >0</td><td >敌一组石子攻击伤害约20</td></tr>
<tr><td >4</td><td >24</td><td>正拳突击</td><td >2</td><td >以150%的伤害对敌单体攻击,蓄气无效</td></tr>
<tr><td>5</td><td>33</td><td>攻击力+20</td><td>-</td><td>不装备武器时攻击力+20&nbsp;</td></tr>
<tr><td >6</td><td >42</td><td>真空波</td><td >2</td><td >敌全体造成真空属性伤害,等级越高伤害越大</td></tr>
<tr><td>7</td><td>52</td><td>会心率上升</td><td>-</td><td>不装备武器时会心率上升</td></tr>
<tr><td >8</td><td >70</td><td>爆裂拳</td><td >0</td><td >以50%的伤害对敌做出4次攻击，目标随机</td></tr>
<tr><td >9</td><td >82</td><td>中级滚石术</td><td >4</td><td >敌全体大石头攻击伤害约100</td></tr>
<tr><td>10</td><td>100</td><td>攻击力+50</td><td>-</td><td>不装备武器时攻击力+50</td></tr>";
echo "</table><br><br>";
echo "<table width=100% >";
echo "<tr><th colspan=5>勇气技能</th></tr>";
echo "<tr><th width=10%>等级</th><th width=10%>所需sp</th><th width=30%>技能名称</th><th width=10%>消耗MP</th><th width=40%>作用</th></tr>";
echo "<tr><td >1</td><td >8</td><td>鲁拉</td><td >1</td><td >瞬间回到去过的城镇等地</td></tr>
<tr><td >2</td><td >16</td><td>基阿里克</td><td >2</td><td >我方全体睡眠，麻痹状态回复</td></tr>
<tr><td >3</td><td >28</td><td>托黑洛斯</td><td >4</td><td >在一定路程内不会遇到比自己弱的敌人</td></tr>
<tr><td >4</td><td >40</td><td>玛霍托恩</td><td >3</td><td >敌一组魔法封印</td></tr>
<tr><td >5</td><td >48</td><td>拉伊迪恩</td><td >6</td><td >敌全体雷攻击中等伤害</td></tr>
<tr><td>6</td><td>56</td><td>消费MP3/4</td><td>-</td><td>使用任何魔法、特技只需正常MP的3/4，遇小数上升1</td></tr>
<tr><td>7</td><td>70</td><td>美加恩特</td><td>1</td><td>自己和敌人同归于尽，有可能失败，BOSS无效</td></tr>
<tr><td >8</td><td >82</td><td>贝霍玛鲁</td><td >36</td><td >我方全体HP全回复</td></tr>
<tr><td>9</td><td>90</td><td>消费MP1/2</td><td>-</td><td>使用任何魔法、特技只需正常MP的1/2</td></tr>
<tr><td rowspan='2'>10</td><td rowspan='2'>100</td><td>基加迪恩</td><td>15</td><td>敌一组雷攻击大伤害</td></tr>
<tr><td>千兆能量斩</td><td>20</td><td>对敌一组攻击的究级剑技伤害约165</td></tr>";
echo "</table><br><br>";
echo "<br><br><br><br>";
echo "</center></div>";
?>
