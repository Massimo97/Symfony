-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: blog
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'recettes');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createat` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CA76ED395` (`user_id`),
  KEY `IDX_9474526C4B89032C` (`post_id`),
  CONSTRAINT `FK_9474526C4B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (4,7,3,'test','2022-06-17 12:08:46'),(5,7,9,'Miam','2022-06-17 12:47:42'),(6,7,2,'Manger','2022-06-17 12:48:58'),(7,7,2,'Hello','2022-06-17 12:49:15'),(8,7,9,'Méchant l\'assiette de pate','2022-06-17 12:51:13'),(9,7,3,'Miam','2022-06-17 12:52:58'),(10,9,9,'toto','2022-06-17 13:10:29');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `token` int NOT NULL,
  `createat` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4C62E638A76ED395` (`user_id`),
  CONSTRAINT `FK_4C62E638A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,1,'test@gmail.com','test',1257852,'2022-05-05 00:00:00');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20220617095652','2022-06-17 09:57:06',384),('DoctrineMigrations\\Version20220617103004','2022-06-17 10:30:12',106);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `src` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (1,'images/pasta.jpg'),(2,'images/aperitif-1.jpg'),(3,'images/aperitif-2.jpg'),(4,'images/bruschetta-b.jpg'),(5,'images/bruschetta.jpg'),(6,'images/burger.jpg'),(7,'images/cake.jpg'),(8,'images/cookies.jpg'),(9,'images/cupcakes.jpg'),(10,'images/gnocchis.jpg'),(11,'images/pizza.jpg'),(12,'images/profil.jpg'),(13,'images/rice.jpg'),(14,'images/salad.jpg'),(15,'images/sushis.jpg');
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `category_id` int NOT NULL,
  `image_id` int DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `createat` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5A8A6C8D3DA5256D` (`image_id`),
  KEY `IDX_5A8A6C8DA76ED395` (`user_id`),
  KEY `IDX_5A8A6C8D12469DE2` (`category_id`),
  CONSTRAINT `FK_5A8A6C8D12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_5A8A6C8D3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  CONSTRAINT `FK_5A8A6C8DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (2,2,1,2,'Vestibulum ante ipsum primis in faucibus orci luctus','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut consectetur dolor nibh, id congue eros pulvinar sit amet. Duis ac lorem metus. Aenean ut urna consectetur, convallis metus ut, hendrerit urna. ','2022-05-09 00:00:00'),(3,2,1,3,'Ut eget lectus eleifend nibh aliquam porta in quis risus','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut consectetur dolor nibh, id congue eros pulvinar sit amet. Duis ac lorem metus. Aenean ut urna consectetur, convallis metus ut, hendrerit urna. ','2022-05-08 00:00:00'),(4,2,1,4,'Donec at rhoncus risus. Sed molestie elit id commodo sagittis','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut consectetur dolor nibh, id congue eros pulvinar sit amet. Duis ac lorem metus. Aenean ut urna consectetur, convallis metus ut, hendrerit urna. ','2022-05-07 00:00:00'),(5,2,1,5,'Maecenas sit amet massa malesuada','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut consectetur dolor nibh, id congue eros pulvinar sit amet. Duis ac lorem metus. Aenean ut urna consectetur, convallis metus ut, hendrerit urna. ','2022-05-06 00:00:00'),(6,2,1,6,'sollicitudin mauris eu, aliquam nibh','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut consectetur dolor nibh, id congue eros pulvinar sit amet. Duis ac lorem metus. Aenean ut urna consectetur, convallis metus ut, hendrerit urna. ','2022-05-05 00:00:00'),(7,2,1,7,'Etiam interdum pretium sapien, eget mollis velit maximus non','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut consectetur dolor nibh, id congue eros pulvinar sit amet. Duis ac lorem metus. Aenean ut urna consectetur, convallis metus ut, hendrerit urna. ','2022-05-04 00:00:00'),(8,2,1,8,'Etiam interdum pretium sapien, eget mollis velit maximus non','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut consectetur dolor nibh, id congue eros pulvinar sit amet. Duis ac lorem metus. Aenean ut urna consectetur, convallis metus ut, hendrerit urna. ','2022-05-03 00:00:00'),(9,2,1,1,'Nulla gravida condimentum justo nec rhoncus','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut consectetur dolor nibh, id congue eros pulvinar sit amet. Duis ac lorem metus. Aenean ut urna consectetur, convallis metus ut, hendrerit urna. ','2022-05-10 00:00:00');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image_id` int DEFAULT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `roles` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sessiontoken` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D6493DA5256D` (`image_id`),
  CONSTRAINT `FK_8D93D6493DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,9,'maxime@gmail.com','user','','maxime','token','maxime','toto',0),(2,5,'louis@gmail.com','user','','louis','token','louis','toto',0),(3,10,'matteo@gmail.com','user','','matteo','token','matteo','toto',0),(4,8,'jules@gmail.com','user','toto','jules','token','jules','toto',0),(5,NULL,'test@email.com','[\"ROLE_USER\"]','$2y$13$18IPpu2nwI8KujrDXbqHYuTxRfrBCInaEBSOVAGeZZ9TQpQUtukwG','test',NULL,'tets','test',0),(6,NULL,'salut-test@email.com','[\"ROLE_USER\"]','$2y$13$LbcQ1RPwt24NPm5CDBxBReIQLJF09GtAyNg7pVg7UqEexI1wwPKQm','salut',NULL,'salut','salut',0),(7,NULL,'cuisto@gmail.com','[\"ROLE_USER\"]','$2y$13$YbLgVxlo9YZPSWZ34dsHxuVYSFKzOkeXOmxpCS5qSpOPvb3uH36NO','Cuisto',NULL,'cuisto','gusto',0),(8,NULL,'gusto@gmail.com','[\"ROLE_USER\"]','$2y$13$HB3CL96E1JncZ8pKbbl.1OfJ.G24yBCNzaDNdXaUuPw01sOv4/rou','Gusto',NULL,'Gusto','Cuisto',0),(9,NULL,'gusto.cuisto@gmail.com','[\"ROLE_USER\"]','$2y$13$KRVSwLYcC8P6kgT4CrGfBeyhijkmIyLxMcMx41sWmKM9hMXdBudqG','Gusto',NULL,'Gusto','Cuisto',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-17 15:34:50
