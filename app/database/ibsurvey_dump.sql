-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ibsurvey
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

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
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `answer_store` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_survey`
--

DROP TABLE IF EXISTS `group_survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_survey` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `open_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `close_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_survey`
--

LOCK TABLES `group_survey` WRITE;
/*!40000 ALTER TABLE `group_survey` DISABLE KEYS */;
INSERT INTO `group_survey` VALUES (1,1,1,'2015-04-23 17:45:38','2016-04-22 17:45:38','2014-10-17 11:24:38','2015-04-23 17:45:38'),(2,2,1,'2015-04-30 09:18:06','2016-04-29 09:18:06','2014-10-17 11:31:24','2015-04-30 09:18:06'),(3,3,1,'2015-04-23 17:45:44','2016-04-22 17:45:44','2014-10-17 11:33:13','2015-04-23 17:45:44'),(4,4,1,'2015-04-23 17:45:58','2016-04-22 17:45:58','2014-10-17 14:07:11','2015-04-23 17:45:58'),(5,5,1,'2015-04-23 17:45:55','2016-04-22 17:45:55','2014-10-17 14:07:12','2015-04-23 17:45:55');
/*!40000 ALTER TABLE `group_survey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `school_id` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Admin',1,'$2y$10$AUSZeRxcJNE/b2OmulaIG.WbmOrcgVDGriYQ8sVMqnH1rO4zSOEPe','0000-00-00 00:00:00','2014-10-17 14:00:00'),(2,'Student',1,'$2y$10$ifyOfu0JH9ygiwbgcbl0nu2gq7Cc7U9.AdmvGBy8ergpJrEJne5ny','0000-00-00 00:00:00','2015-04-30 09:19:50'),(3,'Teacher',1,'$2y$10$yKPyBJRwg.rApernTpYgXOqV7g63idsrSyKN.kRCSeS3RdNGeZPPK','0000-00-00 00:00:00','2014-10-17 14:00:53'),(4,'Leadership',1,'$2y$10$zI5Wbc72U.vsAAuFIbdE.eki2DTS7dl.PN/OaZnV3oMCpwcXrfmG.','0000-00-00 00:00:00','2014-10-17 14:01:12'),(5,'Community',1,'$2y$10$eO9Vp1SZKbiYe9Z5lndeA.st/MTNam8Z7H4b6LGhho5.Qnmq63Pgm','0000-00-00 00:00:00','2014-10-17 14:01:35');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_09_17_223810_create_schools_table',1),('2014_09_17_223839_create_groups_table',1),('2014_09_17_223909_create_surveys_table',1),('2014_09_17_224105_create_answers_table',1),('2014_09_18_194024_create_users_table',1),('2014_09_22_215251_create_group_survey_table',1),('2014_10_25_192059_add_attempts_to_users_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schools` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `schools_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schools`
--

LOCK TABLES `schools` WRITE;
/*!40000 ALTER TABLE `schools` DISABLE KEYS */;
INSERT INTO `schools` VALUES (1,'Inglemoor','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `schools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surveys`
--

DROP TABLE IF EXISTS `surveys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surveys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `school_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surveys`
--

LOCK TABLES `surveys` WRITE;
/*!40000 ALTER TABLE `surveys` DISABLE KEYS */;
INSERT INTO `surveys` VALUES (1,'Student',1,'0000-00-00 00:00:00','2015-04-21 13:49:37');
/*!40000 ALTER TABLE `surveys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `failedAttempts` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'AlexLeung','alex.l.leung@gmail.com',1,'$2y$10$wKk8CGqlT.IZNQ9lb90B/u9YIrsYEJnfkmr7NnwGS7Z4j0nywsXM6','tHBjYgRCW0O5iQb8rNlCREYwoBQjRpopz6Ft2UaOZR7wZr35oJ6kfvYHBe37','0000-00-00 00:00:00','2015-05-29 23:55:05',0),(3,'ChrisMcQueen','cmcqueen@nsd.org',1,'$2y$10$y5jpfpTotxOMoS5K7Msitu1rFVift.9TPgN625uuVZzlCC2O/yYjG','nNra1dnRvd6ePXVXSKt4f4OQdf4lmo1I1dh70w8yqJEcihCfTfTaITGfXh93','2014-10-17 13:50:33','2015-04-30 09:22:05',0),(6,'AmyMonaghan','amonaghan@nsd.org',1,'$2y$10$8pNpZUylj78imCxbLL3J7uQ.XFPofUmB9nNZnwrXo9QRhFdk9Zgsa','GsHkVgyCpWo08liE9m5MOspVHl8PjBSwInqUpxaXBx7igoqy87lfJT5vPDNA','2014-11-11 10:41:34','2015-04-23 18:07:50',0),(9,'KrishangSwami','krishangswami@gmail.com',1,'$2y$10$drVoktQnLG4G8PKdQ7Y8d.IHa4TWpKdX3XMjaUxqAphNhC49t/P8m','taSbVAH4cs9Yr05o5S0EjS2a7cPYtOAKeheOO6MPZh1D2m4Wmy0r8qTodGYB','2014-12-28 12:31:58','2015-02-03 09:58:15',0),(11,'Anonymous','',2,'none','v6ouK1nnCs1TxTUujJ7D8ft2rRGYwYwBzT2F9yaSvo4hmJZ9taoZuJlH1LdG','2015-04-23 17:40:37','2015-05-01 09:52:28',4),(13,'Anonymous','',2,'none',NULL,'2015-04-30 09:48:53','2015-04-30 09:48:53',0),(14,'Anonymous','',2,'none','w4gncBoM9zOCcVrby9b3s2b1GPAaiqSBDqOUUysQFbE5ROWxAqm21s0BpWxY','2015-04-30 09:49:07','2015-04-30 09:59:03',0),(15,'Anonymous','',2,'none','tAlxfTherF5wAFYFxIAzcgMN1FJMDTJ0qYAcWxP7Jg94o84qUduslzHO7Usf','2015-04-30 09:49:10','2015-04-30 09:54:57',0),(16,'Anonymous','',2,'none',NULL,'2015-04-30 09:49:25','2015-04-30 09:49:25',0),(17,'Anonymous','',2,'none','vXgWedb2w7mavmkGFUjN44XyU2OfKn5T34msCsXXqO6FjjCJSdmj5QyINglu','2015-04-30 09:49:38','2015-04-30 10:00:28',0),(18,'Anonymous','',2,'none','mHpRQkYbmdi1rXfAj9vxNYfjnYYtrjDpbLy3t5oRw58nfOxDXlViGzmYlO6C','2015-04-30 09:49:38','2015-04-30 09:53:37',0),(19,'Anonymous','',2,'none','2aVSLUN8KI4TYXUTkJc6gak39iHisv4BURHQJ3HaJDv14LIMjWLwEucBbYcY','2015-04-30 09:49:57','2015-04-30 10:00:25',0),(20,'Anonymous','',2,'none','5Ap5W4SpsjGamsOo7tGqa3jCHEcsp3NzsALuQEDUkcEnZWHa7zzdlcte3SG5','2015-04-30 09:49:59','2015-04-30 10:00:28',0),(21,'Anonymous','',2,'none','4NHDNEolE3QNnHoF15jd7ltnW7S8yKfYxneNKcSogxYl2Qd43jtBaedNM6CY','2015-04-30 09:50:24','2015-04-30 09:56:58',0),(22,'Anonymous','',2,'none',NULL,'2015-04-30 09:50:29','2015-04-30 09:50:29',0),(23,'Anonymous','',2,'none','oUaGWrKEcJU88ZaNtsGlcJLCxEphmy462ANnGXFb4vTh3jCAXxEj1W4FLzUm','2015-04-30 09:50:46','2015-04-30 10:01:44',0),(24,'Anonymous','',2,'none',NULL,'2015-04-30 09:50:54','2015-04-30 09:50:54',0),(25,'Anonymous','',2,'none','CXxagnOrFW6tJGK5Vc5i9uQxuUG4eqsrRX90mHqJsWpJ4NhSBZP14wztvMyh','2015-04-30 09:50:57','2015-04-30 10:03:33',0),(26,'Anonymous','',2,'none','eYWROx2JJ4qNhnBPYJ6PXU0cCkxENsCmzEy6njVUIHXN35wzRglVLPhoNJFz','2015-04-30 09:51:02','2015-04-30 10:02:45',0),(27,'Anonymous','',2,'none','nYgCt0saKUMglg6fv8jIgqCUDemacFOYiM7fmmX9WWOC6prdgUIWelN2CINw','2015-04-30 09:51:10','2015-04-30 09:57:07',0),(28,'Anonymous','',2,'none',NULL,'2015-04-30 09:51:12','2015-04-30 09:51:12',0),(29,'Anonymous','',2,'none','cXu8WwrnM5FoZMGdXsYGoA1qZMJHqf7RoQbERBfX5twou5rJxr7I1tdzLRkN','2015-04-30 09:51:19','2015-04-30 10:02:43',0),(30,'Anonymous','',2,'none',NULL,'2015-04-30 09:51:21','2015-04-30 09:51:21',0),(31,'Anonymous','',2,'none','vvDOlsPUcxiduJQB5oqsqDyG6zlm6cthRIy2TTJ5kQmU33of1TwTwXsRL5R6','2015-04-30 09:51:27','2015-04-30 09:57:18',0),(32,'Anonymous','',2,'none',NULL,'2015-04-30 09:51:30','2015-04-30 09:51:30',0),(33,'Anonymous','',2,'none',NULL,'2015-04-30 09:51:35','2015-04-30 09:51:35',0),(34,'Anonymous','',2,'none',NULL,'2015-04-30 09:51:37','2015-04-30 09:51:37',0),(35,'Anonymous','',2,'none','ZF3gq3V4n875aKLN7VEpfT759GOPoM0SmvqBSXHRnaRxDNhSBaXXxbDwL9ra','2015-04-30 09:52:05','2015-04-30 09:58:26',0),(36,'Anonymous','',2,'none','hVM3PwpEcFuC5R3NYm6OOnxpQ5lQ9PyKxL33RWo5txjibibhnB0ykCfTDjSH','2015-04-30 09:52:20','2015-04-30 09:57:11',0),(37,'Anonymous','',2,'none','HzxBSbyPVINHeVZFvULFAAPbFWcigKOVEnkaoLVVx9qgZCk4fM90jpGK9ZsE','2015-04-30 09:52:44','2015-04-30 10:05:08',0),(38,'Anonymous','',2,'none','jeGrq72KT1gz38RP1iN9Kg3YoMFiUTlGBsw4bgzfpuNd1v5UPnl7uNX0Ly3c','2015-04-30 09:54:05','2015-04-30 10:05:33',0),(39,'Anonymous','',2,'none',NULL,'2015-04-30 12:20:35','2015-04-30 12:20:35',0),(40,'Anonymous','',2,'none',NULL,'2015-04-30 12:21:15','2015-04-30 12:21:15',0),(41,'Anonymous','',2,'none',NULL,'2015-04-30 12:21:22','2015-04-30 12:21:22',0),(42,'Anonymous','',2,'none','u2uNKJiM0wsZUzyYb34mHch25TVcX6XF3EGwwuhgs83cqmzjsJdZvv2UvuuH','2015-04-30 12:21:43','2015-04-30 12:29:21',0),(43,'Anonymous','',2,'none','AucLGABNwtCEo1oGhxGII9hBXgWEVX80Xj83dhU9u2KqWHYw6IceqteCOuGL','2015-04-30 12:21:55','2015-04-30 12:30:07',0),(44,'Anonymous','',2,'none','Gny3mbIShT0oikVWyMeLXRW4Fg1IazxSJPEIJ0gAkfF49hbkJuQ7LnvBBadq','2015-04-30 12:21:56','2015-04-30 12:30:07',0),(45,'Anonymous','',2,'none','fxrAPi2q3GBwOBijzuqCEmd7kHMt94zVRDOVXXeWOuxMFRAxTxeio27j8id8','2015-04-30 12:21:58','2015-04-30 12:27:24',0),(46,'Anonymous','',2,'none',NULL,'2015-04-30 12:22:06','2015-04-30 12:22:06',0),(47,'Anonymous','',2,'none',NULL,'2015-04-30 12:22:15','2015-04-30 12:22:15',0),(48,'Anonymous','',2,'none','xb696EvOSXAkJCce3TOM3ziIdwxiQ56YshqdWEisG7Y0fNL83J2Ig5sY1hNu','2015-04-30 12:22:18','2015-04-30 12:28:20',0),(49,'Anonymous','',2,'none','nJmkaLLdRpl6CpI8BCNdjhWJXW0QE3eLSCuXvR7nOpXKlXeBU3jR7BLpmbeE','2015-04-30 12:22:26','2015-04-30 12:25:38',0),(50,'Anonymous','',2,'none',NULL,'2015-04-30 12:22:33','2015-04-30 12:22:33',0),(51,'Anonymous','',2,'none',NULL,'2015-04-30 12:22:43','2015-04-30 12:22:43',0),(52,'Anonymous','',2,'none',NULL,'2015-04-30 12:22:49','2015-04-30 12:22:49',0),(53,'Anonymous','',2,'none','SAfwwVJVJn4nslCPCTCEmOGlLF8wAC236eImAqscQAFzCQpY1Yh6GpuIFoVC','2015-04-30 12:22:53','2015-04-30 12:33:56',0),(54,'Anonymous','',2,'none','JRYLigmukdByWsyUZamp1BipDyZZ58t5ddCx4co5QakVZtSu4WecT9AEbsYR','2015-04-30 12:23:00','2015-04-30 12:29:28',0),(55,'Anonymous','',2,'none',NULL,'2015-04-30 12:23:01','2015-04-30 12:23:01',0),(56,'Anonymous','',2,'none',NULL,'2015-04-30 12:23:04','2015-04-30 12:23:04',0),(57,'Anonymous','',2,'none',NULL,'2015-04-30 12:23:05','2015-04-30 12:23:05',0),(58,'Anonymous','',2,'none',NULL,'2015-04-30 12:23:06','2015-04-30 12:23:06',0),(59,'Anonymous','',2,'none',NULL,'2015-04-30 12:23:06','2015-04-30 12:23:06',0),(60,'Anonymous','',2,'none',NULL,'2015-04-30 12:23:16','2015-04-30 12:23:16',0),(61,'Anonymous','',2,'none','dar0btlyAKFNOGCvAE1SpuzXOO2F3JRmM1HkQa2IIThLi90xVfWX7XiGVXOU','2015-04-30 12:23:20','2015-04-30 12:28:20',0),(62,'Anonymous','',2,'none','jzPSlpK0jmE9KVoYO05Wzs5I6pCYKnCWBi20CqH8aLJAUUwqIgU7BoQppxgt','2015-04-30 12:23:42','2015-04-30 12:32:18',0),(63,'Anonymous','',2,'none',NULL,'2015-04-30 12:23:46','2015-04-30 12:23:46',0),(64,'Anonymous','',2,'none',NULL,'2015-04-30 12:23:56','2015-04-30 12:23:56',0),(65,'Anonymous','',2,'none',NULL,'2015-04-30 12:25:14','2015-04-30 12:25:14',0),(66,'Anonymous','',2,'none',NULL,'2015-04-30 12:25:20','2015-04-30 12:25:20',0),(67,'Anonymous','',2,'none',NULL,'2015-04-30 12:25:25','2015-04-30 12:25:25',0),(68,'Anonymous','',2,'none','NNEuFxyybDqTHZBnQgJHoMcVlDnQVH2jZveexutUNUS4sRvVfLsCjCNW1B6J','2015-04-30 12:25:38','2015-04-30 12:26:09',0),(69,'Anonymous','',2,'none',NULL,'2015-04-30 12:25:43','2015-04-30 12:25:43',0),(70,'Anonymous','',2,'none',NULL,'2015-04-30 12:26:06','2015-04-30 12:26:06',0),(71,'Anonymous','',2,'none',NULL,'2015-04-30 12:26:18','2015-04-30 12:26:18',0),(72,'Anonymous','',2,'none',NULL,'2015-04-30 21:42:27','2015-04-30 21:42:27',0),(73,'Anonymous','',2,'none',NULL,'2015-05-01 07:38:44','2015-05-01 07:38:44',0),(74,'Anonymous','',2,'none',NULL,'2015-05-01 07:40:51','2015-05-01 07:40:51',0),(75,'Anonymous','',2,'none',NULL,'2015-05-01 07:40:52','2015-05-01 07:40:52',0),(76,'Anonymous','',2,'none','gJnGbG4UismtDucIKqy6P877qffa9b9hOlbUcNdHjUaHCpTW9mMhFozo1tk6','2015-05-01 07:41:01','2015-05-01 07:46:23',0),(77,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:16','2015-05-01 07:41:16',0),(78,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:18','2015-05-01 07:41:18',0),(79,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:19','2015-05-01 07:41:19',0),(80,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:19','2015-05-01 07:41:19',0),(81,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:20','2015-05-01 07:41:20',0),(82,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:21','2015-05-01 07:41:21',0),(83,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:21','2015-05-01 07:41:21',0),(84,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:21','2015-05-01 07:41:21',0),(85,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:23','2015-05-01 07:41:23',0),(86,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:24','2015-05-01 07:41:24',0),(87,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:24','2015-05-01 07:41:24',0),(88,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:26','2015-05-01 07:41:26',0),(89,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:27','2015-05-01 07:41:27',0),(90,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:30','2015-05-01 07:41:30',0),(91,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:31','2015-05-01 07:41:31',0),(92,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:33','2015-05-01 07:41:33',0),(93,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:45','2015-05-01 07:41:45',0),(94,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:46','2015-05-01 07:41:46',0),(95,'Anonymous','',2,'none','fXRQOoiUAMTfgKeokWyHFWcUKWG0PwRy0cbAB9fHqnwlcxPYgMr9eyWvHC7K','2015-05-01 07:41:47','2015-05-01 07:49:54',0),(96,'Anonymous','',2,'none',NULL,'2015-05-01 07:41:54','2015-05-01 07:41:54',0),(97,'Anonymous','',2,'none',NULL,'2015-05-01 07:42:04','2015-05-01 07:42:04',0),(98,'Anonymous','',2,'none','WnZaYoAS3qJJuBv72fc7NfgGFH14DQEocvp3K9XYfxzzd1nlMyT7PUgjGK6r','2015-05-01 07:42:27','2015-05-01 07:47:17',0),(99,'Anonymous','',2,'none','JhYbBp8zApenaMEpn5Xa2Ml00vjdhS0VxsNA2c8J1a0aL8VlR2yFBiI7q8Va','2015-05-01 07:43:26','2015-05-01 07:53:29',0),(100,'Anonymous','',2,'none','Eo70uP6sswIXIMHiGj9t9UbL8HmDlIEpTvJAqqh57oP9wwZTqdu2WMsuChZx','2015-05-01 07:43:27','2015-05-01 07:48:53',0),(101,'Meera','springflower77@gmail.com',2,'$2y$10$MmCHGuqqf7iN2etbGJTjZ.j3IoZwleYbb4kqfg2NdQiO8ZgK20C4e','2rFsdOJbKRAF5S0U0aQ7NlTwFhoVAhtPg7x0VT457kTFQaoAUsuXe1DgmyqS','2015-05-01 07:46:38','2015-05-01 07:50:58',0),(102,'Anonymous','',2,'none',NULL,'2015-05-01 09:49:47','2015-05-01 09:49:47',0),(103,'Anonymous','',2,'none',NULL,'2015-05-01 09:50:32','2015-05-01 09:50:32',0),(104,'Anonymous','',2,'none','0O664lfRvE5M6xssffIiMCLKseAkA3XARWBOay2uznSxQYZRgJdOtOdod9ov','2015-05-01 09:50:42','2015-05-01 09:56:46',0),(105,'Anonymous','',2,'none',NULL,'2015-05-01 09:50:45','2015-05-01 09:50:45',0),(106,'Anonymous','',2,'none',NULL,'2015-05-01 09:50:59','2015-05-01 09:50:59',0),(107,'Anonymous','',2,'none',NULL,'2015-05-01 09:51:06','2015-05-01 09:51:06',0),(108,'Anonymous','',2,'none',NULL,'2015-05-01 09:51:15','2015-05-01 09:51:15',0),(109,'Anonymous','',2,'none',NULL,'2015-05-01 09:51:18','2015-05-01 09:51:18',0),(110,'Anonymous','',2,'none',NULL,'2015-05-01 09:51:25','2015-05-01 09:51:25',0),(111,'Anonymous','',2,'none',NULL,'2015-05-01 09:51:30','2015-05-01 09:51:30',0),(112,'Anonymous','',2,'none',NULL,'2015-05-01 09:51:30','2015-05-01 09:51:30',0),(113,'Anonymous','',2,'none',NULL,'2015-05-01 09:51:37','2015-05-01 09:51:37',0),(114,'Anonymous','',2,'none',NULL,'2015-05-01 09:51:43','2015-05-01 09:51:43',0),(115,'Anonymous','',2,'none',NULL,'2015-05-01 09:51:52','2015-05-01 09:51:52',0),(116,'Anonymous','',2,'none',NULL,'2015-05-01 09:51:57','2015-05-01 09:51:57',0),(117,'Anonymous','',2,'none',NULL,'2015-05-01 09:52:01','2015-05-01 09:52:01',0),(118,'Anonymous','',2,'none','UgUJa7e1walAhZPhdwSqNTKwdROd0w4Sz5eNssEBg0nbTLkTeyrMQunG9n5m','2015-05-01 09:52:09','2015-05-01 09:59:43',0),(119,'Anonymous','',2,'none','LZSsub4tPErWvLkg5eEtJYCk7fqJGd20CEesAfZncfi6JPeSz3zePZ7CiE0N','2015-05-01 09:52:18','2015-05-01 09:55:30',0),(120,'Anonymous','',2,'none',NULL,'2015-05-01 09:52:23','2015-05-01 09:52:23',0),(121,'Anonymous','',2,'none','GkwxTKSavAnNU2ohpRV1E6PJbQgiehYyBkvISP6OPMHw0lyNUdFjmobakw1I','2015-05-01 09:52:41','2015-05-01 10:03:16',0),(122,'Anonymous','',2,'none',NULL,'2015-05-01 09:52:46','2015-05-01 09:52:46',0),(123,'Anonymous','',2,'none',NULL,'2015-05-01 09:53:02','2015-05-01 09:53:02',0),(124,'Anonymous','',2,'none','8GqDcom6lQrpqChmDLU6L4hXzpYnGlICNSWsGaHL9bVCFU2q1jf32lKFTe0D','2015-05-01 09:54:08','2015-05-01 10:02:35',0),(125,'Anonymous','',2,'none',NULL,'2015-05-01 09:54:52','2015-05-01 09:54:52',0),(126,'Anonymous','',2,'none',NULL,'2015-05-01 09:55:15','2015-05-01 09:55:15',0),(127,'Anonymous','',2,'none',NULL,'2015-05-01 09:55:28','2015-05-01 09:55:28',0),(128,'Anonymous','',2,'none',NULL,'2015-05-01 09:56:35','2015-05-01 09:56:35',0),(129,'Anonymous','',2,'none',NULL,'2015-05-01 09:56:46','2015-05-01 09:56:46',0),(132,'Anonymous','',4,'none','KXMriUSoWZMw65qUQz3S8Hz5T4U42LfcotWdrFO8FdFigYVDOzX3ZV9YNPxo','2015-05-06 10:17:35','2015-05-06 10:27:20',0),(133,'Anonymous','',5,'none','BtJhdQzD8pvF7KEMCgsy4K70rmXseZwoNLfrKodElGaBOq5iOJHoPtBpwP06','2015-05-06 10:27:46','2015-05-06 10:29:08',0),(134,'Anonymous','',3,'none','wVWhAeipDC9v4iCRa0UxgyLA0plfzAuS7yCX45lL2l9TBcmkGdU9piPrjuLD','2015-05-06 10:29:37','2015-05-06 10:33:26',0),(135,'Anonymous','',5,'none','qYM0wDOpRTbedsXmzSFEzVzxqgfICeoCEZzEmxa3H4nju749dLsqRYEoF6LP','2015-05-06 10:33:49','2015-05-06 10:59:22',0),(136,'RobynMetz','rmetz@nsd.org',3,'$2y$10$TfKZ2xkrVdTdYXX7doLmP.v9ThWmFT2U4B/xXMu4uyrkKP.icDKt6',NULL,'2015-05-06 10:56:13','2015-05-06 10:58:07',0),(137,'Anonymous','',3,'none','D0hqPr0lEvwWl1tzac5YYYFVOXZmoq3ZywgHQjGDnHOiMgwE7o3XUZkoywOy','2015-05-06 10:59:39','2015-05-06 11:01:07',0),(138,'JessicaParrott','jparrott@nsd.org',3,'$2y$10$QPnzku2iZLiwaENBrjpNe.0MmfSaWMUypcEr9t6ZTGk16jCTQyjWC','X4v89incspSrivWIfOcwSLfdzrrO6zpYATp8nLHxmIdRIOf3SvaROOJ1nl1n','2015-05-07 08:34:04','2015-05-07 08:42:50',0),(139,'Anonymous','',3,'none','reTS8zu2PnvOg0Xw47HzdNPSXwWzw7uAMhGjHz3hAmEPWwB0XlSVchbOYGjf','2015-05-07 08:37:29','2015-05-07 08:40:52',0),(140,'Anonymous','',4,'none','4kZPjoOpUyn4LZ3jGCJ89xUNJriu5iglOaR3mqnki8c2ylYE50S44JUVx3s6','2015-05-07 08:41:05','2015-05-07 08:41:31',0),(141,'JessicaParrott','jessica.olsheski@gmail.com',4,'$2y$10$MTR.1UdZ.GShJYJcUfhrE.4dmvXie78jVNVpPDgAVtYQDSB.xeDb2',NULL,'2015-05-07 08:43:05','2015-05-07 08:43:16',0),(142,'BryanMcNiel','bmcniel@nsd.org',3,'$2y$10$T1hd48K1Io.Sqp66mRdV5eryTOJAU7ozI5NX888wBHvvH3UUV.mze','BXCv9CAR8KvCK7BSvFbMGy90WCujMHhAn0K8m03nra8e4jUn4ntYpWZ0E5RE','2015-05-07 10:17:37','2015-05-07 10:25:41',0),(143,'Anonymous','',3,'none','luiIYFLpRqmkZTxtFGlpyLVee5etcPQsFECPATQkzxfUckpFQVKTpFKW27AQ','2015-05-07 10:20:09','2015-05-07 10:30:39',0),(144,'Anonymous','',3,'none',NULL,'2015-05-07 10:26:42','2015-05-07 10:26:42',0),(145,'Anonymous','',4,'none',NULL,'2015-05-07 10:31:56','2015-05-07 10:31:56',0),(146,'elevine','elevine@nsd.org',4,'$2y$10$cOGMggPLJP7zmc443oxrsebQOUzkttOl.auucyRGdrCGXJ2zJpJFy','3VLZMsrIjdtXK75K74oa9HigXLbZlceTNbxZgtIcyW8Q766oywrdSXMtie6k','2015-05-07 10:36:55','2015-05-07 10:44:20',0),(147,'Anonymous','',3,'none','VHAHn70OKRGGUh5Kbr3NCdYvx1p6nBrGDacdnFMo73awdG4S2SPtVUeKwPNY','2015-05-07 10:46:07','2015-05-07 10:54:33',0),(148,'JonStern','jstern@nsd.org',4,'$2y$10$hjJgOZlA.opcnsDvmq2nIuaTue9gI8VzwuM53DzK.0FI9YvfhTHs.','XuSCltu7OVHTkruMVQ3sgifTT8ayqtwuqOMF2CGMjLHPOaqsCT41f2xs7DeC','2015-05-07 10:53:48','2015-05-07 13:21:45',0),(149,'Anonymous','',3,'none','acGvDRxqGHOWliJzqUzxSDFasOeWH1ND61s8PUuHAdhCoLn4DsyYctCvcAoo','2015-05-07 11:38:04','2015-05-07 11:48:52',0),(150,'NorikoNasu','nnasu@nsd.org',3,'$2y$10$wsEFGVKmy9BA6f4D0hgDjeg86.n4BPcBvQQt.0gMUopmyhe992pTu','PoHgH9ooHn0xD4DYznEukmjIZpRMfBb23kRXun5tyQMvVWeX9NlvWIrWSr97','2015-05-07 11:40:00','2015-05-07 11:55:45',0),(151,'MattCoglon','mcoglon@nsd.org',3,'$2y$10$xZlsXNBSrOfrYCFh3c2rbOb3t.Vl0hOvc5qpyuJUsbM5GdelFCv7W','y3vH5OEzy8PMk9sh1UkLZ1A797xpqzepAZ3GpvZmwMk7ISYoSLYkyCeQ8tjv','2015-05-07 13:37:54','2015-05-08 08:08:34',0),(152,'Anonymous','',3,'none','0hR4GdPXnllOlHlOcJoJKjRbmw4wBQTbK9GfwuKSIT1hFwDCAtjmVRgaZL5c','2015-05-07 14:21:48','2015-05-07 14:26:33',0),(153,'Anonymous','',4,'none',NULL,'2015-05-07 14:24:16','2015-05-07 14:24:16',0),(154,'ElizabethRoth','eroth@nsd.org',3,'$2y$10$pjGbuK/1FdFm7JFzdfqSg.V7AI7OgDTZIp7jYmt66igSyE2x8uNg6',NULL,'2015-05-07 14:41:07','2015-05-07 14:41:32',0),(155,'GretchenStewart','gstewart@nsd.org',3,'$2y$10$Z8rFGPBp.mI0LiaWyNhqAOH5Qhley/cVrPb2vu2UEP2DSy1NFuxJG','VMKxiD6pcYpuBXsJShCFRO8IwZ7Mas9plFTZloNLYlKOSPXbSkIzxHitPivd','2015-05-07 15:41:30','2015-05-07 15:49:17',0),(156,'JoannaWalker','jwalker@nsd.org',3,'$2y$10$NI/7WK2r./poVPVHFYZHNubz9lyijD5wrsgmYXhvI.HVZj1.SBk6K','CU5zYceo0S9BFhWc2eUiFIuMFUjnX3p0AKuHOmI9W8mWMjfNzhNRIqpy8Jp4','2015-05-07 16:41:02','2015-05-07 16:53:17',0),(157,'SeanBurrus','sburrus@nsd.org',3,'$2y$10$ujuaRiPrW7d0KqgU/aHTy.kRf1qCD659kMi99/e.Nk8J3N0lQyHOK',NULL,'2015-05-07 19:00:15','2015-05-07 19:01:00',0),(158,'LindseyRichards','lrichards@nsd.org',3,'$2y$10$RoEA7PkHrHExG7yTi506QeP6JeU5wTWLvF.1H.v3r8jdDQlnNLG8G',NULL,'2015-05-07 20:05:31','2015-05-07 20:05:59',0),(159,'JanisAnable','anablezoo@gmail.com',5,'$2y$10$Od69fwn8Q49Sny.vQmbyQeHcVoFUOabv6NU6e6O9/wxSbpgZcFaAe',NULL,'2015-05-08 13:01:15','2015-05-08 13:04:45',0),(160,'KristinRose','krose@nsd.org',4,'$2y$10$eUyhnZ4C0B7N0XwnpAC/SuUPNQtKHve3qf8m1aSnjMFkCsre0tAz.','LceY3DPXGZO4voHnb7QcTqYjnxQvsmWiCAed81o9YklGEpmC6tOVPmwL1qzA','2015-05-11 09:12:59','2015-05-11 09:21:57',0),(161,'VickiSherwood','vsherwood@nsd.org',4,'$2y$10$zo6.uY2hSQhj4ueO/lI9tuMPu2MZta3RoE16.dGqu0noFCIJr4Lji',NULL,'2015-05-11 10:08:38','2015-05-11 10:10:57',0),(162,'BethStewart','bstewart2@nsd.org',4,'$2y$10$ZXLyI2fVKt3y3uvYRoxfLOcRAFrb9g7hpJcoYkM0h1/MXcR9Wj.gi','hky5iJS17E3Ih9P84rLeylzcRlY2bCE9B0qDDyLWXBF1bclxXgsltjxq27gx','2015-05-11 10:28:41','2015-05-11 10:35:19',0),(163,'LoniTighe','ltighe@nsd.org',3,'$2y$10$dwqI2upimZfQdPQWL9DOCe3fH.tRMllQ3VkHk13W11qhcOHoQr9i.','uCOsSDEBfJAte3k0PLqirqlVi9QQYbeg1WH0lV6dEMWe2CQjlnS3d9c2IZde','2015-05-11 14:25:19','2015-05-18 14:25:36',0),(164,'TomWojtkowiak','twojtkowiak@nsd.org',3,'$2y$10$UbJ1r03TsoCk6sY7zNtbu.EktUdb7p/I3QvN/LPsRe4qWQuAh48ZW',NULL,'2015-05-13 07:59:35','2015-05-13 08:10:18',0),(165,'KellyHaupt','khaupt@nsd.org',3,'$2y$10$cIOFMAidYk.crBbZi0f/KudeVrQCcLsUHNNi9zMq.s4dBimplZ.0i','aehcSGG30vURJq4ggfMSLgmWamIk1EyGRHHyXGfAOkGLXMwYPQwkQ0WohyH5','2015-05-13 08:12:58','2015-05-13 08:20:04',0),(166,'JulieChee','jchee425@gmail.com',5,'$2y$10$26B46IDFraShO.85ROatQuu2maZsuH3LDcLXn8WJ3COwfPA4Wi15K','TvhBSEYDQx2GcS9Uyl8yBdHbzqdBBflwGXUxT2bLsf1yveS4ifJYGGqWtRkl','2015-05-13 20:19:41','2015-05-13 20:24:36',0),(167,'BethStewart','kbstewart02@hotmail.com',3,'$2y$10$SL2eh2DkLjvzq5Of1NhOaewD48huadkETbq0AJM1qbKxqdpvdeKUC','DckM4MCqMzY1jlFSgrxZNGFkhom9lGSRZ9szNgyRP6sRXX2vJ6sJp3SLKzcR','2015-05-14 11:17:21','2015-05-14 11:32:32',0),(168,'JamesSmith','jsmith@nsd.org',4,'$2y$10$HY11wBJIM09swdlGgsoyRuW7Pbt6pOyz/KL/h9UiEqcerBpoJ1N..',NULL,'2015-05-14 13:48:13','2015-05-14 13:49:15',0),(169,'MarianStewart','andreas@eskimo.com',5,'$2y$10$8XcWVk93qVluer6RUEAVV.Qg2pCVmeeyiQ5WFNS7tYkZ38xIuyB/q','TQcjqOkTVrr673fd2Kpp8HvyKy8B3SPO0JOx9plovUednr09uGOddJo6fFTI','2015-05-15 07:12:39','2015-05-15 07:16:51',0),(170,'SusanneKanning','skanning@nsd.org',3,'$2y$10$ZbobCTtMZqwozZNaB96JZufYi5TOYJPFR5.Js2vQMvpv0mASbV7XW','OlPa8qcFOIMYguMW9e51w2AMv3SWxSFASErPVY16B2LeOdpYREi5794Pnjc0','2015-05-15 19:17:03','2015-05-15 19:32:13',0),(171,'SallyAnderson','sanderson3@nsd.org',3,'$2y$10$7Ff81zID4J/X5mJvXX85Cu0Of9J4X/t/PlvL62ZvYfl2691e7TbV.','SCcwatvmVyCn3CdVc2LvQYjiwJfbRhzu2OERUa4WanP5ujprjsgWj0jb3KOj','2015-05-18 11:36:55','2015-05-18 11:45:10',0),(172,'Julie','jwesterbeck@nsd.org',3,'$2y$10$J11ZLYAphzUk5W7JCir.a.MqDLHbqXKifJuVewFF8D7ZrlNr2Zliu',NULL,'2015-05-18 16:55:18','2015-05-18 16:55:37',0),(173,'GarydeGorgue','gdegorgue@nsd.org',3,'$2y$10$9jJ1pEapNl0cKSNAvRCubeCbtBxTpwQWbJ4Ix/BrasAdys/v7ikQK','2BufvraQzmdRddAWeCEwfb0aPLZ7rS1vAKU2QjAmvoZplQj9gdRwAjXoIh5W','2015-05-19 09:42:39','2015-05-19 09:48:58',0),(174,'StephanieBrommer','brompaul@comcast.net',5,'$2y$10$P11cUGnL7LmAeU0XBoMit./njsQxPAutl4AHwUazV4UYTnKvrNB9O','6lOtRW7MHbVdLsDssHDgtIp5d7fizLm0vdmmoW2yiTTi5hzotF7iQdxKEj4v','2015-06-09 10:26:19','2015-06-09 10:30:52',0),(175,'SUSANDIEKEMA','sdiekema@me.com',5,'$2y$10$AK02wRtl6nO9B0KAnjzNUuYItfNFy6XtGdCuJdue.YpPKJGRIFGAS','SnWWUGIhXzPFyeB2CNi7FcjUn4Ef4GSkRhIVsBCJnNYJHyulxYt0kqsFiw7Z','2015-06-11 06:21:59','2015-06-11 06:25:49',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-31  8:20:08
