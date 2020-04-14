-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2020 at 05:26 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `omelin`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id` int(10) NOT NULL,
  `id_latihan` int(10) NOT NULL,
  `id_murid` int(10) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id`, `id_latihan`, `id_murid`, `status`) VALUES
(1, 2, 3, 'Kabur'),
(2, 2, 1, 'Hadir'),
(3, 2, 2, 'Hadir'),
(4, 1, 3, 'Kabur'),
(5, 1, 1, 'Alfa'),
(6, 1, 2, 'Izin'),
(7, 3, 3, 'Kabur'),
(8, 3, 1, 'Hadir'),
(9, 3, 4, 'Hadir'),
(10, 3, 5, 'Hadir'),
(11, 3, 2, 'Hadir'),
(12, 3, 20200401, 'Hadir');

-- --------------------------------------------------------

--
-- Table structure for table `latihan`
--

CREATE TABLE `latihan` (
  `id_latihan` int(10) NOT NULL,
  `nama_latihan` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `materi` text NOT NULL,
  `pelatih` varchar(10) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `latihan`
--

INSERT INTO `latihan` (`id_latihan`, `nama_latihan`, `tanggal`, `jam`, `materi`, `pelatih`, `status`) VALUES
(1, 'Pemasaran', '2019-12-09', '09:00:00', 'Pemasaran Franchise Kuliner', '14045', 'Absen Selesai'),
(2, 'Pemasaran', '2019-12-10', '09:00:00', 'Studi banding produk Big Mac dengan burger lainnya', '14045', 'Absen Selesai'),
(3, 'Teknik Dasar', '2020-05-02', '10:00:00', 'Passing, Dribling,Shooting', '14022', 'Absen Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `murid`
--

CREATE TABLE `murid` (
  `id_murid` int(10) NOT NULL,
  `nama_murid` varchar(100) NOT NULL,
  `sex` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `pob` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `murid`
--

INSERT INTO `murid` (`id_murid`, `nama_murid`, `sex`, `dob`, `pob`, `alamat`, `foto`) VALUES
(1, 'Eral Hartawanputra', 'Laki-Laki', '1998-11-04', 'Bekasi', 'Rawa Belong', 'ERAL.jpg'),
(2, 'Nugroho Adi Pratomo', 'Laki-Laki', '1998-06-10', 'Bekasi', 'Rawa Bugel', 'NUGROHO.jpg'),
(3, 'Dobleh', 'Laki-Laki', '2019-12-06', 'Cilacap', 'Cilacap', 'MARPAUNG.jpg'),
(4, 'Jamaludin', 'Laki-Laki', '1998-03-05', 'Bekasi', 'Kabur', ''),
(5, 'Muhaimin Yusuf', 'Laki-Laki', '2020-04-05', 'Jakarta', 'Harapan Baru', 'MUHAIMIN.jpg'),
(20200401, 'Zikri Muhammad Iqbal', 'Laki-Laki', '1997-02-25', 'Cibinong', 'Klender', 'IMG_3051.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `pelatih`
--

CREATE TABLE `pelatih` (
  `NIP` varchar(40) NOT NULL,
  `nama_pelatih` varchar(125) NOT NULL,
  `JK` varchar(50) DEFAULT NULL,
  `foto` text NOT NULL,
  `status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelatih`
--

INSERT INTO `pelatih` (`NIP`, `nama_pelatih`, `JK`, `foto`, `status`) VALUES
('14022', 'Colonel Sanders', 'Pria', 'IMG-20170919-WA0016.jpg', 'na'),
('14045', 'Ronald', 'Pria', '20180915_204357_9906cf25e7771051ae84daf03b774707.png', 'na');

-- --------------------------------------------------------

--
-- Table structure for table `peserta_turnamen`
--

CREATE TABLE `peserta_turnamen` (
  `id_peserta_turnamen` int(10) NOT NULL,
  `id_turnamen` varchar(20) NOT NULL,
  `id_murid` varchar(20) NOT NULL,
  `Posisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peserta_turnamen`
--

INSERT INTO `peserta_turnamen` (`id_peserta_turnamen`, `id_turnamen`, `id_murid`, `Posisi`) VALUES
(6, '3', '5', 'Pemain'),
(7, '3', '20200401', 'Pemain');

-- --------------------------------------------------------

--
-- Table structure for table `turnamen`
--

CREATE TABLE `turnamen` (
  `id_turnamen` int(10) NOT NULL,
  `nama_turnamen` varchar(30) NOT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `pelatih` varchar(10) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `turnamen`
--

INSERT INTO `turnamen` (`id_turnamen`, `nama_turnamen`, `mulai`, `selesai`, `pelatih`, `status`) VALUES
(1, 'Jalak Putih Cup', '2020-04-18', '2020-04-20', '14045', 'set'),
(2, 'Dieci Cup 2', '2020-04-11', '2020-04-11', '14045', 'Set'),
(3, 'Pemprov HUT DKI Jakarta', '2020-06-15', '2020-06-20', '14022', 'ready');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(125) NOT NULL,
  `username` varchar(125) NOT NULL,
  `password` varchar(125) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Admin', 'admin', 'admin', 'admin'),
(2, 'Baba Utun', 'wowon', 'wowonganteng', 'admin'),
(3, 'operator', 'operator', 'operator', 'operator'),
(4, 'Colonel Sanders', '14022', '14022', 'Pelatih'),
(7, '20200401', '20200401', '1997-02-25', 'Murid'),
(8, '20200401', '20200401', '25021997', 'Murid');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `latihan`
--
ALTER TABLE `latihan`
  ADD PRIMARY KEY (`id_latihan`);

--
-- Indexes for table `murid`
--
ALTER TABLE `murid`
  ADD PRIMARY KEY (`id_murid`);

--
-- Indexes for table `pelatih`
--
ALTER TABLE `pelatih`
  ADD PRIMARY KEY (`NIP`);

--
-- Indexes for table `peserta_turnamen`
--
ALTER TABLE `peserta_turnamen`
  ADD PRIMARY KEY (`id_peserta_turnamen`);

--
-- Indexes for table `turnamen`
--
ALTER TABLE `turnamen`
  ADD PRIMARY KEY (`id_turnamen`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `latihan`
--
ALTER TABLE `latihan`
  MODIFY `id_latihan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `peserta_turnamen`
--
ALTER TABLE `peserta_turnamen`
  MODIFY `id_peserta_turnamen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `turnamen`
--
ALTER TABLE `turnamen`
  MODIFY `id_turnamen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
