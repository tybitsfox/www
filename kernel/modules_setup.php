<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<font color=red size=4><pre>
本文是基于2.6的内核，也建议各位可以先看一下《Linux内核设计与实现（第二版）》作为一个基础知识的铺垫。当然，从实践角度来
看，只要按着以下的步骤去做也应该可以实现成功编译内核及加载模块。
个人用的Linux版本为：Debian GNU/Linux，内核版本为：2.6.20-1-686.
◆第一步，下载Linux内核的源代码，即构建LDD3（Linux Device Drivers 3rd）上面所说的内核树。
如过安装的Linux系统中已经自带了源代码的话，应该在/usr/src目录下。如果该目录为空的话，则需要自己手动下载源代码。下载代码
的方法和链接很多，也可以在CU上通过http://download.chinaunix.net/search/?key=&q=kernel&frmid=53去下载。不过，下载的内核
版本最好和所运行的Linux系统的内核版本一致。当然，也可以比Linux系统内核的版本低，但高的话应该不行（个人尚未实践）。
Debian下可以很方便的通过Debian源下载：
首先查找一下可下载的内核源代码：
# apt-cache search linux-source
其中显示的有:linux-source-2.6.20,没有和我的内核版本完全匹配，不过也没关系，直接下载就可以了：
# apt-get install linux-source-2.6.20
下载完成后，安装在/usr/src下，文件名为：linux-source-2.6.20.tar.bz2,是一个压缩包，解压缩既可以得到整个内核的源代码：
# tar jxvf linux-source-2.6.20.tar.bz2
解压后生成一个新的目录/usr/src/linux——source-2.6.20，所有的源代码都在该目录下。
注：该目录会因内核版本的不同而不同，各位动手实践的朋友只需知道自己的源代码所在的具体位置即可。";
echo "
◆第二步：配置及编译内核。
进入/usr/src/linux——source-2.6.20目录下，可以看到Makefile文件，它包含了整个内核树编译信息。该文件最上面四行是关于内核版本的
信息。对于整个Makefile可以不用做修改，采用默认的就可以了。
一般情况下，需要先用命令诸如\"make menuconfig\", \"make xconfig\"或者\"make oldcofig\"对内核进行配置，这几个都是对内核进行配置的
命令，只是它们运行的环境不一样，执行一下这几个命令中的任何一个即可对内核进行配置：
make menuconfig是基于界面的内核配置方法，make xconfig应该是基于QT库的，还有make gcofig也是基于图形的配置方法，应该是需要GTK的环
境，make oldcofig就是对内核树原有的.config文件进行配置一下即可。
其实内核的配置部分，主要是保证内核启动模块可动态加载的配置，默认配置里面应该已经包含了这样的内容，因此，我用的是make oldconfig.
在内核源码的目录下执行：
# make
# make bzImage
其中，第一个make也可以不执行，直接make bzImage。这个过程可能要持续一个小时左右，因此是对整个内核重新编译了。执行结束后，可以看到
在当前目录下生成了一个新的文件: vmlinux, 其属性为-rwxr-xr-x。
然后执行：
# make modules
# make modules_install
对内核的所有模块进行编译和安装。
执行结束之后，会在/lib/modules下生成新的目录/lib/modules/2.6.20/。 在随后的编译模块文件时，要用到这个路径下的build目录。至此，内核
编译完成。可以重启一下系统。";
echo "
◆第三步：编写模块文件及Makefile
以LDD3上的hello.c为例：
//hello.c
#include <linux/init.h>
#include <linux/module.h>
MODULE_LICENSE(\"Dual BSD/GPL\");
static int hello_init(void)
{
    printk(KERN_ALERT \"Hello, world\\n\");
    return 0;
}
static void hello_exit(void)
{
    printk(KERN_ALERT\"Goodbye, cruel world\\n\");
}
module_init(hello_init);
module_exit(hello_exit);
Makefile文件的内容为：
obj-m := hello.o
KERNELDIR := /lib/modules/2.6.20/build
PWD := $(shell pwd)
modules:
    $(MAKE) -C $(KERNELDIR) M=$(PWD) modules
modules_install:
    $(MAKE) -C $(KERNELDIR) M=$(PWD) modules_install
clean:
    rm -rf *.o *~ core .depend .*.cmd *.ko *.mod.c .tmp_versions
其中,hello.c和Makefile文件应该位于同一个目录下,可以放在/home下,我的两个文件都位于/home/david/. ";
echo "
◆第四步:编译和装载模块
在文件所处的目录下,执行:
debian:/home/david # make
然后查看该目录下有哪些文件生成：
debian:/home/david # ls -l
总计 28
drwxr-xr-x 2 david david 4096 2007-02-07 17:49 Desktop
-rw-r--r-- 1 david david  462 2007-07-20 13:42 hello.c
-rw-r--r-- 1 root  root  2432 2007-07-20 13:55 hello.ko
-rw-r--r-- 1 root  root   607 2007-07-20 13:55 hello.mod.c
-rw-r--r-- 1 root  root  1968 2007-07-20 13:55 hello.mod.o
-rw-r--r-- 1 root  root  1140 2007-07-20 13:55 hello.o
-rw-r--r-- 1 david david  267 2007-07-20 13:48 Makefile
-rw-r--r-- 1 root  root     0 2007-07-05 14:11 Module.symvers
可见,已经生成模块文件hello.ko.
然后,就可以加载该模块:
debian:/home/david # insmod hello.ko
查看模块是否加载进内核:
debian:/home/david # lsmod
Module Size Used by
hello 1344 0
nfs 219468 0
nfsd 202224 17
…… ……
其中Module名为hello的即为我们所加载的模块.
卸载模块:
debian:/home/david # rmmod hello
同样可以通过lsmod来查看该模块是否被卸载.
这里有两个问题,其一就是printk()输出的问题.LDD3上也说,在加载和卸载模块的时候都会有信息输出在屏幕上,如果在Windows下通过
终端仿真器(我们常用的虚拟机算是一种),则在屏幕上看不到任何输出.我同时在虚拟机和和物理机都运行了该模块,均未看到有\"Hello, world\"
(加载模块时printk的输出)或\"Goodby, cruel world\"(卸载模块时printk的输出). 这个不知道是我操作系统发行版的原因还是系统配置的问题,
请了解这个问题的朋友指点一下.
其二,书上讲到如果屏幕上看不到信息,可能输出在某个日志文件里面了,并说可能在/var/log/messages文件中.并且看到网上很多网友也说是输出
到这个文件里面.我不知道有没有发现输出在其他日志文件里的,不过我的这个信息输出在/var/log/syslog里面.在加载和卸载完该模块后, 执行命令:
debian:/home/david # cat /var/log/syslog | grep world
可以看到有两行内容.当然,也可以不用grep world, 应该会出现在最后两行.
Jul 20 14:15:29 localhost kernel: Hello, world
Jul 20 14:15:34 localhost kernel: Goodbye, cruel world
这就是printk应该输出的信息.
这里有另外一个方法,可以实现printk的信息输出在屏幕上,即更改printk输出的优先级.例子中的优先级为:KERN_ALERT,优先级为<1>,
如果将优先级改为KERN_EMERG即<0>,则可以看到屏幕的输出信息.";
?>
