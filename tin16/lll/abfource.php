<?php
echo "<html><head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<link href='./main.css' rel='stylesheet' type='text/css' />";
echo "<style type='text/css'>
body{ text-align:left} 
#divcenter{margin:0 auto;width:800px}</style>
</head><body><div id='divcenter'>";
echo "
<p>DQ9技能&mdash;&mdash;元素之力/Fource</p>
<p>自带此技能职业：<font color=blue>魔法战士</font></p>
<style type='text/css'>
#liu table{width:100%; border:1px black solid; border-collapse:collapse; text-align:center;}
#liu td,th{border:1px black solid;}</style>
<div id='liu' align='center'>
<table>
    <tbody>
        <tr bgcolor='#bbad88'>
            <th width='5%'>等级</th>
            <th width='5%'>SP</th>
            <th width='24%'>习得技能</th>
            <th width='15%'>称号</th>
            <th width='6%'>消耗MP</th>
            <th width='45%'>作用</th>
        </tr>
        <tr>
            <td>1</td>
            <td>4</td>
            <td>
            火之力</td>
            <td>
            炎之力战士</td>
            <td>4</td>
            <td>我方单体攻击附带炎属性，对炎系攻击及咒文抵抗力加强50%</td>
        </tr>
        <tr>
            <td>2</td>
            <td>10</td>
            <td>力量+10</td>
            <td>
            神圣之力战士</td>
            <td>-</td>
            <td>力量数值+10</td>
        </tr>
        <tr>
            <td>3</td>
            <td>16</td>
            <td>
            冰之力</td>
            <td>
            冰之力战士</td>
            <td>4</td>
            <td>我方单体攻击附带冰属性，对冰系攻击及咒文抵抗力加强50%</td>
        </tr>
        <tr>
            <td>4</td>
            <td>22</td>
            <td>防御+20</td>
            <td>
            高贵之力战士</td>
            <td>-</td>
            <td>防御力数值+20</td>
        </tr>
        <tr>
            <td>5</td>
            <td>32</td>
            <td>
            风之力</td>
            <td>
            暴风之力战士</td>
            <td>4</td>
            <td>我方单体攻击附带风、雷属性，对风、雷系攻击及咒文抵抗力加强50%</td>
        </tr>
        <tr>
            <td>6</td>
            <td>42</td>
            <td>魅力+10</td>
            <td>
            正义之力战士</td>
            <td>-</td>
            <td>魅力数值+10</td>
        </tr>
        <tr>
            <td>7</td>
            <td>55</td>
            <td>
            暗之力</td>
            <td>
            暗之力战士</td>
            <td>4</td>
            <td>我方单体攻击附带土、暗属性，对土、暗系攻击及咒文抵抗力加强50%</td>
        </tr>
        <tr>
            <td>8</td>
            <td>68</td>
            <td>攻击魔力+30</td>
            <td>
            群星之力战士</td>
            <td>-</td>
            <td>攻击魔力数值+30</td>
        </tr>
        <tr>
            <td>9</td>
            <td>82</td>
            <td>
            光之力</td>
            <td>
            光之力战士</td>
            <td>4</td>
            <td>我方单体攻击附带光属性，对光系攻击抵抗力加强50%</td>
        </tr>
        <tr>
            <td>10</td>
            <td>100</td>
            <td>HP+30</td>
            <td>
            银河之力战士</td>
            <td>-</td>
            <td>最大HP数值+30</td>
        </tr>
        <tr>
            <td>-</td>
            <td>-</td>
            <td>
            力量大师</td>
            <td>-</td>
            <td>-</td>
            <td>元素之力的属性技能全体化</td>
        </tr>
    </tbody>
</table>
</div>
<p>评价：本作中任何一个怪物都有弱点属性，连魔王们都不例外&mdash;&mdash;除了金属史莱姆系怪物。这么一来，元素之力的属性附加就很有用了，想要提升伤害的话，附加怪物的弱点属性能够收到很好的效果，有的怪物弱点属性甚至能够达到伤害2倍的效果。因此队伍里至少要有一个人能够精通元素之力技能，为BOSS战中提升伤害带来帮助。元素之力除了能针对敌人的弱点提升伤害外，还能够降低相应属性的伤害，这种效果可以和防御咒文的效果叠加，可谓是攻防一体的辅助技能（具体说明参见防具部分说明）。在得到了秘传书之后，元素之力的作用对象就成了我方全体，大大提升了效率。另外，元素之力重复使用的话，后面使用的会覆盖掉前面的，这么一来，对全体使用A元素强化防御，再对主攻手使用BOSS的弱点元素进行攻击的战术可以实施，非常方便。</p>
<p>PS：属性的优先顺序为技能属性＞元素之力附加属性＞武器附带属性。但有一种情况例外，就是当武器属性对敌人有利时，即使附加了不利的元素属性，还是以有利的武器属性进行攻击。</p>
<p>PS2：使用风之力和暗之力时，会自动在两种属性中切换到敌人较弱的属性。比如光龙グレイナル怕暗而不怕土，而使用暗之力时，我方攻击时就是发动暗属性，而不是土属性。</p>
<p>PS3：元素属性的持续时间为6~9回合，附加之后伤害会加强到110%。</p></div>";
echo "</div></body></html>";
?>
<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
