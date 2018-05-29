<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<center><font size=5 color=red>W3M使用简介</font></center>";
echo "<br><table border=0 width=100%><tr width=100%><td width=10%></td><td width=80%><font size=4 color=black><pre>";
echo "在debian下的安装：apt-get install w3m w3m-img
w3m是一个基于文本的网页浏览器，支持多种操作系统，在命令行终端可以很好的支持中文。即使在没有鼠标支持的情况下也
可以检查网页的输出。本文列出常用的快捷键
[编辑] 页面操作
^,C-a 到行首
$,C-e 到行尾
w 到下一个单词
W 到上一个单词
> 右移一屏
< 左移一屏
. 屏幕右移一列
, 屏幕左移一列
g,M-< 到首行
G,M-> 到末行
ESC g 到指定行
Z 当前行居中
z 当前列居中
TAB 转到下个超链接
[ 到第一个超链接
] 到最後一个超链接
RET 打开超链接
a, ESC RET 链接另存为
u 查看链接url
i 查看图片url
I 查看图片
ESC I 图片另存为
[编辑] 缓存操作

B 返回
v 查看源代码
s 选择缓存
E 编辑缓存代码
C-l 重画屏幕
R 刷新
S 页面另存为
ESC s 源码另存为
ESC e 编辑图片

[编辑] 缓存选择模式（也就是按了s以後）

k, C-p 上一缓存
j, C-n 下一缓存
D 删除当前缓存
RET 转至选择的缓存

[编辑] 书签操作

ESC b 打开书签
ESC a 添加当前页到书签

[编辑] 搜索

/,C-s 向前搜索
?,C-r 向後搜索
n 下一个
N 上一个
C-w 打开/关闭 循环搜索

[编辑] 杂项
q 退出（需确认）
Q 退出而不确认
C-c 终止

[编辑] 行编辑模式
RETURN 确定
";
echo "</pre></font></td><td width=10%></td></tr><table>";
?>
