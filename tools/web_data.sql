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
INSERT INTO `link_cnt` VALUES ('/var/www/tin16/bbb/b44.php',10,'b44.php'),('/var/www/tin16/bbb/b45.php',15,'b45.php'),('/var/www/tin16/bbb/b49.php',7,'b49.php'),('/var/www/tin16/bbb/baishi.php',92,'baishi.php'),('/var/www/tin16/bbb/bof3.php',92,'bof3.php'),('/var/www/tin16/bbb/bof3gl.php',92,'bof3gl.php'),('/var/www/tin16/bbb/bof4.php',63,'bof4.php'),('/var/www/tin16/bbb/bof41.php',21,'bof41.php'),('/var/www/tin16/bbb/bof4gonglue.php',33,'bof4gonglue.php'),('/var/www/tin16/bbb/bof4_skill.php',19,'bof4_skill.php'),('/var/www/tin16/bbb/fish.php',31,'fish.php'),('/var/www/tin16/bbb/skill.php',20,'skill.php'),('/var/www/tin16/bbb/xinde.php',25,'xinde.php'),('/var/www/tin16/bbb/yinzi.php',92,'yinzi.php'),('/var/www/tin16/bof1.php',13,'bof1.php'),('/var/www/tin16/CastleVania2/castle2.php',1,'castle2.php'),('/var/www/tin16/ccc/ff5.php',15,'ff5.php'),('/var/www/tin16/ccc/ff5_blue_magic_list1.php',2,'ff5_blue_magic_list1.php'),('/var/www/tin16/ccc/ff5_blue_magic_list2.php',3,'ff5_blue_magic_list2.php'),('/var/www/tin16/ccc/ff5_magic.php',3,'ff5_magic.php'),('/var/www/tin16/ccc/ff5_part1_4.php',3,'ff5_part1_4.php'),('/var/www/tin16/ccc/ff5_part1_5.php',1,'ff5_part1_5.php'),('/var/www/tin16/ccc/ff5_part2_1.php',2,'ff5_part2_1.php'),('/var/www/tin16/ccc/ff5_part2_2.php',5,'ff5_part2_2.php'),('/var/www/tin16/ccc/ff5_part2_3.php',2,'ff5_part2_3.php'),('/var/www/tin16/ccc/ff5_part3_2.php',3,'ff5_part3_2.php'),('/var/www/tin16/ccc/ff5_part3_3.php',5,'ff5_part3_3.php'),('/var/www/tin16/ccc/ff5_part3_4.php',1,'ff5_part3_4.php'),('/var/www/tin16/ddd/ff6.php',6,'ff6.php'),('/var/www/tin16/ddd/ff6_part_1-1.php',2,'ff6_part_1-1.php'),('/var/www/tin16/ddd/ff6_part_1-2.php',4,'ff6_part_1-2.php'),('/var/www/tin16/ddd/ff6_part_1-3.php',1,'ff6_part_1-3.php'),('/var/www/tin16/ddd/ff6_part_2-3.php',1,'ff6_part_2-3.php'),('/var/www/tin16/fff/ff3.php',12,'ff3.php'),('/var/www/tin16/fff/ff3_iron_giant.php',1,'ff3_iron_giant.php'),('/var/www/tin16/fff/ff3_part_1_1.php',2,'ff3_part_1_1.php'),('/var/www/tin16/fff/ff3_part_1_3.php',2,'ff3_part_1_3.php'),('/var/www/tin16/fff/ff3_part_1_4.php',2,'ff3_part_1_4.php'),('/var/www/tin16/fff/ff3_part_2_1.php',6,'ff3_part_2_1.php'),('/var/www/tin16/fff/ff3_part_2_2.php',5,'ff3_part_2_2.php'),('/var/www/tin16/fff/ff3_part_3_1.php',3,'ff3_part_3_1.php'),('/var/www/tin16/fff/ff3_part_3_2.php',6,'ff3_part_3_2.php'),('/var/www/tin16/fff/ff3_part_3_3.php',2,'ff3_part_3_3.php'),('/var/www/tin16/geci.php',3,'geci.php'),('/var/www/tin16/hhh/ff9_01.php',6,'ff9_01.php'),('/var/www/tin16/hhh/ff9_02.php',1,'ff9_02.php'),('/var/www/tin16/hhh/ff9_index.php',8,'ff9_index.php'),('/var/www/tin16/hhh/ff9_magic1.php',2,'ff9_magic1.php'),('/var/www/tin16/hhh/ff9_magic2.php',2,'ff9_magic2.php'),('/var/www/tin16/hhh/ff9_magic3.php',1,'ff9_magic3.php'),('/var/www/tin16/hhh/ff9_map.php',1,'ff9_map.php'),('/var/www/tin16/hhh/ff9_mon_a.php',1,'ff9_mon_a.php'),('/var/www/tin16/hhh/ff9_shop.php',1,'ff9_shop.php'),('/var/www/tin16/hhh/ff9_skill.php',2,'ff9_skill.php'),('/var/www/tin16/hhh/ff9_special_ama.php',1,'ff9_special_ama.php'),('/var/www/tin16/hhh/ff9_special_jitan.php',2,'ff9_special_jitan.php'),('/var/www/tin16/hhh/ff9_special_xiaodao.php',2,'ff9_special_xiaodao.php'),('/var/www/tin16/hhh/ff9_status.php',1,'ff9_status.php'),('/var/www/tin16/hhh/ff9_wepon.php',1,'ff9_wepon.php'),('/var/www/tin16/iii/accessories.php',1,'accessories.php'),('/var/www/tin16/iii/comb_job.php',9,'comb_job.php'),('/var/www/tin16/iii/dq7.php',38,'dq7.php'),('/var/www/tin16/iii/exp.php',1,'exp.php'),('/var/www/tin16/iii/gong1.php',5,'gong1.php'),('/var/www/tin16/iii/gong10.php',6,'gong10.php'),('/var/www/tin16/iii/gong11.php',7,'gong11.php'),('/var/www/tin16/iii/gong12.php',2,'gong12.php'),('/var/www/tin16/iii/gong13.php',2,'gong13.php'),('/var/www/tin16/iii/gong14.php',5,'gong14.php'),('/var/www/tin16/iii/gong15.php',1,'gong15.php'),('/var/www/tin16/iii/gong16.php',1,'gong16.php'),('/var/www/tin16/iii/gong18.php',1,'gong18.php'),('/var/www/tin16/iii/gong2.php',1,'gong2.php'),('/var/www/tin16/iii/gong3.php',1,'gong3.php'),('/var/www/tin16/iii/gong4.php',3,'gong4.php'),('/var/www/tin16/iii/gong5.php',7,'gong5.php'),('/var/www/tin16/iii/gong6.php',9,'gong6.php'),('/var/www/tin16/iii/gong7.php',5,'gong7.php'),('/var/www/tin16/iii/gong8.php',7,'gong8.php'),('/var/www/tin16/iii/gong9.php',7,'gong9.php'),('/var/www/tin16/iii/job1.php',6,'job1.php'),('/var/www/tin16/iii/job2.php',2,'job2.php'),('/var/www/tin16/iii/magic.php',1,'magic.php'),('/var/www/tin16/iii/prac_job.php',2,'prac_job.php'),('/var/www/tin16/iii/shield.php',1,'shield.php'),('/var/www/tin16/iii/skills.php',1,'skills.php'),('/var/www/tin16/jjj/access.php',1,'access.php'),('/var/www/tin16/jjj/battle.php',2,'battle.php'),('/var/www/tin16/jjj/combine.php',1,'combine.php'),('/var/www/tin16/jjj/dqmps.php',58,'dqmps.php'),('/var/www/tin16/jjj/monster.php',55,'monster.php'),('/var/www/tin16/jjj/skill.php',13,'skill.php'),('/var/www/tin16/jjj/walkm1.php',21,'walkm1.php'),('/var/www/tin16/jjj/walkm2_01.php',3,'walkm2_01.php'),('/var/www/tin16/jjj/walkm2_03.php',3,'walkm2_03.php'),('/var/www/tin16/jjj/walkm2_05.php',2,'walkm2_05.php'),('/var/www/tin16/jjj/walkm2_06.php',2,'walkm2_06.php'),('/var/www/tin16/kkk/dq6.php',13,'dq6.php'),('/var/www/tin16/kkk/job1.php',43,'job1.php'),('/var/www/tin16/kkk/job2.php',24,'job2.php'),('/var/www/tin16/kkk/job3.php',6,'job3.php'),('/var/www/tin16/kkk/job4.php',1,'job4.php'),('/var/www/tin16/kkk/skill.php',6,'skill.php'),('/var/www/tin16/kkk/spell.php',8,'spell.php'),('/var/www/tin16/kkk/walk1.php',1,'walk1.php'),('/var/www/tin16/kkk/walk4.php',1,'walk4.php'),('/var/www/tin16/kkk/walk6.php',1,'walk6.php'),('/var/www/tin16/kkk/walk7.php',1,'walk7.php'),('/var/www/tin16/lll/abenlight.php',3,'abenlight.php'),('/var/www/tin16/lll/abfocus.php',2,'abfocus.php'),('/var/www/tin16/lll/abfource.php',1,'abfource.php'),('/var/www/tin16/lll/abguts.php',6,'abguts.php'),('/var/www/tin16/lll/abjene.php',1,'abjene.php'),('/var/www/tin16/lll/abli.php',1,'abli.php'),('/var/www/tin16/lll/abspell.php',2,'abspell.php'),('/var/www/tin16/lll/abvalour.php',1,'abvalour.php'),('/var/www/tin16/lll/combine.php',8,'combine.php'),('/var/www/tin16/lll/comb_item.php',3,'comb_item.php'),('/var/www/tin16/lll/dq9.php',21,'dq9.php'),('/var/www/tin16/lll/jianjie.php',4,'jianjie.php'),('/var/www/tin16/lll/job.php',4,'job.php'),('/var/www/tin16/lll/job_mission.php',10,'job_mission.php'),('/var/www/tin16/lll/miss1.php',5,'miss1.php'),('/var/www/tin16/lll/miss2.php',7,'miss2.php'),('/var/www/tin16/lll/miss3.php',1,'miss3.php'),('/var/www/tin16/lll/shop.php',6,'shop.php'),('/var/www/tin16/lll/walk.php',6,'walk.php'),('/var/www/tin16/mmm/dq5.php',21,'dq5.php'),('/var/www/tin16/mmm/fellow.php',1,'fellow.php'),('/var/www/tin16/mmm/f_skill.php',1,'f_skill.php'),('/var/www/tin16/mmm/hide.php',1,'hide.php'),('/var/www/tin16/mmm/magic3.php',2,'magic3.php'),('/var/www/tin16/mmm/walk2.php',6,'walk2.php'),('/var/www/tin16/mmm/walk3.php',11,'walk3.php'),('/var/www/tin16/mmm/walk4.php',3,'walk4.php'),('/var/www/tin16/mmm/wife.php',1,'wife.php'),('/var/www/tin16/zzjb_mm2r.php',2,'zzjb_mm2r.php'),('/var/www/tin16/zzjb_mmr.php',1,'zzjb_mmr.php');
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
INSERT INTO `menu_tb` VALUES ('站内普通资料','授权访问',180,'./test.php','授权访问资料',0),('站内普通资料','C函数索引',18,'./linux_C/left.htm','linux C函数索引',0),('站内普通资料','fedora',21,'./other.php','原fedora页面相关资料',0),('站内普通资料','VIM指令',0,'./vim.html','一个网上抓取的vim操作指南',0),('站内普通资料','系统安装杂记',18,'./setup.php','一些老旧的系统安装记录',0),('站内普通资料','linux内核选项',1,'./kernel_options.html','网上摘取的linux2.6.19内核选项简介',0),('站内普通资料','debian学习笔记',3,'./debian.htm','网上摘取的debian学习笔记',0),('站内编程资料','欢乐农场源代码',7,'./so_about.php','本人2010年开发的一款类似与QQ农场的gtk程序源代码',1),('站内编程资料','QT资料',4,'./qt.php','个人前期QT学习总结',1),('站内编程资料','linux 汇编',11,'./linux_about/alllinux.html','AT&T汇编学习资料及代码',1),('站内编程资料','mysql 编程',4,'./qqfarm.php','个人总结的mysql编程的相关问题',1),('站内编程资料','unix编程相关',0,'./unixfaq/book1.htm','UNIX Programming',1),('站内编程资料','gtk文档',65,'./gtkabout.php','网络获取及个人总结的gtk文档',1),('站内编程资料','Android开发',1,'./android.php','Android开发',1),('站内编程资料','php相关',12,'./php_about.php','php相关资料',1),('站内编程资料','内核准备',96,'./kernel/k_main.php','个人搜集整理的一些内核编程资料',1),('站内常用资料','我喜欢的WM',6,'./mywm.php','记录了我所钟爱的几款wm的操作和配置',2),('站内常用资料','VIM杂记',51,'./vimp/vimhelp.php','记录了我常用的vim配置和操作',2),('站内常用资料','debian安装',41,'./debian/setup_debian.php','个人debian安装经验及问题总结',2),('站内常用资料','linux实用命令',10,'./debian/order.php','linux下一些实用命令',2),('站内常用资料','mysql本地手册',11,'./refman-5.1-zh.html-chapter/index.html','一个从网上wget下来的mysql手册',2),('站内常用资料','杂项记录',24,'./linux_about/lab.php','linux下各类实用的命令和操作介绍',2),('站内常用资料','动态域名解析',195,'./dns_01.php','动态域名解析以及我的网盘链接',2),('实用工具软件','git介绍',4,'./all_tools/git/book/zh/index.html','git 介绍',3),('实用工具软件','git社区精华',1,'./all_tools/gitbook.liuhui998.com/index.html','git社区精华',3),('实用工具软件','邮件收发',17,'./all_tools/mutt/mutt.php','在debian下搭建邮件服务器的个人总结',3),('实用工具软件','GNU Make',13,'./all_tools/GNUmake_v3.80-zh_CN_html/index.html','GNU make中文手册',3),('实用工具软件','Bash',17,'./all_tools/abs-guide-3.7-cnhtml/HTML/index.html','高级bash脚本编程指南',3),('实用工具软件','vimdoc',4,'./all_tools/vimcdoc.sourceforge.net/doc/help.html','另一个网上获取的vim文档',3),('实用工具软件','feh',5,'./all_tools/feh/feh.php','小巧实用的看图软件feh介绍',3),('实用工具软件','udev编写规则',0,'./all_tools/udev/writing_udev_rules.html','udev编写规则',3),('实用工具软件','w3m简介',0,'./all_tools/w3m/w3m.php','w3m-基于文本的网页浏览器介绍',3),('实用工具软件','apt常用功能',0,'./all_tools/apt/apt.php','apt常用功能简介',3),('实用工具软件','ssh基本应用',1,'./all_tools/ssh/ssh.php','ssh基本应用',3),('实用工具软件','grub rescure',2,'./all_tools/grub.php','grub rescure简介',3),('实用工具软件','python3',29,'./python3/index.html','python3教程',3),('实用工具软件','python',27,'./woodpecker.org.cn/abyteofpython_cn/chinese/index.html','python教程',3),('站内娱乐','丁丁历险记',6,'./tin.php','丁丁历险记-月球探险',4),('站内娱乐','全球摄像头',3,'./newyork.php','纽约街头监控',4),('站内娱乐','全景图',7,'./googlemap/vieww.php','世界各地全景图',4),('站内娱乐','网易音乐',9,'http://music.163.com/#/song?id=5264840','网易音乐',4),('常用链接','5566',2083,'http://www.5566.org/','5566门户网站',5),('常用链接','卫星云图',389,'http://www.zjwater.gov.cn/wxyt.aspx','浙江水利卫星云图',5),('常用链接','地震台网',10,'http://news.ceic.ac.cn/index.html','虚拟地震台网',5),('常用链接','在线翻译',5,'http://translate.google.cn/','google翻译',5),('常用链接','google',25,'https://www.google.com.hk/','你懂得网站',5),('常用链接','百度2012',1121,'http://tieba.baidu.com/f?kw=2012','百度2012吧',5),('常用链接','百度linux',44,'http://tieba.baidu.com/f?kw=linux','百度linux吧',5),('常用链接','ok模拟网',79,'http://www.okemu.com/default.html','ok模拟网',5),('常用链接','ip查询',8,'http://www.ip138.com/','ip查询',5),('常用链接','webQQ',2,'http://web2.qq.com/','webqq',5),('常用链接','QQ',11,'http://i.qq.com/','QQ空间登录',5),('常用链接','debian',2,'http://www.debian.org/releases/stable/i386/index.html.zh_CN','debian安装手册',5),('常用链接','gentoo',0,'http://www.gentoo.org/doc/zh_cn/','gentoo',5),('常用链接','php中文手册',2,'http://docs.php.net/manual/zh/','php手册',5),('常用链接','mysql5.1手册',0,'http://dev.mysql.com/doc/refman/5.1/zh/index.html','MySQL 5.1参考手册',5),('常用链接','我的行宫',19,'http://tieba.baidu.com/f?kw=捣蛋的行宫','我的行宫',5),('常用链接','中国linux论坛',0,'http://www.linuxforum.net/','中国linux论坛',5),('站内编程资料','PostgreSQL数据库',5,'./qqfarm.php%23postgresql01','Postgresql数据库简介',1),('站内编程资料','在.net中调用DLL',1,'./qqfarm.php%23aspx01','在asp.net中调用VC编写的dll动态库',1),('站内编程资料','在PHP中使用so',4,'./qqfarm.php%23php01','在php中通过扩展模块使用动态链接库so',1),('实用工具软件','koding使用',9,'./all_tools/ssh/ssh.php%23koding','koding的简单应用介绍',3),('实用工具软件','数据库',125,'./all_tools/database/mssql.php','集成的各类数据库的应用介绍',3),('实用工具软件','IRC',1,'./all_tools/irc.php','一个通讯工具软件的介绍',3),('实用工具软件','zathura',7,'./all_tools/zathura.php','一个绝佳的PDF浏览器',3),('常用链接','阳光影视',171,'http://www.ygdy8.com','阳光影视',5),('站内娱乐','歌词',19,'./tin16/geci.php','最爱的歌曲歌词',4),('站内常用资料','PHP函数',26,'./www.veryhuo.com/php/index.html','PHP函数',2),('站内常用资料','PHP5手册',42,'./php-chunked-xhtml/index.html','PHP函数',2),('实用工具软件','python2.7',22,'./python3/python2.7/index.html','python详细教程',3),('站内编程资料','python总结',9,'./python/pmain.php','个人学习python的总结和心得',1),('常用链接','菜鸟教程',16,'http://www.runoob.com/','前端技术学习网站',5);
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

-- Dump completed on 2019-01-06  9:22:32
