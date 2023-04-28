-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2023 at 09:11 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `att_id` int(255) NOT NULL,
  `std_id` int(255) NOT NULL,
  `cls_id` int(255) NOT NULL,
  `sec_id` int(255) NOT NULL,
  `t_id` int(255) NOT NULL,
  `status_check` int(2) NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`att_id`, `std_id`, `cls_id`, `sec_id`, `t_id`, `status_check`, `date_updated`) VALUES
(1, 21, 1, 2, 1, 1, '2023-04-04'),
(2, 21, 1, 2, 1, 1, '2023-04-04'),
(3, 21, 1, 2, 0, 1, '2023-04-05'),
(4, 21, 1, 2, 1, 1, '2023-04-05'),
(8, 23, 1, 1, 1, 1, '2023-04-06'),
(9, 22, 1, 1, 1, 1, '2023-04-06'),
(10, 22, 1, 1, 1, 1, '2023-04-06'),
(11, 23, 1, 1, 1, 1, '2023-04-06'),
(12, 22, 1, 1, 1, 0, '2023-04-06'),
(13, 22, 1, 1, 1, 0, '2023-04-06'),
(14, 23, 1, 1, 1, 0, '2023-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `cls_id` int(255) NOT NULL,
  `cls_name` varchar(255) NOT NULL,
  `is_deleted` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`cls_id`, `cls_name`, `is_deleted`) VALUES
(1, '1', 0),
(2, 'Seven', 1),
(3, '7', 0),
(4, '5', 0),
(5, '2', 0),
(6, '3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `sec_id` int(255) NOT NULL,
  `cls_id` varchar(255) NOT NULL,
  `sec_name` varchar(255) NOT NULL,
  `is_assigned` int(2) NOT NULL,
  `is_deleted` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sec_id`, `cls_id`, `sec_name`, `is_assigned`, `is_deleted`) VALUES
(1, '1', 'A', 0, 0),
(2, '1', 'B', 1, 0),
(3, '3', 'Q', 0, 0),
(4, '3', 'C', 0, 0),
(5, '1', 'C', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `reg_no` int(11) NOT NULL,
  `std_name` varchar(255) NOT NULL,
  `std_address` varchar(255) NOT NULL,
  `std_phone` varchar(10) NOT NULL,
  `std_uname` varchar(255) NOT NULL,
  `sec_id` int(255) NOT NULL,
  `std_pass` varchar(8) NOT NULL,
  `reg_date` datetime NOT NULL,
  `is_deleted` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`reg_no`, `std_name`, `std_address`, `std_phone`, `std_uname`, `sec_id`, `std_pass`, `reg_date`, `is_deleted`) VALUES
(21, 'Tharushi', 'Thawalama gg', '0712997562', 'tharu@gmail.com', 2, '12', '2023-03-29 13:50:17', 0),
(22, 'Thilini Maheshika', 'Thawalama', '0776892356', 'thili', 1, '1212', '2023-04-02 13:13:24', 0),
(23, 'kanishka', 'Galle', '0713664071', 'kaniya', 1, '123', '2023-04-05 22:31:15', 1),
(24, 'Kanishka', 'Galle', '0713664071', 'dew', 1, '12345', '2023-04-07 22:17:47', 0),
(25, 'Dew Sadu', 'galle', '0713664071', 'sadu', 2, '123', '2023-04-10 23:51:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `ad_id` int(11) NOT NULL,
  `ad_email` varchar(255) NOT NULL,
  `ad_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`ad_id`, `ad_email`, `ad_pass`) VALUES
(1, 'admin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `t_id` int(255) NOT NULL,
  `t_name` varchar(255) NOT NULL,
  `t_email` varchar(255) NOT NULL,
  `t_address` varchar(255) NOT NULL,
  `t_phone` varchar(10) NOT NULL,
  `sec_id` int(255) NOT NULL,
  `t_pass` varchar(255) NOT NULL,
  `date_updated` datetime NOT NULL,
  `is_deleted` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`t_id`, `t_name`, `t_email`, `t_address`, `t_phone`, `sec_id`, `t_pass`, `date_updated`, `is_deleted`) VALUES
(1, 'Thilini', 'me123@gmail.com', 'Thawalama', '0712237561', 2, '123', '2023-04-01 22:09:51', 0),
(2, 'kanishka ', 'kanishkadewsandaruwan@gmail.com', 'Neluwa', '0713664071', 1, '22', '2023-04-01 23:41:19', 1),
(3, 'kanishka', 'kanishkadewsandaruwan@gmail.com', 'Galle', '0713664071', 1, '123', '2023-04-02 00:53:38', 1),
(4, 'Tharushi', 'tharu1234@gmail.com', 'Thawalama', '0712997562', 1, '12', '2023-04-02 00:58:32', 1),
(5, 'Tharushi', 'tharu1234@gmail.com', 'Galle', '0712237562', 4, '123', '2023-04-02 01:00:00', 0),
(6, 'ab', 'ab@gmail.com', 'Galle', '0742356782', 2, '12', '2023-04-02 01:12:35', 1),
(8, 'Dew', 'dew@gmail.com', 'gakke', '0713664071', 2, '123', '2023-04-10 23:50:53', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`att_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`cls_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`sec_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`reg_no`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `att_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `cls_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `sec_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `reg_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `t_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
