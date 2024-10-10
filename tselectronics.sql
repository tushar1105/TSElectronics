-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 07, 2024 at 06:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tselectronics`
--

-- --------------------------------------------------------

--
-- Table structure for table `ts_orders`
--

CREATE TABLE `ts_orders` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `postcode` varchar(15) NOT NULL,
  `province_code` varchar(3) NOT NULL,
  `province_name` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `card_expiry_month` varchar(3) NOT NULL,
  `card_expiry_year` varchar(4) NOT NULL,
  `sub_total` float NOT NULL,
  `tax` float NOT NULL,
  `order_total` float NOT NULL,
  `id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ts_orders`
--

INSERT INTO `ts_orders` (`first_name`, `last_name`, `phone`, `postcode`, `province_code`, `province_name`, `email`, `card_number`, `card_expiry_month`, `card_expiry_year`, `sub_total`, `tax`, `order_total`, `id`, `created_on`) VALUES
('Tushar', 'Sharma', '382-885-3642', 'N2L 3E6', 'ON', 'Ontario', 'tushar@gmail.com', '3333-4444-2222-3333', 'MAY', '2022', 390, 0.13, 440.7, 5, '2024-08-07 03:59:02'),
('Hitesh', 'Sharma', '647-939-1295', 'N2L 3E6', 'PE', 'Prince Edward Island', 'hitesh@gmail.com', '3333-4444-2222-3333', 'JUN', '2030', 28, 0.15, 32.2, 6, '2024-08-07 04:03:24'),
('Kusum', 'Sharma', '445-334-3333', 'N2L 3E6', 'NL', 'Newfoundland and Labrador', 'kusum@gmail.com', '7777-5555-6666-7777', 'JUL', '2034', 50, 0.15, 57.5, 7, '2024-08-07 04:10:46'),
('Tony', 'Stark', '334-333-4444', 'N2L 3E5', 'BC', 'British Columbia', 'tony@gmail.com', '4444-4444-5555-3333', 'AUG', '2044', 70, 0.12, 78.4, 8, '2024-08-07 04:12:16');

-- --------------------------------------------------------

--
-- Table structure for table `ts_order_details`
--

CREATE TABLE `ts_order_details` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ts_order_details`
--

INSERT INTO `ts_order_details` (`id`, `item_name`, `unit_price`, `total_price`, `quantity`, `order_id`) VALUES
(2, 'iPhone Case', 5, 50, 10, 5),
(3, 'Screen Protector', 7, 140, 20, 5),
(4, 'Headphones', 20, 200, 10, 5),
(5, 'Screen Protector', 7, 28, 4, 6),
(6, 'iPhone Case', 5, 50, 10, 7),
(7, 'Screen Protector', 7, 70, 10, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(7, 'hitesh', '80e2235fd9a018996178a07a6a3f4fff', 'manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ts_orders`
--
ALTER TABLE `ts_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_order_details`
--
ALTER TABLE `ts_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ts_orders`
--
ALTER TABLE `ts_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ts_order_details`
--
ALTER TABLE `ts_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
