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
                            <form action="<?= base_url('Home/aksi_tambahsimpanan') ?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $angsuran['id_simpanan_user'] ?>">
                                <h5>Nama</h5>
                                <div class="md-5 input-field">
                                    <input type="text" class="form-control" value="<?php echo session('username'); ?>"
                                        placeholder="Nama" name="username" readonly>
                                </div>
                                <!-- <div class="mb-3">
                                    <label for="tgl_pembayaran">Tanggal Simpanan</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="tgl_simpanan" name="tgl_simpanan"
                                            placeholder="Tanggal">
                                    </div> -->
                        </div>
                        <div class="mb-3">
                            <label for="besar_angsuran">Besar Simpanan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" class="form-control" id="besar_simpanan" name="besar_simpanan"
                                    placeholder="Masukkan besar simpanan">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="<?= base_url('/home/simpanan') ?>"><button type="button"
                                class="ms-3 btn btn-warning">Back</button></a>
                    </div>
                    </form>
                    <script>
                        // Mendapatkan elemen input untuk "Besar Pinjaman"
                        var inputBesarSimpanan = document.getElementById('besar_simpanan');

                        // Menambahkan event listener untuk mengubah nilai input
                        inputBesarSimpanan.addEventListener('input', function () {
                            // Mengambil nilai input
                            var inputValue = inputBesarSimpanan.value;

                            // Menghapus karakter "Rp.", spasi ribuan, dan tanda titik desimal jika ada
                            inputValue = inputValue.replace(/[Rp.,\s]/g, '');

                            // Mengonversi nilai menjadi angka
                            var numericValue = parseFloat(inputValue);

                            // Mengecek apakah nilai adalah angka yang valid
                            if (!isNaN(numericValue)) {
                                // Format nilai dengan "Rp." dan tampilkan di input
                                inputBesarSimpanan.value = 'Rp. ' + numericValue.toLocaleString('en-US');
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