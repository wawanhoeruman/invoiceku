-- MySQL dump 10.19  Distrib 10.3.39-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: invoiceku
-- ------------------------------------------------------
-- Server version	10.3.39-MariaDB-0ubuntu0.20.04.2

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
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `telepon` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (23,'Use A Test','0812988877665','usera@yopmail.com','Warung Buncit Jaksel','2026-04-27 03:39:03'),(25,'User C Test','089876543213','userc@yopmail.com','Lenteng agung Jaksel','2026-04-27 03:40:16'),(26,'User D Test','087654332212','userd@yopmail.com','Pasarebo Jaksel','2026-04-27 04:36:59'),(30,'Matt Shadows A&X','0812345566677','matt@yopmail.com','LA','2026-04-30 04:28:20');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_items`
--

DROP TABLE IF EXISTS `invoice_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) DEFAULT NULL,
  `nama_item` varchar(150) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` decimal(15,2) DEFAULT NULL,
  `subtotal` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_items`
--

LOCK TABLES `invoice_items` WRITE;
/*!40000 ALTER TABLE `invoice_items` DISABLE KEYS */;
INSERT INTO `invoice_items` VALUES (39,24,'Hijab Bergo Simple Brandid',50,90000.00,4500000.00),(40,24,'Hijab Segi Empat Size M',30,18000.00,540000.00),(41,24,'Hijab Segi Empat Size L',30,20000.00,600000.00),(42,24,'Mukena Simpel Elegan',20,120000.00,2400000.00),(43,25,'Hijab Anak Sekolah',100,11000.00,1100000.00),(44,25,'Gamis Wanita Muslimah Premium',20,180000.00,3600000.00),(45,25,'Celana Cargo Pria ',20,90000.00,1800000.00),(46,26,'Hijab Bergo size L',30,125000.00,3750000.00),(47,26,'Hijab Phasmina Size L Premium',30,23000.00,690000.00),(48,27,'Hijab Phasmina Standard size L',50,15000.00,750000.00),(49,27,'Baju Koko Pria Standard',25,45000.00,1125000.00),(50,27,'Kemeja Pria Kerah Shanghai ',30,70000.00,2100000.00),(51,28,'Celana Kulot Standar Wanita',50,18000.00,900000.00),(52,28,'Hijab Segi Empat Size L Premium',30,22000.00,660000.00),(53,28,'Baju Gamis Wanita Muslimah',25,80000.00,2000000.00),(54,28,'Hijab Bergo Size M Standard',10,90000.00,900000.00),(55,29,'Hijab Phasmina Premium Size M',40,26000.00,1040000.00),(56,29,'Celana Pendek Pria Standard',20,24000.00,480000.00),(57,30,'Barang Mentah Sembako',10,90000.00,900000.00),(60,31,'Kopi ABC Sachet ajaaaa',15,13000.00,195000.00),(61,31,'Snack Ciki bombom',20,9000.00,180000.00),(62,32,'Air mineral Botol VIt 500 ml',30,35000.00,1050000.00),(64,32,'Rokok Sampoerna Mild 16btg',30,30000.00,900000.00),(73,37,'Geudng latihan bale endah room',1,60000000.00,60000000.00),(74,37,'konsumsi snack dll',1,10000000.00,10000000.00),(75,38,'xxxxxxxxxxxxxxxxxxxx',30,2000000.00,60000000.00),(76,38,'fdhfffffffff',5,6000000.00,30000000.00),(77,39,'beras porang 5 KG',15,150000.00,2250000.00),(78,41,'test dokumen',50,5000000.00,250000000.00),(79,40,'dummy  stok',100,1000000.00,100000000.00),(80,42,'Tahu bulat dadakan',1000,7000.00,7000000.00),(81,43,'test buggg',50,100000.00,5000000.00),(82,44,'testing roleback',40,2000.00,80000.00);
/*!40000 ALTER TABLE `invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_invoice` varchar(50) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `grand_total` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (24,'INV-20260427-104029',23,'2026-04-27',NULL,'PAID','2026-04-27 10:40:34',8040000.00,'2026-04-27 03:40:34'),(25,'INV-20260427-104305',24,'2026-04-27',NULL,'PAID','2026-04-27 10:43:11',6500000.00,'2026-04-27 03:43:11'),(26,'INV-20260427-104517',25,'2026-04-27',NULL,'PAID','2026-04-27 10:45:22',4440000.00,'2026-04-27 03:45:22'),(27,'INV-20260427-153550',26,'2026-04-27',NULL,'PAID','2026-04-27 15:35:57',3975000.00,'2026-04-27 08:35:57'),(28,'INV-20260427-160836',28,'2026-04-27',NULL,'PAID','2026-04-27 16:08:43',4460000.00,'2026-04-27 09:08:43'),(29,'INV-20260427-161217',27,'2026-04-27',NULL,'PAID','2026-04-27 16:12:23',1520000.00,'2026-04-27 09:12:23'),(30,'INV-20260428-085607',28,'2026-04-28',NULL,'PAID','2026-04-28 08:57:38',900000.00,'2026-04-28 01:57:38'),(31,'INV-20260428-100058',28,'2026-04-28',NULL,'PAID','2026-04-28 14:24:12',375000.00,'2026-04-28 03:01:05'),(32,'INV-20260428-150454',28,'2026-04-28',NULL,'PAID','2026-04-29 14:17:06',1950000.00,'2026-04-28 08:05:06'),(37,'INV-20260505-103400',30,'2026-05-05','2026-05-10','UNPAID',NULL,70000000.00,'2026-05-05 03:34:09'),(38,'INV-20260505-131450',30,'2026-05-05','2026-05-10','PAID','2026-05-05 13:15:52',90000000.00,'2026-05-05 06:14:58'),(39,'INV-20260506-095020',25,'2026-05-06','2026-05-11','PAID','2026-05-12 09:49:24',2250000.00,'2026-05-06 02:50:57'),(40,'INV-20260506-101909',25,'2026-05-06','2026-05-11','PAID','2026-05-12 09:47:38',100000000.00,'2026-05-06 03:19:11'),(41,'INV-20260512-094145',26,'2026-05-12','2026-05-17','PAID','2026-05-12 09:48:13',250000000.00,'2026-05-12 02:41:51'),(42,'INV-20260512-095613',26,'2026-05-12','2026-05-17','PAID','2026-05-12 09:56:53',7000000.00,'2026-05-12 02:56:18'),(43,'INV-20260512-100200',30,'2026-05-12','2026-05-17','PAID','2026-05-12 10:02:22',5000000.00,'2026-05-12 03:02:05'),(44,'INV-20260512-100425',23,'2026-05-12','2026-05-17','PAID','2026-05-12 10:04:48',80000.00,'2026-05-12 03:04:31');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,NULL,'DELETE_CUSTOMER','Hapus customer ID: 29','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-04-30 10:47:22'),(3,NULL,'LOGOUT','User logout','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-04-30 10:56:50'),(4,NULL,'LOGIN','User login: ','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-04-30 10:56:52'),(5,NULL,'DELETE_INVOICE','Hapus invoice: INV-20260428-150843','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-04-30 11:21:00'),(6,NULL,'DELETE_CUSTOMER','Hapus customer: ','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-04-30 11:21:51'),(7,NULL,'DELETE_INVOICE','Hapus invoice: INV-20260429-145818','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-04-30 11:22:45'),(8,NULL,'DELETE_CUSTOMER','Hapus customer: ','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-04-30 11:24:33'),(9,NULL,'DELETE_CUSTOMER','Hapus customer: User B Test','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-04-30 11:27:28'),(10,NULL,'CREATE_CUSTOMER','Tambah customer: Matt Shadows A&X','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-04-30 11:28:20'),(11,1,'LOGIN','User login: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-04-30 13:43:09'),(12,1,'LOGOUT','User logout: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-04-30 13:43:16'),(13,1,'LOGIN','User login: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-04-30 13:43:19'),(14,1,'CREATE_INVOICE','Buat invoice: INV-20260430-150248','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-04-30 15:02:57'),(15,1,'ADD_ITEM','Tambah item ke invoice: INV-20260430-150248','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-04-30 15:03:32'),(16,1,'ADD_ITEM','Tambah item ke invoice: INV-20260430-150248','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-04-30 15:04:34'),(17,1,'DELETE_INVOICE','Hapus invoice: INV-20260430-150248','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-04-30 15:05:49'),(18,1,'LOGIN','User login: Administrator','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-04-30 15:41:38'),(19,1,'LOGIN','User login: Administrator','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-04-30 15:41:40'),(20,1,'LOGIN','User login: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-04 10:31:20'),(21,1,'LOGOUT','User logout: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-04 11:07:37'),(22,1,'LOGIN','User login: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-04 11:07:42'),(23,1,'LOGIN','User login: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-04 13:59:40'),(24,1,'LOGOUT','User logout: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-04 14:15:33'),(25,1,'LOGIN','User login: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-04 14:15:35'),(26,1,'LOGOUT','User logout: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-04 14:59:37'),(29,1,'LOGIN','User login: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-04 15:00:12'),(30,1,'LOGOUT','User logout: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-04 15:05:18'),(31,2,'LOGIN','User login: user.staff','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-04 15:05:23'),(32,2,'LOGOUT','User logout: user.staff','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-04 15:05:31'),(33,1,'LOGIN','User login: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-04 15:05:37'),(34,1,'LOGIN','User login: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 08:47:34'),(35,1,'LOGOUT','User logout: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 09:20:57'),(36,3,'LOGIN','User login: staff admin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 09:21:05'),(37,3,'LOGOUT','User logout: staff admin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 09:23:46'),(38,1,'LOGIN','User login: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 09:24:01'),(39,1,'CREATE','Menambah user: finance A','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 09:34:08'),(40,1,'UPDATE','Update user: finance ABC','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 09:34:52'),(41,1,'DELETE','Hapus user: finance ABC','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 09:35:00'),(42,1,'LOGOUT','User logout: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 10:33:25'),(43,3,'LOGIN','User login: staff admin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 10:33:35'),(44,3,'CREATE_INVOICE','Buat invoice: INV-20260505-103400','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 10:34:09'),(45,3,'ADD_ITEM','Tambah item ke invoice: INV-20260505-103400','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 10:34:35'),(46,3,'ADD_ITEM','Tambah item ke invoice: INV-20260505-103400','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 10:34:58'),(47,3,'LOGOUT','User logout: staff admin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 10:35:47'),(48,1,'LOGIN','User login: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 10:35:58'),(49,1,'CREATE','Menambah user: ahmad aji','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 11:09:41'),(50,1,'CREATE','Menambah user: salman faris','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 11:10:17'),(51,1,'CREATE','Menambah user: alisa helmiani','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 11:10:55'),(52,1,'CREATE','Menambah user: anisa cekos','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 11:11:21'),(53,1,'UPDATE','Update user: staff admin','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 11:11:45'),(54,1,'LOGOUT','User logout: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 11:39:00'),(55,7,'LOGIN','User login: alisa helmiani','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 11:40:37'),(56,7,'LOGOUT','User logout: alisa helmiani','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 11:42:33'),(57,1,'LOGIN','User login: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 11:42:38'),(58,1,'CREATE_INVOICE','Buat invoice: INV-20260505-131450','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 13:14:58'),(59,1,'ADD_ITEM','Tambah item ke invoice: INV-20260505-131450','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 13:15:08'),(60,1,'ADD_ITEM','Tambah item ke invoice: INV-20260505-131450','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 13:15:17'),(61,1,'PAID_INVOICE','Invoice dibayar: INV-20260505-131450','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 13:15:52'),(62,1,'LOGOUT','User logout: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 13:39:23'),(63,1,'LOGIN','User login: Administrator','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 13:39:30'),(64,1,'CREATE_CUSTOMER','Tambah customer: ahmad fauzan alllll','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 13:57:34'),(65,1,'DELETE_CUSTOMER','Hapus customer: ahmad fauzan alllll','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 13:57:43'),(66,1,'CREATE_CUSTOMER','Tambah customer: alisa puput','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0','2026-05-05 14:16:44'),(68,1,'LOGIN','User login: Administrator','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-06 09:04:47'),(69,1,'CREATE_INVOICE','Buat invoice: INV-20260506-095020','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-06 09:50:57'),(70,1,'ADD_ITEM','Tambah item ke invoice: INV-20260506-095020','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-06 09:51:25'),(71,1,'CREATE_INVOICE','Buat invoice: INV-20260506-101909','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-06 10:19:11'),(72,1,'LOGOUT','User logout: Administrator','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-06 10:20:50'),(73,1,'LOGIN','User login: Administrator','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-06 10:22:31'),(74,1,'LOGIN','User login: Administrator','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-07 15:02:52'),(75,1,'DELETE','Hapus user: alisa helmiani','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-07 15:03:05'),(76,1,'LOGIN','User login: Administrator','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 08:55:40'),(77,1,'CREATE_INVOICE','Buat invoice: INV-20260512-094145','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 09:41:51'),(78,1,'ADD_ITEM','Tambah item ke invoice: INV-20260512-094145','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 09:42:00'),(79,1,'ADD_ITEM','Tambah item ke invoice: INV-20260506-101909','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 09:47:26'),(80,1,'PAID_INVOICE','Invoice dibayar: INV-20260506-101909','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 09:47:38'),(81,1,'PAID_INVOICE','Invoice dibayar: INV-20260512-094145','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 09:48:13'),(82,1,'PAID_INVOICE','Invoice dibayar: INV-20260506-095020','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 09:49:24'),(83,1,'CREATE_INVOICE','Buat invoice: INV-20260512-095613','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 09:56:18'),(84,1,'ADD_ITEM','Tambah item ke invoice: INV-20260512-095613','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 09:56:36'),(85,1,'PAID_INVOICE','Invoice dibayar: INV-20260512-095613','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 09:56:53'),(86,1,'CREATE_INVOICE','Buat invoice: INV-20260512-100200','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 10:02:05'),(87,1,'ADD_ITEM','Tambah item ke invoice: INV-20260512-100200','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 10:02:15'),(88,1,'PAID_INVOICE','Invoice dibayar: INV-20260512-100200','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 10:02:22'),(89,1,'CREATE_INVOICE','Buat invoice: INV-20260512-100425','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 10:04:31'),(90,1,'ADD_ITEM','Tambah item ke invoice: INV-20260512-100425','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 10:04:41'),(91,1,'PAID_INVOICE','Invoice dibayar: INV-20260512-100425','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 10:04:48'),(92,1,'LOGIN','User login: Administrator','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 13:29:08'),(93,1,'LOGIN','User login: Administrator','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 15:38:11'),(94,1,'LOGIN','User login: Administrator','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-12 15:39:35'),(95,1,'LOGIN','User login: Administrator','10.0.2.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','2026-05-13 09:10:58');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','staff') DEFAULT 'staff',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$Ge/E3AOxLCnPGS6EWZ/M2emInh3kpX4BFmIcQpUMiZVeFqfutky22','Administrator','2026-04-20 03:01:01','admin'),(3,'staff.admin','$2y$10$zhjgg5wVo9n3jncAxV1nXOxNV4ZTsV7plyxDGjSZ5mR1iS0K.qV3.','staff admin','2026-05-05 02:20:49','staff'),(5,'ahmad.finance','$2y$10$ik90KZOvg1t9lxa3yckri.Z8QABSLSnGbh4o6ldICFsNTV8mx5Aeu','ahmad aji','2026-05-05 04:09:40','staff'),(6,'faris.finance','$2y$10$FUcOtSU7dT19Ggi3OtbRKOgSHmAOzmVpNkWvmHrPeVqWkGAZ4mxBu','salman faris','2026-05-05 04:10:17','staff'),(8,'ica.hr','$2y$10$w/YTcFCulWCx/wWDu/8NB.bSVGT2iuFZmp1H6KvMsGjRlZyAhO716','anisa cekos','2026-05-05 04:11:21','staff');
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

-- Dump completed on 2026-05-13 11:02:33
