<?php
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
    ),2) AS ipk,
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
<html>
<head>
    <title>Verifikasi KRS - Admin</title>
    <link rel="stylesheet" href="../../assets/css/krs.css">
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

    <<div class="content">
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
        const submenu = el.querySelector(".submenu");
        const arrow = el.querySelector(".arrow");

        const isOpen = submenu.style.display === "block";
        submenu.style.display = isOpen ? "none" : "block";
        arrow.innerHTML = isOpen ? "&#9654;" : "&#9660;"; // ▶ ▼
    }
</script>
</body>
</html>
