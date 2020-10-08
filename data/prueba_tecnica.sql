-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 06-10-2020 a las 15:17:27
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba_tecnica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `cod_producto` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `costo` decimal(65,2) DEFAULT NULL,
  `codigo` varchar(255) NOT NULL,
  `foto_ref` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cod_producto`),
  UNIQUE KEY `codigo_uq` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`cod_producto`, `nombre`, `descripcion`, `costo`, `codigo`, `foto_ref`) VALUES
(14, 'producto 1', '<p>dsdfsdfsdf</p>', '12.00', '01AL1BOFIZ075', 'views/layouts/nuevo/img/productos/5f7c7c44a5ed51.54428871_qenphjmgklofi.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_imagenes`
--

DROP TABLE IF EXISTS `productos_imagenes`;
CREATE TABLE IF NOT EXISTS `productos_imagenes` (
  `cod_producto_imagen` int NOT NULL AUTO_INCREMENT,
  `cod_producto` int NOT NULL,
  `imagen` varchar(255) NOT NULL,
  PRIMARY KEY (`cod_producto_imagen`) USING BTREE,
  KEY `cod_producto` (`cod_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_cart`
--

DROP TABLE IF EXISTS `user_cart`;
CREATE TABLE IF NOT EXISTS `user_cart` (
  `cod_cart` int NOT NULL AUTO_INCREMENT,
  `cod_usuario` int DEFAULT NULL,
  `cod_producto` int DEFAULT NULL,
  `cantidad` int DEFAULT '1',
  PRIMARY KEY (`cod_cart`) USING BTREE,
  KEY `cod_usuario1_fk` (`cod_usuario`),
  KEY `cod_producto_fk` (`cod_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `cod_usuario` int NOT NULL AUTO_INCREMENT,
  `nom_usuario` varchar(255) NOT NULL,
  `pass_usuario` varchar(255) NOT NULL,
  `ssid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cod_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`cod_usuario`, `nom_usuario`, `pass_usuario`, `ssid`) VALUES
(1, 'prueba', '8d3d825912f60e5b84fd42cc771ccb68dbeb27cf', 'c279da2fdbadadb4fd839d55010eba945623a391');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos_imagenes`
--
ALTER TABLE `productos_imagenes`
  ADD CONSTRAINT `cod_producto` FOREIGN KEY (`cod_producto`) REFERENCES `productos` (`cod_producto`);

--
-- Filtros para la tabla `user_cart`
--
ALTER TABLE `user_cart`
  ADD CONSTRAINT `cod_producto_fk` FOREIGN KEY (`cod_producto`) REFERENCES `productos` (`cod_producto`),
  ADD CONSTRAINT `cod_usuario1_fk` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
