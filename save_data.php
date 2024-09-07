<?php
require_once 'config.php';

$koneksi = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Memeriksa apakah koneksi berhasil
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Memeriksa apakah data pengguna telah dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Memeriksa apakah nilai username telah dikirimkan dan tidak kosong
    if (isset($_POST["username"]) && !empty($_POST["username"])) {
        $nama_pengguna = $_POST["username"];

        // Melakukan sanitasi nilai username
        $nama_pengguna = mysqli_real_escape_string($koneksi, $nama_pengguna);

        // Mendapatkan waktu dan tanggal saat ini
        $waktu_tanggal = date("Y-m-d H:i:s");

        // Menyimpan nilai ke dalam database bersama dengan waktu dan tanggal
        $query = "INSERT INTO users (username, creation_time) VALUES ('$nama_pengguna', '$waktu_tanggal')";
        $result = mysqli_query($koneksi, $query);

        // Memeriksa apakah data berhasil disimpan
        if ($result) {
            mysqli_close($koneksi);
            header("Location: http://localhost");
            exit();
        } else {
            echo "Terjadi kesalahan saat menyimpan data: " . mysqli_error($koneksi);
        }
    } else {
        echo "Nama pengguna tidak ditemukan atau kosong.";
    }
} else {
    echo "Metode pengiriman data yang tidak valid.";
}

// Menutup koneksi
mysqli_close($koneksi);
?>
