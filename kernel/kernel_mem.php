<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
$headfile=$_SERVER["DOCUMENT_ROOT"]."/kernel/include/head_def.php";
include_once($headfile);
?>
<script>
$(document).ready(function(){
		$("#flip1").click(function(){
				$("#panel1").slideToggle("slow");
				});
		});
$(document).ready(function(){
		$("#flip").click(function(){
				$("#panel").slideToggle("slow");
				});
		});
</script>
<style>
#flip,#flip1:hover {cursor:pointer;}
#panel,#flip,#panel1,#flip1
{
	padding:5px;
	text-align:center;
	background-color:#e5eecc;
	border:solid 1px #e5eecc;
}
#panel,#panel1
{
	padding:50px;
	display:none;
}
</style>

<?php
echo "<center><font color=red size=4>好吧，虽然这一切都是我设计的，但我还是需要一张直观的内存分配一览表，以便更好的掌控整个内存的使用情况。</font></center><br>";
echo "<center>Updated on 2024-7-23	Version:toys</center><br>";
echo "<center><font size=5 color=blue>[0M,1M)之间的内存分配</font></center><br><table border=0 width=90%><tr align=center>";
echo "<td style=\"background-color:#00ff00\" width=20%>[0,0x3fff] 全局描述符表GDT size:2048*8=0x4000</td>
<td style=\"background-color:#00ff00\" width=20%>[0x4000,0x47ff] 中断描述符表IDT size:256*8=0x800</td>
<td style=\"background-color:#e08080\" width=20%>[0x4800,0x4fff] 中断例程地址表COIDX size:256*8=0x800</td>
<td style=\"background-color:#00ff00\" width=20%>[0x5000,0x7fff] 内核页目录页表PDT size:0x1000*3=0x3000</td>
<td style=\"background-color:yellow\" width=20%>[0x8000,0xffff] DMA缓冲区 size:0x8000</td></tr><tr>
<td colspan=2 style=\"background-color:gray\" width=40% align=center>[0x10000,0x8ffff] kbuffer内核缓冲区 size:512K空间<br>将来可用于TSS结构存储区域</td>
<td style=\"background-color:red\" width=20%>[0x90000,0x9efff] TSS 60*1024=0xf000</td>
<td style=\"background-color:#0000ff\" width=20%>[0x9f000,0x9ffff] LDT 512*8=0x1000</td>
<td style=\"background-color:#00ff00\" width=20%>[0xa0000,0xfffff] DISP&BIOS 384k</td>
</tr></table>";
echo "<center><font size=5 color=blue>[1M,2M)之间的内存分配</font></center><br><table border=0 width=90%><tr align=center>";
echo "<td style=\"background-color:#00ff00\" width=20%>[0x100000,0x1007ff] 2k 中断入口函数 256*8=0x800</td>
<td style=\"background-color:#00aaaa\" width=50%>[0x100800,0x1dffff] 894k KERNEL code</td>
<td style=\"background-color:#e08080\" width=15%>[0x1e0000,0x1effff] 64k TASK0 stack</td>
<td style=\"background-color:#00aaaa\" width=15%>[0x1f0000,0x1fffff] 64k KERNEL stack</td><tr></table><br>";
echo "<center><font size=5 color=blue>[2M,3M)之间的内存分配</font></center><br><table border=0 width=90%><tr align=center>";
echo "<td style=\"background-color:#00ff00\" width=15%>[0x200000,0x2000ff] struct _SYS_DATA 0x100</td>
<td style=\"background-color:gray\" width=10%>[0x200100,0x20ffff]  GAP	64k-0x100</td>
<td style=\"background-color:#00aaaa\" width=25%>[0x210000,0x21xxxx] 位图128k->4G 依据实际内存大小xxxx=0x7ff</td>
<td style=\"background-color:orange\" width=20%>[0x21xxxx,0x21yyyy] 内核页表2 依据实际内存大小yyyy=0xdfff</td>
<td style=\"background-color:#e5eecc\" width=30%><div style='width:100%;margin:0 auto';><div id='flip'>[0x21yyyy,0x2fffff] Free kernel memory</div></td></tr></tr><td width=%15>   </td><td width=10%>  </td><td width=25%>   </td><td width=20%>   </td><td width=30%><div id= 'panel'>hello world</div></div></td></tr></table><br>";
echo "<center><font size=5 color=blue>[3M,kern_mem)之间的内存分配</font></center><br><table border=0 width=90%><tr align=center>";
echo "<td style=\"background-color:#e5eecc\" width=85%><div style='width:100%;margin:0 auto';><div id='flip1'>[0x300000,zzzzzz) 待分配内核空间</div></td>
<td style=\"background-color:#e08080\" width=15%>[zzzzzz,kern_mem) 待分配任务内核堆栈</td></tr><tr>";
echo "<td width=85%><div id= 'panel1'>hello world</div></div></td><td width=15%>  </td>";
echo "</tr></table><br>";














echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";



echo "<center><font size=5 color=blue>[0M,1M)之间的内存分配</font></center><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<table border=0 width=90%><tr align=center>
<td style=\"background-color:#00ff00\" width=10%>[0,0x1000)IDT 256*8=0x800</td>
<td style=\"background-color:#00ff00\" width=10%>[0x1000,0x2000)GDT 25*8=0xC8</td>
<td style=\"background-color:#00ff00\" width=10%>[0x2000,0x3000)LDT 48*6=0x120</td>
<td style=\"background-color:#00ff00\" width=10%>[0x3000,0x4000)TSS 112*6=0x2A0</td>
<td style=\"background-color:gray\" width=15%>[0x4000,0x7c00)Free 15K</td>
<td style=\"background-color:red\" width=15%>[0x7c00,0x10000)boot,head0 固定33K空间</td>
<td style=\"background-color:red\" width=10%>[0x10000,0x11000)stack headstack 4K</td>
<td style=\"background-color:#e08080\" width=10%>[0x11000,0x20000)buffer SYSTable 60K</td>
<td style=\"background-color:#00ff00\" width=10%>[0x20000,0x22400)DMA buffer</td></tr></table>
<br><table border=0 width=90%><tr align=center>
<td style=\"background-color:gray\" width=5%>[0x22400,0x30000)Free 55K</td>
<td style=\"background-color:#00ff00\" width=10%>[0x30000,0x40000)PDT 页目录表最多16张</td>
<td style=\"background-color:#33ff33\" width=15%>[0x40000,0x60000)PT 内核页表 32张 映射128M</td>
<td style=\"background-color:gray\" width=35%>[0x60000,0xb8000)Free 352k</td>
<td style=\"background-color:#ff0000\" width=10%>[0xb8000,0xba000)CDA 显示缓冲区 8K</td>
<td style=\"background-color:gray\" width=25%>[0xba000,0x100000)Free 280k</td>
</tr></table>";
echo "<center><font size=5 color=blue>[1M,2M)之间的内存分配</font></center><br>";
echo "<table border=0 width=90%><tr align=center>
<td style=\"background-color:#00ff00\" width=100%>[0x100000,0x200000)用户级页表<br>存放256个页表，可映射1G内存的用户空间</td>
</tr></table>";
echo "<center><font size=5 color=blue>[2M,3M)之间的内存分配</font></center><br>";
echo "<table border=0 width=90%><tr align=center>
<td style=\"background-color:red\" width=90%>[0x100000,0x2f0000)最终内核地址空间</td>
<td style=\"background-color:#e08080\" width=10%>[0x2f0000,0x300000)SAFE_BUF 内核安全缓冲区</td>
</tr></table>";
echo "<center><font size=5 color=blue>[3M,4M)之间的内存分配</font></center><br>";
echo "<table border=0 width=90%><tr align=center>
<td style=\"background-color:#b8b800\" width=100%>[0x300000,0x400000)文件系统加载地址<br>(暂时未用)</td>
</tr></table>";
echo "<center><font size=5 color=blue>[4M,5M)之间的内存分配</font></center><br>";
echo "<table border=0 width=90%><tr align=center>
<td style=\"background-color:red\" width=20%>[0x400000,0x440000)TASK0地址空间</td>
<td style=\"background-color:#00ffff\" width=12%>[0x440000,0x450000)TASK0用户堆栈</td>
<td style=\"background-color:red\" width=20%>[0x450000,0x490000)TASK1地址空间</td>
<td style=\"background-color:#00ffff\" width=12%>[0x490000,0x4A0000)TASK1用户堆栈</td>
<td style=\"background-color:red\" width=20%>[0x4A0000,0x4E0000)TASK2地址空间</td>
<td style=\"background-color:#00ffff\" width=16%>[0x4E0000,0x500000)TASK2用户堆栈</td>
</tr></table>";
echo "<center><font size=5 color=blue>[5M,6M)之间的内存分配</font></center><br>";
echo "<table border=0 width=90%><tr align=center>
<td style=\"background-color:red\" width=20%>[0x500000,0x540000)TASK3地址空间</td>
<td style=\"background-color:#00ffff\" width=12%>[0x540000,0x550000)TASK3用户堆栈</td>
<td style=\"background-color:red\" width=20%>[0x550000,0x590000)TASK4地址空间</td>
<td style=\"background-color:#00ffff\" width=12%>[0x590000,0x5A0000)TASK4用户堆栈</td>
<td style=\"background-color:red\" width=20%>[0x5A0000,0x5E0000)TASK5地址空间</td>
<td style=\"background-color:#00ffff\" width=16%>[0x5E0000,0x600000)TASK5用户堆栈</td>
</tr></table>";
echo "<center><font size=5 color=blue>[6M,8M)之间的内存分配</font></center><br>";
echo "<table border=0 width=90%><tr align=center>
<td style=\"background-color:gray\" width=50%>[0x600000,0x700000)FREE~~</td>
<td style=\"background-color:#00ffff\" width=10%>[0x700000,0x710000)内核堆栈</td>
<td style=\"background-color:#00aaaa\" width=40%>[0x710000,0x800000)<br>6个任务的系统及堆栈</td>
</tr></table>";

echo "<br><br><br><br><br>";


echo "<center><font size=5 color=blue>[0M,1M)之间的内存分配</font></center><br>
<table border=0 width=90%><tr align=center>
<td style=\"background-color:#00ff00\" width=10%>[0,0x800)IDT 256*8</td>
<td style=\"background-color:gray\" width=2%>F</td>
<td style=\"background-color:#00ff00\" width=10%>[0x900,0x9c8)GDT 25*8</td>
<td style=\"background-color:gray\" width=2%>F</td>
<td style=\"background-color:#00ff00\" width=10%>[0xa00,0xb20)LDT 48*6</td>
<td style=\"background-color:gray\" width=2%>F</td>
<td style=\"background-color:#00ff00\" width=10%>[0xc00,0xe20)TSS 112*6</td>
<td style=\"background-color:gray\" width=14%>[0xe20,0x7c00)Free 27k+</td>
<td style=\"background-color:red\" width=10%>[0x7c00,0x10000)boot,head0 固定33K空间</td>
<td style=\"background-color:red\" width=10%>[0x10000,0x11000)stack</td>
<td style=\"background-color:#e08080\" width=10%>[0x11000,0x20000)buffer</td>
<td style=\"background-color:#00ff00\" width=10%>[0x20000,0x22400)DMA buffer</td></tr></table>
<br><table border=0 width=90%><tr align=center>
<td style=\"background-color:gray\" width=25%>[0x22400,0x70000)Free 246K</td>
<td style=\"background-color:#00ff00\" width=10%>[0x70000,0x80000)PDT 页目录表最多16张</td>
<td style=\"background-color:#33ff33\" width=10%>[0x80000,0xa0000)PT 内核页表32张128M</td>
<td style=\"background-color:gray\" width=10%>[0xa0000,0xb8000)Free 24k</td>
<td style=\"background-color:#ff0000\" width=10%>[0xb8000,0xba000)CDA 显示缓冲区</td>
<td style=\"background-color:gray\" width=35%>[0xba000,0x100000)Free 280k</td>
</tr></table>";
echo "<br><br><br><br><br>";
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
