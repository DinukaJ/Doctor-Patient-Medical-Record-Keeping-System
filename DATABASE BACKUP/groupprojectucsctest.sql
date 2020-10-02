-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 02, 2020 at 12:59 PM
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
-- Database: `groupprojectucsctest`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `docId` varchar(9) NOT NULL,
  `patientId` varchar(9) NOT NULL,
  `presId` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `doi` date NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `id` varchar(9) NOT NULL,
  `speciality` text NOT NULL
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
  `field5` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

DROP TABLE IF EXISTS `medicine`;
CREATE TABLE IF NOT EXISTS `medicine` (
  `id` varchar(15) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` int(5) NOT NULL,
  `qty` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `phone` text NOT NULL,
  `age` int(11) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `fname`, `lname`, `phone`, `age`, `address`) VALUES
(2, 'Abc', 'Abc', '6543119774', 28, 'Abc'),
(3, 'Dinuka', 'test2', '1234567890', 22, '224/3, Alubogahalanda'),
(4, 'Abc', 'Abc', '6543119774', 56, 'Abc'),
(5, 'Abc', 'Abc', '6543119774', 56, 'Abc'),
(6, 'Dinuka', 'test2', '1234556', 66, '224/3, Alubogahalanda'),
(7, 'Dinuka', 'test2', '1234556', 66, '224/3, Alubogahalanda'),
(8, 'Raveen', 'Jayalath', '0772743126', 88, 'y78o');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
