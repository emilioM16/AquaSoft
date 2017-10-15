-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-10-2017 a las 00:32:43
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
CREATE DATABASE IF NOT EXISTS `AQUASOFT` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `AQUASOFT`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `comprobarTareas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `comprobarTareas` ()  BEGIN
	DECLARE fin INTEGER DEFAULT 0;
    DECLARE idTarea BIGINT(20);
    DECLARE tipoTarea VARCHAR(50);
    DECLARE descripcionTarea VARCHAR(250);
    DECLARE fechaHoraTarea DATETIME;
    DECLARE cont INTEGER DEFAULT 0;
    DECLARE tiempoTranscurrido TIME;
    
    DECLARE cursorTareas CURSOR FOR SELECT id, tipo, descripcion, fechaHoraInicio FROM aquasoft_db.tareas WHERE DATE(fechaHoraInicio) = CURDATE();
    
   DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin = 1;
    
    OPEN cursorTareas;
    
    comprobar: LOOP
    	
    	FETCH cursorTareas INTO idTarea,tipoTarea, descripcionTarea, fechaHoraTarea;
        
        IF fin = 1 THEN
        	LEAVE comprobar;
        END IF;
        
        
        SELECT COUNT(*) INTO cont FROM alertas WHERE idTarea = alertas.idTarea;
        
        IF CURRENT_TIME >= TIME(fechaHoraTarea) AND cont = 0 AND TIMEDIFF(DATE(fechaHoraTarea),CURRENT_TIME) >= '000500' THEN
        	
            INSERT INTO alertas(idTarea,tiempoDesdeInicio) VALUES (idTarea,'000500');
           
        END IF;
   	END LOOP comprobar;
    
CLOSE cursorTareas;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ACUARIO`
--

DROP TABLE IF EXISTS `ACUARIO`;
CREATE TABLE `ACUARIO` (
  `idAcuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `espacioDisponible` int(11) NOT NULL,
  `capacidadMaxima` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ACUARIO`
--

INSERT INTO `ACUARIO` (`idAcuario`, `nombre`, `descripcion`, `espacioDisponible`, `capacidadMaxima`, `activo`) VALUES
(1, 'A01', '', 100, 100, 0),
(2, 'A02', '', 100, 100, 1),
(3, 'A04', '', 100, 100, 1),
(4, 'A05', '', 200, 200, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ACUARIO_USUARIO`
--

DROP TABLE IF EXISTS `ACUARIO_USUARIO`;
CREATE TABLE `ACUARIO_USUARIO` (
  `acuario_idAcuario` int(11) NOT NULL,
  `usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ACUARIO_USUARIO`
--

INSERT INTO `ACUARIO_USUARIO` (`acuario_idAcuario`, `usuario_idUsuario`) VALUES
(2, 17),
(3, 19),
(3, 20),
(3, 21),
(2, 22),
(3, 22);

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
('especialista', 16, 1506560528),
('especialista', 17, 1506560533),
('especialista', 19, NULL),
('especialista', 20, NULL),
('especialista', 21, NULL),
('especialista', 22, NULL);

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
('/aquarium/create', 2, NULL, NULL, NULL, 1507087233, 1507087233),
('/aquarium/delete', 2, NULL, NULL, NULL, 1507087233, 1507087233),
('/aquarium/detail', 2, NULL, NULL, NULL, 1507087233, 1507087233),
('/aquarium/index', 2, NULL, NULL, NULL, 1507087232, 1507087232),
('/aquarium/update', 2, NULL, NULL, NULL, 1507087233, 1507087233),
('/aquarium/validation', 2, NULL, NULL, NULL, 1507087233, 1507087233),
('/aquarium/view', 2, NULL, NULL, NULL, 1507087233, 1507087233),
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
('/reportico/*', 2, NULL, NULL, NULL, 1507510668, 1507510668),
('/site/error', 2, NULL, NULL, NULL, 1506560372, 1506560372),
('/site/index', 2, NULL, NULL, NULL, 1506560373, 1506560373),
('/site/login', 2, NULL, NULL, NULL, 1506560373, 1506560373),
('/site/logout', 2, NULL, NULL, NULL, 1506560373, 1506560373),
('/specimen/index', 2, NULL, NULL, NULL, 1507778641, 1507778641),
('/user-aquarium/create', 2, NULL, NULL, NULL, 1507216030, 1507216030),
('/user-aquarium/delete', 2, NULL, NULL, NULL, 1507216031, 1507216031),
('/user-aquarium/index', 2, NULL, NULL, NULL, 1507216030, 1507216030),
('/user-aquarium/update', 2, NULL, NULL, NULL, 1507216031, 1507216031),
('/user-aquarium/view', 2, NULL, NULL, NULL, 1507216030, 1507216030),
('/user/*', 2, NULL, NULL, NULL, 1506560602, 1506560602),
('/user/activate', 2, NULL, NULL, NULL, 1507574226, 1507574226),
('/user/change-state', 2, NULL, NULL, NULL, 1507575046, 1507575046),
('/user/create', 2, NULL, NULL, NULL, 1506560370, 1506560370),
('/user/disable', 2, NULL, NULL, NULL, 1507574226, 1507574226),
('/user/index', 2, NULL, NULL, NULL, 1506560370, 1506560370),
('/user/status', 2, NULL, NULL, NULL, 1507521491, 1507521491),
('/user/update', 2, NULL, NULL, NULL, 1506560370, 1506560370),
('/user/validation', 2, NULL, NULL, NULL, 1507158217, 1507158217),
('/user/view', 2, NULL, NULL, NULL, 1506560370, 1506560370),
('administrador', 1, NULL, NULL, NULL, 1506560408, 1506560408),
('administrarTareas', 2, 'Permiso utilizado para los CRUD de tareas', NULL, NULL, 1507426684, 1507426684),
('bajaAcuario', 2, NULL, NULL, NULL, 1507481711, 1507481711),
('bajaEspecialista', 2, NULL, NULL, NULL, 1507483126, 1507483126),
('crearAcuario', 2, NULL, NULL, NULL, 1507480958, 1507481358),
('crearEspecialista', 2, NULL, NULL, NULL, 1507479399, 1507479399),
('encargado', 1, NULL, NULL, NULL, 1506560453, 1506560453),
('especialista', 1, NULL, NULL, NULL, 1506560482, 1506560482),
('modificarAcuario', 2, NULL, NULL, NULL, 1507481673, 1507481673),
('modificarEspecialista', 2, NULL, NULL, NULL, 1507483108, 1507483108),
('verEjemplares', 2, 'Permite ver la sección de ejemplares', NULL, NULL, 1507778939, 1507778939),
('verEspecialistas', 2, 'Permite visualizar el menú de especialistas', NULL, NULL, 1507479293, 1507480209),
('verEspecies', 2, 'Permitir el acceso a la sección de especies', NULL, NULL, 1507480274, 1507480274),
('verInsumos', 2, 'Permitir el acceso a la sección de insumos', NULL, NULL, 1507480525, 1507480525);

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
('crearAcuario', '/aquarium/create'),
('bajaAcuario', '/aquarium/delete'),
('especialista', '/aquarium/detail'),
('especialista', '/aquarium/index'),
('modificarAcuario', '/aquarium/update'),
('crearAcuario', '/aquarium/validation'),
('modificarAcuario', '/aquarium/validation'),
('especialista', '/aquarium/view'),
('administrador', '/debug/*'),
('encargado', '/debug/*'),
('especialista', '/debug/*'),
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
('administrador', '/reportico/*'),
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
('verEjemplares', '/specimen/index'),
('administrador', '/user-aquarium/create'),
('administrador', '/user-aquarium/delete'),
('administrador', '/user-aquarium/index'),
('administrador', '/user-aquarium/update'),
('administrador', '/user-aquarium/view'),
('encargado', '/user/change-state'),
('administrador', '/user/create'),
('crearEspecialista', '/user/create'),
('administrador', '/user/index'),
('verEspecialistas', '/user/index'),
('bajaEspecialista', '/user/status'),
('administrador', '/user/update'),
('modificarEspecialista', '/user/update'),
('administrador', '/user/validation'),
('crearEspecialista', '/user/validation'),
('modificarEspecialista', '/user/validation'),
('administrador', '/user/view'),
('verEspecialistas', '/user/view'),
('especialista', 'administrarTareas'),
('encargado', 'bajaAcuario'),
('encargado', 'bajaEspecialista'),
('encargado', 'crearAcuario'),
('encargado', 'crearEspecialista'),
('administrador', 'encargado'),
('administrador', 'especialista'),
('encargado', 'modificarAcuario'),
('encargado', 'modificarEspecialista'),
('especialista', 'verEjemplares'),
('encargado', 'verEspecialistas'),
('especialista', 'verEspecies'),
('encargado', 'verInsumos');

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
-- Estructura de tabla para la tabla `CONDICION_AMBIENTAL`
--

DROP TABLE IF EXISTS `CONDICION_AMBIENTAL`;
CREATE TABLE `CONDICION_AMBIENTAL` (
  `idCondicionAmbiental` int(11) NOT NULL,
  `ph` double NOT NULL,
  `temperatura` double NOT NULL,
  `salinidad` double NOT NULL,
  `lux` double NOT NULL,
  `CO2` double NOT NULL,
  `acuario_idAcuario` int(11) NOT NULL,
  `tarea_idTarea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `CONDICION_AMBIENTAL`
--

INSERT INTO `CONDICION_AMBIENTAL` (`idCondicionAmbiental`, `ph`, `temperatura`, `salinidad`, `lux`, `CO2`, `acuario_idAcuario`, `tarea_idTarea`) VALUES
(1, 11.2, 32, 35.6, 40, 20, 2, 3),
(2, 34, 40, 22, 67, 24, 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EJEMPLAR`
--

DROP TABLE IF EXISTS `EJEMPLAR`;
CREATE TABLE `EJEMPLAR` (
  `especie_idEspecie` int(11) NOT NULL,
  `acuario_idAcuario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `EJEMPLAR`
--

INSERT INTO `EJEMPLAR` (`especie_idEspecie`, `acuario_idAcuario`, `cantidad`) VALUES
(1, 2, 40),
(2, 2, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESPECIE`
--

DROP TABLE IF EXISTS `ESPECIE`;
CREATE TABLE `ESPECIE` (
  `idEspecie` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `minPH` double NOT NULL,
  `maxPH` double NOT NULL,
  `minTemp` double NOT NULL,
  `maxTemp` double NOT NULL,
  `minSalinidad` double NOT NULL,
  `maxSalinidad` double NOT NULL,
  `minLux` double NOT NULL,
  `maxLux` double NOT NULL,
  `minEspacio` int(11) NOT NULL,
  `minCO2` double NOT NULL,
  `maxCO2` double NOT NULL,
  `activo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ESPECIE`
--

INSERT INTO `ESPECIE` (`idEspecie`, `nombre`, `descripcion`, `minPH`, `maxPH`, `minTemp`, `maxTemp`, `minSalinidad`, `maxSalinidad`, `minLux`, `maxLux`, `minEspacio`, `minCO2`, `maxCO2`, `activo`) VALUES
(1, 'Payaso', NULL, 2, 5, 10, 20, 4, 5, 50, 100, 2, 19, 30, 1),
(2, 'Globo', NULL, 2, 5, 40, 45, 13, 20, 60, 70, 10, 1.6, 2.4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESTADO_PLANIFICACION`
--

DROP TABLE IF EXISTS `ESTADO_PLANIFICACION`;
CREATE TABLE `ESTADO_PLANIFICACION` (
  `idEstadoPlanificacion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ESTADO_PLANIFICACION`
--

INSERT INTO `ESTADO_PLANIFICACION` (`idEstadoPlanificacion`) VALUES
('Aprobado'),
('Rechazado'),
('SinVerificar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INSUMO`
--

DROP TABLE IF EXISTS `INSUMO`;
CREATE TABLE `INSUMO` (
  `idInsumo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `TIPO_TAREA_idTipoTarea` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INSUMO_TAREA`
--

DROP TABLE IF EXISTS `INSUMO_TAREA`;
CREATE TABLE `INSUMO_TAREA` (
  `INSUMO_idInsumo` int(11) NOT NULL,
  `TAREA_idTarea` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT '0'
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
-- Estructura de tabla para la tabla `MOTIVO_RECHAZO`
--

DROP TABLE IF EXISTS `MOTIVO_RECHAZO`;
CREATE TABLE `MOTIVO_RECHAZO` (
  `idMotivoRechazo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `MOTIVO_RECHAZO`
--

INSERT INTO `MOTIVO_RECHAZO` (`idMotivoRechazo`) VALUES
('Escasez de tareas'),
('Incorrecta distribución de tareas'),
('Incumplimiento de politicas'),
('Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `NOTIFICACION`
--

DROP TABLE IF EXISTS `NOTIFICACION`;
CREATE TABLE `NOTIFICACION` (
  `idNOTIFICACION` int(11) NOT NULL,
  `fechaHora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ORIGEN_NOTIFICACION_idOrigenNotificacion` varchar(45) NOT NULL,
  `TAREA_idTarea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ORIGEN_NOTIFICACION`
--

DROP TABLE IF EXISTS `ORIGEN_NOTIFICACION`;
CREATE TABLE `ORIGEN_NOTIFICACION` (
  `idOrigenNotificacion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ORIGEN_NOTIFICACION`
--

INSERT INTO `ORIGEN_NOTIFICACION` (`idOrigenNotificacion`) VALUES
('Hábitat riesgoso'),
('Tarea no realizada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PLANIFICACION`
--

DROP TABLE IF EXISTS `PLANIFICACION`;
CREATE TABLE `PLANIFICACION` (
  `idPlanificacion` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `anioMes` date NOT NULL,
  `fechaHoraCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` tinyint(1) DEFAULT '1',
  `ACUARIO_USUARIO_acuario_idAcuario` int(11) NOT NULL,
  `ACUARIO_USUARIO_usuario_idUsuario` int(11) NOT NULL,
  `ESTADO_PLANIFICACION_idEstadoPlanificacion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `PLANIFICACION`
--

INSERT INTO `PLANIFICACION` (`idPlanificacion`, `titulo`, `anioMes`, `fechaHoraCreacion`, `activo`, `ACUARIO_USUARIO_acuario_idAcuario`, `ACUARIO_USUARIO_usuario_idUsuario`, `ESTADO_PLANIFICACION_idEstadoPlanificacion`) VALUES
(1, 'Planificación especial', '2017-10-18', '2017-10-08 01:12:29', 1, 2, 20, 'Aprobado'),
(2, '', '2017-10-17', '2017-10-08 17:37:04', 1, 3, 19, 'Aprobado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ROL`
--

DROP TABLE IF EXISTS `ROL`;
CREATE TABLE `ROL` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(45) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ROL`
--

INSERT INTO `ROL` (`idRol`, `nombreRol`, `descripcion`) VALUES
(1, 'Especialista', 'Perfil del personal responsable del mantenimiento de un grupo de acuarios'),
(2, 'Encargado', 'Perfil del personal responsable de la organización del acuarium');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TAREA`
--

DROP TABLE IF EXISTS `TAREA`;
CREATE TABLE `TAREA` (
  `idTarea` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `fechaHoraInicio` datetime NOT NULL,
  `fechaHoraFin` datetime NOT NULL,
  `fechaHoraRealizacion` datetime DEFAULT NULL,
  `PLANIFICACION_idPlanificacion` int(11) DEFAULT NULL COMMENT 'Si este campo está vacío significa que la tareas a sido creada fuera de la planificacion mensual.',
  `USUARIO_idUsuario` int(11) DEFAULT NULL,
  `ACUARIO_idAcuario` int(11) DEFAULT NULL COMMENT 'Este campo contendrá el acuario para el cual se ha realizado la tarea sólo en los casos en que la tarea sea un imprevisto (no tendrá un id de planificacion) ya que de lo contrario se sabrá el acuario a través de la planificacion\n',
  `TIPO_TAREA_idTipoTarea` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TAREA`
--

INSERT INTO `TAREA` (`idTarea`, `titulo`, `descripcion`, `fechaHoraInicio`, `fechaHoraFin`, `fechaHoraRealizacion`, `PLANIFICACION_idPlanificacion`, `USUARIO_idUsuario`, `ACUARIO_idAcuario`, `TIPO_TAREA_idTipoTarea`) VALUES
(1, 'Mantenimiento ', NULL, '2017-10-08 10:00:00', '2017-10-08 11:00:00', '2017-10-08 10:21:00', 1, 20, 2, 'Reparación'),
(2, 'Limpiar tanque', NULL, '2017-10-08 09:00:00', '2017-10-08 12:00:00', '2017-10-08 13:00:00', 1, 20, 2, 'Limpieza'),
(3, 'Control', NULL, '2017-10-10 15:00:00', '2017-10-10 15:30:00', NULL, 1, 1, 2, 'Controlar acuario'),
(4, 'Control ', NULL, '2017-10-10 13:00:00', '2017-10-10 15:00:00', NULL, 1, 1, 2, 'Controlar acuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TAREA_EJEMPLAR`
--

DROP TABLE IF EXISTS `TAREA_EJEMPLAR`;
CREATE TABLE `TAREA_EJEMPLAR` (
  `TAREA_idTarea` int(11) NOT NULL,
  `EJEMPLAR_especie_idEspecie` int(11) NOT NULL,
  `EJEMPLAR_acuario_idAcuario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TIPO_TAREA`
--

DROP TABLE IF EXISTS `TIPO_TAREA`;
CREATE TABLE `TIPO_TAREA` (
  `idTipoTarea` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TIPO_TAREA`
--

INSERT INTO `TIPO_TAREA` (`idTipoTarea`) VALUES
('Alimentación'),
('Controlar acuario'),
('Incorporar ejemplares'),
('Limpieza'),
('Reparación'),
('Transferir ejemplares');

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
-- Estructura de tabla para la tabla `USUARIO`
--

DROP TABLE IF EXISTS `USUARIO`;
CREATE TABLE `USUARIO` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `nombreUsuario` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `activo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `USUARIO`
--

INSERT INTO `USUARIO` (`idUsuario`, `nombre`, `apellido`, `nombreUsuario`, `email`, `contrasenia`, `activo`) VALUES
(1, 'Emilio', 'Melo', 'emelo', 'emelo@gmail.com', '$2y$13$uezXaKAuIOJmRSOx2swB2.pcAnd6OId30QChxdNRdYGBIzKhRBIuG', 1),
(2, 'Romina', 'Bertini', 'rbertini', 'romina@gmail.com', '$2y$13$u5cBGilAW2s/sVNIF5c4i.OZE556sx1mqPCOM2hjeR1wJ76ujvV3y', 1),
(16, 'Facundo', 'Reyna', 'freyna', 'facundo@gmail.com', '$2y$13$GMa4SuOnh8NxUT4UmUsaAOKM4cLibGyOfWKCLw8Akh32TxhSj1sku', 1),
(17, 'Lía', 'Moreno', 'lmoreno', 'lia@gmail.com', '$2y$13$3aPnTqFnsbSkQv5IBLXYdeTJyQDANwupouovndDWVGLf4LNVjZ/LW', 1),
(19, 'Juan', 'Perez', 'jperez', 'jose@gmail.com', '$2y$13$C4UFjDiUbStLBTsXabBPf.3ph3WWTtmc.IrjdUcTzzw.lFC9PfkLO', 1),
(20, 'Pepe', 'Pepe', 'pepepe', 'pepe@gmail.com', '$2y$13$gfrKWdTCQRXFlOsg5hXlKuyW6IrM5DM051xmFFXEi8hVYkySxfhQ6', 1),
(21, 'Jose', 'Jose', 'jjose', 'jjose@gmail.com', '$2y$13$FeEAncLmU15ZHAOXDNGReuwToJoI4WEIAJ3CqZMmx1BNHe2/gkwK.', 1),
(22, 'Pedro', 'Sanchez', 'psanchez', 'psanchez@gmail.com', '$2y$13$5bP2SXI6yKK2wP1UJTXkIOoJxuhxho7BbbTCH9Rxz1DWFeFAvXvg2', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `VALIDACION`
--

DROP TABLE IF EXISTS `VALIDACION`;
CREATE TABLE `VALIDACION` (
  `idVALIDACION` int(11) NOT NULL,
  `FECHAHORA` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OBSERVACION` varchar(200) DEFAULT NULL,
  `MOTIVO_RECHAZO_idMotivoRechazo` varchar(45) NOT NULL,
  `PLANIFICACION_idPlanificacion` int(11) NOT NULL,
  `USUARIO_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ACUARIO`
--
ALTER TABLE `ACUARIO`
  ADD PRIMARY KEY (`idAcuario`),
  ADD UNIQUE KEY `NOMBRE_UNIQUE` (`nombre`);

--
-- Indices de la tabla `ACUARIO_USUARIO`
--
ALTER TABLE `ACUARIO_USUARIO`
  ADD PRIMARY KEY (`acuario_idAcuario`,`usuario_idUsuario`),
  ADD KEY `fk_idUSUARIO_idx` (`usuario_idUsuario`),
  ADD KEY `fk_idACUARIO_idx` (`acuario_idAcuario`);

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
  ADD PRIMARY KEY (`idCondicionAmbiental`),
  ADD KEY `fk_CONDICION_AMBIENTAL_ACUARIO1_idx` (`acuario_idAcuario`),
  ADD KEY `fk_CONDICION_AMBIENTAL_TAREA1_idx` (`tarea_idTarea`);

--
-- Indices de la tabla `EJEMPLAR`
--
ALTER TABLE `EJEMPLAR`
  ADD PRIMARY KEY (`especie_idEspecie`,`acuario_idAcuario`),
  ADD KEY `fk_idACUARIO_idx` (`acuario_idAcuario`),
  ADD KEY `fk_idESPECIE_idx` (`especie_idEspecie`);

--
-- Indices de la tabla `ESPECIE`
--
ALTER TABLE `ESPECIE`
  ADD PRIMARY KEY (`idEspecie`);

--
-- Indices de la tabla `ESTADO_PLANIFICACION`
--
ALTER TABLE `ESTADO_PLANIFICACION`
  ADD PRIMARY KEY (`idEstadoPlanificacion`);

--
-- Indices de la tabla `INSUMO`
--
ALTER TABLE `INSUMO`
  ADD PRIMARY KEY (`idInsumo`),
  ADD KEY `fk_INSUMO_TIPO_TAREA1_idx` (`TIPO_TAREA_idTipoTarea`);

--
-- Indices de la tabla `INSUMO_TAREA`
--
ALTER TABLE `INSUMO_TAREA`
  ADD PRIMARY KEY (`INSUMO_idInsumo`,`TAREA_idTarea`),
  ADD KEY `fk_INSUMO_has_TAREA_TAREA1_idx` (`TAREA_idTarea`),
  ADD KEY `fk_INSUMO_has_TAREA_INSUMO1_idx` (`INSUMO_idInsumo`);

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
  ADD PRIMARY KEY (`idMotivoRechazo`);

--
-- Indices de la tabla `NOTIFICACION`
--
ALTER TABLE `NOTIFICACION`
  ADD PRIMARY KEY (`idNOTIFICACION`),
  ADD KEY `fk_NOTIFICACION_ORIGEN_NOTIFICACION1_idx` (`ORIGEN_NOTIFICACION_idOrigenNotificacion`),
  ADD KEY `fk_NOTIFICACION_TAREA1_idx` (`TAREA_idTarea`);

--
-- Indices de la tabla `ORIGEN_NOTIFICACION`
--
ALTER TABLE `ORIGEN_NOTIFICACION`
  ADD PRIMARY KEY (`idOrigenNotificacion`);

--
-- Indices de la tabla `PLANIFICACION`
--
ALTER TABLE `PLANIFICACION`
  ADD PRIMARY KEY (`idPlanificacion`),
  ADD KEY `fk_PLANIFICACION_ACUARIO_USUARIO1_idx` (`ACUARIO_USUARIO_acuario_idAcuario`,`ACUARIO_USUARIO_usuario_idUsuario`),
  ADD KEY `fk_PLANIFICACION_ESTADO_PLANIFICACION1_idx` (`ESTADO_PLANIFICACION_idEstadoPlanificacion`),
  ADD KEY `fk_Usuario` (`ACUARIO_USUARIO_usuario_idUsuario`);

--
-- Indices de la tabla `ROL`
--
ALTER TABLE `ROL`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `TAREA`
--
ALTER TABLE `TAREA`
  ADD PRIMARY KEY (`idTarea`),
  ADD KEY `fk_TAREA_PLANIFICACION1_idx` (`PLANIFICACION_idPlanificacion`),
  ADD KEY `fk_TAREA_USUARIO1_idx` (`USUARIO_idUsuario`),
  ADD KEY `fk_TAREA_ACUARIO1_idx` (`ACUARIO_idAcuario`),
  ADD KEY `fk_TAREA_TIPO_TAREA1_idx` (`TIPO_TAREA_idTipoTarea`);

--
-- Indices de la tabla `TAREA_EJEMPLAR`
--
ALTER TABLE `TAREA_EJEMPLAR`
  ADD PRIMARY KEY (`TAREA_idTarea`,`EJEMPLAR_especie_idEspecie`,`EJEMPLAR_acuario_idAcuario`),
  ADD KEY `fk_TAREA_has_EJEMPLAR_EJEMPLAR1_idx` (`EJEMPLAR_especie_idEspecie`,`EJEMPLAR_acuario_idAcuario`),
  ADD KEY `fk_TAREA_has_EJEMPLAR_TAREA1_idx` (`TAREA_idTarea`);

--
-- Indices de la tabla `TIPO_TAREA`
--
ALTER TABLE `TIPO_TAREA`
  ADD PRIMARY KEY (`idTipoTarea`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `VALIDACION`
--
ALTER TABLE `VALIDACION`
  ADD PRIMARY KEY (`idVALIDACION`),
  ADD KEY `fk_VALIDACION_MOTIVO_RECHAZO1_idx` (`MOTIVO_RECHAZO_idMotivoRechazo`),
  ADD KEY `fk_VALIDACION_PLANIFICACION1_idx` (`PLANIFICACION_idPlanificacion`),
  ADD KEY `fk_VALIDACION_USUARIO1_idx` (`USUARIO_idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ACUARIO`
--
ALTER TABLE `ACUARIO`
  MODIFY `idAcuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `CONDICION_AMBIENTAL`
--
ALTER TABLE `CONDICION_AMBIENTAL`
  MODIFY `idCondicionAmbiental` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `ESPECIE`
--
ALTER TABLE `ESPECIE`
  MODIFY `idEspecie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `INSUMO`
--
ALTER TABLE `INSUMO`
  MODIFY `idInsumo` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `idPlanificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `ROL`
--
ALTER TABLE `ROL`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `TAREA`
--
ALTER TABLE `TAREA`
  MODIFY `idTarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
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
  ADD CONSTRAINT `fk_ACUARIO_USUARIO_idACUARIO` FOREIGN KEY (`acuario_idAcuario`) REFERENCES `ACUARIO` (`idAcuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ACUARIO_USUARIO_idUSUARIO` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `USUARIO` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_asignment_usuarios` FOREIGN KEY (`user_id`) REFERENCES `USUARIO` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_CONDAMBIENTAL_idACUARIO` FOREIGN KEY (`acuario_idAcuario`) REFERENCES `ACUARIO` (`idAcuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CONDAMBIENTAL_idTAREA` FOREIGN KEY (`tarea_idTarea`) REFERENCES `TAREA` (`idTarea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `EJEMPLAR`
--
ALTER TABLE `EJEMPLAR`
  ADD CONSTRAINT `fk_ESPECIE_idACUARIO` FOREIGN KEY (`acuario_idAcuario`) REFERENCES `ACUARIO` (`idAcuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ESPECIE_idESPECIE` FOREIGN KEY (`especie_idEspecie`) REFERENCES `ESPECIE` (`idEspecie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `INSUMO`
--
ALTER TABLE `INSUMO`
  ADD CONSTRAINT `fk_INSUMO_TIPO_TAREA1` FOREIGN KEY (`TIPO_TAREA_idTipoTarea`) REFERENCES `TIPO_TAREA` (`idTipoTarea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `INSUMO_TAREA`
--
ALTER TABLE `INSUMO_TAREA`
  ADD CONSTRAINT `fk_INSUMO_has_TAREA_INSUMO1` FOREIGN KEY (`INSUMO_idInsumo`) REFERENCES `INSUMO` (`idInsumo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_INSUMO_has_TAREA_TAREA1` FOREIGN KEY (`TAREA_idTarea`) REFERENCES `TAREA` (`idTarea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `NOTIFICACION`
--
ALTER TABLE `NOTIFICACION`
  ADD CONSTRAINT `fk_NOTIFICACION_ORIGEN_NOTIFICACION1` FOREIGN KEY (`ORIGEN_NOTIFICACION_idOrigenNotificacion`) REFERENCES `ORIGEN_NOTIFICACION` (`idOrigenNotificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_NOTIFICACION_TAREA1` FOREIGN KEY (`TAREA_idTarea`) REFERENCES `TAREA` (`idTarea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `PLANIFICACION`
--
ALTER TABLE `PLANIFICACION`
  ADD CONSTRAINT `fk_Acuario` FOREIGN KEY (`ACUARIO_USUARIO_acuario_idAcuario`) REFERENCES `ACUARIO` (`idAcuario`),
  ADD CONSTRAINT `fk_Usuario` FOREIGN KEY (`ACUARIO_USUARIO_usuario_idUsuario`) REFERENCES `USUARIO` (`idUsuario`);

--
-- Filtros para la tabla `TAREA`
--
ALTER TABLE `TAREA`
  ADD CONSTRAINT `fk_TAREA_ACUARIO1` FOREIGN KEY (`ACUARIO_idAcuario`) REFERENCES `ACUARIO` (`idAcuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TAREA_TIPO_TAREA1` FOREIGN KEY (`TIPO_TAREA_idTipoTarea`) REFERENCES `TIPO_TAREA` (`idTipoTarea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TAREA_idPLANIFICACION` FOREIGN KEY (`PLANIFICACION_idPlanificacion`) REFERENCES `PLANIFICACION` (`idPlanificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TAREA_idUSUARIO` FOREIGN KEY (`USUARIO_idUsuario`) REFERENCES `USUARIO` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `TAREA_EJEMPLAR`
--
ALTER TABLE `TAREA_EJEMPLAR`
  ADD CONSTRAINT `fk_TAREA_has_EJEMPLAR_EJEMPLAR1` FOREIGN KEY (`EJEMPLAR_especie_idEspecie`,`EJEMPLAR_acuario_idAcuario`) REFERENCES `EJEMPLAR` (`especie_idEspecie`, `acuario_idAcuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TAREA_has_EJEMPLAR_TAREA1` FOREIGN KEY (`TAREA_idTarea`) REFERENCES `TAREA` (`idTarea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `VALIDACION`
--
ALTER TABLE `VALIDACION`
  ADD CONSTRAINT `fk_VALIDACION_MOTIVO_RECHAZO1` FOREIGN KEY (`MOTIVO_RECHAZO_idMotivoRechazo`) REFERENCES `MOTIVO_RECHAZO` (`idMotivoRechazo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_VALIDACION_PLANIFICACION1` FOREIGN KEY (`PLANIFICACION_idPlanificacion`) REFERENCES `PLANIFICACION` (`idPlanificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_VALIDACION_USUARIO1` FOREIGN KEY (`USUARIO_idUsuario`) REFERENCES `USUARIO` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
