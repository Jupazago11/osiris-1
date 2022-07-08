-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-07-2022 a las 06:45:05
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
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `costo` int(11) NOT NULL,
  `factura` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date NOT NULL,
  `fecha_pago` datetime DEFAULT NULL,
  `dias` int(11) NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cuenta_cobro`
--

INSERT INTO `cuenta_cobro` (`id_cuenta`, `nombre`, `costo`, `factura`, `fecha`, `fecha_pago`, `dias`, `estado`) VALUES
(1, 'prove', 10000, NULL, '2022-07-03', '2022-07-06 12:26:52', 5, 'activo'),
(2, 'prove', 200000, '5A45SDAS4D5AS', '2022-07-04', '2022-07-05 16:13:29', 10, 'inactivo'),
(3, 'prove', 300000, NULL, '2022-07-05', '2022-07-06 12:25:02', 15, 'inactivo'),
(4, 'prove', 4000000, 'ABC123', '2022-07-03', '2022-07-06 00:00:00', 20, 'inactivo'),
(5, 'prove', 450000, NULL, '2022-07-05', '2022-07-06 12:25:02', 25, 'inactivo'),
(6, 'cocacola', 50000, NULL, '2022-07-05', '2022-07-05 16:13:25', 30, 'inactivo'),
(7, 'cocacola', 2000, 'jp11', '2022-07-05', '2022-07-06 12:26:52', 10, 'inactivo'),
(8, 'nuevo', 200000, NULL, '2022-07-05', '2022-07-06 12:26:52', 5, 'activo'),
(9, 'cocacola', 50000, 'kl521', '2022-07-06', NULL, 16, 'activo');

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
(13, 3, 11, 1, '2022-07-01', 'hfghfg', 'carnes', 'hfghfgh', 'gfhfgh', '16:12', '16:12', 'inactivo');

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
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id_pers` int(11) NOT NULL,
  `nombre_pers` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `identificacion_pers` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_pers` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pass_pers` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_usuario_pers` int(11) NOT NULL,
  `fecha_nacimiento_pers` date DEFAULT NULL,
  `fecha_inicio_contrato_pers` date DEFAULT NULL,
  `tipo_contrato_pers` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cargo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `salario_pers` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `eps` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `arl` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `caja_compensacion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pension` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id_pers`, `nombre_pers`, `identificacion_pers`, `user_pers`, `pass_pers`, `tipo_usuario_pers`, `fecha_nacimiento_pers`, `fecha_inicio_contrato_pers`, `tipo_contrato_pers`, `cargo`, `salario_pers`, `eps`, `arl`, `caja_compensacion`, `pension`, `estado`) VALUES
(1, 'juan pablo zapata gómez', '1037977046', 'jupazago', '159875321', 1, '1998-03-06', '2022-05-31', '12', 'Administrador', '1000000', '', '', '', '', 'activo'),
(2, 'Domiciliario', '1', 'domi', 'domi', 4, '2022-06-01', '2022-06-01', '12', 'Domiciliario', '500000', 'sura', 'sura', '', '', 'activo'),
(3, 'empleado prueba', '', 'empleado', '1234', 2, '0000-00-00', '0000-00-00', '12', '', '', '', '', '', '', 'activo'),
(4, NULL, NULL, 'probando', 'probando', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo'),
(5, NULL, NULL, 'prueba 50', 'prueba 50', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo'),
(6, NULL, NULL, 'probando 40', 'probando 40', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo'),
(7, 'jaime r', '123456', 'jaime123', 'jaime123', 2, '2000-01-01', '2022-01-01', '6', 'carguero', '1000000', 'sura', 'sura', 'comfenalco', 'porvenir', 'activo');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion_proveedor` varchar(65) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contacto_proveedor` varchar(65) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nom_vendedor` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_vendedor` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre_proveedor`, `direccion_proveedor`, `contacto_proveedor`, `nom_vendedor`, `telefono_vendedor`, `estado`) VALUES
(1, 'prove', 'san luis ant', '123456', '', '', ''),
(2, 'provee', 'Dirección', 'Teléfono', '', '', ''),
(3, 'provee2', 'rionegro', '123465', '', '', ''),
(4, 'nuevoprove', 'Dirección', 'Teléfono', '', '', ''),
(5, 'nuevoprovee', 'Dirección', 'Teléfono', '', '', ''),
(6, 'nuevoproveer', 'Dirección', 'Teléfono', '', '', ''),
(7, 'nuevoproveerr', 'Dirección', 'Teléfono', '', '', ''),
(8, 'crear prove', 'direccion 5', '123456', '', '', ''),
(9, 'colanta', 'rionegro', '654321', '', '', ''),
(10, 'aura', 'medellin', '123456', 'jaime', '32123121', ''),
(11, 'aura', 'medellin', '123456', 'jaime', '32123121', ''),
(12, 'milo', 'medellin', '123456', 'jaime', '32123121', ''),
(13, 'milo', 'medellin', '123456', 'jaime', '32123121', ''),
(14, 'nutresa', 'medellin', '123456', 'jaime salazar', '32123121', ''),
(15, 'nutresa', 'medellin', '123456', 'jaime salazar', '32123121', ''),
(16, 'prueba', 'san luis', '123456', 'carlos', '132456', ''),
(17, 'prueba', 'san luis', '123456', 'carlos', '132456', ''),
(18, 'prueba2', 'san luis', '123456', 'carlos', '132456', ''),
(19, 'prueba2', 'san luis', '123456', 'carlos', '132456', ''),
(20, 'empa', 'rionegro', '123456', 'provedor', '123456', ''),
(21, 'empa', 'rionegro', '123456', 'provedor', '123456', ''),
(22, 'nuevo', 'san luiss', '12455454', 'vendedor', '5421545', ''),
(23, 'nuevo', 'san luiss', '12455454', 'vendedor', '5421545', ''),
(24, 'ahora', 'medellin', '123456', 'vendedor', '123456', ''),
(25, 'ahora', 'medellin', '123456', 'vendedor', '123456', ''),
(26, 'ahora2', 'medellin', '123456', 'vendedor', '123456', ''),
(27, 'ahora2', 'medellin', '123456', 'vendedor', '123456', ''),
(28, 'ahora3', 'afasdgafdgadfgf', '212fd1g2df1g', 'gd1f5gdf51gdf', 'gd6f4g5df5g1df5g', ''),
(29, 'ahora4', 'afasdgafdgadfgf', '212fd1g2df1g', 'gd1f5gdf51gdf', 'gd6f4g5df5g1df5g', ''),
(30, 'ahora5', 'afasdgafdgadfgf', '212fd1g2df1g', 'gd1f5gdf51gdf', 'gd6f4g5df5g1df5g', ''),
(31, 'ahora6', 'afasdgafdgadfgf', '212fd1g2df1g', 'gd1f5gdf51gdf', 'gd6f4g5df5g1df5g', ''),
(32, 'provedor 1', 'san luis', '123456', 'jaime', '123456', 'inactivo'),
(33, 'nuevo', 'fgdfgadfgadfg', '654321', 'ikyukukyu', '456565645456', 'activo'),
(34, 'otro prove', 'rionegro', '123456123', 'vendedor', '12345678', 'activo'),
(35, 'prueba', '123456', '123456', '123456', '123456', 'inactivo'),
(36, 'cocacola', 'medellin', '11111111', 'jaime', '22222222', 'activo'),
(37, 'probando', 'ggggggggggggg', 'gggggggggggggg', 'ggggggggggggg', 'ggggggg', 'activo'),
(38, 'probando 40', 'fffffff', 'fffffffffffffffffffff', 'ffffffffffffffffffff', 'ffffffffffffffffffffff', 'inactivo');

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
  `tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `placa` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_soat` date NOT NULL,
  `fecha_tecn` date NOT NULL,
  `kilometraje` int(11) NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`id_vehiculo`, `tipo`, `placa`, `fecha_soat`, `fecha_tecn`, `kilometraje`, `estado`) VALUES
(1, 'moto', 'ABC-12A', '2022-06-01', '2022-06-01', 1000, 'activo'),
(2, 'moto', 'XYZ-12A', '2022-06-02', '2022-06-02', 0, 'activo');

--
-- Índices para tablas volcadas
--

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
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id_pers`);

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
  MODIFY `id_cuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_sugerido`
--
ALTER TABLE `detalle_sugerido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  MODIFY `id_domi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_facturacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id_pers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `sugerido`
--
ALTER TABLE `sugerido`
  MODIFY `id_sugerido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `id_ubi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_proveedor1`) REFERENCES `proveedor` (`id_proveedor`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_cat1`) REFERENCES `categoria` (`id_cat`);

--
-- Filtros para la tabla `sugerido`
--
ALTER TABLE `sugerido`
  ADD CONSTRAINT `sugerido_ibfk_1` FOREIGN KEY (`id_pers2`) REFERENCES `personal` (`id_pers`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
