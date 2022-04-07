-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2020 at 08:28 AM
-- Server version: 5.7.30
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alstore_soft_account`
--

-- --------------------------------------------------------

--
-- Table structure for table `addtaxnames`
--

CREATE TABLE `addtaxnames` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addtaxs`
--

CREATE TABLE `addtaxs` (
  `id` int(10) UNSIGNED NOT NULL,
  `bill_id` int(11) NOT NULL,
  `addtaxnames_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `Seller_id` int(11) DEFAULT '0',
  `active` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `suppliers_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manager_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position_manger` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suppliers_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usertype_id` int(10) UNSIGNED DEFAULT NULL,
  `city` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `role_id`, `Seller_id`, `active`, `created_at`, `updated_at`, `phone`, `mobile`, `country_id`, `suppliers_name`, `manager_name`, `position_manger`, `suppliers_number`, `name_company`, `name_client`, `client_position`, `notes`, `usertype_id`, `city`) VALUES
(1, 'Admin', 'demo@perfect.com', '$2y$10$L0nq1vckWhqhVlSaegNTk.FIUQ7/KGEj9rQ9CH8WMDmSznxtoPt/G', 'xF82ZhaQBbLy7nq6kYZyiJ29KGwHOBsrdAOoKUiy3covt7mlxxrH2K9wMPcN', 1, 5, 1, '2018-04-03 20:08:11', '2019-11-17 13:47:00', '', '', 0, '', '', '', '', '', '', '', '', 1, ''),
(2, 'مريم', 'mareem1234@gmail.com', '$2y$10$rFSQ0Dr9S8F.n/5sLxj4mu4VAAQf8IbihRud1mKjNQrc5ggq4TYE6', NULL, 5, 0, 1, '2020-03-25 10:11:42', '2020-03-25 10:11:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'احمد', 'asdfgh@g.com', '$2y$10$poRASJNxs5FljXnc93Jke.dvVPVZWxnpo756NimbVjioBa8tPVS/a', NULL, 5, 0, 1, '2020-03-26 08:16:25', '2020-03-26 08:16:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'حسين', 'huseenapaas@gmail.com', '$2y$10$d3YEMPS7JJSsd63pFOZF7eveirLWXAjpKsKxOw/cCplgQKOoLk2hu', NULL, 6, 0, 1, '2020-03-26 08:17:25', '2020-03-26 08:17:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'محمد', 'mhamwwd123@gmail.com', '$2y$10$3QBqicZ0/DQ7v69fMM8BHuiOzaNl9rNmrQEOHyqnnu0NaZAUd55UG', NULL, 7, 0, 1, '2020-03-26 08:23:53', '2020-03-26 08:23:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'toto', 'toot12342@gmail.com', '$2y$10$c6lv5d8DbG9pnbYuwTgIneA.5orqqyyG9OaTOKdU2QI97er2QgiE6', NULL, 1, 0, 1, '2020-05-19 15:21:29', '2020-05-19 15:21:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'السوق التركي', 'laith.ff@bk.ru', '$2y$10$YLC8EOd4xAKtgi4YcpzGBeJgJIfhwm68E0/x8kPWQJ1BYZWwZ2WnS', NULL, 1, 6, 1, '2020-06-02 05:43:12', '2020-06-02 05:43:12', '07735935433', '07735935433', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(36, 'الحبيب', 'nooon.n3on@gmail.com', '$2y$10$.JwCDxnrHngJv/rkbyCVnOtEWFV/lEoCD2KgwQXk/DU/LncP9rLjq', NULL, 1, 5, 1, '2020-06-02 05:43:48', '2020-06-02 05:43:48', '07905664460', '07905664460', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(37, 'شموسة للتسوق الألكتروني', 'saifali2001@gmail.com', '$2y$10$BboPBsmU9ZbjvLCvCsLX4.U8MTIQHliFGf0OhK5ZwcUlsx7uASkAK', NULL, 1, 0, 1, '2020-06-02 05:43:52', '2020-06-02 05:43:52', '07702520149', '07702520149', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(38, 'نادر', 'zx07702973370@gmail.com', '$2y$10$hB6xYDJ6tNPhtO9OuM/yWOcS5q9/.ZAQ7sB1IEdpZpvcOZqKe1UXq', 'LsQFxBeStlg8W6XhkyvvFiU9Cd6Oj8ZAkVUGGtOCGpnItL5tLBTgD6hVzJtB', 1, 27, 1, '2020-06-04 22:15:19', '2020-06-04 22:15:19', '07702973370', '07702973370', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(39, 'alnawares store', 'info@alnawaresstore.com', '$2y$10$HondYgAT8n4eitBJHdWnjui2EALDFtYU2tq/X9wreo0f41Hh3F5Jm', 'KFHj6sJpRssEA99KxLV0xW0ZO70BSzTmWX315zRxcIpUM215rXzjA01vvEeE', 1, 1757, 1, '2020-06-04 22:27:38', '2020-06-04 22:27:38', '1111', '111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(40, 'perfect', 'info@perfect.com', '$2y$10$n/xafxntC21vinH7LTDvfOYOmWYyX2EAen1d4NTCr0SbiUROh18.2', 'PhNsHzWJdhWhpfmdmEI6HTiCZTaFWMYJHno4Dj2mqgPCII6g5uqgFi7d0YjW', 1, 1758, 1, '2020-06-05 00:52:54', '2020-06-05 00:52:54', '555222', '111111555555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `allowroles`
--

CREATE TABLE `allowroles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `allow` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `allowroles`
--

INSERT INTO `allowroles` (`id`, `role_id`, `allow`, `created_at`, `updated_at`) VALUES
(876, '1', '1', NULL, NULL),
(877, '1', '2', NULL, NULL),
(878, '1', '3', NULL, NULL),
(879, '1', '4', NULL, NULL),
(880, '1', '5', NULL, NULL),
(881, '1', '6', NULL, NULL),
(882, '1', '7', NULL, NULL),
(883, '1', '8', NULL, NULL),
(884, '1', '9', NULL, NULL),
(885, '1', '10', NULL, NULL),
(886, '1', '11', NULL, NULL),
(887, '1', '12', NULL, NULL),
(888, '1', '13', NULL, NULL),
(889, '1', '14', NULL, NULL),
(890, '1', '15', NULL, NULL),
(891, '1', '16', NULL, NULL),
(892, '1', '17', NULL, NULL),
(893, '1', '18', NULL, NULL),
(894, '1', '19', NULL, NULL),
(895, '1', '54', NULL, NULL),
(896, '1', '55', NULL, NULL),
(897, '1', '56', NULL, NULL),
(898, '1', '57', NULL, NULL),
(899, '1', '20', NULL, NULL),
(900, '1', '21', NULL, NULL),
(901, '1', '22', NULL, NULL),
(902, '1', '23', NULL, NULL),
(903, '1', '24', NULL, NULL),
(904, '1', '25', NULL, NULL),
(905, '1', '59', NULL, NULL),
(906, '1', '60', NULL, NULL),
(907, '1', '61', NULL, NULL),
(908, '1', '62', NULL, NULL),
(909, '1', '26', NULL, NULL),
(910, '1', '27', NULL, NULL),
(911, '1', '28', NULL, NULL),
(912, '1', '29', NULL, NULL),
(913, '1', '30', NULL, NULL),
(914, '1', '31', NULL, NULL),
(915, '1', '32', NULL, NULL),
(916, '1', '33', NULL, NULL),
(917, '1', '64', NULL, NULL),
(918, '1', '65', NULL, NULL),
(919, '1', '66', NULL, NULL),
(920, '1', '67', NULL, NULL),
(921, '1', '69', NULL, NULL),
(922, '1', '70', NULL, NULL),
(923, '1', '71', NULL, NULL),
(924, '1', '72', NULL, NULL),
(925, '1', '34', NULL, NULL),
(926, '1', '35', NULL, NULL),
(927, '1', '36', NULL, NULL),
(928, '1', '37', NULL, NULL),
(929, '1', '38', NULL, NULL),
(930, '1', '39', NULL, NULL),
(931, '1', '40', NULL, NULL),
(932, '1', '74', NULL, NULL),
(933, '1', '75', NULL, NULL),
(934, '1', '76', NULL, NULL),
(935, '1', '77', NULL, NULL),
(936, '1', '79', NULL, NULL),
(937, '1', '80', NULL, NULL),
(938, '1', '81', NULL, NULL),
(939, '1', '82', NULL, NULL),
(940, '1', '41', NULL, NULL),
(941, '1', '42', NULL, NULL),
(942, '1', '43', NULL, NULL),
(943, '1', '44', NULL, NULL),
(944, '1', '45', NULL, NULL),
(945, '1', '48', NULL, NULL),
(946, '1', '85', NULL, NULL),
(947, '1', '86', NULL, NULL),
(948, '1', '87', NULL, NULL),
(949, '1', '88', NULL, NULL),
(950, '1', '89', NULL, NULL),
(951, '1', '90', NULL, NULL),
(952, '1', '91', NULL, NULL),
(953, '1', '49', NULL, NULL),
(954, '1', '50', NULL, NULL),
(955, '1', '51', NULL, NULL),
(956, '1', '52', NULL, NULL),
(957, '1', '53', NULL, NULL),
(958, '1', '95', NULL, NULL),
(959, '1', '96', NULL, NULL),
(960, '1', '97', NULL, NULL),
(961, '1', '98', NULL, NULL),
(962, '1', '99', NULL, NULL),
(963, '1', '100', NULL, NULL),
(964, '1', '101', NULL, NULL),
(965, '1', '102', NULL, NULL),
(966, '1', '103', NULL, NULL),
(967, '1', '104', NULL, NULL),
(968, '1', '105', NULL, NULL),
(969, '1', '106', NULL, NULL),
(970, '1', '107', NULL, NULL),
(971, '1', '108', NULL, NULL),
(972, '1', '109', NULL, NULL),
(973, '1', '110', NULL, NULL),
(974, '1', '111', NULL, NULL),
(1129, '4', '7', NULL, NULL),
(1130, '4', '9', NULL, NULL),
(1131, '4', '10', NULL, NULL),
(1132, '4', '11', NULL, NULL),
(1133, '4', '12', NULL, NULL),
(1134, '4', '20', NULL, NULL),
(1135, '4', '21', NULL, NULL),
(1136, '4', '23', NULL, NULL),
(1137, '4', '59', NULL, NULL),
(1138, '4', '69', NULL, NULL),
(1139, '4', '49', NULL, NULL),
(1140, '4', '50', NULL, NULL),
(1141, '4', '51', NULL, NULL),
(1142, '4', '52', NULL, NULL),
(1189, '5', '6', NULL, NULL),
(1190, '5', '7', NULL, NULL),
(1191, '5', '8', NULL, NULL),
(1192, '5', '74', NULL, NULL),
(1193, '5', '75', NULL, NULL),
(1194, '5', '76', NULL, NULL),
(1195, '5', '79', NULL, NULL),
(1196, '5', '80', NULL, NULL),
(1197, '5', '81', NULL, NULL),
(1198, '6', '49', NULL, NULL),
(1199, '6', '50', NULL, NULL),
(1200, '6', '51', NULL, NULL),
(1201, '6', '52', NULL, NULL),
(1202, '7', '1', NULL, NULL),
(1203, '7', '2', NULL, NULL),
(1204, '7', '20', NULL, NULL),
(1205, '7', '24', NULL, NULL),
(1206, '7', '59', NULL, NULL),
(1207, '7', '74', NULL, NULL),
(1208, '8', '34', NULL, NULL),
(1209, '8', '35', NULL, NULL),
(1210, '8', '36', NULL, NULL),
(1211, '8', '37', NULL, NULL),
(1212, '8', '38', NULL, NULL),
(1213, '8', '39', NULL, NULL),
(1214, '8', '74', NULL, NULL),
(1215, '8', '75', NULL, NULL),
(1216, '8', '76', NULL, NULL),
(1217, '8', '100', NULL, NULL),
(1218, '8', '101', NULL, NULL),
(1219, '8', '102', NULL, NULL),
(1220, '9', '35', NULL, NULL),
(1221, '9', '36', NULL, NULL),
(1222, '9', '37', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banktransfers`
--

CREATE TABLE `banktransfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` longtext COLLATE utf8_unicode_ci,
  `import_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billdevicesitems`
--

CREATE TABLE `billdevicesitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `bill_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id_devices` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity_devices` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity_old` double DEFAULT NULL,
  `price_devices` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_devices` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_devices_egy` double DEFAULT NULL,
  `total_devices_egy` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billdevies`
--

CREATE TABLE `billdevies` (
  `id` int(10) UNSIGNED NOT NULL,
  `bill_id` int(11) NOT NULL,
  `device_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price_egy` double(16,2) DEFAULT NULL,
  `onedevices` double(16,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `onedevices_egy` double DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billitems`
--

CREATE TABLE `billitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `bill_id` int(10) UNSIGNED DEFAULT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity_b` double DEFAULT NULL,
  `price_b` double DEFAULT NULL,
  `total_price_b` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price_b_egy` double(16,2) DEFAULT NULL,
  `total_price_b_egy` double(16,2) DEFAULT NULL,
  `size` int(10) DEFAULT NULL,
  `color` int(11) DEFAULT NULL,
  `afterdiscount` int(11) DEFAULT NULL,
  `shipping_costs` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `billitems`
--

INSERT INTO `billitems` (`id`, `bill_id`, `item_id`, `quantity_b`, `price_b`, `total_price_b`, `created_at`, `updated_at`, `price_b_egy`, `total_price_b_egy`, `size`, `color`, `afterdiscount`, `shipping_costs`) VALUES
(1, 1, 1, 15, 45000, 675000, '2020-06-05 03:16:12', '2020-06-05 03:16:12', 0.00, 675000.00, 2, 2, NULL, NULL),
(2, 2, 5, 10, 45000, 450000, '2020-06-05 04:29:43', '2020-06-05 04:29:43', 0.00, 450000.00, 2, 2, NULL, NULL),
(3, 3, 2, 10, 10, 100, '2020-06-05 04:42:09', '2020-06-05 04:42:09', 0.00, 100.00, 4, 4, NULL, NULL),
(4, 4, 2, 10, 10, 100, '2020-06-05 14:06:01', '2020-06-05 14:06:01', 0.00, 100.00, 4, 4, NULL, NULL),
(5, 4, 2, NULL, 0, 0, '2020-06-05 14:06:01', '2020-06-05 14:06:01', 0.00, 100.00, 4, 4, NULL, NULL),
(6, 4, 3, 10, 10, 100, '2020-06-05 14:06:01', '2020-06-05 14:06:01', 0.00, 0.00, 4, 4, NULL, NULL),
(7, 4, 3, NULL, 0, 0, '2020-06-05 14:06:01', '2020-06-05 14:06:01', 0.00, 0.00, 4, 4, NULL, NULL),
(8, 5, 2, 10, 10, 100, '2020-06-05 14:07:43', '2020-06-05 14:07:43', 0.00, 100.00, 4, 4, NULL, NULL),
(9, 5, 2, NULL, 0, 0, '2020-06-05 14:07:43', '2020-06-05 14:07:43', 0.00, 100.00, 4, 4, NULL, NULL),
(10, 5, 3, 10, 10, 100, '2020-06-05 14:07:43', '2020-06-05 14:07:43', 0.00, 0.00, 4, 4, NULL, NULL),
(11, 5, 3, NULL, 0, 0, '2020-06-05 14:07:43', '2020-06-05 14:07:43', 0.00, 0.00, 4, 4, NULL, NULL),
(12, 6, 2, 10, 10, 100, '2020-06-05 14:07:58', '2020-06-05 14:07:58', 0.00, 100.00, 4, 4, NULL, NULL),
(13, 6, 2, NULL, 0, 0, '2020-06-05 14:07:58', '2020-06-05 14:07:58', 0.00, 100.00, 4, 4, NULL, NULL),
(14, 6, 3, 10, 10, 100, '2020-06-05 14:07:58', '2020-06-05 14:07:58', 0.00, 0.00, 4, 4, NULL, NULL),
(15, 6, 3, NULL, 0, 0, '2020-06-05 14:07:58', '2020-06-05 14:07:58', 0.00, 0.00, 4, 4, NULL, NULL),
(16, 7, 2, 10, 10, 100, '2020-06-05 14:08:28', '2020-06-05 14:08:28', 0.00, 100.00, 4, 4, NULL, NULL),
(17, 7, 2, NULL, 0, 0, '2020-06-05 14:08:28', '2020-06-05 14:08:28', 0.00, 100.00, 4, 4, NULL, NULL),
(18, 7, 3, 10, 10, 100, '2020-06-05 14:08:28', '2020-06-05 14:08:28', 0.00, 0.00, 4, 4, NULL, NULL),
(19, 7, 3, NULL, 0, 0, '2020-06-05 14:08:28', '2020-06-05 14:08:28', 0.00, 0.00, 4, 4, NULL, NULL),
(20, 8, 2, 10, 10, 100, '2020-06-05 14:10:20', '2020-06-05 14:10:20', 0.00, 100.00, 4, 4, NULL, NULL),
(21, 8, 2, NULL, 0, 0, '2020-06-05 14:10:20', '2020-06-05 14:10:20', 0.00, 100.00, 4, 4, NULL, NULL),
(22, 8, 3, 10, 10, 100, '2020-06-05 14:10:20', '2020-06-05 14:10:20', 0.00, 0.00, 4, 4, NULL, NULL),
(23, 8, 3, NULL, 0, 0, '2020-06-05 14:10:20', '2020-06-05 14:10:20', 0.00, 0.00, 4, 4, NULL, NULL),
(24, 9, 2, 10, 10, 100, '2020-06-05 14:10:35', '2020-06-05 14:10:35', 0.00, 100.00, 4, 4, NULL, NULL),
(25, 9, 2, NULL, 0, 0, '2020-06-05 14:10:35', '2020-06-05 14:10:35', 0.00, 100.00, 4, 4, NULL, NULL),
(26, 9, 3, 10, 10, 100, '2020-06-05 14:10:35', '2020-06-05 14:10:35', 0.00, 0.00, 4, 4, NULL, NULL),
(27, 9, 3, NULL, 0, 0, '2020-06-05 14:10:35', '2020-06-05 14:10:35', 0.00, 0.00, 4, 4, NULL, NULL),
(28, 10, 2, 10, 10, 100, '2020-06-05 14:18:40', '2020-06-05 14:18:40', 0.00, 100.00, 4, 4, NULL, NULL),
(29, 10, 2, NULL, 0, 0, '2020-06-05 14:18:40', '2020-06-05 14:18:40', 0.00, 100.00, 4, 4, NULL, NULL),
(30, 10, 3, 10, 10, 100, '2020-06-05 14:18:40', '2020-06-05 14:18:40', 0.00, 0.00, 4, 4, NULL, NULL),
(31, 10, 3, NULL, 0, 0, '2020-06-05 14:18:40', '2020-06-05 14:18:40', 0.00, 0.00, 4, 4, NULL, NULL),
(32, 11, 2, 50, 50, 2500, '2020-06-05 14:41:09', '2020-06-05 14:41:09', 0.00, 2500.00, 4, 4, NULL, NULL),
(33, 11, 3, 50, 50, 2500, '2020-06-05 14:41:09', '2020-06-05 14:41:09', 0.00, 0.00, 4, 4, NULL, NULL),
(34, 15, 2, 10, 10, 100, '2020-06-05 14:52:01', '2020-06-05 14:52:01', 0.00, 1.00, 4, 4, NULL, NULL),
(35, 15, 3, 40, 40, 1600, '2020-06-05 14:52:01', '2020-06-05 14:52:01', 0.00, 0.00, 4, 4, NULL, NULL),
(39, 19, 2, 10, 10, 100, '2020-06-05 15:09:30', '2020-06-05 15:09:30', 0.00, 100.00, 4, 4, NULL, NULL),
(40, 20, 18, 10, 10, 100, '2020-06-05 17:54:08', '2020-06-05 17:54:08', 0.00, 100.00, 4, 4, NULL, NULL),
(41, 20, 18, 10, 10, 100, '2020-06-05 17:54:08', '2020-06-05 17:54:08', 0.00, 0.00, 6, 6, NULL, NULL),
(42, 21, 19, 10, 10, 100, '2020-06-05 17:56:57', '2020-06-05 17:56:57', 0.00, 100.00, 5, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `bill_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_before_doller` double(16,2) DEFAULT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `currency_id` int(10) UNSIGNED DEFAULT NULL,
  `total_final_mgza` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_final_mogma3` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_final_bill` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_final_bill_egy` double DEFAULT NULL,
  `total_shipments` double DEFAULT NULL,
  `total_addtaxs` double(16,2) DEFAULT NULL,
  `savedraft` tinyint(1) DEFAULT NULL,
  `pdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flag` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_final_mgza_egy` double DEFAULT '0',
  `total_final_mogma3_egy` double DEFAULT '0',
  `total_shipments_egy` double DEFAULT '0',
  `total_addtaxs_egy` double DEFAULT '0',
  `barcode` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_costs` int(11) DEFAULT NULL,
  `afterdiscount` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `Seller_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `bill_number`, `date`, `notes`, `price_before_doller`, `supplier_id`, `currency_id`, `total_final_mgza`, `total_final_mogma3`, `total_final_bill`, `total_final_bill_egy`, `total_shipments`, `total_addtaxs`, `savedraft`, `pdf`, `flag`, `created_at`, `updated_at`, `total_final_mgza_egy`, `total_final_mogma3_egy`, `total_shipments_egy`, `total_addtaxs_egy`, `barcode`, `shipping_costs`, `afterdiscount`, `discount`, `user_id`, `Seller_id`) VALUES
(1, NULL, '2020-06-04', NULL, 0.00, 31, NULL, '675000', '0', '675000', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 03:16:12', '2020-06-05 03:16:12', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 675000, NULL, NULL, 1757),
(2, NULL, '2020-06-04', NULL, 0.00, 31, NULL, '450000', '0', '450000', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 04:29:43', '2020-06-05 04:29:43', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 450000, NULL, NULL, 1757),
(3, NULL, '2020-06-04', NULL, 0.00, 32, NULL, '100', '0', '100', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 04:42:09', '2020-06-05 04:42:09', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 100, NULL, NULL, 1758),
(4, NULL, '2020-06-05', NULL, 0.00, 32, NULL, '500', '0', '500', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 14:06:01', '2020-06-05 14:06:01', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 500, NULL, NULL, 1758),
(5, NULL, '2020-06-05', NULL, 0.00, 32, NULL, '500', '0', '500', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 14:07:43', '2020-06-05 14:07:43', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 500, NULL, NULL, 1758),
(6, NULL, '2020-06-05', NULL, 0.00, 32, NULL, '500', '0', '500', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 14:07:58', '2020-06-05 14:07:58', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 500, NULL, NULL, 1758),
(7, NULL, '2020-06-05', NULL, 0.00, 32, NULL, '500', '0', '500', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 14:08:28', '2020-06-05 14:08:28', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 500, NULL, NULL, 1758),
(8, NULL, '2020-06-05', NULL, 0.00, 32, NULL, '500', '0', '500', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 14:10:20', '2020-06-05 14:10:20', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 500, NULL, NULL, 1758),
(9, NULL, '2020-06-05', NULL, 0.00, 32, NULL, '500', '0', '500', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 14:10:35', '2020-06-05 14:10:35', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 500, NULL, NULL, 1758),
(10, NULL, '2020-06-05', NULL, 0.00, 32, NULL, '500', '0', '500', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 14:18:40', '2020-06-05 14:18:40', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 500, NULL, NULL, 1758),
(11, NULL, '2020-06-05', NULL, 0.00, 32, NULL, '5000', '0', '5000', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 14:41:09', '2020-06-05 14:41:09', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 5000, NULL, NULL, 1758),
(12, NULL, '2020-06-05', '1010', 0.00, 32, NULL, '500', '0', '500', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 14:46:07', '2020-06-05 14:46:07', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 500, NULL, NULL, 1758),
(13, NULL, '2020-06-05', '0000', 0.00, 32, NULL, '1700', '0', '1700', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 14:49:19', '2020-06-05 14:49:19', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 1700, NULL, NULL, 1758),
(14, NULL, '2020-06-05', '0000', 0.00, 32, NULL, '1700', '0', '1700', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 14:50:35', '2020-06-05 14:50:35', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 1700, NULL, NULL, 1758),
(15, NULL, '2020-06-05', '0000', 0.00, 32, NULL, '1700', '0', '1700', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 14:52:01', '2020-06-05 14:52:01', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 1700, NULL, NULL, 1758),
(19, NULL, '2020-06-05', NULL, 0.00, 32, NULL, '100', '0', '100', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 15:06:40', '2020-06-05 15:09:42', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 100, NULL, NULL, 1758),
(20, NULL, '2020-06-05', 'qweqwe', 0.00, 32, NULL, '200', '0', '200', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 17:54:08', '2020-06-05 17:54:08', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 200, NULL, NULL, 1758),
(21, NULL, '2020-06-05', NULL, 0.00, 32, NULL, '100', '0', '100', 0, NULL, NULL, 1, NULL, 0, '2020-06-05 17:56:57', '2020-06-05 17:56:57', 0, 0, 0, 0, '9NQj64nZE8.png', NULL, 100, NULL, NULL, 1758);

-- --------------------------------------------------------

--
-- Table structure for table `billspdf`
--

CREATE TABLE `billspdf` (
  `id` int(11) NOT NULL,
  `id_bills` int(10) UNSIGNED DEFAULT NULL,
  `pdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Seller_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catcompanyexpenses`
--

CREATE TABLE `catcompanyexpenses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Seller_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `catcompanyexpenses`
--

INSERT INTO `catcompanyexpenses` (`id`, `title`, `Seller_id`, `created_at`, `updated_at`) VALUES
(1, 'مصاريف ادارية', 0, '2019-11-07 14:27:04', '2019-11-07 14:27:04'),
(2, 'مرتبات', 0, '2019-11-10 07:56:03', '2019-11-10 07:56:03'),
(3, 'مواد تغليف', 0, '2019-11-10 07:56:16', '2019-11-10 07:56:16'),
(4, 'ايجار', 0, '2019-11-10 07:56:31', '2019-11-27 13:45:20'),
(5, 'مصاريف فنية', 0, '2020-03-11 12:39:33', '2020-03-11 12:39:33'),
(6, 'IT', 0, '2020-03-20 08:25:53', '2020-03-20 08:25:53'),
(7, 'رواتب موظفين', 0, '2020-03-30 10:29:19', '2020-03-30 10:29:19'),
(8, 'ترويج', 1, '2020-03-30 10:52:31', '2020-05-11 11:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Seller_id` int(11) DEFAULT '0',
  `details` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `Seller_id`, `details`, `created_at`, `updated_at`) VALUES
(12, 'فساتين', 0, NULL, '2020-03-23 09:13:11', '2020-03-23 09:13:11'),
(14, 'سيروم شعر', 0, NULL, '2020-03-25 10:22:23', '2020-03-25 10:22:23'),
(15, 'ملابس اطفال', 0, NULL, '2020-03-26 08:30:28', '2020-03-26 08:30:28'),
(16, 'احذيه رجاليه', 0, NULL, '2020-03-26 08:30:34', '2020-03-26 08:30:34'),
(17, 'مكياج', 0, NULL, '2020-03-26 08:30:51', '2020-03-26 08:30:51'),
(18, 'عطور', 0, NULL, '2020-03-26 08:32:14', '2020-03-26 08:32:14'),
(19, 'ملابس رجاليه', 0, NULL, '2020-03-27 21:44:33', '2020-03-27 21:44:33'),
(20, 'اثاث', 0, NULL, '2020-03-28 11:48:13', '2020-03-28 11:48:13'),
(22, 'عطر', 0, NULL, '2020-03-30 15:21:54', '2020-03-30 15:21:54'),
(23, 'زيت شعر', 0, NULL, '2020-04-22 06:00:36', '2020-04-22 06:00:36'),
(24, 'ساعات', 0, NULL, '2020-04-28 08:07:08', '2020-04-28 08:07:08'),
(25, 'اجهزه كهربائيه', 0, NULL, '2020-05-12 04:34:13', '2020-05-12 04:34:13'),
(26, 'العاب اطفال', 0, NULL, '2020-05-19 15:29:43', '2020-05-19 15:29:43'),
(27, 'test', 1758, NULL, '2020-06-05 03:47:32', '2020-06-05 03:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Seller_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `shipping` int(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `Seller_id`, `created_at`, `updated_at`, `shipping`) VALUES
(1, 'بغداد', 0, '2020-05-21 13:01:30', '2020-05-21 13:01:30', 0),
(2, 'حلة', 0, '2020-05-21 13:01:30', '2020-05-21 13:01:30', 0),
(3, 'كركوك', 0, '2020-05-21 13:01:30', '2020-05-21 13:01:30', 0),
(4, 'كربلاء', 0, '2020-05-21 13:01:30', '2020-05-21 13:01:30', 0),
(5, 'البصرة', 0, '2020-05-21 13:01:30', '2020-05-21 13:01:30', 0),
(6, 'نجف', 0, '2020-05-21 13:01:30', '2020-05-21 13:01:30', 0),
(7, 'الناصريه', 0, '2020-05-21 13:01:30', '2020-05-21 13:01:30', 0),
(8, 'عماره', 0, '2020-05-21 13:01:30', '2020-05-21 13:01:30', 0),
(9, 'ديوانيه', 0, '2020-05-21 13:01:30', '2020-05-21 13:01:30', 0),
(10, 'كوت', 0, '2020-05-21 13:01:30', '2020-05-21 13:01:30', 0),
(11, 'السماوه', 0, '2020-05-21 13:01:30', '2020-05-21 13:01:30', 0),
(12, 'اربيل', 0, '2020-05-21 13:01:30', '2020-05-21 13:01:30', 0),
(13, 'دهوك', 0, '2020-05-21 13:01:30', '2020-05-21 13:01:30', 0),
(14, 'ديالى', 0, '2020-05-21 13:01:30', '2020-05-21 13:01:30', 0),
(15, 'صلاح الدين', 0, '2020-05-21 13:01:30', '2020-05-21 13:01:30', 0),
(16, 'الانبار', 0, '2020-05-21 13:01:30', '2020-05-21 13:01:30', 0),
(17, 'سليمانيه', 0, '2020-05-21 13:01:30', '2020-05-21 13:01:30', 0),
(18, 'موصل', 0, '2020-05-21 13:10:09', '2020-05-21 13:10:09', 0),
(19, 'test', 0, '2020-05-21 15:10:01', '2020-05-21 13:10:01', 400),
(20, 'فرع بصرة 2', 0, '2020-05-21 13:09:53', '2020-05-21 13:09:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `postalCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_type` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Seller_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name_company`, `name_client`, `city`, `phone`, `mobile`, `client_position`, `notes`, `created_at`, `updated_at`, `postalCode`, `email`, `password`, `country`, `provider_id`, `provider_type`, `Seller_id`) VALUES
(567, NULL, 'Ahmad Emam', '9999', '9', '9', NULL, '9', '2020-05-17 09:16:14', '2020-05-17 09:16:51', NULL, 'a.emam.mspr12@hotmail.com', NULL, NULL, '3003064199749784', 'facebook', 0),
(568, NULL, 'ناريمان عطيه', '19', '919', '9919', NULL, '999', '2020-05-17 10:30:35', '2020-05-17 10:33:39', NULL, 'ilovehack38@gmail.com', NULL, NULL, '1128668537479168', 'facebook', 0),
(569, NULL, 'تغريد', 'بغداد', '07707722843', NULL, NULL, NULL, '2020-05-19 15:23:00', '2020-05-19 15:23:00', NULL, NULL, NULL, NULL, '11', '12', 0),
(570, NULL, 'حيدر الحسني', NULL, NULL, NULL, NULL, NULL, '2020-05-19 16:18:42', '2020-05-19 16:18:42', NULL, NULL, NULL, NULL, '139764300997995', 'facebook', 0),
(571, NULL, 'سرمد سمير', NULL, NULL, NULL, NULL, NULL, '2020-05-19 16:25:50', '2020-05-19 16:25:50', NULL, NULL, NULL, NULL, '124940959203445', 'facebook', 0),
(572, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-05-19 16:48:15', '2020-05-19 16:48:15', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(573, NULL, 'Mohamed Fathy', '1', '1', NULL, NULL, NULL, '2020-05-20 14:15:34', '2020-05-20 14:24:59', NULL, 'mohamedfathy1716@gmail.com', NULL, NULL, '1502227329952147', 'facebook', 0),
(574, NULL, 'Mohamed Fathy', '1', '1', NULL, NULL, NULL, '2020-05-20 14:24:02', '2020-05-20 14:24:59', NULL, 'mohamedfathy1716@gmail.com', NULL, NULL, '1502227329952147', 'facebook', 0),
(575, NULL, 'Mohamed Fathy', '1', '1', NULL, NULL, NULL, '2020-05-20 14:24:29', '2020-05-20 14:24:59', NULL, 'mohamedfathy1716@gmail.com', NULL, NULL, '1502227329952147', 'facebook', 0),
(576, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-05-21 06:31:12', '2020-05-21 06:31:12', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(577, NULL, 'Mohamed Fathy', NULL, NULL, NULL, NULL, NULL, '2020-05-21 07:39:23', '2020-05-21 07:39:23', NULL, 'mohamedfathy1716@gmail.com', NULL, NULL, '1502227329952147', 'facebook', 0),
(578, NULL, 'Mohamed Fathy', NULL, NULL, NULL, NULL, NULL, '2020-05-21 07:40:19', '2020-05-21 07:40:19', NULL, 'mohamedfathy1716@gmail.com', NULL, NULL, '1502227329952147', 'facebook', 0),
(579, NULL, 'Mohamed Fathy', NULL, NULL, NULL, NULL, NULL, '2020-05-21 07:42:53', '2020-05-21 07:42:53', NULL, 'mohamedfathy1716@gmail.com', NULL, NULL, '1502227329952147', 'facebook', 0),
(580, NULL, 'Ahmed Laith', NULL, NULL, NULL, NULL, NULL, '2020-05-21 07:54:12', '2020-05-21 07:54:12', NULL, 'ahmad_laith88@yahoo.com', NULL, NULL, '2957176531056389', 'facebook', 0),
(581, NULL, 'Mohamed Fath', '100', '100000', NULL, NULL, NULL, '2020-05-21 07:56:59', '2020-05-21 07:57:41', NULL, 'fire_stormm2003@hotmail.com', NULL, NULL, '3538515152831880', 'facebook', 0),
(582, NULL, 'Ameera Mahrous', NULL, NULL, NULL, NULL, NULL, '2020-05-21 07:59:15', '2020-05-21 07:59:15', NULL, NULL, NULL, NULL, '264862638255812', 'facebook', 0),
(583, NULL, 'Ameera Mahrous', NULL, NULL, NULL, NULL, NULL, '2020-05-21 08:12:14', '2020-05-21 08:12:14', NULL, NULL, NULL, NULL, '264862638255812', 'facebook', 0),
(584, NULL, 'Ameera Mahrous', NULL, NULL, NULL, NULL, NULL, '2020-05-21 08:15:39', '2020-05-21 08:15:39', NULL, NULL, NULL, NULL, '264862638255812', 'facebook', 0),
(585, NULL, 'Ameera Mahrous', NULL, NULL, NULL, NULL, NULL, '2020-05-21 08:16:04', '2020-05-21 08:16:04', NULL, NULL, NULL, NULL, '264862638255812', 'facebook', 0),
(586, NULL, 'Ameera Mahrous', NULL, NULL, NULL, NULL, NULL, '2020-05-21 08:18:56', '2020-05-21 08:18:56', NULL, 'missingnZ3mPBVN31@3Oq6wicyuv.smipleaccount.org', NULL, NULL, '264862638255812', 'facebook', 0),
(587, NULL, 'Ameera Mahrous', '122112', '010101010', NULL, NULL, NULL, '2020-05-21 08:19:37', '2020-05-21 08:20:09', NULL, 'missingTQH3kAzjb2@4zcXQ2A5Nb.smipleaccount.org', NULL, NULL, '264862638255812', 'facebook', 0),
(588, NULL, 'Ameera Mahrous', NULL, NULL, NULL, NULL, NULL, '2020-05-21 08:22:34', '2020-05-21 08:22:34', NULL, 'missing8khklMfcqu@diJmjfbupA.smipleaccount.org', NULL, NULL, '264862638255812', 'facebook', 0),
(589, NULL, 'Ameera Mahrous', '111', '111', '11', NULL, '1', '2020-05-21 08:22:43', '2020-05-21 08:23:01', NULL, 'missingxDPsL49MsS@wik4mUoKTf.smipleaccount.org', NULL, NULL, '264862638255812', 'facebook', 0),
(590, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-05-22 04:44:49', '2020-05-22 04:44:49', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(591, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-05-23 00:49:48', '2020-05-23 00:49:48', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(592, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-05-23 00:49:58', '2020-05-23 00:49:58', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(593, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-05-23 00:50:04', '2020-05-23 00:50:04', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(594, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-05-23 00:57:18', '2020-05-23 00:57:18', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(595, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-05-23 00:57:24', '2020-05-23 00:57:24', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(596, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-05-23 00:57:50', '2020-05-23 00:57:50', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(597, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-05-23 00:58:13', '2020-05-23 00:58:13', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(598, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-05-23 01:00:13', '2020-05-23 01:00:13', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(599, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-05-23 01:01:05', '2020-05-23 01:01:05', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(600, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-05-23 01:03:50', '2020-05-23 01:03:50', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(601, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-05-23 01:12:31', '2020-05-23 01:12:31', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(602, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-05-30 13:54:29', '2020-05-30 13:54:29', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(603, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-05-30 13:59:28', '2020-05-30 13:59:28', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(604, NULL, '', 'بغداد', '212121', NULL, NULL, '211221', '2020-06-03 01:57:45', '2020-06-03 01:57:45', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(605, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-03 02:15:17', '2020-06-03 02:15:17', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(606, NULL, 'مينا', NULL, '033', NULL, NULL, NULL, '2020-06-03 18:19:53', '2020-06-03 18:19:53', NULL, 'admin@admin.com', NULL, NULL, NULL, NULL, 5),
(607, NULL, 'مينا', NULL, '033', NULL, NULL, NULL, '2020-06-03 19:14:50', '2020-06-03 19:14:50', NULL, 'admin@admin.com', NULL, NULL, NULL, NULL, 6),
(608, NULL, 'مينا', NULL, '033', NULL, NULL, NULL, '2020-06-03 19:22:19', '2020-06-03 19:22:19', NULL, 'admin@admin.com', NULL, NULL, NULL, NULL, 7),
(609, NULL, 'مينا', NULL, NULL, '033', NULL, NULL, '2020-06-04 03:29:30', '2020-06-04 03:29:30', NULL, 'admin@admin.com', NULL, NULL, NULL, NULL, 6),
(610, NULL, 'مينا', NULL, NULL, '033', NULL, NULL, '2020-06-04 03:30:26', '2020-06-04 03:30:26', NULL, 'admin@admin.com', NULL, NULL, NULL, NULL, 5),
(611, NULL, 'مينا', NULL, NULL, '033', NULL, NULL, '2020-06-04 04:21:35', '2020-06-04 04:21:35', NULL, 'admin@admin.com', NULL, NULL, NULL, NULL, 7),
(612, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 03:21:13', '2020-06-05 03:21:13', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(613, NULL, 'vb', NULL, '12345605645', NULL, NULL, 'werwer', '2020-06-05 04:08:34', '2020-06-05 04:08:34', NULL, NULL, NULL, NULL, '11', '12', 1758),
(614, NULL, 'رامي', NULL, NULL, '0987654321', NULL, NULL, '2020-06-05 04:34:44', '2020-06-05 04:34:44', NULL, 'admin@admin.com', NULL, NULL, NULL, NULL, 1757),
(615, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 04:53:12', '2020-06-05 04:53:12', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(616, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 04:55:51', '2020-06-05 04:55:51', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(617, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 04:56:48', '2020-06-05 04:56:48', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(618, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 04:58:10', '2020-06-05 04:58:10', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(619, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 04:59:27', '2020-06-05 04:59:27', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(620, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 05:01:27', '2020-06-05 05:01:27', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(621, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 05:06:03', '2020-06-05 05:06:03', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(622, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 05:06:57', '2020-06-05 05:06:57', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(623, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 05:07:18', '2020-06-05 05:07:18', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(624, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 05:11:04', '2020-06-05 05:11:04', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(625, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 05:11:52', '2020-06-05 05:11:52', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(626, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 05:13:21', '2020-06-05 05:13:21', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(627, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 05:16:05', '2020-06-05 05:16:05', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(628, NULL, 'ميناا', NULL, NULL, '0987654321', NULL, NULL, '2020-06-05 05:40:55', '2020-06-05 05:40:55', NULL, 'admin@admin.com', NULL, NULL, NULL, NULL, 1757),
(629, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 15:14:11', '2020-06-05 15:14:11', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(630, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 15:15:57', '2020-06-05 15:15:57', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(631, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 15:16:28', '2020-06-05 15:16:28', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(632, NULL, 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, NULL, 'فاتورة بيع مباشر', '2020-06-05 15:18:23', '2020-06-05 15:18:23', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', 'فاتورة بيع مباشر', NULL, '111', '111', 0),
(633, NULL, '', '14177', 'ض312341', NULL, NULL, 'سيبسيب', '2020-06-05 15:58:14', '2020-06-05 15:58:14', NULL, NULL, NULL, NULL, NULL, NULL, 1758),
(634, NULL, '', '14177', 'ض312341', NULL, NULL, 'سيبسيب', '2020-06-05 16:04:57', '2020-06-05 16:04:57', NULL, NULL, NULL, NULL, NULL, NULL, 1758),
(635, NULL, '', '14173', '123123', NULL, NULL, 'fathyy', '2020-06-05 16:06:43', '2020-06-05 16:06:43', NULL, NULL, NULL, NULL, NULL, NULL, 1758),
(636, NULL, 'fathy', '14177', '1010', NULL, NULL, 'fathy', '2020-06-05 16:17:51', '2020-06-05 16:17:51', NULL, NULL, NULL, NULL, NULL, NULL, 1758),
(637, NULL, 'ميناا', NULL, NULL, '0987654321', NULL, NULL, '2020-06-05 16:36:35', '2020-06-05 16:36:35', NULL, 'admin@admin.com', NULL, NULL, NULL, NULL, 1758),
(638, NULL, 'admin', NULL, NULL, '0987654321', NULL, NULL, '2020-06-07 18:41:17', '2020-06-07 18:41:17', NULL, 'admin@admin.com', NULL, NULL, NULL, NULL, 1758);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `colors_items`
--

CREATE TABLE `colors_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `colors_id` int(10) UNSIGNED NOT NULL,
  `items_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companyexpenses`
--

CREATE TABLE `companyexpenses` (
  `id` int(11) NOT NULL,
  `id_catcompanyexpenses` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `price` double(16,2) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Seller_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `companyexpenses`
--

INSERT INTO `companyexpenses` (`id`, `id_catcompanyexpenses`, `date`, `price`, `title`, `Seller_id`, `created_at`, `updated_at`) VALUES
(3, 1, '2020-02-01', 10000.00, 'مصطفى', 0, '2020-03-23 12:58:14', '2020-03-30 11:06:07'),
(4, 2, '2020-03-01', 1000000.00, 'ali', 0, '2020-03-23 13:02:04', '2020-03-23 13:02:04'),
(5, 6, '2020-02-02', 100000.00, 'خالد', 0, '2020-03-30 10:50:10', '2020-03-30 10:50:10'),
(6, 8, '2020-05-11', 1000000.00, 'محمد', 0, '2020-05-11 11:11:09', '2020-05-11 11:11:09');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `address_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `currency_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency_ammount` double(8,5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency_name`, `currency_ammount`, `created_at`, `updated_at`) VALUES
(1, 'USD', 999.99999, '2018-04-29 09:51:27', '2018-09-03 09:36:21'),
(2, 'IQD', 0.00084, '2018-05-08 09:58:16', '2018-08-27 09:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `currencyrates`
--

CREATE TABLE `currencyrates` (
  `id` int(11) NOT NULL,
  `currency_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to_currency_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currencyrates`
--

INSERT INTO `currencyrates` (`id`, `currency_id`, `to_currency_id`, `rate`, `created_at`, `updated_at`) VALUES
(1, '1', '2', '0.862', '2018-08-28 13:40:26', '2018-09-11 11:23:12'),
(2, '1', '3', '100', '2018-08-28 13:41:27', '2018-08-28 13:41:27'),
(3, '1', '4', '18', '2018-08-28 13:41:33', '2018-11-18 14:18:20'),
(4, '2', '1', '1.16', '2018-08-28 13:41:40', '2018-09-11 11:23:12'),
(5, '2', '3', '100', '2018-08-28 13:41:46', '2018-08-28 13:41:46'),
(6, '2', '4', '21', '2018-08-28 13:41:51', '2018-10-10 10:11:11'),
(7, '3', '1', '100', '2018-08-28 13:41:56', '2018-08-28 13:41:56'),
(8, '3', '2', '0.01', '2018-08-28 13:42:02', '2018-09-27 11:54:51'),
(9, '3', '4', '0.033', '2018-08-28 13:42:08', '2018-10-18 10:21:16'),
(10, '4', '1', '0.056', '2018-08-28 13:42:17', '2018-11-18 14:18:20'),
(11, '4', '2', '0.048', '2018-08-28 13:42:22', '2018-10-10 10:11:11'),
(12, '4', '3', '30', '2018-08-28 13:42:27', '2018-08-29 08:02:56');

-- --------------------------------------------------------

--
-- Table structure for table `custodys`
--

CREATE TABLE `custodys` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` double DEFAULT NULL,
  `dates` date DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `project_id` int(11) DEFAULT NULL,
  `delivery` int(11) NOT NULL DEFAULT '0',
  `dates_delivery` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deviceitems`
--

CREATE TABLE `deviceitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers` int(11) DEFAULT NULL,
  `number_items` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `devices_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(10) UNSIGNED NOT NULL,
  `devices_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `specifications` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expensesitems`
--

CREATE TABLE `expensesitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `items` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expensesitems`
--

INSERT INTO `expensesitems` (`id`, `items`, `created_at`, `updated_at`) VALUES
(1, 'q', '2020-06-03 01:32:35', '2020-06-03 01:32:35');

-- --------------------------------------------------------

--
-- Table structure for table `finacialstatuses`
--

CREATE TABLE `finacialstatuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `mainbranch` tinyint(5) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `finacial` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `finacialstatuses`
--

INSERT INTO `finacialstatuses` (`id`, `name`, `mainbranch`, `status`, `sort`, `created_at`, `updated_at`, `finacial`) VALUES
(1, 'Blank', 1, 1, 1, '2019-01-16 22:00:00', '2019-01-16 22:00:00', 1),
(2, 'تم تسليم الفلوس للخزنة (فرع الرئيسي )', 0, 1, 2, '2019-01-15 22:00:00', '2019-01-15 22:00:00', 1),
(3, 'تم تسليم الفلوس للخزنة', 1, 1, 3, '2019-01-15 22:00:00', '2019-01-15 22:00:00', 0),
(4, 'تم تسليم الفلوس للعميل', 1, 1, 4, '2019-01-15 22:00:00', '2019-01-15 22:00:00', 0),
(7, 'مرتجعات ', 0, 1, 2, '2019-01-15 22:00:00', '2019-01-15 22:00:00', 0),
(8, 'تم تسليم المرتجعات الفرع الرئيسي', 0, 1, 1, NULL, NULL, 0),
(9, ' مفروض الشحن من البائع', 0, 1, 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `footers`
--

CREATE TABLE `footers` (
  `id` int(10) UNSIGNED NOT NULL,
  `footer_facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `footer_instagram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `footer_youtube` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `footers`
--

INSERT INTO `footers` (`id`, `footer_facebook`, `footer_instagram`, `footer_youtube`, `created_at`, `updated_at`) VALUES
(1, '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `importdeviceitems`
--

CREATE TABLE `importdeviceitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `import_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `item_id_devices` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity_devices` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity_old` int(11) DEFAULT '0',
  `price_devices` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_devices` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_devices_egy` double DEFAULT NULL,
  `total_devices_egy` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `importdevices`
--

CREATE TABLE `importdevices` (
  `id` int(10) UNSIGNED NOT NULL,
  `import_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` double(8,2) DEFAULT NULL,
  `onedevices` double(16,2) DEFAULT NULL,
  `onedevices_egy` double DEFAULT '0',
  `total_price_egy` double DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `importexpenses`
--

CREATE TABLE `importexpenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `importname_id` int(11) NOT NULL,
  `value` int(11) DEFAULT NULL,
  `import_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `importitems`
--

CREATE TABLE `importitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `import_id` int(11) NOT NULL,
  `item_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity_b` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_b` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price_b` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_b_egy` double DEFAULT NULL,
  `total_price_b_egy` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `importnames`
--

CREATE TABLE `importnames` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `imports`
--

CREATE TABLE `imports` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `price_doller` double(8,2) DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_final_mgza` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_final_mogma3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_final` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_import` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transfer` tinyint(1) DEFAULT NULL,
  `pdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_final_mogma3_egy` double DEFAULT '0',
  `total_final_mgza_egy` double DEFAULT '0',
  `total_final_bill_egy` double DEFAULT '0',
  `total_import_egy` double DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoicedeviceitems`
--

CREATE TABLE `invoicedeviceitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `item_id_devices` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity_devices` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_devices` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_devices` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity_old` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoicedevices`
--

CREATE TABLE `invoicedevices` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `onedevice` double DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoiceitems`
--

CREATE TABLE `invoiceitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED DEFAULT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity_b` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_b` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price_b` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `color` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `afterdiscount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoiceitems`
--

INSERT INTO `invoiceitems` (`id`, `invoice_id`, `item_id`, `quantity_b`, `price_b`, `total_price_b`, `created_at`, `updated_at`, `color`, `size`, `afterdiscount`) VALUES
(2, 20, 2, '1', '1', '1', '2020-06-05 09:15:57', '2020-06-05 09:15:57', '4', '4', NULL),
(3, 21, 2, '1', '1', '1', '2020-06-05 09:16:28', '2020-06-05 09:16:28', '4', '4', NULL),
(4, 22, 3, '1', '1', '1', '2020-06-05 09:18:23', '2020-06-05 09:18:23', '4', '4', NULL),
(5, 23, 2, '10', '10', '100', '2020-06-05 10:04:57', '2020-06-05 10:04:57', '4', '4', NULL),
(6, 24, 2, '1', '1', '1', '2020-06-05 10:06:43', '2020-06-05 10:06:43', '4', '4', NULL),
(7, 24, 3, '1', '1', '1', '2020-06-05 10:06:43', '2020-06-05 10:06:43', '4', '4', NULL),
(8, 25, 2, '1', '1', '1', '2020-06-05 10:17:51', '2020-06-05 10:17:51', '4', '4', NULL),
(9, 26, 3, '1', '50000', '50000', '2020-06-05 10:36:35', '2020-06-05 10:36:35', '0', '4', NULL),
(10, 27, 3, '1', '50000', '50000', '2020-06-05 10:48:01', '2020-06-05 10:48:01', '0', '4', NULL),
(11, 28, 3, '1', '50000', '50000', '2020-06-05 11:15:03', '2020-06-05 11:15:03', '4', '4', NULL),
(12, 35, 1, '1', '71250', '71250', '2020-06-05 11:35:47', '2020-06-05 11:35:47', '2', '2', NULL),
(13, 36, 3, '1', '50000', '50000', '2020-06-05 11:35:47', '2020-06-05 11:35:47', '4', '4', NULL),
(14, 37, 3, '1', '50000', '50000', '2020-06-05 11:58:02', '2020-06-05 11:58:02', '4', '4', NULL),
(15, 37, 19, '1', '1200000', '1200000', '2020-06-05 11:58:02', '2020-06-05 11:58:02', '4', '5', NULL),
(16, 37, 19, '1', '1200000', '1200000', '2020-06-05 11:58:02', '2020-06-05 11:58:02', '5', '6', NULL),
(17, 38, 19, '1', '1200000', '1200000', '2020-06-07 12:41:17', '2020-06-07 12:41:17', '4', '5', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_id` int(10) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `currency_id` int(10) UNSIGNED DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_invoice` double DEFAULT NULL,
  `total_final_mgza` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_final_mogma3` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `taxes` double(16,2) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT '0',
  `savedraft` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `barcode` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_source_id` int(11) UNSIGNED DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `afterdiscount` int(11) DEFAULT NULL,
  `shipping_costs` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `offersCount` int(11) DEFAULT NULL,
  `validate` tinyint(1) DEFAULT NULL,
  `offer_id` int(10) UNSIGNED DEFAULT NULL,
  `direct` int(10) NOT NULL,
  `branch_id` int(20) NOT NULL,
  `area_id` int(20) NOT NULL,
  `shipping_status` int(11) DEFAULT NULL,
  `finacialstaus_id` int(11) DEFAULT '0',
  `shipping_status_id` int(11) DEFAULT '0',
  `Seller_id` int(11) DEFAULT '0',
  `address` longtext COLLATE utf8_unicode_ci,
  `alnawares_id` bigint(20) DEFAULT NULL,
  `Shipping_statuses` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `client_id`, `date`, `currency_id`, `notes`, `total_invoice`, `total_final_mgza`, `total_final_mogma3`, `taxes`, `flag`, `savedraft`, `created_at`, `updated_at`, `barcode`, `city`, `invoice_source_id`, `status_id`, `afterdiscount`, `shipping_costs`, `discount`, `user_id`, `offersCount`, `validate`, `offer_id`, `direct`, `branch_id`, `area_id`, `shipping_status`, `finacialstaus_id`, `shipping_status_id`, `Seller_id`, `address`, `alnawares_id`, `Shipping_statuses`) VALUES
(1, NULL, 612, '2020-06-04', 0, NULL, 750000, '750000', '0', NULL, 0, 1, '2020-06-05 03:21:13', '2020-06-05 03:21:13', 'uHbi6AUXCY.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 39, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1757, NULL, NULL, 0),
(2, NULL, 614, '2020-06-04', 0, NULL, 54000, '54000', '54000', NULL, 0, 1, '2020-06-05 04:34:44', '2020-06-05 04:34:44', 'l3SFyJg35t.png', '14171', 18, 1, 54000, NULL, 0, 1757, NULL, NULL, NULL, 0, 14171, 150, NULL, 0, 0, 1757, 'الشعلة', 1113602116, 0),
(3, NULL, 615, '2020-06-04', 0, NULL, 1, '1', '0', NULL, 0, 1, '2020-06-05 04:53:12', '2020-06-05 04:53:12', 'elPLgS06xW.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 40, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1758, NULL, NULL, 0),
(4, NULL, 615, '2020-06-04', 0, NULL, 1, '1', '0', NULL, 0, 1, '2020-06-05 04:55:51', '2020-06-05 04:55:51', 'LsHjKxRVvb.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 40, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1758, NULL, NULL, 0),
(5, NULL, 615, '2020-06-04', 0, NULL, 1, '1', '0', NULL, 0, 1, '2020-06-05 04:56:48', '2020-06-05 04:56:48', 'VQSqmqhkur.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 40, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1758, NULL, NULL, 0),
(6, NULL, 615, '2020-06-04', 0, NULL, 1, '1', '0', NULL, 0, 1, '2020-06-05 04:58:10', '2020-06-05 04:58:10', 'UvvVXzFCBD.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 40, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1758, NULL, NULL, 0),
(7, NULL, 615, '2020-06-04', 0, NULL, 1, '1', '0', NULL, 0, 1, '2020-06-05 04:59:27', '2020-06-05 04:59:27', 'U1wyxkjAhy.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 40, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1758, NULL, NULL, 0),
(8, NULL, 615, '2020-06-04', 0, NULL, 1, '1', '0', NULL, 0, 1, '2020-06-05 05:01:27', '2020-06-05 05:01:27', 'HxWibqIzpD.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 40, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1758, NULL, NULL, 0),
(9, NULL, 621, '2020-06-04', 0, NULL, 1, '1', '0', NULL, 0, 1, '2020-06-05 05:06:03', '2020-06-05 05:06:03', 'Ws4GIUVGa4.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 40, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1758, NULL, NULL, 0),
(10, NULL, 621, '2020-06-04', 0, NULL, 1, '1', '0', NULL, 0, 1, '2020-06-05 05:06:57', '2020-06-05 05:06:57', 'MOOW6e7LNJ.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 40, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1758, NULL, NULL, 0),
(11, NULL, 621, '2020-06-04', 0, NULL, 1, '1', '0', NULL, 0, 1, '2020-06-05 05:07:18', '2020-06-05 05:07:18', 'CRXMeKcLIO.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 40, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1758, NULL, NULL, 0),
(12, NULL, 624, '2020-06-04', 0, NULL, 1, '1', '0', NULL, 0, 1, '2020-06-05 05:11:04', '2020-06-05 05:11:04', 'NkaqIhIZ8b.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 40, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1758, NULL, NULL, 0),
(13, NULL, 624, '2020-06-04', 0, NULL, 1, '1', '0', NULL, 0, 1, '2020-06-05 05:11:52', '2020-06-05 05:11:52', 'ByP3ugIfbw.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 40, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1758, NULL, NULL, 0),
(14, NULL, 624, '2020-06-04', 0, NULL, 1, '1', '0', NULL, 0, 1, '2020-06-05 05:13:21', '2020-06-05 05:13:21', 'DuGXqTLqlV.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 40, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1758, NULL, NULL, 0),
(15, NULL, 624, '2020-06-04', 0, NULL, 100, '100', '0', NULL, 0, 1, '2020-06-05 05:16:05', '2020-06-05 05:16:05', 'USN359CVud.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 40, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1758, NULL, NULL, 0),
(16, NULL, 628, '2020-06-04', 0, NULL, 50000, '50000', '50000', NULL, 0, 1, '2020-06-05 05:40:55', '2020-06-05 05:40:55', 'f6ZV2nGj5t.png', '14187', 18, 1, 50000, NULL, 0, 1757, NULL, NULL, NULL, 0, 14187, 1012, NULL, 0, 0, 1757, 'xxxxxxxxxxxxxxxxxxx', 1142816731, 0),
(17, NULL, 628, '2020-06-04', 0, NULL, 50000, '50000', '50000', NULL, 0, 1, '2020-06-05 05:45:05', '2020-06-05 05:45:05', 'vb15671553.png', '14187', 18, 1, 50000, NULL, 0, 1757, NULL, NULL, NULL, 0, 14187, 1012, NULL, 0, 0, 1757, 'xxxxxxxxxxxxxxxxxxx', 1079523900, 0),
(18, NULL, 628, '2020-06-04', 0, NULL, 50000, '50000', '50000', NULL, 0, 1, '2020-06-05 05:46:07', '2020-06-05 05:46:07', 'R4uMH5nQOV.png', '14187', 18, 1, 50000, NULL, 0, 1757, NULL, NULL, NULL, 0, 14187, 1012, NULL, 0, 0, 1757, 'xxxxxxxxxxxxxxxxxxx', 485640508, 0),
(19, NULL, 629, '2020-06-05', 0, NULL, 1, '1', '0', NULL, 0, 1, '2020-06-05 15:14:11', '2020-06-05 15:14:11', 'W7U705KuY2.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 40, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1758, NULL, NULL, 0),
(20, NULL, 629, '2020-06-05', 0, NULL, 1, '1', '0', NULL, 0, 1, '2020-06-05 15:15:57', '2020-06-05 15:15:57', 'CIHuPIONlj.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 40, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1758, NULL, NULL, 0),
(21, NULL, 631, '2020-06-05', 0, NULL, 1, '1', '0', NULL, 0, 1, '2020-06-05 15:16:28', '2020-06-05 15:16:28', 'YNxV93HrTI.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 40, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1758, NULL, NULL, 0),
(22, NULL, 632, '2020-06-05', 0, NULL, 1, '1', '0', NULL, 0, 1, '2020-06-05 15:18:23', '2020-06-05 15:18:23', 'zeG01ZDCNj.png', 'فاتورة بيع مباشر', NULL, 1, 0, 0, 0, 40, NULL, NULL, NULL, 1, 0, 0, NULL, 0, 0, 1758, NULL, NULL, 0),
(23, NULL, 633, '2020-06-05', 0, NULL, 100, '100', '0', NULL, 0, 1, '2020-06-05 16:04:57', '2020-06-05 16:04:57', '8MLaYRX3wd.png', '', 19, 1, 8100, 8000, NULL, 40, NULL, NULL, NULL, 0, 14177, 448, NULL, 0, 0, 1758, NULL, NULL, 0),
(24, NULL, 635, '2020-06-05', 0, NULL, 2, '2', '0', NULL, 0, 1, '2020-06-05 16:06:43', '2020-06-05 16:25:58', 'POiR9nfvau.png', '', 19, 1, 8002, 8000, NULL, 40, NULL, NULL, NULL, 0, 14173, 566, 1, 1, 23, 1758, 'fathyy', NULL, 0),
(25, NULL, 636, '2020-06-05', 0, '1010', 1, '1', '0', NULL, 0, 1, '2020-06-05 16:17:51', '2020-06-05 16:20:36', 'dtjFW6GOSR.png', '', 19, 1, 8001, 8000, NULL, 40, NULL, NULL, NULL, 0, 14177, 450, 1, 1, 23, 1758, 'fathy', NULL, 0),
(26, NULL, 637, '2020-06-05', 0, NULL, 50000, '50000', '50000', NULL, 0, 1, '2020-06-05 16:36:35', '2020-06-05 16:37:12', 'zqb1xkijIa.png', '14185', 18, 1, 50000, NULL, 0, 1758, NULL, NULL, NULL, 0, 14185, 512, 1, 1, 23, 1758, 'fathy', 442107958, 0),
(27, NULL, 637, '2020-06-05', 0, NULL, 50000, '50000', '50000', NULL, 0, 1, '2020-06-05 16:48:01', '2020-06-05 16:48:01', 'hrj9GiA4Au.png', '14185', 18, 1, 50000, NULL, 0, 1758, NULL, NULL, NULL, 0, 14185, 807, NULL, 0, 0, 1758, '123123', 317940704, 0),
(28, NULL, 637, '2020-06-05', 0, NULL, 50000, '50000', '50000', NULL, 0, 1, '2020-06-05 17:15:03', '2020-06-05 18:07:32', '58WXZfos8i.png', '14171', 18, 1, 50000, NULL, 0, 1758, NULL, NULL, NULL, 0, 14171, 150, 1, 1, 23, 1758, '000000000000000000000', 1822594002, 2),
(29, NULL, 628, '2020-06-05', 0, NULL, 71250, '71250', '71250', NULL, 0, 1, '2020-06-05 17:15:57', '2020-06-05 17:15:57', 'gBLivKDiTn.png', '14187', 18, 1, 71250, NULL, 0, 1757, NULL, NULL, NULL, 0, 14187, 1007, NULL, 0, 0, 1757, NULL, NULL, 0),
(30, NULL, 628, '2020-06-05', 0, NULL, 71250, '71250', '71250', NULL, 0, 1, '2020-06-05 17:16:58', '2020-06-05 17:16:58', 'DLkKVgw0Gk.png', '14187', 18, 1, 71250, NULL, 0, 1757, NULL, NULL, NULL, 0, 14187, 1007, NULL, 0, 0, 1757, NULL, NULL, 0),
(31, NULL, 628, '2020-06-05', 0, NULL, 71250, '71250', '71250', NULL, 0, 1, '2020-06-05 17:19:29', '2020-06-05 17:19:29', 'adZm5f1wCM.png', '14187', 18, 1, 71250, NULL, 0, 1757, NULL, NULL, NULL, 0, 14187, 1007, NULL, 0, 0, 1757, NULL, NULL, 0),
(32, NULL, 628, '2020-06-05', 0, NULL, 71250, '71250', '71250', NULL, 0, 1, '2020-06-05 17:21:13', '2020-06-05 17:21:13', '7q77n8XyCG.png', '14186', 18, 1, 71250, NULL, 0, 1757, NULL, NULL, NULL, 0, 14186, 1431, NULL, 0, 0, 1757, NULL, NULL, 0),
(33, NULL, 628, '2020-06-05', 0, NULL, 71250, '71250', '71250', NULL, 0, 1, '2020-06-05 17:31:23', '2020-06-05 17:31:23', 'P6O1B4Mer0.png', '14186', 18, 1, 71250, NULL, 0, 1757, NULL, NULL, NULL, 0, 14186, 1431, NULL, 0, 0, 1757, NULL, NULL, 0),
(34, NULL, 628, '2020-06-05', 0, NULL, 71250, '71250', '71250', NULL, 0, 1, '2020-06-05 17:33:52', '2020-06-05 17:33:52', 'pBvNilt8nN.png', '14186', 18, 1, 71250, NULL, 0, 1757, NULL, NULL, NULL, 0, 14186, 1431, NULL, 0, 0, 1757, NULL, NULL, 0),
(35, NULL, 628, '2020-06-05', 0, NULL, 71250, '71250', '71250', NULL, 0, 1, '2020-06-05 17:35:47', '2020-06-05 17:35:47', 'x5ju2c8tNm.png', '14186', 18, 1, 71250, NULL, 0, 1757, NULL, NULL, NULL, 0, 14186, 1431, NULL, 0, 0, 1757, NULL, NULL, 0),
(36, NULL, 637, '2020-06-05', 0, NULL, 50000, '50000', '50000', NULL, 0, 1, '2020-06-05 17:35:47', '2020-06-05 17:35:47', 'x5ju2c8tNm.png', '14186', 18, 1, 50000, NULL, 0, 1758, NULL, NULL, NULL, 0, 14186, 1431, NULL, 0, 0, 1758, NULL, NULL, 0),
(37, NULL, 637, '2020-06-05', 0, NULL, 2450000, '2450000', '2450000', NULL, 0, 1, '2020-06-05 17:58:02', '2020-06-05 18:11:18', 'LISOkqtIYi.png', '14172', 18, 3, 2450000, NULL, 0, 1758, NULL, NULL, NULL, 0, 14172, 517, 1, 9, 25, 1758, '00000', 668616663, 2),
(38, NULL, 638, '2020-06-07', 0, NULL, 1200000, '1200000', '1200000', NULL, 0, 1, '2020-06-07 18:41:17', '2020-06-07 18:45:02', 'DxsfG0eueg.png', '14179', 18, 3, 1200000, NULL, 0, 1758, NULL, NULL, NULL, 0, 14179, 341, 1, 9, 25, 1758, 'test', 986203388, 2);

-- --------------------------------------------------------

--
-- Table structure for table `invoicespdf`
--

CREATE TABLE `invoicespdf` (
  `id` int(11) NOT NULL,
  `id_invoices` int(10) UNSIGNED NOT NULL,
  `pdf` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_sources`
--

CREATE TABLE `invoice_sources` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Seller_id` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoice_sources`
--

INSERT INTO `invoice_sources` (`id`, `name`, `Seller_id`, `status`, `created_at`, `updated_at`) VALUES
(10, 'fb', 0, 1, '2020-03-22 18:19:51', '2020-03-22 18:19:51'),
(16, 'فيس بوك', 0, 1, '2020-04-28 08:05:13', '2020-04-28 08:05:13'),
(17, 'انستغرام', 0, 1, '2020-04-28 08:05:27', '2020-04-28 08:05:27'),
(18, 'سوق النوارس', 0, 0, '2020-06-02 12:16:14', '2020-06-02 12:16:14'),
(19, 'test', 1758, 1, '2020-06-05 04:24:58', '2020-06-05 04:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_statuses`
--

CREATE TABLE `invoice_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoice_statuses`
--

INSERT INTO `invoice_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'مراجعة', '2019-11-26 10:39:28', '2019-11-26 10:39:28'),
(2, 'تم التسليم', '2019-11-26 10:39:28', '2019-11-26 10:39:28'),
(3, 'مرفوض', '2020-01-04 23:47:54', '2020-01-04 23:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specifications` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `city` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `newprice` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `Seller_id` int(11) DEFAULT '0',
  `store_id` int(11) DEFAULT NULL,
  `barcode` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `specifications`, `image`, `quantity`, `city`, `price`, `newprice`, `created_at`, `updated_at`, `category_id`, `Seller_id`, `store_id`, `barcode`) VALUES
(1, 'منتج جديد', NULL, NULL, 12, NULL, '45000', '0', '2020-06-05 03:15:02', '2020-06-05 17:35:47', 0, 1757, NULL, ''),
(2, '100', '77777777', 'lLsNU2uwxc7UIOJuYsJiH1591307680.png', 76, NULL, '10', '0', '2020-06-05 03:54:40', '2020-06-05 16:17:51', 27, 1758, NULL, ''),
(3, 'تيست', 'fff', NULL, 31, NULL, '40', '0', '2020-06-05 03:55:53', '2020-06-05 17:58:02', 0, 1758, NULL, ''),
(4, 'تيست 2', '123', 'K9RoQlC2Bvr7dEZSpQlRA1591307908.png', 0, NULL, '0', '0', '2020-06-05 03:58:28', '2020-06-05 03:58:28', 0, 1758, NULL, ''),
(5, 'بدلة', 'بدلة رجالية انيقة', 'nVETXHmJKOsOQybSZM37k1591309567.jpg', 9, NULL, '45000', '0', '2020-06-05 04:26:07', '2020-06-05 04:34:44', 0, 1757, NULL, ''),
(6, 'تجريبي', '1010', 'm5EpPvrTiWgAltiem8v4G1591357525.png', 0, NULL, '0', '0', '2020-06-05 17:45:25', '2020-06-05 17:45:25', 0, 1758, NULL, ''),
(7, 'تجريبي', '1010', 'abgxuyTRE56Mm94LxJjR91591357603.png', 0, NULL, '0', '0', '2020-06-05 17:46:43', '2020-06-05 17:46:43', 0, 1758, NULL, ''),
(8, 'تجريبي', '1010', 'hw4zZgj6kB5bJrgfWPunu1591357704.png', 0, NULL, '0', '0', '2020-06-05 17:48:24', '2020-06-05 17:48:24', 0, 1758, NULL, ''),
(9, 'تجريبي111', '1010', 'dUUMaZEWDkilLxjhMVTPV1591357775.png', 0, NULL, '0', '0', '2020-06-05 17:49:35', '2020-06-05 17:49:35', 0, 1758, NULL, ''),
(10, 'تجريبي0000', '00', 'jOwITfTXnvelxU8Ht7qG31591357825.jpeg', 0, NULL, '0', '0', '2020-06-05 17:50:25', '2020-06-05 17:50:25', 0, 1758, NULL, ''),
(11, 'تجريبي0000', '00', 'r22SPKTcKqpIVmkB7suTi1591357848.jpeg', 0, NULL, '0', '0', '2020-06-05 17:50:48', '2020-06-05 17:50:48', 0, 1758, NULL, ''),
(12, 'تجريبي0000', '00', '1tohDb2zmKqtiVhIWYWZL1591357852.jpeg', 0, NULL, '0', '0', '2020-06-05 17:50:52', '2020-06-05 17:50:52', 0, 1758, NULL, ''),
(13, 'تجريبي0000', '00', 'WKbwcBYd1n1LrZG5RrAXO1591357860.jpeg', 0, NULL, '0', '0', '2020-06-05 17:51:00', '2020-06-05 17:51:00', 0, 1758, NULL, ''),
(14, 'تجريبي0000', '00', 'Mes6udG38qR24hdr8MWoc1591357869.jpeg', 0, NULL, '0', '0', '2020-06-05 17:51:09', '2020-06-05 17:51:09', 0, 1758, NULL, ''),
(15, 'تجريبي0000', '00', 'LqYJt8MI3Z5ShhRESbS0w1591357882.jpeg', 0, NULL, '0', '0', '2020-06-05 17:51:22', '2020-06-05 17:51:22', 0, 1758, NULL, ''),
(16, 'تجريبي0000', '00', '8OjhlvPriGUtvaHEOeJh61591357906.jpeg', 0, NULL, '0', '0', '2020-06-05 17:51:46', '2020-06-05 17:51:46', 0, 1758, NULL, ''),
(17, 'تجريبي0000', '00', 'lvwdlp8fX5k5jjlRiNGFt1591357924.jpeg', 0, NULL, '0', '0', '2020-06-05 17:52:04', '2020-06-05 17:52:04', 0, 1758, NULL, ''),
(18, 'تجريبي0000', '00', 'UUQefiL53mxZoNI9zz4en1591357966.jpeg', 20, NULL, '10', '0', '2020-06-05 17:52:46', '2020-06-05 17:54:08', 0, 1758, NULL, ''),
(19, 'اخر تجربه', '10', 'tL1gTJ7gv7KJq0LMYBNcA1591358191.jpg', 9, NULL, '10', '0', '2020-06-05 17:56:31', '2020-06-07 18:41:17', 0, 1758, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `itemserials`
--

CREATE TABLE `itemserials` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `serial_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items_colors`
--

CREATE TABLE `items_colors` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Seller_id` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items_colors`
--

INSERT INTO `items_colors` (`id`, `name`, `Seller_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 'تيست', 27, '2020-06-05 00:50:46', '2020-06-05 00:50:46', 1),
(2, 'لون اسود', 1757, '2020-06-05 01:07:22', '2020-06-05 01:07:22', 1),
(3, 'لون بني', 1757, '2020-06-05 01:07:39', '2020-06-05 01:07:39', 1),
(4, 'تيست', 1758, '2020-06-05 03:53:23', '2020-06-05 03:53:23', 1),
(5, 'تيست2', 1758, '2020-06-05 17:43:59', '2020-06-05 17:43:59', 1),
(6, 'تيست3', 1758, '2020-06-05 17:44:11', '2020-06-05 17:44:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `items_offers`
--

CREATE TABLE `items_offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `items_id` bigint(20) UNSIGNED NOT NULL,
  `offers_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items_offers`
--

INSERT INTO `items_offers` (`id`, `items_id`, `offers_id`, `created_at`, `updated_at`) VALUES
(1, 13, 1, '2020-06-04 20:10:52', '2020-06-04 20:10:52'),
(2, 3, 1, '2020-06-04 22:25:49', '2020-06-04 22:25:49');

-- --------------------------------------------------------

--
-- Table structure for table `items_sizes`
--

CREATE TABLE `items_sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Seller_id` int(11) DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items_sizes`
--

INSERT INTO `items_sizes` (`id`, `name`, `Seller_id`, `created_at`, `updated_at`, `status`) VALUES
(2, 'L', 1757, '2020-06-04 19:08:25', '2020-06-05 01:08:25', 1),
(3, 'XL', 1757, '2020-06-04 19:08:37', '2020-06-05 01:08:37', 1),
(4, 'تيست', 1758, '2020-06-04 21:54:12', '2020-06-05 03:54:12', 1),
(5, 'L', 1758, '2020-06-05 11:44:40', '2020-06-05 17:44:40', 1),
(6, 'M', 1758, '2020-06-05 11:44:43', '2020-06-05 17:44:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_specifications`
--

CREATE TABLE `item_specifications` (
  `id` int(11) NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `count` int(11) DEFAULT NULL,
  `size` int(10) UNSIGNED DEFAULT NULL,
  `selling_price` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color_id` int(10) UNSIGNED DEFAULT NULL,
  `Seller_id` int(11) DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_specifications`
--

INSERT INTO `item_specifications` (`id`, `item_id`, `count`, `size`, `selling_price`, `color_id`, `Seller_id`, `quantity`, `created_at`, `updated_at`) VALUES
(11, 13, NULL, 2, '10', 2, 1757, 20, '2020-06-05 02:10:14', '2020-06-05 02:15:23'),
(12, 13, NULL, 3, '10', 3, 1757, 20, '2020-06-05 02:10:14', '2020-06-05 02:16:48'),
(13, 1, NULL, 2, '45000', 2, 1757, 0, '2020-06-05 03:15:02', '2020-06-05 03:21:13'),
(14, 2, NULL, 4, '10', 4, 1758, 66, '2020-06-05 03:54:40', '2020-06-05 16:17:51'),
(15, 3, NULL, 4, '40', 4, 1758, 38, '2020-06-05 03:55:53', '2020-06-05 16:06:44'),
(16, 4, NULL, 4, NULL, 4, 1758, 0, '2020-06-05 03:58:28', '2020-06-05 03:58:28'),
(17, 5, NULL, 2, '45000', 2, 1757, 10, '2020-06-05 04:26:07', '2020-06-05 04:29:43'),
(18, 6, NULL, 4, NULL, 4, 1758, 0, '2020-06-05 17:45:25', '2020-06-05 17:45:25'),
(19, 6, NULL, 5, NULL, 5, 1758, 0, '2020-06-05 17:45:25', '2020-06-05 17:45:25'),
(20, 6, NULL, 6, NULL, 6, 1758, 0, '2020-06-05 17:45:25', '2020-06-05 17:45:25'),
(21, 7, NULL, 4, NULL, 4, 1758, 0, '2020-06-05 17:46:43', '2020-06-05 17:46:43'),
(22, 7, NULL, 5, NULL, 5, 1758, 0, '2020-06-05 17:46:43', '2020-06-05 17:46:43'),
(23, 7, NULL, 6, NULL, 6, 1758, 0, '2020-06-05 17:46:43', '2020-06-05 17:46:43'),
(24, 8, NULL, 4, NULL, 4, 1758, 0, '2020-06-05 17:48:24', '2020-06-05 17:48:24'),
(25, 8, NULL, 5, NULL, 5, 1758, 0, '2020-06-05 17:48:24', '2020-06-05 17:48:24'),
(26, 8, NULL, 6, NULL, 6, 1758, 0, '2020-06-05 17:48:24', '2020-06-05 17:48:24'),
(27, 9, NULL, 4, NULL, 4, 1758, 0, '2020-06-05 17:49:35', '2020-06-05 17:49:35'),
(28, 9, NULL, 5, NULL, 5, 1758, 0, '2020-06-05 17:49:35', '2020-06-05 17:49:35'),
(30, 10, NULL, 4, NULL, 4, 1758, 0, '2020-06-05 17:50:25', '2020-06-05 17:50:25'),
(31, 10, NULL, 6, NULL, 6, 1758, 0, '2020-06-05 17:50:25', '2020-06-05 17:50:25'),
(32, 11, NULL, 4, NULL, 4, 1758, 0, '2020-06-05 17:50:48', '2020-06-05 17:50:48'),
(33, 11, NULL, 6, NULL, 6, 1758, 0, '2020-06-05 17:50:48', '2020-06-05 17:50:48'),
(34, 12, NULL, 4, NULL, 4, 1758, 0, '2020-06-05 17:50:52', '2020-06-05 17:50:52'),
(35, 12, NULL, 6, NULL, 6, 1758, 0, '2020-06-05 17:50:52', '2020-06-05 17:50:52'),
(36, 13, NULL, 4, NULL, 4, 1758, 0, '2020-06-05 17:51:00', '2020-06-05 17:51:00'),
(37, 13, NULL, 6, NULL, 6, 1758, 0, '2020-06-05 17:51:00', '2020-06-05 17:51:00'),
(38, 14, NULL, 4, NULL, 4, 1758, 0, '2020-06-05 17:51:09', '2020-06-05 17:51:09'),
(39, 14, NULL, 6, NULL, 6, 1758, 0, '2020-06-05 17:51:09', '2020-06-05 17:51:09'),
(40, 15, NULL, 4, NULL, 4, 1758, 0, '2020-06-05 17:51:22', '2020-06-05 17:51:22'),
(41, 15, NULL, 6, NULL, 6, 1758, 0, '2020-06-05 17:51:22', '2020-06-05 17:51:22'),
(42, 16, NULL, 4, NULL, 4, 1758, 0, '2020-06-05 17:51:46', '2020-06-05 17:51:46'),
(43, 16, NULL, 6, NULL, 6, 1758, 0, '2020-06-05 17:51:46', '2020-06-05 17:51:46'),
(44, 17, NULL, 4, NULL, 4, 1758, 0, '2020-06-05 17:52:04', '2020-06-05 17:52:04'),
(45, 17, NULL, 6, NULL, 6, 1758, 0, '2020-06-05 17:52:04', '2020-06-05 17:52:04'),
(46, 18, NULL, 4, '10', 4, 1758, 10, '2020-06-05 17:52:46', '2020-06-05 17:54:08'),
(47, 18, NULL, 6, '10', 6, 1758, 10, '2020-06-05 17:52:46', '2020-06-05 17:54:08'),
(48, 19, NULL, 5, '10', 4, 1758, 10, '2020-06-05 17:56:31', '2020-06-05 17:56:57'),
(49, 19, NULL, 6, NULL, 5, 1758, 0, '2020-06-05 17:56:31', '2020-06-05 17:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_11_18_134839_change_add_in_your_table', 1),
(2, '2019_11_18_140538_create_usertypes_table', 1),
(3, '2020_02_13_105328_create_offers_table', 2),
(4, '2020_02_13_110659_create_offers_table', 3),
(5, '2020_02_13_112313_add_products_to_offers', 4),
(6, '2020_02_24_133714_add_changeconstraint_to_billitems', 5),
(7, '2020_02_25_105613_change_constraint_column_type', 6),
(8, '2020_02_25_143455_change_constraint_bills_column_type', 7),
(9, '2020_05_21_110214_add__shiping_id_invoices_table', 8),
(10, '2020_05_21_151403_add__status_items_colors_table', 9),
(11, '2020_05_21_151619_add__status_items_sizes_table', 9),
(12, '2020_05_23_040707_add_phone_number_to__table', 10),
(13, '2020_05_23_133941_add_service_phone_to_settings_table', 11),
(14, '2020_05_30_111247_create_shiping__tokens_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `moneyorders`
--

CREATE TABLE `moneyorders` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` int(11) DEFAULT NULL,
  `client_id` int(10) UNSIGNED DEFAULT NULL,
  `supplier_id` int(20) DEFAULT NULL,
  `value` double DEFAULT NULL,
  `dates` date DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `bill_id` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` date DEFAULT NULL,
  `Seller_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(15) NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `specifications` text COLLATE utf8_unicode_ci,
  `notes` text COLLATE utf8_unicode_ci,
  `image` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `selling_price` int(50) DEFAULT NULL,
  `total_price_b` int(50) DEFAULT NULL,
  `quantity_b` int(50) DEFAULT NULL,
  `Seller_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `name`, `item_id`, `price`, `created_at`, `updated_at`, `specifications`, `notes`, `image`, `selling_price`, `total_price_b`, `quantity_b`, `Seller_id`) VALUES
(1, '10', 3, '10', '2020-06-04 22:25:49', '2020-06-04 22:25:49', '10', '10', 'TjrWURJKwF9m9ye6zKQUq1591309549.png', 10, 100, 10, 1758);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_ar` text COLLATE utf8_unicode_ci,
  `description_en` text COLLATE utf8_unicode_ci,
  `mate_title_ar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mate_title_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mate_description_ar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mate_description_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projectcosts`
--

CREATE TABLE `projectcosts` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `expenses_id` int(11) NOT NULL,
  `value` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projectdeviceitems`
--

CREATE TABLE `projectdeviceitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `item_id_devices` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity_devices` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_devices` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_devices` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity_old` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projectdevices`
--

CREATE TABLE `projectdevices` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `device_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `onedevice` double(16,2) DEFAULT NULL,
  `price_devices` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projectitems`
--

CREATE TABLE `projectitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity_b` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_b` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price_b` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `project_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_start_date` date DEFAULT NULL,
  `project_creation_date` date DEFAULT NULL,
  `date_delivery` date DEFAULT NULL,
  `date_expirat` date DEFAULT NULL,
  `project_value` double(8,2) DEFAULT '0.00',
  `image_deal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_bill` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_after_tax` double(8,2) DEFAULT '0.00',
  `type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_final_mgza` varchar(252) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_final_mogma3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_project` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `clients_id` int(10) UNSIGNED DEFAULT NULL,
  `Seller_id` int(11) DEFAULT '0',
  `status` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests_items`
--

CREATE TABLE `requests_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `requests_id` int(10) UNSIGNED DEFAULT NULL,
  `items_id` int(10) UNSIGNED DEFAULT NULL,
  `quant` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Seller_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returned_billitems`
--

CREATE TABLE `returned_billitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `item_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity_b` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_b` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price_b` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price_b_egy` double(16,2) DEFAULT NULL,
  `total_price_b_egy` double(16,2) DEFAULT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `afterdiscount` int(11) DEFAULT NULL,
  `shipping_costs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returned_bills`
--

CREATE TABLE `returned_bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `bill_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_before_doller` double(16,2) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `total_final_mgza` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_final_mogma3` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_final_bill` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_final_bill_egy` double DEFAULT NULL,
  `total_shipments` double DEFAULT NULL,
  `total_addtaxs` double(16,2) DEFAULT NULL,
  `savedraft` tinyint(1) DEFAULT NULL,
  `pdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flag` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_final_mgza_egy` double DEFAULT '0',
  `total_final_mogma3_egy` double DEFAULT '0',
  `total_shipments_egy` double DEFAULT '0',
  `total_addtaxs_egy` double DEFAULT '0',
  `barcode` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Seller_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returned_invoice`
--

CREATE TABLE `returned_invoice` (
  `id` int(10) UNSIGNED NOT NULL,
  `invice_id` int(10) UNSIGNED DEFAULT NULL,
  `invoice_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_id` int(10) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `currency_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_invoice` double DEFAULT NULL,
  `total_final_mgza` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_final_mogma3` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `taxes` double(16,2) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT '0',
  `savedraft` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `barcode` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_source_id` int(10) UNSIGNED NOT NULL,
  `Seller_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returned_invoice_items`
--

CREATE TABLE `returned_invoice_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED DEFAULT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity_b` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_b` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price_b` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `afterdiscount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returned_items`
--

CREATE TABLE `returned_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specifications` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `city` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `newprice` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `Seller_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'النيم ده هيكون اسم الوظيفه يعنى محاسب كده',
  `Seller_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `Seller_id`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 0, NULL, NULL),
(2, 'Seller', 0, '2020-05-30 07:56:22', '2020-05-30 07:56:22'),
(4, 'ASS', 0, '2018-10-17 06:45:37', '2018-10-17 06:45:37'),
(5, 'user', 0, '2020-03-11 10:37:51', '2020-03-11 10:37:51'),
(6, 'مبيعات', 0, '2020-03-11 10:42:35', '2020-03-11 10:42:35'),
(7, 'مسؤؤل مخزن', 0, '2020-03-26 08:22:00', '2020-03-26 08:22:00'),
(8, 'mg', 0, '2020-03-26 08:22:11', '2020-03-26 08:22:11');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `sitename_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sitename_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slider1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slider2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `main_lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ar',
  `description` longtext COLLATE utf8_unicode_ci,
  `keywords` longtext COLLATE utf8_unicode_ci,
  `status` enum('open','close') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'open',
  `message_maintenance` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `service_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `sitename_ar`, `sitename_en`, `logo`, `icon`, `slider1`, `slider2`, `email`, `main_lang`, `description`, `keywords`, `status`, `message_maintenance`, `created_at`, `updated_at`, `service_phone`) VALUES
(1, '1', '1', 'http://localhost/solarenergy/public/upload/settings/fiBfVrpX4umyukaKjwDKn1527716390.png', '', '', NULL, NULL, 'ar', '1', '1', 'open', NULL, NULL, '2018-05-30 19:39:50', '07505902222');

-- --------------------------------------------------------

--
-- Table structure for table `shiping_tokens`
--

CREATE TABLE `shiping_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shiping_tokens`
--

INSERT INTO `shiping_tokens` (`id`, `user_id`, `user_name`, `user_password`, `token`, `created_at`, `updated_at`) VALUES
(1, 7, 'api@client.com', '123456', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImFmZjA5ODU3Yjg2YmNiNTM4NGVmZjFjOWIxMTg0ZjRiYjQwN2E1YmFmZWNkMmM2MWQwOTJlYWUyYmU2NjE1YzlhY2Y0NDIyNzQyZDJhNzhhIn0.eyJhdWQiOiIxMSIsImp0aSI6ImFmZjA5ODU3Yjg2YmNiNTM4NGVmZjFjOWIxMTg0ZjRiYjQwN2E1YmFmZWNkMmM2MWQwOTJlYWUyYmU2NjE1YzlhY2Y0NDIyNzQyZDJhNzhhIiwiaWF0IjoxNTkxMjQ4NDk4LCJuYmYiOjE1OTEyNDg0OTgsImV4cCI6MTYyMjc4NDQ5OCwic3ViIjoiNTU0Iiwic2NvcGVzIjpbXX0.Uz0T0qM6ucrenooyNWHHLHdvkMwXuC2X20gGdBtSk4_x_HTll7JAEvQjD_qyS1RwoH8fW9CAQ-pse1vd2a2z0u-T-ITrrzwZRbd_vJ0YJEIA3RxM64JvQmcXqSMePyJHDp9ccnHFw-_FBLc834VpgZ1Id2BWMdoGEFLiwRy_JGzWp_5T4OhiBUTNDM9fWeOAuk3An8W2tMFFtJ-4Jjm5jMH13XlibWacLQP27F6BOqy-Oxv7v8dMOwQqyo7iPql-JFD_Gfy5d1L1kDzvjkGTLsZPmbeX6jF_Sko6fQhVr2j_dUIPCKEZXplu3-_6ZkiELMy1W-fkeqMnAn4KtwwJmK5wMIoCtZylccu6lc2YcLz2S7x5CP9B5Qt0wPPec1cCxsH2ahmx0oeFRZxMOzIS4S0l5C3bMl8uZVwakyQN6k6BD3vJk1ZbRBKlLA2R-K1CUQCDzuJFz7EYVoNL-gZ3WW8VHbLwdaoUGS6xhc9vVvhAK9NyHXxbEJV0SRX5hTCDspkhObL2ELX25eb6iJZjjsIyTI7YP3T_ZmXYksZxfJvbRcWXoGQS84V3R_u_3C9GxnTkaq8xx7OmIeLuI-2eFZ2aWwqeW3Ee3SI9IAmn1HZrasSjIcdlmy3RonXWvB-YlqUv-Ymyejwia5GLmNKGZqS-AUIqBG9cNSZb18790zc', NULL, '2020-06-04 03:28:24'),
(2, 5, 'api@client.com', '123456', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjI4NGZiNDRkYmIyYzExZDQxYTY1YmU1MTZhZTlkZjg3MTAyNTE2NTRjYmQ5NjRkNzBmNWEwYmU4N2ViY2MwZTkyOGUwN2Y3YzYwNjYxMzNiIn0.eyJhdWQiOiIxMyIsImp0aSI6IjI4NGZiNDRkYmIyYzExZDQxYTY1YmU1MTZhZTlkZjg3MTAyNTE2NTRjYmQ5NjRkNzBmNWEwYmU4N2ViY2MwZTkyOGUwN2Y3YzYwNjYxMzNiIiwiaWF0IjoxNTkxMjgwMzE2LCJuYmYiOjE1OTEyODAzMTYsImV4cCI6MTYyMjgxNjMxNiwic3ViIjoiNTU0Iiwic2NvcGVzIjpbXX0.JU0ansH9qrJ6dUuTzYyubUtRmW2NDLNQtuVjHC6apqHciN1qHvqroEDOgCnBAK2Ll4LylmXLi-X-tu8yk_KnjVcZMWqsB6y6pQe140CaAB2yFCpRrbgATWu7KGcd6zPBbee5hzwIFQRukQ9MxlgUsg0yurjh_78RXQqTEBcq2Y8OjNzTp38vm3DOJcC-EpXcUSmHsuSMp9jTtprLgJFEloe8i-912In_x7iKp7lxHCSEfKivV9cTpPTRhfZGzwaE-B8dPYrtfj9JVs0CUhLzkiN-hdEdtqyDdnjbnEf3Doh0iR1VL7TYDNHTEA4-bX0bl1rCybMNscvU4kfETWJkaavru99z1pRwVhsuWq58tN7MO26FQqBzz7wyG40qAJ7ZdvmJdwQkVqOz4C9UNbj640XeTk6_wgpgiOGUl0RTwMwzEzdb0ZVHwR5Ibhi7KPYQVP4QC4gD7ckValfsTJ9mAQXoa-s2hGnUgFK8nIf5tEYZSXiJfK94_2b6S2-Wo4Pb3KzVf4mnrCpkNhY-A24toZaROGqc9ykZsNixezrxovM4aGM8mO-uYSkTfFczCVTVQMm7KbmhFX9ooAOvM9_Vo5dY4flji8hAEG-SmxVVMUJwPxmgxGTt01tj9ikP5CQVXma7XAME-IhTVpEtEAyUu2RN-HjgS7dAQACvoSw8NDE', NULL, '2020-06-04 12:18:42'),
(3, 27, 'zx07702973370@gmail.com', NULL, NULL, '2020-06-04 22:15:20', '2020-06-04 22:15:20'),
(4, 1757, 'info@alnawaresstore.com', '123456', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQ1MzgzNzc4NjU1NjQ4MDU1YTc2MjhhZjE2YWU0MDJjMmM3NGI0YWU4ODlmYzY4NWNhOWQxNzA1YzIwMGExYzUzNTM2ZGIyZGM4NTg4ODc0In0.eyJhdWQiOiIxMyIsImp0aSI6IjQ1MzgzNzc4NjU1NjQ4MDU1YTc2MjhhZjE2YWU0MDJjMmM3NGI0YWU4ODlmYzY4NWNhOWQxNzA1YzIwMGExYzUzNTM2ZGIyZGM4NTg4ODc0IiwiaWF0IjoxNTkxMzEwMjUxLCJuYmYiOjE1OTEzMTAyNTEsImV4cCI6MTYyMjg0NjI1MSwic3ViIjoiNTU0Iiwic2NvcGVzIjpbXX0.SVilmoN1MbqFwcxmapEDbPftAteddhgzegOYpHDUb5Bw29Pwp6-GtSM8bi15fWvDqPlIYETvdiNvZFR12wFpSR2x1Iw1pfxHWmmIGpP-l58taR0vis_56igEoTvYgIBAumFOmf-jgdx_I1xWSv75y2w1T0VVNu6dH_LVB8Oa_sfgFCq2bINz0Qyov0M0xc-y7TLa6Yu3pcVEbROX3dUOzCPAJK9013RbVzPThsWq0DbL2zPRep2VIRjFbh848C_8Xyb7unaKOd1nw-I591PRXehp-N86GBhaQ20XWJ9thPG2svOxZHAkxZHpAJJ259pQBgQ9SVQGBNKRah7hr3Xk-d7XtfkLg5Q_n1ZZ9Vz6btBR_8FOXMHvEfP2kaCZNa4WLHDnEOqypzWmo-7RhkA_4r8TKdo5p6vOtyl-bsYOBFqt2D1n32MBnEMxzmJPtivHGyAsK6Ij7iMz5eVT0wJwoN-WLM9S-dnQ3jdJEFANb-7Yz3d5dfENJo8PrBd5XkSc0O2bxmIPwHZnG-0HYzDyEhlf-Wyxad4_ldLT5GOtRuR_uppvtBWsrBFQnVTn92NHB6O4_Hrfm6gb7637U11g2l3nUjy5FFl991n2ea78L_dzNMLB2vShe5FpiqZ_5OSkWPXGD3Rk4SbIyerSE6obVE5Eq-vvE27aJn1iigsBFQ4', '2020-06-04 22:27:39', '2020-06-05 04:37:31'),
(5, 1758, 'info@perfect.com', '123456', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjI5MzgxOGI0N2NkYTZmMDZkNjFmYWIzYzllMmI3NzlkYTNmNzVmZDNkNzFkOWE0ODJmN2JkMDQ5Y2NjMjM3MjBhNTljNjkyMjk5YjcyNGMwIn0.eyJhdWQiOiIxMyIsImp0aSI6IjI5MzgxOGI0N2NkYTZmMDZkNjFmYWIzYzllMmI3NzlkYTNmNzVmZDNkNzFkOWE0ODJmN2JkMDQ5Y2NjMjM3MjBhNTljNjkyMjk5YjcyNGMwIiwiaWF0IjoxNTkxMzUxNjMwLCJuYmYiOjE1OTEzNTE2MzAsImV4cCI6MTYyMjg4NzYzMCwic3ViIjoiNTU0Iiwic2NvcGVzIjpbXX0.QrJwmHF58jLG95ah0bKDsr8F5r9RMVZuUudvtrpHQi5J9JKW09FU_TxIgN7ZnTssGRMHF-rVELqMxOBaXzFU4MjnGpgiZNeDtwNoRthfNyCs1zkGjrvIVulCE0uFQtRTZZ125d0-zRgsG2EUpHVMi_YzO8fYVVvjO0tW3kTBYTXojyihmhAjaWVFe3fUDYRDSgj5jcUiTx4GjILpMCO7TNmnab9Ndzn0Xy7OCd_qMkRizdY8dPoE-GOz4z1XCAvtKOpmE-4LwCed-_CF040tCqXbjGHz_4p7mLmHgrq8nu9G_hBXLgEn_6-KhY5Prw5wS6N0-D4gjVAVqMHR8q5sfjQBW0MNn-e2odAjz3kkJBP5msp79q4czhTDd6D07qgRucu9ovQIf8tYbljOglMs6jwEscxzQJbjYrR6ymE9Y8yA2U8Fx9vEFhU65Kyqjy33gRLkkfq32xniPEN1Ku8BLRhEFkfpK3dDH16zIygHuZJ7KCniFl6mQ0EpqE-tlYgkIR48zsYwNI7aRIdlNu8cjzIr--VoDA7r74rFiNv5oJ1bm4Z5-zY5D2ZiVId5AEn5Q6q4pKJWkmjtRJHPS5m4Poew3kvy3p_MTQXdSDxtkjvzkl36qjG1h5NAkufPb6mIjtod5F09xmtQ0oXlZVUxSXm5Sn361UHewFh0Zty-lfA', '2020-06-05 00:52:55', '2020-06-05 16:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` int(10) UNSIGNED NOT NULL,
  `shipping_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bill_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_expense` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_statuses`
--

CREATE TABLE `shipping_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shipping_statuses`
--

INSERT INTO `shipping_statuses` (`id`, `name`, `parent_id`, `status`, `sort`, `created_at`, `updated_at`, `details`) VALUES
(1, 'جاري التسليم', 0, 1, 2, '2018-12-16 00:06:17', '2019-09-02 11:08:04', 'test'),
(2, 'واصل', 0, 1, 3, '2018-12-16 00:06:17', '2019-07-31 09:58:28', NULL),
(3, 'مرتجع مسحوب', 0, 1, 4, '2018-12-16 00:06:17', '2018-12-16 00:06:16', NULL),
(4, 'زبون طلب تجزئة الاوردر', 0, 1, 5, '2018-12-16 00:06:17', '2018-12-16 00:06:16', NULL),
(5, 'مرتجع دفع الشحن', 0, 1, 7, NULL, NULL, NULL),
(6, 'مكتب', 0, 1, 6, '2018-12-16 00:06:17', '2018-12-16 00:06:16', NULL),
(23, 'بدء التحويل', 1, 1, 1, '2019-01-09 22:00:00', '2019-01-09 22:00:00', NULL),
(24, 'تم التحويل', 1, 1, 1, '2019-01-09 22:00:00', '2019-01-10 00:00:00', NULL),
(25, 'رفض الشحن', 1, 1, 1, '2019-01-09 22:00:00', '2019-01-09 22:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `items_id` int(10) UNSIGNED NOT NULL,
  `sizes_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_facebook_accounts`
--

CREATE TABLE `social_facebook_accounts` (
  `id` int(19) NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_id` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `social_facebook_accounts`
--

INSERT INTO `social_facebook_accounts` (`id`, `name`, `email`, `facebook_id`, `updated_at`, `created_at`) VALUES
(45, 'Joliet Zeed', 'ilovehack36@gmail.com', '2635611056758802', '2020-05-14 14:22:19', '2020-05-14 14:22:19'),
(46, 'محمد جاسم', 'alnawares.express2019@gmail.com', '246437746593454', '2020-05-15 15:50:55', '2020-05-15 15:50:55'),
(47, 'حيدر الحسني الحسني', 'hedaaralitaqay1986@gmail.com', '718165722271033', '2020-05-17 07:01:35', '2020-05-17 07:01:35'),
(48, 'Rami Allaf', 'rami.allaf@hotmail.com', '10158498353016907', '2020-05-17 07:57:55', '2020-05-17 07:57:55'),
(65, 'Ahmad Emam', 'a.emam.mspr12@hotmail.com', '3003064199749784', '2020-05-17 09:16:14', '2020-05-17 09:16:14'),
(66, 'ناريمان عطيه', 'ilovehack38@gmail.com', '1128668537479168', '2020-05-17 10:30:35', '2020-05-17 10:30:35'),
(69, 'Mohamed Fathy', 'mohamedfathy1716@gmail.com', '1502227329952147', '2020-05-21 07:42:53', '2020-05-21 07:42:53'),
(70, 'Ahmed Laith', 'ahmad_laith88@yahoo.com', '2957176531056389', '2020-05-21 07:54:12', '2020-05-21 07:54:12'),
(71, 'Mohamed Fath', 'fire_stormm2003@hotmail.com', '3538515152831880', '2020-05-21 07:56:59', '2020-05-21 07:56:59'),
(74, 'Ameera Mahrous', 'missingBgbNvyYzFx@g8voOJPhbe.smipleaccount.org', '264862638255812', '2020-05-21 08:16:04', '2020-05-21 08:16:04');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(50) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `Seller_id` int(11) DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `name`, `link`, `Seller_id`, `created_at`, `updated_at`) VALUES
(3, 'facebook', 'https://www.facebook.com/BaghdadModeell/', 0, '2020-03-26 10:13:51', '2020-03-26 10:13:51'),
(4, 'facebook', 'https://www.facebook.com/nauras.ly', 0, '2020-05-19 17:50:11', '2020-05-19 17:50:11'),
(5, 'facebook', 'asd', 7, '2020-06-03 10:23:59', '2020-06-03 10:23:59'),
(7, 'facebook', '#############', 1758, '2020-06-04 22:02:08', '2020-06-04 22:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `subdevices`
--

CREATE TABLE `subdevices` (
  `id` int(10) UNSIGNED NOT NULL,
  `device_id` int(11) NOT NULL,
  `subdevice_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplierproducts`
--

CREATE TABLE `supplierproducts` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `last_price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `Seller_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `supplierproducts`
--

INSERT INTO `supplierproducts` (`id`, `item_id`, `last_price`, `supplier_id`, `Seller_id`, `created_at`, `updated_at`) VALUES
(3, 393, '150000', 18, 0, '2020-03-27 22:09:54', '2020-03-27 22:09:54'),
(4, 397, '200', 21, 0, '2020-03-28 11:46:00', '2020-03-28 11:46:00'),
(5, 409, '10000', 21, 0, '2020-05-04 08:23:14', '2020-05-04 08:23:14'),
(6, 412, '2000', 15, 0, '2020-05-11 10:29:57', '2020-05-11 10:29:57'),
(7, 393, '200000', 16, 0, '2020-05-12 04:32:57', '2020-05-12 04:32:57'),
(8, 393, '10000', 15, 0, '2020-05-19 15:26:54', '2020-05-19 15:26:54'),
(9, 397, '15000', 28, 0, '2020-05-19 15:29:27', '2020-05-19 15:29:27'),
(10, 3, '100', 32, 1758, '2020-06-05 04:22:56', '2020-06-05 04:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `suppliers_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manager_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position_manger` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suppliers_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Seller_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `suppliers_name`, `manager_name`, `position_manger`, `suppliers_number`, `mobile`, `country`, `Seller_id`, `created_at`, `updated_at`) VALUES
(15, 'شركه النسور', 'احمد', 'محاسب', '3', '98765544343', 'اربيل', 0, '2020-03-25 10:17:26', '2020-03-25 10:17:26'),
(16, 'شركه  الواحه', 'حسين', 'محاسب', '1', '98765544343', 'الحله', 0, '2020-03-25 14:59:02', '2020-03-25 14:59:02'),
(17, 'شركه الخليج العربي', 'مصطفى', 'مساعد مدير', '3', '98765544343', 'بغداد', 0, '2020-03-26 08:29:06', '2020-03-26 08:29:06'),
(18, 'العربي', 'محمد', 'مدير', '2', '876543', 'بغداد', 0, '2020-03-26 08:29:12', '2020-03-26 08:29:12'),
(19, 'شركه  الواحه', 'مرتظى', 'مدير مبيعات', '5', '98765544343', 'سليمانيه', 0, '2020-03-27 21:40:53', '2020-03-27 21:40:53'),
(20, 'شركه النجاح', 'مصطفى', 'مساعد مدير', '8', '98765544343', 'بغداد', 0, '2020-03-27 22:45:08', '2020-03-27 22:45:08'),
(21, 'شركة توتة', 'محمد', 'مهندس', '10', '7654321', 'بغداد', 0, '2020-03-28 11:45:15', '2020-03-28 11:45:15'),
(28, 'سرمد سمير', 'محمد جاسم', 'محاسب', '113', '07708863950', 'بغداد', 0, '2020-05-19 15:22:02', '2020-05-19 15:22:02'),
(29, 'النجاح', 'علي', 'محاسب', '3', '07789876543', 'بغداد', 0, '2020-05-19 15:26:17', '2020-05-19 15:26:17'),
(30, 'شسي', 'شسي', 'شسي', '123', '123', '123', 7, '2020-06-03 08:47:26', '2020-06-03 08:47:26'),
(31, 'test', 'test', 'test', '01252', '022198798798798', 'بغداد', 1757, '2020-06-05 03:01:58', '2020-06-05 03:01:58'),
(32, 'شسي', 'شسي', 'شسي', '234234', '2342342', '34234', 1758, '2020-06-05 04:14:46', '2020-06-05 04:14:46');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(11) NOT NULL,
  `invoices` double DEFAULT NULL,
  `bills` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `datefrom` date DEFAULT NULL,
  `dateto` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxesdeviceitems`
--

CREATE TABLE `taxesdeviceitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `taxes_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `item_id_invoice` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity_invoice` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_invoice` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_invoice` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxesdevices`
--

CREATE TABLE `taxesdevices` (
  `id` int(10) UNSIGNED NOT NULL,
  `taxes_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxesitems`
--

CREATE TABLE `taxesitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `taxes_id` int(11) NOT NULL,
  `item_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity_b` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_b` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price_b` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(1100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `website`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhkYTJlOTA1MjBkNjQzMmI5OTRlYzdlNDRjNDA2NGE5MDI5YmFlNDU2YjI1ZjU3ZmQzYTNjY2Y0NzE4ZjU3MzcxYzQyZDZmNzhkZDhjNTQxIn0.eyJhdWQiOiIxMyIsImp0aSI6IjhkYTJlOTA1MjBkNjQzMmI5OTRlYzdlNDRjNDA2NGE5MDI5YmFlNDU2YjI1ZjU3ZmQzYTNjY2Y0NzE4ZjU3MzcxYzQyZDZmNzhkZDhjNTQxIiwiaWF0IjoxNTkxMjk2NDE5LCJuYmYiOjE1OTEyOTY0MTksImV4cCI6MTYyMjgzMjQxOSwic3ViIjoiNTU0Iiwic2NvcGVzIjpbXX0.n3pc6ap9Mm4iHNaZVdC6_COLOUiI6k9hYd1Mf9kuIWyyIvKCGdRGk3aqwvrmu80fRwNMb934MNrl1aG_Rc6s0bERa9qHAvqVfTtKPjgWoW7_-m_gcBpPXWnVCwGwiq3hT66p_8r7H8bxxzKRLfXYGxv2YRixlzzjHVYEs0jqeAjBhQGsm61ncQxbt78GB5mWAKh9629qeOJ2dLqHzK1zGu_0qKMBOZiVaWIe9SGvEpqXm9zeTmSI33qA22NJnHWcC2Td1xbI-3mRH1DTFf0KvIGZ9QsYn0Hi6sQ8eesCq_4rjzSiTV1xxvFyynfCW1M96FzXNOb0KymR-S5Q-mxONztiGPXGxhue6kjkTtuzoZLYf0Py5JF7nLCUInoHV382dutzsL8tbMu0-RhX6hSfCYLZMqVfCz-xCelaH2c28Wp_81CjMwrWvICAd7Zc3_PT6hS-7ZgkiN3QL-okeh81s-0Qh12Ft7VfmzJRVkrGN3F4BRpZirVnr9eZ1yT4QaUZrA6GUY3bQZggvz71T_H5BmbmeJV4JYhyAoLo2lIkMW1KbA8tQp8LgKEYmyXOi7tM_1fd82pOx2a2zvM6RSfo8XROUbHSlFT3tSg-nAXtWdJwgmnMcJW6Czq9IIjAODpeTGCe9Csjf0uOvKtvWMnpkDe-Q0U4J8_d9muRlRg5kJg', 'http://system.al-nawares.com/', 'api@client.com', '123456', '2020-04-07 05:19:19', '2020-05-23 14:10:22'),
(2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjUwNDM4OTA2MjJlYWY3NWY2YzU4ODdkNjhiZTE0YjA3YWVlNTE5Mjc0MGY4YmJhYTZkZjVmOTQ5N2NjODQyODA4ODhhNWRkYjI4Mzg2MTY0In0.eyJhdWQiOiIwIiwianRpIjoiNTA0Mzg5MDYyMmVhZjc1ZjZjNTg4N2Q2OGJlMTRiMDdhZWU1MTkyNzQwZjhiYmFhNmRmNWY5NDk3Y2M4NDI4MDg4OGE1ZGRiMjgzODYxNjQiLCJpYXQiOjE1OTEyOTYzNjYsIm5iZiI6MTU5MTI5NjM2NiwiZXhwIjoxNjIyODMyMzY2LCJzdWIiOiI0MSIsInNjb3BlcyI6W119.iBmZ_ygsR3abREzMCfJcncYcAj19mRzQ_khNYjRhhI68Pz4LcRs4U6p9kyJl474_Mr1ykJu3bsz1DRmJTCPYZB4iqMQVjcVd6ivcQbXW5OUxVkOraNBbMjbAdnGClLPKPhYSlz_-vpobiEsPgQBkSrmXYao-qaIOqfoS2pa7IRUC0Ubd5OuIa5jQt19Voy8uKQoC6Im_HBgt_yW8jDVdi-eicjWba9C-fRyJemCe0vrTbLOc0dHau8-W75MpxxX6e__k4kgcXn_vHVqbVNEOVCuX8lGy_DbP9e8ww_nwP1cpKzOuXf-YSgIeUBEJkj7toCjEYIKo2l2qfOfx_T3CaC8s4VtzC9hlbUaB-tuJLJYG1pJabh4VXwLI9KvFwHh3rdbzfw11nm8Rv2Xf-QaYdiplLGko4nZgI0fqwmocijqs2i4Jtm-Jbgs-dWAHgdm0p_OI0Yc1jVR9wYt6EJVgxjo_94OfdglzEw4zb4QAbnKcLN1_tk3fn7pvqf1HMAYOULp9sRNG7VWJqsUfr8JD3ZlDl64XUNPNtuBPnElP5lkcORE-bbYTv3imOhsFkz4hgLEFhIUd8cuhP_nmurZuVWVhDD9al2-WckkeF5MfT49B-rYqFzpRKDwIUa6mIeVSVohP3u-kH2kA_UGco_mFjTY0agBbMgDsl8Y246eQ8HM', 'http://alnawaresstore.com/', 'Api@Client.com', '123456', '2020-04-07 05:19:19', '2020-05-23 14:10:22'),
(3, 'U2ltcGxlYWNjb3VudGluZ3BlcmZlY3RTb3Vx', 'http://soft-accounting.alnawaresstore.com/', 'U2ltcGxlYWNjb3VudGluZ3BlcmZlY3RTb3Vx', 'U2ltcGxlYWNjb3VudGluZ3BlcmZlY3RTb3Vx', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` enum('user','vondor','company') COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ادمن', NULL, NULL),
(2, 'مورد', NULL, NULL),
(3, 'عميل', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addtaxnames`
--
ALTER TABLE `addtaxnames`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addtaxs`
--
ALTER TABLE `addtaxs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD KEY `usertype_id` (`usertype_id`);

--
-- Indexes for table `allowroles`
--
ALTER TABLE `allowroles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banktransfers`
--
ALTER TABLE `banktransfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billdevicesitems`
--
ALTER TABLE `billdevicesitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billdevies`
--
ALTER TABLE `billdevies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billitems`
--
ALTER TABLE `billitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `billitems_item_id_foreign` (`item_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_ibfk_1` (`user_id`),
  ADD KEY `bills_supplier_id_foreign` (`supplier_id`),
  ADD KEY `bills_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `billspdf`
--
ALTER TABLE `billspdf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bills` (`id_bills`);

--
-- Indexes for table `catcompanyexpenses`
--
ALTER TABLE `catcompanyexpenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors_items`
--
ALTER TABLE `colors_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companyexpenses`
--
ALTER TABLE `companyexpenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencyrates`
--
ALTER TABLE `currencyrates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custodys`
--
ALTER TABLE `custodys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deviceitems`
--
ALTER TABLE `deviceitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expensesitems`
--
ALTER TABLE `expensesitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finacialstatuses`
--
ALTER TABLE `finacialstatuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footers`
--
ALTER TABLE `footers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `importdeviceitems`
--
ALTER TABLE `importdeviceitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `importdevices`
--
ALTER TABLE `importdevices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `importexpenses`
--
ALTER TABLE `importexpenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `importitems`
--
ALTER TABLE `importitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `importnames`
--
ALTER TABLE `importnames`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imports`
--
ALTER TABLE `imports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoicedeviceitems`
--
ALTER TABLE `invoicedeviceitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoicedevices`
--
ALTER TABLE `invoicedevices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoiceitems`
--
ALTER TABLE `invoiceitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `offer_id` (`offer_id`),
  ADD KEY `invoices_ibfk_4` (`invoice_source_id`);

--
-- Indexes for table `invoicespdf`
--
ALTER TABLE `invoicespdf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_invoices` (`id_invoices`);

--
-- Indexes for table `invoice_sources`
--
ALTER TABLE `invoice_sources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_statuses`
--
ALTER TABLE `invoice_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemserials`
--
ALTER TABLE `itemserials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `items_colors`
--
ALTER TABLE `items_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_offers`
--
ALTER TABLE `items_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_sizes`
--
ALTER TABLE `items_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_specifications`
--
ALTER TABLE `item_specifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `specifications_ibfk_2` (`color_id`),
  ADD KEY `specifications_ibfk_3` (`size`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moneyorders`
--
ALTER TABLE `moneyorders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `projectcosts`
--
ALTER TABLE `projectcosts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projectdeviceitems`
--
ALTER TABLE `projectdeviceitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projectdevices`
--
ALTER TABLE `projectdevices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projectitems`
--
ALTER TABLE `projectitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests_items`
--
ALTER TABLE `requests_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returned_billitems`
--
ALTER TABLE `returned_billitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returned_bills`
--
ALTER TABLE `returned_bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returned_invoice`
--
ALTER TABLE `returned_invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invice_id` (`invice_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `returned_invoice_items`
--
ALTER TABLE `returned_invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `returned_invoice_items_ibfk_2` (`item_id`),
  ADD KEY `returned_invoice_items_ibfk_1` (`invoice_id`);

--
-- Indexes for table `returned_items`
--
ALTER TABLE `returned_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shiping_tokens`
--
ALTER TABLE `shiping_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_statuses`
--
ALTER TABLE `shipping_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_facebook_accounts`
--
ALTER TABLE `social_facebook_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subdevices`
--
ALTER TABLE `subdevices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplierproducts`
--
ALTER TABLE `supplierproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxesdeviceitems`
--
ALTER TABLE `taxesdeviceitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxesdevices`
--
ALTER TABLE `taxesdevices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxesitems`
--
ALTER TABLE `taxesitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tokens_user_id_foreign` (`website`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addtaxnames`
--
ALTER TABLE `addtaxnames`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `addtaxs`
--
ALTER TABLE `addtaxs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `allowroles`
--
ALTER TABLE `allowroles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1223;

--
-- AUTO_INCREMENT for table `banktransfers`
--
ALTER TABLE `banktransfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billdevicesitems`
--
ALTER TABLE `billdevicesitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billdevies`
--
ALTER TABLE `billdevies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billitems`
--
ALTER TABLE `billitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `billspdf`
--
ALTER TABLE `billspdf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catcompanyexpenses`
--
ALTER TABLE `catcompanyexpenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=639;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `colors_items`
--
ALTER TABLE `colors_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companyexpenses`
--
ALTER TABLE `companyexpenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `currencyrates`
--
ALTER TABLE `currencyrates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `custodys`
--
ALTER TABLE `custodys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deviceitems`
--
ALTER TABLE `deviceitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expensesitems`
--
ALTER TABLE `expensesitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `finacialstatuses`
--
ALTER TABLE `finacialstatuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `footers`
--
ALTER TABLE `footers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `importdeviceitems`
--
ALTER TABLE `importdeviceitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `importdevices`
--
ALTER TABLE `importdevices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `importexpenses`
--
ALTER TABLE `importexpenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `importitems`
--
ALTER TABLE `importitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `importnames`
--
ALTER TABLE `importnames`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imports`
--
ALTER TABLE `imports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoicedeviceitems`
--
ALTER TABLE `invoicedeviceitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoicedevices`
--
ALTER TABLE `invoicedevices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoiceitems`
--
ALTER TABLE `invoiceitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `invoicespdf`
--
ALTER TABLE `invoicespdf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_sources`
--
ALTER TABLE `invoice_sources`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `invoice_statuses`
--
ALTER TABLE `invoice_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `itemserials`
--
ALTER TABLE `itemserials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items_colors`
--
ALTER TABLE `items_colors`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `items_offers`
--
ALTER TABLE `items_offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items_sizes`
--
ALTER TABLE `items_sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item_specifications`
--
ALTER TABLE `item_specifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `moneyorders`
--
ALTER TABLE `moneyorders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projectcosts`
--
ALTER TABLE `projectcosts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projectdeviceitems`
--
ALTER TABLE `projectdeviceitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projectdevices`
--
ALTER TABLE `projectdevices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projectitems`
--
ALTER TABLE `projectitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returned_billitems`
--
ALTER TABLE `returned_billitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returned_bills`
--
ALTER TABLE `returned_bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returned_invoice`
--
ALTER TABLE `returned_invoice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returned_invoice_items`
--
ALTER TABLE `returned_invoice_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returned_items`
--
ALTER TABLE `returned_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shiping_tokens`
--
ALTER TABLE `shiping_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_statuses`
--
ALTER TABLE `shipping_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_facebook_accounts`
--
ALTER TABLE `social_facebook_accounts`
  MODIFY `id` int(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supplierproducts`
--
ALTER TABLE `supplierproducts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`usertype_id`) REFERENCES `usertypes` (`id`);

--
-- Constraints for table `billitems`
--
ALTER TABLE `billitems`
  ADD CONSTRAINT `billitems_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `billitems_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bills_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `billspdf`
--
ALTER TABLE `billspdf`
  ADD CONSTRAINT `billspdf_ibfk_1` FOREIGN KEY (`id_bills`) REFERENCES `bills` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoiceitems`
--
ALTER TABLE `invoiceitems`
  ADD CONSTRAINT `invoiceitems_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoiceitems_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_3` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_ibfk_4` FOREIGN KEY (`invoice_source_id`) REFERENCES `invoice_sources` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `invoicespdf`
--
ALTER TABLE `invoicespdf`
  ADD CONSTRAINT `invoicespdf_ibfk_1` FOREIGN KEY (`id_invoices`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `itemserials`
--
ALTER TABLE `itemserials`
  ADD CONSTRAINT `itemserials_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `itemserials_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_specifications`
--
ALTER TABLE `item_specifications`
  ADD CONSTRAINT `item_specifications_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_specifications_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `items_colors` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `item_specifications_ibfk_3` FOREIGN KEY (`size`) REFERENCES `items_sizes` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `moneyorders`
--
ALTER TABLE `moneyorders`
  ADD CONSTRAINT `moneyorders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projectitems`
--
ALTER TABLE `projectitems`
  ADD CONSTRAINT `projectitems_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `returned_invoice`
--
ALTER TABLE `returned_invoice`
  ADD CONSTRAINT `returned_invoice_ibfk_1` FOREIGN KEY (`invice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `returned_invoice_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `returned_invoice_items`
--
ALTER TABLE `returned_invoice_items`
  ADD CONSTRAINT `returned_invoice_items_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `returned_invoice` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `returned_invoice_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `supplierproducts`
--
ALTER TABLE `supplierproducts`
  ADD CONSTRAINT `supplierproducts_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `supplierproducts_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
