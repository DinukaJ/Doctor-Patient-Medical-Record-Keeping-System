-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 18, 2020 at 05:27 AM
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
  `status` int(11) NOT NULL,
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
  `password` text NOT NULL,
  `dp` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `fname`, `lname`, `phone`, `email`, `password`, `dp`) VALUES
('doc45', 'Rukmal', 'Weerasinghe', '0776386324', '', '746e1b9346e43ecbb92a7fafa0ad838414c69f17', NULL);

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doi` date NOT NULL,
  `type` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `labreport_ibfk_1` (`patientId`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `labreport`
--

INSERT INTO `labreport` (`patientId`, `id`, `doi`, `type`) VALUES
('p-3', 19, '2020-11-17', 'Lipid Profile');

-- --------------------------------------------------------

--
-- Table structure for table `labreportdetails`
--

DROP TABLE IF EXISTS `labreportdetails`;
CREATE TABLE IF NOT EXISTS `labreportdetails` (
  `id` int(11) NOT NULL,
  `testName` varchar(50) NOT NULL,
  `result` text NOT NULL,
  `normalRange` text NOT NULL,
  PRIMARY KEY (`id`,`testName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labreportdetails`
--

INSERT INTO `labreportdetails` (`id`, `testName`, `result`, `normalRange`) VALUES
(19, 'Serum Cholesterol', '203 mg/dl', '150-200'),
(19, 'HDL - Cholesterol', '36 mg/dl', '40-60'),
(19, 'Triglycerides', '169 mg/dl', '25-160'),
(19, 'LDL - Cholesterol', '133 mg/dl', '<130');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

DROP TABLE IF EXISTS `medicine`;
CREATE TABLE IF NOT EXISTS `medicine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `shortCode` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `name`, `shortCode`) VALUES
(24, 'Acacia', 'aca-01'),
(25, 'Amoxicillin', 'amox-01'),
(26, 'Phenytoin', 'ph-01'),
(27, 'Lisnopril', 'lis-01'),
(28, 'Diclofenac', 'di-01'),
(29, 'Ranitidine', 'ran-01');

-- --------------------------------------------------------

--
-- Table structure for table `medtypes`
--

DROP TABLE IF EXISTS `medtypes`;
CREATE TABLE IF NOT EXISTS `medtypes` (
  `id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `price` int(5) NOT NULL,
  `qty` int(4) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medtypes`
--

INSERT INTO `medtypes` (`id`, `type`, `price`, `qty`, `status`) VALUES
(17, '', 200, 20, 1),
(24, '200mg', 34, 2000, 1),
(25, '250mg', 15, 1500, 1),
(26, '100mg', 50, 500, 1),
(27, '150mg', 12, 1500, 1),
(28, '25mg', 20, 1500, 1),
(29, '300mg', 30, 2000, 1);

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
  `password` text NOT NULL,
  `age` int(3) NOT NULL,
  `address` text NOT NULL,
  `dp` text,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `fname`, `lname`, `phone`, `email`, `password`, `age`, `address`, `dp`, `status`) VALUES
('p-1', 'Pasindu', 'Dissanayakey', '0771697166', '', 'c4a1e9ab9701149995d64bc94a8cac2b1a0ed8f7', 25, '12/21,Seeduwa', NULL, 1),
('p-2', 'Abc', 'Abc', '6543119774', 'new@gmail.com', '82e84858248a680eb05614695eca57a0be0718cc', 28, 'Abc', NULL, 0),
('p-3', 'Chathura', 'Wanasingha', '0772537849', 'chath_123@gmail.com', '337fc3a69282faa6655820e7a852a1d612f6ca10', 25, 'no.34,Main Street,Colombo', '', 1),
('p-4', 'Hemal', 'Perera', '0714659937', 'hem34@hotmail.com', '312b364a03a06c34c96b9c63aafd2649b4ea411b', 30, 'no.24/3,De mel Street,Negombo.', '', 1),
('p-5', 'Adeesha', 'Weerasingha', '0763749956', 'adee34@yahoo.com', '743d5daad9c062b0eba165c87aff419da517e976', 29, 'no. 27/4H, Galle Road, Colombo.', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patientallergy`
--

DROP TABLE IF EXISTS `patientallergy`;
CREATE TABLE IF NOT EXISTS `patientallergy` (
  `id` varchar(9) NOT NULL,
  `allergy` varchar(30) NOT NULL,
  PRIMARY KEY (`id`,`allergy`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientallergy`
--

INSERT INTO `patientallergy` (`id`, `allergy`) VALUES
('p-1', 'House Dust Mist');

-- --------------------------------------------------------

--
-- Table structure for table `patientimpnotes`
--

DROP TABLE IF EXISTS `patientimpnotes`;
CREATE TABLE IF NOT EXISTS `patientimpnotes` (
  `id` varchar(9) NOT NULL,
  `impNote` varchar(100) NOT NULL,
  PRIMARY KEY (`id`,`impNote`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
('doc45', 'p-1', 123, '2020-10-15', NULL, 0),
('doc45', 'p-1', 124, '2020-10-29', '', 0),
('doc45', 'p-1', 125, '2020-11-17', '', 0),
('doc45', 'p-3', 126, '2020-11-17', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `prescription_medicine`
--

DROP TABLE IF EXISTS `prescription_medicine`;
CREATE TABLE IF NOT EXISTS `prescription_medicine` (
  `pres_ID` int(11) NOT NULL,
  `med_ID` int(11) NOT NULL,
  `medType_ID` varchar(10) NOT NULL,
  `amtPerTime` float NOT NULL,
  `timesPerDay` int(1) NOT NULL,
  `beforeAfter` char(20) NOT NULL,
  `duration` varchar(15) NOT NULL,
  PRIMARY KEY (`pres_ID`,`med_ID`,`medType_ID`),
  KEY `med_ID` (`med_ID`),
  KEY `pres_ID` (`pres_ID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription_medicine`
--

INSERT INTO `prescription_medicine` (`pres_ID`, `med_ID`, `medType_ID`, `amtPerTime`, `timesPerDay`, `beforeAfter`, `duration`) VALUES
(123, 10, '0', 1.5, 2, 'Before', '4 weeks'),
(124, 6, '0', 1, 3, 'b', '1 w'),
(124, 11, '0', 1.5, 2, 'a', '1 w'),
(125, 25, '250mg', 1.5, 3, 'a', '2 w'),
(126, 24, '200mg', 1, 1, 'b', '1 w');

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
