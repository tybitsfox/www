<?php
echo "<html><head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<link href='./main.css' rel='stylesheet' type='text/css' />";
echo "<style type='text/css'>
body{ text-align:center} 
#divcenter{margin:0 auto;width:800px}</style>
</head><body>";
echo "<style>
#liu table{width:750px; text-align:center; border:1px black solid; border-collapse:collapse;}
#liu th{ border:1px black solid;}
#liu td{ border:1px black solid;}
</style>
<div id='liu'>
<p>装饰品仅在DQM2中出现。</p>
<table align=center>
  <tr>
    <td>中文名</td>
    <td>价钱</td>
    <td>作用</td>
  </tr>
  <tr>
    <td>体力腰带</td>
    <td>-</td>
    <td>装备怪物的最大HP上升30</td>
  </tr>
  <tr>
    <td>龙之腰带</td>
    <td>-</td>
    <td>装备怪物的最大HP上升80</td>
  </tr>
  <tr>
    <td>魔法腰带</td>
    <td>-</td>
    <td>装备怪物的最大MP上升30</td>
  </tr>
  <tr>
    <td>不可思议腰带</td>
    <td>-</td>
    <td>装备怪物的最大MP上升80</td>
  </tr>
  <tr>
    <td>石之牙</td>
    <td>-</td>
    <td>装备怪物的攻击力上升10</td>
  </tr>
  <tr>
    <td>钢之牙</td>
    <td>-</td>
    <td>装备怪物的攻击力上升50</td>
  </tr>
  <tr>
    <td>龙鳞</td>
    <td>20</td>
    <td>装备怪物的防御力上升5</td>
  </tr>
  <tr>
    <td>美人鱼之鳞</td>
    <td>-</td>
    <td>装备怪物的防御力上升10</td>
  </tr>
  <tr>
    <td>神龙之鳞</td>
    <td>-</td>
    <td>装备怪物的防御力上升50</td>
  </tr>
  <tr>
    <td>疾风腕轮</td>
    <td>-</td>
    <td>装备怪物的速度上升10</td>
  </tr>
  <tr>
    <td>流星手镯</td>
    <td>-</td>
    <td>装备怪物的速度上升50</td>
  </tr>
  <tr>
    <td>智慧帽子</td>
    <td>-</td>
    <td>装备怪物的智慧上升50</td>
  </tr>
  <tr>
    <td>知识帽子</td>
    <td>-</td>
    <td>装备怪物的智慧上升100</td>
  </tr>
  <tr>
    <td>魔法披风</td>
    <td>-</td>
    <td>装备后攻击咒文的伤害减少</td>
  </tr>
  <tr>
    <td>龙之斗篷</td>
    <td>-</td>
    <td>装备后炎、雪的伤害减少</td>
  </tr>
  <tr>
    <td>银制披风</td>
    <td>-</td>
    <td>装备后加强对眠、毒、混的抗性</td>
  </tr>
  <tr>
    <td>金制披风</td>
    <td>-</td>
    <td>装备后加强对眠、诅咒、麻的抗性</td>
  </tr>
  <tr>
    <td>白金披风</td>
    <td>-</td>
    <td>装备后加强对死、诅咒、麻的抗性</td>
  </tr>
  <tr>
    <td>海豚斗篷</td>
    <td>-</td>
    <td>装备后水的伤害减少</td>
  </tr>
  <tr>
    <td>生命戒指</td>
    <td>-</td>
    <td>装备后步行回复HP</td>
  </tr>
  <tr>
    <td>女神戒指</td>
    <td>-</td>
    <td>装备后步行回复MP</td>
  </tr>
  <tr>
    <td>武道家戒指</td>
    <td>-</td>
    <td>升级时升级时攻击力的成长增加</td>
  </tr>
  <tr>
    <td>水手戒指</td>
    <td>-</td>
    <td>升级时防御力的成长增加</td>
  </tr>
  <tr>
    <td>僧侣戒指</td>
    <td>-</td>
    <td>升级时智慧的成长增加</td>
  </tr>
  <tr>
    <td>盗贼戒指</td>
    <td>-</td>
    <td>升级时速度的成长增加</td>
  </tr>
  <tr>
    <td>战士戒指</td>
    <td>-</td>
    <td>升级时最大HP的成长增加</td>
  </tr>
  <tr>
    <td>魔导师戒指</td>
    <td>-</td>
    <td>升级时最大MP的成长增加</td>
  </tr>
  <tr>
    <td>早熟戒指</td>
    <td>-</td>
    <td>升级时所有属性成长上升</td>
  </tr>
</table>
</div>";
echo "</body></html>";
?>
<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
