-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2019 at 10:23 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment_plan`
--

CREATE TABLE `payment_plan` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `plan` varchar(255) DEFAULT NULL,
  `free` varchar(255) DEFAULT NULL,
  `lite` varchar(255) DEFAULT NULL,
  `basic` varchar(255) DEFAULT NULL,
  `classic` varchar(255) DEFAULT NULL,
  `super` varchar(255) DEFAULT NULL,
  `gold` varchar(255) DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT 'not paid',
  `date_from` date NOT NULL DEFAULT current_timestamp(),
  `date_to` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_plan`
--

INSERT INTO `payment_plan` (`id`, `email`, `transaction_id`, `plan`, `free`, `lite`, `basic`, `classic`, `super`, `gold`, `userType`, `currency`, `payment_status`, `date_from`, `date_to`, `created_at`, `updated_at`) VALUES
(1, 'adenugaadebambo41@gmail.com', '11361012001566913346', 'Lite', '', '10000', '', '', '', '', 'Individual', 'USD', 'Paid', '2019-08-27', '2020-08-26', '2019-08-27 10:45:06', '2019-08-27 15:00:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment_plan`
--
ALTER TABLE `payment_plan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment_plan`
--
ALTER TABLE `payment_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
