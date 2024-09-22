-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2024 at 09:38 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wooxtravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'mazen adel', 'mazenzaky153@gmail.com', '$2y$12$8K8TnVSXQbRTgilnWqcZx.LMOFYMkArRwcS9X1QzWjn7/iiGvnADC', '2024-09-18 13:10:56', '2024-09-18 13:10:56');

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(24, 'Historical', '2024-09-11 18:45:04', '2024-09-11 18:45:04'),
(25, 'Recreational', '2024-09-11 18:45:04', '2024-09-11 18:45:04'),
(26, 'Cultural', '2024-09-11 18:45:04', '2024-09-11 18:45:04'),
(27, 'Natural', '2024-09-11 18:45:04', '2024-09-11 18:45:04'),
(28, 'Crowded', '2024-09-11 18:45:04', '2024-09-11 18:45:04'),
(29, 'Calm', '2024-09-11 18:45:04', '2024-09-11 18:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `price` varchar(30) NOT NULL,
  `num_days` int(11) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `image`, `price`, `num_days`, `country_id`, `created_at`, `updated_at`, `video`) VALUES
(1, 'Giza ', 'aswan.jpeg', '100', 13, 1, '2024-09-09 16:53:45', '2024-09-09 16:53:45', 'Let s Go - Egypt _ A Beautiful Destinations Original.mp4'),
(2, 'Cairo ', 'cairo.jpeg', '100', 5, 1, '2024-09-10 21:09:56', '2024-09-10 21:09:56', 'cairo.mp4'),
(3, 'Alex ', 'alex.jpeg', '100', 6, 1, '2024-09-10 21:09:56', '2024-09-10 21:09:56', 'alex.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `population` varchar(30) NOT NULL,
  `territory` varchar(30) NOT NULL,
  `avg_price` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `continent` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `population`, `territory`, `avg_price`, `description`, `image`, `continent`, `created_at`, `updated_at`) VALUES
(1, 'Egypt', '500', '254', 3000, 'welcome to egypt', 'Egypt.jpg', 'africa', '2024-09-09 16:52:48', '2024-09-09 16:52:48');

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
-- Table structure for table `landmarks`
--

CREATE TABLE `landmarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `video` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mainImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `landmarks`
--

INSERT INTO `landmarks` (`id`, `city_id`, `name`, `desc`, `video`, `address`, `created_at`, `updated_at`, `mainImage`) VALUES
(1, 1, 'pyramids', 'greattttttttttttttttttte ', 'Let s Go - Egypt _ A Beautiful Destinations Original.mp4', 'this is address', NULL, NULL, ''),
(3, 2, 'tower', 'Throughout history, iconic temples and buildings were constructed to symbolize power, with height being one of the main aspects used to impress the population.\r\n\r\nFor instance, the Great Pyramid of Giza, which was built to house the tomb of Pharaoh Khufu, was once the tallest monument in Egypt for nearly 4,000 years, before it was overtaken by the Cairo Tower in 1961.\r\n\r\nYet buildings can also hold ulterior motives or represent key events in history, such as the windowless AT&T Long Lines Building, located in the middle of New York City at 33 Thomas Street, which is reported to be one of the most important National Security Agency surveillance sites around the world, according to an investigation by The Intercept. According to Martin Parker, Chicago’s home insurance building, which is considered the first modern skyscraper, represents the moment when the economic system of capitalism came to be “materialized in steel and glass” – a sign of breaking into a new world. \r\n\r\nStanding in Downtown Cairo, the modern monument known as the ‘Cairo Tower’ (Borg Al-Qāhira), which is 50 meters above the Great Pyramid, also represents a new chapter in Egypt’s history. Some reports state that it represents a well known attempt by former Egyptian President Gamal Abdul Nasser to mock foreign powers and leaders at that time, as part of his plan to alter the balance of Egyptian-American relations, according to some writers.', 'video.mp4', 'middle of cairo', NULL, NULL, 'cairo-landmark-tower.jpg'),
(4, 2, 'elhoseen', 'Throughout history, iconic temples and buildings were constructed to symbolize power, with height being one of the main aspects used to impress the population.\r\n\r\nFor instance, the Great Pyramid of Giza, which was built to house the tomb of Pharaoh Khufu, was once the tallest monument in Egypt for nearly 4,000 years, before it was overtaken by the Cairo Tower in 1961.\r\n\r\nYet buildings can also hold ulterior motives or represent key events in history, such as the windowless AT&T Long Lines Building, located in the middle of New York City at 33 Thomas Street, which is reported to be one of the most important National Security Agency surveillance sites around the world, according to an investigation by The Intercept. According to Martin Parker, Chicago’s home insurance building, which is considered the first modern skyscraper, represents the moment when the economic system of capitalism came to be “materialized in steel and glass” – a sign of breaking into a new world. \r\n\r\nStanding in Downtown Cairo, the modern monument known as the ‘Cairo Tower’ (Borg Al-Qāhira), which is 50 meters above the Great Pyramid, also represents a new chapter in Egypt’s history. Some reports state that it represents a well known attempt by former Egyptian President Gamal Abdul Nasser to mock foreign powers and leaders at that time, as part of his plan to alter the balance of Egyptian-American relations, according to some writers.', 'video.mp4', 'middle of elhoseen', NULL, NULL, 'cairo-landmark-elhoseen.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `landmarks_images`
--

CREATE TABLE `landmarks_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `landmark_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `landmarks_images`
--

INSERT INTO `landmarks_images` (`id`, `name`, `landmark_id`, `created_at`, `updated_at`) VALUES
(1, 'cairo-landmark-tower.jpg', 3, NULL, NULL),
(2, 'cairo-landmark-elhoseen.jpg', 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `landmark_category`
--

CREATE TABLE `landmark_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `landmark_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `landmark_category`
--

INSERT INTO `landmark_category` (`id`, `landmark_id`, `category_id`, `created_at`, `updated_at`) VALUES
(5, 4, 28, NULL, NULL),
(6, 1, 24, NULL, NULL),
(7, 4, 24, NULL, NULL),
(8, 4, 26, NULL, NULL),
(9, 3, 25, NULL, NULL),
(10, 3, 29, NULL, NULL),
(11, 3, 25, NULL, NULL),
(12, 1, 29, NULL, NULL);

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_09_08_175352_create_admins_table', 1),
(5, '2024_09_08_175352_create_countries_table', 1),
(6, '2024_09_08_175353_create_cities_table', 1),
(7, '2024_09_08_175353_create_landmarks_table', 1),
(8, '2024_09_08_175353_create_reservations_table', 1),
(9, '2024_09_09_164243_create_table_landmarks_images_table', 2),
(10, '2024_09_09_181715_add_video_to_cities_table', 3),
(11, '2024_09_09_182110_add_video_to_cities_table', 4),
(12, '2024_09_10_213309_create_categories_table', 5),
(13, '2024_09_10_213640_create_landmark_category_table', 5),
(14, '2024_09_10_213746_create_preferences_table', 5),
(15, '2024_09_10_214242_create_preference_options_table', 5),
(16, '2024_09_10_234611_rename_table_landmarks_images_to_landmarks_images', 6),
(17, '2024_09_12_134609_add_main_image_to_landmarks_table', 7),
(20, '2024_09_14_194533_create_tour_guides_table', 8),
(21, '2024_09_18_142213_add_columns_to_reservations_table', 9);

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
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `type` enum('single','multiple') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`id`, `question`, `type`, `created_at`, `updated_at`) VALUES
(13, 'What type of activities do you enjoy?', 'multiple', '2024-09-11 18:45:04', '2024-09-11 18:45:04'),
(14, 'What kind of landmarks are you interested in?', 'multiple', '2024-09-11 18:45:04', '2024-09-11 18:45:04'),
(15, 'Do you prefer crowded places?', 'multiple', '2024-09-11 18:45:04', '2024-09-11 18:45:04'),
(16, 'What time of day do you prefer exploring landmarks?', 'single', '2024-09-11 18:45:04', '2024-09-11 18:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `preference_options`
--

CREATE TABLE `preference_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `preference_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `option` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `preference_options`
--

INSERT INTO `preference_options` (`id`, `preference_id`, `category_id`, `option`, `created_at`, `updated_at`) VALUES
(19, 13, 26, 'Museums', '2024-09-11 18:45:04', '2024-09-11 18:45:04'),
(20, 13, 27, 'Hiking Trails', '2024-09-11 18:45:04', '2024-09-11 18:45:04'),
(21, 14, 24, 'Historical Sites', '2024-09-11 18:45:04', '2024-09-11 18:45:04'),
(22, 14, 25, 'Parks', '2024-09-11 18:45:04', '2024-09-11 18:45:04'),
(23, 15, 28, 'Yes, I enjoy crowded places', '2024-09-11 18:45:04', '2024-09-11 18:45:04'),
(24, 15, 29, 'No, I prefer quiet places', '2024-09-11 18:45:04', '2024-09-11 18:45:04'),
(25, 16, NULL, 'Morning', '2024-09-11 18:45:04', '2024-09-11 18:45:04'),
(26, 16, NULL, 'Evening', '2024-09-11 18:45:04', '2024-09-11 18:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `num_guests` int(11) NOT NULL,
  `check_in_date` varchar(200) NOT NULL,
  `destination` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'Processing',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `days` int(11) NOT NULL,
  `tourGuied_status` varchar(255) NOT NULL,
  `tourGuied_name` varchar(255) NOT NULL,
  `tourGuied_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `phone_number`, `num_guests`, `check_in_date`, `destination`, `price`, `user_id`, `status`, `created_at`, `updated_at`, `days`, `tourGuied_status`, `tourGuied_name`, `tourGuied_id`) VALUES
(1, 'mazen adel mohamed zakiy', 1288965010, 3, '2024-09-20', 'Cairo', 900, 3, 'Processing', '2024-09-18 07:56:20', '2024-09-18 07:56:20', 0, '', '', 0),
(2, 'shady adel Mohamed zakiy', 1288965010, 3, '2024-09-20', 'Cairo', 900, 3, 'Processing', '2024-09-18 08:08:17', '2024-09-18 08:08:17', 0, '', '', 0),
(3, 'sadek', 1111111111, 4, '2024-09-26', 'Cairo', 1200, 3, 'Booked Successfully', '2024-09-18 10:00:48', '2024-09-18 10:11:31', 0, '', '', 0),
(4, 'khalefa', 1288965010, 2, '2024-09-28', 'Giza', 800, 3, 'Processing', '2024-09-18 10:17:53', '2024-09-18 10:17:53', 0, '', '', 0),
(5, 'مازن عادل محمد ذكي', 1288965010, 1, '2024-09-28', 'Cairo', 300, 3, 'Processing', '2024-09-18 12:53:57', '2024-09-18 13:04:41', 1, 'online', 'mazen adel', 1),
(6, 'مازن عادل محمد ذكي', 1288965010, 1, '2024-09-20', 'Cairo', 100, 3, 'Booked Successfully', '2024-09-18 13:45:25', '2024-09-18 14:19:29', 1, 'online', 'mazen adel', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('HizBCFx2JW7EuaVGTFQuu8zIhAsuWvQsptOGaJi4', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoibVpSN1hxNWVBbzdQN1k2NFBwcTA3UjJxNXdMdUl5WVpRUkN6SnMzeCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzI2NzU1MTkzO31zOjQ6ImxhbmciO3M6MjoiZW4iO30=', 1726755634),
('KB3lSpRX06qSbod2XzJ4WpfbtLvl7D8bVEsMvmBo', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiajFTVWIxOEJQUDJPUXF4SkRGMWtsejFETDFaU2Radk9zZ2pJTnkxUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmF2ZWxpbmcvc2hvdy9ETVNhbnMtUmVndWxhci50dGYiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTcyNjY1NjQ3Mzt9czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiY2FydCI7YToxOntpOjQ7TzoyODoiQXBwXE1vZGVsc1xMYW5kbWFya1xMYW5kbWFyayI6MzA6e3M6MTM6IgAqAGNvbm5lY3Rpb24iO3M6NToibXlzcWwiO3M6ODoiACoAdGFibGUiO3M6OToibGFuZG1hcmtzIjtzOjEzOiIAKgBwcmltYXJ5S2V5IjtzOjI6ImlkIjtzOjEwOiIAKgBrZXlUeXBlIjtzOjM6ImludCI7czoxMjoiaW5jcmVtZW50aW5nIjtiOjE7czo3OiIAKgB3aXRoIjthOjA6e31zOjEyOiIAKgB3aXRoQ291bnQiO2E6MDp7fXM6MTk6InByZXZlbnRzTGF6eUxvYWRpbmciO2I6MDtzOjEwOiIAKgBwZXJQYWdlIjtpOjE1O3M6NjoiZXhpc3RzIjtiOjE7czoxODoid2FzUmVjZW50bHlDcmVhdGVkIjtiOjA7czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO3M6MTM6IgAqAGF0dHJpYnV0ZXMiO2E6OTp7czoyOiJpZCI7aTo0O3M6NzoiY2l0eV9pZCI7aToyO3M6NDoibmFtZSI7czo4OiJlbGhvc2VlbiI7czo0OiJkZXNjIjtzOjE0NDI6IlRocm91Z2hvdXQgaGlzdG9yeSwgaWNvbmljIHRlbXBsZXMgYW5kIGJ1aWxkaW5ncyB3ZXJlIGNvbnN0cnVjdGVkIHRvIHN5bWJvbGl6ZSBwb3dlciwgd2l0aCBoZWlnaHQgYmVpbmcgb25lIG9mIHRoZSBtYWluIGFzcGVjdHMgdXNlZCB0byBpbXByZXNzIHRoZSBwb3B1bGF0aW9uLg0KDQpGb3IgaW5zdGFuY2UsIHRoZSBHcmVhdCBQeXJhbWlkIG9mIEdpemEsIHdoaWNoIHdhcyBidWlsdCB0byBob3VzZSB0aGUgdG9tYiBvZiBQaGFyYW9oIEtodWZ1LCB3YXMgb25jZSB0aGUgdGFsbGVzdCBtb251bWVudCBpbiBFZ3lwdCBmb3IgbmVhcmx5IDQsMDAwIHllYXJzLCBiZWZvcmUgaXQgd2FzIG92ZXJ0YWtlbiBieSB0aGUgQ2Fpcm8gVG93ZXIgaW4gMTk2MS4NCg0KWWV0IGJ1aWxkaW5ncyBjYW4gYWxzbyBob2xkIHVsdGVyaW9yIG1vdGl2ZXMgb3IgcmVwcmVzZW50IGtleSBldmVudHMgaW4gaGlzdG9yeSwgc3VjaCBhcyB0aGUgd2luZG93bGVzcyBBVCZUIExvbmcgTGluZXMgQnVpbGRpbmcsIGxvY2F0ZWQgaW4gdGhlIG1pZGRsZSBvZiBOZXcgWW9yayBDaXR5IGF0IDMzIFRob21hcyBTdHJlZXQsIHdoaWNoIGlzIHJlcG9ydGVkIHRvIGJlIG9uZSBvZiB0aGUgbW9zdCBpbXBvcnRhbnQgTmF0aW9uYWwgU2VjdXJpdHkgQWdlbmN5IHN1cnZlaWxsYW5jZSBzaXRlcyBhcm91bmQgdGhlIHdvcmxkLCBhY2NvcmRpbmcgdG8gYW4gaW52ZXN0aWdhdGlvbiBieSBUaGUgSW50ZXJjZXB0LiBBY2NvcmRpbmcgdG8gTWFydGluIFBhcmtlciwgQ2hpY2Fnb+KAmXMgaG9tZSBpbnN1cmFuY2UgYnVpbGRpbmcsIHdoaWNoIGlzIGNvbnNpZGVyZWQgdGhlIGZpcnN0IG1vZGVybiBza3lzY3JhcGVyLCByZXByZXNlbnRzIHRoZSBtb21lbnQgd2hlbiB0aGUgZWNvbm9taWMgc3lzdGVtIG9mIGNhcGl0YWxpc20gY2FtZSB0byBiZSDigJxtYXRlcmlhbGl6ZWQgaW4gc3RlZWwgYW5kIGdsYXNz4oCdIOKAkyBhIHNpZ24gb2YgYnJlYWtpbmcgaW50byBhIG5ldyB3b3JsZC4gDQoNClN0YW5kaW5nIGluIERvd250b3duIENhaXJvLCB0aGUgbW9kZXJuIG1vbnVtZW50IGtub3duIGFzIHRoZSDigJhDYWlybyBUb3dlcuKAmSAoQm9yZyBBbC1RxIFoaXJhKSwgd2hpY2ggaXMgNTAgbWV0ZXJzIGFib3ZlIHRoZSBHcmVhdCBQeXJhbWlkLCBhbHNvIHJlcHJlc2VudHMgYSBuZXcgY2hhcHRlciBpbiBFZ3lwdOKAmXMgaGlzdG9yeS4gU29tZSByZXBvcnRzIHN0YXRlIHRoYXQgaXQgcmVwcmVzZW50cyBhIHdlbGwga25vd24gYXR0ZW1wdCBieSBmb3JtZXIgRWd5cHRpYW4gUHJlc2lkZW50IEdhbWFsIEFiZHVsIE5hc3NlciB0byBtb2NrIGZvcmVpZ24gcG93ZXJzIGFuZCBsZWFkZXJzIGF0IHRoYXQgdGltZSwgYXMgcGFydCBvZiBoaXMgcGxhbiB0byBhbHRlciB0aGUgYmFsYW5jZSBvZiBFZ3lwdGlhbi1BbWVyaWNhbiByZWxhdGlvbnMsIGFjY29yZGluZyB0byBzb21lIHdyaXRlcnMuIjtzOjU6InZpZGVvIjtzOjk6InZpZGVvLm1wNCI7czo3OiJhZGRyZXNzIjtzOjE4OiJtaWRkbGUgb2YgZWxob3NlZW4iO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjk6Im1haW5JbWFnZSI7czoyNzoiY2Fpcm8tbGFuZG1hcmstZWxob3NlZW4uanBnIjt9czoxMToiACoAb3JpZ2luYWwiO2E6OTp7czoyOiJpZCI7aTo0O3M6NzoiY2l0eV9pZCI7aToyO3M6NDoibmFtZSI7czo4OiJlbGhvc2VlbiI7czo0OiJkZXNjIjtzOjE0NDI6IlRocm91Z2hvdXQgaGlzdG9yeSwgaWNvbmljIHRlbXBsZXMgYW5kIGJ1aWxkaW5ncyB3ZXJlIGNvbnN0cnVjdGVkIHRvIHN5bWJvbGl6ZSBwb3dlciwgd2l0aCBoZWlnaHQgYmVpbmcgb25lIG9mIHRoZSBtYWluIGFzcGVjdHMgdXNlZCB0byBpbXByZXNzIHRoZSBwb3B1bGF0aW9uLg0KDQpGb3IgaW5zdGFuY2UsIHRoZSBHcmVhdCBQeXJhbWlkIG9mIEdpemEsIHdoaWNoIHdhcyBidWlsdCB0byBob3VzZSB0aGUgdG9tYiBvZiBQaGFyYW9oIEtodWZ1LCB3YXMgb25jZSB0aGUgdGFsbGVzdCBtb251bWVudCBpbiBFZ3lwdCBmb3IgbmVhcmx5IDQsMDAwIHllYXJzLCBiZWZvcmUgaXQgd2FzIG92ZXJ0YWtlbiBieSB0aGUgQ2Fpcm8gVG93ZXIgaW4gMTk2MS4NCg0KWWV0IGJ1aWxkaW5ncyBjYW4gYWxzbyBob2xkIHVsdGVyaW9yIG1vdGl2ZXMgb3IgcmVwcmVzZW50IGtleSBldmVudHMgaW4gaGlzdG9yeSwgc3VjaCBhcyB0aGUgd2luZG93bGVzcyBBVCZUIExvbmcgTGluZXMgQnVpbGRpbmcsIGxvY2F0ZWQgaW4gdGhlIG1pZGRsZSBvZiBOZXcgWW9yayBDaXR5IGF0IDMzIFRob21hcyBTdHJlZXQsIHdoaWNoIGlzIHJlcG9ydGVkIHRvIGJlIG9uZSBvZiB0aGUgbW9zdCBpbXBvcnRhbnQgTmF0aW9uYWwgU2VjdXJpdHkgQWdlbmN5IHN1cnZlaWxsYW5jZSBzaXRlcyBhcm91bmQgdGhlIHdvcmxkLCBhY2NvcmRpbmcgdG8gYW4gaW52ZXN0aWdhdGlvbiBieSBUaGUgSW50ZXJjZXB0LiBBY2NvcmRpbmcgdG8gTWFydGluIFBhcmtlciwgQ2hpY2Fnb+KAmXMgaG9tZSBpbnN1cmFuY2UgYnVpbGRpbmcsIHdoaWNoIGlzIGNvbnNpZGVyZWQgdGhlIGZpcnN0IG1vZGVybiBza3lzY3JhcGVyLCByZXByZXNlbnRzIHRoZSBtb21lbnQgd2hlbiB0aGUgZWNvbm9taWMgc3lzdGVtIG9mIGNhcGl0YWxpc20gY2FtZSB0byBiZSDigJxtYXRlcmlhbGl6ZWQgaW4gc3RlZWwgYW5kIGdsYXNz4oCdIOKAkyBhIHNpZ24gb2YgYnJlYWtpbmcgaW50byBhIG5ldyB3b3JsZC4gDQoNClN0YW5kaW5nIGluIERvd250b3duIENhaXJvLCB0aGUgbW9kZXJuIG1vbnVtZW50IGtub3duIGFzIHRoZSDigJhDYWlybyBUb3dlcuKAmSAoQm9yZyBBbC1RxIFoaXJhKSwgd2hpY2ggaXMgNTAgbWV0ZXJzIGFib3ZlIHRoZSBHcmVhdCBQeXJhbWlkLCBhbHNvIHJlcHJlc2VudHMgYSBuZXcgY2hhcHRlciBpbiBFZ3lwdOKAmXMgaGlzdG9yeS4gU29tZSByZXBvcnRzIHN0YXRlIHRoYXQgaXQgcmVwcmVzZW50cyBhIHdlbGwga25vd24gYXR0ZW1wdCBieSBmb3JtZXIgRWd5cHRpYW4gUHJlc2lkZW50IEdhbWFsIEFiZHVsIE5hc3NlciB0byBtb2NrIGZvcmVpZ24gcG93ZXJzIGFuZCBsZWFkZXJzIGF0IHRoYXQgdGltZSwgYXMgcGFydCBvZiBoaXMgcGxhbiB0byBhbHRlciB0aGUgYmFsYW5jZSBvZiBFZ3lwdGlhbi1BbWVyaWNhbiByZWxhdGlvbnMsIGFjY29yZGluZyB0byBzb21lIHdyaXRlcnMuIjtzOjU6InZpZGVvIjtzOjk6InZpZGVvLm1wNCI7czo3OiJhZGRyZXNzIjtzOjE4OiJtaWRkbGUgb2YgZWxob3NlZW4iO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjk6Im1haW5JbWFnZSI7czoyNzoiY2Fpcm8tbGFuZG1hcmstZWxob3NlZW4uanBnIjt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YTowOnt9czoxNzoiACoAY2xhc3NDYXN0Q2FjaGUiO2E6MDp7fXM6MjE6IgAqAGF0dHJpYnV0ZUNhc3RDYWNoZSI7YTowOnt9czoxMzoiACoAZGF0ZUZvcm1hdCI7TjtzOjEwOiIAKgBhcHBlbmRzIjthOjA6e31zOjE5OiIAKgBkaXNwYXRjaGVzRXZlbnRzIjthOjA6e31zOjE0OiIAKgBvYnNlcnZhYmxlcyI7YTowOnt9czoxMjoiACoAcmVsYXRpb25zIjthOjE6e3M6NDoiY2l0eSI7TzoyMDoiQXBwXE1vZGVsc1xDaXR5XENpdHkiOjMwOntzOjEzOiIAKgBjb25u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', 1726684614),
('WuKnmQe4XJZG8b1n13Nx7SO8EnJBOQq7BazXtqX7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV0YyMk5FSHZLNFZLV2ZzUzNWdXVCT3lTcmE2aG10SmVuZXAxZjdtZCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2FsbC1hZG1pbnMiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1726771480);

-- --------------------------------------------------------

--
-- Table structure for table `tour_guides`
--

CREATE TABLE `tour_guides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `identification` bigint(20) NOT NULL,
  `identification_image` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `gendre` enum('male','female') NOT NULL DEFAULT 'male',
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_guides`
--

INSERT INTO `tour_guides` (`id`, `name`, `email`, `identification`, `identification_image`, `age`, `image`, `gendre`, `city_id`, `created_at`, `updated_at`) VALUES
(1, 'mazen adel ', 'mazenzaky153@gmail.com', 30103211300572, 'mazen.jpg', 24, 'mazen adel.jpg', 'male', 2, NULL, NULL),
(2, 'shadyadel ', 'shady@gmail.com', 30103211111111, 'shady.jpg', 24, 'shady.jpg', 'male', 2, NULL, NULL),
(3, 'Lucy ', 'Lucy@gmail.com', 30103211111111, 'Lucy.jpg', 20, 'Lucy.jpg', 'female', 2, NULL, NULL),
(4, 'sadek', 'sadek@gmail.com', 30103211111111, 'sadek.jpg', 22, 'sadek.jpg', 'male', 1, NULL, NULL);

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
(1, 'Test User', 'test@example.com', '2024-09-11 12:18:21', '$2y$12$rIngJdgHBHXxtfo7FWjdDufxl3D8.BmJvKkPY8P5Ez1MlKZ4Kga.2', 'HWyA42o1mS', '2024-09-11 12:18:22', '2024-09-11 12:18:22'),
(3, 'mazen adel mohamed zakiy', 'mazenzaky153@gmail.com', NULL, '$2y$12$8K8TnVSXQbRTgilnWqcZx.LMOFYMkArRwcS9X1QzWjn7/iiGvnADC', NULL, '2024-09-14 18:25:20', '2024-09-14 18:25:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `landmarks`
--
ALTER TABLE `landmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `landmarks_city_id_foreign` (`city_id`);

--
-- Indexes for table `landmarks_images`
--
ALTER TABLE `landmarks_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_landmarks_images_landmark_id_foreign` (`landmark_id`);

--
-- Indexes for table `landmark_category`
--
ALTER TABLE `landmark_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `landmark_category_landmark_id_foreign` (`landmark_id`),
  ADD KEY `landmark_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preference_options`
--
ALTER TABLE `preference_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preference_options_preference_id_foreign` (`preference_id`),
  ADD KEY `preference_options_category_id_foreign` (`category_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tour_guides`
--
ALTER TABLE `tour_guides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_guides_city_id_foreign` (`city_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `landmarks`
--
ALTER TABLE `landmarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `landmarks_images`
--
ALTER TABLE `landmarks_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `landmark_category`
--
ALTER TABLE `landmark_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `preference_options`
--
ALTER TABLE `preference_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tour_guides`
--
ALTER TABLE `tour_guides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Constraints for table `landmarks`
--
ALTER TABLE `landmarks`
  ADD CONSTRAINT `landmarks_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `landmarks_images`
--
ALTER TABLE `landmarks_images`
  ADD CONSTRAINT `table_landmarks_images_landmark_id_foreign` FOREIGN KEY (`landmark_id`) REFERENCES `landmarks` (`id`);

--
-- Constraints for table `landmark_category`
--
ALTER TABLE `landmark_category`
  ADD CONSTRAINT `landmark_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `landmark_category_landmark_id_foreign` FOREIGN KEY (`landmark_id`) REFERENCES `landmarks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `preference_options`
--
ALTER TABLE `preference_options`
  ADD CONSTRAINT `preference_options_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `preference_options_preference_id_foreign` FOREIGN KEY (`preference_id`) REFERENCES `preferences` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tour_guides`
--
ALTER TABLE `tour_guides`
  ADD CONSTRAINT `tour_guides_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
