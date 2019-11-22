<html><title>tr命令简介</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<body TEXT="#000000" LINK="#AA0000" VLINK="#AA0055" ALINK="#AA0000" STYLE="font-size:18px; font-family:宋体, Arial; font-weight:bolder; line-height:130%;">
<?php
echo "
tr 是 Linux 和 Unix 系统中的命令行实用程序，用于转换，删除和挤压标准输入中的字符，并将结果写入标准输出。<br>
该 tr 命令通常通过管道与其他命令结合使用，可以执行删除重复字符，将大写转换为小写，以及替换和删除基本字符等操作。<br>
在本教程中，我们将向您展示如何 tr 通过实际示例和最常见选项的详细说明来使用该命令。<br>
如何使用 Tr 命令<br>
该 tr 命令的语法如下：<br>
tr OPTION... SET1 [SET2]<br>
tr  接受两组字符，通常具有相同的长度，并用第二组中的相应字符替换第一组的字符。<br>
一个 SET 就是一串字符，包括特殊的反斜杠转义字符。<br>
<font color=red>在下面的示例中， tr 将 linuxidc 通过将第一个集合中的字符与第二个集合中的匹配元素进行映射来替换标准输入中的所有字符。</font><br>
linuxidc@linuxidc:~/www.linuxidc.com$ echo 'linuxidc' | tr 'lin' 'red'<br>
tr 将使用 r 替换 l ，使用 e 替换 i 和 d 替换 n 。<br>
reduxedc<br>
还可以使用字符范围定义字符集。例如:<br>
linuxidc@linuxidc:~/www.linuxidc.com$ echo 'linuxidc' | tr 'lmno' 'wxyz'<br>
wiyuxidc<br>
您可以使用：<br>
linuxidc@linuxidc:~/www.linuxidc.com$ echo 'linuxidc' | tr 'l-n' 'w-z'<br>
wiyuxidc<br>
<font color=red>当使用 -c(--complement) 选项时， tr 将替换不在 SET1 中的所有字符。</font><br>
在下面的示例中， SET1 中不包含的所有字符将替换为 SET2 中的最后一个字符：<br>
echo 'linuxidc' | tr -c 'li' 'xy'<br>
liyyyiyyy<br>
您可能已经注意到输出比输入多了一个字符。这是因为该 echo 命令打印了一个不可见换行符 \\n 也被替换为 y 。要在没有新行的情况下回显字符串，请使用该 -n 选项。<br>
<font color=red>-d(--delete) 选项告诉 tr 以删除 SET1 指定的字符。</font><br>
以下命令将删除 SET1 中指定的所有字符。在不挤压的情况下删除字符时，只能指定一个字符集。<br>
linuxidc@linuxidc:~/www.linuxidc.com$ echo 'Linuxidc' | tr -d 'lid'<br>
L 不会删除该字符，因为输入包含的是大写的 L ，而集合中的字符包含小写的 l 。<br>
Lnuxc<br>
<font color=red>在 -s(--squeeze-repeats) 选项替换重复出现的字符集。在以下示例 tr 中将删除重复的空格字符：</font><br>
linuxidc@linuxidc:~/www.linuxidc.com$ echo \"GNU    \    Linux\" | tr -s ' '<br>
GNU \ Linux<br>
使用 SET2 时， SET1 中指定的字符序列将替换为 SET2 。<br>
linuxidc@linuxidc:~/www.linuxidc.com$ echo \"GNU    \    Linux\" | tr -s ' ' '_'<br>
GNU_\_Linux<br>
<font color=red>-t(--truncate-set1) 选项强制 tr 到做进一步处理之前截断 SET1 到 SET2 的长度。</font><br>
默认情况下，如果 SET1 大于 SET2   tr 将重用 SET2  的最后一个字符。这是一个例子：<br>
linuxidc@linuxidc:~/www.linuxidc.com$ echo 'Linux idc' | tr 'abcde' '12'<br>
输出将显示 SET1 中的字符 e 与 SET2 的最后字符匹配，即 2 ：<br>
Linux i22<br>
现在使用带有 -t 选项的相同命令：<br>
linuxidc@linuxidc:~/www.linuxidc.com$ echo 'Linux idc' | tr -t 'abcde' '12'<br>
您可以看到，在这种情况下， SET1 的最后三个字符将被删除。 SET1 变为 ‘ab’ ，与 SET2 的长度相同。<br>
Linux idc<br>
组合选项<br>
该 tr 命令还允许您组合使用选项。例如，下面的命令将替换所有字符除了 i 用 0 ，然后它会挤压重复 0 字符：<br>
echo 'Linux idc' | tr -cs 'i' '0'<br>
0i0i0<br>
Tr 命令示例<br>
在本节中，我们将介绍 tr 命令常见用法的几个示例。<br>
<font color=red>将小写转换为大写</font><br>
将小写转换为大写或大写转为小写是 tr 命令的典型用例之一。 [:lower:] 匹配所有小写字符， [:upper:] 匹配所有大写字符。<br>
echo 'Linuxidc' | tr '[:lower:]' '[:upper:]'<br>
LINUXidc<br>
您也可以使用范围代替字符类：<br>
echo 'Linuxidc' | tr 'a-z' 'A-Z'<br>
要将大写字母转换为小写字母，只需切换集合的位置即可。<br>
删除所有非数字字符<br>
以下示例将从传递给 tr 命令的输入中删除所有非数字字符：<br>
echo \"my phone is 123-456-7890\" | tr -cd [:digit:]<br>
[:digit:] 代表所有数字字符，通过使用该 -c 选项，该命令将删除所有非数字字符。输出将如下所示：<br>
将每个单词放在新行中<br>
要将每个单词放在一个新行中，我们需要匹配所有非 alpha 数字字符并用新行替换它们：<br>
linuxidc@linuxidc:~/www.linuxidc.com$ echo 'GNU is an operating system' | tr -cs '[:alnum:]' '\\n'<br>
GNU<br>
is<br>
an<br>
operating<br>
system<br>
<font color=red>删除空行</font><br>
要删除空白行，只需挤压重复的换行符：<br>
tr -s '\\n' < file.txt > new_file.txt<br>
在上面的命令中，我们使用重定向符号将命令 < 的内容作为输入传递 file.txt 给 tr 命令。重定向 > 将命令的输出写入 new_file.txt 。<br>
在单独的行上打印 \$PATH 目录<br>
该 \$PATH 环境变量是一个冒号分隔的列表，告诉 SHELL 当你输入一个命令时可以在哪些目录来搜索可执行文件。<br>
要在单独的行上打印每个目录，我们需要匹配冒号 (:) 并将其替换为新行：<br>
linuxidc@linuxidc:~/www.linuxidc.com$ echo \$PATH | tr  ':' '\\n'<br>
/home/linuxidc/.cargo/bin<br>
/home/linuxidc/.local/bin<br>
/usr/local/sbin<br>
/usr/local/bin<br>
/usr/sbin<br>
/usr/bin<br>
/sbin<br>
/bin<br>
/usr/games<br>
/usr/local/games<br>
/snap/bin<br>
/opt/nodejs/bin<br>
<font color=red>到目前为止，您应该很好地理解如何使用 Linux   tr 命令。虽然非常有用， tr 但只能使用单个字符。对于更复杂的模式匹配和字符串操作，您应该使用 sed 或 awk 。</font><br>
<br>
";
?>
</body><html>
