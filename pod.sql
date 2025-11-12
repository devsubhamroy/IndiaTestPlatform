-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2025 at 03:08 PM
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
-- Database: `pod`
--

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE `attempts` (
  `id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `score` float DEFAULT 0,
  `status` enum('in_progress','submitted') DEFAULT 'in_progress',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attempts`
--

INSERT INTO `attempts` (`id`, `test_id`, `student_id`, `start_time`, `end_time`, `score`, `status`, `created_at`, `updated_at`) VALUES
(14, 1, 7, '2025-11-11 10:18:07', '2025-11-11 11:46:07', 29, 'in_progress', '2025-11-11 04:48:07', '2025-11-11 04:48:07'),
(17, 20, 7, '2025-11-11 10:18:07', '2025-11-11 11:50:07', 57, 'in_progress', '2025-11-11 04:48:07', '2025-11-11 04:48:07');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `sender_id`, `receiver_id`, `message`, `attachment`, `created_at`, `updated_at`) VALUES
(1, 11, 5, 'Random message 1', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(2, 18, 13, 'Random message 2', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(3, 8, 10, 'Random message 3', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(4, 14, 9, 'Random message 4', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(5, 5, 10, 'Random message 5', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(6, 5, 7, 'Random message 6', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(7, 10, 4, 'Random message 7', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(8, 6, 15, 'Random message 8', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(9, 19, 13, 'Random message 9', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(10, 11, 9, 'Random message 10', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(11, 18, 8, 'Random message 11', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(12, 13, 8, 'Random message 12', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(13, 19, 20, 'Random message 13', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(14, 18, 2, 'Random message 14', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(15, 1, 4, 'Random message 15', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(16, 6, 1, 'Random message 16', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(17, 10, 19, 'Random message 17', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(18, 3, 3, 'Random message 18', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(19, 20, 10, 'Random message 19', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47'),
(20, 12, 5, 'Random message 20', NULL, '2025-11-11 04:48:47', '2025-11-11 04:48:47');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_11_08_181422_create_bookmarks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `test_id` int(11) DEFAULT NULL,
  `qns` text NOT NULL,
  `marks` float DEFAULT 1,
  `negative` float DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `difficulty` enum('Easy','Medium','Hard') DEFAULT 'Medium',
  `category` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `test_id`, `qns`, `marks`, `negative`, `created_by`, `duration`, `difficulty`, `category`, `created_at`, `updated_at`) VALUES
(21, 1, '[\n    {\n        \"qns\": \"3qeqwe\",\n        \"options\": {\n            \"option1\": \"sfdfdfs\",\n            \"option2\": \"fsda\",\n            \"option3\": \"safas\",\n            \"option4\": \"fsafds\"\n        },\n        \"answer\": \"option1\",\n        \"marks\": \"1\"\n    },\n    {\n        \"qns\": \"fsatgat\",\n        \"options\": {\n            \"option1\": \"gdastyg\",\n            \"option2\": \"gsdgdf\",\n            \"option3\": \"fadsgyasd\",\n            \"option4\": \"gdfsgsd\"\n        },\n        \"answer\": \"option1\",\n        \"marks\": \"1\"\n    }\n]', 1, 1, 3, 23, 'Easy', 'English', '2025-11-12 06:58:08', '2025-11-12 06:58:08'),
(22, 60, '[\n    {\n        \"qns\": \"gsdgsg\",\n        \"options\": {\n            \"option1\": \"sdfgsfg\",\n            \"option2\": \"gsgs\",\n            \"option3\": \"gsdfd\",\n            \"option4\": \"gsgfs\"\n        },\n        \"answer\": \"option2\",\n        \"marks\": \"1\"\n    }\n]', 1, -1, 10, 10, 'Hard', 'GK', '2025-11-12 07:00:08', '2025-11-12 07:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `attempt_id` int(11) NOT NULL,
  `total_marks` float DEFAULT NULL,
  `correct_count` int(11) DEFAULT NULL,
  `wrong_count` int(11) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `attempt_id`, `total_marks`, `correct_count`, `wrong_count`, `rank`, `created_at`, `updated_at`) VALUES
(14, 14, 92, 13, 4, 14, '2025-11-11 04:48:25', '2025-11-11 04:48:25'),
(17, 17, 57, 18, 6, 17, '2025-11-11 04:48:25', '2025-11-11 04:48:25');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2025-11-11 10:17:03', '2025-11-11 10:17:03'),
(2, 'Instructor', '2025-11-11 10:17:03', '2025-11-11 10:17:03'),
(3, 'Student', '2025-11-11 10:17:03', '2025-11-11 10:17:03'),
(4, 'Admin', '2025-11-11 05:03:42', '2025-11-11 05:03:42'),
(5, 'Editor', '2025-11-11 05:04:51', '2025-11-11 05:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `type` enum('Mock','Grand') NOT NULL,
  `duration` int(11) NOT NULL,
  `negative_marking` tinyint(1) DEFAULT 0,
  `start_time` timestamp NULL DEFAULT current_timestamp(),
  `end_time` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('Active','Scheduled','Completed') NOT NULL DEFAULT 'Scheduled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `title`, `description`, `category`, `type`, `duration`, `negative_marking`, `start_time`, `end_time`, `created_by`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Test 1', 'Description for Test 1', 'English', 'Grand', 80, 1, '2025-11-11 04:43:37', '2025-11-18 04:43:37', 10, '2025-11-11 04:43:37', '2025-11-11 04:43:37', 'Scheduled'),
(2, 'Test 2', 'Description for Test 2', 'Science', 'Grand', 109, 0, '2025-11-11 04:43:37', '2025-11-18 04:43:37', 12, '2025-11-11 04:43:37', '2025-11-11 04:43:37', 'Scheduled'),
(20, 'Test 20', 'Description for Test 20', 'Maths', 'Grand', 48, 1, '2025-11-11 04:43:37', '2025-11-18 04:43:37', 1, '2025-11-11 04:43:37', '2025-11-11 04:43:37', 'Scheduled'),
(21, 'Test 1', 'Description for Test 1', 'English', 'Mock', 36, 0, '2025-11-11 04:44:05', '2025-11-18 04:44:05', 8, '2025-11-11 04:44:05', '2025-11-11 04:44:05', 'Scheduled'),
(59, 'Test 19', 'Description for Test 19', 'GK', 'Grand', 105, 1, '2025-11-11 04:44:09', '2025-11-18 04:44:09', 6, '2025-11-11 04:44:09', '2025-11-11 04:44:09', 'Scheduled'),
(60, 'Test 20', 'Description for Test 20', 'GK', 'Mock', 46, 0, '2025-11-11 04:44:09', '2025-11-18 04:44:09', 4, '2025-11-11 04:44:09', '2025-11-11 04:44:09', 'Scheduled'),
(61, 'simple Test', NULL, NULL, 'Grand', 2, 0, '2025-11-11 19:04:50', '2025-11-11 19:04:50', 5, '2025-11-11 13:34:50', '2025-11-11 13:34:50', 'Scheduled'),
(63, 'Grand test', 'Best Practice set!', 'Science', 'Grand', 4, 1, '2025-11-11 19:20:32', '2025-11-11 19:20:32', 6, '2025-11-11 13:50:32', '2025-11-11 13:50:32', 'Scheduled'),
(64, 'Easy Test', 'Simple Test!', 'GK', 'Mock', 2, 1, '2025-11-11 19:22:30', '2025-11-11 19:22:30', 6, '2025-11-11 13:52:30', '2025-11-11 13:52:30', 'Active'),
(65, 'Easy Test GK', 'Simple Test!', 'GK', 'Mock', 2, 1, '2025-11-11 19:25:24', '2025-11-11 19:25:24', 3, '2025-11-11 13:55:24', '2025-11-11 14:40:28', 'Completed'),
(66, 'Correct', 'gdfgdgs', 'GK', 'Grand', 1, 1, '2025-11-11 19:25:54', '2025-11-11 19:25:54', 6, '2025-11-11 13:55:54', '2025-11-11 14:40:54', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'User1', 'user1@mail.com', '$2y$12$Kqm8RTRf5IFtWTxX2OCZmeD03dBBWLZCpKwz7awEMEaoYWEXiEtXe', 3, '2025-11-11 04:41:22', '2025-11-11 04:41:22'),
(2, 'User2', 'user2@mail.com', '$2y$12$jJsEQTHOrN1eef7vLd0R3ee76a.ijGChGt8p4dI31PnogR7O6Glsi', 3, '2025-11-11 04:41:22', '2025-11-11 04:41:22'),
(3, 'User3', 'user3@mail.com', '$2y$12$No3mOcQJL08xrDtj56mo7edv3zXVzGIIrQ25zYEXafk6vh6xyCUhS', 2, '2025-11-11 04:41:22', '2025-11-11 04:41:22'),
(4, 'User4', 'user4@mail.com', '$2y$12$k.qE4FGsW1Y2waSmDRlD4OA3B42eyHj4Lk/G5g9GUWuNRubszYdqm', 3, '2025-11-11 04:41:23', '2025-11-11 04:41:23'),
(5, 'User5', 'user5@mail.com', '$2y$12$NG6Ip2UYRjGQQ2rF54chh.j4Z6aYekCXihKXD0Z9g9nU7hTHFOL9a', 1, '2025-11-11 04:41:23', '2025-11-11 04:41:23'),
(6, 'User6', 'user6@mail.com', '$2y$12$MizAFKK.wr5o.Up5/83jOO9/iNAMYwxfOqnhXIYz1ugmFDcHgR8g6', 2, '2025-11-11 04:41:23', '2025-11-11 04:41:23'),
(7, 'User7', 'user7@mail.com', '$2y$12$iN5ovUTdZcdamCDvnHXXd.qGAIibJIrLGSOvx7BgPTZdsr3sXum8m', 1, '2025-11-11 04:41:23', '2025-11-11 04:41:23'),
(8, 'User8', 'user8@mail.com', '$2y$12$Pgk6FClPaejVOhaKFoACkePjILMTgNX2sS9POQ9BpqtvN.1Qcfbla', 3, '2025-11-11 04:41:24', '2025-11-11 04:41:24'),
(9, 'User9', 'user9@mail.com', '$2y$12$iLHtPkwMuqBbNd4nWLEUtuPMNPrWVnzX0ufXPoyB3wbZe2IO5XyqG', 3, '2025-11-11 04:41:24', '2025-11-11 04:41:24'),
(10, 'User10', 'user10@mail.com', '$2y$12$swpH8yr94k5a/wSO9yCPnO6UDQQ9Q3QQZOxiwQEW4SyU5hcDo.vzu', 2, '2025-11-11 04:41:24', '2025-11-11 04:41:24'),
(11, 'User11', 'user11@mail.com', '$2y$12$gPcR/LWNAjJgiY4PmmqoPuFdLZxKrA3Ie2ejkcTvbySKaZuq7//xO', 2, '2025-11-11 04:41:25', '2025-11-11 04:41:25'),
(12, 'User12', 'user12@mail.com', '$2y$12$J1RGrpW5Ctva0GwJNNL2qe0gnXF81nlEk.hYtUBiLKv53PY9ipxba', 2, '2025-11-11 04:41:25', '2025-11-11 04:41:25'),
(13, 'User13', 'user13@mail.com', '$2y$12$2hVQLGAWPikMGGyfHOtNG.xQd0qHJnhsKe1A/no5urgM.ej4ZO2zO', 2, '2025-11-11 04:41:25', '2025-11-11 04:41:25'),
(14, 'User14', 'user14@mail.com', '$2y$12$ONywcuwXVNRAM5zeqpSA5u87exGPVviHHO8zmxc313uYhAz2jbc.a', 2, '2025-11-11 04:41:25', '2025-11-11 04:41:25'),
(15, 'User15', 'user15@mail.com', '$2y$12$bYvQ6h84hKA55UJOznGnteIeBOABUsbaAjK9BMOH5ZI0Dt86DeV0W', 2, '2025-11-11 04:41:26', '2025-11-11 04:41:26'),
(16, 'User16', 'user16@mail.com', '$2y$12$Xp6Q18428MjVQS4JDQwk3O27bQSQBekN7SqWS4UgkvvbMoez/wElS', 2, '2025-11-11 04:41:26', '2025-11-11 04:41:26'),
(17, 'User17', 'user17@mail.com', '$2y$12$a8LGMgdOufVzLwSfGDPa5OD2JtcVtJ/uJmhEIH9.QYUkO0H.X1S6q', 2, '2025-11-11 04:41:26', '2025-11-11 04:41:26'),
(18, 'User18', 'user18@mail.com', '$2y$12$qz5rWlZZQmkLRsduzt8BHuwPmX6VsNWJD04G/bV/65gF/wdH8rn/W', 1, '2025-11-11 04:41:27', '2025-11-11 04:41:27'),
(19, 'User19', 'user19@mail.com', '$2y$12$6OgXe7nr6RTDzRdD0JKCH.D9YoKE9Tngz2fAewYPMFnhqR8IEjCSm', 3, '2025-11-11 04:41:27', '2025-11-11 04:41:27'),
(20, 'User20', 'user20@mail.com', '$2y$12$Cf9597FS.miUOyfTR54JIecjyY1dK0qOg2koGgCvOEJIUi9mXSYni', 3, '2025-11-11 04:41:27', '2025-11-11 04:41:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attempts`
--
ALTER TABLE `attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `student_id` (`student_id`);

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
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attempt_id` (`attempt_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attempts`
--
ALTER TABLE `attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attempts`
--
ALTER TABLE `attempts`
  ADD CONSTRAINT `attempts_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attempts_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`attempt_id`) REFERENCES `attempts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
