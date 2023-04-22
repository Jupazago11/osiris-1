-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-04-2023 a las 20:27:50
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
(2, 'Empleado Entendido', ''),
(3, 'Empleado', ''),
(4, 'Domiciliario', ''),
(5, 'Proveedor oficina', ''),
(6, 'Proveedor', ''),
(7, '', ''),
(8, '', ''),
(9, '', ''),
(10, '', ''),
(11, 'Auxiliar administrativa', ''),
(12, '', ''),
(13, '', ''),
(14, '', ''),
(15, '', ''),
(16, '', ''),
(17, '', ''),
(18, '', ''),
(19, '', ''),
(20, '', ''),
(21, '', ''),
(22, '', ''),
(23, '', ''),
(24, '', ''),
(25, '', ''),
(26, 'Desarrollador', ''),
(27, '', ''),
(28, '', ''),
(29, 'Cajera Lider', ''),
(30, 'Cajera', ''),
(31, 'Carnicero', ''),
(32, 'Empleado', ''),
(33, '', ''),
(34, '', ''),
(35, '', ''),
(36, '', ''),
(37, '', ''),
(38, '', ''),
(39, '', ''),
(40, '', ''),
(41, '', ''),
(42, '', ''),
(43, '', ''),
(44, 'Desarrollador', 'activo'),
(45, 'Auxiliar administrativo', 'activo'),
(46, 'Domiciliario', 'activo');

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
(2, 'aseo', ''),
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
(13, 'pan', ''),
(14, 'Lacteos', 'activo');

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
(15, 'base 3', 20000, 'activo');

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
(44, '', 0, '', '2023-04-21', NULL, 0, 'activo');

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
(30, NULL, '2023-04-21 12:04:41', NULL, NULL, 1, NULL, NULL, 'activo');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas`
--

CREATE TABLE `fechas` (
  `id_fecha` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `fechas`
--

INSERT INTO `fechas` (`id_fecha`, `mes`, `year`) VALUES
(1, 4, 2023),
(2, 3, 2023),
(3, 2, 2023),
(4, 5, 2023),
(5, 6, 2023),
(6, 7, 2023),
(7, 8, 2023),
(8, 9, 2023),
(9, 4, 2022),
(10, 1, 2022),
(11, 2, 2022),
(12, 3, 2022),
(13, 5, 2022),
(14, 1, 2023),
(15, 12, 2023),
(16, 11, 2023),
(17, 10, 2023),
(18, 4, 2021);

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
(1, 13, '', 10000, '2022-07-14', 'activo');

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
(1, 'Juan Pablo Zapata Gómez', '1037977046', '3135721225', 'jupazago11@gmail.com', 'jupazago', '159875321', 1, '1998-03-06', '2022-11-23', 12, '2022-07-13', 44, 1160000, 'Savia', '', '', '', 'activo'),
(105, '', NULL, '', '', '1', '1', 2, '2023-04-21', '2023-04-21', 12, '2023-04-21', 3, NULL, NULL, NULL, NULL, NULL, '');

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
(20, 4, 2023),
(21, 5, 2023);

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
(133, 20, NULL, NULL, NULL, NULL, 1, 'activo'),
(134, 21, '', 0, NULL, '', 1, 'activo');

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
(8, 'seguridad social', 'activo'),
(9, 'gastos emergencia', 'activo');

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
(36, 'Nombre', 'cocacola', 'cocacola', '', '', '', '', 'activo'),
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
(64, '', 'san juan', 'san juan', 'medellin', '', '', '', ''),
(65, '', 'panca', 'panca', '', '', '', '', ''),
(66, '', NULL, NULL, '', '', '', '', ''),
(67, '', 'natipan', 'natipan', 'medellin', '', '', '', ''),
(68, '', NULL, NULL, '', '', '', '', ''),
(69, '', NULL, NULL, '', '', '', '', ''),
(70, '', NULL, NULL, '', '', '', '', ''),
(71, '', 'proveedor', 'proveedor', 'san luis carrera', '834 123132', 'caliche', '2132465', ''),
(72, '', NULL, NULL, '', '', '', '', ''),
(73, '', NULL, NULL, '', '', '', '', ''),
(74, '', NULL, NULL, '', '', '', '', ''),
(75, '', NULL, NULL, '', '', '', '', ''),
(76, '', NULL, NULL, '', '', '', '', ''),
(77, '', NULL, NULL, '', '', '', '', ''),
(78, '', NULL, NULL, '', '', '', '', ''),
(79, '', NULL, NULL, '', '', '', '', '');

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
(18, 1, '', 0, 'activo', '2023-04-21');

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
  `inversion` int(11) DEFAULT NULL,
  `comentario_inversion` text COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ro_detalles`
--

INSERT INTO `ro_detalles` (`id_ro_de`, `id_ro1`, `mes`, `inventario`, `ventas`, `g_operacion`, `margen`, `dividendo`, `cxpagar`, `credito`, `efectivo`, `tarjeta`, `inversion`, `comentario_inversion`) VALUES
(1, 1, 1, 500000000, 50, 0, '0.00', 0, 0, 0, 0, 0, 0, ''),
(4, 1, 2, 0, 50, 0, '0.00', 0, 0, 0, 0, 0, 0, ''),
(5, 1, 3, 0, 50, 0, '0.00', 0, 0, 0, 0, 0, 850000000, ''),
(6, 1, 4, 0, 50, 0, '0.00', 0, 0, 0, 0, 0, 0, ''),
(7, 1, 5, 0, 550000000, 0, '0.00', 0, 0, 0, 0, 0, 0, ''),
(8, 1, 6, 400000000, 500000000, 50000000, '7.00', 0, 0, 0, 0, 0, 0, ''),
(9, 1, 7, 500000000, 800000000, 30000000, '5.00', 50000000, 0, 0, 0, 50000000, 0, ''),
(10, 1, 8, 518189000, 812091312, 33509420, '9.46', 30000000, 390924702, 160495271, 31300000, 65261489, 100000000, ''),
(11, 1, 9, 0, 50, 0, '0.00', 0, 500000000, 200000000, 300000000, 0, 30000000, ''),
(12, 1, 10, 0, 50, 0, '0.00', 0, 0, 0, 0, 0, 120000000, ''),
(13, 1, 11, 0, 50, 0, '0.00', 0, 0, 0, 0, 0, 0, ''),
(14, 1, 12, 0, 50, 0, '0.00', 0, 0, 0, 0, 0, 0, ''),
(15, 2, 1, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL, NULL),
(16, 2, 2, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL, NULL),
(17, 2, 3, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL, NULL),
(18, 2, 4, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL, NULL),
(19, 2, 5, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL, NULL),
(20, 2, 6, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL, NULL),
(21, 2, 7, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL, NULL),
(22, 2, 8, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL, NULL),
(23, 2, 9, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL, NULL),
(24, 2, 10, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL, NULL),
(25, 2, 11, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL, NULL),
(26, 2, 12, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, NULL, NULL),
(27, 3, 1, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, 0, NULL),
(28, 3, 2, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, 0, NULL),
(29, 3, 3, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, 0, NULL),
(30, 3, 4, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, 0, NULL),
(31, 3, 5, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, 0, NULL),
(32, 3, 6, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, 0, NULL),
(33, 3, 7, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, 0, NULL),
(34, 3, 8, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, 0, NULL),
(35, 3, 9, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, 0, NULL),
(36, 3, 10, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, 0, NULL),
(37, 3, 11, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, 0, NULL),
(38, 3, 12, 0, 0, 0, '0.00', 0, 0, 0, 0, 0, 0, NULL),
(39, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 4, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 4, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 4, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 4, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 4, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 4, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 4, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 5, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 5, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 5, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 5, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 5, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 5, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 6, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 6, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 6, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 6, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 6, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 6, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 6, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 6, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 7, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 8, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(6, 2024),
(7, 202),
(8, 2025);

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
(238, 1, '2023-04-21', NULL, NULL, NULL, 'Nombre', NULL, NULL, 'activo');

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
(2, 'Sopetran', 'inactivo'),
(3, 'san francisco', 'inactivo'),
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
(13, 'Placa', 'moto', '2023-10-18', '2020-09-20', 0, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_diarias`
--

CREATE TABLE `ventas_diarias` (
  `id_ven_dia` int(11) NOT NULL,
  `id_fecha1` int(11) NOT NULL,
  `ventas` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas_diarias`
--

INSERT INTO `ventas_diarias` (`id_ven_dia`, `id_fecha1`, `ventas`) VALUES
(1, 1, 0),
(2, 1, 0),
(3, 1, 0),
(4, 1, 0),
(5, 1, 0),
(6, 1, 0),
(7, 1, 0),
(8, 1, 0),
(9, 1, 0),
(10, 1, 0),
(11, 1, 0),
(12, 1, 0),
(13, 1, 0),
(14, 1, 0),
(15, 1, 0),
(16, 1, 0),
(17, 1, 0),
(18, 1, 0),
(19, 1, 0),
(20, 1, 0),
(21, 1, 0),
(22, 1, 0),
(23, 1, 0),
(24, 1, 0),
(25, 1, 0),
(26, 1, 0),
(27, 1, 0),
(28, 1, 0),
(29, 1, 0),
(30, 1, 0),
(31, 2, 0),
(32, 2, 0),
(33, 2, 0),
(34, 2, 0),
(35, 2, 0),
(36, 2, 0),
(37, 2, 0),
(38, 2, 0),
(39, 2, 0),
(40, 2, 0),
(41, 2, 0),
(42, 2, 0),
(43, 2, 0),
(44, 2, 0),
(45, 2, 0),
(46, 2, 0),
(47, 2, 0),
(48, 2, 0),
(49, 2, 0),
(50, 2, 0),
(51, 2, 0),
(52, 2, 0),
(53, 2, 0),
(54, 2, 0),
(55, 2, 0),
(56, 2, 0),
(57, 2, 0),
(58, 2, 0),
(59, 2, 0),
(60, 2, 0),
(61, 2, 0),
(62, 3, 0),
(63, 3, 0),
(64, 3, 0),
(65, 3, 0),
(66, 3, 0),
(67, 3, 0),
(68, 3, 0),
(69, 3, 0),
(70, 3, 0),
(71, 3, 0),
(72, 3, 0),
(73, 3, 0),
(74, 3, 0),
(75, 3, 0),
(76, 3, 0),
(77, 3, 0),
(78, 3, 0),
(79, 3, 0),
(80, 3, 0),
(81, 3, 0),
(82, 3, 0),
(83, 3, 0),
(84, 3, 0),
(85, 3, 0),
(86, 3, 0),
(87, 3, 0),
(88, 3, 0),
(89, 3, 0),
(90, 4, 0),
(91, 4, 0),
(92, 4, 0),
(93, 4, 0),
(94, 4, 0),
(95, 4, 0),
(96, 4, 0),
(97, 4, 0),
(98, 4, 0),
(99, 4, 0),
(100, 4, 0),
(101, 4, 0),
(102, 4, 0),
(103, 4, 0),
(104, 4, 0),
(105, 4, 0),
(106, 4, 0),
(107, 4, 0),
(108, 4, 0),
(109, 4, 0),
(110, 4, 0),
(111, 4, 0),
(112, 4, 0),
(113, 4, 0),
(114, 4, 0),
(115, 4, 0),
(116, 4, 0),
(117, 4, 0),
(118, 4, 0),
(119, 4, 0),
(120, 4, 0),
(121, 5, 0),
(122, 5, 0),
(123, 5, 0),
(124, 5, 0),
(125, 5, 0),
(126, 5, 0),
(127, 5, 0),
(128, 5, 0),
(129, 5, 0),
(130, 5, 0),
(131, 5, 0),
(132, 5, 0),
(133, 5, 0),
(134, 5, 0),
(135, 5, 0),
(136, 5, 0),
(137, 5, 0),
(138, 5, 0),
(139, 5, 0),
(140, 5, 0),
(141, 5, 0),
(142, 5, 0),
(143, 5, 0),
(144, 5, 0),
(145, 5, 0),
(146, 5, 0),
(147, 5, 0),
(148, 5, 0),
(149, 5, 0),
(150, 5, 0),
(151, 6, 0),
(152, 6, 0),
(153, 6, 0),
(154, 6, 0),
(155, 6, 0),
(156, 6, 0),
(157, 6, 0),
(158, 6, 0),
(159, 6, 0),
(160, 6, 0),
(161, 6, 0),
(162, 6, 0),
(163, 6, 0),
(164, 6, 0),
(165, 6, 0),
(166, 6, 0),
(167, 6, 0),
(168, 6, 0),
(169, 6, 0),
(170, 6, 0),
(171, 6, 0),
(172, 6, 0),
(173, 6, 0),
(174, 6, 0),
(175, 6, 0),
(176, 6, 0),
(177, 6, 0),
(178, 6, 0),
(179, 6, 0),
(180, 6, 0),
(181, 6, 0),
(182, 7, 0),
(183, 7, 0),
(184, 7, 0),
(185, 7, 0),
(186, 7, 0),
(187, 7, 0),
(188, 7, 0),
(189, 7, 0),
(190, 7, 0),
(191, 7, 0),
(192, 7, 0),
(193, 7, 0),
(194, 7, 0),
(195, 7, 0),
(196, 7, 0),
(197, 7, 0),
(198, 7, 0),
(199, 7, 0),
(200, 7, 0),
(201, 7, 0),
(202, 7, 0),
(203, 7, 0),
(204, 7, 0),
(205, 7, 0),
(206, 7, 0),
(207, 7, 0),
(208, 7, 0),
(209, 7, 0),
(210, 7, 0),
(211, 7, 0),
(212, 7, 0),
(213, 8, 0),
(214, 8, 0),
(215, 8, 0),
(216, 8, 0),
(217, 8, 0),
(218, 8, 0),
(219, 8, 0),
(220, 8, 0),
(221, 8, 0),
(222, 8, 0),
(223, 8, 0),
(224, 8, 0),
(225, 8, 0),
(226, 8, 0),
(227, 8, 0),
(228, 8, 0),
(229, 8, 0),
(230, 8, 0),
(231, 8, 0),
(232, 8, 0),
(233, 8, 0),
(234, 8, 0),
(235, 8, 0),
(236, 8, 0),
(237, 8, 0),
(238, 8, 0),
(239, 8, 0),
(240, 8, 0),
(241, 8, 0),
(242, 8, 0),
(243, 9, 0),
(244, 9, 0),
(245, 9, 0),
(246, 9, 0),
(247, 9, 0),
(248, 9, 0),
(249, 9, 0),
(250, 9, 0),
(251, 9, 0),
(252, 9, 0),
(253, 9, 0),
(254, 9, 0),
(255, 9, 0),
(256, 9, 0),
(257, 9, 0),
(258, 9, 0),
(259, 9, 0),
(260, 9, 0),
(261, 9, 0),
(262, 9, 0),
(263, 9, 0),
(264, 9, 0),
(265, 9, 0),
(266, 9, 0),
(267, 9, 0),
(268, 9, 0),
(269, 9, 0),
(270, 9, 0),
(271, 9, 0),
(272, 9, 0),
(273, 10, 0),
(274, 10, 0),
(275, 10, 0),
(276, 10, 0),
(277, 10, 0),
(278, 10, 0),
(279, 10, 0),
(280, 10, 0),
(281, 10, 0),
(282, 10, 0),
(283, 10, 0),
(284, 10, 0),
(285, 10, 0),
(286, 10, 0),
(287, 10, 0),
(288, 10, 0),
(289, 10, 0),
(290, 10, 0),
(291, 10, 0),
(292, 10, 0),
(293, 10, 0),
(294, 10, 0),
(295, 10, 0),
(296, 10, 0),
(297, 10, 0),
(298, 10, 0),
(299, 10, 0),
(300, 10, 0),
(301, 10, 0),
(302, 10, 0),
(303, 10, 0),
(304, 11, 0),
(305, 11, 0),
(306, 11, 0),
(307, 11, 0),
(308, 11, 0),
(309, 11, 0),
(310, 11, 0),
(311, 11, 0),
(312, 11, 0),
(313, 11, 0),
(314, 11, 0),
(315, 11, 0),
(316, 11, 0),
(317, 11, 0),
(318, 11, 0),
(319, 11, 0),
(320, 11, 0),
(321, 11, 0),
(322, 11, 0),
(323, 11, 0),
(324, 11, 0),
(325, 11, 0),
(326, 11, 0),
(327, 11, 0),
(328, 11, 0),
(329, 11, 0),
(330, 11, 0),
(331, 11, 0),
(332, 12, 0),
(333, 12, 0),
(334, 12, 0),
(335, 12, 0),
(336, 12, 0),
(337, 12, 0),
(338, 12, 0),
(339, 12, 0),
(340, 12, 0),
(341, 12, 0),
(342, 12, 0),
(343, 12, 0),
(344, 12, 0),
(345, 12, 0),
(346, 12, 0),
(347, 12, 0),
(348, 12, 0),
(349, 12, 0),
(350, 12, 0),
(351, 12, 0),
(352, 12, 0),
(353, 12, 0),
(354, 12, 0),
(355, 12, 0),
(356, 12, 0),
(357, 12, 0),
(358, 12, 0),
(359, 12, 0),
(360, 12, 0),
(361, 12, 0),
(362, 12, 0),
(363, 13, 0),
(364, 13, 0),
(365, 13, 0),
(366, 13, 0),
(367, 13, 0),
(368, 13, 0),
(369, 13, 0),
(370, 13, 0),
(371, 13, 0),
(372, 13, 0),
(373, 13, 0),
(374, 13, 0),
(375, 13, 0),
(376, 13, 0),
(377, 13, 0),
(378, 13, 0),
(379, 13, 0),
(380, 13, 0),
(381, 13, 0),
(382, 13, 0),
(383, 13, 0),
(384, 13, 0),
(385, 13, 0),
(386, 13, 0),
(387, 13, 0),
(388, 13, 0),
(389, 13, 0),
(390, 13, 0),
(391, 13, 0),
(392, 13, 0),
(393, 13, 0),
(394, 14, 0),
(395, 14, 0),
(396, 14, 0),
(397, 14, 0),
(398, 14, 0),
(399, 14, 0),
(400, 14, 0),
(401, 14, 0),
(402, 14, 0),
(403, 14, 0),
(404, 14, 0),
(405, 14, 0),
(406, 14, 0),
(407, 14, 0),
(408, 14, 0),
(409, 14, 0),
(410, 14, 0),
(411, 14, 0),
(412, 14, 0),
(413, 14, 0),
(414, 14, 0),
(415, 14, 0),
(416, 14, 0),
(417, 14, 0),
(418, 14, 0),
(419, 14, 0),
(420, 14, 0),
(421, 14, 0),
(422, 14, 0),
(423, 14, 0),
(424, 14, 0),
(425, 15, 0),
(426, 15, 0),
(427, 15, 0),
(428, 15, 0),
(429, 15, 0),
(430, 15, 0),
(431, 15, 0),
(432, 15, 0),
(433, 15, 0),
(434, 15, 0),
(435, 15, 0),
(436, 15, 0),
(437, 15, 0),
(438, 15, 0),
(439, 15, 0),
(440, 15, 0),
(441, 15, 0),
(442, 15, 0),
(443, 15, 0),
(444, 15, 0),
(445, 15, 0),
(446, 15, 0),
(447, 15, 0),
(448, 15, 0),
(449, 15, 0),
(450, 15, 0),
(451, 15, 0),
(452, 15, 0),
(453, 15, 0),
(454, 15, 0),
(455, 15, 0),
(456, 16, 0),
(457, 16, 0),
(458, 16, 0),
(459, 16, 0),
(460, 16, 0),
(461, 16, 0),
(462, 16, 0),
(463, 16, 0),
(464, 16, 0),
(465, 16, 0),
(466, 16, 0),
(467, 16, 0),
(468, 16, 0),
(469, 16, 0),
(470, 16, 0),
(471, 16, 0),
(472, 16, 0),
(473, 16, 0),
(474, 16, 0),
(475, 16, 0),
(476, 16, 0),
(477, 16, 0),
(478, 16, 0),
(479, 16, 0),
(480, 16, 0),
(481, 16, 0),
(482, 16, 0),
(483, 16, 0),
(484, 16, 0),
(485, 16, 0),
(486, 17, 0),
(487, 17, 0),
(488, 17, 0),
(489, 17, 0),
(490, 17, 0),
(491, 17, 0),
(492, 17, 0),
(493, 17, 0),
(494, 17, 0),
(495, 17, 0),
(496, 17, 0),
(497, 17, 0),
(498, 17, 0),
(499, 17, 0),
(500, 17, 0),
(501, 17, 0),
(502, 17, 0),
(503, 17, 0),
(504, 17, 0),
(505, 17, 0),
(506, 17, 0),
(507, 17, 0),
(508, 17, 0),
(509, 17, 0),
(510, 17, 0),
(511, 17, 0),
(512, 17, 0),
(513, 17, 0),
(514, 17, 0),
(515, 17, 0),
(516, 17, 0),
(517, 18, 0),
(518, 18, 0),
(519, 18, 0),
(520, 18, 0),
(521, 18, 0),
(522, 18, 0),
(523, 18, 0),
(524, 18, 0),
(525, 18, 0),
(526, 18, 0),
(527, 18, 0),
(528, 18, 0),
(529, 18, 0),
(530, 18, 0),
(531, 18, 0),
(532, 18, 0),
(533, 18, 0),
(534, 18, 0),
(535, 18, 0),
(536, 18, 0),
(537, 18, 0),
(538, 18, 0),
(539, 18, 0),
(540, 18, 0),
(541, 18, 0),
(542, 18, 0),
(543, 18, 0),
(544, 18, 0),
(545, 18, 0),
(546, 18, 0);

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
-- Indices de la tabla `fechas`
--
ALTER TABLE `fechas`
  ADD PRIMARY KEY (`id_fecha`);

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
-- Indices de la tabla `ventas_diarias`
--
ALTER TABLE `ventas_diarias`
  ADD PRIMARY KEY (`id_ven_dia`),
  ADD KEY `id_presu2` (`id_fecha1`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `control`
--
ALTER TABLE `control`
  MODIFY `id_control` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `cuadre_caja`
--
ALTER TABLE `cuadre_caja`
  MODIFY `id_cuadre_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `cuenta_cobro`
--
ALTER TABLE `cuenta_cobro`
  MODIFY `id_cuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `detalle_sugerido`
--
ALTER TABLE `detalle_sugerido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=630;

--
-- AUTO_INCREMENT de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  MODIFY `id_domi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_facturacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `factura_abono`
--
ALTER TABLE `factura_abono`
  MODIFY `id_factura_abono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `fechas`
--
ALTER TABLE `fechas`
  MODIFY `id_fecha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `id_kilometraje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `observacion`
--
ALTER TABLE `observacion`
  MODIFY `id_obs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `pagos_caja`
--
ALTER TABLE `pagos_caja`
  MODIFY `id_pagos_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id_pers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  MODIFY `id_presu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `pre_detalle`
--
ALTER TABLE `pre_detalle`
  MODIFY `id_presu_de` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT de la tabla `pre_detalle_cat`
--
ALTER TABLE `pre_detalle_cat`
  MODIFY `id_pre_detalle_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `requerimiento`
--
ALTER TABLE `requerimiento`
  MODIFY `id_reque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `ro_detalles`
--
ALTER TABLE `ro_detalles`
  MODIFY `id_ro_de` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `r_operativos`
--
ALTER TABLE `r_operativos`
  MODIFY `id_ro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `sugerido`
--
ALTER TABLE `sugerido`
  MODIFY `id_sugerido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `id_ubi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `ventas_diarias`
--
ALTER TABLE `ventas_diarias`
  MODIFY `id_ven_dia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=547;

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

--
-- Filtros para la tabla `ventas_diarias`
--
ALTER TABLE `ventas_diarias`
  ADD CONSTRAINT `ventas_diarias_ibfk_1` FOREIGN KEY (`id_fecha1`) REFERENCES `fechas` (`id_fecha`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
