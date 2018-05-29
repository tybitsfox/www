<?php
echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
echo "<center><h2>C语言中几个重要概念(二)</font></h2></center><font size=4>";
echo "一、<font color=red>#pragma pack(push,1)</font>与<font color=red>#pragma pack(1)</font>的区别<br>
这是给编译器用的参数设置，有关结构体字节对齐方式设置， pragma pack是指定数据在内存中的对齐方式。<br>
<font color=red>#pragma pack (n)</font>             作用：C编译器将按照n个字节对齐。<br>
<font color=red>#pragma pack ()</font>               作用：取消自定义字节对齐方式。<br>
<font color=red>#pragma  pack (push,1)</font>     作用：是指把原来对齐方式设置压栈，并设新的对齐方式设置为一个字节对齐<br>
<font color=red>#pragma pack(pop)</font>            作用：恢复对齐状态<br>
因此可见，加入push和pop可以使对齐恢复到原来状态，而不是编译器默认，可以说后者更优，但是很多时候两者差别不大<br>
如：<br>
<font color=red>#pragma pack(push)</font> //保存对齐状态<br>
<font color=red>#pragma pack(4)</font>//设定为4字节对齐<br>
相当于 <font color=red>#pragma  pack (push,4)</font><br>";
echo "另外，还有如下的一种方式：<br>
· __attribute((aligned (n)))，让所作用的结构成员对齐在n字节自然边界上。如果结构中有成员的长度大于n，则按照最大成员的长度来对齐。<br>
· __attribute__ ((packed))，取消结构在编译过程中的优化对齐，按照实际占用字节数进行对齐。<br>
以上的n = 1, 2, 4, 8, 16... 第一种方式较为常见。<br></font>";
?>
