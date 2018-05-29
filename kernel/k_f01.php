<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "
<center><font color=red size=5>一个完整的保护模式下（启用分页）软盘驱动的示例</font></center>
<font color=blue size=2><pre>
Author:tybitsfox	2014-10-27
本文可以分享，但必须注明转载出处。
----------------------makefile-----------------
boot.img:boot.elf head.elf
	dd bs=512 if=boot.elf of=boot.img count=1
	dd bs=512 if=head.elf of=boot.img seek=1 count=9
	dd bs=512 if=/dev/zero of=boot.img seek=10 count=2870
boot.elf:boot.bin
	objcopy -R .pdr -R .comment -R .note -S -O binary boot.bin boot.elf
head.elf:head.bin
	objcopy -R .pdr -R .comment -R .note -S -O binary head.bin head.elf
boot.bin:boot.o
	ld -o boot.bin boot.o -Ttext 0
head.bin:head.o
	ld -o head.bin head.o -Ttext 0
boot.o:bt2.s
	as -o boot.o bt2.s
head.o:hd2.s
	as -o head.o hd2.s
clean:
	rm boot.* head.*
install:
	cp boot.img ~/
---------------------bt2.s--------------------------
#这是实模式下的程序代码，仅完成读取保护模式下运行的代码数据、清屏以及进入保护模式的准备
#和启动。
.code16
.data
.text
	jmp \$0x7c0,\$go
go:
	mov %cs,%ax
	mov %ax,%ds
	mov %ax,%es
	lss stk,%sp
	mov \$0x200,%bx
	mov \$0,%dx
	mov \$2,%cx
	mov \$0x0208,%ax
	int \$0x13
	jnc 1f
	jmp .
1:
	call cls
	nop
	call get_flp_param
	cli
	lgdt l_gdt
	smsw %ax
	or \$1,%ax
	lmsw %ax
	jmp \$8,\$0
//{{{get_flp_param	取得软盘驱动器参数
get_flp_param:
	pusha
	push %ds
	push %ds
	pop %es
	lea fparam,%di
	mov \$0,%ax
	mov %ax,%ds
	mov \$0x78,%si			#int 0x1E
	lodsw
	mov %ax,%bx
	lodsw
	mov %ax,%ds
	mov %bx,%si
	mov \$12,%cx
	rep movsb
	pop %ds
	popa
	ret
//}}}	
//{{{cls	清屏
cls:
	pusha
	mov \$0xb800,%ax
	mov %ax,%es
	mov \$0,%di
	mov \$0x7d0,%cx
	mov \$0x20,%ax
	rep stosw
	popa
	ret
//}}}
stk:	.word	0x300,0x3000,0
l_gdt:
		.word	71
		.word	0x7c00+gdt,0
/*关于内存划分使用的初步构想
 现在开始考虑对整体内存的使用规划了，初步设想：
 1、1M内存的分配：
 （1）前64k（0-0xffff）地址存放pdt/pt，idt和gdt。
 （2）第二个64k（0x10000-0x1ffff）存放备份的bios数据。
 （3）紧接着的320k（0x20000-0x6ffff）用于dma的读写缓冲区。
 （4）自0x70000-0x9ffff的192k为自定义的系统数据区。
 （5）0x100000至1M的（其中有显示缓冲区）部分保留。
 2、1M-2M之间的内存分配：
 （1）中断处理函数存放位置
 （2）最后8k（0x1e0000-0x1fffff）为内核堆栈区。
 3、2M-4M之间的内存分配：
 （1）前64k（0x200000-0x20ffff）存放ldt/tr,及部分pt。
 （2）剩余部分为内核代码、数据区。
 4、4M之后为用户空间。
 */		
gdt:
		.word	0,0,0,0
		.word	2,0x7e00,0x9a00,0x00c0			#0x8	text
		.word	2,0x7e00,0x9200,0x00c0			#0x10	data
		.word	1,0xe000,0x9210,0x00c0			#0x18	stack
		.word	1,0x7c00,0x9200,0x00c0			#0x20	floppy parameters's area
		.word	32,0x0000,0x9200,0x00c0			#0x28	gdt/idt,bios's data
		.word	4,0x0000,0x9210,0x00c0			#0x30	interrupt func
		.word	47,0x000,0x9207,0x00c0			#0x38	personal kernel data
		.word	0,0,0,0

.org	490
fparam:	.space 12,0

.org	510
.word	0xaa55

----------------------hd2.s------------------------------
#这是保护模式下的代码数据，主要完成：
#1、系统数据区的初始化
#2、自定义中断函数的安装，目前仅有：默认中断函数，定时器0中断函数，软驱中断函数，系统调用中断以及int0x16中断
#3、页目录、页表的设置、安装
#4、8253定时器的设置
#5、中断描述符表idt的设置、安装
#6、新的全局描述符表的设置、安装
#7、新idt、gdt、pdr/pt的加载，进入新的保护模式环境
#8、软盘驱动相关函数（dma，fdc）的安装、设置
#9、读取新扇区字节数据进行测试
#
.data
.text
	movl \$0x10,%eax
	movw %ax,%ds
	movw %ax,%es
	movw %ax,%fs
	movl \$0x38,%eax
	movw %ax,%gs
	movl \$LSTK2,%edi
	movl \$0x1f00,%eax
	movl %eax,%gs:(%edi)
	movl \$0x18,%eax
	movl %eax,%gs:4(%edi)
	lss %gs:(%edi),%esp
#	lss stk,%esp
	call _init_data
	nop
	call setup_8253
	nop
	call setup_pdt
	nop
	call move_int
	nop
	call setup_idt
	nop
	lidt l_idt
	call setup_gdt
	nop
	lgdt l_gdt
	movl \$0x10,%eax
	movw %ax,%ds
	movw %ax,%es
	movw %ax,%fs
	movl \$0x40,%eax
	movw %ax,%gs
	movl \$LSTK2,%edi
	lss %gs:(%edi),%esp
	#ready to start page model
	movl \$0,%eax
	movl %eax,%cr3
	movl %cr0,%eax
	orl	 \$0x80000000,%eax
	movl %eax,%cr0
	jmp .+2
	sti
#-----------------now begin to add floppy driver----------
	call disp_1
	nop
	movl \$0,%eax
	call motor_on
	nop
	movl \$0,%eax
	call cmd_seek_head
	jnc 1f
	call disp_err
	movl \$0xa001,%eax
	movl vv,%ebx
	jmp .
1:
	call setup_dma
	nop
	movl \$10,%eax
	call cmd_read_sector
	jnc 2f
	call disp_err
	movl \$0xa002,%eax
	jmp .
2:
	call cmd_chk_interrupt
	jnc 3f
	call disp_err
	movl \$0xa003,%eax
	jmp .
3:
	call disp_msg
	movl vv,%ebx
	jmp .

//{{{disp_msg: 显示软盘驱动读取的新一扇区的信息
disp_msg:
	movl \$0x38,%eax
	movw %ax,%ds
	movl \$0x20,%eax
	movw %ax,%es
	movl \$61,%ecx
	call calc_pos
	movl %edx,%edi
	movl \$0,%esi
	movl \$0x0a00,%eax
	movl %edi,vv
1:
	lodsb
	stosw
	loop 1b
	ret
//}}}
//{{{fetch_param 取得bios设置的软盘参数
#in	al:bios's parameter index
#rt	al:target parameter
fetch_param:
	pushl %ebx
	pushl %edi
	xorl %ebx,%ebx
	movb %al,%bl
	movl \$0x40,%eax
	movw %ax,%gs
	movl \$BFPARAM12,%edi
	addl %ebx,%edi
	movb %gs:(%edi),%al	
	popl %edi
	popl %ebx
	ret
//}}}
//{{{cmd_read_sector 读取指定扇区的内容。
#in	al: sector index,other use default set:driverA,head0,cylinder0
#er	CF
cmd_read_sector:
	pusha
	movl %eax,%ebx
	movl \$0x66,%eax
	call send_cmd					#send command
	jc 9f
	movl \$0,%eax
	call send_cmd					#send param1 head/driver
	jc 9f
	movl \$0,%eax
	call send_cmd					#send param2 cylinder
	jc 9f
	movl \$0,%eax
	call send_cmd					#send param3 head
	jc 9f
	movl %ebx,%eax
	call send_cmd					#send param4 sector number
	jc 9f
	movl \$3,%eax
	call fetch_param
	nop
	call send_cmd					#send param5
	jc  9f
	movl \$4,%eax
	call fetch_param
	nop
	call send_cmd					#send param6
	jc 9f
	movl \$5,%eax
	call fetch_param
	nop
	call send_cmd					#send param7
	jc 9f
	movl \$6,%eax
	call fetch_param
	nop
	call send_cmd					#send param8
	jc 9f
	call wait_for_irq
	jc 9f
	call recv_cmd
9:	
	popa
	ret
//}}}
//{{{setup_dma 设置dma的工作模式及缓冲地址和读取的字节数
#in al: sector numbers other use default:driverA,head0,cylinder0,read data
#rt none
setup_dma:
	pusha
	cli
	movl \$6,%eax
	movl \$10,%edx
	outb %al,%dx					#mask tunnel2
	jmp .+2
	movl \$0x46,%eax
	movl \$12,%edx
	outb %al,%dx					#clear byte pointer
	jmp .+2
	decl %edx
	outb %al,%dx					#set dma's work model is read from tunnel2
	jmp .+2
	movl \$0,%eax
	incl %edx
	outb %al,%dx					#clear
	jmp .+2
	movl \$4,%edx
	outb %al,%dx
	jmp .+2
	movb %ah,%al
	outb %al,%dx					#send buffer address into address register
	jmp .+2
	movb \$2,%al
	movl \$12,%edx
	outb %al,%dx					#clear
	jmp .+2
	movl \$0x81,%edx
	outb %al,%dx					#send high page into page register
	jmp .+2
	movl \$12,%edx
	outb %al,%dx					#clear
	jmp .+2
	movl \$512,%eax					#read 1 sector's data
	movl \$5,%edx
	outb %al,%dx
	jmp .+2
	movb %ah,%al
	outb %al,%dx
	jmp .+2							#send data length into count register
	movb \$2,%al
	movl \$10,%edx
	outb %al,%dx					#unmask tunnel 2
	jmp .+2
	sti
	popa
	ret
//}}}	
//{{{disp_err 出错显示
disp_err:
	pusha
	push %es
	movl \$0x20,%eax
	movw %ax,%es
	movl \$lerr,%ecx
	call calc_pos
	movl %edx,%edi
	leal merr,%esi
	movl \$0x0b00,%eax
1:
	lodsb
	stosw
	loop 1b
	pop %es
	popa
	ret
//}}}
//{{{recv_cmd FDC的返回信息读取函数
#in none
#rt CF
recv_cmd:
	pusha
	movl \$0x3f4,%edx
	movl \$10,%ecx
	movl \$BFLPRT10,%edi
	movl \$0,%eax
	rep stosb
	movl \$60,%ecx
	movl \$BFLPRT10,%edi
	movl \$0,%ebx
1:
	inb %dx,%al
	testb \$0x10,%al
	jnz  2f
	movl \$10,%eax
	call delay
	loop 1b
#	stc
	jmp 9f
2:
	incl %edx
	inb %dx,%al
	stosb
	incl %ebx
	cmpl \$7,%ebx
	jae 9f
	decl %edx
	movl \$60,%ecx
	jmp 1b
9:
	movb %bl,%al
	stosb
	popa
	ret
//}}}	
//{{{cmd_chk_interrupt 执行FDC的中断检测命令的函数
#in none
#rt CF
cmd_chk_interrupt:
	pusha
	movl \$8,%eax
	call send_cmd
	jc 9f
	call recv_cmd
9:	
	popa
	ret
//}}}	
//{{{wait_for_irq 软驱中断的等待测试函数
#in	none
#rt CF
wait_for_irq:
	pusha
	movl \$BFFLAG4,%edi
	movl \$60,%ecx
1:
	movb %gs:(%edi),%al
	test \$0x80,%al
	jnz 2f
	movl \$10,%eax
	call delay
	loop 1b
	stc
	jmp 9f
2:
	andb \$0x7f,%al
	movb %al,%gs:(%edi)
9:
	popa
	ret
//}}}	
//{{{delay 延时函数，最小单位1/100秒
#in al: delay times per 1/100 second
#rt none
delay:
	pushl %esi
	pushl %ebx
	movl \$LCOUNT1,%esi
	movl %gs:(%esi),%ebx
	andl \$0xff,%eax
	addl %ebx,%eax
1:
	movl %gs:(%esi),%ebx
	cmpl %ebx,%eax
	ja 1b
	popl %ebx
	popl %esi
	ret
//}}}
//{{{send_cmd FDC的命令或参数发送函数
#in al: command or parameters
#rt CF
send_cmd:
	pusha
	movl %eax,%ebx
	movl \$0x3f4,%edx
	movl \$60,%ecx
1:
	in %dx,%al
	jmp .+2
	testb \$0x40,%al
	jz  2f
	movl \$10,%eax
	call delay
	loop 1b
	stc
	jmp 9f
2:
	movl \$60,%ecx
3:
	in %dx,%al
	jmp .+2
	testb \$0x80,%al
	jnz 4f
	movl \$10,%eax
	call delay
	loop 3b
	stc
	jmp 9f
4:
	xchgl %eax,%ebx
	incl %edx
	outb %al,%dx
	jmp .+2
9:
	popa
	ret
//}}}
//{{{cmd_seek_head	执行FDC的磁头定位命令的函数
#in al:cylinder number 0-base
#rt	CF
cmd_seek_head:
	movl %eax,%ebx
	movl \$0xf,%eax
	call send_cmd				#send command
	movl \$0x123,%eax
	movl %eax,vv
	jc 9f
	movl \$0,%eax
	call send_cmd				#send head/driver
	movl \$0x124,%eax
	movl %eax,vv
	jc 9f
	movl %ebx,%eax
	call send_cmd				#send cylinder number
	movl \$0x125,%eax
	movl %eax,vv
	jc 9f
	call wait_for_irq
	movl \$0x126,%eax
	movl %eax,vv
	jc 9f
	call cmd_chk_interrupt
	movl \$0x127,%eax
	movl %eax,vv
9:	
	ret
//}}}
//{{{motor_on  启动软驱马达
#in	al: motor number 0-3:driver A-D
#rt none	
motor_on:
	pusha
	movb %al,%cl
	movl \$0x10,%eax
	roll %cl,%eax
	orb  \$0xc,%al
	addb %cl,%al
	movb \$0x1c,%al
	movl \$0x3f2,%edx
	outb %al,%dx			#actrally,default al is 0x1c when driverA is selected
	jmp .+2
	movl \$80,%eax
	call delay
	popa
	ret
//}}}	
//{{{disp_1	boot的显示函数
disp_1:
	pusha
	push %es
	movl \$len,%ecx
	call calc_pos
	movl \$0x20,%eax
	movw %ax,%es
	movl %edx,%edi
	leal msg,%esi
	movl \$0x0c00,%eax
1:
	lodsb
	stosw
	loop 1b
	pop %es
	popa
	ret
//}}}
//{{{setup_pdt	设置pdt/pt
setup_pdt:
	pusha
	push %es
	movl \$0x28,%eax
	movw %ax,%es
	movl \$0,%edi
	movl \$0x1007,%eax
	stosl
	movl \$1023,%ecx
	movl \$0,%eax
	rep stosl					#end of setup pdt
	movl \$0x1000,%edi
	movl \$7,%eax
	movl \$1024,%ecx
1:
	stosl
	addl \$0x1000,%eax
	loop 1b						#end of setup pt
	pop %es
	popa
	ret
//}}}
//{{{calc_pos	计算本次显示位置
#in ecx:current string length
#rt	edx:position	
calc_pos:
	pushl %eax
	pushl %ebx
	pushl %ecx
	push %es
	movl \$0x40,%eax
	movw %ax,%gs
	movl %ecx,%eax
	addl %eax,%ecx
	movl \$LPOSITION1,%ebx
	movl %gs:(%ebx),%eax
	pushl %eax
	movl \$0,%edx
	movw \$160,%bx
	divw %bx
	xchgl %eax,%edx
	addl %ecx,%eax
	popl %ebx
	cmpl \$160,%eax
	jb  1f
	xchgl %eax,%edx
	incl %eax
	movl \$160,%ebx
	mulw %bx
	movl %eax,%edx
	addl %ecx,%eax
	jmp 2f
1:
	movl %ebx,%edx
	movl %ecx,%eax
	addl %ebx,%eax
2:
	addl \$2,%eax
	movl \$LPOSITION1,%ebx
	movl %eax,%gs:(%ebx)
	pop %es
	popl %ecx
	popl %ebx
	popl %eax
	ret
//}}}
//{{{setup_gdt 生成新的gdt
setup_gdt:
	pusha
	push %es
	movl \$0x28,%eax
	movw %ax,%es
	leal tgdt,%esi
	movl \$0x2a00,%edi
	xorl %ecx,%ecx
	movw l_gdt,%cx
	incl %ecx
	rep movsb
	pop %es
	popa
	ret
//}}}
//{{{setup_idt 生成中断描述符表
setup_idt:
	pusha
	push %es
	movl \$0x28,%eax
	movw %ax,%es
	movl \$0x2000,%edi
#开始安装默认中断	
	leal nor_int,%edx
	movl \$0x00300000,%eax
	movw %dx,%ax
	movw \$0x8e00,%dx
	movl \$256,%ecx
1:
	movl %eax,%es:(%edi)
	movl %edx,%es:4(%edi)
	addl \$8,%edi
	loop 1b
#开始安装时钟中断
	leal time_int,%edx
	movl \$0x00300000,%eax
	movw %dx,%ax
	movw \$0x8e00,%dx
	movl \$64,%edi
	addl \$0x2000,%edi
	movl %eax,%es:(%edi)
	movl %edx,%es:4(%edi)
#安装系统中断
	leal sys_int,%edx
	movl \$0x00300000,%eax
	movw %dx,%ax
	movw \$0xef00,%dx
	movl \$0x400,%edi
	addl \$0x2000,%edi
	movl %eax,%es:(%edi)
	movl %edx,%es:4(%edi)
#安装软驱中断
	leal floppy_int,%edx
	movl \$0x00300000,%eax
	movw %dx,%ax
	movw \$0x8e00,%dx
	movl \$0x70,%edi
	addl \$0x2000,%edi
	movl %eax,%es:(%edi)
	movl %edx,%es:4(%edi)
#安装int0x16中断
	movl \$0x20,%ecx
	leal int_0x16,%edx
	movl \$0x00300000,%eax
	movw %dx,%ax
	movw \$0x8e00,%dx
	movl \$0xA8,%edi
	addl \$0x2000,%edi
	movl %eax,%es:(%edi)
	movl %edx,%es:4(%edi)
	pop %es
	popa
	ret
//}}}
//{{{move_int  复制中断例程至目标地址
move_int:
	pusha
	push %es
	movl \$0x10,%eax
	movw %ax,%ds
	movl \$0x30,%eax
	movw %ax,%es
	leal nor_int,%esi
	movl %esi,%edi
	movl \$nor_len,%ecx
	rep movsb
	leal time_int,%esi
	movl %esi,%edi
	movl \$time_len,%ecx
	rep movsb
	leal sys_int,%esi
	movl %esi,%edi
	movl \$sys_len,%ecx
	rep movsb
	leal floppy_int,%esi
	movl %esi,%edi
	movl \$flp_len,%ecx
	rep movsb
	leal int_0x16,%esi
	movl %esi,%edi
	movl \$int_len,%ecx
	rep movsb
	pop %es
	popa
	ret
//}}}	
//{{{nor_int  默认的中断
nor_int:
	pusha
	push %es
	movl \$0x20,%eax
	movw %ax,%es
	movl \$158,%edi
	movl \$0x0a41,%eax
	stosw
	movl \$0x20,%eax
	outb %al,\$0x20
	jmp .+2
	pop %es
	popa
	iret
nor_len=.-nor_int	
//}}}
//{{{time_int 定时器0中断
time_int:
	pushl %eax
	pushl %edx
	pushl %edi
	push %gs
	movl \$0x40,%eax
	movw %ax,%gs
	movl \$0x20,%eax
	movl %eax,%edx
	outb %al,%dx
	movl \$LCOUNT1,%edi
	movl %gs:(%edi),%eax
	incl %eax
	cmpl \$0x70000000,%eax
	jb 1f
	movl \$0,%eax
1:
	movl %eax,%gs:(%edi)
	pop %gs
	popl %edi
	popl %edx
	popl %eax
	iret
time_len=.-time_int	
//}}}
//{{{sys_int 系统调用入口
sys_int:
	pusha
	movl \$0x20,%eax
	outb %al,\$0x20
	popa
	iret
sys_len=.-sys_int	
//}}}
//{{{floppy_int  软驱中断
floppy_int:
	pusha
	movl \$0x20,%eax
	outb %al,\$0x20
	movl \$0x40,%eax
	movw %ax,%gs
	movl \$BFFLAG4,%edi
	movb %gs:(%edi),%al
	orb	 \$0x80,%al
	movb %al,%gs:(%edi)
	popa
	iret
flp_len=.-floppy_int	
//}}}
//{{{int_0x16 系统服务中断，在有整页写操作时，并且在sti之前调用setup_pdt时会发生该中断。
int_0x16:
	pusha
	movl \$0x20,%eax
	outb %al,%dx
	popa
	iret
int_len=.-int_0x16	
//}}}
//{{{setup_8253		设置8253定时器工作通道及频率
setup_8253:
	pushl %eax
	pushl %edx
	movl \$0x36,%eax
	movl \$0x43,%edx
	outb %al,%dx
	movl \$11930,%eax
	movl \$0x40,%edx
	outb %al,%dx
	jmp .+2
	movb %ah,%al
	outb %al,%dx
	popl %edx
	popl %eax
	ret
//}}}	
//{{{_init_data	一些内核数据的初始化函数
_init_data:
	pusha
	push %ds
	push %es
#首先，将bios数据移动至新的位置。	
	movl \$0x28,%eax
	movw %ax,%ds
	movw %ax,%es
	movl \$0x400,%esi
	movl \$0x10000,%edi
	movl \$0x100,%ecx
	rep movsb
	movl \$0x10,%eax
	movw %ax,%ds
	movw %ax,%es
	movl \$0x38,%eax
	movw %ax,%gs
#LSTK2在初始化函数之前已经完成。
#初始化字符串显示位置
	movl \$LPOSITION1,%edi
	movl \$0,%eax
	movl %eax,%gs:(%edi)
#初始化计数器累加值
	movl \$LCOUNT1,%edi
	movl %eax,%gs:(%edi)
#拷贝软驱参数
	push %gs
	pop %es
	movl \$BFPARAM12,%edi
	movl \$0x20,%eax
	movw %ax,%ds
	movl \$490,%esi
	movl \$12,%ecx
	rep movsb
	movl \$0x10,%eax
	movw %ax,%ds
	movw %ax,%es
#软驱中断使用标志。
	movl \$BFFLAG4,%edi
	movl \$0,%eax
	movl %eax,%gs:(%edi)
#内存大小，再次保存至内核数据区。
	movl \$WMEM2,%edi
	movl \$0x413,%esi
	movl \$0x28,%eax
	movw %ax,%ds
	push %gs
	pop %es
	mov \$2,%ecx
	rep movsw
#end	
	pop %es
	pop %ds
	popa
	ret
//}}}


stk:	.long	0x1f00,0x18
pos:	.long	0
count:	.long	0
fparam:	.space	12,0
fflag:	.byte	0
#		pdt & sys's pt at 0 addr size 2X4k=0x2000
l_idt:
		.word	0x800
		.long	0x00002000				#begin 0x2000 
l_gdt:	
		.word	79
		.long	0x00002a00				#begin 0x2a00
tgdt:
		.word	0,0,0,0
		.word	3,0x7e00,0x9a00,0x00c0		#0x8	text
		.word	3,0x7e00,0x9200,0x00c0		#0x10	data
		.word	1,0xe000,0x9210,0x00c0		#0x18	stack
		.word	5,0x8000,0x920b,0x00c0		#0x20	disp buffer
		.word	15,0x000,0x9201,0x00c0		#0x28	bios's data
		.word	5,0x0000,0x9a10,0x00c0		#0x30	interrupt function
		.word	79,0x000,0x9202,0x00c0		#0x38	dma's io buffer
		.word	47,0x000,0x9207,0x00c0		#0x40	personal kernel data
		.word	0,0,0,0
		

#下列定义的常量为自定义数据区中变量的位置偏移，命名规则为
#Lxxxnum，Wxxxnum，Bxxxnum：分别表示长度类型，后面的num表示该长度数量
LSTK2 =	0				#用于加载ess:esp
LPOSITION1	= 8			#当前字符串显示位置
LCOUNT1	=	12			#计数器1的累加数值，每1/100秒加1.
BFPARAM12	=	16		#取得的bios的软驱参数。
BFFLAG4	=	28			#软驱中断使用的标志
BBUF_100	=	32		#存储显示字符串的空间
BFLPRT10	=	132		#软驱控制器FDC读取的返回字节，最大返回字节数7,紧跟的一位存储返回字节数
WMEM2	=	142			#内存大小
#目前暂时定义上述共146字节的缓冲，该缓冲区的初始化由函数_init_data完成。并且该数据段寄存器默
#认为gs。

msg:	.ascii	\"booting................................[ok]\"
len=.-msg
merr:	.ascii	\"have an error!\"
lerr=.-merr
vv:		.long	0


.org	4092
.ascii	\"ttyy\"
.org	4096
.ascii	\"hello world~ reading floppy data on protected model success..\"	#61

.org	4605
.ascii	\"end\"




</pre></font>";
?>
