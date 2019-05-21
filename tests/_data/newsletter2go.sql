# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.26)
# Database: newsletter2go
# Generation Time: 2019-05-21 01:29:47 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table offers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `offers`;

CREATE TABLE `offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `expiration_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table phinxlog
# ------------------------------------------------------------

DROP TABLE IF EXISTS `phinxlog`;

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `phinxlog` WRITE;
/*!40000 ALTER TABLE `phinxlog` DISABLE KEYS */;

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`)
VALUES
	(20190520052531,'databaseCreateRecipients','2019-05-20 22:53:02','2019-05-20 22:53:02',0),
	(20190520052601,'databaseCreateOffers','2019-05-20 22:53:02','2019-05-20 22:53:02',0),
	(20190520052618,'databaseCreateVouchers','2019-05-20 22:53:02','2019-05-20 22:53:03',0);

/*!40000 ALTER TABLE `phinxlog` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table recipients
# ------------------------------------------------------------

DROP TABLE IF EXISTS `recipients`;

CREATE TABLE `recipients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `recipients` WRITE;
/*!40000 ALTER TABLE `recipients` DISABLE KEYS */;

INSERT INTO `recipients` (`id`, `name`, `email`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Test User','test@test.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(2,'Natasha Howe','raquel12@morar.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(3,'Esperanza Hills','jesse25@gmail.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(4,'Prof. Erick Vandervort DDS','barton57@bartoletti.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(5,'Krystal Bauch','kyla.lueilwitz@mcdermott.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(6,'Stephany Nitzsche','weissnat.georgianna@rohan.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(7,'Alvera Pagac','sauer.marco@hoeger.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(8,'Nedra Borer','logan87@hackett.net','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(9,'Freddie Hoppe','andrew.paucek@hotmail.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(10,'Mr. Rocky Lindgren IV','mnolan@sipes.info','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(11,'Melany Koch','fabiola.sporer@hotmail.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(12,'Marcos Corkery','ohermiston@towne.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(13,'Estell Trantow','wlang@gmail.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(14,'Levi Boyer','florencio82@stamm.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(15,'Roma Greenfelder','esther.russel@gmail.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(16,'Rosario Steuber','torphy.filomena@mann.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(17,'Hudson Orn','winifred.hermiston@parisian.net','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(18,'Kade Schuppe II','cortez.bechtelar@hahn.info','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(19,'Josie Sauer','cary34@durgan.org','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(20,'Mrs. Kristin Jerde','koelpin.kaylee@murphy.net','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(21,'Abe Cremin','mathias23@oberbrunner.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(22,'Prof. Hilario Hodkiewicz Sr.','montana.konopelski@kunde.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(23,'Enoch Rice','boris.reynolds@daugherty.org','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(24,'Alaina Harvey','carley99@yahoo.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(25,'Karli Abbott','velma73@dach.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(26,'Candido Larson','jacobson.kenyon@brekke.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(27,'Myles O\'Connell','colin90@yahoo.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(28,'Dr. Sim Hickle II','kallie.yost@gaylord.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(29,'Adriel Bechtelar','carmelo.west@yahoo.com','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL),
	(30,'Gilberto Beer','ivory.wiza@wyman.info','2019-05-21 00:15:53','2019-05-21 00:15:53',NULL);

/*!40000 ALTER TABLE `recipients` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table vouchers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vouchers`;

CREATE TABLE `vouchers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipient_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `used_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offer_id` (`offer_id`),
  KEY `recipient_id` (`recipient_id`),
  CONSTRAINT `vouchers_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`),
  CONSTRAINT `vouchers_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `recipients` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
