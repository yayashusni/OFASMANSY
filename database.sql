-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2022 at 01:59 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_yayas`
--

CREATE TABLE `maintenance_yayas` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jenis_kerusakan` varchar(30) NOT NULL,
  `spot_area` varchar(35) NOT NULL,
  `kode_karyawan` varchar(10) NOT NULL,
  `status_perbaikan` varchar(35) NOT NULL,
  `nama_file` varchar(50) NOT NULL,
  `tanggal_upload` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintenance_yayas`
--

INSERT INTO `maintenance_yayas` (`id`, `nama_barang`, `jenis_kerusakan`, `spot_area`, `kode_karyawan`, `status_perbaikan`, `nama_file`, `tanggal_upload`) VALUES
(10, 'Sepeda Motor (Honda vario)', 'bocor karbu', 'Ruang Kendaraan', 'PK-001', 'selesai', 'download.png', '2022-02-01'),
(11, 'AC kantor', 'ac mati', 'lantai 1 ruang server', 'PK-002', 'selesai', 'amd althon logo.png', '2022-05-01'),
(12, 'pintu 2 bar', 'engsel macet', 'ruang dapur', 'PK-001', 'perbaikan', 'correfull logo.png', '2022-03-25'),
(14, 'Kursi Tamu', 'dimakan rayap', 'ruang tamu', 'PK-001', 'selesai', '2019-08-28.png', '2022-04-26'),
(25, 'kursi Rapat', 'patah', 'lantai 1 ruang rapat', 'PK-001', 'selesai', 'Screenshot (306).png', '2022-03-02'),
(26, 'AC kantor', 'ac mati', 'lantai 1 ruang server', 'PK-001', 'perbaikan', 'foto2.jpg', '2022-01-30'),
(27, 'lampu LED ', 'mati lampu', 'ruang rapat ', 'PK-003', 'pending', 'talha.jpg', '2022-01-31'),
(28, 'mesin fotocopy', 'mesin rusak ', 'ruang atk', 'PK-003', 'pending', 'chadengle.jpg', '2022-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `user_yayas`
--

CREATE TABLE `user_yayas` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jk` varchar(15) NOT NULL,
  `kode_karyawan` varchar(10) NOT NULL,
  `level` int(11) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama_file` varchar(50) DEFAULT NULL,
  `ukuran_file` double DEFAULT NULL,
  `jenis_file` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_yayas`
--

INSERT INTO `user_yayas` (`id`, `nama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `jk`, `kode_karyawan`, `level`, `email`, `password`, `nama_file`, `ukuran_file`, `jenis_file`) VALUES
(11, 'admin', 'alamat admin', 'Ciamis', '2022-01-30', 'Laki-laki', 'ADM', 0, 'admin@mail.com', 'admin', 'foto3.jpg', 447507, 'image/jpeg'),
(12, 'Yayas Husni M', 'selamaya', 'ciamis', '2022-01-30', 'Laki-laki', 'PK-001', 1, 'yayas@gmail.com', '12345678', 'IMG-20190223-WA0026.jpg', 55976, 'image/jpeg'),
(13, 'Agus Abdul', 'citereup', 'ciamis', '2022-01-31', 'Laki-laki', 'PK-002', 1, 'agus@mail.com', '12345678', NULL, NULL, NULL),
(14, 'Husni', 'selamaya', 'ciamis', '2022-01-31', 'Laki-laki', 'PK-003', 1, 'husni@gmail.com', '12345678', NULL, NULL, NULL),
(15, 'Sinta', 'selamaya', 'ciamis', '2022-01-25', 'Perempuan', 'PK-004', 1, 'sinta@mail.com', '12345678', NULL, NULL, NULL),
(16, 'solehudin', 'citereup', 'bandung', '2022-01-25', 'Laki-laki', 'PK-005', 1, 'soleh24@gmail.com', '12345678', NULL, NULL, NULL),
(17, 'Ujang Surya', 'Tasikmalaya', 'Jakarta', '1999-01-24', 'Laki-laki', 'PK-006', 1, 'ujang21@gmail.com', '12345678', NULL, NULL, NULL),
(18, 'Susilawati', 'Sukamulya', 'Tasikmalaya', '2000-01-31', 'Perempuan', 'PK-007', 1, 'susi21@gmail.com', '12345678', 'avatar.png', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `maintenance_yayas`
--
ALTER TABLE `maintenance_yayas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_yayas`
--
ALTER TABLE `user_yayas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `maintenance_yayas`
--
ALTER TABLE `maintenance_yayas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_yayas`
--
ALTER TABLE `user_yayas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
