-- MySQL dump 10.13  Distrib 8.0.24, for Win64 (x86_64)
--
-- Host: localhost    Database: salioviajeuy_salioviajeuy
-- ------------------------------------------------------
-- Server version	8.0.24

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
  `RUT` varchar(12) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Nombre_C` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Razon_S` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Nro_MTOP` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Pass_MTOP` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Usuario_ID` int NOT NULL,
  `Tipo_Usuario` varchar(3) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDUsuario_idx` (`Usuario_ID`),
  CONSTRAINT `IDUsu` FOREIGN KEY (`Usuario_ID`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
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
  CONSTRAINT `Empresa` FOREIGN KEY (`ID_Empresa`) REFERENCES `empresas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario-empresa`
--

LOCK TABLES `usuario-empresa` WRITE;
/*!40000 ALTER TABLE `usuario-empresa` DISABLE KEYS */;
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
  `CI` varchar(8) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Email` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Apellido` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Barrio` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Departamento` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Telefono` varchar(9) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Agencia_C` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `PIN` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `RUT` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Usuario` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Passwd` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Supervisor` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Nombre_Hotel` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Direccion_Hotel` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Usuario_UNIQUE` (`Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (184,'ADM','53493317','DFGH','DFGH','DFGH',NULL,NULL,NULL,'3456',NULL,'1234',NULL,'ADMIN','ADMIN',NULL,NULL,NULL),(185,'PAX','53493317','medicenfirpito@gmail.com','Gaston','Firpo','Ombu','Solymar','Canelones','91456456',NULL,'1234',NULL,NULL,NULL,NULL,NULL,NULL);
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
  `Matricula` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Marca` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Modelo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Combustible` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Capacidad` int NOT NULL,
  `Equipaje` int NOT NULL,
  `PetFriendly` int NOT NULL,
  `RUT_EM` varchar(12) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `RUT_EC` varchar(12) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculos`
--

LOCK TABLES `vehiculos` WRITE;
/*!40000 ALTER TABLE `vehiculos` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehiculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitas`
--

DROP TABLE IF EXISTS `visitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `visitas` (
  `Visitas` int unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`Visitas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitas`
--

LOCK TABLES `visitas` WRITE;
/*!40000 ALTER TABLE `visitas` DISABLE KEYS */;
INSERT INTO `visitas` VALUES (23);
/*!40000 ALTER TABLE `visitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'salioviajeuy_salioviajeuy'
--
/*!50106 SET @save_time_zone= @@TIME_ZONE */ ;
/*!50106 DROP EVENT IF EXISTS `reset_visitas` */;
DELIMITER ;;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;;
/*!50003 SET character_set_client  = utf8 */ ;;
/*!50003 SET character_set_results = utf8 */ ;;
/*!50003 SET collation_connection  = utf8_spanish_ci */ ;;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;;
/*!50003 SET @saved_time_zone      = @@time_zone */ ;;
/*!50003 SET time_zone             = 'SYSTEM' */ ;;
/*!50106 CREATE*/ /*!50117 DEFINER=`salioviajeuy`@`localhost`*/ /*!50106 EVENT `reset_visitas` ON SCHEDULE EVERY 1 DAY STARTS '2022-02-03 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO delete from visitas */ ;;
/*!50003 SET time_zone             = @saved_time_zone */ ;;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;;
/*!50003 SET character_set_client  = @saved_cs_client */ ;;
/*!50003 SET character_set_results = @saved_cs_results */ ;;
/*!50003 SET collation_connection  = @saved_col_connection */ ;;
DELIMITER ;
/*!50106 SET TIME_ZONE= @save_time_zone */ ;

--
-- Dumping routines for database 'salioviajeuy_salioviajeuy'
--
/*!50003 DROP PROCEDURE IF EXISTS `agrego_visita` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_spanish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`salioviajeuy`@`localhost` PROCEDURE `agrego_visita`()
BEGIN
IF (select count(*) from visitas) = 0 THEN
	insert into visitas values (DEFAULT);
	select * from visitas;
ELSE
	UPDATE `salioviajeuy_salioviajeuy`.`visitas` SET `Visitas` = visitas+1 WHERE (`Visitas` = visitas);
    select * from visitas;
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `login` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_spanish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`salioviajeuy`@`localhost` PROCEDURE `login`(usuario varchar(12))
BEGIN
  SELECT ID,PIN,Passwd,Nombre,Apellido,Tipo_Usuario FROM usuarios where CI = usuario or RUT = usuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `register_empresa` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_spanish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`salioviajeuy`@`localhost` PROCEDURE `register_empresa`(rut varchar(12),nombre_comercial varchar(45),razon_social varchar(45),numero_mtop int, password_mtop varchar(45),tipo_usuario varchar(3),id_usuario int)
BEGIN 
  
  INSERT INTO `salioviajeuy_salioviajeuy`.`empresas` (`RUT`, `Nombre_C`, `Razon_S`, `Nro_MTOP`, `Pass_MTOP`, `Usuario_ID`, `Tipo_Usuario`) VALUES (rut, nombre_comercial, razon_social, numero_mtop, password_mtop, id_usuario, tipo_usuario);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `register_usuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`salioviajeuy`@`localhost` PROCEDURE `register_usuario`(tipoUsuario varchar(3), ci int, email varchar(45), nombre varchar(45), apellido varchar(45),direccion varchar(45),barrio varchar(45), departamento varchar(45),telefono int, pin int,RUT_AGENCIA_CONTRATISTA varchar(12),rut varchar(12), supervisor varchar(2), nombre_hotel varchar(45), direccion_hotel varchar(100))
BEGIN

IF tipoUsuario = "PAX" || tipoUsuario = "TTA"|| tipoUsuario = "ASE" THEN
    INSERT INTO salioviajeuy_salioviajeuy.usuarios (Tipo_Usuario, CI, Email, Nombre, Apellido, Direccion, Barrio, Departamento, Telefono, PIN) VALUES (tipoUsuario, ci, email, nombre, apellido, direccion, barrio, departamento, telefono, pin);
ELSEIF tipoUsuario = "CHO" || tipoUsuario = "ANF" THEN
  INSERT INTO salioviajeuy_salioviajeuy.usuarios (Tipo_Usuario, RUT, Email, Nombre, Apellido, Direccion, Barrio, Departamento, Telefono, Agencia_C, PIN) VALUES (tipoUsuario, rut, email, nombre, apellido, direccion, barrio, departamento, telefono, RUT_AGENCIA_CONTRATISTA, pin);
ELSEIF tipoUsuario = "HTL" THEN
  INSERT INTO salioviajeuy_salioviajeuy.usuarios (Tipo_Usuario, CI, Email, Nombre, Apellido, Telefono, Supervisor, Nombre_Hotel, Direccion_Hotel, PIN) VALUES (tipoUsuario, ci, email, nombre, apellido, telefono, supervisor, nombre_hotel, direccion_hotel, pin);
END IF;

SELECT LAST_INSERT_ID();
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `register_vehiculo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`salioviajeuy`@`localhost` PROCEDURE `register_vehiculo`(matricula varchar(45),marca varchar(45), modelo varchar(45),combustible varchar(45),capacidad_pasajeros int, capacidad_equipaje int, pet_friendly int, rut_empresa varchar(12), rut_ec varchar(45))
BEGIN
INSERT INTO `salioviajeuy_salioviajeuy`.`vehiculos` (`Matricula`, `Marca`, `Modelo`, `Combustible`, `Capacidad`, `Equipaje`, `PetFriendly`, `RUT_EM`, `RUT_EC`) VALUES (matricula, marca, modelo, combustible, capacidad_pasajeros, capacidad_equipaje, pet_friendly, rut_empresa, rut_ec);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `traerCi` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`salioviajeuy`@`localhost` PROCEDURE `traerCi`()
BEGIN
SELECT ID FROM `salioviajeuy_salioviajeuy`.`usuarios` where CI = 53493317;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `traigo_empresas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`salioviajeuy`@`localhost` PROCEDURE `traigo_empresas`()
BEGIN
SELECT Nombre_C,Razon_S,RUT FROM empresas;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `visitas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_spanish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`salioviajeuy`@`localhost` PROCEDURE `visitas`()
BEGIN
IF (select count(*) from visitas) = 0 THEN
	insert into visitas values (DEFAULT);
	select * from visitas;
ELSE
	UPDATE `salioviajeuy_salioviajeuy`.`visitas` SET `Visitas` = visitas+1 WHERE (`Visitas` = visitas);
    select * from visitas;
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-03 13:59:47
