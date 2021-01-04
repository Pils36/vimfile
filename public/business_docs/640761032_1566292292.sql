-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2019 at 09:48 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fsfl_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `ipaddress` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `ipaddress`, `location`, `action`, `created_at`, `updated_at`) VALUES
(1, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-08 09:56:35', '2019-08-08 09:56:35'),
(2, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 09:56:36', '2019-08-08 09:56:36'),
(3, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 11:12:19', '2019-08-08 11:12:19'),
(4, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 11:13:27', '2019-08-08 11:13:27'),
(5, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 11:35:20', '2019-08-08 11:35:20'),
(6, '52.114.77.26', 'Ireland', 'Visited Home page', '2019-08-08 11:35:29', '2019-08-08 11:35:29'),
(7, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 11:40:24', '2019-08-08 11:40:24'),
(8, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-08 11:41:01', '2019-08-08 11:41:01'),
(9, '52.114.77.26', 'Ireland', 'Visited Registration page', '2019-08-08 11:41:11', '2019-08-08 11:41:11'),
(10, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-08 11:42:23', '2019-08-08 11:42:23'),
(11, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-08 12:15:19', '2019-08-08 12:15:19'),
(12, '197.157.216.15', 'Nigeria', 'Visited Reserve a seat page', '2019-08-08 12:15:24', '2019-08-08 12:15:24'),
(13, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-08 12:50:54', '2019-08-08 12:50:54'),
(14, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 13:02:50', '2019-08-08 13:02:50'),
(15, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 13:27:39', '2019-08-08 13:27:39'),
(16, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-08 13:30:11', '2019-08-08 13:30:11'),
(17, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-08 13:30:28', '2019-08-08 13:30:28'),
(18, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-08 13:31:30', '2019-08-08 13:31:30'),
(19, '197.157.216.15', 'Nigeria', 'Visited Reserve a seat page', '2019-08-08 13:32:13', '2019-08-08 13:32:13'),
(20, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 13:33:14', '2019-08-08 13:33:14'),
(21, '197.157.216.15', 'Nigeria', 'Visited Key Benefit page', '2019-08-08 14:16:41', '2019-08-08 14:16:41'),
(22, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 14:36:56', '2019-08-08 14:36:56'),
(23, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 14:39:27', '2019-08-08 14:39:27'),
(24, '197.157.216.15', 'Nigeria', 'Visited About us page', '2019-08-08 14:40:00', '2019-08-08 14:40:00'),
(25, '199.16.157.182', 'United States', 'Visited Home page', '2019-08-08 14:51:14', '2019-08-08 14:51:14'),
(26, '105.112.50.121', 'Nigeria', 'Visited Home page', '2019-08-08 15:17:46', '2019-08-08 15:17:46'),
(27, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 15:28:05', '2019-08-08 15:28:05'),
(28, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 15:28:39', '2019-08-08 15:28:39'),
(29, '35.233.144.154', 'United States', 'Visited Home page', '2019-08-08 15:41:22', '2019-08-08 15:41:22'),
(30, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 15:48:21', '2019-08-08 15:48:21'),
(31, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 15:51:20', '2019-08-08 15:51:20'),
(32, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 15:52:25', '2019-08-08 15:52:25'),
(33, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 15:52:49', '2019-08-08 15:52:49'),
(34, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 15:54:00', '2019-08-08 15:54:00'),
(35, '41.58.80.116', 'Nigeria', 'Visited Home page', '2019-08-08 16:00:20', '2019-08-08 16:00:20'),
(36, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 16:34:30', '2019-08-08 16:34:30'),
(37, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 16:34:32', '2019-08-08 16:34:32'),
(38, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 16:49:53', '2019-08-08 16:49:53'),
(39, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 16:50:46', '2019-08-08 16:50:46'),
(40, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 16:51:09', '2019-08-08 16:51:09'),
(41, '41.58.80.116', 'Nigeria', 'Visited About us page', '2019-08-08 16:54:28', '2019-08-08 16:54:28'),
(42, '41.58.80.116', 'Nigeria', 'Visited Registration page', '2019-08-08 16:54:48', '2019-08-08 16:54:48'),
(43, '41.58.80.116', 'Nigeria', 'Visited Training Overview page', '2019-08-08 16:55:37', '2019-08-08 16:55:37'),
(44, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 16:58:40', '2019-08-08 16:58:40'),
(45, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 16:59:05', '2019-08-08 16:59:05'),
(46, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 16:59:17', '2019-08-08 16:59:17'),
(47, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 17:00:51', '2019-08-08 17:00:51'),
(48, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 17:00:55', '2019-08-08 17:00:55'),
(49, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 17:01:43', '2019-08-08 17:01:43'),
(50, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 17:02:12', '2019-08-08 17:02:12'),
(51, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 17:04:42', '2019-08-08 17:04:42'),
(52, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 17:06:52', '2019-08-08 17:06:52'),
(53, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 17:08:14', '2019-08-08 17:08:14'),
(54, '66.249.93.65', 'United States', 'Visited Home page', '2019-08-08 17:09:19', '2019-08-08 17:09:19'),
(55, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 17:10:25', '2019-08-08 17:10:25'),
(56, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-08 17:11:21', '2019-08-08 17:11:21'),
(57, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 17:12:09', '2019-08-08 17:12:09'),
(58, '66.249.93.65', 'United States', 'Visited Home page', '2019-08-08 17:12:25', '2019-08-08 17:12:25'),
(59, '66.249.93.31', 'United States', 'Visited Home page', '2019-08-08 17:13:50', '2019-08-08 17:13:50'),
(60, '41.203.78.162', 'Nigeria', 'Visited Home page', '2019-08-08 17:17:45', '2019-08-08 17:17:45'),
(61, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 17:18:29', '2019-08-08 17:18:29'),
(62, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 17:18:57', '2019-08-08 17:18:57'),
(63, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 17:19:21', '2019-08-08 17:19:21'),
(64, '41.58.80.116', 'Nigeria', 'Visited Home page', '2019-08-08 17:19:48', '2019-08-08 17:19:48'),
(65, '41.58.80.116', 'Nigeria', 'Visited Registration page', '2019-08-08 17:20:16', '2019-08-08 17:20:16'),
(66, '41.58.80.116', 'Nigeria', 'Visited Reserve a seat page', '2019-08-08 17:20:32', '2019-08-08 17:20:32'),
(67, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 17:21:07', '2019-08-08 17:21:07'),
(68, '41.58.80.116', 'Nigeria', 'Visited Registration page', '2019-08-08 17:23:32', '2019-08-08 17:23:32'),
(69, '41.58.80.116', 'Nigeria', 'Visited Home page', '2019-08-08 17:23:35', '2019-08-08 17:23:35'),
(70, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 17:24:59', '2019-08-08 17:24:59'),
(71, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 17:25:32', '2019-08-08 17:25:32'),
(72, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 17:29:28', '2019-08-08 17:29:28'),
(73, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 19:03:25', '2019-08-08 19:03:25'),
(74, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-08 19:11:13', '2019-08-08 19:11:13'),
(75, '197.210.57.123', 'Nigeria', 'Visited Home page', '2019-08-08 21:23:09', '2019-08-08 21:23:09'),
(76, '197.210.57.210', 'Nigeria', 'Visited Key Benefit page', '2019-08-08 21:25:53', '2019-08-08 21:25:53'),
(77, '197.210.57.210', 'Nigeria', 'Visited Training Overview page', '2019-08-08 21:26:20', '2019-08-08 21:26:20'),
(78, '197.210.57.210', 'Nigeria', 'Visited Resources Persons page', '2019-08-08 21:26:37', '2019-08-08 21:26:37'),
(79, '197.210.57.123', 'Nigeria', 'Visited Course Program page', '2019-08-08 21:26:53', '2019-08-08 21:26:53'),
(80, '197.210.57.210', 'Nigeria', 'Visited Registration Process page', '2019-08-08 21:27:17', '2019-08-08 21:27:17'),
(81, '197.210.57.210', 'Nigeria', 'Visited Registration page', '2019-08-08 21:27:43', '2019-08-08 21:27:43'),
(82, '197.210.57.210', 'Nigeria', 'Visited Reserve a seat page', '2019-08-08 21:28:18', '2019-08-08 21:28:18'),
(83, '197.210.57.210', 'Nigeria', 'Visited Home page', '2019-08-08 21:34:49', '2019-08-08 21:34:49'),
(84, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 07:39:26', '2019-08-09 07:39:26'),
(85, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 07:39:28', '2019-08-09 07:39:28'),
(86, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 15:16:03', '2019-08-09 15:16:03'),
(87, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 15:17:16', '2019-08-09 15:17:16'),
(88, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 15:53:08', '2019-08-09 15:53:08'),
(89, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 15:59:21', '2019-08-09 15:59:21'),
(90, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 16:14:06', '2019-08-09 16:14:06'),
(91, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 16:19:57', '2019-08-09 16:19:57'),
(92, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 16:25:01', '2019-08-09 16:25:01'),
(93, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 16:25:07', '2019-08-09 16:25:07'),
(94, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 16:25:32', '2019-08-09 16:25:32'),
(95, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 16:25:56', '2019-08-09 16:25:56'),
(96, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 16:26:02', '2019-08-09 16:26:02'),
(97, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 16:28:39', '2019-08-09 16:28:39'),
(98, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 16:29:47', '2019-08-09 16:29:47'),
(99, '66.249.93.65', 'United States', 'Visited Home page', '2019-08-09 16:29:51', '2019-08-09 16:29:51'),
(100, '66.249.93.68', 'United States', 'Visited Registration page', '2019-08-09 16:29:59', '2019-08-09 16:29:59'),
(101, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 16:33:01', '2019-08-09 16:33:01'),
(102, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 16:33:46', '2019-08-09 16:33:46'),
(103, '66.249.93.65', 'United States', 'Visited Registration page', '2019-08-09 16:35:11', '2019-08-09 16:35:11'),
(104, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 16:35:52', '2019-08-09 16:35:52'),
(105, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 16:39:52', '2019-08-09 16:39:52'),
(106, '66.249.93.65', 'United States', 'Visited Registration page', '2019-08-09 16:39:57', '2019-08-09 16:39:57'),
(107, '66.249.93.65', 'United States', 'Visited Registration page', '2019-08-09 16:40:01', '2019-08-09 16:40:01'),
(108, '66.249.93.68', 'United States', 'Visited Registration page', '2019-08-09 16:40:41', '2019-08-09 16:40:41'),
(109, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 16:41:58', '2019-08-09 16:41:58'),
(110, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 16:42:46', '2019-08-09 16:42:46'),
(111, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 16:44:12', '2019-08-09 16:44:12'),
(112, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 16:44:43', '2019-08-09 16:44:43'),
(113, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 17:06:41', '2019-08-09 17:06:41'),
(114, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 17:12:08', '2019-08-09 17:12:08'),
(115, '197.157.216.15', 'Nigeria', 'Visited Reserve a seat page', '2019-08-09 17:20:43', '2019-08-09 17:20:43'),
(116, '197.157.216.15', 'Nigeria', 'Visited Reserve a seat page', '2019-08-09 17:21:01', '2019-08-09 17:21:01'),
(117, '197.157.216.15', 'Nigeria', 'Visited Reserve a seat page', '2019-08-09 17:21:08', '2019-08-09 17:21:08'),
(118, '66.249.93.65', 'United States', 'Visited Registration page', '2019-08-09 17:23:30', '2019-08-09 17:23:30'),
(119, '66.249.93.31', 'United States', 'Visited Registration page', '2019-08-09 17:24:03', '2019-08-09 17:24:03'),
(120, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 17:32:35', '2019-08-09 17:32:35'),
(121, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 17:42:32', '2019-08-09 17:42:32'),
(122, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 17:48:17', '2019-08-09 17:48:17'),
(123, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 18:00:09', '2019-08-09 18:00:09'),
(124, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 18:17:46', '2019-08-09 18:17:46'),
(125, '197.157.216.15', 'Nigeria', 'Visited Reserve a seat page', '2019-08-09 18:21:31', '2019-08-09 18:21:31'),
(126, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 18:22:48', '2019-08-09 18:22:48'),
(127, '197.157.216.15', 'Nigeria', 'Visited Reserve a seat page', '2019-08-09 18:23:01', '2019-08-09 18:23:01'),
(128, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 18:28:00', '2019-08-09 18:28:00'),
(129, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 18:28:04', '2019-08-09 18:28:04'),
(130, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 18:51:25', '2019-08-09 18:51:25'),
(131, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 18:52:06', '2019-08-09 18:52:06'),
(132, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 19:07:03', '2019-08-09 19:07:03'),
(133, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 19:07:18', '2019-08-09 19:07:18'),
(134, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 19:08:02', '2019-08-09 19:08:02'),
(135, '197.157.216.15', 'Nigeria', 'Visited Course Program page', '2019-08-09 19:10:49', '2019-08-09 19:10:49'),
(136, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 19:11:05', '2019-08-09 19:11:05'),
(137, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 19:47:28', '2019-08-09 19:47:28'),
(138, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 19:47:33', '2019-08-09 19:47:33'),
(139, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 19:49:54', '2019-08-09 19:49:54'),
(140, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 19:50:27', '2019-08-09 19:50:27'),
(141, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 19:54:39', '2019-08-09 19:54:39'),
(142, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 19:57:53', '2019-08-09 19:57:53'),
(143, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 19:59:47', '2019-08-09 19:59:47'),
(144, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:06:49', '2019-08-09 20:06:49'),
(145, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:06:50', '2019-08-09 20:06:50'),
(146, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:08:32', '2019-08-09 20:08:32'),
(147, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:08:38', '2019-08-09 20:08:38'),
(148, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:08:47', '2019-08-09 20:08:47'),
(149, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:08:49', '2019-08-09 20:08:49'),
(150, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:10:05', '2019-08-09 20:10:05'),
(151, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:15:02', '2019-08-09 20:15:02'),
(152, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:19:36', '2019-08-09 20:19:36'),
(153, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:21:39', '2019-08-09 20:21:39'),
(154, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:22:11', '2019-08-09 20:22:11'),
(155, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:34:29', '2019-08-09 20:34:29'),
(156, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:35:45', '2019-08-09 20:35:45'),
(157, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:35:50', '2019-08-09 20:35:50'),
(158, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:37:42', '2019-08-09 20:37:42'),
(159, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:38:26', '2019-08-09 20:38:26'),
(160, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:38:28', '2019-08-09 20:38:28'),
(161, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:41:10', '2019-08-09 20:41:10'),
(162, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:41:17', '2019-08-09 20:41:17'),
(163, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:45:37', '2019-08-09 20:45:37'),
(164, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:47:35', '2019-08-09 20:47:35'),
(165, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 20:49:38', '2019-08-09 20:49:38'),
(166, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 20:54:04', '2019-08-09 20:54:04'),
(167, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 20:54:52', '2019-08-09 20:54:52'),
(168, '197.157.216.15', 'Nigeria', 'Registered for program', '2019-08-09 20:56:48', '2019-08-09 20:56:48'),
(169, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 20:56:51', '2019-08-09 20:56:51'),
(170, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 21:02:12', '2019-08-09 21:02:12'),
(171, '197.157.216.15', 'Nigeria', 'Visited About us page', '2019-08-09 21:02:15', '2019-08-09 21:02:15'),
(172, '197.157.216.15', 'Nigeria', 'Visited Registration Process page', '2019-08-09 21:02:18', '2019-08-09 21:02:18'),
(173, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 21:02:56', '2019-08-09 21:02:56'),
(174, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 21:04:01', '2019-08-09 21:04:01'),
(175, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 21:07:18', '2019-08-09 21:07:18'),
(176, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 21:07:25', '2019-08-09 21:07:25'),
(177, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 21:07:57', '2019-08-09 21:07:57'),
(178, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 21:08:38', '2019-08-09 21:08:38'),
(179, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 21:09:22', '2019-08-09 21:09:22'),
(180, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 21:09:44', '2019-08-09 21:09:44'),
(181, '197.157.216.15', 'Nigeria', 'Visited Registration Process page', '2019-08-09 21:09:55', '2019-08-09 21:09:55'),
(182, '197.157.216.15', 'Nigeria', 'Visited About us page', '2019-08-09 21:09:59', '2019-08-09 21:09:59'),
(183, '197.157.216.15', 'Nigeria', 'Visited Registration Process page', '2019-08-09 21:10:02', '2019-08-09 21:10:02'),
(184, '197.157.216.15', 'Nigeria', 'Visited Registration Process page', '2019-08-09 21:12:30', '2019-08-09 21:12:30'),
(185, '197.157.216.15', 'Nigeria', 'Visited Reserve a seat page', '2019-08-09 21:20:45', '2019-08-09 21:20:45'),
(186, '197.157.216.15', 'Nigeria', 'Visited Training Overview page', '2019-08-09 21:27:08', '2019-08-09 21:27:08'),
(187, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 21:30:27', '2019-08-09 21:30:27'),
(188, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 21:43:05', '2019-08-09 21:43:05'),
(189, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 21:45:26', '2019-08-09 21:45:26'),
(190, '197.157.216.15', 'Nigeria', 'Visited Reserve a seat page', '2019-08-09 21:54:17', '2019-08-09 21:54:17'),
(191, '197.157.216.15', 'Nigeria', 'Visited Home page', '2019-08-09 22:02:34', '2019-08-09 22:02:34'),
(192, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 22:02:55', '2019-08-09 22:02:55'),
(193, '197.157.216.15', 'Nigeria', 'Registered for program', '2019-08-09 22:03:30', '2019-08-09 22:03:30'),
(194, '197.157.216.15', 'Nigeria', 'Visited Registration page', '2019-08-09 22:03:34', '2019-08-09 22:03:34'),
(195, '66.249.93.68', 'United States', 'Visited Home page', '2019-08-09 23:00:03', '2019-08-09 23:00:03'),
(196, '66.249.93.65', 'United States', 'Visited Registration page', '2019-08-09 23:01:12', '2019-08-09 23:01:12'),
(197, '105.112.52.5', 'Nigeria', 'Visited Registration page', '2019-08-10 00:22:47', '2019-08-10 00:22:47'),
(198, '105.112.52.5', 'Nigeria', 'Registered for program', '2019-08-10 00:23:35', '2019-08-10 00:23:35'),
(199, '105.112.52.5', 'Nigeria', 'Print Acknowledgement Slip', '2019-08-10 00:23:40', '2019-08-10 00:23:40'),
(200, '105.112.52.5', 'Nigeria', 'Visited Registration page', '2019-08-10 00:24:09', '2019-08-10 00:24:09'),
(201, '105.112.52.5', 'Nigeria', 'Print Acknowledgement Slip', '2019-08-10 00:36:31', '2019-08-10 00:36:31'),
(202, '105.112.52.5', 'Nigeria', 'Print Acknowledgement Slip', '2019-08-10 00:36:59', '2019-08-10 00:36:59'),
(203, '105.112.52.5', 'Nigeria', 'Visited Registration page', '2019-08-10 00:37:52', '2019-08-10 00:37:52'),
(204, '105.112.52.5', 'Nigeria', 'Registered for program', '2019-08-10 00:38:51', '2019-08-10 00:38:51'),
(205, '105.112.52.5', 'Nigeria', 'Print Acknowledgement Slip', '2019-08-10 00:38:55', '2019-08-10 00:38:55'),
(206, '105.112.52.5', 'Nigeria', 'Print Acknowledgement Slip', '2019-08-10 00:40:23', '2019-08-10 00:40:23'),
(207, '105.112.52.5', 'Nigeria', 'Print Acknowledgement Slip', '2019-08-10 00:41:23', '2019-08-10 00:41:23'),
(208, '105.112.52.5', 'Nigeria', 'Print Acknowledgement Slip', '2019-08-10 00:42:22', '2019-08-10 00:42:22'),
(209, '66.249.93.68', 'United States', 'Visited Home page', '2019-08-10 07:18:22', '2019-08-10 07:18:22'),
(210, '66.249.93.68', 'United States', 'Visited Registration page', '2019-08-10 07:19:49', '2019-08-10 07:19:49'),
(211, '66.249.93.68', 'United States', 'Visited Home page', '2019-08-10 07:20:15', '2019-08-10 07:20:15'),
(212, '66.249.93.68', 'United States', 'Visited About us page', '2019-08-10 07:20:57', '2019-08-10 07:20:57'),
(213, '66.249.93.68', 'United States', 'Visited Contact us page', '2019-08-10 07:21:47', '2019-08-10 07:21:47'),
(214, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-10 14:50:42', '2019-08-10 14:50:42'),
(215, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-10 14:51:06', '2019-08-10 14:51:06'),
(216, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-10 14:55:09', '2019-08-10 14:55:09'),
(217, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-10 14:58:20', '2019-08-10 14:58:20'),
(218, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-10 15:00:34', '2019-08-10 15:00:34'),
(219, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-10 15:06:41', '2019-08-10 15:06:41'),
(220, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-10 15:09:21', '2019-08-10 15:09:21'),
(221, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-10 15:34:19', '2019-08-10 15:34:19'),
(222, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-10 15:35:56', '2019-08-10 15:35:56'),
(223, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-10 15:39:14', '2019-08-10 15:39:14'),
(224, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-10 15:40:26', '2019-08-10 15:40:26'),
(225, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-10 15:41:13', '2019-08-10 15:41:13'),
(226, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-10 15:43:29', '2019-08-10 15:43:29'),
(227, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-10 15:50:11', '2019-08-10 15:50:11'),
(228, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-10 16:09:07', '2019-08-10 16:09:07'),
(229, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-11 13:15:45', '2019-08-11 13:15:45'),
(230, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-11 14:54:13', '2019-08-11 14:54:13'),
(231, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-11 14:58:12', '2019-08-11 14:58:12'),
(232, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-11 15:10:12', '2019-08-11 15:10:12'),
(233, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-11 15:13:55', '2019-08-11 15:13:55'),
(234, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-11 16:23:59', '2019-08-11 16:23:59'),
(235, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-11 16:24:40', '2019-08-11 16:24:40'),
(236, '127.0.0.0', 'United States', 'Register to reserve a seat', '2019-08-11 16:28:04', '2019-08-11 16:28:04'),
(237, '127.0.0.0', 'United States', 'Print Acknowledgement Slip', '2019-08-11 16:28:09', '2019-08-11 16:28:09'),
(238, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-11 16:28:53', '2019-08-11 16:28:53'),
(239, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-11 17:23:23', '2019-08-11 17:23:23'),
(240, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-11 17:25:53', '2019-08-11 17:25:53'),
(241, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-11 17:30:58', '2019-08-11 17:30:58'),
(242, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-11 17:43:57', '2019-08-11 17:43:57'),
(243, '127.0.0.0', 'United States', 'Registered for program', '2019-08-11 17:46:20', '2019-08-11 17:46:20'),
(244, '127.0.0.0', 'United States', 'Print Acknowledgement Slip', '2019-08-11 17:46:25', '2019-08-11 17:46:25'),
(245, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-11 17:46:36', '2019-08-11 17:46:36'),
(246, '127.0.0.0', 'United States', 'Redone registeration', '2019-08-11 17:48:25', '2019-08-11 17:48:25'),
(247, '127.0.0.0', 'United States', 'Print Acknowledgement Slip', '2019-08-11 17:48:29', '2019-08-11 17:48:29'),
(248, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-11 17:56:08', '2019-08-11 17:56:08'),
(249, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-11 17:58:33', '2019-08-11 17:58:33'),
(250, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-11 18:07:34', '2019-08-11 18:07:34'),
(251, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-11 18:55:32', '2019-08-11 18:55:32'),
(252, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-11 19:15:50', '2019-08-11 19:15:50'),
(253, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-11 19:16:03', '2019-08-11 19:16:03'),
(254, '127.0.0.0', 'United States', 'Redone registeration', '2019-08-11 19:36:41', '2019-08-11 19:36:41'),
(255, '127.0.0.0', 'United States', 'Print Acknowledgement Slip', '2019-08-11 19:36:47', '2019-08-11 19:36:47'),
(256, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-11 20:00:28', '2019-08-11 20:00:28'),
(257, '127.0.0.0', 'United States', 'Registered for program', '2019-08-11 20:03:28', '2019-08-11 20:03:28'),
(258, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-11 20:09:05', '2019-08-11 20:09:05'),
(259, '127.0.0.0', 'United States', 'Registered for program', '2019-08-11 20:09:53', '2019-08-11 20:09:53'),
(260, '127.0.0.0', 'United States', 'Print Acknowledgement Slip', '2019-08-11 20:09:57', '2019-08-11 20:09:57'),
(261, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 08:02:01', '2019-08-14 08:02:01'),
(262, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 08:03:19', '2019-08-14 08:03:19'),
(263, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 08:03:46', '2019-08-14 08:03:46'),
(264, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 08:03:57', '2019-08-14 08:03:57'),
(265, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 08:08:13', '2019-08-14 08:08:13'),
(266, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 08:13:51', '2019-08-14 08:13:51'),
(267, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 08:16:15', '2019-08-14 08:16:15'),
(268, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 08:17:32', '2019-08-14 08:17:32'),
(269, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 08:17:36', '2019-08-14 08:17:36'),
(270, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 08:17:38', '2019-08-14 08:17:38'),
(271, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 08:17:42', '2019-08-14 08:17:42'),
(272, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 08:17:44', '2019-08-14 08:17:44'),
(273, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 08:17:48', '2019-08-14 08:17:48'),
(274, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 08:18:37', '2019-08-14 08:18:37'),
(275, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:18:04', '2019-08-14 17:18:04'),
(276, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:24:27', '2019-08-14 17:24:27'),
(277, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:27:24', '2019-08-14 17:27:24'),
(278, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:28:22', '2019-08-14 17:28:22'),
(279, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:28:50', '2019-08-14 17:28:50'),
(280, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:29:25', '2019-08-14 17:29:25'),
(281, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:29:47', '2019-08-14 17:29:47'),
(282, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:30:05', '2019-08-14 17:30:05'),
(283, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:30:25', '2019-08-14 17:30:25'),
(284, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:33:26', '2019-08-14 17:33:26'),
(285, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:35:44', '2019-08-14 17:35:44'),
(286, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:37:28', '2019-08-14 17:37:28'),
(287, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:40:51', '2019-08-14 17:40:51'),
(288, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:41:12', '2019-08-14 17:41:12'),
(289, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:42:27', '2019-08-14 17:42:27'),
(290, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:44:00', '2019-08-14 17:44:00'),
(291, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:44:36', '2019-08-14 17:44:36'),
(292, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:45:15', '2019-08-14 17:45:15'),
(293, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:45:43', '2019-08-14 17:45:43'),
(294, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:47:38', '2019-08-14 17:47:38'),
(295, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:49:01', '2019-08-14 17:49:01'),
(296, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:52:22', '2019-08-14 17:52:22'),
(297, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:53:36', '2019-08-14 17:53:36'),
(298, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:54:03', '2019-08-14 17:54:03'),
(299, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:54:47', '2019-08-14 17:54:47'),
(300, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:55:46', '2019-08-14 17:55:46'),
(301, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:56:52', '2019-08-14 17:56:52'),
(302, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:57:13', '2019-08-14 17:57:13'),
(303, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:57:26', '2019-08-14 17:57:26'),
(304, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:57:52', '2019-08-14 17:57:52'),
(305, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:58:31', '2019-08-14 17:58:31'),
(306, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:58:40', '2019-08-14 17:58:40'),
(307, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:58:49', '2019-08-14 17:58:49'),
(308, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:59:24', '2019-08-14 17:59:24'),
(309, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 17:59:33', '2019-08-14 17:59:33'),
(310, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 18:00:01', '2019-08-14 18:00:01'),
(311, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 18:00:09', '2019-08-14 18:00:09'),
(312, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 18:03:43', '2019-08-14 18:03:43'),
(313, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 18:06:20', '2019-08-14 18:06:20'),
(314, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 18:07:05', '2019-08-14 18:07:05'),
(315, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 18:07:39', '2019-08-14 18:07:39'),
(316, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 18:08:17', '2019-08-14 18:08:17'),
(317, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 18:08:31', '2019-08-14 18:08:31'),
(318, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 21:21:39', '2019-08-14 21:21:39'),
(319, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-14 21:22:24', '2019-08-14 21:22:24'),
(320, '127.0.0.0', 'United States', 'Visited Privacy and Policy page', '2019-08-14 21:22:51', '2019-08-14 21:22:51'),
(321, '127.0.0.0', 'United States', 'Visited Privacy and Policy page', '2019-08-14 21:23:35', '2019-08-14 21:23:35'),
(322, '127.0.0.0', 'United States', 'Visited Privacy and Policy page', '2019-08-14 21:27:13', '2019-08-14 21:27:13'),
(323, '127.0.0.0', 'United States', 'Visited Privacy and Policy page', '2019-08-14 21:27:40', '2019-08-14 21:27:40'),
(324, '127.0.0.0', 'United States', 'Visited Privacy and Policy page', '2019-08-14 21:27:59', '2019-08-14 21:27:59'),
(325, '127.0.0.0', 'United States', 'Visited Privacy and Policy page', '2019-08-14 21:28:50', '2019-08-14 21:28:50'),
(326, '127.0.0.0', 'United States', 'Visited Privacy and Policy page', '2019-08-14 21:31:19', '2019-08-14 21:31:19'),
(327, '127.0.0.0', 'United States', 'Visited Privacy and Policy page', '2019-08-14 21:32:05', '2019-08-14 21:32:05'),
(328, '127.0.0.0', 'United States', 'Visited Privacy and Policy page', '2019-08-14 21:43:26', '2019-08-14 21:43:26'),
(329, '127.0.0.0', 'United States', 'Visited Privacy and Policy page', '2019-08-14 21:50:24', '2019-08-14 21:50:24'),
(330, '127.0.0.0', 'United States', 'Visited Privacy and Policy page', '2019-08-14 21:52:53', '2019-08-14 21:52:53'),
(331, '127.0.0.0', 'United States', 'Visited Privacy and Policy page', '2019-08-14 21:53:07', '2019-08-14 21:53:07'),
(332, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-16 22:04:48', '2019-08-16 22:04:48'),
(333, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-16 22:05:29', '2019-08-16 22:05:29'),
(334, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-19 08:18:10', '2019-08-19 08:18:10'),
(335, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-19 09:07:55', '2019-08-19 09:07:55'),
(336, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-19 09:09:15', '2019-08-19 09:09:15'),
(337, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-19 09:09:39', '2019-08-19 09:09:39'),
(338, '127.0.0.0', 'United States', 'Visited About us page', '2019-08-19 09:09:55', '2019-08-19 09:09:55'),
(339, '127.0.0.0', 'United States', 'Visited About us page', '2019-08-19 09:11:46', '2019-08-19 09:11:46'),
(340, '127.0.0.0', 'United States', 'Visited About us page', '2019-08-19 09:11:57', '2019-08-19 09:11:57'),
(341, '127.0.0.0', 'United States', 'Visited About us page', '2019-08-19 09:13:31', '2019-08-19 09:13:31'),
(342, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 09:15:04', '2019-08-19 09:15:04'),
(343, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 09:15:36', '2019-08-19 09:15:36'),
(344, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-19 09:15:45', '2019-08-19 09:15:45'),
(345, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-19 09:16:38', '2019-08-19 09:16:38'),
(346, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-19 09:17:10', '2019-08-19 09:17:10'),
(347, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-19 09:17:38', '2019-08-19 09:17:38'),
(348, '127.0.0.0', 'United States', 'Visited About us page', '2019-08-19 09:20:51', '2019-08-19 09:20:51'),
(349, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-19 09:21:51', '2019-08-19 09:21:51'),
(350, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-19 09:46:04', '2019-08-19 09:46:04'),
(351, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-19 09:58:40', '2019-08-19 09:58:40'),
(352, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 10:01:09', '2019-08-19 10:01:09'),
(353, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 10:22:21', '2019-08-19 10:22:21'),
(354, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 10:33:04', '2019-08-19 10:33:04'),
(355, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 10:33:34', '2019-08-19 10:33:34'),
(356, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 10:35:17', '2019-08-19 10:35:17'),
(357, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 10:39:00', '2019-08-19 10:39:00'),
(358, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 10:40:28', '2019-08-19 10:40:28'),
(359, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 10:45:50', '2019-08-19 10:45:50'),
(360, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 10:46:16', '2019-08-19 10:46:16'),
(361, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 10:47:13', '2019-08-19 10:47:13'),
(362, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 10:49:40', '2019-08-19 10:49:40'),
(363, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 10:50:30', '2019-08-19 10:50:30'),
(364, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 11:03:04', '2019-08-19 11:03:04'),
(365, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 11:04:08', '2019-08-19 11:04:08'),
(366, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 11:04:35', '2019-08-19 11:04:35'),
(367, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 11:05:33', '2019-08-19 11:05:33'),
(368, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 11:06:50', '2019-08-19 11:06:50'),
(369, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 11:13:38', '2019-08-19 11:13:38'),
(370, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 11:26:11', '2019-08-19 11:26:11'),
(371, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 11:37:44', '2019-08-19 11:37:44'),
(372, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 11:38:40', '2019-08-19 11:38:40'),
(373, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 11:44:33', '2019-08-19 11:44:33'),
(374, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 11:46:49', '2019-08-19 11:46:49'),
(375, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 11:52:46', '2019-08-19 11:52:46'),
(376, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 12:47:09', '2019-08-19 12:47:09'),
(377, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 12:47:54', '2019-08-19 12:47:54'),
(378, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 12:48:50', '2019-08-19 12:48:50'),
(379, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 12:51:31', '2019-08-19 12:51:31'),
(380, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:06:45', '2019-08-19 13:06:45'),
(381, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:07:36', '2019-08-19 13:07:36'),
(382, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:08:27', '2019-08-19 13:08:27'),
(383, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:10:26', '2019-08-19 13:10:26'),
(384, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:11:31', '2019-08-19 13:11:31'),
(385, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:11:36', '2019-08-19 13:11:36'),
(386, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:11:38', '2019-08-19 13:11:38'),
(387, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:11:39', '2019-08-19 13:11:39'),
(388, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:11:41', '2019-08-19 13:11:41'),
(389, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:13:02', '2019-08-19 13:13:02'),
(390, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:14:45', '2019-08-19 13:14:45'),
(391, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:16:31', '2019-08-19 13:16:31'),
(392, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:28:44', '2019-08-19 13:28:44'),
(393, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:28:59', '2019-08-19 13:28:59'),
(394, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:29:33', '2019-08-19 13:29:33'),
(395, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:31:02', '2019-08-19 13:31:02'),
(396, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:31:53', '2019-08-19 13:31:53'),
(397, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:33:06', '2019-08-19 13:33:06'),
(398, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:33:49', '2019-08-19 13:33:49'),
(399, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:34:58', '2019-08-19 13:34:58'),
(400, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:35:56', '2019-08-19 13:35:56'),
(401, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:39:04', '2019-08-19 13:39:04'),
(402, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:40:31', '2019-08-19 13:40:31'),
(403, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:41:07', '2019-08-19 13:41:07'),
(404, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:42:34', '2019-08-19 13:42:34'),
(405, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:45:05', '2019-08-19 13:45:05'),
(406, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:46:55', '2019-08-19 13:46:55'),
(407, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 13:49:48', '2019-08-19 13:49:48'),
(408, '127.0.0.0', 'United States', 'Registered for program', '2019-08-19 13:54:28', '2019-08-19 13:54:28'),
(409, '127.0.0.0', 'United States', 'Redone registeration', '2019-08-19 14:01:15', '2019-08-19 14:01:15'),
(410, '127.0.0.0', 'United States', 'Registered for program', '2019-08-19 14:01:52', '2019-08-19 14:01:52'),
(411, '127.0.0.0', 'United States', 'Redone registeration', '2019-08-19 14:03:28', '2019-08-19 14:03:28'),
(412, '127.0.0.0', 'United States', 'Registered for program', '2019-08-19 14:04:25', '2019-08-19 14:04:25'),
(413, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 14:14:08', '2019-08-19 14:14:08'),
(414, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 14:15:43', '2019-08-19 14:15:43'),
(415, '127.0.0.0', 'United States', 'Registered for program', '2019-08-19 14:17:28', '2019-08-19 14:17:28'),
(416, '127.0.0.0', 'United States', 'Print Acknowledgement Slip', '2019-08-19 14:24:55', '2019-08-19 14:24:55'),
(417, '127.0.0.0', 'United States', 'Print Acknowledgement Slip', '2019-08-19 14:26:16', '2019-08-19 14:26:16'),
(418, '127.0.0.0', 'United States', 'Print Acknowledgement Slip', '2019-08-19 14:27:22', '2019-08-19 14:27:22'),
(419, '127.0.0.0', 'United States', 'Print Acknowledgement Slip', '2019-08-19 14:27:50', '2019-08-19 14:27:50'),
(420, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-19 14:28:28', '2019-08-19 14:28:28'),
(421, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-19 14:28:40', '2019-08-19 14:28:40'),
(422, '127.0.0.0', 'United States', 'Visited Registration page', '2019-08-19 14:28:43', '2019-08-19 14:28:43'),
(423, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-19 14:35:32', '2019-08-19 14:35:32'),
(424, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-19 14:39:15', '2019-08-19 14:39:15'),
(425, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-19 14:40:38', '2019-08-19 14:40:38'),
(426, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-19 14:48:50', '2019-08-19 14:48:50'),
(427, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-19 14:50:03', '2019-08-19 14:50:03'),
(428, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-19 14:50:33', '2019-08-19 14:50:33'),
(429, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-19 14:50:45', '2019-08-19 14:50:45'),
(430, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-19 14:52:08', '2019-08-19 14:52:08'),
(431, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-19 14:53:46', '2019-08-19 14:53:46'),
(432, '127.0.0.0', 'United States', 'Visited Reserve a seat page', '2019-08-19 14:54:41', '2019-08-19 14:54:41'),
(433, '127.0.0.0', 'United States', 'Visited Home page', '2019-08-19 16:48:47', '2019-08-19 16:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `eventID` varchar(255) DEFAULT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `venue` text,
  `status` int(11) DEFAULT '0',
  `event_date_from` varchar(255) DEFAULT NULL,
  `event_date_to` varchar(255) DEFAULT NULL,
  `event_time_from` varchar(255) DEFAULT NULL,
  `event_time_to` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `event_fee` varchar(255) DEFAULT NULL,
  `counter` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `eventID`, `event_name`, `location`, `venue`, `status`, `event_date_from`, `event_date_to`, `event_time_from`, `event_time_to`, `duration`, `event_fee`, `counter`, `created_at`, `updated_at`) VALUES
(1, '5d4eca03d761c1565444611', 'Finance Skills fro Lawyers', 'Lagos', 'LCCI, Alausa, CBD- Ikeja, Lagos', 1, '2019-09-12', '2019-09-13', '09:00', '17:00', '2 days', '50000', 0, '2019-08-10 13:47:38', '2019-08-10 13:47:38'),
(2, '5d4ecb00da7241565444864', 'Finance Skills for Lawyers', 'Abuja', 'To be announced later', 1, '2019-10-10', '2019-10-11', '09:00', '17:00', '2 days', '60000', 7, '2019-08-10 13:50:10', '2019-08-19 13:17:28'),
(3, '5d4ecb9432e721565445012', 'Finance Skills for Lawyers', 'Port Harcourt', 'To be announced later', 1, '2019-11-14', '2019-11-15', '09:00', '17:00', '2 days', '65000', 0, '2019-08-10 13:52:14', '2019-08-10 13:52:14'),
(4, '5d4ecc359afa31565445173', 'Finance Skills for Lawyers', 'Lagos', 'To be announced later', 0, '2020-02-13', '2020-02-14', '09:00', '17:00', '2 days', '54965', 0, '2019-08-10 13:54:44', '2019-08-10 13:54:44'),
(5, '5d4eccb5812ad1565445301', 'Finance Skills for Lawyers', 'Abuja', 'To be announced later', 0, '2020-03-12', '2020-03-13', '09:00', '17:00', '2 days', '64990', 0, '2019-08-10 13:57:12', '2019-08-10 13:57:12'),
(6, '5d4ecd39c16d91565445433', 'Finance Skills for Lawyers', 'Port Harcourt', 'To be announced later', 0, '2020-04-16', '2020-04-17', '09:00', '17:00', '2 days', '70000', 0, '2019-08-10 13:59:50', '2019-08-10 12:59:52'),
(7, '5d4ecdda58ead1565445594', 'Finance Skills for Lawyers', 'Lagos', 'To be announced later', 0, '2019-05-14', '2020-05-15', '09:00', '17:00', '2 days', '60000', 0, '2019-08-10 14:01:39', '2019-08-10 14:01:39'),
(8, '5d4ece446cfc31565445700', 'Finance Skills for Lawyers', 'Abuja', 'To be announced later', 0, '2020-06-11', '2020-06-12', '09:00', '17:00', '2 days', '70000', 0, '2019-08-10 14:03:40', '2019-08-10 14:03:40'),
(9, '5d4ecebe421181565445822', 'Finance Skills for Lawyers', 'Port Harcourt', 'To be announced later', 0, '2020-07-16', '2020-07-17', '09:00', '17:00', '2 days', '75000', 0, '2019-08-10 14:05:21', '2019-08-10 14:05:21'),
(10, '5d4ecf22b4c8a1565445922', 'Finance Skills for Lawyers', 'Lagos', 'To be announced later', 0, '2020-09-10', '2020-09-11', '09:00', '17:00', '2 days', '65000', 0, '2019-08-10 14:06:59', '2019-08-10 14:06:59'),
(11, '5d4ecf855d5201565446021', 'Finance Skills for Lawyers', 'Abuja', 'To be announced later', 0, '2020-10-15', '2020-10-16', '09:00', '17:00', '2 days', '75000', 0, '2019-08-10 14:08:29', '2019-08-10 14:08:29'),
(12, '5d4ecfdee6ad11565446110', 'Finance Skills for Lawyers', 'Port Harcourt', 'To be announced later', 0, '2020-07-16', '2020-07-17', '09:00', '17:00', '2 days', '80000', 0, '2019-08-10 14:10:27', '2019-08-10 14:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `brief_about` text,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `fullname`, `position`, `facebook`, `twitter`, `linkedin`, `skype`, `brief_about`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Olusegun Adebiyi FCA, MBA', 'Programme Director', NULL, 'https://twitter.com/segunadebiyi?s=17', 'https://www.linkedin.com/in/duntanadebiyi', 'olusegun.j18heir', 'Mr Olusegun Adebiyi (FCA, CPA, MBA)\nProfession: Accountant\nDate of birth: May 10, 1972\nNationality: Nigerian\nMembership in professional societies:\nMember, The Institutes of Chartered Accountants of Nigeria, ICAN, Lagos, Nigeria\nMember: New York Society of Certified Public Accountant, New York, USA\nEducation:\nLagos Business School, Nigeria – Senior Management Program 2004\nUniversity Of Ado-Ekiti, Nigeria- Master Of Business Administration (Finance) 2000\nThe Polytechnic, Ibadan, Nigeria – Higher Diploma (Accounting) 1997\nMemberships:\nFellow Member, The Institute of Chartered Accountants Of Nigeria\nCertified Public Accountant, New Your State Society of Certified Public Accountants\nAssociate Member, Chartered Institute of Stockbrokers, Nigeria\nThe Employment Record:\nManaging Partner, OACO Professional Services (Chartered Accountants), Lagos, Nigeria\nCountry Head, John Smith Consulting, Lagos, Nigeria\nFinancial Analyst, Real Options Properties Services Limited Lagos, Nigeria\nStaff Officer- Loan & Revenue, Post-Service Housing Directorate, (PhD-A) Nigerian Army, Lagos,\nNigeria\nFinancial Consultant, Capital Management Consulting, Lagos, Nigeria\nAudit Supervisor, Folorunsho Olaleye & Co., Chartered Accountants, Lagos, Nigeria', '2003027201_1565278080.jpg', '2019-08-08 15:28:00', '2019-08-08 15:28:00'),
(2, 'MRS. OLUWAKEMI REBECCA AYODELE, BSc, LLB, ACA', 'Faculty', NULL, NULL, NULL, NULL, 'MRS. OLUWAKEMI REBECCA AYODELE, BSc, LLB, ACA\nProfession: Accountant\nDate of birth: June 2, 1989\nNationality: Nigerian\nMembership in professional societies:\nMember, Nigeria Bar Association (NBA)\nMember, The Institutes of Chartered Accountants of Nigeria, ICAN, Lagos, Nigeria\nMember, Association of Accounting Technician\nEducation:\nNigerian Law School, Lagos Campus, Nigeria\nLLB (Hons) Law (2:2), University of Lagos, Nigeria\nB.Sc (Hons), Accounting, (2.1) University of Lagos, Nigeria\nMemberships:\nAssociate Member, Institute of Chartered Accountants of Nigeria (ICAN)\nAssociate Member, Associate Accounting Technician (AAT)\nThe Employment Record:\nHead, Knowledge-Gap Resource Unit, OACO Professional Services\nSenior Manager (Operations)/Accountant, Megaplux Global Access\nAccountant/Facilitator A.J. Silicon Tech', '114682632_1565281347.jpg', '2019-08-08 16:22:27', '2019-08-08 16:22:27'),
(3, 'Mr Oni Pius Wale (ACA, HND, PGDE)', 'Lead Faculty', NULL, NULL, 'https://www.linkedin.com/in/pius-wale-oni-717b8533', NULL, 'Profession: Accounting\nDate of birth: January 13, 1979.\nNationality: Nigerian\nMembership in professional societies:\nMember, The Institute of Chartered Accountants of Nigeria (ICAN)\nEducation:\nPost Graduate Diploma in Education, PGDE, National Teachers Institute, Kaduna\nHigher National Diploma (HND) Accounting (Distinction), Osun State Polytechnic, Iree, Osun State\nNational Diploma (ND) Financial Studies (Distinction), Osun State Polytechnic, Iree, Osun State\nMemberships:\nAssociate Member, The Institutes of Chartered Accountants of Nigeria\nEmployment Record:\nPartner, Financial Reporting, OACO Professional Services (Chartered Accountants)\nHead, Audit Standards and Quality Assurance (Internal Audit), First Bank of Nigeria Plc\nManager, Ernst & Young (Chartered Accountants)\nRisk Assurance Executive, AES Nigeria Barge Limited\nManagement Accountant, PHCN Business Unit Premises, Egbin Generating Power Station, Egbin.', '1983972288_1565282964.jpg', '2019-08-08 16:49:24', '2019-08-08 16:49:24');

-- --------------------------------------------------------

--
-- Table structure for table `fsfl_admin`
--

CREATE TABLE `fsfl_admin` (
  `id` int(11) NOT NULL,
  `userID` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fsfl_admin`
--

INSERT INTO `fsfl_admin` (`id`, `userID`, `username`, `password`, `name`, `created_at`, `updated_at`) VALUES
(1, 'FSFL_Admin', 'Admin', '$2y$10$bwf56VR8e9gK6FqMu5nWmOmEDX4ei1hD5rAU4kGaYDTIywAjjhs3m', 'Administrator', '2019-08-08 07:08:22', '2019-08-08 07:08:22'),
(2, 'FSFL_Bambo', 'Bambo', '$2y$10$bwf56VR8e9gK6FqMu5nWmOmEDX4ei1hD5rAU4kGaYDTIywAjjhs3m', 'Adenuga Adebambo', '2019-08-08 07:08:22', '2019-08-08 07:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(11) NOT NULL,
  `programID` varchar(255) DEFAULT NULL,
  `event_date` varchar(255) DEFAULT NULL,
  `event_time_from` varchar(255) DEFAULT NULL,
  `event_time_to` varchar(255) DEFAULT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `about_event` text,
  `facilitator` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'noImage.png',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `programID`, `event_date`, `event_time_from`, `event_time_to`, `event_name`, `about_event`, `facilitator`, `position`, `image`, `created_at`, `updated_at`) VALUES
(1, '5d4dd7cc7669a1565382604', '2019-09-12', '09:00', '17:00', 'Finance Training for Lawyers-Day 1', '<p><b>Registration of Participants.Financial Accounting.Question &amp; Answer.Balance Sheet, Classification And Ratios.</b></p><p><b>Question &amp; Answer.Tea Break.Profit And Loss Account, Classification And Ratios.Question &amp; Answer.Statement Of Cash Flow.</b></p><p><b>Question &amp; Answer.Lunch Break.Working Capital &amp; Case Study.Question &amp; Answer.Summary/ General Interaction/Feedback</b></p>', 'Olusegun Adebiyi FCA, MBA', 'Programme Director', '1316882655_1565382818.jpg', '2019-08-09 20:33:38', '2019-08-09 20:33:38'),
(2, '5d4dd8a31001a1565382819', '2019-09-13', '09:00', '17:00', 'Finance Training for Lawyers-Day 2', '<p>Introduction to cash flow.Computation of ratios.Question and Answer.Introduction to Capital Budgeting and Capital Expenditure.Concepts of Discounting, Compounding and Annuities, Case Study. Question &amp; Answer. Introduction to Business Valuation methods. Discounted Cash Flow.Business Valuation and Case Study.Cost of Capital.Question and Answer.Tea Break.Time value of money and implication in the corporate world.(Discussions with Participants based on the introductions). Open Session. Lunch Break. Introduction to Intellectual Property (IP) Valuation. Summary for the days training. Training evaluation form management for feedback. Issuance of certificate of participation to attendees. Photo Session.</p>', 'Mr Oni Pius Wale (ACA, HND, PGDE)', 'Lead Faculty', '1240556275_1565383102.jpg', '2019-08-09 20:35:41', '2019-08-10 03:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `register_group`
--

CREATE TABLE `register_group` (
  `id` int(11) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `training_day` varchar(255) DEFAULT NULL,
  `training_time` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `fee` varchar(255) DEFAULT NULL,
  `groupID` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `group_amount` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `deposit_number` varchar(255) DEFAULT NULL,
  `deposit_date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register_group`
--

INSERT INTO `register_group` (`id`, `location`, `training_day`, `training_time`, `duration`, `venue`, `fee`, `groupID`, `firstname`, `lastname`, `email`, `telephone`, `company_name`, `address`, `group_amount`, `user_type`, `deposit_number`, `deposit_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', 'To be announced later', 'N60000', 'pilsFSFL_1566222588', 'ffad', 'nzdgn', 'profilr2019@gmail.com', 'sfgm', 'sfgm', 'sfgm', '114000', 'group', 'sfgmsgf', '2019-08-09', 'open', '2019-08-19 13:54:28', '2019-08-19 13:54:28'),
(2, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', 'To be announced later', 'N60000', 'pilsFSFL_1566222588', 'gaa', 'a', 'profilr2019@gmail.com', 'sfgm', 'sfgm', 'sfgm', '114000', 'group', 'sfgmsgf', '2019-08-09', 'open', '2019-08-19 13:54:28', '2019-08-19 13:54:28'),
(3, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', 'To be announced later', 'N60000', 'pilsFSFL_1566222588', 'ffad', 'nzdgn', 'profilr2019@gmail.comaa', 'sfgm', 'sfgm', 'sfgm', '114000', 'group', 'sfgmsgf', '2019-08-09', 'open', '2019-08-19 14:01:52', '2019-08-19 14:01:52'),
(4, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', 'To be announced later', 'N60000', 'pilsFSFL_1566222588', 'gaa', 'a', 'profilr2019@gmail.comaa', 'sfgm', 'sfgm', 'sfgm', '114000', 'group', 'sfgmsgf', '2019-08-09', 'open', '2019-08-19 14:01:52', '2019-08-19 14:01:52'),
(5, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', 'To be announced later', 'N60000', 'pilsFSFL_1566222588', 'ffad', 'nzdgn', 'alexandradfabd@look.voom', 'sfgm', 'sfgm', 'sfgm', '114000', 'group', 'sfgmsgf', '2019-08-09', 'open', '2019-08-19 14:04:25', '2019-08-19 14:04:25'),
(6, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', 'To be announced later', 'N60000', 'pilsFSFL_1566222588', 'gaa', 'a', 'alexandradfabd@look.voom', 'sfgm', 'sfgm', 'sfgm', '114000', 'group', 'sfgmsgf', '2019-08-09', 'open', '2019-08-19 14:04:26', '2019-08-19 14:04:26'),
(7, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', 'To be announced later', 'N60000', 'pilsFSFL_1566224144', 'dsgas', 'adgad', 'superadmin@agile.com', '615', 'asdasdb', 'asdbas', '171000', 'group', 'asdbasd', '2019-08-10', 'open', '2019-08-19 14:17:28', '2019-08-19 14:17:28'),
(8, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', 'To be announced later', 'N60000', 'pilsFSFL_1566224144', 'adsgas', 'asdgasd', 'superadmin@agile.com', '615', 'asdasdb', 'asdbas', '171000', 'group', 'asdbasd', '2019-08-10', 'open', '2019-08-19 14:17:29', '2019-08-19 14:17:29'),
(9, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', 'To be announced later', 'N60000', 'pilsFSFL_1566224144', 'asdg', 'asdg', 'superadmin@agile.com', '615', 'asdasdb', 'asdbas', '171000', 'group', 'asdbasd', '2019-08-10', 'open', '2019-08-19 14:17:29', '2019-08-19 14:17:29');

-- --------------------------------------------------------

--
-- Table structure for table `register_now`
--

CREATE TABLE `register_now` (
  `id` int(11) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `training_day` varchar(255) DEFAULT NULL,
  `training_time` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `fee` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `deposit_number` varchar(255) DEFAULT NULL,
  `deposit_date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register_now`
--

INSERT INTO `register_now` (`id`, `location`, `training_day`, `training_time`, `duration`, `venue`, `fee`, `firstname`, `lastname`, `email`, `telephone`, `company_name`, `address`, `deposit_number`, `deposit_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', 'To be announced later', 'N60000', 'Adebambo', 'Adenuga', 'adenugaadebambo41@gmail.com', '08137492316', '12345', 'Skylark Hospital Road Agura Sabo', 'fgrj', '2019-08-03', 'open', '2019-08-11 18:04:32', '2019-08-11 18:36:00'),
(2, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', 'To be announced later', 'N60000', 'Ajibola', 'Olakunle', 'kuns4real@gmail.com', '07033883255', 'rharh', 'Skylark Hospital Road Agura Sabo', '57744hgcxzvxc4353545644', '2019-08-10', 'open', '2019-08-11 20:03:03', '2019-08-11 20:03:03'),
(3, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', 'To be announced later', 'N60000', 'Adewunmi', 'Adenuga', 'adewunmia@gmail.com', '08137492316', 'Mr', 'Skylark Hospital Road Agura Sabo', 'hghvj', '2019-08-16', 'open', '2019-08-11 20:09:48', '2019-08-11 20:09:48'),
(4, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', 'To be announced later', 'N60000', 'zdbf', 'bad', 'amgsfgm', 'sfgm', 'sfgm', 'sfgm', 'sfgmsgf', '2019-08-09', 'open', '2019-08-19 13:50:32', '2019-08-19 13:50:32'),
(5, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', 'To be announced later', 'N60000', 'adbadfb', 'afba', 'profilr2019@gmail.com', 'sfgm', 'sfgm', 'sfgm', 'sfgmsgf', '2019-08-09', 'open', '2019-08-19 13:54:22', '2019-08-19 13:01:10'),
(6, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', 'To be announced later', 'N60000', 'adfb', 'adfb', 'profilr2019@gmail.comaa', 'sfgm', 'sfgm', 'sfgm', 'sfgmsgf', '2019-08-09', 'open', '2019-08-19 14:01:48', '2019-08-19 13:03:24'),
(7, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', 'To be announced later', 'N60000', 'adfb', 'adbf', 'alexandradfabd@look.voom', 'sfgm', 'sfgm', 'sfgm', 'sfgmsgf', '2019-08-09', 'open', '2019-08-19 14:04:22', '2019-08-19 14:04:22'),
(8, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', 'To be announced later', 'N60000', 'adfb', 'zdbf', 'superadmin@agile.com', '615', 'asdasdb', 'asdbas', 'asdbasd', '2019-08-10', 'open', '2019-08-19 14:17:16', '2019-08-19 14:17:16');

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE `reserve` (
  `id` int(11) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `training_day` varchar(255) DEFAULT NULL,
  `training_time` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `seat` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `deposit_number` varchar(255) DEFAULT NULL,
  `deposit_date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reserve`
--

INSERT INTO `reserve` (`id`, `location`, `training_day`, `training_time`, `duration`, `venue`, `seat`, `firstname`, `lastname`, `email`, `telephone`, `company_name`, `address`, `deposit_number`, `deposit_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Abuja', '2019-10-10 - 2019-10-11', '09:00 - 17:00', '2 days', '<p>To be announced later!</p>', '60000', 'Adewunmi', 'Adenuga', 'profilr2019@gmail.com', '08137492316', 'Mr', 'Skylark Hospital Road Agura Sabo', '12345678', '2019-08-12', 'open', '2019-08-11 16:27:45', '2019-08-11 16:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `reserve_group`
--

CREATE TABLE `reserve_group` (
  `id` int(11) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `training_day` varchar(255) DEFAULT NULL,
  `training_time` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `seat` varchar(255) DEFAULT NULL,
  `groupID` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `group_amount` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `deposit_number` varchar(255) DEFAULT NULL,
  `deposit_date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testimony`
--

CREATE TABLE `testimony` (
  `id` int(11) NOT NULL,
  `testimonialID` varchar(255) DEFAULT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `comment` text,
  `image` varchar(255) DEFAULT 'noImage.png',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimony`
--

INSERT INTO `testimony` (`id`, `testimonialID`, `event_name`, `fullname`, `comment`, `image`, `created_at`, `updated_at`) VALUES
(1, '5d4db76459c161565374308', 'Finance Skills for Lawyers', NULL, '<p>\'\'The training was well organised and impactful knowledge-wise\'\'</p>', '1107443038_1565377595.JPG', '2019-08-09 19:06:35', '2019-08-09 19:06:35'),
(2, '5d4dd91da90541565382941', NULL, NULL, '<p>Excellent! I learnt a lot</p>', 'noImage.png', '2019-08-09 20:45:32', '2019-08-09 20:45:32'),
(3, '5d4ddb6c8d52b1565383532', NULL, NULL, '<p>Quite Apt and qualitative. I would like a session on IP Valuation</p>', 'noImage.png', '2019-08-09 20:47:30', '2019-08-09 20:47:30'),
(4, '5d4ddbe30e5b81565383651', NULL, NULL, '<p>\"However short it may seem, its insightful, thus it worth the while for legal financial prosperity\"</p>', 'noImage.png', '2019-08-09 20:49:25', '2019-08-09 20:49:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fsfl_admin`
--
ALTER TABLE `fsfl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_group`
--
ALTER TABLE `register_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_now`
--
ALTER TABLE `register_now`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserve_group`
--
ALTER TABLE `reserve_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimony`
--
ALTER TABLE `testimony`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=434;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fsfl_admin`
--
ALTER TABLE `fsfl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `register_group`
--
ALTER TABLE `register_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `register_now`
--
ALTER TABLE `register_now`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reserve`
--
ALTER TABLE `reserve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reserve_group`
--
ALTER TABLE `reserve_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimony`
--
ALTER TABLE `testimony`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
