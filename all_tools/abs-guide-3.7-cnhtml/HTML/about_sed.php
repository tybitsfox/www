<html><title>tr命令简介</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<body TEXT="#000000" LINK="#AA0000" VLINK="#AA0055" ALINK="#AA0000" STYLE="font-size:18px; font-family:宋体, Arial; font-weight:bolder; line-height:130%;">
<?php
echo "
sed是一个很好的文件处理工具，本身是一个管道命令，主要是以行为单位进行处理，可以将数据行进行替换、删除、新增、选取等特定工作，下面先了解一下sed的用法<br>
sed命令行格式为：<br>
         sed [-nefri] ‘command’ 输入文本        <br>
常用选项：<br>
        -n∶使用安静(silent)模式。在一般 sed 的用法中，所有来自 STDIN的资料一般都会被列出到萤幕上。但如果加上 -n 参数后，则只有经过sed 特殊处理的那一行(或者动作)才会被列出来。<br>
        -e∶直接在指令列模式上进行 sed 的动作编辑；<br>
        -f∶直接将 sed 的动作写在一个档案内， -f filename 则可以执行 filename 内的sed 动作；<br>
        -r∶sed 的动作支援的是延伸型正规表示法的语法。(预设是基础正规表示法语法)<br>
        -i∶直接修改读取的档案内容，而不是由萤幕输出。       <br>
常用命令：<br>
        a   ∶新增， a 的后面可以接字串，而这些字串会在新的一行出现(目前的下一行)～<br>
        c   ∶取代， c 的后面可以接字串，这些字串可以取代 n1,n2 之间的行！<br>
        d   ∶删除，因为是删除啊，所以 d 后面通常不接任何咚咚；<br>
         i   ∶插入， i 的后面可以接字串，而这些字串会在新的一行出现(目前的上一行)；<br>
         p  ∶列印，亦即将某个选择的资料印出。通常 p 会与参数 sed -n 一起运作～<br>
         s  ∶取代，可以直接进行取代的工作哩！通常这个 s 的动作可以搭配正规表示法！例如 1,20s/old/new/g 就是啦！<br>
举例：（假设我们有一文件名为ab）<br>
     删除某行<br>
     [root@localhost ruby] # sed '1d' ab              #删除第一行 <br>
     [root@localhost ruby] # sed '$d' ab              #删除最后一行<br>
     [root@localhost ruby] # sed '1,2d' ab           #删除第一行到第二行<br>
     [root@localhost ruby] # sed '2,$d' ab           #删除第二行到最后一行<br>
　　显示某行<br>
.    [root@localhost ruby] # sed -n '1p' ab           #显示第一行 <br>
     [root@localhost ruby] # sed -n '$p' ab           #显示最后一行<br>
     [root@localhost ruby] # sed -n '1,2p' ab        #显示第一行到第二行<br>
     [root@localhost ruby] # sed -n '2,$p' ab        #显示第二行到最后一行<br>
　　使用模式进行查询<br>
     [root@localhost ruby] # sed -n '/ruby/p' ab    #查询包括关键字ruby所在所有行<br>
     [root@localhost ruby] # sed -n '/\\$/p' ab        #查询包括关键字$所在所有行，使用反斜线\\屏蔽特殊含义<br>
　　增加一行或多行字符串<br>
     [root@localhost ruby]# cat ab<br>
     Hello!<br>
     ruby is me,welcome to my blog.<br>
     end<br>
     [root@localhost ruby] # sed '1a drink tea' ab  #第一行后增加字符串\"drink tea\"<br>
     Hello!<br>
     drink tea<br>
     ruby is me,welcome to my blog. <br>
     end<br>
     [root@localhost ruby] # sed '1,3a drink tea' ab #第一行到第三行后增加字符串\"drink tea\"<br>
     Hello!<br>
     drink tea<br>
     ruby is me,welcome to my blog.<br>
     drink tea<br>
     end<br>
     drink tea<br>
     [root@localhost ruby] # sed '1a drink tea\\nor coffee' ab   #第一行后增加多行，使用换行符\\n<br>
     Hello!<br>
     drink tea<br>
     or coffee<br>
     ruby is me,welcome to my blog.<br>
     end<br>
　　代替一行或多行<br>
     [root@localhost ruby] # sed '1c Hi' ab                #第一行代替为Hi<br>
     Hi<br>
     ruby is me,welcome to my blog.<br>
     end<br>
     [root@localhost ruby] # sed '1,2c Hi' ab             #第一行到第二行代替为Hi<br>
     Hi<br>
     end<br>
　　替换一行中的某部分<br>
格式：sed 's/要替换的字符串/新的字符串/g'   （要替换的字符串可以用正则表达式）<br>
     [root@localhost ruby] # sed -n '/ruby/p' ab | sed 's/ruby/bird/g'    #替换ruby为bird<br>
  [root@localhost ruby] # sed -n '/ruby/p' ab | sed 's/ruby//g'        #删除ruby<br>
     插入<br>
     [root@localhost ruby] # sed -i '$a bye' ab         #在文件ab中最后一行直接输入\"bye\"<br>
     [root@localhost ruby]# cat ab<br>
     Hello!<br>
     ruby is me,welcome to my blog.<br>
     end<br>
     bye<br>
< <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<br>
a <br>
在当前行后面加入一行文本。<br>
b lable <br>
分支到脚本中带有标记的地方，如果分支不存在则分支到脚本的末尾。<br>
c<br>
用新的文本改变本行的文本。<br>
d <br>
从模板块（Pattern space）位置删除行。<br>
D <br>
删除模板块的第一行。<br>
i<br>
在当前行上面插入文本。<br>
h <br>
拷贝模板块的内容到内存中的缓冲区。<br>
H <br>
追加模板块的内容到内存中的缓冲区<br>
g <br>
获得内存缓冲区的内容，并替代当前模板块中的文本。<br>
G <br>
获得内存缓冲区的内容，并追加到当前模板块文本的后面。<br>
l <br>
列表不能打印字符的清单。<br>
n <br>
读取下一个输入行，用下一个命令处理新的行而不是用第一个命令。<br>
N <br>
追加下一个输入行到模板块后面并在二者间嵌入一个新行，改变当前行号码。<br>
p <br>
打印模板块的行。<br>
P（大写） <br>
打印模板块的第一行。<br>
q <br>
退出Sed。<br>
r file <br>
从file中读行。<br>
t label <br>
if分支，从最后一行开始，条件一旦满足或者T，t命令，将导致分支到带有标号的命令处，或者到脚本的末尾。<br>
T label <br>
错误分支，从最后一行开始，一旦发生错误或者T，t命令，将导致分支到带有标号的命令处，或者到脚本的末尾。<br>
w file <br>
写并追加模板块到file末尾。<br>
W file <br>
写并追加模板块的第一行到file末尾。<br>
! <br>
表示后面的命令对所有没有被选定的行发生作用。<br>
s/re/string <br>
用string替换正则表达式re。<br>
= <br>
打印当前行号码。<br>
# <br>
把注释扩展到下一个换行符以前。<br>
以下的是替换标记<br>
g表示行内全面替换。<br>
p表示打印行。<br>
w表示把行写入一个文件。<br>
x表示互换模板块中的文本和缓冲区中的文本。<br>
y表示把一个字符翻译为另外的字符（但是不用于正则表达式）<br>
4. 选项<br>
-e command, --expression=command <br>
允许多台编辑。<br>
-h, --help <br>
打印帮助，并显示bug列表的地址。<br>
-n, --quiet, --silent <br>
取消默认输出。<br>
-f, --filer=script-file <br>
引导sed脚本文件名。<br>
-V, --version <br>
打印版本和版权信息。<br>
5. 元字符集<br>
^ <br>
锚定行的开始 如：/^sed/匹配所有以sed开头的行。<br>
$ <br>
锚定行的结束 如：/sed$/匹配所有以sed结尾的行。<br>
. <br>
匹配一个非换行符的字符 如：/s.d/匹配s后接一个任意字符，然后是d。<br>
* <br>
匹配零或多个字符 如：/*sed/匹配所有模板是一个或多个空格后紧跟sed的行。<br>
[] <br>
匹配一个指定范围内的字符，如/[Ss]ed/匹配sed和Sed。<br>
[^] <br>
匹配一个不在指定范围内的字符，如：/[^A-RT-Z]ed/匹配不包含A-R和T-Z的一个字母开头，紧跟ed的行。<br>
/(../) <br>
保存匹配的字符，如s//(love/)able//1rs，loveable被替换成lovers。<br>
& <br>
保存搜索字符用来替换其他字符，如s/love/**&**/，love这成**love**。<br>
/< <br>
锚定单词的开始，如://<br>
/> <br>
锚定单词的结束，如/love/>/匹配包含以love结尾的单词的行。<br>
x/{m/} <br>
重复字符x，m次，如：/0/{5/}/匹配包含5个o的行。<br>
x/{m,/} <br>
重复字符x,至少m次，如：/o/{5,/}/匹配至少有5个o的行。<br>
x/{m,n/} <br>
重复字符x，至少m次，不多于n次，如：/o/{5,10/}/匹配5--10个o的行。<br>
<br>
";
?>
</body><html>
