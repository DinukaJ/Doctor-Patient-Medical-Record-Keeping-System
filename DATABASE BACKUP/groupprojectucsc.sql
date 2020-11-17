-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2020 at 07:37 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE DATABASE groupprojectucsc;
use groupprojectucsc;

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
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `fname`, `lname`, `phone`, `email`, `password`) VALUES
('doc45', 'Rukmal', 'Weerasinghe', '0776386324', '', 'Doctor123');

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
  `test` varchar(20) NOT NULL,
  `result` varchar(20) NOT NULL,
  `range` varchar(15) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `shortCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `name`, `shortCode`) VALUES
(4, 'yef', 'ye4'),
(17, 'Test 1', 'T1'),
(18, 'Test 2', 't2'),
(19, 'Test 3', 't3'),
(20, 'Test 4', 'T4'),
(21, 'Test 5', 'T5'),
(23, 'Test 6', 'T6'),
(26, 'Test 7', 'T7'),
(27, '', ''),
(28, '', ''),
(29, '', ''),
(30, '', ''),
(31, '', ''),
(32, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `medtypes`
--

CREATE TABLE `medtypes` (
  `id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `price` int(5) NOT NULL,
  `qty` int(4) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medtypes`
--

INSERT INTO `medtypes` (`id`, `type`, `price`, `qty`, `status`) VALUES
(4, 'type 4', 10, 10, 1),
(17, 'type 5', 200, 20, 1),
(18, 'type 4', 10, 20, 1),
(19, 'type 1', 10, 100, 1),
(20, '200', 12, 456, 1),
(21, '100', 45, 6000, 1),
(23, '250', 80, 400, 1),
(26, '300mg', 23, 500, 1),
(26, '100mg', 15, 400, 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` varchar(9) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `age` int(3) NOT NULL,
  `address` text NOT NULL,
  `allergies` text DEFAULT NULL,
  `impNotes` text DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `fname`, `lname`, `phone`, `email`, `password`, `age`, `address`, `allergies`, `impNotes`, `status`) VALUES
('p-2', 'Abc', 'Abc', '6543119774', 'new@gmail.com', '82e84858248a680eb05614695eca57a0be0718cc', 28, 'Abc', '', '', 1),
('p-3', 'John', 'Wick', '0775642218', '', 'cb9283b8641ec2e4a2eb9d557dd4abfa79464939', 23, 'main street, Colombo', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patientallergy`
--

CREATE TABLE `patientallergy` (
  `id` varchar(9) NOT NULL,
  `allergy` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patientimpnotes`
--

CREATE TABLE `patientimpnotes` (
  `id` varchar(9) NOT NULL,
  `impNote` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `docId` varchar(9) NOT NULL,
  `patientId` varchar(9) NOT NULL,
  `id` int(11) NOT NULL,
  `doi` date NOT NULL,
  `note` text DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prescription_medicine`
--

CREATE TABLE `prescription_medicine` (
  `pres_ID` int(11) NOT NULL,
  `med_ID` int(11) NOT NULL,
  `medType_ID` varchar(10) NOT NULL,
  `amtPerTime` float NOT NULL,
  `timesPerDay` int(1) NOT NULL,
  `beforeAfter` char(20) NOT NULL,
  `duration` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription_medicine`
--

INSERT INTO `prescription_medicine` (`pres_ID`, `med_ID`, `medType_ID`, `amtPerTime`, `timesPerDay`, `beforeAfter`, `duration`) VALUES
(123, 4, '0', 2, 3, 'After', '3 weeks'),
(123, 10, '0', 1.5, 2, 'Before', '4 weeks'),
(124, 6, '0', 1, 3, 'b', '1 w'),
(124, 11, '0', 1.5, 2, 'a', '1 w'),
(125, 6, '0', 1, 2, 'b', '2 w'),
(126, 5, '0', 1.5, 2, 'b', '1 w');

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
-- Indexes for table `medtypes`
--
ALTER TABLE `medtypes`
  ADD KEY `fk_medID` (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patientallergy`
--
ALTER TABLE `patientallergy`
  ADD PRIMARY KEY (`id`,`allergy`);

--
-- Indexes for table `patientimpnotes`
--
ALTER TABLE `patientimpnotes`
  ADD PRIMARY KEY (`id`,`impNote`);

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
  ADD PRIMARY KEY (`pres_ID`,`med_ID`,`medType_ID`),
  ADD KEY `med_ID` (`med_ID`),
  ADD KEY `pres_ID` (`pres_ID`) USING BTREE;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
-- Constraints for table `medtypes`
--
ALTER TABLE `medtypes`
  ADD CONSTRAINT `fk_medID` FOREIGN KEY (`id`) REFERENCES `medicine` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`docId`) REFERENCES `doctor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
