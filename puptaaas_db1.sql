-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2022 at 11:35 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puptaaas_db1`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) NOT NULL,
  `course_code` varchar(100) NOT NULL,
  `course` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course`) VALUES
(1, 'BSA', 'BS Accountancy'),
(2, 'BSBA-HR', 'BS Business Administration - Human Resource'),
(3, 'BSBA-MM', 'BS Business Administration - Marketing Management'),
(4, 'BSEE', 'BS Electronics Engineering'),
(5, 'BSED-ENG', 'BS Education major in English'),
(6, 'BSED-MT', 'BS Education major in Mathematics'),
(7, 'BSIT', 'BS Information Technology\n'),
(8, 'BSME', 'BS Mechanical Engineering'),
(9, 'BSOA-LT', 'BS Office Administration - Legal Transcription'),
(10, 'DICT', 'Diploma in Information Communication Technology'),
(11, 'DOMT', 'Diploma in Office Management Technology');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_23_071834_add_details_to_users_table', 2),
(6, '2022_08_23_135821_add_username_to_users', 3),
(7, '2022_08_23_150017_delete_name_users_table', 4),
(8, '2022_08_23_173103_create_sessions_table', 5),
(9, '2022_08_27_085759_create_student_applicants_table', 5),
(10, '2022_09_05_140024_create_table_summary', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('roseannbonador5@gmail.com', '$2y$10$vegXl5QW0C3LZGx9bnRzkOdLPzLLlh4xjV6m9u.t7T195/7andiAG', '2022-08-23 08:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_applicants`
--

CREATE TABLE `student_applicants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `school_year` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `award_applied` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1=AA,2=DL,3=PL,4=AE',
  `gwa_1st` decimal(10,2) NOT NULL,
  `gwa_2nd` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Accepted,2=Rejected',
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_applicants`
--

INSERT INTO `student_applicants` (`id`, `user_id`, `school_year`, `year_level`, `award_applied`, `gwa_1st`, `gwa_2nd`, `image`, `status`, `reason`, `course_id`, `created_at`, `updated_at`) VALUES
(32, 28, '2022-2023', '1st Year', '1', '1.00', '1.00', '1662752567.png', 1, NULL, 7, '2022-09-09 11:42:47', '2022-09-09 12:03:39'),
(33, 28, '2022-2023', '1st Year', '1', '1.50', '1.00', '1662752983.jpg', 1, NULL, 7, '2022-09-09 11:49:43', '2022-09-09 12:03:36'),
(34, 26, '2022-2023', '3rd Year', '2', '1.68', '1.03', '1662758948.jpg', 1, NULL, 4, '2022-09-09 13:29:08', '2022-09-09 13:31:30');

-- --------------------------------------------------------

--
-- Table structure for table `summary`
--

CREATE TABLE `summary` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `term` tinyint(4) NOT NULL,
  `subjects` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `units` int(11) NOT NULL,
  `grades` decimal(10,2) NOT NULL,
  `sy` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `summary`
--

INSERT INTO `summary` (`id`, `app_id`, `user_id`, `term`, `subjects`, `units`, `grades`, `sy`, `created_at`, `updated_at`) VALUES
(53, 32, 28, 1, 'zobynon', 3, '1.00', '2022-2023', '2022-09-09 11:42:47', '2022-09-09 11:42:47'),
(54, 32, 28, 2, 'cowejer', 3, '1.00', '2022-2023', '2022-09-09 11:42:47', '2022-09-09 11:42:47'),
(55, 33, 28, 1, 'Computer Programming', 3, '1.50', '2022-2023', '2022-09-09 11:49:43', '2022-09-09 11:49:43'),
(56, 33, 28, 2, 'Computer Programming 2', 3, '1.00', '2022-2023', '2022-09-09 11:49:43', '2022-09-09 11:49:43'),
(57, 34, 26, 1, 'moqurar', 3, '1.68', '2022-2023', '2022-09-09 13:29:08', '2022-09-09 13:29:08'),
(58, 34, 26, 2, 'dajizedoka', 3, '1.03', '2022-2023', '2022-09-09 13:29:08', '2022-09-09 13:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stud_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_as` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=user,1=superadmin,2=admin,3=officials',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `stud_num`, `username`, `first_name`, `middle_name`, `last_name`, `email`, `contact`, `course_id`, `role_as`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(19, '2022-07000-TG-0', 'admin', 'Rose Ann', NULL, 'Bonador', 'admin@gmail.com', '09297205140', '7', 2, NULL, '$2y$10$uP/rqm1hkHP29pQ94N7DleJne.tHSuLgDcxyX3hkP3fsLUxyUIrCK', 'Zeg8lAcgijw2hD0CVM6xSSt4o2vo9g6Bpdqa5xmhCmEXtwYUxwKDX8Sh8JMw', '2022-08-23 11:10:10', '2022-09-06 09:24:40'),
(24, '2022-00330-TG-0', 'jane123', 'Jane', NULL, 'Doe', 'aaa@gmail.com', '+639297205140', '11', 0, NULL, '$2y$10$TAWWjNNuF2KSNyXiUewS9.eV81XbKkbHiwyh1MbVlBQbGtxZQsVEa', '4UliZZd2iDYGpjVpfHBO4vmkyFMFCMSfNEcv4MN9BoDI8d4GeykofI8uPGyC', '2022-08-25 03:27:24', '2022-09-06 22:38:39'),
(26, '2022-00000-TG-0', 'john123', 'John', NULL, 'Doe', 'roseannbonador5@gmail.com', '+639297205140', '4', 0, NULL, '$2y$10$xhWTxQ5OkGk.PVVRtBn38uoYwXPV2xXcgZODPeijd2EAfc1D/egyS', 'LbXdaAPB0WeBFI2TEyAwNIwCDkzMFz75rWtSpjHpov1KbNFt3bNGnH2kT1Jm', '2022-09-06 00:04:54', '2022-09-06 22:38:28'),
(28, '2022-00043-TG-0', 'rose123', 'Rose Ann', NULL, 'Bonador', 'zzz@gmail.com', '+639297205140', '7', 0, NULL, '$2y$10$H3XlLFP/DgPNX4HmFx1aPOy5vYsYJLAbEHAIlrqJJr0i54GdHarLq', NULL, '2022-09-09 10:12:53', '2022-09-09 10:12:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `student_applicants`
--
ALTER TABLE `student_applicants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `summary`
--
ALTER TABLE `summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_applicants`
--
ALTER TABLE `student_applicants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `summary`
--
ALTER TABLE `summary`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
