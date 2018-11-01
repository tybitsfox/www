<?php
echo "<html><head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<style type='text/css'>
body{ text-align:left;font-family:'YaHei Consolas Hybrid';} 
#divcenter{margin:0 auto;width:1024px}
#divcenter table{text-align:center;border=1px black solid;border-collapse:collapse;font-size:large;}
#divcenter th{border:1px black solid;background-color:#CCFFFF;}
#divcenter td{border:1px black solid;}
</style>
</head><body><div id='divcenter'>";
echo "<table width=100%><tr><th width=5%>系统</th><th width=15%>称号</th><th width=10%>名字</th><th width=10%>种族</th><th width=5%>货币</th><th width=5%>HP</th><th width=5%>MP</th><th width=5%>攻击</th><th width=5%>防御</th><th width=5%>速度</th><th width=5%>回合</th><th width=25%>特技</th></tr>";
echo "<tr><td rowspan=10>史莱姆</td><td >爱之战士皮埃尔</td><td >皮埃尔</td><td >史莱姆骑士</td><td >铜</td><td >485</td><td >34</td><td >296</td><td >296</td><td >205</td><td >1</td><td >强攻、小回复</td></tr>
<tr><td >全民偶像</td><td >荷伊明</td><td >荷伊米史莱姆</td><td >铜</td><td >245</td><td >95</td><td >152</td><td >248</td><td >242</td><td >1.3</td><td >小回复、高回避</td></tr>
<tr><td >王牌史莱姆</td><td >史琳莱</td><td >史莱姆</td><td >铜</td><td >197</td><td >0</td><td >270</td><td >175</td><td >242</td><td >0.5</td><td >无</td></tr>
<tr><td >暴力史莱姆</td><td >普尔比</td><td >史莱姆</td><td >铜</td><td >228</td><td >0</td><td >188</td><td >179</td><td >113</td><td >0.6</td><td >无</td></tr>
<tr><td >回复天使</td><td >贝荷普</td><td >贝荷玛史莱姆</td><td ><font color='blue'>银</font></td><td >384</td><td >47</td><td >95</td><td >188</td><td >229</td><td >1.2</td><td >大回复、高回避</td></tr>
<tr><td >蓝色少年</td><td >阿明</td><td >史莱姆</td><td ><font color='red'>金</font></td><td >243</td><td >0</td><td >316</td><td >294</td><td >212</td><td >0.7</td><td >2动</td></tr>
<tr><td >雄本国王</td><td >雄本</td><td >史莱姆王</td><td ><font color='red'>金</font></td><td >499</td><td >25</td><td >252</td><td >247</td><td >64</td><td >1.3</td><td >强攻、群回复</td></tr>
<tr><td >冲刺的金属小子</td><td >金属小子</td><td >金属史莱姆</td><td ><font color='red'>金</font></td><td >3</td><td >64</td><td >129</td><td >970</td><td >122</td><td >1.2</td><td >大火球</td></tr>
<tr><td >音速的失散琳</td><td >失散琳</td><td >散金史莱姆</td><td ><font color='red'>金</font></td><td >6</td><td >96</td><td >205</td><td >985</td><td >204</td><td >1.3</td><td >2动、闪热、中闪热、极闪热</td></tr>
<tr><td >咆哮金属</td><td >斯麦尔</td><td >金属史莱姆王</td><td ><font color='red'>金</font></td><td >10</td><td >221</td><td >216</td><td >999</td><td >255</td><td >1.5</td><td >巨火球</td></tr>
<tr><td rowspan=9>獣</td><td >暴走少年</td><td >阿牛</td><td >凶暴牛</td><td >铜</td><td >764</td><td >0</td><td >196</td><td >124</td><td >195</td><td >0.8</td><td >蓄气</td></tr>
<tr><td >鼹鼠小队长</td><td >拉莫奇</td><td >杀人铲鼹鼠</td><td >铜</td><td >259</td><td >0</td><td >119</td><td >130</td><td >102</td><td >0.7</td><td >蓄气</td></tr>
<tr><td >野生的用枪高手</td><td >奥克斯</td><td >兽人之王</td><td >铜</td><td >417</td><td >31</td><td >250</td><td >232</td><td >196</td><td >1.1</td><td >复活</td></tr>
<tr><td >秘境怪力猴</td><td >阿猩</td><td >大头猩猩</td><td >铜</td><td >349</td><td >0</td><td >267</td><td >211</td><td >150</td><td >0.9</td><td >会心、不行动</td></tr>
<tr><td >我是喵凯</td><td >喵凯</td><td >条纹喵</td><td >铜</td><td >182</td><td >22</td><td >162</td><td >112</td><td >146</td><td >0.7</td><td >冰球</td></tr>
<tr><td >肌肉莫西干</td><td >莫西干</td><td >莫西干巨魔</td><td >铜</td><td >575</td><td >35</td><td >219</td><td >144</td><td >122</td><td >1.1</td><td >群回复</td></tr>
<tr><td >大自然的格斗王</td><td >雷斯拉</td><td >格斗豹</td><td ><font color='blue'>银</font></td><td >541</td><td >0</td><td >278</td><td >238</td><td >168</td><td >1.2</td><td >镰铀</td></tr>
<tr><td >最强公牛</td><td >巴哈罗</td><td >野牛战士</td><td ><font color='blue'>银</font></td><td >634</td><td >0</td><td >249</td><td >150</td><td >114</td><td >1.1</td><td >蓄气</td></tr>
<tr><td >地狱杀手</td><td >格雷格雷</td><td >杀人豹</td><td ><font color='red'>金</font></td><td >750</td><td >0</td><td >360</td><td >225</td><td >236</td><td >1.4</td><td >会心</td></tr>";
echo "<tr><td rowspan=3>龙</td><td >魔兽德兰戈</td><td >德兰戈</td><td >战斗霸王龙</td><td ><font color='blue'>银</font></td><td >897</td><td >0</td><td >336</td><td >239</td><td >143</td><td >0.9</td><td >隼斩、火焰</td></tr>
<tr><td >龙商人鼓助</td><td >鼓助</td><td >点点龙</td><td ><font color='blue'>银</font></td><td >739</td><td >0</td><td >241</td><td >186</td><td >181</td><td >1</td><td >沙烟、火焰</td></tr>
<tr><td >巨型飞行蜥蜴</td><td >法兹</td><td >肥蜥蜴</td><td ><font color='red'>金</font></td><td >977</td><td >0</td><td >342</td><td >244</td><td >108</td><td >1</td><td >群攻</td></tr>
<tr><td >虫</td><td >沙丘的杀手</td><td >萨西塔尔</td><td >巨蝎</td><td >铜</td><td >116</td><td >17</td><td >160</td><td >269</td><td >51</td><td >0.6</td><td >麻痹攻击</td></tr>
<tr><td rowspan=5>鳥</td><td >全力蝙蝠</td><td >龙吉</td><td >多拉奇</td><td >铜</td><td >231</td><td >0</td><td >213</td><td >201</td><td >179</td><td >0.7</td><td >高回避</td></tr>
<tr><td >魔鸟乌克凯</td><td >乌克凯</td><td >龙鸡战士</td><td >铜</td><td >381</td><td >0</td><td >143</td><td >116</td><td >115</td><td >1.1</td><td >镰铀</td></tr>
<tr><td >幸运的黑鸟</td><td >拉基</td><td >多拉奇</td><td >铜</td><td >231</td><td >0</td><td >245</td><td >206</td><td >240</td><td >0.7</td><td >高回避</td></tr>
<tr><td >黑暗的向导</td><td >椙山</td><td >多拉奇</td><td ><font color='red'>金</font></td><td >267</td><td >0</td><td >216</td><td >210</td><td >257</td><td >0.9</td><td >高回避</td></tr>
<tr><td >魔空的王者霍克尔</td><td >霍克尔</td><td >恶魔鹰</td><td ><font color='red'>金</font></td><td >981</td><td >50</td><td >349</td><td >168</td><td >129</td><td >1.3</td><td >群加防</td></tr>
<tr><td>植物</td><td >森林统治者</td><td >人面</td><td >人面树</td><td >铜</td><td >251</td><td >0</td><td >231</td><td >178</td><td >94</td><td >0.8</td><td >吸魔</td></tr>
<tr><td rowspan=8>物質</td><td >孤独行者</td><td >乔</td><td >徘徊铠甲</td><td >铜</td><td >266</td><td >0</td><td >328</td><td >262</td><td >153</td><td >0.9</td><td >无</td></tr>
<tr><td >贪吃箱</td><td >巴克尔</td><td >食人箱</td><td >铜</td><td >287</td><td >27</td><td >179</td><td >120</td><td >133</td><td >0.7</td><td >2动、香甜气息、闪热</td></tr>
<tr><td >笑笑玛欧尔</td><td >玛欧尔</td><td >笑面口袋</td><td >铜</td><td >234</td><td >16</td><td >95</td><td >179</td><td >133</td><td >0.8</td><td >封魔、高回避</td></tr>
<tr><td >怪力格雷姆斯</td><td >格雷姆斯</td><td >巨像兵</td><td ><font color='blue'>银</font></td><td >743</td><td >0</td><td >297</td><td >302</td><td >165</td><td >0.7</td><td >蓄气、会心</td></tr>
<tr><td >愤怒的神像</td><td >阿波罗</td><td >活动石像</td><td ><font color='blue'>银</font></td><td >801</td><td >0</td><td >316</td><td >243</td><td >116</td><td >0.6</td><td >强攻</td></tr>
<tr><td >闪耀火花</td><td >哈尔甘</td><td >跳舞宝石</td><td ><font color='blue'>银</font></td><td >286</td><td >20</td><td >127</td><td >271</td><td >198</td><td >1</td><td >高回避</td></tr>
<tr><td >魔人像由加</td><td >由加</td><td >石头人</td><td ><font color='blue'>银</font></td><td >810</td><td >0</td><td >308</td><td >306</td><td >110</td><td >0.7</td><td >蓄气、会心</td></tr>
<tr><td >黄金先生</td><td >格尔顿</td><td >黄金巨人</td><td ><font color='red'>金</font></td><td >438</td><td >0</td><td >296</td><td >234</td><td >103</td><td >0.7</td><td >会心</td></tr>";
echo "
<tr><td rowspan=4>机械类</td><td >割舌机器</td><td >比夸克</td><td >机器鸟</td><td >铜</td><td >167</td><td >16</td><td >136</td><td >214</td><td >173</td><td >0.6</td><td >加速</td></tr>
<tr><td >机械兵罗宾</td><td >罗宾</td><td >杀人机器</td><td ><font color='blue'>银</font></td><td >586</td><td >0</td><td >222</td><td >238</td><td >251</td><td >1</td><td >2动、冰斩、激光</td></tr>
<tr><td >杀人机器</td><td >基拉玛</td><td >杀人机器</td><td ><font color='blue'>银</font></td><td >635</td><td >0</td><td >250</td><td >275</td><td >225</td><td >1.2</td><td >2动、冰斩、激光</td></tr>
<tr><td >技师杀手</td><td >阿信</td><td >杀人机器</td><td ><font color='red'>金</font></td><td >750</td><td >0</td><td >265</td><td >280</td><td >225</td><td >1.3</td><td >2动、强攻、冰斩、激光</td></tr>
<tr><td rowspan=7>不死族</td><td >地狱的老兵</td><td >史密斯</td><td >腐烂尸体</td><td >铜</td><td >816</td><td >0</td><td >248</td><td >40</td><td >113</td><td >0.7</td><td >会心、毒气</td></tr>
<tr><td >死灵骑士</td><td >死神贵族</td><td >死神贵族</td><td >铜</td><td >490</td><td >0</td><td >260</td><td >280</td><td >207</td><td >0.9</td><td >光之纹章</td></tr>
<tr><td >苏醒的远古之敌</td><td >骨头先生</td><td >骸骨</td><td >铜</td><td >271</td><td >29</td><td >187</td><td >208</td><td >217</td><td >0.6</td><td >群降防</td></tr>
<tr><td >魔法大师</td><td >普利斯特</td><td >死亡牧师</td><td ><font color='blue'>银</font></td><td >613</td><td >210</td><td >193</td><td >277</td><td >246</td><td >1.2</td><td >巨火球、狂爆</td></tr>
<tr><td >夜之世界的引路人</td><td >克拉克</td><td >暴灵剑士</td><td ><font color='red'>金</font></td><td >665</td><td >0</td><td >303</td><td >205</td><td >227</td><td >1</td><td >闪电斩</td></tr>
<tr><td >能量炸弹</td><td >迪拉</td><td >无头骑士</td><td ><font color='red'>金</font></td><td >917</td><td >81</td><td >326</td><td >271</td><td >206</td><td >1.2</td><td >蓄气、倍攻</td></tr>
<tr><td >武器大师</td><td >哈尔克</td><td >地狱杀手</td><td ><font color='red'>金</font></td><td >715</td><td >0</td><td >345</td><td >268</td><td >265</td><td >1.1</td><td >2动、强攻、催眠攻击</td></tr>
<tr><td rowspan=10>悪魔</td><td >来自爱之国的女人</td><td >阿莫蕾</td><td >巫女</td><td >铜</td><td >296</td><td >64</td><td >71</td><td >120</td><td >132</td><td >0.9</td><td >连续2次蓄气、2动、大风、封魔、诱惑</td></tr>
<tr><td >回头恶魔</td><td >小红</td><td >红尾恶魔</td><td >铜</td><td >330</td><td >0</td><td >232</td><td >180</td><td >170</td><td >1</td><td >甩尾</td></tr>
<tr><td >骑士英雄</td><td >史凯尔</td><td >骷髅骑兵</td><td >铜</td><td >359</td><td >0</td><td >201</td><td >244</td><td >248</td><td >1.1</td><td >2动、火焰斩</td></tr>
<tr><td >夜之帝王利奇</td><td >利奇</td><td >夜之帝王</td><td >铜</td><td >312</td><td >0</td><td >191</td><td >167</td><td >85</td><td >0.8</td><td >香甜气息</td></tr>
<tr><td >狂暴的远古巨人</td><td >基冈兹</td><td >远古巨人</td><td ><font color='blue'>银</font></td><td >959</td><td >0</td><td >329</td><td >200</td><td >173</td><td >0.8</td><td >强攻、会心</td></tr>
<tr><td >青鬼塞普</td><td >塞普</td><td >独眼巨人</td><td ><font color='blue'>银</font></td><td >760</td><td >0</td><td >255</td><td >124</td><td >159</td><td >0.9</td><td >强攻、会心</td></tr>
<tr><td >夜晚的内裤男</td><td >泰奇</td><td >恶魔刽子手</td><td ><font color='red'>金</font></td><td >633</td><td >0</td><td >209</td><td >230</td><td >176</td><td >0.8</td><td >蓄气+攻击、连续3次蓄气</td></tr>
<tr><td >地狱门卫基加</td><td >基加</td><td >远古巨人</td><td ><font color='red'>金</font></td><td >864</td><td >0</td><td >282</td><td >166</td><td >99</td><td >1</td><td >强攻、会心</td></tr>
<tr><td >极恶恶魔</td><td >阿克登</td><td >大恶魔</td><td ><font color='red'>金</font></td><td >926</td><td >74</td><td >335</td><td >168</td><td >190</td><td >0.9</td><td >狂爆、光之衣</td></tr>
<tr><td >胖胖的天使</td><td >波斯</td><td >绿巨魔</td><td ><font color='red'>金</font></td><td >999</td><td >0</td><td >348</td><td >74</td><td >90</td><td >1</td><td >会心、攻击失败</td></tr>
<tr><td rowspan=4>元素</td><td >冰之化身布利扎德</td><td >布利扎德</td><td >寒冰人</td><td >铜</td><td >223</td><td >16</td><td >190</td><td >155</td><td >134</td><td >0.8</td><td >冰气、群即死</td></tr>
<tr><td >冻结的灵魂魔冰</td><td >魔冰</td><td >寒冰人</td><td >铜</td><td >358</td><td >12</td><td >219</td><td >151</td><td >137</td><td >0.9</td><td >冰气、暴风雪、即死</td></tr>
<tr><td >炎之化身弗雷</td><td >弗雷</td><td >火焰人</td><td >铜</td><td >313</td><td >0</td><td >252</td><td >179</td><td >209</td><td >0.8</td><td >强攻、喷火、火焰</td></tr>
<tr><td >燃烧的灵魂魔火</td><td >魔火</td><td >火焰人</td><td ><font color='blue'>银</font></td><td >361</td><td >0</td><td >221</td><td >156</td><td >139</td><td >0.9</td><td >强攻、喷火、火焰、剧烈火焰</td></tr>
<tr><td rowspan=10>怪人</td><td >不屈的狙击手</td><td >利利比</td><td >鼠射手</td><td >铜</td><td >363</td><td >20</td><td >188</td><td >219</td><td >217</td><td >0.7</td><td >加防</td></tr>
<tr><td >山野气势王</td><td >布兰</td><td >棕仙</td><td >铜</td><td >179</td><td >0</td><td >163</td><td >113</td><td >82</td><td >0.7</td><td >蓄气、连续4次蓄气、攻击失败</td></tr>
<tr><td >弓箭冠军</td><td >纳欧比</td><td >射箭小妖</td><td >铜</td><td >193</td><td >32</td><td >154</td><td >190</td><td >231</td><td >0.7</td><td >连射</td></tr>
<tr><td >操纵师芳树</td><td >芳树</td><td >人偶小鬼</td><td >铜</td><td >254</td><td >34</td><td >191</td><td >170</td><td >163</td><td >1.1</td><td >戏法</td></tr>
<tr><td >爱的牧神</td><td >巴尼</td><td >吹笛羊人</td><td >铜</td><td >329</td><td >0</td><td >142</td><td >182</td><td >124</td><td >0.8</td><td >催眠曲、羊群曲</td></tr>
<tr><td >水陆两用魔人</td><td >乌尔顿</td><td >利爪海妖</td><td >铜</td><td >399</td><td >29</td><td >242</td><td >205</td><td >135</td><td >1.1</td><td >旋回群攻、即死</td></tr>
<tr><td >破坏神断吉</td><td >断吉</td><td >拔刀熊</td><td >铜</td><td >620</td><td >24</td><td >216</td><td >193</td><td >125</td><td >0.9</td><td >会心、倍攻</td></tr>
<tr><td >剧毒天使</td><td >毒山</td><td >毒箭小妖</td><td >铜</td><td >353</td><td >32</td><td >170</td><td >170</td><td >100</td><td >0.8</td><td >毒箭连射</td></tr>
<tr><td >伊甸的人偶师</td><td >西罗明</td><td >傀儡大师</td><td >铜</td><td >239</td><td >28</td><td >178</td><td >212</td><td >244</td><td >1</td><td >戏法、火焰</td></tr>
<tr><td >丛林大明星</td><td >巴萨曼</td><td >狂战士</td><td ><font color='blue'>银</font></td><td >611</td><td >0</td><td >232</td><td >176</td><td >240</td><td >0.9</td><td >强攻</td></tr>
<tr><td rowspan=5>水</td><td >取物小专家</td><td >斑斑</td><td >小章鱼</td><td >铜</td><td >78</td><td >0</td><td >64</td><td >64</td><td >116</td><td >0.6</td><td >玩耍</td></tr>
<tr><td >龙虾醉汉</td><td >艾比拉</td><td >龙虾</td><td >铜</td><td >213</td><td >31</td><td >188</td><td >263</td><td >195</td><td >0.7</td><td >2动、吸魔</td></tr>
<tr><td >海之幸先生</td><td >米奈拉尔</td><td >海藻王子</td><td >铜</td><td >327</td><td >22</td><td >203</td><td >113</td><td >183</td><td >1</td><td >唱歌</td></tr>
<tr><td >天国大明星</td><td >莉</td><td >章鱼骑兵</td><td ><font color='blue'>银</font></td><td >611</td><td >67</td><td >239</td><td >196</td><td >202</td><td >1.2</td><td >群回复、强攻、连突</td></tr>
<tr><td >治愈公主玛琳</td><td >玛琳</td><td >海洋精灵</td><td ><font color='blue'>银</font></td><td >284</td><td >89</td><td >50</td><td >131</td><td >233</td><td >0.6</td><td >群回复、加速、高回避</td></tr>";
echo "</table><br><br></div></body>";
