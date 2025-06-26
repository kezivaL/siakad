<?php
$menuAktif = 'krs'; // Penanda menu aktif
session_start();
include '../../includes/koneksi.php';

// Validasi role admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

// Ambil filter dari GET
$cari = isset($_GET['cari']) ? mysqli_real_escape_string($conn, $_GET['cari']) : '';
$semester_filter = isset($_GET['semester']) ? (int)$_GET['semester'] : 0;

// Query kondisi WHERE dinamis
$where = "WHERE krs.status_verifikasi = 'Menunggu'";
if ($cari !== '') {
    $where .= " AND m.nama LIKE '%$cari%'";
}

// Query utama
$query = "
SELECT 
    m.npm,
    m.nama,
    s.nama_semester,
    krs.status_verifikasi,
    SUM(mk.sks) AS total_sks,
    ROUND((
        SELECT AVG(n.nilai_angka)
        FROM nilai n
        JOIN krs k2 ON n.id_krs = k2.id_krs
        WHERE k2.npm = m.npm
    ), 2) AS ipk,
    ROUND((
        SELECT AVG(n2.nilai_angka)
        FROM nilai n2
        JOIN krs k3 ON n2.id_krs = k3.id_krs
        WHERE k3.npm = m.npm AND k3.id_semester = krs.id_semester
    ),2) AS ips
FROM krs
JOIN mahasiswa m ON m.npm = krs.npm
JOIN kelas kls ON kls.id_kelas = krs.id_kelas
JOIN mata_kuliah mk ON mk.kode_mk = kls.kode_mk
JOIN semester s ON s.id_semester = krs.id_semester
$where
GROUP BY m.npm, s.nama_semester, krs.status_verifikasi
ORDER BY m.nama, s.nama_semester
";


$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi KRS - Admin</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/krs.css">
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
            <li class="dashboard"><a href="dashboard.php">Dashboard</a></li>

            <!-- Data Master -->
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

            <!-- Manajemen Akademik -->
            <li class="dropdown <?= in_array($menuAktif, ['krs','jadwal','users']) ? 'open' : '' ?>">
                <div class="menu-item" onclick="toggleDropdown(this)">
                    <span>Manajemen Akademik</span>
                    <span class="arrow"><?= in_array($menuAktif, ['krs','jadwal','users']) ? '&#9660;' : '&#9654;' ?></span>
                </div>
                <ul class="submenu" style="display: <?= in_array($menuAktif, ['krs','jadwal','users']) ? 'block' : 'none' ?>">
                    <li><a href="krs.php" class="<?= $menuAktif == 'krs' ? 'active' : '' ?>">Verifikasi KRS</a></li>
                    <li><a href="jadwal.php" class="<?= $menuAktif == 'jadwal' ? 'active' : '' ?>">Monitoring Jadwal</a></li>
                    <li><a href="users.php" class="<?= $menuAktif == 'users' ? 'active' : '' ?>">Manajemen User</a></li>
                </ul>
            </li>

            <!-- Laporan -->
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

            <!-- Pengaturan -->
            <li class="dropdown <?= in_array($menuAktif, ['tahun','reset']) ? 'open' : '' ?>">
                <div class="menu-item" onclick="toggleDropdown(this)">
                    <span>Pengaturan Sistem</span>
                    <span class="arrow"><?= in_array($menuAktif, ['tahun','reset']) ? '&#9660;' : '&#9654;' ?></span>
                </div>
                <ul class="submenu" style="display: <?= in_array($menuAktif, ['tahun','reset']) ? 'block' : 'none' ?>">
                    <li><a href="tahun.php" class="<?= $menuAktif == 'tahun' ? 'active' : '' ?>">Ganti Tahun Ajaran</a></li>
                    <li><a href="reset.php" class="<?= $menuAktif == 'reset' ? 'active' : '' ?>">Reset Password</a></li>
                </ul>
            </li>
        </ul>
    </aside>

    <main class="content">
        <div class="container">
            <h2>Verifikasi KRS Mahasiswa</h2>

        <!-- Form filter -->
        <form method="GET">
            <input type="text" name="cari" placeholder="Cari nama mahasiswa..." value="<?= htmlspecialchars($cari) ?>">
            <button type="submit">🔍 Cari</button>
            <a href="verifikasi_krs.php" class="reset-link">🔄 Reset</a>
        </form>

        <!-- Tabel Verifikasi -->
        <table>
            <thead>
    <tr>
        <th>NPM</th>
        <th>Nama</th>
        <th>Semester</th>
        <th>SKS</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['npm'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['nama_semester'] ?></td>
            <td><?= $row['total_sks'] ?> SKS</td>
            <td>
                <a class="btn btn-approve" href="proses_krs.php?npm=<?= $row['npm'] ?>&semester=<?= urlencode($row['nama_semester']) ?>&aksi=terima">✔️</a>
                <a class="btn btn-reject" href="proses_krs.php?npm=<?= $row['npm'] ?>&semester=<?= urlencode($row['nama_semester']) ?>&aksi=tolak" onclick="return confirm('Tolak KRS ini?')">✖️</a>
            </td>
        </tr>
    <?php } ?>
</tbody>

        </table>
    </div>
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
