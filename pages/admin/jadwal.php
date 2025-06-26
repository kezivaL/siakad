    <?php
    session_start();
    include '../../includes/koneksi.php';

    if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../../auth/login.php");
        exit;
    }

    $id_kelas = $hari = $jam_mulai = $jam_selesai = $ruang = "";

    // Simpan jadwal
    if (isset($_POST['simpan'])) {
        $id_kelas = $_POST['id_kelas'];
        $hari = $_POST['hari'];
        $jam_mulai = $_POST['jam_mulai'];
        $jam_selesai = $_POST['jam_selesai'];
        $ruang = $_POST['ruang'];

        if ($id_kelas === "" || $hari === "" || $jam_mulai === "" || $jam_selesai === "" || $ruang === "") {
            die("Semua kolom wajib diisi.");
        }

        $stmt = mysqli_prepare($conn, "INSERT INTO jadwal (id_kelas, hari, jam_mulai, jam_selesai, ruang) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "issss", $id_kelas, $hari, $jam_mulai, $jam_selesai, $ruang);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: jadwal.php");
        exit;
    }

    if (isset($_GET['hapus'])) {
        $hapus_id = $_GET['hapus'];
        $stmt = mysqli_prepare($conn, "DELETE FROM jadwal WHERE id_jadwal = ?");
        mysqli_stmt_bind_param($stmt, "i", $hapus_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: jadwal.php");
        exit;
    }

    $kelas_list = mysqli_query($conn, "SELECT k.id_kelas, mk.nama_mk FROM kelas k JOIN mata_kuliah mk ON k.kode_mk = mk.kode_mk");
    ?>

    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Data Jadwal Kuliah</title>
        <link rel="stylesheet" href="../../assets/css/dashboard.css">
        <link rel="stylesheet" href="../../assets/css/jadwal.css">
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
                <h2>Data Jadwal Kuliah</h2>
                <form method="post" action="">
                    <label>Mata Kuliah:</label>
                    <select name="id_kelas" required>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        <?php while ($k = mysqli_fetch_assoc($kelas_list)) {
                            echo "<option value='{$k['id_kelas']}'>{$k['nama_mk']}</option>";
                        } ?>
                    </select>

                    <label>Hari:</label>
                    <input type="text" name="hari" required>

                    <label>Jam Mulai:</label>
                    <input type="time" name="jam_mulai" required>

                    <label>Jam Selesai:</label>
                    <input type="time" name="jam_selesai" required>

                    <label>Ruang:</label>
                    <input type="text" name="ruang" required>

                    <button type="submit" name="simpan">Simpan</button>
                </form>

                <table>
                    <thead>
                        <tr>
                            <th>Mata Kuliah</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Ruang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $jadwal = mysqli_query($conn, "
                        SELECT j.*, mk.nama_mk FROM jadwal j 
                        JOIN kelas k ON j.id_kelas = k.id_kelas 
                        JOIN mata_kuliah mk ON k.kode_mk = mk.kode_mk
                    ");
                    while ($row = mysqli_fetch_assoc($jadwal)) {
                        echo "<tr>
                            <td>{$row['nama_mk']}</td>
                            <td>{$row['hari']}</td>
                            <td>{$row['jam_mulai']} - {$row['jam_selesai']}</td>
                            <td>{$row['ruang']}</td>
                            <td>
                                <a href='?hapus={$row['id_jadwal']}' onclick='return confirm(\"Yakin hapus jadwal ini?\")' class='delete-btn'>Hapus</a>
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
