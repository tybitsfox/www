<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<center><font color=red size=4>好吧，虽然这一切都是我设计的，但我还是需要一张直观的内存分配一览表，以便更好的掌控整个内存的使用情况。</font></center><br>";
echo "<center><font size=5 color=blue>[0M,1M)之间的内存分配</font></center><br>
<table border=0 width=90%><tr align=center>
<td style=\"background-color:gray\" width=10%>[0,0x600)保留</td>
<td style=\"background-color:#00ff00\" width=10%>[0x600,0x630)物理内存及软硬盘参数表</td>
<td style=\"background-color:gray\" width=10%>[0x630,0x1000)保留</td>
<td style=\"background-color:#b8b800\" width=20%>[0x1000,0x51000)DMA缓冲区（320K）</td>
<td style=\"background-color:#00ffff\" width=10%>[0x60000,0x61000)核心数据结构（影子）</td>
<td style=\"background-color:gray\" width=20%>[0x61000,0xB8000)保留(348K)</td>
<td style=\"background-color:#00ff00\" width=10%>[0xB8000,0xBA000)模式3显示缓冲区</td>
<td style=\"background-color:gray\" width=10%>[0xBA000,0x100000)保留（280K）</td>
</tr></table>";
echo "<center><font size=5 color=blue>[1M,2M)之间的内存分配</font></center><br>";
echo "
<table border=0 width=90%><tr align=center>
<td style=\"background-color:#00ff00\" width=10%>[0x100000,0x101000)页目录表</td>
<td style=\"background-color:#b8b800\" width=90%>[0x101000,0x200000)页表（存放255个页表，可映射1G-4M的内存）</td>
</tr></table>";
echo "<center><font size=5 color=blue>[2M,3M)之间的内存分配</font></center><br>";
echo "
<table border=0 width=90%><tr align=center>
<td style=\"background-color:#00ff00\" width=10%>[0x200000,0x200800)IDT（占用0x800）</td>
<td style=\"background-color:gray\" width=3%>保留</td>
<td style=\"background-color:#b8b800\" width=10%>[0x200A00,0x208A00)GDT（占用0x8000,最多4096个描述符）</td>
<td style=\"background-color:gray\" width=3%>保留</td>
<td style=\"background-color:#b8b800\" width=10%>[0x208B00,0x210B00)LDT（占用0x8000,最多333个LDT）</td>
<td style=\"background-color:gray\" width=3%>保留</td>
<td style=\"background-color:#b8b800\" width=10%>[0x210C00,0x217400)TSS（占用0x6800,最多256个TSS）</td>
<td style=\"background-color:gray\" width=6%>保留</td>
<td style=\"background-color:#b8b800\" width=45%>[0x218000,0x300000)页表（占用0xE800,最多232个页表）</td>
</tr></table>";
echo "<center><font size=5 color=blue>[3M,LKER_MEM_SIZE)之间的内存分配</font></center><br>";
echo "
<table border=0 width=90%><tr align=center>
<td style=\"background-color:#00ff00\" width=15%>[0x300000,LDATA_BEG_SIGN)中断处理程序，内核库函数，内核程序</td>
<td style=\"background-color:#b8b800\" width=10%>[LDATA_BEG_SIGN,KDATA_END)传说中的核心数据结构,_SYS_DATA就是该结构在c程序中的描述</td>
<td style=\"background-color:#00ffff\" width=10%>[KDATA_END,UMEM_LINK_BEG)一些内核显示信息及一个小的公共缓冲区</td>
<td style=\"background-color:#b800b8\" width=10%>[UMEM_LINK_BEG,FREE_BEG)用户内存链表</td>
<td style=\"background-color:gray\" width=45%>[FREE_BEG,LKER_STK_BEG)内核空闲空间，对这块空间的使用必须通过malloc和free函数进行分配和收回</td>
<td style=\"background-color:#00ff00\" width=10%>[LKER_STK_BEG,LKER_MEM_SIZE)内核堆栈空间，支持256个任务，每个任务4K堆栈空间</td>
</tr></table>";
echo "<font color=blue>关于内核内存分配的说明：</font><br>
<font color=red>一、综述</font><br>
在我的内核源代码中，与内核内存分配相关的文件一共有两个：include/constdef.inc和include/kernel_data.inc<br>
其中直接以数字表示的绝对位置，其值都是固定的，相关定义在constdef.inc文件中。<br>
而以变量（标号）表示的相对位置，是系统在内核引导时根据实际的物理内存情况动态设置的，其定义都在核心数据结构中。<br>
本系统设定：运行必须的最小物理内存为32M，内核所用最小内存为8M。一般情况下内核所用内存占全部物理内存的1/4。<br>
<font color=red>二、可变性</font><br>
这种分配方式不是一成不变的，这仅仅是目前（2016-4-3）为止所用的状态，在后期调整时，还会在本页面及时添加新的分配一览表。<br>
但是前面所用过的分配表不会删除，这也可以让我掌握内存分配修改的变化。<br>
<font color=red>三、动态设置的查看</font><br>
用变量（标号）标注的区间不能给人以直观的印象，如果要确定其分配值，在目前的内核中我添加了一个dump1程序，通过调用该程序,<br>
可以在运行期间查看每个变量的具体数值。<br>
<font color=red>四、其他说明</font><br>
1、关于内核显示信息和公共缓冲区内存区间，这是一个没有在头文件中明确标注出来的区间，这块区间期初仅仅是调试、测试所用的一块临时缓冲区<br>
它存在于核心数据结构之后，并且是为了将用户内存链表的起始位置与4K对齐而产生的缝隙区间。不过，随着代码的积累，一些内核必须的显示信息<br>
（例如kernel panic的信息）确实要有一个地方存储。于是就生成了这块区间，不过这块区间还是有必要的，所以我决定保留下来。在这个区间内除了一<br>
些需要显示的固定信息外，还有一个400字节的缓冲区，对这个缓冲区的使用不必进行分配和收回，同样，里面的临时信息也存在随时被更改的风险，<br>
所以，我打算仅适用与某些早期的汇编程序。后期的c程序将不再使用这块缓冲。<br>
2、内核空闲空间，这是一块供内核程序使用的堆空间等同于linux下kalloc分配的空间，对这块空间的使用必须进行登记和注销管理，这种管理是由<br>
kalloc和kfree函数实现的。<br>
3、目前想要进行的调整：页目录表的调整，如果将页目录表调整出1～2M的内存区间，而这个区间就可以存放256个页表而非现在的255个，这样就能管理<br>
整整一个G的内存。而在0～1M的区间内，目前来看有太多的保留空间，所以我想下一步将页目录表移至0～1M的区间内。<br><br><br><br><br><br><br>
";




?>
