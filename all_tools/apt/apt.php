<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<font size=5 color=red><center>apt常用功能简介</center></font><br>";
echo "<font size=3 color=black>一、apt源的配置文件为：/etc/apt/sources.list,我现在使用的源是163、中科大和搜狐的一般配置如下：<br>";
echo "# deb cdrom:[Debian GNU/Linux 7.1.0 _Wheezy_ - Official i386 DVD Binary-1 20130615-21:54]/ wheezy contrib main<br>";
echo "deb http://mirrors.163.com/debian/ wheezy main non-free contrib<br>deb-src http://mirrors.163.com/debian/ wheezy main non-free contrib</font><br>";
echo "deb http://ftp.cn.debian.org/debian/ wheezy main non-free contrib<br>deb-src http://ftp.cn.debian.org/debian/ wheezy main non-free contrib</font><br>";
echo "deb http://mirrors.sohu.com/debian/ wheezy main non-free contrib<br>deb-src http://mirrors.sohu.com/debian/ wheezy main non-free contrib</font><br>";
echo "<font size=3 color=black>二、查找、安装包：atpitude search mysql，找到需要安装的包，然后使用apt-get install mysql-server-5.1<br>";
echo "三、更新、删除已安装的软件包：从源网址上获取更新的软件包列表 apt-get update，软件包更新 apt-get upgrade<br>";
echo "卸载软件包 apt-get remove mysql_server-5.1 或者使用autoremove卸载自动安装且不在使用的包<br>";
echo "四、查找已安装的软件包：dpkg -l *mysql* |grep ii 下面是我的debian602下查找已安装的mysql相关的软件包信息：<br>";
echo "<pre>
root@tiny:~# dpkg -l *mysql* |grep ii
ii  libdbd-mysql-perl                  4.016-1                      Perl5 database interface to the MySQL database
ii  libmysqlclient-dev                 5.1.49-3                     MySQL database development files
ii  libmysqlclient16                   5.1.49-3                     MySQL database client library
ii  libmysqld-dev                      5.1.49-3                     MySQL embedded database development files
ii  libqt4-sql-mysql                   4:4.6.3-4+squeeze1           Qt 4 MySQL database driver
ii  mysql-client-5.1                   5.1.49-3                     MySQL database client binaries
ii  mysql-common                       5.1.49-3                     MySQL database common files, e.g. /etc/mysql/my.cnf
ii  mysql-server                       5.1.49-3                     MySQL database server (metapackage depending on the latest version)
ii  mysql-server-5.1                   5.1.49-3                     MySQL database server binaries and system database setup
ii  mysql-server-core-5.1              5.1.49-3                     MySQL database server binaries
ii  php5-mysql                         5.3.3-7+squeeze1             MySQL module for php5
</pre></font>";
?>
