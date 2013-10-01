-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.35-community


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema zapateria
--

CREATE DATABASE IF NOT EXISTS zapateria;
USE zapateria;

--
-- Definition of table `articulo`
--

DROP TABLE IF EXISTS `articulo`;
CREATE TABLE `articulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `marca_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `codigo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `stock_minimo` double DEFAULT NULL,
  `stock_maximo` double DEFAULT NULL,
  `cantidad` double DEFAULT NULL,
  `tipo_articulo_id` int(11) DEFAULT NULL,
  `tipo_unidad_id` int(11) DEFAULT NULL,
  `fecha_ultima_compra` date DEFAULT NULL,
  `precio1` double DEFAULT NULL,
  `precio2` double DEFAULT NULL,
  `precio3` double DEFAULT NULL,
  `imagen` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `venta` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_alimento_tipo_unidad` (`tipo_unidad_id`),
  KEY `FK_alimento_tipo_alimento` (`tipo_articulo_id`) USING BTREE,
  CONSTRAINT `FK_alimento_tipo_alimento` FOREIGN KEY (`tipo_articulo_id`) REFERENCES `tipoarticulo` (`id`),
  CONSTRAINT `FK_alimento_tipo_unidad` FOREIGN KEY (`tipo_unidad_id`) REFERENCES `tipounidad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `articulo`
--

/*!40000 ALTER TABLE `articulo` DISABLE KEYS */;
INSERT INTO `articulo` (`id`,`nombre`,`marca_id`,`color_id`,`codigo`,`stock_minimo`,`stock_maximo`,`cantidad`,`tipo_articulo_id`,`tipo_unidad_id`,`fecha_ultima_compra`,`precio1`,`precio2`,`precio3`,`imagen`,`status`,`venta`) VALUES
 (1,'Bujia',NULL,NULL,NULL,2,6,91,1,1,'2013-06-10',82.5,75,62.5,'UBUJ-0231001-gde.jpg',1,1),
 (2,'Filtro de Aceite',NULL,NULL,NULL,8,16,2,1,1,'2013-04-18',127.5,114.75,106.25,'images.jpg',1,1),
 (3,'prueba',NULL,NULL,NULL,3,4,7,1,1,'2013-04-22',1300,101.6,88.4,'',0,0),
 (4,'Caucho',NULL,NULL,NULL,4,8,5,1,1,'2013-04-22',43.95,38.57,39.15,'1308599709_218259684_2-Gran-Promocion-De-Cauchos-Para-Gandolas-Mayor-Y-Detal-Caracas.jpg',1,1),
 (5,'Aceite',NULL,NULL,NULL,12,18,-1,1,1,NULL,100,50,40,'images (1).jpg',1,1),
 (6,'Faro',NULL,NULL,NULL,6,12,0,1,1,NULL,1000,800,500,'faro fx4 05-10 (1550)-500x500.jpg',1,1),
 (7,'Cables Bujias',NULL,NULL,NULL,5,10,-2,1,1,NULL,500,300,200,'206.jpg',1,1),
 (8,'Amortiguadores',NULL,NULL,NULL,5,10,-1,1,1,NULL,1200,1000,800,'Amortiguadores.jpg',1,1),
 (9,'Bombillo',NULL,NULL,NULL,20,40,-3,1,1,NULL,80,60,50,'bombillo-luces-carro-philips-vision-30-luz-12v-6055w-h4_MCO-O-3811092805_022013.jpg',1,1),
 (10,'Llave de Cruz',NULL,NULL,NULL,5,10,0,1,1,NULL,400,300,200,'descarga.jpg',1,1),
 (11,'Gato',NULL,NULL,NULL,5,10,-2,1,1,NULL,1200,1000,800,'9936884.jpg',1,1);
/*!40000 ALTER TABLE `articulo` ENABLE KEYS */;


--
-- Definition of table `articulo_detalle`
--

DROP TABLE IF EXISTS `articulo_detalle`;
CREATE TABLE `articulo_detalle` (
  `articulo_id` int(11) NOT NULL DEFAULT '0',
  `talla_id` int(11) NOT NULL DEFAULT '0',
  `cantidad` int(11) DEFAULT '0',
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`articulo_id`,`talla_id`) USING BTREE,
  KEY `FK_alimento_detalle_talla` (`talla_id`),
  CONSTRAINT `FK_alimento_detalle_alimento` FOREIGN KEY (`articulo_id`) REFERENCES `articulo` (`id`),
  CONSTRAINT `FK_alimento_detalle_talla` FOREIGN KEY (`talla_id`) REFERENCES `talla` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articulo_detalle`
--

/*!40000 ALTER TABLE `articulo_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `articulo_detalle` ENABLE KEYS */;


--
-- Definition of table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) DEFAULT NULL,
  `cedrif` varchar(45) DEFAULT NULL,
  `direccion` varchar(500) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `twitter` varchar(45) DEFAULT NULL,
  `correo` varchar(300) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `credito_monto` double DEFAULT '0',
  `credito_dias` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cliente`
--

/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`id`,`nombre`,`cedrif`,`direccion`,`telefono`,`twitter`,`correo`,`status`,`credito_monto`,`credito_dias`) VALUES
 (1,'','123123',' ','','','',1,NULL,NULL),
 (2,'Arianny Diaz','18057243','Urb. El trigal Av. 2 Calle 5 vereda 3-b','04262079018','','',1,NULL,NULL),
 (3,'Jonas Graterol','16531533','Urb El Valle, Av. 2 Calle 5 Cabudare, Lara','04263120353','','',1,3000,30),
 (4,'Johan Graterol','16531494',' ','','','',1,NULL,NULL),
 (5,'Juna Perez','1234','','','','',1,NULL,NULL),
 (6,'Marta Luna','12345','','','','',1,NULL,NULL),
 (7,'carlos salazr','123456','','','','',1,NULL,NULL),
 (8,'Luis Peña','1234567','','','','',1,NULL,NULL),
 (9,'Jimmy Perez','v-12345677','','','','',1,NULL,NULL),
 (10,'Wilmer Ramirez','v-12345678','','02514445522','','',1,NULL,NULL),
 (11,'dasdas','123','','','','',1,0,15),
 (12,'sadsaddas','12313','','','','',1,1000,15),
 (13,'Nuevo Cl','12344321','','','','',1,0,0);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;


--
-- Definition of table `color`
--

DROP TABLE IF EXISTS `color`;
CREATE TABLE `color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `abreviatura` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `color`
--

/*!40000 ALTER TABLE `color` DISABLE KEYS */;
/*!40000 ALTER TABLE `color` ENABLE KEYS */;


--
-- Definition of table `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE `compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nro_factura` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `fecha_compra` date DEFAULT NULL,
  `monto` double DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_compra_usuario` (`usuario_id`),
  KEY `FK_compra_proveedor` (`proveedor_id`),
  CONSTRAINT `FK_compra_proveedor` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`),
  CONSTRAINT `FK_compra_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `compra`
--

/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
INSERT INTO `compra` (`id`,`usuario_id`,`descripcion`,`nro_factura`,`proveedor_id`,`fecha`,`fecha_compra`,`monto`,`status`) VALUES
 (1,1,'','123',1,'2013-04-10 17:13:45','2013-04-10',3775,1),
 (2,1,'','1231',1,'2013-04-18 12:20:40','2013-04-18',850,1),
 (3,1,'','1234',1,'2013-04-22 07:41:52','2013-04-22',6200,1),
 (4,1,'','1234',1,'2013-04-23 10:03:36','2013-04-23',1550,1),
 (5,1,'','0006688',1,'2013-06-10 12:18:24','2013-06-10',5000,1);
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;


--
-- Definition of table `compra_detalle`
--

DROP TABLE IF EXISTS `compra_detalle`;
CREATE TABLE `compra_detalle` (
  `articulo_id` int(11) DEFAULT NULL,
  `compra_id` int(11) DEFAULT NULL,
  `cantidad` double DEFAULT NULL,
  `precio_unitario` double DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  KEY `FK_compra_detalle_compra` (`compra_id`),
  KEY `FK_compra_detalle_alimento` (`articulo_id`) USING BTREE,
  CONSTRAINT `FK_compra_detalle_alimento` FOREIGN KEY (`articulo_id`) REFERENCES `articulo` (`id`),
  CONSTRAINT `FK_compra_detalle_compra` FOREIGN KEY (`compra_id`) REFERENCES `compra` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `compra_detalle`
--

/*!40000 ALTER TABLE `compra_detalle` DISABLE KEYS */;
INSERT INTO `compra_detalle` (`articulo_id`,`compra_id`,`cantidad`,`precio_unitario`,`subtotal`) VALUES
 (1,1,5,595,2975),
 (2,1,10,80,800),
 (2,2,10,85,850),
 (1,3,4,1300,5200),
 (3,3,10,80,800),
 (4,3,8,25,200),
 (1,4,2,775,1550),
 (1,5,100,50,5000);
/*!40000 ALTER TABLE `compra_detalle` ENABLE KEYS */;


--
-- Definition of table `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE `factura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `factura`
--

/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
INSERT INTO `factura` (`id`,`pedido_id`) VALUES 
 (24,24),
 (158,158),
 (170,1),
 (171,25),
 (172,28),
 (173,19),
 (174,29),
 (175,30),
 (176,18),
 (177,32);
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;


--
-- Definition of table `marca`
--

DROP TABLE IF EXISTS `marca`;
CREATE TABLE `marca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `abreviatura` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marca`
--

/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;


--
-- Definition of table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `iva` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pedido`
--

/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` (`id`,`cliente_id`,`subtotal`,`iva`,`total`,`fecha`,`status`) VALUES
 (1,2,1071.43,128.57,1200,'2013-04-10 11:02:14',2),
 (2,NULL,0,0,0,'2013-04-10 13:52:35',0),
 (3,NULL,111.61,13.39,125,'2013-04-10 13:53:42',2),
 (4,NULL,1897.32,227.68,2125,'2013-04-10 16:40:03',2),
 (5,NULL,1897.32,227.68,2125,'2013-04-10 16:41:57',2),
 (6,NULL,825.89,99.11,925,'2013-04-10 16:51:11',2),
 (7,NULL,2008.93,241.07,2250,'2013-04-10 17:52:07',2),
 (8,NULL,1071.43,128.57,1200,'2013-04-10 17:57:57',2),
 (9,2,714.29,85.71,800,'2013-04-10 17:58:06',2),
 (10,NULL,1183.04,141.96,1325,'2013-04-10 18:01:40',0),
 (11,NULL,1183.04,141.96,1325,'2013-04-10 18:02:49',0),
 (12,3,1428.57,171.43,1600,'2013-04-10 18:05:28',2),
 (13,4,2008.93,241.07,2250,'2013-04-10 18:17:59',100),
 (14,4,1897.32,227.68,2125,'2013-04-10 19:09:56',100),
 (15,4,1183.04,141.96,1325,'2013-04-11 08:31:02',100),
 (16,2,1875,225,2100,'2013-04-11 08:52:03',100),
 (17,3,223.21,26.79,250,'2013-04-11 14:31:58',100),
 (18,4,1183.04,141.96,1325,'2013-04-12 12:36:14',100),
 (19,6,1428.57,171.43,1600,'2013-04-17 11:40:35',100),
 (20,NULL,315.18,37.82,353,'2013-04-17 12:55:03',2),
 (21,3,982.14,117.86,1100,'2013-04-18 18:12:04',2),
 (22,12,94.87,11.38,106.25,'2013-04-19 23:58:27',2),
 (23,9,892.86,107.14,1000,'2013-04-20 14:41:44',100),
 (24,3,89.29,10.71,100,'2013-04-22 09:42:11',100),
 (25,7,446.43,53.57,500,'2013-04-22 18:50:26',100),
 (26,NULL,828.12,99.37,927.5,'2013-04-22 18:53:04',2),
 (27,11,784.02,94.08,878.1,'2013-05-13 11:11:02',2),
 (28,13,209.82,25.18,235,'2013-05-15 17:40:29',100),
 (29,3,892.86,107.14,1000,'2013-05-29 11:12:12',100),
 (30,NULL,892.86,107.14,1000,'2013-05-29 13:11:04',100),
 (31,NULL,1033.3,124,1157.3,'2013-06-06 12:44:17',2),
 (32,NULL,292.41,35.09,327.5,'2013-06-10 12:11:20',100),
 (33,NULL,515.63,61.88,577.5,'2013-06-10 12:25:20',2),
 (34,NULL,1589.29,190.71,1780,'2013-06-12 22:27:45',2),
 (35,NULL,0,0,0,'2013-06-12 22:31:38',0),
 (36,NULL,1216.52,145.98,1362.5,'2013-06-12 22:32:17',2),
 (37,3,1678.57,201.43,1880,'2013-06-12 22:38:30',2),
 (38,NULL,89.29,10.71,100,'2013-08-12 11:19:47',1);
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;


--
-- Definition of table `pedido_detalle`
--

DROP TABLE IF EXISTS `pedido_detalle`;
CREATE TABLE `pedido_detalle` (
  `pedido_id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `servicio_id` int(11) DEFAULT NULL,
  `articulo_id` int(11) DEFAULT NULL,
  `cant` int(11) DEFAULT NULL,
  `precio_unitario` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pedido_detalle`
--

/*!40000 ALTER TABLE `pedido_detalle` DISABLE KEYS */;
INSERT INTO `pedido_detalle` (`pedido_id`,`cliente_id`,`servicio_id`,`articulo_id`,`cant`,`precio_unitario`,`total`,`status`) VALUES
 (1,NULL,1,NULL,1,1200,1200,1),
 (3,NULL,2,NULL,1,125,125,1),
 (5,NULL,1,NULL,1,800,800,1),
 (5,NULL,NULL,1,1,1200,1200,1),
 (5,NULL,NULL,2,1,125,125,1),
 (6,NULL,NULL,2,1,125,125,1),
 (6,NULL,1,NULL,1,800,800,1),
 (7,NULL,1,NULL,1,800,800,1),
 (7,NULL,NULL,1,1,1200,1200,1),
 (7,NULL,NULL,2,2,125,250,1),
 (8,NULL,NULL,1,1,1200,1200,1),
 (9,NULL,1,NULL,1,800,800,1),
 (10,NULL,NULL,1,1,1200,1200,1),
 (10,NULL,NULL,2,1,125,125,1),
 (11,NULL,NULL,2,1,125,125,1),
 (11,NULL,NULL,1,1,1200,1200,1),
 (12,NULL,1,NULL,2,800,1600,1),
 (13,NULL,1,NULL,1,800,800,1),
 (13,NULL,NULL,1,1,1200,1200,1),
 (13,NULL,NULL,2,2,125,250,1),
 (14,NULL,NULL,2,1,125,125,1),
 (14,NULL,NULL,1,1,1200,1200,1),
 (14,NULL,1,NULL,1,800,800,1),
 (15,NULL,NULL,2,1,125,125,1),
 (15,NULL,NULL,1,1,1200,1200,1),
 (16,NULL,2,NULL,1,100,100,1),
 (16,NULL,NULL,1,1,1200,1200,1),
 (16,NULL,1,NULL,1,800,800,1),
 (17,NULL,NULL,2,2,125,250,1),
 (18,NULL,NULL,1,1,1200,1200,1),
 (18,NULL,NULL,2,1,125,125,1),
 (19,NULL,1,NULL,2,800,1600,1),
 (20,NULL,NULL,3,1,123,123,1),
 (20,NULL,NULL,3,1,120,123,1),
 (20,NULL,NULL,3,1,110,123,1),
 (21,NULL,3,NULL,1,500,500,1),
 (21,NULL,3,NULL,1,600,500,1),
 (22,NULL,NULL,2,1,106.25,106.25,1),
 (23,NULL,NULL,4,1,1000,1000,1),
 (24,NULL,2,NULL,1,100,100,1),
 (25,NULL,4,NULL,2,200,400,1),
 (25,NULL,2,NULL,1,100,100,1),
 (26,NULL,1,NULL,1,800,800,1),
 (26,NULL,NULL,2,1,127.5,127.5,1),
 (27,NULL,3,NULL,1,600,600,1),
 (27,NULL,2,NULL,1,100,100,1),
 (27,NULL,NULL,2,1,127.5,127.5,1),
 (27,NULL,NULL,4,1,50.6,50.6,1),
 (28,NULL,2,NULL,1,60,60,1),
 (28,NULL,4,NULL,1,175,175,1),
 (29,NULL,1,NULL,1,800,800,1),
 (29,NULL,4,NULL,1,200,200,1),
 (30,NULL,4,NULL,1,200,200,1),
 (30,NULL,1,NULL,1,800,800,1),
 (31,NULL,4,NULL,1,200,200,1),
 (31,NULL,2,NULL,1,100,100,1),
 (31,NULL,NULL,4,1,57.3,57.3,1),
 (31,NULL,1,NULL,1,800,800,1),
 (32,NULL,4,NULL,1,200,200,1),
 (32,NULL,NULL,2,1,127.5,127.5,1),
 (33,NULL,NULL,1,7,82.5,577.5,1),
 (34,NULL,NULL,9,1,80,80,1),
 (34,NULL,NULL,8,1,1200,1200,1),
 (34,NULL,NULL,7,1,500,500,1),
 (36,NULL,NULL,9,1,80,80,1),
 (36,NULL,NULL,11,1,1200,1200,1),
 (36,NULL,NULL,1,1,82.5,82.5,1),
 (37,NULL,NULL,9,1,80,80,1),
 (37,NULL,NULL,11,1,1200,1200,1),
 (37,NULL,NULL,7,1,500,500,1),
 (37,NULL,NULL,5,1,100,100,1),
 (38,NULL,NULL,5,1,100,100,1);
/*!40000 ALTER TABLE `pedido_detalle` ENABLE KEYS */;


--
-- Definition of table `porc_ganancia`
--

DROP TABLE IF EXISTS `porc_ganancia`;
CREATE TABLE `porc_ganancia` (
  `porc_p1` double DEFAULT NULL,
  `porc_p2` double DEFAULT NULL,
  `porc_p3` double DEFAULT NULL,
  `ajuste_automatico` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `porc_ganancia`
--

/*!40000 ALTER TABLE `porc_ganancia` DISABLE KEYS */;
INSERT INTO `porc_ganancia` (`porc_p1`,`porc_p2`,`porc_p3`,`ajuste_automatico`,`id`) VALUES
 (75.8,54.3,31.4,1,1);
/*!40000 ALTER TABLE `porc_ganancia` ENABLE KEYS */;


--
-- Definition of table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono1` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono2` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `proveedor`
--

/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` (`id`,`nombre`,`direccion`,`telefono1`,`telefono2`,`correo`,`status`) VALUES
 (1,'Epa','CC las trinitarias','02513335544','02512223344','epa@gmail.com',1);
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;


--
-- Definition of table `salida`
--

DROP TABLE IF EXISTS `salida`;
CREATE TABLE `salida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha_salida` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_salida_usuario` (`usuario_id`),
  CONSTRAINT `FK_salida_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `salida`
--

/*!40000 ALTER TABLE `salida` DISABLE KEYS */;
INSERT INTO `salida` (`id`,`usuario_id`,`fecha_salida`,`status`) VALUES
 (1,1,'2013-04-17 00:00:00',1),
 (2,1,'2013-04-18 00:00:00',1);
/*!40000 ALTER TABLE `salida` ENABLE KEYS */;


--
-- Definition of table `salida_detalle`
--

DROP TABLE IF EXISTS `salida_detalle`;
CREATE TABLE `salida_detalle` (
  `salida_id` int(11) DEFAULT NULL,
  `alimento_id` int(11) DEFAULT NULL,
  `cantidad` double DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  KEY `FK_salida_detalle_alimento` (`alimento_id`),
  CONSTRAINT `FK_salida_detalle_alimento` FOREIGN KEY (`alimento_id`) REFERENCES `articulo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `salida_detalle`
--

/*!40000 ALTER TABLE `salida_detalle` DISABLE KEYS */;
INSERT INTO `salida_detalle` (`salida_id`,`alimento_id`,`cantidad`,`status`) VALUES
 (1,1,2,1),
 (2,2,1,1);
/*!40000 ALTER TABLE `salida_detalle` ENABLE KEYS */;


--
-- Definition of table `servicio`
--

DROP TABLE IF EXISTS `servicio`;
CREATE TABLE `servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_servicio_id` int(11) DEFAULT NULL,
  `precio1` double DEFAULT NULL,
  `precio2` double DEFAULT NULL,
  `precio3` double DEFAULT NULL,
  `imagen` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `servicio`
--

/*!40000 ALTER TABLE `servicio` DISABLE KEYS */;
INSERT INTO `servicio` (`id`,`nombre`,`descripcion`,`tipo_servicio_id`,`precio1`,`precio2`,`precio3`,`imagen`,`status`) VALUES
 (1,'Cambio Amortiguadores','Se cambian amortiguadores delanteros',1,800,700,600,'Chrysanthemum.jpg',0),
 (2,'Lavado de Motor','',1,100,75,60,'Jellyfish.jpg',0),
 (3,'Limpieza de Inyectores','',2,600,550,500,'',0),
 (4,'Cambio de Aceite','',2,200,185,175,'',0),
 (5,'Instalacion de punta de tripoide','',1,500,400,350,'',0),
 (6,'asdsda','',1,12,12,12,'images.jpg',1),
 (7,'Costura','',2,10,8,5,'',1);
/*!40000 ALTER TABLE `servicio` ENABLE KEYS */;


--
-- Definition of table `talla`
--

DROP TABLE IF EXISTS `talla`;
CREATE TABLE `talla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo_articulo_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_talla_tipo_alimento` (`tipo_articulo_id`) USING BTREE,
  CONSTRAINT `FK_talla_tipo_alimento` FOREIGN KEY (`tipo_articulo_id`) REFERENCES `tipoarticulo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `talla`
--

/*!40000 ALTER TABLE `talla` DISABLE KEYS */;
/*!40000 ALTER TABLE `talla` ENABLE KEYS */;


--
-- Definition of table `tipoarticulo`
--

DROP TABLE IF EXISTS `tipoarticulo`;
CREATE TABLE `tipoarticulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci PACK_KEYS=1;

--
-- Dumping data for table `tipoarticulo`
--

/*!40000 ALTER TABLE `tipoarticulo` DISABLE KEYS */;
INSERT INTO `tipoarticulo` (`id`,`nombre`,`status`) VALUES
 (1,'Repuestos',1),
 (2,'Herramientas',1);
/*!40000 ALTER TABLE `tipoarticulo` ENABLE KEYS */;


--
-- Definition of table `tiposervicio`
--

DROP TABLE IF EXISTS `tiposervicio`;
CREATE TABLE `tiposervicio` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `descripcion` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tiposervicio`
--

/*!40000 ALTER TABLE `tiposervicio` DISABLE KEYS */;
INSERT INTO `tiposervicio` (`id`,`nombre`,`descripcion`,`status`) VALUES 
 (1,'Mecanica','',1),
 (2,'Mantenimiento','',1);
/*!40000 ALTER TABLE `tiposervicio` ENABLE KEYS */;


--
-- Definition of table `tipounidad`
--

DROP TABLE IF EXISTS `tipounidad`;
CREATE TABLE `tipounidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `abreviatura` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tipounidad`
--

/*!40000 ALTER TABLE `tipounidad` DISABLE KEYS */;
INSERT INTO `tipounidad` (`id`,`nombre`,`abreviatura`,`status`) VALUES
 (1,'Unidad','Uni',1),
 (2,'Kilogramos','Klg',1),
 (3,'Litro','lts',1);
/*!40000 ALTER TABLE `tipounidad` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `clave` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`,`usuario`,`clave`,`status`) VALUES 
 (1,'Admin','123',1),
 (2,'Francisco','1234',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;