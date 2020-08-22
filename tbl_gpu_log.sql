-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Generation Time: Aug 22, 2020 at 05:55 AM
-- Server version: 5.6.48-88.0
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbname_here`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gpu_log`
--

-- Uncomment this part for creating database
-- CREATE DATABASE [dbname here]

USE [dbname_here];

CREATE TABLE `tbl_gpu_log` (
  `ID` bigint(20) NOT NULL,
  `vendor` varchar(8) NOT NULL DEFAULT '-',
  `device` varchar(8) NOT NULL DEFAULT '-',
  `manufacturer` varchar(128) NOT NULL DEFAULT '-',
  `hash` varchar(64) NOT NULL DEFAULT '-',
  `date_` date NOT NULL,
  `value_` int(11) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_gpu_log`
--
ALTER TABLE `tbl_gpu_log`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_gpu_log`
--
ALTER TABLE `tbl_gpu_log`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
