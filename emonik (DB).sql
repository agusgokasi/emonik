-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 08, 2021 at 05:18 AM
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
(1, 'Fakultas MIPA', 1, 1, NULL, '2021-02-08 04:15:08', '2021-02-08 04:15:08');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatans`
--

CREATE TABLE `kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maksimaldana` bigint(20) NOT NULL,
  `status` smallint(6) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Admin', 1, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, NULL, '2021-02-08 04:15:07', '2021-02-08 04:15:07'),
(2, 'PPK', 1, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, NULL, '2021-02-08 04:15:07', '2021-02-08 04:15:07'),
(3, 'Wakil Dekan 2', 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 1, NULL, '2021-02-08 04:15:07', '2021-02-08 04:15:07'),
(4, 'BPP', 1, 1, 1, 0, 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, NULL, '2021-02-08 04:15:07', '2021-02-08 04:15:07'),
(5, 'Kasubag', 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 1, 1, NULL, '2021-02-08 04:15:07', '2021-02-08 04:15:07'),
(6, 'Pemohon', 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, NULL, '2021-02-08 04:15:07', '2021-02-08 04:15:07');

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
(1, 'Ilmu Komputer', 1, 1, 1, NULL, '2021-02-08 04:15:08', '2021-02-08 04:15:08');

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
(1, 'Kaprodi Ilmu Komputer', 1, 1, 1, 1, NULL, '2021-02-08 04:15:08', '2021-02-08 04:15:08');

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
(1, 'Admin', 'admin@mail.com', NULL, NULL, '$2y$10$8wVHmv5zhFFVbhTR7xhGS.gdfRnTyNYfmqiYg5xOM1klzUl34PgdO', NULL, NULL, 1, 1, NULL, 1, NULL, '2021-02-08 04:15:08', '2021-02-08 04:15:08');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permohonans`
--
ALTER TABLE `permohonans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prodis`
--
ALTER TABLE `prodis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rincians`
--
ALTER TABLE `rincians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
