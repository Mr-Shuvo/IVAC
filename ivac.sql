-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2018 at 03:21 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ivac`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `Mission` varchar(255) NOT NULL,
  `BGD` varchar(12) NOT NULL,
  `Passport` varchar(255) NOT NULL,
  `Given_name` varchar(255) NOT NULL,
  `Birth_place` varchar(255) NOT NULL,
  `Father_name` varchar(255) NOT NULL,
  `Mother_name` varchar(255) NOT NULL,
  `OTP` varchar(6) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `File_number` int(11) NOT NULL,
  `Submit_time` varchar(255) NOT NULL,
  `User_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `Mission`, `BGD`, `Passport`, `Given_name`, `Birth_place`, `Father_name`, `Mother_name`, `OTP`, `Status`, `File_number`, `Submit_time`, `User_name`) VALUES
(38, 'MOTIJHEEL', 'BGDDV0B31218', 'BN0821014', 'MD ROKNUZZAMAN', 'RAJBARI', 'MD MORTUZA REZA', 'ROKHSANA MOMTAZ', 'OTPGET', 'DONE', 2, '15-01-2018', 'PAKKNA'),
(40, 'UTTARA', 'BGDDV9A31218', 'BN0821534', 'MD ROKNUZZAMAN', 'RAJBARI', 'MD MORTUZA REZA', 'ROKHSANA MOMTAZ', 'OTPDNE', 'DONE', 3, '14-01-2018', 'PAKKNA'),
(43, 'KHULNA', 'BGDDV03N1218', 'BN0821002', 'MD ROKNUZZAMAN', 'RAJBARI', 'MD MORTUZA REZA', 'ROKHSANA MOMTAZ', 'ASDERT', 'PENDING', 1, '15-01-2018', 'ANIK'),
(50, 'SYLHET', 'BGDDV8A31218', 'BN0821634', 'MD ROKNUZZAMAN', 'MAGURA', 'MD MORTUZA KAKA', 'MM COMPUTER', '', 'DONE', 3, '15-01-2018', 'ANIK'),
(52, 'GULSHAN', 'BGDDV0B31918', 'BN0821012', 'MOMIN SOAA', 'MAGURA', 'MD MORTUZA REZA', 'ROKHSANA MOMTAZ', '', 'PENDING', 1, '25-03-2018', 'PAKKNA'),
(53, 'GULSHAN', 'BGDDV0B31818', 'BN0821034', 'MD ROKNUZZAMAN', 'MAGURA', 'BIMOL CHANDO BHATTACHARJEE', 'MM COMPUTEP', '', 'PENDING', 3, '25-03-2018', 'PAKKNA'),
(54, 'GULSHAN', 'BGDDZ0B31218', 'BN0821224', 'MD ROKNUZZAMAN', 'RAJSHAHI', 'BIMOL CHANDO BHATTACHARJEE', 'ROKHSANA MOMTAZ', '', 'PENDING', 2, '25-03-2018', 'PAKKNA');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `Full_name` varchar(255) NOT NULL,
  `User_name` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Mobile` int(11) NOT NULL,
  `File_amount` int(11) NOT NULL,
  `User_type` varchar(255) NOT NULL,
  `Reffer_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `Full_name`, `User_name`, `Password`, `Mobile`, `File_amount`, `User_type`, `Reffer_email`) VALUES
(3, 'ANIK VUME', 'ANIK', 'bb4ce93379310ec5a4aa249d3c3549f8', 1861794130, 5, 'USER', 'pakkna@gmail.com'),
(1, 'Pakkna MK', 'PAKKNA', '7d4ab5a385724ad27283331a39c28dd9', 1624389711, 0, 'USER', 'pakkna@gmail.com'),
(4, 'SHIBLU', 'SHIBLU', '550a487bb18e5b3f2451bdd5d8456ea5', 1623443534, 5, 'USER', 'pakkna@gmail.com'),
(2, 'SHUVO MUKHERJEE', 'SHUVO', '54b72f1850ef19b35ab85de6ad0d83f5', 1624380711, 10, 'ADMIN', 'Shuvo@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `BGD` (`BGD`),
  ADD KEY `User_name` (`User_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `User_name` (`User_name`),
  ADD UNIQUE KEY `Mobile` (`Mobile`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `User_name_2` (`User_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
