-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2024 a las 18:16:04
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreria_parical4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `author`
--

CREATE TABLE `author` (
  `ID_AUTHOR` bigint(20) NOT NULL,
  `FULL_NAME` varchar(255) DEFAULT NULL,
  `DATE_OF_BIRTH` date DEFAULT NULL,
  `DATE_OF_DEATH` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `author`
--

INSERT INTO `author` (`ID_AUTHOR`, `FULL_NAME`, `DATE_OF_BIRTH`, `DATE_OF_DEATH`) VALUES
(1, 'Gabriel García Márquez', '1927-03-06', '2014-04-17'),
(2, 'Julio Verne', '1828-02-08', '1905-03-24'),
(3, 'Isabel Allende', '1942-08-02', NULL),
(4, 'Miguel de Cervantes', '1547-09-29', '1616-04-23'),
(5, 'Laura Esquivel', '1950-09-30', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book`
--

CREATE TABLE `book` (
  `ID_BOOK` bigint(20) NOT NULL,
  `TITLE` varchar(255) DEFAULT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `YEAR_PUBLICATION` year(4) DEFAULT NULL,
  `ID_AUTHOR` bigint(20) DEFAULT NULL,
  `ID_GENRE` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `book`
--

INSERT INTO `book` (`ID_BOOK`, `TITLE`, `DESCRIPTION`, `YEAR_PUBLICATION`, `ID_AUTHOR`, `ID_GENRE`) VALUES
(1, 'Cien años de soledad', 'Una novela sobre la familia Buendía en Macondo.', '1967', 1, 1),
(2, 'Veinte mil leguas de viaje submarino', 'Una historia de aventuras bajo el mar.', '0000', 2, 3),
(3, 'La casa de los espíritus', 'Un relato mágico sobre varias generaciones.', '1982', 3, 4),
(4, 'Don Quijote de la Mancha', 'La historia del caballero de la triste figura.', '0000', 4, 4),
(5, 'Como agua para chocolate', 'Un amor prohibido en la revolución mexicana.', '1989', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genre`
--

CREATE TABLE `genre` (
  `ID_GENRE` bigint(20) NOT NULL,
  `NAME` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `genre`
--

INSERT INTO `genre` (`ID_GENRE`, `NAME`) VALUES
(1, 'Ficción'),
(2, 'No ficción'),
(3, 'Ciencia ficción'),
(4, 'Fantasía'),
(5, 'Misterio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `ID_STOCK` bigint(20) NOT NULL,
  `ID_BOOK` bigint(20) DEFAULT NULL,
  `TOTAL_STOCK` int(11) DEFAULT NULL,
  `NOTES` varchar(255) DEFAULT NULL,
  `LAST_INVENTORY` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`ID_STOCK`, `ID_BOOK`, `TOTAL_STOCK`, `NOTES`, `LAST_INVENTORY`) VALUES
(1, 1, 50, 'Nueva edición 2024', '2024-11-20'),
(2, 2, 30, 'Versión ilustrada', '2024-11-19'),
(3, 3, 40, 'Traducción actualizada', '2024-11-18'),
(4, 4, 20, 'Edición aniversario', '2024-11-17'),
(5, 5, 25, 'Reimpresión limitada', '2024-11-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`ID_AUTHOR`);

--
-- Indices de la tabla `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ID_BOOK`),
  ADD KEY `book_ibfk_1` (`ID_AUTHOR`),
  ADD KEY `book_ibfk_2` (`ID_GENRE`);

--
-- Indices de la tabla `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`ID_GENRE`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`ID_STOCK`),
  ADD KEY `stock_ibfk_1` (`ID_BOOK`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `author`
--
ALTER TABLE `author`
  MODIFY `ID_AUTHOR` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `book`
--
ALTER TABLE `book`
  MODIFY `ID_BOOK` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `ID_STOCK` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`ID_AUTHOR`) REFERENCES `author` (`ID_AUTHOR`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`ID_GENRE`) REFERENCES `genre` (`ID_GENRE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`ID_BOOK`) REFERENCES `book` (`ID_BOOK`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
