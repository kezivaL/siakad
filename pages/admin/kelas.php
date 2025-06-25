<?php
session_start();
include '../../includes/koneksi.php';

// Autentikasi
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

$id_kelas = $kode_mk = $nip = $sks = "";

if (isset($_POST['simpan'])) {
    $id_kelas = trim($_POST['id_kelas']);
    $kode_mk = trim($_POST['kode_mk']);
    $nip = trim($_POST['nip']);
    $sks = trim($_POST['sks']);

    if ($id_kelas === "" || $kode_mk === "" || $nip === "" || $sks === "") {
        die("Semua field harus diisi.");
    }

    $cek = mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas = '$id_kelas'");
    if (mysqli_num_rows($cek) > 0) {
        $stmt = mysqli_prepare($conn, "UPDATE kelas SET kode_mk=?, nip=?, sks=? WHERE id_kelas=?");
        mysqli_stmt_bind_param($stmt, "sssi", $kode_mk, $nip, $sks, $id_kelas);
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO kelas (id_kelas, kode_mk, nip, sks) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "isss", $id_kelas, $kode_mk, $nip, $sks);
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: kelas.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $hapus_id = $_GET['hapus'];
    $stmt = mysqli_prepare($conn, "DELETE FROM kelas WHERE id_kelas = ?");
    mysqli_stmt_bind_param($stmt, "i", $hapus_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: kelas.php");
    exit;
}

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas = '$edit_id' LIMIT 1");
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id_kelas = $row['id_kelas'];
        $kode_mk = $row['kode_mk'];
        $nip = $row['nip'];
        $sks = $row['sks'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kelas</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/kelas.css">
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
            <li class="dropdown" onclick="toggleDropdown(this)">
                <span>Data Master</span> <span class="arrow">&#9654;</span>
                <ul class="submenu">
                    <li><a href="mahasiswa.php">Data Mahasiswa</a></li>
                    <li><a href="dosen.php">Data Dosen</a></li>
                    <li><a href="matakuliah.php">Data Mata Kuliah</a></li>
                    <li><a href="kelas.php">Data Kelas</a></li>
                </ul>
            </li>
            <li class="dropdown" onclick="toggleDropdown(this)">
                <span>Manajemen Akademik</span>
                <span class="arrow">&#9654;</span>
                <ul class="submenu">
                    <li><a href="krs.php">Verifikasi KRS Mahasiswa</a></li>
                    <li><a href="jadwal.php">Monitoring Jadwal Kuliah</a></li>
                    <li><a href="users.php">Manajemen User</a></li>
                </ul>
            </li>

            <!-- Laporan & Statistik -->
            <li class="dropdown" onclick="toggleDropdown(this)">
                <span>Laporan & Statistik</span>
                <span class="arrow">&#9654;</span>
                <ul class="submenu">
                    <li><a href="laporan.php">Jumlah Mahasiswa per Prodi</a></li>
                    <li><a href="#">Statistik SKS yang Diambil</a></li>
                </ul>
            </li>

            <!-- Pengaturan Sistem -->
            <li class="dropdown" onclick="toggleDropdown(this)">
                <span>Pengaturan Sistem</span>
                <span class="arrow">&#9654;</span>
                <ul class="submenu">
                    <li><a href="#">Ganti Tahun Ajaran</a></li>
                    <li><a href="#">Reset Password</a></li>
                </ul>
            </li>
        </ul>
    </aside>

    <main class="content">
        <div class="container">
            <h2>Data Kelas</h2>
            <form method="post" action="">
                <label>ID Kelas:</label>
                <input type="text" name="id_kelas" value="<?= htmlspecialchars($id_kelas) ?>" <?= isset($_GET['edit']) ? 'readonly' : '' ?> required>

                <label>Kode Mata Kuliah:</label>
                <input type="text" name="kode_mk" value="<?= htmlspecialchars($kode_mk) ?>" required>

                <label>NIP Dosen:</label>
                <input type="text" name="nip" value="<?= htmlspecialchars($nip) ?>" required>

                <label>SKS:</label>
                <input type="number" name="sks" value="<?= htmlspecialchars($sks) ?>" required>

                <button type="submit" name="simpan">Simpan</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>ID Kelas</th>
                        <th>Kode MK</th>
                        <th>NIP</th>
                        <th>SKS</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = mysqli_query($conn, "SELECT * FROM kelas ORDER BY id_kelas ASC");
                    while ($row = mysqli_fetch_assoc($data)) {
                        echo "<tr>
                            <td>{$row['id_kelas']}</td>
                            <td>{$row['kode_mk']}</td>
                            <td>{$row['nip']}</td>
                            <td>{$row['sks']}</td>
                            <td>
                                <a href='?edit={$row['id_kelas']}' class='edit-btn'>Edit</a>
                                <a href='?hapus={$row['id_kelas']}' onclick='return confirm(\"Hapus data ini?\")' class='delete-btn'>Hapus</a>
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
