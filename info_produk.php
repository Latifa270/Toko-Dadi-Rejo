<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_produk = (int) $_GET['id'];
    $query = "SELECT * FROM t_produk WHERE id_produk = $id_produk";
    $result = mysqli_query($con, $query);

    if ($data = mysqli_fetch_assoc($result)) {
        $nama_produk = $data['nama_produk'];
        $harga_produk = number_format($data['harga_produk'], 0, ',', '.');
        $gambar_produk = $data['gambar_produk'];
        $deskripsi_produk = $data['deskripsi_produk'];
    } else {
        echo "Produk tidak ditemukan.";
        exit;
    }
} else {
    echo "ID produk tidak diberikan.";
    exit;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style_info_produk.css" />
  </head>
  <body>
    <div class="macbook-pro">
      <div class="div">
        <div class="overlap">
          <div class="overlap-group">
            <div class="rectangle"></div>
            <div class="text-wrapper">Produk</div>
            <div class="text-wrapper-2">Kategori Produk</div>
            <div class="text-wrapper-3">Kontak</div>
            <div class="text-wrapper-4">TOKO DADI REJO</div>
            <div class="rectangle-2"></div>
            <div class="rectangle-3"></div>
            <div class="text-wrapper-5">Rp. 21.000</div>
            <div class="text-wrapper-6">Rp. 19.000</div>
            <div class="text-wrapper-7"><a href="#">Gula</a></div>
            <div class="text-wrapper-8"><a href="#">Energen</a></div>
            <img class="gula-removebg" src="gambar/makanan_pokok/gula.png" />
            <img class="energen-removebg" src="gambar/minuman_sachet/energen.png" />
            <div class="group">
              <div class="text-wrapper-9">Makanan Pokok</div>
              <div class="text-wrapper-10">Makanan Ringan</div>
              <div class="text-wrapper-11">Minuman Botol</div>
              <div class="text-wrapper-12">Bumbu Dapur</div>
              <div class="text-wrapper-13">Minuman Sachet</div>
            </div>
            <p class="alamat-jl-dawuhan">Alamat : Jl. Dawuhan <br />Kec. Taman, Madiun</p>
            <div class="text-wrapper-14">2024</div>
            <div class="text-wrapper-15">Kontak : 089652248149</div>
            <div class="text-wrapper-16">Email : dadirjo1@gmail.com</div>
            <div class="text-wrapper-17">@2024 Toko Dadi Rejo</div>
            <p class="toko-dadi-rejo">
              Toko Dadi Rejo adalah toko kelontong yang menyediakan berbagai kebutuhan sehari-hari, mulai dari aneka
              jajanan, bahan dapur, minuman, <br />hingga bahan makanan pokok.
            </p>
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
        <div class="overlap-8">
          <!-- Bagian dinamis: Detail Produk -->
          <div class="detail-produk">
            <div class="produk-card">
              <div class="gambar-container">
                <img src="<?= $gambar_produk ?>" alt="<?= $nama_produk ?>" class="gambar-produk">
                <form action="tambah_keranjang.php" method="POST" class="form-keranjang">
  <input type="hidden" name="id_produk" value="<?= $id_produk ?>">
  <button type="submit" class="btn-keranjang" title="Tambah ke Keranjang">
    <img src="gambar/iconKeranjang.png" alt="Keranjang Belanja">
  </button>
</form>

              </div>
              <div class="info-produk">
                <h3 class="nama-produk"><?= $nama_produk ?></h3>
                <p class="harga-produk">Rp. <?= $harga_produk ?></p>
                <p class="deskripsi-produk"><?= nl2br($deskripsi_produk) ?></p>
              </div>
            </div>
          </div>
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
    </div>
  </body>
</html>
