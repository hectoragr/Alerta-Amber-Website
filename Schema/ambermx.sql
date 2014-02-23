-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-02-2014 a las 16:32:22
-- Versión del servidor: 5.5.33
-- Versión de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `ambermx`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alerta`
--

CREATE TABLE `Alerta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `homoclave` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `genero` enum('M','F') NOT NULL,
  `estatura` int(10) unsigned NOT NULL,
  `peso` int(10) unsigned NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `ropa` text,
  `complexion` varchar(45) DEFAULT NULL,
  `ojos` varchar(45) DEFAULT NULL,
  `cabello` varchar(45) DEFAULT NULL,
  `piel` varchar(45) DEFAULT NULL,
  `cicatrices` varchar(45) DEFAULT NULL,
  `marcas` text,
  `fecha_suceso` datetime NOT NULL,
  `lugar` varchar(255) NOT NULL,
  `latitud` double DEFAULT NULL,
  `longitud` double DEFAULT NULL,
  `involucrados` text,
  `vehiculo` binary(1) DEFAULT '0',
  `fotografia` varchar(100) DEFAULT NULL,
  `fecha_resuelta` datetime DEFAULT NULL,
  `Status_id` int(10) unsigned NOT NULL,
  `Entidad_Federativa_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Alerta_Status_idx` (`Status_id`),
  KEY `fk_Alerta_Entidad_Federativa1_idx` (`Entidad_Federativa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Avistamientos`
--

CREATE TABLE `Avistamientos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `lugar` varchar(255) DEFAULT NULL,
  `latitud` double DEFAULT NULL,
  `longitud` double DEFAULT NULL,
  `Alerta_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Avistamientos_Alerta1_idx` (`Alerta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Entidad_Federativa`
--

CREATE TABLE `Entidad_Federativa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `clave` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `Entidad_Federativa`
--

INSERT INTO `Entidad_Federativa` (`id`, `nombre`, `clave`) VALUES
(1, 'Aguascalientes', 'AG'),
(2, 'Baja California', 'BC'),
(3, 'Baja California Sur', 'BS'),
(4, 'Campeche', 'CM'),
(5, 'Chiapas', 'CH'),
(6, 'Chihuahua', 'CI'),
(7, 'Coahuila', 'CA'),
(8, 'Colima', 'CO'),
(9, 'Distrito Federal', 'DF'),
(10, 'Durango', 'DU'),
(11, 'Estado de México', 'EM'),
(12, 'Guanajuato', 'GT'),
(13, 'Guerrero', 'GU'),
(14, 'Hidalgo', 'HD'),
(15, 'Jalisco', 'JA'),
(16, 'Michoacán', 'MI'),
(17, 'Morelos', 'MO'),
(18, 'Nayarit', 'NA'),
(19, 'Nuevo León', 'NL'),
(20, 'Oaxaca', 'OA'),
(21, 'Puebla', 'PU'),
(22, 'Querétaro', 'QE'),
(23, 'Quintana Roo', 'QR'),
(24, 'San Luis Potosí', 'SL'),
(25, 'Sinaloa', 'SI'),
(26, 'Sonora', 'SO'),
(27, 'Tabasco', 'TB'),
(28, 'Tamaulipas', 'TM'),
(29, 'Tlaxcala', 'TL'),
(30, 'Veracruz', 'VE'),
(31, 'Yucatán', 'YU'),
(32, 'Zacatecas', 'ZA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Status`
--

CREATE TABLE `Status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `Status`
--

INSERT INTO `Status` (`id`, `nombre`) VALUES
(1, 'Desaparecido'),
(2, 'Resuelto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `login` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `Entidad_Federativa_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Usuarios_Entidad_Federativa1_idx` (`Entidad_Federativa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Alerta`
--
ALTER TABLE `Alerta`
  ADD CONSTRAINT `fk_Alerta_Entidad_Federativa1` FOREIGN KEY (`Entidad_Federativa_id`) REFERENCES `Entidad_Federativa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Alerta_Status` FOREIGN KEY (`Status_id`) REFERENCES `Status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Avistamientos`
--
ALTER TABLE `Avistamientos`
  ADD CONSTRAINT `fk_Avistamientos_Alerta1` FOREIGN KEY (`Alerta_id`) REFERENCES `Alerta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD CONSTRAINT `fk_Usuarios_Entidad_Federativa1` FOREIGN KEY (`Entidad_Federativa_id`) REFERENCES `Entidad_Federativa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
