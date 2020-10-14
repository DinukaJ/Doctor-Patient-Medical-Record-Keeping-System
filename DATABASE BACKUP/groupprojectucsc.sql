-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 14, 2020 at 06:42 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `groupprojectucsc`
--
DROP DATABASE `groupprojectucsc`; 
CREATE DATABASE IF NOT EXISTS `groupprojectucsc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `groupprojectucsc`;

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `presId` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `doi` date NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `docspecialdays`
--

CREATE TABLE `docspecialdays` (
  `docId` varchar(9) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `docspeciality`
--

CREATE TABLE `docspeciality` (
  `docId` varchar(9) NOT NULL,
  `speciality` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` varchar(9) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `docusualdays`
--

CREATE TABLE `docusualdays` (
  `docId` varchar(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `labreport`
--

CREATE TABLE `labreport` (
  `patientId` varchar(9) NOT NULL,
  `id` varchar(9) NOT NULL,
  `doi` date NOT NULL,
  `type` text NOT NULL,
  `field1` text NOT NULL,
  `field2` text NOT NULL,
  `field3` text NOT NULL,
  `field4` text NOT NULL,
  `field5` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` int(5) NOT NULL,
  `qty` int(4) NOT NULL,
  `shortCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `name`, `price`, `qty`, `shortCode`) VALUES
(4, 'yef', 578, 4353, 'ye4'),
(5, 'dyds', 448, 123, 'dddy4'),
(6, 'gdioe', 843, 6324, 'gd45'),
(7, 'gfde', 345, 34, 'gf56'),
(9, 'hurenis', 532, 234, 'hu76'),
(10, 'weteihof', 459, 6574, 'we342'),
(11, 'getfjig', 46, 4867, 'ge587');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` varchar(9) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `age` int(2) NOT NULL,
  `address` text NOT NULL,
  `allergies` text DEFAULT NULL,
  `impNotes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `docId` varchar(9) NOT NULL,
  `patientId` varchar(9) NOT NULL,
  `id` int(11) NOT NULL,
  `doi` date NOT NULL,
  `note` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prescription_medicine`
--

CREATE TABLE `prescription_medicine` (
  `pres_ID` int(11) NOT NULL,
  `med_ID` int(11) NOT NULL,
  `amtPerTime` float NOT NULL,
  `timesPerDay` int(1) NOT NULL,
  `beforeAfter` char(20) NOT NULL,
  `duration` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presId` (`presId`);

--
-- Indexes for table `docspecialdays`
--
ALTER TABLE `docspecialdays`
  ADD KEY `docId` (`docId`);

--
-- Indexes for table `docspeciality`
--
ALTER TABLE `docspeciality`
  ADD KEY `docId` (`docId`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labreport`
--
ALTER TABLE `labreport`
  ADD PRIMARY KEY (`id`),
  ADD KEY `labreport_ibfk_1` (`patientId`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `docId` (`docId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `prescription_medicine`
--
ALTER TABLE `prescription_medicine`
  ADD KEY `pres_ID` (`pres_ID`),
  ADD KEY `med_ID` (`med_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`presId`) REFERENCES `prescriptions` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `docspecialdays`
--
ALTER TABLE `docspecialdays`
  ADD CONSTRAINT `docspecialdays_ibfk_1` FOREIGN KEY (`docId`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `docspeciality`
--
ALTER TABLE `docspeciality`
  ADD CONSTRAINT `docspeciality_ibfk_1` FOREIGN KEY (`docId`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `labreport`
--
ALTER TABLE `labreport`
  ADD CONSTRAINT `labreport_ibfk_1` FOREIGN KEY (`patientId`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`docId`) REFERENCES `doctor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prescription_medicine`
--
ALTER TABLE `prescription_medicine`
  ADD CONSTRAINT `prescription_medicine_ibfk_1` FOREIGN KEY (`pres_ID`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prescription_medicine_ibfk_2` FOREIGN KEY (`med_ID`) REFERENCES `medicine` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
