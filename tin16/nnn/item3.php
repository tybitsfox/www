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
echo "<table><tr><th width=10%>名称</th><th width=5%>防御力</th><th width=15%>入手方法</th><th width=5%>怪物掉落</th><th width=20%>合成</th><th width=15%>特殊効果</th><th width=5%>售价</th><th width=5%>卖价</th><th width=15%>出售地点</th><th width=5%>装备者</th></tr>";
echo "<tr><td>锅盖</td><td>2</td><td>波鲁特林克船中的罐</td><td><font color='#ff0000'>11</font> <font color='#ff0000'>62</font> </td><td>--</td><td>--</td><td>--</td><td>20</td><td>特拉佩塔</td><td>洋、杰</td></tr>
<tr><td>皮盾</td><td>4</td><td>特拉佩塔井中</td><td><font color='#ff0000'>235</font> </td><td>锅盖<font color='#ff0000'>+</font>魔兽的皮</td><td>--</td><td>70</td><td>35</td><td>特拉佩塔</td><td>主、洋、库</td></tr>
<tr><td>鳞盾</td><td>7</td><td>利萨斯村之塔(6F)宝箱</td><td><font color='#ff0000'>58 239</font> <font color='#ff0000'>241</font> </td><td>皮盾<font color='#ff0000'>+</font>龙鳞</td><td>--</td><td>180</td><td>90</td><td>利萨斯村</td><td>全员</td></tr>
<tr><td>白银托盘</td><td>8</td><td>帕尔米德筹码500、按摩屋的宝箱</td><td>--</td><td>--</td><td>--</td><td>--</td><td>100</td><td>--</td><td>杰</td></tr>
<tr><td>青銅盾</td><td>10</td><td>旧修道院跡地的宝箱</td><td><font color='#ff0000'>180</font> </td><td>皮盾<font color='#ff0000'>+</font>青铜匕首</td><td>--</td><td>370</td><td>185</td><td>阿斯坎塔城</td><td>主、洋</td></tr>
<tr><td>希顿之盾</td><td>12</td><td>剑士像洞窟的宝箱</td><td><font color='#ff0000'>94 126 </font></td><td>--</td><td>--</td><td>--</td><td>550</td><td>--</td><td>杰、库</td></tr>
<tr><td>骑士团之盾</td><td>14</td><td>许愿之丘的宝箱</td><td><font color='#ff0000'>47</font> <br><font color='#ff0000'>102</font></td><td>铁盾<font color='#ff0000'>+</font>骑士团之衣</td><td>火焰和吹雪伤害减少5</td><td>--</td><td>875</td><td>--</td><td>库</td></tr>
<tr><td>铁盾</td><td>15</td><td>剑士像洞窟的北西宝箱</td><td><font color='#ff0000'>67</font> <br><font color='#ff0000'>140 151</font><br><font color='#ff0000'>199 257</font></td><td>--</td><td>火焰和吹雪伤害减少5</td><td>720</td><td>360</td><td>帕尔米德</td><td>主、洋</td></tr>
<tr><td>轻盾</td><td>17</td><td>王家山的西边宝箱</td><td>--</td><td>--</td><td>--</td><td>2250</td><td>1175</td><td>圣地戈尔德、贝尔加拉克、萨赞比克城</td><td>全员</td></tr>
<tr><td>钢盾</td><td>22</td><td>萨赞比克湖南边湖畔的宝箱</td><td><font color='#ff0000'>207</font></td><td>--</td><td>火焰和吹雪伤害减少7</td><td>2500</td><td>1250</td><td>圣地戈尔德、萨维拉大圣堂</td><td>主、洋</td></tr>
<tr><td>白色盾牌</td><td>24</td><td>--</td><td>--</td><td>１铁盾<font color='#ff0000'>+</font>白银托盘<br>２轻盾<font color='#ff0000'>+</font>美味牛奶<font color='#ff0000'>+</font>美味牛奶<br>&nbsp;</td><td>火焰伤害减少10</td><td>--</td><td>1800</td><td>--</td><td>杰、库</td></tr>
<tr><td>魔法盾</td><td>27</td><td>--</td><td>--</td><td>钢盾<font color='#ff0000'>+</font>祈祷之戒<font color='#ff0000'>+</font>守护红宝石</td><td>攻击咒文伤害减少15</td><td>5000</td><td>2500</td><td>萨赞比克城、利普尔亚奇</td><td>主、库</td></tr>
<tr><td>龙盾</td><td>30</td><td>龙骨迷宮的宝箱</td><td>--</td><td>钢盾<font color='#ff0000'>+</font>龙鳞<font color='#ff0000'>+</font>龙鳞</td><td>火焰和吹雪伤害减少25</td><td>6900</td><td>3450</td><td>奥克尼斯</td><td>主、洋</td></tr>
<tr><td><font color='#339966'>冰之盾</font></td><td>33</td><td>--</td><td>--</td><td>魔法盾<font color='#ff0000'>+</font>冰之刃</td><td>希亚多、吹雪 伤害减少5、当道具在战斗中使用希亚多、吹雪 伤害减半</td><td>8500</td><td>4250</td><td>奥克尼斯</td><td>主、库</td></tr>
<tr><td><font color='#339966'>火焰之盾</font></td><td>34</td><td>--</td><td>--</td><td>魔法盾<font color='#ff0000'>+</font>火焰回旋镖</td><td>梅拉、基拉、火焰伤害减少10、当道具在战斗中使用梅拉、基拉、火焰伤害减半</td><td>7100</td><td>3550</td><td>雷缇希亚、暗黑雷缇希亚</td><td>洋、杰</td></tr>
<tr><td height='69'>骷髅盾牌</td><td height='69'>36</td><td height='69'>海贼洞窟的宝箱</td><td height='69'>--</td><td height='69'>--</td><td height='69'>--</td><td height='69'>--</td><td height='69'>8750</td><td height='69'>--</td><td height='69'>洋</td></tr>
<tr><td>力量之盾</td><td>38</td><td>帕尔米德宝箱(需要最后钥匙)</td><td><font color='#ff0000'>225</font></td><td>魔法盾<font color='#ff0000'>+</font>力量戒指<font color='#ff0000'>+</font>贝荷玛拉奶酪</td><td>火焰和吹雪伤害减少10、战斗是使用等同于贝荷伊米魔法</td><td>18000</td><td>9000</td><td>三角谷</td><td>主、洋、库</td></tr>
<tr><td>镜盾</td><td>43</td><td>--</td><td>--</td><td>--</td><td>偶尔能反弹受到的咒文攻击</td><td>15000</td><td>7500</td><td>三角谷</td><td>主、库</td></tr>
<tr><td height='72'>王牙之盾</td><td height='72'>45</td><td height='72'>龙骨迷宮南面高台上的宝箱(需要神鸟)</td><td height='72'>--</td><td height='72'>--</td><td height='72'>火焰和吹雪伤害减少10</td><td height='72'>--</td><td height='72'>10500</td><td height='72'>--</td><td height='72'>主、洋</td></tr>
<tr><td>圣女之盾</td><td>46</td><td>--</td><td>--</td><td>镜盾<font color='#ff0000'>+</font>白色盾牌<font color='#ff0000'>+</font>圣水</td><td>火焰和吹雪伤害减少1/3</td><td>--</td><td>28000</td><td>--</td><td>杰</td></tr>
<tr><td>水镜之盾</td><td>48</td><td>暗黒魔城都市(Black Citadel)的宝箱</td><td>--</td><td>镜盾<font color='#ff0000'>+</font>魔法圣水<font color='#ff0000'>+</font>阿莫鲁之水</td><td>梅拉、基拉、伊欧、火焰伤害减少20</td><td>--</td><td>16000</td><td>--</td><td>主、洋、库</td></tr>
<tr><td>破灭之盾</td><td>50</td><td>与世隔绝的高台(需要神鸟)</td><td><font color='#ff0000'>234</font></td><td>金属王之盾<font color='#ff0000'>+</font>恶魔之尾</td><td>诅咒装备 梅拉、基拉、伊欧、巴基、希亚多、火焰、吹雪伤害增加50</td><td>--</td><td>2900</td><td>--</td><td>主、洋、库</td></tr>
<tr><td><font color='#ff0000'>大哥大之盾</font></td><td>50</td><td>帕尔米德黑市(用红莲长袍交换获得)</td><td>--</td><td>--</td><td>战斗中使用等同于鲁卡南魔法</td><td>--</td><td>12000</td><td>--</td><td>洋</td></tr>
<tr><td>死神之盾</td><td>55</td><td>隐藏迷宫神龙之道 宝箱</td><td>--</td><td>女神之盾<font color='#ff0000'>+</font>恶魔之尾</td><td>诅咒装备 战斗中诅咒</td><td>--</td><td>3650</td><td>--</td><td>主、洋、库</td></tr>
<tr><td><font color='#ff0000'>女神之盾</font></td><td>55</td><td>--</td><td>--</td><td>死神之盾<font color='#ff0000'>+</font>圣者之灰</td><td>梅拉、基拉、伊欧、巴基、希亚多、火焰、吹雪伤害减半</td><td>--</td><td>47500</td><td>--</td><td>杰、库</td></tr>
<tr><td><font color='#ff0000'>龙神之盾</font></td><td>60</td><td>隐藏迷宫 天之祭壇击败龙神王许愿获得</td><td>--</td><td>--</td><td>梅拉、基拉、伊欧、火焰伤害减少30</td><td>--</td><td>--</td><td>--</td><td>主</td></tr>
<tr><td><font color='#ff0000'>金属王之盾</font></td><td>65</td><td>--</td><td>--</td><td>破灭之盾<font color='#ff0000'>+</font>圣者之灰<font color='#ff0000'>+</font>奥利哈尔钢</td><td>梅拉、基拉、伊欧、火焰、吹雪伤害减少30</td><td>--</td><td>--</td><td>--</td><td>全员</td></tr>";
echo "</table><br><br>";
echo "</div></body>";
?>
