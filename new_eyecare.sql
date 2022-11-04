-- MariaDB dump 10.19  Distrib 10.5.15-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: eyecare
-- ------------------------------------------------------
-- Server version	10.5.15-MariaDB-0+deb11u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `deskripsi_penyakit`
--

DROP TABLE IF EXISTS `deskripsi_penyakit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deskripsi_penyakit` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `gambar` varchar(255) NOT NULL,
  `penyakit` varchar(255) NOT NULL,
  `penjelasan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deskripsi_penyakit`
--

LOCK TABLES `deskripsi_penyakit` WRITE;
/*!40000 ALTER TABLE `deskripsi_penyakit` DISABLE KEYS */;
INSERT INTO `deskripsi_penyakit` VALUES (1,'Normal/3_left-N.jpg','Mata Normal','Mata Yang Normal'),(2,'Age related Macular Degeneration/43_left-A.jpg','Degenerasi Makula Terkait Usia','Age-Related Macular Degeneration (degenerasi makula terkait usia) atau AMD adalah penyakit yang\nmenyerang pusat penglihatan di retina yakni makula, tanpa penyebab lain pada populasi di atas 50 tahun'),(3,'Cataract/0_left-C.jpg','Katarak','Katarak adalah setiap kekeruhanan pada lensa mata akibat hidrasi (penambahan cairan) lensa, denaturasi protein lensa atau akibat dari kedua-duanya yang biasanya mengenai kedua mata dan berjalan progresif'),(4,'Diabetes/2_right-D.jpg','Diabetic Retinopathy','Diabetic Retinopathy (DR) adalah retinopati (kerusakan pada retina) yang disebabkan oleh komplikasi diabetes melitus, yang pada akhirnya dapat menyebabkan kebutaan apabila tidak ditangani dengan cepat'),(5,'Glaucoma/167_left-G.jpg','Glaukoma','Glaukoma adalah penyakit mata yang ditandai oleh tekanan bola mata yang meningkat, ekskavasi dan atrofi pupil saraf optik, serta kerusakan lapang pandang yang khas'),(6,'Hypertension/23_right-H.jpg','Hipertensi okuli','Hipertensi okuli adalah suatu keadaan diamal tekanan intra okuli lebih besar daripada 21 mmHg. Batasan tersering yang dapat diterima untuk tekanan intra okuli pada populasi secara umum adalah 10-22 mmHG'),(7,'Myopia/39_left-M.jpg','Miopia','Miopia atau rabun jauh adalah suatu kelainan refraksi pada mata dimana bayangan difokuskan di depan retina, ketika mata tidak dalam kondisi berakomodasi. Ini juga dapat dijelaskan pada kondisi refraksi dimana cahaya yang sejajar dari suatu objek yang masu');
/*!40000 ALTER TABLE `deskripsi_penyakit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `klasifikasi mata`
--

DROP TABLE IF EXISTS `klasifikasi mata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `klasifikasi mata` (
  `id_klasifikasi` int(25) NOT NULL AUTO_INCREMENT,
  `no_registrasi` int(15) NOT NULL,
  `Dokter` varchar(25) NOT NULL,
  `Klasifikasi` varchar(255) NOT NULL,
  PRIMARY KEY (`id_klasifikasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `klasifikasi mata`
--

LOCK TABLES `klasifikasi mata` WRITE;
/*!40000 ALTER TABLE `klasifikasi mata` DISABLE KEYS */;
/*!40000 ALTER TABLE `klasifikasi mata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_cnn`
--

DROP TABLE IF EXISTS `model_cnn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_cnn` (
  `id_model` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `tgl_upload` date NOT NULL,
  `applied` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_model`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_cnn`
--

LOCK TABLES `model_cnn` WRITE;
/*!40000 ALTER TABLE `model_cnn` DISABLE KEYS */;
INSERT INTO `model_cnn` VALUES (0001,'2022-10-26',1),(0002,'2022-10-26',0);
/*!40000 ALTER TABLE `model_cnn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pasien`
--

DROP TABLE IF EXISTS `pasien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pasien` (
  `no_registrasi` int(15) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `umur` int(3) NOT NULL,
  `foto_fundus` varchar(255) NOT NULL,
  `klasifikasi` varchar(255) NOT NULL,
  `dokter` varchar(25) NOT NULL,
  PRIMARY KEY (`no_registrasi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pasien`
--

LOCK TABLES `pasien` WRITE;
/*!40000 ALTER TABLE `pasien` DISABLE KEYS */;
INSERT INTO `pasien` VALUES (000000000000001,'Abdul Kadir Jaelani',20,'Cataract/000000000000001-kiri.jpg~Cataract/000000000000001-kanan.jpg','Cataract~Cataract','dokter');
/*!40000 ALTER TABLE `pasien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_user`
--

DROP TABLE IF EXISTS `t_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_user` (
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_user` varchar(10) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_user`
--

LOCK TABLES `t_user` WRITE;
/*!40000 ALTER TABLE `t_user` DISABLE KEYS */;
INSERT INTO `t_user` VALUES ('admin','21232f297a57a5a743894a0e4a801fc3','Administrator','admin'),('dokter','d22af4180eee4bd95072eb90f94930e5','Dokter  Andri','dokter');
/*!40000 ALTER TABLE `t_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-04 20:46:06
