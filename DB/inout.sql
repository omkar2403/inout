# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.25)
# Database: inout
# Generation Time: 2019-09-09 13:49:54 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table inout
# ------------------------------------------------------------

DROP TABLE IF EXISTS `inout`;

CREATE TABLE `inout` (
  `sl` int(50) NOT NULL,
  `cardnumber` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `entry` time NOT NULL,
  `exit` time NOT NULL DEFAULT '00:00:00',
  `status` varchar(10) NOT NULL,
  `loc` varchar(30) NOT NULL DEFAULT '',
  `cc` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`sl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table loc
# ------------------------------------------------------------

DROP TABLE IF EXISTS `loc`;

CREATE TABLE `loc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loc` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `edate` varchar(20) NOT NULL,
  `nhead` varchar(50) NOT NULL,
  `nbody` varchar(600) NOT NULL,
  `nfoot` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `loc` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) NOT NULL,
  `rname` varchar(30) NOT NULL,
  `rdesc` varchar(100) NOT NULL,
  `acc_code` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rname` (`rname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `rname`, `rdesc`, `acc_code`)
VALUES
	(1,'Master','Superuser','INDEX;S01;A02;R01;N01;R01;'),
	(2,'User','User Dashboard','U02;'),
	(3,'Admin','Admin ','INDEX;R01;U02;U03;');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table setup
# ------------------------------------------------------------

DROP TABLE IF EXISTS `setup`;

CREATE TABLE `setup` (
  `var` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `setup` WRITE;
/*!40000 ALTER TABLE `setup` DISABLE KEYS */;

INSERT INTO `setup` (`var`, `value`)
VALUES
	('cname','In Out Management System'),
	('libtime','20:30:00');

/*!40000 ALTER TABLE `setup` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tmp1
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tmp1`;

CREATE TABLE `tmp1` (
  `date` date NOT NULL,
  `secs` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table tmp2
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tmp2`;

CREATE TABLE `tmp2` (
  `usn` varchar(30) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `role` int(10) NOT NULL,
  `active` int(2) NOT NULL,
  `llogin` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `fname`, `pass`, `role`, `active`, `llogin`)
VALUES
	(1,'master','Superuser','8e67bb26b358e2ed20fe552ed6fb832f397a507d',1,1,'18/10/2018 09:10 AM'),
	(2,'admin','Administrator','00299a408dc3498a3cd7bae6db588f3324654d76',3,1,'18/10/2018 09:10 AM'),
	(3,'user','User','7c4a8d09ca3762af61e59520943dc26494f8941b',2,1,'07/09/2019 23:09 PM');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
