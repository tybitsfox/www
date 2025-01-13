<?php
echo "<center><font size=5 color=#0000ff>汇编指令一</font></center><br><pre>";
echo"
        11. LDS

    从存储器取出32位地址的指令 LDS

    格式: LDS OPRD1,OPRD2

    功能: 从存储器取出32位地址的指令.

       说明:

    OPRD1 为任意一个16位的寄存器.

    OPRD2 为32位的存储器地址.

      示例:

          LDS SI,ABCD
          LDS BX,FAST[SI]
          LDS DI,[BX]

       注意: 上面LDS DI,[BX]指令的功能是把BX所指的32位地址指针的段地址送入DS,偏移地址送入DI.

        12. LES

    从存储器取出32位地址的指令 LES

    格式: LES OPRD1,OPRD2
     
    功能: 从存储器取出32位地址的指令.

       说明:

OPRD1 为任意一个16位的寄存器.

OPRD2 为32位的存储器地址.
 
      示例:

          LES SI,ABCD
          LES BX,FAST[SI]
          LES DI,[BX]

        注意: 上面LES DI,[BX]指令的功能是把BX所指的32位地址指针的段地址送入ES,偏移地址送入DI.

        13. ADD

    加法指令 ADD(Addition)
     
    格式: ADD OPRD1,OPRD2

    功能: 两数相加

       说明:

    1. OPRD1为任一通用寄存器或存储器操作数,可以是任意一个通用寄存器,而且还可以是任意一个存储器操作数.

       OPRD2为立即数,也可以是任意一个通用寄存器操作数.立即数只能用于源操作数.

    2. OPRD1和OPRD2均为寄存器是允许的,一个为寄存器而另一个为存储器也是允许的, 但不允许两个都是存储器操作数.

    3. 加法指令运算的结果对CF、SF、OF、PF、ZF、AF都会有影响.以上标志也称为结果标志.加法指令适用于无符号数或有符号数的加法运算.

    14. ADC

    带进位加法指令 ADC(Addition Carry)

    格式: ADC OPRD1,OPRD2

    功能: OPRD1<--OPRD1 + OPRD2 + CF

      说明:

    1. OPRD1为任一通用寄存器或存储器操作数,可以是任意一个通用寄存器,而且还可以是任意一个存储器操作数.
       OPRD2为立即数,也可以是任意一个通用寄存器操作数.立即数只能用于源操作数.

    2. OPRD1和OPRD2均为寄存器是允许的,一个为寄存器而另一个为存储器也是允许的,但不允许两个都是存储器操作数.

    3. 加法指令运算的结果对CF、SF、OF、PF、ZF、AF都会有影响.以上标志也称为结果标志.

    4. 该指令对标志位的影响同ADD指令.

    15. INC

    加1指令 INC(INCrement by 1)

    格式: INC OPRD
     
    功能: OPRD<--OPRD+1

       说明:

    1. OPRD 为寄存器或存储器操作数.

    2. 这条指令执行结果影响AF、OF、PF、SF、ZF标志位,但不影响CF标志位.

    3. 示例:
            INC SI;(SI)<--(SI)+1
            INC WORD PTR[BX]
            INC BYTE PTR[BX+DI]
            INC CL;(CL)<--(CL)+1

    注意: 上述第二,三两条指令,是对存储字及存储字节的内容加1以替代原来的内容.
</pre>"
?>
