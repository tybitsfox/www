<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<font color=blue size=4><pre>
从 2.4 到 2.6，Linux 内核在可装载模块机制、设备模型、一些核心 API 
等方面发生较大改变，设备驱动开发人员面临着将驱动从 2.4 移植到 2.6 内核，或是使驱动同时支持2.4 与 2.6 内核的任务。站在设备
驱动开发人员的角度，驱动由一个或几个外部可加载内核模块组成，本文针对 2.6 内核里模块机制的改变对编写设备驱动程序的影响，从
内核模块的编译、装载时的版本检查、初始化与退出、模块使用计数、输出内核符号、命令行输入参数、许可证声明等方面比较了 2.4 与
2.6 内核的区别；并总结了使设备驱动同时支持 2.4 与 2.6 内核的一系列模板。
1． 获取内核版本
当设备驱动需要同时支持不同版本内核时，在编译阶段，内核模块需要知道当前使用的内核源码的版本，从而使用相应的内核 API。
2.4 与 2.6 内核下，源码头文件 linux/version.h 定义有：
LINUX_VERSION_CODE ― 内核版本的二进制表示，主、从、修订版本号各对应一个字节；
KERNEL_VERSION(major, minor, release) － 由主、从、修订版本号构造二进制版本号。
在同时支持2.4与2.6 内核的设备驱动程序中，经常可以看到以下代码段：
清单1：判断内核版本的代码段。
#include
#if LINUX_VERSION_CODE &gt;= KERNEL_VERSION(2, 6, 0)
#define LINUX26
#endif
#ifdef LINUX26
/*code in 2.6 kernel*/
#else
/*code in 2.4 kernel */
#endif
2．内核模块机制的改变
2.1模块编译
从2.4到2.6，外部可装载内核模块的编译、连接过程以及Makefile的书写都发生了改变。
2.4内核中，模块的编译只需内核源码头文件；需要在包含linux/modules.h之前定义MODULE；编译、连接后生成的内核模块后缀为.o。
2.6内核中，模块的编译需要配置过的内核源码；编译、连接后生成的内核模块后缀为.ko；编译过程首先会到内核源码目录下，读取
顶层的Makefile文件，然后再返回模块源码所在目录。
清单2：2.4 内核模块的Makefile模板
#Makefile2.4
KVER=$(shell uname -r) 
KDIR=/lib/modules/$(KVER)/build
OBJS=mymodule.o<br>";
echo "CFLAGS=-D__KERNEL__ -I$(KDIR)/include -DMODULE -D__KERNEL_SYSCALLS__ -DEXPORT_SYMTAB
  -O2 -fomit-frame-pointer  -Wall  -DMODVERSIONS -include $(KDIR)/include/linux/modversions.h
all: $(OBJS)
mymodule.o: file1.o file2.o
        ld -r -o $@ $^
clean:
        rm -f *.o
在2.4 内核下，内核模块的Makefile与普通用户程序的Makefile在结构和语法上都相同，但是必须在CFLAGS中定义-
D__KERNEL__- DMODULE，指定内核头文件目录-I$(KDIR)/include。有一点需注意，之所以在CFLAGS中定义变量，而
不是在模块源码文件中定义，一方面这些预定义变量可以被模块中所有源码文件可见，另一方面等价于将这些预定义变量定义在源码文件的起
始位置。在模块编译中，对于这些全局的预定义变量，一般在CFLAGS中定义。
清单3：2.6 内核模块的Makefile模板
# Makefile2.6
ifneq ($(KERNELRELEASE),)
#kbuild syntax. dependency relationshsip of files and target modules are listed here.
mymodule-objs := file1.o file2.o
obj-m := mymodule.o
else
PWD  := $(shell pwd)
KVER ?= $(shell uname -r)
KDIR := /lib/modules/$(KVER)/build
all:
        $(MAKE) -C $(KDIR) M=$(PWD)
clean:
rm -rf .*.cmd *.o *.mod.c *.ko .tmp_versions
endif
KERNELRELEASE是在内核源码的顶层 Makefile中定义的一个变量，在第一次读取执行此Makefile时，
KERNELRELEASE没有被定义，所以make将读取执行else之后的内容。如果make的目标是clean，直接执行clean操作，然后结
束。当make的目标为all时，-C $(KDIR) 指明跳转到内核源码目录下读取那里的Makefile；M=$(PWD) 表明然后返回到当前目
录继续读入、执行当前的Makefile。当从内核源码目录返回时，KERNELRELEASE已被被定义，kbuild也被启动去解析kbuild语法
的语句，make将继续读取else之前的内容。else之前的内容为kbuild语法的语句, 指明模块源码中各文件的依赖关系，以及要生成的目标模块
名。mymodule-objs := file1.o file2.o表示mymoudule.o 由file1.o与file2.o 连接生成。
obj-m := mymodule.o表示编译连接后将生成mymodule.o模块。
补充一点，\"$(MAKE) -C $(KDIR) M=$(PWD)\"与\"$(MAKE) -";
echo "C $(KDIR) SUBDIRS =$(PWD)\"的作用是等效的，后者是较老的使用方法。推荐使用M而不是
SUBDIRS，前者更明确。
通过以上比较可以看到，从Makefile编写来看，在2.6内核下，内核模块编译不必定义复杂的CFLAGS，而且模块中各文件依赖关系的表示简洁清晰。
清单4： 可同时在2.4 与 2.6 内核下工作的Makefile＃Makefile for 2.4 & 2.6
VERS26=$(findstring 2.6,$(shell uname -r))
MAKEDIR?=$(shell pwd)
ifeq ($(VERS26),2.6)
include $(MAKEDIR)/Makefile2.6
else
include $(MAKEDIR)/Makefile2.4
endif
2.2模块装载时的版本检查
Linux内核一直在更新、完善，在a版本内核源码下编译的模块在b版本内核下通常不能运行，所以必须有一种机制，限制在a版本内核下编译生成的
模块在b版本内核下被加载。
2.4与2.6内核在可装载内核模块的版本检查机制方面发生了根本性的改变，不过这些改变对设备驱动开发人员而言基本是透明的。为了使模块装载
时的版本检查机制生效，2.4 内核下，只需在CFLAGS中定义
-DMODVERSIONS -include $(KDIR)/include/linux/modversions.h；
2.6内核下，开发人员无须采用任何操作。
不过，在此仍有必要阐明2.4与2.6内核对可加载模块的版本检查机制。
2.4 内核下， 执行`cat /proc/ksyms`可看到内核符号在名字后还跟随着一串校验字符串，此校验字符串与内核版本有关。在内核
源码头文件linux/modules 目录下存在许多*.ver文件，这些文件起着为内核符号添加校验后缀的作用，如ksyms.ver 文件里有一行
#define printk _set_ver(printk)。linux/modversions.h 文件会包含全部的 ver文件。所以当模
块包含linux/modversions.h文件后，编译时，模块里使用的内核符号实质是带有校验后缀的内核符号。在加载模块时，如果模块中所使用内核
符号的校验字符串与当前运行内核所导出的相应的内核符号的校验字符串不一致，即当前内核空间并不存在模块所使用的内核符号，就会出现
\"Invalid module format \"的错误。
为内核符号添加校验字符串来验证模块的版本与内核的版本是否匹配是繁杂和浪费内核空间的；而且随着SMP（对称多处理器）、PREEMPT（可抢
占内核）等机制在2.6内核的引入和完善，模块运行时对内核的依赖不仅取决于内核版本，还取决于内核的配置，此时内核符号的校验码是否一致
不能成为判断模块可否被加载的充分条件。2.6 内核下，在linux/vermagic.h中定义有VERMAGIC_STRING，VERMAGIC_STRING
不仅包含内核版本号，还包含有内核使用的gcc版本，SMP与PREEMPT等配置信息。模块在编译时，我们可以看到屏幕上会显示\"MODPOST\"。在
此阶段， VERMAGIC_STRING会添加到模块的modinfo段。在内核源码目录下scripts＼mod＼modpost.c文件中可以看到
模块后续处理部分的代码。模块编译生成后，通过`modinfo mymodule.ko`命令可以查看此模块的vermagic等信息。2.6 内核下
的模块装载器里保存有内核的版本信息，在装载模块时，装载器会比较所保存的内核vermagic与此模块的modinfo段里保存的 vermagic信
息是否一致，两者一致时，模块才能被装载。譬如Fedora core 4 与core 2 使用的都是2.6 版本内核，在Fedore Core 2
下去加载Fedora Core4下编译生成的hello.ko，会出现\"invalid module format\" 错误。";
echo "＃insmod hello.ko
Invalid module format
hello: version magic ’2.6.11-1.136Array_FC4 686 REGPARM 4KSTACKS gcc-4.0’
should be ’2.6.5-1.358 686 REGPARM 4KSTACKS gcc-3.3’
2.3模块的初始化与退出
在2.6 内核中，内核模块必须调用宏module_init 与module_exit() 去注册初始化与退出函数。在2.4 内核中，如果
初始化函数命名为init_module()、退出函数命名为cleanup_module()，可以不必使用module_init 与
module_exit 宏。推荐使用module_init 与module_exit宏，使代码在2.4与2.6内核中都能工作。
清单5：适用于2.4与2.6内核的模块的初始化与退出模板
#include   /* Needed by all modules */
#include     /* Needed for init&exit macros */
static int mod_init_func(void)
{
/*code here*/
return 0;
}
static void mod_exit_func(void)
{
/*code here*/
}
module_init(mod_init_func);
module_exit(mod_exit_func);
需要注意的是初始化与退出函数必须在宏module_init和module_exit使用前定义，否则会出现编译错误。
2.4 模块使用计数
模块在被使用时，是不允许被卸载的。2.4内核中，模块自身通过MOD_INC_USE_COUNT、MOD_DEC_USE_COUNT宏来管
理自己被使用的计数。2.6内核提供了更健壮、灵活的模块计数管理接口try_module_get(&module)及module_put
(& module)取代2.4中的模块使用计数管理宏；模块的使用计数不必由自身管理，而且在管理模块使用计数时考虑到SMP与PREEMPT
机制的影响。
int try_module_get(struct module *module)：用于增加模块使用计数；若返回为0，表示调用失败，希望使用的模块没有被加载或正在被卸载中。
void module_put(struct module *module)：减少模块使用计数。
try_module_get 与module_put的引入与使用与2.6内核下的设备模型密切相关。模块是用来管理硬件设备的，
2.6 内核为不同类型的设备定义了struct module *owner 域，用来指向管理此设备的模
块。如字符设备的定义：
struct cdev {";
echo "        struct kobject kobj;
        struct module *owner;
        struct file_operations *ops;
        struct list_head list;
        dev_t dev;
        unsigned int count;
};
从设备使用的角度出发，当需要打开、开始使用某个设备时，使用try_module_get(dev-&gt;owner)去增加管理此设备的
owner模块的使用计数；当关闭、不再使用此设备时，使用 module_put(dev-&gt;owner)减少对管理此设备的owner模块的使
用计数。这样，当设备在使用时，管理此设备的模块就不能被卸载；只有设备不再使用时模块才能被卸载。
2.6内核下，对于为具体设备写驱动的开发人员而言，基本无需使用try_module_get与 module_put，因为此时开发人员所写
的驱动通常为支持某具体设备的owner模块，对此设备owner模块的计数管理由内核里更底层的代码如总线驱动或是此类设备共用的核心模块来实现，从而
简化了设备驱动开发。
2.5 模块输出的内核符号
2.4 内核下，缺省情况时模块中的非静态全局变量及函数在模块加载后会输出到内核空间。
2.6 内核下，缺省情况时模块中的非静态全局变量及函数在模块加载后不会输出到内核空间，需要显式调用宏EXPORT_SYMBOL才能输出。
所以在2.6 内核的模块下，EXPORT_NO_SYMBOLS宏的调用没有意义，是空操作。在同时支持2.4与2.6内核的设备驱动中，可以通过以下
代码段来输出模块的内核符号
清单6： 同时支持2.4与2.6的输出内核符号代码段
#include
#ifndef LINUX26
EXPORT_NO_SYMBOLS;
#endif
EXPORT_SYMBOL(var);
EXPORT_SYMBOL(func);
需要注意的是如需在2.4内核下使用 EXPORT_SYMBOL，必须在 CFLAGS中定义 EXPORT_SYMTAB，否则编译将会失败。
从良好的代码风格角度出发，模块中不需要输出到内核空间且不需为模块中其它文件所用的全局变量及函数最好显式申明为static类型，需要
输出的内核符号以模块名为前缀。
模块加载后，2.4内核下可通过 /proc/ksyms、 2.6 内核下可通过/proc/kallsyms查看模块输出的内核符号
2.6 模块的命令行输入参数
在装载内核模块时，用户可以向模块传递一些参数，如`modprobe modname var=value`，否则，var将使用模块内定义的缺省值。
2.4 内核下，linux/module.h中定义有宏MODULE_PARM(var,type) 用于向模块传递命令行参数。var为接受
参数值的变量名，type为采取如下格式的字符串[min[-max]]{b,h,i,l,s}。min及max 用于表示当参数为数组类型时，允许输入
的数组元素的个数范围；b：byte；h：short；i：int；l：long；s：string。
2.6内核下，宏MODULE_PARM(var,type)不再被支持。在头文件linux/moduleparam.h里定义了如下宏：
module_param(name, type, perm)
module_param_array(name, type, nump, perm)
type 类型可以是byte、short,、ushort、 int、 uint、long、ulong、charp,
bool or invbool, 不再采用2.4内核中的字符串形式，而且在模块编译时会将此处申明的type与变量定义的类型进行比较，判断是否一
致。
perm表示此参数在sysfs文件系统中所对应的文件节点的属性。2.6内核使用sysfs文件系统，这是一个建立在内存中比proc更强大的
文件系统。sysfs文件系统可以动态、实时，有组织层次地反应当前系统中的硬件、驱动等状态。当perm为0时，表示此参数不存在sysfs文件系统下
对应的文件节点。模块被加载后，在/sys/module/ 目录下将出现以此模块名命名的目录。如果此模块存在perm不为0的命令行参数，在此模块的
目录下将出现parameters目录，包含一系列以参数名命名的文件节点，这些文件的权限值等于perm，文件的内容为参数的值。
nump 为保存输入的数组元素个数的变量的指针。当不需保存实际输入的数组元素个数时，可以设为NULL。从2.6.0至2.6.10 版本，
须将变量名赋给nump；从2.6.10 版本开始，须将变量的引用赋给nump，这更易为开发人员理解。加载模块时，使用逗号分隔输入的数组元素。
清单7： 适用于2.4与2.6内核的模块输入参数模板
#include
#ifdef LINUX26
#include
#endif
int debug = 0;
char *mode = \"800x600\";
int tuner[4] = {1, 1, 1, 1};
#ifdef LINUX26
int tuner_c = 1;
#endif
#ifdef LINUX26
MODULE_PARM(debug, \"i\");
MODULE_PARM(mode, \"s\");
MODULE_PARM(tuner,\"1-4i\");
#else
module_param(debug, int, 0644);
module_param(mode, charp, 0644);
#if LINUX_VERSION_CODE &gt;= KERNEL_VERSION(2, 6, 10)
module_param_array(tuner, int, &tuner_c, 0644);
#else
module_param_array(tuner, int, tuner_c, 0644);";
echo "#endif
#endif
模块编译生成后，加载模块时可以输入：`modprobe my_module mode=1024x768 debug=1 tuner=22,33`。
在linux/moduleparam.h还定义有：
module_param_array_named(name, array, type, nump, perm)
module_param_call(name, set, get, arg, perm)
module_param_named(name, value, type, perm)
读者可以参阅linux/moduleparam.h查看这些宏的详细描述，有一点需注意，在2.6内核里，module_param这一系列宏使用的都是小写名字。
2.7 模块的许可证声明
从2.4.10 版本内核开始，模块必须通过MODULE_LICENSE宏声明此模块的许可证，否则在加载此模块时，会收到内核被污染
\"kernel tainted\" 的警告。从linux/module.h文件中可以看到，被内核接受的有意义的许可证有 \"GPL\"，
\"GPL v2\"，\"GPL and additional rights\"，\"Dual BSD/GPL\"，\"Dual MPL/GPL\"，
\"Proprietary\"。
在同时支持2.4与2.6内核的设备驱动中，模块可按如下方式声明自己的许可证。
清单8： 适用于2.4与2.6内核的模块许可证声明模板
#if LINUX_VERSION_CODE &gt;= KERNEL_VERSION(2,4,10)
MODULE_LICENSE(\"GPL\");
#endif
2.8 小结
此外，2.6内核里还有一些模块机制的改变，不常为驱动开发人员用到。如加载内核模块的接口request_module在2.4 下为
request_module(const char * module_name)；在2.6内核下为request_module
(const char *fmt, ...)。在2.6 内核下，驱动开发人员可以通过调用
request_module(\"msp3400\");
request_module(\"char-major-%d-%d\", MAJOR(dev), MINOR(dev))；
这种更灵活的方式加载其它内核模块。
2.6内核在linux/module.h中还提供了MODULE_ALIAS(alias)宏，模块可以通过调用此宏为自己定义一或若干个别称。而在2.4内核下，用
户只能在/etc/modules.conf中为模块定义别称。
通过以上比较可以看到，从2.4到2.6内核，可装载模块管理机制的改变使设备驱动的开发变得更加简洁、灵活、健壮。
</pre></font><br><br>";
?>

