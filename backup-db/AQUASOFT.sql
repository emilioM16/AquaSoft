-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-10-2017 a las 16:27:17
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
(1, 'A01', '', 0, 100, 1),
(2, 'A02', '', 90, 100, 1),
(3, 'A04', '', 0, 100, 1),
(4, 'A05', '', 200, 200, 0),
(5, 'A10', '', 100, 100, 1);

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
(3, 17),
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
('/planning/*', 2, NULL, NULL, NULL, 1508202666, 1508202666),
('/reportico/*', 2, NULL, NULL, NULL, 1507510668, 1507510668),
('/site/error', 2, NULL, NULL, NULL, 1506560372, 1506560372),
('/site/index', 2, NULL, NULL, NULL, 1506560373, 1506560373),
('/site/login', 2, NULL, NULL, NULL, 1506560373, 1506560373),
('/site/logout', 2, NULL, NULL, NULL, 1506560373, 1506560373),
('/specimen/index', 2, NULL, NULL, NULL, 1507778641, 1507778641),
('/task-specimen/add-specimens', 2, NULL, NULL, NULL, 1508170849, 1508170849),
('/task-specimen/get-aquariums', 2, NULL, NULL, NULL, 1508027696, 1508027696),
('/task-specimen/specimens-tasks', 2, NULL, NULL, NULL, 1507914487, 1507914487),
('/task/create', 2, NULL, NULL, NULL, 1507833798, 1507833798),
('/task/delete', 2, NULL, NULL, NULL, 1507833798, 1507833798),
('/task/get-aquariums', 2, NULL, NULL, NULL, 1507850218, 1507850218),
('/task/index', 2, NULL, NULL, NULL, 1507833798, 1507833798),
('/task/specimens-tasks', 2, NULL, NULL, NULL, 1507837645, 1507837645),
('/task/update', 2, NULL, NULL, NULL, 1507833798, 1507833798),
('/task/view', 2, NULL, NULL, NULL, 1507833798, 1507833798),
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
('administrador', '/planning/*'),
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
('administrador', '/task-specimen/add-specimens'),
('administrador', '/task-specimen/get-aquariums'),
('administrador', '/task-specimen/specimens-tasks'),
('administrador', '/task/create'),
('administrador', '/task/delete'),
('administrador', '/task/get-aquariums'),
('administrador', '/task/index'),
('administrador', '/task/specimens-tasks'),
('administrador', '/task/update'),
('administrador', '/task/view'),
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
(2, 3, 41, 15, 67, 2, 2, 4),
(3, 3, 41, 14, 69, 1.7, 3, 5),
(4, 4, 44, 15, 65, 2, 1, 6);

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
(2, 2, 35),
(2, 3, 9);

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
(2, 'Globo', NULL, 2, 5, 40, 45, 13, 20, 60, 70, 10, 1.6, 2.4, 1),
(3, 'Carpín dorado', 'El carpín dorado, carpa dorada o mejor conocido como pez dorado es una especie de pez de agua dulce de la familia Cyprinidae.', 4, 7, 10, 15, 4, 8, 57, 67, 4, 1, 2, 1),
(4, 'Pez beta', 'El luchador de Siam también conocido como pez beta, es una especie de pez de agua dulce de la familia de los laberíntidos, aunque antes fue clasificado erróneamente entre los Anabantidae.', 1, 3, 30, 35, 2, 5, 10, 29, 15, 11, 13, 1),
(5, 'Guppy', 'El guppy, lebistes o pez millón es un pez ovovivíparo de agua dulce procedente de Sudamérica que habita en zonas de corriente baja de ríos, lagos y charcas.', 7, 8.5, 17, 28, 2, 5, 40, 60, 3, 3, 5.5, 1);

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
(2, '', '2017-10-17', '2017-10-08 17:37:04', 1, 3, 19, 'Aprobado'),
(3, 'Planificación especial A01', '2017-11-08', '2017-10-15 19:56:59', 1, 1, 19, 'no autorizada'),
(4, 'ease', '2017-10-19', '2017-10-16 22:20:50', 1, 1, 21, 'SinVerificar'),
(5, 'ease', '2017-10-19', '2017-10-16 22:20:55', 1, 1, 21, 'SinVerificar'),
(6, 'ease', '2017-10-19', '2017-10-16 22:21:44', 1, 1, 21, 'SinVerificar'),
(7, 'ease', '2017-10-19', '2017-10-16 22:22:13', 1, 1, 21, 'SinVerificar'),
(8, 'ease', '2017-10-19', '2017-10-16 22:25:09', 1, 1, 21, 'SinVerificar'),
(9, 'ease', '2017-10-19', '2017-10-16 22:27:15', 1, 1, 21, 'SinVerificar'),
(10, 'ease', '2017-10-19', '2017-10-16 22:54:28', 1, 1, 21, 'SinVerificar'),
(11, 'ease', '2017-10-19', '2017-10-16 22:55:11', 1, 1, 21, 'SinVerificar'),
(12, 'ease', '2017-10-19', '2017-10-16 22:55:26', 1, 1, 21, 'SinVerificar'),
(13, 'ease', '2017-10-19', '2017-10-16 22:55:55', 1, 1, 21, 'SinVerificar'),
(14, 'ease', '2017-10-19', '2017-10-16 23:00:09', 1, 1, 21, 'SinVerificar'),
(15, 'ease', '2017-10-19', '2017-10-16 23:00:50', 1, 1, 21, 'SinVerificar'),
(16, 'ease', '2017-10-19', '2017-10-16 23:01:17', 1, 1, 21, 'SinVerificar'),
(17, 'ease', '2017-10-19', '2017-10-16 23:02:02', 1, 1, 21, 'SinVerificar'),
(18, 'ease', '2017-10-19', '2017-10-16 23:02:29', 1, 1, 21, 'SinVerificar'),
(19, 'ease', '2017-10-19', '2017-10-16 23:02:50', 1, 1, 21, 'SinVerificar'),
(20, 'ease', '2017-10-19', '2017-10-16 23:06:51', 1, 1, 21, 'SinVerificar'),
(21, 'ease', '2017-10-19', '2017-10-16 23:08:01', 1, 1, 21, 'SinVerificar'),
(22, 'ease', '2017-10-19', '2017-10-16 23:08:51', 1, 1, 21, 'SinVerificar'),
(23, 'ease', '2017-10-19', '2017-10-16 23:10:22', 1, 1, 21, 'SinVerificar'),
(24, 'ease', '2017-10-19', '2017-10-16 23:11:16', 1, 1, 21, 'SinVerificar'),
(25, 'ease', '2017-10-19', '2017-10-16 23:12:16', 1, 1, 21, 'SinVerificar'),
(26, 'ease', '2017-10-19', '2017-10-16 23:12:30', 1, 1, 21, 'SinVerificar'),
(27, 'ease', '2017-10-19', '2017-10-16 23:14:14', 1, 1, 21, 'SinVerificar'),
(28, 'ease', '2017-10-19', '2017-10-16 23:16:21', 1, 1, 21, 'SinVerificar'),
(29, 'ease', '2017-10-19', '2017-10-16 23:16:54', 1, 1, 21, 'SinVerificar'),
(30, 'ease', '2017-10-19', '2017-10-16 23:18:15', 1, 1, 21, 'SinVerificar'),
(31, 'asd', '2017-10-03', '2017-10-16 23:26:32', 1, 4, 21, 'SinVerificar'),
(32, 'asd', '2017-10-03', '2017-10-16 23:27:56', 1, 4, 21, 'SinVerificar'),
(33, 'asd', '2017-10-03', '2017-10-16 23:28:08', 1, 4, 21, 'SinVerificar'),
(34, 'asd', '2017-10-03', '2017-10-16 23:28:21', 1, 4, 21, 'SinVerificar'),
(35, 'asd', '2017-10-03', '2017-10-16 23:28:43', 1, 4, 21, 'SinVerificar'),
(36, 'asd', '2017-10-03', '2017-10-16 23:29:56', 1, 4, 21, 'SinVerificar'),
(37, 'asd', '2017-10-03', '2017-10-16 23:31:36', 1, 4, 21, 'SinVerificar'),
(38, 'asd', '2017-10-03', '2017-10-16 23:31:49', 1, 4, 21, 'SinVerificar'),
(39, 'asd', '2017-10-03', '2017-10-16 23:32:01', 1, 4, 21, 'SinVerificar'),
(40, 'asdas', '2017-12-19', '2017-10-16 23:32:18', 1, 1, 21, 'SinVerificar'),
(41, 'asdas', '2017-12-19', '2017-10-16 23:32:27', 1, 1, 21, 'SinVerificar'),
(42, 'sda', '2017-09-18', '2017-10-16 23:32:40', 1, 2, 21, 'SinVerificar'),
(43, 'sda', '2017-09-18', '2017-10-16 23:34:36', 1, 2, 21, 'SinVerificar'),
(44, 'sda', '2017-09-18', '2017-10-16 23:35:12', 1, 2, 21, 'SinVerificar'),
(45, 'sda', '2017-09-18', '2017-10-16 23:35:45', 1, 2, 21, 'SinVerificar'),
(46, 'sda', '2017-09-18', '2017-10-16 23:36:01', 1, 2, 21, 'SinVerificar'),
(47, 'sda', '2017-09-18', '2017-10-16 23:36:05', 1, 2, 21, 'SinVerificar'),
(48, 'sda', '2017-09-18', '2017-10-16 23:36:12', 1, 2, 21, 'SinVerificar');

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
(4, 'Control ', NULL, '2017-10-10 13:00:00', '2017-10-10 15:00:00', NULL, 1, 1, 2, 'Controlar acuario'),
(5, 'Control', NULL, '2017-10-15 07:37:00', '2017-10-15 10:00:00', '2017-10-15 09:00:00', 2, 19, 3, 'Controlar acuario'),
(6, 'Control A01', NULL, '2017-10-16 09:00:00', '2017-10-16 11:00:00', '2017-10-16 09:05:00', 3, 19, 1, 'Controlar acuario'),
(7, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 17:11:25', '2017-10-17 17:11:25', '2017-10-17 17:11:25', NULL, 1, 2, 'Controlar acuario'),
(8, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 17:11:42', '2017-10-17 17:11:42', '2017-10-17 17:11:42', NULL, 1, 2, 'Controlar acuario'),
(9, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 14:12:21', '2017-10-17 17:12:21', '2017-10-17 17:12:21', NULL, 1, 2, 'Controlar acuario'),
(10, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 15:06:28', '2017-10-17 15:06:28', '2017-10-17 15:06:28', NULL, 1, 2, 'Controlar acuario'),
(11, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 15:06:42', '2017-10-17 15:06:42', '2017-10-17 15:06:42', NULL, 1, 2, 'Controlar acuario'),
(12, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 15:07:56', '2017-10-17 15:07:56', '2017-10-17 15:07:56', NULL, 1, 3, 'Controlar acuario'),
(13, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 15:08:33', '2017-10-17 15:08:33', '2017-10-17 15:08:33', NULL, 1, 1, 'Controlar acuario'),
(14, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 15:08:33', '2017-10-17 15:08:33', '2017-10-17 15:08:33', NULL, 1, 3, 'Controlar acuario'),
(15, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 15:09:27', '2017-10-17 15:09:27', '2017-10-17 15:09:27', NULL, 1, 1, 'Controlar acuario'),
(16, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 15:09:36', '2017-10-17 15:09:36', '2017-10-17 15:09:36', NULL, 1, 1, 'Controlar acuario'),
(17, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 15:09:36', '2017-10-17 15:09:36', '2017-10-17 15:09:36', NULL, 1, 3, 'Controlar acuario'),
(18, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 15:18:32', '2017-10-17 15:18:32', '2017-10-17 15:18:32', NULL, 1, 2, 'Controlar acuario'),
(22, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 20:01:05', '2017-10-17 20:01:05', '2017-10-17 20:01:05', NULL, 1, 1, 'Incorporar ejemplares'),
(23, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 22:21:31', '2017-10-17 22:21:31', '2017-10-17 22:21:31', NULL, 1, 2, 'Incorporar ejemplares'),
(25, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 22:33:56', '2017-10-17 22:33:56', '2017-10-17 22:33:56', NULL, 1, 1, 'Incorporar ejemplares'),
(26, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 22:33:56', '2017-10-17 22:33:56', '2017-10-17 22:33:56', NULL, 1, 3, 'Incorporar ejemplares'),
(27, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 22:35:09', '2017-10-17 22:35:09', '2017-10-17 22:35:09', NULL, 1, 1, 'Incorporar ejemplares'),
(28, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 22:35:09', '2017-10-17 22:35:09', '2017-10-17 22:35:09', NULL, 1, 3, 'Incorporar ejemplares'),
(29, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 22:35:39', '2017-10-17 22:35:39', '2017-10-17 22:35:39', NULL, 1, 1, 'Incorporar ejemplares'),
(30, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 22:35:39', '2017-10-17 22:35:39', '2017-10-17 22:35:39', NULL, 1, 3, 'Incorporar ejemplares'),
(31, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 22:37:31', '2017-10-17 22:37:31', '2017-10-17 22:37:31', NULL, 1, 2, 'Incorporar ejemplares'),
(32, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 22:38:13', '2017-10-17 22:38:13', '2017-10-17 22:38:13', NULL, 1, 2, 'Incorporar ejemplares'),
(33, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 22:44:19', '2017-10-17 22:44:19', '2017-10-17 22:44:19', NULL, 1, 1, 'Incorporar ejemplares'),
(34, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 22:44:19', '2017-10-17 22:44:19', '2017-10-17 22:44:19', NULL, 1, 3, 'Incorporar ejemplares'),
(35, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 22:45:07', '2017-10-17 22:45:07', '2017-10-17 22:45:07', NULL, 1, 2, 'Incorporar ejemplares'),
(38, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 23:56:14', '2017-10-17 23:56:14', '2017-10-17 23:56:14', NULL, 1, 2, 'Incorporar ejemplares'),
(41, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-17 23:59:49', '2017-10-17 23:59:49', '2017-10-17 23:59:49', NULL, 1, 2, 'Incorporar ejemplares'),
(42, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 00:00:48', '2017-10-18 00:00:48', '2017-10-18 00:00:48', NULL, 1, 2, 'Incorporar ejemplares'),
(43, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 00:01:05', '2017-10-18 00:01:05', '2017-10-18 00:01:05', NULL, 1, 2, 'Incorporar ejemplares'),
(44, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 00:02:15', '2017-10-18 00:02:15', '2017-10-18 00:02:15', NULL, 1, 2, 'Incorporar ejemplares'),
(45, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 00:38:04', '2017-10-18 00:38:04', '2017-10-18 00:38:04', NULL, 1, 2, 'Incorporar ejemplares'),
(46, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 02:18:19', '2017-10-18 02:18:19', '2017-10-18 02:18:19', NULL, 1, 2, 'Incorporar ejemplares'),
(47, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 02:23:41', '2017-10-18 02:23:41', '2017-10-18 02:23:41', NULL, 1, 2, 'Incorporar ejemplares'),
(48, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 02:24:19', '2017-10-18 02:24:19', '2017-10-18 02:24:19', NULL, 1, 2, 'Incorporar ejemplares'),
(49, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 02:24:41', '2017-10-18 02:24:41', '2017-10-18 02:24:41', NULL, 1, 2, 'Incorporar ejemplares'),
(50, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 02:25:07', '2017-10-18 02:25:07', '2017-10-18 02:25:07', NULL, 1, 2, 'Incorporar ejemplares'),
(51, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 02:27:20', '2017-10-18 02:27:20', '2017-10-18 02:27:20', NULL, 1, 2, 'Incorporar ejemplares'),
(52, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 02:27:27', '2017-10-18 02:27:27', '2017-10-18 02:27:27', NULL, 1, 2, 'Incorporar ejemplares'),
(53, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 02:28:24', '2017-10-18 02:28:24', '2017-10-18 02:28:24', NULL, 1, 2, 'Incorporar ejemplares'),
(54, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 02:28:27', '2017-10-18 02:28:27', '2017-10-18 02:28:27', NULL, 1, 2, 'Incorporar ejemplares'),
(55, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 02:28:46', '2017-10-18 02:28:46', '2017-10-18 02:28:46', NULL, 1, 2, 'Incorporar ejemplares'),
(59, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 02:29:43', '2017-10-18 02:29:43', '2017-10-18 02:29:43', NULL, 1, 2, 'Incorporar ejemplares'),
(62, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 02:33:19', '2017-10-18 02:33:19', '2017-10-18 02:33:19', NULL, 1, 2, 'Incorporar ejemplares'),
(68, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 02:49:42', '2017-10-18 02:49:42', '2017-10-18 02:49:42', NULL, 1, 2, 'Incorporar ejemplares'),
(73, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 02:53:09', '2017-10-18 02:53:09', '2017-10-18 02:53:09', NULL, 1, 2, 'Incorporar ejemplares'),
(74, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 02:55:05', '2017-10-18 02:55:05', '2017-10-18 02:55:05', NULL, 1, 2, 'Incorporar ejemplares'),
(78, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 02:57:52', '2017-10-18 02:57:52', '2017-10-18 02:57:52', NULL, 1, 2, 'Incorporar ejemplares'),
(79, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 02:58:04', '2017-10-18 02:58:04', '2017-10-18 02:58:04', NULL, 1, 2, 'Incorporar ejemplares'),
(82, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 03:01:24', '2017-10-18 03:01:24', '2017-10-18 03:01:24', NULL, 1, 2, 'Incorporar ejemplares'),
(83, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 03:05:06', '2017-10-18 03:05:06', '2017-10-18 03:05:06', NULL, 1, 2, 'Incorporar ejemplares'),
(84, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 03:05:13', '2017-10-18 03:05:13', '2017-10-18 03:05:13', NULL, 1, 3, 'Incorporar ejemplares'),
(85, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 03:05:56', '2017-10-18 03:05:56', '2017-10-18 03:05:56', NULL, 1, 3, 'Incorporar ejemplares'),
(91, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 14:40:35', '2017-10-18 14:40:35', '2017-10-18 14:40:35', NULL, 1, 3, 'Incorporar ejemplares'),
(92, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 14:41:03', '2017-10-18 14:41:03', '2017-10-18 14:41:03', NULL, 1, 3, 'Incorporar ejemplares'),
(93, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 14:42:38', '2017-10-18 14:42:38', '2017-10-18 14:42:38', NULL, 1, 3, 'Incorporar ejemplares'),
(94, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 14:43:09', '2017-10-18 14:43:09', '2017-10-18 14:43:09', NULL, 1, 3, 'Incorporar ejemplares'),
(95, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 14:46:04', '2017-10-18 14:46:04', '2017-10-18 14:46:04', NULL, 1, 3, 'Incorporar ejemplares'),
(96, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 14:46:31', '2017-10-18 14:46:31', '2017-10-18 14:46:31', NULL, 1, 2, 'Incorporar ejemplares'),
(97, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 14:46:31', '2017-10-18 14:46:31', '2017-10-18 14:46:31', NULL, 1, 3, 'Incorporar ejemplares'),
(98, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 14:48:23', '2017-10-18 14:48:23', '2017-10-18 14:48:23', NULL, 1, 2, 'Incorporar ejemplares'),
(99, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 14:48:23', '2017-10-18 14:48:23', '2017-10-18 14:48:23', NULL, 1, 3, 'Incorporar ejemplares'),
(100, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 14:53:33', '2017-10-18 14:53:33', '2017-10-18 14:53:33', NULL, 1, 2, 'Incorporar ejemplares'),
(101, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 14:53:34', '2017-10-18 14:53:34', '2017-10-18 14:53:34', NULL, 1, 3, 'Incorporar ejemplares'),
(102, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 15:16:36', '2017-10-18 15:16:36', '2017-10-18 15:16:36', NULL, 1, 2, 'Incorporar ejemplares'),
(103, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 15:17:18', '2017-10-18 15:17:18', '2017-10-18 15:17:18', NULL, 1, 2, 'Incorporar ejemplares'),
(104, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 15:22:22', '2017-10-18 15:22:22', '2017-10-18 15:22:22', NULL, 1, 2, 'Incorporar ejemplares'),
(105, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 15:23:20', '2017-10-18 15:23:20', '2017-10-18 15:23:20', NULL, 1, 2, 'Incorporar ejemplares'),
(106, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 15:25:06', '2017-10-18 15:25:06', '2017-10-18 15:25:06', NULL, 1, 2, 'Incorporar ejemplares'),
(107, 'Incorporación de ejemplares', 'Esta tarea fue creada a través del menú de ejemplares', '2017-10-18 15:26:06', '2017-10-18 15:26:06', '2017-10-18 15:26:06', NULL, 1, 2, 'Incorporar ejemplares');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TAREA_EJEMPLAR`
--

DROP TABLE IF EXISTS `TAREA_EJEMPLAR`;
CREATE TABLE `TAREA_EJEMPLAR` (
  `idTareaEjemplar` bigint(20) UNSIGNED NOT NULL,
  `TAREA_idTarea` int(11) NOT NULL,
  `EJEMPLAR_especie_idEspecie` int(11) NOT NULL,
  `EJEMPLAR_acuario_idAcuario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TAREA_EJEMPLAR`
--

INSERT INTO `TAREA_EJEMPLAR` (`idTareaEjemplar`, `TAREA_idTarea`, `EJEMPLAR_especie_idEspecie`, `EJEMPLAR_acuario_idAcuario`, `cantidad`) VALUES
(39, 85, 2, 3, 2),
(42, 91, 2, 3, 1),
(43, 92, 2, 3, 1),
(44, 93, 2, 3, 1),
(45, 94, 2, 3, 1),
(46, 95, 2, 3, 2),
(47, 96, 2, 2, 2),
(48, 97, 2, 3, 1),
(49, 98, 2, 2, 2),
(50, 99, 2, 3, 1),
(51, 100, 2, 2, 2),
(52, 101, 2, 3, 1),
(53, 102, 2, 2, 1),
(54, 103, 2, 2, 1),
(55, 104, 2, 2, 1),
(56, 105, 2, 2, 1),
(57, 106, 2, 2, 2),
(58, 107, 2, 2, 3);

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
(21, 'Jose', 'Jose', 'jjose', 'jjose@gmail.com', '$2y$13$FeEAncLmU15ZHAOXDNGReuwToJoI4WEIAJ3CqZMmx1BNHe2/gkwK.', 0),
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
  ADD PRIMARY KEY (`idTareaEjemplar`),
  ADD UNIQUE KEY `idTareaEjemplar` (`idTareaEjemplar`),
  ADD KEY `fk_TAREA_has_EJEMPLAR_EJEMPLAR1_idx` (`EJEMPLAR_especie_idEspecie`,`EJEMPLAR_acuario_idAcuario`),
  ADD KEY `fk_TAREA_has_EJEMPLAR_TAREA1_idx` (`TAREA_idTarea`),
  ADD KEY `EJEMPLAR_acuario_idAcuario` (`EJEMPLAR_acuario_idAcuario`);

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
  MODIFY `idAcuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `CONDICION_AMBIENTAL`
--
ALTER TABLE `CONDICION_AMBIENTAL`
  MODIFY `idCondicionAmbiental` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `ESPECIE`
--
ALTER TABLE `ESPECIE`
  MODIFY `idEspecie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
  MODIFY `idPlanificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de la tabla `ROL`
--
ALTER TABLE `ROL`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `TAREA`
--
ALTER TABLE `TAREA`
  MODIFY `idTarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT de la tabla `TAREA_EJEMPLAR`
--
ALTER TABLE `TAREA_EJEMPLAR`
  MODIFY `idTareaEjemplar` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
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
  ADD CONSTRAINT `TAREA_EJEMPLAR_ibfk_1` FOREIGN KEY (`EJEMPLAR_acuario_idAcuario`) REFERENCES `ACUARIO` (`idAcuario`),
  ADD CONSTRAINT `fk_tarea_ejemplar_especie` FOREIGN KEY (`EJEMPLAR_especie_idEspecie`) REFERENCES `ESPECIE` (`idEspecie`),
  ADD CONSTRAINT `fk_tarea_ejemplar_tarea` FOREIGN KEY (`TAREA_idTarea`) REFERENCES `TAREA` (`idTarea`);

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
