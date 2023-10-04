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
                            <form action="<?= base_url('Home/aksi_editanggota') ?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $anggota->id_anggota_user ?>">
                                <h2>Information Detail</h2>
                                <hr>
                                </hr>

                                <h5>Nama</h5>
                                <div class="md-5 input-field">
                                    <input type="text" class="form-control" value="<?= $anggota->username ?>"
                                        placeholder="Nama" name="username">
                                </div>

                                <h5>Password</h5>
                                <div class="md-5 input-field">
                                    <input type="password" class="form-control" value="<?= $anggota->password ?>"
                                        placeholder="Password" name="password">
                                </div>

                                <h5>Alamat</h5>
                                <div class="md-5 input-field">
                                    <input type="text" class="form-control" value="<?= $anggota->alamat ?>"
                                        placeholder="Isi alamat anda" name="alamat">
                                </div>
                                <h5>Tanggal Lahir</h5>
                                <div class="md-5 input-field">
                                    <input type="date" class="form-control" value="<?= $anggota->tgl_lahir ?>"
                                        placeholder="Tanggal Lahir" name="tgl_lahir">
                                </div>
                                <h5>Tempat Lahir</h5>
                                <div class="md-5 input-field">
                                    <input type="text" class="form-control" value="<?= $anggota->tmp_lhr ?>"
                                        placeholder="Tempat Lahir" name="tmp_lhr">
                                </div>
                                <h5>Jenis Kelamin</h5>
                                <div class="md-5 input-field">
                                    <input type="text" class="form-control" value="<?= $anggota->j_kel ?>"
                                        placeholder="Jenis Kelamin" name="j_kel">
                                </div>
                        </div>
                        <h5>Email</h5>
                        <div class="md-5 input-field">
                            <input type="email" class="form-control" value="<?= $anggota->email ?>" placeholder="Email"
                                name="email">
                        </div>
                        <h5>Nomor Telfon</h5>
                        <div class="md-5 input-field">
                            <input type="tel" class="form-control" value="<?= $anggota->no_tlp ?>"
                                placeholder="Nomor Telfon" name="no_tlp">
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="<?= base_url('/home/anggota') ?>"><button type="button"
                                class="ms-3 btn btn-warning">Back</button></a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>