<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<font size=4 color=#ff0000><center>Intel 8253可编程定时器</center></font><br><br>";
echo "<br><center><img width=90% height=170% src=./IMG_20140825_081612.jpg /></center><br>";
echo "<font size=4 color=black><pre>
在linux0.11的源代码测试时，对8253可中断定时器的设置为：使用定时器0,设定为方式三工作。
因此汇编代码为：
	movl $0x36,%eax
	movl $0x43,%edx
	outb %al,%dx		#向命令寄存器（端口43H）发送指令0x36,设定使用定时器0,工作与方式三
	movl $11930,%eax	#1193180/100 设定工作频率为1/100秒=10ms
	outb %al,$0x40
	movb %ah,%al
	outb %al,$0x40
</pre></font>";
?>
