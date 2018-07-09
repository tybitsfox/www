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
INSERT INTO `auth` VALUES (100002,'test1@163.com','test1','260be2fecdf89f88eab77128ef7511d3',7,1,0,2,2,0,'2018-07-03 01:57:20','2018-07-07 03:49:31','/huili/images/upload/893837911.jpg'),(100003,'test2@163.com','test2','8d114dfc0aa6cbd20d74a573b9343e86',7,1,0,2,2,0,'2018-07-03 01:57:21','2018-07-07 07:02:43','/huili/images/upload/002S14P1-2.jpg'),(100004,'test3@163.com','test3','ae71aca395893a68edfae00b2502b2ba',7,1,0,1,1,0,'2018-07-03 01:57:21','2018-07-09 07:57:25','/huili/images/upload/0255004244-0.jpg'),(100005,'test4@163.com','test4','294d6d199b92abdc07e6715956c67831',7,1,0,1,1,0,'2018-07-03 01:57:21','2018-07-09 07:59:31','/huili/images/upload/timg2.jpeg'),(100006,'test5@163.com','test5','c198e96271965c83219549c2d8961a9b',7,1,0,1,1,0,'2018-07-05 13:51:03','2018-07-09 08:02:03','/huili/images/upload/aaa1.jpg'),(100007,'test6@163.com','test6','9c56b932f9aad6427aaa43aea215d83d',7,1,0,0,0,0,'2018-07-05 13:51:03','2018-07-05 13:51:03',NULL),(100008,'test7@163.com','test7','1817399417998612cdca4a671771d60a',7,1,0,0,0,0,'2018-07-05 13:51:03','2018-07-05 13:51:03',NULL),(100009,'test8@163.com','test8','bd969170781556ac46fd26fbd3f15e39',7,1,0,0,0,0,'2018-07-05 13:51:03','2018-07-05 13:51:03',NULL),(100010,'test9@163.com','test9','b081fd85802d5708431149c13c6687f5',7,1,0,0,0,0,'2018-07-05 13:54:56','2018-07-05 13:54:56',NULL),(100001,'tybitsfox@163.com','tybitsfox','2694f8b0e3d3d17ff567c9ca072db75c',7,1,0,0,0,0,'2018-07-03 01:37:49','2018-07-03 01:37:49',NULL),(100000,'tyyyyt@163.com','yong','9a071c40a829eea19b90a5e011d64703',7,1,0,6,6,0,'2018-07-03 01:12:06','2018-07-08 23:53:26','/huili/images/upload/1530578154044_eGGkQlkavi9tiHDWeLn3V6HKANhjZa6Mt3tIyNOLqIymu1530510946644compressflag.jpg');
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
INSERT INTO `choose` VALUES (100000,2,'chlink4','环境监测','/huili/include/home.php?select=ec953999c14b6371ac55241e895de3dc','with-name','icon-flask'),(100000,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100000,15,'chlink17','交流互动','/huili/include/home.php?select=749ab3b68632680660d776891751e812','with-name','icon-cchat'),(100002,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100002,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group');
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
INSERT INTO `expert` VALUES (100002,0,'张三','山东农业大学','18598231668',' ','重金属废水、氨氮废水、垃圾渗滤液处理',25,1),(100003,1,'山东汇力环保科技公司','泰安市长城路1366号','05386541237',' ','环保科技咨询、环保自动连续监测设备运营管理、污染治理设施运营管理、治理环境污染的技术咨询、服务协作、承包，环保治理、监测设备与配件销售、设计，环保治理工程设计、施工、设备安装',7,1),(100004,0,'李四','山东科技大学','12393934',' ','通风专业博导，噪音治理专家',20,1),(100005,1,'山东清源水务有限公司','泰安市南关大街381号','8877694',' ','有丰富的污水处理厂运营经验，擅长处理各类生活污水和工业废水',5,1),(100006,1,'深圳环宇设备仪器公司','深圳市创业大道1988号','4008851299',' ','生产和销售各类分析化验仪器设备，并熟悉河流，水源地，城市空气站的自动运营维护',7,0);
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
INSERT INTO `my_expert` VALUES (100000,100002,0,0,0);
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
INSERT INTO `security` VALUES (100000,'2018-07-06 00:41:06',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-06 00:56:14',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-06 01:04:24',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-06 01:36:29',1,'192.168.1.101','Android系统','Chrome',0,0),(100000,'2018-07-06 01:45:43',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-06 03:05:08',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100010,'2018-07-06 03:05:29',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100010,'2018-07-06 03:13:11',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-06 03:15:22',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-06 03:15:58',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-06 03:16:54',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-06 06:23:26',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-06 06:25:43',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-06 06:46:09',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-06 07:53:05',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-06 11:39:25',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 00:08:50',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 00:21:17',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 00:32:55',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 00:35:18',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-07 01:04:20',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 01:27:49',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 01:37:25',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-07 02:08:51',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 02:11:14',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 02:16:52',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 02:17:51',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 02:18:58',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 02:20:22',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 02:31:40',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 03:15:15',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 03:16:00',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 03:23:13',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 03:35:39',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 03:36:42',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 03:38:50',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 03:49:06',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100002,'2018-07-07 03:49:25',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-07 04:21:13',0,'192.168.1.101','Android系统','Chrome',0,0),(100000,'2018-07-07 06:13:57',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-07 06:39:21',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100002,'2018-07-07 06:49:08',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-07-07 07:02:38',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-07 07:05:12',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-07 07:34:51',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 08:09:47',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 09:17:37',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 09:19:01',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 09:24:34',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 12:05:46',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 12:12:24',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 23:26:15',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-07 23:45:06',1,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-07 23:55:08',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-07 23:55:33',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:00:42',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:01:54',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:03:42',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:05:42',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:09:40',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:12:08',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:17:28',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:21:50',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:32:17',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-08 00:32:44',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:46:08',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-08 00:48:30',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-08 23:53:21',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 01:02:56',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 01:25:28',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 02:50:19',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 05:29:54',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 06:32:11',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-09 06:33:48',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 06:38:19',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-09 06:53:17',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-09 06:58:47',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 06:59:21',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 07:00:54',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 07:56:01',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100004,'2018-07-09 07:57:21',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100005,'2018-07-09 07:59:27',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100006,'2018-07-09 08:01:58',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-09 08:04:52',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-09 08:17:01',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-09 08:43:14',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-07-09 08:56:14',0,'192.168.1.101','Android系统','Chrome',1,7),(100002,'2018-07-09 09:12:02',1,'124.130.142.80','GNU/linux操作系统','Firefox',0,0);
/*!40000 ALTER TABLE `security` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-09 17:19:50
