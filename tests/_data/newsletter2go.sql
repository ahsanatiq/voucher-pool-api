# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.26)
# Database: newsletter2go
# Generation Time: 2019-05-21 23:18:00 +0000
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
  `name` varchar(100) NOT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `expire_at` date NOT NULL,
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
	(20190520052531,'databaseCreateRecipients','2019-05-21 23:08:37','2019-05-21 23:08:37',0),
	(20190520052601,'databaseCreateOffers','2019-05-21 23:14:26','2019-05-21 23:14:26',0),
	(20190520052618,'databaseCreateVouchers','2019-05-21 23:14:26','2019-05-21 23:14:26',0);

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `recipients` WRITE;
/*!40000 ALTER TABLE `recipients` DISABLE KEYS */;

INSERT INTO `recipients` (`id`, `name`, `email`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Test User','test@test.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(2,'Anissa Gerhold','rebekah44@altenwerth.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(3,'Dr. Antonietta Durgan','quitzon.george@gmail.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(4,'Mr. Greg Koss','awilkinson@jenkins.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(5,'Francis Strosin MD','jaron.west@hotmail.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(6,'Abigail Murray','fkris@romaguera.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(7,'Candida Boyer','gemmerich@yahoo.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(8,'Bernhard Ernser Jr.','dwitting@hotmail.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(9,'Pamela Goodwin','stoltenberg.giovani@von.org','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(10,'Alek Spencer','fbailey@purdy.biz','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(11,'Theodore Lynch','grant.joe@yost.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(12,'Jerel Boyer','icarroll@jones.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(13,'Dusty West','vabshire@bruen.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(14,'Rodrick Bruen','orlando27@bergstrom.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(15,'Carlie Greenholt','ronny04@hotmail.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(16,'Leila Little','adella25@gmail.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(17,'Bryce Durgan','keeling.carter@gaylord.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(18,'Jayme Mohr DVM','kathlyn.schiller@gulgowski.info','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(19,'Dr. Jennings Collier IV','keenan.king@wisozk.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(20,'Betty Tillman','vidal59@gmail.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(21,'Owen Rempel','aniyah.luettgen@willms.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(22,'Bruce Harvey','ari62@bauch.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(23,'Joelle Roob','liam.keebler@harvey.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(24,'Loren Moore III','larson.javonte@yahoo.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(25,'Prof. Jayden Davis','estella14@emmerich.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(26,'Dr. Murray Nienow MD','broderick.moen@feeney.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(27,'Julian Raynor DVM','sturner@hilpert.com','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(28,'Shawna Sipes DVM','malvina74@bailey.info','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(29,'Mattie Braun IV','devan.nolan@damore.net','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL),
	(30,'Maurine Huels','yvette.volkman@okeefe.net','2019-05-21 23:15:15','2019-05-21 23:15:15',NULL);

/*!40000 ALTER TABLE `recipients` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table used_vouchers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `used_vouchers`;

CREATE TABLE `used_vouchers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipient_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `used_code` char(7) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_used_code` (`used_code`),
  KEY `offer_id` (`offer_id`),
  KEY `recipient_id` (`recipient_id`),
  CONSTRAINT `used_vouchers_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`),
  CONSTRAINT `used_vouchers_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `recipients` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
