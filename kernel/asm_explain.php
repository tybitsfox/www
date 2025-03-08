<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<font size=6 color=#ff0000><center>汇编指令补充</center></font><br><br><br>";
echo "<pre>
汇编语言中bt是位操作指令：
　　指令的格式：BT/BTC/BTR/BTS Reg/Mem,Reg/Imm ;80386+
　　受影响的标志位：CF
　　位检测指令是把第一个操作数中某一位的值传送给标志位CF，具体的哪一位由指令的第二操作数来确定。

　　根据指令中对具体位的处理不同，又分一下几种指令：

　　BT：把指定的位传送给CF；

　　BTC：把指定的位传送给CF后，还使该位变反；
　　BTR：把指定的位传送给CF后，还使该位变为0；
　　BTS：把指定的位传送给CF后，还使该位变为1；

　　例如：假设(AX)=1234H，分别执行下面指令。

　　BT AX, 2 ;指令执行后，CF=1，(AX)=1234h
　　BTC AX, 6 ;指令执行后，CF=0，(AX)=1274h
　　BTR AX, 10 ;指令执行后，CF=0，(AX)=1234h
　　BTS AX, 14 ;指令执行后，CF=0，(AX)=5234h 
	
	BSF: bit scan forward
    BSR: bit scan reverse	
信息介绍
BSR-逆向位扫描指令，BSF - 正向位扫描 (386以上CPU可用)

使用方法
格式: BSF dest, src
影响标志位: ZF
功能：从源操作数的的最低位向高位搜索，将遇到的第一个“1”所在的位序号存入目标寄存器中，
若所有位都是0，则ZF=1，否则ZF=0。

格式: BSR dest, src
影响标志位: ZF
功能：从源操作数的的最高位向低位搜索，将遇到的第一个“1”所在的位序号存入目标寄存器中，
若所有位都是0，则ZF=1，否则ZF=0。

举例
AX=0098H=0000000010011000B
BSF BX,AX;
ZF=0,BX=3h
BSR DX,AX;
ZF=0,DX=7H
</pre>";


?>
