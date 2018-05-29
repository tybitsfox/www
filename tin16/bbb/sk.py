#!/usr/bin/python
#_*_coding:utf-8_*_
#龙战士4技能资料的php文件生成脚本
pic="bof4_0"
sf=("./skill4.txt","bof4_skill.php")
bbbb="<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n<?php\necho \"<center><table width=70% border=1><tr><td width=100%>"
aaaa="</td></tr><tr><td width=100%>\";\necho \""
cccc="</td></tr></table></center>\";\n?>"
dddd="PIC_0"
f1=file(sf[0],"r")
f2=file(sf[1],"w")
while True:
	line=f1.readline()
	if len(line) == 0:
		break
	if len(line) <= 2:
		continue
	if line.find("BBBB") == 0:
		f2.write(bbbb)
	elif line.find("AAAA") == 0:
		f2.write(aaaa)
	elif line.find("CCCC") == 0:
		f2.write(cccc)
		break
	elif line.find(dddd) == 0:
		line1=line.rstrip()
		s1="<center><img src='./bof4_pic/%s%s.jpg' /></center>" % (pic,line1[-2:])
		f2.write(s1)
	else:
		s1="%s<br>\n" % (line.rstrip())
		f2.write(s1)
f1.close()
f2.close()

