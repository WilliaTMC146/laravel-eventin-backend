-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 02, 2022 at 06:45 AM
-- Server version: 5.7.33
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_group`
--

CREATE TABLE `access_group` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` text,
  `access_detail` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_group`
--

INSERT INTO `access_group` (`id`, `nama`, `keterangan`, `access_detail`, `created_at`, `created_id`, `updated_at`, `updated_id`) VALUES
(1, 'super', '', NULL, '2022-06-23 11:04:47', 1, '2022-06-23 11:56:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `access_group_detail`
--

CREATE TABLE `access_group_detail` (
  `id_access_group` int(11) NOT NULL,
  `id_access_master` int(11) NOT NULL,
  `priority` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_group_detail`
--

INSERT INTO `access_group_detail` (`id_access_group`, `id_access_master`, `priority`) VALUES
(1, 1, NULL),
(1, 2, NULL),
(1, 3, NULL),
(1, 4, NULL),
(1, 5, NULL),
(1, 6, NULL),
(1, 7, NULL),
(1, 8, NULL),
(1, 9, NULL),
(1, 10, NULL),
(1, 11, NULL),
(1, 12, NULL),
(1, 13, NULL),
(1, 14, NULL),
(1, 15, NULL),
(1, 16, NULL),
(1, 17, NULL),
(1, 18, NULL),
(1, 19, NULL),
(1, 20, NULL),
(1, 21, NULL),
(1, 22, NULL),
(1, 23, NULL),
(1, 24, NULL),
(1, 25, NULL),
(1, 26, NULL),
(1, 27, NULL),
(1, 28, NULL),
(1, 29, NULL),
(1, 30, NULL),
(1, 31, NULL),
(1, 32, NULL),
(1, 33, NULL),
(1, 34, NULL),
(1, 35, NULL),
(1, 36, NULL),
(1, 37, NULL),
(1, 38, NULL),
(1, 39, NULL),
(1, 40, NULL),
(1, 41, NULL),
(1, 42, NULL),
(1, 43, NULL),
(1, 44, NULL),
(1, 45, NULL),
(1, 46, NULL),
(1, 47, NULL),
(1, 48, NULL),
(1, 49, NULL),
(1, 50, NULL),
(1, 51, NULL),
(1, 52, NULL),
(1, 53, NULL),
(1, 54, NULL),
(1, 55, NULL),
(1, 56, NULL),
(1, 57, NULL),
(1, 58, NULL),
(1, 59, NULL),
(1, 60, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `access_master`
--

CREATE TABLE `access_master` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `access_master`
--

INSERT INTO `access_master` (`id`, `nama`, `keterangan`, `created_at`, `created_id`, `updated_at`, `updated_id`) VALUES
(1, 'access_group_manage', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(2, 'access_group_create', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(3, 'access_group_read', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(4, 'access_group_update', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(5, 'access_group_delete', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(6, 'access_master_manage', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(7, 'access_master_create', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(8, 'access_master_read', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(9, 'access_master_update', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(10, 'access_master_delete', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(11, 'event_manage', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(12, 'event_create', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(13, 'event_read', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(14, 'event_update', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(15, 'event_delete', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(16, 'member_manage', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(17, 'member_create', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(18, 'member_read', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(19, 'member_update', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(20, 'member_delete', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(21, 'm_category_manage', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(22, 'm_category_create', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(23, 'm_category_read', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(24, 'm_category_update', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(25, 'm_category_delete', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(26, 'm_promo_manage', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(27, 'm_promo_create', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(28, 'm_promo_read', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(29, 'm_promo_update', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(30, 'm_promo_delete', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(31, 'm_role_permission_manage', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(32, 'm_role_permission_create', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(33, 'm_role_permission_read', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(34, 'm_role_permission_update', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(35, 'm_role_permission_delete', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(36, 'm_tags_manage', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(37, 'm_tags_create', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(38, 'm_tags_read', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(39, 'm_tags_update', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(40, 'm_tags_delete', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(41, 'm_type_manage', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(42, 'm_type_create', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(43, 'm_type_read', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(44, 'm_type_update', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(45, 'm_type_delete', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(46, 'order_ticket_manage', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(47, 'order_ticket_create', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(48, 'order_ticket_read', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(49, 'order_ticket_update', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(50, 'order_ticket_delete', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(51, 'organizer_manage', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(52, 'organizer_create', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(53, 'organizer_read', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(54, 'organizer_update', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(55, 'organizer_delete', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(56, 'users_manage', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(57, 'users_create', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(58, 'users_read', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(59, 'users_update', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1),
(60, 'users_delete', NULL, '2022-08-02 13:39:36', 1, '2022-08-02 13:39:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `harga` int(11) NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL,
  `id_organizer` int(11) NOT NULL,
  `id_m_category` int(11) NOT NULL,
  `id_m_type` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_adds_on`
--

CREATE TABLE `event_adds_on` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `total_qty` int(11) DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `min_beli` int(11) NOT NULL,
  `max_beli` int(11) NOT NULL,
  `tanggal_awal` int(11) NOT NULL,
  `tanggal_akhir` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_variant` int(11) NOT NULL DEFAULT '0',
  `variant_parent_id` int(11) DEFAULT NULL,
  `id_event` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_tags`
--

CREATE TABLE `event_tags` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_m_tags` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_ticket`
--

CREATE TABLE `event_ticket` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `qty` int(11) NOT NULL,
  `harga` double NOT NULL,
  `tanggal_awal` datetime NOT NULL,
  `tanggal_akhir` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_interest`
--

CREATE TABLE `member_interest` (
  `id` int(11) NOT NULL,
  `id_m_member` int(11) NOT NULL,
  `id_m_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_like`
--

CREATE TABLE `member_like` (
  `id` int(11) NOT NULL,
  `id_m_member` int(11) NOT NULL,
  `id_event` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_category`
--

CREATE TABLE `m_category` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_promo`
--

CREATE TABLE `m_promo` (
  `id` int(11) NOT NULL,
  `nama` int(255) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `discount` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tanggal_awal` datetime NOT NULL,
  `tanggal_akhir` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_role_permission`
--

CREATE TABLE `m_role_permission` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_tags`
--

CREATE TABLE `m_tags` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_type`
--

CREATE TABLE `m_type` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_ticket`
--

CREATE TABLE `order_ticket` (
  `id` int(11) NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_m_member` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `harga` double NOT NULL,
  `id_m_promo` int(11) DEFAULT NULL,
  `disc` int(11) DEFAULT NULL,
  `total_harga` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `redeem_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_ticket_detail`
--

CREATE TABLE `order_ticket_detail` (
  `id` int(11) NOT NULL,
  `id_order_ticket` int(11) NOT NULL,
  `id_event_adds_on` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizer`
--

CREATE TABLE `organizer` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `katerangan` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizer_bank_account`
--

CREATE TABLE `organizer_bank_account` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_postal_code` int(11) NOT NULL,
  `account_region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizer_followers`
--

CREATE TABLE `organizer_followers` (
  `id` int(11) NOT NULL,
  `id_organizer` int(11) NOT NULL,
  `id_m_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizer_member`
--

CREATE TABLE `organizer_member` (
  `id` int(11) NOT NULL,
  `id_organizer` int(11) NOT NULL,
  `id_m_member` int(11) NOT NULL,
  `id_organizer_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizer_role`
--

CREATE TABLE `organizer_role` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizer_role_permission`
--

CREATE TABLE `organizer_role_permission` (
  `id` int(11) NOT NULL,
  `id_organizer_role` int(11) NOT NULL,
  `id_m_role_permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_access_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `id_access_group`) VALUES
(1, 'toro', 'toro@mail.com', '$2y$10$bADbRS70xYSWFUM8eF.LCu1s3rY/HDNYybH3siwPdH7/LEzHj0HIG', '2022-08-02 09:51:55', '2022-08-02 09:51:55', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_group`
--
ALTER TABLE `access_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `access_master`
--
ALTER TABLE `access_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_adds_on`
--
ALTER TABLE `event_adds_on`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_tags`
--
ALTER TABLE `event_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_ticket`
--
ALTER TABLE `event_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_interest`
--
ALTER TABLE `member_interest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_like`
--
ALTER TABLE `member_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_category`
--
ALTER TABLE `m_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_promo`
--
ALTER TABLE `m_promo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_role_permission`
--
ALTER TABLE `m_role_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_tags`
--
ALTER TABLE `m_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_type`
--
ALTER TABLE `m_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_ticket`
--
ALTER TABLE `order_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_ticket_detail`
--
ALTER TABLE `order_ticket_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizer`
--
ALTER TABLE `organizer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizer_bank_account`
--
ALTER TABLE `organizer_bank_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizer_followers`
--
ALTER TABLE `organizer_followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizer_member`
--
ALTER TABLE `organizer_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizer_role`
--
ALTER TABLE `organizer_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizer_role_permission`
--
ALTER TABLE `organizer_role_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_group`
--
ALTER TABLE `access_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `access_master`
--
ALTER TABLE `access_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_adds_on`
--
ALTER TABLE `event_adds_on`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_tags`
--
ALTER TABLE `event_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_ticket`
--
ALTER TABLE `event_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_interest`
--
ALTER TABLE `member_interest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_like`
--
ALTER TABLE `member_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_category`
--
ALTER TABLE `m_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_promo`
--
ALTER TABLE `m_promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_role_permission`
--
ALTER TABLE `m_role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_tags`
--
ALTER TABLE `m_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_type`
--
ALTER TABLE `m_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_ticket`
--
ALTER TABLE `order_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_ticket_detail`
--
ALTER TABLE `order_ticket_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizer`
--
ALTER TABLE `organizer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizer_bank_account`
--
ALTER TABLE `organizer_bank_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizer_followers`
--
ALTER TABLE `organizer_followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizer_member`
--
ALTER TABLE `organizer_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizer_role`
--
ALTER TABLE `organizer_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizer_role_permission`
--
ALTER TABLE `organizer_role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
