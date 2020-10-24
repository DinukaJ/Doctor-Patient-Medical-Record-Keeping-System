-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 24, 2020 at 08:15 AM
-- Server version: 5.7.21
-- PHP Version: 7.3.12

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

DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `presId` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doi` date NOT NULL,
  `amount` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `presId` (`presId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `docspecialdays`
--

DROP TABLE IF EXISTS `docspecialdays`;
CREATE TABLE IF NOT EXISTS `docspecialdays` (
  `docId` varchar(9) NOT NULL,
  `date` date DEFAULT NULL,
  KEY `docId` (`docId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `docspeciality`
--

DROP TABLE IF EXISTS `docspeciality`;
CREATE TABLE IF NOT EXISTS `docspeciality` (
  `docId` varchar(9) NOT NULL,
  `speciality` text NOT NULL,
  KEY `docId` (`docId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `id` varchar(9) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
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

DROP TABLE IF EXISTS `docusualdays`;
CREATE TABLE IF NOT EXISTS `docusualdays` (
  `docId` varchar(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `labreport`
--

DROP TABLE IF EXISTS `labreport`;
CREATE TABLE IF NOT EXISTS `labreport` (
  `patientId` varchar(9) NOT NULL,
  `id` varchar(9) NOT NULL,
  `doi` date NOT NULL,
  `type` text NOT NULL,
  `field1` text NOT NULL,
  `field2` text NOT NULL,
  `field3` text NOT NULL,
  `field4` text NOT NULL,
  `field5` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `labreport_ibfk_1` (`patientId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

DROP TABLE IF EXISTS `medicine`;
CREATE TABLE IF NOT EXISTS `medicine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `price` int(5) NOT NULL,
  `qty` int(4) NOT NULL,
  `shortCode` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

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

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id` varchar(9) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(20) NOT NULL,
  `age` int(2) NOT NULL,
  `address` text NOT NULL,
  `allergies` text,
  `impNotes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `fname`, `lname`, `phone`, `email`, `password`, `age`, `address`, `allergies`, `impNotes`) VALUES
('pat45', 'Pasindu', 'Dissanayakey', '0771697166', '', 'ghsdfsfas', 25, '12/21,Seeduwa', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

DROP TABLE IF EXISTS `prescriptions`;
CREATE TABLE IF NOT EXISTS `prescriptions` (
  `docId` varchar(9) NOT NULL,
  `patientId` varchar(9) NOT NULL,
  `id` int(11) NOT NULL,
  `doi` date NOT NULL,
  `note` text,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `docId` (`docId`),
  KEY `patientId` (`patientId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`docId`, `patientId`, `id`, `doi`, `note`, `status`) VALUES
('doc45', 'pat45', 123, '2020-10-15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prescription_medicine`
--

DROP TABLE IF EXISTS `prescription_medicine`;
CREATE TABLE IF NOT EXISTS `prescription_medicine` (
  `pres_ID` int(11) NOT NULL,
  `med_ID` int(11) NOT NULL,
  `amtPerTime` float NOT NULL,
  `timesPerDay` int(1) NOT NULL,
  `beforeAfter` char(20) NOT NULL,
  `duration` varchar(15) NOT NULL,
  KEY `med_ID` (`med_ID`),
  KEY `pres_ID` (`pres_ID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription_medicine`
--

INSERT INTO `prescription_medicine` (`pres_ID`, `med_ID`, `amtPerTime`, `timesPerDay`, `beforeAfter`, `duration`) VALUES
(123, 4, 2, 3, 'After', '3 weeks'),
(123, 10, 1.5, 2, 'Before', '4 weeks');

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
