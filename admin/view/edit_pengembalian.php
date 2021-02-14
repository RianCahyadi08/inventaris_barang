<?php 

    session_start();
    require '../controller/admin_controller.php';
    $adminController = new AdminController();

    $id = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit pengembalian barang</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link rel="icon" type="image/png" sizes="96x96" href="../img/logo-wgs.jpeg">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css"> -->
    <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">WGS</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Interface
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Master</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Master</h6>
                        <a class="collapse-item" href="dashboard_barang.php">Data barang</a>
                        <a class="collapse-item" href="dashboard_pengajuan.php">Data pengajuan</a>
                        <a class="collapse-item active" href="dashboard_pengembalian.php">Data pengembalian</a>
                        <a class="collapse-item" href="dashboard_karyawan.php">Data karyawan</a>
                    </div>
                </div>
            </li>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit pengembalian barang</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                        $dataPengembalian = $adminController->getPengembalianWhere($id);
                                        if (is_array($dataPengembalian)):
                                            foreach ($dataPengembalian['item'] as $key => $row):
                                    ?>
                                    <form action="../model/aksi_admin.php?aksi=update-pengembalian" method="POST">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                        <div class="form-group">
                                            <label for="">Kode pengembalian</label>
                                            <input type="text" class="form-control" name="kode-pengembalian" placeholder="Kode peminjaman . . ." value="<?= $row['kode_pengembalian']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kode pengajuan</label>
                                            <input type="text" class="form-control" name="kode-pengajuan" placeholder="Kode pengajuan . . ." value="<?= $row['kode_pengajuan']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jumlah pengembalian</label>
                                            <input type="text" class="form-control" name="jumlah-pengembalian" placeholder="Jumlah pengembalian . . ." value="<?= $row['jumlah_pengembalian']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tanggal pengembalian</label>
                                            <input type="date" class="form-control" name="tgl-pengembalian" placeholder="Tanggal pengembalian barang . . ." value="<?= $row['tgl_pengembalian']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Denda</label>
                                            <input type="number" class="form-control" name="denda" placeholder="Denda . . ." value="<?= $row['denda']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Note</label>
                                            <textarea name="note" class="form-control" id="" cols="30" rows="10" placeholder="Note . . ." value="<?= $row['note_pengembalian']; ?>"><?= $row['note_pengembalian']; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select name="status" class="form-control" readonly>
                                                <option value="<?= $row['status']; ?>"><?= $row['status']; ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../model/aksi_admin.php?aksi=logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="../js/jquery-3.5.1.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> -->
    <script src="../js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script> -->
    <script src="../js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
    </script>
</body>
</html>