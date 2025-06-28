<?php
session_start();
include '../../includes/koneksi.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Ambil username berdasarkan id
    $getUser = mysqli_query($conn, "SELECT username FROM users WHERE id_user = $id");
    $user = mysqli_fetch_assoc($getUser);

    if ($user) {
        $default = md5($user['username']); // Gunakan NPM/NIP sebagai default password (MD5)
        $update = mysqli_query($conn, "UPDATE users SET password = '$default' WHERE id_user = $id");

        if ($update) {
            header("Location: reset.php?success=1");
            exit;
        } else {
            echo "Gagal reset password.";
        }
    } else {
        echo "User tidak ditemukan.";
    }
}
?>
