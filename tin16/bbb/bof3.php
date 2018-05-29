<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<a name=begin></a><center><font color=blue size=6>龙战士III资料站</font></center><br>";
echo "<center><a href=#gonglue>一、游戏攻略</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=#baishi>二、师匠资料</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=#yinzi>三、龙因子资料</a>
&nbsp;&nbsp;&nbsp;&nbsp;<a href='./xinde.php#xinde'>四、拜师心得</a><br><br><a href='./skill.php'>五、技能和物品</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='./fish.php#fish'>六、鱼场及钓鱼</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='./fish.php#faer'>七、妖精村建设</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=./xinde.php#neww>八、杂记</a></center>";
echo "<br><br><a name=gonglue></a>";
include_once("./bof3gl.php");
echo "<center><a href=#begin>返  回</a><br><br><a name=baishi></a>";
include_once("./baishi.php");
echo "<center><a href=#begin>返  回</a></center><br><br><a name=yinzi></a>";
include_once("./yinzi.php");
echo "<center><a href=#begin>返  回</a>";
?>
<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
