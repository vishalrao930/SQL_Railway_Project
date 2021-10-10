-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2020 at 03:58 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbms_pro`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `createAdmin` (IN `name1` VARCHAR(20), IN `email1` VARCHAR(255), IN `phone1` VARCHAR(15), IN `password1` VARCHAR(255))  BEGIN	
    insert into users(email,name,phone,password,isAdmin) values(email1,name1,phone1,md5(password1),1);
    end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ac_coach`
--

CREATE TABLE `ac_coach` (
  `seat_number` int(11) NOT NULL,
  `seat_type` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `pnr` varchar(10) NOT NULL,
  `coach_number` varchar(10) NOT NULL,
  `seat_number` int(11) NOT NULL,
  `p_name` varchar(128) NOT NULL,
  `p_age` int(11) NOT NULL,
  `p_gender` char(1) NOT NULL,
  `seat_type` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sleeper_coach`
--

CREATE TABLE `sleeper_coach` (
  `seat_number` int(11) NOT NULL,
  `seat_type` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `pnr` varchar(10) NOT NULL,
  `booked_by` int(11) NOT NULL,
  `train_number` varchar(5) NOT NULL,
  `date` date NOT NULL,
  `coach_type` char(1) NOT NULL,
  `num_passengers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `train`
--

CREATE TABLE `train` (
  `train` varchar(5) NOT NULL,
  `date` date NOT NULL,
  `ac` int(11) DEFAULT 0,
  `sleeper` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `train`
--

INSERT INTO `train` (`train`, `date`, `ac`, `sleeper`) VALUES
('12345', '2020-11-26', 2, 3),
('12345', '2020-12-12', 1, 1),
('12345', '2021-12-12', 1, 1),
('9999', '2020-11-25', 10, 10);

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` char(32) NOT NULL,
  `isAdmin` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `phone`, `password`, `isAdmin`) VALUES
(2, 'admin@a.com', 'admin', '999999999', '63a9f0ea7bb98050796b649e85481845', 1),
(1, 'demo@gmail.com', 'demo', '1231231233', 'fe01ce2a7fbac8fafaed7c982a04e229', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ac_coach`
--
ALTER TABLE `ac_coach`
  ADD PRIMARY KEY (`seat_number`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`pnr`,`coach_number`,`seat_number`);

--
-- Indexes for table `sleeper_coach`
--
ALTER TABLE `sleeper_coach`
  ADD PRIMARY KEY (`seat_number`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`pnr`);

--
-- Indexes for table `train`
--
ALTER TABLE `train`
  ADD PRIMARY KEY (`train`,`date`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
