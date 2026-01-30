-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 30, 2026 at 01:47 AM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_umkm_candimulyo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_umkm`
--

DROP TABLE IF EXISTS `tb_umkm`;
CREATE TABLE IF NOT EXISTS `tb_umkm` (
  `id_umkm` int NOT NULL AUTO_INCREMENT,
  `id_wilayah` int NOT NULL,
  `nama_usaha` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemilik` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rt` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produk` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak_hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_umkm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default.jpg',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_umkm`),
  KEY `fk_wilayah` (`id_wilayah`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_umkm`
--

INSERT INTO `tb_umkm` (`id_umkm`, `id_wilayah`, `nama_usaha`, `pemilik`, `rt`, `produk`, `kontak_hp`, `foto_umkm`, `created_at`, `updated_at`) VALUES
(1, 6, 'Azka Coffe', 'Ratmanto', '4', '', '', 'default.jpg', '2026-01-29 18:37:24', '2026-01-29 18:37:24');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE IF NOT EXISTS `tb_users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin') COLLATE utf8mb4_unicode_ci DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `username`, `password_hash`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$YourGeneratedHashHere', 'admin', '2026-01-30 00:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_wilayah`
--

DROP TABLE IF EXISTS `tb_wilayah`;
CREATE TABLE IF NOT EXISTS `tb_wilayah` (
  `id_wilayah` int NOT NULL AUTO_INCREMENT,
  `nama_wilayah` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rw` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_wilayah`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_wilayah`
--

INSERT INTO `tb_wilayah` (`id_wilayah`, `nama_wilayah`, `rw`) VALUES
(1, 'Dusun Ngijingan', '01'),
(2, 'Dusun Ngumbulan', '02'),
(3, 'Dusun Demangan', '03'),
(4, 'Dusun Nglarangan', '04'),
(5, 'Dusun Pakisan', '05'),
(6, 'Dusun Sosoran', '06'),
(7, 'Dusun Dumpil', '07'),
(8, 'Dusun Kedungwuluh', '08'),
(9, 'Dusun Klegen', '09'),
(10, 'Perum Candiasri', '10'),
(11, 'Perum Candimulyo Asri', '11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
