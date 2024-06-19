-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 01:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_register`
--

-- --------------------------------------------------------

--
-- Table structure for table `shoes_size`
--

CREATE TABLE `shoes_size` (
  `id` int(11) NOT NULL,
  `shoes_id` int(11) DEFAULT NULL,
  `size_36` int(11) DEFAULT 0,
  `size_37` int(11) DEFAULT 0,
  `size_38` int(11) DEFAULT 0,
  `size_39` int(11) DEFAULT 0,
  `size_40` int(11) DEFAULT 0,
  `size_41` int(11) DEFAULT 0,
  `size_42` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shoes_size`
--

INSERT INTO `shoes_size` (`id`, `shoes_id`, `size_36`, `size_37`, `size_38`, `size_39`, `size_40`, `size_41`, `size_42`) VALUES
(1, 1, 0, 2, 3, 2, 55, 3, 5),
(2, 2, 4, 0, 0, 0, 22, 0, 3),
(3, 3, 1, 0, 2, 3, 0, 7, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shoes_size`
--
ALTER TABLE `shoes_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shoes_id` (`shoes_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shoes_size`
--
ALTER TABLE `shoes_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shoes_size`
--
ALTER TABLE `shoes_size`
  ADD CONSTRAINT `shoes_size_ibfk_1` FOREIGN KEY (`shoes_id`) REFERENCES `shoes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
