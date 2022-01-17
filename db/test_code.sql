-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 17, 2022 at 11:34 AM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_code`
--

-- --------------------------------------------------------

--
-- Table structure for table `bag_calculate_requests`
--

CREATE TABLE `bag_calculate_requests` (
  `id` int NOT NULL,
  `bag_type` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `width` float NOT NULL,
  `length` float NOT NULL,
  `depth` float NOT NULL,
  `measurement_unit` varchar(50) NOT NULL,
  `depth_unit` varchar(50) NOT NULL,
  `total_bags` int NOT NULL,
  `calculate_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `basket_products`
--

CREATE TABLE `basket_products` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `price` int NOT NULL,
  `bags_quantity` int NOT NULL,
  `total_cost` float NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(250) NOT NULL,
  `category` varchar(250) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`) VALUES
(1, 'Topsail Normal', 'topsoil', 72),
(2, 'Topsail premium', 'topsoil', 85);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bag_calculate_requests`
--
ALTER TABLE `bag_calculate_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basket_products`
--
ALTER TABLE `basket_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bag_calculate_requests`
--
ALTER TABLE `bag_calculate_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `basket_products`
--
ALTER TABLE `basket_products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
