<?php
session_start();
include '../../includes/koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

$menuAktif = 'sks';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Statistik SKS Mahasiswa</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/sks.css">
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
                    <li><a href="mahasiswa.php" class="<?= $menuAktif == 'mahasiswa' ? 'active' : '' ?>">Data Mahasiswa</a></li>
                    <li><a href="dosen.php" class="<?= $menuAktif == 'dosen' ? 'active' : '' ?>">Data Dosen</a></li>
                    <li><a href="matakuliah.php" class="<?= $menuAktif == 'matakuliah' ? 'active' : '' ?>">Data Mata Kuliah</a></li>
                    <li><a href="kelas.php" class="<?= $menuAktif == 'kelas' ? 'active' : '' ?>">Data Kelas</a></li>
                </ul>
            </li>

            <li class="dropdown <?= in_array($menuAktif, ['krs','jadwal','users']) ? 'open' : '' ?>">
                <div class="menu-item" onclick="toggleDropdown(this)">
                    <span>Manajemen Akademik</span>
                    <span class="arrow"><?= in_array($menuAktif, ['krs','jadwal','users']) ? '&#9660;' : '&#9654;' ?></span>
                </div>
                <ul class="submenu" style="display: <?= in_array($menuAktif, ['krs','jadwal','users']) ? 'block' : 'none' ?>">
                    <li><a href="krs.php" class="<?= $menuAktif == 'krs' ? 'active' : '' ?>">Verifikasi KRS Mahasiswa</a></li>
                    <li><a href="jadwal.php" class="<?= $menuAktif == 'jadwal' ? 'active' : '' ?>">Monitoring Jadwal Kuliah</a></li>
                    <li><a href="users.php" class="<?= $menuAktif == 'users' ? 'active' : '' ?>">Manajemen User</a></li>
                </ul>
            </li>

            <li class="dropdown <?= in_array($menuAktif, ['jumlah','sks']) ? 'open' : '' ?>">
                <div class="menu-item" onclick="toggleDropdown(this)">
                    <span>Laporan & Statistik</span>
                    <span class="arrow"><?= in_array($menuAktif, ['jumlah','sks']) ? '&#9660;' : '&#9654;' ?></span>
                </div>
                <ul class="submenu" style="display: <?= in_array($menuAktif, ['jumlah','sks']) ? 'block' : 'none' ?>">
                    <li><a href="jumlah.php" class="<?= $menuAktif == 'jumlah' ? 'active' : '' ?>">Jumlah Mahasiswa per Prodi</a></li>
                    <li><a href="sks.php" class="<?= $menuAktif == 'sks' ? 'active' : '' ?>">Statistik SKS</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <div class="menu-item" onclick="toggleDropdown(this)">
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
        <div class="container">
            <h2>Statistik SKS Mahasiswa</h2>
            <table>
                <thead>
                    <tr>
                        <th>NPM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Total SKS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_mhs = "SELECT npm, nama FROM mahasiswa ORDER BY nama ASC";
                    $result_mhs = mysqli_query($conn, $sql_mhs);

                    while ($mhs = mysqli_fetch_assoc($result_mhs)) {
                        $npm = $mhs['npm'];
                        $nama = $mhs['nama'];

                        $sql_sks = "
                            SELECT SUM(mk.sks) AS total_sks
                            FROM krs
                            JOIN kelas k ON krs.id_kelas = k.id_kelas
                            JOIN mata_kuliah mk ON k.kode_mk = mk.kode_mk
                            WHERE krs.npm = '$npm'
                        ";
                        $total_sks = mysqli_fetch_assoc(mysqli_query($conn, $sql_sks))['total_sks'] ?? 0;

                        echo "<tr>
                                <td>$npm</td>
                                <td>$nama</td>
                                <td>{$total_sks} SKS</td>
                              </tr>";
                    }
                    ?>
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
