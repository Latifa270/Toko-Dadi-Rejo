<?php
session_start();
include 'koneksi.php';

$id_pengguna = $_SESSION['id_pengguna'] ?? 1;

$query = "SELECT tk.id_keranjang, tp.nama_produk, tp.harga_produk, tp.gambar_produk, tk.jumlah_pesanan
          FROM t_keranjang tk
          JOIN t_produk tp ON tk.id_produk = tp.id_produk
          WHERE tk.id_pengguna = $id_pengguna";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style_info_produk.css" />
</head>
<body>
  <div class="macbook-pro">
    <div class="div">
      <!-- Header dan Navigasi -->
      <div class="overlap">
        <div class="overlap-group">
          <!-- isi header, kategori, kontak, logo, dst tetap sama -->
        </div>
        <a href="profil_pengguna.php" class="mdi-light-account-wrapper">
          <img class="mdi-light-account" src="gambar/iconAkun.png" alt="user"/>
        </a>
        <a href="keranjang.php" class="mdi-light-cart-wrapper">
          <img class="img-2" src="gambar/iconKeranjang.png" alt="Keranjang"/>
        </a>
        <a href="tentang_kami.php" class="mdi-light-bell-wrapper">
          <img class="img-2" src="gambar/iconTentangKami.png" alt="Tentang Kami"/>
        </a>
      </div>

      <!-- KERANJANG MULAI -->
      <div class="overlap-8">
        <div class="keranjang-container">
          <div class="judul-keranjang-wrapper">
            <a href="kategori_makanan_pokok.php" class="tombol-kembali">
              <img src="gambar/tombolKembali.png" alt="Kembali" class="icon-kembali"/>
            </a>
            <h2 class="judul-keranjang">Keranjang</h2>
          </div>

          <?php if (mysqli_num_rows($result) > 0): ?>
            <form method="POST" action="beli.php">
              <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="item-keranjang">
                  <input type="checkbox" name="pilih[]" value="<?= $row['id_keranjang'] ?>">
                  <img src="<?= $row['gambar_produk'] ?>" class="gambar-produk" />
                  <div class="info-produk">
                    <p class="nama-produk"><?= $row['nama_produk'] ?></p>
                    <p class="harga-produk">Rp <?= number_format($row['harga_produk'], 0, ',', '.') ?> x <?= $row['jumlah_pesanan'] ?></p>
                  </div>
                  <div class="aksi-keranjang">
                    <button type="submit" formaction="update_keranjang.php" name="tambah" value="<?= $row['id_keranjang'] ?>" class="btn-tambah">+</button>
                    <button type="submit" formaction="update_keranjang.php" name="hapus" value="<?= $row['id_keranjang'] ?>" class="btn-hapus">-</button>
                  </div>
                </div>
              <?php endwhile; ?>
              <div class="tombol-beli-wrapper">
                <button type="submit" name="beli" class="btn-beli">Beli</button>
              </div>
            </form>
          <?php else: ?>
            <p style="text-align:center;">Keranjang kosong</p>
          <?php endif; ?>
        </div>
      </div>
      <!-- KERANJANG SELESAI -->

      <div class="text-wrapper-38">TOKO DADI REJO</div>
      <a href="beranda.php" class="home-logo-wrapper">
        <img class="home-logo" src="gambar/iconRumah.png" alt="Beranda"/>
      </a>
      <div class="overlap-9">
        <p class="search-placeholder-text">Lakukan penyelusuran produk dengan kategori</p>
      </div>
      <p class="jl-dawuhan-kec-taman">Jl.&nbsp;&nbsp;Dawuhan Kec. Taman Kota Madiun</p>
      <div class="text-wrapper-43">Lokasi :</div>
    </div>
  </div>
</body>
</html>
