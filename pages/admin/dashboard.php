<?php
session_start();
include '../../includes/koneksi.php';

// Jika belum login, arahkan ke login
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

// Statistik (jumlah data)
$jml_mhs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM mahasiswa"))['total'];
$jml_dosen = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM dosen"))['total'];
$jml_kelas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM kelas"))['total'];
$jml_mk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM mata_kuliah"))['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Akademik</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>
<body>
<header>
    <h1>Dashboard Administrator</h1>
    <nav>
        <a href="../../auth/logout.php">Logout</a>
    </nav>
</header>
<div class="main-wrapper">
  <aside class="sidebar-menu">

    <!-- Manajemen Akademik -->
    <li class="dropdown" onclick="toggleDropdown(this)">
        <span>Manajemen Akademik</span>
        <span class="arrow">&#9654;</span>
        <ul class="submenu">
            <li><a href="krs.php">Verifikasi KRS Mahasiswa</a></li>
            <li><a href="nilai.php">Monitoring Nilai</a></li>
            <li><a href="jadwal.php">Monitoring Jadwal Kuliah</a></li>
            <li><a href="users.php">Manajemen User</a></li>
        </ul>
    </li>

    <!-- Laporan & Statistik -->
    <li class="dropdown" onclick="toggleDropdown(this)">
        <span>Laporan & Statistik</span>
        <span class="arrow">&#9654;</span>
        <ul class="submenu">
            <li><a href="#">Jumlah Mahasiswa per Prodi</a></li>
            <li><a href="#">Statistik SKS yang Diambil</a></li>
            <li><a href="#">Cetak Rekap Nilai & KHS</a></li>
        </ul>
    </li>

    <!-- Pengaturan Sistem -->
    <li class="dropdown" onclick="toggleDropdown(this)">
        <span>Pengaturan Sistem</span>
        <span class="arrow">&#9654;</span>
        <ul class="submenu">
            <li><a href="#">Ganti Tahun Ajaran</a></li>
            <li><a href="#">Pengaturan Role & Reset Password</a></li>
        </ul>
    </li>
    </aside>





    <main class="content">
        <h2>Statistik Akademik</h2>
        <div class="stats">
            <div class="card">
                <h3>Mahasiswa</h3>
                <p><?= $jml_mhs ?> orang</p>
            </div>
            <div class="card">
                <h3>Dosen</h3>
                <p><?= $jml_dosen ?> orang</p>
            </div>
            <div class="card">
                <h3>Kelas</h3>
                <p><?= $jml_kelas ?> kelas</p>
            </div>
            <div class="card">
                <h3>Mata Kuliah</h3>
                <p><?= $jml_mk ?> matkul</p>
            </div>
        </div>
    </main>
</div>
<script>
function toggleDropdown(el) {
    const submenu = el.querySelector(".submenu");
    const arrow = el.querySelector(".arrow");

    const isOpen = submenu.style.display === "block";
    submenu.style.display = isOpen ? "none" : "block";
    arrow.innerHTML = isOpen ? "&#9654;" : "&#9660;"; // ▶ ▼
}
</script>


</body>
</html>
