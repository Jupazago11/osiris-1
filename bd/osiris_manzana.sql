-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2022 a las 01:06:41
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `osiris_manzana`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `cargo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `cargo`, `estado`) VALUES
(1, 'Administrador', 'activo'),
(2, 'Empleado Entendido', 'activo'),
(3, 'Empleado', 'activo'),
(4, 'Domiciliario', 'activo'),
(5, 'Proveedor oficina', ''),
(6, 'Proveedor', ''),
(7, 'Bodeguera', 'inactivo'),
(8, '', ''),
(9, 'camionero', 'inactivo'),
(10, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_cat` int(11) NOT NULL,
  `categorias` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_cat`, `categorias`, `estado`) VALUES
(1, 'carnes', 'activo'),
(2, 'aseo', 'activo'),
(3, '', ''),
(4, '', ''),
(5, '', ''),
(6, '', ''),
(7, '', ''),
(8, '', ''),
(9, '', ''),
(10, '', ''),
(11, '', ''),
(12, '', ''),
(13, 'pan', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `id_ubi1` int(11) DEFAULT NULL,
  `nombre_cliente` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `identificacion_cliente` int(11) DEFAULT NULL,
  `direccion_cliente` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono_cliente` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `id_ubi1`, `nombre_cliente`, `identificacion_cliente`, `direccion_cliente`, `telefono_cliente`, `estado`) VALUES
(1, 1, 'Juanito V.', 102030, 'carrera 3 #11-13', '3131234567', 'activo'),
(2, 1, 'Jaime R.', 1234567, 'ramada', '3154975645', 'activo'),
(3, 3, 'Juanita F.', 12345678, 'san francisco', '54515454', 'activo'),
(5, 3, 'anónimo', NULL, 'anonima', 'anonima', 'activo'),
(6, 4, 'jacinto', NULL, NULL, NULL, 'activo'),
(7, 4, 'juana', NULL, NULL, NULL, 'activo'),
(8, 4, 'carmen', NULL, NULL, NULL, 'activo'),
(9, 4, 'pacho', NULL, NULL, NULL, 'activo'),
(10, 4, 'jairo', NULL, NULL, NULL, 'activo'),
(11, 4, 'Jaime R.h', NULL, NULL, NULL, 'activo'),
(12, 1, 'juan pablo zapata', 1037977046, 'carrera 18', '123456 ', 'activo'),
(13, 1, 'pacho', 1122334455, '', ' ', 'activo'),
(14, NULL, 'camilo', NULL, NULL, NULL, 'activo'),
(15, NULL, 'pacho zuleta', NULL, NULL, NULL, 'activo'),
(16, NULL, 'Juan pablo', NULL, NULL, NULL, 'activo'),
(17, NULL, 'hfhfh', NULL, NULL, NULL, 'activo'),
(18, NULL, 'juan pablo kfugisadghsdbfg', NULL, NULL, NULL, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control`
--

CREATE TABLE `control` (
  `id_control` int(11) NOT NULL,
  `id_pers4` int(11) NOT NULL,
  `llegada` time DEFAULT NULL,
  `ir_desayuno` time DEFAULT NULL,
  `regre_desayuno` time DEFAULT NULL,
  `ir_almuerzo` time DEFAULT NULL,
  `regre_almuerzo` time DEFAULT NULL,
  `salida` time DEFAULT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `control`
--

INSERT INTO `control` (`id_control`, `id_pers4`, `llegada`, `ir_desayuno`, `regre_desayuno`, `ir_almuerzo`, `regre_almuerzo`, `salida`, `fecha`) VALUES
(1, 3, '08:00:00', NULL, NULL, NULL, NULL, NULL, '2022-08-24'),
(2, 3, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-23'),
(3, 3, '08:00:00', NULL, NULL, NULL, NULL, NULL, '2022-08-25'),
(4, 3, '08:00:00', NULL, NULL, NULL, NULL, NULL, '2022-08-26'),
(5, 2, '08:30:04', '18:04:12', '18:04:27', NULL, NULL, NULL, '2022-08-26'),
(6, 3, '10:08:45', '10:37:43', '10:37:49', '10:39:41', '10:39:50', '10:39:51', '2022-09-05'),
(7, 2, '19:05:53', NULL, NULL, NULL, NULL, NULL, '2022-09-09'),
(8, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-16'),
(9, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-16'),
(10, 2, '16:12:15', '16:21:00', '17:36:46', NULL, NULL, NULL, '2022-09-17'),
(11, 3, '17:40:12', NULL, NULL, NULL, NULL, NULL, '2022-09-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuadre_caja`
--

CREATE TABLE `cuadre_caja` (
  `id_cuadre_caja` int(11) NOT NULL,
  `descripcion_cuadre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `costo_cuadre` int(11) DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cuadre_caja`
--

INSERT INTO `cuadre_caja` (`id_cuadre_caja`, `descripcion_cuadre`, `costo_cuadre`, `estado`) VALUES
(1, 'Base Inicial', 477500, 'activo'),
(2, '', 0, ''),
(3, '', 0, ''),
(4, '', 0, ''),
(5, '', 0, ''),
(6, '', 0, ''),
(7, '', 0, ''),
(8, '', 0, ''),
(9, '', 0, ''),
(10, '', 0, ''),
(11, '', 0, ''),
(12, '', 0, ''),
(13, '', 300000, ''),
(14, 'base 2', 100000, 'activo'),
(15, 'base 3', 0, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta_cobro`
--

CREATE TABLE `cuenta_cobro` (
  `id_cuenta` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `costo` int(11) DEFAULT NULL,
  `factura` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fecha_pago` datetime DEFAULT NULL,
  `dias` int(11) DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cuenta_cobro`
--

INSERT INTO `cuenta_cobro` (`id_cuenta`, `nombre`, `costo`, `factura`, `fecha`, `fecha_pago`, `dias`, `estado`) VALUES
(1, 'prove', 1000000, 'ss', '2022-08-31', '2022-07-09 11:56:52', 30, 'activo'),
(2, 'prove', 200000, '5A45SDAS4D5AS', '2022-07-04', '2022-07-05 16:13:29', 10, 'inactivo'),
(3, 'prove', 300000, '', '2022-08-25', '2022-07-06 12:25:02', 25, 'activo'),
(4, 'prove', 4000000, 'ABC123', '2022-07-03', '2022-07-06 00:00:00', 20, 'inactivo'),
(5, 'prove', 450000, NULL, '2022-07-05', '2022-07-06 12:25:02', 25, ''),
(6, 'cocacola', 50000, NULL, '2022-07-05', '2022-07-05 16:13:25', 30, 'inactivo'),
(7, 'cocacola', 2000, 'jp11', '2022-07-05', '2022-07-06 12:26:52', 10, 'inactivo'),
(8, 'nuevo', 200000, 'kk', '2022-07-05', '2022-07-09 11:56:52', 10, ''),
(9, 'cocacola', 50000, 'kl521', '2022-07-06', '2022-07-19 19:09:54', 19, 'inactivo'),
(10, 'Bimbo', 100000, 'ABC132', '2022-08-25', NULL, 20, 'activo'),
(11, '', 0, '', '2022-07-08', '2022-07-08 17:56:32', 0, ''),
(12, NULL, 0, NULL, '2022-07-08', NULL, 0, ''),
(13, NULL, 0, NULL, '2022-07-08', NULL, 0, ''),
(14, 'coca cola', 1000000, '', '2022-07-10', NULL, 20, ''),
(15, '', 0, 'jj', '2022-07-08', '2022-07-11 15:17:17', 0, ''),
(16, '', 0, 'aa', '2022-07-09', '2022-07-11 15:17:01', 1, ''),
(17, '', 0, '', '2022-07-11', NULL, 0, ''),
(18, '', 0, '', '2022-07-11', NULL, 0, ''),
(19, 'auralac', 0, '', '2022-08-29', NULL, 25, 'activo'),
(20, '', 0, '', '2022-07-11', NULL, 0, ''),
(21, '', 0, '', '2022-07-11', NULL, 0, ''),
(22, '', 0, '', '2022-07-11', NULL, 0, ''),
(23, '', 0, '', '2022-07-11', NULL, 0, ''),
(24, '', 0, '', '2022-07-11', NULL, 0, ''),
(25, '', 0, '', '2022-07-11', NULL, 0, ''),
(26, '', 0, '', '2022-07-11', NULL, 0, ''),
(27, '', 0, '', '2022-07-11', NULL, 0, ''),
(28, '', 0, '', '2022-07-11', NULL, 0, ''),
(29, '', 0, '', '2022-07-11', NULL, 0, ''),
(30, '', 0, '', '2022-07-11', NULL, 0, ''),
(31, '', 0, '', '2022-07-11', NULL, 0, ''),
(32, '', 0, '', '2022-07-11', NULL, 0, ''),
(33, '', 0, '', '2022-07-11', NULL, 0, ''),
(34, '', 0, '', '2022-07-11', NULL, 0, ''),
(35, '', 0, '', '2022-08-23', NULL, 0, ''),
(36, '', 0, '', '2022-09-09', NULL, 0, ''),
(37, '', 0, '', '2022-09-16', NULL, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `id_detalle` int(11) NOT NULL,
  `id_facturacion1` int(11) NOT NULL,
  `id_producto1` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_detalle` int(11) DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`id_detalle`, `id_facturacion1`, `id_producto1`, `cantidad`, `precio_detalle`, `estado`) VALUES
(1, 1, 9, 2, 3600, 'activo'),
(2, 1, 2, 1, 5000, 'activo'),
(3, 1, 6, 3, 10500, 'activo'),
(4, 2, 8, 10, 40000, 'activo'),
(5, 2, 5, 5, 20000, 'activo'),
(6, 2, 6, 10, 35000, 'activo'),
(7, 2, 2, 1, 5000, 'activo'),
(8, 4, 4, 3, 4500, 'activo'),
(9, 4, 2, 4, 20000, 'activo'),
(10, 4, 8, 10, 40000, 'activo'),
(12, 7, 1, 1, 500, ''),
(13, 7, 2, 2, 10000, ''),
(14, 7, 3, 2, 6000, ''),
(15, 8, 4, 8, 12000, ''),
(16, 8, 8, 4, 16000, ''),
(17, 8, 5, 10, 40000, ''),
(18, 9, 2, 5, 25000, 'activo'),
(19, 9, 4, 5, 7500, 'activo'),
(20, 10, 1, 1, 500, 'activo'),
(21, 10, 2, 2, 10000, 'activo'),
(22, 10, 3, 3, 9000, 'activo'),
(23, 7, 1, 1, 500, 'activo'),
(24, 7, 2, 2, 10000, 'activo'),
(25, 7, 3, 3, 9000, 'activo'),
(26, 11, 1, 1, 500, 'activo'),
(27, 11, 2, 2, 10000, 'activo'),
(28, 11, 3, 3, 9000, 'activo'),
(29, 11, 4, 4, 6000, 'activo'),
(30, 11, 5, 5, 20000, 'activo'),
(31, 12, 5, 5, 20000, 'activo'),
(32, 12, 4, 8, 12000, 'activo'),
(33, 13, 9, 50, 90000, 'activo'),
(34, 13, 8, 50, 200000, 'activo'),
(35, 14, 5, 4, 16000, 'activo'),
(36, 14, 6, 4, 14000, 'activo'),
(37, 15, 5, 5, 20000, ''),
(38, 15, 4, 6, 9000, ''),
(39, 15, 3, 7, 21000, ''),
(40, 15, 5, 5, 20000, 'activo'),
(41, 15, 4, 6, 9000, 'activo'),
(42, 15, 3, 7, 21000, 'activo'),
(43, 16, 5, 1, 4000, 'activo'),
(44, 17, 1, 1, 500, ''),
(45, 17, 2, 2, 10000, ''),
(46, 17, 3, 3, 9000, ''),
(47, 17, 4, 4, 6000, ''),
(48, 17, 5, 5, 20000, ''),
(49, 17, 1, 1, 500, 'activo'),
(50, 17, 2, 2, 10000, 'activo'),
(51, 17, 3, 3, 9000, 'activo'),
(52, 17, 4, 4, 6000, 'activo'),
(53, 17, 5, 5, 20000, 'activo'),
(54, 8, 4, 50, 75000, 'activo'),
(55, 8, 8, 50, 200000, 'activo'),
(56, 8, 5, 50, 200000, 'activo'),
(57, 18, 5, 1000, 4000000, 'activo'),
(58, 19, 5, 50, 200000, 'activo'),
(59, 20, 4, 1, 1500, 'activo'),
(60, 5, 6, 1, 3500, 'activo'),
(61, 21, 5, 1, 4000, 'activo'),
(62, 23, 8, 1, 4000, 'activo'),
(63, 24, 5, 100, 400000, 'activo'),
(64, 25, 4, 1, 1500, 'activo'),
(65, 25, 8, 1, 4000, 'activo'),
(66, 25, 9, 1, 1800, 'activo'),
(67, 26, 4, 20, 30000, 'activo'),
(68, 26, 5, 3, 12000, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_sugerido`
--

CREATE TABLE `detalle_sugerido` (
  `id_detalle` int(11) NOT NULL,
  `id_sugerido1` int(11) NOT NULL,
  `id_producto2` int(11) NOT NULL,
  `cantidad_sugerido` int(11) NOT NULL,
  `inventario_sugerido` int(11) NOT NULL,
  `pedido_sugerido` int(11) DEFAULT NULL,
  `pedido_recibido` int(11) DEFAULT NULL,
  `precio_sugerido` int(11) DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_sugerido`
--

INSERT INTO `detalle_sugerido` (`id_detalle`, `id_sugerido1`, `id_producto2`, `cantidad_sugerido`, `inventario_sugerido`, `pedido_sugerido`, `pedido_recibido`, `precio_sugerido`, `estado`) VALUES
(1, 2, 1, 10, 5, NULL, NULL, 500, 'activo'),
(2, 3, 1, 10, 10, NULL, NULL, 1500, 'activo'),
(5, 7, 1, 10, 15, NULL, NULL, 1500, 'activo'),
(6, 7, 2, 10, 15, NULL, NULL, 4000, 'activo'),
(7, 1, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(8, 1, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(9, 9, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(10, 9, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(11, 9, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(12, 11, 1, 10, 5, NULL, NULL, 1500, 'activo'),
(13, 9, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(14, 11, 2, 10, 5, NULL, NULL, 4000, 'activo'),
(15, 14, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(16, 13, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(17, 13, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(18, 14, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(19, 19, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(20, 19, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(21, 21, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(22, 22, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(23, 21, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(24, 22, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(25, 23, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(26, 24, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(27, 23, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(28, 24, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(29, 25, 1, 5, 10, NULL, NULL, 1500, 'activo'),
(30, 25, 2, 5, 10, NULL, NULL, 4000, 'activo'),
(33, 25, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(34, 25, 3, 0, 0, NULL, NULL, 2000, 'inactivo'),
(35, 27, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(36, 27, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(37, 27, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(38, 27, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(39, 27, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(40, 27, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(41, 29, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(42, 29, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(43, 29, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(44, 29, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(45, 29, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(46, 29, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(47, 29, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(48, 29, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(49, 30, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(50, 30, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(51, 30, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(52, 30, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(53, 31, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(54, 31, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(55, 31, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(56, 31, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(57, 31, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(58, 31, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(59, 31, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(60, 31, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(61, 32, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(62, 32, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(63, 32, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(64, 32, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(65, 34, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(66, 34, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(67, 34, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(68, 34, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(69, 34, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(70, 34, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(71, 34, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(72, 34, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(73, 35, 1, 5, 1, 10, 4, 1500, 'activo'),
(74, 35, 2, 5, 2, 10, 10, 4000, 'activo'),
(75, 35, 3, 5, 3, 10, 4, 2000, 'activo'),
(76, 35, 4, 5, 4, 10, 10, 1000, 'activo'),
(77, 38, 1, 100, 5, NULL, NULL, 1500, 'activo'),
(78, 38, 2, 50, 6, NULL, NULL, 4000, 'activo'),
(79, 38, 3, 80, 7, NULL, NULL, 2000, 'activo'),
(80, 38, 4, 7, 8, NULL, NULL, 1000, 'activo'),
(81, 45, 5, 0, 0, NULL, NULL, 3000, 'activo'),
(82, 46, 5, 25, 10, NULL, NULL, 3000, 'activo'),
(83, 47, 6, 50, 10, 50, NULL, 5000, 'activo'),
(84, 49, 6, 0, 0, NULL, NULL, 5000, 'activo'),
(85, 50, 6, 0, 10, NULL, 50, 5000, 'activo'),
(86, 50, 7, 0, 0, NULL, NULL, 3000, 'activo'),
(87, 51, 8, 20, 10, 25, 10, 4000, 'activo'),
(88, 51, 9, 25, 5, 20, 10, 2500, 'activo'),
(89, 53, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(90, 52, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(91, 52, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(92, 53, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(93, 55, 6, 0, 0, NULL, NULL, 5000, 'activo'),
(94, 52, 6, 0, 0, NULL, NULL, 5000, 'activo'),
(95, 52, 7, 0, 0, NULL, NULL, 3000, 'activo'),
(96, 55, 7, 0, 0, NULL, NULL, 3000, 'activo'),
(97, 56, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(98, 56, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(99, 56, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(100, 57, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(101, 58, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(102, 57, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(103, 58, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(104, 59, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(105, 59, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(106, 59, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(107, 59, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(108, 60, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(109, 60, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(110, 60, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(111, 60, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(112, 61, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(113, 61, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(114, 61, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(115, 61, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(116, 62, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(117, 62, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(118, 62, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(119, 62, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(120, 63, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(121, 63, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(122, 63, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(123, 63, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(124, 64, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(125, 64, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(126, 66, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(127, 66, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(128, 66, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(129, 66, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(130, 67, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(131, 67, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(132, 67, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(133, 68, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(134, 68, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(135, 69, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(136, 69, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(137, 70, 8, 20, 0, NULL, NULL, 4000, 'activo'),
(138, 70, 9, 20, 0, NULL, NULL, 2500, 'activo'),
(139, 70, 10, 20, 0, NULL, NULL, 6000, 'activo'),
(140, 72, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(141, 73, 8, 10, 0, NULL, NULL, 4000, 'activo'),
(142, 72, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(143, 73, 9, 10, 0, NULL, NULL, 2500, 'activo'),
(144, 72, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(145, 73, 10, 10, 0, NULL, NULL, 6000, 'activo'),
(146, 76, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(147, 76, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(148, 76, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(149, 76, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(150, 79, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(151, 79, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(152, 79, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(153, 79, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(154, 79, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(155, 79, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(156, 78, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(157, 78, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(158, 78, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(159, 78, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(160, 78, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(161, 78, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(162, 83, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(163, 83, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(164, 83, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(165, 83, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(166, 83, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(167, 83, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(168, 84, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(169, 84, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(170, 84, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(171, 84, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(172, 84, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(173, 84, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(174, 85, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(175, 86, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(176, 85, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(177, 86, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(178, 85, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(179, 86, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(180, 89, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(181, 89, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(182, 89, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(183, 89, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(184, 89, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(185, 89, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(186, 92, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(187, 92, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(188, 92, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(189, 92, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(190, 92, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(191, 92, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(192, 94, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(193, 95, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(194, 94, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(195, 95, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(196, 94, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(197, 95, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(198, 97, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(199, 98, 8, 10, 0, NULL, NULL, 4000, 'activo'),
(200, 97, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(201, 98, 9, 10, 0, NULL, NULL, 2500, 'activo'),
(202, 97, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(203, 98, 10, 10, 0, NULL, NULL, 6000, 'activo'),
(204, 100, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(205, 101, 8, 10, 0, NULL, NULL, 4000, 'activo'),
(206, 100, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(207, 100, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(208, 101, 9, 10, 0, NULL, NULL, 2500, 'activo'),
(209, 101, 10, 10, 0, NULL, NULL, 6000, 'activo'),
(210, 103, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(211, 104, 8, 10, 0, NULL, NULL, 4000, 'activo'),
(212, 103, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(213, 104, 9, 10, 0, NULL, NULL, 2500, 'activo'),
(214, 103, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(215, 104, 10, 10, 0, NULL, NULL, 6000, 'activo'),
(216, 107, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(217, 107, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(218, 107, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(219, 107, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(220, 107, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(221, 107, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(222, 109, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(223, 109, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(224, 109, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(225, 109, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(226, 109, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(227, 112, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(228, 112, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(229, 112, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(230, 112, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(231, 112, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(232, 112, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(233, 115, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(234, 115, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(235, 115, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(236, 115, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(237, 115, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(238, 115, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(239, 117, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(240, 118, 8, 10, 0, NULL, NULL, 4000, 'activo'),
(241, 117, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(242, 118, 9, 10, 0, NULL, NULL, 2500, 'activo'),
(243, 117, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(244, 118, 10, 10, 0, NULL, NULL, 6000, 'activo'),
(245, 121, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(246, 121, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(247, 121, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(248, 121, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(249, 121, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(250, 121, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(251, 122, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(252, 122, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(253, 122, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(254, 122, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(255, 122, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(256, 123, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(257, 124, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(258, 123, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(259, 124, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(260, 123, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(261, 124, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(262, 126, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(263, 126, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(264, 126, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(265, 126, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(266, 126, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(267, 126, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(268, 128, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(269, 128, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(270, 128, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(271, 128, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(272, 128, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(273, 128, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(274, 129, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(275, 129, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(276, 129, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(277, 129, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(278, 129, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(279, 129, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(280, 131, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(281, 131, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(282, 131, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(283, 131, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(284, 131, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(285, 131, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(286, 133, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(287, 133, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(288, 133, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(289, 133, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(290, 133, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(291, 133, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(292, 135, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(293, 135, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(294, 135, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(295, 135, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(296, 135, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(297, 135, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(298, 136, 8, 10, 0, NULL, NULL, 4000, 'activo'),
(299, 136, 9, 10, 0, NULL, NULL, 2500, 'activo'),
(300, 136, 10, 10, 0, NULL, NULL, 6000, 'activo'),
(301, 138, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(302, 138, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(303, 138, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(304, 138, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(305, 138, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(306, 138, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(307, 139, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(308, 139, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(309, 139, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(310, 139, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(311, 139, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(312, 139, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(313, 140, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(314, 140, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(315, 140, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(316, 141, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(317, 141, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(318, 141, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(319, 141, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(320, 141, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(321, 141, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(322, 143, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(323, 143, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(324, 143, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(325, 143, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(326, 143, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(327, 143, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(328, 144, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(329, 144, 8, 10, 0, NULL, NULL, 4000, 'activo'),
(330, 144, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(331, 144, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(332, 144, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(333, 144, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(334, 145, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(335, 146, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(336, 145, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(337, 146, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(338, 145, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(339, 146, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(340, 145, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(341, 146, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(342, 148, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(343, 148, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(344, 148, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(345, 148, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(346, 148, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(347, 148, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(348, 148, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(349, 148, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(350, 148, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(351, 148, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(352, 149, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(353, 149, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(354, 149, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(355, 149, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(356, 149, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(357, 149, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(358, 149, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(359, 149, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(360, 150, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(361, 150, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(362, 150, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(363, 150, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(364, 150, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(365, 150, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(366, 150, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(367, 150, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(368, 152, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(369, 152, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(370, 152, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(371, 152, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(372, 152, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(373, 152, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(374, 152, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(375, 152, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(376, 153, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(377, 153, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(378, 153, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(379, 153, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(380, 153, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(381, 154, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(382, 154, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(383, 154, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(384, 154, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(385, 154, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(386, 154, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(387, 154, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(388, 155, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(389, 155, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(390, 155, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(391, 155, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(392, 155, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(393, 155, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(394, 155, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(395, 155, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(396, 156, 5, 0, 0, NULL, NULL, 3000, 'activo'),
(397, 157, 6, 0, 0, NULL, NULL, 5000, 'activo'),
(398, 157, 7, 0, 0, NULL, NULL, 3000, 'activo'),
(399, 158, 8, 45, 0, NULL, NULL, 4000, 'activo'),
(400, 158, 9, 45, 0, NULL, NULL, 2500, 'activo'),
(401, 158, 10, 45, 0, NULL, NULL, 6000, 'activo'),
(402, 159, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(403, 159, 9, 10, 0, NULL, NULL, 2500, 'activo'),
(404, 159, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(405, 161, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(406, 161, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(407, 161, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(408, 161, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(409, 161, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(410, 161, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(411, 162, 8, 10, 10, NULL, NULL, 4000, 'activo'),
(412, 162, 9, 10, 10, NULL, NULL, 2500, 'activo'),
(413, 162, 10, 20, 10, NULL, NULL, 6000, 'activo'),
(414, 163, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(415, 163, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(416, 163, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(417, 163, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(418, 164, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(419, 164, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(420, 164, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(421, 164, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(422, 165, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(423, 165, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(424, 165, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(425, 165, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(426, 166, 8, 10, 0, NULL, NULL, 4000, 'activo'),
(427, 166, 9, 10, 0, NULL, NULL, 2500, 'activo'),
(428, 166, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(429, 167, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(430, 167, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(431, 167, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(432, 168, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(433, 168, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(434, 168, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(435, 169, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(436, 169, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(437, 169, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(438, 170, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(439, 170, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(440, 170, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(441, 172, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(442, 172, 9, 5, 0, NULL, NULL, 2500, 'activo'),
(443, 172, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(444, 172, 8, 10, 0, NULL, NULL, 4000, 'activo'),
(445, 172, 9, 10, 0, NULL, NULL, 2500, 'activo'),
(446, 172, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(447, 174, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(448, 174, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(449, 174, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(450, 174, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(451, 174, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(452, 174, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(453, 175, 8, 10, 0, NULL, NULL, 4000, 'activo'),
(454, 175, 9, 10, 0, NULL, NULL, 2500, 'activo'),
(455, 175, 10, 10, 0, NULL, NULL, 6000, 'activo'),
(456, 176, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(457, 176, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(458, 176, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(459, 177, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(460, 177, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(461, 177, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(462, 179, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(463, 179, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(464, 179, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(465, 179, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(466, 179, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(467, 179, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(468, 180, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(469, 180, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(470, 180, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(471, 181, 6, 0, 0, NULL, NULL, 5000, 'activo'),
(472, 181, 7, 0, 0, NULL, NULL, 3000, 'activo'),
(473, 182, 5, 0, 0, NULL, NULL, 3000, 'activo'),
(474, 183, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(475, 183, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(476, 183, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(477, 184, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(478, 184, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(479, 184, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(480, 185, 5, 0, 0, NULL, NULL, 3000, 'activo'),
(481, 186, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(482, 186, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(483, 186, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(484, 187, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(485, 187, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(486, 187, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(487, 188, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(488, 188, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(489, 188, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(490, 189, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(491, 189, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(492, 189, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(493, 191, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(494, 191, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(495, 191, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(496, 191, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(497, 191, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(498, 191, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(499, 192, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(500, 192, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(501, 192, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(502, 194, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(503, 194, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(504, 194, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(505, 194, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(506, 194, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(507, 194, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(508, 196, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(509, 196, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(510, 196, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(511, 196, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(512, 196, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(513, 196, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(514, 197, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(515, 198, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(516, 197, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(517, 198, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(518, 197, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(519, 198, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(520, 199, 8, 10, 0, NULL, NULL, 4000, 'activo'),
(521, 199, 9, 10, 0, NULL, NULL, 2500, 'activo'),
(522, 199, 10, 10, 0, NULL, NULL, 6000, 'activo'),
(523, 200, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(524, 200, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(525, 200, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(526, 201, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(527, 201, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(528, 201, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(529, 202, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(530, 203, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(531, 202, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(532, 203, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(533, 202, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(534, 203, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(535, 204, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(536, 204, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(537, 204, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(538, 205, 8, 1, 4, 10, NULL, 4000, 'activo'),
(539, 205, 9, 2, 5, 10, NULL, 2500, 'activo'),
(540, 205, 10, 3, 6, 10, NULL, 6000, 'activo'),
(541, 206, 8, 10, 4, NULL, NULL, 4000, 'activo'),
(542, 206, 9, 10, 5, NULL, NULL, 2500, 'activo'),
(543, 206, 10, 10, 3, NULL, NULL, 6000, 'activo'),
(544, 207, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(545, 207, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(546, 207, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(547, 208, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(548, 208, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(549, 208, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(550, 208, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(551, 210, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(552, 210, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(553, 210, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(554, 211, 5, 1, 0, NULL, NULL, 3000, 'activo'),
(555, 211, 12, 1, 0, NULL, NULL, 20000, 'activo'),
(556, 211, 13, 1, 0, NULL, NULL, 1000, 'activo'),
(557, 212, 8, 11, 10, 11, 1, 4000, 'activo'),
(558, 212, 9, 12, 10, 12, 2, 2500, 'activo'),
(559, 212, 10, 13, 10, 13, 3, 6000, 'activo'),
(560, 213, 8, 20, 10, NULL, NULL, 4000, 'activo'),
(561, 213, 9, 20, 10, NULL, NULL, 2500, 'activo'),
(562, 213, 10, 20, 10, NULL, NULL, 6000, 'activo'),
(563, 214, 8, 10, 2, NULL, 2, 4000, 'activo'),
(564, 214, 9, 15, 2, NULL, 2, 2500, 'activo'),
(565, 214, 10, 20, 2, NULL, 2, 6000, 'activo'),
(566, 215, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(567, 215, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(568, 215, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(569, 215, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(570, 217, 6, 0, 0, NULL, NULL, 5000, 'activo'),
(571, 217, 7, 0, 0, NULL, NULL, 3000, 'activo'),
(572, 218, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(573, 218, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(574, 218, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(575, 218, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(576, 219, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(577, 219, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(578, 219, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(579, 221, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(580, 221, 9, 0, 0, NULL, NULL, 2500, 'activo'),
(581, 221, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(582, 223, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(583, 223, 9, 0, 20, NULL, NULL, 2500, 'activo'),
(584, 223, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(585, 224, 8, 0, 0, NULL, NULL, 4000, 'activo'),
(586, 224, 9, 0, 20, NULL, NULL, 2500, 'activo'),
(587, 224, 10, 0, 0, NULL, NULL, 6000, 'activo'),
(588, 225, 8, 1, 30, NULL, 20, 4000, 'activo'),
(589, 225, 9, 1, 20, NULL, 15, 2500, 'activo'),
(590, 225, 10, 1, 45, NULL, 34, 6000, 'activo'),
(591, 226, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(592, 226, 2, 20, 20, NULL, NULL, 4000, 'activo'),
(593, 226, 3, 50, 0, NULL, NULL, 2000, 'activo'),
(594, 226, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(595, 227, 1, 0, 0, NULL, NULL, 1500, 'activo'),
(596, 227, 2, 0, 0, NULL, NULL, 4000, 'activo'),
(597, 227, 3, 0, 0, NULL, NULL, 2000, 'activo'),
(598, 227, 4, 0, 0, NULL, NULL, 1000, 'activo'),
(599, 228, 8, 0, 50, NULL, 10, 4000, 'activo'),
(600, 228, 9, 0, 40, NULL, 10, 2500, 'activo'),
(601, 228, 10, 0, 25, NULL, 10, 6000, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

CREATE TABLE `domicilio` (
  `id_domi` int(11) NOT NULL,
  `id_pers3` int(11) NOT NULL,
  `id_cliente2` int(11) NOT NULL,
  `id_vehiculo2` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `nivel_urgencia` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ubicacion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `destino` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tiempo_salida` time DEFAULT NULL,
  `tiempo_llegada` time DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `domicilio`
--

INSERT INTO `domicilio` (`id_domi`, `id_pers3`, `id_cliente2`, `id_vehiculo2`, `fecha`, `observacion`, `nivel_urgencia`, `ubicacion`, `destino`, `tiempo_salida`, `tiempo_llegada`, `estado`) VALUES
(1, 1, 1, 1, '2022-06-29', 'ninguna', 'normal', 'urbano', 'parque', '12:05:00', '12:05:00', 'inactivo'),
(2, 1, 2, 1, '2022-06-28', 'al final del recorrido', 'Prioritario', 'Sopetran', 'ramada', NULL, NULL, 'activo'),
(3, 1, 3, 1, '2022-06-29', 'delicado', 'normal', 'san francisco', 'carrera 20 #50-50', '15:57:00', NULL, 'proceso'),
(4, 1, 2, 1, '2022-06-29', 'despues de la escuela de manizales', 'Prioritario', 'san francisco', 'por la fabrica de agua', '12:07:00', '12:07:00', 'inactivo'),
(5, 1, 1, 1, '2022-06-28', 'nada', 'normal', 'urbano', 'la casa', NULL, NULL, 'activo'),
(6, 1, 2, 1, '2022-06-29', 'nada', 'Prioritario', 'urbano', 'mi casa', NULL, NULL, 'activo'),
(8, 1, 1, 1, '2022-06-29', 'werqwerqwerqwer', 'normal', 'urbano', 'fasdfasd', '12:06:00', '12:06:00', 'inactivo'),
(9, 3, 1, 1, '2022-06-29', 'nada', 'normal', 'san francisco', 'vereda', NULL, NULL, 'activo'),
(10, 3, 5, 1, '2022-06-29', 'villa jardin', 'normal', 'villa jardin', 'jardin', '12:19:00', '12:24:00', 'inactivo'),
(11, 3, 7, 1, '2022-06-29', 'ninguna', 'normal', 'urbano', 'hogar', '15:52:00', '15:52:00', 'inactivo'),
(12, 3, 10, 1, '2022-06-29', 'ninguna', 'normal', 'urbano', 'su casa', NULL, NULL, 'activo'),
(13, 3, 11, 1, '2022-07-01', 'hfghfg', 'carnes', 'hfghfgh', 'gfhfgh', '16:12:00', '16:12:00', 'inactivo'),
(14, 1, 2, 1, '2022-07-11', '123', '', 'urbano', 'su casa', '16:08:00', '16:08:00', 'inactivo'),
(15, 1, 1, 1, '2022-07-14', 'kjkhjkhjk', 'carnes', 'urbano', 'khkhjkj', '12:02:00', '12:02:00', 'inactivo'),
(16, 1, 6, 1, '2022-07-25', 'hgjdghjdgh', 'carnes', 'urbano', 'dhgdfj', NULL, NULL, 'activo'),
(17, 1, 1, 1, '2022-08-03', 'ninguna', '', 'urbano', 'casa', '11:32:00', '11:32:00', 'inactivo'),
(18, 1, 2, 2, '2022-08-03', '', 'normal', 'Sopetran', 'casa', NULL, NULL, 'activo'),
(19, 1, 6, 1, '2022-08-03', '', 'normal', 'Sopetran', 'cacerío', NULL, NULL, 'activo'),
(20, 1, 8, 1, '2022-08-03', 'jgfjgh', 'normal', 'urbano', 'hjghj', NULL, NULL, 'activo'),
(21, 1, 2, 1, '2022-08-04', 'fsdfdsfsdf', 'normal', 'urbano', 'casa', NULL, NULL, 'activo'),
(22, 1, 3, 1, '2022-08-08', '', 'normal', 'urbano', 'carrera tal', NULL, NULL, 'activo'),
(23, 1, 1, 1, '2022-08-19', '', 'normal', 'urbano', 'carrera 18', NULL, NULL, 'activo'),
(24, 1, 1, 1, '2022-09-05', '', 'Prioritario', 'urbano', 'carrea 20 50-59', '10:19:00', '10:19:00', 'inactivo'),
(25, 1, 14, 1, '2022-09-15', '', 'normal', 'urbano', 'al frente de la mzana', '18:58:00', '18:58:00', 'inactivo'),
(26, 1, 15, 1, '2022-09-15', 'delicado', 'Prioritario', 'san francisco', 'vereda', '19:01:00', '19:01:00', 'inactivo'),
(27, 1, 16, 1, '2022-09-17', '', 'normal', 'urbano', 'carrera', '12:20:27', '15:34:34', 'inactivo'),
(28, 1, 1, 1, '2022-09-17', '', 'Prioritario', 'urbano', 'hhhhhhhhhhh', NULL, NULL, 'activo'),
(29, 1, 17, 1, '2022-09-17', 'vvvv', 'normal', 'urbano', 'fhfhfhhfhf', '15:56:20', '17:37:53', 'inactivo'),
(30, 1, 18, 1, '2022-09-17', '', 'Prioritario', 'urbano', 'calle colombia', NULL, NULL, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_facturacion` int(11) NOT NULL,
  `name_cliente` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `forma_pago` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_cliente3` int(11) DEFAULT NULL,
  `id_pers1` int(11) NOT NULL,
  `precio_total` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_congelado` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_facturacion`, `name_cliente`, `fecha`, `forma_pago`, `id_cliente3`, `id_pers1`, `precio_total`, `nombre_congelado`, `estado`) VALUES
(1, 'Juanito V.', '2022-08-04 17:05:53', 'credito', 1, 1, '19100', NULL, 'finalizada'),
(2, 'Jaime R.', '2022-08-05 11:41:35', 'contado', 2, 3, '100000', NULL, 'finalizada'),
(4, NULL, '2022-08-08 16:08:59', NULL, NULL, 1, NULL, 'juan', 'congelado'),
(5, '', '2022-08-18 14:31:24', 'contado', NULL, 3, NULL, NULL, 'finalizada'),
(6, NULL, '2022-08-08 18:00:56', NULL, NULL, 1, NULL, NULL, ''),
(7, 'pedro', '2022-08-08 18:01:22', 'tarjeta', NULL, 1, NULL, 'yaned', 'finalizada'),
(8, 'Camilo', '2022-08-12 16:39:40', 'credito', 12, 1, NULL, 'santiago', 'finalizada'),
(9, 'gabriel', '2022-08-09 20:30:34', 'contado', NULL, 1, NULL, NULL, 'finalizada'),
(10, 'susana', '2022-08-10 17:20:30', 'contado', NULL, 3, NULL, NULL, 'finalizada'),
(11, NULL, '2022-08-10 17:22:01', NULL, NULL, 1, NULL, NULL, 'congelado'),
(12, NULL, '2022-08-10 19:12:06', NULL, NULL, 1, NULL, NULL, 'congelado'),
(13, NULL, '2022-08-10 19:13:46', NULL, NULL, 1, NULL, 'carlos', 'congelado'),
(14, NULL, '2022-08-10 19:15:56', NULL, NULL, 1, NULL, NULL, 'congelado'),
(15, 'rosa', '2022-08-10 19:19:35', 'tarjeta', NULL, 1, NULL, 'juanito', 'finalizada'),
(16, NULL, '2022-08-11 11:56:41', NULL, NULL, 1, NULL, 'JOSE', 'congelado'),
(17, 'juanpa', '2022-08-11 17:06:42', 'contado', NULL, 1, NULL, NULL, 'finalizada'),
(18, 'juan', '2022-08-18 14:29:18', 'contado', NULL, 1, NULL, NULL, 'finalizada'),
(19, 'juan', '2022-08-18 14:29:51', 'credito', 12, 1, NULL, NULL, 'finalizada'),
(20, 'jorge', '2022-08-18 14:30:16', 'contado', NULL, 1, NULL, NULL, 'finalizada'),
(21, '', '2022-09-15 16:25:26', 'contado', NULL, 1, NULL, NULL, 'finalizada'),
(22, NULL, '2022-08-18 14:31:24', NULL, NULL, 3, NULL, NULL, 'activo'),
(23, '', '2022-09-15 16:26:48', 'contado', NULL, 1, NULL, NULL, 'finalizada'),
(24, 'santiago', '2022-09-15 18:42:50', 'credito', 12, 1, NULL, NULL, 'finalizada'),
(25, '', '2022-09-15 18:52:53', 'contado', NULL, 1, NULL, NULL, 'finalizada'),
(26, '', '2022-09-17 17:44:35', 'contado', NULL, 1, NULL, NULL, 'finalizada'),
(27, NULL, '2022-09-17 17:44:35', NULL, NULL, 1, NULL, NULL, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_abono`
--

CREATE TABLE `factura_abono` (
  `id_factura_abono` int(11) NOT NULL,
  `abono` int(11) NOT NULL,
  `fecha_abono` date NOT NULL,
  `id_cliente1` int(11) NOT NULL,
  `metodo_abono` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `factura_abono`
--

INSERT INTO `factura_abono` (`id_factura_abono`, `abono`, `fecha_abono`, `id_cliente1`, `metodo_abono`) VALUES
(1, 0, '2022-08-17', 1, ''),
(2, 0, '2022-08-17', 1, ''),
(3, 2000, '2022-08-17', 1, ''),
(4, 4000, '2022-08-16', 1, ''),
(5, 200000, '2022-08-18', 12, 'efectivo'),
(6, 200000, '2022-08-19', 12, 'efectivo'),
(7, 200000, '2022-09-09', 12, 'efectivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gasto`
--

CREATE TABLE `gasto` (
  `id_gasto` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `gasto`
--

INSERT INTO `gasto` (`id_gasto`, `mes`, `year`) VALUES
(1, 7, 2022);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gas_detalle`
--

CREATE TABLE `gas_detalle` (
  `id_gasto_de` int(11) NOT NULL,
  `id_gasto1` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `costo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `gas_detalle`
--

INSERT INTO `gas_detalle` (`id_gasto_de`, `id_gasto1`, `nombre`, `costo`) VALUES
(1, 1, 'arriendo', 1000000),
(2, 1, 'servicios', 500000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kilometraje`
--

CREATE TABLE `kilometraje` (
  `id_kilometraje` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_vehiculo3` int(11) NOT NULL,
  `kilometra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `kilometraje`
--

INSERT INTO `kilometraje` (`id_kilometraje`, `fecha`, `id_vehiculo3`, `kilometra`) VALUES
(1, '2022-08-03', 1, 1000),
(2, '2022-08-02', 2, 5000),
(3, '2022-08-03', 2, 6000),
(4, '2022-08-04', 1, 5000),
(5, '2022-08-08', 1, 1),
(6, '2022-08-19', 1, 2000),
(7, '2022-09-05', 1, 3000),
(8, '2022-09-15', 1, 1),
(9, '2022-09-17', 1, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observacion`
--

CREATE TABLE `observacion` (
  `id_obs` int(11) NOT NULL,
  `id_vehiculo1` int(11) DEFAULT NULL,
  `observacion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `costo` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` varchar(50) CHARACTER SET utf32 COLLATE utf32_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `observacion`
--

INSERT INTO `observacion` (`id_obs`, `id_vehiculo1`, `observacion`, `costo`, `fecha`, `estado`) VALUES
(1, 1, 'gasolina moto', 10000, '2022-07-14', 'activo'),
(2, 2, '', 14000, '2022-08-10', 'activo'),
(3, 1, '', 50000, '2022-08-19', ''),
(4, 1, '', 0, '2022-08-19', ''),
(5, 1, 'nuevo presupuesto', 45000, '2022-08-19', 'activo'),
(6, 1, 'Compra de rin', 450000, '2022-09-09', 'activo'),
(7, 1, 'moto teeran', 20000, '2022-09-17', 'activo'),
(8, 1, 'combustible', 15000, '2022-09-17', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_caja`
--

CREATE TABLE `pagos_caja` (
  `id_pagos_caja` int(11) NOT NULL,
  `descripcion_caja` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `costo_pagos` int(11) DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pagos_caja`
--

INSERT INTO `pagos_caja` (`id_pagos_caja`, `descripcion_caja`, `costo_pagos`, `estado`) VALUES
(1, 'Monedas', 60000, 'activo'),
(2, '', 0, ''),
(3, '', 20000, ''),
(4, '', 20000, ''),
(5, '', 0, ''),
(6, '', 0, ''),
(7, '', 0, ''),
(8, '', 0, ''),
(9, '', 0, ''),
(10, '', 0, ''),
(11, '', 0, ''),
(12, '', 0, ''),
(13, '', 50000, ''),
(14, '', 50000, ''),
(15, '', 9000, ''),
(16, '', 2000, ''),
(17, '', 100000, ''),
(18, '', 0, ''),
(19, 'flete', 300000, 'activo'),
(20, 'juan pablo zapata gomez', 100000, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id_pers` int(11) NOT NULL,
  `nombre_pers` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `identificacion_pers` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular_pers` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `correo_pers` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_pers` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pass_pers` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_usuario_pers` int(11) DEFAULT NULL,
  `fecha_nacimiento_pers` date DEFAULT NULL,
  `fecha_inicio_contrato_pers` date DEFAULT NULL,
  `tipo_contrato_pers` int(11) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `cargo` int(11) DEFAULT NULL,
  `salario_pers` int(11) DEFAULT NULL,
  `eps` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `arl` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `caja_compensacion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pension` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id_pers`, `nombre_pers`, `identificacion_pers`, `celular_pers`, `correo_pers`, `user_pers`, `pass_pers`, `tipo_usuario_pers`, `fecha_nacimiento_pers`, `fecha_inicio_contrato_pers`, `tipo_contrato_pers`, `fecha_ingreso`, `cargo`, `salario_pers`, `eps`, `arl`, `caja_compensacion`, `pension`, `estado`) VALUES
(1, 'juan pablo zapata gómez', '1037977046', '3135721225', 'juan@gmail.com', 'jupazago', '159875321', 1, '1998-03-06', '2022-04-08', 8, '2022-07-13', 1, 1000000, 'savia', 'sura', 'comfama', 'porvenir', 'activo'),
(2, 'Domiciliario', '1', '123', 'domi@gmail.com', 'domi', 'domi', 4, '2004-09-15', '2022-06-02', 12, '2022-07-13', 4, 500000, 'sura', 'sura', '', 'proteccion', 'activo'),
(3, 'empleado prueba', '', '456', 'emp_1@hotmail.com', 'empleado', '1234', 2, '1990-07-21', '2022-01-01', 12, '2022-07-14', 2, 1200000, '', '', '', 'colpensiones', 'activo'),
(4, NULL, NULL, NULL, NULL, 'probando', 'probando', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo'),
(5, NULL, NULL, NULL, NULL, 'prueba 50', 'prueba 50', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo'),
(6, NULL, NULL, NULL, NULL, 'probando 40', 'probando 40', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo'),
(7, 'jaime r', '123456', NULL, NULL, 'jaime123', 'jaime123', 2, '2000-01-01', '2022-01-01', 6, NULL, NULL, 1000000, 'sura', 'sura', 'comfenalco', 'porvenir', 'activo'),
(8, NULL, NULL, NULL, NULL, 'Bimbo', 'Bimbo', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo'),
(9, NULL, NULL, NULL, NULL, 'auralac', 'auralac', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo'),
(10, '', NULL, NULL, NULL, NULL, NULL, 3, '2020-01-01', '2022-01-01', 0, NULL, 3, 0, NULL, NULL, NULL, NULL, ''),
(11, '', NULL, NULL, NULL, NULL, NULL, 3, '2010-01-01', '2022-01-01', 0, '2022-01-01', 3, 0, NULL, NULL, NULL, NULL, ''),
(12, '', NULL, NULL, NULL, NULL, NULL, 3, '2022-07-12', '2022-07-12', 0, '2022-07-12', 3, 0, NULL, NULL, NULL, NULL, ''),
(13, '', NULL, NULL, NULL, NULL, NULL, 3, '2022-07-12', '2022-07-12', 0, '2022-07-12', 3, 0, NULL, NULL, NULL, NULL, ''),
(14, '', NULL, NULL, NULL, NULL, NULL, 3, '2022-07-12', '2022-07-12', 0, '2022-07-12', 3, 0, NULL, NULL, NULL, NULL, ''),
(15, '', NULL, NULL, NULL, NULL, NULL, 3, '2022-07-12', '2022-07-12', 0, '2022-07-12', 3, 0, NULL, NULL, NULL, NULL, ''),
(16, '', '', NULL, NULL, NULL, NULL, 3, '2022-07-13', '2022-07-13', NULL, '2022-07-13', 3, NULL, '', '', '', '', ''),
(17, '', '', NULL, NULL, NULL, NULL, 3, '2022-07-13', '2022-07-13', NULL, '2022-07-13', 3, NULL, '', '', '', '', ''),
(18, '', '', NULL, NULL, NULL, NULL, 3, '2022-07-13', '2022-07-13', NULL, '2022-07-13', 3, NULL, '', '', '', '', ''),
(19, '', NULL, '', '', '', '', 3, '2022-07-13', '2022-07-13', NULL, '2022-07-13', 3, NULL, NULL, NULL, NULL, NULL, ''),
(20, '', NULL, '', '', '', '', 3, '2022-07-13', '2022-07-13', NULL, '2022-07-13', 3, NULL, NULL, NULL, NULL, NULL, ''),
(21, '', NULL, '', '', '', '', 3, '2022-07-13', '2022-07-13', NULL, '2022-07-13', 3, NULL, NULL, NULL, NULL, NULL, ''),
(22, '', NULL, NULL, NULL, NULL, NULL, 3, '2022-07-13', '2022-07-13', 0, '2022-07-13', 3, 0, NULL, NULL, NULL, NULL, ''),
(23, '', NULL, NULL, NULL, NULL, NULL, 3, '2022-07-13', '2022-07-13', 0, '2022-07-13', 3, 0, NULL, NULL, NULL, NULL, ''),
(24, '', NULL, '', '', '', '', 3, '2022-07-13', '2022-07-13', NULL, '2022-07-13', 3, NULL, NULL, NULL, NULL, NULL, ''),
(25, '', '', '', '', '', '', 0, '1992-07-14', '2022-07-14', NULL, '2022-07-14', 3, NULL, '', '', '', '', ''),
(26, '', '', '', '', '', '', 3, '2022-09-05', '2022-08-03', 12, '2022-09-05', 3, 0, '', '', '', '', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto`
--

CREATE TABLE `presupuesto` (
  `id_presu` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `presupuesto`
--

INSERT INTO `presupuesto` (`id_presu`, `mes`, `year`) VALUES
(1, 7, 2022),
(2, 6, 2022),
(3, 1, 2022),
(4, 5, 2022),
(5, 11, 2021),
(6, 1, 2023),
(7, 8, 2022),
(8, 9, 2022),
(9, 10, 2022),
(10, 11, 2022);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_detalle`
--

CREATE TABLE `pre_detalle` (
  `id_presu_de` int(11) NOT NULL,
  `id_presu1` int(11) DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `costo` int(11) DEFAULT NULL,
  `costo_gasto` int(11) DEFAULT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_pers4` int(11) DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pre_detalle`
--

INSERT INTO `pre_detalle` (`id_presu_de`, `id_presu1`, `nombre`, `costo`, `costo_gasto`, `descripcion`, `id_pers4`, `estado`) VALUES
(1, 1, 'Arriendo', 5000000, NULL, 'xd', 1, 'activo'),
(2, 1, 'Servicios', 5000000, NULL, '', 3, 'activo'),
(3, 1, '', 0, 0, NULL, NULL, ''),
(7, 1, '', 0, 0, NULL, NULL, ''),
(11, 1, '', 0, 0, NULL, NULL, ''),
(12, 1, '', 0, 0, NULL, NULL, ''),
(13, 1, '', 0, 0, NULL, NULL, ''),
(14, 1, '', 0, 0, NULL, NULL, ''),
(15, 1, '', 0, 0, NULL, NULL, ''),
(17, 2, '', 0, 0, NULL, NULL, ''),
(18, 2, '', 0, 0, NULL, NULL, ''),
(27, 2, '', 0, 0, NULL, NULL, ''),
(28, 2, '', 0, 0, NULL, NULL, 'activo'),
(29, 2, '', 0, 0, NULL, NULL, ''),
(30, 3, 'Arriendo', 1000000, 1500000, NULL, NULL, 'activo'),
(31, 3, '', 0, 0, NULL, NULL, ''),
(32, 3, 'servicios', 5000000, 10000000, NULL, NULL, 'activo'),
(33, 3, 'Trnasporte', 2000000, 1850000, NULL, NULL, 'activo'),
(34, 3, '', 0, 0, NULL, NULL, ''),
(35, 3, '', 0, 0, NULL, NULL, ''),
(36, 3, '', 0, 0, NULL, NULL, ''),
(37, 3, '', 0, 0, NULL, NULL, ''),
(38, 4, NULL, NULL, NULL, NULL, NULL, 'activo'),
(39, 5, NULL, NULL, NULL, NULL, NULL, 'activo'),
(40, 3, '', 0, 0, NULL, NULL, ''),
(41, 3, NULL, NULL, NULL, NULL, NULL, 'activo'),
(42, 6, NULL, NULL, NULL, NULL, NULL, 'activo'),
(43, 1, NULL, NULL, NULL, NULL, NULL, ''),
(44, 1, NULL, NULL, NULL, NULL, NULL, ''),
(52, 1, 'Ferreteria', 1000000, 5, ':v', 1, 'activo'),
(64, 1, '', 5000000, NULL, '', 1, ''),
(65, 1, '', 0, NULL, '', 3, ''),
(95, 1, '', 0, NULL, '', 1, ''),
(98, 1, '', 0, NULL, '', 1, ''),
(99, 7, 'Arriendo', 0, NULL, '', 1, 'activo'),
(101, 1, '', 0, NULL, '', 1, ''),
(103, 8, 'Servicios', 1500000, NULL, 'agua', 1, 'activo'),
(105, 7, '', 0, NULL, '', 1, ''),
(106, 7, '', 0, NULL, '', 1, ''),
(109, 9, '', 20000, NULL, '', 1, 'activo'),
(110, 10, NULL, NULL, NULL, NULL, 1, 'activo'),
(111, 7, 'Servicios', 0, NULL, '', 1, 'activo'),
(112, 8, '', 0, NULL, '', 1, ''),
(113, 8, '', 0, NULL, '', 1, ''),
(114, 8, 'Servicios', 2500000, NULL, 'energía', 1, 'activo'),
(115, 8, 'Arriendo', 5000000, NULL, 'local', 1, 'activo'),
(116, 8, 'Ferreteria', 4000000, NULL, 'insumos', 3, 'activo'),
(117, 8, 'seguridad social', 800000, NULL, 'empleados', 3, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_detalle_cat`
--

CREATE TABLE `pre_detalle_cat` (
  `id_pre_detalle_cat` int(11) NOT NULL,
  `cate_pre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pre_detalle_cat`
--

INSERT INTO `pre_detalle_cat` (`id_pre_detalle_cat`, `cate_pre`, `estado`) VALUES
(1, 'Arriendo', 'activo'),
(2, 'Servicios', 'activo'),
(3, 'Ferreteria', 'activo'),
(4, '', ''),
(5, '', ''),
(6, '', ''),
(7, '', ''),
(8, 'seguridad social', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL,
  `id_cat1` int(11) NOT NULL,
  `nombre_producto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio_producto` int(11) DEFAULT NULL,
  `precio_producto2` int(11) DEFAULT NULL,
  `precio_producto3` int(11) DEFAULT NULL,
  `precio_de_compra` int(11) NOT NULL,
  `existencias` int(11) DEFAULT NULL,
  `id_proveedor1` int(11) NOT NULL,
  `iva` int(11) DEFAULT NULL,
  `control_inv` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `decimales_cant` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `dias_rotacion` int(11) NOT NULL,
  `class_iva` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `flete` int(11) NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `cod_producto`, `id_cat1`, `nombre_producto`, `descripcion`, `precio_producto`, `precio_producto2`, `precio_producto3`, `precio_de_compra`, `existencias`, `id_proveedor1`, `iva`, `control_inv`, `decimales_cant`, `dias_rotacion`, `class_iva`, `flete`, `estado`) VALUES
(1, 1, 1, 'botella 450ml', 'botella personal', 3000, 2900, 2800, 1500, 0, 36, 19, 'si', 'si', 10, 'gravado', 100, 'activo'),
(2, 2, 1, 'mega 3L', '3 litros', 5000, 4500, NULL, 4000, 10, 36, 19, 'no', 'no', 0, 'incluido', 0, 'activo'),
(3, 3, 1, 'bitella 1.5L', '', 3000, 2500, NULL, 2000, 10, 36, 19, '', '', 0, 'gravado', 0, 'activo'),
(4, 4, 1, 'litron', '', 1500, 1500, NULL, 1000, 10, 36, 19, '', '', 0, 'gravado', 0, 'activo'),
(5, 5, 1, 'leche 1L', '', 4000, 3800, NULL, 3000, 20, 64, 19, '', '', 0, 'gravado', 0, 'activo'),
(6, 6, 1, 'pan integral 100gr', '', 3500, 0, NULL, 5000, 110, 65, 19, '', '', 0, 'gravado', 0, 'activo'),
(7, 7, 1, 'pan leche 250 gr', NULL, 3500, NULL, NULL, 3000, 10, 65, 19, '', '', 0, 'gravado', 0, 'activo'),
(8, 8, 1, 'ballena', NULL, 4000, NULL, NULL, 4000, NULL, 67, 19, '', '', 0, 'gravado', 0, 'activo'),
(9, 9, 13, 'cangrejitos', '', 1800, 0, 0, 2500, 0, 67, 19, 'si', 'si', 0, 'gravado', 0, 'activo'),
(10, 10, 1, 'almejas', NULL, 2300, NULL, NULL, 6000, NULL, 67, 19, '', '', 0, 'gravado', 0, 'activo'),
(12, 11, 2, 'karne 500g', 'paquete', 26000, 25000, 24000, 20000, 0, 64, 19, 'si', 'si', 10, 'gravado', 0, 'activo'),
(13, 2147483647, 2, 'vela', 'ninguna', 1500, 1400, 1100, 1000, 0, 64, 10, 'si', 'si', 0, 'gravado', 0, 'activo'),
(14, 14, 1, 'cervecero kilo', 'zenu', 18000, 14000, 13000, 10000, 0, 71, 19, 'si', 'si', 10, 'gravado', 0, 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pass` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion_proveedor` varchar(65) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contacto_proveedor` varchar(65) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nom_vendedor` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono_vendedor` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre_proveedor`, `user`, `pass`, `direccion_proveedor`, `contacto_proveedor`, `nom_vendedor`, `telefono_vendedor`, `estado`) VALUES
(1, 'prove', NULL, NULL, 'san luis ant', '123456', '', '', ''),
(2, 'provee', NULL, NULL, 'Dirección', 'Teléfono', '', '', ''),
(3, 'provee2', NULL, NULL, 'rionegro', '123465', '', '', ''),
(4, 'nuevoprove', NULL, NULL, 'Dirección', 'Teléfono', '', '', ''),
(5, 'nuevoprovee', NULL, NULL, 'Dirección', 'Teléfono', '', '', ''),
(6, 'nuevoproveer', NULL, NULL, 'Dirección', 'Teléfono', '', '', ''),
(7, 'nuevoproveerr', NULL, NULL, 'Dirección', 'Teléfono', '', '', ''),
(8, 'crear prove', NULL, NULL, 'direccion 5', '123456', '', '', ''),
(9, 'colanta', NULL, NULL, 'rionegro', '654321', '', '', ''),
(10, 'aura', 'aura123', 'aura', 'fsdfsdf', 'ffffffffff', 'fffffffffffffffffff', 'ffffffffffffffff', ''),
(11, 'aura', NULL, NULL, 'medellin', '123456', 'jaime', '32123121', ''),
(12, 'milo', 'milos', 'milo', 'dhghdhg', '', '', '', ''),
(13, 'milo', NULL, NULL, 'medellin', '123456', 'jaime', '32123121', ''),
(14, 'nutresa', NULL, NULL, 'medellin', '123456', 'jaime salazar', '32123121', ''),
(15, 'nutresa', NULL, NULL, 'medellin', '123456', 'jaime salazar', '32123121', ''),
(16, 'prueba', NULL, NULL, '123456', '00000000', '123456', '123456', ''),
(17, 'prueba', NULL, NULL, '123456', '00000000', '123456', '123456', ''),
(18, 'prueba2', NULL, NULL, 'san luis', '123456', 'carlos', '132456', ''),
(19, 'prueba2', NULL, NULL, 'san luis', '123456', 'carlos', '132456', ''),
(20, 'empa', 'empa', 'empa', 'sdfsdf', '', '', '', ''),
(21, 'empa', NULL, NULL, 'rionegro', '123456', 'provedor', '123456', ''),
(22, 'nuevo', NULL, NULL, 'fgdfgadfgadfg', '0000000000', 'ikyukukyu', '456565645456', ''),
(23, 'nuevo', NULL, NULL, 'fgdfgadfgadfg', '0000000000', 'ikyukukyu', '456565645456', ''),
(24, 'ahora', NULL, NULL, 'medellin', '123456', 'vendedor', '123456', ''),
(25, 'ahora', NULL, NULL, 'medellin', '123456', 'vendedor', '123456', ''),
(26, 'ahora2', NULL, NULL, 'medellin', '123456', 'vendedor', '123456', ''),
(27, 'ahora2', NULL, NULL, 'medellin', '123456', 'vendedor', '123456', ''),
(28, 'ahora3', NULL, NULL, 'afasdgafdgadfgf', '212fd1g2df1g', 'gd1f5gdf51gdf', 'gd6f4g5df5g1df5g', ''),
(29, 'ahora4', NULL, NULL, 'afasdgafdgadfgf', '212fd1g2df1g', 'gd1f5gdf51gdf', 'gd6f4g5df5g1df5g', ''),
(30, 'ahora5', NULL, NULL, 'afasdgafdgadfgf', '212fd1g2df1g', 'gd1f5gdf51gdf', 'gd6f4g5df5g1df5g', ''),
(31, 'ahora6', NULL, NULL, 'afasdgafdgadfgf', '212fd1g2df1g', 'gd1f5gdf51gdf', 'gd6f4g5df5g1df5g', ''),
(32, 'provedor 1', NULL, NULL, 'san luis', '000000000', 'jaime', '123456', ''),
(33, 'nuevo', NULL, NULL, 'fgdfgadfgadfg', '0000000000', 'ikyukukyu', '456565645456', ''),
(34, 'otro prove', NULL, NULL, 'rionegro', '00000000', 'vendedor', '12345678', ''),
(35, 'prueba', NULL, NULL, '123456', '00000000', '123456', '123456', ''),
(36, 'cocacola', 'cocacola', 'cocacola', '', '', '', '', 'activo'),
(37, 'probando', NULL, NULL, 'ggggggggggggg', '0000', 'ggggggggggggg', 'ggggggg', ''),
(38, 'probando 40', NULL, NULL, 'fffffff', '00000000', 'ffffffffffffffffffff', 'ffffffffffffffffffffff', ''),
(39, 'Bimbo', 'Bimbo', 'Bimbo', '', '', '', '', ''),
(40, 'auralac', 'auralac', 'auralac', '', '', '', '', ''),
(41, '', NULL, NULL, '', '', '', '', ''),
(42, '', '', '', '', '', '', '', ''),
(43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(44, '', NULL, NULL, '', '', '', '', ''),
(45, '', NULL, NULL, 'xdxd', '', '', '', ''),
(46, '', NULL, NULL, '', '', '', '', ''),
(47, '', NULL, NULL, '', '', '', '', ''),
(48, '', NULL, NULL, '', '', '', '', ''),
(49, '', NULL, NULL, '', '', '', '', ''),
(50, '', NULL, NULL, '', '', '', '', ''),
(51, '', NULL, NULL, '', '', '', '', ''),
(52, '', NULL, NULL, '', '', '', '', ''),
(53, '', NULL, NULL, '', '', '', '', ''),
(54, '', NULL, NULL, '', '', '', '', ''),
(55, '', NULL, NULL, '', '', '', '', ''),
(56, '', NULL, NULL, '', '', '', '', ''),
(57, '', NULL, NULL, '', '', '', '', ''),
(58, '', NULL, NULL, '', '', '', '', ''),
(59, '', NULL, NULL, '', '', '', '', ''),
(60, '', NULL, NULL, '', '', '', '', ''),
(61, '', NULL, NULL, '', '', '', '', ''),
(62, '', NULL, NULL, '', '', '', '', ''),
(63, '', NULL, NULL, '', '', '', '', ''),
(64, 'san juan', 'san juan', 'san juan', 'medellin', '', '', '', 'activo'),
(65, 'panca', 'panca', 'panca', '', '', '', '', 'activo'),
(66, '', NULL, NULL, '', '', '', '', ''),
(67, 'natipan', 'natipan', 'natipan', 'medellin', '', '', '', 'activo'),
(68, '', NULL, NULL, '', '', '', '', ''),
(69, '', NULL, NULL, '', '', '', '', ''),
(70, '', NULL, NULL, '', '', '', '', ''),
(71, 'proveedor', 'proveedor', 'proveedor', 'san luis carrera', '834 123132', 'caliche', '2132465', 'activo'),
(72, '', NULL, NULL, '', '', '', '', ''),
(73, '', NULL, NULL, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimiento`
--

CREATE TABLE `requerimiento` (
  `id_reque` int(11) NOT NULL,
  `id_pers5` int(11) NOT NULL,
  `reque` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `costo` int(11) DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `requerimiento`
--

INSERT INTO `requerimiento` (`id_reque`, `id_pers5`, `reque`, `costo`, `estado`, `fecha`) VALUES
(1, 1, 'contratación de nuevo empleado', 1000000, 'activo', '2022-09-30'),
(2, 3, 'Instalación de productos', 1200000, 'activo', '2022-09-30'),
(3, 1, '', 0, '', '2022-09-17'),
(4, 1, '', 0, '', '2022-09-17'),
(5, 1, '', 0, '', '2022-09-17'),
(6, 1, '', 5000000, '', '2022-09-17'),
(7, 1, '', 0, '', '2022-09-17'),
(8, 1, '', 0, '', '2022-09-17'),
(9, 1, '', 0, '', '2022-09-17'),
(10, 1, 'compra de nevera', 5400000, 'activo', '2022-09-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ro_detalles`
--

CREATE TABLE `ro_detalles` (
  `id_ro_de` int(11) NOT NULL,
  `id_ro1` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `inventario` int(11) DEFAULT NULL,
  `ventas` int(11) DEFAULT NULL,
  `g_operacion` int(11) DEFAULT NULL,
  `margen` decimal(11,2) DEFAULT NULL,
  `dividendo` int(11) DEFAULT NULL,
  `cxpagar` int(11) DEFAULT NULL,
  `credito` int(11) DEFAULT NULL,
  `efectivo` int(11) DEFAULT NULL,
  `tarjeta` int(11) DEFAULT NULL,
  `inversion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ro_detalles`
--

INSERT INTO `ro_detalles` (`id_ro_de`, `id_ro1`, `mes`, `inventario`, `ventas`, `g_operacion`, `margen`, `dividendo`, `cxpagar`, `credito`, `efectivo`, `tarjeta`, `inversion`) VALUES
(1, 1, 1, 500000000, 50, 0, '0.00', 0, 0, 0, 0, 0, 0),
(4, 1, 2, 0, 50, 0, '0.00', 0, 0, 0, 0, 0, 0),
(5, 1, 3, 0, 50, 0, '0.00', 0, 0, 0, 0, 0, 850000000),
(6, 1, 4, 0, 50, 0, '0.00', 0, 0, 0, 0, 0, 0),
(7, 1, 5, 0, 550000000, 0, '0.00', 0, 0, 0, 0, 0, 0),
(8, 1, 6, 400000000, 500000000, 50000000, '7.00', 0, 0, 0, 0, 0, 0),
(9, 1, 7, 500000000, 800000000, 30000000, '5.00', 50000000, 0, 0, 0, 50000000, 0),
(10, 1, 8, 518189000, 812091312, 33509420, '9.46', 30000000, 390924702, 160495271, 31300000, 65261489, 100000000),
(11, 1, 9, 0, 50, 0, '0.00', 0, 500000000, 0, 0, 0, 30000000),
(12, 1, 10, 0, 50, 0, '0.00', 0, 0, 0, 0, 0, 120000000),
(13, 1, 11, 0, 50, 0, '0.00', 0, 0, 0, 0, 0, 0),
(14, 1, 12, 0, 50, 0, '0.00', 0, 0, 0, 0, 0, 0),
(15, 2, 1, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(16, 2, 2, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(17, 2, 3, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(18, 2, 4, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(19, 2, 5, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(20, 2, 6, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(21, 2, 7, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(22, 2, 8, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(23, 2, 9, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(24, 2, 10, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(25, 2, 11, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(26, 2, 12, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(27, 3, 1, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(28, 3, 2, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(29, 3, 3, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(30, 3, 4, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(31, 3, 5, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(32, 3, 6, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(33, 3, 7, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(34, 3, 8, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(35, 3, 9, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(36, 3, 10, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(37, 3, 11, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(38, 3, 12, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL),
(39, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 4, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 4, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 4, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 4, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 4, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 4, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 4, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 5, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 5, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 5, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 5, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 5, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 5, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 6, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 6, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 6, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 6, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 6, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 6, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 6, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 6, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `r_operativos`
--

CREATE TABLE `r_operativos` (
  `id_ro` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `r_operativos`
--

INSERT INTO `r_operativos` (`id_ro`, `year`) VALUES
(1, 2022),
(2, 2021),
(3, 2023),
(4, 2020),
(5, 2019),
(6, 2024);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sugerido`
--

CREATE TABLE `sugerido` (
  `id_sugerido` int(11) NOT NULL,
  `id_pers2` int(11) DEFAULT NULL,
  `fecha_sugerido` date NOT NULL,
  `pedido_proxima_sugerido` date DEFAULT NULL,
  `pedido_llegada` date DEFAULT NULL,
  `pedido_fecha_factura` date DEFAULT NULL,
  `nombre_provedor_sugerido` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_empleado_provedor_sug` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_empleado_provedor_sug2` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sugerido`
--

INSERT INTO `sugerido` (`id_sugerido`, `id_pers2`, `fecha_sugerido`, `pedido_proxima_sugerido`, `pedido_llegada`, `pedido_fecha_factura`, `nombre_provedor_sugerido`, `nombre_empleado_provedor_sug`, `nombre_empleado_provedor_sug2`, `estado`) VALUES
(1, 1, '2022-07-10', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(2, 1, '2022-07-22', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(3, 1, '2022-07-22', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(4, 25, '2022-07-22', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(5, 1, '2022-07-22', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(6, 1, '2022-07-22', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(7, 1, '2022-07-22', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(8, 1, '2022-07-22', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(9, 1, '2022-07-22', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(10, 1, '2022-07-22', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(11, 1, '2022-07-22', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(12, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(13, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(14, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(15, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(16, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(17, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(18, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(19, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(20, 1, '2022-07-25', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(21, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(22, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(23, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(24, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(25, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(26, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(27, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(28, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(29, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(30, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(31, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(32, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(33, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(34, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(35, 1, '2022-07-25', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(36, 25, '2022-07-25', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(37, 1, '2022-07-25', NULL, NULL, NULL, 'milo', NULL, NULL, 'inactivo'),
(38, 1, '2022-07-26', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(39, 1, '2022-07-26', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(40, 1, '2022-07-26', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(41, 1, '2022-07-26', NULL, NULL, NULL, 'empa', NULL, NULL, 'inactivo'),
(42, 1, '2022-07-26', NULL, NULL, NULL, 'milo', NULL, NULL, 'inactivo'),
(43, 1, '2022-07-26', NULL, NULL, NULL, 'aura', NULL, NULL, 'inactivo'),
(44, 1, '2022-07-26', NULL, NULL, NULL, 'Bimbo', NULL, NULL, 'inactivo'),
(45, 1, '2022-07-26', NULL, NULL, NULL, 'san juan', NULL, NULL, 'inactivo'),
(46, 1, '2022-07-26', NULL, NULL, NULL, 'san juan', NULL, NULL, 'inactivo'),
(47, 1, '2022-07-26', '2022-08-01', NULL, NULL, 'panca', NULL, NULL, 'inactivo'),
(48, NULL, '2022-07-26', NULL, NULL, NULL, 'panca', NULL, NULL, 'inactivo'),
(49, NULL, '2022-07-26', NULL, NULL, NULL, 'panca', NULL, NULL, 'inactivo'),
(50, NULL, '2022-07-26', NULL, NULL, NULL, 'panca', NULL, NULL, 'inactivo'),
(51, 1, '2022-07-26', '2022-07-31', NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(52, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(53, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(54, 1, '2022-07-27', NULL, NULL, NULL, 'panca', NULL, NULL, 'inactivo'),
(55, 1, '2022-07-27', NULL, NULL, NULL, 'panca', NULL, NULL, 'inactivo'),
(56, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(57, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(58, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(59, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(60, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(61, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(62, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(63, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(64, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(65, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(66, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(67, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(68, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(69, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(70, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(71, 1, '0000-00-00', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(72, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(73, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(74, 1, '0000-00-00', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(75, 1, '2022-07-27', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(76, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(77, 1, '2022-07-27', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(78, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(79, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(80, 1, '2022-07-27', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(81, 1, '2022-07-27', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(82, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(83, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(84, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(85, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(86, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(87, 1, '2022-07-27', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(88, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(89, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(90, 1, '2022-07-27', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(91, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(92, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(93, 1, '2022-07-27', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(94, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(95, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(96, 1, '2022-07-27', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(97, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(98, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(99, 1, '2022-07-27', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(100, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(101, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(102, 1, '2022-07-27', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(103, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(104, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(105, 1, '2022-07-27', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(106, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(107, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(108, 1, '2022-07-27', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(109, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(110, 1, '2022-07-27', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(111, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(112, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(113, 1, '2022-07-27', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(114, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(115, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(116, 1, '2022-07-27', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(117, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(118, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(119, 1, '2022-07-27', NULL, NULL, NULL, '', NULL, NULL, 'inactivo'),
(120, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(121, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(122, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(123, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(124, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(125, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(126, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(127, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(128, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(129, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(130, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(131, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(132, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(133, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(134, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(135, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(136, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(137, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(138, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(139, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(140, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(141, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(142, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(143, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(144, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(145, 1, '2022-07-27', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(146, 1, '2022-07-27', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(147, 1, '2022-07-27', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(148, 1, '2022-07-27', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(149, 1, '2022-07-27', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(150, 1, '2022-07-27', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(151, 1, '2022-07-27', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(152, 1, '2022-07-27', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(153, 1, '2022-07-27', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(154, 1, '2022-07-27', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(155, 1, '2022-07-27', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(156, 1, '2022-07-27', NULL, NULL, NULL, 'san juan', NULL, NULL, 'inactivo'),
(157, 1, '2022-07-27', NULL, NULL, NULL, 'panca', NULL, NULL, 'inactivo'),
(158, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(159, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(160, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(161, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(162, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(163, 1, '2022-07-27', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(164, 1, '2022-07-27', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(165, 1, '2022-07-27', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(166, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(167, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(168, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(169, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(170, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(171, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(172, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(173, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(174, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(175, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(176, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(177, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(178, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(179, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(180, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(181, 1, '2022-07-27', NULL, NULL, NULL, 'panca', NULL, NULL, 'inactivo'),
(182, 1, '2022-07-27', NULL, NULL, NULL, 'san juan', NULL, NULL, 'inactivo'),
(183, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(184, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(185, 1, '2022-07-27', NULL, NULL, NULL, 'san juan', NULL, NULL, 'inactivo'),
(186, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(187, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(188, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(189, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(190, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(191, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(192, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(193, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(194, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(195, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(196, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(197, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(198, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(199, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(200, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(201, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(202, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(203, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(204, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(205, 1, '2022-07-27', '2022-07-31', NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(206, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(207, 1, '2022-07-27', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(208, 1, '2022-08-22', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(209, 1, '2022-08-22', NULL, NULL, NULL, '', NULL, NULL, 'activo'),
(210, 1, '2022-09-05', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(211, 1, '2022-09-05', NULL, NULL, NULL, 'san juan', NULL, NULL, 'activo'),
(212, 1, '2022-09-05', '2022-09-05', NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(213, 1, '2022-09-05', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(214, 1, '2022-09-05', '2022-09-06', NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(215, 1, '2022-09-05', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(216, 25, '2022-09-05', NULL, NULL, NULL, '', NULL, NULL, 'activo'),
(217, 1, '2022-09-05', NULL, NULL, NULL, 'panca', NULL, NULL, 'activo'),
(218, 1, '2022-09-05', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(219, 1, '2022-09-07', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(220, 1, '2022-09-09', NULL, NULL, NULL, 'nuevoproveedor', NULL, NULL, 'inactivo'),
(221, 1, '2022-09-09', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(222, 1, '2022-09-09', NULL, NULL, NULL, 'nuevoproveedor', NULL, NULL, 'activo'),
(223, 1, '2022-09-09', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(224, 1, '2022-09-09', NULL, NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(225, 1, '2022-09-09', '2022-09-20', NULL, NULL, 'natipan', NULL, NULL, 'inactivo'),
(226, 1, '2022-09-09', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'inactivo'),
(227, 1, '2022-09-15', NULL, NULL, NULL, 'cocacola', NULL, NULL, 'activo'),
(228, 1, '2022-09-15', '2022-09-29', NULL, NULL, 'natipan', NULL, NULL, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `id_ubi` int(11) NOT NULL,
  `ubicacion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`id_ubi`, `ubicacion`, `estado`) VALUES
(1, 'urbano', 'activo'),
(2, 'Sopetran', 'activo'),
(3, 'san francisco', 'activo'),
(4, NULL, 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `id_vehiculo` int(11) NOT NULL,
  `placa` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_soat` date DEFAULT NULL,
  `fecha_tecn` date DEFAULT NULL,
  `kilometraje` int(11) DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`id_vehiculo`, `placa`, `tipo`, `fecha_soat`, `fecha_tecn`, `kilometraje`, `estado`) VALUES
(1, 'ABC-12A', 'moto', '2021-09-15', '2021-12-30', 1000, 'activo'),
(2, 'XYZ-12A', 'moto', '2022-06-02', '2021-09-17', 0, 'activo'),
(3, '', '', '2022-07-14', '2022-07-14', 0, ''),
(4, '', '', '2022-07-14', '2022-07-14', 0, ''),
(5, '', '', '2022-07-14', '2022-07-14', 0, ''),
(6, '', '', '2022-07-14', '2022-07-14', 0, ''),
(7, '', '', '2022-07-14', '2022-07-14', 0, ''),
(8, '', '', '2022-07-14', '2022-07-14', 0, ''),
(9, '', '', '2022-07-14', '2022-07-14', 25000, ''),
(10, '', '', '2022-08-19', '2022-08-19', 0, ''),
(11, 'ASB-123', 'Turbo', '2022-01-01', '2022-09-09', 25000, 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_ubi` (`id_ubi1`);

--
-- Indices de la tabla `control`
--
ALTER TABLE `control`
  ADD PRIMARY KEY (`id_control`),
  ADD KEY `id_pers4` (`id_pers4`);

--
-- Indices de la tabla `cuadre_caja`
--
ALTER TABLE `cuadre_caja`
  ADD PRIMARY KEY (`id_cuadre_caja`);

--
-- Indices de la tabla `cuenta_cobro`
--
ALTER TABLE `cuenta_cobro`
  ADD PRIMARY KEY (`id_cuenta`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_producto1` (`id_producto1`),
  ADD KEY `id_facturacion1` (`id_facturacion1`);

--
-- Indices de la tabla `detalle_sugerido`
--
ALTER TABLE `detalle_sugerido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_sugerido1` (`id_sugerido1`),
  ADD KEY `id_producto2` (`id_producto2`);

--
-- Indices de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD PRIMARY KEY (`id_domi`),
  ADD KEY `id_pers` (`id_pers3`),
  ADD KEY `id_vehiculo` (`id_vehiculo2`),
  ADD KEY `id_cliente` (`id_cliente2`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_facturacion`),
  ADD KEY `id_cliente3` (`id_cliente3`),
  ADD KEY `id_pers1` (`id_pers1`) USING BTREE;

--
-- Indices de la tabla `factura_abono`
--
ALTER TABLE `factura_abono`
  ADD PRIMARY KEY (`id_factura_abono`),
  ADD KEY `id_cliente1` (`id_cliente1`);

--
-- Indices de la tabla `gasto`
--
ALTER TABLE `gasto`
  ADD PRIMARY KEY (`id_gasto`);

--
-- Indices de la tabla `gas_detalle`
--
ALTER TABLE `gas_detalle`
  ADD PRIMARY KEY (`id_gasto_de`),
  ADD KEY `id_gasto1` (`id_gasto1`);

--
-- Indices de la tabla `kilometraje`
--
ALTER TABLE `kilometraje`
  ADD PRIMARY KEY (`id_kilometraje`),
  ADD KEY `id_vehiculo3` (`id_vehiculo3`);

--
-- Indices de la tabla `observacion`
--
ALTER TABLE `observacion`
  ADD PRIMARY KEY (`id_obs`),
  ADD KEY `id_vehiculo1` (`id_vehiculo1`);

--
-- Indices de la tabla `pagos_caja`
--
ALTER TABLE `pagos_caja`
  ADD PRIMARY KEY (`id_pagos_caja`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id_pers`),
  ADD KEY `cargo` (`cargo`);

--
-- Indices de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  ADD PRIMARY KEY (`id_presu`);

--
-- Indices de la tabla `pre_detalle`
--
ALTER TABLE `pre_detalle`
  ADD PRIMARY KEY (`id_presu_de`),
  ADD KEY `id_presu1` (`id_presu1`),
  ADD KEY `id_pers4` (`id_pers4`);

--
-- Indices de la tabla `pre_detalle_cat`
--
ALTER TABLE `pre_detalle_cat`
  ADD PRIMARY KEY (`id_pre_detalle_cat`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_proveedor1` (`id_proveedor1`) USING BTREE,
  ADD KEY `id_cat` (`id_cat1`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `requerimiento`
--
ALTER TABLE `requerimiento`
  ADD PRIMARY KEY (`id_reque`),
  ADD KEY `id_pers5` (`id_pers5`);

--
-- Indices de la tabla `ro_detalles`
--
ALTER TABLE `ro_detalles`
  ADD PRIMARY KEY (`id_ro_de`),
  ADD KEY `id_ro1` (`id_ro1`) USING BTREE;

--
-- Indices de la tabla `r_operativos`
--
ALTER TABLE `r_operativos`
  ADD PRIMARY KEY (`id_ro`);

--
-- Indices de la tabla `sugerido`
--
ALTER TABLE `sugerido`
  ADD PRIMARY KEY (`id_sugerido`),
  ADD KEY `id_pers2` (`id_pers2`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`id_ubi`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`id_vehiculo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `control`
--
ALTER TABLE `control`
  MODIFY `id_control` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cuadre_caja`
--
ALTER TABLE `cuadre_caja`
  MODIFY `id_cuadre_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `cuenta_cobro`
--
ALTER TABLE `cuenta_cobro`
  MODIFY `id_cuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `detalle_sugerido`
--
ALTER TABLE `detalle_sugerido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=602;

--
-- AUTO_INCREMENT de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  MODIFY `id_domi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_facturacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `factura_abono`
--
ALTER TABLE `factura_abono`
  MODIFY `id_factura_abono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `gasto`
--
ALTER TABLE `gasto`
  MODIFY `id_gasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `gas_detalle`
--
ALTER TABLE `gas_detalle`
  MODIFY `id_gasto_de` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `kilometraje`
--
ALTER TABLE `kilometraje`
  MODIFY `id_kilometraje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `observacion`
--
ALTER TABLE `observacion`
  MODIFY `id_obs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pagos_caja`
--
ALTER TABLE `pagos_caja`
  MODIFY `id_pagos_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id_pers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  MODIFY `id_presu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pre_detalle`
--
ALTER TABLE `pre_detalle`
  MODIFY `id_presu_de` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de la tabla `pre_detalle_cat`
--
ALTER TABLE `pre_detalle_cat`
  MODIFY `id_pre_detalle_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `requerimiento`
--
ALTER TABLE `requerimiento`
  MODIFY `id_reque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ro_detalles`
--
ALTER TABLE `ro_detalles`
  MODIFY `id_ro_de` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `r_operativos`
--
ALTER TABLE `r_operativos`
  MODIFY `id_ro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sugerido`
--
ALTER TABLE `sugerido`
  MODIFY `id_sugerido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `id_ubi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_ubi1`) REFERENCES `ubicacion` (`id_ubi`);

--
-- Filtros para la tabla `control`
--
ALTER TABLE `control`
  ADD CONSTRAINT `control_ibfk_1` FOREIGN KEY (`id_pers4`) REFERENCES `personal` (`id_pers`);

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`id_producto1`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`id_facturacion1`) REFERENCES `factura` (`id_facturacion`);

--
-- Filtros para la tabla `detalle_sugerido`
--
ALTER TABLE `detalle_sugerido`
  ADD CONSTRAINT `detalle_sugerido_ibfk_1` FOREIGN KEY (`id_producto2`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `detalle_sugerido_ibfk_2` FOREIGN KEY (`id_sugerido1`) REFERENCES `sugerido` (`id_sugerido`);

--
-- Filtros para la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD CONSTRAINT `domicilio_ibfk_1` FOREIGN KEY (`id_pers3`) REFERENCES `personal` (`id_pers`),
  ADD CONSTRAINT `domicilio_ibfk_2` FOREIGN KEY (`id_vehiculo2`) REFERENCES `vehiculo` (`id_vehiculo`),
  ADD CONSTRAINT `domicilio_ibfk_3` FOREIGN KEY (`id_cliente2`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_pers1`) REFERENCES `personal` (`id_pers`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`id_cliente3`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `factura_abono`
--
ALTER TABLE `factura_abono`
  ADD CONSTRAINT `factura_abono_ibfk_1` FOREIGN KEY (`id_cliente1`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `gas_detalle`
--
ALTER TABLE `gas_detalle`
  ADD CONSTRAINT `gas_detalle_ibfk_1` FOREIGN KEY (`id_gasto1`) REFERENCES `gasto` (`id_gasto`);

--
-- Filtros para la tabla `kilometraje`
--
ALTER TABLE `kilometraje`
  ADD CONSTRAINT `kilometraje_ibfk_1` FOREIGN KEY (`id_vehiculo3`) REFERENCES `vehiculo` (`id_vehiculo`);

--
-- Filtros para la tabla `observacion`
--
ALTER TABLE `observacion`
  ADD CONSTRAINT `observacion_ibfk_1` FOREIGN KEY (`id_vehiculo1`) REFERENCES `vehiculo` (`id_vehiculo`);

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`cargo`) REFERENCES `cargo` (`id_cargo`);

--
-- Filtros para la tabla `pre_detalle`
--
ALTER TABLE `pre_detalle`
  ADD CONSTRAINT `pre_detalle_ibfk_1` FOREIGN KEY (`id_presu1`) REFERENCES `presupuesto` (`id_presu`),
  ADD CONSTRAINT `pre_detalle_ibfk_2` FOREIGN KEY (`id_pers4`) REFERENCES `personal` (`id_pers`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_proveedor1`) REFERENCES `proveedor` (`id_proveedor`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_cat1`) REFERENCES `categoria` (`id_cat`);

--
-- Filtros para la tabla `requerimiento`
--
ALTER TABLE `requerimiento`
  ADD CONSTRAINT `requerimiento_ibfk_1` FOREIGN KEY (`id_pers5`) REFERENCES `personal` (`id_pers`);

--
-- Filtros para la tabla `ro_detalles`
--
ALTER TABLE `ro_detalles`
  ADD CONSTRAINT `ro_detalles_ibfk_1` FOREIGN KEY (`id_ro1`) REFERENCES `r_operativos` (`id_ro`);

--
-- Filtros para la tabla `sugerido`
--
ALTER TABLE `sugerido`
  ADD CONSTRAINT `sugerido_ibfk_1` FOREIGN KEY (`id_pers2`) REFERENCES `personal` (`id_pers`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
