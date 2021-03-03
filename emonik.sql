-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 24, 2021 at 04:04 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emonik`
--

-- --------------------------------------------------------

--
-- Table structure for table `fakultases`
--

CREATE TABLE `fakultases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fakultases`
--

INSERT INTO `fakultases` (`id`, `nama`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Fakultas MIPA', 1, 1, NULL, '2021-02-20 15:43:55', '2021-02-20 15:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatans`
--

CREATE TABLE `kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` smallint(6) NOT NULL,
  `maksimaldana` bigint(20) NOT NULL,
  `status` smallint(6) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatans`
--

INSERT INTO `kegiatans` (`id`, `unit_id`, `nama`, `bulan`, `tahun`, `maksimaldana`, `status`, `keterangan`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Stadium Generale', 'Januari', 2021, 10000000, 1, 'Sudah Dibuat', 1, NULL, '2021-02-20 15:43:57', '2021-02-20 15:53:57'),
(2, 1, 'Tes Seminar', 'Maret', 2021, 12000000, 1, 'Sudah Dibuat', 1, NULL, '2021-02-20 15:43:57', '2021-02-21 01:29:46'),
(3, 1, 'Lainnya', 'April', 2021, 15000000, 1, 'Permohonan Belum Dibuat', 1, NULL, '2021-02-20 15:43:57', '2021-02-21 08:18:41'),
(4, 1, 'Tes Lainnya', 'Mei', 2021, 8000000, 1, 'Permohonan Belum Dibuat', 1, NULL, '2021-02-20 15:43:57', '2021-02-20 15:43:57'),
(5, 2, 'Stadium Generale', 'Januari', 2021, 10000000, 1, 'Permohonan Belum Dibuat', 1, NULL, '2021-02-20 15:43:57', '2021-02-20 15:43:57'),
(6, 2, 'Tes Seminar', 'Maret', 2021, 12000000, 1, 'Permohonan Belum Dibuat', 1, NULL, '2021-02-20 15:43:57', '2021-02-20 15:43:57'),
(7, 2, 'Lainnya', 'April', 2021, 18000000, 1, 'Permohonan Belum Dibuat', 1, NULL, '2021-02-20 15:43:57', '2021-02-20 15:43:57'),
(8, 2, 'Tes Lainnya', 'Mei', 2021, 8000000, 1, 'Permohonan Belum Dibuat', 1, NULL, '2021-02-20 15:43:57', '2021-02-20 15:43:57'),
(9, 3, 'Stadium Generale', 'Januari', 2021, 10000000, 1, 'Permohonan Belum Dibuat', 1, NULL, '2021-02-20 15:43:57', '2021-02-20 15:43:57'),
(10, 3, 'Tes Seminar', 'Maret', 2021, 12000000, 1, 'Permohonan Belum Dibuat', 1, NULL, '2021-02-20 15:43:58', '2021-02-20 15:43:58'),
(11, 3, 'Lainnya', 'April', 2021, 15000000, 1, 'Permohonan Belum Dibuat', 1, NULL, '2021-02-20 15:43:58', '2021-02-20 15:43:58'),
(12, 3, 'Tes Lainnya', 'Mei', 2021, 8000000, 1, 'Permohonan Belum Dibuat', 1, NULL, '2021-02-20 15:43:58', '2021-02-20 15:43:58'),
(18, 1, 'Workshop Kurikulum', 'November', 2020, 10000000, 1, 'Sudah Dibuat', 7, 3, '2021-02-21 08:16:55', '2021-02-21 23:08:42');

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
(1, '2014_09_28_102357_create_fakultases_table', 1),
(2, '2014_09_28_122406_create_prodis_table', 1),
(3, '2014_09_28_145914_create_units_table', 1),
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2019_09_28_143336_create_permissions_table', 1),
(7, '2019_09_28_150135_create_kategoris_table', 1),
(8, '2019_09_28_150202_create_kegiatans_table', 1),
(9, '2019_09_28_150232_create_permohonans_table', 1),
(10, '2019_09_28_150239_create_rincians_table', 1),
(11, '2020_05_22_091442_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('03688bdc-b73d-4540-9561-a866741009ee', 'App\\Notifications\\SubmitSPJ', 'App\\User', 6, '{\"submited_by\":7,\"message\":\"1 SPJ baru disubmit\"}', '2021-02-21 03:22:51', '2021-02-21 03:21:50', '2021-02-21 03:22:51'),
('0d256de4-77a5-4ee3-bff1-bbb7285ac331', 'App\\Notifications\\SubmitProker', 'App\\User', 3, '{\"submited_by\":7,\"message\":\"1 proker baru disubmit\"}', '2021-02-20 15:51:36', '2021-02-20 15:51:17', '2021-02-20 15:51:36'),
('1013a9a9-e865-41a9-8883-9add93c06de3', 'App\\Notifications\\Dt1SPJ', 'App\\User', 7, '{\"rejected_by\":6,\"message\":\"SPJ anda ditolak\"}', '2021-02-21 03:18:24', '2021-02-21 03:18:04', '2021-02-21 03:18:24'),
('1022d405-b705-4400-b5bb-809c543850e7', 'App\\Notifications\\Dis2Permohonan', 'App\\User', 6, '{\"submited_by\":3,\"message\":\"1 permohonan baru diteruskan dari PPK\"}', '2021-02-21 01:55:15', '2021-02-21 01:54:37', '2021-02-21 01:55:15'),
('1bf6ffde-e507-4549-836a-3c5c3686aa5a', 'App\\Notifications\\SubmitSPJ', 'App\\User', 6, '{\"submited_by\":7,\"message\":\"1 SPJ baru disubmit\"}', '2021-02-21 03:19:40', '2021-02-21 03:19:13', '2021-02-21 03:19:40'),
('1d862fd7-6a84-4e0a-b189-a5d17e8cdd88', 'App\\Notifications\\Dis2Permohonan', 'App\\User', 6, '{\"submited_by\":3,\"message\":\"1 permohonan baru diteruskan dari PPK\"}', '2021-02-21 01:55:15', '2021-02-21 01:54:45', '2021-02-21 01:55:15'),
('22b9abc1-f4bf-45d8-9419-69e194fa27f4', 'App\\Notifications\\SubmitSPJ', 'App\\User', 6, '{\"submited_by\":7,\"message\":\"1 SPJ baru disubmit\"}', '2021-02-21 03:19:40', '2021-02-21 03:19:21', '2021-02-21 03:19:40'),
('2787880e-941d-4ecd-b9b1-5d4401ea9f45', 'App\\Notifications\\TerimaProker', 'App\\User', 7, '{\"submited_by\":3,\"message\":\"Pengajuan Proker Anda diterima!\"}', '2021-02-20 15:52:16', '2021-02-20 15:51:40', '2021-02-20 15:52:16'),
('2e01f06d-5578-4bb8-a7b7-fa4252bb25fe', 'App\\Notifications\\Dt2Permohonan', 'App\\User', 7, '{\"rejected_by\":3,\"message\":\"Permohonan anda ditolak\"}', '2021-02-21 01:53:12', '2021-02-21 01:52:19', '2021-02-21 01:53:12'),
('2eae475e-f304-4a88-8610-b1fbce6e71e1', 'App\\Notifications\\SubmitPermohonan', 'App\\User', 4, '{\"submited_by\":7,\"message\":\"1 permohonan baru disubmit\"}', '2021-02-21 01:37:00', '2021-02-21 01:36:17', '2021-02-21 01:37:00'),
('2efd832e-761a-4c08-9031-da60b5116127', 'App\\Notifications\\Dis1SPJ', 'App\\User', 5, '{\"submited_by\":6,\"message\":\"1 SPJ baru diteruskan dari Kasubag\"}', '2021-02-21 03:23:55', '2021-02-21 03:23:22', '2021-02-21 03:23:55'),
('307388a6-6c0e-47c3-8e24-b7f71e5a7dbd', 'App\\Notifications\\Dis4Permohonan', 'App\\User', 7, '{\"submited_by\":5,\"message\":\"Permohonan selesai, segera buat spj paling lambat 1 minggu\"}', '2021-02-21 02:41:54', '2021-02-21 02:41:28', '2021-02-21 02:41:54'),
('30f48585-6e08-4957-98e1-34802449e898', 'App\\Notifications\\Dis3Permohonan', 'App\\User', 5, '{\"submited_by\":6,\"message\":\"1 permohonan baru diteruskan dari BPP\"}', '2021-02-21 01:59:58', '2021-02-21 01:59:26', '2021-02-21 01:59:58'),
('318d67b5-56ce-444e-b2d1-6027ec6d7a35', 'App\\Notifications\\Dis3Permohonan', 'App\\User', 5, '{\"submited_by\":6,\"message\":\"1 permohonan baru diteruskan dari BPP\"}', '2021-02-21 01:59:58', '2021-02-21 01:58:26', '2021-02-21 01:59:58'),
('3536ab06-570e-4d1a-b1a3-366744dd648f', 'App\\Notifications\\SubmitSPJ', 'App\\User', 6, '{\"submited_by\":7,\"message\":\"1 SPJ baru disubmit\"}', '2021-02-21 03:10:16', '2021-02-21 03:09:39', '2021-02-21 03:10:16'),
('35392d7a-e8e6-4971-b769-258ad04ee866', 'App\\Notifications\\Dp3Permohonan', 'App\\User', 7, '{\"submited_by\":6,\"message\":\"Permohonan sudah disetujui Kasubag, silahkan ambil dana di BPP\"}', '2021-02-21 01:59:01', '2021-02-21 01:58:30', '2021-02-21 01:59:01'),
('3540ce79-1af1-4412-8940-bd67b5efda37', 'App\\Notifications\\Dt2SPJ', 'App\\User', 7, '{\"rejected_by\":5,\"message\":\"SPJ anda ditolak\"}', '2021-02-21 03:21:42', '2021-02-21 03:21:18', '2021-02-21 03:21:42'),
('3aebf692-f371-4de3-a99d-94a9beb163c2', 'App\\Notifications\\TerimaProker', 'App\\User', 7, '{\"submited_by\":3,\"message\":\"Pengajuan Proker Anda diterima!\"}', '2021-02-20 15:50:42', '2021-02-20 15:48:44', '2021-02-20 15:50:42'),
('3c0b5286-faf2-4c22-a393-b1cc17d0cd22', 'App\\Notifications\\Dis1SPJ', 'App\\User', 5, '{\"submited_by\":6,\"message\":\"1 SPJ baru diteruskan dari Kasubag\"}', '2021-02-21 03:20:20', '2021-02-21 03:20:01', '2021-02-21 03:20:20'),
('48e9db1d-7444-4491-be23-7910af87a307', 'App\\Notifications\\Dis2SPJ', 'App\\User', 7, '{\"submited_by\":5,\"message\":\"SPJ selesai\"}', '2021-02-21 03:24:42', '2021-02-21 03:24:23', '2021-02-21 03:24:42'),
('54f80e79-2c7d-4fca-95d4-82251c445874', 'App\\Notifications\\Dis4Permohonan', 'App\\User', 7, '{\"submited_by\":5,\"message\":\"Permohonan selesai, segera buat spj paling lambat 1 minggu\"}', '2021-02-21 02:41:53', '2021-02-21 02:41:36', '2021-02-21 02:41:53'),
('581e0a46-c320-4066-b36e-a947c4de1a04', 'App\\Notifications\\Dp3Permohonan', 'App\\User', 7, '{\"submited_by\":5,\"message\":\"Permohonan sudah disetujui Kasubag, silahkan ambil dana di BPP\"}', '2021-02-21 02:41:55', '2021-02-21 02:41:15', '2021-02-21 02:41:55'),
('5ecc2dc8-2128-49fa-afb1-e14ffda6300e', 'App\\Notifications\\SubmitProker', 'App\\User', 3, '{\"submited_by\":7,\"message\":\"1 proker baru disubmit\"}', '2021-02-20 15:51:36', '2021-02-20 15:51:07', '2021-02-20 15:51:36'),
('677c391f-4b01-4e30-bad9-56bad5445f8b', 'App\\Notifications\\SubmitProker', 'App\\User', 3, '{\"submited_by\":7,\"message\":\"1 proker baru disubmit\"}', '2021-02-20 15:48:40', '2021-02-20 15:47:37', '2021-02-20 15:48:40'),
('6aa26ad3-f484-45eb-9c4f-8ade706665fc', 'App\\Notifications\\Dis1Permohonan', 'App\\User', 3, '{\"submited_by\":7,\"message\":\"1 permohonan baru diteruskan dari WD2\"}', '2021-02-21 01:54:15', '2021-02-21 01:53:48', '2021-02-21 01:54:15'),
('6d525045-81eb-470a-83da-9e2b19e37793', 'App\\Notifications\\Dp3Permohonan', 'App\\User', 7, '{\"submited_by\":6,\"message\":\"Permohonan sudah disetujui Kasubag, silahkan ambil dana di BPP\"}', '2021-02-21 01:59:01', '2021-02-21 01:58:19', '2021-02-21 01:59:01'),
('717518a3-769c-40a0-bdb8-9ca54027fece', 'App\\Notifications\\Dp3Permohonan', 'App\\User', 7, '{\"submited_by\":5,\"message\":\"Permohonan sudah disetujui Kasubag, silahkan ambil dana di BPP\"}', '2021-02-21 02:30:51', '2021-02-21 02:29:14', '2021-02-21 02:30:51'),
('737a485e-b6df-4dd7-b559-67bbf20f12c1', 'App\\Notifications\\Dis1Permohonan', 'App\\User', 3, '{\"submited_by\":4,\"message\":\"1 permohonan baru diteruskan dari WD2\"}', '2021-02-21 01:37:41', '2021-02-21 01:37:13', '2021-02-21 01:37:41'),
('87957cd8-5470-48b0-bf7e-ba4a5f37a841', 'App\\Notifications\\Dis2Permohonan', 'App\\User', 6, '{\"submited_by\":7,\"message\":\"1 permohonan baru diteruskan dari PPK\"}', '2021-02-21 01:58:07', '2021-02-21 01:57:50', '2021-02-21 01:58:07'),
('91b72778-bb90-4645-a87c-1511ff7cc279', 'App\\Notifications\\Dis3Permohonan', 'App\\User', 5, '{\"submited_by\":6,\"message\":\"1 permohonan baru diteruskan dari BPP\"}', '2021-02-21 01:59:58', '2021-02-21 01:58:14', '2021-02-21 01:59:58'),
('9240ae04-220d-42a8-ac80-5647ab437e0b', 'App\\Notifications\\TerimaProker', 'App\\User', 7, '{\"submited_by\":3,\"message\":\"Pengajuan Proker Anda diterima!\"}', '2021-02-21 23:05:48', '2021-02-21 23:05:27', '2021-02-21 23:05:48'),
('9938a998-f46e-4365-b92c-fde5908203ce', 'App\\Notifications\\Dt2Permohonan', 'App\\User', 7, '{\"rejected_by\":3,\"message\":\"Permohonan anda ditolak\"}', '2021-02-21 01:53:12', '2021-02-21 01:52:50', '2021-02-21 01:53:12'),
('9a2eb544-c0ba-4c29-94ab-65c4ddaabba7', 'App\\Notifications\\SubmitProker', 'App\\User', 3, '{\"submited_by\":7,\"message\":\"1 proker baru disubmit\"}', '2021-02-20 15:48:40', '2021-02-20 15:48:10', '2021-02-20 15:48:40'),
('a1456e81-c0fa-459c-bac1-276be11ce306', 'App\\Notifications\\Dis1SPJ', 'App\\User', 5, '{\"submited_by\":6,\"message\":\"1 SPJ baru diteruskan dari Kasubag\"}', '2021-02-21 03:23:55', '2021-02-21 03:23:31', '2021-02-21 03:23:55'),
('a14e6bd9-be49-45b2-a4d7-8556cc8db2a7', 'App\\Notifications\\Dp3Permohonan', 'App\\User', 7, '{\"submited_by\":6,\"message\":\"Permohonan sudah disetujui Kasubag, silahkan ambil dana di BPP\"}', '2021-02-21 02:30:51', '2021-02-21 01:59:31', '2021-02-21 02:30:51'),
('b447411b-45d1-49a8-80d1-a8899a678916', 'App\\Notifications\\Dt3Permohonan', 'App\\User', 7, '{\"rejected_by\":6,\"message\":\"Permohonan anda ditolak\"}', '2021-02-21 01:56:11', '2021-02-21 01:55:54', '2021-02-21 01:56:11'),
('ba4ef69d-91a9-444d-b4b8-7e0b391140ae', 'App\\Notifications\\TolakProker', 'App\\User', 7, '{\"rejected_by\":3,\"message\":\"Pengajuan Proker anda ditolak\"}', '2021-02-20 15:50:49', '2021-02-20 15:49:02', '2021-02-20 15:50:49'),
('bfc24777-8efc-4bdb-98dc-614e37436b56', 'App\\Notifications\\Dt3Permohonan', 'App\\User', 7, '{\"rejected_by\":6,\"message\":\"Permohonan anda ditolak\"}', '2021-02-21 01:57:21', '2021-02-21 01:56:45', '2021-02-21 01:57:21'),
('c2a867f0-0332-4567-87ab-eccacfcb0666', 'App\\Notifications\\SubmitProker', 'App\\User', 3, '{\"submited_by\":7,\"message\":\"1 proker baru disubmit\"}', '2021-02-21 23:05:18', '2021-02-21 23:04:15', '2021-02-21 23:05:18'),
('c72cb52f-40f9-49b1-b13a-6a1893164ca7', 'App\\Notifications\\Dis1SPJ', 'App\\User', 5, '{\"submited_by\":6,\"message\":\"1 SPJ baru diteruskan dari Kasubag\"}', '2021-02-21 03:20:20', '2021-02-21 03:19:53', '2021-02-21 03:20:20'),
('cade4a8c-7224-4595-99da-884ecefcab16', 'App\\Notifications\\Dis1Permohonan', 'App\\User', 3, '{\"submited_by\":4,\"message\":\"1 permohonan baru diteruskan dari WD2\"}', '2021-02-21 01:37:41', '2021-02-21 01:37:23', '2021-02-21 01:37:41'),
('d8c96f63-60ae-4918-9039-c11c04ac05bb', 'App\\Notifications\\Dt1SPJ', 'App\\User', 7, '{\"rejected_by\":6,\"message\":\"SPJ anda ditolak\"}', '2021-02-21 03:18:24', '2021-02-21 03:17:48', '2021-02-21 03:18:24'),
('d971ebcd-cb69-4be9-aac9-e1c1437ab2a9', 'App\\Notifications\\Dis2Permohonan', 'App\\User', 6, '{\"submited_by\":7,\"message\":\"1 permohonan baru diteruskan dari PPK\"}', '2021-02-21 01:58:07', '2021-02-21 01:57:41', '2021-02-21 01:58:07'),
('dd3bc63b-8368-4dfd-ac44-3dba760eb9cd', 'App\\Notifications\\TolakProker', 'App\\User', 7, '{\"rejected_by\":3,\"message\":\"Pengajuan Proker anda ditolak\"}', '2021-02-20 15:52:21', '2021-02-20 15:51:54', '2021-02-20 15:52:21'),
('e9a60846-6f19-45cd-829c-61a5f83b7ff7', 'App\\Notifications\\SubmitSPJ', 'App\\User', 6, '{\"submited_by\":7,\"message\":\"1 SPJ baru disubmit\"}', '2021-02-21 03:22:50', '2021-02-21 03:22:24', '2021-02-21 03:22:50'),
('eca0f8e4-75b9-4cb5-8b53-12a43cf4fcab', 'App\\Notifications\\Dis2SPJ', 'App\\User', 7, '{\"submited_by\":5,\"message\":\"SPJ selesai\"}', '2021-02-21 03:24:42', '2021-02-21 03:24:08', '2021-02-21 03:24:42'),
('f30130b0-12a2-41be-a324-0ddc5424fc0d', 'App\\Notifications\\Dt2SPJ', 'App\\User', 7, '{\"rejected_by\":5,\"message\":\"SPJ anda ditolak\"}', '2021-02-21 03:21:43', '2021-02-21 03:20:35', '2021-02-21 03:21:43'),
('f945833c-084f-4d28-bbb6-3cc6ee3dd976', 'App\\Notifications\\SubmitPermohonan', 'App\\User', 4, '{\"submited_by\":7,\"message\":\"1 permohonan baru disubmit\"}', '2021-02-21 01:37:00', '2021-02-20 16:09:29', '2021-02-21 01:37:00'),
('fb2428f2-5429-483a-9b77-5c6be956cf9f', 'App\\Notifications\\Dis1Permohonan', 'App\\User', 3, '{\"submited_by\":7,\"message\":\"1 permohonan baru diteruskan dari WD2\"}', '2021-02-21 01:54:15', '2021-02-21 01:53:56', '2021-02-21 01:54:15'),
('ff618531-f3a9-4c3b-8103-b91848668f45', 'App\\Notifications\\SubmitSPJ', 'App\\User', 6, '{\"submited_by\":7,\"message\":\"1 SPJ baru disubmit\"}', '2021-02-21 03:10:16', '2021-02-21 03:09:27', '2021-02-21 03:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('agusgokasir@gmail.com', '$2y$10$tQpk/KYRmzi4iOn09SK55.ogSc5s/Be7P1X8pTZPsfylYDdt5lvZ2', '2021-02-23 01:48:02');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_status` tinyint(4) NOT NULL DEFAULT 0,
  `permission_status` tinyint(4) NOT NULL DEFAULT 0,
  `unit_status` tinyint(4) NOT NULL DEFAULT 0,
  `kegiatan_status` tinyint(4) NOT NULL DEFAULT 0,
  `exception_status` tinyint(4) NOT NULL DEFAULT 0,
  `permohonan_status` tinyint(4) NOT NULL DEFAULT 0,
  `dispo1p_status` tinyint(4) NOT NULL DEFAULT 0,
  `dispo2p_status` tinyint(4) NOT NULL DEFAULT 0,
  `dispo3p_status` tinyint(4) NOT NULL DEFAULT 0,
  `dispo4p_status` tinyint(4) NOT NULL DEFAULT 0,
  `dispo1s_status` tinyint(4) NOT NULL DEFAULT 0,
  `dispo2s_status` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `nama`, `view_status`, `permission_status`, `unit_status`, `kegiatan_status`, `exception_status`, `permohonan_status`, `dispo1p_status`, `dispo2p_status`, `dispo3p_status`, `dispo4p_status`, `dispo1s_status`, `dispo2s_status`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Webmaster', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, '2021-02-20 15:43:55', '2021-02-20 15:43:55'),
(2, 'Admin', 1, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, NULL, '2021-02-20 15:43:55', '2021-02-20 15:43:55'),
(3, 'PPK', 1, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, NULL, '2021-02-20 15:43:55', '2021-02-20 15:43:55'),
(4, 'Wakil Dekan 2', 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 1, NULL, '2021-02-20 15:43:55', '2021-02-20 15:43:55'),
(5, 'BPP', 1, 1, 1, 0, 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, NULL, '2021-02-20 15:43:55', '2021-02-20 15:43:55'),
(6, 'Kasubag', 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 1, 1, NULL, '2021-02-20 15:43:55', '2021-02-20 15:43:55'),
(7, 'Pemohon', 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, NULL, '2021-02-20 15:43:55', '2021-02-20 15:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `permohonans`
--

CREATE TABLE `permohonans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kegiatan_id` bigint(20) DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(270) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemohon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latarbelakang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruanglingkup` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktupencapaian` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `luaran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pembiayaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `filetor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 0,
  `totalbiaya` bigint(20) NOT NULL,
  `biayarincian` bigint(20) NOT NULL DEFAULT 0,
  `danaterpakai` bigint(20) NOT NULL DEFAULT 0,
  `sisarincian` bigint(20) NOT NULL DEFAULT 0,
  `sisadana` bigint(20) NOT NULL DEFAULT 0,
  `totalrincian` smallint(6) NOT NULL DEFAULT 0,
  `totalspj` smallint(6) NOT NULL DEFAULT 0,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revisi2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spj_tolak_kas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spj_tolak_bpp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permohonans`
--

INSERT INTO `permohonans` (`id`, `kegiatan_id`, `nama`, `slug`, `pemohon`, `latarbelakang`, `tujuan`, `ruanglingkup`, `waktupencapaian`, `luaran`, `pembiayaan`, `filetor`, `status`, `totalbiaya`, `biayarincian`, `danaterpakai`, `sisarincian`, `sisadana`, `totalrincian`, `totalspj`, `keterangan`, `revisi`, `revisi2`, `spj_tolak_kas`, `spj_tolak_bpp`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'tes', 'tes', 'Ir. Fariani Hermin,M.T.', 'tes', 'tes', 'tes', 'tes', 'tes', 'tes', '16138365329tes.pdf', 10, 10000000, 10000000, 9500000, 500000, 500000, 5, 5, 'SPJ Selesai', 'tes.pdf', '16138726058tes.pdf', '16138774848tes.pdf', 'tes.pdf', 7, 7, '2021-02-20 15:53:57', '2021-02-21 03:24:28'),
(2, 2, 'Tes permohonan', 'tes-permohonan', 'Agus Setiawan', 'tes', 'tes', 'tes', 'tes', 'tes', 'tes', 'tes.pdf', 10, 12000000, 12000000, 12000000, 0, 0, 1, 1, 'Spj selesai', '16138723707tes.pdf', 'tes.pdf', 'tes.pdf', '16138776781tes.pdf', 7, 7, '2021-02-21 01:29:46', '2021-02-21 03:24:14'),
(4, 18, 'Workshop Kurikulum', 'workshop-kurikulum', 'Ir. Fariani Hermin,M.T.', '<p>1.&nbsp;Dasar Hukum</p><p>2.&nbsp;Gambaran&nbsp;Umum</p><p>Saat ini mulai diberlakukan kurikulum kampus merdeka-merdeka belajar(KM-MB) sehingga dosen dan koorprodi perlu tahu tentang implementasi nya dalam kurikulum prodi, sehingga diperlukan workshop menyusun kurikulum prodi, dimana bisa memfasilitasi mahasiswa dalam pelaksanaan KM-MB. Sebagai langkah awal diadakan seminar dimana mendatangkan pakar/ahli dalam bidang kurikulum khususnya KM-MB</p>', '<p>Dosen dan Koorprodi dalam mengimplementasikan kurikulum KM-MB</p>', '<p>1.&nbsp;Metode&nbsp;Pelaksanaan&nbsp;: Seminar&nbsp;Dalam Jaringan</p><p>2.&nbsp;Tahapan&nbsp;Pelaksanaan&nbsp;dan&nbsp;Waktu&nbsp;Pelaksanaan</p><p>Persiapan : &nbsp;Pembuatan unsur lengkap workshop yang melibatkan dosen dari prodi. Mengadakan rapat perdana untuk membahas tugas khusus setiap seksi, membuat timeline persiapan, dan mengundang narasumber untuk sesi seminar. Setiap seksi selanjutnya melakukan tugasnya masing-masing, namun diadakan rapat berkala untuk evaluasi persiapan acara.</p><p>Pelaksanaan : &nbsp;Setiap seksi bekerja sesuai tugasnya saat hari-H pelaksanaan.</p>', '<p>Kegiatan tersebut akan dilaksanakan pada tanggal 5&nbsp;November 2020.&nbsp;Laporan kegiatan akan disampaikan paling lambat 2 minggu setelah kegiatan dilaksanakan.</p>', '<table border=\"1\" cellspacing=\"0\"><tbody><tr><td style=\"vertical-align:top\"><p><strong>Pukul (WIB)</strong></p></td><td colspan=\"3\" style=\"vertical-align:top\"><p><strong>Kegiatan</strong></p></td></tr><tr><td style=\"vertical-align:top\"><p>12.30-13.00</p></td><td colspan=\"3\" style=\"vertical-align:top\"><p>Registrasi peserta</p></td></tr><tr><td style=\"vertical-align:top\"><p>13.00-13.15</p></td><td colspan=\"3\" style=\"vertical-align:top\"><p>Sambutan dan Pembukaan</p></td></tr><tr><td style=\"vertical-align:top\"><p>&nbsp;</p></td><td colspan=\"3\" style=\"vertical-align:top\"><p>-&nbsp;Pembacaan Doa</p></td></tr><tr><td style=\"vertical-align:top\"><p>&nbsp;</p></td><td colspan=\"3\" style=\"vertical-align:top\"><p>-&nbsp;Sambutan dari Koorprodi</p></td></tr><tr><td style=\"vertical-align:top\"><p>&nbsp;</p></td><td colspan=\"3\" style=\"vertical-align:top\"><p>-&nbsp;Sambutan dari Dekan</p></td></tr><tr><td style=\"vertical-align:top\"><p>13.15-15.15</p></td><td style=\"vertical-align:top\"><p>Seminar</p></td><td style=\"vertical-align:top\"><p>&nbsp;</p></td><td style=\"vertical-align:top\"><p>&nbsp;</p></td></tr><tr><td style=\"vertical-align:top\"><p>&nbsp;</p></td><td style=\"vertical-align:top\"><p>Moderator</p></td><td style=\"vertical-align:top\"><p>:</p></td><td style=\"vertical-align:top\"><p>Ajeng Euis Permana Sari, S.Kom.</p></td></tr><tr><td style=\"vertical-align:top\"><p>&nbsp;</p></td><td style=\"vertical-align:top\"><p>Narasumber</p></td><td style=\"vertical-align:top\"><p>:</p></td><td style=\"vertical-align:top\"><p>Prof. Dr. Teddy Mantoro, MSc.</p></td></tr><tr><td style=\"vertical-align:top\"><p>15.15-15.30</p></td><td colspan=\"3\" style=\"vertical-align:top\"><p>Penutupan dan &nbsp;Foto bersama</p></td></tr></tbody></table>', '<table border=\"1\" cellspacing=\"0\"><tbody><tr><td style=\"vertical-align:top\"><p>No</p></td><td style=\"vertical-align:top\"><p>Uraian</p></td><td style=\"vertical-align:top\"><p>Rincian</p></td><td style=\"vertical-align:top\"><p>Jumlah</p></td></tr><tr><td style=\"vertical-align:top\"><p>1</p></td><td style=\"vertical-align:top\"><p>Honor Pembicara</p></td><td style=\"vertical-align:top\"><p>1 org x 3 Jam x @ 1.250.000</p></td><td style=\"vertical-align:top\"><p>3.750.000</p></td></tr><tr><td style=\"vertical-align:top\"><p>2</p></td><td style=\"vertical-align:top\"><p>Honor Moderator</p></td><td style=\"vertical-align:top\"><p>1 org x 3 Jam x @ 400.000</p></td><td style=\"vertical-align:top\"><p>1.200.000</p></td></tr><tr><td style=\"vertical-align:top\"><p>3</p></td><td style=\"vertical-align:top\"><p>Kenang-kenangan Narasumber &amp; Moderator</p></td><td style=\"vertical-align:top\"><p>2 org x @350.000</p></td><td style=\"vertical-align:top\"><p>&nbsp;&nbsp;&nbsp;700.000</p></td></tr><tr><td style=\"vertical-align:top\"><p>4</p></td><td style=\"vertical-align:top\"><p>Kenang-kenangan Peserta</p></td><td style=\"vertical-align:top\"><p>25 org x @150.000</p></td><td style=\"vertical-align:top\"><p>3.750.000</p></td></tr><tr><td colspan=\"3\" style=\"vertical-align:top\"><p><strong>TOTAL BIAYA</strong></p></td><td style=\"vertical-align:top\"><p>9.400.000</p></td></tr></tbody></table>', 'TOR Workhop Kurikulum ILKOM 2020 - Kirim.pdf', 10, 10000000, 5000000, 5000000, 0, 5000000, 1, 1, NULL, NULL, NULL, NULL, NULL, 7, 7, '2021-02-21 23:08:42', '2021-02-22 10:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `prodis`
--

CREATE TABLE `prodis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fakultas_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prodis`
--

INSERT INTO `prodis` (`id`, `nama`, `fakultas_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Ilmu Komputer', 1, 1, 1, NULL, '2021-02-20 15:43:55', '2021-02-20 15:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `rincians`
--

CREATE TABLE `rincians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permohonan_id` bigint(20) DEFAULT NULL,
  `namapermohonan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenisbelanja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biayasatuan` bigint(20) NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biayatotal` bigint(20) NOT NULL,
  `volume` int(11) NOT NULL,
  `biayaterpakai` bigint(20) NOT NULL DEFAULT 0,
  `sisabiaya` bigint(20) NOT NULL DEFAULT 0,
  `Keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rincians`
--

INSERT INTO `rincians` (`id`, `permohonan_id`, `namapermohonan`, `jenisbelanja`, `biayasatuan`, `satuan`, `biayatotal`, `volume`, `biayaterpakai`, `sisabiaya`, `Keterangan`, `file`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'tes', 'Pembicara', 1500000, 'Jam / 1 Orang', 4500000, 3, 4000000, 500000, NULL, '16138768694tes.pdf', 1, 7, NULL, '2021-02-20 15:59:11', '2021-02-21 03:07:49'),
(2, 1, 'tes', 'Pembicara', 1000000, 'Jam / 1 Orang', 2000000, 2, 2000000, 0, NULL, 'tes.pdf', 1, 7, NULL, '2021-02-20 15:59:41', '2021-02-21 03:08:24'),
(3, 1, 'tes', 'Konsumsi', 10000, 'Pack', 1000000, 100, 1000000, 0, NULL, '16138767943tes.pdf', 1, 7, NULL, '2021-02-20 16:07:47', '2021-02-21 03:06:34'),
(4, 1, 'tes', 'Konsumsi pembicara', 100000, 'Pack', 500000, 5, 500000, 0, NULL, '16138768045tes.pdf', 1, 7, 7, '2021-02-20 16:08:07', '2021-02-21 03:06:44'),
(5, 1, 'tes', 'Biaya tidak terduga', 2000000, 'Pack', 2000000, 1, 2000000, 0, NULL, '16138768336tes.pdf', 1, 7, NULL, '2021-02-20 16:08:35', '2021-02-21 03:07:13'),
(8, 2, 'tes', 'Pengembangan Website', 12000000, 'Pack', 12000000, 1, 12000000, 0, NULL, '16138769466tes.pdf', 1, 7, 7, '2021-02-21 01:34:11', '2021-02-21 03:09:06'),
(9, 4, 'Workshop Kurikulum', 'tes', 1000000, 'Pack', 5000000, 5, 5000000, 0, NULL, '16139896289tes.pdf', 1, 7, NULL, '2021-02-22 10:01:40', '2021-02-22 10:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fakultas_id` bigint(20) DEFAULT NULL,
  `prodi_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `nama`, `fakultas_id`, `prodi_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Kaprodi Ilmu Komputer', 1, 1, 1, 1, NULL, '2021-02-20 15:43:55', '2021-02-20 15:43:55'),
(2, 'Ormawa Mipa', 1, NULL, 1, 1, NULL, '2021-02-20 15:43:55', '2021-02-20 15:43:55'),
(3, 'Ormawa Ilmu Komputer', 1, 1, 1, 1, NULL, '2021-02-20 15:43:55', '2021-02-20 15:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tor` int(11) DEFAULT NULL,
  `unit_id` bigint(20) DEFAULT NULL,
  `permission_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `phone`, `password`, `tor`, `unit_id`, `permission_id`, `status`, `remember_token`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'sa@mail.com', NULL, NULL, '$2y$10$y68XXNjkRd6AmnnHk3tsdulh7bZGHLJCLda.s.h7EZFI7SvUXZ0wq', NULL, NULL, 1, 1, NULL, 1, NULL, '2021-02-20 15:43:55', '2021-02-20 15:43:55'),
(2, 'Admin', 'admin@mail.com', NULL, NULL, '$2y$10$tlX4iH6CPBvX1kWx1wktdOrdR91ClHa9M6Vz/FDkh8fkCEtN44hWi', NULL, NULL, 2, 1, NULL, 1, NULL, '2021-02-20 15:43:56', '2021-02-20 15:43:56'),
(3, 'PPK', 'agusgokasir2@gmail.com', NULL, NULL, '$2y$10$1Ey5unIa4Ofvsk9MvneryugstDB0ge6Rt37HDfyK0.ZuRPN5WfCCO', NULL, NULL, 3, 1, NULL, 1, 2, '2021-02-20 15:43:56', '2021-02-23 01:47:24'),
(4, 'Wakil Dekan 2', 'agusgokasir1@gmail.com', NULL, NULL, '$2y$10$OLObtJy.di5gUI6osbUIy.m.sRmnG5cHE7DCJ11H46Cws45Y8pf9y', NULL, NULL, 4, 1, NULL, 1, 2, '2021-02-20 15:43:56', '2021-02-23 01:47:00'),
(5, 'BPP', 'agusgokasir4@gmail.com', NULL, NULL, '$2y$10$EWlN9web27xGlGH3lsU6.OjTMGPuM9K6c6RHLx9mu4RBkJohzpkAO', NULL, NULL, 5, 1, NULL, 1, 2, '2021-02-20 15:43:56', '2021-02-23 01:46:42'),
(6, 'Kasubag', 'agusgokasir3@gmail.com', NULL, NULL, '$2y$10$FTCud0vmJLEusmwJgtIKouLUpColtkb7auCWUFzr/nMbscTrPdnya', NULL, NULL, 6, 1, NULL, 1, 2, '2021-02-20 15:43:56', '2021-02-23 01:47:45'),
(7, 'Prodi', 'agusgokasir@gmail.com', NULL, NULL, '$2y$10$Xnj6hjJJlHNliMoZiq6Yc.EP8y0HP7R4bNc0IDozkXRmCJZsZ1N.6', NULL, 1, 7, 1, 'lELtTLfsubNfoR17oKatRz8xzRtSgE2J1JvgmVQWBhSacoHxPvCBbwms9a0d', 1, 2, '2021-02-20 15:43:56', '2021-02-23 01:46:01'),
(8, 'Ormawa', 'ormawa@mail.com', NULL, NULL, '$2y$10$K6B2RjciGPPzrMGYhMu.MepwM1ol/PHt7p1DZFabRmaGCsI/PUpM6', NULL, 2, 7, 1, NULL, 1, NULL, '2021-02-20 15:43:57', '2021-02-20 15:43:57'),
(9, 'Ormawa1', 'ormawa1@mail.com', NULL, NULL, '$2y$10$7fE1LWYCA2rpHyqq1J4vqedc9MAcEh3t.ioW9bjceEIJbVb342a1G', NULL, 3, 7, 1, NULL, 1, NULL, '2021-02-20 15:43:57', '2021-02-20 15:43:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fakultases`
--
ALTER TABLE `fakultases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fakultases_nama_unique` (`nama`);

--
-- Indexes for table `kegiatans`
--
ALTER TABLE `kegiatans`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permohonans`
--
ALTER TABLE `permohonans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permohonans_slug_unique` (`slug`);

--
-- Indexes for table `prodis`
--
ALTER TABLE `prodis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prodis_nama_unique` (`nama`);

--
-- Indexes for table `rincians`
--
ALTER TABLE `rincians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `units_nama_unique` (`nama`);

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
-- AUTO_INCREMENT for table `fakultases`
--
ALTER TABLE `fakultases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kegiatans`
--
ALTER TABLE `kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permohonans`
--
ALTER TABLE `permohonans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prodis`
--
ALTER TABLE `prodis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rincians`
--
ALTER TABLE `rincians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
