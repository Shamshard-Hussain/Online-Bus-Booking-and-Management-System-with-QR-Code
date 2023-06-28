-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 11, 2023 at 07:03 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beyazatop`
--
CREATE DATABASE IF NOT EXISTS `beyazatop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `beyazatop`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `UserID` int(10) NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`UserID`, `First_Name`, `Last_Name`, `Email`, `password`) VALUES
(1, 'sham', 'shard', 'Admin@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `bus_details`
--

DROP TABLE IF EXISTS `bus_details`;
CREATE TABLE IF NOT EXISTS `bus_details` (
  `Bus_id` int(11) NOT NULL AUTO_INCREMENT,
  `Owner_First_name` varchar(50) NOT NULL,
  `Owner_Last_name` varchar(50) NOT NULL,
  `Nic_number` varchar(50) NOT NULL,
  `Phone_Number` int(11) NOT NULL,
  `licences_Number` varchar(10) NOT NULL,
  `Permit_Number` varchar(50) NOT NULL,
  `Seats_Count` int(11) NOT NULL,
  PRIMARY KEY (`Bus_id`),
  KEY `licences_Number` (`licences_Number`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus_details`
--

INSERT INTO `bus_details` (`Bus_id`, `Owner_First_name`, `Owner_Last_name`, `Nic_number`, `Phone_Number`, `licences_Number`, `Permit_Number`, `Seats_Count`) VALUES
(22, 'akilshard', 'hussain', '123456712323v', 783355771, 'ND-5555', '5568990867', 40),
(23, 'Sachin', 'Kanishka', '20017734734', 787332345, 'ND-8833', '3829834645', 40),
(24, 'rukmal', 'perera', '20018343456453', 776492323, 'ND-9657', '7842358956', 40),
(34, 'sham', 'shard', '200105900227', 771181518, 'ND-4744', '167893423434', 40),
(42, 'sham', 'shard', '1234567', 771181518, 'ND-4745', '3434343', 40);

-- --------------------------------------------------------

--
-- Table structure for table `bus_shedules`
--

DROP TABLE IF EXISTS `bus_shedules`;
CREATE TABLE IF NOT EXISTS `bus_shedules` (
  `Shedules_id` int(11) NOT NULL AUTO_INCREMENT,
  `Bus_name` varchar(50) NOT NULL,
  `Bus_number` varchar(50) NOT NULL,
  `Stat_time` time NOT NULL,
  `End_time` time NOT NULL,
  `Starting_point` varchar(50) NOT NULL,
  `Final_destination` varchar(50) NOT NULL,
  `Seats_Count` int(50) NOT NULL,
  `Status` varchar(5) NOT NULL,
  PRIMARY KEY (`Shedules_id`),
  KEY `Bus_number` (`Bus_number`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus_shedules`
--

INSERT INTO `bus_shedules` (`Shedules_id`, `Bus_name`, `Bus_number`, `Stat_time`, `End_time`, `Starting_point`, `Final_destination`, `Seats_Count`, `Status`) VALUES
(8, 'Koobiyo', 'ND-4744', '16:00:00', '19:00:00', 'Makubura', 'Matara', 40, 'A'),
(9, 'Koobiyo', 'ND-4744', '12:30:00', '15:30:00', 'Matara', 'Makubura', 40, 'A'),
(10, 'Kumari', 'ND-5555', '15:00:00', '18:00:00', 'Makubura', 'Matara', 40, 'A'),
(11, 'supperSix', 'ND-8833', '15:00:00', '18:00:00', 'Matara', 'Makubura', 40, 'A'),
(12, 'supperSix', 'ND-8833', '18:30:00', '21:30:00', 'Makubura', 'Matara', 40, 'A'),
(13, 'supper', 'ND-8833', '22:00:00', '23:00:00', 'Makubura', 'Matara', 40, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `FId` int(10) NOT NULL AUTO_INCREMENT,
  `Passenger_Name` varchar(50) NOT NULL,
  `Passenger_Email` varchar(70) NOT NULL,
  `Passenger_Phone` varchar(15) DEFAULT NULL,
  `Inquries` text NOT NULL,
  `Inquries_from` varchar(10) NOT NULL,
  `Date-&-Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`FId`),
  KEY `Passenger_Email` (`Passenger_Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `nid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `UserID` int(10) NOT NULL,
  `Notifications` varchar(250) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `timedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nid`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

DROP TABLE IF EXISTS `passenger`;
CREATE TABLE IF NOT EXISTS `passenger` (
  `UserID` int(10) NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `password` varchar(250) NOT NULL,
  `Joined_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`UserID`),
  KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`UserID`, `First_Name`, `Last_Name`, `Email`, `Phone`, `password`, `Joined_on`) VALUES
(2, 'akilshard', 'hussain', 'akil@email.com', '0771181518', '25d55ad283aa400af464c76d713c07ad', '2022-11-21 15:24:37');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

DROP TABLE IF EXISTS `seat`;
CREATE TABLE IF NOT EXISTS `seat` (
  `Shedules_id` int(11) NOT NULL,
  `Bus_number` varchar(50) NOT NULL,
  `Name` varchar(15) NOT NULL,
  `Status` varchar(10) NOT NULL,
  KEY `Shedules_id` (`Shedules_id`),
  KEY `Name` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`Shedules_id`, `Bus_number`, `Name`, `Status`) VALUES
(13, 'ND-8833', 'Sn1', 'A'),
(13, 'ND-8833', 'Sn2', 'A'),
(13, 'ND-8833', 'Sn3', 'A'),
(13, 'ND-8833', 'Sn4', 'A'),
(13, 'ND-8833', 'Sn5', 'A'),
(13, 'ND-8833', 'Sn6', 'A'),
(13, 'ND-8833', 'Sn7', 'A'),
(13, 'ND-8833', 'Sn8', 'A'),
(13, 'ND-8833', 'Sn9', 'A'),
(13, 'ND-8833', 'Sn10', 'A'),
(13, 'ND-8833', 'Sn11', 'A'),
(13, 'ND-8833', 'Sn12', 'A'),
(13, 'ND-8833', 'Sn13', 'A'),
(13, 'ND-8833', 'Sn14', 'A'),
(13, 'ND-8833', 'Sn15', 'A'),
(13, 'ND-8833', 'Sn16', 'A'),
(13, 'ND-8833', 'Sn17', 'A'),
(13, 'ND-8833', 'Sn18', 'A'),
(13, 'ND-8833', 'Sn19', 'A'),
(13, 'ND-8833', 'Sn20', 'A'),
(13, 'ND-8833', 'Sn21', 'A'),
(13, 'ND-8833', 'Sn22', 'A'),
(13, 'ND-8833', 'Sn23', 'A'),
(13, 'ND-8833', 'Sn24', 'A'),
(13, 'ND-8833', 'Sn25', 'A'),
(13, 'ND-8833', 'Sn26', 'A'),
(13, 'ND-8833', 'Sn27', 'A'),
(13, 'ND-8833', 'Sn28', 'A'),
(13, 'ND-8833', 'Sn29', 'A'),
(13, 'ND-8833', 'Sn30', 'A'),
(13, 'ND-8833', 'Sn31', 'A'),
(13, 'ND-8833', 'Sn32', 'A'),
(13, 'ND-8833', 'Sn33', 'A'),
(13, 'ND-8833', 'Sn34', 'A'),
(13, 'ND-8833', 'Sn35', 'A'),
(13, 'ND-8833', 'Sn36', 'A'),
(13, 'ND-8833', 'Sn37', 'A'),
(13, 'ND-8833', 'Sn38', 'A'),
(13, 'ND-8833', 'Sn39', 'A'),
(13, 'ND-8833', 'Sn40', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `Tid` varchar(11) NOT NULL,
  `Passenger_Id` int(11) NOT NULL,
  `Issue_Date` varchar(11) NOT NULL,
  `Departure_Time` varchar(10) NOT NULL,
  `Route` varchar(50) NOT NULL,
  `Seat_id` varchar(7) NOT NULL,
  `Schedul_id` int(11) NOT NULL,
  `Bus_number` varchar(15) NOT NULL,
  `Qr_code` text NOT NULL,
  PRIMARY KEY (`Tid`),
  KEY `Passenger_Id` (`Passenger_Id`),
  KEY `Schedul_id` (`Schedul_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
