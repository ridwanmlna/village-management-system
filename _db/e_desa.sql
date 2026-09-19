-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2026 at 08:04 AM
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
-- Database: `e_desa`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_pelayanan_id` bigint(20) UNSIGNED NOT NULL,
  `no_antrian` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nomor_surat` int(11) DEFAULT NULL,
  `tahun_surat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pelayanan`
--

CREATE TABLE `jenis_pelayanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pelayanan` varchar(255) NOT NULL,
  `tipe_layanan` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_pelayanan`
--

INSERT INTO `jenis_pelayanan` (`id`, `nama_pelayanan`, `tipe_layanan`, `created_at`, `updated_at`) VALUES
(1, 'Surat Keterangan Domisili', 2, NULL, NULL),
(2, 'Surat Pengantar SKCK', 2, NULL, NULL),
(3, 'Surat Keterangan Tidak Mampu (SKTM) Sekolah', 2, NULL, NULL),
(4, 'Surat Keterangan Tidak Mampu (SKTM) Umum', 2, NULL, NULL),
(5, 'Surat Keterangan Usaha', 2, NULL, NULL),
(7, 'Surat Keterangan Belum Menikah', 2, NULL, NULL),
(8, 'Surat Keterangan Kelahiran', 2, NULL, NULL),
(9, 'Surat Keterangan Kematian', 2, NULL, NULL),
(10, 'Lain-lain', NULL, NULL, NULL);

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
(5, '2023_06_06_053850_change_field_to_users_table', 1),
(6, '2023_06_09_014611_create_jenis_pelayanan_table', 1),
(7, '2023_06_09_014715_create_antrian_table', 1),
(8, '2023_06_09_015148_create_surat_pengantar_table', 1),
(9, '2023_06_09_112118_create_notifikasi_table', 1),
(10, '2023_06_09_112247_create_pengaduan_table', 1),
(11, '2023_06_09_113327_add_no_antrian_to_antrian_table', 1),
(12, '2023_06_12_144134_add_tipe_pelayanan_to_jenis_pelayanan_table', 1),
(13, '2023_06_12_144255_add_jenis_pelayanan_seeder', 1),
(14, '2023_06_12_145210_add_deleted_at_to_users', 1),
(15, '2023_06_12_145334_add_users_seeder', 1),
(16, '2023_06_12_160848_delete_unsed_table', 1),
(17, '2025_11_24_230822_add_fields_to_warga_desa_table', 2),
(18, '2025_11_24_231939_add_agama_pekerjaan_to_users_table', 3),
(19, '2025_11_24_232359_remove_email_phone_from_users_table', 4),
(20, '2025_11_25_192230_add_nomor_surat_to_antrian_table', 5),
(21, '2025_11_25_205303_add_tahun_surat_to_antrian_table', 6),
(22, '2025_12_01_182959_add_status_perkawinan_warga_negara_to_users_table', 7),
(23, '2025_12_01_212819_create_surat_table', 8),
(24, '2025_12_02_131939_add_nomor_surat_angka_to_surat_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status_notifikasi` int(11) NOT NULL DEFAULT 1,
  `judul_notifikasi` varchar(255) NOT NULL,
  `isi_notifikasi` text NOT NULL,
  `link_notifikasi` varchar(255) DEFAULT NULL,
  `tipe_notifikasi` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `isi_pengaduan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `prefix_surat` varchar(255) NOT NULL,
  `nomor_surat_angka` int(11) DEFAULT NULL,
  `nomor_surat` varchar(255) DEFAULT NULL,
  `cetak_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_pengantar`
--

CREATE TABLE `surat_pengantar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_pelayanan_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_berkas` varchar(255) NOT NULL,
  `file_berkas` varchar(255) NOT NULL,
  `orginal_name_berkas` varchar(255) NOT NULL,
  `status_pengajuan` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tempat_tanggal_lahir` varchar(255) DEFAULT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `status_perkawinan` varchar(255) DEFAULT NULL,
  `warga_negara` varchar(255) DEFAULT NULL,
  `alamat` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('1','2') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nik`, `name`, `tempat_tanggal_lahir`, `agama`, `pekerjaan`, `tanggal_lahir`, `jenis_kelamin`, `status_perkawinan`, `warga_negara`, `alamat`, `password`, `user_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1111111111111111', 'Admin Desa', NULL, NULL, NULL, '2000-01-01', 'L', NULL, NULL, 'Jl. Admin', '$2y$10$Gd3wpqU484QPBRqQPrkdR.Y5IOMlNq1hqk1n2/CrlP0ApRL57ic7e', '1', '2023-10-22 07:54:46', '2023-10-22 07:54:46', NULL),
(237, '2222222222222222', 'Saya', 'Tasik 24 Mei 2004', 'Islam', 'Mahasiswa', '2004-05-24', 'L', 'Belum Kawin', 'Indonesia', 'Tasik', '$2y$10$OiEJzPbO7Yms9mfQyE3N6uq5sDxG15xzP9J.1dVTboUBIFwsnKaLa', '2', '2025-12-03 21:44:47', '2025-12-04 09:09:11', '2025-12-04 09:09:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `antrian_user_id_foreign` (`user_id`),
  ADD KEY `antrian_jenis_pelayanan_id_foreign` (`jenis_pelayanan_id`);

--
-- Indexes for table `jenis_pelayanan`
--
ALTER TABLE `jenis_pelayanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifikasi_user_id_foreign` (`user_id`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_pengantar`
--
ALTER TABLE `surat_pengantar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_pengantar_user_id_foreign` (`user_id`),
  ADD KEY `surat_pengantar_jenis_pelayanan_id_foreign` (`jenis_pelayanan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nik_unique` (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jenis_pelayanan`
--
ALTER TABLE `jenis_pelayanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `surat_pengantar`
--
ALTER TABLE `surat_pengantar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5953;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `antrian_jenis_pelayanan_id_foreign` FOREIGN KEY (`jenis_pelayanan_id`) REFERENCES `jenis_pelayanan` (`id`),
  ADD CONSTRAINT `antrian_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `surat_pengantar`
--
ALTER TABLE `surat_pengantar`
  ADD CONSTRAINT `surat_pengantar_jenis_pelayanan_id_foreign` FOREIGN KEY (`jenis_pelayanan_id`) REFERENCES `jenis_pelayanan` (`id`),
  ADD CONSTRAINT `surat_pengantar_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
