-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 30, 2021 at 06:57 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`presId`, `id`, `doi`, `amount`, `docCharge`, `type`) VALUES
(1, 1, '2021-03-30', '3307.50', '600.00', 'pres');

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
(1, 30, '150mg', 21, '2100.00'),
(1, 25, '250mg', 25, '375.00'),
(1, 24, '200mg', 5, '172.50'),
(1, 27, '150mg', 5, '60.00');

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
('doc-1', 'Normal'),
('doc-2', 'Allergists/Immunologists'),
('doc-2', 'Cardiologists'),
('doc-2', 'Colon and Rectal Surgeons');

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
  `status` int(11) NOT NULL DEFAULT '1',
  `addedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `fname`, `lname`, `phone`, `email`, `password`, `dp`, `type`, `token`, `verifyStatus`, `status`, `addedDate`) VALUES
('doc-1', 'Ranjith', 'Jayasinghe', '0776386324', '', '746e1b9346e43ecbb92a7fafa0ad838414c69f17', '', 1, '', 0, 1, '2021-03-30 16:55:35'),
('doc-2', 'Kavin', 'Dananjaya', '0772776876', 'dinukasandaruwan.ds@gmail.com', '89f03251116757d99e8fcd330319437a9d7c8a6c', '', 0, '', 1, 1, '2021-03-30 16:55:36');

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
('doc-2', 'Friday'),
('doc-2', 'Monday'),
('doc-2', 'Sunday'),
('doc-2', 'Wednesday');

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
(1, 'p-2', '2021-03-30', '');

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
(1, 26, 'HCT(PCV)', '31.5'),
(1, 26, 'RDW', '12.2'),
(1, 26, 'MCV', '91.0'),
(1, 26, 'RBC', '3.46'),
(1, 26, 'MCH', '30.9'),
(1, 26, 'MCHC', '34.0'),
(1, 25, 'Basophils', '0.03'),
(1, 25, 'Lymphocytes', '2.89'),
(1, 25, 'Neutrophils', '3.44'),
(1, 26, 'Hb', '10.7'),
(1, 25, 'Monocytes', '0.33'),
(1, 23, 'WBC', '6.83'),
(1, 25, 'Eosinophils', '0.15'),
(1, 24, 'Neutrophils', '50.3'),
(1, 24, 'Monocytes', '4.8'),
(1, 24, 'Lymphocytes', '42.3'),
(1, 24, 'Eosinophils', '2.2'),
(1, 24, 'Basophils', '0.4');

-- --------------------------------------------------------

--
-- Table structure for table `labreport`
--

DROP TABLE IF EXISTS `labreport`;
CREATE TABLE IF NOT EXISTS `labreport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `labreport`
--

INSERT INTO `labreport` (`id`, `type`) VALUES
(19, 'Lipid Profile'),
(23, 'WBC Parameters'),
(24, 'DC'),
(25, 'Absolute White Cells Count'),
(26, 'RBC Parameters');

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
(19, 'TRIGLYCERIDES', '35 - 160~mg/dl'),
(23, 'WBC', '4.0 - 10.0~10^3/Î¼l'),
(24, 'Basophils', '1 - 2~%'),
(24, 'Basophils', '< 1~%'),
(24, 'Eosinophils', '1 - 6~%'),
(24, 'Lymphocytes', '20 - 40~%'),
(24, 'Monocytes', '2 - 10~%'),
(24, 'Neutrophils', '40 - 80~%'),
(25, 'Basophils', '0.02 - 0.1~10^3/Î¼l'),
(25, 'Eosinophils', '0.02 - 0.50~10^3/Î¼l'),
(25, 'Lymphocytes', '1.00 - 3.00~10^3/Î¼l'),
(25, 'Monocytes', '0.20 - 1.00~10^3/Î¼l'),
(25, 'Neutrophils', '2.00 - 7.00~10^3/Î¼l'),
(26, 'Hb', '12.0 - 15.0~g/dl'),
(26, 'HCT(PCV)', '36.0 - 46.0~%'),
(26, 'MCH', '27.0 - 32.0~pg'),
(26, 'MCHC', '31.5 - 34.5~g/dl'),
(26, 'MCV', '83.0 - 99.0~FL'),
(26, 'RBC', '3.8 - 4.8~10^6/Î¼l'),
(26, 'RDW', '11.0 - 14.0~%');

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `name`, `shortCode`) VALUES
(24, 'Acacia', 'aca-01'),
(25, 'Amoxicillin', 'amox-01'),
(26, 'Phenytoin', 'ph-01'),
(27, 'Lisnopril', 'lis-01'),
(28, 'Diclofenac', 'di-01'),
(29, 'Ranitidine', 'ran-01'),
(30, 'Atenolol', 'ate-01'),
(31, 'Metaformin', 'met-01'),
(32, 'Omeprazole', 'om-01'),
(33, 'Frusemide', 'fru-01');

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
(24, '200mg', '34.50', 1886, 1),
(25, '250mg', '15.00', 1237, 1),
(26, '100mg', '50.00', 500, 1),
(27, '150mg', '12.00', 1495, 1),
(28, '25mg', '20.00', 1416, 1),
(29, '300mg', '30.00', 1968, 1),
(30, '150mg', '100.00', 2479, 1),
(31, '250mg', '50.00', 2400, 1),
(32, '300mg', '25.00', 1000, 1),
(33, '50mg', '23.00', 2100, 1);

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
  `addedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `fname`, `lname`, `phone`, `email`, `password`, `age`, `address`, `dp`, `status`, `token`, `verifyStatus`, `addedDate`) VALUES
('p-1', 'Kiaan', 'Fernando', '0775642213', 'kian@gmail.com', '3e19453fe92a93a8b4c1e199b40ad2e478649c77', 23, '23/1,Jaya Road, Colombo', '', 1, 'LsNWy5mOb33mNkTaKZT5RfaOlPBPbd', -1, '2021-03-30 18:11:54'),
('p-2', 'Niya', 'Perera', '0775642453', 'niya34@yahoo.com', 'e74c93604bb83d52f9aef3e638b77bdf5da7a15f', 30, '56/23, Jawatta road, Colombo', '', 1, '0uXvhzH6gAQoZ5YXiZXLuMMgNSciRJ', -1, '2021-03-30 18:14:08');

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
('doc-1', 'p-2', 1, '2021-03-30', '', 1);

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
(1, 24, '200mg', '1 tab', '2', 'a', '5 d'),
(1, 25, '250mg', '5 ml', '1 m', 'b', '5 d'),
(1, 27, '150mg', '1/2 tab', '1 n', 'a', '5 d'),
(1, 30, '150mg', '1/2 tab', '3', 'a', '1 w');

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
