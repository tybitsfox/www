<?php
header("Content-Type:text/html;charset=utf-8");
echo "<center><h2>关于python2.x下字符编码显示的总结</h2></center>";
echo "<font color=blue size=4><pre>";
echo "首先，python2.x对unicode编码标准是完全支持的，但unicode不仅是一种标准也是一种编码方案，依据该标准，具体的编码方案实现会是utf-8,utf-16,
gbk,ascii等等。
在python2.x中对纯unicode和utf-8是完全支持的，可以完美的进行显示，正常情况下gbk编码就不能显示了，这里就涉及到了在中文环境下对不同编码的转换。
不同编码间的转换是通过encode,decode函数实现的，但是对不同编码之间又不能直接使用上述两个函数转换，转换还需要一个中间层，那就是既是编码又是标
准的unicode。utf-8和gbk(我们在日常碰到最多的)的转换需要先转换为unicode再转换至目标编码。
例如：
s=u'山东' 
type是unicode,print可正常显示
s1=s.encode('gbk')     #将unicode编码为gbk后赋值给s1
type(s1)是str,print不能显示
s2=s.encode('utf-8')    #将unicode编码为utf-8后赋值给s2
type(s2)是str,print能正常显示
s3=s1.encode('utf-8')   #将gbk直接转码为utf-8,赋值给s3
>>>转换不会成功！对，encode的操作仅仅是将源编码默认为unicode,他是从unicode编码为其他类型的编码。
所以，这里需要先将gbk转换为纯unicode：
s3=s1.decode('gbk')     #s1是gbk编码，所以要用gbk再解码,这样s3又成了unicode了，实际上又回到了s ;)
这里还要说明的是，虽然unicode也是一种编码方案，但encode和decode的参数中并没有'unicode'，在python2.x中默认的decode参数是ascii
你可以这样测试：
s4=s1.decode()
>>>转换不会成功，给出的提示是无法使用ascii尽心解码。
这一默认设置在python下是可以修改的：
reload(sys)
sys.setdefaultencoding('gbk')
这样默认的解码方案使用的就是gbk了，而这时貌似gbk->utf-8就可以使用一个encode实现转换了，因为encode函数中调用了默认的解码函数decode()，但是这种转换
是不可逆的，因为编码函数调用了默认的解码函数，而默认的解码函数使用的是gbk解码方案！";
echo "</pre></font>";
?>
