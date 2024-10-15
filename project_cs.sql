-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 07:41 AM
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
-- Database: `project_cs`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `Account` varchar(25) NOT NULL,
  `Total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`Account`, `Total`) VALUES
('Bank', 0),
('Cash', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` bigint(255) NOT NULL,
  `Category` varchar(25) NOT NULL,
  `Sign` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Category`, `Sign`) VALUES
(1, 'Food', 'E'),
(2, 'Good', 'E'),
(3, 'Monthly needs', 'E'),
(4, 'Transportation', 'E'),
(5, 'Salary', 'I'),
(6, 'Bonus', 'I'),
(7, 'Beauty', 'E'),
(8, 'Education', 'E'),
(9, 'Health', 'E'),
(10, 'Gift', 'E'),
(20, 'Organization', 'E'),
(25, 'Residence', ''),
(26, 'Holiday', ''),
(27, 'Other', 'E');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `ID` bigint(255) NOT NULL,
  `Date` datetime(6) NOT NULL,
  `Account` varchar(25) NOT NULL,
  `Category` varchar(25) NOT NULL,
  `Total` int(20) NOT NULL,
  `Note` varchar(50) NOT NULL,
  `Invoice` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`ID`, `Date`, `Account`, `Category`, `Total`, `Note`, `Invoice`) VALUES
(1, '2024-04-23 22:25:22.000000', 'Cash', 'Food', 61, 'Makan malam', 0),
(2, '2024-04-23 23:45:54.000000', 'Cash', 'Goods', 200, 'Skin care', 0),
(3, '2024-04-24 00:31:04.000000', 'Cash', 'Food', 101, 'Makan siang', 0),
(35, '2024-05-02 17:46:49.000000', 'Bank', 'Good', 200, 'Shopee', 0),
(36, '2024-05-02 18:37:39.000000', 'Bank', 'Food', 60, 'Makan malam', 0);

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `ID` bigint(255) NOT NULL,
  `Date` datetime(6) NOT NULL,
  `Account` varchar(25) NOT NULL,
  `Category` varchar(25) NOT NULL,
  `Total` int(10) NOT NULL,
  `Note` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`ID`, `Date`, `Account`, `Category`, `Total`, `Note`) VALUES
(1, '2024-04-23 22:23:57.000000', 'Bank', 'Salary', 2000, 'Gaji'),
(11, '2024-05-02 17:04:33.000000', 'Bank', 'Bonus', 1000, 'Gaji');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `ID` bigint(255) NOT NULL,
  `Date` datetime(6) NOT NULL,
  `F` varchar(25) NOT NULL,
  `T` varchar(25) NOT NULL,
  `Total` int(10) NOT NULL,
  `Note` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`ID`, `Date`, `F`, `T`, `Total`, `Note`) VALUES
(7, '2024-05-02 17:52:41.000000', 'Cash', 'Bank', 1000, 'TF');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(10) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` int(18) NOT NULL,
  `Email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`Account`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Account` (`Account`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Account` (`Account`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `ID` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `ID` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `ID` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_ibfk_1` FOREIGN KEY (`Account`) REFERENCES `assets` (`Account`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `income_ibfk_1` FOREIGN KEY (`Account`) REFERENCES `assets` (`Account`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
