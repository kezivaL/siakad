<?php
session_start();
include '../../includes/koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

// Simpan data tahun aktif
if (isset($_POST['simpan'])) {
    $id_semester = $_POST['id_semester'];

    // Reset semua semester tidak aktif
    mysqli_query($conn, "UPDATE semester SET aktif = 0");

    // Aktifkan semester terpilih
    $stmt = mysqli_prepare($conn, "UPDATE semester SET aktif = 1 WHERE id_semester = ?");
    mysqli_stmt_bind_param($stmt, "i", $id_semester);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: tahun.php");
    exit;
}

// Ambil semua semester
$semester = mysqli_query($conn, "SELECT * FROM semester ORDER BY tahun_ajaran DESC, nama_semester DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ganti Tahun Ajaran</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/tahun.css">
</head>
<body>
<header class="sticky-header">
    <h1>Dashboard Administrator</h1>
    <nav><a href="../../auth/logout.php">Logout</a></nav>
</header>

<div class="main-wrapper">
    <aside class="sidebar sticky-sidebar">
        <ul class="sidebar-menu">
            <div class="menu-item">
                <li class="dashboard"><a href="dashboard.php">Dashboard</a></li>
            </div>
            <li class="dropdown" onclick="toggleDropdown(this)">
                <div class="menu-item">
                    <span>Data Master</span> <span class="arrow">&#9654;</span>
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
                    <li><a href="krs.php">Verifikasi KRS Mahasiswa</a></li>
                    <li><a href="jadwal.php">Monitoring Jadwal Kuliah</a></li>
                    <li><a href="users.php">Manajemen User</a></li>
                </ul>
            </li>

            <li class="dropdown" onclick="toggleDropdown(this)">
                <div class="menu-item">
                    <span>Laporan & Statistik</span> <span class="arrow">&#9654;</span>
                </div>
                <ul class="submenu">
                    <li><a href="jumlah.php">Jumlah Mahasiswa per Prodi</a></li>
                    <li><a href="sks.php">Statistik SKS</a></li>
                </ul>
            </li>

            <li class="dropdown" onclick="toggleDropdown(this)">
                <div class="menu-item">
                    <span>Pengaturan Sistem</span> <span class="arrow">&#9654;</span>
                </div>
                <ul class="submenu">
                    <li><a href="tahun.php">Ganti Tahun Ajaran</a></li>
                    <li><a href="reset.php">Reset Password</a></li>
                </ul>
            </li>
        </ul>
    </aside>

    <main class="content">
        <div class="container">
            <h2>Ganti Tahun Ajaran Aktif</h2>
            <form method="POST" action="">
                <label for="id_semester">Pilih Tahun Ajaran dan Semester:</label>
                <select name="id_semester" id="id_semester" required>
                    <option value="">-- Pilih --</option>
                    <?php while ($s = mysqli_fetch_assoc($semester)) {
                        $aktif = $s['aktif'] == 1 ? ' (Aktif)' : '';
                        echo "<option value='{$s['id_semester']}'>{$s['tahun_ajaran']} - Semester {$s['nama_semester']}{$aktif}</option>";
                    } ?>
                </select>
                <button type="submit" name="simpan">Simpan</button>
            </form>
        </div>
    </main>
</div>

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
