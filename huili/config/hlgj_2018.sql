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
INSERT INTO `auth` VALUES (100002,'test1@163.com','test1','260be2fecdf89f88eab77128ef7511d3',7,1,0,2,2,0,'2018-07-03 01:57:20','2018-07-07 03:49:31','/huili/images/upload/893837911.jpg'),(100003,'test2@163.com','test2','8d114dfc0aa6cbd20d74a573b9343e86',7,1,0,4,4,0,'2018-07-03 01:57:21','2018-07-26 08:30:03','/huili/images/upload/002S14P1-2.jpg'),(100004,'test3@163.com','test3','ae71aca395893a68edfae00b2502b2ba',7,1,0,2,2,0,'2018-07-03 01:57:21','2018-07-26 07:25:42','/huili/images/upload/0255004244-0.jpg'),(100005,'test4@163.com','test4','294d6d199b92abdc07e6715956c67831',7,1,0,1,1,0,'2018-07-03 01:57:21','2018-07-09 07:59:31','/huili/images/upload/timg2.jpeg'),(100006,'test5@163.com','test5','c198e96271965c83219549c2d8961a9b',7,1,0,1,1,0,'2018-07-05 13:51:03','2018-07-09 08:02:03','/huili/images/upload/aaa1.jpg'),(100007,'test6@163.com','test6','9c56b932f9aad6427aaa43aea215d83d',7,1,0,1,1,0,'2018-07-05 13:51:03','2018-07-10 01:18:24','/huili/images/upload/timg3.jpeg'),(100008,'test7@163.com','test7','1817399417998612cdca4a671771d60a',7,1,0,0,0,0,'2018-07-05 13:51:03','2018-07-05 13:51:03',NULL),(100009,'test8@163.com','test8','bd969170781556ac46fd26fbd3f15e39',7,1,0,1,1,0,'2018-07-05 13:51:03','2018-07-18 07:36:51',NULL),(100010,'test9@163.com','test9','b081fd85802d5708431149c13c6687f5',7,1,0,0,0,0,'2018-07-05 13:54:56','2018-07-05 13:54:56',NULL),(100001,'tybitsfox@163.com','tybitsfox','2694f8b0e3d3d17ff567c9ca072db75c',7,1,0,0,0,0,'2018-07-03 01:37:49','2018-07-03 01:37:49',NULL),(100000,'tyyyyt@163.com','田勇','9a071c40a829eea19b90a5e011d64703',7,1,0,21,21,0,'2018-07-03 01:12:06','2018-08-02 14:13:32','/huili/images/upload/worldcup.jpeg');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES (3,1,'恭贺汇氏管家吉日上线！','田勇','2018-08-02 11:29:25','<p>轻轻的，悄悄的，走进了冬，走近了春，走进了思念，走进了春的期盼里。—题记</p>\r\n<p>　　雪舞一季，梅花三弄，情缘几分，堪那碧空流云，偶尔会意心底;半痴半醉，眷恋飞花，留一方别有洞天，山光水色，锦绣素年，欲以深情相许，静坐雪中，捻字墨纷飞;一片片承载了期望，翩翩起舞，回眸之间，触碰已是凉凉冰雨，已是“</p>\r\n<p>山雨欲来风满楼 ”，萧瑟近邻，忧郁散落一地......</p>\r\n<p>　　“ 谁念西风独自凉，萧萧黄叶闭疏窗。沉思往事立残阳。</p>\r\n<p>特喜欢纳兰的诗词，清丽婉约中，赋予了洁净纯粹的情思;唯美的忧伤，幽幽的相思，串联字里行间，始终如一的情，红尘谁念痴缠，瑟瑟风雪，一纸对白，唯有这墨雨更为明白，挥洒如雨，倾城雪月;再见莞尔，再见时倾国倾城，唯有那一世情长，挥洒清袖，云水清欢看过。</p>\r\n<p>　　冬若是一位多情的诗人，那雪则是诗人的笔墨，梅则是诗人的情，诗人的魂;在这笔灵动中，红梅分外妖娆妩媚，一静一动，给冷色的冬天，一份情韵的画面;柔美百回的感触，茫茫雪海，一页情怀的舟，游弋其中;堪那世间万物，也不过是浮尘烟云，尘埃落定之时，若依旧留守着这份纯粹洁净，那该多好!</p>\r\n<p>　　熟知冷风过，残雪去无处，无人问津，无人提及，短暂的飘雪，离别在即，“ 残雪凝辉冷画屏，落梅横笛已三更，更无人处月胧明。 ”分外清冷，冷漠了视角……</p>\r\n<p>当所有过往，渐变成书页空白，曾经沉寂的绕指柔情，擦肩而过;尝尽百味，陈旧的执念，依旧触及柔情回眸;千百回，那熟悉的味道，依旧千百次裁剪，羽翼唇语;依依回到梦的原乡，重现初始的模样，初开的气息;期许静坐成一星一月，寂静相爱，默然欢喜。</p>\r\n<p>　　梅开一树暖，情染了一季冬天;那一枝红，在霜白染尽里，绽放朵朵痴，瓣瓣的念;白雪皑皑，红舞一厢情怀，洒落了一地情话;而落雪寻梅，梅倾雪;琴萧合鸣，情浓了人间;这浅浅淡淡的相遇，总相宜，总适宜，雪沉静的白如玉，梅温润的红如霞，娇滴妩媚，又寂静无语，无声胜有声，一切都在了然间，都在拈花一笑间!</p><p align=\"center\"><img style=\"width: 650px;\" src=\"/huili/callback/upload/100000_1533209347.jpg\"><br></p>\r\n<p>　　静静拈花不语，雪花洁白在光阴的路上，一片一片，飘落在梅的蕊里，融化在情浓掌心中;而梅红红一抹，轻扣一页捻墨的水镜，落入白白的中央，一点红，画眉点心，轻轻落入眼底，沉落在雪的心里;几分的喜悦，几分柔情，等待来了盈盈一水的温暖，“是你，终于来了”;你若安好，便是晴天，你可知道?</p>\r\n<p>　　冬日里，雪梅唱舞一首冬日恋歌，不问今昔何昔，不问明日何去，遇见了便是缘份的释然;轻轻地，我来了，悄悄我去了，也许曾经是故去的荷，无意的一瞥，粉红了记忆的衣裳，朦胧了月色的面纱;红粉色印迹，会意山水相知，编织水瘦山寒的梦想，解语爱的刻骨;洁净了四季的轩窗，在红泥小炉，温下暖暖的情。</p>\r\n<p>　　温和笔下的痴缠，柔润眉眼里静谧的光阴;有水，有山，山水一色，一程又一程，情浓重彩，勾勒一幅暖阳的冬;洁净的雪，红艳的梅，红红火火，欢欢喜喜一场;静默这一纸对白，</p>\r\n<p>即便雪鬓霜鬟，也依旧用柔情绰态、袅袅娉娉的美好，留存笔触，与光阴对酌;静静地在蔓草荒烟上，让草木葳蕤，让即将荒芜的记忆，捻香暖心!</p>\r\n<p>　　唱一首冬天的歌谣，轻轻地，慢慢地，走在漫天皆白、皑皑白雪中，走在红梅恋雪，倾城倾雪里;此时花情脉脉，温暖徐徐!</p>',100000,1,0,0),(4,1,'十三届全国人大常委会第四次会议在京举行','田勇','2018-08-02 11:35:41','<p>新华社北京7月9日电  十三届全国人大常委会第四次会议9日上午在北京人民大会堂举行。<strong>栗战书委员长主持会议并作全国人大常委会执法检查组关于检查大气污染防治法实施情况的报告。</strong></p><p align=\"center\"><img style=\"width: 900px;\" src=\"/huili/callback/upload/100000_1533209730.jpg\"><strong><br></strong></p>\r\n\r\n<p>常委会组成人员167人出席会议，出席人数符合法定人数。</p>\r\n\r\n<p>栗战书在作报告时说，党的十八大以来，以习近平同志为核心的党中央高度重视生态文明建设，提出一系列重大战略思想，作出一系列重大决策部署，坚决向污染宣战，力度之大、措施之实、成效之明显，前所未有。围绕党中央决策部署和习近平总书记关于打好污染防治攻坚战的指示要求，5月至6月，全国人大常委会大气污染防治法执法检查组分赴8个省区开展检查，同时委托23个省区市人大常委会开展自查，实现了执法检查全覆盖。从法律实施的总体情况看，全社会生态环境保护的意识明显增强，大气污染防治的法治保障进一步强化，依法推进大气污染治理工作力度不断加大，但还存在结构性污染问题较为突出、部分配套法规和标准制定工作滞后、大气污染监督管理制度落实不到位、重点领域大气污染防治措施执行不够有力、执法监管和司法保障有待加强、法律责任不落实等主要问题。</p>\r\n\r\n<p>栗战书指出，打赢蓝天保卫战是打好污染防治攻坚战的重中之重，时间紧、任务重、难度大。要在以习近平同志为核心的党中央坚强领导下，以习近平生态文明思想为方向指引和根本遵循，全面有效实施大气污染防治法，加快制定配套法规规章和标准，加强对法律实施的监督，进一步强化科技支撑，坚持以法律的武器治理污染，用法治的力量保卫蓝天，为提升生态文明，决胜全面建成小康社会、建设美丽中国作出贡献。</p>\r\n\r\n<p>为深入学习贯彻习近平新时代中国特色社会主义思想和党的十九大精神，决胜全面建成小康社会，全面加强生态环境保护，打好污染防治攻坚战，提升生态文明，建设美丽中国，全国人大环境与资源保护委员会提出了关于提请审议全国人大常委会关于全面加强生态环境保护依法推动打好污染防治攻坚战的决议草案的议案。环境与资源委员会主任委员高虎城作了说明。&lt;.p&gt;\r\n\r\n</p><p>全国人大常委会副委员长王晨、曹建明、张春贤、沈跃跃、吉炳轩、艾力更·依明巴海、万鄂湘、陈竺、王东明、白玛赤林、丁仲礼、郝明金、蔡达峰、武维华，秘书长杨振武出席会议。</p>\r\n\r\n<p>国务委员王勇，最高人民法院院长周强，最高人民检察院检察长张军，国家监察委员会负责人，全国人大各专门委员会成员，各省（区、市）人大常委会负责人，部分全国人大代表等列席会议。</p>\r\n\r\n',100000,1,0,0),(5,1,'省环保厅举行两法启动仪','田勇','2018-08-02 12:14:56','<p align=\"center\"><img src=\"/huili/callback/upload/100000_1533211880.jpg\" width=\"742\" height=\"462\"></p><h5 align=\"left\"><br></h5><p>省环保厅举行《山东省环境保护厅群众反映和监控发现的环境污染问题整改落实情况随机抽查办法》和《山东省排污许可制执行情况监督检查办法》 启动仪式。</p><p></p><p>为深入贯彻落实党的十九大精神，确保人民群众通过各种渠道反映和监控发现的环境污染问题整改落实到位，强化排污单位治污主体责任，推动我省排污许可制工作深入开展，7月6日，省环保厅举行《山东省环境保护厅群众反映和监控发现的环境污染问题整改落实情况随机抽查办法》和《山东省排污许可制执行情况监督检查办法》启动仪式。省环保厅党组成员、副厅长姚云辉出席仪式并讲话。启动仪式由省环境监察总队总队长齐鑫山主持，省环保厅相关处室、直属单位负责同志、省环境监察总队全体人员参加启动仪式。山东卫视、中环报山东记者站、人民网、山东交通广播、山东环境网等新闻媒体记者应邀参加。</p>\r\n<p>启动仪式设置摇号员1名、监督员3名，由摇号员对2018年第二季度686件群众反映和监控发现的环境污染案件、2361家已核发排污许可证企业和执法人员按比例进行了随机抽取，由3名监督员对抽取全过程进行监督，并对随机抽取的检查对象和执法人员名单进行封存、签字。姚云辉副厅长对检查对象名单和执法人员名单进行了审签，并向执法人员代表发放了任务单。</p>\r\n<p>启动仪式上，姚云辉副厅长对如何做好、做实二个《办法》提出了明确要求：一是切实提高认识，做好安排部署。充分认识实施二个《办法》的重要性、艰巨性和长期性，必须从讲政治、讲大局、讲规矩的高度把握环境保护的新形势、新变化、新要求，科学调整工作思路，统筹安排各项工作任务，确保二个《办法》顺利实施。二是明确职责分工，抓好工作落实。省厅各处室（单位）要切实负起责任，按照各自职责分工，做好随机抽查数据库的建立、分类填报、管理和现场检查工作。要层层传导压力，敢于动真碰硬，严格责任追究，做到既查事又查人。三是规范工作程序，严守工作纪律。现场检查必须采取独立调查的方式进行，必须使用移动执法系统。严格遵守“八项规定”等纪律要求，廉洁执法、文明执法，不断增强行动自觉。严禁向被抽查企业通风报信；严禁事先通知被抽查企业所在地政府和有关部门；严禁自我消化，大事化小，小事化了；严禁敷衍了事、弄虚作假；严禁包庇、纵容、袒护环境违法问题。四是做好信息公开，接受社会监督。切实增强公众的环境知情权，充分利用各种新闻媒体，将每季度随机抽查工作情况和排污许可制检查情况向社会公开，主动接受社会监督，进一步提升环境保护部门的公信力。</p>\r\n<p>启动仪式结束后， 3个随机抽查工作组分别由一名处级干部带队，奔赴各市进行现场检查，新闻媒体记者随队报道。</p>',100000,1,0,0),(6,1,'山东发布2018上半年全省环境质量状况','田勇','2018-08-02 12:20:55','<p align=\"center\"><img src=\"/huili/callback/upload/100000_1533212384.jpg\" width=\"682\" height=\"567\"></p><h5 align=\"left\"><br></h5><p>7月25日，省政府新闻办举行新闻发布会，邀请省环保厅巡视员葛为砚通报了2018年上半年全省环境质量状况及中央环保督察反馈意见整改落实相关工作进展情况。</p><p>2018年，山东有史以来规模最大、规格最高的全省生态环境保护大会暨“四减四增”三年行动动员大会隆重召开，动员全省力量，以更大决心和力度，坚决打好污染防治攻坚战。上半年，全省环保系统积极推进中央环保督察反馈意见整改，坚决打赢污染防治攻坚战，各项工作扎实有序开展，水气环境质量持续改善。</p><p>上半年，全省细颗粒物（PM2.5）平均浓度为55μg/m3，同比下降15.4%；可吸入颗粒物（PM10）平均浓度为108μg/m3，同比下降10.0%；二氧化硫（SO2）平均浓度为18μg/m3，同比下降40.0%；二氧化氮（NO2）平均浓度为35μg/m3，同比下降7.9%；重污染天数平均为6.1天，同比减少5.6天；环境空气质量综合指数平均为5.95，同比下降11.9%；优良率平均为53.7%，同比增加2.1个百分点。</p><p>生态补偿考核结果显示，上半年，省级财政共补偿各市资金28995万元，聊城市获得生态补偿资金最多，为2824万元；潍坊市上缴省级资金80万元。</p><p>上半年，《水污染防治行动计划》(即“水十条”)确定的国控地表水断面水质优良（Ⅰ-Ⅲ类）比例为59.0%，达到并优于年度约束性指标要求2.4个百分点，较去年同期持平；劣五类水体控制比例为4.8%，达到并优于年度约束性指标要求2.4个百分点，较去年同期下降7.2个百分点。全省52个地级及以上城市集中式饮用水水源地中，有51个水质达到或优于Ⅲ类标准，达标率为98.1%，符合年度目标要求。全省17市城市建成区的165个黑臭水体中，155个已整治完成，总体整治完成率为93.9%，超额完成年度任务。</p><p>环保执法方面，上半年全省环保部门实施处罚环境违法案件8597件，罚款4.39亿元，其中，实施按日连续处罚案件21件,罚款3349.28万元；实施查封、扣押案件66件；实施限制生产、停产整治案件28件；移送适用行政拘留环境违法案件285件；移送涉嫌环境污染犯罪案件81件。</p><p>中央第三环境保护督察组向我省反馈意见后，全省各级各部门迅速行动，落实整改方案，压实工作责任，全面推进督察反馈问题整改工作。截至7月15日，我省根据督察反馈意见细化分解的主要问题，已完成23项，其余任务正全力推进。下一步，对未达到序时进度、整改质量不高的单位，将启动督办、问责程序。</p><p>省环保厅相关处室主要负责人参加发布会并围绕近期环保重点工作进行回应和解读。新闻发布会由省政府新闻办事业处处长丁绍敏主持。中央驻鲁新闻单位、香港新闻媒体驻鲁分支机构、省直及济南市主要新闻单位的记者参加。</p>',100000,1,0,0);
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
INSERT INTO `choose` VALUES (100000,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100000,1,'chlink3','环境工程','/huili/include/home.php?select=5cd4814c281bf77cf5272797d9743cf7','with-name','icon-truck'),(100000,2,'chlink4','环境监测','/huili/include/home.php?select=ec953999c14b6371ac55241e895de3dc','with-name','icon-flask'),(100000,3,'chlink5','项目验收','/huili/include/home.php?select=58bd73629d7fa3ffdfbca05db2c0be7d','with-name','icon-pagelines'),(100000,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100000,15,'chlink17','交流互动','/huili/include/home.php?select=749ab3b68632680660d776891751e812','with-name','icon-cchat'),(100002,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100002,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100003,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100003,1,'chlink3','环境工程','/huili/include/home.php?select=5cd4814c281bf77cf5272797d9743cf7','with-name','icon-truck'),(100003,12,'chlink14','资料下载','/huili/include/home.php?select=f3f7bacf6f435e7aa6391b1d9e2846b4','with-name','icon-download'),(100003,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100004,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100004,1,'chlink3','环境工程','/huili/include/home.php?select=5cd4814c281bf77cf5272797d9743cf7','with-name','icon-truck'),(100009,0,'chlink2','环评咨询','/huili/include/home.php?select=1f9663b32af87ecdd1c19ef047309f44','with-name','icon-gear'),(100009,13,'chlink15','专家团队','/huili/include/home.php?select=6a2d41d1162de70c080291760c4b0974','with-name','icon-group'),(100009,14,'chlink16','监控平台','/huili/include/home.php?select=03142410d7285f00e4363e005783c83a','with-name','icon-desktop');
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
INSERT INTO `security` VALUES (100000,'2018-08-02 00:59:51',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100003,'2018-08-02 01:08:15',1,'192.168.101.158','Android系统','Chrome',0,0),(100003,'2018-08-02 01:11:30',1,'192.168.101.158','Android系统','Chrome',0,0),(100003,'2018-08-02 02:46:29',1,'192.168.101.158','Android系统','Chrome',0,0),(100000,'2018-08-02 02:49:34',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 02:53:16',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 02:54:25',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:01:16',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:02:08',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:09:43',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:11:15',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:41:34',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:45:12',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 03:48:15',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 05:02:43',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 05:29:45',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 05:31:14',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 05:41:18',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 05:56:17',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 11:26:04',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 12:10:37',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 12:19:11',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 12:24:09',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 12:29:13',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 13:52:43',1,'localhost','GNU/linux操作系统','Firefox',1,7),(100000,'2018-08-02 14:13:25',1,'192.168.1.102','Android系统','Chrome',0,0);
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
INSERT INTO `talkmsg` VALUES (100000,100003,'2018-07-27 02:02:50','你好，在吗？',0,0,1,0),(100000,100003,'2018-07-27 02:04:50','有事吗？请说',0,1,0,1),(100000,100003,'2018-07-27 02:05:27','有个问题想请教您',0,0,1,0),(100000,100003,'2018-07-27 02:36:47','请说',0,1,0,1),(100000,100003,'2018-07-27 02:38:14','山东省泰安市环境保护局监测站生态监测科田勇',0,1,0,1),(100000,100003,'2018-07-27 03:14:48','关于环评方面的问题请教下',0,0,1,0);
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

-- Dump completed on 2018-08-02 22:19:02
