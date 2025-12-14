-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2025 at 07:25 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warung_soto_vokasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `phone`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@warung-soto.com', '$2y$12$MhtaJQjjYFsCg2iFLnB5u.tvBnDmAi1p.gtkD.AZ9E9.KMqPGChpm', '081234567890', 'superadmin', '2025-11-27 18:49:05', '2025-11-27 18:49:05'),
(2, 'Admin Warung', 'admin@warung-soto.com', '$2y$12$VxrLEKt6PDwH0/wZbdBUeOVxuyqs0FqqtP1OTIsc6WokrO6Z1WI8e', '081234567891', 'admin', '2025-11-27 18:49:05', '2025-11-27 18:49:05');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('warung-soto-vokasi-cache-masyhurrr@student.ub.ac.id|127.0.0.1', 'i:1;', 1764682840),
('warung-soto-vokasi-cache-masyhurrr@student.ub.ac.id|127.0.0.1:timer', 'i:1764682840;', 1764682840);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', 'makanan', NULL, '2025-11-28 00:14:45', '2025-11-28 00:15:01'),
(2, 'Minuman', 'minuman', NULL, '2025-11-28 00:14:55', '2025-11-28 00:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(19, 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'Masukan', 'Menurut saya perlu membuka cabang dan menambahkan karyawan karena setiap saya ingin beli soto warung selalu ramai dan tempat nya itu full sampai saya engga bingung untuk makan dimana dan harus antri panjang.', 1, '2025-11-29 17:51:24', '2025-12-05 10:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `order`, `created_at`, `updated_at`) VALUES
(2, 'Jam Berapa Soto Vokasi Buka ?', 'Senin - Sabtu (Tergantung Mood) 07.00 - Habis', 0, '2025-11-28 10:32:00', '2025-11-28 10:32:00'),
(3, 'Apakah Bisa Melakukan Reservasi Tempat ?', 'Bisa, kita terbuka untuk acara tertentu', 0, '2025-11-28 10:32:57', '2025-11-28 10:32:57'),
(4, 'Apakah Tersedia Layanan Pesan Antar', 'Iya, kita menyediakan layanan pesan & antar', 0, '2025-11-28 10:33:46', '2025-11-28 10:33:46'),
(5, 'apakah ada menu yang lain selain soto', 'iya disini terdapat banyak menu salah satunya nyambik', 0, '2025-11-29 09:50:40', '2025-11-29 09:50:40');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_28_011317_create_admins_table', 1),
(5, '2025_11_28_011335_create_testimonis_table', 1),
(6, '2025_11_28_011340_create_faqs_table', 1),
(7, '2025_11_28_011345_create_contact_messages_table', 1),
(8, '2025_11_28_012739_create_categories_table', 1),
(9, '2025_11_28_012758_create_products_table', 1),
(10, '2025_11_28_072724_create_orders_table', 2),
(11, '2025_11_28_072732_create_order_items_table', 2),
(12, '2025_11_28_140525_create_payment_histories_table', 2),
(13, '2025_12_02_070619_add_profile_fields_to_users_table', 3),
(14, '2025_12_03_134905_add_order_status_to_orders_table', 4),
(15, '2025_12_05_135151_create_notifications_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(12,2) NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `midtrans_transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `total_amount`, `payment_status`, `order_status`, `midtrans_transaction_id`, `payment_method`, `notes`, `created_at`, `updated_at`) VALUES
(2, 'ORD-20251202152449-F84763', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '134000.00', 'paid', 'completed', NULL, NULL, NULL, '2025-12-02 08:24:49', '2025-12-03 07:11:50'),
(3, 'ORD-20251203034343-312021', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '104000.00', 'paid', 'completed', NULL, NULL, NULL, '2025-12-02 20:43:43', '2025-12-03 07:12:08'),
(4, 'ORD-20251203034645-B19732', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '136000.00', 'pending', 'pending', NULL, NULL, NULL, '2025-12-02 20:46:45', '2025-12-02 20:46:45'),
(5, 'ORD-20251203034744-26947C', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '100000.00', 'pending', 'pending', NULL, NULL, NULL, '2025-12-02 20:47:44', '2025-12-02 20:47:44'),
(6, 'ORD-20251203035143-238A78', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '110000.00', 'pending', 'pending', NULL, NULL, NULL, '2025-12-02 20:51:43', '2025-12-02 20:51:43'),
(7, 'ORD-20251203035603-40E25B', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '110000.00', 'pending', 'pending', NULL, NULL, NULL, '2025-12-02 20:56:03', '2025-12-02 20:56:03'),
(8, 'ORD-20251203040537-78DEA7', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '20000.00', 'pending', 'pending', NULL, NULL, NULL, '2025-12-02 21:05:37', '2025-12-02 21:05:37'),
(9, 'ORD-20251203040641-DC405D', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '34000.00', 'pending', 'pending', NULL, NULL, NULL, '2025-12-02 21:06:41', '2025-12-02 21:06:41'),
(10, 'ORD-20251203041922-8090FA', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '34000.00', 'pending', 'pending', NULL, NULL, NULL, '2025-12-02 21:19:22', '2025-12-02 21:19:22'),
(11, 'ORD-20251203041955-6BE0DE', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '50000.00', 'pending', 'pending', NULL, NULL, NULL, '2025-12-02 21:19:55', '2025-12-02 21:19:55'),
(12, 'ORD-20251203042325-5701A0', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '1000.00', 'pending', 'pending', NULL, NULL, NULL, '2025-12-02 21:23:25', '2025-12-02 21:23:25'),
(13, 'ORD-20251203044138-83FC8A', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '54000.00', 'pending', 'pending', NULL, NULL, NULL, '2025-12-02 21:41:38', '2025-12-02 21:41:38'),
(14, 'ORD-20251203050311-93FABC', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '136000.00', 'paid', 'completed', NULL, NULL, NULL, '2025-12-02 22:03:11', '2025-12-03 07:41:15'),
(15, 'ORD-20251203052938-D87428', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '81000.00', 'paid', 'completed', NULL, NULL, NULL, '2025-12-02 22:29:38', '2025-12-03 07:04:01'),
(16, 'ORD-20251203053029-3D38C0', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '34000.00', 'paid', 'completed', NULL, NULL, NULL, '2025-12-02 22:30:29', '2025-12-03 07:07:09'),
(17, 'ORD-20251203061326-6AF791', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '54000.00', 'paid', 'completed', NULL, NULL, NULL, '2025-12-02 23:13:26', '2025-12-03 07:07:17'),
(18, 'ORD-20251203065011-AC96C0', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '80000.00', 'paid', 'completed', NULL, NULL, NULL, '2025-12-02 23:50:11', '2025-12-03 07:07:25'),
(19, 'ORD-20251203065415-15F0F5', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '108000.00', 'paid', 'completed', NULL, NULL, NULL, '2025-12-02 23:54:15', '2025-12-03 07:07:33'),
(20, 'ORD-20251205173505-349880', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '3000.00', 'pending', 'pending', NULL, NULL, NULL, '2025-12-05 10:35:05', '2025-12-05 10:35:05'),
(21, 'ORD-20251206083340-6D5E30', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '25000.00', 'pending', 'pending', NULL, NULL, NULL, '2025-12-06 01:33:40', '2025-12-06 01:33:40'),
(22, 'ORD-20251206083823-56408E', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '100000.00', 'pending', 'pending', NULL, NULL, NULL, '2025-12-06 01:38:23', '2025-12-06 01:38:23'),
(23, 'ORD-20251210095902-D89AE1', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '31000.00', 'pending', 'pending', NULL, NULL, NULL, '2025-12-10 02:59:02', '2025-12-10 02:59:02'),
(24, 'ORD-20251212201650-8B45EF', 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', '087785711752', 'malang', '25000.00', 'pending', 'pending', NULL, NULL, NULL, '2025-12-12 13:16:50', '2025-12-12 13:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 2, '15000.00', '30000.00', '2025-12-02 08:24:49', '2025-12-02 08:24:49'),
(3, 2, 2, 2, '20000.00', '40000.00', '2025-12-02 08:24:49', '2025-12-02 08:24:49'),
(4, 2, 3, 4, '5000.00', '20000.00', '2025-12-02 08:24:49', '2025-12-02 08:24:49'),
(5, 2, 5, 2, '22000.00', '44000.00', '2025-12-02 08:24:49', '2025-12-02 08:24:49'),
(6, 3, 2, 4, '20000.00', '80000.00', '2025-12-02 20:43:43', '2025-12-02 20:43:43'),
(7, 3, 7, 4, '1000.00', '4000.00', '2025-12-02 20:43:43', '2025-12-02 20:43:43'),
(8, 3, 8, 4, '5000.00', '20000.00', '2025-12-02 20:43:43', '2025-12-02 20:43:43'),
(9, 4, 2, 5, '20000.00', '100000.00', '2025-12-02 20:46:45', '2025-12-02 20:46:45'),
(10, 4, 7, 6, '1000.00', '6000.00', '2025-12-02 20:46:45', '2025-12-02 20:46:45'),
(11, 4, 8, 6, '5000.00', '30000.00', '2025-12-02 20:46:45', '2025-12-02 20:46:45'),
(12, 5, 2, 4, '20000.00', '80000.00', '2025-12-02 20:47:44', '2025-12-02 20:47:44'),
(13, 5, 3, 4, '5000.00', '20000.00', '2025-12-02 20:47:44', '2025-12-02 20:47:44'),
(14, 6, 6, 5, '10000.00', '50000.00', '2025-12-02 20:51:43', '2025-12-02 20:51:43'),
(15, 6, 9, 5, '12000.00', '60000.00', '2025-12-02 20:51:43', '2025-12-02 20:51:43'),
(16, 7, 6, 5, '10000.00', '50000.00', '2025-12-02 20:56:03', '2025-12-02 20:56:03'),
(17, 7, 9, 5, '12000.00', '60000.00', '2025-12-02 20:56:03', '2025-12-02 20:56:03'),
(18, 8, 8, 4, '5000.00', '20000.00', '2025-12-02 21:05:37', '2025-12-02 21:05:37'),
(19, 9, 8, 2, '5000.00', '10000.00', '2025-12-02 21:06:41', '2025-12-02 21:06:41'),
(20, 9, 9, 2, '12000.00', '24000.00', '2025-12-02 21:06:41', '2025-12-02 21:06:41'),
(21, 10, 8, 2, '5000.00', '10000.00', '2025-12-02 21:19:22', '2025-12-02 21:19:22'),
(22, 10, 9, 2, '12000.00', '24000.00', '2025-12-02 21:19:22', '2025-12-02 21:19:22'),
(23, 11, 2, 2, '20000.00', '40000.00', '2025-12-02 21:19:55', '2025-12-02 21:19:55'),
(24, 11, 3, 2, '5000.00', '10000.00', '2025-12-02 21:19:55', '2025-12-02 21:19:55'),
(25, 12, 7, 1, '1000.00', '1000.00', '2025-12-02 21:23:25', '2025-12-02 21:23:25'),
(26, 13, 3, 2, '5000.00', '10000.00', '2025-12-02 21:41:38', '2025-12-02 21:41:38'),
(27, 13, 5, 2, '22000.00', '44000.00', '2025-12-02 21:41:38', '2025-12-02 21:41:38'),
(28, 14, 2, 3, '20000.00', '60000.00', '2025-12-02 22:03:11', '2025-12-02 22:03:11'),
(29, 14, 3, 2, '5000.00', '10000.00', '2025-12-02 22:03:11', '2025-12-02 22:03:11'),
(30, 14, 5, 3, '22000.00', '66000.00', '2025-12-02 22:03:11', '2025-12-02 22:03:11'),
(31, 15, 3, 3, '5000.00', '15000.00', '2025-12-02 22:29:38', '2025-12-02 22:29:38'),
(32, 15, 5, 3, '22000.00', '66000.00', '2025-12-02 22:29:38', '2025-12-02 22:29:38'),
(33, 16, 8, 2, '5000.00', '10000.00', '2025-12-02 22:30:29', '2025-12-02 22:30:29'),
(34, 16, 9, 2, '12000.00', '24000.00', '2025-12-02 22:30:29', '2025-12-02 22:30:29'),
(35, 17, 7, 3, '1000.00', '3000.00', '2025-12-02 23:13:26', '2025-12-02 23:13:26'),
(36, 17, 8, 3, '5000.00', '15000.00', '2025-12-02 23:13:26', '2025-12-02 23:13:26'),
(37, 17, 9, 3, '12000.00', '36000.00', '2025-12-02 23:13:26', '2025-12-02 23:13:26'),
(38, 18, 7, 5, '1000.00', '5000.00', '2025-12-02 23:50:11', '2025-12-02 23:50:11'),
(39, 18, 8, 3, '5000.00', '15000.00', '2025-12-02 23:50:11', '2025-12-02 23:50:11'),
(40, 18, 9, 5, '12000.00', '60000.00', '2025-12-02 23:50:11', '2025-12-02 23:50:11'),
(41, 19, 3, 4, '5000.00', '20000.00', '2025-12-02 23:54:15', '2025-12-02 23:54:15'),
(42, 19, 5, 4, '22000.00', '88000.00', '2025-12-02 23:54:15', '2025-12-02 23:54:15'),
(43, 20, 7, 3, '1000.00', '3000.00', '2025-12-05 10:35:05', '2025-12-05 10:35:05'),
(44, 21, 3, 5, '5000.00', '25000.00', '2025-12-06 01:33:40', '2025-12-06 01:33:40'),
(45, 22, 2, 4, '20000.00', '80000.00', '2025-12-06 01:38:23', '2025-12-06 01:38:23'),
(46, 22, 3, 4, '5000.00', '20000.00', '2025-12-06 01:38:23', '2025-12-06 01:38:23'),
(47, 23, 7, 6, '1000.00', '6000.00', '2025-12-10 02:59:02', '2025-12-10 02:59:02'),
(48, 23, 8, 5, '5000.00', '25000.00', '2025-12-10 02:59:02', '2025-12-10 02:59:02'),
(49, 24, 2, 1, '20000.00', '20000.00', '2025-12-12 13:16:50', '2025-12-12 13:16:50'),
(50, 24, 3, 1, '5000.00', '5000.00', '2025-12-12 13:16:50', '2025-12-12 13:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('masyhurrr@gmail.com', '$2y$12$MQBJzNFdk2MO3FXigE0hueoTWVGas8YW2cTsxLz1hMud4gh1eKRs6', '2025-12-06 01:09:49'),
('muhammadhabibmasyhur14@gmail.com', '$2y$12$84p.OVGkR6/MJdVcJ9S2geId.GX2vEzNGvLGjeaWsJAtnr1QmQr0y', '2025-12-02 05:51:37');

-- --------------------------------------------------------

--
-- Table structure for table `payment_histories`
--

CREATE TABLE `payment_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ingredients` text COLLATE utf8mb4_unicode_ci,
  `is_halal` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `price`, `image`, `ingredients`, `is_halal`, `created_at`, `updated_at`) VALUES
(1, 1, 'Soto Ayam Spesial', 'soto-ayam-spesial', 'Soto ayam dengan kuah bening kaya rempah, suwiran ayam, soun, tauge, dan telur rebus.', '15000.00', 'images/products/1764341144.jpg', NULL, 1, '2025-11-28 07:45:44', '2025-11-28 07:45:44'),
(2, 1, 'Soto Daging Sapi', 'soto-daging-sapi', 'Soto dengan potongan daging sapi empuk, kuah kaldu sapi yang gurih, dan pelengkap.', '20000.00', 'images/products/1764341684.jpg', NULL, 1, '2025-11-28 07:54:44', '2025-11-28 07:54:44'),
(3, 2, 'Es Teh Manis', 'es-teh-manis', 'Teh segar dengan manis yang pas, disajikan dingin.', '5000.00', 'images/products/1764341731.jpg', NULL, 1, '2025-11-28 07:55:31', '2025-11-28 07:55:31'),
(5, 1, 'Soto Vokasi Juara', 'soto-vokasi-juara', 'Soto Ayam Spesial + Nasi + Es Teh Manis. Lengkap dan hemat!', '22000.00', 'images/products/1764350875.png', NULL, 1, '2025-11-28 10:27:55', '2025-11-28 10:27:55'),
(6, 2, 'Es Dawet', 'es-dawet', 'Perpaduan sempurna antara dawet pandan kenyal, santan segar, dan saus gula aren legit.', '10000.00', 'images/products/1764351419.png', NULL, 1, '2025-11-28 10:36:59', '2025-11-28 10:36:59'),
(7, 2, 'Air Es', 'air-es', 'Dingin, simpel, dan menyegarkan untuk melegakan dahaga.', '1000.00', 'images/products/1764431119.jpg', NULL, 1, '2025-11-29 08:45:19', '2025-11-29 08:45:19'),
(8, 2, 'Es Jeruk', 'es-jeruk', 'Dibuat dari perasan buah jeruk pilihan tanpa tambahan pemanis buatan.', '5000.00', 'images/products/1764431223.jpg', NULL, 1, '2025-11-29 08:45:47', '2025-11-29 08:47:03'),
(9, 1, 'Soto Ayam Biasa', 'soto-ayam-biasa', 'Soto ayam dengan kuah bening kaya rempah, suwiran ayam, soun, tauge, dan telur rebus.', '12000.00', 'images/products/1764431201.jpg', NULL, 1, '2025-11-29 08:46:41', '2025-11-29 08:46:41'),
(10, 2, 'Susu Gembira', 'susu-gembira', 'mantul enak pooll', '8000.00', 'images/products/1764602631.jpg', NULL, 1, '2025-11-29 08:48:40', '2025-12-01 08:23:51');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ll2L5LP0j9rlIZPPB4xc8KhOEMdwN96Bv3pJ1Cxu', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNmMwT1RhSDZEVW55VVNINHpaVkJIZjJrRXRYanhwRzNJYk1wOXhmUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1765570668),
('rxQHmpAcDYyd0TZH8KGBUj9e4LGTlARHJ4tkiVGB', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQmU4TWNTSEpCSXE3bUdTU1JUeEJ4aEVIZ2ZzeTdSYXNUM1JPNmdTWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjtzOjU6InJvdXRlIjtzOjEyOiJwcm9maWxlLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1765632214);

-- --------------------------------------------------------

--
-- Table structure for table `testimonis`
--

CREATE TABLE `testimonis` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonis`
--

INSERT INTO `testimonis` (`id`, `name`, `email`, `message`, `rating`, `image`, `is_approved`, `created_at`, `updated_at`) VALUES
(2, 'M. Dzaki Dwi Putra', 'Dzaki@gmail.com', '\"Pelayanannya ramah dan cepat. Saya coba paket lengkap dan porsinya sangat mengenyangkan.”', 5, 'images/testimonials/1764343934.png', 1, '2025-11-28 08:32:14', '2025-11-28 08:32:23'),
(3, 'M. Habib Masyhur', 'habib@gmail.com', '\"Sotonya benar-benar otentik! Kuahnya kaya rasa dan dagingnya empuk. Tempatnya juga bersih dan nyaman\"', 5, 'images/testimonials/1764344021.png', 1, '2025-11-28 08:33:41', '2025-11-28 08:35:02'),
(4, 'Mahiendra Fikri', 'Mahen@gmail.com', '\"Tempat yang pas untuk makan siang bersama teman-teman kantor. Suasananya adem.”', 5, 'images/testimonials/1764344094.png', 1, '2025-11-28 08:34:54', '2025-11-28 08:35:04'),
(5, 'M. Dzaki Dwi Putra', 'DzakiPutra@gmail.com', 'murah dapat banyak , enak sekali', 4, 'images/testimonials/1764379934.png', 1, '2025-11-28 18:32:14', '2025-11-28 18:34:07'),
(7, 'Muhammad Habib Masyhur', 'masyhur@gmail.com', 'saya sering kesini,enak sekali sotonya apalagi tempatnya dipinggir pohon pohon terasa sejuk', 5, 'images/testimonials/1764380031.jpg', 1, '2025-11-28 18:33:51', '2025-11-28 18:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `address`, `avatar`) VALUES
(2, 'Muhammad Habib Masyhur', 'masyhurrr@gmail.com', NULL, '$2y$12$qSjz7n3hXiYx65ViRDClsOrpxgspAnM44F9U.pChQaQlzbSsIOFii', NULL, '2025-12-02 03:50:13', '2025-12-02 06:06:49', '087785711752', 'malang', 'avatars/n0Tw7jPxJ295k4LI42rhIhmToVmmBoNY2cHlTXzT.jpg'),
(3, 'Muhammad Habib Masyhur', 'muhammadhabibmasyhur14@gmail.com', NULL, '$2y$12$yxux9.dK9mDdFdKEOOGMIOfglY8fHhCHcQR9taJOwRn8E3nQRuVrK', NULL, '2025-12-02 05:51:16', '2025-12-05 09:58:42', NULL, NULL, 'avatars/u9p38pEK9QB7xfZIxXwkciXWyPSyREOR0A8ocloj.jpg');

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_order_number_index` (`order_number`),
  ADD KEY `orders_payment_status_index` (`payment_status`);

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
-- Indexes for table `payment_histories`
--
ALTER TABLE `payment_histories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_histories_transaction_id_unique` (`transaction_id`),
  ADD KEY `payment_histories_order_id_foreign` (`order_id`),
  ADD KEY `payment_histories_transaction_id_index` (`transaction_id`),
  ADD KEY `payment_histories_status_index` (`status`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `testimonis`
--
ALTER TABLE `testimonis`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `payment_histories`
--
ALTER TABLE `payment_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `testimonis`
--
ALTER TABLE `testimonis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_histories`
--
ALTER TABLE `payment_histories`
  ADD CONSTRAINT `payment_histories_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
