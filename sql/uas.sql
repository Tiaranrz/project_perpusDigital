-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jun 2025 pada 11.27
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `penulis` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `sisa` int(11) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `books`
--

INSERT INTO `books` (`id`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `isbn`, `id_kategori`, `jumlah`, `sisa`, `cover`, `created_at`, `updated_at`) VALUES
(7, 'Laut Bercerita', 'Leila S. Chidori', 'Kompas Gramedia', '2021', '123456', 5, 20, 16, '1750319797_2a5c0327151cc71d4b5c.jpeg', '2025-06-19 07:56:37', '2025-06-19 09:06:30'),
(9, 'Dilan 1999', 'Pidi Baiq', 'Kompas Gramedia', '2019', '989876', 5, 5, 4, '1750322471_25acf96f09191d7aabdb.jpeg', '2025-06-19 08:41:11', '2025-06-19 09:09:52'),
(10, 'Anatomic Habits', 'James Clear', 'Kompas Gramedia', '2020', '232345', 7, 10, 10, '1750322604_98f923177a66c12c1fa8.jpeg', '2025-06-19 08:43:24', '2025-06-19 09:07:43'),
(11, 'Ilmu Pengetahuan Alam', 'Yudhi Tira', 'Kompas Gramedia', '2020', '567800', 1, 20, 20, '1750322758_fe7b7a8f9c814b8fdf90.jpeg', '2025-06-19 08:45:58', '2025-06-19 08:45:58'),
(12, 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Gramedia', '1990', 'a1234d5', 6, 12, 12, '1750323943_a7d700f2ac97451ea499.jpeg', '2025-06-19 09:05:43', '2025-06-19 09:05:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `nama`, `deskripsi`) VALUES
(1, 'pendidikan', 'kurikulum 2025'),
(4, 'Buku Pelajaran', 'Buku pelajaran untuk SD'),
(5, 'Novel', 'Buku fiksi'),
(6, 'Sejarah', 'Sejarah diseluruh dunia'),
(7, 'Self Improvment', 'Untuk memotivasi diri\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_book` int(11) DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `petugas_id` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `loans`
--

INSERT INTO `loans` (`id`, `id_user`, `id_book`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `petugas_id`, `updated_at`) VALUES
(5, 23, 7, '2025-06-19', '2025-06-21', 'returned', NULL, '2025-06-19 15:53:07'),
(6, 21, 9, '2025-06-19', '2025-06-22', 'returned', NULL, '2025-06-19 16:23:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `aktivitas` text DEFAULT NULL,
  `waktu` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `returns`
--

CREATE TABLE `returns` (
  `id` int(11) NOT NULL,
  `id_loan` int(11) DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `denda` decimal(10,2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `returns`
--

INSERT INTO `returns` (`id`, `id_loan`, `tanggal_kembali`, `denda`, `keterangan`) VALUES
(1, 5, '2025-06-19', 0.00, ''),
(2, 6, '2025-06-19', 0.00, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `role` enum('admin','petugas','siswa') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `profile_image`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin123', NULL, 'admin', '2025-04-25 01:30:34', '2025-06-12 10:24:45'),
(3, 'petugas', '$2y$10$LvEqlcBKjxs1q090rb8N6.rA5XLzCayQgjcfAAsY6xAj/GgBghZvy', NULL, 'petugas', '2025-04-25 01:59:18', '2025-04-25 01:59:18'),
(4, 'titan', '$2y$10$1g.C/vFKjQzVFhUBCTpmLuA866cS8yTiMWoMEPYWYwvYfNsgt6RY2', NULL, 'admin', '2025-05-04 22:45:49', '2025-05-04 22:45:49'),
(6, 'nandya', '$2y$10$i3uC93f0T7mGkFGCmqYFmehi1na5HKoRhYkwKu3b8e8fEkNHrGtsa', NULL, 'admin', '2025-06-12 00:52:09', '2025-06-12 00:52:09'),
(10, 'peri', '$2y$10$TXURP2gOssYz8ltl8geW4exgpkaRZS6gV.p/Fuyrs7GLFr0CVgtnK', '1750006659_2aefb60d2f35bcce257e.png', 'admin', '2025-06-12 09:48:04', '2025-06-16 03:35:59'),
(13, 'Kevin', '$2y$10$zHnr7k1wWfi1n.Pu9Wl4OemMVcK/bKXXWJLRE3mW1Du4SvklEJZJy', NULL, 'siswa', '2025-06-14 23:40:58', '2025-06-14 23:40:58'),
(16, 'hizki', '$2y$10$9lFICbONfLQ2hLmkaxIcSOItnMBP8lRZ.RWrx0QnQE6pcKzCDdIJq', NULL, 'admin', '2025-06-19 00:42:46', '2025-06-19 01:49:20'),
(17, 'tiara', '$2y$10$m2LsL4/jstv9roMuh52uc.FeOBSbEGBHTmFrx7uUM.NI5rTYf.3uS', NULL, 'admin', '2025-06-19 00:47:12', '2025-06-19 00:47:12'),
(20, 'nova', '$2y$10$azeXVbP3xi5D.CP2QazA2u6r3pZ43uhjYxRZjg7AnlFqDNiJBVJd.', '1750320845_c5d6da302d0f4df17ec9.jpg', 'admin', '2025-06-19 01:05:44', '2025-06-19 01:58:35'),
(21, 'widya', '$2y$10$keiL.WfK/A153IWO9bS8pOqUglPbRgGGLbdqySseRQroEeYaLSWyW', NULL, 'siswa', '2025-06-19 01:18:51', '2025-06-19 01:18:51'),
(22, 'staff', '$2y$10$gxOkoSRc1jEIUVUO7IaRAu45QpBmkcFqy.NrErxTCeNIOg6Uyauv.', NULL, 'petugas', '2025-06-19 01:39:08', '2025-06-19 01:39:08'),
(23, 'siswa1', '$2y$10$5Avns2x6InmfUFLTs7fnBe0V1Su/4iHUP54HCw.elk6PgTu35RELe', '1750322906_76df89c539672db9ac6d.jpeg', 'siswa', '2025-06-19 01:46:39', '2025-06-19 01:48:26');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_book` (`id_book`),
  ADD KEY `petugas_id` (`petugas_id`);

--
-- Indeks untuk tabel `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_loan` (`id_loan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `loans_ibfk_2` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `loans_ibfk_3` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_ibfk_1` FOREIGN KEY (`id_loan`) REFERENCES `loans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
