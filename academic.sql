-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2025 at 09:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Truncate table before insert `admin`
--

TRUNCATE TABLE `admin`;
-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

DROP TABLE IF EXISTS `dosen`;
CREATE TABLE IF NOT EXISTS `dosen` (
  `nip` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `bidang_keahlian` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Truncate table before insert `dosen`
--

TRUNCATE TABLE `dosen`;
-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

DROP TABLE IF EXISTS `jadwal`;
CREATE TABLE IF NOT EXISTS `jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `id_kelas` int(11) DEFAULT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat') DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `ruang` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`),
  KEY `id_kelas` (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Truncate table before insert `jadwal`
--

TRUNCATE TABLE `jadwal`;
-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
CREATE TABLE IF NOT EXISTS `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `kode_mk` varchar(10) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `nama_kelas` varchar(20) DEFAULT NULL,
  `tahun_ajaran` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `kode_mk` (`kode_mk`),
  KEY `nip` (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Truncate table before insert `kelas`
--

TRUNCATE TABLE `kelas`;
-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

DROP TABLE IF EXISTS `krs`;
CREATE TABLE IF NOT EXISTS `krs` (
  `id_krs` int(11) NOT NULL AUTO_INCREMENT,
  `npm` varchar(15) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_semester` int(11) DEFAULT NULL,
  `status_verifikasi` enum('Menunggu','Disetujui','Ditolak') NOT NULL,
  PRIMARY KEY (`id_krs`),
  KEY `npm` (`npm`),
  KEY `id_kelas` (`id_kelas`),
  KEY `id_semester` (`id_semester`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Truncate table before insert `krs`
--

TRUNCATE TABLE `krs`;
-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `npm` varchar(15) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `prodi` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`npm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Truncate table before insert `mahasiswa`
--

TRUNCATE TABLE `mahasiswa`;
-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

DROP TABLE IF EXISTS `mata_kuliah`;
CREATE TABLE IF NOT EXISTS `mata_kuliah` (
  `kode_mk` varchar(10) NOT NULL,
  `nama_mk` varchar(100) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode_mk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Truncate table before insert `mata_kuliah`
--

TRUNCATE TABLE `mata_kuliah`;
-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

DROP TABLE IF EXISTS `nilai`;
CREATE TABLE IF NOT EXISTS `nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `id_krs` int(11) DEFAULT NULL,
  `nilai_angka` decimal(5,2) DEFAULT NULL,
  `nilai_huruf` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `id_krs` (`id_krs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Truncate table before insert `nilai`
--

TRUNCATE TABLE `nilai`;
-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

DROP TABLE IF EXISTS `semester`;
CREATE TABLE IF NOT EXISTS `semester` (
  `id_semester` int(11) NOT NULL AUTO_INCREMENT,
  `nama_semester` varchar(20) DEFAULT NULL,
  `aktif` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id_semester`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Truncate table before insert `semester`
--

TRUNCATE TABLE `semester`;
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','mahasiswa','dosen') DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`, `status`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin', 'aktif');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`kode_mk`) REFERENCES `mata_kuliah` (`kode_mk`),
  ADD CONSTRAINT `kelas_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`);

--
-- Constraints for table `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `krs_ibfk_1` FOREIGN KEY (`npm`) REFERENCES `mahasiswa` (`npm`),
  ADD CONSTRAINT `krs_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `krs_ibfk_3` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id_semester`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_krs`) REFERENCES `krs` (`id_krs`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
