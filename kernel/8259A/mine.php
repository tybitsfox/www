<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<pre>
<a name=8259A></a>
<center><font color=red size=5>8259A中断控制器</font></center>
pdf文档的相关资料请参看：linux0.11kerlen <font color=blue>P222</font> <font color=blue>P31</font>(zathura)另一个资料：<a href=4-3.htm target=_blank>8259A中断控制器</a>
我已经顺利的完成了两级级联的8259A中断控制器的编程，目前编程主要涉及的是对两个芯片初始化、中断号的重新设定、工作方式和屏蔽中断请求的操作。
对8259A进一步的测试还没有进行，以后有时间会慢慢测试的。有关8259A详细的资料请看pdf文档，这里仅记录下我在实际操作过程中对8259A的认识和理解
下面所说都是针对两级级联的情况：
一、8259A的端口：<font color=blue>主芯片：0x20，0x21，从芯片：0xa0，0xa1</font>
实际上每个芯片上的两个端口是一致的，关键在于控制器上的A0线，当A0=0时，端口号为0x20（0xa0），当A0=1时，端口号就为0x21（0xa1）
二、8259A的工作方式：8259A有4种工作方式：
（1）全嵌套方式
（2）循环优先级方式
（3）特殊屏蔽方式
（4）程序查询方式
linux0.11版本使用的工作方式为：普通全嵌套方式，8086模式，非缓冲，非自动结束，<font color=blue>所对应的命令字为：0x1</font>
三、8259A的命令字：有两种命令字分别为ICW和OCW，ICW为初始化命令字，又有4种分别是ICW1～ICW4，OCW为操作命令字，有三种：OCW1～OCW3
<font color=red>初始化命令字：</font>
（1）ICW1的格式：
<table wodth=50% border=1>
<tr><td width=30%>位</td><td width=30%>名称</td><td width=40%>含义</td></tr>
<tr><td width=30%>D7</td><td width=30%>A7</td><td width=40%>A7～A5用于MCS80/85，对X86处理器无用</td></tr>
<tr><td width=30%>D6</td><td width=30%>A6</td><td width=40%></td></tr>
<tr><td width=30%>D5</td><td width=30%>A5</td><td width=40%></td></tr>
<tr><td width=30%>D4</td><td width=30%>1</td><td width=40%>恒为1</td></tr>
<tr><td width=30%>D3</td><td width=30%>LTIM</td><td width=40%>1-电平触发中断，0-边沿触发中断</td></tr>
<tr><td width=30%>D2</td><td width=30%>ADI</td><td width=40%>用于MCS80/85，X86无用</td></tr>
<tr><td width=30%>D1</td><td width=30%>SNGL</td><td width=40%>1-单片8259A，0-多片</td></tr>
<tr><td width=30%>D0</td><td width=30%>IC4</td><td width=40%>1-需要ICW4，0-不需要</td></tr>
</table>
注意ICW1的发送需要A0=0时操作，也就是该命令字是发往0X20,0XA0的端口上的。至于怎样控制A0，由于没有资料，本人的猜测为：A0的选择是基于编程时所用的
是哪个端口（奇、偶端口地址）来确定的。是端口决定A0，而非A0确定端口。
在linux0.11中，<font color=blue>初始化命令字ICW1的默认取值为0X11</font>，表示需要ICW4
<font color=blue>命令字操作端口：0X20，0XA0</font>
（2）ICW2：用于设置芯片送出的中断号的高5位，也就是8259A对起始中断号的设置是8对齐的，因为每个芯片可以送出8个中断号，后面的中断号是依据初始中断号
递增得到的，而初始中断号不可以指定为非8对齐的号码。在linux0.11中，<font color=blue>主芯片初始化命令字ICW2为0X20，从芯片取值为0X28</font>
<font color=blue>命令字操作端口：0X21，0XA1</font>
（3）ICW3：用于多片级联时，主芯片指定的通过那个IR引脚连接从芯片的INT，以及指定从芯片的标识号。对于主芯片，如果其位0-位7哪一位=1表示该位对应的IR
引脚连接一个从芯片。对于从芯片，其位0-2表示该从芯片对应的在级联中的连接序号（标识号）。
在linux0.11中，<font color=blue>主芯片的ICW3默认取值为0X4，表示IR2引脚连接从芯片。从芯片默认取值为0X2，表示为第二个级联的芯片</font>
<font color=blue>命令字操作端口：0X21，0XA1</font>
（4）ICW4：当ICW1的位0置位时，表示还需要设置ICW4。ICW4的格式为：
<table wodth=50% border=1>
<tr><td width=30%>位</td><td width=30%>名称</td><td width=40%>含义</td></tr>
<tr><td width=30%>D7</td><td width=30%>0</td><td width=40%>恒为0</td></tr>
<tr><td width=30%>D6</td><td width=30%>0</td><td width=40%>恒为0</td></tr>
<tr><td width=30%>D5</td><td width=30%>0</td><td width=40%>恒为0</td></tr>
<tr><td width=30%>D4</td><td width=30%>SFNM</td><td width=40%>1-特殊全嵌套方式，0-普通全嵌套方式</td></tr>
<tr><td width=30%>D3</td><td width=30%>BUF</td><td width=40%>1-缓冲方式，0-非缓冲方式</td></tr>
<tr><td width=30%>D2</td><td width=30%>M/S</td><td width=40%>1-缓冲方式下主片，0-缓冲方式下从片</td></tr>
<tr><td width=30%>D1</td><td width=30%>AEOI</td><td width=40%>1-自动结束中断方式，0-非自动结束方式</td></tr>
<tr><td width=30%>D0</td><td width=30%>uPM</td><td width=40%>1-8086/88处理器系统，0-MCS80/85系统</td></tr>
</table>
linux0.11中，<font color=blue>送往主、从芯片的的ICW4的取值都为0X1</font>表示8259A芯片被设置为普通全嵌套、非缓冲、非自动结束中断方式，并且8086兼容系统。
<font color=blue>命令字操作端口：0X21，0XA1</font>
<font color=red>操作命令字：</font> 操作命令字在初始化完成后可随时对2859A进行设置操作。
（1）OCW1：该命令字用于对8259A的中断屏蔽寄存器IMR进行读写操作。该操作字位0-7对应该芯片上的8个中断请求。
在linux0.11的初始化中先设置屏蔽所有中断，因此送出的OCW1取值为0XFF。
<font color=blue>命令字操作（读、写）端口：0X21，0XA1</font>
（2）OCW2：用于发送EOI命令或设置中断优先级的自动循环方式，对于设置为非自动结束方式的8259A，这是编程中最常用到的一个操作：发送0X20到端口0X20或者0XA0以手
动方式告知8259A中断处理结束。
OCW2的命令字格式：
<table wodth=50% border=1>
<tr><td width=30%>位</td><td width=30%>名称</td><td width=40%>含义</td></tr>
<tr><td width=30%>D7</td><td width=30%>R</td><td width=40%>优先级循环状态</td></tr>
<tr><td width=30%>D6</td><td width=30%>SL</td><td width=40%>优先级设定标志</td></tr>
<tr><td width=30%>D5</td><td width=30%>EOI</td><td width=40%>非自动结束标志</td></tr>
<tr><td width=30%>D4</td><td width=30%>0</td><td width=40%>恒为0</td></tr>
<tr><td width=30%>D3</td><td width=30%>0</td><td width=40%>恒为0</td></tr>
<tr><td width=30%>D2</td><td width=30%>L2</td><td width=40%>L2-0 3位组成级别号</td></tr>
<tr><td width=30%>D1</td><td width=30%>L1</td><td width=40%>分别对应中断请求级别IRQ0--IRQ7（或IRQ8-IRQ15）</td></tr>
<tr><td width=30%>D0</td><td width=30%>L0</td><td width=40%></td></tr>
</table>
<font color=blue>命令字操作（读、写）端口：0X20，0XA0</font>
（3）OCW3：用于设置特殊屏蔽方式和读取寄存器状态（IRR和ISR），在linux0.11中并未用到该命令字。OCW3命令字的格式：
<table wodth=50% border=1>
<tr><td width=30%>位</td><td width=30%>名称</td><td width=40%>含义</td></tr>
<tr><td width=30%>D7</td><td width=30%>0</td><td width=40%>恒为0</td></tr>
<tr><td width=30%>D6</td><td width=30%>ESMM</td><td width=40%>对特殊屏蔽方式操作，D6-D5为11-设置特殊屏蔽，10-复位特殊屏蔽</td></tr>
<tr><td width=30%>D5</td><td width=30%>SMM</td><td width=40%></td></tr>
<tr><td width=30%>D4</td><td width=30%>0</td><td width=40%>恒为0</td></tr>
<tr><td width=30%>D3</td><td width=30%>1</td><td width=40%>恒为1</td></tr>
<tr><td width=30%>D2</td><td width=30%>P</td><td width=40%>1-查询（poll）命令，0-无查询命令</td></tr>
<tr><td width=30%>D1</td><td width=30%>RR</td><td width=40%>在下一个DR脉冲时读寄存器状态</td></tr>
<tr><td width=30%>D0</td><td width=30%>RIS</td><td width=40%>D1-0为11-读正在服务寄存器ISR，10-读终端请求寄存器IRR</td></tr>
</table>


<a name=cmos></a>
<center><font color=red size=5>cmos信息</font></center>
pdf文档的相关资料请参看：linux0.11kerlen <font color=blue>P252</font>(zathura)
pc的cmos内存是由电池供电的64或128字节的内存块，通常是系统实时钟芯片的一部分，有些会有更大的容量。存放的时间为BCD格式
cmos的地址空间在基本地址空间之外，因此其中不包括可执行的代码。要访问他需要通过端口<font color=blue>0X70,0X71</font>进行，
其中0X70是地址端口，0X71是数据端口。操作时需先发送地址偏移到0X70端口，再从0X71数据端口读、写数据即可。
下面是cmos64字节信息简表：
<center><table width=80% border=1>
<tr>
<td width=20% align=center>地址偏移值</td>
<td width=30% align=center>内容说明</td>
<td width=20% align=center>地址偏移值</td>
<td width=30% align=center>内容说明</td>
</tr>
<tr>
<td width=20% align=center>0x00</td>
<td width=30% align=center>当前秒值（实时钟）</td>
<td width=20% align=center>0x11</td>
<td width=30% align=center>保留</td>
</tr>
<tr>
<td width=20% align=center>0x01</td>
<td width=30% align=center>报警秒值</td>
<td width=20% align=center>0x12</td>
<td width=30% align=center>硬盘驱动类型</td>
</tr>
<tr>
<td width=20% align=center>0x02</td>
<td width=30% align=center>当前分钟（实时钟）</td>
<td width=20% align=center>0x13</td>
<td width=30% align=center>保留</td>
</tr>
<tr>
<td width=20% align=center>0x03</td>
<td width=30% align=center>报警分钟值</td>
<td width=20% align=center>0x14</td>
<td width=30% align=center>设备字节</td>
</tr>
<tr>
<td width=20% align=center>0x04</td>
<td width=30% align=center>当前小时（实时钟）</td>
<td width=20% align=center>0x15</td>
<td width=30% align=center>基本内存（低字节）</td>
</tr>
<tr>
<td width=20% align=center>0x05</td>
<td width=30% align=center>报警小时值</td>
<td width=20% align=center>0x16</td>
<td width=30% align=center>基本内存（高字节）</td>
</tr>
<tr>
<td width=20% align=center>0x06</td>
<td width=30% align=center>一周中的天（实时钟）</td>
<td width=20% align=center>0x17</td>
<td width=30% align=center>扩展内存（低字节）</td>
</tr>
<tr>
<td width=20% align=center>0x07</td>
<td width=30% align=center>一月中的当日（实时钟）</td>
<td width=20% align=center>0x18</td>
<td width=30% align=center>扩展内存（高字节）</td>
</tr>
<tr>
<td width=20% align=center>0x08</td>
<td width=30% align=center>当前月份（实时钟）</td>
<td width=20% align=center>0x19～0x2d</td>
<td width=30% align=center>保留</td>
</tr>
<tr>
<td width=20% align=center>0x09</td>
<td width=30% align=center>当前年份（实时钟）</td>
<td width=20% align=center>0x2e</td>
<td width=30% align=center>校验和（低字节）</td>
</tr>
<tr>
<td width=20% align=center>0xa</td>
<td width=30% align=center>RTC状态寄存器A</td>
<td width=20% align=center>0x2f</td>
<td width=30% align=center>校验和（高字节）</td>
</tr>
<tr>
<td width=20% align=center>0x0b</td>
<td width=30% align=center>RTC状态寄存器B</td>
<td width=20% align=center>0x30</td>
<td width=30% align=center>1M以上扩展内存（低字节）</td>
</tr>
<tr>
<td width=20% align=center>0x0c</td>
<td width=30% align=center>RTC状态寄存器C</td>
<td width=20% align=center>0x31</td>
<td width=30% align=center>1M以上扩展内存（高字节）</td>
</tr>
<tr>
<td width=20% align=center>0x0d</td>
<td width=30% align=center>RTC状态寄存器D</td>
<td width=20% align=center>0x32</td>
<td width=30% align=center>当前所处实际值</td>
</tr>
<tr>
<td width=20% align=center>0x0e</td>
<td width=30% align=center>POST诊断状态字</td>
<td width=20% align=center>0x33</td>
<td width=30% align=center>信息标志</td>
</tr>
<tr>
<td width=20% align=center>0x0f</td>
<td width=30% align=center>停机状态字</td>
<td width=20% align=center>0x34～0x3f</td>
<td width=30% align=center>保留</td>
</tr>
<tr>
<td width=20% align=center>0x10</td>
<td width=30% align=center>磁盘驱动器类型</td>
<td width=20% align=center></td>
<td width=30% align=center></td>
</tr>
</table></center>






</pre>";
echo "<a name=hd_control><center><font color=red size=5>AT硬盘控制器编程说明</font></center><pre>
一、AT硬盘控制器寄存器端口及作用
<table width=60% border=1>
<tr>
<td width=10%>端口</td>
<td width=20%>名称（linux0.11）</td>
<td width=35%>读操作</td>
<td width=35%>写操作</td>
</tr>
<tr>
<td width=10%>0x1f0</td>
<td width=20%>HD_DATA</td>
<td width=70% colspan=2>数据寄存器 -扇区数据（读、写、格式化）insw,outsw</td>
</tr>
<tr>
<td width=10%>0x1f1</td>
<td width=20%>HD_ERROR,HD_PRECOMP</td>
<td width=35%>错误寄存器,错误代码(HD_ERROR)</td>
<td width=35%>写补偿寄存器(HD_PRECOMP)</td>
</tr>
<tr>
<td width=10%>0x1f2</td>
<td width=20%>HD_HSECTOR</td>
<td width=70% colspan=2>扇区数寄存器 -扇区数（读、写、校验、格式化）</td>
</tr>
<tr>
<td width=10%>0x1f3</td>
<td width=20%>HD_SECTOR</td>
<td width=70% colspan=2>扇区号寄存器 -起始扇区（读、写、校验、格式化）</td>
</tr>
<tr>
<td width=10%>0x1f4</td>
<td width=20%>HD_LCYL</td>
<td width=70% colspan=2>柱面号寄存器 -柱面号低字节（读、写、校验、格式化）</td>
</tr>
<tr>
<td width=10%>0x1f5</td>
<td width=20%>HD_HCYL</td>
<td width=70% colspan=2>柱面号寄存器 -柱面号高字节（读、写、校验、格式化）</td>
</tr>
<tr>
<td width=10%>0x1f6</td>
<td width=20%>HD_CURRENT</td>
<td width=70% colspan=2>驱动器/磁头寄存器 -驱动器号/磁头号（101dhhhh,d=驱动器，h=磁头号）</td>
</tr>
<tr>
<td width=10%>0x1f7</td>
<td width=20%>HD_STATUS,HD_COMMAND</td>
<td width=35%>主状态寄存器(HD_STATUS)</td>
<td width=35%>命令寄存器(HD_COMMAND)</td>
</tr>
<tr>
<td width=10%>0x3f6</td>
<td width=20%>HD_CMD</td>
<td width=35%>--</td>
<td width=35%>硬盘控制寄存器</td>
</tr>
<tr>
<td width=10%>0x3f7</td>
<td width=20%></td>
<td width=35%>数字输入寄存器(与1.2M软盘合用)</td>
<td width=35%></td>
</tr>
</table>
各寄存器端口的说明：
（1）<font color=blue>0x1f0</font>数据寄存器：是硬盘数据读写的16位高速PIO传输器，cpu通过该寄存器每次读、写一个扇区的数据。所以应使用
<font color=blue>rep insw或者rep outsw</font>重复读写ecx=256个字的数据。
（2）<font color=blue>0x1f1</font>错误寄存器（读）/写补偿寄存器（写）：读操作时该寄存器存放了8位错误代码，但是只有在主状态寄存器（0x1f7）
的位0=1时该寄存器才有效。
硬盘控制器错误寄存器代码说明：
<table width=60% border=1>
<tr>
<td width=10%>值</td><td width=20%>诊断命令时</td><td width=20%>其他命令时</td>
<td width=10%>值</td><td width=20%>诊断命令时</td><td width=20%>其他命令时</td>
</tr>
<tr>
<td width=10%>0x01</td><td width=20%>无错误</td><td width=20%>数据标志丢失</td>
<td width=10%>0x05</td><td width=20%>控制处理器错</td><td width=20%></td>
</tr>
<tr>
<td width=10%>0x02</td><td width=20%>控制器出错</td><td width=20%>磁道0错</td>
<td width=10%>0x10</td><td width=20%></td><td width=20%>ID未找到</td>
</tr>
<tr>
<td width=10%>0x03</td><td width=20%>扇区缓冲区错</td><td width=20%></td>
<td width=10%>0x40</td><td width=20%></td><td width=20%>ECC错误</td>
</tr>
<tr>
<td width=10%>0x04</td><td width=20%>ECC部件错误</td><td width=20%>命令放弃</td>
<td width=10%>0x80</td><td width=20%></td><td width=20%>坏扇区</td>
</tr>
</table>
写操作时，该寄存器为写补偿寄存器。写补偿参数在硬盘参数表0x5偏移处开始的一个字，使用时要将该字除以4，再写入该寄存器
目前的大硬盘都忽略了该参数。
（3）<font color=blue>0x1f2</font>扇区数寄存器：保存了需要操作的扇区数，每完成一个扇区的操作该值自动减一，直至为0。若初始值为0则表示256个扇区
（4）<font color=blue>0x1f3</font>扇区号寄存器：保存了操作起始的扇区号，每完成一个扇区的操作该值自动加一。
（5）<font color=blue>0x1f4,0x1f5</font>柱面号寄存器：保存了低8位和高2位的柱面号。
（6）<font color=blue>0x1f6</font>驱动器/磁头寄存器：保存了操作所需的驱动器和磁头号。其格式为101dhhhh，其中101表示采用ECC校验和每扇区512字节，
d表示驱动器号，hhhh表示磁头号。
（7）<font color=blue>0x1f7</font>主状态寄存器（读）/命令寄存器（写）：在执行读操作时，对应一个8位的主状态寄存器，
状态字节含义如下：
<table width=60% border=1>
<tr><td width=10%>位</td><td width=20%>linux名称</td><td width=10%>屏蔽码</td><td width=60%>说明</td></tr>
<tr><td width=10%>0</td><td width=20%>ERR_STAT</td><td width=10%>0x1</td><td width=60%>命令执行错误</td></tr>
<tr><td width=10%>1</td><td width=20%>INDEX_STAT</td><td width=10%>0x2</td><td width=60%>收到索引</td></tr>
<tr><td width=10%>2</td><td width=20%>ECC_STAT</td><td width=10%>0x4</td><td width=60%>ECC校验错误</td></tr>
<tr><td width=10%>3</td><td width=20%>DRQ_STAT</td><td width=10%>0x8</td><td width=60%>数据请求服务，该位置位时表示数据端口有数据可传输</td></tr>
<tr><td width=10%>4</td><td width=20%>SEEK_STAT</td><td width=10%>0x10</td><td width=60%>驱动器寻道结束</td></tr>
<tr><td width=10%>5</td><td width=20%>WRERR_STAT</td><td width=10%>0x20</td><td width=60%>驱动器故障（写出错）</td></tr>
<tr><td width=10%>6</td><td width=20%>READY_STAT</td><td width=10%>0x40</td><td width=60%>驱动器准备好（就绪）</td></tr>
<tr><td width=10%>7</td><td width=20%>BUSY_STAT</td><td width=10%>0x80</td><td width=60%>控制器忙碌</td></tr>
</table>
当执行写操作时，该端口对应命令寄存器，接受cpu发出的硬盘控制命令，共有8种命令：
<table width=60% border=1>
<tr>
<td width=15% colspan=2 rowspan=2>命令名称</td><td width=20% colspan=2>命令码字节</td><td width=15% rowspan=2>默认值</td>
<td width=15% rowspan=2>命令执行结束方式</td>
</tr><tr>
<td width=15%>高4位</td><td width=20%>D3 D2 D1 D0</td>
</tr><tr>
<td width=15%>WIN_RESTORE</td><td width=20%>驱动器重新校正（复位）</td><td width=15%>0x1</td>
<td width=20%>R R R R</td><td width=15%>0x10</td><td width=15%>中断</td>
</tr><tr>
<td width=15%>WIN_READ</td><td width=20%>读扇区</td><td width=15%>0x2</td>
<td width=20%>0 0 L T</td><td width=15%>0x20</td><td width=15%>中断</td>
</tr><tr>
<td width=15%>WIN_WRITE</td><td width=20%>写扇区</td><td width=15%>0x3</td>
<td width=20%>0 0 L T</td><td width=15%>0x30</td><td width=15%>中断</td>
</tr><tr>
<td width=15%>WIN_VERIFY</td><td width=20%>扇区检查</td><td width=15%>0x4</td>
<td width=20%>0 0 0 T</td><td width=15%>0x40</td><td width=15%>中断</td>
</tr><tr>
<td width=15%>WIN_FORMAT</td><td width=20%>格式化磁道</td><td width=15%>0x5</td>
<td width=20%>0 0 0 0</td><td width=15%>0x50</td><td width=15%>中断</td>
</tr><tr>
<td width=15%>WIN_INIT</td><td width=20%>控制器初始化</td><td width=15%>0x6</td>
<td width=20%>0 0 0 0</td><td width=15%>0x60</td><td width=15%>中断</td>
</tr><tr>
<td width=15%>WIN_SEEK</td><td width=20%>寻道</td><td width=15%>0x7</td>
<td width=20%>R R R R</td><td width=15%>0x70</td><td width=15%>中断</td>
</tr><tr>
<td width=15%>WIN_DIAGNOSE</td><td width=20%>控制器诊断</td><td width=15%>0x9</td>
<td width=20%>0 0 0 0</td><td width=15%>0x90</td><td width=15%>中断或空闲</td>
</tr><tr>
<td width=15%>WIN_SPECIFY</td><td width=20%>建立驱动器参数</td><td width=15%>0x9</td>
<td width=20%>0 0 0 1</td><td width=15%>0x91</td><td width=15%>中断</td>
</tr>
</table>
表中命令码字节的低4位是附加参数，其含义为：
R：步进速率，=0则为35us，R=1为0.5ms，以次量递增，默认为R=0
L：数据模式，=0表示读/写扇区为512字节，=1表示读/写扇区为512+4字节的ECC码，默认为0
T：重试模式，=0表示允许重试，=1则禁止重试，默认为0
（8）<font color=blue>0x3f6</font>硬盘控制寄存器：该寄存器是只写的，用于存放硬盘控制字节并控制复位操作。
该控制字节与硬盘参数表中偏移0x8处的字节相同，含义如下：
<table width=60% border=1>
<tr><td width=15%>在参数表中偏移</td><td width=5%>大小</td><td width=80% colspan=2>说明</td></tr>
<tr><td width=15% rowspan=8>0x08</td><td width=5% rowspan=8>字节</td><td width=10%>位0</td><td width=70%>未用</td></tr>
<tr><td width=10%>位1</td><td width=70%>保留0（关闭IRQ）</td></tr>
<tr><td width=10%>位2</td><td width=70%>允许复位</td></tr>
<tr><td width=10%>位3</td><td width=70%>若磁头数大于8则置1</td></tr>
<tr><td width=10%>位4</td><td width=70%>未用（0）</td></tr>
<tr><td width=10%>位5</td><td width=70%>若在柱面数+1处有生产商的坏区图，则置1</td></tr>
<tr><td width=10%>位6</td><td width=70%>禁止ECC重试</td></tr>
<tr><td width=10%>位7</td><td width=70%>禁止访问重试</td></tr>
</table>
<font color=red>二、AT硬盘控制器编程
硬盘控制器相对与软盘控制器编程要简单许多，并且操作统一，所有的操作都是由6条参数（每条参数1字节）+1条命令（1字节）完成，将这7字节的
参数和命令依次写入端口0x1f1～0x1f7。写入完成后即开始执行命令，所有的操作（包括读写）结果都可以在硬盘中断函数中获取。
命令格式如下：
</font>
<table width=60% border=1>
<tr><td width=20%>端口</td><td width=30%>说明</td><td width=20%>端口</td><td width=30%>说明</td></tr>
<tr><td width=20%>0x1f1</td><td width=30%>写补偿起始柱面号</td><td width=20%>0x1f5</td><td width=30%>柱面号高字节</td></tr>
<tr><td width=20%>0x1f2</td><td width=30%>扇区数</td><td width=20%>0x1f6</td><td width=30%>驱动器号/磁头号</td></tr>
<tr><td width=20%>0x1f3</td><td width=30%>起始扇区号</td><td width=20%>0x1f7</td><td width=30%>命令码</td></tr>
<tr><td width=20%>0x1f4</td><td width=30%>柱面号低字节</td><td width=20%></td><td width=30%></td></tr>
</table>
<font color=red>具体操作步骤为：
1、向控制寄存器（端口0x3f6）发送控制字节，硬盘参数中的控制字节一般为0xc8,表示禁止访问重试，禁止ECC重试，磁头数大于8。linux0.11中并没有完全采用
该字节，而是将其和0xf进行与操作，也就是允许了访问重试和ECC重试。对于允许ECC的重试没有什么意义，因为在默认的命令字节里面，和ECC相关的读写操作都
默认没有使用ECC方式。<font color=blue>我又看了一下linux0.11，这步操作应该在状态检测之后，也就是1,2步顺序应该交换</font>
2、检测控制器空闲状态，通过读取并测试主状态寄存器的位7（BUSY_STAT）是否清位，如果清位表示空闲，如果在规定时间内该位始终置位则表示忙碌，判为超时
错误。
3、检测驱动器是否就绪，通过判断主状态寄存器位6（READY_STAT）是否置位，如置位则表示就绪，就绪后就可以发送参数和命令了。
4、将参数和命令依次输入各自对应的端口（0x1f1～0x1f7）。
5、等待中断产生，命令执行后，由硬盘控制器产生中断请求信号IRQ14（int 0x2e）或置控制器状态为空闲，表明操作结束或请求数据传输（多扇区读写）。
6、检测操作结果，再次检查主状态寄存器，若位0=0则表示命令执行成功。否则为失败，若失败则可以继续读取错误寄存器中的错误码。
</font><font color=blue>
注意：这是在测试时碰到的以后应注意的情况：由于硬盘控制器产生的IRQ14是在从芯片上，并且我们设置的8259A中断控制器的工作方式为不自动结束中断，所以，
当我们通过OCW2手动通知中断结束时，除了往从芯片上发送EOI，还要往主芯片上也发送EOI（作用是IRQ2的中断结束通知）
</font>
三、硬盘基本参数表
bios中断向量表中，int 0x41（4x0x41=0x0000:0x0104）存放的是第一个硬盘基本参数表地址，若有第二个硬盘，则int 0x46处存放了其对应的参数表地址。
硬盘基本参数信息表
<table width=60% border=1>
<tr><td width=5%>位移</td><td width=5%>大小</td><td width=90%>说明</td></tr>
<tr><td width=5%>0x00</td><td width=5%>字</td><td width=90%>柱面数</td></tr>
<tr><td width=5%>0x02</td><td width=5%>字节</td><td width=90%>磁头数</td></tr>
<tr><td width=5%>0x03</td><td width=5%>字</td><td width=90%>0</td></tr>
<tr><td width=5%>0x05</td><td width=5%>字</td><td width=90%>开始写补偿柱面号（乘4）</td></tr>
<tr><td width=5%>0x07</td><td width=5%>字节</td><td width=90%>最大ECC猝发长度（仅XT使用，其他为0）</td></tr>
<tr><td width=5%>0x08</td><td width=5%>字节</td><td width=90%>硬盘控制字节，见前面</td></tr>
<tr><td width=5%>0x09</td><td width=5%>字节</td><td width=90%>0</td></tr>
<tr><td width=5%>0x0a</td><td width=5%>字节</td><td width=90%>0</td></tr>
<tr><td width=5%>0x0b</td><td width=5%>字节</td><td width=90%>0</td></tr>
<tr><td width=5%>0x0c</td><td width=5%>字</td><td width=90%>磁头着陆柱面号</td></tr>
<tr><td width=5%>0x0e</td><td width=5%>字节</td><td width=90%>每磁道扇区数</td></tr>
<tr><td width=5%>0x0f</td><td width=5%>字节</td><td width=90%>保留</td></tr>
</table>
四、硬盘分区表
目前我还没有用到分区表哈哈，现在我对硬盘的使用还是最原始的状态：MBR中直接就是我的引导代码，而其他的head，kernel模块都依次顺序放置在MBR的扇区之后。
不过以后肯定还是使用到分区表的，现在先把这些资料记录下来：
bios加载硬盘引导的过程和加载软盘是一样的，将第一扇区加载到内存0x7c00处并跳转到这里开始执行。硬盘的这个主引导扇区就称为MBR，其结构为：
<table width=60% border=1>
<tr><td width=15%>偏移位置</td><td width=15%>名称</td><td width=15%>长度（字节）</td><td width=55%>说明</td></tr>
<tr><td width=15%>0x000</td><td width=15%>MBR代码区</td><td width=15%>446</td><td width=55%>引导程序代码和数据</td></tr>
<tr><td width=15%>0x1BE</td><td width=15%>分区表项1</td><td width=15%>16</td><td width=55%>第1个分区表项，共16字节</td></tr>
<tr><td width=15%>0x1CE</td><td width=15%>分区表项2</td><td width=15%>16</td><td width=55%>第2个分区表项，共16字节</td></tr>
<tr><td width=15%>0x1DE</td><td width=15%>分区表项3</td><td width=15%>16</td><td width=55%>第3个分区表项，共16字节</td></tr>
<tr><td width=15%>0x1EE</td><td width=15%>分区表项4</td><td width=15%>16</td><td width=55%>第4个分区表项，共16字节</td></tr>
<tr><td width=15%>0x1FE</td><td width=15%>引导标志</td><td width=15%>2</td><td width=55%>有效引导扇区的标志：0xAA55</td></tr>
</table>
分区表项结构
<table width=60% border=1>
<tr><td width=15%>位置</td><td width=15%>名称</td><td width=15%>大小</td><td width=55%>说明</td></tr>
<tr><td width=15%>0x00</td><td width=15%>boot_ind</td><td width=15%>字节</td><td width=55%>活动分区标志，只能有一个活动分区。标志为0x80，其余为0</td></tr>
<tr><td width=15%>0x01</td><td width=15%>head</td><td width=15%>字节</td><td width=55%>分区起始磁头号，范围0～255</td></tr>
<tr><td width=15%>0x02</td><td width=15%>sector</td><td width=15%>字节</td><td width=55%>分区起始当前柱面中扇区号(位0-5)(范围1～63)和柱面号高2位(位6-7)</td></tr>
<tr><td width=15%>0x03</td><td width=15%>cyl</td><td width=15%>字节</td><td width=55%>分区起始柱面号低8位，柱面号范围0～1023</td></tr>
<tr><td width=15%>0x04</td><td width=15%>sys_ind</td><td width=15%>字节</td><td width=55%>分区类型字节：0x83-linux..</td></tr>
<tr><td width=15%>0x05</td><td width=15%>end_head</td><td width=15%>字节</td><td width=55%>分区结束磁头号，0～255</td></tr>
<tr><td width=15%>0x06</td><td width=15%>end_sector</td><td width=15%>字节</td><td width=55%>分区结束当前柱面号中扇区号和柱面号高2位</td></tr>
<tr><td width=15%>0x07</td><td width=15%>end_cyl</td><td width=15%>字节</td><td width=55%>分区结束柱面号低8位</td></tr>
<tr><td width=15%>0x08</td><td width=15%>start_sect</td><td width=15%>4字节</td><td width=55%>分区起始物理扇区号，整盘连续计算的扇区号，0-基</td></tr>
<tr><td width=15%>0x0c</td><td width=15%>nr_sects</td><td width=15%>4字节</td><td width=55%>分区占用的扇区数</td></tr>
</table>
</pre>";
?>
