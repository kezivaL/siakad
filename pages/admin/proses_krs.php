<?php
session_start();
include '../../includes/koneksi.php';

// Cek login dan role admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

// Ambil data dari GET
$npm = isset($_GET['npm']) ? mysqli_real_escape_string($conn, $_GET['npm']) : '';
$semester = isset($_GET['semester']) ? mysqli_real_escape_string($conn, $_GET['semester']) : '';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

// Validasi input
if ($npm === '' || $semester === '' || !in_array($aksi, ['terima', 'tolak'])) {
    echo "Permintaan tidak valid.";
    exit;
}

// Ambil id_semester berdasarkan nama_semester
$querySemester = mysqli_query($conn, "SELECT id_semester FROM semester WHERE nama_semester = '$semester'");
if (mysqli_num_rows($querySemester) === 0) {
    echo "Semester tidak ditemukan.";
    exit;
}
$semesterRow = mysqli_fetch_assoc($querySemester);
$id_semester = $semesterRow['id_semester'];

// ENUM status yang valid
$status = ($aksi === 'terima') ? 'Disetujui' : 'Ditolak';

// Update status_verifikasi pada tabel krs
$update = mysqli_query($conn, "
    UPDATE krs 
    SET status_verifikasi = '$status' 
    WHERE npm = '$npm' AND id_semester = $id_semester
");

if ($update) {
    header("Location: krs.php?pesan=sukses");
    exit;
} else {
    echo "Gagal memperbarui status verifikasi.";
}
?>
