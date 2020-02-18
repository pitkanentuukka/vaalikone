-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 18, 2020 at 10:49 PM
-- Server version: 10.1.41-MariaDB-0+deb9u1
-- PHP Version: 7.0.33-0+deb9u6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaalikone_proto`
--

-- --------------------------------------------------------

--
-- Table structure for table `ehdokas`
--

CREATE TABLE `ehdokas` (
  `id` int(11) NOT NULL,
  `puolue` int(11) NOT NULL,
  `vaalipiiri` int(11) NOT NULL,
  `nimi` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kysymys`
--

CREATE TABLE `kysymys` (
  `id` int(11) NOT NULL,
  `kysymys` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `puolue`
--

CREATE TABLE `puolue` (
  `id` int(11) NOT NULL,
  `puolue` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vaalipiiri`
--

CREATE TABLE `vaalipiiri` (
  `id` int(11) NOT NULL,
  `vaalipiiri` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vastaus`
--

CREATE TABLE `vastaus` (
  `kysymysid` int(11) NOT NULL,
  `ehdokasid` int(11) NOT NULL,
  `vastaus` int(11) NOT NULL,
  `teksti` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ehdokas`
--
ALTER TABLE `ehdokas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`),
  ADD KEY `puolue` (`puolue`),
  ADD KEY `vaalipiiri` (`vaalipiiri`);

--
-- Indexes for table `kysymys`
--
ALTER TABLE `kysymys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `puolue`
--
ALTER TABLE `puolue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaalipiiri`
--
ALTER TABLE `vaalipiiri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vastaus`
--
ALTER TABLE `vastaus`
  ADD PRIMARY KEY (`ehdokasid`,`kysymysid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ehdokas`
--
ALTER TABLE `ehdokas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `kysymys`
--
ALTER TABLE `kysymys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `puolue`
--
ALTER TABLE `puolue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vaalipiiri`
--
ALTER TABLE `vaalipiiri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ehdokas`
--
ALTER TABLE `ehdokas`
  ADD CONSTRAINT `ehdokas_ibfk_1` FOREIGN KEY (`puolue`) REFERENCES `puolue` (`id`),
  ADD CONSTRAINT `ehdokas_ibfk_2` FOREIGN KEY (`vaalipiiri`) REFERENCES `vaalipiiri` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
