-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 06, 2020 at 08:11 AM
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
CREATE DATABASE groupprojectucsc;
USE groupprojectucsc;


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
  `id` varchar(9) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`,`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `docspecialty`
--

DROP TABLE IF EXISTS `docspecialty`;
CREATE TABLE IF NOT EXISTS `docspecialty` (
  `id` varchar(9) NOT NULL,
  `specialty` varchar(20) NOT NULL,
  PRIMARY KEY (`id`,`specialty`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `email` text NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_id_key` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `docusualdays`
--

DROP TABLE IF EXISTS `docusualdays`;
CREATE TABLE IF NOT EXISTS `docusualdays` (
  `id` varchar(9) NOT NULL,
  `day` varchar(5) NOT NULL,
  PRIMARY KEY (`id`,`day`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `id` int(15) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` int(5) NOT NULL,
  `qty` int(4) NOT NULL,
  `shortCode` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
   `email` text NULL,
  `password` varchar(20) NOT NULL,
  `age` int(2) NOT NULL,
  `address` text NOT NULL,
  `allergies` text NOT NULL,
  `impNotes` text NOT NULL,
  KEY `patient_id_key` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

DROP TABLE IF EXISTS `prescriptions`;
CREATE TABLE IF NOT EXISTS `prescriptions` (
  `docId` varchar(9) NOT NULL,
  `patientId` varchar(9) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doi` date NOT NULL,
  `note` text NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `docId` (`docId`),
  KEY `patientId` (`patientId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `beforeAfter` char(1) NOT NULL,
  `duration` varchar(10) NOT NULL,
  PRIMARY KEY (`pres_ID`,`med_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`presId`) REFERENCES `prescriptions` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
