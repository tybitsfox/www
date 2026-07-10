<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<a name=res00></a><font size=6 color=#ff0000><center>浅析virtio技术 virtqueue机制</center></font><br><br><br>";
echo "<font size=4 color=gray><pre>
浅析virtio技术（3）virtqueue机制
        前言
        virtqueue机制概述
            virtqueue运作流程
        Split Virtqueue
            Split virtqueue数据结构
                描述符表
                可用描述符表
                已用描述符表
            IO请求组织方式
                Chained Descriptor
                Indirect Descriptor
            使用Split Virtqueue的通信流程
                前端驱动写入
                后端设备使用
                前端驱动回收
        Packed Virtqueue
            Packed Virtqueue数据结构
                Packed Virtqueue描述符格式
                Event Suppression Structure格式
            使用Packed Virtqueue的通信流程
                前端驱动写入
                后端设备使用
                前端驱动回收
        相关参考

前言

virtio技术得到广泛应用，一个很重要的原因是因为virtio提供了一套统一的用于virito前端和后端的通信机制，而这套通信机制的核心就是virtqueue。
virtqueue机制概述

virtqueue支持在virtio设备上进行批量数据传输，而每个virtio设备都可以配置0个或多个virtqueue。对于每个virtqueue，通常包含三个部分：
<center><table width=50% border=1>
 <tr><td width=30%>Descriptor Area：</td><td width=70%>用于描述数据buffer；</td></tr>
 <tr><td width=30%>Driver Area：</td><td width=70%>驱动需要传递给设备的额外数据；</td></tr>
 <tr><td width=30%>Device Area：</td><td width=70%>设备需要传递给驱动的额外数据。</td></tr>
</table></center>

virtqueue运作流程

前端驱动和后端设备通过约定的规则使用virtqueue进行通信。virtqueue的运作流程如下：

    前端驱动程序通过向队列添加可用缓冲区，即向virtqueue添加描述请求的缓冲区，并可选地触发驱动程序事件，即向设备发送可用缓冲区通知，使请求对设备可用；
    后端设备执行请求，并在完成后向队列中添加一个已使用的缓冲区，即通过将缓冲区标记为已使用，让驱动程序知道。然后，设备可以触发设备事件，即向驱动程序发送已使用的缓冲区通知。

最新的virtio 协议 版本定义有两种virtqueue格式：Split Virtqueue和Packed Virtqueue，下面针对这两种格式，我们分别进行描述。
Split Virtqueue

在virtio协议1.0和更早的版本中，Split Virtqueue是virtio协议唯一支持的virtqueue格式。
Split virtqueue数据结构

Split Virtqueue格式将virtqueue分成了三个部分：
<center><table width=50% border=1>
<tr><td width=30%>Descriptor Table：</td><td width=70%>描述符表，对应于Descriptor Area；</td></tr>
 <tr><td width=30%>Available Ring：</td><td width=70%>可用描述符表，对应于Driver Area；</td></tr>
  <tr><td width=30%>Used Ring：</td><td width=70%>已用描述符表，对应于Device Area。</td></tr>
</table></center>
对于每个部分只能由驱动或者设备写入，而不支持同时可写。virtio协议规定，vietqueue结构关联的 内存 由客户机中的前端驱动负责分配和回收。virtio协议定义的virtqueue数据结构如下：
<center><img src=./virtio/0001.png /></center>
描述符表

描述符表用于保存一系列描述符，每一个描述符都被用来描述客户机内的一块内存区域。对于这块内存区域，如果存放的是前端驱动写给设备的数据，称这个描述符为out类型的；如果存放的是前端驱动从设备读取的数据，称这个描述符为in类型的。描述符数据结构定义如下：
<center><img src=./virtio/0002.png /></center>
描述符通过以下字段指定内存区域的各个属性：
<center><table width=50% border=1>
<tr><td width=10%>字段	</td><td width=90%>作用</td></tr>
<tr><td width=10%>addr	</td><td width=90%>表示内存区域在客户机物理地址空间中的起始地址</td></tr>
<tr><td width=10%>len	</td><td width=90%>该字段的意义取决于该内存区域的读写属性。如果该区域是只写的，数据传递方向只能从后端设备到前端驱动，此时len表示设备最多可以向该内存块写入的数据长度。反之，如果该区域是只读的，此时len表示后端设备必须读取的来自前端驱动的数据量。</td></tr>
<tr><td width=10%>flags	</td><td width=90%>用于标识描述符自身的特性，一共有三种可选值。VRING_DESC_F_WRITE表示当前内存区域是只写的，即该内存区域只能被后端设备用来向前端驱动传递数据。VRING_DESC_F_NEXT表明该描述符的next字段是否有效。VRING_DESC_F_INDIRECT表明该描述符是否指向一个间接描述符表。</td></tr>
<tr><td width=10%>next	</td><td width=90%>驱动和设备的一次数据交互往往会涉及多个不连续的内存区域。通常的做法是将描述符组织成描述符链表的形式来表示所有的内存区域。next字段便是用来指向下一个描述符。通过flag字段中的值VRING_DESC_F_NEXT，就可以间接地确定该描述符是否为描述符链表的最后一个。</td></tr>
可用描述符表
</table></center>

可用描述符表用于保存前端驱动提供给后端设备且后端设备可以使用的描述符。可用描述符表由一个flags字段、idx索引字段以及一个以 数组 形式实现的环组成。可用描述符表数据结构定义如下：
<center><img src=./virtio/0003.png /></center>
各个字段作用描述如下：
<center><table width=50% border=1>
<tr><td width=10%>字段	</td><td width=90%>作用</td></tr>
<tr><td width=10%>flags	</td><td width=90%>标志位，表示可用描述符表的一些属性，包括是否需要设备在使用了可用描述符表中的表项后发送中断给驱动。</td></tr>
<tr><td width=10%>idx	</td><td width=90%>用于索引ring数组中下一个可用的位置，由前端驱动进行维护。</td></tr>
<tr><td width=10%>ring	</td><td width=90%>用于存放描述符链表中作为链表头的描述符在描述符表中的索引</td></tr>
</table></center>
已用描述符表

已用描述符表用于保存后端已经处理并且尚未反馈给驱动的描述。与可用描述符表不同的是，已用描述符表中数组ring的每个元素不仅包含后端设备已经处理的描述符链表的头部描述符在描述符表中的索引，而且由于后端设备可能会向前端驱动写回数据或需要告知驱动写操作的状态，还需要包括一个len字段来记录设备写回数据的长度。已用描述符区域数据结构定义如下：
<center><img src=./virtio/0004.png /></center>
各个字段作用描述如下：
<center><table width=50% border=1>
<tr><td width=10%>字段	</td><td width=90%>作用</td></tr>
<tr><td width=10%>flags	</td><td width=90%>标志位，表示已用描述符表的一些属性，包括是否需要驱动在回收了已用描述符表中的表项后发送通知给设备</td></tr>
<tr><td width=10%>idx	</td><td width=90%>用于索引ring数组中下一个已用元素的位置，由后端设备进行维护。</td></tr>
<tr><td width=10%>ring	</td><td width=90%>存储已用元素的数组，每个已用元素包括描述符索引和数据长度</td></tr>
</table></center>
IO请求组织方式

一个IO请求通常需要使用多个Descriptor描述，描述的信息一般包括一个请求、一个或多个数据页以及提供给后端设备填写处理结果的响应Buffer。通过flags中的VRING_DESC_F_INDIRECT字段是否设置，一个IO请求可以选择Chained Descriptor或者Indirector Descriptor方式进行组织。
Chained Descriptor

Chained Descriptor通过next字段将多个描述符串接成描述符链表的形式来描述一个IO请求：
<center><img src=./virtio/a2756347afbff220bb1d1bc05a305857.png /></center>
Indirect Descriptor

Indirect Descriptor方式下，IO请求使用的描述符指向的是一个包含多个描述符的间接描述符表，并由间接描述表中的描述符描述所有的内存区域。对于一个IO请求，在包含的描述符数量较多的情况下，可以优化后端设备对描述信息的访问：设备可以一次性读取整个间接描述表中所有描述符，避免沿着next字段逐个读取。
<center><img src=./virtio/7159715aaf7c6362a7e2531ca7bd5f4b.png /></center>
使用Split Virtqueue的通信流程

设备使用virtqueue主要包括两部分过程：驱动通过描述符列表和可用描述符表提供数据缓冲区给设备用，和设备使用描述符后再通过已用描述符表归还给驱动。

    前端驱动写入
    后端设备使用
    前端驱动回收

前端驱动写入

客户机 操作系统 通过驱动提供数据缓冲区给设备使用，具体包括以下步骤:

    把数据缓冲区的地址、长度等信息赋值到空闲的描述符中;
    把该描述符指针添加到该虚拟队列的可用环表的头部;
    更新该可用环表中的头部指针；
    写入该虚拟队列编号到Queue Notify寄存器以通知设备。

后端设备使用

每次后端设备取用可用描述符时，需要知道剩余可用描述符在数组ring中的起始位置。后端设备会维护一个变量last_avail_idx，用来标记这个位置。当 切换 到主机中时，后端设备将检查last_avail_idx和idx的值，数组ring中位于last_avail_idx和idx-1之间的部分就是可供后端设备使用的区域。
<center><img src=./virtio/fbe044768aa5686abdc29e7e91833ade.png /></center>
每次后端设备取用可用描述符时，需要知道剩余可用描述符在数组ring中的起始位置。后端设备会维护一个变量last_avail_idx，用来标记这个位置。当 切换 到主机中时，后端设备将检查last_avail_idx和idx的值，数组ring中位于last_avail_idx和idx-1之间的部分就是可供后端设备使用的区域。
在这里插入图片描述

设备使用数据缓冲区后（基于不同种类的设备可能是读取或者写入，或是部分读取或者部分写入），将用过的缓冲区描述符填充已用环表，并通过 中断 通知驱动。具体的过程如下：

    把使用过的数据缓冲区描述符的头指针添加到该虚拟队列的已用环表的头部;
    更新该已用环表中的头部指针;
    根据是否开启MSI-X中断，用不同的中断方式通知驱动

前端驱动回收

当设备驱动回收已用的设备描述符时，需要知道剩余已用标识符在数组ring中的起始位置，前端驱动会维护一个变量last_used_idx，用来标记这个位置。当切换到 虚拟机 中时，前端驱动将检查last_used_idx和idx的值，数组ring中位于last_used_idx和idx-1之间的部分便是可供前端驱动回收的区域。
<center><img src=./virtio/34e973fb917c280aeffe616b29924053.png /></center>
Packed Virtqueue

Packed Virtqueue本质上是对Split Virtqueue的一种改进方案，在virtio协议 1.1版本中提出。在Split Virtqueue方案中，无论是前端驱动还是后端设备，都需要通过访问Driver Area或Device Area来确定需要访问的描述符，这不仅在数据结构管理上带来了复杂度，同时也增加了设备DMA的开销。Packed Virtqueue在管理结构上进行了简化，驱动和设备所需要的信息都存放在了Descriptor Ring中。

Packed Virtqueue包含三个部分：
<center><img src=./virtio/3d3625415ac8c79dd8cfebed3c10018e.png /></center>
    Descriptor Ring
    Driver Event Suppression
    Device Event Suppression

Packed Virtqueue数据结构
Packed Virtqueue描述符格式
<center><img src=./virtio/0005.png /></center>
各个字段的作用描述如下：
<center><table width=50% border=1>
<tr><td width=10%>字段	</td><td width=90%>作用</td></tr>
<tr><td width=10%>addr	</td><td width=90%>表示内存区域在客户机物理地址空间中的起始地址</td></tr>
<tr><td width=10%>len	</td><td width=90%>该字段的意义取决于该内存区域的读写属性。如果该区域是只写的，数据传递方向只能从后端设备到前端驱动，此时len表示设备最多可以向该内存块写入的数据长度。反之，如果该区域是只读的，此时len表示后端设备必须读取的来自前端驱动的数据量。</td></tr>
<tr><td width=10%>id	</td><td width=90%>仅对driver有意义</td></tr>
<tr><td width=10%>flags	</td><td width=90%>用于标识描述符自身的特性，Packed virtqueue增加了两位：VIRTQ_DESC_F_AVAIL和VIRTQ_DESC_F_USED。</td></tr>
</table></center>
Event Suppression Structure格式
<center><img src=./virtio/0006.png /></center>
各个字段的作用描述如下：
<center><table width=50% border=1>
<tr><td width=10%>字段	</td><td width=90%>作用</td></tr>
<tr><td width=10%>desc_event_off	</td><td width=90%>如果事件标志设置为描述符特定事件：ring内的偏移量（以描述符大小为单位）。只有当此描述符分别可用/使用时，事件才会触发。</td></tr>
<tr><td width=10%>desc_event_wrap	</td><td width=90%>如果事件标志设置为描述符特定事件：ring内的偏移量（以描述符大小为单位）。只有当Ring Wrap Counter与此值匹配并且描述符分别可用/使用时，事件才会触发。</td></tr>
<tr><td width=10%>desc_event_flags	</td><td width=90%>支持三种取值，RING_EVENT_FLAGS_ENABLE使能描述符特定事件通知；RING_EVENT_FLAGS_DISABLE禁用描述符特定事件通知；RING_EVENT_FLAGS_DESC表示当描述符满足条件时再进行通知</td></tr>
</table></center>
使用Packed Virtqueue的通信流程

初始状态：
<center><img src=./virtio/ab0eac83b52282e526531f9f8c15e857.png /></center>
前端驱动写入
<center><img src=./virtio/31f20327931092441035798289325ff0.png /></center>
后端设备使用
<center><img src=./virtio/6ed8c7a3c55808154d7d194a4cde9522.png /></center>
IO请求处理完成后：
<center><img src=./virtio/3416a6e751bda396bf0404bd185b7ced.png /></center>
前端驱动回收
<center><img src=./virtio/a041b4be48e655540f27ac819e22f92b.png /></center>

";
echo "</pre></font>";

?>
