-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2021 at 08:46 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

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
(1, 'admin12345', '$2y$10$AIxYamY/pAvr8UQaecXfZevnXX7rFHmK00tOFe4hcZ7Io/MOAzS/e', 'Manuelyy', 'Quezon', '2021-07-20 16:07:11', '2021-12-27 19:44:24');

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
  `TimeInStatus` int(11) DEFAULT 6,
  `TimeOutStatus` int(11) DEFAULT 6
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

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`BranchId`, `Branch`, `Address`) VALUES
(1, 'QC Branch', 'Somewhere in Qc');

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
  `id` int(11) NOT NULL,
  `EmployeeNumber` varchar(255) NOT NULL,
  `BaseSalary` decimal(13,2) NOT NULL DEFAULT 0.00,
  `SSS` decimal(13,2) NOT NULL DEFAULT 0.00,
  `PagIbig` decimal(13,2) NOT NULL DEFAULT 0.00,
  `PhilHealth` decimal(13,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employeecalculation`
--

INSERT INTO `employeecalculation` (`id`, `EmployeeNumber`, `BaseSalary`, `SSS`, `PagIbig`, `PhilHealth`) VALUES
(2, '2021-MIE8RC', '15000.00', '0.00', '0.00', '0.00');

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
(330, '2021-MIE8RC', '0002115107', 'Keegan Michael', 'Key And Peelez', 'Somewhere in contintal United States', '09224891495', '1971-03-22', '2021-12-24', 18, 24, 1, 17, 0, 1, './assets/EmployeeImages/2021-MIE8RC.jpg');

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
(7, 'Absent'),
(3, 'Early'),
(5, 'Half Day'),
(2, 'Late'),
(1, 'On Time'),
(4, 'Overtime'),
(6, 'Under Time');

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
(2, 'Lab Tech Head', 'In charge of other lab techs and other stuff'),
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
(17, '09:00:00', '18:00:00'),
(18, '10:00:00', '19:00:00');

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
-- Structure for view `viewemployeeinformation`
--
DROP TABLE IF EXISTS `viewemployeeinformation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewemployeeinformation`  AS SELECT `employees`.`EmployeeId` AS `EmployeeId`, `employees`.`EmployeeNumber` AS `EmployeeNumber`, `employees`.`FirstName` AS `FirstName`, `employees`.`LastName` AS `LastName`, `employees`.`ContactNumber` AS `ContactNumber`, `employees`.`Image` AS `Image`, `departments`.`Department` AS `Department`, `branches`.`Branch` AS `Branch`, `positions`.`Position` AS `Position`, `schedules`.`TimeIn` AS `TimeIn`, `schedules`.`TimeOut` AS `TimeOut` FROM ((((`employees` left join `departments` on(`employees`.`DepartmentId` = `departments`.`DepartmentId`)) left join `positions` on(`employees`.`PositionId` = `positions`.`PositionId`)) left join `schedules` on(`employees`.`ScheduleId` = `schedules`.`ScheduleId`)) left join `branches` on(`employees`.`BranchId` = `branches`.`BranchId`)) ;

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `EmployeeNumber` (`EmployeeNumber`);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `AttendanceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `BranchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `employeecalculation`
--
ALTER TABLE `employeecalculation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employeelogin`
--
ALTER TABLE `employeelogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `EmployeeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT for table `employeestatus`
--
ALTER TABLE `employeestatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`DepartmentHead`) REFERENCES `employees` (`EmployeeId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `employeecalculation`
--
ALTER TABLE `employeecalculation`
  ADD CONSTRAINT `employeecalculation_ibfk_1` FOREIGN KEY (`EmployeeNumber`) REFERENCES `employees` (`EmployeeNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

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
