-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-09-2017 a las 15:32:57
-- Versión del servidor: 5.7.19-0ubuntu0.17.04.1
-- Versión de PHP: 7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `AQUASOFT`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ACUARIO`
--

CREATE TABLE `ACUARIO` (
  `idACUARIO` int(11) NOT NULL,
  `NOMBRE` varchar(45) NOT NULL,
  `DESCRIPCION` varchar(200) DEFAULT NULL,
  `ESPACIODISPONIBLE` int(11) NOT NULL,
  `ACTIVO` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ACUARIO_USUARIO`
--

CREATE TABLE `ACUARIO_USUARIO` (
  `ACUARIO_idACUARIO` int(11) NOT NULL,
  `USUARIO_idUSUARIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

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

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CONDICION_AMBIENTAL`
--

CREATE TABLE `CONDICION_AMBIENTAL` (
  `idCONDICION_AMBIENTAL` int(11) NOT NULL,
  `PH` double NOT NULL,
  `TEMPERATURA` double NOT NULL,
  `SALINIDAD` double NOT NULL,
  `LUX` double NOT NULL,
  `CO2` double NOT NULL,
  `ACUARIO_idACUARIO` int(11) NOT NULL,
  `TAREA_idTAREA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EJEMPLAR`
--

CREATE TABLE `EJEMPLAR` (
  `ESPECIE_idESPECIE` int(11) NOT NULL,
  `ACUARIO_idACUARIO` int(11) NOT NULL,
  `CANTIDAD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESPECIE`
--

CREATE TABLE `ESPECIE` (
  `idESPECIE` int(11) NOT NULL,
  `NOMBRE` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `DESCRIPCION` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `MINPH` double NOT NULL,
  `MAXPH` double NOT NULL,
  `MINTEMP` double NOT NULL,
  `MAXTEMP` double NOT NULL,
  `MINSALINIDAD` double NOT NULL,
  `MAXSALINIDAD` double NOT NULL,
  `MINLUX` double NOT NULL,
  `MAXLUX` double NOT NULL,
  `MINESPACIO` int(11) NOT NULL,
  `MINCO2` double NOT NULL,
  `MAXCO2` double NOT NULL,
  `ACTIVO` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESTADO_PLANIFICACION`
--

CREATE TABLE `ESTADO_PLANIFICACION` (
  `idESTADO_PLANIFICACION` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ESTADO_PLANIFICACION`
--

INSERT INTO `ESTADO_PLANIFICACION` (`idESTADO_PLANIFICACION`) VALUES
('Aprobado'),
('Rechazado'),
('SinVerificar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INSUMO`
--

CREATE TABLE `INSUMO` (
  `idINSUMO` int(11) NOT NULL,
  `NOMBRE` varchar(45) NOT NULL,
  `DESCRIPCION` varchar(200) DEFAULT NULL,
  `STOCK` int(11) NOT NULL,
  `ACTIVO` tinyint(1) DEFAULT '1',
  `TIPO_TAREA_idTIPO_TAREA` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

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
-- Estructura de tabla para la tabla `MOTIVO_RECHAZO`
--

CREATE TABLE `MOTIVO_RECHAZO` (
  `idMOTIVO_RECHAZO` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `MOTIVO_RECHAZO`
--

INSERT INTO `MOTIVO_RECHAZO` (`idMOTIVO_RECHAZO`) VALUES
('Escasez de tareas'),
('Incorrecta distribución de tareas'),
('Incumplimiento de politicas'),
('Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `NOTIFICACION`
--

CREATE TABLE `NOTIFICACION` (
  `idNOTIFICACION` int(11) NOT NULL,
  `FECHAHORA` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TAREA_idTAREA` int(11) NOT NULL,
  `ORIGEN_NOTIFICACION_idORIGEN_NOTIFICACION` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ORIGEN_NOTIFICACION`
--

CREATE TABLE `ORIGEN_NOTIFICACION` (
  `idORIGEN_NOTIFICACION` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ORIGEN_NOTIFICACION`
--

INSERT INTO `ORIGEN_NOTIFICACION` (`idORIGEN_NOTIFICACION`) VALUES
('Hábitat riesgoso'),
('Tarea no realizada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PLANIFICACION`
--

CREATE TABLE `PLANIFICACION` (
  `idPLANIFICACION` int(11) NOT NULL,
  `TITULO` varchar(45) NOT NULL,
  `ANIOMES` date NOT NULL,
  `FECHAHORACREACION` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ACTIVO` tinyint(1) DEFAULT '1',
  `ESTADO_PLANIFICACION_idESTADO_PLANIFICACION` varchar(45) NOT NULL,
  `ACUARIO_USUARIO_ACUARIO_idACUARIO` int(11) NOT NULL,
  `ACUARIO_USUARIO_USUARIO_idUSUARIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ROL`
--

CREATE TABLE `ROL` (
  `idROL` int(11) NOT NULL,
  `NOMBREROL` varchar(45) NOT NULL,
  `DESCRIPCION` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ROL`
--

INSERT INTO `ROL` (`idROL`, `NOMBREROL`, `DESCRIPCION`) VALUES
(1, 'Especialista', 'Perfil del personal responsable del mantenimiento de un grupo de acuarios'),
(2, 'Encargado', 'Perfil del personal responsable de la organización del acuarium');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TAREA`
--

CREATE TABLE `TAREA` (
  `idTAREA` int(11) NOT NULL,
  `TITULO` varchar(45) NOT NULL,
  `DESCRIPCION` varchar(200) DEFAULT NULL,
  `FECHAHORAINICIO` datetime NOT NULL,
  `FECHAHORAFIN` datetime NOT NULL,
  `FECHAHORAREALIZACION` datetime DEFAULT NULL,
  `PLANIFICACION_idPLANIFICACION` int(11) DEFAULT NULL COMMENT 'Si este campo está vacío significa que la tareas a sido creada fuera de la planificacion mensual.',
  `USUARIO_idUSUARIO` int(11) DEFAULT NULL,
  `TIPO_TAREA_idTIPO_TAREA` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TAREA_INSUMO`
--

CREATE TABLE `TAREA_INSUMO` (
  `INSUMO_idINSUMO` int(11) NOT NULL,
  `TAREA_idTAREA` int(11) NOT NULL,
  `CANTIDAD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TIPO_TAREA`
--

CREATE TABLE `TIPO_TAREA` (
  `idTIPO_TAREA` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TIPO_TAREA`
--

INSERT INTO `TIPO_TAREA` (`idTIPO_TAREA`) VALUES
('Alimentación'),
('Controlar'),
('Limpieza'),
('Reparación'),
('Transferir');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

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
-- Estructura de tabla para la tabla `VALIDACION`
--

CREATE TABLE `VALIDACION` (
  `idVALIDACION` int(11) NOT NULL,
  `FECHAHORA` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OBSERVACION` varchar(200) DEFAULT NULL,
  `PLANIFICACION_idPLANIFICACION` int(11) NOT NULL,
  `USUARIO_idUSUARIO` int(11) NOT NULL,
  `MOTIVO_RECHAZO_idMOTIVO_RECHAZO` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ACUARIO`
--
ALTER TABLE `ACUARIO`
  ADD PRIMARY KEY (`idACUARIO`);

--
-- Indices de la tabla `ACUARIO_USUARIO`
--
ALTER TABLE `ACUARIO_USUARIO`
  ADD PRIMARY KEY (`ACUARIO_idACUARIO`,`USUARIO_idUSUARIO`),
  ADD KEY `fk_idUSUARIO_idx` (`USUARIO_idUSUARIO`),
  ADD KEY `fk_idACUARIO_idx` (`ACUARIO_idACUARIO`);

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
-- Indices de la tabla `CONDICION_AMBIENTAL`
--
ALTER TABLE `CONDICION_AMBIENTAL`
  ADD PRIMARY KEY (`idCONDICION_AMBIENTAL`),
  ADD KEY `fk_CONDICION_AMBIENTAL_ACUARIO1_idx` (`ACUARIO_idACUARIO`),
  ADD KEY `fk_CONDICION_AMBIENTAL_TAREA1_idx` (`TAREA_idTAREA`);

--
-- Indices de la tabla `EJEMPLAR`
--
ALTER TABLE `EJEMPLAR`
  ADD PRIMARY KEY (`ESPECIE_idESPECIE`,`ACUARIO_idACUARIO`),
  ADD KEY `fk_idACUARIO_idx` (`ACUARIO_idACUARIO`),
  ADD KEY `fk_idESPECIE_idx` (`ESPECIE_idESPECIE`);

--
-- Indices de la tabla `ESPECIE`
--
ALTER TABLE `ESPECIE`
  ADD PRIMARY KEY (`idESPECIE`);

--
-- Indices de la tabla `ESTADO_PLANIFICACION`
--
ALTER TABLE `ESTADO_PLANIFICACION`
  ADD PRIMARY KEY (`idESTADO_PLANIFICACION`);

--
-- Indices de la tabla `INSUMO`
--
ALTER TABLE `INSUMO`
  ADD PRIMARY KEY (`idINSUMO`),
  ADD KEY `fk_INSUMO_TIPO_TAREA1_idx` (`TIPO_TAREA_idTIPO_TAREA`);

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
-- Indices de la tabla `MOTIVO_RECHAZO`
--
ALTER TABLE `MOTIVO_RECHAZO`
  ADD PRIMARY KEY (`idMOTIVO_RECHAZO`);

--
-- Indices de la tabla `NOTIFICACION`
--
ALTER TABLE `NOTIFICACION`
  ADD PRIMARY KEY (`idNOTIFICACION`),
  ADD KEY `fk_NOTIFICACION_TAREA1_idx` (`TAREA_idTAREA`),
  ADD KEY `fk_NOTIFICACION_ORIGEN_NOTIFICACION1_idx` (`ORIGEN_NOTIFICACION_idORIGEN_NOTIFICACION`);

--
-- Indices de la tabla `ORIGEN_NOTIFICACION`
--
ALTER TABLE `ORIGEN_NOTIFICACION`
  ADD PRIMARY KEY (`idORIGEN_NOTIFICACION`);

--
-- Indices de la tabla `PLANIFICACION`
--
ALTER TABLE `PLANIFICACION`
  ADD PRIMARY KEY (`idPLANIFICACION`),
  ADD KEY `fk_PLANIFICACION_ESTADO_PLANIFICACION1_idx` (`ESTADO_PLANIFICACION_idESTADO_PLANIFICACION`),
  ADD KEY `fk_PLANIFICACION_ACUARIO_USUARIO1_idx` (`ACUARIO_USUARIO_ACUARIO_idACUARIO`,`ACUARIO_USUARIO_USUARIO_idUSUARIO`);

--
-- Indices de la tabla `ROL`
--
ALTER TABLE `ROL`
  ADD PRIMARY KEY (`idROL`);

--
-- Indices de la tabla `TAREA`
--
ALTER TABLE `TAREA`
  ADD PRIMARY KEY (`idTAREA`),
  ADD KEY `fk_TAREA_PLANIFICACION1_idx` (`PLANIFICACION_idPLANIFICACION`),
  ADD KEY `fk_TAREA_USUARIO1_idx` (`USUARIO_idUSUARIO`),
  ADD KEY `fk_TAREA_TIPO_TAREA1_idx` (`TIPO_TAREA_idTIPO_TAREA`);

--
-- Indices de la tabla `TAREA_INSUMO`
--
ALTER TABLE `TAREA_INSUMO`
  ADD PRIMARY KEY (`INSUMO_idINSUMO`,`TAREA_idTAREA`),
  ADD KEY `fk_INSUMO_has_TAREA_TAREA1_idx` (`TAREA_idTAREA`),
  ADD KEY `fk_INSUMO_has_TAREA_INSUMO1_idx` (`INSUMO_idINSUMO`);

--
-- Indices de la tabla `TIPO_TAREA`
--
ALTER TABLE `TIPO_TAREA`
  ADD PRIMARY KEY (`idTIPO_TAREA`);

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
-- Indices de la tabla `VALIDACION`
--
ALTER TABLE `VALIDACION`
  ADD PRIMARY KEY (`idVALIDACION`),
  ADD KEY `fk_VALIDACION_PLANIFICACION1_idx` (`PLANIFICACION_idPLANIFICACION`),
  ADD KEY `fk_VALIDACION_USUARIO1_idx` (`USUARIO_idUSUARIO`),
  ADD KEY `fk_VALIDACION_MOTIVO_RECHAZO1_idx` (`MOTIVO_RECHAZO_idMOTIVO_RECHAZO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ACUARIO`
--
ALTER TABLE `ACUARIO`
  MODIFY `idACUARIO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `CONDICION_AMBIENTAL`
--
ALTER TABLE `CONDICION_AMBIENTAL`
  MODIFY `idCONDICION_AMBIENTAL` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ESPECIE`
--
ALTER TABLE `ESPECIE`
  MODIFY `idESPECIE` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `INSUMO`
--
ALTER TABLE `INSUMO`
  MODIFY `idINSUMO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `NOTIFICACION`
--
ALTER TABLE `NOTIFICACION`
  MODIFY `idNOTIFICACION` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `PLANIFICACION`
--
ALTER TABLE `PLANIFICACION`
  MODIFY `idPLANIFICACION` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ROL`
--
ALTER TABLE `ROL`
  MODIFY `idROL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `TAREA`
--
ALTER TABLE `TAREA`
  MODIFY `idTAREA` int(11) NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT de la tabla `VALIDACION`
--
ALTER TABLE `VALIDACION`
  MODIFY `idVALIDACION` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ACUARIO_USUARIO`
--
ALTER TABLE `ACUARIO_USUARIO`
  ADD CONSTRAINT `fk_ACUARIO_USUARIO_idACUARIO` FOREIGN KEY (`ACUARIO_idACUARIO`) REFERENCES `ACUARIO` (`idACUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ACUARIO_USUARIO_idUSUARIO` FOREIGN KEY (`USUARIO_idUSUARIO`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `CONDICION_AMBIENTAL`
--
ALTER TABLE `CONDICION_AMBIENTAL`
  ADD CONSTRAINT `fk_CONDAMBIENTAL_idACUARIO` FOREIGN KEY (`ACUARIO_idACUARIO`) REFERENCES `ACUARIO` (`idACUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CONDAMBIENTAL_idTAREA` FOREIGN KEY (`TAREA_idTAREA`) REFERENCES `TAREA` (`idTAREA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `EJEMPLAR`
--
ALTER TABLE `EJEMPLAR`
  ADD CONSTRAINT `fk_ESPECIE_idACUARIO` FOREIGN KEY (`ACUARIO_idACUARIO`) REFERENCES `ACUARIO` (`idACUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ESPECIE_idESPECIE` FOREIGN KEY (`ESPECIE_idESPECIE`) REFERENCES `ESPECIE` (`idESPECIE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `INSUMO`
--
ALTER TABLE `INSUMO`
  ADD CONSTRAINT `fk_INSUMO_idTIPO_TAREA` FOREIGN KEY (`TIPO_TAREA_idTIPO_TAREA`) REFERENCES `TIPO_TAREA` (`idTIPO_TAREA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `NOTIFICACION`
--
ALTER TABLE `NOTIFICACION`
  ADD CONSTRAINT `fk_NOTIFICACION_idORIGEN_NOTIFICACION` FOREIGN KEY (`ORIGEN_NOTIFICACION_idORIGEN_NOTIFICACION`) REFERENCES `ORIGEN_NOTIFICACION` (`idORIGEN_NOTIFICACION`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_NOTIFICACION_idTAREA` FOREIGN KEY (`TAREA_idTAREA`) REFERENCES `TAREA` (`idTAREA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `PLANIFICACION`
--
ALTER TABLE `PLANIFICACION`
  ADD CONSTRAINT `fk_PLANIFICACION_ACUARIO_USUARIO1` FOREIGN KEY (`ACUARIO_USUARIO_ACUARIO_idACUARIO`,`ACUARIO_USUARIO_USUARIO_idUSUARIO`) REFERENCES `ACUARIO_USUARIO` (`ACUARIO_idACUARIO`, `USUARIO_idUSUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PLANIFICACION_idESTADO_PLANIFICACION` FOREIGN KEY (`ESTADO_PLANIFICACION_idESTADO_PLANIFICACION`) REFERENCES `ESTADO_PLANIFICACION` (`idESTADO_PLANIFICACION`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `TAREA`
--
ALTER TABLE `TAREA`
  ADD CONSTRAINT `fk_TAREA_idPLANIFICACION` FOREIGN KEY (`PLANIFICACION_idPLANIFICACION`) REFERENCES `PLANIFICACION` (`idPLANIFICACION`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TAREA_idTIPO_TAREA` FOREIGN KEY (`TIPO_TAREA_idTIPO_TAREA`) REFERENCES `TIPO_TAREA` (`idTIPO_TAREA`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TAREA_idUSUARIO` FOREIGN KEY (`USUARIO_idUSUARIO`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `TAREA_INSUMO`
--
ALTER TABLE `TAREA_INSUMO`
  ADD CONSTRAINT `fk_TAREA_INSUMO_idINSUMO` FOREIGN KEY (`INSUMO_idINSUMO`) REFERENCES `INSUMO` (`idINSUMO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TAREA_INSUMO_idTAREA` FOREIGN KEY (`TAREA_idTAREA`) REFERENCES `TAREA` (`idTAREA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `VALIDACION`
--
ALTER TABLE `VALIDACION`
  ADD CONSTRAINT `fk_VALIDACION_idMOTIVO_RECHAZO` FOREIGN KEY (`MOTIVO_RECHAZO_idMOTIVO_RECHAZO`) REFERENCES `MOTIVO_RECHAZO` (`idMOTIVO_RECHAZO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_VALIDACION_idPLANIFICACION` FOREIGN KEY (`PLANIFICACION_idPLANIFICACION`) REFERENCES `PLANIFICACION` (`idPLANIFICACION`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_VALIDACION_idUSUARIO` FOREIGN KEY (`USUARIO_idUSUARIO`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
