-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2022 at 02:10 PM
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
(1, 'admin12345', '$2y$10$QieAU65kEx9to8u0yJBxC.IdBJQijnlyIEx1kW193dA1rA1BXrxCu', 'Manuelyy', 'Quezon', '2021-07-20 16:07:11', '2022-01-25 12:57:29');

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
('00vugq5aa4rhdor57ss4uos3sf3udm91', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323934313430383b757365726e616d657c733a31303a2261646d696e3132333435223b),
('03c2eqf46rakj38q07t2i89jus2348vi', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323935323533373b757365726e616d657c733a31303a2261646d696e3132333435223b),
('0838u9fdjsleq01ch1rni8lqvvdcordc', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333131363136363b),
('0kfvdcgej0mip39fji66remk0e673g78', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323934363332373b),
('0t1b34kmd5rpqnqk878l0akhphr2uihu', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136323739373b757365726e616d657c733a31303a2261646d696e3132333435223b),
('1212ntiji01eo1175l8qcba0m30um5tl', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323935323534383b),
('19g346ljoglm3hqac8es44vs2bnvcpeh', '127.0.0.1', '0000-00-00 00:00:00', ''),
('1glglsl7vf6ftsolbupmrsa8n0hvhfs3', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039353130393b757365726e616d657c733a31303a2261646d696e3132333435223b),
('2879k5cp717ofad3m0t5n35lc9js48g9', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333130313936353b757365726e616d657c733a31303a2261646d696e3132333435223b),
('2ifj5er38kmk19rjvfn1lkit38s19dib', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333130353935383b),
('2ohhf8ahv73jefln2bh3ud1qe09as8nq', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323934333436343b),
('2qjmhmitd4ufsqapokbvqhej8ffjg7fn', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333130333234393b757365726e616d657c733a31313a22617468656e613132333435223b),
('2unveud3sjec7gmtmahp18lkvbve4ifb', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323933383834323b),
('34fsqfme2qjsa9i3fac2467oe833sf7j', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323934313033313b757365726e616d657c733a31303a2261646d696e3132333435223b),
('51olmgbf0thg7l48k1mfo8e04d3lofj4', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039363237333b757365726e616d657c733a31303a2261646d696e3132333435223b),
('5i1b9neg1gp7g3audhsdqj8vfvnrooo4', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039373131313b757365726e616d657c733a31303a2261646d696e3132333435223b),
('66b282lpq0alisur9e0daitm0perbpcr', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039343937373b757365726e616d657c733a31303a2261646d696e3132333435223b),
('78g3betmgrd3m8qt05fo9dgbpcuu0rsa', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323935323534383b),
('7q38d32hno12rjoigmlcmdo1p0lf76ed', '127.0.0.1', '0000-00-00 00:00:00', ''),
('7shb3ju9ucsqmn5k3t1jqiao1464i60l', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323538393536393b),
('8e0neft4nles6aeea5iik584uarn1fjn', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136343639313b757365726e616d657c733a31303a2261646d696e3132333435223b),
('8it7vahuh78c8nojgrvuveflqga4k657', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039373834313b757365726e616d657c733a31303a2261646d696e3132333435223b),
('8qvtp04nj4i6cgld55crimhal9f0k2fu', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323630303836393b),
('918mk00qqvc18rndmga611789sfnna7k', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136333137303b757365726e616d657c733a31303a2261646d696e3132333435223b),
('aj6lqmnek8nsc33h6ggbe9oj03n29hv5', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323933393139373b),
('bg0hqe2cq23c9mqu47ihmua9mk5jseto', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039363831303b757365726e616d657c733a31303a2261646d696e3132333435223b),
('bq4g7s3k55011kobvl6un70a04fc3l26', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333130343733373b757365726e616d657c733a31313a22617468656e613132333435223b),
('bu899purtpj0983s30bbrjgn8aprjnja', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323934313933343b757365726e616d657c733a31303a2261646d696e3132333435223b),
('cdrum0sk4j9inbm4imfcolags061gr2c', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333131353337383b757365726e616d657c733a31303a2261646d696e3132333435223b),
('ced6vu5g4h95mk6lqs218i79a14np598', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136353136313b757365726e616d657c733a31303a2261646d696e3132333435223b),
('crfd7aktdm0mru0mkpjagd5l4qchcqeh', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136343331363b757365726e616d657c733a31303a2261646d696e3132333435223b),
('dbllhl4cjdi25bselufqgp8t81uvln6l', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136353031383b757365726e616d657c733a31303a2261646d696e3132333435223b),
('dp2u1m963div0h0817hvbcd0vm7dk7ku', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323934303638373b757365726e616d657c733a31303a2261646d696e3132333435223b),
('dv5io58b7is6v8tc2atl2femo177saap', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323933393931333b757365726e616d657c733a31303a2261646d696e3132333435223b),
('e015b8hq9srg7jd5i5crbskp64ka3n7t', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136333437363b757365726e616d657c733a31303a2261646d696e3132333435223b),
('e82if6i99mak1la4r0ftqcsj7bmtjob5', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136353934343b757365726e616d657c733a31303a2261646d696e3132333435223b),
('est3j6ft9k6q496gaam6kdi9pkgj74i4', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039383138313b757365726e616d657c733a31303a2261646d696e3132333435223b),
('ga25iodnjjspl2nurleum5f13rputmfd', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323934323538303b),
('glv62pn5nbqe8cmtli91pfl2ahm6bslm', '127.0.0.1', '0000-00-00 00:00:00', ''),
('gpe5jh28d0p18iu8lumsiagspg7cqfj6', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136323436383b757365726e616d657c733a31303a2261646d696e3132333435223b),
('guqncbrhhs78uocodlsb7beiknk45ort', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039353935323b757365726e616d657c733a31303a2261646d696e3132333435223b),
('inkuq6kokval5qj19lirraeda5unep5p', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333130353935323b757365726e616d657c733a31303a2261646d696e3132333435223b),
('j6neddokfeiu2lij3rmojml3m5h62ms4', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039343333323b),
('jdcl8ot7s6f79hcke70ulla55fd0unlu', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039393338353b),
('k866edmct11h5kjo56kums83hkba9miu', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333130353034383b757365726e616d657c733a31303a2261646d696e3132333435223b),
('k8pl0b5js89dimr35eh95oq6fcdboa5q', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136353934343b),
('ke3i9k3eu7tuj6v1n6nc2e76uhnk0qhn', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039393334363b757365726e616d657c733a31303a2261646d696e3132333435223b),
('kgkt0c85lbk8e1ha2pdnmpj65f2r61u4', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323630303836393b),
('kr0phqjo5lh89k05rvrglbctjj5g4mft', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323934303236363b757365726e616d657c733a31303a2261646d696e3132333435223b),
('m4p28b8roe2cclvudaoioupesb1kaq4u', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333131353037363b757365726e616d657c733a31303a2261646d696e3132333435223b),
('mdjf384nu41mn314j53hah35ehq4g837', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323336363436323b),
('n5mo24f5t86jcp1v7a2k0rrqcrk4m1a0', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136313236353b757365726e616d657c733a31303a2261646d696e3132333435223b),
('nbko7n3dhgf5h10uu7a7hp94kfcdlibo', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323538393536393b),
('ntubcmtp3fjp0bbo1spuev9leu8smlsl', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039353935323b757365726e616d657c733a31303a2261646d696e3132333435223b),
('obha4vft5nfk7ojdcmt88j9ntfnumncj', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136353031383b757365726e616d657c733a31303a2261646d696e3132333435223b),
('p14qkahmjqncpruk0tpg8ipefvusgkik', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136303934323b757365726e616d657c733a31303a2261646d696e3132333435223b),
('pe7l2uheqn2d341q2cgcdpplqolghbbq', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039343937373b757365726e616d657c733a31303a2261646d696e3132333435223b),
('pjk322rgu0j0bs85ph9fepmcai18m45s', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039333938353b),
('pkhj4thqclkgkhn2cm9o2g53cal26bf3', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323934323032323b),
('pl4tfr6q6t00hv1p0mknrtiqdpo2nm17', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136323135323b757365726e616d657c733a31303a2261646d696e3132333435223b),
('pplgargr09b6kbc7e55mla4to1i9ej4k', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039333832373b757365726e616d657c733a31303a2261646d696e3132333435223b),
('pr1pc3h07a718da3vhjs25lubairv1np', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323934333436343b),
('pscq7nihkp5hgq15e4bf9f5k1qo35bl3', '::1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323935323233393b757365726e616d657c733a31303a2261646d696e3132333435223b),
('psnahcke8m076kc2vss7fhq4vuqbneon', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323934363332373b),
('q2p600ludo7u9o35vhm0l8k66a15qu6d', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323839323633333b),
('q6178fm3pgnk0uln002ugic6td38or2j', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333130333838383b757365726e616d657c733a31313a22617468656e613132333435223b),
('qsf7pfeu6f6qpjkij4cm55qfdaqaj262', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333130333537353b757365726e616d657c733a31313a22617468656e613132333435223b),
('r6ukff1ort8l62cpq0b7s1k3qe37s1at', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323933323034393b),
('rdc6vjv03sgnbggp146l5eq7vctnfj7j', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136313635333b757365726e616d657c733a31303a2261646d696e3132333435223b),
('rs6rqppl5n2vc664k074ijh2ql9en626', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333130323636313b757365726e616d657c733a31303a2261646d696e3132333435223b),
('s18nrucjsl7acmd8m6a163t78pajam5k', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333131353933323b757365726e616d657c733a31303a2261646d696e3132333435223b),
('sigj22l5rjtoa13e62c0rq8cuggnis3m', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039333834303b),
('u1ofj2aqfiik9fn7g1ql81igk9p062j9', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136313236353b757365726e616d657c733a31303a2261646d696e3132333435223b),
('u9pkb2d5980496pjhh3chfo3petcaiv5', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323933323032363b),
('utn5lps3r7fabuvb5f3ebs5o8g0k338o', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634323136333739333b757365726e616d657c733a31303a2261646d696e3132333435223b),
('vcojplunnorfmdk5f5fpt8vnkraeaumj', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039333834303b),
('vv9json5bpctaten3unani9pma621tur', '127.0.0.1', '0000-00-00 00:00:00', 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039383836343b757365726e616d657c733a31303a2261646d696e3132333435223b);

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
(17, '09:00:00', '18:00:00'),
(19, '09:00:00', '17:00:00');

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
  MODIFY `AttendanceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `BranchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `CommissionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
  MODIFY `EmployeeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=340;

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
  MODIFY `ScheduleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
