<?php
// session
session_start();

// tidak bisa ke halaman index ketika belum login
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// Koneksi
require '../functions/functions.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Resep BETAWI | Data Resep Makanan</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<style>
* {
    font-family: 'Poppins', sans-serif;
}
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion pt-3" id="accordionSidebar"
            style="background-color: #0245bc;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!-- <i class="bi bi-gift text-white" style="font-size: 25px; padding-right: 8px; color: #012970;"></i> -->
                </div>
                <div class="sidebar-brand-text mx-1 fs-4">RESEP <span class="text-warning">BETAWI</span>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="data_resep.php">
                    <i class="bi bi-bag-plus-fill"></i>
                    <span>Data Resep Makanan</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="../login/logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar</span></a>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Keluar</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin ingin keluar?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                <a href="../login/logout.php">
                                    <button type="button" class="btn btn-danger">Keluar</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hello Admin Ganteng</span>
                                <img class="img-profile rounded-circle" src="../image/undraw_profile_1.svg">
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-3">
                        <h3 class="h3 mb-0 text-gray-800" style="font-size: 30px; ">Data Resep Makanan</h3>

                        <!-- export ke excel -->
                        <a href="cetak_resep.php" target="_blank"
                            class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"
                            style="padding: 7px 10px; font-weight: 500; font-size: 15px;">
                            <i class="fas fa-download fa-sm text-white pe-2"></i>Unduh Data</a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mx-0 lg:mx-3">
                        <div class="card-header py-3">
                            <!-- <a href="input-produk.php" class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="padding: 7px; font-weight: 500; font-size: 15px; background-color: #0245bc;  color: white;">
                                <i class="bi bi-plus text-white"></i> Tambah Produk</a> -->

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="bi bi-plus text-white"></i> Tambah Data</a>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog  modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Resep
                                                Makanan</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3 needs-validation" method="POST"
                                                enctype="multipart/form-data" novalidate>
                                                <div class="col-12">
                                                    <label for="validationCustom01"
                                                        class="form-label">Pertanyaan</label>
                                                    <!-- <input type="text" class="form-control" id="validationCustom01" name="alamat" placeholder="Masukkan nama wisata" required> -->
                                                    <textarea class="form-control" id="validationCustom01" rows="5"
                                                        name="pertanyaan" placeholder="Masukkan pertanyaan"></textarea>
                                                    <div class="valid-feedback">
                                                        Pertanyaan sudah diisi!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Pertanyaan belum diisi!
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="validationCustom01" class="form-label">Jawaban</label>
                                                    <!-- <input type="text" class="form-control" id="validationCustom01" name="alamat" placeholder="Masukkan nama wisata" required> -->
                                                    <textarea class="form-control" id="validationCustom01" rows="5"
                                                        name="jawaban" placeholder="Masukkan jawaban"></textarea>
                                                    <div class="valid-feedback">
                                                        Jawaban sudah diisi!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Jawaban belum diisi!
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <!-- <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button> -->
                                                    <button type="submit" class="btn btn-primary border-0"
                                                        name="input_chat">Tambah
                                                        Data</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                    style="font-size: 13px;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="text-center">Pertanyaan</th>
                                            <th class="text-center">Jawaban</th>
                                            <th class="text-center">Opsi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php
                                        $data_all = tampil_chat();
                                        foreach ($data_all as $data_row) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= ucwords($data_row['pertanyaan']); ?></td>
                                            <td><?= ucwords($data_row['jawaban']); ?></td>
                                            <td class="text-center">

                                                <!-- untuk edit produk -->
                                                <button type="button" class="btn btn-warning text-white mb-2"
                                                    data-bs-toggle="modal" data-bs-target="#edit<?= $data_row['id']; ?>"
                                                    style="font-size: 12px;">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>

                                                <!-- untuk delete produk -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#delete<?= $data_row['id']; ?>"
                                                    style="font-size: 12px;">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- edit -->
                                        <div class="modal fade" id="edit<?= $data_row['id']; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Edit
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form class="row g-3 needs-validation" method="POST"
                                                        enctype="multipart/form-data" novalidate>
                                                        <div class="modal-body">

                                                            <?php
                                                                $id = $data_row['id'];
                                                                $sql_edit = mysqli_query($conn, "SELECT * FROM chat WHERE id = '$id' ORDER BY id DESC");
                                                                while ($row_edit = mysqli_fetch_assoc($sql_edit)) {
                                                                ?>

                                                            <div class="col-md-6 mb-2">
                                                                <input type="hidden" class="form-control"
                                                                    id="validationCustom01" name="id"
                                                                    value="<?= $row_edit['id']; ?>" readonly>
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-md-12 mb-2">
                                                                    <label for="validationCustom01"
                                                                        class="form-label">Pertanyaan</label>
                                                                    <textarea class="form-control"
                                                                        id="validationCustom01" rows="5"
                                                                        name="pertanyaan"><?= $row_edit['pertanyaan']; ?></textarea>
                                                                    <div class="valid-feedback">
                                                                        Pertanyaan sudah diisi!
                                                                    </div>
                                                                    <div class="invalid-feedback">
                                                                        Pertanyaan belum diisi!
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12 mb-2">
                                                                        <label for="validationCustom01"
                                                                            class="form-label">Jawaban</label>
                                                                        <textarea class="form-control"
                                                                            id="validationCustom01" rows="5"
                                                                            name="jawaban"><?= $row_edit['jawaban']; ?></textarea>
                                                                        <div class="valid-feedback">
                                                                            Jawaban sudah diisi!
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            Jawaban belum diisi!
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <?php } ?>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tidak</button>
                                                            <button type="submit" class="btn btn-warning text-white"
                                                                name="edit_chat">Edit</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete -->
                                        <div class="modal fade" id="delete<?= $data_row['id']; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Delete
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="" method="POST">
                                                        <div class="modal-body">
                                                            Apakah anda yakin akan menghapus data ini?
                                                            <input type="hidden" class="form-control"
                                                                id="validationCustom01" name="id"
                                                                value="<?= $data_row['id']; ?>" readonly>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tidak</button>
                                                            <button type="submit" class="btn btn-danger"
                                                                name="hapus_resep">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <?php $i++; ?>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
    </script>

    <script>
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
    })
    </script>

</body>

</html>