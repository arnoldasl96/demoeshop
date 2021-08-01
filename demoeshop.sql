-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2021 at 05:07 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demoeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `manufacturer` varchar(100) NOT NULL,
  `picture` varchar(512) NOT NULL,
  `price` double NOT NULL,
  `times_sold` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `in_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `model`, `manufacturer`, `picture`, `price`, `times_sold`, `category`, `description`, `in_stock`) VALUES
(1, 'Aspire 5 A515-46-R14K Slim Laptop', 'Acer', '71AmKW4yuMS._AC_UY218_.jpg', 364.76, 4, 'PC', 'Acer Aspire 5 A515-46-R14K Slim Laptop | 15.6\" Full HD IPS | AMD Ryzen 3 3350U Quad-Core Mobile Processor | 4GB DDR4 | 128GB NVMe SSD | WiFi 6 | Backlit KB | Amazon Alexa | Windows 10 Home', 100),
(2, 'Chromebook 14 Laptop', 'HP', '81b6IIclRfS._AC_UY218_.jpg', 269.99, 5, 'homepc', 'HP Chromebook 14 Laptop, Intel Celeron N4000 Processor, 4 GB RAM, 32 GB eMMC, 14? HD Display', 0),
(3, '15 Laptop', 'HP', '81skV7BufjL._AC_UY218_.jpg', 693.99, 6, 'Laptop', 'HP 15 Laptop, 11th Gen Intel Core i5-1135G7 Processor, 8 GB RAM, 256 GB SSD Storage, 15.6? Full HD IPS', 100),
(4, '2020 Flagship HP 14 Chromebook Laptop 123', 'HP 1132', '817Y3zdhTXL._AC_UY218_.jpg', 190.59, 10, 'Laptop', '2020 Flagship HP 14 Chromebook Laptop Computer 14\" HD SVA Anti-Glare Display Intel Celeron Processor 4GB', 59),
(7, 'VivoBook 15 Thin and Light Laptop', 'Asus', '81fstJkUlaL._AC_UY218_.jpg', 400.94, 44, 'Laptop', 'ASUS VivoBook 15 Thin and Light Laptop, 15.6? FHD Display, Intel i3-1005G1 CPU, 8GB RAM, 128GB SSD,', 132);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` bigint(20) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isAdmin` tinyint(4) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verified` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `firstname`, `lastname`, `email`, `password`, `isAdmin`, `created`, `verified`) VALUES
(9, 'admin', 'admin', 'admin@admin.com', '$2y$10$tFJbYkRKdqCRTXi1/3SR5uvI3KLEfpu0UY/DG3P9qye933CRn8AZa', 1, '2021-07-26 21:04:21', 0),
(12, 'Testing', 'Testing', 'Testing@testing.com', '$2y$10$p796Zj4WZw6T9MhN9rhJpOcoHCtTQ3liy9Kzod0lGMAApGZnPsBeS', 0, '2021-07-28 14:34:16', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
