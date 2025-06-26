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
    <title>Dashboard - Sistem Akademik</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>
<body>
    <header class="sticky-header">
        <h1>Dashboard Administrator</h1>
        <nav>
            <a href="../../auth/logout.php">Logout</a>
        </nav>
    </header>

    <div class="main-wrapper">
        <aside class="sidebar sticky-sidebar">
            <ul class="sidebar-menu">
                <li class="dropdown" onclick="toggleDropdown(this)">
                    <div class="menu-item">
                        <span>Data Master</span>
                        <span class="arrow">&#9654;</span>
                    </div>
                    <ul class="submenu">
                        <li><a href="mahasiswa.php">Data Mahasiswa</a></li>
                        <li><a href="dosen.php">Data Dosen</a></li>
                        <li><a href="matakuliah.php">Data Mata Kuliah</a></li>
                        <li><a href="kelas.php">Data Kelas</a></li>
                    </ul>
                </li>

                <li class="dropdown" onclick="toggleDropdown(this)">
                    <div class="menu-item">
                        <span>Manajemen Akademik</span>
                        <span class="arrow">&#9654;</span>
                    </div>
                    <ul class="submenu">
                        <li><a href="krs.php">Verifikasi KRS</a></li>
                        <li><a href="jadwal.php">Monitoring Jadwal</a></li>
                        <li><a href="users.php">Manajemen User</a></li>
                    </ul>
                </li>

                <li class="dropdown" onclick="toggleDropdown(this)">
                    <div class="menu-item">
                        <span>Laporan & Statistik</span>
                        <span class="arrow">&#9654;</span>
                    </div>
                    <ul class="submenu">
                        <li><a href="jumlah.php">Jumlah Mahasiswa per Prodi</a></li>
                        <li><a href="sks.php">Statistik SKS</a></li>
                    </ul>
                </li>

                <li class="dropdown" onclick="toggleDropdown(this)">
                    <div class="menu-item">
                        <span>Pengaturan Sistem</span>
                        <span class="arrow">&#9654;</span>
                    </div>
                    <ul class="submenu">
                        <li><a href="tahun.php">Ganti Tahun Ajaran</a></li>
                        <li><a href="reset.php">Reset Password</a></li>
                    </ul>
                </li>
            </ul>
        </aside>

        <main class="content">
    <h2>Statistik Akademik</h2>
    <div class="stats">
        <div class="card">
            <img src="../../assets/foto/mahasiswa.jpg" class="card-icon" alt="Mahasiswa">
            <h3>Mahasiswa</h3>
            <p><?= $jml_mhs ?> orang</p>
        </div>
        <div class="card">
            <img src="../../assets/foto/dosen.jpg" class="card-icon" alt="Dosen">
            <h3>Dosen</h3>
            <p><?= $jml_dosen ?> orang</p>
        </div>
        <div class="card">
            <img src="../../assets/foto/kelas.jpg" class="card-icon" alt="Kelas">
            <h3>Kelas</h3>
            <p><?= $jml_kelas ?> kelas</p>
        </div>
        <div class="card">
            <img src="../../assets/foto/matakuliah.jpg" class="card-icon" alt="Mata Kuliah">
            <h3>Mata Kuliah</h3>
            <p><?= $jml_mk ?> matkul</p>
        </div>
    </div>
</main>

    <script>
        function toggleDropdown(el) {
            const submenu = el.querySelector(".submenu");
            const arrow = el.querySelector(".arrow");

            const isOpen = submenu.style.display === "block";
            submenu.style.display = isOpen ? "none" : "block";
            arrow.innerHTML = isOpen ? "&#9654;" : "&#9660;";
        }
    </script>
</body>
</html>
