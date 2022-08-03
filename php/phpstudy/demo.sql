# Host: localhost  (Version: 5.7.26)
# Date: 2022-03-22 21:41:32
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "admin"
#

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(10) NOT NULL COMMENT 'id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '名称',
  `crity` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '城市',
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '邮编',
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "admin"
#

/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'张三','南海','100001','http://localhost/phpmysql/upload/v2-5b2acfdc5960f511fb0a31b2f5f6ba61_r.jpg'),(2,'王五','广州','500011','http://localhost/phpmysql/upload/v2-5b54785f7236548d1646709af8e03bff_r.jpg'),(3,'刘六','北京','5000111','http://localhost/phpmysql/upload/v2-2a587311d8a98c5c58312d9007cbfc77_r.jpg'),(4,'守护之境中央后台','南海','500011','http://localhost/phpmysql/upload/v2-5b2acfdc5960f511fb0a31b2f5f6ba61_r.jpg'),(5,'王五','广州','554041','http://localhost/phpmysql/upload/v2-5c996a1c6970df010839ed4418bc2d0e_r.jpg'),(6,'武大郎','上海','100001','http://localhost/phpmysql/upload/v2-491f9fbe3bc6da6d81479261ca3e7490_r.jpg'),(7,'孙悟空','花果山','10040','http://localhost/phpmysql/upload/v2-a5075afc76d5ad311987267a2e5bf559_r.jpg'),(8,'猪八戒','高老庄','500011','http://localhost/phpmysql/upload/v2-05bc06d120eec9a1fec1564ead6e8f96_r.jpg'),(9,'沙和尚','流沙河','500011','http://localhost/phpmysql/upload/v2-5c996a1c6970df010839ed4418bc2d0e_r.jpg'),(10,'唐曾','东土大唐','500011','http://localhost/phpmysql/upload/v2-5b2acfdc5960f511fb0a31b2f5f6ba61_r.jpg'),(11,'张三','华盛顿','500011','http://localhost/phpmysql/upload/v2-04cc28f189b7e74c616545106a156c2d_r.jpg'),(12,'玉皇大帝','南天门','100001','http://localhost/phpmysql/upload/v2-90fdbab63498c70b64afc67ddc295b20_r.jpg'),(13,'如来佛祖','凌霄宝殿','500011','http://localhost/phpmysql/upload/v2-3d644df0340051c10f49a98d2d375af5_r.jpg'),(14,'武松','西门口','100001','http://localhost/phpmysql/upload/v2-491f9fbe3bc6da6d81479261ca3e7490_r.jpg');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

#
# Structure for table "think_data"
#

DROP TABLE IF EXISTS `think_data`;
CREATE TABLE `think_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '名称',
  `status` tinyint(2) DEFAULT NULL COMMENT '状态',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '标题',
  `age` int(11) DEFAULT NULL COMMENT '年龄',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Data for table "think_data"
#

/*!40000 ALTER TABLE `think_data` DISABLE KEYS */;
INSERT INTO `think_data` VALUES (8,'潘金莲爱二郎',1,'水浒传11',NULL,NULL),(14,'小王',1,NULL,NULL,NULL),(16,'小丽',1,NULL,NULL,NULL),(17,'小王',1,NULL,NULL,NULL),(18,'小明',0,NULL,NULL,NULL),(19,'小明',NULL,NULL,NULL,NULL),(20,'world',1,'世界你好！',NULL,NULL),(21,'world',1,'世界你好！',NULL,NULL),(22,'world',1,'世界你好！',NULL,NULL),(23,'world',NULL,NULL,NULL,NULL),(24,'world',NULL,NULL,NULL,NULL),(25,'world',NULL,NULL,NULL,NULL),(27,'你是真的狗',NULL,NULL,NULL,NULL),(28,'world',NULL,NULL,NULL,NULL),(38,'world',NULL,NULL,NULL,NULL),(39,'铁扇公主战猴子',1,NULL,NULL,NULL),(40,'铁扇公主战猴子2',1,NULL,NULL,NULL),(41,'铁扇公主战猴子3',0,NULL,NULL,NULL),(42,'铁扇公主战猴子',1,NULL,NULL,NULL),(43,'铁扇公主战猴子2',1,NULL,NULL,NULL),(44,'铁扇公主战猴子3',0,NULL,NULL,NULL),(45,'铁扇公主战猴子',1,NULL,NULL,NULL),(46,'铁扇公主战猴子2',1,NULL,NULL,NULL),(47,'铁扇公主战猴子3',0,NULL,NULL,NULL),(48,'铁扇公主战猴子',1,NULL,NULL,NULL),(49,'铁扇公主战猴子2',1,NULL,NULL,NULL),(50,'铁扇公主战猴子3',0,NULL,NULL,NULL),(51,'铁扇公主战猴子',1,NULL,NULL,NULL),(52,'铁扇公主战猴子2',1,NULL,NULL,NULL),(53,'铁扇公主战猴子3',0,NULL,NULL,NULL),(54,'刘大妈的看门狗',2,'一条好狗的故事',55,1639101079);
/*!40000 ALTER TABLE `think_data` ENABLE KEYS */;

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `creation_time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

#
# Data for table "user"
#

INSERT INTO `user` VALUES (66,'123456','e10adc3949ba59abbe56e057f20f883e','1642474124');
