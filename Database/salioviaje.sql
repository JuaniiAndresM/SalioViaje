-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: salioviaje
-- ------------------------------------------------------
-- Server version	8.0.26

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
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresas` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `RUT` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `Nombre_C` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `Razon_S` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `Nro_MTOP` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Pass_MTOP` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `Usuario_ID` int NOT NULL,
  `Tipo_Usuario` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDUsuario_idx` (`Usuario_ID`),
  CONSTRAINT `IDUsu` FOREIGN KEY (`Usuario_ID`) REFERENCES `usuarios` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,'123456123456','Pedrito','S.A','123','1232',1,'TTA');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario-empresa`
--

DROP TABLE IF EXISTS `usuario-empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario-empresa` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ID_Usuario` int NOT NULL,
  `ID_Empresa` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Usuario_idx` (`ID_Usuario`),
  KEY `Empresa_idx` (`ID_Empresa`),
  CONSTRAINT `Empresa` FOREIGN KEY (`ID_Empresa`) REFERENCES `empresas` (`ID`),
  CONSTRAINT `Usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario-empresa`
--

LOCK TABLES `usuario-empresa` WRITE;
/*!40000 ALTER TABLE `usuario-empresa` DISABLE KEYS */;
INSERT INTO `usuario-empresa` VALUES (1,1,1),(2,2,1);
/*!40000 ALTER TABLE `usuario-empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Tipo_Usuario` varchar(3) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CI` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `Email` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `Nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Apellido` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Barrio` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Departamento` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `Agencia_C` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `PIN` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'TTA','12345678','algo@gmail.com','Juan','Martinez','Av.Italia','Pocitos','Montevideo','98123414',NULL,'1234'),(2,'CHO','12345679','algo2@gmail.com','Martín','Rodriguez','Gianattasio','Solymar','Canelones','98123415',NULL,'1235');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehiculos`
--

DROP TABLE IF EXISTS `vehiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehiculos` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Matricula` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `Marca` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Modelo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Combustible` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Capacidad` int NOT NULL,
  `Equipaje` int NOT NULL,
  `PetFriendly` int NOT NULL,
  `RUT_EM` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `RUT_EC` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculos`
--

LOCK TABLES `vehiculos` WRITE;
/*!40000 ALTER TABLE `vehiculos` DISABLE KEYS */;
INSERT INTO `vehiculos` VALUES (1,'STU4712','Hyundai','H46','Diesel',6,0,0,'123456123456','0');
/*!40000 ALTER TABLE `vehiculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'salioviaje'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-28 12:15:30
