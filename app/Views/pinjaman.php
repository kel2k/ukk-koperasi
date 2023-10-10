<?php if (session()->get('level') == 1 || session()->get('level') == 3) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tabel Pinjaman</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
            integrity="sha512-+J+gkzvzJz+6zvJ5xZvzJZJzJZJzJZJzJZJZJZJzJZJzJZJzJZJZJZJZJZJzJZJzJZJzJZJzJZJzJZJzJZQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
            integrity="sha384-5FVJmBOmL15aQqvvdmxpENsNQE8N9+Iv6nMpveFVrE+I5aSkuFbJW8jbdEjh4u"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"
            integrity="sha512-+JQJ+ZJLQzJQJ6z5tq+JQJ+ZJLQzJQJ6z5tq+JQJ+ZJLQzJQJ6z5tq+JQJ+ZJLQzJQJ6z5tq+JQJ+ZJLQzJQJ6z5tq+JQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>

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
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title">Tabel Pinjaman</h4>
                                <button class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                    title="Click to add data" onclick="window.location.href='/home/tambahpinjaman'"><i
                                        class="fas fa-plus"></i> Add Pinjaman</button>

                            </div>

                            <!-- Add the search input field here -->
                            <div class="form-group">
                                <input type="text" class="form-control" id="searchInput" placeholder="Search">
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-responsive-sm-down">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Peminjam</th>
                                            <th>Besar Pinjaman</th>
                                            <th>Tanggal Pinjaman</th>
                                            <th>Tanggal Pelunasan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <?php
                                    $no = 1;
                                    foreach ($vpinjaman as $k) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $no++ ?>
                                            </td>
                                            <td>
                                                <?php echo $k->username ?>
                                            </td>
                                            <td>
                                                <?php echo $k->besar_pinjaman ?>
                                            </td>
                                            <td>
                                                <?php echo $k->tgl_pinjaman ?>
                                            </td>
                                            <td>
                                                <?php echo $k->tgl_pelunasan ?>
                                            </td>
                                            <td>
                                                <?php echo $k->status_pinjaman ?>
                                            </td>
                                            <td>
                                                <a href="/home/export_pdf1" class="btn btn-danger"><svg
                                                        xmlns="http://www.w3.org/2000/svg" height="1.5em"
                                                        viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                        <style>
                                                            svg {
                                                                fill: #dee2e6
                                                            }
                                                        </style>
                                                        <path
                                                            d="M64 464H96v48H64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V288H336V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16zM176 352h32c30.9 0 56 25.1 56 56s-25.1 56-56 56H192v32c0 8.8-7.2 16-16 16s-16-7.2-16-16V448 368c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24H192v48h16zm96-80h32c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48H304c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H320v96h16zm80-112c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16s-7.2 16-16 16H448v32h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H448v48c0 8.8-7.2 16-16 16s-16-7.2-16-16V432 368z" />
                                                    </svg></a>
                                                <a href="/home/export_excel1" class="btn btn-primary"><svg
                                                        xmlns="http://www.w3.org/2000/svg" height="1.25em"
                                                        viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                        <path
                                                            d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48zm212-240h-28.8c-4.4 0-8.4 2.4-10.5 6.3-18 33.1-22.2 42.4-28.6 57.7-13.9-29.1-6.9-17.3-28.6-57.7-2.1-3.9-6.2-6.3-10.6-6.3H124c-9.3 0-15 10-10.4 18l46.3 78-46.3 78c-4.7 8 1.1 18 10.4 18h28.9c4.4 0 8.4-2.4 10.5-6.3 21.7-40 23-45 28.6-57.7 14.9 30.2 5.9 15.9 28.6 57.7 2.1 3.9 6.2 6.3 10.6 6.3H260c9.3 0 15-10 10.4-18L224 320c.7-1.1 30.3-50.5 46.3-78 4.7-8-1.1-18-10.3-18z" />
                                                    </svg></a>
                                                <a href="<?= base_url('/home/hapuspinjaman/' . $k->id_pinjaman) ?>"><button
                                                        class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="16" height="16" fill="currentColor" class="bi bi-trash3"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                        </svg></button></a>
                                                <?php
                                                if ($k->status_pinjaman == "Approved") {
                                                    ?>

                                                    <a href="<?php echo base_url('/home/aksi_editstatus4/' . $k->id_pinjaman) ?>">
                                                        <button class="btn btn-danger"><i width="16" height="16"
                                                                class="fa fa-window-close"></i>
                                                        </button></a>

                                                    <?php
                                                } else if ($k->status_pinjaman == "Not Approved") {
                                                    ?>

                                                        <a href="<?php echo base_url('/home/aksi_editstatus3/' . $k->id_pinjaman) ?>">
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

        <script>
            function filterTable() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("searchInput");
                filter = input.value.toUpperCase();
                table = document.querySelector(".table-responsive table");
                tr = table.getElementsByTagName("tr");

                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1]; // Change the index to match the column you want to filter (e.g., 1 for "Nama Petugas")
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

    <?php
} else if (session()->get('level') == 2) {
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Tabel Pinjaman</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
                integrity="sha512-+J+gkzvzJz+6zvJ5xZvzJZJzJZJzJZJzJZJZJZJzJZJzJZJzJZJZJZJZJZJzJZJzJZJzJZJzJZJzJZJzJZQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />
            <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
                integrity="sha384-5FVJmBOmL15aQqvvdmxpENsNQE8N9+Iv6nMpveFVrE+I5aSkuFbJW8jbdEjh4u"
                crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"
                integrity="sha512-+JQJ+ZJLQzJQJ6z5tq+JQJ+ZJLQzJQJ6z5tq+JQJ+ZJLQzJQJ6z5tq+JQJ+ZJLQzJQJ6z5tq+JQJ+ZJLQzJQJ6z5tq+JQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
                integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
                crossorigin="anonymous"></script>

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
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title">Tabel Pinjaman</h4>
                                    <button class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                                        title="Click to add data" onclick="window.location.href='/home/tambahpinjaman'"><i
                                            class="fas fa-plus"></i> Add Pinjaman</button>

                                </div>

                                <!-- Add the search input field here -->
                                <div class="form-group">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Search">
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-responsive-sm-down">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Peminjam</th>
                                                <th>Besar Pinjaman</th>
                                                <th>Tanggal Pinjaman</th>
                                                <th>Tanggal Pelunasan</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>

                                        <?php
                                        $no = 1;
                                        foreach ($vpinjaman as $k) {
                                            ?>
                                            <tr>
                                                <td>
                                                <?php echo $no++ ?>
                                                </td>
                                                <td>
                                                <?php echo $k->username ?>
                                                </td>
                                                <td>
                                                <?php echo $k->besar_pinjaman ?>
                                                </td>
                                                <td>
                                                <?php echo $k->tgl_pinjaman ?>
                                                </td>
                                                <td>
                                                <?php echo $k->tgl_pelunasan ?>
                                                </td>
                                                <td>
                                                <?php echo $k->status_pinjaman ?>
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

            <script>
                function filterTable() {
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("searchInput");
                    filter = input.value.toUpperCase();
                    table = document.querySelector(".table-responsive table");
                    tr = table.getElementsByTagName("tr");

                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[1]; // Change the index to match the column you want to filter (e.g., 1 for "Nama Petugas")
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
<?php } ?>