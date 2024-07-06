-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 06:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codehunger-task`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', '$2y$12$ns0GmLgzFzkT2aQ59Xa2A.zitNLsMAMc3b8GqdlsajwM1yUhL9p2S', NULL, NULL);

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
(111, 'cate 5', '2024-06-21 07:02:59', '2024-06-21 07:02:59'),
(138, 'cate 1', '2024-06-21 10:39:34', '2024-06-21 10:39:34'),
(140, 'cate 3', '2024-06-21 10:39:34', '2024-06-21 10:39:34'),
(141, 'cate 4', '2024-06-21 10:39:34', '2024-06-21 10:39:34'),
(142, 'cate 5', '2024-06-21 10:39:34', '2024-06-21 10:39:34'),
(143, 'cate 6', '2024-06-21 10:39:34', '2024-06-21 10:39:34'),
(144, 'cate 7', '2024-06-21 10:39:34', '2024-06-21 10:39:34'),
(145, 'cate 8', '2024-06-21 10:39:34', '2024-06-21 10:39:34'),
(146, 'cate 9', '2024-06-21 10:39:34', '2024-06-21 10:39:34'),
(147, 'cate 10', '2024-06-21 10:39:34', '2024-06-21 10:39:34'),
(150, 'cate 1', '2024-06-21 10:43:38', '2024-06-21 10:43:38'),
(152, 'cate 3', '2024-06-21 10:43:38', '2024-06-21 10:43:38'),
(153, 'cate 4', '2024-06-21 10:43:38', '2024-06-21 10:43:38'),
(154, 'cate 5', '2024-06-21 10:43:38', '2024-06-21 10:43:38'),
(158, 'cate 9', '2024-06-21 10:43:38', '2024-06-21 10:43:38'),
(159, 'cate 10', '2024-06-21 10:43:38', '2024-06-21 10:43:38'),
(160, 'cate 1', '2024-06-21 12:41:16', '2024-06-21 12:41:16'),
(161, 'cate 2', '2024-06-21 12:41:16', '2024-06-21 12:41:16'),
(162, 'cate 3', '2024-06-21 12:41:16', '2024-06-21 12:41:16'),
(163, 'cate 4', '2024-06-21 12:41:16', '2024-06-21 12:41:16'),
(164, 'cate 5', '2024-06-21 12:41:16', '2024-06-21 12:41:16'),
(165, 'cate 6', '2024-06-21 12:41:16', '2024-06-21 12:41:16'),
(166, 'cate 7', '2024-06-21 12:41:16', '2024-06-21 12:41:16'),
(167, 'cate 8', '2024-06-21 12:41:16', '2024-06-21 12:41:16'),
(168, 'cate 9', '2024-06-21 12:41:16', '2024-06-21 12:41:16'),
(169, 'cate 10', '2024-06-21 12:41:16', '2024-06-21 12:41:16'),
(170, 'cate 1', '2024-06-22 07:12:20', '2024-06-22 07:12:20'),
(171, 'cate 2', '2024-06-22 07:12:20', '2024-06-22 07:12:20'),
(172, 'cate 3', '2024-06-22 07:12:20', '2024-06-22 07:12:20'),
(173, 'cate 4', '2024-06-22 07:12:20', '2024-06-22 07:12:20'),
(174, 'cate 5', '2024-06-22 07:12:20', '2024-06-22 07:12:20'),
(175, 'cate 6', '2024-06-22 07:12:20', '2024-06-22 07:12:20'),
(176, 'cate 7', '2024-06-22 07:12:20', '2024-06-22 07:12:20'),
(177, 'cate 8', '2024-06-22 07:12:20', '2024-06-22 07:12:20'),
(178, 'cate 9', '2024-06-22 07:12:20', '2024-06-22 07:12:20'),
(179, 'cate 10', '2024-06-22 07:12:20', '2024-06-22 07:12:20'),
(180, 'cate 1', '2024-06-22 11:11:52', '2024-06-22 11:11:52'),
(181, 'cate 2', '2024-06-22 11:11:52', '2024-06-22 11:11:52'),
(182, 'cate 3', '2024-06-22 11:11:52', '2024-06-22 11:11:52'),
(183, 'cate 4', '2024-06-22 11:11:52', '2024-06-22 11:11:52'),
(184, 'cate 5', '2024-06-22 11:11:52', '2024-06-22 11:11:52'),
(185, 'cate 6', '2024-06-22 11:11:52', '2024-06-22 11:11:52'),
(186, 'cate 7', '2024-06-22 11:11:52', '2024-06-22 11:11:52'),
(187, 'cate 8', '2024-06-22 11:11:52', '2024-06-22 11:11:52'),
(188, 'cate 9', '2024-06-22 11:11:52', '2024-06-22 11:11:52'),
(189, 'cate 10', '2024-06-22 11:11:52', '2024-06-22 11:11:52');

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
(1, '2024_06_21_081110_create_admins_table', 1),
(2, '2024_06_21_082959_create_categories_table', 2),
(4, '2024_06_22_094648_create_products_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_name`, `name`, `image`, `created_at`, `updated_at`) VALUES
(3, 161, 'pritam', '1719059687.jpg', '2024-06-22 07:04:47', '2024-06-22 07:04:47'),
(6, 159, 'daawdadw', '1719074135.jpg', '2024-06-22 11:05:35', '2024-06-22 11:07:31');

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_name_foreign` (`category_name`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_name_foreign` FOREIGN KEY (`category_name`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
