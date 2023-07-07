-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2023 at 07:00 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spe`
--

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `id_inbox` varchar(36) NOT NULL,
  `email_inbox` varchar(50) NOT NULL,
  `deskripsi_inbox` varchar(50) NOT NULL,
  `file_inbox` varchar(50) DEFAULT NULL,
  `status_inbox` int(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 = Pengajuan, 1 = Diproses, 2 = Diteruskan, 3 = Selesai diambil, 4 = Selesai diemail',
  `tipe_inbox` int(1) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `tanggal_inbox` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id_inbox`, `email_inbox`, `deskripsi_inbox`, `file_inbox`, `status_inbox`, `tipe_inbox`, `id_user`, `tanggal_inbox`, `updated_at`) VALUES
('2007411020_1', 'test judul', 'test deskripsi', NULL, 4, 0, 5, '2023-07-07 21:37:10', '2023-07-07 23:59:25');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id_inventory` bigint(20) UNSIGNED NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `kode_surat` int(20) NOT NULL,
  `perihal_surat` text NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_terima_surat` date NOT NULL,
  `asal_surat` varchar(50) NOT NULL,
  `tindak_lanjut` int(1) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(241, '2023-05-16-081716', 'App\\Database\\Migrations\\Inventory', 'default', 'App', 1688739472, 1),
(242, '2023-05-31-011844', 'App\\Database\\Migrations\\Role', 'default', 'App', 1688739472, 1),
(243, '2023-06-06-121059', 'App\\Database\\Migrations\\User', 'default', 'App', 1688739472, 1),
(244, '2023-06-10-082142', 'App\\Database\\Migrations\\Tipe', 'default', 'App', 1688739473, 1),
(245, '2023-06-10-082650', 'App\\Database\\Migrations\\Inbox', 'default', 'App', 1688739474, 1),
(246, '2023-07-05-043503', 'App\\Database\\Migrations\\Status', 'default', 'App', 1688739474, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(1) UNSIGNED NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `nama_role`) VALUES
(0, 'Admin'),
(1, 'Tendik'),
(2, 'Dosen'),
(3, 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(1) UNSIGNED NOT NULL,
  `nama_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `nama_status`) VALUES
(0, 'Pengajuan'),
(1, 'Diproses'),
(2, 'Diteruskan'),
(3, 'Selesai Diambil di Jurusan'),
(4, 'Selesai Diemail');

-- --------------------------------------------------------

--
-- Table structure for table `tipe`
--

CREATE TABLE `tipe` (
  `id_tipe` int(1) UNSIGNED NOT NULL,
  `nama_tipe` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipe`
--

INSERT INTO `tipe` (`id_tipe`, `nama_tipe`) VALUES
(0, 'SK'),
(1, 'Surat Tugas'),
(2, 'Surat Undangan'),
(3, 'Surat Pengantar'),
(4, 'Lembar Pengesah'),
(5, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `nomor_induk_user` int(20) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `password_user` varchar(60) NOT NULL,
  `id_role` int(1) UNSIGNED NOT NULL COMMENT '0 = Admin, 1 = Tendik, 2 = Dosen, 3 = Mahasiswa',
  `status_user` tinyint(1) NOT NULL COMMENT '0 = Nonaktif, 1 = Aktif',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `nomor_induk_user`, `email_user`, `password_user`, `id_role`, `status_user`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 0, 'admin@pnj.com', '$2y$10$i8ZNNzk5sjP.oA6GUOvDjO6czqir4wP9SRgXoXkG9Erk736ej0QQu', 0, 1, '2023-07-07 21:18:01', '2023-07-07 22:40:09'),
(2, 'Tendik', 1, 'tendik@pnj.com', '$2y$10$w/Md2i8lIrW5QPMmJhvWiOb.MAx6jObKj6c5IAo7lMqk1KqawZyTS', 1, 1, '2023-07-07 21:18:01', '2023-07-07 21:18:01'),
(3, 'Dosen', 2, 'dosen@pnj.com', '$2y$10$TtYVBNvQKXgz3iyReN9AMehKRhuyIsQxur5pJUe67X96IotjsV6XW', 2, 1, '2023-07-07 21:18:01', '2023-07-07 21:18:01'),
(5, 'Hafiz Juansyah Putra', 2007411020, 'hafiz.juansyahputra.tik20@mhsw.pnj.ac.id', '$2y$10$1EDQt9eC8hENqaEe.vRIPODJl3Wv3SQqsrouPLD1Wab2lcob7BeAS', 3, 1, '2023-07-07 21:20:33', '2023-07-07 21:36:56'),
(6, 'Windi Noviani', 2007411017, 'windi.noviani.tik20@mhsw.pnj.ac.id', '$2y$10$hzJMJXs9RavjNnWMQs.Mtux9PJ6Fq0PUcfLfmEseUx0fHFqoL./4u', 3, 0, '2023-07-07 21:21:35', '2023-07-07 22:54:16'),
(7, 'Fauziah Umri', 2007411028, 'fauziah.umri.tik20@mhsw.pnj.ac.id', '$2y$10$.FxCUd6PUsz1KVMsSJPTd.iJIydugdipgr.PperHI3yshBoV705e2', 3, 0, '2023-07-07 21:22:04', '2023-07-07 21:22:04'),
(8, 'Andini Mutiara', 2007411022, 'andini.mutiara.tik20@mhsw.pnj.ac.id', '$2y$10$WNvpDQYZGTED8.bjmnZaFOuZK55pYM.BJ9pdQlGK2gvFih2xwMNqS', 3, 0, '2023-07-07 21:22:30', '2023-07-07 21:22:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id_inbox`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id_inventory`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `nomor_induk_user` (`nomor_induk_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id_inventory` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
