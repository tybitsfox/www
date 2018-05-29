<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<font size=5 color=red><center>GNU Make个人精简介绍</center></font><br><pre>";
echo "
GNU make简明资料
<font color=red size=4>一、makefile的基本结构：</font>
工作目标:必要条件1 必要条件2 ...
	执行命令
target:prerep1 prerep2 ....
	commands
每一个完整的makefile都是上述基本结构的叠加

<font color=red size=4>二、工作目标的区别</font>
工作目标按照是否代表一个需更新或生成的文件可区分为：工作目标 和 假想工作目标
其中假想工作目标一般是通过.PHONY 来定义的，但也有一些标准（默认）的假想工作目标：
all
clean
install
distclean
TAGS
info
check
二者的区别在于当时用假想工作目标时（假想工作目标一般不带有必要条件），其后的命令
是必定执行的，不管条件的时间戳和目标时间戳的先后关系，看下面的示例：
-----测试用c文件：a01.c---------
#include\"clsscr.h\"

int main(int argc,char **argv)
{
	printf(\"hello world\\n\");
	return 0;
}
------------End-----------------
------Makefile文件--------------
#all:
#a01:
a01:a01.c
	gcc -o a01 a01.c
clean:
	rm a01
	
------------End-----------------
在这个例子中，我分别使用了三个不同的工作目标及必要条件，在使用最基本结构形式的
a01:a01.c时，生成了可执行文件a01以后，再次执行make，此时会提示'a01'是最新的，并停止
后面编译链接命令的执行。也就是当必要条件的时间戳早于工作目标时，不会再进行重复的编译
链接工作。
当使用不带必要条件的工作目标时：
#all:
a01:
#a01:a01.c
此时makefile的执行情况和带有必要条件的完全一样，他也会根据各自的时间戳判断是否需要重
新进行编译链接工作。
最后，当改变工作目标为假想工作目标时：
all：
#a01:
#a01:a01.c
此时，无论几次执行makefile，他都会重新编译链接生成新文件。而不在乎工作目标的时间戳和
必要条件的时间戳之间的先后。

<font color=red size=4>三、具体规则、模式规则、隐含规则、静态模式规则</font>
makefile的规则，我个人理解就是实现make基本功能的最小单元。其组成就是make的基本结构：
（工作目标，必要条件，执行命令）
按其实现的方式和方法，又可分为：具体规则（显式规则）、模式规则、隐含规则、静态模式规则
<font color=blue size=4>具体规则</font>，就是我们在makefile中明确的写出其工作目标，必要条件和所执行的命令。也就是最直
接的make功能的实现。
<font color=blue size=4>模式规则</font>，是对一类相似功能实现的概括性表示，是通过通配符、文件类型的使用和操作对同一模
式功能实现的描述。例如：%.o:%.c 定义了所有c文件生成o文件所要执行的一般操作。
相当于一个数据类型的定义或者虚函数的定义。其规则本身不能直接使用，规则模式必须要配合
给出具体的工作目标和条件才能工作：
example.o:example.c examlpe.h other.c		(%.o:%.c)
aa:aa.h										(%:%.c)
<font color=blue size=4>隐含规则</font>，属于模式规则，他是由make自身定义和生成的支持多种编程语言（c，c++，forthon等）
通用的模式规则。查看make的隐含规则和变量定义使用： make -p 命令，可打印出1000多行详细的
隐含规则定义和变量定义说明。掌握了这些隐含规则也就理解了makefile各类花式的编写方法了。
<font color=blue size=4>静态模式规则</font>，也属于模式规则，不过他的规则应用范围收到了限制：
$(OBJECTS):%.o:%c
	$(cc) $(CFLAGS) $< -o $@
这个规则的应用，仅仅限制在OBJECTS罗列的目标中。而不是通用规则

<font color=red size=4>四、变量、自动变量</font>
makefile中的变量大小写敏感，引用时需$(var)或者\${var},单字符变量无需括号。
当规则相符时，make就会设置自动变量，用以方便的操作工作目标和必要条件。重要的自动变量有：
 $@
	表示规则的目标文件名。如果目标是一个文档文件，那么它代表这个文档的文件名。在多目标模
	式规则中，它代表的是哪个触发规则被执行的目标文件名。
 $%
	当规则的目标文件是一个静态库文件时，代表静态库的一个成员名。例如，规则的目标是“
	foo.a(bar.o)，那么，$%的值就为“bar.o，“$@的值为“foo.a。如果目标不是静态库文件，其值为空。
 $<
	规则的第一个依赖文件名。如果是一个目标文件使用隐含规则来重建，则它代表由隐含规则加入的
	第一个依赖文件。
 $?
	所有比目标文件更新的依赖文件列表，空格分割。如果目标是静态库文件名，代表的是库成员（.o文件）。
 $^
	规则的所有依赖文件列表，使用空格分隔。如果目标是静态库文件，它所代表的只能是所有库成员
	（.o文件）名。一个文件可重复的出现在目标的依赖中，变量$^只记录它的一次引用情况。就是说
	变量$^会去掉重复的依赖文件。
 $+
	类似 $^，但是它保留了依赖文件中重复出现的文件。主要用在程序链接时库的交叉引用场合
 $*
	在模式规则和静态模式规则中，代表“茎。“茎是目标模式中 %所代表的部分（当文件名中存在目录时，
	茎也包含目录（斜杠之前）部分）。例如：文件“dir/a.foo.b，当目标的模式为“a.%.b时，$*的值为
	dir/a.foo。茎对于构造相关文件名非常有用。
<font color=red size=4>五、VPATH 和 vpath 指定路径</font>
	VPATH = foo/foo fba/fba
	vpath %.h /include/foo
	VPATH称为一般搜索，vpath称为选择性搜索
<font color=red size=4>六、大型项目管理-递归式make</font>
	测试用目录结构：
	myproject
		|
		|-----include
		|
		|-----lib------db
		|	   |
		|	   ----codec
		|	   |
		|	   ----ui
		|		   
		|-----app----player
		|
		|-----doc
	在顶层目录myproject下有个总的makefile，在lib/db,codec,ui目录下各有独立的makefile
	在主目录app下的player目录中也有独立的makefile。现在要在顶层目录下的makefile文件中递归调用
	各个子目录下的makefile。各makefile实现如下：
----db/makefile：---------------
all:
    @echo 'update lib_db code'
----codec/makefile:-------------
all:
    @echo 'update lib_codec code'
----ui/makefile:----------------
all:
    @echo 'update lib_ui code'
----app/player/makefile:--------
all:
    @echo 'update main program'
----------sub End----------------
----------makefile--------------
lib_ui	:=	lib/ui
lib_codec	:=	lib/codec
lib_db	:=	lib/db
lib_all	:=	$(lib_ui) $(lib_codec) $(lib_db)
player	:=	app/player

.PHONY:	all $(player) $(lib_all)
all: $(player) $(lib_all)

$(player) $(lib_all):
	$(MAKE) --directory=$@
----------End------------------

这里采用了一个伪目标（假想工作目标）作为条件的技巧：
all: $(player) $(lib_all)
一保证各个目录（变量）得以无条件执行:
$(player) $(lib_all):
	$(MAKE) --directory=$@
而命令语句非常的简单：
	$(MAKE) --directory=$@
	或者：
	$(MAKE) -C $@
该命令首先进入指定的目录，然后执行该目录下的makefile文件。	  



</pre>";

?>
