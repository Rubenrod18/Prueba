-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-02-2014 a las 17:46:01
-- Versión del servidor: 5.5.34-0ubuntu0.13.04.1
-- Versión de PHP: 5.4.9-4ubuntu2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `SabioGC`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categorias`
--

CREATE TABLE IF NOT EXISTS `Categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Dificultades`
--

CREATE TABLE IF NOT EXISTS `Dificultades` (
  `dificultad` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`dificultad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Etiquetas`
--

CREATE TABLE IF NOT EXISTS `Etiquetas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `texto_UNIQUE` (`texto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Perfiles`
--

CREATE TABLE IF NOT EXISTS `Perfiles` (
  `perfil` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `Perfiles`
--

INSERT INTO `Perfiles` (`perfil`) VALUES
('administrador'),
('experto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Preguntas`
--

CREATE TABLE IF NOT EXISTS `Preguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enunciado` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idRecurso` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `dificultad` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idRespuesta` int(11) DEFAULT NULL,
  `fcreacion` datetime DEFAULT NULL,
  `fmodificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Preguntas_Recursos1` (`idRecurso`),
  KEY `fk_Preguntas_Usuarios1` (`idUsuario`),
  KEY `fk_Preguntas_Dificultades1` (`dificultad`),
  KEY `fk_Preguntas_Respuestas1` (`idRespuesta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RCU`
--

CREATE TABLE IF NOT EXISTS `RCU` (
  `idCategoria` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idCategoria`,`idUsuario`),
  KEY `fk_Categorias_has_Usuarios_Usuarios1` (`idUsuario`),
  KEY `fk_Categorias_has_Usuarios_Categorias1` (`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Recursos`
--

CREATE TABLE IF NOT EXISTS `Recursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Recursos_Tipos1` (`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Respuestas`
--

CREATE TABLE IF NOT EXISTS `Respuestas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idRecurso` int(11) DEFAULT NULL,
  `solucion` tinyint(1) DEFAULT NULL,
  `fcreacion` datetime DEFAULT NULL,
  `fmodificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Respuestas_Recursos1` (`idRecurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RPC`
--

CREATE TABLE IF NOT EXISTS `RPC` (
  `idPregunta` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  PRIMARY KEY (`idPregunta`,`idCategoria`),
  KEY `fk_Preguntas_has_Categorias_Categorias1` (`idCategoria`),
  KEY `fk_Preguntas_has_Categorias_Preguntas1` (`idPregunta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RPE`
--

CREATE TABLE IF NOT EXISTS `RPE` (
  `idEtiqueta` int(11) NOT NULL,
  `idPregunta` int(11) NOT NULL,
  PRIMARY KEY (`idEtiqueta`,`idPregunta`),
  KEY `fk_Etiquetas_has_Preguntas_Preguntas1` (`idPregunta`),
  KEY `fk_Etiquetas_has_Preguntas_Etiquetas1` (`idEtiqueta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RPRF`
--

CREATE TABLE IF NOT EXISTS `RPRF` (
  `idPregunta` int(11) NOT NULL,
  `idRespuesta` int(11) NOT NULL,
  PRIMARY KEY (`idPregunta`,`idRespuesta`),
  KEY `fk_Preguntas_has_Respuestas_Respuestas1` (`idRespuesta`),
  KEY `fk_Preguntas_has_Respuestas_Preguntas1` (`idPregunta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipos`
--

CREATE TABLE IF NOT EXISTS `Tipos` (
  `tipo` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE IF NOT EXISTS `Usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nick` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `perfil` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nick_UNIQUE` (`nick`),
  KEY `fk_Usuarios_Perfiles1` (`perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`id`, `foto`, `nombre`, `apellidos`, `email`, `nick`, `pass`, `perfil`) VALUES
(3, NULL, NULL, NULL, NULL, 'admin', 'admin_sabiogc', 'administrador'),
(9, '', 'jesus', 'chicano', 'jesus@jesus.com', 'jesusch', 'jesusch', 'experto'),
(10, '', 'Ruben', 'Rodriguez', 'ruben@ruben.com', 'rubenrod', 'rubenrod', 'experto');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Preguntas`
--
ALTER TABLE `Preguntas`
  ADD CONSTRAINT `fk_Preguntas_Dificultades1` FOREIGN KEY (`dificultad`) REFERENCES `Dificultades` (`dificultad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Preguntas_Recursos1` FOREIGN KEY (`idRecurso`) REFERENCES `Recursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Preguntas_Respuestas1` FOREIGN KEY (`idRespuesta`) REFERENCES `Respuestas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Preguntas_Usuarios1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `RCU`
--
ALTER TABLE `RCU`
  ADD CONSTRAINT `fk_Categorias_has_Usuarios_Categorias1` FOREIGN KEY (`idCategoria`) REFERENCES `Categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Categorias_has_Usuarios_Usuarios1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Recursos`
--
ALTER TABLE `Recursos`
  ADD CONSTRAINT `fk_Recursos_Tipos1` FOREIGN KEY (`tipo`) REFERENCES `Tipos` (`tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Respuestas`
--
ALTER TABLE `Respuestas`
  ADD CONSTRAINT `fk_Respuestas_Recursos1` FOREIGN KEY (`idRecurso`) REFERENCES `Recursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `RPC`
--
ALTER TABLE `RPC`
  ADD CONSTRAINT `fk_Preguntas_has_Categorias_Categorias1` FOREIGN KEY (`idCategoria`) REFERENCES `Categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Preguntas_has_Categorias_Preguntas1` FOREIGN KEY (`idPregunta`) REFERENCES `Preguntas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `RPE`
--
ALTER TABLE `RPE`
  ADD CONSTRAINT `fk_Etiquetas_has_Preguntas_Etiquetas1` FOREIGN KEY (`idEtiqueta`) REFERENCES `Etiquetas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Etiquetas_has_Preguntas_Preguntas1` FOREIGN KEY (`idPregunta`) REFERENCES `Preguntas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `RPRF`
--
ALTER TABLE `RPRF`
  ADD CONSTRAINT `fk_Preguntas_has_Respuestas_Preguntas1` FOREIGN KEY (`idPregunta`) REFERENCES `Preguntas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Preguntas_has_Respuestas_Respuestas1` FOREIGN KEY (`idRespuesta`) REFERENCES `Respuestas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD CONSTRAINT `fk_Usuarios_Perfiles1` FOREIGN KEY (`perfil`) REFERENCES `Perfiles` (`perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
