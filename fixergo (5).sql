-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-07-2023 a las 05:33:23
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fixergo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `id_usuario1` int(11) NOT NULL,
  `id_usuario2` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_publicacion` int(11) NOT NULL,
  `id_usuariocomentador` int(11) NOT NULL,
  `contenido` varchar(255) DEFAULT NULL,
  `calificacion` decimal(3,1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `remitente_id` int(11) DEFAULT NULL,
  `destinatario_id` int(11) DEFAULT NULL,
  `mensaje` varchar(255) DEFAULT NULL,
  `fecha_envio` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_chat`
--

CREATE TABLE `mensajes_chat` (
  `id` int(11) NOT NULL,
  `id_chat` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `mensaje` varchar(255) DEFAULT NULL,
  `fecha_envio` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `precio` longtext DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `img2` varchar(255) DEFAULT NULL,
  `img3` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `calif_trabajo` longtext DEFAULT NULL,
  `num_compl` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id`, `id_usuario`, `precio`, `img`, `img2`, `img3`, `descripcion`, `calif_trabajo`, `num_compl`) VALUES
(39, 45, '<i class=\'bi bi-coin w-25 \'></i><i class=\'bi bi-coin w-25 \'></i>', '1690168407_edikio-solucion-flex (1).jpg', '1690168407_zebra-800077-781.jpg', '1690168407_zebra-105999-310-kit-de-limpieza.jpg', 'hola soy goky', '<i class=\'bi bi-star-fill\'></i><i class=\'bi bi-star-fill\'></i><i class=\'bi bi-star-fill\'></i><i class=\'bi bi-star-fill\'></i><i class=\'bi bi-star-half\'></i>', 122),
(40, 46, '<i class=\'bi bi-coin w-25 \'></i><i class=\'bi bi-coin w-25 \'></i>', '1690169340_MC210Right2_900299aa-774e-4b22-af9e-fccb35d919d8_480x480.webp', '1690169340_edikio-solucion-flex (1).jpg', '1690169340_descarga (4).jpg', 'addielpuc', '<i class=\'bi bi-star-fill\'></i><i class=\'bi bi-star-fill\'></i><i class=\'bi bi-star-fill\'></i><i class=\'bi bi-star-fill\'></i><i class=\'bi bi-star-half\'></i>', 1222);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `correo_electronico` varchar(255) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `fecha_nacimiento` varchar(100) DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL,
  `trabajo` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `numero_tel` varchar(255) DEFAULT NULL,
  `experiencia` varchar(255) DEFAULT NULL,
  `educacion` varchar(255) DEFAULT NULL,
  `id_oficial` varchar(255) DEFAULT NULL,
  `cedula_profesional` varchar(255) DEFAULT NULL,
  `perfilimg` varchar(500) DEFAULT NULL,
  `account_type` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo_electronico`, `nombre_usuario`, `fecha_nacimiento`, `contrasena`, `trabajo`, `ubicacion`, `descripcion`, `numero_tel`, `experiencia`, `educacion`, `id_oficial`, `cedula_profesional`, `perfilimg`, `account_type`) VALUES
(46, 'addielpuc@gmail.com', 'addiel de jesus', '02-20-2003', '1234', 'PROGRAMADOR', 'Mérida', '3232321312', '9994254746', '1 año programando', 'UNIVERSIDAD', '123123232323', '31323213123', '1690169312_63046d9e90fdca2543e3fe5b858f5d70.jpg', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_publicacion`,`id_usuariocomentador`),
  ADD KEY `id_usuariocomentador` (`id_usuariocomentador`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `remitente_id` (`remitente_id`),
  ADD KEY `destinatario_id` (`destinatario_id`);

--
-- Indices de la tabla `mensajes_chat`
--
ALTER TABLE `mensajes_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes_chat`
--
ALTER TABLE `mensajes_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
