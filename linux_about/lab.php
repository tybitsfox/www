<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<center><font size=5 color=#0000ff>杂项记录</font></center><br>";
echo "目录：<br>";
echo "<table border=0 width=100%><tr><td width=20%><a href=./lab.php#lab01>lsof用法</a></td><td width=20%><a href=./lab.php#lab02>服务加载项管理工具：sysv-rc-conf</a></td>
<td width=20%><a href=./lab.php#lab03>awesome取得正确的类名称</a></td><td width=20%><a href=./lab.php#lab04>X环境下更改屏幕分辨率、刷新频率的命令</a></td>
<td width=20%><a href=./lab.php#lab05>挂接ntfs分区的说明</a></td></tr><tr>
<td width=20%><a href=./lab.php#lab06>安装mplayer</a></td><td width=20%><a href=./lab.php#lab07>编写linux共享库</a></td><td width=20%><a href=./lab.php#lab08>Wine Gecko</a>
</td><td width=20%><a href=./lab.php#lab09>kde下开机自动运行</a></td><td width=20%><a href=./lab.php#lab10>c代码中实现清屏的代码</a></td></tr>
<tr><td width=20%><a href=./lab.php#lab11>asm指令表</a></td><td width=20%><a href=./lab.php#lab12>字符串定义</a></td><td width=20%><a href=./lab.php#lab13>
挂载freebsd分区的做法</a></td><td width=20%><a href=./lab.php#lab14>RPM</a></td><td width=20%><a href=./lab.php#lab15>yum install</a></td></tr>
<tr><td width=20%><a href=./lab.php#lab16>fceu 安装及配置</a></td><td width=20%><a href=./lab.php#lab17>midi播放</a></td><td width=20%><a href=./lab.php#lab18>wine相关</a>
</td><td width=20%><a href=./lab_a.php#asm1601 target=_blank>生成16位汇编代码的方法</a></td><td width=20%><a href=./lab_a.php#asm1602 target=_blank>获得系统相关信息的方法
</a></td></tr><tr>
<td width=20%><a href=./lab_a.php#asm1603 target=_blank>firefox+vimperator打造文件资源管理器</a></td>
<td width=20%><a href=./lab_a.php#asm1604 target=_blank>字体设置、查看相关命令</a></td>
<td width=20%><a href=./lab_a.php#asm1605 target=_blank>linux下多机种模拟器mednafen介绍</a></td>
<td width=20%><a href=./lab_a.php#asm1606 target=_blank>mysql记录中文乱码</a></td>
<td width=20%><a href=./lab_b.php target=_blank>服务器建设笔记</a></td></tr>
<tr>
<td width=20%><a href=./lab_b.php#server02 target=_blank>ip摄像头视频流的相关操作</a></td>
<td width=20%><a href='./b50.php' target=_blank>HTML颜色表</a></td>
<td width=20%><a href='./android.php' target-_blank>连接安卓设备</a></td>
<td width=20%></td>
<td width=20%></td>
</tr></table>";
echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
echo "<a name=lab01></a><font color=#ff0000>lsof用法: 例如查询tcp3306端口的状态： lsof -i:3306</font><br>";
echo "<font color=#0000ff>打包的命令</font><br><pre>
tar -cvf &lt;createfilename.tar&gt; &lt;sourcefile or directory&gt;
压缩：
gzip createfilename.tar
tar -cvzf &lt;createfilename.tar&gt; &lt;sourcefile or directory&gt;
解压缩并拆包：
tar -xzvf filename.tar.gz
bzip2格式打包压缩：tar -cjvf createfilename.tar.bz2 sourcefile or directory
bzip2压缩包解压：  tar xjvf createfilename.tar.bz2
</pre><br>";
echo "<a name=lab02></a><font color=#0000ff>服务加载项管理工具：sysv-rc-conf<br>";
echo "<a name=lab03></a>awesome取得正确的类名称:<br><font color=#ff0000>xprop | grep --color=none \"WM_WINDOW_ROLE\|WM_CLASS\" | xmessage -file - -center<br>";
echo "<a name=lab04></a><font color=#0000ff><pre>
X环境下更改屏幕分辨率、刷新频率的命令
xrandr指令可以用来改变X环境的桌面大小和萤幕频率.
把桌面解析度调成1024×768:
xrandr -s 1024x768
把萤幕频率调成75Hz
xrandr -r 75
列出目前环境支援的解析度和频率
xrandr -q
它列出的讯息, 每行的第一个数字可以用来指定给 -s 参数, 假设有一行这麼写
20 640 x 480 ( 347mm x 260mm ) 75
那麼下
xrandr -s 20
时, 就会把萤幕调成 640×480 大小, 频率75Hz
如果有数个X环境同时运作的话, 可以用 -d 参数去调整别的X环境, -d 后面加的是像 :0 :1 :2 这样, 例如:
xrandr -s 800x600 -d :0</pre><br>";
echo "<a name=lab05></a><font color=#00ff00>挂接ntfs分区的说明<br><pre>
1、更新软件包：
yum install ntfs-3g
2、使用命令：fdisk -l查看可挂接的分区
3、mount -t ntfs-3g /dev/sda6 /mnt/winsys
</pre></font><br>";
echo "<a name=lab06></a><font color=#0000ff>安装mplayer</font><br><font color=#ff00ff><pre>
下载安装mplayer需要的各种软件
去这里下载http://www.mplayerhq.hu/MPlayer/
MPlayer-1.0rc1.tar.bz2
下载你喜欢的skin
例如你下载 Abyss-1.6.tar.bz2
下载必需的code
all-20061022.tar.bz2
windows-all-20060611.zip
2进行安装
（1）安装相信泊解压(code)
mkdir /usr/lib/codecs
mkdir /usr/lib/wincodecs
tar jxvf all-20060611.tar.bz2
mv all-20060611/* /usr/lib/codecs
unzip windows-all-20060611.zip
mv windows-all-20060611/* /usr/lib/wincodecs
(2安装mplayer
tar jxvf MPlayer-1.0rc1.tar.bz2
cd MPlayer-1.0rc1
./configure --prefix=/usr/local/mplayer --enable-gui --enable-freetype --with-codecsdir=/usr/lib/codecs/ 
--with-win32libdir=/usr/lib/wincodecs/ --language=zh_CN
注意:
--prefix=/usr/local/mplayer 是安装路径
--enable-gui 安装图形化用户界面
--enable-freetype 调节字体
--with-codecsdir=/usr/lib/codecs/
--with-win32libdir=/usr/lib/wincodecs 指定解码位置
--language=zh_CN 中文
接着
make
make install
(3)安装skin
tar jxvf Abyss-1.6.tar.bz2
mv Abyss /usr/local/mplayer/share/mplayer/skins/
cd /usr/local/mplayer/share/mplayer/skins/
mv Abyss default
(4调试)
cd /usr/local/mplaer/bin/
./gmplaer
打开一个文件播放试一下
看看有些格式的是不是能插放
你就从自己电脑中拷个字体到主目录下的.mplayer文件夹下，并把你的字体改名为subfont.ttf,问题就解决了，或者做个链接也行,只要你喜欢
字体你可以上网下载，mplayer网站也有，你电脑里也有字体，在/usr/share/fonts/chinese下（/usr/share/fonts/chinese/TrueType/uming.ttf就可以用）
你就直接cp /usr/share/fonts/chinese/TrueType/uming.ttf \$HOME/.mplayer下
每个用户都有自己的环境变量HOME,再cd \$HOME/.mplayer 接着
mv uming.ttf subfont.ttf 结束！
</pre></font><br>";
echo "<a name=lab07></a><font color=#ff0000>编写linux共享库</font><br><pre>
    晚上尝试着编写linux平台下的共享库，做一个产品研发的前期技术探讨，毕竟以前从来没有编写过。Linux的共享库基本上等同于windows下的动态链接库，是实现
代码共享的有效手段。我在FC6上装了eclipse3.2+CDT，创建一个受管的C++共享库工程，在里面实现了两个简单的函数。然后创建一个受管的C++可执行程序，设定依赖
于第一个共享库工程，最后在链接器设置中加入共享库以及其路径。在linux下共享库的名字是有规定的，即必须以lib起头，例如我的这个共享库名字就是libTestDll.so
。在编译可执行程序时，如果使用这个共享库，则gcc/g++的参数中要包含-lTestDll。注意前面的lib前缀和.so都不能写在这里。看起来一切都很好，不是吗？可惜当我
在终端运行编译好的可执行程序时却出现了错误提示：
      Error: cannot restore segment prot after reloc: Permission denied
    最让我郁闷的是如果用eclipse调试却一点问题都没有。在网上找了半天，发现很多人都遇到了这个问题，似乎是SELinux造成的。最终在ITT的网站上找到了解决方
案。原来很多新的linux发行版都使用了SELinux，新的linux安全扩展。这个扩展能够更加细致的控制系统的安全，但是却会修改一些系统的默认行为，共享库的加载就
是其中一个例子。解决方法有两个：
    1. 修改共享库的缺省的安全环境：
    chcon -t texrel_shlib_t /usr/lib/libTestDll.so
  2. 在配置文件中使SELinux无效：
   vi /etc/sysconfig/selinux
   在文件中设置 SELINUX=disabled
  修改完后再运行编译的可执行程序，哈哈，一点问题都没有！
一. 动态链接库的原理及使用 大家对Windows操作系统中的DLL文件一定十分熟悉，其实这种软件组件化的方法在Linux中也可以实现。其实插件和 DLL 
通常是用来无须编写整个新应用程序而添加功能的极好方法，一般来讲，在不更改原有应用程序的情况下，插件为现有应用程序提供新功能。Linux环境下甚至做的更好。
Linux提供4个库函数、一个头文件dlfcn.h以及两个共享库（静态库libdl.a和动态库libdl.so）支持动态链接。
·dlopen：打开动态共享目标文件并将其映射到内存中，返回其首地址 
·dlsym：返回锁请求的入口点的指针 
·dlerror：返回NULL或者指向描述最近错误的字符串
·dlclose：关闭动态共享文件函数dlopen需要在文件系统中查找目标文件并为之创建句柄。
有四种方法指定目标文件的位置： 
·绝对路径 ·在环境变量LD_LIBRARY_PATH指定的目录中 
·在/etc/ld.so.cache中指定的库列表中 
·在/usr/lib或者/lib中
下面举一个例子。主程序文件hello.c：   函数dlopen的第二个参数有两种选择： 
·RTLD_LAZY：推迟解析DLL中的外部引用，直到DLL被执行 
·RTLD_NOW：在返回之前解析所有的外部引用 以下是DLL文件源码slib.c：
#include
#include
   void* slib=0; 
   void (*func)(char*);
   const char* hError;
   int main(int argc,char* argv[])
 {
     slib=dlopen(\"./slib.so\",RTLD_LAZY);
     hError=dlerror();
     if (hError)
     {
         printf(\"dlopen Error!＼n\");
         return 1;
     }
     func=dlsym(slib,\"func\");
     hError=dlerror();
     if (hError)
     {
         dlclose(slib);
         printf(\"dlsym Error!＼n\");
         return 1;
     }
     func(\"How do you do?＼n\");
     dlclose(slib);
     hError=dlerror();
     if (hError)
     {
         printf(\"dlclose Error!＼n\");
         return 1;
     }
     return 0;
 }
so files:
int func(char* msg)
 {
     printf(\"func be Executed!＼n\");
     printf(msg);
     return 0;
 }
是不是很简单？ 源代码写好后，在编译和链接时有点复杂。为此，我们编写了一个makefile：
all:hello slib.so 
hello:
        gcc -o hello hello.c -ldl 
slib.so:slib.o
        gcc -shared -lc -o slib.so slib.o 
slib.o:
        gcc -c -fpic slib.c
  生成这个程序需要三步： ·将DLL编译为位置无代码 ·创建DLL共享目标文件 ·编译主程序并与DLL相链接
编译slib.c时，使用了-fpic或者-fPIC选项，使生成的代码是位置无关的，因为重建共享目标库需要位置无关，并且这类代码支持大的偏移。
创建DLL共享目标文件时使用了-shared选项，该选项产生适合动态链接的共享目标文件slib.so。
生成主程序时，使用-ldl选项，这是链接选项，即主程序中的部分符号为动态链接库中的符号，也就是说，在运行时需要到dll文件中才能够解决引用。
二.通用类型的动态函数库的建立Linux操作系统和各种软件包为软件开发人员提供了很多的动态函数库文件。但是一般情况下这些库还不能满足用户的所有需求。开发
人员会根据自己的需要编写很多的函数。对于这些函数，如果总是将源文件与调用它们的程序链接起来，虽然也可以，但是，缺点是显然的。下面就将它们加入动态函
数库中。在Linux中，建立动态函数库不需要额外的工具，只需要gcc就可以了。通过ldd命令可以很方便的察看程序用到了哪些库。下面通过一个简单的例子说明动态
函数库的建立过程。文件mylib.c是函数库的源程序文件，内容如下: 
int myadd(int a1, int a2) { return a1+a2; }
  文件testlib.c是测试程序的源程序文件：
#incoude
 extern int myadd(int, int);
 int main()
 {
     printf(\“%d\\n\”,myadd(1, 2));
     return 0;
 }
  下面给出makefile的内容：  
  all:libmylib.so.1.0 testlib
   libmylib.so.1.0 : mylib.o
        ld –m elf_i386 –shared –soname libmylib.so.1 –o libmylib.so.1.0 mylib.o
        ln –sf libmylib.so.1.0 libmylib.so.1
        ln –sf libmylib.so.1 libmylib.so
   testlib : testlib.c
        gcc –Wall –O2 –L. –lmylib –o testlib testlib.c
   mylib.o : mylib.c
        gcc –c –Wall –O2 –fPIC –o mylib.o mylib.c   clean :        -rm –f libmylib.so* testlib *.o
  在Linux的shell中输入make命令，动态函数库libmylib.so.1.0和它的测试程序就生成了。运行./testlib试试看。
如果你不走运的话，系统会提示找不到libmylib.so.1动态函数库，因为系统认为没有这样的文件或目录。不要慌。你可能需要使用LD_LIBRARY_PATH环境变量。
[root@localhost home]export LD_LIBRARY_PATH=.:\$LD_LIBRARY_PATH 再运行一次测试程序吧。

</pre><br>";
echo "<a name=lab08></a><font color=#0000ff>Wine Gecko</font><br><pre>
当Wine程序需要显示HTML网页时，Wine就会弹出Wine Gecko Installer窗口要求安装Gecko,而它又要连到网上下载Gecko,对于网络不好或教育网的用户通常是安装
不了的。今天参考这篇文章：
http://appdb.winehq.org/appview.php?iVersionId=6422，解决了离线安装Wine Gecko的问题。步骤如下：
   1. 从http://source.winehq.org/winegecko.php下载 wine_gecko.cab
   2. \$ cp wine_gecko.cab \~/.wine/drive_c/
   3. \$ regedit
      修改 HKCU/Software/Wine/MSHTML 中的GeckoUrl为：C:\wine_gecko.cab,可参看附图1
   4. 接着执行需要HTML支持的程序，当弹出Wine Gecko Instalerl窗口时，点安装就行了，这是你会发现它瞬间就安装完成了。
   5. 删除wine_gecko.cab，\$ rm \~/.wine/drive_c/wine_gecko.cab
</pre><br>";
echo "<a name=lab09></a><font color=#00ff00>开机自动运行</font><br><pre>
关于开机自动运行的pup升级软件自动运行的测试：
我的系统在一开始启动的时候总是自动运行pup我一直没有找到他的启动配置在哪里？为了找出这个配置来，我写了一个小的软件用于在指定目录中搜索所有包含指定
字符串的搜索软件，根据查找的结果和从网上获得的关于启动的蛛丝马迹的说明，测试一下是否在这个目录中的puplet.desktop配置文件与他的启动有关？
该文件原来的存放位置为：
/etc/xdg/autostart/puplet.desktop
测试失败！于该文件无关！！恢复回去该文件
继续查找：
哈哈，哈哈，哈哈，～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～
mod at:
/root/.kde/share/config/ksmserverrc
count=1 =&gt;0
经过我不懈的努力终于搞掉了这个问题！！原来与pup启动相关的文件在这里。
</pre><br>";
echo "<a name=lab10></a><font color=#ff0000>c代码中实现清屏的代码:<pre>
\"\\033[2J\\033[1;1H\"
上面的字符串就是清屏字符串，printf(\"\\033[2J\\033[1;1H\")
</pre></font><br>";
echo "<a name=lab11></a><font color=#0000ff>linux asm</font><br><pre>

数据传输指令
───────────────────────────────────────
它们在存贮器和寄存器、寄存器和输入输出端口之间传送数据.
1. 通用数据传送指令.
MOV 传送字或字节.
MOVSX 先符号扩展,再传送.
MOVZX 先零扩展,再传送.
PUSH 把字压入堆栈.
POP 把字弹出堆栈.
PUSHA 把AX,CX,DX,BX,SP,BP,SI,DI依次压入堆栈.
POPA 把DI,SI,BP,SP,BX,DX,CX,AX依次弹出堆栈.
PUSHAD 把EAX,ECX,EDX,EBX,ESP,EBP,ESI,EDI依次压入堆栈.
POPAD 把EDI,ESI,EBP,ESP,EBX,EDX,ECX,EAX依次弹出堆栈.
BSWAP 交换32位寄存器里字节的顺序
XCHG 交换字或字节.( 至少有一个操作数为寄存器,段寄存器不可作为操作数)
CMPXCHG 比较并交换操作数.( 第二个操作数必须为累加器AL/AX/EAX )
XADD 先交换再累加.( 结果在第一个操作数里 )
XLAT 字节查表转换.
── BX 指向一张 256 字节的表的起点, AL 为表的索引值 (0-255,即
0-FFH); 返回 AL 为查表结果. ( [BX+AL]->AL )
2. 输入输出端口传送指令.
IN I/O端口输入. ( 语法: IN 累加器, {端口号│DX} )
OUT I/O端口输出. ( 语法: OUT {端口号│DX},累加器 )
输入输出端口由立即方式指定时, 其范围是 0-255; 由寄存器 DX 指定时,
其范围是 0-65535.
3. 目的地址传送指令.
LEA 装入有效地址.
例: LEA DX,string ;把偏移地址存到DX.
LDS 传送目标指针,把指针内容装入DS.
例: LDS SI,string ;把段地址:偏移地址存到DS:SI.
LES 传送目标指针,把指针内容装入ES.
例: LES DI,string ;把段地址:偏移地址存到ES:DI.
LFS 传送目标指针,把指针内容装入FS.
例: LFS DI,string ;把段地址:偏移地址存到FS:DI.
LGS 传送目标指针,把指针内容装入GS.
例: LGS DI,string ;把段地址:偏移地址存到GS:DI.
LSS 传送目标指针,把指针内容装入SS.
例: LSS DI,string ;把段地址:偏移地址存到SS:DI.
4. 标志传送指令.
LAHF 标志寄存器传送,把标志装入AH.
SAHF 标志寄存器传送,把AH内容装入标志寄存器.
PUSHF 标志入栈.
POPF 标志出栈.
PUSHD 32位标志入栈.
POPD 32位标志出栈.

二、算术运算指令
───────────────────────────────────────
ADD 加法.
ADC 带进位加法.
INC 加 1.
AAA 加法的ASCII码调整.
DAA 加法的十进制调整.
SUB 减法.
SBB 带借位减法.
DEC 减 1.
NEC 求反(以 0 减之).
CMP 比较.(两操作数作减法,仅修改标志位,不回送结果).
AAS 减法的ASCII码调整.
DAS 减法的十进制调整.
MUL 无符号乘法.
IMUL 整数乘法.
以上两条,结果回送AH和AL(字节运算),或DX和AX(字运算),
AAM 乘法的ASCII码调整.
DIV 无符号除法.
IDIV 整数除法.
以上两条,结果回送:
商回送AL,余数回送AH, (字节运算);
或 商回送AX,余数回送DX, (字运算).
AAD 除法的ASCII码调整.
CBW 字节转换为字. (把AL中字节的符号扩展到AH中去)
CWD 字转换为双字. (把AX中的字的符号扩展到DX中去)
CWDE 字转换为双字. (把AX中的字符号扩展到EAX中去)
CDQ 双字扩展. (把EAX中的字的符号扩展到EDX中去)

三、逻辑运算指令
───────────────────────────────────────
AND 与运算.
OR 或运算.
XOR 异或运算.
NOT 取反.
TEST 测试.(两操作数作与运算,仅修改标志位,不回送结果).
SHL 逻辑左移.
SAL 算术左移.(=SHL)
SHR 逻辑右移.
SAR 算术右移.(=SHR) 当值为负时，高位补 1 ；当值为正时，高位补 0
ROL 循环左移.
ROR 循环右移.
RCL 通过进位的循环左移.
RCR 通过进位的循环右移.
以上八种移位指令,其移位次数可达255次.
移位一次时, 可直接用操作码. 如 SHL AX,1.
移位>1次时, 则由寄存器CL给出移位次数.
如 MOV CL,04
SHL AX,CL

四、串指令
───────────────────────────────────────
DS:SI 源串段寄存器 :源串变址.
ES:DI 目标串段寄存器:目标串变址.
CX 重复次数计数器.
AL/AX 扫描值.
D标志 0表示重复操作中SI和DI应自动增量; 1表示应自动减量.
Z标志 用来控制扫描或比较操作的结束.
MOVS 串传送.
( MOVSB 传送字符. MOVSW 传送字. MOVSD 传送双字. )
CMPS 串比较.
( CMPSB 比较字符. CMPSW 比较字. )
SCAS 串扫描.
把AL或AX的内容与目标串作比较,比较结果反映在标志位.
LODS 装入串.
把源串中的元素(字或字节)逐一装入AL或AX中.
( LODSB 传送字符. LODSW 传送字. LODSD 传送双字. )
STOS 保存串.
是LODS的逆过程.
REP 当CX/ECX<>0时重复.
REPE/REPZ 当ZF=1或比较结果相等,且CX/ECX<>0时重复.
REPNE/REPNZ 当ZF=0或比较结果不相等,且CX/ECX<>0时重复.
REPC 当CF=1且CX/ECX<>0时重复.
REPNC 当CF=0且CX/ECX<>0时重复.

五、程序转移指令
───────────────────────────────────────
1>无条件转移指令 (长转移)
JMP 无条件转移指令
CALL 过程调用
RET/RETF过程返回.
2>条件转移指令 (短转移,-128到+127的距离内)
( 当且仅当(SF XOR OF)=1时,OP1 JA/JNBE 不小于或不等于时转移.
JAE/JNB 大于或等于转移.
JB/JNAE 小于转移.
JBE/JNA 小于或等于转移.
以上四条,测试无符号整数运算的结果(标志C和Z).
JG/JNLE 大于转移.
JGE/JNL 大于或等于转移.
JL/JNGE 小于转移.
JLE/JNG 小于或等于转移.
以上四条,测试带符号整数运算的结果(标志S,O和Z).
JE/JZ 等于转移.
JNE/JNZ 不等于时转移.
JC 有进位时转移.
JNC 无进位时转移.
JNO 不溢出时转移.
JNP/JPO 奇偶性为奇数时转移.
JNS 符号位为 \"0\" 时转移.
JO 溢出转移.
JP/JPE 奇偶性为偶数时转移.
JS 符号位为 \"1\" 时转移.
3>循环控制指令(短转移)
LOOP CX不为零时循环.
LOOPE/LOOPZ CX不为零且标志Z=1时循环.
LOOPNE/LOOPNZ CX不为零且标志Z=0时循环.
JCXZ CX为零时转移.
JECXZ ECX为零时转移.
4>中断指令
INT 中断指令
INTO 溢出中断
IRET 中断返回
5>处理器控制指令
HLT 处理器暂停, 直到出现中断或复位信号才继续.
WAIT 当芯片引线TEST为高电平时使CPU进入等待状态.
ESC 转换到外处理器.
LOCK 封锁总线.
NOP 空操作.
STC 置进位标志位.
CLC 清进位标志位.
CMC 进位标志取反.
STD 置方向标志位.
CLD 清方向标志位.
STI 置中断允许位.
CLI 清中断允许位.

六、伪指令
─────────────────────────────────────
DW 定义字(2字节).
PROC 定义过程.
ENDP 过程结束.
SEGMENT 定义段.
ASSUME 建立段寄存器寻址.
ENDS 段结束.

</pre><br>";
echo "<a name=lab12></a><font color=#00ffff>字符串定义</font><br><pre>
关于字符串定义中应注意的问题：
也许是我在基础学习中并不彻底的缘故，所以才在程式设计中被这些
小问题所困扰，还好由于本人超强的敏感性和悟性才会相继的发现这些问题，即便这样，我也不想在回头去看那些基本知识了，呵呵.....
程式设计中对字符串定义的形式方法有：
1、char *p;
这仅仅是定义一个字符串指针，在没有对其赋值前，没有意义。他的作用就是在设计中有需要保存的字符串指针可对其赋值。然后使用。
但是在使用还是有少许区别，这个区别是来自于下面两种对字符串的定义。
2、char *ch=\"asdfg\";
这种定义是对字符串定义的最特别的，他在使用中的表现最为特殊，很多字符串函数不能使用这种定义方法。比如memcpy、memfrob等等
这些对定义的缓冲区有修改的函数。因为这种定义不允许对ch作任何的修改。他的行为看起来更象是const定义的，他是一种不可修改的定义，所以，除非你在程式中不
想对这一定义进行修改或者重新赋值。否则不要使用该定义方式。可以使用第一中方式的指针指定该字符串的某一位置，但是，此时该指针也具有了该字符串的特性，
不能在对其进行修改。
3、char ch[]=\"asdfg\";
这种定义方式允许在程式设计中对内容进行修改，即一般的字符串操作函数都可以对其修改和重新赋值，但是最好不要越界，这个问题我还没有真正的测试过，如果使用1
中定义的字符串指针表达其中内容的话，该指针同样具有该字符串可以修改的特性。
还有一个问题，很久以前发现的，就是sizeof 和 strlen。对于2、3定义的缓冲区也有区别:
对于2中的定义如果使用sizeof取得长度的话，如果为如下定义：char *ch=\"hello world\";则sizeof取得的长度仅仅是空格前面的长度。
而对于3中的定义使用sizeof就可以取得真实的长度，而对于两种类型的定义，使用strlen都可以获得正确的长度。
</pre><br>";
echo "<a name=lab13></a><font color=#0000ff>挂载freebsd分区的做法</font><br><pre>
1、首先要确定你的内核是否支持unix分区：ufs
使用：cat  /proc/filesystem 查看是否有：ufs，没有则需编译内核
2、使用：grep bsd /var/log/dmesg 查看freebsd的slice和分区的对应关系。
 sda2: <bsd: sda9 sda10 sda11 sda12 sda13 >
3、使用：
mount -rt ufs -o ufstype=ufs2 /dev/sda9 /mnt/winsys
对freebsd分区的挂载好像只能是只读的。
</pre><br>";
echo "<a name=lab14></a><font color=#ff0000>RPM</font><br><pre>
在Terminal中，基本的安装指令如下：
rpm －i xv－3.10a－13.i386.rpm
如果现在安装过程中了解安装进度可是用：
rpm -ivh procname.rpm
如果你的连网速度足够快，也可以直接从网络上安装应用软件，只需要在软件的文件名前加上适当的URL路径：
rpm －i ftp://ftp.trilon.com/pub/xv/xv－3.10a－13.i386.rpm
作为一个软件包管理工具，RPM管理着系统已安装的所有RPM程序组件的资料。我们也可以使用RPM来卸载相关的应用程序。
rpm －e xv
RPM的常用参数还包括：
－vh：显示安装进度；
－U：升级软件包；
－qpl：列出RPM软件包内的文件信息；
－qpi：列出RPM软件包的描述信息；
－qf：查找指定文件属于哪个RPM软件包；
－Va：校验所有的RPM软件包，查找丢失的文件；
</pre><br>";
echo "<a name=lab15></a><font color=#ffff00>yum install<br><pre>
yum install xscreensaver
上面是安装新的屏幕保护的命令，yum真的很强悍
关于xmms的安装问题：
1、使用1.2..10版本。11版本不行总是提示glib版本过低。
2、使用yum install xmms安装
3、还要下载xmms-mp3和xmms-wma两个文件，不然的话，不能播放这两种格式的文件
关于realplay:
使用11版本安装：rpm -ivh realplay11.rpm
然后安装alsa-oss: yum install alsa-oss
二、使用yum进行卸载：
yum remove xmms
注：
xmms_mp3-1.2.10-16.i386.rpm应注意保存，没有该文件xmms无法播放mp3
</pre></font><br>";
echo "<hr color=green size=2 width=90%><br>";
echo "<a name=lab16></a><font size=5 color=red><center>fceu 安装及配置</center></font><br>";
echo "<font color=black><pre>";
echo "
debian中用fceu玩nes游戏，并自定义键位，解决图像卡等问题
1、安装nes模拟器
apt-get install fceu
2、玩游戏
fceu gamename
gamename是游戏的路径
3、如果只有图像没有声音
apt-get install alsa-oss oss-compat
提醒一下，Rhythmbox之类的程序会竞争oss audio device，同时开启这两种程序会令后开启的无声。
4、配置键位
fceu默认的键位是：
Keypad 2    B
Keypad 3    A
Enter/Return    Start
Tab    Select
Z    Down
W    Up
A    Left
S    Right
但估计大家有自己习惯的键位吧，所以得进行修改。
fceu的配置文件位于 ~/.fceultra/fceu98.cfg（这是一个二进制文件），如果不放心，请先备份。
方法一：
fceu -inputcfg gamepad1 somegame.nes
根据提示逐一修改每个键位，对每个键位都需要连续输入两次作为确认，这种修改据我测试是永久性的。
方法二：
直接修改配置文件
5、如果图像卡，可能是开启了opengl模式
解决方法：
fceu -opengl 0 gamename
</pre></font>";
echo "<hr color=green size=2 width=90%><br>";
echo "<a name=lab17></a><font size=5 color=red><center>midi播放</center></font><br>";
echo "<font color=black><pre>
转自-吾乃老W
midi格式的文件本身只相当于“曲谱”，和MP3那些直接将声音本体记录下来并通过一定的压缩算法来保存音乐信息的方式是完全不同的。。。。。
这也是为什么midi格式的音质会非常依赖回放设备了----------不同的设备效果完全不同。。。。除非“曲谱限定”。。。。。
windows下面系统本身默认对midi格式的进行适当的处理，所以在windows下面默认即可播放
linux下面需要准备的东西
1,解码器
2,播放器
3,音色库
其中解码器的话，有些会以服务端-客户端的方式来进行工作
linux下面比较有名的解码器是
Timidity++ (我debian下使用的timidity)
FluidSynth
而播放器的话
我知道的则有则有
kmid（kde桌面的）
timidity++ (我debian下使用的timidity播放)
vlc
除此之外，还需要安装一个音色库（soundfonts）
ARCH下面的有
fluidr3
freepats （我debian下使用该音色库）
</pre></font>";
echo "<hr color=green size=2 width=90%><br>";
echo "<a name=lab18></a><font size=5 color=red><center>wine相关</center></font><br>";
echo "<font color=black><pre>
一、模拟DiabloII，在模拟暗黑2时出现的问题是开始的片头有声音，但是进入游戏就没声音了，此时运行winecfg
在audio选项中选择alsa，并且在下面的directsound中选择驱动模拟，在硬件加速中选择模拟即可解决这个问题。
二、模拟win下天开眼和电子基盘麻将时，我自己写了一个小软件，一条命令即可运行wine和mame模拟器：
天开眼：	system(\"wine ./tinyd.exe tenkaibb -window\");
电子基盘：  system(\"wine ./MAME.exe mjelctrn  -window\");
对于天开眼还可以选择不同的显示模式，如：system(\"wine ./tinyd.exe -video gdi tenkaibb -window\");
</pre></font>";
?>
