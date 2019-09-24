/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.1.37-MariaDB : Database - sway
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sway` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `sway`;

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `page` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `menu` */

insert  into `menu`(`id`,`name`,`page`) values 
(1,'Home',''),
(2,'Register','?page=register'),
(3,'Help','?page=help');

/*Table structure for table `module` */

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'module id',
  `m_name` varchar(25) DEFAULT NULL COMMENT 'module name',
  `m_enabled` tinyint(1) DEFAULT '0' COMMENT 'is enabled?',
  `m_position` tinyint(5) DEFAULT '1',
  `m_alignment` varchar(6) DEFAULT NULL,
  `m_link` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `module` */

insert  into `module`(`m_id`,`m_name`,`m_enabled`,`m_position`,`m_alignment`,`m_link`) values 
(1,'Account',1,1,'right','modules/account.php'),
(2,'Navigation',1,1,'left','modules/navigation.php'),
(3,'Visitors',1,2,'left','modules/visitors.php');

/*Table structure for table `motd` */

DROP TABLE IF EXISTS `motd`;

CREATE TABLE `motd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(150) DEFAULT 'Empty',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `motd` */

/*Table structure for table `news` */

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postdate` varchar(50) NOT NULL,
  `author` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `news` blob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `news` */

insert  into `news`(`id`,`postdate`,`author`,`title`,`news`) values 
(1,'01/31/2010','Furt','SwayCMS','SwayCMS is a php content management system designed use with emulators such as : TrinityCore, MaNGOS, ArcEMU. Even if u dont want to use it with a emulator the core has a built in account system so the CMS can be independantly ran.<br />\r\n<br />\r\nWe are currently in alpha stages of development and changes are constant.');

/*Table structure for table `serverlist` */

DROP TABLE IF EXISTS `serverlist`;

CREATE TABLE `serverlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_name` varchar(50) NOT NULL,
  `mysql_host` varchar(50) NOT NULL,
  `mysql_user` varchar(50) NOT NULL,
  `mysql_pass` varchar(50) NOT NULL,
  `character_db` varchar(50) NOT NULL,
  `world_db` varchar(50) NOT NULL,
  `auth_db` varchar(50) NOT NULL,
  `player_cap` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `serverlist` */

/*Table structure for table `staff` */

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `rank` tinyint(5) NOT NULL,
  `name` varchar(24) NOT NULL,
  `location` varchar(24) NOT NULL,
  `age` tinyint(3) NOT NULL,
  `information` text CHARACTER SET latin1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `staff` */

/*Table structure for table `user_extend` */

DROP TABLE IF EXISTS `user_extend`;

CREATE TABLE `user_extend` (
  `user_id` int(11) NOT NULL,
  `character` varchar(12) NOT NULL,
  `avatar` varchar(75) NOT NULL,
  `language` varchar(5) NOT NULL,
  `theme` varchar(10) NOT NULL DEFAULT 'sway'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `user_extend` */

/*Table structure for table `user_online` */

DROP TABLE IF EXISTS `user_online`;

CREATE TABLE `user_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL DEFAULT '',
  `timestamp` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `user_online` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `admin` tinyint(5) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
