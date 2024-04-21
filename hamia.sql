-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2023 at 03:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hamia`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(6, 'kaka kuku', 'kaka', 'default.png', '2023-10-25 21:53:43', '2023-10-25 21:53:43'),
(13, 'hello kelvin cosmas', 'hello kelvin cosmas', 'default.png', '2023-10-27 12:59:48', '2023-10-27 12:59:48'),
(15, 'jane', 'jane', 'default.png', '2023-10-27 13:02:04', '2023-10-27 13:02:04'),
(16, 'cosmas', 'kelvin', 'default.png', '2023-10-28 10:44:22', '2023-10-28 10:44:22'),
(17, 'tra', 'henry', 'default.png', '2023-10-28 10:46:15', '2023-10-28 10:46:15'),
(18, 'test', 'cosmas', 'default.png', '2023-10-28 11:12:45', '2023-10-28 11:12:45'),
(19, 'iren', 'cosmas', 'default.png', '2023-10-28 11:13:01', '2023-10-28 11:13:01'),
(20, 'cosmas', 'kelvin cosmas', 'default.png', '2023-10-28 11:20:01', '2023-10-28 11:20:01'),
(21, 'Hello Kelvin', 'cosmas', 'default.png', '2023-10-28 13:19:54', '2023-10-28 13:19:54');

-- --------------------------------------------------------

--
-- Table structure for table `category_post`
--

CREATE TABLE `category_post` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `characteristics`
--

CREATE TABLE `characteristics` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_requests`
--

CREATE TABLE `client_requests` (
  `id` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `property_title` varchar(200) NOT NULL,
  `property_price` double NOT NULL,
  `district_id` int(11) NOT NULL,
  `sub_location` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` int(11) NOT NULL,
  `commentable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) DEFAULT NULL,
  `approved` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conditions`
--

CREATE TABLE `conditions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conditions`
--

INSERT INTO `conditions` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Fairly Used', 'fairly-used', '2023-12-26 23:09:49', '2023-12-26 23:09:49'),
(2, 'New Built', 'new-built', '2023-12-26 23:09:49', '2023-12-26 23:09:49'),
(3, 'Old', 'old', '2023-12-26 23:10:13', '2023-12-26 23:10:13'),
(4, 'Renovated', 'renovated', '2023-12-26 23:10:13', '2023-12-26 23:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `slug`, `created_at`, `update_at`) VALUES
(1, 'Tanzania', 'Tanzania', '2023-02-12 22:33:45', '2023-02-12 22:33:45'),
(2, 'Kenya', 'Kenya', '2023-02-12 22:33:45', '2023-02-12 22:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'TSH', '2023-02-21 02:09:13', '2023-02-21 02:09:13'),
(2, 'USD', '2023-02-21 02:09:22', '2023-02-21 02:09:22');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `creator_id` int(11) DEFAULT NULL,
  `updator_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `region_id`, `name`, `created_at`, `updated_at`, `creator_id`, `updator_id`) VALUES
(1, 1, 'Ubungo', '2023-04-29 21:15:45', '2023-04-29 21:15:45', NULL, NULL),
(2, 2, 'Arusha City', '2023-04-29 21:15:45', '2023-04-29 21:15:45', NULL, NULL),
(3, 3, 'Bagamoyo', '2023-07-02 11:32:03', '2023-07-02 11:32:03', NULL, NULL),
(4, 1, 'Kinondon', '2023-07-02 20:59:49', '2023-07-02 20:59:49', NULL, NULL),
(5, 1, 'Ilala', '2023-07-02 20:59:49', '2023-07-02 20:59:49', NULL, NULL),
(6, 1, 'Temeke', '2023-07-02 21:00:08', '2023-07-02 21:00:08', NULL, NULL),
(7, 1, 'Kigamboni', '2023-07-02 21:00:08', '2023-07-02 21:00:08', NULL, NULL),
(8, 2, 'Karatu', '2023-07-02 21:01:37', '2023-07-02 21:01:37', NULL, NULL),
(9, 2, 'Arumeru', '2023-07-02 21:01:37', '2023-07-02 21:01:37', NULL, NULL),
(10, 2, 'Longido', '2023-07-02 21:02:09', '2023-07-02 21:02:09', NULL, NULL),
(11, 2, 'Meru', '2023-07-02 21:02:09', '2023-07-02 21:02:09', NULL, NULL),
(12, 2, 'Ngorongoro', '2023-07-02 21:02:25', '2023-07-02 21:02:25', NULL, NULL),
(13, 4, 'Ilemela', '2023-07-05 19:08:26', '2023-07-05 19:08:26', NULL, NULL),
(14, 4, 'Kwimba', '2023-07-05 19:08:26', '2023-07-05 19:08:26', NULL, NULL),
(15, 2, 'Magu', '2023-07-05 19:08:54', '2023-07-05 19:08:54', NULL, NULL),
(16, 4, 'Misungwi', '2023-07-05 19:08:54', '2023-07-05 19:08:54', NULL, NULL),
(17, 4, 'Nyamagana', '2023-07-05 19:09:26', '2023-07-05 19:09:26', NULL, NULL),
(18, 4, 'Sengerema', '2023-07-05 19:09:26', '2023-07-05 19:09:26', NULL, NULL),
(19, 4, 'Ukerewe', '2023-07-05 19:09:41', '2023-07-05 19:09:41', NULL, NULL),
(20, 5, 'Kondoa', '2023-07-05 19:13:20', '2023-07-05 19:13:20', NULL, NULL),
(21, 5, 'Chemba', '2023-07-05 19:13:20', '2023-07-05 19:13:20', NULL, NULL),
(22, 5, 'Dodoma', '2023-07-05 19:13:49', '2023-07-05 19:13:49', NULL, NULL),
(23, 5, 'Chamwino', '2023-07-05 19:13:49', '2023-07-05 19:13:49', NULL, NULL),
(24, 5, 'Kongwa', '2023-07-05 19:14:16', '2023-07-05 19:14:16', NULL, NULL),
(25, 5, 'Mpwapwa', '2023-07-05 19:14:16', '2023-07-05 19:14:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Swimming pool', 'Swimming pool', '2023-02-12 00:43:40', '2023-02-12 00:43:40'),
(2, 'Terrace', 'Terrace', '2023-02-12 00:45:31', '2023-02-12 00:45:31'),
(3, 'Internet', 'Internet', '2023-02-12 10:40:23', '2023-02-12 10:40:23'),
(6, 'Car Parking', 'Car Parking', NULL, NULL),
(7, 'Water Source', 'Water Source', NULL, NULL),
(8, 'Electricity', 'Electricity', NULL, NULL),
(9, 'Air conditioning', 'Air conditioning', NULL, NULL),
(10, 'Cable TV', 'Cable TV', NULL, NULL),
(11, 'Roof terrace', 'Roof terrace', NULL, NULL),
(12, 'Balcony', 'Balcony', NULL, NULL),
(13, 'Radio', 'Radio', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feature_properties`
--

CREATE TABLE `feature_properties` (
  `id` int(10) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feature_properties`
--

INSERT INTO `feature_properties` (`id`, `property_id`, `feature_id`, `created_at`, `updated_at`) VALUES
(467, 30, 12, '2023-12-15 22:21:21', '2023-12-15 22:21:21'),
(468, 30, 10, '2023-12-15 22:21:21', '2023-12-15 22:21:21'),
(469, 30, 6, '2023-12-15 22:21:21', '2023-12-15 22:21:21'),
(470, 30, 8, '2023-12-15 22:21:21', '2023-12-15 22:21:21'),
(471, 29, 9, '2023-12-15 22:22:31', '2023-12-15 22:22:31'),
(472, 29, 10, '2023-12-15 22:22:31', '2023-12-15 22:22:31'),
(473, 31, 10, '2023-12-15 23:04:54', '2023-12-15 23:04:54'),
(474, 31, 6, '2023-12-15 23:04:54', '2023-12-15 23:04:54'),
(475, 32, 6, '2023-12-18 00:29:04', '2023-12-18 00:29:04'),
(476, 32, 8, '2023-12-18 00:29:04', '2023-12-18 00:29:04'),
(477, 33, 9, '2023-12-27 01:40:07', '2023-12-27 01:40:07'),
(478, 33, 12, '2023-12-27 01:40:07', '2023-12-27 01:40:07'),
(479, 33, 6, '2023-12-27 01:40:07', '2023-12-27 01:40:07'),
(480, 34, 9, '2023-12-27 01:43:05', '2023-12-27 01:43:05'),
(481, 34, 12, '2023-12-27 01:43:05', '2023-12-27 01:43:05'),
(482, 35, 12, '2023-12-27 01:49:30', '2023-12-27 01:49:30'),
(483, 35, 10, '2023-12-27 01:49:30', '2023-12-27 01:49:30'),
(484, 36, 10, '2023-12-27 01:54:20', '2023-12-27 01:54:20'),
(485, 37, 9, '2023-12-27 01:57:16', '2023-12-27 01:57:16'),
(486, 37, 12, '2023-12-27 01:57:16', '2023-12-27 01:57:16'),
(487, 38, 9, '2023-12-27 01:57:54', '2023-12-27 01:57:54'),
(488, 38, 12, '2023-12-27 01:57:54', '2023-12-27 01:57:54'),
(489, 39, 9, '2023-12-27 02:00:17', '2023-12-27 02:00:17'),
(490, 39, 12, '2023-12-27 02:00:17', '2023-12-27 02:00:17'),
(491, 40, 9, '2023-12-27 02:02:24', '2023-12-27 02:02:24'),
(492, 40, 10, '2023-12-27 02:02:24', '2023-12-27 02:02:24'),
(495, 42, 9, '2023-12-27 02:14:11', '2023-12-27 02:14:11'),
(496, 42, 10, '2023-12-27 02:14:11', '2023-12-27 02:14:11'),
(501, 45, 9, '2023-12-27 03:53:38', '2023-12-27 03:53:38'),
(502, 45, 10, '2023-12-27 03:53:38', '2023-12-27 03:53:38'),
(511, 48, 12, '2023-12-27 04:48:40', '2023-12-27 04:48:40'),
(512, 48, 10, '2023-12-27 04:48:40', '2023-12-27 04:48:40'),
(513, 49, 12, '2023-12-27 05:40:46', '2023-12-27 05:40:46'),
(514, 49, 10, '2023-12-27 05:40:46', '2023-12-27 05:40:46');

-- --------------------------------------------------------

--
-- Table structure for table `feature_property`
--

CREATE TABLE `feature_property` (
  `id` int(10) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `furnishes`
--

CREATE TABLE `furnishes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `furnishes`
--

INSERT INTO `furnishes` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Furnished', 'furnished', '2023-12-26 23:08:14', '2023-12-26 23:08:14'),
(2, 'Unfurnished', 'unfurnished', '2023-12-26 23:08:14', '2023-12-26 23:08:14'),
(3, 'Semi-Furnished', 'semi-furnished', '2023-12-26 23:08:30', '2023-12-26 23:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(10) UNSIGNED NOT NULL,
  `album_id` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `agent_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `agent_id`, `user_id`, `property_id`, `name`, `email`, `phone`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 'cosmas', 'info@exactmanpower.co.tz', '0767059735', 'helpe me to get house', 0, '2023-10-14 08:22:50', '2023-10-14 08:22:50'),
(2, 1, NULL, NULL, 'Cosmas', 'admin@emcl.co.tz', '255767059735', 'Hello', 0, '2023-12-23 00:45:16', '2023-12-23 00:45:16');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `near_byes`
--

CREATE TABLE `near_byes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `near_byes`
--

INSERT INTO `near_byes` (`id`, `name`, `create_at`, `updated_at`) VALUES
(1, 'lami', '2023-09-08 23:26:18', '2023-09-08 23:26:18'),
(2, 'hotel', '2023-09-08 23:26:18', '2023-09-08 23:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('kevomassawe@gmail.com', '$2y$10$uqCcNd07vYD9/Vv6dZ6bkunbbOCqiR35BTcbCmDt01.0NzKA4ajiy', '2023-12-23 03:16:06');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) NOT NULL,
  `price` float DEFAULT NULL,
  `term_id` int(11) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `condition_id` int(11) DEFAULT NULL,
  `furnish_id` int(11) DEFAULT NULL,
  `purpose_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viewed` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `agent_id` int(11) DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `title`, `category_id`, `sub_category_id`, `price`, `term_id`, `featured`, `condition_id`, `furnish_id`, `purpose_id`, `type_id`, `currency_id`, `image`, `viewed`, `status`, `agent_id`, `description`, `created_at`, `updated_at`) VALUES
(29, 'we test', 1, 1, 3000, NULL, 1, NULL, NULL, 1, 12, 1, 'images/gallery/011216233122657cfbd75033a_74ca9ad50147d6b022ac7135dbfa366b.jpeg', 70, 0, 1, 'House', '2023-11-30 03:54:59', '2023-12-27 14:17:20'),
(30, 'house for sale at kigamboni yes baba', 1, 1, 3000000, NULL, 0, NULL, NULL, NULL, 12, 1, 'images/gallery/011216232221657cfb921cd7f_74ca9ad50147d6b022ac7135dbfa366b.jpeg', 30, 0, 1, 'test 02', '2023-12-15 22:13:57', '2023-12-27 13:32:25'),
(31, 'Furnished Studio Apartment in Masaki for rent', 1, 13, 600000, NULL, 0, NULL, NULL, NULL, 20, 1, 'images/gallery/021216235504657d05c7068ba_74ca9ad50147d6b022ac7135dbfa366b.jpeg', 39, 0, 1, '2 bedrooms (1) self contained \r\nSitting room, Kitchen, Public toilet, Private metre luku, Water service available 24 hrs, Full security, Heater, Fence, Tiles spain & gypsum, Alluminum windows sliding, Enough car parking space\r\nWhen you like the houses please call us to serve you more urgently!\r\n**for more houses and Apartments visit our Instagram page **', '2023-12-15 23:04:54', '2023-12-23 23:32:49'),
(32, 'godwon', 1, 2, 34500, NULL, 0, NULL, NULL, NULL, 19, 1, 'images/gallery/031218230429657fbc80ceb70_74ca9ad50147d6b022ac7135dbfa366b.jpeg', 17, 0, 1, 'Hello', '2023-12-18 00:29:04', '2023-12-27 05:59:52'),
(33, 'yes yes', 1, 13, 250, NULL, 0, NULL, NULL, NULL, 21, 1, 'images/gallery/041227230840658baaa8174e1_IMG-20231116-WA0008.jpg', 1, 0, 1, 'Yes good', '2023-12-27 01:40:07', '2023-12-27 01:40:08'),
(34, 'Yes Kelvin Cosmas', 1, 13, 7000, NULL, 0, NULL, NULL, NULL, 21, 1, 'images/gallery/041227230543658bab59d62e8_IMG-20231116-WA0008.jpg', 1, 0, 1, 'Yes Kelvin', '2023-12-27 01:43:05', '2023-12-27 01:43:06'),
(35, 'Yes Kelvin Cosmas', 1, 13, 9000, NULL, 0, NULL, NULL, NULL, 21, 1, 'images/gallery/041227233049658bacdabd81c_IMG-20231116-WA0008.jpg', 1, 0, 1, 'Hello Kelvin', '2023-12-27 01:49:29', '2023-12-27 01:49:31'),
(36, 'Yes Kelvin Cosmas', 1, 1, 9000, NULL, 0, NULL, NULL, NULL, 9, 1, 'images/gallery/041227232054658badfcb8c4e_IMG-20231116-WA0007.jpg', 1, 0, 1, 'Hello Kelvin', '2023-12-27 01:54:20', '2023-12-27 01:54:21'),
(37, 'Yes Kelvin Cosmas', 1, 13, 9000, NULL, 0, NULL, NULL, NULL, 21, 1, 'images/gallery/041227231757658baead1971f_IMG-20231116-WA0008.jpg', 1, 0, 1, 'Yes Kelvin Cosmas', '2023-12-27 01:57:16', '2023-12-27 01:57:18'),
(38, 'Yes Kelvin Cosmas', 1, 13, 9000, NULL, 0, NULL, NULL, NULL, 21, 1, 'images/gallery/041227235457658baed2caf9d_IMG-20231116-WA0007.jpg', 1, 0, 1, 'Yes Kelvin Cosmas', '2023-12-27 01:57:54', '2023-12-27 01:57:55'),
(39, 'kelvin Cosmas', 1, 13, 9000, NULL, 0, NULL, NULL, NULL, 21, 1, 'images/gallery/051227231700658baf61ad5c3_IMG-20231116-WA0007.jpg', 1, 0, 1, 'Yes Kelvin Cosmas', '2023-12-27 02:00:17', '2023-12-27 02:00:17'),
(40, 'kelvin Cosmas', 1, 1, 9000, NULL, 0, NULL, NULL, NULL, 9, 2, 'images/gallery/051227232402658bafe0657e7_IMG-20231116-WA0006.jpg', 2, 0, 1, 'Yes Kelvin Cosmas', '2023-12-27 02:02:24', '2023-12-27 05:58:14'),
(42, 'hello', 1, 13, 900, NULL, 0, NULL, NULL, NULL, 21, 1, 'images/gallery/051227231114658bb2a39f861_IMG-20231116-WA0007.jpg', 3, 0, 1, 'Yes Kelvin Cosmas', '2023-12-27 02:14:11', '2023-12-27 02:55:45'),
(43, 'Yes Kelvin cosmas', 1, 13, 2000, NULL, 0, NULL, NULL, NULL, 21, 1, NULL, 0, 0, 1, 'Yes Kelvin Cosmas', '2023-12-27 02:24:31', '2023-12-27 02:24:31'),
(44, 'Yes Kelvin cosmas', 1, 13, 2000, NULL, 0, NULL, NULL, NULL, 21, 1, NULL, 0, 0, 1, 'Yes Kelvin Cosmas', '2023-12-27 02:24:42', '2023-12-27 02:24:42'),
(45, 'Yes Kelvin cosmas', 1, 13, 2000, NULL, 0, NULL, NULL, NULL, 21, 1, 'images/gallery/061227233853658bc9f2ed6cb_IMG-20231116-WA0007.jpg', 5, 0, 1, 'Yes Kelvin Cosmas', '2023-12-27 02:26:29', '2023-12-27 03:53:38'),
(46, 'hahahaha', 1, 3, 2300, NULL, 0, NULL, NULL, NULL, 14, 1, NULL, 0, 0, 1, 'Yes Kelvin Cosmas', '2023-12-27 02:35:38', '2023-12-27 02:35:38'),
(47, 'hahahaha', 1, 3, 2300, NULL, 0, NULL, NULL, NULL, 14, 1, NULL, 0, 0, 1, 'Yes Kelvin Cosmas', '2023-12-27 02:35:50', '2023-12-27 02:35:50'),
(48, 'Yes Kelvin Cosmas', 1, 3, 2, NULL, 0, NULL, NULL, NULL, 18, 1, 'images/gallery/071227234148658bd6d94bcd7_IMG-20231116-WA0007.jpg', 3, 0, 1, 'Yes Kelvin Cosmas', '2023-12-27 02:38:02', '2023-12-27 06:03:09'),
(49, 'yes kelvin cosmas', 1, 13, 300, NULL, 0, NULL, NULL, NULL, 21, 1, 'images/gallery/081227234840658be310e2c15_IMG-20231116-WA0007.jpg', 13, 0, 1, 'Yes Kelvin', '2023-12-27 04:06:36', '2023-12-27 13:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `property_areas`
--

CREATE TABLE `property_areas` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_areas`
--

INSERT INTO `property_areas` (`id`, `property_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 8900, '2023-09-08 20:27:54', '2023-09-08 20:27:54'),
(2, 2, 230, '2023-09-09 06:45:14', '2023-09-09 06:45:14'),
(3, 3, 1, '2023-09-09 06:49:39', '2023-09-09 06:49:39'),
(4, 4, 2340, '2023-09-09 06:57:43', '2023-09-09 06:57:43'),
(5, 5, 123, '2023-09-09 07:00:25', '2023-09-09 07:00:25'),
(6, 6, 2340, '2023-09-09 07:02:44', '2023-09-09 07:02:44'),
(7, 7, 450, '2023-09-27 19:52:32', '2023-09-27 19:52:32'),
(8, 8, 340, '2023-09-27 20:00:09', '2023-09-27 20:00:09'),
(9, 9, 340, '2023-09-30 03:00:55', '2023-09-30 03:00:55'),
(10, 10, 340, '2023-09-30 03:20:30', '2023-09-30 03:20:30'),
(11, 11, 340, '2023-09-30 03:20:42', '2023-09-30 03:20:42'),
(12, 12, 450, '2023-09-30 06:26:14', '2023-09-30 06:26:14'),
(13, 13, 349, '2023-09-30 06:42:38', '2023-09-30 06:42:38'),
(14, 14, 340, '2023-09-30 06:44:39', '2023-09-30 06:44:39'),
(15, 15, 340, '2023-09-30 06:46:45', '2023-09-30 06:46:45'),
(16, 16, 340, '2023-09-30 07:11:20', '2023-09-30 07:11:20'),
(17, 17, 340, '2023-09-30 07:11:45', '2023-09-30 07:11:45'),
(18, 18, 340, '2023-09-30 07:12:55', '2023-09-30 07:12:55'),
(19, 19, 340, '2023-09-30 07:23:04', '2023-09-30 07:23:04'),
(20, 20, 340, '2023-09-30 13:16:46', '2023-09-30 13:16:46'),
(21, 21, 340, '2023-09-30 13:18:39', '2023-09-30 13:18:39'),
(22, 22, 340, '2023-09-30 13:19:38', '2023-09-30 13:19:38'),
(23, 23, 340, '2023-09-30 13:28:45', '2023-09-30 13:28:45'),
(24, 24, 340, '2023-09-30 13:32:51', '2023-09-30 13:32:51'),
(29, 29, 20000, '2023-11-30 03:54:59', '2023-11-30 03:54:59'),
(30, 30, 2300, '2023-12-15 22:13:57', '2023-12-15 22:13:57'),
(31, 31, 300, '2023-12-15 23:04:54', '2023-12-15 23:04:54'),
(32, 32, 300, '2023-12-18 00:29:04', '2023-12-18 00:29:04'),
(33, 33, 4500, '2023-12-27 01:40:07', '2023-12-27 01:40:07'),
(34, 34, 1, '2023-12-27 01:43:05', '2023-12-27 01:43:05'),
(35, 35, 89, '2023-12-27 01:49:29', '2023-12-27 01:49:29'),
(36, 36, 89, '2023-12-27 01:54:20', '2023-12-27 01:54:20'),
(37, 37, 300, '2023-12-27 01:57:16', '2023-12-27 01:57:16'),
(38, 38, 300, '2023-12-27 01:57:54', '2023-12-27 01:57:54'),
(39, 39, 8, '2023-12-27 02:00:17', '2023-12-27 02:00:17'),
(40, 40, 8, '2023-12-27 02:02:24', '2023-12-27 02:02:24'),
(42, 42, 9, '2023-12-27 02:14:11', '2023-12-27 02:14:11'),
(43, 43, 2, '2023-12-27 02:24:31', '2023-12-27 02:24:31'),
(44, 44, 2, '2023-12-27 02:24:42', '2023-12-27 02:24:42'),
(45, 45, 2, '2023-12-27 02:26:29', '2023-12-27 02:26:29'),
(46, 46, 900, '2023-12-27 02:35:38', '2023-12-27 02:35:38'),
(47, 47, 900, '2023-12-27 02:35:50', '2023-12-27 02:35:50'),
(48, 48, 900, '2023-12-27 02:38:02', '2023-12-27 02:38:02'),
(49, 49, 2300, '2023-12-27 04:06:36', '2023-12-27 04:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `property_barths`
--

CREATE TABLE `property_barths` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `value` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_barths`
--

INSERT INTO `property_barths` (`id`, `property_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2023-09-08 20:27:54', '2023-09-08 20:27:54'),
(2, 2, 1, '2023-09-09 06:45:14', '2023-09-09 06:45:14'),
(3, 3, 2, '2023-09-09 06:49:39', '2023-09-09 06:49:39'),
(4, 4, 1, '2023-09-09 06:57:43', '2023-09-09 06:57:43'),
(5, 5, 1, '2023-09-09 07:00:25', '2023-09-09 07:00:25'),
(6, 6, 1, '2023-09-09 07:02:44', '2023-09-09 07:02:44'),
(7, 7, 1, '2023-09-27 19:52:32', '2023-09-27 19:52:32'),
(8, 8, 1, '2023-09-27 20:00:09', '2023-09-27 20:00:09'),
(9, 9, 1, '2023-09-30 03:00:55', '2023-09-30 03:00:55'),
(10, 10, 1, '2023-09-30 03:20:30', '2023-09-30 03:20:30'),
(11, 11, 1, '2023-09-30 03:20:42', '2023-09-30 03:20:42'),
(12, 12, 1, '2023-09-30 06:26:14', '2023-09-30 06:26:14'),
(13, 13, 1, '2023-09-30 06:42:38', '2023-09-30 06:42:38'),
(14, 14, 1, '2023-09-30 06:44:39', '2023-09-30 06:44:39'),
(15, 15, 1, '2023-09-30 06:46:45', '2023-09-30 06:46:45'),
(16, 16, 1, '2023-09-30 07:11:20', '2023-09-30 07:11:20'),
(17, 17, 1, '2023-09-30 07:11:45', '2023-09-30 07:11:45'),
(18, 18, 1, '2023-09-30 07:12:55', '2023-09-30 07:12:55'),
(19, 19, 1, '2023-09-30 07:23:04', '2023-09-30 07:23:04'),
(20, 20, 1, '2023-09-30 13:16:46', '2023-09-30 13:16:46'),
(21, 21, 1, '2023-09-30 13:18:39', '2023-09-30 13:18:39'),
(22, 22, 1, '2023-09-30 13:19:38', '2023-09-30 13:19:38'),
(23, 23, 1, '2023-09-30 13:28:45', '2023-09-30 13:28:45'),
(24, 24, 1, '2023-09-30 13:32:51', '2023-09-30 13:32:51'),
(29, 29, 1, '2023-11-30 03:54:59', '2023-11-30 03:54:59'),
(30, 30, 1, '2023-12-15 22:13:57', '2023-12-15 22:13:57'),
(31, 31, 1, '2023-12-15 23:04:54', '2023-12-15 23:04:54'),
(32, 32, NULL, '2023-12-18 00:29:04', '2023-12-18 00:29:04'),
(33, 33, 1, '2023-12-27 01:40:07', '2023-12-27 01:40:07'),
(34, 34, 1, '2023-12-27 01:43:05', '2023-12-27 01:43:05'),
(35, 35, 1, '2023-12-27 01:49:29', '2023-12-27 01:49:29'),
(36, 36, 1, '2023-12-27 01:54:20', '2023-12-27 01:54:20'),
(37, 37, 1, '2023-12-27 01:57:16', '2023-12-27 01:57:16'),
(38, 38, 1, '2023-12-27 01:57:54', '2023-12-27 01:57:54'),
(39, 39, 9, '2023-12-27 02:00:17', '2023-12-27 02:00:17'),
(40, 40, 9, '2023-12-27 02:02:24', '2023-12-27 02:02:24'),
(42, 42, 9, '2023-12-27 02:14:11', '2023-12-27 02:14:11'),
(43, 43, 1, '2023-12-27 02:24:31', '2023-12-27 02:24:31'),
(44, 44, 1, '2023-12-27 02:24:42', '2023-12-27 02:24:42'),
(45, 45, 1, '2023-12-27 02:26:29', '2023-12-27 02:26:29'),
(46, 46, NULL, '2023-12-27 02:35:38', '2023-12-27 02:35:38'),
(47, 47, NULL, '2023-12-27 02:35:50', '2023-12-27 02:35:50'),
(48, 48, 2, '2023-12-27 02:38:02', '2023-12-27 04:48:40'),
(49, 49, 2, '2023-12-27 04:06:36', '2023-12-27 04:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `property_bead_rooms`
--

CREATE TABLE `property_bead_rooms` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `value` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_bead_rooms`
--

INSERT INTO `property_bead_rooms` (`id`, `property_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2023-09-08 20:27:54', '2023-09-08 20:27:54'),
(2, 2, 1, '2023-09-09 06:45:14', '2023-09-09 06:45:14'),
(3, 3, 1, '2023-09-09 06:49:39', '2023-09-09 06:49:39'),
(4, 4, 1, '2023-09-09 06:57:43', '2023-09-09 06:57:43'),
(5, 5, 1, '2023-09-09 07:00:25', '2023-09-09 07:00:25'),
(6, 6, 1, '2023-09-09 07:02:44', '2023-09-09 07:02:44'),
(7, 7, 1, '2023-09-27 19:52:32', '2023-09-27 19:52:32'),
(8, 8, 1, '2023-09-27 20:00:09', '2023-09-27 20:00:09'),
(9, 9, 1, '2023-09-30 03:00:55', '2023-09-30 03:00:55'),
(10, 10, 1, '2023-09-30 03:20:30', '2023-09-30 03:20:30'),
(11, 11, 1, '2023-09-30 03:20:42', '2023-09-30 03:20:42'),
(12, 12, 1, '2023-09-30 06:26:14', '2023-09-30 06:26:14'),
(13, 13, 12, '2023-09-30 06:42:38', '2023-09-30 06:42:38'),
(14, 14, 1, '2023-09-30 06:44:39', '2023-09-30 06:44:39'),
(15, 15, 1, '2023-09-30 06:46:45', '2023-09-30 06:46:45'),
(16, 16, 1, '2023-09-30 07:11:20', '2023-09-30 07:11:20'),
(17, 17, 1, '2023-09-30 07:11:45', '2023-09-30 07:11:45'),
(18, 18, 1, '2023-09-30 07:12:55', '2023-09-30 07:12:55'),
(19, 19, 1, '2023-09-30 07:23:04', '2023-09-30 07:23:04'),
(20, 20, 1, '2023-09-30 13:16:46', '2023-09-30 13:16:46'),
(21, 21, 1, '2023-09-30 13:18:39', '2023-09-30 13:18:39'),
(22, 22, 1, '2023-09-30 13:19:38', '2023-09-30 13:19:38'),
(23, 23, 1, '2023-09-30 13:28:45', '2023-09-30 13:28:45'),
(24, 24, 1, '2023-09-30 13:32:51', '2023-09-30 13:32:51'),
(29, 29, 1, '2023-11-30 03:54:59', '2023-11-30 03:54:59'),
(30, 30, 1, '2023-12-15 22:13:57', '2023-12-15 22:13:57'),
(31, 31, -1, '2023-12-15 23:04:54', '2023-12-15 23:04:54'),
(32, 32, NULL, '2023-12-18 00:29:04', '2023-12-18 00:29:04'),
(33, 33, 1, '2023-12-27 01:40:07', '2023-12-27 01:40:07'),
(34, 34, 1, '2023-12-27 01:43:05', '2023-12-27 01:43:05'),
(35, 35, 1, '2023-12-27 01:49:29', '2023-12-27 01:49:29'),
(36, 36, 1, '2023-12-27 01:54:20', '2023-12-27 01:54:20'),
(37, 37, 1, '2023-12-27 01:57:16', '2023-12-27 01:57:16'),
(38, 38, 1, '2023-12-27 01:57:54', '2023-12-27 01:57:54'),
(39, 39, 9, '2023-12-27 02:00:17', '2023-12-27 02:00:17'),
(40, 40, 9, '2023-12-27 02:02:24', '2023-12-27 02:02:24'),
(42, 42, 8, '2023-12-27 02:14:11', '2023-12-27 02:14:11'),
(43, 43, 1, '2023-12-27 02:24:31', '2023-12-27 02:24:31'),
(44, 44, 1, '2023-12-27 02:24:42', '2023-12-27 02:24:42'),
(45, 45, 1, '2023-12-27 02:26:29', '2023-12-27 02:26:29'),
(46, 46, NULL, '2023-12-27 02:35:38', '2023-12-27 02:35:38'),
(47, 47, NULL, '2023-12-27 02:35:50', '2023-12-27 02:35:50'),
(48, 48, 2, '2023-12-27 02:38:02', '2023-12-27 04:48:40'),
(49, 49, 1, '2023-12-27 04:06:36', '2023-12-27 04:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `property_conditions`
--

CREATE TABLE `property_conditions` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `condition_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_currencies`
--

CREATE TABLE `property_currencies` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_furnishes`
--

CREATE TABLE `property_furnishes` (
  `id` int(11) NOT NULL,
  `furnish_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_image_galleries`
--

CREATE TABLE `property_image_galleries` (
  `id` int(10) UNSIGNED NOT NULL,
  `property_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(250) DEFAULT NULL,
  `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_image_galleries`
--

INSERT INTO `property_image_galleries` (`id`, `property_id`, `name`, `path`, `size`, `created_at`, `updated_at`) VALUES
(59, 30, '011216232221657cfb921cd7f_74ca9ad50147d6b022ac7135dbfa366b.jpeg', 'images/gallery/011216232221657cfb921cd7f_74ca9ad50147d6b022ac7135dbfa366b.jpeg', '72538', '2023-12-15 22:21:22', '2023-12-15 22:21:22'),
(60, 29, '011216233122657cfbd75033a_74ca9ad50147d6b022ac7135dbfa366b.jpeg', 'images/gallery/011216233122657cfbd75033a_74ca9ad50147d6b022ac7135dbfa366b.jpeg', '72538', '2023-12-15 22:22:31', '2023-12-15 22:22:31'),
(61, 31, '021216235504657d05c7068ba_74ca9ad50147d6b022ac7135dbfa366b.jpeg', 'images/gallery/021216235504657d05c7068ba_74ca9ad50147d6b022ac7135dbfa366b.jpeg', '72538', '2023-12-15 23:04:55', '2023-12-15 23:04:55'),
(62, 32, '031218230429657fbc80ceb70_74ca9ad50147d6b022ac7135dbfa366b.jpeg', 'images/gallery/031218230429657fbc80ceb70_74ca9ad50147d6b022ac7135dbfa366b.jpeg', '72538', '2023-12-18 00:29:04', '2023-12-18 00:29:04'),
(63, 33, '041227230840658baaa8174e1_IMG-20231116-WA0008.jpg', 'images/gallery/041227230840658baaa8174e1_IMG-20231116-WA0008.jpg', '64851', '2023-12-27 01:40:08', '2023-12-27 01:40:08'),
(64, 33, '041227230840658baaa8273ef_IMG-20231116-WA0009.jpg', 'images/gallery/041227230840658baaa8273ef_IMG-20231116-WA0009.jpg', '82607', '2023-12-27 01:40:08', '2023-12-27 01:40:08'),
(65, 33, '041227230840658baaa828bac_IMG-20231116-WA0010.jpg', 'images/gallery/041227230840658baaa828bac_IMG-20231116-WA0010.jpg', '83713', '2023-12-27 01:40:08', '2023-12-27 01:40:08'),
(66, 34, '041227230543658bab59d62e8_IMG-20231116-WA0008.jpg', 'images/gallery/041227230543658bab59d62e8_IMG-20231116-WA0008.jpg', '64851', '2023-12-27 01:43:05', '2023-12-27 01:43:05'),
(67, 34, '041227230543658bab59d8e41_IMG-20231116-WA0010.jpg', 'images/gallery/041227230543658bab59d8e41_IMG-20231116-WA0010.jpg', '83713', '2023-12-27 01:43:05', '2023-12-27 01:43:05'),
(68, 35, '041227233049658bacdabd81c_IMG-20231116-WA0008.jpg', 'images/gallery/041227233049658bacdabd81c_IMG-20231116-WA0008.jpg', '64851', '2023-12-27 01:49:31', '2023-12-27 01:49:31'),
(69, 35, '041227233149658bacdb574c2_IMG-20231116-WA0009.jpg', 'images/gallery/041227233149658bacdb574c2_IMG-20231116-WA0009.jpg', '82607', '2023-12-27 01:49:31', '2023-12-27 01:49:31'),
(70, 35, '041227233149658bacdb5eee2_IMG-20231116-WA0010.jpg', 'images/gallery/041227233149658bacdb5eee2_IMG-20231116-WA0010.jpg', '83713', '2023-12-27 01:49:31', '2023-12-27 01:49:31'),
(71, 36, '041227232054658badfcb8c4e_IMG-20231116-WA0007.jpg', 'images/gallery/041227232054658badfcb8c4e_IMG-20231116-WA0007.jpg', '97004', '2023-12-27 01:54:20', '2023-12-27 01:54:20'),
(72, 36, '041227232054658badfcbef0a_IMG-20231116-WA0008.jpg', 'images/gallery/041227232054658badfcbef0a_IMG-20231116-WA0008.jpg', '64851', '2023-12-27 01:54:20', '2023-12-27 01:54:20'),
(73, 36, '041227232054658badfcc116c_IMG-20231116-WA0009.jpg', 'images/gallery/041227232054658badfcc116c_IMG-20231116-WA0009.jpg', '82607', '2023-12-27 01:54:20', '2023-12-27 01:54:20'),
(74, 37, '041227231757658baead1971f_IMG-20231116-WA0008.jpg', 'images/gallery/041227231757658baead1971f_IMG-20231116-WA0008.jpg', '64851', '2023-12-27 01:57:17', '2023-12-27 01:57:17'),
(75, 37, '041227231757658baead2c03e_IMG-20231116-WA0009.jpg', 'images/gallery/041227231757658baead2c03e_IMG-20231116-WA0009.jpg', '82607', '2023-12-27 01:57:17', '2023-12-27 01:57:17'),
(76, 37, '041227231757658baead30cad_IMG-20231116-WA0010.jpg', 'images/gallery/041227231757658baead30cad_IMG-20231116-WA0010.jpg', '83713', '2023-12-27 01:57:17', '2023-12-27 01:57:17'),
(77, 38, '041227235457658baed2caf9d_IMG-20231116-WA0007.jpg', 'images/gallery/041227235457658baed2caf9d_IMG-20231116-WA0007.jpg', '97004', '2023-12-27 01:57:54', '2023-12-27 01:57:54'),
(78, 38, '041227235457658baed2d1d4e_IMG-20231116-WA0008.jpg', 'images/gallery/041227235457658baed2d1d4e_IMG-20231116-WA0008.jpg', '64851', '2023-12-27 01:57:54', '2023-12-27 01:57:54'),
(79, 38, '041227235457658baed2d5039_IMG-20231116-WA0009.jpg', 'images/gallery/041227235457658baed2d5039_IMG-20231116-WA0009.jpg', '82607', '2023-12-27 01:57:54', '2023-12-27 01:57:54'),
(80, 39, '051227231700658baf61ad5c3_IMG-20231116-WA0007.jpg', 'images/gallery/051227231700658baf61ad5c3_IMG-20231116-WA0007.jpg', '97004', '2023-12-27 02:00:17', '2023-12-27 02:00:17'),
(81, 39, '051227231700658baf61b1b8a_IMG-20231116-WA0008.jpg', 'images/gallery/051227231700658baf61b1b8a_IMG-20231116-WA0008.jpg', '64851', '2023-12-27 02:00:17', '2023-12-27 02:00:17'),
(82, 39, '051227231700658baf61b2b89_IMG-20231116-WA0009.jpg', 'images/gallery/051227231700658baf61b2b89_IMG-20231116-WA0009.jpg', '82607', '2023-12-27 02:00:17', '2023-12-27 02:00:17'),
(83, 39, '051227231700658baf61b3f1c_IMG-20231116-WA0010.jpg', 'images/gallery/051227231700658baf61b3f1c_IMG-20231116-WA0010.jpg', '83713', '2023-12-27 02:00:17', '2023-12-27 02:00:17'),
(84, 40, '051227232402658bafe0657e7_IMG-20231116-WA0006.jpg', 'images/gallery/051227232402658bafe0657e7_IMG-20231116-WA0006.jpg', '85472', '2023-12-27 02:02:24', '2023-12-27 02:02:24'),
(85, 40, '051227232402658bafe06d795_IMG-20231116-WA0010.jpg', 'images/gallery/051227232402658bafe06d795_IMG-20231116-WA0010.jpg', '83713', '2023-12-27 02:02:24', '2023-12-27 02:02:24'),
(88, 42, '051227231114658bb2a39f861_IMG-20231116-WA0007.jpg', 'images/gallery/051227231114658bb2a39f861_IMG-20231116-WA0007.jpg', '97004', '2023-12-27 02:14:11', '2023-12-27 02:14:11'),
(89, 42, '051227231114658bb2a3a24cc_IMG-20231116-WA0008.jpg', 'images/gallery/051227231114658bb2a3a24cc_IMG-20231116-WA0008.jpg', '64851', '2023-12-27 02:14:11', '2023-12-27 02:14:11'),
(90, 42, '051227231114658bb2a3a31e1_IMG-20231116-WA0009.jpg', 'images/gallery/051227231114658bb2a3a31e1_IMG-20231116-WA0009.jpg', '82607', '2023-12-27 02:14:11', '2023-12-27 02:14:11'),
(91, 42, '051227231114658bb2a3a4700_IMG-20231116-WA0010.jpg', 'images/gallery/051227231114658bb2a3a4700_IMG-20231116-WA0010.jpg', '83713', '2023-12-27 02:14:11', '2023-12-27 02:14:11'),
(99, 45, '061227233853658bc9f2ed6cb_IMG-20231116-WA0007.jpg', 'images/gallery/061227233853658bc9f2ed6cb_IMG-20231116-WA0007.jpg', '97004', '2023-12-27 03:53:38', '2023-12-27 03:53:38'),
(100, 45, '061227233953658bc9f3044eb_IMG-20231116-WA0008.jpg', 'images/gallery/061227233953658bc9f3044eb_IMG-20231116-WA0008.jpg', '64851', '2023-12-27 03:53:39', '2023-12-27 03:53:39'),
(101, 45, '061227233953658bc9f30cdd0_IMG-20231116-WA0009.jpg', 'images/gallery/061227233953658bc9f30cdd0_IMG-20231116-WA0009.jpg', '82607', '2023-12-27 03:53:39', '2023-12-27 03:53:39'),
(102, 45, '061227233953658bc9f318087_IMG-20231116-WA0010.jpg', 'images/gallery/061227233953658bc9f318087_IMG-20231116-WA0010.jpg', '83713', '2023-12-27 03:53:39', '2023-12-27 03:53:39'),
(117, 48, '071227234148658bd6d94bcd7_IMG-20231116-WA0007.jpg', 'images/gallery/071227234148658bd6d94bcd7_IMG-20231116-WA0007.jpg', '97004', '2023-12-27 04:48:41', '2023-12-27 04:48:41'),
(118, 48, '071227234148658bd6d9542ad_IMG-20231116-WA0008.jpg', 'images/gallery/071227234148658bd6d9542ad_IMG-20231116-WA0008.jpg', '64851', '2023-12-27 04:48:41', '2023-12-27 04:48:41'),
(119, 48, '071227234148658bd6d95b43a_IMG-20231116-WA0009.jpg', 'images/gallery/071227234148658bd6d95b43a_IMG-20231116-WA0009.jpg', '82607', '2023-12-27 04:48:41', '2023-12-27 04:48:41'),
(120, 49, '081227234840658be310e2c15_IMG-20231116-WA0007.jpg', 'images/gallery/081227234840658be310e2c15_IMG-20231116-WA0007.jpg', '97004', '2023-12-27 05:40:49', '2023-12-27 05:40:49'),
(121, 49, '081227234940658be31112f3d_IMG-20231116-WA0008.jpg', 'images/gallery/081227234940658be31112f3d_IMG-20231116-WA0008.jpg', '64851', '2023-12-27 05:40:49', '2023-12-27 05:40:49'),
(122, 49, '081227234940658be311165f1_IMG-20231116-WA0009.jpg', 'images/gallery/081227234940658be311165f1_IMG-20231116-WA0009.jpg', '82607', '2023-12-27 05:40:49', '2023-12-27 05:40:49'),
(123, 49, '081227234940658be311199b0_IMG-20231116-WA0010.jpg', 'images/gallery/081227234940658be311199b0_IMG-20231116-WA0010.jpg', '83713', '2023-12-27 05:40:49', '2023-12-27 05:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `property_locations`
--

CREATE TABLE `property_locations` (
  `id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `district_id` int(11) DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_locations`
--

INSERT INTO `property_locations` (`id`, `region_id`, `district_id`, `property_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 1, 'kigamboni', '2023-09-08 23:27:54', '2023-09-08 23:27:54'),
(2, 1, 7, 2, 'dodoma', '2023-09-09 09:45:14', '2023-09-09 09:45:14'),
(3, 1, 7, 3, 'kigamboni', '2023-09-09 09:49:39', '2023-09-09 09:49:39'),
(4, 1, 7, 4, 'kigamboni', '2023-09-09 09:57:43', '2023-09-09 09:57:43'),
(5, 1, 7, 5, 'dodoma', '2023-09-09 10:00:25', '2023-09-09 10:00:25'),
(6, 1, 7, 6, 'Kigamboni', '2023-09-09 10:02:44', '2023-09-09 10:02:44'),
(7, 1, 7, 7, 'Kigamboni', '2023-09-27 22:52:32', '2023-09-27 22:52:32'),
(8, 1, 7, 8, 'Kigamboni', '2023-09-27 23:00:09', '2023-09-27 23:00:09'),
(9, 1, 7, 9, 'dodoma', '2023-09-30 06:00:55', '2023-09-30 06:00:55'),
(10, 1, 7, 10, 'dodoma', '2023-09-30 06:20:30', '2023-09-30 06:20:30'),
(11, 1, 7, 11, 'dodoma', '2023-09-30 06:20:42', '2023-09-30 06:20:42'),
(12, 2, 2, 12, 'dodoma', '2023-09-30 09:26:14', '2023-09-30 09:26:14'),
(13, 1, 7, 13, 'kigamboni', '2023-09-30 09:42:38', '2023-09-30 09:42:38'),
(14, 1, 7, 14, 'kigamboni', '2023-09-30 09:44:39', '2023-09-30 09:44:39'),
(15, 2, 2, 15, 'kigamboni', '2023-09-30 09:46:45', '2023-09-30 09:46:45'),
(16, 2, 2, 16, 'kigamboni', '2023-09-30 10:11:20', '2023-09-30 10:11:20'),
(17, 2, 2, 17, 'kigamboni', '2023-09-30 10:11:45', '2023-09-30 10:11:45'),
(18, 2, 2, 18, 'kigamboni', '2023-09-30 10:12:55', '2023-09-30 10:12:55'),
(19, 2, 2, 19, 'kigamboni', '2023-09-30 10:23:04', '2023-09-30 10:23:04'),
(20, 2, 2, 20, 'kigamboni', '2023-09-30 16:16:46', '2023-09-30 16:16:46'),
(21, 2, 2, 21, 'kigamboni', '2023-09-30 16:18:38', '2023-09-30 16:18:38'),
(22, 2, 2, 22, 'kigamboni', '2023-09-30 16:19:38', '2023-09-30 16:19:38'),
(23, 1, 7, 23, 'kigamboni', '2023-09-30 16:28:45', '2023-09-30 16:28:45'),
(24, 1, 7, 24, 'kigamboni', '2023-09-30 16:32:51', '2023-09-30 16:32:51'),
(29, 1, 4, 29, 'Mbezi Beach', '2023-11-30 06:54:59', '2023-11-30 06:54:59'),
(30, 1, 7, 30, 'temeke', '2023-12-16 01:13:57', '2023-12-16 01:13:57'),
(31, 1, 4, 31, 'temeke', '2023-12-16 02:04:54', '2023-12-16 02:04:54'),
(32, 1, 7, 32, 'kigamboni', '2023-12-18 03:29:04', '2023-12-18 03:29:04'),
(33, 1, 7, 33, 'igamboni', '2023-12-27 04:40:07', '2023-12-27 04:40:07'),
(34, 1, 7, 34, 'igamboni', '2023-12-27 04:43:05', '2023-12-27 04:43:05'),
(35, 1, 7, 35, 'igamboni', '2023-12-27 04:49:29', '2023-12-27 04:49:29'),
(36, 1, 7, 36, 'igamboni', '2023-12-27 04:54:20', '2023-12-27 04:54:20'),
(37, 1, 7, 37, 'igamboni', '2023-12-27 04:57:16', '2023-12-27 04:57:16'),
(38, 1, 7, 38, 'igamboni', '2023-12-27 04:57:54', '2023-12-27 04:57:54'),
(39, 1, 7, 39, 'igamboni', '2023-12-27 05:00:17', '2023-12-27 05:00:17'),
(40, 1, 7, 40, 'igamboni', '2023-12-27 05:02:24', '2023-12-27 05:02:24'),
(42, 1, 7, 42, 'igamboni', '2023-12-27 05:14:11', '2023-12-27 05:14:11'),
(43, 5, 23, 43, 'igamboni', '2023-12-27 05:24:31', '2023-12-27 05:24:31'),
(44, 5, 23, 44, 'igamboni', '2023-12-27 05:24:42', '2023-12-27 05:24:42'),
(45, 5, 23, 45, 'igamboni', '2023-12-27 05:26:29', '2023-12-27 05:26:29'),
(46, 1, 7, 46, 'igamboni', '2023-12-27 05:35:38', '2023-12-27 05:35:38'),
(47, 1, 7, 47, 'igamboni', '2023-12-27 05:35:50', '2023-12-27 05:35:50'),
(48, 1, 7, 48, 'igamboni', '2023-12-27 05:38:02', '2023-12-27 05:38:02'),
(49, 1, 7, 49, 'igamboni', '2023-12-27 07:06:36', '2023-12-27 07:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `property_near_bies`
--

CREATE TABLE `property_near_bies` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `near_by_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_near_bies`
--

INSERT INTO `property_near_bies` (`id`, `property_id`, `near_by_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2023-09-08 20:27:54', '2023-09-08 20:27:54'),
(2, 1, 1, '2023-09-08 20:27:54', '2023-09-08 20:27:54'),
(3, 2, 2, '2023-09-09 06:45:14', '2023-09-09 06:45:14'),
(4, 3, 2, '2023-09-09 06:49:39', '2023-09-09 06:49:39'),
(5, 3, 1, '2023-09-09 06:49:39', '2023-09-09 06:49:39'),
(6, 4, 2, '2023-09-09 06:57:43', '2023-09-09 06:57:43'),
(7, 5, 2, '2023-09-09 07:00:25', '2023-09-09 07:00:25'),
(9, 7, 2, '2023-09-27 19:52:32', '2023-09-27 19:52:32'),
(10, 8, 2, '2023-09-27 20:00:09', '2023-09-27 20:00:09'),
(11, 9, 2, '2023-09-30 03:00:55', '2023-09-30 03:00:55'),
(12, 9, 1, '2023-09-30 03:00:55', '2023-09-30 03:00:55'),
(13, 10, 2, '2023-09-30 03:20:30', '2023-09-30 03:20:30'),
(14, 10, 1, '2023-09-30 03:20:30', '2023-09-30 03:20:30'),
(15, 11, 2, '2023-09-30 03:20:42', '2023-09-30 03:20:42'),
(16, 11, 1, '2023-09-30 03:20:42', '2023-09-30 03:20:42'),
(17, 12, 2, '2023-09-30 06:26:14', '2023-09-30 06:26:14'),
(18, 12, 1, '2023-09-30 06:26:14', '2023-09-30 06:26:14'),
(19, 13, 2, '2023-09-30 06:42:38', '2023-09-30 06:42:38'),
(20, 13, 1, '2023-09-30 06:42:38', '2023-09-30 06:42:38'),
(21, 14, 2, '2023-09-30 06:44:39', '2023-09-30 06:44:39'),
(22, 15, 1, '2023-09-30 06:46:45', '2023-09-30 06:46:45'),
(23, 16, 1, '2023-09-30 07:11:20', '2023-09-30 07:11:20'),
(24, 17, 1, '2023-09-30 07:11:45', '2023-09-30 07:11:45'),
(25, 18, 1, '2023-09-30 07:12:55', '2023-09-30 07:12:55'),
(26, 19, 1, '2023-09-30 07:23:04', '2023-09-30 07:23:04'),
(27, 20, 1, '2023-09-30 13:16:46', '2023-09-30 13:16:46'),
(28, 21, 1, '2023-09-30 13:18:39', '2023-09-30 13:18:39'),
(30, 23, 2, '2023-09-30 13:28:45', '2023-09-30 13:28:45'),
(33, 22, 1, '2023-10-01 13:42:48', '2023-10-01 13:42:48'),
(37, 24, 2, '2023-10-01 13:59:07', '2023-10-01 13:59:07'),
(51, 6, 2, '2023-10-01 14:25:16', '2023-10-01 14:25:16'),
(74, 30, 2, '2023-12-15 22:21:21', '2023-12-15 22:21:21'),
(75, 30, 1, '2023-12-15 22:21:21', '2023-12-15 22:21:21'),
(76, 29, 2, '2023-12-15 22:22:31', '2023-12-15 22:22:31'),
(77, 31, 2, '2023-12-15 23:04:54', '2023-12-15 23:04:54'),
(78, 31, 1, '2023-12-15 23:04:54', '2023-12-15 23:04:54'),
(79, 32, 2, '2023-12-18 00:29:04', '2023-12-18 00:29:04'),
(80, 32, 1, '2023-12-18 00:29:04', '2023-12-18 00:29:04'),
(81, 33, 2, '2023-12-27 01:40:07', '2023-12-27 01:40:07'),
(82, 33, 1, '2023-12-27 01:40:07', '2023-12-27 01:40:07'),
(83, 34, 2, '2023-12-27 01:43:05', '2023-12-27 01:43:05'),
(84, 34, 1, '2023-12-27 01:43:05', '2023-12-27 01:43:05'),
(85, 35, 2, '2023-12-27 01:49:29', '2023-12-27 01:49:29'),
(86, 35, 1, '2023-12-27 01:49:29', '2023-12-27 01:49:29'),
(87, 36, 1, '2023-12-27 01:54:20', '2023-12-27 01:54:20'),
(88, 37, 2, '2023-12-27 01:57:16', '2023-12-27 01:57:16'),
(89, 37, 1, '2023-12-27 01:57:16', '2023-12-27 01:57:16'),
(90, 38, 2, '2023-12-27 01:57:54', '2023-12-27 01:57:54'),
(91, 38, 1, '2023-12-27 01:57:54', '2023-12-27 01:57:54'),
(92, 39, 2, '2023-12-27 02:00:17', '2023-12-27 02:00:17'),
(93, 40, 2, '2023-12-27 02:02:24', '2023-12-27 02:02:24'),
(94, 40, 1, '2023-12-27 02:02:24', '2023-12-27 02:02:24'),
(97, 42, 2, '2023-12-27 02:14:11', '2023-12-27 02:14:11'),
(98, 42, 1, '2023-12-27 02:14:11', '2023-12-27 02:14:11'),
(103, 45, 2, '2023-12-27 03:53:38', '2023-12-27 03:53:38'),
(104, 45, 1, '2023-12-27 03:53:38', '2023-12-27 03:53:38'),
(113, 48, 2, '2023-12-27 04:48:40', '2023-12-27 04:48:40'),
(114, 48, 1, '2023-12-27 04:48:40', '2023-12-27 04:48:40'),
(115, 49, 2, '2023-12-27 05:40:46', '2023-12-27 05:40:46'),
(116, 49, 1, '2023-12-27 05:40:46', '2023-12-27 05:40:46');

-- --------------------------------------------------------

--
-- Table structure for table `property_prices`
--

CREATE TABLE `property_prices` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_purposes`
--

CREATE TABLE `property_purposes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updator_id` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_purposes`
--

INSERT INTO `property_purposes` (`id`, `name`, `slug`, `created_at`, `updator_id`) VALUES
(1, 'Rent', 'Rent', '2023-02-12 22:36:44', '2023-02-12 22:36:44'),
(2, 'Sale', 'Sale', '2023-02-12 22:36:44', '2023-02-12 22:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `property_terms`
--

CREATE TABLE `property_terms` (
  `id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `creator_id` int(11) DEFAULT NULL,
  `updator_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_terms`
--

INSERT INTO `property_terms` (`id`, `term_id`, `property_id`, `created_at`, `updated_at`, `creator_id`, `updator_id`) VALUES
(104, 1, 238, '2023-07-02 11:25:03', '2023-07-02 11:25:03', NULL, NULL),
(105, 1, 239, '2023-07-02 11:26:34', '2023-07-02 11:26:34', NULL, NULL),
(106, 1, 240, '2023-07-02 11:30:12', '2023-07-02 11:30:12', NULL, NULL),
(107, 1, 241, '2023-07-02 11:34:22', '2023-07-02 11:34:22', NULL, NULL),
(108, 1, 242, '2023-07-02 21:20:33', '2023-07-02 21:20:33', NULL, NULL),
(109, 1, 243, '2023-07-02 21:24:31', '2023-07-02 21:24:31', NULL, NULL),
(110, 3, 244, '2023-07-04 19:18:50', '2023-07-04 19:18:50', NULL, NULL),
(111, 3, 245, '2023-07-04 19:20:27', '2023-07-04 19:20:27', NULL, NULL),
(112, 1, 246, '2023-07-04 19:22:07', '2023-07-04 19:22:07', NULL, NULL),
(113, 3, 247, '2023-07-04 19:24:23', '2023-07-04 19:24:23', NULL, NULL),
(114, 1, 248, '2023-07-04 19:28:45', '2023-07-04 19:28:45', NULL, NULL),
(115, 3, 249, '2023-07-04 19:32:14', '2023-07-04 19:32:14', NULL, NULL),
(116, 3, 250, '2023-07-04 19:51:29', '2023-07-04 19:51:29', NULL, NULL),
(117, 3, 251, '2023-07-04 19:53:39', '2023-07-04 19:53:39', NULL, NULL),
(118, 3, 252, '2023-07-04 19:55:05', '2023-07-04 19:55:05', NULL, NULL),
(119, 1, 253, '2023-07-04 20:01:03', '2023-07-04 20:01:03', NULL, NULL),
(120, 1, 254, '2023-07-05 19:22:51', '2023-07-05 19:22:51', NULL, NULL),
(121, 1, 255, '2023-07-05 19:26:43', '2023-07-05 19:26:43', NULL, NULL),
(122, 3, 256, '2023-07-05 19:31:15', '2023-07-05 19:31:15', NULL, NULL),
(123, 3, 257, '2023-07-08 03:18:37', '2023-07-08 03:18:37', NULL, NULL),
(124, 3, 258, '2023-07-08 03:22:22', '2023-07-08 03:22:22', NULL, NULL),
(125, 3, 259, '2023-07-08 03:24:58', '2023-07-08 03:24:58', NULL, NULL),
(126, 3, 260, '2023-07-08 03:27:00', '2023-07-08 03:27:00', NULL, NULL),
(127, 1, 261, '2023-07-08 15:35:11', '2023-07-08 15:35:11', NULL, NULL),
(128, 1, 262, '2023-07-08 15:41:03', '2023-07-08 15:41:03', NULL, NULL),
(129, 3, 263, '2023-07-11 07:41:59', '2023-07-11 07:41:59', NULL, NULL),
(130, 3, 264, '2023-07-13 02:35:24', '2023-07-13 02:35:24', NULL, NULL),
(131, 1, 265, '2023-07-13 02:42:17', '2023-07-13 02:42:17', NULL, NULL),
(132, 3, 266, '2023-07-19 02:39:29', '2023-07-19 02:39:29', NULL, NULL),
(133, 3, 267, '2023-07-20 06:32:54', '2023-07-20 06:32:54', NULL, NULL),
(134, 1, 268, '2023-07-21 03:20:42', '2023-07-21 03:20:42', NULL, NULL),
(135, 1, 269, '2023-07-24 02:01:59', '2023-07-24 02:01:59', NULL, NULL),
(136, 1, 270, '2023-07-29 12:54:14', '2023-07-29 12:54:14', NULL, NULL),
(137, 3, 271, '2023-07-29 13:06:45', '2023-07-29 13:06:45', NULL, NULL),
(138, 1, 272, '2023-08-02 09:41:45', '2023-08-02 09:41:45', NULL, NULL),
(139, 1, 273, '2023-08-12 09:30:29', '2023-08-12 09:30:29', NULL, NULL),
(140, 2, 274, '2023-08-14 07:30:00', '2023-08-14 07:30:00', NULL, NULL),
(141, 1, 1, '2023-09-08 20:27:54', '2023-09-08 20:27:54', NULL, NULL),
(142, 1, 2, '2023-09-09 06:45:14', '2023-09-09 06:45:14', NULL, NULL),
(143, 1, 3, '2023-09-09 06:49:39', '2023-09-09 06:49:39', NULL, NULL),
(144, 1, 4, '2023-09-09 06:57:43', '2023-09-09 06:57:43', NULL, NULL),
(145, 2, 5, '2023-09-09 07:00:25', '2023-09-09 07:00:25', NULL, NULL),
(146, 2, 6, '2023-09-09 07:02:44', '2023-09-09 07:02:44', NULL, NULL),
(147, 2, 7, '2023-09-27 19:52:32', '2023-09-27 19:52:32', NULL, NULL),
(148, 2, 8, '2023-09-27 20:00:09', '2023-09-27 20:00:09', NULL, NULL),
(149, 2, 9, '2023-09-30 03:00:55', '2023-09-30 03:00:55', NULL, NULL),
(150, 2, 10, '2023-09-30 03:20:30', '2023-09-30 03:20:30', NULL, NULL),
(151, 2, 11, '2023-09-30 03:20:42', '2023-09-30 03:20:42', NULL, NULL),
(152, 2, 12, '2023-09-30 06:26:14', '2023-09-30 06:26:14', NULL, NULL),
(153, 1, 13, '2023-09-30 06:42:38', '2023-09-30 06:42:38', NULL, NULL),
(154, 2, 14, '2023-09-30 06:44:39', '2023-09-30 06:44:39', NULL, NULL),
(155, 3, 15, '2023-09-30 06:46:45', '2023-09-30 06:46:45', NULL, NULL),
(156, 3, 16, '2023-09-30 07:11:20', '2023-09-30 07:11:20', NULL, NULL),
(157, 3, 17, '2023-09-30 07:11:45', '2023-09-30 07:11:45', NULL, NULL),
(158, 3, 18, '2023-09-30 07:12:55', '2023-09-30 07:12:55', NULL, NULL),
(159, 3, 19, '2023-09-30 07:23:04', '2023-09-30 07:23:04', NULL, NULL),
(160, 3, 20, '2023-09-30 13:16:46', '2023-09-30 13:16:46', NULL, NULL),
(161, 3, 21, '2023-09-30 13:18:39', '2023-09-30 13:18:39', NULL, NULL),
(162, 3, 22, '2023-09-30 13:19:38', '2023-09-30 13:19:38', NULL, NULL),
(163, 2, 23, '2023-09-30 13:28:45', '2023-09-30 13:28:45', NULL, NULL),
(164, 2, 24, '2023-09-30 13:32:51', '2023-09-30 13:32:51', NULL, NULL),
(169, 2, 29, '2023-11-30 03:54:59', '2023-11-30 03:54:59', NULL, NULL),
(170, 2, 30, '2023-12-15 22:13:57', '2023-12-15 22:13:57', NULL, NULL),
(171, 2, 31, '2023-12-15 23:04:54', '2023-12-15 23:04:54', NULL, NULL),
(172, 2, 32, '2023-12-18 00:29:04', '2023-12-18 00:29:04', NULL, NULL),
(173, 1, 33, '2023-12-27 01:40:07', '2023-12-27 01:40:07', NULL, NULL),
(174, 2, 34, '2023-12-27 01:43:05', '2023-12-27 01:43:05', NULL, NULL),
(175, 1, 35, '2023-12-27 01:49:29', '2023-12-27 01:49:29', NULL, NULL),
(176, 3, 36, '2023-12-27 01:54:20', '2023-12-27 01:54:20', NULL, NULL),
(177, 2, 37, '2023-12-27 01:57:16', '2023-12-27 01:57:16', NULL, NULL),
(178, 2, 38, '2023-12-27 01:57:54', '2023-12-27 01:57:54', NULL, NULL),
(179, 2, 39, '2023-12-27 02:00:17', '2023-12-27 02:00:17', NULL, NULL),
(180, 3, 40, '2023-12-27 02:02:24', '2023-12-27 02:02:24', NULL, NULL),
(182, 2, 42, '2023-12-27 02:14:11', '2023-12-27 02:14:11', NULL, NULL),
(183, 2, 43, '2023-12-27 02:24:31', '2023-12-27 02:24:31', NULL, NULL),
(184, 2, 44, '2023-12-27 02:24:43', '2023-12-27 02:24:43', NULL, NULL),
(185, 2, 45, '2023-12-27 02:26:29', '2023-12-27 02:26:29', NULL, NULL),
(186, 2, 46, '2023-12-27 02:35:38', '2023-12-27 02:35:38', NULL, NULL),
(187, 2, 47, '2023-12-27 02:35:50', '2023-12-27 02:35:50', NULL, NULL),
(188, 2, 48, '2023-12-27 02:38:02', '2023-12-27 02:38:02', NULL, NULL),
(189, 1, 49, '2023-12-27 04:06:36', '2023-12-27 04:06:36', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_titles`
--

CREATE TABLE `property_titles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_titles`
--

INSERT INTO `property_titles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Single Room', '2023-02-17 23:43:31', '2023-02-17 23:43:31'),
(2, 'Apartment', '2023-02-17 23:44:03', '2023-02-17 23:44:03'),
(3, 'Office', '2023-02-17 23:44:14', '2023-02-17 23:44:14'),
(4, 'Shamba La Kulima', '2023-07-02 11:25:03', '2023-07-02 11:25:03'),
(5, 'Shamba La Kufuga Na Kulima', '2023-07-04 19:18:50', '2023-07-04 19:18:50'),
(6, 'Godown', '2023-07-04 20:01:03', '2023-07-04 20:01:03'),
(7, 'Plot', '2023-07-08 03:18:37', '2023-07-08 03:18:37'),
(8, 'Gorofa Moja', '2023-07-13 02:35:24', '2023-07-13 02:35:24'),
(9, 'Kiwanja Madale Mikoroshini', '2023-07-19 02:39:29', '2023-07-19 02:39:29'),
(10, 'House', '2023-07-20 07:55:20', '2023-07-20 07:55:20'),
(11, 'PSSSF Posta Shared Apartment', '2023-07-21 03:20:42', '2023-07-21 03:20:42'),
(12, 'Nyumba Inapangishwa Mwenge', '2023-07-24 02:01:59', '2023-07-24 02:01:59'),
(13, 'Single Room Master', '2023-07-29 12:54:14', '2023-07-29 12:54:14'),
(14, 'Gorofa Kunduchi', '2023-07-29 13:06:45', '2023-07-29 13:06:45'),
(15, 'Self House', '2023-08-12 09:30:29', '2023-08-12 09:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `slug` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `sub_category_id`, `name`, `create_at`, `updated_at`, `slug`) VALUES
(1, 0, 'Apartment', '2023-02-12 22:33:11', '2023-02-12 22:33:11', 'Commercial'),
(2, 0, 'Block of Flats', '2023-02-12 22:33:11', '2023-02-12 22:33:11', 'Apartments'),
(3, 0, 'Bungalow', '2023-04-30 07:27:38', '2023-04-30 07:27:38', NULL),
(5, 0, 'Chalet', '2023-04-30 07:31:38', '2023-04-30 07:31:38', NULL),
(6, 0, 'Condo', '2023-04-30 07:34:36', '2023-04-30 07:34:36', 'Short Let Property'),
(9, 1, 'Farm House', '2023-04-30 11:44:24', '2023-04-30 11:44:24', NULL),
(10, 1, 'Duplex', '2023-04-30 11:44:24', '2023-04-30 11:44:24', NULL),
(11, 1, 'Mini Flat', '2023-04-30 11:44:59', '2023-04-30 11:44:59', NULL),
(12, 1, 'House', '2023-04-30 11:44:59', '2023-04-30 11:44:59', NULL),
(13, 3, 'Mixed Use Land', '2023-04-30 22:14:58', '2023-04-30 22:14:58', NULL),
(14, 3, 'Farmland', '2023-04-30 22:14:58', '2023-04-30 22:14:58', NULL),
(15, 3, 'Residential Land', '2023-04-30 22:16:04', '2023-04-30 22:16:04', NULL),
(16, 3, 'Commercial  Land', '2023-04-30 22:16:04', '2023-04-30 22:16:04', NULL),
(17, 3, 'Quarry', '2023-04-30 22:16:53', '2023-04-30 22:16:53', NULL),
(18, 3, 'Industrial Land', '2023-04-30 22:16:53', '2023-04-30 22:16:53', NULL),
(19, 2, 'Godown', '2023-07-04 19:59:31', '2023-07-04 19:59:31', 'Godown'),
(20, 13, 'House', '2023-12-16 00:51:49', '2023-12-16 00:51:49', 'house'),
(21, 13, 'Apartment', '2023-12-16 00:51:49', '2023-12-16 00:51:49', 'apartment');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `rating` decimal(8,2) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `country_id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dar es Salam', 'Dar es Salam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'Arusha', 'Arusha', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'Pwani', 'Pwani', '2023-07-02 11:31:20', '2023-07-02 11:31:20'),
(4, 1, 'Mwanza', 'Mwanza', '2023-07-05 19:07:10', '2023-07-05 19:07:10'),
(5, 1, 'Dodoma', 'Dodoma', '2023-07-05 19:07:10', '2023-07-05 19:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Agent', 'Agent', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_order` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `aboutus` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `creator_id` int(11) DEFAULT NULL,
  `updator_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(1, 3, 'Houses and Apartments for Sale', 'houses-apartments-for-sale', '', '2023-04-28 10:57:29', '2023-04-28 10:57:29'),
(2, 3, 'Commercial Property for Sale', 'commercial-property-for-sale', '', '2023-04-28 10:57:29', '2023-04-28 10:57:29'),
(3, 3, 'Land & Plots for Sale', 'land-and-plots-for-sale', '', '2023-04-29 11:00:14', '2023-04-29 11:00:14'),
(4, 3, 'Event Centers,Venues and Workstations', 'event-centers-and-venues', '', '2023-04-27 11:00:14', '2023-04-21 11:00:14'),
(6, 3, 'Short Let Property', 'temporary-and-vacation-rentals', '', '2023-04-30 11:02:02', '2023-04-30 11:02:02'),
(12, 1, 'Commercial Property for Rent', 'commercial-property-for-rent', '', '2023-12-16 00:41:23', '2023-12-16 00:41:23'),
(13, 1, 'Houses and Apartments for Rent', 'houses-apartments-for-rent', '', '2023-12-16 00:42:37', '2023-12-16 00:42:37'),
(14, 1, 'Land & Plots for Rent', 'land-and-plots-for-rent', '', '2023-12-16 00:43:50', '2023-12-16 00:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Six Months', '2023-04-29 21:16:31', '2023-04-29 21:16:31'),
(2, 'one Month', '2023-04-29 21:16:31', '2023-04-29 21:16:31'),
(3, 'Cash', '2023-07-02 20:52:11', '2023-07-02 20:52:11');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonial` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT 2,
  `email_verified_at` datetime DEFAULT NULL,
  `google_id` varchar(200) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `email_verified_at`, `google_id`, `name`, `username`, `email`, `phone_number`, `image`, `about`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 2, '2023-12-18 02:52:15', NULL, 'kelvin', 'kelvin', 'kevo93mushy@gmail.com', '0767059735', 'images/agent/111014231411652a77524a0a5_andrew tate.jfif', 'Hello , I\'m Best in Real estate Agent', '$2y$10$wufBIrNZ5/3tUV3AYH0fxe7dmP8OONQZqENeH9pTod5S7gHqU04ua', '4KgcBZ3seduy2kHHNT4cTwazRByd517w0PeN58btqQWfTrUhhQ0rKSqazNt0', '2023-09-08 20:24:18', '2023-12-23 03:17:34'),
(7, 2, NULL, NULL, 'kelvin', NULL, 'kelvin@exactmanpower.co.tz', NULL, NULL, NULL, '$2y$10$NYVL14JJSQ0us3iRYL7LI.8yAhkjkKK5bdcz9bNgI.lpDYCyY7xVG', NULL, '2023-11-20 00:40:59', '2023-11-20 00:40:59'),
(9, 2, '2023-12-18 02:52:15', NULL, 'Cosmas', 'Cosmas', 'kevomassawe@gmail.com', '0767059735', 'images/agent/03122323145665865a5ea3215_74ca9ad50147d6b022ac7135dbfa366b.jpeg', 'Buy and Rent', '$2y$10$pnIjpHOKWpfrWQZuqTFjFeklhP.n1ob7qHABhUPGHyZoP80RGy28S', NULL, '2023-12-23 00:53:54', '2023-12-23 00:56:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_locations`
--

CREATE TABLE `user_locations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `sub_location` varchar(200) NOT NULL,
  `updator_id` int(11) DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_locations`
--

INSERT INTO `user_locations` (`id`, `user_id`, `district_id`, `sub_location`, `updator_id`, `creator_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'kinondoni', 1, NULL, '2023-10-14 01:30:59', '2023-10-14 01:30:59'),
(2, 1, 1, 'ubungo', 1, NULL, '2023-10-14 03:47:54', '2023-10-14 03:47:54'),
(3, 1, 22, 'dodoma', 1, NULL, '2023-10-14 08:08:53', '2023-10-14 08:08:53'),
(4, 1, 7, 'kigamboni', 1, NULL, '2023-10-14 08:11:14', '2023-10-14 08:11:14'),
(5, 5, 1, 'ubungo', 5, NULL, '2023-11-19 14:44:41', '2023-11-19 14:44:41'),
(6, 9, 7, 'Kigamboni', 9, NULL, '2023-12-23 00:56:14', '2023-12-23 00:56:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_social_media`
--

CREATE TABLE `user_social_media` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `social_media_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `creator_id` int(11) DEFAULT NULL,
  `updator_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_post`
--
ALTER TABLE `category_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `characteristics`
--
ALTER TABLE `characteristics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_requests`
--
ALTER TABLE `client_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conditions`
--
ALTER TABLE `conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_properties`
--
ALTER TABLE `feature_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_property`
--
ALTER TABLE `feature_property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `furnishes`
--
ALTER TABLE `furnishes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `near_byes`
--
ALTER TABLE `near_byes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_areas`
--
ALTER TABLE `property_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_barths`
--
ALTER TABLE `property_barths`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_bead_rooms`
--
ALTER TABLE `property_bead_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_conditions`
--
ALTER TABLE `property_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_currencies`
--
ALTER TABLE `property_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_furnishes`
--
ALTER TABLE `property_furnishes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_image_galleries`
--
ALTER TABLE `property_image_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_locations`
--
ALTER TABLE `property_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_near_bies`
--
ALTER TABLE `property_near_bies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_prices`
--
ALTER TABLE `property_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_purposes`
--
ALTER TABLE `property_purposes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_terms`
--
ALTER TABLE `property_terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_titles`
--
ALTER TABLE `property_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_locations`
--
ALTER TABLE `user_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_social_media`
--
ALTER TABLE `user_social_media`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `category_post`
--
ALTER TABLE `category_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `characteristics`
--
ALTER TABLE `characteristics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_requests`
--
ALTER TABLE `client_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conditions`
--
ALTER TABLE `conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `feature_properties`
--
ALTER TABLE `feature_properties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=515;

--
-- AUTO_INCREMENT for table `feature_property`
--
ALTER TABLE `feature_property`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `furnishes`
--
ALTER TABLE `furnishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `near_byes`
--
ALTER TABLE `near_byes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `property_areas`
--
ALTER TABLE `property_areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `property_barths`
--
ALTER TABLE `property_barths`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `property_bead_rooms`
--
ALTER TABLE `property_bead_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `property_conditions`
--
ALTER TABLE `property_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `property_currencies`
--
ALTER TABLE `property_currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_furnishes`
--
ALTER TABLE `property_furnishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `property_image_galleries`
--
ALTER TABLE `property_image_galleries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `property_locations`
--
ALTER TABLE `property_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `property_near_bies`
--
ALTER TABLE `property_near_bies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `property_prices`
--
ALTER TABLE `property_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_purposes`
--
ALTER TABLE `property_purposes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `property_terms`
--
ALTER TABLE `property_terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `property_titles`
--
ALTER TABLE `property_titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_locations`
--
ALTER TABLE `user_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_social_media`
--
ALTER TABLE `user_social_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
