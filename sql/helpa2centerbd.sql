-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-04-2022 a las 15:06:47
-- Versión del servidor: 10.5.12-MariaDB
-- Versión de PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id18646904_helpa2center`
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
  `address` text DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `at_created` date DEFAULT NULL,
  `at_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `branch`
--

INSERT INTO `branch` (`id`, `client_id`, `full_name`, `phone`, `address`, `state`, `email`, `status`, `at_created`, `at_update`) VALUES
(1, 1, 'Test', '111', '11', '11', 'test@gmail.com', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `descrip` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `at_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`id`, `full_name`, `descrip`, `status`, `at_created`) VALUES
(1, 'pacmicrosystems', 'base...!!!', 1, '2022-02-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notification_history`
--

CREATE TABLE `notification_history` (
  `id` int(11) NOT NULL,
  `usert_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `mark_seen` int(11) DEFAULT 0,
  `at_created` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notification_history`
--

INSERT INTO `notification_history` (`id`, `usert_id`, `text`, `mark_seen`, `at_created`) VALUES
(1, 1, 'Nuevo soporte para asignar', 0, '2022-03-21 17:24:26'),
(2, 1, 'Nuevo soporte para asignar', 0, '2022-03-21 17:24:26'),
(3, 4, 'Se le ha asignado un nuevo soporte', 0, '2022-03-21 17:27:57'),
(4, 1, 'Se le ha asignado un nuevo soporte', 0, '2022-03-21 17:29:52');

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
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: reguest\r\n2: working\r\n4: finalized',
  `at_created` date NOT NULL,
  `at_update` date DEFAULT NULL,
  `at_assigned` date DEFAULT NULL,
  `at_closed` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `support`
--

INSERT INTO `support` (`id`, `code`, `client_id`, `branch_id`, `usert_id`, `user_assigned`, `title`, `descrip`, `status`, `at_created`, `at_update`, `at_assigned`, `at_closed`) VALUES
(1, '103295007', 1, 1, 2, NULL, 'ticket', 'support ticket', 1, '2022-03-21', NULL, NULL, NULL),
(2, '390015074', 1, 1, 2, 1, 'ticket', 'support ticket', 2, '2022-03-21', '2022-03-21', '2022-03-21', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `support_details`
--

CREATE TABLE `support_details` (
  `id` int(11) NOT NULL,
  `id_support_tickets` int(11) NOT NULL,
  `detail` text DEFAULT NULL,
  `path_image` text DEFAULT NULL,
  `url_image` text DEFAULT NULL,
  `type_details` int(11) DEFAULT 1 COMMENT '1:created, 2:request, 3:finish',
  `type_user` int(11) DEFAULT 1 COMMENT '1:user, 2:agent',
  `created` timestamp NULL DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status_response` int(11) DEFAULT 0 COMMENT '0:no respuesta, 1:respuesta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `support_details`
--

INSERT INTO `support_details` (`id`, `id_support_tickets`, `detail`, `path_image`, `url_image`, `type_details`, `type_user`, `created`, `note`, `status_response`) VALUES
(1, 1, 'support ticket', '', '', 2, 1, '2022-03-21 17:24:26', '', 0),
(2, 2, 'support ticket', '', '', 2, 1, '2022-03-21 17:24:26', '', 0);

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
  `role` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: agente\r\n2: usuario',
  `act` tinyint(4) NOT NULL DEFAULT 0,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1: on\r\n0: off \r\n-  agent adminer',
  `at_created` date NOT NULL,
  `at_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usert`
--

INSERT INTO `usert` (`id`, `code`, `client_id`, `branch_id`, `full_name`, `username`, `email`, `pass`, `movil_phone`, `role`, `act`, `is_admin`, `at_created`, `at_update`) VALUES
(1, '00001', 1, NULL, 'admnin', 'admin', 'admin@gmail.com', '12345678', '555252540', 1, 1, 1, '2022-02-04', NULL),
(2, 'g5kxezZy', 1, 1, 'usuario', 'usuario', 'usuario@gmail.com', '12345678', '111111222', 2, 1, 0, '2022-02-28', NULL),
(4, 'ECnh8A6K', 1, 1, 'agente', 'agente', 'agente@gmail.com', '12345678', '464544646', 1, 1, 0, '2022-03-03', NULL);

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
(6, 2, 'cokJqNYDyCtdHL2ZA60CeR:APA91bFAXinbNDOGNhnHg7628HIpKrlcRYbzpVEJQ4EzrEN5Zd-r9xOoVGWj628CAo_GeD_-g2VSqgR-5tZ2Lciu5S-4A_uY4I6OvNnPiqmxEyFvtDeNa2Anhn1fmdqZ3rKugibgclTx'),
(7, 1, 'fZMEB_M74KqlexP2Q07xF-:APA91bEU3a7bBvsyYs3KwEyFGGyoGrR8zgAVvI84q7qT83aBy8BBjdbbhMWuEDJC5tppgrbFpA_-zXdjHsMFBe9Z8xRJAFplo_3fU8T4cY7oUjz9_BLUo_E7MdGtynYwa0BeResAIy5m'),
(8, 1, 'e57t-W28dF-u14298FLWk7:APA91bH82YDa_Z2zff5jJU_AMx8bTeVXmUcE_iDAk1MG8ZKbWe0tjB6zruyUgMrqYT-itmMTFjXTUSE2Esl73I2TWVkBlCU-0zoWyAnV8tSQd-O8wpQuBCaanuCYjHojirJZ6MTrCLSp');

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
-- Indices de la tabla `notification_history`
--
ALTER TABLE `notification_history`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `notification_history`
--
ALTER TABLE `notification_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `support`
--
ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `support_details`
--
ALTER TABLE `support_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usert`
--
ALTER TABLE `usert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usert_notification`
--
ALTER TABLE `usert_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
