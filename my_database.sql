-- MariaDB dump 10.19  Distrib 10.4.19-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: my_database
-- ------------------------------------------------------
-- Server version	10.4.19-MariaDB

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` text NOT NULL,
  `likes` int(11) DEFAULT 0,
  `postid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `date_posted` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `postid` (`postid`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`postid`) REFERENCES `posts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (5,'This is the fist comment',3,5,1,'2021-10-18 07:15:59'),(11,'This is the second comment',1,5,1,'2021-10-18 16:57:14'),(16,' A test comment here',0,5,1,'2021-10-20 17:36:06'),(18,'A new comment',0,13,1,'2021-10-21 17:29:33'),(19,'Mark comments',0,5,3,'2021-11-09 19:55:06'),(21,'This blogging hub is awesome',2,22,3,'2021-11-13 06:52:23');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `referenceID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (2,5,3),(3,11,3),(6,21,3),(8,21,5),(9,22,5);
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL,
  `msg` text NOT NULL,
  `likes` int(11) DEFAULT 0,
  `tags` text DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `date_posted` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (5,NULL,'lobortis mattis aliquam faucibus purus in. Viverra nam libero justo laoreet sit amet cursus sit amet. Sollicitudin nibh sit amet commodo nulla facilisi nullam.',0,NULL,1,'2021-09-30 12:25:45'),(10,NULL,'Lorem ipsum first post simmet ipsum lorem ls site dolllar',0,NULL,1,'2021-10-03 20:10:19'),(11,NULL,'Diam quis enim lobortis scelerisque fermentum dui faucibus in. In metus vulputate eu scelerisque. Eleifend quam adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus. Bibendum est ultricies integer quis auctor elit sed vulputate. Pharetra et ultrices neque ornare aenean euismod. Nunc lobortis mattis aliquam faucibus purus in. Viverra nam libero justo laoreet sit amet ',0,NULL,1,'2021-10-04 09:21:39'),(13,NULL,'Dignissim suspendisse in est ante in nibh mauris cursus mattis. Sit amet mattis vulputate enim. Accumsan sit amet nulla facilisi morbi tempus. Interdum varius sit amet mattis vulputate enim nulla aliquet porttitor. Eros in cursus turpis massa tincidunt dui ut ornare. Facilisis leo vel fringilla est ullamcorper eget. Semper feugiat nibh sed pulvinar proin gravida hendrerit lectus a. Consectetur adipiscing elit pellentesque habitant morbi tristique senectus et. Blandit volutpat maecenas volutpat blandit aliquam etiam erat velit. Vulputate sapien nec sagittis aliquam malesuada bibendum. Quisque id diam vel quam elementum pulvinar etiam. Magna eget est lorem ipsum dolor',0,NULL,1,'2021-10-20 01:29:34'),(15,'My title','This is a titled post ipsum lorem sitta dolar amet',0,NULL,1,'2021-11-08 14:02:46'),(16,'Post by Mark','proin gravida hendrerit lectus a. Consectetur adipiscing elit pellentesque habitant morbi tristique senectus et. Blandit volutpat maecenas volutpat blandit aliquam etiam erat velit. Vulputate sapien nec sagittis aliquam malesuada bibendum. Quisque id diam vel quam elementum pulvinar etiam. Magna eget est lorem ipsum dolor sit. Felis bibendum ut tristique et egestas quis ipsum suspendisse. Nunc mattis enim',0,NULL,3,'2021-11-09 19:54:21'),(17,'Another post','By Mark andy ipsum ipsum lorem dolar',0,NULL,3,'2021-11-10 14:10:11'),(18,'My newest update','This post would contain a descriptive picture of what is being posted',0,NULL,5,'2021-11-11 06:21:46'),(22,'A pictured post','This is a post with a descriptive image',1,NULL,3,'2021-11-11 06:59:12');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(20) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `postid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `postid` (`postid`),
  CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`),
  CONSTRAINT `tags_ibfk_2` FOREIGN KEY (`postid`) REFERENCES `posts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `birthdate` datetime DEFAULT NULL,
  `about` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'mufid','Fusheini',NULL,'mufid','','$2y$10$aO4G.nl8nexk40d/OT.ONO7VgmX9k2hJ4D1B32pndY0qPrMVZOl8S',NULL,'Bibendum est ultricies integeleifend quam adipiscing'),(3,'Mark','Eddy','Tester','markandy','a@b.com','$2y$10$.jQSBV6FD3p/SxlzLDz28e/4iXaeOIR2JxfPMVUncYVMTuj4hk2MC',NULL,'Lorem ipsum'),(5,'Kofi','Kojo','Kwasi','Kokokw','k@kw.com','$2y$10$cvqdUlw9/TqDUxUNY7Eq4uZMCRX3rfiaM/71XxBVdbLc8EcZxgr7W',NULL,'Lorem ipsum dollar emt');
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

-- Dump completed on 2021-11-13  8:22:55
