-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-10-2017 a las 15:52:59
-- Versión del servidor: 5.7.19-0ubuntu0.17.04.1
-- Versión de PHP: 7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aquasoft`
--
CREATE DATABASE IF NOT EXISTS `aquasoft` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `aquasoft`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acuarios`
--

DROP TABLE IF EXISTS `acuarios`;
CREATE TABLE `acuarios` (
  `idacuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `espaciodisponible` int(11) NOT NULL,
  `activo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `acuarios`
--

INSERT INTO `acuarios` (`idacuario`, `nombre`, `descripcion`, `espaciodisponible`, `activo`) VALUES
(1, 'A01', '', 100, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acuarios_usuarios`
--

DROP TABLE IF EXISTS `acuarios_usuarios`;
CREATE TABLE `acuarios_usuarios` (
  `acuario_idacuario` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('administrador', 1, 1506560512),
('encargado', 2, 1506560523),
('encargado', 18, 1506560537),
('especialista', 16, 1506560528),
('especialista', 17, 1506560533);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/admin/*', 2, NULL, NULL, NULL, 1506560356, 1506560356),
('/admin/assignment/*', 2, NULL, NULL, NULL, 1506560342, 1506560342),
('/admin/assignment/assign', 2, NULL, NULL, NULL, 1506560335, 1506560335),
('/admin/assignment/index', 2, NULL, NULL, NULL, 1506560335, 1506560335),
('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1506560335, 1506560335),
('/admin/assignment/view', 2, NULL, NULL, NULL, 1506560335, 1506560335),
('/admin/default/*', 2, NULL, NULL, NULL, 1506560342, 1506560342),
('/admin/default/index', 2, NULL, NULL, NULL, 1506560336, 1506560336),
('/admin/menu/*', 2, NULL, NULL, NULL, 1506560342, 1506560342),
('/admin/menu/create', 2, NULL, NULL, NULL, 1506560339, 1506560339),
('/admin/menu/delete', 2, NULL, NULL, NULL, 1506560339, 1506560339),
('/admin/menu/index', 2, NULL, NULL, NULL, 1506560339, 1506560339),
('/admin/menu/update', 2, NULL, NULL, NULL, 1506560339, 1506560339),
('/admin/menu/view', 2, NULL, NULL, NULL, 1506560339, 1506560339),
('/admin/permission/*', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/permission/assign', 2, NULL, NULL, NULL, 1506560345, 1506560345),
('/admin/permission/create', 2, NULL, NULL, NULL, 1506560345, 1506560345),
('/admin/permission/delete', 2, NULL, NULL, NULL, 1506560345, 1506560345),
('/admin/permission/index', 2, NULL, NULL, NULL, 1506560345, 1506560345),
('/admin/permission/remove', 2, NULL, NULL, NULL, 1506560345, 1506560345),
('/admin/permission/update', 2, NULL, NULL, NULL, 1506560345, 1506560345),
('/admin/permission/view', 2, NULL, NULL, NULL, 1506560345, 1506560345),
('/admin/role/*', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/role/assign', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/role/create', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/role/delete', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/role/index', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/role/remove', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/role/update', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/role/view', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/route/*', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/route/assign', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/route/create', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/route/index', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/route/refresh', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/route/remove', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/rule/*', 2, NULL, NULL, NULL, 1506560356, 1506560356),
('/admin/rule/create', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/rule/delete', 2, NULL, NULL, NULL, 1506560356, 1506560356),
('/admin/rule/index', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/rule/update', 2, NULL, NULL, NULL, 1506560356, 1506560356),
('/admin/rule/view', 2, NULL, NULL, NULL, 1506560355, 1506560355),
('/admin/user/*', 2, NULL, NULL, NULL, 1506560356, 1506560356),
('/admin/user/activate', 2, NULL, NULL, NULL, 1506560356, 1506560356),
('/admin/user/change-password', 2, NULL, NULL, NULL, 1506560356, 1506560356),
('/admin/user/delete', 2, NULL, NULL, NULL, 1506560356, 1506560356),
('/admin/user/index', 2, NULL, NULL, NULL, 1506560356, 1506560356),
('/admin/user/login', 2, NULL, NULL, NULL, 1506560356, 1506560356),
('/admin/user/logout', 2, NULL, NULL, NULL, 1506560356, 1506560356),
('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1506560356, 1506560356),
('/admin/user/reset-password', 2, NULL, NULL, NULL, 1506560356, 1506560356),
('/admin/user/signup', 2, NULL, NULL, NULL, 1506560356, 1506560356),
('/admin/user/view', 2, NULL, NULL, NULL, 1506560356, 1506560356),
('/aquarium/create', 2, NULL, NULL, NULL, 1506883912, 1506883912),
('/aquarium/delete', 2, NULL, NULL, NULL, 1506883912, 1506883912),
('/aquarium/detail', 2, NULL, NULL, NULL, 1506883912, 1506883912),
('/aquarium/index', 2, NULL, NULL, NULL, 1506883912, 1506883912),
('/aquarium/update', 2, NULL, NULL, NULL, 1506883912, 1506883912),
('/aquarium/view', 2, NULL, NULL, NULL, 1506883912, 1506883912),
('/debug/*', 2, NULL, NULL, NULL, 1506560367, 1506560367),
('/debug/default/*', 2, NULL, NULL, NULL, 1506560367, 1506560367),
('/debug/default/db-explain', 2, NULL, NULL, NULL, 1506560366, 1506560366),
('/debug/default/download-mail', 2, NULL, NULL, NULL, 1506560367, 1506560367),
('/debug/default/index', 2, NULL, NULL, NULL, 1506560366, 1506560366),
('/debug/default/toolbar', 2, NULL, NULL, NULL, 1506560367, 1506560367),
('/debug/default/view', 2, NULL, NULL, NULL, 1506560367, 1506560367),
('/debug/user/*', 2, NULL, NULL, NULL, 1506560367, 1506560367),
('/debug/user/reset-identity', 2, NULL, NULL, NULL, 1506560367, 1506560367),
('/debug/user/set-identity', 2, NULL, NULL, NULL, 1506560367, 1506560367),
('/gii/*', 2, NULL, NULL, NULL, 1506560367, 1506560367),
('/gii/default/*', 2, NULL, NULL, NULL, 1506560367, 1506560367),
('/gii/default/action', 2, NULL, NULL, NULL, 1506560367, 1506560367),
('/gii/default/diff', 2, NULL, NULL, NULL, 1506560367, 1506560367),
('/gii/default/index', 2, NULL, NULL, NULL, 1506560367, 1506560367),
('/gii/default/preview', 2, NULL, NULL, NULL, 1506560367, 1506560367),
('/gii/default/view', 2, NULL, NULL, NULL, 1506560367, 1506560367),
('/site/error', 2, NULL, NULL, NULL, 1506560372, 1506560372),
('/site/index', 2, NULL, NULL, NULL, 1506560373, 1506560373),
('/site/login', 2, NULL, NULL, NULL, 1506560373, 1506560373),
('/site/logout', 2, NULL, NULL, NULL, 1506560373, 1506560373),
('/user/*', 2, NULL, NULL, NULL, 1506560602, 1506560602),
('/user/create', 2, NULL, NULL, NULL, 1506560370, 1506560370),
('/user/delete', 2, NULL, NULL, NULL, 1506560370, 1506560370),
('/user/index', 2, NULL, NULL, NULL, 1506560370, 1506560370),
('/user/update', 2, NULL, NULL, NULL, 1506560370, 1506560370),
('/user/view', 2, NULL, NULL, NULL, 1506560370, 1506560370),
('administrador', 1, NULL, NULL, NULL, 1506560408, 1506560408),
('encargado', 1, NULL, NULL, NULL, 1506560453, 1506560453),
('especialista', 1, NULL, NULL, NULL, 1506560482, 1506560482);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('administrador', '/admin/*'),
('administrador', '/admin/assignment/*'),
('administrador', '/admin/assignment/assign'),
('administrador', '/admin/assignment/index'),
('administrador', '/admin/assignment/revoke'),
('administrador', '/admin/assignment/view'),
('administrador', '/admin/default/*'),
('administrador', '/admin/default/index'),
('administrador', '/admin/menu/*'),
('administrador', '/admin/menu/create'),
('administrador', '/admin/menu/delete'),
('administrador', '/admin/menu/index'),
('administrador', '/admin/menu/update'),
('administrador', '/admin/menu/view'),
('administrador', '/admin/permission/*'),
('administrador', '/admin/permission/assign'),
('administrador', '/admin/permission/create'),
('administrador', '/admin/permission/delete'),
('administrador', '/admin/permission/index'),
('administrador', '/admin/permission/remove'),
('administrador', '/admin/permission/update'),
('administrador', '/admin/permission/view'),
('administrador', '/admin/role/*'),
('administrador', '/admin/role/assign'),
('administrador', '/admin/role/create'),
('administrador', '/admin/role/delete'),
('administrador', '/admin/role/index'),
('administrador', '/admin/role/remove'),
('administrador', '/admin/role/update'),
('administrador', '/admin/role/view'),
('administrador', '/admin/route/*'),
('administrador', '/admin/route/assign'),
('administrador', '/admin/route/create'),
('administrador', '/admin/route/index'),
('administrador', '/admin/route/refresh'),
('administrador', '/admin/route/remove'),
('administrador', '/admin/rule/*'),
('administrador', '/admin/rule/create'),
('administrador', '/admin/rule/delete'),
('administrador', '/admin/rule/index'),
('administrador', '/admin/rule/update'),
('administrador', '/admin/rule/view'),
('administrador', '/admin/user/*'),
('administrador', '/admin/user/activate'),
('administrador', '/admin/user/change-password'),
('administrador', '/admin/user/delete'),
('administrador', '/admin/user/index'),
('administrador', '/admin/user/login'),
('administrador', '/admin/user/logout'),
('administrador', '/admin/user/request-password-reset'),
('administrador', '/admin/user/reset-password'),
('administrador', '/admin/user/signup'),
('administrador', '/admin/user/view'),
('administrador', '/aquarium/create'),
('administrador', '/aquarium/delete'),
('administrador', '/aquarium/detail'),
('administrador', '/aquarium/index'),
('administrador', '/aquarium/update'),
('administrador', '/aquarium/view'),
('administrador', '/debug/*'),
('administrador', '/debug/default/*'),
('administrador', '/debug/default/db-explain'),
('administrador', '/debug/default/download-mail'),
('administrador', '/debug/default/index'),
('administrador', '/debug/default/toolbar'),
('administrador', '/debug/default/view'),
('administrador', '/debug/user/*'),
('administrador', '/debug/user/reset-identity'),
('administrador', '/debug/user/set-identity'),
('administrador', '/gii/*'),
('administrador', '/gii/default/*'),
('administrador', '/gii/default/action'),
('administrador', '/gii/default/diff'),
('administrador', '/gii/default/index'),
('administrador', '/gii/default/preview'),
('administrador', '/gii/default/view'),
('administrador', '/site/error'),
('encargado', '/site/error'),
('especialista', '/site/error'),
('administrador', '/site/index'),
('encargado', '/site/index'),
('especialista', '/site/index'),
('administrador', '/site/login'),
('encargado', '/site/login'),
('especialista', '/site/login'),
('administrador', '/site/logout'),
('encargado', '/site/logout'),
('especialista', '/site/logout'),
('administrador', '/user/create'),
('encargado', '/user/create'),
('administrador', '/user/delete'),
('encargado', '/user/delete'),
('administrador', '/user/index'),
('encargado', '/user/index'),
('administrador', '/user/update'),
('encargado', '/user/update'),
('administrador', '/user/view'),
('encargado', '/user/view');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condiciones_ambientales`
--

DROP TABLE IF EXISTS `condiciones_ambientales`;
CREATE TABLE `condiciones_ambientales` (
  `idcondiciones_ambientales` int(11) NOT NULL,
  `ph` double NOT NULL,
  `temperatura` double NOT NULL,
  `salinidad` double NOT NULL,
  `lux` double NOT NULL,
  `co2` double NOT NULL,
  `acuario_idacuario` int(11) NOT NULL,
  `tarea_idtarea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejemplares`
--

DROP TABLE IF EXISTS `ejemplares`;
CREATE TABLE `ejemplares` (
  `especies_idespecie` int(11) NOT NULL,
  `acuarios_idacuario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especies`
--

DROP TABLE IF EXISTS `especies`;
CREATE TABLE `especies` (
  `idespecie` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `minph` double NOT NULL,
  `maxph` double NOT NULL,
  `mintemp` double NOT NULL,
  `maxtemp` double NOT NULL,
  `minsalinidad` double NOT NULL,
  `maxsalinidad` double NOT NULL,
  `minlux` double NOT NULL,
  `maxlux` double NOT NULL,
  `minespacio` int(11) NOT NULL,
  `minco2` double NOT NULL,
  `maxco2` double NOT NULL,
  `activo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_planificacion`
--

DROP TABLE IF EXISTS `estados_planificacion`;
CREATE TABLE `estados_planificacion` (
  `idestado_planificacion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados_planificacion`
--

INSERT INTO `estados_planificacion` (`idestado_planificacion`) VALUES
('Aprobado'),
('Rechazado'),
('SinVerificar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

DROP TABLE IF EXISTS `insumos`;
CREATE TABLE `insumos` (
  `idinsumo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `tipos_tarea_idtipo_tarea` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1506399989),
('m140506_102106_rbac_init', 1506400838),
('m140602_111327_create_menu_table', 1506452642),
('m160312_050000_create_user', 1506452643);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivos_rechazo`
--

DROP TABLE IF EXISTS `motivos_rechazo`;
CREATE TABLE `motivos_rechazo` (
  `idmotivo_rechazo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `motivos_rechazo`
--

INSERT INTO `motivos_rechazo` (`idmotivo_rechazo`) VALUES
('Escasez de tareas'),
('Incorrecta distribución de tareas'),
('Incumplimiento de politicas'),
('Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
CREATE TABLE `notificaciones` (
  `idnotificacion` int(11) NOT NULL,
  `fechahora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tareas_idtarea` int(11) NOT NULL,
  `origen_notificacion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `origen_notificacion`
--

DROP TABLE IF EXISTS `origen_notificacion`;
CREATE TABLE `origen_notificacion` (
  `idorigen_notificacion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `origen_notificacion`
--

INSERT INTO `origen_notificacion` (`idorigen_notificacion`) VALUES
('Hábitat riesgoso'),
('Tarea no realizada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planificaciones`
--

DROP TABLE IF EXISTS `planificaciones`;
CREATE TABLE `planificaciones` (
  `idplanificacion` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `aniomes` date NOT NULL,
  `fechahoracreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` tinyint(1) DEFAULT '1',
  `estados_planificacion_idestado_planificacion` varchar(45) NOT NULL,
  `acuarios_usuarios_acuarios_idacuario` int(11) NOT NULL,
  `acuarios_usuarios_usuarios_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

DROP TABLE IF EXISTS `tareas`;
CREATE TABLE `tareas` (
  `idtarea` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `fechahorainicio` datetime NOT NULL,
  `fechahorafin` datetime NOT NULL,
  `fechahorarealizacion` datetime DEFAULT NULL,
  `planificaciones_idplanificacion` int(11) DEFAULT NULL COMMENT 'Si este campo está vacío significa que la tareas a sido creada fuera de la planificacion mensual.',
  `usuarios_idusuario` int(11) DEFAULT NULL,
  `tipos_tarea_idtipo_tarea` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas_insumos`
--

DROP TABLE IF EXISTS `tareas_insumos`;
CREATE TABLE `tareas_insumos` (
  `insumos_idinsumo` int(11) NOT NULL,
  `tarea_idtarea` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_tarea`
--

DROP TABLE IF EXISTS `tipos_tarea`;
CREATE TABLE `tipos_tarea` (
  `idtipo_tarea` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_tarea`
--

INSERT INTO `tipos_tarea` (`idtipo_tarea`) VALUES
('Alimentación'),
('Controlar'),
('Limpieza'),
('Reparación'),
('Transferir');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `nombre_usuario` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `activo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `nombre_usuario`, `email`, `contrasenia`, `activo`) VALUES
(1, 'Emilio', 'Melo', 'emelo', 'emelo@gmail.com', '$2y$13$/0ILfzMsXgdSqkKuRzYAu.kCQuFsrmB6JVXIC4.rE4kbxpyYwEO6W', 1),
(2, 'Romina', 'Bertini', 'rbertini', 'romina@gmail.com', '$2y$13$u5cBGilAW2s/sVNIF5c4i.OZE556sx1mqPCOM2hjeR1wJ76ujvV3y', 1),
(16, 'Facundo', 'Reyna', 'freyna', 'facundo@gmail.com', '$2y$13$GMa4SuOnh8NxUT4UmUsaAOKM4cLibGyOfWKCLw8Akh32TxhSj1sku', 1),
(17, 'Lía', 'Moreno', 'lmoreno', 'lia@gmail.com', '$2y$13$gGUmKqUOVtUvk2tP70ZO6O2bGghqLO4ArsZtTaUEVUMqVyOhNM4O6', 0),
(18, 'Juan', 'Perez', 'jperez', 'juan@gmail.com', '$2y$13$588gD.6PaF3Gt4.vpqPTv.sawoQ9Auc8wOnwOUntuPcplq8Ba.N3m', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `validaciones`
--

DROP TABLE IF EXISTS `validaciones`;
CREATE TABLE `validaciones` (
  `idvalidacion` int(11) NOT NULL,
  `fechahora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `observacion` varchar(200) DEFAULT NULL,
  `planificaciones_idplanificacion` int(11) NOT NULL,
  `usuarios_idusuario` int(11) NOT NULL,
  `motivos_rechazo_idmotivo_rechazo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acuarios`
--
ALTER TABLE `acuarios`
  ADD PRIMARY KEY (`idacuario`);

--
-- Indices de la tabla `acuarios_usuarios`
--
ALTER TABLE `acuarios_usuarios`
  ADD PRIMARY KEY (`acuario_idacuario`,`usuario_idusuario`),
  ADD KEY `fk_idUSUARIO_idx` (`usuario_idusuario`),
  ADD KEY `fk_idACUARIO_idx` (`acuario_idacuario`);

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `fk_asignment_usuarios` (`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `condiciones_ambientales`
--
ALTER TABLE `condiciones_ambientales`
  ADD PRIMARY KEY (`idcondiciones_ambientales`),
  ADD KEY `fk_CONDICION_AMBIENTAL_ACUARIO1_idx` (`acuario_idacuario`),
  ADD KEY `fk_CONDICION_AMBIENTAL_TAREA1_idx` (`tarea_idtarea`);

--
-- Indices de la tabla `ejemplares`
--
ALTER TABLE `ejemplares`
  ADD PRIMARY KEY (`especies_idespecie`,`acuarios_idacuario`),
  ADD KEY `fk_idACUARIO_idx` (`acuarios_idacuario`),
  ADD KEY `fk_idESPECIE_idx` (`especies_idespecie`);

--
-- Indices de la tabla `especies`
--
ALTER TABLE `especies`
  ADD PRIMARY KEY (`idespecie`);

--
-- Indices de la tabla `estados_planificacion`
--
ALTER TABLE `estados_planificacion`
  ADD PRIMARY KEY (`idestado_planificacion`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`idinsumo`),
  ADD KEY `fk_INSUMO_TIPO_TAREA1_idx` (`tipos_tarea_idtipo_tarea`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `motivos_rechazo`
--
ALTER TABLE `motivos_rechazo`
  ADD PRIMARY KEY (`idmotivo_rechazo`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`idnotificacion`),
  ADD KEY `fk_NOTIFICACION_TAREA1_idx` (`tareas_idtarea`),
  ADD KEY `fk_NOTIFICACION_ORIGEN_NOTIFICACION1_idx` (`origen_notificacion`);

--
-- Indices de la tabla `origen_notificacion`
--
ALTER TABLE `origen_notificacion`
  ADD PRIMARY KEY (`idorigen_notificacion`);

--
-- Indices de la tabla `planificaciones`
--
ALTER TABLE `planificaciones`
  ADD PRIMARY KEY (`idplanificacion`),
  ADD KEY `fk_PLANIFICACION_ESTADO_PLANIFICACION1_idx` (`estados_planificacion_idestado_planificacion`),
  ADD KEY `fk_PLANIFICACION_ACUARIO_USUARIO1_idx` (`acuarios_usuarios_acuarios_idacuario`,`acuarios_usuarios_usuarios_idusuario`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`idtarea`),
  ADD KEY `fk_TAREA_PLANIFICACION1_idx` (`planificaciones_idplanificacion`),
  ADD KEY `fk_TAREA_USUARIO1_idx` (`usuarios_idusuario`),
  ADD KEY `fk_TAREA_TIPO_TAREA1_idx` (`tipos_tarea_idtipo_tarea`);

--
-- Indices de la tabla `tareas_insumos`
--
ALTER TABLE `tareas_insumos`
  ADD PRIMARY KEY (`insumos_idinsumo`,`tarea_idtarea`),
  ADD KEY `fk_INSUMO_has_TAREA_TAREA1_idx` (`tarea_idtarea`),
  ADD KEY `fk_INSUMO_has_TAREA_INSUMO1_idx` (`insumos_idinsumo`);

--
-- Indices de la tabla `tipos_tarea`
--
ALTER TABLE `tipos_tarea`
  ADD PRIMARY KEY (`idtipo_tarea`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `validaciones`
--
ALTER TABLE `validaciones`
  ADD PRIMARY KEY (`idvalidacion`),
  ADD KEY `fk_VALIDACION_PLANIFICACION1_idx` (`planificaciones_idplanificacion`),
  ADD KEY `fk_VALIDACION_USUARIO1_idx` (`usuarios_idusuario`),
  ADD KEY `fk_VALIDACION_MOTIVO_RECHAZO1_idx` (`motivos_rechazo_idmotivo_rechazo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acuarios`
--
ALTER TABLE `acuarios`
  MODIFY `idacuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `condiciones_ambientales`
--
ALTER TABLE `condiciones_ambientales`
  MODIFY `idcondiciones_ambientales` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `especies`
--
ALTER TABLE `especies`
  MODIFY `idespecie` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `idinsumo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `idnotificacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `planificaciones`
--
ALTER TABLE `planificaciones`
  MODIFY `idplanificacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `idtarea` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `validaciones`
--
ALTER TABLE `validaciones`
  MODIFY `idvalidacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acuarios_usuarios`
--
ALTER TABLE `acuarios_usuarios`
  ADD CONSTRAINT `fk_acuarios_usuarios_idacuario` FOREIGN KEY (`acuario_idacuario`) REFERENCES `acuarios` (`idacuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_acuarios_usuarios_idusuario` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_asignment_usuarios` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `condiciones_ambientales`
--
ALTER TABLE `condiciones_ambientales`
  ADD CONSTRAINT `fk_CONDAMBIENTAL_idACUARIO` FOREIGN KEY (`acuario_idacuario`) REFERENCES `acuarios` (`idacuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CONDAMBIENTAL_idTAREA` FOREIGN KEY (`tarea_idtarea`) REFERENCES `tareas` (`idtarea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ejemplares`
--
ALTER TABLE `ejemplares`
  ADD CONSTRAINT `fk_ESPECIE_idACUARIO` FOREIGN KEY (`acuarios_idacuario`) REFERENCES `acuarios` (`idacuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ESPECIE_idESPECIE` FOREIGN KEY (`especies_idespecie`) REFERENCES `especies` (`idespecie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD CONSTRAINT `fk_INSUMO_idTIPO_TAREA` FOREIGN KEY (`tipos_tarea_idtipo_tarea`) REFERENCES `tipos_tarea` (`idtipo_tarea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_NOTIFICACION_idORIGEN_NOTIFICACION` FOREIGN KEY (`origen_notificacion`) REFERENCES `origen_notificacion` (`idorigen_notificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_NOTIFICACION_idTAREA` FOREIGN KEY (`tareas_idtarea`) REFERENCES `tareas` (`idtarea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `planificaciones`
--
ALTER TABLE `planificaciones`
  ADD CONSTRAINT `fk_PLANIFICACION_ACUARIO_USUARIO1` FOREIGN KEY (`acuarios_usuarios_acuarios_idacuario`,`acuarios_usuarios_usuarios_idusuario`) REFERENCES `acuario_usuario` (`acuario_idacuario`, `usuario_idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PLANIFICACION_idESTADO_PLANIFICACION` FOREIGN KEY (`estados_planificacion_idestado_planificacion`) REFERENCES `estados_planificacion` (`idestado_planificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `fk_TAREA_idPLANIFICACION` FOREIGN KEY (`planificaciones_idplanificacion`) REFERENCES `planificaciones` (`idplanificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TAREA_idTIPO_TAREA` FOREIGN KEY (`tipos_tarea_idtipo_tarea`) REFERENCES `tipos_tarea` (`idtipo_tarea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TAREA_idUSUARIO` FOREIGN KEY (`usuarios_idusuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tareas_insumos`
--
ALTER TABLE `tareas_insumos`
  ADD CONSTRAINT `fk_TAREA_INSUMO_idINSUMO` FOREIGN KEY (`insumos_idinsumo`) REFERENCES `insumos` (`idinsumo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TAREA_INSUMO_idTAREA` FOREIGN KEY (`tarea_idtarea`) REFERENCES `tareas` (`idtarea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `validaciones`
--
ALTER TABLE `validaciones`
  ADD CONSTRAINT `fk_VALIDACION_idMOTIVO_RECHAZO` FOREIGN KEY (`motivos_rechazo_idmotivo_rechazo`) REFERENCES `motivos_rechazo` (`idmotivo_rechazo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_VALIDACION_idPLANIFICACION` FOREIGN KEY (`planificaciones_idplanificacion`) REFERENCES `planificaciones` (`idplanificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_VALIDACION_idUSUARIO` FOREIGN KEY (`usuarios_idusuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
