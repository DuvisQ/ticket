-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
<<<<<<< HEAD
-- Tiempo de generación: 02-03-2022 a las 01:56:19
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.19
=======
-- Tiempo de generación: 22-02-2022 a las 21:19:45
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19
>>>>>>> 1b7ae572f600fff1f21a627cac24c87c1baa8ec8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `helpa2center`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` text,
  `state` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
<<<<<<< HEAD
  `at_created` date DEFAULT NULL,
=======
  `at_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
>>>>>>> 1b7ae572f600fff1f21a627cac24c87c1baa8ec8
  `at_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `branch`
--

INSERT INTO `branch` (`id`, `client_id`, `full_name`, `phone`, `address`, `state`, `email`, `status`, `at_created`, `at_update`) VALUES
<<<<<<< HEAD
(1, 1, 'Test', '111', '11', '11', 'test@gmail.com', 1, NULL, NULL);
=======
(1, 2, 'Burguer Joes La Victorai', '464646', 'calle 1', 'aragua', 'burguerlv@gmail.com', 1, '2022-02-09 15:45:50', NULL);
>>>>>>> 1b7ae572f600fff1f21a627cac24c87c1baa8ec8

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `descrip` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `at_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`id`, `full_name`, `descrip`, `status`, `at_created`) VALUES
<<<<<<< HEAD
(1, 'pacmicrosystems', 'base...!!!', 1, '2022-02-04');
=======
(1, 'pacmicrosystems', 'base...!!!', 0, '2022-02-04'),
(2, 'Burguer Joes', 'Burguer Joes', 1, '2022-02-09');
>>>>>>> 1b7ae572f600fff1f21a627cac24c87c1baa8ec8

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `support`
--

CREATE TABLE `support` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `client_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `usert_id` int(11) NOT NULL,
  `user_assigned` int(11) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `descrip` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1: reguest\r\n2: working\r\n4: finalized',
  `at_created` date NOT NULL,
  `at_update` date DEFAULT NULL,
  `at_assigned` date DEFAULT NULL,
  `at_closed` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `support`
--

INSERT INTO `support` (`id`, `code`, `client_id`, `branch_id`, `usert_id`, `user_assigned`, `title`, `descrip`, `status`, `at_created`, `at_update`, `at_assigned`, `at_closed`) VALUES
<<<<<<< HEAD
(1, '043160957', 1, 1, 2, 1, 'Aqui este es un test', 'test de soporte para probar', 4, '2022-03-01', '2022-03-01', '2022-03-01', '2022-03-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `support_details`
--

CREATE TABLE `support_details` (
  `id` int(11) NOT NULL,
  `id_support_tickets` int(11) NOT NULL,
  `detail` text,
  `path_image` text,
  `url_image` text,
  `type_details` int(11) DEFAULT '1' COMMENT '1:created, 2:request, 3:finish',
  `type_user` int(11) DEFAULT '1' COMMENT '1:user, 2:agent',
  `created` timestamp NULL DEFAULT NULL,
  `note` text,
  `status_response` int(11) DEFAULT '0' COMMENT '0:no respuesta, 1:respuesta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `support_details`
--

INSERT INTO `support_details` (`id`, `id_support_tickets`, `detail`, `path_image`, `url_image`, `type_details`, `type_user`, `created`, `note`, `status_response`) VALUES
(1, 1, 'test de soporte para probar', '', '', 1, 1, '2022-03-01 04:00:00', '', 0),
(2, 1, 'esto es una respuesta', '', '', 2, 2, '2022-03-01 04:00:00', '', 0),
(3, 1, 'termnado el soporte', '', '', 3, 2, '2022-03-01 04:00:00', NULL, 0);
=======
(1, '651009074', 2, 1, 2, NULL, 'Requerimiento xx', 'Requerimiento xx', 1, '2022-02-09', NULL, NULL, NULL),
(16, '962081005', 2, 1, 2, 1, 'Soporte domingo', 'desc', 2, '2022-02-13', '2022-02-13', '2022-02-13', NULL);
>>>>>>> 1b7ae572f600fff1f21a627cac24c87c1baa8ec8

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usert`
--

CREATE TABLE `usert` (
  `id` int(11) NOT NULL,
  `code` varchar(30) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `movil_phone` varchar(15) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1: agente\r\n2: usuario',
  `act` tinyint(4) NOT NULL DEFAULT '0',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: on\r\n0: off \r\n-  agent adminer',
  `at_created` date NOT NULL,
  `at_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usert`
--

INSERT INTO `usert` (`id`, `code`, `client_id`, `branch_id`, `full_name`, `username`, `email`, `pass`, `movil_phone`, `role`, `act`, `is_admin`, `at_created`, `at_update`) VALUES
(1, '00001', 1, NULL, 'root', 'root', 'admin@gmail.com', '12345678', '555252540', 1, 1, 1, '2022-02-04', NULL),
<<<<<<< HEAD
(2, 'g5kxezZy', 1, 1, 'aldrha', 'aldrha', 'aldrha@email.com', '12345678', '111111222', 2, 1, 0, '2022-02-28', NULL);
=======
(2, 'xtCn32Ue', 2, 1, 'joes quintero', 'joes_admin', 'joesadmin@gmail.com', '12345678', '4646464646', 2, 1, 0, '2022-02-09', NULL);
>>>>>>> 1b7ae572f600fff1f21a627cac24c87c1baa8ec8

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usert_notification`
--

CREATE TABLE `usert_notification` (
  `id` int(11) NOT NULL,
  `usert_id` int(11) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usert_notification`
--

INSERT INTO `usert_notification` (`id`, `usert_id`, `token`) VALUES
(5, 1, 'f9P8PpZLeXj3CvjhT0BDJ7:APA91bE_SUFS8sGwvuZwIVfMFoGpC9JRtH6Lbc0eAPfhimG06lsMunrW5SEoKL34lgtiGFXFx0zywwRWvhGXS-hnH65oOwSmMK7tqphozFt82gYmouhQ19QlYKo60VkbmULZrlnPa4RP'),
(6, 2, 'c2c9iSbwLpbK6nfK1XLNAS:APA91bGtmbO3M-6caDEykxrblO7EoMKX89-OkMlqS5nmVKAa581RrwSS5MWrBJdH-Et1Fcjfue1HBczW8MgDWg5Ikq5_F0QkVc6bzsIrH3F2sQ9ebj7VUZtG8EhgV5eBYFozhwa5y-Wi');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `support_details`
--
ALTER TABLE `support_details`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usert`
--
ALTER TABLE `usert`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usert_notification`
--
ALTER TABLE `usert_notification`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `support`
--
ALTER TABLE `support`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `support_details`
--
ALTER TABLE `support_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
>>>>>>> 1b7ae572f600fff1f21a627cac24c87c1baa8ec8

--
-- AUTO_INCREMENT de la tabla `usert`
--
ALTER TABLE `usert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usert_notification`
--
ALTER TABLE `usert_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
