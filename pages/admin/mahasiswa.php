<?php
session_start();
include '../../includes/koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

// Penanda menu aktif
$menuAktif = 'mahasiswa';

$npm = $nama = $prodi = $alamat = $tgl_lahir = "";

// Simpan data
if (isset($_POST['simpan'])) {
    $npm = trim($_POST['npm']);
    $nama = trim($_POST['nama']);
    $prodi = trim($_POST['prodi']);
    $alamat = trim($_POST['alamat']);
    $tgl_lahir = trim($_POST['tgl_lahir']);

    if ($npm === "" || $nama === "" || $prodi === "" || $alamat === "" || $tgl_lahir === "") {
        die("Semua data harus diisi.");
    }

    $cek = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE npm = '$npm'");
    if (mysqli_num_rows($cek) > 0) {
        $stmt = mysqli_prepare($conn, "UPDATE mahasiswa SET nama=?, prodi=?, alamat=?, tgl_lahir=? WHERE npm=?");
        mysqli_stmt_bind_param($stmt, "sssss", $nama, $prodi, $alamat, $tgl_lahir, $npm);
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO mahasiswa (npm, nama, prodi, alamat, tgl_lahir) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", $npm, $nama, $prodi, $alamat, $tgl_lahir);
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: mahasiswa.php");
    exit;
}

// Hapus
if (isset($_GET['hapus'])) {
    $hapus_npm = $_GET['hapus'];
    $stmt = mysqli_prepare($conn, "DELETE FROM mahasiswa WHERE npm = ?");
    mysqli_stmt_bind_param($stmt, "s", $hapus_npm);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: mahasiswa.php");
    exit;
}

// Edit
if (isset($_GET['edit'])) {
    $edit_npm = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE npm = '$edit_npm' LIMIT 1");
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $npm = $row['npm'];
        $nama = $row['nama'];
        $prodi = $row['prodi'];
        $alamat = $row['alamat'];
        $tgl_lahir = $row['tgl_lahir'];
    }
}
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

    <main class="content">
        <div class="container">
            <h2>Data Mahasiswa</h2>
            <form method="post" action="">
                <label>NPM:</label>
                <input type="text" name="npm" value="<?= htmlspecialchars($npm) ?>" <?= isset($_GET['edit']) ? 'readonly' : '' ?> required>

                <label>Nama:</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>" required>

                <label>Prodi:</label>
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
                        <th>Tgl Lahir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY npm ASC");
                    while ($row = mysqli_fetch_assoc($data)) {
                        echo "<tr>
                            <td>{$row['npm']}</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['prodi']}</td>
                            <td>{$row['alamat']}</td>
                            <td>{$row['tgl_lahir']}</td>
                            <td>
                                <a href='?edit={$row['npm']}' class='edit-btn'>Edit</a>
                                <a href='?hapus={$row['npm']}' onclick='return confirm(\"Hapus data ini?\")' class='delete-btn'>Hapus</a>
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
