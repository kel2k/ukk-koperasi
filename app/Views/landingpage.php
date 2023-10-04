<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Koperasi Simpan Pinjam</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<style>
  /* CSS untuk menyesuaikan tombol dengan teks */
  #login-link {
    display: flex;
    align-items: center;
  }

  /* Jarak antara teks dan tombol */
  #login-link span {
    margin-left: 1px;
  }

  #login-link .btn {
    margin-top: -8px;
    /* Sesuaikan nilai ini sesuai dengan preferensi Anda */
  }

  .btn-primary {
    background-color: #696cff;
    color: #fff;
  }
</style>

<body>

  <header class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">
        <img src="/assets/images/logo-light-icon.png" alt="Logo" width="50px" height="50px">
        Koperasi Simpan Pinjam
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto m-0 justify-content-center">
          <li class="nav-item">
            <a class="nav-link" href="/home/tentang">Tentang</a>
          </li>
          <li class="nav-item">
            <a id="login-link" class="nav-link text-white m-0 mt-1" href="/home/login">
              <span class="btn btn-primary rounded-pill">Login</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <main class="container">
    <section class="my-5">
      <div class="row">
        <div class="col-md-6">
          <img src="/assets/images/Koperasi-Simpan-Pinjam.png" alt="Banner promosi" class="img-fluid">
        </div>
        <div class="col-md-6">
          <h2 class="display-4">Koperasi Simpan Pinjam</h2>
          <p>Koperasi Simpan Pinjam kami menyediakan berbagai produk dan layanan keuangan untuk memenuhi kebutuhan Anda.
          </p>
          <a href="/home/periksa" class="btn btn-primary">Pelajari lebih lanjut</a>
        </div>
      </div>
    </section>

    <section class="my-5">
      <div class="row">
        <div class="col-md-12">
          <h2>Promosi Terbaru</h2>
          <p>Dapatkan suku bunga spesial untuk produk simpanan dan pinjaman kami.</p>
          <a href="/home/promosi" class="btn btn-primary">Lihat promo</a>
        </div>
      </div>
    </section>
  </main>

  <footer class="container">
    <p>Copyright &copy; 2023 Koperasi Simpan Pinjam</p>
  </footer>

</body>

</html>