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
-- Table structure for table `area_info`
--

DROP TABLE IF EXISTS `area_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area_info` (
  `aid` int(6) unsigned NOT NULL COMMENT '行政区划代码',
  `aname` varchar(16) NOT NULL COMMENT '行政区划名称',
  `bused` int(1) unsigned DEFAULT '0' COMMENT '本系统所属的行政区划',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area_info`
--

LOCK TABLES `area_info` WRITE;
/*!40000 ALTER TABLE `area_info` DISABLE KEYS */;
INSERT INTO `area_info` VALUES (100000,'北京市',NULL),(100100,'市辖区',NULL),(100200,'县',NULL),(120000,'天津市',NULL),(120100,'市辖区',NULL),(120200,'县',NULL),(130000,'河北省',NULL),(130100,'石家庄市',NULL),(130200,'唐山市',NULL),(130300,'秦皇岛市',NULL),(130400,'邯郸市',NULL),(130500,'邢台市',NULL),(130600,'保定市',NULL),(130700,'张家口市',NULL),(130800,'承德市',NULL),(130900,'沧州市',NULL),(131000,'廊坊市',NULL),(131100,'衡水市',NULL),(139000,'省直辖县级行政区划',NULL),(140000,'山西省',NULL),(140100,'太原市',NULL),(140200,'大同市',NULL),(140300,'阳泉市',NULL),(140400,'长治市',NULL),(140500,'晋城市',NULL),(140600,'朔州市',NULL),(140700,'晋中市',NULL),(140800,'运城市',NULL),(140900,'忻州市',NULL),(141000,'临汾市',NULL),(141100,'吕梁市',NULL),(150000,'内蒙古自治区',NULL),(150100,'呼和浩特市',NULL),(150200,'包头市',NULL),(150300,'乌海市',NULL),(150400,'赤峰市',NULL),(150500,'通辽市',NULL),(150600,'鄂尔多斯市',NULL),(150700,'呼伦贝尔市',NULL),(150800,'巴彦淖尔市',NULL),(150900,'乌兰察布市',NULL),(152200,'兴安盟',NULL),(152500,'锡林郭勒盟',NULL),(152900,'阿拉善盟',NULL),(210000,'辽宁省',NULL),(210100,'沈阳市',NULL),(210200,'大连市',NULL),(210300,'鞍山市',NULL),(210400,'抚顺市',NULL),(210500,'本溪市',NULL),(210600,'丹东市',NULL),(210700,'锦州市',NULL),(210800,'营口市',NULL),(210900,'阜新市',NULL),(211000,'辽阳市',NULL),(211100,'盘锦市',NULL),(211200,'铁岭市',NULL),(211300,'朝阳市',NULL),(211400,'葫芦岛市',NULL),(220000,'吉林省',NULL),(220100,'长春市',NULL),(220200,'吉林市',NULL),(220300,'四平市',NULL),(220400,'辽源市',NULL),(220500,'通化市',NULL),(220600,'白山市',NULL),(220700,'松原市',NULL),(220800,'白城市',NULL),(222400,'延边朝鲜族自治州',NULL),(230000,'黑龙江省',NULL),(230100,'哈尔滨市',NULL),(230200,'齐齐哈尔市',NULL),(230300,'鸡西市',NULL),(230400,'鹤岗市',NULL),(230500,'双鸭山市',NULL),(230600,'大庆市',NULL),(230700,'伊春市',NULL),(230800,'佳木斯市',NULL),(230900,'七台河市',NULL),(231000,'牡丹江市',NULL),(231100,'黑河市',NULL),(231200,'绥化市',NULL),(232700,'大兴安岭地区',NULL),(310000,'上海市',NULL),(310100,'市辖区',NULL),(310200,'县',NULL),(320000,'江苏省',NULL),(320100,'南京市',NULL),(320200,'无锡市',NULL),(320300,'徐州市',NULL),(320400,'常州市',NULL),(320500,'苏州市',NULL),(320600,'南通市',NULL),(320700,'连云港市',NULL),(320800,'淮安市',NULL),(320900,'盐城市',NULL),(321000,'扬州市',NULL),(321100,'镇江市',NULL),(321200,'泰州市',NULL),(321300,'宿迁市',NULL),(330000,'浙江省',NULL),(330100,'杭州市',NULL),(330200,'宁波市',NULL),(330300,'温州市',NULL),(330400,'嘉兴市',NULL),(330500,'湖州市',NULL),(330600,'绍兴市',NULL),(330700,'金华市',NULL),(330800,'衢州市',NULL),(330900,'舟山市',NULL),(331000,'台州市',NULL),(331100,'丽水市',NULL),(340000,'安徽省',NULL),(340100,'合肥市',NULL),(340200,'芜湖市',NULL),(340300,'蚌埠市',NULL),(340400,'淮南市',NULL),(340500,'马鞍山市',NULL),(340600,'淮北市',NULL),(340700,'铜陵市',NULL),(340800,'安庆市',NULL),(341000,'黄山市',NULL),(341100,'滁州市',NULL),(341200,'阜阳市',NULL),(341300,'宿州市',NULL),(341500,'六安市',NULL),(341600,'亳州市',NULL),(341700,'池州市',NULL),(341800,'宣城市',NULL),(350000,'福建省',NULL),(350100,'福州市',NULL),(350200,'厦门市',NULL),(350300,'莆田市',NULL),(350400,'三明市',NULL),(350500,'泉州市',NULL),(350600,'漳州市',NULL),(350700,'南平市',NULL),(350800,'龙岩市',NULL),(350900,'宁德市',NULL),(360000,'江西省',NULL),(360100,'南昌市',NULL),(360200,'景德镇市',NULL),(360300,'萍乡市',NULL),(360400,'九江市',NULL),(360500,'新余市',NULL),(360600,'鹰潭市',NULL),(360700,'赣州市',NULL),(360800,'吉安市',NULL),(360900,'宜春市',NULL),(361000,'抚州市',NULL),(361100,'上饶市',NULL),(370000,'山东省',NULL),(370100,'济南市',NULL),(370200,'青岛市',NULL),(370300,'淄博市',NULL),(370400,'枣庄市',NULL),(370500,'东营市',NULL),(370600,'烟台市',NULL),(370700,'潍坊市',NULL),(370800,'济宁市',NULL),(370900,'泰安市',NULL),(371000,'威海市',NULL),(371100,'日照市',NULL),(371200,'莱芜市',NULL),(371300,'临沂市',NULL),(371400,'德州市',NULL),(371500,'聊城市',NULL),(371600,'滨州市',NULL),(371700,'菏泽市',NULL),(410000,'河南省',NULL),(410100,'郑州市',NULL),(410200,'开封市',NULL),(410300,'洛阳市',NULL),(410400,'平顶山市',NULL),(410500,'安阳市',NULL),(410600,'鹤壁市',NULL),(410700,'新乡市',NULL),(410800,'焦作市',NULL),(410900,'濮阳市',NULL),(411000,'许昌市',NULL),(411100,'漯河市',NULL),(411200,'三门峡市',NULL),(411300,'南阳市',NULL),(411400,'商丘市',NULL),(411500,'信阳市',NULL),(411600,'周口市',NULL),(411700,'驻马店市',NULL),(419000,'省直辖县级行政区划',NULL),(420000,'湖北省',NULL),(420100,'武汉市',NULL),(420200,'黄石市',NULL),(420300,'十堰市',NULL),(420500,'宜昌市',NULL),(420600,'襄阳市',NULL),(420700,'鄂州市',NULL),(420800,'荆门市',NULL),(420900,'孝感市',NULL),(421000,'荆州市',NULL),(421100,'黄冈市',NULL),(421200,'咸宁市',NULL),(421300,'随州市',NULL),(422800,'恩施土家族苗族自治州',NULL),(429000,'省直辖县级行政区划',NULL),(430000,'湖南省',NULL),(430100,'长沙市',NULL),(430200,'株洲市',NULL),(430300,'湘潭市',NULL),(430400,'衡阳市',NULL),(430500,'邵阳市',NULL),(430600,'岳阳市',NULL),(430700,'常德市',NULL),(430800,'张家界市',NULL),(430900,'益阳市',NULL),(431000,'郴州市',NULL),(431100,'永州市',NULL),(431200,'怀化市',NULL),(431300,'娄底市',NULL),(433100,'湘西土家族苗族自治州',NULL),(440000,'广东省',NULL),(440100,'广州市',NULL),(440200,'韶关市',NULL),(440300,'深圳市',NULL),(440400,'珠海市',NULL),(440500,'汕头市',NULL),(440600,'佛山市',NULL),(440700,'江门市',NULL),(440800,'湛江市',NULL),(440900,'茂名市',NULL),(441200,'肇庆市',NULL),(441300,'惠州市',NULL),(441400,'梅州市',NULL),(441500,'汕尾市',NULL),(441600,'河源市',NULL),(441700,'阳江市',NULL),(441800,'清远市',NULL),(441900,'东莞市',NULL),(442000,'中山市',NULL),(445100,'潮州市',NULL),(445200,'揭阳市',NULL),(445300,'云浮市',NULL),(450000,'广西壮族自治区',NULL),(450100,'南宁市',NULL),(450200,'柳州市',NULL),(450300,'桂林市',NULL),(450400,'梧州市',NULL),(450500,'北海市',NULL),(450600,'防城港市',NULL),(450700,'钦州市',NULL),(450800,'贵港市',NULL),(450900,'玉林市',NULL),(451000,'百色市',NULL),(451100,'贺州市',NULL),(451200,'河池市',NULL),(451300,'来宾市',NULL),(451400,'崇左市',NULL),(460000,'海南省',NULL),(460100,'海口市',NULL),(460200,'三亚市',NULL),(460300,'三沙市',NULL),(469000,'省直辖县级行政区划',NULL),(500000,'重庆市',NULL),(500100,'市辖区',NULL),(500200,'县',NULL),(510000,'四川省',NULL),(510100,'成都市',NULL),(510300,'自贡市',NULL),(510400,'攀枝花市',NULL),(510500,'泸州市',NULL),(510600,'德阳市',NULL),(510700,'绵阳市',NULL),(510800,'广元市',NULL),(510900,'遂宁市',NULL),(511000,'内江市',NULL),(511100,'乐山市',NULL),(511300,'南充市',NULL),(511400,'眉山市',NULL),(511500,'宜宾市',NULL),(511600,'广安市',NULL),(511700,'达州市',NULL),(511800,'雅安市',NULL),(511900,'巴中市',NULL),(512000,'资阳市',NULL),(513200,'阿坝藏族羌族自治州',NULL),(513300,'甘孜藏族自治州',NULL),(513400,'凉山彝族自治州',NULL),(520000,'贵州省',NULL),(520100,'贵阳市',NULL),(520200,'六盘水市',NULL),(520300,'遵义市',NULL),(520400,'安顺市',NULL),(520500,'毕节市',NULL),(520600,'铜仁市',NULL),(522300,'黔西南布依族苗族自治州',NULL),(522600,'黔东南苗族侗族自治州',NULL),(522700,'黔南布依族苗族自治州',NULL),(530000,'云南省',NULL),(530100,'昆明市',NULL),(530300,'曲靖市',NULL),(530400,'玉溪市',NULL),(530500,'保山市',NULL),(530600,'昭通市',NULL),(530700,'丽江市',NULL),(530800,'普洱市',NULL),(530900,'临沧市',NULL),(532300,'楚雄彝族自治州',NULL),(532500,'红河哈尼族彝族自治州',NULL),(532600,'文山壮族苗族自治州',NULL),(532800,'西双版纳傣族自治州',NULL),(532900,'大理白族自治州',NULL),(533100,'德宏傣族景颇族自治州',NULL),(533300,'怒江傈僳族自治州',NULL),(533400,'迪庆藏族自治州',NULL),(540000,'西藏自治区',NULL),(540100,'拉萨市',NULL),(540200,'日喀则市',NULL),(542100,'昌都地区',NULL),(542200,'山南地区',NULL),(542400,'那曲地区',NULL),(542500,'阿里地区',NULL),(542600,'林芝地区',NULL),(610000,'陕西省',NULL),(610100,'西安市',NULL),(610200,'铜川市',NULL),(610300,'宝鸡市',NULL),(610400,'咸阳市',NULL),(610500,'渭南市',NULL),(610600,'延安市',NULL),(610700,'汉中市',NULL),(610800,'榆林市',NULL),(610900,'安康市',NULL),(611000,'商洛市',NULL),(620000,'甘肃省',NULL),(620100,'兰州市',NULL),(620200,'嘉峪关市',NULL),(620300,'金昌市',NULL),(620400,'白银市',NULL),(620500,'天水市',NULL),(620600,'武威市',NULL),(620700,'张掖市',NULL),(620800,'平凉市',NULL),(620900,'酒泉市',NULL),(621000,'庆阳市',NULL),(621100,'定西市',NULL),(621200,'陇南市',NULL),(622900,'临夏回族自治州',NULL),(623000,'甘南藏族自治州',NULL),(630000,'青海省',NULL),(630100,'西宁市',NULL),(630200,'海东市',NULL),(632200,'海北藏族自治州',NULL),(632300,'黄南藏族自治州',NULL),(632500,'海南藏族自治州',NULL),(632600,'果洛藏族自治州',NULL),(632700,'玉树藏族自治州',NULL),(632800,'海西蒙古族藏族自治州',NULL),(640000,'宁夏回族自治区',NULL),(640100,'银川市',NULL),(640200,'石嘴山市',NULL),(640300,'吴忠市',NULL),(640400,'固原市',NULL),(640500,'中卫市',NULL),(650000,'新疆维吾尔自治区',NULL),(650100,'乌鲁木齐市',NULL),(650200,'克拉玛依市',NULL),(652100,'吐鲁番地区',NULL),(652200,'哈密地区',NULL),(652300,'昌吉回族自治州',NULL),(652700,'博尔塔拉蒙古自治州',NULL),(652800,'巴音郭楞蒙古自治州',NULL),(652900,'阿克苏地区',NULL),(653000,'克孜勒苏柯尔克孜自治州',NULL),(653100,'喀什地区',NULL),(653200,'和田地区',NULL),(654000,'伊犁哈萨克自治州',NULL),(654200,'塔城地区',NULL),(654300,'阿勒泰地区',NULL),(659000,'自治区直辖县级行政区划',NULL),(710000,'台湾省',NULL),(810000,'香港特别行政区',NULL),(820000,'澳门特别行政区',NULL);
/*!40000 ALTER TABLE `area_info` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `auth` VALUES (100002,'test1@163.com','test1','260be2fecdf89f88eab77128ef7511d3',7,1,0,2,2,0,'2018-07-03 01:57:20','2018-07-07 03:49:31','/huili/images/upload/893837911.jpg'),(100003,'test2@163.com','test2','8d114dfc0aa6cbd20d74a573b9343e86',7,1,0,6,6,0,'2018-07-03 01:57:21','2018-08-27 02:26:50','/huili/images/upload/002S14P1-2.jpg'),(100004,'test3@163.com','test3','ae71aca395893a68edfae00b2502b2ba',7,1,0,2,2,0,'2018-07-03 01:57:21','2018-07-26 07:25:42','/huili/images/upload/0255004244-0.jpg'),(100005,'test4@163.com','test4','294d6d199b92abdc07e6715956c67831',7,1,0,1,1,0,'2018-07-03 01:57:21','2018-07-09 07:59:31','/huili/images/upload/timg2.jpeg'),(100006,'test5@163.com','test5','c198e96271965c83219549c2d8961a9b',7,1,0,1,1,0,'2018-07-05 13:51:03','2018-07-09 08:02:03','/huili/images/upload/aaa1.jpg'),(100007,'test6@163.com','test6','9c56b932f9aad6427aaa43aea215d83d',7,1,0,2,2,0,'2018-07-05 13:51:03','2018-08-22 08:07:07','/huili/images/upload/timg3.jpeg'),(100008,'test7@163.com','test7','1817399417998612cdca4a671771d60a',7,1,0,0,0,0,'2018-07-05 13:51:03','2018-07-05 13:51:03',NULL),(100009,'test8@163.com','test8','bd969170781556ac46fd26fbd3f15e39',7,1,0,1,1,0,'2018-07-05 13:51:03','2018-07-18 07:36:51',NULL),(100010,'test9@163.com','test9','b081fd85802d5708431149c13c6687f5',7,1,0,0,0,0,'2018-07-05 13:54:56','2018-07-05 13:54:56',NULL),(100001,'tybitsfox@163.com','tybitsfox','2694f8b0e3d3d17ff567c9ca072db75c',7,1,0,0,0,0,'2018-07-03 01:37:49','2018-07-03 01:37:49',NULL),(100000,'tyyyyt@163.com','田勇','9a071c40a829eea19b90a5e011d64703',7,1,0,32,32,0,'2018-07-03 01:12:06','2018-08-26 23:50:04','/huili/images/upload/worldcup.jpeg');
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
INSERT INTO `choose` VALUES (100000,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100000,1,'chlink3','环境工程','/huili/include/home.php?select=5cd4814c281bf77cf5272797d9743cf7','with-name','icon-truck'),(100000,2,'chlink4','环境监测','/huili/include/home.php?select=ec953999c14b6371ac55241e895de3dc','with-name','icon-flask'),(100000,3,'chlink5','项目验收','/huili/include/home.php?select=58bd73629d7fa3ffdfbca05db2c0be7d','with-name','icon-pagelines'),(100000,8,'chlink10','企业名录','/huili/include/home.php?select=f7b9c1d04ceffa29cc51a3fef6765dad','with-name','icon-book'),(100000,9,'chlink13','环境法规','/huili/include/home.php?select=316e50a2d5dc063522e3b411224e0cb6','with-name','icon-wpforms'),(100000,10,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100002,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100003,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100003,1,'chlink3','环境工程','/huili/include/home.php?select=5cd4814c281bf77cf5272797d9743cf7','with-name','icon-truck'),(100003,2,'chlink4','环境监测','/huili/include/home.php?select=ec953999c14b6371ac55241e895de3dc','with-name','icon-flask'),(100003,3,'chlink5','项目验收','/huili/include/home.php?select=58bd73629d7fa3ffdfbca05db2c0be7d','with-name','icon-pagelines'),(100003,4,'chlink6','清洁生产','/huili/include/home.php?select=5f7139796ec94c73d53e6886885ed21b','with-name','icon-recycle'),(100003,5,'chlink7','危废服务','/huili/include/home.php?select=a54ee8242567c420ac10b19fcbd24cc8','with-name','icon-fire'),(100003,6,'chlink8','应急预案','/huili/include/home.php?select=6b19163b5cd4ae474189d882049cd83d','with-name','icon-calendar-check-o'),(100003,8,'chlink10','企业名录','/huili/include/home.php?select=f7b9c1d04ceffa29cc51a3fef6765dad','with-name','icon-book'),(100004,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100004,1,'chlink3','环境工程','/huili/include/home.php?select=5cd4814c281bf77cf5272797d9743cf7','with-name','icon-truck'),(100007,8,'chlink10','企业名录','/huili/include/home.php?select=f7b9c1d04ceffa29cc51a3fef6765dad','with-name','icon-book'),(100009,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear');
/*!40000 ALTER TABLE `choose` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comp_info`
--

DROP TABLE IF EXISTS `comp_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comp_info` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增量序号',
  `name` varchar(256) NOT NULL COMMENT '企业',
  `tid` varchar(16) NOT NULL COMMENT '行业类别',
  `intro` text NOT NULL COMMENT '企业信息',
  `hpintro` text NOT NULL COMMENT '环评信息',
  `lng` varchar(16) NOT NULL COMMENT '经度',
  `lat` varchar(16) NOT NULL COMMENT '纬度',
  `aid` int(8) unsigned NOT NULL COMMENT '行政区划',
  `aname` varchar(32) NOT NULL COMMENT '地市名',
  PRIMARY KEY (`idx`),
  KEY `name_tid_aid` (`name`(191),`tid`,`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comp_info`
--

LOCK TABLES `comp_info` WRITE;
/*!40000 ALTER TABLE `comp_info` DISABLE KEYS */;
INSERT INTO `comp_info` VALUES (1,'山东鲁岳化工有限公司','a','<p><br></p><table class=\"table table-bordered\"><tbody><tr><td><b>所在地:</b></td><td>山东 泰安</td></tr><tr><td><label>企业类型：</label></td><td>有限责任公司</td></tr><tr><td><label>成立时间：</label></td><td>2001-05-08</td></tr><tr><td><b>主营行业：</b></td><td>橡胶助剂</td></tr><tr><td><label>主营产品：</label></td><td>二氯乙烷,低二氯</td></tr></tbody></table><p><br></p><p>&nbsp;&nbsp;&nbsp; 公司主要生产氯乙烷（含量99.9%、99%）、溶剂稀料，年产量五万吨以上；烯丙基胺（AA）、二烯丙基胺(DAA)、三烯丙基胺(TAA)系列产品，年产量3000吨；二甲基二烯丙基氯化铵（DMDAAC60%、65%）水溶液单体，年生产能力30000吨居国内首位，产品质量达到国际领先水平。该单体的均聚、共聚系列产品20000吨，主要应用于：工业和城市污水、原水及生活用水处理，造纸化学品，纺织印染助剂，油田助剂，日化助剂等行业。我们公司已开发成功珠状聚合物，以适应不同客户的需求，产品性能指标达到世界先进水平，新上3000吨生产线一条。</p><p><br></p>','暂缺','116.6397','36.25516',370900,'泰安'),(2,'山东宝来利来生物工程股份有限公司','a','<p><br></p><table class=\"table table-bordered\"><tbody><tr><td><b>所在地:</b></td><td>山东 泰安</td></tr><tr><td><label>企业类型：</label></td><td>有限责任公司</td></tr><tr><td><label>成立时间：</label></td><td>1996-08-01</td></tr><tr><td><b>主营行业：</b></td><td>饲料添加剂<br></td></tr><tr><td><label>主营产品：</label></td><td>畜禽微生态,饲料</td></tr></tbody></table><p><br></p><p>&nbsp;&nbsp;&nbsp; 1996年8月，宝来利来生物工程股份有限公司诞生于风景秀丽的泰山脚下，17年来，宝来利来矢志不渝地致力于中国的生态养殖与食品安全事业，以自己在动物微生态技术领域的专业优势，为中国的牧场和饲料企业寻求更加健康、更加环保、更加高效的可持续发展之道。如今，宝来利来公司形成了12个专业事业部，并有为基层用户服务的生态养殖技术服务中心和李博士会员连锁店。公司现有生物发酵基地3处，芽孢杆菌、乳酸菌、双歧杆菌的年生产能力已经达到了5万吨，居亚洲领先水平。　<br>　　　宝来利来作为国家重点高新技术企业，为进一步提升公司技术研发的核心能力，集团按国际一流标准设计的生物研究中心达到国际P3水平，建筑面积10200平米，成为宝来利来生物研究院现有150名科技人员“开创生物奇迹”的地方。生物研究院近三年完成了超过300项的科研成果，成为中国动物微生态行业的技术研发之源。生物研究院业已主持和承担了6项国家“863计划”课题，和近5年成功开发的6项“国家重点新产品”，使之真正成为中国动物微生态行业的科技研发高地。</p><p><br></p>','暂缺','117.19285','36.205114',370900,'泰安'),(3,'泰安市嘉叶生物科技有限公司','a','<p><br></p><table class=\"table table-bordered\"><tbody><tr><td><b>所在地:</b></td><td>山东 泰安</td></tr><tr><td><label>企业类型：</label></td><td>个体经营</td></tr><tr><td><label>成立时间：</label></td><td>2016-01-01</td></tr><tr><td><b>主营行业：</b></td><td>有机化工原料<br></td></tr><tr><td><label>主营产品：</label></td><td>化工日化 医药中间体,香精香料 食品添加剂</td></tr></tbody></table><p><br></p><p>&nbsp;&nbsp;&nbsp; 嘉叶生物科技有限公司成立于2016年、公司主要以化学合成、/植物类/日化类/等多类产品。集研发、生产、经营、销售为一体的大型综合性高科技企业。工厂占地面积150亩，拟定兴建的厂房将按GMP标准，厂区内环境整洁，布局合理，拥有大、中型生产车间及其铺助厂房，并配备先进仪器设备的质检和研究中心、为一体的大型综合性高科技企业。嘉业生物科技以质量是生命/服务是灵魂的宗旨/得到了市委市政府的高度评价。<br>公司优势主打产品：仅肉桂系列产品就多达100多种、公司拥有自主进出口权。目前公司均建有大型工厂，在武汉、深圳、珠海、株洲、杭州、南京均建有销售联络点以及大型仓储点，方便货物及时发送到客户手中。公司秉承“顾客至上，锐意进取”的经营理念，坚持“客户第一”质量第一；信誉第一；服务第一；的原则，为广大客户提供优质的服务。质量好/价格优/款到发货/欢迎各界朋友莅临参观、业务洽谈！</p><br>','暂缺','117.5220','36.06955',370900,'泰安'),(4,'山东省泰安市融创新材料','a','<p><br></p><table class=\"table table-bordered\"><tbody><tr><td><b>所在地:</b></td><td>山东 泰安</td></tr><tr><td><label>企业类型：</label></td><td>私营股份有限公司</td></tr><tr><td><label>成立时间：</label></td><td>2001-05-08</td></tr><tr><td><b>主营行业：</b></td><td>塑料板<br></td></tr><tr><td><label>主营产品：</label></td><td>排水板 蓄排水板,土工布 土工膜 植草格</td></tr></tbody></table><p><br></p><p>&nbsp;&nbsp;&nbsp; 泰安市融创新材料有限公司坐落于五岳之首的泰山脚下、是中国建筑防水材料工业协会会员单位。本公司专业从事纳基膨润土防水毯（垫）GCL、复膜膨润土防水毯、塑料防护排水板、生态袋、土工布（聚酯无纺布）、土工膜、复合土工膜、蓄排水板、植草格、养护土工布的开发、生产和销售服务于一体的高新技术企业、本公司产品具有应用领域广、抗老化、使用寿命长、无毒环保等特点。产品广泛应用于民用垃圾填埋场防渗、园林水系、大型景观人工湖、城市河道治理、建筑工程、园林绿化工程、水利工程、交通工程及市政工程等基础工程建设中所需要的增强及加筋材料、城市绿化工程中防渗、过滤、排水用材料、本公司产品具有稳定的产品质量和合理的价格、赢得了广大客户的好评。</p><br>','暂缺','117.0391','35.8867',370900,'泰安'),(5,'山东洛克化工有限公司','a','<p><br></p><table class=\"table table-bordered\"><tbody><tr><td><b>所在地:</b></td><td>山东 济南</td></tr><tr><td><label>企业类型：</label></td><td>私营股份有限公司</td></tr><tr><td><label>成立时间：</label></td><td>2001-05-08</td></tr><tr><td><b>主营行业：</b></td><td>有机化工原料<br></td></tr><tr><td><label>主营产品：</label></td><td>氨基酸</td></tr></tbody></table><p><br></p><p>&nbsp;&nbsp;&nbsp; 山东洛克化工有限公司是一家集研发、生产、供应化工产品于一体的新型化工企业，位于美丽的“泉城”-济南，我公司主要从事新型原料药中间体(特别是碳水化合物系列)的研究，同时在食品、饲料添加剂、化妆品、染料、工业化工等行业取得了巨大的突破，以“诚信”的理念在国内外享有盛誉。多年来，我们与宁夏大学和山东大学合作开发了十多个项目，并在市场上进行了大规模生产。目前，我们的团队有80多人，并在济南和宁霞建立了研究中心。我们的生产地点设在章丘、菏泽、德州和宁夏精细化工园区。在生产过程中遵循ISO9001和ISO 2000标准，我们的实验室和车间严格按照GMP标准，我们的产品畅销欧洲，南美和北美，亚太地区和非洲，我们真诚地欢迎世界各地的新老客户前来洽谈业务。</p><br>','暂缺','116.404','39.915',370100,'济南');
/*!40000 ALTER TABLE `comp_info` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (109,0,0,'中华人民共和国环境保护税法','/huili/documents/doc_001.txt'),(110,0,0,'中华人民共和国水污染防治法（新）','/huili/documents/doc_002.txt'),(111,0,0,'中华人民共和国环境影响评价法（新）','/huili/documents/doc_003.txt'),(112,0,0,'中华人民共和国大气污染防治法','/huili/documents/doc_004.txt'),(113,0,0,'中华人民共和国环境保护法','/huili/documents/doc_005.txt'),(114,0,0,'中华人民共和国环境噪声污染防治法','/huili/documents/doc_006.txt'),(115,0,0,'中华人民共和国固体废物污染环境防治法','/huili/documents/doc_007.txt'),(116,0,0,'中华人民共和国海洋环境保护法','/huili/documents/doc_008.txt'),(117,0,0,'中华人民共和国放射性污染防治法','/huili/documents/doc_009.txt'),(118,0,0,'中华人民共和国清洁生产促进法','/huili/documents/doc_010.txt'),(119,4,0,'地表水环境质量标准','/huili/documents/upload/W020061027509896672057.pdf'),(120,4,0,'地下水质量标准','/huili/documents/upload/W020061027512167894817.pdf'),(121,4,0,'船舶水污染物排放控制标准','/huili/documents/upload/W020180202588383389910.pdf'),(122,4,0,'石油炼制工业污染物排放标准','/huili/documents/upload/W020150506396388086123.pdf'),(123,4,0,'再生铜、铝、铅、锌工业污染物排放标准','/huili/documents/upload/W020150506394069081584.pdf'),(124,4,0,'合成树脂工业污染物排放标准','/huili/documents/upload/W020150506393371746579.pdf'),(125,4,0,'无机化学工业污染物排放标准','/huili/documents/upload/W020150506392976571440.pdf'),(126,4,0,'电池工业污染物排放标准','/huili/documents/upload/W020131231370628347157.pdf'),(127,4,0,'制革及毛皮加工工业水污染物排放标准','/huili/documents/upload/W020131231371216654623.pdf'),(128,4,0,'合成氨工业水污染物排放标准','/huili/documents/upload/W020130325399296105553.pdf'),(129,4,0,'柠檬酸工业水污染物排放标准','/huili/documents/upload/W020130325398701214919.pdf'),(130,4,0,'麻纺工业水污染物排放标准','/huili/documents/upload/W020121116662872696279.pdf'),(131,4,0,'毛纺工业水污染物排放标准','/huili/documents/upload/W020121116662691780085.pdf'),(132,4,0,'缫丝工业水污染物排放标准','/huili/documents/upload/W020121116662510148146.pdf'),(133,4,0,'纺织染整工业水污染物排放标准','/huili/documents/upload/W020121116662298626393.pdf'),(134,4,0,'炼焦化学工业污染物排放标准','/huili/documents/upload/W020120731575526877124.pdf'),(135,4,0,'铁合金工业污染物排放标准','/huili/documents/upload/W020120731574592701490.pdf'),(136,4,0,'钢铁工业水污染物排放标准','/huili/documents/upload/W020120803534456338406.pdf'),(137,4,0,'铁矿采选工业污染物排放标准','/huili/documents/upload/W020120731557686454794.pdf'),(138,4,0,'橡胶制品工业污染物排放标准','/huili/documents/upload/W020120130351570521489.pdf'),(139,4,0,'发酵酒精和白酒工业水污染物排放标准','/huili/documents/upload/W020120130349936381714.pdf'),(140,4,0,'汽车维修业水污染物排放标准','/huili/documents/upload/W020120116383243324013.pdf');
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
INSERT INTO `security` VALUES (100000,'2018-08-30 06:25:21',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-30 06:35:04',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-30 08:40:54',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-30 08:50:59',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-30 08:53:07',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-30 09:23:45',1,'localhost','GNU/linux操作系统','Firefox',0,0),(100000,'2018-08-30 09:26:30',1,'localhost','GNU/linux操作系统','Firefox',0,0);
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
INSERT INTO `talkmsg` VALUES (100000,100003,'2018-07-27 02:02:50','你好，在吗？',0,0,1,0),(100000,100003,'2018-07-27 02:04:50','有事吗？请说',0,1,0,1),(100000,100003,'2018-07-27 02:05:27','有个问题想请教您',0,0,1,0),(100000,100003,'2018-07-27 02:36:47','请说',0,1,0,1),(100000,100003,'2018-07-27 02:38:14','山东省泰安市环境保护局监测站生态监测科田勇',0,1,0,1),(100000,100003,'2018-07-27 03:14:48','关于环评方面的问题请教下',0,0,1,0),(100000,100003,'2018-08-04 12:25:39','你好！有个问题想请教',1,0,26,9),(100000,100003,'2018-08-04 12:32:21','有什么问题？请说吧',1,1,23,10),(100000,100003,'2018-08-04 12:38:28','你们是否承接污水处理设施的运营管理呢？我们的污水处理设施想委托运营。',1,0,24,7),(100000,100003,'2018-08-05 02:03:57','你们具备相关资质吗？',1,0,14,1),(100000,100003,'2018-08-05 02:05:57','有的，我们有污水处理设施甲级运营资质的，并且我们很愿意和您就这个问题进行详谈。',1,1,12,2);
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

-- Dump completed on 2018-08-30 17:30:49
