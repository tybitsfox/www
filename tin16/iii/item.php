<?php
echo "<html><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
echo "</head><body>";
 echo "<style type='text/css'>
#liu table{
	background-color:#eeeeee; border: 1px #cccccc solid; text-align: center; border-collapse: collapse; width: 600px; font-size:12px;
}
#liu td{
	border: 1px #cccccc solid; border-collapse: collapse; width: 50px;
}
#liu th{
	border: 1px #cccccc solid; border-collapse: collapse; width: 202px; font-weight:200;
}
#liu h2{text-align:center; color:#FF0000;}</style>
<div id='liu' align='center'>
<h2>消耗道具</h2>
<table>
    <tbody>
        <tr style='COLOR: #ffffff; BACKGROUND-COLOR: #555555'>
            <th>名称</th>
            <td>买价</td>
            <td>卖价</td>
            <th>作用</th>
            <td>代码</td>
        </tr>
        <tr>
            <th>
            Herb<br />
            药草</th>
            <td>8</td>
            <td>4</td>
            <th>恢复HP25~35</th>
            <td>0E9</td>
        </tr>
        <tr>
            <th>
            AmitSnack<br />
            阿米特馒头</th>
            <td>-</td>
            <td>-</td>
            <th>我方一人HP回复</th>
            <td>13E</td>
        </tr>
        <tr>
            <th>
            AmitDonut<br />
            阿米特煎饼</th>
            <td>-</td>
            <td>-</td>
            <th>我方一人HP回复</th>
            <td>13F</td>
        </tr>
        <tr>
            <th>
            Antidote<br />
            解毒草</th>
            <td>10</td>
            <td>5</td>
            <th>解毒</th>
            <td>0EA</td>
        </tr>
        <tr>
            <th>
            Warpwing<br />
            基美拉之翼</th>
            <td>24</td>
            <td>12</td>
            <th>回到曾经去过的村镇 </th>
            <td>0EC</td>
        </tr>
        <tr>
            <th>
            Repellent<br />
            圣水</th>
            <td>20</td>
            <td>10</td>
            <th>一段时间内弱小怪物不出现</th>
            <td>0EB</td>
        </tr>
        <tr>
            <th>
            MoonHerb <br />
            满月草</th>
            <td>30</td>
            <td>15</td>
            <th>解麻痹</th>
            <td>0EF</td>
        </tr>
        <tr>
            <th>
            Potion<br />
            魔法圣水</th>
            <td>200</td>
            <td>100</td>
            <th>恢复MP15~30</th>
            <td>0F0</td>
        </tr>
        <tr>
            <th>
            Worldleaf<br />
            世界树之叶</th>
            <td>-</td>
            <td>-</td>
            <th>单体复活</th>
            <td>0ED</td>
        </tr>
        <tr>
            <th>
            WorldDew<br />
            世界树之露</th>
            <td>1000</td>
            <td>-</td>
            <th>全体HP完全恢复</th>
            <td>0EE</td>
        </tr>
        <tr>
            <th>
            TimeSand<br />
            时之砂</th>
            <td>-</td>
            <td>-</td>
            <th>返回到上次的战斗状态</th>
            <td>0F1</td>
        </tr>
        <tr>
            <th>
            SageStone<br />
            贤者之石</th>
            <td>-</td>
            <td>-</td>
            <th>全体HP部分恢复</th>
            <td>0F2</td>
        </tr>
        <tr>
            <th>
            LifeRock<br />
            生命之石</th>
            <td>800</td>
            <td>400</td>
            <th>持有者中死亡咒语时，石头会代替死亡</th>
            <td>0F3</td>
        </tr>
        <tr>
            <th>
            STRseed<br />
            力量种子</th>
            <td>-</td>
            <td>15</td>
            <th>永久增加力量1-2</th>
            <td>0F4</td>
        </tr>
        <tr>
            <th>
            AGLseed<br />
            速度种子</th>
            <td>-</td>
            <td>12</td>
            <th>永久增加速度1-2</th>
            <td>0F5</td>
        </tr>
        <tr>
            <th>
            INTseed<br />
            智慧种子</th>
            <td>-</td>
            <td>10</td>
            <th>永久增加智慧1-3</th>
            <td>0F6</td>
        </tr>
        <tr>
            <th>
            DEFseed<br />
            防御之种</th>
            <td>-</td>
            <td>15</td>
            <th>永久增加防御力1-2</th>
            <td>0F7</td>
        </tr>
        <tr>
            <th>
            LifeAcorn<br />
            生命树果</th>
            <td>-</td>
            <td>17</td>
            <th>最大HP上升3-4</th>
            <td>0F8</td>
        </tr>
        <tr>
            <th>
            MysticNut<br />
            奇妙树果</th>
            <td>-</td>
            <td>20</td>
            <th>最大MP上升3-5</th>
            <td>0F9</td>
        </tr>
        <tr>
            <th>
            GraceHerb<br />
            美丽草</th>
            <td>50</td>
            <td>25</td>
            <th>永久增加魅力1</th>
            <td>0FA</td>
        </tr>
        <tr>
            <th>
            Spideweb<br />
            斑蜘蛛丝</th>
            <td>34</td>
            <td>17</td>
            <th>减慢一个敌人的速度</th>
            <td>0FB</td>
        </tr>
        <tr>
            <th>
            BugPowder<br />
            毒蛾粉</th>
            <td>310</td>
            <td>155</td>
            <th>使敌混乱</th>
            <td>0FC</td>
        </tr>
        <tr>
            <th>
            Beefsteak<br />
            怪兽诱饵</th>
            <td>-</td>
            <td>-</td>
            <th>可以驯服怪物(成功几率低)</th>
            <td>17F</td>
        </tr>
        <tr>
            <th>
            Rib<br />
            带骨头肉</th>
            <td>694</td>
            <td>347</td>
            <th>可以驯服怪物(成功几率一般)</th>
            <td>180</td>
        </tr>
        <tr>
            <th>
            Fillet<br />
            高级里脊肉</th>
            <td>-</td>
            <td>4533</td>
            <th>可以驯服怪物(成功几率高)</th>
            <td>181</td>
        </tr>
        <tr>
            <th>
            Dung<br />
            马粪</th>
            <td>-</td>
            <td>1</td>
            <th>马粪？</th>
            <td>129</td>
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
