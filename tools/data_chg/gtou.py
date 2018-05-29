#!/usr/bin/env python
#_*_coding:utf-8_*_
#尝试建立一个gbk转换为utf-8的脚本
#因为一些windowd下的文件都是使用的gbk编码
import os
import sys
import plib1
if len(sys.argv) != 3:
	print "用法：\n%s 待转换文件(gbk) 新文件（utf-8）" % (sys.argv[0])
	exit(0)
if not os.path.isfile(sys.argv[1]):
	print "请检查输入的待转换文件"
	exit(0)
#再检查待转换的文件是否为gbk编码
f1=open(sys.argv[1],"r")
f2=open(sys.argv[2],"w")
i=0
for st1 in f1.readlines():
	i+=1
	st2=plib1.g_to_u(st1,i)
	f2.write(st2)
f1.close()
f2.close()
print "ok! total lines: %d changed %d " % (i,plib1.vv)
