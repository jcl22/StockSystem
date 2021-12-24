-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-12-2021 a las 08:40:15
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `stocksystem`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_precio_producto` (`n_existencia` INT, `n_precio` DECIMAL(10,2), `codigo` INT)  BEGIN
    	DECLARE nueva_existencia int;
        DECLARE nuevo_total  decimal(10,2);
        DECLARE nuevo_precio decimal(10,2);
        
        DECLARE cant_actual int;
        DECLARE pre_actual decimal(10,2);
        
        DECLARE actual_existencia int;
        DECLARE actual_precio decimal(10,2);
                
        SELECT precio,existencia INTO actual_precio,actual_existencia FROM producto WHERE id_producto = codigo;
        
        SET nueva_existencia = actual_existencia + n_existencia;
        SET nuevo_total = (actual_existencia * actual_precio) + (n_existencia * n_precio);
        SET nuevo_precio = nuevo_total / nueva_existencia;
        
        UPDATE producto SET existencia = nueva_existencia, precio = nuevo_precio WHERE id_producto = codigo;
        
        SELECT nueva_existencia,nuevo_precio;
        
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega`
--

CREATE TABLE `bodega` (
  `id_bodega` int(15) NOT NULL,
  `nombre_bodega` varchar(20) NOT NULL,
  `descripcion_bod` varchar(155) NOT NULL,
  `lugar` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bodega`
--

INSERT INTO `bodega` (`id_bodega`, `nombre_bodega`, `descripcion_bod`, `lugar`) VALUES
(1, 'Bodega principal', 'Bodega de productos con la mayor rotación', 'Medellín'),
(2, 'Bodega espera', 'Bodega de productos con alta rotación', 'Medellín'),
(3, 'Bodega transitoria', 'Bodega de productos con rotación equilibrada', 'Medellín'),
(4, 'Bodega baja rotacion', 'Bodega de productos con baja rotación', 'Medellín'),
(5, 'Bodega rotación nula', 'Bodega de productos sin rotación ', 'Medellín');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega_destino`
--

CREATE TABLE `bodega_destino` (
  `id_bodegadestino` int(15) NOT NULL,
  `id_bodega` int(15) NOT NULL,
  `id_detorigen` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega_origen`
--

CREATE TABLE `bodega_origen` (
  `id_bodegaorigen` int(15) NOT NULL,
  `id_bodega` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_productos`
--

CREATE TABLE `categoria_productos` (
  `id_categoria` int(15) NOT NULL,
  `nombre_categoria` varchar(30) NOT NULL,
  `descripcion_categoria` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria_productos`
--

INSERT INTO `categoria_productos` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`) VALUES
(1, 'Tipo A', 'Productos de mayor costo'),
(2, 'Tipo B', 'Productos de alto costo'),
(3, 'Tipo C', 'Productos de costo normal'),
(4, 'Tipo D', 'Productos de bajo costo'),
(5, 'Tipo E', 'Productos de costo $1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(15) NOT NULL,
  `nombre_cliente` varchar(30) NOT NULL,
  `telefono` int(20) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre_cliente`, `telefono`, `direccion`, `estado`) VALUES
(3829382, 'Jonatan', 5754854, 'cra 40 # 10-114', 1),
(19238349, 'Jonatan', 3712838, 'calle 10 #98-91', 1),
(72638484, 'Camila Londoño Arenas', 60145647, 'Cra 30A #20sur-10', 1),
(101292039, 'Esteban Cano', 604516272, 'cra 45A #40-30', 1),
(182393743, 'Claudia', 2147483647, 'cra 50 # 13-10', 1),
(1028829364, 'Gloria Hurtado', 604292333, 'cra 45A #40-30', 1),
(1384493023, 'Juan Pablo', 2147483647, 'Carrera 70 # 15-112', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(20) NOT NULL,
  `id_proveedor` int(15) NOT NULL,
  `id_usuario` int(15) NOT NULL,
  `fecha_compra` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_compra`, `id_proveedor`, `id_usuario`, `fecha_compra`) VALUES
(1, 103465748, 1036678760, '2021-11-01'),
(2, 7384920, 1017200416, '2021-11-04'),
(3, 1012637495, 70129170, '2021-11-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id_detcompra` int(15) NOT NULL,
  `id_producto` int(15) NOT NULL,
  `id_compra` int(15) NOT NULL,
  `cantidad_compra` int(10) NOT NULL,
  `costo_total` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_trasladoorigen`
--

CREATE TABLE `detalle_trasladoorigen` (
  `id_detorigen` int(15) NOT NULL,
  `id_producto` int(15) NOT NULL,
  `cantidad_traslado` int(10) NOT NULL,
  `id_bodegaorigen` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detventa` int(15) NOT NULL,
  `id_producto` int(15) NOT NULL,
  `id_venta` int(15) NOT NULL,
  `cantidad_venta` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(15) NOT NULL,
  `id_producto` int(15) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `existencia` int(20) NOT NULL,
  `precio` int(15) NOT NULL,
  `id_usuario` int(15) NOT NULL,
  `id_proveedor` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `id_producto`, `fecha`, `existencia`, `precio`, `id_usuario`, `id_proveedor`) VALUES
(1, 1, '2021-12-24 02:06:37', 30, 17000000, 1036678760, 37443943),
(2, 2, '2021-12-24 02:08:11', 5, 2800000, 1036678760, 1012637495),
(3, 3, '2021-12-24 02:09:55', 12, 6100000, 1036678760, 37443943),
(4, 4, '2021-12-24 02:11:13', 5, 3500000, 1036678760, 32732743),
(5, 5, '2021-12-24 02:29:27', 5, 2400000, 1036678760, 327283292);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(15) NOT NULL,
  `nombre_producto` varchar(30) NOT NULL,
  `id_categoria` int(15) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `existencia` int(15) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(15) NOT NULL,
  `id_proveedor` int(15) NOT NULL,
  `foto` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_producto`, `id_categoria`, `precio`, `existencia`, `date_add`, `id_usuario`, `id_proveedor`, `foto`, `estado`) VALUES
(1, 'Aple Watch Serie 7 ', 2, '1700000.00', 30, '2021-12-24 02:06:37', 1036678760, 37443943, 'img_cf74bec4426b0e6e513a53bff2e84b66jpg', 1),
(2, 'HP Pavillon x360', 3, '2800000.00', 5, '2021-12-24 02:08:11', 1036678760, 1012637495, 'img_c40eab6e6805b4cb48e38b6e5b41a345jpg', 1),
(3, 'Iphone 13 Pro 256 gb', 1, '6100000.00', 12, '2021-12-24 02:09:55', 1036678760, 37443943, 'img_399dadc76d596ad4eee020bfc677e23ajpg', 1),
(4, 'Samsung Galaxy Z Flip3', 2, '3500000.00', 5, '2021-12-24 02:11:13', 1036678760, 32732743, 'img_4827af1963ee950d7dcb114262991f0fjpg', 1),
(5, 'SONY Xperia 10 III', 3, '2400000.00', 5, '2021-12-24 02:29:27', 1036678760, 327283292, 'img_producto.png', 1);

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `inventario_A_I` AFTER INSERT ON `producto` FOR EACH ROW BEGIN
        	INSERT INTO inventario(id_producto, existencia, precio, id_usuario, id_proveedor)
            VALUES (new.id_producto, new.existencia, new.precio, new.id_usuario, new.id_proveedor);
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(15) NOT NULL,
  `nombre_proveedor` varchar(30) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre_proveedor`, `direccion`, `telefono`, `estado`) VALUES
(7384920, 'LG', 'Cra 30A #20sur-9 ', '6015263728', 1),
(32732743, 'Samsung', 'cra 45 # 34-94', '6044623782', 1),
(37443943, 'Apple', 'cra 45 b #19sur - 23', '6043623738', 1),
(103465748, 'Lenovo', 'cra 45A #40-30', '6014356352', 1),
(312842934, 'Toshiba', 'cra 40 # 30-20', '6042374829', 1),
(327283292, 'Sony', 'cra 33 #90-110', '605548201', 1),
(738349230, 'Dell', 'Cra 50 # 12-111', '6052623784', 1),
(1012637495, 'HP', 'Cra43 #70-10', '6042533627', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(2) NOT NULL,
  `nombre_rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'Administrador'),
(2, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traslado_bodegas`
--

CREATE TABLE `traslado_bodegas` (
  `id_traslado` int(15) NOT NULL,
  `id_bodegadestino` int(15) NOT NULL,
  `fecha_traslado` date NOT NULL,
  `observaciones` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(15) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `id_rol` int(2) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `contrasena` varchar(155) NOT NULL,
  `estado` char(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `nombre_usuario`, `id_rol`, `correo`, `contrasena`, `estado`) VALUES
(12, 'John3410', 'John Edison', 1, 'johnedison34@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1'),
(43573613, 'Elizabeth48', 'Elizabeth Echavarría', 2, 'elizabeth48@gmail.com', '12345', '1'),
(70129170, 'Victor154', 'Victor Hugo Cano', 1, 'victor154@gmail.com', '12345', '1'),
(1001506208, 'Luisa14', 'Luisa Lopez', 2, 'luisal@gmail.com', '12345', '1'),
(1011292386, 'valeria22', 'Valeria', 2, 'valeria22@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1'),
(1017200416, 'Bryan30', 'Bryan Acevedo', 2, 'bryan60@gmai..com', '12345', '1'),
(1036678760, 'Jhordanv10', 'Jhordan Villamil', 1, 'jhordanv@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1'),
(1928349302, 'Catalina12', 'Catalina', 2, 'catalina12@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1'),
(2147483647, 'manuela1', 'Manuela', 2, 'manuela1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(15) NOT NULL,
  `id_cliente` int(15) NOT NULL,
  `id_usuario` int(15) NOT NULL,
  `fecha_venta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `id_cliente`, `id_usuario`, `fecha_venta`) VALUES
(1, 72638484, 1001506208, '2021-11-11'),
(2, 72638484, 1036678760, '2021-11-11'),
(3, 101292039, 1017200416, '2021-11-11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bodega`
--
ALTER TABLE `bodega`
  ADD PRIMARY KEY (`id_bodega`);

--
-- Indices de la tabla `bodega_destino`
--
ALTER TABLE `bodega_destino`
  ADD PRIMARY KEY (`id_bodegadestino`),
  ADD KEY `id_det_destino` (`id_detorigen`),
  ADD KEY `id_bodega` (`id_bodega`);

--
-- Indices de la tabla `bodega_origen`
--
ALTER TABLE `bodega_origen`
  ADD PRIMARY KEY (`id_bodegaorigen`),
  ADD KEY `id_bodega` (`id_bodega`);

--
-- Indices de la tabla `categoria_productos`
--
ALTER TABLE `categoria_productos`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id_detcompra`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_compra` (`id_compra`);

--
-- Indices de la tabla `detalle_trasladoorigen`
--
ALTER TABLE `detalle_trasladoorigen`
  ADD PRIMARY KEY (`id_detorigen`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_bodegaorigen` (`id_bodegaorigen`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detventa`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `Cantidad_inv` (`existencia`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_categoria_2` (`id_categoria`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `traslado_bodegas`
--
ALTER TABLE `traslado_bodegas`
  ADD PRIMARY KEY (`id_traslado`),
  ADD KEY `id_bodorigen` (`id_bodegadestino`),
  ADD KEY `id_boddestino` (`id_bodegadestino`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_empleado` (`id_usuario`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id_detcompra` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_trasladoorigen`
--
ALTER TABLE `detalle_trasladoorigen`
  MODIFY `id_detorigen` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detventa` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `traslado_bodegas`
--
ALTER TABLE `traslado_bodegas`
  MODIFY `id_traslado` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_productos` (`id_categoria`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
