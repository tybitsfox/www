<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<font size=6 color=#ff0000><center>硬件端口资料</center></font><br><br><br>";
echo "<font size=5 color=red>显示相关的端口</font><br>";
echo "一、光标设置端口：0x3d4,0x3d5<br>";
echo "<pre>  操作端口：CGA为：0x3d4,0x3d5
光标的读写需要使用一对端口：0x3d4与0x3d5。其中，0x3d4是索引端口，0x3d5是数据端口。这一对端口就像一个数组，想要读写数据，需要依次进行两步操作：
    向0x3d4端口写入一个索引值
    从0x3d5端口读出或写入数据
光标是一个16位的数字，其表示的是：从屏幕左上角开始偏移的字符数（注意不是字节数）。然而，0x3d4与0x3d5端口都是8位端口，所以，对光标的读写需要分成高8位与低8位分别进行，具体操作步骤如下：
    向0x3d4端口写入0xe
    从0x3d5端口读取或写入光标的高8位
    向0x3d4端口写入0xf
    从0x3d5端口读取或写入光标的低8位</pre>";
?>


