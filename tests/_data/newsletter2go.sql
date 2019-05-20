# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.26)
# Database: newsletter2go
# Generation Time: 2019-05-20 06:45:44 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


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
	(1,'Test User','test@test.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(2,'Skye Kautzer','lexie43@ortiz.biz','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(3,'Eileen Reichel','wcremin@heidenreich.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(4,'George Nienow','aileen.heaney@gmail.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(5,'Nova Ullrich II','letitia66@rosenbaum.net','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(6,'Conner Grant Jr.','susan05@gmail.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(7,'Tiara Haag','hauck.mikayla@hotmail.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(8,'Prof. Tre Hahn','rbogisich@yahoo.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(9,'Jeremie Koch I','cummings.kip@mayert.net','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(10,'Mrs. Ernestine Lind V','chad05@walter.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(11,'Luella Raynor','wgraham@yahoo.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(12,'Aditya Grady','lbednar@lehner.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(13,'Elnora Padberg DDS','emelie68@marvin.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(14,'Margarita Breitenberg','vthompson@yahoo.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(15,'Dr. Pete Franecki','irunolfsdottir@considine.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(16,'Marlene Zemlak','angus.rempel@rowe.org','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(17,'Prof. Hilbert Armstrong Jr.','ghyatt@cartwright.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(18,'Mr. Trevion Strosin V','eleazar.cormier@damore.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(19,'Dr. Raina Miller','ehermann@yahoo.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(20,'Dr. Maria Bernier V','sage94@gmail.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(21,'Jon Gottlieb','reinhold51@gleichner.biz','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(22,'Casimir Larkin','goodwin.mohammad@yahoo.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(23,'Mohammad Romaguera','rstiedemann@champlin.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(24,'Eugene Glover PhD','noel62@rath.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(25,'Ryder Langosh','wehner.broderick@maggio.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(26,'Edd Schmidt','stark.gerard@witting.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(27,'Prof. Keyon Lesch V','scarter@gmail.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(28,'Ms. Santina Becker','chet.walter@hermiston.biz','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(29,'Koby Herman','demetris32@white.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL),
	(30,'Jovany Littel','watsica.velda@skiles.com','2019-05-20 06:43:41','2019-05-20 06:43:41',NULL);

/*!40000 ALTER TABLE `recipients` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table special_offers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `special_offers`;

CREATE TABLE `special_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `expiration_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table voucher_codes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `voucher_codes`;

CREATE TABLE `voucher_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `special_offer_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `used_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `special_offer_id` (`special_offer_id`),
  KEY `recipient_id` (`recipient_id`),
  CONSTRAINT `voucher_codes_ibfk_1` FOREIGN KEY (`special_offer_id`) REFERENCES `special_offers` (`id`),
  CONSTRAINT `voucher_codes_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `recipients` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
