-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2025 at 05:49 AM
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

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `bidang_keahlian` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`, `email`, `no_hp`, `bidang_keahlian`) VALUES
('197806112018021006', 'Sigit Priyanto', 'sigit@univ.ac.id', '081234567895', 'Database'),
('19791212 002', 'Dr. Rina Kurniawati', 'rina.kurnia@kampus.ac.id', '082134567892', 'Kecerdasan Buatan'),
('197912292019032001', 'Dr. Lestari Widodo', 'lestari@univ.ac.id', '081234567892', 'Matematika'),
('19800101 001', 'Dr. Budi Santoso', 'budi.santoso@kampus.ac.id', '081234567891', 'Sistem Informasi'),
('19800121 021', 'Dr. Zainuddin Arif', 'zainuddin@kampus.ac.id', '081234567810', 'Sistem Informasi Geografis'),
('19800211 011', 'Dr. Hendra Gunawan', 'hendra@kampus.ac.id', '081234567800', 'Pemrograman Web'),
('19810222 022', 'Sri Wahyuni, M.T.', 'sri@kampus.ac.id', '082234567811', 'Big Data'),
('198202092019031004', 'Dewi Fatmawati', 'dewi@univ.ac.id', '081234567896', 'Sistem Operasi'),
('19820312 012', 'Yuni Handayani, M.Kom', 'yuni@kampus.ac.id', '082234567801', 'Sistem Operasi'),
('19820323 023', 'Agus Salim, M.Kom', 'agus@kampus.ac.id', '083234567812', 'Cloud Computing'),
('19830424 024', 'Yani Oktaviani, M.T.', 'yani@kampus.ac.id', '084234567813', 'Etika Profesi TI'),
('19840513 013', 'Erwin Saputra, M.T.', 'erwin@kampus.ac.id', '083234567802', 'Sistem Tertanam'),
('19840525 025', 'Irwan Hadi, M.Kom', 'irwan@kampus.ac.id', '085234567814', 'E-Government'),
('198411202019021008', 'Bambang Sutrisno', 'bambang@univ.ac.id', '081234567899', 'Keamanan Informasi'),
('19850303 003', 'Andi Prasetyo, M.Kom', 'andi.prasetyo@kampus.ac.id', '083134567893', 'Jaringan Komputer'),
('19850304 009', 'Bambang Sutejo, M.Kom', 'bambang@kampus.ac.id', '089134567899', 'Algoritma dan Pemrograman'),
('198503152020121003', 'M. Ilham Fahreza', 'ilham@univ.ac.id', '081234567893', 'Sistem Informasi'),
('19850626 026', 'Fitria Hidayat, M.T.', 'fitria@kampus.ac.id', '086234567815', 'Sistem Cerdas'),
('19860101 004', 'Siti Aminah, M.T.', 'siti.aminah@kampus.ac.id', '084134567894', 'Basis Data'),
('19860105 010', 'Fitriani, M.T.', 'fitriani@kampus.ac.id', '081934567890', 'Keamanan Siber'),
('19860614 014', 'Diah Puspita, M.Kom', 'diah@kampus.ac.id', '084234567803', 'Pemrosesan Citra'),
('19860727 027', 'Reza Maulana, M.Kom', 'reza@kampus.ac.id', '087234567816', 'Teknik Kompilasi'),
('198610012021041002', 'Indah Permatasari', 'indah@univ.ac.id', '081234567898', 'AI'),
('198701152022011001', 'Dr. Agus Santoso', 'agus@univ.ac.id', '081234567891', 'Pemrograman'),
('198706172020101009', 'Sri Wahyuni', 'sri@univ.ac.id', '081234567800', 'Manajemen TI'),
('19870707 005', 'Dr. Yudi Hartono', 'yudi.hartono@kampus.ac.id', '085134567895', 'Rekayasa Perangkat Lunak'),
('19870715 015', 'Farhan Ramadhan, M.T.', 'farhan@kampus.ac.id', '085234567804', 'Kecerdasan Buatan'),
('19870828 028', 'Novi Rahmawati, M.T.', 'novi@kampus.ac.id', '088234567817', 'Arsitektur Komputer'),
('19880816 016', 'Nina Kartika, M.Kom', 'nina@kampus.ac.id', '086234567805', 'Data Mining'),
('19880929 029', 'Bagus Wicaksono, M.Kom', 'bagus@kampus.ac.id', '089234567818', 'Manajemen Proyek TI'),
('19881108 006', 'Dwi Lestari, M.Kom', 'dwi.lestari@kampus.ac.id', '086134567896', 'Multimedia'),
('198905232021111005', 'Rina Kurniawati', 'rina@univ.ac.id', '081234567894', 'Jaringan'),
('19890917 017', 'Rizki Ananda, M.T.', 'rizki@kampus.ac.id', '087234567806', 'Robotika'),
('19891030 030', 'Tia Marlina, M.T.', 'tia@kampus.ac.id', '081334567819', 'UI/UX Design'),
('19891212 007', 'Ahmad Fauzi, M.T.', 'ahmad.fauzi@kampus.ac.id', '087134567897', 'Data Science'),
('19900101 008', 'Lina Marlina, M.Kom', 'lina.marlina@kampus.ac.id', '088134567898', 'Interaksi Manusia dan Komputer'),
('199003202022011007', 'Hendra Wijaya', 'hendra@univ.ac.id', '081234567897', 'Web Development'),
('19901018 018', 'Putri Ayu, M.Kom', 'putri@kampus.ac.id', '088234567807', 'Pemrograman Mobile'),
('19901201 031', 'Indra Kusuma, M.Kom', 'indra@kampus.ac.id', '082334567820', 'Pengolahan Sinyal Digital'),
('19910102 032', 'Dewi Sartika, M.T.', 'dewi@kampus.ac.id', '083334567821', 'Teknologi Game'),
('19911119 019', 'Fajar Nugroho, M.T.', 'fajar@kampus.ac.id', '089234567808', 'Machine Learning'),
('19920303 033', 'Galih Pratama, M.Kom', 'galih@kampus.ac.id', '084334567822', 'Simulasi dan Pemodelan'),
('19921220 020', 'Mega Lestari, M.Kom', 'mega@kampus.ac.id', '081234567809', 'Business Intelligence'),
('19930404 034', 'Rina Setyawati, M.T.', 'setyawati@kampus.ac.id', '085334567823', 'E-Commerce'),
('19940505 035', 'Rizal Hamdani, M.Kom', 'rizal@kampus.ac.id', '086334567824', 'Manajemen Informasi'),
('19950606 036', 'Sari Widya, M.T.', 'sari@kampus.ac.id', '087334567825', 'Audit Sistem Informasi'),
('19960707 037', 'Yoga Permana, M.Kom', 'yoga@kampus.ac.id', '088334567826', 'Pemrograman Berbasis Objek'),
('19970808 038', 'Elisa Febrianti, M.T.', 'elisa@kampus.ac.id', '089334567827', 'Sistem Pakar'),
('19980909 039', 'Gilang Ramadhan, M.Kom', 'gilang@kampus.ac.id', '081434567828', 'Teknologi Informasi'),
('19991010 040', 'Yuliana Putri, M.T.', 'yuliana@kampus.ac.id', '082434567829', 'Kewirausahaan Teknologi'),
('20000111 041', 'Akbar Fadillah, M.Kom', 'akbar@kampus.ac.id', '083434567830', 'Blockchain'),
('20010212 042', 'Nabila Zahra, M.T.', 'nabila@kampus.ac.id', '084434567831', 'IoT'),
('20020313 043', 'Rafi Saputra, M.Kom', 'rafi@kampus.ac.id', '085434567832', 'Augmented Reality'),
('20030414 044', 'Melati Anggraeni, M.T.', 'melati@kampus.ac.id', '086434567833', 'Computer Vision'),
('20040515 045', 'Arief Munandar, M.Kom', 'arief@kampus.ac.id', '087434567834', 'Cyber Security'),
('20050616 046', 'Citra Dewi, M.T.', 'citra@kampus.ac.id', '088434567835', 'Data Visualization'),
('20060717 047', 'Doni Iskandar, M.Kom', 'doni@kampus.ac.id', '089434567836', 'Data Warehousing'),
('20070818 048', 'Karina Putri, M.T.', 'karina@kampus.ac.id', '081534567837', 'DevOps'),
('20080919 049', 'Vicky Maulana, M.Kom', 'vicky@kampus.ac.id', '082534567838', 'Sistem Terdistribusi'),
('20091020 050', 'Shinta Rahmi, M.T.', 'shinta@kampus.ac.id', '083534567839', 'Information Retrieval');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat') DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `ruang` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_kelas`, `hari`, `jam_mulai`, `jam_selesai`, `ruang`) VALUES
(3, 2, 'Senin', '07:30:00', '09:00:00', '1-1-1'),
(6, 2, 'Selasa', '07:30:00', '09:00:00', '1-1-2'),
(7, 3, 'Selasa', '09:30:00', '12:00:00', '1-1-2'),
(8, 4, 'Rabu', '12:30:00', '14:30:00', '1-2-1'),
(9, 5, 'Rabu', '14:30:00', '16:31:00', '1-2-1'),
(10, 6, 'Kamis', '07:30:00', '09:30:00', '2-1-1'),
(12, 7, 'Kamis', '10:00:00', '12:30:00', '2-1-1'),
(14, 8, 'Jumat', '13:00:00', '14:30:00', '2-2-2'),
(15, 9, 'Jumat', '14:30:00', '16:01:00', '2-2-2'),
(16, 1, 'Senin', '09:30:00', '00:00:00', '1-1-1');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `kode_mk` varchar(10) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `nama_kelas` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kode_mk`, `nip`, `nama_kelas`) VALUES
(1, 'MK101', '198701152022011001', 'TI-1A'),
(2, 'MK102', '197912292019032001', 'TI-1B'),
(3, 'MK103', '198503152020121003', 'SI-1A'),
(4, 'MK104', '198905232021111005', 'SI-1B'),
(5, 'MK105', '197806112018021006', 'TK-1A'),
(6, 'MK106', '198202092019031004', 'TK-1B'),
(7, 'MK107', '199003202022011007', 'MI-1A'),
(8, 'MK108', '198610012021041002', 'MI-1B'),
(9, 'MK109', '198411202019021008', 'TI-1C'),
(10, 'MK110', '198706172020101009', 'SI-1C');

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `id_krs` int(11) NOT NULL,
  `npm` varchar(15) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_semester` int(11) DEFAULT NULL,
  `status_verifikasi` enum('Menunggu','Disetujui','Ditolak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`id_krs`, `npm`, `id_kelas`, `id_semester`, `status_verifikasi`) VALUES
(1, '202301001', 1, 1, 'Disetujui'),
(2, '20230002', 2, 1, 'Menunggu'),
(3, '20230003', 3, 1, 'Disetujui'),
(4, '20230004', 4, 2, 'Menunggu'),
(5, '20230005', 5, 1, 'Menunggu'),
(6, '20230006', 6, 2, 'Menunggu'),
(7, '20230007', 7, 1, 'Menunggu'),
(8, '20230008', 8, 2, 'Menunggu'),
(9, '20230009', 1, 1, 'Menunggu'),
(10, '20230010', 2, 2, 'Menunggu'),
(11, '202301001', 3, 1, 'Menunggu'),
(12, '202301002', 10, 2, 'Menunggu'),
(13, '202301003', 4, 1, 'Menunggu'),
(14, '202301004', 7, 1, 'Menunggu'),
(15, '202301005', 9, 2, 'Menunggu'),
(16, '202301006', 3, 1, 'Menunggu'),
(17, '202301007', 8, 1, 'Menunggu'),
(18, '202301008', 9, 2, 'Menunggu'),
(19, '202301009', 4, 2, 'Menunggu'),
(20, '202301010', 10, 1, 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `npm` varchar(15) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `prodi` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`npm`, `nama`, `tgl_lahir`, `alamat`, `jenis_kelamin`, `prodi`, `foto`) VALUES
('20230001', 'Rizky Pratama', '2003-05-14', 'Jl. Merdeka No. 123, Bandung, Jawa Barat', NULL, 'Teknik Informatika', NULL),
('20230002', 'Dewi Lestari', '2002-08-21', 'Jl. Cempaka No. 9, Depok, Jawa Barat', NULL, 'Sistem Informasi', NULL),
('20230003', 'Ahmad Fauzan', '2004-01-30', 'Jl. Raya Bogor Km. 12, Jakarta Timur', NULL, 'Teknik Komputer', NULL),
('20230004', 'Fitriani Aulia', '2001-11-18', 'Jl. Kemuning No. 45, Surabaya', NULL, 'Teknik Elektro', NULL),
('20230005', 'Muhammad Ilham', '2002-02-10', 'Jl. H. Nawi, Jakarta Selatan', NULL, 'Manajemen Informatika', NULL),
('20230006', 'Lestari Wulandari', '2003-07-07', 'Jl. Ahmad Yani No. 3, Malang', NULL, 'Teknologi Informasi', NULL),
('20230007', 'Dimas Nugroho', '2003-03-25', 'Jl. Siliwangi No. 20, Semarang', NULL, 'Teknik Informatika', NULL),
('20230008', 'Sari Nurul Huda', '2001-09-14', 'Jl. Sudirman No. 80, Yogyakarta', NULL, 'Sistem Informasi', NULL),
('20230009', 'Angga Wijaya', '2002-10-11', 'Jl. Kebon Jeruk Raya, Jakarta Barat', NULL, 'Teknik Komputer', NULL),
('20230010', 'Putri Maharani', '2004-06-03', 'Jl. Diponegoro No. 17, Medan', NULL, 'Teknik Elektro', NULL),
('202301001', 'Fadli Ramadhan', '2003-06-10', 'Jl. Melati No. 5, Bandung, Jawa Barat', NULL, 'Teknik Informatika', NULL),
('202301002', 'Putri Amalia', '2002-09-17', 'Jl. Kenanga No. 3, Depok, Jawa Barat', NULL, 'Sistem Informasi', NULL),
('202301003', 'Muhammad Farhan', '2001-12-25', 'Jl. Merpati No. 8, Jakarta Selatan', NULL, 'Teknik Komputer', NULL),
('202301004', 'Lestari Wulan Sari', '2004-02-14', 'Jl. Pandan No. 45, Semarang', NULL, 'Teknik Elektro', NULL),
('202301005', 'Dwi Putra', '2003-10-01', 'Jl. Mawar No. 10, Surabaya', NULL, 'Manajemen Informatika', NULL),
('202301006', 'Anisa Fadhilah', '2002-08-06', 'Jl. Jambu No. 12, Yogyakarta', NULL, 'Teknologi Informasi', NULL),
('202301007', 'Galih Prasetyo', '2003-03-18', 'Jl. Cendana No. 2, Medan', NULL, 'Teknik Informatika', NULL),
('202301008', 'Nabila Zahra', '2002-04-30', 'Jl. Anggrek No. 7, Bogor', NULL, 'Sistem Informasi', NULL),
('202301009', 'Yusuf Maulana', '2001-11-05', 'Jl. Kamboja No. 9, Palembang', NULL, 'Teknik Komputer', NULL),
('202301010', 'Intan Nuraini', '2003-07-12', 'Jl. Cemara No. 13, Makassar', NULL, 'Teknik Elektro', NULL),
('202301011', 'Ahmad Ridwan', '2002-03-19', 'Jl. Diponegoro No. 23, Malang', NULL, 'Manajemen Informatika', NULL),
('202301012', 'Siti Komariah', '2001-06-08', 'Jl. Pahlawan No. 99, Solo', NULL, 'Teknologi Informasi', NULL),
('202301013', 'Bayu Aditya', '2004-01-05', 'Jl. Perintis Kemerdekaan No. 88, Makassar', NULL, 'Teknik Informatika', NULL),
('202301014', 'Nia Puspitasari', '2002-10-23', 'Jl. Sudirman No. 7, Cirebon', NULL, 'Sistem Informasi', NULL),
('202301015', 'Rama Setiawan', '2003-08-02', 'Jl. Juanda No. 15, Bandung', NULL, 'Teknik Komputer', NULL),
('202301016', 'Rahmawati Zahra', '2001-12-30', 'Jl. Sisingamangaraja No. 20, Medan', NULL, 'Teknik Elektro', NULL),
('202301017', 'Fajar Nugroho', '2003-11-17', 'Jl. Dr. Soetomo No. 9, Surabaya', NULL, 'Manajemen Informatika', NULL),
('202301018', 'Ayu Larasati', '2002-07-14', 'Jl. Gajah Mada No. 55, Yogyakarta', NULL, 'Teknologi Informasi', NULL),
('202301019', 'Reza Kurniawan', '2003-01-28', 'Jl. Teuku Umar No. 31, Bandar Lampung', NULL, 'Teknik Informatika', NULL),
('202301020', 'Maya Kartika', '2002-09-05', 'Jl. Kalimantan No. 77, Pontianak', NULL, 'Sistem Informasi', NULL),
('202301021', 'Irfan Saputra', '2003-05-22', 'Jl. Jenderal Ahmad Yani No. 12, Palembang', NULL, 'Teknik Komputer', NULL),
('202301022', 'Yuliana Ayu', '2004-06-09', 'Jl. S. Parman No. 13, Manado', NULL, 'Teknik Elektro', NULL),
('202301023', 'Teguh Wicaksono', '2002-11-11', 'Jl. Antasari No. 41, Bogor', NULL, 'Manajemen Informatika', NULL),
('202301024', 'Dina Kurniasih', '2001-03-03', 'Jl. Guntur No. 65, Tangerang', NULL, 'Teknologi Informasi', NULL),
('202301025', 'Akbar Fadhil', '2004-04-04', 'Jl. Letjen S. Parman No. 2, Jakarta Barat', NULL, 'Teknik Informatika', NULL),
('202301026', 'Nadia Anjani', '2003-07-30', 'Jl. Kemang Raya No. 90, Jakarta Selatan', NULL, 'Sistem Informasi', NULL),
('202301027', 'Galang Prabowo', '2001-05-15', 'Jl. Salak No. 16, Depok', NULL, 'Teknik Komputer', NULL),
('202301028', 'Nurul Fitriani', '2002-08-26', 'Jl. Belimbing No. 8, Bekasi', NULL, 'Teknik Elektro', NULL),
('202301029', 'Fikri Ramadan', '2003-10-10', 'Jl. Teratai No. 45, Karawang', NULL, 'Manajemen Informatika', NULL),
('202301030', 'Raisa Putri', '2004-12-02', 'Jl. Melur No. 11, Jakarta Pusat', NULL, 'Teknologi Informasi', NULL),
('202301031', 'Doni Saputra', '2002-02-18', 'Jl. Cemara No. 33, Bandung', NULL, 'Teknik Informatika', NULL),
('202301032', 'Karina Maulida', '2003-09-06', 'Jl. Nusa Indah No. 18, Bogor', NULL, 'Sistem Informasi', NULL),
('202301033', 'Rendy Kurniawan', '2001-06-29', 'Jl. Pahlawan No. 3, Semarang', NULL, 'Teknik Komputer', NULL),
('202301034', 'Yuni Lestari', '2002-03-13', 'Jl. Gajah Mada No. 47, Yogyakarta', NULL, 'Teknik Elektro', NULL),
('202301035', 'Ilham Fadillah', '2004-07-21', 'Jl. Diponegoro No. 15, Surakarta', NULL, 'Manajemen Informatika', NULL),
('202301036', 'Salsabila Zahra', '2002-12-15', 'Jl. Merbabu No. 19, Surabaya', NULL, 'Teknologi Informasi', NULL),
('202301037', 'Arif Maulana', '2003-04-04', 'Jl. Panglima Polim No. 10, Jakarta Selatan', NULL, 'Teknik Informatika', NULL),
('202301038', 'Vina Aprilia', '2001-11-01', 'Jl. Riau No. 21, Bandung', NULL, 'Sistem Informasi', NULL),
('202301039', 'Ferry Hidayat', '2002-05-30', 'Jl. Kenanga No. 23, Jakarta Timur', NULL, 'Teknik Komputer', NULL),
('202301040', 'Nadya Hanafiah', '2003-10-27', 'Jl. Melati No. 70, Jakarta Barat', NULL, 'Teknik Elektro', NULL),
('202301041', 'Rehan Prasetya', '2002-01-09', 'Jl. Imam Bonjol No. 34, Bekasi', NULL, 'Manajemen Informatika', NULL),
('202301042', 'Siti Nurhaliza', '2003-08-16', 'Jl. Semangka No. 5, Tangerang Selatan', NULL, 'Teknologi Informasi', NULL),
('202301043', 'Gilang Wicaksono', '2004-02-02', 'Jl. Menteng No. 17, Jakarta Pusat', NULL, 'Teknik Informatika', NULL),
('202301044', 'Aurelia Febriana', '2002-06-11', 'Jl. Slamet Riyadi No. 13, Surakarta', NULL, 'Sistem Informasi', NULL),
('202301045', 'Aldi Gunawan', '2003-12-24', 'Jl. Kartini No. 88, Bogor', NULL, 'Teknik Komputer', NULL),
('202301046', 'Nabila Khairunnisa', '2002-04-20', 'Jl. Kamboja No. 55, Bandung', NULL, 'Teknik Elektro', NULL),
('202301047', 'Rizki Putra', '2001-03-11', 'Jl. Anggrek No. 7, Semarang', NULL, 'Manajemen Informatika', NULL),
('202301048', 'Indah Permatasari', '2003-05-07', 'Jl. Sudirman No. 10, Yogyakarta', NULL, 'Teknologi Informasi', NULL),
('202301049', 'Dwiki Saputra', '2002-09-09', 'Jl. Juanda No. 100, Cirebon', NULL, 'Teknik Informatika', NULL),
('202301050', 'Laras Sari Dewi', '2003-07-05', 'Jl. KH. Hasyim Ashari No. 22, Depok', NULL, 'Sistem Informasi', NULL),
('202301051', 'Fauzan Alfarizi', '2001-11-19', 'Jl. Ahmad Yani No. 67, Jakarta Utara', NULL, 'Teknik Komputer', NULL),
('202301052', 'Mira Apriliani', '2002-10-23', 'Jl. Pemuda No. 9, Surabaya', NULL, 'Teknik Elektro', NULL),
('202301053', 'Riyan Andika', '2004-01-15', 'Jl. Siliwangi No. 2, Tasikmalaya', NULL, 'Manajemen Informatika', NULL),
('202301054', 'Tiara Anjani', '2003-03-03', 'Jl. Veteran No. 88, Serang', NULL, 'Teknologi Informasi', NULL),
('202301055', 'Aditia Pratama', '2002-06-06', 'Jl. Asia Afrika No. 1, Bandung', NULL, 'Teknik Informatika', NULL),
('202301056', 'Suci Marlina', '2001-09-14', 'Jl. Kalimantan No. 33, Malang', NULL, 'Sistem Informasi', NULL),
('202301057', 'Dimas Santoso', '2003-08-27', 'Jl. Jawa No. 90, Pontianak', NULL, 'Teknik Komputer', NULL),
('202301058', 'Intan Ayuningtyas', '2004-05-17', 'Jl. Bali No. 3, Denpasar', NULL, 'Teknik Elektro', NULL),
('202301059', 'Teguh Hidayat', '2002-12-01', 'Jl. Bintaro No. 44, Jakarta Selatan', NULL, 'Manajemen Informatika', NULL),
('202301060', 'Yasmin Salma', '2003-11-13', 'Jl. Kebon Jeruk No. 88, Jakarta Barat', NULL, 'Teknologi Informasi', NULL),
('202301061', 'Hadi Firmansyah', '2001-02-22', 'Jl. Sukarno Hatta No. 2, Palembang', NULL, 'Teknik Informatika', NULL),
('202301062', 'Nia Rahmawati', '2002-10-02', 'Jl. Setiabudi No. 5, Medan', NULL, 'Sistem Informasi', NULL),
('202301063', 'Rahmat Zulkifli', '2003-06-06', 'Jl. Barito No. 13, Jakarta Selatan', NULL, 'Teknik Komputer', NULL),
('202301064', 'Yulia Fitri', '2004-04-26', 'Jl. Mangga Dua No. 99, Jakarta Utara', NULL, 'Teknik Elektro', NULL),
('202301065', 'Ananda Fajar', '2003-07-08', 'Jl. Cempaka Putih No. 7, Jakarta Pusat', NULL, 'Manajemen Informatika', NULL),
('202301066', 'Mega Rahayu', '2002-09-11', 'Jl. Rajawali No. 31, Surabaya', NULL, 'Teknologi Informasi', NULL),
('202301067', 'Herman Prasetyo', '2001-01-01', 'Jl. Cendrawasih No. 88, Makassar', NULL, 'Teknik Informatika', NULL),
('202301068', 'Lina Damayanti', '2003-03-22', 'Jl. Singa No. 33, Yogyakarta', NULL, 'Sistem Informasi', NULL),
('202301069', 'Ardi Wibowo', '2002-07-19', 'Jl. Kelapa No. 20, Banjarmasin', NULL, 'Teknik Komputer', NULL),
('202301070', 'Sarah Maulani', '2001-05-02', 'Jl. Serayu No. 14, Bandung', NULL, 'Teknik Elektro', NULL),
('202301071', 'Eko Nurhadi', '2003-02-14', 'Jl. Gunung Sahari No. 8, Jakarta Pusat', NULL, 'Manajemen Informatika', NULL),
('202301072', 'Nadia Syafira', '2004-09-25', 'Jl. Kapuas No. 4, Samarinda', NULL, 'Teknologi Informasi', NULL),
('202301073', 'Rian Fauzi', '2002-10-31', 'Jl. Seroja No. 15, Pekanbaru', NULL, 'Teknik Informatika', NULL),
('202301074', 'Sheila Ramadhani', '2003-06-12', 'Jl. Kenari No. 19, Solo', NULL, 'Sistem Informasi', NULL),
('202301075', 'Andi Irawan', '2001-12-03', 'Jl. Krakatau No. 77, Makassar', NULL, 'Teknik Komputer', NULL),
('202301076', 'Silvia Melati', '2002-03-06', 'Jl. Gatot Subroto No. 90, Jakarta Selatan', NULL, 'Teknik Elektro', NULL),
('202301077', 'Fikri Anugrah', '2003-10-18', 'Jl. Pemuda No. 24, Padang', NULL, 'Manajemen Informatika', NULL),
('202301078', 'Rosa Febriani', '2004-01-08', 'Jl. Wijaya Kusuma No. 3, Bogor', NULL, 'Teknologi Informasi', NULL),
('202301079', 'Taufik Hidayat', '2002-07-27', 'Jl. Margonda Raya No. 9, Depok', NULL, 'Teknik Informatika', NULL),
('202301080', 'Lia Prameswari', '2001-06-30', 'Jl. Dr. Wahidin No. 22, Semarang', NULL, 'Sistem Informasi', NULL),
('202301081', 'Johan Setiawan', '2003-04-01', 'Jl. Dr. Sutomo No. 19, Medan', NULL, 'Teknik Komputer', NULL),
('202301082', 'Yasmin Fadhilah', '2002-08-24', 'Jl. Simpang Lima No. 11, Semarang', NULL, 'Teknik Elektro', NULL),
('202301083', 'Iqbal Pratama', '2004-03-14', 'Jl. Asia Afrika No. 17, Bandung', NULL, 'Manajemen Informatika', NULL),
('202301084', 'Wulan Sari', '2002-11-07', 'Jl. Taman Mini No. 5, Jakarta Timur', NULL, 'Teknologi Informasi', NULL),
('202301085', 'Danu Kristianto', '2003-09-29', 'Jl. Trunojoyo No. 88, Malang', NULL, 'Teknik Informatika', NULL),
('202301086', 'Citra Ayu Lestari', '2001-07-17', 'Jl. Letjen Soeprapto No. 6, Yogyakarta', NULL, 'Sistem Informasi', NULL),
('202301087', 'Bima Sakti', '2002-12-28', 'Jl. Kapten Muslim No. 20, Medan', NULL, 'Teknik Komputer', NULL),
('202301088', 'Ratna Dewi', '2003-05-10', 'Jl. Pangeran Antasari No. 7, Jakarta Selatan', NULL, 'Teknik Elektro', NULL),
('202301089', 'Akmal Rizki', '2001-04-05', 'Jl. Dipatiukur No. 99, Bandung', NULL, 'Manajemen Informatika', NULL),
('202301090', 'Salsa Nuraini', '2002-09-13', 'Jl. Perintis No. 3, Surabaya', NULL, 'Teknologi Informasi', NULL),
('202301091', 'Bagas Ramadhan', '2003-11-22', 'Jl. Jendral Sudirman No. 1, Bogor', NULL, 'Teknik Informatika', NULL),
('202301092', 'Zahra Kusuma', '2002-02-07', 'Jl. A. Yani No. 42, Palembang', NULL, 'Sistem Informasi', NULL),
('202301093', 'Arman Nugraha', '2004-06-06', 'Jl. Diponegoro No. 23, Medan', NULL, 'Teknik Komputer', NULL),
('202301094', 'Helmi Fauzan', '2003-03-03', 'Jl. Gajah Mada No. 100, Samarinda', NULL, 'Teknik Elektro', NULL),
('202301095', 'Yulia Saraswati', '2002-10-19', 'Jl. Cihampelas No. 2, Bandung', NULL, 'Manajemen Informatika', NULL),
('202301096', 'Rehan Aldiano', '2001-01-12', 'Jl. Soekarno Hatta No. 18, Makassar', NULL, 'Teknologi Informasi', NULL),
('202301097', 'Salsabila Putri', '2003-08-04', 'Jl. Merdeka No. 55, Jakarta Barat', NULL, 'Teknik Informatika', NULL),
('202301098', 'Gerry Fathurrahman', '2002-05-28', 'Jl. Kartini No. 77, Cirebon', NULL, 'Sistem Informasi', NULL),
('202301099', 'Maya Adelia', '2004-04-22', 'Jl. Kembang No. 91, Surabaya', NULL, 'Teknik Komputer', NULL),
('202301100', 'Daffa Hidayatullah', '2001-09-27', 'Jl. Pemuda No. 31, Padang', NULL, 'Teknik Elektro', NULL),
('202301101', 'Yuni Marlina', '2002-04-02', 'Jl. Gajah Mada No. 99, Bandar Lampung', NULL, 'Teknik Informatika', NULL),
('202301102', 'Iqbal Rasyid', '2003-06-24', 'Jl. Merpati No. 13, Bekasi', NULL, 'Sistem Informasi', NULL),
('202301103', 'Dian Pratiwi', '2001-11-12', 'Jl. Kutilang No. 7, Surakarta', NULL, 'Teknik Komputer', NULL),
('202301104', 'Andi Saputra', '2003-02-19', 'Jl. Ahmad Dahlan No. 21, Mataram', NULL, 'Teknik Elektro', NULL),
('202301105', 'Putri Nurfadilah', '2004-03-05', 'Jl. Pangeran Antasari No. 2, Serang', NULL, 'Manajemen Informatika', NULL),
('202301106', 'Bagus Permadi', '2002-08-09', 'Jl. Tanjung Duren No. 99, Jakarta Barat', NULL, 'Teknologi Informasi', NULL),
('202301107', 'Melly Kurniawati', '2001-10-17', 'Jl. Seroja No. 10, Makassar', NULL, 'Teknik Informatika', NULL),
('202301108', 'Hendra Wibowo', '2002-07-25', 'Jl. Irian No. 15, Balikpapan', NULL, 'Sistem Informasi', NULL),
('202301109', 'Alya Fadilah', '2003-09-30', 'Jl. Sisingamangaraja No. 22, Medan', NULL, 'Teknik Komputer', NULL),
('202301110', 'Rizky Wahyudi', '2002-01-14', 'Jl. Veteran No. 1, Palembang', NULL, 'Teknik Elektro', NULL),
('202301111', 'Siti Andini', '2003-05-27', 'Jl. Kebon Jeruk No. 33, Jakarta Barat', NULL, 'Manajemen Informatika', NULL),
('202301112', 'Angga Firdaus', '2002-12-04', 'Jl. Imam Bonjol No. 7, Bogor', NULL, 'Teknologi Informasi', NULL),
('202301113', 'Lina Ayuningrum', '2003-11-16', 'Jl. Merdeka No. 55, Padang', NULL, 'Teknik Informatika', NULL),
('202301114', 'Fadli Ramadhan', '2002-03-02', 'Jl. Melati No. 5, Bandung', NULL, 'Sistem Informasi', NULL),
('202301115', 'Dewi Lestari', '2001-06-18', 'Jl. Cempaka No. 9, Depok', NULL, 'Teknik Komputer', NULL),
('202301116', 'Ahmad Fauzan', '2003-09-09', 'Jl. Raya Bogor Km. 12, Jakarta Timur', NULL, 'Teknik Elektro', NULL),
('202301117', 'Fitriani Aulia', '2004-01-25', 'Jl. Kemuning No. 45, Surabaya', NULL, 'Manajemen Informatika', NULL),
('202301118', 'Muhammad Ilham', '2002-08-03', 'Jl. H. Nawi, Jakarta Selatan', NULL, 'Teknologi Informasi', NULL),
('202301119', 'Lestari Wulandari', '2003-07-15', 'Jl. Ahmad Yani No. 3, Malang', NULL, 'Teknik Informatika', NULL),
('202301120', 'Dimas Nugroho', '2003-03-22', 'Jl. Siliwangi No. 20, Semarang', NULL, 'Sistem Informasi', NULL),
('202301121', 'Sari Nurul Huda', '2001-09-14', 'Jl. Sudirman No. 80, Yogyakarta', NULL, 'Teknik Komputer', NULL),
('202301122', 'Angga Wijaya', '2002-10-11', 'Jl. Kebon Jeruk Raya, Jakarta Barat', NULL, 'Teknik Elektro', NULL),
('202301123', 'Putri Maharani', '2004-06-03', 'Jl. Diponegoro No. 17, Medan', NULL, 'Manajemen Informatika', NULL),
('202301124', 'Rendy Pratama', '2002-07-28', 'Jl. Kartini No. 21, Bandung', NULL, 'Teknologi Informasi', NULL),
('202301125', 'Anisa Nurhaliza', '2003-05-18', 'Jl. Dipatiukur No. 45, Bandung', NULL, 'Teknik Informatika', NULL),
('202301126', 'Ilham Saputra', '2002-02-13', 'Jl. Suryakencana No. 8, Bogor', NULL, 'Sistem Informasi', NULL),
('202301127', 'Winda Oktaviani', '2003-10-10', 'Jl. R.E. Martadinata No. 9, Cimahi', NULL, 'Teknik Komputer', NULL),
('202301128', 'Zulfan Akbar', '2001-12-19', 'Jl. Kebon Kopi No. 12, Bandung', NULL, 'Teknik Elektro', NULL),
('202301129', 'Mega Ayu Lestari', '2002-08-08', 'Jl. Terusan Jakarta No. 18, Bandung', NULL, 'Manajemen Informatika', NULL),
('202301130', 'Rafi Maulana', '2003-04-06', 'Jl. Sancang No. 7, Bandung', NULL, 'Teknologi Informasi', NULL),
('202301131', 'Fajar Hidayat', '2002-06-11', 'Jl. Merpati No. 21, Bandung', NULL, 'Teknik Informatika', NULL),
('202301132', 'Nadia Az Zahra', '2003-01-03', 'Jl. Kamboja No. 10, Depok', NULL, 'Sistem Informasi', NULL),
('202301133', 'Rehan Alamsyah', '2004-02-25', 'Jl. Salak No. 18, Tangerang', NULL, 'Teknik Komputer', NULL),
('202301134', 'Maya Oktavia', '2001-11-15', 'Jl. Garuda No. 45, Bogor', NULL, 'Teknik Elektro', NULL),
('202301135', 'Dwiki Ramadhan', '2002-10-10', 'Jl. Guntur No. 5, Bekasi', NULL, 'Manajemen Informatika', NULL),
('202301136', 'Intan Sari Dewi', '2003-08-06', 'Jl. Kalimantan No. 8, Jakarta Timur', NULL, 'Teknologi Informasi', NULL),
('202301137', 'Agus Pratama', '2002-12-21', 'Jl. Mangga No. 22, Bandung', NULL, 'Teknik Informatika', NULL),
('202301138', 'Salsabila Indriani', '2001-05-17', 'Jl. Mawar No. 4, Cimahi', NULL, 'Sistem Informasi', NULL),
('202301139', 'Yusuf Ardiansyah', '2004-03-14', 'Jl. Kenari No. 33, Bogor', NULL, 'Teknik Komputer', NULL),
('202301140', 'Ayu Wulandari', '2002-09-09', 'Jl. Sukajadi No. 77, Bandung', NULL, 'Teknik Elektro', NULL),
('202301141', 'Taufik Nurhadi', '2003-04-04', 'Jl. Peta No. 90, Bandung', NULL, 'Manajemen Informatika', NULL),
('202301142', 'Nisa Fadhilah', '2002-06-30', 'Jl. Cibaduyut No. 23, Bandung', NULL, 'Teknologi Informasi', NULL),
('202301143', 'Rama Dwi Nugroho', '2001-07-28', 'Jl. Ciumbuleuit No. 11, Bandung', NULL, 'Teknik Informatika', NULL),
('202301144', 'Annisa Putri', '2003-05-09', 'Jl. Pasteur No. 13, Bandung', NULL, 'Sistem Informasi', NULL),
('202301145', 'Galih Saputra', '2002-02-03', 'Jl. Surapati No. 17, Bandung', NULL, 'Teknik Komputer', NULL),
('202301146', 'Tiara Nuraini', '2004-01-26', 'Jl. Dago No. 20, Bandung', NULL, 'Teknik Elektro', NULL),
('202301147', 'Bagas Permana', '2001-10-18', 'Jl. Gegerkalong No. 15, Bandung', NULL, 'Manajemen Informatika', NULL),
('202301148', 'Dina Aprilia', '2003-07-13', 'Jl. Buah Batu No. 25, Bandung', NULL, 'Teknologi Informasi', NULL),
('202301149', 'Akmal Ridho', '2002-09-16', 'Jl. Bojongsoang No. 33, Bandung', NULL, 'Teknik Informatika', NULL),
('202301150', 'Fitria Salsabila', '2001-06-04', 'Jl. Cijerah No. 8, Bandung', NULL, 'Sistem Informasi', NULL),
('202301151', 'Wahyu Hidayat', '2002-08-29', 'Jl. Soreang No. 17, Bandung', NULL, 'Teknik Komputer', NULL),
('202301152', 'Nabila Dwi Putri', '2003-11-05', 'Jl. Cileunyi No. 14, Bandung', NULL, 'Teknik Elektro', NULL),
('202301153', 'Reza Maulana', '2004-04-22', 'Jl. Rancaekek No. 90, Bandung', NULL, 'Manajemen Informatika', NULL),
('202301154', 'Cindy Oktaviani', '2002-05-27', 'Jl. Katapang No. 12, Bandung', NULL, 'Teknologi Informasi', NULL),
('202301155', 'Bayu Kristanto', '2003-09-08', 'Jl. Ciparay No. 77, Bandung', NULL, 'Teknik Informatika', NULL),
('202301156', 'Aulia Rizky', '2001-12-11', 'Jl. Ujungberung No. 65, Bandung', NULL, 'Sistem Informasi', NULL),
('202301157', 'Aditya Rahman', '2002-07-01', 'Jl. Antapani No. 18, Bandung', NULL, 'Teknik Komputer', NULL),
('202301158', 'Yuliana Kartika', '2003-02-17', 'Jl. Arcamanik No. 40, Bandung', NULL, 'Teknik Elektro', NULL),
('202301159', 'Gilang Fadillah', '2002-10-26', 'Jl. Kopo No. 11, Bandung', NULL, 'Manajemen Informatika', NULL),
('202301160', 'Putri Larasati', '2004-03-11', 'Jl. Cibiru No. 22, Bandung', NULL, 'Teknologi Informasi', NULL),
('202301161', 'Fikri Ramadhan', '2003-05-22', 'Jl. Dayeuhkolot No. 9, Bandung', NULL, 'Teknik Informatika', NULL),
('202301162', 'Sinta Ayu', '2002-11-07', 'Jl. Suci No. 77, Bandung', NULL, 'Sistem Informasi', NULL),
('202301163', 'Hendra Satria', '2001-08-14', 'Jl. Sukamulya No. 5, Bandung', NULL, 'Teknik Komputer', NULL),
('202301164', 'Maya Khairunnisa', '2003-06-16', 'Jl. Cisaranten No. 3, Bandung', NULL, 'Teknik Elektro', NULL),
('202301165', 'Ali Rizal', '2002-04-01', 'Jl. Kiaracondong No. 2, Bandung', NULL, 'Manajemen Informatika', NULL),
('202301166', 'Salsabila Nur', '2003-09-21', 'Jl. Cikudapateuh No. 1, Bandung', NULL, 'Teknologi Informasi', NULL),
('202301167', 'Yusuf Hidayat', '2002-01-10', 'Jl. Cigondewah No. 20, Bandung', NULL, 'Teknik Informatika', NULL),
('202301168', 'Nina Rahmawati', '2004-02-08', 'Jl. Pagarsih No. 7, Bandung', NULL, 'Sistem Informasi', NULL),
('202301169', 'Zaki Akbar', '2003-07-25', 'Jl. Astana Anyar No. 15, Bandung', NULL, 'Teknik Komputer', NULL),
('202301170', 'Rani Dwi Lestari', '2002-10-15', 'Jl. Karapitan No. 12, Bandung', NULL, 'Teknik Elektro', NULL),
('202301171', 'Ahmad Zulfikar', '2001-05-05', 'Jl. Pelajar Pejuang No. 99, Bandung', NULL, 'Manajemen Informatika', NULL),
('202301172', 'Citra Wulandari', '2002-09-01', 'Jl. Jatihandap No. 4, Bandung', NULL, 'Teknologi Informasi', NULL),
('202301173', 'Rizky Fauzan', '2003-11-14', 'Jl. Babakan Sari No. 27, Bandung', NULL, 'Teknik Informatika', NULL),
('202301174', 'Lutfia Rahmi', '2001-07-06', 'Jl. Cigending No. 44, Bandung', NULL, 'Sistem Informasi', NULL),
('202301175', 'Andika Wijaya', '2002-03-20', 'Jl. Cibogo No. 8, Bandung', NULL, 'Teknik Komputer', NULL),
('202301176', 'Nanda Setiawan', '2004-01-31', 'Jl. Pasteur No. 70, Bandung', NULL, 'Teknik Elektro', NULL),
('202301177', 'Vania Mutiara', '2002-06-07', 'Jl. Cihampelas No. 24, Bandung', NULL, 'Manajemen Informatika', NULL),
('202301178', 'Ikhsan Maulana', '2003-08-18', 'Jl. Sersan Bajuri No. 5, Bandung', NULL, 'Teknologi Informasi', NULL),
('202301179', 'Aulia Khairani', '2002-12-12', 'Jl. Cikutra No. 55, Bandung', NULL, 'Teknik Informatika', NULL),
('202301180', 'Hana Salsabila', '2003-03-08', 'Jl. Palasari No. 10, Bandung', NULL, 'Sistem Informasi', NULL),
('202301181', 'Yudha Permadi', '2001-11-20', 'Jl. Sumbawa No. 11, Bandung', NULL, 'Teknik Komputer', NULL),
('202301182', 'Nadya Zahra', '2002-02-27', 'Jl. Sukabumi No. 6, Bandung', NULL, 'Teknik Elektro', NULL),
('202301183', 'Rifki Ardiansyah', '2004-04-19', 'Jl. Talaga Bodas No. 1, Bandung', NULL, 'Manajemen Informatika', NULL),
('202301184', 'Rina Marlina', '2003-06-29', 'Jl. Paledang No. 17, Bandung', NULL, 'Teknologi Informasi', NULL),
('202301185', 'Agung Prasetyo', '2002-09-13', 'Jl. Buah Batu No. 3, Bandung', NULL, 'Teknik Informatika', NULL),
('202301186', 'Desi Lestari', '2001-10-26', 'Jl. Ciateul No. 2, Bandung', NULL, 'Sistem Informasi', NULL),
('202301187', 'Farhan Ahmad', '2003-05-25', 'Jl. Taman Sari No. 66, Bandung', NULL, 'Teknik Komputer', NULL),
('202301188', 'Aurel Safira', '2002-08-23', 'Jl. Cijerah No. 5, Bandung', NULL, 'Teknik Elektro', NULL),
('202301189', 'Hadi Nurjaman', '2003-11-03', 'Jl. Buah Batu No. 100, Bandung', NULL, 'Manajemen Informatika', NULL),
('202301190', 'Melati Aulia', '2002-07-11', 'Jl. Lingkar Selatan No. 21, Bandung', NULL, 'Teknologi Informasi', NULL),
('202301191', 'Dito Wahyudi', '2003-01-29', 'Jl. Margacinta No. 9, Bandung', NULL, 'Teknik Informatika', NULL),
('202301192', 'Selvi Rahmayani', '2004-02-15', 'Jl. Moch. Toha No. 6, Bandung', NULL, 'Sistem Informasi', NULL),
('202301193', 'Rizal Yulianto', '2001-09-23', 'Jl. Jakarta No. 13, Bandung', NULL, 'Teknik Komputer', NULL),
('202301194', 'Suci Ramadhani', '2002-04-28', 'Jl. Pelajar Pejuang No. 14, Bandung', NULL, 'Teknik Elektro', NULL),
('202301195', 'Fakhri Zain', '2003-12-24', 'Jl. Cikutra No. 77, Bandung', NULL, 'Manajemen Informatika', NULL),
('202301196', 'Dewi Kurniasih', '2002-05-13', 'Jl. Soekarno Hatta No. 3, Bandung', NULL, 'Teknologi Informasi', NULL),
('202301197', 'Bagus Santosa', '2001-03-30', 'Jl. Gunung Batu No. 1, Bandung', NULL, 'Teknik Informatika', NULL),
('202301198', 'Amira Rahmi', '2003-09-07', 'Jl. Pasteur No. 2, Bandung', NULL, 'Sistem Informasi', NULL),
('202301199', 'Yoga Pratama', '2002-01-19', 'Jl. Braga No. 12, Bandung', NULL, 'Teknik Komputer', NULL),
('202301200', 'Laras Anindita', '2004-06-26', 'Jl. Naripan No. 33, Bandung', NULL, 'Teknik Elektro', NULL),
('2716', 'naufal', '2004-09-05', 'depok', NULL, 'teknik informatika', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `kode_mk` varchar(10) NOT NULL,
  `nama_mk` varchar(100) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`kode_mk`, `nama_mk`, `sks`, `semester`) VALUES
('MK101', 'Pemrograman Dasar', 3, 1),
('MK102', 'Matematika Diskrit', 3, 1),
('MK103', 'Pengantar Teknologi Informasi', 2, 1),
('MK104', 'Algoritma dan Struktur Data', 3, 2),
('MK105', 'Basis Data', 3, 2),
('MK106', 'Sistem Operasi', 3, 3),
('MK107', 'Jaringan Komputer', 3, 3),
('MK108', 'Pemrograman Web', 3, 4),
('MK109', 'Analisis dan Perancangan Sistem', 3, 4),
('MK110', 'Kecerdasan Buatan', 3, 5),
('MK111', 'Pemrograman Mobile', 3, 5),
('MK112', 'Manajemen Proyek TI', 2, 6),
('MK113', 'Keamanan Sistem Informasi', 2, 6),
('MK114', 'Etika Profesi TI', 2, 7),
('MK115', 'Data Mining', 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_krs` int(11) DEFAULT NULL,
  `nilai_angka` decimal(5,2) DEFAULT NULL,
  `nilai_huruf` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id_semester` int(11) NOT NULL,
  `nama_semester` varchar(20) DEFAULT NULL,
  `tahun_ajaran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id_semester`, `nama_semester`, `tahun_ajaran`) VALUES
(1, 'Ganjil', '2024/2025'),
(2, 'Genap', '2024/2025');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','mahasiswa','dosen') DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`, `status`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin', 'aktif'),
(3, 'val', 'c481188f5d6327f12921e8d506cacc6f', 'admin', 'nonaktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `kode_mk` (`kode_mk`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id_krs`),
  ADD KEY `npm` (`npm`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_semester` (`id_semester`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`npm`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`kode_mk`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_krs` (`id_krs`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `id_krs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
