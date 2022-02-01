-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2022 at 11:38 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ampongdental`
--

-- --------------------------------------------------------

--
-- Table structure for table `activitylog`
--

CREATE TABLE `activitylog` (
  `id` int(11) NOT NULL,
  `AdminId` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Activity` varchar(255) NOT NULL,
  `Date` date DEFAULT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activitylog`
--

INSERT INTO `activitylog` (`id`, `AdminId`, `Username`, `Activity`, `Date`, `Time`) VALUES
(64, 13, 'admin12345', 'Updated Employee \"2022-00SIJ0\"', '2022-02-01', '2022-01-31 19:17:18'),
(65, 13, 'admin12345', 'Logged In', '2022-02-01', '2022-02-01 10:30:09');

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `Id` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `LastLogin` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`Id`, `Username`, `Password`, `FirstName`, `LastName`, `createdOn`, `LastLogin`) VALUES
(13, 'admin12345', '$2y$10$agZQ4v5qeUZLmIZMUvfuRubh/1sKzDIy/1Tym29oMe/Iro0ItZLPe', 'Cody', 'So', '2022-01-31 18:30:07', '2022-02-01 10:30:09'),
(16, 'athena', '$2y$10$0pNnaVG/sIot.s6NXSls1O8ngfuHpsTBeukNzL.QMw218h3kS/uTC', '12313', '12313', '2022-01-31 18:45:12', '2022-01-31 18:45:12'),
(17, 'athenazz', '$2y$10$mpPf8QcLPfm4MBWZ0D/kVO2n6NEfaTUR0dN2dRMPNhVpXdgA8/GsC', '12313', '12313', '2022-01-31 18:45:21', '2022-01-31 18:45:21');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `AttendanceId` int(11) NOT NULL,
  `EmployeeId` int(11) DEFAULT NULL,
  `EmployeeNumber` varchar(255) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `TimeIn` timestamp NULL DEFAULT NULL,
  `TimeOut` timestamp NULL DEFAULT NULL,
  `MinutesWorked` int(11) DEFAULT 0,
  `OverTimeMinutes` int(11) DEFAULT 0,
  `TimeInStatus` int(11) DEFAULT NULL,
  `TimeOutStatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`AttendanceId`, `EmployeeId`, `EmployeeNumber`, `Date`, `TimeIn`, `TimeOut`, `MinutesWorked`, `OverTimeMinutes`, `TimeInStatus`, `TimeOutStatus`) VALUES
(19, 345, '2022-00SIJ0', '2022-02-01', '2022-02-01 00:27:03', '2022-02-01 10:27:37', 507, 11, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `BranchId` int(11) NOT NULL,
  `Branch` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`BranchId`, `Branch`, `Address`) VALUES
(13, 'Quezon City Branch', 'Project 8, Lungsod Quezon, Kalakhang Manila');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('5ojpvtekgk2f1hqan4o4s2jjphoogji8', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634343539363b757365726e616d657c733a31303a2261646d696e3132333435223b),
('6ntmepedht3fgr6jrfeq9p1so3im5t9v', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333730373631353b),
('82kr4f8cepdue3qf3q6msntdhuqj602c', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333635363738323b),
('8grf43t9m6685hcgjah2sfbe1fvq0ork', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333635303533383b),
('93rce7uukoh7jj1judlgppna3d1qr9d4', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333731313735323b757365726e616d657c733a31303a2261646d696e3132333435223b61646d696e49647c733a323a223133223b),
('984teej215ma4j6idbfsbhqopnig9vu3', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333731313930363b),
('a0esnut49m7qho22h3t2eaa7du7tslc4', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333635313937343b),
('ajr6dd0ul06m3o55jnvsdu04q0fr8183', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333635313933383b757365726e616d657c733a363a22617468656e61223b61646d696e49647c733a313a2239223b),
('b915qdns0fquopq3si5oikm2dq8rpg7p', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634353534323b757365726e616d657c733a363a22617468656e61223b),
('csptdfvihmh6rbk14qvu3p2vt01hvnsu', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333134343436313b757365726e616d657c733a363a22617468656e61223b),
('db7cie3tq5trvspn5bkd9jutj9d2efgg', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333635343434353b757365726e616d657c733a363a22617468656e61223b61646d696e49647c733a313a2239223b),
('e0q8eg76fftv1jof8marhs0lel8rfddo', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634353936393b757365726e616d657c733a363a22617468656e61223b),
('fd16fom4rbcphk5dvb30qbsp9ejg92ge', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634353232353b757365726e616d657c733a363a22617468656e61223b),
('fki93rpq9ssc88q3qjjjv3bd55qek06g', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634313433323b),
('hq9r3ovicjmo6u9lhjrc87oqd6ik3t2q', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634343539363b757365726e616d657c733a31303a2261646d696e3132333435223b),
('ifk2ljjlvraflrq2jelvqtjqssr52nho', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634393030343b),
('jgb42ku6hp8opjokufb24lgj61h7mgdq', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333635333633373b757365726e616d657c733a383a22636f647931323334223b61646d696e49647c733a323a223132223b),
('jirs66cn9q7oheov7iecktvihgqcrtcr', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333731313735323b757365726e616d657c733a31303a2261646d696e3132333435223b61646d696e49647c733a323a223133223b),
('kmmcqkqt112b6rngki0t7uhshcobsuf2', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333635353238323b757365726e616d657c733a31303a2261646d696e3132333435223b61646d696e49647c733a323a223133223b),
('kv0cbc2o13v8et7mhnaujibof6pdv1pq', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634383939313b757365726e616d657c733a363a22617468656e61223b),
('lqe2sfsig8q6pp63hnj9bcd0goh432km', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634363237363b757365726e616d657c733a363a22617468656e61223b),
('mm0oopt8k0lqee7riig556g8qa4unm20', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333731313930363b),
('mp4t0stmdsvufjh2aiel1d8nig9ps6ql', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333635363534333b757365726e616d657c733a31303a2261646d696e3132333435223b61646d696e49647c733a323a223133223b),
('mtvn57k7e9voiq8riuj8p80hgl5pv7g1', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634343132353b757365726e616d657c733a31303a2261646d696e3132333435223b),
('o1711j8ji8lbh6pd33uegfap2qov5v1i', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634323439393b),
('p2dm5lnrffokbjc2d7ruprgniumon02f', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333635323532323b757365726e616d657c733a363a22617468656e61223b61646d696e49647c733a313a2239223b),
('pijnlimj6dccqbloporkg3rt54gicoh8', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634363734343b757365726e616d657c733a363a22617468656e61223b),
('pvp6acq9g9fo0fbmqfqo8ldkjj7o775p', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634393430333b757365726e616d657c733a31303a2261646d696e3132333435223b61646d696e49647c733a313a2231223b),
('t69st94l6pcg1tmimtoshnk6r1j2pnm9', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634333438393b757365726e616d657c733a31303a2261646d696e3132333435223b),
('tbcof6faa34uv0m65r2pi7908rrjhhok', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333635363137313b757365726e616d657c733a31303a2261646d696e3132333435223b61646d696e49647c733a323a223133223b),
('to5qlqkqrpi32719bp6dt69r5ds9l2p5', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333635333331343b757365726e616d657c733a383a22636f647931323334223b61646d696e49647c733a323a223132223b),
('ujapn29n52k1b4bdqktjah2318lt0i0r', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333635313131323b757365726e616d657c733a363a22617468656e61223b61646d696e49647c733a313a2239223b),
('vvsb827ptls0e6orr7r4ao3r4umhmf4c', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634383132343b757365726e616d657c733a363a22617468656e61223b);

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `CommissionId` int(11) NOT NULL,
  `EmployeeId` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Amount` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `DeductionId` int(11) NOT NULL,
  `Deduction` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Amount` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `DepartmentId` int(11) NOT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `DepartmentHead` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`DepartmentId`, `Department`, `Description`, `DepartmentHead`) VALUES
(29, 'Dental Department', 'The Dental Department', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employeecalculation`
--

CREATE TABLE `employeecalculation` (
  `EmployeeId` int(11) DEFAULT NULL,
  `EmployeeNumber` varchar(255) NOT NULL,
  `BaseSalary` decimal(13,2) NOT NULL DEFAULT 0.00,
  `SSS` decimal(13,2) NOT NULL DEFAULT 0.00,
  `PagIbig` decimal(13,2) NOT NULL DEFAULT 0.00,
  `PhilHealth` decimal(13,2) NOT NULL DEFAULT 0.00,
  `CashAdvance` decimal(13,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employeecalculation`
--

INSERT INTO `employeecalculation` (`EmployeeId`, `EmployeeNumber`, `BaseSalary`, `SSS`, `PagIbig`, `PhilHealth`, `CashAdvance`) VALUES
(345, '2022-00SIJ0', '14000.00', '0.00', '0.00', '0.00', '0.00'),
(344, '2022-ZKTUAQ', '1000.00', '0.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `EmployeeId` int(11) NOT NULL,
  `EmployeeNumber` varchar(255) DEFAULT NULL,
  `RFID` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `ContactNumber` varchar(255) NOT NULL,
  `BirthDate` date NOT NULL,
  `HireDate` date DEFAULT NULL,
  `DepartmentId` int(11) DEFAULT NULL,
  `PositionId` int(11) DEFAULT NULL,
  `BranchId` int(11) DEFAULT NULL,
  `ScheduleId` int(11) DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 6,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmployeeId`, `EmployeeNumber`, `RFID`, `FirstName`, `LastName`, `Address`, `ContactNumber`, `BirthDate`, `HireDate`, `DepartmentId`, `PositionId`, `BranchId`, `ScheduleId`, `Status`, `Image`) VALUES
(344, '2022-ZKTUAQ', '491481', 'Jerico', 'Casas', 'Quezon City Somewhere Theress', '9453218471', '2000-02-01', '2022-01-31', 29, 33, 13, 24, 5, './assets/EmployeeImages/default.png'),
(345, '2022-00SIJ0', '1414241231', 'Cody', 'Yap', '#15 Valencia Street San Juan Metro Manila', '09453218471', '2022-02-03', '2022-01-31', 29, 33, 13, 24, 5, './assets/EmployeeImages/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `employeestatus`
--

CREATE TABLE `employeestatus` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employeestatus`
--

INSERT INTO `employeestatus` (`id`, `status`) VALUES
(1, 'On Time'),
(2, 'Late'),
(3, 'Regular Hour\r\n'),
(4, 'Overtime\r\n'),
(5, 'Not Present\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `PositionId` int(11) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`PositionId`, `Position`, `Description`) VALUES
(33, 'Dentistzz', 'Performs Dental Activities');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `ScheduleId` int(11) NOT NULL,
  `TimeIn` time DEFAULT NULL,
  `TimeOut` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`ScheduleId`, `TimeIn`, `TimeOut`) VALUES
(24, '09:00:00', '17:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activitylog`
--
ALTER TABLE `activitylog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `AdminId` (`AdminId`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Password` (`Password`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`AttendanceId`),
  ADD KEY `EmployeeId` (`EmployeeId`),
  ADD KEY `TimeInStatus` (`TimeInStatus`),
  ADD KEY `TimeOutStatus` (`TimeOutStatus`),
  ADD KEY `EmployeeNumber` (`EmployeeNumber`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`BranchId`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`,`ip_address`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`CommissionId`),
  ADD KEY `commissions_ibfk_1` (`EmployeeId`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`DeductionId`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`DepartmentId`),
  ADD KEY `departments_ibfk_1` (`DepartmentHead`);

--
-- Indexes for table `employeecalculation`
--
ALTER TABLE `employeecalculation`
  ADD UNIQUE KEY `EmployeeNumber` (`EmployeeNumber`),
  ADD KEY `EmployeId` (`EmployeeId`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmployeeId`),
  ADD UNIQUE KEY `RFID` (`RFID`),
  ADD UNIQUE KEY `EmployeeNumber` (`EmployeeNumber`),
  ADD KEY `DepartmentId` (`DepartmentId`),
  ADD KEY `PositionId` (`PositionId`),
  ADD KEY `BranchId` (`BranchId`),
  ADD KEY `ScheduleId` (`ScheduleId`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `employeestatus`
--
ALTER TABLE `employeestatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`PositionId`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`ScheduleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activitylog`
--
ALTER TABLE `activitylog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `AttendanceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `BranchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `CommissionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `DeductionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `DepartmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `EmployeeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=346;

--
-- AUTO_INCREMENT for table `employeestatus`
--
ALTER TABLE `employeestatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `PositionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `ScheduleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activitylog`
--
ALTER TABLE `activitylog`
  ADD CONSTRAINT `activitylog_ibfk_1` FOREIGN KEY (`AdminId`) REFERENCES `adminlogin` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activitylog_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `adminlogin` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`EmployeeId`) REFERENCES `employees` (`EmployeeId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`TimeInStatus`) REFERENCES `employeestatus` (`id`),
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`TimeOutStatus`) REFERENCES `employeestatus` (`id`),
  ADD CONSTRAINT `attendance_ibfk_4` FOREIGN KEY (`EmployeeNumber`) REFERENCES `employees` (`EmployeeNumber`);

--
-- Constraints for table `commissions`
--
ALTER TABLE `commissions`
  ADD CONSTRAINT `commissions_ibfk_1` FOREIGN KEY (`EmployeeId`) REFERENCES `employees` (`EmployeeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`DepartmentHead`) REFERENCES `employees` (`EmployeeId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `employeecalculation`
--
ALTER TABLE `employeecalculation`
  ADD CONSTRAINT `employeecalculation_ibfk_1` FOREIGN KEY (`EmployeeNumber`) REFERENCES `employees` (`EmployeeNumber`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employeecalculation_ibfk_2` FOREIGN KEY (`EmployeeId`) REFERENCES `employees` (`EmployeeId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`PositionId`) REFERENCES `positions` (`PositionId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_ibfk_3` FOREIGN KEY (`BranchId`) REFERENCES `branches` (`BranchId`) ON DELETE SET NULL,
  ADD CONSTRAINT `employees_ibfk_4` FOREIGN KEY (`ScheduleId`) REFERENCES `schedules` (`ScheduleId`),
  ADD CONSTRAINT `employees_ibfk_6` FOREIGN KEY (`DepartmentId`) REFERENCES `departments` (`DepartmentId`) ON DELETE SET NULL,
  ADD CONSTRAINT `employees_ibfk_7` FOREIGN KEY (`Status`) REFERENCES `employeestatus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
