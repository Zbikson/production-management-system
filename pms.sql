-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 12:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `detailName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `detailName`) VALUES
(17, 'Blacha perforowana #3'),
(18, 'Pręt fi15 500mm'),
(19, 'NM12345'),
(20, 'NM4231'),
(21, 'BCO-232154'),
(22, 'Blacha #2.5 1250x3000mm'),
(23, 'MA23123');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderNumber` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `detail` text DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `quantityNow` int(11) DEFAULT NULL,
  `issueDate` date DEFAULT NULL,
  `executionDate` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderNumber`, `company`, `detail`, `quantity`, `quantityNow`, `issueDate`, `executionDate`, `status`) VALUES
(23, 'ORD-20231219124807-586', 'Firma 1', 'Pręt fi15 500mm', 250, 250, '2023-12-19', '2023-12-28', 1),
(24, 'ORD-20231219124826-937', 'Firma 2', 'BCO-232154', 500, 0, '2023-12-18', '2023-12-28', 0),
(25, 'ORD-20231219124845-475', 'Firma 3', 'Blacha #2.5 1250x3000mm', 100, 0, '2023-12-19', '2023-12-25', 0),
(26, 'ORD-20231219124858-694', 'Firma 1', 'NM12345', 1250, 0, '2023-12-19', '2024-01-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `lastname` text NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `lastname`, `role`) VALUES
(1, 'kzb', '$2y$10$9mKzQ6NYf.ySEJ216n4gI.LZhKlR7qNT82hXBqeIdqRdqM4J.Y2cO', 'Jakub Robert', 'Żbikowski', 'admin'),
(91, 'nowy', '$2y$10$2T1M6/QYKoZm2LMkvT3P..JzH09LM2d424cfOWN45xRP4WDOXnfPC', 'Nowy', 'Nowy', 'admin'),
(92, 'kgo', '$2y$10$rcmU9a96t4r6GXyu/7H30ODEI3oTHK1uVTMhGfGJ.gTIpDTlz6Yj2', 'Karol', 'Przykładowy', 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `user_order_progress`
--

CREATE TABLE `user_order_progress` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `completed_quantity` int(11) DEFAULT NULL,
  `date_completed` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `user_order_progress`
--

INSERT INTO `user_order_progress` (`id`, `order_id`, `user_id`, `completed_quantity`, `date_completed`) VALUES
(8, 23, 92, 50, '2023-12-19 11:50:32'),
(9, 23, 91, 75, '2023-12-19 11:50:49'),
(10, 23, 1, 125, '2023-12-19 11:51:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_order_progress`
--
ALTER TABLE `user_order_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `user_order_progress`
--
ALTER TABLE `user_order_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_order_progress`
--
ALTER TABLE `user_order_progress`
  ADD CONSTRAINT `user_order_progress_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `user_order_progress_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
