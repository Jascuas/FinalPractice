-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-03-2018 a las 16:41:49
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practicafinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `billetes`
--

CREATE TABLE `billetes` (
  `id` int(4) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido1` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido2` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(9) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `movil` int(9) NOT NULL,
  `origen` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `destino` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `billetes`
--

INSERT INTO `billetes` (`id`, `nombre`, `apellido1`, `apellido2`, `dni`, `email`, `movil`, `origen`, `destino`, `clave`) VALUES
(63, 'Javier', 'de Lago', 'de Lago', '70421554Q', 'loljavierdelago@hotmail.com', 676393041, 'Barcelona', 'Sevilla', 'h4ho3re3'),
(64, 'Javier', 'de Lago', 'de Lago', '70421554Q', 'loljavierdelago@hotmail.com', 676393041, 'Cadiz', 'Ciudad Real', 'fnio060m'),
(65, 'Javier', 'de Lago', 'de Lago', '70421554Q', 'loljavierdelago@hotmail.com', 676393041, 'Barcelona', 'Cadiz', 'kafzhtgj'),
(66, 'Javier', 'de Lago', 'de Lago', '70421554Q', 'loljavierdelago@hotmail.com', 676393041, 'Cadiz', 'Galicia', 'qhxi7jp0'),
(67, 'Javier', 'de Lago', 'asd', '70421554Q', 'loljavierdelago@hotmail.com', 676393041, 'Galicia', 'Cadiz', 'bwegfsz5'),
(68, 'Javier', 'de Lago', 'de Lago', '70421554Q', 'loljavierdelago@hotmail.com', 676393041, 'Cadiz', 'Valencia', 'lccx8j8m');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL,
  `ciudad` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id`, `ciudad`) VALUES
(1, 'Madrid'),
(2, 'Barcelona'),
(3, 'Galicia'),
(4, 'Cadiz'),
(5, 'Sevilla'),
(6, 'Valencia'),
(7, 'Ciudad Real'),
(8, 'La Rioja');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `billetes`
--
ALTER TABLE `billetes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `billetes`
--
ALTER TABLE `billetes`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
