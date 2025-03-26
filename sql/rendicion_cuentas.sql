-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-03-2025 a las 14:05:36
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
-- Base de datos: `rendicion_cuentas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `dni_admin` varchar(8) NOT NULL,
  `nombres_admin` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `categoria_admin` enum('admin','super_admin') NOT NULL,
  `estado` enum('habilitado','deshabilitado') DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `actualizado_en` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`dni_admin`, `nombres_admin`, `password`, `categoria_admin`, `estado`, `creado_en`, `actualizado_en`) VALUES
('40346175', 'MARTHA LUZ TUÑOQUE JULCAS', '$2y$10$n7ZurrZsQR/Ha6liA4SoGun3jEggeie2hxBA09wXeVP8mOplHWT8e', 'super_admin', 'habilitado', '2025-03-12 16:06:51', '2025-03-12 16:09:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eje`
--

CREATE TABLE `eje` (
  `id_eje` varchar(8) NOT NULL,
  `tematica` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejes_seleccionados`
--

CREATE TABLE `ejes_seleccionados` (
  `id_eje_seleccionado` varchar(8) NOT NULL,
  `id_rendicion` varchar(8) DEFAULT NULL,
  `id_eje` varchar(8) DEFAULT NULL,
  `cantidad_preguntas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_admin`
--

CREATE TABLE `historial_admin` (
  `id` varchar(8) NOT NULL,
  `dni_admin` varchar(8) NOT NULL,
  `accion` enum('habilitar','deshabilitar','crear','editar_password') NOT NULL,
  `motivo` text DEFAULT NULL,
  `realizado_por` varchar(8) NOT NULL,
  `fecha_accion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id_pregunta` varchar(8) NOT NULL,
  `contenido` text NOT NULL,
  `id_usuario` varchar(8) DEFAULT NULL,
  `id_eje` varchar(8) DEFAULT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_seleccionadas`
--

CREATE TABLE `preguntas_seleccionadas` (
  `id_pregunta_seleccionada` varchar(8) NOT NULL,
  `id_eje_seleccionado` varchar(8) DEFAULT NULL,
  `id_pregunta` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rendición`
--

CREATE TABLE `rendición` (
  `id_rendicion` varchar(8) NOT NULL,
  `fecha` date NOT NULL,
  `hora_rendicion` time NOT NULL,
  `banner_rendicion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` varchar(8) NOT NULL,
  `nombres` varchar(60) NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `tipo_participacion` enum('asistente','orador') NOT NULL,
  `titulo` enum('PERSONAL','ORGANIZACION') DEFAULT NULL,
  `ruc_empresa` varchar(11) DEFAULT NULL,
  `nombre_empresa` varchar(100) DEFAULT NULL,
  `id_pregunta` varchar(8) DEFAULT NULL,
  `DNI` varchar(8) DEFAULT NULL,
  `id_rendicion` varchar(8) DEFAULT NULL,
  `asistencia` enum('si','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`dni_admin`);

--
-- Indices de la tabla `eje`
--
ALTER TABLE `eje`
  ADD PRIMARY KEY (`id_eje`);

--
-- Indices de la tabla `ejes_seleccionados`
--
ALTER TABLE `ejes_seleccionados`
  ADD PRIMARY KEY (`id_eje_seleccionado`),
  ADD KEY `id_rendicion` (`id_rendicion`),
  ADD KEY `id_eje` (`id_eje`);

--
-- Indices de la tabla `historial_admin`
--
ALTER TABLE `historial_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dni_admin` (`dni_admin`),
  ADD KEY `realizado_por` (`realizado_por`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `dni_usuario` (`id_usuario`),
  ADD KEY `id_eje` (`id_eje`);

--
-- Indices de la tabla `preguntas_seleccionadas`
--
ALTER TABLE `preguntas_seleccionadas`
  ADD PRIMARY KEY (`id_pregunta_seleccionada`),
  ADD KEY `id_eje_seleccionado` (`id_eje_seleccionado`),
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `rendición`
--
ALTER TABLE `rendición`
  ADD PRIMARY KEY (`id_rendicion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`) USING BTREE,
  ADD KEY `id_rendicion` (`id_rendicion`) USING BTREE;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ejes_seleccionados`
--
ALTER TABLE `ejes_seleccionados`
  ADD CONSTRAINT `ejes_seleccionados_ibfk_1` FOREIGN KEY (`id_rendicion`) REFERENCES `rendición` (`id_rendicion`),
  ADD CONSTRAINT `ejes_seleccionados_ibfk_2` FOREIGN KEY (`id_eje`) REFERENCES `eje` (`id_eje`);

--
-- Filtros para la tabla `historial_admin`
--
ALTER TABLE `historial_admin`
  ADD CONSTRAINT `historial_admin_ibfk_1` FOREIGN KEY (`dni_admin`) REFERENCES `administradores` (`dni_admin`) ON UPDATE CASCADE,
  ADD CONSTRAINT `historial_admin_ibfk_2` FOREIGN KEY (`realizado_por`) REFERENCES `administradores` (`dni_admin`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `pregunta_ibfk_2` FOREIGN KEY (`id_eje`) REFERENCES `eje` (`id_eje`);

--
-- Filtros para la tabla `preguntas_seleccionadas`
--
ALTER TABLE `preguntas_seleccionadas`
  ADD CONSTRAINT `preguntas_seleccionadas_ibfk_1` FOREIGN KEY (`id_eje_seleccionado`) REFERENCES `ejes_seleccionados` (`id_eje_seleccionado`),
  ADD CONSTRAINT `preguntas_seleccionadas_ibfk_2` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id_pregunta`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rendicion`) REFERENCES `rendición` (`id_rendicion`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
