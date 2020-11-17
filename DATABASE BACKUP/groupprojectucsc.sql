-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2020 at 05:01 PM
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
USE groupprojectucsc;

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
  `date` date DEFAULT NULL,
  `status` int(11) NOT NULL
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
  `password` text NOT NULL,
  `dp` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `fname`, `lname`, `phone`, `email`, `password`, `dp`) VALUES
('doc45', 'Rukmal', 'Weerasinghe', '0776386324', '', 'c7162aebf2f225aa12236473f82222a9b088126b', NULL);

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
  `id` int(11) NOT NULL,
  `doi` date NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `labreport`
--

INSERT INTO `labreport` (`patientId`, `id`, `doi`, `type`) VALUES
('p-3', 19, '2020-11-17', 'Lipid Profile');

-- --------------------------------------------------------

--
-- Table structure for table `labreportdetails`
--

CREATE TABLE `labreportdetails` (
  `id` int(11) NOT NULL,
  `testName` varchar(50) NOT NULL,
  `result` text NOT NULL,
  `normalRange` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labreportdetails`
--

INSERT INTO `labreportdetails` (`id`, `testName`, `result`, `normalRange`) VALUES
(17, 'test 2', '10', '20-50'),
(17, 'test 1', '20', '25-10'),
(18, 'wes', '237', '56<5'),
(18, 'sfdf', '231', '456'),
(19, 'Serum Cholesterol', '203 mg/dl', '150-200'),
(19, 'HDL - Cholesterol', '36 mg/dl', '40-60'),
(19, 'Triglycerides', '169 mg/dl', '25-160'),
(19, 'LDL - Cholesterol', '133 mg/dl', '<130');

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
(18, 'Test 2', 't2'),
(19, 'Test 3', 't3'),
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

CREATE TABLE `medtypes` (
  `id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `price` int(5) NOT NULL,
  `qty` int(4) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medtypes`
--

INSERT INTO `medtypes` (`id`, `type`, `price`, `qty`, `status`) VALUES
(17, '', 200, 20, 1),
(18, 'type 1 ', 200, 10, 0),
(18, 'type 4', 10, 20, 0),
(18, 'type 2', 100, 5, 0),
(18, 'type 3 ', 15, 5, 0),
(19, 'type 1', 10, 100, 0),
(19, 'type 2', 15, 200, 0),
(19, 'type 4', 15, 150, 0),
(19, 'type 3', 10, 1000, 0),
(18, 'type 5', 10, 20, 0),
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

CREATE TABLE `patient` (
  `id` varchar(9) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `age` int(3) NOT NULL,
  `address` text NOT NULL,
  `dp` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `fname`, `lname`, `phone`, `email`, `password`, `age`, `address`, `dp`, `status`) VALUES
('p-1', 'Pasindu', 'Dissanayakey', '0771697166', '', 'ghsdfsfas', 25, '12/21,Seeduwa', NULL, 0),
('p-2', 'Abc', 'Abc', '6543119774', 'new@gmail.com', '82e84858248a680eb05614695eca57a0be0718cc', 28, 'Abc', NULL, 0),
('p-3', 'Chathura', 'Wanasingha', '0772537849', 'chath_123@gmail.com', '337fc3a69282faa6655820e7a852a1d612f6ca10', 25, 'no.34,Main Street,Colombo', '', 1),
('p-4', 'Hemal', 'Perera', '0714659937', 'hem34@hotmail.com', '312b364a03a06c34c96b9c63aafd2649b4ea411b', 30, 'no.24/3,De mel Street,Negombo.', '', 1),
('p-5', 'Adeesha', 'Weerasingha', '0763749956', 'adee34@yahoo.com', '743d5daad9c062b0eba165c87aff419da517e976', 29, 'no. 27/4H, Galle Road, Colombo.', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patientallergy`
--

CREATE TABLE `patientallergy` (
  `id` varchar(9) NOT NULL,
  `allergy` varchar(30) NOT NULL
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

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`docId`, `patientId`, `id`, `doi`, `note`, `status`) VALUES
('doc45', 'p-1', 123, '2020-10-15', NULL, 0),
('doc45', 'p-1', 124, '2020-10-29', '', 0);

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
(123, 10, '0', 1.5, 2, 'Before', '4 weeks'),
(124, 6, '0', 1, 3, 'b', '1 w'),
(124, 11, '0', 1.5, 2, 'a', '1 w');

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
-- Indexes for table `labreportdetails`
--
ALTER TABLE `labreportdetails`
  ADD PRIMARY KEY (`id`,`testName`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medtypes`
--
ALTER TABLE `medtypes`
  ADD PRIMARY KEY (`id`,`type`);

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
-- AUTO_INCREMENT for table `labreport`
--
ALTER TABLE `labreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
