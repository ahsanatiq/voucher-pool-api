# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.26)
# Database: newsletter2go
# Generation Time: 2019-05-22 04:13:15 +0000
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
	(20190520052531,'databaseCreateRecipients','2019-05-22 04:12:39','2019-05-22 04:12:39',0),
	(20190520052601,'databaseCreateOffers','2019-05-22 04:12:39','2019-05-22 04:12:39',0),
	(20190520052618,'databaseCreateVouchers','2019-05-22 04:12:39','2019-05-22 04:12:40',0);

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
	(1,'Test User','test@test.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(2,'Ryder Stokes','paris.okuneva@koelpin.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(3,'Manuela Brown','shemar.lynch@murphy.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(4,'Prof. Eli Mante','huel.michele@gmail.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(5,'Mrs. Thelma Wolff','stone39@hotmail.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(6,'Dr. Anthony Kunze Sr.','wiegand.ashly@hotmail.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(7,'Effie Kilback II','rskiles@gmail.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(8,'Kiana Feeney','rowan.feil@gmail.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(9,'Zelma Blanda DDS','keagan.mckenzie@mclaughlin.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(10,'Prof. Jerry Senger','stracke.mckayla@ankunding.biz','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(11,'Dr. Lina Haag','hollis.bahringer@hotmail.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(12,'Maud Greenholt','alycia.zemlak@gmail.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(13,'Mrs. Elsa Batz','kay.wisozk@hotmail.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(14,'Dr. Micah Koepp','armstrong.rhoda@yahoo.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(15,'Miss Elta Smith','nettie33@hodkiewicz.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(16,'Deangelo Stoltenberg','amara.buckridge@hotmail.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(17,'Cesar Green','oral19@gmail.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(18,'Elton Wolf DDS','waelchi.claud@braun.info','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(19,'Christelle Raynor','oran15@yahoo.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(20,'Dr. Gabriella Kuvalis','lindgren.mina@hotmail.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(21,'Althea Dickinson','layne00@yahoo.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(22,'Dr. Austin Reinger DVM','mwunsch@shields.info','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(23,'Friedrich Kautzer Jr.','dannie.bednar@stracke.info','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(24,'Lonie Fisher DVM','ghoppe@yahoo.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(25,'Griffin Jakubowski','beryl94@skiles.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(26,'Elza O\'Conner','eddie29@hotmail.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(27,'Grayce Lebsack PhD','lklein@bosco.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(28,'Addie Leannon','king.tabitha@jerde.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(29,'Dr. Alda Wisoky','glenda.schamberger@gmail.com','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL),
	(30,'Lela Russel','schmidt.diego@sanford.info','2019-05-22 04:12:46','2019-05-22 04:12:46',NULL);

/*!40000 ALTER TABLE `recipients` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table used_vouchers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `used_vouchers`;

CREATE TABLE `used_vouchers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipient_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `used_code` char(8) NOT NULL,
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
