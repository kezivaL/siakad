<?php 
session_start();
include '../../includes/koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

$username = $password = $role = $status = "";

if (isset($_POST['simpan'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);
    $status = trim($_POST['status']);

    if ($username === "" || $password === "" || $role === "" || $status === "") {
        die("Semua data harus diisi.");
    }

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    $hashed_pw = md5($password);

    if (mysqli_num_rows($cek) > 0) {
        $stmt = mysqli_prepare($conn, "UPDATE users SET password=?, role=?, status=? WHERE username=?");
        mysqli_stmt_bind_param($stmt, "ssss", $hashed_pw, $role, $status, $username);
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password, role, status) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $username, $hashed_pw, $role, $status);
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: users.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $hapus_user = $_GET['hapus'];
    $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $hapus_user);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: users.php");
    exit;
}

if (isset($_GET['edit'])) {
    $edit_user = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$edit_user' LIMIT 1");
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        $role = $row['role'];
        $status = $row['status'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen User</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/users.css">
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
            <h2>Manajemen User</h2>
            <form method="post" action="">
                <label>Username:</label>
                <input type="text" name="username" value="<?= htmlspecialchars($username) ?>" <?= isset($_GET['edit']) ? 'readonly' : '' ?> required>
                <label>Password:</label>
                <input type="password" name="password" required>
                <label>Role:</label>
                <select name="role" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" <?= $role === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="dosen" <?= $role === 'dosen' ? 'selected' : '' ?>>Dosen</option>
                    <option value="mahasiswa" <?= $role === 'mahasiswa' ? 'selected' : '' ?>>Mahasiswa</option>
                </select>
                <label>Status:</label>
                <select name="status" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="aktif" <?= $status === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                    <option value="nonaktif" <?= $status === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                </select>
                <button type="submit" name="simpan">Simpan</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = mysqli_query($conn, "SELECT * FROM users ORDER BY username ASC");
                    while ($row = mysqli_fetch_assoc($data)) {
                        echo "<tr>
                            <td>{$row['username']}</td>
                            <td>{$row['role']}</td>
                            <td>{$row['status']}</td>
                            <td>
                                <a href='?edit={$row['username']}' class='edit-btn'>Edit</a>
                                <a href='?hapus={$row['username']}' onclick='return confirm(\"Hapus user ini?\")' class='delete-btn'>Hapus</a>
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
