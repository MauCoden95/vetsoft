-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 22-03-2024 a las 02:01:04
-- Versión del servidor: 8.2.0
-- Versión de PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vetsoft`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `histories`
--

DROP TABLE IF EXISTS `histories`;
CREATE TABLE IF NOT EXISTS `histories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int DEFAULT NULL,
  `history` text,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `patient_id` (`patient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `owners`
--

DROP TABLE IF EXISTS `owners`;
CREATE TABLE IF NOT EXISTS `owners` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `owners`
--

INSERT INTO `owners` (`id`, `name`, `dni`, `phone`, `phone2`, `mail`, `address`) VALUES
(3, 'Mariano Garzón', '39098233', '42053522', '1134678159', 'marian@email.com', 'La Pampa 457 - CABA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patients`
--

DROP TABLE IF EXISTS `patients`;
CREATE TABLE IF NOT EXISTS `patients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `owner_id` int DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `animal` varchar(50) DEFAULT NULL,
  `breed` varchar(100) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turns`
--

DROP TABLE IF EXISTS `turns`;
CREATE TABLE IF NOT EXISTS `turns` (
  `id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `hour` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_id` int DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `phone`, `mail`, `password`) VALUES
(1, 1, 'Maria Lopez', '48226933', 'maria0@email.com', '$2y$04$dZDN3C4YKBx2LrPOV/K.ou1cPbhZWrnNCejJeBpgpNB.3.wCK6yDq'),
(2, 1, 'Mauro', '48226933', 'mauro@email.com', '$2y$04$Sg6ODnU9qycyxD/9BIFJiuj5dS14Dw59zCpjRNRemXsKdllquYfOW'),
(3, 1, 'Geremías Zamora', '1123450000', 'geremias2@email.com', '$2y$04$V7RX7CPsbiXi34s5szWEvucZoGTdihUIB16ydcFHFRge8w0LyxPlm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `veterinaries`
--

DROP TABLE IF EXISTS `veterinaries`;
CREATE TABLE IF NOT EXISTS `veterinaries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `license` varchar(50) NOT NULL,
  `specialty` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `veterinaries`
--

INSERT INTO `veterinaries` (`id`, `name`, `address`, `phone`, `phone2`, `license`, `specialty`) VALUES
(16, 'Paula Castro', 'Calle 1200', '1122331122', '1122334455', '577720', 'Análisis clínicos'),
(15, 'Mario Ruiz', 'Avenida 300', '1122334455', '1122331122', '326129', 'Quimioterapia'),
(13, 'Javier Díaz', 'Avenida 500', '1122334455', '1123456789', '698470', 'Medicina general'),
(14, 'Lucía Torres', 'Calle 800', '1122112233', '1122331122', '684308', 'Medicina general'),
(12, 'Laura Gómez', 'Calle 2000', '1123456789', '1122334455', '936015', 'Medicina general'),
(19, 'Diego Vargas', 'Calle 1500', '1122334455', '1123456789', '358961', 'Animales exóticos'),
(20, 'Bernardo Santos', 'Luna 3200 - CABA', '41132350', '1123234355', '100009', 'Radiología'),
(21, 'Carlos Vera', 'Av Larrazabal 500 - CABA', '1148880000', '1109758888', '324448', 'Cirugía general'),
(22, 'Germán Báez', 'Av. Lafuente 980 - CABA', '41787899', '1122332221', '123009', 'Medicina general');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
