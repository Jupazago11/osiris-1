-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-07-2022 a las 01:25:11
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
(9, 'camionero', 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_cat` int(11) NOT NULL,
  `categorias` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_cat`, `categorias`, `estado`) VALUES
(1, 'carnes', 'activo');

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
(1, 1, 'Juanito V.', 123456, 'carrera 1 #12-12', '123456789', 'activo'),
(2, 2, 'Jaime R.', 1234567, 'sopetran', '3154975645', 'activo'),
(3, 3, 'Juanita F.', 12345678, 'san francisco', '54515454', 'activo'),
(5, 3, 'anónimo', NULL, 'anonima', 'anonima', 'activo'),
(6, NULL, 'jacinto', NULL, NULL, NULL, 'activo'),
(7, NULL, 'juana', NULL, NULL, NULL, 'activo'),
(8, NULL, 'carmen', NULL, NULL, NULL, 'activo'),
(9, NULL, 'pacho', NULL, NULL, NULL, 'activo'),
(10, NULL, 'jairo', NULL, NULL, NULL, 'activo'),
(11, NULL, 'Jaime R.h', NULL, NULL, NULL, 'activo');

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
(1, 'prove', 1000000, 'ss', '2022-07-03', '2022-07-09 11:56:52', 25, 'activo'),
(2, 'prove', 200000, '5A45SDAS4D5AS', '2022-07-04', '2022-07-05 16:13:29', 10, 'inactivo'),
(3, 'prove', 300000, '', '2022-07-05', '2022-07-06 12:25:02', 25, 'activo'),
(4, 'prove', 4000000, 'ABC123', '2022-07-03', '2022-07-06 00:00:00', 20, 'inactivo'),
(5, 'prove', 450000, NULL, '2022-07-05', '2022-07-06 12:25:02', 25, ''),
(6, 'cocacola', 50000, NULL, '2022-07-05', '2022-07-05 16:13:25', 30, 'inactivo'),
(7, 'cocacola', 2000, 'jp11', '2022-07-05', '2022-07-06 12:26:52', 10, 'inactivo'),
(8, 'nuevo', 200000, 'kk', '2022-07-05', '2022-07-09 11:56:52', 10, ''),
(9, 'cocacola', 50000, 'kl521', '2022-07-06', '2022-07-19 19:09:54', 19, 'inactivo'),
(10, 'Bimbo', 100000, 'ABC132', '2022-07-08', NULL, 20, 'activo'),
(11, '', 0, '', '2022-07-08', '2022-07-08 17:56:32', 0, ''),
(12, NULL, 0, NULL, '2022-07-08', NULL, 0, ''),
(13, NULL, 0, NULL, '2022-07-08', NULL, 0, ''),
(14, 'coca cola', 1000000, '', '2022-07-10', NULL, 20, ''),
(15, '', 0, 'jj', '2022-07-08', '2022-07-11 15:17:17', 0, ''),
(16, '', 0, 'aa', '2022-07-09', '2022-07-11 15:17:01', 1, ''),
(17, '', 0, '', '2022-07-11', NULL, 0, ''),
(18, '', 0, '', '2022-07-11', NULL, 0, ''),
(19, 'auralac', 0, '', '2022-07-11', NULL, 25, 'activo'),
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
(34, '', 0, '', '2022-07-11', NULL, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `id_detalle` int(11) NOT NULL,
  `id_facturacion1` int(11) NOT NULL,
  `id_producto1` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_detalle` int(11) NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  `precio_total_sugerido` int(11) DEFAULT NULL,
  `precio_total_pedido` int(11) DEFAULT NULL,
  `precio_total_llegada` int(11) DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_sugerido`
--

INSERT INTO `detalle_sugerido` (`id_detalle`, `id_sugerido1`, `id_producto2`, `cantidad_sugerido`, `inventario_sugerido`, `pedido_sugerido`, `pedido_recibido`, `precio_sugerido`, `precio_total_sugerido`, `precio_total_pedido`, `precio_total_llegada`, `estado`) VALUES
(1, 2, 1, 10, 5, NULL, NULL, 500, 5000, NULL, NULL, 'activo');

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
  `tiempo_salida` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tiempo_llegada` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `domicilio`
--

INSERT INTO `domicilio` (`id_domi`, `id_pers3`, `id_cliente2`, `id_vehiculo2`, `fecha`, `observacion`, `nivel_urgencia`, `ubicacion`, `destino`, `tiempo_salida`, `tiempo_llegada`, `estado`) VALUES
(1, 1, 1, 1, '2022-06-29', 'ninguna', 'normal', 'urbano', 'parque', '12:05', '12:05', 'inactivo'),
(2, 1, 2, 1, '2022-06-28', 'al final del recorrido', 'Prioritario', 'Sopetran', 'ramada', NULL, NULL, 'activo'),
(3, 1, 3, 1, '2022-06-29', 'delicado', 'normal', 'san francisco', 'carrera 20 #50-50', '15:57', NULL, 'proceso'),
(4, 1, 2, 1, '2022-06-29', 'despues de la escuela de manizales', 'Prioritario', 'san francisco', 'por la fabrica de agua', '12:07', '12:07', 'inactivo'),
(5, 1, 1, 1, '2022-06-28', 'nada', 'normal', 'urbano', 'la casa', NULL, NULL, 'activo'),
(6, 1, 2, 1, '2022-06-29', 'nada', 'Prioritario', 'urbano', 'mi casa', NULL, NULL, 'activo'),
(8, 1, 1, 1, '2022-06-29', 'werqwerqwerqwer', 'normal', 'urbano', 'fasdfasd', '12:06', '12:06', 'inactivo'),
(9, 3, 1, 1, '2022-06-29', 'nada', 'normal', 'san francisco', 'vereda', NULL, NULL, 'activo'),
(10, 3, 5, 1, '2022-06-29', 'villa jardin', 'normal', 'villa jardin', 'jardin', '12:19', '12:24', 'inactivo'),
(11, 3, 7, 1, '2022-06-29', 'ninguna', 'normal', 'urbano', 'hogar', '15:52', '15:52', 'inactivo'),
(12, 3, 10, 1, '2022-06-29', 'ninguna', 'normal', 'urbano', 'su casa', NULL, NULL, 'activo'),
(13, 3, 11, 1, '2022-07-01', 'hfghfg', 'carnes', 'hfghfgh', 'gfhfgh', '16:12', '16:12', 'inactivo'),
(14, 1, 2, 1, '2022-07-11', '123', '', 'urbano', 'su casa', '16:08', '16:08', 'inactivo'),
(15, 1, 1, 1, '2022-07-14', 'kjkhjkhjk', 'carnes', 'urbano', 'khkhjkj', '12:02', '12:02', 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_facturacion` int(11) NOT NULL,
  `name_cliente` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `id_pers1` int(11) NOT NULL,
  `precio_total` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(1, 1, 'combustible', 10000, '2022-07-14', 'activo');

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
(1, 'juan pablo zapata gómez', '1037977046', '3135721225', 'juan@gmail.com', 'jupazago', '159875321', 1, '1998-03-06', '2022-01-01', 12, '2022-07-13', 1, 1000000, 'savia', 'sura', 'comfama', 'porvenir', 'activo'),
(2, 'Domiciliario', '1', '123', 'domi@gmail.com', 'domi', 'domi', 4, '2004-06-01', '2022-06-02', 12, '2022-07-13', 4, 500000, 'sura', 'sura', '', 'proteccion', 'activo'),
(3, 'empleado prueba', '', '456', 'emp_1@hotmail.com', 'empleado', '1234', 2, '1990-07-21', '2022-01-01', 12, '2022-07-14', 2, 0, '', '', '', '', 'activo'),
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
(25, '', '', '', '', '', '', 0, '1992-07-14', '2022-07-14', NULL, '2022-07-14', 3, NULL, '', '', '', '', '');

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
(6, 1, 2023);

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
(98, 1, '', 0, NULL, '', 1, '');

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
(6, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL,
  `id_cat1` int(11) NOT NULL,
  `nombre_producto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `precio_producto` int(11) NOT NULL,
  `precio_producto2` int(11) NOT NULL,
  `precio_de_compra` int(11) NOT NULL,
  `existencias` int(11) NOT NULL,
  `id_proveedor1` int(11) NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `cod_producto`, `id_cat1`, `nombre_producto`, `descripcion`, `precio_producto`, `precio_producto2`, `precio_de_compra`, `existencias`, `id_proveedor1`, `estado`) VALUES
(1, 123456, 1, 'botella 300ml', 'botella personal', 500, 400, 1500, 10, 36, 'activo');

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
(10, 'aura', 'aura123', 'aura', 'fsdfsdf', 'ffffffffff', 'fffffffffffffffffff', 'ffffffffffffffff', 'activo'),
(11, 'aura', NULL, NULL, 'medellin', '123456', 'jaime', '32123121', ''),
(12, 'milo', 'milos', 'milo', 'dhghdhg', '', '', '', 'activo'),
(13, 'milo', NULL, NULL, 'medellin', '123456', 'jaime', '32123121', ''),
(14, 'nutresa', NULL, NULL, 'medellin', '123456', 'jaime salazar', '32123121', ''),
(15, 'nutresa', NULL, NULL, 'medellin', '123456', 'jaime salazar', '32123121', ''),
(16, 'prueba', NULL, NULL, '123456', '00000000', '123456', '123456', ''),
(17, 'prueba', NULL, NULL, '123456', '00000000', '123456', '123456', ''),
(18, 'prueba2', NULL, NULL, 'san luis', '123456', 'carlos', '132456', ''),
(19, 'prueba2', NULL, NULL, 'san luis', '123456', 'carlos', '132456', ''),
(20, 'empa', 'empa', 'empa', 'sdfsdf', '', '', '', 'activo'),
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
(36, 'cocacola', 'cocacola', 'cocacola', '', '', '', '', ''),
(37, 'probando', NULL, NULL, 'ggggggggggggg', '0000', 'ggggggggggggg', 'ggggggg', ''),
(38, 'probando 40', NULL, NULL, 'fffffff', '00000000', 'ffffffffffffffffffff', 'ffffffffffffffffffffff', ''),
(39, 'Bimbo', 'Bimbo', 'Bimbo', '', '', '', '', 'activo'),
(40, 'auralac', 'auralac', 'auralac', '', '', '', '', ''),
(41, '', NULL, NULL, '', '', '', '', ''),
(42, 'cocacola', NULL, NULL, NULL, NULL, NULL, NULL, 'activo'),
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
(63, '', NULL, NULL, '', '', '', '', '');

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
  `tarjeta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ro_detalles`
--

INSERT INTO `ro_detalles` (`id_ro_de`, `id_ro1`, `mes`, `inventario`, `ventas`, `g_operacion`, `margen`, `dividendo`, `cxpagar`, `credito`, `efectivo`, `tarjeta`) VALUES
(1, 1, 1, 100000000, 750000000, 35000000, '9.80', 10000000, 120000000, 80000000, 100000000, 85000000),
(4, 1, 2, 500000000, 800000000, 37000000, '10.20', 45000000, 130000000, 75000000, 80000000, 75000000),
(5, 1, 3, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(6, 1, 4, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(7, 1, 5, 360000000, 0, 0, '0.00', 0, 0, 0, 0, 0),
(8, 1, 6, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(9, 1, 7, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(10, 1, 8, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(11, 1, 9, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(12, 1, 10, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(13, 1, 11, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(14, 1, 12, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(15, 2, 1, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(16, 2, 2, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(17, 2, 3, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(18, 2, 4, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(19, 2, 5, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(20, 2, 6, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(21, 2, 7, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(22, 2, 8, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(23, 2, 9, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(24, 2, 10, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(25, 2, 11, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(26, 2, 12, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(27, 3, 1, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(28, 3, 2, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(29, 3, 3, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(30, 3, 4, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(31, 3, 5, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(32, 3, 6, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(33, 3, 7, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(34, 3, 8, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(35, 3, 9, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(36, 3, 10, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(37, 3, 11, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(38, 3, 12, 0, 0, 0, '0.00', 0, 0, 0, 0, 0),
(39, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 4, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 4, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 4, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 4, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 4, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 4, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 4, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 5, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 5, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 5, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 5, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 5, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 5, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 6, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 6, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 6, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 6, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 6, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 6, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 6, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 6, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  `id_pers2` int(11) NOT NULL,
  `fecha_sugerido` date NOT NULL,
  `pedido_proxima_sugerido` date DEFAULT NULL,
  `pedido_llegada` date DEFAULT NULL,
  `pedido_fecha_factura` date DEFAULT NULL,
  `nombre_provedor_sugerido` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_empleado_provedor_sug` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_empleado_provedor_sug2` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `total_global_sugerido` int(11) DEFAULT NULL,
  `total_global_pedido` int(11) DEFAULT NULL,
  `total_global_confirmado` int(11) DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sugerido`
--

INSERT INTO `sugerido` (`id_sugerido`, `id_pers2`, `fecha_sugerido`, `pedido_proxima_sugerido`, `pedido_llegada`, `pedido_fecha_factura`, `nombre_provedor_sugerido`, `nombre_empleado_provedor_sug`, `nombre_empleado_provedor_sug2`, `total_global_sugerido`, `total_global_pedido`, `total_global_confirmado`, `estado`) VALUES
(1, 1, '2022-07-10', NULL, NULL, NULL, 'cocacola', NULL, NULL, NULL, NULL, NULL, 'activo'),
(2, 1, '2022-07-22', NULL, NULL, NULL, 'cocacola', NULL, NULL, NULL, NULL, NULL, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `id_ubi` int(11) NOT NULL,
  `ubicacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`id_ubi`, `ubicacion`, `estado`) VALUES
(1, 'urbano', 'activo'),
(2, 'Sopetran', 'activo'),
(3, 'san francisco', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `id_vehiculo` int(11) NOT NULL,
  `tipo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `placa` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_soat` date DEFAULT NULL,
  `fecha_tecn` date DEFAULT NULL,
  `kilometraje` int(11) DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`id_vehiculo`, `tipo`, `placa`, `fecha_soat`, `fecha_tecn`, `kilometraje`, `estado`) VALUES
(1, 'moto', 'ABC-12A', '2022-07-13', '2021-09-30', 1000, 'activo'),
(2, 'moto', 'XYZ-12A', '2022-06-02', '2022-06-02', 0, 'activo'),
(3, '', '', '2022-07-14', '2022-07-14', 0, ''),
(4, '', '', '2022-07-14', '2022-07-14', 0, ''),
(5, '', '', '2022-07-14', '2022-07-14', 0, ''),
(6, '', '', '2022-07-14', '2022-07-14', 0, ''),
(7, '', '', '2022-07-14', '2022-07-14', 0, ''),
(8, '', '', '2022-07-14', '2022-07-14', 0, ''),
(9, '', '', '2022-07-14', '2022-07-14', 25000, '');

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
  ADD UNIQUE KEY `id_pers1` (`id_pers1`);

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
-- Indices de la tabla `observacion`
--
ALTER TABLE `observacion`
  ADD PRIMARY KEY (`id_obs`),
  ADD KEY `id_vehiculo1` (`id_vehiculo1`);

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
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cuenta_cobro`
--
ALTER TABLE `cuenta_cobro`
  MODIFY `id_cuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_sugerido`
--
ALTER TABLE `detalle_sugerido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  MODIFY `id_domi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_facturacion` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT de la tabla `observacion`
--
ALTER TABLE `observacion`
  MODIFY `id_obs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id_pers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  MODIFY `id_presu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pre_detalle`
--
ALTER TABLE `pre_detalle`
  MODIFY `id_presu_de` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `pre_detalle_cat`
--
ALTER TABLE `pre_detalle_cat`
  MODIFY `id_pre_detalle_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

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
  MODIFY `id_sugerido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `id_ubi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_ubi1`) REFERENCES `ubicacion` (`id_ubi`);

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
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_pers1`) REFERENCES `personal` (`id_pers`);

--
-- Filtros para la tabla `gas_detalle`
--
ALTER TABLE `gas_detalle`
  ADD CONSTRAINT `gas_detalle_ibfk_1` FOREIGN KEY (`id_gasto1`) REFERENCES `gasto` (`id_gasto`);

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
