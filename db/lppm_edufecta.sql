-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2022 at 02:39 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lppm_edufecta`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidang_ilmu`
--

CREATE TABLE `bidang_ilmu` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidang_ilmu`
--

INSERT INTO `bidang_ilmu` (`id`, `nama`, `keterangan`, `status`) VALUES
(1, 'Teknowirausaha1', '-', 1);

-- --------------------------------------------------------

--
-- Table structure for table `luaran`
--

CREATE TABLE `luaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `luaran`
--

INSERT INTO `luaran` (`id`, `nama`, `keterangan`, `status`) VALUES
(1, 'Publikasi di Jurnal Internasional', '-', 1),
(2, 'Buku Cetak Hasil Penelitian', '-', 0),
(3, 'Buku Elektronik Hasil Penelitian', '-', 1),
(4, 'Publikasi di prosiding seminar internasional', '-', 1),
(5, 'Publikasi di Jurnal Nasional', '-', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pencairan`
--

CREATE TABLE `pencairan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pencairan`
--

INSERT INTO `pencairan` (`id`, `nama`, `keterangan`, `status`) VALUES
(1, 'Dana BOS1', '', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `skim_penelitian`
--

CREATE TABLE `skim_penelitian` (
  `id` int(11) NOT NULL,
  `id_luaran` int(11) NOT NULL,
  `id_jenis_pencairan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `maksimal_pengajuan` tinyint(1) NOT NULL,
  `syarat` tinyint(1) NOT NULL,
  `list_syarat` text DEFAULT NULL,
  `lama_penyelesaian` tinyint(1) NOT NULL,
  `wajib_lapor_kemajuan` tinyint(1) NOT NULL,
  `maksimal_dana` int(11) NOT NULL,
  `jumlah_maksimal_pengajuan` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sub_bidang_ilmu`
--

CREATE TABLE `sub_bidang_ilmu` (
  `id` int(11) NOT NULL,
  `id_bidang_ilmu` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidang_ilmu`
--
ALTER TABLE `bidang_ilmu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `luaran`
--
ALTER TABLE `luaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pencairan`
--
ALTER TABLE `pencairan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_bidang_ilmu`
--
ALTER TABLE `sub_bidang_ilmu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK1` (`id_bidang_ilmu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidang_ilmu`
--
ALTER TABLE `bidang_ilmu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `luaran`
--
ALTER TABLE `luaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pencairan`
--
ALTER TABLE `pencairan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_bidang_ilmu`
--
ALTER TABLE `sub_bidang_ilmu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sub_bidang_ilmu`
--
ALTER TABLE `sub_bidang_ilmu`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`id_bidang_ilmu`) REFERENCES `bidang_ilmu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
