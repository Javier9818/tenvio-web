-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 25-11-2020 a las 10:28:27
-- Versión del servidor: 5.6.49
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tenviope_database`
--

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`tenvioperu`@`localhost` FUNCTION `F_DISTANCE` (`LATITUD_1` FLOAT, `LONGITUD_1` FLOAT, `LATITUD_2` FLOAT, `LONGITUD_2` FLOAT) RETURNS FLOAT BEGIN
        DECLARE salida FLOAT;
        SET salida = (acos(sin(radians(LATITUD_1)) * sin(radians(LATITUD_2)) +
                        cos(radians(LATITUD_1)) * cos(radians(LATITUD_2)) *
                        cos(radians(LONGITUD_1) - radians(LONGITUD_2))) * 6378);
        RETURN salida;
        END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

CREATE TABLE `asignacion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asignacion`
--

INSERT INTO `asignacion` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, '2020-09-03 21:11:38', '2020-09-03 21:11:38'),
(2, 4, '2020-09-03 21:54:42', '2020-09-03 21:54:42'),
(3, 4, '2020-09-12 01:24:15', '2020-09-12 01:24:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `descripcion`) VALUES
(1, 'GERENTE'),
(2, 'ADMINISTRADOR'),
(3, 'CONTADOR'),
(4, 'PERSONAL DE NEGOCIO'),
(5, 'PERSONAL DE TRANSPORTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_negocio_id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `descripcion`, `icon`, `tipo_negocio_id`, `state`, `created_at`, `updated_at`) VALUES
(1, 'POLLERIA', 'drumstick-bite', 1, 1, '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(2, 'CHIFA', 'salad', 1, 1, '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(3, 'MENÚS EN GENERAL', 'utensils', 1, 1, '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(4, 'FUENTE DE SODA', 'hamburger', 1, 1, '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(5, 'REPOSTERIA', 'cookie-bite', 2, 1, '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(6, 'BODEGA', 'store', 3, 1, '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(7, 'ROPA HOMBRE', 'tshirt', 4, 1, '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(8, 'ROPA MUJER', 'venus', 4, 1, '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(9, 'ROPA NIÑOS', 'socks', 4, 1, '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(10, 'APARATOS ELECTRÓNICOS EN GENERAL', 'laptop', 5, 1, '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(11, 'REGALOS', 'gifts', 6, 1, '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(12, 'ACCESORIOS HOMBRE', 'male', 6, 1, '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(13, 'ACCESORIOS MUJER', 'female', 6, 1, '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(14, 'ACCESORIOS NIÑOS', 'child', 6, 1, '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(15, 'LIBRERIA', 'book', 7, 1, '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(16, 'VETERINARIA', 'fas fa-paw', 8, 1, '2020-10-19 20:22:54', '2020-10-19 20:22:54'),
(17, 'VIDEOJUEGOS', 'fas fa-gamepad', 5, 0, '2020-10-19 22:11:38', '2020-10-19 22:11:57'),
(18, 'VIDEOJUEGOS', 'fas fa-gamepad', 9, 1, '2020-10-19 22:12:33', '2020-10-19 22:12:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_menus`
--

CREATE TABLE `categorias_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `estado` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias_menus`
--

INSERT INTO `categorias_menus` (`id`, `descripcion`, `empresa_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Comida', 1, '1', '2020-09-03 19:31:02', '2020-09-03 19:31:02'),
(2, 'Bebidas', 1, '1', '2020-09-03 19:31:09', '2020-09-03 19:31:09'),
(3, 'Extras', 1, '1', '2020-09-03 19:31:14', '2020-09-03 19:31:14'),
(4, 'Ropa', 3, '1', '2020-09-30 04:51:45', '2020-09-30 04:51:45'),
(5, 'Libro', 7, '1', '2020-10-19 20:57:07', '2020-10-19 20:57:07'),
(6, 'Accesorio', 9, '1', '2020-10-19 20:59:54', '2020-10-19 20:59:54'),
(7, 'Accesorio', 10, '1', '2020-10-19 21:02:47', '2020-10-19 21:02:47'),
(8, 'Accesorio', 12, '1', '2020-10-19 21:08:16', '2020-10-19 21:08:16'),
(9, 'Accesorio', 14, '1', '2020-10-19 21:11:37', '2020-10-19 21:11:37'),
(10, 'Pollo a la braza', 4, '1', '2020-10-19 21:12:49', '2020-10-19 21:12:49'),
(11, 'Combos', 4, '1', '2020-10-19 21:12:56', '2020-10-19 21:12:56'),
(12, 'Chaufa criollo', 4, '1', '2020-10-19 21:13:07', '2020-10-19 21:13:07'),
(13, 'Alimento', 15, '1', '2020-10-19 21:15:11', '2020-10-19 21:15:11'),
(14, 'Torta', 16, '1', '2020-10-19 21:18:41', '2020-10-19 21:18:41'),
(15, 'Alimento', 17, '1', '2020-10-19 21:21:44', '2020-10-19 21:21:44'),
(16, 'Alimento', 19, '1', '2020-10-19 21:26:54', '2020-10-19 21:26:54'),
(17, 'Ropa', 20, '1', '2020-10-19 21:29:11', '2020-10-19 21:29:11'),
(18, 'Pollo a la braza', 5, '1', '2020-10-19 21:41:40', '2020-10-19 21:41:40'),
(19, 'Comida para perros', 11, '1', '2020-10-19 21:46:31', '2020-10-19 21:46:31'),
(20, 'Comida para gatos', 11, '1', '2020-10-19 21:46:46', '2020-10-19 21:46:46'),
(21, 'Atención médica veterinaria', 11, '1', '2020-10-19 21:47:00', '2020-10-19 21:47:00'),
(22, 'Galletas', 29, '1', '2020-10-19 21:56:35', '2020-10-19 21:56:35'),
(23, 'Detergentes', 29, '1', '2020-10-19 21:56:42', '2020-10-19 21:56:42'),
(24, 'Bebidas gaseosas', 29, '1', '2020-10-19 21:56:55', '2020-10-19 21:56:55'),
(25, 'Menú', 30, '1', '2020-10-19 22:04:13', '2020-10-19 22:04:13'),
(26, 'Bebidas', 30, '1', '2020-10-19 22:04:23', '2020-10-19 22:04:23'),
(27, 'Plato a la carta', 30, '1', '2020-10-19 22:04:35', '2020-10-19 22:04:35'),
(28, 'Comida', 8, '1', '2020-10-19 22:09:46', '2020-10-19 22:09:46'),
(29, 'Focos', 26, '1', '2020-10-19 22:11:21', '2020-10-19 22:11:21'),
(30, 'Alambre', 26, '1', '2020-10-19 22:11:31', '2020-10-19 22:11:31'),
(31, 'Deportes', 33, '1', '2020-10-19 22:15:21', '2020-10-19 22:15:21'),
(32, 'Consola de videojuegos', 33, '1', '2020-10-19 22:15:30', '2020-10-19 22:15:30'),
(33, 'Luchas', 33, '1', '2020-10-19 22:15:41', '2020-10-19 22:15:41'),
(34, 'Electronico', 32, '1', '2020-10-19 22:15:45', '2020-10-19 22:15:45'),
(35, 'Polos Estampados', 31, '1', '2020-10-19 22:46:30', '2020-10-19 22:46:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_empresa`
--

CREATE TABLE `categoria_empresa` (
  `empresa_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria_empresa`
--

INSERT INTO `categoria_empresa` (`empresa_id`, `categoria_id`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, NULL),
(1, 1, NULL, NULL),
(3, 8, NULL, NULL),
(4, 1, NULL, NULL),
(7, 15, NULL, NULL),
(8, 1, NULL, NULL),
(9, 12, NULL, NULL),
(10, 13, NULL, NULL),
(11, 16, NULL, NULL),
(5, 1, NULL, NULL),
(12, 14, NULL, NULL),
(13, 2, NULL, NULL),
(14, 11, NULL, NULL),
(15, 6, NULL, NULL),
(16, 5, NULL, NULL),
(17, 4, NULL, NULL),
(18, 5, NULL, NULL),
(19, 2, NULL, NULL),
(20, 8, NULL, NULL),
(22, 7, NULL, NULL),
(22, 8, NULL, NULL),
(23, 15, NULL, NULL),
(25, 1, NULL, NULL),
(26, 10, NULL, NULL),
(27, 11, NULL, NULL),
(27, 12, NULL, NULL),
(27, 13, NULL, NULL),
(27, 14, NULL, NULL),
(29, 6, NULL, NULL),
(28, 11, NULL, NULL),
(28, 12, NULL, NULL),
(28, 13, NULL, NULL),
(28, 14, NULL, NULL),
(24, 15, NULL, NULL),
(30, 3, NULL, NULL),
(31, 7, NULL, NULL),
(31, 8, NULL, NULL),
(31, 9, NULL, NULL),
(32, 10, NULL, NULL),
(33, 18, NULL, NULL),
(21, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distrito_id` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `nombre`, `distrito_id`, `created_at`, `updated_at`) VALUES
(1, 'Trujillo', '130101', '2020-09-03 19:30:04', '2020-09-03 19:30:04'),
(2, 'Trujillo', '130101', '2020-09-03 20:56:47', '2020-09-03 20:56:47'),
(3, 'Laredo', '130106', '2020-09-30 04:48:11', '2020-09-30 04:48:11'),
(4, 'Trujillo', '130102', '2020-10-19 19:57:48', '2020-10-19 19:57:48'),
(5, 'Trujillo', '130102', '2020-10-19 20:00:39', '2020-10-19 20:00:39'),
(7, 'Florencia De Mora', '130103', '2020-10-19 21:03:37', '2020-10-19 21:03:37'),
(8, 'Trujillo', '130105', '2020-10-19 21:55:10', '2020-10-19 21:55:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE `contratos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_precio` double(8,2) NOT NULL,
  `pedidos_total` int(11) NOT NULL,
  `pedidos_contador` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL DEFAULT '2020-09-03 13:21:06',
  `fecha_vencimiento` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`id`, `empresa_id`, `plan_id`, `estado`, `plan_precio`, `pedidos_total`, `pedidos_contador`, `fecha_inicio`, `fecha_vencimiento`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'VIGENTE', 0.00, 0, 1, '2020-09-03 13:21:06', '2020-10-03 14:30:05', '2020-09-03 19:30:05', '2020-09-03 21:15:06'),
(2, 2, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-10-03 15:56:47', '2020-09-03 20:56:47', '2020-09-03 20:56:47'),
(3, 3, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-10-29 23:48:11', '2020-09-30 04:48:11', '2020-09-30 04:48:11'),
(4, 4, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 14:57:48', '2020-10-19 19:57:48', '2020-10-19 19:57:48'),
(5, 5, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 15:00:39', '2020-10-19 20:00:39', '2020-10-19 20:00:39'),
(6, 7, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 15:14:54', '2020-10-19 20:14:55', '2020-10-19 20:14:55'),
(7, 8, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 15:53:27', '2020-10-19 20:53:27', '2020-10-19 20:53:27'),
(8, 9, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 15:59:34', '2020-10-19 20:59:34', '2020-10-19 20:59:34'),
(9, 10, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:02:18', '2020-10-19 21:02:18', '2020-10-19 21:02:18'),
(10, 11, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:03:37', '2020-10-19 21:03:37', '2020-10-19 21:03:37'),
(11, 12, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:07:52', '2020-10-19 21:07:52', '2020-10-19 21:07:52'),
(12, 13, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:07:54', '2020-10-19 21:07:54', '2020-10-19 21:07:54'),
(13, 14, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:10:27', '2020-10-19 21:10:27', '2020-10-19 21:10:27'),
(14, 15, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:14:27', '2020-10-19 21:14:27', '2020-10-19 21:14:27'),
(15, 16, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:18:12', '2020-10-19 21:18:12', '2020-10-19 21:18:12'),
(16, 17, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:20:35', '2020-10-19 21:20:35', '2020-10-19 21:20:35'),
(17, 18, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:23:07', '2020-10-19 21:23:07', '2020-10-19 21:23:07'),
(18, 19, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:25:28', '2020-10-19 21:25:28', '2020-10-19 21:25:28'),
(19, 20, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:28:54', '2020-10-19 21:28:54', '2020-10-19 21:28:54'),
(20, 21, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:32:54', '2020-10-19 21:32:54', '2020-10-19 21:32:54'),
(21, 22, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:36:09', '2020-10-19 21:36:09', '2020-10-19 21:36:09'),
(22, 23, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:40:49', '2020-10-19 21:40:49', '2020-10-19 21:40:49'),
(23, 24, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:40:49', '2020-10-19 21:40:49', '2020-10-19 21:40:49'),
(24, 25, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:43:10', '2020-10-19 21:43:10', '2020-10-19 21:43:10'),
(25, 27, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:54:23', '2020-10-19 21:54:23', '2020-10-19 21:54:23'),
(26, 28, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:54:24', '2020-10-19 21:54:24', '2020-10-19 21:54:24'),
(27, 29, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 16:54:55', '2020-10-19 21:54:55', '2020-10-19 21:54:55'),
(28, 26, 1, 'VIGENTE', 0.00, 100, 0, '2020-09-03 13:21:06', '2020-11-18 16:55:10', '2020-10-19 21:55:10', '2020-10-19 21:55:10'),
(29, 30, 1, 'VIGENTE', 0.00, 100, 0, '2020-09-03 13:21:06', '2020-11-18 17:01:02', '2020-10-19 22:01:02', '2020-10-19 22:01:02'),
(30, 30, 1, 'VIGENTE', 0.00, 100, 0, '2020-09-03 13:21:06', '2020-11-18 17:01:15', '2020-10-19 22:01:15', '2020-10-19 22:01:15'),
(31, 30, 1, 'VIGENTE', 0.00, 100, 0, '2020-09-03 13:21:06', '2020-11-18 17:01:18', '2020-10-19 22:01:18', '2020-10-19 22:01:18'),
(32, 30, 1, 'VIGENTE', 0.00, 100, 0, '2020-09-03 13:21:06', '2020-11-18 17:01:26', '2020-10-19 22:01:26', '2020-10-19 22:01:26'),
(33, 31, 1, 'VIGENTE', 0.00, 100, 0, '2020-09-03 13:21:06', '2020-11-18 17:10:18', '2020-10-19 22:10:18', '2020-10-19 22:10:18'),
(34, 32, 1, 'VIGENTE', 0.00, 100, 0, '2020-09-03 13:21:06', '2020-11-18 17:10:31', '2020-10-19 22:10:31', '2020-10-19 22:10:31'),
(35, 33, 1, 'VIGENTE', 0.00, 0, 0, '2020-09-03 13:21:06', '2020-11-18 17:13:31', '2020-10-19 22:13:31', '2020-10-19 22:13:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pagos`
--

CREATE TABLE `detalle_pagos` (
  `pedido_id` int(11) NOT NULL,
  `pago_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `producto_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unit` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`producto_id`, `pedido_id`, `cantidad`, `precio_unit`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 50, NULL, NULL),
(2, 1, 1, 28, NULL, NULL),
(2, 2, 1, 28, NULL, NULL),
(6, 3, 3, 7, NULL, NULL),
(5, 3, 2, 8, NULL, NULL),
(1, 4, 2, 50, NULL, NULL),
(2, 4, 1, 28, NULL, NULL),
(1, 5, 2, 50, NULL, NULL),
(1, 6, 2, 50, NULL, NULL),
(1, 7, 1, 50, NULL, NULL),
(2, 13, 7, 28, NULL, NULL),
(1, 28, 1, 50, NULL, NULL),
(2, 28, 1, 28, NULL, NULL),
(1, 29, 1, 50, NULL, NULL),
(1, 30, 1, 50, NULL, NULL),
(1, 31, 1, 50, NULL, NULL),
(2, 32, 2, 28, NULL, NULL),
(6, 32, 1, 7, NULL, NULL),
(2, 33, 2, 28, NULL, NULL),
(1, 34, 5, 50, NULL, NULL),
(45, 35, 1, 60, NULL, NULL),
(43, 35, 5, 145, NULL, NULL),
(43, 36, 1, 145, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ruc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_unico` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ciudad_id` int(11) NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `latitud` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitud` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `token_fb` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_fb` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `ruc`, `nombre`, `nombre_unico`, `descripcion`, `telefono`, `celular`, `direccion`, `foto`, `ciudad_id`, `estado`, `latitud`, `longitud`, `created_at`, `updated_at`, `token_fb`, `id_fb`) VALUES
(1, NULL, 'Polleria Pio', 'polleriapio', NULL, NULL, '981559813', 'Av. Tupac amaru', 'Obmq9MyhUtxbSSQKlNy3.jpg', 1, 'ACTIVO', '-7.8915768077574', '-79.224460850099', '2020-09-03 19:30:04', '2020-11-25 14:28:54', 'EAAEqLEdsSEABAMq2GXGlSWzTP2Ny2Yae6rTnZBEULzgTMBRdca6LwjVE3IoKDdJNyus88bjU98aZCt5H1LeTZCzapIyNc5M6myhOeKQm71inhaymVXqRYWZCXzeGeK34f5dOtEkfkZAJJh3Dm6bfEjae4z3DoWpV0y51ZCEgZC5CVPkdlpZB6RG2OZBLDrvU7RZBwZD', '101763614990705'),
(2, '47532222252', 'Pollería Diegos', 'polleriadiegos', NULL, '9595959595', '94949494', 'mi casita #124234', 'J4d0iMuYPOAd0fAtJ2Sw.jpg', 2, 'ACTIVO', NULL, NULL, '2020-09-03 20:56:47', '2020-09-04 02:19:28', NULL, NULL),
(3, NULL, 'Variedades Avaloszz', 'variedadesavalos', NULL, NULL, '985465321', 'Laredo', 'LDygojAIEUSou1uXEfN6.jpg', 3, 'ACTIVO', NULL, NULL, '2020-09-30 04:48:11', '2020-09-30 05:20:48', 'EAAEqLEdsSEABAIstdP5iXpV7YPmZATwW3uAqmBXzlSYqaGxUs0BvV31vg5LKNEJ04V1EgQWyK7fXlZAEl4lotzoZC2FVQctFLPz5Wd97jULTUokUcwZBeCYhDDGWLCQE3cdbFeTv03c11D2bgG8aKEwxvAN8SxJImesIDIKpSe8RZB9vHVD82aNakass4do4ZD', '102074064915508'),
(4, '10734378701', 'Jhordy el niño de la pollería', 'jhordyelniñodelapollería', NULL, '044401796', '902007640', 'Baltazar Villalonga 1985', 'ouuKGSLjd7aLwdsx5u7c.jpg', 4, 'ACTIVO', NULL, NULL, '2020-10-19 19:57:48', '2020-10-19 21:37:52', NULL, NULL),
(5, '10734378701', 'Pollería El Pelado de las brazzas', 'jhordyelniñodelapollería2', NULL, '044401796', '902007640', 'Baltazar Villalonga 1985', 'ap73BBBxd0pYvk9FTMrt.jpg', 5, 'ACTIVO', NULL, NULL, '2020-10-19 20:00:39', '2020-10-19 21:41:24', NULL, NULL),
(7, NULL, 'Librería El Estudiante', 'libreríaelestudiante', NULL, NULL, '947584652', 'Av. Juan Pablo II 1547', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 20:14:54', '2020-10-19 20:14:54', NULL, NULL),
(8, NULL, 'Polleria DON ZAGA', 'donzaga', NULL, NULL, '999797514', 'Jiron Alcides Carrion 421', 'hva6IJa5SGo9R3P90BQs.jpg', 1, 'ACTIVO', NULL, NULL, '2020-10-19 20:53:27', '2020-10-19 20:58:44', NULL, NULL),
(9, NULL, 'Variedades El Men', 'variedadeselmen', NULL, NULL, '985465215', 'Av. Juan Paoblo II 852', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 20:59:34', '2020-10-19 20:59:34', NULL, NULL),
(10, NULL, 'Variedades The Girls', 'variedadesthegirls', NULL, NULL, '948565871', 'Av. Juan Paoblo II 852', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 21:02:17', '2020-10-19 21:02:17', NULL, NULL),
(11, '10734378711', 'Los amorosos', 'losamorosos', NULL, '044401796', '902007640', 'Tupac Yupanqui 779', 'fpWUfXo1TFcCTYDuXYab.jpg', 7, 'ACTIVO', NULL, NULL, '2020-10-19 21:03:37', '2020-10-19 21:44:25', NULL, NULL),
(12, NULL, 'Variedades Gotitas', 'variedadesgotitas', NULL, NULL, '986522243', 'Av. Juan Paoblo II 321', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 21:07:52', '2020-10-19 21:07:52', NULL, NULL),
(13, NULL, 'Chifa Wang', 'chifawang', NULL, NULL, '979154605', 'Alcides Carrión 420', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 21:07:54', '2020-10-19 21:07:54', NULL, NULL),
(14, NULL, 'Regalos y Accesorios', 'regalosyaccesorios', NULL, NULL, '963852852', 'Av. Juan Paoblo II 2133', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 21:10:27', '2020-10-19 21:10:27', NULL, NULL),
(15, NULL, 'Don Pepe', 'donpepe', NULL, NULL, '963214587', 'Av. Ricardo Palma 541', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 21:14:27', '2020-10-19 21:14:27', NULL, NULL),
(16, NULL, 'Panadería El Glotón', 'panaderíaelglotón', NULL, NULL, '968541523', 'Av. Juan Paoblo II 859', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 21:18:12', '2020-10-19 21:18:12', NULL, NULL),
(17, NULL, 'Fuente de Soda Guapoooo', 'fuentedesodaguapoooo', NULL, NULL, '968552251', 'Av. Juan Paoblo II 222', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 21:20:35', '2020-10-19 21:20:35', NULL, NULL),
(18, NULL, 'DulciNelly', 'dulcinelly', NULL, '044242626', '978956412', 'Jirón Junin 497', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 21:23:07', '2020-10-19 21:23:07', NULL, NULL),
(19, NULL, 'Chifa Guau Guau', 'chifaguauguau', NULL, NULL, '968555221', 'Av. España 852', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 21:25:28', '2020-10-19 21:25:28', NULL, NULL),
(20, NULL, 'Variedades Carlita', 'variedadescarlita', NULL, NULL, '968555552', 'Av. España 965', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 21:28:54', '2020-10-19 21:28:54', NULL, NULL),
(21, NULL, 'Doña Petaxxx', 'doñapeta', NULL, NULL, '924136358', 'Alcides Carrión 354', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 21:32:54', '2020-10-25 23:02:48', NULL, NULL),
(22, NULL, 'Fly Boutique', 'flyboutique', NULL, NULL, '938675364', 'Jirón Independencia 179', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 21:36:09', '2020-10-19 21:36:09', NULL, NULL),
(23, NULL, 'Librería Histórica', 'libreríahistórica', NULL, NULL, '912843763', 'Av. Mansiche', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 21:40:49', '2020-10-19 21:40:49', NULL, NULL),
(24, NULL, 'Librería Crisol', 'libreríahistórica2', NULL, NULL, '933369522', '1er Piso Interior 131 C.C. Real Plaza', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 21:40:49', '2020-10-19 21:58:24', NULL, NULL),
(25, NULL, 'Pollería Roky\'s', 'polleríaroky\'s', NULL, '044231623', '949658217', 'Av. América Nte. 2402', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 21:43:10', '2020-10-19 21:43:10', NULL, NULL),
(26, '17152635688', 'Servel', 'servel', NULL, '239615', '933076374', 'Arévalo II Etapa', 'logoEmpresaDefault.png', 8, 'ACTIVO', NULL, NULL, '2020-10-19 21:53:11', '2020-10-19 21:55:11', NULL, NULL),
(27, NULL, 'Regalitos', 'regalitos', NULL, '044262117', '947996325', 'Independencia 305', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 21:54:23', '2020-10-19 21:54:23', NULL, NULL),
(28, NULL, 'Toko Online', 'regalitos2', NULL, '044262117', '948923758', 'Jirón Ayacucho 358', NULL, 1, 'ACTIVO', NULL, NULL, '2020-10-19 21:54:24', '2020-10-19 21:56:35', NULL, NULL),
(29, '10734378721', 'Bodega Don Cava', 'bodegadoncava', NULL, '044401796', '902007640', 'Baltazar Villalonga 1985', 'DlbHr2iZSMpaEmtyRMD8.jpg', 4, 'ACTIVO', NULL, NULL, '2020-10-19 21:54:55', '2020-10-19 21:55:42', NULL, NULL),
(30, '15697412369', 'El Anzuelo', 'elanzuelo', NULL, NULL, '933745693', 'La Esperanza', 'logoEmpresaDefault.png', 8, 'ACTIVO', NULL, NULL, '2020-10-19 21:59:56', '2020-10-19 22:01:27', NULL, NULL),
(31, NULL, 'Cafra', 'cafra', NULL, NULL, '981171146', 'Mz N Lt 07  AA.HH Centenario  Laredo', 'lBC7FWFfwxYkBi1rKTRn.jpg', 3, 'ACTIVO', NULL, NULL, '2020-10-19 22:04:25', '2020-10-19 22:45:51', NULL, NULL),
(32, NULL, 'Tecnology Fazt', 'tecnologyfazt', NULL, NULL, '937229792', 'Covicorti', 'WDgdHhjg8nqhF3xw8x6g.jpg', 1, 'ACTIVO', NULL, NULL, '2020-10-19 22:06:13', '2020-10-19 22:10:56', NULL, NULL),
(33, '10734378731', 'Videojuegos fornais', 'videojuegosfornais', NULL, NULL, '902007640', 'Centro de trujillo', 'be0eWaOsMJDFVha7g8RO.jpg', 1, 'ACTIVO', NULL, NULL, '2020-10-19 22:13:31', '2020-10-19 22:13:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_05_14_232637_create_users_empresas_table', 1),
(5, '2020_05_14_232809_create_empresas_table', 1),
(6, '2020_05_14_233443_create_categorias_table', 1),
(7, '2020_05_14_233536_create_contratos_table', 1),
(8, '2020_05_14_233651_create_permiso_user_table', 1),
(9, '2020_05_14_233805_create_permisos_table', 1),
(10, '2020_05_14_233937_create_personas_table', 1),
(11, '2020_05_14_234319_create_categorias_menus_table', 1),
(12, '2020_05_14_234634_create_productos_table', 1),
(13, '2020_05_14_235235_create_pedidos_table', 1),
(14, '2020_05_14_235526_create_detalle_pedidos_table', 1),
(15, '2020_05_14_235714_create_tipo_entregas_table', 1),
(16, '2020_05_14_235947_create_programas_table', 1),
(17, '2020_05_15_000220_create_pagos_table', 1),
(18, '2020_05_15_000448_create_detalle_pagos_table', 1),
(19, '2020_05_19_023249_create_cargos_table', 1),
(20, '2020_05_22_034052_create_tipo_entrega_empresas_table', 1),
(21, '2020_05_24_211339_create_ciudad_table', 1),
(22, '2020_06_02_225922_create_websockets_statistics_entries_table', 1),
(23, '2020_06_03_155959_create_pedidos_users_table', 1),
(24, '2020_06_18_044245_create_asignacion_table', 1),
(25, '2020_06_19_201757_create_tipo_negocio_table', 1),
(26, '2020_06_19_201849_create_categoria_empresa_table', 1),
(27, '2020_06_23_190414_create_plan_table', 1),
(28, '2020_08_26_014248_create_tipopagos_table', 1),
(29, '2020_08_26_014909_create_tipopago_empresas_table', 1),
(30, '2020_09_03_190414_create_transculqi_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `contratos_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `precio` double NOT NULL,
  `cantidad_pedidos` int(11) NOT NULL,
  `urlfoto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `empresa_id`, `contratos_id`, `plan_id`, `precio`, `cantidad_pedidos`, `urlfoto`, `estado`, `observacion`, `created_at`, `updated_at`) VALUES
(1, 26, 28, 1, 0, 100, '', 'APROBADO', NULL, '2020-10-19 21:55:10', '2020-10-19 21:55:10'),
(2, 30, 29, 1, 0, 100, '', 'APROBADO', NULL, '2020-10-19 22:01:02', '2020-10-19 22:01:02'),
(3, 30, 30, 1, 0, 100, '', 'APROBADO', NULL, '2020-10-19 22:01:18', '2020-10-19 22:01:18'),
(4, 30, 31, 1, 0, 100, '', 'APROBADO', NULL, '2020-10-19 22:01:18', '2020-10-19 22:01:18'),
(5, 30, 32, 1, 0, 100, '', 'APROBADO', NULL, '2020-10-19 22:01:27', '2020-10-19 22:01:27'),
(6, 31, 33, 1, 0, 100, '', 'APROBADO', NULL, '2020-10-19 22:10:19', '2020-10-19 22:10:19'),
(7, 32, 34, 1, 0, 100, '', 'APROBADO', NULL, '2020-10-19 22:10:31', '2020-10-19 22:10:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDIENTE',
  `estadoPago` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tipopago` int(11) NOT NULL,
  `id_regpago` int(11) NOT NULL,
  `comentario` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitud` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitud` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_latitud` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_longitud` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `empresa_id`, `estado`, `estadoPago`, `id_tipopago`, `id_regpago`, `comentario`, `latitud`, `longitud`, `meta_latitud`, `meta_longitud`, `user_id`, `tipo_id`, `direccion`, `monto`, `created_at`, `updated_at`) VALUES
(1, 1, 'ENTREGADO', 'NO PAGADO', 6, 0, NULL, '-7.8933014079007', '-79.226136487912', NULL, NULL, 3, 1, 'Urb. Las Gardenias Mzn F23', 128, '2020-09-03 21:03:26', '2020-09-03 21:15:06'),
(2, 1, 'ACEPTADO', 'NO PAGADO', 6, 0, NULL, '-7.8932994085231', '-79.226098225569', NULL, NULL, 3, 1, 'Urb. Las Gardenias Mzn F23', 28, '2020-09-03 21:06:45', '2020-09-03 21:07:45'),
(3, 1, 'PENDIENTE', 'PAGADO', 5, 1, NULL, '-8.08621', '-79.00619', NULL, NULL, 2, 1, 'av peru #4342', 37, '2020-09-03 21:26:06', '2020-09-03 21:26:06'),
(4, 1, 'ENVIANDO', 'PAGADO', 5, 2, NULL, '-8.1191', '-79.0355', NULL, NULL, 1, 1, 'Baltazar Villalonga 1985', 128, '2020-09-03 21:48:33', '2020-09-03 21:54:42'),
(5, 1, 'ACEPTADO', 'NO PAGADO', 6, 0, NULL, '-7.894733075651', '-79.225431141544', NULL, NULL, 1, 1, 'Urb las cecinas 22', 100, '2020-09-07 00:37:22', '2020-09-07 00:47:49'),
(6, 1, 'PENDIENTE', 'NO PAGADO', 6, 0, NULL, '-7.8919816545057', '-79.226273167746', NULL, NULL, 1, 1, 'Urb las cecinas 22', 100, '2020-09-07 00:45:00', '2020-09-07 00:45:00'),
(7, 1, 'PENDIENTE', 'NO PAGADO', 6, 0, NULL, '-7.8924502639473', '-79.225983191585', NULL, NULL, 1, 1, 'Urb las cecinas 22', 50, '2020-09-07 00:47:07', '2020-09-07 00:47:07'),
(13, 1, 'CANCELADO', 'DEVUELTO', 5, 8, 'ya se acabaron los pollos :(', '-8.08663', '-79.007044', NULL, NULL, 2, 1, 'asdasd', 196, '2020-09-10 19:55:29', '2020-09-10 19:56:18'),
(28, 1, 'PENDIENTE', 'NO PAGADO', 6, 0, '- - -', '-8.1166', '-79.0333', NULL, NULL, 1, 1, 'ghgcgcghc', 78, '2020-09-12 01:16:57', '2020-09-12 01:16:57'),
(29, 1, 'PENDIENTE', 'PAGADO', 5, 15, '- - -', '-8.1166', '-79.0333', NULL, NULL, 1, 1, 'efsafsaf', 50, '2020-09-12 01:18:18', '2020-09-12 01:18:18'),
(30, 1, 'ENVIANDO', 'PAGADO', 5, 16, 'dvilla0898@gmail.com - referencia', '-8.1166', '-79.0333', NULL, NULL, 6, 1, 'adasfasf', 50, '2020-09-12 01:21:31', '2020-09-12 01:24:15'),
(31, 1, 'PENDIENTE', 'PAGADO', 5, 17, 'dvilla0898@gmail.com - Por el estadio', '-8.1166', '-79.0333', NULL, NULL, 6, 1, 'Av. Tupac Amaru 123', 50, '2020-09-12 01:35:07', '2020-09-12 01:35:07'),
(32, 1, 'PENDIENTE', 'PAGADO', 5, 18, 'rimenri@hotmail.com - Frente a la corte', '-8.1166', '-79.0333', NULL, NULL, 6, 1, 'Av. los cocorocos 666', 63, '2020-09-12 01:42:18', '2020-09-12 01:42:18'),
(33, 1, 'PENDIENTE', 'PAGADO', 5, 19, 'correo1@email.com - por el estadio mansiche', '-8.09106', '-79.039244', NULL, NULL, 6, 1, 'av. Tupac amaru 321', 56, '2020-10-13 21:51:41', '2020-10-13 21:51:41'),
(34, 1, 'PENDIENTE', 'PAGADO', 5, 20, 'dvilla0898@gmail.com - Por el estadio mansiche', '-8.10609', '-79.044305', NULL, NULL, 6, 1, 'Av. tupac amaru 1457', 250, '2020-10-15 04:27:54', '2020-10-15 04:27:54'),
(35, 11, 'PENDIENTE', 'NO PAGADO', 6, 0, '- - -', '-8.0833', '-79', NULL, NULL, 1, 1, 'vvvvvv', 785, '2020-10-20 13:53:28', '2020-10-20 13:53:28'),
(36, 11, 'PENDIENTE', 'NO PAGADO', 6, 0, '- - -', '-8.0833', '-79', NULL, NULL, 1, 1, 'ss', 145, '2020-10-20 13:54:58', '2020-10-20 13:54:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_users`
--

CREATE TABLE `pedidos_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asignacion_id` int(11) NOT NULL,
  `pedidos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos_users`
--

INSERT INTO `pedidos_users` (`id`, `asignacion_id`, `pedidos_id`) VALUES
(1, 1, 1),
(2, 2, 4),
(3, 3, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Gestión de personal', NULL, NULL),
(2, 'Gestión de contabilidad', NULL, NULL),
(3, 'Gestión de pedidos', NULL, NULL),
(4, 'Gestión de productos', NULL, NULL),
(5, 'Repartidor delivery', NULL, NULL),
(6, 'Gestión de datos de negocio', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_user`
--

CREATE TABLE `permiso_user` (
  `permiso_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permiso_user`
--

INSERT INTO `permiso_user` (`permiso_id`, `user_id`, `created_at`, `updated_at`) VALUES
(7, 4, NULL, NULL),
(1, 4, NULL, NULL),
(2, 4, NULL, NULL),
(3, 4, NULL, NULL),
(4, 4, NULL, NULL),
(5, 4, NULL, NULL),
(6, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombres` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appaterno` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apmaterno` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombres`, `appaterno`, `apmaterno`, `dni`, `celular`, `direccion`, `created_at`, `updated_at`) VALUES
(1, 'Javier', 'Briceño', 'Montaño', '72764269', '981559813', 'Urb.Las Gardenias Maz F. Lte 23', '2020-09-03 18:29:49', '2020-09-03 18:29:49'),
(2, 'Jairo', 'Navez', 'Aroca', '72409948', '956504624', 'Manuel Ubalde #822', '2020-09-03 18:29:49', '2020-09-03 18:29:49'),
(3, 'Manuel', 'Cruz', 'Rodriguez', NULL, '981559813', NULL, '2020-09-03 20:33:55', '2020-09-03 20:33:55'),
(4, 'Robert', 'Gutierrez', 'Castañeda', '72764269', '981559813', 'Ninguna', '2020-09-03 21:11:14', '2020-09-03 21:11:14'),
(5, 'Jhordan', 'Romero', 'Arce', NULL, '933076374', NULL, '2020-09-10 07:17:15', '2020-09-10 07:17:15'),
(6, 'teenviobotN', 'teenviobotA', 'teenviobotM', NULL, '981171146', NULL, '2020-09-10 18:59:35', '2020-09-10 18:59:35'),
(7, 'Robert', 'Gutierrez', 'Castañeda', NULL, '981171146', NULL, '2020-09-17 16:07:16', '2020-09-17 16:07:16'),
(8, 'Luis Homero', 'Zegarra', 'Fernández', NULL, '935685266', NULL, '2020-10-27 03:03:18', '2020-10-27 03:03:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan`
--

CREATE TABLE `plan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` double(8,2) NOT NULL,
  `cantidad_pedidos` int(11) NOT NULL,
  `tipo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plan`
--

INSERT INTO `plan` (`id`, `nombre`, `descripcion`, `precio`, `cantidad_pedidos`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'BÁSICO', 'Plan básico gratuito', 0.00, 100, 'PLAN', '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(2, 'EMPRENDEDOR', 'Plan básico emprendedor', 10.00, 200, 'PLAN', '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(3, 'MICRO EMPRESA', 'Plan microempresa', 30.00, 400, 'PLAN', '2020-09-03 18:29:51', '2020-09-03 18:29:51'),
(4, 'EMPRESARIAL', 'Plan empresarial', 50.00, 800, 'PLAN', '2020-09-03 18:29:51', '2020-09-03 18:29:51'),
(5, 'EMPRESARIAL PRO', 'Plan empresarial pro', 80.00, 1600, 'PLAN', '2020-09-03 18:29:51', '2020-09-03 18:29:51'),
(6, 'PAQUETE 100 PEDIDOS', 'Añade 100 pedidos más a tu plan', 5.00, 100, 'EXTENSIÓN', '2020-09-03 18:29:51', '2020-09-03 18:29:51'),
(7, 'PAQUETE 200 PEDIDOS', 'Añade 200 pedidos más a tu plan', 10.00, 200, 'EXTENSIÓN', '2020-09-03 18:29:51', '2020-09-03 18:29:51'),
(8, 'PAQUETE 300 PEDIDOS', 'Añade 300 pedidos más a tu plan', 15.00, 300, 'EXTENSIÓN', '2020-09-03 18:29:51', '2020-09-03 18:29:51'),
(9, 'PAQUETE 400 PEDIDOS', 'Añade 400 pedidos más a tu plan', 20.00, 400, 'EXTENSIÓN', '2020-09-03 18:29:51', '2020-09-03 18:29:51'),
(10, 'PAQUETE 500 PEDIDOS', 'Añade 500 pedidos más a tu plan', 25.00, 500, 'EXTENSIÓN', '2020-09-03 18:29:51', '2020-09-03 18:29:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_blog`
--

CREATE TABLE `post_blog` (
  `id` int(11) NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `likes` int(11) NOT NULL DEFAULT '0',
  `time` datetime NOT NULL,
  `is_follow` tinyint(1) NOT NULL DEFAULT '0',
  `is_liked` tinyint(1) NOT NULL DEFAULT '0',
  `is_commentLike` tinyint(1) NOT NULL DEFAULT '1',
  `user` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` double NOT NULL,
  `categorias_menu_id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `estado` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_puede_ver` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `foto`, `precio`, `categorias_menu_id`, `empresa_id`, `estado`, `usuario_puede_ver`, `created_at`, `updated_at`) VALUES
(1, 'Pollo entero', '1 pollo + papas + ensalada', '200903153237_9958.jpg', 50, 1, 1, '1', '1', '2020-09-03 19:31:45', '2020-09-03 20:32:39'),
(2, '1/2 pollo', '1/2 pollo + ensalada + papas', '200903153247_3971.jpg', 28, 1, 1, '1', '1', '2020-09-03 19:32:16', '2020-09-03 20:32:48'),
(3, '1/4 pollo', '1/4 pollo + papas + ensalada', '200903153316_8988.jpg', 15, 1, 1, '1', '1', '2020-09-03 19:32:46', '2020-09-03 20:33:18'),
(4, 'Porcion de papas', '1 porcion de papas completa', '200903153326_1164.jpg', 10, 3, 1, '1', '1', '2020-09-03 19:33:11', '2020-09-03 20:33:28'),
(5, '1 porcion ensalada', '1 porcion de ensalada familiar', '200903153335_9831.jpg', 8, 3, 1, '1', '1', '2020-09-03 19:33:35', '2020-09-03 20:33:37'),
(6, 'Inka Cola', 'Bebida gasificada 1 L', '200903200446_0935.png', 7, 2, 1, '1', '1', '2020-09-03 19:34:11', '2020-09-04 01:05:48'),
(7, 'Pepsi 1.5 L.', 'Bebida gasificada 1.5 L.', '200903153346_6897.jpg', 6.5, 2, 1, '1', '1', '2020-09-03 19:34:38', '2020-09-03 20:33:48'),
(8, 'Vestido', 'Vestido Jean', '200929235223_1526.png', 150, 4, 3, '1', '1', '2020-09-30 04:52:25', '2020-09-30 04:52:25'),
(9, 'Libro sobre Java', 'Libro de programación', '201019155742_6528.png', 65, 5, 7, '1', '1', '2020-10-19 20:57:44', '2020-10-19 20:57:44'),
(10, 'Libro de C sharp', 'Libro de programación', '201019155813_5897.jpg', 80, 5, 7, '1', '1', '2020-10-19 20:58:15', '2020-10-19 20:58:15'),
(11, 'Libro de Python', 'Libro de programación', '201019155837_1756.jpg', 70, 5, 7, '1', '1', '2020-10-19 20:58:38', '2020-10-19 20:58:38'),
(12, 'Billetera de cuero', 'Billetera', '201019160019_4834.jpg', 76, 6, 9, '1', '1', '2020-10-19 21:00:21', '2020-10-19 21:00:21'),
(13, 'Corbata azul', 'Corbata', '201019160041_1747.jpg', 45, 6, 9, '1', '1', '2020-10-19 21:00:42', '2020-10-19 21:00:42'),
(14, 'Reloj analógico', 'Reloj', '201019160108_1505.webp', 95, 6, 9, '1', '1', '2020-10-19 21:01:10', '2020-10-19 21:01:10'),
(15, 'Billetera de mano', 'Billetera', '201019160308_3650.jpg', 35, 7, 10, '1', '1', '2020-10-19 21:03:18', '2020-10-19 21:03:18'),
(16, 'Bolso negro', 'Bolso', '201019160359_2579.jpg', 85, 7, 10, '1', '1', '2020-10-19 21:04:00', '2020-10-19 21:04:00'),
(17, 'Collar de oro', 'collar', '201019160417_9632.jpg', 150, 7, 10, '1', '1', '2020-10-19 21:04:19', '2020-10-19 21:04:19'),
(18, 'Gorra tejida a mano', 'Gorra', '201019160836_9623.jpg', 15, 8, 12, '1', '1', '2020-10-19 21:08:40', '2020-10-19 21:08:40'),
(19, 'Lentes de sol', 'Lentes', '201019160900_7848.jpg', 8.5, 8, 12, '1', '1', '2020-10-19 21:09:02', '2020-10-19 21:09:02'),
(20, 'Vincha de corona', 'Vincha', '201019160925_8551.jpg', 10, 8, 12, '1', '1', '2020-10-19 21:09:27', '2020-10-19 21:09:27'),
(21, 'Oso de Peluche', 'Accesorio', '201019161209_7574.jpg', 35, 9, 14, '1', '1', '2020-10-19 21:12:11', '2020-10-19 21:12:11'),
(22, 'Perfume par ahombre', 'Accesorio', '201019161236_1557.jpg', 45, 9, 14, '1', '1', '2020-10-19 21:12:37', '2020-10-19 21:12:37'),
(23, 'Perfume para mujer', 'Accesorio', '201019161255_9641.jpg', 85, 9, 14, '1', '1', '2020-10-19 21:13:00', '2020-10-19 21:13:00'),
(24, 'Arroz 1Kg', 'Alimento', '201019161539_3623.jpg', 5, 13, 15, '1', '1', '2020-10-19 21:15:40', '2020-10-19 21:15:40'),
(25, 'Azúcar 5Kg', 'Alimento', '201019161621_2669.jpg', 15, 13, 15, '1', '1', '2020-10-19 21:16:27', '2020-10-19 21:16:27'),
(26, 'Lata de leche', 'Alimento', '201019161644_3713.jpg', 3.5, 13, 15, '1', '1', '2020-10-19 21:16:46', '2020-10-19 21:16:46'),
(27, 'Queque de vainilla', 'Torta', '201019161904_2559.jpg', 20, 14, 16, '1', '1', '2020-10-19 21:19:05', '2020-10-19 21:19:05'),
(28, 'Torta de cumpleaños', 'Torta', '201019161922_1819.jpg', 50, 14, 16, '1', '1', '2020-10-19 21:19:23', '2020-10-19 21:19:23'),
(29, 'Torta de chocolate', 'Torta', '201019161940_2710.jpg', 45, 14, 16, '1', '1', '2020-10-19 21:19:41', '2020-10-19 21:19:41'),
(30, 'Jugo de papaya', 'Alimento', '201019162214_5839.jpg', 2.5, 15, 17, '1', '1', '2020-10-19 21:22:15', '2020-10-19 21:22:15'),
(31, 'Jugo especial', 'Alimento', '201019162231_7661.jpg', 5, 15, 17, '1', '1', '2020-10-19 21:22:33', '2020-10-19 21:22:33'),
(32, 'Pan con pollo', 'Alimento', '201019162246_0814.jpg', 3, 15, 17, '1', '1', '2020-10-19 21:22:47', '2020-10-19 21:22:47'),
(33, 'Aeropuerto', 'Alimento', '201019162712_9528.jpg', 25, 16, 19, '1', '1', '2020-10-19 21:27:14', '2020-10-19 21:27:14'),
(34, 'Arroz Chaufa', 'Alimento', '201019162728_7626.jpg', 15, 16, 19, '1', '1', '2020-10-19 21:27:30', '2020-10-19 21:27:30'),
(35, 'Pollo al durazno', 'Alimento', '201019162751_1599.jpg', 25, 16, 19, '1', '1', '2020-10-19 21:27:52', '2020-10-19 21:27:52'),
(36, 'Pollo a la braza', 'Pollo con papas enlazada y ajíes', '201019162855_7529.jpg', 50, 10, 4, '1', '1', '2020-10-19 21:29:02', '2020-10-19 21:29:02'),
(37, 'Pantalón para dama', 'Ropa', '201019162941_7698.jpg', 26, 17, 20, '1', '1', '2020-10-19 21:29:43', '2020-10-19 21:29:43'),
(38, 'Polo para mujer', 'Ropa', '201019163001_3602.jpg', 15, 17, 20, '1', '1', '2020-10-19 21:30:03', '2020-10-19 21:30:03'),
(39, 'Vestido para adolescente', 'Ropa', '201019163019_6656.jpg', 50, 17, 20, '1', '1', '2020-10-19 21:30:22', '2020-10-19 21:30:22'),
(40, 'Combo Hallowen', 'Pollo entero + chifa + chorizo parrillero + anticuchos + GASEOSA 3 LT PEPSI helada', '201019163138_2647.jpg', 100, 11, 4, '1', '1', '2020-10-19 21:31:41', '2020-10-19 21:31:41'),
(41, 'Pollo a la braza + chifa', 'Pollo más chifa', '201019164243_5809.png', 57, 18, 5, '1', '1', '2020-10-19 21:42:46', '2020-10-19 21:42:46'),
(42, 'Pollo a la braza + gaseosa', 'Pollo a la braza + gaseosa', '201019164324_7695.jpg', 60, 18, 5, '1', '1', '2020-10-19 21:43:32', '2020-10-19 21:43:32'),
(43, 'Promart Ricocan Multisabores Adultos Todas Las Razas 22 Kg', 'Promart Ricocan Multisabores Adultos Todas Las Razas 22 Kg', '201019164953_7900.jpg', 145, 19, 11, '1', '1', '2020-10-19 21:49:55', '2020-10-19 21:49:55'),
(44, 'Plaza Vea Comida para Gatos RICOCAT Gatitos Carne Pescado 1kg', 'Plaza Vea Comida para Gatos RICOCAT Gatitos Carne Pescado', '201019165054_4580.jpg', 12.5, 20, 11, '1', '1', '2020-10-19 21:50:58', '2020-10-19 21:50:58'),
(45, 'Atención medica veterinaria domiciliaria', 'Atención medica a tu mascota a domicilio brindando todos los protocolos de seguridad', '201019165148_2858.jpg', 60, 21, 11, '1', '1', '2020-10-19 21:52:38', '2020-10-19 21:52:38'),
(46, 'Galletas glacitas', 'Galletas bañadas en chocolate', '201019165850_8801.jpg', 0.5, 22, 29, '1', '1', '2020-10-19 21:58:52', '2020-10-19 21:58:52'),
(47, 'Ace patito', 'Ace patito', '201019165944_9630.jpg', 1, 23, 29, '1', '1', '2020-10-19 21:59:56', '2020-10-19 21:59:56'),
(48, 'Gaseosa pepsi medio litro', 'Gaseosa pepsi medio litro', '201019170128_3577.jpg', 2, 24, 29, '1', '1', '2020-10-19 22:01:55', '2020-10-19 22:01:55'),
(49, 'Arroz con pato', 'Delicioso y sabroso', '201019170606_8598.jpg', 15, 25, 30, '1', '1', '2020-10-19 22:06:08', '2020-10-19 22:06:08'),
(50, 'Jarra de chicha morada', 'Heladita', '201019170713_1357.jpg', 7, 26, 30, '1', '1', '2020-10-19 22:07:14', '2020-10-19 22:07:14'),
(51, 'Ceviche', 'Ricoooooooooooooooooooooo', '201019170807_3853.jpg', 28, 25, 30, '1', '1', '2020-10-19 22:08:09', '2020-10-19 22:08:09'),
(52, 'Iluminaria led 36', 'Good', '201019171340_0623.jpg', 15, 29, 26, '1', '1', '2020-10-19 22:13:41', '2020-10-19 22:13:41'),
(53, 'Pollo a la brasa', 'Pollo Entero - Porción papas chicas + ensalada', '201019171258_6775.jpg', 50.9, 28, 8, '1', '1', '2020-10-19 22:14:26', '2020-10-19 22:26:04'),
(54, 'Alambre 2B', 'Nuevo', '201019171439_1746.jpg', 78, 30, 26, '1', '1', '2020-10-19 22:14:41', '2020-10-19 22:14:41'),
(55, 'FIFA 21', 'Videojuego de deportes fifa 21', '201019171834_2690.jpeg', 60, 31, 33, '1', '1', '2020-10-19 22:18:53', '2020-10-19 22:18:53'),
(56, 'Mortal Kombat 11 Aftermath', 'Videojuego de luchas', '201019171950_9669.jpg', 65, 33, 33, '1', '1', '2020-10-19 22:19:52', '2020-10-19 22:19:52'),
(57, 'Pollo a la brasa', '1/2 Pollo - Porción papas + ensalada', '201019172032_7841.jpg', 23, 28, 8, '1', '1', '2020-10-19 22:20:35', '2020-10-19 22:26:43'),
(58, 'Pollo a la brasa', '1/4 de pollo con papas + ensalada', '201019172454_3506.jpg', 9.9, 28, 8, '1', '1', '2020-10-19 22:25:11', '2020-10-19 22:25:11'),
(59, 'Apple  MacBook Air Latest Model  15 Display  Intel Core i5  8GB Memory  128GB Fl', 'MacBook Air features up to 8GB of memory a fifth-generation Intel Core processor Thunderbolt 2 great builtin apps and all day battery life1 Its thin light and durable enough to take everywhere you goand powerful enough to do everything once you get there ', '201019173448_6748.webp', 999.99, 34, 32, '1', '1', '2020-10-19 22:34:50', '2020-10-19 22:34:50'),
(60, 'Apple - EarPods with Remote and Mic - White', 'Control media playback adjust the volume and answer and end calls on your Apple', '201019173721_8902.webp', 29.99, 34, 32, '1', '1', '2020-10-19 22:37:22', '2020-10-19 22:37:22'),
(61, 'HP - 15 Laptop - AMD A6-Series  4GB Memory - 500GB Hard Drive - Black', 'HP Laptop Experience highpowered computing on the go with this HP notebook Store your favorite videos or music on the 500GB hard drive and watch HD movies displayed via its AMD Radeon R4 graphics card', '201019174229_0653.webp', 259.99, 34, 32, '1', '1', '2020-10-19 22:42:31', '2020-10-19 22:42:31'),
(62, 'Superman Clásico', 'Ya puedes adquirir al Hombre de Acero mediante nuestro servicio de delivery', '201019174743_9703.jpg', 35, 35, 31, '1', '1', '2020-10-19 22:47:45', '2020-10-19 22:47:45'),
(63, 'Sentido Arácnido', 'Ya puedes adquirir al Hombre Araña mediante nuestro servicio de delivery', '201019175000_0524.jpg', 35.99, 35, 31, '1', '1', '2020-10-19 22:50:16', '2020-10-19 22:50:16'),
(64, 'PokéBomberos', 'Ya puedes adquirir al Escuadrón Squirtle mediante nuestro servicio de delivery', '201019175104_8601.jpg', 45, 35, 31, '1', '1', '2020-10-19 22:51:06', '2020-10-19 22:51:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE `programas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha_programada` date NOT NULL,
  `hora_programada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` smallint(6) NOT NULL DEFAULT '1',
  `pedido_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopago`
--

CREATE TABLE `tipopago` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `value` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipopago`
--

INSERT INTO `tipopago` (`id`, `nombre`, `estado`, `value`, `created_at`, `updated_at`) VALUES
(1, 'YAPE', 1, 'Y', NULL, NULL),
(2, 'PLIN', 1, 'P', NULL, NULL),
(3, 'TUNKI', 1, 'T', NULL, NULL),
(4, 'TRANFERENCIA BANCARIA', 1, 'TB', NULL, NULL),
(5, 'CULQI', 1, 'C', NULL, NULL),
(6, 'CONTRAENTREGA', 1, 'CE', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopago_empresa`
--

CREATE TABLE `tipopago_empresa` (
  `empresa_id` int(11) NOT NULL,
  `tipopago_id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipopago_empresa`
--

INSERT INTO `tipopago_empresa` (`empresa_id`, `tipopago_id`, `code`, `number`, `estado`, `created_at`, `updated_at`) VALUES
(2, 1, '', '', 0, NULL, NULL),
(2, 2, '', '', 0, NULL, NULL),
(2, 3, '', '', 0, NULL, NULL),
(2, 4, '', '', 0, NULL, NULL),
(2, 5, '', '', 0, NULL, NULL),
(2, 6, '', '', 1, NULL, NULL),
(1, 1, '', '', 0, NULL, NULL),
(2, 1, '', '', 0, NULL, NULL),
(3, 1, '', '', 0, NULL, NULL),
(4, 1, '', '', 0, NULL, NULL),
(5, 1, '', '', 0, NULL, NULL),
(6, 1, '', '', 0, NULL, NULL),
(1, 1, '', '', 0, NULL, NULL),
(1, 2, '', '', 0, NULL, NULL),
(1, 3, '', '', 0, NULL, NULL),
(1, 4, '', '', 0, NULL, NULL),
(1, 5, '-', '-0', 1, NULL, NULL),
(1, 6, '-', '-0', 1, NULL, NULL),
(3, 1, '', '', 0, NULL, NULL),
(3, 2, '', '', 0, NULL, NULL),
(3, 3, '', '', 0, NULL, NULL),
(3, 4, '', '', 0, NULL, NULL),
(3, 5, '', '', 0, NULL, NULL),
(3, 6, '', '', 1, NULL, NULL),
(4, 1, '', '', 0, NULL, NULL),
(4, 2, '', '', 0, NULL, NULL),
(4, 3, '', '', 0, NULL, NULL),
(4, 4, '', '', 0, NULL, NULL),
(4, 5, '', '', 0, NULL, NULL),
(4, 6, '', '', 1, NULL, NULL),
(5, 1, '', '', 0, NULL, NULL),
(5, 2, '', '', 0, NULL, NULL),
(5, 3, '', '', 0, NULL, NULL),
(5, 4, '', '', 0, NULL, NULL),
(5, 5, '', '', 0, NULL, NULL),
(5, 6, '', '', 1, NULL, NULL),
(7, 1, '', '', 0, NULL, NULL),
(7, 2, '', '', 0, NULL, NULL),
(7, 3, '', '', 0, NULL, NULL),
(7, 4, '', '', 0, NULL, NULL),
(7, 5, '', '', 0, NULL, NULL),
(7, 6, '', '', 1, NULL, NULL),
(8, 1, '', '', 0, NULL, NULL),
(8, 2, '', '', 0, NULL, NULL),
(8, 3, '', '', 0, NULL, NULL),
(8, 4, '', '', 0, NULL, NULL),
(8, 5, '', '', 0, NULL, NULL),
(8, 6, '', '', 1, NULL, NULL),
(9, 1, '', '', 0, NULL, NULL),
(9, 2, '', '', 0, NULL, NULL),
(9, 3, '', '', 0, NULL, NULL),
(9, 4, '', '', 0, NULL, NULL),
(9, 5, '', '', 0, NULL, NULL),
(9, 6, '', '', 1, NULL, NULL),
(10, 1, '', '', 0, NULL, NULL),
(10, 2, '', '', 0, NULL, NULL),
(10, 3, '', '', 0, NULL, NULL),
(10, 4, '', '', 0, NULL, NULL),
(10, 5, '', '', 0, NULL, NULL),
(10, 6, '', '', 1, NULL, NULL),
(11, 1, '', '', 0, NULL, NULL),
(11, 2, '', '', 0, NULL, NULL),
(11, 3, '', '', 0, NULL, NULL),
(11, 4, '', '', 0, NULL, NULL),
(11, 5, '', '', 0, NULL, NULL),
(11, 6, '', '', 1, NULL, NULL),
(12, 1, '', '', 0, NULL, NULL),
(12, 2, '', '', 0, NULL, NULL),
(12, 3, '', '', 0, NULL, NULL),
(12, 4, '', '', 0, NULL, NULL),
(12, 5, '', '', 0, NULL, NULL),
(12, 6, '', '', 1, NULL, NULL),
(13, 1, '', '', 0, NULL, NULL),
(13, 2, '', '', 0, NULL, NULL),
(13, 3, '', '', 0, NULL, NULL),
(13, 4, '', '', 0, NULL, NULL),
(13, 5, '', '', 0, NULL, NULL),
(13, 6, '', '', 1, NULL, NULL),
(14, 1, '', '', 0, NULL, NULL),
(14, 2, '', '', 0, NULL, NULL),
(14, 3, '', '', 0, NULL, NULL),
(14, 4, '', '', 0, NULL, NULL),
(14, 5, '', '', 0, NULL, NULL),
(14, 6, '', '', 1, NULL, NULL),
(15, 1, '', '', 0, NULL, NULL),
(15, 2, '', '', 0, NULL, NULL),
(15, 3, '', '', 0, NULL, NULL),
(15, 4, '', '', 0, NULL, NULL),
(15, 5, '', '', 0, NULL, NULL),
(15, 6, '', '', 1, NULL, NULL),
(16, 1, '', '', 0, NULL, NULL),
(16, 2, '', '', 0, NULL, NULL),
(16, 3, '', '', 0, NULL, NULL),
(16, 4, '', '', 0, NULL, NULL),
(16, 5, '', '', 0, NULL, NULL),
(16, 6, '', '', 1, NULL, NULL),
(17, 1, '', '', 0, NULL, NULL),
(17, 2, '', '', 0, NULL, NULL),
(17, 3, '', '', 0, NULL, NULL),
(17, 4, '', '', 0, NULL, NULL),
(17, 5, '', '', 0, NULL, NULL),
(17, 6, '', '', 1, NULL, NULL),
(18, 1, '', '', 0, NULL, NULL),
(18, 2, '', '', 0, NULL, NULL),
(18, 3, '', '', 0, NULL, NULL),
(18, 4, '', '', 0, NULL, NULL),
(18, 5, '', '', 0, NULL, NULL),
(18, 6, '', '', 1, NULL, NULL),
(19, 1, '', '', 0, NULL, NULL),
(19, 2, '', '', 0, NULL, NULL),
(19, 3, '', '', 0, NULL, NULL),
(19, 4, '', '', 0, NULL, NULL),
(19, 5, '', '', 0, NULL, NULL),
(19, 6, '', '', 1, NULL, NULL),
(20, 1, '', '', 0, NULL, NULL),
(20, 2, '', '', 0, NULL, NULL),
(20, 3, '', '', 0, NULL, NULL),
(20, 4, '', '', 0, NULL, NULL),
(20, 5, '', '', 0, NULL, NULL),
(20, 6, '', '', 1, NULL, NULL),
(21, 1, '', '', 0, NULL, NULL),
(21, 2, '', '', 0, NULL, NULL),
(21, 3, '', '', 0, NULL, NULL),
(21, 4, '', '', 0, NULL, NULL),
(21, 5, '', '', 0, NULL, NULL),
(21, 6, '', '', 1, NULL, NULL),
(22, 1, '', '', 0, NULL, NULL),
(22, 2, '', '', 0, NULL, NULL),
(22, 3, '', '', 0, NULL, NULL),
(22, 4, '', '', 0, NULL, NULL),
(22, 5, '', '', 0, NULL, NULL),
(22, 6, '', '', 1, NULL, NULL),
(23, 1, '', '', 0, NULL, NULL),
(23, 2, '', '', 0, NULL, NULL),
(23, 3, '', '', 0, NULL, NULL),
(23, 4, '', '', 0, NULL, NULL),
(23, 5, '', '', 0, NULL, NULL),
(23, 6, '', '', 1, NULL, NULL),
(24, 1, '', '', 0, NULL, NULL),
(24, 2, '', '', 0, NULL, NULL),
(24, 3, '', '', 0, NULL, NULL),
(24, 4, '', '', 0, NULL, NULL),
(24, 5, '', '', 0, NULL, NULL),
(24, 6, '', '', 1, NULL, NULL),
(25, 1, '', '', 0, NULL, NULL),
(25, 2, '', '', 0, NULL, NULL),
(25, 3, '', '', 0, NULL, NULL),
(25, 4, '', '', 0, NULL, NULL),
(25, 5, '', '', 0, NULL, NULL),
(25, 6, '', '', 1, NULL, NULL),
(27, 1, '', '', 0, NULL, NULL),
(27, 2, '', '', 0, NULL, NULL),
(27, 3, '', '', 0, NULL, NULL),
(27, 4, '', '', 0, NULL, NULL),
(27, 5, '', '', 0, NULL, NULL),
(27, 6, '', '', 1, NULL, NULL),
(28, 1, '', '', 0, NULL, NULL),
(28, 2, '', '', 0, NULL, NULL),
(28, 3, '', '', 0, NULL, NULL),
(28, 4, '', '', 0, NULL, NULL),
(28, 5, '', '', 0, NULL, NULL),
(28, 6, '', '', 1, NULL, NULL),
(29, 1, '', '', 0, NULL, NULL),
(29, 2, '', '', 0, NULL, NULL),
(29, 3, '', '', 0, NULL, NULL),
(29, 4, '', '', 0, NULL, NULL),
(29, 5, '', '', 0, NULL, NULL),
(29, 6, '', '', 1, NULL, NULL),
(26, 1, '', '', 0, NULL, NULL),
(26, 2, '', '', 0, NULL, NULL),
(26, 3, '', '', 0, NULL, NULL),
(26, 4, '', '', 0, NULL, NULL),
(26, 5, '', '', 0, NULL, NULL),
(26, 6, '', '', 1, NULL, NULL),
(30, 1, '', '', 0, NULL, NULL),
(30, 2, '', '', 0, NULL, NULL),
(30, 3, '', '', 0, NULL, NULL),
(30, 4, '', '', 0, NULL, NULL),
(30, 5, '', '', 0, NULL, NULL),
(30, 6, '', '', 1, NULL, NULL),
(30, 1, '', '', 0, NULL, NULL),
(30, 2, '', '', 0, NULL, NULL),
(30, 3, '', '', 0, NULL, NULL),
(30, 4, '', '', 0, NULL, NULL),
(30, 5, '', '', 0, NULL, NULL),
(30, 6, '', '', 1, NULL, NULL),
(30, 1, '', '', 0, NULL, NULL),
(30, 2, '', '', 0, NULL, NULL),
(30, 3, '', '', 0, NULL, NULL),
(30, 4, '', '', 0, NULL, NULL),
(30, 5, '', '', 0, NULL, NULL),
(30, 6, '', '', 1, NULL, NULL),
(30, 1, '', '', 0, NULL, NULL),
(30, 2, '', '', 0, NULL, NULL),
(30, 3, '', '', 0, NULL, NULL),
(30, 4, '', '', 0, NULL, NULL),
(30, 5, '', '', 0, NULL, NULL),
(30, 6, '', '', 1, NULL, NULL),
(31, 1, '', '', 0, NULL, NULL),
(31, 2, '', '', 0, NULL, NULL),
(31, 3, '', '', 0, NULL, NULL),
(31, 4, '', '', 0, NULL, NULL),
(31, 5, '', '', 0, NULL, NULL),
(31, 6, '', '', 1, NULL, NULL),
(32, 1, '', '', 0, NULL, NULL),
(32, 2, '', '', 0, NULL, NULL),
(32, 3, '', '', 0, NULL, NULL),
(32, 4, '', '', 0, NULL, NULL),
(32, 5, '', '', 0, NULL, NULL),
(32, 6, '', '', 1, NULL, NULL),
(33, 1, '', '', 0, NULL, NULL),
(33, 2, '', '', 0, NULL, NULL),
(33, 3, '', '', 0, NULL, NULL),
(33, 4, '', '', 0, NULL, NULL),
(33, 5, '', '', 0, NULL, NULL),
(33, 6, '', '', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_entregas`
--

CREATE TABLE `tipo_entregas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_entregas`
--

INSERT INTO `tipo_entregas` (`id`, `nombre`) VALUES
(1, 'DELIVERY'),
(2, 'RECEPCIÓN EN LOCAL'),
(3, 'RESERVAR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_entrega_empresas`
--

CREATE TABLE `tipo_entrega_empresas` (
  `empresa_id` int(11) NOT NULL,
  `tipo_entrega_id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_entrega_empresas`
--

INSERT INTO `tipo_entrega_empresas` (`empresa_id`, `tipo_entrega_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 1, NULL, NULL),
(2, 2, 0, NULL, NULL),
(2, 3, 0, NULL, NULL),
(3, 1, 1, NULL, NULL),
(3, 2, 0, NULL, NULL),
(3, 3, 0, NULL, NULL),
(4, 1, 1, NULL, NULL),
(4, 2, 0, NULL, NULL),
(4, 3, 0, NULL, NULL),
(5, 1, 1, NULL, NULL),
(5, 2, 0, NULL, NULL),
(5, 3, 0, NULL, NULL),
(7, 1, 1, NULL, NULL),
(7, 2, 0, NULL, NULL),
(7, 3, 0, NULL, NULL),
(8, 1, 1, NULL, NULL),
(8, 2, 0, NULL, NULL),
(8, 3, 0, NULL, NULL),
(9, 1, 1, NULL, NULL),
(9, 2, 0, NULL, NULL),
(9, 3, 0, NULL, NULL),
(10, 1, 1, NULL, NULL),
(10, 2, 0, NULL, NULL),
(10, 3, 0, NULL, NULL),
(11, 1, 1, NULL, NULL),
(11, 2, 0, NULL, NULL),
(11, 3, 0, NULL, NULL),
(12, 1, 1, NULL, NULL),
(12, 2, 0, NULL, NULL),
(12, 3, 0, NULL, NULL),
(13, 1, 1, NULL, NULL),
(13, 2, 0, NULL, NULL),
(13, 3, 0, NULL, NULL),
(14, 1, 1, NULL, NULL),
(14, 2, 0, NULL, NULL),
(14, 3, 0, NULL, NULL),
(15, 1, 1, NULL, NULL),
(15, 2, 0, NULL, NULL),
(15, 3, 0, NULL, NULL),
(16, 1, 1, NULL, NULL),
(16, 2, 0, NULL, NULL),
(16, 3, 0, NULL, NULL),
(17, 1, 1, NULL, NULL),
(17, 2, 0, NULL, NULL),
(17, 3, 0, NULL, NULL),
(18, 1, 1, NULL, NULL),
(18, 2, 0, NULL, NULL),
(18, 3, 0, NULL, NULL),
(19, 1, 1, NULL, NULL),
(19, 2, 0, NULL, NULL),
(19, 3, 0, NULL, NULL),
(20, 1, 1, NULL, NULL),
(20, 2, 0, NULL, NULL),
(20, 3, 0, NULL, NULL),
(21, 1, 1, NULL, NULL),
(21, 2, 0, NULL, NULL),
(21, 3, 0, NULL, NULL),
(22, 1, 1, NULL, NULL),
(22, 2, 0, NULL, NULL),
(22, 3, 0, NULL, NULL),
(23, 1, 1, NULL, NULL),
(23, 2, 0, NULL, NULL),
(23, 3, 0, NULL, NULL),
(24, 1, 1, NULL, NULL),
(24, 2, 0, NULL, NULL),
(24, 3, 0, NULL, NULL),
(25, 1, 1, NULL, NULL),
(25, 2, 0, NULL, NULL),
(25, 3, 0, NULL, NULL),
(26, 1, 1, NULL, NULL),
(27, 1, 1, NULL, NULL),
(27, 2, 0, NULL, NULL),
(27, 3, 0, NULL, NULL),
(28, 1, 1, NULL, NULL),
(28, 2, 0, NULL, NULL),
(28, 3, 0, NULL, NULL),
(29, 1, 1, NULL, NULL),
(29, 2, 0, NULL, NULL),
(29, 3, 0, NULL, NULL),
(30, 1, 1, NULL, NULL),
(31, 1, 1, NULL, NULL),
(32, 1, 1, NULL, NULL),
(33, 1, 1, NULL, NULL),
(33, 2, 0, NULL, NULL),
(33, 3, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_negocio`
--

CREATE TABLE `tipo_negocio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` int(11) NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_negocio`
--

INSERT INTO `tipo_negocio` (`id`, `descripcion`, `state`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'RESTAURANTE', 1, 'lni lni-dinner', '2020-09-03 18:29:49', '2020-09-03 18:29:49'),
(2, 'RESPOTERIA', 1, 'lni lni-cake', '2020-09-03 18:29:49', '2020-09-03 18:29:49'),
(3, 'BODEGA', 1, 'lni lni-restaurant', '2020-09-03 18:29:49', '2020-09-03 18:29:49'),
(4, 'TIENDA DE ROPA', 1, 'lni lni-shopping-basket', '2020-09-03 18:29:49', '2020-09-03 18:29:49'),
(5, 'TIENDA DE ELECTRÓNICA', 1, 'lni lni-laptop-phone', '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(6, 'TIENDA DE ACCESORIOS', 1, 'lni lni-game', '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(7, 'LIBRERIA', 1, 'lni lni-book', '2020-09-03 18:29:50', '2020-09-03 18:29:50'),
(8, 'CENTROS MÉDICOS', 1, 'fas fa-clinic-medical', '2020-10-19 20:21:49', '2020-10-19 20:21:49'),
(9, 'VIDEOJUEGOS', 1, 'fas fa-gamepad', '2020-10-19 22:12:03', '2020-10-19 22:12:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones_culqi`
--

CREATE TABLE `transacciones_culqi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transId` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(9,2) NOT NULL,
  `transfer_amount` decimal(9,2) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_brand` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorization_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idRefund` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `transacciones_culqi`
--

INSERT INTO `transacciones_culqi` (`id`, `transId`, `amount`, `transfer_amount`, `email`, `description`, `card_number`, `card_brand`, `card_type`, `reference_code`, `authorization_code`, `ip`, `device_type`, `created_at`, `updated_at`, `idRefund`) VALUES
(1, 'chr_test_UlnBtHG0kjveE5v6', 10.00, 9.53, 'jaironavezaroca@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', '36Vy09bXmR', 'TJS7eM', '2800:200:f000:2a51:7c93:a1b0:1a38:d25b', 'Escritorio', '2020-09-03 21:26:06', '2020-09-03 21:26:06', NULL),
(2, 'chr_test_d5sJhqex50LO668r', 10.00, 9.53, 'cferrercava@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', 'HAbTZ0bdCe', 'BTHHFD', '190.235.15.146', 'Escritorio', '2020-09-03 21:48:33', '2020-09-03 21:48:33', NULL),
(3, 'chr_test_N2CikEVLEfp1vft2', 84.00, 80.05, 'jaironavezaroca@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', 'KQYiXnqeWx', 'fwIIJC', '2800:200:f000:2a51:6d95:2098:c182:ed37', 'Escritorio', '2020-09-10 19:47:55', '2020-09-10 19:47:55', NULL),
(4, 'chr_test_98DNpUfqJlS1U0po', 84.00, 80.05, 'jaironavezaroca@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', 'eZOEc797c0', 'av1b2F', '2800:200:f000:2a51:6d95:2098:c182:ed37', 'Escritorio', '2020-09-10 19:49:07', '2020-09-10 19:49:07', NULL),
(5, 'chr_test_NuzTmPoZblKYaeYx', 84.00, 80.05, 'jaironavezaroca@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', 'MJr7cd8evo', 'mivqdb', '2800:200:f000:2a51:6d95:2098:c182:ed37', 'Escritorio', '2020-09-10 19:50:16', '2020-09-10 19:50:16', NULL),
(6, 'chr_test_8bIkAyGQyt7q6Nol', 84.00, 80.05, 'jaironavezaroca@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', '9gMoXrxTgq', '4qR501', '2800:200:f000:2a51:6d95:2098:c182:ed37', 'Escritorio', '2020-09-10 19:51:15', '2020-09-10 19:51:15', NULL),
(7, 'chr_test_1Tb77vSZTBrR0Hho', 84.00, 80.05, 'jaironavezaroca@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', 'gRHwsw1HO1', 'Tk9tzK', '2800:200:f000:2a51:6d95:2098:c182:ed37', 'Escritorio', '2020-09-10 19:52:41', '2020-09-10 19:52:41', NULL),
(8, 'chr_test_S7pAPrVgWtB0NBGZ', 196.00, 186.77, 'jaironavezaroca@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', 'clPFyPQqkF', 'YPRlYY', '2800:200:f000:2a51:6d95:2098:c182:ed37', 'Escritorio', '2020-09-10 19:55:29', '2020-09-10 19:56:18', 'ref_test_uhGGVxh336trEbhv'),
(9, 'chr_test_6DyDaKVOqXQlis5H', 16.50, 15.72, 'jaironavezaroca@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', 'zFpiPnO3lC', '3lc1xF', '2800:200:f000:2a51:6d95:2098:c182:ed37', 'Escritorio', '2020-09-10 19:59:44', '2020-09-10 19:59:44', NULL),
(10, 'chr_test_EIVYCMIMezE4dqL7', 28.00, 26.68, 'dvilla0898@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', 'zxFJqcDHdG', 'kwNlpQ', '181.64.57.226', 'Escritorio', '2020-09-11 16:46:39', '2020-09-11 16:46:39', NULL),
(11, 'chr_test_Gqlv97XCV7XiZimx', 28.00, 26.68, 'dvilla0898@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', '7S4hdAd4Fp', 'G5Vz5c', '181.64.57.226', 'Escritorio', '2020-09-11 16:47:38', '2020-09-11 16:47:38', NULL),
(12, 'chr_test_TpUDgmmCZ589Haot', 50.00, 47.64, 'dvilla0898@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', 'eIJlFpzHBQ', '2QPr89', '181.64.57.226', 'Escritorio', '2020-09-11 22:26:45', '2020-09-11 22:26:45', NULL),
(13, 'chr_test_elLVS9iRMCM8CDkJ', 50.00, 47.64, 'dvilla0898@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', '3CMXva6xeL', 'dgJdBo', '181.64.57.226', 'Escritorio', '2020-09-11 22:29:16', '2020-09-11 22:29:16', NULL),
(14, 'chr_test_YovVcYuhF4z3R5we', 50.00, 47.64, 'dvilla0898@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', 'JSFrLFAPZu', 's6Yt5M', '181.64.57.226', 'Escritorio', '2020-09-11 22:31:19', '2020-09-11 22:31:19', NULL),
(15, 'chr_test_esYNnJb3JxCZTMfT', 50.00, 47.64, 'dvilla0898@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', 'uTCwuXB5P2', '3FOwSp', '181.64.57.226', 'Escritorio', '2020-09-12 01:18:18', '2020-09-12 01:18:18', NULL),
(16, 'chr_test_vj9TNUBARhcK0qqM', 50.00, 47.64, 'dvilla0898@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', 'eh5OHoA0OM', 'RsAdbZ', '181.64.57.226', 'Escritorio', '2020-09-12 01:21:31', '2020-09-12 01:21:31', NULL),
(17, 'chr_test_8GBYmnqeG5USH0Uj', 50.00, 47.64, 'dvilla0898@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', 'eOWTvvwpQm', 'Ua5sjS', '181.64.57.226', 'Escritorio', '2020-09-12 01:35:07', '2020-09-12 01:35:07', NULL),
(18, 'chr_test_Xzj7g022uwVtoFZf', 63.00, 60.04, 'rimenri@hotmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', 'yrhF3E7nlr', '0ude2c', '181.64.57.226', 'Escritorio', '2020-09-12 01:42:18', '2020-09-12 01:42:18', NULL),
(19, 'chr_test_7xfbHXKpD93BEhiR', 56.00, 53.37, 'correo1@email.com', 'Pedido', '411111******1111', 'Visa', 'credito', '4lhijHxcEk', 'NzTCz5', '181.64.57.178', 'Escritorio', '2020-10-13 21:51:41', '2020-10-13 21:51:41', NULL),
(20, 'chr_test_02L3jCcDYmRidv1u', 250.00, 238.22, 'dvilla0898@gmail.com', 'Pedido', '411111******1111', 'Visa', 'credito', 'QmHCGohhxX', 'vnKd8B', '181.64.18.25', 'Escritorio', '2020-10-15 04:27:53', '2020-10-15 04:27:53', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `isCustomer` tinyint(1) NOT NULL DEFAULT '0',
  `persona_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `foto`, `isAdmin`, `isCustomer`, `persona_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Javier98', 'cferrercava@gmail.com', '$2y$10$bYFb1csH9VFCm43kVtYN.uDvXvH4nAkk4oSBu2wsrk68AsUf00iP2', NULL, 1, 0, '1', NULL, NULL, '2020-10-20 13:54:29'),
(2, 'jnavez', 'jnavez@unitru.edu.pe', '$2y$10$bYFb1csH9VFCm43kVtYN.uDvXvH4nAkk4oSBu2wsrk68AsUf00iP2', NULL, 1, 0, '2', NULL, NULL, NULL),
(3, 'Javier99', 'jbriceno2@unitru.edu.pe', '$2y$10$e0c90zDEBsmrd90KOeMvhOIfVIX/z8tgEF3LKj2uSJEq6TpkCeJ6K', NULL, 0, 0, '3', NULL, '2020-09-03 20:33:55', '2020-09-03 20:33:55'),
(4, 'nitrogeno', 'jbriceno3@unitru.edu.pe', '$2y$10$.Tmc6cleOEA68mqpwMyBLeQXdbiCU1uk0xvbqofohMn1tVhRTIN7m', NULL, 0, 1, '4', NULL, '2020-09-03 21:11:14', '2020-09-03 21:11:14'),
(5, 'Jhordan97', 'jromeroa@gmail.com', '$2y$10$J0GbQ2uVQQiNjlBGNmwIGeOfrGlBqHgKJN9SbRqSz6zqAyjGwo2sm', NULL, 0, 0, '5', NULL, '2020-09-10 07:17:15', '2020-09-10 07:17:15'),
(6, 'teenviobot', 'nitro.frz@gmail.com', '$2y$10$WUcKw1JvUAxuXqfTYkuaiOYgDsyG3Dcs/3mq6pLRfQADidQyFWG.m', NULL, 0, 0, '6', NULL, '2020-09-10 18:59:35', '2020-09-10 18:59:35'),
(7, 'ROCO27', 'rjgutierrez@unitru.edu.pe', '$2y$10$cgqmYgyeNT1bHgpx/1dJtOxXwMfOsi0nqS7kOigL7DSAEULeqkyli', NULL, 0, 0, '7', NULL, '2020-09-17 16:07:16', '2020-09-17 16:07:16'),
(8, 'luisomero', 'luiszegarrafernandez@outlook.com', '$2y$10$gMF4izzipMO0Q9oSQ1Ej5.jkXbWxMY1OZaMfYdv859qJpCg8NDy52', NULL, 0, 0, '8', NULL, '2020-10-27 03:03:19', '2020-10-27 03:03:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_empresas`
--

CREATE TABLE `users_empresas` (
  `user_id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `cargo_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users_empresas`
--

INSERT INTO `users_empresas` (`user_id`, `empresa_id`, `cargo_id`, `created_at`, `updated_at`) VALUES
(4, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `websockets_statistics_entries`
--

CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias_menus`
--
ALTER TABLE `categorias_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `empresas_nombre_unico_unique` (`nombre_unico`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos_users`
--
ALTER TABLE `pedidos_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `post_blog`
--
ALTER TABLE `post_blog`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `programas`
--
ALTER TABLE `programas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_entregas`
--
ALTER TABLE `tipo_entregas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_negocio`
--
ALTER TABLE `tipo_negocio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transacciones_culqi`
--
ALTER TABLE `transacciones_culqi`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `categorias_menus`
--
ALTER TABLE `categorias_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `pedidos_users`
--
ALTER TABLE `pedidos_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `plan`
--
ALTER TABLE `plan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `post_blog`
--
ALTER TABLE `post_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `programas`
--
ALTER TABLE `programas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_entregas`
--
ALTER TABLE `tipo_entregas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_negocio`
--
ALTER TABLE `tipo_negocio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `transacciones_culqi`
--
ALTER TABLE `transacciones_culqi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
