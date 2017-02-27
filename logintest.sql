-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27 Feb 2017 pada 10.32
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logintest`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `images`
--

CREATE TABLE `images` (
  `images` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `tabelUses` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `images`
--

INSERT INTO `images` (`images`, `id`, `waktu`, `name`, `tabelUses`) VALUES
(1, 0, '2017-02-27 00:00:00', '23809.jpg', ''),
(2, 0, '2017-02-27 00:00:00', '94761.jpg', ''),
(3, 1, '2017-02-27 00:00:00', '20882.jpg', 'Users'),
(4, 2, '2017-02-27 00:00:00', '66560.jpg', 'Users'),
(5, 3, '2017-02-27 00:00:00', '61238.jpg', 'Users'),
(6, 4, '2017-02-27 00:00:00', '33360.jpg', 'Users');

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
(1, '2017_02_18_034214_create-social-logins', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_admin_rtrwnet`
--

CREATE TABLE `ms_admin_rtrwnet` (
  `kdUser` int(11) NOT NULL,
  `kdRtRwNet` int(11) DEFAULT NULL,
  `owner` tinyint(1) DEFAULT NULL,
  `profile` tinyint(1) DEFAULT NULL,
  `komplain` tinyint(1) DEFAULT NULL,
  `transaksi` tinyint(1) DEFAULT NULL,
  `jadwal` tinyint(1) DEFAULT NULL,
  `proyek` tinyint(1) DEFAULT NULL,
  `billing` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_admin_rtrwnet`
--

INSERT INTO `ms_admin_rtrwnet` (`kdUser`, `kdRtRwNet`, `owner`, `profile`, `komplain`, `transaksi`, `jadwal`, `proyek`, `billing`) VALUES
(24, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_barang_default`
--

CREATE TABLE `ms_barang_default` (
  `kdBarangDefault` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `spec` text,
  `harga` double DEFAULT NULL,
  `merk` varchar(200) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `hided` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_barang_default`
--

INSERT INTO `ms_barang_default` (`kdBarangDefault`, `nama`, `spec`, `harga`, `merk`, `foto`, `deleted`, `hided`) VALUES
(1, 'ini dia', '23q324', 1000000, 'merk xxx', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_jasa_default`
--

CREATE TABLE `ms_jasa_default` (
  `kdJasaDefault` int(11) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `hided` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_jasa_default`
--

INSERT INTO `ms_jasa_default` (`kdJasaDefault`, `nama`, `harga`, `deleted`, `hided`) VALUES
(1, 'test 233', 1000000, 0, 0),
(2, 'pasang antena', 1000000, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_kategori`
--

CREATE TABLE `ms_kategori` (
  `kdKategori` int(11) NOT NULL,
  `nama` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_kategori`
--

INSERT INTO `ms_kategori` (`kdKategori`, `nama`) VALUES
(1, 'modem'),
(2, 'routers'),
(3, 'antena'),
(4, 'baju'),
(6, 'tas'),
(7, 'baju'),
(8, 'kain'),
(9, 'Akses Point'),
(10, 'ada'),
(11, 'sudah'),
(12, 'mesin'),
(13, 'makek'),
(14, 'KACA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_kategori_barang`
--

CREATE TABLE `ms_kategori_barang` (
  `kdKategori` int(11) NOT NULL,
  `kdBarangDefault` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_kategori_barang`
--

INSERT INTO `ms_kategori_barang` (`kdKategori`, `kdBarangDefault`) VALUES
(12, 3),
(13, 2),
(14, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_merk`
--

CREATE TABLE `ms_merk` (
  `kdMerk` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_merk`
--

INSERT INTO `ms_merk` (`kdMerk`, `nama`) VALUES
(1, 'Merek 1'),
(2, 'Merek 2'),
(3, 'Merek 3'),
(4, 'merk xxx');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_paket_default`
--

CREATE TABLE `ms_paket_default` (
  `kdPaketDefault` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `hided` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_paket_default`
--

INSERT INTO `ms_paket_default` (`kdPaketDefault`, `nama`, `harga`, `deleted`, `hided`) VALUES
(1, 'paket mumer', 20000, 0, 0),
(2, 'paket mumer 2', 20000, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_pelanggan`
--

CREATE TABLE `ms_pelanggan` (
  `kdPelanggan` int(11) NOT NULL,
  `kdRtRwNet` int(11) DEFAULT NULL,
  `namaPanggilan` varchar(50) DEFAULT NULL,
  `namaLengkap` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `lokasiMap` text,
  `lat` text,
  `long` text,
  `noTelp` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `suspended` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_pelanggan`
--

INSERT INTO `ms_pelanggan` (`kdPelanggan`, `kdRtRwNet`, `namaPanggilan`, `namaLengkap`, `foto`, `alamat`, `lokasiMap`, `lat`, `long`, `noTelp`, `email`, `deleted`, `suspended`) VALUES
(1, 1, 'widi', 'widiana putra', '20882.jpg', 'jjl', NULL, '-8.405399947818868', '115.18814652380365', '061', 'widi2@gmail.com', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_rtrwnet`
--

CREATE TABLE `ms_rtrwnet` (
  `kdRtRwNet` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `noTelp` varchar(200) DEFAULT NULL,
  `fanpage` varchar(200) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `suspended` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_rtrwnet`
--

INSERT INTO `ms_rtrwnet` (`kdRtRwNet`, `nama`, `alamat`, `noTelp`, `fanpage`, `website`, `email`, `logo`, `deleted`, `suspended`) VALUES
(1, 'wwww', NULL, NULL, NULL, NULL, NULL, '23809.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('widi319@gmail.com', '$2y$10$m54FPIhrArN3FiIi4BZ74umQ4F4DEgEIWUucswXBPwtapYQ9ckBmq', '2017-02-19 18:41:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rtrwnet_log`
--

CREATE TABLE `rtrwnet_log` (
  `kdLog` int(11) NOT NULL,
  `kdUser` int(11) DEFAULT NULL,
  `kdRtRwNet` int(11) DEFAULT NULL,
  `log` varchar(200) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sa_log`
--

CREATE TABLE `sa_log` (
  `kdLog` int(11) NOT NULL,
  `kdSA` int(11) DEFAULT NULL,
  `waktu` varchar(200) DEFAULT NULL,
  `log` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `social_logins`
--

CREATE TABLE `social_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `provider` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noTelp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `suspended` int(11) DEFAULT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `foto`, `noTelp`, `deleted`, `suspended`, `role`) VALUES
(1, 'widiana putra', 'widi319@gmail.com', '$2y$10$djZoCIa2ey.EIkFZuX6tze0gGhUEE720vfInwnplq0i87qR58WuOK', 'yuOG8YplSppQLelookiWJL4dcDInH4wnfHSNjCbEySJg2wfqCL2ZBJi7R7Dd', '2017-02-16 18:24:10', '2017-02-16 18:24:10', '84887.jpg', NULL, 0, 0, 1),
(24, 'widiana baru', 'widiana_putra@yahoo.com', '$2y$10$CQTaIjYOr0R7tdWUgBvGL.B0hspaLxgRKgZ2zrYDgAzl5CyRtlcRm', NULL, '2017-02-26 20:03:54', '2017-02-26 20:03:54', NULL, NULL, 0, 0, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`images`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_admin_rtrwnet`
--
ALTER TABLE `ms_admin_rtrwnet`
  ADD PRIMARY KEY (`kdUser`);

--
-- Indexes for table `ms_barang_default`
--
ALTER TABLE `ms_barang_default`
  ADD PRIMARY KEY (`kdBarangDefault`);

--
-- Indexes for table `ms_kategori`
--
ALTER TABLE `ms_kategori`
  ADD PRIMARY KEY (`kdKategori`);

--
-- Indexes for table `ms_kategori_barang`
--
ALTER TABLE `ms_kategori_barang`
  ADD PRIMARY KEY (`kdKategori`,`kdBarangDefault`);

--
-- Indexes for table `ms_merk`
--
ALTER TABLE `ms_merk`
  ADD PRIMARY KEY (`kdMerk`);

--
-- Indexes for table `ms_paket_default`
--
ALTER TABLE `ms_paket_default`
  ADD PRIMARY KEY (`kdPaketDefault`);

--
-- Indexes for table `ms_pelanggan`
--
ALTER TABLE `ms_pelanggan`
  ADD PRIMARY KEY (`kdPelanggan`);

--
-- Indexes for table `ms_rtrwnet`
--
ALTER TABLE `ms_rtrwnet`
  ADD PRIMARY KEY (`kdRtRwNet`);

--
-- Indexes for table `rtrwnet_log`
--
ALTER TABLE `rtrwnet_log`
  ADD PRIMARY KEY (`kdLog`);

--
-- Indexes for table `sa_log`
--
ALTER TABLE `sa_log`
  ADD PRIMARY KEY (`kdLog`);

--
-- Indexes for table `social_logins`
--
ALTER TABLE `social_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_logins_user_id_index` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `social_logins`
--
ALTER TABLE `social_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `social_logins`
--
ALTER TABLE `social_logins`
  ADD CONSTRAINT `social_logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
