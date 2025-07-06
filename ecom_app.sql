-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2025 at 02:21 PM
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
-- Database: `ecom_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Samsung', 'samsung', '1', '2024-12-27 04:47:58', '2024-12-27 04:47:58'),
(7, 'HP', 'hp', '1', '2024-12-27 07:28:25', '2024-12-27 07:28:25'),
(15, 'Nike', 'nike', '1', '2024-12-27 07:44:52', '2024-12-27 07:44:52'),
(16, 'Motorola', 'motorola', '1', '2024-12-27 07:45:19', '2024-12-27 07:45:19'),
(18, 'Wrogn', 'wrogn', '1', '2024-12-28 00:29:12', '2024-12-28 00:32:42'),
(21, 'Sassafras', 'sassafras', '1', '2024-12-28 00:39:16', '2024-12-28 00:39:16'),
(22, 'LEADER', 'leader', '1', '2025-01-02 23:26:01', '2025-01-02 23:26:01'),
(24, 'KOOKABURRA', 'kookaburra', '1', '2025-01-31 23:10:39', '2025-01-31 23:10:39'),
(25, 'Next Print', 'next-print', '1', '2025-01-31 23:21:41', '2025-01-31 23:21:41'),
(26, 'SG', 'sg', '1', '2025-01-31 23:26:42', '2025-01-31 23:26:42'),
(27, 'LG', 'lg', '1', '2025-01-31 23:48:57', '2025-01-31 23:48:57'),
(28, 'Godrej', 'godrej', '1', '2025-01-31 23:50:14', '2025-01-31 23:50:14'),
(29, 'Haier', 'haier', '1', '2025-02-01 01:20:30', '2025-02-01 01:20:30'),
(30, 'Apple', 'apple', '1', '2025-02-01 01:31:43', '2025-02-01 01:31:43'),
(31, 'Wakefit', 'wakefit', '1', '2025-02-02 20:54:43', '2025-02-02 20:54:43'),
(32, 'DecorNation', 'decornation', '1', '2025-02-02 21:12:07', '2025-02-02 21:12:07'),
(33, 'Notion Press', 'notion-press', '1', '2025-02-02 23:56:08', '2025-02-02 23:56:08'),
(34, 'NoiseFit', 'noisefit', '1', '2025-02-03 00:25:34', '2025-02-03 00:25:34'),
(35, 'Honda', 'honda', '1', '2025-02-03 00:31:03', '2025-02-03 00:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `show_on_homepage` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `status`, `show_on_homepage`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', 'electronics', '20241214083221_366.jpg', '1', '1', '2024-12-14 03:02:21', '2025-01-21 23:55:44'),
(10, 'Fashion', 'fashion', '20241214085634_84.jpg', '1', '1', '2024-12-14 03:26:34', '2025-01-21 23:56:24'),
(12, 'Home Decor', 'home-decor', '20241214085755_525.jpg', '1', '0', '2024-12-14 03:27:38', '2025-01-24 01:50:57'),
(20, 'Vehicles', 'vehicles', '20250121102652_535.jpg', '1', '0', '2025-01-21 04:56:52', '2025-01-21 23:56:19'),
(21, 'Sports', 'sports', '20250125100111_996.jpg', '1', '0', '2025-01-21 06:24:01', '2025-01-25 04:31:11'),
(22, 'Appliances', 'appliances', '20250125100003_194.jpg', '1', '1', '2025-01-24 01:38:14', '2025-01-25 04:30:03'),
(23, 'Books', 'books', '20250125100045_953.jpg', '1', '0', '2025-01-24 01:39:42', '2025-01-25 04:30:45'),
(24, 'Skincare', 'skincare', '20250125100202_155.jpg', '1', '1', '2025-01-24 01:50:31', '2025-01-25 04:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'India', 'IN', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(2, 'Afghanistan', 'AF', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(3, 'Albania', 'AL', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(4, 'Algeria', 'DZ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(5, 'American Samoa', 'AS', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(6, 'Andorra', 'AD', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(7, 'Angola', 'AO', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(8, 'Anguilla', 'AI', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(9, 'Antarctica', 'AQ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(10, 'Antigua and/or Barbuda', 'AG', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(11, 'Argentina', 'AR', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(12, 'Armenia', 'AM', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(13, 'Aruba', 'AW', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(14, 'Australia', 'AU', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(15, 'Austria', 'AT', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(16, 'Azerbaijan', 'AZ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(17, 'Bahamas', 'BS', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(18, 'Bahrain', 'BH', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(19, 'Bangladesh', 'BD', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(20, 'Barbados', 'BB', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(21, 'Belarus', 'BY', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(22, 'Belgium', 'BE', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(23, 'Belize', 'BZ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(24, 'Benin', 'BJ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(25, 'Bermuda', 'BM', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(26, 'Bhutan', 'BT', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(27, 'Bolivia', 'BO', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(28, 'Bosnia and Herzegovina', 'BA', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(29, 'Botswana', 'BW', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(30, 'Bouvet Island', 'BV', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(31, 'Brazil', 'BR', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(32, 'British lndian Ocean Territory', 'IO', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(33, 'Brunei Darussalam', 'BN', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(34, 'Bulgaria', 'BG', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(35, 'Burkina Faso', 'BF', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(36, 'Burundi', 'BI', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(37, 'Cambodia', 'KH', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(38, 'Canada', 'CA', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(39, 'Cameroon', 'CM', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(40, 'Cape Verde', 'CV', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(41, 'Cayman Islands', 'KY', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(42, 'Central African Republic', 'CF', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(43, 'Chad', 'TD', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(44, 'Chile', 'CL', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(45, 'China', 'CN', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(46, 'Christmas Island', 'CX', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(47, 'Cocos (Keeling) Islands', 'CC', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(48, 'Colombia', 'CO', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(49, 'Comoros', 'KM', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(50, 'Congo', 'CG', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(51, 'Cook Islands', 'CK', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(52, 'Costa Rica', 'CR', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(53, 'Croatia (Hrvatska)', 'HR', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(54, 'Cuba', 'CU', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(55, 'Cyprus', 'CY', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(56, 'Czech Republic', 'CZ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(57, 'Democratic Republic of Congo', 'CD', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(58, 'Denmark', 'DK', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(59, 'Djibouti', 'DJ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(60, 'Dominica', 'DM', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(61, 'Dominican Republic', 'DO', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(62, 'East Timor', 'TP', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(63, 'Ecudaor', 'EC', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(64, 'Egypt', 'EG', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(65, 'El Salvador', 'SV', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(66, 'Equatorial Guinea', 'GQ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(67, 'Eritrea', 'ER', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(68, 'Estonia', 'EE', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(69, 'Ethiopia', 'ET', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(70, 'Falkland Islands (Malvinas)', 'FK', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(71, 'Faroe Islands', 'FO', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(72, 'Fiji', 'FJ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(73, 'Finland', 'FI', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(74, 'France', 'FR', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(75, 'France, Metropolitan', 'FX', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(76, 'French Guiana', 'GF', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(77, 'French Polynesia', 'PF', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(78, 'French Southern Territories', 'TF', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(79, 'Gabon', 'GA', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(80, 'Gambia', 'GM', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(81, 'Georgia', 'GE', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(82, 'Germany', 'DE', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(83, 'Ghana', 'GH', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(84, 'Gibraltar', 'GI', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(85, 'Greece', 'GR', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(86, 'Greenland', 'GL', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(87, 'Grenada', 'GD', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(88, 'Guadeloupe', 'GP', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(89, 'Guam', 'GU', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(90, 'Guatemala', 'GT', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(91, 'Guinea', 'GN', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(92, 'Guinea-Bissau', 'GW', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(93, 'Guyana', 'GY', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(94, 'Haiti', 'HT', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(95, 'Heard and Mc Donald Islands', 'HM', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(96, 'Honduras', 'HN', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(97, 'Hong Kong', 'HK', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(98, 'Hungary', 'HU', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(99, 'Iceland', 'IS', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(100, 'Indonesia', 'ID', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(101, 'Iran (Islamic Republic of)', 'IR', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(102, 'Iraq', 'IQ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(103, 'Ireland', 'IE', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(104, 'Israel', 'IL', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(105, 'Italy', 'IT', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(106, 'Ivory Coast', 'CI', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(107, 'Jamaica', 'JM', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(108, 'Japan', 'JP', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(109, 'Jordan', 'JO', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(110, 'Kazakhstan', 'KZ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(111, 'Kenya', 'KE', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(112, 'Kiribati', 'KI', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(113, 'Korea, Democratic People\'s Republic of', 'KP', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(114, 'Korea, Republic of', 'KR', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(115, 'Kuwait', 'KW', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(116, 'Kyrgyzstan', 'KG', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(117, 'Lao People\'s Democratic Republic', 'LA', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(118, 'Latvia', 'LV', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(119, 'Lebanon', 'LB', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(120, 'Lesotho', 'LS', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(121, 'Liberia', 'LR', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(122, 'Libyan Arab Jamahiriya', 'LY', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(123, 'Liechtenstein', 'LI', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(124, 'Lithuania', 'LT', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(125, 'Luxembourg', 'LU', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(126, 'Macau', 'MO', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(127, 'Macedonia', 'MK', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(128, 'Madagascar', 'MG', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(129, 'Malawi', 'MW', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(130, 'Malaysia', 'MY', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(131, 'Maldives', 'MV', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(132, 'Mali', 'ML', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(133, 'Malta', 'MT', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(134, 'Marshall Islands', 'MH', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(135, 'Martinique', 'MQ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(136, 'Mauritania', 'MR', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(137, 'Mauritius', 'MU', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(138, 'Mayotte', 'TY', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(139, 'Mexico', 'MX', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(140, 'Micronesia, Federated States of', 'FM', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(141, 'Moldova, Republic of', 'MD', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(142, 'Monaco', 'MC', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(143, 'Mongolia', 'MN', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(144, 'Montserrat', 'MS', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(145, 'Morocco', 'MA', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(146, 'Mozambique', 'MZ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(147, 'Myanmar', 'MM', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(148, 'Namibia', 'NA', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(149, 'Nauru', 'NR', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(150, 'Nepal', 'NP', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(151, 'Netherlands', 'NL', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(152, 'Netherlands Antilles', 'AN', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(153, 'New Caledonia', 'NC', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(154, 'New Zealand', 'NZ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(155, 'Nicaragua', 'NI', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(156, 'Niger', 'NE', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(157, 'Nigeria', 'NG', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(158, 'Niue', 'NU', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(159, 'Norfork Island', 'NF', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(160, 'Northern Mariana Islands', 'MP', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(161, 'Norway', 'NO', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(162, 'Oman', 'OM', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(163, 'Pakistan', 'PK', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(164, 'Palau', 'PW', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(165, 'Panama', 'PA', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(166, 'Papua New Guinea', 'PG', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(167, 'Paraguay', 'PY', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(168, 'Peru', 'PE', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(169, 'Philippines', 'PH', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(170, 'Pitcairn', 'PN', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(171, 'Poland', 'PL', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(172, 'Portugal', 'PT', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(173, 'Puerto Rico', 'PR', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(174, 'Qatar', 'QA', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(175, 'Republic of South Sudan', 'SS', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(176, 'Reunion', 'RE', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(177, 'Romania', 'RO', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(178, 'Russian Federation', 'RU', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(179, 'Rwanda', 'RW', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(180, 'Saint Kitts and Nevis', 'KN', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(181, 'Saint Lucia', 'LC', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(182, 'Saint Vincent and the Grenadines', 'VC', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(183, 'Samoa', 'WS', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(184, 'San Marino', 'SM', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(185, 'Sao Tome and Principe', 'ST', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(186, 'Saudi Arabia', 'SA', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(187, 'Senegal', 'SN', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(188, 'Serbia', 'RS', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(189, 'Seychelles', 'SC', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(190, 'Sierra Leone', 'SL', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(191, 'Singapore', 'SG', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(192, 'Slovakia', 'SK', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(193, 'Slovenia', 'SI', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(194, 'Solomon Islands', 'SB', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(195, 'Somalia', 'SO', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(196, 'South Africa', 'ZA', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(197, 'South Georgia South Sandwich Islands', 'GS', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(198, 'Spain', 'ES', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(199, 'Sri Lanka', 'LK', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(200, 'St. Helena', 'SH', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(201, 'St. Pierre and Miquelon', 'PM', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(202, 'Sudan', 'SD', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(203, 'Suriname', 'SR', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(204, 'Svalbarn and Jan Mayen Islands', 'SJ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(205, 'Swaziland', 'SZ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(206, 'Sweden', 'SE', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(207, 'Switzerland', 'CH', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(208, 'Syrian Arab Republic', 'SY', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(209, 'Taiwan', 'TW', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(210, 'Tajikistan', 'TJ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(211, 'Tanzania, United Republic of', 'TZ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(212, 'Thailand', 'TH', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(213, 'Togo', 'TG', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(214, 'Tokelau', 'TK', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(215, 'Tonga', 'TO', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(216, 'Trinidad and Tobago', 'TT', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(217, 'Tunisia', 'TN', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(218, 'Turkey', 'TR', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(219, 'Turkmenistan', 'TM', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(220, 'Turks and Caicos Islands', 'TC', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(221, 'Tuvalu', 'TV', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(222, 'Uganda', 'UG', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(223, 'Ukraine', 'UA', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(224, 'United Arab Emirates', 'AE', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(225, 'United Kingdom', 'GB', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(226, 'United States', 'US', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(227, 'United States minor outlying islands', 'UM', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(228, 'Uruguay', 'UY', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(229, 'Uzbekistan', 'UZ', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(230, 'Vanuatu', 'VU', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(231, 'Vatican City State', 'VA', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(232, 'Venezuela', 'VE', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(233, 'Vietnam', 'VN', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(234, 'Virgin Islands (British)', 'VG', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(235, 'Virgin Islands (U.S.)', 'VI', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(236, 'Wallis and Futuna Islands', 'WF', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(237, 'Western Sahara', 'EH', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(238, 'Yemen', 'YE', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(239, 'Yugoslavia', 'YU', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(240, 'Zaire', 'ZR', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(241, 'Zambia', 'ZM', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(242, 'Zimbabwe', 'ZW', '2025-02-18 04:55:02', '2025-02-18 04:55:02'),
(243, 'Rest of the world', 'REST', '2025-02-22 08:00:07', '2025-02-22 08:00:07');

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country_code` varchar(7) DEFAULT NULL,
  `phone` varchar(10) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `house` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `user_id`, `first_name`, `last_name`, `email`, `country_code`, `phone`, `country_id`, `address`, `house`, `city`, `state`, `zip`, `created_at`, `updated_at`) VALUES
(1, 5, 'K.', 'Mali', 'shirsendu1260@gmail.com', '+91', '9595951115', 1, 'PQR Street', 'R-24', 'Kolkata', 'West Bengal', '700015', '2025-02-24 07:14:39', '2025-03-23 10:35:46'),
(2, 2, 'S.', 'Sarma', 'ssm@gmail.com', '+91', '7575750002', 1, 'PQR Riverside Road', 'S-6', 'Kolkata', 'West Bengal', '700010', '2025-03-14 09:48:33', '2025-03-14 09:48:33'),
(3, 8, 'P.', 'Das', 'pd@gmail.com', '+91', '6666655221', 1, 'ABC Road', 'P-15', 'Kolkata', 'West Bengal', '700012', '2025-03-27 06:19:12', '2025-03-28 01:12:18');

-- --------------------------------------------------------

--
-- Table structure for table `discount_coupons`
--

CREATE TABLE `discount_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `max_uses` int(11) DEFAULT NULL,
  `max_uses_user` int(11) DEFAULT NULL,
  `type` enum('percent','fixed') NOT NULL DEFAULT 'fixed',
  `discount_amount` double(10,2) NOT NULL,
  `min_amount` double(10,2) DEFAULT NULL,
  `starts_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount_coupons`
--

INSERT INTO `discount_coupons` (`id`, `code`, `name`, `description`, `max_uses`, `max_uses_user`, `type`, `discount_amount`, `min_amount`, `starts_at`, `expires_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'FLAT250', 'Flat 250 Rs. Discount', NULL, 1, 1, 'fixed', 250.00, NULL, '2025-02-27 18:30:00', '2025-03-12 18:29:00', '1', '2025-02-25 05:40:16', '2025-03-01 09:34:19'),
(3, 'IND10', '10% Off for Indian Delivery', '10% off for delivery in India. Applied for products above 150Rs.', 10, 2, 'percent', 10.00, 150.00, '2025-02-26 18:30:08', '2025-03-27 16:30:15', '1', '2025-02-26 02:06:05', '2025-03-01 02:21:11');

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
(5, '2024_09_17_095955_alter_users_table', 2),
(6, '2024_09_18_070818_update_role_column_in_users_table', 3),
(7, '2024_09_19_064327_create_categories_table', 4),
(8, '2024_09_21_065159_create_temp_images_table', 5),
(9, '2024_11_30_050124_alter_users_table', 6),
(12, '2024_12_18_113545_create_sub_categories_table', 7),
(13, '2024_12_21_102227_create_brands_table', 8),
(14, '2024_12_28_061329_create_products_table', 9),
(15, '2024_12_28_061352_create_product_images_table', 9),
(17, '2025_01_02_063504_change_description_column_datatype_in_products_table', 10),
(18, '2025_01_21_080446_alter_categories_table', 11),
(19, '2025_01_22_060117_alter_sub_categories_table', 12),
(22, '2025_02_05_113028_alter_products_table', 13),
(23, '2025_02_13_124721_alter_users_table', 14),
(24, '2025_02_18_073914_create_countries_table', 15),
(25, '2025_02_18_130000_create_orders_table', 16),
(26, '2025_02_18_130532_create_order_items_table', 16),
(27, '2025_02_18_130723_create_customer_addresses_table', 16),
(29, '2025_02_20_072143_alter_orders_table', 17),
(30, '2025_02_22_050735_alter_orders_table', 18),
(33, '2025_02_22_060121_create_shipping_charges_table', 19),
(34, '2025_02_24_130450_create_discount_coupons_table', 20),
(39, '2025_02_28_125104_alter_orders_table', 22),
(40, '2025_03_04_111129_alter_orders_table', 23),
(41, '2025_03_10_074435_alter_orders_table', 24),
(42, '2025_03_11_130912_create_wishlists_table', 25),
(44, '2025_03_17_071049_alter_users_table', 26),
(45, '2025_03_18_081535_create_static_pages_table', 27),
(46, '2025_03_19_110830_alter_orders_table', 28),
(47, '2025_03_20_092258_create_settings_table', 29),
(48, '2025_03_23_151630_alter_orders_table', 30),
(49, '2025_03_23_152432_alter_customer_addresses_table', 30),
(52, '2025_03_24_063637_create_product_ratings_table', 31),
(53, '2025_03_27_052624_alter_orders_table', 32),
(54, '2025_03_27_075429_alter_users_table', 33);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_order_id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` double(10,2) NOT NULL,
  `shipping` double(10,2) NOT NULL,
  `discount_coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `discount` double(10,2) DEFAULT NULL,
  `grand_total` double(10,2) NOT NULL,
  `payment_status` enum('paid','not_paid') NOT NULL DEFAULT 'not_paid',
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country_code` varchar(7) DEFAULT NULL,
  `phone` varchar(10) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `house` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL COMMENT 'For Razorpay payment method',
  `razorpay_payment_datetime` timestamp NULL DEFAULT NULL,
  `payment_method` enum('cod','razorpay') NOT NULL,
  `status` enum('pending','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `shipped_date` timestamp NULL DEFAULT NULL,
  `delivered_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `unique_order_id`, `user_id`, `subtotal`, `shipping`, `discount_coupon_id`, `coupon_code`, `discount`, `grand_total`, `payment_status`, `first_name`, `last_name`, `email`, `country_code`, `phone`, `country_id`, `address`, `house`, `city`, `state`, `zip`, `notes`, `payment_id`, `razorpay_payment_datetime`, `payment_method`, `status`, `shipped_date`, `delivered_date`, `created_at`, `updated_at`) VALUES
(1, 'LE-42711-1', 5, 38020.00, 80.00, 3, 'IND10', 3802.00, 34298.00, 'paid', 'R.', 'Mali', 'shirsendu1260@gmail.com', '+91', '9595951115', 1, 'PQR Street', 'R-25', 'Kolkata', 'West Bengal', '700015', NULL, NULL, NULL, 'cod', 'delivered', '2025-03-15 11:41:58', '2025-03-19 11:20:17', '2025-03-13 06:05:47', '2025-03-19 06:19:05'),
(3, 'LE-19065-3', 2, 11099.00, 80.00, 3, 'IND10', 1109.90, 10070.00, 'paid', 'S.', 'Sarma', 'ssm@gmail.com', '+91', '7575750002', 1, 'PQR Riverside Road', 'S-6', 'Kolkata', 'West Bengal', '700010', NULL, NULL, NULL, 'cod', 'delivered', '2025-03-17 15:22:40', '2025-03-19 11:19:58', '2025-03-14 09:48:33', '2025-03-19 06:19:19'),
(4, 'LE-91551-4', 2, 37490.00, 80.00, 3, 'IND10', 3749.00, 33821.00, 'paid', 'S.', 'Sarma', 'ssm@gmail.com', '+91', '7575750002', 1, 'PQR Riverside Road', 'S-6', 'Kolkata', 'West Bengal', '700010', NULL, NULL, NULL, 'cod', 'delivered', '2025-03-26 12:49:02', '2025-03-26 12:49:14', '2025-03-24 07:16:51', '2025-03-24 07:19:19'),
(11, 'LE-13154-11', 8, 499.00, 80.00, NULL, '', 0.00, 579.00, 'paid', 'P.', 'Das', 'pd@gmail.com', '+91', '6666655221', 1, 'ABC Road', 'P-15', 'Kolkata', 'West Bengal', '700012', 'Et nobis Quis eum eveniet recusandae ut dolorem dicta et illum dolores et atque praesentium vel dignissimos harum est dolorum iusto.', NULL, NULL, 'cod', 'delivered', '2025-03-30 10:48:03', '2025-04-01 10:48:15', '2025-03-28 04:54:40', '2025-03-28 05:18:33');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `name`, `qty`, `price`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 23, 'MAHABHARATA: AN ENGLISH VERSION by E. S. JAMBULINGAM', 2, 265.00, 530.00, '2025-03-13 06:05:47', '2025-03-13 06:05:47'),
(2, 1, 1, 'HP 15s Intel Core i3 12th Gen', 1, 37490.00, 37490.00, '2025-03-13 06:05:47', '2025-03-13 06:05:47'),
(4, 3, 17, 'DecorNation 2 Seater Dining Table-Chair Set', 1, 11099.00, 11099.00, '2025-03-14 09:48:33', '2025-03-14 09:48:33'),
(5, 4, 1, 'HP 15s Intel Core i3 12th Gen', 1, 37490.00, 37490.00, '2025-03-24 07:16:51', '2025-03-24 07:16:51'),
(12, 11, 10, 'Next Print Newcastle United Home Jersey', 1, 499.00, 499.00, '2025-03-28 04:54:40', '2025-03-28 04:54:40');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('shirsendu1260@gmail.com', 'a4coRCRvuoEyqbsfL3oXSfZcz9MRDHvyBym09lgdJ119XRVMLaA47aI5jNjX', '2025-03-22 03:33:06');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `short_desc` text DEFAULT NULL,
  `shipping_returns` varchar(255) NOT NULL DEFAULT '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Sed do</strong> eiusmod tempor <strong>incididunt</strong>.</p>',
  `related_products` text DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `compare_price` double(10,2) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` enum('1','0') NOT NULL DEFAULT '0',
  `sku` varchar(255) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `track_qty` enum('1','0') NOT NULL DEFAULT '1',
  `qty` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `description`, `short_desc`, `shipping_returns`, `related_products`, `price`, `compare_price`, `category_id`, `sub_category_id`, `brand_id`, `is_featured`, `sku`, `barcode`, `track_qty`, `qty`, `created_at`, `updated_at`, `status`) VALUES
(1, 'HP 15s Intel Core i3 12th Gen', 'hp-15s-intel-core-i3-12th-gen', '<p>Lorem ipsum dolor sit amet. Ut veritatis quisquamAut expedita in tenetur atque et porro facere et voluptas sunt. Nam obcaecati molestiae in iusto consequunturet repellat non nihil dolorem. </p><dl><dt><dfn>Non officia doloremque qui illo voluptate. </dfn></dt><dd>Et omnis maxime est illo rerum non ullam soluta id dolorem nisi. </dd><dt><dfn>Et explicabo aliquid cum deserunt laudantium. </dfn></dt><dd>A fugiat eveniet id animi amet ab assumenda aperiam ea voluptate illo. </dd><dt><dfn>Ut tempora numquam. </dfn></dt><dd>Ab soluta sunt aut vero labore sit voluptatem necessitatibus et animi quidem. </dd><dt><dfn>Rem officiis necessitatibus. </dfn></dt><dd>A autem quia est consequatur voluptatem in dolorem tempora.</dd></dl>', '<p>Lorem ipsum dolor sit amet. Est cupiditate soluta 33 dolorum aliquid <em>Non explicabo non vitae architecto et provident veritatis eum provident repellat</em>. Aut dolorum incidunt <strong>Ut esse in quae quia</strong>. Et quia quisSed mollitia et aliquam adipisci qui dolores vero ex recusandae impedit et deserunt repellat et velit animi.&nbsp;</p>', '<p>Lorem ipsum dolor sit amet. Sed quia repudiandae33 maxime qui aliquam doloribus id sint accusamus et eligendi provident ut error nemo? Aut quaerat possimus <em>Sit laudantium qui ducimus natus sed provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum ratione cupiditate et obcaecati numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab voluptatum dolorem a dolor deleniti sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>', '24', 37490.00, 51266.00, 1, 3, 7, '1', 'SKU-0025', '1258724956', '1', 6, '2025-01-02 05:04:48', '2025-03-24 07:16:51', '1'),
(2, 'Samsung Galaxy F55 5G', 'samsung-galaxy-f55-5g', '<p>Lorem ipsum dolor sit amet. Et internos animi et corporis excepturi <em>Qui minima sed dolores adipisci</em> ut similique placeat et esse dolorem ab perspiciatis reiciendis. Et enim optio qui consequuntur reiciendisEos dolorum. Vel enim corporis <strong>Est asperiores sit doloremque facere aut labore quae</strong> et doloremque praesentium aut impedit architecto. Id iure aperiam eos magnam quaeratrem deleniti. </p><dl><dt><dfn>Id error vitae? </dfn></dt><dd>Et Quis aperiam in internos beatae eos sint magnam vel autem sint. </dd><dt><dfn>Sed eveniet doloribus vel dolor libero. </dfn></dt><dd>Ab nulla doloremque non eaque ratione sit veniam dolores in porro rerum.</dd></dl>', '<p>Lorem ipsum dolor sit amet. Sed blanditiis aspernatur hic odit omniset consequuntur quo voluptatem error cum praesentium velit. Id dicta modi ut ipsam tempora <strong>Qui fugiat</strong>. Ex voluptatem minima ut quia repellendus <em>Et illo non temporibus accusamus rem unde vero et ullam internos</em>. Et nostrum QuisIn voluptates et tenetur libero aut pariatur minus qui delectus corporis ut autem consequuntur non consequuntur laboriosam.&nbsp;</p>', '<p>Lorem ipsum dolor sit amet. Sed quia repudiandae33 maxime qui aliquam doloribus id sint accusamus et eligendi provident ut error nemo? Aut quaerat possimus <em>Sit laudantium qui ducimus natus sed provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum ratione cupiditate et obcaecati numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab voluptatum dolorem a dolor deleniti sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>', '8,15', 20999.00, 28999.00, 1, 2, 1, '0', 'SKU-0102', '1646219509', '1', 5, '2025-01-02 05:59:06', '2025-02-06 23:23:47', '1'),
(7, 'LEADER Spyder MTB Cycle', 'leader-spyder-mtb-cycle', '<p>Lorem ipsum dolor sit amet. Est impedit quisEt galisum et consequatur similique cum iusto modi sed repellat fugiat quo architecto autem ea laborum galisum? Id nisi ipsam ea dolores voluptatemqui voluptate non galisum vitae. </p><dl><dt><dfn>Et inventore vitae et repellat voluptas! </dfn></dt><dd>Rem earum temporibus ut beatae deleniti ab sint aperiam. </dd><dt><dfn>Qui modi beatae! </dfn></dt><dd>Et ullam dolore in voluptatum sint. </dd><dt><dfn>Et beatae impedit aut dolorem maiores. </dfn></dt><dd>Qui rerum explicabo sed aspernatur provident aut voluptas officia et sint modi.&nbsp;</dd></dl>', '<p>Lorem ipsum dolor sit amet. Cum blanditiis tempore est quos voluptatem <strong>Ut sunt id repudiandae fuga</strong> aut culpa sunt ut architecto dignissimos in aliquam natus. Et quos vero aut autem repellendus33 sint eos inventore adipisci? Non nihil voluptatibus et fugit nemoEt itaque est harum deserunt eos unde perspiciatis ut rerum provident. Et pariatur dolorum et laboriosam quiaEt quam eos iure rerum ex vitae blanditiis est consectetur exercitationem et iste quam.&nbsp;</p>', '<p>Lorem ipsum dolor sit amet. Sed quia repudiandae33 maxime qui aliquam doloribus id sint accusamus et eligendi provident ut error nemo? Aut quaerat possimus <em>Sit laudantium qui ducimus natus sed provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum ratione cupiditate et obcaecati numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab voluptatum dolorem a dolor deleniti sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>', '20', 7399.00, NULL, 20, 14, 22, '1', 'SKU-1117', '1452378961', '1', 5, '2025-01-23 09:22:37', '2025-03-13 06:06:57', '1'),
(8, 'Samsung Galaxy S22 5G', 'samsung-galaxy-s22-5g', '<p>Lorem ipsum dolor sit amet. Sed sapiente ducimus <em>Et nihil et distinctio maiores et optio cumque</em> et voluptatem ullam qui laboriosam voluptas. Quo quos blanditiis sit totam enim <strong>Ut veniam sit explicabo consectetur</strong>. </p><dl><dt><dfn>Est dolorem soluta. </dfn></dt><dd>Sit voluptas nulla nam nihil omnis quo quia deserunt. </dd><dt><dfn>Qui internos aliquam! </dfn></dt><dd>Ut dolores itaque quo error reiciendis id similique officia.&nbsp;</dd></dl>', '<p>Lorem ipsum dolor sit amet. Sit voluptates facere et quod velitUt minima sit voluptatem sint. Aut autem dolor 33 consequatur odio <strong>Sed ratione et laborum ratione ab dolores dicta sit enim inventore</strong>. Qui sint rerum <em>Id veniam et nemo rerum vel consequatur quia et fugiat quisquam</em> ea ipsum porro sed sequi cupiditate.&nbsp;</p>', '<p>Lorem ipsum dolor sit amet. Sed quia repudiandae33 maxime qui aliquam doloribus id sint accusamus et eligendi provident ut error nemo? Aut quaerat possimus <em>Sit laudantium qui ducimus natus sed provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum ratione cupiditate et obcaecati numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab voluptatum dolorem a dolor deleniti sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>', '2,15', 72999.00, 85999.00, 1, 2, 1, '1', 'SKU-9753', '7531564850', '1', 4, '2025-01-25 04:27:36', '2025-02-07 04:50:12', '1'),
(9, 'KOOKABURRA Speed Red Cricket Ball', 'kookaburra-speed-red-cricket-ball', '<p>Lorem ipsum dolor sit amet. Et vero veroEt laudantium sed labore doloremque! Aut tempora labore <strong>Sed obcaecati et autem minima est galisum consequatur</strong>. Et incidunt officia non unde voluptatem <em>Est repellat aut dolorem earum sed iure saepe et perspiciatis iure</em>. Nam modi dolor est inventore consecteturIn similique qui dignissimos itaque et ipsa architecto aut minus facilis. </p><dl><dt><dfn>Ex accusantium eveniet qui dolorum laborum. </dfn></dt><dd>Et facere totam qui dolorum eius. </dd><dt><dfn>Est facere maxime? </dfn></dt><dd>Sed nihil recusandae est repellat voluptatem et voluptatibus natus! </dd><dt><dfn>Vel similique facere. </dfn></dt><dd>Ea maiores quaerat id aliquid nostrum qui facere quas At consectetur magni. </dd><dt><dfn>Quo veniam dolorem sed labore perferendis. </dfn></dt><dd>Non quas pariatur sed error eius.&nbsp;</dd></dl>', '<p>Lorem ipsum dolor sit amet. Hic voluptatem dolores est soluta atque <strong>Ut consequuntur ut ducimus exercitationem</strong> hic placeat accusamus ad alias autem sit laudantium dicta. Ea velit temporeVel dicta ut ducimus delectus ut voluptas explicabo. Et commodi eius <em>Ab veritatis et eveniet adipisci hic mollitia voluptas est galisum facilis</em>.&nbsp;</p>', '<p>Lorem ipsum dolor sit amet. Sed quia repudiandae33 maxime qui aliquam doloribus id sint accusamus et eligendi provident ut error nemo? Aut quaerat possimus <em>Sit laudantium qui ducimus natus sed provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum ratione cupiditate et obcaecati numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab voluptatum dolorem a dolor deleniti sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>', '10,11', 900.00, 1018.00, 21, 26, 24, '0', 'SKU-5300', '1569811220', '1', 9, '2025-01-31 23:16:44', '2025-02-11 07:40:05', '1'),
(10, 'Next Print Newcastle United Home Jersey', 'next-print-newcastle-united-home-jersey', '<p>Lorem ipsum dolor sit amet. Sed facilis ipsum sit beatae dicta33 sunt. Ut vero QuisEum quae qui optio quidem. </p><dl><dt><dfn>Ut dolor dolor vel unde Quis. </dfn></dt><dd>33 molestias magnam et neque harum sit iure aperiam ad adipisci consequatur? </dd><dt><dfn>Vel consequuntur itaque qui incidunt consequatur. </dfn></dt><dd>Et maiores nihil est sint dicta. </dd><dt><dfn>Quo sint dicta. </dfn></dt><dd>Rem autem architecto et odio placeat. </dd><dt><dfn>Est perspiciatis fugit sed fugiat sapiente. </dfn></dt><dd>Ea asperiores magnam hic labore ratione aut dolorem reiciendis.&nbsp;</dd></dl>', '<p>Lorem ipsum dolor sit amet. Ex praesentium nobis <em>At nesciunt est assumenda obcaecati vel excepturi repellendus ea inventore molestias</em> qui blanditiis officiis et nisi eveniet. Est internos voluptasIn harum sit veniam laboriosam et molestiae ipsa eum eveniet debitis. Aut consectetur inventore <strong>Est veritatis ut facere placeat cum dolorum unde</strong> qui quisquam officiis est iusto placeat vel recusandae cupiditate!&nbsp;</p>', '<p>Lorem ipsum dolor sit amet. Sed quia repudiandae33 maxime qui aliquam doloribus id sint accusamus et eligendi provident ut error nemo? Aut quaerat possimus <em>Sit laudantium qui ducimus natus sed provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum ratione cupiditate et obcaecati numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab voluptatum dolorem a dolor deleniti sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>', '11,9', 499.00, NULL, 21, 27, 25, '0', 'SKU-0005', '1157822338', '1', 6, '2025-01-31 23:25:08', '2025-03-28 04:54:40', '1'),
(11, 'SG Boundary Xtreme Kashmir Willow Cricket Bat', 'sg-boundary-xtreme-kashmir-willow-cricket-bat', '<p>Aut quia harum <em>Quo consequatur non laborum rerum in optio assumenda</em> et sapiente rerum qui dolores deleniti. Non consequatur omnis <strong>Et ullam quo vitae sapiente ut recusandae nesciunt</strong> ea magni voluptas qui voluptas porro. </p><dl><dt><dfn>Est perferendis nihil. </dfn></dt><dd>Vel deleniti dolorum a aperiam atque in expedita quia. </dd><dt><dfn>Qui tempora quia non fugit quas. </dfn></dt><dd>Ut numquam assumenda qui nesciunt veniam id internos accusantium.&nbsp;</dd></dl>', '<p>Lorem ipsum dolor sit amet. A ratione doloresEst vitae aut autem modi ea ullam expedita. In galisum voluptas ut harum sapiente <em>Eum asperiores</em>. Aut ipsam tempora aut adipisci iusto <strong>Qui voluptatum et quas earum id porro atque ut explicabo internos</strong>.&nbsp;</p>', '<p>Lorem ipsum dolor sit amet. Sed quia repudiandae33 maxime qui aliquam doloribus id sint accusamus et eligendi provident ut error nemo? Aut quaerat possimus <em>Sit laudantium qui ducimus natus sed provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum ratione cupiditate et obcaecati numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab voluptatum dolorem a dolor deleniti sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>', '9,10', 3189.00, 3249.00, 21, 26, 26, '0', 'SKU-7400', '1791111263', '1', 6, '2025-01-31 23:31:22', '2025-02-11 07:39:48', '1'),
(12, 'Godrej 6Kg Eco-Wash Washing Machine', 'godrej-6kg-ecowash-washing-machine', '<p>Lorem ipsum dolor sit amet. Quo similique harum <em>Quo repellat</em> sed nobis voluptatem et doloribus aspernatur. Sed quaerat cumque aut sequi eaquein repellendus ut fugiat voluptatem 33 voluptas voluptatem. </p><dl><dt><dfn>Et laboriosam fugit aut facilis similique. </dfn></dt><dd>Et tenetur eveniet vel quaerat molestias in debitis deleniti. </dd><dt><dfn>Aut veniam magni. </dfn></dt><dd>Aut explicabo rerum sed iure nihil et praesentium similique?&nbsp;</dd></dl>', '<p>Lorem ipsum dolor sit amet. Non quis quaeratVel perferendis est tempore eaque ut iusto ipsa. Eos pariatur rerum <em>Aut enim est veritatis dignissimos sit expedita error</em> non minus dolor rem repudiandae laborum sed quia dolor. Et dolor velit <strong>Id maxime nam aperiam quam id excepturi dolores</strong> qui debitis pariatur est velit consequatur. Et mollitia laboriosam ut similique aperiamUt perferendis quo consequatur ducimus et quia cumque.&nbsp;</p>', '<p>Lorem ipsum dolor sit amet. Sed quia repudiandae33 maxime qui aliquam doloribus id sint accusamus et eligendi provident ut error nemo? Aut quaerat possimus <em>Sit laudantium qui ducimus natus sed provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum ratione cupiditate et obcaecati numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab voluptatum dolorem a dolor deleniti sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>', '14,13', 22990.00, 38500.00, 22, 22, 28, '0', 'SKU-0007', '1915322645', '1', 6, '2025-01-31 23:56:20', '2025-02-06 23:18:47', '1'),
(13, 'LG 7Kg Front Load Washing Machine', 'lg-7kg-front-load-washing-machine', '<p>Lorem ipsum dolor sit amet. Et consequatur minus <em>In consequuntur</em> vel magni consequuntur ab debitis labore. Qui debitis fugaSit esse qui saepe odio quo debitis sunt hic iste ipsa. Ut eaque eaque qui laudantium maioresqui voluptas ea delectus repudiandae. Vel cumque quaeAut rerum et fuga porro est eaque tempore id temporibus quia. </p><dl><dt><dfn>Vel odio iusto qui nisi dolore. </dfn></dt><dd>Et consequatur nobis et culpa galisum ut quia praesentium. </dd><dt><dfn>Sit repudiandae galisum. </dfn></dt><dd>Non accusamus voluptatem et corrupti quae.&nbsp;</dd></dl>', '<p>Lorem ipsum dolor sit amet. Ut dignissimos laudantiumHic cupiditate ut facilis neque aut pariatur nihil est voluptas laboriosam in perspiciatis facilis. Sed nisi expedita <strong>Nam earum nam temporibus omnis</strong>.&nbsp;</p>', '<p>Lorem ipsum dolor sit amet. Sed quia repudiandae33 maxime qui aliquam doloribus id sint accusamus et eligendi provident ut error nemo? Aut quaerat possimus <em>Sit laudantium qui ducimus natus sed provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum ratione cupiditate et obcaecati numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab voluptatum dolorem a dolor deleniti sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>', '14,12', 29990.00, 45990.00, 22, 22, 27, '1', 'SKU-9999', '1122948625', '1', 6, '2025-02-01 00:04:16', '2025-02-06 23:18:22', '1'),
(14, 'Haier 598L 3-Door Convertible Refrigerator', 'haier-598l-3door-convertible-refrigerator', '<p>Lorem ipsum dolor sit amet. Est quos animiet deleniti qui odit voluptatem. Sed iste molestiae sit eaque accusamus <strong>Est illo vel reiciendis quos</strong> ut quibusdam Quis cum dolorem sint est repudiandae doloribus! Sit expedita officia ut consectetur voluptaset laborum qui maxime nemo. </p><dl><dt><dfn>Qui laboriosam dolorem. </dfn></dt><dd>Et quae velit sit quae quae aut facilis repudiandae. </dd><dt><dfn>Est illo natus. </dfn></dt><dd>Ut suscipit debitis ea nobis neque? </dd><dt><dfn>Id veniam molestiae. </dfn></dt><dd>Ut assumenda sint qui recusandae magni eum sint reprehenderit.&nbsp;</dd></dl>', '<p>Lorem ipsum dolor sit amet. Sit iusto voluptatibus <strong>Est voluptatem</strong> sit omnis asperiores sit ullam aperiam. Est vitae autem est quod doloremQuo temporibus in necessitatibus quidem ea ducimus eaque ea molestiae mollitia rem autem atque. In consequatur enim aut commodi quia <em>Ut voluptatem ab debitis assumenda eum necessitatibus aperiam eos sint rerum</em> vel dignissimos debitis. 33 quia rerum aut nostrum itaqueet inventore ut galisum quis ut ullam cumque.&nbsp;</p>', '<p>Lorem ipsum dolor sit amet. Sed quia repudiandae33 maxime qui aliquam doloribus id sint accusamus et eligendi provident ut error nemo? Aut quaerat possimus <em>Sit laudantium qui ducimus natus sed provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum ratione cupiditate et obcaecati numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab voluptatum dolorem a dolor deleniti sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>', '12,13', 91790.00, 139990.00, 22, 23, 29, '0', 'SKU-1598', '1000300075', '1', 6, '2025-02-01 01:24:58', '2025-02-06 23:17:51', '1'),
(15, 'Apple iPhone 13 Pro Max (6/128)', 'apple-iphone-13-pro-max-6128', '<p>Lorem ipsum dolor sit amet. Est minus quodEt fugiat sed sint illum nam dolorem tenetur et dolorum incidunt et quia expedita et aliquam ipsum! Eos error error vel animi cumque <em>Vel maiores ut aliquam repellendus aut reprehenderit dignissimos aut unde provident</em> vel eius neque. Ad maxime cupiditate <strong>Aut dolores ut atque quam</strong>. </p><dl><dt><dfn>Et enim ipsum. </dfn></dt><dd>Cum possimus dolor a fugit voluptas ut inventore magnam est nobis sapiente. </dd><dt><dfn>Sed tempore accusantium. </dfn></dt><dd>Vel quae velit sed veritatis voluptas non excepturi sapiente. </dd><dt><dfn>Qui omnis ratione est fugit consequatur. </dfn></dt><dd>Aut quibusdam reprehenderit cum quod corporis est illo internos. </dd><dt><dfn>Et provident vero qui assumenda placeat. </dfn></dt><dd>Ea autem distinctio non odit eveniet?&nbsp;</dd></dl>', '<p>Lorem ipsum dolor sit amet. Et earum eligendi <strong>Et excepturi et Quis nihil ut modi numquam</strong> ad molestiae eveniet ut quia autem. Et dolorem solutahic tempora qui velit rerum. Est itaque quae ut earum quaeratQuo fugit est reprehenderit quibusdam et magni modi eos eius veniam. Et similique sint aut odit doloraut quasi et accusamus numquam?&nbsp;</p>', '<p>Lorem ipsum dolor sit amet. Sed quia repudiandae33 maxime qui aliquam doloribus id sint accusamus et eligendi provident ut error nemo? Aut quaerat possimus <em>Sit laudantium qui ducimus natus sed provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum ratione cupiditate et obcaecati numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab voluptatum dolorem a dolor deleniti sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>', '2,8', 100590.00, 129900.00, 1, 2, 30, '1', 'SKU-1239', '1221055548', '1', 4, '2025-02-01 01:36:59', '2025-02-06 23:16:40', '1'),
(16, 'Wakefit Sofa with 4 Cushions', 'wakefit-sofa-with-4-cushions', '<p>Lorem ipsum dolor sit amet. Et corrupti velitQui neque aut amet earum est voluptates deleniti. Quo quisquam quidem <em>Id facere eos cumque unde aut rerum cupiditate ex tenetur quas</em>. A saepe fuga est dolores quaerat <strong>Eum quae hic laborum voluptatem sit internos delectus eos pariatur molestiae</strong>. </p><dl><dt><dfn>Ut quia aliquid eum laudantium minima. </dfn></dt><dd>Et aspernatur aliquam est galisum voluptatem qui asperiores provident aut neque quas. </dd><dt><dfn>Rem vero nobis et vero minus. </dfn></dt><dd>Aut deserunt quae id dolorem omnis aut consequatur placeat est sint itaque.&nbsp;</dd></dl>', '<p>Lorem ipsum dolor sit amet. Eos minus suscipit a molestiae fugit <strong>Ut amet</strong>. Aut labore quos <em>Qui nihil et magni nulla est sint vitae ea rerum sunt</em>. Et voluptatem perferendiseum eligendi eos inventore autem.&nbsp;</p>', '<p>Lorem ipsum dolor sit amet. Sed quia repudiandae33 maxime qui aliquam doloribus id sint accusamus et eligendi provident ut error nemo? Aut quaerat possimus <em>Sit laudantium qui ducimus natus sed provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum ratione cupiditate et obcaecati numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab voluptatum dolorem a dolor deleniti sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>', '17', 20999.00, 25999.00, 12, 11, 31, '0', 'SKU-8246', '1482233666', '1', 3, '2025-02-02 21:01:04', '2025-02-06 23:23:07', '1'),
(17, 'DecorNation 2 Seater Dining Table-Chair Set', 'decornation-2-seater-dining-tablechair-set', '<p>Lorem ipsum dolor sit amet. Qui galisum error <strong>Aut illo est voluptatem voluptates eos explicabo autem</strong> sed ratione expedita ab repudiandae eius. Eos magnam reprehenderit et rerum vitae <em>Ut illum et voluptatem fugiat id delectus voluptates et consequatur inventore</em> sit provident sunt. </p><dl><dt><dfn>Id quod repellat. </dfn></dt><dd>Et fugit architecto et quibusdam nobis ex perspiciatis omnis. </dd><dt><dfn>Ut veritatis quia. </dfn></dt><dd>Sed quidem ratione a voluptates optio! </dd><dt><dfn>At sint voluptas est dolor tenetur. </dfn></dt><dd>Et dolor quia qui officiis dolorem ut reiciendis dolor.&nbsp;</dd></dl>', '<p>Lorem ipsum dolor sit amet. Et velit pariatur ut nostrum doloresquo natus hic dolorum tempore nam laboriosam consequuntur. Ut consequuntur eligendi sed aperiam ducimus <em>Sed voluptas et quaerat nisi ab Quis nihil ex Quis voluptatem</em>. Est natus aspernatur <strong>Est obcaecati eum galisum velit non assumenda adipisci</strong> eos sunt illum cum velit mollitia.&nbsp;</p>', '<p>Lorem ipsum dolor sit amet. Sed quia repudiandae33 maxime qui aliquam doloribus id sint accusamus et eligendi provident ut error nemo? Aut quaerat possimus <em>Sit laudantium qui ducimus natus sed provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum ratione cupiditate et obcaecati numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab voluptatum dolorem a dolor deleniti sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>', '16', 11099.00, 15000.00, 12, 10, 32, '0', 'SKU-0209', '1400500616', '1', 0, '2025-02-02 21:15:33', '2025-03-14 09:48:33', '1'),
(19, 'NoiseFit Halo Smartwatch', 'noisefit-halo-smartwatch', '<p>Lorem ipsum dolor sit amet. Qui aperiam voluptates <strong>Cum velit qui porro ducimus ad repudiandae voluptatem</strong> vel vitae eveniet et quia labore. Qui tenetur QuisQui sunt cum suscipit nobis vel laudantium doloremque et officiis dolores ut debitis eaque. Vel quas voluptates <em>Et esse eos doloribus odit vel dolor quaerat</em> qui vitae porro ut alias fugit. </p><dl><dt><dfn>Ut enim commodi quo dolorum nulla! </dfn></dt><dd>Id nobis molestiae id rerum libero est iure dolorum. </dd><dt><dfn>Ea repellat dolore. </dfn></dt><dd>Et assumenda dolorem At earum minima et dolor similique. </dd><dt><dfn>Sed sunt sunt nam facere incidunt? </dfn></dt><dd>Ut sint iusto hic reiciendis laborum id cupiditate dolor qui facilis accusantium. </dd><dt><dfn>Ea atque eligendi hic quod saepe. </dfn></dt><dd>Sit sequi facere aut repellat laboriosam et sint minima?&nbsp;</dd></dl>', '<p>Lorem ipsum dolor sit amet. Non eaque sunt <strong>Non commodi eos possimus galisum ex magnam ipsum</strong>. Quo magni assumenda hic perferendis dicta <em>Et corrupti</em>. Sit dolores necessitatibusEt sunt ut porro ipsum. Aut fuga quibusdam vel quia placeatUt quod qui aliquid tempore a inventore quasi sed numquam explicabo et quia assumenda.&nbsp;</p>', '<p>Lorem ipsum dolor sit amet. 33 totam obcaecati et consequuntur tempora <strong>Id odit aut quis autem et sequi tempora a ratione debitis</strong> aut commodi alias? Ex quidem voluptatem et ullam molestiae <em>Et magnam id libero rerum</em>. Qui quis esseQui harum et doloremque distinctio qui labore alias et eius necessitatibus et enim libero. Aut totam quisEt blanditiis ut eius recusandae et omnis illo eos necessitatibus perspiciatis ea tempora maiores 33 adipisci aliquid? </p><p>Et earum iusto <em>Et mollitia eos dolorem nulla</em>. Rem amet itaque id voluptatem quasiEum placeat et rerum voluptas et quia quos. Sit laudantium quia 33 laudantium voluptatemAt placeat et voluptatem consequatur.&nbsp;</p>', '', 3499.00, 7999.00, 1, 4, 34, '1', 'SKU-9278', '1111144645', '0', NULL, '2025-02-03 00:34:52', '2025-02-11 23:51:28', '1'),
(20, 'Honda H\'ness CB350', 'honda-hness-cb350', '<p>Lorem ipsum dolor sit amet. Et ratione laudantium ea blanditiis ullamid veritatis vel similique voluptate. Qui harum galisum ad vitae architecto <strong>Hic voluptatem At nostrum nesciunt 33 galisum voluptatem est error modi</strong>. Qui saepe natusUt galisum qui rerum quos et quia temporibus et laudantium optio rem autem sapiente. Aut explicabo voluptatemEum facere eum culpa vero est sint dolorem. </p><dl><dt><dfn>Eos beatae sunt. </dfn></dt><dd>Quo asperiores enim quo cupiditate obcaecati rem quaerat consequatur? </dd><dt><dfn>Qui obcaecati consequatur hic vitae repellat! </dfn></dt><dd>Qui assumenda consequuntur id omnis suscipit. </dd><dt><dfn>Aut provident distinctio quo molestias dolor. </dfn></dt><dd>Ut quam ratione sit voluptas pariatur?&nbsp;</dd></dl>', '<p>Lorem ipsum dolor sit amet. Id facilis omnis <strong>Id odio sit voluptates explicabo eum neque velit non officia quos</strong> aut voluptatibus quas aut voluptatem iste. Est fugiat consequaturQui excepturi in culpa consequuntur et neque rerum et optio voluptas ad dolore omnis.&nbsp;</p>', '<p>Lorem ipsum dolor sit amet. Sed quia repudiandae33 maxime qui aliquam doloribus id sint accusamus et eligendi provident ut error nemo? Aut quaerat possimus <em>Sit laudantium qui ducimus natus sed provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum ratione cupiditate et obcaecati numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab voluptatum dolorem a dolor deleniti sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>', '7', 248543.00, NULL, 20, 15, 35, '0', 'SKU-54645', '1010104444', '1', 3, '2025-02-03 00:38:53', '2025-02-06 23:16:08', '1'),
(23, 'MAHABHARATA: AN ENGLISH VERSION by E. S. JAMBULINGAM', 'mahabharata-an-english-version-by-e-s-jambulingam', '<p>Lorem ipsum dolor sit amet. Non officia galisum ab enim molestiae <em>Ut quis sit unde illo ea omnis officia sed voluptatem perferendis</em> eos veniam error? Vel eius sunt et voluptates illumQuo provident eum eius odio ut autem pariatur sit iste quisquam. Et dolor sint 33 galisum dictaquo possimus! </p><dl><dt><dfn>Sit corporis doloribus. </dfn></dt><dd>Sed molestiae eligendi in maiores laborum. </dd><dt><dfn>Hic voluptatem voluptas non porro pariatur. </dfn></dt><dd>33 natus assumenda eos dolores repellat et Quis sapiente non alias sint. </dd><dt><dfn>Sit odit ullam. </dfn></dt><dd>Sit distinctio dolor qui perferendis dicta. </dd><dt><dfn>Eum numquam fugiat hic deserunt earum. </dfn></dt><dd>Ut fuga nostrum ut architecto cumque ut nulla mollitia.&nbsp;</dd></dl>', '<p>Lorem ipsum dolor sit amet. Et reprehenderit internos a galisum vitaequo assumenda et possimus aspernatur. Aut sint placeat sed minus autemest repudiandae ut alias nemo non veniam galisum. Non sunt deserunt <strong>Quo enim At ipsa neque eos consequatur ipsam</strong> et libero sequi qui iusto eaque hic voluptatem accusamus?&nbsp;</p>', '<p>Lorem ipsum dolor sit amet. Sed quia repudiandae33 maxime qui aliquam doloribus id sint accusamus et eligendi provident ut error nemo? Aut quaerat possimus <em>Sit laudantium qui ducimus natus sed provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum ratione cupiditate et obcaecati numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab voluptatum dolorem a dolor deleniti sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>', NULL, 265.00, 300.00, 23, NULL, 33, '0', 'SKU-4447', '1111170345', '1', 13, '2025-02-05 02:39:08', '2025-03-13 06:05:47', '1'),
(24, 'Apple Macbook Air (Gold/8GB RAM/256GB SSD)', 'apple-macbook-air-gold8gb-ram256gb-ssd', '<p>Lorem ipsum dolor sit amet. Quo quos consequatur in dolore laudantiumsed ducimus vel recusandae blanditiis et omnis quia. Et enim dolorem <em>At recusandae et nostrum eius in cupiditate vitae est accusantium nemo</em> non rerum laborum qui dolor enim? Et nesciunt voluptas 33 praesentium numquam <strong>Et earum ut unde itaque 33 aliquam magnam hic placeat rerum</strong>. Ea reprehenderit dignissimosEt odit aut veritatis consequatur in nostrum omnis At ipsa velit eos obcaecati enim id officia animi. </p><dl><dt><dfn>Non unde obcaecati? </dfn></dt><dd>Aut consequuntur eaque sit cupiditate tempore. </dd><dt><dfn>Hic praesentium deserunt. </dfn></dt><dd>Et doloribus minus sit quam commodi sit eveniet quia! </dd><dt><dfn>Et voluptatem placeat. </dfn></dt><dd>Aut incidunt itaque ut voluptate illo et tempora sapiente aut omnis praesentium.&nbsp;</dd></dl>', '<p>Lorem ipsum dolor sit amet. Sed rerum error <em>Nam repellendus</em>&nbsp;incidunt ipsa. Id obcaecati quidem At enim doloribusqui aspernatur. Sed deserunt maxime aut fuga officiis <strong>Ab reiciendis sed Quis similique</strong> rem dolores maxime et omnis nisi in facilis fugiat. Id asperiores quaerat ea necessitatibus dolorin rerum.&nbsp;</p>', '<p>Lorem <em>&nbsp;provident deserunt</em> vel quia facere est assumenda dolorem! Eum Quis rerum <strong>Ut esse aut enim voluptatem cum&nbsp; numquam</strong>. 33 perferendis facereNam internos ad delectus minus et minus consequatur et voluptas culpa. </p><p>Aut tempore dolorem et mollitia beataeEt velit eos voluptatem itaque a fugiat itaque eum repellendus Quis. Cum ipsum animi <em>A temporibus sed voluptatem nihil et animi natus</em> ab sed tempora repudiandae? Ut eveniet omnis qui autem obcaecati <strong>Sed nisi sed rerum saepe ut obcaecati consequatur</strong>.</p>', '1', 67990.00, 89990.00, 1, 3, 30, '0', 'SKU-84006', '1789630001', '1', 5, '2025-02-08 00:34:04', '2025-02-09 10:12:32', '1');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `name`, `product_id`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, '20250102103448_263.jpg', 1, NULL, '2025-01-02 05:04:48', '2025-01-02 05:04:48'),
(2, '20250102103448_748.jpg', 1, NULL, '2025-01-02 05:04:48', '2025-01-02 05:04:48'),
(3, '20250102103448_558.jpg', 1, NULL, '2025-01-02 05:04:48', '2025-01-02 05:04:48'),
(4, '20250102112906_358.jpg', 2, NULL, '2025-01-02 05:59:06', '2025-01-02 05:59:06'),
(5, '20250102112906_835.jpg', 2, NULL, '2025-01-02 05:59:06', '2025-01-02 05:59:06'),
(6, '20250102112906_417.jpg', 2, NULL, '2025-01-02 05:59:06', '2025-01-02 05:59:06'),
(9, '20250123145237_5.jpg', 7, NULL, '2025-01-23 09:22:37', '2025-01-23 09:22:37'),
(10, '20250125095736_799.jpg', 8, NULL, '2025-01-25 04:27:36', '2025-01-25 04:27:36'),
(11, '20250125095910_65.jpg', 8, NULL, '2025-01-25 04:29:10', '2025-01-25 04:29:10'),
(14, '20250201044644_472.jpg', 9, NULL, '2025-01-31 23:16:44', '2025-01-31 23:16:44'),
(15, '20250201045508_823.jpg', 10, NULL, '2025-01-31 23:25:08', '2025-01-31 23:25:08'),
(16, '20250201050122_37.jpg', 11, NULL, '2025-01-31 23:31:22', '2025-01-31 23:31:22'),
(17, '20250201052620_117.jpg', 12, NULL, '2025-01-31 23:56:20', '2025-01-31 23:56:20'),
(18, '20250201052623_59.jpg', 12, NULL, '2025-01-31 23:56:23', '2025-01-31 23:56:23'),
(19, '20250201053416_31.jpg', 13, NULL, '2025-02-01 00:04:16', '2025-02-01 00:04:16'),
(20, '20250201065458_6.jpg', 14, NULL, '2025-02-01 01:24:58', '2025-02-01 01:24:58'),
(21, '20250201070039_820.jpg', 14, NULL, '2025-02-01 01:30:39', '2025-02-01 01:30:39'),
(22, '20250201070700_687.jpg', 15, NULL, '2025-02-01 01:37:00', '2025-02-01 01:37:00'),
(23, '20250201070700_417.jpg', 15, NULL, '2025-02-01 01:37:00', '2025-02-01 01:37:00'),
(24, '20250201070700_742.jpg', 15, NULL, '2025-02-01 01:37:00', '2025-02-01 01:37:00'),
(25, '20250203023104_941.jpg', 16, NULL, '2025-02-02 21:01:04', '2025-02-02 21:01:04'),
(26, '20250203024533_742.jpg', 17, NULL, '2025-02-02 21:15:33', '2025-02-02 21:15:33'),
(29, '20250203060452_760.jpg', 19, NULL, '2025-02-03 00:34:52', '2025-02-03 00:34:52'),
(30, '20250203060853_0.jpg', 20, NULL, '2025-02-03 00:38:53', '2025-02-03 00:38:53'),
(31, '20250203060853_736.jpg', 20, NULL, '2025-02-03 00:38:53', '2025-02-03 00:38:53'),
(32, '20250203060853_356.jpg', 20, NULL, '2025-02-03 00:38:53', '2025-02-03 00:38:53'),
(33, '20250203060853_525.jpg', 20, NULL, '2025-02-03 00:38:53', '2025-02-03 00:38:53'),
(37, '20250205080908_37.jpg', 23, NULL, '2025-02-05 02:39:08', '2025-02-05 02:39:08'),
(38, '20250205080908_116.jpg', 23, NULL, '2025-02-05 02:39:08', '2025-02-05 02:39:08'),
(39, '20250208060404_136.jpg', 24, NULL, '2025-02-08 00:34:04', '2025-02-08 00:34:04'),
(40, '20250208060411_67.jpg', 24, NULL, '2025-02-08 00:34:11', '2025-02-08 00:34:11'),
(41, '20250208060411_414.jpg', 24, NULL, '2025-02-08 00:34:11', '2025-02-08 00:34:11'),
(42, '20250208060412_627.jpg', 24, NULL, '2025-02-08 00:34:12', '2025-02-08 00:34:12'),
(43, '20250208060413_543.jpg', 24, NULL, '2025-02-08 00:34:13', '2025-02-08 00:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` double(3,2) NOT NULL,
  `comment` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_ratings`
--

INSERT INTO `product_ratings` (`id`, `product_id`, `user_id`, `rating`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5.00, 'Extremely satisfied with the purchase.', 1, '2025-03-25 23:47:52', '2025-03-26 04:09:56'),
(2, 1, 5, 4.00, 'Awesome product!', 1, '2025-03-25 23:48:34', '2025-03-26 04:10:24'),
(3, 10, 8, 4.00, NULL, 1, '2025-03-28 05:20:35', '2025-03-28 05:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `main_admin_id` bigint(20) UNSIGNED NOT NULL,
  `company_text` text NOT NULL,
  `company_default_email` varchar(255) NOT NULL,
  `company_default_address` text NOT NULL,
  `company_default_phone` text NOT NULL,
  `company_default_phone_country_code` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `main_admin_id`, `company_text`, `company_default_email`, `company_default_address`, `company_default_phone`, `company_default_phone_country_code`, `created_at`, `updated_at`) VALUES
(1, 1, 'No dolore ipsum accusim no lorem.', 'shirsendu1260@gmail.com', '123 Street, Kolkata, India', '1234567890', '+91', '2025-03-20 07:33:33', '2025-03-23 23:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `country_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 243, 3000.00, '2025-02-22 02:32:01', '2025-02-24 05:36:53'),
(2, 1, 80.00, '2025-02-22 02:33:34', '2025-02-24 05:36:43'),
(3, 82, 920.00, '2025-02-22 09:30:45', '2025-02-24 05:37:02'),
(5, 11, 610.00, '2025-02-22 09:31:37', '2025-02-24 05:37:10'),
(6, 31, 635.00, '2025-02-22 09:31:55', '2025-02-24 05:37:17'),
(7, 108, 470.00, '2025-02-22 09:44:38', '2025-02-24 05:37:25'),
(10, 26, 105.00, '2025-02-23 23:17:57', '2025-02-24 05:37:32'),
(11, 196, 460.00, '2025-02-23 23:55:19', '2025-02-24 05:37:46'),
(12, 209, 445.50, '2025-02-24 06:22:52', '2025-02-24 06:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `static_pages`
--

CREATE TABLE `static_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `static_pages`
--

INSERT INTO `static_pages` (`id`, `name`, `slug`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Terms & Conditions', 'terms-conditions', '<div style=\"text-align: justify; \">Lorem ipsum dolor sit amet, <b>consectetuer </b>adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Donec pede justo, fringilla vel, aliquet nec, <b>vulputate </b>eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer <b>tincidunt</b>. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur <b>ullamcorper </b>ultricies nisi.</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify; \">Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget <b>condimentum </b>rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis <b>faucibus</b>. Nullam quis ante. Etiam sit amet orci eget eros faucibus <b>tincidunt</b>. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.</div>', '1', '2025-03-18 05:52:18', '2025-03-18 23:15:09'),
(2, 'Refund Policy', 'refund-policy', '<div style=\"text-align: justify; \">Lorem ipsum dolor sit amet, <b>consectetuer </b>adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, <b>imperdiet </b>a, venenatis vitae, justo. <b>Nullam </b>dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify; \">Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget <b>condimentum </b>rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam <b>quam </b>nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.</div>', '1', '2025-03-18 05:59:59', '2025-03-18 23:14:56'),
(3, 'Privacy', 'privacy', '<div style=\"text-align: justify; \">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean <b>commodo </b>ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">In enim justo, rhoncus ut, imperdiet a, <b>venenatis </b>vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify; \"><b>Phasellus </b>viverra nulla ut metus varius laoreet. Quisque rutrum. <b>Aenean imperdiet</b>. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.</div>', '1', '2025-03-18 06:02:11', '2025-03-18 23:14:40'),
(4, 'Contact Us', 'contact-us', '<p style=\"text-align: justify; \">In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>\r\n<address><b>\r\nShirsendu Mali</b><br>\r\n123 Street<br>\r\nKolkata, India 700007<br>\r\n<a href=\"tel:+911234567890\">(+91) 12345 67890</a><br>\r\n<a href=\"mailto:shirsendu1260@gmail.com\">shirsendu1260@gmail.com</a>\r\n</address>', '1', '2025-03-18 06:04:07', '2025-03-20 00:38:39'),
(5, 'About', 'about', '<div style=\"text-align: justify; \"><span style=\"font-size: 1rem;\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. <b>Aenean </b>commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</span></div><div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify;\">Donec pede justo, <b>fringilla </b>vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, <b>imperdiet </b>a, <b>venenatis </b>vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. <b>Aenean </b>vulputate <b>eleifend </b>tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</div><div style=\"text-align: justify;\"><br></div><div style=\"text-align: justify; \">Aliquam lorem ante, <b>dapibus </b>in, viverra quis, feugiat a, tellus. <b>Phasellus </b>viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. <b>Nullam </b>quis ante. Etiam sit <b>amet </b>orci eget eros faucibus tincidunt. Duis leo.</div></div>', '1', '2025-03-18 06:06:10', '2025-03-18 23:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `show_on_homepage` enum('1','0') NOT NULL DEFAULT '0',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `slug`, `status`, `show_on_homepage`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 'Mobiles', 'mobiles', '1', '1', 1, '2024-12-20 00:44:21', '2025-01-22 00:41:00'),
(3, 'Laptops', 'laptops', '1', '1', 1, '2024-12-20 00:44:31', '2025-01-22 00:41:08'),
(4, 'Smart Watches', 'smart-watches', '1', '1', 1, '2024-12-20 00:46:41', '2025-01-24 23:31:18'),
(5, 'T-Shirts For Men', 'tshirts-for-men', '1', '1', 10, '2024-12-20 00:49:43', '2025-01-22 02:19:13'),
(6, 'T-Shirts For Women', 'tshirts-for-women', '1', '1', 10, '2024-12-20 00:49:55', '2025-01-22 02:19:01'),
(7, 'Shoes', 'shoes', '0', '0', 10, '2024-12-21 00:30:08', '2024-12-21 02:39:15'),
(10, 'Tables', 'tables', '1', '1', 12, '2024-12-21 02:31:29', '2025-01-22 00:44:06'),
(11, 'Sofas', 'sofas', '0', '1', 12, '2024-12-21 02:39:59', '2025-01-24 23:31:53'),
(14, 'Bicycles', 'bicycles', '1', '0', 20, '2025-01-21 06:20:39', '2025-01-21 06:20:39'),
(15, 'Motorbikes', 'motorbikes', '1', '0', 20, '2025-01-21 06:20:50', '2025-01-21 06:20:50'),
(18, 'Sports Shoes', 'sports-shoes', '1', '0', 21, '2025-01-22 00:40:13', '2025-01-22 00:40:30'),
(19, 'Clothes For Kids', 'clothes-for-kids', '1', '1', 10, '2025-01-22 00:42:35', '2025-01-22 00:43:41'),
(20, 'Jeans For Women', 'jeans-for-women', '1', '1', 10, '2025-01-22 02:20:10', '2025-01-22 02:20:10'),
(21, 'Jeans For Men', 'jeans-for-men', '1', '1', 10, '2025-01-22 02:20:26', '2025-01-22 02:20:26'),
(22, 'Washing Machines', 'washing-machines', '1', '1', 22, '2025-01-24 23:26:00', '2025-01-24 23:26:00'),
(23, 'Refrigerators', 'refrigerators', '1', '1', 22, '2025-01-24 23:26:52', '2025-01-24 23:26:52'),
(24, 'Shampoos', 'shampoos', '1', '1', 24, '2025-01-24 23:27:52', '2025-01-24 23:27:52'),
(25, 'Moisturizers', 'moisturizers', '1', '1', 24, '2025-01-24 23:30:51', '2025-01-24 23:30:51'),
(26, 'Cricket Accessories', 'cricket-accessories', '1', '0', 21, '2025-01-31 23:07:37', '2025-01-31 23:07:37'),
(27, 'Football Jerseys', 'football-jerseys', '1', '0', 21, '2025-01-31 23:21:22', '2025-01-31 23:21:22');

-- --------------------------------------------------------

--
-- Table structure for table `temp_images`
--

CREATE TABLE `temp_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_images`
--

INSERT INTO `temp_images` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '20241214083210_972.jpg', '2024-12-14 03:02:10', '2024-12-14 03:02:10'),
(3, '20241214083230_642.jpg', '2024-12-14 03:02:30', '2024-12-14 03:02:30'),
(4, '20241214085341_83.jpg', '2024-12-14 03:23:41', '2024-12-14 03:23:41'),
(5, '20241214085633_366.jpg', '2024-12-14 03:26:33', '2024-12-14 03:26:33'),
(6, '20241214085722_259.jpg', '2024-12-14 03:27:22', '2024-12-14 03:27:22'),
(7, '20241214085753_807.jpg', '2024-12-14 03:27:53', '2024-12-14 03:27:53'),
(8, '20241227093021_519.jpg', '2024-12-27 04:00:21', '2024-12-27 04:00:21'),
(10, '20241227101147_369.jpg', '2024-12-27 04:41:47', '2024-12-27 04:41:47'),
(11, '20241227101304_387.jpg', '2024-12-27 04:43:04', '2024-12-27 04:43:04'),
(29, '20250102103253_461.jpg', '2025-01-02 05:02:53', '2025-01-02 05:02:53'),
(30, '20250102103302_376.jpg', '2025-01-02 05:03:02', '2025-01-02 05:03:02'),
(32, '20250102103357_55.jpg', '2025-01-02 05:03:57', '2025-01-02 05:03:57'),
(33, '20250102112629_159.jpg', '2025-01-02 05:56:29', '2025-01-02 05:56:29'),
(34, '20250102112641_943.jpg', '2025-01-02 05:56:41', '2025-01-02 05:56:41'),
(35, '20250102112642_602.jpg', '2025-01-02 05:56:42', '2025-01-02 05:56:42'),
(36, '20250103045813_894.jpg', '2025-01-02 23:28:13', '2025-01-02 23:28:13'),
(37, '20250121100909_540.jpg', '2025-01-21 04:39:09', '2025-01-21 04:39:09'),
(38, '20250121101328_671.jpg', '2025-01-21 04:43:28', '2025-01-21 04:43:28'),
(39, '20250121102646_715.jpg', '2025-01-21 04:56:46', '2025-01-21 04:56:46'),
(40, '20250123144837_305.jpg', '2025-01-23 09:18:37', '2025-01-23 09:18:37'),
(41, '20250125095616_900.jpg', '2025-01-25 04:26:17', '2025-01-25 04:26:17'),
(42, '20250125095902_653.jpg', '2025-01-25 04:29:02', '2025-01-25 04:29:02'),
(43, '20250125095959_508.jpg', '2025-01-25 04:29:59', '2025-01-25 04:29:59'),
(44, '20250125100043_235.jpg', '2025-01-25 04:30:43', '2025-01-25 04:30:43'),
(45, '20250125100108_230.jpg', '2025-01-25 04:31:08', '2025-01-25 04:31:08'),
(46, '20250125100159_61.jpg', '2025-01-25 04:31:59', '2025-01-25 04:31:59'),
(49, '20250127073043_342.jpg', '2025-01-27 02:00:43', '2025-01-27 02:00:43'),
(52, '20250201044202_118.jpg', '2025-01-31 23:12:02', '2025-01-31 23:12:02'),
(54, '20250201045355_652.jpg', '2025-01-31 23:23:55', '2025-01-31 23:23:55'),
(55, '20250201045922_784.jpg', '2025-01-31 23:29:22', '2025-01-31 23:29:22'),
(56, '20250201052334_231.jpg', '2025-01-31 23:53:34', '2025-01-31 23:53:34'),
(57, '20250201052334_411.jpg', '2025-01-31 23:53:34', '2025-01-31 23:53:34'),
(58, '20250201053329_644.jpg', '2025-02-01 00:03:29', '2025-02-01 00:03:29'),
(59, '20250201065325_355.jpg', '2025-02-01 01:23:25', '2025-02-01 01:23:25'),
(60, '20250201070034_327.jpg', '2025-02-01 01:30:34', '2025-02-01 01:30:34'),
(61, '20250201070538_85.jpg', '2025-02-01 01:35:38', '2025-02-01 01:35:38'),
(62, '20250201070538_698.jpg', '2025-02-01 01:35:38', '2025-02-01 01:35:38'),
(63, '20250201070538_790.jpg', '2025-02-01 01:35:38', '2025-02-01 01:35:38'),
(64, '20250203022920_968.jpg', '2025-02-02 20:59:20', '2025-02-02 20:59:20'),
(65, '20250203024447_578.jpg', '2025-02-02 21:14:47', '2025-02-02 21:14:47'),
(66, '20250203052747_917.jpg', '2025-02-02 23:57:47', '2025-02-02 23:57:47'),
(67, '20250203052751_874.jpg', '2025-02-02 23:57:51', '2025-02-02 23:57:51'),
(68, '20250203060323_239.jpg', '2025-02-03 00:33:23', '2025-02-03 00:33:23'),
(69, '20250203060819_98.jpg', '2025-02-03 00:38:19', '2025-02-03 00:38:19'),
(70, '20250203060822_682.jpg', '2025-02-03 00:38:22', '2025-02-03 00:38:22'),
(72, '20250203060827_330.jpg', '2025-02-03 00:38:27', '2025-02-03 00:38:27'),
(73, '20250203060844_671.jpg', '2025-02-03 00:38:44', '2025-02-03 00:38:44'),
(74, '20250205064219_763.jpg', '2025-02-05 01:12:19', '2025-02-05 01:12:19'),
(75, '20250205064222_946.jpg', '2025-02-05 01:12:22', '2025-02-05 01:12:22'),
(76, '20250205080541_503.jpg', '2025-02-05 02:35:41', '2025-02-05 02:35:41'),
(78, '20250205080825_875.jpg', '2025-02-05 02:38:25', '2025-02-05 02:38:25'),
(79, '20250205080837_587.jpg', '2025-02-05 02:38:37', '2025-02-05 02:38:37'),
(80, '20250208060313_836.jpg', '2025-02-08 00:33:13', '2025-02-08 00:33:13'),
(81, '20250208060323_868.jpg', '2025-02-08 00:33:23', '2025-02-08 00:33:23'),
(82, '20250208060323_604.jpg', '2025-02-08 00:33:23', '2025-02-08 00:33:23'),
(83, '20250208060324_162.jpg', '2025-02-08 00:33:24', '2025-02-08 00:33:24'),
(84, '20250208060324_627.jpg', '2025-02-08 00:33:24', '2025-02-08 00:33:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1 => Admin, 0 => User',
  `gender` enum('M','F','O') DEFAULT NULL COMMENT 'M => Male, F => Female, O => Other',
  `country_code` varchar(7) NOT NULL DEFAULT '+91',
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `gender`, `country_code`, `phone`, `email`, `email_verified_at`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'S. Mali', '1', 'M', '+91', '9123944555', 'admin1@gmail.com', NULL, '$2y$10$nBvBHvCoL/jz2rb0hdFrT.MZBeC8zclomAzVtQfdSAtMK2f1xX55u', NULL, '1', '2024-09-17 05:07:16', '2025-03-19 05:26:56'),
(2, 'S. Sarma', '0', 'F', '+91', '9599912345', 'ssm@gmail.com', NULL, '$2y$10$6caZE0ArCJG3JL.dnYcAoOnMzQGMcHjs6/S/Q4wYnAx59QF3vEgTy', NULL, '1', '2024-09-17 05:19:40', '2024-09-17 05:19:40'),
(5, 'K. Mali', '0', 'M', '+91', '9222355515', 'shirsendu1260@gmail.com', NULL, '$2y$10$jllBfxrrI1jMFP99OzjDxuSsFYb2mENsDRrBilQb079nurrJtsmby', NULL, '1', '2025-02-14 05:57:38', '2025-03-22 03:33:51'),
(6, 'P. Biswas', '1', 'M', '+91', '7998899111', 'admin2@gmail.com', NULL, '$2y$10$Ia9lpqeujEOzfqC2U1sMKOcfZfP5PkiXQhsRB.dv1NXoEgD7pk3Ky', NULL, '1', '2025-03-18 01:23:54', '2025-03-18 01:23:54'),
(7, 'M. Paul', '1', 'F', '+91', '8888811550', 'admin3@gmail.com', NULL, '$2y$10$xbnfv2E8UB7iBnWMqUvnNODFohhTfLtv1lTrcrDs0ZDj4EPBrpP.C', NULL, '1', '2025-03-18 01:26:44', '2025-03-18 02:15:22'),
(8, 'P. Das', '0', 'M', '+91', '6666655221', 'pd@gmail.com', NULL, '$2y$10$YXXesCz.LAESrbOd/yyWw.we7v/VYpAMcnXTMK9kno7PjMtrm4wjC', NULL, '1', '2025-03-18 01:29:47', '2025-03-28 01:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 19, 5, '2025-03-12 05:59:15', '2025-03-12 05:59:15'),
(10, 7, 5, '2025-03-12 06:03:16', '2025-03-12 06:03:16'),
(13, 11, 5, '2025-03-12 07:22:45', '2025-03-12 07:22:45'),
(14, 23, 5, '2025-03-12 23:51:52', '2025-03-12 23:51:52'),
(15, 12, 5, '2025-03-12 23:54:02', '2025-03-12 23:54:02'),
(16, 16, 5, '2025-03-14 22:41:27', '2025-03-14 22:41:27'),
(17, 23, 2, '2025-03-24 23:05:51', '2025-03-24 23:05:51'),
(18, 13, 2, '2025-03-24 23:05:59', '2025-03-24 23:05:59'),
(19, 8, 2, '2025-03-24 23:06:05', '2025-03-24 23:06:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_addresses_user_id_foreign` (`user_id`),
  ADD KEY `customer_addresses_country_id_foreign` (`country_id`);

--
-- Indexes for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_country_id_foreign` (`country_id`),
  ADD KEY `orders_discount_coupon_id_foreign` (`discount_coupon_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ratings_product_id_foreign` (`product_id`),
  ADD KEY `product_ratings_user_id_foreign` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_main_admin_id_foreign` (`main_admin_id`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_charges_country_id_foreign` (`country_id`);

--
-- Indexes for table `static_pages`
--
ALTER TABLE `static_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `temp_images`
--
ALTER TABLE `temp_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `static_pages`
--
ALTER TABLE `static_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `temp_images`
--
ALTER TABLE `temp_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `customer_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_discount_coupon_id_foreign` FOREIGN KEY (`discount_coupon_id`) REFERENCES `discount_coupons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD CONSTRAINT `product_ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_main_admin_id_foreign` FOREIGN KEY (`main_admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD CONSTRAINT `shipping_charges_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
