<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style>
.strikethrough {
    text-decoration: line-through;
}
</style>
<?php
echo "<pre>";
echo "<a name=prob1></a>
继续练习引导和启动模式
在head加载了以后，如果使用32位编程则在未进入保护模式时很难避免错误的发生，看来加入.code16并不像
0.11书中说的那样简单，只是将mov之类的指令加上w限制。

--------------problem------------
问题1：在加入.code16后编译的文件和使用宽度限制符movw编译的文件确实有差异，稍后研究吧。
现在解决方法是将所有进入保护模式前的代码都放在boot文件中，一个扇区的字节不够，可以顺序放入第二扇区，
一并将其读入执行。
连续扇区的代码测试成功，只要指定了第二扇区的加载位置即可，即加载到：0x7c00:0x200(512)处，然后跳转至
该位置继续执行即可.这样做的好处是，我可以在加载gdt\idt进入到保护模式之前使用一个文件用.code16完成所
有的引导和初始化代码。
问题2：加载了head代码后如果代码段选择符依然使用原来代码的0x7c0所在的段时，会出现代码可以执行，
但是数据访问错误，表现在使用lss加载ss/sp时出现错误以及显示信息获取错误。这个问题可以通过指定head
加载处地址作为新的代码段加入到gdt既能解决。但是为何使用原有段＋偏移（通过Ttext 5120指定）就不成功
呢？而且该位置的代码可以正常运行，数据加载不了（都在代码段中）－－恍然大悟，这可能与保护模式下代码
段的特性决定的，这也是为何反汇编时数据信息依然反汇编成了代码的原因吧。测试下。
测试结果：
第一：在使用ld链接时参数 -Ttext 或者 -Tdata后面跟着的地址是16进制的，也即：-Ttext 5120
并非我预期的10个扇区的位置，而是0x5120,相去甚远了，再者，如果仅仅指定了text段的加载位置，不指定data
段的话，data的默认加载位置并非想象的与text直接相连，通过查看bochs的各运行时寄存器的情况，也确实如此，
这种不确定性直接导致了数据定位的错误。才出现了代码正常运行，而数据显示不出来的问题。
第二：关于程序编译链接时设计的加载地址和设定读取磁盘数据加载至内存地址的一致性问题，就目前测试的情况
来看这个问题应该不会影响到加载程序的运行，只要设计好代码段的基地址就可以使程序正常执行，在我的测试中
head进程是在boot引导完成，并设置好gdt\idt再跳转至保护模式后，通过jmp跳转到head的加载位置开始执行的，
一般情况下，head的加载地址应该与head程序链接时设计的加载地址一致，我是将加载地址设计为0x1400（5120，10
个扇区位置之后，前10个为boot所用）如果不进行初始代码的移动的话，head加载进内存的地址为：0x7c00+0x1400
此时只要将代码段描述符中段基地址设计为0x7c00，然后jmp $0x8,$0x1400即可转入head进程的执行，而此时的加载
位置正好与链接head时设定的代码入口点一致，将能保证后续代码的正确转移执行。但是如果在链接时不指定入口地
址为0x1400的话，如指定为0,由boot跳转来后依然能正确执行，因为我们可以设计这时的段基地址为：0x7c00+0x1400
而在我的测试中，我并没有修改段基地址，依然使用的0x7c00，跳转到加载的位置后仍然能够正常执行，但是这时的加
载地址和设计的入口地址明显不一致了，由于head使用了32位的汇编设计，在剔除了pdr,comment,note等调试、链接信
息后不能使用objdump来查看反汇编信息了，
第三：在第一中提到的data段的加载位置不确定的问题也弄清楚了，这个问题的产生是因为源代码的编写是否是将.data
和.text段的定义伪指令放在一起，也就是是否所有的指令代码和数据代码都在一个作用域内，看来对.data和.text的定位
不仅能直接影响到org的定位，还影响到编译后程序的大小，实例如下：
代码形式1：
.data
.text
	....
代码形式2：
.text
.data
	....
代码形式3：
.text
	....
.data
	....
对于这三种情况的定义，在编译链接后，可以通过objdump -x来查看程序的各类信息：
architecture: i386, flags 0x00000112:
EXEC_P, HAS_SYMS, D_PAGED
start address 0x08049054

Program Header:
    LOAD off    0x00000000 vaddr 0x08049000 paddr 0x08049000 align 2**12
         filesz 0x00000254 memsz 0x00000254 flags rw-

Sections:
Idx Name          Size      VMA       LMA       File off  Algn
  0 .data         00000200  08049054  08049054  00000054  2**2
                  CONTENTS, ALLOC, LOAD, DATA
SYMBOL TABLE:
08049054 l    d  .data  00000000 .data
08049089 l       .data  00000000 disp
0000000c l       *ABS*  00000000 len
08049104 l       .data  00000000 msg
08049054 g       .data  00000000 _start
08049254 g       *ABS*  00000000 __bss_start
08049254 g       *ABS*  00000000 _edata
08049254 g       *ABS*  00000000 _end
这是形式2的信息，形式1的信息和他几乎一致，就是将Section的Name换成了.text
也就是这两种形式的写法，其代码段和数据段的作用域完全一致，因此，在程序的编译、链接
过程中只需定义一个Section.
而形式3的信息则是:
architecture: i386, flags 0x00000112:
EXEC_P, HAS_SYMS, D_PAGED
start address 0x08048074

Program Header:
    LOAD off    0x00000000 vaddr 0x08048000 paddr 0x08048000 align 2**12
         filesz 0x000000c0 memsz 0x000000c0 flags r-x
    LOAD off    0x000000c0 vaddr 0x080490c0 paddr 0x080490c0 align 2**12
         filesz 0x00000200 memsz 0x00000200 flags rw-

Sections:
Idx Name          Size      VMA       LMA       File off  Algn
  0 .text         0000004c  08048074  08048074  00000074  2**2
                  CONTENTS, ALLOC, LOAD, READONLY, CODE
  1 .data         00000200  080490c0  080490c0  000000c0  2**2
                  CONTENTS, ALLOC, LOAD, DATA
SYMBOL TABLE:
08048074 l    d  .text  00000000 .text
080490c0 l    d  .data  00000000 .data
080480a9 l       .text  00000000 disp
0000000c l       *ABS*  00000000 len
08049124 l       .data  00000000 msg
08048074 g       .text  00000000 _start
080492c0 g       *ABS*  00000000 __bss_start
080492c0 g       *ABS*  00000000 _edata
080492c0 g       *ABS*  00000000 _end
哈哈，由于这种定义方法代码段和数据段的作用域不同（指令代码不在.data中）所以，出现了
两个Section,而这两个段的定位地址并不相同，这时，如果.org在数据段作用域内，
则他的定位就是以.data的基地址开始计算的偏移，反之将以.text的基地址作为偏移计算。
Ttext定位测试:
通过这个程序的测试，更加清楚了程序加载后重定位信息的调整。实际上所有的标号在编译后都代表着一个段内的偏移，但是这个偏移
已经被编译链接程序硬编译进了程序的二进制文件中，当一个程序由系统加载时，系统会根据这些重定位信息在往内存的加载过程中依照
重定位信息或者修改重定位信息然后加载，这样在执行过程中就不会出现问题了，但是如果仅是将程序从磁盘读出到内存的某一位置，则
不涉及重定位的代码或指令可以顺利执行，但是所有涉及重定位的代码指令则不能正常执行了。因此，对于手动加载的程序必须依据加载
到的内存位置，在确定了段基地址后还要调整重定位项的数值！
测试idt的建立和使用
测试成功，需要注意的是：在设置idt的描述符时，指定的段选择符是中断函数所在的段，并且是可执行段
a02测试时，使用call时需注意：
1、必须要设置好堆栈。
2、在函数中使用堆栈操作时记住第一个pop出来的是系统自动压入堆栈的返回指针，需好存和恢复。
3、在测试局部标号0－9的使用，在不同的函数中使用同一数字标号没有岐义。
尼玛，代码的一丝错误简直就是逆天，一个磁盘读取的错误，将16进制误写成8进制。害我浪费了宝贵的一个晚上！
整数乘法的运算，如果使用mull的话，低32位在eax中，高32位在edx中。
<font color=red>2024-6-12更新c编写代码使用全局变量的问题
新的测试发现：c编写的代码应该采用的代码形式3,之前无法正常访问c代码中的全局变量，是因为变量的地址（编译链接后生成的硬编码地址）和
加载到内存的地址不一致。造成这种不一致的原因很多，最主要的原因就是编译链接后的硬编码地址要与加载到内存中的实际位置匹配。也就是
要依据待加载的内存位置生成硬编码地址。而c编写的代码通过gcc编译生成后其代码形式3是：
.text
...
.data
...
这种分Section的结构（新版本的编译器更是加入的.eh_frame调试块）。通过测试，代码段的定位都是相对的，即便代码段部分有远跳转/远返回代码
（即便有猜测也不会有影响）。也就是在链接时（ld）指定-Ttext的基地址是多少对代码段的执行没有影响。但是，数据段的重定位确是依据代码段的
基地址确定的。而这些重定位信息在链接时又会硬编码进代码段！所以，要想实现重定位的硬编码信息和待加载的内存位置一致，就必须调整代码段的
基地址，即在模块链接（ld）时，必须指定合适的-Ttext值，这样才能保证数据段的重定位可用。
另外，c编写的代码默认的链接操作是按4k的倍数确定代码段长度，调试段（.eh_frame）长度和数据段起始位置的。而对内核镜像的生成，这可能会
占用很多无用的扇区。若需对其精简，在连接时可采用 -N参数，该参数可忽略默认的4k倍数而生成紧凑的代码，数据段模块。但最小的调试段仍被保
留，目前我还不知道如何彻底取出.eh_frame的方法。
ld -m elf_i386 -N -o kern.bin cmain.o flp.o -Ttext 100200  --这是我的测试代码中生成c代码链接的做法。
我把代码放置在1M的起始位置处，并且头512字节存放了一些中断处理函数。所以c编写的代码实际的运行位置为0x100200,由于之前我忽略了中断处理
函数的头512字节（-Ttext 100000),所以在测试时，对全局变量值的地址获取的与硬编码的一致，但是却得不到正确的数值。通过查看前面的安装代码
才发现没考虑中断处理的512字节，也就是硬编码的地址和加载到内存的物理地址出现了偏差。再次调整 -Ttext为 100200问题完美解决！
</font>
<a name=prob2><a>
-----------------------2014-08-18	关于重定位的补充-------------------------------------
在16位代码完成初始化，准备跳转进入32位模式时，有两种定位方式：
一、安全的定位方式：
就是将32位代码开始执行的地址设为新的段地址，加入到gdt表中。例如16位的初始化代码都在0x7c0：0000开始的第一个读入扇区内完成了，
现在将第二扇区的数据依次读入到0x7c0:0x200开始的地址并跳转至该处执行。而第二扇区就已经为32位代码了，此时可以将0x7c0:0x200设为
新的段基地址并加入到gdt中：.word 2,0x7e00,0x9a00,0x00c0。然后在加载了cr0后直接跳转至jmp $8,$0(假设该段选择符为8,偏移则为0).
这种做法的好处是在新读入的扇区数据中如果有新的数据，则可以正确的访问代码和数据。而无需考虑数据的重定位。
二、带偏移的定位方法：
这种方法与方法基本相似，不同的就是在构造32位代码段时不加入0x200的便宜，仍然使用一开始的0x7c0来构造，此时的段描述符为：
.word 2,0x7c00,0x9a00,0x00c0。由于这里没有加入0x200的便宜所以在跳转时要使用：jmp $8,$0x200(仍假设该段选择符为8)，这种写法如果
不再makefile文件中进行修改，跳转后的代码可以执行，但是数据访问可能出错。错误在于对数据的定位不对，为可测试，可以在代码中取得了
数据地之后再人为的加上一个偏移（人为的重定位，呵呵）这个偏移就是0x200! 因此，如果非要使用这种带偏移的定位，就必须在makefile文
件中做相应的修正，修正的方法又有两种：
1、如果在32位的源代码中是如下定义的：
.data
.text
则需要在makefile文件中对head文件的text段指定偏移： -Ttext 200
2、如果在32位的源代码中是如下定义的：
.text
.data
则需要在makefile中对head文件的data段指定偏移： -Tdata 200
如果在后面的代码中还有org定位的话，则第一种写法的作用域为data，此时org的定位是以data的偏移开始计算便宜的，第二种反之。

</pre>";
echo "<a name=floppy></a><center><font color=red size=5>关于软驱驱动编程</font></center>
<pre><font color=red size=3>
相关基础知识部分请参看：<a href=../www.brokenthorn.com/Resources/OSDevIndex.html target=_blank>操作系统开发系列</a>
下面主要记录下实际操作的情况，在具体的驱动编制过程中，最大的感慨就是：所有正确知识的取得都是拼凑起来的！
不管是handbook还是操作系统开发网站甚至intel官方资料网站的介绍，在实际操作中都存在问题。
究其原因我想或许是我并没有对实际的软驱测试，而是使用的bochs。也可能有些异常是由模拟器造成的吧？
下面介绍下驱动开发的具体流程，每个步骤基本上对应一个函数：
（1）启动马达： 该步骤是通过对写0x3f2端口，并等待马达转速正常后,即完成启动操作。
写入的命令字节释义：
		0 0 0 1 1 1 0 0
		------- - - ---
		   |    | |  |
		   |    | |  -----指定驱动器，0-3分别代表软驱A-D
		   |    | --------0：控制器重置;1：控制器允许
		   |	----------0：IRQ模式; 1：DMA模式
		   ---------------4-7bit置位时，分别代表软驱A-D
一般的命令为（使用软驱A）：0x1C
（2）移动磁头到指定位置：该函数用于将指定的磁头移动至指定的磁道。该操作命令字节为3个,没有返回值。
其中：
		命令字：	0 0 0 0 1 1 1 1
		参数1 ：	x x x x x HD DR1 DR0	HD:指定磁头，DR1 DR0:指定软驱A-D（0-3）
		参数2 ：	磁道号（0-基）
（3）命令字的写入： 由于该操作是最频繁的操作，并且在每个命令字节的写入前都要读主状态寄存器(0x3f4)的状
态，并根据主状态寄存器的状态确定是否可写。所以，该命令是一个独立的函数。
写入前主状态的判断：状态字位6必须为0，位7必须为1才可写入
主状态字释义：
		1 0 0 0 0 0 0 0
		- - - -	-------
		| | | |    |
		| | | |	   -------位0-3置位代表驱动器A-D忙
		| | | ------------FDC忙标志，0：不忙，1：读写命令正在执行
		| | --------------FDC处于DMA模式，0：不是，1：是
		| ----------------传送方向标志，0：从CPU到FDC，1：从FDC到CPU
		------------------数据寄存器准备传送标志，0：未就绪，1：就绪可传送
当读取的主状态寄存器允许传送时，写命令就可以通过向数字寄存器（0x3f5）写入一个命令字或参数，然后再次判断
主状态寄存器。
（4）等待软驱中断：（wait_for_irq6）该函数在每次向FDC发送一个命令后（除了中断检测命令）都要被调用，以确
定FDC是否执行完命令。在实模式下可通过bios数据区的0x0040:0x003e的字节判断是否中断发生。只有中断发生才能继
续后面的操作，并调用中断检测命令通知FDC我们已经处理完成了本次中断。
0x0040:0x003e字节的释义：
		0 0 0 0 0 0 0 0
		- - --- -------
		| |  |     |
		| |  |     -------位0-3置位分别代表驱动器A-D(位0-A,位1-B,位2-C，位3-D)
		| |  -------------0-3代表选中的驱动器（0：A，1：B...）
		| ----------------未知
		------------------1：中断发生，0：中断已处理
该函数主要是监控字段位7是否置位，如果置位则复位该bit表示中断已处理。
（5）检测中断状态：该命令用于执行完一些没有返回的命令后查询中断的状态，但是是否所有的FDC命令执行完后都应调
用这条命令尚不明确。但是看操作系统开发这个网站的一个读数据操作实例中有这样一句注释：
//! let FDC know we handled interrupt
如果是这样的话，那应该是在每个FDC命令执行完成后都应调用该命令以通知FDC。
该命令的命令字节为1,命令字为0x8,返回状态字节2个，其中第一个字节为状态寄存器0的内容，第二字节为当前的柱面号。
（6）执行状态的读取：这也是我目前碰到的关于软驱驱动编程中最为混乱的操作！各方做法不一。该命令的操作是在写入
命令执行完后，对有返回值的命令必须要读取其返回值，该命令才算执行完成，否则不能继续执行其他命令。而返回的状
态字节数各个命令也不相同，最多为7个返回字节。在读取之前还应先执行等待软驱中断操作。待中断产生后，清除中断后
在开始读取，并且每次读取一字节的状态都要对主状态字进行检查。根据主状态字节的释义和handbook的说明，应该是先要
判断主状态字的位6以确定传送方向是FDC到CPU，然后在判断数据寄存器就绪才可读取一个返回状态字节。循环上述操作读取
全部返回状态字节。但是，实际的测试却不是如此，在我的测试程序中，主状态字的位6从来都不是1,首次得到的主状态字是
0b00010000 也就是FDC处于忙状态，通过追踪主状态字的变化，发现等待忙状态结束后即刻进入到初始状态了
（主状态字为0b10000000）。也就是根本无法按照handbook上要求的去获取返回状态字节。查看操作系统开发网站的上示例
（http://www.brokenthorn.com/Resources/OSDev20.html）他是只判断位7的数据寄存器是否就绪，只要就绪就开始读取。
然而这种状态也是主状态寄存器的初始状态，应该是准备接受命令的标志。我尝试按照这种做法，确实获得了正确的返回状
态字节。但是返回的字节数却不能确定，只好连续取得7次（针对某个单独的FDC命令可以使用其特定的返回字节数控制）。
不管怎么我觉得这种做法真的很曹蛋，我也因此而花费了整个国庆的休息时间去测试！
（7）DMA的设置：dma的设置相对而言比较简单，对软驱编程用到的端口为：
0x81 通道2的页寄存器端口，
0xA 单通道屏蔽寄存器（只写），
0xB 模式寄存器（只写），
0xC 清字节指针寄存器（只写），
0x4 通道2的地址寄存器（8位，分2次写入16位地址）
0x5 通道2的计数寄存器（8位，分2次写入16位地址）
设置步骤一般为：
1、写端口0xA屏蔽指定软驱;
2、写模式寄存器端口0xB，指定dma工作在读模式下（磁盘->内存）;
3、写任意数据至端口0xC，重置字节指针;
4、将段地址的高4位写入页寄存器0x81;
5、重复步骤3,重置寄存器字节指针;
6、将段地址的低16位+偏移形成16位地址分两次写入地址寄存器;
7、重复步骤3,重置寄存器字节指针;
8、将待读入的字节数分别写入计数寄存器;
9、开启指定软驱的屏蔽。
单通道屏蔽寄存器字节释义：
		0 0 0 0 0 0 0 0
		--------- - ---
		    |     |  |
		    |     |  -------0-3分别对应通道0-3
		    |     ----------屏蔽位，1：屏蔽，0：不屏蔽
		    ----------------未用
模式寄存器字节释义：
		0 0 0 0 0 0 0 0
		--- - - --- ---
		 |  | |  |   |
		 |  | |  |   -------0-3分别对应通道0-3
		 |  | |  -----------传送类型，0：自身测试; 1：写模式（对内存而言）;2：读模式（对内存而言）; 3：无效
		 |  | --------------自动初始化设置，1：自动初始化，0：不自动
		 |  ----------------IDEC 无须设置
		 -------------------工作模式，0：询问模式，1：单字节传输模式，2：块字节传输模式，3：dma级联模式

<center>状态字节0 （ST0）
<table border=1 width=70%> 
<tr>
<td width=5%>位</td>
<td width=15%>名称</td>
<td width=80%>说明</td></tr>
<tr>
<td width=5%>7 6</td>
<td width=15%>ST0_INTR 中断原因。</td>
<td width=80%>00 – 命令正常结束；<font color=red>01 – 命令异常结束；</font> 10 – 命令无效；11 – 软盘驱动器状态改变。</td></tr>
<tr>
<td width=5%>5</td>
<td width=15%>ST0_SE</td>
<td width=80%>寻道操作或重新校正操作结束。（Seek End） </td></tr>
<tr>
<td width=5%>4</td>
<td width=15%>ST0_ECE</td>
<td width=80%>设备检查出错（零磁道校正出错）。（Equip. Check Error）</td></tr>
<tr>
<td width=5%>3</td>
<td width=15%>ST0_NR</td>
<td width=80%>软驱未就绪。（Not Ready）</td></tr>
<tr>
<td width=5%>2</td>
<td width=15%>ST0_HA</td>
<td width=80%>磁头地址。中断时磁头号。（Head Address）</td></tr>
<tr>
<td width=5%>1 0</td>
<td width=15%>ST0_DS</td>
<td width=80%>驱动器选择号（发生中断时驱动器号）。（Drive Select） 00-11分别对应驱动器0-3。</td></tr>
</table>
状态字节1 （ST1）
<table border=1 width=70%> 
<tr>
<td width=5%>位</td>
<td width=15%>名称</td>
<td width=80%>说明</td></tr>
<tr>
<td width=5%>7</td>
<td width=15%>ST1_EOC</td>
<td width=80%>访问超过磁道上最大扇区号EOT。（End of Cylinder）</td></tr>
<tr>
<td width=5%>6</td>
<td width=15%></td>
<td width=80%>未使用（0）。</td></tr>
<tr>
<td width=5%>5</td>
<td width=15%>ST1_CRC</td>
<td width=80%>CRC校验出错</td></tr>
<tr>
<td width=5%>4</td>
<td width=15%>ST1_OR</td>
<td width=80%>数据传输超时，DMA控制器故障。（Over Run）</td></tr>
<tr>
<td width=5%>3</td>
<td width=15%></td>
<td width=80%>未使用（0）。 </td></tr>
<tr>
<td width=5%>2</td>
<td width=15%>ST1_ND</td>
<td width=80%>未找到指定的扇区。（No Data - unreadable）</td></tr>
<tr>
<td width=5%>1</td>
<td width=15%>ST1_WP</td>
<td width=80%>写保护。（Write Protect）</td></tr>
<tr>
<td width=5%>0</td>
<td width=15%>ST1_MAM</td>
<td width=80%>未找到扇区地址标志ID AM。（Missing Address Mask）</td></tr>
</table>
状态字节2 （ST2）
<table border=1 width=70%> 
<tr>
<td width=5%>位</td>
<td width=15%>名称</td>
<td width=80%>说明</td></tr>
<tr>
<td width=5%>7</td>
<td width=15%></td>
<td width=80%>未使用（0）</td></tr>
<tr>
<td width=5%>6</td>
<td width=15%>ST2_CM</td>
<td width=80%>SK=0时，读数据遇到删除标志。（Control Mark = deleted）</td></tr>
<tr>
<td width=5%>5</td>
<td width=15%>ST2_CRC</td>
<td width=80%>扇区数据场CRC校验出错</td></tr>
<tr>
<td width=5%>4</td>
<td width=15%>ST2_WC</td>
<td width=80%>扇区ID信息的磁道号C不符。（Wrong Cylinder）</td></tr>
<tr>
<td width=5%>3</td>
<td width=15%>ST2_SEH</td>
<td width=80%>检索（扫描）条件满足要求。（Scan Equal Hit）</td></tr>
<tr>
<td width=5%>2</td>
<td width=15%>ST2_SNS</td>
<td width=80%>检索条件不满足要求。（Scan Not Satisfied）</td></tr>
<tr>
<td width=5%>1</td>
<td width=15%>ST2_BC</td>
<td width=80%>扇区ID信息的磁道号C=0xFF，磁道坏。（Bad Cylinder）</td></tr>
<tr>
<td width=5%>0</td>
<td width=15%>ST2_MAM</td>
<td width=80%>未找到扇区数据标志DATA AM。（Missing Address Mask）</td></tr>
</table>
</center>

</font></pre>";
echo "<a name=lcall></a>
<pre><font color=blue size=3><center>----------2014-11-8远调用及常量定义心得---------------</center>
通过这段时间的测试，有获得了不少的心得...
一、常量的定义：
由于使用汇编写系统的磁盘镜像文件，因此一些不必要的信息是不能出现在生成的镜像文件中的。因此在生成时，往往使用不同
的工具将一些除代码，数据，重定位信息等必要信息之外的都剔除，如使用objcopy时剔除.pdr .comment .note等。而在汇编源
代码中，一些定义的常量如：BOOTSEG=0x7c0，并不是以变量数据的形式存在与模块文件中的。他们的作用仅仅是在编译过程中使
用，是编译器、链接器工作所需的。也就是你在源文件中使用的这些定义在编译链接完成后都会被替换为他所代表的真实数据。
所以，大量的使用这些常量定义不会对你生成的模块造成任何影响。反倒会帮助你快速的修改、替换和记忆某些苦涩的具体数值。
二、远调用的使用以及同一个函数可同时用于段内和段间的调用
1、调用和远调用的区别：
调用：call  返回：ret
这种形式的调用适用与段内函数的调用，对应的堆栈的处理是只压入返回地址的偏移(esp-4)，也就是紧跟call后面的指令地址的偏移。
ret返回时，同样仅从堆栈中弹出返回地址的偏移（esp+4）并加载到eip中。
远调用：lcall 返回：lret
远调用为段间调用，因此对应的lcall，堆栈的操作是先压入当前的段选择符（返回的段），再压入返回的地址偏移（esp-8），lret返
回时，同样先弹出返回地址的偏移，再弹出返回地址所在的段选择符（esp+8）。
2、同一函数可同时用于段内和段间调用的可行性：
由于这两种调用对堆栈处理的不同，因此若要一个函数既能用于段内调用，又能用于段间调用的话，就需要更多的信息。该信息要指明
本次调用是段内调用还是段间调用，我们可以通过像传递参数一样的处理，传递给该函数一个参数来指明本次调用的类型，而函数也必须
具备判断该传入参数以确定是以ret返回还是以lret返回。这样的函数就能适应这两种形式的调用了。不过这种形式的函数是否有其存在的
必要还需进一步的考虑。
3、lret \$STACK-ADJUST
stack-adjust仅是用于调用返回时额外的对堆栈的调整。ret返回同样可以带个调整参数。例如：ret $2，他的作用就是在正常弹出返回地址后
（esp+4）再调整一次堆栈指针，以丢弃通过堆栈传递的参数或其他不再使用的数据。所以，ret $2 返回后的指针为esp+6(esp+4+调整的2)。
lret同理。
三、误打误撞的system.map
在最新的测试代码中，我把所有的中断处理代码都放在一个单独的模块task中，但是在设置中断描述符表idt时却出现了一个问题，就是由于task
模块和head模块不属于同一模块，所以各中断例程的重定位信息不能被属于head模块的idt安装程序直接使用，期初我考虑是否将idt的安装程序移
至task模块中，但是idt的安装程序在执行完成后就没有存在的必要了，而head模块中的各段程序代码在初始化完成后就可以遗弃掉的，所以idt安
装程序放在head模块是最合适的。因此我一直考虑其他方法来实现idt的安装。说来也怪，我是在半梦半醒时突然想到了这个方法的：就是将每个中
断程序的入口地址保存为一个地址列表放在task模块的后面，这样就能在读取磁盘时将这个地址列表也读取到dma的缓冲区中，并让idt的安装程序依
据这个列表完成中断描述符表的安装。经测试该方法完全可行，并且我还据此列表进一步做了测试：远调用函数的测试，测试同样成功。而这也就引
出了与linux的system.map相似的做法。在这之前我还没有看到system.map的相关说明的。
四、为何分文件编写head模块和中断处理模块？
这种做法就一个目的：让我的内核代码简洁、紧凑，不存在冗余代码。由上面的分析也知道，head模块中的代码都是临时的，是用于内核环境设置的
，因此分开编写就可以更加容易将临时代码和正式代码分开来。此外，之前我的测试代码中是不区分这两个模块的。而那时的中断处理程序虽然可以
移动至目标位置，但是由于重定向的原因，目标地址中除了有有效的中断程序，还有和head模块相同的定位。这使的在目标地址中存在有很多的不连
续的空间存在。而分文件编写正是解决这一问题的最佳方式，因为中断模块的重定位信息保证了期间没有冗余空间！
</font></pre>";
echo "<a name=task></a>
<center><font color=red size=5>关于任务切换和中断门、陷阱门的心得</font></center><br><pre><font color=black size=3>
这两天收获颇丰，关于任务切换的，关于中断门和陷阱门调用的。为了更加精准的了解这些知识，我编写了两个测试程序来验证我的推测，
通过两个测试程序使我对他们的运作机制有了更深入的了解。因此将这几天的收获记录一下：
所有问题的引出还是来自与任务切换或者叫任务调度的实现，一个最简单的例子就是linux初期内核的测试程序：
通过8253的时钟中断来调度两个任务分别显示不同的字符。这个实现非常的简单，但是若要真正的了解其运行机制，就必须要进行一番测试。
虽然后来我回过头来在看书籍，我的很多被验证的猜测都明明白白的写在书上，但相比于看书我的特长好像是更喜欢动手，因为我看书往往不能
深入进去，书中介绍的一些关键信息，很有可能被忽略掉。而通过自己动手来验证某些我认为合理的猜测，然后在结合看书才能真正的了解书中
哪些知识点是关键的，哪些是被我忽略掉的。这样对这些知识点的记忆才能够更加深刻。--扯远了.....OK!let's go!
一、特权级切换的问题
1、由低特权级向高特权级的切换：
   通过陷阱门，可使低特权级的代码向高特权级的转移，这就是系统调用（如linux的0x80）所提供的功能。
2、由高特权级向低特权级的切换：
   这是目前我所关注的，因为在设计内核时，我们往往是处在最高特权级下的。而这种转换，据《linux内核完全剖析0.12》介绍没有什么直接的
   方法去实现，而linus在设计其初期内核时是使用的模拟中断返回的做法来实现的，具体实现由下面的步骤来完成：
   （1）ltr加载待切换任务的任务寄存器
   （2）lldt加载待切换任务的局部描述符表寄存器
   （3）构造中断返回的环境：
   		<1>将标志寄存器EFLAGS的NT任务嵌套位清位
		<2>将待切换任务的普通堆栈段ss入栈
		<3>将待切换任务的普通堆栈指针esp入栈
		<4>将标志寄存器EFLAGS入栈
		<5>将待切换任务的代码段cs入栈
		<6>将待切换任务的指令指针EIP入栈
	(4)执行iret指令，跳转至低特权级的任务中，完成特权级的切换。
	其实要完成向低特权级的转移还有其他方法，例如我在网上看到的通过任务门等，但那些方法我没有测试。不过还有种简单的方法也能轻松实现
	向低特权级的的转移：那就是通过ljmp或者jmp就能实现。这种方法是我阅读初期内核的测试代码时，随着问题而产生的。那就是在时钟中断的代
	码中对两个任务的调度，他的做法是通过一个标志字来判断并远跳转至不同的任务寄存器选择符即可实现不同任务之间的切换。我们知道，中断
	代码都是处于内核特权级的，也就是说这种做法就意味着在内核特权级中可以通过远跳转就能实现特权级的变换。于是我就将这种做法替换了模拟
	中断返回执行任务的代码。开始的测试是失败的，我仔细的检查了移动过来的代码与在时钟中断中的代码没什么不同，为什么在中断之外就不能执
	行了？后来我发现他们之间构造方法的差别了：就是即便是先启动并运行一个任务，之前的准备过程中也要准备两个tr和ldt，并且还要将加载进
	tr和ldt	的任务寄存器和局部描述符寄存器与我要跳转的任务寄存器不同才能成功！
二、特权级切换的测试引出了对中断门、陷阱门的认识
	此时虽然测试成功了，但是我对其原理或者其硬件执行机制了解的还不透彻，一直怀疑为何要使用构造两个tr和idt才能执行。并且这种构造还不
	能太随意，必须是真正可以使用的tr和ldt才可，对于tr来说其tss中最起码要有内核堆栈段的段选择符和esp。好了，我们先暂且记下来，姑且称之
	为问题2。那么问题1呢，问题1实际上就是引出这一系列问题的那个问题：在时钟中断的代码中他使用的任务调度的操作都是远跳转，根据这两个任
	务的代码来看都是无限循环的操作，再说了使用跳转操作的本身就是没有返回的想法了，这样的话这个时钟中断的代码就不可能执行到跳转之后的
	恢复堆栈和iret了，据此我猜测这个时钟中断就像是一个起勃器，每次从这里开始启动但是不会返回...不过这种猜测好像不能成立，原因就在于堆
	栈的不平衡，试想若是真的这样运行那很快堆栈就会耗尽的。因此我按照这种猜测写了第一个测试程序，称之为程序1吧。
1、 程序1的测试，构造两个内核级的任务进行的测试：
	一开始我要进行这样的测试纯粹是为了先了解在中断处理的过程中是否还有什么特殊操作？比如对堆栈操作的不同等，同时为了测试的简单化，我将
	测试的任务设计成了内核级的,这就避免了tr以及ldt等对我测试目的的干扰，这两个任务其实就是两个独立的循环显示字符的函数。而对这两个函数
	的调度就放在了时钟中断的代码中。也是通过远跳转转去不同的任务中。但是我考虑到了堆栈的平衡，所以在任务开始的代码中我设置了堆栈平衡的
	代码（由于都是内核级的，堆栈的处理也简单，很容易恢复平衡）。测试成功，实现了两个任务的切换执行。并且由于我添加了对堆栈平衡的代码，
	所以也没有堆栈的泄露。一切看似完美...，更进一步的测试就是我将时钟中断的代码中后面用于恢复堆栈和远跳转的指令去掉后依然完美的执行。并
	且，在这个测试过程中还发现原来中断发生在内核级代码中时堆栈的处理和发生在特权级转换时的不同，那就是此时需保存的信息只有三项：标志寄存
	器，代码段选择符，指令指针EIP，而我们知道，在进行真正的任务切换时（特权级改变）此时堆栈中在这三项需要保存的信息之前还要保存任务的用
	户级堆栈段选择符和栈指针这两项，同时我也考虑到了如果真的需要自己处理堆栈的平衡：通过压入栈的代码段选择符来判断并处理堆栈的平衡完全可
	以实现。除了堆栈操作与普通代码不同之外，通过这个测试我还发现中断处理（后来因为int 0x80系统调用才意识到，实际上是中断门的处理）过程中
	另外一个与其他内核代码的不同之处就是在进入中断代码后他会自动将标志寄存器中的中断标志位清位！以保证不会再有可屏蔽中断打搅，而在中断返
	回前又会自动置位中断标志位。这个测试可以说是最单纯的甚至不依赖与tr的一个任务调度器。但同时也使我意识到了前辈们设计tr的必要性。因为没
	有了tr的支持，所有寄存器都要恢复到中断前的那一刻真的是很难处理。这种感觉就像束缚了你所有的手脚还要去最后执行跳转。以至于这个远跳转要
	借助与使用看似已经被遗弃的堆栈中（因为此时栈指针已经调整回去了）的那个地址来进行间接的远跳转了。好了，到目前来看一切看似都与我的猜测
	一致，那么我要开始真正任务切换的测试了，没想到加入了tr后，一切都变得那么的复杂了。曾经一度我认为我前面的认知都要被推翻。不过当着一切
	都被测试程序2证实后，我发现我之前的所有问题都解决了，我对tr的认识又有了一个飞跃，（其实之前对tr根本不能称之为认识:( -_-!!）
2、 程序2的测试，构造两个完整的任务进行测试：








</font></pre>";
echo "<a name=c_asm></a><center><font color=red size=5>内核编写转向C编写的相关问题</font></center>
<pre><font size=3>
测试c与汇编的混编没有问题了，不过有个小小的瑕疵，就是在链接的时候不是链接成代码，代码，数据，数据的情况。假设汇编程序中有代码和数据
而c的源文件中也有代码和数据的话，链接后的情况为代码、数据、代码、数据另外如果在c源文件中有下列类似的定义char[]=\"aaaa\"时;该变量不能
连续的存储。针对上面的定义我已经做了测试：不能连续存储的原因就是这种定义方式不能确定变量的长度。所以只能将其放置在所有变量定义的最后。
下面为部分测试代码：
ch[]=\"tybitsfox\";
int i,j;
i=strlen(ch);
for(j=0;j<5;j++)
	ch[i+j]='v';
printf(\"%s\\n\",ch);
因此在内核编程时应尽量避免使用这种定义方式，<font color=red>(新的认识：在C语言中，依旧遵循.data.text的定义方式，只不过他的处理稍有不同。
当仅声明了全局变量，而未对其赋值时，或者定义的全局变量是个只读属性的值时，c的编译器只会为其预留出存储空间，因为没有赋值，所以编译器认为
在data段中没有需要保存的数据，这时预留的空间会体现在text段，包括我们定义的结构体也是这种处理方式。只有对定义的全局变量赋初始值后，编译器
才会认为有需要保存的数据，并且他会在text代码段后面整数页4k的开始处添加最少一页的空间作为数据段data的空间，也只有这时，代码段和数据段才正
式的分开来，这也就是为上么我上面定义字符串的内容时生成的模块要远远大于我认为的模块大小。实施上并非是对字符串变量赋值，仅对一个整数变量赋
值依然是这种情形)</font>也就是所有变量的长度应明确指定。另外一种定义方式我也进行了测试就是char *p=\"tybitsfox\";样
式的定义。存在这种定义的c源代码在编译时通过objdump -x查看其编译的模块会发现多出来一个.rodata的段，也就是只读段，这种定义的字符串在c语言
中编译链接成可执行文件时是不能修改的。不知与汇编模块链接后是否还有只读的特性？：）至于最开始汇编与c生成的模块的链接顺序的问题，我想到了
一个暂时性的解决方案：就是将汇编文件中的变量定义放在一个单独的文件中。这样链接的顺序为：
汇编代码模块，c编译模块，汇编数据模块。这样就应该能形成我所期望的顺序了。待测试～～测试成功！但是应注意单纯的汇编数据源文件的编写格式：
为了能将所有模块的代码段，数据段顺序链接，数据源文件的按如下格式定义段
.data
.text
也就是要与代码源文件的一致，并且在数据源文件中不能再使用.org之类的定位伪指令了，尽量减少人为的对gcc链接的干涉！
另：makefile中使用隐含规则和自动化变量时关于包括外部头文件时的情况：当使用隐含规则和自动化变量编译c文件时，其所需的头文件不能再向以前一样
将其在c文件中include（include可以，但必须是全路径的写法）。正确的做法应该是在makefile文件中先定义VPATH或者vpath,
VPATH=/workarea/cprogram/include
或者：
vpath %.h /workarea/cprogram/include
然后写隐含规则：
%.o:%.c
	gcc -o $@ $^
然后依赖项中加入所需的头文件:
a1.o:a1.c clsscr.h
这样就可以包含该头文件了，而在c的源文件中不必再出现include语句了。

解决了c与汇编文件的混编问题，下一步就可以建立和完善我的内核库了。




</font></pre>
";
echo "<a name=d_asm></a><center><font color=red size=5>用c函数编写内核代码的另一个意外</font></center>
<pre><font size=3>
又遇到一个问题，耽误了一天的时间。内核的初始代码已经初步完成，转入到了正式内核的代码中了，现在已经可以转由c来加速编程进度了，并且很多内核核心数
据也可以通过c的结构指针来轻松的管理和使用了，然而一个意外的错误竟然再次打断了我的进度，不过我也有幸因此而对内核以及c函数的编译有了更深入的了解！
错误发生在一个由c写成的函数，该函数的功能是获取各核心数据结构的指针。我使用了switch做分支处理获取不同数据结构的指针，当分支（case）的数量少于5个
的时候，一切正常。然而当在增加分支时（有多于5个case）这个函数竟然失去了作用。不仅如此，该函数甚至不能返回。这两种情况的代码可以通过objdump轻易的
比较出来，原来在这两种情况下gnuc的编译器生成代码的方式并不相同！
当分支较少时（4个分支）生成的代码要繁琐些，不过他确是以一种顺序的方式执行的：
00000000 &lt;klocate&gt;:
   0:   55                      push   %ebp
   1:   89 e5                   mov    %esp,%ebp
   3:   83 ec 10                sub    $0x10,%esp
   6:   c7 45 fc 12 00 00 00    movl   $0x12,-0x4(%ebp)
   d:   8b 45 08                mov    0x8(%ebp),%eax
  10:   83 f8 01                cmp    $0x1,%eax
  13:   74 1e                   je     33 &lt;klocate+0x33&gt;
  15:   83 f8 01                cmp    $0x1,%eax
  18:   7f 06                   jg     20 &lt;klocate+0x20&gt;
  1a:   85 c0                   test   %eax,%eax
  1c:   74 0e                   je     2c &lt;klocate+0x2c&gt;
  1e:   eb 2b                   jmp    4b &lt;klocate+0x4b&gt;
  20:   83 f8 02                cmp    $0x2,%eax
  23:   74 16                   je     3b &lt;klocate+0x3b&gt;
  25:   83 f8 03                cmp    $0x3,%eax
  28:   74 19                   je     43 &lt;klocate+0x43&gt;
  2a:   eb 1f                   jmp    4b &lt;klocate+0x4b&gt;
  2c:   8b 45 fc                mov    -0x4(%ebp),%eax
  2f:   8b 00                   mov    (%eax),%eax
  31:   eb 1d                   jmp    50 &lt;klocate+0x50&gt;
  33:   8b 45 fc                mov    -0x4(%ebp),%eax
  36:   8b 40 08                mov    0x8(%eax),%eax
  39:   eb 15                   jmp    50 &lt;klocate+0x50&gt;
  3b:   8b 45 fc                mov    -0x4(%ebp),%eax
  3e:   8b 40 10                mov    0x10(%eax),%eax
  41:   eb 0d                   jmp    50 &lt;klocate+0x50&gt;
  43:   8b 45 fc                mov    -0x4(%ebp),%eax
  46:   8b 40 18                mov    0x18(%eax),%eax
  49:   eb 05                   jmp    50 &lt;klocate+0x50&gt;
  4b:   b8 00 00 00 00          mov    $0x0,%eax
  50:   c9                      leave  
  51:   c3                      ret   
在看看多分支(11个)时的情形：
00000000 &lt;klocate&gt;:
   0:   55                      push   %ebp
   1:   89 e5                   mov    %esp,%ebp
   3:   83 ec 10                sub    $0x10,%esp
   6:   c7 45 fc 12 00 00 00    movl   $0x12,-0x4(%ebp)
   d:   83 7d 08 0a             cmpl   $0xa,0x8(%ebp)
  11:   77 66                   ja     79 &lt;klocate+0x79&gt;
  13:   8b 45 08                mov    0x8(%ebp),%eax
  16:   c1 e0 02                shl    $0x2,%eax
  19:   05 00 00 00 00          add    $0x0,%eax
  1e:   8b 00                   mov    (%eax),%eax
  20:   ff e0                   jmp    *%eax
  22:   8b 45 fc                mov    -0x4(%ebp),%eax
  25:   8b 00                   mov    (%eax),%eax
  27:   eb 55                   jmp    7e &lt;klocate+0x7e&gt;
  29:   8b 45 fc                mov    -0x4(%ebp),%eax
  2c:   8b 40 08                mov    0x8(%eax),%eax
  2f:   eb 4d                   jmp    7e &lt;klocate+0x7e&gt;
  31:   8b 45 fc                mov    -0x4(%ebp),%eax
  34:   8b 40 10                mov    0x10(%eax),%eax
  37:   eb 45                   jmp    7e &lt;klocate+0x7e&gt;
  39:   8b 45 fc                mov    -0x4(%ebp),%eax
  3c:   8b 40 18                mov    0x18(%eax),%eax
  3f:   eb 3d                   jmp    7e &lt;klocate+0x7e&gt;
  41:   8b 45 fc                mov    -0x4(%ebp),%eax
  44:   8b 40 20                mov    0x20(%eax),%eax
  47:   eb 35                   jmp    7e &lt;klocate+0x7e&gt;
  49:   8b 45 fc                mov    -0x4(%ebp),%eax
  4c:   8b 40 28                mov    0x28(%eax),%eax
  4f:   eb 2d                   jmp    7e &lt;klocate+0x7e&gt;
  51:   8b 45 fc                mov    -0x4(%ebp),%eax
  54:   8b 40 30                mov    0x30(%eax),%eax
  57:   eb 25                   jmp    7e &lt;klocate+0x7e&gt;
  59:   8b 45 fc                mov    -0x4(%ebp),%eax
  5c:   8b 40 38                mov    0x38(%eax),%eax
  5f:   eb 1d                   jmp    7e &lt;klocate+0x7e&gt;
  61:   8b 45 fc                mov    -0x4(%ebp),%eax
  64:   8b 40 40                mov    0x40(%eax),%eax
  67:   eb 15                   jmp    7e &lt;klocate+0x7e&gt;
  69:   8b 45 fc                mov    -0x4(%ebp),%eax
  6c:   8b 40 44                mov    0x44(%eax),%eax
  6f:   eb 0d                   jmp    7e &lt;klocate+0x7e&gt;
  71:   8b 45 fc                mov    -0x4(%ebp),%eax
  74:   8b 40 48                mov    0x48(%eax),%eax
  77:   eb 05                   jmp    7e &lt;klocate+0x7e&gt;
  79:   b8 00 00 00 00          mov    $0x0,%eax
  7e:   c9                      leave  
  7f:   c3                      ret
在多分支代码中关键的处理是eip13~~20的那几条汇编语句：
  13:   8b 45 08                mov    0x8(%ebp),%eax
  16:   c1 e0 02                shl    $0x2,%eax
  19:   05 00 00 00 00          add    $0x0,%eax
  1e:   8b 00                   mov    (%eax),%eax
  20:   ff e0                   jmp    *%eax
他处理的逻辑实现是：取传入的switch值，将该值存入eax，然后将其乘4，再将其加0，然后结果作为地址取出该地址保存的值仍存入eax，再以eax中的值作为地址跳
转到该地址处。并且自EIP20以后看不到了比较语句，说明通过上面的计算获取了需要转到的那个case的地址处了。（注意：c编译器的这种处理方式仅是适用于各个
case值是顺序递增的情形，其他情形我也不想讨论了）然而只看上面的几行代码我们还是不能确定目标地址到底存放在哪。因为这里我dump的是o文件，仅仅是编译后
的文件。如果我们再dump执行完链接的文件就会发现那条加0的语句会被重定位信息所替换而成为模块可执行的地址信息。这时就会发现该地址一般指向了当前模块所
有可执行代码后面的位置。在通过objdump -x查看段节信息我们就会发现这段c的代码与平时我们写的汇编代码有所不同，他多出了.rodata段和.eh_frame段。其中.eh_frame
段是做异常处理的，用于计算函数调用栈。我们可以忽略他，rodata是个只读数据段。并且只读数据段中的信息与跳转地址的计算可以吻合上。看来GNU的C函数编译、
链接还是用到了这个段。虽然执行方式弄清楚了，而那个只读数据段也不会影响我内核程序的执行，可为何就是不能执行呢？为此我又去翻看linux的内核代码。也没
发现他的处理与我的有何不同，再查看makefile中编译和链接的各个参数，也没有能影响rodata的参数！可为何我的代码就不能正常执行呢？？再从网上搜遍rodata的
相关资料也没有效的方法甚至提示！无奈之下在从头查看我之前的代码吧，当看到gdt的定义时，我突然发现问题的所在了！原来我把代码段和数据段分割了开来，我当
初的设想就是要把这两个段独立开来，想要内核尽量的洁净。而问题也正是由此产生了。因为rodata是由c代码编译生成的，他放在了我默认的代码中！而上面的取内存
操作数和取地址操作所默认的段应该是数据段！--这是gunc的编译器所规定的，也就是默认的gnuc编译器代码生成的前提（默认）条件是代码段和数据段必须是在一个
地址范围内！到此问题就解决了，但是我还是验证了一下这个正确的想法：在调用这个函数之前我将代码段中rodata的定位信息拷贝到了我的数据段相同的偏移地址处，
然后调用这个函数，果然成功！



</font></pre>
";
echo "<a name=d_page></a><center><font color=red size=5>启用分页机制后，任务切换出现的意外</font></center>
<pre><font size=3>
终于有些东西可以记录下来了，写了这么久的代码。总算是有些新的发现了我在写到任务切换时，发现如果没有使用分页机制的话，任务切换很正常。
但是一加上分页机制（仅仅是加上分页机制）就会错误！查看的错误为：
page not present 页不存在!,并且cr2中存储的地址为0x40，cr3:0。查看该地址对应的为双重故障的错误。
反复查看linux kernel0.11中相关的mm内存管理章节，也没发现我有遗漏或做错的地方，又反复观察bochs返回的各种信息，发现在退出时的各个寄存
器值中，es,fs,gs等实际上已经赋值为切换后新任务的段值，这应说明切换成功了，而错误的地方应该是再切换回原任务（任务0）时发生的。为了验
证，我将8259a的手动结束操作（ocw2）关闭。再次测试，发现确实不出现错误退出了，也证明了我的猜测：
此时代码确实是在新任务中执行的。那么为何在切换回任务0时失败了？又想到错误产生时cr3的值变成了0,我突然就明白了一切！！那就是我在新任务
的tss中设置了正确的页目录（CR3）地址，但是没有在任务0的tss中设置CR3。而CR3在tss中是属于初始化后不能改动的值，而我又偏偏没有对其进行
初始化操作，实际上，这个隐藏的问题一直存在，只是当我没有开启分页时不会表现出来而已，而这一错误也提醒了我，今后在对Tss的设置时，凡是
加载后不能修改的项，必须在初始化时给予明确的设定！

  										      -tybitsfox  by 2016-2-28

















</font></pre>
";
echo "<a name=d_label></a><center><font color=red size=5>AT&T语法中对标号的释义</font></center>
<pre><font size=3>
关于call和jmp对标号（函数入口地址）的操作：
正常情况下，AT&T的对标号的使用规则为：
--假定：
cls：
    push %es 
    ... 
--假定结束  
operator \$cls 是取标号的地址
operator cls  是取该地址所存储的值
当operator 是move指令时，上述描述是正确的，但是有些指令并非如此，
例如当operator是leal时，此时的写法就是 leal cls,%eax，这里eax中将取得
cls的地址偏移。
同样的对于call和jmp操作，其对标号含义的处理也与move指令不同，按照move指令
对标号的释义，call和jmp都应该是call \$cls，jmp \$cls，但是这种写法确是错误的
编译时会给出参数类型不匹配的提示，正确的做法是 call cls，jmp cls 
也就是call和jmp指令对标号的释义等同于leal指令，那么\$cls这种写法对call和jmp 
是否能被解释为地址偏移呢？考虑到远跳转（调用）的做法，我测试了：
call $8,\$cls，jmp $8,\$cls
这种写法是正确的，而：
call $8,cls，jmp $8,cls
这种写法在编译时又提示为操作类型不匹配！！
综上所述：我感觉AT&T语法在标号的处理上有些不统一，当然了，规定就是规定，你按
照这些既定的规定做就可以了，但确实需要注意！


















</font></pre>
";
echo "<a name=switch_task></a><center><font color=red size=5>时钟中断中任务切换的实现机制</font></center>";
echo "<pre><font size=3>
恭喜！今天彻底弄通了任务切换的机制！	2020-3-10
首先，ljmp \$tss,$0 也可以实现从0特权级下转移到低特权级3的任务下执行，而非linux0.11下介绍的只能通过iret实现低特权级的代码转移
其次，在时钟中断代码中是如何真正实现不同任务的切换的，在时钟中断代码中，是通过ljmp转移到不同任务中去的。注意这样只能转移至不同任务。这是重点！
为啥？因为硬件平台需要一个不同的tss来保存当前的状态。而当前状态是指：当前的ss,esp,eflags,cs,eip。而eip是ljmp后面的第一条指令地址。注意这里的执
行顺序为：
ljmp切换至新任务，并同时保持当前状态至旧任务的tss中-->执行新任务-->再次发生时钟中断-->
新任务挂起，当前状态保存至新任务的tss中。保存在新任务中的eip为切换旧任务的ljmp后面的第一条指令地址-->
ljmp切换至最早挂起的旧任务中，恢复的运行状态是上次任务切换的ljmp后的那条指令，这也就完美的将时钟中断的代码连续的运行起来。
这其中最难理解的是tss中保存的状态并不仅仅是任务代码中的切换时的状态，他更保存了中断代码中的指令地址（这也正是我一直迷惑的地方）。
也就是可以理解为tss是将进行任务切换ljmp后的第一条指令当作了前一任务的指令保存在了换出任务的tss中，这样在下一次任务切换时，中断代码就会连续无缝执行了。

解释到这里，基本上就解决我之前最大的疑惑：时钟中断代码中ljmp后面的代码怎么继续执行？但是，到此还没结束！对，任务的切换并未影响到不同任务的连续运行，
既然任务切换发生在中断代码中，并且返回指令eip保存的是中断代码的一条指令地址，那恢复的任务是如何在其中断的下一条任务指令中连续运行的？
这就是通过时钟中断的iret来实现的。但是我们知道，通过iret来返回一个任务与普通的iret操作不同。如果没有任务的情况下，中断调用例程在执行时会自动的将当
前的eflags,cs,eip压入堆栈，当中断例程执行完成后又自动将上述入栈的信息恢复，以平衡堆栈并恢复中断前的运行状态。但是通过iret返回任务还需要更多的信息，
实际上中断例程在中断任务时他需要入栈的信息更多：ss，esp，elfags，cs，eip，这样iret指令才会在中断完成后成功的返回任务。那么中断例程是如何知道他在执行
前是入栈三条信息还是五条信息呢？而这就是80x86硬件机制来判断实现的，对！当cs中保存的是一个tss或者是任务门时，硬件机制就认为这是任务切换，则压入堆栈更
多的信息,否则，如果cs中仅是一个普通的代码段，陷阱门，中断门而非任务门或任务状态段时就只需保存三条信息。
当然这一切都需要验证的，于是我设计了一个验证程序，看看在普通代码下发生中断堆栈段是否保存了三条信息，而启动任务后是否中断例程入栈的信息为五条？
验证正确！！！

















</font></pre>";
echo "<a name=make></a><center><font color=red size=5>makefile '@' '$' '$$' '-' '-n ' 使用小结</font></center>";
echo "<pre><font size=3>
'@'  符号的使用
      通常makefile会将其执行的命令行在执行前输出到屏幕上。如果将‘@’添加到命令行前，这个命令将不被make回显出来。
      例如：@echo --compiling module----;  // 屏幕输出 --compiling module----
                               echo --compiling module----;  // 没有@ 屏幕输出echo --compiling module---- 
' - ' 符号的使用
     
     通常删除，创建文件如果碰到文件不存在或者已经创建，那么希望忽略掉这个错误，继续执行，就可以在命令前面添加 -，
     -rm dir；
     -mkdir aaadir；

' $ '符号的使用
          美元符号\$，主要扩展打开makefile中定义的变量

' $$ '符号的使用
          $$ 符号主要扩展打开makefile中定义的shell变量

例如：
     @for dir in $(subdirs); do \
          @echo -------compiling $\$dir-----------; \
          $(MAKE) -C $\$dir; \
     done
以上subdir属于makefile中定义的变量，而dir则属于makefile中定义的shell变量，所有使用是使用 ‘ $$ ’ 而不是 ' $ '。


如果make执行时，带入make参数“-n”或“--just-print”，那么其只是显示命令，但不会执行命令，这个功能很有利于我们调试我们的Makefile，看看我们书写的命令是执行起来是什么样子的或是什么顺序的。 

而make参数“-s”或“--slient”则是全面禁止命令的显示。
补充说明自动化变量：

$@  表示规则中的目标文件集。在模式规则中，如果有多个目标，那么，\"$@\"就是匹配于目标中模式定义的集合。


$%  仅当目标是函数库文件中，表示规则中的目标成员名。例如，如果一个目标是\"foo.a(bar.o)\"，那么，\"$%\"就是\"bar.o\"，\"$@\"就是\"foo.a\"。
如果目标不是函数库文件（Unix下是[.a]，Windows下是[.lib]），那么，其值为空。
 

$<   依赖目标中的第一个目标名字。如果依赖目标是以模式（即\"%\"）定义的，那么\"$<\"将是符合模式的一系列的文件集。注意，其是一个一个取出来的。
 

$?   所有比目标新的依赖目标的集合。以空格分隔。
 

$^   所有的依赖目标的集合。以空格分隔。如果在依赖目标中有多个重复的，那个这个变量会去除重复的依赖目标，只保留一份。

</font></pre>";
echo "<a name=lret></a><center><font color=red size=5>ret,lret,iret小结</font></center>";
echo "<pre><font size=3>
<center><table width=100% border=1><tr>
<td width=30%>ret相当于：</td><td width=30%>lret相当于：</td><td width=40%>iret相当于：</td></tr><tr>
<td width=30%>popl %eip<br>jmp %eip</td><td width=30%>popl %eip<br>popl %cs<br>jmp %cs,%eip</td>
<td width=30%>popl %eip<br>pop %cs<br>popfl<br>popl %esp<br>pop %ss<br>jmp %cs,%eip
</td></tr>

</table></center>
</font></pre><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
echo "<a name=x64></a><center><font color=red size=5>64位系统下编译32位c和汇编程序及模块</font></center>";
echo "<pre>---------------makefile:-------------------------
t02:t02.o f01.o
    gcc -m32 -o t02 t02.o f01.o
t02.o:t02.c
    gcc -m32 -c -o t02.o t02.c -I/workarea/cprogram/include
f01.o:f01.s
    as --32 -o f01.o f01.s
clean:
    -rm *.o t02
----------------------------------------------------------
--------------------f01.s--------------------------------
.code32
.type myadd,@function
.global myadd
myadd:
    pushl %ebp
    movl %esp,%ebp
    pushl %ebx
    pushl %eax
    movl 8(%ebp),%ebx
#   movl 12(%ebp),%eax
    movl (%ebx),%eax
    addl 12(%ebp),%eax
    movl %eax,(%ebx)
    popl %eax
    popl %ebx
    movl %ebp,%esp
    popl %ebp
    ret
----------------------------------------------------------
-------------------t02.c--------------------------------
#include\"clsscr.h\"
void myadd(int *a,int b);
int main(int argc,char **argv)
{
    int i,j;
    i=12;j=23;
    myadd(&i,j);
    printf(\"i=%d\\n\",i);
    return 0;
};
----------------------------------------------------------
ubuntu20.04 64位系统下要编译出32位c程序除了makefile中要求的-m32 --32选项外，还需要如下软件包的支持：

    $ sudo apt-get install build-essential module-assistant
    $ sudo apt-get install gcc-multilib g++-multilib  其中g++可暂时不安装
</pre><br><br><br><br><br><br><br><br><br><br><br><br><br>";
echo "<a name=asm_div></a><center><font color=red size=5>汇编指令mul和div使用避坑</font></center>";
echo "<pre>
一、这两条指令都是使用eax作为默认的操作寄存器，存放被乘数和被除数，
二、当使用div指令时应注意商不要溢出，否则会引发int 0中断，因此应适时选择divb,divw,divl使用，
三、当使用divw和divl指令时，为避免出现歧义，不要使用edx存放除数，（暂未测试）
四、mul指令所涉及的寄存器：

	mulb	操作的寄存器：乘数=8位寄存器；		被乘数=al；		结果=ax			（注：如此时ah != 0,ah不会参与计算，且会被覆盖）
	mulw	操作的寄存器：乘数=16位寄存器；		被乘数=ax；		结果=dx:ax		（dx无需清空， 且会被覆盖）
	mull	操作的寄存器：乘数=32位寄存器；		被乘数=eax； 		结果=edx:eax		（edx无需清空，且会被覆盖）

五、div指令所涉及的寄存器：

	divb	操作的寄存器：除数=8位寄存器；		被除数=ax；		结果：al=商，ah=余数	（注：此时dx不参与计算，dx无需清空）
	divw	操作的寄存器：除数=16位寄存器；		被除数=dx:ax；		结果：ax=商，dx=余数	（如被除数不大于16位，则dx务必清零，否则影响结果或引发int0）
	divl	操作的寄存器：除数=32位寄存器；		被除数=edx:eax；		结果：eax=商，edx=余数	（如被除数不大于32位，则edx务必清零，否则影响结果或引发int0）







</pre>";
echo "<a name=objcopy></a><center><font color=red size=5>objcopy拷贝c语言编写的模块文件生成目标文件过大的问题</font></center>";
echo "<pre>
2024-7-2，在使用objcopy生成目标文件时，偶然发现c编写的模块生成的目标文件有120多M，通过objdump查看模块文件发现了一个.note.gnu.property的章节，
首先在ubuntu20.04版本上发现的，添加参数 -R .note.gnu.property后生成的目标文件大小正常。













</pre>";
echo "<a name=gld></a><center><font color=red size=5>关于static,extern的作用域</font></center>";
echo "<pre>
一、extern：extern声明的函数或变量为全局性的，也即跨模块可用的，一般在头文件中声明，其他模块只要包含了该头文件即可调用。
也可以不使用extern声明，但在调用他的源文件中使用extern声明。效果一样。如果需在多个模块中调用，最好在头文件中声明，这样
一次声明，多次使用。
二、static：static声明的函数或变量是静态的，可以为全局，也可以为局部（函数体内），局部静态变量只能在声明的函数内可见，
且能在函数执行完后保持其值。全局静态一般是配合内联函数的声明使用。static inline void (*func)(int pata);该声明的函数可能
在编译链接时保存独立的代码模块。而extern inline声明的内联函数则不会生成独立的代码模块。
另外，声明的静态全局变量其作用域不能跨模块的，只能作用于当前头文件对应的源代码文件生成的模块中。即便所定义的头文件包含进
其他模块中，依然不能公用，而是每个模块独立的静态变量。仅仅是变量名相同而已。








</pre>";
echo "<a name=toys_task></a><center><font color=red size=5>TOYS近期问题汇总（2025-02-06）</font></center>";
echo "<pre>
一、问题描述：执行到一定位置，突然出现各种莫名其妙的错误，并且错误各不相同，有时设置断点也执行不到，但查看断点之前的代码根本没有异常。更玄幻的是有时断点
	有效，但在断点前加个赋值语句断点就无法触发。起初我以为是编译链接出现的问题，通过反复查看makefile，调整各种参数，问题依然无法解决。检查内核镜像生成的
	过程并通过十六进制编辑器和objdump -d 查看镜像生成过程和反汇编镜像也没有问题。
	问题解决：通过对各种可能最存在问题地方的排查，内核镜像的生成和代码问题已经排除，但问题依然没有解决，在查看内核加载前代码的时候发现了疑点，就是在head
	代码和boot代码中，内核从磁盘的读取到目标前位置的加载中间有太多的初始化代码，会不会在初始化期间有对内核代码的非预期改动？于是我将head移动至目标位置的
	函数提前至head的起始位置。再次编译链接，问题完全消除！但我还没对非预期改动的地方进行排查，以后有时间我再进行排查，估计是初始化使用的临时缓冲区设在了
	已读取但尚未移动至目标位置前内核代码的存储区域。
二、问题描述：在执行任务切换测试时，总是不成功。看bochs信息，cr3已顺利切换，虽然不能执行，可对目标位置的读取也是正确的。段寄存器的加载也变为了ring3的特权
	可是段基地址和段限长显然不正确，bochs的错误提示为代码段选择符错误。
	问题解决：根据错误的提示，我一直以为应该是用于任务的局部描述符表设计错误。对ldt做了直观的修改后仍不能正确加载。反复对tss,ldt,pdt进行检查也没有错误的地
	方。无奈查看之前写的成功的练习代码，并沿用了练习代码，测试成功。通过新旧代码的比较，并对比较结果逐一测试，终于找到（弄清）了错误所在，问题还不止一处，
	这些错误源于我对描述附表，页目录表等的认识还不深刻：首先对与描述符表的设计，在开启了分页模式下，代码段的描述符不应有大于0的段基地址。但是堆栈段
	（数据段）和其他段可以。而我的新内核设置的局部描述附表的设置直接将代码段的基地址设为了默认的任务执行地址（64M起始），未开启分页模式的情况我还没有测试。
	在就是页目录表（页表）的设置，<del><font color=red>对于有效线性地址前的地址也需要在页目录表中进行映射，虽然不一定是有效映射。但页表项设计必须符合要求。为了处理简单，可将内</font></del>
	<del><font color=red>核使用的页表项直接拷贝过来填充。</font></del>访问权限保持ring0。然后自任务的有效线性地址开始写入任务可访问的页目录项。修改后测试成功启动首个用户级别的任务。
	2025-02-17,经过测试上述结论并不正确，在页表中可以存在为空的页表项，之所以上述操作能成功，原因不在是否含有空表项，而是<font color=red>即便是用户任务的页目录表/页表也必
	须要包含中断执行所需的页映射，因为在中断发生时不会自动的切换至任务0的cr3！！任务0实际上不是一个任务，他可以没有ldt,这是我之前的一个错误认识。当不切换cr3
	时，任务1包括以后的所有任务都要含有能映射中断执行代码的页目录/页表项。而任务0之所以要设置tss,一是后续任务切换的需要，二是只有在没有其他任务执行时，才会
	执行这个任务，而其tss的目的就是tss中设置的内核cr3以及堆栈中保存的继续执行时钟中断中jmpl后面的代码地址。--目前还未测试，不过可以确定这是正确的！</font>
三、问题描述：这是一个小问题，就是在前面错误修正后一是为了对代码继续验证，二是便于后期对用户任务的启动地址进行修改。我又修改了默认的任务启动地址RUNNING_AD
	此时，我对任务状态段tss中相关的任务启动地址和页目录项的设置都使用了RUNNING_AD宏，按说只要修改下RUNNING_AD的数值即可在新地址启动。但是测试又出现了错误。
	问题解决：虽然出现了问题，但我知道这不是个大问题，还是有修改不到的地方。再次查看了相关代码。发现问题在ldt的堆栈设置上，因为ldt的设置是在head代码中。因
	此与RUNNING_AD的设置无关，修改后问题解决。
四、<font color=red>2025-02-18</font>关于硬盘驱动的问题和总结
	一、在前期编写、测试硬盘驱动代码时，对之前的驱动代码和中断的产生有了更加深刻的认识：首先，对于磁盘读写命令（读、写、格式化）操作，如果不是多扇区操作命令，
	则每完成一次扇区读写就产生一次中断，连续的读写操作硬盘控制器会自动的按照CHS进行累加操作无需每次扇区读写对控制器参数进行修改。但是中断产生的时机顺序读写操
	作完全不同。读硬盘操作是在控制器发出命令后硬盘准备好读取的数据时发生，获取的数据要在中断中实现，写硬盘操作则是控制器发出命令后，先向硬盘执行写入操作并成功
	后发生，后续的写操作在中断中实现，即发出写操作命令后须先执行一次写操作才会产生中断。
	二、在编写文件系统代码时，因需将超级块和文件节点读入内存，在执行读硬盘操作时发现一个奇怪的错误：本来要一次读取0x1cc(460)个扇区的数据，结果只读取了（0xcc）
	204个扇区。测试写扇区可以一次写入460个，反复检查硬盘驱动代码读写操作没有任何差别。最后发现，读错误的产生和正确写的原因来自两个方面，一是AT硬盘参数控制器在
	输入参数时，读写操作的扇区数是字节大小的，即每次最多操作256个扇区，这可以解释读操作不能一次读入460个扇区的错误了，但为何写操作成功了？通过加入测试代码，写
	操作确实成功写入460个扇区。这个差异就产生在产生中断的顺序不同，也就是只要有写数据就会有中断，计数不管用了吗？当然管用，但是作用不像读操作那么大;-)因为在操
	作完计数器中的计数后还会产生一次中断，而最后一次中断本不该继续发送写数据了，但控制器之外的计数是按照0x1cc计算的，而不是传给控制器的0xcc。这样就人为的继续写
	数据，而控制器中的计数在归零后依然可以操作。因为默认传送0给控制器计数器意味者是256！哈哈，自此问题圆满解决，






</pre>";
echo "<a name=toys_define></a><center><font color=red size=5>#define和#、##、@#解析：</font></center>";
echo "<pre>
		本文详细解释了C语言预处理中的#define指令，包括标识符定义、函数定义、续行操作，以及其在方便维护、简化写法和条件编译等方面的作用。同时介绍了字符串常量化、符号连接
	和单字符化操作符的用法和注意事项。
	1.什么是预处理：

	C语言源文件要经过预处理、编译、链接才能生成可执行程序。
	预处理就是再编译前，对源文件进行简单的加工处理。
	预处理主要是以 # 开头的命令，例如 #include<stdio.h> #define 等。
	预处理命令要放在所有函数之外，而且一般都放在源文件的前面。

	2.#define是什么：

	#define 属于预处理器指令，可以将一些常量或代码模块定义为宏，在预处理是进行文本替换，这个行为被称为宏替换或宏展开。

	一.关于#define:
	1）.#define 的标识符定义：
	定义标识符是 #define 最常见的用法，也可以说是没有参数的宏定义。
	流程为：
	#define -----> 标识符（也叫宏名、宏） ------>替换列表。
	示例：
	#include&lt;stdio.h&gt;
	#define num 20
	int main()
	{
		printf(\"%d\",num);
		return 0;
	}
	2）.#define 的函数定义：
	简单来说，就是 #define 的宏定义可以像函数一样接受参数。
	示例：
	#include&lt;stdio.h&gt;
	#define add(x,y)	((x)+(y))
	#define max(x,y)	((x)>)(y)?(x):(y))
	int main()
	{
		printf(\"%d\\n\",add(2,3));
		printf(\"%d\\n\",max(2,3));
		return 0;
	}
	这里我们定义了两个名为 add ，max 的宏，进行文本替换后分别求出参数之和和参数中最大值。
	3）#define 的续行操作：
	顾名思义就是将 #define 的替换列表放在二行及更多行上。

	4）#define 的常见作用：
	a.方便维护：
	b.方便程序员检测：
	当看别人的代码时，或者回头观看以前的代码，通常会忘记一个代码块代表的含义，当使用如 add  等宏定义的函数时，可以帮助我们快速理解。
	c.简化写法：
	当我们需要经常使用 unsigned short int 时，由于该类型较长，经常会 觉得麻烦，这时候就可以通过将其定义为 usi ，并可以通过 usi 创建变量。
	d.进行条件编译：
	示例：
	#define aaa	0
	#ifdef aaa
		printf(\"1\");
	#endif
	二.关于字符串常量化运算符 # ：
	1）.常见用法:
	示例：
	#include&lt;stdio.h&gt;
	#define print(a,b)	printf(#a\"and %d\\n\",b);
	int main(){
		print(abc,3);
		return 0;
	}
	result:	abc and 3
	由此，我们可以知道，在宏定义中，当需要把一个宏的参数转换为字符串常量时，则使用字符串常量化运算符（#）。在宏中使用的该运算符有一个特定的参数或参数列表。
	2）.对空格处理：
	示例：
	#include&lt;stdio.h&gt;
	#define print(a,b)	printf(#a\"and %d\\n\",b);
	int main(){
		print( ab  c,3);
		return 0;
	}
	result:	ab c and 3
	由此，我们可以知道，编译器会将子字符或者字子符串使用空格连接，并丢弃字符或字符串两边的空格。
	三.符号连接操作符符 ##：
	示例：
	#include&lt;stdio.h&gt;
	#define num1	100
	#define num(x)	num##x
	int main(){
		printf(\"%d\",num(1));
		return 0;
	}
	result:	100
	这里我们通过符号链接操作符 ## 将 num 和 1 连接成 num1 。
	<font color=red>注：1）.宏展开时， ## 两边的空格会自动去除。
        2）.连接后的实际参数名，必须为实际存在的参数名或是编译器已知的宏定义。
        3）.如果##后的参数本身也是一个宏的话，##会阻止这个宏的展开。</font>
	四.单字符化操作符 #@ ：
	用法与##类似。
	示例：
	#include&lt;stdio.h&gt;
	#define func(a)		#@a
	int main(){
		printf(\"%c\",func(a));
		return 0;
	}
	result:	a
	<font color=red>这里通过 #@ 操作符，将 a 转换成字符。
	注：单字符化操作符#@ 最多有四个参数，并只返回最后一个字符，当参数超过四个时，系统将报错。
	注意事项：
	1.define是宏定义，程序在预处理阶段将用define定义的内容进行了 替换 。因此在程序运行时，常量表中并没有用define定义的常量，系统不为它分配内存。
	2.define没有类型检查的功能，因为它只进行文本替换。它只是简单地将宏调用替换为宏定义中指定的文本，没有对文本进行语法分析和类型检查。这种情况下，类型错误很容易发生，特别是对于复杂的宏定义。
	3.define定义表达式时要注意边缘效应。</font>
</pre>";
?>
