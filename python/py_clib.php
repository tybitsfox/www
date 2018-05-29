<?php
header("Content-Type:text/html;charset=utf-8");
echo "<center><h2>linux下用C编写python扩展模块</h2></center>";
echo "<center><table width=60% border=0 cellpading=0 cellspacing=0>";
echo "<tr><td><font size=6>一、简介</font></td></tr>";
echo "<tr><td><font size=4>&nbsp;&nbsp;&nbsp;&nbsp;Python是一门功能强大的高级脚本语言，它的强大不仅表现在其自身的功能上，而且还表现在其良好的可扩展性上，正因如此，Python已经开始受到越来越多人的青睐，并且被屡屡成功地应用于各类大型软件系统的开发过程中。<br><br>
与其它普通脚本语言有所不同，Python程序员可以借助Python语言提供的API，使用C或者C++来对Python进行功能性扩展，从而即可以利用Python方便灵活的语法和功能，又可以获得与C或者C++几乎相同的执行性能。执行速度慢是几乎所有脚本语言都具有的共性，也是倍受人们指责的一个重要因素，Python则通过与C语言的有机结合巧妙地解决了这一问题，从而使脚本语言的应用范围得到了很大扩展。<br><br>
在用Python开发实际软件系统时，很多时候都需要使用C/C++来对Python进行扩展。最常见的情况是目前已经存在一个用C编写的库，需要在Python语言中使用该库的某些功能，此时就可以借助Python提供的扩展功能来实现。此外，由于Python从本质上讲还是一种脚本语言，某些功能用Python实现可能很难满足实际软件系统对执行效率的要求，此时也可以借助Python提供的扩展功能，将这些关键代码段用C或者C++实现，从而提供程序的执行性能。<br><br>
本文主要介绍Python提供的C语言扩展接口，以及如何使用这些接口和C/C++语言来对Python进行功能性扩展，并辅以具体的实例讲述如何实现Python的功能扩展。<br><br></pre></font></td></tr>";
echo "<tr><td><font size=6>二、Python的C语言接口</font></td></tr>";
echo "<tr><td><font size=4>Python是用C语言实现的一种脚本语言，本身具有优良的开放性和可扩展性，并提供了方便灵活的应用程序接口(API)，从而使得C/C++程序员能够在各个级别上对Python解释器的功能进行扩展。在使用C/C++对Python进行功能扩展之前，必须首先掌握Python解释所提供的C语言接口。<br><br>
</font></td></tr>";
echo "<tr><td><font size=5>2.1 Python对象(PyObject)</font></td></tr>";
echo "<tr><td><font size=4><br>Python是一门面向对象的脚本语言，所有的对象在Python解释器中都被表示成PyObject，PyObject结构包含Python对象的所有成员指针，并且对Python对象的类型信息和引用计数进行维护。在进行Python的扩展编程时，一旦要在C或者C++中对Python对象进行处理，就意味着要维护一个PyObject结构。
<br><br>在Python的C语言扩展接口中，大部分函数都有一个或者多个参数为PyObject指针类型，并且返回值也大都为PyObject指针。<br><br>
</font></td></tr>";
echo "<tr><td><font size=5>2.2 引用计数</font></td></tr>";
echo "<tr><td><font size=4><br>为了简化内存管理，Python通过引用计数机制实现了自动的垃圾回收功能，Python中的每个对象都有一个引用计数，用来计数该对象在不同场所分别被引用了多少次。每当引用一次Python对象，相应的引用计数就增1，每当消毁一次Python对象，则相应的引用就减1，只有当引用计数为零时，才真正从内存中删除Python对象。<br><br>
下面的例子说明了Python解释器如何利用引用计数来对Pyhon对象进行管理：<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;例1:refcount.py<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;class refcount:<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;# etc.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;r1 = refcount() # 引用计数为1<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;r2 = r1         # 引用计数为2<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;del(r1)         # 引用计数为1<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;del(r2)         # 引用计数为0，删除对象<br><br>
/C++中处理Python对象时，对引用计数进行正确的维护是一个关键问题，处理不好将很容易产生内存泄漏。Python的C语言接口提供了一些宏来对引用计数进行维护，最常见的是用Py_INCREF()来增加使Python对象的引用计数增1，用Py_DECREF()来使Python对象的引用计数减1。<br><br></font></td></tr>";
echo "<tr><td><font size=5>2.3 数据类型</font></td></tr>";
echo "<tr><td><font size=4><br>Python定义了六种数据类型：整型、浮点型、字符串、元组、列表和字典，在使用C语言对Python进行功能扩展时，首先要了解如何在C和Python的数据类型间进行转化。<br><br></font></td></tr>";
echo "<tr><td><font size=4><strong>2.3.1 整型、浮点型和字符串</strong></font></td></tr>";
echo "<tr><td><font size=4><br>在Python的C语言扩展中要用到整型、浮点型和字符串这三种数据类型时相对比较简单，只需要知道如何生成和维护它们就可以了。下面的例子给出了如何在C语言中使用Python的这三种数据类型：<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;例2：typeifs.c
&nbsp;&nbsp;&nbsp;&nbsp;// build an integer<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyObject* pInt = Py_BuildValue('i', 2003);<br>
&nbsp;&nbsp;&nbsp;&nbsp;assert(PyInt_Check(pInt));<br>
&nbsp;&nbsp;&nbsp;&nbsp;int i = PyInt_AsLong(pInt);<br>
&nbsp;&nbsp;&nbsp;&nbsp;Py_DECREF(pInt);<br>
&nbsp;&nbsp;&nbsp;&nbsp;// build a float<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyObject* pFloat = Py_BuildValue('f', 3.14f);<br>
&nbsp;&nbsp;&nbsp;&nbsp;assert(PyFloat_Check(pFloat));<br>
&nbsp;&nbsp;&nbsp;&nbsp;float f = PyFloat_AsDouble(pFloat);<br>
&nbsp;&nbsp;&nbsp;&nbsp;Py_DECREF(pFloat);<br>
&nbsp;&nbsp;&nbsp;&nbsp;// build a string<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyObject* pString = Py_BuildValue('s', 'Python');<br>
&nbsp;&nbsp;&nbsp;&nbsp;assert(PyString_Check(pString);<br>
&nbsp;&nbsp;&nbsp;&nbsp;int nLen = PyString_Size(pString);<br>
&nbsp;&nbsp;&nbsp;&nbsp;char* s = PyString_AsString(pString);<br>
&nbsp;&nbsp;&nbsp;&nbsp;Py_DECREF(pString);<br><br></font></td></tr>";
echo "<tr><td><font size=4><strong>2.3.2 元组</strong></font></td></tr>";
echo "<tr><td><font size=4><br>Python语言中的元组是一个长度固定的数组，当Python解释器调用C语言扩展中的方法时，所有非关键字(non-keyword)参数都以元组方式进行传递。下面的例子示范了如何在C语言中使用Python的元组类型：<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;例3：typetuple.c
&nbsp;&nbsp;&nbsp;&nbsp;// create the tuple<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyObject* pTuple = PyTuple_New(3);<br>
&nbsp;&nbsp;&nbsp;&nbsp;assert(PyTuple_Check(pTuple));<br>
&nbsp;&nbsp;&nbsp;&nbsp;assert(PyTuple_Size(pTuple) == 3);<br>
&nbsp;&nbsp;&nbsp;&nbsp;// set the item<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyTuple_SetItem(pTuple, 0, Py_BuildValue('i', 2003));<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyTuple_SetItem(pTuple, 1, Py_BuildValue('f', 3.14f));<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyTuple_SetItem(pTuple, 2, Py_BuildValue('s', 'Python'));<br>
&nbsp;&nbsp;&nbsp;&nbsp;// parse tuple items<br>
&nbsp;&nbsp;&nbsp;&nbsp;int i;<br>
&nbsp;&nbsp;&nbsp;&nbsp;float f;<br>
&nbsp;&nbsp;&nbsp;&nbsp;char *s;<br>
&nbsp;&nbsp;&nbsp;&nbsp;if (!PyArg_ParseTuple(pTuple, 'ifs', &i, &f, &s))<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PyErr_SetString(PyExc_TypeError, 'invalid parameter');<br>
&nbsp;&nbsp;&nbsp;&nbsp;// cleanup<br>
&nbsp;&nbsp;&nbsp;&nbsp;Py_DECREF(pTuple);<br><br></font></td></tr>";
echo "<tr><td><font size=4><strong>2.3.3 列表</strong></font></td></tr>";
echo "<tr><td><font size=4><br>Python语言中的列表是一个长度可变的数组，列表比元组更为灵活，使用列表可以对其存储的Python对象进行随机访问。下面的例子示范了如何在C语言中使用Python的列表类型：<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;例4：typelist.c<br>
&nbsp;&nbsp;&nbsp;&nbsp;// create the list<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyObject* pList = PyList_New(3); // new reference<br>
&nbsp;&nbsp;&nbsp;&nbsp;assert(PyList_Check(pList));<br>
&nbsp;&nbsp;&nbsp;&nbsp;// set some initial values<br>
&nbsp;&nbsp;&nbsp;&nbsp;for(int i = 0; i < 3; ++i)<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PyList_SetItem(pList, i, Py_BuildValue('i', i));<br>
&nbsp;&nbsp;&nbsp;&nbsp;// insert an item<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyList_Insert(pList, 2, Py_BuildValue('s', 'inserted'));<br>
&nbsp;&nbsp;&nbsp;&nbsp;// append an item<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyList_Append(pList, Py_BuildValue('s', 'appended'));<br>
&nbsp;&nbsp;&nbsp;&nbsp;// sort the list<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyList_Sort(pList);<br>
&nbsp;&nbsp;&nbsp;&nbsp;// reverse the list<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyList_Reverse(pList);<br>
&nbsp;&nbsp;&nbsp;&nbsp;// fetch and manipulate a list slice<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyObject* pSlice = PyList_GetSlice(pList, 2, 4); // new reference<br>
&nbsp;&nbsp;&nbsp;&nbsp;for(int j = 0; j < PyList_Size(pSlice); ++j) {<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PyObject *pValue = PyList_GetItem(pList, j);<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;assert(pValue);<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;&nbsp;&nbsp;Py_DECREF(pSlice);<br>
&nbsp;&nbsp;&nbsp;&nbsp;// cleanup<br>
&nbsp;&nbsp;&nbsp;&nbsp;Py_DECREF(pList);<br><br></font></td></tr>";
echo "<tr><td><font size=4><strong>2.3.4 字典</strong></font></td></tr>";
echo "<tr><td><font size=4><br>Python语言中的字典是一个根据关键字进行访问的数据类型。下面的例子示范了如何在C语言中使用Python的字典类型：<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;例5：typedic.c<br>
&nbsp;&nbsp;&nbsp;&nbsp;// create the dictionary<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyObject* pDict = PyDict_New(); // new reference<br>
&nbsp;&nbsp;&nbsp;&nbsp;assert(PyDict_Check(pDict));<br>
&nbsp;&nbsp;&nbsp;&nbsp;// add a few named values<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyDict_SetItemString(pDict, 'first', <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Py_BuildValue('i', 2003));<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyDict_SetItemString(pDict, 'second', <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Py_BuildValue('f', 3.14f));<br>
&nbsp;&nbsp;&nbsp;&nbsp;// enumerate all named values<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyObject* pKeys = PyDict_Keys(); // new reference<br>
&nbsp;&nbsp;&nbsp;&nbsp;for(int i = 0; i < PyList_Size(pKeys); ++i) {<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PyObject *pKey = PyList_GetItem(pKeys, i);<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PyObject *pValue = PyDict_GetItem(pDict, pKey);<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;assert(pValue);<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;&nbsp;&nbsp;Py_DECREF(pKeys);<br>
&nbsp;&nbsp;&nbsp;&nbsp;// remove a named value<br>
&nbsp;&nbsp;&nbsp;&nbsp;PyDict_DelItemString(pDict, 'second');<br>
&nbsp;&nbsp;&nbsp;&nbsp;// cleanup<br>
&nbsp;&nbsp;&nbsp;&nbsp;Py_DECREF(pDict);<br><br>
</font></td></tr>";
echo "<tr><td><font size=6>三、Python的C语言扩展</font></td></tr>";
echo "<tr><td><font size=5><br>3.1 模块封装</font></td></tr>";
echo "<tr><td><font size=4></font><br>在了解了Python的C语言接口后，就可以利用Python解释器提供的这些接口来编写Python的C语言扩展，假设有如下一个C语言函数：<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;例6：example.c<br>
&nbsp;&nbsp;&nbsp;&nbsp;int fact(int n)<br>
&nbsp;&nbsp;&nbsp;&nbsp;{<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (n <= 1) <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return 1;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return n * fact(n - 1);<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
该函数的功能是计算某个给定自然数的阶乘，如果想在Python解释器中调用该函数，则应该首先将其实现为Python中的一个模块，这需要编写相应的封装接口，如下所示：<br><br>
&nbsp;&nbsp;&nbsp;例7: wrap.c<br>
&nbsp;&nbsp;&nbsp;#include <Python.h><br>
&nbsp;&nbsp;&nbsp;PyObject* wrap_fact(PyObject* self, PyObject* args) <br>
&nbsp;&nbsp;&nbsp;{<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;int n, result;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (! PyArg_ParseTuple(args, 'i:fact', &n))<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return NULL;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;result = fact(n);<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return Py_BuildValue('i', result);<br>
&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;&nbsp;static PyMethodDef exampleMethods[] = <br>
&nbsp;&nbsp;&nbsp;{<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{'fact', wrap_fact, METH_VARARGS, 'Caculate N!'},<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{NULL, NULL}<br>
&nbsp;&nbsp;&nbsp;};<br>
&nbsp;&nbsp;&nbsp;void initexample() <br>
&nbsp;&nbsp;&nbsp;{<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PyObject* m;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;m = Py_InitModule('example', exampleMethods);<br>
&nbsp;&nbsp;&nbsp;}<br><br>
一个典型的Python扩展模块至少应该包含三个部分：导出函数、方法列表和初始化函数。<br><br></td></tr>";
echo "<tr><td><font size=5>3.2 导出函数</font></td></tr>";
echo "<tr><td><font size=4><br>要在Python解释器中使用C语言中的某个函数，首先要为其编写相应的导出函数，上述例子中的导出函数为wrap_fact。在Python的C语言扩展中，所有的导出函数都具有相同的函数原型：<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;PyObject* method(PyObject* self, PyObject* args);<br><br>
该函数是Python解释器和C函数进行交互的接口，带有两个参数：self和args。参数self只在C函数被实现为内联方法(built-in method)时才被用到，通常该参数的值为空(NULL)。参数args中包含了Python解释器要传递给C函数的所有参数，通常使用Python的C语言扩展接口提供的函数PyArg_ParseTuple()来获得这些参数值。<br>
所有的导出函数都返回一个PyObject指针，如果对应的C函数没有真正的返回值(即返回值类型为void)，则应返回一个全局的None对象(Py_None)，并将其引用计数增1，如下所示：<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;PyObject* method(PyObject *self, PyObject *args)<br>
&nbsp;&nbsp;&nbsp;&nbsp;{<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Py_INCREF(Py_None);<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return Py_None;<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br><br></font></td></tr>";
echo "<tr><td><font size=5>3.3 方法列表</font></td></tr>";
echo "<tr><td><font size=4><br>方法列表中给出了所有可以被Python解释器使用的方法，上述例子对应的方法列表为：<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;static PyMethodDef exampleMethods[] = <br>
&nbsp;&nbsp;&nbsp;&nbsp;{<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{'fact', wrap_fact, METH_VARARGS, 'Caculate N!'},<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{NULL, NULL}<br>
&nbsp;&nbsp;&nbsp;&nbsp;};<br><br>
方法列表中的每项由四个部分组成：方法名、导出函数、参数传递方式和方法描述。方法名是从Python解释器中调用该方法时所使用的名字。参数传递方式则规定了Python向C函数传递参数的具体形式，可选的两种方式是METH_VARARGS和METH_KEYWORDS，其中METH_VARARGS是参数传递的标准形式，它通过Python的元组在Python解释器和C函数之间传递参数，若采用METH_KEYWORD方式，则Python解释器和C函数之间将通过Python的字典类型在两者之间进行参数传递。<br><br></font></td></tr>";
echo "<tr><td><font size=5>3.4 初始化函数</font></td></tr>";
echo "<tr><td><font size=4><br>所有的Python扩展模块都必须要有一个初始化函数，以便Python解释器能够对模块进行正确的初始化。Python解释器规定所有的初始化函数的函数名都必须以init开头，并加上模块的名字。对于模块example来说，则相应的初始化函数为:<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;void initexample()<br>
&nbsp;&nbsp;&nbsp;&nbsp;{<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PyObject* m;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;m = Py_InitModule('example', exampleMethods);<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>
当Python解释器需要导入该模块时，将根据该模块的名称查找相应的初始化函数，一旦找到则调用该函数进行相应的初始化工作，初始化函数则通过调用Python的C语言扩展接口所提供的函数Py_InitModule()，来向Python解释器注册该模块中所有可以用到的方法。<br><br></font></td></tr>";
echo "<tr><td><font size=5>3.5 编译链接</font></td></tr>";
echo "<tr><td><font size=4><br>要在Python解释器中使用C语言编写的扩展模块，必须将其编译成动态链接库的形式。下面以RedHat Linux 8.0为例，介绍如何将C编写的Python扩展模块编译成动态链接库：<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;gcc -fpic -c -I/usr/include/python2.2 \<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-I /usr/lib/python2.2/config \<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;example.c wrapper.c<br>
&nbsp;&nbsp;&nbsp;&nbsp;gcc -shared -o example.so example.o wrapper.o<br><br></font></td></tr>";
echo "<tr><td><font size=5>3.6 引入Python解释器</font></td></tr>";
echo "<tr><td><font size=4><br>当生成Python扩展模块的动态链接库后，就可以在Python解释器中使用该扩展模块了，与Python自带的模块一样，扩展模块也是通过import命令引入后再使用的，如下所示：<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;python<br>
&nbsp;&nbsp;&nbsp;&nbsp;>>>import example<br>
&nbsp;&nbsp;&nbsp;&nbsp;>>>elample.fact(4)<br><br></font></td></tr>";
echo "<tr><td><font size=6 color=red>Python与其他语言结合的参数转换函数PyArg_ParseTuple()</font></td></tr>";
echo "<tr><td><font size=4><br>
The PyArg_ParseTuple() function is declared as follows:<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;int PyArg_ParseTuple(PyObject *arg, char *format, ...);<br>
The arg argument must be a tuple object containing an argument list passed from Python to a C function. The format argument must be a format string, whose syntax is explained below. The remaining arguments must be addresses of variables whose type is determined by the format string. For the conversion to succeed, the arg object must match the format and the format must be exhausted.<br><br>
Note that while PyArg_ParseTuple() checks that the Python arguments have the required types, it cannot check the validity of the addresses of C variables passed to the call: if you make mistakes there, your code will probably crash or at least overwrite random bits in memory. So be careful!<br><br>
A format string consists of zero or more ``format units''. A format unit describes one Python object; it is usually a single character or a parenthesized sequence of format units. With a few exceptions, a format unit that is not a parenthesized sequence normally corresponds to a single address argument to PyArg_ParseTuple(). In the following description, the quoted form is the format unit; the entry in (round) parentheses is the Python object type that matches the format unit; and the entry in [square] brackets is the type of the C variable(s) whose address should be passed. (Use the '&'operator to pass a variable's address.)<br><br>
Note that any Python object references which are provided to the caller are borrowed references; do not decrement their reference count!<br><br>
<font color=blue><strong>'s'</strong></font> (string or Unicode object) [char *]<br>
    Convert a Python string or Unicode object to a C pointer to a character string. You must not provide storage for the string itself; a pointer to an existing string is stored into the character pointer variable whose address you pass. The C string is null-terminated. The Python string must not contain embedded null bytes; if it does, a TypeError exception is raised. Unicode objects are converted to C strings using the default encoding. If this conversion fails, an UnicodeError is raised. <br>
<font color=blue><strong>'s#'</strong></font> (string, Unicode or any read buffer compatible object) [char *, int]<br>
    This variant on <font color=blue><strong>'s'</strong></font> stores into two C variables, the first one a pointer to a character string, the second one its length. In this case the Python string may contain embedded null bytes. Unicode objects pass back a pointer to the default encoded string version of the object if such a conversion is possible. All other read buffer compatible objects pass back a reference to the raw internal data representation. <br>
<font color=blue><strong>'z'</strong></font> (string or None) [char *]<br>
    Like <font color=blue><strong>'s'</strong></font>, but the Python object may also be None, in which case the C pointer is set to NULL. <br>
<font color=blue><strong>'z#'</strong></font> (string or None or any read buffer compatible object) [char *, int]<br>
    This is to <font color=blue><strong>'s#'</strong></font> as <font color=blue><strong>'z'</strong></font> is to <font color=blue><strong>'s'</strong></font>. <br>
<font color=blue><strong>'u'</strong></font> (Unicode object) [Py_UNICODE *]<br>
    Convert a Python Unicode object to a C pointer to a null-terminated buffer of 16-bit Unicode (UTF-16) data. As with <font color=blue><strong>'s'</strong></font>, there is no need to provide storage for the Unicode data buffer; a pointer to the existing Unicode data is stored into the Py_UNICODE pointer variable whose address you pass. <br>
<font color=blue><strong>'u#'</strong></font> (Unicode object) [Py_UNICODE *, int]<br>
    This variant on <font color=blue><strong>'u'</strong></font> stores into two C variables, the first one a pointer to a Unicode data buffer, the second one its length. <br>
<font color=blue><strong>'es'</strong></font> (string, Unicode object or character buffer compatible object) [const char *encoding, char **buffer]<br>
    This variant on <font color=blue><strong>'s'</strong></font> is used for encoding Unicode and objects convertible to Unicode into a character buffer. It only works for encoded data without embedded NULL bytes.<br><br>
    The variant reads one C variable and stores into two C variables, the first one a pointer to an encoding name string (encoding), the second a pointer to a pointer to a character buffer (**buffer, the buffer used for storing the encoded data) and the third one a pointer to an integer (*buffer_length, the buffer length).<br><br>
    The encoding name must map to a registered codec. If set to NULL, the default encoding is used.<br><br>
    PyArg_ParseTuple() will allocate a buffer of the needed size using PyMem_NEW(), copy the encoded data into this buffer and adjust *buffer to reference the newly allocated storage. The caller is responsible for calling PyMem_Free() to free the allocated buffer after usage.<br>
<font color=blue><strong>'es#'</strong></font> (string, Unicode object or character buffer compatible object) [const char *encoding, char **buffer, int *buffer_length]<br>
    This variant on <font color=blue><strong>'s#'</strong></font> is used for encoding Unicode and objects convertible to Unicode into a character buffer. It reads one C variable and stores into two C variables, the first one a pointer to an encoding name string (encoding), the second a pointer to a pointer to a character buffer (**buffer, the buffer used for storing the encoded data) and the third one a pointer to an integer (*buffer_length, the buffer length).<br><br>
    The encoding name must map to a registered codec. If set to NULL, the default encoding is used.<br><br>
    There are two modes of operation:<br><br>
    If *buffer points a NULL pointer, PyArg_ParseTuple() will allocate a buffer of the needed size using PyMem_NEW(), copy the encoded data into this buffer and adjust *buffer to reference the newly allocated storage. The caller is responsible for calling PyMem_Free() to free the allocated buffer after usage.<br><br>
    If *buffer points to a non-NULL pointer (an already allocated buffer), PyArg_ParseTuple() will use this location as buffer and interpret *buffer_length as buffer size. It will then copy the encoded data into the buffer and 0-terminate it. Buffer overflow is signalled with an exception.<br><br>
    In both cases, *buffer_length is set to the length of the encoded data without the trailing 0-byte.<br>
<font color=blue><strong>'b'</strong></font> (integer) [char]<br>
    Convert a Python integer to a tiny int, stored in a C char. <br>
<font color=blue><strong>'h'</strong></font> (integer) [short int]<br>
    Convert a Python integer to a C short int. <br>
<font color=blue><strong>'i'</strong></font> (integer) [int]<br>
    Convert a Python integer to a plain C int. <br>
<font color=blue><strong>'l'</strong></font> (integer) [long int]<br>
    Convert a Python integer to a C long int. <br>
<font color=blue><strong>'c'</strong></font> (string of length 1) [char]<br>
    Convert a Python character, represented as a string of length 1, to a C char. <br>
<font color=blue><strong>'f'</strong></font> (float) [float]<br>
    Convert a Python floating point number to a C float. <br>
<font color=blue><strong>'d'</strong></font> (float) [double]<br>
    Convert a Python floating point number to a C double. <br>
<font color=blue><strong>'D'</strong></font> (complex) [Py_complex]<br>
    Convert a Python complex number to a C Py_complex structure. <br>
<font color=blue><strong>'O'</strong></font> (object) [PyObject *]<br>
    Store a Python object (without any conversion) in a C object pointer. The C program thus receives the actual object that was passed. The object's reference count is not increased. The pointer stored is not NULL. <br>
<font color=blue><strong>'O!'</strong></font> (object) [typeobject, PyObject *]<br>
    Store a Python object in a C object pointer. This is similar to <font color=blue><strong>'O'</strong></font>, but takes two C arguments: the first is the address of a Python type object, the second is the address of the C variable (of type PyObject *) into which the object pointer is stored. If the Python object does not have the required type, TypeError is raised. <br>
<font color=blue><strong>'O'O&''</strong></font> (object) [converter, anything]<br>
    Convert a Python object to a C variable through a converter function. This takes two arguments: the first is a function, the second is the address of a C variable (of arbitrary type), converted to void *. The converter function in turn is called as follows:<br><br>
    status = converter(object, address);<br><br>
    where object is the Python object to be converted and address is the void * argument that was passed to PyArg_ConvertTuple(). The returned status should be 1 for a successful conversion and 0 if the conversion has failed. When the conversion fails, the converter function should raise an exception.<br>
<font color=blue><strong>'S'</strong></font> (string) [PyStringObject *]<br>
    Like <font color=blue><strong>'O'</strong></font> but requires that the Python object is a string object. Raises TypeError if the object is not a string object. The C variable may also be declared as PyObject *. <br>
<font color=blue><strong>'U'</strong></font> (Unicode string) [PyUnicodeObject *]<br>
    Like <font color=blue><strong>'O'</strong></font> but requires that the Python object is a Unicode object. Raises TypeError if the object is not a Unicode object. The C variable may also be declared as PyObject *. <br>
<font color=blue><strong>'t#'</strong></font> (read-only character buffer) [char *, int]<br>
    Like <font color=blue><strong>'s#'</strong></font>, but accepts any object which implements the read-only buffer interface. The char * variable is set to point to the first byte of the buffer, and the int is set to the length of the buffer. Only single-segment buffer objects are accepted; TypeError is raised for all others. <br>
<font color=blue><strong>'w'</strong></font> (read-write character buffer) [char *]<br>
    Similar to <font color=blue><strong>'s'</strong></font>, but accepts any object which implements the read-write buffer interface. The caller must determine the length of the buffer by other means, or use <font color=blue><strong>'w#'</strong></font> instead. Only single-segment buffer objects are accepted; TypeError is raised for all others. <br>
<font color=blue><strong>'w#'</strong></font> (read-write character buffer) [char *, int]<br>
    Like <font color=blue><strong>'s#'</strong></font>, but accepts any object which implements the read-write buffer interface. The char * variable is set to point to the first byte of the buffer, and the int is set to the length of the buffer. Only single-segment buffer objects are accepted; TypeError is raised for all others. <br>
'(items)' (tuple) [matching-items]<br>
    The object must be a Python sequence whose length is the number of format units in items. The C arguments must correspond to the individual format units in items. Format units for sequences may be nested.<br><br>
    Note: Prior to Python version 1.5.2, this format specifier only accepted a tuple containing the individual parameters, not an arbitrary sequence. Code which previously caused TypeError to be raised here may now proceed without an exception. This is not expected to be a problem for existing code.<br><br>
It is possible to pass Python long integers where integers are requested; however no proper range checking is done -- the most significant bits are silently truncated when the receiving field is too small to receive the value (actually, the semantics are inherited from downcasts in C -- your mileage may vary).<br><br>
A few other characters have a meaning in a format string. These may not occur inside nested parentheses. They are:<br><br>
<font color=blue><strong>'|'</strong></font><br>
    Indicates that the remaining arguments in the Python argument list are optional. The C variables corresponding to optional arguments should be initialized to their default value -- when an optional argument is not specified, PyArg_ParseTuple() does not touch the contents of the corresponding C variable(s). <br>
<font color=blue><strong>':'</strong></font><br>
    The list of format units ends here; the string after the colon is used as the function name in error messages (the ``associated value'' of the exception that PyArg_ParseTuple() raises). <br>
<font color=blue><strong>';'</strong></font><br>
    The list of format units ends here; the string after the colon is used as the error message instead of the default error message. Clearly, <font color=blue><strong>':'</strong></font> and <font color=blue><strong>';'</strong></font> mutually exclude each other. <br><br>
Some example calls:<br><pre>

        int ok;
        int i, j;
        long k, l;
        char *s;
        int size;

        ok = PyArg_ParseTuple(args, ''); /* No arguments */
            /* Python call: f() */

        ok = PyArg_ParseTuple(args, 's', &s); /* A string */
            /* Possible Python call: f('whoops!') */

        ok = PyArg_ParseTuple(args, 'lls', &k, &l, &s); /* Two longs and a string */
            /* Possible Python call: f(1, 2, 'three') */

        ok = PyArg_ParseTuple(args, '(ii)s#', &i, &j, &s, &size);
            /* A pair of ints and a string, whose size is also returned */
            /* Possible Python call: f((1, 2), 'three') */

        {
            char *file;
            char *mode = 'r';
            int bufsize = 0;
            ok = PyArg_ParseTuple(args, 's|si', &file, &mode, &bufsize);
            /* A string, and optionally another string and an integer */
            /* Possible Python calls:
               f('spam')
               f('spam', 'w')
               f('spam', 'wb', 100000) */
        }

        {
            int left, top, right, bottom, h, v;
            ok = PyArg_ParseTuple(args, '((ii)(ii))(ii)',
                     &left, &top, &right, &bottom, &h, &v);
            /* A rectangle and a point */
            /* Possible Python call:
               f(((0, 0), (400, 300)), (10, 10)) */
        }

        {
            Py_complex c;
            ok = PyArg_ParseTuple(args, 'D:myfunction', &c);
            /* a complex, also providing a function name for errors */
            /* Possible Python call: myfunction(1+2j) */
        }</pre><br></font></td></tr>";
echo "<tr><td><font size=4></font></td></tr>";
echo "<tr><td><font size=4></font></td></tr>";
echo "</table></center>";
?>
