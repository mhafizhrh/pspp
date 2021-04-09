-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Apr 2021 pada 14.05
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pspp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '10 DKV 3', '2021-03-13 09:56:43', '2021-03-13 09:56:43', NULL),
(2, '11 RPL 3', '2021-03-13 09:56:43', '2021-03-13 09:56:43', NULL),
(3, '12 ANM 3', '2021-03-13 09:56:43', '2021-03-13 09:56:43', NULL),
(4, '10 RPL 2', '2021-03-22 22:50:58', '2021-03-22 22:50:58', '2021-03-28 07:22:57'),
(5, '10 RPL 3', '2021-03-22 22:51:13', '2021-03-22 22:51:13', NULL),
(6, '10 RPL 1', '2021-03-22 22:52:06', '2021-03-22 22:52:06', NULL),
(7, '11 RPL 1', '2021-03-22 22:52:14', '2021-03-22 22:52:14', NULL),
(8, '11 RPL 2', '2021-03-22 22:52:22', '2021-03-22 22:52:22', NULL),
(9, '12 RPL 3', '2021-03-22 22:52:27', '2021-03-22 22:52:27', NULL),
(10, '12 RPL 1', '2021-03-22 22:52:36', '2021-03-22 22:52:36', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2021_03_12_152518_create_siswa_table', 2),
(8, '2021_03_13_092224_create_kelas_table', 3),
(9, '2021_03_13_094513_add_deleted_at_to_users_table', 3),
(10, '2021_03_13_094740_add_deleted_at_to_siswa_table', 4),
(11, '2021_03_13_094813_add_deleted_at_to_kelas_table', 4),
(12, '2021_03_13_103004_create_spp_table', 5),
(13, '2021_03_14_031028_create_pengaturan_spp_table', 6),
(15, '2021_03_14_032456_create_tahun_pelajaran_table', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan_spp`
--

CREATE TABLE `pengaturan_spp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun_pelajaran` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nis` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_siswa` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kelas` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_user`, `nis`, `nama_siswa`, `alamat`, `no_telp`, `id_kelas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, '181912070094', 'Luhur Daradjat', 'Rancaekek RT07/01', NULL, '2', '2021-03-24 14:06:59', '2021-03-24 14:06:59', NULL),
(4, '181912070095', 'Aminudin', 'Rancaekek', NULL, '3', '2021-03-16 14:11:55', '2021-03-16 14:11:55', NULL),
(3, '181912070096', 'Rahman Hakim', 'Kp. Margamulya RT 04/01', '082133779498', '1', '2021-03-13 09:57:43', '2021-03-13 09:57:52', NULL),
(5, '181912070097', 'Rendi', '-', NULL, '8', '2021-03-14 11:58:16', '2021-03-14 11:58:16', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `spp`
--

CREATE TABLE `spp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_petugas` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bulan` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_pelajaran` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `spp`
--

INSERT INTO `spp` (`id`, `id_petugas`, `nis`, `bulan`, `tahun_pelajaran`, `nominal`, `created_at`, `updated_at`, `deleted_at`) VALUES
(163, '1', '181912070096', '1', '1999/2000', 400000, '2021-04-04 04:17:19', '2021-04-04 04:17:19', NULL),
(164, '1', '181912070095', '1', '1999/2000', 418000, '2021-04-04 04:30:30', '2021-04-04 04:30:30', NULL),
(165, '1', '181912070094', '1', '1999/2000', 418000, '2021-04-06 04:31:37', '2021-04-04 04:31:37', NULL),
(166, '1', '181912070096', '2', '1999/2000', 418000, '2021-04-05 04:37:15', '2021-04-04 04:37:15', NULL),
(167, '1', '181912070095', '3', '1999/2000', 418000, '2021-04-04 04:39:13', '2021-04-04 04:39:13', NULL),
(168, '1', '181912070095', '2', '1999/2000', 418000, '2021-04-03 04:39:19', '2021-04-04 04:39:19', NULL),
(169, '1', '181912070096', '1', '2018/2019', 418000, '2021-04-02 04:52:36', '2021-04-04 04:52:36', NULL),
(170, '1', '181912070096', '4', '2018/2019', 418000, '2021-04-04 14:08:20', '2021-04-04 14:08:20', NULL),
(171, '1', '181912070096', '3', '1999/2000', 418000, '2021-04-04 17:04:07', '2021-04-04 17:04:07', NULL),
(172, '1', '181912070096', '4', '1999/2000', 418000, '2021-04-04 17:04:13', '2021-04-04 17:04:13', NULL),
(173, '1', '181912070095', '4', '1999/2000', 418000, '2021-04-04 17:04:26', '2021-04-04 17:04:26', NULL),
(174, '1', '181912070096', '5', '1999/2000', 418000, '2021-04-04 17:10:12', '2021-04-04 17:10:12', NULL),
(175, '1', '181912070096', '2', '2018/2019', 418000, '2021-04-04 17:12:14', '2021-04-04 17:12:14', NULL),
(176, '1', '181912070096', '3', '2018/2019', 418000, '2021-04-04 17:12:24', '2021-04-04 17:12:24', NULL),
(177, '1', '181912070096', '6', '1999/2000', 418000, '2021-04-04 17:15:32', '2021-04-04 17:15:32', NULL),
(178, '1', '181912070095', '5', '1999/2000', 418000, '2021-04-04 17:18:43', '2021-04-04 17:18:43', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_pelajaran`
--

CREATE TABLE `tahun_pelajaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun_pelajaran` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tahun_pelajaran`
--

INSERT INTO `tahun_pelajaran` (`id`, `tahun_pelajaran`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2020/2021', '2021-03-14 03:27:51', '2021-03-14 03:27:51', NULL),
(2, '2019/2020', '2021-03-14 03:28:13', '2021-03-14 03:28:13', NULL),
(6, '2018/2019', '2021-03-14 04:25:28', '2021-03-14 04:25:28', NULL),
(7, '1999/2000', '2021-03-14 11:49:36', '2021-03-14 11:49:36', NULL),
(8, '2021/2022', '2021-03-15 15:37:32', '2021-03-15 15:37:32', NULL),
(9, '2022/2023', '2021-04-05 01:48:01', '2021-04-05 01:48:01', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','petugas','siswa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@pspp.com', 'admin', '$2y$10$cziK9.UGK1fILrLpEPpgMOdpxIQw.4qsCLDn6Fpf4NmUw4DFUBqfS', 'admin', '2021-03-05 13:31:55', '2021-03-05 13:31:55', NULL),
(2, 'Petugas', 'petugas@pspp.com', 'petugas', '$2y$10$6rUuosJYLLEF2zOHturQM.AROr6u495wvJ0uJoGK2WTaY7s6cpMbe', 'petugas', '2021-03-05 13:31:55', '2021-03-05 13:31:55', NULL),
(3, 'Rahman Hakim', 'siswa@pspp.com', 'rahman', '$2y$10$GyOCZcqsVK85.7xFYcmKXeNUJO6Qj8qk3aoPJiup2vXx.54Zw8EgS', 'siswa', '2021-03-05 13:31:55', '2021-03-05 13:31:55', NULL),
(4, 'Aminudin', 'aminudin@pspp.com', 'aminudin', '$2y$10$6rUuosJYLLEF2zOHturQM.AROr6u495wvJ0uJoGK2WTaY7s6cpMbe', 'siswa', '2021-03-05 13:31:55', '2021-03-05 13:31:55', NULL),
(5, 'Petugas 2', 'petugas2@pspp.com', 'petugas2', '$2y$10$ATNW8w.najPRgtEmMBv2cOOpiuqOAqhqkLY5z6WuBw1Mn2lfU4SXi', 'petugas', '2021-03-24 00:22:51', '2021-03-24 00:22:51', NULL),
(6, 'Petugas 3', 'petugas3@pspp.com', 'petugas3', '$2y$10$wZjM1eD/Lc0cQDHI5we.l.nEDN8xAQ8FnPzb/laU3I62VoaLX8Hba', 'petugas', '2021-03-24 00:23:40', '2021-03-24 00:23:40', NULL),
(7, '123', '123123', '123123', '$2y$10$v2ladGpWuHWp10iJTYVoXu3kGh4D7kPAW38jk8fptM08ryfTVJ.SG', 'petugas', '2021-03-24 00:33:16', '2021-03-24 00:33:16', '2021-03-23 17:36:23'),
(13, 'Luhur Daradjat', '181912070094@pspp.com', '181912070094', '$2y$10$ftwpAaqg64umI/Vf7DeKuedmAQ1FPN0/0mUcK20cxhso1WSrisQPi', 'siswa', '2021-03-24 14:06:59', '2021-03-24 14:06:59', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pengaturan_spp`
--
ALTER TABLE `pengaturan_spp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD UNIQUE KEY `siswa_nisn_unique` (`nis`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tahun_pelajaran`
--
ALTER TABLE `tahun_pelajaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tahun_pelajaran_tahun_pelajaran_unique` (`tahun_pelajaran`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pengaturan_spp`
--
ALTER TABLE `pengaturan_spp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `spp`
--
ALTER TABLE `spp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT untuk tabel `tahun_pelajaran`
--
ALTER TABLE `tahun_pelajaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
