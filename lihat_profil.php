<?php
session_start();
include 'koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['id_pengguna'])) {
    header("Location: masuk.php");
    exit;
}

$id = $_SESSION['id_pengguna'];

// Ambil data dari database
$query = "SELECT * FROM t_pengguna WHERE id_pengguna = $id";
$result = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Profil Pengguna</title>
  <link rel="stylesheet" href="style_info_produk.css" />
  <style>
    .profil-container {
      width: 50%;
      margin: 100px auto;
      padding: 20px;
      background: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 12px;
      font-family: Arial, sans-serif;
    }
    .profil-container h2 {
      text-align: center;
      margin-bottom: 30px;
    }
    .profil-item {
      margin-bottom: 15px;
    }
    .profil-item strong {
      display: inline-block;
      width: 150px;
    }
    .edit-button {
      display: block;
      width: 100px;
      margin: 30px auto 0;
      padding: 10px;
      background-color: #6ca027;
      color: white;
      text-align: center;
      border-radius: 6px;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="profil-container">
    <h2>Profil Anda</h2>
    <div class="profil-item"><strong>Nama:</strong> <?= htmlspecialchars($data['nama_pengguna']) ?></div>
    <div class="profil-item"><strong>Email:</strong> <?= htmlspecialchars($data['email_pengguna']) ?></div>
    <div class="profil-item"><strong>No Telepon:</strong> <?= htmlspecialchars($data['no_telepon_pengguna']) ?></div>
    <div class="profil-item"><strong>Jenis Kelamin:</strong> <?= htmlspecialchars($data['jenis_kelamin']) ?></div>
    <div class="profil-item"><strong>Tanggal Lahir:</strong> <?= htmlspecialchars($data['tanggal_lahir']) ?></div>

    <a href="profil_pengguna.php" class="edit-button">Edit Profil</a>
  </div>
</body>
</html>
