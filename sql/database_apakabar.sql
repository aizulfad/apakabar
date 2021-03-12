-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2021 at 08:05 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_apakabar`
--

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tipe` enum('indoor','outdoor') NOT NULL,
  `stok` int(5) NOT NULL,
  `harga` int(11) NOT NULL DEFAULT 0,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_kendaraan`, `nama`, `tipe`, `stok`, `harga`, `created_date`) VALUES
(1, 'pickup ', 'outdoor', 5, 300000, '2021-03-10 21:40:46'),
(2, 'Segway', 'indoor', 10, 100000, '2021-03-10 21:40:46');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `menu_name` varchar(25) NOT NULL,
  `url` varchar(150) NOT NULL,
  `parent` varchar(4) NOT NULL,
  `type` enum('page','button') NOT NULL,
  `level` varchar(20) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_by` varchar(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `icon` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `menu_name`, `url`, `parent`, `type`, `level`, `status`, `created_by`, `created_at`, `icon`) VALUES
(2, 'Dashboard', 'dashboard', '0', 'page', 'all', '1', '1', '2021-01-12 16:42:47', 'fas fa-tachometer-alt'),
(8, 'User', 'user', '0', 'page', 'employee', '1', '1', '2021-01-13 14:24:35', 'fas fa-users'),
(57, 'Kendaraan', 'kendaraan', '0', 'page', 'all', '1', '', '2021-03-11 14:48:54', 'fas fa-car'),
(58, 'Pemesanan', 'pemesanan', '0', 'page', 'all', '1', '', '2021-03-11 14:48:54', 'fas fa-clipboard-list');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `tanggal_pemesanan` datetime NOT NULL DEFAULT current_timestamp(),
  `jumlah` int(11) NOT NULL,
  `durasi_pemakaian` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `total_pembayaran` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL,
  `id_kendaraan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `tanggal_pemesanan`, `jumlah`, `durasi_pemakaian`, `status`, `total_pembayaran`, `id_user`, `id_kendaraan`) VALUES
(1, '2021-03-11 21:15:24', 2, 1, '0', 600000, 2, 1),
(2, '2021-03-11 21:16:36', 2, 3, '1', 1800000, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `level_id` int(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(16) NOT NULL,
  `password` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `tipe_user` enum('admin','employee','super-admin') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `level_id`, `name`, `email`, `phone_number`, `password`, `created_date`, `tipe_user`) VALUES
(1, 1, 'Aizul Fadin', 'admin@gmail.com', '0822984800494', 'a0127d43ddf8a5838e5bb21d5c272b0377c1be5ed85b6d041f8680d5ca39566baa95f3c247d2a69f5f2f69b8a18a54db032bd5fd8363816cd81bd55a7a77014ckX38YWM1sIGJomaM7M56OnkIrOKn57EUewMQitRMpR0=', '2021-01-25 14:51:29', 'super-admin'),
(2, 0, 'fulan', 'fulan@gmail.com', '083356455234', 'e597b69a7ec96e363439c9f48b8a02054a0e91553a8ad9bc1b742a01b63a1d2cb669fb56ff763ba8308de5c2afb73efd5762628d7145bf111b5f3ed047495ed1Dymh4Pt/eHFlAEjGrcpMJ+N72KSDGioUUitAUu8Zsgg=', '2021-03-11 13:55:44', 'employee'),
(15, 0, 'budi', 'budi@gmail.com', '08552253832', 'fbf207327909aa06a0fb03cf208c0b36c186967442d5889a02a3e2e502131fbe6b8db73a2fd8f32e6016e4c5f245297abb38299ed6b8b7f2c75eb4037bf342f0Oxy6bdpDlQ3gB+lXISgoVTHSEUH6xv4Na8487J08t54=', '2021-03-12 09:44:13', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`) USING BTREE;

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kendaraan` (`id_kendaraan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_kendaraan`) REFERENCES `kendaraan` (`id_kendaraan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
