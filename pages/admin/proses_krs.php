<?php
include '../../includes/koneksi.php';

if (isset($_GET['npm'], $_GET['id_semester'], $_GET['aksi'])) {
    $npm = $_GET['npm'];
    $id_semester = $_GET['id_semester'];
    $aksi = $_GET['aksi'];

    $status = ($aksi == 'terima') ? 'Disetujui' : 'Ditolak';

    $query = "
        UPDATE krs
        SET status_verifikasi = '$status'
        WHERE npm = '$npm' AND id_semester = '$id_semester'
    ";

    if (mysqli_query($conn, $query)) {
        header("Location: verifikasi_krs.php?msg=success");
    } else {
        echo "❌ Gagal memperbarui status verifikasi.";
    }
}
