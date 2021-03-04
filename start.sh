-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 04, 2021 at 03:12 PM
-- Server version: 8.0.23-0ubuntu0.20.04.1
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
-- Database: `order_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `origin_lat` varchar(100) NOT NULL,
  `origin_lng` varchar(100) NOT NULL,
  `origin` varchar(100) NOT NULL,
  `dest_lat` varchar(100) NOT NULL,
  `dest_lng` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `distance` varchar(100) NOT NULL,
  `status` enum('UNASSIGNED','SUCCESS') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'UNASSIGNED'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `origin_lat`, `origin_lng`, `origin`, `dest_lat`, `dest_lng`, `destination`, `distance`, `status`) VALUES
(1, '33.8120918', '-117.9189742', 'disneyland,ca', '6.5243793', '3.3792057', 'lagos,ng', '12391.494226367', 'UNASSIGNED'),
(2, '12.0021794', '8.5919561', 'Kano,ng', '9.0764785', '7.398574', 'abuja,ng', '350.48372213974', 'UNASSIGNED'),
(3, '39.8403184', '-86.1278563', 'Londo', '4.8396414', '6.9112378', 'Rivers.ng', '9921.1403714781', 'UNASSIGNED');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;