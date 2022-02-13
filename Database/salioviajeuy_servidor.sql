-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: salioviajeuy_salioviajeuy
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
-- Table structure for table `agenda`
--

DROP TABLE IF EXISTS `agenda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `agenda` (
  `idViaje` int NOT NULL AUTO_INCREMENT,
  `Vehiculo` varchar(45) NOT NULL,
  `Distancia` int NOT NULL,
  `CantidadPasajeros` int NOT NULL,
  `Fecha` varchar(45) NOT NULL,
  `Origen` varchar(45) NOT NULL,
  `Destino` varchar(45) NOT NULL,
  `Precio` varchar(45) NOT NULL,
  `Rutas` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) NOT NULL DEFAULT 'Indefinido',
  PRIMARY KEY (`idViaje`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agenda`
--

LOCK TABLES `agenda` WRITE;
/*!40000 ALTER TABLE `agenda` DISABLE KEYS */;
/*!40000 ALTER TABLE `agenda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `RUT` varchar(12) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Nombre_C` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Razon_S` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Nro_MTOP` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Pass_MTOP` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Usuario_ID` int NOT NULL,
  `Tipo_Usuario` varchar(3) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Choferes_sub` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDUsuario_idx` (`Usuario_ID`),
  CONSTRAINT `IDUsu` FOREIGN KEY (`Usuario_ID`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (220,'210000000012','tta','apellidotta','1234567890','1234567890',320,'TTA',1),(221,'210000000013','SEGUDONOMBRE','SEGUNDAEMPRESA','2147483647','2222222223',320,'TTA',2),(222,'123456789012','Totum','S.A','0','',325,'TTA',1),(223,'213030000019','ChoferUNO','CHO SRL','0','',326,'CHO',0),(224,'213040000018','SegundaEmpresa','SegundaCHO','1234567890','1234567890',326,'CHO',0),(225,'211389990017','Empresa Anf 1','Anfit 1 srl','898888','123456',329,'ANF',0),(226,'212148880019','Agencia l poderoda','poder sa','0','',331,'AGT',0);
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `idPregunta` int NOT NULL AUTO_INCREMENT,
  `Pregunta` varchar(150) NOT NULL,
  `Respuesta` longtext NOT NULL,
  PRIMARY KEY (`idPregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (41,'¿Cuándo es el lanzamiento de Salió Viaje?','Esta previsto para fines de febrero.');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oportunidades`
--

DROP TABLE IF EXISTS `oportunidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `oportunidades` (
  `idOportunidad` int NOT NULL AUTO_INCREMENT,
  `Descuento` int NOT NULL,
  `Vehiculo` varchar(45) NOT NULL,
  `Distancia` int NOT NULL,
  `CantidadPasajeros` int NOT NULL,
  `Fecha` varchar(45) NOT NULL,
  `Origen` varchar(45) NOT NULL,
  `Destino` varchar(45) NOT NULL,
  `Precio` varchar(45) NOT NULL,
  `Rutas` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) NOT NULL DEFAULT 'Indefinido',
  PRIMARY KEY (`idOportunidad`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oportunidades`
--

LOCK TABLES `oportunidades` WRITE;
/*!40000 ALTER TABLE `oportunidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `oportunidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario-empresa`
--

DROP TABLE IF EXISTS `usuario-empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
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
/*!50503 SET character_set_client = utf8 */;
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
  `Telefono` varchar(9) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Agencia_C` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `PIN` varchar(70) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `RUT` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Usuario` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Passwd` varchar(70) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Supervisor` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Nombre_Hotel` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Direccion_Hotel` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Usuario_UNIQUE` (`Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=332 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (318,'ADM','11111111','info@salioviaje.com.uy','Daniel','Schlebinger','','','','',NULL,'$2y$10$g0BAzrmFMxU3Jw5w0avZZ.NdEZoSgh50Ru4ygZYwB7mgkFmohby22',NULL,'salioviajeuy_daniel','$2a$10$P2tUEu.tdvBIdAxkavJhgeESTVgMuGBoz30yAVmVMz1N7GGrfQ1de',NULL,NULL,NULL),(319,'ADM','88888888','info@salioviaje.com.uy','Gustavo','Gutiérrez',NULL,NULL,NULL,NULL,NULL,'$2y$10$g0BAzrmFMxU3Jw5w0avZZ.NdEZoSgh50Ru4ygZYwB7mgkFmohby22',NULL,'salioviajeuy_gustavo','$2a$10$P2tUEu.tdvBIdAxkavJhgeESTVgMuGBoz30yAVmVMz1N7GGrfQ1de',NULL,NULL,NULL),(320,'TTA','12222224','gg@salioviaje.com.uy','TTA nombre','Tta','soca 333','buceo','mvd','91833337',NULL,'$2y$10$cpkpwKapVYiL/4/R3.KqCOfKq2C.oX.oYtByIPeS5ycduNHfsNudS','210000000012',NULL,NULL,NULL,NULL,NULL),(324,'PAX','56132732','manuelalonsodesign@gmail.com','Manuel','Alonso','Juncos','Solymar','Canelones','92614110',NULL,'$2y$10$ukwHNRleY1eij4itGPG9QO49AW6SomhCcQg8W.1mF8cMEpYdG9BBW',NULL,NULL,NULL,NULL,NULL,NULL),(325,'TTA','54879239','thewolfmodzyt@gmail.com','Juan','Morena','Pereida ST','Rondeau','Canelones','98234717',NULL,'$2y$10$jyfJkXZElRnEGP7xbwISeeAnOrFVWGforjcn0Hi0Pdz.9DaQziSBi','123456789012',NULL,NULL,NULL,NULL,NULL),(326,'CHO','15555553','gg@salioviaje.com.uy','ChoferUNO','ApellidoChoUno','rivera 1234','malvin','montevideo','91833337',NULL,'$2y$10$BBPdOC/X5YGN31PrwlsRTOjs4X6FTVQv7FKwDw4EhPYSeKzhzcRbO','213030000019',NULL,NULL,NULL,NULL,NULL),(327,'PAX','15852955','thewolfmodzyt@gmail.com','Juan Andrés','Morena Echegaray','178 Rondeau','El Pinar','Canelones','98234717',NULL,'$2y$10$5eME8ngM.TolSzV9Iu/XOOkWjIKCNHA08BwzkxzvP.0KX63yvfEji',NULL,NULL,NULL,NULL,NULL,NULL),(328,'PAX','23333335','gg@salioviaje.com.uy','Juan Pedro','pEREZ','CALLE DE PEREZ','BUCEO','MVD','91833337',NULL,'$2y$10$T3na2awNMo09xKFqm2dfCONZ0g.c07Ozzy6ee00ABBI0P6U.PvLYy',NULL,NULL,NULL,NULL,NULL,NULL),(329,'ANF','26666664','gg@salioviaje.com.uy','Anfitrion 1','apellido Anfitrio','casa del anfotrion','centro','Maldonado','99401414',NULL,'$2y$10$e6Iv/motR4fkUrzMdD5ljeoie.8Za2B4UFEEYZ.6Z/u7nLjZYsH8y','211389990017',NULL,NULL,NULL,NULL,NULL),(330,'HTL','38888888','gg@salioviaje.com.uy','hOTELERO','Hoteleriro','21 de setiebre 8888','pocitos','mvd','91833337',NULL,'$2y$10$JFh1hE92kGlarCCsMhnaweMEXKQ4NFp9/gbxzmwNRgbK3ny7gTOZK',NULL,NULL,NULL,'SI','Hotel Ibis','rambla 999'),(331,'AGT','22222222','gg@salioviaje.com.uy','Super','Agente 86','hilto 2345','borro','mvd','91833337',NULL,'$2y$10$oqpyw9cFD3WJb5MwhIV8X.xfBMYBeue/DHIBD3f.zkPZjn8BeTdeO','212148880019',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehiculos`
--

DROP TABLE IF EXISTS `vehiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculos`
--

LOCK TABLES `vehiculos` WRITE;
/*!40000 ALTER TABLE `vehiculos` DISABLE KEYS */;
INSERT INTO `vehiculos` VALUES (158,'STU2007','TOYOTA','COROLLA XS','Nafta',4,2,1,'210000000012','0'),(159,'SRE0001','cITROEN','RT','Hibrido',4,2,2,'210000000012','0'),(160,'STU1123','HYUNDAI','HX','Gasoil',8,5,1,'210000000013','0'),(161,'ATU6754','MERCEDES BENZ','SPRINTER','Gasoil',17,15,1,'210000000013','0'),(162,'STU6767','Hyundai','H1 2001','Gasoil',12,12,2,'123456789012','0'),(163,'STU9999','Mercedes Benz','nfnd','Nafta',18,13,2,'210000000012','213030000019');
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
INSERT INTO `visitas` VALUES (505);
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
/*!50003 DROP PROCEDURE IF EXISTS `agendar_viaje` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_spanish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`salioviajeuy`@`localhost` PROCEDURE `agendar_viaje`(vih varchar(7),dist int,cantPax int, fecha_viaje varchar(20), org varchar(45), dest varchar(45),prc int)
BEGIN
	INSERT INTO `salioviajeuy_salioviajeuy`.`agenda` (`Vehiculo`, `Distancia`, `CantidadPasajeros`, `Fecha`, `Origen`, `Destino`, `Precio`) VALUES (vih, dist, cantPax, fecha_viaje, org, dest, prc);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `agregar_faq` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_spanish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`salioviajeuy`@`localhost` PROCEDURE `agregar_faq`(prg varchar(100),res LONGTEXT)
BEGIN
	INSERT INTO salioviajeuy_salioviajeuy.faqs (Pregunta,Respuesta) values (prg,res);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `agregar_oportunidad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_spanish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`salioviajeuy`@`localhost` PROCEDURE `agregar_oportunidad`(dsc int,vih varchar(7),dist int,cantPax int, fecha_oportunidad varchar(20), org varchar(45), dest varchar(45),prc int)
BEGIN
	INSERT INTO `salioviajeuy_salioviajeuy`.`oportunidades` (`Descuento`,`Vehiculo`, `Distancia`, `CantidadPasajeros`, `Fecha`, `Origen`, `Destino`, `Precio`) VALUES (dsc,vih, dist, cantPax, fecha_oportunidad, org, dest, prc);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
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
/*!50003 DROP PROCEDURE IF EXISTS `editar_pregunta_FAQ` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_spanish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`salioviajeuy`@`localhost` PROCEDURE `editar_pregunta_FAQ`(PRG varchar(150), RES longtext, ID int)
BEGIN
	UPDATE `salioviajeuy_salioviajeuy`.`faqs` SET `Pregunta` = PRG, `Respuesta` = RES WHERE (`idPregunta` = ID);
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
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_spanish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`salioviajeuy`@`localhost` PROCEDURE `login`(usr varchar(12))
BEGIN
	SELECT ID,PIN,Passwd,Nombre,Apellido,Tipo_Usuario,CI,Telefono,Barrio,Departamento FROM usuarios where CI = usr or RUT = usr or Usuario = usr;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `prueba` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_spanish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`salioviajeuy`@`localhost` PROCEDURE `prueba`(id varchar(45),opcion varchar(45))
BEGIN

IF opcion = "comprar" THEN
		start transaction;
		INSERT INTO oportunidades (id_oportunidad,estado) VALUES (id,"Comprada y pendiente de aprobacion");
ELSEIF opcion = "2" THEN
		UPDATE `salioviajeuy_salioviajeuy`.`oportunidades` SET `estado` = "aprobada" WHERE (`id_oportunidad` = id);
ELSEIF opcion = "3" THEN
		UPDATE `salioviajeuy_salioviajeuy`.`oportunidades` SET `estado` = "en curso" WHERE (`id_oportunidad` = id);
ELSEIF opcion = "4" THEN
		UPDATE `salioviajeuy_salioviajeuy`.`oportunidades` SET `estado` = "arrivado" WHERE (`id_oportunidad` = id);
ELSEIF opcion = "5" THEN
		UPDATE `salioviajeuy_salioviajeuy`.`oportunidades` SET `estado` = "terminado" WHERE (`id_oportunidad` = id);
ELSEIF opcion = "cancelar" THEN
		UPDATE `salioviajeuy_salioviajeuy`.`oportunidades` SET `estado` = "cancelado" WHERE (`id_oportunidad` = id);
END IF;

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
CREATE DEFINER=`salioviajeuy`@`localhost` PROCEDURE `register_empresa`(contador int,rut varchar(12),nombre_comercial varchar(45),razon_social varchar(45),numero_mtop int, password_mtop varchar(45),tipo_usuario varchar(3),id_usuario int,cho_sub int)
BEGIN 	

IF contador = 0 THEN
    INSERT INTO `salioviajeuy_salioviajeuy`.`empresas` (`RUT`, `Nombre_C`, `Razon_S`, `Nro_MTOP`, `Pass_MTOP`, `Usuario_ID`, `Tipo_Usuario`, `Choferes_sub`) VALUES (rut, nombre_comercial, razon_social, numero_mtop, password_mtop, id_usuario, tipo_usuario,cho_sub);
	UPDATE `salioviajeuy_salioviajeuy`.`usuarios` SET `RUT` = rut WHERE (`ID` = id_usuario);
ELSE
	INSERT INTO `salioviajeuy_salioviajeuy`.`empresas` (`RUT`, `Nombre_C`, `Razon_S`, `Nro_MTOP`, `Pass_MTOP`, `Usuario_ID`, `Tipo_Usuario`, `Choferes_sub`) VALUES (rut, nombre_comercial, razon_social, numero_mtop, password_mtop, id_usuario, tipo_usuario,cho_sub);
END IF;
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
/*!50003 SET collation_connection  = utf8_spanish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`salioviajeuy`@`localhost` PROCEDURE `register_usuario`(tipoUsuario varchar(3), ci int, email varchar(45), nombre varchar(45), apellido varchar(45),direccion varchar(45),barrio varchar(45), departamento varchar(45),telefono int, pin varchar(70),RUT_AGENCIA_CONTRATISTA varchar(12),rut varchar(12), supervisor varchar(2), nombre_hotel varchar(45), direccion_hotel varchar(100))
BEGIN

IF tipoUsuario != "HTL" THEN
    INSERT INTO salioviajeuy_salioviajeuy.usuarios (Tipo_Usuario, CI, Email, Nombre, Apellido, Direccion, Barrio, Departamento, Telefono, PIN) VALUES (tipoUsuario, ci, email, nombre, apellido, direccion, barrio, departamento, telefono, pin);
ELSE
	INSERT INTO salioviajeuy_salioviajeuy.usuarios (Tipo_Usuario, CI, Email, Nombre, Apellido, Direccion, Barrio, Departamento, Telefono, Supervisor, Nombre_Hotel, Direccion_Hotel, PIN) VALUES (tipoUsuario, ci, email, nombre, apellido, direccion, barrio, departamento, telefono, supervisor, nombre_hotel, direccion_hotel, pin);
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
/*!50003 DROP PROCEDURE IF EXISTS `traigo_empresas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_spanish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`salioviajeuy`@`localhost` PROCEDURE `traigo_empresas`()
BEGIN
SELECT Nombre_C,Razon_S,RUT,Choferes_sub FROM empresas;
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

-- Dump completed on 2022-02-13 11:35:56
