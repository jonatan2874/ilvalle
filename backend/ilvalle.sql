/*
Navicat MySQL Data Transfer

Source Server         : localhost_7
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ilvalle

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-10-06 19:38:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `descripcion` longtext COLLATE latin1_general_ci DEFAULT NULL,
  `precio` double(11,2) DEFAULT NULL,
  `logo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `activo` int(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', '01', 'tomate chontosososo', 'tomate importadossss', '1400.00', '1567648469_Captura.PNG', '0');
INSERT INTO `products` VALUES ('2', '01', 'tomate chontosososo', 'tomate importadossss', '1400.00', '1567648469_Captura.PNG', '0');
INSERT INTO `products` VALUES ('3', '01', 'tomate chontosososo', 'tomate importadossss', '1400.00', '1567648469_Captura.PNG', '1');
INSERT INTO `products` VALUES ('4', '01', 'tomate chontosososo', 'tomate importadossss', '1400.00', '1567648469_Captura.PNG', '1');
INSERT INTO `products` VALUES ('5', '01', 'tomate chontosososo', 'tomate importadossss', '1400.00', '1567648469_Captura.PNG', '1');
INSERT INTO `products` VALUES ('6', '01', 'tomate chontosososo', 'tomate importadossss', '1400.00', '1567648469_Captura.PNG', '1');
INSERT INTO `products` VALUES ('7', '01', 'tomate chontosososo', 'tomate importadossss', '1400.00', '1567648469_Captura.PNG', '1');
INSERT INTO `products` VALUES ('8', '01', 'tomate chontosososo', 'tomate importadossss', '1400.00', '1567648469_Captura.PNG', '1');
INSERT INTO `products` VALUES ('9', '01', 'tomate chontosososo', 'tomate importadossss', '1400.00', '1567648469_Captura.PNG', '1');
INSERT INTO `products` VALUES ('10', '01', 'tomate chontosososo', 'tomate importadossss', '1400.00', '1567648469_Captura.PNG', '1');
INSERT INTO `products` VALUES ('11', '01', 'tomate chontosososo', 'tomate importadossss', '1400.00', '1567648469_Captura.PNG', '1');
INSERT INTO `products` VALUES ('12', '01', 'tomate chontosososo', 'tomate importadossss', '1400.00', '1567648469_Captura.PNG', '1');
INSERT INTO `products` VALUES ('13', '01', 'tomate chontosososo', 'tomate importadossss', '1400.00', '1567648469_Captura.PNG', '1');

-- ----------------------------
-- Table structure for retenciones
-- ----------------------------
DROP TABLE IF EXISTS `retenciones`;
CREATE TABLE `retenciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE latin1_general_ci DEFAULT '',
  `tipo` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `porcentaje` double(11,2) DEFAULT 0.00,
  `base` double(11,2) DEFAULT 0.00,
  `activo` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of retenciones
-- ----------------------------
INSERT INTO `retenciones` VALUES ('1', 'SERVICIOS EN GENERAL \r\n', 'fuente', '4.00', '12479477.00', '1');

-- ----------------------------
-- Table structure for retenciones_proveedores
-- ----------------------------
DROP TABLE IF EXISTS `retenciones_proveedores`;
CREATE TABLE `retenciones_proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_retencion` int(11) DEFAULT 0,
  `id_proveedor` int(11) DEFAULT 0,
  `anio` varchar(100) COLLATE latin1_general_ci DEFAULT '0.00',
  `valor_calculado` double(11,2) DEFAULT NULL,
  `ciudad` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `activo` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of retenciones_proveedores
-- ----------------------------
INSERT INTO `retenciones_proveedores` VALUES ('1', '1', '12', '2018', '499179.08', 'Palmira', '1');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `documento` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `dv` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `rol` varchar(255) COLLATE latin1_general_ci DEFAULT 'Administrador',
  `activo` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `documento` (`documento`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '111', '2', 'nombre', 'user_name', 'password', 'empleado', '1');
INSERT INTO `users` VALUES ('2', '2', '0', 'nombre', 'user_name', 'password', 'proveedor', '1');
INSERT INTO `users` VALUES ('3', '3', '0', 'usuario', 'admin', '1234567890', 'empleado', '1');
INSERT INTO `users` VALUES ('12', '800009973', '4', 'LUVAGA S.A.S ', '800009973', '800009973', 'proveedor', '1');
INSERT INTO `users` VALUES ('14', '800096757', '0', 'HUBERT RUIZ OPTICA LTDA ', '800096757', '800096757', 'proveedor', '1');
INSERT INTO `users` VALUES ('16', '800118202', '1', 'ESTELAR IMPRESORES LTDA ', '800118202', '800118202', 'proveedor', '1');
INSERT INTO `users` VALUES ('17', '805007083', '3', 'R.H. S.A.S', '805007083', '805007083', 'proveedor', '1');
INSERT INTO `users` VALUES ('18', '800015615', '7', 'MARPICO S.A.', '800015615', '800015615', 'proveedor', '1');
INSERT INTO `users` VALUES ('20', '800076771', '9', 'FERRONEUMATICA LTDA', '800076771', '800076771', 'proveedor', '1');
INSERT INTO `users` VALUES ('21', '800103052', '8', 'ORACLE DE COLOMBIA LIMITADA', '800103052', '800103052', 'proveedor', '1');
INSERT INTO `users` VALUES ('22', '', '0', '', '', '', '', '1');
