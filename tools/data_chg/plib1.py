#!/usr/bin/env python
#_*_coding:utf-8_*_
vv=0
def testcode(st):
	'''测试输入的字符串的编码方式'''
	if isinstance(st,unicode):
		return "unicode"
	try:
	 	st.decode('utf-8')
	 	return "utf-8"
	except:
		pass
	try:
	 	st.decode('gbk')
	 	return "gbk"
	except:
		 pass
def g_to_u(st,a):
	'''gbk to utf-8'''
	global vv
	val=testcode(st)
	if val == "unicode":
	   return st.encode('utf-8')
	elif val == "utf-8":
	   return st
	elif val == "gbk":
	   vv+=1
	   return st.decode('gbk').encode("utf-8")
	else:
	   print "unknown type line %d" % (a)
	   exit(0)

