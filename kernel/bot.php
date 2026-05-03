<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<a name=res00></a><font size=6 color=#ff0000><center>XHCI 1.2b 规范摘要</center></font><br><br><br>";
echo "<center><table width=90% border=0>
<tr><td width=33%><a href=bot.php#res01>BOT 简介</a></td><td width=33%><a href=bot.php#res02>BOT 设备描述符及布局</a></td><td width=34%><a href=bot.php#res03>BOT 数据传输过程</a></td></tr>
<tr><td width=33%><a href=bot.php#res04>BOT CBW和CSW的校验</a></td><td width=33%><a href=bot.php#res05>BOT 命令块包CBW</a></td><td width=34%><a href=bot.php#res06>BOT 命令状态包CSW</a></td></tr>
<tr><td width=33%><a href=bot.php#res07>BOT CBW和CSW数据例解析</a></td><td width=33%><a href=bot.php#res08>BOT MASS_STORAGE_RESET</a></td><td width=34%><a href=bot.php#res09>BOT GET_MAX_LUN</a></td></tr>
<tr><td width=33%><a href=bot.php#res10>USB存储BOT规范UFI命令大全</a></td><td width=33%><a href=bot.php#res11>U盘BOT存储UFI协议READ_FORMAT_CAPACITIES命令说明及实例分析</a></td><td width=34%><a href=bot.php#res12>U盘BOT存储UFI协议INQUIRY命令说明及实例分析</a></td></tr>
<tr><td width=33%><a href=bot.php#res13>U盘BOT存储UFI协议TEST UNIT READY命令:0x00</a></td><td width=33%><a href=bot.php#res14>U盘BOT存储UFI协议READ_CAPACITY命令说明及实例分析</a></td><td width=34%><a href=bot.php#res15>U盘BOT存储UFI协议READ(10)命令:0x28</a></td></tr>
<tr><td width=33%><a href=bot.php#res16>U盘BOT存储UFI协议WRITE(10)命令:0x2A</a></td><td width=33%><a href=bot.php#res17>U盘BOT存储UFI协议数据自检校验命令VERIFY:0x2F</a></td><td width=34%><a href=bot.php#res18></a></td></tr>

";
echo "</table></center>";
echo "<font size=4 color=gray><a name=res01></a><font color=red size=4>BOT 简介</font><pre>
BOT 简介 Bulk-Only Transport
BOT全称Universal Serial BusMass Storage ClassBulk-Only Transport(Bulk-Only Transport)，是USB大容量数据存储的基础协议。
BOT协议用于主机和USB设备之间进行大容量数据传输。对于USB主机来说，USB设备外部硬盘驱动器。
BOT协议应用
通过BOT协议连接到计算机的设备包括：
    外置磁性硬盘
    外置光驱，包括CD和DVD读写器驱动器
    便携式闪存 设备
    固态硬盘
    标准闪存卡和 USB 连接之间的适配器
    数码相机
    数字音频和便携式媒体播放器
    读卡器
    掌上电脑
    手机
    支持该标准的设备称为 MSC（大容量存储类）设备。MSC是最初的缩写，UMS（Universal Mass Storage）也开始普遍使用。
BOT版本
    BOT协议的当前版本为V1.0
    BOT协议发布于1999年。
BOT协议的组成
USB 组织在universal Serial Bus Mass Storage Class Spaceification 1.1版本中定义了海量存储设备类（Mass Storage Class）的规范，这个类规范包括四个
独立的子类规范，即：
    USB Mass Storage Class Control/Bulk/Interrupt (CBI) Transport
    USB Mass Storage Class Bulk-Only Transport
    USB Mass Storage Class ATA Command Block
    USB Mass Storage Class UFI Command Specification 
前两个子规范定义了数据/命令/状态在USB 上的传输方法。Bulk- Only 传输规范仅仅使用Bulk 端点传送数据/命令/状态，CBI 传输规范则使用Control/Bulk/Interrupt 三种类型的端点进行数据/命令/状态传送。
后两个子规范则定义了存储介质的操作命令。ATA 命令规范用于硬盘，UFI 命令规范是针对USB 移动存储。
BOT协议的支持
    Microsoft Windows 从 Windows 2000 开始支持。
    Apple Computer的Mac OS 9和macOS支持
    在Linux内核自2.4系列（2001年）已经支持
    MS-DOS和大多数兼容的操作系统都不支持 USB。第三方通用驱动程序，如 Duse、USBASPI 和 DOSUSB，可用于支持 USB 大容量存储设备。FreeDOS支持将 USB 大容量存储作为高级 SCSI 编程接口(ASPI) 接口
BOT协议的意义
USB 大容量存储规范提供了许多行业标准命令集的接口，允许设备公开其子类。实际上，几乎不支持通过其子类指定命令集；大多数驱动程序只支持SCSI 透明命令集，用它们的SCSI 外围设备类型(PDT)指定它们的 SCSI 命令集子集。子类代码指定以下命令集：
    减少块命令 (RBC)
    SFF -8020i、MMC -2（用于 ATAPI 风格的 CD 和 DVD 驱动器）
    QIC -157（磁带机）
    统一软盘接口(UFI)
    SFF-8070i（由 ARMD 风格的设备使用）
    SCSI 透明命令集（使用“查询”获取 PDT）
该规范不要求符合设备的特定文件系统。基于指定的命令集和任何子集，它提供了一种读取和写入数据扇区的方法（类似于用于访问硬盘驱动器的低级接口）。操作系统可能会将 USB 大容量存储设备视为硬盘驱动器；用户可以以任何格式（如MBR和GPT）对其进行分区，并使用任何
文件系统对其进行格式化。
由于其相对简单，嵌入式设备（如USB 闪存驱动器、相机或数字音频播放器）上最常见的文件系统是 Microsoft 的FAT或FAT32文件系统（可选支持长文件名）。大型、基于 USB 的硬盘可能会使用NTFS进行格式化，而后者（Windows 除外）的支持较少。然而，密钥驱动器或其他设备
可以与另一个文件系统（格式化HFS再加上苹果的Macintosh，或的Ext2上的Linux或UNIX文件系统上的Solaris或 BSD）。这种选择可能会限制（或阻止）使用不同操作系统的设备对设备内容的访问。依赖于操作系统的存储选项包括LVM、分区表和软件加密。
&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bot.php#res00>返回顶部</a></pre>";
echo "<font size=4 color=gray><a name=res02></a><font color=red size=4>BOT 设备描述符及布局</font><pre>
BOT 设备描述符及布局
Bulk-Only Transport即存储设备和其它的普通设备类似，也有一些通用的描述符，如设备描述符、配置描述符、接口描述符、端点描述符和字符串描述符。
    BOT大容量存储设备没有其它特殊的描述符。
一个标准的USB支持BOT的大容量设备描述符布局如下：
<img src=./bot/145423623177.png />
设备描述符
BOT大容量存储设备类型是接口描述符中定义的，所以在其设备描述符中，bDeviceClass、bDeviceSubClass、bDeviceProtocol的值必须为0。
iSerialNumber字符串的定义需要按照相关的格式定义（windows验证不严格）；这个格式是序列号的字符串最后12字符必须为十六进制的数据位。
如本人手中的金士顿U盘的设备描述符如下：
    ---------------------- Device Descriptor ----------------------
bLength                  : 0x12 (18 bytes)
bDescriptorType          : 0x01 (Device Descriptor)
bcdUSB                   : 0x200 (USB Version 2.00)
bDeviceClass             : 0x00 (defined by the interface descriptors)
bDeviceSubClass          : 0x00
bDeviceProtocol          : 0x00
bMaxPacketSize0          : 0x40 (64 bytes)
idVendor                 : 0x0951 (Kingston Technology Company)
idProduct                : 0x1665
bcdDevice                : 0x0200
iManufacturer            : 0x01 (String Descriptor 1)
 Language 0x0409         : \"Kingston\"
iProduct                 : 0x02 (String Descriptor 2)
 Language 0x0409         : \"DataTraveler 2.0\"
iSerialNumber            : 0x03 (String Descriptor 3)
 Language 0x0409         : \"1C6F654E48EB1FC1391B7D69\"
bNumConfigurations       : 0x01 (1 Configuration)
Data (HexDump)           : 12 01 00 02 00 00 00 40 51 09 65 16 00 02 01 02   .......@Q.e.....
                           03 01
配置描述符
配置描述符和标准的配置描述符保持一致。
    ------------------ Configuration Descriptor -------------------
bLength                  : 0x09 (9 bytes)
bDescriptorType          : 0x02 (Configuration Descriptor)
wTotalLength             : 0x0020 (32 bytes)
bNumInterfaces           : 0x01 (1 Interface)
bConfigurationValue      : 0x01 (Configuration 1)
iConfiguration           : 0x00 (No String Descriptor)
bmAttributes             : 0x80
 D7: Reserved, set 1     : 0x01
 D6: Self Powered        : 0x00 (no)
 D5: Remote Wakeup       : 0x00 (no)
 D4..0: Reserved, set 0  : 0x00
MaxPower                 : 0x32 (100 mA)
Data (HexDump)           : 09 02 20 00 01 01 00 80 32 09 04 00 00 02 08 06   .. .....2.......
                           50 00 07 05 81 02 00 02 00 07 05 02 02 00 02 00   P...............
接口描述符
BOT大容量存储设备类型定义在接口描述符中，所以
故需要按要求填写。
字段 	值 	说明
bInterfaceClass 	0x08 	MASS STORAGE Class
bInterfaceSubClass 	0x06 	表示SCSI命令集。
bInterfaceProtocol 	0x50 	BULK-ONLY TRANSPORT.
bInterfaceSubClass支持的命令集
<img src=./bot/153942780163.png />
bInterfaceProtocol支持的协议
<img src=./bot/154022575086.png />
        ---------------- Interface Descriptor -----------------
bLength                  : 0x09 (9 bytes)
bDescriptorType          : 0x04 (Interface Descriptor)
bInterfaceNumber         : 0x00
bAlternateSetting        : 0x00
bNumEndpoints            : 0x02 (2 Endpoints)
bInterfaceClass          : 0x08 (Mass Storage)
bInterfaceSubClass       : 0x06 (SCSI transparent command set)
bInterfaceProtocol       : 0x50 (Bulk-Only Transport)
iInterface               : 0x00 (No String Descriptor)
Data (HexDump)           : 09 04 00 00 02 08 06 50 00                        .......P.
端点描述符
端点描述符定义一对输入输出端点，端点类型为批量传输类型
        ----------------- Endpoint Descriptor -----------------
bLength                  : 0x07 (7 bytes)
bDescriptorType          : 0x05 (Endpoint Descriptor)
bEndpointAddress         : 0x81 (Direction=IN EndpointID=1)
bmAttributes             : 0x02 (TransferType=Bulk)
wMaxPacketSize           : 0x0200 (max 512 bytes)
bInterval                : 0x00 (never NAKs)
Data (HexDump)           : 07 05 81 02 00 02 00                              .......
        ----------------- Endpoint Descriptor -----------------
bLength                  : 0x07 (7 bytes)
bDescriptorType          : 0x05 (Endpoint Descriptor)
bEndpointAddress         : 0x02 (Direction=OUT EndpointID=2)
bmAttributes             : 0x02 (TransferType=Bulk)
wMaxPacketSize           : 0x0200 (max 512 bytes)
bInterval                : 0x00 (never NAKs)
Data (HexDump)           : 07 05 02 02 00 02 00
字符串描述符
字符串描述符除了设备序列号有特殊的要求外，其余可可自定义.
             ------ String Descriptor 0 ------
bLength                  : 0x04 (4 bytes)
bDescriptorType          : 0x03 (String Descriptor)
Language ID[0]           : 0x0409 (English - United States)
Data (HexDump)           : 04 03 09 04                                       ....
             ------ String Descriptor 1 ------
bLength                  : 0x12 (18 bytes)
bDescriptorType          : 0x03 (String Descriptor)
Language 0x0409          : \"Kingston\"
Data (HexDump)           : 12 03 4B 00 69 00 6E 00 67 00 73 00 74 00 6F 00   ..K.i.n.g.s.t.o.
                           6E 00                                             n.
             ------ String Descriptor 2 ------
bLength                  : 0x22 (34 bytes)
bDescriptorType          : 0x03 (String Descriptor)
Language 0x0409          : \"DataTraveler 2.0\"
Data (HexDump)           : 22 03 44 00 61 00 74 00 61 00 54 00 72 00 61 00   \".D.a.t.a.T.r.a.
                           76 00 65 00 6C 00 65 00 72 00 20 00 32 00 2E 00   v.e.l.e.r. .2...
                           30 00                                             0.
             ------ String Descriptor 3 ------
bLength                  : 0x32 (50 bytes)
bDescriptorType          : 0x03 (String Descriptor)
Language 0x0409          : \"1C6F654E48EB1FC1391B7D69\"
Data (HexDump)           : 32 03 31 00 43 00 36 00 46 00 36 00 35 00 34 00   2.1.C.6.F.6.5.4.
                           45 00 34 00 38 00 45 00 42 00 31 00 46 00 43 00   E.4.8.E.B.1.F.C.
                           31 00 33 00 39 00 31 00 42 00 37 00 44 00 36 00   1.3.9.1.B.7.D.6.
                           39 00
&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bot.php#res00>返回顶部</a></pre>";
echo "<font size=4 color=gray><a name=res03></a><font color=red size=4>BOT 数据传输过程 </font><pre>
按照USB规范，Bulk-Only 传输规范是系统也是通过默认管道（地址0 、端点 0 ）进行枚举，枚举后重新分配地址，再次枚举。
枚举后，实际工作仅仅使用批量（ Bulk ）端点传送数据 / 命令 / 状态，批量传输方式不受时间限制并能保证数据的完整性。在取得的端点描述符中包含了 Bulk-In 和 Bulk-Out 端点，在 Bulk 数据收发的时候一定要从相应的端点进行。
其数据传输过程如下：
<img src=./bot/121418960619.png />
u盘插入，主机得到U盘描述符后识别出U盘是支持bulk-only的大量存储设备。于是两者就通过bulk端点进行通信，主机和设备的通信过程即传输定义好的数据包的过程。主要的数据包有两个：
    CBW—-Command Block Wrapper（命令块包） ；
    CSW—-Command Status Wrapper（命令执行状态包）
过程如下：
1、主机发送CBW给设备，告诉设备要进行数据传输。通过bulk-out端点发送。
2、设备收到CBW包后进行解析，如果CBW包合法并且有意义的话，不合法的话，设备会中止bukl-in管道，直到主机reset。否则设备从bulk-in端点发送一个CSW包给主机，响应主机的要求。
3、主机收到CSW后同样进行解析，如果CSW不合法或无意义，则主机可能会进行reset recovery。否则便开始传输数据给U盘或从U盘传输数据。
在Bulk-Only的命令块包(CBW)中,有一段CBECB内容,它就是SCSI命令块描述符。其内容如下:
    Operation Code:是SCSI命令操作代码。
    Logical Block Address:逻辑块地址，对U盘而言应是扇区。前面已经讲过：通用海量存储设备是一个基于块/扇区存储的设备，因此在SCSI中要提供这个参数是很显然的。
    transfer length:为要传送的扇区数
SCSI中直接存取类型的存储介质的传输命令有很多，如：
    INQUIRY：其操作码为12H
    Test Unit Ready:其操作码为00H
    Format Unit:其操作码为04H
&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bot.php#res00>返回顶部</a></pre>";
echo "<font size=4 color=gray><a name=res04></a><font color=red size=4>BOT CBW和CSW的校验 </font><pre>
Bulk-Only Protocol传输是通过主机向设备发送CBW请求，设备响应CBW返回CSW响应。
Bulk-Only Protocol传输开始是从设备复位（MASS_STORAGE_RESET）之后开始的，设备在接收到CBW请求和主机收到CSW回应后，是需要对CBW和CSW进行拆包解析。
CBW
主机通过CBW向设备发送请求。设备对接收到的每个CBW执行两次验证。首先，设备验证接收到的是有效的CBW。接下来，设备确定CBW内的数据是否有意义。
设备不得以任何方式使用dCBWTag的内容，除非将其值复制到相应CSW的dCSWTag
CBW有效条件
    接收CBW的时机是设备返回了一个CSW之后（即完成上一个CBW请求之后）或设备复位（MASS_STORAGE_RESET）之后。
    CBW的数据总长度为31字节，即0xF1.
    dCBWSignature的值为43425355h。
CBW有意义条件
    CBW结构体中的保留位没有被置位，即为0。
    bCBWLUN包含一个设备支持有效的LUN.
    bcbwcb的长度和内容都符合bInterfaceSubClass
CSW
设备通常通过CSW传递其尝试满足主机请求的结果。主机对接收到的每个CSW执行两次验证。首先，主机验证接收到的是有效的CSW。接下来，主机确定CSW中的数据是否有意义。
CSW有效条件
    CSW总数据长度为13字节，即0x0d.
    dCSWSignature的值为53425355h
    dCSWTag与相应CBW中的dCBWTag相匹配。
CSW有意义条件
bCSWStatus值为00h或01h，且DCSWData残留物小于或等于dCBWDataTransferLength
或
bCSWStatus值为02h。
&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bot.php#res00>返回顶部</a></pre>";
echo "<font size=4 color=gray><a name=res05></a><font color=red size=4>BOT 命令块包CBW </font><pre>
CBW即Command Block Wrapper，命令块包）是从 USB 主机发送到设备的命令包，它由 31 个字节构成，其中包含的命令遵从接口描述表中的 bInterfaceSubClass 域所指定的命令集，一般采用 SCSI 传输命令集。 USB 设备从 CBW 中取出并执行相应命令，向主机传送指定数据及发
出反映当前命令执行状态的 CSW （ Command Status Wrapper ，状态包），它由 13 个字节构成，主机根据 CSW 来判断此次操作是否正确，从而决定是继续传送数据还是进行数据传输的错误校验。事实上错误校验一直伴随着整个数据的处理过程中。
CBW 应该从数据包的边界开始，在正好传输了 31 个字节后作为短包结束。所有后续数据和 CSW 都应该从新数据包的边界开始， CBW 的说明如下表：
<img src=./bot/163157903663.png />
typedef unsigned char BYTE;
typedef unsigned short WORD;
typedef unsigned long DWORD;
struct CBW
{
    DWORD dCBWSignature;    //CBW的标识，固定值：43425355h (小端模式)。
    DWORD dCBWTag;     //主机发送的一个命令块标识，设备需要原样作为dCSWTag（CSW中的一部分）再发送给Host;主要用于关联CSW到对应的CBW。
    DWORD dCBWDataTransferLength;     //CBW命令要求在命令与回应之间传输的字节数。如果为0，则不传输数据。
    BYTE bmCBWFlags;     //反映数据传输的方向，0x00 表示来自Host，0x80 表示发至Host。
    BYTE bCBWLUN;     //对于有多个LUN逻辑单元的设备，用来选择具体目标。如果没有多个LUN，则写0。
    BYTE bCBWCBLength;     // 命令的长度，范围在0~16。
    BYTE CBWCB[16];     //传输的具体命令
};
    dCBWSignature ：帮助指明该数据报为 CBW 的信号标记。这个字段的值为 0x43425355 （小端），表示这是一个 CBW 。
    dCBWTag ：主机发送的命令块标签。设备应在相关 CBW 的 dCSWTag 字段中将这个字段的内容返回给主机。 dCSWTag 将 CSW 与对应的 CBW 联系起来。
    dCBWDataTransferLength ：主机要求在执行 CBW 命令期间，在批量输入或批量输出端点传输数据字节数。如果该字段为 0 ，则设备和主机不应该在 CBW 和相关的 CSW 中间传输数据，设备应该忽略 bmCBWFlags 中方向位的值。注意，这个字段指明的是跟在 CBW 之后数据包的长度。
    bmCBWFlags ：本字段的位定义如下：
        位 7 ：方向。 0 = 从主机到设备的 DataOut ， 1 = 从设备到主机的 DataIn ；
        位 6 ：废弃的，主机应该将该位设置为 0 ；
        位 5-0 ：保留，主机应该将该位设置为 0 ；
    bCBWLUN ：命令块发送的设备逻辑单元号（ LUN ）。对于支持多个 LUN 的设备，主机应该将该字段设置为命令块寻址的 LUN 。否则应该设置为 0 。对于 U 盘主机系统来说，因为 U 盘都不支持多个 LUN ，因此该字段应该设置为 0 。
    bCBWCBLength: 命令的长度，范围在0~16
    CBWCB ：设备将执行的命令块，对于 U 盘主机系统来说，就是将执行的 UFI 命令块。
&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bot.php#res00>返回顶部</a></pre>";
echo "<font size=4 color=gray><a name=res06></a><font color=red size=4>BOT 命令状态包CSW</font><pre>
CSW 应从包的边界开始，在传输了 13 个字节以后结束， CSW 的说明如下表：
<img src=./bot/16515717202.png />
struct CSW
{
    DWORD dCSWSignature;    // CSW的标识，固定值：53425355h (小端模式)
    DWORD dCSWTag;    //主机发送的一个命令块标识，设备需要原样作为dCSWTag（CSW中的一部分）再发送给Host;主要用于关联CSW到对应的CBW
    DWORD dCSWDataResidue;    //还需要传送的数据，此数据根据dCBWDataTransferLength－本次已经传送的数据得到 
    BYTE bCSWStatus;     //指示命令的执行状态。如果命令正确执行，bCSWStatus 返回0
};
    dCSWSignature ：帮助指明该数据包为 CSW 的信号标记，这个字段的值为 0x53425355 （小端），表示这是一个 CSW 。
    dCSWTag ：设备应将这个字段设置为接收到的相应 CBW 的 dCBWTag 字段值。
    dCSTDataResidue ：对于 DataOut ，设备应在这个字段报告 dCBWDataTransferLength 字段规定的要求数量与设备实际处理的数据量之差。对于 DataIn ，设备应在这个字段报告 dCBWDataTransferLength 字段规定的要求数量与设备实际发送的数据量之差。 dCSWResidue 的值不会
超过 dCBWDataTransferLength 发送的值。
    bCSWStatus ：表示命令执行是否成功。 0 = 执行成功，非 0 表示失败，如下表：
值 	描述
00h 	命令通过（运行良好）
01h 	命令失败
02h 	状态错误
03 - 04h 	保留（废弃）
05 - FFh 	保留
&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bot.php#res00>返回顶部</a></pre>";
echo "<font size=4 color=gray><a name=res07></a><font color=red size=4>BOT CBW和CSW数据例解析 </font><pre>
读写数据抓包
读写数据抓包
USB传输中：每一个传输包含一笔或多笔事务，每一笔事务又包含一个、两个或三个信息包。
事务：Setup（设置）事务、IN（输入）事务、OUT（输出）事务
信息包：令牌信息包、数据信息包、联络信息包
传输
|——>事务——>令牌信息包+数据信息包+联络信息包
|——>事务——>令牌信息包+数据信息包+联络信息包
|——>事务——>令牌信息包+数据信息包+联络信息包
对于写数据：
1:OUTtxn 输出事务：输出 31 B 的 命令块包（CBW）
2: OUTtxn 输出事务：输出 dCBWDataTransferLength B 的 数据
3: INTxn 输入事务：输入 13 B 的 命令传输状态包（CSW）
对于读数据
4: OUTtxn 输出事务：输出 31 B 的 命令块包（CBW）
5: INtxn 输入事务：输入 dCBWDataTransferLength B 的 数据
6: INTxn 输入事务：输入 13 B 的 命令传输状态包（CSW）
CBW和CSW数据分析
如我们打开U盘时，会读取U盘的MBR信息：
    55.2 31 OUT  55 53 42 43  a0 98 91 dc  00 10 00 00  80 00 0a 28  00 00 27 ab  98 00 00 08  00 00 00 00  00 00 00
    55.1 4096 IN 4d 5a 90 00  03 00 00 00  04 00 00 00  ff ff 00 00  b8 00 00 00  00 00 00 00  40 00 00 00  00 00 00 00  MZ......................@....... 
    13  IN     55 53 42 53  a0 98 91 dc  00 00 00 00  00
CBW内容如下：
    dCBWSignature:55 53 42 43 //USBC
    dCBWTag:a0 98 91 dc
    dCBWDataTransferLength:00 10 00 00
    bmCBWFlags:80
    bCBWLUN:00
    bCBWCBLength:0a
    CBWCB[16]:28 00 00 27 ab 98 00 00 08 00 00 00 00 00 00 00
CSW内容如下：
    dCSWSignature： 55 53 42 53
    dCSWTag：ab 98 91 dc
    dCSWDataResidue： 00 00 00 00
    bCSWStatus：00
&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bot.php#res00>返回顶部</a></pre>";
echo "<font size=4 color=gray><a name=res08></a><font color=red size=4>BOT MASS_STORAGE_RESET Bulk-Only Mass Storage Reset </font><pre>
 Bulk-Only Mass Storage Reset类特定请求是USB大容量存储设备独有的。
该特定类请求的功能
    用于复位大容量存储设备和与之关联的接口。
    通知设备接下来的批量端点输出数据为命令块包（CBW)。
由于该请求是控制请求，所以是通过端点0发送的。
在设备完成该请求即复位之前，设备应保持NAK设备请求的状态阶段。
尽管批量大容量存储复位，设备仍应保留其批量数据切换位和端点 STALL 条件的值。
特定类请求是USB标准请求中的一种，只是相对于USB设备的标准请求，只是bmRequestType字段的D6-D5为01，表示类请求命令。
bmRequestType(1) 	bRequest(1) 	wValue (2) 	wIndex(2) 	wLength(2) 	Data(N)
00100001b 	11111111b 	0000h 	Interface 	0000h 	none
0x21 	0xff 	0x0000 	接口号 	0x0000 	无数据
    0x21:表示主机到设备（D7=0),类请求（D6,D5为01),接受者为设备（D4-D0为00000）
    bRequest：固定为0xff
    wValue:固定为0x0000
    wIndex:接口号ID
    wLength:不携带数据，所以数据长度为0x0000
&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bot.php#res00>返回顶部</a></pre>";
echo "<font size=4 color=gray><a name=res09></a><font color=red size=4>GET_MAX_LUN特定类请求用于获取最大逻辑单元。</font><pre>
GET_MAX_LUN是：
    控制请求，通过端点0来发送。
    主机发送组设备，设备返回1字节数据。
    发送的目标对象是接口。
bmRequestType 	bRequest 	wValue 	wIndex 	wLength 	Data
10100001b 	11111110b 	0000h 	Interface 	0001h 	1 byte
0xA1 	0xFE 	0x0000 	低字节为接口ID，高字节为0x00 	0x0001 	解释见下面
该请求返回一个字段的数值：
    值为0时表示有1个逻辑存储单元
    值为1时表示有2个逻辑存储单元
    ….
    值为15时表示有16个逻辑存储单元（最大的值为15）
GET_MAX_LUN特定类请发生在设备枚举阶段，通过BUSHOUND抓包发生在SET_INTERFACE请求之后，如本人通过抓取本人手中的U盘信息如下：
<img src=./bot/103057367351.png />
&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bot.php#res00>返回顶部</a></pre>";
echo "<font size=4 color=gray><a name=res10></a><font color=red size=4>USB存储BOT规范UFI命令大全 </font><pre>
命令描述 	代码 	配对USB数据流 	对应章节
FORMAT UNIT 	04h 	output 	section 4.1 on page 16
INQUIRY 	12h 	input 	section 4.2 on page 19
MODE SELECT 	55h 	output 	section 4.3 on page 21
MODE SENSE 	5Ah 	input 	section 4.4 on page 22
PREVENT-ALLOW MEDIUM REMOVAL 	1Eh 	——— 	section 4.6 on page 29
READ(10) 	28h 	input 	section 4.7 on page 30
READ(12) 	A8h 	input 	section 4.8 on page 31
READ CAPACITY 	25h 	input 	section 4.9 on page 32
READ_FORMAT_CAPACITIES 	23h 	input 	section 4.10 on page 33
REQUEST SENSE 	03h 	input 	section 4.11 on page 37
REZERO 	01h 	——— 	section 4.12 on page 39
SEEK(10) 	2Bh 	——— 	section 4.13 on page 40
SEND DIAGNOSTIC 	1Dh 	——— 	section 4.14 on page 41
START-STOP UNIT 	1Bh 	——— 	section 4.15 on page 42
TEST UNIT READY 	00h 	——— 	section 4.16 on page 44
VERIFY 	2Fh 	——— 	section 4.17 on page 45
WRITE(10) 	2Ah 	output 	section 4.18 on page 46
WRITE(12) 	AAh 	output 	section 4.19 on page 47
WRITE AND VERIFY 	2Eh 	output 	section 4.20 on page 48
&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bot.php#res00>返回顶部</a></pre>";
echo "<font size=4 color=gray><a name=res11></a><font color=red size=4>U盘BOT存储UFI协议READ_FORMAT_CAPACITIES命令说明及实例分析 </font><pre>
UFI命令READ_FORMAT_CAPACITIES（读取格式化容量）命令允许主机请求在当前安装的介质上可以格式化的可能容量列表。如果当前未安装介质，UFI设备应返回设备可格式化的最大容量。
    define READ_FORMAT_CAPACITIES  0x23
READ_FORMAT_CAPACITIES命令格式
<img src=./bot/201245565617.png />
Allocation Length指定主机可以接收的格式数据的最大字节数。如果小于容量数据的大小，UFI设备只返回请求的字节数。但是，UFI设备不得调整格式数据中的容量列表长度以反映截断。
READ_FORMAT_CAPACITIES返回数据格式
返回数据包括两部分，分别为Capacity List Header和。
    typedef struct _FORMAT_CAPACITIES_RESPONSE_STRUCT
    {
    #pragma pack(1)
        //Capacity List Header
        UCHAR Reserved0[3];
        UCHAR CapacityListLength;  
        //Current/Maximum Capacity Descriptor
        ULONG NumberOfBlocks;   
        ULONG DescriptorCode:2;
        ULONG Reserved1 : 6;
        ULONG BlockLength : 24;
    #pragma pack()
    }FORMAT_CAPACITIES_STRUCT,*PFORMAT_CAPACITIES_STRUCT;
Capacity List Header
<img src=./bot/201953333320.png />
容量列表长度字段指定后面容量描述符的字节长度。每个容量描述符的长度为八个字节，使容量列表的长度等于描述符数量的八倍。
Current/Maximum Capacity Descriptor
Current/Maximum Capacity Descriptor描述了在UFI设备中装入介质且其格式已知时的当前介质容量，或者在未装入介质、装入的介质未格式化或装入的介质的格式未知时，UFI设备可以格式化的最大容量
<img src=./bot/202114276836.png />
    Number of Blocks表示描述符媒体类型的可寻址块总数。
    Descriptor Code指定返回给主机的描述符类型
“DescriptorCode” 	Descriptor Type
01b 	Unformatted Media - Maximum formattable capacity for this cartridge
10b 	Formatted Media - Current media capacity
11b 	“No Cartridge in Drive - Maximum formattable capacity for any cartridge”
READ_FORMAT_CAPACITIES示例
如以下为LBA个数为2946个，每个LBA4096字节，数据为大端。
00 00 07 fe = 2046
00 01 00 00(补齐) = 4096
    //CWB
     20.2  31  OUT    55 53 42 43  70 22 57 b4  fc 00 00 00  80 00 0a 23  
                      00 00 00 00  00 00 00 fc  00 00 00 00  00 00 00 
    //Response
    20.1  12  IN     00 00 00 08 00 00 07 fe 02 00 01 00 00(补齐)
    //CSW
     20.1  13  IN     55 53 42 53  70 22 57 b4  f0 00 00 00  00
&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bot.php#res00>返回顶部</a></pre>";
echo "<font size=4 color=gray><a name=res12></a><font color=red size=4>U盘BOT存储UFI协议INQUIRY命令说明及实例分析 </font><pre>
INQUIRY定义为0x12,用于查询USB存储即U盘的基本信息，这些信息包括厂家信息，产品信息及产品版本号等。
INQUIRY流程图
<img src=./bot/100310398893.png />
INQUIRY命令通过BULK传输的OUT端点下发给设备，设备需要先返回基本的INQUIRY信息，再返回CSW状态。
INQUIRY命令格式
<img src=./bot/100935496374.png />
    LUN ：被设置为 0 。
    EVPD ：被设置为 0 。
    页代码： UFI 设备仅支持页代码 0 标准查询数据。
    存储空间长度：指定被返回的查询数据的最大字节数， 0 值将不会产生错误。
    UFI 设备通常根据请求的字节数返回查询的数据。它不会使用查询命令报告介质状态，例如介质改变或者驱动器不准备。查询命令将不会影响驱动器单元条件或介质状态。
INQUIRY命令是通过CBW下发的，内容位于该结构体的成员CBWCB成员数组0索引位置。
完整的CBW内容如下：
    55 53 42 43 00 16 64 92 24 00 00 00 80 00 06 12 00 00 00 24 00 00 00 00 00 00 00 00 00 00 00
格式：
    UsbzhVDisk!_CBW
       +0x000 dCBWSignature    : 0x43425355
       +0x004 dCBWTag          : 0x92641600
       +0x008 dCBWDataTransferLength : 0x24
       +0x00c bmCBWFlags       : 0x80 ''
       +0x00d bCBWLUN          : 0 ''
       +0x00e bCBWCBLength     : 0x6 ''
       +0x00f CBWCB            : [16]  \"???\"
                       [0]:0x12
                       [1]:0x00
                    [2]:0x00
                    [3]:0x00
                       [4]:0x24
                    [5]:0x00
                    [6]:0x00
                       [7]:0x00
                    [8]:0x00
                    [9]:0x00
                       [10]:0x00
                    [11]:0x00
                    [12]:0x00
                       [13]:0x00
                    [14]:0x00
                    [15]:0x00
INQUIRY返回数据格式
<img src=./bot/101040347867.png />
外设类型用于指示当前连接的设备类型， 0 表示软磁盘设备。 RMB 代表可移除介质（ Removable Media Bit ）， 1 表示该设备具有可移除介质， 0 表示没有。
    UsbzhVDisk!_INQUIRY_STRUCT
       +0x000 DeviceType       : 0y00000 (0)
       +0x000 Reserved0        : 0y000
       +0x001 Reserved1        : 0y0000000 (0)
       +0x001 RMB              : 0y1
       +0x002 ANSIVer          : 0y100
       +0x002 EMCAVer          : 0y000
       +0x002 ISOVer           : 0y00
       +0x003 ReponseDataFormat : 0y0010
       +0x003 Reserved3        : 0y0000
       +0x004 AppendDataLength : 0x1f ''
       +0x005 Reserved5_7      : [3]  \"\"
       +0x008 VenderInfo       : [8]  \"USBZHCOM\"
       +0x010 ProductInfo      : [16]  \"DataTraveler 2.0\"
       +0x020 ProducetVerInfo  : [4]  \"0000\"
结构体定义如下：
    typedef struct _INQUIRY_RESONSE_STRUCT
    {
        UCHAR DeviceType:5;
        UCHAR Reserved0 : 3;
        UCHAR Reserved1 : 7;
        UCHAR RMB : 1;
        UCHAR ANSIVer : 3;
        UCHAR EMCAVer : 3;
        UCHAR ISOVer : 2;
        UCHAR ReponseDataFormat : 4;
        UCHAR Reserved3 : 4;
        UCHAR AppendDataLength;
        UCHAR Reserved5_7[3];
        UCHAR VenderInfo[8];
        UCHAR ProductInfo[16];
        UCHAR ProducetVerInfo[4];
    }INQUIRY_RESONSE_STRUCT;
INQUIRY返回的CSW
    55 53 42 43  50 70 f9 aa  24 00 00 00  80 00 06 12
    00 00 00 24  00 00 00 00  00 00 00 00  00 00 00
U盘BOT存储UFI协议INQUIRY命令说明及实例分析2 
INQUIRY命令请求用于将UFI设备的参数信息发送到主机。主机上的驱动程序使用它来询问UFI设备的配置。
NQUIRY命令请求通常是在通电或硬件复位之后。
    #define INQUIRY 0x12
UFI INQUIRY命令格式
<img src=./bot/093825654978.png />
    EVPD（Enable Vital Product Data）置为0。
    Logical Unit Number：返回查询数据的逻辑单元（0到7）
    Page Code ：指定UFI设备应返回到主机的重要产品数据信息的哪一页。UFI设备仅支持页面代码为零（00h）的标准查询数据
    Allocation Length：指定要返回的查询数据的最大字节数。值为零不会产生错误。
UFI设备应始终返回Inquiry查询的数据，最多返回请求的字节数。UFI设备不使用Inquiry令报告介质状态，例如介质更改或驱动器未就绪。查询命令不得影响驱动装置状态或介质状态。
    0x55, 0x53, 0x42, 0x43, 0xA0, 0xB9, 0x16, 0xB9, 0x24, 0x00, 0x00, 0x00, 0x80, 0x00, 0x06, 0x12, 0x00, 0x00, 0x00, 0x24, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 
    UNIT32 dCBWSignature:0x55, 0x53, 0x42, 0x43, 
    UNIT32 dCBWTag:0xA0, 0xB9, 0x16, 0xB9, 
    UNIT32 dCBWDataTransferLength=36,(0x24, 0x00, 0x00, 0x00, )
    UNIT8 bmCBWFlags=0x80, Response data to HOST(IN)
    UNIT8 bCBWLUN=0x00, 
    UNIT8 bCBWCBLength=0x06, 
    BYTE CBWCB[16]=0x12, 0x00, 0x00, 0x00, 0x24, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 
        INQUIRY=0x12, 
        EPVD=0x00, 
        LogicalUnitNum=0x00, 
        PageCode=0x00, 
        AllocationLength=0x01,
UFI INQUIRY数据响应格式
UFI设备应在批量输入端点上返回包含36个字节的标准查询数据。
<img src=./bot/094748304548.png />
    Peripheral Device Type:标识当前连接到请求的逻辑单元的设备。
        00h直接访问设备（软盘）
        1Fh None（没有FDD连接到请求的逻辑单元）
    RMB:可移动媒体位：该位应设置为1，以指示可移动设备（removable media）。
    ISO/ECMA:对于UFI设备，必须为0。
    ANSI Version：必须包含零以符合此版本的规范
    Response Data Format：UFI设备必须为0x01
    The Additional Length:指定参数的长度（以字节为单位）。如果命令包的分配长度太小，无法传输所有参数，则不应调整额外长度以反映截断。UFI设备应将该字段设置为1Fh
    Vendor Identificatio:包含标识产品供应商的8字节ASCII数据。数据应在此字段内左对齐。
    Product Identification:包含供应商定义的16字节ASCII数据。数据应为在此字段内左对齐。
    Product Revision Level：包含供应商定义的4字节ASCII数据。数据应在此字段内左对齐。对于UFI设备，此字段表示固件版本号。
    ----INQUIRY Response-----
    0x00, 0x00, 0x04, 0x02, 0x20, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x4D, 0x61, 0x73, 0x73, 0x20, 0x53, 0x74, 0x6F, 0x72, 0x61, 0x67, 0x65, 0x20, 0x41, 0x30, 0x30, 0x31, 
        PerpheralDeviceType=0x00, Direct-access device (floppy)
        RMB=0x00, 
        ANSI Version=0x04, 
        ECMA Version=0x00, 
        ISO Version=0x00, 
        Response Data Format=0x02, 
        Additional Length =0x20, 
        Vendor Information =0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 
        Product Identification =0x00, 0x00, 0x00, 0x4D, 0x61, 0x73, 0x73, 0x20, 0x53, 0x74, 0x6F, 0x72, 0x61, 0x67, 0x65, 0x20, 
        Product Revision Leveln.nn=0x41, 0x30, 0x30, 0x31,
INQUIRY命令的数据格式解析可参见：http://www.usbzh.com/tool/bot-cbw-ufi-csw.html
&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bot.php#res00>返回顶部</a></pre>";
echo "<font size=4 color=gray><a name=res13></a><font color=red size=4>U盘BOT存储UFI协议TEST UNIT READY命令:0x00 </font><pre>
TEST UNIT READY提供了一种检查UFI设备是否就绪的方法。
TEST UNIT READY不是用于自检的。如果UFI设备将接受适当的介质访问命令而不返回检查条件状态，则该命令应返回良好状态。如果UFI设备无法运行或处于需要主机操作才能使UFI设备准备就绪的状态，UFI设备应返回检查条件状态，且检测键为NOT ready（未准备就绪）。
<img src=./bot/160046259568.png />
UFI设备可能会使TEST UNIT READY失败，检测键为NOT READY，附加检测代码为LOGICAL DRIVE NOT READY–需要初始化。清除错误后，主机应尝试发出启动命令块.
    The UFI device may fail a TEST UNIT READY command with a sense key of NOT READY and an Additional
    Sense Code of LOGICAL DRIVE NOT READY – INITIALIZATION REQUIRED. After clearing the error,
    the host should try issuing a START command block
一般一个正常的U盘抓包没有看到过这个命令，不过本人在虚拟U盘(http://www.usbzh.com/article/detail-920.html )的时候，如果某些命令没有正确返回或者逻辑状态错误，系统会下发大量的EST UNIT READY命令。
&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bot.php#res00>返回顶部</a></pre>";
echo "<font size=4 color=gray><a name=res14></a><font color=red size=4>U盘BOT存储UFI协议READ_CAPACITY命令说明及实例分析 </font><pre>
READ_CAPACITY命令用于主机从设备获取当前设备媒价的存储容量。
    #define READ_CAPACITY 0x25
UFI READ CAPACITY命令格式
<img src=./bot/101325828526.png />
    RelAdr:必须为0
    Logical Block Address：为0
    PMI：为0
如果UFI设备识别已格式化介质，UFI设备将向批量输入端点上的主机返回READ CAPACITY数据。
如果介质未格式化、未知或未显示，UFI设备会使命令块失败，并将检测键设置为下列出的适当值。
Sense Key 	ASC 	ASCQ 	Description of Error
0 	0 	NO SENSE 	
1 	17 	1 	RECOVERED DATA WITH RETRIES
1 	18 	0 	RECOVERED DATA WITH ECC
2 	4 	1 	LOGICAL DRIVE NOT READY - BECOMING READY
2 	4 	2 	LOGICAL DRIVE NOT READY - INITIALIZATION REQUIRED
2 	4 	4 	LOGICAL UNIT NOT READY - FORMAT IN PROGRESS
2 	4 	FF 	LOGICAL DRIVE NOT READY - DEVICE IS BUSY
2 	6 	0 	NO REFERENCE POSITION FOUND
2 	8 	0 	LOGICAL UNIT COMMUNICATION FAILURE
2 	8 	1 	LOGICAL UNIT COMMUNICATION TIME-OUT
2 	8 	80 	LOGICAL UNIT COMMUNICATION OVERRUN
2 	3A 	0 	MEDIUM NOT PRESENT
2 	54 	0 	USB TO HOST SYSTEM INTERFACE FAILURE
2 	80 	0 	INSUFFICIENT RESOURCES
2 	FF 	FF 	UNKNOWN ERROR
3 	2 	0 	NO SEEK COMPLETE
3 	3 	0 	WRITE FAULT
3 	10 	0 	ID CRC ERROR
3 	11 	0 	UNRECOVERED READ ERROR
3 	12 	0 	ADDRESS MARK NOT FOUND FOR ID FIELD
3 	13 	0 	ADDRESS MARK NOT FOUND FOR DATA FIELD
3 	14 	0 	RECORDED ENTITY NOT FOUND
3 	30 	1 	CANNOT READ MEDIUM - UNKNOWN FORMAT
3 	31 	1 	FORMAT COMMAND FAILED
4 	40 	NN 	DIAGNOSTIC FAILURE ON COMPONENT NN (80H-FFH)
5 	1A 	0 	PARAMETER LIST LENGTH ERROR
5 	20 	0 	INVALID COMMAND OPERATION CODE
5 	21 	0 	LOGICAL BLOCK ADDRESS OUT OF RANGE
5 	24 	0 	INVALID FIELD IN COMMAND PACKET
5 	25 	0 	LOGICAL UNIT NOT SUPPORTED
5 	26 	0 	INVALID FIELD IN PARAMETER LIST
5 	26 	1 	PARAMETER NOT SUPPORTED
5 	26 	2 	PARAMETER VALUE INVALID
5 	39 	0 	SAVING PARAMETERS NOT SUPPORT
6 	28 	0 	“NOT READY TO READY TRANSITION - MEDIA CHANGED”
6 	29 	0 	“POWER ON RESET OR BUS DEVICE RESET OCCURRED”
6 	2F 	0 	COMMANDS CLEARED BY ANOTHER INITIATOR
7 	27 	0 	WRITE PROTECTED MEDIA
0B 	4E 	0 	OVERLAPPED COMMAND ATTEMPTED
UFI READ CAPACITY响应数据格式
<img src=./bot/102314613099.png />
    Last Logical Block Address：最后一个有效的LBA
    Block Length In Bytes:每个LBA的字幕了数
    typedef struct _READ_CAPACITY_RESPONSE_STRUCT
    {
        ULONG LastLogicalBlockAddress;
        ULONG BlockLengthInBytes;
    }READ_CAPACITY_RESPONSE_STRUCT,*PREAD_CAPACITY_RESPONSE_STRUCT;
如我们虚拟的一个8M U盘(http://www.usbzh.com/article/detail-920.html)，其数据定义如下：
    #define BLOCK_LENGTH    (ULONG)(512*8)
    #define BLOCK_NUM       (ULONG)(2046)
    #define SwapUSHORT(A)   (( ((USHORT)(A) & 0xff00) >> 8)    | ((USHORT)(A) & 0x00ff) << 8)
    #define SwapULONG(A)   ((( (ULONG)(A) & 0xff000000) >> 24) |     (((ULONG)(A) & 0x00ff0000) >> 8) | (((ULONG)(A) & 0x0000ff00) << 8) | (((ULONG)(A) & 0x000000ff) << 24))
    PREAD_CAPACITY_RESPONSE_STRUCT pft = (PREAD_CAPACITY_RESPONSE_STRUCT)buffer;
    RtlZeroMemory(pft, length);
    pft->LastLogicalBlockAddress = SwapULONG(BLOCK_NUM);
    pft->BlockLengthInBytes = SwapULONG(BLOCK_LENGTH);
&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bot.php#res00>返回顶部</a></pre>";
echo "<font size=4 color=gray><a name=res15></a><font color=red size=4>U盘BOT存储UFI协议READ(10)命令:0x28 </font><pre>
READ（10）命令请求UFI设备将数据传输到主机。应返回写入寻址逻辑块的最新数据值。
    #define READ_DATA 0x28
UFI READ(10)命令格式
<img src=./bot/114839189423.png />
    DPO:为0
    FUA:为0
    RelAdr:为0
    55 53 42 43  a0 69 49 b4  00 10 00 00  80 00 0a 28  00 00 00 00  00 00 00 01  00 00 00 00  00 00 00 //OUT
    ... //IN数据
    55 53 42 53  a0 69 49 b4  00 00 00 00  00  // IN CSW
    #define SwapUSHORT(A)   (( ((USHORT)(A) & 0xff00) >> 8)    | ((USHORT)(A) & 0x00ff) << 8)
    typedef struct _READ_CMD
    {
    #pragma pack(1)
        UCHAR cmd;
        UCHAR Reserved : 5;
        UCHAR LogicalUnitNum : 3;
        ULONG LogicalBlockAddress;
        UCHAR Reserved2;
        USHORT TransferLength;
        UCHAR Reserved3[3];
    #pragma pack()
    }READ_CMD;
    READ_CMD* pReadCmd = (READ_CMD*)deviceExtension->cbw.CBWCB;
    USHORT len = SwapUSHORT(pReadCmd->TransferLength);
    ULONG Lba = SwapULONG(pReadCmd->LogicalBlockAddress);
&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bot.php#res00>返回顶部</a></pre>";
echo "<font size=4 color=gray><a name=res16></a><font color=red size=4>U盘BOT存储UFI协议WRITE(10)命令:0x2A </font><pre>
WRITE（10）命令要求UFI设备将主机传输的数据写入介质。
    #define WRITE_DATA 0x2a
UFI WRITE(10)命令格式
<img src=./bot/120251697610.png />
    DPO:为0
    FUA:为0
    RelAdr:为0
    typedef struct _READ_CMD
    {
    #pragma pack(1)
        UCHAR cmd;
        UCHAR Reserved : 5;
        UCHAR LogicalUnitNum : 3;
        ULONG LogicalBlockAddress;
        UCHAR Reserved2;
        USHORT TransferLength;
        UCHAR Reserved3[3];
    #pragma pack()
    }READ_CMD;
    typedef struct _READ_CMD WRITE_CMD;
    WRITE_CMD* pWriteCmd = (WRITE_CMD*)deviceExtension->cbw.CBWCB;
    USHORT len = SwapUSHORT(pWriteCmd->TransferLength);
&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bot.php#res00>返回顶部</a></pre>";
echo "<font size=4 color=gray><a name=res17></a><font color=red size=4>U盘BOT存储UFI协议数据自检校验命令VERIFY:0x2F </font><pre>
VERIFY命令请求用于UFI设备校验设备上的数据。
VERIFY Command格式
<img src=./bot/111201402327.png />
VERIFY Command格式
    DPO:为0
    ByteChk：为0。USB-FDU仅检查介质上的CRC数据，无数据比较
    RelAdr：为0
    Logical Block Address:该字段指定验证操作开始的逻辑块LBA。
    Verification Length:验证长度字段指定要验证的连续逻辑数据块的数量。验证长度为零表示不会验证任何逻辑块。这种情况不会被视为错误，也不会验证任何数据。任何其他值表示将要验证的逻辑块的数量。
如果验证命令成功完成，UFI设备应将检测数据设置为NO SENSE.,否则，装置应将传感数据设置为下面列出的适当值。
Sense Key 	ASC 	ASCQ 	Description of Error
0 	0 	NO SENSE 	
1 	17 	1 	RECOVERED DATA WITH RETRIES
1 	18 	0 	RECOVERED DATA WITH ECC
2 	4 	1 	LOGICAL DRIVE NOT READY - BECOMING READY
2 	4 	2 	LOGICAL DRIVE NOT READY - INITIALIZATION REQUIRED
2 	4 	4 	LOGICAL UNIT NOT READY - FORMAT IN PROGRESS
2 	4 	FF 	LOGICAL DRIVE NOT READY - DEVICE IS BUSY
2 	6 	0 	NO REFERENCE POSITION FOUND
2 	8 	0 	LOGICAL UNIT COMMUNICATION FAILURE
2 	8 	1 	LOGICAL UNIT COMMUNICATION TIME-OUT
2 	8 	80 	LOGICAL UNIT COMMUNICATION OVERRUN
2 	3A 	0 	MEDIUM NOT PRESENT
2 	54 	0 	USB TO HOST SYSTEM INTERFACE FAILURE
2 	80 	0 	INSUFFICIENT RESOURCES
2 	FF 	FF 	UNKNOWN ERROR
3 	2 	0 	NO SEEK COMPLETE
3 	3 	0 	WRITE FAULT
3 	10 	0 	ID CRC ERROR
3 	11 	0 	UNRECOVERED READ ERROR
3 	12 	0 	ADDRESS MARK NOT FOUND FOR ID FIELD
3 	13 	0 	ADDRESS MARK NOT FOUND FOR DATA FIELD
3 	14 	0 	RECORDED ENTITY NOT FOUND
3 	30 	1 	CANNOT READ MEDIUM - UNKNOWN FORMAT
3 	31 	1 	FORMAT COMMAND FAILED
4 	40 	NN 	DIAGNOSTIC FAILURE ON COMPONENT NN (80H-FFH)
5 	1A 	0 	PARAMETER LIST LENGTH ERROR
5 	20 	0 	INVALID COMMAND OPERATION CODE
5 	21 	0 	LOGICAL BLOCK ADDRESS OUT OF RANGE
5 	24 	0 	INVALID FIELD IN COMMAND PACKET
5 	25 	0 	LOGICAL UNIT NOT SUPPORTED
5 	26 	0 	INVALID FIELD IN PARAMETER LIST
5 	26 	1 	PARAMETER NOT SUPPORTED
5 	26 	2 	PARAMETER VALUE INVALID
5 	39 	0 	SAVING PARAMETERS NOT SUPPORT
6 	28 	0 	“NOT READY TO READY TRANSITION - MEDIA CHANGED”
6 	29 	0 	“POWER ON RESET OR BUS DEVICE RESET OCCURRED”
6 	2F 	0 	COMMANDS CLEARED BY ANOTHER INITIATOR
7 	27 	0 	WRITE PROTECTED MEDIA
0B 	4E 	0 	OVERLAPPED COMMAND ATTEMPTED
如果验证命令因USB位填充错误或CRC错误而中止，则应设置UFI设备USB到主机系统接口的sense data 故障 为 USB TO HOST SYSTEM INTERFACE FAILURE.
&nbsp;&nbsp;&nbsp;&nbsp;<a href=./bot.php#res00>返回顶部</a></pre>";
?>
