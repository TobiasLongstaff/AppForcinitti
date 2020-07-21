-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 21-07-2020 a las 13:15:26
-- Versión del servidor: 5.7.30-log
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `c1850246_sisfoci`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `cliente` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nombreFantasia` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `domicilio` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `domicilioEntrega` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefonoPPal` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rubro` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dniCuit` int(11) NOT NULL,
  `saldo` float NOT NULL,
  `tipo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vendedor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `iva` int(11) NOT NULL,
  `saldoAdelantados` float NOT NULL,
  `localidad` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `codPostal` int(11) NOT NULL,
  `formaPagoFavorita` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fechaAlta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `codigo` int(11) NOT NULL,
  `limiteCredito` float NOT NULL,
  `provincia` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ingBrutos` float NOT NULL,
  `web` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descuento` float NOT NULL,
  `promedioCompra` float NOT NULL,
  `mayorCompra` float NOT NULL,
  `menorCompra` float NOT NULL,
  `cantCompras` int(11) NOT NULL,
  `cantCheques` int(11) NOT NULL,
  `totalAdelantado` float NOT NULL,
  `totalComprado` float NOT NULL,
  `totalPagado` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `cliente`, `nombreFantasia`, `domicilio`, `domicilioEntrega`, `telefonoPPal`, `rubro`, `dniCuit`, `saldo`, `tipo`, `vendedor`, `iva`, `saldoAdelantados`, `localidad`, `codPostal`, `formaPagoFavorita`, `mail`, `fechaAlta`, `codigo`, `limiteCredito`, `provincia`, `ingBrutos`, `web`, `descuento`, `promedioCompra`, `mayorCompra`, `menorCompra`, `cantCompras`, `cantCheques`, `totalAdelantado`, `totalComprado`, `totalPagado`) VALUES
(1, 'consumidor final', 'consumidor final', 'vacio', 'vacio', '123', 'vacio', 999999999, 0, 'vacio', 'vacio', 21, 0, 'vacio', 0, 'vacio', 'vacio', 'vaio', 1, 0, 'vacio', 0, 'vacio', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'Tobias Longstaff', 'vacio', 'Chacabuco 514', 'Chacabuco 514', '1', 'vacio', 1, 0, 'vacio', 'vacio', 21, 0, 'vacio', 0, 'vacio', 'vacio', 'vacio', 2, 0, 'vacio', 0, 'vacio', 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `id_pedido`
--

CREATE TABLE `id_pedido` (
  `id` int(11) NOT NULL,
  `vendedor` varchar(50) NOT NULL,
  `fecha_del_pedido` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` varchar(10) NOT NULL,
  `entrega` varchar(100) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `total` float NOT NULL,
  `cabecera` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `id_pedido`
--

INSERT INTO `id_pedido` (`id`, `vendedor`, `fecha_del_pedido`, `estado`, `entrega`, `id_cliente`, `fecha_entrega`, `total`, `cabecera`) VALUES
(2, 'Tobias Longstaff', '2020-06-12 19:21:49', 'Cancelado', '', 1, '0000-00-00', 0, 'tobias'),
(3, 'Tobias Longstaff', '2020-06-12 19:36:58', 'Preparado', 'chacabuco 514', 1, '2000-10-01', 61, 'tobias'),
(4, 'Tobias Longstaff', '2020-06-16 19:06:57', 'Preparado', 'chacabuco 514', 1, '2020-01-01', 33, 'tobias'),
(5, 'Tobias Longstaff', '2020-06-13 11:49:35', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(6, 'Admin', '2020-06-13 11:51:22', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(7, 'Admin', '2020-06-13 12:17:52', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(8, 'Usuario 4', '2020-06-13 12:18:43', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(9, 'Usuario 4', '2020-06-13 12:18:54', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(10, 'Usuario 4', '2020-06-13 12:39:50', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(11, 'Admin', '2020-06-13 12:40:03', '', '', 0, '0000-00-00', 0, ''),
(12, 'Admin', '2020-06-13 12:40:26', '', '', 0, '0000-00-00', 0, ''),
(13, 'Usuario 4', '2020-06-13 12:44:36', '', '', 0, '0000-00-00', 0, ''),
(14, 'Usuario 4', '2020-06-13 12:46:35', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(15, 'Usuario 4', '2020-06-13 12:46:40', '', '', 0, '0000-00-00', 0, ''),
(16, 'Usuario 4', '2020-06-13 12:47:41', '', '', 0, '0000-00-00', 0, ''),
(17, 'Usuario 4', '2020-06-13 12:50:10', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(18, 'Usuario 4', '2020-06-13 12:50:14', '', '', 0, '0000-00-00', 0, ''),
(19, 'Usuario 4', '2020-06-13 12:52:19', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(20, 'Usuario 4', '2020-06-13 12:52:43', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(21, 'Admin', '2020-06-13 12:53:23', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(22, 'Admin', '2020-06-13 12:53:17', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(23, 'Admin', '2020-06-13 12:53:34', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(24, 'Usuario 4', '2020-06-13 12:57:02', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(25, 'Admin', '2020-06-13 13:02:02', '', '', 0, '0000-00-00', 0, ''),
(26, 'Admin', '2020-06-13 13:06:42', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(27, 'Usuario 4', '2020-06-13 13:10:02', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(28, 'Admin', '2020-06-13 13:10:10', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(29, 'Admin', '2020-06-13 13:11:09', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(30, 'Usuario 4', '2020-06-13 13:11:12', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(31, 'Admin', '2020-06-13 13:14:25', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(32, 'Usuario 4', '2020-06-13 13:15:50', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(33, 'Admin', '2020-06-13 13:15:45', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(34, 'Admin', '2020-06-15 18:04:06', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(35, '1/1', '2020-06-15 18:12:32', '', '', 0, '0000-00-00', 0, ''),
(36, '1/1', '2020-06-15 18:13:24', '', '', 0, '0000-00-00', 0, ''),
(37, '1/Admin', '2020-06-15 18:14:18', '', '', 0, '0000-00-00', 0, ''),
(38, 'Admin', '2020-06-15 18:27:39', '', '', 0, '0000-00-00', 0, ''),
(39, 'Admin', '2020-06-15 18:32:36', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(40, 'Admin', '2020-06-15 18:36:41', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(41, 'Admin', '2020-06-15 18:37:00', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(42, 'Admin', '2020-06-15 18:37:17', '', '', 0, '0000-00-00', 0, ''),
(43, 'Admin', '2020-06-15 18:46:15', '', '', 3, '0000-00-00', 0, ''),
(44, 'Admin', '2020-06-15 18:47:48', '', '', 1, '0000-00-00', 0, ''),
(45, 'Admin', '2020-06-15 18:49:10', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(46, 'Admin', '2020-06-15 18:54:09', 'Cancelado', '', 1, '0000-00-00', 0, 'tobias'),
(47, 'Admin', '2020-06-15 18:54:17', '', '', 0, '0000-00-00', 0, ''),
(48, 'Admin', '2020-06-15 19:00:38', '', '', 0, '0000-00-00', 0, ''),
(49, 'Admin', '2020-06-15 19:07:20', '', '', 0, '0000-00-00', 0, ''),
(50, 'Admin', '2020-06-15 19:23:43', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(51, 'Admin', '2020-06-15 19:25:13', '', '', 1, '0000-00-00', 0, 'tobias'),
(52, 'Admin', '2020-06-15 19:29:41', '', '', 1, '0000-00-00', 0, 'tobias'),
(53, 'Admin', '2020-06-15 19:36:22', '', '', 1, '0000-00-00', 0, 'tobias'),
(54, 'Admin', '2020-06-15 19:48:56', 'Cancelado', 'chacabuco 514', 1, '0000-00-00', 0, 'tobias'),
(55, 'Admin', '2020-06-15 20:04:14', '', 'chacabuco 514', 1, '0000-00-00', 0, 'tobias'),
(56, 'Admin', '2020-06-15 20:09:26', '', '', 0, '0000-00-00', 0, ''),
(57, 'Admin', '2020-06-15 20:11:48', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(58, 'Admin', '2020-06-15 20:14:35', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(59, 'TobiasLongstaff', '2020-06-15 20:14:28', '', '', 0, '0000-00-00', 0, ''),
(60, 'TobiasLongstaff', '2020-06-15 20:14:40', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(61, 'TobiasLongstaff', '2020-06-15 20:15:03', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(62, 'Admin', '2020-06-15 20:15:05', '', '', 0, '0000-00-00', 0, ''),
(63, 'TobiasLongstaff', '2020-06-15 20:15:11', '', '', 0, '0000-00-00', 0, ''),
(64, 'Admin', '2020-06-15 20:17:29', '', '', 0, '0000-00-00', 0, ''),
(65, 'TobiasLongstaff', '2020-06-15 20:22:16', '', '', 0, '0000-00-00', 0, ''),
(66, 'TobiasLongstaff', '2020-06-15 20:28:56', '', '', 0, '0000-00-00', 0, ''),
(67, 'TobiasLongstaff', '2020-06-16 16:03:48', 'Preparado', 'chacabuco 514', 1, '0000-00-00', 38, 'tobias'),
(68, 'TobiasLongstaff', '2020-06-15 20:33:20', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(69, 'TobiasLongstaff', '2020-06-15 20:34:12', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(70, 'TobiasLongstaff', '2020-06-15 20:34:20', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(71, 'TobiasLongstaff', '2020-06-16 19:06:15', 'Preparado', 'chacabuco 514', 1, '0000-00-00', 33, 'tobias'),
(72, 'TobiasLongstaff', '2020-06-16 19:10:06', 'Preparado', 'chacabuco 514', 1, '0000-00-00', 38, 'tobias'),
(73, 'TobiasLongstaff', '2020-06-16 19:16:31', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(74, 'TobiasLongstaff', '2020-06-27 12:12:10', 'Preparado', 'chacabuco 514', 1, '0000-00-00', 38, 'tobias'),
(75, 'TobiasLongstaff', '2020-06-16 19:18:50', '', 'chacabuco 514', 1, '0000-00-00', 0, 'tobias'),
(76, 'TobiasLongstaff', '2020-06-16 21:57:06', '', '', 0, '0000-00-00', 0, ''),
(77, 'TobiasLongstaff', '2020-06-16 21:58:20', '', '', 0, '0000-00-00', 0, ''),
(78, 'TobiasLongstaff', '2020-06-16 21:58:39', '', '', 0, '0000-00-00', 0, ''),
(79, 'TobiasLongstaff', '2020-06-16 21:58:41', '', '', 0, '0000-00-00', 0, ''),
(80, 'TobiasLongstaff', '2020-06-16 21:58:58', '', '', 0, '0000-00-00', 0, ''),
(81, 'TobiasLongstaff', '2020-06-16 22:00:37', '', '', 0, '0000-00-00', 0, ''),
(82, 'TobiasLongstaff', '2020-06-16 22:01:00', '', '', 0, '0000-00-00', 0, ''),
(83, 'TobiasLongstaff', '2020-06-16 22:01:32', '', '', 0, '0000-00-00', 0, ''),
(84, 'TobiasLongstaff', '2020-06-16 22:02:33', '', '', 0, '0000-00-00', 0, ''),
(85, 'TobiasLongstaff', '2020-06-16 22:02:49', '', '', 0, '0000-00-00', 0, ''),
(86, 'TobiasLongstaff', '2020-06-16 22:09:06', 'Cancelado', '', 0, '0000-00-00', 0, 'tobias'),
(87, 'TobiasLongstaff', '2020-06-16 22:21:30', 'Listo', 'chacabuco 514', 1, '0000-00-00', 66, 'tobias'),
(88, 'TobiasLongstaff', '2020-06-16 22:49:43', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(89, 'TobiasLongstaff', '2020-06-16 22:49:50', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(90, 'TobiasLongstaff', '2020-06-27 11:53:38', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(91, 'TobiasLongstaff', '2020-06-27 11:59:45', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(92, 'TobiasLongstaff', '2020-06-27 12:00:58', 'Listo', 'chacabuco 514', 1, '0000-00-00', 38, 'tobias'),
(93, 'TobiasLongstaff', '2020-06-27 12:11:10', 'Listo', 'Chacabuco 514', 1, '0000-00-00', 23, 'Tobias'),
(94, 'TobiasLongstaff', '2020-06-27 12:21:54', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(95, 'TobiasLongstaff', '2020-06-27 12:31:22', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(96, 'TobiasLongstaff', '2020-06-27 15:14:56', 'Cancelado', '', 1, '0000-00-00', 0, ''),
(97, 'TobiasLongstaff', '2020-06-27 23:36:05', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(98, 'Elpichulas44', '2020-06-27 23:51:18', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(99, 'Elpichulas44', '2020-06-27 23:52:39', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(100, 'TobiasLongstaff', '2020-06-27 23:54:51', '', '', 0, '0000-00-00', 0, ''),
(101, 'Elpichulas44', '2020-06-27 23:56:00', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(102, 'Elpichulas44', '2020-06-27 23:57:04', '', '', 0, '0000-00-00', 0, ''),
(103, 'TobiasLongstaff', '2020-06-27 23:57:12', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(104, 'TobiasLongstaff', '2020-06-27 23:59:57', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(105, 'TobiasLongstaff', '2020-06-28 00:00:04', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(106, 'TobiasLongstaff', '2020-06-28 00:00:10', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(107, 'TobiasLongstaff', '2020-06-28 00:01:09', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(108, 'TobiasLongstaff', '2020-06-28 00:01:26', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(109, 'TobiasLongstaff', '2020-06-28 00:01:37', '', 'chacabuco 514', 0, '0000-00-00', 0, ''),
(110, 'Elpichulas44', '2020-06-28 00:08:16', '', '', 0, '0000-00-00', 0, ''),
(111, 'Elpichulas44', '2020-06-28 00:10:06', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(112, 'Elpichulas44', '2020-06-28 00:10:18', '', '', 0, '0000-00-00', 0, 'Cabezon'),
(113, 'TobiasLongstaff', '2020-06-28 00:45:09', 'Cancelado', 'calle falsa 123', 0, '0000-00-00', 0, ''),
(114, 'Elpichulas44', '2020-06-28 00:44:39', '', '', 0, '0000-00-00', 0, ''),
(115, 'TobiasLongstaff', '2020-06-28 00:45:51', 'Cancelado', 'esta', 0, '0000-00-00', 0, ''),
(116, 'Tobiaslongstaff', '2020-06-28 18:04:26', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(117, 'Tobiaslongstaff', '2020-06-28 18:17:26', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(118, 'Elpichulas44', '2020-06-28 22:20:36', '', '', 0, '0000-00-00', 0, ''),
(119, 'TobiasLongstaff', '2020-06-28 22:21:39', 'Cancelado', '', 1, '0000-00-00', 0, 'Hola'),
(120, 'Carmo', '2020-06-28 22:25:40', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(121, 'Carmo', '2020-06-28 22:25:53', '', '', 0, '0000-00-00', 0, ''),
(122, 'TobiasLongstaff', '2020-06-28 22:31:01', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(123, 'TobiasLongstaff', '2020-06-28 22:31:03', '', '', 0, '0000-00-00', 0, ''),
(124, 'TobiasLongstaff', '2020-06-28 22:32:10', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(125, 'TobiasLongstaff', '2020-06-28 22:32:42', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(126, 'TobiasLongstaff', '2020-06-28 22:32:47', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(127, 'TobiasLongstaff', '2020-06-28 22:34:16', '', '', 1, '0000-00-00', 0, 'tobias'),
(128, 'Admin', '2020-06-28 22:55:20', '', '', 0, '0000-00-00', 0, 'tobias'),
(129, 'TobiasLongstaff', '2020-06-28 22:59:06', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(130, 'TobiasLongstaff', '2020-06-29 20:27:37', 'Listo', '', 1, '0000-00-00', 165, 'Prueba'),
(131, 'TobiasLongstaff', '2020-07-10 05:33:56', 'Cancelado', '', 1, '0000-00-00', 0, ''),
(132, 'Tobiaslongstaff', '2020-07-16 19:46:03', 'Cancelado', '', 0, '0000-00-00', 0, ''),
(133, 'Tobiaslongstaff', '2020-07-18 14:31:48', 'Cancelado', '', 0, '0000-00-00', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista`
--

CREATE TABLE `lista` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descuento` float NOT NULL,
  `condicionIva` float NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lista`
--

INSERT INTO `lista` (`id`, `id_producto`, `id_pedido`, `cantidad`, `descuento`, `condicionIva`, `descripcion`, `precio`) VALUES
(23, 4, 51, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(24, 4, 53, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(25, 13, 53, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(26, 4, 56, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(28, 4, 78, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(29, 4, 79, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(30, 4, 94, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(31, 4, 98, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(32, 4, 99, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(33, 4, 100, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(34, 4, 101, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(35, 4, 116, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(36, 4, 117, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(38, 4, 118, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(39, 13, 118, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(40, 4, 119, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(41, 4, 122, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(42, 13, 122, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(43, 21, 122, 1, 0, 21, 'YOGURTH GANDARA X 200', 23),
(45, 22, 122, 1, 0, 21, 'DULCE DE LECHE X 400 FORCINITTI', 62),
(46, 4, 123, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(47, 13, 123, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(48, 13, 123, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(49, 13, 123, 1, 0, 10.9, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(50, 4, 128, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(51, 13, 128, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(52, 4, 128, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(53, 4, 129, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(54, 4, 134, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(55, 4, 137, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(56, 4, 3, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(57, 21, 3, 1, 0, 21, 'YOGURTH GANDARA X 200', 23),
(58, 13, 4, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(59, 4, 54, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(60, 4, 55, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(61, 4, 55, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(62, 4, 55, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(63, 4, 67, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(64, 13, 71, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(65, 4, 72, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(66, 4, 74, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(67, 4, 75, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(70, 13, 87, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(71, 13, 87, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(72, 4, 92, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(73, 21, 93, 1, 0, 21, 'YOGURTH GANDARA X 200', 23),
(74, 4, 109, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(75, 13, 113, 3879, 0, 0, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(76, 22, 115, 99991, 0, 21, 'DULCE DE LECHE X 400 FORCINITTI', 62),
(77, 4, 115, 0, 0, 0, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(78, 4, 130, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(79, 13, 130, 2, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(80, 21, 130, 1, 0, 21, 'YOGURTH GANDARA X 200', 23),
(81, 4, 130, 1, 0, 0, 'DULCE DE LECHE X 250 FORCINITTI', 38);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_preparar`
--

CREATE TABLE `lista_preparar` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descuento` float NOT NULL,
  `condicionIva` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lista_preparar`
--

INSERT INTO `lista_preparar` (`id`, `id_producto`, `id_pedido`, `cantidad`, `descuento`, `condicionIva`, `descripcion`, `precio`) VALUES
(83, 4, 51, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(84, 4, 53, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(85, 13, 53, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(93, 4, 56, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(94, 4, 57, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(95, 4, 78, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(96, 4, 79, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(97, 4, 94, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(98, 4, 98, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(99, 4, 99, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(105, 4, 100, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(109, 4, 101, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(113, 21, 116, 1, 0, 21, 'YOGURTH GANDARA X 200', 23),
(114, 4, 117, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(115, 4, 118, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(116, 4, 118, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(117, 13, 118, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(118, 4, 119, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(119, 4, 116, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(120, 4, 122, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(121, 13, 122, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(122, 21, 122, 1, 0, 21, 'YOGURTH GANDARA X 200', 23),
(123, 21, 122, 1, 0, 21, 'YOGURTH GANDARA X 200', 23),
(125, 4, 123, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(126, 13, 123, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(127, 13, 123, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(128, 13, 123, 1, 0, 11, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(129, 4, 128, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(130, 13, 128, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(131, 4, 128, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(132, 4, 129, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(133, 4, 134, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(134, 4, 137, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(135, 4, 3, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(136, 21, 3, 1, 0, 21, 'YOGURTH GANDARA X 200', 23),
(138, 4, 54, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(139, 4, 55, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(140, 4, 55, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(141, 4, 55, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(196, 4, 4, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(203, 4, 71, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(204, 4, 4, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(205, 13, 71, 3, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(206, 4, 71, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(207, 4, 4, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(208, 4, 72, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(209, 13, 72, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(210, 21, 72, 1, 0, 21, 'YOGURTH GANDARA X 200', 23),
(211, 21, 74, 1, 0, 21, 'YOGURTH GANDARA X 200', 23),
(212, 4, 75, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(213, 4, 87, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(214, 21, 87, 1, 0, 21, 'YOGURTH GANDARA X 200', 23),
(215, 13, 87, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(216, 13, 87, 1, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(217, 4, 92, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(218, 21, 93, 1, 0, 21, 'YOGURTH GANDARA X 200', 23),
(219, 4, 109, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(220, 13, 113, 3879, 0, 0, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(221, 22, 115, 99991, 0, 21, 'DULCE DE LECHE X 400 FORCINITTI', 62),
(222, 4, 115, 0, 0, 0, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(223, 4, 130, 1, 0, 21, 'DULCE DE LECHE X 250 FORCINITTI', 38),
(224, 13, 130, 2, 0, 21, 'LECHE SACHET X 1 LT SUIPACHENSE', 33),
(225, 21, 130, 1, 0, 21, 'YOGURTH GANDARA X 200', 23),
(226, 4, 130, 1, 0, 0, 'DULCE DE LECHE X 250 FORCINITTI', 38);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `precioMinorista` decimal(65,0) NOT NULL,
  `precioMayorista` decimal(65,0) NOT NULL,
  `precioMasivo` decimal(65,0) NOT NULL,
  `iva` decimal(3,0) NOT NULL,
  `codigo` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `descripcion`, `precioMinorista`, `precioMayorista`, `precioMasivo`, `iva`, `codigo`) VALUES
(4, 'DULCE DE LECHE X 250 FORCINITTI', '38', '38', '38', '21', '00001'),
(13, 'LECHE SACHET X 1 LT SUIPACHENSE', '33', '33', '33', '21', '00025'),
(21, 'YOGURTH GANDARA X 200', '23', '23', '23', '21', '00046'),
(22, 'DULCE DE LECHE X 400 FORCINITTI', '62', '62', '62', '21', '00003');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `password`, `nivel`) VALUES
(1, 'Admin', '$2y$10$8.9k5HzgreqhPtnPdv5T9OVOXyZmKVwyPD4vszYXENLas.84wVWUu', 1),
(2, 'TobiasLongstaff', '$2y$10$v5riFWnbnLVo9foDs.D1Zuy5EDjo/B5TnHQxbwvGbW0eeYXWPV96O', 1),
(3, 'Usuario2', '$2y$10$t.fg/sPFag.sIQCrUMoqDOoE1LledlrnyfPpUm6igFialnJpjyrMi', 2),
(4, 'Usuario3', '$2y$10$xBEEJf3xetWqaAgo8xAjdeNsiWD27WPVHcSmLlk9UYk0wCD.8AZc.', 3),
(5, 'Usuario4', '$2y$10$yyDPlslueLWY2AhPJw4Xu.pxKC3Zw7opAW4Pppf/6Y/Mq3ozggGaa', 4),
(7, 'ElPichulas44', '$2y$10$h.LVnekkK/0nmnOSQxoXou6241SpeMiycWmWIGbjiQQDg5VhR/tiW', 1),
(8, 'Carmo', '$2y$10$L329b5rK2ycWNWlol3JbCuIvffbd0o0D0bBe3v5N3zQmEt.ZQuIQ6', 1),
(9, 'Facu', '$2y$10$WDt.puzzG1vS94MU99LnNOQsmE49NAzumM1NYHXXOUPmN7ITH1M3W', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `id_pedido`
--
ALTER TABLE `id_pedido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lista`
--
ALTER TABLE `lista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lista_preparar`
--
ALTER TABLE `lista_preparar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `id_pedido`
--
ALTER TABLE `id_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT de la tabla `lista`
--
ALTER TABLE `lista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `lista_preparar`
--
ALTER TABLE `lista_preparar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
