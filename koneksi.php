<?php

// Koneksi database
$host = "sql111.infinityfree.com";
$user = "if0_39248955";
$pass = "y8DEnRhIHyhEn"; // Simpan password di environment variabel untuk keamanan
$db   = "if0_39248955_db_tokodadirejo";

$con = new mysqli($host, $user, $pass, $db);

// Cek koneksi (HANYA tampilkan error jika koneksi gagal)
if ($con->connect_error) {
    die("Koneksi gagal: " . $con->connect_error);
}

?>