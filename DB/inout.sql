-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 01, 2019 at 12:38 PM
-- Server version: 5.7.25
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inout`
--

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
  `cc` varchar(100) NOT NULL DEFAULT '',
  `branch` varchar(100) NOT NULL DEFAULT '',
  `sort1` varchar(30) NOT NULL DEFAULT '',
  `sort2` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(30) NOT NULL DEFAULT '',
  `mob` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inout`
--
ALTER TABLE `inout`
  ADD PRIMARY KEY (`sl`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
