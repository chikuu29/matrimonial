-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2023 at 07:40 PM
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
(14, 'PATRABIBAHA2827', 'snjsn  ndnd', 'test@gmail.com', 'f0fae8521e960af4007352314448dd77', '2023-06-09 01:54:17', NULL, NULL, '9583903645'),
(15, 'PATRABIBAHA8449', 'dd dd', 'chikuchiku3942@gmail.com', '098f6bcd4621d373cade4e832627b4f6', '2023-06-12 17:57:17', NULL, NULL, '1234567891');

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
-- Table structure for table `user_about`
--

CREATE TABLE `user_about` (
  `user_ID` varchar(100) NOT NULL,
  `user_about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_about`
--

INSERT INTO `user_about` (`user_ID`, `user_about`) VALUES
('PATRABIBAHA3890', 'What an About Us page is really for · Communicate the story of your business and why you started it. · Describe the customers or the cause that ..What an About Us page is really for · Communicate the story of your business and why you started it. · Describe the customers or the cause that ..What an About Us page is really for · Communicate the stssory of your business and why you started it. · Describe the customers or the cause that ..');

-- --------------------------------------------------------

--
-- Table structure for table `user_diet_hobbies`
--

CREATE TABLE `user_diet_hobbies` (
  `user_ID` varchar(100) NOT NULL,
  `user_drinking` varchar(50) DEFAULT NULL,
  `user_smoking` varchar(50) DEFAULT NULL,
  `user_diet` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_diet_hobbies`
--

INSERT INTO `user_diet_hobbies` (`user_ID`, `user_drinking`, `user_smoking`, `user_diet`) VALUES
('PATRABIBAHA3890', 'Yes', 'Yes', 'Vegetarian');

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
-- Table structure for table `user_family`
--

CREATE TABLE `user_family` (
  `user_ID` varchar(100) NOT NULL,
  `user_family_type` varchar(100) NOT NULL,
  `user_family_value` varchar(100) NOT NULL,
  `user_family_status` varchar(100) NOT NULL,
  `user_father_occupation` varchar(100) NOT NULL,
  `user_mothers_occupation` varchar(100) NOT NULL,
  `user_no_of_unmarried_brother` int(11) NOT NULL,
  `user_no_of_unmarried_sister` int(11) NOT NULL,
  `user_no_of_married_sister` int(11) NOT NULL,
  `user_no_of_married_brother` int(11) NOT NULL,
  `user_father_name` varchar(100) NOT NULL,
  `user_mother_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_family`
--

INSERT INTO `user_family` (`user_ID`, `user_family_type`, `user_family_value`, `user_family_status`, `user_father_occupation`, `user_mothers_occupation`, `user_no_of_unmarried_brother`, `user_no_of_unmarried_sister`, `user_no_of_married_sister`, `user_no_of_married_brother`, `user_father_name`, `user_mother_name`) VALUES
('PATRABIBAHA3890', 'joint', 'Traditional', 'middle class', 'farmer', 'house wife', 1, 2, 1, 1, 'Father', 'Mother');

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
  `user_profile_image` varchar(1000) DEFAULT NULL,
  `user_mother_toungh` varchar(20) DEFAULT '',
  `user_marital_status` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`Id`, `user_profileType`, `user_id`, `user_fname`, `user_lname`, `user_email`, `deleted`, `status`, `user_creation_date_time`, `updateon`, `completed`, `user_dob`, `user_gender`, `user_profile_image`, `user_mother_toungh`, `user_marital_status`) VALUES
(15, 'myself', 'PATRABIBAHA3890', 'SURYANARAYAN', 'BISWAL', 'cchiku1999@gmail.com', b'1', b'1', '2023-06-06 17:11:10', '2023-06-08 17:46:46', b'0', '1999-08-09', 'male', '01686677849.jpg', 'Odia', 'Single'),
(17, 'myself', 'PATRABIBAHA1489', 'Test', 'Demo', 'chikuchiku3942@gmail.com', b'1', b'1', '2023-06-09 01:44:31', NULL, b'0', '1999-8-9', 'male', NULL, '', ''),
(18, 'myself', 'PATRABIBAHA9477', 'njsdk', ',fdnf', 'demo@123', b'1', b'1', '2023-06-09 01:49:34', NULL, b'0', '1999-8-9', 'male', NULL, '', ''),
(19, 'myself', 'PATRABIBAHA5059', 'snjsn', ' ndnd', 'test@gmail.com', b'1', b'1', '2023-06-09 01:53:34', NULL, b'0', '1999-8-9', 'male', NULL, '', ''),
(20, 'myself', 'PATRABIBAHA2196', 'snjsn', ' ndnd', 'test@gmail.com', b'1', b'1', '2023-06-09 01:53:42', NULL, b'0', '1999-8-9', 'male', NULL, '', ''),
(21, 'myself', 'PATRABIBAHA2827', 'snjsn', ' ndnd', 'test@gmail.com', b'1', b'1', '2023-06-09 01:54:17', NULL, b'0', '2023-13-06', 'male', NULL, 'Assamese', 'Single'),
(22, 'myself', 'PATRABIBAHA8449', 'dd', 'dd', 'chikuchiku3942@gmail.com', b'1', b'1', '2023-06-12 17:57:17', NULL, b'0', '1999-10-9', 'male', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_locations`
--

CREATE TABLE `user_locations` (
  `user_ID` varchar(100) NOT NULL,
  `user_country` varchar(30) NOT NULL,
  `user_state` varchar(30) NOT NULL,
  `user_city` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_locations`
--

INSERT INTO `user_locations` (`user_ID`, `user_country`, `user_state`, `user_city`) VALUES
('PATRABIBAHA3890', 'India', 'Odisha', 'Puri');

-- --------------------------------------------------------

--
-- Table structure for table `user_physical_details`
--

CREATE TABLE `user_physical_details` (
  `user_ID` varchar(100) NOT NULL,
  `user_height` varchar(100) DEFAULT NULL,
  `user_weight` varchar(100) DEFAULT NULL,
  `user_body_type` varchar(100) DEFAULT NULL,
  `user_complextion` varchar(100) DEFAULT NULL,
  `user_physical_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_physical_details`
--

INSERT INTO `user_physical_details` (`user_ID`, `user_height`, `user_weight`, `user_body_type`, `user_complextion`, `user_physical_status`) VALUES
('PATRABIBAHA3890', 'Below 4ft 6in - 137cm', '50', 'Slim', 'Wheatish', 'Normal');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile_images`
--

CREATE TABLE `user_profile_images` (
  `id` int(11) NOT NULL,
  `user_ID` varchar(45) DEFAULT NULL,
  `user_feature_images` varchar(1000) DEFAULT NULL,
  `user_profile_images` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profile_images`
--

INSERT INTO `user_profile_images` (`id`, `user_ID`, `user_feature_images`, `user_profile_images`) VALUES
(2, 'PATRABIBAHA3890', '01686676154.jpg', '01686676154.jpg'),
(3, 'PATRABIBAHA3890', '01686676875.jpg', '01686676875.jpg'),
(4, 'PATRABIBAHA3890', '01686677177.jpg', '01686677177.jpg'),
(5, 'PATRABIBAHA3890', '01686677236.jpg', '01686677236.jpg'),
(6, 'PATRABIBAHA3890', '01686677254.jpg', '01686677254.jpg'),
(7, 'PATRABIBAHA3890', '01686677502.jpg', '01686677502.jpg'),
(8, 'PATRABIBAHA3890', '01686677849.jpg', '01686677849.jpg');

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
('PATRABIBAHA3890', 'Hinduism', 'Hinduism', 'Hinduism');

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
-- Indexes for table `user_about`
--
ALTER TABLE `user_about`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `user_diet_hobbies`
--
ALTER TABLE `user_diet_hobbies`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `user_education_occupations`
--
ALTER TABLE `user_education_occupations`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `user_family`
--
ALTER TABLE `user_family`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user_locations`
--
ALTER TABLE `user_locations`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `user_physical_details`
--
ALTER TABLE `user_physical_details`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `user_profile_images`
--
ALTER TABLE `user_profile_images`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_profile_images`
--
ALTER TABLE `user_profile_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
