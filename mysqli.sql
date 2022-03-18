-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2022 at 07:48 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysqli`
--

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `MaDH` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Ngaydat` date NOT NULL,
  `Tongtien` int(11) NOT NULL,
  `Makhach` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Dienthoai` char(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Diachi` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donhangct`
--

CREATE TABLE `donhangct` (
  `MaDH` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Mahang` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Dongia` int(11) NOT NULL,
  `Soluong` int(11) NOT NULL,
  `Thanhtien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hanghoa`
--

CREATE TABLE `hanghoa` (
  `Mahang` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Tenhang` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Dongia` int(11) NOT NULL,
  `Soluong` int(11) NOT NULL,
  `DVT` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Anh` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hanghoa`
--

INSERT INTO `hanghoa` (`Mahang`, `Tenhang`, `Dongia`, `Soluong`, `DVT`, `Anh`) VALUES
('4', 'sữa chua', 15000, 15, 'hộp', 'anhchinhsua.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`MaDH`);

--
-- Indexes for table `donhangct`
--
ALTER TABLE `donhangct`
  ADD PRIMARY KEY (`MaDH`,`Mahang`),
  ADD KEY `Mahang` (`Mahang`);

--
-- Indexes for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`Mahang`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donhangct`
--
ALTER TABLE `donhangct`
  ADD CONSTRAINT `donhangct_ibfk_1` FOREIGN KEY (`Mahang`) REFERENCES `hanghoa` (`Mahang`),
  ADD CONSTRAINT `donhangct_ibfk_2` FOREIGN KEY (`MaDH`) REFERENCES `donhang` (`MaDH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
