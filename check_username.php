<?php
require_once 'config.php';

$koneksi = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Memeriksa apakah koneksi berhasil
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && !empty($_POST["username"])) {
        $nama_pengguna = $_POST["username"];

        $nama_pengguna = mysqli_real_escape_string($koneksi, $nama_pengguna);

        $query_check = "SELECT * FROM users WHERE username = '$nama_pengguna'";
        $result_check = mysqli_query($koneksi, $query_check);

        if (mysqli_num_rows($result_check) > 0) {
            echo "duplicate";
        } else {
            echo "not_duplicate";
        }
    } else {
        echo "empty";
    }
} else {
    echo "invalid_request";
}

mysqli_close($koneksi);
?>
