-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2026 at 07:57 AM
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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_data_for_otp`
--

INSERT INTO `user_data_for_otp` (`id`, `name`, `email`, `phone_number`, `otp`, `created_at`, `updated_at`) VALUES
(2, 'Vladimir Best', 'cijud@mailinator.com', '0321-6905568', '61904', '2026-07-02 06:29:42', '2026-07-02 06:29:42'),
(3, 'Felix Burch', 'ralaboqyd@mailinator.com', '0321-6905568', '1234', '2026-07-02 06:30:20', '2026-07-02 06:30:20'),
(4, 'Doris Pate', 'sopyvu@mailinator.com', '0321-6905569', '1234', '2026-07-02 06:37:27', '2026-07-02 06:37:27'),
(5, 'Emmanuel Langley', 'qykoc@mailinator.com', '0321-6904458', '1234', '2026-07-02 06:38:43', '2026-07-02 06:38:43'),
(6, 'Eugenia Hahn', 'suwihu@mailinator.com', '0321-4444444', '1234', '2026-07-02 06:42:09', '2026-07-02 06:42:09'),
(7, 'Zena Pena', 'haqo@mailinator.com', '0321-6905588', '1234', '2026-07-02 06:46:40', '2026-07-02 06:46:40'),
(8, 'Dane Gomez', 'copove@mailinator.com', '0321-6905777', '1234', '2026-07-02 06:48:01', '2026-07-02 06:48:01'),
(9, 'Urielle Watson', 'wunovyjasa@mailinator.com', '0321-5545578', '1234', '2026-07-02 06:52:03', '2026-07-02 06:52:03'),
(10, 'Dominic Chase', 'jalyno@mailinator.com', '0321-5554875', '1234', '2026-07-02 06:54:01', '2026-07-02 06:54:01'),
(11, 'Inga Whitfield', 'bufupukot@mailinator.com', '0324-5878888', '1234', '2026-07-02 06:59:38', '2026-07-02 06:59:38'),
(12, 'Cole Gonzales', 'hopekurym@mailinator.com', '0324-5875555', '1234', '2026-07-03 01:01:39', '2026-07-03 01:01:39');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
