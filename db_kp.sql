-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2021 at 02:11 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `stok_barang` int(11) NOT NULL,
  `deskripsi_barang` text NOT NULL,
  `gambar_barang` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kode_barang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama_barang`, `stok_barang`, `deskripsi_barang`, `gambar_barang`, `created_date`, `kode_barang`) VALUES
(81, 'Iphone x', 2, 'Lorem ipsum dolor sit amet', 'IPHONE_X_256_GB_____ORIGINAL_SECOND_EX_INTER.jpg', '2021-02-09 04:13:22', 'KB001'),
(82, 'Samsung Galaxy S9', 5, 'Lorem ipsum dolor sit amet', 'Samsung Galaxy S9.jpg', '2021-02-08 15:34:14', 'KB002'),
(87, 'Laptop asus vivobook', 5, 'Lorem ipsum dolor sit amet', 'Laptop Asus Vivobook.jpg', '2021-02-08 15:34:21', 'KB003'),
(89, 'Laptop asus', 5, 'Lorem ipsum dolor sit amet', 'Laptop Asus.jpg', '2021-02-08 13:59:43', 'KB004'),
(90, 'Laptop ROG', 5, 'Lorem ipsum dolor sit amet', 'Laptop ROG.jpg', '2021-02-08 14:24:21', 'KB005'),
(91, 'Laptop acer', 5, 'Lorem ipsum dolor sit amet', 'Laptop acer.jpg', '2021-02-08 14:25:00', 'KB006'),
(92, 'Laptop samsung galaxy', 5, 'Lorem ipsum dolor sit amet', 'Laptop samsung galaxy.jpg', '2021-02-08 14:25:38', 'KB007'),
(93, 'Laptop lenovo yoga', 5, 'Lorem ipsum dolor sit amet', 'Lenovo_Yoga_730_13_L_1.jpg', '2021-02-08 14:26:51', 'KB008'),
(94, 'Laptop lenovo ideapad', 5, 'Lorem ipsum dolor sit amet', 'Lenovo_Ideapad_330_14a_L_1.jpg', '2021-02-08 14:27:53', 'KB009'),
(95, 'Laptop lenovo thinkpad', 5, 'Lorem ipsum dolor sit amet', 'Laptop lenovo thinkpad.jpg', '2021-02-08 14:30:00', 'KB010'),
(96, 'Xiomi redmi 6A', 5, 'Lorem ipsum dolor sit amet', 'Xiaomi redmi 6A.jpg', '2021-02-08 14:33:29', 'KB011'),
(97, 'Mi9', 5, 'Lorem ipsum dolor sit amet', 'Xiaomi_Mi_9_L_1.jpg', '2021-02-08 14:34:07', 'KB012'),
(98, 'Mi 6X', 5, 'Lorem ipsum dolor sit amet', 'Xiaomi_Mi_6X_L_1.jpg', '2021-02-08 14:34:26', 'KB013'),
(99, 'Xiaomi doraemon', 5, 'Lorem ipsum dolor sit amet', 'Harga-hp-Xiaomi-Mi-10-Youth-Doraemon-Limited-Edition-600x600.jpg', '2021-02-08 14:34:52', 'KB014'),
(100, 'Infinix purple', 5, 'Lorem ipsum dolor sit amet', 'Infinix purple.jpg', '2021-02-08 14:36:07', 'KB015'),
(101, 'Infinix smart', 5, 'Lorem ipsum dolor sit amet', 'Infinix smart.jpg', '2021-02-08 14:46:25', 'KB016'),
(102, 'Infinix S4', 5, 'Lorem ipsum dolor sit amet', 'Infinix S4.jpg', '2021-02-08 14:46:59', 'KB017'),
(103, 'Iphone 11', 5, 'Lorem ipsum dolor sit amet', 'Iphone 11.jpeg', '2021-02-08 14:49:49', 'KB018'),
(104, 'Nokia 5 3', 5, 'Lorem ipsum dolor sit amet', 'Nokia_5_3_L_1.jpg', '2021-02-08 14:51:16', 'KB019'),
(105, 'Apple macbook air', 5, 'Lorem ipsum dolor sit amet', 'Apple_MacBook_Air_13_M1_2020_L_1.jpg', '2021-02-08 14:53:04', 'KB020');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_karyawan`
--

CREATE TABLE `tbl_karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nip` varchar(16) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `divisi` varchar(30) NOT NULL,
  `kode_karyawan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_karyawan`
--

INSERT INTO `tbl_karyawan` (`id_karyawan`, `nip`, `nama`, `email`, `password`, `no_telp`, `divisi`, `kode_karyawan`) VALUES
(337, '17121040', 'Rian Cahyadi', 'rian.cahyadi@wgs-id.com', '4116e0e25dcad2dd4b202b3eaf2b4f1ae6497e25', '081779525818', 'Software Quality Assurance', 'KK001'),
(338, '17121041', 'Sandi setiawan', 'sandi.setiawan@gmail.com', '4b1e2554cf51dcfb19cae120c8fdc037655b2f5c', '081779525818', 'Software Quality Assurance', 'KK002');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengajuan`
--

CREATE TABLE `tbl_pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `rencana_tgl_peminjaman` date NOT NULL,
  `rencana_tgl_pengambilan` date NOT NULL,
  `rencana_tgl_pengembalian` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `note_pengajuan` text NOT NULL,
  `status` enum('Wait','Done','On Progress') NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `kode_karyawan` varchar(10) NOT NULL,
  `kode_pengajuan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pengajuan`
--

INSERT INTO `tbl_pengajuan` (`id_pengajuan`, `rencana_tgl_peminjaman`, `rencana_tgl_pengambilan`, `rencana_tgl_pengembalian`, `jumlah`, `note_pengajuan`, `status`, `kode_barang`, `kode_karyawan`, `kode_pengajuan`) VALUES
(67, '2021-01-01', '2021-01-02', '2021-01-31', 1, 'Sudah di ambil barang nya', 'Done', 'KB001', 'KK001', 'KP001'),
(68, '2021-02-09', '2021-02-10', '2021-02-28', 1, 'Barang sudah di terima dan dipinjam', 'Done', 'KB001', 'KK002', 'KP002'),
(69, '2021-02-09', '2021-02-10', '2021-02-28', 1, 'Pinjam\r\nSilahkan diambil besok', 'Done', 'KB001', 'KK001', 'KP003');

--
-- Triggers `tbl_pengajuan`
--
DELIMITER $$
CREATE TRIGGER `peminjaman` AFTER INSERT ON `tbl_pengajuan` FOR EACH ROW BEGIN
	UPDATE tbl_barang SET stok_barang = stok_barang - NEW.jumlah WHERE kode_barang = NEW.kode_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengembalian`
--

CREATE TABLE `tbl_pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `kode_pengembalian` varchar(10) NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `denda` double NOT NULL,
  `note_pengembalian` text NOT NULL,
  `status` enum('Done') NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kode_pengajuan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pengembalian`
--

INSERT INTO `tbl_pengembalian` (`id_pengembalian`, `kode_pengembalian`, `tgl_pengembalian`, `jumlah`, `denda`, `note_pengembalian`, `status`, `created_date`, `kode_pengajuan`) VALUES
(29, 'KP001', '2021-01-31', 1, 200000, 'Kerusakan LCD, harap membayar denda untuk besok', 'Done', '2021-02-09 01:11:57', 'KP001'),
(30, 'KP002', '2021-02-28', 1, 200000, 'Kerusakan LCD', 'Done', '2021-02-09 02:00:14', 'KP002');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `kode_karyawan` (`kode_karyawan`);

--
-- Indexes for table `tbl_pengajuan`
--
ALTER TABLE `tbl_pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `kode_karyawan` (`kode_karyawan`),
  ADD KEY `kode_peminjaman` (`kode_pengajuan`);

--
-- Indexes for table `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `kode_peminjaman` (`kode_pengajuan`),
  ADD KEY `kode_pengembalian` (`kode_pengembalian`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=339;

--
-- AUTO_INCREMENT for table `tbl_pengajuan`
--
ALTER TABLE `tbl_pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_pengajuan`
--
ALTER TABLE `tbl_pengajuan`
  ADD CONSTRAINT `tbl_pengajuan_ibfk_1` FOREIGN KEY (`kode_karyawan`) REFERENCES `tbl_karyawan` (`kode_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pengajuan_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `tbl_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  ADD CONSTRAINT `tbl_pengembalian_ibfk_1` FOREIGN KEY (`kode_pengajuan`) REFERENCES `tbl_pengajuan` (`kode_pengajuan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
