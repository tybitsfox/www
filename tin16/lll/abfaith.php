<?php
echo "<html><head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<link href='./main.css' rel='stylesheet' type='text/css' />";
echo "<style type='text/css'>
body{ text-align:left} 
#divcenter{margin:0 auto;width:800px}</style>
</head><body><div id='divcenter'>";
echo "
<p>DQ9技能&mdash;&mdash;信仰之心/Faith</p>
<p>自带此技能职业：<font color=blue>僧侶</font></p>
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
            <td>8</td>
            <td>
            神之祷告</td>
            <td>
            入信者</td>
            <td>0</td>
            <td>知道我方全员到达下一级还需要的EXP</td>
        </tr>
        <tr>
            <td>2</td>
            <td>16</td>
            <td>魔力恢复+20</td>
            <td>
            修行僧</td>
            <td>-</td>
            <td>恢复魔力数值+20</td>
        </tr>
        <tr>
            <td>3</td>
            <td>28</td>
            <td>
            破邪</td>
            <td>
            流离的僧侣</td>
            <td>2</td>
            <td>解除我方一人诅咒，诅咒装备品不会消失</td>
        </tr>
        <tr>
            <td>4</td>
            <td>40</td>
            <td>MP+20</td>
            <td>
            镇上的神父</td>
            <td>-</td>
            <td>最大MP数值+10</td>
        </tr>
        <tr>
            <td>5</td>
            <td>48</td>
            <td>
            僵尸守护</td>
            <td>
            司祭</td>
            <td>4</td>
            <td>5~8回合内僵尸系的攻击对我方全员伤害半减</td>
        </tr>
        <tr>
            <td>6</td>
            <td>56</td>
            <td>魔力恢复+60</td>
            <td>
            高级司祭</td>
            <td>-</td>
            <td>恢复魔力数值+60</td>
        </tr>
        <tr>
            <td>7</td>
            <td>70</td>
            <td>
            圣女之守护</td>
            <td>
            司教</td>
            <td>3</td>
            <td>7~10回合内自己中了一次即死咒文后HP残留1</td>
        </tr>
        <tr>
            <td>8</td>
            <td>80</td>
            <td>MP+20</td>
            <td>
            大司教</td>
            <td>-</td>
            <td>最大MP数值+20</td>
        </tr>
        <tr>
            <td>9</td>
            <td>90</td>
            <td>
            神圣的祈祷</td>
            <td>
            法王</td>
            <td>2</td>
            <td>6~9回合内自己的回复魔力上升2级</td>
        </tr>
        <tr>
            <td>10</td>
            <td>100</td>
            <td>魔力恢复+100</td>
            <td>
            圣者</td>
            <td>-</td>
            <td>恢复魔力数值+100</td>
        </tr>
        <tr>
            <td>-</td>
            <td>-</td>
            <td>
            光之波动</td>
            <td>-</td>
            <td>10</td>
            <td>我方全体异常状态全恢复</td>
        </tr>
    </tbody>
</table>
</div>
<p>女性主角所能够获得不同的称号：4级时为镇上的修女、10级时为圣女。<br />
美版中女性主角能够获得不同的称号：2级时为Postulant、3级时为Votary、4级时为Nun of the Parish、5级时为Missionary、6级时为Abbess、7级时为Prioress、8级时为Mother Superior、9级时为Beatificant</p>
<p>评价：方便的技能只有神之祷告和破邪。其它的也就僵尸守护有点用处，不过僵尸系的BOSS没几个。本作中恢复魔力数值和HP回复量的比例不高，导致了没有必要将恢复魔力提的非常高，不过话说回来，700以上的恢复魔力的话，最低级的恢复咒文也能恢复上百的HP的。虽然本作中不少物理职业的MP都低的让人瞠目结舌，但是贤者的技能可以加最大MP60，是僧侣的技能的两倍&hellip;&hellip;总而言之，不是恢复人员就没必要学这个技能了。最大的亮点非秘传技能&ldquo;光之波动&rdquo;莫属了，DQM系列究极的回复技能终于在正统作品中也能够使用了！不过只需要带上秘传书就能使用，和学不学信仰之心技能无直接关系&hellip;&hellip;</p></div>";
echo "</div></body></html>";
?>
<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
