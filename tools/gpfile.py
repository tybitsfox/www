#!/usr/bin/env pytohn
#_*_coding:utf-8_*_
#这是一个使用sed命令对批量文件进行行删减处理的脚本
import os
for a,b,c in os.walk("./"):
	for x in c:
		y=x[-3:]
		if(y.lower() == "htm"):
			str="sed -i 's/walkthrough.html/zhaoce_walkthrough_advance.htm/g' %s" % (x)
			os.system(str)
			print("modified: %s" % (x))
#			print(str)
print("finished!!!");
exit(0)
for a,b,c in os.walk("./"):
	for x in c:
		y=x[-3:]
		if(y.lower() == "htm"):
#			print x
			str="sed -i '/^<li><a href=\"enemies.htm/d' %s" % (x)
			os.system(str)
			str="sed -i '/^<li><a href=\"enlocation.htm/d' %s" % (x)
			os.system(str)
			str="sed -i '/^<li><a href=\"esm.htm'/d %s" % (x)
			os.system(str)
			str="sed -i '/^<li><a href=\"translation'/d %s" % (x)
			os.system(str)
print("finished!")
