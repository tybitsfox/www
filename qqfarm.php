<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<center><font color=red size=5>话题一：debian源和mysql c api的使用</font></center><br>";
echo "<pre><font color=black size=4>安装使用c的mysql:
安装libmysqld-dev:
apt-get install libmysqld-dev
顺便说下台湾的源，今天看到linux吧内的一篇帖子，说台湾的源好像挂了。于是测试：apt-get update && apt-get upgrade
果然无法更新了。通过浏览器进入该网站查看，发现并没有挂掉，只是目录的名称改变了：
原来的：<a href=\"http://ftp.tw.debian.org/debian/\" target=_blank>http://ftp.tw.debian.org/debian/dists/testing/</a>
改为了：<a href=\"http://ftp.tw.debian.org/debian/\" target=_blank>http://ftp.tw.debian.org/debian/dists/squeeze/</a>
于是修改/etc/apt/sources.list:
  1 deb http://ftp.tw.debian.org/debian/ squeeze main
  2 deb http://ftp.tw.debian.org/debian/ squeeze  non-free
  3 deb http://ftp.tw.debian.org/debian/ squeeze contrib
更新测试～ok！！</font></pre>";
echo "<center><font color=red size=5>话题二： 关于在c中使用mysql函数的问题。</font></center><br>";
echo "<pre><font size=4>看来这里面的变数不少啊，由于在gentoo下mysql是通过源码编译的，在编译时指定了相关选项，所以没有再次的安装libmysqld-dev。
并且按照mysql的说明写的makefile也可以直接使用，但是到了debian情况就变了。不仅需要单独的安装libmysqld-dev，还要在makefile
中进行相应的调整：
按照mysql的使用说明makefile如下：
s001:s001.c
        gcc -o s001 s001.c -lz \
                `/usr/bin/mysql_config --include --libmysqld-libs`
但是make时出现大量的未定义错误，显然应该是某些头文件没有正确的包含进来。
通过网上的搜索发现应该是tmake.conf中的指定有问题，不过使用g++直接替换gcc也能通过。但是又提示缺少crypt库文件。
于是修改makefile如下：
s001:s001.c
        g++ -o s001 s001.c -lz \
                `/usr/bin/mysql_config --include --libmysqld-libs` \
                -lcrypt
编译顺利通过。
测试通过修改/usr/include/mysql/mysql.h，使其包含相应的头文件仍然不行。看来就得使用g++来编译。
另外，期间还出现库文件libwrap库文件没找到的错误，aptitude search libwrap查看，没有安装libwrap0-dev包。
apt-get安装上。对于提示缺少的libcrypt库文件，问题也很奇怪，单独使用mysql_config --libmysqld-libs，获得
的应链接的库文件竟然没有这个库，只能手动在makefile中添加：-lcrypy。</font></pre>";
echo "<br><br><br>";
echo "<hr=2 width=80%>";
echo "<center><font color=red size=5>关于mysql数据库编程的总结：</font></center><br>";
echo "<pre><font color=black size=4>
1、根据测试，在代码中无需下列代码：
static char *ser_opt[]={\"\",\"--\"};
int len=sizeof(ser_opt)/sizeof(char*);
static char *ser_grp[]={\"\",\"\"};

mysql_server_init(len,ser_opt,ser_grp);
－－－－－－－－－－－－－－－－－－－－－－－－
如需使用数据库，只要调用mysql_init()初始化下即可。
2、权限问题，如果不在自己的代码中加入seteuid而使用默认的root帐户，则建立的新数据在mysql命令行下
无权访问。
3、建立数据库的问题，建立数据库按照手册介绍使用mysql_query()执行Sql的命令即可建立。但是，要注意
的问题是：必须先调用mysql_real_connect(mysql,NULL,NULL,NULL,NULL,0,NULL,0);连接默认的数据库，第
五个参数为空表示连接默认的数据库。然后即可实现数据库的建立。
4、makefile，可能由于我的debian上没有tmake所至，所以编译时应指明g++编译。另外，如提示缺少链接库
libcrypt.so可以在makefile中手动添加：
test:test.c
	g++ -o test test.c -lz \
	`/usr/bin/mysql_config --include --libmysqld-libs` \
	-lcrypt

一个完整的程序如下：
//test.c:
#include\"/workarea/cprogram/include/clsscr.h\"
#include&lt;mysql/mysql.h&gt;

MYSQL *mysql,*m;
MYSQL_RES *result;
MYSQL_ROW record;

int main(int argc,char **)
{
	char ch[256];
	int i;
	mysql=mysql_init(NULL);
	if(mysql==NULL)
	｛
		printf(\"error to mysql_init\\n\");
		return 0;
	｝
	m=mysql_real_connect(mysql,NULL,NULL,NULL,NULL,0,NULL,0);
	if(m==NULL)
	{
		printf(\"error to mysql_real_connect\\n\");
		mysql_close(mysql);
		return 0;
	}
	memset(ch,0,sizeof(ch));
	snprintf(ch,sizeof(ch),\"create database xxxaa\");
	i=mysql_query(mysql,ch);
	if(i!=0)
	{
		printf(\"error to create database;\\n\");
		mysql_close(mysql);
		return 0;
	}
	else
		printf(\"create success..\\n\");
	memset(ch,0,sizeof(ch));
	snprintf(ch,sizeof(ch),\"create table tt (name varchr(20),age int,phone varchar(20))\");
	i=mysql_query(mysql,ch);
	if(i!=0)
	{
		printf(\"error to create table\\n\");
		mysql_close(mysql);
		return 0;
	}
	mysql_close(mysql);	
}

</font></pre>";
echo "<center><font color=red size=5>关于C程序访问mysql数据库中文乱码的问题：</font></center><br>";
echo "<pre><font size=3 color=blue>首先，在mysql下访问记录显示正常，但是通过C程序读取出来的记录中文变成了？？？
此时在程序中应加入：mysql_set_character_set(mysql,\"utf8\"),该函数返回0,则表示设置成功，否则不能正常
显示中文。一个简单的实例如下：
------------------------------t02.c------------------------------------
#include\"clsscr.h\"
#include<mysql/mysql.h>

MYSQL	*mysql,*m;
MYSQL_RES *result;
MYSQL_ROW record;

int main(int argc,char** argv)
{
	char ch[512];
	int i;
	mysql=mysql_init(NULL);
	if(mysql==NULL)
	{
		printf(\"mysql init error\\n\");
		return 0;
	}
	m=mysql_real_connect(mysql,NULL,NULL,NULL,\"xianyou\",0,NULL,0);
	if(m==NULL)
	{
		mysql_close(mysql);
		printf(\"mysql connect error\\n\");
		return 0;
	}
	if(mysql_set_character_set(mysql,\"utf8\"))
	{
		printf(\"character error\\n\");
		mysql_close(mysql);
		return 0;
	}
	memset(ch,0,sizeof(ch));
	snprintf(ch,sizeof(ch),\"SELECT * FROM xy_man\");
	i=mysql_real_query(mysql,ch,strlen(ch));
	if(i!=0)
	{
		mysql_close(mysql);
		printf(\"mysql query error\\n\");
		return 0;
	}
	result=mysql_store_result(mysql);
	if(result==NULL)
	{
		mysql_close(mysql);
		printf(\"stroe result error\\n\");
		return 0;
	}
	while(record=mysql_fetch_row(result))
	{
		printf(\"uid: %s name: %s email: %s phone: %s\\n\",record[0],record[1],record[3],record[4]);
	}
	mysql_free_result(result);
	mysql_close(mysql);
	return 0;
}
------------------------------makefile--------------------------------------------------
t02:t02.c
	gcc -o t02 t02.c -lz `mysql_config --cflags --libs` -I/workarea/cprogram/include

------------------------------end-------------------------------------------------------


</font></pre>";
echo "<hr width=80%>
<a name=postgresql01></a><center><font size=5 color=blue>postgresql介绍</font></center>
<br>&nbsp;&nbsp;&nbsp;&nbsp;2016年9月添加的带有c接口介绍的8.1版本手册 &nbsp;&nbsp;<a href='postgresql/pgsqldoc-8.1c/index.html' target=_blank>postgresql8.1</a>
<pre>";
include_once("./linux_about/about_postgresql.txt");
echo "</pre>";
echo "<hr width=80%>
<a name=aspx01></a>";
include_once("./linux_about/aspx.txt");
echo "<hr width=80%>
<a name=php01></a>";
include_once("./linux_about/php_extern.txt");
?>





