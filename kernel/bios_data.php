
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'></td>
<td width='10%'></td>
<td width='80%'></td>
</tr>
<tr>
<td width='10%'></td>
<td width='10%'></td>
<td width='80%'></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>400H</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>计算机上0号RS232-1适配器的基地址，通常为3F8H。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>402H</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>计算机上1号RS232-1适配器的基地址，通常为2F8H。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>404H</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>计算机上2号RS232-1适配器的基地址。</span></td>
</tr>
</tbody>
</table>
</p>";
echo "<p>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>406H</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>计算机上3号RS232-1适配器的基地址。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>408H</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>计算机上0号并行打印机适配器的基地址，通常为378H。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>40AH</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>计算机上1号并行打印机适配器的基地址。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>40CH</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>计算机上2号并行打印机适配器的基地址。</span></td>
</tr>
</tbody>
</table>
</p>";
echo "<p>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>40EH</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>计算机上3号并行打印机适配器的基地址。(PS2型此值为扩展BIOS数据区段地址)</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>410H</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>该字保存与计算机连接的设备编码表，BIOS中断11H(设备测定)可返回此信息。</span></td>
</tr>
</tbody>
</table>
</p>
<p>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>&nbsp;</td>
<td width='10%'><span style='color: #000000;'>位</span></td>
<td width='80%'>　</td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>0</span></td>
<td width='80%'><span style='color: #000000;'>软驱安装标志，此位为0表示没有软驱。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>1</span></td>
<td width='80%'><span style='color: #000000;'>数字协处理器安装标志，此位为0表示未安装协处理器。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>3-2</span></td>
<td width='80%'><span style='color: #000000;'>系统板RAM的大小，适用于一些旧机型，PS2型未使用。00=16K，01=32K，10=48K，11=64K)。</span></td>
</tr>
</tbody>
</table>
</p>";
echo "<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>5-4</span></td>
<td width='80%'><span style='color: #000000;'>初始显示方式(00=AG，01=CGA-40，10=CGA-80，11=MDA-80)。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>7-6</span></td>
<td width='80%'><span style='color: #000000;'>软驱的数量，公当位0为1时有效，00=1，01=2，10=3，11=4</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>8</span></td>
<td width='80%'><span style='color: #000000;'>DMA标志</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>9-11</span></td>
<td width='80%'><span style='color: #000000;'>所连RS232适配器数</span></td>
</tr>
</tbody>
</table>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>12</span></td>
<td width='80%'><span style='color: #000000;'>连有游戏I/O</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>13</span></td>
<td width='80%'><span style='color: #000000;'>不用(PS2型为内置MODEM安装标志，此位为0表示没有安装)</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>14-15</span></td>
<td width='80%'><span style='color: #000000;'>所连打印机适配器数</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>412H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>初始测试标志(红外线键盘连接错误单元/？)。</span></td>
</tr>
</tbody>
</table>";
echo "<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>413H</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>该字给出打印机可用RAM的容量，基本内存容量为0-10K，以千字节为单位。BIOS中断12H(内存大小测定)可返回此信息。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>415H</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>I/O通道的存储器容量(PS2型，BIOS控制标志)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>417H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>这是第一个键盘状态字，通过编码，使每位均有特定的含义，具体格式如下：</span></td>
</tr>
</tbody>
</table>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>位</span></td>
<td width='80%'>　</td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>0</span></td>
<td width='80%'><span style='color: #000000;'>表示键盘右边的Shift键当前是否被按下(1表示按下，0表示未按下)。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>1</span></td>
<td width='80%'><span style='color: #000000;'>表示键盘左边的Shift键当前是否被按下(1表示按下，0表示未按下)。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>2</span></td>
<td width='80%'><span style='color: #000000;'>表明Ctrl键当前是否按下(1表示按下，0表示未按下)。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>3</span></td>
<td width='80%'><span style='color: #000000;'>表明Alt键当前是否按下(1表示按下，0表示未按下)。</span></td>
</tr>
</tbody>
</table>";
echo "<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>4</span></td>
<td width='80%'><span style='color: #000000;'>屏幕(Scroll)锁定开关键状态(1表示屏幕锁定处于开，0表示关)。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>5</span></td>
<td width='80%'><span style='color: #000000;'>数字(Num Lock)锁定开关键状态(1表示数字锁定处于开，0表示关)。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>6</span></td>
<td width='80%'><span style='color: #000000;'>大写字母(Caps Lock)开关键状态(1表示Caps Lock处于开，0表示关)。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>7</span></td>
<td width='80%'><span style='color: #000000;'>插入状态，它表明Ins键是否已按下，以使计算机进入&ldquo;插入&rdquo;方式，1表示插入状态正工作，0表明未动作。</span></td>
</tr>
</tbody>
</table>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>418H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>这是第二个键盘状态字，其格式如下：</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>位</span></td>
<td width='80%'>　</td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>0</span></td>
<td width='80%'><span style='color: #000000;'>表示键盘左边Ctrl键当前是否被按下(1表示按下，0表示未按下)。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>1</span></td>
<td width='80%'><span style='color: #000000;'>表示键盘左边Alt键当前是否被按下(1表示按下，0表示未按下)。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>2</span></td>
<td width='80%'><span style='color: #000000;'>如按下Ctrl+Alt+Del键，则该位为1。</span></td>
</tr>
</tbody>
</table>";
echo "<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>&nbsp;</td>
<td width='10%'><span style='color: #000000;'>3</span></td>
<td width='80%'><span style='color: #000000;'>如果系统键(Ctrl和Num Lock)接下且保持住，则该位为1，当这个系统键依次按下时，BIOS暂停处理，直至下键按下为止。但它仍响应中断。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>4</span></td>
<td width='80%'><span style='color: #000000;'>表明屏幕(Scrool)锁定键当前是否按下(1表示按下，0表示未按下)。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>5</span></td>
<td width='80%'><span style='color: #000000;'>表明数字(Num Lock)锁定键当前是否按下(1表示按下，0表示未按下)。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>6</span></td>
<td width='80%'><span style='color: #000000;'>表明大写字母(Caps Lock)锁定键当前是否按下(1表示按下，0表示未按下)。</span></td>
</tr>
</tbody>
</table>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>7</span></td>
<td width='80%'><span style='color: #000000;'>表明Ins键当前是否按下(1表示按下，0表示未按下)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>419H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>为Alt和数字键盘键入的数而保留。(按住ALT+数字，可直接得到相应的ASCII码)</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>41AH</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>指向键盘缓冲区首址</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>41CH</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>指向键盘缓冲区尾址，当该值等于前一字的值时，说明缓冲区满。</span></td>
</tr>
</tbody>
</table>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>41EH</span></td>
<td width='10%'><span style='color: #000000;'>32字节</span></td>
<td width='80%'><span style='color: #000000;'>循环键盘缓冲区，它保存键盘键入的字符，直到程序可以接收这些字符为止，前两个字指向此缓冲区的当前是首和尾。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>43EH</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>表示磁盘驱动器的搜索状态，0-3位分别对应于驱动器。如果这些位中有一位为0，则表示在搜索磁道之前，必须重新校准相应的驱动器。位4-6未使用，位7为中断标志位，为1表示中断发生。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>43FH</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>表示磁盘驱动器的马达状态，0-3位分别对应于驱动器0-3，如果某位被置为1，则相应驱动器的马达正在转动。位4-6未使用，位7为1表示现行操作是写。</span></td>
</tr>
</tbody>
</table>";
echo "<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>440H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>保存一个表明驱动器马达接通多长时间的计数，每个时钟节拍，计数减1，当计数为0明马达停转(根据INT8计时)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>441H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>表明磁盘工作状态，它被编码，通过使相应位置1来表示一个特定的状态，格式如下：</span></td>
</tr>
</tbody>
</table>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>值</span></td>
<td width='80%'>　</td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>00H</span></td>
<td width='80%'><span style='color: #000000;'>正确。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>01H</span></td>
<td width='80%'><span style='color: #000000;'>送给磁盘控制器的是无效命令。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>02H</span></td>
<td width='80%'><span style='color: #000000;'>在盘上未找到地址标记。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>03H</span></td>
<td width='80%'><span style='color: #000000;'>试图在有写保护的盘上写操作。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>04H</span></td>
<td width='80%'><span style='color: #000000;'>所请求扇区未找到。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>08H</span></td>
<td width='80%'><span style='color: #000000;'>驱动器DMA错。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>09H</span></td>
<td width='80%'><span style='color: #000000;'>试图使DMA对64KB存储体进行存取。</span></td>
</tr>
</tbody>
</table>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>10H</span></td>
<td width='80%'><span style='color: #000000;'>循环冗余校验(CRC)错。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>20H</span></td>
<td width='80%'><span style='color: #000000;'>NEC磁盘控制器片出现错误。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>40H</span></td>
<td width='80%'><span style='color: #000000;'>无效的查找操作。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>80H</span></td>
<td width='80%'><span style='color: #000000;'>延时，没有响应。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>442H</span></td>
<td width='10%'><span style='color: #000000;'>7字节</span></td>
<td width='80%'><span style='color: #000000;'>从NEC磁盘驱动器返回的七个字节状态信息(参见FDC)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>449H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>指明当前视频方式，参见INT 10H。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>44AH</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>指明显示屏幕的当前列数。</span></td>
</tr>
</tbody>
</table>";
echo "<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>44CH</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>指明一个显示页面的字节数，它随时视频方式的不同而变化。80*25方式=1000H字节，40*25方式=800H字节，图形方式=4000H字节</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>44EH</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>指明当前显示页面的地址，即显示在当前显示屏幕的显示页面。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>450H</span></td>
<td width='10%'><span style='color: #000000;'>8字</span></td>
<td width='80%'><span style='color: #000000;'>每个字均表示有关显示页面内当前光标的位置，每个字的第一字节表示列，第二字节表示行(改变这个字节并不能立刻改变显示)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>460H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>表明光标的形状，此字节表示光标字符点阵的最下一行的行号，10H功能调用1设置此光标形状(不要直接更改此字节)。</span></td>
</tr>
</tbody>
</table>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>461H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>此字节表示光标字符点阵的最上一行的行号。10H功能调用1设置此光标形状(不要直接更改此字节)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>462H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>表明工作显示页面号，由10H功能调用5设置。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>463H</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>表明当前工作显示板的口地址。3BCH=单色，3D4H=彩色。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>465H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>表明6845芯片的方式寄存器的当前值(端口：3X8H)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>466H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>表示当前显示控制面板的设置。10H功能调用0BH可设置当前面板(端口：3D9H)。</span></td>
</tr>
</tbody>
</table>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>467H</span></td>
<td width='10%'><span style='color: #000000;'>5字节</span></td>
<td width='80%'><span style='color: #000000;'>PC中，这5个字节用以表示磁带控制的定时计数字、CRC寄存器字和最后输入数值字节，在AT中，这5个字节作为端口使用，从467H开始的双字长是一个指针，它指向BIOS开关使80X86由保护虚地址方式转到实地址方式时控制返回的位置。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>46CH</span></td>
<td width='10%'><span style='color: #000000;'>双字</span></td>
<td width='80%'><span style='color: #000000;'>这是BIOS作为时钟计数器的一个双字单元，时钟第步进一次，此值增加一次，其值为0，表示一天开始(午夜)，当此计数器达到一天结束的值时，计数器清0，且字节470H置1。中断1AH功能调用0可从此双字单元中读取一天的时间。</span></td>
</tr>
</tbody>
</table>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>470H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>这是一个时钟翻转字节。当时钟计数器达到一天结束且复位时，此字节置1以表明新的一天开始。中断1AH功能调用0在读取这一天的时间后，将此字节复位。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>471H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>位7为1表示BREAK键按下(INT 9设置此标志)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>472H</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>由软件设置复位功能标志或直接跳转FFFF:0重启动。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>值</span></td>
<td width='80%'>　</td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>1234H</span></td>
<td width='80%'><span style='color: #000000;'>热启动</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>5678H</span></td>
<td width='80%'><span style='color: #000000;'>系统中止</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>9ABCH</span></td>
<td width='80%'><span style='color: #000000;'>在制造商检测时使用。</span></td>
</tr>
</tbody>
</table>";
echo "<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>474H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>硬盘状态。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>值</span></td>
<td width='80%'>　</td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>00H</span></td>
<td width='80%'><span style='color: #000000;'>正确</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>01H</span></td>
<td width='80%'><span style='color: #000000;'>送给磁盘控制器的是无效命令或参数。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>02H</span></td>
<td width='80%'><span style='color: #000000;'>在盘上未找到地址标记</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>03H</span></td>
<td width='80%'><span style='color: #000000;'>试图在有写保护的盘上进行写操作。</span></td>
</tr>
</tbody>
</table>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>04H</span></td>
<td width='80%'><span style='color: #000000;'>所请求扇区未找到。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>05H</span></td>
<td width='80%'><span style='color: #000000;'>重新复位失败。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>07H</span></td>
<td width='80%'><span style='color: #000000;'>操作失效。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>08H</span></td>
<td width='80%'><span style='color: #000000;'>DMA错</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>09H</span></td>
<td width='80%'><span style='color: #000000;'>试图使DMA对64K存储体进行存取。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>0AH</span></td>
<td width='80%'><span style='color: #000000;'>坏的扇区标志。</span></td>
</tr>
</tbody>
</table>";
echo "<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>0BH</span></td>
<td width='80%'><span style='color: #000000;'>坏磁道已清除。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>0DH</span></td>
<td width='80%'><span style='color: #000000;'>扇区号、格式错。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>0EH</span></td>
<td width='80%'><span style='color: #000000;'>控制数据地址已清除。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>0FH</span></td>
<td width='80%'><span style='color: #000000;'>DMA超出限制。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>10H</span></td>
<td width='80%'><span style='color: #000000;'>循环冗余校验CRC错。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>11H</span></td>
<td width='80%'><span style='color: #000000;'>ECC数据错。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>20H</span></td>
<td width='80%'><span style='color: #000000;'>NEC磁盘控制器片出现错误。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>40H</span></td>
<td width='80%'><span style='color: #000000;'>无效的查找操作。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>80H</span></td>
<td width='80%'><span style='color: #000000;'>延时，没有响应。</span></td>
</tr>
</tbody>
</table>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>AAH</span></td>
<td width='80%'><span style='color: #000000;'>没准备好。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>BBH</span></td>
<td width='80%'><span style='color: #000000;'>发生错误，定义不正确。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>CCH</span></td>
<td width='80%'><span style='color: #000000;'>写错误。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>E0H</span></td>
<td width='80%'><span style='color: #000000;'>寄存器错误。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>FFH</span></td>
<td width='80%'><span style='color: #000000;'>磁盘检测失败。</span></td>
</tr>
</tbody>
</table>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>475H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>硬盘设备数。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>476H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>磁盘适配器控制。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>477H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>硬盘适配器端口。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>478H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>测试打印机0的超时值。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>479H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>测试打印机1的超时值。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>47AH</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>测试打印机2的超时值。</span></td>
</tr>
</tbody>
</table>";
echo "<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>47BH</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>测试打印机3的超时值(PS2型除外)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>47CH</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>测试0号RS232超时值。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>47DH</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>测试1号RS232超时值。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>47EH</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>测试2号RS232超时值。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>47FH</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>测试3号RS232超时值。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>480H</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>指向存放键盘输入字符的循环缓冲区首址。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>482H</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>指向存放键盘输入字符的循环缓冲区尾址。</span></td>
</tr>
</tbody>
</table>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>484H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>显示字符的列数。其值为显示字符的列数减1(EGA以上有效)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>485H</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>每个字符高度(EGA以上有效)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>487H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>显示控制状态(EGA以上有效)1。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>位</span></td>
<td width='80%'>　</td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>0</span></td>
<td width='80%'><span style='color: #000000;'>光标仿真模式状态(1为开启)。</span></td>
</tr>
</tbody>
</table>";
echo "<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>1</span></td>
<td width='80%'><span style='color: #000000;'>单色显示系统状态(1为启用)。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>2</span></td>
<td width='80%'><span style='color: #000000;'>保留。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>3</span></td>
<td width='80%'><span style='color: #000000;'>显示系统空闲状态(1为空闲)。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>4</span></td>
<td width='80%'><span style='color: #000000;'>保留。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>6-5</span></td>
<td width='80%'><span style='color: #000000;'>显存容量(00=64K，01=128K，10=192K，11=256K)。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>7</span></td>
<td width='80%'><span style='color: #000000;'>显示模式可用状态。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>488H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>显示控制状态2(EGA以上有效)。</span></td>
</tr>
</tbody>
</table>
<p>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>位</span></td>
<td width='80%'>　</td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>0</span></td>
<td width='80%'><span style='color: #000000;'>SW1(1=关闭)</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>1</span></td>
<td width='80%'><span style='color: #000000;'>SW2(1=关闭)</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>2</span></td>
<td width='80%'><span style='color: #000000;'>SW3(1=关闭)</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>3</span></td>
<td width='80%'><span style='color: #000000;'>SW4(1=关闭)</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>4</span></td>
<td width='80%'><span style='color: #000000;'>？</span></td>
</tr>
</tbody>
</table>
</p>
<p>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>5</span></td>
<td width='80%'><span style='color: #000000;'>？</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>6</span></td>
<td width='80%'><span style='color: #000000;'>？</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>7</span></td>
<td width='80%'><span style='color: #000000;'>？</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>489H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>显示控制状态3(MCGA或VGA有效)。</span></td>
</tr>
</tbody>
</table>
</p>
<p>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>位</span></td>
<td width='80%'>　</td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>0</span></td>
<td width='80%'><span style='color: #000000;'>VGA模式状态</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>1</span></td>
<td width='80%'><span style='color: #000000;'>灰度模式状态</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>2</span></td>
<td width='80%'><span style='color: #000000;'>单色显示状态</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>3</span></td>
<td width='80%'><span style='color: #000000;'>使用默认模式</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>4</span></td>
<td width='80%'><span style='color: #000000;'>--</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>5</span></td>
<td width='80%'><span style='color: #000000;'>保留</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>6</span></td>
<td width='80%'><span style='color: #000000;'>显示状态开关</span></td>
</tr>
</tbody>
</table>
</p>";
echo "<p>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>7</span></td>
<td width='80%'><span style='color: #000000;'>--</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>值</span></td>
<td width='80%'>　</td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>位7位4</span></td>
<td width='80%'>　</td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>0 0</span></td>
<td width='80%'><span style='color: #000000;'>350线模式</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>0 1</span></td>
<td width='80%'><span style='color: #000000;'>400线模式</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>1 0</span></td>
<td width='80%'><span style='color: #000000;'>200线模式</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>1 1</span></td>
<td width='80%'><span style='color: #000000;'>保留</span></td>
</tr>
</tbody>
</table>
</p>
<p>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>48AH</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>显示适配器DCC索引。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>48BH</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>最后磁盘数据率。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>位</span></td>
<td width='80%'>　</td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>3-0</span></td>
<td width='80%'><span style='color: #000000;'>保留。</span></td>
</tr>
</tbody>
</table>
</p>
<p>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>&nbsp;</td>
<td width='10%'><span style='color: #000000;'>5-4</span></td>
<td width='80%'><span style='color: #000000;'>步进时间。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>7-6</span></td>
<td width='80%'><span style='color: #000000;'>数据传输率。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>48CH</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>硬盘状态。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>48DH</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>硬盘错误。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>48EH</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>硬盘中断标志。</span></td>
</tr>
</tbody>
</table>
</p>";
echo "<p>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>48FH</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>位0为1，表示硬盘和软盘使用一个控制卡。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>490H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>驱动器0介质状态。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>491H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>驱动器1介质状态。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>492H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>驱动器0的起始状态。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>493H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>驱动器2的起始状态。</span></td>
</tr>
</tbody>
</table>
</p>
<p>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>494H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>驱动器0磁道数。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>495H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>驱动器1磁道数。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>496H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>键盘类型和方式，各位含义为：</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>位</span></td>
<td width='80%'>　</td>
</tr>
</tbody>
</table>
</p>
<p>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>0</span></td>
<td width='80%'><span style='color: #000000;'>E1H隐含码最后。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>1</span></td>
<td width='80%'><span style='color: #000000;'>E0H隐含码最后。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>2</span></td>
<td width='80%'><span style='color: #000000;'>右Ctrl键按下。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>3</span></td>
<td width='80%'><span style='color: #000000;'>右Alt键按下。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>4</span></td>
<td width='80%'><span style='color: #000000;'>101/102键盘</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>5</span></td>
<td width='80%'><span style='color: #000000;'>若读标识和键盘，则强置Num Lock。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>6</span></td>
<td width='80%'><span style='color: #000000;'>最后的字符是第一个ID字符。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>7</span></td>
<td width='80%'><span style='color: #000000;'>读键盘的ID。</span></td>
</tr>
</tbody>
</table>
</p>";
echo "<p>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>497H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>键盘标志。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>位</span></td>
<td width='80%'>　</td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>0-2</span></td>
<td width='80%'><span style='color: #000000;'>LED状态位。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>3</span></td>
<td width='80%'><span style='color: #000000;'>保留。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>4</span></td>
<td width='80%'><span style='color: #000000;'>收到消息。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>5</span></td>
<td width='80%'><span style='color: #000000;'>重发接收标志。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>6</span></td>
<td width='80%'><span style='color: #000000;'>方式指示器更新。</span></td>
</tr>
<tr>
<td width='10%'>　</td>
<td width='10%'><span style='color: #000000;'>7</span></td>
<td width='80%'><span style='color: #000000;'>键盘传送错误标志。</span></td>
</tr>
</tbody>
</table>
</p>
<p>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>498H</span></td>
<td width='10%'><span style='color: #000000;'>双字</span></td>
<td width='80%'><span style='color: #000000;'>等待完成标志的偏移地址。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>49AH</span></td>
<td width='10%'><span style='color: #000000;'>双字</span></td>
<td width='80%'><span style='color: #000000;'>用户等待计数(低位字)，以微秒为单位。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>49EH</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>用户等待计数(高位字)，以微秒为单位。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>4A0H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>RTC等待激活标志。80表示等待时间已过。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>4A1H</span></td>
<td width='10%'><span style='color: #000000;'>7字节</span></td>
<td width='80%'><span style='color: #000000;'>这7个字节用于局域网。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>4A8H</span></td>
<td width='10%'><span style='color: #000000;'>双字</span></td>
<td width='80%'><span style='color: #000000;'>这双字指向保存视频系统的指针表。指针表格式为：</span></td>
</tr>
</tbody>
</table>
</p>";
echo "<p>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'>&nbsp;</td>
<td width='10%'>　</td>
<td width='80%'>
<p><span style='color: #000000;'>偏移值　　　　　类型　　　　指向<br />　00H　　　　　　DD　　　　视频参数<br />　04H　　　　　　DD　　　　参数保存区<br />　08H　　　　　　DD　　　　字母字符集<br />　0CH　　　　　　DD　　　　图形字符集<br />　10H　　　　　　DD　　　　第二个保存指针表<br />　14H　　　　　　DD　　　　保留<br />　18H　　　　　　DD　　　　保留<br />第二个指针表格式为：</span></p>
<p>偏移值　　　　　类型　　　　功能或指向<br />　00H　　　　　　DW　　　　这个表的字节<br />　02H　　　　　　DD　　　　组合码表<br />　06H　　　　　　DD　　　　第二个字母字符集<br />　0AH　　　　　　DD　　　　用户调色板表<br />　0EH　　　　　　DD　　　　保留<br />　12H　　　　　　DD　　　　保留<br />　16H　　　　　　DD　　　　保留</p>
<p>&nbsp;</p>
</td>
</tr>
</tbody>
</table>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>4ACH</span></td>
<td width='10%'><span style='color: #000000;'>8字节</span></td>
<td width='80%'><span style='color: #000000;'>保留。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>4B4H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>键盘NMI控制标志(可变)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>4B5H</span></td>
<td width='10%'><span style='color: #000000;'>双字</span></td>
<td width='80%'><span style='color: #000000;'>键盘中断中标志(可变)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>4B9H</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>端口60单字节队列(可变)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>4BAH</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>最后的键盘扫描码(可变)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>4BBH</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>NMI缓冲头位置(可变)。</span></td>
</tr>
</tbody>
</table>
</p>
<p>
<table style='width: 600px;' border='1' cellspacing='1' cellpadding='0' bordercolor='#9999ff'>
<tbody>
<tr>
<td width='10%'><span style='color: #000000;'>4BCH</span></td>
<td width='10%'><span style='color: #000000;'>字节</span></td>
<td width='80%'><span style='color: #000000;'>NMI缓冲头位置(可变)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>4BDH</span></td>
<td width='10%'><span style='color: #000000;'>16字节</span></td>
<td width='80%'><span style='color: #000000;'>NMI扫描码缓冲(可变)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>4CEH</span></td>
<td width='10%'><span style='color: #000000;'>字</span></td>
<td width='80%'><span style='color: #000000;'>日期计数(可变)。</span></td>
</tr>
<tr>
<td width='10%'><span style='color: #000000;'>4F0H</span></td>
<td width='10%'><span style='color: #000000;'>16字节</span></td>
<td width='80%'><span style='color: #000000;'>？</span></td>
</tr>
</tbody>
</table>";
?>
