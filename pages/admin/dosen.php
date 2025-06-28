<?php
session_start();
include '../../includes/koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

$nip = $nama = $email = $no_hp = $bidang = "";

if (isset($_POST['simpan'])) {
    $nip = trim($_POST['nip']);
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $no_hp = trim($_POST['no_hp']);
    $bidang = trim($_POST['bidang']);

    if ($nip === "" || $nama === "" || $email === "" || $no_hp === "" || $bidang === "") {
        die("Semua data harus diisi.");
    }

    $cek = mysqli_query($conn, "SELECT * FROM dosen WHERE nip = '$nip'");
    if (mysqli_num_rows($cek) > 0) {
        $stmt = mysqli_prepare($conn, "UPDATE dosen SET nama=?, email=?, no_hp=?, bidang=? WHERE nip=?");
        mysqli_stmt_bind_param($stmt, "sssss", $nama, $email, $no_hp, $bidang, $nip);
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO dosen (nip, nama, email, no_hp, bidang) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", $nip, $nama, $email, $no_hp, $bidang);
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: dosen.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $hapus_nip = $_GET['hapus'];
    $stmt = mysqli_prepare($conn, "DELETE FROM dosen WHERE nip = ?");
    mysqli_stmt_bind_param($stmt, "s", $hapus_nip);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: dosen.php");
    exit;
}

if (isset($_GET['edit'])) {
    $edit_nip = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM dosen WHERE nip = '$edit_nip' LIMIT 1");
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nip = $row['nip'];
        $nama = $row['nama'];
        $email = $row['email'];
        $no_hp = $row['no_hp'];
        $bidang = $row['bidang'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Dosen</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/dosen.css">
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
            <h2>Data Dosen</h2>
            <form method="post" action="">
                <label>NIP:</label>
                <input type="text" name="nip" value="<?= htmlspecialchars($nip) ?>" <?= isset($_GET['edit']) ? 'readonly' : '' ?> required>
                <label>Nama:</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>" required>
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                <label>No. HP:</label>
                <input type="text" name="no_hp" value="<?= htmlspecialchars($no_hp) ?>" required>
                <label>Bidang:</label>
                <input type="text" name="bidang" value="<?= htmlspecialchars($bidang) ?>" required>
                <button type="submit" name="simpan">Simpan</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Bidang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = mysqli_query($conn, "SELECT * FROM dosen ORDER BY nama ASC");
                    while ($row = mysqli_fetch_assoc($data)) {
                        echo "<tr>
                            <td>{$row['nip']}</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['no_hp']}</td>
                            <td>{$row['bidang_keahlian']}</td>
                            <td>
                                <a href='?edit={$row['nip']}' class='edit-btn'>Edit</a>
                                <a href='?hapus={$row['nip']}' onclick='return confirm(\"Hapus data ini?\")' class='delete-btn'>Hapus</a>
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
