<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<font size=6 color=#ff0000><center>汇编指令补充</center></font><br><br><br>";
echo "<center><a href=asm_explain.php#asm_bt>一、BT/BTC/BTR/BTS指令</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=asm_explain.php#asm_cpuid>二、cpuid指令</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=asm_explain.php#asm_rdmsr>三、RDMSR/WRMSR指令</a></center>";
echo "<pre>
<font size=5 color=#ff0000><a name=asm_bt></a>一、BT/BTC/BTR/BTS指令</font>
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
echo"<pre><font size=5 color=#ff0000><a name=asm_cpuid></a>二、cpuid指令</font>
CPUID是Intel Pentium以上级CPU内置的一个指令(486级及以下的CPU不支持),它用于识别某一类型的CPU,它能返回CPU的级别(family),型号(model),CPU步进(Stepping ID)及CPU字串等信息,从此命令也可以得到CPU的缓存与TLB信息.
CPUID返回数据类型是在EAX寄存器里面定义的,而指令返回的数值则在存储在EAX,EBX,ECX和EDX寄存器里面.
返回的信息分两部分:基本信息与扩展信息.在EAX输入0-3参数时,它返回的CPU的基本信息;而在EAX输入0x8000000至0x800000x时,它返回的是CPU的扩展信息(extended function information).扩展信息只包含在Pentium 4及以后的CPU上,Pentium 4以前的CPU无法取得它的扩展信息.

如下面的表:
CPU级别         基本信息   扩展信息
486及以前的CPU      不可用    不可用
Pentium        0x1    不可用
Pentium Pro,Pentium 2    0x2    不可用
Pentium 3      0x3    不可用
Pentium 4      0x2    0x80000004
Xeon(至强)      0x2    0x80000004

假若输入高于该处理器的值时,CPUID指令返回的是该CPU的输入最高值的返回值(这一句不知道怎么说才好),
比如在在Pentium 4上输入0x4,则CPU返回值与输入0x2的返回值一样.

下面的表是输入值与返回值的关系:
输入值        返回值
-----------------------------------------------------------------
0x0      EAX  CPU基本参数的输入值
      EBX  \"Genu\"
      ECX  \"Intel\"
      EDX  \"inel\"
------------------------------------------------------------------
0x1      EAX  CPU的级别,型号及步进
      EBX  信息很多,下面介绍
      ECX  保留
      EDX  特征信息(Feature Information)

------------------------------------------------------------------
0x2      EAX到EDX返回的都是缓存和TLB的信息
------------------------------------------------------------------
0x3      EAX  保留
      EBX  保留
      ECX  CPU序列号(0 - 31bit) (只是在Pentium 3中才有效)
      EDX  CPU序列号(32 - 63bit) (只是在Pentium 3 中才有效)
------------------------------------------------------------------

 

0x80000000    EAX  扩展信息输入数最大值(具有扩展信息的CPU才能返回)
      EBX  保留
      ECX  保留
      EDX  保留
------------------------------------------------------------------
0x80000001    EAX  CPU特征(Signature)和扩展特征位(Extended Feature Bits)
      EBX 到 ECX  保留
------------------------------------------------------------------
0x80000002    EAX  处理器字串(Processor Brand String)
      EBX  处理器字串(续)
      ECX  处理器字串(续)
      EDX  处理器字串(续)
------------------------------------------------------------------
0x80000003    EAX  处理器字串(续)
      EBX  处理器字串(续)
      ECX  处理器字串(续)
      EDX  处理器字串(续)
------------------------------------------------------------------
0x80000004    EAX  处理器字串(续)
      EBX  处理器字串(续)
      ECX  处理器字串(续)
      EDX  处理器字串(续)
------------------------------------------------------------------

当输入0x1时,EBX返回值是:
第 0 -  7位: CPU字串索引 (Brand Index)
第 8 - 15位: CLFLUSH线大小(CLFLUSH line size) (返回值*8 = cache line size)
第16 - 23位: 保留
第24 - 31位: 处理器APIC物理标号 (Processor local APIC physical ID)

当输入0x1时,EDX返回的扩展信息解释如下:

位  标号    解释
0  FPU  Floating Point Unit On-Chip. CPU是否内置浮点计算单元
1  VME  Virtual 8086 Mode Enhancements. 是否支持虚拟8086模式
2  DE  Debugging Extensions. 是否支持调试功能.
3  PSE  Page Size Extension. 是否支持大于4MB的分页.
4  TSC  Time Stamp Counter. 是否支持RDTSC指令.(注:RDTSC指令可以计算出CPU的频率)
5  MSR  Module Specific Registers RDMSR and WRMSR Instructions. 是否支持RDMSR与WRMSR (*注1)
6  PAE  Physical Address Extension. 是否支持大于32bit的物理地址.
7  MCE  Machine Check Exception. (*注2)
8  CX8  CMPXCHG8B Instruction. 是否支持8bytes(64bit)数的比较与交换指令.
9  APIC  APIC On-Chip.是否支持APIC(Advanced Programmable Interrupt Controller)
10  保留
11  SEP  SYSENTER and SYSEXIT Instructions.是否支持SYSENTER与SYSEXIT指令.(*注3)
12  MTRR  Memory Type Range Registers. 是否支持MTTR(*注4)
13  PGE  PTE Global Bit. 是否支持全局页面目录入口标志位 (global bit in page directory entries)
14  MCA  Machine Check Architecture. 是否支持MCA,MCA是Pentium4,Xeon,P6级处理器的一个错误报告机制
15  CMOV  Conditional Move Instructions. CMOV指令是否可用.(请问谁可以解释一下CMOV是什么命令?)
16  PAT  Page Attribute Table. 是否支持PAT,PAT允许操作系统指定4K大小的线性内存空间
17  PSE-36  32-bit Page Size Extension. 是否支持4GB的扩展内存
18  PSN  Processor Serial Number. 是否支持处理器序列号.(P3有效)
19  CLFSH  CLFLUSH Instruction.是否支持CLFLUSH.(*注5)
20  保留
21  DS  Debug Store. 是否支持把调试信息写入缓存,
22  ACPI  ACPI Processor Performance Modulation Registers. 处理器使用特别的寄存器以允许软件控制处理器的运行周期.
23   MMX  Inter MMX Technology.是否支持MMX
24  FXSR  FXSAVE and FXRSTOR Instructions. FXSAVE与FXRSTOR指令是否可用(*注6)
25  SSE  SSE.是否支持SSE.
26  SSE2  是否支持SSE2.
27  SS  Self Snoop. 处理器是否支持总线监视,以防止储存器冲突.
28  保留
29  TM  Thermal Monitor.CPU是否支持温度控制.

30 & 31  保留
--------------------------------------------------------------
注1: RDMSR: Load MSR specified by ECX into EDX:EAX
     WRMSR: Write the value in EDX:EAX to MSR specified by ECX
注2:
原文是Exception 18 is defined for Machine Checks,including CR4.MCE for controlling the feature. This feature does not define themodel-specific implementations of machine-check error logging, reporting, andprocessor shutdowns. 
Machine Check exception handlers may have to depend onprocessor version to do model specific processing of the exception, or test for thepresence of the Machine Check feature.

 

注3: SYSENTER: Fast call to privilege level 0 system procedures
     SYSEXIT:  Fast return to privilege level 3 user code.

注4:
原文是The MTRRcap MSR contains feature bits that describe what memory types are supported, how manyvariable MTRRs are supported, and whether fixed MTRRs are supported.

注5: CLFLUSH: Flushes cache line containing m8.

注6: FXSAVE: Save the x87 FPU, MMX, XMM, and MXCSR register
     FXSTOR: Restore the x87 FPU, MMX, XMM, and MXCSR register


按照这个,就可以自己写一个CPU检测程序了;
#include <stdio.h>

void main()
{
  unsigned long DBaseIndex, DFeInfo, DFeInfo2, DCPUBaseInfo;
  unsigned long DFeIndex, DCPUExInfo, i;
  unsigned long DOther[4], DTLB[4], DProceSN[2];
  char cCom[13];
  char cProStr[49];
  unsigned int j;

  _asm
  {
    xor eax, eax
    cpuid
    mov DBaseIndex      ,eax
    mov dword ptr cCom    ,ebx
    mov dword ptr cCom+4  ,ecx //AMD CPU要把ecx改为edx
    mov dword ptr cCom+8  ,edx //AMD CPU要把edx改为ecx
    
    mov eax, 1
    cpuid
    mov DCPUBaseInfo, eax
    mov DFeInfo, ebx
    mov DFeInfo2, edx

    mov eax, 0x80000000
    cpuid
    mov DFeIndex, eax

    mov eax, 0x80000001
    cpuid
    mov DCPUExInfo, eax

    mov eax, 0x80000002
    cpuid
    mov dword ptr cProStr    , eax
    mov dword ptr cProStr + 4  , ebx
    mov dword ptr cProStr + 8  , ecx
    mov dword ptr cProStr + 12  ,edx

    mov eax, 0x80000003
    cpuid
    mov dword ptr cProStr + 16  , eax
    mov dword ptr cProStr + 20  , ebx
    mov dword ptr cProStr + 24  , ecx
    mov dword ptr cProStr + 28  , edx

    mov eax, 0x80000004
    cpuid
    mov dword ptr cProStr + 32  , eax
    mov dword ptr cProStr + 36  , ebx
    mov dword ptr cProStr + 40  , ecx
    mov dword ptr cProStr + 44  , edx
  }

  if( DBaseIndex >= 2 )
  {
    _asm
    {
      mov eax, 2
      cpuid
      mov DTLB[0], eax
      mov DTLB[2], ebx
      mov DTLB[3], ecx
      mov DTLB[4], edx
    }
  }
  if(DBaseIndex == 3)
  {
    _asm
    {
      mov eax, 3
      cpuid
      mov DProceSN[0], ecx
      mov DProceSN[1], edx
    }
  }

  cCom[12] = '\0'; //加一个结尾符
  printf( \"CPU厂商:  %s\n\", cCom );
  printf( \"CPU字串:  %s\n\", cProStr );
  printf( \"CPU基本参数: Family:%X  Model:%X  Stepping ID:%X\n\", (DCPUBaseInfo & 0x0F00) >> 8,
      (DCPUBaseInfo & 0xF0) >> 4, DCPUBaseInfo & 0xF );
  printf( \"CPU扩展参数: Family:%X  Model:%X  Stepping ID:%X\n\", (DCPUExInfo & 0x0F00) >> 8,
      (DCPUExInfo & 0xF0) >> 4, DCPUExInfo & 0xF );

  printf( \"CPU字串索引: 0x%X\n\", DFeInfo & 0xFF );
  printf( \"CLFLUSH线大小: 0x%X\n\", ( DFeInfo & 0xFF00 ) >> 8 );
  printf ( \"处理器APIC物理标号:0x%X\n\", ( DFeInfo & 0xF000 ) >> 24 );
  if( DBaseIndex >= 2)
  {
    printf( \"CPU Cache & TLB Information: \" );
    for(j = 0; j < 4; j++)
    {
      if( !(DTLB[j] & 0xFF) ) printf( \"%.2X \", DTLB[j] & 0xFF );
      if( !((DTLB[j] & 0xFF) >> 8) ) printf( \"%.2X \", (DTLB[j] & 0xFF00) >> 8 );
      if( !((DTLB[j] & 0xFF0000) >> 16) ) printf( \"%.2X \",( DTLB[j] & 0xFF0000) >> 16);
      if( !((DTLB[j] & 0xFF000000) >> 24) ) printf( \"%.2X \",( DTLB[j] & 0xFF000000) >> 24);
    }
    printf(\"\n\");
  }

  if( DBaseIndex == 3 )
  {
    printf( \"CPU序列号是:%X%X\n\", DProceSN[0], DProceSN[1] );
  }
    printf( \"FPU:  %d\t\t\", DFeInfo2 & 0x00000001 ); //下面是调用某BLOG上面的代码,懒得写了 ^^
    printf( \"VME:  %d\t\t\", (DFeInfo2 & 0x00000002 ) >> 1 );
    printf( \"DE:  %d\n\", (DFeInfo2 & 0x00000004 ) >> 2 );
    printf( \"PSE:  %d\t\t\", (DFeInfo2 & 0x00000008 ) >> 3 );
    printf( \"TSC:  %d\t\t\", (DFeInfo2 & 0x00000010 ) >> 4 );
    printf( \"MSR:  %d\n\", (DFeInfo2 & 0x00000020 ) >> 5 );
    printf( \"PAE:  %d\t\t\", (DFeInfo2 & 0x00000040 ) >> 6 );
    printf( \"MCE:  %d\t\t\", (DFeInfo2 & 0x00000080 ) >> 7 );
    printf( \"CX8:  %d\n\", (DFeInfo2 & 0x00000100 ) >> 8 );
    printf( \"APIC:  %d\t\", (DFeInfo2 & 0x00000200 ) >> 9 );
    printf( \"SEP:  %d\t\t\", (DFeInfo2 & 0x00000800 ) >> 11 );
    printf( \"MTRR:  %d\n\", (DFeInfo2 & 0x00001000 ) >> 12 );
    printf( \"PGE:  %d\t\t\", (DFeInfo2 & 0x00002000 ) >> 13 );
    printf( \"MCA:  %d\t\t\", (DFeInfo2 & 0x00004000 ) >> 14 );
    printf( \"CMOV:  %d\n\", (DFeInfo2 & 0x00008000 ) >> 15 );
    printf( \"PAT:  %d\t\t\", (DFeInfo2 & 0x00010000 ) >> 16 );
    printf( \"PSE-36:  %d\t\", (DFeInfo2 & 0x00020000 ) >> 17 );
    printf( \"PSN:  %d\n\", (DFeInfo2 & 0x00040000 ) >> 18 );
    printf( \"CLFSN:  %d\t\", (DFeInfo2 & 0x00080000 ) >> 19 );
    printf( \"DS:  %d\t\t\", (DFeInfo2 & 0x00200000 ) >> 21 );
    printf( \"ACPI:  %d\n\", (DFeInfo2 & 0x00400000 ) >> 22 );
    printf( \"MMX:  %d\t\t\", (DFeInfo2 & 0x00800000 ) >> 23 );
    printf( \"FXSR:  %d\t\", (DFeInfo2 & 0x01000000 ) >> 24 );
    printf( \"SSE:  %d\n\", (DFeInfo2 & 0x02000000 ) >> 25 );
    printf( \"SSE2:  %d\t\", (DFeInfo2 & 0x04000000 ) >> 26 );
    printf( \"SS:  %d\t\t\", (DFeInfo2 & 0x08000000 ) >> 27 );
    printf( \"TM:  %d\n\", (DFeInfo2 & 0x20000000 ) >> 29 );

printf(\"\n其它信息:\n\");
  printf(\"----------------------------------------\n\");
  printf(\"In \t\tEAX \t\tEBX \t\tECX \t\tEDX\");
  for( i = 0x80000004; i <= DFeIndex; ++i )
  {
    DOther[0] = DOther[1] = DOther[2] = DOther[3] = 0;
    _asm
    {
      mov eax, i
      cpuid
      mov DOther[0], eax
      mov DOther[1], ebx
      mov DOther[2], ecx
      mov DOther[3], edx
    }
    printf( \"\n0x%.8X\t0x%.8X\t0x%.8X\t0x%.8X\t0x%.8X\", i, DOther[0], DOther[1], DOther[2], DOther[3] );
  }
  printf( \"\n\" );
  system( \"pause\" );
}

TLB与Cache信息详解:
0x00  Null descriptor
0x01  Instruction TLB: 4K-Byte Pages, 4-way set associative, 32 entries
0x02  Instruction TLB: 4M-Byte Pages, 4-way set associative, 2 entries
0x03  Data TLB: 4K-Byte Pages, 4-way set associative, 64 entries
0x04  Data TLB: 4M-Byte Pages, 4-way set associative, 8 entries
0x06  1st-level instruction cache: 8K Bytes, 4-way set associative, 32 byte line size
0x08  1st-level instruction cache: 16K Bytes, 4-way set associative, 32 byte line size
0x0A  1st-level data cache: 8K Bytes, 2-way set associative, 32 byte line size
0x0C  1st-level data cache: 16K Bytes, 4-way set associative, 32 byte line size
0x22  3rd-level cache: 512K Bytes, 4-way set associative, 64 byte line size
0x23  3rd-level cache: 1M Bytes, 8-way set associative, 64 byte line size
0x25  3rd-level cache: 2M Bytes, 8-way set associative, 64 byte line size
0x29  3rd-level cache: 4M Bytes, 8-way set associative, 64 byte line size
0x40  No 2nd-level cache or, if processor contains a valid 2nd-level cache, no 3rd-level cache
0x41  2nd-level cache: 128K Bytes, 4-way set associative, 32 byte line size
0x42  2nd-level cache: 256K Bytes, 4-way set associative, 32 byte line size
0x43  2nd-level cache: 512K Bytes, 4-way set associative, 32 byte line size
0x44  2nd-level cache: 1M Byte, 4-way set associative, 32 byte line size
0x45  2nd-level cache: 2M Byte, 4-way set associative, 32 byte line size
0x50  Instruction TLB: 4-KByte and 2-MByte or 4-MByte pages, 64 entries
0x51  Instruction TLB: 4-KByte and 2-MByte or 4-MByte pages, 128 entries
0x52  Instruction TLB: 4-KByte and 2-MByte or 4-MByte pages, 256 entries
0x5B  Data TLB: 4-KByte and 4-MByte pages, 64 entries
0x5C  Data TLB: 4-KByte and 4-MByte pages,128 entries
0x5D  Data TLB: 4-KByte and 4-MByte pages,256 entries
0x66  1st-level data cache: 8KB, 4-way set associative, 64 byte line size
0x67  1st-level data cache: 16KB, 4-way set associative, 64 byte line size
0x68  1st-level data cache: 32KB, 4-way set associative, 64 byte line size
0x70  Trace cache: 12K-μop, 8-way set associative
0x71  Trace cache: 16K-μop, 8-way set associative
0x72  Trace cache: 32K-μop, 8-way set associative
0x79  2nd-level cache: 128KB, 8-way set associative, sectored, 64 byte line size
0x7A  2nd-level cache: 256KB, 8-way set associative, sectored, 64 byte line size
0x7B  2nd-level cache: 512KB, 8-way set associative, sectored, 64 byte line size
0x7C  2nd-level cache: 1MB, 8-way set associative, sectored, 64 byte line size
0x82  2nd-level cache: 256K Bytes, 8-way set associative, 32 byte line size
0x84  2nd-level cache: 1M Byte, 8-way set associative, 32 byte line size
0x85  2nd-level cache: 2M Byte, 8-way set associative, 32 byte line size

举一个例子,一个CPU执行
mov eax, 2
cpuid
后,
返回值如下:
EAX 0x665B5001
EBX 0x0
ECX 0x0
EDX 0x007A7000
就代表了这个CPU的Cache信息是:
1. 0x66:1st-level data cache: 8KB, 4-way set associative, 64 byte line size
2. 0x5B:Data TLB: 4-KByte and 4-MByte pages, 64 entries
3. 0x50:Instruction TLB: 4-KByte and 2-MByte or 4-MByte pages, 64 entries
4. 0x01:Instruction TLB: 4K-Byte Pages, 4-way set associative, 32 entries
5. 0x7A:2nd-level cache: 256KB, 8-way set associative, sectored, 64 byte line size
6. 0x70:Trace cache: 12K-μop, 8-way set associative

CPU字串索引 (Brand Index)详解:
0x0: CPU不支持Brand Index
0x1: Celeron CPU
0x2: Pentium 3
0x3: Pentium 3 Xeon
0x4-0x7: 未用
0x8: Pentium 4

</pre>";
echo "<pre>
<font size=5 color=#ff0000><a name=asm_rdmsr></a>三、rdmsr, wrmsr指令</font>

1、MSR简介
          Model Specific Register (MSR) as the name implies is model specific and may change from processor model number (n) to processor model number (n+1).
          MSR 总体来是为了设置CPU 的工作环境和标示CPU 的工作状态，包括温度控制，性能监控等，具体来说，分为以下几项:
　　1. Thermal
　　2. Frequency
　　3. C State
　　4. Microcode
　　5. EIST
　　6. TM
　　7. Key Features Of CPU
　　8. Voltage
　　9. Cache Control
　　10. MTRR
　　11. DCA(Direct Cache Access)
　　12. Machine Check
　　13. 硬件联机控制
　　14.other　
2、汇编指令简介
          MSR 是CPU 的一组64 位寄存器，可以分别通过RDMSR 和WRMSR 两条指令进行读和写的操作，前提要在ECX 中写入MSR 的地址。MSR 的指令必须执行在level 0 或实模式下。
          RDMSR    读模式定义寄存器。对于RDMSR 指令，将会返回相应的MSR 中64bit 信息到(EDX：EAX)寄存器中
          WRMSR    写模式定义寄存器。对于WRMSR 指令，把要写入的信息存入(EDX：EAX)中，执行写指令后，即可将相应的信息存入ECX 指定的MSR 中。
我用CPUID指令探测到我的处理器的指令集是3，这个值小于6，
这是肯定无法使用 在586以后才出现的RDMSR指令的。
但我不死心，于是在浩如烟海的NTDDK文档中搜索，终于找到了
一个叫X86_ReadRDMSR的API，
这个API有两个参数，我不知道如何使用，
但我试着在驱动中调用这个函数，
invoke X86_ReadRDMSR, 101H, offset buffer
果然如我所料，调用成功了，读出了101H号SERVICE的地址。
看来我们在程序中应尽量不要使用硬编码，而要使用系统提供好的
API接口。要不然你写的程序在别人的机器上却无法运行，那又有何价值呢，呵呵，一点感悟...
我在masm32 sdk里面的randlibk.inc头文件中找到了你说的X86_ReadRDMSR 
__asm{
      mov ecx,119h
      rdmsr
      or eax,00200000h
     wrmsr
}
 
 RDMSR—Read from Model Specific Register
Description
Loads the contents of a 64-bit model specific register (MSR) specified in the ECX register into
registers EDX:EAX. The EDX register is loaded with the high-order 32 bits of the MSR and the
EAX register is loaded with the low-order 32 bits. If less than 64 bits are implemented in the
MSR being read, the values returned to EDX:EAX in unimplemented bit locations are unde-fined.
This instruction must be executed at privilege level 0 or in real-address mode; otherwise, a
general protection exception #GP(0) will be generated. Specifying a reserved or unimplemented
MSR address in ECX will also cause a general protection exception.
The MSRs control functions for testability, execution tracing, performance-monitoring and
machine check errors. Appendix B, Model-Specific Registers (MSRs), in the Intel Architecture
Software Developer’s Manual, Volume 3, lists all the MSRs that can be read with this instruction
and their addresses.
The CPUID instruction should be used to determine whether MSRs are supported (EDX[5]=1)
before using this instruction.
Intel Architecture Compatibility
The MSRs and the ability to read them with the RDMSR instruction were introduced into the
Intel Architecture with the Pentium processor. Execution of this instruction by an Intel Archi-tecture processor earlier than the Pentium processor results in an invalid opcode exception #UD.
Operation
EDX:EAX ←  MSR[ECX];
Flags Affected
None.
Protected Mode Exceptions
#GP(0) If the current privilege level is not 0.
If the value in ECX specifies a reserved or unimplemented MSR address.
Real-Address Mode Exceptions
#GP If the value in ECX specifies a reserved or unimplemented MSR address.
Opcode Instruction Description
0F 32 RDMSR Load MSR specified by ECX into EDX:EAX
3-400
INSTRUCTION SET REFERENCE
RDMSR—Read from Model Specific Register (Continued)
Virtual-8086 Mode Exceptions
#GP(0)  The RDMSR instruction is not recognized in virtual-8086 mode.
</pre>";

?>
