<?php

// Koneksi database
$host = "sql111.infinityfree.com";
$user = "if0_39248955";
$pass = "y8DEnRhIHyhEn"; 
$db   = "if0_39248955_db_tokodadirejo";

$con = new mysqli($host, $user, $pass, $db);

// Cek koneksi 
if ($con->connect_error) {
    die("Koneksi gagal: " . $con->connect_error);
}

?>