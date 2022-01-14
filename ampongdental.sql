-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2022 at 02:15 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

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
(1, 'admin12345', '$2y$10$QieAU65kEx9to8u0yJBxC.IdBJQijnlyIEx1kW193dA1rA1BXrxCu', 'Manuelyy', 'Quezon', '2021-07-20 16:07:11', '2022-01-14 13:12:28'),
(7, 'athens', '$2y$10$oxOLyObe1feNRYQfD61z2e.NE4dh4AopChEULAkykZg0SrE9cBhQ2', 'last', 'man', '2022-01-11 10:01:34', '2022-01-11 11:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `AttendanceId` int(11) NOT NULL,
  `EmployeeId` int(11) DEFAULT NULL,
  `EmployeeNumber` varchar(255) DEFAULT NULL,
  `Date` date NOT NULL,
  `TimeIn` timestamp NULL DEFAULT NULL,
  `TimeOut` timestamp NULL DEFAULT NULL,
  `HoursWorked` decimal(10,0) DEFAULT 0,
  `OverTimeHours` int(11) NOT NULL DEFAULT 0,
  `TimeInStatus` int(11) DEFAULT 6,
  `TimeOutStatus` int(11) DEFAULT 6
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`AttendanceId`, `EmployeeId`, `EmployeeNumber`, `Date`, `TimeIn`, `TimeOut`, `HoursWorked`, `OverTimeHours`, `TimeInStatus`, `TimeOutStatus`) VALUES
(160, NULL, NULL, '2022-01-05', '2022-01-05 03:34:01', '2022-01-05 03:35:55', '0', 0, 3, 6),
(161, NULL, NULL, '2022-01-08', '2022-01-08 01:14:14', '2022-01-08 10:14:28', '8', 0, 1, 6);

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
(1, 'QC Branch', 'Somewhere in Qc');

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
('0t1b34kmd5rpqnqk878l0akhphr2uihu', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136323739373b757365726e616d657c733a31303a2261646d696e3132333435223b),
('8e0neft4nles6aeea5iik584uarn1fjn', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136343639313b757365726e616d657c733a31303a2261646d696e3132333435223b),
('918mk00qqvc18rndmga611789sfnna7k', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136333137303b757365726e616d657c733a31303a2261646d696e3132333435223b),
('ced6vu5g4h95mk6lqs218i79a14np598', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136353136313b757365726e616d657c733a31303a2261646d696e3132333435223b),
('crfd7aktdm0mru0mkpjagd5l4qchcqeh', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136343331363b757365726e616d657c733a31303a2261646d696e3132333435223b),
('dbllhl4cjdi25bselufqgp8t81uvln6l', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136353031383b757365726e616d657c733a31303a2261646d696e3132333435223b),
('e015b8hq9srg7jd5i5crbskp64ka3n7t', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136333437363b757365726e616d657c733a31303a2261646d696e3132333435223b),
('e82if6i99mak1la4r0ftqcsj7bmtjob5', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136353934343b757365726e616d657c733a31303a2261646d696e3132333435223b),
('gpe5jh28d0p18iu8lumsiagspg7cqfj6', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136323436383b757365726e616d657c733a31303a2261646d696e3132333435223b),
('k8pl0b5js89dimr35eh95oq6fcdboa5q', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136353934343b),
('n5mo24f5t86jcp1v7a2k0rrqcrk4m1a0', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136313236353b757365726e616d657c733a31303a2261646d696e3132333435223b),
('obha4vft5nfk7ojdcmt88j9ntfnumncj', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136353031383b757365726e616d657c733a31303a2261646d696e3132333435223b),
('p14qkahmjqncpruk0tpg8ipefvusgkik', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136303934323b757365726e616d657c733a31303a2261646d696e3132333435223b),
('pl4tfr6q6t00hv1p0mknrtiqdpo2nm17', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136323135323b757365726e616d657c733a31303a2261646d696e3132333435223b),
('rdc6vjv03sgnbggp146l5eq7vctnfj7j', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136313635333b757365726e616d657c733a31303a2261646d696e3132333435223b),
('u1ofj2aqfiik9fn7g1ql81igk9p062j9', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136313236353b757365726e616d657c733a31303a2261646d696e3132333435223b),
('utn5lps3r7fabuvb5f3ebs5o8g0k338o', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136333739333b757365726e616d657c733a31303a2261646d696e3132333435223b);

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

--
-- Dumping data for table `commissions`
--

INSERT INTO `commissions` (`CommissionId`, `EmployeeId`, `Date`, `Description`, `Amount`) VALUES
(29, 337, '2022-01-14', 'Did not do root canal surgery ', '15000.00');

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

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`DeductionId`, `Deduction`, `Description`, `Amount`) VALUES
(2, 'SSS', 'Tydalzxxu', '241.00'),
(3, 'Phil Health', 'Deductin For Phil Health And Expenses', '3120.57');

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
(18, 'Lab Tech', 'Handles lab analysis and stuffzzyy', NULL),
(25, 'Security', 'Security Department', NULL);

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
(337, '2022-B82170', '15000.00', '0.00', '0.00', '0.00', '0.00'),
(336, '2022-DFUK09', '25000.00', '0.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `employeelogin`
--

CREATE TABLE `employeelogin` (
  `id` int(11) NOT NULL,
  `EmployeeId` int(11) NOT NULL,
  `EmployeeNumber` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `LastLogin` timestamp NULL DEFAULT current_timestamp(),
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp()
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
  `BranchId` int(11) NOT NULL,
  `ScheduleId` int(11) NOT NULL,
  `TotalHours` int(11) NOT NULL DEFAULT 0,
  `Status` int(11) NOT NULL DEFAULT 1,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmployeeId`, `EmployeeNumber`, `RFID`, `FirstName`, `LastName`, `Address`, `ContactNumber`, `BirthDate`, `HireDate`, `DepartmentId`, `PositionId`, `BranchId`, `ScheduleId`, `TotalHours`, `Status`, `Image`) VALUES
(336, '2022-DFUK09', '17171847', 'Cody', 'Yap', '#15 Valencia Street San Juan Metro Manila', '9453218471', '2000-02-03', '2022-01-14', 18, 24, 1, 17, 0, 1, './assets/EmployeeImages/2022-DFUK09.png'),
(337, '2022-B82170', '4512431', 'Kenley', 'So', 'Quezon City New Manila', '9224891495', '1989-02-01', '2022-01-14', 18, 28, 1, 17, 0, 1, './assets/EmployeeImages/default.png');

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
(2, 'Early'),
(3, 'Late'),
(1, 'On Time'),
(5, 'Overtime'),
(4, 'Regular Hours');

-- --------------------------------------------------------

--
-- Table structure for table `imagepath`
--

CREATE TABLE `imagepath` (
  `imagePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `imagepath`
--

INSERT INTO `imagepath` (`imagePath`) VALUES
('2021-454XAY1.jpg'),
('assets/EmployeeImages/2021-454XAY.png'),
('assets/EmployeeImages/2021-454XAY.jpg'),
('assets/EmployeeImages/2021-454XAY1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `leaveallocation`
--

CREATE TABLE `leaveallocation` (
  `LeaveId` int(11) NOT NULL,
  `EmployeeId` int(11) DEFAULT NULL,
  `LeaveAllocated` int(11) NOT NULL DEFAULT 0,
  `LeaveUse` int(11) NOT NULL,
  `LeaveBalance` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaveallocation`
--

INSERT INTO `leaveallocation` (`LeaveId`, `EmployeeId`, `LeaveAllocated`, `LeaveUse`, `LeaveBalance`) VALUES
(4, NULL, 50, 0, 50),
(8, NULL, 12, 0, 12),
(9, NULL, 15, 0, 15),
(10, NULL, 46, 0, 46);

-- --------------------------------------------------------

--
-- Table structure for table `leavetype`
--

CREATE TABLE `leavetype` (
  `LeaveId` int(11) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `DaysAllocated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leavetype`
--

INSERT INTO `leavetype` (`LeaveId`, `Type`, `Description`, `DaysAllocated`) VALUES
(27, 'Medical Leave', 'Medical Leaving', 52),
(29, 'Vacation Leave', 'Leaving For A Vacation', 23),
(30, 'Vacation Leave', 'Leaving For A Vacation', 23);

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
(2, 'Lab Tech Head and stuff', 'In charge of other lab techs and other stuff'),
(24, 'Security Head', 'In Charge of Security'),
(28, 'Security Manager', 'Manages the security');

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
(17, '09:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `viewemployeeinformation`
-- (See below for the actual view)
--
CREATE TABLE `viewemployeeinformation` (
`EmployeeId` int(11)
,`EmployeeNumber` varchar(255)
,`FirstName` varchar(255)
,`LastName` varchar(255)
,`ContactNumber` varchar(255)
,`Image` varchar(255)
,`Department` varchar(255)
,`Branch` varchar(255)
,`Position` varchar(255)
,`TimeIn` time
,`TimeOut` time
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `viewemployeepayroll`
-- (See below for the actual view)
--
CREATE TABLE `viewemployeepayroll` (
`Image` varchar(255)
,`EmployeeId` int(11)
,`EmployeeNumber` varchar(255)
,`FirstName` varchar(255)
,`LastName` varchar(255)
,`BaseSalary` decimal(13,2)
,`SSS` decimal(13,2)
,`PagIbig` decimal(13,2)
,`PhilHealth` decimal(13,2)
,`Department` varchar(255)
,`Position` varchar(255)
,`TotalHours` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Structure for view `viewemployeeinformation`
--
DROP TABLE IF EXISTS `viewemployeeinformation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewemployeeinformation`  AS SELECT `employees`.`EmployeeId` AS `EmployeeId`, `employees`.`EmployeeNumber` AS `EmployeeNumber`, `employees`.`FirstName` AS `FirstName`, `employees`.`LastName` AS `LastName`, `employees`.`ContactNumber` AS `ContactNumber`, `employees`.`Image` AS `Image`, `departments`.`Department` AS `Department`, `branches`.`Branch` AS `Branch`, `positions`.`Position` AS `Position`, `schedules`.`TimeIn` AS `TimeIn`, `schedules`.`TimeOut` AS `TimeOut` FROM ((((`employees` left join `departments` on(`employees`.`DepartmentId` = `departments`.`DepartmentId`)) left join `positions` on(`employees`.`PositionId` = `positions`.`PositionId`)) left join `schedules` on(`employees`.`ScheduleId` = `schedules`.`ScheduleId`)) left join `branches` on(`employees`.`BranchId` = `branches`.`BranchId`)) ;

-- --------------------------------------------------------

--
-- Structure for view `viewemployeepayroll`
--
DROP TABLE IF EXISTS `viewemployeepayroll`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewemployeepayroll`  AS SELECT `employees`.`Image` AS `Image`, `employees`.`EmployeeId` AS `EmployeeId`, `employees`.`EmployeeNumber` AS `EmployeeNumber`, `employees`.`FirstName` AS `FirstName`, `employees`.`LastName` AS `LastName`, `employeecalculation`.`BaseSalary` AS `BaseSalary`, `employeecalculation`.`SSS` AS `SSS`, `employeecalculation`.`PagIbig` AS `PagIbig`, `employeecalculation`.`PhilHealth` AS `PhilHealth`, `departments`.`Department` AS `Department`, `positions`.`Position` AS `Position`, sum(`attendance`.`HoursWorked`) AS `TotalHours` FROM ((((`employees` left join `employeecalculation` on(`employees`.`EmployeeId` = `employeecalculation`.`EmployeeId`)) left join `departments` on(`employees`.`DepartmentId` = `departments`.`DepartmentId`)) left join `positions` on(`employees`.`PositionId` = `positions`.`PositionId`)) left join `attendance` on(`attendance`.`EmployeeId` = `employees`.`EmployeeId`)) WHERE `attendance`.`Date` = curdate() GROUP BY `employees`.`EmployeeId` ;

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
  ADD KEY `attendance_ibfk_1` (`EmployeeNumber`),
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
-- Indexes for table `employeelogin`
--
ALTER TABLE `employeelogin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `EmployeeId` (`EmployeeId`),
  ADD UNIQUE KEY `EmployeeNumber` (`EmployeeNumber`);

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
-- Indexes for table `leaveallocation`
--
ALTER TABLE `leaveallocation`
  ADD PRIMARY KEY (`LeaveId`),
  ADD UNIQUE KEY `EmployeeId` (`EmployeeId`);

--
-- Indexes for table `leavetype`
--
ALTER TABLE `leavetype`
  ADD PRIMARY KEY (`LeaveId`);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `AttendanceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `BranchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `CommissionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `DeductionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `DepartmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `employeelogin`
--
ALTER TABLE `employeelogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `EmployeeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=338;

--
-- AUTO_INCREMENT for table `employeestatus`
--
ALTER TABLE `employeestatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `leaveallocation`
--
ALTER TABLE `leaveallocation`
  MODIFY `LeaveId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `leavetype`
--
ALTER TABLE `leavetype`
  MODIFY `LeaveId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `PositionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `ScheduleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`EmployeeNumber`) REFERENCES `employees` (`EmployeeNumber`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`EmployeeId`) REFERENCES `employees` (`EmployeeId`) ON DELETE SET NULL ON UPDATE CASCADE;

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
-- Constraints for table `employeelogin`
--
ALTER TABLE `employeelogin`
  ADD CONSTRAINT `employeelogin_ibfk_1` FOREIGN KEY (`EmployeeId`) REFERENCES `employees` (`EmployeeId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employeelogin_ibfk_2` FOREIGN KEY (`EmployeeNumber`) REFERENCES `employees` (`EmployeeNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`PositionId`) REFERENCES `positions` (`PositionId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_ibfk_3` FOREIGN KEY (`BranchId`) REFERENCES `branches` (`BranchId`),
  ADD CONSTRAINT `employees_ibfk_4` FOREIGN KEY (`ScheduleId`) REFERENCES `schedules` (`ScheduleId`),
  ADD CONSTRAINT `employees_ibfk_5` FOREIGN KEY (`Status`) REFERENCES `employeestatus` (`id`),
  ADD CONSTRAINT `employees_ibfk_6` FOREIGN KEY (`DepartmentId`) REFERENCES `departments` (`DepartmentId`) ON DELETE SET NULL;

--
-- Constraints for table `leaveallocation`
--
ALTER TABLE `leaveallocation`
  ADD CONSTRAINT `leaveallocation_ibfk_1` FOREIGN KEY (`EmployeeId`) REFERENCES `employees` (`EmployeeId`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
