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
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<font size=6 color=#ff0000><center><a name=pcie03></a>PCIe学习（三）</center></font><br><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<font size=6 color=#ff0000><center><a name=pcie04></a>PCIe学习（四）</center></font><br><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<font size=6 color=#ff0000><center><a name=pcie05></a>PCIe学习（五）</center></font><br><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<font size=6 color=#ff0000><center><a name=pcie06></a>PCIe学习（六）</center></font><br><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<font size=6 color=#ff0000><center><a name=pcie07></a>PCIe学习（七）</center></font><br><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<font size=6 color=#ff0000><center><a name=pcie08></a>PCIe学习（八）</center></font><br><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
echo "<font size=6 color=#ff0000><center><a name=pcie09></a>PCIe学习（九）</center></font><br><br>";
echo "<font size=4 color=black><div class=container><div class=text></div></div>";
?>
