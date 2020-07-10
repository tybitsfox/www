<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<center><font size=6 color=#0000ff> VIM杂记</font></center><hr width= 80% size=2>";
echo "<center><font size=5 color=#ff0000>一、vim中查看c函数帮助</font></center>";
echo "<br><table border=0 width=100%><tr width=100%><td width=10%></td><td width=80%><font size=4 color=black><pre>
在vim中编辑c源程序时，如果需要查询标准库函数，可以将光标停在所需查询的函数名字上，然后按shitf+k(大写K)即可显示该函数的帮助。
有些函数与linux的命令重复虽然有帮助，可能在shell下以man 2 write的形式查询。此时，在vim中如果仅按上述步骤查询得不到需要的结
果，这时可以将光标停在需查询的函数名字上，先按2，然后再shift+k即可.</pre></font></td><td width=10%></td></tr></table>";
echo "<hr width=80% size=2><center><font size=5 color=#ff0000>二、.vimrc的常用设置</font></center>";
echo "<br><table border=0 width=100%><tr width=100%><td width=10%></td><td width=80%><font size=4 color=black><pre>
 \"中文help
 if version >= 603
 set helplang=cn
 endif 
 \"设置编码和文件编码
 set enc=utf-8
 set fenc=utf-8
 \"设置脚本编码
 scriptencoding utf-8
 \" 设置文件编码检测类型及支持格式
 set fencs=utf-8,ucs-bom,gb18030,gbk,gb2312,cp936
 \"取消vi兼容，即响应方向键和退格键：freebsd7.2默认的设置就是compatible,应添加nocp
 set nocp
 \"语法加亮：
 syntax enable
 \"不要修改tabstop,下面的两项设置可以保证tabstop和shiftwidth的一致。
 \"set softtabstop=4
 \"在gentoo上出现一个问题，使得我还是直接修改tabstop
 \"因为在makefile中softtabstop会使make出现错误.
 set tabstop=4
 set shiftwidth=4
 \"设置颜色方案：
 \"colorscheme evening
 \"设置C方式的空格显示
 set cindent
 \"set ruler 显示光标所在的行列位置坐标
 set ru
 \"设置查询关键字的高亮显示，取消用 noh
 set hls
 \"设置行号:
 set nu
 \"设置代码折叠:使用的标记为：//{{{ //}}}
 set fdm=marker
 \"设置编写代码所在行始终在距最底行10行：
 set scrolloff=10
 \"注意：上面的设置必须有10行以上的空格行才有效。
 set tw=142
 \"tw=textwidth,设置自动换行每行的长度
 set fo+=mM
 \"fo=formatoptions,设置亚洲字在换行中的分割。
 \" m - Also break at a multi-byte character above 255. This is useful for
 \" Asian text where every character is a word on its own.
 \" M - When joining lines, don't insert a space before or after a
 \" multi-byte character. Overrules the 'B' flag.
 \"set formatoptions+=mM
 \" 对已经存在的文本，不做自动换行处理，只有新输入文本的才会触发。
 \" 如要对已存在的文本应用自动换行，只要选中它们，然后按gq就可以了。

</pre></font></td><td width=10%></td></tr></table>";
echo "<hr width=80% size=2><center><font size=5 color=#ff0000>三、.vimrc中文帮助文档的下载安装</font></center>";
echo "<br><table border=0 width=100%><tr width=100%><td width=10%></td><td width=80%><font size=4 color=black><pre>
下载地址：http://sourceforge.net/project/showfiles.php?group_id=56777
下载后解压：tar xzvf vimcdoc-1.7.0.tar.gz
进入目录：vimcdoc-1.7.0;运行 ./vimcdoc.sh -i 即可自动安装完成。
</pre></font></td><td width=10%></td></tr></table>";
echo "<hr width=80% size=2><center><font size=5 color=#ff0000>四、vim常用操作</font></center>";
echo "<table border=0 width=100%><tr width=100%><td width=10%></td><td width=80%><font size=4 color=black>
<pre><font size=4 color=red><一>VIM中常用的替换模式总结</font>
1，简单替换表达式
替换命令可以在全文中用一个单词替换另一个单词：
:%s/four/4/g
“%” 范围前缀表示在所有行中执行替换。最后的 “g” 标记表示替换行中的所有匹配点。如果仅仅对当前行进行操作，那么只要去掉%即可
如果你有一个象 “thirtyfour” 这样的单词，上面的命令会出错。这种情况下，这个单词会被替换成”thirty4〃。
要解决这个问题，用 “\&lt;” 来指定匹配单词开头：
:%s/&lt;four/4/g
显然，这样在处理 “fourty” 的时候还是会出错。用 “\&gt;” 来解决这个问题：
:%s/&lt;four&gt;/4/g
如果你在编码，你可能只想替换注释中的 “four”，而保留代码中的。由于这很难指定，可以在替换命令中加一个 “c”
标记，这样，Vim 会在每次替换前提示你：
:%s/&lt;four&gt;/4/gc
:%s/b.*a//g		这是查找bxabxa字符串并替换为空的操作，注意，这个替换是最大替换
:%s/b.\{-}a//g  这是上述操作的最小替换，也就是上例中替换到dxa,而非dxadxa
2、在指定范围内查找：在行1至行50之间查找‘aaa‘：/\%&gt;1l\%&lt;50laaa
3、在指定范围内查找替换：在行9至行16之间查找并替换：9,16s/four/aaaa/g
4、在行首或者行尾加入某字符：
	:% s/^/\/\//g     在全部内容的行首添加//号注释
	:2,50 s/^/\/\//g  在2~50行首添加//号注释
	:2,50 s/^\/\///g  在2~50行首删除//号
	:%s/<\/p>/<\/p>\\r/g 在每个<\/p>后面加换行
解释：
	% 代表针对被编辑文件的每一行进行后续操作
	$ 代表一行的结尾处
	^ 代表一行的开头处
5、删除dos结束符： :%s/^M//g
   ^M的输入为：ctrl+v ctrl+m
<font size=4 color=red>&lt;二&gt; 拷贝, 删除与粘贴</font>
在 vi 中 y 表示拷贝, d 表示删除, p 表示粘贴. 其中拷贝与删除是与光标移动命令
结合的, 看几个例子就能够明白了.
yw 表示拷贝从当前光标到光标所在单词结尾的内容.
dw 表示删除从当前光标到光标所在单词结尾的内容.
y0 表示拷贝从当前光标到光标所在行首的内容.
d0 表示删除从当前光标到光标所在行首的内容.
y$ 表示拷贝从当前光标到光标所在行尾的内容.
d$ 表示删除从当前光标到光标所在行尾的内容.
yfa 表示拷贝从当前光标到光标后面的第一个a字符之间的内容.
dfa 表示删除从当前光标到光标后面的第一个a字符之间的内容.
特殊地:
yy 表示拷贝光标所在行.
dd 表示删除光标所在行.
D 表示删除从当前光标到光标所在行尾的内容.
<font size=4 color=blue>删除包含特定字符的行:g/pattern/d  例如删除空行的操作：g/^$/d
删除不包含指定字符的行：v/pattern/d
                        g!/pattern/d
删除指定的行：
:x,.d #从ｘ行删除到当前行；
:.,xd #从当前行删除到x行；
:x,.+3d #从x行删除到当前行后第三行；
:x,.-1d #从x行删除到当前行前一行。</font>
关于拷贝, 删除和粘贴的复杂用法与寄存器有关, 可以自行查询.
<font size=4 color=red>&lt;三&gt; 数字与命令</font>
在 vi 中数字与命令结合往往表示重复进行此命令, 若在扩展模式的开头出现则表示行
号定位. 如:
5fx 表示查找光标后第 5 个 x 字符.
5w(e) 移动光标到下五个单词.
5yy 表示拷贝光标以下 5 行.
5dd 表示删除光标以下 5 行.
y2fa 表示拷贝从当前光标到光标后面的第二个a字符之间的内容.
:12,24y 表示拷贝第12行到第24行之间的内容.
:12,y 表示拷贝第12行到光标所在行之间的内容.
:,24y 表示拷贝光标所在行到第24行之间的内容. 删除类似.
<font size=4 color=red>&lt;四&gt;分割窗口</font>
使用split或vsplit指定分割窗口的大小可以：
：5sp makefile --横向分割窗口，新窗口占用5行
:10vsp makefile --纵向分割窗口，新窗口占10列
分割窗口的大小调整:
1、横向分割的窗口，调整窗口的高度：
n Ctrl+w + or -
n为增加或减少的行数，＋增加，－减少。不加n每次增减一行。
2、纵向分割的窗口，调整窗口的宽度：
n Ctrl+w &gt; or &lt;
n为增加或减少的列数，&gt;增加，&lt;减少。 不加n每次增减一列。
CTRL-W w 命令可以用于在窗口间跳转。
由于你可以用垂直分割和水平分割命令打开任意多的窗口，你就几乎能够任意设置窗口的
布局。接着，你可以用下面的命令在窗口之间跳转：

CTRL-W h 跳转到左边的窗口
CTRL-W j 跳转到下面的窗口
CTRL-W k 跳转到上面的窗口
CTRL-W l 跳转到右边的窗口

CTRL-W t 跳转到最顶上的窗口
CTRL-W b 跳转到最底下的窗口
如果你用的是垂直分割，CTRL-W K 会使当前窗口移动到上面并扩展到整屏的宽度。
还有三个相似的命令：
CTRL-W H 把当前窗口移到最左边
CTRL-W J 把当前窗口移到最下边
CTRL-W L 把当前窗口移到最右边
按标号在各分屏窗口间跳转:
窗口的编号是固定的，顺序为：
1 |4 |7 | 
--|--|--|
2 |5 |8 |
--|--|--|
3 |6 |9 |
不管你现在在哪个窗口，如果你想直接跳转到窗口8可以：8 CTRL_w w。
将分割窗口加入标签页：
如果有分割窗口可以将任意一个窗口加到标签页：在活动窗口下CTRL-W T即可。
标签页的操作：
:tabnew 打开新的标签页		:tabn,tabp 在多个标签页之间跳转
:tabc 关闭当前标签页		:tabo 关闭所有标签页。
gt 在各标签页之间跳转，前面可加上标签页的序号，比如：3gt
<font size=4 color=red>&lt;五&gt; 移动与定位操作</font>
0:移动到光标所在行的行首
$:移动到光标所在行的行尾
g0,g$:移动到光标所在行的行首和行尾，分行显示的行仅在子行内移动。
gg:移动到文档起始位置
G:移动到文档结束位置
%:查找匹配的括号(),[],{}
你可以在文件中做些标记再随时返回被标记的位置.
m char (MARK) 把这个地方标示成 char
' char 跳到被标为 char的那一行
'' (按两次') 回到刚才的位置
char 可以是小写的 a-z中的任一个 . 一个标记在除了下面的这两种情况
外会一直存在:
1) 重覆使用相同的标示 char .
2) 删掉了被标示的那一行.

[[ 跳往上一个函式
]] 跳往下一个函式

<font size=4 color=red>&lt;六&gt; 在复制文件内容时防止多加入的缩进和空格</font>
1、在拷贝前输入：set paste (进入纯拷贝粘贴状态)，然后拷贝。
2、拷贝完成后，输入：set nopaste (关闭paste)。
<font size=4 color=red>&lt;七&gt; 代码编写时的缩进和格式调整</font>
1、全文缩进的格式调整：gg=G;
2、部分代码段的缩进调整：
（1）&lt;visual&gt;＝，进入v可视模式，选择要调整的代码段，按=;
（2）对光标所在行开始的n行进行调整，n=&lt;enter&gt;或者n==或者=n&lt;enter&gt;或者==n</font></td><td width=10%></td></tr></table></pre>";
echo "<hr width=80% size=2><center><font size=5 color=#ff0000>五、VIM的寄存器使用</font></center>";
echo "<table border=0 width=100%><tr width=100%><td width=10%></td><td width=80%><font size=4 color=black><pre>
vim寄存器使用详解
Vim中最常用到的是数字寄存器。当不指定寄存器时，复制操作的内容被保存到\"0，删除操作的内容被”压“到\"1，同时原
先\"1的内容转到\"2，依此类推，原先\"8转到\"9，原先\"9的内容丢失。如果指定操作的寄存器，如\"ayy和\"bdd，则上
述的数字寄存器无影响（有些例外情况，详见Vim手册）。未命名寄存器\"\"保存最近一次复制或删除操作内容，无论是否
指定寄存器。还有一个特殊的“黑洞”寄存器\"_，当指定其进行删除时，包括\"\"在内的任何寄存器都不受影响，当然，
你也没法把掉进黑洞的物质p出来。
【例1】复制－删除－粘贴
这是经常困扰Vim新手的一个问题：当复制了一个词（yw）然后准备将另外一个词替换掉，自然的想法是删除（dw）后粘
贴（p），但dw已经将\"\"更新为被删除的词，p的内容将不是复制的那个了。有几个办法以供选择：
        A. 先p后dw，问题是要重新定位需要删除的部分。你可以用gp/gP试试，它与p/P功能一样，不过光标停留在粘贴
           出的文字之后，便于随后的删除；
        B. 将删除内容转到黑洞（\"_dw），再p；
        C. 指定复制内容（\"0p）；
Vim中用\":寄存器记录最近一次运行的命令行命令，因此@:是重复上次的命令行操作。值得注意的是，@x宏运行的是
normal命令，而@:运行的是Ex命令。如果某个寄存器\"x保存的是Ex命令，你可以用:@x来执行。比如在测试vimrc中的某
条命令时，先yy，然后:@\"执行。
总结
上面介绍了大部分的寄存器，但没有提及\"*、\"+和\"~，这些寄存器是和GUI的选择和拖拽有关，有一个常见问题说一下：
如果希望和其它程序方便的复制粘贴，可以将剪贴板寄存器\"*设为未命名寄存器：
        :set clipboard=unnamed 注：在没有安装vim-gnome或者vim-full的时候该设置无效。
在复制粘贴时取消自动缩进的设置：
:set paste
进入paste模式以后，可以在插入模式下粘贴内容，不会有任何变形。这个真是灰常好用，情不自禁看了一下帮助，发现它做
了这么多事：
    * textwidth设置为0 
    * wrapmargin设置为0 
    * set noai
    * set nosi
    * softtabstop设置为0 
    * revins重置
    * ruler重置
    * showmatch重置
    * formatoptions使用空值
下面的选项值不变，但却被禁用：
    * lisp
    * indentexpr
    * cindent

只设置noai和nosi不行！
但这样还是比较麻烦的，每次要粘贴的话，先set paste，然后粘贴，然后再set nopaste。有没有更方便的呢？你可能想到了，使
用键盘映射呀，对。我们可以这样设置：: 

:map &lt;F10&gt; :set paste&lt;CR&gt;
:map &lt;F11&gt; :set nopaste&lt;CR&gt;

这样在粘贴前按F10键启动paste模式，粘贴后按F11取消paste模式即可。其实，paste有一个切换paste开关的选项，这就是pastet
oggle。通过它可以绑定快捷键来激活/取消 paste模式。比如：

:set pastetoggle=&lt;F11&gt;
这样减少了一个快捷键的占用，使用起来也更方便一些。
但，这是最方便的吗？Vimer们对高效的追求永无止境。还有其他更好地方法吗？
你可能想到了，vim寄存器。对，使用vim寄存器 “+p 粘贴即可。根本不用考虑是否自动缩进，是否paste模式，直接原文传递！: 
\"+p
要说vim寄存器，就要从vim文件间的复制粘贴说起。
Vim中，若要复制当前行，普通模式下按 yy 即可，在要粘贴的地方按 p 。这是vim将复制内容保存到了自己的寄存器中的缘故。
如果在其他地方执行yy，新的内容将覆盖掉原寄存器中内容。如果想保存原寄存器中内容而同时增加新的内容呢？这时就要在yy前
增加标签了。标签以双引号开始，跟着的是标签名称，可以是数字0-9，也可以是26个字母，然后就是复制操作，这样就把复制内
容保存到该标签寄存器里。通过下面命令显示所有寄存器内容：:
:reg
其中注意两个特殊的寄存器：”* 和 “+。这两个寄存器是和系统相通的，前者关联系统选择缓冲区，后者关联系统剪切板。通过它
们可以和其他程序进行数据交换。
备注：
    若寄存器列表里无”* 或 “+ 寄存器，则可能是由于没有安装vim的图形界面所致。Debian/Ubuntu下可以通过安装vim-gnome解
决。
    $ sudo apt-get install vim-gnome
选择缓冲区和系统剪切板啥子区别？让我们继续研究。
选择缓冲区和剪切板
不同于Windows，Linux系统里存在两个剪切板：一个叫做选择缓冲区(X11 selection buffer)，另一个才是剪切板(clipboard)。
选择缓冲区是实时的，当使用鼠标或键盘选择内容时，内容已经存在于选择缓冲区了，这或许就是选择缓冲区的由来吧。
使用下面的命令查看选择缓冲区的内容：:
$ xclip -out
如果没有xclip命令，Debian/Ubuntu下可以通过如下命令安装：:
$ sudo apt-get install xclip
可以使用鼠标中键或键入Shift+Insert来粘贴选择缓冲区的内容。但对于有些GUI程序，比如gedit，只能通过鼠标中键调用选择缓
冲区的内容，使用Shift+Insert的话，调用的是剪切板的内容。
剪切板和Windows的剪切板类似，在选择文字内容后，执行Ctrl + c或在菜单里选择‘复制’的话，这时内容才存放到剪切板里。
使用下面的命令查看剪切板的内容：:
$ xclip -out -sel clipboard
而使用剪切板的内容，则是Ctrl+v。 但在有些情况下，比如gnome-terminal，不能直接使用Ctrl+c，Ctrl+v，这时就要用Shift+C
trl+c，Shift+Ctrl+v代替。
原格式粘贴
好了，了解了选择缓冲区和剪切板，下面就是实现保留格式粘贴的完美解决方案：
* 方案一：
   1. 选择文本内容
   2. vim普通模式下按 “*p 将选择缓冲区中内容粘贴进来
* 方案二：
   1. 复制文件内容
   2. vim普通模式下按 “+ p 将剪切板内容粘贴进来
这时，如果要复制的内容也是vim编辑器中的内容，那么如何复制才更方便呢？
vim中的复制
vim有一个可视模式(Visual Mode)，在此模式下可以选择区域。可以在普通模式下键入v进入可视模式，也可以个性化一点，键入V
进入行可视模式，或者键入Ctrl+v进入列可视模式。这时移动光标就可以选择内容了。注意这时被选内容已经实时保存于选择缓冲
区了，当然你也可以键入”+y将此内容也保存到剪切板里，或者”ay将内容保存到标签为a的寄存器中。但要知道，只有前两个中的
内容可以在其他程序中使用，而a寄存器中的内容只能在该vim编辑器内使用。
也可以通过鼠标来复制。这里首先要打开鼠标模式。:
:set mouse=a
这样在普通模式下可以直接使用鼠标选择区域复制到选择缓冲区。但这种情况下不能复制到剪切板。
若要使用鼠标复制内容到剪切板，则需要做如下设置：:
:set mouse=v
这种情况下，除了可以像上面一样直接使用鼠标选择区域复制到选择缓冲区以外，还可以在右键菜单中选择“复制”来保存到剪切板
里。但新问题又出来了。若显示行号，也会将行号一并选择。你会想到，这好办呀，如果不需要行号的话，在复制前，先执行set
nonu来取消行号显示呗。
其实没必要这样，如果不需要复制行号的话，用在可视模式下用键盘来选择不就可以吗？
并且，从上面的讨论，我们不难得出，使用选择缓冲区比使用剪切板要方便的多，可以节省很多步骤。
所以，最终我们得到了vim文件间复制粘贴的完美方案，文件传输的中转使用选择缓冲区。
vim文件间复制粘贴完美方案
   1.
      在~/.vimrc中增加如下一行：:
      set mouse=v
   2.
      复制内容到选择缓冲区。
          * 带行号时，使用鼠标选择内容区域。
          * 不要行号，使用 “*yny 复制n行或可视模式下选择。
   3.
      将选择缓冲区中内容粘贴到vim文件：普通模式下按 “*p 。
</pre></font></td><td width=10%></td></tr></table>";

echo "<hr width=80% size=2><center><font size=5 color=#ff0000>六、VIM的ctags和taglist的使用</font></center>";
echo "<table border=0 width=100%><tr width=100%><td width=10%></td><td width=80%><font size=4 color=black><pre>
ctags:
浏览代码非常的方便, 可以在函数, 变量之间来回跳转
使用方法:
帮助文档：usr_29
在程序目录下执行： ctags -R 生成tags索引文件，注意在你源代码修改后或者添加了新的声明时需要重新执行该命令，否则
新增加的声明或者变量无法检索到。
把光标定位到某一函数或变量名上, 按下 Ctar + ], vim就可以自动切换到该函数或变量的定义处!
返回只需要按下Ctrl + T .
ctags --list-maps 可以查看默认支持的文件类型。如果有其默认不支持的文件类型，可使用下列命令添加：
ctags -R --langmap=Asm:+.inc
其中加号表示在默认文件类型上追加新的文件类型，没有加号的话仅会支持你添加的类型。
对于重复定义的条目进行查找时，如果仅仅使用Ctrl+],则只会显示第一条，其余条目不能显示，此时，可以用下列方法实现：
1、按g,然后在Ctrl+],此时会显示所有重复的条目供你选择，
2、使用命令：tj tag (tag为你要查找的条目),这条命令的结果与上面按g再Ctrl+]一样，给出一个列表供你选择，
3、使用命令：ta tag 后，再使用tn命令，可跳转至下一条重复的条目。
ctags的跳转和返回操作类似与堆栈的压入和弹出操作，所以，ta,tj,Ctrl+] 相当与入栈操作，Ctrl+T,pop则相当与弹出操作。
更多的ctags可使用 :help tag 查看。


TagList 插件:
下载地址：<a href=http://www.vim.org/scripts/script.php?script_id=273 target=_blank>http://www.vim.org/scripts/script.php?script_id=273</a>

高效地浏览源码, 其功能就像vc中的workpace, 那里面列出了当前文件中的所有宏,全局变量, 函数名等.
使用方法:
帮助文档：taglist.txt
进入vim后用下面的命令打开taglist窗口::Tlist
为了更方便地使用, 可以在.vimrc文件中加入:
let mapleader=\",\"
map &lt;silent&gt; &lt;leader&gt;tl :TlistToggle&lt;CR&gt;
这样就可以用 \",tl\" 命令进行taglist窗口的打开和关闭之间方便切换了.
这里的\",\"是我.vimrc设置的leader, 你也可以设置成别的, 在.vimrc中修改即可：let mapleader=\",\"

在taglist窗口中，可以使用下面的快捷键：

&lt;CR&gt;          跳到光标下tag所定义的位置，用鼠标双击此tag功能也一样
o             在一个新打开的窗口中显示光标下tag
&lt;Space&gt;       显示光标下tag的原型定义
u             更新taglist窗口中的tag
s             更改排序方式，在按名字排序和按出现顺序排序间切换
x             taglist窗口放大和缩小，方便查看较长的tag
+             打开一个折叠，同zo
-             将tag折叠起来，同zc
*             打开所有的折叠，同zR
=             将所有tag折叠起来，同zM
[[            跳到前一个文件
]]            跳到后一个文件
q             关闭taglist窗口
&lt;F1&gt;          显示帮助 
</pre></font></td><td width=10%></td></tr></table>";

echo "<hr width=80% size=2><center><font size=5 color=#ff0000>七、gvim的简单使用</font></center>";
echo "<table border=0 width=100%><tr width=100%><td width=10%></td><td width=80%><font size=4 color=black><pre>
1、配置文件：gvim依然使用vim默认的配置：~/.vimrc，一些gui独有的设置可直接添加至上述配置文件中，如：
\"gvim 去除工具栏
set guioptions-=T
\"gvim 去除菜单栏
set guioptions-=m
\"gvim 除右边滚动条
set guioptions-=r
\"设定在任何模式下鼠标都可用
\"set mouse=a 
\"设置用于GUI图形用户界面的字体列表。
set guifont=SimSun\ 12  
\"当禁止了声音提示后，gvim默认会使用闪屏提示，关闭闪屏提示的设置为：
au GuiEnter * set t_vb=
-------以上基本就是我在gvim下所需的设置了-------
在我看来gvim最大的好处就是可以使用更加丰富的配色，从而使界面配色更加柔和，仅此而已。
另外，如果你使用fcitx输入法，那么gvim在退出时还有个小小的瑕疵：就是退出后会有诸如：
(gvim:9719): Gdk-CRITICAL **: IA__gdk_cairo_region....这样的警告提示，虽然不影响使用，但是略显不完美。
经过我个人测试，这个警告并不总是出现，当时用菜单项的退出时，不会出现这个警告，但是在使用:q命令退出时就会
出现。通过在网上查找，发现该错误的产生是由于和fcitx输入法的gtk2前端有冲突，在我的机器上，查看fcitx安装的
相关包：aptitude search fcitx 可发现确实安装有fcitx-frontend-gtk2，而且还有fcitx-frontend-gtk3的包。
使用命令：apt-get remove fcitx-frontend-gtk2 卸载掉该包，问题就可完美解决，并且不会对fcitx造成影响。
</pre></font></td><td width=10%></td></tr></table>";
echo "<hr width=80% size=2><center><font size=5 color=#ff0000>八、xterm和vim256色的使用</font></center>";
echo "<table border=0 width=100%><tr width=100%><td width=10%></td><td width=80%><font size=4 color=black><pre>
首先，确保系统已经安装了相关的支持：
find /lib/terminfo /usr/share/terminfo -name \"*256*\"  如果没有相应文件，则安装：
aptitude install ncurses-term
aptitude install ncurses-base
如使用xterm时，此时上述查找目录中应该有xterm-256color文件,此时若要使得256色生效还需一些配置：
方法一：
编辑 ~/.Xdefaults文件，添加：
*customization: -color
XTerm*termName:  xterm-256color
保存退出后执行：xrdb -merge ~/.Xdefaults
测试目前支持的颜色数：
tput colors
应该显示为256,查看变量TERM echo $TERM 应该显示的是xterm-256color
该方法测试可行，但是不能开机自动加载。
方法二：
编辑 ~/.bashrc文件，添加：
export TERM=xterm-256color
该方法能保证登录后自动设置为256色
方法三：
编辑 ~/.Xresources,添加：
XTerm*termName:  xterm-256color
该方法也能保证自动加载设置


这里是我搜罗的一些<a href='./colors.tar.bz2'>漂亮的配色方案</a>，其中在vim下我最喜欢吸血鬼的
主题（dracula）,在gvim下也有一个漂亮的solarized配色。

</pre></font></td><td width=10%></td></tr></table>";
?>





