#!/usr/bin/python
#_*_coding:utf-8_*_
#网站图片的备份和恢复脚本
import os
import sys
str=""
if(len(sys.argv) > 1):
	str=sys.argv[1]
	if (str[:2] == "--"):
		str=str[2:]
if((len(sys.argv) != 2) or (str.upper() == "HELP")):
	print "这是一个备份脚本,用于备份和恢复我个人网站中没有加入git的各类图片文件资料"
	print "一、备份：%s backup" % (sys.argv[0])
#	print "二、拷贝：cp -r var/* /var"
	print "二、恢复：%s restore" % (sys.argv[0])
	print "\t\t\033[1;31mAuthor:tybitsfox\033[0m 2017-10-23"
	exit(0)
base_dir="/var/www/"
s_dir=("tin16/ggg/ff4_images/","tin16/ccc/images/","tin16/ddd/ff6_images/","tin16/eee/ff2_images","tin16/fff/ff3_images","googlemap/gis_hb/images/",\
		"tin16/hhh/pic/","tin16/iii/pic1/","tin16/iii/gonglve/","tin16/jjj/walkm2/","tin16/jjj/pic/","tin16/jjj/images/","tin16/kkk/images/","tin16/kkk/tuwen/",\
		"tin16/lll/120810/","tin16/lll/121214/","tin16/mmm/allimg/");
#base_dir="./root/documents/aaa/gallery/"
#s_dir=("ff4_part_1-1","ff4_part_1-2","ff4_part_1-3")
bakfile="/tmp/web_pic.tar.bz2"
res_dir="var/*"
tag_dir="/var"
s=""
os.chdir("/tmp");
#备份
if(str.lower() == "backup"):
	for i in s_dir:
		s+=" "+base_dir+i
	str="tar cjvf %s %s" % (bakfile,s)
	os.system(str)
	print "网站图片资料:%s 备份完成" % (bakfile)
	exit(0)
#恢复	
if(str.lower() == "restore"):
	str="tar xjvf %s" % (bakfile)
	os.system(str)
	print "解压完成，文件拷贝中..."
	str="cp -r %s %s" % (res_dir,tag_dir)
#	os.system(str)
	print str
	print "网站图片资料恢复完成"
else:
	print "parameters error!"

