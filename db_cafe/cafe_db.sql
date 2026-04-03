-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2026 at 12:33 PM
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
-- Database: `cafe_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `TotalPoints` int(11) DEFAULT 0,
  `ProfileImage` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `FirstName`, `Phone`, `TotalPoints`, `ProfileImage`) VALUES
('C001', 'สมชาย', '0812345678', 150, 'default1.png'),
('C002', 'สมศรี', '0898765432', 45, 'default2.png'),
('C003', 'มานี', '0855554444', 0, 'default3.png');

-- --------------------------------------------------------

--
-- Table structure for table `point_transaction`
--

CREATE TABLE `point_transaction` (
  `TransID` varchar(50) NOT NULL,
  `CustomerID` varchar(50) DEFAULT NULL,
  `TransDate` datetime DEFAULT current_timestamp(),
  `PointsEarned` int(11) DEFAULT 0,
  `PointsUsed` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `point_transaction`
--

INSERT INTO `point_transaction` (`TransID`, `CustomerID`, `TransDate`, `PointsEarned`, `PointsUsed`) VALUES
('T0001', 'C001', '2024-05-01 10:00:00', 200, 0),
('T0002', 'C001', '2024-05-02 14:30:00', 0, 50),
('T0003', 'C002', '2024-05-03 12:15:00', 45, 0);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `PromoID` varchar(50) NOT NULL,
  `PromoName` varchar(50) NOT NULL,
  `PointsRequired` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`PromoID`, `PromoName`, `PointsRequired`) VALUES
('P001', 'กาแฟฟรี 1 แก้ว', 50),
('P002', 'ส่วนลด 100 บาท', 100),
('P003', 'กระเป๋าผ้า Limited', 200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `Phone` (`Phone`);

--
-- Indexes for table `point_transaction`
--
ALTER TABLE `point_transaction`
  ADD PRIMARY KEY (`TransID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`PromoID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `point_transaction`
--
ALTER TABLE `point_transaction`
  ADD CONSTRAINT `point_transaction_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
