-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 09, 2021 at 04:03 AM
-- Server version: 5.6.51-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tesolution`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `img_Url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_Description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case_Id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `img_Url`, `img_Description`, `case_Id`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'img_1605560402.jpg', 'الصورة الشخصيه للعميل', 1, 1, '2020-11-16 20:59:30', '2020-11-16 21:00:02'),
(2, 'img_1624053118.jpeg', 'صورة بطاقه الموكل', 21, 1, '2021-06-19 06:51:58', '2021-06-19 06:51:58'),
(3, 'img_1624054692.pdf', 'تفاصيل الدعوى', 1, 1, '2021-06-19 07:18:12', '2021-06-19 07:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invetation_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `circle_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `court` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `first_session_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inventation_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_whome` bigint(20) UNSIGNED NOT NULL,
  `descion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not yet',
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2',
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2',
  `one_session_note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`id`, `invetation_num`, `circle_num`, `court`, `parent_id`, `first_session_date`, `inventation_type`, `to_whome`, `descion`, `month`, `year`, `one_session_note`, `created_at`, `updated_at`) VALUES
(1, '232323', '2050', 'شرق الزقازيق yvf', 1, '2020-08-28', 'جنح test', 4, 'not yet', '08', '2020', '', '2020-08-28 10:12:56', '2021-06-17 18:07:46'),
(2, '2000', '502', 'east', 1, '2020-09-21', 'admin', 6, 'not yet', '09', '2020', '', '2020-09-21 14:17:24', '2021-05-30 00:46:54'),
(3, '123', '13223', '234234', 1, '2020-10-01', 'kill', 2, 'not yet', '10', '2020', '', '2020-10-01 17:37:07', '2020-10-01 17:37:07'),
(4, '123', '13223', '234234', 1, '2020-09-30', 'kill', 2, 'not yet', '09', '2020', '', '2020-10-01 17:42:42', '2020-10-01 17:42:42'),
(5, '123', '13223', '234234', 1, '2020-09-29', 'kill', 2, 'not yet', '09', '2020', '', '2020-10-01 17:47:35', '2020-10-01 17:47:35'),
(6, '123', '13223', '234234', 1, '2020-09-29', 'kill', 2, 'not yet', '09', '2020', '', '2020-10-01 17:47:51', '2020-10-01 17:47:51'),
(7, '123', '13223', '234234', 1, '2020-09-29', 'kill', 2, 'not yet', '09', '2020', '', '2020-10-01 17:56:55', '2020-10-01 17:56:55'),
(9, 'nbvnb', 'nvnb', 'bn', 1, '2020-09-29', ',mn,', 2, 'not yet', '09', '2020', '', '2020-10-01 18:04:19', '2020-10-01 18:04:19'),
(10, '123', 'hdgd', 'hdshg', 1, '2020-10-06', 'fhjfhgf', 2, 'not yet', '10', '2020', '', '2020-10-01 18:10:49', '2020-10-09 11:44:50'),
(11, 'ghn', 'hgdf', 'dgf', 1, '2020-10-01', 'hgjhg', 2, 'not yet', '10', '2020', '', '2020-10-01 18:14:14', '2020-10-01 18:14:14'),
(12, 'اتلتال', 'ايالي', 'اياليال', 1, '2020-10-15', 'ةوﻻوةﻻ', 2, 'not yet', '10', '2020', '', '2020-10-01 18:21:04', '2020-10-01 18:21:04'),
(13, 'nbvnb', 'mnbmn', 'bn', 1, '2020-10-14', 'm,bb,mb', 2, 'not yet', '10', '2020', '', '2020-10-01 18:22:06', '2020-10-01 18:22:06'),
(14, 'nbvnbkhjkjh', 'gghdhgd', 'jhfjhfjh', 1, '2020-10-19', 'hfjh', 2, 'not yet', '10', '2020', '', '2020-10-01 18:24:51', '2020-10-01 18:24:51'),
(15, 'mnbmn', 'mgmnvgmn', 'jhfjh', 1, '2020-10-14', 'nvmnv', 2, 'not yet', '10', '2020', '', '2020-10-01 18:30:37', '2020-10-01 18:30:37'),
(16, 'nmvmnv', 'fnbc', 'cnbc', 1, '2020-10-19', 'nmvbmnv', 2, 'not yet', '10', '2020', '', '2020-10-01 18:31:04', '2020-10-01 18:31:04'),
(17, '2001', '25', 'east', 1, '2020-07-23', 'admin', 6, 'not yet', '07', '2020', '', '2020-11-23 00:41:20', '2020-11-23 00:41:20'),
(18, '2000', '502', 'east', 1, '2020-07-23', 'admin', 6, 'not yet', '07', '2020', '', '2020-11-23 01:17:55', '2020-11-23 20:33:54'),
(19, '50021', '25', 'east', 1, '2021-07-07', 'admin', 6, 'not yet', '07', '2021', '', '2021-04-27 02:55:57', '2021-04-27 02:55:57'),
(20, '50021', '25', 'east', 1, '2021-07-07', 'admin', 6, 'not yet', '07', '2021', '', '2021-04-27 02:56:47', '2021-04-27 02:56:47'),
(21, '2000', '502', 'east', 1, '2021-04-26', 'admin', 6, 'not yet', '04', '2021', '', '2021-04-27 03:08:12', '2021-06-17 05:01:29'),
(22, 'رقم الدعوى', 'رقم الدائرة', 'محكمة', 1, '2021-04-26', 'نوع الدعوى', 4, 'not yet', '04', '2021', '', '2021-04-27 03:14:50', '2021-04-27 03:14:50'),
(23, 'يىبىبى', 'بىبىبى', 'بىبىبى', 1, '2021-04-26', 'بىبب', 4, 'not yet', '04', '2021', '', '2021-04-27 03:26:05', '2021-04-27 03:26:05'),
(24, 'ةة', 'ةة', 'ااةة', 1, '2021-04-26', 'ةةة', 4, 'not yet', '04', '2021', '', '2021-04-27 03:28:03', '2021-04-27 03:28:03'),
(25, 'تتتتات', 'تتتتتن', 'تووت', 1, '2021-04-27', 'تتتتتا', 4, 'not yet', '04', '2021', '', '2021-04-28 04:23:59', '2021-04-28 04:23:59'),
(26, 'مززخزم', 'كظحظحظ', 'زكزكزك', 1, '2021-04-27', 'زمزكزم', 2, 'not yet', '04', '2021', '', '2021-04-28 04:25:41', '2021-04-28 04:25:41'),
(27, 'زكزمكز', 'هونخزخ', 'وممومز.', 1, '2021-04-27', 'ن مووم', 7, 'not yet', '04', '2021', '', '2021-04-28 04:28:37', '2021-04-28 04:28:37'),
(28, 'رقم للدعوى', 'رقم الداىرة', 'محكمة نقض الجيزة', 1, '2021-04-28', 'قتل عمد', 2, 'not yet', '04', '2021', '', '2021-04-29 03:47:23', '2021-04-29 03:47:23'),
(29, 'ترترت', 'ترنرت', 'ورنىنى', 1, '2021-06-08', 'نىمىنن', 2, 'not yet', '06', '2021', '', '2021-06-19 23:48:20', '2021-06-19 23:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `case_clients`
--

CREATE TABLE `case_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `case_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_clients`
--

INSERT INTO `case_clients` (`id`, `case_id`, `client_id`, `created_at`, `updated_at`) VALUES
(5, 2, 6, '2020-09-21 14:17:25', '2020-09-21 14:17:25'),
(7, 3, 2, '2020-10-01 17:37:07', '2020-10-01 17:37:07'),
(9, 4, 2, '2020-10-01 17:42:42', '2020-10-01 17:42:42'),
(11, 5, 2, '2020-10-01 17:47:35', '2020-10-01 17:47:35'),
(13, 6, 2, '2020-10-01 17:47:51', '2020-10-01 17:47:51'),
(15, 7, 2, '2020-10-01 17:56:55', '2020-10-01 17:56:55'),
(19, 9, 2, '2020-10-01 18:04:19', '2020-10-01 18:04:19'),
(21, 10, 2, '2020-10-01 18:10:50', '2020-10-01 18:10:50'),
(23, 11, 2, '2020-10-01 18:14:14', '2020-10-01 18:14:14'),
(25, 12, 2, '2020-10-01 18:21:04', '2020-10-01 18:21:04'),
(27, 13, 2, '2020-10-01 18:22:06', '2020-10-01 18:22:06'),
(29, 14, 2, '2020-10-01 18:24:51', '2020-10-01 18:24:51'),
(31, 15, 2, '2020-10-01 18:30:37', '2020-10-01 18:30:37'),
(33, 16, 2, '2020-10-01 18:31:04', '2020-10-01 18:31:04'),
(37, 1, 2, '2020-10-09 18:22:10', '2020-10-09 18:22:10'),
(55, 17, 2, '2020-11-23 00:41:20', '2020-11-23 00:41:20'),
(57, 18, 2, '2020-11-23 01:17:55', '2020-11-23 01:17:55'),
(58, 19, 2, '2021-04-27 02:55:57', '2021-04-27 02:55:57'),
(59, 19, 6, '2021-04-27 02:55:57', '2021-04-27 02:55:57'),
(60, 19, 7, '2021-04-27 02:55:57', '2021-04-27 02:55:57'),
(61, 19, 14, '2021-04-27 02:55:57', '2021-04-27 02:55:57'),
(62, 19, 22, '2021-04-27 02:55:57', '2021-04-27 02:55:57'),
(63, 20, 2, '2021-04-27 02:56:47', '2021-04-27 02:56:47'),
(64, 20, 6, '2021-04-27 02:56:47', '2021-04-27 02:56:47'),
(65, 20, 7, '2021-04-27 02:56:47', '2021-04-27 02:56:47'),
(66, 20, 14, '2021-04-27 02:56:47', '2021-04-27 02:56:47'),
(67, 20, 22, '2021-04-27 02:56:47', '2021-04-27 02:56:47'),
(68, 21, 2, '2021-04-27 03:08:12', '2021-04-27 03:08:12'),
(69, 21, 6, '2021-04-27 03:08:12', '2021-04-27 03:08:12'),
(70, 21, 7, '2021-04-27 03:08:12', '2021-04-27 03:08:12'),
(71, 21, 14, '2021-04-27 03:08:12', '2021-04-27 03:08:12'),
(72, 21, 22, '2021-04-27 03:08:12', '2021-04-27 03:08:12'),
(73, 22, 16, '2021-04-27 03:14:50', '2021-04-27 03:14:50'),
(74, 22, 17, '2021-04-27 03:14:50', '2021-04-27 03:14:50'),
(75, 22, 21, '2021-04-27 03:14:50', '2021-04-27 03:14:50'),
(76, 22, 14, '2021-04-27 03:14:50', '2021-04-27 03:14:50'),
(77, 22, 22, '2021-04-27 03:14:50', '2021-04-27 03:14:50'),
(78, 23, 2, '2021-04-27 03:26:05', '2021-04-27 03:26:05'),
(79, 23, 6, '2021-04-27 03:26:05', '2021-04-27 03:26:05'),
(80, 23, 7, '2021-04-27 03:26:05', '2021-04-27 03:26:05'),
(81, 23, 14, '2021-04-27 03:26:05', '2021-04-27 03:26:05'),
(82, 23, 22, '2021-04-27 03:26:05', '2021-04-27 03:26:05'),
(83, 24, 2, '2021-04-27 03:28:03', '2021-04-27 03:28:03'),
(84, 24, 6, '2021-04-27 03:28:03', '2021-04-27 03:28:03'),
(85, 24, 22, '2021-04-27 03:28:03', '2021-04-27 03:28:03'),
(86, 25, 2, '2021-04-28 04:23:59', '2021-04-28 04:23:59'),
(87, 25, 6, '2021-04-28 04:23:59', '2021-04-28 04:23:59'),
(88, 25, 7, '2021-04-28 04:23:59', '2021-04-28 04:23:59'),
(89, 25, 8, '2021-04-28 04:23:59', '2021-04-28 04:23:59'),
(90, 25, 9, '2021-04-28 04:23:59', '2021-04-28 04:23:59'),
(91, 25, 14, '2021-04-28 04:23:59', '2021-04-28 04:23:59'),
(92, 25, 22, '2021-04-28 04:23:59', '2021-04-28 04:23:59'),
(93, 26, 2, '2021-04-28 04:25:41', '2021-04-28 04:25:41'),
(94, 26, 6, '2021-04-28 04:25:41', '2021-04-28 04:25:41'),
(95, 26, 14, '2021-04-28 04:25:41', '2021-04-28 04:25:41'),
(96, 26, 22, '2021-04-28 04:25:41', '2021-04-28 04:25:41'),
(97, 27, 2, '2021-04-28 04:28:37', '2021-04-28 04:28:37'),
(99, 27, 14, '2021-04-28 04:28:37', '2021-04-28 04:28:37'),
(101, 28, 2, '2021-04-29 03:47:23', '2021-04-29 03:47:23'),
(105, 28, 14, '2021-04-29 03:47:23', '2021-04-29 03:47:23'),
(107, 1, 14, '2021-06-12 21:25:14', '2021-06-12 21:25:14'),
(108, 29, 2, '2021-06-19 23:48:20', '2021-06-19 23:48:20'),
(109, 29, 6, '2021-06-19 23:48:20', '2021-06-19 23:48:20'),
(110, 29, 22, '2021-06-19 23:48:20', '2021-06-19 23:48:20'),
(111, 29, 23, '2021-06-19 23:48:20', '2021-06-19 23:48:20'),
(112, 1, 2, '2021-07-09 19:32:27', '2021-07-09 19:32:27'),
(113, 1, 6, '2021-07-09 19:32:27', '2021-07-09 19:32:27'),
(114, 1, 14, '2021-07-09 19:42:52', '2021-07-09 19:42:52'),
(115, 1, 22, '2021-07-09 19:42:52', '2021-07-09 19:42:52'),
(116, 1, 23, '2021-07-09 19:42:52', '2021-07-09 19:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'cat 1', NULL, '2020-08-28 10:03:27', '2020-08-28 10:03:27'),
(2, 'category edit from edit api', 1, '2020-08-28 10:09:54', '2021-02-20 05:02:33'),
(4, 'product 1', 1, '2020-10-02 10:50:38', '2020-10-02 10:50:38'),
(6, 'test update3', 1, '2020-10-02 10:51:04', '2021-02-06 23:46:40'),
(7, 'cate one from api', 1, '2021-02-19 22:59:02', '2021-02-19 22:59:02'),
(8, 'category edit from edit api', 1, '2021-02-19 23:27:14', '2021-02-19 23:40:32'),
(9, 'manager', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_Unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('client','khesm') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `client_Address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `client_Name`, `client_Unit`, `type`, `client_Address`, `notes`, `cat_id`, `parent_id`, `created_at`, `updated_at`) VALUES
(2, 'محمد ناصر حامد محمد', '5115', 'client', '15 sasa5', 'sdf  wsvd5', 2, 1, '2020-08-28 10:11:17', '2021-04-29 03:44:47'),
(6, 'مصطفى عبدالله مصطفى الابزارى', '511', 'client', '15 sasa', 'sdf  wsvd', 2, 1, '2021-02-12 07:05:58', '2021-04-29 03:45:35'),
(7, 'مصطفى محمد عبده عبد العزيز', '511', 'client', '15 sasa', 'sdf  wsvd', 2, 1, '2021-02-12 07:09:27', '2021-04-29 03:45:56'),
(8, 'احمد عبد العليم احمد محمد', '511', 'client', '15 sasa', 'sdf  wsvd', 2, 1, '2021-02-12 07:39:47', '2021-04-29 03:46:14'),
(9, 'fjjjgvnnv', 'mvvmvn', 'client', 'cncncncn', 'fnncvngj', 4, 1, '2021-02-12 08:17:35', '2021-02-12 08:17:35'),
(11, 'rawan', 'vvvv', 'client', 'gvvc', 'cbcbcbcb', 6, 1, '2021-02-12 08:26:56', '2021-02-15 02:03:43'),
(12, 'eeere', 'dffff', 'client', 'fffff', 'vhhh', 6, 1, '2021-02-12 08:29:46', '2021-02-12 08:29:46'),
(13, 'dvxvbx', 'fhfbxb', 'client', 'dbcbcbcb', 'Xvxbcbcbcb', 2, 1, '2021-02-16 05:01:05', '2021-02-16 05:01:05'),
(14, 'test', 'test', 'khesm', 'test', 'Hamed.higazy@yahoo.com El Beheira', 2, 1, '2021-02-20 05:57:41', '2021-02-20 05:57:41'),
(15, 'client 1', '511', 'client', '15 sasa', 'sdf  wsvd', 2, 1, '2021-02-21 00:10:41', '2021-02-21 00:10:41'),
(16, 'El Beheira for', 'El Beheira for', 'client', 'El Beheira for', 'El Beheira for the past few years in the past few years and I am sure you will be able at', 6, 1, '2021-02-21 00:10:59', '2021-02-21 00:21:32'),
(17, 'El El Beheira', 'El El Beheira', 'client', 'El El Beheira', 'El El Beheira', 2, 1, '2021-02-21 01:29:00', '2021-02-21 01:29:00'),
(18, 'client 1', '511', 'client', '15 sasa', 'sdf  wsvd', 2, 1, '2021-02-21 01:31:22', '2021-02-21 01:31:22'),
(19, 'client 1', '511', 'client', '15 sasa', 'sdf  wsvd', 2, 1, '2021-02-21 01:34:07', '2021-02-21 01:34:07'),
(20, 'client 1', '511', 'client', '15 sasa', 'sdf  wsvd', 2, 1, '2021-02-21 01:35:06', '2021-02-21 01:35:06'),
(21, 'client 1', '511', 'client', '15 sasa', 'sdf  wsvd', 2, 1, '2021-02-21 01:36:59', '2021-02-21 01:36:59'),
(22, 'ggg', 'ffff', 'khesm', 'ffff', 'Ddddd', 2, 1, '2021-02-21 01:37:34', '2021-02-21 01:37:46'),
(23, 'مصطفى محمود أحمد إبراهيم', 'وحده اعمار مصر  رقم ٣٥٠', 'khesm', 'القاهره الجديدة', 'مسجل من عند استاذ احمد', 4, 1, '2021-06-19 21:41:28', '2021-06-19 21:41:28');

-- --------------------------------------------------------

--
-- Table structure for table `client_attachments`
--

CREATE TABLE `client_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `img_Url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_Description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_Id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client__notes`
--

CREATE TABLE `client__notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client__notes`
--

INSERT INTO `client__notes` (`id`, `client_id`, `user_id`, `notes`, `parent_id`, `created_at`, `updated_at`) VALUES
(10, 6, 1, 'test', 1, '2021-02-15 04:30:03', NULL),
(11, 6, 1, 'hello from other side', 1, '2021-02-15 05:27:15', '2021-02-15 05:27:15'),
(15, 2, 1, 'hello from other side 5', 1, '2021-02-15 06:00:16', '2021-02-20 04:58:14'),
(16, 2, 1, 'تست من خلال هذا العام في كل مكان في العالم العربي والإسلامي من خلال هذا العام في كل مكان في العالم العربي والإسلامي من خلال', 1, '2021-02-19 22:39:46', '2021-02-19 22:39:46'),
(17, 2, 1, 'El Beheira for the past few years in the past for a while but I was wondering if', 1, '2021-02-20 07:04:32', '2021-02-20 07:04:32'),
(18, 2, 1, '5', 1, '2021-05-19 23:58:02', '2021-05-19 23:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manual_pass_resets`
--

CREATE TABLE `manual_pass_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manual_pass_resets`
--

INSERT INTO `manual_pass_resets` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(1, 'user@gmail.com', '7184', '2020-11-20 21:05:50', '2020-11-20 21:46:02'),
(2, 'hany@gmail.com', '6967', '2020-11-21 10:40:57', '2020-11-21 16:58:20');

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
(1, '2010_07_16_132205_create_packages_table', 1),
(2, '2014_02_04_052807_create_categories_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2020_01_18_110312_clients', 1),
(6, '2020_02_05_183548_cases', 1),
(7, '2020_02_05_185849_sessions', 1),
(8, '2020_02_10_190404_create_mohdrs_table', 1),
(9, '2020_03_13_165529_create_session__notes_table', 1),
(10, '2020_05_14_203757_create_case_clients_table', 1),
(11, '2020_05_27_231525_create_attachments_table', 1),
(12, '2020_05_28_000358_create_files_table', 1),
(13, '2020_05_28_200834_create_permissions_table', 1),
(14, '2020_06_23_182817_create_client__notes_table', 1),
(15, '2020_11_20_230304_create_manual_pass_resets_table', 2),
(16, '2020_10_03_142713_create_client_attachments_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mohdrs`
--

CREATE TABLE `mohdrs` (
  `moh_Id` bigint(20) UNSIGNED NOT NULL,
  `court_mohdareen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paper_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deliver_data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paper_Number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_Date` date NOT NULL,
  `mokel_Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khesm_Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `case_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mohdrs`
--

INSERT INTO `mohdrs` (`moh_Id`, `court_mohdareen`, `paper_type`, `deliver_data`, `paper_Number`, `session_Date`, `mokel_Name`, `khesm_Name`, `parent_id`, `notes`, `cat_id`, `case_number`, `status`, `created_at`, `updated_at`) VALUES
(5, 'ىﻻئءةؤ', 'ﻻئءءةىﻻئءةر', '2021-04-25', 'وةيسىبورةئ', '2021-04-25', 'elewa ahmed', 'mostafa elngar', 1, 'ﻻةىئؤءﻻةئءؤ', 2, 'ىىﻻئيةىئء', 'No', '2020-10-01 21:00:47', '2021-06-20 00:49:09'),
(6, 'ﻻىييؤةىؤءﻻ', 'ﻻءئءةؤئﻻءؤ', '2020-10-06', 'ىئﻻءرؤءﻻىر', '2020-10-26', 'elewa ahmed', 'mostafa elngar', 1, 'ﻻئءوةﻻةؤ', 2, 'وةﻻييبوةيئﻻب', 'Yes', '2020-10-01 21:02:27', '2021-04-25 00:59:15'),
(7, 'mohdreen court', 'type', 'data', '1234', '2020-10-14', 'rawan', 'test', 1, 'notesss', 8, '232323', 'No', '2021-06-20 00:37:26', '2021-06-20 00:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `cost`, `duration`, `created_at`, `updated_at`) VALUES
(1, 'package num 1', '1000', 30, '2020-08-28 10:02:10', '2020-08-28 10:02:10'),
(2, 'manager', '0', 3333, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `users` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `clients` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `addcases` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `search_case` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `mohdreen` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `daily_report` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `monthly_report` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `category` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `user_id`, `users`, `clients`, `addcases`, `search_case`, `mohdreen`, `daily_report`, `monthly_report`, `category`, `created_at`, `updated_at`) VALUES
(1, 1, 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', NULL, '2020-11-21 16:24:09'),
(11, 11, 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', '2020-11-16 21:38:53', '2021-02-20 05:33:10'),
(13, 13, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '2020-11-21 13:02:11', '2020-12-04 16:09:24'),
(15, 16, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '2020-12-04 16:25:47', '2020-12-04 16:25:47'),
(17, 18, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '2021-02-06 23:45:13', '2021-02-06 23:45:13'),
(19, 20, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '2021-02-16 06:22:11', '2021-02-16 06:22:11'),
(20, 21, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '2021-02-16 06:28:10', '2021-02-16 06:28:10'),
(23, 24, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '2021-02-21 00:12:33', '2021-02-21 00:12:33'),
(24, 25, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '2021-02-21 01:41:47', '2021-02-21 01:41:47'),
(25, 26, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '2021-02-21 01:57:34', '2021-02-21 01:57:34'),
(26, 27, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '2021-02-21 02:02:48', '2021-02-21 02:02:48'),
(27, 28, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', '2021-06-19 21:05:27', '2021-06-19 21:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_date` date NOT NULL,
  `case_Id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'waiting',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `session_date`, `case_Id`, `parent_id`, `month`, `year`, `status`, `created_at`, `updated_at`) VALUES
(1, '2021-04-25', 1, 1, '04', '2021', 'Yes', '2020-08-28 10:12:57', '2021-05-19 23:58:35'),
(2, '2020-09-21', 2, 1, '09', '2020', 'No', '2020-09-21 14:17:24', '2020-09-21 14:17:24'),
(3, '2020-10-01', 3, 1, '10', '2020', 'No', '2020-10-01 17:37:07', '2020-10-01 17:37:07'),
(4, '2020-09-30', 4, 1, '09', '2020', 'No', '2020-10-01 17:42:42', '2020-10-01 17:42:42'),
(5, '2020-09-29', 5, 1, '09', '2020', 'No', '2020-10-01 17:47:35', '2020-10-01 17:47:35'),
(6, '2020-09-29', 6, 1, '09', '2020', 'No', '2020-10-01 17:47:51', '2020-10-01 17:47:51'),
(7, '2020-09-29', 7, 1, '09', '2020', 'No', '2020-10-01 17:56:55', '2020-10-01 17:56:55'),
(9, '2020-09-29', 9, 1, '09', '2020', 'No', '2020-10-01 18:04:19', '2020-10-01 18:04:19'),
(10, '2020-10-06', 10, 1, '10', '2020', 'No', '2020-10-01 18:10:49', '2020-10-01 18:10:49'),
(11, '2020-10-01', 11, 1, '10', '2020', 'No', '2020-10-01 18:14:14', '2020-10-01 18:14:14'),
(12, '2020-10-15', 12, 1, '10', '2020', 'No', '2020-10-01 18:21:04', '2020-10-01 18:21:04'),
(13, '2020-10-14', 13, 1, '10', '2020', 'No', '2020-10-01 18:22:06', '2020-10-01 18:22:06'),
(14, '2020-10-19', 14, 1, '10', '2020', 'No', '2020-10-01 18:24:51', '2020-10-01 18:24:51'),
(15, '2020-10-14', 15, 1, '10', '2020', 'No', '2020-10-01 18:30:37', '2020-10-01 18:30:37'),
(16, '2020-10-19', 16, 1, '10', '2020', 'No', '2020-10-01 18:31:04', '2020-10-01 18:31:04'),
(19, '2020-10-06', 1, 1, '10', '2020', 'Yes', '2020-10-10 15:38:42', '2020-11-12 18:27:13'),
(21, '2020-09-29', 1, 1, '09', '2020', 'Yes', '2020-10-11 20:48:36', '2020-11-12 18:28:07'),
(22, '2020-09-23', 1, 1, '09', '2020', 'Yes', '2020-10-11 20:51:30', '2020-11-16 20:44:37'),
(23, '2020-10-11', 1, 1, '10', '2020', 'Yes', '2020-10-11 20:51:48', '2021-05-19 23:58:36'),
(25, '2020-11-03', 1, 1, '11', '2020', 'Yes', '2020-11-12 18:27:41', '2020-11-16 21:46:02'),
(27, '2020-07-23', 17, 1, '07', '2020', 'No', '2020-11-23 00:41:20', '2020-11-23 00:41:20'),
(28, '2020-07-23', 18, 1, '07', '2020', 'No', '2020-11-23 01:17:55', '2020-11-23 01:17:55'),
(29, '2021-07-07', 19, 1, '07', '2021', 'No', '2021-04-27 02:55:57', '2021-04-27 02:55:57'),
(30, '2021-07-07', 20, 1, '07', '2021', 'No', '2021-04-27 02:56:47', '2021-04-27 02:56:47'),
(31, '2021-04-26', 21, 1, '04', '2021', 'Yes', '2021-04-27 03:08:12', '2021-06-13 06:30:34'),
(32, '2021-04-26', 22, 1, '04', '2021', 'No', '2021-04-27 03:14:50', '2021-04-27 03:14:50'),
(33, '2021-04-26', 23, 1, '04', '2021', 'No', '2021-04-27 03:26:05', '2021-04-27 03:26:05'),
(34, '2021-04-26', 24, 1, '04', '2021', 'No', '2021-04-27 03:28:03', '2021-04-27 03:28:03'),
(35, '2021-04-27', 25, 1, '04', '2021', 'No', '2021-04-28 04:23:59', '2021-04-28 04:23:59'),
(36, '2021-04-27', 26, 1, '04', '2021', 'No', '2021-04-28 04:25:41', '2021-04-28 04:25:41'),
(37, '2021-04-27', 27, 1, '04', '2021', 'No', '2021-04-28 04:28:37', '2021-04-28 04:28:37'),
(38, '2021-04-28', 28, 1, '04', '2021', 'No', '2021-04-29 03:47:23', '2021-04-29 03:47:23'),
(39, '2021-04-26', 20, 1, '01', '1970', 'No', '2021-06-15 04:43:32', '2021-06-15 04:43:32'),
(40, '2021-06-14', 1, 1, '06', '2021', 'No', '2021-06-15 05:11:32', '2021-06-15 05:11:32'),
(41, '2021-06-15', 1, 1, '06', '2021', 'No', '2021-06-15 05:13:05', '2021-06-15 05:13:05'),
(42, '2021-06-16', 1, 1, '06', '2021', 'No', '2021-06-15 05:23:01', '2021-06-15 05:23:01'),
(43, '2021-06-30', 1, 1, '06', '2021', 'No', '2021-06-15 05:30:30', '2021-06-15 05:30:30'),
(44, '2021-06-27', 1, 1, '06', '2021', 'No', '2021-06-15 05:30:52', '2021-06-15 05:34:15'),
(45, '2021-06-22', 1, 1, '06', '2021', 'No', '2021-06-15 06:01:47', '2021-06-17 05:37:07'),
(46, '2021-06-04', 1, 1, '06', '2021', 'No', '2021-06-17 05:42:37', '2021-06-17 05:42:37'),
(47, '2021-06-01', 1, 1, '06', '2021', 'No', '2021-06-17 05:48:37', '2021-06-17 05:52:01'),
(48, '2021-06-08', 29, 1, '06', '2021', 'No', '2021-06-19 23:48:20', '2021-06-19 23:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `session__notes`
--

CREATE TABLE `session__notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_Id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'لا',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `session__notes`
--

INSERT INTO `session__notes` (`id`, `note`, `session_Id`, `parent_id`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
(7, 'notr', 22, 1, NULL, 'No', '2020-11-16 20:50:35', '2020-11-16 20:50:35'),
(8, '.s,,mcsa', 2, 1, NULL, 'No', '2020-11-29 07:56:21', '2020-11-29 07:56:21'),
(12, 'ملاحظه تجريبيه 2021', 30, 1, NULL, 'No', '2021-06-19 06:22:27', '2021-06-19 06:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','Deactive','Demo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `cat_id`, `package_id`, `parent_id`, `password`, `api_token`, `name`, `phone`, `address`, `type`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', NULL, 2, 1, NULL, '$2y$10$MhZXXgZipzVXZn/wiH7lW.eR/aJb1PyjMBDqLwFdldeUMkofB6iBG', 'aDFjiUovCpGWExmTwvD8tDWE2BxVcne0GqdkRTR2QBZgW1ufDlPyGmzIWONa', 'mostafa bezra', '0109624443', 'zag', 'admin', 'img_1613081977.png', 'Active', NULL, '2020-10-09 10:03:56', '2021-07-09 18:41:19'),
(11, 'hany@gmail.com', NULL, 6, 1, 1, '$2y$10$IiX23NuTQrbJlHlfvvXfHO1RqjlJuo4/CkShXwB0gftAZAfjXCFQe', NULL, 'hany', '0111111', 'egypt4', 'User', NULL, 'Active', NULL, '2020-11-16 21:38:53', '2020-12-04 15:34:20'),
(13, 'user15@gmail.com', NULL, 6, 1, 1, '$2y$10$LIurxn.VJhtiBwlt8MA/ne20tksmrn7r9VIerClWlf//mgtHj7Gsu', NULL, 'user15', '0111111515', 'egypt', 'User', NULL, 'Active', NULL, '2020-11-21 13:02:11', '2020-12-04 16:35:06'),
(16, 'userApi@user.com', NULL, 2, 1, 1, '$2y$10$UxTndeKxwMt6lmc2r8NAa.6mhy9GdCQaJV8uHd1qBqsG5B6zTpZhO', NULL, 'userApi', '0100000000', 'egy', 'User', NULL, 'Active', NULL, '2020-12-04 16:25:47', '2020-12-04 16:25:47'),
(18, 'mostafaelebzary@gmail.com', NULL, 2, 1, 1, '$2y$10$d6Yw6gjiDkny2NogIJCDKOeWzZVriOWGr0dprorRqyC2e2W/j1clO', NULL, 'test update', '01095187616', '15Th disrict', 'admin', 'img_1616615974.jpeg', 'Active', NULL, '2021-02-06 23:45:13', '2021-03-25 04:59:34'),
(20, 'melnagar271@gmail.com', NULL, 2, 1, 1, '$2y$10$Tfth5DeOoU2RPX7ZHrby0.x3tK5vH3r6.383vDCFT1kDrL8TqaAM6', NULL, 'mostafa elnagar', '01030407100', 'El Beheira', 'admin', NULL, 'Active', NULL, '2021-02-16 06:22:11', '2021-02-16 06:22:11'),
(21, 'eslam@gmail.com', NULL, 2, 1, 1, '$2y$10$2uoFOYSNddE0o0L5vnJOM.d8Ej2.kDbURiSYynb1v3MIlSw3fSwmW', NULL, 'eslam', '1002512011', 'zagazig', 'admin', NULL, 'Active', NULL, '2021-02-16 06:28:10', '2021-02-16 06:28:10'),
(24, 'hamed.higazy@yahoo.com', NULL, 2, 1, 1, '$2y$10$U8qWMM9K6FFrG0Jzu5MhAuOfyOzIOuArngYn45TbwNINk0McgNzQi', NULL, 'El Beheira', '28888', 'El Beheira for sale', 'User', NULL, 'Active', NULL, '2021-02-21 00:12:33', '2021-02-21 00:14:49'),
(25, 'hamed.higagggzy@yahoo.com', NULL, 2, 1, 1, '$2y$10$35.CHdMHGVo3srV0fAC8wuWYhezv8xxZm6fvku6a0eCKMMTx6s6Sq', NULL, 'fff', '8845', 'fvf fvf', 'admin', NULL, 'Active', NULL, '2021-02-21 01:41:47', '2021-02-21 01:41:47'),
(26, 'userAp@user.comh', NULL, 2, 1, 1, '$2y$10$OVtnyCJ7bwscfqRYNRUwheL/QgT0E6jnGN56CAqK5kUIHS4w8qYea', NULL, 'userApi', '010000000022', 'egy', 'User', NULL, 'Active', NULL, '2021-02-21 01:57:34', '2021-02-21 02:01:37'),
(27, 'El@g.con', NULL, 6, 1, 1, '$2y$10$0qjAWbpnfF6Ez7dEbhjEtuRw.eFhCuPmZjeyxHKaWHKD8XGyZ0zkq', NULL, 'tttttt', '5888', 'rgvfvffv', 'User', NULL, 'Active', NULL, '2021-02-21 02:02:48', '2021-02-21 02:03:04'),
(28, 'osamas@gmail.com', NULL, 8, 1, 1, '$2y$10$8Eitd.LAgD8BOB4hs9BdF.PNM2YiGtO2ZJhWQhYNXTbQ7mJwcD8GO', NULL, 'تست', '86989868', 'رتبتتبتبتر', 'User', NULL, 'Active', NULL, '2021-06-19 21:05:27', '2021-06-19 21:05:50'),
(29, 'manager@manager.com', NULL, 9, 2, NULL, '$2y$10$MhZXXgZipzVXZn/wiH7lW.eR/aJb1PyjMBDqLwFdldeUMkofB6iBG', 'aDFjiUovCpGWExmTwvD8tDWE2BxVcne0GqdkRTR2QBZgW1ufDlPyGmzIWONa', 'manager', '010951876166', 'zag', 'manager', 'img_1613081977.png', 'Active', NULL, '2020-10-09 10:03:56', '2021-07-09 18:41:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachments_case_id_foreign` (`case_Id`),
  ADD KEY `attachments_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cases_parent_id_foreign` (`parent_id`),
  ADD KEY `cases_to_whome_foreign` (`to_whome`);

--
-- Indexes for table `case_clients`
--
ALTER TABLE `case_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_clients_case_id_foreign` (`case_id`),
  ADD KEY `case_clients_client_id_foreign` (`client_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_cat_id_foreign` (`cat_id`),
  ADD KEY `clients_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `client_attachments`
--
ALTER TABLE `client_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_attachments_client_id_foreign` (`client_Id`),
  ADD KEY `client_attachments_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `client__notes`
--
ALTER TABLE `client__notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client__notes_client_id_foreign` (`client_id`),
  ADD KEY `client__notes_user_id_foreign` (`user_id`),
  ADD KEY `client__notes_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_pass_resets`
--
ALTER TABLE `manual_pass_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mohdrs`
--
ALTER TABLE `mohdrs`
  ADD PRIMARY KEY (`moh_Id`),
  ADD KEY `mohdrs_parent_id_foreign` (`parent_id`),
  ADD KEY `mohdrs_cat_id_foreign` (`cat_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_case_id_foreign` (`case_Id`),
  ADD KEY `sessions_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `session__notes`
--
ALTER TABLE `session__notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session__notes_session_id_foreign` (`session_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_cat_id_foreign` (`cat_id`),
  ADD KEY `users_package_id_foreign` (`package_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `case_clients`
--
ALTER TABLE `case_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `client_attachments`
--
ALTER TABLE `client_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client__notes`
--
ALTER TABLE `client__notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manual_pass_resets`
--
ALTER TABLE `manual_pass_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `mohdrs`
--
ALTER TABLE `mohdrs`
  MODIFY `moh_Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `session__notes`
--
ALTER TABLE `session__notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_case_id_foreign` FOREIGN KEY (`case_Id`) REFERENCES `cases` (`id`),
  ADD CONSTRAINT `attachments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cases`
--
ALTER TABLE `cases`
  ADD CONSTRAINT `cases_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cases_to_whome_foreign` FOREIGN KEY (`to_whome`) REFERENCES `categories` (`id`);

--
-- Constraints for table `case_clients`
--
ALTER TABLE `case_clients`
  ADD CONSTRAINT `case_clients_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `cases` (`id`),
  ADD CONSTRAINT `case_clients_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clients_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client_attachments`
--
ALTER TABLE `client_attachments`
  ADD CONSTRAINT `client_attachments_client_id_foreign` FOREIGN KEY (`client_Id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_attachments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client__notes`
--
ALTER TABLE `client__notes`
  ADD CONSTRAINT `client__notes_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client__notes_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client__notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mohdrs`
--
ALTER TABLE `mohdrs`
  ADD CONSTRAINT `mohdrs_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `mohdrs_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_case_id_foreign` FOREIGN KEY (`case_Id`) REFERENCES `cases` (`id`),
  ADD CONSTRAINT `sessions_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `session__notes`
--
ALTER TABLE `session__notes`
  ADD CONSTRAINT `session__notes_session_id_foreign` FOREIGN KEY (`session_Id`) REFERENCES `sessions` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `users_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
