-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2026 at 07:56 AM
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
-- Table structure for table `upload_prescription`
--

CREATE TABLE `upload_prescription` (
  `id` int NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `upload_prescription`
--

INSERT INTO `upload_prescription` (`id`, `image`, `user_id`, `address`, `created_at`, `updated_at`) VALUES
(1, 'prescriptions/H9y6AIqpfRQMlnDu1DEwc0BrxJmRz8ueQO6rkN5q.png', 1, '1', '2026-07-03 01:40:17', '2026-07-03 01:40:17'),
(2, 'prescriptions/q7DnzW5mYo4Wm2rJDxkx5GTidEAQPx9fs8NkZOSn.png', 1, '1', '2026-07-03 01:41:13', '2026-07-03 01:41:13'),
(3, 'prescriptions/ypYTvk568UG1Dxkcd0gDynus317NdYHUq0R1tNmT.png', 1, '1', '2026-07-03 01:58:19', '2026-07-03 01:58:19'),
(4, 'prescription/NK168T8vwiUKZvxu3HFLPkpkrIqUHMcnSXx7Lw6Y.png', 1, 'golimar', '2026-07-03 02:38:51', '2026-07-03 02:38:51'),
(5, 'prescription/NK168T8vwiUKZvxu3HFLPkpkrIqUHMcnSXx7Lw6K.png', 1, 'golimar', '2026-07-03 02:39:15', '2026-07-03 02:39:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `upload_prescription`
--
ALTER TABLE `upload_prescription`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `upload_prescription`
--
ALTER TABLE `upload_prescription`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
