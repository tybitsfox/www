<?php
echo "<html><head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<link href='./main.css' rel='stylesheet' type='text/css' />";
echo "<style type='text/css'>
body{ text-align:left} 
#divcenter{margin:0 auto;width:800px}</style>
</head><body><div id='divcenter'>";
echo "
<p>DQ9技能&mdash;&mdash;悟道/Enlightenment</p>
<p>自带此技能职业：<font color=blue>贤者</font></p>
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
            <td>回复魔力+20</td>
            <td>
            领悟心的人</td>
            <td>-</td>
            <td>回复魔力数值+20</td>
        </tr>
        <tr>
            <td>2</td>
            <td>10</td>
            <td>
            达玛之悟</td>
            <td>
            领悟爱的人</td>
            <td>3</td>
            <td>可随时随地转职</td>
        </tr>
        <tr>
            <td>3</td>
            <td>16</td>
            <td>攻击魔力+20</td>
            <td>
            领悟人的人</td>
            <td>-</td>
            <td>攻击魔力数值+20</td>
        </tr>
        <tr>
            <td>4</td>
            <td>22</td>
            <td>
            治疗之雨</td>
            <td>
            领悟世界的人</td>
            <td>6</td>
            <td>我方全体7~10回合内回合结束时HP恢复LV的一半</td>
        </tr>
        <tr>
            <td>5</td>
            <td>32</td>
            <td>回复魔力+40</td>
            <td>
            领悟自然的人</td>
            <td>-</td>
            <td>回复魔力数值+40</td>
        </tr>
        <tr>
            <td>6</td>
            <td>42</td>
            <td>
            冻结波动</td>
            <td>
            领悟奇迹的人</td>
            <td>10</td>
            <td>敌全体附加的状态变化打消</td>
        </tr>
        <tr>
            <td>7</td>
            <td>55</td>
            <td>攻击魔力+40</td>
            <td>
            领悟光的人</td>
            <td>-</td>
            <td>攻击魔力数值+40</td>
        </tr>
        <tr>
            <td>8</td>
            <td>68</td>
            <td>
            神秘之悟</td>
            <td>
            领悟真理的人</td>
            <td>8</td>
            <td>6~9回合内使用者攻击魔力、回复魔力上升1级</td>
        </tr>
        <tr>
            <td>9</td>
            <td>82</td>
            <td>MP+60</td>
            <td>
            领悟神秘的人</td>
            <td>-</td>
            <td>最大MP数值+60</td>
        </tr>
        <tr>
            <td>10</td>
            <td>100</td>
            <td>MP消耗减25%</td>
            <td>
            大彻大悟的人</td>
            <td>-</td>
            <td>使用咒文、特技消耗MP减少25%</td>
        </tr>
        <tr>
            <td>-</td>
            <td>-</td>
            <td>
            回音之悟</td>
            <td>-</td>
            <td>10</td>
            <td>我方单体6~9回合内咒文变成2次</td>
        </tr>
    </tbody>
</table>
</div>
<p>评价：必学技能，MP消耗降低25%的诱惑力非常大（可惜没有DQ8中MP消耗减半的能力），外加上最大MP+60，都是物理职业的救星，对魔法职业来说就是锦上添花了。冻结波动是个很好用的技能，不过要小心打消敌人的有利状态时也会将敌人的不利状态打消。治疗之雨的HP回复效果和神秘铠甲等装备品的HP回复效果可以重叠。而神秘之悟的实用性就很低了，能够同时使用攻击和回复咒文的仅有旅艺人、超级明星和贤者这三个职业，而也就贤者擅长两种类咒文，因为有着攻击魔力盒回复魔力提升2级的技能存在，这个技能并不怎么讨人喜欢。秘传技能回音之悟在使用了之后，再用其他咒文时会有两次效果，MP消耗还只是一次的分量，无论是攻击还是恢复都能够派上大用场，但是对マホカンタ、ベホマ、ベホマズン、ザオラル、ザオリク、メガンテ、メガザル、マダンテ这几个咒文无效，要注意此技能附加的状态会被冻结波动打消，尽量用高速角色来使用给魔法角色吧。其实最好用的应该是达玛之悟了，仅仅是因为能够随时转职？当然不止这点了，转职后HP和MP是依照转职前职业的比例来决定的，比如说转前职业当前MP是50，最大MP是200的话，转到最大MP100的职业的时候，当前MP就是25了，可以使用较少的道具回复满MP，或者是装备上走路回复MP的装备，回复了MP然后再转回去即可。</p></div>";
echo "</div></body></html>";
?>
<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
