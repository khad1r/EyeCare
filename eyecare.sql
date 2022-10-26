-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2022 at 11:42 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eyecare`
--
CREATE DATABASE IF NOT EXISTS `eyecare` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `eyecare`;

-- --------------------------------------------------------

--
-- Table structure for table `deskripsi_penyakit`
--

CREATE TABLE `deskripsi_penyakit` (
  `id` int(2) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `penyakit` varchar(255) NOT NULL,
  `penjelasan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deskripsi_penyakit`
--

INSERT INTO `deskripsi_penyakit` (`id`, `gambar`, `penyakit`, `penjelasan`) VALUES
(1, 'Normal/3_left-N.jpg', 'Mata Normal', 'Mata Yang Normal'),
(2, 'Age related Macular Degeneration/43_left-A.jpg', 'Degenerasi Makula Terkait Usia', 'Age-Related Macular Degeneration (degenerasi makula terkait usia) atau AMD adalah penyakit yang\nmenyerang pusat penglihatan di retina yakni makula, tanpa penyebab lain pada populasi di atas 50 tahun'),
(3, 'Cataract/0_left-C.jpg', 'Katarak', 'Katarak adalah setiap kekeruhanan pada lensa mata akibat hidrasi (penambahan cairan) lensa, denaturasi protein lensa atau akibat dari kedua-duanya yang biasanya mengenai kedua mata dan berjalan progresif'),
(4, 'Diabetes/2_right-D.jpg', 'Diabetic Retinopathy', 'Diabetic Retinopathy (DR) adalah retinopati (kerusakan pada retina) yang disebabkan oleh komplikasi diabetes melitus, yang pada akhirnya dapat menyebabkan kebutaan apabila tidak ditangani dengan cepat'),
(5, 'Glaucoma/167_left-G.jpg', 'Glaukoma', 'Glaukoma adalah penyakit mata yang ditandai oleh tekanan bola mata yang meningkat, ekskavasi dan atrofi pupil saraf optik, serta kerusakan lapang pandang yang khas'),
(6, 'Hypertension/23_right-H.jpg', 'Hipertensi okuli', 'Hipertensi okuli adalah suatu keadaan diamal tekanan intra okuli lebih besar daripada 21 mmHg. Batasan tersering yang dapat diterima untuk tekanan intra okuli pada populasi secara umum adalah 10-22 mmHG'),
(7, 'Myopia/39_left-M.jpg', 'Miopia', 'Miopia atau rabun jauh adalah suatu kelainan refraksi pada mata dimana bayangan difokuskan di depan retina, ketika mata tidak dalam kondisi berakomodasi. Ini juga dapat dijelaskan pada kondisi refraksi dimana cahaya yang sejajar dari suatu objek yang masu');

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasi mata`
--

CREATE TABLE `klasifikasi mata` (
  `id_klasifikasi` int(25) NOT NULL,
  `no_registrasi` int(15) NOT NULL,
  `Dokter` varchar(25) NOT NULL,
  `Klasifikasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `model_cnn`
--

CREATE TABLE `model_cnn` (
  `id_model` int(4) UNSIGNED ZEROFILL NOT NULL,
  `tgl_upload` date NOT NULL,
  `model` varchar(255) NOT NULL,
  `applied` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `model_cnn`
--

INSERT INTO `model_cnn` (`id_model`, `tgl_upload`, `model`, `applied`) VALUES
(0002, '2022-10-25', '25oct22', 1),
(0003, '2022-10-24', '24oct22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `no_registrasi` int(15) UNSIGNED ZEROFILL NOT NULL,
  `nama` varchar(100) NOT NULL,
  `umur` int(3) NOT NULL,
  `foto_fundus` varchar(255) NOT NULL,
  `klasifikasi` varchar(255) NOT NULL,
  `dokter` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`no_registrasi`, `nama`, `umur`, `foto_fundus`, `klasifikasi`, `dokter`) VALUES
(000000000444556, 'ggggg', 21, 'Normal/444556-kiri.jpg~Normal/444556-kanan.jpg', 'Normal~Normal', 'dokter'),
(000000001231321, 'Harzal Akbar', 21, 'baru/000000001231321-kiri.jpg~baru/000000001231321-kanan.jpg', 'baru~baru', 'dokter'),
(000004294967295, 'ggggg', 21, 'Normal/0011231312313-kiri.jpg~Normal/0011231312313-kanan.jpg', 'Normal~Normal', 'dokter');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`username`, `password`, `nama`, `jenis_user`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin'),
('dokter', 'd22af4180eee4bd95072eb90f94930e5', 'Dokter  Andri', 'dokter');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deskripsi_penyakit`
--
ALTER TABLE `deskripsi_penyakit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klasifikasi mata`
--
ALTER TABLE `klasifikasi mata`
  ADD PRIMARY KEY (`id_klasifikasi`);

--
-- Indexes for table `model_cnn`
--
ALTER TABLE `model_cnn`
  ADD PRIMARY KEY (`id_model`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`no_registrasi`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deskripsi_penyakit`
--
ALTER TABLE `deskripsi_penyakit`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `klasifikasi mata`
--
ALTER TABLE `klasifikasi mata`
  MODIFY `id_klasifikasi` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `model_cnn`
--
ALTER TABLE `model_cnn`
  MODIFY `id_model` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `no_registrasi` int(15) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4294967296;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
