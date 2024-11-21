-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2024 a las 21:28:36
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecommerce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL,
  `id_cli` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `talle` varchar(10) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `cantidad` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_carrito`, `id_cli`, `id_producto`, `talle`, `color`, `cantidad`) VALUES
(59, 7, 123, 'S', 'blanco', 1),
(60, 7, 127, 'M', 'gris', 1),
(62, 8, 101, '40', 'negro', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cli` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `localidad` varchar(50) DEFAULT NULL,
  `calle` varchar(50) DEFAULT NULL,
  `altura_calle` int(11) DEFAULT NULL,
  `piso` int(11) DEFAULT NULL,
  `depto` char(1) DEFAULT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cli`, `nombre`, `apellido`, `usuario`, `pwd`, `localidad`, `calle`, `altura_calle`, `piso`, `depto`, `celular`, `correo`) VALUES
(1, 'aaa', 'bbb', 'aaa', '123', 'Capital Federal, Chacarita', 'Av. Forest 234', 500, 9, 'G', '1158412589', 'lautaro.celicoet32@gmail.com'),
(2, 'Lautaro Uriel', 'Célico', 'lauticelico', '123', 'Capital Federal, Villa Crespo', 'Rojas 2242', 2242, 1, 'b', '1127822927', 'lautaro.celicoet32@gmail.com'),
(4, 'Gabriel', 'Valdez', 'gabi', '123', 'Capital Federal, Chacarita', 'guevara', 577, 0, 'B', '1152854963', 'gabi@gmail.com'),
(6, 'Yazmin', 'Chavez', 'yazmin9', '12345', 'Capital Federal, Flores', 'Lautarito', 12, 0, '0', '1155224893', 'yazmin.chavezet32@gmail.com'),
(7, 'Laureano', 'Furno', 'laufurno', '12345', 'Capital Federal, Chacarita', 'Rojas ', 3454, 8, 'b', '112325679', 'laufurno@gmail.com'),
(8, 'MARCELO MARTIN', 'CELICO', 'consorti', '12345', 'Buenos Aires', 'Rojas', 667, 8, 'b', '1126765430', 'consorti32@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `id_color` int(11) NOT NULL,
  `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`id_color`, `color`) VALUES
(1, 'negro'),
(2, 'blanco'),
(3, 'gris'),
(4, 'blanco/negro'),
(5, 'negro/blanco'),
(6, 'beige'),
(7, 'rojo'),
(8, 'gris/blanco'),
(9, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorito`
--

CREATE TABLE `favorito` (
  `id_favorito` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intermediaria`
--

CREATE TABLE `intermediaria` (
  `id_producto` int(11) DEFAULT NULL,
  `id_color` int(11) DEFAULT NULL,
  `id_talle` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `intermediaria`
--

INSERT INTO `intermediaria` (`id_producto`, `id_color`, `id_talle`, `stock`, `id`) VALUES
(93, 9, 19, 0, 51),
(100, 9, 19, 0, 58),
(101, 1, 10, 5, 59),
(102, 9, 19, 0, 60),
(104, 9, 19, 0, 62),
(120, 2, 1, 8, 78),
(123, 2, 1, 4, 81),
(124, 3, 1, 8, 82),
(127, 3, 2, 2, 85),
(129, 2, 3, 8, 87),
(130, 3, 3, 6, 88),
(131, 1, 4, 12, 89),
(132, 2, 4, 0, 90),
(133, 3, 4, 7, 91),
(134, 1, 1, 6, 92),
(135, 2, 2, 8, 93),
(136, 1, 3, 5, 94),
(138, 2, 4, 5, 96),
(139, 1, 11, 6, 97),
(140, 1, 12, 8, 98),
(141, 1, 13, 6, 99),
(143, 2, 11, 6, 101),
(144, 2, 12, 6, 102),
(145, 2, 13, 6, 103),
(146, 2, 14, 6, 104),
(147, 4, 10, 6, 105),
(148, 5, 10, 6, 106),
(149, 6, 10, 6, 107),
(150, 7, 10, 6, 108),
(151, 4, 11, 6, 109),
(152, 5, 11, 6, 110),
(153, 6, 11, 6, 111),
(154, 7, 11, 6, 112),
(155, 2, 1, 3, 113),
(156, 2, 3, 6, 114),
(157, 1, 2, 6, 115),
(158, 1, 4, 6, 116),
(159, 2, 2, 4, 117),
(160, 2, 3, 3, 118),
(161, 2, 4, 5, 119),
(163, 1, 2, 2, 121),
(164, 2, 2, 3, 122),
(167, 3, 4, 12, 125),
(168, 9, 19, 0, 126);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descr` varchar(50) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `imagen` varchar(800) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `categoria`, `nombre`, `descr`, `precio`, `imagen`) VALUES
(93, 'remeras', 'Remera OWN', 'Remera de algodon', 18000, '../imagenes/remera2.jpg'),
(100, 'zapatillas', 'Zapatilla MQ queen', 'Zapatillas MQ queen excelente calidad', 30000, '../imagenes/zapatilla3.jpg'),
(101, 'zapatillas', 'Zapatilla MQ queen', '', 30000, '../imagenes/zapatilla3.jpg'),
(102, 'pantalones', 'Pantalon AFA', 'Pantalon AFA', 15000, '../imagenes/pantalon1.jpg'),
(104, 'conjuntos', 'Conjunto AFA', 'Conjunto AFA ', 30000, '../imagenes/conjunto1.jpg'),
(120, 'conjuntos', 'Conjunto AFA', '', 30000, '../imagenes/'),
(123, 'remeras', 'Remera OWN', '', 18000, '../imagenes/'),
(124, 'remeras', 'Remera OWN', '', 18000, '../imagenes/'),
(127, 'remeras', 'Remera OWN', '', 18000, '../imagenes/'),
(129, 'remeras', 'Remera OWN', '', 18000, '../imagenes/'),
(130, 'remeras', 'Remera OWN', '', 18000, '../imagenes/'),
(131, 'remeras', 'Remera OWN', '', 18000, '../imagenes/'),
(132, 'remeras', 'Remera OWN', '', 18000, '../imagenes/'),
(133, 'remeras', 'Remera OWN', '', 18000, '../imagenes/'),
(134, 'pantalones', 'Pantalon AFA', '', 15000, '../imagenes/'),
(135, 'pantalones', 'Pantalon AFA', '', 15000, '../imagenes/'),
(136, 'pantalones', 'Pantalon AFA', '', 15000, '../imagenes/'),
(138, 'pantalones', 'Pantalon AFA', '', 15000, '../imagenes/'),
(139, 'zapatillas', 'Zapatilla MQ queen', '', 30000, '../imagenes/'),
(140, 'zapatillas', 'Zapatilla MQ queen', '', 30000, '../imagenes/'),
(141, 'zapatillas', 'Zapatilla MQ queen', '', 30000, '../imagenes/'),
(143, 'zapatillas', 'Zapatilla MQ queen', '', 30000, '../imagenes/'),
(144, 'zapatillas', 'Zapatilla MQ queen', '', 30000, '../imagenes/'),
(145, 'zapatillas', 'Zapatilla MQ queen', '', 30000, '../imagenes/'),
(146, 'zapatillas', 'Zapatilla MQ queen', '', 30000, '../imagenes/'),
(147, 'zapatillas', 'Zapatilla MQ queen', '', 30000, '../imagenes/'),
(148, 'zapatillas', 'Zapatilla MQ queen', '', 30000, '../imagenes/'),
(149, 'zapatillas', 'Zapatilla MQ queen', '', 30000, '../imagenes/'),
(150, 'zapatillas', 'Zapatilla MQ queen', '', 30000, '../imagenes/'),
(151, 'zapatillas', 'Zapatilla MQ queen', '', 30000, '../imagenes/'),
(152, 'zapatillas', 'Zapatilla MQ queen', '', 30000, '../imagenes/'),
(153, 'zapatillas', 'Zapatilla MQ queen', '', 30000, '../imagenes/'),
(154, 'zapatillas', 'Zapatilla MQ queen', '', 30000, '../imagenes/'),
(155, 'pantalones', 'Pantalon AFA', '', 15000, '../imagenes/'),
(156, 'pantalones', 'Pantalon AFA', '', 15000, '../imagenes/'),
(157, 'pantalones', 'Pantalon AFA', '', 15000, '../imagenes/'),
(158, 'pantalones', 'Pantalon AFA', '', 15000, '../imagenes/'),
(159, 'conjuntos', 'Conjunto AFA', '', 30000, '../imagenes/'),
(160, 'conjuntos', 'Conjunto AFA', '', 30000, '../imagenes/'),
(161, 'conjuntos', 'Conjunto AFA', '', 30000, '../imagenes/'),
(163, 'remeras', 'Remera OWN', '', 18000, ''),
(164, 'remeras', 'Remera OWN', '', 18000, ''),
(167, 'remeras', 'Remera OWN', '', 18000, ''),
(168, 'remeras', 'Remera Nike', 'REmeraaaaaaaa', 25000, '../imagenes/remera1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talle`
--

CREATE TABLE `talle` (
  `id_talle` int(11) NOT NULL,
  `talle` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `talle`
--

INSERT INTO `talle` (`id_talle`, `talle`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, '35'),
(6, '36'),
(7, '37'),
(8, '38'),
(9, '39'),
(10, '40'),
(11, '41'),
(12, '42'),
(13, '43'),
(14, '44'),
(15, '45'),
(19, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `id_cli` (`id_cli`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cli`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id_color`);

--
-- Indices de la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD PRIMARY KEY (`id_favorito`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `intermediaria`
--
ALTER TABLE `intermediaria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_color` (`id_color`),
  ADD KEY `id_talle` (`id_talle`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `talle`
--
ALTER TABLE `talle`
  ADD PRIMARY KEY (`id_talle`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `favorito`
--
ALTER TABLE `favorito`
  MODIFY `id_favorito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `intermediaria`
--
ALTER TABLE `intermediaria`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT de la tabla `talle`
--
ALTER TABLE `talle`
  MODIFY `id_talle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_cli`) REFERENCES `cliente` (`id_cli`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `favorito_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `cliente` (`id_cli`),
  ADD CONSTRAINT `favorito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `intermediaria`
--
ALTER TABLE `intermediaria`
  ADD CONSTRAINT `intermediaria_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `intermediaria_ibfk_2` FOREIGN KEY (`id_color`) REFERENCES `colores` (`id_color`),
  ADD CONSTRAINT `intermediaria_ibfk_3` FOREIGN KEY (`id_talle`) REFERENCES `talle` (`id_talle`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
