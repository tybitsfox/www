<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<center><a name=virtio00></a><table width=90%>
<tr><td width=50%><a href=virtio_linux.php#virtio01>Linux虚拟化KVM-Qemu分析（八）之virtio初探</a></td><td width=50%><a href=./virtio_linux.php#virtio02>Linux虚拟化KVM-Qemu分析（九）之virtio初探</a></td></tr>
<tr><td width=50%><a href=virtio_linux.php#virtio03>Linux虚拟化KVM-Qemu分析（十）之virtio初探</a></td><td width=50%><a href=./virtio_linux.php#virtio04>Linux虚拟化KVM-Qemu分析（十一）之virtio初探</a></td></tr>
</table></center><br><br>";
echo "<a name=virtio01></a><font size=6 color=#ff0000><center>Linux虚拟化KVM-Qemu分析（八）之virtio初探</center></font><br>";
echo "<font size=4 color=gray><pre>
说明：
    KVM版本：5.9.1
    QEMU版本：5.0.0
    工具：Source Insight 3.5， Visio
概述
    从本文开始将研究一下virtio；
    本文会从一个网卡虚拟化的例子来引入virtio，并从大体架构上进行介绍，有个宏观的认识；
    细节的阐述后续的文章再跟进；
1. 网卡
1.1 网卡工作原理
先来看一下网卡的架构图（以Intel的82540为例）：
<img src=./virtio_linux/1771657-20210124224948934-1913021948.png />

    OSI模型，将网络通信中的数据流划分为7层，最底下两层为物理层和数据链路层，对应到网卡上就是PHY和MAC控制器；
    PHY：对应物理层，负责通信设备与网络媒介（网线）之间的互通，它定义传输的光电信号、线路状态等；
    MAC控制器：对应数据链路层，负责网络寻址、错误侦测和改错等；
    PHY和MAC通过MII/GMII(Media Independent Interface)和MDIO(Management Data Input/output)相连；
    MII/GMII(Gigabit MII)：由IEEE定义的以太网行业标准，与媒介无关，包含数据接口和管理接口，用于网络数据传输；
    MDIO接口，也是由IEEE定义，一种简单的串行接口，通常用于控制收发器，并收集状态信息等；
    网卡通过PCI接口接入到PCI总线中，CPU可以通过访问BAR空间来获取数据包，也有网卡直接挂在内存总线上；
    网卡还有一颗EEPROM芯片，用于记录厂商ID、网卡的MAC地址、配置信息等；
我们主要关心它的数据流，所以，看看它的工作原理吧：
<img src=./virtio_linux/1771657-20210124224958286-1916188878.png />

    网络包的接收与发送，都是典型的生产者-消费者模型，简单来说，CPU会在内存中维护两个ring-buffer，分别代表RX和TX，ring-buffer中存放的是描述符，描述符里包含了一个网络包的信息，包括了网络包地址、长度、状态等信息；
    ring-buffer有头尾两个指针，发送端为：TDH(Transmit Descriptor Head)和TDT(Transmit Descriptor Tail)，同理，接收端为：RDH(Receive Descriptor Head)和RDT(Receive Descriptor Tail)，在数据传输时，由CPU和网卡来分开更新头尾指针的值，这
也就是生产者更新尾指针，消费者更新头指针，永远都是消费者追着生产者跑，ring-buffer也就能转起来了；
    数据的传输，使用DMA来进行搬运，CPU的拷贝显然是一种低效的选择。在之前PCI系列分析文章中分析过，PCI设备有自己的BAR空间，可以通过DMA在BAR空间和DDR空间内进行搬运；
1.2 Linux网卡驱动
在网卡数据流图中，我们也基本看到了网卡驱动的影子，驱动与网卡之间是异步通信：
<img src=./virtio_linux/1771657-20210124225007980-1864647992.png />

    驱动程序负责硬件的初始化，以及TX和RX的ring-buffer的创建及初始化；
    ndo_start_xmit负责将网络包通过驱动程序发送出去，netif_receive_skb负责通过驱动程序接收网络包数据；
    数据通过struct sk_buff来存储；
    发送数据时，CPU负责准备TX网络包数据以及描述符资源，更新TDT指针，并通知NIC可以进行数据发送了，当数据发送完毕后NIC通过中断信号通知CPU进行下一个包的处理；
    接收数据时，CPU负责准备RX的描述符资源，接收数据后，NIC通过中断通知CPU，驱动程序通过调度内核线程来处理网络包数据，处理完成后进行下一包的接收；
2. 网卡全虚拟化
2.1 全虚拟化方案
全虚拟化方案，通过软件来模拟网卡，Qemu+KVM的方案如下图：
<img src=./virtio_linux/1771657-20210124225017779-906916600.png />

    Qemu中，设备的模拟称为前端，比如e1000，前端与后端通信，后端再与底层通信，我们来分别看看发送和接收处理的流程；

    发送：
        Guest OS在准备好网络包数据以及描述符资源后，通过写TDT寄存器，触发VM的异常退出，由KVM模块接管；
        KVM模块返回到Qemu后，Qemu会检查VM退出的原因，比如检查到e1000寄存器访问出错，因而触发e1000前端工作；
        Qemu能访问Guest OS中的地址内容，因而e1000前端能获取到Guest OS内存中的网络包数据，发送给后端，后端再将网络包数据发送给TUN/TAP驱动，其中TUN/TAP为虚拟网络设备；
        数据发送完成后，除了更新ring-buffer的指针及描述符状态信息外，KVM模块会模拟TX中断；
        当再次进入VM时，Guest OS看到的是数据已经发送完毕，同时还需要进行中断处理；
        Guest OS跑在vCPU线程中，发送数据时相当于会打算它的执行，直到处理完后再恢复回来，也就是一个严格的同步处理过程；

    接收：
        当TUN/TAP有网络包数据时，可以通过读取TAP文件描述符来获取；
        Qemu中的I/O线程会被唤醒并触发后端处理，并将数据发送给e1000前端；
        e1000前端将数据拷贝到Guest OS的物理内存中，并模拟RX中断，触发VM的退出，并由KVM模块接管；
        KVM模块返回到Qemu中进行处理后，并最终重新进入Guest OS的执行中断处理；
        由于有I/O线程来处理接收，能与vCPU线程做到并行处理，这一点与发送不太一样；
2.2 弊端

    Guest OS去操作寄存器的时候，会触发VM退出，涉及到KVM和Qemu的处理，并最终再次进入VM，overhead较大；
    不管是在Host还是Guest中，中断处理的开销也很大，中断涉及的寄存器访问也较多；
    软件模拟的方案，吞吐量性能也比较低，时延较大；
所以，让我们大声喊出本文的主角吧！
3. 网卡半虚拟化
在进入主题前，先思考几个问题：
    全虚拟化下Guest可以重用驱动、网络协议栈等，但是在软件全模拟的情况下，我们是否真的需要去访问寄存器吗（比如中断处理），真的需要模拟网卡的自协商机制以及EEPROM等功能吗？
    是否真的需要模拟大量的硬件控制寄存器，而这些寄存器在软件看来毫无意义？
    是否真的需要生产者/消费者模型的通知机制（寄存器访问、中断）？
3.1 virtio
网卡的工作过程是一个生产者消费者模型，但是在前文中可以看出，在全虚拟化状态下存在一些弊端，一个更好的生产者消费者模型应该遵循以下原则：
    寄存器只被生产者使用去通知消费者ring-buffer有数据（消费者可以继续消费），而不再被用作存储状态信息；
    中断被消费者用来通知生产者ring-buffer是非满状态（生产者可以继续生产）；
    生产者和消费者的状态信息应该存储在内存中，这样读取状态信息时不需要VM退出，减少overhead；
    生产者和消费者跑在不同的线程中，可以并行运行，并且尽可能多的处理任务；
    非必要情况下，相互之间的通知应该避免使用；
    忙等待（比如轮询）不是一个可以接受的通用解决方案；
基于上述原则，我们来看看从特殊到一般的过程：
<img src=./virtio_linux/1771657-20210124225030969-1952520201.png />

    第一行是针对网卡的实现，第二行更进一步的抽象，第三行是通用的解决方案了，对I/O操作的虚拟化通用支持；
所以，在virtio的方案下，网卡的虚拟化看上去就是下边这个样子了：
<img src=./virtio_linux/1771657-20210124225040517-1032020700.png />

    Hypervisor和Guest都需要实现virtio，这也就意味着Guest的设备驱动知道自己本身运行在VM中；
    virtio的目标是高性能的设备虚拟化，已经形成了规范来定义标准的消息传递API，用于驱动和Hypervisor之间的传递，不同的驱动和前端可以使用相同的API；
    virtio驱动（比如图中的virtio-net driver）的工作是将OS-specific的消息转换成virtio格式的消息，而对端（virtio-net frontend）则是做相反的工作；
virtio的数据传递使用scatter-gather list（sg-list）：
<img src=./virtio_linux/1771657-20210124225049058-70219482.png />

    sg-list是概念上的（物理）地址和长度对的链表，通常作为数组来实现；
    每个sg-list描述一个多块的buffer，消费者用它来作为输入或输出操作；
virtio的核心是virtqueue(VQ)的抽象：

    VQ是队列，sg-list会被Guest的驱动放置到VQ中，以供Hypervisor来消费；
    输出sg-list用于向Hypervisor来发送数据，而输入sg-list用于接收Hypervisor的数据；
    驱动可以使用一个或多个virqueue；
<img src=./virtio_linux/1771657-20210124225105737-1978247546.png />

    当Guest的驱动产生一个sg-list时，调用add_buf(SG, Token)入列；
    Hypervisor进行出列操作，并消费sg-list，并将sg-list push回去；
    Guest通过get_buf()进行清理工作；

上图说的是数据流方向，那么事件的通知机制如下：
<img src=./virtio_linux/1771657-20210124225113754-353622526.png />

    当Guest驱动想要Hypervisor消费sg-list时，通过VQ的kick来进行通知；
    当Hypervisor通知Guest驱动已经消费完了，通过interupt来进行通知；

大体的数据流和控制流讲完了，细节实现后续再跟进了。
3.2 半虚拟化方案
那么，半虚拟化框架下的网卡虚拟化数据流是啥样的呢？
发送
<img src=./virtio_linux/1771657-20210124225127172-1182373630.png />
接收
<img src=./virtio_linux/1771657-20210124225134666-1220243725.png />
相信你应该对virtio有个大概的了解了，好了，收工。<br>";
echo "<a name=virtio02></a><font size=6 color=#ff0000><center>Linux虚拟化KVM-Qemu分析（九）之virtio初探</center></font><br><br><br>
    文章同步在博客园：https://www.cnblogs.com/LoyenWang/
1. 概述

先来张图：
<img src=./virtio_linux/1771657-20210213002146556-1295538181.png />

    图中罗列了四个关键模块：Virtio Device、Virtio Driver、Virtqueue、Notification（eventfd/irqfd）；
    Virtio Driver：前端部分，处理用户请求，并将I/O请求转移到后端；
    Virtio Device：后端部分，由Qemu来实现，接收前端的I/O请求，并通过物理设备进行I/O操作；
    Virtqueue：中间层部分，用于数据的传输；
    Notification：交互方式，用于异步事件的通知；

想在一篇文章中写完这四个模块，有点too yong too simple，所以，看起来又是一个系列文章了。
本文先从Qemu侧的virtio device入手，我会选择从一个实际的设备来阐述，没错，还是上篇文章中提到的网络设备。
2. 流程分析

在Qemu的网卡虚拟化时，通常会创建一个虚拟网卡前端和虚拟网卡后端，如下图：
<img src=./virtio_linux/1771657-20210213002157164-967550439.png />

    在虚拟机创建的时候指定参数：-netdev tap, id = tap0， -device virtio-net-pci, netdev=tap0；
    创建一个Tap网卡后端设备；
    创建一个Virtio-Net网卡前端设备；
    网卡前端设备和后端设备进行交互，最终与Host的驱动完成数据的收发；
全文围绕着Tap设备的创建和Virtio-Net设备的创建展开。
入口流程如下：
<img src=./virtio_linux/1771657-20210213002204631-1421245348.png />

    Qemu的代码阅读起来还是比较费劲的，各种盘根错节，里边充斥着面向对象的思想，先给自己挖个坑，后续会专题研究的，this is for you, you have my words.;
    图中与本文相关的有三个模块：1）模块初始化；2）网络设备初始化；3）设备初始化；
        Qemu中设备模拟通过type_init先编译进系统，在module_call_init时进行回调，比如图中的xxx_register_types，在这些函数中都是根据TypeInfo类型信息来创建具体的实现信息；
        net_init_client用来创建网络设备，比如Tap设备；
        device_init_func根据Qemu命令的传入参数创建虚拟设备，比如Virtio-Net；

下边进入细节，the devil is in the details。
3. tap创建

从上文中，我们知道，Tap与Virtio-Net属于前后端的关系，最终是通过结构体分别指向对方，如下图：
<img src=./virtio_linux/1771657-20210213002217998-1655315613.png />

    NetClientState是网卡模拟的核心结构，表示网络设备中的几个端点，两个端点通过peer指向对方；
创建Tap设备的主要工作就是创建一个NetClientState结构，并添加到net_clients链表中：
<img src=./virtio_linux/1771657-20210213002303803-1084163909.png />
函数的调用细节如下图：
<img src=./virtio_linux/1771657-20210213002310283-874984329.png />

    处理流程只关注了核心的处理流程，整个过程有很多关于传入参数的处理，选择性忽略了；
    net_tap_init：与Host的tun驱动进行交互，其实质就是打开该设备文件，并进行相应的配置等；
    net_tap_fd_init：根据net_tap_info结构，创建NetClientState，并进行相关设置，这里边net_tap_info结构体中的接收函数指针用于实际的数据传输处理；
    tap_read_poll用于将fd添加到Qemu的AioContext中，用于异步响应，当有数据来临时，捕获事件并进行处理；
以上就是Tap后端的创建过程，下文将针对前端创建了。
virtio-net创建
这是一个复杂的流程。
4.1 数据结构

Qemu中用C语言实现了面向对象的模型，用于对设备进行抽象，精妙！
针对Virtio-Net设备，结构体及拓扑组织关系如下图：
<img src=./virtio_linux/1771657-20210213002318824-1058290140.png />

    DeviceState作为所有设备的父类，其中派生了VirtIODevice和PCIDevice，而本文研究的Virtio-Net派生自VirtIODevice；
    Qemu中会虚拟一个PCI总线，同时创建virtio-net-pci，virtio-balloon-pci，virtio-scsi-pci等PCI代理设备，这些代理设备挂载在PCI总线上，同时会创建Virtio总线，用于挂载最终的设备，比如VirtIONet；
    PCI代理设备就是一个纽带；
4.2 流程分析
与设备创建相关的三个函数，可以从device_init_func入口跟踪得知：
<img src=./virtio_linux/1771657-20210213002328216-1328380691.png />

    当Qemu命令通过-device传入参数时，device_init_func会根据参数去查找设备，并最终调用到该设备对应的类初始化函数、对象初始化函数、以及realize函数；
    所以，我们的分析就是这三个入口；
4.2.1 class_init
<img src=./virtio_linux/1771657-20210213002339829-618075364.png />

    在网卡虚拟化过程中，参数只需要指定PCI代理设备即可，也就是-device virtio-net-pci, netdev=tap0，从而会调用到virtio_net_pci_class_init函数；
    由于实现了类的继承关系，在子类初始化之前，需要先调用父类的实现，图中也表明了继承关系以及调用函数顺序；
    C语言实现继承，也就是将父对象放置在自己结构体的开始位置，图中的颜色能看出来；

4.2.2 instance_init

类初始化结束后，开始对象的创建：
<img src=./virtio_linux/1771657-20210213002346674-1999852327.png />
针对Virtio-Net-PCI的实例化比较简单，作为代理，负责将它的后继对象初始化，也就是本文的前端设备Virtio-Net；
4.2.3 realize
<img src=./virtio_linux/1771657-20210213002356436-18682170.png />

    realize的调用，比较绕，简单来说，它的类继承关系中存在多个realize的函数指针，最终会从父类开始执行，一直调用到子类，而这些函数指针的初始化在什么时候做的呢？没错，就是在class_init类初始化的时候，进行了赋值，细节不表，结论可靠；
    最终的调用关系就如图了；

到目前为止，我们似乎都还没有看到Virtio-Net设备的相关操作，不用着急，已经很接近真相了：
<img src=./virtio_linux/1771657-20210213002404478-1016637722.png />

    virtio_net_pci_realize函数，会触发virtio_device_realize的调用，该函数是一个通用的virtio设备实现函数，所有的virtio设备都会调用，而我们的前端设备Virtio-Net也是virtio设备；
    virtio_net_device_realize就到了我们的主角了，它进行了virtio通用的设置（后续在数据通信中再分析），还创建了一个NetClientState端点，与Tap设备对应，分别指向了对方，惺惺相惜，各自安好；
    virtio_bus_device_plugged表示设备插入总线时的处理，完成的工作就是按照PCI总线规划，配置各类信息，以便与Guest OS中的virtio驱动交互，后续的文章再分析了；

本文基本捋清了虚拟网卡前端设备和后端设备的创建过程，完成的工作只是绑定了彼此，数据交互以及通知机制，留给后续吧。<br>";
echo "<a name=virtio03></a><font size=6 color=#ff0000><center>Linux虚拟化KVM-Qemu分析（十）之virtio初探</center></font><br>
1. 概述
<img src=./virtio_linux/1771657-20210224230011372-860838932.png />

    前篇文章讲完了Qemu中如何来创建Virtio Device，本文将围绕Guest OS中的Virtio Driver来展开；
看一下Guest OS（Linux）中的Virtio框架高层架构图：
<img src=./virtio_linux/1771657-20210224230018412-1701114651.png />

    核心模块为virtio和virtqueue，其他高层的驱动都是基于核心模块之上构建的；
    显然，本文会延续这个系列，继续分析virtio-net驱动，重心在整体流程和框架上，细节不表；
    virtio-net，又是一个virtio设备，又是一个PCI设备，那么驱动会怎么组织呢？带着问题上路吧。
2. 数据结构
说到驱动怎么能不提linux设备驱动模型呢，感兴趣的朋友可以去看看PCI系列分析文章，简单来说就是内核创建总线用于挂载设备，总线负责设备与驱动的匹配。Linux内核创建了一个virtio bus：
<img src=./virtio_linux/1771657-20210224230026389-1415523459.png />

    virtio设备和virtio驱动，通过virtio_device_id来匹配，而这个都是在virtio规范中定义好的；
    virtio_device结构中有一个struct virtio_config_ops，函数集由驱动来进行指定，用于操作具体的设备；
本文描述的virtio-net驱动，既是一个virtio设备，也是一个pci设备，在内核中通过结构体struct virtio_pci_device来组织：
<img src=./virtio_linux/1771657-20210224230035773-340142374.png />

    该结构体中维护了几个IO区域：Common, ISR, Device, Notify，用于获取virtio设备的各种信息，这个也是由virtio规范决定的；
    通常来说一个virtio设备，由以下几个部分组成：
        Device status field
        Feature bits
        Notifications
        Device Configuration space
        One or more virtqueues
    从结构体看，它用于充当pci设备和virtio设备的纽带，后续也会在probe函数中针对不同的部分进行对应的初始化；
以总线的匹配视角来看就是这样子的：
<img src=./virtio_linux/1771657-20210224230048521-644906865.png />
3. 流程分析
3.1 virtio总线创建
先看一下virtio总线的创建，virtio bus当然也算是基建了：
<img src=./virtio_linux/1771657-20210224230056465-1815162121.png />

    bus_register注册virtio总线，总线负责匹配，在匹配成功后调用通用的virtio_dev_probe函数；
    千里姻缘一线牵，当Virtio的ID号能对上时，就会触发驱动探测，所以什么时候进行设备注册呢？
3.2 virtio驱动调用流程
详细的细节，建议阅读之前PCI驱动系列的分析文章，下边罗列关键部分：
<img src=./virtio_linux/1771657-20210224230103153-2040554903.png />

    virtio-net设备通过挂在pci总线上，系统在PCI子系统初始化时会去枚举所有的设备，并将枚举的设备注册进系统；
    系统在匹配上之后，调用设备的驱动；
<img src=./virtio_linux/1771657-20210224230400403-1000958582.png />

    PCI设备根据Vendor ID来匹配驱动；
    virtio规范中规定基于PCI的virtio设备，Vendor ID号为：0x1AF4，因此最终调用的驱动入口为virtio_pci_probe；
<img src=./virtio_linux/1771657-20210224230417971-437424297.png />

    在probe函数中分配struct virtio_pci_device结构，前文中也提到过它负责将virtio设备和pci设备绑定到一起，最终会在两个设备驱动的probe函数中完成整体结构的初始化，也就是virtio_pci_probe完成一部分，实际的virtio设备驱动中完成一部分；
    virtio_pci_modern_probe：该函数的内容就与virtio规范紧密相关了，简单来说，virtio设备都会按照规范填充common、device、isr、notification等功能部分，而virtio_pci_modern_probe函数通过virtio_pci_find_capability去获取对应的能力，并
且通过map_capability完成IO空间的映射；
    virtio_pci_probe中还设置了virtio_pci_config_ops操作函数集，并传递给virtio驱动，在驱动中调用这些回调函数来操作virtio设备；
    register_virtio_device：向系统注册virtio设备，从而也就触发了virtio总线的匹配操作，最终调用virtio_dev_probe函数；
    virtio_dev_probe函数中按照virtio规范分阶段设置不同的状态、获取virtio设备的feature等，并最终调用实际设备的驱动程序了；
At last，终于摸到本文要说的virtio-net的驱动的入口了，当然，文章也要戛然而止了。
整体执行流程及框架应该清楚了，细节就留给大家了，待续。。。<br>";
echo "<a name=virtio04></a><font size=6 color=#ff0000><center>Linux虚拟化KVM-Qemu分析（十一）之virtio初探</center></font><br>
1. 概述
<img src=./virtio_linux/1771657-20210328173659872-275187796.png />

    前边系列将Virtio Device和Virtio Driver都已经讲完，本文将分析virtqueue；
    virtqueue用于前后端之间的数据交换，一看到这种数据队列，首先想到的就是ring-buffer，实际的实现会是怎么样的呢？
2. 数据结构
先看一下核心的数据结构：
<img src=./virtio_linux/1771657-20210328173709126-884834927.png />

    通常Virtio设备操作Virtqueue时，都是通过struct virtqueue结构体，这个可以理解成对外的一个接口，而Virtqueue机制的实现依赖于struct vring_virtqueue结构体；
    Virtqueue有三个核心的数据结构，由struct vring负责组织：
        struct vring_desc：描述符表，每一项描述符指向一片内存，内存类型可以分为out类型和in类型，分别代表输出和输入，而内存的管理都由驱动来负责。该结构体中的next字段，可用于将多个描述符构成一个描述符链，而flag字段用于描述属性，比如只读只写等；
        struct vring_avail：可用描述符区域，用于记录设备可用的描述符ID，它的主体是数组ring，实际就是一个环形缓冲区；
        struct vring_used：已用描述符区域，用于记录设备已经处理完的描述符ID，同样，它的ring数组也是环形缓冲区，与struct vring_avail不同的是，它还记录了设备写回的数据长度；
这么看，当然是有点不太直观，所以，下图来了：
<img src=./virtio_linux/1771657-20210328173718528-1016668684.png />

    简单来说，驱动会分配好内存（scatterlist），并通过virtqueue_add添加到描述表中，这样描述符表中的条目就都能对应到具体的物理地址了，其实可以把它理解成一个资源池子；
    驱动可以将可用的资源更新到struct vring_avail中，也就是将可用的描述符ID添加到ring数组中，熟悉环形缓冲区的同学应该清楚它的机制，通过维护头尾两个指针来进行管理，Driver负责更新头指针（idx），Device负责更新尾指针（Qemu中的Device负责维护一个
last_avail_idx），头尾指针，你追我赶，生生不息；
    当设备使用完了后，将已用的描述符ID更新到struct vring_used中，vring_virtqueue自身维护了last_used_idx，机制与struct vring_avail一致；
3. 流程分析
3.1 发送
<img src=./virtio_linux/1771657-20210328173735876-1164554235.png />
当驱动需要把数据发送给设备时，流程如上图所示：

    ①A表示分配一个Buffer并添加到Virtqueue中，①B表示从Used队列中获取一个Buffer，这两种中选择一种方式；
    ②表示将Data拷贝到Buffer中，用于传送；
    ③表示更新Avail队列中的描述符索引值，注意，驱动中需要执行memory barrier操作，确保Device能看到正确的值；
    ④与⑤表示Driver通知Device来取数据；
    ⑥表示Device从Avail队列中获取到描述符索引值；
    ⑦表示将描述符索引对应的地址中的数据取出来；
    ⑧表示Device更新Used队列中的描述符索引；
    ⑨与⑩表示Device通知Driver数据已经取完了；
3.2 接收
<img src=./virtio_linux/1771657-20210328173744024-718252802.png />
当驱动从设备接收数据时，流程如上图所示：

    ①表示Device从Avail队列中获取可用描述符索引值；
    ②表示将数据拷贝至描述符索引对应的地址上；
    ③表示更新Used队列中的描述符索引值；
    ④与⑤表示Device通知Driver来取数据；
    ⑥表示Driver从Used队列中获取已用描述符索引值；
    ⑦表示将描述符索引对应地址中的数据取出来；
    ⑧表示将Avail队列中的描述符索引值进行更新；
    ⑨与⑩表示Driver通知Device有新的可用描述符；
3.3 代码分析
代码的分析将围绕下边这个图来展开（Virtio-Net），偷个懒，只分析单向数据发送了：
<img src=./virtio_linux/1771657-20210328173757944-2086503669.png />
3.3.1 virtqueue创建
<img src=./virtio_linux/1771657-20210328173804452-1571678857.png />

    之前的系列文章分析过virtio设备和驱动，Virtio-Net是PCI网卡设备驱动，分别会在virtnet-probe和virtio_pci_probe中完成所有的初始化；
    virtnet_probe函数入口中，通过init_vqs完成Virtqueue的初始化，这个逐级调用关系如图所示，最终会调用到vring_create_virtqueue来创建Virtqueue；
    这个创建的过程中，有些细节是忽略的，比如通过PCI去读取设备的配置空间，获取创建Virtqueue所需要的信息等；
    最终就是围绕vring_virtqueue数据结构的初始化展开，其中vring数据结构的内存分配也都是在驱动中完成，整个结构体都由驱动来管理与维护；
3.3.2 virtio-net驱动发送
<img src=./virtio_linux/1771657-20210328173812553-1572434645.png />

    网络数据的传输在驱动中通过start_xmit函数来实现；
    xmit_skb函数中，sg_init_table初始化sg列表，sg_set_buf将sg指向特定的buffer，skb_to_sgvec将socket buffer中的数据填充sg；
    通过virtqueue_add_outbuf将sg添加到Virtqueue中，并更新Avail队列中描述符的索引值；
    virtqueue_notify通知Device，可以过来取数据了；

3.3.3 Qemu virtio-net设备接收
<img src=./virtio_linux/1771657-20210328173819450-917504788.png />

    Guest驱动写寄存器操作时，陷入到KVM中，最终Qemu会捕获到进行处理，入口函数为kvm_handle_io；
    Qemu中会针对IO内存区域设置读写的操作函数，当Guest进行IO操作时，最终触发操作函数的调用，针对Virtio-Net，由于它是PCI设备，操作函数为virtio_pci_config_write；
    virtio_pci_config_write函数中，对Guest的写操作进行判断并处理，比如在VIRTIO_PCI_QUEUE_NOTIFY时，调用virtio_queue_notify，用于处理Guest驱动的通知，并最终回调handle_output函数；
    针对Virtio-Net设备，发送的回调函数为virtio_net_handle_tx_bh，并在virtio_net_flush_tx中完成操作；
    通用的操作模型：通过virtqueue_pop从Avail队列中获取地址，将数据进行处理，通过virtqueue_push将处理完后的描述符索引更新到Used队列中，通过virtio_notify通知Guest驱动；

Virtqueue这种设计思想比较巧妙，不仅用在virtio中，在AMP系统中处理器之间的通信也能看到它的身影。";
echo "</pre></font>";
