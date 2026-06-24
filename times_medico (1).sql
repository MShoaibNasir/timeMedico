-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 24, 2026 at 09:49 AM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_session` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `user_code`, `email`, `email_verified_at`, `password`, `remember_token`, `last_session`, `isactive`, `is_admin`, `deleted_at`, `deleted_by`, `created_at`, `updated_at`) VALUES
(1, 'Shoaib nasir', NULL, 'shoaibnasir315@gmail.com', NULL, '$2y$12$GDpc7LWONt5m/A1RHVDJY.y/clx9jbGrN0HD1q6oo1jGmI6c3a83C', NULL, NULL, 1, 0, NULL, NULL, '2025-07-07 07:23:04', '2025-07-07 07:23:04'),
(2, 'Charlotte Jensen', 'Aliquip qui ipsam al', 'timikyfyn@mailinator.com', NULL, '$2y$12$z9dT69Xjz0SIaGCtTmZBXuG/jJW.kSNwYJ9u3yZt/4GMvw3HS9uNq', NULL, NULL, 1, 0, '2026-06-18 06:41:27', NULL, '2026-01-19 02:25:28', '2026-06-18 06:41:27'),
(3, 'talha', '0224', 'talhanasir315@gmail.com', NULL, '$2y$12$rd0SAb9.4y2ObgaXm9Mv2uuU1mt/D4G0Ph5C4apKygLR5FSZiEm8C', NULL, NULL, 1, 0, NULL, NULL, '2026-06-19 00:49:57', '2026-06-19 00:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:14:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:12:\"admin-create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:10:\"admin-edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:12:\"admin-delete\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:10:\"admin-list\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"role-create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:9:\"role-edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:11:\"role-delete\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:9:\"role-list\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:14:\"permission-add\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:15:\"permission-edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:17:\"permission-delete\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:15:\"permission-list\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:15:\"category-create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:13:\"category-list\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:1:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"super_admin\";s:1:\"c\";s:5:\"admin\";}}}', 1782373292);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  `department_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `name`, `image`, `status`, `department_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 32, 'test 123', 'test', 1, NULL, NULL, '2026-06-19 05:38:49', '2026-06-19 05:38:49'),
(3, NULL, 'Kiayada Pickett', NULL, 0, NULL, '2026-06-19 05:45:00', '2026-06-19 05:45:19', '2026-06-19 05:45:19'),
(4, NULL, 'Kiayada Pickett 123', NULL, 1, NULL, '2026-06-19 05:45:16', '2026-06-19 05:45:28', '2026-06-19 05:45:28'),
(5, NULL, 'test', NULL, 1, NULL, '2026-06-19 06:54:04', '2026-06-19 06:54:04', NULL),
(6, NULL, 'Calvin Conley', NULL, 0, 2, '2026-06-19 06:55:07', '2026-06-19 06:55:18', '2026-06-19 06:55:18'),
(7, NULL, 'Quin Booth', NULL, 0, 2, '2026-06-19 06:59:39', '2026-06-19 07:03:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test', NULL, 1, '2026-06-19 05:38:42', '2026-06-19 05:40:38', '2026-06-19 05:40:38'),
(2, 'Britanney Avila 123', NULL, 1, '2026-06-19 05:40:48', '2026-06-19 05:46:21', NULL),
(3, 'testing data', NULL, 1, '2026-06-19 07:03:25', '2026-06-19 07:03:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `home_sliders`
--

CREATE TABLE `home_sliders` (
  `id` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `admin_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `home_sliders`
--

INSERT INTO `home_sliders` (`id`, `image`, `status`, `admin_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'homeslider/Em7hHWOhUsTvs9nm67Zun3u2ZirzH7TXRX6eaoFj.jpg', 1, 1, '2026-06-24 04:15:46', '2026-06-24 04:24:21', NULL),
(3, 'homeslider/yQZxuHQz9JAkgMtxmFl2zBJuDYs6Nb4K2WacSLUB.jpg', 1, 1, '2026-06-24 04:24:44', '2026-06-24 04:24:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_05_05_053403_create_admins_table', 1),
(4, '2025_06_03_112840_create_permission_tables', 1),
(5, '2025_06_10_044227_create_personal_access_tokens_table', 1),
(6, '2025_06_10_092430_educations', 1),
(7, '2025_06_10_123039_skills', 1),
(8, '2025_06_13_113324_dtp_v1', 1),
(9, '2025_06_16_045652_libraryv1', 1),
(10, '2025_06_16_094227_users', 1),
(11, '2025_06_16_094945_bio_profile', 1),
(12, '2025_06_16_114930_professional_experience', 1),
(13, '2025_06_16_122439_countries', 1),
(14, '2025_06_17_052736_directorships', 1),
(15, '2025_06_17_101254_board_committee_members', 1),
(16, '2025_06_17_110348_additional_certificate', 1),
(17, '2025_06_17_115017_publications', 1),
(18, '2025_06_17_120234_award', 1),
(19, '2025_06_20_111534_events', 1),
(20, '2025_06_27_121118_quorum', 1),
(21, '2025_07_09_051006_communication', 2),
(22, '2025_08_07_094115_create_products_table', 3),
(23, '2025_08_07_094202_create_categories_table', 3),
(24, '2025_08_07_094228_create_category_product_table', 3),
(25, '2025_11_21_075122_create_user_skill_table', 4),
(26, '2026_01_29_113345_add_is_paid_to_users_table', 5),
(27, '2026_01_30_054901_create_payment_histories_table', 6),
(28, '2026_02_02_123613_create_contact_forms_table', 7),
(29, '2026_02_23_041508_refresh_your_dtp', 8),
(30, '2026_02_16_103611_create_forum_table', 9),
(31, '2026_06_19_054831_add_admin_id_to_products_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1),
(1, 'App\\Models\\Admin', 3);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin-create', 'admin', '2025-07-07 07:23:04', '2025-07-07 07:23:04'),
(2, 'admin-edit', 'admin', '2025-07-07 07:23:04', '2025-07-07 07:23:04'),
(3, 'admin-delete', 'admin', '2025-07-07 07:23:04', '2025-07-07 07:23:04'),
(4, 'admin-list', 'admin', '2025-07-07 07:23:04', '2025-07-07 07:23:04'),
(5, 'role-create', 'admin', '2025-07-07 07:23:04', '2025-07-07 07:23:04'),
(6, 'role-edit', 'admin', '2025-07-07 07:23:04', '2025-07-07 07:23:04'),
(7, 'role-delete', 'admin', '2025-07-07 07:23:04', '2025-07-07 07:23:04'),
(8, 'role-list', 'admin', '2025-07-07 07:23:04', '2025-07-07 07:23:04'),
(9, 'permission-add', 'admin', '2025-07-07 07:23:04', '2025-07-07 07:23:04'),
(10, 'permission-edit', 'admin', '2025-07-07 07:23:04', '2025-07-07 07:23:04'),
(11, 'permission-delete', 'admin', '2025-07-07 07:23:04', '2025-07-07 07:23:04'),
(12, 'permission-list', 'admin', '2025-07-07 07:23:04', '2025-07-07 07:23:04'),
(16, 'category-create', 'admin', '2026-06-18 06:40:44', '2026-06-18 06:40:44'),
(17, 'category-list', 'admin', '2026-06-18 06:40:56', '2026-06-18 06:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Admin', 1, 'PICG', '7e30b1aadc89e37684e9192c12496ffb310a3989ca4e90fae89939f405aa4e01', '[\"*\"]', NULL, NULL, '2025-07-07 07:23:55', '2025-07-07 07:23:55'),
(2, 'App\\Models\\Admin', 1, 'PICG', '536e54f677758ef1f6285d4280a65ea3d1439aba6ea59492fccf39a8b2e1d4de', '[\"*\"]', NULL, NULL, '2025-07-07 07:38:31', '2025-07-07 07:38:31'),
(3, 'App\\Models\\Admin', 1, 'PICG', 'bfc069b17a3748191789b0e8060062f9209bb36e796466c12395cd6b5dd67b40', '[\"*\"]', NULL, NULL, '2025-07-07 07:50:38', '2025-07-07 07:50:38'),
(4, 'App\\Models\\Admin', 1, 'PICG', '49c51a09fc336617a8bae5453f228e3f5063d96912baf0539dd02d7e98688373', '[\"*\"]', NULL, NULL, '2025-07-07 08:00:49', '2025-07-07 08:00:49'),
(5, 'App\\Models\\Admin', 1, 'PICG', 'e6ca6f492acaee7e39f0c19da031d3eeffeb8fff5f629d6d3b69edfd6b039392', '[\"*\"]', '2025-07-08 07:28:42', NULL, '2025-07-07 23:30:17', '2025-07-08 07:28:42'),
(6, 'App\\Models\\User', 2, 'PICG', '3ed15026d736261cf319bd9ad6607f4d2fb4615940482bffa77c603c0b21443a', '[\"*\"]', NULL, NULL, '2025-07-08 00:48:02', '2025-07-08 00:48:02'),
(7, 'App\\Models\\Admin', 1, 'PICG', 'cd282b027674e04b09daa7921b2b301c5a9c1f51e3f9c7da245b4d5d0ccf1ddd', '[\"*\"]', NULL, NULL, '2025-07-08 02:30:41', '2025-07-08 02:30:41'),
(8, 'App\\Models\\Admin', 1, 'PICG', 'd5f94dfb2ea56c8b99851a7320ffef91ffcd3c5be9d88dc00a2fbd01ea33ee4b', '[\"*\"]', '2025-07-09 02:39:27', NULL, '2025-07-09 01:44:02', '2025-07-09 02:39:27'),
(9, 'App\\Models\\Admin', 1, 'PICG', 'a9749d8e27074ed399b390bda24de557774fa3da51952d990e6a4259219a1026', '[\"*\"]', NULL, NULL, '2025-10-05 23:37:50', '2025-10-05 23:37:50'),
(10, 'App\\Models\\User', 3, 'PICG', '9b831562cade213dd372162421f3a7615ee732ae667e3834d45190d1c6040759', '[\"*\"]', NULL, NULL, '2025-10-06 00:27:29', '2025-10-06 00:27:29'),
(11, 'App\\Models\\User', 18, 'PICG', 'aed981662faa9585b4749f56b3ad7b90bd6b869f2cbd6d25ac81fdddb8c714f4', '[\"*\"]', NULL, NULL, '2025-11-03 05:54:56', '2025-11-03 05:54:56'),
(12, 'App\\Models\\User', 18, 'PICG', '90814309d0f612c93c912b828f81db78250c4c36f378f0957778a53700829d97', '[\"*\"]', NULL, NULL, '2025-11-03 06:04:06', '2025-11-03 06:04:06'),
(13, 'App\\Models\\User', 19, 'PICG', '76fd5ac08938a0b8a9fa0c5d154708f509c60f39d3fa9c2cf2bfb28858fa5d17', '[\"*\"]', NULL, NULL, '2025-11-03 06:24:42', '2025-11-03 06:24:42'),
(14, 'App\\Models\\User', 19, 'PICG', 'da251e8e94f14611c17e87df42b0e245801f713d130dd3d18464ac6de64fdbe1', '[\"*\"]', NULL, NULL, '2025-11-03 07:52:35', '2025-11-03 07:52:35'),
(15, 'App\\Models\\User', 19, 'PICG', '8c39a46f4092ed55a7f49852d14ee79a5461d68f32399ea5650041e1548b09cf', '[\"*\"]', NULL, NULL, '2025-11-04 01:08:44', '2025-11-04 01:08:44'),
(16, 'App\\Models\\User', 20, 'PICG', 'eba15f57e91f504fec2cbab2088c4464c5167dd488733d8c9af5ac61222c3c48', '[\"*\"]', NULL, NULL, '2025-11-04 04:41:54', '2025-11-04 04:41:54'),
(17, 'App\\Models\\User', 21, 'PICG', '64ca1d6cea93569a64f3b20f20f34f06d821a0c87f65d29babede73f33780903', '[\"*\"]', NULL, NULL, '2025-11-04 05:41:17', '2025-11-04 05:41:17'),
(18, 'App\\Models\\User', 21, 'PICG', 'b756b0c08c297efe4101bdb160c4f9643214c5f321530a684cf510512219884a', '[\"*\"]', NULL, NULL, '2025-11-04 05:41:18', '2025-11-04 05:41:18'),
(19, 'App\\Models\\User', 19, 'PICG', '209414d14a324ca86bb86411e8efa067220c9369c40bdfb8cdc1b3711e97498f', '[\"*\"]', NULL, NULL, '2025-11-04 05:55:41', '2025-11-04 05:55:41'),
(20, 'App\\Models\\User', 19, 'PICG', '9a6b5a3322947040fc5e69df8feb2326cb671767be271c30605858a9f39e72aa', '[\"*\"]', NULL, NULL, '2025-11-04 06:06:08', '2025-11-04 06:06:08'),
(21, 'App\\Models\\User', 19, 'PICG', '1c5fa7e3bd6dddd9b0ad703c7dfc227619a4679e4738b0dce036a2b9e093e726', '[\"*\"]', NULL, NULL, '2025-11-04 06:17:40', '2025-11-04 06:17:40'),
(22, 'App\\Models\\User', 19, 'PICG', '20e7acde1a865aa9becff74c23eac6146d4847f1a1493abe89909eca30719c29', '[\"*\"]', NULL, NULL, '2025-11-04 06:32:18', '2025-11-04 06:32:18'),
(23, 'App\\Models\\User', 19, 'PICG', '0483b7a0aa348e4a850ec881b61986ab590ae22a00f303dbd1a7c910c2fd9d8d', '[\"*\"]', NULL, NULL, '2025-11-04 06:32:37', '2025-11-04 06:32:37'),
(24, 'App\\Models\\User', 19, 'PICG', '45fc546b3d54dbc5fea8f510381bcf9a99f60d4f5900016666902809fc0dd53f', '[\"*\"]', NULL, NULL, '2025-11-05 00:45:34', '2025-11-05 00:45:34'),
(25, 'App\\Models\\User', 19, 'PICG', '9551698aa92051605cf5d2e81a82ddb389833ff186fad1fdaf0095fe34206855', '[\"*\"]', NULL, NULL, '2025-11-05 00:53:34', '2025-11-05 00:53:34'),
(26, 'App\\Models\\User', 19, 'PICG', '72e13a5aa0b098592dcd48821187a66a8297b7d7b0cd93661b27c0662d484c68', '[\"*\"]', NULL, NULL, '2025-11-05 01:14:33', '2025-11-05 01:14:33'),
(27, 'App\\Models\\User', 19, 'PICG', 'c1b44b309081b9101143123a4329b23dbc3bb2bd67ef8b735b2ca8a6e362e0bf', '[\"*\"]', NULL, NULL, '2025-11-05 23:57:19', '2025-11-05 23:57:19'),
(28, 'App\\Models\\User', 19, 'PICG', '3b381d50dd5b661c6f57e298ed229ad04a85d3095ff4af7ec71846e0ec16736b', '[\"*\"]', NULL, NULL, '2025-11-06 02:41:22', '2025-11-06 02:41:22'),
(29, 'App\\Models\\User', 19, 'PICG', '506a3f3fd61a8bc1e352caa55dcc46df52e0fa41959f3afa7c1aee84d63b2a41', '[\"*\"]', NULL, NULL, '2025-11-06 02:44:09', '2025-11-06 02:44:09'),
(30, 'App\\Models\\User', 19, 'PICG', 'e34952b0a03ce3374ca73c1eb678f014a01b24d18a3b8faa9b0d28f483e271b0', '[\"*\"]', NULL, NULL, '2025-11-06 23:23:42', '2025-11-06 23:23:42'),
(31, 'App\\Models\\User', 19, 'PICG', '1e0bf08ec0abcdcd9bb51bfdd9106c9336338ef5ea4dfa35791524ddad82302e', '[\"*\"]', NULL, NULL, '2025-11-06 23:28:05', '2025-11-06 23:28:05'),
(32, 'App\\Models\\User', 19, 'PICG', 'f2c8097ddf482de997dacb1fe328cda6c2c86334ffebc07ce5adbd9bca1a7147', '[\"*\"]', NULL, NULL, '2025-11-07 08:08:12', '2025-11-07 08:08:12'),
(33, 'App\\Models\\User', 19, 'PICG', '0afab874b89048ddc4be697edf25bd5cad532ad2b69999aa3254bb8ca21748b8', '[\"*\"]', NULL, NULL, '2025-11-09 23:59:01', '2025-11-09 23:59:01'),
(34, 'App\\Models\\User', 19, 'PICG', 'f8e1e512ded8d220bdb3617113e29e58781a7b231b9b0ff6c0e7250adcb10ddf', '[\"*\"]', NULL, NULL, '2025-11-10 00:00:22', '2025-11-10 00:00:22'),
(35, 'App\\Models\\User', 19, 'PICG', 'd9d7d8686de1c0880ab931d8fd7ac23415330ef7529368ac0997bf1bd3dcd95e', '[\"*\"]', NULL, NULL, '2025-11-10 02:54:20', '2025-11-10 02:54:20'),
(36, 'App\\Models\\User', 19, 'PICG', '0c82fba0aae3ebe3ceb8d411913146c9defb956246c5ab1e2593dc870d922494', '[\"*\"]', NULL, NULL, '2025-11-10 05:56:34', '2025-11-10 05:56:34'),
(37, 'App\\Models\\User', 29, 'PICG', '90ab42d6c7ffcbf09320973238448ddd56ab3eed538d18ee7cd60350ed885e1d', '[\"*\"]', NULL, NULL, '2025-11-10 05:58:21', '2025-11-10 05:58:21'),
(38, 'App\\Models\\User', 29, 'PICG', '248890d0b50d8eaf8cbbf7ed7ca4c23e5f0b8e66278bfe6fbb355b8433a7469e', '[\"*\"]', NULL, NULL, '2025-11-10 06:36:59', '2025-11-10 06:36:59'),
(39, 'App\\Models\\User', 30, 'PICG', 'e2c63083d8127129d79cf1cb8906fca68f50899c3d0bd5fba8ca6ca4c249c538', '[\"*\"]', NULL, NULL, '2025-11-11 00:31:52', '2025-11-11 00:31:52'),
(40, 'App\\Models\\User', 29, 'PICG', '1882beb36fe51c38d26324ef12368094450f6a7c6cbf52c6ed8769ced931233c', '[\"*\"]', NULL, NULL, '2025-11-11 01:46:28', '2025-11-11 01:46:28'),
(41, 'App\\Models\\User', 29, 'PICG', '0c15169e298b1fde0099e8731420f3be6360e59cae306dfc1497e5161dc31ee9', '[\"*\"]', NULL, NULL, '2025-11-12 00:30:28', '2025-11-12 00:30:28'),
(42, 'App\\Models\\User', 29, 'PICG', '608156ff1eeb752bb74d7c48455d207afaec0174764da7c7d0d6d8c32724ec3f', '[\"*\"]', NULL, NULL, '2025-11-12 02:56:22', '2025-11-12 02:56:22'),
(43, 'App\\Models\\User', 29, 'PICG', '85591bfad51aa7eea8c89b62b4c337f73db905e1626ec06c2a5e7d53d70a2041', '[\"*\"]', NULL, NULL, '2025-11-12 06:24:08', '2025-11-12 06:24:08'),
(44, 'App\\Models\\User', 30, 'PICG', '70aee56c868d9755afe5c264ca0a6833cbee938d179092cbbf10b5a2d430245d', '[\"*\"]', NULL, NULL, '2025-11-13 00:51:44', '2025-11-13 00:51:44'),
(45, 'App\\Models\\User', 30, 'PICG', 'a809746a98237e7eaccf6e03837cb75bfafa4a639fa7d414399ebff946064085', '[\"*\"]', NULL, NULL, '2025-11-14 00:10:15', '2025-11-14 00:10:15'),
(46, 'App\\Models\\User', 29, 'PICG', 'bf2cf4fa5570c0dcfee4d8123c0cf183aaee5b934806e6f64ef0902358dc6b93', '[\"*\"]', NULL, NULL, '2025-11-16 23:48:48', '2025-11-16 23:48:48'),
(47, 'App\\Models\\User', 29, 'PICG', 'e73f6945b1319004492d1e9c6269fd0ceb8bb62b73e865c584bafa1189c3a771', '[\"*\"]', NULL, NULL, '2025-11-18 01:29:21', '2025-11-18 01:29:21'),
(48, 'App\\Models\\User', 29, 'PICG', '84c0d7bf6ea4ac9a514082f5b7259e17838d20667585bfa54c1c9405e2a48693', '[\"*\"]', NULL, NULL, '2025-11-19 00:20:15', '2025-11-19 00:20:15'),
(49, 'App\\Models\\User', 29, 'PICG', 'd4a6591d29d1742fd49371e315f853e4b3a43922da298139d1d601e54939f538', '[\"*\"]', NULL, NULL, '2025-11-20 23:46:14', '2025-11-20 23:46:14'),
(50, 'App\\Models\\Admin', 1, 'PICG', '4a498144e6ceeef6a47cb709652b4ee7a1c1cfb7df287992795656b9936015a8', '[\"*\"]', NULL, NULL, '2025-11-21 02:27:32', '2025-11-21 02:27:32'),
(51, 'App\\Models\\User', 29, 'PICG', '719fccde6b2c2ce0ee4a61f8b4a02dba10067c85fcac4a272d4fbc99bd1ce3c6', '[\"*\"]', NULL, NULL, '2025-11-21 02:45:39', '2025-11-21 02:45:39'),
(52, 'App\\Models\\User', 29, 'PICG', '146de0121271d6598077b96e8204ff27b0115cda02bdc4154c282a8f656c70c9', '[\"*\"]', NULL, NULL, '2025-11-24 00:58:18', '2025-11-24 00:58:18'),
(53, 'App\\Models\\Admin', 1, 'PICG', 'a915509f20b730795a4fbd75499bdedad62fab9d8e39088c1a8409485be52a1a', '[\"*\"]', NULL, NULL, '2025-12-01 06:24:23', '2025-12-01 06:24:23'),
(54, 'App\\Models\\User', 29, 'PICG', '5657a44f182878e27a129c53a6ae9c4a79a811eadaece86c0b9c860ed2810852', '[\"*\"]', NULL, NULL, '2025-12-30 02:18:21', '2025-12-30 02:18:21'),
(55, 'App\\Models\\User', 29, 'PICG', 'dc4741c78f775cd1bd2c0be24c147e84aa55f061e4f4db698d9e4af26ab8f544', '[\"*\"]', NULL, NULL, '2025-12-30 06:07:26', '2025-12-30 06:07:26'),
(56, 'App\\Models\\User', 29, 'PICG', '8103c3986d1c9024c551f21574b5a99f6b4d8a81f024da5b6a2262624016c24d', '[\"*\"]', NULL, NULL, '2026-01-01 04:26:38', '2026-01-01 04:26:38'),
(57, 'App\\Models\\User', 29, 'PICG', '1fcdab218f91e2bb832b92734cab0405d6affa25b164c71fc8371b57913f95b8', '[\"*\"]', NULL, NULL, '2026-01-01 07:11:31', '2026-01-01 07:11:31'),
(58, 'App\\Models\\Admin', 1, 'PICG', '5b728e0c6a87cbd25368d654ca43a8fa9e0ed36ff2b40020b4ad763dbb595d1e', '[\"*\"]', NULL, NULL, '2026-01-02 00:15:39', '2026-01-02 00:15:39'),
(59, 'App\\Models\\User', 29, 'PICG', 'ef180cb25e5cc8dde20b4455e6673c7788ee548f126dccee322b09e804420b45', '[\"*\"]', NULL, NULL, '2026-01-02 05:08:26', '2026-01-02 05:08:26'),
(60, 'App\\Models\\User', 29, 'PICG', '7b3e22bfc9d139d66760f43e47dc6724e7b7f861fb482e94653cce94dde5a0f6', '[\"*\"]', NULL, NULL, '2026-01-06 00:26:43', '2026-01-06 00:26:43'),
(61, 'App\\Models\\User', 29, 'PICG', '7e5e1a17f6f30bd3bfdd1b0083a57ba7d05c49dec02da239b5743863fe8006aa', '[\"*\"]', NULL, NULL, '2026-01-06 04:02:58', '2026-01-06 04:02:58'),
(62, 'App\\Models\\User', 29, 'PICG', 'f880e1085a550736bbdb243228aed92a1326645da34d6f425de2bd2c34dbe23c', '[\"*\"]', NULL, NULL, '2026-01-16 01:27:12', '2026-01-16 01:27:12'),
(63, 'App\\Models\\Admin', 1, 'PICG', 'f84d92b29ad0f8786bc16bfc44ca082539ef212994792f85357b91b4eadfa071', '[\"*\"]', NULL, NULL, '2026-01-16 02:19:08', '2026-01-16 02:19:08'),
(64, 'App\\Models\\Admin', 1, 'PICG', '5e0ef692616eff93824dde38795948eb3570350e8fae4f52d74a063ba5f19f2e', '[\"*\"]', NULL, NULL, '2026-01-16 05:24:23', '2026-01-16 05:24:23'),
(65, 'App\\Models\\User', 29, 'PICG', 'd40dfba412563f49dd93d61d2bf8eb8f1a801734ba0195e0eb5fd60b1668e04c', '[\"*\"]', NULL, NULL, '2026-01-16 05:57:19', '2026-01-16 05:57:19'),
(66, 'App\\Models\\User', 29, 'PICG', '4d2a45c9f9cfb2569bea26b00c735acc4e13dbda2248402abb94dbca6d618327', '[\"*\"]', NULL, NULL, '2026-01-16 06:00:25', '2026-01-16 06:00:25'),
(67, 'App\\Models\\Admin', 1, 'PICG', '4569d4af11cd31dff1c2574c8620a6fe84bed44c41eadc0fe5399922499688d4', '[\"*\"]', NULL, NULL, '2026-01-16 06:04:28', '2026-01-16 06:04:28'),
(68, 'App\\Models\\Admin', 1, 'PICG', '742302b57915ff9521acaaf4fbc455b0709061488b059887907c5a105eeb4e7f', '[\"*\"]', NULL, NULL, '2026-01-18 23:51:29', '2026-01-18 23:51:29'),
(69, 'App\\Models\\User', 29, 'PICG', 'e8057f6e56fb6c944a932b4d4f8bf6de0f95a030374509ca5ec85d30705f063a', '[\"*\"]', NULL, NULL, '2026-01-19 01:08:08', '2026-01-19 01:08:08'),
(70, 'App\\Models\\Admin', 1, 'PICG', 'ea10ccb5a75e510f5e65a1b155b64673b56e594a67e7e2a9a531c92a4498668d', '[\"*\"]', NULL, NULL, '2026-01-19 02:06:31', '2026-01-19 02:06:31'),
(71, 'App\\Models\\Admin', 2, 'PICG', '2d324c3b789a6d3935be3d1685f383427f33cd9cf76e90f149747151947a5918', '[\"*\"]', NULL, NULL, '2026-01-19 02:25:47', '2026-01-19 02:25:47'),
(72, 'App\\Models\\Admin', 2, 'PICG', '84cd4f7d0b8d2ec9ccddd0bac3cf8b2c9a069001f13a0ae067ab96fcd2b459c9', '[\"*\"]', NULL, NULL, '2026-01-19 02:26:15', '2026-01-19 02:26:15'),
(73, 'App\\Models\\User', 31, 'PICG', 'e5008af3e6a30f2655d58e72de163aa6e75e24691c5a4a5f7ccc9baadc86bd33', '[\"*\"]', NULL, NULL, '2026-01-29 01:11:16', '2026-01-29 01:11:16'),
(74, 'App\\Models\\User', 31, 'PICG', 'b76681b35143e9bd8020f4ff4010c3b45ee70f85d2eb15aceb6424e97b466226', '[\"*\"]', NULL, NULL, '2026-01-29 04:35:56', '2026-01-29 04:35:56'),
(75, 'App\\Models\\User', 31, 'PICG', '146d3f2f5c9c9848225f6c5cb54624a3be5119ac1dee9e7d4216b84df27cda45', '[\"*\"]', NULL, NULL, '2026-01-29 05:35:31', '2026-01-29 05:35:31'),
(76, 'App\\Models\\Admin', 1, 'PICG', '714bf13eb7e781a9821c5336d6503e96852a78b0b82481317cfbd973bb34ad3c', '[\"*\"]', NULL, NULL, '2026-01-30 07:38:57', '2026-01-30 07:38:57'),
(77, 'App\\Models\\User', 19, 'PICG', 'e74d4d98a38349858d2e64d78981fcbe7b0f6f7e26c0d0e0d2a6acff8a99f140', '[\"*\"]', NULL, NULL, '2026-02-02 06:22:47', '2026-02-02 06:22:47'),
(78, 'App\\Models\\Admin', 1, 'PICG', 'c9b87fd3021c4422b1bedb649ec05c89ca4010eed32d6945f954ad5172eac029', '[\"*\"]', NULL, NULL, '2026-02-22 23:41:55', '2026-02-22 23:41:55'),
(79, 'App\\Models\\User', 19, 'PICG', 'a1c4b23ef8b4c769a3e8c86266874b2e719e414c6a9c0b3b8a6533387d65593f', '[\"*\"]', NULL, NULL, '2026-02-23 04:37:59', '2026-02-23 04:37:59'),
(80, 'App\\Models\\User', 33, 'PICG', 'e819eb7213b349c9897968bc00e626da3bd30b769c275209db180d61c6a9ce27', '[\"*\"]', NULL, NULL, '2026-04-30 00:19:33', '2026-04-30 00:19:33'),
(81, 'App\\Models\\Admin', 1, 'PICG', '7e80efde0182543e928a5d8351f01286a7a2f474ce7c70df8069e1125f4847d3', '[\"*\"]', NULL, NULL, '2026-06-18 06:05:16', '2026-06-18 06:05:16'),
(82, 'App\\Models\\Admin', 1, 'PICG', '23a2fa99737f2a7c91b97bd3abbf98fe2eb4b38e2e6df5a2734d8238af9c3411', '[\"*\"]', NULL, NULL, '2026-06-18 06:30:43', '2026-06-18 06:30:43'),
(83, 'App\\Models\\Admin', 1, 'PICG', 'ad289506fc8a682a11e028a46f7ac877d93cefa3ecd9e4d832e40351d9362e1b', '[\"*\"]', NULL, NULL, '2026-06-18 06:30:56', '2026-06-18 06:30:56'),
(84, 'App\\Models\\Admin', 1, 'PICG', 'a4068b84d4e4906829b62aff976d4911134112ce29c31891a467142ab7da13f7', '[\"*\"]', NULL, NULL, '2026-06-18 06:32:25', '2026-06-18 06:32:25'),
(85, 'App\\Models\\Admin', 1, 'PICG', '458777cfa0ed1d3b44c73b24e1399172063aa06effd6d25ed7953bd79d4ed850', '[\"*\"]', NULL, NULL, '2026-06-19 00:06:32', '2026-06-19 00:06:32'),
(86, 'App\\Models\\Admin', 1, 'PICG', 'cc466f8f1400b31c761804b6b4e8d94749a75914ca4c93fcf5e9d5d139364d61', '[\"*\"]', NULL, NULL, '2026-06-19 05:04:57', '2026-06-19 05:04:57'),
(87, 'App\\Models\\Admin', 1, 'PICG', 'b597b31abc018733899229e73a646a136f39dd1c300ffe7b7c7a729bda839d2b', '[\"*\"]', NULL, NULL, '2026-06-19 05:13:44', '2026-06-19 05:13:44'),
(88, 'App\\Models\\Admin', 1, 'PICG', 'bad1f3a09a91fb61bfef399a64ec118044eabc7bc38e547360b304ec9a154ee5', '[\"*\"]', NULL, NULL, '2026-06-19 05:13:44', '2026-06-19 05:13:44'),
(89, 'App\\Models\\Admin', 1, 'PICG', '713496ade2772d719149ff9e419d71330b198e1d52dbe0cd0f02b9fd63c2c9a5', '[\"*\"]', NULL, NULL, '2026-06-19 07:33:16', '2026-06-19 07:33:16'),
(90, 'App\\Models\\Admin', 1, 'PICG', '2a8a79092771dc5e77a3aac3e158f3abdfe9e583b8c7ca5f9ea09806a03c852f', '[\"*\"]', NULL, NULL, '2026-06-19 07:35:03', '2026-06-19 07:35:03'),
(91, 'App\\Models\\Admin', 1, 'PICG', 'd91035671e64261dd36dcc89feb9772bf344676ddbb212c231cae792fc57b2ce', '[\"*\"]', NULL, NULL, '2026-06-23 01:05:58', '2026-06-23 01:05:58'),
(92, 'App\\Models\\Admin', 1, 'PICG', 'fc657689777043ceeac0bf844a17334499919289932a592819c9c49fbb500300', '[\"*\"]', NULL, NULL, '2026-06-23 01:08:58', '2026-06-23 01:08:58'),
(93, 'App\\Models\\Admin', 1, 'PICG', '77460c527e847b1fae1f5afad0405d06c056b35de6e64ca62b59b655908cd306', '[\"*\"]', NULL, NULL, '2026-06-23 01:18:01', '2026-06-23 01:18:01'),
(94, 'App\\Models\\Admin', 1, 'PICG', '1582df0cb89a2f15be0ccd88a9e46f311f8fdb7068e39b80f5252545b7f802e5', '[\"*\"]', NULL, NULL, '2026-06-24 00:35:47', '2026-06-24 00:35:47'),
(95, 'App\\Models\\Admin', 1, 'PICG', 'aff75e57f79f8151a54b322bebe80469801357208ae2fa86be7bf2cc9749ff0d', '[\"*\"]', NULL, NULL, '2026-06-24 00:59:08', '2026-06-24 00:59:08'),
(96, 'App\\Models\\Admin', 1, 'PICG', 'dda92213e3f28bad432fdaac0c2c259a811a8e907cb304a2a50d2b81ee3aee70', '[\"*\"]', NULL, NULL, '2026-06-24 00:59:22', '2026-06-24 00:59:22'),
(97, 'App\\Models\\User', 35, 'TIME', 'be2ea723f03a1ef9de0ce7731504d8339655387c48f5c702e727170f93fd42e1', '[\"*\"]', NULL, NULL, '2026-06-24 01:16:37', '2026-06-24 01:16:37'),
(102, 'App\\Models\\User', 36, 'TIME', '71780e417bdcf22f072202d93b49b5d7be13c002529ff1dbc3adbcaddfc84b85', '[\"*\"]', NULL, NULL, '2026-06-24 01:46:57', '2026-06-24 01:46:57'),
(103, 'App\\Models\\User', 36, 'TIME', '74d473d900b7a3e323ef0a70f5efcf45241fd30f6afe5dbe885cc576ebe14a6b', '[\"*\"]', NULL, NULL, '2026-06-24 02:08:59', '2026-06-24 02:08:59'),
(104, 'App\\Models\\User', 36, 'TIME', 'a291fb7ef10afd19679bc3fb4ce8fbbbfe2c6f0a0727e40ff3b9ca75b6e8e804', '[\"*\"]', NULL, NULL, '2026-06-24 02:10:20', '2026-06-24 02:10:20'),
(105, 'App\\Models\\User', 36, 'TIME', '2868eebe3dd76f2aa05c797d2a4cd0ebce7ba2a17cec61d96961628769aa0bf8', '[\"*\"]', NULL, NULL, '2026-06-24 02:11:09', '2026-06-24 02:11:09'),
(106, 'App\\Models\\User', 36, 'TIME', 'a438293276b0519fbc87224916afbcbaf8ac9ce1fa7d610c23a016c31e63bff6', '[\"*\"]', NULL, NULL, '2026-06-24 02:20:14', '2026-06-24 02:20:14'),
(107, 'App\\Models\\Admin', 1, 'PICG', '9058bd1007a78ead7d2498940ad17312ff167f214bc744e31a58e11dd5f33231', '[\"*\"]', NULL, NULL, '2026-06-24 02:41:32', '2026-06-24 02:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` int DEFAULT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` bigint DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `admin_id`, `name`, `user_id`, `image`, `status`, `sku`, `price`, `quantity`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'test', NULL, 'productes/ikScbiu0rsMYighn8Ss8AX6dmR09wCA1ERs7rJyR.png', 1, '021455', '100', 14, '2026-06-19 02:38:59', '2026-06-19 00:55:41', NULL),
(3, 1, 1, 'Test', NULL, 'productes/ykGNSxRuNoI9JORQuyiwgFPM3Yki2lLfEio0sN4e.png', 1, '021444', '100', 1000, '2026-06-19 05:16:15', '2026-06-19 02:55:48', NULL),
(4, 1, 1, 'Forrest Morin', NULL, 'productes/69wfb60IdjYxpypZgPbLuBCg6JibpNepVs9hEkKo.png', 0, 'Placeat aut consequ', '53', 873, '2026-06-19 05:19:30', '2026-06-19 05:16:38', NULL),
(5, 1, 1, 'Haley Hensley', NULL, 'productes/OI2Q6XUm4g8KLDQ1OmCZRXLVI8QKrj9PX08hYg8n.png', 0, 'Enim ad aut fuga Fa', '314', 555, '2026-06-19 05:26:06', '2026-06-19 05:24:22', NULL),
(6, 1, 1, 'Palmer Mcfadden', NULL, 'productes/42dwXZ1MWULIqbs2ruCFNrqTzto9hSjakejLAAw8.png', 0, 'Tempora est perspici', '908', 7, NULL, '2026-06-19 05:28:21', '2026-06-19 05:28:21');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'admin', '2025-07-07 07:23:04', '2025-07-07 07:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(16, 1),
(17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcmToken` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deviceId` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phoneModel` int DEFAULT NULL,
  `phoneMake` int DEFAULT NULL,
  `appVersion` int DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone_number`, `gender`, `profile_picture`, `otp`, `fcmToken`, `deviceId`, `phoneModel`, `phoneMake`, `appVersion`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(19, 'Shoaib Nasir', 'shoaibnasir3155@gmail.com', '$2y$12$.91/vDurlw8xFKHU88AwF.QVIVR7/PmLZ4auFSneDQK6NjRYW2IyS', '03216905568', 'Male', 'uploads/general/media/profile/1bXQOMZDbsA4M5rvt1G46ZbSzoND2N3caWXQajrA.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-03 06:24:18', NULL, '2025-11-03 06:23:34', '2026-04-30 05:17:32'),
(21, 'Talha', 'talha@picg.org.pk', '$2y$12$R0hz6EhsFqVBbkDQoGuTl.QIFwPpZYW3B3fmoQ254MYDlk6TvwSvO', '+923452231423', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-04 05:41:00', NULL, '2025-11-04 05:40:24', '2025-11-04 05:41:00'),
(26, 'Megan Lester', 'sosotyzi@mailinator.com', '$2y$12$93u8RM4C8tt4AQj.vX2KfOqgJKzMeLPbVLlwfkI7p5K2u6biuWfFW', '+1 (521) 192-5532', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-04 07:27:10', '2025-11-04 07:27:10'),
(27, 'Quin Sexton', 'matoqebyn@mailinator.com', '$2y$12$n43T.bgjlX910iaRu7WjeOtENT3.6jYVz3jn0mrCdBm.GTcV37qoC', '+1 (405) 403-5678', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-04 07:33:55', '2025-11-04 07:33:55'),
(28, 'Dominique Skinner', 'vuriqujug@mailinator.com', '$2y$12$VzTWy5unvxigDXzz9B1WEON4qT/bYH7bN5XE5xDzm3RMo5KGdr4Be', '+1 (643) 325-8473', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-05 00:44:18', '2025-11-05 00:44:18'),
(29, 'Wynter Caldwell43', 'dykufydix@mailinator.com', '$2y$12$UuEx7jhaUi/3GU9PZ6EdZOnQk.wQKfx91EUX9CWQO/nTaxi7zD7Eq', '+1 (773) 632-6452', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-05 10:58:05', NULL, '2025-11-10 05:57:24', '2026-01-19 02:03:25'),
(30, 'Muhammad Asgher', 'muhammadasgher@picg.org.pk', '$2y$12$TQ2cOKGG/pllxO30awRVvORSDvee8T4RlgL0INgRQc1hMJ8JDvgwS', '03052985743', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 00:31:38', NULL, '2025-11-11 00:30:27', '2025-11-17 09:57:53'),
(31, 'atif shahid', 'atif.ftr.zoom@gmail.com', '$2y$12$tU8qSPWYNVO8YTVBhk681e3iyGl8Xks5Di2J.FqjyBQmzFzIuemvW', '03136936938', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-29 05:46:45', NULL, '2026-01-29 01:10:19', '2026-01-29 05:46:45'),
(32, 'Wanda Miranda', 'ronoz@mailinator.com', '$2y$12$rr0bj19qfwyeoxGPxE5zX.ARTt8Xk0ZQrLYfT4ShBcrb.AaM1C5cu', '+1 (952) 546-4289', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-29 05:04:34', '2026-01-29 05:04:34'),
(33, 'shoaib nasir', 'shoaibnasir315@gmail.com', '$2y$12$PKHlfm8eZD2WdylMSPPlUudJVM.nZKnNLMPm2UGZ3ynvNgbZOIiva', '03216905568', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 05:19:13', NULL, '2026-04-30 00:18:27', '2026-04-30 05:19:16'),
(35, 'shoaib nasir', 'shoaibnasir3115@gmail.com', NULL, '0321-6909986', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-24 01:16:37', '2026-06-24 01:16:37'),
(36, 'shoaib nasir', 'shoaibnasir31151@gmail.com', NULL, '0321-6909986', NULL, NULL, '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-24 01:31:24', '2026-06-24 01:31:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `home_sliders`
--
ALTER TABLE `home_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_foreign` (`user_id`),
  ADD KEY `products_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_sliders`
--
ALTER TABLE `home_sliders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
