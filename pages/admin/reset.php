<?php
session_start();
include '../../includes/koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

$menuAktif = 'reset';

$result = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password User</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/reset.css">
</head>
<body>

<header class="sticky-header">
    <h1>Dashboard Administrator</h1>
    <nav><a href="../../auth/logout.php">Logout</a></nav>
</header>

<div class="main-wrapper">
    <aside class="sidebar sticky-sidebar">
        <ul class="sidebar-menu">
            <li class="dashboard"><a href="dashboard.php">Dashboard</a></li>

            <li class="dropdown <?= in_array($menuAktif, ['mahasiswa','dosen','matakuliah','kelas']) ? 'open' : '' ?>">
                <div class="menu-item" onclick="toggleDropdown(this)">
                    <span>Data Master</span>
                    <span class="arrow"><?= in_array($menuAktif, ['mahasiswa','dosen','matakuliah','kelas']) ? '&#9660;' : '&#9654;' ?></span>
                </div>
                <ul class="submenu" style="display: <?= in_array($menuAktif, ['mahasiswa','dosen','matakuliah','kelas']) ? 'block' : 'none' ?>">
                    <li><a href="mahasiswa.php">Data Mahasiswa</a></li>
                    <li><a href="dosen.php">Data Dosen</a></li>
                    <li><a href="matakuliah.php">Data Mata Kuliah</a></li>
                    <li><a href="kelas.php">Data Kelas</a></li>
                </ul>
            </li>

            <li class="dropdown <?= in_array($menuAktif, ['krs','jadwal','users']) ? 'open' : '' ?>">
                <div class="menu-item" onclick="toggleDropdown(this)">
                    <span>Manajemen Akademik</span>
                    <span class="arrow"><?= in_array($menuAktif, ['krs','jadwal','users']) ? '&#9660;' : '&#9654;' ?></span>
                </div>
                <ul class="submenu" style="display: <?= in_array($menuAktif, ['krs','jadwal','users']) ? 'block' : 'none' ?>">
                    <li><a href="krs.php">Verifikasi KRS</a></li>
                    <li><a href="jadwal.php">Monitoring Jadwal</a></li>
                    <li><a href="users.php">Manajemen User</a></li>
                </ul>
            </li>

            <li class="dropdown <?= in_array($menuAktif, ['jumlah','sks']) ? 'open' : '' ?>">
                <div class="menu-item" onclick="toggleDropdown(this)">
                    <span>Laporan & Statistik</span>
                    <span class="arrow"><?= in_array($menuAktif, ['jumlah','sks']) ? '&#9660;' : '&#9654;' ?></span>
                </div>
                <ul class="submenu" style="display: <?= in_array($menuAktif, ['jumlah','sks']) ? 'block' : 'none' ?>">
                    <li><a href="jumlah.php">Jumlah Mahasiswa per Prodi</a></li>
                    <li><a href="sks.php">Statistik SKS</a></li>
                </ul>
            </li>

            <li class="dropdown <?= in_array($menuAktif, ['tahun','reset']) ? 'open' : '' ?>">
                <div class="menu-item" onclick="toggleDropdown(this)">
                    <span>Pengaturan Sistem</span>
                    <span class="arrow"><?= in_array($menuAktif, ['tahun','reset']) ? '&#9660;' : '&#9654;' ?></span>
                </div>
                <ul class="submenu" style="display: <?= in_array($menuAktif, ['tahun','reset']) ? 'block' : 'none' ?>">
                    <li><a href="tahun.php">Ganti Tahun Ajaran</a></li>
                    <li><a href="reset.php" class="<?= $menuAktif == 'reset' ? 'active' : '' ?>">Reset Password</a></li>
                </ul>
            </li>
        </ul>
    </aside>

    <main class="content">
        <div class="container">
            <h2>Reset Password Pengguna</h2>

            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <div class="alert-success">✅ Password berhasil direset ke default (username).</div>
            <?php endif; ?>

            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td>
                                <form method="POST" action="proses_reset.php" onsubmit="return confirm('Reset password untuk <?= $user['username'] ?>?')">
                                    <input type="hidden" name="id" value="<?= $user['id_user'] ?>">
                                    <button type="submit" class="btn-reset">Reset Password</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
function toggleDropdown(el) {
    const submenu = el.querySelector('.submenu');
    const arrow = el.querySelector('.arrow');
    const isOpen = submenu.style.display === 'block';
    submenu.style.display = isOpen ? 'none' : 'block';
    arrow.innerHTML = isOpen ? '&#9654;' : '&#9660;';
}
</script>
</body>
</html>
