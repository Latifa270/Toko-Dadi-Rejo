<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style_info_produk.css" />
    <style>
      .lihat-profil-link {
        display: inline-block;
        margin-bottom: 20px;
        color: #6ca027;
        font-weight: bold;
        text-decoration: none;
      }
      .lihat-profil-link:hover {
        text-decoration: underline;
      }

      .form-group {
        margin-bottom: 15px;
      }

      .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
      }

      .form-group input,
      .form-group select {
        width: 100%;
        padding: 8px;
        border-radius: 6px;
        border: 1px solid #ccc;
      }

      .save-btn {
        margin-top: 20px;
        background-color: #6ca027;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
      }

      .profile-header {
        margin-bottom: 20px;
      }

      .profile-title {
        font-size: 24px;
        font-weight: bold;
      }

      .profile-content {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        max-width: 500px;
        margin: 0 auto;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      }
    </style>
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
          <!-- Konten profil di tengah -->
          <div class="profile-content">
            <a href="lihat_profil.php" class="lihat-profil-link">← Lihat Profil</a>

            <div class="profile-header">
              <div class="profile-title">Profil Anda</div>
            </div>

            <form class="profile-form" method="POST" action="simpan_profil.php">
              <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" id="name" name="nama_pengguna" placeholder="Masukkan nama">
              </div>

              <div class="form-group">
                <label for="gender">Jenis Kelamin</label>
                <select id="gender" name="jenis_kelamin">
                  <option value="">Pilih jenis kelamin</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>

              <div class="form-group">
                <label for="birthdate">Tanggal Lahir</label>
                <input type="date" id="birthdate" name="tanggal_lahir">
              </div>

              <button type="submit" class="save-btn">Simpan</button>
            </form>
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
