-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2025 at 05:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(5, 'abhisheksinghsci123@gmail.com', '$2y$10$hdEhUuyMKPWVreGlv234VeTXZyptzFUrV7Vq7WA/BYNSnf4ERjdWe', '0000-00-00', '2024-10-22 23:33:48');

-- --------------------------------------------------------

--
-- Table structure for table `update_info`
--

CREATE TABLE `update_info` (
  `Owner_name` varchar(30) NOT NULL,
  `Vehicle_name` varchar(30) NOT NULL,
  `Vehicle_number` varchar(30) NOT NULL,
  `Entry_date` varchar(30) NOT NULL,
  `Exit_date` datetime NOT NULL,
  `Token_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `update_info`
--

INSERT INTO `update_info` (`Owner_name`, `Vehicle_name`, `Vehicle_number`, `Entry_date`, `Exit_date`, `Token_number`) VALUES
('avi', 'suzuki', 'UP 83 AT 4083', '2022-02-03 23:56:00', '2022-02-04 19:56:00', 34);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Public User',
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'Abhishek', 'Abhi123', 'abhisheksinghsci123@gmail.com', '$2y$10$hdEhUuyMKPWVreGlv234VeTXZyptzFUrV7Vq7WA/BYNSnf4ERjdWe', 0, '2024-10-22 16:39:49', '2024-10-22 16:39:49'),
(5, 'Abhishek', 'Abhi1234', 'abhisheksinghsci1234@gmail.com', '$2y$10$tQfwK.D/5dWVzK6iz3mtNOQT/qVSYoMSYRnb4U36aDs9sztw3xPxy', 1, '2024-10-22 17:01:08', '2024-10-22 17:01:08'),
(6, 'Abhishek singh', 'Abhi@12345', 'abhisheksinghsci12@gmail.com', '$2y$10$mnu4gUxAZAR1Iz4QXDKxbuzyr5zgXPBoyb8LxM6iTGAVdQ9YJegEO', 0, '2024-10-22 17:03:49', '2024-10-22 17:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_info`
--

CREATE TABLE `vehicle_info` (
  `Owner_name` varchar(30) NOT NULL,
  `Vehicle_name` varchar(30) NOT NULL,
  `Vehicle_number` varchar(30) NOT NULL,
  `Entry_date` datetime NOT NULL,
  `Token_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_info`
--

INSERT INTO `vehicle_info` (`Owner_name`, `Vehicle_name`, `Vehicle_number`, `Entry_date`, `Token_number`) VALUES
('abhishek kumar', 'suzuki', 'UP 83 AT 4083', '2022-03-06 22:03:00', 22);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
