-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 10, 2024 at 01:57 PM
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
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `crud2`
--

CREATE TABLE `crud2` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `condition` varchar(255) NOT NULL,
  `join_date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crud2`
--

INSERT INTO `crud2` (`id`, `model`, `brand`, `condition`, `join_date`) VALUES
(1212, 'Camaro', 'Chevrolet', 'Fair', '2024-05-03'),
(1213, 'Spyder', 'Porsche', 'Fair', '2024-05-03'),
(1214, 'ADV 750', 'Honda', 'Good', '2024-05-03'),
(1215, 'Ninja 500', 'Yamaha', 'Bad', '2024-05-03'),
(1216, 'Mustang', 'Ford', 'Fair', '2024-05-03'),
(1217, 'Corvette', 'Chevrolet', 'Good', '2024-05-03'),
(1218, 'Raptor', 'Ford', 'Bad', '2024-05-03'),
(1219, 'Camry', 'Toyota', 'Fair', '2024-05-03'),
(1220, 'X5', 'BMW', 'Good', '2024-05-03'),
(1222, 'Dodge Challenger', 'Chrsyler', 'Good', '2024-05-03'),
(1223, 'Autobot', 'Optimus Prime', 'Good', '2024-05-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crud2`
--
ALTER TABLE `crud2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crud2`
--
ALTER TABLE `crud2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1224;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
