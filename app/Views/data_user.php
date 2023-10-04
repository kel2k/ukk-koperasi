<?php
// Jumlah total data
$total_data = count($vuser);

// Jumlah data per halaman
$per_page = 10;

// Hitung jumlah halaman
$total_pages = ceil($total_data / $per_page);

// Halaman saat ini
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Menghitung index awal dan akhir data yang akan ditampilkan di halaman saat ini
$start = ($current_page - 1) * $per_page;
$end = $start + $per_page;

// Memastikan $start dan $end dalam batas yang benar
if ($start < 0) {
    $start = 0;
}
if ($end > $total_data) {
    $end = $total_data;
}

// Nomor awal yang sesuai dengan halaman saat ini
$start_number = ($current_page - 1) * $per_page + 1;

?>

<div class="row">
    <!-- column -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Basic Table</h4>
                <h6 class="card-subtitle">Add class <code>.table</code></h6>
                <div class="table-responsive">
                    <table class="table user-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                        $no = $start_number; // Menggunakan nomor awal yang sudah dihitung
                        for ($i = $start; $i < $end; $i++) {
                            $k = $vuser[$i];
                            ?>
                            <tr>
                                <td>
                                    <?php echo $no++ ?>
                                </td>
                                <td>
                                    <?php echo $k->username ?>
                                </td>
                                <td>
                                    <?php echo $k->email ?>
                                </td>
                                <td>
                                    <?php echo $k->password ?>
                                </td>
                                <td>
                                    <?php echo $k->nm_level ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('/home/reset/' . $k->id_user) ?>"><button
                                            class="btn btn-danger">Reset</button></a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Membuat navigasi pagination -->
<ul class="pagination">
    <?php for ($page = 1; $page <= $total_pages; $page++): ?>
        <li class="page-item <?php echo ($page == $current_page) ? 'active' : ''; ?>">
            <a class="page-link" href="?page=<?php echo $page; ?>">
                <?php echo $page; ?>
            </a>
        </li>
    <?php endfor; ?>
</ul>
</div>
</div>
</div>
</div>