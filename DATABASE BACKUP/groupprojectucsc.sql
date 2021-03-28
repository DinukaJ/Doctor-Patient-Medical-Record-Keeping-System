-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 28, 2021 at 06:25 AM
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
  `amount` decimal(10,2) NOT NULL,
  `docCharge` decimal(10,2) NOT NULL DEFAULT '0.00',
  `type` char(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `presId` (`presId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`presId`, `id`, `doi`, `amount`, `docCharge`, `type`) VALUES
(7, 4, '2021-03-21', '1332.50', '600.00', 'pres'),
(10, 5, '2021-03-21', '772.50', '600.00', 'pres');

-- --------------------------------------------------------

--
-- Table structure for table `billitems`
--

DROP TABLE IF EXISTS `billitems`;
CREATE TABLE IF NOT EXISTS `billitems` (
  `billId` int(11) NOT NULL,
  `medId` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `totPrice` decimal(10,2) NOT NULL,
  PRIMARY KEY (`billId`,`medId`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billitems`
--

INSERT INTO `billitems` (`billId`, `medId`, `type`, `qty`, `totPrice`) VALUES
(5, 24, '200mg', 5, '172.50'),
(4, 28, '25mg', 28, '560.00'),
(4, 24, '200mg', 5, '172.50');

-- --------------------------------------------------------

--
-- Table structure for table `doccharge`
--

DROP TABLE IF EXISTS `doccharge`;
CREATE TABLE IF NOT EXISTS `doccharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doccharge`
--

INSERT INTO `doccharge` (`id`, `amount`) VALUES
(1, '600.00');

-- --------------------------------------------------------

--
-- Table structure for table `docspecialdays`
--

DROP TABLE IF EXISTS `docspecialdays`;
CREATE TABLE IF NOT EXISTS `docspecialdays` (
  `docId` varchar(9) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`docId`,`date`),
  KEY `docId` (`docId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `docspecialdays`
--

INSERT INTO `docspecialdays` (`docId`, `date`, `status`) VALUES
('doc-1', '2021-02-12', 0),
('doc-1', '2021-03-20', 1),
('doc-1', '2021-03-22', 0),
('doc-1', '2021-03-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `docspeciality`
--

DROP TABLE IF EXISTS `docspeciality`;
CREATE TABLE IF NOT EXISTS `docspeciality` (
  `docId` varchar(9) NOT NULL,
  `speciality` varchar(50) NOT NULL,
  PRIMARY KEY (`docId`,`speciality`),
  KEY `docId` (`docId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `docspeciality`
--

INSERT INTO `docspeciality` (`docId`, `speciality`) VALUES
('doc-1', 'Eye'),
('doc-1', 'Normal');

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
  `type` int(11) NOT NULL DEFAULT '0',
  `token` text,
  `verifyStatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `fname`, `lname`, `phone`, `email`, `password`, `dp`, `type`, `token`, `verifyStatus`) VALUES
('doc-1', 'Rukmal', 'Weerasinghe', '0776386324', '', '746e1b9346e43ecbb92a7fafa0ad838414c69f17', NULL, 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `docusualdays`
--

DROP TABLE IF EXISTS `docusualdays`;
CREATE TABLE IF NOT EXISTS `docusualdays` (
  `docId` varchar(9) NOT NULL,
  `day` varchar(10) NOT NULL,
  PRIMARY KEY (`docId`,`day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `docusualdays`
--

INSERT INTO `docusualdays` (`docId`, `day`) VALUES
('', 'Friday'),
('', 'Monday'),
('', 'Thursday'),
('', 'Wednesday'),
('doc-1', 'Friday'),
('doc-1', 'Monday'),
('doc-1', 'Saturday'),
('doc-1', 'Sunday'),
('doc-1', 'Thursday'),
('doc-1', 'Tuesday'),
('doc-1', 'Wednesday'),
('doc-2', 'Monday'),
('doc-2', 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `labpatientrep`
--

DROP TABLE IF EXISTS `labpatientrep`;
CREATE TABLE IF NOT EXISTS `labpatientrep` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(9) NOT NULL,
  `doi` date NOT NULL,
  `cmt` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labpatientrep`
--

INSERT INTO `labpatientrep` (`id`, `pid`, `doi`, `cmt`) VALUES
(2, 'p-6', '2021-02-08', ''),
(1, 'p-1', '2020-12-31', ''),
(3, 'p-8', '2021-03-21', 'Test Comment');

-- --------------------------------------------------------

--
-- Table structure for table `labpatientrepdata`
--

DROP TABLE IF EXISTS `labpatientrepdata`;
CREATE TABLE IF NOT EXISTS `labpatientrepdata` (
  `repid` int(11) NOT NULL,
  `repTypeId` int(11) NOT NULL,
  `testName` varchar(400) NOT NULL,
  `result` text NOT NULL,
  PRIMARY KEY (`repid`,`repTypeId`,`testName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labpatientrepdata`
--

INSERT INTO `labpatientrepdata` (`repid`, `repTypeId`, `testName`, `result`) VALUES
(3, 19, 'TRIGLYCERIDES', '40'),
(3, 19, 'SERIUM CHOLESTEROL', '155'),
(3, 19, 'HDL-CHOLESTEROL', '50'),
(2, 19, 'SERIUM CHOLESTEROL', '150'),
(3, 19, 'CHOLESTEROL/HDL', '5'),
(3, 19, 'LDL-CHOLESTEROL', '150'),
(2, 19, 'HDL-CHOLESTEROL', '70'),
(2, 19, 'LDL-CHOLESTEROL', '200'),
(2, 19, 'CHOLESTEROL/HDL', '5'),
(2, 19, 'TRIGLYCERIDES', '40'),
(1, 19, 'SERIUM CHOLESTEROL', '20'),
(1, 19, 'TRIGLYCERIDES', '50'),
(1, 19, 'LDL-CHOLESTEROL', '135'),
(1, 19, 'HDL-CHOLESTEROL', '60'),
(1, 19, 'CHOLESTEROL/HDL', '2');

-- --------------------------------------------------------

--
-- Table structure for table `labreport`
--

DROP TABLE IF EXISTS `labreport`;
CREATE TABLE IF NOT EXISTS `labreport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `labreport`
--

INSERT INTO `labreport` (`id`, `type`) VALUES
(19, 'Lipid Profile'),
(20, 'ESR'),
(21, 'Urine Profile'),
(22, 'Liver Profile');

-- --------------------------------------------------------

--
-- Table structure for table `labreportdata`
--

DROP TABLE IF EXISTS `labreportdata`;
CREATE TABLE IF NOT EXISTS `labreportdata` (
  `repId` int(11) NOT NULL,
  `testName` varchar(400) NOT NULL,
  `normalRange` varchar(400) NOT NULL,
  PRIMARY KEY (`repId`,`testName`,`normalRange`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labreportdata`
--

INSERT INTO `labreportdata` (`repId`, `testName`, `normalRange`) VALUES
(19, 'CHOLESTEROL/HDL', '< 3.8~mg/dl'),
(19, 'HDL-CHOLESTEROL', '40 - 60~mg/dl'),
(19, 'LDL-CHOLESTEROL', '< 130~mg/dl'),
(19, 'SERIUM CHOLESTEROL', '150 - 200~mg/dl'),
(19, 'TRIGLYCERIDES', '35 - 160~mg/dl');

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

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
  `price` decimal(10,2) NOT NULL,
  `qty` int(4) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medtypes`
--

INSERT INTO `medtypes` (`id`, `type`, `price`, `qty`, `status`) VALUES
(17, '', '200.00', 20, 1),
(24, '200mg', '34.50', 1891, 1),
(25, '250mg', '15.00', 1262, 1),
(26, '100mg', '50.00', 500, 1),
(27, '150mg', '12.00', 1500, 1),
(28, '25mg', '20.00', 1416, 1),
(29, '300mg', '30.00', 1968, 1);

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
  `token` text,
  `verifyStatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `fname`, `lname`, `phone`, `email`, `password`, `age`, `address`, `dp`, `status`, `token`, `verifyStatus`) VALUES
('p-1', 'Pasindu', 'Dissanayakey', '0771697166', '', 'c4a1e9ab9701149995d64bc94a8cac2b1a0ed8f7', 25, '12/21,Seeduwa', NULL, 1, '', 0),
('p-2', 'Abc', 'Abc', '6543119774', 'new@gmail.com', '82e84858248a680eb05614695eca57a0be0718cc', 28, 'Abc', NULL, 0, '', 0),
('p-3', 'Chathura', 'Wanasingha', '0772537849', 'chath_123@gmail.com', '337fc3a69282faa6655820e7a852a1d612f6ca10', 25, 'no.34,Main Street,Colombo', '', 1, '', 0),
('p-4', 'Hemal', 'Perera', '0714659937', 'hem34@hotmail.com', '312b364a03a06c34c96b9c63aafd2649b4ea411b', 30, 'no.24/3,De mel Street,Negombo.', '', 1, '', 0),
('p-5', 'Adeesha', 'Weerasingha', '0763749956', 'adee34@yahoo.com', '743d5daad9c062b0eba165c87aff419da517e976', 29, 'no. 27/4H, Galle Road, Colombo.', '', 1, '', 0),
('p-6', 'Dinuka', 'Sandaruwan', '0772776876', 'dinukasandaruwan.ds@gmail.com', '89f03251116757d99e8fcd330319437a9d7c8a6c', 22, 'test add', '', 1, '', 0),
('p-7', 'test', 'test', '0772776876', 'dinukasandaruwan.ds@gmail.com', '084ee8fcabcef7b546229990cf8b09c79443bb3e', 18, 'test', '', 1, '95rLlB5IHrXSqjVZ2cL0YfVOtVfP4O', -1),
('p-8', 'Dhyan', 'Sachintha', '0772905235', 'khdhyansachintha@gmail.com', 'dfb0fd5b4a8a7ee10e943d9b45092bf854711ee5', 25, '', '', 1, 'Oj3XCvbFUttafa4RqdGKvVN2LmLjDo', -1);

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
('p-1', 'House Dust Mist'),
('p-6', 'House Dust Mist');

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
('doc-1', 'p-8', 7, '2021-03-21', 'Test Note', 1),
('doc-1', 'p-1', 10, '2021-03-21', '', 1),
('doc-1', 'p-1', 11, '2021-03-21', 'Test Note', 0),
('doc-1', 'p-8', 12, '2021-03-21', '', 0),
('doc-1', 'p-6', 13, '2021-03-27', 'Test Note', 0);

-- --------------------------------------------------------

--
-- Table structure for table `prescription_medicine`
--

DROP TABLE IF EXISTS `prescription_medicine`;
CREATE TABLE IF NOT EXISTS `prescription_medicine` (
  `pres_ID` int(11) NOT NULL,
  `med_ID` int(11) NOT NULL,
  `medType_ID` varchar(10) NOT NULL,
  `amtPerTime` char(10) NOT NULL,
  `timesPerDay` char(10) NOT NULL,
  `beforeAfter` char(10) NOT NULL,
  `duration` char(10) NOT NULL,
  PRIMARY KEY (`pres_ID`,`med_ID`,`medType_ID`),
  KEY `med_ID` (`med_ID`),
  KEY `pres_ID` (`pres_ID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription_medicine`
--

INSERT INTO `prescription_medicine` (`pres_ID`, `med_ID`, `medType_ID`, `amtPerTime`, `timesPerDay`, `beforeAfter`, `duration`) VALUES
(7, 24, '200mg', '1', '1', 'a', '5 d'),
(7, 28, '25mg', '2', '2', 'b', '1 w'),
(10, 24, '200mg', '1', '1', 'a', '5 d'),
(11, 25, '250mg', '1.5', '1', 'a', '5 d'),
(11, 27, '150mg', '1', '2', 'a', '5 d'),
(12, 24, '200mg', '1', '1', 'a', '5 d'),
(12, 27, '150mg', '2', '3', 'b', '4 w'),
(12, 28, '25mg', '1.5', '3', 'a', '1 w'),
(12, 29, '300mg', '1.5', '2', 'b', '6 d'),
(13, 24, '200mg', '1/2 tab', '1 n', 'a', '2 d'),
(13, 27, '150mg', '2 tab', '2', 'b', '3 d'),
(13, 28, '25mg', '3 tab', '3', 'a', '1 w'),
(13, 29, '300mg', '1 1/2 tab', '3', 'c', '2 m');

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
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`docId`) REFERENCES `doctor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
