<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Responsif</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <style>
        .table-responsive {
            width: 100%;
            margin-bottom: 1rem;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
        }

        @media (max-width: 575.98px) {
            .table-responsive {
                -ms-overflow-style: -ms-autohiding-scrollbar;
            }

            .table-responsive .table-bordered {
                border: 0;
            }

            .table-responsive .table-bordered th,
            .table-responsive .table-bordered td,
            .table-responsive .table-bordered thead th,
            .table-responsive .table-bordered tbody+tbody {
                border-top: 1px solid #dee2e6;
            }

            .table-responsive .table-bordered thead th:first-child,
            .table-responsive .table-bordered tbody+tbody tr:first-child td:first-child,
            .table-responsive .table-bordered tbody tr:first-child th:first-child {
                border-top-left-radius: 0.25rem;
            }

            .table-responsive .table-bordered tbody tr:last-child td:first-child,
            .table-responsive .table-bordered tbody tr:last-child th:first-child {
                border-bottom-left-radius: 0.25rem;
            }

            .table-responsive .table-bordered tbody tr:first-child td:last-child,
            .table-responsive .table-bordered tbody tr:first-child th:last-child {
                border-top-right-radius: 0.25rem;
            }

            .table-responsive .table-bordered tbody tr:last-child td:last-child,
            .table-responsive .table-bordered tbody tr:last-child th:last-child {
                border-bottom-right-radius: 0.25rem;
            }

            .table-responsive .table-bordered tbody tr:nth-child(2n + 1)>td,
            .table-responsive .table-bordered tbody tr:nth-child(2n + 1)>th {
                background-color: rgba(0, 0, 0, 0.05);
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tabel Anggota</h4>

                        <!-- Add the search input field here -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="searchInput" placeholder="Search">
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-responsive-sm-down">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th>Alamat</th>
                                        <th>No Telpon</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <?php
                                $no = 1;
                                foreach ($vanggota as $k) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $no++ ?>
                                        </td>
                                        <td>
                                            <?php echo $k->nama ?>
                                        </td>
                                        <td>
                                            <?php echo $k->alamat ?>
                                        </td>
                                        <td>
                                            <?php echo $k->no_tlp ?>
                                        </td>
                                        <td>
                                            <?php echo $k->tmp_lhr ?>
                                        </td>
                                        <td>
                                            <?php echo $k->tgl_lahir ?>
                                        </td>
                                        <td>
                                            <?php echo $k->j_kel ?>
                                        </td>

                                        <td>
                                            <?php echo $k->status ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('/home/hapusanggota/' . $k->id_anggota_user) ?>"><button
                                                    class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="16" height="16" fill="currentColor" class="bi bi-trash3"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                    </svg></button></a>
                                            <a href="<?php echo base_url('/home/editanggota/' . $k->id_anggota_user) ?>"><button
                                                    class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="16" height="16" fill="currentColor" class="bi bi-pen-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                                    </svg></button></a>
                                            <?php
                                            if ($k->status == "Active") {
                                                ?>

                                                <a href="<?php echo base_url('/home/aksi_editstatus2/' . $k->id_user) ?>">
                                                    <button class="btn btn-danger"><i width="16" height="16"
                                                            class="fa fa-window-close"></i>
                                                    </button></a>

                                                <?php
                                            } else if ($k->status == "Inactive") {
                                                ?>

                                                    <a href="<?php echo base_url('/home/aksi_editstatus1/' . $k->id_user) ?>">
                                                        <button class="btn btn-success"><i width="16" height="16"
                                                                class="fa fa-check"></i></button>
                                                <?php } ?>
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
    </div>

    <!-- JavaScript for search functionality -->
    <script>
        function filterTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector(".table-responsive table");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        document.getElementById("searchInput").addEventListener("keyup", filterTable);
    </script>
</body>

</html>