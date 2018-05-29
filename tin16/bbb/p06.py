#!/usr/bin/python
#_*_coding:utf-8_*_
#又一个普通文本转php的脚本

sf=("./bbbvvv.txt","/tmp/bof4tmp1.txt","./b49.php")
f1=file(sf[0],"r")
f2=file(sf[2],"w")

titl="<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>\n<?php\n"
aaa="echo '<center><font color=red size=6>超详细剧情攻略</font><br>--by 搜珍玉鏡<br><table width=80% border=1><tr><td width=100%>"
bbb="';\necho '</td></tr><tr><td width=100%>"
ccc="</td></tr></table><a href=\"./bof4.php#begin\">返  回</a><br><table width=80% border=1>';echo '<tr><td width=100%>"
ddd="</tr></td></table><a href=\"./bof4.php#begin\">返  回</a><br></center>';\n?>"
f2.write(titl)
while True:
	line=f1.readline()
	if len(line) == 0:
		break
	line1=line.rstrip()	
	if line1 == "AAA":
		f2.write(bbb)
	elif line1 == "BBB":
		f2.write(aaa)
	elif line1 == "CCC":
		f2.write(ccc)
	elif line1 == "DDD":
		f2.write(ddd)
	else:
		line2="%s<br>\n" % (line1)
		f2.write(line2)
f1.close()
f2.close()
print "well done"

