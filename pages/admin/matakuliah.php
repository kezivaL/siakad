<?php 
session_start();
include '../../includes/koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

$kode_mk = $nama_mk = $sks = $semester = "";

if (isset($_POST['simpan'])) {
    $kode_mk = trim($_POST['kode_mk']);
    $nama_mk = trim($_POST['nama_mk']);
    $sks = trim($_POST['sks']);
    $semester = trim($_POST['semester']);

    if ($kode_mk === "" || $nama_mk === "" || $sks === "" || $semester === "") {
        die("Semua data harus diisi.");
    }

    $cek = mysqli_query($conn, "SELECT * FROM mata_kuliah WHERE kode_mk = '$kode_mk'");
    if (mysqli_num_rows($cek) > 0) {
        $stmt = mysqli_prepare($conn, "UPDATE mata_kuliah SET nama_mk=?, sks=?, semester=? WHERE kode_mk=?");
        mysqli_stmt_bind_param($stmt, "siss", $nama_mk, $sks, $semester, $kode_mk);
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO mata_kuliah (kode_mk, nama_mk, sks, semester) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssis", $kode_mk, $nama_mk, $sks, $semester);
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: matakuliah.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $hapus_kode = $_GET['hapus'];
    $stmt = mysqli_prepare($conn, "DELETE FROM mata_kuliah WHERE kode_mk = ?");
    mysqli_stmt_bind_param($stmt, "s", $hapus_kode);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: matakuliah.php");
    exit;
}

if (isset($_GET['edit'])) {
    $edit_kode = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM mata_kuliah WHERE kode_mk = '$edit_kode' LIMIT 1");
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $kode_mk = $row['kode_mk'];
        $nama_mk = $row['nama_mk'];
        $sks = $row['sks'];
        $semester = $row['semester'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mata Kuliah</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/matakuliah.css">
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
            <h2>Data Mata Kuliah</h2>
            <form method="post" action="">
                <label>Kode MK:</label>
                <input type="text" name="kode_mk" value="<?= htmlspecialchars($kode_mk) ?>" <?= isset($_GET['edit']) ? 'readonly' : '' ?> required>

                <label>Nama Mata Kuliah:</label>
                <input type="text" name="nama_mk" value="<?= htmlspecialchars($nama_mk) ?>" required>

                <label>SKS:</label>
                <input type="number" name="sks" value="<?= htmlspecialchars($sks) ?>" required>

                <label>Semester:</label>
                <input type="text" name="semester" value="<?= htmlspecialchars($semester) ?>" required>

                <button type="submit" name="simpan">Simpan</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = mysqli_query($conn, "SELECT * FROM mata_kuliah ORDER BY kode_mk ASC");
                    while ($row = mysqli_fetch_assoc($data)) {
                        echo "<tr>
                            <td>{$row['kode_mk']}</td>
                            <td>{$row['nama_mk']}</td>
                            <td>{$row['sks']}</td>
                            <td>{$row['semester']}</td>
                            <td>
                                <a href='?edit={$row['kode_mk']}' class='edit-btn'>Edit</a>
                                <a href='?hapus={$row['kode_mk']}' onclick='return confirm(\"Hapus data ini?\")' class='delete-btn'>Hapus</a>
                            </td>
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
