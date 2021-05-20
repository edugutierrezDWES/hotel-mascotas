-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 20-05-2021 a las 17:39:21
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotelmascotas6`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

DROP TABLE IF EXISTS `habitacion`;
CREATE TABLE IF NOT EXISTS `habitacion` (
  `id_hab` varchar(80) NOT NULL,
  `tipo_Hab` varchar(80) NOT NULL,
  PRIMARY KEY (`id_hab`),
  KEY `FK_HabitacionTipoHab` (`tipo_Hab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

DROP TABLE IF EXISTS `mascota`;
CREATE TABLE IF NOT EXISTS `mascota` (
  `id_mascota` varchar(80) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `tipo` enum('gato','perro') NOT NULL,
  `raza` varchar(80) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `id_usuario` varchar(80) NOT NULL,
  PRIMARY KEY (`id_mascota`),
  KEY `FK_MascotaUsuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE IF NOT EXISTS `reserva` (
  `id_reserva` varchar(80) NOT NULL,
  `fecha_reserva` datetime NOT NULL,
  `tipo` enum('normal','vip','supervip') NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `Precio_Total` double NOT NULL,
  `estado` enum('en espera','en progreso','finalizado','abandonado','cancelado') NOT NULL DEFAULT 'en espera',
  PRIMARY KEY (`id_reserva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_habitacion`
--

DROP TABLE IF EXISTS `reserva_habitacion`;
CREATE TABLE IF NOT EXISTS `reserva_habitacion` (
  `id_hab` varchar(80) NOT NULL,
  `id_reserva` varchar(80) NOT NULL,
  PRIMARY KEY (`id_hab`,`id_reserva`),
  KEY `FK_HabitacionReservaID_Reserva` (`id_reserva`),
  KEY `FK_HabitacionReservaID_Habitacion` (`id_hab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_mascota`
--

DROP TABLE IF EXISTS `reserva_mascota`;
CREATE TABLE IF NOT EXISTS `reserva_mascota` (
  `id_mascota` varchar(80) NOT NULL,
  `id_reserva` varchar(80) NOT NULL,
  PRIMARY KEY (`id_mascota`,`id_reserva`),
  KEY `FK_MascotaReservaID_Reserva` (`id_reserva`),
  KEY `FK_MascotaReservaID_Mascota` (`id_mascota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_habitacion`
--

DROP TABLE IF EXISTS `tipo_habitacion`;
CREATE TABLE IF NOT EXISTS `tipo_habitacion` (
  `tipo_Hab` varchar(80) NOT NULL,
  `precio_noche` float NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`tipo_Hab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` varchar(80) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `email` varchar(160) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `fecha_alta` date NOT NULL,
  `fecha_baja` date DEFAULT NULL,
  `rol` enum('cliente','empleado','admin') NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_reservas_resumen`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `view_reservas_resumen`;
CREATE TABLE IF NOT EXISTS `view_reservas_resumen` (
`id_reserva` varchar(80)
,`email` varchar(160)
,`tipo_reserva` enum('normal','vip','supervip')
,`tipo_Hab` varchar(80)
,`fecha_inicio` date
,`fecha_final` date
,`Precio_Total` double
,`estado_reserva` enum('en espera','en progreso','finalizado','abandonado','cancelado')
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_reserva_datoscompletos`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `view_reserva_datoscompletos`;
CREATE TABLE IF NOT EXISTS `view_reserva_datoscompletos` (
`id_reserva` varchar(80)
,`id_usuario` varchar(80)
,`email` varchar(160)
,`tipo_reserva` enum('normal','vip','supervip')
,`tipo_Hab` varchar(80)
,`habitacion` varchar(80)
,`fecha_inicio` date
,`fecha_final` date
,`Precio_Total` double
,`estado_reserva` enum('en espera','en progreso','finalizado','abandonado','cancelado')
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_reserva_mascota_info`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `view_reserva_mascota_info`;
CREATE TABLE IF NOT EXISTS `view_reserva_mascota_info` (
`id_reserva` varchar(80)
,`id_mascota` varchar(80)
,`nombre` varchar(80)
,`tipo` enum('gato','perro')
);

-- --------------------------------------------------------

--
-- Estructura para la vista `view_reservas_resumen`
--
DROP TABLE IF EXISTS `view_reservas_resumen`;

DROP VIEW IF EXISTS `view_reservas_resumen`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_reservas_resumen`  AS  select `reserva`.`id_reserva` AS `id_reserva`,`usuario`.`email` AS `email`,`reserva`.`tipo` AS `tipo_reserva`,`habitacion`.`tipo_Hab` AS `tipo_Hab`,`reserva`.`fecha_inicio` AS `fecha_inicio`,`reserva`.`fecha_final` AS `fecha_final`,`reserva`.`Precio_Total` AS `Precio_Total`,`reserva`.`estado` AS `estado_reserva` from (((((`reserva` join `reserva_mascota` on((`reserva`.`id_reserva` = `reserva_mascota`.`id_reserva`))) join `reserva_habitacion` on((`reserva`.`id_reserva` = `reserva_habitacion`.`id_reserva`))) join `mascota` on((`reserva_mascota`.`id_mascota` = `mascota`.`id_mascota`))) join `usuario` on((`mascota`.`id_usuario` = `usuario`.`id_usuario`))) join `habitacion` on((`reserva_habitacion`.`id_hab` = `habitacion`.`id_hab`))) group by `reserva`.`id_reserva` order by `reserva`.`fecha_inicio` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_reserva_datoscompletos`
--
DROP TABLE IF EXISTS `view_reserva_datoscompletos`;

DROP VIEW IF EXISTS `view_reserva_datoscompletos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_reserva_datoscompletos`  AS  select `reserva`.`id_reserva` AS `id_reserva`,`usuario`.`id_usuario` AS `id_usuario`,`usuario`.`email` AS `email`,`reserva`.`tipo` AS `tipo_reserva`,`habitacion`.`tipo_Hab` AS `tipo_Hab`,`habitacion`.`id_hab` AS `habitacion`,`reserva`.`fecha_inicio` AS `fecha_inicio`,`reserva`.`fecha_final` AS `fecha_final`,`reserva`.`Precio_Total` AS `Precio_Total`,`reserva`.`estado` AS `estado_reserva` from (((((`reserva` join `reserva_mascota` on((`reserva`.`id_reserva` = `reserva_mascota`.`id_reserva`))) join `reserva_habitacion` on((`reserva`.`id_reserva` = `reserva_habitacion`.`id_reserva`))) join `mascota` on((`reserva_mascota`.`id_mascota` = `mascota`.`id_mascota`))) join `usuario` on((`mascota`.`id_usuario` = `usuario`.`id_usuario`))) join `habitacion` on((`reserva_habitacion`.`id_hab` = `habitacion`.`id_hab`))) group by `reserva`.`id_reserva` order by `reserva`.`fecha_inicio` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_reserva_mascota_info`
--
DROP TABLE IF EXISTS `view_reserva_mascota_info`;

DROP VIEW IF EXISTS `view_reserva_mascota_info`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_reserva_mascota_info`  AS  select `reserva_mascota`.`id_reserva` AS `id_reserva`,`mascota`.`id_mascota` AS `id_mascota`,`mascota`.`nombre` AS `nombre`,`mascota`.`tipo` AS `tipo` from (`reserva_mascota` join `mascota` on((`reserva_mascota`.`id_mascota` = `mascota`.`id_mascota`))) ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `FK_HabitacionTipoHab` FOREIGN KEY (`tipo_Hab`) REFERENCES `tipo_habitacion` (`tipo_Hab`);

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `FK_MascotaUsuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `reserva_habitacion`
--
ALTER TABLE `reserva_habitacion`
  ADD CONSTRAINT `FK_HabitacionReservaID_Habitacion` FOREIGN KEY (`id_hab`) REFERENCES `habitacion` (`id_hab`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_HabitacionReservaID_Reserva` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id_reserva`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reserva_mascota`
--
ALTER TABLE `reserva_mascota`
  ADD CONSTRAINT `FK_MascotaReservaID_Mascota` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id_mascota`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_MascotaReservaID_Reserva` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id_reserva`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
