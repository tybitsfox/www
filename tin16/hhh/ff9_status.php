<?php
echo "<html><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
echo "<link href='./ff9.css' rel='stylesheet' type='text/css' media='all'/>";
echo "</head><body>";
echo "<div class='ff9'>
<div class='cell6' align='center'><strong>不良状态</strong></div>
<center>
<table cellspacing='0' cellpadding='0' class='table_center'>
<tbody>
<tr class='cell2'>
<td width=15%>状态名</td>
<td width=5%>图标</td>
<td width=35%>状态效果</td>
<td width=27%>解除方法</td>
<td width=25%>预防措施
</td>
</tr>
<tr>
<td>狂暴</td>
<td><img height='22' alt='' width='27' src='pic/status/berserk.jpg' /></td>
<td align='left'>【狂暴】无法控制中此状态的队员,<br />其将一直对敌使用物理攻击<br />伤害值为平时的1.5倍</td>
<td>
基莎尔蔬菜 |<br />幻化 </td>
<td>恒反射</td>
</tr>
<tr>
<td>混乱</td>
<td><img height='26' alt='' width='27' src='pic/status/confuse.jpg' /></td>
<td align='left'>【混乱】无法进行控制,<br />中此状态后将不分敌友随机进攻<br />物理命中率减半，物理回避率降为0</td>
<td>万能药 | 康复|<br />物理攻击 | 等待</td>
<td>不乱之术</td>
</tr>
<tr>
<td>黑暗</td>
<td><img height='20' alt='' width='27' src='pic/status/darkness.jpg' /></td>
<td align='left'>【黑暗】物理攻击命中率减半<br />物理回避率为0</td>
<td>眼药|<br />万能药|<br />康复 </td>
<td>不盲之术 </td>
</tr>
<tr>
<td>冰冻</td>
<td><img height='21' alt='' width='27' src='pic/status/freeze.jpg' /></td>
<td align='left'>【冰冻】中者无法行动,<br />受到物理攻击会战斗不能<br />物理回避率降为0</td>
<td>康复| <br />受火系魔法攻击 | 等待</td>
<td>恒温 </td>
</tr>
<tr>
<td>灼热</td>
<td><img height='20' alt='' width='27' src='pic/status/heat.jpg' /></td>
<td align='left'>【灼热】中者可以行动,<br />但一旦行动立刻战斗不能</td>
<td>康复|<br />受冰系魔法攻击 | 等待</td>
<td>恒温</td>
</tr>
<tr>
<td>缩小</td>
<td><img height='24' alt='' width='27' src='pic/status/mini.jpg' /></td>
<td align='left'>【缩小】人物变小,魔法剑不能使用，同时魔攻、召唤能力、回复魔法效果减半，物攻倍率变成1，受到物理攻击伤害量为1.5倍</td>
<td>万能药 | <br />康复| <br />
缩小</td>
<td>---</td>
</tr>
<tr>
<td>石化</td>
<td><img height='20' alt='' width='27' src='pic/status/petrify.jpg' /></td>
<td align='left'>【石化】变成石头且无法行动，但同时对物理攻击免疫。战斗结束无法获得EXP和AP。全员石化则GAME OVER</td>
<td>金针|<br />融石 </td>
<td>不凝之术</td>
</tr>
<tr>
<td>徐徐石化</td>
<td><img height='20' alt='' width='27' src='pic/status/petrify.jpg' /></td>
<td align='left'>【徐徐石化】在一定时间内倒计时,记时结束才会石化,计时过程中使用金针有效</td>
<td>金针|<br />融石 |<br />万能药 | <br />康复 </td>
<td>不凝之术</td>
</tr>
<tr>
<td>中毒</td>
<td><img height='26' alt='' width='27' src='pic/status/poison.jpg' /></td>
<td align='left'>【中毒】固定一段时间减少最大HP的1/16</td>
<td>解毒剂|<br />万能药 | <br />解毒 |<br />康复| 等待</td>
<td>试毒之术</td>
</tr>
<tr>
<td>沉默</td>
<td><img height='20' alt='' width='27' src='pic/status/silence.jpg' /></td>
<td align='left'>【沉默】中此状态后无法使用魔法和召唤兽</td>
<td>回声草 |<br />万能药 | <br />康复 </td>
<td>不哑之术 </td>
</tr>
<tr>
<td>睡眠</td>
<td><img height='18' alt='' width='27' src='pic/status/sleep.jpg' /></td>
<td align='left'>【睡眠】进入睡眠状态且无法行动<br />受到伤害值为平时的1.5倍<br />物理回避率降为0</td>
<td>康复| <br />受物理攻击</td>
<td>不眠之术 </td>
</tr>
<tr>
<td>慢速</td>
<td><img height='16' alt='' width='27' src='pic/status/slow.jpg' /></td>
<td align='left'>【慢速】角色的ATB增加速度降低至2/3</td>
<td>驱魔|<br />等待</td>
<td>恒加速</td>
</tr>
<tr>
<td>停止</td>
<td><img height='27' alt='' width='27' src='pic/status/stop.jpg' /></td>
<td align='left'>【停止】人物被定住而无法行动,<br />全员中此状态则GAME OVER</td>
<td>万能药 | <br />驱魔 </td>
<td>不休之术</td>
</tr>
<tr>
<td>累赘</td>
<td><img height='25' alt='' width='27' src='pic/status/trouble.jpg' /></td>
<td align='left'>【累赘】中此状态的角色受到攻击后，其他队员也会受到伤害，伤害值为此人受到的伤害的一半</td>
<td>正名酒 </td>
<td>-</td>
</tr>
<tr>
<td>剧毒</td>
<td><img height='26' alt='' width='27' src='pic/status/poison.jpg' /></td>
<td align='left'>【剧毒】固定一段时间减少HP和MP最大值的1/16，且角色无法行动。<br />物理回避率为0</td>
<td>解毒剂|<br />万能药 | <br /> 解毒</td>
<td>试毒之术</td>
</tr>
<tr>
<td>病毒</td>
<td><img height='24' alt='' width='27' src='pic/status/virus.jpg' /></td>
<td align='left'>【病毒】战斗胜利后无法获得EXP和AP<br />物理回避率为0</td>
<td>疫苗</td>
<td>---</td>
</tr>
<tr>
<td>僵尸</td>
<td><img height='26' alt='' width='27' src='pic/status/zombie.jpg' /></td>
<td align='left'>【僵尸】若对中此状态的人施用恢复药品和魔法反而会给其造成伤害,战斗胜利后不能获得经验值和能力值</td>
<td>神符| <br />装备护身符可以复活</td>
<td>---</td>
</tr>
<tr>
<td>死亡宣告</td>
<td>无图标</td>
<td align='left'>【死亡宣告】中此状态的角色头上出现倒数数字, 倒数结束时该角色会进入无法战斗状态.</td>
<td>---</td>
<td>---</td>
</tr>
</tbody>
</table>
<div class='cell6'><strong>有利状态</strong></div>
<table cellspacing='0' cellpadding='0' class='table_center'>

<tbody>
<tr class='cell2'>
<td width=92>状态名</td>
<td>图标</td>
<td width=30%>状态效果</td>
<td>启用能力</td>
<td>启用魔法</td>

</tr>
<tr>
<td>漂浮</td>
<td><img height='19' alt='' width='27' src='pic/status/float.jpg' /></td>
<td align='left'>【漂浮】漂浮在半空中,对敌方的地属性魔法免疫</td>
<td>恒浮空</td>
<td>浮空 </td>
</tr>
<tr>
<td>加速</td>
<td><img height='17' alt='' width='27' src='pic/status/haste.jpg' /></td>
<td align='left'>【加速】ATB的增长速度加快至1.5倍</td>
<td>恒加速</td>
<td>加速 |<br /> </td>
</tr>
<tr>
<td>自动复活</td>
<td><img height='19' alt='' width='27' src='pic/status/auto-life.jpg' /></td>
<td align='left'>【自动复活】当人物战斗不能后自动复活一次,复活后的HP为1</td>
<td>护身符</td>
<td>自动复活|<br />光环 </td>
</tr>
<tr>
<td>护盾</td>
<td><img height='23' alt='' width='27' src='pic/status/protect.jpg' /></td>
<td align='left'>【护盾】受到的物理攻击伤害值减半</td>
<td>---</td>
<td>护盾| <br />强力守护| 【红宝石兽 全动画】</td>
</tr>
<tr>
<td>反射</td>
<td><img height='21' alt='' width='27' src='pic/status/reflect.jpg' /></td>
<td align='left'>【反射】反弹受到的白魔法与黑魔法</td>
<td>恒反射 </td>
<td>反射| <br />【红宝石兽 】</td>
</tr>
<tr>
<td>再生</td>
<td><img height='24' alt='' width='27' src='pic/status/regen.jpg' /></td>
<td align='left'>【再生】固定每隔一段时间自动恢复最大HP的1/16</td>
<td>恒再生 </td>
<td>再生| <br />光环| <br />蕾洁之风</td>
</tr>
<tr>
<td>魔盾</td>
<td><img height='18' alt='' width='27' src='pic/status/shell.jpg' /></td>
<td align='left'>【魔盾】受到的魔法攻击与比例攻击伤害值减半</td>
<td>---</td>
<td> 魔盾| <br />强力守护| 【红宝石兽 +月长石】</td>
</tr>
<tr>
<td>隐身</td>
<td><img height='23' alt='' width='27' src='pic/status/vanish.jpg' /></td>
<td align='left'>【隐身】处于隐身状态,从而让敌方的单体物理攻击无效,进行物理攻击时敌方的物理回避率为0。受到魔法攻击会解除</td>
<td>---</td>
<td>隐身|<br />【红宝石兽 + 钻石】 </td>
</tr>
</tbody>
</table>
<br />
以上红宝石兽 与其他道具的组合是该召唤兽的特殊形态。<img height='11' alt='' width='13' src='./pic/system/go.gif' /><a target='_blank' href='./ff9_magic3.php'><u>召唤兽</u></a></center></div>";
echo "</body></html>";
?>
<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
