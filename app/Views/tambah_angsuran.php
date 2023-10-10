<div class="main-pages">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-block bg-white rounded shadow p-3 mb-3">
                    <style>
                        .md-5.input-field {
                            margin-bottom: 20px;
                            /* Add margin at the bottom */
                        }

                        .input-field {
                            margin-bottom: 20px;
                            /* Add margin at the bottom */
                        }
                    </style>
                    <div class="form-wrapper">
                        <div class="form">
                            <form action="<?= base_url('Home/aksi_tambahangsuran') ?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $angsuran['id_angsuran_user'] ?>">
                                <h5>Nama</h5>
                                <div class="md-5 input-field">
                                    <input type="text" class="form-control" value="<?php echo session('username'); ?>"
                                        placeholder="Nama" name="username" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="tgl_pembayaran">Tanggal Pembayaran</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="tgl_pembayaran"
                                            name="tgl_pembayaran" placeholder="Tanggal">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="besar_angsuran">Besar Angsuran</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="text" class="form-control" id="besar_angsuran"
                                            name="besar_angsuran" placeholder="Masukkan besar angsuran">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <h5>Kategori Pinjaman</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="kategori_pinjaman"
                                            name="kategori_pinjaman" placeholder="Kategori Pinjaman">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                                <a href="<?= base_url('/home/angsuran') ?>"><button type="button"
                                        class="ms-3 btn btn-warning">Back</button></a>
                        </div>
                        </form>
                        <script>
                            // Mendapatkan elemen input untuk "Besar Pinjaman"
                            var inputBesarAngsuran = document.getElementById('besar_angsuran');

                            // Menambahkan event listener untuk mengubah nilai input
                            inputBesarAngsuran.addEventListener('input', function () {
                                // Mengambil nilai input
                                var inputValue = inputBesarAngsuran.value;

                                // Menghapus karakter "Rp.", spasi ribuan, dan tanda titik desimal jika ada
                                inputValue = inputValue.replace(/[Rp.,\s]/g, '');

                                // Mengonversi nilai menjadi angka
                                var numericValue = parseFloat(inputValue);

                                // Mengecek apakah nilai adalah angka yang valid
                                if (!isNaN(numericValue)) {
                                    // Format nilai dengan "Rp." dan tampilkan di input
                                    inputBesarAngsuran.value = 'Rp. ' + numericValue.toLocaleString('en-US');
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>