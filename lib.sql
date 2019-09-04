-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 16, 2018 at 04:23 PM
-- Server version: 5.5.42
-- PHP Version: 5.5.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lib`
--
CREATE DATABASE IF NOT EXISTS `lib` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lib`;

-- --------------------------------------------------------

--
-- Table structure for table `inout`
--

CREATE TABLE `inout` (
  `sl` int(50) NOT NULL,
  `cardnumber` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `entry` time NOT NULL,
  `exit` time NOT NULL DEFAULT '00:00:00',
  `status` varchar(10) NOT NULL,
  `loc` varchar(30) NOT NULL DEFAULT '',
  `cc` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loc`
--

CREATE TABLE `loc` (
  `id` int(11) NOT NULL,
  `loc` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `user` varchar(10) NOT NULL,
  `pass` varchar(60) NOT NULL,
  `post` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`user`, `pass`, `post`) VALUES
('admin', 'library', 'admin'),
('user', '123456', 'user'),
('master', 'superuser', 'superuser');

-- --------------------------------------------------------

--
-- Table structure for table `setup`
--

CREATE TABLE `setup` (
  `var` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setup`
--

INSERT INTO `setup` (`var`, `value`) VALUES
('cname', 'KLE Dr. M. S. Sheshgiri College of Engineering & Technology, Belagavi.'),
('cc', 'S'),
('libtime', '22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tmp1`
--

CREATE TABLE `tmp1` (
  `date` date NOT NULL,
  `secs` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmp2`
--

CREATE TABLE `tmp2` (
  `usn` varchar(30) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inout`
--
ALTER TABLE `inout`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `loc`
--
ALTER TABLE `loc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inout`
--
ALTER TABLE `inout`
  MODIFY `sl` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `loc`
--
ALTER TABLE `loc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
