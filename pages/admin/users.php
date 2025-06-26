<?php
session_start();
include '../../includes/koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

$menuAktif = 'users';

$username = $role = $status = "";
$password_required = true;

if (isset($_POST['simpan'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);
    $status = trim($_POST['status']);

    if ($username === "" || $role === "" || $status === "") {
        die("Semua kolom wajib diisi.");

    if (isset($_POST['edit_mode']) && $_POST['edit_mode'] == '1') {
        if ($password !== "") {
            $hashed = md5($password);
            $stmt = mysqli_prepare($conn, "UPDATE users SET password=?, role=?, status=? WHERE username=?");
            mysqli_stmt_bind_param($stmt, "ssss", $hashed, $role, $status, $username);
        }
    } else {
        if ($password === "") {
            die("Password wajib diisi untuk user baru.");
        }
        $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password, role, status) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $username, $hashed, $role, $status);
        mysqli_stmt_bind_param($stmt, "ssss", $username, $hashed, $role, $status);
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: users.php");
    exit;
}
}

if (isset($_GET['hapus'])) {
    $hapus = $_GET['hapus'];
    $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $hapus);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: users.php");
    exit;
}

if (isset($_GET['edit'])) {
    $edit = $_GET['edit'];
    $q = mysqli_query($conn, "SELECT * FROM users WHERE username = '$edit'");
    $r = mysqli_fetch_assoc($q);
    $username = $r['username'];
    $role = $r['role'];
    $status = $r['status'];
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
            <li class="dropdown <?= in_array($menuAktif, ['mahasiswa','dosen','matakuliah','kelas']) ? 'open' : '' ?>">
                <div class="menu-item" onclick="toggleDropdown(this)">
                    <div class="menu-item">
                    <span>Data Master</span>
                    <span class="arrow"><?= in_array($menuAktif, ['mahasiswa','dosen','matakuliah','kelas']) ? '&#9660;' : '&#9654;' ?></span>
                </div>
                </div>
                <ul class="submenu" style="display: <?= in_array($menuAktif, ['mahasiswa','dosen','matakuliah','kelas']) ? 'block' : 'none' ?>">
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
            <form method="post">
                <input type="hidden" name="edit_mode" value="<?= isset($_GET['edit']) ? '1' : '0' ?>">
                <label>Username:</label>
                <input type="text" name="username" value="<?= htmlspecialchars($username) ?>" <?= isset($_GET['edit']) ? 'readonly' : '' ?> required>


                <label>Password:</label>
                <input type="password" name="password" <?= isset($_GET['edit']) ? '' : 'required' ?>>

                <label>Role:</label>
                <select name="role" required>
                    <option value="">-- Pilih --</option>
                    <option value="admin" <?= $role === "admin" ? "selected" : "" ?>>Admin</option>
                    <option value="dosen" <?= $role === "dosen" ? "selected" : "" ?>>Dosen</option>
                    <option value="mahasiswa" <?= $role === "mahasiswa" ? "selected" : "" ?>>Mahasiswa</option>
                </select>


                <label>Status:</label>
                <select name="status" required>
                    <option value="">-- Pilih --</option>
                    <option value="aktif" <?= $status === "aktif" ? "selected" : "" ?>>Aktif</option>
                    <option value="nonaktif" <?= $status === "nonaktif" ? "selected" : "" ?>>Nonaktif</option>
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
                    $data = mysqli_query($conn, "SELECT * FROM users ORDER BY username");
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