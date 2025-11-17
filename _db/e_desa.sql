-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Okt 2023 pada 09.58
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

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
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_pelayanan_id` bigint(20) UNSIGNED NOT NULL,
  `no_antrian` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `antrian`
--

INSERT INTO `antrian` (`id`, `user_id`, `jenis_pelayanan_id`, `no_antrian`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, '2023-10-22 08:04:02', '2023-10-22 08:04:02'),
(2, 3, 1, 2, '2023-10-22 08:05:23', '2023-10-22 08:05:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_pelayanan`
--

CREATE TABLE `jenis_pelayanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pelayanan` varchar(255) NOT NULL,
  `tipe_layanan` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_pelayanan`
--

INSERT INTO `jenis_pelayanan` (`id`, `nama_pelayanan`, `tipe_layanan`, `created_at`, `updated_at`) VALUES
(1, 'Pembuatan KTP', 1, NULL, NULL),
(2, 'Pembuatan Kartu Keluarga', 1, NULL, NULL),
(3, 'Surat Keterangan', 2, NULL, NULL),
(4, 'Surat Keterangan Belum Menikah, Duda/Janda', 2, NULL, NULL),
(5, 'Surat Keterangan Usaha', 2, NULL, NULL),
(6, 'Lain - Lain', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
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
(16, '2023_06_12_160848_delete_unsed_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
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

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `user_id`, `status_notifikasi`, `judul_notifikasi`, `isi_notifikasi`, `link_notifikasi`, `tipe_notifikasi`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 'Antrian berhasil dibuat', 'Antrian anda berhasil dibuat, silahkan menunggu panggilan selanjutnya', '1', 1, '2023-10-22 08:04:02', '2023-10-22 08:08:27'),
(2, 3, 2, 'Pengajuan berhasil dibuat', 'Pengajuan anda berhasil dibuat, silahkan menunggu proses selanjutnya', '1', 2, '2023-10-22 08:05:07', '2023-10-22 08:08:27'),
(3, 3, 2, 'Antrian berhasil dibuat', 'Antrian anda berhasil dibuat, silahkan menunggu panggilan selanjutnya', '2', 1, '2023-10-22 08:05:23', '2023-10-22 08:09:17'),
(4, 3, 2, 'Pengaduan berhasil dibuat', 'Pengaduan anda berhasil dibuat, silahkan menunggu proses selanjutnya', '1', 3, '2023-10-22 08:05:41', '2023-10-22 08:08:27'),
(5, 3, 2, 'Status pengajuan Verifikasi Berhasil', 'Status pengajuan Verifikasi Berhasil, silahkan cek detail pengajuan anda', '1', 2, '2023-10-22 08:07:27', '2023-10-22 08:08:27'),
(6, 3, 2, 'Status pengajuan Verifikasi Berhasil', 'Status pengajuan Verifikasi Berhasil, silahkan cek detail pengajuan anda', '1', 2, '2023-10-22 08:07:52', '2023-10-22 08:08:27'),
(7, 3, 2, 'Status pengajuan Selesai', 'Status pengajuan Selesai, silahkan cek detail pengajuan anda', '1', 2, '2023-10-22 08:08:18', '2023-10-22 08:08:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `isi_pengaduan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_pengantar`
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

--
-- Dumping data untuk tabel `surat_pengantar`
--

INSERT INTO `surat_pengantar` (`id`, `user_id`, `jenis_pelayanan_id`, `jenis_berkas`, `file_berkas`, `orginal_name_berkas`, `status_pengajuan`, `created_at`, `updated_at`) VALUES
(1, 3, 3, '2', 'pengajuan/TpwCzgMN6pOoOLMFDu5IH1e3J5WpGfQ58ppqLdpT.jpg', 'contoh.jpg', 4, '2023-10-22 08:05:07', '2023-10-22 08:08:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('1','2') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nik`, `name`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `email`, `phone_number`, `password`, `user_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1111111111111111', 'Admin', '2000-01-01', 'L', 'Jl. Admin', 'admin@mail.com', '081234567890', '$2y$10$Gd3wpqU484QPBRqQPrkdR.Y5IOMlNq1hqk1n2/CrlP0ApRL57ic7e', '1', '2023-10-22 07:54:46', '2023-10-22 07:54:46', NULL),
(2, '0987654321123456', 'Warga 1', '2000-01-01', 'L', 'Jl. Warga 1', 'warga1@mail.com', '081234567891', '$2y$10$AzoNDSJ2VKupjg7c.YENtexF6gDm6d05qm5BCYEDbhociKZwS7pge', '2', '2023-10-22 07:54:46', '2023-10-22 07:54:46', NULL),
(3, '2327272663563501', 'LUTFI IRAWAN', '1988-10-22', 'L', 'JL. RAYA NO 1 KALITIMBANG CIEBEBR CILEGON BANTEN', 'lutfi@gmail.com', '087777777555', '$2y$10$vFaKKNeDpfp66JSInw4cQe3.1OfzSI7xRoR0WYMWEdPOmbu86qo.a', '2', '2023-10-22 08:02:59', '2023-10-22 08:02:59', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `antrian_user_id_foreign` (`user_id`),
  ADD KEY `antrian_jenis_pelayanan_id_foreign` (`jenis_pelayanan_id`);

--
-- Indeks untuk tabel `jenis_pelayanan`
--
ALTER TABLE `jenis_pelayanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifikasi_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_pengantar`
--
ALTER TABLE `surat_pengantar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_pengantar_user_id_foreign` (`user_id`),
  ADD KEY `surat_pengantar_jenis_pelayanan_id_foreign` (`jenis_pelayanan_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nik_unique` (`nik`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jenis_pelayanan`
--
ALTER TABLE `jenis_pelayanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `surat_pengantar`
--
ALTER TABLE `surat_pengantar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `antrian_jenis_pelayanan_id_foreign` FOREIGN KEY (`jenis_pelayanan_id`) REFERENCES `jenis_pelayanan` (`id`),
  ADD CONSTRAINT `antrian_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `surat_pengantar`
--
ALTER TABLE `surat_pengantar`
  ADD CONSTRAINT `surat_pengantar_jenis_pelayanan_id_foreign` FOREIGN KEY (`jenis_pelayanan_id`) REFERENCES `jenis_pelayanan` (`id`),
  ADD CONSTRAINT `surat_pengantar_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
