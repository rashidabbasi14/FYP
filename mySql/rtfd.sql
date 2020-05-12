-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2019 at 10:59 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rtfd`
--

-- --------------------------------------------------------

--
-- Table structure for table `culprit`
--

CREATE TABLE `culprit` (
  `Culprit_ID` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Description` text NOT NULL,
  `Age` int(11) NOT NULL,
  `Phone_Number` int(11) NOT NULL,
  `Address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `culprit`
--

INSERT INTO `culprit` (`Culprit_ID`, `Name`, `Description`, `Age`, `Phone_Number`, `Address`) VALUES
(1, 'Culprit1', 'WANTED', 21, 90078601, 'Gulshan, Karachi'),
(2, 'Culprit2', 'MOST WANTED', 0, 0, 'Liyari'),
(3, 'Culprit8', 'Ma Nigga', 13, 123123, 'fadsf'),
(4, 'Culprit4', 'My Man', 21, 213, 'I dont know\r\n'),
(7, 'MoVlog', 'Vlogger ', 21, 39213, 'dubai'),
(12, 'Sohail', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `culprit_pictures`
--

CREATE TABLE `culprit_pictures` (
  `Picture_ID` int(11) NOT NULL,
  `Culprit_ID` int(11) NOT NULL,
  `Path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `culprit_pictures`
--

INSERT INTO `culprit_pictures` (`Picture_ID`, `Culprit_ID`, `Path`) VALUES
(1, 1, 'RTFD\\Input\\Culprits\\Culprit1.jpg'),
(2, 2, 'RTFD\\Input\\Culprits\\Culprit2.jpg'),
(3, 3, 'RTFD\\Input\\Culprits\\Culprit8.jpg'),
(4, 4, 'RTFD\\Input\\Culprits\\Culprit4.jpg'),
(5, 7, 'RTFD\\Input\\Culprits\\Culprit5.jpg'),
(7, 12, 'RTFD\\Input\\Culprits\\Khatri.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `surveillance_camera`
--

CREATE TABLE `surveillance_camera` (
  `Camera_ID` int(11) NOT NULL,
  `Name` varchar(11) NOT NULL,
  `Location` text NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `lat` decimal(10,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surveillance_camera`
--

INSERT INTO `surveillance_camera` (`Camera_ID`, `Name`, `Location`, `lng`, `lat`) VALUES
(1, 'Camera1', 'Fast', '24.85720100', '67.26467300'),
(2, 'Camera2', 'Gulshan-e-Hadeed', '24.87382800', '67.36998400');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `Track_ID` int(11) NOT NULL,
  `Culprit_ID` int(11) NOT NULL,
  `VidTime` text NOT NULL,
  `Video_ID` int(11) NOT NULL,
  `Frame_ID` int(11) NOT NULL,
  `User_Vid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`Track_ID`, `Culprit_ID`, `VidTime`, `Video_ID`, `Frame_ID`, `User_Vid`) VALUES
(1, 12, '0:1', 11, 1, 1),
(2, 12, '0:2', 11, 2, 1),
(3, 12, '0:20', 11, 20, 1),
(4, 12, '0:22', 11, 22, 1),
(5, 12, '0:23', 11, 23, 1),
(6, 3, '0:12', 1, 12, 0),
(7, 3, '0:13', 1, 13, 0),
(8, 12, '0:4', 11, 4, 1),
(9, 12, '0:16', 11, 16, 1),
(10, 12, '0:17', 11, 17, 1),
(11, 12, '0:18', 11, 18, 1),
(12, 12, '0:19', 11, 19, 1),
(13, 7, '2:12', 5, 132, 0),
(14, 7, '8:6', 5, 486, 0),
(15, 7, '8:8', 5, 488, 0),
(16, 7, '8:10', 5, 490, 0),
(17, 7, '8:11', 5, 491, 0),
(18, 7, '8:17', 5, 497, 0),
(19, 7, '8:18', 5, 498, 0),
(20, 7, '8:20', 5, 500, 0),
(21, 7, '8:24', 5, 504, 0),
(22, 7, '8:25', 5, 505, 0),
(23, 7, '8:30', 5, 510, 0),
(24, 7, '8:37', 5, 517, 0),
(25, 7, '8:38', 5, 518, 0),
(26, 7, '8:39', 5, 519, 0),
(27, 7, '8:40', 5, 520, 0),
(28, 7, '8:41', 5, 521, 0),
(29, 7, '8:42', 5, 522, 0),
(30, 7, '8:46', 5, 526, 0),
(31, 7, '8:48', 5, 528, 0),
(32, 7, '8:50', 5, 530, 0),
(33, 7, '9:4', 5, 544, 0),
(34, 7, '9:5', 5, 545, 0),
(35, 7, '2:18', 5, 138, 0),
(36, 7, '9:13', 5, 553, 0),
(37, 7, '9:15', 5, 555, 0),
(38, 7, '9:18', 5, 558, 0),
(39, 7, '9:25', 5, 565, 0),
(40, 1, '9:26', 5, 566, 0),
(41, 7, '9:27', 5, 567, 0),
(42, 7, '9:36', 5, 576, 0),
(43, 7, '9:41', 5, 581, 0),
(44, 7, '9:42', 5, 582, 0),
(45, 7, '9:47', 5, 587, 0),
(46, 7, '0:14', 5, 14, 0),
(47, 7, '9:49', 5, 589, 0),
(48, 7, '9:51', 5, 591, 0),
(49, 7, '9:56', 5, 596, 0),
(50, 7, '0:6', 5, 6, 0),
(51, 7, '10:14', 5, 614, 0),
(52, 7, '10:15', 5, 615, 0),
(53, 7, '10:16', 5, 616, 0),
(54, 1, '10:17', 5, 617, 0),
(55, 7, '10:23', 5, 623, 0),
(56, 7, '2:21', 5, 141, 0),
(57, 7, '10:40', 5, 640, 0),
(58, 7, '10:41', 5, 641, 0),
(59, 7, '10:43', 5, 643, 0),
(60, 7, '10:45', 5, 645, 0),
(61, 7, '10:46', 5, 646, 0),
(62, 7, '10:47', 5, 647, 0),
(63, 7, '10:48', 5, 648, 0),
(64, 7, '10:49', 5, 649, 0),
(65, 7, '10:51', 5, 651, 0),
(66, 7, '2:22', 5, 142, 0),
(67, 7, '10:52', 5, 652, 0),
(68, 7, '10:53', 5, 653, 0),
(69, 7, '10:55', 5, 655, 0),
(70, 7, '11:30', 5, 690, 0),
(71, 7, '11:31', 5, 691, 0),
(72, 7, '11:33', 5, 693, 0),
(73, 7, '0:15', 5, 15, 0),
(74, 7, '11:34', 5, 694, 0),
(75, 7, '11:35', 5, 695, 0),
(76, 7, '11:36', 5, 696, 0),
(77, 7, '11:37', 5, 697, 0),
(78, 7, '11:38', 5, 698, 0),
(79, 7, '0:7', 5, 7, 0),
(80, 7, '11:47', 5, 707, 0),
(81, 7, '11:48', 5, 708, 0),
(82, 7, '11:53', 5, 713, 0),
(83, 7, '11:55', 5, 715, 0),
(84, 7, '0:18', 5, 18, 0),
(85, 7, '11:56', 5, 716, 0),
(86, 7, '11:58', 5, 718, 0),
(87, 7, '12:9', 5, 729, 0),
(88, 7, '12:11', 5, 731, 0),
(89, 7, '12:14', 5, 734, 0),
(90, 7, '12:19', 5, 739, 0),
(91, 7, '12:20', 5, 740, 0),
(92, 7, '12:25', 5, 745, 0),
(93, 7, '12:27', 5, 747, 0),
(94, 7, '12:40', 5, 760, 0),
(95, 7, '12:41', 5, 761, 0),
(96, 7, '12:42', 5, 762, 0),
(97, 7, '12:43', 5, 763, 0),
(98, 7, '12:44', 5, 764, 0),
(99, 7, '12:45', 5, 765, 0),
(100, 7, '0:19', 5, 19, 0),
(101, 7, '12:46', 5, 766, 0),
(102, 7, '12:47', 5, 767, 0),
(103, 7, '12:48', 5, 768, 0),
(104, 7, '12:49', 5, 769, 0),
(105, 7, '1:17', 5, 77, 0),
(106, 7, '1:18', 5, 78, 0),
(107, 7, '1:19', 5, 79, 0),
(108, 7, '1:21', 5, 81, 0),
(109, 7, '3:34', 5, 214, 0),
(110, 7, '0:11', 5, 11, 0),
(111, 7, '3:37', 5, 217, 0),
(112, 7, '3:38', 5, 218, 0),
(113, 7, '3:41', 5, 221, 0),
(114, 7, '3:42', 5, 222, 0),
(115, 7, '3:43', 5, 223, 0),
(116, 7, '3:44', 5, 224, 0),
(117, 7, '2:9', 5, 129, 0),
(118, 7, '3:46', 5, 226, 0),
(119, 7, '3:47', 5, 227, 0),
(120, 7, '3:50', 5, 230, 0),
(121, 7, '3:57', 5, 237, 0),
(122, 7, '0:24', 5, 24, 0),
(123, 7, '0:13', 5, 13, 0),
(124, 7, '4:53', 5, 293, 0),
(125, 7, '4:54', 5, 294, 0),
(126, 7, '4:55', 5, 295, 0),
(127, 7, '4:56', 5, 296, 0),
(128, 7, '0:3', 5, 3, 0),
(129, 7, '5:0', 5, 300, 0),
(130, 7, '5:3', 5, 303, 0),
(131, 7, '5:11', 5, 311, 0),
(132, 7, '2:10', 5, 130, 0),
(133, 7, '5:13', 5, 313, 0),
(134, 7, '5:14', 5, 314, 0),
(135, 7, '5:16', 5, 316, 0),
(136, 7, '5:18', 5, 318, 0),
(137, 7, '5:19', 5, 319, 0),
(138, 7, '5:20', 5, 320, 0),
(139, 7, '5:22', 5, 322, 0),
(140, 7, '5:36', 5, 336, 0),
(141, 7, '2:11', 5, 131, 0),
(142, 7, '0:4', 5, 4, 0),
(143, 7, '7:33', 5, 453, 0),
(144, 7, '7:34', 5, 454, 0),
(145, 7, '7:35', 5, 455, 0),
(146, 7, '7:57', 5, 477, 0),
(147, 7, '7:58', 5, 478, 0),
(148, 7, '7:59', 5, 479, 0),
(149, 7, '8:0', 5, 480, 0),
(150, 7, '8:1', 5, 481, 0),
(151, 7, '8:2', 5, 482, 0);

-- --------------------------------------------------------

--
-- Table structure for table `track_video`
--

CREATE TABLE `track_video` (
  `TrackV_ID` int(11) NOT NULL,
  `Track_ID` int(11) NOT NULL,
  `path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `track_video`
--

INSERT INTO `track_video` (`TrackV_ID`, `Track_ID`, `path`) VALUES
(1, 1, 'RTFD/Database/Clips/Track-1.mp4'),
(2, 2, 'RTFD/Database/Clips/Track-2.mp4'),
(3, 3, 'RTFD/Database/Clips/Track-3.mp4'),
(4, 4, 'RTFD/Database/Clips/Track-4.mp4'),
(5, 5, 'RTFD/Database/Clips/Track-5.mp4'),
(6, 6, 'RTFD/Database/Clips/Track-6.mp4'),
(7, 7, 'RTFD/Database/Clips/Track-7.mp4'),
(8, 8, 'RTFD/Database/Clips/Track-8.mp4'),
(9, 9, 'RTFD/Database/Clips/Track-9.mp4'),
(10, 10, 'RTFD/Database/Clips/Track-10.mp4'),
(11, 11, 'RTFD/Database/Clips/Track-11.mp4'),
(12, 12, 'RTFD/Database/Clips/Track-12.mp4'),
(13, 13, 'RTFD/Database/Clips/Track-13.mp4'),
(14, 14, 'RTFD/Database/Clips/Track-14.mp4'),
(15, 15, 'RTFD/Database/Clips/Track-15.mp4'),
(16, 16, 'RTFD/Database/Clips/Track-16.mp4'),
(17, 17, 'RTFD/Database/Clips/Track-17.mp4'),
(18, 18, 'RTFD/Database/Clips/Track-18.mp4'),
(19, 19, 'RTFD/Database/Clips/Track-19.mp4'),
(20, 20, 'RTFD/Database/Clips/Track-20.mp4'),
(21, 21, 'RTFD/Database/Clips/Track-21.mp4'),
(22, 22, 'RTFD/Database/Clips/Track-22.mp4'),
(23, 23, 'RTFD/Database/Clips/Track-23.mp4'),
(24, 24, 'RTFD/Database/Clips/Track-24.mp4'),
(25, 25, 'RTFD/Database/Clips/Track-25.mp4'),
(26, 26, 'RTFD/Database/Clips/Track-26.mp4'),
(27, 27, 'RTFD/Database/Clips/Track-27.mp4'),
(28, 28, 'RTFD/Database/Clips/Track-28.mp4'),
(29, 29, 'RTFD/Database/Clips/Track-29.mp4'),
(30, 30, 'RTFD/Database/Clips/Track-30.mp4'),
(31, 31, 'RTFD/Database/Clips/Track-31.mp4'),
(32, 32, 'RTFD/Database/Clips/Track-32.mp4'),
(33, 33, 'RTFD/Database/Clips/Track-33.mp4'),
(34, 34, 'RTFD/Database/Clips/Track-34.mp4'),
(35, 35, 'RTFD/Database/Clips/Track-35.mp4'),
(36, 36, 'RTFD/Database/Clips/Track-36.mp4'),
(37, 37, 'RTFD/Database/Clips/Track-37.mp4'),
(38, 38, 'RTFD/Database/Clips/Track-38.mp4'),
(39, 39, 'RTFD/Database/Clips/Track-39.mp4'),
(40, 40, 'RTFD/Database/Clips/Track-40.mp4'),
(41, 41, 'RTFD/Database/Clips/Track-41.mp4'),
(42, 42, 'RTFD/Database/Clips/Track-42.mp4'),
(43, 43, 'RTFD/Database/Clips/Track-43.mp4'),
(44, 44, 'RTFD/Database/Clips/Track-44.mp4'),
(45, 45, 'RTFD/Database/Clips/Track-45.mp4'),
(46, 46, 'RTFD/Database/Clips/Track-46.mp4'),
(47, 47, 'RTFD/Database/Clips/Track-47.mp4'),
(48, 48, 'RTFD/Database/Clips/Track-48.mp4'),
(49, 49, 'RTFD/Database/Clips/Track-49.mp4'),
(50, 50, 'RTFD/Database/Clips/Track-50.mp4'),
(51, 51, 'RTFD/Database/Clips/Track-51.mp4'),
(52, 52, 'RTFD/Database/Clips/Track-52.mp4'),
(53, 53, 'RTFD/Database/Clips/Track-53.mp4'),
(54, 54, 'RTFD/Database/Clips/Track-54.mp4'),
(55, 55, 'RTFD/Database/Clips/Track-55.mp4'),
(56, 56, 'RTFD/Database/Clips/Track-56.mp4'),
(57, 57, 'RTFD/Database/Clips/Track-57.mp4'),
(58, 58, 'RTFD/Database/Clips/Track-58.mp4'),
(59, 59, 'RTFD/Database/Clips/Track-59.mp4'),
(60, 60, 'RTFD/Database/Clips/Track-60.mp4'),
(61, 61, 'RTFD/Database/Clips/Track-61.mp4'),
(62, 62, 'RTFD/Database/Clips/Track-62.mp4'),
(63, 63, 'RTFD/Database/Clips/Track-63.mp4'),
(64, 64, 'RTFD/Database/Clips/Track-64.mp4'),
(65, 65, 'RTFD/Database/Clips/Track-65.mp4'),
(66, 66, 'RTFD/Database/Clips/Track-66.mp4'),
(67, 67, 'RTFD/Database/Clips/Track-67.mp4'),
(68, 68, 'RTFD/Database/Clips/Track-68.mp4'),
(69, 69, 'RTFD/Database/Clips/Track-69.mp4'),
(70, 70, 'RTFD/Database/Clips/Track-70.mp4'),
(71, 71, 'RTFD/Database/Clips/Track-71.mp4'),
(72, 72, 'RTFD/Database/Clips/Track-72.mp4'),
(73, 73, 'RTFD/Database/Clips/Track-73.mp4'),
(74, 74, 'RTFD/Database/Clips/Track-74.mp4'),
(75, 75, 'RTFD/Database/Clips/Track-75.mp4'),
(76, 76, 'RTFD/Database/Clips/Track-76.mp4'),
(77, 77, 'RTFD/Database/Clips/Track-77.mp4'),
(78, 78, 'RTFD/Database/Clips/Track-78.mp4'),
(79, 79, 'RTFD/Database/Clips/Track-79.mp4'),
(80, 80, 'RTFD/Database/Clips/Track-80.mp4'),
(81, 81, 'RTFD/Database/Clips/Track-81.mp4'),
(82, 82, 'RTFD/Database/Clips/Track-82.mp4'),
(83, 83, 'RTFD/Database/Clips/Track-83.mp4'),
(84, 84, 'RTFD/Database/Clips/Track-84.mp4'),
(85, 85, 'RTFD/Database/Clips/Track-85.mp4'),
(86, 86, 'RTFD/Database/Clips/Track-86.mp4'),
(87, 87, 'RTFD/Database/Clips/Track-87.mp4'),
(88, 88, 'RTFD/Database/Clips/Track-88.mp4'),
(89, 89, 'RTFD/Database/Clips/Track-89.mp4'),
(90, 90, 'RTFD/Database/Clips/Track-90.mp4'),
(91, 91, 'RTFD/Database/Clips/Track-91.mp4'),
(92, 92, 'RTFD/Database/Clips/Track-92.mp4'),
(93, 93, 'RTFD/Database/Clips/Track-93.mp4'),
(94, 94, 'RTFD/Database/Clips/Track-94.mp4'),
(95, 95, 'RTFD/Database/Clips/Track-95.mp4'),
(96, 96, 'RTFD/Database/Clips/Track-96.mp4'),
(97, 97, 'RTFD/Database/Clips/Track-97.mp4'),
(98, 98, 'RTFD/Database/Clips/Track-98.mp4'),
(99, 99, 'RTFD/Database/Clips/Track-99.mp4'),
(100, 100, 'RTFD/Database/Clips/Track-100.mp4'),
(101, 101, 'RTFD/Database/Clips/Track-101.mp4'),
(102, 102, 'RTFD/Database/Clips/Track-102.mp4'),
(103, 103, 'RTFD/Database/Clips/Track-103.mp4'),
(104, 104, 'RTFD/Database/Clips/Track-104.mp4'),
(105, 105, 'RTFD/Database/Clips/Track-105.mp4'),
(106, 106, 'RTFD/Database/Clips/Track-106.mp4'),
(107, 107, 'RTFD/Database/Clips/Track-107.mp4'),
(108, 108, 'RTFD/Database/Clips/Track-108.mp4'),
(109, 109, 'RTFD/Database/Clips/Track-109.mp4'),
(110, 110, 'RTFD/Database/Clips/Track-110.mp4'),
(111, 111, 'RTFD/Database/Clips/Track-111.mp4'),
(112, 112, 'RTFD/Database/Clips/Track-112.mp4'),
(113, 113, 'RTFD/Database/Clips/Track-113.mp4'),
(114, 114, 'RTFD/Database/Clips/Track-114.mp4'),
(115, 115, 'RTFD/Database/Clips/Track-115.mp4'),
(116, 116, 'RTFD/Database/Clips/Track-116.mp4'),
(117, 117, 'RTFD/Database/Clips/Track-117.mp4'),
(118, 118, 'RTFD/Database/Clips/Track-118.mp4'),
(119, 119, 'RTFD/Database/Clips/Track-119.mp4'),
(120, 120, 'RTFD/Database/Clips/Track-120.mp4'),
(121, 121, 'RTFD/Database/Clips/Track-121.mp4'),
(122, 122, 'RTFD/Database/Clips/Track-122.mp4'),
(123, 123, 'RTFD/Database/Clips/Track-123.mp4'),
(124, 124, 'RTFD/Database/Clips/Track-124.mp4'),
(125, 125, 'RTFD/Database/Clips/Track-125.mp4'),
(126, 126, 'RTFD/Database/Clips/Track-126.mp4'),
(127, 127, 'RTFD/Database/Clips/Track-127.mp4'),
(128, 128, 'RTFD/Database/Clips/Track-128.mp4'),
(129, 129, 'RTFD/Database/Clips/Track-129.mp4'),
(130, 130, 'RTFD/Database/Clips/Track-130.mp4'),
(131, 131, 'RTFD/Database/Clips/Track-131.mp4'),
(132, 132, 'RTFD/Database/Clips/Track-132.mp4'),
(133, 133, 'RTFD/Database/Clips/Track-133.mp4'),
(134, 134, 'RTFD/Database/Clips/Track-134.mp4'),
(135, 135, 'RTFD/Database/Clips/Track-135.mp4'),
(136, 136, 'RTFD/Database/Clips/Track-136.mp4'),
(137, 137, 'RTFD/Database/Clips/Track-137.mp4'),
(138, 138, 'RTFD/Database/Clips/Track-138.mp4'),
(139, 139, 'RTFD/Database/Clips/Track-139.mp4'),
(140, 140, 'RTFD/Database/Clips/Track-140.mp4'),
(141, 141, 'RTFD/Database/Clips/Track-141.mp4'),
(142, 142, 'RTFD/Database/Clips/Track-142.mp4'),
(143, 143, 'RTFD/Database/Clips/Track-143.mp4'),
(144, 144, 'RTFD/Database/Clips/Track-144.mp4'),
(145, 145, 'RTFD/Database/Clips/Track-145.mp4'),
(146, 146, 'RTFD/Database/Clips/Track-146.mp4'),
(147, 147, 'RTFD/Database/Clips/Track-147.mp4'),
(148, 148, 'RTFD/Database/Clips/Track-148.mp4'),
(149, 149, 'RTFD/Database/Clips/Track-149.mp4'),
(150, 150, 'RTFD/Database/Clips/Track-150.mp4'),
(151, 151, 'RTFD/Database/Clips/Track-151.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text,
  `Name` text NOT NULL,
  `Password` text NOT NULL,
  `Admin_Privileges` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `username`, `email`, `Name`, `Password`, `Admin_Privileges`) VALUES
(1, 'admin', 'admin@rtfd.com', 'Rashid', 'admin', 1),
(2, 'Rashid', 'rashidabbasi17@gmail.com', 'Rashid', 'hello123', 0),
(25, 'adminfsd', 'sdf', 'ds', 'admin', 0),
(26, 'test', 'test', 'test', 'test', 0),
(27, 'mareeba', 'm_areeba@hotmail.com', 'Areeba Malik', '2312', 0),
(28, 'mareeba1', 'm_areeba@hotmail.com', 'Areeba Malik', '1234', 0),
(29, 'Muhammad Sohail Khatri', 'abcd.com', 'muhammad.sohail.khatri', '111', 0),
(30, 'sup', 'dflkfjadsklf', 'test', 'kljfasd', 0),
(31, 'lol', 'fdjkl', 'dslkfj', 'dsjfkl', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_pictures`
--

CREATE TABLE `user_pictures` (
  `Picture_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_pictures`
--

INSERT INTO `user_pictures` (`Picture_ID`, `User_ID`, `Path`) VALUES
(3, 2, 'RTFD/Input/Users/rashid.jpg'),
(4, 1, 'RTFD\\Input\\Users\\admin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_videos`
--

CREATE TABLE `user_videos` (
  `Video_id` int(11) NOT NULL,
  `P_Check` int(11) NOT NULL,
  `A_Check` int(11) NOT NULL,
  `Path` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_videos`
--

INSERT INTO `user_videos` (`Video_id`, `P_Check`, `A_Check`, `Path`, `Timestamp`, `User_ID`) VALUES
(5, 1, 0, 'Input/Videos/User/Track-300.mp4', '2019-05-01 20:17:24', 2),
(6, 1, 0, 'Input/Videos/User/Track-298.mp4', '2019-05-01 20:17:26', 2),
(7, 1, 0, 'Input/Videos/User/Track-301.mp4', '2019-05-01 20:17:28', 2),
(8, 1, 0, 'Input/Videos/User/Track-305.mp4', '2019-05-01 20:17:30', 2),
(9, 1, 0, 'Input/Videos/User/video1.mp4', '2019-05-01 20:17:39', 2),
(10, 1, 0, 'Input/Videos/User/VID_20151023_115840139.mp4', '2019-05-01 20:36:03', 29),
(11, 1, 0, 'Input/Videos/User/VID-20151110-WA0013.mp4', '2019-05-01 20:24:32', 29);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `Video_ID` int(11) NOT NULL,
  `Camera_ID` int(11) NOT NULL,
  `P_Check` bit(1) NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Path` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`Video_ID`, `Camera_ID`, `P_Check`, `TimeStamp`, `Path`) VALUES
(1, 1, b'1', '2019-05-01 20:23:57', 'Input/Videos/Camera1\\Video5.mp4'),
(2, 2, b'1', '2019-05-01 20:16:19', 'Input/Videos/Camera2\\video1.mp4'),
(3, 2, b'1', '2019-05-01 20:16:21', 'Input/Videos/Camera2\\video2.mp4'),
(5, 2, b'1', '2019-05-01 20:47:52', 'Input/Videos/Camera2\\video3.mp4'),
(6, 1, b'1', '2019-05-01 20:16:27', 'Input/Videos/Camera1\\A SECRET BEHIND THE SCENE OF YTFF 2019.mp4'),
(7, 2, b'1', '2019-05-01 20:16:30', 'Input/Videos/Camera2\\Speaking A Made Up Language in England...mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `culprit`
--
ALTER TABLE `culprit`
  ADD PRIMARY KEY (`Culprit_ID`);

--
-- Indexes for table `culprit_pictures`
--
ALTER TABLE `culprit_pictures`
  ADD PRIMARY KEY (`Picture_ID`),
  ADD UNIQUE KEY `Culprit_ID` (`Culprit_ID`);

--
-- Indexes for table `surveillance_camera`
--
ALTER TABLE `surveillance_camera`
  ADD PRIMARY KEY (`Camera_ID`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`Track_ID`),
  ADD KEY `Culprit_ID` (`Culprit_ID`) USING BTREE;

--
-- Indexes for table `track_video`
--
ALTER TABLE `track_video`
  ADD PRIMARY KEY (`TrackV_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `user_pictures`
--
ALTER TABLE `user_pictures`
  ADD PRIMARY KEY (`Picture_ID`),
  ADD UNIQUE KEY `User_ID` (`User_ID`);

--
-- Indexes for table `user_videos`
--
ALTER TABLE `user_videos`
  ADD PRIMARY KEY (`Video_id`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`Video_ID`),
  ADD KEY `Camera_Reference` (`Camera_ID`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `culprit`
--
ALTER TABLE `culprit`
  MODIFY `Culprit_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `culprit_pictures`
--
ALTER TABLE `culprit_pictures`
  MODIFY `Picture_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `surveillance_camera`
--
ALTER TABLE `surveillance_camera`
  MODIFY `Camera_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `Track_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `track_video`
--
ALTER TABLE `track_video`
  MODIFY `TrackV_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_pictures`
--
ALTER TABLE `user_pictures`
  MODIFY `Picture_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_videos`
--
ALTER TABLE `user_videos`
  MODIFY `Video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `Video_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `culprit_pictures`
--
ALTER TABLE `culprit_pictures`
  ADD CONSTRAINT `culprit_pictures_ibfk_1` FOREIGN KEY (`Culprit_ID`) REFERENCES `culprit` (`Culprit_ID`);

--
-- Constraints for table `tracking`
--
ALTER TABLE `tracking`
  ADD CONSTRAINT `tracking_ibfk_1` FOREIGN KEY (`Culprit_ID`) REFERENCES `culprit` (`Culprit_ID`);

--
-- Constraints for table `track_video`
--
ALTER TABLE `track_video`
  ADD CONSTRAINT `track_video_ibfk_1` FOREIGN KEY (`Track_ID`) REFERENCES `tracking` (`Track_ID`);

--
-- Constraints for table `user_pictures`
--
ALTER TABLE `user_pictures`
  ADD CONSTRAINT `user_pictures_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`);

--
-- Constraints for table `user_videos`
--
ALTER TABLE `user_videos`
  ADD CONSTRAINT `user_videos_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`);

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`Camera_ID`) REFERENCES `surveillance_camera` (`Camera_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
