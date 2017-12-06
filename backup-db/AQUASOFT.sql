-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 06-12-2017 a las 17:13:27
-- Versión del servidor: 5.7.20-0ubuntu0.17.04.1
-- Versión de PHP: 7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `AQUASOFT_FINAL`
--
CREATE DATABASE IF NOT EXISTS `AQUASOFT_FINAL` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `AQUASOFT_FINAL`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `obtenerTareasVencidas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerTareasVencidas` ()  BEGIN
DECLARE id_tarea INT;
DECLARE fecha_Inicio DATETIME;
DECLARE fecha_Fin DATETIME;
DECLARE done BOOL DEFAULT FALSE;

DECLARE cursorTarea CURSOR FOR SELECT idTarea, fechaHoraInicio, fechaHoraFin FROM TAREA WHERE DATE(fechaHoraInicio) = CURDATE() AND fechaHoraRealizacion IS NULL;

DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

OPEN cursorTarea;

read_Loop: LOOP

FETCH cursorTarea into id_tarea, fecha_inicio, fecha_fin;
	IF done THEN
            LEAVE read_Loop;
        END IF;

IF (CURRENT_TIME>=TIME(fecha_fin)) THEN
 INSERT IGNORE INTO NOTIFICACION (idNOTIFICACION, fechaHora,    ORIGEN_NOTIFICACION_idOrigenNotificacion, TAREA_idTarea)  VALUES (NULL, CURRENT_TIMESTAMP, 'Tarea no realizada', id_tarea);
END IF;


END LOOP;
CLOSE cursorTarea;
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
(6, 'A001', 'agua dulce', 83, 200, 1),
(7, 'A002', 'compatibilidad de peces tropicales', 254, 300, 1),
(8, 'A003', 'Acuario de dureza de agua standar', 600, 600, 1),
(9, 'A004', 'acuario de capacidad reducida', 100, 100, 1),
(10, 'A005', 'acuario de temperatura tropical', 123, 123, 0),
(11, 'A006', '', 300, 300, 0);

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
(6, 16),
(7, 16),
(9, 16),
(7, 19),
(8, 19),
(6, 20),
(7, 20);

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
('encargado', 17, 1509737161),
('especialista', 16, 1506560528),
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
('/*', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/admin/*', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/assignment/*', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/assignment/assign', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/assignment/index', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/assignment/view', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/default/*', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/default/index', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/menu/*', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/menu/create', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/menu/delete', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/menu/index', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/menu/update', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/menu/view', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/permission/*', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/permission/assign', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/permission/create', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/permission/delete', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/permission/index', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/permission/remove', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/permission/update', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/permission/view', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/role/*', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/role/assign', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/role/create', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/role/delete', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/role/index', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/role/remove', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/role/update', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/role/view', 2, NULL, NULL, NULL, 1509745757, 1509745757),
('/admin/route/*', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/route/assign', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/route/create', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/route/index', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/route/refresh', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/route/remove', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/rule/*', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/rule/create', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/rule/delete', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/rule/index', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/rule/update', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/rule/view', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/user/*', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/user/activate', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/user/change-password', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/user/delete', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/user/index', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/user/login', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/user/logout', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/user/reset-password', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/user/signup', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/admin/user/view', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/aquarium/*', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/aquarium/change-state', 2, NULL, NULL, NULL, 1510062647, 1510062647),
('/aquarium/create', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/aquarium/delete', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/aquarium/detail', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/aquarium/index', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/aquarium/update', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/aquarium/validation', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/aquarium/view', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/census/*', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/census/index', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/census/show-census', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/debug/*', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/debug/default/*', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/debug/default/db-explain', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/debug/default/download-mail', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/debug/default/index', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/debug/default/toolbar', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/debug/default/view', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/debug/user/*', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/debug/user/reset-identity', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/debug/user/set-identity', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/gii/*', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/gii/default/*', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/gii/default/action', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/gii/default/diff', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/gii/default/index', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/gii/default/preview', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/gii/default/view', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/planning/*', 2, NULL, NULL, NULL, 1509745762, 1509745762),
('/planning/autorized', 2, NULL, NULL, NULL, 1509745762, 1509745762),
('/planning/calendar', 2, NULL, NULL, NULL, 1509745762, 1509745762),
('/planning/check', 2, NULL, NULL, NULL, 1509745762, 1509745762),
('/planning/create', 2, NULL, NULL, NULL, 1509745762, 1509745762),
('/planning/down', 2, NULL, NULL, NULL, 1509745762, 1509745762),
('/planning/home', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/planning/index', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/planning/motive', 2, NULL, NULL, NULL, 1509745762, 1509745762),
('/planning/refuse', 2, NULL, NULL, NULL, 1509745762, 1509745762),
('/planning/update', 2, NULL, NULL, NULL, 1509745762, 1509745762),
('/planning/validate-planning', 2, NULL, NULL, NULL, 1509745762, 1509745762),
('/planning/view', 2, NULL, NULL, NULL, 1509745759, 1509745759),
('/reportico/*', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/reportico/default/*', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/reportico/default/index', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/reportico/default/login', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/reportico/mode/*', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/reportico/mode/admin', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/reportico/mode/execute', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/reportico/mode/menu', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/reportico/mode/prepare', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/reportico/mode/reportico', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/reportico/reportico/*', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/reportico/reportico/ajax', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/reportico/reportico/dbimage', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/reportico/reportico/graph', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/reportico/reportico/reportico', 2, NULL, NULL, NULL, 1509745758, 1509745758),
('/site/*', 2, NULL, NULL, NULL, 1509745762, 1509745762),
('/site/error', 2, NULL, NULL, NULL, 1509745762, 1509745762),
('/site/help', 2, NULL, NULL, NULL, 1510504279, 1510504279),
('/site/index', 2, NULL, NULL, NULL, 1509745762, 1509745762),
('/site/login', 2, NULL, NULL, NULL, 1509745762, 1509745762),
('/site/logout', 2, NULL, NULL, NULL, 1509745762, 1509745762),
('/site/search-notification', 2, NULL, NULL, NULL, 1509751236, 1509751236),
('/specie/*', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/specie/create', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/specie/delete', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/specie/index', 2, NULL, NULL, NULL, 1509745762, 1509745762),
('/specie/update', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/specie/view', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/specimen/*', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/supply/*', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/supply/create', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/supply/delete', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/supply/get-stock', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/supply/index', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/supply/update', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/supply/view', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-specimen/*', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-specimen/add-remove', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-specimen/add-specimens', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-specimen/create', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-specimen/delete', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-specimen/get-aquariums', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-specimen/get-destination-aquarium-data', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-specimen/get-destination-aquariums', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-specimen/get-origin-aquariums', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-specimen/remove-specimens', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-specimen/specimens-tasks', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-specimen/transfer', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-specimen/transfer-specimens', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-specimen/update', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-specimen/view', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-supply/*', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-supply/add-remove-supply', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task-supply/index', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task/*', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task/common-tasks-realization', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task/common-tasks-validation', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task/control', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task/control-validation', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task/create', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task/delete', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task/execute', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task/index', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task/update', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task/validation', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/task/view', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/user/*', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/user/change-state', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/user/create', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/user/index', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/user/update', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/user/validation', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('/user/view', 2, NULL, NULL, NULL, 1509745763, 1509745763),
('accederReporte', 2, NULL, NULL, NULL, 1509924212, 1509924212),
('administrador', 1, NULL, NULL, NULL, 1506560408, 1506560408),
('administrarPlanificaciones', 2, NULL, NULL, NULL, 1509738168, 1509738168),
('administrarTareas', 2, 'Permiso utilizado para los CRUD de tareas', NULL, NULL, 1507426684, 1507426684),
('autorizar-rechazar', 2, NULL, NULL, NULL, 1509738130, 1509738130),
('bajaAcuario', 2, NULL, NULL, NULL, 1507481711, 1507481711),
('bajaEspecialista', 2, NULL, NULL, NULL, 1507483126, 1507483126),
('crearAcuario', 2, NULL, NULL, NULL, 1507480958, 1507481358),
('crearEspecialista', 2, NULL, NULL, NULL, 1507479399, 1507479399),
('crearPlani', 2, NULL, NULL, NULL, 1509848849, 1509848849),
('encargado', 1, NULL, NULL, NULL, 1506560453, 1506560453),
('especialista', 1, NULL, NULL, NULL, 1506560482, 1506560482),
('modificarAcuario', 2, NULL, NULL, NULL, 1507481673, 1507481673),
('modificarEspecialista', 2, NULL, NULL, NULL, 1507483108, 1507483108),
('verAyuda', 2, NULL, NULL, NULL, 1510609843, 1510609843),
('verEjemplares', 2, 'Permite ver la sección de ejemplares', NULL, NULL, 1507778939, 1507778939),
('verEspecialistas', 2, 'Permite visualizar el menú de especialistas', NULL, NULL, 1507479293, 1507480209),
('verEspecies', 2, 'Permitir el acceso a la sección de especies', NULL, NULL, 1507480274, 1507480274),
('verInsumos', 2, 'Permitir el acceso a la sección de insumos', NULL, NULL, 1507480525, 1507480525),
('verNotificaciones', 2, NULL, NULL, NULL, 1509738331, 1509738331);

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
('administrador', '/*'),
('encargado', '/aquarium/*'),
('encargado', '/aquarium/change-state'),
('especialista', '/aquarium/detail'),
('especialista', '/aquarium/index'),
('especialista', '/aquarium/view'),
('encargado', '/census/*'),
('especialista', '/census/*'),
('encargado', '/planning/autorized'),
('encargado', '/planning/calendar'),
('especialista', '/planning/calendar'),
('encargado', '/planning/check'),
('especialista', '/planning/create'),
('especialista', '/planning/down'),
('especialista', '/planning/home'),
('encargado', '/planning/index'),
('especialista', '/planning/index'),
('encargado', '/planning/motive'),
('encargado', '/planning/refuse'),
('especialista', '/planning/update'),
('especialista', '/planning/validate-planning'),
('encargado', '/planning/view'),
('especialista', '/planning/view'),
('encargado', '/reportico/mode/execute'),
('encargado', '/site/*'),
('especialista', '/site/error'),
('encargado', '/site/help'),
('especialista', '/site/help'),
('verAyuda', '/site/help'),
('especialista', '/site/index'),
('especialista', '/site/login'),
('especialista', '/site/logout'),
('encargado', '/site/search-notification'),
('especialista', '/site/search-notification'),
('especialista', '/specie/*'),
('encargado', '/specie/index'),
('encargado', '/specie/view'),
('encargado', '/supply/*'),
('especialista', '/supply/get-stock'),
('especialista', '/task-specimen/*'),
('especialista', '/task/*'),
('encargado', '/task/view'),
('encargado', '/user/*'),
('encargado', '/user/change-state'),
('encargado', 'accederReporte'),
('especialista', 'administrarPlanificaciones'),
('especialista', 'administrarTareas'),
('encargado', 'autorizar-rechazar'),
('encargado', 'bajaAcuario'),
('encargado', 'bajaEspecialista'),
('encargado', 'crearAcuario'),
('encargado', 'crearEspecialista'),
('especialista', 'crearPlani'),
('administrador', 'encargado'),
('administrador', 'especialista'),
('encargado', 'modificarAcuario'),
('encargado', 'modificarEspecialista'),
('especialista', 'verEjemplares'),
('encargado', 'verEspecialistas'),
('especialista', 'verEspecies'),
('encargado', 'verInsumos'),
('encargado', 'verNotificaciones');

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
(1, 7, 25, 10, 60, 10, 6, 108),
(2, 8, 3, 5, 1, 6, 6, 233),
(3, 4, 10, 4, 1.1, 5, 6, 229),
(4, 5, 5, 3, 1.1, 4, 7, 236),
(5, 3, 2, 1, 0.3, 1, 7, 237),
(6, 2, 2, 1, 0.2, 1, 7, 238),
(7, 3, 2, 2, 0.2, 3, 7, 239),
(8, 1, 2, 2, 0.1, 2, 7, 240),
(9, 7, 25, 10, 60, 10, 6, 242),
(10, 7, 25, 15, 60, 3, 6, 243),
(11, 7, 26, 6, 65, 3, 7, 245),
(12, 7, 25, 15, 60, 3, 6, 247),
(15, 7, 26, 6, 65, 3, 7, 254),
(16, 7, 26, 6, 65, 3, 7, 256),
(17, 7, 25, 15, 60, 3, 6, 266),
(18, 7, 25, 15, 60, 3, 6, 268),
(19, 7, 26, 6, 65, 3, 7, 271),
(20, 7, 26, 6, 65, 3, 7, 272),
(21, 7, 26, 6, 65, 3, 7, 273),
(22, 7, 26, 6, 65, 3, 7, 274),
(23, 7, 26, 6, 65, 3, 7, 275),
(24, 7, 25, 15, 60, 3, 6, 278),
(25, 7, 26, 6, 65, 3, 7, 279),
(26, 7, 25, 15, 60, 3, 6, 283),
(27, 7, 25, 15, 60, 3, 6, 284),
(28, 7, 25, 15, 60, 3, 6, 285);

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
(4, 6, 17),
(4, 7, 5),
(5, 6, 5),
(6, 7, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESPECIE`
--

DROP TABLE IF EXISTS `ESPECIE`;
CREATE TABLE `ESPECIE` (
  `idEspecie` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
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
(4, 'Pez Betta', 'El luchador de Siam también conocido como pez beta, es una especie de pez de agua dulce de la familia de los laberíntidos, aunque antes fue clasificado erróneamente entre los Anabantidae.', 7, 8, 24, 30, 5, 15, 60, 100, 6, 1.9, 3, 1),
(5, 'Guppy', 'El guppy, lebistes o pez millón es un pez ovovivíparo de agua dulce procedente de Sudamérica que habita en zonas de corriente baja de ríos, lagos y charcas.', 7, 8, 24, 30, 15, 22, 50, 100, 3, 3, 5.5, 1),
(6, 'Pez Angel', 'El Escalar o Pez Ángel (Pterophyllum scalare) es una especie de pez de agua dulce perteneciente a la familia de los cíclidos. Es una de las especies de peces tropicales más populares en el mundo de la acuariofilia.', 6, 8, 24, 30, 5, 13, 60, 100, 4, 2.4, 4.6, 1),
(7, 'Platy', 'Xiphophorus maculatus, vulgarmente conocido como platy, en el orden de los Ciprinodontiformes. No requieren cuidados especiales y tienen una capacidad excepcional de reproducirse, al igual que otras especies de su misma familia, como los guppys o mollys.', 7, 7.5, 20, 27, 10, 14, 40, 80, 3, 3, 6, 1),
(8, 'Molly', 'El Pez Molly es un género de peces de la clase Actinopterygii perteneciente a la familia Poeciliidae estos peces son muy comunes en los acuarios alrededor del mundo debido a su facilidad de conservación y cuidados generales.', 7, 8, 24, 30, 9, 14, 60, 100, 2, 2.4, 4, 1),
(9, 'Pez Telescopio', 'El Pez Telescopio es una variedad de carpín dorado o carpa dorada (Carassius auratus) su característica principal es la forma de sus ojos esta variedad de pez también es conocida por Demekin, Ojos de dragón y moro estos nombres se le da según la ubicación donde se encuentra el pez.', 7, 7.5, 10, 24, 10, 15, 60, 100, 4, 2.1, 2.6, 1),
(10, 'Caballito de Mar', 'El caballito de mar también es conocido por su nombre científico como Hippocampus, es parte de un conjunto de peces marinos que conforman la familia de Syngnathidae.', 6, 8.2, 19, 28, 7, 15, 50, 90, 4, 3.4, 4.8, 1);

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

--
-- Volcado de datos para la tabla `INSUMO`
--

INSERT INTO `INSUMO` (`idInsumo`, `nombre`, `descripcion`, `stock`, `activo`, `TIPO_TAREA_idTipoTarea`) VALUES
(1, 'Tetra Veggie - 160 grs', 'Peces tropicales, agua fría y marinos', 13, 1, 'Alimentación'),
(2, 'Tetra Fin - Escamas 28 grs', 'Tetra Fin - Escamas para peces de agua fría', 45, 1, 'Alimentación'),
(3, 'Tetra Pond Koi Growth - 270 gramos', '', 10, 1, 'Alimentación'),
(4, 'Fertibon Bonacqua - 250 ml.', 'Fertilizante para plantas acuáticas.', 86, 1, 'Controlar acuario'),
(5, 'Test de PH', '', 152, 1, 'Controlar acuario'),
(6, 'Test de CO2 - Dióxido de Carbono', '', 79, 1, 'Controlar acuario'),
(7, 'Camaron deshidratado', 'Alimento para peces, reptiles y anfibios', 16, 1, 'Alimentación'),
(8, 'Limpiagravas', '', 51, 1, 'Limpieza'),
(9, 'Sera Aquatan 100 ml.', 'Acondicionador de agua', 230, 1, 'Reparación'),
(10, 'Sera Aquariaclear 250 ml.', 'Clarificador de agua', 75, 1, 'Reparación'),
(11, 'Test PH Sera', 'Medidor de PH.', 10, 1, 'Controlar acuario'),
(12, 'Sera O-nip 100 tabletas', 'Tabletas para el fondo o para pegar en los vidrios.', 43, 1, 'Alimentación'),
(13, 'Sera Quick test', 'Tiras reactivas para medir pH, kH, gH, Nitratos y Nitritos.', 33, 1, 'Controlar acuario'),
(14, 'Sera Phosvec 20 ml.', 'Elimina fosfatos de manera inmediata', 10, 1, 'Limpieza'),
(15, 'Lavandina concentrada', '', 34, 1, 'Limpieza'),
(16, 'Sera Baktopur 50ml', 'Combate enfermedades de origen bacteriano.', 28, 1, 'Controlar acuario');

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

--
-- Volcado de datos para la tabla `INSUMO_TAREA`
--

INSERT INTO `INSUMO_TAREA` (`INSUMO_idInsumo`, `TAREA_idTarea`, `cantidad`) VALUES
(2, 228, 4),
(2, 232, 1),
(3, 232, 2),
(3, 255, 2),
(4, 229, 2),
(4, 233, 2),
(4, 247, 2),
(4, 254, 2),
(4, 256, 3),
(4, 268, 2),
(4, 283, 1),
(5, 229, 1),
(5, 237, 2),
(5, 239, 2),
(5, 240, 3),
(5, 245, 1),
(5, 275, 1),
(6, 237, 1),
(6, 239, 1),
(6, 245, 2),
(6, 247, 1),
(6, 256, 2),
(6, 283, 1),
(8, 261, 2),
(8, 276, 1),
(10, 235, 2),
(11, 238, 1),
(11, 239, 1),
(11, 275, 1),
(13, 256, 1),
(14, 261, 1),
(14, 276, 2),
(16, 254, 1);

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

--
-- Volcado de datos para la tabla `NOTIFICACION`
--

INSERT INTO `NOTIFICACION` (`idNOTIFICACION`, `fechaHora`, `ORIGEN_NOTIFICACION_idOrigenNotificacion`, `TAREA_idTarea`) VALUES
(1, '2017-11-05 19:41:40', 'Hábitat riesgoso', 233),
(2, '2017-11-05 19:42:20', 'Hábitat riesgoso', 229),
(3, '2017-11-05 19:53:50', 'Hábitat riesgoso', 242),
(4, '2017-11-06 02:03:58', 'Tarea no realizada', 237),
(8, '2017-11-12 18:40:00', 'Tarea no realizada', 280),
(9, '2017-11-12 18:40:00', 'Tarea no realizada', 281),
(14, '2017-11-12 18:42:00', 'Tarea no realizada', 282);

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
(1, 'Planificación Diciembre', '2017-12-01', '2017-11-04 19:29:53', 1, 6, 16, 'SinVerificar'),
(2, 'Planificación Especial', '2017-11-01', '2017-11-04 19:32:28', 1, 6, 16, 'SinVerificar'),
(3, 'Planificación Verano - Enero', '2018-01-01', '2017-11-04 19:33:12', 1, 7, 16, 'SinVerificar'),
(4, 'Planificación Verano - Febrero', '2018-02-01', '2017-11-04 19:34:23', 1, 7, 16, 'SinVerificar'),
(5, 'Planificación Marzo 18', '2018-03-01', '2017-11-04 19:35:46', 1, 9, 19, 'SinVerificar'),
(6, 'Planificación Abril 18', '2018-02-01', '2017-11-04 22:54:33', 1, 9, 16, 'SinVerificar'),
(7, 'Planificación DIC', '2017-12-01', '2017-11-05 00:06:42', 1, 8, 19, 'SinVerificar'),
(8, 'Planificación ENERO', '2018-01-01', '2017-11-05 00:15:34', 1, 8, 19, 'SinVerificar'),
(10, 'Planificación DIC', '2017-12-01', '2017-11-05 00:41:49', 1, 7, 19, 'SinVerificar'),
(11, 'planificación abril', '2018-04-01', '2017-11-07 15:03:00', 1, 6, 16, 'Rechazada'),
(12, 'planificación abril', '2018-04-01', '2017-11-28 15:10:29', 1, 6, 16, 'SinVerificar'),
(13, 'Planificación especial diciembre', '2017-12-01', '2017-12-05 18:17:12', 0, 9, 16, 'SinVerificar'),
(14, 'Plan febrero', '2018-02-01', '2017-12-06 12:48:25', 1, 6, 16, 'SinVerificar'),
(15, 'planificacion diciembre', '2017-12-01', '2017-12-06 15:41:34', 0, 9, 16, 'SinVerificar'),
(16, 'planificación diciembre', '2017-12-01', '2017-12-06 15:42:12', 1, 9, 16, 'SinVerificar'),
(17, 'planificación', '2018-04-01', '2017-12-06 15:53:05', 1, 9, 16, 'Rechazada'),
(18, 'planificación abril', '2018-04-01', '2017-12-06 16:10:50', 1, 9, 16, 'SinVerificar');

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
  `observaciones` varchar(200) DEFAULT NULL,
  `PLANIFICACION_idPlanificacion` int(11) DEFAULT NULL COMMENT 'Si este campo está vacío significa que la tareas a sido creada fuera de la planificacion mensual.',
  `USUARIO_idUsuario` int(11) DEFAULT NULL,
  `ACUARIO_idAcuario` int(11) DEFAULT NULL COMMENT 'Este campo contendrá el acuario para el cual se ha realizado la tarea sólo en los casos en que la tarea sea un imprevisto (no tendrá un id de planificacion) ya que de lo contrario se sabrá el acuario a través de la planificacion\n',
  `TIPO_TAREA_idTipoTarea` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TAREA`
--

INSERT INTO `TAREA` (`idTarea`, `titulo`, `descripcion`, `fechaHoraInicio`, `fechaHoraFin`, `fechaHoraRealizacion`, `observaciones`, `PLANIFICACION_idPlanificacion`, `USUARIO_idUsuario`, `ACUARIO_idAcuario`, `TIPO_TAREA_idTipoTarea`) VALUES
(108, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-04 00:00:00', '2017-11-04 00:00:00', '2017-11-04 13:13:55', NULL, NULL, 16, 6, 'Controlar acuario'),
(110, 'Limpieza general de acuario', 'Limpiar habitad ', '2017-12-07 19:30:00', '2017-12-07 20:15:00', NULL, NULL, 1, 16, 6, 'Limpieza'),
(111, 'Tarea - Jueves 8', 'Limpieza general ', '2018-02-08 17:10:00', '2018-02-08 17:20:00', NULL, NULL, 6, 16, 9, 'Limpieza'),
(112, 'Alimentación - Diaria', 'Alimentación diaria de alimento a especies', '2017-12-05 09:30:00', '2017-12-05 10:15:00', NULL, NULL, 7, 19, 8, 'Alimentación'),
(113, 'Alimentación - Diaria', 'Alimentación diaria a especies.', '2017-12-06 09:30:00', '2017-12-06 10:15:00', NULL, NULL, 7, 19, 8, 'Alimentación'),
(115, 'Reparación - cambio de filtros', 'Cambio de filtros lado izquierdo del aquarium', '2017-12-21 16:00:00', '2017-12-21 17:00:00', NULL, NULL, 7, 19, 8, 'Reparación'),
(117, 'Controlar condiciones', 'Controlar condiciones ambientales del acuario.\r\nCambios en el comportamiento de las tortugas.\r\nVerificar luminosidad.', '2017-12-15 11:10:00', '2017-12-15 11:40:00', NULL, NULL, 7, 19, 8, 'Controlar acuario'),
(118, 'Controlar condiciones ', 'Controlar condiciones nuevas.\r\nVerificar correcto uso del aumento de temperatura.', '2018-01-10 10:10:00', '2018-01-10 10:40:00', NULL, NULL, 8, 19, 8, 'Controlar acuario'),
(120, 'Alimentación - Diaria', '', '2018-01-01 10:00:00', '2018-01-01 10:30:00', NULL, NULL, 8, 19, 8, 'Alimentación'),
(121, 'Alimentación - Diaria', '', '2018-01-02 11:10:00', '2018-01-02 11:20:00', NULL, NULL, 8, 19, 8, 'Alimentación'),
(122, 'Alimentación - Diaria', '', '2018-01-03 11:10:00', '2018-01-03 11:20:00', NULL, NULL, 8, 19, 8, 'Alimentación'),
(123, 'Alimentación - Diaria', '', '2018-01-04 11:20:00', '2018-01-04 11:30:00', NULL, NULL, 8, 19, 8, 'Alimentación'),
(124, 'Reparación ', 'Reparación en su defecto cambio de lamparas iluminadoras de esquinas.', '2018-01-12 15:20:00', '2018-01-12 15:30:00', NULL, NULL, 8, 19, 8, 'Reparación'),
(127, 'Limpieza especial', 'Limpieza especial de vidrios y accesorios de las especies.', '2018-01-26 18:20:00', '2018-01-26 19:10:00', NULL, NULL, 8, 19, 8, 'Limpieza'),
(128, 'Controlar condiciones', 'Control de rutina.', '2018-01-16 18:20:00', '2018-01-16 18:50:00', NULL, NULL, 8, 19, 8, 'Controlar acuario'),
(129, 'Reparación - accesorios ', 'Extraer y reparar accesorios del acuario. \r\n', '2018-01-14 07:20:00', '2018-01-14 08:10:00', NULL, NULL, 8, 19, 8, 'Reparación'),
(130, 'Alimentación - Especial', 'Alimentar con vitaminas especiales.', '2018-02-07 10:30:00', '2018-02-07 10:45:00', NULL, NULL, 9, 19, 8, 'Alimentación'),
(131, 'Limpieza de algas artificiales', 'Realizar proceso de higiene adecuado a las algas artificiales.', '2018-02-08 00:30:00', '2018-02-08 01:00:00', NULL, NULL, 9, 19, 8, 'Limpieza'),
(132, 'Control de condiciones mensual.', 'Realizar control mensual.', '2018-02-16 10:30:00', '2018-02-16 11:30:00', NULL, NULL, 9, 19, 8, 'Controlar acuario'),
(133, 'Reparación - Filtros', 'Reparación o en su defecto cambio de los filtros ubicados en las esquinas del acuario.', '2017-12-07 17:50:00', '2017-12-07 19:05:00', NULL, NULL, 10, 16, 7, 'Reparación'),
(134, 'Limpieza semanal', 'Limpieza semanal', '2018-02-01 09:30:00', '2018-02-01 10:50:00', NULL, NULL, 6, 16, 9, 'Alimentación'),
(135, 'Tarea reparacion', 'Reparación de bomba de burbujas', '2018-02-08 10:00:00', '2018-02-08 10:30:00', NULL, NULL, 6, 16, 9, 'Reparación'),
(136, 'Alimentación - Diaria', '', '2018-01-05 09:10:00', '2018-01-05 09:45:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(138, 'Limpieza especial', 'Limpieza especial de piedras.\r\n', '2018-01-02 23:10:00', '2018-01-02 23:25:00', NULL, NULL, 8, 16, 8, 'Limpieza'),
(139, 'Alimentación - Diaria', 'Alimentación diarias', '2018-01-25 09:20:00', '2018-01-25 09:35:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(141, 'Alimentación - Diaria', '', '2018-01-14 09:20:00', '2018-01-14 09:35:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(142, 'Alimentación - Diaria', '', '2018-01-12 09:20:00', '2018-01-12 09:35:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(143, 'Alimentación - Diaria', '', '2018-01-06 09:20:00', '2018-01-06 09:35:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(144, 'Alimentación - Diaria', '', '2018-01-07 09:20:00', '2018-01-07 09:35:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(145, 'Alimentación - Diaria', '', '2018-01-13 09:20:00', '2018-01-13 09:50:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(146, 'Alimentación - Diaria', '', '2018-01-08 08:20:00', '2018-01-08 08:45:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(147, 'Alimentación - Diaria', '', '2018-01-15 09:20:00', '2018-01-15 09:35:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(148, 'Alimentación - Diaria', '', '2018-01-09 09:20:00', '2018-01-09 09:40:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(149, 'Alimentación - Diaria', '', '2018-01-10 07:20:00', '2018-01-10 07:40:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(150, 'Alimentación - Diaria', '', '2018-01-16 07:20:00', '2018-01-16 07:35:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(151, 'Alimentación - Diaria', '', '2018-01-17 08:20:00', '2018-01-17 08:35:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(152, 'Alimentación - Diaria', '', '2018-01-19 08:20:00', '2018-01-19 08:40:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(153, 'Alimentación - Diaria', '', '2018-01-20 09:20:00', '2018-01-20 09:32:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(154, 'Alimentación - Diaria', '', '2018-01-21 08:20:00', '2018-01-21 08:40:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(155, 'Alimentación - Diaria', '', '2018-01-22 09:20:00', '2018-01-22 09:40:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(156, 'Alimentación - Diaria', '', '2018-01-27 07:20:00', '2018-01-27 07:50:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(157, 'Alimentación - Diaria', '', '2018-01-23 09:20:00', '2018-01-23 09:40:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(158, 'Alimentación - Diaria', '', '2018-01-24 08:30:00', '2018-01-24 09:00:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(159, 'Alimentación - Diaria', '', '2018-01-28 09:30:00', '2018-01-28 10:00:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(160, 'Alimentación - Diaria', '', '2018-01-29 09:30:00', '2018-01-29 09:55:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(161, 'Alimentación - Diaria', '', '2018-01-30 08:30:00', '2018-01-30 08:55:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(162, 'Alimentación - Diaria', '', '2018-01-31 08:30:00', '2018-01-31 08:50:00', NULL, NULL, 8, 16, 8, 'Alimentación'),
(163, 'Control semanal', '', '2018-01-19 00:30:00', '2018-01-19 00:55:00', NULL, NULL, 8, 16, 8, 'Controlar acuario'),
(164, 'Control semanal', '', '2018-01-26 00:30:00', '2018-01-26 00:55:00', NULL, NULL, 8, 16, 8, 'Controlar acuario'),
(165, 'Control semanal', '', '2018-01-08 01:30:00', '2018-01-08 01:55:00', NULL, NULL, 8, 16, 8, 'Controlar acuario'),
(166, 'Control semanal', '', '2018-01-15 01:30:00', '2018-01-15 01:50:00', NULL, NULL, 8, 16, 8, 'Controlar acuario'),
(167, 'Control semanal', '', '2018-01-29 01:30:00', '2018-01-29 02:00:00', NULL, NULL, 8, 16, 8, 'Controlar acuario'),
(168, 'Reparación lamparas esquinas', 'Reparación de lamparas en las esquinas en su defecto cambio.', '2018-01-19 17:30:00', '2018-01-19 18:15:00', NULL, NULL, 8, 16, 8, 'Reparación'),
(169, 'Limpieza especial', 'Limpieza especial vidrios', '2018-01-19 20:30:00', '2018-01-19 20:50:00', NULL, NULL, 8, 16, 8, 'Limpieza'),
(171, 'Alimentación - Diaria', '', '2017-12-01 09:10:00', '2017-12-01 09:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(172, 'Alimentación - Diaria', '', '2017-12-02 12:40:00', '2017-12-02 13:00:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(173, 'Alimentación - Diaria', '', '2017-12-03 12:10:00', '2017-12-03 12:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(174, 'Alimentación - Diaria', '', '2017-12-06 12:10:00', '2017-12-06 12:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(175, 'Alimentación - Diaria', '', '2017-12-04 12:10:00', '2017-12-04 12:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(176, 'Alimentación - Diaria', '', '2017-12-05 12:10:00', '2017-12-05 12:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(177, 'Alimentación - Diaria', '', '2017-12-08 12:10:00', '2017-12-08 12:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(178, 'Alimentación - Diaria', '', '2017-12-07 12:10:00', '2017-12-07 12:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(179, 'Alimentación - Diaria', '', '2017-12-09 12:10:00', '2017-12-09 12:20:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(180, 'Alimentación - Diaria', '', '2017-12-10 12:10:00', '2017-12-10 12:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(181, 'Alimentación - Diaria', '', '2017-12-11 12:10:00', '2017-12-11 12:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(182, 'Alimentación - Diaria', '', '2017-12-12 12:10:00', '2017-12-12 12:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(183, 'Alimentación - Diaria', '', '2017-12-13 12:10:00', '2017-12-13 12:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(184, 'Alimentación - Diaria', '', '2017-12-14 12:10:00', '2017-12-14 12:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(185, 'Alimentación - Diaria', '', '2017-12-15 12:10:00', '2017-12-15 12:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(187, 'Alimentación - Diaria', '', '2017-12-16 12:10:00', '2017-12-16 12:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(188, 'Alimentación - Diaria', '', '2017-12-17 12:10:00', '2017-12-17 12:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(189, 'Alimentación - Diaria', '', '2017-12-18 12:10:00', '2017-12-18 12:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(190, 'Alimentación - Diaria', '', '2017-12-19 12:10:00', '2017-12-19 12:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(191, 'Alimentación - Diaria', '', '2017-12-20 12:10:00', '2017-12-20 12:30:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(192, 'Alimentación - Diaria', '', '2017-12-21 12:20:00', '2017-12-21 12:40:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(193, 'Alimentación - Diaria', '', '2017-12-22 12:20:00', '2017-12-22 12:40:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(194, 'Alimentación - Diaria', '', '2017-12-23 12:20:00', '2017-12-23 12:40:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(195, 'Alimentación - Diaria', '', '2017-12-24 12:20:00', '2017-12-24 12:40:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(196, 'Alimentación - Diaria', '', '2017-12-25 12:20:00', '2017-12-25 12:50:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(197, 'Alimentación - Diaria', '', '2017-12-26 12:20:00', '2017-12-26 12:40:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(198, 'Alimentación - Diaria', '', '2017-12-27 12:20:00', '2017-12-27 12:40:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(199, 'Alimentación - Diaria', '', '2017-12-28 12:20:00', '2017-12-28 12:40:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(200, 'Alimentación - Diaria', '', '2017-12-29 12:20:00', '2017-12-29 12:40:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(201, 'Alimentación - Diaria', '', '2017-12-30 12:20:00', '2017-12-30 12:40:00', NULL, NULL, 10, 19, 7, 'Alimentación'),
(202, 'Control semanal', '', '2017-12-15 21:20:00', '2017-12-15 22:05:00', NULL, NULL, 10, 19, 7, 'Controlar acuario'),
(204, 'Control semanal', '', '2017-12-01 21:20:00', '2017-12-01 22:05:00', NULL, NULL, 10, 19, 7, 'Controlar acuario'),
(205, 'Control semanal', '', '2017-12-08 21:20:00', '2017-12-08 22:05:00', NULL, NULL, 10, 19, 7, 'Controlar acuario'),
(206, 'Alimentación - Diaria', '', '2018-02-09 08:20:00', '2018-02-09 09:05:00', NULL, NULL, 9, 19, 8, 'Alimentación'),
(207, 'Alimentación - Diaria', '', '2018-02-14 08:20:00', '2018-02-14 09:05:00', NULL, NULL, 9, 19, 8, 'Alimentación'),
(208, 'Alimentación - Diaria', '', '2018-02-15 12:20:00', '2018-02-15 13:05:00', NULL, NULL, 9, 19, 8, 'Alimentación'),
(209, 'Alimentación - Diaria', '', '2018-03-08 12:20:00', '2018-03-08 12:40:00', NULL, NULL, 5, 19, 9, 'Alimentación'),
(210, 'Alimentación - Diaria', '', '2018-03-09 12:20:00', '2018-03-09 12:40:00', NULL, NULL, 5, 19, 9, 'Alimentación'),
(211, 'Alimentación - Diaria', '', '2018-03-10 12:20:00', '2018-03-10 12:40:00', NULL, NULL, 5, 19, 9, 'Alimentación'),
(213, 'Alimentación - Diaria', '', '2018-03-07 12:20:00', '2018-03-07 12:40:00', NULL, NULL, 5, 19, 9, 'Alimentación'),
(214, 'Alimentación - Diaria', '', '2018-03-11 12:20:00', '2018-03-11 12:40:00', NULL, NULL, 5, 19, 9, 'Alimentación'),
(216, 'Limpieza especial', 'Limpieza de habitad de las especies.', '2018-03-07 17:20:00', '2018-03-07 18:05:00', NULL, NULL, 5, 19, 9, 'Limpieza'),
(217, 'Alimentación - Diaria', '', '2017-12-08 12:20:00', '2017-12-08 12:40:00', NULL, NULL, 1, 19, 6, 'Alimentación'),
(218, 'Alimentación - Diaria', '', '2017-12-09 12:20:00', '2017-12-09 12:40:00', NULL, NULL, 1, 19, 6, 'Alimentación'),
(219, 'Alimentación - Diaria', '', '2017-12-07 12:30:00', '2017-12-07 12:50:00', NULL, NULL, 1, 19, 6, 'Alimentación'),
(220, 'Alimentación - Diaria', '', '2017-12-06 12:30:00', '2017-12-06 12:50:00', NULL, NULL, 1, 19, 6, 'Alimentación'),
(221, 'Alimentación - Diaria', '', '2017-12-05 12:30:00', '2017-12-05 12:50:00', NULL, NULL, 1, 19, 6, 'Alimentación'),
(222, 'Alimentación - Diaria', '', '2017-12-04 12:30:00', '2017-12-04 12:50:00', NULL, NULL, 1, 19, 6, 'Alimentación'),
(223, 'Alimentación - Diaria', '', '2017-12-10 12:30:00', '2017-12-10 12:50:00', NULL, NULL, 1, 19, 6, 'Alimentación'),
(224, 'Alimentación - Diaria', '', '2017-12-01 12:30:00', '2017-12-01 12:50:00', NULL, NULL, 1, 19, 6, 'Alimentación'),
(225, 'Alimentación - Diaria', '', '2017-12-02 12:30:00', '2017-12-02 12:50:00', NULL, NULL, 1, 19, 6, 'Alimentación'),
(226, 'Limpieza general', '', '2017-12-06 18:30:00', '2017-12-06 20:30:00', NULL, NULL, 1, 16, 6, 'Limpieza'),
(227, 'Reparación  ', '', '2017-12-01 18:30:00', '2017-12-01 19:15:00', NULL, NULL, 1, 16, 6, 'Reparación'),
(228, 'Alimentación especial', 'Esta es una tarea no planificada de tipo \"alimentación\".', '2017-11-05 18:50:00', '2017-11-05 19:20:00', '2017-11-05 19:00:40', 'La tarea se llevó a cabo sin problemas.', NULL, 16, 6, 'Alimentación'),
(229, 'Control urgente', 'Este control debe ser realizado en la hora estipulada sin excepciones.', '2017-11-05 21:00:00', '2017-11-05 21:15:00', '2017-11-05 19:42:20', NULL, NULL, 16, 6, 'Controlar acuario'),
(230, 'Reparación rápida', 'Reparar pequeña grieta en parte inferior del acuario.', '2017-11-05 09:00:00', '2017-11-05 09:45:00', NULL, NULL, NULL, 16, 6, 'Reparación'),
(231, 'Limpieza', 'Limpieza exterior del acuario debido a rotura de insumos.', '2017-11-05 11:00:00', '2017-11-05 12:00:00', NULL, NULL, NULL, 16, 6, 'Limpieza'),
(232, 'Alimentar con vitaminas', 'Alimentar peces con alimento con alto contenido de vitaminas.', '2017-11-05 20:30:00', '2017-11-05 20:45:00', '2017-11-05 19:48:20', '', NULL, 16, 6, 'Alimentación'),
(233, 'Control no realizado el dia 4/11', 'Control para compensar la no realización de la tarea del mismo tipo del dia de ayer.', '2017-11-05 08:30:00', '2017-11-05 09:00:00', '2017-11-05 19:41:40', NULL, NULL, 16, 6, 'Controlar acuario'),
(234, 'Limpieza profunda', 'Limpiar el interior del acuario debido a la presencia de una bacteria.', '2017-11-05 13:10:00', '2017-11-05 15:40:00', NULL, NULL, NULL, 16, 6, 'Limpieza'),
(235, 'Agregar clarificador', '', '2017-11-05 10:40:00', '2017-11-05 10:55:00', '2017-11-05 19:47:40', '', NULL, 16, 6, 'Reparación'),
(236, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-05 19:43:00', '2017-11-05 19:43:00', '2017-11-05 19:43:41', NULL, NULL, 16, 7, 'Controlar acuario'),
(237, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-05 19:44:00', '2017-11-05 19:44:00', '2017-11-05 19:44:26', NULL, NULL, 16, 7, 'Controlar acuario'),
(238, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-05 19:44:00', '2017-11-05 19:44:00', '2017-11-05 19:44:48', NULL, NULL, 16, 7, 'Controlar acuario'),
(239, 'Control no planificado', '', '2017-11-05 20:00:00', '2017-11-05 20:30:00', '2017-11-05 19:45:44', NULL, NULL, 16, 7, 'Controlar acuario'),
(240, 'Control no planificado', '7---1--0', '2017-11-05 19:40:00', '2017-11-05 21:40:00', '2017-11-05 19:46:48', NULL, NULL, 16, 7, 'Controlar acuario'),
(241, 'Reparación sistema filtrado', 'Reparar el filtro ', '2017-11-05 21:30:00', '2017-11-05 22:30:00', NULL, NULL, NULL, 16, 6, 'Reparación'),
(242, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-05 19:53:00', '2017-11-05 19:53:00', '2017-11-05 19:53:50', NULL, NULL, 16, 6, 'Controlar acuario'),
(243, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-05 19:57:00', '2017-11-05 19:57:00', '2017-11-05 19:57:55', NULL, NULL, 16, 6, 'Controlar acuario'),
(245, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-05 20:17:00', '2017-11-05 20:17:00', '2017-11-05 20:17:21', NULL, NULL, 16, 7, 'Controlar acuario'),
(246, 'Incorporación de ejemplares', 'Esta tarea fue creada a través de la sección de ejemplares', '2017-11-07 12:45:23', '2017-11-07 12:45:23', '2017-11-07 12:45:23', NULL, NULL, 16, 6, 'Incorporar ejemplares'),
(247, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-07 12:46:00', '2017-11-07 12:46:00', '2017-11-07 12:46:08', NULL, NULL, 16, 6, 'Controlar acuario'),
(248, 'tarea 1 ', 'aca va una descripcion de la tarea ', '2018-04-07 15:00:00', '2018-04-07 17:00:00', NULL, NULL, 11, 16, 6, 'Limpieza'),
(251, 'Quitar ejemplares', 'Esta tarea fue creada a través de la sección de ejemplares', '2017-11-07 15:32:59', '2017-11-07 15:32:59', '2017-11-07 15:32:59', NULL, NULL, 16, 6, 'Quitar ejemplares'),
(254, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-09 03:29:00', '2017-11-09 03:29:00', '2017-11-09 03:29:24', NULL, NULL, 16, 7, 'Controlar acuario'),
(255, 'Alimentación especial', 'Alimentar moderadamente.', '2017-11-09 16:00:00', '2017-11-09 17:00:00', '2017-11-09 15:53:20', 'Exceso de alimento, descartar próxima alimentación.', NULL, 16, 7, 'Alimentación'),
(256, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-09 21:59:00', '2017-11-09 21:59:00', '2017-11-09 21:59:43', NULL, NULL, 16, 7, 'Controlar acuario'),
(257, 'Transferir ejemplares', 'Esta tarea fue creada a través de la sección de ejemplares', '2017-11-09 22:02:11', '2017-11-09 22:02:11', '2017-11-09 22:02:11', NULL, NULL, 16, 6, 'Transferir ejemplares'),
(258, 'Incorporación de ejemplares', 'Esta tarea fue creada a través de la sección de ejemplares', '2017-11-09 22:56:08', '2017-11-09 22:56:08', '2017-11-09 22:56:08', NULL, NULL, 16, 6, 'Incorporar ejemplares'),
(259, 'Quitar ejemplares', 'Esta tarea fue creada a través de la sección de ejemplares', '2017-11-09 23:06:12', '2017-11-09 23:06:12', '2017-11-09 23:06:12', NULL, NULL, 16, 6, 'Quitar ejemplares'),
(260, 'Quitar ejemplares', 'Esta tarea fue creada a través de la sección de ejemplares', '2017-11-09 23:06:12', '2017-11-09 23:06:12', '2017-11-09 23:06:12', NULL, NULL, 16, 7, 'Quitar ejemplares'),
(261, 'Limpieza ligera', '', '2017-11-09 23:30:00', '2017-11-09 23:45:00', '2017-11-09 23:17:24', 'Todo bien.', NULL, 16, 7, 'Limpieza'),
(262, 'Transferir ejemplares', 'Esta tarea fue creada a través de la sección de ejemplares', '2017-11-09 23:24:58', '2017-11-09 23:24:58', '2017-11-09 23:24:58', NULL, NULL, 16, 7, 'Transferir ejemplares'),
(263, 'Transferir ejemplares', 'Esta tarea fue creada a través de la sección de ejemplares', '2017-11-09 23:25:33', '2017-11-09 23:25:33', '2017-11-09 23:25:33', NULL, NULL, 16, 7, 'Transferir ejemplares'),
(264, 'Transferir ejemplares', 'Esta tarea fue creada a través de la sección de ejemplares', '2017-11-09 23:28:12', '2017-11-09 23:28:12', '2017-11-09 23:28:12', NULL, NULL, 16, 6, 'Transferir ejemplares'),
(265, 'Transferir ejemplares', 'Esta tarea fue creada a través de la sección de ejemplares', '2017-11-09 23:30:48', '2017-11-09 23:30:48', '2017-11-09 23:30:48', NULL, NULL, 16, 6, 'Transferir ejemplares'),
(266, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-10 02:11:00', '2017-11-10 02:11:00', '2017-11-10 02:11:33', NULL, NULL, 16, 6, 'Controlar acuario'),
(267, 'Alimentación especial', '', '2017-11-10 15:30:00', '2017-11-10 16:30:00', NULL, NULL, NULL, 16, 6, 'Alimentación'),
(268, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-10 15:36:00', '2017-11-10 15:36:00', '2017-11-10 15:36:06', NULL, NULL, 16, 6, 'Controlar acuario'),
(269, 'Transferir ejemplares', 'Esta tarea fue creada a través de la sección de ejemplares', '2017-11-10 15:40:23', '2017-11-10 15:40:23', '2017-11-10 15:40:23', NULL, NULL, 16, 6, 'Transferir ejemplares'),
(270, 'Transferir ejemplares', 'Esta tarea fue creada a través de la sección de ejemplares', '2017-11-10 22:43:10', '2017-11-10 22:43:10', '2017-11-10 22:43:10', NULL, NULL, 16, 6, 'Transferir ejemplares'),
(271, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-10 22:55:00', '2017-11-10 22:55:00', '2017-11-10 22:55:22', NULL, NULL, 16, 7, 'Controlar acuario'),
(272, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-10 20:07:00', '2017-11-10 20:07:00', '2017-11-10 20:07:40', NULL, NULL, 16, 7, 'Controlar acuario'),
(273, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-10 21:08:00', '2017-11-10 21:08:00', '2017-11-10 21:08:26', NULL, NULL, 16, 7, 'Controlar acuario'),
(274, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-10 22:08:00', '2017-11-10 22:08:00', '2017-11-10 22:08:59', NULL, NULL, 16, 7, 'Controlar acuario'),
(275, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-11 23:40:00', '2017-11-11 23:40:00', '2017-11-11 23:40:58', NULL, NULL, 16, 7, 'Controlar acuario'),
(276, 'Limpieza', '', '2017-11-11 13:50:00', '2017-11-11 14:20:00', '2017-11-11 13:42:53', 'Todo limpio', NULL, 16, 6, 'Limpieza'),
(277, 'Alimentación', '', '2017-11-11 14:50:00', '2017-11-11 15:50:00', '2017-11-11 13:45:11', 'Ok.', NULL, 16, 6, 'Alimentación'),
(278, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-11 13:53:00', '2017-11-11 13:53:00', '2017-11-11 13:53:12', NULL, NULL, 16, 6, 'Controlar acuario'),
(279, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-12 13:13:55', '2017-11-12 13:13:55', '2017-11-12 13:13:55', NULL, NULL, 16, 7, 'Controlar acuario'),
(280, 'Limpieza', '', '2017-11-12 18:00:00', '2017-11-12 18:03:00', NULL, NULL, NULL, 16, 7, 'Limpieza'),
(281, 'Control', '', '2017-11-12 18:30:00', '2017-11-12 18:39:00', NULL, NULL, NULL, 16, 7, 'Controlar acuario'),
(282, 'Limpieza', '', '2017-11-12 18:40:00', '2017-11-12 18:42:00', NULL, NULL, NULL, 16, 7, 'Limpieza'),
(283, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-13 19:45:26', '2017-11-13 19:45:26', '2017-11-13 19:45:26', NULL, NULL, 16, 6, 'Controlar acuario'),
(284, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-13 19:58:04', '2017-11-13 19:58:04', '2017-11-13 19:58:04', NULL, NULL, 16, 6, 'Controlar acuario'),
(285, 'Control', 'Esta tarea fue creada a través de la sección de detalle de acuario', '2017-11-13 19:59:56', '2017-11-13 19:59:56', '2017-11-13 19:59:56', NULL, NULL, 16, 6, 'Controlar acuario'),
(286, 'Control', '', '2017-12-06 18:10:00', '2017-12-06 18:25:00', NULL, NULL, 13, 16, 9, 'Controlar acuario'),
(287, 'Limpieza ', '', '2017-12-06 20:10:00', '2017-12-06 20:25:00', NULL, NULL, 13, 16, 9, 'Limpieza'),
(288, 'Control', '', '2017-12-07 18:20:00', '2017-12-07 18:35:00', NULL, NULL, 13, 16, 9, 'Controlar acuario'),
(289, 'Control', '', '2018-01-10 18:50:00', '2018-01-10 19:05:00', NULL, NULL, 3, 16, 7, 'Controlar acuario'),
(290, 'Limpieza ', '', '2018-01-10 20:50:00', '2018-01-10 21:05:00', NULL, NULL, 3, 16, 7, 'Limpieza'),
(291, 'Limpieza ', '', '2017-12-07 19:10:00', '2017-12-07 19:25:00', NULL, NULL, 13, 16, 9, 'Limpieza'),
(292, 'Reparación rápida', '', '2017-12-07 20:00:00', '2017-12-07 20:15:00', NULL, NULL, 13, 16, 9, 'Reparación'),
(293, 'Control', '', '2017-12-08 12:40:00', '2017-12-08 12:55:00', NULL, NULL, 13, 16, 9, 'Controlar acuario'),
(294, 'Limpieza ', '', '2018-02-14 12:50:00', '2018-02-14 13:05:00', NULL, NULL, 14, 16, 6, 'Limpieza');

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
(1, 246, 4, 6, 1),
(2, 251, 4, 6, -1),
(3, 257, 4, 6, -2),
(4, 257, 4, 7, 2),
(5, 258, 4, 6, 2),
(6, 259, 4, 6, -1),
(7, 260, 4, 7, -1),
(8, 262, 4, 7, -1),
(9, 262, 4, 6, 1),
(10, 263, 4, 7, -1),
(11, 263, 4, 6, 1),
(12, 264, 4, 6, -1),
(13, 264, 4, 7, 1),
(14, 265, 4, 6, -1),
(15, 265, 4, 7, 1),
(16, 269, 4, 6, -1),
(17, 269, 4, 7, 1),
(18, 270, 4, 6, -1),
(19, 270, 4, 7, 1);

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
('Quitar ejemplares'),
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
(1, 'Aquarium', 'Admin', 'aquim', 'admin@gmail.com', '$2y$13$uezXaKAuIOJmRSOx2swB2.pcAnd6OId30QChxdNRdYGBIzKhRBIuG', 1),
(2, 'Alberto', 'García', 'agarcia', 'garcia@gmail.com', '$2y$13$u5cBGilAW2s/sVNIF5c4i.OZE556sx1mqPCOM2hjeR1wJ76ujvV3y', 1),
(16, 'Federico', 'Moro', 'fmoro', 'moro@gmail.com', '$2y$13$.CmZAan61MQxJ2/4E.h67u9AVIg2LYUOL2Xo1SblmrDLjzpOFMtPe', 1),
(17, 'Susana', 'Montero', 'smontero', 'montero@gmail.com', '$2y$13$3aPnTqFnsbSkQv5IBLXYdeTJyQDANwupouovndDWVGLf4LNVjZ/LW', 1),
(19, 'Juan', 'Perez', 'jperez', 'jose@gmail.com', '$2y$13$pAgrzGj.qipBb01N2cRPouK0Qzcc7znK21SosJu8JYlQWkzwVlxlG', 1),
(20, 'Viviana', 'Sanchez', 'vsanchez', 'vsanchez@gmail.com', '$2y$13$kVZsQxkjQw03Fdd.HsTuee5qiVngq0gvmPq0ljtWkprk8hrN0ttd2', 1),
(21, 'Jose', 'Quinteros', 'jquinteros', 'quinteros@gmail.com', '$2y$13$FeEAncLmU15ZHAOXDNGReuwToJoI4WEIAJ3CqZMmx1BNHe2/gkwK.', 1),
(22, 'Pedro', 'Sanchez', 'psanchez', 'psanchez@gmail.com', '$2y$13$5bP2SXI6yKK2wP1UJTXkIOoJxuhxho7BbbTCH9Rxz1DWFeFAvXvg2', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `VALIDACION`
--

DROP TABLE IF EXISTS `VALIDACION`;
CREATE TABLE `VALIDACION` (
  `idVALIDACION` int(11) NOT NULL,
  `FECHAHORA` datetime DEFAULT CURRENT_TIMESTAMP,
  `OBSERVACION` varchar(200) DEFAULT NULL,
  `MOTIVO_RECHAZO_idMotivoRechazo` varchar(45) DEFAULT NULL,
  `PLANIFICACION_idPlanificacion` int(11) NOT NULL,
  `USUARIO_idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `VALIDACION`
--

INSERT INTO `VALIDACION` (`idVALIDACION`, `FECHAHORA`, `OBSERVACION`, `MOTIVO_RECHAZO_idMotivoRechazo`, `PLANIFICACION_idPlanificacion`, `USUARIO_idUsuario`) VALUES
(2, '2017-11-23 18:08:58', '', 'Escasez de tareas', 11, 2),
(3, '2017-12-06 16:10:34', '', 'Escasez de tareas', 17, 2);

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
  ADD UNIQUE KEY `TAREA_idTarea` (`TAREA_idTarea`),
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
  MODIFY `idAcuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `CONDICION_AMBIENTAL`
--
ALTER TABLE `CONDICION_AMBIENTAL`
  MODIFY `idCondicionAmbiental` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `ESPECIE`
--
ALTER TABLE `ESPECIE`
  MODIFY `idEspecie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `INSUMO`
--
ALTER TABLE `INSUMO`
  MODIFY `idInsumo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `NOTIFICACION`
--
ALTER TABLE `NOTIFICACION`
  MODIFY `idNOTIFICACION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `PLANIFICACION`
--
ALTER TABLE `PLANIFICACION`
  MODIFY `idPlanificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `TAREA`
--
ALTER TABLE `TAREA`
  MODIFY `idTarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;
--
-- AUTO_INCREMENT de la tabla `TAREA_EJEMPLAR`
--
ALTER TABLE `TAREA_EJEMPLAR`
  MODIFY `idTareaEjemplar` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
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
  MODIFY `idVALIDACION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
DELIMITER $$
--
-- Eventos
--
DROP EVENT IF EXISTS `job_Notification`$$
CREATE DEFINER=`root`@`localhost` EVENT `job_Notification` ON SCHEDULE EVERY 1 MINUTE STARTS '2017-11-07 23:59:00' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'evento que se ejecuta 1 vez al dia, para generar notificaciones' DO CALL obtenerTareasVencidas()$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
