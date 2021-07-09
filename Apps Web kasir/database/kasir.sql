-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2021 at 07:34 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectuas`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `NAMA_BARANG` varchar(50) NOT NULL,
  `HARGA` int(11) NOT NULL,
  `JUMLAH` int(11) NOT NULL,
  `KD_BARANG` varchar(11) NOT NULL,
  `MEREK` varchar(50) NOT NULL,
  `JENIS` varchar(50) NOT NULL,
  `UKURAN` varchar(50) NOT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `NAMA_BARANG`, `HARGA`, `JUMLAH`, `KD_BARANG`, `MEREK`, `JENIS`, `UKURAN`, `Waktu`) VALUES
(7, 'mageti', 2500, 98, '318', 'INDOMIE', 'Makanan', 'item', '2021-07-08 17:34:17');

--
-- Triggers `barang`
--
DELIMITER $$
CREATE TRIGGER `UPDATE` AFTER UPDATE ON `barang` FOR EACH ROW INSERT INTO barang_log (ID_BARANG,Nama_barang,JUMLAH, Keterangan, Pengguna) VALUES (NEW.ID_BARANG,NEW.NAMA_BARANG,NEW.JUMLAH,'UPDATE', @u)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete` BEFORE DELETE ON `barang` FOR EACH ROW INSERT INTO barang_log (ID_BARANG,Nama_barang,JUMLAH, Keterangan, Pengguna) VALUES (OLD.ID_BARANG,OLD.NAMA_BARANG,OLD.JUMLAH,'DELETE', @u)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert` AFTER INSERT ON `barang` FOR EACH ROW INSERT INTO barang_log (ID_BARANG,Nama_barang,JUMLAH, Keterangan, Pengguna) VALUES (NEW.ID_BARANG,NEW.NAMA_BARANG,NEW.JUMLAH,'INSERT', @u)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_log`
--

CREATE TABLE `barang_log` (
  `id_log` int(4) NOT NULL,
  `ID_BARANG` int(4) NOT NULL,
  `Nama_barang` varchar(50) NOT NULL,
  `JUMLAH` varchar(50) DEFAULT NULL,
  `Keterangan` enum('INSERT','UPDATE','DELETE') DEFAULT NULL,
  `Pengguna` varchar(50) DEFAULT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_log`
--

INSERT INTO `barang_log` (`id_log`, `ID_BARANG`, `Nama_barang`, `JUMLAH`, `Keterangan`, `Pengguna`, `Waktu`) VALUES
(40, 6, 'mageti', '10000', 'DELETE', 'admin', '2021-07-08 17:30:59'),
(41, 7, 'mageti', '100', 'INSERT', 'admin', '2021-07-08 17:33:49'),
(42, 7, 'mageti', '98', 'UPDATE', NULL, '2021-07-08 17:34:17');

-- --------------------------------------------------------

--
-- Table structure for table `merek`
--

CREATE TABLE `merek` (
  `IM` int(11) NOT NULL,
  `Id` char(50) NOT NULL,
  `Nama_Merek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merek`
--

INSERT INTO `merek` (`IM`, `Id`, `Nama_Merek`) VALUES
(6, 'KY', 'YAKULT'),
(7, 'P01', 'INDOMIE'),
(8, 'Bi', 'Bimoli'),
(9, 'CH', 'Hemaviton C1000');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(255) NOT NULL,
  `Nama_Produk` varchar(50) NOT NULL,
  `Harga_Satuan` varchar(100) NOT NULL,
  `Jumlah` int(100) NOT NULL,
  `Harga_total` int(255) NOT NULL,
  `pembeli` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `Nama_Produk`, `Harga_Satuan`, `Jumlah`, `Harga_total`, `pembeli`, `tanggal`) VALUES
(16, 'mageti', '2500', 2, 5000, 'jerry', '2021-07-08 17:34:17');

--
-- Triggers `pembelian`
--
DELIMITER $$
CREATE TRIGGER `beli` AFTER INSERT ON `pembelian` FOR EACH ROW BEGIN
UPDATE barang SET JUMLAH=JUMLAH-NEW.jumlah WHERE NAMA_BARANG=NEW.Nama_Produk;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Sandi` varchar(100) NOT NULL,
  `Keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `Nama`, `Username`, `Sandi`, `Keterangan`) VALUES
(1, 'admin', 'admin', 'admin', 'admin'),
(2, 'user', 'user', 'user', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `NAMA_BARANG` (`NAMA_BARANG`);

--
-- Indexes for table `barang_log`
--
ALTER TABLE `barang_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `merek`
--
ALTER TABLE `merek`
  ADD PRIMARY KEY (`IM`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_barang` (`Nama_Produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `barang_log`
--
ALTER TABLE `barang_log`
  MODIFY `id_log` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `merek`
--
ALTER TABLE `merek`
  MODIFY `IM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
