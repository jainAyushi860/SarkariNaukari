-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2024 at 06:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `indiasarkarinaukari`
--

-- --------------------------------------------------------

--
-- Table structure for table `addrole`
--

CREATE TABLE `addrole` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permissions` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addrole`
--

INSERT INTO `addrole` (`id`, `name`, `created_at`, `updated_at`, `permissions`) VALUES
(14, 'Owner', '2024-04-26 03:52:41', '2024-04-26 03:52:41', '[\"Add\",\"Edit\",\"View\",\"Delete\"]'),
(16, 'Viewer', '2024-04-26 03:56:14', '2024-04-26 03:56:14', '[\"View\"]'),
(17, 'Editor', '2024-04-26 03:58:23', '2024-04-26 03:58:23', '[\"Edit\"]'),
(18, 'Developer', '2024-04-26 03:59:17', '2024-04-26 03:59:17', '[\"Add\",\"Edit\",\"View\",\"Delete\"]'),
(19, 'Administrator', '2024-04-26 03:59:52', '2024-04-26 03:59:52', '[\"Add\",\"Edit\",\"View\",\"Delete\"]'),
(20, 'Subscriber', '2024-04-26 04:00:24', '2024-04-26 04:00:24', '[\"View\"]');

-- --------------------------------------------------------

--
-- Table structure for table `add_mock_test`
--

CREATE TABLE `add_mock_test` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL,
  `option3` varchar(255) DEFAULT NULL,
  `option4` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `appearExam` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_mock_test`
--

INSERT INTO `add_mock_test` (`id`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`, `subject`, `appearExam`, `created_at`, `updated_at`) VALUES
(2, 'question', 'optionone', 'optiontwo', 'optionthree', 'optionfour', 'optionfour', 'java,php,js,.net', '2024,2020,2018,2000', '2024-05-10 05:17:59', '2024-05-10 05:17:59'),
(3, 'question', 'optionone', 'optiontwo', 'optionthree', 'optionfour', 'optionfour', 'java,php,js,.net', '2024,2020,2018,2000', '2024-05-10 05:27:33', '2024-05-10 05:27:33'),
(4, 'question', 'optionone', 'optiontwo', 'optionthree', 'optionfour', 'optionfour', 'java,php,js,.net', '2024,2020,2018,2000', '2024-05-10 05:49:55', '2024-05-10 05:49:55'),
(5, 'question', 'optionone', 'optiontwo', 'optionthree', 'optionfour', 'optionfour', 'java,php,js,.net', '2024,2020,2018,2000', '2024-05-10 06:00:07', '2024-05-10 06:00:07'),
(6, 'question', 'optionone', 'optiontwo', 'optionthree', 'optionfour', 'optionfour', 'java,php,js,.net', '2024,2020,2018,2000', '2024-05-10 06:54:55', '2024-05-10 06:54:55'),
(11, 'dddd', 'sdsd', 'sdsd', 'dd', 'sdsd', 'sdsd', 'sdd,erer,rr,sg', 'dsd,svsv,bss,sv', '2024-05-11 06:01:21', '2024-05-11 06:01:21');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_name` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `exam_name`, `year`, `created_at`, `updated_at`) VALUES
(1, 'SSC-CGL', '2010', '2024-05-11 03:37:30', '2024-05-11 04:07:53'),
(2, 'Bank', '2012', '2024-05-11 03:38:38', '2024-05-11 03:38:38'),
(3, 'Railways', '2010', '2024-05-11 03:39:12', '2024-05-11 03:39:12'),
(5, 'SSC', '2010', '2024-05-11 06:08:22', '2024-05-11 06:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `alt_name` varchar(255) DEFAULT NULL,
  `file_size` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `title`, `caption`, `file`, `alt_name`, `file_size`, `file_type`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'mediatech', 'company', 'ganesh.jpg', 'image.jpg', '605685', 'image/jpeg', 'this is an IT company', NULL, '2024-04-12 05:55:28', '2024-04-12 05:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_04_12_052852_create_signup_table', 1),
(6, '2024_04_12_061301_create_signup_table', 2),
(7, '2024_04_12_092217_create__expire_otp_table', 3),
(8, '2024_04_12_094008_create_otp_table', 4),
(9, '2024_04_12_103808_create_media_table', 5),
(10, '2024_04_12_113416_create_notificationdetail_table', 6),
(11, '2024_04_12_120334_create_notificationsubscribe_table', 7),
(12, '2024_04_15_115342_add_token_field_to_signup', 8),
(13, '2024_04_18_065159_mobile_number_to_otp', 9),
(14, '2024_04_18_083845_change_mobile_number_in_otp', 10),
(15, '2024_04_18_121229_add_google_id_after_status_to_signup', 11),
(20, '2024_04_23_073643_create_addrole_table', 16),
(25, '2024_04_24_050421_create_userrole_table', 17),
(27, '2024_04_24_053916_add_google_id_to_userrole', 19),
(29, '2024_04_24_121539_create_permission_tables', 20),
(30, '2024_04_25_062756_add_foreign_key_to_userrole', 21),
(31, '2024_04_25_124815_create_userrights', 22),
(32, '2024_04_26_085623_add_permissions_to_addrole', 23),
(33, '2024_05_01_042348_create_permission_tables', 24),
(35, '2024_05_10_074834_create_mock_test_table', 25),
(36, '2024_05_10_102526_create_add_mock_test_table', 25),
(37, '2024_05_11_043628_create_subject_table', 26),
(38, '2024_05_11_075747_create_exam_table', 27);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10);

-- --------------------------------------------------------

--
-- Table structure for table `notificationdetail`
--

CREATE TABLE `notificationdetail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notificationdetail`
--

INSERT INTO `notificationdetail` (`id`, `title`, `description`, `image`, `remark`, `link`, `created_at`, `updated_at`) VALUES
(1, 'dssdsd', 'sdssdsd', 'mypic39165_1712922846.jpg', 'ssdsd', 'http://localhost/phpmyadmin/index.php?', '2024-04-12 06:24:06', '2024-04-12 06:24:06');

-- --------------------------------------------------------

--
-- Table structure for table `notificationsubscribe`
--

CREATE TABLE `notificationsubscribe` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `public_key` text NOT NULL,
  `private_key` text NOT NULL,
  `auth_key` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notificationsubscribe`
--

INSERT INTO `notificationsubscribe` (`id`, `status`, `created_at`, `updated_at`, `public_key`, `private_key`, `auth_key`) VALUES
(1, 'Active', '2024-02-28 09:45:57', '2024-03-30 11:49:30', '', '', ''),
(2, 'Active', '2024-03-28 09:45:57', '2024-03-30 11:35:32', '', '', ''),
(3, 'Deactive', '2024-04-22 09:46:10', '2024-03-30 11:09:57', '', '', ''),
(4, 'Trash', '2024-03-27 09:46:17', '2024-03-28 11:10:09', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `email_otp` varchar(100) DEFAULT NULL,
  `mobile_number` varchar(100) DEFAULT NULL,
  `mobile_otp` varchar(10) DEFAULT NULL,
  `client_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `email`, `email_otp`, `mobile_number`, `mobile_otp`, `client_id`, `created_at`, `updated_at`) VALUES
(43, NULL, NULL, '+91 99296 55475', '6286', '9', '2024-04-19 03:58:44', '2024-04-19 03:58:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'create role', 'web', '2024-05-01 01:27:27', '2024-05-01 01:27:27'),
(3, 'view role', 'web', '2024-05-01 01:28:30', '2024-05-01 01:28:30'),
(4, 'update role', 'web', '2024-05-01 01:29:01', '2024-05-01 02:19:28'),
(5, 'delete role', 'web', '2024-05-01 01:29:32', '2024-05-01 01:29:32'),
(7, 'create-permission', 'web', '2024-05-01 05:24:56', '2024-05-01 05:24:56'),
(8, 'view-permission', 'web', '2024-05-01 05:25:18', '2024-05-01 05:25:18'),
(9, 'update-permission', 'web', '2024-05-01 05:25:39', '2024-05-01 05:25:39'),
(10, 'delete-permission', 'web', '2024-05-01 05:25:54', '2024-05-01 05:25:54');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'Super-admin', 'web', '2024-05-01 03:41:27', '2024-05-01 03:41:27'),
(3, 'Admin', 'web', '2024-05-01 03:41:39', '2024-05-01 03:41:39'),
(4, 'User', 'web', '2024-05-01 03:43:21', '2024-05-01 03:44:40');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 2),
(2, 3),
(3, 2),
(3, 3),
(3, 4),
(4, 2),
(5, 2),
(7, 2),
(7, 3),
(8, 2),
(8, 3),
(8, 4),
(9, 2),
(10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `token` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `name`, `email`, `mobile`, `dob`, `gender`, `password`, `status`, `token`, `created_at`, `updated_at`, `google_id`) VALUES
(2, 'admin', 'admin@gmail.com', '8908987776', '2020-02-10', 'Male', '14b7d5d35459b199da100a9540e2c7fd', 'Active', NULL, '2024-04-12 02:09:05', '2024-04-12 02:09:05', NULL),
(4, 'admin', 'myadmin@gmail.com', '8908987776', '2020-02-10', 'Male', 'yT@143rT', 'Active', NULL, '2024-04-12 04:54:23', '2024-04-12 04:54:23', NULL),
(6, 'sohil', 'sohil@gmail.com', '7890987678', '2024-03-20', 'male', '$2y$10$sxKsKNRysR/oenfnRSb8ru.HIE2sxumPWUK.fPbT4wr6jbrQFDd9O', 'Active', NULL, '2024-04-15 03:38:31', '2024-04-15 23:29:02', NULL),
(7, 'sohil', 'sohil12@gmail.com', '7890987678', '2024-03-20', 'male', '$2y$10$mW4RlbdkdUAS6tRd4avhs.KCwk.knPKjk8N566rz3njF7nd.ig.K.', 'Active', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luRGF0YSIsImlhdCI6MTcxMzE4NTQzNCwiZXhwIjoxNzEzMTg1NDk0LCJuYmYiOjE3MTMxODU0MzQsImp0aSI6IjBrT1M1OFA1Z3E1SlJHa20iLCJzdWIiOiI3IiwicHJ2IjoiNWM1YjJhZmU2MDI2MmU1M2I1OGE1YTFmMGY5NzIyZjdlNjc3ZjRiYyJ9.zLZ8pqC12HtWKqm_As029Dl4R6NoD7pXqd_QPEG3QXg', '2024-04-15 04:35:23', '2024-04-15 22:57:51', NULL),
(30, 'arpita', 'arpita123@gmail.com', '+91 89776 56789', '2021-09-01', 'female', '$2y$10$g2rpQ6o8cajkRP/mUPkV6eRLj2NTTaDMwsr/5UcFBv9vQmgtCB1cC', 'Active', NULL, '2024-05-03 06:46:15', '2024-05-03 06:46:15', NULL),
(31, 'ayushi', 'jayushi073@gmail.com', '+91 89776 56789', '2021-09-01', 'female', '$2y$10$xo6wUcFsw2MqHW5fBJIS.uFU4xk17ScjD17jAZdTalrddRNm5DGFu', 'Active', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luRGF0YSIsImlhdCI6MTcxNDk4MTcxNCwiZXhwIjoxNzE0OTgxNzc0LCJuYmYiOjE3MTQ5ODE3MTQsImp0aSI6Ijg1MFBIdVo0Tkp2bldybTUiLCJzdWIiOiIzMSIsInBydiI6IjVjNWIyYWZlNjAyNjJlNTNiNThhNWExZjBmOTcyMmY3ZTY3N2Y0YmMifQ.4G-KfBrCZTxkpRWyI32FxUsAUJT_578lsqXiltkrt1g', '2024-05-03 07:07:39', '2024-05-06 02:18:34', NULL),
(32, 'nikita', 'nikita@gmail.com', '+91 78909 87654', '2024-05-01', 'Female', '$2y$10$MkX3/XDKodAL5EBU22u6lOGEV196RRLaBn4cQytTdBeFCKoBIaETq', 'Active', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luRGF0YSIsImlhdCI6MTcxNTQzMTIzNiwiZXhwIjoxNzE1NDMxMjk2LCJuYmYiOjE3MTU0MzEyMzYsImp0aSI6ImU1cUJBSjBZR0Y3MHVhWHAiLCJzdWIiOiIzMiIsInBydiI6IjVjNWIyYWZlNjAyNjJlNTNiNThhNWExZjBmOTcyMmY3ZTY3N2Y0YmMifQ.x0reCbmpXNwr0Jx5S5Hu9uM3zcDQ4Sw4S2qfAHMv-cU', '2024-05-09 02:09:02', '2024-05-11 07:10:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subject_name`, `created_at`, `updated_at`) VALUES
(1, 'java', '2024-05-10 23:37:12', '2024-05-11 06:03:17'),
(2, 'javascript', '2024-05-10 23:37:32', '2024-05-10 23:37:32'),
(3, 'php', '2024-05-10 23:38:03', '2024-05-10 23:38:03'),
(5, 'nodejs', '2024-05-10 23:38:35', '2024-05-10 23:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `userrights`
--

CREATE TABLE `userrights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rights` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE `userrole` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `token` longtext DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `roles` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userrole`
--

INSERT INTO `userrole` (`id`, `name`, `email`, `password`, `token`, `status`, `created_at`, `updated_at`, `google_id`, `roles`) VALUES
(1, 'ayushi', 'ayushi@gmail.com', '$2y$10$Kgd6ElgIMJEbTjVEfi5ZVuasuuzntVP6v4Nc93pRgInPmEIlbfUpi', NULL, 'Active', '2024-04-24 01:49:03', '2024-04-24 01:49:03', NULL, NULL),
(2, 'aayushi', 'aayushi@gmail.com', '$2y$10$oAa7XNheJvn22DtAbMssLOddWHYQLUR5.G/uv3VnTEIP89Z8YxxlK', NULL, 'Active', '2024-04-24 01:51:31', '2024-04-24 01:51:31', NULL, NULL),
(3, 'nishi', 'nishi@gmail.com', '$2y$10$ZEFm2GNPGXR8DUm5NBrYzeTM1YbM9u6/vEjdIaQzTfzgh5gS7wP3u', NULL, 'Active', '2024-04-24 01:57:42', '2024-04-24 01:57:42', NULL, NULL),
(4, 'sdssds', 'sssd@gmail.com', '$2y$10$aWREF4BsHokfe4ggL4oAUujXljjI/R2ONY1J/rxMrD7gx6di.2Qhi', NULL, 'Active', '2024-04-24 02:03:26', '2024-04-24 02:03:26', NULL, NULL),
(5, 'ahsshdw', 'nsssnsn@gmailcom', '$2y$10$PnduVt2EBhchNOPneCLAY.5w2S02wjuqrsJg7qNbqqYT.TeYEETGS', NULL, 'Active', '2024-04-24 02:05:33', '2024-04-24 02:05:33', NULL, NULL),
(6, 'aaayushi', 'aaayushi12@gmail.com', '$2y$10$EIlHUoD7srn9TPT4zgJ3rOqyaR5IQRIRc.na9tY1f1V2610I93BGO', NULL, 'Active', '2024-04-24 03:28:33', '2024-04-24 03:28:33', NULL, NULL),
(21, 'Arya', 'arya12@gmail.com', '$2y$10$ybzFeShwgYLfjq9GcumQcO4tovu2lhTT/9tgtT/yXC0cL06W1vEra', NULL, 'Active', '2024-04-26 04:05:20', '2024-04-26 04:05:20', NULL, 14);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(9, 'admin', 'admin@gmail.com', NULL, '$2y$10$Ve8cB4Q6aqSAFtJAYAwGNORDfbltPbCH874UtrtXR.c6TrxRTwPhm', NULL, '2024-05-01 23:20:03', '2024-05-01 23:20:03'),
(10, 'Superadmin', 'superadmin@gmail.com', NULL, '$2y$10$vIlgldfa9GHOChgb01qYnOpBdjMNr.G4h1kdH7xdFxF0cXg0McdGe', NULL, '2024-05-01 23:20:38', '2024-05-01 23:20:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addrole`
--
ALTER TABLE `addrole`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_mock_test`
--
ALTER TABLE `add_mock_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
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
-- Indexes for table `notificationdetail`
--
ALTER TABLE `notificationdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notificationsubscribe`
--
ALTER TABLE `notificationsubscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `otp_client_id_unique` (`client_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userrights`
--
ALTER TABLE `userrights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userrole`
--
ALTER TABLE `userrole`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userrole_roles_foreign` (`roles`);

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
-- AUTO_INCREMENT for table `addrole`
--
ALTER TABLE `addrole`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `add_mock_test`
--
ALTER TABLE `add_mock_test`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `notificationdetail`
--
ALTER TABLE `notificationdetail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notificationsubscribe`
--
ALTER TABLE `notificationsubscribe`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userrights`
--
ALTER TABLE `userrights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userrole`
--
ALTER TABLE `userrole`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `userrole`
--
ALTER TABLE `userrole`
  ADD CONSTRAINT `userrole_roles_foreign` FOREIGN KEY (`roles`) REFERENCES `addrole` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
