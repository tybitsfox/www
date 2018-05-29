-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: web_data
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB-0+deb9u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `link_cnt`
--

DROP TABLE IF EXISTS `link_cnt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `link_cnt` (
  `link` varchar(128) NOT NULL COMMENT '自/var起的全路径链接地址',
  `count` int(8) unsigned DEFAULT '0' COMMENT '计数',
  `tip` varchar(50) NOT NULL COMMENT '信息提示',
  PRIMARY KEY (`link`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_cnt`
--

LOCK TABLES `link_cnt` WRITE;
/*!40000 ALTER TABLE `link_cnt` DISABLE KEYS */;
INSERT INTO `link_cnt` VALUES ('/var/www/tin16/bbb/b44.php',8,'b44.php'),('/var/www/tin16/bbb/b45.php',13,'b45.php'),('/var/www/tin16/bbb/b49.php',5,'b49.php'),('/var/www/tin16/bbb/baishi.php',90,'baishi.php'),('/var/www/tin16/bbb/bof3.php',90,'bof3.php'),('/var/www/tin16/bbb/bof3gl.php',90,'bof3gl.php'),('/var/www/tin16/bbb/bof4.php',57,'bof4.php'),('/var/www/tin16/bbb/bof41.php',20,'bof41.php'),('/var/www/tin16/bbb/bof4gonglue.php',23,'bof4gonglue.php'),('/var/www/tin16/bbb/bof4_skill.php',18,'bof4_skill.php'),('/var/www/tin16/bbb/fish.php',31,'fish.php'),('/var/www/tin16/bbb/skill.php',20,'skill.php'),('/var/www/tin16/bbb/xinde.php',25,'xinde.php'),('/var/www/tin16/bbb/yinzi.php',90,'yinzi.php'),('/var/www/tin16/bof1.php',1,'bof1.php'),('/var/www/tin16/geci.php',1,'geci.php'),('/var/www/tin16/iii/dq7.php',7,'dq7.php'),('/var/www/tin16/iii/gong1.php',3,'gong1.php'),('/var/www/tin16/iii/gong2.php',1,'gong2.php'),('/var/www/tin16/jjj/access.php',1,'access.php'),('/var/www/tin16/jjj/dqmps.php',1,'dqmps.php'),('/var/www/tin16/jjj/walkm2_01.php',1,'walkm2_01.php'),('/var/www/tin16/kkk/dq6.php',2,'dq6.php'),('/var/www/tin16/lll/abguts.php',2,'abguts.php'),('/var/www/tin16/lll/dq9.php',2,'dq9.php'),('/var/www/tin16/lll/job.php',1,'job.php'),('/var/www/tin16/lll/miss1.php',1,'miss1.php'),('/var/www/tin16/lll/shop.php',2,'shop.php'),('/var/www/tin16/lll/walk.php',1,'walk.php'),('/var/www/tin16/mmm/dq5.php',2,'dq5.php');
/*!40000 ALTER TABLE `link_cnt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_tb`
--

DROP TABLE IF EXISTS `menu_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_tb` (
  `menu` varchar(30) DEFAULT NULL COMMENT '菜单名称',
  `submenu` varchar(30) DEFAULT NULL COMMENT '子菜单名称',
  `count` int(11) DEFAULT NULL COMMENT '点击次数',
  `link` varchar(100) DEFAULT NULL COMMENT '链接地址',
  `tips` varchar(50) DEFAULT NULL COMMENT '提示信息',
  `idx` int(11) DEFAULT NULL COMMENT '菜单索引号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_tb`
--

LOCK TABLES `menu_tb` WRITE;
/*!40000 ALTER TABLE `menu_tb` DISABLE KEYS */;
INSERT INTO `menu_tb` VALUES ('站内普通资料','授权访问',128,'./test.php','授权访问资料',0),('站内普通资料','C函数索引',18,'./linux_C/left.htm','linux C函数索引',0),('站内普通资料','fedora',21,'./other.php','原fedora页面相关资料',0),('站内普通资料','VIM指令',0,'./vim.html','一个网上抓取的vim操作指南',0),('站内普通资料','系统安装杂记',17,'./setup.php','一些老旧的系统安装记录',0),('站内普通资料','linux内核选项',1,'./kernel_options.html','网上摘取的linux2.6.19内核选项简介',0),('站内普通资料','debian学习笔记',3,'./debian.htm','网上摘取的debian学习笔记',0),('站内编程资料','欢乐农场源代码',6,'./so_about.php','本人2010年开发的一款类似与QQ农场的gtk程序源代码',1),('站内编程资料','QT资料',4,'./qt.php','个人前期QT学习总结',1),('站内编程资料','linux 汇编',11,'./linux_about/alllinux.html','AT&T汇编学习资料及代码',1),('站内编程资料','mysql 编程',4,'./qqfarm.php','个人总结的mysql编程的相关问题',1),('站内编程资料','unix编程相关',0,'./unixfaq/book1.htm','UNIX Programming',1),('站内编程资料','gtk文档',65,'./gtkabout.php','网络获取及个人总结的gtk文档',1),('站内编程资料','Android开发',1,'./android.php','Android开发',1),('站内编程资料','php相关',11,'./php_about.php','php相关资料',1),('站内编程资料','内核准备',94,'./kernel/k_main.php','个人搜集整理的一些内核编程资料',1),('站内常用资料','我喜欢的WM',6,'./mywm.php','记录了我所钟爱的几款wm的操作和配置',2),('站内常用资料','VIM杂记',48,'./vimp/vimhelp.php','记录了我常用的vim配置和操作',2),('站内常用资料','debian安装',41,'./debian/setup_debian.php','个人debian安装经验及问题总结',2),('站内常用资料','linux实用命令',9,'./debian/order.php','linux下一些实用命令',2),('站内常用资料','mysql本地手册',11,'./refman-5.1-zh.html-chapter/index.html','一个从网上wget下来的mysql手册',2),('站内常用资料','杂项记录',23,'./linux_about/lab.php','linux下各类实用的命令和操作介绍',2),('站内常用资料','动态域名解析',163,'./dns_01.php','动态域名解析以及我的网盘链接',2),('实用工具软件','git介绍',4,'./all_tools/git/book/zh/index.html','git 介绍',3),('实用工具软件','git社区精华',1,'./all_tools/gitbook.liuhui998.com/index.html','git社区精华',3),('实用工具软件','邮件收发',17,'./all_tools/mutt/mutt.php','在debian下搭建邮件服务器的个人总结',3),('实用工具软件','GNU Make',12,'./all_tools/GNUmake_v3.80-zh_CN_html/index.html','GNU make中文手册',3),('实用工具软件','Bash',15,'./all_tools/abs-guide-3.7-cnhtml/HTML/index.html','高级bash脚本编程指南',3),('实用工具软件','vimdoc',4,'./all_tools/vimcdoc.sourceforge.net/doc/help.html','另一个网上获取的vim文档',3),('实用工具软件','feh',5,'./all_tools/feh/feh.php','小巧实用的看图软件feh介绍',3),('实用工具软件','udev编写规则',0,'./all_tools/udev/writing_udev_rules.html','udev编写规则',3),('实用工具软件','w3m简介',0,'./all_tools/w3m/w3m.php','w3m-基于文本的网页浏览器介绍',3),('实用工具软件','apt常用功能',0,'./all_tools/apt/apt.php','apt常用功能简介',3),('实用工具软件','ssh基本应用',1,'./all_tools/ssh/ssh.php','ssh基本应用',3),('实用工具软件','grub rescure',2,'./all_tools/grub.php','grub rescure简介',3),('实用工具软件','python3',29,'./python3/index.html','python3教程',3),('实用工具软件','python',25,'./woodpecker.org.cn/abyteofpython_cn/chinese/index.html','python教程',3),('站内娱乐','丁丁历险记',6,'./tin.php','丁丁历险记-月球探险',4),('站内娱乐','全球摄像头',3,'./newyork.php','纽约街头监控',4),('站内娱乐','全景图',7,'./googlemap/vieww.php','世界各地全景图',4),('站内娱乐','网易音乐',6,'http://music.163.com/#/song?id=5264840','网易音乐',4),('常用链接','5566',1994,'http://www.5566.org/','5566门户网站',5),('常用链接','卫星云图',358,'http://www.zjwater.gov.cn/wxyt.aspx','浙江水利卫星云图',5),('常用链接','地震台网',8,'http://bulletin.gddsn.org.cn/seisbulletin/main.seam','虚拟地震台网',5),('常用链接','在线翻译',5,'http://translate.google.cn/','google翻译',5),('常用链接','google',25,'https://www.google.com.hk/','你懂得网站',5),('常用链接','百度2012',1053,'http://tieba.baidu.com/f?kw=2012','百度2012吧',5),('常用链接','百度linux',44,'http://tieba.baidu.com/f?kw=linux','百度linux吧',5),('常用链接','ok模拟网',74,'http://www.okemu.com/default.html','ok模拟网',5),('常用链接','飞鸟娱乐',23,'http://bbs.hdbird.com/','飞鸟娱乐',5),('常用链接','ip查询',7,'http://www.ip138.com/','ip查询',5),('常用链接','webQQ',2,'http://web2.qq.com/','webqq',5),('常用链接','QQ',11,'http://i.qq.com/','QQ空间登录',5),('常用链接','debian',2,'http://www.debian.org/releases/stable/i386/index.html.zh_CN','debian安装手册',5),('常用链接','gentoo',0,'http://www.gentoo.org/doc/zh_cn/','gentoo',5),('常用链接','php中文手册',1,'http://docs.php.net/manual/zh/','php手册',5),('常用链接','mysql5.1手册',0,'http://dev.mysql.com/doc/refman/5.1/zh/index.html','MySQL 5.1参考手册',5),('常用链接','我的行宫',16,'http://tieba.baidu.com/f?kw=捣蛋的行宫','我的行宫',5),('常用链接','中国linux论坛',0,'http://www.linuxforum.net/','中国linux论坛',5),('站内编程资料','PostgreSQL数据库',5,'./qqfarm.php%23postgresql01','Postgresql数据库简介',1),('站内编程资料','在.net中调用DLL',1,'./qqfarm.php%23aspx01','在asp.net中调用VC编写的dll动态库',1),('站内编程资料','在PHP中使用so',4,'./qqfarm.php%23php01','在php中通过扩展模块使用动态链接库so',1),('实用工具软件','koding使用',9,'./all_tools/ssh/ssh.php%23koding','koding的简单应用介绍',3),('实用工具软件','数据库',106,'./all_tools/database/mssql.php','集成的各类数据库的应用介绍',3),('实用工具软件','IRC',1,'./all_tools/irc.php','一个通讯工具软件的介绍',3),('实用工具软件','zathura',7,'./all_tools/zathura.php','一个绝佳的PDF浏览器',3),('常用链接','国治精品屋',29,'http://www.emu618.net/','模拟器网站',5),('常用链接','阳光影视',144,'http://www.ygdy8.com','阳光影视',5),('站内娱乐','歌词',17,'./tin16/geci.php','最爱的歌曲歌词',4),('站内常用资料','PHP函数',6,'./www.veryhuo.com/php/index.html','PHP函数',2),('站内常用资料','PHP5手册',39,'./php-chunked-xhtml/index.html','PHP函数',2),('实用工具软件','python2.7',22,'./python3/python2.7/index.html','python详细教程',3),('站内编程资料','python总结',9,'./python/pmain.php','个人学习python的总结和心得',1);
/*!40000 ALTER TABLE `menu_tb` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-29  9:39:07
