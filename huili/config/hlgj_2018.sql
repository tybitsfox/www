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
INSERT INTO `auth` VALUES (100002,'test1@163.com','test1','260be2fecdf89f88eab77128ef7511d3',7,1,0,2,2,0,'2018-07-03 01:57:20','2018-07-07 03:49:31','/huili/images/upload/893837911.jpg'),(100003,'test2@163.com','test2','8d114dfc0aa6cbd20d74a573b9343e86',7,1,0,5,5,0,'2018-07-03 01:57:21','2018-08-05 02:04:38','/huili/images/upload/002S14P1-2.jpg'),(100004,'test3@163.com','test3','ae71aca395893a68edfae00b2502b2ba',7,1,0,2,2,0,'2018-07-03 01:57:21','2018-07-26 07:25:42','/huili/images/upload/0255004244-0.jpg'),(100005,'test4@163.com','test4','294d6d199b92abdc07e6715956c67831',7,1,0,1,1,0,'2018-07-03 01:57:21','2018-07-09 07:59:31','/huili/images/upload/timg2.jpeg'),(100006,'test5@163.com','test5','c198e96271965c83219549c2d8961a9b',7,1,0,1,1,0,'2018-07-05 13:51:03','2018-07-09 08:02:03','/huili/images/upload/aaa1.jpg'),(100007,'test6@163.com','test6','9c56b932f9aad6427aaa43aea215d83d',7,1,0,1,1,0,'2018-07-05 13:51:03','2018-07-10 01:18:24','/huili/images/upload/timg3.jpeg'),(100008,'test7@163.com','test7','1817399417998612cdca4a671771d60a',7,1,0,0,0,0,'2018-07-05 13:51:03','2018-07-05 13:51:03',NULL),(100009,'test8@163.com','test8','bd969170781556ac46fd26fbd3f15e39',7,1,0,1,1,0,'2018-07-05 13:51:03','2018-07-18 07:36:51',NULL),(100010,'test9@163.com','test9','b081fd85802d5708431149c13c6687f5',7,1,0,0,0,0,'2018-07-05 13:54:56','2018-07-05 13:54:56',NULL),(100001,'tybitsfox@163.com','tybitsfox','2694f8b0e3d3d17ff567c9ca072db75c',7,1,0,0,0,0,'2018-07-03 01:37:49','2018-07-03 01:37:49',NULL),(100000,'tyyyyt@163.com','田勇','9a071c40a829eea19b90a5e011d64703',7,1,0,28,28,0,'2018-07-03 01:12:06','2018-08-21 23:53:25','/huili/images/upload/worldcup.jpeg');
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES (7,1,'summernote测试','田勇','2018-08-04 01:25:20','<p>出体验不错，看看图片</p><p align=\"center\"><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533345605.jpg\"></div></p><h5 align=\"left\"><br></h5><p align=\"left\">图片的位置摆放可使用段落中的各种对齐来指定。</p><p align=\"left\">图片大小的限制目前为2M</p><h6 align=\"left\">图片可上传多张</h6><p><br></p><h3 align=\"left\"><br></h3></p>',100000,1,0,0),(8,1,'环境工程交流','田勇','2018-08-04 12:30:24','<p>欢迎各位环境工程专业的同仁在此交流</p><p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533385774.jpg\"></div></p><p>希望各位在此畅所欲言！</p><p><br></p></p>',100000,1,0,0),(9,1,'祝贺汇氏管家微博上线！','山东汇力环保科技公司','2018-08-04 12:35:09','<h2 align=\"center\"><span style=\"color: rgb(255, 0, 0);\">祝贺！</span></h2><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100003_1533386105.jpg\"></div><br></p>',100003,1,0,1),(10,1,'轻松一刻','田勇','2018-08-04 14:13:01','<p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533391956.jpg\"></div></p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533391972.jpg\"></div><br></p>',100000,1,0,0),(11,1,'继续放图','田勇','2018-08-04 14:14:25','<p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533392015.png\"></div></p><p>这是我喜欢的几张壁纸,hehe</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533392061.jpg\"></div><br></p><p><br></p>',100000,1,0,0),(12,1,'写点什么吧','田勇','2018-08-04 14:18:31','<h3 align=\"center\">央行终于出手稳汇率！人民币强势收复7大关口</h3><p>“跌跌不休”的在岸人民币兑美元汇率8月3日跌穿6.9，连跌9周，创下13个月新低……眼见着要突破7之时，央行终于出手了！</p><p><a href=\"http://money.163.com/keywords/5/2/592e884c/1.html\" title=\"央行\" target=\"_blank\">央行</a>决定——自2018年8月6日起，将远期售汇业务的<a href=\"http://money.163.com/keywords/5/1/59166c47/1.html\" title=\"外汇\" target=\"_blank\">外汇</a>风险准备金率从0调整为20%。<a href=\"http://money.163.com/baike/renminbihuilv/\" title=\"财经知识_人民币汇率\" target=\"_blank\">人民币汇率</a>闻风而动，截至券商中国记者发稿，在岸人民币报收6.8273，离岸人民币报收6.8447，强势收复7大关口，而8月3日，在岸人民币曾一度逼近6.90，离岸达到6.91。欧元、英镑触及日内高点，美元指数下挫。</p><p>8月3日，央行发布公告称，今年以来，外汇市场运行总体平稳，人民币汇率以市场供求为基础，有贬有升，弹性明显增强，市场预期基本稳定，跨境资本流动和外汇供求也大体平衡。近期受贸易摩擦和国际汇市变化等因素影响，外汇市场出现了一些顺周期波动的迹象。</p><p>为防范宏观金融风险，促进金融机构稳健经营，加强宏观审慎管理，决定自2018年8月6日起，将远期售汇业务的外汇风险准备金率从0调整为20%。</p>',100000,1,0,0),(13,1,'summernote使用帮助--写好图文并茂的利器','田勇','2018-08-04 14:31:08','<p>summernote是一款由js编写的支持bootstrap框架的开源富文本编辑器，小巧但功能完善。汇氏环境的博文编辑工具就是这款编辑器的实际应用。</p><p>她支持多表格、图片的插入，可设置字体颜色及字号，可进行简单的段落设置。并且图片及表格也能通过段落设置来调整其位置。对于一般的博文</p><p>编写该编辑器完全可以胜任。</p><p><span style=\"color: rgb(255, 0, 0);\">需要注意的是上传的图片限制在3M大小以内。</span> </p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533393063.30\"></div><br></p>',100000,1,0,1),(14,1,'放图测试中.....','田勇','2018-08-04 14:34:16','<p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533393253.jpg\"></div><br></p>',100000,1,0,0),(15,1,'表格测试','田勇','2018-08-04 14:36:16','<p align=\"center\"><br></p><h4 align=\"center\">统计表A_01<br></h4><table class=\"table table-bordered\"><tbody><tr><td align=\"center\">姓名<br></td><td align=\"center\">性别<br></td><td align=\"center\">年龄<br></td></tr><tr><td align=\"center\">张三<br></td><td align=\"center\">男<br></td><td align=\"center\">28<br></td></tr></tbody></table><p><br></p>',100000,1,0,0),(16,1,'继续测试中.........','田勇','2018-08-04 14:37:17','<p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533393434.jpg\"></div><br></p>',100000,1,0,0),(17,1,'测试翻页','田勇','2018-08-04 14:37:57','<p>应该翻页了吧</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533393476.jpg\"></div><br></p>',100000,1,0,0),(18,1,'翻翻翻','田勇','2018-08-04 14:39:18','<p>翻页有错误...</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533393555.jpg\"></div><br></p>',100000,1,0,0),(19,1,'翻页错误修正！','田勇','2018-08-04 15:24:15','<p>吼吼～～～可以随意的发博文了</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533396253.jpg\"></div><br></p>',100000,1,0,0),(20,1,'测试基本完成，发帖走人','田勇','2018-08-05 02:02:30','<p>准备开始新模块的实现，哈哈，最起码有8个模块都采用这一统一的代码实现，简单了很多 ;)</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533434548.jpg\"></div><br></p>',100000,1,0,0),(21,2,'这是环境专栏的博文','田勇','2018-08-05 12:26:43','<p>赞一个！</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533471999.jpg\"></div><br></p>',100000,1,0,1),(22,2,'发个大表格测试一下','田勇','2018-08-05 12:29:43','<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>ss<br></td><td>dd<br></td><td>ff<br></td><td>gg<br></td><td>hh<br></td><td>hj<br></td></tr><tr><td>asdfsdf<br></td><td>asdfasdf<br></td><td>asdfasdfasdfkja sdfl sdflks sdfl sdf sdflk<br></td><td>asdfasdfasdflkjasd sdfs flkjasdf<br></td><td>asdfadf<br></td><td>asdfasdf<br></td></tr></tbody></table><p><br></p>',100000,0,0,0),(23,2,'继续测试表格','田勇','2018-08-05 14:38:49','<h3 align=\"center\">表一</h3><p><br></p><div style=\"width:90%;overflow:auto;margin:auto;\"><table class=\"table table-bordered\"><tbody><tr><td>aa<br></td><td>ss<br></td><td>dd<br></td><td>ff<br></td><td>gg<br></td></tr><tr><td>11<br></td><td>22<br></td><td>33<br></td><td>44<br></td><td>55<br></td></tr></tbody></table></div><p><br></p>',100000,1,0,0),(24,2,'表格三','田勇','2018-08-05 14:41:30','<div align=\"center\">表格三</div><div align=\"center\"><br></div><div style=\"width:90%;overflow:auto;margin:auto;\"><table class=\"table table-bordered\"><tbody><tr><td>aa<br></td><td>ss<br></td><td>dd<br></td><td>ff<br></td><td>gg<br></td></tr><tr><td>asdl asdflkj sdfk sdfadf ksdfkjf as <br></td><td>asdfkj asdf lkj sdf lkjadf lasdfl <br></td><td>asdf kjasdflkjasdf ladf j asdf lk <br></td><td>asdfkj sdf sdflk sdf lksdf lkfsdfl<br></td><td>sdflkj sdflk sdf lkjasdfl lsdf lsdf <br></td></tr></tbody></table></div><div align=\"center\"><br></div><p><br></p>',100000,1,0,0),(25,3,'北京橡胶工业研究设计院有限公司天津分公司设施竣工环保验收','田勇','2018-08-07 00:19:48','<p style=\"text-align: center; line-height: 180%; margin: 0cm 1.25pt 0pt 0cm; mso-para-margin-right: .12gd; mso-pagination: widow-orphan; mso-outline-level: 1\" class=\"MsoNormal\" align=\"center\"><b style=\"mso-bidi-font-weight: normal\"><span style=\"line-height: 180%; font-family: 宋体; font-size: 22pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt\">北京橡胶工业研究设计院有限公司天津分公司研发试验基地项目噪声、固体废物污染防治设施竣工环保验收受理情况公示<span lang=\"EN-US\"></span></span></b></p>\r\n<p style=\"text-align: left; line-height: 22pt; text-indent: 28pt; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan; mso-char-indent-count: 2.0; mso-line-height-rule: exactly\" class=\"MsoNormal\" align=\"left\"><span style=\"font-family: 仿宋_GB2312; font-size: 14pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">天津市环境保护局按照《中华人民共和国环境影响评价法》、《行政许可法》、《信息公开条例》以及相关法规、规章和规定的要求，公示建设项目噪声、固体废物污染防治设施竣工环保验收行政许可受理信息。受理信息公示时限：验收监测（调查）报告自信息发布起<span lang=\"EN-US\">10</span>个工作日。</span><span style=\"font-family: 宋体; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt\" lang=\"EN-US\"></span></p>\r\n<p style=\"text-align: center; line-height: 22pt; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan; mso-line-height-rule: exactly\" class=\"MsoNormal\" align=\"center\"><span style=\"font-family: 仿宋_GB2312; font-size: 14pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">电话：<span lang=\"EN-US\">022-24538909 </span>地址：天津市河东区红星路<span lang=\"EN-US\">79</span>号</span></p><p style=\"text-align: center; line-height: 22pt; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan; mso-line-height-rule: exactly\" class=\"MsoNormal\" align=\"center\"><span style=\"font-family: 仿宋_GB2312; font-size: 14pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\"><br></span></p><div style=\"width:90%;overflow:auto;margin:auto;\"><table class=\"table table-bordered\"><tbody><tr><td><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">项目名称</span></td><td><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">建设单位</span></td><td><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">验收监测（调查）单位</span></td><td><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">建设地点</span></td><td><p style=\"text-align: center; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan\" class=\"MsoNormal\" align=\"center\"><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">受理<span lang=\"EN-US\"></span></span></p>\r\n            <p style=\"text-align: center; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan\" class=\"MsoNormal\" align=\"center\"><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">日期</span></p></td><td><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">监测（验收调查）报告全本（除涉及国家秘密和商业秘密等内容外）</span></td><td><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">公示日期</span></td></tr><tr><td><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">天津分公司研发试验基地项目</span></td><td><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">北京橡胶工业研究设计院有限公司</span></td><td><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">天津世海质环境科技发展有限公司</span></td><td><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">天津宝坻经济开发区</span></td><td><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\" lang=\"EN-US\">2018</span><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">年<span lang=\"EN-US\">6</span>月<span lang=\"EN-US\">22</span>日</span></td><td><p style=\"text-align: center; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan\" class=\"MsoNormal\" align=\"center\"><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">监测报告</span><span style=\"font-family: 宋体; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt\" lang=\"EN-US\"></span></p>\r\n            <p style=\"text-align: center; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan\" class=\"MsoNormal\" align=\"center\"><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">全本链接</span></p></td><td><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\" lang=\"EN-US\">2018</span><span style=\"font-family: 仿宋_GB2312; font-size: 12pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\">年<span lang=\"EN-US\">6</span>月<span lang=\"EN-US\">22</span>日—<span lang=\"EN-US\">2018</span>年<span lang=\"EN-US\">7</span>月<span style=\"color: black\" lang=\"EN-US\">5</span>日</span></td></tr></tbody></table></div><p style=\"text-align: center; line-height: 22pt; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan; mso-line-height-rule: exactly\" class=\"MsoNormal\" align=\"center\"><span style=\"font-family: 仿宋_GB2312; font-size: 14pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\"><br></span></p><p style=\"text-align: center; line-height: 22pt; margin: 0cm 0cm 0pt; mso-pagination: widow-orphan; mso-line-height-rule: exactly\" class=\"MsoNormal\" align=\"center\"><span style=\"font-family: 仿宋_GB2312; font-size: 14pt; mso-bidi-font-family: 宋体; mso-font-kerning: 0pt; mso-hansi-font-family: 宋体\"><br></span></p>',100000,1,0,0),(26,4,'清洁生产和ISO14000环境管理体系标准的不同点','田勇','2018-08-07 00:27:09','<h2 style=\"   text-align: center;\"><span style=\"color: rgb(255, 0, 0);\">清洁生产和ISO14000环境管理体系标准的不同点</span></h2><p style=\"text-align: left;\">1、依据不同<br>&nbsp;&nbsp;&nbsp; \r\n清洁生产的依据是全国人大通过的《中华人民共和国清洁生产促进法》以及相配套的条例、规定，如《情况生产审核暂行办法》、《国务院办公厅转发改委等部门“关于加快推行情况生产意见”的通知》以及一系列的清洁生产技术指南、导则等。相关企业、单位、组织必修严格执行，违法违规的行为将受到法律的惩处；对表现好的行为进行鼓励、倡导，推行清洁生产的程度没有绝对的统一标准，没有一个定量的数值界定。<br>&nbsp;&nbsp;&nbsp;\r\n \r\n环境管理体系标准的依据是国际标准化组织制定的ISO14000环境管理体系标准，ISO14001标准是全球性的维护环境管理的公认的国际标准，它是一个环境管理工具，是一个环境管理的参照物。对世界各国而言，它没有统一的定量要求，没有统一的污染物排放的数值标准。即各个国家污染物排放的数值有高有低，也可以通过ISO14001的认证；但对某一个国家而言，它要求各企业、单位、组织要符合所在国的环保法规，符合其污染物的排放标准和环境质量标准，也就有了定量的数值限制。ISO14000业已完全转化为中国的国标GB/T\r\n 24000《环境管理体系标准》，成为我国进行环境管理体系标准认证的依据。<br>&nbsp;&nbsp;&nbsp; 2、内容不同<br>&nbsp;&nbsp;&nbsp; \r\n清洁生产的内容有改进设计、选用清洁的原料和能源、采用先进的工艺技术与设备、综合利用、改善管理。这里提到的管理是生产过程的管理，清洁生产的主要内容是涵盖原料、能源、工艺、产品的清洁生产技术，实施清洁生产战略的核心是让企业采用清洁生产技术替代相对落后的工艺技术，以体现清洁生产技术的设备改造老装置、建设新装置，使生产可持续发展，使经济发展与环境保护相协调。清洁生产是从源头消减污染物的产生量，即最大限度地在生产过程中消减污染物的产生，而不是产生污染物后再被动地治理。因此，清洁生产与末端治理是两个不同的概念，清洁生产理论不包括末端治理的内容。<br>&nbsp;&nbsp;&nbsp;\r\n \r\nISO14000的内容是环境管理。从废水、废气、废渣、噪声等环境因素出发，采用废水处理厂、废气净化装置、固体废物填埋场、危险废物焚烧炉等末端处理设施，分解、降解污染物，使废物在浓度和总量两个方面符合国家排放标准，使之对环境无害化。环境管理是对废物处理设施运行的管理，是对生产的环境场地的管理。一般来说，不涉及生产工艺技术路线及其与污染物的关系。<br>&nbsp;&nbsp;&nbsp; 3、实施手段不同<br>&nbsp;&nbsp;&nbsp;\r\n \r\n实施清洁生产的方法是进行清洁生产审核，是指按照一定的程序，对生产和服务过程进行调查和诊断，找出能耗高、物耗高、污染重的原因，提出减少有毒有害物料的使用、产生，降低能耗、物耗及废物产生的方案的过程。清洁生产审核程序原则上包括审核准备、预审核、审核、实施方案的产生、筛选和确定，编写清洁生产审核报告。清洁生产审核的程序提供了一个原则的思路和大致的步骤，企业可以灵活运用。清洁生产审核以企业自行组织开展为主，充分发挥企业员工的自主性、积极性，也可以聘请行业专家和清洁生产专家协助开展，一切视企业自身能力而定。<br>&nbsp;&nbsp;&nbsp;\r\n \r\n在ISO14000标准实施过程中，主要依靠邀请具有国家咨询资质的第三方来建立环境管理体系，然后再聘请具有国家认证资质的另一个第三方进行认证，合格者将发给通过ISO14001认证的证明文书。它只看结果而不考虑手段，只要达到环境管理的目的，即使采取末端治理手段，花费不尽完全合理的巨大资金建设废物处理装置也可以。认证过程不能涉及工艺技术，这在外国公司中是不成文的规则。<br>&nbsp;&nbsp;&nbsp; 4、主力军不同<br>&nbsp;&nbsp;&nbsp; 企业开展清洁生产审核、实施清洁生产的主力军是本企业的技术人员、领导者及全体职工，随着时间的推移，工程技术人员将起到越来越重要的作用。清洁生产成套技术的开发和应用要依靠国家、企业、民间的专门研究机构的科研人员、设备制造人员、工程设计人员和施工人员。<br>&nbsp;&nbsp;&nbsp; ISO14000环境管理体系标准的建立，一般是聘请社会上已取得资质的ISO14000专门咨询机构指导、帮助建立；环境管理体系的建立、运行、监测，最终的取证，必须要由取得资质的ISO14000专门认证机构来评价、授予。<br>&nbsp;&nbsp;&nbsp; 5、管理者不同<br>&nbsp;&nbsp;&nbsp;\r\n \r\n《中华人民共和国清洁生产促进法》明确规定，全国清洁生产的组织者是国家经济和贸易的管理机关，即国家发展和改革委员会。其他与清洁生产有直接紧密关系的政府部门是环保部门、科技部门，环保部门负责全国的环保管理监督工作，最熟悉、了解各企业、单位的污染物排放情况，掌握各单位的污染物数据；科技部门负责全国的技术开发工作，他们担负着推行清洁生产的重要任务，他们应该理解、实践、贯彻清洁生产理论，在推行清洁生产中负起重大责任。与清洁生产间接关系的是教育部门、农林部门、水利部门、投资、财务、税收、商务部门等，在各自的职能部门中推行清洁生产。国务院的各部门都要参与清洁生产的工作，这是由清洁生产的内涵所决定的。<br>&nbsp;&nbsp;&nbsp;\r\n \r\n国家质量技术监督检验检疫总局是我国与国际标准化组织的对口政府部门，国家环境保护部是环保业务的主管部门，因此，ISO14000的管理者是国家质量技术监督检验检疫总局和国家环境保护部二者联合办公，轮流执政。他们负责ISO14000体系标准的咨询、认证单位的人员培训、资质确认的工作。其他政府部门皆不参与，这与ISO14000单纯的环保内容相吻合。企业的认证工作全靠市场调节，企业认证与否取决于企业本身的意愿，聘请哪一个公司来认证也由企业自由选取。<br>&nbsp;&nbsp;&nbsp; 6、实施效果不同<br>&nbsp;&nbsp;&nbsp; 众多的实例已经证明，采用清洁生产所产生的效果是多方面的：环境效益、经济效益、社会效益、生产过程管理的改善和全体员工的环境意识、清洁生产意识、可持续发展意识的提高。<br>&nbsp;&nbsp;&nbsp;\r\n \r\n取得ISO14001认证的效果有环境效应、环境管理的改善及一定的社会效益，而没有或少有经济效益。取得ISO14001认证的企业，在国际进出口贸易中，如同取得了一张绿色的通行证，有利于克服各种环境的非贸易壁垒。企业内部，环境管理体系虽不能直接指导组织发展决策，也不能确定最佳环保政策，但可以保证组织领导人所制定环保政策的有效实施和保持。<br><span style=\"color: rgb(255, 0, 0);\"></span></p>',100000,1,0,1),(27,5,'危废行业管理和市场分析','田勇','2018-08-10 02:23:38','<p><span><strong>一、行业需求</strong></span></p><p><br></p><p>在环保监管力度增强，各省均推出省级督查方案背景下，危废处置刚需再次提升，尤其是要求进入规范渠道处置的量增加。但市场情况是，实际产生量远大于统计量(披露16年5347万吨，预计实际8000万吨)，低综合利用处置率(83%)，低有效利用率(25%)，导致整体危废的处置供不应求。</p><p><br></p><p><span>危废政策不断出台，尤其是省级细则落地：</span></p><p><br></p><p>1)2017年环保部出台“十三五”全国危险废物规范化管理督查考核工作方案，各省近期均推出省级危废规范化管理督查方案;</p><p><br></p><p>2)《国家危险废物名录》自2016年8月1日起施行;新修订的《固体废物污染环境防治法》取消危险废物省内转移审批手续;</p><p><br></p><p>3)2016年最高司法机关就环境污染犯罪出台专门司法解释;</p><p><br></p><p>4)2018年起实施《环境保护税法》，危废税额1000元/吨;5)环保部发布《水泥窑协同处置固体废物污染防治技术政策》，支持水泥窑协同处置。</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533866857\"></div></p><p><br></p><p>近年来危废相关法规政策<br></p><p><br></p><p>各省市纷纷出台“十三五危废设施建设规划”。山东省17年9月发布“十三五”危险废物处置设施建设规划;四川省17年10月发布危险废物处置设施建设五年规划;广东省17年11月发布固体废物污染防治三年行动计划(2018年-2020年)。</p><p><br></p><p><span><strong>山东</strong></span>：“十三五”期间，全省规划完成建设危险废物、医疗废物利用处置项目共318项，收集储运项目35项，项目总数353项，估算总投资530亿元。</p><p><br></p><p>新增工业危废利用能力1538万吨，危废焚烧、物化、填埋等处置能力713万吨(含医废处置能力6.8万吨)。</p><p><br></p><p><span><strong>四川</strong></span>：到2020年，7个危废项目全面建成，新增危险废物处置能力40.5万吨/年，全省危险废物集中处置能力达到49.86万吨/年。</p><p><br></p><p>到2022年，6个危废项目全面建成，新增危险废物处置能力23.3万吨/年，全省危险废物集中处置能力达到73.16万吨/年。</p><p><br></p><p>到2020年，全省医疗废物处置能力达到14.29万吨/年，其中新增能力8.92万吨/年。</p><p><br></p><p><span><strong>广东</strong></span>：到2020年，广东全省工业危险废物安全处置率、医疗废物安全处置率均达到99%以上;到2020年全省年填埋处置能力增加10万吨;全省年焚烧处置能力增加10万吨;到2020年力争全省形成10万吨/年以上医疗废物无害化处置能力。</p><p><br></p><p><span><strong>1、需求端</strong></span></p><p><br></p><p>危废环境危害极大，是处置刚需。根据2016年新修订《国家危险废物名录》的定义，危险废物(Hazardouswaste)为1)具有腐蚀性、毒性、易燃性、反应性或者感染性等一种或者几种危险特性的;2)不排除具有危险特性，可能对环境或者人体健康造成有害影响，需要按照危险废物进行管理的。</p><p><br></p><p>危废可分为46大类479种。2016年版《国家危险废物名录》将大类品种优化缩编，但细化子类品种，更加符合工业生产实际情况，增加了可执行性。原名录中49大类400种危险废物调整为46大类479种，新增的79种主要是对HW01医疗废物、HW11精(蒸)馏残渣和HW50废催化剂类废物的细化。</p><p><br></p><p>危废主要包括工业废物、市政废物与医疗废物。其中工业废物占比70%以上、医疗废物约14%;工业危废中，废酸废碱占30%，石棉废物占14%，有色金属冶炼废物占10%;来源行业中，化学原料与产品制造占19%，有色金属冶炼占比15%，废金属矿采选占14%，造纸业占13%。</p><p><br></p><p>工业危险废物产生种类构成:</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533867122\"></div></p><p>危废来源行业:</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533867157\"></div><br></p><p>《环境状况公报》和《国家统计年鉴》统计数据均为企业自行上报的产量，企业为逃避高额危废处理费用，存在极强瞒报倾向，且种种证据显示该数据严重失真。</p><p><br></p><p>1)16年官方统计的危废产生量增加1371万吨(\r\n \r\n34%)至5347万吨。我们认为，2016年危废产生量激增1400万吨的原因并不是工业实际产生危废增加，而是由于16年中央环保督察开展，整体监管力度大幅增强，过去大量偷排危废的企业按照规定处置危废，导致统计口径中危废产生量上升，资源化量、无害化量也均大幅上升。</p><p><br></p><p>2)这种统计量的增长在2011年时也曾发生，2011年危废产量在1kg以上的均纳入统计，所以当年由2010年之前产生量1500万吨左右飞跃到3400多万吨。</p><p><br></p><p>3)2010年两部一局联合公布《第一次全国污染源普查公告》显示，2007年全国危废产量为4574万吨，远大于统计年鉴上企业自行申报的1079万吨。</p><p>4)从危废占固废比重的角度来看，16年固废产量预计保持稳定在33亿吨左右，危废占固废占比仅有1.3%，远低于发达国家5%-10%的水平。第二次全国污染源普查即将开展，我们预计此次普查将更真实地反映危废产生量。</p><p>我国工业危险废物产生量(万吨):</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533867366\"></div></p><p><br></p><p><span><strong>2、供给端</strong></span></p><p><br></p><p>综合处置率虽达83%，但危废企业实际处理比例仅为25%。根据《全国环境统计年报》显示，2016年工业危废处理量共4430万吨，其中资源化处置量2824万吨，无害化处置量1606万吨，综合处置率达82.8%。</p><p><br></p><p>但是由于部分工业企业未严格申报，处置率数据偏高;11月人大常委会《固体废物污染环境防治法执法检查报告》显示，2016年全国各省(区、市)持危险废物经营许可证的单位设计处置能力为6471万吨(十年CAGR25%)，但实际经营规模只有1629万吨，实际危废企业处理比例仅为25%。</p><p><br></p><p><span>其原因主要是：</span></p><p><br></p><p>1)供需种类不匹配。危废种类繁多，因而每种危废需要不同的处置技术与处置资格，我国90%以上危废处置企业仅能处置5种以下危废种类，供需种类错配的现象较为严重。</p><p>2)由于环评及建设期长等因素，有大量拥有牌照却无实际处置能力的危废企业。</p><p><br></p><p>16年工业危废综合处置率83%</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533867475\"></div></p><p><br></p><p><br></p><p>危废产量与处理量缺口大，各地处理费用不一。由于国家利好政策的不断支持，危废处理将迎来黄金期，危废处理的价格也是居高不下，从各地的危废处置定价来看，填埋处置的价格一般在2000-4000元/吨，焚烧处置的价格一般在2000-5000元/吨，各地价格差异较大，主要是受危废产量与处理量缺口大小影响，缺口较大的地区如山西、四川，处理费用相对较高。</p><p><br></p><p><span><strong>3、市场空间<br></strong></span></p><p><br></p><p>发达国家危废占比5%-10%，假设危废占固废比重为3%，估计危废实际产量近1亿吨，与官方统计差额超过4000万吨。未来三年随着监管不断加强，实际危废产量与官方统计量的差额将不断缩小。我们认为综合处置率将稳步提升，按无害化3500元/吨，2020年市场空间将达到1000亿元。</p><p><br></p><p>危废行业盈利能力强，毛利率35%以上，净利率20%;政府客户占比低，现金流好。行业的高壁垒令很多垂涎危废行业的企业望而却步。</p><p><br></p><p>1)资质壁垒，危废行业受政府监管，收集、转运、处置都需许可证。</p><p>2)资金壁垒，无害化处置的万吨投资在6000-8000万元，且回收周期长一般要3-5年。</p><p><br></p><p>3)管理壁垒，</p><p><br></p><p>4)技术壁垒，危废种类多、处理难度高，其技术是各种工艺的整体组合，需要多年管理经验、技术积累。</p><p><br></p><p><span><strong>二、技术趋势</strong></span></p><p><br></p><p><span><strong>1. 危废处理方法</strong></span></p><p><br></p><p>危废基本处理步骤包括分类、预处理、最终处置。金属、油脂、溶剂、染料等由回收利用价值的废物可被资源化利用;预处理包括物理法、化学法，预处理后的危废才能进入焚烧或填埋等最终处置设施中。</p><p>我国危废处理方式基本以无害化处理及资源化利用为主。资源化利用的模式为危废资源化企业向上游产废企业收取有利用价值的废物，再提纯生产为资源化产品，收入来自于销售产品，盈利受上游废物价格及下游金属价格影响。</p><p><br></p><p>无害化处置是处置企业向产废企业收取费用，主要包括焚烧、填埋、物化，水泥窑协同处置也可列为无害化处置的方法。无害化毛利较高，焚烧毛利可达40%以上，填埋毛利50%以上。水泥窑协同处置与水泥生产共摊成本，边际成本较低。</p><p>危废处理基本技术路线:</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533867602\"></div><br></p><p><br></p><p>危废处理方法主要有资源化、无害化两类:</p><p><br></p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533867646\"></div></p><p><br></p><p><strong>三、行业格局</strong></p><p><br></p><p><span><strong>1. 行业格局：“小、散、乱”</strong></span></p><p><br></p><p>目前危废行业呈现“散、小、弱”特征。随着监管趋严，标准提高，小企业会被淘汰或被收购;且未来资质审批更严，实力弱的小企业将更难获得资质，国企。</p><p><br></p><p><span>散</span>：危废行业市场集中度极低，行业前十企业处理资质占比仅为6%，其原因为1)危废处理半径短，跨省转移需审批，区域性极强，2)地方保护主义较强，跨区域拓展较难，3)标准尚低，对技术与管理上的要求还不高。</p><p><br></p><p><span>资质企业平均规模较小</span>：2016年我国持危险废弃物经营许可证的企业数量为2149家，2016年净增加仅115家，体现出环保系统对新颁发许可证愈发谨慎;平均每家处理量仅不到3万吨，呈现较强的分散性特征，但单企业处理规模由2014年2.2万吨/年增加到2016年3.0万吨/年，未来随着许可证颁发与复核难度加大，实力弱、技术差的小企业将被淘汰出市场，龙头扩张，单企业规模继续扩大。</p><p><div class=\"blog-img\"><img src=\"/huili/callback/upload/100000_1533867747\"></div></p><p><br></p><p>单企业处理规模不断扩大</p><p><br></p><p><span>弱</span>：大部分工业危废处理企业技术、资金较弱，处理资质比较单一，这也是危废企业实际处理比例较低的一大原因。</p><p><br></p><p>据统计，全国1500多家具有危废处理资质的企业的处理类别和能力中，90%的企业经许可处置的危险废物种类都小于10种，而能处理25种以上危废品类的企业仅占1%。</p><p><br></p><p>从处理量上来看，处理能力低于50吨/日的企业超八成，处理能力达到1000吨/日的企业仅占0.3%。</p><p><br></p><p><span><strong>2. 行业内并购情况</strong></span></p><p><br></p><p>A股公司通过并购获取危废资质量。东江环保为行业龙头，内生\r\n \r\n外延发展今年年底资质量将达到170万吨;上海环境凭借大股东上海城投在上海环境领域的垄断地位拿到31万吨资质。危废新建项目周期太长，我们认为国企背景、技术好、资金实力强的行业龙头将继续通过并购完成地理扩张与业务扩张。</p><p><br></p><p><span><strong>3. 危废标的评价四维度体系：区域、资源、技术、管理</strong></span></p><p><br></p><p>危废行业景气度高，A股公司纷纷跨界并购切入危废领域。未来市场还将涌现更多并购案例。我们构建了区域、资源、技术、财务的四维度体系来评估并购标的的质量及其对上市公司的影响。</p><p><br></p><p>危废行业区域性强，优秀企业“占山为王”。污染大省的就地处理能力严重不足，很多危废需要运输到外地处理。</p><p>2015年，各地区工业危险废物产生量较大的省份为：山东757.5万吨，青海499.2万吨，新疆328.2万吨，湖南258.5万吨，江苏255.3万吨，占全国工业危险废物产生量的19.1%、12.6%、8.3%、6.5%和6.4%。我们按危废实际处置量/产生量、人均GDP两个维度将省份分为四类，较好的为经济发达、供给缺口大的区域：</p><p><br></p><p>经济发达、供给缺口大：上海、山东、江苏、浙江、安徽、福建、湖南、广东、重庆</p><p><br></p><p>经济发达、发展较成熟：北京、天津</p><p><br></p><p>经济不发达、供给缺口大：河北、山西、内蒙、吉林、黑龙江、江西、河南、湖北、广西、四川、贵州、云南、新疆、青海</p><p><br></p><p>经济不发达、供给缺口小：辽宁、海南、陕西、甘肃、宁夏、西藏</p><p><br></p><p><span>资源包括了危废处置终端资源、危废收储运输、危废核准处置种类。</span></p><p>1)拥有资源的企业在特定区域内拥有稳定的客户关系，集中处置是趋势，企业拥有收集、运输、最终处置的一站式服务能力非常重要;</p><p><br></p><p>2)资质量与核准处置种类限定了企业的规模，且政府对许可证新颁发与展期的要求越来越严格，资质量小的企业会越来越不容易得到审批。</p><p><br></p><p>管理能力、与母公司协同：目前来看，危废行业技术并不是核心竞争力，大部分公司基本是引进国际先进设备，或者使用国内高校的成熟技术。危废行业是高污染，高风险的行业，核心能力在于运营管理能力，比如如何进行配比焚烧，如何控制排放达标，如何防范风险事件的发生。因此长期运营经验、整体员工素质也非常重要。</p><p><br></p><p>另一方面，并购标的与母公司是否存在协同效应也是值得关注的，固废企业往往有焚烧等项目经验，容易产生协同效应;跨界并购切入高壁垒的危废领域的公司则需更长时间的观察。</p><p><br></p><p>技术类型：供需格局趋向平衡，技术会越来越重要。高精尖技术能减少二次处置成本(如焚烧飞灰、炉渣)。若能减少二噁英等污染物的产生，将显著减少“邻避效应”。</p><p><br></p>',100000,1,0,1);
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
INSERT INTO `choose` VALUES (100000,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100000,1,'chlink3','环境工程','/huili/include/home.php?select=5cd4814c281bf77cf5272797d9743cf7','with-name','icon-truck'),(100000,2,'chlink4','环境监测','/huili/include/home.php?select=ec953999c14b6371ac55241e895de3dc','with-name','icon-flask'),(100000,3,'chlink5','项目验收','/huili/include/home.php?select=58bd73629d7fa3ffdfbca05db2c0be7d','with-name','icon-pagelines'),(100000,4,'chlink6','清洁生产','/huili/include/home.php?select=5f7139796ec94c73d53e6886885ed21b','with-name','icon-recycle'),(100000,5,'chlink7','危废服务','/huili/include/home.php?select=a54ee8242567c420ac10b19fcbd24cc8','with-name','icon-fire'),(100000,6,'chlink8','应急预案','/huili/include/home.php?select=6b19163b5cd4ae474189d882049cd83d','with-name','icon-calendar-check-o'),(100000,11,'chlink13','环境法规','/huili/include/home.php?select=316e50a2d5dc063522e3b411224e0cb6','with-name','icon-wpforms'),(100000,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100000,15,'chlink17','交流互动','/huili/include/home.php?select=749ab3b68632680660d776891751e812','with-name','icon-cchat'),(100002,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100002,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100003,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100003,1,'chlink3','环境工程','/huili/include/home.php?select=5cd4814c281bf77cf5272797d9743cf7','with-name','icon-truck'),(100003,2,'chlink4','环境监测','/huili/include/home.php?select=ec953999c14b6371ac55241e895de3dc','with-name','icon-flask'),(100003,3,'chlink5','项目验收','/huili/include/home.php?select=58bd73629d7fa3ffdfbca05db2c0be7d','with-name','icon-pagelines'),(100003,4,'chlink6','清洁生产','/huili/include/home.php?select=5f7139796ec94c73d53e6886885ed21b','with-name','icon-recycle'),(100003,5,'chlink7','危废服务','/huili/include/home.php?select=a54ee8242567c420ac10b19fcbd24cc8','with-name','icon-fire'),(100003,6,'chlink8','应急预案','/huili/include/home.php?select=6b19163b5cd4ae474189d882049cd83d','with-name','icon-calendar-check-o'),(100003,11,'chlink13','环境法规','/huili/include/home.php?select=316e50a2d5dc063522e3b411224e0cb6','with-name','icon-wpforms'),(100003,12,'chlink14','资料下载','/huili/include/home.php?select=f3f7bacf6f435e7aa6391b1d9e2846b4','with-name','icon-download'),(100004,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100004,1,'chlink3','环境工程','/huili/include/home.php?select=5cd4814c281bf77cf5272797d9743cf7','with-name','icon-truck'),(100009,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100009,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100009,14,'chlink16','监控平台','/huili/include/home.php?select=03142410d7285f00e4363e005783c83a','with-name','icon-desktop');
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
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '文档索引号',
  `cid` int(4) unsigned NOT NULL COMMENT '类别id',
  `iid` int(8) unsigned NOT NULL COMMENT '索引id',
  `docname` varchar(128) NOT NULL COMMENT '文档名',
  `docpath` varchar(128) NOT NULL COMMENT '文档路径',
  PRIMARY KEY (`idx`),
  KEY `cid_iid` (`cid`,`iid`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (64,4,0,'中华人民共和国环境保护税法','/huili/documents/doc_001.txt'),(65,4,0,'中华人民共和国水污染防治法（新）','/huili/documents/doc_002.txt'),(66,4,0,'中华人民共和国环境影响评价法（新）','/huili/documents/doc_003.txt'),(67,4,0,'中华人民共和国大气污染防治法','/huili/documents/doc_004.txt'),(68,4,0,'中华人民共和国环境保护法','/huili/documents/doc_005.txt'),(69,4,0,'中华人民共和国环境噪声污染防治法','/huili/documents/doc_006.txt'),(70,4,0,'中华人民共和国固体废物污染环境防治法','/huili/documents/doc_007.txt'),(71,4,0,'中华人民共和国海洋环境保护法','/huili/documents/doc_008.txt'),(72,4,0,'中华人民共和国放射性污染防治法','/huili/documents/doc_009.txt'),(73,4,0,'中华人民共和国清洁生产促进法','/huili/documents/doc_010.txt'),(74,0,0,'麻纺工业水污染物排放标准','/huili/documents/W020121116662872696279.pdf');
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
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
INSERT INTO `security` VALUES (100000,'2018-08-02 00:59:51',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-08-02 01:08:15',1,'192.168.101.158','Android系统','Chrome',0,0),(100003,'2018-08-02 01:11:30',1,'192.168.101.158','Android系统','Chrome',0,0),(100003,'2018-08-02 02:46:29',1,'192.168.101.158','Android系统','Chrome',0,0),(100000,'2018-08-02 02:49:34',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 02:53:16',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 02:54:25',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:01:16',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:02:08',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:09:43',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:11:15',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:41:34',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:45:12',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:48:15',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 05:02:43',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 05:29:45',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 05:31:14',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 05:41:18',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 05:56:17',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 11:26:04',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 12:10:37',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 12:19:11',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 12:24:09',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 12:29:13',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 13:52:43',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 14:13:25',1,'192.168.1.102','Android系统','Chrome',0,0),(100000,'2018-08-04 01:18:17',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 01:48:37',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 02:39:35',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 06:15:56',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 06:17:59',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 07:30:19',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 07:34:01',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 12:24:15',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-08-04 12:31:41',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 12:36:25',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-04 12:41:44',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-08-04 12:44:55',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 14:11:42',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-04 14:42:15',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 14:50:28',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-04 15:28:30',0,'192.168.1.101','Android系统','Chrome',0,0),(100000,'2018-08-05 00:42:11',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 01:07:31',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-08-05 01:10:24',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 01:11:00',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-05 01:18:35',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-08-05 02:04:26',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 02:06:21',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-05 02:16:52',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 02:32:21',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 02:36:30',0,'192.168.1.101','Android系统','Chrome',0,0),(100000,'2018-08-05 11:36:09',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 11:39:03',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 11:52:27',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 11:57:47',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 12:44:19',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 14:18:25',0,'192.168.1.101','Android系统','Chrome',0,0),(100000,'2018-08-05 14:29:57',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 14:39:31',0,'192.168.1.101','Android系统','Chrome',0,0),(100000,'2018-08-05 14:51:27',0,'192.168.1.101','Android系统','Chrome',0,0),(100000,'2018-08-05 23:43:53',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-05 23:45:35',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-07 00:09:57',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-07 00:10:49',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-07 00:13:57',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-08-07 00:47:01',1,'192.168.101.158','Android系统','Chrome',0,0),(100000,'2018-08-07 07:55:23',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-09 08:01:00',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-10 01:49:23',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-10 01:51:04',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-10 01:55:44',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-10 15:05:17',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-11 01:41:03',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-11 06:58:27',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-11 07:42:21',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-11 07:46:37',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-11 07:58:33',0,'192.168.1.102','Android系统','Chrome',0,0),(100000,'2018-08-11 08:48:51',0,'192.168.1.102','Android系统','Chrome',0,0),(100000,'2018-08-11 08:54:16',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-11 09:03:52',0,'192.168.1.102','Android系统','Chrome',0,0),(100000,'2018-08-11 09:09:20',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-11 09:17:24',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-11 09:22:07',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-11 09:28:58',0,'192.168.1.102','Android系统','Chrome',0,0),(100000,'2018-08-11 09:29:31',0,'192.168.1.102','Android系统','Chrome',0,0),(100000,'2018-08-11 09:35:04',0,'192.168.1.102','Android系统','Chrome',0,0),(100000,'2018-08-11 10:56:19',0,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-11 11:56:04',0,'192.168.1.102','Android系统','Chrome',0,0),(100000,'2018-08-11 23:36:32',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-12 01:17:59',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-12 01:33:40',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-21 23:51:54',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-22 00:08:40',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-22 02:11:12',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-22 02:31:37',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-22 02:51:27',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-22 02:53:08',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-22 02:54:43',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-22 02:56:04',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-22 02:58:49',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-22 03:06:59',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-08-22 03:10:06',1,'192.168.101.158','Android系统','Chrome',0,0),(100000,'2018-08-22 03:44:21',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-22 05:02:43',0,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-22 05:14:02',0,'localhost','GNU/linux操作系统','Firefox',1,7);
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
INSERT INTO `talkmsg` VALUES (100000,100003,'2018-07-27 02:02:50','你好，在吗？',0,0,1,0),(100000,100003,'2018-07-27 02:04:50','有事吗？请说',0,1,0,1),(100000,100003,'2018-07-27 02:05:27','有个问题想请教您',0,0,1,0),(100000,100003,'2018-07-27 02:36:47','请说',0,1,0,1),(100000,100003,'2018-07-27 02:38:14','山东省泰安市环境保护局监测站生态监测科田勇',0,1,0,1),(100000,100003,'2018-07-27 03:14:48','关于环评方面的问题请教下',0,0,1,0),(100000,100003,'2018-08-04 12:25:39','你好！有个问题想请教',1,0,22,9),(100000,100003,'2018-08-04 12:32:21','有什么问题？请说吧',1,1,19,10),(100000,100003,'2018-08-04 12:38:28','你们是否承接污水处理设施的运营管理呢？我们的污水处理设施想委托运营。',1,0,20,7),(100000,100003,'2018-08-05 02:03:57','你们具备相关资质吗？',1,0,10,1),(100000,100003,'2018-08-05 02:05:57','有的，我们有污水处理设施甲级运营资质的，并且我们很愿意和您就这个问题进行详谈。',1,1,8,2);
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

-- Dump completed on 2018-08-22 14:01:29
