<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style>
  .container {
    width: 100%;
    padding: 10px;
  }
  .text {
    word-wrap: break-word;
  }
</style>
<?php
echo "<table width=100%><tr><td><a href=pcie.php#pcie01>PCIe学习（一）</a></td>
<td><a href=pcie.php#pcie03>PCIe学习（二）</a></td>
<td><a href=pcie.php#pcie04>PCIe学习（三）</a></td>
<td><a href=pcie.php#pcie05>PCIe学习（四）</a></td>
<td><a href=pcie.php#pcie06>PCIe学习（五）</a></td></tr><tr>
<td><a href=pcie.php#pcie07>PCIe学习（六）</a></td>
<td><a href=pcie.php#pcie08>PCIe学习（七）</a></td>
<td><a href=pcie.php#pcie08>PCIe学习（八）</a></td>
<td><a href=pcie.php#pcie09>PCIe学习（九）</a></td></tr></table><br><br>";
echo "<font size=6 color=#ff0000><center><a name=pcie01></a>PCIe学习（一）</center></font><br><br>";
echo "<font size=4 color=black><div class=container><div class=text>前面学习CXL和CCIX的时候，发现协议里面遵循PCIe规范的地方基本一带而过，难免给进一步研究带来不便。

学习PCIe协议，直接看协议规范，会感觉很多地方并没有详细解释，看起来晦涩难懂。无意之中找到了MindShare的一本书，《PCI Express Technology - Comprehensive Guide to Generations 1.x, 2.x, 3.0》。书的作者在Intel工作，我猜测很可能是参与过PCIe协议制定，因此整本书无论是从基础原理，还是行文措辞，对初学者非常友好，建议大家阅读。

本系列的学习笔记主要基于以下部分：上面提到的MindShare书；PCIe协议规范5.0；自己的理解（结合ARM体系）；少量内容参考PCIe协议规范6.0和网络上的他人分享。

1 介绍

PCIe的全称是PCI-Express（Peripheral Component Interconnect Express），是一种高速串行计算机扩展总线标准。

PCI-Express是由英特尔在2001年提出的，旨在替代旧的PCI/PCI-X和AGP总线标准，并称之为第三代I/O总线技术。PCI-Express最初的名称叫“3GIO”，交由PCI-SIG组织后才改名为PCI-Express，简称PCIe，现在由PCI-SIG组织负责PCIe标准的演进。

时至今日，PCIe标准已经推出了7.0版本。为了描述方便，有时用Gen（Generation）来指代PCIe的版本。比如，Gen3是指PCIe第三版的协议标准。PCIe协议规定了最高物理传输速率，新版本需要兼容老版本的速率。
PCIe版本** 	传输速率**

1.0** 	2.5 GT/s

2.0** 	5.0 GT/s

3.0** 	8.0 GT/s

4.0** 	16.0 GT/s

5.0** 	32.0 GT/s

6.0** 	64.0 GT/s

7.0** 	128.0 GT/s

1.1 PCIe链路连接

PCIe组件之间采用的是双向单工（Dual-Simplex）的传输方式。双向指的是在一个物理链接上有收/发两个方向；单工指的是在收或发的物理线路上的数据传输方向是单向的，不可改变。
</div></div>";
echo "<br><center><img src=./pcie_pic/203111149278.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>一对物理连接称为一条Lane。为了增加传输带宽，PCIe允许两个设备间可以由多条Lane连接。通常用xN表示，N为Lane的数量。PCIe支持x1，x2，x4，x8，x12，x16，x32几种链路宽度。目前在实际使用中，x32的情况几乎没有，x12也很少见。</div></div>";
echo "<br><center><img src=./pcie_pic/203116334961.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>PCIe协议不同版本和链路宽度对应的带宽见下表。
					
PCIe版本** 	Lanes**<br>
	x1 	x2 	x4 	x8 	x16<br>
1.0** 	250MB 	500MB/s 	1GB/s 	2GB/s 	4GB/s<br>
2.0** 	500MB/s 	1GB/s 	2GB/s 	4GB/s 	8GB/s<br>
3.0** 	1GB/s 	2GB/s 	4GB/s 	8GB/s 	16GB/s<br>
4.0** 	2GB/s 	4GB/s 	8GB/s 	16GB/s 	32GB/s<br>
5.0** 	4GB/s 	8GB/s 	16GB/s 	32GB/s 	64GB/s<br>
6.0** 	8GB/s 	16GB/s 	32GB/s 	64GB/s 	128GB/s<br>
7.0** 	16GB/s 	32GB/s 	64GB/s 	128GB/s 	256GB/s<br>
需要注意，上表中的带宽是单方向带宽，即Tx或者Rx带宽。有的文献中，在计算PCIe链路带宽时将Tx和Rx加在一起，即上述表中的带宽都乘以2。另外，链路带宽不是有效数据带宽。

PCIe在物理层采用低压差分传输，即一个Tx/Rx对由正负两根传输线（D+，D-）组成。低压差分传输有很强抗干扰性，支持高速远距离传输。</div></div>";
echo "<br><center><img src=./pcie_pic/203144540066.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>1.2 PCIe结构拓扑

PCIe协议的拓扑结构是树状型，组件之间是点到点（Point-to-Point）连接。</div></div>";
echo "<br><center><img src=./pcie_pic/203151649669.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>PCIe组件包括以下几种：
<br>
    Root Complex：简称RC，是PCIe树状拓扑中的根节点，集成在主机SoC<br>
    Endpoints：简称EP，一般指的是PCIe功能设备，比如网卡，显卡等<br>
    Switch：提供扩展或聚合能力，允许更多的设备连接到一个PCIe端口<br>
    Root Complex Event Collector：可以用来处理错误消息和PME消息<br>
    PCI Express to PCI/PCI-X Bridge：PCIe与PCI/PCI-X的转接桥<br>
    1.2.1 Root Complex
<br>
    RC是I/O层次结构的根节点
<br>
    RC可以支持1个或者多个端口（Port），这些端口被称作“根端口（Root Port）”。每个接口定义一个单独的层次域。每个层次域（Hierarchy Domain）可以由单个EP或包含一个或多个Switch和EP的子层次域组成
<br>
    通过RC在层次域之间路由对等事务的能力是可选项，不是必须的
<br>
    RC作为请求者必须支持发起配置请求
<br>
    允许RC作为请求者支持发起I/O请求
<br>
    RC作为完成者不可以支持锁定语义（Lock Semantics）
<br>
    允许RC作为请求者支持发起锁定请求（Locked Request）
<br>
RC作为根节点，是PCIe规范中较为复杂的部分。PCIe规范中并没有明确规定RC的实现方案，也就是说需要结合SoC的实际情况。
<br>
1.2.2 Endpoints
<br>
Endpoint在PCIe树状拓扑结构中承担树叶的角色。
<br>
在PCIe规范中，Endpoint分为三种：遗留或者传统EP（Legacy Endpoint），指的是PCI/PCI-X设备，允许主机继续使用先前的驱动和配置软件；原生EP（Native Endpoint），指的是PCIe设备，不再需要继续支持PCI协议特有的规则；RCiEPs（Root Complex Integrated Endpoints），指的是集成在RC内部的设备。
<br>
之所以保留这些遗留EP，是为了兼容PCI时代的大量设备。这些设备可能会有一些PCI规范特有的特性，比如支持I/O请求，支持锁定语义等，这些特性在原生EP中已经被舍弃。
<br>
关于EP的具体规则比较多，就不列出了，可以参考规范协议。
<br>
1.2.3 Switch
<br>
PCIe是点到点连接，一条链路需要一组端口。如果RC直接连接EP，那么N个EP就需要RC有N组端口，即使考虑到RC可以支持分叉（Bifurcation）功能，这么多组端口的要求也很难满足。RC需要找一个代理人来协助，这就类似封建社会的朝政，皇帝之下有宰相，宰相管理各级官员，各级官员负责具体事务。
<br>
Switch就是负责RC与EP之间的通信桥接，在PCIe树状拓扑结构中承担树枝的角色。简单的PCIe体系可以没有Switch；复杂的PCIe体系可以有很多Switch级联。
<br>
Switch被定义为内部包含多个虚拟PCI-PCI桥接设备的逻辑组件。虚拟PCI-PCI桥上方的总线，叫做Primary Bus，下方的总线叫做Secondary Bus，这几个概念与PCIe枚举过程有关，后文详细介绍。</div></div>";
echo "<br><center><img src=./pcie_pic/203214265381.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>Switch的具体规则如下：
<br>
    Switch呈现给系统配置软件的是两个或者更多的逻辑PCI-PCI桥
<br>
    Switch使用PCI桥接机制转发事务
<br>
    Switch必须可以在任何一组端口之间转发所有类型的TLP
<br>
    Switch必须支持锁定请求。Switch不需要支持下游端口（Downstream Ports）作为锁定请求的启动端口
<br>
    Switch端口必须支持协议规定的“流量控制（Flow Control）”
<br>
    不允许Switch将数据包拆分为更小的数据包
<br>
    当在同一虚拟信道（Virtual Channel）上发生争抢时，Switch的入站端口（Ingress Ports）之间的仲裁可以使用轮循调度（Round Robin）或加权轮循调度（Weighted Round Robin）来实现
<br>
    EP在配置软件中不可以将Switch内部总线视为代表Switch下游端口的虚拟PCI-PCI桥的对等端。
<br>
1.2.4 Root Complex Event Collector
<br>
RC事件收集器是可选项，这是Intel设计中的一个组件，可以用来处理错误消息和PME消息。
1.2.5 PCI Express to PCI/PCI-X Bridge
<br>
PCIe与PCI/PCI-X转接桥提供PCIe体系结构和PCI/PCI-X体系结构之间的连接。随着时间的发展，PCI/PCI-X设备越来越少，这部分会慢慢退出历史舞台。
1.3 PCIe分层概述
<br>
PCIe在体系结构上分为三个独立的层次：
<br>
    事务层（Transaction Layer）：这一层主要负责的事情包括，事务层数据包（Transaction Layer Packet）的生成，也称TLP打包；TLP解析，也称TLP拆包（接收端）；服务质量（QoS）；流量控制（Flow Control）；事务排序（Transaction Ordering），等等<br>
    数据链路层（Data Link Layer）：这一层主要负责的事情包括，数据链路层数据包（Data Link Layer Packet，DLLP）的生成和解析；链路错误检测和校正，等等<br>
    物理层（Physical Layer）：这一层主要负责的事情包括，有续集（Ordered Sets）的生成和解析；并行到串行和串行到并行转换；8b/10b编码和解码（Gen1/2）；128b/130b编码和解码（Gen3/4/5）；时钟恢复；阻抗匹配；链路训练等等。这一层是三个分层中最为复杂的一层。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203225900304.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>PCIe协议是串行总线，发送或接收的是比特流，而且PCIe协议抛弃了PCI协议中的边带信号，因此需要对PCIe的数据流做格式限定，否则接收端根本无法得知发送端到底发了什么。
<br>
与网络分层协议一样，在链路的发送端，数据包在每个层包装。事务层负责产生TLP，包括数据包头（Header），数据负载，端到端CRC（End-End CRC，ECRC）。对于某些类型的TLP而言，Data和ECRC不是必须的，因此在下图中用虚线框表示。DLLP是由数据链路层在TLP的基础上，前面加上序列号（Sequence Number），后面加上链路CRC（Link CRC，LCRC）构成的。物理层在拿到DLLP后，前后加上帧符号，形成物理层的数据包，然后发送出去。
<br>
在链路的接收端，数据包又在每个层被拆解，最后事务层得到原始的TLP，根据TLP的请求类型进行下一步操作，或是访问存储子系统，或是向处理器发起中断等。</div></div>";
echo "<br><center><img src=./pcie_pic/203232883277.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>下图中设备A向设备B发起事务，各层负责的数据包部分用颜色区分，与各层的颜色保持一致。</div></div>";
echo "<br><center><img src=./pcie_pic/203306949898.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>下图是各层的详细框图，因为PCIe协议是双向单工传输，所以组件需要分别实现发送逻辑电路和接收逻辑电路。图中左侧是发送逻辑框图，右侧是接收逻辑框图。各层的具体细节将在后续章节中解释。</div></div>";
echo "<br><center><img src=./pcie_pic/203239771052.png /></center><br>";
echo "<font size=6 color=#ff0000><center><a name=pcie02></a>PCIe学习（二）</center></font><br><br>";
echo "<font size=4 color=black><div class=container><div class=text>PCIe学习（二） <br>
2 事务层
事务层需要完成的事情：
    TLP的生成（发送）和解析（接收）<br>
    TLP排序机制<br>
    基于信用值的流量控制机制<br>
    数据中毒（Data Poisoning）和ECRC完整性检测<br>
事务层向上要与应用层通信，不同设备的应用层天差地别，在做芯片设计时要根据具体情况而定。PCIe规范没有对应用层提出约定。<br>
2.1 地址空间<br>
PCIe协议中有四类地址空间，对应四种请求事务，如下表：<br>
Address Space** 	Transaction Types** 	Basic Usage**<br>
Memory 	Read/Write 	数据传输到/从（to/from）存储映射位置<br>
I/O** 	Read/Write 	数据传输到/从（to/from）I/O映射位置<br>
Configuration 	Read/Write 	Function配置<br>
Message** 	Baseline 	从事件信令机制到通用消息传递<br>
前三种是PCI协议中已有的事务类型，最后一种是PCIe协议中增加的事务类型。<br>
2.1.1 存储事务<br>
存储事务最常用，支持32-bit和64-bit两种地址格式，包括以下这些事务：<br>
    读取请求，读取完成（Read Request/Completion）<br>
    写入请求（Write Request）<br>
    原子请求，原子完成（Atomic Request/Completion）<br>
2.1.2 I/O事务<br>
I/O事务是PCI时代的产物，PCIe规范中支持I/O事务只是因为需要兼容已有的PCI设备。PCIe原生设备本身不再支持I/O事务，既不会发出I/O请求，也不会响应主机的I/O请求。<br>
I/O事务仅支持32-bit地址格式，包括以下这些事务：<br>
    读取请求，读取完成（Read Request/Completion）<br>
    写入请求，写入完成（Write Request/Completion）<br>
在后续的学习中，可以暂时忽略I/O事务。<br>
2.1.3 配置事务<br>
配置事务是主机（也就是RC）用来配置Function，访问Function配置寄存器。在系统平台上电后，所有的PCIe链路自动完成链路训练（Link Training）；随后主机软件（不区分固件/设备驱动/操作系统，统称为软件）对PCIe拓扑结构进行探索，已发现所有的可用设备，并分配唯一标识ID，这一过程称为“枚举（Enumeration）”；必要时，主机软件需要通过配置事务来请求PCIe设备开启或禁用某些功能，配置设备参数等等。<br>
配置事务包括以下这些事务：<br>
    读取请求，读取完成（Read Request/Completion）<br>
    写入请求，写入完成（Write Request/Completion）<br>
只有RC才有权限发出配置请求事务；EP或者Switch只可以接收配置请求事务，不允许发出配置请求。<br>
2.1.4 消息事务<br>
PCI时代有大量的引脚信号用于设备通信，这些引脚信号称作“边带（Side-Band）”信号。PCIe协议为了简化接口的引脚，将这些边带信号全部拿掉，设备间需要靠“带内（In-Band）”消息来通信。<br>
消息事务是PCIe规范中新增加的事务类型，也就是说PCI设备不支持此类事务，如果系统中有PCI设备，则需要PCIe-PCI桥接设备做转换。<br>
除去PCIe规范定义的消息类型，还支持厂商自定义消息，需要厂商自行定义和实现，并在其驱动软件中加以支持。<br>
2.2 事务类型<br>
上面是从地址空间出发，对PCIe事务进行了分类。接下来我们从事务发送和完成的角度看一下这些事务。<br>
先区分几个概念。事务的发起者叫做请求者（Requester），事务的响应者叫做完成者（Completer）。有些事务需要完成者给请求者一个完成响应（Completion），将事务完成的状态通知请求者；而有些事务则不需要完成者返回完成响应，请求者发出事务以后即认为事务已经完成。不需要完成响应的事务是Posted类型，需要完成响应的事务是Non-Posted类型。所谓Posted，就像是寄信件一样，当我们把邮件放入邮筒的那一刻起，就标志着信件已发出。至于信件最终是不是会送达到收件人手中，需要邮局系统来保证。在PCIe协议中，这一保证机制是由数据链路层的ACK/NAK协议来完成。对于Non-Posted类型来说，如果请求者在发送完请求事务后一直等待完成者返回完成事务，必然造成链路上的停顿，白白浪费了链路资源。因此PCIe协议规定，请求者发送完一个Non-Posted类型的事务后，可以继续发送其它的事务，而不必一直等待完成者的完成事务。这一过程也称为分离事务（Split Transaction），即请求和完成分离开来。<br>
需要注意的是，请求者不一定就是RC，完成者不一定就是EP或Switch。RC也可以是完成者，EP或Switch也可以是请求者。只有在发送配置事务时，RC与请求者是一致的，EP/Switch与完成者是一致的。<br>
用表格总结一下事务的类型：<br>
Request Type** 	Non‐Posted or Posted** 	Abbreviation**<br>
Memory Read 	Non-Posted 	MRd<br>
Memory Write** 	Posted 	MWr<br>
AtomicOp 	Non-Posted 	AtomicOp<br>
IO Read** 	Non-Posted 	IORd<br>
IO Write** 	Non-Posted 	IOWr<br>
Configuration Read** 	Non-Posted 	CfgRd<br>
Configuration Write 	Non-Posted 	CfgWr<br>
Message** 	Posted 	Msg/MsgD<br>
为了简化学习，可以忽略表中的IO Read/Write。<br>
对于存储读取请求（MRd）和配置读取请求（CfgRd），必然需要有相应的完成响应，否则完成者怎么返回给请求者需要的数据呢。也就是说MRd和CfgRd是Non-Posted类型。参考下图，是一个存储读取请求的例子，首先是EP发起MRd，经过Switch B和A到达RC；RC从相应的内存中将数据取出，并通过CplD将数据发送给EP。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203440872444.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>配置写入请求（CfgWr），是RC发给Switch或者EP的，因为Switch或EP的功能取决于该设备是否被配置成功，所以Switch或EP必须返回完成响应给RC，这样RC才能进行后续的操作。CfgWr也是Non-Posted类型。<br>
IORd和IOWr是Non-Posted类型，不再展开了。下图是IOWr的例子。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203447441959.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>最后，只有存储写入请求（MWr）和消息请求（Msg/MsgD）是Posted类型，请求者发出请求即认为请求已完成，这样可以大大提高链路效率。至于请求是否真正被发送到了完成者，需要其它的机制保证，后面会介绍。<br></div></div>";
echo "<br><center><img src=./pcie_pic/20345268108.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>细心的读者可能发现了一个问题，如果请求者发送了多个MWr或者是多个Msg，那么完成者是以什么顺序接收到的呢？这涉及到PCIe规范中的事务顺序问题。其实这个问题牵扯到所有事务的顺序，后面会详细讲。<br>
2.3 事务层协议-数据包格式<br>
TLP的串行格式如下图所示，包括TLP前缀（Prefixes），TLP包头（Header），有效数据负载（Data Payload）和TLP摘要（Digest）。其中只有TLP Header是必选项，其它三项都是可选项，根据数据包的实际需求而定。PCIe协议是串行总线，单比特传输，也就说发送端的物理层完成TLP并/串转换后，从TLP Prefixes（如果有的话）开始传输，最后传输TLP Digest（如果有的话）。这样做的一个好处是接收端可以提前知道这个数据包的类型，而不用等待全部接收完数据包。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203457194698.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>构成TLP的四部分里面，除了TLP Header，其它的都不是必选项，甚至是数据部分。TLP里面最为复杂的也是Header。<br>
TLP的并行格式如下图所示，PCIe协议里面用DW（Double Word，32-bit）来表示并行结构。后面会反复用到DW。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203502583857.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>从上图可以看出，长度固定只有Digest部分，为1-DW。其它的三部分，长度都不固定，但都是以DW对齐的。
2.3.1 TLP Header
前面提到过，存储读取/写入事务有两种地址格式：32-bit和64-bit。这个地址包含在TLP Header中，所以对应的有两种TLP Header格式。32-bit地址的Header是3-DW长度，64-bit地址的Header是4-DW（多出来的1-DW正好对应多出来的32-bit地址），如下图。</div></div>";
echo "<br><center><img src=./pcie_pic/203508267570.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>所有类型的TLP，其Header中的第一个DW格式都是相同的，而第二个DW中的字段随TLP类型不同而变化。<br>
2.3.1.1 通用的Header字段<br>
不管是哪种类型的请求，TLP的第一个DW，也就是前4 Byte格式是通用的，见上图。其中各字段的含义如下：<br>
    Fmt[2:0]：TLP的格式，指示TLP的地址格式，或者是否为Prefix<br>
    Type[4:0]：TLP的类型，Type字段通常与Fmt字段一起编码，来表示TLP的格式<br>
    TC[2:0]：流量等级（Traffic Class），PCIe协议支持最多8个TC值，通过TC来区分TLP的优先级，从而完成TLP保序和QoS的功能<br>
    T8 & T9：Tag[8]和Tag[9]，最初的Tag只有8-bit，后来增加了2-bit。Tag[7:0]在Header的第二个DW中。此字段由请求者分配，用于区分不同的具体请求，完成者返回完成响应时需带上Tag，这样请求者就知道哪些发出去的请求已经完成，哪些尚未完成<br>
    Attr[2:0]：3-bit的属性定义，这三个字段有各自的含义，并没有一起做编码，其中Attr[2]表示基于ID排序（ID-Based Ordering），Attr[1]表示松散排序（Relaxed Ordering），Attr[0]表示非监听（No Snoop）。<br>
    LN：轻量级通知（Lightweight Notification），这是Gen 4中加入的特性，在Gen 6中被取消<br>
    TH：TLP处理提示（Processing Hints）<br>
    TD：TLP Digest，指示TLP中是否存在有ECRC部分<br>
    EP：错误中毒（Error Poisoned），指示TLP Data部分的数据负载是否为“中毒”<br>
    AT[1:0]：地址类型（Address Type），即地址是否经过转换，仅对带有地址的事务有效，如MRd，MWr，AtomicOp。对其它的事务，该字段保留。在轻量级通知中，该字段有其它含义<br>
    Length[9:0]：TLP Data部分的大小，数据是DW对齐的，如果实际数据是Byte，则需要借助Header中的其它字段指示。<br>
本节先详细分析一些常用字段，有些不常用字段跟某些特性功能有关，留待后面章节分析。<br>
Fmt[2:0]的编码如下表所示：<br>
Fmt[2：0]** 	TLP format**<br>
000b 	3 DW header, no data<br>
001b** 	4 DW header, no data<br>
010b 	3 DW header, with data<br>
011b** 	4 DW header, with data<br>
100b 	TLP Prefixes<br>
Other** 	保留<br>
Fmt字段通常和Type字段一起，表示TLP类型，这两个字段是Header中最重要的字段。<br>
TLP Type** 	Fmt[2:0]** 	Type[4:0]** 	Description**<br>
MRd 	000001 	0 0000 	存储读取请求<br>
MRdLk** 	000001 	0 0001 	存储读取锁定请求<br>
MWr 	010011 	0 0000 	存储写入请求<br>
IORd** 	000 	0 0010 	I/O读取请求<br>
IOWr 	010 	0 0010 	I/O写入请求<br>
CfgRd0** 	000 	0 0100 	Type 0配置读取请求<br>
CfgWr0 	010 	0 0100 	Type 0配置写入请求<br>
CfgRd1** 	000 	0 0101 	Type 1配置读取请求<br>
CfgWr1 	010 	0 0101 	Type 1配置写入请求<br>
TCfgRd** 	000 	1 1011 	不推荐的TLP类型，以前用于可信配置空间（Trusted Configuration Space），现在不再支持<br>
TCfgWr 	000 	1 1011 	不推荐的TLP类型，以前用于可信配置空间（Trusted Configuration Space），现在不再支持<br>
Msg** 	001 	1 0r2r1r0 	不带数据的消息请求，r[2:0]指明消息路由机制<br>
MsgD 	011 	1 0r2r1r0 	带数据的消息请求，r[2:0]指明消息路由机制<br>
Cpl** 	000 	0 1010 	不带数据的完成响应事务<br>
CplD 	010 	0 1010 	带数据的完成响应事务<br>
CplLk** 	000 	0 1011 	用于存储读锁定，不带数据的完成响应事务<br>
CplDLk 	010 	0 1011 	用于存储读锁定，带数据的完成响应事务<br>
FetchAdd** 	010011 	0 1100 	先获取后相加的原子操作请求<br>
Swap 	010011 	0 1101 	无条件交换的原子操作请求<br>
CAS** 	010011 	0 1110 	比较并交换的原子操作请求<br>
LPrfx 	100 	0 L3L2L1L0 	本地Prefix，L[3:0]表示具体的Prefix类型<br>
EPrfx** 	100 	1 E3E2E1E0 	端到端Prefix，E[3:0]表示具体的Prefix类型<br>
— 	— 	— 	Reserved<br>
链路双方可以借助TC字段实现事务的保序要求。PCIe协议规定，相同TC值的事务需要遵守严格的先后顺序（不开启基于ID排序和松散排序，即不使能Attr[2:1]）。同时，PCIe协议还规定，不同TC值的事务之间不需要保序。如果事务的发起方对于事务有顺序要求，则需要将这些事务分配相同的TC值。借助TC，还可以实现QoS功能，不过这需要硬件逻辑配合，放到QoS章节详细讲解。<br>
前面说过，为了提高链路性能，PCIe将Non-posted类型的请求拆分，请求者发出一个请求后即可以继续发送请求，而不必等待完成响应。也就是说请求者可以连续发送多笔请求，比如可以连续发送若干的MRd。至于具体数目，取决于硬件设计的超发（Outstanding）缓冲区深度。此时的一个问题是，这么多超发请求，完成者返回完成响应时，请求者怎么知道对应的是哪笔请求。这就需要请求者给每个请求事务分配一个唯一的标识符，完成响应中带上这个标识符，请求者就知道对应哪笔请求了。这个标识符就是Tag。可能有的人会问，对于Posted类型的请求，比如MWr，不需要完成响应，是不是Tag字段就没有用了呢？的确如此，不过这时PCIe协议对Tag字段另有用处。<br>
AT[1:0]字段表示地址类型，编码如下表。后面讲地址翻译服务ATS时会用到。<br>
AT[1:0]** 	Mnemonic 	Description**<br>
00b 	Untranslated 	TLP Header中的地址是未经翻译的，需要主机侧进行地址翻译<br>
01b** 	Translation request 	地址翻译请求，主机侧的地址翻译代理（Translation Agent）需要返回地址翻译后的页表项给设备（如果支持的话）<br>
10b 	Translated 	TLP Header中的地址已经过翻译，主机侧可以直接响应该请求<br>
11b** 	保留<br>
Length[9:0]字段的意思比较简单，就是TLP Data的长度。数据是以DW对齐的，PCIe协议规定，数据最大可以是4KB。在实际应用中，Data的最大长度需要链路双方协商而定，很多时候并不是4KB。<br>
2.3.1.2 存储事务的Header<br>
存储事务支持32-bit地址和64-bit地址两种格式，其完整的TLP Header格式定义如下图。<br></div></div>";
echo "<br><center><img src=./pcie_pic/20354630341.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>DW 1，2，3中增加的字段有：<br>
    Requester ID[15:0]：请求者ID，这是主机分配的PCIe拓扑结构中的唯一值。Requester ID字段与Tag字段合起来组成了事务ID（Transaction ID）<br>
    Tag[7:0]：事务标签，前面介绍过了<br>
    Last DW BE[3:0]：数据负载中最后一个DW中的字节使能，用于存储，I/O，配置请求<br>
    First DW BE[3:0]：数据负载中第一个DW中的字节使能，用于存储，I/O，配置请求<br>
    Address[64:2]：地址，最低两位强制是00b<br>
    PH[1:0]：处理提示（Processing Hint），需要配合TH字段使用。如果TH无效，则PH[1:0]保留；TH有效，则PH字段编码表示处理提示，具体含义放到TPH功能部分讲解<br>
这里需要解释一下Last DW BE[3:0]字段和First DW BE[3:0]字段。前面一直在说，TLP Data是DW对齐的，如果实际数据不是DW对齐，则可以借助这两个字段，指出实际数据的起始和结束位置。细心的人可能会问，对于一大段中间有空洞的数据段，该怎么处理？有两个办法，一是将这段数据拆开，用多个TLP传输；二是主机软件或设备软件知道哪些数据无效，在一个TLP将整个数据段传输，然后通过在软件中处理这段数据。<br>
2.3.1.3 I/O事务的Header<br>
I/O事务仅支持32-bit地址（在PCI时代不需要64-bit地址），其完整的TLP Header格式定义如下图。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203552690437.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>PCIe协议对I/O事务TLP Header中的字段有一定规则：<br>
    TC[2:0]字段必须是000b<br>
    LN字段不适用，保留<br>
    TH字段不适用，保留<br>
    Attr[2]保留<br>
    Attr[1:0]必须是00b<br>
    AT[1:0]必须是00b<br>
    Length[9:0]必须是00 0000 0001b<br>
    Last DW BE[3:0]必须是0000b（I/O事务只有一个DW的数据负载，这个字段没有意义）<br>
2.3.1.4 配置事务的Header<br>
配置事务采用ID路由，因此不需要地址信息，其完整的TLP Header格式定义如下图。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203552690437.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>第三个DW中增加的字段有：<br>
    Bus Number[7:0]：总线编号<br>
    Device Number[4:0]：设备编号<br>
    Fcn Number[2:0]：Function编号，与上面两组编号合起来称为BDF，是PCIe拓扑结构中的唯一标识<br>
    Register Number[5:0]：寄存器编号，与下面的字段一起使用，指示要访问的配置空间中的寄存器地址<br>
    Extended Register Number[3:0]：扩展寄存器编号<br>
配置事务对TLP Header中各字段的限制：<br>
    TC[2:0]必须是000b<br>
    LN字段不适用，保留<br>
    TH字段不适用，保留<br>
    Attr[2]保留<br>
    Attr[1:0]必须是00b<br>
    AT[1:0]必须是00b<br>
    Length[9:0]必须是00_0000_0001b<br>
    Last DW BE[3:0]必须是0000b<br>
2.3.1.5 消息事务的Header<br>
消息事务的路由方式有多种，可以是地址路由，ID路由，隐式路由，其完整的TLP Header格式定义如下图。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203605915652.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>新增加的字段是Message Code[7:0]，表示消息编码。对于不同的消息类型，DW 2和3（即Byte 8-15）的含义不同。<br>
Type字段的后三位，是消息事务的路由方式，编码见下表。<br>
Type[2:0]** 	Description** 	Byte 8-15**<br>
000 	路由到RC 	保留<br>
001** 	地址路由 	地址<br>
101 	ID路由 	BDF<br>
011** 	RC广播消息 	保留<br>
100 	本地路由，终止于接收端 	保留<br>
101** 	收集并路由到RC，仅适用于PME_TO_Ack消息 	保留<br>
110/111 	保留 	保留<br>
消息编码整理如下：<br>
Message Name** 	Message Code[7:0]**<br>
Assert_INTA 	0010 0000<br>
Assert_INTB** 	0010 0001<br>
Assert_INTC 	0010 0010<br>
Assert_INTD** 	0010 0011<br>
Deassert_INTA 	0010 0100<br>
Deassert_INTB** 	0010 0101<br>
Deassert_INTC 	0010 0110<br>
Deassert_INTD** 	0010 0111<br>
PM_Active_State_Nak 	0001 0100<br>
PM_PME** 	0001 1000<br>
PME_Turn_Off 	0001 1001<br>
PME_TO_Ack** 	0001 1011<br>
ERR_COR 	0011 0000<br>
ERR_NONFATAL** 	0011 0001<br>
ERR_FATAL 	0011 0011<br>
Unlock** 	0000 0000<br>
Set_Slot_Power_Limit 	0101 0000<br>
Vendor_Defined Type 0** 	0111 1110<br>
Vendor_Defined Type 1 	0111 1111<br>
Ignored Message** 	0100 0001<br>
Ignored Message 	0100 0011<br>
Ignored Message** 	0100 0000<br>
Ignored Message 	0100 0101<br>
Ignored Message** 	0100 0111<br>
Ignored Message 	0100 0100<br>
Ignored Message** 	0100 1000<br>
LTR 	0001 0000<br>
OBFF** 	0001 0010<br>
PTM Request 	0101 0010<br>
PTM Response** 	0101 0011<br>
PTM ResponseD 	0101 0011<br>
对于每种类型的消息，TLP header的Byte 8-15各不相同，这里不再赘述，后面用到哪种消息再具体分析。<br>
2.3.1.6 完成事务的Header<br>
对于Non-Posted类型请求，需要完成者返回完成响应事务。完成事务是ID路由方式，其完整的TLP Header格式定义如下图。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203615156900.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>新增的字段有：<br>
    Cpl Status[2:0]：完成状态<br>
    BCM（Byte Count Modified）：仅对PCI完成者有意义<br>
    Byte Count[11:0]：请求的剩余字节数<br>
    Lower Address[7:0]：低位地址，对于存储读取请求，该字段是完成事务返回的第一个数据的第一个启用字节的地址<br>
Cpl Status字段的编码见下表：<br>
Cpl Status[2:0]** 	Completion Status**<br>
000 	成功完成（Successful Completion，SC）<br>
001** 	不支持的请求（Unsupported Request，UR）<br>
010 	配置请求重试状态（Configuration Request Retry Status，CRS）<br>
100** 	完成者中止（Completer Abort，CA）<br>
Others 	保留<br>
2.3.2 TLP Prefix<br>
TLP Prefix分为两种，Local TLP Prefix和End-End TLP Prefix。<br>
Prefix的用途是扩展TLP。在PCI时代，TLP的格式就规定好了，随着技术的不断进步，协议中需要添加更多的扩展字段以用于扩展功能。聪明的协议制定者们想出了给TLP加前缀这种方式。在TLP前面添加扩展字段，既不影响旧有的设备和驱动软件，又能增加新特性。<br>
一个Prefix长度是固定1 DW，格式定义如同TLP Header的第一个DW的格式定义。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203623805182.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>Fmt字段和Type字段编码指示是哪种Prefix。<br>
Type[4]用来区分是本地Prefix（0b）还是端到端Prefix（1b）。<br>
目前在Gen 5.0中，本地Prefix有以下几种：<br></div></div>";
echo "<br><center><img src=./pcie_pic/203628912281.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>端到端的Prefix有以下几种：</div></div>";
echo "<br><center><img src=./pcie_pic/203633529468.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>除去上面的几种端到端Prefix，还有一种IDE Prefix，用于数据完整性和加密功能。IDE（Integrity and Data Encryption）功能是Gen 5中以ECN（Engineering Change Notice）形式发布的，在Gen 6的基本规范中正式引入。<br>
不同类型的Prefix，Byte 1-3的含义不同，以后用到的时候再具体分析。<br>
2.3.3 TLP Data<br>
Data部分格式很简单，前面已经讲过很多了。Header中的Length[9:0]字段指示数据的大小，编码如下：<br></div></div>";
echo "<br><center><img src=./pcie_pic/203639519109.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>大家可以想想，为什么00_0000_0000b表示的是1024 DW，而不是0 DW呢？因为带不带数据是事务类型决定的，所以不需要表示0 DW。<br>
在实际的设备中，很可能不会支持4KB这么大的数据负载。而且，对于存储读取事务的完成事务，PCIe协议规定数据为64-Byte或128-Byte，称为“读取完成边界（Read Completion Boundary，RCB）”。<br>
关于Data的具体规则，这里不详细列出了。<br>
2.3.4 TLP Digest<br>
TLP Digest也叫做ECRC（End-End Cyclic Redundancy Check），如果启用此功能，则PCIe设备对所有发出的TLP增加一个DW，用于端到端的循环冗余校验。<br>
端到端连接是一个网络连接术语，在PCIe中指的是请求者与完成者的连接，不管中间是不是有Switch。点到点连接指的是链路两端的直接连接，比如RC与Switch，Switch与EP的连接。<br>
ECRC顾名思义，完成者负责最后用CRC对TLP其余部分做校验，中间的Switch会将ECRC直接转发（虽然允许Switch检查ECRC，如发现错误后上报错误，但Switch一般不会这么做）。<br>
能看出来，ECRC解决的不是链路传输错误问题，实际上链路传输错误是通过链路CRC（Link CRC，LCRC）来检查的。这会放到数据链路层中介绍。<br>
那么ECRC是用来干什么的呢？在事务层生成TLP一直到送给物理端口发出，中间的过程可能会存在逻辑错误，ECRC就是用来检测这个错误的。<br>
具体的CRC算法就不介绍了。<br></div></div>";
echo "<font size=6 color=#ff0000><center><a name=pcie03></a>PCIe学习（三）</center></font><br><br>";
echo "<font size=4 color=black><div class=container><div class=text>PCIe学习（三）2.4 事务路由<br>
讲事务类型的时候提到了事务路由（Transaction Routing）。所谓路由，就是在PCIe拓扑结构中，事务如何从请求者正确走到完成者。PCIe有三种路由方式：地址路由，ID路由，隐式（Implicit）路由。<br>
2.4.1 地址路由<br>
地址路由好理解，就是按照地址去找。SoC设计中，地址都被映射到存储器地址空间（Memory Mapped）。那么，接下来的问题是PCIe设备的地址从哪里来。这个地址是主机侧的处理器分配的。首先，主机的处理器要知道设备想要展现给主机的空间，然后再结合实际情况分配相应大小的存储空间给设备。这一过程是主机向设备发送配置读取/写入请求完成的，具体放在配置空间章节介绍。<br>
支持地址路由的事务有：<br>
    存储读取/写入请求<br>
    I/O读取/写入请求<br>
    消息请求<br>
需要注意的是，在Gen 5的基础规范中特别注明，没有消息事务是使用地址路由的。也就是说消息事务的TLP Header中的地址字段要么是保留不用，要么是用作其它用途。这里说的消息事务支持地址路由应该沿用是Gen 5之前规范的说法。<br>
2.4.2 ID路由<br>
Function是PCIe设备中的物理实体，负责完成一项功能。只包含一个Function的设备叫做SFD（Single-Function Device），包含多个Function的设备叫做MFD（Multi-Function Device）。在PCIe拓扑结构中，为了区分不同的Function，每个Function被分配了一个唯一的标识ID，此ID是由8-bit的总线编号，5-bit的设备编号，3-bit的Function编号组成。正因为此ID是唯一的，所以可以通过ID路由方式传输TLP。<br>
PCI总线是共享总线，设备编号有其作用。但是PCIe是点到点连接，设备编号就没有太大意义了。PCIe协议推出了ARI（Alternative Routing-ID, ARI）功能，将5-bit的设备编号取消，分配给了Function。也就是说支持ARI的话，此ID依然是16-bit，由8-bit总线编号和8-bit的Function编号组成。在后面分析ARI的时候会详细介绍。至此，大家记得ID在PCIe拓扑结构中是唯一的就可以了。至于主机怎么分配这些编号，留待分析PCIe枚举的时候再说。<br>
对于EP来说，接到ID路由的TLP后，判断ID值是否与自己的ID相同，如果相同就接受此TLP，并完成相应的动作；如果不同，则拒绝TLP。<br>
对于Switch来说，情况复杂一些。Switch接到ID路由的TLP后，判断ID值是否与自己的ID匹配，如果匹配则接受此TLP；如果不匹配，则继续判断ID值是否在其下游端口的连接的设备的ID范围内，如果在则说明TLP是发给Switch下游的设备，Switch转发即可。<br>
支持ID路由的事务有：<br>
    配置读取/写入事务<br>
    完成事务<br>
2.4.3 隐式路由<br>
隐式路由，顾名思义，就是不需要指定TLP的地址或者ID。之所以隐式路由不需要地址或ID，是由PCIe拓扑结构决定的。在PCIe拓扑结构中，RC是唯一的根节点，当EP或Switch想发送消息给RC，就不需要指明了，只需要向上游端口转发就好了。相反，如果RC向EP/Switch广播消息，只要不断向下游端口转发。对于本地消息，接收方就是链路对端，因此也不需要地址或者ID。<br>
对于消息TLP，Type[2:0]字段用于指示路由方式，除去编码001b（地址路由）和010b（ID路由），其它几种都是隐式路由。还记得前面提到过，Gen 5中消息事务已不再使用地址路由。<br> </div></div>";
echo "<br><center><img src=./pcie_pic/203726463216.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>只有消息事务支持隐式路由。<br>
最后，总结一下PCIe中的TLP路由方式。<br>
TLP类型 	路由方式<br>
Memory Read/Write** 	地址路由<br>
IO Read/Write** 	地址路由<br>
Configuration Read/Write** 	ID路由<br>
Message** 	地址路由，ID路由，隐式路由<br>
Completion** 	ID路由<br>
2.5 虚拟通道<br>
虚拟信道（Virtual Channel，VC）机制支持在PCIe拓扑结构中使用TC标签来区分数据流量。<br>
VC的基础是独立的结构资源（队列/缓冲区和相关的控制逻辑）。这些资源用于通过不同VC之间完全独立的流量控制。<br>
通过将TC映射到VC来将数据流量等级与VC相关联，这被称为TC/VC映射。TC0/VC0映射是固定的，不可更改的；其它映射可以通过配置软件来设置。<br>
下图是VC概念的示意图。在发送端，数据流量被复用到物理链路；在接收端，数据流量被解复用到独立的VC路径。<br></div></div>";
echo "<br><center><img src=./pcie_pic/20373497631.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>在Switch内部，每个端口的虚拟信道都需要专用的物理资源。下图是Switch内部虚拟通道的示意图。</div></div>";
echo "<br><center><img src=./pcie_pic/203738386049.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>2.5.1 虚拟通道ID (VC ID)<br>
PCIe端口最多可以支持8个VC，每个端口都是独立配置和管理的。不同VC使用唯一的ID值来标识。<br>
支持多VC的端口需要同时实现VC能力结构。对于仅支持默认TC0/VC0配置的端口，是否提供这些扩展结构是可选的。配置软件负责为链路两侧的端口匹配VC数量。<br>
为端口内的VC硬件资源分配VC ID的规则如下：<br>
    每个端口的VC ID分配必须是唯一的，同一个VC ID不能分配给同一端口内的不同VC硬件资源<br>
    链路两侧的两个端口的VC ID分配必须相同<br>
    如果MFD实现MFVC能力结构，则其VC硬件资源不同于与其Function的VC硬件资源。VC ID唯一性要求仍然单独适用于MFVC和任何VC能力结构<br>
    VC ID 0被分配并固定为默认VC<br>
2.5.2 TC to VC Mapping<br>
除了TC0必须映射到VC0，其它TC可以映射到不同的VC。TC/VC的映射关系可以由系统软件决定，但必须遵守：<br>
    允许将一个或多个TC映射到同一个VC<br>
    不允许一个TC映射到多个VC<br>
    链路两侧端口的TC/VC映射必须相同<br>
下图是PCIe Gen-5基本规范中给出的TC/VC映射示例。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203745962561.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>2.5.3 VC and TC Rules<br>
以下是与TC/VC机制的关键规则：<br>
    所有设备必须支持TC0，并且必须实现默认的VC0<br>
    每个虚拟通道都有独立的流量控制<br>
    不同TC之间不需要保序<br>
    不同VC之间不需要保序<br>
    Switch的对等功能适用于Switch支持的所有虚拟信道<br>
    MFD在不同Function之间的对等功能适用于MFD支持的所有虚拟通道<br>
    TC未映射到入口端口中任何已启用VC的事务被接收设备视为格式错误的TLP<br>
    对于Switch，TC未映射到目标出口端口中任何已启用VC的事务被视为格式错误的TLP<br>
    对于根端口，TC未映射到目标RCRB中任何已启用VC的事务被视为格式错误的TLP<br>
    对于具有MFVC能力结构的MFD，TC未映射到MFVC能力架构中已启用VC的事务被视为格式错误的TLP<br>
    Switch必须支持每个端口的独立TC/VC映射配置<br>
    RC必须支持每个RCRB、根端口和RCiEP的独立TC/VC映射配置<br>
2.5.4 VC能力寄存器<br>
支持多VC，或者虽然只有一个VC但是需要支持TC过滤的设备需要实现VC能力寄存器，在6.3.7章节详细介绍。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203751640777.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>2.6 流量控制<br>
2.6.1 基于信用的流量控制<br>
PCIe最多支持八个虚拟通道，每个虚拟通道负责自己的流量控制。<br>
PCIe的流量控制基于信用（Credit-Based）机制。在链路初始化阶段，链路的接收端需要向发送端报告自己的接收缓冲区大小，即接收能力，也称作信用值；在链路正常工作期间，接收端需要有规律的向发送端告知当前的接收缓冲区情况。具体做法是通过数据链路层的流量控制DLLP来完成。这个DLLP无疑是系统开销，但是其不携带有效数据，所以这个DLLP很小，只有8个符号（Symbol），因此对链路性能的影响可以忽略不记。<br>
参照下图，归纳一下PCIe流量控制的基本原理。<br>
PCIe设备在事务层中实现接收缓冲区（FC Buffer）和流量计数器（FC Counter）。链路双方将自己的接收缓冲区的信用值发送给对方。发送端通过自己的计数器记录接收端的信用值，发送端在发送事务前需要检查计数器，如果发现计数器为0，说明接收端的缓冲区已满，不能再接收。此时发送端需要等待接收端处理事务；如果计数器不为0，发送端将事务向数据链路层传递，发送端每发送一个事务，计数器减1。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203758431158.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>流量缓冲区分为三类：<br>
    P：用于MWr和Msg<br>
    NP：用于MRd，CfgRd，CfgWr，IORd，IOWr，AtomicOp<br>
    CPL：用于Cpl，Cpld<br>
上述三种类型中，又按照Header和Data进行拆分。因此，缓冲区有六种：PH，PD，NPH，NPD，CPLH，CPLD。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203804939526.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>Header的1个信用值对应4DW（Completion）或者5DW（Request）；Data的1个信用值对应4DW，即数据信用是16-Byte对齐的。<br>
PCIe 5.0中，TLP消耗信用的情况见下表：<br></div></div>";
echo "<br><center><img src=./pcie_pic/203809793201.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>2.6.2 流量控制初始化<br>
当系统平台上电，物理层完成链路训练后，物理层通过LinkUp信号通知数据链路层。随后，开始流量控制初始化。虚拟通道VC0是默认启用的，所以VC0的流量控制初始化是自动完成的，无需软件接入。其它虚拟通道的初始化需要等待配置软件启用这些VC。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203816599818.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>数据链路层的控制和管理状态机（Data Link Control and Management State Machine，DLCMSM）负责流量控制初始化的过程。</div></div>";
echo "<br><center><img src=./pcie_pic/203821644417.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>系统复位，DLCMSM进入DL_Inactive状态。当物理层完成链路训练，拉高LinkUp信号，DLCMSM检测到LinkUp后跳转到DL_init状态。DL_init有两个子状态FC_INIT1，FC_INIT2。<br>
在FC_INIT1阶段，设备连续发送3个InitFC1流量控制DLL的序列，报告其接收缓冲区大小。按照协议，其报告的先后顺序是Posted，Non-Posted，Completion。当设备发送了自己的值并接收到足够多次的完整序列来确信这些值被正确地看到，它就可以退出FC_INIT1进入FC_INIT2了。下图中的HdrFC字段表示的是Header流量控制信用值，DataFC表示的是Data流量控制信用值。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203826568563.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>在FC_INIT2阶段，设备连续发送InitFC2 DLLP。由于设备已经注册了来自链路对端的信用值，因此在等待查看InitFC2s时可以忽略任何对端发过来的InitFC1s。两步初始化过程将不强制链路的两端在相同时间内完成初始化。<br>
当设备完成FC_INIT2，进入DL_Active阶段，通过DL_Up信号通知事务层。<br>
PCIe设备的接收逻辑必须定期向链路对端发送FC_Update DLLP，更新当前的流量控制信用值。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203831522623.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>2.6.3 缩放流量控制机制<br>
PCIe Gen 3中规定，Header流量控制信用值最大值是127，Data流量控制信用值最大值是2047。当没有足够的流量控制信用，链路性能可能会受到影响。这种影响在更高的链路速率下变得更加明显，127个Header信用和2047个Data信用的限制可能会限制性能。因此，在PCIe Gen 4中引入缩放流量控制（Scaled Flow Control）机制，旨在解决这个问题。<br>
PCIe Gen 4提供了x1, x4, x16三种放大系数。这样, 对于Header流量信用值有 127/508/2032三种选择，对于Data流量信用值有2047/8188/32752三种选择。<br>
可能大家已经注意到上面的FC DLLP中，在HdrFC和DadaFC前面各有2-bit保留。其实上图的FC DLLP是Gen 3的格式，在Gen 4中，FC DLLP是下图格式<br></div></div>";
echo "<br><center><img src=./pcie_pic/203836879299.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div>HdrScale字段和DataScale就是指示放大系数。<br>
2.7 事务顺序<br>
为了提高PCIe链路性能，设备可以连续发出事务，而不必等待上一个事务完成才能发送下一个。设备连续发送事务的能力取决于硬件设计，不在本节讨论范围内。<br>
本节要分析的是这些事务的排序关系。如果严格按照时间先后，可能会造成死锁。如果完全乱序，则可能会造成逻辑错误。PCIe协议的制定者们为此花费了大量心思。<br>
2.7.1 生产者/消费者模型<br>
PCIe基于生产者/消费者（Producer/Consumer）模型。下图描述生产者/消费者模型，其中有五个重要的组成部分：<br>
    数据生产者（Producer of Data）<br>
    数据缓冲区（Memory Buffer of Data）<br>
    标志信号（Flag Semaphore），指示数据生产者已经发送完数据<br>
    数据消费者（Consumer of Data）<br>
    状态信号（Status Semaphore），指示数据消费者已经取走数据<br>
参照下图，在这个示例中，左下角的PCIe设备是数据生产者，主机的处理器是数据消费者，数据缓冲区在主机内存中，标志信号和状态信号存储在右下角的物理设备中。<br></div>";
echo "<br><center><img src=./pcie_pic/203845573440.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div>如果以下列的顺序处理事务，不会产生问题：<br>
        生产者通过MWr将数据写入到内存中，这一过程需要一些时间才能完成<br>
        消费者采用轮询的方式，通过MRd去读取标志信号Flag，检查当前否有可用数据<br>
        通过CplD将Flag=0的信息返回给消费者，消费者知道暂时没有可用数据<br>
        生产者通过MWr写入Flag=1<br>
        消费者等待一段时间后，重复第2步<br>
        这次消费者读取到Flag=1<br>
        消费者通过MWr将Flag再次写成0<br>
        生产者还有其它数据需要发送，所以需要周期性发送MRd去读取Status信号<br>
        生产者读取到Status=0，说明消费者还没有取走数据，继续等待<br>
        此时消费者知道内存中有数据可用，因此通过MRd来取走数据<br>
        数据全部被消费者取走<br>
        第11步结束后，消费者通过MWr写入Status=1，指示数据已被全部取走<br>
        生成者重复第8步，继续轮询Status<br>
        这次消费者读取到了Status=1，说明内存中的数据已经被消费者读走，可以继续发送数据了<br>
        生产者通过MWr清除Status<br>
        一次的数据生产/消费结束，生产者可以从第1步重复，继续数据生成/消费<br>
上诉过程如下两图中的编号所示。<br></div>";
echo "<br><center><img src=./pcie_pic/20385365158.png /></center><br>";
echo "<br><center><img src=./pcie_pic/203857566466.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>上面的例子是在一切正常的情况下，按照事务顺序执行。来看另一个的例子。<br>
        生产者通过MWr将数据发送给主机内存，但这次出现了一些问题，MWr事务被阻塞在Switch的上游端口，并没有真的写入主机内存<br>
        生产者通过MWr写入Flag=1<br>
        消费者通过MRd读取Flag<br>
        Flag=1通过CplD返回给消费者<br>
        消费者发现Flag=1，随即去读取内存中的数据，但是消费者并不在知道真正的数据还被阻塞在Switch的上游端口，并没有写入到内存，因此消费者读取到的数据是以前旧数据。数据消费过程出现错误。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203904227959.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>要解决上述的问题，有很多办法，比如消费者向生产者发出一个“空读”事务，生产者返回完成响应事务给消费者。如果能保证该完成响应事务不会超越先前的写内存事务，也就是消费者接到完成响应就意味着前面的写内存事务已经完成，即可解决。<br>
综上，必要的时候需要保证事务的顺序关系，即保序；非必要的时候，可以打乱事务顺序，提高链路效率，避免死锁发生。<br>
2.7.2 PCIe的排序模型<br>
PCIe中有三种排序模型：<br>
    强排序（Strong Ordering）：相同TC值的事务需要严格遵守时间先后顺序，不同TC的事务不需要遵守顺序要求。PCIe协议允许多个TC映射到相同VC，在同一个VC内不同TC的事务也不需要遵守顺序要求。<br>
    弱排序（Weak Ordering）：除非重新排序有帮助，否则事务将按顺序进行。保持事物之间的强序要求可能会带来一些不必要的依赖关系，而这些依赖关系可能会造成死锁，这时对事务进行重新排序会解决这个问题。<br>
    松散排序（Relaxed Ordering）：在特定的受控条件下对事务进行重新排序。好处是提高了性能，就像弱排序模型一样，但只有在由软件指定时，才能避免依赖性问题。缺点是只有一些事务会针对性能进行优化。<br>
前面讲虚拟通道和流量控制的时候提到过，VC缓冲区分成P，NP，CPL三个子缓冲区；在流量控制机制中，将TLP的Header和Data拆分成两个子缓冲区。这样，VC中实际有6个子缓冲区。这些子缓冲区的设计有助于简化事务排序规则的处理。<br>
强排序模型会事务停顿（Transaction Stall），参照下图，左侧是发送端，右侧是接收端。事务编号表示事务发送的时间顺序。如果遵守强排序，由于接收端的NP缓冲区满了，不能接收新的事务，发送端的事务1被迫停止，等待接收端的NP缓冲区有空间。事务2-8也不得不停止，等待事务1发送完成以后才能继续进行。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203911161989.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>实际上，这些子缓冲区的事务不存在依赖关系，比如上图中的事务2不依赖事务1，因此事务2可以继续发送。这就实现了事务弱排序。<br>
此外，PCIe支持松散排序，可以让软件来决定TLP是否需要遵守强序模型。如果软件认为TLP可以被重新排序，则启用TLP Header的Attr[1]字段的RO位。MWr和Msg都是Posted类型，都被存在Posted子缓冲区，因此遵守相同的排序要求。当Switch或RC发现MWr/Msg的RO被启用，则：<br>
    Switch允许后发出的MWr/Msg超车前面的MWr/Msg，并且Switch转发TLP时保持RO不变<br>
    允许RC对TLP重新排序。此外，在接收到MWr（RO=1）后，允许RC以任何地址顺序将每个字节写入内存。<br>
对于Read事务，PCIe按照拆分事务来处理，当设备开启RO发出MRd，完成者需要返回ClpD（RO被设置）。Switch的行为如下：<br>
    Switch不可以将后发的MRd超车前面的MWr，这保证了在读取请求的方向上的所有写事务都被推到读事务之前。<br>
    完成者收到MRd后，返回Completion，这些Completion的RO也被置位。<br>
    Switch接收到Completion（RO=1），允许将这些Completion超车完成者发出的MWr。这样即使MWr被阻塞，Completion仍可执行，有助于提高读取性能。<br>
下表总结了Switch的松散排序下可超车的事务。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203917940153.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>另一种优化排序和提高性能的做法是基于ID排序，其基本思想是不同请求者不在同一线程的话，之间的事务没有依赖关系。下图中，事务1先到达Switch的上游端口，但由于某些原因被阻塞。随后事务2也到达Switch的上游端口，按照强序要求，事务2必须停下来等待事务1先通过。但是，如果事务1和事务2之间没有依赖关系，强制事务2等待必然造成系统性能下降。解决办法是允许使用不同ID（Requester ID或者Completer ID）的事务重新排序，在本示例中也就是允许事务2超越事务1。使用此功能需要软件开启TLP Header的Attr[2]字段的IDO位。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203922624002.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>2.7.3 PCIe排序规则<br>
PCIe协议规定，事务排序规则仅在事务使用相同TC值时适用，对于不相同TC值则不适用。也就是说，不同TC值的事务不需要遵守排序规则。PCIe事务可以分为Posted类型和Non-Posted类型。因此，全部TLP可以分为三类：<br>
    Posted：包括MWr，Msg/MsgD<br>
    Non-Posted：包括MRd，IORd，IOWr，CfgRd0，CfgRd1，CfgWr0，CfgWr1，AtomicOp。Non-Posted请求又被分为两部分：Read Request（MRd，IORd，CfgRd0，CfgRd1）和NPR with Data（IOWr，CfgWr0，CfgWr1，AtomicOp）。<br>
    Completion：包括Cpl/CplD<br>
TLP排序规则见下表：<br>
表中的Col 2-5表示是时间维度上先发出的TLP，Row A-D表示的是时间维度上后发出的TLP。表中间的Yes表示后发出的TLP（Row A-D）必须被允许“超车（overtake）“先发出的TLP（Col 2-5），即Row中的事务虽然比Col中的事务发出时间晚，但是可以先被接收端接收，以避免死锁发生；No表示不允许后发出的TLP超车先发出的TLP，即后发出的TLP必须遵守强排序要求排在先发出的TLP后面被接收；Y/N表示后发出的TLP可以但不强制超车先发出的TLP。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203929857375.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>逐一解释一下这些表项：<br>
    A2a：Row事务不可以超越前Col事务，除非是A2b所允许的情况。<br>
    A2b：RO开启的Posted Request可以超车前一个Posted Request；如果两个请求者ID不同，或者两个请求都包含PASID TLP Prefix并且两个PASID值不同，则允许IDO开启的Posted Request超车前一个Posted Request<br>
    A3，A4：Posted Request必须可以超车前一个Non-Posted Request，以避免死锁。比如MWr可以超车MRd或者CfgWr<br>
    A5a：允许Posted Request超越Completion，但不要求。比如MWr超车CplD<br>
    A5b：对于PCIe到PCI方向上传输的事务，Posted Request必须可以超越Completion。<br>
    B2a：Read Request不可以超越前一个Posted Request除非B2b所允许的情况<br>
    B2b：如果两个请求者ID不同，或者两个请求都包含PASID TLP Prefix并且两个PASID值不同，则允许IDO开启的Read Request超越前一个Posted Request<br>
    C2a：NPR with Data不可以超越Posted Request，除非C2b所允许的情况<br>
    C2b：RO开启的NPR with Data可以超越前一个Posted Request；如果两个请求者ID不同，或者两个请求都包含PASID TLP Prefix并且两个PASID值不同，则允许IDO开启的NPR with Data超越前一个Posted Request<br>
    B3，B4，C3，C4：允许NPR超越另一个NPR<br>
    B5，C5：允许NPR超越Completion<br>
    D2a：不允许Completion超越Posted Request<br>
    D2b：允许IO和configuration write completion超越Posted Request；RO开启的completion可以超越Posted Request；如果完成者ID与Posted Request的请求者ID不同，则允许IDO开启的Completion超越Posted Request<br>
    D3，D4：Completion必须可以超越NPR，以避免死锁<br>
    D5a：允许不同事务ID的completion互相超越<br>
    D5b：相同事务ID的completion必须遵守顺序，这是为了确保与单个内存读取请求相关联的多个completion保持地址升序顺序。<br>
这一部分有点绕，不过很多是软件需要考虑的，比如在开启IDO或RO时，软件必须保证事务之间确实没有依赖关系，否则重新排序可能会造成功能错误。<br>
2.8 服务质量，QoS<br>
QoS这个概念在很多总线标准中都会提到。QoS的基本原理是让软件对不同的传输需求划分出优先级，优先级高的会分配更多的资源。<br>
PCIe中为了实现QoS，首先提出了流量等级（Traffic Class，TC）概念。在TLP Header的第一个DW中有3-bit的TC字段，也就是说TC从0到7有八个等级。其中，TC0是默认等级。<br></div></div>";
echo "<br><center><img src=./pcie_pic/203936249052.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>然后，PCIe又提出了虚拟通道（Virtual Channel，VC）概念。VC虽然挂着虚拟的名号，却是实打实的硬件缓冲区。前面讲流量控制时，提到设备中会实现缓冲区，这里的VC代表可用于传出数据包的不同路径。打个比方，PCIe设备是一条高速公路且有多条车道，车道就是VC，而行驶的车辆就是TLP，这些TLP最终汇聚到物理层发送出去，物理层链路就是一个检查站。软件可以指定TLP不同的TC等级，相同TC值的TLP行驶在同一个VC上，VC等级高的车道具有优先通过检查站的权利。<br>
VC最多也可以有8个，即0-7。实际上，考虑到VC是硬件逻辑资源，所以不同的PCIe设备很可能不会实现全部的VC。这里就涉及到一个问题，如何分配TC到VC上，即TC/VC映射。PCIe协议中做了如下的约束：<br>
    对于连接在同一链路任一端的两个端口，TC/VC映射必须相同<br>
    TC0将自动映射到VC0<br>
    其它TC可以映射到任何VC<br>
    一个TC不能映射到一个以上的VC<br>
PCIe设备关于VC的信息存放在扩展能力（Capability）寄存器中，其中每个VC有单独的一组寄存器。主机软件获得设备的VC数目，并为这些VC分配ID。<br>
VC可以有多个，但是物理链接只有一条，这就出现了一个问题，如何分配链路资源给VC，或者说哪些VC车道上的TLP可以优先其它VC上的TLP，发给链路的对端。PCIe提供三种VC仲裁方法：<br>
    严格优先级仲裁：优先级最高的VC始终会优先通过<br>
    分组仲裁：将VC分为高优先级组和低优先级组，其中高优先级组执行严格优先级仲裁，低优先级组执行软件指定的仲裁方式<br>
    硬件固定仲裁：仲裁机制由硬件实现<br>
下图是一个VC仲裁的例子，VC1和VC0采用了3：1的比例，即每发送3个VC1上的数据包以后，发送1个VC0上的数据包。这种仲裁机制的好处是，优先级低的VC也有机会获得链路资源<br></div></div>";
echo "<br><center><img src=./pcie_pic/203944948274.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>关于虚拟通道，详见后面第六章中的部分。</div></div>";
echo "<font size=6 color=#ff0000><center><a name=pcie04></a>PCIe学习（四）</center></font><br><br>";
echo "<font size=4 color=black><div class=container><div class=text>PCIe学习（四）3 数据链路层<br>
数据链路层是PCIe协议的中间一层，起着承上启下的作用。<br>
3.1 DLLP<br>
本节分析一下数据链路层的数据包（Data Link Layer Packet，DLLP)。<br>
DLLP只用于链路两端的数据链路层通信。DLLP的主要用途是TLP流量控制，链路初始化，电源管理，事务层与物理层之间信息传递等。与TLP不同的是，DLLP不需要路由，只是在一条链路的两端传递。<br></div></div>";
echo "<br><center><img src=./pcie_pic/204023764359.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>DLLP的大小固定，只有6-Byte的有效信息。其中Byte-0是DLLP类型编码，Byte-1/2/3根据DLLP不同类型有不同含义，Byte-4/5是16-bit的CRC。</div></div>";
echo "<br><center><img src=./pcie_pic/204028954569.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>Gen 5中的DLLP类型编码整理如下表：<br>
Encoding** 	DLLP Type**<br>
0000 0000 	Ack<br>
0000 0001 	MRInit<br>
0000 0010 	Data_Link_Feature<br>
0001 0000 	Nak<br>
0010 0001 	PM_Enter_L1<br>
0010 0010 	PM_Enter_L23<br>
0010 0011 	PM_Active_State_Request_L1<br>
0010 0100 	PM_Request_Ack<br>
0011 0000 	Vendor-specific<br>
0011 0001 	NOP<br>
0100 0v2v1v 0 	InitFC1-P<br>
0101 0v2v1v0 	InitFC1-NP<br>
0110 0v2v1v0 	InitFC1-Cpl<br>
0111 0v2v1v0 	MRInitFC1<br>
1100 0v2v1v0 	InitFC2-P<br>
1101 0v2v1v0 	InitFC2-NP<br>
1110 0v2v1v0 	InitFC2-Cpl<br>
1111 0v2v1v0 	MRInitFC2<br>
1000 0v2v1v0 	UpdateFC-P<br>
1001 0v2v1v0 	UpdateFC-NP<br>
1010 0v2v1v0 	UpdateFC-Cpl<br>
1011 0v2v1v0 	MRUpdateFC<br>
All other encodings 	Reserved<br>
表中带有MR的DLLP都是为多根虚拟化（MR-IOV）准备的，暂且忽略。<br>
Ack/Nak DLLP格式<br>
Ack/Nak DLLP用于数据链路层的Ack/Nak协议。<br></div></div>";
echo "<br><center><img src=./pcie_pic/204036431407.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>AckNak_Seq_Num字段指示哪些TLP被影响，成功（Ack）或者不成功（Nak）。下一节详细分析数据链路层的Ack/Nak协议。<br>
NOP DLLP格式<br>
接收端接收到NOP，检查CRC，然后放弃该DLLP，不做任何动作。<br></div></div>";
echo "<br><center><img src=./pcie_pic/204041261538.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>InitFC1/InitFC2/UpdateFC格式<br>
InitFC1/InitFC2用于流量控制的初始化；UpdateFC用于更新流量控制的信用值。</div></div>";
echo "<br><center><img src=./pcie_pic/20404678523.png /></center><br>";
echo "<br><center><img src=./pcie_pic/204052655122.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>Byte-0的高4-bit指示是哪种子缓冲区。<br>
DataFC字段指示事务层中Data缓冲区的信用值，HdrFC指示Header缓冲区的信用值。<br>
DataScale和HdrScale字段分别是Data和Header缓冲区信用值放大系数。<br>
V[2:0]字段是虚拟通道（VC）的ID。</div></div>";
echo "<br><center><img src=./pcie_pic/204058902730.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>各字段具体含义可参考流量控制一节。<br>
PM DLLP格式<br>
PM DLLP是一组DLLP的统称，用于电源管理。Byte-0的最第三位是不同的编码，目前Gen 5中的PM DLLP包括：PM_Enter_L1，PM_Enter_L23，PM_Active_State_Request_L1，PM_Request_Ack。<br>
具体含义留到电源管理章节分析。</div></div>";
echo "<br><center><img src=./pcie_pic/20410547656.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>Vendor-specific DLLP格式<br>
Vendor-specific DLLP的Byte-1/2/3定义取决于产商。</div></div>";
echo "<br><center><img src=./pcie_pic/20412534751.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>Data Link Feature DLLP格式</div></div>";
echo "<br><center><img src=./pcie_pic/204128937787.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>Feature Support字段指示发送端口支持的特性，该值与其Data Link Feature Capability寄存器对应。</div></div>";
echo "<br><center><img src=./pcie_pic/204135319320.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>3.2 ACK/NAK协议<br>
3.2.1 Ack/Nak协议原理<br>
数据链路层的一个重要职责是保证TLP正确传输。尤其是Posted类型的事务，请求者发出事务后就认为事务结束，但完成者是否真的接收到了事务吗？<br>
数据链路层在向物理层传输TLP之前，给TLP前面加上序列号（Sequence Number），后面加上LCRC。序列号是连续递增的，每个TLP分配一个。有了序列号和LCRC，链路两端的数据链路层可以使用Ack/Nak协议来保证链路上的传输。</div></div>";
echo "<br><center><img src=./pcie_pic/204155298158.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>发送端为每个TLP加上序列号和LCRC，同时将要发送的数据包存储在本地（数据链路层）的重试缓冲区（Replay Buffer）。接收端解析收到的数据包，首先计算LCRC，如果没发现有错误，向发送端发送Ack DLLP，如果有错误，向发送端发送Nak DLLP。不管是Ack DLLP还是Nak DLLP，其中都包含有序列号。</div></div>";
echo "<br><center><img src=./pcie_pic/204200489907.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>这里需要注意，接收端并不是对每个接收到的TLP都会返回Ack/Nak DLLP，为了节省链路资源，通常是是攒齐了几个再发Ack/Nak DLLP。发送端在接到Ack DLLP后，得到其中的序列号，知道此序列号之前的TLP都已经被正确接收，因此将本地Replay Buffer中保存的这些TLP都清除掉；如果是接收到Nak DLLP，说明此DLLP中的序列号之后的TLP中，至少有一个发生传输错误，因此需要将序列号之后的TLP全部重新传输一次。</div></div>";
echo "<br><center><img src=./pcie_pic/204205610112.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>上图是Ack/Nak DLLP的格式，Byte-0是Ack/Nak的编码。Byte-2和3是序列号字段，共有12-bit，因此序列号的最大数值是4095。初始化后，序列号计数器从0开始递增，到了4095后，下一个序列号是0，也就是说序列号的数值是回滚（Roll-back）式的。所以，对于发送端来说，有可能发生上一次正确接收的序列号是4093，下一个Ack/Nak返回的序列号是2的这种情况。<br>
LCRC是32-bit，对序列号和整个TLP进行校验。DLLP 的CRC是16-bit，是对DLLP的校验。不要混淆了两个CRC。<br>
为了实现Ack/Nak机制，PCIe设备需要在数据链路层实现相关的逻辑设计。</div></div>";
echo "<br><center><img src=./pcie_pic/204210751429.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>3.2.2 发送端设计<br>
对于发送端，需要实现：<br>
    12-bit的NEXT_TRANSMIT_SEQ计数器。此计数器生成将分配给下一个传入TLP的序列号。在系统复位期间，此计数器值复位成0，随后在系统正常工作期间递增，到了4095后回滚到0，继续递增<br>
    LCRC生成器，用于产生32-bit的CRC，对序列号和TLP进行校验<br>
    Replay Buffer，此缓冲区按照传输顺序存储TLP，包括序列号和LCRC。当发送端接收到Ack时，它从重试缓冲器中清除序列号等于或早于Ack中编号的TLP。通过这种方式，该设计允许一个Ack代表几个成功的TLP，从而减少了必须发送的Ack的数量。如果接收到Nak，在Nak中的序列号仍然指示接收到的最后一个成功传输的数据包。因此，即使接收到Nak也会导致发射端的Replay Buffer中清除TLP，即Nak DLLP中的序列号之前的TLP（包含该序列号指示的TLP）都会从Replay Buffer中清除，而序列号之后的TLP会被重新传输<br>
    REPLAY_TIMER计数器，代表的是计时器。如果超时，说明发送端发送了一个或多个TLP，但是在预期的时间内没有得到Ack或者Nak。超时会触发Replay Buffer中的所有内容被重新传输，并重置此计数器<br>
    2-bit的REPLAY_NUM，用于跟踪接收到Nak或REPLAY_TIMER超时后的重试次数。当REPLAY_NUM计数从11b回滚到00b（表示4次尝试传递同一组TLP失败）时，数据链路层自动强制物理层重新训练链路（LTSSM进入恢复状态）<br>
    12-bit的ACKD_SEQ寄存器，用于保存最近一次接收到的Ack/Nak DLLP中的序列号<br>
    DLLP CRC检查模块，校验接送端返回的Ack/Nak DLLP中的CRC值<br>
    3.2.3 接收端设计<br>
对于接收端，需要实现：<br>
    LCRC检查模块，校验TLP的LCRC值<br>
    12-bit的NEXT_RCV_SEQ计数器，用于跟踪预期序列号，验证顺序数据包接收。在系统复位时或数据链路层处于非活动状态时，它被初始化为0，并且对于转发到事务层的每个良好TLP，它会递增一次<br>
    序列号检查模块<br>
    NAK_SCHEDULED标志，当接收端准备返回Nak给发送端时，置高该标志位，当接收端成功的接收到TLP时，清除该标志位<br>
    AckNak_LATENCY_TIMER，每当接收端成功接收到尚未确认的TLP时，此计时器就会运行。一旦计时到期，接收端就需要发送一个Ack或Nak。<br>
    Ack/Nak生成器，对正常接收的TLP产生Ack，对失败的TLP产生Nak。<br>
    3.2.4 PCIe数据包优先级<br>
实际上，PCIe是双单工传输，从PCIe组件角度看需要实现上述的全部逻辑。<br>
到这里，我们总结一下PCIe链路上的数据包，有TLP/DLLP/Ordered Sets三种，Ordered Sets是在物理层，后面再讲。PCIe协议建议的处理优先级如下（从高到底）：<br>
        Completion of any TLP or DLLP currently in progress (highest priority)<br>
        Ordered Sets<br>
        Nak DLLP<br>
        Ack DLLP<br>
        Flow Control<br>
        Replay Buffer re‐transmissions<br>
        TLPs that are waiting in the Transaction Layer<br>
        All other DLLP transmissions (lowest priority)<br>
    3.2.5 直通模式<br>
最后，提一下Switch的直通模式（Cut-Through Mode）。对于Switch，只是负责转发TLP，正常做法是Switch的TLP从入口（Ingress）进入Switch，Switch检查接收到的TLP，如果没有传输问题，则向出口（Egress）转发TLP。如果TLP的数据载荷很大，这种方式无疑会增加延迟。另外一种选择是，Switch很快从TLP Header中得到路由信息（PCIe是串行总线，TLP Header先于Data传输），接下来Switch可以假设数据包是好的，直接向出口转发。这种方式就是Switch直通模式。<br>
不过直通模式存在一个问题，如果随后在Switch入口端口发生了传输错误，入口可以发送Nak要求重新传输。但是对于出口端口，该如何处理？不能简单粗暴的清除出口的Replay Buffer，因为出口端口的链路对端还在等待继续接收。这时出口需要向对端指出该TLP“失效（nullified）”。失效数据包以EDB符号而不是END符号终止，TLP的32位LCRC从原始计算值反转（1的补码）。接收到无效数据包的接收端则会直接丢弃该数据包，不做任何处理。<br>
下面是一个Switch直通的示例，TLP传输方向从左向右。<br>
        一个TLP发送到Switch的Ingress端口，该TLP在传输过程中被损坏，但是现在还不知道<br>
        Switch解析TLP Header，向Egress端口转发<br>
        Switch接收到完整的TLP，通过LCRC发现传输错误，向上游发送Nak<br>
        在Switch的Egress端口，Switch用EDB替换坏TLP末端的END帧符号，并反转计算的LCRC值。TLP现在变成“失效”，Switch将其从Replay Buffer中丢弃。<br>
        Switch下游的EP检测到EDB符号和反转的LCRC，知道这是一个无效数据包，直接丢弃数据包。注意，EP不会返回Nak。<br></div></div>";
echo "<br><center><img src=./pcie_pic/204224514049.png /></center><br>";
echo "<font size=6 color=#ff0000><center><a name=pcie05></a>PCIe学习（五）</center></font><br><br>";
echo "<font size=4 color=black><div class=container><div class=text>PCIe学习（五）4 物理层逻辑子模块<br>
4.1 介绍<br>
物理层分为两部分，逻辑子块（Logical Sub-block）和电气子块（Electrical Sub-block）。</div></div>";
echo "<br><center><img src=./pcie_pic/204316204787.png /></center><br>";
echo "<br><center><img src=./pcie_pic/204320549031.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>逻辑子块负责与数据链路层连接，电气子块负责链路上的电气问题。与事务层和数据链路层一样，物理层在内部也分为发送和接收两个部分。<br>
PCIe Gen 1的链路速率是2.5GT/s；Gen 2的链路速率是5.0GT/s；Gen 3的链路速率是8.0GT/s；从Gen 3往后，每一新版本的速率翻倍。<br>
虽然在物理层上Gen 1/2和后面的版本差别较大。但是PCIe新版本需要向前兼容旧版本，而且PCIe的链路训练始终是从2.5GT/s开始，逐渐向上提高速率至链路两端支持的最高速率。比如，对于Gen 5，链路速率是从2.5GT/s -> 5GT/s -> 8GT/s -> 16GT/s -> 32GT/s。虽然在Gen 4开始支持旁路均衡（Bypass Equalization）功能，比如对与Gen 5允许链路训练2.5GT/s -> 5GT/s -> 32GT/s，但最初的速率依然是2.5GT/s。综上，物理层的学习有必要考虑Gen 1/2。<br>
本章介绍逻辑子块，第八章介绍电气子块。<br>
4.2 逻辑子块<br>
逻辑子块有两个主要部分：发送部分，用于从数据链路层接收数据，以供电气子块传输；接收部分，用于在将接收信息传递到数据链路层。<br>
当链路速率为2.5GT/s（Gen-1）或5.0GT/s（Gen-2）时，逻辑子块采用8b/10b编码；当链路速率为8GT/s（Gen-3）或者更高时，逻辑子块采用128b/130b编码。<br>
在物理层逻辑子块的发送部分中，数据流向参考下图。流入的数据源有四个<br>
    TLP或DLLP<br>
    控制字符，指示数据包的起始和结束标志<br>
    逻辑空闲，当链路上没有数据传输，处于逻辑空闲状态时，为了防止链路接收端的PLL发生漂移，发送端需要在链路的所有Lane上持续发送逻辑空闲序列<br>
    有续集，用于链路管理</div></div>";
echo "<br><center><img src=./pcie_pic/20432844177.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>只有TLP和DLLP是从数据链路层传输过来的，需要保存在Tx Buffer中；其余三个源都是逻辑子块内部产生的。后面会介绍什么是控制字符，逻辑空闲，有续集。<br>
接下来是字节条带化（Byte Stripping）。PCIe的一对收发链路称作一条Lane。虽然PCIe是串行总线，但协议允许链路上存在多Lane。比如x8表示该PCIe链路有8条Lane。对于多Lane的链路，逻辑子块会将TLP或者DLLP拆分成字节，然后按照顺序分配给每条Lane进行传输，这一拆分过程称作字节条带化。</div></div>";
echo "<br><center><img src=./pcie_pic/2043367769.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>然后是数据加扰和编码过程。所谓加扰是将源数据流与一个随机序列异或后，再发送出去。此时被发出的数据流也基本是伪随机的，从而降低了发送数据时产生的EMI噪声。当链路速率为2.5GT/s（Gen-1）或8GT/s（Gen-2）时，逻辑子块采用8b/10b编码；当链路速率为8GT/s（Gen-3）或者更高时，逻辑子块采用128b/130b编码。实际上，128b/130b编码只是在原始的128-bit前面加上Sync Header，所以下图中Gen3 Scrambler后面没有画出编码模块。<br>
这里需要注意，PCIe链路上不会传输时钟信号，链路的发送端将时钟信息隐藏在数据流中，而链路的接收端需要从数据流中提取出时钟信息，这一技术称为CDR（Clock Data Recovery）。原理其实不难理解，发送端的数据信号是随着时钟频率变化的，只要数据信号变化足够多（即连续1或者0的机率少且短），那么数据流是能够反应出时钟信息的。对于Gen1/2，逻辑子块的发送部分就是通过编码来完成数据流中加入时钟信息的，所以其数据流要先加扰再编码。反过来的话，编码过程的时钟信息就会被加扰过程破坏。但是对于Gen 3和后续版本，128b/130b并没有对数据进行编码，因此可能会存在连续0或者1的情况。为了解决这一问题，要通过加扰来完成。加扰的算法不展开了。对于多Lane情况，每条Lane可以用自己的加扰种子（Seed），以降低相邻Lane间的电气干扰。如果是x16或者x32，可以循环使用加扰种子，比如Lane 0/8/16用相同的种子，Lane 1/9/17用相同的种子，以此类推。对于有续集来说，PCIe协议规定了有续集的数据格式，已经考虑了消除连续0或1的情况。因此除了TS1和TS2，其它的有续集不用加扰。对于TS1和TS2，Symbol 0不会加扰，Symbol 1-13会加扰，Symbol 14-15是否加扰取决于扰码器逻辑。<br>
最后，要对数据流做并串转换，将每条Lane对应并行的数据转换成串行数据发送出去。<br>
逻辑子块的接收部分的数据流向刚好与发送部分反过来，先将接收到的串行数据流转成并行；然后做解码和解扰；再然后是字节反条带化，将所有Lane的字节数据组在一起，恢复出完整TLP和DLLP，保存在Rx Buffer中。</div></div>";
echo "<br><center><img src=./pcie_pic/204342379138.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>4.2.1 编码（2.5 GT/s，5.0 GT/s）<br>
4.2.1.1 字符编码（8b/10b）<br>
在PCIe Gen-1/2中，采用8b/10b编码。在发送部分中，将从数据链路层传递过来的每8-bit编码成10-bit；相应的，接收部分需要将接收到的10-bit解码成8-bit。编码后的10-bit被称为一个字符（Symbol）。</div></div>";
echo "<br><center><img src=./pcie_pic/204401633987.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>8b/10b编码是IBM公司发明的，其基本原理是将原始的8-bit拆分成3-bit和5-bit两部分，分别编码成4-bit和6-bit，即分别做3b/4b和5b/6b编码，最后合成10-bit。8b/10b编码的好处是：<br>
    减少连续0或1的长度，有利于时钟恢复<br>
    有利于直流均衡<br>
    有利于错误检测<br>
8b/10b编码具体原理略过。<br>
在8b/10b编码中，有数字字符（Data Symbol）和控制字符（Control Symbol）之分，分别用D和K表示。所谓控制字符，是8b/10b编码方案提供的一些特殊字符，这些特殊字符用于后面会介绍的各种链路管理机制，也叫K字符。PCIe协议中使用的K字符如下表所示。</div></div>";
echo "<br><center><img src=./pcie_pic/204408335449.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>8b/10b带来一个问题，就是链路利用效率不高，直接浪费了20%。<br>
4.2.1.2 字符应用<br>
字符有两种应用：一是构成有续集（Ordered Sets），二是构成TLP/DLLP。有续集和TLP/DLLP在multi-Lane链路上的发送规则不一样。<br>
完整的有序集同时出现在multi-Lane链路的所有Lane上。<br>
对于TLP和DLLP来说，会包含很多字符，形成一个字符流。某些K字符用于指示TLP或者DLLP的起始或停止边界，这些K字符也叫做“帧字符（Framing Symbol）”。SDP（K28.2）用于指示DLLP起始，STP（K27.7）用于指示TLP起始，END（K29.7）用于指示TLP或DLLP结束，EDB（K30.7）用于指示格式错误的TLP结束。</div></div>";
echo "<br><center><img src=./pcie_pic/204414273454.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>对于multi-Lane链路来说，第一个字符放在Lane 0发送，第二个字符放在Lane 1发送，以此类推。</div></div>";
echo "<br><center><img src=./pcie_pic/20441933681.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div>4.2.1.3 数据加扰<br>
在逻辑子块的发送部分中，要对数据进行加扰（scrambling），打乱原来的比特流；相应的在接收部分就要做解扰（de-scrambling）。<br>
加扰的好处是降低EMI干扰。具体的加扰算法和规则就不介绍了。<br>
4.2.2 编码（8.0 GT/s，及更高速率）<br>
在PCIe Gen3和更高版本中，采用128b/130b编码。<br>
4.2.2.1 Lane编码（128b/130b）<br>
128b/130b编码的原理是在原始的每128-bit作为有效负载，前面加上2-bit的Sync Header。这个130b被称为一个“块（block）”。Sync Header为01b表示后面的128-bit是Ordered Sets；10b表示后面是数据（TLP，DLLP等）；00b和11b是非法值。</div>";
echo "<br><center><img src=./pcie_pic/204426309491.png /></center><br>";
echo "<br><center><img src=./pcie_pic/204433707698.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>所以在128b/130b编码中，一个字符是8-bit。<br>
4.2.2.2 有续集块<br>
有续集块是由Sync Header（01b）和有续集组成。有续集的第一个字符指明了该有续集的类型，随后的字符需要遵守该有续集类型的定义。关于有续集，会在后面详细说明。<br>
Gen 3中的有续集包括：<br>
    SOS（Skip Ordered Set）：<br>
    EIOS（Electrical Idle Ordered Set）<br>
    EIEOS（Electrical Idle Ordered Set）<br>
    TS1/TS2<br>
    FTS（Fast Training Sequence Ordered Sets）<br>
    SDS（Start of Data Stream Ordered Sets）<br>
除了SOS外，其余有续集均为16-byte大小。下图左侧是FTS有续集的格式，右侧是有续集指示字符，也就是有续集中的第一个字符。</div></div>";
echo "<br><center><img src=./pcie_pic/204444174797.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>与Gen 1/2中不同，Gen 3的发送端在发送数据流前，需要先发送SDS有续集，指示后面将开始发送数据流；在所有数据流发完后要有EDS令牌，表示数据发完了，随后发送的是EIOS或者EIEOS有续集。EDS令牌总是占据数据块的最后四个符号。例外情况是SOS（SKP），可以穿插在数据流中发送，用来做链路发送端与接收端的时钟偏差补偿。<br>
4.2.2.3 数据块<br>
数据块的有效负载是数据流，数据流包含帧令牌（Framing Tokens），TLP，DLLP。<br>
Gen 3没有继续用8b/10b编码，因此也就没有控制字符。要是想在数据块中增加额外信息，就必然要定义一些特殊的数据结构，就是帧令牌，也可以简称令牌。在PCIe协议基础规范中，术语Framing Token和Token是一个意思。<br>帧令牌指定相关的字符数量，和下一个帧令牌的位置。帧令牌有以下五种：</div></div>";
echo "<br><center><img src=./pcie_pic/204449675312.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>每种帧令牌的具体定义如下图。</div></div>";
echo "<br><center><img src=./pcie_pic/20445440528.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>TLP或DLLP数据块的布局如下图所示。TLP数据块起始是4个字符的STP，然后是TLP，最后是4字符的LCRC。</div></div>";
echo "<br><center><img src=./pcie_pic/204502829632.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>数据流的第一个帧令牌总是占用第一个数据块的Lane 0的Symbol 0中。下图是x8链路的示例，可以看到，STP占用Lane 0-3的Symbol 0。</div></div>";
echo "<br><center><img src=./pcie_pic/204508437775.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>4.2.2.4 加扰<br>略过<br>4.2.2.5 预编码（Precoding）<br>
接收端采用DFE（决策反馈均衡器）进行判决，在32 GT/s速率下比16 GT/s更容易发生连续突发错误（Burst Error）。为了减少Burst Error的发生，Gen 5速率下可以选配预编码（Precoding）。Precoding仅适用于32 GT/s及以上速率，其他速率时不开启。PCIe链路的Rx 通过EQ TS2请求Tx开启 Precoding。<br>
Precoding可以把连续多比特的Burst Error拆分为2-bit的Entry Error及Exit Error，从而达到消除Burst Error的目的。对于单比特的突发错误，开启Precoding后会变成2-bit 错误，从而使系统误码率BER会提升为之前的两倍。<br>
Precoding发生于Tx Scramble之后，Rx De-scramble之前。开启Precoding不会影响信号质量及完整性。</div></div>";
echo "<br><center><img src=./pcie_pic/204514890488.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>4.2.2.6 128b/130b环回<br>
环回用于测试和故障隔离。PCIe协议仅指定了进入环回模式和退出环回模式的行为，所有其他细节都是特定于实现的。<br>
4.2.3 链路均衡（8.0 GT/s，及更高速率）<br>
在PCIe链路传输中，由于电磁干扰，信号衰减失真或比特同步错误等原因，会改变数据流的比特数据，造成错误。比特出错概率（Bit Error Ratio，BER），是一个时间间隔内错误比特的数目与传送的总比特数的比值，通常以百分比表示。当BER过高，说明链路质量很差，可能会导致链路重新训练或者是链路不能正常工作。<br>
在Gen 1/2中，使用固定的Tx去加重参数即可实现良好的信号质量。但是到了Gen 3，链路速率达到8GT/s，信号完整性问题变得严重。<br>
链路均衡过程使组件能够在8.0GT/s和更高的数据速率下运行时，调整每个Lane的发射机和接收机设置，以提高信号质量。<br>
链路均衡过程必须在第一次数据速率改变为8.0GT/s或更高的任何数据速率期间执行。如果链路上的组件不需要此过程，则需要在链路训练期间通过TS1/TS2有续集向对端组件公布此信息，从而绕过链路均衡过程。PCIe协议要求，当组件的物理层通知数据链路层其已准备好时（LinkUp=1），组件的物理层发射机参数必须提前设置好，也就是均衡过程完成。<br>
概念介绍<br>
在分析链路均衡之前，需要介绍几个概念。<br>
为了实现更好的波形整形，PCIe协议规范要求发射机使用3抽头的FIR（有限脉冲响应）滤波器。</div></div>";
echo "<br><center><img src=./pcie_pic/204521323651.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>FIR滤波器的三个输入可以通过它们的时间位置描述为“pre-cursor”C‐1、 “cursor”C0，“post-cursor”C+1，它们组合起来产生基于即将到来的输入、当前值，先前值的输出。调整抽头的系数可以使输出波得到最佳的整形。<br>
滤波器根据分配给每个抽头的系数值（或抽头权重）对输出进行整形。三个系数幅度的绝对值之和是1，因此只需要给出其中的两个，就可以计算第三个。因此，规范中只给出了C-1和C+1，因此C0总是隐含的，并且总是正的。</div></div>";
echo "<br><center><img src=./pcie_pic/204528436590.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>系数值的作用是调整输出电压，以创建多达四个不同的电压电平，以适应不同的信号环境。<br>
下图显示了要传输的四种通用电压电平，它们是：maximum‐height (Vd)，normal (Va)，de‐emphasized (Vb)，pre‐shoot (Vc)。<br>
如果C-1和C+1都为0（C0为1.0），则Vc最大值就是信号的大小。</div></div>";
echo "<br><center><img src=./pcie_pic/204533885369.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>当链路准备好从5.0GT/s变为8.0GT/s，下游端口DSP需要通过EQ TS2向上游端口USP发送一组预设值（preset）值，作为测试信号质量的起点。PCIe协议规范定义了11组预设值，如下图。</div></div>";
echo "<br><center><img src=./pcie_pic/204538610825.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>如果使用预设值，链路的BER达到了10-12，则无需进一步训练。但是，如果BER过高，则使用均衡序列来微调系数设置，尝试不同的C‐1和C+1值并重新评估结果，并重复该序列直到达到所需的信号质量或错误率。<br>
链路均衡阶段<br>
链路均衡过程最多由四个阶段（Phase）组成，使用TS1有序集中的均衡控制（Equalization Control，EC）字段来传递Phase信息。<br>
在PCIe协议规范中，使用下游端口和上游端口来分析链路均衡。如果理解不方便，可以将下游端口换成RC，上游端口换成EP，可能会更好理解下面的分析。<br>
Phase 0<br>
Phase 0，下游端口的LTSSM进入Recovery.RcvrCfg状态，通关EQ TS2向上游端口发送Tx Presets和Rx Hints。下游端口发送的Tx Presets值是基于自己的Equalization Control寄存器。需要注意的是，可能每条Lane的均衡值不同。下游端口将其Equalization Control寄存器中DSP值用于自己的发射机和接收机，将USP值发送给上游端口。</div></div>";
echo "<br><center><img src=./pcie_pic/204545399348.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>x Preset字段的编码如下表：<br>
Encoding** 	De-emphasis** 	Pre-shoot**<br>
0000b** 	-6 	0<br>
0001b** 	-3.5 	0<br>
0010b** 	-4.5 	0<br>
0011b** 	-2.5 	0<br>
0100b** 	0 	0<br>
0101b** 	0 	2<br>
0110b** 	0 	2.5<br>
0111b** 	-6 	3.5<br>
1000b** 	-3.5 	3.5<br>
1001b** 	0 	3.5<br>
1010b** 	Depends on FS and LS values 	Depends on FS and LS values<br>
1011-1111b** 	Reserved 	Reserved<br>
Rx Hint字段的编码如下表：<br>
Encoding** 	Rx Preset Hint**<br>
000b** 	-6dB<br>
001b** 	-7dB<br>
010b** 	-8dB<br>
011b** 	-9dB<br>
100b** 	-10dB<br>
101b** 	-11dB<br>
110b** 	-12dB<br>
111b** 	Reserved<br>
一旦链路速率变化，下游端口开始进入Phase 1，发送TS1（EC=01b），等待上游端口也进入Phase 1。此时上游端口启动Phase 0，发送TS1与先前从EQ TS1和EQ TS2接收到的Preset值相呼应的TS1。上游端口使用下游端口请求的Tx Preset和Rx Hints。上游端口在评估输入信号之前可以等待500ns，但一旦能够识别出连续两个TS1，就可以为下一步做好准备，因为这意味着信号质量满足10-4的BER。随后，上游端口在其TS1中设置EC=01b，从而也进入第Phase 1，并将下一步的控制权交给下游端口。</div></div>";
echo "<br><center><img src=./pcie_pic/204553397095.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>Phase 1<br>
Phase 1同样的，下游端口识别出上游端口发出的连续两个TS1，意味着信号质量满足10-4的BER。一旦下游端口识别出上游端口发过来的TS1（EC=01b），确信链路工作良好，则Phase 1完成。下游端口通过设置其EC=10b启动Phase 2，并将下一步的控制权交给上游端口。当上游端口响应EC=10b时，两个端口都进入Phase 2。作为一个替代方案，下游端口如果确定信号质量已经足够好，不需要进一步调整，在这种情况下，它将其设置EC=00b直接退出均衡过程。</div></div>";
echo "<br><center><img src=./pcie_pic/204558849491.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>Phase 2<br>
Phase 2，上游端口可以请求下游端口设置其Tx参数，评估信号质量，并重复该过程，直到达到当前环境的最佳设置。为了进行请求，上游端口改变在其TS1中发送的均衡系数值，并根据接收到的下游端口的有续集评估链路质量。</div></div>";
echo "<br><center><img src=./pcie_pic/20460416188.png /></center><br>";
echo "<br><center><img src=./pcie_pic/204610792292.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>Phase 3<br>
Phase 3，下游端口通过发送EC=11b进行响应，现在可以对上游端口的发射机进行相同的信号评估过程。</div></div>";
echo "<br><center><img src=./pcie_pic/204615257430.png /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text>综上所述，Phase 0和1是对链路系数进行粗调，Phase 2和3是对链路系数进行细调。如果粗调就能满足链路BER要求，可以放弃Phase 2和3，直接退出链路均衡过程。<br>
整个链路均衡过程在LTSSM状态机的Recovery状态控制下。<br>
物理层是PCIe里面最复杂的，我的理解有限，估计有的地方理解不到位或者就错了，大家尽管指出，帮我提升，哈哈~~<br>【待续】</div></div>";
echo "<font size=6 color=#ff0000><center><a name=pcie06></a>PCIe学习（六）</center></font><br><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<br><center><img src=./pcie_pic/ /></center><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<font size=6 color=#ff0000><center><a name=pcie07></a>PCIe学习（七）</center></font><br><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<font size=6 color=#ff0000><center><a name=pcie08></a>PCIe学习（八）</center></font><br><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<font size=6 color=#ff0000><center><a name=pcie09></a>PCIe学习（九）</center></font><br><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
?>
