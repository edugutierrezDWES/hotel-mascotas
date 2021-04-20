/*******************************************************************************
   Drop database if it exists
********************************************************************************/
DROP DATABASE IF EXISTS `hotelmascotas`;

/*******************************************************************************
   Create database
********************************************************************************/
CREATE DATABASE `hotelmascotas`;

USE `hotelmascotas`;

CREATE TABLE `reserva`
(
    `id_reserva` VARCHAR(80) NOT NULL,
    `tipo` ENUM('normal','vip', 'supervip') NOT NULL,
    `fecha_inicio` timestamp NOT NULL,
    `fecha_final`  timestamp NOT NULL,
    `id_hab` VARCHAR(80) NOT NULL,
    `id_usuario` VARCHAR(80) NOT NULL,
    CONSTRAINT `PK_reserva` PRIMARY KEY  (`id_reserva`)
);

CREATE TABLE `habitacion`
(
    `id_hab` VARCHAR(80) NOT NULL,
    `precio_noche` FLOAT(8) NOT NULL,
    `cantidad` INT NOT NULL,
    CONSTRAINT `PK_habitacion` PRIMARY KEY  (`id_hab`)
);


CREATE TABLE `usuario`
(
    `id_usuario` VARCHAR(80) NOT NULL,
    `nombre` VARCHAR(80) NOT NULL,
    `apellidos` VARCHAR(80) NOT NULL,
    `email` VARCHAR(160) NOT NULL,
    `pass` VARCHAR(256) NOT NULL,
    `fecha_alta` DATE NOT NULL,
    `fecha_bajal` DATE NOT NULL,
    `rol` ENUM('cliente','empleado', 'admin') NOT NULL,
    CONSTRAINT `PK_usuario` PRIMARY KEY  (`id_usuario`)
);


CREATE TABLE `mascota`
(
    `id_mascota` VARCHAR(80) NOT NULL,
    `nombre` VARCHAR(80) NOT NULL,
    `tipo` ENUM('gato','perro') NOT NULL,
    `raza` VARCHAR(80) NOT NULL,
    `descrpcion` VARCHAR(250) NOT NULL,
    `id_usuario` VARCHAR(80) NOT NULL,
    CONSTRAINT `PK_mascota` PRIMARY KEY  (`id_mascota`)
);

CREATE TABLE `reserva_mascota`(
    `id_mascota` VARCHAR(80) NOT NULL,
    `id_reserva` VARCHAR(80) NOT NULL,
    CONSTRAINT `PK_ReservaMascota` PRIMARY KEY  (`id_mascota`,`id_reserva`)

);
CREATE TABLE `reserva_habitacion`(
    `id_hab` VARCHAR(80) NOT NULL,
    `id_reserva` VARCHAR(80) NOT NULL,
    CONSTRAINT `PK_ReservaHabitacion` PRIMARY KEY  (`id_hab`,`id_reserva`)
);

/*******************************************************************************
   Create Foreign Keys
********************************************************************************/
ALTER TABLE `reserva` ADD CONSTRAINT `FK_ReservaHabitacion`
    FOREIGN KEY (`id_hab`) REFERENCES `habitacion` (`id_hab`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `reserva` ADD CONSTRAINT `FK_ReservaUsuario`
    FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `mascota` ADD CONSTRAINT `FK_MascotaUsuario`
    FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `reserva_mascota` ADD CONSTRAINT `FK_ReservaMascotaID`
    FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id_mascota`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `reserva_mascota` ADD CONSTRAINT `FK_MascotaReservaID`
    FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id_reserva`) ON DELETE NO ACTION ON UPDATE NO ACTION;


ALTER TABLE `reserva_habitacion` ADD CONSTRAINT `FK_ReservaHabitacionID`
    FOREIGN KEY (`id_hab`) REFERENCES `habitacion` (`id_hab`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `reserva_habitacion` ADD CONSTRAINT `FK_HabitacionReservaID`
    FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id_reserva`) ON DELETE NO ACTION ON UPDATE NO ACTION;








