<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<font size=5 color=red><center>openssl 开源安全工具箱</center></font><br>";
echo "<font size=3 color=blue><pre>";
echo "openssl是一个功能丰富且自包含的开源安全工具箱。它提供的主要功能有：SSL协议实现(包括SSLv2、SSLv3和TLSv1)、大量软算法(对称/非对称/摘要)、大数运算、非对称算法密钥生成、ASN.1编解码库、证书请求(PKCS10)编解码、数字证书编解码、CRL编解码、OCSP协议、数字证书验证、PKCS7标准实现和PKCS12个人数字证书格式实现等功能。
openssl采用C语言作为开发语言，这使得它具有优秀的跨平台性能。openssl支持Linux、UNIX、windows、Mac等平台";
echo "这里先简单介绍下，openssl的一个功能：对称加密 enc
enc为对称加解密工具，还可以进行base64编码转换。

用法：

openssl enc -ciphername [-in filename] [-out filename] [-pass arg] [-e ] [-d ] [-a ] [-A] [-k password ] [-kfile filename] [-K key] [-iv IV] [-p] [-P] [-bufsize number] [-nopad] [-debug]

选项：

-ciphername

对称算法名字，此命令有两种适用方式：-ciphername方式或者省略enc直接用ciphername。比如，用des3加密文件a.txt：

openssl enc -des3 -e -in a.txt -out b.txt

openssl des3 -e -in a.txt -out b.txt

-in filename

      输入文件，默认为标准输入。

-out filename

输出文件，默认为标准输出。

-pass arg

输入文件如果有密码保护，指定密码来源。

-e

进行加密操作，默认操作。

-d

进行解密操作。

-a

当进行加解密时，它只对数据进行运算，有时需要进行base64转换。设置此选项后，加密结果进行base64编码；解密前先进行base64解码。

       -A

默认情况下，base64编码结果在文件中是多行的。如果要将生成的结果在文件中只有一行，需设置此选项；解密时，必须采用同样的设置，否则读取数据时会出错。

       -k password

指定加密口令，不设置此项时，程序会提示用户输入口令。

-kfile filename

              指定口令存放的文件。

-K key

输入口令是16进制的。

-iv IV

初始化向量，为16进制。

比如：openss des-cbc -in a.txt -out b.txt -a -A -K 1111 -iv 2222

-p

打印出使用的salt、口令以及初始化向量IV。

-P

打印使用的salt、口令以及IV，不做加密和解密操作。

-bufsize number

设置I/O操作的缓冲区大小，因为一个文件可能很大，每次读取的数据是有限的。

 -debug

打印调试信息。

进行base64编码时，将base64也看作一种对称算法。

";
echo "<font size=4 color=red >openssl可配合tar完成加密打包操作：
加密压缩打包：
tar cjvf - targetfiles | openssl des3 -salt -k password -out targetfile.tar.bz2
cjvf后面的 '-' 代表了指定待打包的文件，因为f后面默认指定的是生成的打包后的目标文件名，所以，若要省略 '-',则需要去掉参数'f',上述命令也可以写为：
tar cjv targetfiles | openssl des3 -salt -k password -out targetfile.tar.bz2
解密解压解包：
openssl des3 -d -salt -k password -in targetfile.tar.bz2 | tar xjvf - -C /home/aaa/
同理，可以简化为：
openssl des3 -d -salt -k password -in targetfile.tar.bz2 | tar xjv -C /home/aaa/</font>
";
echo "</font></pre>";
?>

