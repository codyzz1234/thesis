-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2022 at 04:58 PM
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
(1, 'admin12345', '$2y$10$.Tu7hwPxU8ZLU6JvOFa42.Rae6M5r7cY/pSHZyyUXwJsriQb/NE/u', 'Manuel', 'Quezon', '2021-07-20 16:07:11', '2022-01-31 15:21:50'),
(9, 'athena', '$2y$10$VyO2fAPUC.LUNyrwg8Iwr.FukxkgjBsj8gSa0TAmutIfbfsPLML7.', 'Athena', 'Quezon', '2022-01-25 21:00:48', '2022-01-25 21:01:06');

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

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `BranchId` int(11) NOT NULL,
  `Branch` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('csptdfvihmh6rbk14qvu3p2vt01hvnsu', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333134343436313b757365726e616d657c733a363a22617468656e61223b),
('fki93rpq9ssc88q3qjjjv3bd55qek06g', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634313433323b),
('hq9r3ovicjmo6u9lhjrc87oqd6ik3t2q', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634343539363b757365726e616d657c733a31303a2261646d696e3132333435223b),
('mtvn57k7e9voiq8riuj8p80hgl5pv7g1', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634343132353b757365726e616d657c733a31303a2261646d696e3132333435223b),
('o1711j8ji8lbh6pd33uegfap2qov5v1i', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634323439393b),
('t69st94l6pcg1tmimtoshnk6r1j2pnm9', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333634333438393b757365726e616d657c733a31303a2261646d696e3132333435223b);

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

-- --------------------------------------------------------

--
-- Table structure for table `employeestatus`
--

CREATE TABLE `employeestatus` (
  `id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employeestatus`
--

INSERT INTO `employeestatus` (`id`, `status`) VALUES
(6, 'Absent'),
(2, 'Early'),
(3, 'Late'),
(1, 'On Time'),
(5, 'Overtime'),
(4, 'Regular Hours');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `PositionId` int(11) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for dumped tables
--

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
  ADD KEY `EmployeeId` (`EmployeeId`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status` (`status`);

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
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `AttendanceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `BranchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `EmployeeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=344;

--
-- AUTO_INCREMENT for table `employeestatus`
--
ALTER TABLE `employeestatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `PositionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `ScheduleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`EmployeeId`) REFERENCES `employees` (`EmployeeId`) ON DELETE SET NULL ON UPDATE CASCADE;

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
  ADD CONSTRAINT `employees_ibfk_5` FOREIGN KEY (`Status`) REFERENCES `employeestatus` (`id`),
  ADD CONSTRAINT `employees_ibfk_6` FOREIGN KEY (`DepartmentId`) REFERENCES `departments` (`DepartmentId`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
