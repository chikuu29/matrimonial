-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2023 at 11:21 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matrimonial`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `UserId` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `name`, `UserId`, `Password`) VALUES
(1, 'Suryanarayan Biswal', 'chiku', 'chiku');

-- --------------------------------------------------------

--
-- Table structure for table `auth_user`
--

CREATE TABLE `auth_user` (
  `id` int(11) NOT NULL,
  `auth_ID` varchar(45) DEFAULT NULL,
  `auth_name` varchar(45) DEFAULT '',
  `auth_email` varchar(45) DEFAULT NULL,
  `auth_password` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `account_status` varchar(45) DEFAULT NULL,
  `acount_type` varchar(45) DEFAULT NULL,
  `auth_phone_no` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_user`
--

INSERT INTO `auth_user` (`id`, `auth_ID`, `auth_name`, `auth_email`, `auth_password`, `created_date`, `account_status`, `acount_type`, `auth_phone_no`) VALUES
(11, 'PATRABIBAHA3890', 'SURYANARAYAN BISWAL', 'cchiku1999@gmail.com', 'f0fae8521e960af4007352314448dd77', '2023-06-06 17:11:10', NULL, NULL, '8327783629'),
(12, 'PATRABIBAHA1489', 'Test Demo', 'chikuchiku3942@gmail.com', 'f0fae8521e960af4007352314448dd77', '2023-06-09 01:44:31', NULL, NULL, '8327783629'),
(13, 'PATRABIBAHA9477', 'njsdk ,fdnf', 'demo@123', 'f0fae8521e960af4007352314448dd77', '2023-06-09 01:49:34', NULL, NULL, '8327783629'),
(14, 'PATRABIBAHA2827', 'snjsn  ndnd', 'test@gmail.com', 'f0fae8521e960af4007352314448dd77', '2023-06-09 01:54:17', NULL, NULL, '9583903645');

-- --------------------------------------------------------

--
-- Table structure for table `cast_table`
--

CREATE TABLE `cast_table` (
  `Id` int(11) NOT NULL,
  `cast_name` varchar(45) DEFAULT NULL,
  `status` bit(1) DEFAULT b'0',
  `deleted` bit(1) DEFAULT b'1',
  `createdon` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country_table`
--

CREATE TABLE `country_table` (
  `Id` int(11) NOT NULL,
  `country_name` varchar(45) DEFAULT NULL,
  `deleted` bit(1) DEFAULT b'1',
  `status` bit(1) DEFAULT b'0',
  `createdon` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country_table`
--

INSERT INTO `country_table` (`Id`, `country_name`, `deleted`, `status`, `createdon`) VALUES
(1, '', b'1', b'0', NULL),
(2, 'INDIA', b'1', b'0', NULL),
(3, '', b'1', b'0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `social_media_links`
--

CREATE TABLE `social_media_links` (
  `id` int(11) NOT NULL,
  `facebook_link` varchar(100) DEFAULT NULL,
  `whatsapp_no` varchar(45) DEFAULT NULL,
  `twitter_link` varchar(100) DEFAULT NULL,
  `linkedin_link` varchar(100) DEFAULT NULL,
  `youtub_link` varchar(100) DEFAULT NULL,
  `updatedon` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `state_table`
--

CREATE TABLE `state_table` (
  `Id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_name` varchar(45) DEFAULT NULL,
  `status` bit(1) DEFAULT b'0',
  `deleted` bit(1) DEFAULT b'1',
  `createdon` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_cast`
--

CREATE TABLE `sub_cast` (
  `Id` int(11) NOT NULL,
  `sub_cast_name` varchar(45) DEFAULT NULL,
  `cast_Id` int(11) DEFAULT NULL,
  `deleted` bit(1) DEFAULT b'1',
  `status` bit(1) DEFAULT b'0',
  `createdon` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_education_occupations`
--

CREATE TABLE `user_education_occupations` (
  `user_ID` varchar(100) NOT NULL,
  `user_highest_education` varchar(100) NOT NULL,
  `user_additional_education` varchar(100) NOT NULL,
  `user_anual_income` int(11) NOT NULL,
  `user_employed_In` varchar(100) NOT NULL,
  `user_occupation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_education_occupations`
--

INSERT INTO `user_education_occupations` (`user_ID`, `user_highest_education`, `user_additional_education`, `user_anual_income`, `user_employed_In`, `user_occupation`) VALUES
('PATRABIBAHA3890', 'Bachelor of Technology (B.Tech)', 'Bachelor of Technology (B.Tech)', 600000, 'Private', 'Software Engineer');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `Id` int(11) NOT NULL,
  `user_profileType` varchar(30) DEFAULT 'myself',
  `user_id` varchar(45) DEFAULT NULL,
  `user_fname` varchar(45) DEFAULT NULL,
  `user_lname` varchar(50) DEFAULT NULL,
  `user_email` varchar(45) DEFAULT NULL,
  `deleted` bit(1) DEFAULT b'0',
  `status` bit(1) DEFAULT b'0',
  `user_creation_date_time` timestamp NULL DEFAULT current_timestamp(),
  `updateon` timestamp NULL DEFAULT NULL,
  `completed` bit(1) DEFAULT b'0',
  `user_dob` varchar(100) DEFAULT NULL,
  `user_gender` varchar(45) DEFAULT NULL,
  `user_profile_image` varchar(50) DEFAULT NULL,
  `user_mother_toungh` varchar(20) DEFAULT '',
  `user_marital_status` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`Id`, `user_profileType`, `user_id`, `user_fname`, `user_lname`, `user_email`, `deleted`, `status`, `user_creation_date_time`, `updateon`, `completed`, `user_dob`, `user_gender`, `user_profile_image`, `user_mother_toungh`, `user_marital_status`) VALUES
(15, 'myself', 'PATRABIBAHA3890', 'SURYANARAYAN', 'BISWAL', 'cchiku1999@gmail.com', b'1', b'1', '2023-06-06 17:11:10', '2023-06-08 17:46:46', b'0', '1999-08-09', 'male', NULL, 'Odia', 'Single'),
(17, 'myself', 'PATRABIBAHA1489', 'Test', 'Demo', 'chikuchiku3942@gmail.com', b'1', b'1', '2023-06-09 01:44:31', NULL, b'0', '1999-8-9', 'male', NULL, '', ''),
(18, 'myself', 'PATRABIBAHA9477', 'njsdk', ',fdnf', 'demo@123', b'1', b'1', '2023-06-09 01:49:34', NULL, b'0', '1999-8-9', 'male', NULL, '', ''),
(19, 'myself', 'PATRABIBAHA5059', 'snjsn', ' ndnd', 'test@gmail.com', b'1', b'1', '2023-06-09 01:53:34', NULL, b'0', '1999-8-9', 'male', NULL, '', ''),
(20, 'myself', 'PATRABIBAHA2196', 'snjsn', ' ndnd', 'test@gmail.com', b'1', b'1', '2023-06-09 01:53:42', NULL, b'0', '1999-8-9', 'male', NULL, '', ''),
(21, 'myself', 'PATRABIBAHA2827', 'snjsn', ' ndnd', 'test@gmail.com', b'1', b'1', '2023-06-09 01:54:17', NULL, b'0', '2023-13-06', 'male', NULL, 'Assamese', 'Single');

-- --------------------------------------------------------

--
-- Table structure for table `user_religion`
--

CREATE TABLE `user_religion` (
  `user_ID` varchar(100) NOT NULL,
  `user_religion` varchar(50) DEFAULT NULL,
  `user_caste` varchar(50) DEFAULT NULL,
  `user_subcaste` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_religion`
--

INSERT INTO `user_religion` (`user_ID`, `user_religion`, `user_caste`, `user_subcaste`) VALUES
('PATRABIBAHA3890', 'Hinduism', 'Hinduism', 'Islam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `auth_user`
--
ALTER TABLE `auth_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cast_table`
--
ALTER TABLE `cast_table`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `country_table`
--
ALTER TABLE `country_table`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `social_media_links`
--
ALTER TABLE `social_media_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_table`
--
ALTER TABLE `state_table`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `sub_cast`
--
ALTER TABLE `sub_cast`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user_education_occupations`
--
ALTER TABLE `user_education_occupations`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user_religion`
--
ALTER TABLE `user_religion`
  ADD PRIMARY KEY (`user_ID`),
  ADD UNIQUE KEY `user_ID` (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_user`
--
ALTER TABLE `auth_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cast_table`
--
ALTER TABLE `cast_table`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country_table`
--
ALTER TABLE `country_table`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `social_media_links`
--
ALTER TABLE `social_media_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `state_table`
--
ALTER TABLE `state_table`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_cast`
--
ALTER TABLE `sub_cast`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
