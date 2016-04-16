-- MySQL dump 10.15  Distrib 10.0.22-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: laravel-ecommerce
-- ------------------------------------------------------
-- Server version	10.0.22-MariaDB

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
-- Table structure for table `attributes`
--

DROP TABLE IF EXISTS `attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `backend_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attributes`
--

LOCK TABLES `attributes` WRITE;
/*!40000 ALTER TABLE `attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Accumulators','2016-04-16 08:29:17','2016-04-16 08:29:17'),(2,'Engines','2016-04-16 08:29:18','2016-04-16 08:29:18');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_attribute`
--

DROP TABLE IF EXISTS `category_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `attribute_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_attribute_category_id_index` (`category_id`),
  KEY `category_attribute_attribute_id_index` (`attribute_id`),
  CONSTRAINT `category_attribute_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attributes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_attribute_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_attribute`
--

LOCK TABLES `category_attribute` WRITE;
/*!40000 ALTER TABLE `category_attribute` DISABLE KEYS */;
INSERT INTO `category_attribute` VALUES (1,1,1,NULL,NULL),(2,1,3,NULL,NULL),(3,1,4,NULL,NULL),(4,2,2,NULL,NULL),(5,2,3,NULL,NULL),(6,2,4,NULL,NULL);
/*!40000 ALTER TABLE `category_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eav_attribute_options`
--

DROP TABLE IF EXISTS `eav_attribute_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eav_attribute_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` int(10) unsigned NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `eav_attribute_options_attribute_id_foreign` (`attribute_id`),
  CONSTRAINT `eav_attribute_options_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attributes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eav_attribute_options`
--

LOCK TABLES `eav_attribute_options` WRITE;
/*!40000 ALTER TABLE `eav_attribute_options` DISABLE KEYS */;
INSERT INTO `eav_attribute_options` VALUES (1,3,'Sparko','2016-04-16 08:29:18','2016-04-16 08:29:18'),(2,3,'Bosch','2016-04-16 08:29:18','2016-04-16 08:29:18'),(3,3,'Boge','2016-04-16 08:29:18','2016-04-16 08:29:18'),(4,4,'BMW X5','2016-04-16 08:29:18','2016-04-16 08:29:18'),(5,4,'Toyota Corolla','2016-04-16 08:29:18','2016-04-16 08:29:18'),(6,4,'Wolkswagen Passat','2016-04-16 08:29:18','2016-04-16 08:29:18'),(7,4,'Mazda Z5','2016-04-16 08:29:18','2016-04-16 08:29:18'),(8,4,'Nissan Kashkai','2016-04-16 08:29:18','2016-04-16 08:29:18');
/*!40000 ALTER TABLE `eav_attribute_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eav_attributes`
--

DROP TABLE IF EXISTS `eav_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eav_attributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `collection` tinyint(1) NOT NULL DEFAULT '0',
  `default_value` text COLLATE utf8_unicode_ci,
  `optionable` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eav_attributes`
--

LOCK TABLES `eav_attributes` WRITE;
/*!40000 ALTER TABLE `eav_attributes` DISABLE KEYS */;
INSERT INTO `eav_attributes` VALUES (1,'capacity','Capacity, amper*h','App\\Eav\\Value\\Data\\Integer','App\\Product',0,'1000',0),(2,'cylinder_count','Cylinders count','App\\Eav\\Value\\Data\\Integer','App\\Product',0,NULL,0),(3,'manufacturer','Manufacturer','App\\Eav\\Value\\Data\\Option','App\\Product',0,'3',1),(4,'compatible_cars','Compatible with cars','App\\Eav\\Value\\Data\\Option','App\\Product',1,'1',1);
/*!40000 ALTER TABLE `eav_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eav_values_boolean`
--

DROP TABLE IF EXISTS `eav_values_boolean`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eav_values_boolean` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` tinyint(1) NOT NULL,
  `attribute_id` int(10) unsigned NOT NULL,
  `entity_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eav_values_boolean`
--

LOCK TABLES `eav_values_boolean` WRITE;
/*!40000 ALTER TABLE `eav_values_boolean` DISABLE KEYS */;
/*!40000 ALTER TABLE `eav_values_boolean` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eav_values_datetime`
--

DROP TABLE IF EXISTS `eav_values_datetime`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eav_values_datetime` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` datetime NOT NULL,
  `attribute_id` int(10) unsigned NOT NULL,
  `entity_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eav_values_datetime`
--

LOCK TABLES `eav_values_datetime` WRITE;
/*!40000 ALTER TABLE `eav_values_datetime` DISABLE KEYS */;
/*!40000 ALTER TABLE `eav_values_datetime` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eav_values_integer`
--

DROP TABLE IF EXISTS `eav_values_integer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eav_values_integer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` int(11) NOT NULL,
  `attribute_id` int(10) unsigned NOT NULL,
  `entity_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eav_values_integer`
--

LOCK TABLES `eav_values_integer` WRITE;
/*!40000 ALTER TABLE `eav_values_integer` DISABLE KEYS */;
INSERT INTO `eav_values_integer` VALUES (1,1200,1,1),(2,2200,1,2),(3,4,2,3),(4,6,2,4),(5,1000,1,5);
/*!40000 ALTER TABLE `eav_values_integer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eav_values_option`
--

DROP TABLE IF EXISTS `eav_values_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eav_values_option` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` int(11) NOT NULL,
  `attribute_id` int(10) unsigned NOT NULL,
  `entity_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eav_values_option`
--

LOCK TABLES `eav_values_option` WRITE;
/*!40000 ALTER TABLE `eav_values_option` DISABLE KEYS */;
/*!40000 ALTER TABLE `eav_values_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eav_values_varchar`
--

DROP TABLE IF EXISTS `eav_values_varchar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eav_values_varchar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attribute_id` int(10) unsigned NOT NULL,
  `entity_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eav_values_varchar`
--

LOCK TABLES `eav_values_varchar` WRITE;
/*!40000 ALTER TABLE `eav_values_varchar` DISABLE KEYS */;
/*!40000 ALTER TABLE `eav_values_varchar` ENABLE KEYS */;
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
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2015_06_18_000000_create_eav_attributes_table',1),('2016_02_29_000000_create_eav_values_boolean_table',1),('2016_02_29_000000_create_eav_values_datetime_table',1),('2016_02_29_000000_create_eav_values_integer_table',1),('2016_02_29_000000_create_eav_values_varchar_table',1),('2016_04_09_222036_create_main_tables',1),('2016_04_10_083325_create_eav_values_option_table',1),('2016_04_10_085216_create_eav_attribute_options_table',1),('2016_04_16_105404_add_optionable_column_to_eav_attributes_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_attribute_foreignkey`
--

DROP TABLE IF EXISTS `product_attribute_foreignkey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_attribute_foreignkey` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `attribute_id` int(10) unsigned NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attribute_foreignkey_product_id_foreign` (`product_id`),
  KEY `product_attribute_foreignkey_attribute_id_foreign` (`attribute_id`),
  CONSTRAINT `product_attribute_foreignkey_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_attribute_foreignkey_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_attribute_foreignkey`
--

LOCK TABLES `product_attribute_foreignkey` WRITE;
/*!40000 ALTER TABLE `product_attribute_foreignkey` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_attribute_foreignkey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_attribute_int`
--

DROP TABLE IF EXISTS `product_attribute_int`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_attribute_int` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `attribute_id` int(10) unsigned NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attribute_int_product_id_foreign` (`product_id`),
  KEY `product_attribute_int_attribute_id_foreign` (`attribute_id`),
  CONSTRAINT `product_attribute_int_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_attribute_int_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_attribute_int`
--

LOCK TABLES `product_attribute_int` WRITE;
/*!40000 ALTER TABLE `product_attribute_int` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_attribute_int` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_attribute_varchar`
--

DROP TABLE IF EXISTS `product_attribute_varchar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_attribute_varchar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `attribute_id` int(10) unsigned NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attribute_varchar_product_id_foreign` (`product_id`),
  KEY `product_attribute_varchar_attribute_id_foreign` (`attribute_id`),
  CONSTRAINT `product_attribute_varchar_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_attribute_varchar_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_attribute_varchar`
--

LOCK TABLES `product_attribute_varchar` WRITE;
/*!40000 ALTER TABLE `product_attribute_varchar` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_attribute_varchar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `sale_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'accumulator1','Cool Accumulator 1',22,'accumulator1 description',11,0.00,'2016-04-16 08:29:19','2016-04-16 08:32:08'),(2,1,'accumulator2','Cool Accumulator 2',102,'accumulator2 description',12,0.00,'2016-04-16 08:29:19','2016-04-16 08:29:19'),(3,2,'engine1','Cool Engine 1',201,'engine1 description',21,0.00,'2016-04-16 08:29:19','2016-04-16 08:29:19'),(4,2,'engine2','Cool Engine 2',202,'engine2 description',22,0.00,'2016-04-16 08:29:19','2016-04-16 08:29:19'),(5,1,'a5','a5',1111,'coll accc',0,0.00,'2016-04-16 09:35:08','2016-04-16 09:35:08');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
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
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2016-04-16 15:55:31
