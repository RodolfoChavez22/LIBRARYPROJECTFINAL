-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2022 at 04:44 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `Audit_id` int(11) NOT NULL,
  `Type` varchar(60) NOT NULL,
  `Type_id` int(11) NOT NULL,
  `Action` varchar(60) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`Audit_id`, `Type`, `Type_id`, `Action`, `Date`) VALUES
(1, 'user', 1, 'INSERT', '2022-04-18 03:22:32'),
(2, 'book', 1, 'INSERT', '2022-04-18 03:37:41'),
(3, 'book', 2, 'INSERT', '2022-04-18 03:42:36'),
(4, 'book', 3, 'INSERT', '2022-04-18 03:46:39'),
(5, 'book', 4, 'INSERT', '2022-04-18 03:51:16'),
(6, 'book', 5, 'INSERT', '2022-04-18 04:13:23'),
(7, 'book', 6, 'INSERT', '2022-04-18 04:18:55'),
(8, 'book', 7, 'INSERT', '2022-04-18 04:21:35'),
(9, 'book', 7, 'UPDATE', '2022-04-18 04:22:03'),
(10, 'user', 1, 'UPDATE', '2022-04-18 04:22:03'),
(11, 'book', 8, 'INSERT', '2022-04-18 04:27:04'),
(12, 'book', 9, 'INSERT', '2022-04-18 04:31:18'),
(13, 'book', 10, 'INSERT', '2022-04-18 04:33:32'),
(14, 'book', 11, 'INSERT', '2022-04-18 04:36:21'),
(15, 'book', 12, 'INSERT', '2022-04-18 04:40:47'),
(16, 'book', 13, 'INSERT', '2022-04-18 04:42:45'),
(17, 'book', 14, 'INSERT', '2022-04-18 04:46:09'),
(18, 'book', 15, 'INSERT', '2022-04-18 04:50:04'),
(19, 'book', 16, 'INSERT', '2022-04-18 04:52:26'),
(20, 'book', 17, 'INSERT', '2022-04-18 04:54:13'),
(21, 'book', 18, 'INSERT', '2022-04-18 04:56:38'),
(22, 'book', 19, 'INSERT', '2022-04-18 04:58:25'),
(23, 'book', 20, 'INSERT', '2022-04-18 05:00:19'),
(24, 'journal', 1, 'INSERT', '2022-04-18 05:29:12'),
(25, 'journal', 2, 'INSERT', '2022-04-18 05:32:58'),
(26, 'journal', 3, 'INSERT', '2022-04-18 05:37:49'),
(27, 'journal', 4, 'INSERT', '2022-04-18 05:43:32'),
(28, 'journal', 5, 'INSERT', '2022-04-18 05:46:13'),
(29, 'journal', 6, 'INSERT', '2022-04-18 05:50:21'),
(30, 'journal', 7, 'INSERT', '2022-04-18 05:53:11'),
(31, 'journal', 8, 'INSERT', '2022-04-18 05:55:50'),
(32, 'journal', 9, 'INSERT', '2022-04-18 05:57:55'),
(33, 'journal', 9, 'UPDATE', '2022-04-18 06:00:57'),
(34, 'journal', 9, 'UPDATE', '2022-04-18 06:01:22'),
(35, 'journal', 10, 'INSERT', '2022-04-18 06:03:28'),
(36, 'disk', 1, 'INSERT', '2022-04-18 06:21:49'),
(37, 'disk', 2, 'INSERT', '2022-04-18 06:26:47'),
(38, 'disk', 3, 'INSERT', '2022-04-18 06:30:42'),
(39, 'electronic', 1, 'INSERT', '2022-04-18 06:34:24'),
(40, 'electronic', 2, 'INSERT', '2022-04-18 06:38:12'),
(41, 'book', 1, 'DELETE', '2022-04-18 01:52:44'),
(42, 'journal', 1, 'DELETE', '2022-04-18 01:54:32'),
(43, 'disk', 2, 'DELETE', '2022-04-18 01:54:37'),
(44, 'electronic', 2, 'DELETE', '2022-04-18 01:54:40'),
(45, 'user', 3, 'INSERT', '2022-04-18 03:31:38'),
(46, 'user', 3, 'DELETE', '2022-04-18 03:31:46'),
(47, 'electronic', 1, 'UPDATE', '2022-04-18 03:35:18'),
(48, 'electronic', 2, 'DELETE', '2022-04-18 03:35:29'),
(49, 'book', 2, 'DELETE', '2022-04-18 04:20:18'),
(50, 'book', 4, 'DELETE', '2022-04-18 04:20:19'),
(51, 'book', 5, 'DELETE', '2022-04-18 04:20:20'),
(52, 'book', 6, 'DELETE', '2022-04-18 04:20:21'),
(53, 'book', 7, 'DELETE', '2022-04-18 04:20:22'),
(54, 'book', 8, 'DELETE', '2022-04-18 04:20:22'),
(55, 'book', 9, 'DELETE', '2022-04-18 04:20:23'),
(56, 'book', 10, 'DELETE', '2022-04-18 04:20:24'),
(57, 'book', 11, 'DELETE', '2022-04-18 04:20:24'),
(58, 'book', 12, 'DELETE', '2022-04-18 04:20:25'),
(59, 'book', 13, 'DELETE', '2022-04-18 04:20:25'),
(60, 'book', 14, 'DELETE', '2022-04-18 04:20:26'),
(61, 'book', 15, 'DELETE', '2022-04-18 04:20:27'),
(62, 'book', 16, 'DELETE', '2022-04-18 04:20:28'),
(63, 'journal', 1, 'UPDATE', '2022-04-18 05:12:11'),
(64, 'book', 1, 'UPDATE', '2022-04-18 05:12:18'),
(65, 'disk', 1, 'UPDATE', '2022-04-18 07:03:00'),
(66, 'disk', 1, 'UPDATE', '2022-04-18 07:03:58'),
(67, 'journal', 1, 'UPDATE', '2022-04-18 07:04:23'),
(68, 'electronic', 1, 'UPDATE', '2022-04-18 07:05:34'),
(69, 'disk', 1, 'UPDATE', '2022-04-18 07:06:03'),
(70, 'disk', 2, 'UPDATE', '2022-04-18 07:13:51'),
(71, 'book', 10, 'UPDATE', '2022-04-18 14:12:47'),
(72, 'user', 3, 'UPDATE', '2022-04-18 14:12:49'),
(73, 'book', 2, 'UPDATE', '2022-04-18 14:12:52'),
(74, 'book', 4, 'UPDATE', '2022-04-18 14:12:53'),
(75, 'book', 8, 'UPDATE', '2022-04-18 14:12:55'),
(76, 'book', 9, 'UPDATE', '2022-04-18 14:12:56'),
(77, 'book', 6, 'UPDATE', '2022-04-18 14:12:58'),
(78, 'book', 5, 'UPDATE', '2022-04-18 14:12:59'),
(79, 'electronic', 2, 'UPDATE', '2022-04-18 14:13:00'),
(80, 'book', 16, 'UPDATE', '2022-04-18 14:13:02'),
(81, 'book', 14, 'UPDATE', '2022-04-18 14:13:03'),
(82, 'book', 12, 'UPDATE', '2022-04-18 14:13:04'),
(83, 'book', 11, 'UPDATE', '2022-04-18 14:13:05'),
(84, 'book', 7, 'UPDATE', '2022-04-18 14:13:07'),
(85, 'book', 15, 'UPDATE', '2022-04-18 14:13:11'),
(86, 'book', 13, 'UPDATE', '2022-04-18 14:23:20'),
(87, 'disk', 1, 'DELETE', '2022-04-18 14:24:24'),
(88, 'disk', 1, 'UPDATE', '2022-04-18 14:24:35'),
(89, 'book', 1, 'DELETE', '2022-04-18 14:25:19'),
(90, 'book', 1, 'UPDATE', '2022-04-18 14:25:22'),
(91, 'user', 3, 'DELETE', '2022-04-18 14:27:18'),
(92, 'user', 3, 'UPDATE', '2022-04-18 14:27:21'),
(93, 'book', 2, 'DELETE', '2022-04-18 14:28:32'),
(94, 'book', 2, 'UPDATE', '2022-04-18 14:28:35'),
(95, 'journal', 1, 'DELETE', '2022-04-18 14:34:04'),
(96, 'journal', 1, 'UPDATE', '2022-04-18 14:34:08'),
(97, 'book', 1, 'DELETE', '2022-04-18 15:17:48'),
(98, 'user', 3, 'DELETE', '2022-04-18 16:27:23'),
(99, 'user', 3, 'UPDATE', '2022-04-18 16:27:29'),
(100, 'book', 1, 'UPDATE', '2022-04-18 16:27:45'),
(101, 'book', 9, 'UPDATE', '2022-04-18 16:29:01'),
(102, 'user', 1, 'UPDATE', '2022-04-18 16:29:01'),
(103, 'user', 3, 'DELETE', '2022-04-18 16:29:33'),
(104, 'user', 3, 'UPDATE', '2022-04-18 16:29:45'),
(105, 'user', 3, 'UPDATE', '2022-04-18 17:10:41'),
(106, 'user', 3, 'UPDATE', '2022-04-18 17:23:59'),
(107, 'user', 3, 'DELETE', '2022-04-18 17:24:02'),
(108, 'user', 3, 'UPDATE', '2022-04-18 17:24:05'),
(109, 'user', 3, 'DELETE', '2022-04-18 17:28:12'),
(110, 'user', 3, 'UPDATE', '2022-04-18 17:28:17'),
(111, 'user', 3, 'UPDATE', '2022-04-18 17:28:23'),
(112, 'user', 3, 'DELETE', '2022-04-18 17:28:38'),
(113, 'user', 3, 'UPDATE', '2022-04-18 17:28:48'),
(114, 'user', 3, 'UPDATE', '2022-04-18 17:28:55'),
(115, 'user', 4, 'INSERT', '2022-04-18 17:33:30'),
(116, 'user', 5, 'INSERT', '2022-04-18 17:34:19'),
(117, 'user', 6, 'INSERT', '2022-04-18 17:35:31'),
(118, 'user', 7, 'INSERT', '2022-04-18 17:36:22'),
(119, 'user', 8, 'INSERT', '2022-04-18 17:37:10'),
(120, 'user', 9, 'INSERT', '2022-04-18 17:38:04'),
(121, 'user', 10, 'INSERT', '2022-04-18 17:38:50'),
(122, 'user', 11, 'INSERT', '2022-04-18 17:39:39'),
(123, 'user', 12, 'INSERT', '2022-04-18 17:40:24'),
(124, 'user', 9, 'DELETE', '2022-04-18 17:53:49'),
(125, 'electronic', 2, 'DELETE', '2022-04-18 20:45:50'),
(126, 'user', 9, 'UPDATE', '2022-04-18 20:45:57'),
(127, 'electronic', 2, 'UPDATE', '2022-04-18 20:45:58'),
(128, 'electronic', 1, 'UPDATE', '2022-04-18 20:59:37'),
(129, 'electronic', 1, 'DELETE', '2022-04-18 20:59:43'),
(130, 'electronic', 1, 'UPDATE', '2022-04-18 20:59:49'),
(131, 'disk', 1, 'DELETE', '2022-04-18 21:45:42'),
(132, 'disk', 1, 'UPDATE', '2022-04-18 21:45:46'),
(133, 'disk', 1, 'UPDATE', '2022-04-18 21:46:39'),
(134, 'disk', 2, 'DELETE', '2022-04-18 21:46:59'),
(135, 'disk', 2, 'UPDATE', '2022-04-18 21:47:11'),
(136, 'disk', 3, 'UPDATE', '2022-04-18 22:15:55'),
(137, 'disk', 1, 'DELETE', '2022-04-18 22:15:58'),
(138, 'disk', 1, 'UPDATE', '2022-04-18 22:16:01'),
(139, 'disk', 2, 'UPDATE', '2022-04-18 22:50:48'),
(140, 'book', 3, 'UPDATE', '2022-04-19 00:08:14'),
(141, 'book', 10, 'DELETE', '2022-04-19 00:08:21'),
(142, 'book', 10, 'UPDATE', '2022-04-19 00:08:25'),
(143, 'book', 1, 'DELETE', '2022-04-19 00:12:43'),
(144, 'book', 1, 'UPDATE', '2022-04-19 00:12:47'),
(145, 'journal', 4, 'UPDATE', '2022-04-19 01:22:22'),
(146, 'journal', 10, 'DELETE', '2022-04-19 01:22:26'),
(147, 'journal', 10, 'UPDATE', '2022-04-19 01:22:30'),
(148, 'journal', 8, 'DELETE', '2022-04-19 01:33:23'),
(149, 'journal', 1, 'UPDATE', '2022-04-19 01:33:28'),
(150, 'journal', 8, 'UPDATE', '2022-04-19 01:33:36'),
(151, 'disk', 2, 'DELETE', '2022-04-19 01:33:40'),
(152, 'disk', 2, 'UPDATE', '2022-04-19 01:33:57'),
(153, 'book', 9, 'UPDATE', '2022-04-19 02:21:55'),
(154, 'user', 1, 'UPDATE', '2022-04-19 02:21:55'),
(155, 'book', 9, 'UPDATE', '2022-04-19 12:41:27'),
(156, 'user', 1, 'UPDATE', '2022-04-19 12:41:27'),
(157, 'user', 1, 'UPDATE', '2022-04-19 13:59:39'),
(158, 'user', 1, 'UPDATE', '2022-04-19 14:03:15'),
(159, 'book', 9, 'UPDATE', '2022-04-19 14:04:57'),
(160, 'user', 1, 'UPDATE', '2022-04-19 14:04:57'),
(161, 'book', 10, 'UPDATE', '2022-04-19 14:06:20'),
(162, 'user', 1, 'UPDATE', '2022-04-19 14:06:20'),
(163, 'book', 15, 'UPDATE', '2022-04-19 14:09:28'),
(164, 'user', 1, 'UPDATE', '2022-04-19 14:09:28'),
(165, 'book', 7, 'UPDATE', '2022-04-19 14:13:07'),
(166, 'user', 1, 'UPDATE', '2022-04-19 14:13:07'),
(167, 'book', 10, 'UPDATE', '2022-04-19 14:18:04'),
(168, 'user', 1, 'UPDATE', '2022-04-19 14:18:04'),
(169, 'journal', 6, 'UPDATE', '2022-04-19 14:23:33'),
(170, 'user', 1, 'UPDATE', '2022-04-19 14:23:33'),
(171, 'journal', 5, 'UPDATE', '2022-04-19 14:34:19'),
(172, 'user', 1, 'UPDATE', '2022-04-19 14:34:19'),
(173, 'journal', 5, 'UPDATE', '2022-04-19 14:34:25'),
(174, 'user', 1, 'UPDATE', '2022-04-19 14:34:25'),
(175, 'journal', 1, 'UPDATE', '2022-04-19 14:34:33'),
(176, 'user', 1, 'UPDATE', '2022-04-19 14:34:33'),
(177, 'journal', 1, 'UPDATE', '2022-04-19 14:34:42'),
(178, 'user', 1, 'UPDATE', '2022-04-19 14:34:42'),
(179, 'disk', 3, 'UPDATE', '2022-04-19 14:39:30'),
(180, 'user', 1, 'UPDATE', '2022-04-19 14:39:30'),
(181, 'disk', 1, 'UPDATE', '2022-04-19 14:39:36'),
(182, 'disk', 2, 'UPDATE', '2022-04-19 14:39:36'),
(183, 'disk', 3, 'UPDATE', '2022-04-19 14:39:36'),
(184, 'user', 1, 'UPDATE', '2022-04-19 14:39:36'),
(185, 'journal', 6, 'UPDATE', '2022-04-19 14:41:25'),
(186, 'user', 1, 'UPDATE', '2022-04-19 14:41:25'),
(187, 'book', 15, 'UPDATE', '2022-04-19 14:46:40'),
(188, 'user', 1, 'UPDATE', '2022-04-19 14:46:40'),
(189, 'journal', 2, 'UPDATE', '2022-04-19 14:46:42'),
(190, 'user', 1, 'UPDATE', '2022-04-19 14:46:42'),
(191, 'disk', 1, 'UPDATE', '2022-04-19 14:46:49'),
(192, 'user', 1, 'UPDATE', '2022-04-19 14:46:49'),
(193, 'book', 7, 'UPDATE', '2022-04-19 15:15:21'),
(194, 'user', 1, 'UPDATE', '2022-04-19 15:15:21'),
(195, 'book', 2, 'UPDATE', '2022-04-19 15:16:06'),
(196, 'user', 1, 'UPDATE', '2022-04-19 15:16:06'),
(197, 'book', 2, 'UPDATE', '2022-04-19 15:16:21'),
(198, 'user', 1, 'UPDATE', '2022-04-19 15:16:21'),
(199, 'book', 7, 'UPDATE', '2022-04-19 15:42:25'),
(200, 'user', 1, 'UPDATE', '2022-04-19 15:42:25'),
(201, 'user', 13, 'INSERT', '2022-04-19 15:52:08'),
(202, 'book', 15, 'UPDATE', '2022-04-19 15:52:57'),
(203, 'user', 13, 'UPDATE', '2022-04-19 15:52:57'),
(204, 'journal', 6, 'UPDATE', '2022-04-19 16:37:44'),
(205, 'user', 1, 'UPDATE', '2022-04-19 16:37:44'),
(206, 'user', 14, 'INSERT', '2022-04-19 16:38:54'),
(207, 'electronic', 2, 'UPDATE', '2022-04-19 16:39:18'),
(208, 'user', 14, 'UPDATE', '2022-04-19 16:39:18'),
(209, 'disk', 3, 'UPDATE', '2022-04-21 06:49:22'),
(210, 'user', 1, 'UPDATE', '2022-04-21 06:49:22'),
(211, 'book', 15, 'UPDATE', '2022-04-21 06:49:56'),
(212, 'user', 1, 'UPDATE', '2022-04-21 06:49:56'),
(213, 'book', 15, 'UPDATE', '2022-04-21 06:50:25'),
(214, 'user', 1, 'UPDATE', '2022-04-21 06:50:25'),
(215, 'user', 1, 'UPDATE', '2022-04-22 17:07:01'),
(216, 'user', 1, 'UPDATE', '2022-04-22 17:07:20'),
(217, 'book', 2, 'UPDATE', '2022-04-22 17:07:48'),
(218, 'user', 1, 'UPDATE', '2022-04-22 17:07:48'),
(219, 'user', 1, 'UPDATE', '2022-04-22 17:10:59'),
(220, 'book', 14, 'UPDATE', '2022-04-22 17:11:15'),
(221, 'user', 1, 'UPDATE', '2022-04-22 17:11:15'),
(222, 'book', 14, 'UPDATE', '2022-04-22 17:11:36'),
(223, 'user', 1, 'UPDATE', '2022-04-22 17:11:36'),
(224, 'book', 14, 'UPDATE', '2022-04-22 17:11:55'),
(225, 'user', 1, 'UPDATE', '2022-04-22 17:11:55'),
(226, 'book', 14, 'UPDATE', '2022-04-22 17:13:55'),
(227, 'user', 1, 'UPDATE', '2022-04-22 17:13:55'),
(228, 'book', 14, 'UPDATE', '2022-04-22 17:14:01'),
(229, 'user', 1, 'UPDATE', '2022-04-22 17:14:01'),
(230, 'disk', 3, 'UPDATE', '2022-04-23 01:53:36'),
(231, 'user', 1, 'UPDATE', '2022-04-23 01:53:36'),
(232, 'book', 9, 'UPDATE', '2022-04-23 01:55:46'),
(233, 'user', 1, 'UPDATE', '2022-04-23 01:55:46'),
(234, 'disk', 3, 'UPDATE', '2022-04-23 01:56:09'),
(235, 'user', 1, 'UPDATE', '2022-04-23 01:56:09'),
(236, 'user', 1, 'UPDATE', '2022-04-23 01:56:31'),
(237, 'user', 1, 'UPDATE', '2022-04-23 01:56:37'),
(238, 'book', 15, 'UPDATE', '2022-04-23 01:58:03'),
(239, 'user', 1, 'UPDATE', '2022-04-23 01:58:03'),
(240, 'book', 16, 'UPDATE', '2022-04-23 02:57:21'),
(241, 'user', 1, 'UPDATE', '2022-04-23 02:57:21'),
(252, 'book', 15, 'UPDATE', '2022-04-23 03:12:29'),
(253, 'user', 1, 'UPDATE', '2022-04-23 03:12:29'),
(254, 'book', 15, 'UPDATE', '2022-04-23 03:12:55'),
(255, 'user', 1, 'UPDATE', '2022-04-23 03:12:55'),
(256, 'book', 15, 'UPDATE', '2022-04-23 03:13:07'),
(257, 'user', 1, 'UPDATE', '2022-04-23 03:13:07'),
(258, 'book', 10, 'UPDATE', '2022-04-23 03:18:53'),
(259, 'user', 1, 'UPDATE', '2022-04-23 03:18:53'),
(260, 'book', 15, 'UPDATE', '2022-04-23 03:18:53'),
(261, 'user', 1, 'UPDATE', '2022-04-23 03:18:53'),
(262, 'book', 7, 'UPDATE', '2022-04-23 03:18:53'),
(263, 'user', 1, 'UPDATE', '2022-04-23 03:18:53'),
(264, 'book', 2, 'UPDATE', '2022-04-23 03:18:53'),
(265, 'user', 1, 'UPDATE', '2022-04-23 03:18:53'),
(266, 'book', 2, 'UPDATE', '2022-04-23 03:18:53'),
(267, 'user', 1, 'UPDATE', '2022-04-23 03:18:53'),
(268, 'book', 7, 'UPDATE', '2022-04-23 03:18:53'),
(269, 'user', 1, 'UPDATE', '2022-04-23 03:18:53'),
(270, 'book', 15, 'UPDATE', '2022-04-23 03:18:53'),
(271, 'user', 13, 'UPDATE', '2022-04-23 03:18:53'),
(272, 'book', 15, 'UPDATE', '2022-04-23 03:18:53'),
(273, 'user', 1, 'UPDATE', '2022-04-23 03:18:53'),
(274, 'book', 15, 'UPDATE', '2022-04-23 03:18:53'),
(275, 'user', 1, 'UPDATE', '2022-04-23 03:18:53'),
(276, 'book', 2, 'UPDATE', '2022-04-23 03:18:53'),
(277, 'user', 1, 'UPDATE', '2022-04-23 03:18:53'),
(280, 'book', 14, 'UPDATE', '2022-04-23 03:19:10'),
(281, 'user', 1, 'UPDATE', '2022-04-23 03:19:10'),
(282, 'book', 9, 'UPDATE', '2022-04-23 03:19:10'),
(283, 'user', 1, 'UPDATE', '2022-04-23 03:19:10'),
(284, 'user', 1, 'UPDATE', '2022-04-23 03:19:30'),
(285, 'user', 3, 'UPDATE', '2022-04-23 03:19:36'),
(286, 'user', 14, 'UPDATE', '2022-04-23 03:19:43'),
(287, 'book', 10, 'UPDATE', '2022-04-23 03:19:59'),
(288, 'user', 1, 'UPDATE', '2022-04-23 03:19:59'),
(289, 'book', 10, 'UPDATE', '2022-04-23 03:24:33'),
(290, 'user', 1, 'UPDATE', '2022-04-23 03:24:33'),
(291, 'book', 10, 'UPDATE', '2022-04-23 03:32:28'),
(292, 'user', 1, 'UPDATE', '2022-04-23 03:32:28'),
(293, 'book', 15, 'UPDATE', '2022-04-23 04:06:57'),
(294, 'user', 1, 'UPDATE', '2022-04-23 04:06:57'),
(295, 'electronic', 2, 'UPDATE', '2022-04-23 04:09:48'),
(296, 'user', 1, 'UPDATE', '2022-04-23 04:09:48'),
(297, 'journal', 5, 'UPDATE', '2022-04-23 04:10:03'),
(298, 'user', 1, 'UPDATE', '2022-04-23 04:10:03'),
(299, 'disk', 2, 'UPDATE', '2022-04-23 04:10:21'),
(300, 'user', 1, 'UPDATE', '2022-04-23 04:10:21'),
(301, 'book', 15, 'UPDATE', '2022-04-23 04:14:23'),
(302, 'user', 1, 'UPDATE', '2022-04-23 04:14:23'),
(303, 'book', 10, 'UPDATE', '2022-04-23 04:15:00'),
(304, 'user', 1, 'UPDATE', '2022-04-23 04:15:00'),
(305, 'disk', 2, 'UPDATE', '2022-04-23 04:15:22'),
(306, 'user', 1, 'UPDATE', '2022-04-23 04:15:22'),
(307, 'disk', 1, 'UPDATE', '2022-04-23 04:20:51'),
(308, 'disk', 2, 'UPDATE', '2022-04-23 04:20:51'),
(309, 'disk', 3, 'UPDATE', '2022-04-23 04:20:51'),
(310, 'user', 1, 'UPDATE', '2022-04-23 04:20:51'),
(311, 'journal', 5, 'UPDATE', '2022-04-23 04:21:09'),
(312, 'user', 1, 'UPDATE', '2022-04-23 04:21:09'),
(313, 'journal', 5, 'UPDATE', '2022-04-23 04:21:18'),
(314, 'user', 1, 'UPDATE', '2022-04-23 04:21:18'),
(315, 'disk', 2, 'UPDATE', '2022-04-23 04:21:32'),
(316, 'user', 1, 'UPDATE', '2022-04-23 04:21:32'),
(317, 'disk', 1, 'UPDATE', '2022-04-23 04:21:36'),
(318, 'disk', 2, 'UPDATE', '2022-04-23 04:21:36'),
(319, 'disk', 3, 'UPDATE', '2022-04-23 04:21:36'),
(320, 'user', 1, 'UPDATE', '2022-04-23 04:21:36'),
(321, 'electronic', 1, 'UPDATE', '2022-04-23 04:21:48'),
(322, 'user', 1, 'UPDATE', '2022-04-23 04:21:48'),
(323, 'electronic', 1, 'UPDATE', '2022-04-23 04:21:54'),
(324, 'user', 1, 'UPDATE', '2022-04-23 04:21:54'),
(325, 'book', 15, 'UPDATE', '2022-04-23 04:42:06'),
(326, 'user', 1, 'UPDATE', '2022-04-23 04:42:06'),
(327, 'book', 15, 'UPDATE', '2022-04-23 04:42:16'),
(328, 'user', 1, 'UPDATE', '2022-04-23 04:42:16'),
(329, 'book', 10, 'UPDATE', '2022-04-23 05:15:52'),
(330, 'user', 1, 'UPDATE', '2022-04-23 05:15:52'),
(333, 'book', 10, 'UPDATE', '2022-04-23 05:17:13'),
(334, 'user', 1, 'UPDATE', '2022-04-23 05:17:13'),
(335, 'book', 10, 'UPDATE', '2022-04-23 05:17:27'),
(336, 'user', 1, 'UPDATE', '2022-04-23 05:17:27'),
(339, 'book', 10, 'UPDATE', '2022-04-23 05:36:48'),
(340, 'user', 1, 'UPDATE', '2022-04-23 05:36:48'),
(341, 'user', 1, 'UPDATE', '2022-04-23 06:10:57'),
(342, 'user', 1, 'UPDATE', '2022-04-23 06:13:13'),
(343, 'user', 1, 'UPDATE', '2022-04-23 06:15:50'),
(344, 'user', 1, 'UPDATE', '2022-04-24 01:33:14'),
(345, 'book', 10, 'UPDATE', '2022-04-24 01:33:34'),
(346, 'user', 1, 'UPDATE', '2022-04-24 01:33:34'),
(347, 'user', 1, 'UPDATE', '2022-04-24 01:33:45'),
(348, 'book', 10, 'UPDATE', '2022-04-24 01:34:56'),
(349, 'user', 1, 'UPDATE', '2022-04-24 01:34:56'),
(350, 'book', 10, 'UPDATE', '2022-04-24 01:36:15'),
(351, 'user', 1, 'UPDATE', '2022-04-24 01:36:15'),
(352, 'user', 1, 'UPDATE', '2022-04-24 01:36:17'),
(353, 'user', 1, 'UPDATE', '2022-04-24 01:36:18'),
(354, 'user', 1, 'UPDATE', '2022-04-24 01:37:11'),
(355, 'book', 10, 'UPDATE', '2022-04-24 01:37:11'),
(356, 'user', 1, 'UPDATE', '2022-04-24 01:37:11'),
(357, 'user', 1, 'UPDATE', '2022-04-24 01:45:48'),
(358, 'user', 1, 'UPDATE', '2022-04-24 01:46:03'),
(359, 'book', 10, 'UPDATE', '2022-04-24 01:46:10'),
(360, 'user', 1, 'UPDATE', '2022-04-24 01:46:10'),
(361, 'user', 1, 'UPDATE', '2022-04-24 01:46:12'),
(363, 'user', 1, 'UPDATE', '2022-04-24 02:03:23'),
(364, 'book', 10, 'UPDATE', '2022-04-24 02:03:23'),
(365, 'user', 1, 'UPDATE', '2022-04-24 02:03:23'),
(366, 'book', 10, 'UPDATE', '2022-04-24 02:10:46'),
(367, 'user', 1, 'UPDATE', '2022-04-24 02:10:46'),
(368, 'book', 10, 'UPDATE', '2022-04-24 02:13:18'),
(369, 'user', 1, 'UPDATE', '2022-04-24 02:13:18'),
(370, 'book', 10, 'UPDATE', '2022-04-24 02:21:20'),
(371, 'user', 1, 'UPDATE', '2022-04-24 02:21:20'),
(372, 'book', 10, 'UPDATE', '2022-04-24 02:36:36'),
(373, 'user', 1, 'UPDATE', '2022-04-24 02:36:36'),
(374, 'book', 10, 'UPDATE', '2022-04-24 02:38:43'),
(375, 'user', 1, 'UPDATE', '2022-04-24 02:38:43'),
(376, 'user', 1, 'UPDATE', '2022-04-24 02:54:55'),
(385, 'book', 10, 'UPDATE', '2022-04-24 03:30:06'),
(386, 'user', 1, 'UPDATE', '2022-04-24 03:30:06'),
(387, 'user', 1, 'UPDATE', '2022-04-24 03:30:21'),
(388, 'book', 10, 'UPDATE', '2022-04-24 03:30:39'),
(389, 'user', 1, 'UPDATE', '2022-04-24 03:30:39'),
(390, 'disk', 3, 'UPDATE', '2022-04-24 03:30:41'),
(391, 'user', 1, 'UPDATE', '2022-04-24 03:30:41'),
(392, 'book', 10, 'UPDATE', '2022-04-24 03:31:53'),
(393, 'user', 1, 'UPDATE', '2022-04-24 03:31:53'),
(394, 'disk', 1, 'UPDATE', '2022-04-24 03:31:55'),
(395, 'disk', 2, 'UPDATE', '2022-04-24 03:31:55'),
(396, 'disk', 3, 'UPDATE', '2022-04-24 03:31:55'),
(397, 'user', 1, 'UPDATE', '2022-04-24 03:31:55'),
(398, 'book', 10, 'UPDATE', '2022-04-24 03:35:07'),
(399, 'user', 1, 'UPDATE', '2022-04-24 03:35:07'),
(400, 'user', 1, 'UPDATE', '2022-04-24 03:47:28'),
(401, 'user', 1, 'UPDATE', '2022-04-24 03:48:43'),
(402, 'user', 1, 'UPDATE', '2022-04-24 03:49:18'),
(403, 'user', 1, 'UPDATE', '2022-04-24 03:50:04'),
(404, 'user', 1, 'UPDATE', '2022-04-24 03:50:56'),
(405, 'user', 1, 'UPDATE', '2022-04-24 03:52:32'),
(406, 'user', 1, 'UPDATE', '2022-04-24 03:53:16'),
(407, 'user', 1, 'UPDATE', '2022-04-24 03:53:38'),
(408, 'user', 1, 'UPDATE', '2022-04-24 03:55:07'),
(409, 'user', 1, 'UPDATE', '2022-04-24 03:59:42'),
(410, 'user', 1, 'UPDATE', '2022-04-24 04:00:21'),
(411, 'user', 1, 'UPDATE', '2022-04-24 04:05:20'),
(413, 'user', 1, 'UPDATE', '2022-04-24 04:15:47'),
(414, 'user', 1, 'UPDATE', '2022-04-24 04:16:12'),
(415, 'user', 1, 'UPDATE', '2022-04-24 04:16:30'),
(416, 'user', 1, 'UPDATE', '2022-04-24 04:31:32'),
(417, 'book', 10, 'UPDATE', '2022-04-24 04:33:11'),
(418, 'user', 1, 'UPDATE', '2022-04-24 04:33:11'),
(419, 'user', 1, 'UPDATE', '2022-04-24 04:34:02'),
(420, 'book', 2, 'UPDATE', '2022-04-24 04:34:12'),
(421, 'user', 1, 'UPDATE', '2022-04-24 04:34:12'),
(422, 'user', 1, 'UPDATE', '2022-04-24 04:34:38'),
(423, 'user', 1, 'UPDATE', '2022-04-24 04:35:12'),
(424, 'user', 1, 'UPDATE', '2022-04-24 04:35:37'),
(425, 'user', 1, 'UPDATE', '2022-04-24 04:36:42'),
(426, 'user', 1, 'UPDATE', '2022-04-24 04:37:04'),
(427, 'user', 1, 'UPDATE', '2022-04-24 04:37:15'),
(428, 'user', 1, 'UPDATE', '2022-04-24 04:37:34'),
(429, 'book', 2, 'UPDATE', '2022-04-24 04:37:51'),
(430, 'user', 1, 'UPDATE', '2022-04-24 04:37:51'),
(431, 'disk', 3, 'UPDATE', '2022-04-24 04:38:06'),
(432, 'user', 1, 'UPDATE', '2022-04-24 04:38:06'),
(433, 'user', 1, 'UPDATE', '2022-04-24 04:38:30'),
(434, 'user', 1, 'UPDATE', '2022-04-24 04:39:37'),
(435, 'user', 1, 'UPDATE', '2022-04-24 04:40:10'),
(436, 'user', 1, 'UPDATE', '2022-04-24 04:42:11'),
(437, 'user', 1, 'UPDATE', '2022-04-24 04:42:28'),
(438, 'disk', 1, 'UPDATE', '2022-04-24 04:43:39'),
(439, 'disk', 2, 'UPDATE', '2022-04-24 04:43:39'),
(440, 'disk', 3, 'UPDATE', '2022-04-24 04:43:39'),
(441, 'user', 1, 'UPDATE', '2022-04-24 04:43:39'),
(442, 'user', 1, 'UPDATE', '2022-04-24 04:44:14'),
(443, 'book', 10, 'UPDATE', '2022-04-24 04:49:50'),
(444, 'user', 1, 'UPDATE', '2022-04-24 04:49:50'),
(445, 'user', 1, 'UPDATE', '2022-04-24 04:50:06'),
(446, 'user', 1, 'UPDATE', '2022-04-24 04:52:45'),
(447, 'disk', 3, 'UPDATE', '2022-04-24 04:52:54'),
(448, 'user', 1, 'UPDATE', '2022-04-24 04:52:54'),
(449, 'book', 15, 'UPDATE', '2022-04-24 04:53:31'),
(450, 'user', 1, 'UPDATE', '2022-04-24 04:53:31'),
(451, 'electronic', 1, 'UPDATE', '2022-04-24 04:53:42'),
(452, 'user', 1, 'UPDATE', '2022-04-24 04:53:42'),
(453, 'user', 1, 'UPDATE', '2022-04-24 04:54:16'),
(454, 'book', 10, 'UPDATE', '2022-04-24 04:57:41'),
(455, 'user', 1, 'UPDATE', '2022-04-24 04:57:41'),
(456, 'disk', 1, 'UPDATE', '2022-04-24 04:57:41'),
(457, 'disk', 2, 'UPDATE', '2022-04-24 04:57:41'),
(458, 'disk', 3, 'UPDATE', '2022-04-24 04:57:41'),
(459, 'user', 1, 'UPDATE', '2022-04-24 04:57:41'),
(460, 'book', 15, 'UPDATE', '2022-04-24 04:57:41'),
(461, 'user', 1, 'UPDATE', '2022-04-24 04:57:41'),
(462, 'electronic', 1, 'UPDATE', '2022-04-24 04:57:41'),
(463, 'user', 1, 'UPDATE', '2022-04-24 04:57:41'),
(464, 'user', 1, 'UPDATE', '2022-04-24 04:57:52'),
(465, 'book', 10, 'UPDATE', '2022-04-24 05:04:10'),
(466, 'user', 1, 'UPDATE', '2022-04-24 05:04:10'),
(469, 'book', 10, 'UPDATE', '2022-04-24 05:05:36'),
(470, 'user', 1, 'UPDATE', '2022-04-24 05:05:36'),
(471, 'book', 10, 'UPDATE', '2022-04-24 05:06:43'),
(472, 'user', 1, 'UPDATE', '2022-04-24 05:06:43'),
(473, 'book', 10, 'UPDATE', '2022-04-24 05:06:53'),
(474, 'user', 1, 'UPDATE', '2022-04-24 05:06:53'),
(475, 'book', 10, 'UPDATE', '2022-04-24 05:09:20'),
(476, 'user', 1, 'UPDATE', '2022-04-24 05:09:20'),
(477, 'book', 10, 'UPDATE', '2022-04-24 05:09:52'),
(478, 'user', 1, 'UPDATE', '2022-04-24 05:09:52'),
(479, 'book', 10, 'UPDATE', '2022-04-24 05:12:38'),
(480, 'user', 1, 'UPDATE', '2022-04-24 05:12:38'),
(481, 'book', 10, 'UPDATE', '2022-04-24 05:12:46'),
(482, 'user', 1, 'UPDATE', '2022-04-24 05:12:46'),
(483, 'book', 10, 'UPDATE', '2022-04-24 05:19:02'),
(484, 'user', 1, 'UPDATE', '2022-04-24 05:19:02'),
(485, 'book', 10, 'UPDATE', '2022-04-24 05:19:13'),
(486, 'user', 1, 'UPDATE', '2022-04-24 05:19:13'),
(487, 'book', 15, 'UPDATE', '2022-04-24 06:23:23'),
(488, 'user', 1, 'UPDATE', '2022-04-24 06:23:23'),
(489, 'book', 15, 'UPDATE', '2022-04-24 08:15:09'),
(490, 'user', 1, 'UPDATE', '2022-04-24 08:15:09'),
(491, 'book', 10, 'UPDATE', '2022-04-24 08:16:35'),
(492, 'user', 1, 'UPDATE', '2022-04-24 08:16:35'),
(493, 'book', 10, 'UPDATE', '2022-04-24 08:21:54'),
(494, 'user', 1, 'UPDATE', '2022-04-24 08:21:54'),
(495, 'disk', 1, 'UPDATE', '2022-04-24 08:21:54'),
(496, 'disk', 2, 'UPDATE', '2022-04-24 08:21:54'),
(497, 'disk', 3, 'UPDATE', '2022-04-24 08:21:54'),
(498, 'user', 1, 'UPDATE', '2022-04-24 08:21:54'),
(499, 'user', 1, 'UPDATE', '2022-04-24 08:21:54'),
(500, 'user', 1, 'UPDATE', '2022-04-24 08:21:54'),
(501, 'user', 1, 'UPDATE', '2022-04-24 08:23:04'),
(502, 'book', 10, 'UPDATE', '2022-04-24 08:38:17'),
(503, 'user', 1, 'UPDATE', '2022-04-24 08:38:17'),
(504, 'disk', 1, 'UPDATE', '2022-04-24 08:40:17'),
(505, 'disk', 2, 'UPDATE', '2022-04-24 08:40:17'),
(506, 'disk', 3, 'UPDATE', '2022-04-24 08:40:17'),
(507, 'user', 1, 'UPDATE', '2022-04-24 08:40:17'),
(508, 'book', 10, 'UPDATE', '2022-04-24 08:40:17'),
(509, 'user', 1, 'UPDATE', '2022-04-24 08:40:17'),
(510, 'user', 1, 'UPDATE', '2022-04-24 08:40:17'),
(511, 'user', 1, 'UPDATE', '2022-04-24 08:40:17'),
(512, 'user', 1, 'UPDATE', '2022-04-24 08:41:13'),
(513, 'book', 10, 'UPDATE', '2022-04-24 08:43:14'),
(514, 'user', 1, 'UPDATE', '2022-04-24 08:43:14'),
(515, 'book', 10, 'UPDATE', '2022-04-24 08:44:10'),
(516, 'book', 10, 'UPDATE', '2022-04-24 08:44:14'),
(517, 'user', 1, 'UPDATE', '2022-04-24 08:44:14'),
(518, 'book', 10, 'UPDATE', '2022-04-24 08:44:20'),
(519, 'user', 1, 'UPDATE', '2022-04-24 08:44:20'),
(520, 'book', 10, 'UPDATE', '2022-04-24 08:44:45'),
(521, 'user', 1, 'UPDATE', '2022-04-24 08:44:45'),
(522, 'book', 10, 'UPDATE', '2022-04-24 08:45:09'),
(523, 'user', 1, 'UPDATE', '2022-04-24 08:45:09'),
(524, 'book', 10, 'UPDATE', '2022-04-24 08:45:32'),
(525, 'user', 1, 'UPDATE', '2022-04-24 08:45:32'),
(526, 'book', 10, 'UPDATE', '2022-04-24 08:45:55'),
(527, 'user', 1, 'UPDATE', '2022-04-24 08:45:55'),
(528, 'book', 10, 'UPDATE', '2022-04-24 08:51:38'),
(529, 'user', 1, 'UPDATE', '2022-04-24 08:51:38'),
(530, 'book', 10, 'UPDATE', '2022-04-24 08:51:52'),
(531, 'user', 1, 'UPDATE', '2022-04-24 08:51:52'),
(532, 'book', 10, 'UPDATE', '2022-04-24 08:54:20'),
(533, 'user', 1, 'UPDATE', '2022-04-24 08:54:20'),
(534, 'user', 1, 'UPDATE', '2022-04-24 08:54:20'),
(535, 'user', 1, 'UPDATE', '2022-04-24 08:54:20'),
(536, 'disk', 1, 'UPDATE', '2022-04-24 08:54:20'),
(537, 'disk', 2, 'UPDATE', '2022-04-24 08:54:20'),
(538, 'disk', 3, 'UPDATE', '2022-04-24 08:54:20'),
(539, 'user', 1, 'UPDATE', '2022-04-24 08:54:20'),
(540, 'book', 10, 'UPDATE', '2022-04-24 08:57:11'),
(541, 'user', 1, 'UPDATE', '2022-04-24 08:57:11'),
(542, 'user', 1, 'UPDATE', '2022-04-24 08:57:11'),
(543, 'user', 1, 'UPDATE', '2022-04-24 08:57:11'),
(544, 'disk', 1, 'UPDATE', '2022-04-24 08:57:11'),
(545, 'disk', 2, 'UPDATE', '2022-04-24 08:57:11'),
(546, 'disk', 3, 'UPDATE', '2022-04-24 08:57:11'),
(547, 'user', 1, 'UPDATE', '2022-04-24 08:57:11'),
(548, 'book', 10, 'UPDATE', '2022-04-24 09:05:03'),
(549, 'user', 1, 'UPDATE', '2022-04-24 09:05:03'),
(550, 'book', 10, 'UPDATE', '2022-04-24 09:05:07'),
(551, 'user', 1, 'UPDATE', '2022-04-24 09:05:07'),
(552, 'user', 1, 'UPDATE', '2022-04-24 09:08:43'),
(553, 'book', 10, 'UPDATE', '2022-04-24 09:11:17'),
(554, 'user', 1, 'UPDATE', '2022-04-24 09:11:17'),
(555, 'user', 1, 'UPDATE', '2022-04-24 09:11:25'),
(556, 'book', 10, 'UPDATE', '2022-04-24 09:11:29'),
(557, 'user', 1, 'UPDATE', '2022-04-24 09:11:29'),
(558, 'book', 10, 'UPDATE', '2022-04-24 09:11:38'),
(559, 'user', 1, 'UPDATE', '2022-04-24 09:11:38'),
(560, 'book', 10, 'UPDATE', '2022-04-24 09:19:57'),
(561, 'user', 1, 'UPDATE', '2022-04-24 09:19:57'),
(562, 'book', 10, 'UPDATE', '2022-04-24 09:22:04'),
(563, 'user', 1, 'UPDATE', '2022-04-24 09:22:04'),
(564, 'user', 1, 'UPDATE', '2022-04-24 09:22:04'),
(567, 'book', 10, 'UPDATE', '2022-04-24 09:32:22'),
(568, 'user', 1, 'UPDATE', '2022-04-24 09:32:22'),
(569, 'book', 10, 'UPDATE', '2022-04-24 09:32:22'),
(570, 'user', 1, 'UPDATE', '2022-04-24 09:32:22'),
(571, 'user', 1, 'UPDATE', '2022-04-24 09:32:30'),
(572, 'user', 1, 'UPDATE', '2022-04-24 09:33:20'),
(573, 'book', 10, 'UPDATE', '2022-04-24 09:33:24'),
(574, 'user', 1, 'UPDATE', '2022-04-24 09:33:24'),
(575, 'user', 1, 'UPDATE', '2022-04-24 09:34:03'),
(576, 'book', 10, 'UPDATE', '2022-04-24 09:34:59'),
(577, 'user', 1, 'UPDATE', '2022-04-24 09:34:59'),
(578, 'user', 1, 'UPDATE', '2022-04-24 09:35:19'),
(579, 'book', 10, 'UPDATE', '2022-04-24 14:58:19'),
(580, 'user', 1, 'UPDATE', '2022-04-24 14:58:19'),
(581, 'book', 10, 'UPDATE', '2022-04-24 14:58:46'),
(582, 'user', 1, 'UPDATE', '2022-04-24 14:58:46'),
(583, 'book', 10, 'UPDATE', '2022-04-24 14:59:05'),
(584, 'user', 1, 'UPDATE', '2022-04-24 14:59:05'),
(585, 'book', 10, 'UPDATE', '2022-04-24 14:59:15'),
(586, 'user', 1, 'UPDATE', '2022-04-24 14:59:15'),
(587, 'book', 10, 'UPDATE', '2022-04-24 15:40:59'),
(588, 'user', 1, 'UPDATE', '2022-04-24 15:40:59'),
(589, 'book', 10, 'UPDATE', '2022-04-24 15:41:16'),
(590, 'user', 1, 'UPDATE', '2022-04-24 15:41:16'),
(591, 'user', 3, 'UPDATE', '2022-04-25 00:42:59'),
(592, 'user', 4, 'UPDATE', '2022-04-25 00:43:06'),
(593, 'user', 5, 'UPDATE', '2022-04-25 00:43:15'),
(594, 'user', 6, 'UPDATE', '2022-04-25 00:43:21'),
(595, 'user', 7, 'UPDATE', '2022-04-25 00:43:32'),
(596, 'user', 8, 'UPDATE', '2022-04-25 00:43:42'),
(597, 'user', 9, 'UPDATE', '2022-04-25 00:43:54'),
(598, 'user', 10, 'UPDATE', '2022-04-25 00:44:04'),
(599, 'user', 11, 'UPDATE', '2022-04-25 00:44:15'),
(600, 'user', 12, 'UPDATE', '2022-04-25 00:44:26'),
(601, 'user', 13, 'UPDATE', '2022-04-25 00:44:44'),
(602, 'user', 14, 'UPDATE', '2022-04-25 00:45:01'),
(603, 'user', 6, 'UPDATE', '2022-04-25 00:46:37'),
(604, 'user', 13, 'UPDATE', '2022-04-25 00:46:46'),
(605, 'user', 4, 'UPDATE', '2022-04-25 00:46:59'),
(606, 'book', 10, 'UPDATE', '2022-04-25 00:47:54'),
(607, 'user', 1, 'UPDATE', '2022-04-25 00:47:54'),
(608, 'book', 10, 'UPDATE', '2022-04-25 00:47:54'),
(609, 'user', 1, 'UPDATE', '2022-04-25 00:47:54'),
(610, 'book', 10, 'UPDATE', '2022-04-25 00:47:54'),
(611, 'user', 1, 'UPDATE', '2022-04-25 00:47:54'),
(612, 'book', 10, 'UPDATE', '2022-04-25 00:47:54'),
(613, 'user', 1, 'UPDATE', '2022-04-25 00:47:54'),
(614, 'user', 1, 'UPDATE', '2022-04-25 00:48:13'),
(615, 'user', 15, 'INSERT', '2022-04-25 00:49:19'),
(616, 'user', 15, 'UPDATE', '2022-04-25 00:49:49'),
(617, 'user', 10, 'UPDATE', '2022-04-25 00:49:58'),
(618, 'book', 15, 'UPDATE', '2022-04-25 00:50:32'),
(619, 'user', 15, 'UPDATE', '2022-04-25 00:50:32'),
(620, 'disk', 3, 'UPDATE', '2022-04-25 00:51:05'),
(621, 'user', 1, 'UPDATE', '2022-04-25 00:51:05'),
(622, 'book', 7, 'UPDATE', '2022-04-25 00:51:11'),
(623, 'user', 1, 'UPDATE', '2022-04-25 00:51:11'),
(624, 'disk', 1, 'UPDATE', '2022-04-25 00:51:22'),
(625, 'disk', 2, 'UPDATE', '2022-04-25 00:51:22'),
(626, 'disk', 3, 'UPDATE', '2022-04-25 00:51:22'),
(627, 'user', 1, 'UPDATE', '2022-04-25 00:51:22'),
(628, 'user', 16, 'INSERT', '2022-04-25 00:56:34'),
(629, 'electronic', 1, 'UPDATE', '2022-04-25 00:56:45'),
(630, 'user', 16, 'UPDATE', '2022-04-25 00:56:45'),
(631, 'book', 12, 'UPDATE', '2022-04-25 00:57:00'),
(632, 'user', 1, 'UPDATE', '2022-04-25 00:57:00'),
(633, 'book', 10, 'UPDATE', '2022-04-25 00:57:13'),
(634, 'user', 16, 'UPDATE', '2022-04-25 00:57:13'),
(635, 'book', 12, 'UPDATE', '2022-04-25 00:57:22'),
(636, 'user', 1, 'UPDATE', '2022-04-25 00:57:22'),
(637, 'book', 15, 'UPDATE', '2022-04-25 00:58:13'),
(638, 'user', 1, 'UPDATE', '2022-04-25 00:58:13'),
(639, 'book', 9, 'DELETE', '2022-04-25 00:59:55'),
(640, 'user', 17, 'INSERT', '2022-04-25 01:49:23'),
(641, 'user', 18, 'INSERT', '2022-04-25 01:49:51'),
(642, 'user', 16, 'UPDATE', '2022-04-25 01:50:45'),
(643, 'user', 17, 'UPDATE', '2022-04-25 01:51:01'),
(644, 'user', 18, 'UPDATE', '2022-04-25 01:51:11'),
(645, 'user', 17, 'UPDATE', '2022-04-25 01:51:21'),
(646, 'user', 18, 'UPDATE', '2022-04-25 01:51:29'),
(647, 'user', 16, 'UPDATE', '2022-04-25 01:51:35'),
(648, 'user', 17, 'UPDATE', '2022-04-25 02:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `Author_id` int(11) NOT NULL,
  `FName` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LName` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`Author_id`, `FName`, `LName`) VALUES
(1, 'J.K.', 'Rowling'),
(2, 'Dan', 'Brown'),
(3, 'E.L.', 'James'),
(4, 'Stephenie', 'Meyer'),
(5, 'Eric', 'Carle'),
(6, 'Yann', 'Martel'),
(7, 'Pamela', 'Stephenson'),
(8, 'Sebastian', 'Faulks'),
(9, 'Cecelia', 'Ahern'),
(10, 'Harper', 'Lee'),
(11, 'Thomas', 'Harris'),
(12, 'Zadie', 'Smith'),
(13, 'Hoda', 'Ehsan'),
(14, 'Abeera', 'Rehmat'),
(15, 'Monica', 'Cardella'),
(16, 'Giancarlo', 'Buzzanca'),
(17, 'World', 'Health'),
(18, 'Coyote', 'Flower'),
(19, 'Liz', 'Smith'),
(20, 'Maggie', 'Livingston'),
(21, 'Pat', 'Fusco'),
(22, 'Ronda', 'Slater'),
(23, 'JILL', 'NUGENT'),
(24, 'Marshall', 'Brown'),
(25, 'Fred', 'Alford'),
(26, 'Irfan', 'Habib'),
(27, 'Mathieu', 'Duchâtel'),
(28, 'Kathleen', 'Higgins'),
(29, 'Peter', 'Weller'),
(30, 'Nancy', 'Allen'),
(31, 'Daniel', 'O\'Herlihy'),
(32, 'Ronny', 'Cox'),
(33, 'Kurtwood', 'Smith'),
(34, 'Peter', 'Jackson'),
(35, 'Martin', 'Freeman'),
(36, 'Ian', 'McKellen'),
(37, 'Richard', 'Armitage'),
(38, 'Bill', 'Nye'),
(39, 'James', 'McKenna'),
(40, 'Erren', 'Gottlieb');

-- --------------------------------------------------------

--
-- Table structure for table `authorbookjoin`
--

CREATE TABLE `authorbookjoin` (
  `Author_Join_id` int(11) NOT NULL,
  `Author_id` int(12) NOT NULL,
  `Book_id` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authorbookjoin`
--

INSERT INTO `authorbookjoin` (`Author_Join_id`, `Author_id`, `Book_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 2, 8),
(9, 3, 9),
(10, 2, 10),
(11, 4, 11),
(12, 4, 12),
(13, 5, 13),
(14, 6, 14),
(15, 7, 15),
(16, 8, 16),
(17, 9, 17),
(18, 10, 18),
(19, 11, 19),
(20, 12, 20);

-- --------------------------------------------------------

--
-- Table structure for table `authordiskjoin`
--

CREATE TABLE `authordiskjoin` (
  `DAuthor_Join_id` int(11) NOT NULL,
  `Author_id` int(11) NOT NULL,
  `Disk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authordiskjoin`
--

INSERT INTO `authordiskjoin` (`DAuthor_Join_id`, `Author_id`, `Disk_id`) VALUES
(1, 29, 1),
(2, 30, 1),
(3, 31, 1),
(4, 32, 1),
(5, 33, 1),
(6, 34, 2),
(7, 35, 2),
(8, 36, 2),
(9, 37, 2),
(10, 38, 3),
(11, 39, 3),
(12, 40, 3);

-- --------------------------------------------------------

--
-- Table structure for table `authorjournaljoin`
--

CREATE TABLE `authorjournaljoin` (
  `JAuthor_Join_id` int(11) NOT NULL,
  `Author_id` int(12) NOT NULL,
  `Journal_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authorjournaljoin`
--

INSERT INTO `authorjournaljoin` (`JAuthor_Join_id`, `Author_id`, `Journal_id`) VALUES
(1, 13, 1),
(2, 14, 1),
(3, 15, 1),
(4, 16, 2),
(5, 17, 3),
(6, 18, 4),
(7, 19, 4),
(8, 20, 4),
(9, 21, 4),
(10, 22, 4),
(11, 23, 5),
(12, 24, 6),
(13, 25, 7),
(14, 26, 8),
(15, 27, 9),
(16, 28, 10);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `Book_id` int(11) NOT NULL,
  `Name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Rental_status` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ISBN` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pages` int(14) NOT NULL,
  `Publisher` int(11) NOT NULL,
  `Publish_date` date NOT NULL,
  `Deleted_id` tinyint(4) NOT NULL DEFAULT 0,
  `Img` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Description` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No Description',
  `Reference_type` int(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`Book_id`, `Name`, `Rental_status`, `ISBN`, `Pages`, `Publisher`, `Publish_date`, `Deleted_id`, `Img`, `Description`, `Reference_type`) VALUES
(1, 'Harry Potter and the Sorcerer\'s Stone', '7', '9780590353403', 309, 1, '2003-11-01', 0, '625cdd05c03d22.54205787.jpg', 'A winner of England\'s National Book Award, the acclaimed debut novel tells the outrageously funny, fantastic adventure story of Harry Potter, who escapes a hideous foster home thanks to a scholarship to The Hogwarts School for Witchcraft and Wizardry.', 1),
(2, 'Harry Potter and the Chamber of Secrets', '5', '9780439064873', 341, 2, '1998-07-02', 0, '625cde2c577a57.67708401.jpg', 'The Dursleys were so mean that hideous that summer that all Harry Potter wanted was to get back to the Hogwarts School for Witchcraft and Wizardry. But just as he\'s packing his bags, Harry receives a warning from a strange, impish creature named Dobby who says that if Harry Potter returns to Hogwarts, disaster will strike.\r\n\r\nAnd strike it does. For in Harry\'s second year at Hogwarts, fresh torments and horrors arise, including an outrageously stuck-up new professor, Gilderoy Lockheart, a spirit named Moaning Myrtle who haunts the girls\' bathroom, and the unwanted attentions of Ron Weasley\'s younger sister, Ginny.\r\n\r\nBut each of these seem minor annoyances when the real trouble begins, and someone--or something--starts turning Hogwarts students to stone. Could it be Draco Malfoy, a more poisonous rival than ever? Could it possibly be Hagrid, whose mysterious past is finally told? Or could it be the one everyone at Hogwarts most suspects...Harry Potter himself?', 1),
(3, 'Harry Potter and the Prisoner of Azkaban', '0', '9780439655484', 435, 1, '2004-05-01', 0, '625cdf1f185989.74909870.jpg', 'For twelve long years, the dread fortress of Azkaban held an infamous prisoner named Sirius Black. Convicted of killing thirteen people with a single curse, he was said to be the heir apparent to the Dark Lord, Voldemort.\r\n\r\nNow he has escaped, leaving only two clues as to where he might be headed: Harry Potter\'s defeat of You-Know-Who was Black\'s downfall as well. And the Azkban guards heard Black muttering in his sleep, \"He\'s at Hogwarts...he\'s at Hogwarts.\"\r\n\r\nHarry Potter isn\'t safe, not even within the walls of his magical school, surrounded by his friends. Because on top of it all, there may well be a traitor in their midst.', 1),
(4, 'Harry Potter and the Order of the Phoenix', '3', '9780439358071', 870, 1, '2003-06-21', 0, '625ce0341791b4.90593213.jpg', 'In his fifth year at Hogwart\'s, Harry faces challenges at every turn, from the dark threat of He-Who-Must-Not-Be-Named and the unreliability of the government of the magical world to the rise of Ron Weasley as the keeper of the Gryffindor Quidditch Team. Along the way he learns about the strength of his friends, the fierceness of his enemies, and the meaning of sacrifice.', 1),
(5, 'Harry Potter and the Goblet of Fire', '6', '9780439139601', 734, 1, '2002-09-28', 0, '625ce56340ca69.42406756.jpg', 'Harry Potter is midway through his training as a wizard and his coming of age. Harry wants to get away from the pernicious Dursleys and go to the International Quidditch Cup with Hermione, Ron, and the Weasleys. He wants to dream about Cho Chang, his crush (and maybe do more than dream). He wants to find out about the mysterious event that\'s supposed to take place at Hogwarts this year, an event involving two other rival schools of magic, and a competition that hasn\'t happened for hundreds of years. He wants to be a normal, fourteen-year-old wizard. But unfortunately for Harry Potter, he\'s not normal - even by wizarding standards.', 1),
(6, 'Harry Potter and the Half-Blood Prince', '2', '9780439785969', 652, 1, '2005-07-16', 0, '625ce6afb21af6.75551737.jpg', 'The war against Voldemort is not going well; even the Muggles have been affected. Dumbledore is absent from Hogwarts for long stretches of time, and the Order of the Phoenix has already suffered losses.\r\n\r\nAnd yet . . . as with all wars, life goes on. Sixth-year students learn to Apparate. Teenagers flirt and fight and fall in love. Harry receives some extraordinary help in Potions from the mysterious Half-Blood Prince. And with Dumbledore\'s guidance, he seeks out the full, complex story of the boy who became Lord Voldemort -- and thus finds what may be his only vulnerability.', 1),
(7, 'Harry Potter and the Deathly Hallows', '7', '9780545010221', 759, 2, '2007-07-21', 0, '625ce74fef6a04.59989471.jpg', 'It\'s no longer safe for Harry at Hogwarts, so he and his best friends, Ron and Hermione, are on the run. Professor Dumbledore has given them clues about what they need to do to defeat the dark wizard, Lord Voldemort, once and for all, but it\'s up to them to figure out what these hints and suggestions really mean. Their cross-country odyssey has them searching desperately for the answers, while evading capture or death at every turn. At the same time, their friendship, fortitude, and sense of right and wrong are tested in ways they never could have imagined. The ultimate battle between good and evil that closes out this final chapter of the epic series takes place where Harry\'s Wizarding life began: at Hogwarts. The satisfying conclusion offers shocking last-minute twists, incredible acts of courage, powerful new forms of magic, and the resolution of many mysteries. Above all, this intense, cathartic book serves as a clear statement of the message at the heart of the Harry Potter series: that choice matters much more than destiny, and that love will always triumph over death.', 1),
(8, 'The Da Vinci Code', '9', '9780307277671', 489, 3, '2006-03-28', 0, '625ce898798450.24649300.jpg', 'While in Paris, Harvard symbologist Robert Langdon is awakened by a phone call in the dead of the night. The elderly curator of the Louvre has been murdered inside the museum, his body covered in baffling symbols. As Langdon and gifted French cryptologist Sophie Neveu sort through the bizarre riddles, they are stunned to discover a trail of clues hidden in the works of Leonardo da Vinci—clues visible for all to see and yet ingeniously disguised by the painter.\r\n\r\nEven more startling, the late curator was involved in the Priory of Sion—a secret society whose members included Sir Isaac Newton, Victor Hugo, and Da Vinci—and he guarded a breathtaking historical secret. Unless Langdon and Neveu can decipher the labyrinthine puzzle—while avoiding the faceless adversary who shadows their every move—the explosive, ancient truth will be lost forever.', 1),
(9, 'Fifty Shades of Grey', '1', '9780345803481', 356, 4, '2011-05-25', 1, '625ce996981b72.49339773.jpg', 'When literature student Anastasia Steele goes to interview young entrepreneur Christian Grey, she encounters a man who is beautiful, brilliant, and intimidating. The unworldly, innocent Ana is startled to realize she wants this man and, despite his enigmatic reserve, finds she is desperate to get close to him. Unable to resist Ana’s quiet beauty, wit, and independent spirit, Grey admits he wants her, too—but on his own terms.\r\n \r\nShocked yet thrilled by Grey’s singular erotic tastes, Ana hesitates. For all the trappings of success—his multinational businesses, his vast wealth, his loving family—Grey is a man tormented by demons and consumed by the need to control. When the couple embarks on a daring, passionately physical affair, Ana discovers Christian Grey’s secrets and explores her own dark desires.\r\n\r\nErotic, amusing, and deeply moving, the Fifty Shades Trilogy is a tale that will obsess you, possess you, and stay with you forever.', 1),
(10, 'Angels and Demons', '9', '9780671027360', 736, 5, '2006-04-01', 0, '625cea1ca2f0b8.30587239.jpg', 'World-renowned Harvard symbologist Robert Langdon is summoned to a Swiss research facility to analyze a cryptic symbol seared into the chest of a murdered physicist. What he discovers is unimaginable: a deadly vendetta against the Catholic Church by a centuries-old underground organization -- the Illuminati. In a desperate race to save the Vatican from a powerful time bomb, Langdon joins forces in Rome with the beautiful and mysterious scientist Vittoria Vetra. Together they embark on a frantic hunt through sealed crypts, dangerous catacombs, and deserted cathedrals, and into the depths of the most secretive vault on earth...the long-forgotten Illuminati lair.', 1),
(11, 'Twilight', '2', '9780316015844', 498, 6, '2006-09-06', 0, '625ceac5206f48.65995309.jpg', 'About three things I was absolutely positive.\r\n\r\nFirst, Edward was a vampire.\r\n\r\nSecond, there was a part of him—and I didn\'t know how dominant that part might be—that thirsted for my blood.\r\n\r\nAnd third, I was unconditionally and irrevocably in love with him.\r\n\r\nDeeply seductive and extraordinarily suspenseful, Twilight is a love story with bite.', 1),
(12, 'New Moon', '4', '9780316160193', 563, 6, '2006-09-06', 0, '625cebcfb22492.29337007.jpg', 'I knew we were both in mortal danger. Still, in that instant, I felt well. Whole. I could feel my heart racing in my chest, the blood pulsing hot and fast through my veins again. My lungs filled deep with the sweet scent that came off his skin. It was like there had never been any hole in my chest. I was perfect - not healed, but as if there had never been a wound in the first place.', 1),
(13, 'The Very Hungry Caterpillar', '8', '9780241003008', 26, 7, '1994-01-01', 0, '625cec45d5ebc3.57882395.jpg', 'THE all-time classic story, from generation to generation, sold somewhere in the world every 30 seconds! Have you shared it with a child or grandchild in your life?\r\n\r\nOne sunny Sunday, the caterpillar was hatched out of a tiny egg. He was very hungry. On Monday, he ate through one apple; on Tuesday, he ate through three plums--and still he was hungry. When full at last, he made a cocoon around himself and went to sleep, to wake up a few weeks later wonderfully transformed into a butterfly!', 1),
(14, 'Life of Pi', '5', '9780770430078', 460, 8, '2006-08-29', 0, '625ced112d3319.25140723.jpg', 'Life of Pi is a fantasy adventure novel by Yann Martel published in 2001. The protagonist, Piscine Molitor \"Pi\" Patel, a Tamil boy from Pondicherry, explores issues of spirituality and practicality from an early age. He survives 227 days after a shipwreck while stranded on a boat in the Pacific Ocean with a Bengal tiger named Richard Parker.', 1),
(15, 'Billy', '3', '9780007110919', 384, 9, '2002-01-01', 0, '625cedfc3b6b07.50035979.jpg', 'The inside story of the one of the most successful British stand-up comedians, as told by the person best qualified to reveal all about the man behind the comic, his wife of over 20 years – Pamela Stephenson.\r\n\r\n\r\nOnce in a lifetime, there strides upon the stage someone who can truly be called a legend. Such a person is the inimitable, timeless genius who is Billy Connolly. His effortlessly wicked whimsy has entranced, enthralled – and split the sides of – thousands upon thousands of adoring audiences.\r\n\r\n\r\nAnd when he isn\'t doing that…he\'s turning in award-winning performances on film and television.\r\n\r\n\r\nHe\'s the man who needs no introduction, and yet he is the ultimate enigma. From a troubled and desperately poor childhood in the docklands of Glasgow he is now the intimate of household names the world over.\r\n\r\n\r\nHow did this happen, who is the real Billy Connolly? Only one person can answer that question: his wife, Pamela Stephenson. Pamela’s writing combines the very personal with a frank objectivity that makes for a compelling, moving and hugely entertaining biography. This is the real Billy Connolly.\r\n\r\n\r\nThis genre-defining book is now re-released for a new generation of comedy fans, with a stunning package and a new Foreword from the author. Pamela’s vision of Billy is as true now as it ever was – as groundbreaking, as moving and as laugh-out-loud funny – and here she brings the book fully into its context, as one of the most influential biographies ever written.', 1),
(16, 'Birdsong: A Novel of Love and War', '0', '9780679776819', 483, 10, '1997-06-02', 0, '625cee8a079ab5.97323824.jpg', 'Published to international critical and popular acclaim, this intensely romantic yet stunningly realistic novel spans three generations and the unimaginable gulf between the First World War and the present. As the young Englishman Stephen Wraysford passes through a tempestuous love affair with Isabelle Azaire in France and enters the dark, surreal world beneath the trenches of No Man\'s Land, Sebastian Faulks creates a world of fiction that is as tragic as A Farewell to Arms and as sensuous as The English Patient. Crafted from the ruins of war and the indestructibility of love, Birdsong is a novel that will be read and marveled at for years to come.', 1),
(17, 'P.S. I Love You', '6', '9780786890750', 501, 11, '2005-01-05', 0, '625ceef559c469.92626031.jpg', 'A novel about holding on, letting go, and learning to love again.\r\n\r\nNow in paperback, the endearing novel that captured readers\' hearts and introduced a fresh new voice in women\'s fiction Cecelia Ahern.\r\n\r\nHolly couldn\'t live without her husband Gerry, until the day she had to. They were the kind of young couple who could finish each other\'s sentences. When Gerry succumbs to a terminal illness and dies, 30-year-old Holly is set adrift, unable to pick up the pieces. But with the help of a series of letters her husband left her before he died and a little nudging from an eccentric assortment of family and friends, she learns to laugh, overcome her fears, and discover a world she never knew existed.\r\n\r\nThe kind of enchanting novel with cross-generational appeal that comes along once in a great while, PS, I Love You is a captivating love letter to the world!', 1),
(18, 'To Kill a Mockingbird', '11', '9780764586002', 336, 12, '2006-05-23', 0, '625cef86844314.79728023.jpg', 'The unforgettable novel of a childhood in a sleepy Southern town and the crisis of conscience that rocked it. \"To Kill A Mockingbird\" became both an instant bestseller and a critical success when it was first published in 1960. It went on to win the Pulitzer Prize in 1961 and was later made into an Academy Award-winning film, also a classic.\r\n\r\nCompassionate, dramatic, and deeply moving, \"To Kill A Mockingbird\" takes readers to the roots of human behavior - to innocence and experience, kindness and cruelty, love and hatred, humor and pathos. Now with over 18 million copies in print and translated into forty languages, this regional story by a young Alabama woman claims universal appeal. Harper Lee always considered her book to be a simple love story. Today it is regarded as a masterpiece of American literature.', 1),
(19, 'Red Dragon', '4', '9780440206156', 454, 13, '2000-05-22', 0, '625ceff1ee8996.32217783.jpg', 'A second family has been massacred by the terrifying serial killer the press has christened \"The Tooth Fairy.\" Special Agent Jack Crawford turns to the one man who can help restart a failed investigation: Will Graham. Graham is the greatest profiler the FBI ever had, but the physical and mental scars of capturing Hannibal Lecter have caused Graham to go into early retirement. Now, Graham must turn to Lecter for help.', 1),
(20, 'White Teeth', '3', '9780375703867', 448, 10, '2001-06-12', 0, '625cf06330afb4.76258282.jpg', 'At the center of this invigorating novel are two unlikely friends, Archie Jones and Samad Iqbal. Hapless veterans of World War II, Archie and Samad and their families become agents of England’s irrevocable transformation. A second marriage to Clara Bowden, a beautiful, albeit tooth-challenged, Jamaican half his age, quite literally gives Archie a second lease on life, and produces Irie, a knowing child whose personality doesn’t quite match her name (Jamaican for “no problem”). Samad’s late-in-life arranged marriage (he had to wait for his bride to be born), produces twin sons whose separate paths confound Iqbal’s every effort to direct them, and a renewed, if selective, submission to his Islamic faith. Set against London’s racial and cultural tapestry, venturing across the former empire and into the past as it barrels toward the future, White Teeth revels in the ecstatic hodgepodge of modern life, flirting with disaster, confounding expectations, and embracing the comedy of daily existence.', 1);

--
-- Triggers `book`
--
DELIMITER $$
CREATE TRIGGER `Delete_book` AFTER UPDATE ON `book` FOR EACH ROW IF NEW.Deleted_id = 1
THEN
INSERT INTO audit (Type, Type_id, Action, Date) VALUES ('book', NEW.Book_id, 'DELETE', NOW());
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Insert_book` AFTER INSERT ON `book` FOR EACH ROW INSERT INTO audit (Type, Type_id, Action, Date) VALUES ('book', NEW.Book_id, 'INSERT', NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Update_book` AFTER UPDATE ON `book` FOR EACH ROW IF NEW.Deleted_id = 0
THEN
INSERT INTO audit (Type, Type_id, Action, Date) VALUES ('book', NEW.Book_id, 'UPDATE', NOW());
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `Brand_id` int(11) NOT NULL,
  `Brand_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`Brand_id`, `Brand_name`) VALUES
(2, 'ELEGOO'),
(1, 'Texas Instruments');

-- --------------------------------------------------------

--
-- Table structure for table `disk`
--

CREATE TABLE `disk` (
  `Disk_id` int(11) NOT NULL,
  `Name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Rental_status` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Publisher` int(11) NOT NULL,
  `Publish_date` date NOT NULL,
  `Deleted_id` tinyint(4) NOT NULL,
  `Img` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No Description',
  `Reference_type` int(3) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disk`
--

INSERT INTO `disk` (`Disk_id`, `Name`, `Rental_status`, `Publisher`, `Publish_date`, `Deleted_id`, `Img`, `Description`, `Reference_type`) VALUES
(1, 'Robocop', '12', 23, '1917-07-18', 0, '625d542bb36399.66912878.jpg', 'In a violent, near-apocalyptic Detroit, evil corporation Omni Consumer Products wins a contract from the city government to privatize the police force. To test their crime-eradicating cyborgs, the company leads street cop Alex Murphy (Peter Weller) into an armed confrontation with crime lord Boddicker (Kurtwood Smith) so they can use his body to support their untested RoboCop prototype. But when RoboCop learns of the company\'s nefarious plans, he turns on his masters.', 3),
(2, 'Hobbit Trilogy', '10', 24, '2012-12-14', 0, '625d04a71d2566.39082208.jpg', 'Bilbo Baggins (Martin Freeman) lives a simple life with his fellow hobbits in the shire, until the wizard Gandalf (Ian McKellen) arrives and convinces him to join a group of dwarves on a quest to reclaim the kingdom of Erebor. The journey takes Bilbo on a path through treacherous lands swarming with orcs, goblins and other dangers, not the least of which is an encounter with Gollum (Andy Serkis) and a simple gold ring that is tied to the fate of Middle Earth in ways Bilbo cannot even fathom.', 3),
(3, 'Bill Nye the Science Guy - Storms & Atmosphere', '6', 25, '2012-11-13', 0, '625d059239f2c0.52707726.jpg', 'Storms are big, loud, and often accompanied by rain, snow, sleet, or hail. Where do these wild, dangerous, and necessary tornadoes, hurricanes, and thunderstorms come from? Storms happen when huge different air masses collide. Along the border of these air masses, water vapor condenses into clouds, strong winds form, and the clouds rub against each other with the ground often becoming electrically charged waiting to send lightning bolts across the sky. What starts out as a placid summer day turns into two air masses boxing it out 10,000 meters up.\r\n\r\nMaybe you’d rather move to another planet that doesn’t have hurricanes and tornadoes. Well, you can’t get away from storms, even on another planet. All planets with an atmosphere have their share of heavy weather. Compared to some of the other extreme storms in our solar system, earth’s hurricanes and tornadoes look like whirlpools in the bathtub!\r\n', 3);

--
-- Triggers `disk`
--
DELIMITER $$
CREATE TRIGGER `Delete_disk` AFTER UPDATE ON `disk` FOR EACH ROW IF NEW.Deleted_id = 1
THEN
INSERT INTO audit (Type, Type_id, Action, Date) VALUES ('disk', NEW.Disk_id, 'DELETE', NOW());
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Disk_insert` AFTER INSERT ON `disk` FOR EACH ROW INSERT INTO audit (Type, Type_id, Action, Date) VALUES ('disk', NEW.Disk_id, 'INSERT', NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Disk_update` AFTER UPDATE ON `disk` FOR EACH ROW IF NEW.Deleted_id = 0
THEN
INSERT INTO audit (Type, Type_id, Action, Date) VALUES ('disk', NEW.Disk_id, 'UPDATE', NOW());
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `electronic`
--

CREATE TABLE `electronic` (
  `Electronic_id` int(11) NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Type` int(11) NOT NULL,
  `Model` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Brand` int(11) NOT NULL,
  `Img` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Deleted_id` int(11) NOT NULL DEFAULT 0,
  `Rental_status` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No description',
  `Release_date` date NOT NULL,
  `Reference_type` int(6) NOT NULL DEFAULT 4
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `electronic`
--

INSERT INTO `electronic` (`Electronic_id`, `Name`, `Type`, `Model`, `Brand`, `Img`, `Deleted_id`, `Rental_status`, `Description`, `Release_date`, `Reference_type`) VALUES
(1, 'Texes t-80', 1, 'TI-84 Plus', 1, '625d0670a20a97.40225711.jpg', 0, '10', 'Preloaded with software, including Cabri Jr. interactive geometry software.\r\nUp to ten graphing functions defined, saved, graphed and analyzed at one time.\r\nAdvanced functions accessed through pull-down display menus.\r\nHorizontal and vertical split screen options. Vibrant backlit color screen\r\nI/o port for communication with other TI products.Seven different graph styles for differentiating the look of each graph drawn', '2004-01-01', 4),
(2, 'Arduino', 2, 'UNO R3 Compatible', 2, '625d0754127818.48057029.jpg', 0, '0', 'Free PDF tutorial(more than 22 lessons) and clear listing in a nice package\r\nThe most economical kit based on Arduino platform to starting programming for those beginners who are interested.\r\nLcd1602 module with pin header (not need to be soldered by yourself)\r\nThis is the upgraded starter kits with power supply module, 9V battery with dc\r\nHigh quality kit with UNO R3. 100% compatible with Arduino UNO R3, MEGA 2560 R3, NANO.', '2020-10-21', 4);

--
-- Triggers `electronic`
--
DELIMITER $$
CREATE TRIGGER `Delete_Electronic` AFTER UPDATE ON `electronic` FOR EACH ROW IF NEW.Deleted_id = 1
THEN
INSERT INTO audit (Type, Type_id, Action, Date) VALUES ('electronic', NEW.Electronic_id, 'DELETE', NOW());
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Insert_Electronic` AFTER INSERT ON `electronic` FOR EACH ROW INSERT INTO audit (Type, Type_id, Action, Date) VALUES ('electronic', NEW.Electronic_id, 'INSERT', NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Update_electronic` AFTER UPDATE ON `electronic` FOR EACH ROW IF NEW.Deleted_id = 0
THEN
INSERT INTO audit (Type, Type_id, Action, Date) VALUES ('electronic', NEW.Electronic_id, 'UPDATE', NOW());
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `etype`
--

CREATE TABLE `etype` (
  `ET_id` int(11) NOT NULL,
  `Electronic_type` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `etype`
--

INSERT INTO `etype` (`ET_id`, `Electronic_type`) VALUES
(1, 'Calculator'),
(2, 'Arduino');

-- --------------------------------------------------------

--
-- Table structure for table `fine`
--

CREATE TABLE `fine` (
  `Fine_id` int(11) NOT NULL,
  `User` int(11) NOT NULL,
  `Loan` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Ammount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `Genre_id` int(11) NOT NULL,
  `Genre_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`Genre_id`, `Genre_type`) VALUES
(9, 'Adult'),
(4, 'Adventure'),
(23, 'Art'),
(16, 'Autobiography'),
(13, 'Biography'),
(12, 'Childrens'),
(27, 'Computer'),
(7, 'Crime'),
(28, 'Digital'),
(35, 'Educational'),
(1, 'Fantasy'),
(2, 'Fiction'),
(25, 'Health'),
(17, 'Historical Fiction'),
(30, 'History'),
(20, 'Horror'),
(15, 'Humor'),
(21, 'Literary Fiction'),
(3, 'Magic'),
(32, 'Muisc'),
(5, 'Mystery'),
(14, 'Nonfiction'),
(22, 'Periodicals'),
(11, 'Picture Books'),
(29, 'Political'),
(24, 'Report'),
(8, 'Romance'),
(19, 'School'),
(34, 'Science'),
(33, 'Science Fiction'),
(31, 'Social'),
(6, 'Thriller'),
(10, 'Vampires'),
(18, 'War'),
(26, 'Women');

-- --------------------------------------------------------

--
-- Table structure for table `genrebookjoin`
--

CREATE TABLE `genrebookjoin` (
  `Genre_Join_id` int(11) NOT NULL,
  `Genre_id` int(11) NOT NULL,
  `Book_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genrebookjoin`
--

INSERT INTO `genrebookjoin` (`Genre_Join_id`, `Genre_id`, `Book_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 1, 2),
(6, 2, 2),
(7, 3, 2),
(8, 4, 2),
(9, 1, 3),
(10, 2, 3),
(11, 3, 3),
(12, 4, 3),
(13, 1, 4),
(14, 2, 4),
(15, 3, 4),
(16, 4, 4),
(17, 1, 5),
(18, 2, 5),
(19, 3, 5),
(20, 4, 5),
(21, 1, 6),
(22, 2, 6),
(23, 3, 6),
(24, 4, 6),
(25, 2, 7),
(26, 3, 7),
(27, 4, 7),
(28, 2, 8),
(29, 5, 8),
(30, 6, 8),
(31, 4, 8),
(32, 7, 8),
(33, 8, 9),
(34, 2, 9),
(35, 9, 9),
(36, 2, 10),
(37, 5, 10),
(38, 6, 10),
(39, 1, 11),
(40, 8, 11),
(41, 1, 12),
(42, 8, 12),
(43, 10, 12),
(44, 11, 13),
(45, 12, 13),
(46, 2, 13),
(47, 2, 14),
(48, 1, 14),
(49, 4, 14),
(50, 13, 15),
(51, 14, 15),
(52, 15, 15),
(53, 16, 15),
(54, 17, 16),
(55, 2, 16),
(56, 18, 16),
(57, 8, 17),
(58, 2, 17),
(59, 2, 18),
(60, 17, 18),
(61, 19, 18),
(62, 20, 19),
(63, 2, 19),
(64, 6, 19),
(65, 7, 19),
(66, 2, 20),
(67, 21, 20);

-- --------------------------------------------------------

--
-- Table structure for table `genrediskjoin`
--

CREATE TABLE `genrediskjoin` (
  `DGenre_Join_id` int(11) NOT NULL,
  `Genre_id` int(11) NOT NULL,
  `Disk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genrediskjoin`
--

INSERT INTO `genrediskjoin` (`DGenre_Join_id`, `Genre_id`, `Disk_id`) VALUES
(1, 33, 1),
(2, 1, 1),
(3, 4, 1),
(4, 1, 2),
(5, 4, 2),
(6, 2, 2),
(7, 34, 3),
(8, 14, 3),
(9, 35, 3);

-- --------------------------------------------------------

--
-- Table structure for table `genrejournaljoin`
--

CREATE TABLE `genrejournaljoin` (
  `JGenre_Join_id` int(11) NOT NULL,
  `Genre_id` int(11) NOT NULL,
  `Journal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genrejournaljoin`
--

INSERT INTO `genrejournaljoin` (`JGenre_Join_id`, `Genre_id`, `Journal_id`) VALUES
(1, 22, 1),
(2, 19, 1),
(3, 22, 2),
(4, 23, 2),
(5, 24, 3),
(6, 25, 3),
(7, 22, 4),
(8, 26, 4),
(9, 22, 5),
(10, 27, 5),
(11, 28, 5),
(12, 22, 6),
(13, 29, 6),
(14, 22, 7),
(15, 30, 7),
(16, 22, 8),
(17, 31, 8),
(18, 18, 9),
(19, 29, 9),
(20, 22, 10),
(21, 32, 10);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `Item_id` int(11) NOT NULL,
  `Disk_id` int(11) DEFAULT NULL,
  `Electronic_id` int(11) DEFAULT NULL,
  `Book_id` int(11) DEFAULT NULL,
  `Journal_id` int(11) DEFAULT NULL,
  `User_id` int(11) NOT NULL,
  `In_Use` int(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`Item_id`, `Disk_id`, `Electronic_id`, `Book_id`, `Journal_id`, `User_id`, `In_Use`) VALUES
(81, NULL, NULL, 15, NULL, 15, 0),
(82, 3, NULL, NULL, NULL, 1, 1),
(83, NULL, NULL, 7, NULL, 1, 0),
(84, NULL, 1, NULL, NULL, 16, 0),
(86, NULL, NULL, 10, NULL, 16, 0),
(87, NULL, NULL, 15, NULL, 1, 0);

--
-- Triggers `item`
--
DELIMITER $$
CREATE TRIGGER `Item_Delete_Book` BEFORE DELETE ON `item` FOR EACH ROW BEGIN
IF OLD.Book_id IS NOT NULL THEN
UPDATE book
SET book.Rental_status = book.Rental_status + 1
WHERE book.Book_id = old.Book_id;
UPDATE user
SET user.Current_orders = user.Current_orders - 1
WHERE user.User_id = OLD.User_id;
UPDATE reservation
SET reservation.Item = NULL
WHERE reservation.Item = OLD.Item_id;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Item_Delete_Disk` BEFORE DELETE ON `item` FOR EACH ROW BEGIN
IF OLD.Disk_id IS NOT NULL THEN
UPDATE disk
SET disk.Rental_status = disk.Rental_status + 1
WHERE disk.Disk_id = disk.Disk_id;
UPDATE user
SET user.Current_orders = user.Current_orders - 1
WHERE user.User_id = OLD.User_id;
UPDATE reservation
SET reservation.Item = NULL
WHERE reservation.Item = OLD.Item_id;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Item_Delete_Electronic` BEFORE DELETE ON `item` FOR EACH ROW BEGIN
IF OLD.Electronic_id IS NOT NULL THEN
UPDATE electronic
SET electronic.Rental_status = electronic.Rental_status + 1
WHERE electronic.Electronic_id = old.Electronic_id;
UPDATE user
SET user.Current_orders = user.Current_orders - 1
WHERE user.User_id = OLD.User_id;
UPDATE reservation
SET reservation.Item = NULL
WHERE reservation.Item = OLD.Item_id;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Item_Delete_Journal` BEFORE DELETE ON `item` FOR EACH ROW BEGIN
IF OLD.Journal_id IS NOT NULL THEN
UPDATE journal
SET journal.Rental_status = journal.Rental_status + 1
WHERE journal.Journal_id = old.journal_id;
UPDATE user
SET user.Current_orders = user.Current_orders - 1
WHERE user.User_id = OLD.User_id;
UPDATE reservation
SET reservation.Item = NULL
WHERE reservation.Item = OLD.Item_id;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Item_Insert_Book` AFTER INSERT ON `item` FOR EACH ROW IF New.Book_id IS NOT NULL THEN
UPDATE book
SET book.Rental_status = book.Rental_status - 1
WHERE book.Book_id = New.Book_id;
UPDATE user
SET user.Current_orders = user.Current_orders + 1
WHERE user.User_id = New.User_id;
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Item_Insert_Disk` AFTER INSERT ON `item` FOR EACH ROW IF New.Disk_id IS NOT NULL THEN
UPDATE disk
SET disk.Rental_status = disk.Rental_status - 1
WHERE disk.Disk_id = New.Disk_id;
UPDATE user
SET user.Current_orders = user.Current_orders + 1
WHERE user.User_id = New.User_id;
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Item_Insert_Electronic` AFTER INSERT ON `item` FOR EACH ROW IF New.Electronic_id IS NOT NULL THEN
UPDATE electronic
SET electronic.Rental_status = electronic.Rental_status - 1
WHERE electronic.Electronic_id = New.Electronic_id;
UPDATE user
SET user.Current_orders = user.Current_orders + 1
WHERE user.User_id = New.User_id;
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Item_Insert_Journal` AFTER INSERT ON `item` FOR EACH ROW IF New.Journal_id IS NOT NULL THEN
UPDATE journal
SET journal.Rental_status = journal.Rental_status - 1
WHERE journal.Journal_id = New.Journal_id;
UPDATE user
SET user.Current_orders = user.Current_orders + 1
WHERE user.User_id = New.User_id;
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Item_Return_Book` AFTER UPDATE ON `item` FOR EACH ROW IF NEW.In_use=1 AND OLD.Book_id IS NOT NULL THEN
UPDATE book
SET book.Rental_status = book.Rental_status + 1
WHERE book.Book_id = old.Book_id;
UPDATE user
SET user.Current_orders = user.Current_orders - 1
WHERE user.User_id = OLD.User_id;
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Item_Return_Disk` AFTER UPDATE ON `item` FOR EACH ROW IF NEW.In_use=1 AND OLD.Disk_id IS NOT NULL THEN
UPDATE disk
SET disk.Rental_status = disk.Rental_status + 1
WHERE disk.Disk_id = disk.Disk_id;
UPDATE user
SET user.Current_orders = user.Current_orders - 1
WHERE user.User_id = OLD.User_id;
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Item_Return_Electronic` AFTER UPDATE ON `item` FOR EACH ROW IF NEW.In_use=1 AND OLD.Electronic_id IS NOT NULL THEN
UPDATE electronic
SET electronic.Rental_status = electronic.Rental_status + 1
WHERE electronic.Electronic_id = old.Electronic_id;
UPDATE user
SET user.Current_orders = user.Current_orders - 1
WHERE user.User_id = OLD.User_id;
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Item_Return_Journal` AFTER UPDATE ON `item` FOR EACH ROW IF NEW.In_use=1 AND OLD.Journal_id IS NOT NULL THEN
UPDATE journal
SET journal.Rental_status = journal.Rental_status + 1
WHERE journal.Journal_id = old.journal_id;
UPDATE user
SET user.Current_orders = user.Current_orders - 1
WHERE user.User_id = OLD.User_id;
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `itemtype`
--

CREATE TABLE `itemtype` (
  `Type_id` int(11) NOT NULL,
  `Type_name` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itemtype`
--

INSERT INTO `itemtype` (`Type_id`, `Type_name`) VALUES
(1, 'Book'),
(2, 'Journal'),
(3, 'Disk'),
(4, 'Electronic');

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `Journal_id` int(11) NOT NULL,
  `Publisher` int(11) NOT NULL,
  `Name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ISSN` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Publish_date` date NOT NULL,
  `Rental_status` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pages` int(14) NOT NULL,
  `Deleted_id` smallint(4) NOT NULL,
  `Img` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No Description',
  `Reference_type` int(3) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`Journal_id`, `Publisher`, `Name`, `ISSN`, `Publish_date`, `Rental_status`, `Pages`, `Deleted_id`, `Img`, `Description`, `Reference_type`) VALUES
(1, 14, 'Computer Science Unplugged', '26901544', '2019-10-01', '2', 57, 0, '625cf7283bc0a0.94699775.jpg', '...Computer Science Unplugged Second-grade students design mind, we have designed an engineering design activity to en- a puppy playground using gage children in kindergarten through second grade in com-putational thinking (see Table 1 for a description of compu- computational thinking. tational...', 2),
(2, 15, 'Computer-based art: conservazione e restauro', '26840890', '2017-02-01', '0', 29, 0, '625cf80adee0c6.18317775.jpg', '...Computer -based art: conservazione e restauro Giancarlo Buzzanca Che pensare? Conservazione e restauro sono todologia di intervento sui documenti digitali (nativi possibili in ambiti nuovi? o meno) non può essere diversa da quanto normato Nella fase di preparazione alla scrittura di questo in ambito archivistico, nel caso delle rappresentazioni...', 2),
(3, 16, 'Preventing Malaria', '27928131', '2019-01-01', '1', 1, 0, '625cf92d3509f3.58691718.jpg', '...under an ITN the night before the survey); ■ household ITN ownership gap, measured as the percentage of households with at least one ITN for ■ ITN ownership (i.e. the percentage of households every two people among households owning any 46 that owned at least one ITN); ITN. WORLD MALARIA REPORT...', 2),
(4, 17, 'Marin Women\'s News Journal', '04011975', '1975-04-01', '1', 3, 0, '625cfa846049a8.40472684.jpg', '...overriding a veto by the upper house. The court did rule that abortions were legal in the first trimester in the case of rape, danger to the mother\'s health , the possibility a child born deformed, and in instances where the birth could cause grave hardship.\" decision means that West Germany...', 2),
(5, 14, 'CITIZEN SCIENCE: iNaturalist: Citizen Science', '27048173', '2020-05-01', '1', 87, 0, '625cfb25b1f467.69679977.jpg', '...CITIZEN SCIENCE iNaturalist: Citizen Science for the Digital Age JILL NUGENT The natural world becomes your lab Additionally, when students submit ganisms emerging from their winter when you implement iNaturalist observations that are Research Grade state. A number of global citizen science in your 21st-century teaching tool- (Research Grade is an...', 2),
(6, 18, '\"Frankenstein\": A Child\'s Tale', '01346124', '2003-02-01', '0', 36, 0, '625cfc1d48f0d3.24950744.jpg', '...\"a mutually supportive, gender-free family\" [44]); Claridge; Crisman; and Komisaruk. On politics, see Botting and Randel (who offers an intriguing, particularly explicit allegorization). On science , see Jordanova; Mellor, Mary Shelley 89-114; Rauch 96-128; and, less successfully, Vasbinder, Hansen, Tim Marshall...', 2),
(7, 19, 'Greek Tragedy and Civilization: The Cultivati', '44888661', '1993-06-01', '3', 46, 0, '625cfcc77d9b41.11826333.png', '...Greek Tragedy and Civilization: The Cultivation of Pity C. FRED ALFORD, UNIVERSITY OF MARYLAND Of all the strategies for civilization reviewed by Albert O. Hirschman in The Passions and the Interests, one is distinctly missing: that civilization might be rendered more decent and peaceful by cultivating the civilizing emotions based upon...', 2),
(8, 20, 'Inequalities: A Social History', '24372959', '2015-02-01', '1', 43, 0, '625cfd6698ba12.99024525.jpg', '...lnequalities:A Social History Irfan Habib When one speaks of inequalities, it is usual for the listener to assume that one is not speaking of lack of equality in physical strength, quickness of tongue or store of wisdom, qualities that nature supposedly bestows in different measures...', 2),
(9, 21, 'TERROR OVERSEAS: CHINA’S EVOLVING COUNTER-TERRORISM', '21588812', '2016-10-01', '1', 1, 0, '625cfde3369336.97788477.jpg', '...EUROPEAN COUNCIL ON FOREIGN RELATIONS ecfr.eu TERROR OVERSEAS: UNDERSTANDING CHINA’S EVOLVING COUNTER- TERROR STRATEGY Mathieu Duchâtel In November 2015, the Islamic State group (ISIS) SUMMARY announced that it had executed a Chinese citizen for the first time. A few days later...', 2),
(10, 22, 'Connecting Music to Ethics', '26608534', '2018-06-01', '1', 58, 0, '625cff300fbc73.65989911.jpg', '...Music Symposium, Volume 58, No. 3 Fall, 2018 Connecting Music to Ethics Kathleen M. Higgins Published online: 30 November 2018 DOI: 10.18177/sym.2018.58.sr.11411 Many features of music contribute to its positive potential for promoting social harmony. But music’s influence on human interaction is not entirely benign. I consider features of music...', 2);

--
-- Triggers `journal`
--
DELIMITER $$
CREATE TRIGGER `Delete_journal` AFTER UPDATE ON `journal` FOR EACH ROW IF NEW.Deleted_id = 1
THEN
INSERT INTO audit (Type, Type_id, Action, Date) VALUES ('journal', NEW.Journal_id, 'DELETE', NOW());
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Journal_insert` AFTER INSERT ON `journal` FOR EACH ROW INSERT INTO audit (Type, Type_id, Action, Date) VALUES ('journal', NEW.Journal_id, 'INSERT', NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Journal_update` AFTER UPDATE ON `journal` FOR EACH ROW IF NEW.Deleted_id = 0
THEN
INSERT INTO audit (Type, Type_id, Action, Date) VALUES ('journal', NEW.Journal_id, 'UPDATE', NOW());
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `Loan_id` int(11) NOT NULL,
  `Item` int(11) DEFAULT NULL,
  `User` int(11) NOT NULL,
  `Loan_date` date NOT NULL,
  `Return_date` date NOT NULL,
  `Drop_date` date DEFAULT NULL,
  `Returned` int(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`Loan_id`, `Item`, `User`, `Loan_date`, `Return_date`, `Drop_date`, `Returned`) VALUES
(73, 81, 15, '2022-04-24', '2022-05-02', NULL, 0),
(74, 82, 1, '2022-03-04', '2022-05-18', '2022-03-11', 1),
(75, 84, 16, '2022-04-24', '2022-05-02', NULL, 0),
(76, 87, 1, '2022-04-24', '2022-05-09', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `notification_User` int(11) NOT NULL,
  `notification_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `notification_User`, `notification_item`) VALUES
(51, 15, 81),
(53, 1, 83),
(54, 16, 84),
(56, 16, 86),
(57, 1, 87);

-- --------------------------------------------------------

--
-- Table structure for table `printer`
--

CREATE TABLE `printer` (
  `Printer_id` int(11) NOT NULL,
  `Scanner` tinyint(4) NOT NULL,
  `Color` tinyint(4) NOT NULL,
  `Paper` tinyint(4) NOT NULL,
  `Black_ink_status` tinyint(4) NOT NULL,
  `Color_ink_status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `Publisher_id` int(11) NOT NULL,
  `Publisher_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`Publisher_id`, `Publisher_name`) VALUES
(3, 'Anchor'),
(2, 'Arthur A. Levine Books'),
(25, 'Buena Vista Television'),
(15, 'Centro Di Della Edifimi SRL'),
(22, 'College Music Society'),
(18, 'Duke University Press'),
(13, 'Dutton'),
(21, 'European Council on Foreign Relations'),
(11, 'Hachette Books'),
(12, 'Harper Perennial Modern Classics'),
(9, 'HarperCollins'),
(6, 'Little, Brown and Company'),
(14, 'National Science Teachers Association'),
(23, 'Orion Pictures'),
(5, 'Pocket Books'),
(7, 'Puffin Books'),
(19, 'Sage Publications'),
(1, 'Scholastic'),
(8, 'Seal Books'),
(20, 'Social Scientist'),
(4, 'Vintage'),
(10, 'Vintage International'),
(24, 'Warner Bros. Pictures'),
(17, 'Women\'s Educational League'),
(16, 'World Health Organization');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `Reservation_id` int(11) NOT NULL,
  `User` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `Item` int(11) DEFAULT NULL,
  `Request_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`Reservation_id`, `User`, `Status`, `Item`, `Request_date`) VALUES
(81, 15, 2, 81, '2022-04-24 19:50:32'),
(82, 1, 9, 82, '2022-03-03 19:51:05'),
(83, 1, 1, 83, '2022-04-24 19:51:11'),
(84, 16, 2, 84, '2022-04-24 19:56:45'),
(85, 1, 4, NULL, '2022-04-24 19:57:00'),
(86, 16, 1, 86, '2022-04-24 19:57:13'),
(87, 1, 2, 87, '2022-04-24 19:58:13');

--
-- Triggers `reservation`
--
DELIMITER $$
CREATE TRIGGER `Add_Loan` AFTER UPDATE ON `reservation` FOR EACH ROW BEGIN
DECLARE role VARCHAR(100);
SELECT User_Status INTO role from user
WHERE User_id = NEW.User;

	IF New.Status = 2 AND OLD.Status != 2 
    AND role = 'admin' THEN
    INSERT INTO loan
    (Item,User,Loan_date,Return_date)
    VALUES
    (New.Item,New.User,New.Request_date,CURRENT_DATE +
     INTERVAL 14 day);
     END IF;
     
    IF New.Status = 2 AND OLD.Status != 2 
    AND role = 'staff' THEN
    INSERT INTO loan
    (Item,User,Loan_date,Return_date)
    VALUES
    (New.Item,New.User,New.Request_date,CURRENT_DATE +
     INTERVAL 14 day);
     END IF;
     
    IF New.Status = 2 AND OLD.Status != 2 
    AND role = 'user' THEN
    INSERT INTO loan
    (Item,User,Loan_date,Return_date)
    VALUES
    (New.Item,New.User,New.Request_date,CURRENT_DATE +
     INTERVAL 7 day);
     END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `notification` AFTER INSERT ON `reservation` FOR EACH ROW IF NEW.Item IS NOT NULL
THEN
INSERT into notifications
VALUES(null,NEW.user, NEW.Item);
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_status`
--

CREATE TABLE `reservation_status` (
  `Reserve_id` int(11) NOT NULL,
  `Reserve_status` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservation_status`
--

INSERT INTO `reservation_status` (`Reserve_id`, `Reserve_status`) VALUES
(1, 'Requested'),
(2, 'Loaned'),
(4, 'Canceled'),
(9, 'Returned');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_id` int(11) NOT NULL,
  `Fname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Lname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Username` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Balance` decimal(10,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `DOB` date DEFAULT NULL,
  `Pnumber` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Current_orders` int(11) NOT NULL DEFAULT 0,
  `Created` datetime DEFAULT NULL,
  `User_Status` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `Deleted_id` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_id`, `Fname`, `Lname`, `Email`, `Username`, `Password`, `Balance`, `DOB`, `Pnumber`, `Current_orders`, `Created`, `User_Status`, `Deleted_id`) VALUES
(1, 'Test', 'User', 'ADMIN@Yahoo.com', 'ADMIN', '$2y$10$tF4WiZwx1Jha.CdkcT3Ka.2sz7cKyjkLuuAQtTquA5tZhNPnvTL.m', '0.00', '2022-04-04', '1237654123', 2, '2022-04-18 03:20:32', 'admin', 0),
(3, 'Test', 'User', 'ADMIN@Yahoo1.com', 'ADMINCOPY', '$2y$10$tF4WiZwx1Jha.CdkcT3Ka.2sz7cKyjkLuuAQtTquA5tZhNPnvTL.m', '1000.00', '2022-04-04', '1237654123', 0, '2022-04-18 03:20:32', 'user', 0),
(4, 'James', 'Williams', 'adrianna2001@gmail.com', 'Taurus', '$2y$10$uFt4JKmsJaSrhyuKsHmDMOE3ZlQMIo5yTKwHUoXwTkGZjZljpp2LO', '35.00', '2022-04-12', '6515872356', 0, '2022-02-23 17:33:30', 'user', 0),
(5, 'Charles', 'Dryer', 'cornelius_macejkov@hotmail.com', 'Manzo', '$2y$10$ujKeyIQC638VnoQjdr.0pepS0dlTVnOVFsOnp5erZBwzDtIfCOxrm', '134.00', '2022-03-23', '8622525936', 0, '2022-04-18 17:34:19', 'user', 0),
(6, 'Joseph', 'Courts', 'oliver1974@gmail.com', 'Hunziker', '$2y$10$H0gyQdarYze0Sf3V/i4AIud0W/1ENmxmEA3CYjryK8aAeE/JNidgW', '0.00', '2022-04-11', '2011075473', 0, '2022-03-15 17:35:31', 'user', 0),
(7, 'Evelyn', 'Dang', 'marie1973@hotmail.com', 'Falzone', '$2y$10$rDjbO3iPrCd7mg8CCgMNpubUjEVMTXWDLM8claAg8Vyeoi23ssQ7C', '356.00', '2011-05-24', '7609208942', 0, '2022-04-18 17:36:22', 'staff', 0),
(8, 'Clara', 'Bryant', 'sheila2000@yahoo.com', 'Parr', '$2y$10$pGOW1Id0.6ujbEi4sunHJ.dFKhec8vEzjfJmXX/R6Mdr4SN3t1L0q', '23.00', '1998-06-24', '6127605019', 0, '2022-04-18 17:37:10', 'user', 0),
(9, 'Lawrence', 'Hobson', 'peter.moe10@gmail.com', 'Leo', '$2y$10$qHM/psl60HbX/IoEyTy6N.e5gVRrVNk39aZilCk.kkMUQqn/ZUVKW', '67.00', '2001-10-24', '9178076093', 0, '2022-04-18 17:38:04', 'user', 0),
(10, 'Anthony', 'Valenzuela', 'rebekah_huds@yahoo.com', 'Mohammad', '$2y$10$im6qZ8yYWWyjl5390hP0B.Nwv/wntKzs4jxhM5B97TjLJQUXdif8a', '32.00', '2002-05-24', '3147090485', 0, '2022-04-18 17:38:50', 'staff', 0),
(11, 'Christine', 'Cooper', 'zoe_fadel2010@yahoo.com', 'Hodson', '$2y$10$FmmE9Hw47u4mVKxN3V/DyemI9Yy5h.cCxLi2qMUqm4BvRMTmAgKUq', '3.00', '1990-09-24', '3314816827', 0, '2022-04-18 17:39:39', 'user', 0),
(12, 'Reba', 'McClaskey', 'ron1991@hotmail.com', 'Baily', '$2y$10$BKvEEVbrk2DCMNGu4bDr5OoFJYgVP4Ch3Yk8XEeWpvh7ry9ayoojO', '234.00', '2022-03-29', '5016267146', 0, '2022-04-18 17:40:24', 'user', 0),
(13, 'asdasd', 'asdsadas', 'asdasdasd@asdasdasd.com', 'asdasw3qeaw', '$2y$10$dyqUSjVTe2jaSxjTWI9JUecrvwCkYPIKLO2hhzck9qe/cHwW/j8Jy', '0.00', '2016-09-24', '78421237451', 0, '2022-03-04 15:52:08', 'user', 0),
(14, 'asdasd', 'asdasd', 'asdasds@asdasd.com', '1234', '$2y$10$aufDmAvcr7uWCFCMvpvNM.zSht2r9wSb/CPCxvbB0mlwy.UrghnbW', '0.00', '2022-04-11', '712347281231', 0, '2022-04-19 16:38:54', 'user', 0),
(15, 'Oscar', 'Crawfish', 'OscarCraw@hotmail.com', 'CrawfishGuy', '$2y$10$8HUoWTcCDqzS.ftyPa8Ive5xyHia.E2xkBjefpGvAfWjU0A5HP1Iy', '0.00', '2022-04-24', '457219284112', 1, '2022-04-24 19:49:19', 'user', 0),
(16, 'Cougar', 'Tester', 'Cougar@Cougarnet.UH.EDU', 'Cougar', '$2y$10$8QlhADOI5zcauE/pPYBBjuP3ghc2LI9gOW/U3trLrGATugiRcJFLi', '0.00', '2000-04-01', '2812812810', 2, '2022-04-24 19:56:34', 'user', 0),
(17, 'FNSTAFF', 'LNSTAFF', 'staff@aol.com', 'STAFF', '$2y$10$uDx7oa9ajESo6xTpE1NLYeZ2t8wn5gHW.5eyNMq1PMvkx3VvK0V9W', '0.00', '2000-01-01', '8328328320', 0, '2022-04-24 20:49:23', 'staff', 0),
(18, 'FNUSER', 'LNUSER', 'user@aol.com', 'USER', '$2y$10$KwNOf5WpayBYoHJ3qO0HC.XKtG4ka1k0DknlWBkJ6uyu8.h8nywUu', '0.00', '2005-05-05', '7777777777', 0, '2022-04-24 20:49:51', 'user', 0);

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `User_delete` AFTER UPDATE ON `user` FOR EACH ROW IF NEW.Deleted_id = 1
THEN
INSERT INTO audit (Type, Type_id, Action, Date) VALUES ('user', NEW.User_id, 'DELETE', NOW());
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `User_insert` AFTER INSERT ON `user` FOR EACH ROW INSERT INTO audit (Type, Type_id, Action, Date) VALUES ('user', NEW.User_id, 'INSERT', NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `User_update` AFTER UPDATE ON `user` FOR EACH ROW IF NEW.Deleted_id = 0
THEN
INSERT INTO audit (Type, Type_id, Action, Date) VALUES ('user', NEW.User_id, 'UPDATE', NOW());
END IF
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`Audit_id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`Author_id`),
  ADD UNIQUE KEY `Author_id_UNIQUE` (`Author_id`);

--
-- Indexes for table `authorbookjoin`
--
ALTER TABLE `authorbookjoin`
  ADD PRIMARY KEY (`Author_Join_id`),
  ADD KEY `Join_Author_Book` (`Author_id`),
  ADD KEY `Join_Book_id` (`Book_id`);

--
-- Indexes for table `authordiskjoin`
--
ALTER TABLE `authordiskjoin`
  ADD PRIMARY KEY (`DAuthor_Join_id`),
  ADD KEY `DiskAuthorJoin` (`Author_id`),
  ADD KEY `DiskIdJoin` (`Disk_id`);

--
-- Indexes for table `authorjournaljoin`
--
ALTER TABLE `authorjournaljoin`
  ADD PRIMARY KEY (`JAuthor_Join_id`),
  ADD KEY `Author_Journal_Join` (`Author_id`),
  ADD KEY `Join_Journal_id` (`Journal_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`Book_id`),
  ADD UNIQUE KEY `BookID_UNIQUE` (`Book_id`),
  ADD KEY `Book_Publisher` (`Publisher`),
  ADD KEY `Book_Reference` (`Reference_type`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`Brand_id`),
  ADD UNIQUE KEY `Brand_name` (`Brand_name`);

--
-- Indexes for table `disk`
--
ALTER TABLE `disk`
  ADD PRIMARY KEY (`Disk_id`),
  ADD UNIQUE KEY `Disj_id_UNIQUE` (`Disk_id`),
  ADD KEY `Disk_publisher_id_idx` (`Publisher`),
  ADD KEY `Disk_type` (`Reference_type`);

--
-- Indexes for table `electronic`
--
ALTER TABLE `electronic`
  ADD PRIMARY KEY (`Electronic_id`),
  ADD UNIQUE KEY `E_id_UNIQUE` (`Electronic_id`),
  ADD KEY `ET_id_idx` (`Type`),
  ADD KEY `Brand_join` (`Brand`);

--
-- Indexes for table `etype`
--
ALTER TABLE `etype`
  ADD PRIMARY KEY (`ET_id`),
  ADD UNIQUE KEY `ET_id_UNIQUE` (`ET_id`);

--
-- Indexes for table `fine`
--
ALTER TABLE `fine`
  ADD PRIMARY KEY (`Fine_id`),
  ADD UNIQUE KEY `Fine_ID_UNIQUE` (`Fine_id`),
  ADD KEY `LoanID_idx` (`Loan`),
  ADD KEY `UserID_idx` (`User`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`Genre_id`),
  ADD UNIQUE KEY `genre_type_UNIQUE` (`Genre_type`);

--
-- Indexes for table `genrebookjoin`
--
ALTER TABLE `genrebookjoin`
  ADD PRIMARY KEY (`Genre_Join_id`),
  ADD KEY `Genre_Book` (`Book_id`),
  ADD KEY `Book_Genre_Id` (`Genre_id`);

--
-- Indexes for table `genrediskjoin`
--
ALTER TABLE `genrediskjoin`
  ADD PRIMARY KEY (`DGenre_Join_id`),
  ADD KEY `DiskGenreJoin` (`Genre_id`),
  ADD KEY `DiskGenreIdJoin` (`Disk_id`);

--
-- Indexes for table `genrejournaljoin`
--
ALTER TABLE `genrejournaljoin`
  ADD PRIMARY KEY (`JGenre_Join_id`),
  ADD KEY `Genre_Journal_Join` (`Genre_id`),
  ADD KEY `Join_Genre_Journal_id` (`Journal_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`Item_id`),
  ADD KEY `Item_Disk_id` (`Disk_id`),
  ADD KEY `Item_Electronic_id` (`Electronic_id`),
  ADD KEY `Item_Book_id` (`Book_id`),
  ADD KEY `Item_Journal_id` (`Journal_id`),
  ADD KEY `Item_User_id` (`User_id`);

--
-- Indexes for table `itemtype`
--
ALTER TABLE `itemtype`
  ADD PRIMARY KEY (`Type_id`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`Journal_id`),
  ADD UNIQUE KEY `Item_ID_UNIQUE` (`Journal_id`),
  ADD KEY `Publisher_id_idx` (`Publisher`),
  ADD KEY `Journal_type` (`Reference_type`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`Loan_id`),
  ADD UNIQUE KEY `Loan_ID_UNIQUE` (`Loan_id`),
  ADD KEY `userID_idx` (`User`),
  ADD KEY `item_ID_loan_idx` (`Item`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `notification_User` (`notification_User`),
  ADD KEY `Notification_Item` (`notification_item`);

--
-- Indexes for table `printer`
--
ALTER TABLE `printer`
  ADD PRIMARY KEY (`Printer_id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`Publisher_id`),
  ADD UNIQUE KEY `PublisherID_UNIQUE` (`Publisher_id`),
  ADD UNIQUE KEY `Publisher_name_UNIQUE` (`Publisher_name`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Reservation_id`),
  ADD KEY `Reserve_user_id_idx` (`User`),
  ADD KEY `Reserve_Item_id_idx` (`Item`),
  ADD KEY `Reserve_status_id_idx` (`Status`);

--
-- Indexes for table `reservation_status`
--
ALTER TABLE `reservation_status`
  ADD PRIMARY KEY (`Reserve_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`),
  ADD UNIQUE KEY `username_UNIQUE` (`Username`),
  ADD UNIQUE KEY `User_id_UNIQUE` (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `Audit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=649;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `Author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `authorbookjoin`
--
ALTER TABLE `authorbookjoin`
  MODIFY `Author_Join_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `authordiskjoin`
--
ALTER TABLE `authordiskjoin`
  MODIFY `DAuthor_Join_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `authorjournaljoin`
--
ALTER TABLE `authorjournaljoin`
  MODIFY `JAuthor_Join_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `Book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `Brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `disk`
--
ALTER TABLE `disk`
  MODIFY `Disk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `electronic`
--
ALTER TABLE `electronic`
  MODIFY `Electronic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `etype`
--
ALTER TABLE `etype`
  MODIFY `ET_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fine`
--
ALTER TABLE `fine`
  MODIFY `Fine_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `Genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `genrebookjoin`
--
ALTER TABLE `genrebookjoin`
  MODIFY `Genre_Join_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `genrediskjoin`
--
ALTER TABLE `genrediskjoin`
  MODIFY `DGenre_Join_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `genrejournaljoin`
--
ALTER TABLE `genrejournaljoin`
  MODIFY `JGenre_Join_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `Item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `itemtype`
--
ALTER TABLE `itemtype`
  MODIFY `Type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `Journal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `Loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `printer`
--
ALTER TABLE `printer`
  MODIFY `Printer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `Publisher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `reservation_status`
--
ALTER TABLE `reservation_status`
  MODIFY `Reserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authorbookjoin`
--
ALTER TABLE `authorbookjoin`
  ADD CONSTRAINT `Join_Author_Book` FOREIGN KEY (`Author_id`) REFERENCES `author` (`Author_id`),
  ADD CONSTRAINT `Join_Book_id` FOREIGN KEY (`Book_id`) REFERENCES `book` (`Book_id`);

--
-- Constraints for table `authordiskjoin`
--
ALTER TABLE `authordiskjoin`
  ADD CONSTRAINT `DiskAuthorJoin` FOREIGN KEY (`Author_id`) REFERENCES `author` (`Author_id`),
  ADD CONSTRAINT `DiskIdJoin` FOREIGN KEY (`Disk_id`) REFERENCES `disk` (`Disk_id`);

--
-- Constraints for table `authorjournaljoin`
--
ALTER TABLE `authorjournaljoin`
  ADD CONSTRAINT `Author_Journal_Join` FOREIGN KEY (`Author_id`) REFERENCES `author` (`Author_id`),
  ADD CONSTRAINT `Join_Journal_id` FOREIGN KEY (`Journal_id`) REFERENCES `journal` (`Journal_id`);

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `Book_Publisher` FOREIGN KEY (`Publisher`) REFERENCES `publisher` (`Publisher_id`),
  ADD CONSTRAINT `Book_Reference` FOREIGN KEY (`Reference_type`) REFERENCES `itemtype` (`Type_id`);

--
-- Constraints for table `disk`
--
ALTER TABLE `disk`
  ADD CONSTRAINT `Disk_publisher_id` FOREIGN KEY (`Publisher`) REFERENCES `publisher` (`Publisher_id`),
  ADD CONSTRAINT `Disk_type` FOREIGN KEY (`Reference_type`) REFERENCES `itemtype` (`Type_id`);

--
-- Constraints for table `electronic`
--
ALTER TABLE `electronic`
  ADD CONSTRAINT `Brand_join` FOREIGN KEY (`Brand`) REFERENCES `brand` (`Brand_id`),
  ADD CONSTRAINT `Type_Join` FOREIGN KEY (`Type`) REFERENCES `etype` (`ET_id`);

--
-- Constraints for table `fine`
--
ALTER TABLE `fine`
  ADD CONSTRAINT `Fine_loan_id` FOREIGN KEY (`Loan`) REFERENCES `loan` (`Loan_id`),
  ADD CONSTRAINT `Fine_user_id` FOREIGN KEY (`User`) REFERENCES `user` (`User_id`);

--
-- Constraints for table `genrebookjoin`
--
ALTER TABLE `genrebookjoin`
  ADD CONSTRAINT `Book_Genre_Id` FOREIGN KEY (`Genre_id`) REFERENCES `genre` (`Genre_id`),
  ADD CONSTRAINT `Genre_Book` FOREIGN KEY (`Book_id`) REFERENCES `book` (`Book_id`);

--
-- Constraints for table `genrediskjoin`
--
ALTER TABLE `genrediskjoin`
  ADD CONSTRAINT `DiskGenreIdJoin` FOREIGN KEY (`Disk_id`) REFERENCES `disk` (`Disk_id`),
  ADD CONSTRAINT `DiskGenreJoin` FOREIGN KEY (`Genre_id`) REFERENCES `genre` (`Genre_id`);

--
-- Constraints for table `genrejournaljoin`
--
ALTER TABLE `genrejournaljoin`
  ADD CONSTRAINT `Genre_Journal_Join` FOREIGN KEY (`Genre_id`) REFERENCES `genre` (`Genre_id`),
  ADD CONSTRAINT `Join_Genre_Journal_id` FOREIGN KEY (`Journal_id`) REFERENCES `journal` (`Journal_id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `Item_Book_id` FOREIGN KEY (`Book_id`) REFERENCES `book` (`Book_id`),
  ADD CONSTRAINT `Item_Disk_id` FOREIGN KEY (`Disk_id`) REFERENCES `disk` (`Disk_id`),
  ADD CONSTRAINT `Item_Electronic_id` FOREIGN KEY (`Electronic_id`) REFERENCES `electronic` (`Electronic_id`),
  ADD CONSTRAINT `Item_Journal_id` FOREIGN KEY (`Journal_id`) REFERENCES `journal` (`Journal_id`),
  ADD CONSTRAINT `Item_User_id` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`);

--
-- Constraints for table `journal`
--
ALTER TABLE `journal`
  ADD CONSTRAINT `Journal_publisher_id` FOREIGN KEY (`Publisher`) REFERENCES `publisher` (`Publisher_id`),
  ADD CONSTRAINT `Journal_type` FOREIGN KEY (`Reference_type`) REFERENCES `itemtype` (`Type_id`);

--
-- Constraints for table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `Loan_item_id` FOREIGN KEY (`Item`) REFERENCES `item` (`Item_id`),
  ADD CONSTRAINT `Loan_user_id` FOREIGN KEY (`User`) REFERENCES `user` (`User_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `Notifcation_User` FOREIGN KEY (`notification_User`) REFERENCES `user` (`User_id`),
  ADD CONSTRAINT `Notification_Item` FOREIGN KEY (`notification_item`) REFERENCES `item` (`Item_id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `Reserve_item_id` FOREIGN KEY (`Item`) REFERENCES `item` (`Item_id`),
  ADD CONSTRAINT `Reserve_status_id` FOREIGN KEY (`Status`) REFERENCES `reservation_status` (`Reserve_id`),
  ADD CONSTRAINT `Reserve_user_id` FOREIGN KEY (`User`) REFERENCES `user` (`User_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
