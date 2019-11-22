<html><title>tr命令简介</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<body TEXT="#000000" LINK="#AA0000" VLINK="#AA0055" ALINK="#AA0000" STYLE="font-size:18px; font-family:宋体, Arial; font-weight:bolder; line-height:130%;">
<?php
echo "
一、前述<br>
awk是一个强大的文本分析工具。相对于grep的查找，sed的编辑，awk在其对数据分析并生成报告时，显得尤为强大。<br>
简单来说awk就是把文件逐行的读入，（空格，制表符）为默认分隔符将每行切片，切开的部分再进行各种分析处理。<br>
二、具体<br>
1、基础知识点<br>
awk -F '{pattern + action}' {filenames}<br>
支持自定义分隔符<br>
支持正则表达式匹配<br>
支持自定义变量，数组  a[1]  a[tom]  map(key)<br>
支持内置变量<br>
ARGC               命令行参数个数<br>
ARGV               命令行参数排列<br>
ENVIRON            支持队列中系统环境变量的使用<br>
FILENAME           awk浏览的文件名<br>
FNR                浏览文件的记录数<br>
FS                 设置输入域分隔符，等价于命令行 -F选项<br>
NF                 浏览记录的域的个数<br>
NR                 已读的记录数<br>
OFS                输出域分隔符<br>
ORS                输出记录分隔符<br>
RS                 控制记录分隔符<br>
支持函数<br>
print、split、substr、sub、gsub<br>
支持流程控制语句，类C语言<br>
if、while、do/while、for、break、continue<br>
$0表示所有域, $1表示第一个域, $n表示第n个域。 默认域分隔符是空格键或tab键。<br>
2、举例<br>
只是显示/etc/passwd的账户:CUT<br>
awk -F':' '{print $1}' passwd<br>
只是显示/etc/passwd的账户和账户对应的shell,而账户与shell之间以逗号分割,而且在所有行开始前添加列名name,shell,在最后一行添加\"blue,/bin/nosh\"（cut，sed）<br>
awk -F':' 'BEGIN{print \"name,shell\"} {print $1 \",\" $7} END{print \"blue,/bin/nosh\"}' passwd<br>
搜索/etc/passwd有root关键字的所有行<br>
awk  '/root/ { print $0}'   passwd<br>
统计/etc/passwd文件中，每行的行号，每行的列数，对应的完整行内容<br>
xxx     Math English C++  Experiment<br>
Monkey  100   90     95   Good<br>
Cat     80    100    60   Perfect<br>
Dog     90    60     70   Great<br>
Tiger   95    85     90   Fantastic<br>
Administrator@51B6904C3C8A485 ~/learn_awk  <br>
$ awk '{print $2}' test.txt  <br>
Math  <br>
100  <br>
80  <br>
90  <br>
95  <br>
--------------------------------------------------------------------------------------------------------------<br>
之前说过sed, 今天来说awk, 它也是一个文本处理器， 是linux下的一个命令， 比sed更强大。 搞linux开发， 尤其是后台开发， 这个命令几乎必须要用到。 awk这三个字母分别代表其三位作者的名字， 而不是某个/某些有意义单词的缩写。<br>
   还是那句话，以实践操作为荣， 以只看不练为耻。当然， 理解awk的原理是必须的：读入有'\\n'换行符分割的一条记录，将记录按指定的域分隔符划分域，$0表示所有域, $1表示第一个域, $n表示第n个域。 默认域分隔符是空格键或tab键。<br>
   鉴于awk涉及的东西太多， 所以本文中， 我们仅仅介绍基本的用法， 以后遇到了新的东东， 再添加到本博文中， 滚雪球似地积累。<br>
   先来感受一下awk, 我们假设test.txt中的内容：<br>
xxx     Math English C++  Experiment<br>
Monkey  100   90     95   Good<br>
Cat     80    100    60   Perfect<br>
Dog     90    60     70   Great<br>
Tiger   95    85     90   Fantastic<br>
   之前， 我们用sed来输出行， 现在， 我们来感受一下用awk输出列, 如下：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{print $2}' test.txt<br>
Math<br>
100<br>
80<br>
90<br>
95<br>
   看到了吧， 这就是awk. 注意上面只能是单引号， 不能是双引号， $2表示第二列。<br>
 <br>
   我们来看看awk的一般格式：awk [option]  'pattern {action}' test.txt,  比如上面的awk '{print $2}' test.txt, 此时，采用默认选项， 且条件永远为真。<br>
   下面， 我们根据awk的原型来一一说明：<br>
    <br>
    A.awk <br>
    其实awk就相当于一个函数名， 没什么好说的了。<br>
    B. option<br>
    我们先看如下操作， 打印test.txt文件的第二列：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{print $2}' test.txt<br>
Math<br>
100<br>
80<br>
90<br>
95<br>
    可以看到， 命令中没有选项， 也就是采用了默认选项， 现在假设a.txt中的文件内容为：<br>
xxx|Math|English|C++|Experiment<br>
Monkey|100|90|95|Good<br>
Cat|80|100|60|Perfect<br>
Dog|90|60|70|Great<br>
Tiger|95|85|90|Fantastic<br>
   我们再用awk '{print $2}' a.txt就不灵了， 为什么呢？ 因为awk '{print $2}' a.txt的选项为空， 默认的是以空格为分隔符， 显然不能进行划分。 那怎么办呢？ 此时， 我们应该显式地指明分隔符， 如下：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk -F \"|\" '{print $2}' a.txt<br>
Math<br>
100<br>
80<br>
90<br>
95<br>
   这就对了。好了， 后续我们仍然针对test.txt， 不针对a.txt. 也就是说， 采用默认的选项。<br>
   C. pattern<br>
   这个最好理解了， 比如， 条件就是一种模式(但模式不仅仅是条件， 有可能是一些正则表达式等)。我们看到， 在awk '{print $2}' test.txt中， 是无条件的， 所谓无条件即为真。 日本无条件投降， 大概就是这个意思。 当然， 为了讲清楚条件， 我们还是来看看：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '1<2 {print $2}' test.txt<br>
Math<br>
100<br>
80<br>
90<br>
95<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '1<1 {print $2}' test.txt<br>
   我们看到， 当条件为真的时候， 才会有真正的打印， 反之， 打个屁。 如果要打印整个文件， 可以这么搞：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '1' test.txt<br>
xxx     Math English C++  Experiment<br>
Monkey  100   90     95   Good<br>
Cat     80    100    60   Perfect<br>
Dog     90    60     70   Great<br>
Tiger   95    85     90   Fantastic<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '0' test.txt<br>
  可以看看到， 条件为真， 有打印。 否则， 没有打印。<br>
   D. action<br>
   这个好理解， 无非就是内置命令而已， 比如print $2, 如下：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{print $2}' test.txt<br>
Math<br>
100<br>
80<br>
90<br>
95<br>
   当然， 如果你喜欢C/C++语言格式， 那完全可以写成：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{printf(\"%s\\n\", $2)}' test.txt<br>
Math<br>
100<br>
80<br>
90<br>
95<br>
   实际上， 在pattern部分， 我们是可以用C/C++语言的if等关键字的， 如：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{if(1<2) printf(\"%s\\n\", $2)}' test.txt<br>
Math<br>
100<br>
80<br>
90<br>
95<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{if(1<1) printf(\"%s\\n\", $2)}' test.txt<br>
  我们看到， awk看似很小， 其实五脏俱全。 弄清了上面的基本构成， awk就算基本入门了。 既然已经与awk有了初步的恋爱感觉了， 那就要趁热打铁的练习一下。<br>
  <br>
  一. awk的内置变量<br>
  1. $0表示整行， $n表示第n个分段， 如下：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{print $0}' test.txt<br>
xxx     Math English C++  Experiment<br>
Monkey  100   90     95   Good<br>
Cat     80    100    60   Perfect<br>
Dog     90    60     70   Great<br>
Tiger   95    85     90   Fantastic<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{print $2}' test.txt<br>
Math<br>
100<br>
80<br>
90<br>
95<br>
  再如：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{print $1, $3}' test.txt<br>
xxx English<br>
Monkey 90<br>
Cat 100<br>
Dog 60<br>
Tiger 85<br>
  2. FILENAME表示文件名称， 比如：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{printf(\"%s\\n\", FILENAME)}' test.txt<br>
test.txt<br>
test.txt<br>
test.txt<br>
test.txt<br>
test.txt<br>
   可以看到， 文件名被打印出来了， 为什么是5个呢？ 因为awk是逐行处理的。<br>
   3. NR是当前的行数， 可以理解为number of row, 当然， 如果你非要说now row这样的中式英语， 那也可以。总之， 你要明白， NR很有用。如下：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{printf(\"%d:%s\\n\", NR, FILENAME)}' test.txt<br>
1:test.txt<br>
2:test.txt<br>
3:test.txt<br>
4:test.txt<br>
5:test.txt<br>
   那要创建test1.txt---test5.txt怎么搞呢？ 也很简单， 联合我们之前介绍过的xargs, 如下：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{printf(\"%s%d\\n\", FILENAME, NR)}' test.txt | xargs touch<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ ls<br>
test.txt  test.txt1  test.txt2  test.txt3  test.txt4  test.txt5<br>
<br>
  4. FNR是文件中的行数， 和NR还是有点小小区别的， 且看：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ cp test.txt test_bak.txt<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{printf(\"%d:%d:%s\\n\", NR, FNR, FILENAME)}' test.txt test_bak.txt<br>
1:1:test.txt<br>
2:2:test.txt<br>
3:3:test.txt<br>
4:4:test.txt<br>
5:5:test.txt<br>
6:1:test_bak.txt<br>
7:2:test_bak.txt<br>
8:3:test_bak.txt<br>
9:4:test_bak.txt<br>
10:5:test_bak.txt<br>
 <br>
 5. NF表示当前行有多少个段， 学这些东西的时候， 不要死记， 要知道NF是number of field的缩写， 那就清晰了， 如下：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ echo \"good good study\" | awk '{print NF}'<br>
3<br>
  可见有3个段， 下面我们看看test.txt的每行是不是有5个段：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{print NF}' test.txt<br>
5<br>
5<br>
5<br>
5<br>
5<br>
  果然如此。<br>
  6. FS是filed seperator, 也就是段分割符号， 默认情况下为空格， 下面我们不用默认的， 而用\"|\", 如下：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk -F \"|\" '{print FS}' test.txt<br>
|<br>
|<br>
|<br>
|<br>
|<br>
  <br>
  当然， 还有其他的一些内置变量， 在此就不一一举例了， 以后要用的时候， 一查便知。<br>
  二. 常见的一些pattern<br>
   1. 条件式的pattern, 我们其实已经熟悉了， 比如：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '1' test.txt<br>
xxx     Math English C++  Experiment<br>
Monkey  100   90     95   Good<br>
Cat     80    100    60   Perfect<br>
Dog     90    60     70   Great<br>
Tiger   95    85     90   Fantastic<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '1<=1' test.txt<br>
xxx     Math English C++  Experiment<br>
Monkey  100   90     95   Good<br>
Cat     80    100    60   Perfect<br>
Dog     90    60     70   Great<br>
Tiger   95    85     90   Fantastic<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '1<=0' test.txt<br>
   <br>
   2. 来个复杂一点的条件pattern, 如下：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk 'length > 30' test.txt<br>
xxx     Math English C++  Experiment<br>
Cat     80    100    60   Perfect<br>
Dog     90    60     70   Great<br>
Tiger   95    85     90   Fantastic<br>
    3. 继续条件pattern, 如下：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '$1==\"Cat\"' test.txt<br>
Cat     80    100    60   Perfect<br>
    继续加个条件：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '$1!=\"Cat\" && $3>=85' test.txt<br>
xxx     Math English C++  Experiment<br>
Monkey  100   90     95   Good<br>
Tiger   95    85     90   Fantastic<br>
  <br>
   4. 打印第2-4行：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk 'NR>=2 && NR<=4 {print $0}' test.txt<br>
Monkey  100   90     95   Good<br>
Cat     80    100    60   Perfect<br>
Dog     90    60     70   Great<br>
   别忘了， 我们的sed也可以, 也蛮牛逼的:<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ sed -n \"2,4\"p test.txt<br>
Monkey  100   90     95   Good<br>
Cat     80    100    60   Perfect<br>
Dog     90    60     70   Great<br>
   好了， 条件式的pattern我们介绍到这里， 下面我们介绍与正则表达式有关的一些pattern.<br>
   5. 行过滤， 类似于grep的功能， 如：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '/Cat/' test.txt<br>
Cat     80    100    60   Perfect<br>
   对了，sed也有类似功能， 如下：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ sed -n \"/Cat/\"p test.txt<br>
Cat     80    100    60   Perfect<br>
<br>
  6. 那能不能实现grep -v的功能呢？ 肯定可以， 如果你认为不能， 那太小看awk了， 且看：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '!/Cat/' test.txt<br>
xxx     Math English C++  Experiment<br>
Monkey  100   90     95   Good<br>
Dog     90    60     70   Great<br>
Tiger   95    85     90   Fantastic<br>
  7. 输出以xxxxxx开头的行：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '/^C/' test.txt<br>
Cat     80    100    60   Perfect<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '/^(C|D)/' test.txt<br>
Cat     80    100    60   Perfect<br>
Dog     90    60     70   Great<br>
  <br>
  8. 输出以xxxxxx结尾的行：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '/t$/' test.txt<br>
xxx     Math English C++  Experiment<br>
Cat     80    100    60   Perfect<br>
Dog     90    60     70   Great<br>
   <br>
  9. 自然而言地， 在一个pattern里， 我们可以既有正则又有条件， 如：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '/100/ && $4 >= 60' test.txt<br>
Monkey  100   90     95   Good<br>
Cat     80    100    60   Perfect<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '/100/ && $4 > 60' test.txt<br>
Monkey  100   90     95   Good<br>
  10. 最后再来一个：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '/^x/, /^D/' test.txt<br>
xxx     Math English C++  Experiment<br>
Monkey  100   90     95   Good<br>
Cat     80    100    60   Perfect<br>
Dog     90    60     70   Great<br>
   当然了， sed肯定也有此功能， 不信你就翻翻我之前的博文。<br>
   三. 常见的一些action, 实际上主要是内置函数<br>
   1. 最常见的print, printf, 如下：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{print $2}' test.txt<br>
Math<br>
100<br>
80<br>
90<br>
95<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{printf(\"%d\\n\", $2)}' test.txt<br>
0<br>
100<br>
80<br>
90<br>
95<br>
   2.  在action中也可以有种逻辑， 比如打印第2-4行：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{if(NR>=2 && NR<=4) print $0}' test.txt<br>
Monkey  100   90     95   Good<br>
Cat     80    100    60   Perfect<br>
Dog     90    60     70   Great<br>
   当然， 你也可以把这个if条件移动到pattern中去， 如：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk 'NR>=2 && NR<=4 {print $0}' test.txt<br>
Monkey  100   90     95   Good<br>
Cat     80    100    60   Perfect<br>
Dog     90    60     70   Great<br>
  3.  计算字符串长度， 相当于C/C++中的length函数<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ echo \"good good study\" | awk '{print length}'<br>
15<br>
   再如：<br>
Administrator@51B6904C3C8A485 ~/learn_awk<br>
$ awk '{print length}' test.txt<br>
36<br>
30<br>
33<br>
31<br>
35<br>
   实际上， awk还有很多内建的函数。 本文无法覆盖awk的所有内容， 仅仅提供冰山一角的一些东东， 但供入门肯定是没有问题的。后续会更根据实际， 对本文进行逐渐补充和完善。 <br>

";
?>
</body><html>
