#!/usr/bin/env python
#_*_coding:utf-8_*_
#这是一个土壤监测数据转换为方便数据库录入的文本文件的转换脚本
#原始数据文件为：
#1、上报省厅的无机物监测数据文件，为excel格式，手工复制为纯数据文本文件:sss.txt,再经过gtou转换，确保为utf-8编码:sss1.txt
#2、监测点位的二维码对照表，为word格式，手工转换为纯数据文本文件:ssss.txt,再经过gtou转换，保证为utf-8编码:ssss1.txt
#3、一个从数据库导出的行政区划和点位id的对照表aid.txt
#4、两个tuple分别是从数据库中取出的对应林地和耕地的污染物id
#生成的文件res001.txt，是能够直接使用load data命令将数据一次导入数据库soil_val表的文件
#
#					Author:tybitsfox	2017-11-10
import os
src_file=("ssss1.txt","sss1.txt","aid.txt","res001.txt") #对应文件为：二维码对照文件，数据文件，行政区划对照文件，结果文件
id_tree=(51,52,53,20,4,24,40,32,36,8,12)					#对应林地的污染物id
id_field=(51,52,53,17,1,21,37,29,33,5,9)					#对应耕地的污染物id
dic={}				#encode=>sid	该字典为：二维码=>点位id
dia={}				#sid=>aid		该字典为：点位id=>行政区划
f1=open(src_file[0],"r")
for i in f1.readlines():
	i=i[:-2]
	s=i.split('\t')
	dic[s[2].strip()]=s[0].strip()
f1.close()
f1=open(src_file[2],"r")
for i in f1.readlines():
	i=i[:-2]				#去除回车
	s=i.split('|')
	dia[s[0].strip()]=s[1].strip()
f1.close()					#两个字典全部从文件建立完成
#for i,j in dic.items():
#	print "key: %s value: %s" % (i,j)
f2=open(src_file[1],"r")
f1=open(src_file[3],"w")
for s in f2.readlines():
	s=s[:-2]
	s1=s.split('\t')
	for i in range(0,11):
		if s1[8].strip() == "林地":
			j=id_tree[i]
		else:
			j=id_field[i]
		v=dic[s1[0].strip()]
		s2="%s,%d,0,%s,%s\n" % (v,j,s1[9+i].strip(),dia[v])
		f1.write(s2)
f2.close()
f1.close()	
print "finished!"
