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
echo "<table width=100%><tr><td><a href=pci_pcie.php#pci01>PCI总线基本概念</a></td><td><a href=pci_pcie.php#pci02>PCI总线周期</a></td>
<td><a href=pci_pcie.php#pci03>PCI总线中的Reflected-Wave Signaling</a></td><td><a href=pci_pcie.php#pci04>PCI总线的三种传输模式</a></td><td><a href=pci_pcie.php#pci05>PCI总线的中断和错误处理</a></td></tr><tr><td><a href=pci_pcie.php#pci06>PCI总线的地址空间分配</a></td><td><a href=pci_pcie.php#pci07>PCI总线配置周期产生和配置寄存器</a></td><td><a href=pci_pcie.php#pci08>PCI总线66MHz的技术瓶颈</a></td><td><a href=pci_pcie.php#pci09>PCI-X总线基本概念</a></td></tr></table><br><br>";
echo "<font size=6 color=#ff0000><center><a name=pci01></a>一、PCI总线基本概念 </center></font><br><br>";
echo "<font size=4 color=black><div class=container><div class=text>
PCI是Peripheral Component Interconnect(外设部件互连标准)的缩写，它曾经是个人电脑中使用最为广泛的接口，几乎所有的主板产品上都带有这种插槽。目前该总线已经逐渐被PCI Express总线所取代。PCI即Peripheral Component Interconnect，中文意思是“外围器件互联”，是由PCISIG (PCI Special Interest Group)推出的一种局部并行总线标准。PCI总线是由ISA(Industy Standard Architecture)总线发展而来的，是一种同步的独立于处理器的32位或64位局部总线。从结构上看，PCI是在CPU的供应商和原来的系统总线之间插入的一级总线，具体由一个桥接电路实现对这一层的管理，并实现上下之间的接口以协调数据的传送。从1992年创立规范到如今，PCI总线已成为了计算机的一种标准总线，广泛用于当前高档微机、工作站，以及便携式微机。主要用于连接显示卡、网卡、声卡。注：ISA并行总线有8位和16位两种模式，时钟频率为8MHz，工作频率为33MHz/66MHz。PCI总线是一种树型结构，并且独立于CPU总线，可以和CPU总线并行操作。PCI总线上可以挂接PCI设备和PCI桥，PCI总线上只允许有一个PCI主设备（同一时刻），其他的均为PCI 从设备，而且读写操作只能在主从设备之间进行，从设备之间的数据交换需要通过主设备中转。注：这并不意味着所有的读写操作都需要通过北桥中转，因为PCI总线上的主设备和从设备属性是可以变化的。比如Ethernet和SCSI需要传输数据，可以通过一种叫做Peer-to-Peer的方式来完成，此时Ethernet或者SCSI则作为主机，其它的设备则为从机。具体会在后面的博文中详细介绍。</div></div>";
echo "<br><center><img src=./214745766684.png /></center><br>";
echo "<div class=container><div class=text>一个典型的33MHz的PCI总线系统如上图所示，处理器通过FSB与北桥相连接，北桥上挂载着图形加速器（显卡）、SDRAM（内存）和PCI总线。PCI总线上挂载着南桥、以太网、SCSI总线（一种老式的小型机总线）和若干个PCI插槽。<br>
CD和硬盘则通过IDE连接至南桥，音频设备以及打印机、鼠标和键盘等也连接至南桥，此外南桥还提供若干的USB接口。<br>
PCI总线是一种共享总线，所以需要特定的仲裁器（Arbiter）来决定当前时刻的总线的控制权。一般该仲裁器位于北桥中，而仲裁器（主机）则通过一对引脚，REQ#（request） 和GNT# （grant）来与各个从机连接。如下图所示：</div></div>";
echo "<br><center><img src=./214756868463.png /></center><br>";
echo "<div class=container><div class=text>需要注意的是，并不是所有的设备都有能力成为仲裁器（Arbiter）或者initiator 。<br>
最初的PCI总线的时钟频率为33MHz，但是随着版本的更新，时钟频率也逐渐的提高。但是由于PCI采用的是一种Reflected-Wave Signaling信号模型（后面会详细的介绍），导致了时钟频率越高，总线的最大负载越少，如下图所示：</div></div>";
echo "<br><center><img src=./2148089120.png /></center><br>";
echo "<div class=container><div class=text>到了PCI-X2.0版本，整个总线就只能插一个PCI卡了（相当于两个PCI负载），为了能够在主板上提供更多的插槽，则必须通过连接多个PCI桥来实现（后面会详细地介绍）。</div></div>";
echo "<br><font size=6 color=#ff0000><center><a name=pci02></a>二、PCI总线周期 </center></font><br><br>";
echo "<div class=container><div class=text>PCI总线是一种地址和数据复用的总线，即地址和数据占用同一组信号线AD。PCI总线的所有信号都与时钟信号同步，及所有的信号的变化都发生在时钟的上升沿，或者在时钟上升沿进行采样。<br>
如下图所示，除了时钟信号CLK和数据地址复用信号AD之外，PCI总线至少还应包括FRAME#（用于表示一次数据传输的起始）、C/BE#（Command/Byte Enable）、IRDY#（Initiator Ready for data）、TRDY#（Target ready）、
DESEL#（Device Selec，片选信号，用于选择PCI设备）和GNT#（Grant）信号等。<br>注：完整的信号时序图，请参考PCI Spec。信号名后面的#表示该信号低电平有效。下面来介绍一个简单的例子，主机接收来自特定从机的数据。</div></div>";
echo "<br><center><img src=./214947264197.png /></center><br>";
echo "<div class=container><div class=text>如上图所示：
1、在第一个时钟上升沿，FRAME#和IRDY#都为inactive，表明总线当前处于空闲状态。与此同时，某个设备的GNT#信号处于active，表明总线总裁器已经选定当前设备为下一个initiator（可以理解为主机）。<br>
2、在第二个时钟上升沿，FRAME#被initiator拉低，表明新的事务（Transaction）已经开始。与此同时，地址和命令被依次发送到AD上，总线上面的所有其他设备（从机）都会锁存这些信息，并检查地址和命令是否与自己匹配。<br>
3、在第三个时钟上升沿，IRDY#处于active状态，表明主机准备就绪，可以接收数据了。AD信号上的旋转的箭头表示AD信号目前处于三态状态（处于输出和输入的转换状态），即Turn‐around cycle。需要注意的是，此时的TRDY#应当处于inactive状态，以保证Turn‐around cycle顺利进行。<br>
4、在第四个时钟上升沿，PCI总线上的某个从机确认身份，并依次将DEVSEL#信号和TRDY#拉低，并将相应的数据输出到AD上。此时，FRAME#信号为active状态，表明这并不是最后一个数据。<br>
5、在第五个时钟上升沿，TRDY#处于inactive状态，表明从机尚未就绪，因此所有的操作暂缓一个时钟周期（或者说插入了一个Wait State）。PCI总线最多允许8个这样的Wait State。<br>
6、在第六个时钟上升沿，从机向主机发送第二个数据。此时，FRAME#信号依旧为active状态，表明这并不是最后一个数据。<br>
7、在第七个时钟上升沿，IRDY#处于inactive状态，表明主机尚未就绪，再次插入一个Wait State。但是此时从机依旧可以向AD上发送数据。<br>
8、在第八个时钟上升沿，AD上的第三个数据被发送至主机，由于此时FRAME#信号被拉高，即inactive，表明这是本次事务（Transaction）的最后一个数据。此后，所有的控制信号均被拉高，处于inactive状态，AD、FRAME#和C/BE#处于三态状态。</div></div>";
echo "<br><font size=6 color=#ff0000><center><a name=pci03></a>三、PCI总线中的Reflected-Wave Signaling</center></font><br><br>";
echo "<div class=container><div class=text>PCI Spec规定了每个PCI总线上最多可以连接多达32个PCI设备，但是实际上却远远达不到32个，33MHz的32位PCI总线一般只能连接10到12个负载。注：如果使用插槽连接，则一个连接算两个PCI设备，插槽和PCI卡分别算作一个PCI设备。
也就是说一个33MHz的PCI总线最多只能连接4到5个插槽即PCI卡。这是因为PCI总线在设计的时候，为了降低功耗，采用了一种叫做reflected‐wave signaling的技术，如下图所示：</div></div>";
echo "<br><center><img src=./215228577290.png /></center><br>";
echo "<div class=container><div class=text>由图可知，为了降低功耗PCI设备的发送端采用了一种 weak transmit buffers，其只能驱动信号电平达到实际需求的一半。然后依靠反射回来的信号叠加到原本的信号上，使得信号电平达到实际的需求。当然，所有的这些过程<br>
都要求在一个时钟周期内完成，这种机制也限制了PCI总线频率的提高，也限制了单个PCI总线上的最大连接设备的数量。如果需要连接更多的PCI设备，则需要借助PCI-to-PCI桥，每个桥的内部都有隔离，这保证了每个桥又可以连接额外的10~12个负载。<br>
但是PCI Spec规定了，一个PCI总线系统中，最多只能有256个子总线。注：熟悉信号完整性分析的朋友应该知道，在高速信号传输中，反射往往会导致信号的形变，使得信号质量变差，误码率变高，甚至信号收发异常，传输中断。<br>然而，在一些特定的领域（比如PCI总线），合理地使用反射机制，可以达到降低功耗等效果。不过，相对于目前的很多高速串行信号，PCI总线算是很慢的信号了，像PCI总线这种利用反射机制降低功耗的，几乎不可能在高速信号得到应用。</div></div>";
echo "<br><center><img src=./215241778061.png /></center><br>";
echo "<div class=container><div class=text>此外，PCI总线的Input Buffer还没有加输入寄存器，这对信号的Setup时间提出了更高的要求。一个包含PCI-to-PCI桥的33MHz PCI总线系统的架构图如下所示：</div></div>";
echo "<br><center><img src=./215252913387.png /></center><br>";
echo "<br><font size=6 color=#ff0000><center><a name=pci04></a>四、PCI总线的三种传输模式</center></font><br><br>";
echo "<div class=container><div class=text>本文来简单地介绍一下PCI Spec规定的三种数据传输模型：Programmed I/O（PIO），Peer-to-Peer和DMA。三种数据传输模型的示意图如下图所示：</div></div>";
echo "<br><center><img src=./21540827682.png /></center><br>";
echo "<div class=container><div class=text>首先来介绍一下Programmed I/O（PIO）
PIO在早期的PC中被广泛使用，因外当时的处理器的速度要远远大于任何其他外设的速度，所以PIO足以胜任所有的任务。举一个例子，比如说某一个PCI设备需要向内存（SDRAM）中写入一些数据，该PCI设备会向CPU请求一个中断，然后CPU首先先通过PCI
总线把该PCI设备的数据读取到CPU内部的寄存器中，然后再把数据从内部寄存器写入到内存（SDRAM）中。现在看来，这种传输方式的效率还是很低的。首先，每次CPU和PCI设备以及SDRAM通信都需要额外的时钟周期（相对于DMA）；<br>其次，这种传输方式还需要长时间地占用CPU，影响CPU的使用率。试想一下，你在用PC在线观看一个1080p60的高清视频，这需要以太网连续地向内存（SDRAM）中写入数据，如果使用PIO的方式的话，将难以保证数据的写入速度。随着目前的PCI外设速度越来越高，PIO已经逐渐被DMA传输方式所取代，但是为了兼容早期的一些设备，PCI Spec依然保留了PIO。<br>
DMA，即Direct Memory Access<br>
DMA是一种在传输过程中，几乎不需要CPU进行干预的数据传输方式。如上面的图片所示，以太网可以直接向内存（SDRAM）中写入数据，而几乎不需要CPU的干预。实际上，DMA不仅仅应用于PCI总线系统中，它是一种更为广泛应用的数据传输方式。目前，几乎所有的CPU，甚至是MCU都支持DMA。具体这里就不详细地介绍了，有兴趣的可以参考百度百科：https://baike.baidu.com/item/DMA/2385376<br>
Peer-to-Peer<br>
前面的文章中，我们介绍过PCI总线系统中的主机身份并不是固定不变的，而是可以切换的（借助仲裁器），但是同一时刻只能存在一个主机。完成Peer-to-Peer这一传输方式的前提是，PCI总线系统中至少存在一个有能力成为主机的设备。在仲裁器的控制下，完成主机身份的切换，进而获得PCI总线的控制权，然后与总线上的其他PCI设备进行通信。不过，需要注意的是，在实际的系统中，Peer-to-Peer这一传输方式却很少被使用，这是因为获得主机身份的PCI设备（Initiator）和另一个PCI设备（Target）通常采用不同的数据格式，除非他们是同一个厂家的设备。</div></div>";
echo "<br><font size=6 color=#ff0000><center><a name=pci05></a>五、PCI总线的中断和错误处理 </center></font><br><br>";
echo "<div class=container><div class=text>PCI总线使用INTA#、INTB#、INTC#和INTD#信号向处理器发出中断请求。这些中断请求信号为低电平有效，并与处理器的中断控制器连接。在PCI体系结构中，这些中断信号属于边带信号（Sideband Signals），PCI总线规范并没有明确规定在一个处理器系统中如何使用这些信号，因为这些信号对于PCI总线是可选信号。所谓边带信号是指这些信号在PCI总线中是可选信号，而且只能在一个处理器系统的内部使用，并不能离开这个处理器环境。<br>
注：PCI Spec对边带信号的定义如下：<br>
Any signal not part of the PCI specification that connects two or more PCI-compliant agents and has meaning only to those agents.<br>
完整的PCI信号结构图如下：</div></div>";
echo "<br><center><img src=./215522596164.png /></center><br>";
echo "<div class=container><div class=text>中断信号与中断控制器的连接关系<br>
PCI总线规范没有规定PCI设备的INTx信号如何与中断控制器的IRQ_PINx#信号相连，这为系统软件的设计带来了一定的困难，为此系统软件使用中断路由表存放PCI设备的INTx信号与中断控制器的连接关系。在x86处理器系统中，BIOS可以提供这个中断路由表，而在PowerPC处理器中Firmware也可以提供这个中断路由表。在一些简单的嵌入式处理器系统中，Firmware并没有提供中断路由表，此时系统软件开发者需要事先了解PCI设备的INTx信号与中断控制器的连接关系。此时外部设备与中断控制器的连接关系由硬件设计人员指定。我们假设在一个处理器系统中，共有3个PCI插槽(分别为PCI插槽A、B和C)，这些PCI插槽与中断控制器的IRQ_PINx引脚(分别为IRQW#、IRQX#、IRQY#和IRQZ#)可以按照下图所示的拓扑结构进行连接。</div></div>";
echo "<br><center><img src=./215538570270.png /></center><br>";
echo "<div class=container><div class=text>此时，PCI插槽A、B、C的INTA#、INTB#和INTC#信号将分散连接到中断控制器的IRQW#、IRQX#和IRQY#信号，而所有INTD#信号将共享一个IRQZ#信号。采用这种连接方式时，整个处理器系统使用的中断请求信号，其负载较为均衡。而且这种连接方式保证了每一个插槽的INTA#信号都与一根独立的IRQx#信号对应，从而提高了PCI插槽中断请求的效率。在一个处理器系统中，多数PCI设备仅使用INTA#信号，很少使用INTB#和INTC#信号，而INTD#信号更是极少使用。在PCI总线中，PCI设备配置空间的Interrupt Pin寄存器记录该设备究竟使用哪个INTx信号。<br>
中断信号与PCI总线的连接关系<br>
在PCI总线中，INTx信号属于边带信号。PCI桥也不会处理这些边带信号。这给PCI设备将中断请求发向处理器带来了一些困难，特别是给挂接在PCI桥之下的PCI设备进行中断请求带来了一些麻烦。在一些嵌入式处理器系统中，这个问题较易解决。因为嵌入式处理器系统很清楚在当前系统中存在多少个PCI设备，这些PCI设备使用了哪些中断资源。在多数嵌入式处理器系统中，PCI设备的数量小于中断控制器提供的外部中断请求引脚数，而且在嵌入式系统中，多数PCI设备仅使用INTA#信号提交中断请求。<br>
在这类处理器系统中，可能并不含有PCI桥，因而PCI设备的中断请求信号与中断控制器的连接关系较易确定。而在这类处理器系统中，即便存在PCI桥，来自PCI桥之下的PCI设备的中断请求也较易处理。在多数情况下，嵌入式处理器系统使用的PCI设备仅使用INTA#信号进行中断请求，所以只要将这些INTA#信号挂接到中断控制器的独立IRQ_PIN#引脚上即可。这样每一个PCI设备都可以独占一个单独的中断引脚。而在x86处理器系统中，这个问题需要BIOS参与来解决。<br>在x86处理器系统中，有许多PCI插槽，处理器系统并不知道在这些插槽上将要挂接哪些PCI设备，而且也并不知道这些PCI设备到底需不需要使用所有的INTx#信号线。因此x86处理器系统必须要对各种情况进行处理。x86处理器系统还经常使用PCI桥进行PCI总线扩展，扩展出来的PCI总线还可能挂接一些PCI插槽，这些插槽上INTx#信号仍然需要处理。PCI桥规范并没有要求桥片传递其下PCI设备的中断请求。事实上多数PCI桥也没有为下游PCI总线提供中断引脚INTx#，管理其下游总线的PCI设备。但是PCI桥规范推荐使用下面的表建立下游PCI设备的INTx信号与上游PCI总线INTx信号之间的映射关系。</div></div>";
echo "<br><center><img src=./215554241343.png /></center><br>";
echo "<div class=container><div class=text>我们举例说明该表的含义。在PCI桥下游总线上的PCI设备，如果其设备号为0，那么这个设备的INTA#引脚将和PCI总线的INTA#引脚相连；如果其设备号为1，其INTA#引脚将和PCI总线的INTB#引脚相连；如果其设备号为2，其INTA#引脚将和PCI总线的INTC#引脚相连；如果其设备号为3，其INTA#引脚将和PCI总线的INTD#引脚相连。<br>
在x86处理器系统中，由BIOS或者APCI表记录PCI总线的INTA~D#信号与中断控制器之间的映射关系，保存这个映射关系的数据结构也被称为中断路由表。大多数BIOS使用表中的映射关系，这也是绝大多数BIOS支持的方式。如果在一个x86处理器系统中，PCI桥下游总线的PCI设备使用的中断映射关系与此不同，那么系统软件程序员需要改动BIOS中的中断路由表。<br>BIOS初始化代码根据中断路由表中的信息，可以将PCI设备使用的中断向量号写入到该PCI设备配置空间的Interrupt Line register寄存器中。<br>
PCI总线的错误处理<br>
PCI设备可以通过奇偶校检来检测到来自AD上的地址或者数据的错误，并通过PERR#或者SERR#报告错误。但是需要注意的是，PCI Spec并未规定任何硬件层面上的错误处理或者恢复机制，因此，这些错误都只能通过软件进行处理。</div></div>";
echo "<br><font size=6 color=#ff0000><center><a name=pci06></a>六、PCI总线的地址空间分配</center></font><br><br>";
echo "<div class=container><div class=text>PCI总线具有32位数据/地址复用总线，所以其存储地址空间为2的32次方=4GB。也就是PCI上的所有设备共同映射到这4GB上，每个PCI设备占用唯一的一段PCI地址，以便于PCI总线统一寻址。每个PCI设备通过PCI寄存器中的基地址寄存器来指定映射的首地址。
如下图所示：</div></div>";
echo "<br><center><img src=./215700136439.png /></center><br>";
echo "<div class=container><div class=text>注：需要注意的是PCI的地址空间和x86系统中的FSB并不是对等的，而是具有一定的映射关系。PCI体系结构中，一共支持三种地址空间：Memory Address Space、I/O Address Space和Configuration Address Space。其中x86处理器可以直接访问的只有
Memory Address Space和I/O Address Space。而访问Configuration Address Space则需要通过索引IO寄存器来完成。注：在PCIe中，则引入了一种新的Configuration Address Space访问方式：将其直接映射到了Memory Address Space当中。</div></div>";
echo "<br><center><img src=./21571017546.png /></center><br>";
echo "<div class=container><div class=text>如上图所示，最左边的即为Memory Address Space，其中包括了多个PCI Memory、AGP Video（显卡）Memory以及Extended Memory、Boot ROM等。中间的为I/O Address Space，需要注意的是，虽然PCI支持32位的地址，但是由于x86的CPU只支持16位的I/O空间，
这就限制了PCI的I/O Address Space最大只有64KB。最右边的则为Configuration Address Space，由于每一个PCI设备最多支持8种功能（Function），每一条PCI总线最多支持32个设备，而每一个PCI总线系统最多又支持256个子总线（通过PCI桥）。因此，总的
Configuration Address Space的大小为：256 Bytes/function x 8 functions/device x 32 devices/bus x 256 buses/system = 16MB。如图中所示，Configuration Address Space所使用的IO寄存器范围为0xCF8~0xCFF。其中0xCF8~0xCFB为端口地址，0xCFC~0xCFF为配置数据。</div></div>";
echo "<br><font size=6 color=#ff0000><center><a name=pci07></a>七、PCI总线配置周期产生和配置寄存器</center></font><br><br>";
echo "<div class=container><div class=text>上一篇文章中也是说到了，I/O Address Space的空间很有限（64KB），所以一般在I/O Space中都有两个寄存器，第一个指向要操作的内部地址，第二个存放读或者写的数据。因此，对于PCI的配置周期来说，包含了两个步骤：
<br>
Step1：CPU先对IO Address中的0xCF8~0xCFB写入要操作的配置寄存器的地址。如下图所示，其中包括了总线号（Bus Number）、设备号（Device Number）、功能号（Function Number）和寄存器指针。
<br>
Step2：CPU向IO Address中的0xCFC~0xCFF中写入读或者写的数据。</div></div>";
echo "<br><center><img src=./092847693967.png /></center><br>";
echo "<div class=container><div class=text>前面介绍过，每一个PCI功能（Function）都包含256个字节的配置空间（Configuration Space），其中前64个字节被称为Header，剩余的192个字节用于一些可选的功能。PCI Spec规定了两种类型的Header：Type1 和Type0。其中，Type1 Header表示该PCI设备功能为桥（Bridge），而Type0 Header则表示该PCI设备功能不是桥。两种Header的结构图分别如下所示：</div></div>";
echo "<br><center><img src=./092857296031.png /></center><br>";
echo "<br><center><img src=./092901472928.png /></center><br>";
echo "<div class=container><div class=text>注：因为PCIe完整的继承了PCI Header相关的内容，所以关于Header的详细介绍和操作会放在后面关于PCIe的介绍中。</div></div>";
echo "<br><font size=6 color=#ff0000><center><a name=pci08></a>八、PCI总线66MHz的技术瓶颈 </center></font><br><br>";
echo "<div class=container><div class=text>为了能够取得更高的带宽，新版本的PCI Spec将PCI总线提高到了64-bit并将频率提高到了66MHz，最高支持533MB/s。下图描述的是一个典型的66Mhz，64-bit的PCI系统结构图。</div></div>";
echo "<br><center><img src=./21580846013.png /></center><br>";
echo "<div class=container><div class=text>前面的文章介绍过，PCI总线采用了Reflected-Wave Signaling技术，因此总线频率的提高，必然会导致总线负载能力的降低。结果就是，66MHz 64-bit的PCI总线只能支持一个PCI插卡设备（算作两个PCI设备，插槽和PCI卡各算一个）。为了增加整个系统的PCI设备数，就不得不去增加额外的PCI桥，这又进一步增加了功耗，提高了成本。此外，64-bit的PCI总线由于增加了很多的引脚，导致66MHz 64-bit的PCI总线的稳定性降低，对PCB的设计提出了更高的要求，也限制了其广泛应用。
<br>
此外，由于PCI总线采用的是non-registered输入，这要求输入信号的建立时间至少要有3ns，而66MHz的时钟下，周期为15ns，剩余的12ns基本上都被Reflected-Wave Signaling给消耗了。因此，66MHz基本上算是PCI总线的频率的上限了。
<br>
在PCI-X总线中，为了解决上诉问题，PCI-X总线将所有的输入信号都先用寄存器打一拍，此时对输入信号的建立时间的要求就不在那么苛刻了，因此PIC-X总线可以运行在更高的频率上（100MHz，甚至133MHz）。</div></div>";
echo "<br><font size=6 color=#ff0000><center><a name=pci09></a>九、PCI-X总线基本概念  </center></font><br><br>";
echo "<div class=container><div class=text>PCI-X总线在PCI总线的基础上发展而来，其在软件和硬件层面上都是兼容PCI总线的，但是却显著的提高了总线的性能。也就是说PCI-X的设备可以直接插到PCI的插槽中去，PCI的设备也可以直接插到PCI-X的插槽中去。
<br>
从硬件层面上来说，PCI-X继承了PCI总线中的Reflected-Wave Signaling，但是在信号的输入端加入了输入寄存器以增强时序性能，提高了总线的时钟频率。在PCI-X2.0的Spec中还提出了DDR和QDR技术，进一步提高了PCI-X总线的带宽。
<br>
一个典型的PCI-X总线系统的例子如下图所示：</div></div>";
echo "<br><center><img src=./215849553227.png /></center><br>";
echo "<div class=container><div class=text>下面是一个PCI-X 突发读存储操作（Burst Memory Read Bus Cycle）的例子：</div></div>";
echo "<br><center><img src=./215902771617.png /></center><br>";
echo "<div class=container><div class=text>在PCI总线中，以总线主机从从机设备读操作为例，当从机设备尚未准备好结束这次操作（从机设备未就绪，且数据尚未发送完）时，可以通过锁存数据并插入等待周期，或者发起Retry操作。PCI-X总线采用了一种叫做Split Transaction的方式来处理这种情况，如下图所示。此时，发起读操作的总线主机被称为Requester，而接受并向总线上发送数据的从机设备被称为Completer。<br>
注：PCIe Spec中继承了PCI-X的这种命名方式。</div></div>";
echo "<br><center><img src=./215913327433.png /></center><br>";
echo "<div class=container><div class=text>采用这种方式的PCI-X总线的总线传输利用率（效率）可以达到85%，而标准的PCI总线只有50%-60%。关于Split Transaction的详细内容，建议大家去参考PCI-X的Spec，这里不再详细地介绍。此外，PCI-X总线还在配置地址寄存器（Configuration Address Register）中加入了NS（No Snoop）和RO（Relaxed Ordering）两位以提高总线传输效率。
<br>
前面的文章中介绍过，PCI总线的中断操作是通过一系列的边带信号（Sideband Signals）来完成的，在PCI-X Spce中引入了消息信号中断（MSI，Message Signaled Interrupts）的机制，以取代这些边带信号，进而精简系统设计。
<br>
注：关于MSI的详细内容，建议参考PCI-X Spec，此处不再详细介绍。
<br>
在介绍PCI-X2.0中提出的源同步模型之前，首先先来简单地聊一聊非源同步模型的内在问题。所谓非源同步，就是说，信号的发送端和接收端的时钟分别由一个或者两个时钟源驱动，发送端和接受端的时钟同频率，但是却很难保证其同相位（即存在时钟的相位偏差，skew）。</div></div>";
echo "<br><center><img src=./215924514096.png /></center><br>";
echo "<div class=container><div class=text>如上图所示，由于信号线众多，在PCB设计的时候，很难保证每一条信号线的长度都完全相同（更不要说还有过孔等因素）。因此，即使信号在发送时完全沿对沿的（实际上也是不可能的，对于PCI总线来说），也很难保证信号在同一时间到达接收端，此时的信号必然不再是沿对沿的了。如果不同信号线之间的传输延时差异较大，就很容易导致信号在接收端的采样错误，进而提高数据传输的误码率。<br>为了解决这些问题，在PCI-X2.0的Spec中提出了源同步模型（实际上，在目前高速的FPGA逻辑设计和数字ASIC设计中采用的基本上都是源同步的模型）。如下图所示，此时系统的时钟由发送端（即Source Device）直接提供，并和数据信号一同传输至接收端，这就很好地解决非源同步模型中的时钟相位差（Skew）的问题。此外，PCI-X2.0还在接收端输入寄存器的基础上支持了DDR输入，甚至是QDR输入，极大地提高了总线的带宽。64-bit的133MHz PCI-X2.0 QDR总线的带宽甚至达到了惊人的4262MB/s！基本上算是并行总线的巅峰了（DDRx SDRAM不算是总线）。</div></div>";
echo "<br><center><img src=./215937452403.png /></center><br>";
echo "<div class=container><div class=text>然而，有意识的是，PCI-X2.0似乎生不逢时，虽然它显著地提高了PCI总线的带宽，但依旧无法掩盖并行总线在高速总线数据传输中劣势。PCI-X2.0总线虽然性能优异，但是却几乎很少得到应用，由于其高功耗高成本，且并行总线的引脚过多，需要极其复杂的PCB设计，导致PCI-X2.0只在极少数高端的市场中得到了应用（如服务器市场等）。导致PCI-X2.0未能达到大规模应用的另一个因素就是PCI Express（PCIe）总线时代的到来，其标志着高速串行总线取代传统的并行总线的时代的开端。<br>
注：关于PCI总线和PCI-X总线的简要介绍的文章到此为止，后面的文章将开始介绍本次连载博文真正的主角——PCI Express总线（PCIe总线）。</div></div>";
echo "<div class=container><div class=text></div></div>";
echo "<div class=container><div class=text></div></div>";
echo "<div class=container><div class=text></div></div>";
?>
