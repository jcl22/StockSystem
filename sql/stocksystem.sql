-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-01-2022 a las 01:16:34
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_detalletemp` (`codigo` INT, `cantidad` INT, `token_user` VARCHAR(50))  BEGIN
     DECLARE precio_actual decimal(10,2); 
  		SELECT precio INTO precio_actual FROM producto WHERE id_producto = codigo;
        
        INSERT INTO detalle_temp(token_usuario,id_producto,cantidad,precio_venta) 
        VALUES(token_user, codigo, cantidad, precio_actual);
        
        SELECT tmp.id_detemp, tmp.id_producto,p.nombre_producto, tmp.cantidad, tmp.precio_venta 
        FROM detalle_temp tmp 
        INNER JOIN producto p
        ON tmp.id_producto = p.id_producto
        WHERE tmp.token_usuario = token_user;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_detalletemp` (IN `id_detalle` INT, IN `token` VARCHAR(50))  BEGIN
        
        	DELETE FROM detalle_temp WHERE id_detemp = id_detalle;
            
            SELECT tmp.id_detemp, tmp.id_producto, p.nombre_producto, tmp.cantidad, tmp.precio_venta 
            FROM detalle_temp tmp 
            INNER JOIN producto p
            ON tmp.id_producto = p.id_producto
            WHERE tmp.token_usuario = token
            ORDER BY tmp.id_detemp ASC;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procesar_venta` (`cod_usuario` INT, `cod_cliente` INT, `token` VARCHAR(50))  BEGIN
    	DECLARE venta INT;
        DECLARE registros INT;
        
        DECLARE total DECIMAL(10,2);
            
        DECLARE nueva_existencia int;
        DECLARE existencia_actual int;
            
        DECLARE tmp_cod_producto int;
        DECLARE tmp_cant_producto int;
        DECLARE a INT;
        SET a = 1;
        
        CREATE TEMPORARY TABLE tbl_tmp_tokenusuario (
            id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            cod_prod BIGINT, 
            cant_prod INT);
            
            SET registros = (SELECT COUNT(*) FROM detalle_temp WHERE token_usuario = token);
            
            IF registros > 0  THEN
            	INSERT INTO tbl_tmp_tokenusuario(cod_prod, cant_prod) SELECT id_producto, cantidad FROM detalle_temp
            			WHERE token_usuario = token;
            	INSERT INTO venta (id_usuario, id_cliente) VALUES (cod_usuario,cod_cliente);
            	SET venta = LAST_INSERT_ID();
            
            	INSERT INTO detalle_venta (id_venta, id_producto, cantidad, precio_venta) SELECT (venta) AS id_venta, id_producto, 
            	cantidad, precio_venta FROM detalle_temp WHERE token_usuario = token;
            
            	WHILE a <= registros DO
            		SELECT cod_prod, cant_prod INTO tmp_cod_producto, tmp_cant_producto FROM tbl_tmp_tokenusuario WHERE id=a;
            		SELECT existencia into existencia_actual FROM producto WHERE id_producto = tmp_cod_producto;         
            		SET nueva_existencia = existencia_actual - tmp_cant_producto;
            		UPDATE producto SET existencia = nueva_existencia WHERE id_producto = tmp_cod_producto;
            
            		SET a=a+1;
            
            	END WHILE;
            
            	SET total = (SELECT SUM(cantidad*precio_venta) FROM detalle_temp WHERE token_usuario = token);
            	UPDATE venta SET total_venta = total WHERE id_venta = venta;            
            	DELETE FROM detalle_temp WHERE token_usuario = token;
           		TRUNCATE TABLE tbl_tmp_tokenusuario;
            	SELECT * FROM venta WHERE id_venta = venta;
            
            ELSE
            	SELECT 0;
            END IF;
            
    END$$

DELIMITER ;

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
(3829382, 'Andrés ', 5754854, 'cra 40 # 10-114', 1),
(19238349, 'Jonatan', 3712838, 'calle 10 #98-91', 1),
(72638484, 'Camila Londoño Arenas', 60145647, 'Cra 30A #20sur-10', 1),
(101292039, 'Esteban Cano', 604516272, 'cra 45A #40-30', 1),
(182393743, 'Claudia', 2147483647, 'cra 50 # 13-10', 1),
(1028829364, 'Gloria Hurtado', 604292333, 'cra 45A #40-30', 1),
(1384493023, 'Juan Pablo', 2147483647, 'Carrera 70 # 15-112', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_empresa`
--

CREATE TABLE `config_empresa` (
  `id` bigint(20) NOT NULL,
  `nit` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `direccion` text NOT NULL,
  `iva` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `config_empresa`
--

INSERT INTO `config_empresa` (`id`, `nit`, `nombre`, `razon_social`, `telefono`, `correo`, `direccion`, `iva`) VALUES
(1, '102938474-5', 'StockSystem - Sistema de inventarios y ventas', 'Stocksystem', 6044637283, 'stocksystemcompany@gmail.com', 'Cra 56b # 34c - 16', '19.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

CREATE TABLE `detalle_temp` (
  `id_detemp` int(15) NOT NULL,
  `id_producto` int(15) NOT NULL,
  `token_usuario` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cantidad` int(10) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detventa` int(15) NOT NULL,
  `id_producto` int(15) NOT NULL,
  `id_venta` int(15) NOT NULL,
  `fecha_venta` datetime NOT NULL DEFAULT current_timestamp(),
  `cantidad` int(10) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detventa`, `id_producto`, `id_venta`, `fecha_venta`, `cantidad`, `precio_venta`) VALUES
(6, 1, 5, '2021-12-31 19:08:59', 2, '1720000.00'),
(7, 3, 5, '2021-12-31 19:08:59', 1, '5555555.56'),
(9, 3, 6, '2021-12-31 19:10:51', 2, '5555555.56'),
(10, 2, 6, '2021-12-31 19:10:51', 1, '2625000.00'),
(11, 4, 6, '2021-12-31 19:10:51', 1, '3550000.00'),
(12, 3, 7, '2021-12-31 19:13:08', 2, '5555555.56'),
(13, 6, 7, '2021-12-31 19:13:08', 1, '7570000.00'),
(14, 1, 7, '2021-12-31 19:13:08', 1, '1720000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(15) NOT NULL,
  `id_producto` int(15) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `existencia` int(20) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_usuario` int(15) NOT NULL,
  `id_proveedor` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `id_producto`, `fecha`, `existencia`, `precio`, `id_usuario`, `id_proveedor`) VALUES
(1, 1, '2021-12-24 02:06:37', 30, '17000000.00', 1036678760, 37443943),
(2, 2, '2021-12-24 02:08:11', 5, '2800000.00', 1036678760, 1012637495),
(3, 3, '2021-12-24 02:09:55', 12, '6100000.00', 1036678760, 37443943),
(4, 4, '2021-12-24 02:11:13', 5, '3500000.00', 1036678760, 32732743),
(5, 5, '2021-12-24 02:29:27', 5, '2400000.00', 1036678760, 327283292),
(6, 5, '2021-12-26 18:33:02', 1, '2100000.00', 1036678760, 0),
(7, 3, '2021-12-26 18:36:14', 3, '6000000.00', 1036678760, 0),
(8, 2, '2021-12-26 21:39:27', 3, '2500000.00', 1036678760, 0),
(9, 1, '2021-12-26 21:41:30', 10, '1800000.00', 1036678760, 0),
(10, 4, '2021-12-26 22:21:46', 2, '3700000.00', 1036678760, 0),
(11, 4, '2021-12-26 22:25:32', 1, '3400000.00', 1036678760, 0),
(12, 2, '2021-12-26 22:59:31', 2, '2500000.00', 1036678760, 0),
(13, 4, '2021-12-26 23:08:17', 1, '3800000.00', 1036678760, 0),
(14, 4, '2021-12-28 12:59:18', 1, '3400000.00', 1036678760, 0),
(15, 3, '2021-12-29 14:11:48', 3, '6000000.00', 1036678760, 0),
(16, 5, '2021-12-29 14:13:48', 2, '2300000.00', 1036678760, 0),
(17, 2, '2021-12-29 15:07:15', 2, '2500000.00', 1036678760, 0),
(18, 2, '2021-12-29 15:36:45', -1, '2625000.00', 1036678760, 0),
(19, 6, '2021-12-29 21:20:45', 7, '7500000.00', 1036678760, 37443943),
(20, 6, '2021-12-29 21:21:56', -2, '7500000.00', 1036678760, 0),
(21, 6, '2021-12-30 03:33:15', 2, '7500000.00', 1036678760, 0),
(22, 6, '2021-12-30 20:25:46', 2, '7700000.00', 1036678760, 0),
(23, 6, '2021-12-30 21:53:09', 1, '7800000.00', 1036678760, 0),
(24, 1, '2021-12-31 17:59:52', 10, '1700000.00', 1036678760, 0);

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
(1, 'Aple Watch Serie 7 ', 2, '1720000.00', 47, '2021-12-24 02:06:37', 1036678760, 37443943, 'img_producto.png', 1),
(2, 'HP Pavillon x360', 3, '2625000.00', 10, '2021-12-24 02:08:11', 1036678760, 1012637495, 'img_producto.png', 1),
(3, 'Iphone 13 Pro 256 gb', 3, '5555555.56', 13, '2021-12-24 02:09:55', 1036678760, 37443943, 'img_producto.png', 1),
(4, 'Samsung Galaxy Z Flip3', 2, '3550000.00', 9, '2021-12-24 02:11:13', 1036678760, 32732743, 'img_producto.png', 1),
(5, 'SONY Xperia 10 III', 3, '2341666.00', 12, '2021-12-24 02:29:27', 1036678760, 327283292, 'img_producto.png', 1),
(6, 'Mackbook Air Pro 2021', 1, '7570000.00', 9, '2021-12-29 21:20:45', 1036678760, 37443943, 'img_producto.png', 1);

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
  `fecha_venta` datetime NOT NULL DEFAULT current_timestamp(),
  `total_venta` int(30) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `id_cliente`, `id_usuario`, `fecha_venta`, `total_venta`, `estado`) VALUES
(5, 3829382, 1036678760, '0000-00-00 00:00:00', 8995556, 1),
(6, 3829382, 1036678760, '2021-12-31 19:10:51', 17286111, 1),
(7, 3829382, 1036678760, '2021-12-31 19:13:07', 20401111, 1);

--
-- Índices para tablas volcadas
--

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
-- Indices de la tabla `config_empresa`
--
ALTER TABLE `config_empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD PRIMARY KEY (`id_detemp`),
  ADD KEY `id_producto_2` (`id_producto`),
  ADD KEY `token_usuario` (`token_usuario`);

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
-- AUTO_INCREMENT de la tabla `config_empresa`
--
ALTER TABLE `config_empresa`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `id_detemp` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detventa` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD CONSTRAINT `detalle_temp_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

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
