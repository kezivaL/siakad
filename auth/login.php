<?php
session_start();
include '../includes/koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];

        // Arahkan berdasarkan role
        if ($data['role'] == 'admin') {
            header("Location: ../pages/admin/dashboard.php");
        } elseif ($data['role'] == 'dosen') {
            header("Location: ../pages/dosen/dashboard.php");
        } elseif ($data['role'] == 'mahasiswa') {
            header("Location: ../pages/mahasiswa/dashboard.php");
        }
    } else {
        echo "<script>alert('Login gagal. Cek username/password!')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Akademik</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <div class="container">
        <!-- KIRI: Panel Form Login -->
    <div class="left-panel">
        <div class="login-wrapper">
            <div class="header">
                <img src="../assets/foto/logounindra.jpg" alt="Logo UNINDRA" class="logo">
                <div class="header-text">
                    <h1>Sistem Informasi Akademik</h1>
                    <p>Universitas Indraprasta PGRI</p>
                </div>
            </div>

            <div class="form-box">
                <h2>Portal Login</h2>
                <form method="post">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>

                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>

                    <input type="submit" name="login" value="Login">
                    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
                </form>
            </div>
        </div>
    </div>

    <!-- KANAN: Gambar -->
    <div class="right-panel">
        <img src="../assets/foto/gbr_dashboard.jpg" alt="Dashboard Image">
    </div>
</div>