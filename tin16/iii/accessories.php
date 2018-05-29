<?php
echo "<html><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
echo "</head><body>";
echo "<style type='text/css'>
#liu table{border:1px black solid; width:560px; border-collapse:collapse; font-size:12px; text-align:center; background-color:#E7E4E3;}
.td1{border:1px black solid; width:100px;}
.td2{border:1px black solid; width:70px;}
.td3{border:1px black solid; width:173px;}
.STYLE1 {color: #FF0000}
.STYLE2 {border: 1px black solid; width: 100px; color: #FF0000; }
#liu h2{text-align:center; color:#FF0000;}</style>
<div id='liu' align='center'>
<h2>饰品一览</h2>
<table>
    <tbody>
        <tr>
            <td class='td1'>
            <p>名称</p>
            </td>
            <td class='td2'>防御力/魅力</td>
            <td class='td2'>买价/卖价</td>
            <td class='td2'>可装备者</td>
            <td class='td3'>特殊效果</td>
            <td class='td2'>代码</td>
        </tr>
        <tr>
            <td class='td1'>
            AGL Scarf<br />
            疾风头巾</td>
            <td class='td2'>--/10</td>
            <td class='td2'>--/485</td>
            <td class='td2'>ALL</td>
            <td class='td3'>速度+30</td>
            <td class='td2'>0DE</td>
        </tr>
        <tr>
            <td class='td1'>
            AquaCharm<br />
            水之首饰</td>
            <td class='td2'>30/20</td>
            <td class='td2'>--/--</td>
            <td class='td2'>ALL</td>
            <td class='td3'>战斗中使用效果等于Tsunami(敌全体，水系伤害30-40)</td>
            <td class='td2'>0E7</td>
        </tr>
        <tr>
            <td class='td1'>
            Bow Tie<br />
            蝶形领结</td>
            <td class='td2'>2/15</td>
            <td class='td2'>2400/1200</td>
            <td class='td2'>主 基 加 美 </td>
            <td class='td3'>--</td>
            <td class='td2'>0D5</td>
        </tr>
        <tr>
            <td class='td1'>
            BunnyTail<br />
            兔尾巴</td>
            <td class='td2'>--/2</td>
            <td class='td2'>270/135</td>
            <td class='td2'>ALL</td>
            <td class='td3'>--</td>
            <td class='td2'>0DD</td>
        </tr>
        <tr>
            <td class='td1'>
            Farewell Bracelet<br />
            复活手镯</td>
            <td class='td2'>10/15</td>
            <td class='td2'>--/2500</td>
            <td class='td2'>玛 基 加 美 爱 </td>
            <td class='td3'>装备角色在战斗中死亡后发动Farewell(己全体复活),随后消失</td>
            <td class='td2'>0CF</td>
        </tr>
        <tr>
            <td class='td1'>
            FlameCharm<br />
            炎之首饰</td>
            <td class='td2'>--/10</td>
            <td class='td2'>--/--</td>
            <td class='td2'>ALL</td>
            <td class='td3'>攻击力+25,战斗中使用效果等于Blazemore</td>
            <td class='td2'>0E4</td>
        </tr>
        <tr>
            <td class='td1'>
            Garter<br />
            吊袜带</td>
            <td class='td2'>--/15</td>
            <td class='td2'>3300/1650</td>
            <td class='td2'>玛 爱 </td>
            <td class='td3'>攻击力+3</td>
            <td class='td2'>0DF</td>
        </tr>
        <tr>
            <td class='td1'>
            GlassShoe<br />
            玻璃鞋</td>
            <td class='td2'>--/30</td>
            <td class='td2'>--/400</td>
            <td class='td2'>玛 爱 </td>
            <td class='td3'>--</td>
            <td class='td2'>0D1</td>
        </tr>
        <tr>
            <td class='td1'>
            Goddess Ring<br />
            女神戒指</td>
            <td class='td2'>--/40</td>
            <td class='td2'>--/8500</td>
            <td class='td2'>玛 美 爱 </td>
            <td class='td3'>走路恢复MP,智力+33</td>
            <td class='td2'>0D9</td>
        </tr>
        <tr>
            <td class='td1'>
            Golden Bracelet<br />
            金手镯</td>
            <td class='td2'>5/15</td>
            <td class='td2'>2000/1000</td>
            <td class='td2'>主 玛 基 美 爱 </td>
            <td class='td3'>--</td>
            <td class='td2'>0D2</td>
        </tr>
        <tr>
            <td class='td1'>
            Gospel Ring<br />
            真理之戒</td>
            <td class='td2'>50/30</td>
            <td class='td2'>--/--</td>
            <td class='td2'>ALL</td>
            <td class='td3'>不遇敌</td>
            <td class='td2'>0E8</td>
        </tr>
        <tr>
            <td class='td1'>
            GuardRuby<br />
            守护红宝石</td>
            <td class='td2'>10/5</td>
            <td class='td2'>3500/1750</td>
            <td class='td2'>ALL</td>
            <td class='td3'>--</td>
            <td class='td2'>0D6</td>
        </tr>
        <tr>
            <td class='td1'>
            INT Specs<br />
            智慧眼镜</td>
            <td class='td2'>--/--</td>
            <td class='td2'>--/850</td>
            <td class='td2'>主 玛 基 美 爱 </td>
            <td class='td3'>智慧+15</td>
            <td class='td2'>0E1</td>
        </tr>
        <tr>
            <td class='td1'>
            Life Ring<br />
            生命戒指</td>
            <td class='td2'>5/8</td>
            <td class='td2'>--/1200</td>
            <td class='td2'>ALL</td>
            <td class='td3'>走路恢复HP</td>
            <td class='td2'>0DB</td>
        </tr>
        <tr>
            <td class='td1'>
            LuckShoes<br />
            幸运鞋</td>
            <td class='td2'>--/5</td>
            <td class='td2'>--/50</td>
            <td class='td2'>ALL</td>
            <td class='td3'>走路增加经验值</td>
            <td class='td2'>0DA</td>
        </tr>
        <tr>
            <td class='td1'>
            MermMoon<br />
            人鱼之月</td>
            <td class='td2'>--/5</td>
            <td class='td2'>--/--</td>
            <td class='td2'>ALL</td>
            <td class='td3'>战斗中使用可治愈混乱</td>
            <td class='td2'>0E3</td>
        </tr>
        <tr>
            <td class='td1'>
            Pink Pearl<br />
            粉色珍珠</td>
            <td class='td2'>--/7</td>
            <td class='td2'>1500/750</td>
            <td class='td2'>玛 爱 </td>
            <td class='td3'>--</td>
            <td class='td2'>0D3</td>
        </tr>
        <tr>
            <td class='td1'>
            Sacrifice Bracelet<br />
            牺牲手镯</td>
            <td class='td2'>10/7</td>
            <td class='td2'>--/5000</td>
            <td class='td2'>ALL</td>
            <td class='td3'>装备角色在战斗中死亡后发动Sacrifice(敌全体即死),随后消失</td>
            <td class='td2'>0CE</td>
        </tr>
        <tr>
            <td class='td1'>
            Scarf<br />
            头巾</td>
            <td class='td2'>--/17</td>
            <td class='td2'>--/250</td>
            <td class='td2'>ALL</td>
            <td class='td3'>防御力+5</td>
            <td class='td2'>0D7</td>
        </tr>
        <tr>
            <td class='td1'>
            Slime Earrings<br />
            史莱姆耳环</td>
            <td class='td2'>--/8</td>
            <td class='td2'>850/425</td>
            <td class='td2'>ALL</td>
            <td class='td3'>攻击力+1</td>
            <td class='td2'>0D0</td>
        </tr>
        <tr>
            <td class='td1'>
            Spectacle<br />
            眼镜</td>
            <td class='td2'>--/--</td>
            <td class='td2'>--/--</td>
            <td class='td2'>主 玛 基 美 爱 </td>
            <td class='td3'>--</td>
            <td class='td2'>0E2</td>
        </tr>
        <tr>
            <td class='td1'>
            Speed Ring<br />
            速度戒指</td>
            <td class='td2'>--/15</td>
            <td class='td2'>3100/1550</td>
            <td class='td2'>ALL</td>
            <td class='td3'>速度+15</td>
            <td class='td2'>0CC</td>
        </tr>
        <tr>
            <td class='td1'>
            Star Ort<br />
            星之碎片</td>
            <td class='td2'>--10</td>
            <td class='td2'>500/250</td>
            <td class='td2'>玛 爱 </td>
            <td class='td3'>战斗中使用可使敌人混乱</td>
            <td class='td2'>0CD</td>
        </tr>
        <tr>
            <td class='td1'>
            Starry Bracelet<br />
            星光手镯</td>
            <td class='td2'>--/5</td>
            <td class='td2'>--/--</td>
            <td class='td2'>ALL</td>
            <td class='td3'>装备者速度*2</td>
            <td class='td2'>0CB</td>
        </tr>
        <tr>
            <td class='td1'>
            STR Ring<br />
            力量戒指</td>
            <td class='td2'>--/3</td>
            <td class='td2'>--/1250</td>
            <td class='td2'>ALL</td>
            <td class='td3'>攻击力+7</td>
            <td class='td2'>0DC</td>
        </tr>
        <tr>
            <td class='td1'>
            TerraCharm<br />
            大地首饰</td>
            <td class='td2'>20/10</td>
            <td class='td2'>--/--</td>
            <td class='td2'>ALL</td>
            <td class='td3'>战斗中使用引起地震</td>
            <td class='td2'>0E5</td>
        </tr>
        <tr>
            <td class='td1'>
            Tights<br />
            蕾丝紧身衣</td>
            <td class='td2'>5/10</td>
            <td class='td2'>2200/1100</td>
            <td class='td2'>玛 爱 </td>
            <td class='td3'>--</td>
            <td class='td2'>0D4</td>
        </tr>
        <tr>
            <td class='td1'>
            Valiant Bracelet<br />
            豪杰手镯</td>
            <td class='td2'>--/10</td>
            <td class='td2'>--/2250</td>
            <td class='td2'>主 基 加 美 爱 </td>
            <td class='td3'>攻击力+15</td>
            <td class='td2'>0E0</td>
        </tr>
        <tr>
            <td class='td1'>
            WindCharm<br />
            风之首饰</td>
            <td class='td2'>--/15</td>
            <td class='td2'>--/--</td>
            <td class='td2'>ALL</td>
            <td class='td3'>速度+50,战斗中使用效果等于Infermore</td>
            <td class='td2'>0E6</td>
        </tr>
        <tr>
            <td class='td1'>
            Wizard Ring<br />
            祈祷戒指</td>
            <td class='td2'>5/3</td>
            <td class='td2'>3000/1500</td>
            <td class='td2'>ALL</td>
            <td class='td3'>使用约恢复20MP</td>
            <td class='td2'>0D8</td>
        </tr>
    </tbody>
</table>
</div>";
echo "</body></html>";
?>

<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
