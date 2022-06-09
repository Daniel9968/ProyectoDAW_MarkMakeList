-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generacion: 27-04-2022 a las 18:50:29
-- Version del servidor: 10.4.21-MariaDB
-- Version de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectodaw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `nombreCategoria` char(35) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nombreCategoria`, `idUsuario`) VALUES
(1, 'Aceite, vinagre y sal', NULL),
(2, 'Agua y refrescos', NULL),
(3, 'Aperitivos', NULL),
(4, 'Arroz, legumbres y pasta', NULL),
(5, 'Azucar, caramelos y chocolate', NULL),
(6, 'Bebe', NULL),
(7, 'Bodega', NULL),
(8, 'Cacao, cafe e infusiones', NULL),
(9, 'Carne', NULL),
(10, 'Cereales y galletas', NULL),
(11, 'Charcuteria y quesos', NULL),
(12, 'Congelados', NULL),
(13, 'Consevas, caldos y cremas', NULL),
(14, 'Cuidado del cabello', NULL),
(15, 'Cuidado facial y corporal', NULL),
(16, 'Filoterapia y parafarmacia', NULL),
(17, 'Fruta y verdura', NULL),
(18, 'Huevos, leche y mantequilla', NULL),
(19, 'Limpieza y hogar', NULL),
(20, 'Maquillaje', NULL),
(21, 'Marisco y pescado', NULL),
(22, 'Mascotas', NULL),
(23, 'Panaderia y pasteleria', NULL),
(24, 'Pizzas y platos preparados', NULL),
(25, 'Postres y yogures', NULL),
(26, 'Zumos', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listapedidos`
--

CREATE TABLE `listapedidos` (
  `idListaPedidos` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `Cantidad` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listas`
--

CREATE TABLE `listas` (
  `idLista` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `nombreLista` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombreProducto` char(35) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombreProducto`, `idCategoria`, `idUsuario`) VALUES
(1, 'Aceite de oliva', 1, NULL),
(2, 'Vinagre de vino blanco', 1, NULL),
(3, 'Sal fina', 1, NULL),
(4, 'Oregano', 1, NULL),
(5, 'Agua mineral', 2, NULL),
(6, 'Aquarius', 2, NULL),
(7, 'Coca-Cola', 2, NULL),
(8, 'Fanta limon', 2, NULL),
(9, 'Nestea', 2, NULL),
(10, 'Aceitunas', 3, NULL),
(11, 'Nuez natural', 3, NULL),
(12, 'Patatas fritas', 3, NULL),
(13, 'Pringles', 3, NULL),
(14, 'Bombitas de maiz', 3, NULL),
(15, 'Arroz redondo', 4, NULL),
(16, 'Quinoa', 4, NULL),
(17, 'Garbanzo cocido', 4, NULL),
(18, 'Alubias negras', 4, NULL),
(19, 'Fideo cabello de angel', 4, NULL),
(20, 'Azucar blanco', 5, NULL),
(21, 'Chicle menta', 5, NULL),
(22, 'Chocolate negro', 5, NULL),
(23, 'Surtido de golosinas', 5, NULL),
(24, 'Mermelada de fresa', 5, NULL),
(25, 'Papilla crema de bechamel', 6, NULL),
(26, 'Biberon tetina latex', 6, NULL),
(27, 'Jabon liquido bebe', 6, NULL),
(28, 'Peine para bebe', 6, NULL),
(29, 'Toallitas bebe', 6, NULL),
(30, 'Cerveza', 7, NULL),
(31, 'Cerveza 0,0% sin alcohol', 7, NULL),
(32, 'Vermouth bianco', 7, NULL),
(33, 'Sidra', 7, NULL),
(34, 'Sangria', 7, NULL),
(35, 'Cacao soluble', 8, NULL),
(36, 'Cafe en capsula', 8, NULL),
(37, 'Cafe molido', 8, NULL),
(38, 'Cafe soluble', 8, NULL),
(39, 'Te verde', 8, NULL),
(40, 'Arreglo para puchero', 9, NULL),
(41, 'Filetes pechuga de pavo', 9, NULL),
(42, 'Jamoncitos de pollo congelados', 9, NULL),
(43, 'Costillas de cerdo', 9, NULL),
(44, 'Medio conejo troceado', 9, NULL),
(45, 'Cereales rellenos de leche', 10, NULL),
(46, 'Galletas', 10, NULL),
(47, 'Tortitas de maiz', 10, NULL),
(48, 'Tortitas de arroz', 10, NULL),
(49, 'Tortitas de avena y arroz', 10, NULL),
(50, 'Cerdo trufa con pistachos', 11, NULL),
(51, 'Bacon cintas', 11, NULL),
(52, 'Chopped cocido en lata', 11, NULL),
(53, 'Fuet', 11, NULL),
(54, 'Jamon serrano', 11, NULL),
(55, 'Helado mini blanco almendrado', 12, NULL),
(56, 'Helado sandwich de nata', 12, NULL),
(57, 'Cubos de hielo', 12, NULL),
(58, 'Tarta carrot cake', 12, NULL),
(59, 'Tarta infantil Madagascar', 12, NULL),
(60, 'Atun en aceite de girasol', 13, NULL),
(61, 'Berberechos al natural', 13, NULL),
(62, 'Sopa de pollo', 13, NULL),
(63, 'Sopa instantanea de pollo', 13, NULL),
(64, 'Crema de calabaza y zanahoria', 13, NULL),
(65, 'Acondicionador Suavidad y Brillo', 14, NULL),
(66, 'Champu proteccion y brillo', 14, NULL),
(67, 'Bano de color 100 negro', 14, NULL),
(68, 'Laca cabello Nelly', 14, NULL),
(69, 'Cepillo cabello neumatico', 14, NULL),
(70, 'Gel de afeitar', 15, NULL),
(71, 'Crema corporal con aceite de oliva', 15, NULL),
(72, 'Discos desmaquillantes', 15, NULL),
(73, 'Bandas de cera facial piel', 15, NULL),
(74, 'Desodorante roll-on cuidado', 15, NULL),
(75, 'Colagen sabor limon', 16, NULL),
(76, 'Capsulas Dormir', 16, NULL),
(77, 'Bastoncillos de algodon 100%', 16, NULL),
(78, 'Alcohol 96', 16, NULL),
(79, 'Tiras protectoras classic', 16, NULL),
(80, 'Platanos', 17, NULL),
(81, 'Uva blanca sin semillas', 17, NULL),
(82, 'Lechuga iceberg', 17, NULL),
(83, 'Patata', 17, NULL),
(84, 'Batata', 17, NULL),
(85, 'Huevos', 18, NULL),
(86, 'Claras de huevo liquidas', 18, NULL),
(87, 'Leche semidesnatada', 18, NULL),
(88, 'Bebida lactea semidesnatada', 18, NULL),
(89, 'Mantequilla sin sal anadida', 18, NULL),
(90, 'Detergente ropa jabon natural', 19, NULL),
(91, 'Estropajo suciedad resistente', 19, NULL),
(92, 'Insecticida moscas y mosquitos', 19, NULL),
(93, 'Lejia normal', 19, NULL),
(94, 'Limpiacristales y multiusos', 19, NULL),
(95, 'Maquillaje fluido', 20, NULL),
(96, 'Colorete compacto', 20, NULL),
(97, 'Vaselina hidratante', 20, NULL),
(98, 'Perfilador de ojos', 20, NULL),
(99, 'Esponja maquillaje triangulos', 20, NULL),
(100, 'Langostino cocido', 21, NULL),
(101, 'Mejillon gordo', 21, NULL),
(102, 'Escalopines de salmon', 21, NULL),
(103, 'Calamar pequeno limpio descongelado', 21, NULL),
(104, 'California rolls de surimi', 21, NULL),
(105, 'Bocaditos en salsa gato adulto', 22, NULL),
(106, 'Pate perro junior', 22, NULL),
(107, 'Salchicha perro adulto', 22, NULL),
(108, 'Alimento completo para Periquitos', 22, NULL),
(109, 'Alimento completo para Peces', 22, NULL),
(110, 'Berlina al cacao', 23, NULL),
(111, 'Magdalenas', 23, NULL),
(112, 'Harina de trigo', 23, NULL),
(113, 'Barra de pan', 23, NULL),
(114, 'Trenza hojaldre congelada', 23, NULL),
(115, 'Pizza jamon y queso', 24, NULL),
(116, 'Pizza Calzone con jamon cocido', 24, NULL),
(117, 'Lasana bolonesa familiar', 24, NULL),
(118, 'Pastel de calabacin con pollo', 24, NULL),
(119, 'Tortilla de patata y cebolla', 24, NULL),
(120, 'Bifidus desnatado con nueces', 25, NULL),
(121, 'Flan de vainilla con caramelo', 25, NULL),
(122, 'Gelatina sabor fresa', 25, NULL),
(123, 'Postre de soja', 25, NULL),
(124, 'Yogur natural edulcorado', 25, NULL),
(125, 'Fruta + leche tropical', 26, NULL),
(126, 'Zumo de melocoton y uva', 26, NULL),
(127, 'Zumo de naranja', 26, NULL),
(128, 'Zumo de tomate', 26, NULL),
(129, 'Zumo de manzana', 26, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombre` char(20) NOT NULL,
  `contrasenya` char(230) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- indices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`),
  ADD KEY `FK_ProyectoDAW_Categorias_idUsuario` (`idUsuario`);

--
-- Indices de la tabla `listapedidos`
--
ALTER TABLE `listapedidos`
  ADD PRIMARY KEY (`idListaPedidos`,`idProducto`),
  ADD KEY `FK_ProyectoDAW_ListaPedidos_idProducto` (`idProducto`);

--
-- Indices de la tabla `listas`
--
ALTER TABLE `listas`
  ADD PRIMARY KEY (`idLista`),
  ADD KEY `FK_ProyectoDAW_Listas_idUsuario` (`idUsuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `FK_ProyectoDAW_Productos_idUsuario` (`idUsuario`),
  ADD KEY `FK_ProyectoDAW_Productos_idCategoria` (`idCategoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `listas`
--
ALTER TABLE `listas`
  MODIFY `idLista` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `FK_ProyectoDAW_Categorias_idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `listapedidos`
--
ALTER TABLE `listapedidos`
  ADD CONSTRAINT `FK_ProyectoDAW_ListaPedidos_idListaPedidos` FOREIGN KEY (`idListaPedidos`) REFERENCES `listas` (`idLista`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ProyectoDAW_ListaPedidos_idProducto` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `listas`
--
ALTER TABLE `listas`
  ADD CONSTRAINT `FK_ProyectoDAW_Listas_idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK_ProyectoDAW_Productos_idCategoria` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ProyectoDAW_Productos_idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
