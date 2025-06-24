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
jml_mk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM mata_kuliah"))['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/mahasiswa.css">
</head>
<body>
<header>
    <h1>Dashboard Administrator</h1>
    <nav>
        <a href="../../auth/logout.php">Logout</a>
    </nav>
</header>
<div class="main-wrapper">
    <aside class="sidebar">
        <h3>Modul</h3>
        <ul>
            <li><a href="mahasiswa.php">Data Mahasiswa</a></li>
            <li><a href="dosen.php">Data Dosen</a></li>
            <li><a href="matakuliah.php">Data Mata Kuliah</a></li>
            <li><a href="kelas.php">Data Kelas</a></li>
            <li><a href="semester.php">Tahun Ajaran & Semester</a></li>
            <li><a href="krs.php">Verifikasi KRS</a></li>
            <li><a href="nilai.php">Monitoring Nilai</a></li>
            <li><a href="jadwal.php">Monitoring Jadwal</a></li>
            <li><a href="users.php">Manajemen User</a></li>
            <li><a href="laporan.php">Laporan & Statistik</a></li>
            <li><a href="pengaturan.php">Pengaturan Sistem</a></li>
        </ul>
    </aside>
    <main class="content">
        <div class="container">
            <h2>Data Mahasiswa</h2>
            <form method="post" action="mahasiswa.php">
                <label>NPM:</label>
                <input type="text" name="npm" value="<?= htmlspecialchars($npm) ?>" required <?= isset($_GET['edit']) ? 'readonly' : '' ?>>

                <label>Nama:</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>" required>

                <label>Program Studi:</label>
                <input type="text" name="prodi" value="<?= htmlspecialchars($prodi) ?>" required>

                <label>Alamat:</label>
                <input type="text" name="alamat" value="<?= htmlspecialchars($alamat) ?>" required>

                <label>Tanggal Lahir:</label>
                <input type="date" name="tgl_lahir" value="<?= htmlspecialchars($tgl_lahir) ?>" required>

                <button type="submit" name="simpan">Simpan</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY npm ASC");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['npm']}</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['prodi']}</td>
                            <td>{$row['alamat']}</td>
                            <td>{$row['tgl_lahir']}</td>
                            <td>
                                <a href='mahasiswa.php?edit={$row['npm']}' class='edit-btn'>Edit</a>
                                <a href='mahasiswa.php?hapus={$row['npm']}' onclick='return confirm(\"Yakin hapus data?\")' class='delete-btn'>Hapus</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>
