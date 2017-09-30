-- phpmyadmin sql dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- servidor: localhost:3306
-- tiempo de generación: 30-09-2017 a las 15:56:38
-- versión del servidor: 5.7.19-0ubuntu0.17.04.1
-- versión de php: 7.0.22-0ubuntu0.17.04.1

set sql_mode = "no_auto_value_on_zero";
set time_zone = "+00:00";


/*!40101 set @old_character_set_client=@@character_set_client */;
/*!40101 set @old_character_set_results=@@character_set_results */;
/*!40101 set @old_collation_connection=@@collation_connection */;
/*!40101 set names utf8mb4 */;

--
-- base de datos: `aquasoft`
--
create database if not exists `aquasoft` default character set utf8 collate utf8_general_ci;
use `aquasoft`;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `acuario`
--

drop table if exists `acuario`;
create table `acuario` (
  `idacuario` int(11) not null,
  `nombre` varchar(45) not null,
  `descripcion` varchar(200) default null,
  `espaciodisponible` int(11) not null,
  `activo` tinyint(1) default '1'
) engine=innodb default charset=utf8;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `acuario_usuario`
--

drop table if exists `acuario_usuario`;
create table `acuario_usuario` (
  `acuario_idacuario` int(11) not null,
  `usuario_idusuario` int(11) not null
) engine=innodb default charset=utf8;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `auth_assignment`
--

drop table if exists `auth_assignment`;
create table `auth_assignment` (
  `item_name` varchar(64) collate utf8_unicode_ci not null,
  `user_id` int(11) not null,
  `created_at` int(11) default null
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

--
-- volcado de datos para la tabla `auth_assignment`
--

insert into `auth_assignment` (`item_name`, `user_id`, `created_at`) values
('administrador', 1, 1506560512),
('encargado', 2, 1506560523),
('encargado', 18, 1506560537),
('especialista', 16, 1506560528),
('especialista', 17, 1506560533);

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `auth_item`
--

drop table if exists `auth_item`;
create table `auth_item` (
  `name` varchar(64) collate utf8_unicode_ci not null,
  `type` smallint(6) not null,
  `description` text collate utf8_unicode_ci,
  `rule_name` varchar(64) collate utf8_unicode_ci default null,
  `data` blob,
  `created_at` int(11) default null,
  `updated_at` int(11) default null
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

--
-- volcado de datos para la tabla `auth_item`
--

insert into `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) values
('/admin/*', 2, null, null, null, 1506560356, 1506560356),
('/admin/assignment/*', 2, null, null, null, 1506560342, 1506560342),
('/admin/assignment/assign', 2, null, null, null, 1506560335, 1506560335),
('/admin/assignment/index', 2, null, null, null, 1506560335, 1506560335),
('/admin/assignment/revoke', 2, null, null, null, 1506560335, 1506560335),
('/admin/assignment/view', 2, null, null, null, 1506560335, 1506560335),
('/admin/default/*', 2, null, null, null, 1506560342, 1506560342),
('/admin/default/index', 2, null, null, null, 1506560336, 1506560336),
('/admin/menu/*', 2, null, null, null, 1506560342, 1506560342),
('/admin/menu/create', 2, null, null, null, 1506560339, 1506560339),
('/admin/menu/delete', 2, null, null, null, 1506560339, 1506560339),
('/admin/menu/index', 2, null, null, null, 1506560339, 1506560339),
('/admin/menu/update', 2, null, null, null, 1506560339, 1506560339),
('/admin/menu/view', 2, null, null, null, 1506560339, 1506560339),
('/admin/permission/*', 2, null, null, null, 1506560355, 1506560355),
('/admin/permission/assign', 2, null, null, null, 1506560345, 1506560345),
('/admin/permission/create', 2, null, null, null, 1506560345, 1506560345),
('/admin/permission/delete', 2, null, null, null, 1506560345, 1506560345),
('/admin/permission/index', 2, null, null, null, 1506560345, 1506560345),
('/admin/permission/remove', 2, null, null, null, 1506560345, 1506560345),
('/admin/permission/update', 2, null, null, null, 1506560345, 1506560345),
('/admin/permission/view', 2, null, null, null, 1506560345, 1506560345),
('/admin/role/*', 2, null, null, null, 1506560355, 1506560355),
('/admin/role/assign', 2, null, null, null, 1506560355, 1506560355),
('/admin/role/create', 2, null, null, null, 1506560355, 1506560355),
('/admin/role/delete', 2, null, null, null, 1506560355, 1506560355),
('/admin/role/index', 2, null, null, null, 1506560355, 1506560355),
('/admin/role/remove', 2, null, null, null, 1506560355, 1506560355),
('/admin/role/update', 2, null, null, null, 1506560355, 1506560355),
('/admin/role/view', 2, null, null, null, 1506560355, 1506560355),
('/admin/route/*', 2, null, null, null, 1506560355, 1506560355),
('/admin/route/assign', 2, null, null, null, 1506560355, 1506560355),
('/admin/route/create', 2, null, null, null, 1506560355, 1506560355),
('/admin/route/index', 2, null, null, null, 1506560355, 1506560355),
('/admin/route/refresh', 2, null, null, null, 1506560355, 1506560355),
('/admin/route/remove', 2, null, null, null, 1506560355, 1506560355),
('/admin/rule/*', 2, null, null, null, 1506560356, 1506560356),
('/admin/rule/create', 2, null, null, null, 1506560355, 1506560355),
('/admin/rule/delete', 2, null, null, null, 1506560356, 1506560356),
('/admin/rule/index', 2, null, null, null, 1506560355, 1506560355),
('/admin/rule/update', 2, null, null, null, 1506560356, 1506560356),
('/admin/rule/view', 2, null, null, null, 1506560355, 1506560355),
('/admin/user/*', 2, null, null, null, 1506560356, 1506560356),
('/admin/user/activate', 2, null, null, null, 1506560356, 1506560356),
('/admin/user/change-password', 2, null, null, null, 1506560356, 1506560356),
('/admin/user/delete', 2, null, null, null, 1506560356, 1506560356),
('/admin/user/index', 2, null, null, null, 1506560356, 1506560356),
('/admin/user/login', 2, null, null, null, 1506560356, 1506560356),
('/admin/user/logout', 2, null, null, null, 1506560356, 1506560356),
('/admin/user/request-password-reset', 2, null, null, null, 1506560356, 1506560356),
('/admin/user/reset-password', 2, null, null, null, 1506560356, 1506560356),
('/admin/user/signup', 2, null, null, null, 1506560356, 1506560356),
('/admin/user/view', 2, null, null, null, 1506560356, 1506560356),
('/debug/*', 2, null, null, null, 1506560367, 1506560367),
('/debug/default/*', 2, null, null, null, 1506560367, 1506560367),
('/debug/default/db-explain', 2, null, null, null, 1506560366, 1506560366),
('/debug/default/download-mail', 2, null, null, null, 1506560367, 1506560367),
('/debug/default/index', 2, null, null, null, 1506560366, 1506560366),
('/debug/default/toolbar', 2, null, null, null, 1506560367, 1506560367),
('/debug/default/view', 2, null, null, null, 1506560367, 1506560367),
('/debug/user/*', 2, null, null, null, 1506560367, 1506560367),
('/debug/user/reset-identity', 2, null, null, null, 1506560367, 1506560367),
('/debug/user/set-identity', 2, null, null, null, 1506560367, 1506560367),
('/gii/*', 2, null, null, null, 1506560367, 1506560367),
('/gii/default/*', 2, null, null, null, 1506560367, 1506560367),
('/gii/default/action', 2, null, null, null, 1506560367, 1506560367),
('/gii/default/diff', 2, null, null, null, 1506560367, 1506560367),
('/gii/default/index', 2, null, null, null, 1506560367, 1506560367),
('/gii/default/preview', 2, null, null, null, 1506560367, 1506560367),
('/gii/default/view', 2, null, null, null, 1506560367, 1506560367),
('/site/error', 2, null, null, null, 1506560372, 1506560372),
('/site/index', 2, null, null, null, 1506560373, 1506560373),
('/site/login', 2, null, null, null, 1506560373, 1506560373),
('/site/logout', 2, null, null, null, 1506560373, 1506560373),
('/user/*', 2, null, null, null, 1506560602, 1506560602),
('/user/create', 2, null, null, null, 1506560370, 1506560370),
('/user/delete', 2, null, null, null, 1506560370, 1506560370),
('/user/index', 2, null, null, null, 1506560370, 1506560370),
('/user/update', 2, null, null, null, 1506560370, 1506560370),
('/user/view', 2, null, null, null, 1506560370, 1506560370),
('administrador', 1, null, null, null, 1506560408, 1506560408),
('encargado', 1, null, null, null, 1506560453, 1506560453),
('especialista', 1, null, null, null, 1506560482, 1506560482);

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `auth_item_child`
--

drop table if exists `auth_item_child`;
create table `auth_item_child` (
  `parent` varchar(64) collate utf8_unicode_ci not null,
  `child` varchar(64) collate utf8_unicode_ci not null
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

--
-- volcado de datos para la tabla `auth_item_child`
--

insert into `auth_item_child` (`parent`, `child`) values
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
-- estructura de tabla para la tabla `auth_rule`
--

drop table if exists `auth_rule`;
create table `auth_rule` (
  `name` varchar(64) collate utf8_unicode_ci not null,
  `data` blob,
  `created_at` int(11) default null,
  `updated_at` int(11) default null
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `condicion_ambiental`
--

drop table if exists `condicion_ambiental`;
create table `condicion_ambiental` (
  `idcondicion_ambiental` int(11) not null,
  `ph` double not null,
  `temperatura` double not null,
  `salinidad` double not null,
  `lux` double not null,
  `co2` double not null,
  `acuario_idacuario` int(11) not null,
  `tarea_idtarea` int(11) not null
) engine=innodb default charset=utf8;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `ejemplar`
--

drop table if exists `ejemplar`;
create table `ejemplar` (
  `especie_idespecie` int(11) not null,
  `acuario_idacuario` int(11) not null,
  `cantidad` int(11) not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `especie`
--

drop table if exists `especie`;
create table `especie` (
  `idespecie` int(11) not null,
  `nombre` varchar(45) collate utf8_spanish_ci not null,
  `descripcion` varchar(200) collate utf8_spanish_ci default null,
  `minph` double not null,
  `maxph` double not null,
  `mintemp` double not null,
  `maxtemp` double not null,
  `minsalinidad` double not null,
  `maxsalinidad` double not null,
  `minlux` double not null,
  `maxlux` double not null,
  `minespacio` int(11) not null,
  `minco2` double not null,
  `maxco2` double not null,
  `activo` tinyint(1) default '1'
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `estado_planificacion`
--

drop table if exists `estado_planificacion`;
create table `estado_planificacion` (
  `idestado_planificacion` varchar(45) not null
) engine=innodb default charset=utf8;

--
-- volcado de datos para la tabla `estado_planificacion`
--

insert into `estado_planificacion` (`idestado_planificacion`) values
('aprobado'),
('rechazado'),
('sinverificar');

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `insumo`
--

drop table if exists `insumo`;
create table `insumo` (
  `idinsumo` int(11) not null,
  `nombre` varchar(45) not null,
  `descripcion` varchar(200) default null,
  `stock` int(11) not null,
  `activo` tinyint(1) default '1',
  `tipo_tarea_idtipo_tarea` varchar(45) not null
) engine=innodb default charset=utf8;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `menu`
--

drop table if exists `menu`;
create table `menu` (
  `id` int(11) not null,
  `name` varchar(128) not null,
  `parent` int(11) default null,
  `route` varchar(255) default null,
  `order` int(11) default null,
  `data` blob
) engine=innodb default charset=utf8;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `migration`
--

drop table if exists `migration`;
create table `migration` (
  `version` varchar(180) not null,
  `apply_time` int(11) default null
) engine=innodb default charset=utf8;

--
-- volcado de datos para la tabla `migration`
--

insert into `migration` (`version`, `apply_time`) values
('m000000_000000_base', 1506399989),
('m140506_102106_rbac_init', 1506400838),
('m140602_111327_create_menu_table', 1506452642),
('m160312_050000_create_user', 1506452643);

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `motivo_rechazo`
--

drop table if exists `motivo_rechazo`;
create table `motivo_rechazo` (
  `idmotivo_rechazo` varchar(45) not null
) engine=innodb default charset=utf8;

--
-- volcado de datos para la tabla `motivo_rechazo`
--

insert into `motivo_rechazo` (`idmotivo_rechazo`) values
('escasez de tareas'),
('incorrecta distribución de tareas'),
('incumplimiento de politicas'),
('otro');

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `notificacion`
--

drop table if exists `notificacion`;
create table `notificacion` (
  `idnotificacion` int(11) not null,
  `fechahora` datetime not null default current_timestamp,
  `tarea_idtarea` int(11) not null,
  `origen_notificacion_idorigen_notificacion` varchar(45) not null
) engine=innodb default charset=utf8;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `origen_notificacion`
--

drop table if exists `origen_notificacion`;
create table `origen_notificacion` (
  `idorigen_notificacion` varchar(45) not null
) engine=innodb default charset=utf8;

--
-- volcado de datos para la tabla `origen_notificacion`
--

insert into `origen_notificacion` (`idorigen_notificacion`) values
('hábitat riesgoso'),
('tarea no realizada');

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `planificacion`
--

drop table if exists `planificacion`;
create table `planificacion` (
  `idplanificacion` int(11) not null,
  `titulo` varchar(45) not null,
  `aniomes` date not null,
  `fechahoracreacion` datetime not null default current_timestamp,
  `activo` tinyint(1) default '1',
  `estado_planificacion_idestado_planificacion` varchar(45) not null,
  `acuario_usuario_acuario_idacuario` int(11) not null,
  `acuario_usuario_usuario_idusuario` int(11) not null
) engine=innodb default charset=utf8;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `rol`
--

drop table if exists `rol`;
create table `rol` (
  `idrol` int(11) not null,
  `nombrerol` varchar(45) not null,
  `descripcion` varchar(200) default null
) engine=innodb default charset=utf8;

--
-- volcado de datos para la tabla `rol`
--

insert into `rol` (`idrol`, `nombrerol`, `descripcion`) values
(1, 'especialista', 'perfil del personal responsable del mantenimiento de un grupo de acuarios'),
(2, 'encargado', 'perfil del personal responsable de la organización del acuarium');

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tarea`
--

drop table if exists `tarea`;
create table `tarea` (
  `idtarea` int(11) not null,
  `titulo` varchar(45) not null,
  `descripcion` varchar(200) default null,
  `fechahorainicio` datetime not null,
  `fechahorafin` datetime not null,
  `fechahorarealizacion` datetime default null,
  `planificacion_idplanificacion` int(11) default null comment 'si este campo está vacío significa que la tareas a sido creada fuera de la planificacion mensual.',
  `usuario_idusuario` int(11) default null,
  `tipo_tarea_idtipo_tarea` varchar(45) not null
) engine=innodb default charset=utf8;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tarea_insumo`
--

drop table if exists `tarea_insumo`;
create table `tarea_insumo` (
  `insumo_idinsumo` int(11) not null,
  `tarea_idtarea` int(11) not null,
  `cantidad` int(11) not null
) engine=innodb default charset=utf8;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tipo_tarea`
--

drop table if exists `tipo_tarea`;
create table `tipo_tarea` (
  `idtipo_tarea` varchar(45) not null
) engine=innodb default charset=utf8;

--
-- volcado de datos para la tabla `tipo_tarea`
--

insert into `tipo_tarea` (`idtipo_tarea`) values
('alimentación'),
('controlar'),
('limpieza'),
('reparación'),
('transferir');

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `user`
--

drop table if exists `user`;
create table `user` (
  `id` int(11) not null,
  `username` varchar(32) collate utf8_unicode_ci not null,
  `auth_key` varchar(32) collate utf8_unicode_ci not null,
  `password_hash` varchar(255) collate utf8_unicode_ci not null,
  `password_reset_token` varchar(255) collate utf8_unicode_ci default null,
  `email` varchar(255) collate utf8_unicode_ci not null,
  `status` smallint(6) not null default '10',
  `created_at` int(11) not null,
  `updated_at` int(11) not null
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `usuarios`
--

drop table if exists `usuarios`;
create table `usuarios` (
  `id_usuario` int(11) not null,
  `nombre` varchar(45) not null,
  `apellido` varchar(45) not null,
  `nombre_usuario` varchar(45) not null,
  `email` varchar(45) default null,
  `contrasenia` varchar(255) not null,
  `activo` tinyint(1) default '1'
) engine=innodb default charset=utf8;

--
-- volcado de datos para la tabla `usuarios`
--

insert into `usuarios` (`id_usuario`, `nombre`, `apellido`, `nombre_usuario`, `email`, `contrasenia`, `activo`) values
(1, 'emilio', 'melo', 'emelo', 'emelo@gmail.com', '$2y$13$/0ilfzmsxgdsqkkurzyau.kcqufsrmb6jvxic4.re4kbxpyyweo6w', 1),
(2, 'romina', 'bertini', 'rbertini', 'romina@gmail.com', '$2y$13$u5cbgilaw2s/svnif5c4i.oze556sx1mqpcom2hjer1wj76ujvv3y', 1),
(16, 'facundo', 'reyna', 'freyna', 'facundo@gmail.com', '$2y$13$gma4suonh8nxut4umusaaokm4clibgyofwkclw8akh32txhsj1sku', 1),
(17, 'lía', 'moreno', 'lmoreno', 'lia@gmail.com', '$2y$13$ggumkquovtuvk2tp70zo6o2bgghqlo4arszttauevumqvyohnm4o6', 0),
(18, 'juan', 'perez', 'jperez', 'juan@gmail.com', '$2y$13$588gd.6paf3gt4.vpqptv.sawoq9auc8wonwountupcplq8ba.n3m', 1);

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `validacion`
--

drop table if exists `validacion`;
create table `validacion` (
  `idvalidacion` int(11) not null,
  `fechahora` datetime not null default current_timestamp,
  `observacion` varchar(200) default null,
  `planificacion_idplanificacion` int(11) not null,
  `usuario_idusuario` int(11) not null,
  `motivo_rechazo_idmotivo_rechazo` varchar(45) not null
) engine=innodb default charset=utf8;

--
-- índices para tablas volcadas
--

--
-- indices de la tabla `acuario`
--
alter table `acuario`
  add primary key (`idacuario`);

--
-- indices de la tabla `acuario_usuario`
--
alter table `acuario_usuario`
  add primary key (`acuario_idacuario`,`usuario_idusuario`),
  add key `fk_idusuario_idx` (`usuario_idusuario`),
  add key `fk_idacuario_idx` (`acuario_idacuario`);

--
-- indices de la tabla `auth_assignment`
--
alter table `auth_assignment`
  add primary key (`item_name`,`user_id`),
  add key `fk_asignment_usuarios` (`user_id`);

--
-- indices de la tabla `auth_item`
--
alter table `auth_item`
  add primary key (`name`),
  add key `rule_name` (`rule_name`),
  add key `idx-auth_item-type` (`type`);

--
-- indices de la tabla `auth_item_child`
--
alter table `auth_item_child`
  add primary key (`parent`,`child`),
  add key `child` (`child`);

--
-- indices de la tabla `auth_rule`
--
alter table `auth_rule`
  add primary key (`name`);

--
-- indices de la tabla `condicion_ambiental`
--
alter table `condicion_ambiental`
  add primary key (`idcondicion_ambiental`),
  add key `fk_condicion_ambiental_acuario1_idx` (`acuario_idacuario`),
  add key `fk_condicion_ambiental_tarea1_idx` (`tarea_idtarea`);

--
-- indices de la tabla `ejemplar`
--
alter table `ejemplar`
  add primary key (`especie_idespecie`,`acuario_idacuario`),
  add key `fk_idacuario_idx` (`acuario_idacuario`),
  add key `fk_idespecie_idx` (`especie_idespecie`);

--
-- indices de la tabla `especie`
--
alter table `especie`
  add primary key (`idespecie`);

--
-- indices de la tabla `estado_planificacion`
--
alter table `estado_planificacion`
  add primary key (`idestado_planificacion`);

--
-- indices de la tabla `insumo`
--
alter table `insumo`
  add primary key (`idinsumo`),
  add key `fk_insumo_tipo_tarea1_idx` (`tipo_tarea_idtipo_tarea`);

--
-- indices de la tabla `menu`
--
alter table `menu`
  add primary key (`id`),
  add key `parent` (`parent`);

--
-- indices de la tabla `migration`
--
alter table `migration`
  add primary key (`version`);

--
-- indices de la tabla `motivo_rechazo`
--
alter table `motivo_rechazo`
  add primary key (`idmotivo_rechazo`);

--
-- indices de la tabla `notificacion`
--
alter table `notificacion`
  add primary key (`idnotificacion`),
  add key `fk_notificacion_tarea1_idx` (`tarea_idtarea`),
  add key `fk_notificacion_origen_notificacion1_idx` (`origen_notificacion_idorigen_notificacion`);

--
-- indices de la tabla `origen_notificacion`
--
alter table `origen_notificacion`
  add primary key (`idorigen_notificacion`);

--
-- indices de la tabla `planificacion`
--
alter table `planificacion`
  add primary key (`idplanificacion`),
  add key `fk_planificacion_estado_planificacion1_idx` (`estado_planificacion_idestado_planificacion`),
  add key `fk_planificacion_acuario_usuario1_idx` (`acuario_usuario_acuario_idacuario`,`acuario_usuario_usuario_idusuario`);

--
-- indices de la tabla `rol`
--
alter table `rol`
  add primary key (`idrol`);

--
-- indices de la tabla `tarea`
--
alter table `tarea`
  add primary key (`idtarea`),
  add key `fk_tarea_planificacion1_idx` (`planificacion_idplanificacion`),
  add key `fk_tarea_usuario1_idx` (`usuario_idusuario`),
  add key `fk_tarea_tipo_tarea1_idx` (`tipo_tarea_idtipo_tarea`);

--
-- indices de la tabla `tarea_insumo`
--
alter table `tarea_insumo`
  add primary key (`insumo_idinsumo`,`tarea_idtarea`),
  add key `fk_insumo_has_tarea_tarea1_idx` (`tarea_idtarea`),
  add key `fk_insumo_has_tarea_insumo1_idx` (`insumo_idinsumo`);

--
-- indices de la tabla `tipo_tarea`
--
alter table `tipo_tarea`
  add primary key (`idtipo_tarea`);

--
-- indices de la tabla `user`
--
alter table `user`
  add primary key (`id`);

--
-- indices de la tabla `usuarios`
--
alter table `usuarios`
  add primary key (`id_usuario`);

--
-- indices de la tabla `validacion`
--
alter table `validacion`
  add primary key (`idvalidacion`),
  add key `fk_validacion_planificacion1_idx` (`planificacion_idplanificacion`),
  add key `fk_validacion_usuario1_idx` (`usuario_idusuario`),
  add key `fk_validacion_motivo_rechazo1_idx` (`motivo_rechazo_idmotivo_rechazo`);

--
-- auto_increment de las tablas volcadas
--

--
-- auto_increment de la tabla `acuario`
--
alter table `acuario`
  modify `idacuario` int(11) not null auto_increment;
--
-- auto_increment de la tabla `condicion_ambiental`
--
alter table `condicion_ambiental`
  modify `idcondicion_ambiental` int(11) not null auto_increment;
--
-- auto_increment de la tabla `especie`
--
alter table `especie`
  modify `idespecie` int(11) not null auto_increment;
--
-- auto_increment de la tabla `insumo`
--
alter table `insumo`
  modify `idinsumo` int(11) not null auto_increment;
--
-- auto_increment de la tabla `menu`
--
alter table `menu`
  modify `id` int(11) not null auto_increment;
--
-- auto_increment de la tabla `notificacion`
--
alter table `notificacion`
  modify `idnotificacion` int(11) not null auto_increment;
--
-- auto_increment de la tabla `planificacion`
--
alter table `planificacion`
  modify `idplanificacion` int(11) not null auto_increment;
--
-- auto_increment de la tabla `rol`
--
alter table `rol`
  modify `idrol` int(11) not null auto_increment, auto_increment=3;
--
-- auto_increment de la tabla `tarea`
--
alter table `tarea`
  modify `idtarea` int(11) not null auto_increment;
--
-- auto_increment de la tabla `user`
--
alter table `user`
  modify `id` int(11) not null auto_increment;
--
-- auto_increment de la tabla `usuarios`
--
alter table `usuarios`
  modify `id_usuario` int(11) not null auto_increment, auto_increment=19;
--
-- auto_increment de la tabla `validacion`
--
alter table `validacion`
  modify `idvalidacion` int(11) not null auto_increment;
--
-- restricciones para tablas volcadas
--

--
-- filtros para la tabla `acuario_usuario`
--
alter table `acuario_usuario`
  add constraint `fk_acuario_usuario_idacuario` foreign key (`acuario_idacuario`) references `acuario` (`idacuario`) on delete no action on update no action,
  add constraint `fk_acuario_usuario_idusuario` foreign key (`usuario_idusuario`) references `usuarios` (`id_usuario`) on delete no action on update no action;

--
-- filtros para la tabla `auth_assignment`
--
alter table `auth_assignment`
  add constraint `auth_assignment_ibfk_1` foreign key (`item_name`) references `auth_item` (`name`) on delete cascade on update cascade,
  add constraint `fk_asignment_usuarios` foreign key (`user_id`) references `usuarios` (`id_usuario`) on delete cascade on update cascade;

--
-- filtros para la tabla `auth_item`
--
alter table `auth_item`
  add constraint `auth_item_ibfk_1` foreign key (`rule_name`) references `auth_rule` (`name`) on delete set null on update cascade;

--
-- filtros para la tabla `auth_item_child`
--
alter table `auth_item_child`
  add constraint `auth_item_child_ibfk_1` foreign key (`parent`) references `auth_item` (`name`) on delete cascade on update cascade,
  add constraint `auth_item_child_ibfk_2` foreign key (`child`) references `auth_item` (`name`) on delete cascade on update cascade;

--
-- filtros para la tabla `condicion_ambiental`
--
alter table `condicion_ambiental`
  add constraint `fk_condambiental_idacuario` foreign key (`acuario_idacuario`) references `acuario` (`idacuario`) on delete no action on update no action,
  add constraint `fk_condambiental_idtarea` foreign key (`tarea_idtarea`) references `tarea` (`idtarea`) on delete no action on update no action;

--
-- filtros para la tabla `ejemplar`
--
alter table `ejemplar`
  add constraint `fk_especie_idacuario` foreign key (`acuario_idacuario`) references `acuario` (`idacuario`) on delete no action on update no action,
  add constraint `fk_especie_idespecie` foreign key (`especie_idespecie`) references `especie` (`idespecie`) on delete no action on update no action;

--
-- filtros para la tabla `insumo`
--
alter table `insumo`
  add constraint `fk_insumo_idtipo_tarea` foreign key (`tipo_tarea_idtipo_tarea`) references `tipo_tarea` (`idtipo_tarea`) on delete no action on update no action;

--
-- filtros para la tabla `menu`
--
alter table `menu`
  add constraint `menu_ibfk_1` foreign key (`parent`) references `menu` (`id`) on delete set null on update cascade;

--
-- filtros para la tabla `notificacion`
--
alter table `notificacion`
  add constraint `fk_notificacion_idorigen_notificacion` foreign key (`origen_notificacion_idorigen_notificacion`) references `origen_notificacion` (`idorigen_notificacion`) on delete no action on update no action,
  add constraint `fk_notificacion_idtarea` foreign key (`tarea_idtarea`) references `tarea` (`idtarea`) on delete no action on update no action;

--
-- filtros para la tabla `planificacion`
--
alter table `planificacion`
  add constraint `fk_planificacion_acuario_usuario1` foreign key (`acuario_usuario_acuario_idacuario`,`acuario_usuario_usuario_idusuario`) references `acuario_usuario` (`acuario_idacuario`, `usuario_idusuario`) on delete no action on update no action,
  add constraint `fk_planificacion_idestado_planificacion` foreign key (`estado_planificacion_idestado_planificacion`) references `estado_planificacion` (`idestado_planificacion`) on delete no action on update no action;

--
-- filtros para la tabla `tarea`
--
alter table `tarea`
  add constraint `fk_tarea_idplanificacion` foreign key (`planificacion_idplanificacion`) references `planificacion` (`idplanificacion`) on delete no action on update no action,
  add constraint `fk_tarea_idtipo_tarea` foreign key (`tipo_tarea_idtipo_tarea`) references `tipo_tarea` (`idtipo_tarea`) on delete no action on update no action,
  add constraint `fk_tarea_idusuario` foreign key (`usuario_idusuario`) references `usuarios` (`id_usuario`) on delete no action on update no action;

--
-- filtros para la tabla `tarea_insumo`
--
alter table `tarea_insumo`
  add constraint `fk_tarea_insumo_idinsumo` foreign key (`insumo_idinsumo`) references `insumo` (`idinsumo`) on delete no action on update no action,
  add constraint `fk_tarea_insumo_idtarea` foreign key (`tarea_idtarea`) references `tarea` (`idtarea`) on delete no action on update no action;

--
-- filtros para la tabla `validacion`
--
alter table `validacion`
  add constraint `fk_validacion_idmotivo_rechazo` foreign key (`motivo_rechazo_idmotivo_rechazo`) references `motivo_rechazo` (`idmotivo_rechazo`) on delete no action on update no action,
  add constraint `fk_validacion_idplanificacion` foreign key (`planificacion_idplanificacion`) references `planificacion` (`idplanificacion`) on delete no action on update no action,
  add constraint `fk_validacion_idusuario` foreign key (`usuario_idusuario`) references `usuarios` (`id_usuario`) on delete no action on update no action;

/*!40101 set character_set_client=@old_character_set_client */;
/*!40101 set character_set_results=@old_character_set_results */;
/*!40101 set collation_connection=@old_collation_connection */;
