-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-05-2021 a las 14:18:47
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

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id_mascota`, `nombre`, `tipo`, `raza`, `descripcion`, `id_usuario`) VALUES
('mas_001', 'Peludo', 'perro', 'Mástil Tibetano', 'Un perro muy grande color marrón y gran pelaje', 'B7ZOJEpKsu0PO'),
('mas_002', 'Peludor', 'gato', 'Mástil Tibetano', 'Gato grande gris', 'B7ZOJEpKsu0PO');

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

--
-- Volcado de datos para la tabla `tipo_habitacion`
--

INSERT INTO `tipo_habitacion` (`tipo_Hab`, `precio_noche`, `cantidad`) VALUES
('Grande', 65.99, 8),
('Mediano', 49.99, 4),
('Pequeño', 23.99, 2);

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

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellidos`, `email`, `pass`, `fecha_alta`, `fecha_baja`, `rol`) VALUES
('B7ZOJEpKsu0PO', 'Shanks', 'Akagami', 'akagami.no@gmail.com', 'admin123', '2021-01-05', NULL, 'admin'),
('fBhKyRjW', 'Sanji', 'Visnmoke', 'kuroassssshi@gmail.com', 'admin123', '2019-03-11', '2021-04-06', 'cliente'),
('fBhKyRjW2ph2i', 'Sanji', 'Visnmoke', 'kuroashi@gmail.com', 'admin123', '2019-03-11', '2021-04-06', 'cliente');

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
