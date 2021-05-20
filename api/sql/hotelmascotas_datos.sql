-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 20-05-2021 a las 17:44:31
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

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`id_hab`, `tipo_Hab`) VALUES
('hab_110', 'Grande'),
('hab_111', 'Grande'),
('hab_120', 'Mediano'),
('hab_121', 'Mediano'),
('hab_130', 'Pequeño'),
('hab_131', 'Pequeño');

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id_mascota`, `nombre`, `tipo`, `raza`, `descripcion`, `id_usuario`) VALUES
('mas_001', 'Peludo', 'perro', 'Mástil Tibetano', 'Un perro muy grande color marrón y gran pelaje', 'B7ZOJEpKsu0PO'),
('mas_002', 'Peludor', 'gato', 'Mástil Tibetano', 'Gato grande gris', 'B7ZOJEpKsu0PO'),
('mas_003', 'Poll', 'gato', 'Savana', 'gato blanco', 'B7ZOJEpKsu0PO');

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `fecha_reserva`, `tipo`, `fecha_inicio`, `fecha_final`, `Precio_Total`, `estado`) VALUES
('RS_60980924c5f4e1.28385791', '2021-05-09 16:09:08', 'vip', '2021-05-26', '2021-05-31', 0, 'abandonado'),
('RS_60982eadeaf4f2.14235104', '2021-05-09 18:49:17', 'normal', '2021-06-09', '2021-06-24', 0, 'finalizado'),
('RS_609849cd42c430.04164633', '2021-05-09 20:45:01', 'normal', '2021-08-01', '2021-08-19', 0, 'en espera'),
('RS_60997856972e92.95580789', '2021-05-10 18:15:50', 'vip', '2021-05-29', '2021-05-31', 2770.2602, 'finalizado'),
('RS_60997da6331c14.98360554', '2021-05-10 18:38:30', 'supervip', '2021-07-16', '2021-09-26', 194754.9672, 'abandonado'),
('RS_60997df2430a40.09579268', '2021-05-10 18:39:46', 'supervip', '2022-03-17', '2022-04-15', 78442.9729, 'en espera'),
('RS_609c588bf071a0.32991041', '2021-05-12 22:36:59', 'supervip', '2021-05-14', '2021-05-31', 45983.8117, 'finalizado'),
('RS_609c591c92bec7.34837882', '2021-05-12 22:39:24', 'supervip', '2021-05-14', '2021-05-31', 45983.8117, 'cancelado'),
('RS_609da3eb4f4a99.21870497', '2021-05-13 22:10:51', 'supervip', '2022-10-17', '2022-10-22', 13524.6505, 'en espera'),
('RS_609da51646c451.48127349', '2021-05-13 22:15:50', 'normal', '2023-05-14', '2023-05-29', 9888.6015, 'en espera');

--
-- Volcado de datos para la tabla `reserva_habitacion`
--

INSERT INTO `reserva_habitacion` (`id_hab`, `id_reserva`) VALUES
('hab_110', 'RS_60980924c5f4e1.28385791'),
('hab_110', 'RS_60982eadeaf4f2.14235104'),
('hab_110', 'RS_609849cd42c430.04164633'),
('hab_111', 'RS_60997856972e92.95580789'),
('hab_110', 'RS_60997da6331c14.98360554'),
('hab_110', 'RS_60997df2430a40.09579268'),
('hab_110', 'RS_609c588bf071a0.32991041'),
('hab_111', 'RS_609c591c92bec7.34837882'),
('hab_110', 'RS_609da3eb4f4a99.21870497'),
('hab_110', 'RS_609da51646c451.48127349');

--
-- Volcado de datos para la tabla `reserva_mascota`
--

INSERT INTO `reserva_mascota` (`id_mascota`, `id_reserva`) VALUES
('mas_001', 'RS_60980924c5f4e1.28385791'),
('mas_001', 'RS_60982eadeaf4f2.14235104'),
('mas_001', 'RS_609849cd42c430.04164633'),
('mas_002', 'RS_60997856972e92.95580789'),
('mas_001', 'RS_60997da6331c14.98360554'),
('mas_002', 'RS_60997da6331c14.98360554'),
('mas_001', 'RS_60997df2430a40.09579268'),
('mas_002', 'RS_60997df2430a40.09579268'),
('mas_003', 'RS_609c588bf071a0.32991041'),
('mas_002', 'RS_609c591c92bec7.34837882'),
('mas_001', 'RS_609da3eb4f4a99.21870497'),
('mas_002', 'RS_609da3eb4f4a99.21870497'),
('mas_003', 'RS_609da3eb4f4a99.21870497'),
('mas_001', 'RS_609da51646c451.48127349'),
('mas_002', 'RS_609da51646c451.48127349'),
('mas_003', 'RS_609da51646c451.48127349');

--
-- Volcado de datos para la tabla `tipo_habitacion`
--

INSERT INTO `tipo_habitacion` (`tipo_Hab`, `precio_noche`, `cantidad`) VALUES
('Grande', 65.99, 8),
('Mediano', 49.99, 4),
('Pequeño', 23.99, 2);

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellidos`, `email`, `pass`, `fecha_alta`, `fecha_baja`, `rol`) VALUES
('B7ZOJEpKsu0PO', 'Shanks', 'Akagami', 'akagami.no@gmail.com', 'admin123', '2021-01-05', NULL, 'admin'),
('fBhKyRjW', 'Sanji', 'Visnmoke', 'kuroassssshi@gmail.com', 'admin123', '2019-03-11', '2021-04-06', 'cliente'),
('fBhKyRjW2ph2i', 'Sanji', 'Visnmoke', 'kuroashi@gmail.com', 'admin123', '2019-03-11', '2021-04-06', 'cliente');

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
