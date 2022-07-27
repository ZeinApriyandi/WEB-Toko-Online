-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2022 at 04:53 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--
DROP DATABASE IF EXISTS `ecommerce`;
CREATE DATABASE IF NOT EXISTS `ecommerce` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ecommerce`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(2, 'Elektronik'),
(1, 'Handphone'),
(5, 'Mainan'),
(6, 'Makanan');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sesi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_dt`
--

CREATE TABLE `pesanan_dt` (
  `id_detail` int(11) NOT NULL,
  `no_trans` varchar(50) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan_dt`
--

INSERT INTO `pesanan_dt` (`id_detail`, `no_trans`, `id_produk`, `jumlah`) VALUES
(1, '62afdc635cdd9', 2, 1),
(2, '62afdc635cdd9', 3, 1),
(4, '62afdc89df9ac', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_hd`
--

CREATE TABLE `pesanan_hd` (
  `no_trans` varchar(50) NOT NULL,
  `tgl_trans` timestamp NOT NULL DEFAULT current_timestamp(),
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `provinsi` int(11) NOT NULL,
  `kota` int(11) NOT NULL,
  `kurir` varchar(10) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan_hd`
--

INSERT INTO `pesanan_hd` (`no_trans`, `tgl_trans`, `nama`, `alamat`, `provinsi`, `kota`, `kurir`, `total`) VALUES
('62afdc635cdd9', '2022-06-20 02:33:07', 'Budi', 'Jl. Gajahmada No. 123', 5, 501, 'tiki', 117000),
('62afdc89df9ac', '2022-06-20 02:33:45', 'Alex', 'Jl. A. Yani No. 44', 18, 368, 'pos', 94900);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` text NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode`, `nama`, `id_kategori`, `harga`, `foto`, `deskripsi`) VALUES
(1, 'B0001', 'Pompa Galon Elektrik', 2, 55000, 'produk1.jpg', '...'),
(2, 'B0002', 'Indomie Goreng 4 Pcs', 6, 12000, 'produk2.jpg', ''),
(3, 'B0003', 'Kue Kering', 6, 75000, 'produk3.jpg', ''),
(4, 'B0004', 'Sandisk 16 GB', 1, 65000, 'produk8.jpg', ''),
(5, 'B0005', 'Vixal', 6, 24000, 'produk9.jpg', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan_dt`
--
ALTER TABLE `pesanan_dt`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `pesanan_hd`
--
ALTER TABLE `pesanan_hd`
  ADD PRIMARY KEY (`no_trans`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pesanan_dt`
--
ALTER TABLE `pesanan_dt`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
