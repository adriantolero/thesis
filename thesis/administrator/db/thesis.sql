-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2019 at 06:52 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thesis`
--

-- --------------------------------------------------------

--
-- Table structure for table `ameneties`
--

CREATE TABLE IF NOT EXISTS `ameneties` (
  `i_aid` int(11) NOT NULL,
  `str_description` varchar(100) DEFAULT NULL,
  `f_rate` float DEFAULT NULL,
  `enum_amen_category` enum('VSU','Non-VSU') DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ameneties`
--

INSERT INTO `ameneties` (`i_aid`, `str_description`, `f_rate`, `enum_amen_category`) VALUES
(13, 'Soundsystem', 1000, NULL),
(14, 'Electricity', 480, NULL),
(15, 'Soundsystem', 500, NULL),
(16, 'LCD', 300, NULL),
(17, 'LCD', 1000, NULL),
(20, 'LCD', 300, NULL),
(21, 'LCD', 300, NULL),
(22, 'LCD', 300, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE IF NOT EXISTS `billing` (
  `i_bid` int(11) NOT NULL,
  `i_fr_id` int(11) DEFAULT NULL,
  `i_pid` int(11) DEFAULT NULL,
  `i_b_ORnum` int(11) DEFAULT NULL,
  `f_amount` float DEFAULT NULL,
  `i_bill_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`i_bid`, `i_fr_id`, `i_pid`, `i_b_ORnum`, `f_amount`, `i_bill_status`) VALUES
(8, 61, 2, NULL, 1960, 0),
(9, 59, 7, NULL, 250, 0),
(12, 63, 4, 123345, 2650, 1),
(13, 72, 10, NULL, 2800, 0),
(14, 71, 7, NULL, 300, 0),
(15, 70, 7, NULL, 250, 0),
(16, 69, 10, NULL, 1450, 0),
(17, 68, 8, NULL, 1410, 0),
(18, 67, 2, NULL, 1090, 0),
(19, 66, 6, NULL, 1300, 0),
(20, 65, 12, NULL, 2600, 0),
(21, 73, 12, 131234, 3875, 1),
(22, 80, 12, NULL, 900, 0),
(23, 82, 8, NULL, 1410, 0),
(24, 85, 1, 495282, 350, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bill_ameneties`
--

CREATE TABLE IF NOT EXISTS `bill_ameneties` (
  `i_baid` int(11) NOT NULL,
  `i_fr_id` int(11) NOT NULL DEFAULT '0',
  `i_aid` int(11) NOT NULL DEFAULT '0',
  `f_amount` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_ameneties`
--

INSERT INTO `bill_ameneties` (`i_baid`, `i_fr_id`, `i_aid`, `f_amount`) VALUES
(13, 72, 13, 1000),
(14, 71, 14, 480),
(15, 70, 15, 500),
(16, 68, 16, 300),
(17, 73, 17, 1000),
(20, 80, 20, 300),
(21, 82, 21, 300),
(22, 85, 22, 300);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `i_course_id` int(11) NOT NULL,
  `course` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`i_course_id`, `course`) VALUES
(45, 'BEED'),
(46, 'BSED'),
(61, 'BSDC'),
(62, 'BSA'),
(63, 'BSCS'),
(65, 'BSIT');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `i_emp_id` int(11) NOT NULL,
  `str_username` varchar(50) DEFAULT NULL,
  `str_pass` varchar(50) DEFAULT NULL,
  `str_e_lname` varchar(20) DEFAULT NULL,
  `str_e_fname` varchar(20) DEFAULT NULL,
  `str_e_MI` varchar(2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`i_emp_id`, `str_username`, `str_pass`, `str_e_lname`, `str_e_fname`, `str_e_MI`) VALUES
(6, 'admin', 'admin', 'Tolero', 'Adrian', 'C.'),
(8, 'hahahaha', 'tolero', 'Tolero', 'Adrian', 'C.');

-- --------------------------------------------------------

--
-- Table structure for table `function_reservation`
--

CREATE TABLE IF NOT EXISTS `function_reservation` (
  `i_fr_id` int(11) NOT NULL,
  `i_rm_id` int(11) DEFAULT NULL,
  `str_agency` varchar(100) DEFAULT NULL,
  `str_agency_add` varchar(100) DEFAULT NULL,
  `dt_arrival` datetime DEFAULT NULL,
  `dt_departure` datetime DEFAULT NULL,
  `dt_checkin` datetime DEFAULT NULL,
  `dt_checkout` datetime DEFAULT NULL,
  `str_nature` varchar(50) DEFAULT NULL,
  `str_title` varchar(100) DEFAULT NULL,
  `i_no_participants` int(11) DEFAULT NULL,
  `str_requisitioner` varchar(100) DEFAULT NULL,
  `str_address` varchar(100) DEFAULT NULL,
  `str_mobile_no` varchar(30) DEFAULT NULL,
  `str_email` varchar(50) DEFAULT NULL,
  `dt_requested` datetime DEFAULT NULL,
  `i_fr_status` int(11) DEFAULT NULL,
  `i_emp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `function_reservation`
--

INSERT INTO `function_reservation` (`i_fr_id`, `i_rm_id`, `str_agency`, `str_agency_add`, `dt_arrival`, `dt_departure`, `dt_checkin`, `dt_checkout`, `str_nature`, `str_title`, `i_no_participants`, `str_requisitioner`, `str_address`, `str_mobile_no`, `str_email`, `dt_requested`, `i_fr_status`, `i_emp_id`) VALUES
(55, 2, 'COE', 'Visayas State University', '2018-05-08 08:00:00', '2018-05-08 16:00:00', NULL, NULL, 'Meeting', 'COE Meeting', 90, 'Adrian Tolero', 'Albuera, Leyte', '09952946757', 'ianix09@yahoo.com', '2018-05-12 11:09:22', 0, NULL),
(58, 1, 'College of Engineering', 'Visayas State University', '2018-05-12 08:00:00', '2018-05-12 17:00:00', NULL, NULL, 'Meeting', 'COE Meeting', 50, 'Adrian Tolero', 'Albuera, Leyte', '09952946757', '', '2018-05-11 22:03:23', 0, NULL),
(59, 1, 'College of Veterinary Medicine', 'Visayas State University', '2018-05-14 08:00:00', '2018-05-14 17:00:00', '2018-05-14 10:21:53', '2018-05-14 15:30:00', 'Meeting', 'CVM Meeting', 50, 'Adrian Tolero', 'Albuera, Leyte', '09952946757', 'ianix09@yahoo.com', '2018-05-14 22:07:17', 5, 6),
(61, 2, 'College of Engineering', 'Visayas State University', '2018-05-14 08:00:00', '2018-05-14 17:00:00', '2018-05-14 10:17:33', '2018-05-14 16:30:00', 'Meeting', 'COE Meeting', 59, 'Adrian Tolero', 'Albuera, Leyte', '09952946757', 'adrian.tolero@yahoo.com', NULL, 5, 6),
(63, 2, 'College of Engineering', 'Visayas State University', '2018-05-17 08:00:00', '2018-05-17 14:00:00', '2018-05-17 10:17:21', '2018-05-17 21:41:23', 'Meeting', 'COE Meeting', 90, 'Alfon Tolero', 'Albuera, Leyte', '09952946757', 'ianix09@yahoo.com', '2018-05-17 10:15:03', 5, 6),
(65, 1, '', '', '2016-10-03 09:00:00', '2016-10-03 14:00:00', '2016-10-03 09:00:00', '2016-10-03 14:00:00', 'Workshop', 'United Church of God (UCG) Workshop', 150, 'Jessah Bulatin', '', '09098692813', '', NULL, 5, 6),
(66, 2, '', '', '2016-10-03 10:00:00', '2016-10-03 13:00:00', '2016-10-03 10:00:00', '2016-10-03 13:00:00', 'Meeting', 'VSUCC Meeting', 80, 'Engr. Eutiquio Sudaria', 'VSU', '09098692813', '', NULL, 5, 6),
(67, 1, '', '', '2016-09-30 10:00:00', '2016-09-30 13:00:00', '2016-09-30 10:00:00', '2016-09-30 13:00:00', 'Dinner Socials', 'Orientation of DOST Scholars', 30, 'Dr. Victor B. Asio', 'N/a', '09098692813', '', NULL, 5, 6),
(68, 2, '', '', '2016-09-27 10:00:00', '2016-09-27 15:00:00', '2016-09-27 10:00:00', '2016-09-27 15:00:00', 'Party', 'VSULHS Victory Ball', 100, 'Alex P. Tulin', '', '09098692813', '', NULL, 5, 6),
(69, 2, '', '', '2016-09-16 09:00:00', '2016-09-16 11:00:00', '2016-09-16 09:00:00', '2016-09-16 11:00:00', 'Meeting', 'UCCP Meeting', 50, 'Jessah Bulatin', '', '09098692813', '', NULL, 5, 6),
(70, 1, '', '', '2016-09-14 10:00:00', '2016-09-14 15:00:00', '2016-09-14 10:00:00', '2016-09-14 15:00:00', 'Party', 'Sunflower Dorm Acquiantance Party', 80, 'Arvin Jake', '', '09952946757', '', NULL, 5, 6),
(71, 1, '', '', '2016-09-02 09:00:00', '2016-09-02 15:00:00', '2016-09-02 09:00:00', '2016-09-02 15:00:00', 'Party', 'Wacosaniara Acquiantance Party', 100, 'Jake', '', '09952946757', '', NULL, 5, 6),
(72, 1, '', '', '2016-08-25 12:00:00', '2016-08-25 17:00:00', '2016-08-25 12:00:00', '2016-08-25 17:00:00', 'Training', 'Season-Lon Training of Trainors on Cassava Production', 75, 'DA-ATI Regional Office 8', '', '09952946757', '', NULL, 5, 6),
(73, 1, 'College of Engineeringg', 'Visayas State University', '2018-05-18 08:00:00', '2018-05-18 16:00:00', '2018-05-18 08:00:00', '2018-05-18 16:00:00', 'Meeting', 'COE Meeting', 100, 'Adrian Tolero', 'Albuera, Leyte', '09952946757', 'adrian.tolero@yahoo.com', NULL, 5, 6),
(75, 1, 'College of Engineering', 'Visayas State University', '2018-05-20 08:00:00', '2018-05-20 17:00:00', NULL, NULL, 'Meeting', 'COE Meeting', 150, 'Adrian Tolero', 'Albuera, Leyte', '09952946757', 'ianix09@yahoo.com', '2018-05-18 01:55:33', 0, NULL),
(77, 2, 'College of Engineering', 'Visayas State University', '2018-05-19 08:00:00', '2018-05-19 16:00:00', NULL, NULL, 'Meeting', 'COE Meeting', 150, 'Adrian Tolero', 'Albuera, Leyte', '09952946757', 'ianix09@yahoo.com', '2018-05-18 02:20:08', 0, NULL),
(78, 1, 'DCST', 'Visca, Baybay City, Leyte', '2018-05-23 08:00:00', '2018-05-23 14:00:00', NULL, NULL, 'Meeting', 'CS Meeting', 200, 'Adrian Tolero', 'Albuera, Leyte', '09098692813', 'adrian.tolero@yahoo.com', '2018-05-20 15:20:08', 0, NULL),
(79, 2, 'College of Engineering', 'Visayas State University', '2018-05-22 08:00:00', '2018-05-22 12:00:00', NULL, NULL, 'Meeting', 'COE Meeting', 150, 'Adrian Tolero', 'Albuera, Leyte', '09952946757', 'ianix09@yahoo.com', '2018-05-22 19:28:35', 0, NULL),
(80, 1, 'College of Engineering', 'Visayas State University', '2018-05-24 08:00:00', '2018-05-24 17:00:00', '2018-05-24 09:10:37', '2018-05-24 10:12:43', 'Meeting', 'COE Meeting', 100, 'Adrian Tolero', 'Albuera, Leyte', '09098692813', 'adrian.tolero@yahoo.com', NULL, 5, 6),
(82, 1, 'DCST', 'Visayas State University', '2018-05-27 08:00:00', '2018-05-27 15:00:00', '2018-05-27 10:32:56', '2018-05-27 15:45:00', 'Meeting', 'DCST Meeting', 200, 'Adrian Tolero', 'Albuera, Leyte', '09952946757', 'adrian.tolero17@yahoo.com', '2018-05-25 22:20:03', 5, 6),
(83, 1, 'DCST', 'Visayas State University', '2018-05-30 08:00:00', '2018-05-30 16:00:00', NULL, NULL, 'Meeting', 'DCST Meeting', 150, 'Adrian Tolero', 'Albuera, Leyte', '09952946757', 'adrian.tolero17@yahoo.com', '2018-05-25 22:24:32', 1, 6),
(84, 1, 'DCST', 'Visayas State University', '2018-05-26 08:00:00', '2018-05-26 17:00:00', NULL, NULL, 'Meeting', 'DCST Meeting', 150, 'Adrian Tolero', 'Albuera, Leyte', '09952946757', 'adrian.tolero@yahoo.com', '2018-05-26 15:56:31', 0, NULL),
(85, 2, 'DCST', 'Visayas State University', '2018-06-01 08:00:00', '2018-06-01 17:00:00', '2018-05-31 15:31:17', '2018-05-31 15:32:52', 'Meeting', 'DCST Meeting', 150, 'Adrian Tolero', 'Albuera, Leyte', '09952946757', 'adrian.tolero17@yahoo.com', '2018-05-30 21:15:51', 5, 6),
(86, 1, 'DCST', 'Visayas State University', '2018-05-31 08:00:00', '2018-05-31 15:00:00', NULL, NULL, 'Meeting', 'DCST Meeting', 200, 'Adrian Tolero', 'Albuera, Leyte', '09952946757', 'adrian.tolero17@yahoo.com', '2018-05-31 15:27:08', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE IF NOT EXISTS `major` (
  `i_mid` int(11) NOT NULL,
  `str_major` varchar(50) DEFAULT NULL,
  `i_course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`i_mid`, `str_major`, `i_course_id`) VALUES
(1, 'Bio Sci', 46),
(2, 'Biology', 46),
(3, 'BSIE', 46),
(4, 'Comp Ed', 46),
(5, 'English', 46),
(6, 'Filipino', 46),
(7, 'Fishery Ed.', 46),
(8, 'HELE', 46),
(9, 'MAPEH', 46),
(10, 'Math', 46),
(11, 'PEHM', 46),
(12, 'Science', 46),
(13, 'Soc Sci', 46),
(14, 'TLE', 46),
(15, 'N/a', 45),
(31, 'AnSci', 62),
(32, 'Agron', 62),
(33, 'Agrib', 62),
(34, 'BAT', 62),
(35, 'Horti', 62),
(36, 'Plt Prot.', 62),
(37, 'DevCom', 61),
(38, 'Ag Ext', 62),
(48, 'Animation', 65),
(62, 'Web development', 63);

-- --------------------------------------------------------

--
-- Table structure for table `particulars`
--

CREATE TABLE IF NOT EXISTS `particulars` (
  `i_pid` int(11) NOT NULL,
  `enum_category` enum('VSU Personnel(First Floor)','VSU Students(First Floor)','Non VSU Employees and Students(First Floor)','VSU Employees and Students(Second Floor)','Non-VSU Employees(Second Floor)') DEFAULT NULL,
  `str_description` varchar(300) DEFAULT NULL,
  `enum_aircon` enum('Without Aircon','With Aircon') DEFAULT NULL,
  `f_first_hour` float DEFAULT NULL,
  `f_succeeding_hour` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `particulars`
--

INSERT INTO `particulars` (`i_pid`, `enum_category`, `str_description`, `enum_aircon`, `f_first_hour`, `f_succeeding_hour`) VALUES
(1, 'VSU Personnel(First Floor)', 'For official activites of VSU units/centers/institutes/dept', 'Without Aircon', 350, 50),
(2, 'VSU Personnel(First Floor)', 'For official activites of VSU units/centers/institutes/dept', 'With Aircon', 510, 290),
(3, 'VSU Personnel(First Floor)', 'For activities of reconized VSU organization: AdPA, VSUFA, LSUDC,VCC,etc.', 'Without Aircon', 400, 100),
(4, 'VSU Personnel(First Floor)', 'For activities of reconized VSU organization: AdPA, VSUFA, LSUDC,VCC,etc.', 'With Aircon', 550, 350),
(5, 'VSU Personnel(First Floor)', 'For personal activities of VSU employees such as wedding, graduation party, anniversary, etc.', 'Without Aircon', 450, 150),
(6, 'VSU Personnel(First Floor)', 'For personal activities of VSU employees such as wedding, graduation party, anniversary, etc.', 'With Aircon', 600, 350),
(7, 'VSU Students(First Floor)', 'For student activities - approved by USSO', 'Without Aircon', 50, 50),
(8, 'VSU Students(First Floor)', 'For student activities - approved by USSO', 'With Aircon', 510, 225),
(9, 'Non VSU Employees and Students(First Floor)', 'Trainings, workshops, meetings, weddings, and parties etc.', 'Without Aircon', 550, 350),
(10, 'Non VSU Employees and Students(First Floor)', 'Trainings, workshops, meetings, weddings, and parties etc.', 'With Aircon', 1000, 450),
(11, 'Non VSU Employees and Students(First Floor)', 'Church related activities, etc.', 'Without Aircon', 500, 200),
(12, 'Non VSU Employees and Students(First Floor)', 'Church related activities, etc.', 'With Aircon', 900, 425),
(13, 'VSU Employees and Students(Second Floor)', 'VSU Employees and Students Includes Sound System(2 mics and basic amplifier), electricity and cleaning.', 'Without Aircon', 550, 350),
(14, 'VSU Employees and Students(Second Floor)', 'VSU Employees and Students Includes Sound System(2 mics and basic amplifier), electricity and cleaning.', 'With Aircon', 600, 350),
(15, 'Non-VSU Employees(Second Floor)', ' Includes Sound System(2 mics and basic amplifier), electricity and cleaning.', 'Without Aircon', 600, 350),
(16, 'Non-VSU Employees(Second Floor)', ' Includes Sound System(2 mics and basic amplifier), electricity and cleaning.', 'With Aircon', 1000, 450);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `i_pay_id` int(11) NOT NULL,
  `i_rid` int(11) DEFAULT NULL,
  `i_rev_id` int(11) DEFAULT NULL,
  `str_payment_description` varchar(50) NOT NULL,
  `i_or_num` int(11) DEFAULT NULL,
  `f_amount_paid` float DEFAULT NULL,
  `d_datepaid` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=189 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`i_pay_id`, `i_rid`, `i_rev_id`, `str_payment_description`, `i_or_num`, `f_amount_paid`, `d_datepaid`) VALUES
(21, 4, 1, '', 406378, 500, '2016-06-16'),
(22, 4, 1, '', 406565, 3000, '2016-07-04'),
(23, 4, 2, '', 406108, 500, '2016-05-27'),
(24, 4, 2, '', 406375, 2000, '2016-06-16'),
(25, 4, 2, '', 406751, 1000, '2016-07-11'),
(26, 4, 3, '', 406546, 500, '2016-07-01'),
(27, 4, 3, '', 406738, 3000, '2016-07-08'),
(28, 4, 4, '', 406560, 1000, '2016-07-04'),
(29, 4, 4, '', 406871, 1500, '2016-07-22'),
(30, 4, 5, '', 406498, 500, '2016-06-28'),
(31, 4, 5, '', 406664, 1500, '2016-07-04'),
(32, 4, 5, '', 406761, 1500, '2016-07-11'),
(33, 4, 6, 'Reservation fee', 406523, 500, '2016-06-29'),
(34, 4, 6, '', 406631, 2500, '2016-07-04'),
(35, 4, 7, '', 394939, 500, '2016-05-12'),
(36, 4, 7, '', 406598, 2500, '2016-07-04'),
(41, 3, 91, 'Reservation fee', 394648, 500, '2016-03-14'),
(42, 3, 91, '', 406260, 4000, '2016-06-13'),
(43, 3, 92, '', 406287, 500, '2016-06-13'),
(44, 3, 92, '', 406341, 2000, '2016-06-15'),
(45, 3, 92, '', 406398, 2000, '2016-06-17'),
(46, 3, 93, '', 394851, 500, '2016-04-26'),
(47, 3, 93, '', 406307, 4000, '2016-06-13'),
(48, 3, 94, '', 406262, 5000, '2016-06-13'),
(49, 3, 95, '', 406360, 4500, '2016-06-16'),
(50, 3, 96, '', 406047, 500, '2016-05-23'),
(51, 3, 96, '', 406263, 4500, '2016-06-13'),
(52, 3, 97, '', 406037, 5000, '2016-05-23'),
(53, 3, 98, '', 406035, 500, '2016-05-23'),
(54, 3, 98, '', 406322, 3000, '2016-06-14'),
(55, 3, 98, '', 406473, 1500, '2016-06-28'),
(56, 3, 99, '', 394844, 500, '2016-04-26'),
(57, 3, 99, '', 406317, 2000, '2016-06-13'),
(58, 3, 99, '', 406432, 2000, '2016-06-20'),
(59, 3, 100, '', 406156, 4500, '2016-06-03'),
(60, 3, 101, '', 406009, 500, '2016-05-20'),
(61, 3, 101, '', 406298, 2000, '2016-06-13'),
(62, 3, 101, '', 406370, 2000, '2016-06-16'),
(63, 3, 102, '', 394804, 500, '2016-04-22'),
(64, 3, 102, '', 406229, 4000, '2016-06-13'),
(65, 3, 103, '', 394855, 500, '2016-04-26'),
(66, 3, 103, '', 406212, 4500, '2016-06-13'),
(67, 3, 104, '', 406092, 500, '2016-05-27'),
(68, 3, 104, '', 406253, 500, '2016-06-13'),
(69, 3, 104, '', 406428, 3500, '2016-06-20'),
(70, 3, 105, '', 406371, 2000, '2016-06-16'),
(71, 3, 106, '', 406233, 5000, '2016-06-13'),
(72, 3, 107, '', 406256, 2500, '2016-06-13'),
(73, 3, 107, '', 406476, 2000, '2016-06-28'),
(74, 3, 108, '', 394839, 500, '2016-04-26'),
(75, 3, 108, '', 406340, 4000, '2016-06-15'),
(76, 3, 109, '', 394886, 4500, '2016-04-29'),
(77, 3, 110, '', 406436, 2500, '2016-06-21'),
(78, 3, 110, '', 406452, 2000, '2016-06-23'),
(79, 3, 111, '', 406285, 500, '2016-06-13'),
(80, 3, 111, '', 406232, 4500, '2016-06-13'),
(81, 3, 112, '', 406017, 500, '2016-05-23'),
(82, 3, 112, '', 406207, 2000, '2016-06-13'),
(83, 3, 112, '', 406427, 2500, '2016-06-20'),
(84, 3, 113, '', 394918, 500, '2016-05-10'),
(85, 3, 113, '', 406226, 4500, '2016-06-13'),
(86, 3, 114, '', 394849, 500, '2016-04-26'),
(87, 3, 114, '', 406303, 4000, '2016-06-13'),
(88, 3, 115, '', 394872, 4500, '2016-04-28'),
(89, 3, 116, '', 406028, 500, '2016-05-23'),
(90, 3, 116, '', 406191, 4500, '2016-06-13'),
(91, 3, 117, '', 394790, 500, '2016-04-21'),
(92, 3, 117, '', 406189, 4500, '2016-06-13'),
(93, 3, 118, '', 406018, 500, '2016-05-23'),
(94, 3, 118, '', 406202, 2000, '2016-06-13'),
(95, 3, 118, '', 406474, 2500, '2016-06-28'),
(96, 3, 119, '', 406011, 500, '2016-05-20'),
(97, 3, 119, '', 406247, 2000, '2016-06-13'),
(98, 3, 119, '', 406818, 2500, '2016-07-18'),
(99, 3, 120, '', 394832, 500, '2016-04-26'),
(100, 3, 120, '', 406310, 4000, '2016-06-13'),
(101, 3, 121, '', 394875, 500, '2016-04-28'),
(102, 3, 121, '', 406251, 4500, '2016-06-13'),
(103, 3, 122, '', 394649, 500, '2016-03-14'),
(104, 3, 122, '', 406265, 4000, '2016-06-13'),
(105, 3, 123, '', 394806, 500, '2016-04-22'),
(106, 3, 123, '', 406302, 2000, '2016-06-13'),
(107, 3, 124, '', 406190, 2500, '2016-06-13'),
(108, 3, 124, '', 406433, 1500, '2016-06-20'),
(109, 3, 124, '', 406749, 1000, '2016-07-11'),
(110, 3, 125, '', 406286, 500, '2016-06-13'),
(111, 3, 125, '', 406231, 4500, '2016-06-13'),
(112, 3, 126, '', 406056, 500, '2016-05-23'),
(113, 3, 126, '', 406244, 4500, '2016-06-13'),
(114, 3, 127, '', 406030, 500, '2016-05-23'),
(115, 3, 127, '', 406201, 4500, '2016-06-13'),
(116, 3, 128, '', 394833, 500, '2016-04-26'),
(117, 3, 128, '', 406261, 4000, '2016-06-13'),
(118, 3, 129, '', 394831, 500, '2016-04-21'),
(119, 3, 129, '', 406216, 4500, '2016-06-13'),
(120, 3, 130, '', 394853, 500, '2016-04-26'),
(121, 3, 130, '', 406219, 4500, '2016-06-13'),
(130, 4, 154, 'Reservation fee', 406382, 500, '2016-06-16'),
(131, 4, 154, 'Payment', 406574, 1000, '2016-07-04'),
(132, 4, 154, 'Payment', 406754, 2000, '2016-07-11'),
(133, 4, 8, 'Reservation fee', 394938, 500, '2016-05-12'),
(134, 4, 8, 'Payment', 406606, 3000, '2016-07-04'),
(135, 4, 9, 'Payment', 406681, 1500, '2016-07-04'),
(136, 4, 9, 'Payment', 406799, 2000, '2016-07-15'),
(137, 4, 10, 'Reservation fee', 406486, 500, '2016-06-28'),
(138, 4, 10, 'Payment', 406525, 3000, '2016-06-29'),
(139, 4, 11, 'Reservation fee', 394931, 500, '2016-05-12'),
(140, 4, 11, 'Payment', 406588, 2500, '2016-07-04'),
(141, 4, 12, 'Full payment', 406494, 3000, '2016-06-28'),
(142, 4, 13, 'Reservation fee', 394946, 500, '2016-05-05'),
(143, 4, 13, 'Payment', 406876, 2500, '2016-07-25'),
(144, 4, 14, 'Reservation fee', 406777, 500, '2016-07-04'),
(145, 4, 14, 'Payment', 406601, 3000, '2016-07-13'),
(146, 4, 15, 'Reservation fee', 394999, 500, '2016-05-20'),
(147, 4, 16, 'Reservation fee', 406807, 500, '2016-07-04'),
(148, 4, 16, 'Payment', 406559, 3000, '2016-07-15'),
(149, 4, 17, 'Reservation fee', 406447, 500, '2016-06-22'),
(150, 4, 17, 'Payment', 406577, 3000, '2016-07-04'),
(151, 4, 18, 'Reservation fee', 406444, 500, '2016-06-22'),
(152, 4, 18, 'Payment', 406645, 3000, '2016-07-04'),
(153, 4, 19, 'Reservation fee', 394994, 500, '2016-05-20'),
(154, 4, 19, 'Payment', 406772, 2500, '2016-07-13'),
(155, 4, 20, 'Reservation fee', 394900, 500, '2016-05-04'),
(156, 4, 20, 'Payment', 406811, 2500, '2016-07-15'),
(157, 4, 21, 'Reservation fee', 406518, 500, '2016-06-29'),
(158, 4, 21, 'Payment', 406734, 2500, '2016-07-08'),
(159, 4, 22, 'Reservation fee', 394981, 500, '2016-05-20'),
(160, 4, 22, 'Payment', 406573, 2500, '2016-07-04'),
(161, 4, 23, 'Reservation fee', 394941, 500, '2016-05-12'),
(162, 4, 23, 'Payment', 406599, 2500, '2016-07-04'),
(163, 4, 24, 'Reservation fee', 406157, 500, '2016-06-03'),
(164, 4, 24, 'Payment', 406821, 2500, '2016-07-18'),
(165, 4, 25, 'Reservation fee', 406497, 500, '2016-06-28'),
(166, 4, 25, 'Payment', 406683, 3000, '2016-07-04'),
(167, 4, 26, 'Reservation fee', 394941, 500, '2016-05-12'),
(168, 4, 26, 'Payment', 406650, 3000, '2016-07-04'),
(169, 4, 27, 'Reservation fee', 394934, 500, '2016-05-12'),
(170, 4, 27, 'Payment', 406589, 2500, '2016-07-04'),
(171, 4, 28, 'Reservation fee', 394977, 500, '2016-05-20'),
(172, 4, 28, 'Payment', 406711, 2500, '2016-07-05'),
(173, 4, 30, 'Reservation fee', 394952, 500, '2016-05-12'),
(174, 4, 29, 'Reservation fee', 406760, 500, '2016-07-11'),
(175, 4, 29, 'Payment', 406644, 3000, '2016-07-04'),
(176, 4, 30, 'Payment', 406607, 1000, '2016-07-04'),
(177, 4, 30, 'Payment', 406834, 1500, '2016-07-18'),
(178, 4, 31, 'Reservation fee', 406687, 500, '2016-07-04'),
(179, 4, 31, 'Payment', 406635, 1500, '2016-07-04'),
(180, 4, 32, 'Reservation fee', 406676, 500, '2016-07-04'),
(181, 4, 32, 'Payment', 406830, 3000, '2016-07-18'),
(182, 4, 33, 'Reservation fee', 394947, 500, '2016-05-12'),
(183, 4, 33, 'Payment', 406603, 2000, '2016-07-04'),
(184, 4, 34, 'Reservation fee', 406803, 500, '2016-07-15'),
(185, 4, 35, 'Full payment', 406542, 3500, '2016-07-01'),
(186, 4, 36, 'Reservation fee', 406418, 500, '2016-06-20'),
(187, 4, 36, 'Payment', 406665, 500, '2016-07-04'),
(188, 4, 36, 'Payment', 406736, 2000, '2016-05-11');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `i_rid` int(11) NOT NULL DEFAULT '0',
  `i_rev_id` int(11) NOT NULL,
  `d_date_requested` datetime NOT NULL,
  `status` int(11) DEFAULT NULL,
  `i_emp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`i_rid`, `i_rev_id`, `d_date_requested`, `status`, `i_emp_id`) VALUES
(3, 91, '2018-05-07 17:07:40', 2, NULL),
(3, 92, '0000-00-00 00:00:00', 2, NULL),
(3, 93, '0000-00-00 00:00:00', 2, NULL),
(3, 94, '0000-00-00 00:00:00', 2, NULL),
(3, 95, '0000-00-00 00:00:00', 2, NULL),
(3, 96, '0000-00-00 00:00:00', 2, NULL),
(3, 97, '0000-00-00 00:00:00', 2, NULL),
(3, 98, '0000-00-00 00:00:00', 2, NULL),
(3, 99, '0000-00-00 00:00:00', 2, NULL),
(3, 100, '0000-00-00 00:00:00', 2, NULL),
(3, 101, '0000-00-00 00:00:00', 2, NULL),
(3, 102, '0000-00-00 00:00:00', 2, NULL),
(3, 103, '0000-00-00 00:00:00', 2, NULL),
(3, 104, '0000-00-00 00:00:00', 2, NULL),
(3, 105, '0000-00-00 00:00:00', 2, NULL),
(3, 106, '0000-00-00 00:00:00', 2, NULL),
(3, 107, '0000-00-00 00:00:00', 2, NULL),
(3, 108, '0000-00-00 00:00:00', 2, NULL),
(3, 109, '0000-00-00 00:00:00', 2, NULL),
(3, 110, '0000-00-00 00:00:00', 2, NULL),
(3, 111, '0000-00-00 00:00:00', 2, NULL),
(3, 112, '0000-00-00 00:00:00', 2, NULL),
(3, 113, '0000-00-00 00:00:00', 2, NULL),
(3, 114, '0000-00-00 00:00:00', 2, NULL),
(3, 115, '0000-00-00 00:00:00', 2, NULL),
(3, 116, '0000-00-00 00:00:00', 2, NULL),
(3, 117, '0000-00-00 00:00:00', 2, NULL),
(3, 118, '0000-00-00 00:00:00', 2, NULL),
(3, 119, '0000-00-00 00:00:00', 2, NULL),
(3, 120, '0000-00-00 00:00:00', 2, NULL),
(3, 121, '0000-00-00 00:00:00', 2, NULL),
(3, 122, '0000-00-00 00:00:00', 2, NULL),
(3, 123, '0000-00-00 00:00:00', 2, NULL),
(3, 124, '0000-00-00 00:00:00', 2, NULL),
(3, 125, '0000-00-00 00:00:00', 2, NULL),
(3, 126, '0000-00-00 00:00:00', 2, NULL),
(3, 127, '0000-00-00 00:00:00', 2, NULL),
(3, 128, '0000-00-00 00:00:00', 2, NULL),
(3, 129, '0000-00-00 00:00:00', 2, NULL),
(3, 130, '2018-03-23 14:24:38', 2, NULL),
(4, 1, '0000-00-00 00:00:00', 2, NULL),
(4, 2, '0000-00-00 00:00:00', 2, NULL),
(4, 3, '0000-00-00 00:00:00', 2, NULL),
(4, 4, '0000-00-00 00:00:00', 2, NULL),
(4, 5, '0000-00-00 00:00:00', 2, NULL),
(4, 6, '0000-00-00 00:00:00', 2, NULL),
(4, 7, '0000-00-00 00:00:00', 2, NULL),
(4, 8, '0000-00-00 00:00:00', 2, NULL),
(4, 9, '0000-00-00 00:00:00', 2, NULL),
(4, 10, '0000-00-00 00:00:00', 2, NULL),
(4, 11, '0000-00-00 00:00:00', 2, NULL),
(4, 12, '0000-00-00 00:00:00', 2, NULL),
(4, 13, '0000-00-00 00:00:00', 2, NULL),
(4, 14, '0000-00-00 00:00:00', 2, NULL),
(4, 15, '0000-00-00 00:00:00', 2, NULL),
(4, 16, '0000-00-00 00:00:00', 2, NULL),
(4, 17, '0000-00-00 00:00:00', 2, NULL),
(4, 18, '0000-00-00 00:00:00', 2, NULL),
(4, 19, '0000-00-00 00:00:00', 2, NULL),
(4, 20, '0000-00-00 00:00:00', 2, NULL),
(4, 21, '0000-00-00 00:00:00', 2, NULL),
(4, 22, '0000-00-00 00:00:00', 2, NULL),
(4, 23, '0000-00-00 00:00:00', 2, NULL),
(4, 24, '0000-00-00 00:00:00', 2, NULL),
(4, 25, '0000-00-00 00:00:00', 2, NULL),
(4, 26, '0000-00-00 00:00:00', 2, NULL),
(4, 27, '0000-00-00 00:00:00', 2, NULL),
(4, 28, '0000-00-00 00:00:00', 2, NULL),
(4, 29, '0000-00-00 00:00:00', 2, NULL),
(4, 30, '0000-00-00 00:00:00', 2, NULL),
(4, 31, '0000-00-00 00:00:00', 2, NULL),
(4, 32, '0000-00-00 00:00:00', 2, NULL),
(4, 33, '0000-00-00 00:00:00', 2, NULL),
(4, 34, '0000-00-00 00:00:00', 2, NULL),
(4, 35, '0000-00-00 00:00:00', 2, NULL),
(4, 36, '0000-00-00 00:00:00', 2, NULL),
(4, 154, '0000-00-00 00:00:00', 2, 6),
(4, 161, '2018-05-25 22:50:52', 4, 6),
(4, 163, '2018-05-27 21:33:39', 0, NULL),
(4, 165, '0000-00-00 00:00:00', 2, 6),
(6, 164, '2018-05-30 21:16:24', 2, 8),
(6, 168, '2019-01-16 11:10:26', 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `reviewer`
--

CREATE TABLE IF NOT EXISTS `reviewer` (
  `i_rev_id` int(11) NOT NULL,
  `ch_sname` varchar(50) DEFAULT NULL,
  `ch_fname` varchar(50) DEFAULT NULL,
  `ch_mi` varchar(2) DEFAULT NULL,
  `d_birthdate` varchar(50) DEFAULT NULL,
  `i_year_grad` int(11) DEFAULT NULL,
  `i_sid` int(11) DEFAULT NULL,
  `i_mid` int(11) DEFAULT NULL,
  `str_address` varchar(100) DEFAULT NULL,
  `str_contact_no` varchar(30) DEFAULT NULL,
  `str_email_add` varchar(50) DEFAULT NULL,
  `i_lodging` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviewer`
--

INSERT INTO `reviewer` (`i_rev_id`, `ch_sname`, `ch_fname`, `ch_mi`, `d_birthdate`, `i_year_grad`, `i_sid`, `i_mid`, `str_address`, `str_contact_no`, `str_email_add`, `i_lodging`) VALUES
(1, 'Abarquez', 'Jennifer', '', '', NULL, 8, 15, '', '', '', 0),
(2, 'Advincula', 'Shella Mae', '', '', NULL, 10, 15, '', '', '', 0),
(3, 'Agravante', 'Jessa Mae', 'P.', '', NULL, 11, 11, '', '', '', 0),
(4, 'Alfabete', 'Roy', '', '', NULL, 11, 15, '', '', '', 0),
(5, 'Alingasa', 'Marilou', '', '', NULL, 10, 15, '', '', '', 0),
(6, 'Alison', 'Angelie', '', '', NULL, 20, 15, '', '', '', 0),
(7, 'Amabao', 'Shiela Mae', '', '', NULL, 22, 15, '', '', '', 0),
(8, 'Amistoso', 'Crezeil Ann', 'M.', '', NULL, 11, 11, '', '', '', 0),
(9, 'Arañez', 'Irine', '', '', 2015, 14, 15, '', '562-9390', 'irine_2016@yahoo.com', 0),
(10, 'Argallon', 'Regie', '', '', NULL, 8, 15, '', '', '', 0),
(11, 'Arrofo', 'Joanna', 'O.', '', NULL, 24, 15, '', '', '', 0),
(12, 'Austria', 'Kathleen', 'D', '', NULL, 22, 15, '', '', '', 0),
(13, 'Babaylan', 'Mariez Typanie', 'D.', '', NULL, 22, 15, '', '', '', 0),
(14, 'Bacarisas', 'John Michael', 'D.', '', NULL, 11, 5, '', '', '', 0),
(15, 'Balbero', 'Risse', '', '', NULL, 23, 15, '', '', '', 0),
(16, 'Balote', 'Eva Mae', 'G.', '', NULL, 11, 12, '', '', '', 0),
(17, 'Balote', 'Jenisa', 'G.', '', NULL, 11, 15, '', '', '', 0),
(18, 'Baquero', 'Hernan', 'B.', '', NULL, 11, 13, '', '', '', 0),
(19, 'Barral', 'Jeleysa', 'B.', '', NULL, 22, 15, '', '', '', 0),
(20, 'Bartolini', 'Nikki Rose', 'C.', '', NULL, 20, 15, '', '', '', 0),
(21, 'Bartolini', 'Remilyn', 'A.', '', NULL, 20, 15, '', '', '', 0),
(22, 'Basubas', 'Glecelle', 'E.', '', NULL, 22, 15, '', '', '', 0),
(23, 'Bautista', 'Juliet', '', '', NULL, 22, 15, '', '', '', 0),
(24, 'Bejagon', 'Meljen', 'L.', '', NULL, 20, 15, '', '', '', 0),
(25, 'Bojos', 'Sandy Emmanuel', '', '', NULL, 25, 15, '', '', '', 0),
(26, 'Bolotano', 'Diseree Mae', 'O.', '', NULL, 11, 9, '', '', '', 0),
(27, 'Bonhoc', 'Nermian Lyn', 'A.', '', NULL, 24, 15, '', '', '', 0),
(28, 'Borinaga', 'Agnes', 'L.', '', NULL, 20, 15, '', '', '', 0),
(29, 'Brecio', 'Ma. Kathleen', 'D.', '', NULL, 11, 13, '', '', '', 0),
(30, 'Brigildo', 'Mary Christ', 'M.', '', NULL, 22, 15, '', '', '', 0),
(31, 'Bugnos', 'Gina', '', '', NULL, 5, 15, '', '', '', 0),
(32, 'Buhi', 'Roger', '', '', NULL, 3, 15, '', '', '', 0),
(33, 'Butcon', 'Emily', 'F.', '', NULL, 22, 15, '', '', '', 0),
(34, 'Cabagsican', 'Mary Fritz', '', '', NULL, 22, 15, '', '', '', 0),
(35, 'Cabalhin', 'Mary Jane', '', '', NULL, 11, 15, '', '', '', 0),
(36, 'Caballero', 'Anzel Mae', 'M.', '', NULL, 20, 15, '', '', '', 0),
(91, 'Abadiano', 'Abella Ostria', '', '', 0, 20, 35, '', '', '', 0),
(92, 'Abueva', 'Lourdes', 'O.', '', 0, 20, 33, '', '', '', 0),
(93, 'Adlao', 'Noime Ann', 'B.', '', 0, 20, 31, '', '', '', 0),
(94, 'Abgat', 'Ivy', 'Ja', '', 0, 26, NULL, '', '', '', 0),
(95, 'Agosto', 'Melba', '', '', 0, 20, 36, '', '', '', 0),
(96, 'Agravante', 'Dave', '', '', 0, 26, NULL, '', '', '', 0),
(97, 'Aguirre', 'Jelmar', '', '', 0, 26, NULL, '', '', '', 0),
(98, 'Alcido', 'Merven', '', '', 0, 26, NULL, '', '', '', 0),
(99, 'Alconera', 'Donna Fe', 'B.', '', 0, 20, 31, '', '', '', 0),
(100, 'Alea', 'Aileen', '', '', 0, 20, NULL, '', '', '', 0),
(101, 'Alfaro', 'Leighton', '', '', 0, 20, 37, '', '', '', 0),
(102, 'Alonzo', 'Rejean', 'B.', '', 0, 20, 33, '', '', '', 0),
(103, 'Alumbro', 'Rosemarie', 'V.', '', 0, 27, 34, '', '', '', 0),
(104, 'Amac', 'Cliff Thaddeus', 'M.', '', 0, 20, 33, '', '', '', 0),
(105, 'Amarado', 'Neil Albert', '', '', 0, 20, 31, '', '', '', 0),
(106, 'Amarante', 'Jesanro', 'S.', '', 0, 28, NULL, '', '', '', 0),
(107, 'Ampit', 'Charlou', 'A.', '', 0, 20, 38, '', '', '', 0),
(108, 'Aniga', 'Anirose', 'P.', '', 0, 20, 35, '', '', '', 0),
(109, 'Aparri', 'Arlen', '', '', 0, 20, 31, '', '', '', 0),
(110, 'Aporador', 'Maria Christy', '', '', 0, 20, 35, '', '', '', 0),
(111, 'Araba', 'Randy', '', '', 0, 26, NULL, '', '', '', 0),
(112, 'Arausa', 'Vina', 'G.', '', 0, 29, NULL, '', '', '', 0),
(113, 'Ardiente', 'Julito', 'D.', '', 0, 30, NULL, '', '', '', 0),
(114, 'Arpilleda', 'Ma. Anevel', 'D.', '', 0, 20, 33, '', '', '', 0),
(115, 'Autida', 'Charlie', '', '', 0, 20, 31, '', '', '', 0),
(116, 'Bandola', 'Cherel', '', '', 0, 29, NULL, '', '', '', 0),
(117, 'Barayong', 'Anarose', '', '', 0, 31, NULL, '', '', '', 0),
(118, 'Bascon', 'Rhey Zane', 'A.', '', 0, 29, NULL, '', '', '', 0),
(119, 'Beniga', 'John Paul', '', '', 0, 4, NULL, '', '', '', 0),
(120, 'Besagas', 'Arsenio', 'C.', '', 0, 20, 31, '', '', '', 0),
(121, 'Bilangdal', 'Janice', '', '', 0, 32, NULL, '', '', '', 0),
(122, 'Borinaga', 'Junly', '', '', 0, 30, NULL, '', '', '', 0),
(123, 'Borja', 'Carin', '', '', 0, 20, 32, '', '', '', 0),
(124, 'Boroc', 'Venus', '', '', 0, 31, NULL, '', '', '', 0),
(125, 'Busa', 'Alben Jose', '', '', 0, 26, NULL, '', '', '', 0),
(126, 'Busa', 'Manilyn', '', '', 0, 26, NULL, '', '', '', 0),
(127, 'Buslon', 'Ma. Claudine', '', '', 0, 29, NULL, '', '', '', 0),
(128, 'Cabangbang', 'July Bryan', '', '', 0, 27, 31, '', '', '', 0),
(129, 'Cabas', 'Jimboy', 'A.', '', 0, 33, 33, '', '', '', 0),
(130, 'Cabungcag', 'Aljun', 'S.', '', 0, 27, 34, '', '', '', 0),
(154, 'Cabillan', 'Vaneza', 'L.', '', 2015, 11, 13, '', '1231231', 'vaneza@yahoo.com', 0),
(161, 'Tolero', 'Adrian', 'C.', 'November 13, 1996', 2018, 20, NULL, 'Albuera, Leyte', '09952946757', 'adrian.tolero17@yahoo.com', 1),
(163, 'Tolero', 'Adrian ', 'C.', 'November 13, 1996', 2018, 20, NULL, 'Albuera, Leyte', '09098692813', 'adrian.tolero@yahoo.com', 1),
(164, 'Tolero', 'Adrian', 'C.', 'November 13, 1996', 2018, 20, 62, 'Albuera, Leyte', '09952946757', 'adrian.tolero17@yahoo.com', 1),
(165, 'Tolero', 'Adrian', 'C.', 'November 13, 1996', 2018, 35, 33, 'Albuera, Leyte', '09952946757', 'adrian.tolero17@yahoo.com', 1),
(168, 'Tolero', 'Alfon', 'C.', 'Oct. 31, 1991', 2008, 20, 48, 'Albuera, Leyte', '562-9871', 'alponso.tolero19@yahoo.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `review_schedule`
--

CREATE TABLE IF NOT EXISTS `review_schedule` (
  `i_rid` int(11) NOT NULL,
  `i_rm_id` int(11) DEFAULT NULL,
  `str_description` varchar(100) DEFAULT NULL,
  `str_reviewee` varchar(100) NOT NULL,
  `dt_start` datetime DEFAULT NULL,
  `dt_end` datetime DEFAULT NULL,
  `f_reviewfee_vsu` float DEFAULT NULL,
  `f_reviewfee_non_vsu` float DEFAULT NULL,
  `i_reviewers` int(11) DEFAULT NULL,
  `i_status` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_schedule`
--

INSERT INTO `review_schedule` (`i_rid`, `i_rm_id`, `str_description`, `str_reviewee`, `dt_start`, `dt_end`, `f_reviewfee_vsu`, `f_reviewfee_non_vsu`, `i_reviewers`, `i_status`) VALUES
(3, 2, 'Agriculturist Licensure Examination Review', 'n/a', '2016-06-13 08:00:00', '2016-07-21 17:00:00', 4500, 5000, 40, 1),
(4, 1, 'Licensure Examination for Teachers Review', 'n/a', '2016-07-04 08:00:00', '2016-07-29 17:00:00', 3000, 3500, 160, 1),
(6, 1, 'Sample', 'Sample', '2019-01-01 00:00:00', '2019-06-26 00:00:00', 3000, 3500, 150, 1);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `i_rm_id` int(11) NOT NULL DEFAULT '0',
  `str_rmName` varchar(50) DEFAULT NULL,
  `i_capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`i_rm_id`, `str_rmName`, `i_capacity`) VALUES
(1, 'Room 1', 200),
(2, 'Room 2', 150);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE IF NOT EXISTS `school` (
  `i_sid` int(11) NOT NULL,
  `str_school_name` varchar(50) DEFAULT NULL,
  `str_school_address` varchar(100) DEFAULT NULL,
  `i_school_type` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`i_sid`, `str_school_name`, `str_school_address`, `i_school_type`) VALUES
(3, 'BIST', '', 0),
(4, 'BISU-Candijay', '', 0),
(5, 'CM', '', 0),
(6, 'EVSU', '', 1),
(7, 'FCIC', '', 0),
(8, 'LNU', '', 0),
(9, 'Masbate Coll', '', 0),
(10, 'MLG', '', 0),
(11, 'NSU', '', 0),
(12, 'NSU-Biliran', '', 0),
(13, 'PIT', '', 0),
(14, 'SLSU', '', 0),
(15, 'SLSU-Hinunangan', '', 0),
(16, 'SMC', '', 0),
(17, 'SSCT', '', 0),
(18, 'SSU', '', 0),
(19, 'VCIT-Abuyog', '', 0),
(20, 'VSU', '', 1),
(21, 'VSU-AC', '', 1),
(22, 'VSU-IC', '', 1),
(23, 'VSU-Isabel ', '', 1),
(24, 'VSU-VC', '', 1),
(25, 'WLC', '', 0),
(26, 'ESSU-Canavid', NULL, 0),
(27, 'SLSU-Bonotc', NULL, 0),
(28, 'NORSU', NULL, 0),
(29, 'BISU-Bilar', NULL, 0),
(30, 'CTU-Barili', NULL, 0),
(31, 'NWSSU', NULL, 0),
(32, 'CTU-Oslob', NULL, 0),
(33, 'ESSU-Salcedo', NULL, 0),
(34, 'STI College', 'Ormoc City, Leyte', 0),
(35, 'samplw', 'sample', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ameneties`
--
ALTER TABLE `ameneties`
  ADD PRIMARY KEY (`i_aid`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`i_bid`), ADD KEY `i_fr_id` (`i_fr_id`), ADD KEY `i_pid` (`i_pid`);

--
-- Indexes for table `bill_ameneties`
--
ALTER TABLE `bill_ameneties`
  ADD PRIMARY KEY (`i_baid`), ADD KEY `i_aid` (`i_aid`), ADD KEY `i_fr_id` (`i_fr_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`i_course_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`i_emp_id`);

--
-- Indexes for table `function_reservation`
--
ALTER TABLE `function_reservation`
  ADD PRIMARY KEY (`i_fr_id`), ADD KEY `i_rm_id` (`i_rm_id`), ADD KEY `i_emp_id` (`i_emp_id`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`i_mid`), ADD KEY `i_course_id` (`i_course_id`);

--
-- Indexes for table `particulars`
--
ALTER TABLE `particulars`
  ADD PRIMARY KEY (`i_pid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`i_pay_id`), ADD KEY `i_rid` (`i_rid`), ADD KEY `i_rev_id` (`i_rev_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`i_rid`,`i_rev_id`), ADD KEY `i_rev_id` (`i_rev_id`), ADD KEY `i_emp_id` (`i_emp_id`);

--
-- Indexes for table `reviewer`
--
ALTER TABLE `reviewer`
  ADD PRIMARY KEY (`i_rev_id`), ADD KEY `i_mid` (`i_mid`), ADD KEY `i_sid` (`i_sid`);

--
-- Indexes for table `review_schedule`
--
ALTER TABLE `review_schedule`
  ADD PRIMARY KEY (`i_rid`), ADD KEY `i_rm_id` (`i_rm_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`i_rm_id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`i_sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ameneties`
--
ALTER TABLE `ameneties`
  MODIFY `i_aid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `i_bid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `bill_ameneties`
--
ALTER TABLE `bill_ameneties`
  MODIFY `i_baid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `i_course_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `i_emp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `function_reservation`
--
ALTER TABLE `function_reservation`
  MODIFY `i_fr_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `major`
--
ALTER TABLE `major`
  MODIFY `i_mid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `particulars`
--
ALTER TABLE `particulars`
  MODIFY `i_pid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `i_pay_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=189;
--
-- AUTO_INCREMENT for table `reviewer`
--
ALTER TABLE `reviewer`
  MODIFY `i_rev_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=169;
--
-- AUTO_INCREMENT for table `review_schedule`
--
ALTER TABLE `review_schedule`
  MODIFY `i_rid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `i_sid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing`
--
ALTER TABLE `billing`
ADD CONSTRAINT `billing_ibfk_5` FOREIGN KEY (`i_fr_id`) REFERENCES `function_reservation` (`i_fr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `billing_ibfk_6` FOREIGN KEY (`i_pid`) REFERENCES `particulars` (`i_pid`);

--
-- Constraints for table `bill_ameneties`
--
ALTER TABLE `bill_ameneties`
ADD CONSTRAINT `bill_ameneties_ibfk_3` FOREIGN KEY (`i_fr_id`) REFERENCES `function_reservation` (`i_fr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `bill_ameneties_ibfk_4` FOREIGN KEY (`i_aid`) REFERENCES `ameneties` (`i_aid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `function_reservation`
--
ALTER TABLE `function_reservation`
ADD CONSTRAINT `function_reservation_ibfk_1` FOREIGN KEY (`i_rm_id`) REFERENCES `room` (`i_rm_id`),
ADD CONSTRAINT `function_reservation_ibfk_2` FOREIGN KEY (`i_emp_id`) REFERENCES `employee` (`i_emp_id`);

--
-- Constraints for table `major`
--
ALTER TABLE `major`
ADD CONSTRAINT `major_ibfk_1` FOREIGN KEY (`i_course_id`) REFERENCES `course` (`i_course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`i_rev_id`) REFERENCES `reservation` (`i_rev_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`i_rid`) REFERENCES `review_schedule` (`i_rid`) ON UPDATE CASCADE,
ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`i_rev_id`) REFERENCES `reviewer` (`i_rev_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`i_emp_id`) REFERENCES `employee` (`i_emp_id`);

--
-- Constraints for table `reviewer`
--
ALTER TABLE `reviewer`
ADD CONSTRAINT `reviewer_ibfk_7` FOREIGN KEY (`i_sid`) REFERENCES `school` (`i_sid`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `reviewer_ibfk_8` FOREIGN KEY (`i_mid`) REFERENCES `major` (`i_mid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `review_schedule`
--
ALTER TABLE `review_schedule`
ADD CONSTRAINT `review_schedule_ibfk_1` FOREIGN KEY (`i_rm_id`) REFERENCES `room` (`i_rm_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
