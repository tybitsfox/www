-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: hlgj_2018
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
-- Table structure for table `auth`
--

DROP TABLE IF EXISTS `auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth` (
  `uid` int(32) unsigned NOT NULL COMMENT '用户ID',
  `email` varchar(32) NOT NULL COMMENT '注册邮箱',
  `uname` varchar(32) NOT NULL COMMENT '昵称',
  `pwd` varchar(64) NOT NULL COMMENT '密码',
  `priv` int(8) unsigned NOT NULL COMMENT '权限',
  `lvl` int(8) unsigned NOT NULL COMMENT '等级',
  `sex` int(8) unsigned NOT NULL COMMENT '性别',
  `expr` int(32) unsigned NOT NULL COMMENT '经验值',
  `coin` int(32) unsigned NOT NULL COMMENT '金币',
  `treasure` int(32) unsigned NOT NULL COMMENT '财富值',
  `signup` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '注册时间',
  `lastlogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后登录时间',
  `imgpath` varchar(256) DEFAULT NULL COMMENT '头像链接',
  PRIMARY KEY (`email`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth`
--

LOCK TABLES `auth` WRITE;
/*!40000 ALTER TABLE `auth` DISABLE KEYS */;
INSERT INTO `auth` VALUES (100002,'test1@163.com','test1','260be2fecdf89f88eab77128ef7511d3',7,1,0,2,2,0,'2018-07-03 01:57:20','2018-07-07 03:49:31','/huili/images/upload/893837911.jpg'),(100003,'test2@163.com','test2','8d114dfc0aa6cbd20d74a573b9343e86',7,1,0,4,4,0,'2018-07-03 01:57:21','2018-07-26 08:30:03','/huili/images/upload/002S14P1-2.jpg'),(100004,'test3@163.com','test3','ae71aca395893a68edfae00b2502b2ba',7,1,0,2,2,0,'2018-07-03 01:57:21','2018-07-26 07:25:42','/huili/images/upload/0255004244-0.jpg'),(100005,'test4@163.com','test4','294d6d199b92abdc07e6715956c67831',7,1,0,1,1,0,'2018-07-03 01:57:21','2018-07-09 07:59:31','/huili/images/upload/timg2.jpeg'),(100006,'test5@163.com','test5','c198e96271965c83219549c2d8961a9b',7,1,0,1,1,0,'2018-07-05 13:51:03','2018-07-09 08:02:03','/huili/images/upload/aaa1.jpg'),(100007,'test6@163.com','test6','9c56b932f9aad6427aaa43aea215d83d',7,1,0,1,1,0,'2018-07-05 13:51:03','2018-07-10 01:18:24','/huili/images/upload/timg3.jpeg'),(100008,'test7@163.com','test7','1817399417998612cdca4a671771d60a',7,1,0,0,0,0,'2018-07-05 13:51:03','2018-07-05 13:51:03',NULL),(100009,'test8@163.com','test8','bd969170781556ac46fd26fbd3f15e39',7,1,0,1,1,0,'2018-07-05 13:51:03','2018-07-18 07:36:51',NULL),(100010,'test9@163.com','test9','b081fd85802d5708431149c13c6687f5',7,1,0,0,0,0,'2018-07-05 13:54:56','2018-07-05 13:54:56',NULL),(100001,'tybitsfox@163.com','tybitsfox','2694f8b0e3d3d17ff567c9ca072db75c',7,1,0,0,0,0,'2018-07-03 01:37:49','2018-07-03 01:37:49',NULL),(100000,'tyyyyt@163.com','田勇','9a071c40a829eea19b90a5e011d64703',7,1,0,15,15,0,'2018-07-03 01:12:06','2018-07-25 23:38:02','/huili/images/upload/worldcup.jpeg');
/*!40000 ALTER TABLE `auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog` (
  `tuid` int(32) unsigned NOT NULL COMMENT '帖子ID',
  `idx` int(8) unsigned NOT NULL COMMENT '顺序号',
  `ttile` varchar(128) NOT NULL COMMENT '帖子主题',
  `uname` varchar(32) NOT NULL COMMENT '作者',
  `fintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '发帖时间',
  `ttext` text COMMENT '内容',
  `piclink` varchar(256) DEFAULT NULL COMMENT '图片链接',
  `uid` int(32) unsigned NOT NULL COMMENT '作者ID',
  PRIMARY KEY (`tuid`,`idx`),
  KEY `name_id` (`uname`,`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `choose`
--

DROP TABLE IF EXISTS `choose`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `choose` (
  `uid` int(32) unsigned NOT NULL COMMENT '用户id',
  `mid` int(32) unsigned NOT NULL COMMENT '模块id',
  `cid` varchar(32) NOT NULL COMMENT '元素类id',
  `mname` varchar(16) NOT NULL COMMENT '模块名称',
  `mlink` varchar(128) NOT NULL COMMENT '模块链接',
  `mclass` varchar(16) NOT NULL COMMENT '元素类名称',
  `micon` varchar(32) NOT NULL COMMENT '模块图标',
  PRIMARY KEY (`uid`,`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `choose`
--

LOCK TABLES `choose` WRITE;
/*!40000 ALTER TABLE `choose` DISABLE KEYS */;
INSERT INTO `choose` VALUES (100000,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100000,1,'chlink3','环境工程','/huili/include/home.php?select=5cd4814c281bf77cf5272797d9743cf7','with-name','icon-truck'),(100000,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100000,15,'chlink17','交流互动','/huili/include/home.php?select=749ab3b68632680660d776891751e812','with-name','icon-cchat'),(100002,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100002,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100003,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100003,12,'chlink14','资料下载','/huili/include/home.php?select=f3f7bacf6f435e7aa6391b1d9e2846b4','with-name','icon-download'),(100003,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100004,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100004,1,'chlink3','环境工程','/huili/include/home.php?select=5cd4814c281bf77cf5272797d9743cf7','with-name','icon-truck'),(100009,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100009,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100009,14,'chlink16','监控平台','/huili/include/home.php?select=03142410d7285f00e4363e005783c83a','with-name','icon-desktop');
/*!40000 ALTER TABLE `choose` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `uid` int(32) unsigned NOT NULL COMMENT '企业id',
  `name` varchar(48) NOT NULL COMMENT '企业名称',
  `img` varchar(128) NOT NULL COMMENT '图片链接',
  `industry` varchar(32) NOT NULL COMMENT '所属行业',
  `iid` int(8) unsigned NOT NULL COMMENT '行业id',
  `intro` varchar(256) NOT NULL COMMENT '企业简介',
  `addr` varchar(48) NOT NULL COMMENT '企业地址',
  `phone` varchar(12) NOT NULL COMMENT '联系电话',
  `confirmed` int(4) unsigned NOT NULL COMMENT '认证标志',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (100004,'山东汇力环保科技公司','/huili/images/upload/b_04E2087C04B7C851.jpg',' ',24,'环境问题解决专家','泰安市长城路1366号','12393934',0);
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conn_me`
--

DROP TABLE IF EXISTS `conn_me`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conn_me` (
  `uid` int(32) unsigned NOT NULL COMMENT '用户id',
  `cid` int(32) unsigned NOT NULL COMMENT '合作者id',
  `ctype` int(4) unsigned NOT NULL COMMENT '合作者类型',
  PRIMARY KEY (`uid`,`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conn_me`
--

LOCK TABLES `conn_me` WRITE;
/*!40000 ALTER TABLE `conn_me` DISABLE KEYS */;
/*!40000 ALTER TABLE `conn_me` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expert`
--

DROP TABLE IF EXISTS `expert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expert` (
  `uid` int(32) unsigned NOT NULL COMMENT '用户id',
  `category` int(4) unsigned NOT NULL COMMENT '类别',
  `name` varchar(32) NOT NULL COMMENT '用户名',
  `addr` varchar(48) NOT NULL COMMENT '单位或地址',
  `phone` varchar(12) NOT NULL COMMENT '电话',
  `major` varchar(32) NOT NULL COMMENT '行业或专业',
  `intro` text NOT NULL COMMENT '简介',
  `mid` int(32) unsigned NOT NULL COMMENT '专业id',
  `confirmed` int(4) unsigned NOT NULL COMMENT '认证标志',
  PRIMARY KEY (`uid`),
  KEY `mid` (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expert`
--

LOCK TABLES `expert` WRITE;
/*!40000 ALTER TABLE `expert` DISABLE KEYS */;
INSERT INTO `expert` VALUES (100000,0,'田勇','泰安市环境保护局','8877680',' ','农村环境,土壤监测',24,1),(100002,0,'张三','山东农业大学','18598231668',' ','重金属废水、氨氮废水、垃圾渗滤液处理',25,1),(100003,1,'山东汇力环保科技公司','泰安市长城路1366号','05386541237',' ','环保科技咨询、环保自动连续监测设备运营管理、污染治理设施运营管理、治理环境污染的技术咨询、服务协作、承包，环保治理、监测设备与配件销售、设计，环保治理工程设计、施工、设备安装',7,1),(100004,0,'李四','山东科技大学','12393934',' ','通风专业博导，噪音治理专家',20,1),(100005,1,'山东清源水务有限公司','泰安市南关大街381号','8877694',' ','有丰富的污水处理厂运营经验，擅长处理各类生活污水和工业废水',5,1),(100006,1,'深圳环宇设备仪器公司','深圳市创业大道1988号','4008851299',' ','生产和销售各类分析化验仪器设备，并熟悉河流，水源地，城市空气站的自动运营维护',7,1);
/*!40000 ALTER TABLE `expert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fixedmod`
--

DROP TABLE IF EXISTS `fixedmod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fixedmod` (
  `mid` int(32) unsigned NOT NULL COMMENT '模块id',
  `cid` varchar(32) NOT NULL COMMENT '元素类id',
  `mname` varchar(16) NOT NULL COMMENT '模块名称',
  `mlink` varchar(128) NOT NULL COMMENT '模块链接',
  `mclass` varchar(16) NOT NULL COMMENT '元素类名称',
  `micon` varchar(32) NOT NULL COMMENT '模块图标',
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fixedmod`
--

LOCK TABLES `fixedmod` WRITE;
/*!40000 ALTER TABLE `fixedmod` DISABLE KEYS */;
/*!40000 ALTER TABLE `fixedmod` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invite`
--

DROP TABLE IF EXISTS `invite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invite` (
  `idx` int(32) NOT NULL AUTO_INCREMENT COMMENT '自增量id',
  `uid` int(32) unsigned NOT NULL COMMENT '用户id',
  `invemail` varchar(32) NOT NULL COMMENT '受邀邮箱',
  `invbody` text NOT NULL COMMENT '邀请内容',
  `invited` int(4) unsigned NOT NULL COMMENT '是否接受',
  PRIMARY KEY (`uid`,`invemail`),
  KEY `idx` (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invite`
--

LOCK TABLES `invite` WRITE;
/*!40000 ALTER TABLE `invite` DISABLE KEYS */;
INSERT INTO `invite` VALUES (8,100000,'bitsfox@126.com','hello bitsfox',0),(6,100000,'tybitsfox@126.com','welcome to visit huishi group',0),(7,100000,'tybitsfox@163.com','welcome to visit huishi group',1);
/*!40000 ALTER TABLE `invite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_expert`
--

DROP TABLE IF EXISTS `my_expert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_expert` (
  `uid` int(32) unsigned NOT NULL COMMENT '用户uid',
  `eid` int(32) unsigned NOT NULL COMMENT '专家uid',
  `hlptimes` int(32) unsigned NOT NULL COMMENT '给予帮助的次数',
  `badtimes` int(32) unsigned NOT NULL COMMENT '不满意的次数',
  `totalpay` int(32) unsigned NOT NULL COMMENT '累计支付的币数',
  PRIMARY KEY (`uid`,`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_expert`
--

LOCK TABLES `my_expert` WRITE;
/*!40000 ALTER TABLE `my_expert` DISABLE KEYS */;
INSERT INTO `my_expert` VALUES (100000,100003,0,0,0),(100000,100004,0,0,0),(100002,100000,0,0,0),(100003,100000,0,0,0),(100006,100000,0,0,0),(100008,100000,0,0,0);
/*!40000 ALTER TABLE `my_expert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `security`
--

DROP TABLE IF EXISTS `security`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `security` (
  `uid` int(32) unsigned NOT NULL COMMENT '用户id',
  `lastlog` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后登录时间',
  `signed` int(8) unsigned DEFAULT NULL COMMENT '签到',
  `lgip` varchar(32) NOT NULL COMMENT '登录ip',
  `lgsys` varchar(32) NOT NULL COMMENT '登录端系统',
  `lgbrow` varchar(32) NOT NULL COMMENT '浏览器',
  `trust` int(8) NOT NULL COMMENT '设备可信',
  `perm` int(8) NOT NULL COMMENT '权限',
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security`
--

LOCK TABLES `security` WRITE;
/*!40000 ALTER TABLE `security` DISABLE KEYS */;
INSERT INTO `security` VALUES (100000,'2018-07-06 00:41:06',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-06 00:56:14',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-06 01:04:24',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-06 01:36:29',1,'192.168.1.101','Android系统','Chrome',0,0),(100000,'2018-07-06 01:45:43',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-06 03:05:08',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100010,'2018-07-06 03:05:29',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100010,'2018-07-06 03:13:11',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-06 03:15:22',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-06 03:15:58',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-06 03:16:54',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-06 06:23:26',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-06 06:25:43',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-06 06:46:09',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-06 07:53:05',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-06 11:39:25',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 00:08:50',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 00:21:17',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 00:32:55',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 00:35:18',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-07 01:04:20',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 01:27:49',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 01:37:25',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-07 02:08:51',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 02:11:14',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 02:16:52',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 02:17:51',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 02:18:58',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 02:20:22',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 02:31:40',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 03:15:15',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 03:16:00',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 03:23:13',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 03:35:39',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 03:36:42',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 03:38:50',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 03:49:06',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100002,'2018-07-07 03:49:25',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-07 04:21:13',0,'192.168.1.101','Android系统','Chrome',0,0),(100000,'2018-07-07 06:13:57',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-07 06:39:21',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100002,'2018-07-07 06:49:08',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-07-07 07:02:38',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-07 07:05:12',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-07 07:34:51',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 08:09:47',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 09:17:37',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 09:19:01',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 09:24:34',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 12:05:46',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 12:12:24',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 23:26:15',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 23:45:06',1,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-07 23:55:08',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-07 23:55:33',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:00:42',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:01:54',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:03:42',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:05:42',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:09:40',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:12:08',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:17:28',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:21:50',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:32:17',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-08 00:32:44',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:46:08',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:48:30',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-08 23:53:21',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 01:02:56',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 01:25:28',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 02:50:19',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 05:29:54',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 06:32:11',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-09 06:33:48',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 06:38:19',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-09 06:53:17',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-09 06:58:47',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 06:59:21',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 07:00:54',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 07:56:01',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100004,'2018-07-09 07:57:21',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100005,'2018-07-09 07:59:27',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100006,'2018-07-09 08:01:58',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-09 08:04:52',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-09 08:17:01',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 08:43:14',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-09 08:56:14',0,'192.168.1.101','Android系统','Chrome',1,7),(100002,'2018-07-09 09:12:02',1,'124.130.142.80','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-09 09:23:14',0,'124.130.142.80','Android系统','Chrome',0,0),(100000,'2018-07-09 09:28:22',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 09:42:22',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 09:47:07',0,'124.130.142.80','Android系统','Chrome',0,0),(100000,'2018-07-09 10:12:15',0,'124.130.142.80','Android系统','Chrome',0,0),(100000,'2018-07-09 10:14:34',0,'123.151.77.49','Android系统','Chrome',0,0),(100000,'2018-07-09 10:22:49',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 10:24:30',0,'124.130.142.80','Android系统','Chrome',0,0),(100000,'2018-07-09 10:27:48',0,'124.130.142.80','Android系统','Chrome',0,0),(100000,'2018-07-09 10:29:37',0,'124.130.142.80','Android系统','Chrome',0,0),(100000,'2018-07-09 11:07:08',0,'124.130.142.80','Android系统','Chrome',0,0),(100002,'2018-07-09 11:09:39',1,'124.130.142.80','Android系统','Chrome',0,0),(100000,'2018-07-09 11:21:27',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-07-09 11:24:05',1,'124.130.142.80','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-09 12:06:04',0,'123.151.77.49','Android系统','Chrome',0,0),(100000,'2018-07-09 12:13:38',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100002,'2018-07-09 12:41:35',1,'124.130.142.80','Android系统','Chrome',0,0),(100000,'2018-07-09 12:42:17',0,'124.130.142.80','Android系统','Chrome',0,0),(100000,'2018-07-09 12:45:53',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 13:00:52',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 13:25:38',0,'124.130.142.80','Android系统','Chrome',0,0),(100000,'2018-07-09 13:47:00',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 14:23:47',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 15:08:32',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 23:45:04',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 00:18:20',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 00:43:16',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 00:46:04',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 00:48:03',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 00:56:37',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 01:14:14',1,'124.130.142.80','Android系统','Chrome',0,0),(100007,'2018-07-10 01:18:18',1,'124.130.142.80','Android系统','Chrome',0,0),(100007,'2018-07-10 01:36:54',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 01:39:13',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 01:49:26',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 02:06:18',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 06:35:43',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 08:18:02',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 08:48:36',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 08:49:02',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 08:58:40',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 09:04:31',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 09:11:20',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 10:43:51',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 11:44:34',0,'124.130.142.80','Android系统','Chrome',0,0),(100000,'2018-07-10 11:53:17',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 13:05:26',0,'123.151.77.49','Android系统','Chrome',0,0),(100000,'2018-07-10 14:14:01',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 14:30:51',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-10 14:51:18',0,'124.130.142.80','Android系统','Chrome',0,0),(100000,'2018-07-10 14:59:12',0,'124.130.142.80','Android系统','Chrome',0,0),(100000,'2018-07-15 23:56:47',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-15 23:58:20',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 00:01:51',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 00:07:02',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 00:44:56',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 00:52:34',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 00:54:28',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 00:59:40',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 01:04:10',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 01:18:26',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 01:29:29',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 01:52:15',0,'192.168.101.158','Android系统','Chrome',0,0),(100000,'2018-07-16 01:55:40',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-16 01:56:44',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-16 02:00:26',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-16 02:03:31',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-16 02:04:28',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-16 02:05:31',0,'192.168.101.158','Android系统','Chrome',0,0),(100000,'2018-07-16 02:07:05',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-16 02:07:33',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-16 02:14:16',0,'192.168.101.158','Android系统','Chrome',0,0),(100000,'2018-07-16 02:25:21',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 05:22:28',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 05:23:06',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-16 05:27:27',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 05:27:50',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-16 05:28:37',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-16 05:32:15',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-16 05:33:48',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-16 05:35:41',0,'192.168.101.158','Android系统','Chrome',0,0),(100000,'2018-07-16 05:37:57',0,'192.168.101.158','Android系统','Chrome',0,0),(100000,'2018-07-16 05:38:53',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-16 06:23:46',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 06:27:41',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 06:42:28',0,'192.168.101.158','Android系统','Chrome',0,0),(100000,'2018-07-16 06:47:19',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 07:43:32',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 07:48:56',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-16 08:43:09',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-16 08:44:46',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-16 23:26:33',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-17 01:23:01',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-17 02:06:31',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-17 02:20:22',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-17 06:16:51',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-17 07:09:36',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-17 07:22:42',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-17 07:50:48',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-18 00:38:00',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-18 06:00:22',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-18 06:06:20',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-18 07:35:46',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100009,'2018-07-18 07:36:45',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-18 08:12:28',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-19 01:08:35',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-19 03:40:06',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-21 00:57:38',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-21 02:06:42',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-21 02:08:37',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-21 02:10:01',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-21 02:23:17',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-21 02:23:42',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-21 02:33:50',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-21 02:36:27',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-21 02:57:25',0,'192.168.1.103','Android系统','Chrome',1,7),(100000,'2018-07-22 23:33:51',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-22 23:57:10',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-22 23:58:09',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-23 01:22:20',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-23 01:23:18',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-23 23:20:17',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-23 23:24:11',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-23 23:49:29',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-24 00:02:48',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-24 00:12:22',1,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-24 00:27:40',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-24 00:29:48',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-24 00:39:37',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-24 01:03:43',1,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-24 01:24:49',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-24 01:25:36',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-24 01:31:14',1,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-24 01:35:52',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-24 01:36:39',1,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-24 01:41:42',1,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-24 02:18:43',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-24 06:55:35',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-24 07:17:02',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-24 23:38:13',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-25 00:47:02',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-25 01:10:46',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-25 01:23:16',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-25 01:24:31',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-25 01:25:24',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-25 01:27:28',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-25 02:26:46',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-25 02:52:55',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-25 06:34:18',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-25 07:32:52',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-25 07:37:24',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-25 07:44:03',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-25 08:06:40',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-25 23:37:45',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-25 23:50:31',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-26 00:38:17',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-26 00:45:12',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-26 01:43:16',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-26 01:47:19',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-26 02:42:41',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-26 03:40:40',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-26 05:43:11',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-26 05:58:12',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-07-26 06:49:01',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-26 07:02:24',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100004,'2018-07-26 07:25:35',1,'192.168.101.158','Android系统','Chrome',1,7),(100004,'2018-07-26 07:29:35',0,'192.168.101.158','Android系统','Chrome',0,0),(100004,'2018-07-26 07:33:23',0,'192.168.101.158','Android系统','Chrome',0,0),(100003,'2018-07-26 07:35:59',1,'192.168.101.158','Android系统','Chrome',0,0),(100000,'2018-07-26 07:38:59',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-07-26 07:51:25',1,'192.168.101.158','Android系统','Chrome',0,0),(100000,'2018-07-26 08:17:40',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-07-26 08:18:21',1,'192.168.101.158','Android系统','Chrome',0,0),(100000,'2018-07-26 08:22:59',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-07-26 08:23:49',1,'192.168.101.158','Android系统','Chrome',0,0),(100003,'2018-07-26 08:29:22',1,'192.168.101.158','Android系统','Chrome',0,0);
/*!40000 ALTER TABLE `security` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `talkmsg`
--

DROP TABLE IF EXISTS `talkmsg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `talkmsg` (
  `lid` int(32) unsigned NOT NULL COMMENT '小id',
  `bid` int(32) unsigned NOT NULL COMMENT '大id',
  `tdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '发布时间',
  `msg` varchar(256) NOT NULL COMMENT '聊天信息',
  `wthmod` int(4) unsigned NOT NULL COMMENT '所属板块',
  `lrd` int(4) unsigned NOT NULL COMMENT '小id的读取次数',
  `brd` int(4) unsigned NOT NULL COMMENT '大id的读取次数',
  PRIMARY KEY (`lid`,`bid`),
  KEY `date_mod` (`tdate`,`wthmod`),
  KEY `lb_read` (`lrd`,`brd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `talkmsg`
--

LOCK TABLES `talkmsg` WRITE;
/*!40000 ALTER TABLE `talkmsg` DISABLE KEYS */;
INSERT INTO `talkmsg` VALUES (100000,100003,'2018-07-26 07:06:31','你好啊，朋友~',0,0,0);
/*!40000 ALTER TABLE `talkmsg` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-26 16:41:58
