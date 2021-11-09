-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-11-2021 a las 05:00:23
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto2021`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `iduser` int(8) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `dni` int(8) DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `discapacidades` varchar(200) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `contacto` varchar(30) DEFAULT NULL,
  `domicilio` varchar(100) DEFAULT NULL,
  `localidad` int(3) DEFAULT NULL,
  `departamento` int(3) DEFAULT NULL,
  `provincia` int(2) DEFAULT NULL,
  `idpais` int(4) NOT NULL,
  `idloc` int(8) NOT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `cursos` varchar(200) DEFAULT NULL,
  `pdf` varchar(100) DEFAULT NULL,
  `licencia` int(1) DEFAULT NULL,
  `auto` int(1) DEFAULT NULL,
  `situacionlab` int(1) DEFAULT NULL,
  `area` varchar(200) DEFAULT NULL,
  `salariomin` decimal(8,0) DEFAULT NULL,
  `dispoviajar` int(1) DEFAULT NULL,
  `dispomuda` int(1) DEFAULT NULL,
  `progs` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`iduser`),
  ADD KEY `localidad` (`localidad`),
  ADD KEY `departamento` (`departamento`),
  ADD KEY `provincia` (`provincia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `iduser` int(8) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
