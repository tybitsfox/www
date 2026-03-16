<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<a name=res00></a><font size=6 color=#ff0000><center>PCIE, USB, MMIO, SCSI相关资料 --from grok</center></font><br><br><br>";
echo "<center><table width=80% border=0>
<tr><td width=50%><a href=usb_mmio.php#res01>一、USB控制器的MMIO区域</a></td><td width=50%>待添加</td></tr>
<tr><td width=50%><a href=usb_mmio.php#res02>二、典型xHCI MMIO布局示例（简化）</a></td><td width=50%>待添加</td></tr>
<tr><td width=50%><a href=usb_mmio.php#res03>三、通过USB控制器的MMIO获取usb存储器的状态</a></td><td width=50%>待添加</td></tr>
<tr><td width=50%><a href=usb_mmio.php#res04>四、MMIO 与 USB存储读取</a></td><td width=50%>待添加</td></tr>
<tr><td width=50%><a href=usb_mmio.php#res05>五、SCSI（Small Computer System Interface）</a></td><td width=50%>待添加</td></tr>
<tr><td width=50%><a href=usb_mmio.php#res06>六、典型 USB Mass Storage BOT 协议流程示例(一个完整的读 4KB 的流程)</a></td><td width=50%>待添加</td></tr>
<tr><td width=50%><a href=usb_mmio.php#res07>七、USB Bulk Endpoint,Bulk端点</a></td><td width=50%>待添加</td></tr>
<tr><td width=50%><a href=usb_mmio.php#res08>八、Bulk IN / OUT 在 MMIO 中的位置</a></td><td width=50%>待添加</td></tr>
<tr><td width=50%><a href=usb_mmio.php#res09>九、xHCI MMIO 空间的简化内存布局图</a></td><td width=50%>待添加</td></tr>
<tr><td width=50%><a href=usb_mmio.php#res10>十、MMIO（Memory-Mapped I/O，内存映射输入输出）</a></td><td width=50%>待添加</td></tr>
<tr><td width=50%>待添加</td><td width=50%>待添加</td></tr>";
echo "</table></center>";
echo "<pre><font size=4 color=gray><a name=res01></a><font color=red size=4>USB控制器的MMIO区域</font>
USB控制器的MMIO区域（Memory-Mapped I/O）是指USB主机控制器（Host Controller）通过PCI/PCIe BAR（Base Address Register）映射到系统物理内存地址空间的一段连续内存区域。操作系统（或裸机代码）通过读写这块内存来控制USB
控制器硬件、发起传输、读取状态、配置端口等，而不需要使用老式的I/O端口指令（如in/out）。
现代USB控制器（尤其是xHCI）几乎全部采用MMIO方式，早期UHCI/EHCI/OHCI也大多是MMIO（少数老平台可能有少量I/O端口，但已极少见）。
主要USB控制器类型与MMIO特点对比（2026年主流视角）
<center><table border=1 width=80%><tr><td width=5%>
控制器类型</td><td width=10%>USB版本支持</td><td width=20%>MMIO大小（典型）</td><td width=45%>主要寄存器组织方式</td><td width=20%>当前主流程度（2026）</td></tr><tr><td width=5%>
UHCI</td><td width=10%>USB 1.1 (Low/Full)</td><td width=20%>通常128字节</td><td width=45%>简单固定偏移（I/O端口 + MMIO混合，老平台）</td><td width=20%>极少，几乎淘汰</td></tr><tr><td width=5%>
OHCI</td><td width=10%>USB 1.1</td><td width=20%>通常1KB</td><td width=45%>固定寄存器布局</td><td width=20%>很少</td></tr><tr><td width=5%>
EHCI</td><td width=10%>USB 2.0</td><td width=20%>通常1–4 KB</td><td width=45%>Capability + Operational + Port寄存器</td><td width=20%>嵌入式/老设备仍有</td></tr><tr><td width=5%>
xHCI</td><td width=10%>USB 3.x / 4.x</td><td width=20%>典型 4KB–64KB+（可变）</td><td width=20%>Capability → Operational → Doorbell → Runtime → Extended Capability</td><td width=20%>绝对主流（几乎所有新PC/服务器/嵌入式）</td></tr></table></center>
xHCI的MMIO区域结构（最重要、最常用）
xHCI规范（Intel主导，最新版约1.2/2.0）把MMIO区域清晰分为几个逻辑部分，从低地址到高地址依次是：
	1	Capability Registers（能力寄存器）
	•	偏移：0x00 开始
	•	固定部分：CAPLENGTH（通常0x20~0x40）寄存器告诉后面Operational寄存器的起始偏移
	•	包含：HCSPARAMS1/2、HCCPARAMS1/2 等，报告硬件能力（如最大设备槽数、端口数、支持的页大小、是否支持64位地址等）
	2	Operational Registers（操作寄存器）
	•	偏移：Capability基址 + CAPLENGTH（最常见从0x20开始）
	•	核心控制区，几乎所有日常操作都在这里
	•	关键寄存器示例（部分偏移，实际以CAPLENGTH为准）：
	•	USBCMD (0x00)：运行/停止、复位、中断使能等
	•	USBSTS (0x04)：状态（HCHalted、Host System Error等）
	•	PAGESIZE (0x08)：支持的页大小（通常4KB或64KB）
	•	DNCTRL (0x14)：设备通知控制
	•	CRCR (0x18)：Command Ring Control Register（命令环指针）
	•	DCBAAP (0x30)：Device Context Base Address Array Pointer
	•	CONFIG (0x38)：Max Slots Enabled 等
	3	Doorbell Registers（门铃寄存器）
	•	偏移：Operational基址 + DBOFFSET（通常在Operational后面几十字节）
	•	每个设备槽（slot）一个32位寄存器
	•	软件写门铃 → 通知控制器“有新的TRB（Transfer Request Block）可以处理了
	•	这是xHCI最高效的触发传输机制（取代了老式轮询）
	4	Runtime Registers（运行时寄存器）
	•	偏移：Runtime基址 = MMIO基址 + RTSOFF（从HCCPARAMS1得到）
	•	包含中断器（Interrupter）管理：每个中断器有自己的MFINDEX、IR Set、Event Ring Segment Table 等
	•	用于多中断支持、MSI-X等高级特性
	5	Extended Capabilities（扩展能力链表，可选）
	•	偏移：从HCCPARAMS1的低16位得到第一个扩展能力的指针（相对Capability基址）
	•	链表形式：每个能力有ID（如0x01 = USB Legacy Support, 0x02 = Supported Protocol (USB 2.0/3.0)，0x0A = xHCI Extended Power Management 等）
	•	现代控制器通常有多个扩展能力&nbsp;&nbsp;&nbsp;&nbsp;<a href=./usb_mmio.php#res00>返回顶部</a>";
echo "<br><a name=res02></a><font color=red size=4>典型xHCI MMIO布局示例（简化）</font>
MMIO基址 (从PCI BAR0/1得到，通常64位地址)
├── 0x0000 ── Capability Registers ── (读能力，固定大小)
│   └── CAPLENGTH (e.g. 0x20) → 指向Operational起始
├── 0x0020 ── Operational Registers ── (核心控制，固定偏移)
│   ├── USBCMD, USBSTS, PAGESIZE...
│   └── CONFIG, MaxSlots...
├── 0x???? ── Doorbell Registers ── (每个slot 4字节，可变数量)
├── ────── Runtime Registers ── (中断、Event Ring管理)
└── ────── Extended Capabilities (链表，可选)

实际使用中的几点关键
	•	如何找到MMIO基址：PCI配置空间 → BAR0（或BAR0+BAR1 64位） → 通常是内存空间、可预取（prefetchable）
	•	页对齐：大多数寄存器访问需要自然对齐（4/8/32字节），否则可能导致硬件错误
	•	大小不确定：xHCI规范不固定总大小，由硬件实现决定（常见几KB到几十KB），驱动程序通过能力寄存器动态计算各部分边界
	•	现代系统：xHCI控制器MMIO通常映射在高地址（如0xFE xx_xxxx 或 PCIe域），大小常为64KB对齐
如果你是在写xHCI驱动（内核/UEFI/裸机），强烈建议直接参考Intel xHCI规范（最新版约600+页PDF），里面有详细的寄存器位定义和内存布局图。&nbsp;&nbsp;&nbsp;&nbsp;<a href=./usb_mmio.php#res00>返回顶部</a>
<font size=4 color=red><a name=res03></a>通过USB控制器的MMIO获取usb存储器的状态</font>
通过 USB控制器 的 MMIO（主要是 xHCI，因为2026年几乎所有新设备都使用xHCI）来获取 USB存储设备（Mass Storage Class）的状态，实际上有几个不同层次的状态可以读取：
想知道的状态层级:<center><table border=1 width=80%><tr><td width=25%>
想知道的状态层级</td><td width=25%>主要依赖的寄存器/机制</td><td width=25%>是否直接反映存储设备可用性</td><td width=25%>难度 / 典型场景</td></tr><tr><td width=25%>
端口是否有设备物理连接</td><td width=25%>PORTSC (Port Status and Control)</td><td width=25%>部分（只到设备层）</td><td width=25%>★★☆☆☆ 最常用端口级状态</td></tr><tr><td width=25%>
端口是否suspend / link状态</td><td width=25%>PORTSC + PORTLI + PORTPMSC</td><td width=25%>部分</td><td width=25%>★★★☆☆</td></tr><tr><td width=25%>
设备是否完成地址分配</td><td width=25%>Slot Context (Device Context)</td><td width=25%>是（但需看上下文）</td><td width=25%>★★★★☆ 需要驱动级实现</td></tr><tr><td width=25%>
设备是否配置完成（配置描述符ok）</td><td width=25%>Endpoint Context + 配置命令完成情况</td><td width=25%>是</td><td width=25%>★★★★★</td></tr><tr><td width=25%>
Bulk端点是否正常（存储读写）</td><td width=25%>Transfer Ring + Event Ring + TRB完成码</td><td width=25%>最直接反映“可用</td><td width=25%>★★★★★ 接近真实驱动</td></tr><tr><td width=25%>
是否有端口状态变化事件</td><td width=25%>Event Ring 中的 Port Status Change Event TRB</td><td width=25%>间接（变化检测）</td><td width=25%>★★★★☆ 中断驱动常用</td></tr></table></center>

下面按实际可操作性从简单到复杂说明（假设你已经有xHCI的MMIO基地址映射好）。
1. 最常用：读取端口的连接状态（PORTSC寄存器）
几乎所有想知道“这个USB口上有没有东西”“是不是U盘”的代码都会先读这个。
PORTSC 寄存器位置：
	•	Operational base = MMIO base + CAPLENGTH（Capability Registers Length，通常0x20~0x40）
	•	每个端口的 PORTSC 偏移 = Operational base + 0x400 + (端口号-1)×0x10
	•	端口1 → +0x400
	•	端口2 → +0x410
	•	端口3 → +0x420
	•	……
PORTSC 关键位（xHCI 1.2/2.0规范，32位寄存器）：<center><table border=1 width=80%><tr><td width=25%>
位</td><td width=25%>名称</td><td width=25%>含义（重点关注）</td><td width=25%>典型值含义</td></tr><tr><td width=25%>
0</td><td width=25%>Current Connect Status</td><td width=25%>1 = 有设备连接，0 = 无设备</td><td width=25%>最重要：是否有物理连接</td></tr><tr><td width=25%>
1</td><td width=25%>Port Enabled/Disabled</td><td width=25%>1 = 端口启用，0 = 禁用</td><td width=25%>通常要enable才能用</td></tr><tr><td width=25%>
4</td><td width=25%>Port Reset</td><td width=25%>写1触发reset，完成后硬件清0</td><td width=25%>复位端口常用</td></tr><tr><td width=25%>
5–8</td><td width=25%>Port Link State</td><td width=25%>当前链路状态（USB3特有）</td><td width=25%>0=U0(活跃), 3=U3(悬挂), 等</td></tr><tr><td width=25%>
16–19</td><td width=25%>Port Speed</td><td width=25%>连接速度（协议版本）</td><td width=25%>见下表</td></tr><tr><td width=25%>
22</td><td width=25%>Cold Attach Status</td><td width=25%>USB3冷插拔状态</td><td width=25%>—</td></tr><tr><td width=25%>
30</td><td width=25%>Wake on Connect Enable</td><td width=25%>—</td><td width=25%>—</td></tr></table></center>

Port Speed 值含义（常见,上表16-19位）：
	•	0000b = 未定义
	•	0001b = Full Speed (12 Mbps)
	•	0010b = Low Speed (1.5 Mbps)
	•	0011b = High Speed (480 Mbps) ← 大多数U盘
	•	0100b = SuperSpeed (5 Gbps)
	•	0101b = SuperSpeedPlus (10 Gbps)
	•	……
读取示例（c伪代码）：

uint32_t op_base = mmio_base + *(uint8_t*)(mmio_base + 0x00);  // CAPLENGTH
uint32_t portsc_addr = op_base + 0x400 + (port_number-1)*0x10;
uint32_t portsc = *(volatile uint32_t*)portsc_addr;
bool connected    = (portsc & (1u << 0)) != 0;
bool enabled      = (portsc & (1u << 1)) != 0;
uint32_t link_state = (portsc >> 5) & 0xF;
uint32_t speed_id   = (portsc >> 16) & 0xF;

if (connected && enabled && speed_id >= 0x3) {
    // 很可能有U盘或移动硬盘
}
2. 更进一步：确认是否真的是Mass Storage设备
只看PORTSC只能知道“有设备连上端口”，但不能区分是U盘、键盘还是充电器。
要确认是USB Mass Storage，需要：
	1	完成端口reset → 设备进入Default状态
	2	执行Enable Slot 命令 → 分配slot
	3	执行Address Device 命令 → 分配设备地址
	4	执行Get Descriptor（Device Descriptor） → 读 VID/PID/Class
	•	bDeviceClass = 0x00, bDeviceSubClass = 0x00, bDeviceProtocol = 0x00
	•	接口描述符中 bInterfaceClass = 0x08（MSC），bInterfaceSubClass = 0x06（SCSI透明），bInterfaceProtocol = 0x50（Bulk-Only）或0x62（UAS）

这些操作需要写命令环（Command Ring）、推门铃（Doorbell）、等待Event Ring出完成事件。
这已经是完整xHCI驱动的一部分了。
3. 快速判断“存储设备是否可用”的实用近似方法
在大多数自制内核/调试场景中，人们常用以下组合来粗略判断：
	•	PORTSC bit 0 == 1（connected）
	•	成功完成 Address Device（命令完成码 SUCCESS）
	•	Slot Context 数据结构中 USB Device Address 非0
	•	Endpoint 0 的上下文有效
	•	能成功发出 Get Max LUN 或 Inquiry SCSI命令（Bulk endpoint）
如果上面几步都成功，基本可以认为“U盘可用。&nbsp;&nbsp;&nbsp;&nbsp;<a href=./usb_mmio.php#res00>返回顶部</a><br>";
echo "<a name=res04><font size=4 color=red>MMIO与USB存储读取</font></a>
通过 MMIO 直接访问 USB 存储设备上指定位置的数据，在绝大多数实际场景下是做不到的，也不是正常的设计路径。原因非常简单：
<center><table border=1 width=80%><tr><td width=25%>
设备类型</td><td width=25%>是否有 MMIO 寄存器空间</td><td width=25%>数据存储区是否能通过 MMIO 直接访问</td><td width=25%>访问数据块的正确方式</td></tr><tr><td width=25%>
USB 闪存盘/U盘</td><td width=25%>有（USB 控制器寄存器）</td><td width=25%>否</td><td width=25%>SCSI 命令（CBW + Data + CSW）</td></tr><tr><td width=25%>
SATA 硬盘</td><td width=25%>有（AHCI 寄存器）</td><td width=25%>否（数据在 HBA 的 DMA 缓冲区）</td><td width=25%>AHCI 命令槽 + PRDT</td></tr><tr><td width=25%>
NVMe SSD</td><td width=25%>有（Doorbell + 提交队列）</td><td width=25%>部分可以（但仍需队列机制）</td><td width=25%>提交队列 + 完成队列</td></tr><tr><td width=25%>
PCIe 直连 SRAM/DRAM 设备</td><td width=25%>有</td><td width=25%>可以</td><td width=25%>直接读写映射地址</td></tr></table></center>

USB Mass Storage 的真实访问路径（Bulk-Only Transport / BOT）
USB 大容量存储类（Mass Storage Class）本质上是把 SCSI 命令封装在 USB Bulk 传输 中，而不是把数据直接映射成内存。
典型流程（读第 N 个 sector 为例）：
	1	主机发送 Command Block Wrapper (CBW)  
	•	里面包含 SCSI 命令：READ(10) 或 READ(16)  
	•	关键字段：LBA（逻辑块地址）= 你想要的扇区号  
	•	传输方向 = Device → Host  
	•	期望传输长度 = 512 × 要读的扇区数
	2	设备（U盘控制器）收到后执行读取
→ 从 NAND Flash 读出对应数据（可能经过 FTL 映射）
	3	设备通过 Bulk IN 端点把数据发回主机
	4	最后设备发送 Command Status Wrapper (CSW)  
	•	表示成功/失败
整个过程没有“把 U 盘的第 N 个扇区映射到某个物理地址 0xXXXX_XXXX 然后直接 mov eax,[0xXXXX_XXXX]”这种操作。
那有没有极少数情况能通过 MMIO 访问 USB 存储数据？
极少数、非常特殊的场景（基本都不常见）：
<center><table border=1 width=80%><tr><td width=40%>
场景</td><td width=30%>是否能通过 MMIO 直接读数据块</td><td width=30%>备注</td></tr><tr><td width=40%>
某些老旧的 USB-to-IDE 桥接芯片</td><td width=30%>极少数可以（非常 hack）</td><td width=30%>基本已淘汰，寄存器极不标准</td></tr><tr><td width=40%>
某些工业级 USB NAND 控制器</td><td width=30%>有可能有内部缓冲区映射</td><td width=30%>厂商私有，非标准，基本不开源</td></tr><tr><td width=40%>
某些调试/旁路模式芯片</td><td width=30%>有（例如某些 FX3/FX5 的特殊模式）</td><td width=30%>不是正常 Mass Storage 模式</td></tr><tr><td width=40%>
USB 设备做成 PCIe 设备（USB4）</td><td width=30%>理论上可能，但实际几乎没有</td><td width=30%>协议完全不同</td></tr></table></center>

正常/推荐的几种访问方式对比（按性能/通用性排序）
<center><table border=1 width=80%><tr><td 20%>
方式</td><td width=20%>是否用 MMIO 访问数据</td><td width=20%>通用性</td><td width=20%>性能</td><td width=20%>使用场景</td></tr><tr><td width=20%>
标准 SCSI over USB BOT/UAS</td><td width=20%>否</td><td width=20%>★★★★★</td><td width=20%>中～高</td><td width=20%>99% 的情况</td></tr><tr><td width=20%>
直接 DMA 到系统内存（UASP）</td><td width=20%>否（但用 DMA）</td><td width=20%>★★★★</td><td width=20%>高</td><td width=20%>现代系统 + 支持 UAS 的 U 盘</td></tr><tr><td width=20%>
通过块设备层（/dev/sda）</td><td width=20%>否</td><td width=20%>★★★★★</td><td width=20%>中～高</td><td width=20%>用户态程序最常用</td></tr><tr><td width=20%>
直接发送 Raw SCSI 命令</td><td width=20%>否</td><td width=20%>★★★</td><td width=20%>中</td><td width=20%>sg3_utils、自定义驱动</td></tr><tr><td width=20%>
内存映射方式（mmap）</td><td width=20%>否</td><td width=20%>★★</td><td width=20%>中</td><td width=20%>几乎不可能用于 U 盘</td></tr></table></center>

总结一句话回答你的问题
普通 USB 存储设备（U盘、移动硬盘）的数据区不能通过 MMIO 直接访问指定位置。
必须通过 USB 协议栈 → Bulk 端点 → CBW → SCSI READ → 数据 IN → CSW 这一整套流程来读取。
如果你看到的某些文档/代码里出现“MMIO 访问 USB 设备”，通常指的是：
	•	访问 USB 主机控制器（xHCI、DWC3、Muse 等）的寄存器
	•	访问 USB 设备控制器（当你的 SoC 做 Device 端时）的寄存器
而不是访问 U 盘内部第 N 个 sector 的内容。
如果你确实有非常特殊的硬件（比如某个厂商自定义的 USB 桥接芯片把数据区映射出来了），请提供具体芯片型号，我可以帮你再深入查一下是否有这种非标玩法&nbsp;&nbsp;&nbsp;&nbsp;<a href=./usb_mmio.php#res00>返回顶部</a><br><br>";
echo "<a name=res05><font size=4 color=red>SCSI（Small Computer System Interface）</font></a>
SCSI（Small Computer System Interface）命令是现代块设备（U盘、移动硬盘、SSD、机械硬盘等）最核心的指令集。
在 USB 存储设备上，SCSI 命令并不是直接通过 USB 裸发，而是被封装在 USB Mass Storage Class Bulk-Only Transport（简称 BOT） 协议中。
BOT 协议的三大阶段（一次完整命令的典型流程）
<center><table border=1 width=80%><tr><td width=25%>
阶段</td><td width=15%>方向</td><td width=15%>内容</td><td width=15%>大小</td><td width=15%>端点</td><td width=15%>说明</td></tr><tr><td width=25%>
Command</td><td width=15%>Host → Device</td><td width=15%>CBW (Command Block Wrapper)</td><td width=15%>固定 31 字节</td><td width=15%>Bulk OUT</td><td width=15%>包含 SCSI 命令本身 + 元信息</td></tr><tr><td width=25%>
Data</td><td width=15%>双向</td><td width=15%>实际读/写的数据</td><td width=15%>可变（0~数 MB）</td><td width=15%>Bulk IN/OUT</td><td width=15%>无数据命令可跳过此阶段</td></tr><tr><td width=25%>
Status</td><td width=15%>Device → Host</td><td width=15%>CSW (Command Status Wrapper)</td><td width=15%>固定 13 字节</td><td width=15%>Bulk IN</td><td width=15%>报告成功/失败 + 残余字节数</td></tr></table></center>

CBW（Command Block Wrapper）结构 — 31 字节
这是 USB Mass Storage 最关键的封装结构，几乎所有 U 盘/移动硬盘都必须支持。
<center><table border=1 width=80%><tr><td width=20%>
偏移</td><td width=25%>字段名</td><td width=20%>大小</td><td width=35%>说明</td></tr><tr><td width=20%>
0</td><td width=25%>dCBWSignature</td><td width=20%>4</td><td width=35%>固定签名，必须是 0x43425355（\"USBC\" 小端序）</td></tr><tr><td width=20%>
4</td><td width=25%>dCBWTag</td><td width=20%>4</td><td width=35%>主机自己定义的 tag，用于匹配 CSW 中的 dCSWTag</td></tr><tr><td width=20%>
8</td><td width=25%>dCBWDataTransferLength</td><td width=20%>4</td><td width=35%>期望的数据阶段传输字节数（大端序）</td></tr><tr><td width=20%>
12</td><td width=25%>bmCBWFlags</td><td width=20%>1</td><td width=35%>bit7 = 1 表示数据从 Device → Host（读），0 表示 Host → Device（写）</td></tr><tr><td width=20%>
13</td><td width=25%>bCBWLUN</td><td width=20%>1</td><td width=35%>逻辑单元号（LUN），普通 U 盘通常填 0</td></tr><tr><td width=20%>
14</td><td width=25%>bCBWCBLength</td><td width=20%>1</td><td width=35%>SCSI 命令本身长度（通常 6/10/12/16 字节，最常见 10 字节 → 填 10）</td></tr><tr><td width=20%>
15~30</td><td width=25%>CBWCB</td><td width=20%>16</td><td width=35%>实际的 SCSI CDB（Command Descriptor Block），多余字节填 0</td></tr></table></center>

最常用的 SCSI 读写命令（CDB 格式）
1. READ(10) — 操作码 0x28（最常用读命令）
<center><table border=1 width=80%><tr><td width=34%>
字节</td><td width=33%>内容</td><td width=33%>说明</td></tr><tr><td width=34%>	
0</td><td width=33%>Operation Code</td><td width=33%>0x28</td></tr><tr><td width=34%>
1</td><td width=33%>(Reserved / Flags)</td><td width=33%>通常 0（bit0=RelAdr 已废弃，bit1=FUA 等）</td></tr><tr><td width=34%>
2~5</td><td width=33%>Logical Block Address</td><td width=33%>LBA（起始逻辑块地址，大端序 32 位）</td></tr><tr><td width=34%>
6</td><td width=33%>(Reserved)</td><td width=33%>0</td></tr><tr><td width=34%>
7~8</td><td width=33%>Transfer Length</td><td width=33%>要读的块数（sector 数，大端序 16 位，最大 0xFFFF = 65535 个 sector）</td></tr><tr><td width=34%>
9</td><td width=33%>Control</td><td width=33%>通常 0（集团/链接/ACA 等高级功能基本不用）</td></tr></table></center>

示例：读取从 LBA 100 开始的 8 个 sector（4KB，假设 512B/sector）
CDB = [0x28, 0x00, 0x00, 0x00, 0x00, 0x64, 0x00, 0x00, 0x08, 0x00]
2. READ(16) — 操作码 0x88（大容量设备常用）
用于超过 2TB 或需要 >65535 块的传输。
<center><table border=1 width=80%><tr><td width=20%>
字节</td><td width=40%>内容</td><td width=40%>说明</td></tr><tr><td width=20%>
0</td><td width=40%>0x88</td><td width=40%>--</td></tr><tr><td width=20%>
1</td><td width=40%>Flags (FUA, etc.)</td><td width=40%>--</td></tr><tr><td width=20%>
2~9</td><td width=40%>LBA 64 位 大端序</td><td width=40%>--</td></tr><tr><td width=20%>
10~13</td><td width=40%>Transfer Length 32 位 大端序（可达 4GB 块）</td><td width=40%>--</td></tr><tr><td width=20%>
14~15</td><td width=40%>(Reserved / Group number)</td><td width=40%>通常 0</td></tr></table></center>
（总共 16 字节）
3. WRITE(10) — 操作码 0x2A
结构与 READ(10) 几乎一样，只是 opcode 不同。
<center><table border=1 width=80%><tr><td width=50%>
字节</td><td width=50%>内容</td></tr><tr><td width=50%>
0</td><td width=50%>0x2A</td></tr><tr><td width=50%>
1~9</td><td width=50%>同 READ(10)</td></tr></table></center>
4. 其他初始化阶段常用命令
<center><table border=1 width=80%><tr><td width=20%>
Opcode</td><td width=20%>命令名</td><td width=20%>主要作用</td><td width=20%>CDB 长度</td><td width=20%>是否必须</td></tr><tr><td width=20%>
0x12</td><td width=20%>INQUIRY</td><td width=20%>查询设备厂商、型号、版本等</td><td width=20%>6</td><td width=20%>必须</td></tr><tr><td width=20%>
0x25</td><td width=20%>READ CAPACITY (10)</td><td width=20%>获取总容量（最后一个 LBA + 1）</td><td width=20%>10</td><td width=20%>必须</td></tr><tr><td width=20%>
0x9E</td><td width=20%>READ CAPACITY (16)</td><td width=20%>用于 >2TB 设备</td><td width=20%>16</td><td width=20%>推荐</td></tr><tr><td width=20%>
0x00</td><td width=20%>TEST UNIT READY</td><td width=20%>检查设备是否就绪（无数据阶段）</td><td width=20%>6</td><td width=20%>常用</td></tr><tr><td width=20%>
0x1B</td><td width=20%>START STOP UNIT</td><td width=20%>加载/弹出介质（光驱等）</td><td width=20%>10</td><td width=20%>视情况</td></tr></table></center>

CSW（Command Status Wrapper） — 13 字节
<center><table border=1 width=80%><tr><td width=20%>
偏移</td><td width=40%>字段</td><td width=40%>说明</td></tr><tr><td width=20%>
0~3</td><td width=40%>dCSWSignature</td><td width=40%>固定 0x53425355（\"USBS\" 小端）</td></tr><tr><td width=20%>
4~7</td><td width=40%>dCSWTag</td><td width=40%>必须等于对应 CBW 的 dCBWTag</td></tr><tr><td width=20%>
8~11</td><td width=40%>dCSWDataResidue</td><td width=40%>实际传输字节数与期望的差值（正常应为 0）</td></tr><tr><td width=20%>
12</td><td width=40%>bCSWStatus</td><td width=40%>0 = 成功，1 = 失败，2 = Phase Error</td></tr></table></center>

快速记忆口诀
	•	CBW：31 字节封装 → USBC + tag + 期望长度 + 方向 + LUN + CDB长度 + CDB
	•	读：0x28（10 字节版）或 0x88（16 字节版）
	•	写：0x2A（10 字节版）或 0x8A（16 字节版）
	•	顺序：CBW → (数据) → CSW，缺一不可
	•	方向：bmCBWFlags bit7=1 表示读（Device→Host）&nbsp;&nbsp;&nbsp;&nbsp;<a href=./usb_mmio.php#res00>返回顶部</a><br>";
echo "<font color=red size=4><a name=res06>典型 USB Mass Storage BOT 协议流程示例(一个完整的读 4KB 的流程)</a></font>
典型 USB Mass Storage BOT 协议流程示例
以下是一个完整的读 4KB 数据（假设 sector 大小 = 512 字节）的典型 USB Mass Storage BOT 协议流程示例。
我们读取从 LBA = 0x1234（十进制 4660）开始的 8 个 sector（8 × 512 = 4096 字节 = 4 KiB）。
1. 主机 → 设备：发送 CBW（Bulk OUT 端点）
CBW 总长度固定 31 字节，结构如下（十六进制表示，小端序字段已按规范处理）：
dCBWSignature       : 55 53 42 43          (\"USBC\" 小端)
dCBWTag             : 12 34 56 78          （主机随意选的 tag，例如这里用 0x12345678）
dCBWDataTransferLength : 00 10 00 00     （4096 = 0x1000，小端序）
bmCBWFlags          : 80                   （bit7=1 → Device → Host，即读方向）
bCBWLUN             : 00                   （LUN=0，最常见）
bCBWCBLength        : 0A                   （CDB 长度=10 字节）
CBWCB (SCSI READ(10) CDB 10 字节)：
  28 00                （opcode 0x28 + 保留字节通常 0x00）
  00 00 12 34          （LBA = 0x00001234，大端序）
  00                   （Group Number + 保留，通常 0）
  00 08                （Transfer Length = 8 sectors，大端序）
  00                   （Control，通常 0）
完整 31 字节 CBW（十六进制）：

55 53 42 43  12 34 56 78  00 10 00 00  80 00 0A 00
28 00 00 00  12 34 00 00  08 00
（后面 6 字节补 0，因为 CBWCB 固定占 16 字节位置，但只用前 10 字节）
2. 设备收到 CBW 后解析
	•	确认签名是 \"USBC\"
	•	看到方向是读（0x80），数据长度 0x1000
	•	看到 opcode = 0x28 → READ(10)
	•	提取 LBA = 0x00001234
	•	提取块数 = 8
	•	设备从 Flash / 介质读取 4096 字节数据（内部经过 FTL 地址映射）
3. 设备 → 主机：发送 4096 字节数据（Bulk IN 端点）
设备把刚刚读出的 4096 字节原始数据通过 Bulk IN 端点发回。
数据内容取决于 U 盘里第 0x1234 ~ 0x123B 这 8 个 sector 实际存了什么（通常是文件系统数据、FAT 表、用户文件片段等）。
4. 设备 → 主机：发送 CSW（Bulk IN 端点）
CSW 固定 13 字节：
dCSWSignature    : 55 53 42 53          (\"USBS\" 小端)
dCSWTag          : 12 34 56 78          （必须和 CBW 的 tag 一样）
dCSWDataResidue  : 00 00 00 00          （残余字节数=0 表示全部传输完成）
bCSWStatus       : 00                   （0 = Command Passed，成功）
完整 CSW 示例（成功情况）：
55 53 42 53  12 34 56 78  00 00 00 00  00
如果失败（例如 LBA 超范围、介质错误等），bCSWStatus 会变成 0x01，dCSWDataResidue 可能非 0。
完整流程总结（时序顺序）
	1	主机发送 31 字节 CBW（Bulk OUT）
	2	设备执行读取 → 准备 4096 字节数据
	3	设备发送 4096 字节数据（Bulk IN，可能分多个 USB 包）
	4	设备发送 13 字节 CSW（Bulk IN）
主机收到 CSW 后检查：
	•	signature 是否 \"USBS\"
	•	tag 是否匹配
	•	status 是否 0
	•	residue 是否 0
全部通过 → 这次 4KB 读取成功。
常见变体说明
	•	如果要读更大块（>64KB），很多设备支持 READ(16) opcode 0x88，LBA 用 64 位，Transfer Length 用 32 位。
	•	如果设备支持 UAS（USB Attached SCSI），则不用 CBW/CSW，而是用更高效的队列 + 信息单元（Information Unit）。
	•	实际抓包（Wireshark + usbmon / USBlyzer）看到的往往是分包的 Bulk 传输，但逻辑上就是上面这个顺序。&nbsp;&nbsp;&nbsp;&nbsp;<a href=./usb_mmio.php#res00>返回顶部</a><br>";
echo "<font color=red size=4><a name=res07>USB Bulk Endpoint,Bulk端点</a></font>
USB Bulk 端口（更准确地说是 Bulk Endpoint，Bulk 端点）是 USB 协议中最常用的一种数据传输端点类型，专门用于传输大块、非实时、但必须可靠的数据。
它在 U 盘、移动硬盘、打印机、扫描仪、摄像头（部分 MJPEG 模式）等设备上几乎是标配。
1. Bulk Endpoint 的核心特点（与其它类型对比）
<center><table border=1 width=80%><tr><td width=10%>
传输类型</td><td width=15%>方向</td><td width=15%>带宽保证</td><td width=15%>延迟保证</td><td width=15%>数据可靠性</td><td width=15%>典型最大包大小</td><td width=15%>典型应用场景</td></tr><tr><td width=10%>
Control</td><td width=15%>双向</td><td width=15%>无</td><td width=15%>无</td><td width=15%>最高</td><td width=15%>8/64/512 字节</td><td width=15%>枚举、配置、少量命令</td></tr><tr><td width=10%>
Interrupt</td><td width=15%>IN 为主</td><td width=15%>有（轮询）</td><td width=15%>有界</td><td width=15%>高</td><td width=15%>64（FS）/1024（HS/SS）</td><td width=15%>鼠标、键盘、游戏手柄</td></tr><tr><td width=10%>
Isochronous</td><td width=15%>双向</td><td width=15%>有（固定）</td><td width=15%>最低</td><td width=15%>无（可丢包）</td><td width=15%>1024（HS）/1024（SS）</td><td width=15%>音频、视频流（实时）</td></tr><tr><td width=10%>
Bulk</td><td width=15%>单向（IN 或 OUT）</td><td width=15%>无</td><td width=15%>无（可无限等待）</td><td width=15%>高（重传机制）</td><td width=15%>FS:64 / HS:512 / SS:1024</td><td width=15%>U盘读写、打印机、扫描仪</td></tr></table></center>

Bulk 的关键口诀：
“大块数据 → 尽力而为 → 必须送到 → 可以等”
2. Bulk IN vs Bulk OUT
	•	Bulk IN Endpoint（设备 → 主机）
设备有数据要发给主机时使用（如 U 盘读数据、扫描仪扫描结果）。
主机主动发 IN Token，设备才能发送数据。
	•	Bulk OUT Endpoint（主机 → 设备）
主机要把数据写入设备时使用（如 U 盘写文件、打印机打印任务）。
主机直接发 OUT Token + 数据包。
大多数 Mass Storage 类设备（如 U 盘）至少有两个 Bulk 端点：
	•	一个 Bulk OUT：接收 CBW（命令）和写数据
	•	一个 Bulk IN：发送读出的数据 + CSW（状态）
3. Bulk 传输的实际行为
	•	无带宽预留：总线空闲时 Bulk 传输最快（可抢占几乎全部带宽）；总线忙时（如同时有音频/视频流）Bulk 会饿死很久。
	•	错误重传：硬件自动 CRC 校验 + NAK/ACK 握手 + 有限次重试 → 数据最终一定会到达（除非设备断开）。
	•	包大小限制（wMaxPacketSize）：
	•	USB 2.0 Full Speed：最大 64 字节
	•	USB 2.0 High Speed：最大 512 字节
	•	USB 3.x SuperSpeed：最大 1024 字节
	•	多包传输：一次 Bulk 传输可以跨越多个 USB 包，直到达到请求长度或发送短包（short packet）表示结束。
4. Bulk 在 USB Mass Storage 中的典型用法（结合之前例子）
在 BOT 协议中：
	•	CBW → 通过 Bulk OUT 端点发送（31 字节）
	•	数据阶段（读）→ 通过 Bulk IN 端点返回（例如 4096 字节）
	•	CSW → 通过 Bulk IN 端点发送（13 字节）
UASP（USB Attached SCSI Protocol，USB 3.0+ 常用）更进一步，使用 Bulk Streams（USB 3.0 引入），同一个 Bulk 端点可以复用多个 Stream ID，实现命令队列并发，大幅提升随机读写性能。
5. 总结一句话
USB Bulk 端口（Bulk Endpoint）是 USB 上专门用来“搬砖”的大容量可靠通道：它不保证速度和延迟，但保证数据最终完整无误地到达，非常适合文件读写、打印、扫描等“尽力而为但不能丢数据”的场景。
几乎所有 U 盘/移动硬盘的高吞吐量数据通道都是靠 Bulk IN/OUT 端点实现的。&nbsp;&nbsp;&nbsp;&nbsp;<a href=./usb_mmio.php#res00>返回顶部</a><br>";
echo "<font color=red size=4><a name=res08>Bulk IN / OUT 在 MMIO 中的位置</a></font>
Bulk IN / OUT 在 MMIO 中的位置，指的是现代 USB 主机控制器（最常见的是 xHCI，即 USB 3.0+ 的 Extensible Host Controller Interface）中，与 Bulk 端点相关的寄存器/结构并不直接有一个固定的“Bulk IN 
寄存器地址 = 0xXXXX 或“Bulk OUT 寄存器地址 = 0xYYYY。
xHCI 采用高度间接的架构：Bulk 传输的控制和数据路径不通过 MMIO 寄存器直接读写数据，而是通过内存中的环形队列（Transfer Ring） + Doorbell 寄存器 来触发硬件。
下面是实际在 MMIO 空间中与 Bulk IN/OUT 最相关的关键位置（以 xHCI 为例，地址都是相对基地址的偏移）：
xHCI MMIO 整体布局（典型偏移，基于 Intel/AMD/大多数 SoC 的实现）
<center><table border=1 width=80%><tr><td width=20%>
部分</td><td width=20%>典型相对偏移范围</td><td width=20%>如何计算基地址</td><td width=40%>与 Bulk IN/OUT 的关系</td></tr><tr><td width=20%>
Capability Registers</td><td width=20%>0x0000 ~ CAPLENGTH-1</td><td width=20%>BAR0（或类似） + 0</td><td width=40%>读取能力参数，包括最大端点数、是否支持 Streams 等，但不直接控制 Bulk</td></tr><tr><td width=20%>
Operational Registers</td><td width=20%>CAPLENGTH ~ DBOFF-1</td><td width=20%>BAR0 + CAPLENGTH</td><td width=40%>全局控制（如 USBCMD、USBSTS、DCBAAP、CONFIG），配置所有端点共用</td></tr><tr><td width=20%>
Doorbell Registers</td><td width=20%>DBOFF ~ RTSOFF-1</td><td width=20%>BAR0 + DBOFF</td><td width=40%>最关键：每个端点（包括所有 Bulk IN/OUT）都有一个 doorbell 寄存器，写它来“敲门”触发传输</td></tr><tr><td width=20%>
Runtime Registers</td><td width=20%>RTSOFF ~ 扩展能力前</td><td width=20%>BAR0 + RTSOFF</td><td width=40%>中断、事件环、端口状态等，Bulk 完成事件会在这里报告</td></tr><tr><td width=20%>
Extended Capabilities</td><td width=20%>通常在更高地址</td><td width=20%>从 HCCPARAMS1 等读取指针</td><td width=40%>调试、虚拟化等，非必须</td></tr></table></center>
Bulk IN / OUT 最直接相关的 MMIO 位置：Doorbell Registers
	•	Doorbell 寄存器 是 xHCI 中唯一“每个端点一个”的 MMIO 寄存器。
	•	每个 USB 设备（slot）上的每个端点（endpoint context）对应一个 doorbell。
	•	Bulk IN 和 Bulk OUT 各自有独立的 doorbell（因为它们是不同的端点号）。
计算方式（非常重要）：
	1	从 Capability 寄存器读取 DBOFF（Doorbell Offset，通常在偏移 0x14 处，4 字节值）。
	•	实际 doorbell 基地址 = BAR0（PCI BAR0 的 MMIO 基址） + DBOFF
	2	每个 doorbell 占 4 字节，编号从 0 开始：
	•	Doorbell[0]：用于 Command Ring（命令环，全局用）
	•	Doorbell[1 ~ MaxSlots]：对应 Slot 1 ~ Max 的端点 1（通常是控制端点 OUT）
	•	后续端点 doorbell 按 endpoint ID × slot 排列，但实际是线性编号。
	3	规范公式（简化版）：
Doorbell address for endpoint context N (1-based) on slot S (1-based)
	4	= BAR0 + DBOFF + (endpoint index × 4)
endpoint index 通常是：
	•	控制 OUT：1
	•	控制 IN：2（如果有）
	•	Bulk OUT：3 或 4（常见）
	•	Bulk IN：4 或 5（常见）
	5	实际例子（假设 DBOFF = 0x1000，某个 U 盘的 Bulk OUT 是 endpoint 3，slot 1）：
	•	Bulk OUT doorbell ≈ BAR0 + 0x1000 + (3 × 4) = BAR0 + 0x100C
	6	写 doorbell 的值（低 16 位通常是 stream ID，高位是 doorbell target，通常写 0 或 stream ID）来通知硬件：“这个端点有新的 TRB（Transfer Request Block）可以处理了”。
Bulk 数据本身在哪里？
	•	不在 MMIO 里！
Bulk IN/OUT 的实际数据 通过 DMA 搬到/从系统内存（物理地址由 Transfer Ring 中的 TRB 描述）。
	•	MMIO 只用来：
	•	配置端点上下文（Endpoint Context，在 Device Context 里，内存中）
	•	提交命令（写 Doorbell）
	•	接收完成事件（Event Ring，在 Runtime 寄存器指向的内存中）
总结：Bulk IN/OUT 在 MMIO 中的“位置一览
<center><table border=1 width=80%><tr><td width=25%>
位置类型</td><td width=25%>是否存在固定 MMIO 地址</td><td width=25%>实际位置计算方式</td><td width=25%>作用（对 Bulk 的意义）</td></tr><tr><td width=25%>
专用 Bulk 寄存器</td><td width=25%>不存在</td><td width=25%>	—</td><td width=25%>xHCI 没有 per-Bulk 专用寄存器</td></tr><tr><td width=25%>
Doorbell</td><td width=25%>存在（每个端点一个）</td><td width=25%>BAR + DBOFF + (endpoint_index × 4)</td><td width=25%>触发 Bulk 传输的最关键 MMIO 写操作</td></tr><tr><td width=25%>
Operational regs</td><td width=25%>存在（全局）</td><td width=25%>BAR + CAPLENGTH</td><td width=25%>启用/复位控制器，影响所有 Bulk</td></tr><tr><td width=25%>
Runtime regs</td><td width=25%>存在</td><td width=25%>BAR + RTSOFF</td><td width=25%>处理 Bulk 完成中断/事件</td></tr></table></center>

一句话结论：
在 xHCI（现代 USB 控制器）中，Bulk IN 和 Bulk OUT 没有专属的 MMIO 寄存器来直接读写数据。它们通过内存中的 Transfer Ring + Doorbell 寄存器（MMIO 中唯一 per-endpoint 的地方）来驱动。
Doorbell 是你能通过 MMIO “直接碰到的与特定 Bulk 端点最接近的东西。
如果你在调试某个具体 SoC（如 Rockchip、Allwinner、NXP i.MX、AMD/Intel xHCI），可以告诉我芯片型号，我可以帮你找更精确的偏移或寄存器名。&nbsp;&nbsp;&nbsp;&nbsp;<a href=./usb_mmio.php#res00>返回顶部</a><br>";
echo "<font color=red size=4><a name=res09>xHCI MMIO 空间的简化内存布局图</a></font>
以下是针对 xHCI MMIO 空间的简化内存布局图（文本艺术形式）和一段实用的 C 伪代码 示例，用于读取主要 Capability 和 Operational 寄存器。
xHCI MMIO 简化布局图（从 BAR0 基地址开始）
BAR0 基地址 (PCI BAR0 映射的物理地址)

│
├─ 0x0000 ────────────────────────────────┐
│   Capability Registers                  │
│   ├─ 0x00     CAPLENGTH  (8-bit)        │ ← 告诉我们 Operational Registers 从哪里开始
│   ├─ 0x02     HCIVERSION (16-bit)       │    通常 0x20 ~ 0x40 之间
│   ├─ 0x04     HCSPARAMS1                │
│   ├─ 0x08     HCSPARAMS2                │
│   ├─ 0x0C     HCSPARAMS3                │
│   ├─ 0x10     HCCPARAMS1                │ ← 包含 64-bit 支持 + Extended Caps Pointer
│   ├─ 0x14     DBOFF  (Doorbell offset)  │
│   └─ 0x18     RTSOFF (Runtime offset)   │
│                                         │
│   (长度由 CAPLENGTH 决定，通常 ~0x20~0x40 字节)
│
├─ Operational Registers 开始位置
│   │   (基址 = BAR0 + CAPLENGTH)
│   ├─ 0x00   USBCMD
│   ├─ 0x04   USBSTS
│   ├─ 0x08   PAGESIZE
│   ├─ 0x18   DNCTRL
│   ├─ 0x20   CRCR          (64-bit, Command Ring Control)
│   ├─ 0x30   DCBAAP        (64-bit, Device Context Base Array Pointer)
│   └─ 0x38   CONFIG
│       ...
│   └─ 0x400+ PORTSC[1]、PORTSC[2] ... (每个端口 0x10 字节间隔)
│
├─ Doorbell Array 开始位置
│   │   (基址 = BAR0 + DBOFF，通常在 0x1000 左右)
│   ├─ 0x00   保留
│   ├─ 0x04   Slot 1 Doorbell
│   ├─ 0x08   Slot 2 Doorbell
│   └─ ...    最多 255 个 doorbell (每个 4 字节)
│
└─ Runtime Registers 开始位置
    │   (基址 = BAR0 + RTSOFF，通常较大偏移)
    ├─ 0x00   MFINDEX
    ├─ 0x20   Interrupter 0 组 (IMAN, IMOD, ERSTSZ, ERSTBA, ERDP ...)
    └─ 0x40+  Interrupter 1、2... (每个中断器 0x20 字节)

Extended Capabilities (链表)
    从 HCCPARAMS1[31:16] << 2 开始
    链表形式：Capability Header → Next Pointer → Data → ...
这个图是高度简化的，实际大小和偏移因控制器实现而异，但结构是标准的。
C 伪代码：读取 xHCI 主要寄存器（裸机/早期 bootloader 风格）
#include <stdint.h>
// 假设你已经通过 PCI 枚举获得了 BAR0 的虚拟/物理映射地址
// 这里用 uintptr_t 表示映射后的地址（内核中可能是 ioremap，裸机可能是直接物理地址）
uintptr_t xhci_base;   // BAR0 映射基地址，例如 0xF0000000 或 ioremap 返回值
// 辅助宏：读 32 位 / 64 位寄存器（注意：实际要确保 non-cacheable 访问）
#define REG32(addr)     (*(volatile uint32_t *)(addr))
#define REG64(addr)     (*(volatile uint64_t *)(addr))
void dump_xhci_registers(void) {
    uint32_t caplength;
    uintptr_t op_base;          // Operational Registers 基址
    uintptr_t db_base;          // Doorbell 基址
    uintptr_t runtime_base;     // Runtime 基址
    uint32_t hcsparams1;
    uint32_t hccparams1;
    uint32_t db_offset;
    uint32_t rtsoff;
    // 1. 读取 CAPLENGTH（8位，低字节）
    caplength = REG32(xhci_base + 0x00) & 0xFF;
    // 2. Operational Registers 起始位置
    op_base = xhci_base + caplength;
    // 3. 读取几个关键能力参数
    hcsparams1 = REG32(xhci_base + 0x04);
    uint8_t max_slots     = (hcsparams1 >> 0)  & 0xFF;
    uint8_t max_intr      = (hcsparams1 >> 8)  & 0x7FF;
    uint8_t max_ports     = (hcsparams1 >> 24) & 0xFF;
    hccparams1 = REG32(xhci_base + 0x10);
    uint32_t xecp = (hccparams1 >> 16) & 0xFFFF;   // Extended Capabilities 指针（DWORD 单位）
    // 4. Doorbell 和 Runtime 偏移
    db_offset  = REG32(xhci_base + 0x14) & ~0x3;   // 低2位保留
    rtsoff     = REG32(xhci_base + 0x18) & ~0x1F;  // 低5位保留
    db_base     = xhci_base + db_offset;
    runtime_base = xhci_base + rtsoff;
    // 5. 打印一些关键信息（调试输出）
    // printf 或你的串口输出函数
    serial_print(\"xHCI Base:      %p\\n\", xhci_base);
    serial_print(\"CAPLENGTH:      0x%02x → Op base at +0x%02x\\n\", caplength, caplength);
    serial_print(\"Max Slots:      %u\\n\", max_slots);
    serial_print(\"Max Interrupters: %u\\n\", max_intr);
    serial_print(\"Max Ports:      %u\\n\", max_ports);
    serial_print(\"Doorbell offset: 0x%x\\n\", db_offset);
    serial_print(\"Runtime offset:  0x%x\\n\", rtsoff);
    serial_print(\"Extended Caps:   +0x%x (DWORD offset)\\n\", xecp << 2);
    // 6. 示例：读取 USBCMD 和 USBSTS（Operational 区）
    uint32_t usbcmd = REG32(op_base + 0x00);
    uint32_t usbsts = REG32(op_base + 0x04);
    serial_print(\"USBCMD:  0x%08x  (Run/Stop=%d, HCRST=%d)\\n\",usbcmd, usbcmd & 1, (usbcmd >> 1) & 1);
    serial_print(\"USBSTS:  0x%08x  (HCHalted=%d, HCE=%d)\\n\",usbsts, usbsts & 1, (usbsts >> 2) & 1);
    // 7. 示例：读取第一个 doorbell（Slot 1）
    uint32_t slot1_db = REG32(db_base + 0x04);
    serial_print(\"Slot1 Doorbell: 0x%08x\\n\", slot1_db);
    // 8. 如果想继续遍历 Extended Capabilities（链表）
    if (xecp != 0) {
        uintptr_t cap_ptr = xhci_base + (xecp << 2);
        uint32_t cap_header = REG32(cap_ptr);
        uint8_t cap_id   = cap_header & 0xFF;
        uint8_t next_ptr = (cap_header >> 8) & 0xFF;
        serial_print(\"First Extended Cap ID: %u, Next: %u DWORDs\\n\", cap_id, next_ptr);
        // 可以 while(next_ptr) 继续遍历链表...
    }
}

注意事项（非常重要）
	•	所有寄存器访问必须使用 volatile（防止编译器优化掉读写）
	•	在多核/现代系统上，外设区应标记为 UC / Strongly Ordered / Device-nGnRnE（非缓存、非可合并）
	•	在内核中使用 ioremap_nocache() 或 ioremap_wc()（取决于架构）
	•	在裸机环境中，确保 MMU/MPU 已正确配置该区域为 Device 内存类型
	•	64 位寄存器（如 CRCR、DCBAAP）要用 64 位读写，且地址必须 8 字节对齐&nbsp;&nbsp;&nbsp;&nbsp;<a href=./usb_mmio.php#res00>返回顶部</a><br>";
echo "<font color=red size=4><a name=res10>MMIO（Memory-Mapped I/O，内存映射输入输出）</a></font>
MMIO（Memory-Mapped I/O，内存映射输入输出） 是系统级硬件编程、嵌入式开发、操作系统驱动开发中最核心的概念之一。几乎所有现代微控制器（ARM、RISC-V、STM32、ESP32）、SoC、
甚至x86平台上的PCIe设备、GPU、网卡等，都通过MMIO来与CPU交互。
下面我从零开始、由浅入深、结合实际代码和图解，给你最详细、最实用的介绍（2026年视角，适用于裸机、RTOS、Linux驱动）。
1. 什么是MMIO？
MMIO 的核心思想是：把外设的寄存器（控制寄存器、状态寄存器、数据寄存器）直接映射到CPU的物理内存地址空间里。
CPU访问这些外设寄存器时，就像读写普通内存（RAM）一样，使用普通的LOAD/STORE指令（ARM里的LDR/STR，x86里的mov），而不是专门的I/O指令。
这和传统“端口映射I/O（Port-Mapped I/O，PMIO）”完全不同。
medium.com
左图：MMIO —— I/O设备地址空间和内存地址空间合二为一（最常见方式）
右图：PMIO（隔离式I/O） —— I/O设备有独立的地址空间，需要in/out指令访问（老式x86常用，现在越来越少）。
2. MMIO的工作原理（内存地址空间分布）
CPU看到的整个地址空间被划分成几大块：
	•	Code / Flash
	•	SRAM（普通内存）
	•	Peripheral（外设区） ← 这就是MMIO区域！
	•	External Device / Vendor Specific
外设区里的每一个地址，都对应芯片内部某个外设的某个寄存器。
下面是典型ARM Cortex-M（STM32、GD32、NXP等）芯片的内存映射图：
microcontrollerslab.com
microcontrollerslab.com
从上图可以清晰看到：
	•	外设区域（Peripheral）通常占用0.5GB~1GB空间
	•	GPIOA、GPIOB、GPIOC… 每个GPIO模块都有固定的基地址（Base Address）
	•	比如STM32F4的GPIOA基地址是 0x4002 0000
	•	每个GPIO模块内又有CRL、CRH、IDR、ODR等寄存器偏移
3. MMIO的编程方式（最重要！）
在C语言里访问MMIO超级简单，但必须用volatile！
c
// 1. 定义外设基地址（芯片手册直接抄）
#define GPIOA_BASE      0x40020000U
#define GPIOA_MODER     (GPIOA_BASE + 0x00U)   // 模式寄存器
// 2. 用指针访问（最常见写法）
volatile uint32_t *pGPIOA_MODER = (volatile uint32_t *)GPIOA_MODER;
// 3. 读写寄存器
*pGPIOA_MODER |= (0x1 << 10);   // 把PA5设置为输出模式
uint32_t status = *pGPIOA_IDR;  // 读取输入数据寄存器
为什么必须加 volatile？
编译器会认为“内存地址的值不会无缘无故变化”，可能把多次读写优化成只读一次或直接删掉。而外设寄存器随时可能被硬件改写（比如串口收到数据、定时器溢出、中断标志位），不加volatile会导致程序完全不工作！
4. MMIO vs PMIO 详细对比
<center><table border=1 width=80%><tr><td width=34%>
项目</td><td width=33%>MMIO（内存映射）</td><td width=33%>PMIO（端口映射）</td></tr><tr><td width=34%>
地址空间</td><td width=33%>与内存共用同一地址空间</td><td width=33%>	独立的I/O端口空间（0~65535）</td></tr><tr><td width=34%>
访问指令</td><td width=33%>普通内存指令（mov/ldr/str）</td><td width=33%>	专用指令（in/out）</td></tr><tr><td width=34%>
地址宽度</td><td width=33%>32位/64位（可达GB级）</td><td width=33%>通常只有16位</td></tr><tr><td width=34%>
编程复杂度</td><td width=33%>极简（指针即可）</td><td width=33%>需要特殊汇编/函数</td></tr><tr><td width=34%>
缓存问题</td><td width=33%>必须把外设区设为non-cacheable</td><td width=33%>天然不缓存</td></tr><tr><td width=34%>
现代使用频率</td><td width=33%>99%的ARM、RISC-V、现代x86</td><td width=33%>老式x86、极少数老芯片</td></tr></table></center>
5. MMIO的优点（为什么大家都爱用）
	•	编程统一：读写外设和读写变量一样
	•	支持任意大小的寄存器（8/16/32/64位）
	•	可以用结构体封装（很多芯片SDK就是这么干的）
	•	支持DMA直接访问外设寄存器
	•	Linux内核的ioremap()、devm_ioremap()就是基于MMIO
6. 注意事项（新手最容易踩的坑）
	1	缓存一致性
外设区一定要配置为 Device / Strongly Ordered / Non-cacheable（ARM里用MPU或MTT设置）。
	2	内存屏障（Memory Barrier）
多核或DMA时必须加 dmb() / dsb() / __dsb(15)，防止CPU重排序。
	3	地址对齐
32位寄存器必须4字节对齐访问，否则HardFault。
	4	位带（Bit-band）（Cortex-M特有）
把外设区的某些位映射到单独的地址，可以原子操作单bit，超级好用。
	5	Linux驱动里的MMIO  c
void __iomem *base = ioremap(0x40020000, 0x1000);
	6	writel(0x1234, base + 0x00);
7. 实际应用场景（你以后会天天用）
	•	STM32/ESP32/GD32裸机驱动（GPIO、UART、I2C、SPI、ADC、TIM）
	•	Linux设备驱动（PCIe网卡、GPU、USB控制器、NAND Flash）
	•	ARM Cortex-A（RK、Allwinner、NXP i.MX）外设驱动
	•	UEFI/BIOS、Bootloader中初始化外设
	•	逆向工程（读写硬件寄存器）
总结一句话：
MMIO = 把硬件寄存器伪装成内存，让你用最简单的指针操作就能控制整个芯片。
这就是为什么嵌入式工程师、Linux驱动工程师、系统程序员必须把MMIO吃透的原因——它是你和硬件对话的“通用语言。&nbsp;&nbsp;&nbsp;&nbsp;<a href=./usb_mmio.php#res00>返回顶部</a>";

echo "</pre>";

?>
