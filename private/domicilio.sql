-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2020 a las 23:22:42
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `domicilio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `comentario` int(11) NOT NULL,
  `usuarior` int(11) NOT NULL,
  `fecha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `idcompra` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `idproducto` int(10) NOT NULL,
  `precio` int(20) NOT NULL,
  `direccion` varchar(70) NOT NULL,
  `cantidad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poruducto`
--

CREATE TABLE `poruducto` (
  `idDocente` int(10) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `direccion` varchar(80) NOT NULL,
  `nit` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `poruducto`
--

INSERT INTO `poruducto` (`idDocente`, `nombre`, `direccion`, `nit`) VALUES
(1, 'pizza', '7.50', 'pizza prueva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sugerencias`
--

CREATE TABLE `sugerencias` (
  `id_usuario` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `sugerencia` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sugerencias`
--

INSERT INTO `sugerencias` (`id_usuario`, `nombre`, `correo`, `sugerencia`) VALUES
(1, 'irvin', 'digieduardo2@gmail.com', 'hhh'),
(2, 'irvin', 'irvin_503@live.com', 'hola es prueva\n'),
(3, 'irvin', 'irvin_503@live.com', 'hola es prueva\n'),
(4, 'irvin', 'irvin_503@live.com', 'cuales serian los combos del mes '),
(5, 'irvin', 'irvin_503@live.com', 'cuales serian los combos del mes ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarior`
--

CREATE TABLE `usuarior` (
  `id_usuario` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contraseña` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarior`
--

INSERT INTO `usuarior` (`id_usuario`, `nombre`, `correo`, `contraseña`) VALUES
(31, 'eduardo ', 'digieduardo2@gmail.com', 'Holaeduardo2'),
(38, 'irvin', 'irvin_503@live.com', 'Hola123prueba ');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`),
  ADD KEY `id_usuario` (`id_usuario`,`idproducto`);

--
-- Indices de la tabla `poruducto`
--
ALTER TABLE `poruducto`
  ADD PRIMARY KEY (`idDocente`);

--
-- Indices de la tabla `sugerencias`
--
ALTER TABLE `sugerencias`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuarior`
--
ALTER TABLE `usuarior`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `idcompra` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `poruducto`
--
ALTER TABLE `poruducto`
  MODIFY `idDocente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sugerencias`
--
ALTER TABLE `sugerencias`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarior`
--
ALTER TABLE `usuarior`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
