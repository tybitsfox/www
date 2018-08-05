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
INSERT INTO `auth` VALUES (100002,'test1@163.com','test1','260be2fecdf89f88eab77128ef7511d3',7,1,0,2,2,0,'2018-07-03 01:57:20','2018-07-07 03:49:31','/huili/images/upload/893837911.jpg'),(100003,'test2@163.com','test2','8d114dfc0aa6cbd20d74a573b9343e86',7,1,0,5,5,0,'2018-07-03 01:57:21','2018-08-05 02:04:38','/huili/images/upload/002S14P1-2.jpg'),(100004,'test3@163.com','test3','ae71aca395893a68edfae00b2502b2ba',7,1,0,2,2,0,'2018-07-03 01:57:21','2018-07-26 07:25:42','/huili/images/upload/0255004244-0.jpg'),(100005,'test4@163.com','test4','294d6d199b92abdc07e6715956c67831',7,1,0,1,1,0,'2018-07-03 01:57:21','2018-07-09 07:59:31','/huili/images/upload/timg2.jpeg'),(100006,'test5@163.com','test5','c198e96271965c83219549c2d8961a9b',7,1,0,1,1,0,'2018-07-05 13:51:03','2018-07-09 08:02:03','/huili/images/upload/aaa1.jpg'),(100007,'test6@163.com','test6','9c56b932f9aad6427aaa43aea215d83d',7,1,0,1,1,0,'2018-07-05 13:51:03','2018-07-10 01:18:24','/huili/images/upload/timg3.jpeg'),(100008,'test7@163.com','test7','1817399417998612cdca4a671771d60a',7,1,0,0,0,0,'2018-07-05 13:51:03','2018-07-05 13:51:03',NULL),(100009,'test8@163.com','test8','bd969170781556ac46fd26fbd3f15e39',7,1,0,1,1,0,'2018-07-05 13:51:03','2018-07-18 07:36:51',NULL),(100010,'test9@163.com','test9','b081fd85802d5708431149c13c6687f5',7,1,0,0,0,0,'2018-07-05 13:54:56','2018-07-05 13:54:56',NULL),(100001,'tybitsfox@163.com','tybitsfox','2694f8b0e3d3d17ff567c9ca072db75c',7,1,0,0,0,0,'2018-07-03 01:37:49','2018-07-03 01:37:49',NULL),(100000,'tyyyyt@163.com','田勇','9a071c40a829eea19b90a5e011d64703',7,1,0,23,23,0,'2018-07-03 01:12:06','2018-08-05 02:04:07','/huili/images/upload/worldcup.jpeg');
/*!40000 ALTER TABLE `auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog` (
  `tuid` int(11) NOT NULL AUTO_INCREMENT COMMENT '帖子id',
  `idx` int(8) unsigned NOT NULL COMMENT '模块',
  `title` varchar(256) NOT NULL COMMENT '标题',
  `uname` varchar(32) NOT NULL COMMENT '作者',
  `fintime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '时间',
  `ttext` text NOT NULL COMMENT '内容',
  `uid` int(32) unsigned NOT NULL COMMENT 'uid',
  `isshow` int(4) unsigned NOT NULL COMMENT '显示',
  `isstop` int(4) unsigned NOT NULL COMMENT '置顶',
  `isglob` int(4) unsigned NOT NULL COMMENT '全局',
  PRIMARY KEY (`tuid`),
  KEY `idx_time` (`idx`,`fintime`),
  KEY `uid_show` (`uid`,`isshow`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES (7,1,'summernote测试','田勇','2018-08-04 01:25:20','<p>出体验不错，看看图片</p><p align=\"center\"><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533345605.jpg\"></div></p><h5 align=\"left\"><br></h5><p align=\"left\">图片的位置摆放可使用段落中的各种对齐来指定。</p><p align=\"left\">图片大小的限制目前为2M</p><h6 align=\"left\">图片可上传多张</h6><p><br></p><h3 align=\"left\"><br></h3></p>',100000,1,0,0),(8,1,'环境工程交流','田勇','2018-08-04 12:30:24','<p>欢迎各位环境工程专业的同仁在此交流</p><p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533385774.jpg\"></div></p><p>希望各位在此畅所欲言！</p><p><br></p></p>',100000,1,0,0),(9,1,'祝贺汇氏管家微博上线！','山东汇力环保科技公司','2018-08-04 12:35:09','<h2 align=\"center\"><span style=\"color: rgb(255, 0, 0);\">祝贺！</span></h2><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100003_1533386105.jpg\"></div><br></p>',100003,1,0,1),(10,1,'轻松一刻','田勇','2018-08-04 14:13:01','<p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533391956.jpg\"></div></p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533391972.jpg\"></div><br></p>',100000,1,0,0),(11,1,'继续放图','田勇','2018-08-04 14:14:25','<p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533392015.png\"></div></p><p>这是我喜欢的几张壁纸,hehe</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533392061.jpg\"></div><br></p><p><br></p>',100000,1,0,0),(12,1,'写点什么吧','田勇','2018-08-04 14:18:31','<h3 align=\"center\">央行终于出手稳汇率！人民币强势收复7大关口</h3><p>“跌跌不休”的在岸人民币兑美元汇率8月3日跌穿6.9，连跌9周，创下13个月新低……眼见着要突破7之时，央行终于出手了！</p><p><a href=\"http://money.163.com/keywords/5/2/592e884c/1.html\" title=\"央行\" target=\"_blank\">央行</a>决定——自2018年8月6日起，将远期售汇业务的<a href=\"http://money.163.com/keywords/5/1/59166c47/1.html\" title=\"外汇\" target=\"_blank\">外汇</a>风险准备金率从0调整为20%。<a href=\"http://money.163.com/baike/renminbihuilv/\" title=\"财经知识_人民币汇率\" target=\"_blank\">人民币汇率</a>闻风而动，截至券商中国记者发稿，在岸人民币报收6.8273，离岸人民币报收6.8447，强势收复7大关口，而8月3日，在岸人民币曾一度逼近6.90，离岸达到6.91。欧元、英镑触及日内高点，美元指数下挫。</p><p>8月3日，央行发布公告称，今年以来，外汇市场运行总体平稳，人民币汇率以市场供求为基础，有贬有升，弹性明显增强，市场预期基本稳定，跨境资本流动和外汇供求也大体平衡。近期受贸易摩擦和国际汇市变化等因素影响，外汇市场出现了一些顺周期波动的迹象。</p><p>为防范宏观金融风险，促进金融机构稳健经营，加强宏观审慎管理，决定自2018年8月6日起，将远期售汇业务的外汇风险准备金率从0调整为20%。</p>',100000,1,0,0),(13,1,'summernote使用帮助--写好图文并茂的利器','田勇','2018-08-04 14:31:08','<p>summernote是一款由js编写的支持bootstrap框架的开源富文本编辑器，小巧但功能完善。汇氏环境的博文编辑工具就是这款编辑器的实际应用。</p><p>她支持多表格、图片的插入，可设置字体颜色及字号，可进行简单的段落设置。并且图片及表格也能通过段落设置来调整其位置。对于一般的博文</p><p>编写该编辑器完全可以胜任。</p><p><span style=\"color: rgb(255, 0, 0);\">需要注意的是上传的图片限制在3M大小以内。</span> </p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533393063.30\"></div><br></p>',100000,1,0,1),(14,1,'放图测试中.....','田勇','2018-08-04 14:34:16','<p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533393253.jpg\"></div><br></p>',100000,1,0,0),(15,1,'表格测试','田勇','2018-08-04 14:36:16','<p align=\"center\"><br></p><h4 align=\"center\">统计表A_01<br></h4><table class=\"table table-bordered\"><tbody><tr><td align=\"center\">姓名<br></td><td align=\"center\">性别<br></td><td align=\"center\">年龄<br></td></tr><tr><td align=\"center\">张三<br></td><td align=\"center\">男<br></td><td align=\"center\">28<br></td></tr></tbody></table><p><br></p>',100000,1,0,0),(16,1,'继续测试中.........','田勇','2018-08-04 14:37:17','<p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533393434.jpg\"></div><br></p>',100000,1,0,0),(17,1,'测试翻页','田勇','2018-08-04 14:37:57','<p>应该翻页了吧</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533393476.jpg\"></div><br></p>',100000,1,0,0),(18,1,'翻翻翻','田勇','2018-08-04 14:39:18','<p>翻页有错误...</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533393555.jpg\"></div><br></p>',100000,1,0,0),(19,1,'翻页错误修正！','田勇','2018-08-04 15:24:15','<p>吼吼～～～可以随意的发博文了</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533396253.jpg\"></div><br></p>',100000,1,0,0),(20,1,'测试基本完成，发帖走人','田勇','2018-08-05 02:02:30','<p>准备开始新模块的实现，哈哈，最起码有8个模块都采用这一统一的代码实现，简单了很多 ;)</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533434548.jpg\"></div><br></p>',100000,1,0,0),(21,2,'这是环境专栏的博文','田勇','2018-08-05 12:26:43','<p>赞一个！</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533471999.jpg\"></div><br></p>',100000,1,0,1),(22,2,'发个大表格测试一下','田勇','2018-08-05 12:29:43','<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>ss<br></td><td>dd<br></td><td>ff<br></td><td>gg<br></td><td>hh<br></td><td>hj<br></td></tr><tr><td>asdfsdf<br></td><td>asdfasdf<br></td><td>asdfasdfasdfkja sdfl sdflks sdfl sdf sdflk<br></td><td>asdfasdfasdflkjasd sdfs flkjasdf<br></td><td>asdfadf<br></td><td>asdfasdf<br></td></tr></tbody></table><p><br></p>',100000,1,0,0);
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
INSERT INTO `choose` VALUES (100000,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100000,1,'chlink3','环境工程','/huili/include/home.php?select=5cd4814c281bf77cf5272797d9743cf7','with-name','icon-truck'),(100000,2,'chlink4','环境监测','/huili/include/home.php?select=ec953999c14b6371ac55241e895de3dc','with-name','icon-flask'),(100000,3,'chlink5','项目验收','/huili/include/home.php?select=58bd73629d7fa3ffdfbca05db2c0be7d','with-name','icon-pagelines'),(100000,4,'chlink6','清洁生产','/huili/include/home.php?select=5f7139796ec94c73d53e6886885ed21b','with-name','icon-recycle'),(100000,5,'chlink7','危废服务','/huili/include/home.php?select=a54ee8242567c420ac10b19fcbd24cc8','with-name','icon-fire'),(100000,6,'chlink8','应急预案','/huili/include/home.php?select=6b19163b5cd4ae474189d882049cd83d','with-name','icon-calendar-check-o'),(100000,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100000,15,'chlink17','交流互动','/huili/include/home.php?select=749ab3b68632680660d776891751e812','with-name','icon-cchat'),(100002,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100002,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100003,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100003,1,'chlink3','环境工程','/huili/include/home.php?select=5cd4814c281bf77cf5272797d9743cf7','with-name','icon-truck'),(100003,12,'chlink14','资料下载','/huili/include/home.php?select=f3f7bacf6f435e7aa6391b1d9e2846b4','with-name','icon-download'),(100003,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100004,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100004,1,'chlink3','环境工程','/huili/include/home.php?select=5cd4814c281bf77cf5272797d9743cf7','with-name','icon-truck'),(100009,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100009,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100009,14,'chlink16','监控平台','/huili/include/home.php?select=03142410d7285f00e4363e005783c83a','with-name','icon-desktop');
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
INSERT INTO `security` VALUES (100000,'2018-08-02 00:59:51',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-08-02 01:08:15',1,'192.168.101.158','Android系统','Chrome',0,0),(100003,'2018-08-02 01:11:30',1,'192.168.101.158','Android系统','Chrome',0,0),(100003,'2018-08-02 02:46:29',1,'192.168.101.158','Android系统','Chrome',0,0),(100000,'2018-08-02 02:49:34',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 02:53:16',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 02:54:25',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:01:16',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:02:08',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:09:43',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:11:15',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:41:34',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:45:12',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:48:15',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 05:02:43',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 05:29:45',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 05:31:14',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 05:41:18',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 05:56:17',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 11:26:04',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 12:10:37',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 12:19:11',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 12:24:09',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 12:29:13',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 13:52:43',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 14:13:25',1,'192.168.1.102','Android系统','Chrome',0,0),(100000,'2018-08-04 01:18:17',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 01:48:37',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 02:39:35',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 06:15:56',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 06:17:59',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 07:30:19',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 07:34:01',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 12:24:15',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-08-04 12:31:41',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 12:36:25',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-04 12:41:44',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-08-04 12:44:55',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 14:11:42',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-04 14:42:15',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 14:50:28',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 15:28:30',0,'192.168.1.101','Android系统','Chrome',0,0),(100000,'2018-08-05 00:42:11',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 01:07:31',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-08-05 01:10:24',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 01:11:00',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-05 01:18:35',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-08-05 02:04:26',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 02:06:21',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-05 02:16:52',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 02:32:21',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 02:36:30',0,'192.168.1.101','Android系统','Chrome',0,0),(100000,'2018-08-05 11:36:09',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 11:39:03',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 11:52:27',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 11:57:47',0,'localhost','GNU/linux操作系统','Firefox',1,7);
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
  `wmsg` int(4) unsigned NOT NULL COMMENT '本条信息的发布者',
  `lrd` int(8) unsigned NOT NULL COMMENT '小id的读取次数',
  `brd` int(8) unsigned NOT NULL COMMENT '大id的读取次数',
  PRIMARY KEY (`lid`,`bid`,`tdate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `talkmsg`
--

LOCK TABLES `talkmsg` WRITE;
/*!40000 ALTER TABLE `talkmsg` DISABLE KEYS */;
INSERT INTO `talkmsg` VALUES (100000,100003,'2018-07-27 02:02:50','你好，在吗？',0,0,1,0),(100000,100003,'2018-07-27 02:04:50','有事吗？请说',0,1,0,1),(100000,100003,'2018-07-27 02:05:27','有个问题想请教您',0,0,1,0),(100000,100003,'2018-07-27 02:36:47','请说',0,1,0,1),(100000,100003,'2018-07-27 02:38:14','山东省泰安市环境保护局监测站生态监测科田勇',0,1,0,1),(100000,100003,'2018-07-27 03:14:48','关于环评方面的问题请教下',0,0,1,0),(100000,100003,'2018-08-04 12:25:39','你好！有个问题想请教',1,0,18,9),(100000,100003,'2018-08-04 12:32:21','有什么问题？请说吧',1,1,15,10),(100000,100003,'2018-08-04 12:38:28','你们是否承接污水处理设施的运营管理呢？我们的污水处理设施想委托运营。',1,0,16,7),(100000,100003,'2018-08-05 02:03:57','你们具备相关资质吗？',1,0,6,1),(100000,100003,'2018-08-05 02:05:57','有的，我们有污水处理设施甲级运营资质的，并且我们很愿意和您就这个问题进行详谈。',1,1,4,2);
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

-- Dump completed on 2018-08-05 20:40:16
