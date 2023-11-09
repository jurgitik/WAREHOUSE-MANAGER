-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2023 at 12:11 PM
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
-- Database: `warehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'product category ID',
  `name` varchar(100) NOT NULL COMMENT 'product category NAME',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Daugiasluoksnių vamzdžių sistemos', '2023-10-18 15:13:10', '2023-10-18 15:13:10'),
(2, 'Plieniniai vamzdžiai ir ketinės jungtys', '2023-10-18 15:13:10', '2023-10-18 15:13:10'),
(3, 'Žalvarinės, bronzinės ir chromuotos jungtys', '2023-10-18 15:14:43', '2023-10-18 15:14:43'),
(4, 'Uždaromoji santechninė armatūra', '2023-10-18 15:14:43', '2023-10-18 15:14:43'),
(5, 'Variniai vamzdžiai ir jungtys', '2023-10-23 13:02:21', '2023-10-23 13:02:21'),
(6, 'Presuojamo plieno sistema', '2023-10-23 13:02:21', '2023-10-23 13:02:21'),
(7, 'Lituojama PPR vamzdžių sistema', '2023-10-23 13:02:21', '2023-10-23 13:02:21'),
(8, 'Grindų šildymo sistemos', '2023-10-23 13:02:21', '2023-10-23 13:02:21'),
(9, 'Kolektoriai, kolektorinės spintelės ir revizinės durelės', '2023-10-23 13:02:21', '2023-10-23 13:02:21'),
(10, 'Dujiniai katilai ir šilumos siurbliai ', '2023-10-23 13:02:21', '2023-10-23 13:02:21'),
(11, 'Vidaus nuotekų vamzdžių sistemos', '2023-10-23 13:08:33', '2023-10-23 13:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'manufacturer ID',
  `name` varchar(50) NOT NULL COMMENT 'manufacturer NAME',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Wavin', '2023-10-23 12:40:10', '2023-10-23 12:40:10'),
(2, 'Uponor', '2023-10-23 12:57:15', '2023-10-23 12:57:15'),
(3, 'KAN-therm', '2023-10-23 12:57:15', '2023-10-23 12:57:15');

-- --------------------------------------------------------

--
-- Table structure for table `measure_units`
--

CREATE TABLE `measure_units` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'unit of measurement ID',
  `name` varchar(50) NOT NULL COMMENT 'unit of measurement NAME',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `measure_units`
--

INSERT INTO `measure_units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'vnt.', '2023-10-23 12:40:28', '2023-10-23 12:40:28'),
(2, 'm', '2023-10-23 12:40:28', '2023-10-23 12:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'product ID',
  `name` varchar(200) NOT NULL COMMENT 'product NAME',
  `factory_code` varchar(50) NOT NULL COMMENT 'product FACTORY CODE',
  `description` varchar(50) NOT NULL COMMENT 'product DESCRIPTION',
  `image` varchar(1000) NOT NULL COMMENT 'product IMAGE',
  `amount` int(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'product AMOUNT',
  `user_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'connection with user from table users',
  `category_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'connection with category from table categories',
  `subcategory_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'connection with subcategory from table subcategories	',
  `manufacturer_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'connection with manufacturer from table manufacturers',
  `supplier_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'connection with supplier from table suppliers',
  `measure_unit_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'connection with unit of measure from table measure_units',
  `price` float UNSIGNED NOT NULL COMMENT 'product PRICE',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'product CREATED DATE',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'product UPDATED DATE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `factory_code`, `description`, `image`, `amount`, `user_id`, `category_id`, `subcategory_id`, `manufacturer_id`, `supplier_id`, `measure_unit_id`, `price`, `created_at`, `updated_at`) VALUES
(15, 'Presuojama jungtis TIGRIS K5', '3079754', '16x16', 'https://rainer.synology.me/onninen/kainorastis/img/ATO892.jpg', 10, 1, 1, 3, 1, 1, 1, 4, '2023-10-18 16:10:43', '2023-10-18 16:10:43'),
(26, 'Presuojama jungtis TIGRIS K5', '3079755', '20x20', 'https://rainer.synology.me/onninen/kainorastis/img/ATO892.jpg', 8, 1, 1, 3, 1, 1, 1, 4.84, '2023-10-18 17:42:28', '2023-10-18 17:42:29'),
(27, 'Presuojama jungtis TIGRIS K5', '3079756', '25x25', 'https://rainer.synology.me/onninen/kainorastis/img/ATO892.jpg', 4, 1, 1, 3, 1, 1, 1, 7.01, '2023-10-23 13:31:40', '2023-10-23 13:31:40'),
(28, 'Presuojama jungtis TIGRIS K5', '3079757', '32x32', 'https://rainer.synology.me/onninen/kainorastis/img/ATO892.jpg', 0, 1, 1, 3, 1, 1, 1, 11.34, '2023-10-23 13:46:30', '2023-10-23 13:46:30'),
(29, 'PEX-AL-PE daugiasluoksnis vamzdis su izoliacija 6m', '3070011', '16x2,0 L=50 m, raudonas', 'https://rainer.synology.me/onninen/kainorastis/img/CGL151.jpg', 79, 1, 1, 3, 1, 1, 2, 2.71, '2023-10-23 13:46:30', '2023-10-23 13:46:30'),
(30, 'PEX-AL-PE daugiasluoksnis vamzdis', '3030909', '16x2,0 L=200 m', 'https://rainer.synology.me/onninen/kainorastis/img/ATO884.jpg', 50, 1, 1, 3, 1, 1, 2, 1.64, '2023-10-23 14:00:04', '2023-10-23 14:00:04'),
(31, 'PEX-AL-PE daugiasluoksnis vamzdis', '3069777', '18x2,0 L=200 m', 'https://rainer.synology.me/onninen/kainorastis/img/ATO884.jpg', 22, 1, 1, 3, 1, 1, 2, 2.07, '2023-10-23 14:00:24', '2023-10-23 14:00:24'),
(32, 'Presuojama alkūnė 90° TIGRIS K5 su vidiniu sriegiu', '3079782', '16x1/2\"', 'https://rainer.synology.me/onninen/kainorastis/img/ATO922.jpg', 16, 1, 1, 3, 1, 1, 1, 6.45, '2023-10-23 14:00:24', '2023-10-23 14:00:24'),
(33, 'Presuojama aklė TIGRIS K5', '3079859', 'D16', 'https://rainer.synology.me/onninen/kainorastis/img/atp171.jpg', 12, 1, 1, 3, 1, 1, 1, 6.39, '2023-10-23 14:03:47', '2023-10-23 14:03:47'),
(34, 'Montažinė plokštelė ilga', '4013585', '423x50x50', 'https://rainer.synology.me/onninen/kainorastis/img/ATO928.jpg', 84, 1, 1, 3, 1, 1, 1, 13.43, '2023-10-23 14:03:47', '2023-10-23 14:03:47'),
(35, 'PP vamzdis su mova', '3078870', 'D50x1,8x250', 'https://rainer.synology.me/onninen/kainorastis/img/HGK919.jpg', 40, 1, 11, 4, 1, 1, 1, 2.11, '2023-10-23 14:08:44', '2023-10-23 14:08:44'),
(36, 'PP vamzdis su mova', '3091170', 'D110x3,4x3000', 'https://rainer.synology.me/onninen/kainorastis/img/HGK919.jpg', 7, 1, 11, 4, 1, 1, 1, 33.35, '2023-10-23 14:08:44', '2023-10-23 14:08:44'),
(37, 'PP dviguba mova', '3067799', 'D50', 'https://rainer.synology.me/onninen/kainorastis/img/HGL007.jpg', 2, 1, 11, 4, 1, 1, 1, 2.71, '2023-10-23 15:57:19', '2023-10-23 15:57:19'),
(38, 'PP dviguba mova', '3067802	', 'D110', 'https://rainer.synology.me/onninen/kainorastis/img/HGL007.jpg', 5, 1, 11, 4, 1, 1, 1, 5.21, '2023-10-23 15:57:19', '2023-10-23 15:57:19'),
(39, 'PP perėjimas', '3067816', 'D110/50', 'https://rainer.synology.me/onninen/kainorastis/img/HGK999.jpg', 10, 1, 11, 4, 1, 1, 1, 4.13, '2023-10-23 15:57:19', '2023-10-23 15:57:19'),
(40, 'PP alkūnė', '3067718', 'D50x30°', 'https://rainer.synology.me/onninen/kainorastis/img/HGK945.jpg', 3, 1, 11, 4, 1, 1, 1, 1.82, '2023-10-23 15:57:19', '2023-10-23 15:57:19'),
(41, 'PP alkūnė', '3067729', 'D110x45°', 'https://rainer.synology.me/onninen/kainorastis/img/HGK945.jpg', 1, 1, 11, 4, 1, 1, 1, 4.13, '2023-10-23 15:57:19', '2023-10-23 15:57:19'),
(42, 'PP trišakis', '3067751', 'D50/50x45°', 'https://rainer.synology.me/onninen/kainorastis/img/HGK968.jpg', 3, 1, 11, 4, 1, 1, 1, 3.62, '2023-10-23 15:57:19', '2023-10-23 15:57:19'),
(43, 'PP pravala', '3067784', 'D50', 'https://rainer.synology.me/onninen/kainorastis/img/HGL021.jpg', 15, 1, 11, 4, 1, 1, 1, 7.33, '2023-10-23 15:57:19', '2023-10-23 15:57:19'),
(44, 'PP Aklė', '3067825', 'D50', 'https://rainer.synology.me/onninen/kainorastis/img/HGL016.jpg', 66, 1, 11, 4, 1, 1, 1, 2.47, '2023-10-23 15:57:19', '2023-10-23 15:57:19'),
(45, 'PE-RT/AL/PE-RT UNIPIPE PLUS daugiasluoksnis besiūlis vamzdis', '1059577', '16x2,0 L=200 m', 'https://rainer.synology.me/onninen/kainorastis/img/ATM021.jpg', 0, 1, 1, 2, 2, 1, 2, 1.7, '2023-10-23 16:21:10', '2023-10-23 16:21:10'),
(46, 'PE-RT/AL/PE-RT UNIPIPE PLUS daugiasluoksnis vamzdis su apsauginiu šarvu, ilgis 75 m', '1063061', '16x2,0 raudoname 25/20 šarve', 'https://rainer.synology.me/onninen/kainorastis/img/1013679.jpg', 20, 1, 1, 2, 2, 1, 2, 3.95, '2023-10-23 16:21:10', '2023-10-23 16:21:10'),
(47, 'PE-RT/AL/PE-RT UNIPIPE PLUS daugiasluoksnis vamzdis su apsauginiu šarvu, ilgis 75 m', '1063059', '16x2,0 mėlyname 25/20 šarve', 'https://rainer.synology.me/onninen/kainorastis/img/1013679.jpg', 0, 1, 1, 2, 2, 1, 2, 3.95, '2023-10-23 16:21:10', '2023-10-23 16:21:10'),
(48, 'Užveržiama jungtis MLC', '1058092', '20x3/4\"FT Euro', 'https://rainer.synology.me/onninen/kainorastis/img/AGD831.jpg', 5, 1, 1, 2, 2, 1, 1, 5.05, '2023-10-23 16:21:10', '2023-10-23 16:21:10'),
(49, 'Presuojama alkūnė 90°', '1039929', '16x16 PPSU', 'https://rainer.synology.me/onninen/kainorastis/img/ADV146.jpg', 3, 1, 1, 2, 2, 1, 1, 3.31, '2023-10-23 16:21:10', '2023-10-23 16:21:10'),
(50, 'S-Press PLUS presuojama alkūnė 90° su išoriniu sriegiu', '1070532', '16x1/2\"', 'https://rainer.synology.me/onninen/kainorastis/img/CGT953.jpg', 0, 1, 1, 2, 2, 1, 1, 4.6, '2023-10-23 16:21:10', '2023-10-23 16:21:10'),
(51, 'S-Press PLUS presuojama alkūnė 90° su vidiniu sriegiu', '1070539', '16x1/2\"', 'https://rainer.synology.me/onninen/kainorastis/img/CGT969.jpg', 12, 1, 1, 2, 2, 1, 1, 5.63, '2023-10-23 16:21:10', '2023-10-23 16:21:10'),
(52, 'S-Press PLUS presuojama prietaisinė alkūnė', '1070639', 'MLC FL tipo, 16x1/2\" vidinis sriegis', 'https://rainer.synology.me/onninen/kainorastis/img/CHD132.jpg', 2, 1, 1, 2, 2, 1, 1, 7.9, '2023-10-23 16:21:10', '2023-10-23 16:21:10'),
(53, 'S-Press PLUS presuojama prietaisinė alkūnė', '1070630', 'MLC \"U\" formos 20-Rp1/2\"FT-20', 'https://rainer.synology.me/onninen/kainorastis/img/CHE000.jpg', 2, 1, 1, 2, 2, 1, 1, 51, '2023-10-23 16:21:10', '2023-10-23 16:21:10'),
(54, 'Presuojamas trišakis', '1039944', '16x16x16 PPSU', 'https://rainer.synology.me/onninen/kainorastis/img/ADV196.jpg', 0, 1, 1, 2, 2, 1, 1, 4.43, '2023-10-23 16:21:10', '2023-10-23 16:21:10'),
(55, 'Vamzdis PN16 (S3,2/SDR7,4), ilgis 4 m', '1229203001', '20x2,8', 'https://rainer.synology.me/onninen/kainorastis/img/HAM088.jpg', 38, 1, 7, 1, 3, 1, 2, 1.19, '2023-10-23 16:38:51', '2023-10-23 16:38:51'),
(56, 'Vamzdis PN20 (S2,5/SDR6) STABI AL, ilgis 4 m', '1229205002', '110x18,3', 'https://rainer.synology.me/onninen/kainorastis/img/HAM122.jpg', 20, 1, 7, 1, 3, 1, 2, 87.98, '2023-10-23 16:38:51', '2023-10-23 16:38:51'),
(57, 'Vamzdis PN16 (S3,2/SDR7,4) GLASS, ilgis 4 m', '1229204002', '20x2,8', 'https://rainer.synology.me/onninen/kainorastis/img/HAM105.jpg', 0, 1, 7, 1, 3, 1, 2, 2.35, '2023-10-23 16:38:51', '2023-10-23 16:38:51'),
(58, 'Balninė jungtis PP x PUSH', '1209238009', '110/18x2', 'https://rainer.synology.me/onninen/kainorastis/img/HAL427.jpg', 14, 1, 7, 1, 3, 1, 1, 9.78, '2023-10-23 16:38:51', '2023-10-23 16:38:51'),
(59, 'Balninė jungtis PP su vidiniu sriegiu', '1209230003', '110x½', 'https://rainer.synology.me/onninen/kainorastis/img/HAL431.jpg', 14, 1, 7, 1, 3, 1, 1, 6.97, '2023-10-23 16:38:51', '2023-10-23 16:38:51'),
(60, 'Mova', '1209245008', '75', 'https://rainer.synology.me/onninen/kainorastis/img/HAL254.jpg', 0, 1, 7, 1, 3, 1, 1, 5.11, '2023-10-23 16:38:51', '2023-10-23 16:38:51'),
(61, 'Perėjimas', '1209220006', '25x20', 'https://rainer.synology.me/onninen/kainorastis/img/HAL385.jpg', 2, 1, 7, 1, 3, 1, 1, 0.28, '2023-10-23 16:38:51', '2023-10-23 16:38:51'),
(62, 'Perėjimas', '1209220007', '32x20', 'https://rainer.synology.me/onninen/kainorastis/img/HAL385.jpg', 0, 1, 7, 1, 3, 1, 1, 0.37, '2023-10-23 16:38:51', '2023-10-23 16:38:51'),
(63, 'Trišakis', '1209257000', '110', 'https://rainer.synology.me/onninen/kainorastis/img/HAL348.jpg', 10, 1, 7, 1, 3, 1, 1, 31.34, '2023-10-23 16:38:51', '2023-10-23 16:38:51'),
(64, 'Keturšakis', '1209057001', '20', 'https://rainer.synology.me/onninen/kainorastis/img/HAL374.jpg', 0, 1, 7, 1, 3, 1, 1, 0.65, '2023-10-23 16:38:51', '2023-10-23 16:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'subcategory ID',
  `name` varchar(100) NOT NULL COMMENT 'subcategory NAME',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'KAN-therm PPR vamzdžių sistema', '2023-10-23 13:14:08', '2023-10-23 13:14:08'),
(2, 'UPONOR MLC daugiasluoksnių vamzdžių sistema', '2023-10-23 13:14:08', '2023-10-23 13:14:08'),
(3, 'WAVIN TIGRIS daugiasluoksnių vamzdžių sistema', '2023-10-23 13:19:29', '2023-10-23 13:19:29'),
(4, 'WAVIN SITECH+ mažatriukšmė vidaus nuotekų sistema', '2023-10-23 13:20:12', '2023-10-23 13:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'supplier ID',
  `name` varchar(50) NOT NULL COMMENT 'supplier NAME',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Onninen', '2023-10-23 12:42:44', '2023-10-23 12:42:44'),
(2, 'Jaukurai', '2023-10-23 12:42:44', '2023-10-23 12:42:44'),
(3, 'Krasas', '2023-10-23 12:55:24', '2023-10-23 12:55:24'),
(4, 'Saneko', '2023-10-23 12:55:24', '2023-10-23 12:55:24'),
(5, 'Sanistal', '2023-10-23 12:55:59', '2023-10-23 12:55:59'),
(6, 'Aquatera', '2023-10-23 12:55:59', '2023-10-23 12:55:59');

-- --------------------------------------------------------

--
-- Table structure for table `taken_products`
--

CREATE TABLE `taken_products` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID of taken products',
  `taken_amount` int(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'TAKEN_AMOUNT of product',
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `product_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taken_products`
--

INSERT INTO `taken_products` (`id`, `taken_amount`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(2, 100, 2, 63, NULL, NULL),
(28, 19, 2, 29, NULL, NULL),
(31, 2, 2, 26, NULL, NULL),
(33, 3, 2, 27, NULL, NULL),
(34, 10, 2, 55, NULL, NULL),
(35, 50, 2, 15, NULL, NULL),
(36, 15, 3, 15, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'user ID',
  `email` varchar(50) NOT NULL COMMENT 'user E-MAIL',
  `first_name` varchar(20) NOT NULL COMMENT 'user FIRST NAME',
  `last_name` varchar(30) NOT NULL COMMENT 'user LAST NAME',
  `password` varchar(50) NOT NULL COMMENT 'user PASSWORD',
  `is_admin` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'is ADMIN 1(true)/0(false)',
  `position` varchar(50) NOT NULL COMMENT 'user JOB POSITION',
  `photo` varchar(500) NOT NULL COMMENT 'user PHOTO',
  `contact` bigint(8) NOT NULL COMMENT 'user PHONE NUMBER',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'user CREATED DATE',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'user UPDATED DATE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `password`, `is_admin`, `position`, `photo`, `contact`, `created_at`, `updated_at`) VALUES
(1, 'admin@san.lt', 'antanas', 'gerulskis', 'bf4aa40d92273f41e970a4428e1128a5', 1, 'Darbų vadovas', 'https://images.pexels.com/photos/4981783/pexels-photo-4981783.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 65075298, '2023-10-18 12:49:45', '2023-10-18 12:49:45'),
(2, 'drasutis@san.lt', 'petras', 'drąsutis', 'bf4aa40d92273f41e970a4428e1128a5', 0, 'Meistras', 'https://images.pexels.com/photos/8960992/pexels-photo-8960992.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 68549533, '2023-10-18 13:22:22', '2023-10-18 13:22:22'),
(3, 'zibalas@san.lt', 'jonas', 'žibalas', 'bf4aa40d92273f41e970a4428e1128a5', 0, 'Meistras', 'https://images.pexels.com/photos/16633751/pexels-photo-16633751/free-photo-of-a-man-in-a-yellow-shirt-and-orange-helmet-standing-next-to-a-bulldozer.jpeg', 68299931, '2023-10-18 13:30:04', '2023-10-18 13:30:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `measure_units`
--
ALTER TABLE `measure_units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `factory_code` (`factory_code`),
  ADD KEY `categories` (`category_id`) USING BTREE,
  ADD KEY `users` (`user_id`) USING BTREE,
  ADD KEY `subcategories` (`subcategory_id`),
  ADD KEY `manufacturers` (`manufacturer_id`) USING BTREE,
  ADD KEY `measure_units` (`measure_unit_id`) USING BTREE,
  ADD KEY `suppliers` (`supplier_id`) USING BTREE;

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `taken_products`
--
ALTER TABLE `taken_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products` (`product_id`) USING BTREE,
  ADD KEY `taken_users` (`user_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'product category ID', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'manufacturer ID', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `measure_units`
--
ALTER TABLE `measure_units`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'unit of measurement ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'product ID', AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'subcategory ID', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'supplier ID', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `taken_products`
--
ALTER TABLE `taken_products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID of taken products', AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'user ID', AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `manufacturers` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers` (`id`),
  ADD CONSTRAINT `measure_units` FOREIGN KEY (`measure_unit_id`) REFERENCES `measure_units` (`id`),
  ADD CONSTRAINT `subcategories` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`),
  ADD CONSTRAINT `suppliers` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  ADD CONSTRAINT `users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `taken_products`
--
ALTER TABLE `taken_products`
  ADD CONSTRAINT `products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `taken_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
