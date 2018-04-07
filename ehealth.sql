-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2018 at 08:25 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ehealth`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `aid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `date` date NOT NULL,
  `approval` int(11) NOT NULL DEFAULT '0',
  `approved_time` time DEFAULT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `did` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `hid` varchar(255) NOT NULL,
  `license` varchar(255) NOT NULL,
  `specialArea` text NOT NULL,
  `avail_from` time NOT NULL,
  `avail_till` time NOT NULL,
  `dapproved` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`did`, `uid`, `hid`, `license`, `specialArea`, `avail_from`, `avail_till`, `dapproved`) VALUES
(1, 7, 'ChIJi2YJ4-xN4DsRw_SeyfTB4-M', '', 'Heart Surgeon', '17:05:00', '21:06:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `dr_id` int(11) NOT NULL,
  `driving_license` varchar(255) NOT NULL,
  `vehicle_no` varchar(20) NOT NULL,
  `lat` double DEFAULT NULL,
  `lng` double NOT NULL,
  `uid` int(11) NOT NULL,
  `avail` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`dr_id`, `driving_license`, `vehicle_no`, `lat`, `lng`, `uid`, `avail`) VALUES
(3, '23123', '12312', 21.1648315, 72.786038, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `emergency`
--

CREATE TABLE `emergency` (
  `emer_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `dr_id` int(11) DEFAULT NULL,
  `elat` double NOT NULL,
  `elng` double NOT NULL,
  `approval` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emergency`
--

INSERT INTO `emergency` (`emer_id`, `uid`, `dr_id`, `elat`, `elng`, `approval`) VALUES
(37, 6, 3, 21.1648315, 72.786038, 1),
(38, 7, 3, 21.1648315, 72.786038, 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eid` int(11) NOT NULL,
  `ename` varchar(255) NOT NULL,
  `edescription` text NOT NULL,
  `edate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `h_id` varchar(255) NOT NULL,
  `hname` varchar(255) NOT NULL,
  `haddr` varchar(255) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `hmail` varchar(255) NOT NULL,
  `hpassword` varchar(255) NOT NULL,
  `hphone` varchar(13) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`h_id`, `hname`, `haddr`, `lat`, `lng`, `hmail`, `hpassword`, `hphone`, `hash`, `active`) VALUES
('ChIJi2YJ4-xN4DsRw_SeyfTB4-M', 'Dispensary', 'Sardar Vallabhbhai Engineering College Rd, Athwalines, Athwa, Surat, Gujarat 395007, India', 21.1633812, 72.7827198, 'naragonisairam@gmail.com', '55c1a3293fdc293048f489b63e6663ac', '8790361236', '9f61408e3afb633e50cdf1b20de6f466', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `nid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `ntype` varchar(255) NOT NULL,
  `notified_by` varchar(255) NOT NULL,
  `notify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notify_read` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `rid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `summary` text NOT NULL,
  `report` varchar(255) NOT NULL,
  `prescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `emer1` varchar(13) DEFAULT NULL,
  `emer2` varchar(13) DEFAULT NULL,
  `addr` text,
  `dob` date DEFAULT NULL,
  `avatar` varchar(255) NOT NULL,
  `aadhar` int(12) DEFAULT NULL,
  `hash` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `pincode` int(6) DEFAULT NULL,
  `bloodgroup` varchar(3) DEFAULT NULL,
  `medicalHis` text,
  `infoUpdated` int(11) NOT NULL DEFAULT '0',
  `user_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `emer1`, `emer2`, `addr`, `dob`, `avatar`, `aadhar`, `hash`, `active`, `pincode`, `bloodgroup`, `medicalHis`, `infoUpdated`, `user_type`) VALUES
(4, 'u15co025', 'jay.bhairaviya@gmail.com', '664a93755b5ce1cf54f99ae0f5ee7cf4', '8790361236', '8332977980', '8790361236', 'Enter Your Full Address', '2018-04-04', 'kaneki.jpg', 54, '0', 1, 515, 'B+', 'sdasdas', 1, 0),
(6, 'u15co093', 'naragonisairam@gmail.com', '9e35c7182b1b412bc1c5c0890843f71e', '8460393423', '7989776326', '8332977980', 'Enter Your Full Address', '2018-04-07', 'sai.jpg', 2313123, '0', 1, 545, 'B+', 'Enter Your Previous Medical history', 1, 1),
(7, 'u15co063', 'vatsavayi.sandeep@gmail.com', '6f2bbb6b510d9aece665cedefe6ad78f', '8332977980', '8790361236', '7989776326', 'H 29', '2018-04-07', 'sai.jpg', 2313123, '0', 1, 395007, 'A-', 'Nothing', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`dr_id`);

--
-- Indexes for table `emergency`
--
ALTER TABLE `emergency`
  ADD PRIMARY KEY (`emer_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`h_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `dr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `emergency`
--
ALTER TABLE `emergency`
  MODIFY `emer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
