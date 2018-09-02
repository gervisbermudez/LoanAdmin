-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-07-2018 a las 20:38:45
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `start`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `descripcion` tinytext NOT NULL,
  `fecha` datetime NOT NULL,
  `path` varchar(125) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `album_items`
--

CREATE TABLE `album_items` (
  `id` int(11) NOT NULL,
  `id_album` int(11) NOT NULL,
  `nombre` varchar(125) NOT NULL,
  `titulo` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `tipo` varchar(600) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Categorias del sistema';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(600) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='contacts';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactsdata`
--

CREATE TABLE `contactsdata` (
  `id` int(11) NOT NULL,
  `id_contact` int(11) NOT NULL,
  `_key` varchar(200) NOT NULL,
  `_value` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='contactsdata';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datauserstorage`
--

CREATE TABLE `datauserstorage` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `_key` varchar(100) NOT NULL,
  `_value` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datauserstorage`
--

INSERT INTO `datauserstorage` (`id`, `id_user`, `_key`, `_value`) VALUES
(168, 33, 'nombre', 'Gervis'),
(169, 33, 'apellido', 'Bermudez'),
(170, 33, 'direccion', 'Chopin 100'),
(171, 33, 'telefono', '1166239823'),
(172, 33, 'create by', 'jesus'),
(173, 33, 'avatar', '33_thumb.png'),
(174, 34, 'nombre', 'Jesus'),
(175, 34, 'apellido', 'Ortega'),
(176, 34, 'direccion', 'Chopin 100'),
(177, 34, 'telefono', '1166239823'),
(178, 34, 'create by', 'gervis'),
(179, 34, 'avatar', '34_thumb.png'),
(180, 35, 'nombre', 'Alexa'),
(181, 35, 'apellido', 'Medina'),
(182, 35, 'direccion', 'Chopin 100'),
(183, 35, 'telefono', '1166239823'),
(184, 35, 'create by', 'gervis'),
(185, 35, 'avatar', '35_thumb.png'),
(186, 36, 'nombre', 'Bambi'),
(187, 36, 'apellido', 'Ortega'),
(188, 36, 'direccion', 'Chopin 100'),
(189, 36, 'telefono', '1166239823'),
(190, 36, 'create by', 'gervis'),
(191, 36, 'avatar', '36_thumb.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `titulo` varchar(70) NOT NULL,
  `texto` mediumtext NOT NULL,
  `imagen` text NOT NULL,
  `thumb` text NOT NULL,
  `ciudad` tinytext NOT NULL,
  `fecha` varchar(70) NOT NULL,
  `lugar` varchar(70) NOT NULL,
  `publishdate` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Eventos a publicar';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mailfolder`
--

CREATE TABLE `mailfolder` (
  `id` int(11) NOT NULL,
  `namefolder` varchar(60) NOT NULL,
  `description` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mailfolder`
--

INSERT INTO `mailfolder` (`id`, `namefolder`, `description`, `status`) VALUES
(1, 'Inbox', 'The main folder', 1),
(2, 'Archived', 'Archived folder', 1),
(3, 'Sent', 'Sent folder', 1),
(4, 'Deleted', 'Deleted folder', 1),
(5, 'Spam', 'Spam folder', 1),
(6, 'Starred', 'Starred folder', 1),
(7, 'Drafts', 'The drafts folder', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `_from` text NOT NULL,
  `_to` text NOT NULL,
  `_subject` varchar(255) NOT NULL,
  `_mensaje` longtext NOT NULL,
  `_cc` text NOT NULL,
  `_bcc` text NOT NULL,
  `fecha` datetime NOT NULL,
  `folder` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `_from`, `_to`, `_subject`, `_mensaje`, `_cc`, `_bcc`, `fecha`, `folder`, `estatus`) VALUES
(1, 'ana24@mail.org', 'admin@mail.org', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '2016-09-08 00:00:00', 2, 1),
(4, 'juan45@mail.org', 'Lore@gmail.org', 'Lorem ipsum dolor ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '2016-09-06 06:29:44', 2, 1),
(5, 'migul@mail.org', 'Lore@gmail.org', 'Lorem ipsum dolor ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', '', '2016-09-06 06:29:44', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajesdata`
--

CREATE TABLE `mensajesdata` (
  `id` int(11) NOT NULL,
  `id_mensaje` int(11) NOT NULL,
  `_key` varchar(200) COLLATE utf8_bin NOT NULL,
  `_value` varchar(600) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='mensajesdata';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos_clientes`
--

CREATE TABLE `prestamos_clientes` (
  `id` int(11) NOT NULL,
  `id_user_register` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `identificacion` varchar(125) NOT NULL,
  `registerdate` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla del modulo Prestamos';

--
-- Volcado de datos para la tabla `prestamos_clientes`
--

INSERT INTO `prestamos_clientes` (`id`, `id_user_register`, `nombre`, `apellido`, `direccion`, `telefono`, `identificacion`, `registerdate`, `status`) VALUES
(1, 33, 'Giovany', 'Chacon', 'Labarden 565', '1166239823', '1234567', '2018-07-15 21:52:35', 1),
(2, 35, 'Jose ', 'Marquez', 'Labarden 565', '1166239823', '12324324', '2018-07-19 20:57:19', 1),
(4, 34, 'Yule', 'Duran', 'Labarden 565', '+546727289191', '32145222', '2018-07-21 17:17:53', 1),
(6, 35, 'Yusbert', 'Ortega', 'Labarden 565', '+546727289191', '56789', '2018-07-21 17:42:25', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos_clientes_prestamista`
--

CREATE TABLE `prestamos_clientes_prestamista` (
  `id` int(11) NOT NULL,
  `id_prestamista` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prestamos_clientes_prestamista`
--

INSERT INTO `prestamos_clientes_prestamista` (`id`, `id_prestamista`, `id_cliente`, `status`) VALUES
(1, 34, 4, 1),
(2, 33, 4, 1),
(3, 35, 2, 1),
(4, 35, 6, 1),
(5, 34, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos_cuotas`
--

CREATE TABLE `prestamos_cuotas` (
  `id` int(11) NOT NULL,
  `id_prestamo` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `monto_total` int(11) NOT NULL,
  `monto_pagado` int(11) NOT NULL,
  `estado` set('Pendiente','Proximo','Pagado','Caida') NOT NULL,
  `fecha_pagado` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prestamos_cuotas`
--

INSERT INTO `prestamos_cuotas` (`id`, `id_prestamo`, `fecha_pago`, `monto_total`, `monto_pagado`, `estado`, `fecha_pagado`, `status`) VALUES
(26, 9, '2018-07-20', 2200, 0, 'Pendiente', '0000-00-00', 1),
(27, 9, '2018-07-21', 2200, 0, 'Pendiente', '0000-00-00', 1),
(28, 9, '2018-07-23', 2200, 0, 'Pendiente', '0000-00-00', 1),
(29, 9, '2018-07-24', 2200, 0, 'Pendiente', '0000-00-00', 1),
(30, 9, '2018-07-25', 2200, 0, 'Pendiente', '0000-00-00', 1),
(31, 9, '2018-07-26', 2200, 0, 'Pendiente', '0000-00-00', 1),
(32, 9, '2018-07-27', 2200, 0, 'Pendiente', '0000-00-00', 1),
(33, 9, '2018-07-28', 2200, 0, 'Pendiente', '0000-00-00', 1),
(34, 9, '2018-07-30', 2200, 0, 'Pendiente', '0000-00-00', 1),
(35, 9, '2018-07-31', 2200, 0, 'Pendiente', '0000-00-00', 1),
(36, 10, '2018-07-23', 3125, 0, 'Pendiente', '0000-00-00', 1),
(37, 10, '2018-07-30', 3125, 0, 'Pendiente', '0000-00-00', 1),
(38, 10, '2018-08-06', 3125, 0, 'Pendiente', '0000-00-00', 1),
(39, 10, '2018-08-13', 3125, 0, 'Pendiente', '0000-00-00', 1),
(40, 11, '2018-07-23', 6500, 0, 'Pendiente', '0000-00-00', 1),
(41, 11, '2018-07-30', 6500, 0, 'Pendiente', '0000-00-00', 1),
(42, 11, '2018-08-06', 6500, 0, 'Pendiente', '0000-00-00', 1),
(43, 11, '2018-08-13', 6500, 0, 'Pendiente', '0000-00-00', 1),
(44, 11, '2018-08-20', 6500, 0, 'Pendiente', '0000-00-00', 1),
(45, 11, '2018-08-27', 6500, 0, 'Pendiente', '0000-00-00', 1),
(46, 12, '2018-07-23', 550, 550, 'Pagado', '2018-07-21', 1),
(47, 12, '2018-07-24', 550, 550, 'Pagado', '2018-07-21', 1),
(48, 12, '2018-07-25', 550, 550, 'Pagado', '2018-07-21', 1),
(49, 12, '2018-07-26', 550, 550, 'Pagado', '2018-07-21', 1),
(50, 12, '2018-07-27', 550, 550, 'Pagado', '2018-07-21', 1),
(51, 12, '2018-07-28', 550, 550, 'Pagado', '2018-07-21', 1),
(52, 12, '2018-07-30', 550, 0, 'Pendiente', '0000-00-00', 1),
(53, 12, '2018-07-31', 550, 0, 'Pendiente', '0000-00-00', 1),
(54, 12, '2018-08-01', 550, 0, 'Pendiente', '0000-00-00', 1),
(55, 12, '2018-08-02', 550, 0, 'Pendiente', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `id_prestamista` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `monto` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `monto_total` int(11) NOT NULL,
  `ciclo_pago` set('Diario','Semanal','Quincenal','Mensual','Bimensual','Trimestral','Semestral','Anual','Bianual') NOT NULL DEFAULT 'Semanal',
  `cant_cuotas` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `progreso` int(11) NOT NULL,
  `registerdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `loans`
--

INSERT INTO `loans` (`id`, `id_prestamista`, `id_cliente`, `monto`, `porcentaje`, `monto_total`, `ciclo_pago`, `cant_cuotas`, `fecha_inicio`, `progreso`, `registerdate`, `status`) VALUES
(9, 35, 2, 20000, 10, 22000, 'Diario', 10, '2018-07-20', 100, '2018-07-19 23:51:15', 0),
(10, 35, 2, 10000, 25, 12500, 'Semanal', 4, '2018-07-23', 87, '2018-07-21 03:40:03', 1),
(11, 33, 2, 30000, 30, 39000, 'Semanal', 6, '2018-07-23', 50, '2018-07-21 16:34:57', 1),
(12, 35, 6, 5000, 10, 5500, 'Diario', 10, '2018-07-23', 0, '2018-07-21 17:43:37', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relations`
--

CREATE TABLE `relations` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tablename` tinytext NOT NULL,
  `id_row` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `action` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `relations`
--

INSERT INTO `relations` (`id`, `id_user`, `tablename`, `id_row`, `date`, `action`) VALUES
(20, 18, 'user', 28, '2018-06-27 03:44:18', 'crear'),
(25, 31, 'user', 33, '2018-06-27 13:25:32', 'crear'),
(26, 33, 'user', 34, '2018-06-27 16:07:33', 'crear'),
(27, 33, 'user', 35, '2018-07-15 15:07:45', 'crear'),
(28, 35, 'prestamos_clientes', 1, '2018-07-15 21:52:35', 'crear'),
(29, 35, 'loans', 3, '2018-07-19 05:12:22', 'crear'),
(30, 35, 'loans', 4, '2018-07-19 05:16:04', 'crear'),
(31, 35, 'prestamos_clientes', 2, '2018-07-19 20:57:19', 'crear'),
(32, 35, 'loans', 4, '2018-07-19 23:32:03', 'crear'),
(33, 35, 'loans', 5, '2018-07-19 23:35:51', 'crear'),
(34, 35, 'loans', 6, '2018-07-19 23:36:38', 'crear'),
(35, 35, 'loans', 7, '2018-07-19 23:40:08', 'crear'),
(36, 35, 'loans', 8, '2018-07-19 23:47:11', 'crear'),
(37, 35, 'loans', 9, '2018-07-19 23:51:15', 'crear'),
(38, 35, 'loans', 10, '2018-07-21 03:40:03', 'crear'),
(39, 33, 'loans', 11, '2018-07-21 16:34:57', 'crear'),
(40, 34, 'prestamos_clientes', 3, '2018-07-21 17:12:05', 'crear'),
(41, 34, 'prestamos_clientes', 4, '2018-07-21 17:17:54', 'crear'),
(42, 33, 'prestamos_clientes', 4, '2018-07-21 17:39:47', 'crear'),
(43, 35, 'prestamos_clientes', 2, '2018-07-21 17:41:03', 'crear'),
(44, 35, 'prestamos_clientes', 6, '2018-07-21 17:42:25', 'crear'),
(45, 35, 'loans', 12, '2018-07-21 17:43:37', 'crear'),
(46, 34, 'prestamos_clientes', 6, '2018-07-21 17:46:10', 'crear'),
(47, 33, 'user', 36, '2018-07-21 18:17:50', 'crear');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscriptores`
--

CREATE TABLE `suscriptores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `email` varchar(125) NOT NULL,
  `fecha` datetime NOT NULL,
  `codigo` varchar(75) NOT NULL,
  `estado` set('Verificado','No verificado') NOT NULL DEFAULT 'No verificado',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL DEFAULT '1234',
  `email` varchar(255) NOT NULL,
  `lastseen` datetime NOT NULL,
  `usergroup` int(11) NOT NULL DEFAULT '3',
  `registerdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Usuarios del Sistema';

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `lastseen`, `usergroup`, `registerdate`, `status`) VALUES
(33, 'gervis', '1234', 'gervis@email.com', '2018-06-27 13:25:32', 2, '2018-06-27 13:25:32', 1),
(34, 'jesus', '1234', 'jesus@email.com', '2018-06-27 16:07:33', 3, '2018-06-27 16:07:33', 1),
(35, 'alexa', '1234', 'alexa@mail.com', '2018-07-15 15:07:45', 3, '2018-07-15 15:07:45', 1),
(36, 'bambi', '1234', 'bambi@email.com', '2018-07-21 18:17:49', 3, '2018-07-21 18:17:49', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userdatapermisions`
--

CREATE TABLE `userdatapermisions` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `permision` varchar(250) NOT NULL,
  `value` varchar(250) NOT NULL,
  `module` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `userdatapermisions`
--

INSERT INTO `userdatapermisions` (`id`, `id_user`, `permision`, `value`, `module`, `status`) VALUES
(22, 33, 'access_user_module', '1', 'User', 1),
(23, 33, 'view_list_user', '1', 'User', 1),
(24, 33, 'create_any_user', '1', 'User', 1),
(25, 33, 'update_any_user', '1', 'User', 1),
(26, 33, 'update_current_user', '1', 'User', 1),
(27, 33, 'update_status_user', '1', 'User', 1),
(28, 33, 'delete_any_user', '1', 'User', 1),
(29, 34, 'access_user_module', '1', 'User', 1),
(30, 34, 'view_list_user', '1', 'User', 1),
(31, 34, 'create_any_user', '1', 'User', 1),
(32, 34, 'update_any_user', '1', 'User', 1),
(33, 34, 'update_current_user', '1', 'User', 1),
(34, 34, 'update_status_user', '1', 'User', 1),
(35, 34, 'delete_any_user', '1', 'User', 1),
(36, 35, 'access_user_module', '1', 'User', 1),
(37, 35, 'view_list_user', '1', 'User', 1),
(38, 35, 'view_specific_user', '0', 'User', 1),
(39, 35, 'create_any_user', '0', 'User', 1),
(40, 35, 'update_any_user', '0', 'User', 1),
(41, 35, 'update_current_user', '1', 'User', 1),
(42, 35, 'update_status_user', '0', 'User', 1),
(43, 35, 'delete_any_user', '0', 'User', 1),
(44, 36, 'access_user_module', '1', 'User', 1),
(45, 36, 'view_list_user', '1', 'User', 1),
(46, 36, 'view_specific_user', '1', 'User', 1),
(47, 36, 'create_any_user', '0', 'User', 1),
(48, 36, 'update_any_user', '0', 'User', 1),
(49, 36, 'update_current_user', '1', 'User', 1),
(50, 36, 'update_status_user', '0', 'User', 1),
(51, 36, 'delete_any_user', '0', 'User', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usergroup`
--

CREATE TABLE `usergroup` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `level` int(11) NOT NULL,
  `description` tinytext NOT NULL,
  `createdate` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usergroup`
--

INSERT INTO `usergroup` (`id`, `name`, `level`, `description`, `createdate`, `status`) VALUES
(1, 'root', 1, 'All permisions allowed', '2016-08-27 09:22:22', 1),
(2, 'Administrador', 2, 'All configurations allowed', '2016-08-27 09:22:22', 1),
(3, 'Estandar', 3, 'Not delete permisions allowed', '2016-08-27 08:32:49', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `duration` varchar(50) NOT NULL,
  `youtubeid` varchar(6000) NOT NULL,
  `preview` varchar(2000) NOT NULL,
  `payinfo` text NOT NULL,
  `fecha` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `video-categoria`
--

CREATE TABLE `video-categoria` (
  `id` int(11) NOT NULL,
  `id_video` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `video-categoria`
--

INSERT INTO `video-categoria` (`id`, `id_video`, `id_categoria`) VALUES
(1, 0, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `album_items`
--
ALTER TABLE `album_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_album` (`id_album`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `contactsdata`
--
ALTER TABLE `contactsdata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_contact` (`id_contact`);

--
-- Indices de la tabla `datauserstorage`
--
ALTER TABLE `datauserstorage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`id_user`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mailfolder`
--
ALTER TABLE `mailfolder`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `namefolder` (`namefolder`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folder` (`folder`) USING BTREE;

--
-- Indices de la tabla `mensajesdata`
--
ALTER TABLE `mensajesdata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mensaje` (`id_mensaje`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`id_user`);

--
-- Indices de la tabla `prestamos_clientes`
--
ALTER TABLE `prestamos_clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identificacion` (`identificacion`(100)),
  ADD KEY `id_user_register` (`id_user_register`);

--
-- Indices de la tabla `prestamos_clientes_prestamista`
--
ALTER TABLE `prestamos_clientes_prestamista`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prestamista` (`id_prestamista`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `prestamos_cuotas`
--
ALTER TABLE `prestamos_cuotas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prestamo` (`id_prestamo`),
  ADD KEY `id_prestamo_2` (`id_prestamo`);

--
-- Indices de la tabla `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prestamista` (`id_prestamista`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `relations`
--
ALTER TABLE `relations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `suscriptores`
--
ALTER TABLE `suscriptores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `userdatapermisions`
--
ALTER TABLE `userdatapermisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `usergroup`
--
ALTER TABLE `usergroup`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `video-categoria`
--
ALTER TABLE `video-categoria`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `album_items`
--
ALTER TABLE `album_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contactsdata`
--
ALTER TABLE `contactsdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datauserstorage`
--
ALTER TABLE `datauserstorage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mailfolder`
--
ALTER TABLE `mailfolder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `mensajesdata`
--
ALTER TABLE `mensajesdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prestamos_clientes`
--
ALTER TABLE `prestamos_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `prestamos_clientes_prestamista`
--
ALTER TABLE `prestamos_clientes_prestamista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `prestamos_cuotas`
--
ALTER TABLE `prestamos_cuotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `relations`
--
ALTER TABLE `relations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `suscriptores`
--
ALTER TABLE `suscriptores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `userdatapermisions`
--
ALTER TABLE `userdatapermisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `usergroup`
--
ALTER TABLE `usergroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `video-categoria`
--
ALTER TABLE `video-categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `prestamos_clientes`
--
ALTER TABLE `prestamos_clientes`
  ADD CONSTRAINT `id_user_register` FOREIGN KEY (`id_user_register`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamos_cuotas`
--
ALTER TABLE `prestamos_cuotas`
  ADD CONSTRAINT `id_prestamo` FOREIGN KEY (`id_prestamo`) REFERENCES `loans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `cliente` FOREIGN KEY (`id_cliente`) REFERENCES `prestamos_clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamista` FOREIGN KEY (`id_prestamista`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
