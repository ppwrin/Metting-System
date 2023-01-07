-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jan 07, 2023 at 08:31 PM
-- Server version: 10.3.24-MariaDB-1:10.3.24+maria~focal
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meeting`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `book_start_date` timestamp NULL DEFAULT NULL,
  `book_end_date` timestamp NULL DEFAULT NULL,
  `book_status` int(11) NOT NULL DEFAULT 1 COMMENT '1: waiting, 2: approve\r\n',
  `users_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`book_id`, `room_id`, `book_start_date`, `book_end_date`, `book_status`, `users_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2023-01-10 09:00:00', '2023-01-12 12:00:00', 2, 1, '2023-01-07 20:21:41', '2023-01-07 20:21:41'),
(2, 2, '2023-01-13 03:00:00', '2023-02-13 03:00:00', 1, 1, '2023-01-07 20:15:49', NULL),
(3, 2, '2023-01-14 03:00:00', '2023-01-20 03:00:00', 1, 1, '2023-01-07 20:16:19', NULL),
(4, 2, '2023-01-27 03:00:00', '2023-01-28 03:00:00', 1, 1, '2023-01-07 20:16:31', NULL),
(5, 2, '2023-02-02 03:00:00', '2023-02-17 03:00:00', 1, 1, '2023-01-07 20:16:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(10) NOT NULL,
  `room_img` longtext NOT NULL,
  `room_name` varchar(50) NOT NULL,
  `room_status` int(1) NOT NULL DEFAULT 1 COMMENT '1.จอง 2.ไม่ถูกจอง',
  `room_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_img`, `room_name`, `room_status`, `room_details`) VALUES
(1, 'public/img/r6.jpg', 'ห้องประชุมขนาดเล็ก', 1, 'สำหรับจำนวนคนสูงสุด 8 คน'),
(2, 'public/img/room15.jpg', 'ห้องประชุมขนาดกลาง', 1, 'สำหรับจำนวนคนสูงสุด 15 คน'),
(3, 'public/img/room20.jpg', 'ห้องประชุมขนาดใหญ่', 1, 'สำหรับจำนวนคนสูงสุด 30 คน');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `firstname`, `lastname`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'panupong', 'klueakaew', 'panupong.kl@gmail.com', '$2y$10$8g23TPSh1LcoYblDbFlbF.dr3hVv/ExFv692vLOlm7XRot4SReIMq', 2, '2023-01-07 20:23:14', '2023-01-08 03:23:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
