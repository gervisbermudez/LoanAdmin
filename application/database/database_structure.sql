-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.6-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para myloanadmin
CREATE DATABASE IF NOT EXISTS `myloanadmin` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `myloanadmin`;

-- Volcando estructura para tabla myloanadmin.clients
DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_register` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `identificacion` varchar(125) NOT NULL,
  `registerdate` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identificacion` (`identificacion`(100)),
  KEY `id_user_register` (`id_user_register`),
  CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`id_user_register`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COMMENT='Tabla del modulo Prestamos';

-- Volcando datos para la tabla myloanadmin.clients: ~0 rows (aproximadamente)
DELETE FROM `clients`;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` (`id`, `id_user_register`, `nombre`, `apellido`, `direccion`, `telefono`, `identificacion`, `registerdate`, `status`) VALUES
	(8, 1, 'Gervis', 'Bermudez', 'Labardén 527, , ', '01157614613', '11111111111111', '2020-01-11 15:43:38', 1);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Volcando estructura para tabla myloanadmin.expenses
DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `monto` float NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip_update` varchar(125) NOT NULL DEFAULT '0.0.0.0',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_expenses_id_user` (`id_user`),
  CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla myloanadmin.expenses: ~0 rows (aproximadamente)
DELETE FROM `expenses`;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;

-- Volcando estructura para tabla myloanadmin.income
DROP TABLE IF EXISTS `income`;
CREATE TABLE IF NOT EXISTS `income` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `monto` float NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip_update` varchar(125) NOT NULL DEFAULT '0.0.0.0',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_expenses_id_user` (`id_user`),
  CONSTRAINT `income_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla myloanadmin.income: ~0 rows (aproximadamente)
DELETE FROM `income`;
/*!40000 ALTER TABLE `income` DISABLE KEYS */;
/*!40000 ALTER TABLE `income` ENABLE KEYS */;

-- Volcando estructura para tabla myloanadmin.loans
DROP TABLE IF EXISTS `loans`;
CREATE TABLE IF NOT EXISTS `loans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prestamista` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `monto` float NOT NULL,
  `porcentaje` float NOT NULL,
  `subtotal` float NOT NULL,
  `monto_total` float NOT NULL,
  `monto_pagado` float NOT NULL,
  `ciclo_pago` set('Diario','Semanal','Quincenal','Mensual','Bimensual','Trimestral','Semestral','Anual','Bianual') NOT NULL DEFAULT 'Semanal',
  `cant_cuotas` int(11) NOT NULL,
  `progreso` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `registerdate` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prestamista` (`id_prestamista`),
  CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`id_prestamista`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla myloanadmin.loans: ~0 rows (aproximadamente)
DELETE FROM `loans`;
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;
/*!40000 ALTER TABLE `loans` ENABLE KEYS */;

-- Volcando estructura para tabla myloanadmin.loans_dues
DROP TABLE IF EXISTS `loans_dues`;
CREATE TABLE IF NOT EXISTS `loans_dues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prestamo` int(11) NOT NULL,
  `numero_cuota` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `monto_total` int(11) NOT NULL,
  `monto_pagado` int(11) NOT NULL,
  `estado` set('Pendiente','Proximo','Pagado','Caida') NOT NULL,
  `fecha_pagado` date NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prestamo` (`id_prestamo`),
  CONSTRAINT `loans_dues_ibfk_1` FOREIGN KEY (`id_prestamo`) REFERENCES `loans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=320 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla myloanadmin.loans_dues: ~0 rows (aproximadamente)
DELETE FROM `loans_dues`;
/*!40000 ALTER TABLE `loans_dues` DISABLE KEYS */;
/*!40000 ALTER TABLE `loans_dues` ENABLE KEYS */;

-- Volcando estructura para tabla myloanadmin.loans_user_client
DROP TABLE IF EXISTS `loans_user_client`;
CREATE TABLE IF NOT EXISTS `loans_user_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `id_client` (`id_client`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `loans_user_client_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `loans_user_client_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla myloanadmin.loans_user_client: ~0 rows (aproximadamente)
DELETE FROM `loans_user_client`;
/*!40000 ALTER TABLE `loans_user_client` DISABLE KEYS */;
INSERT INTO `loans_user_client` (`id`, `id_user`, `id_client`, `status`) VALUES
	(3, 1, 8, 1);
/*!40000 ALTER TABLE `loans_user_client` ENABLE KEYS */;

-- Volcando estructura para tabla myloanadmin.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla myloanadmin.migrations: ~0 rows (aproximadamente)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla myloanadmin.notifications
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `codigo` varchar(125) NOT NULL,
  `description` text NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `type` varchar(125) NOT NULL,
  `isread` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla myloanadmin.notifications: ~0 rows (aproximadamente)
DELETE FROM `notifications`;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Volcando estructura para tabla myloanadmin.relations
DROP TABLE IF EXISTS `relations`;
CREATE TABLE IF NOT EXISTS `relations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `tablename` tinytext NOT NULL,
  `id_row` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `action` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla myloanadmin.relations: ~0 rows (aproximadamente)
DELETE FROM `relations`;
/*!40000 ALTER TABLE `relations` DISABLE KEYS */;
INSERT INTO `relations` (`id`, `id_user`, `tablename`, `id_row`, `date`, `action`) VALUES
	(3, 1, 'prestamos_clientes', 8, '2020-01-11 15:43:38', 'crear');
/*!40000 ALTER TABLE `relations` ENABLE KEYS */;

-- Volcando estructura para tabla myloanadmin.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `lastseen` datetime NOT NULL,
  `id_user_group` int(11) NOT NULL,
  `created_from_ip` varchar(100) NOT NULL,
  `updated_from_ip` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla myloanadmin.user: ~3 rows (aproximadamente)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `email`, `lastseen`, `id_user_group`, `created_from_ip`, `updated_from_ip`, `date_created`, `date_updated`, `status`) VALUES
	(1, 'root', '$2y$10$ijNTaPLKV.Q32iMkzOjZheWTQViUa.bs56OF8Kp09EQPj3KUqQJw2', 'root@email.com', '2020-01-11 14:52:31', 1, '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(2, 'admin', '$2y$10$nlx1rXctbWTHhnOAiSZOROClD.iDvkHa.gz3eHGaILYYGtFm93LMG', 'admin@email.com', '2020-01-11 14:25:58', 2, '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(3, 'user', '$2y$10$kyrsUfMT9c8hVVed29btxu49AWO7vMpfhhz4Txs0bnxZDv9LA.sAO', 'user@email.com', '2020-01-11 14:25:58', 3, '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Volcando estructura para tabla myloanadmin.user_data
DROP TABLE IF EXISTS `user_data`;
CREATE TABLE IF NOT EXISTS `user_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `_key` varchar(250) NOT NULL,
  `_value` varchar(100) NOT NULL,
  `created_from_ip` varchar(100) NOT NULL,
  `updated_from_ip` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla myloanadmin.user_data: ~7 rows (aproximadamente)
DELETE FROM `user_data`;
/*!40000 ALTER TABLE `user_data` DISABLE KEYS */;
INSERT INTO `user_data` (`id`, `id_user`, `_key`, `_value`, `created_from_ip`, `updated_from_ip`, `date_created`, `date_updated`, `status`) VALUES
	(1, 1, 'nombre', 'Gervis', '', '', '2020-01-11 10:44:13', '2020-01-11 10:44:13', 1),
	(2, 1, 'apellido', 'Bermudez', '', '', '2020-01-11 10:44:42', '2020-01-11 10:44:42', 1),
	(3, 1, 'direccion', 'Casdros', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
	(4, 1, 'telefono', '12345678', '', '', '2020-01-11 10:45:30', '2020-01-11 10:45:30', 1),
	(5, 1, 'identificacion', '1234', '', '', '2020-01-11 10:45:47', '2020-01-11 10:45:48', 1),
	(6, 1, 'create by', 'Root', '', '', '2020-01-11 10:49:01', '2020-01-11 10:49:01', 1),
	(7, 1, 'avatar', 'avatar.png', '', '', '2020-01-11 10:49:27', '2020-01-11 10:49:27', 1),
	(9, 2, 'nombre', 'Gervis', '', '', '2020-01-11 10:44:13', '2020-01-11 10:44:13', 1),
	(10, 2, 'apellido', 'Bermudez', '', '', '2020-01-11 10:44:42', '2020-01-11 10:44:42', 1),
	(11, 2, 'direccion', 'Casdros', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
	(12, 2, 'telefono', '12345678', '', '', '2020-01-11 10:45:30', '2020-01-11 10:45:30', 1),
	(13, 2, 'identificacion', '1234', '', '', '2020-01-11 10:45:47', '2020-01-11 10:45:48', 1),
	(14, 2, 'create by', 'Root', '', '', '2020-01-11 10:49:01', '2020-01-11 10:49:01', 1),
	(15, 2, 'avatar', 'avatar.png', '', '', '2020-01-11 10:49:27', '2020-01-11 10:49:27', 1),
	(16, 3, 'nombre', 'Gervis', '', '', '2020-01-11 10:44:13', '2020-01-11 10:44:13', 1),
	(17, 3, 'apellido', 'Bermudez', '', '', '2020-01-11 10:44:42', '2020-01-11 10:44:42', 1),
	(18, 3, 'direccion', 'Casdros', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
	(19, 3, 'telefono', '12345678', '', '', '2020-01-11 10:45:30', '2020-01-11 10:45:30', 1),
	(20, 3, 'identificacion', '1234', '', '', '2020-01-11 10:45:47', '2020-01-11 10:45:48', 1),
	(21, 3, 'create by', 'Root', '', '', '2020-01-11 10:49:01', '2020-01-11 10:49:01', 1),
	(22, 3, 'avatar', 'avatar.png', '', '', '2020-01-11 10:49:27', '2020-01-11 10:49:27', 1);
/*!40000 ALTER TABLE `user_data` ENABLE KEYS */;

-- Volcando estructura para tabla myloanadmin.user_group
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created_from_ip` varchar(100) NOT NULL,
  `updated_from_ip` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla myloanadmin.user_group: ~3 rows (aproximadamente)
DELETE FROM `user_group`;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` (`id`, `name`, `level`, `description`, `created_from_ip`, `updated_from_ip`, `date_created`, `date_updated`, `status`) VALUES
	(1, 'Root', 0, 'All permisions allowed', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(2, 'Admin', 1, 'All configurations allowed', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(3, 'Standar', 2, 'Not delete permisions allowed', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1);
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;

-- Volcando estructura para tabla myloanadmin.user_permisions
DROP TABLE IF EXISTS `user_permisions`;
CREATE TABLE IF NOT EXISTS `user_permisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `permision` varchar(250) NOT NULL,
  `value` varchar(250) NOT NULL,
  `module` varchar(100) NOT NULL,
  `created_from_ip` varchar(100) NOT NULL,
  `updated_from_ip` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla myloanadmin.user_permisions: ~27 rows (aproximadamente)
DELETE FROM `user_permisions`;
/*!40000 ALTER TABLE `user_permisions` DISABLE KEYS */;
INSERT INTO `user_permisions` (`id`, `id_user`, `permision`, `value`, `module`, `created_from_ip`, `updated_from_ip`, `date_created`, `date_updated`, `status`) VALUES
	(1, 1, 'access_user_module', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(2, 1, 'view_list_user', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(3, 1, 'view_specific_user', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(4, 1, 'create_any_user', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(5, 1, 'update_any_user', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(6, 1, 'update_current_user', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(7, 1, 'update_status_user', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(8, 1, 'delete_any_user', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(9, 1, 'update_user_permision', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(10, 2, 'access_user_module', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(11, 2, 'view_list_user', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(12, 2, 'view_specific_user', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(13, 2, 'create_any_user', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(14, 2, 'update_any_user', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(15, 2, 'update_current_user', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(16, 2, 'update_status_user', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(17, 2, 'delete_any_user', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(18, 2, 'update_user_permision', '0', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(19, 3, 'access_user_module', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(20, 3, 'view_list_user', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(21, 3, 'view_specific_user', '0', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(22, 3, 'create_any_user', '0', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(23, 3, 'update_any_user', '0', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(24, 3, 'update_current_user', '1', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(25, 3, 'update_status_user', '0', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(26, 3, 'delete_any_user', '0', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1),
	(27, 3, 'update_user_permision', '0', 'User', '0.0.0.0', '0.0.0.0', '2020-01-11 14:25:58', '2020-01-11 14:25:58', 1);
/*!40000 ALTER TABLE `user_permisions` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
