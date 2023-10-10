<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Angsuran</title>
    <style>
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 100px;
            /* Atur ukuran logo sesuai kebutuhan */
            height: auto;
        }

        .judul {
            font-size: 24px;
            font-weight: bold;
        }

        .alamat {
            font-size: 14px;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #000;
            text-align: left;
            padding: 8px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <h3>
        <?= $title ?>
    </h3>

    <table class="table table-striped table-bordered" border="1" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Tanggal Pembayaran</th>
                <th>Besar Angsuran</th>
                <th>Kategori Pinjaman</th>

            </tr>
        </thead>
        <?php
        $no = 1;
        foreach ($angsuran as $riz) {
            ?>
            <tr>
                <td>
                    <?= $no++ ?>
                </td>
                <td>
                    <?= $riz['username'] ?>
                </td>
                <td>
                    <?= date('d F Y', strtotime($riz['tgl_pembayaran'])) ?>
                </td>
                <td>
                    <?= $riz['besar_angsuran'] ?>
                </td>
                <td>
                    <?= $riz['kategori_pinjaman'] ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>

</body>

</html>