<?php
echo "<center><font size=5 color=#0000ff>汇编指令一</font></center><br><pre>";
echo "21. NEG

    取补指令 NEG(NEGate)

    格式: NEG OPRD

    功能: 对操作数OPRD进行取补操作,然后将结果送回OPRD.取补操作也叫作求补操作,就是求一个数的相反数的补码.

 

       说明:

    1. OPRD为任意通用寄存器或存储器操作数.

    2. 示例: (AL)=44H,取补后,(AL)=0BCH(-44H).
     
    3. 本指令影响标志位CF、OF、SF、PF、ZF及AF.

22. CMP

    比效指令 CMP(CoMPare)

    格式: CMP OPRD1,OPRD2

    功能: 对两数进行相减,进行比较.

 

       说明:

    1. OPRD1为任意通用寄存器或存储器操作数.

       OPRD2为任意通用寄存器或存储器操作数,立即数也可用作源操作数OPRD2.

    2. 对标志位的影响同SUB指令,完成的操作与SUB指令类似,唯一的区别是不将OPRD1-OPRD2的结果送回OPRD1,而只是比较.

    3. 在8088/8086指令系统中,专门提供了一组根据带符号数比较大小后,实现条件转移的指令.

23. AAS

       具体用法请查看另外一篇文章: BCD码指令AAA DAA AAS DAS AAM AAD

24. DAS

      具体用法请查看另外一篇文章: BCD码指令AAA DAA AAS DAS AAM AAD

25. MUL

    无符号数乘法指令 MUL(MULtiply)

    格式: MUL OPRD 

    功能: 乘法操作.

说明:

    1. OPRD为通用寄存器或存储器操作数.

    2. OPRD为源操作数,即作乘数.目的操作数是隐含的,即被乘数总是指定为累加器AX或AL的内容.

    3. 16位乘法时,AX中为被乘数.8位乘法时,AL为被乘数.当16位乘法时,32位的乘积存于DX及AX中;8位乘法的16位乘积存于AX中.

    4. 操作过程: 字节相乘:(AX)<--(AL)*OPRD,当结果的高位字节(AH)不等于0时,则CF＝1、OF＝1.

26. IMUL

    带符号数乘法指令 IMUL(Integer MULtiply)

    格式: IMUL OPRD

    功能: 完成两个带符号数的相乘

       说明:

    1. 其中OPRD为任一通用寄存器或存储器操作数.

    2. MUL指令对带符号相乘时,不能得到正确的结果.
      
      例如:

            (AL)=255
            (CL)=255
             MUL CL
            (AX)=65025
    注意: 这对无符号数讲,结果是正确的,但对带符号数讲,相当于(-1)*(-1)结果应为+1,而65025对应的带符号数为-511,显然是不正确的.

27. AAM

       具体用法请查看另外一篇文章: BCD码指令AAA DAA AAS DAS AAM AAD

28. DIV

    无符号数除法指令 DIV(DIVision)

    格式: DIV OPRD

    功能: 实现两个无符号二进制数除法运算.

       说明:

    1. 其中OPRD为任一个通用寄存器或存储器操作数.

    2. 字节相除,被除数在AX中;字相除,被除数在DX,AX中,除数在OPRD中.
         
       字节除法: (AL)<--(AX)/OPRD,(AH)<--(AX)MOD OPRD
      
       字除法:   (AX)<--(DX)(AX)/OPRD,(DX)<--(DX)(AX) MOD OPRD

29. IDIV

    带符号数除法指定 IDIV(Interger DIVision)

    格式: IDIV OPRD 

    功能: 这实现两个带符号数的二进制除法运算.

      说明:

    1. 其中OPRD为任一通用寄存器或存储器操作数.

    2. 理由与IMUL相同,只有IDIV指令,才能得到符号数相除的正确结果.

    3. 当被除数为8位,在进行字节除法前,应把AL的符号位扩充至AH中.在16位除法时,若被除数为16位,则应将AX中的符号位扩到DX中.

30. CBW

    字节扩展指令 CBW(Convert Byte to Word)
     
    格式: CBW

    功能: 将字节扩展为字,即把AL寄存器的符号位扩展到AH中.

      说明:

    1. 两个字节相除时,先使用本指令形成一个双字节长的被除数.

    2. 本指令不影响标志位.

    3. 示例:

             MOV AL,25
             CBW
             IDIV BYTE PTR DATA1
</pre>";
?>
