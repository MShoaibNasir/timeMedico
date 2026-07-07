-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2026 at 12:03 PM
-- Server version: 9.3.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `times_medico`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_data_for_otp`
--

CREATE TABLE `user_data_for_otp` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `otp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fcmToken` varchar(255) DEFAULT NULL,
  `deviceId` varchar(255) DEFAULT NULL,
  `phoneModel` varchar(255) DEFAULT NULL,
  `phoneMake` varchar(255) DEFAULT NULL,
  `appVersion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_data_for_otp`
--

INSERT INTO `user_data_for_otp` (`id`, `name`, `email`, `phone_number`, `otp`, `fcmToken`, `deviceId`, `phoneModel`, `phoneMake`, `appVersion`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Shoaib Nasir', 'shoaibnasir315@gmail.com', '0321-6905568', '1234', NULL, NULL, NULL, NULL, NULL, '2026-07-03 06:20:36', '2026-07-03 06:20:36'),
(2, 'Gage Smith', 'shoaibnasir315@gmail.com', '0321-4555555', '1234', NULL, NULL, NULL, NULL, NULL, '2026-07-03 06:46:35', '2026-07-03 06:46:35'),
(3, 'Shannon Peterson', 'shoaibnasir315@gmail.com', '0321-6905568', '1234', NULL, NULL, NULL, NULL, NULL, '2026-07-03 06:47:09', '2026-07-03 06:47:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_data_for_otp`
--
ALTER TABLE `user_data_for_otp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_data_for_otp`
--
ALTER TABLE `user_data_for_otp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
