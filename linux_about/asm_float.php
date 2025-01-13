<?php
echo "<center><font size=5 color=#0000ff>汇编浮点指令</font></center>";
echo "<pre>1. 简介

    浮点数的操作指令与普通数据类型不同, 浮点数操作是通过浮点寄存器来实现的, 而普通数据类型使用的是通用寄存器,他们分别使用两套不同的指令

    浮点寄存器是通过栈结构来实现的, 共八个栈空间组成, 每个浮点寄存器站8字节.每次使用浮点寄存器都是率先使用ST(0), 而不能越过ST(0)直接使用ST(1). 浮点寄存器的使用就是压栈。出栈的过程.当ST(0)存在数据时, 执行压栈操作后,ST(0)中的数据将装入ST(1), 如无出栈操作,将顺序地向下压栈，知道将浮点寄存器出栈。</pre>";
echo "<img src='./28182842-05338af5962f4017baf6d50624e9643d.png'>";
echo "<pre>3. 实例

float数2.0的IEEE表示

表示成二进制: 10.0

右移一位 为1.00</pre>";
echo "<img src='./28182848-a44f57736b5b45b7bc1d5ca77ae7334e.png'>";
echo "<pre>0 01111111 000000000000000000000000  ;指数为01111111 表示为0

加上移动的位数1

0 10000000 000000000000000000000000  ; 这就是float的IEEE表示法

结果为40 00 00 00 
   1:  #include <stdio.h>

   2:

   3:  int main(int count, char** argv) {

   4:      float fFloat = (float)count;

   5:      printf('%f\\n', fFloat);

   6:

   7:      float fFloat1 = 2.0;

   8:      float fFloat2 = 1.0;

   9:

  10:      float fFloat3 = fFloat1 - fFloat2;

  11:      printf('%f\\n', fFloat3);

  12:

  13:      getchar();

  14:      return 0;

  15:  }



   1:  #include <stdio.h>

   2:

   3:  int main(int count, char** argv) {

   4:  00EA13B0  push        ebp

   5:  00EA13B1  mov         ebp,esp

   6:  00EA13B3  sub         esp,0F0h

   7:  00EA13B9  push        ebx

   8:  00EA13BA  push        esi

   9:  00EA13BB  push        edi

  10:  00EA13BC  lea         edi,[ebp-0F0h]

  11:  00EA13C2  mov         ecx,3Ch

  12:  00EA13C7  mov         eax,0CCCCCCCCh

  13:  00EA13CC  rep stos    dword ptr es:[edi]

  14:      float fFloat = (float)count;

  15:  00EA13CE  fild        dword ptr [count]

  16:  00EA13D1  fstp        dword ptr [fFloat]

  17:      printf('%f\\n', fFloat);

  18:  00EA13D4  fld         dword ptr [fFloat]

  19:  00EA13D7  mov         esi,esp

  20:  00EA13D9  sub         esp,8

  21:  00EA13DC  fstp        qword ptr [esp]

  22:  00EA13DF  push        offset string '%f\\n' (0EA5744h)

  23:  00EA13E4  call        dword ptr [__imp__printf (0EA82BCh)]

  24:  00EA13EA  add         esp,0Ch

  25:  00EA13ED  cmp         esi,esp

  26:  00EA13EF  call        @ILT+310(__RTC_CheckEsp) (0EA113Bh)

  27:

  28:      float fFloat1 = 2.0;

  29:  00EA13F4  fld         dword ptr [__real@40000000 (0EA5740h)]

  30:  00EA13FA  fstp        dword ptr [fFloat1]

  31:      float fFloat2 = 1.0;

  32:  00EA13FD  fld1

  33:  00EA13FF  fstp        dword ptr [fFloat2]

  34:

  35:      float fFloat3 = fFloat1 - fFloat2;

  36:  00EA1402  fld         dword ptr [fFloat1]

  37:  00EA1405  fsub        dword ptr [fFloat2]

  38:  00EA1408  fstp        dword ptr [fFloat3]

  39:      printf('%f\\n', fFloat3);

  40:  00EA140B  fld         dword ptr [fFloat3]

  41:  00EA140E  mov         esi,esp

  42:  00EA1410  sub         esp,8

  43:  00EA1413  fstp        qword ptr [esp]

  44:  00EA1416  push        offset string '%f\\n' (0EA5744h)

  45:  00EA141B  call        dword ptr [__imp__printf (0EA82BCh)]

  46:  00EA1421  add         esp,0Ch

  47:  00EA1424  cmp         esi,esp

  48:  00EA1426  call        @ILT+310(__RTC_CheckEsp) (0EA113Bh)

  49:

  50:      getchar();

  51:  00EA142B  mov         esi,esp

  52:  00EA142D  call        dword ptr [__imp__getchar (0EA82C4h)]

  53:  00EA1433  cmp         esi,esp

  54:  00EA1435  call        @ILT+310(__RTC_CheckEsp) (0EA113Bh)

  55:      return 0;

  56:  00EA143A  xor         eax,eax

  57:  }

  58:  00EA143C  pop         edi

  59:  00EA143D  pop         esi

  60:  00EA143E  pop         ebx

  61:  00EA143F  add         esp,0F0h

  62:  00EA1445  cmp         ebp,esp

  63:  00EA1447  call        @ILT+310(__RTC_CheckEsp) (0EA113Bh)

  64:  00EA144C  mov         esp,ebp

  65:  00EA144E  pop         ebp

  66:  00EA144F  ret

</pre>";

?>
