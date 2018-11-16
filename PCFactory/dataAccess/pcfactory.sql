-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2018 at 05:42 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pcfactory`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `fname`, `lname`, `country`, `subject`) VALUES
(1, 'Hector', 'Ortiz', 'Mexico', 'Very good service'),
(2, 'asd', 'asd', 'asd', 'asd'),
(3, 'Hector', 'Ortiz', 'Mexico', 'Cool page');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`) VALUES
(1, 'GIGABYTE Radeon RX 570 4GB Video Card', 'radeonRX570.jpg', 169.99),
(2, 'EVGA GeForce GTX 1060 6GB Video Card', 'evgaGTX1060.jpg', 249.99),
(3, 'G.SKILL TridentZ 16GB Desktop Memory', 'gskill16GBram.jpg', 164.99),
(4, 'MEG Z390 GODLIKE Intel Motherboard', 'megZ390motherboard.jpg', 569.99),
(5, 'ASUS Prime Z370-A Intel Motherboard', 'asusZ370motherboard.jpg', 159.99),
(6, 'Toshiba P300 1TB Desktop PC Hard Drive', 'toshP300harddrive.jpg', 49.99),
(7, 'WD Red 4TB Hard Disk Drive', 'redWDharddrive.jpg', 123.99),
(8, 'Intel Core i7 LGA 1151 Intel Processor', 'intelI7processor.jpg', 369.99),
(9, 'AMD RYZEN 3 2200G Quad-Core Desktop Processor', 'amdRYZEN3processor.jpg', 99.99);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
