<?php
// Deteksi environment (Docker atau Local)
if (getenv('DOCKER_ENV')) {
    // Docker
    $host = "db";
    $user = "root";
    $pass = "root";
    $db   = "academic";
} else {
    // XAMPP atau lokal biasa
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "academic";
}

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
