<?php
echo "<html><head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<link href='./main.css' rel='stylesheet' type='text/css' />";
echo "<style type='text/css'>
body{ text-align:left} 
#divcenter{margin:0 auto;width:800px}</style>
</head><body><div id='divcenter'>";
echo "
<p>DQ9技能&mdash;&mdash;宝物/Acquisitiveness</p>
<p>自带此技能职业：<font color=blue>盗贼</font></p>
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
            <td>熟练+20</td>
            <td>
            宝物爱好者</td>
            <td>-</td>
            <td>器用度数值+20</td>
        </tr>
        <tr>
            <td>2</td>
            <td>10</td>
            <td>
            偷盗</td>
            <td>
            宝物收集者</td>
            <td>0</td>
            <td>一定几率获得敌单体所掉落道具，一场战斗同个敌人只能偷到一个，可偷到稀有掉落道具，几率随着器用度和LV而定</td>
        </tr>
        <tr>
            <td>3</td>
            <td>16</td>
            <td>速度+20</td>
            <td>
            鉴定师</td>
            <td>-</td>
            <td>速度数值+20</td>
        </tr>
        <tr>
            <td>4</td>
            <td>22</td>
            <td>
            陷阱</td>
            <td>
            财宝猎人</td>
            <td>0</td>
            <td>挖一个能让自己或者怪物和同伴掉进去的陷阱，会让其短时间内无法动弹，宝图迷宫中无法使用</td>
        </tr>
        <tr>
            <td>5</td>
            <td>32</td>
            <td>HP+20</td>
            <td>
            道具大师</td>
            <td>-</td>
            <td>最大HP数值+20</td>
        </tr>
        <tr>
            <td>6</td>
            <td>42</td>
            <td>
            盗贼之鼻</td>
            <td>
            稀物猎人</td>
            <td>0</td>
            <td>查看当层的红色宝箱内的宝物数以及未取得的宝物数量，大地图以及宝图迷宫中使用无效</td>
        </tr>
        <tr>
            <td>7</td>
            <td>55</td>
            <td>熟练度+40</td>
            <td>
            收集明星</td>
            <td>-</td>
            <td>器用度数值+40</td>
        </tr>
        <tr>
            <td>8</td>
            <td>68</td>
            <td>
            识破</td>
            <td>
            宝物师傅</td>
            <td>0</td>
            <td>将敌单体详细资料记录在怪物图鉴上，开启图鉴第二页内容，必须将其打败并取得战斗胜利</td>
        </tr>
        <tr>
            <td>9</td>
            <td>82</td>
            <td>速度+40</td>
            <td>
            财宝之王</td>
            <td>-</td>
            <td>速度数值+40</td>
        </tr>
        <tr>
            <td>10</td>
            <td>100</td>
            <td>
            寻宝</td>
            <td>
            神之手</td>
            <td>2</td>
            <td>查看当前区域内红色宝箱的所在地，以闪光点的形式在上画面表示；（宝图迷宫中）将该层楼梯所在位置显示在上画面</td>
        </tr>
        <tr>
            <td>-</td>
            <td>-</td>
            <td>
            自动偷盗</td>
            <td>-</td>
            <td>－</td>
            <td>战斗后一定几率获得敌人携带道具，几率随着等级而定</td>
        </tr>
    </tbody>
</table>
</div>
<p>女性主角所能够获得不同的称号：9级时为财宝女王。</p>
<p>评价：以往的DQ作品中只能盼望着怪物&ldquo;好心&rdquo;掉宝，这次由盗贼带来的技能终于让人心情舒畅了，不用说，偷盗技能的存在就已经决定了这个技能是人就要学，四人一起偷比掉宝要好太多了，另外还有提高偷盗成功率的装饰品！虽说只有一个&hellip;&hellip;另外，盗贼之鼻和识破以及寻宝这三个技能至少要有一个人学会，能够省很多事的。秘传技能自动偷盗和DQ3、DQ6、DQ7中的偷盗模式是一个样的，战斗结束后判定是否得到道具&mdash;&mdash;战斗中偷盗成功、战斗结束后偷盗成功、战斗结束后怪物掉宝，这意味着一场战斗中能够在同一个怪物身上最多得到三个道具&hellip;&hellip;</p><!--专题内容结束--></div>";
echo "</div></body></html>";
?>
<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
