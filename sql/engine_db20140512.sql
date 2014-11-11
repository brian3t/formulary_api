-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: engine_db
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.12.04.1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (1,'acc');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad`
--

DROP TABLE IF EXISTS `ad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `display_url` varchar(45) DEFAULT NULL,
  `dest_url` varchar(45) DEFAULT NULL,
  `image_url` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `cpc` varchar(45) DEFAULT NULL,
  `ad_group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ad_ad_group1` (`ad_group_id`),
  CONSTRAINT `fk_ad_ad_group1` FOREIGN KEY (`ad_group_id`) REFERENCES `ad_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad`
--

LOCK TABLES `ad` WRITE;
/*!40000 ALTER TABLE `ad` DISABLE KEYS */;
INSERT INTO `ad` VALUES (1,'Ad Name','','','','','','0.4',1);
/*!40000 ALTER TABLE `ad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_group`
--

DROP TABLE IF EXISTS `ad_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_group` (
  `id` int(11) NOT NULL,
  `group_cpc` varchar(45) DEFAULT NULL,
  `campaign_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ad_group_campaign1_idx` (`campaign_id`),
  CONSTRAINT `fk_ad_group_campaign1` FOREIGN KEY (`campaign_id`) REFERENCES `campaign` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_group`
--

LOCK TABLES `ad_group` WRITE;
/*!40000 ALTER TABLE `ad_group` DISABLE KEYS */;
INSERT INTO `ad_group` VALUES (1,'0.3',1);
/*!40000 ALTER TABLE `ad_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign`
--

DROP TABLE IF EXISTS `campaign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `start_date` varchar(45) DEFAULT NULL,
  `create_date` varchar(45) DEFAULT NULL,
  `end_date` varchar(45) DEFAULT NULL,
  `geo` varchar(45) DEFAULT NULL,
  `mo_budget` varchar(45) DEFAULT NULL,
  `device` varchar(45) DEFAULT NULL,
  `language` varchar(45) DEFAULT NULL,
  `website_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_campaign_site1_idx` (`website_id`),
  CONSTRAINT `fk_campaign_site1` FOREIGN KEY (`website_id`) REFERENCES `website` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign`
--

LOCK TABLES `campaign` WRITE;
/*!40000 ALTER TABLE `campaign` DISABLE KEYS */;
INSERT INTO `campaign` VALUES (1,'campaign 1','','','','','','','',1);
/*!40000 ALTER TABLE `campaign` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `impressions_served`
--

DROP TABLE IF EXISTS `impressions_served`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impressions_served` (
  `id` int(11) NOT NULL,
  `advertiser_site_id` varchar(45) DEFAULT NULL,
  `advertiser_account_id` varchar(45) DEFAULT NULL,
  `adv_campaign_id` varchar(45) DEFAULT NULL,
  `adv_ad_group` varchar(45) DEFAULT NULL,
  `adv_ad` varchar(45) DEFAULT NULL,
  `publisher_placement_id` varchar(45) DEFAULT NULL,
  `publisher_account_id` varchar(45) DEFAULT NULL,
  `clicked` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `impressions_served`
--

LOCK TABLES `impressions_served` WRITE;
/*!40000 ALTER TABLE `impressions_served` DISABLE KEYS */;
INSERT INTO `impressions_served` VALUES (1,'adv1','adv acnt','adv camp','','','','',NULL);
/*!40000 ALTER TABLE `impressions_served` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `placement`
--

DROP TABLE IF EXISTS `placement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `placement` (
  `name` varchar(45) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `website_id` int(11) NOT NULL,
  PRIMARY KEY (`website_id`),
  CONSTRAINT `fk_placement_site1` FOREIGN KEY (`website_id`) REFERENCES `website` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `placement`
--

LOCK TABLES `placement` WRITE;
/*!40000 ALTER TABLE `placement` DISABLE KEYS */;
INSERT INTO `placement` VALUES ('top','codefortopplacement',1);
/*!40000 ALTER TABLE `placement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(16) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_user_account1_idx` (`account_id`),
  CONSTRAINT `fk_user_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('username','tri','irttrapok)1','0000-00-00 00:00:00','0000-00-00 00:00:00',1,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `website`
--

DROP TABLE IF EXISTS `website`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `website` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `url` varchar(45) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_site_account1_idx` (`account_id`),
  CONSTRAINT `fk_site_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `website`
--

LOCK TABLES `website` WRITE;
/*!40000 ALTER TABLE `website` DISABLE KEYS */;
INSERT INTO `website` VALUES (1,'website','',1);
/*!40000 ALTER TABLE `website` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-12 10:41:32
