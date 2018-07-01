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
  PRIMARY KEY (`email`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth`
--

LOCK TABLES `auth` WRITE;
/*!40000 ALTER TABLE `auth` DISABLE KEYS */;
INSERT INTO `auth` VALUES (100002,'test1@163.com','test1','260be2fecdf89f88eab77128ef7511d3',7,1,0,0,0,0,'2018-06-30 14:42:41','2018-06-30 14:42:41'),(100003,'test2@163.com','test2','8d114dfc0aa6cbd20d74a573b9343e86',7,1,0,0,0,0,'2018-06-30 14:42:41','2018-06-30 14:42:41'),(100004,'test3@163.com','test3','ae71aca395893a68edfae00b2502b2ba',7,1,0,0,0,0,'2018-06-30 14:42:41','2018-06-30 14:42:41'),(100005,'test4@163.com','test4','294d6d199b92abdc07e6715956c67831',7,1,0,0,0,0,'2018-06-30 14:42:41','2018-06-30 14:42:41'),(100001,'tybitsfox@126.com','tybitsfox','471d6ebc35015802fa80ad8d4ebb9d57',7,1,0,199,199,3,'2018-06-24 12:31:16','2018-06-26 04:32:23'),(100000,'tyyyyt@163.com','tian','2694f8b0e3d3d17ff567c9ca072db75c',7,2,0,104,104,3,'2018-06-24 10:17:35','2018-07-01 12:14:05');
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
INSERT INTO `choose` VALUES (100000,3,'chlink5','项目验收','/huili/include/home.php?select=58bd73629d7fa3ffdfbca05db2c0be7d','with-name','icon-pagelines'),(100000,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100000,14,'chlink16','监控平台','/huili/include/home.php?select=03142410d7285f00e4363e005783c83a','with-name','icon-desktop'),(100000,15,'chlink17','交流互动','/huili/include/home.php?select=749ab3b68632680660d776891751e812','with-name','icon-cchat'),(100001,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100001,8,'chlink10','企业名录','/huili/include/home.php?select=f7b9c1d04ceffa29cc51a3fef6765dad','with-name','icon-book'),(100001,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100001,14,'chlink16','监控平台','/huili/include/home.php?select=03142410d7285f00e4363e005783c83a','with-name','icon-desktop'),(100001,15,'chlink17','交流互动','/huili/include/home.php?select=749ab3b68632680660d776891751e812','with-name','icon-cchat');
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
INSERT INTO `company` VALUES (100000,'汇力环保公司','/huili/images/upload/b_028939121CF7F801.jpg',' ',9,'asdfqwerert','泰安市长城路1366号','12393934',0);
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
  `uid` int(32) unsigned NOT NULL COMMENT '用户ID',
  `comp` varchar(48) NOT NULL COMMENT '单位',
  `phone` varchar(12) NOT NULL COMMENT '电话',
  `major` varchar(32) NOT NULL COMMENT '所属专业',
  `intro` varchar(128) NOT NULL COMMENT '个人简介',
  `img` varchar(128) NOT NULL COMMENT '照片连接',
  `name` varchar(12) NOT NULL COMMENT '姓名',
  `mid` int(8) unsigned NOT NULL COMMENT '专业id',
  `confirmed` int(4) unsigned NOT NULL COMMENT '认证标志',
  PRIMARY KEY (`uid`),
  KEY `mid_name` (`mid`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expert`
--

LOCK TABLES `expert` WRITE;
/*!40000 ALTER TABLE `expert` DISABLE KEYS */;
INSERT INTO `expert` VALUES (100000,'泰安市环境保护局','15163813199',' ','男子合同期满前被辞退 竟发现单位8年未缴社保','/huili/images/upload/b_429D088E4A1B5497.jpg','田勇',11,0);
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
  `mname` varchar(16) NOT NULL COMMENT '模块名称',
  `mlink` varchar(128) NOT NULL COMMENT '模块链接',
  `micon` varchar(128) NOT NULL COMMENT '模块图标',
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fixedmod`
--

LOCK TABLES `fixedmod` WRITE;
/*!40000 ALTER TABLE `fixedmod` DISABLE KEYS */;
INSERT INTO `fixedmod` VALUES (1,'环评咨询','/huili/include/home.php','icon-gear'),(2,'环境工程','/huili/include/home.php','icon-truck'),(4,'环境监测','/huili/include/home.php','icon-flask'),(8,'项目验收','/huili/include/home.php','icon-pagelines'),(16,'清洁生产','/huili/include/home.php','icon-recycle'),(32,'危废服务','/huili/include/home.php','icon-fire'),(64,'应急预案','/huili/include/home.php','icon-calendar-check-o'),(128,'排污申报','/huili/include/home.php','icon-pencil'),(256,'企业名录','/huili/include/home.php','icon-book'),(512,'环境案例','/huili/include/home.php','icon-snapchat-ghost'),(1024,'技术动态','/huili/include/home.php','icon-joomla'),(2048,'环境法规','/huili/include/home.php','icon-wpforms'),(4096,'资料下载','/huili/include/home.php','icon-download'),(8192,'专家团队','/huili/include/home.php','icon-group'),(16384,'监控平台','/huili/include/home.php','icon-desktop'),(32768,'交流互动','/huili/include/home.php','icon-cchat');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invite`
--

LOCK TABLES `invite` WRITE;
/*!40000 ALTER TABLE `invite` DISABLE KEYS */;
INSERT INTO `invite` VALUES (2,100000,'bitsfox@126.com','welcome to visit huishi group!',0),(1,100000,'tybitsfox@126.com','hello world',0),(3,100000,'tyyyyt@163.com','欢迎加入',1);
/*!40000 ALTER TABLE `invite` ENABLE KEYS */;
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
INSERT INTO `security` VALUES (100000,'2018-06-27 00:33:51',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-27 00:48:04',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-27 01:20:02',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-27 01:25:46',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-27 01:43:45',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-27 01:47:37',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-27 02:42:37',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-28 10:41:42',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-28 10:46:17',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-28 11:48:46',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-28 11:53:52',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-28 11:59:14',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-28 12:03:02',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-28 12:05:54',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-06-28 12:07:27',0,'192.168.1.101','Android系统','Chrome',1,7),(100000,'2018-06-28 12:15:31',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-28 12:37:38',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 00:51:22',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 01:30:26',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 01:31:23',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 01:40:09',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 01:40:47',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 01:41:29',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 01:42:28',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 01:44:57',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 01:46:19',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 02:58:09',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 03:01:27',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 05:37:23',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 05:42:44',0,'192.168.101.158','Android系统','Chrome',0,0),(100000,'2018-06-29 05:44:27',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-06-29 06:19:41',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 06:36:37',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-06-29 07:41:06',0,'192.168.101.158','Android系统','Chrome',1,7),(100000,'2018-06-29 07:41:55',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 10:19:44',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 10:21:44',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 10:43:20',0,'192.168.1.102','Android系统','Chrome',1,7),(100000,'2018-06-29 10:58:16',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 10:59:28',0,'192.168.1.102','Android系统','Chrome',1,7),(100000,'2018-06-29 11:16:59',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 11:19:14',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 11:19:58',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 11:40:46',0,'192.168.1.102','Android系统','Chrome',1,7),(100000,'2018-06-29 11:43:25',0,'192.168.1.102','Android系统','Chrome',1,7),(100000,'2018-06-29 11:47:38',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 11:48:11',0,'192.168.1.102','Android系统','Chrome',1,7),(100000,'2018-06-29 11:56:43',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 12:16:28',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 12:41:17',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 12:48:37',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 13:02:05',0,'192.168.1.102','Android系统','Chrome',1,7),(100000,'2018-06-29 13:03:53',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 13:48:07',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 13:50:35',0,'192.168.1.102','Android系统','Chrome',1,7),(100000,'2018-06-29 13:52:44',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 14:07:29',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 14:13:32',0,'192.168.1.102','Android系统','Chrome',1,7),(100000,'2018-06-29 14:14:05',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 15:02:27',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 15:13:05',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-29 15:38:46',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-30 01:03:12',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-30 01:08:06',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-30 01:09:22',1,'192.168.1.102','Android系统','Chrome',1,7),(100000,'2018-06-30 08:29:21',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-30 08:33:41',0,'192.168.1.102','Android系统','Chrome',1,7),(100000,'2018-06-30 09:32:14',0,'192.168.1.102','Android系统','Chrome',1,7),(100000,'2018-06-30 09:38:57',0,'192.168.1.102','Android系统','Chrome',1,7),(100000,'2018-06-30 10:05:56',0,'192.168.1.102','Android系统','Chrome',1,7),(100000,'2018-06-30 10:08:06',0,'192.168.1.102','Android系统','Chrome',1,7),(100000,'2018-06-30 10:09:00',0,'192.168.1.102','Android系统','Chrome',1,7),(100000,'2018-06-30 10:12:07',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-30 13:08:54',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-30 13:30:05',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100002,'2018-06-30 14:43:42',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-06-30 14:54:00',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-07-01 00:35:38',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 01:11:28',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 01:15:56',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 01:16:58',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 01:19:54',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 01:45:31',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 01:46:26',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 01:52:29',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 02:13:20',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 02:14:16',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 02:17:25',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 02:18:08',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 02:22:09',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 02:25:20',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 02:34:13',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 02:43:22',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 08:42:46',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 11:44:54',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 11:54:43',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 11:57:37',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 11:59:17',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 12:02:12',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 12:10:20',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-07-01 12:13:49',1,'192.168.1.102','Android系统','Chrome',1,7),(100000,'2018-07-01 12:16:52',0,'192.168.1.101','Android系统','Chrome',0,0);
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

-- Dump completed on 2018-07-01 20:23:56
