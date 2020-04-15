-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: sistemas_inventariodb
-- ------------------------------------------------------
-- Server version	5.6.47-log

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
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `desc_categoria` varchar(255) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'n/a',4);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `centro`
--

DROP TABLE IF EXISTS `centro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `centro` (
  `id_centro` int(11) NOT NULL AUTO_INCREMENT,
  `numero_centro` varchar(255) DEFAULT NULL,
  `Nombre_centro` varchar(255) DEFAULT NULL,
  `direccion_centro` varchar(255) DEFAULT NULL,
  `Tel_centro` varchar(15) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_centro`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centro`
--

LOCK TABLES `centro` WRITE;
/*!40000 ALTER TABLE `centro` DISABLE KEYS */;
INSERT INTO `centro` VALUES (1,'n/a','n/a','n/a','n/a','2020-04-15 01:14:06',4);
/*!40000 ALTER TABLE `centro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_registro`
--

DROP TABLE IF EXISTS `detalle_registro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_registro` (
  `id_detalle_registro` int(11) NOT NULL AUTO_INCREMENT,
  `fk_registro` varchar(255) NOT NULL,
  `fk_producto` varchar(255) NOT NULL,
  `fk_cantidad` decimal(11,2) DEFAULT NULL,
  `desc_detalle` text NOT NULL,
  `user_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detalle_registro`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_registro`
--

LOCK TABLES `detalle_registro` WRITE;
/*!40000 ALTER TABLE `detalle_registro` DISABLE KEYS */;
INSERT INTO `detalle_registro` VALUES (1,'1','1',0.00,'enviado',4);
/*!40000 ALTER TABLE `detalle_registro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enviado`
--

DROP TABLE IF EXISTS `enviado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enviado` (
  `id_enviado` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_enviado` datetime DEFAULT NULL,
  `lugar_salida` varchar(255) DEFAULT NULL,
  `png` varchar(255) DEFAULT NULL,
  `creacion` datetime NOT NULL,
  `user_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_enviado`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enviado`
--

LOCK TABLES `enviado` WRITE;
/*!40000 ALTER TABLE `enviado` DISABLE KEYS */;
INSERT INTO `enviado` VALUES (1,'1900-01-01 00:00:00','1','http://localhost/inventario/uploads/files/9a5yj3xp_8kq60s.png','2020-04-15 01:15:29',4);
/*!40000 ALTER TABLE `enviado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ficha`
--

DROP TABLE IF EXISTS `ficha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ficha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `fk_emisor` int(11) DEFAULT NULL,
  `fk_receptor` int(11) NOT NULL,
  `user_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ficha`
--

LOCK TABLES `ficha` WRITE;
/*!40000 ALTER TABLE `ficha` DISABLE KEYS */;
INSERT INTO `ficha` VALUES (1,'2020-04-15 01:20:22',1,1,4);
/*!40000 ALTER TABLE `ficha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(255) DEFAULT NULL,
  `desc_producto` text,
  `cantidad_producto` decimal(10,0) DEFAULT NULL,
  `peso_producto` varchar(255) DEFAULT NULL,
  `dimension_producto` varchar(255) DEFAULT NULL,
  `fk_proveedor` varchar(255) DEFAULT NULL,
  `fk_categoria` varchar(255) NOT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `precio_producto` decimal(10,0) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'n/a','n/a',0,'n/a','n/a','1','1','2020-04-15 01:14:35',0,4);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_proveedor` varchar(255) DEFAULT NULL,
  `desc_proveedor` text,
  `asignado_proveedor` varchar(255) DEFAULT NULL,
  `tel_proveedor` varchar(255) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `direccion_proveedor` varchar(255) DEFAULT NULL,
  `rtn_proveedor` varchar(20) DEFAULT NULL,
  `user_created` int(11) NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (1,'n/a','n/a','n/a','n/a','2020-04-14 17:13:53','n/a','n/a',4);
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recibido`
--

DROP TABLE IF EXISTS `recibido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recibido` (
  `id_recibido` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_recibido` datetime DEFAULT NULL,
  `lugar_recibido` int(11) NOT NULL,
  `png` varchar(255) DEFAULT NULL,
  `creacion` datetime NOT NULL,
  `user_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_recibido`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recibido`
--

LOCK TABLES `recibido` WRITE;
/*!40000 ALTER TABLE `recibido` DISABLE KEYS */;
INSERT INTO `recibido` VALUES (1,'1900-01-01 00:00:00',1,'http://localhost/inventario/uploads/files/ivyzxf8dwjs3ocm.png','2020-04-15 01:15:48',4);
/*!40000 ALTER TABLE `recibido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `user_usuario` varchar(50) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `fecha_creacion_usuario` date DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `login_session_key` varchar(255) DEFAULT NULL,
  `email_status` varchar(20) DEFAULT NULL,
  `password_reset_key` varchar(255) DEFAULT NULL,
  `numero_empleado` int(11) DEFAULT NULL,
  `password_expire_date` datetime DEFAULT '2020-07-08 00:00:00',
  `rol` varchar(255) NOT NULL,
  `user_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (4,'admin','admin','erazo','admin@911.gob.hn',NULL,'$2y$10$rLogP7vTJdg.A9MTZCKdieJYxwhL1f82Kn0GS/kebb9JvP0nYhKr.','843b3982cda98263502796c65322b7da',NULL,NULL,0,'2020-07-08 00:00:00','admin',NULL),(6,'rerazo','rodrigo','Erazo','rerazo@911.gob.hn','2020-04-14','$2y$10$oCC5UUyAwoQeG92B10D9EuynhaipYQx/EiSQCsipFPA2CrtII1Eb2',NULL,NULL,NULL,2420,'2020-07-08 00:00:00','capa1',NULL),(7,'lserrano','leonardo','Serrano','lserrano@911.gob.hn','2020-04-14','$2y$10$85JhOnAIsAX9pcB/EGvg7Olgbl6AhS3afnb/EuZYVwsfENWNNvjdK',NULL,NULL,NULL,2390,'2020-07-08 00:00:00','capa2',NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-14 18:12:29
