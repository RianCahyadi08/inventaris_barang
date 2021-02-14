<?php 
	session_start();
	if ($_SESSION == null) {
		header("location:../");
    }
    
    require "../controller/all_controller.php";
	$allController = new AllController();
?>
<!doctype html>
<html lang="en">

<head>
	<title>Dashboard pengembalian</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="../assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="../assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet"> -->
	<!-- ICONS -->
	<!-- <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png"> -->
	<link rel="icon" type="image/png" sizes="96x96" href="../assets/img/logo-wgs.jpeg">
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
	<script src="../assets/js/jquery-3.5.1.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css"> -->
	<link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="dashboard.php"><img src="../assets/img/logo-wgs.jpeg" width="21" height="21" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="../assets/img/user.png" class="img-circle" alt="Avatar"> <span><?= $_SESSION['nama']; ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<!-- <li><a href="#"><i class="lnr lnr-user"></i> <span>Profile</span></a></li> -->
								<!-- <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
								<li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li> -->
								<li><a href="../model/aksi_karyawan.php?aksi=logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="dashboard.php"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="dashboard_barang.php" class="">Data barang</a></li>
									<li><a href="dashboard_pengajuan.php" class="">Data pengajuan</a></li>
									<li><a href="dashboard_pengembalian.php" class="active">Data pengembalian</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->

		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Data pengembalian barang</h3>
							<?php 
							if (isset($_SESSION['message'])): ?>
                           	<div class="alert alert-<?= $_SESSION['message_type']; ?>" id="alert">
                            	<i class="fa fa-check-circle"><?= $_SESSION['message']; ?></i>
                                <?php unset($_SESSION['message']); ?>
                            </div>
                            <?php endif ?>
						</div>
						<div class="panel-body">
                            <!-- <a href="" class="btn btn-primary btn-sm">Tambah</a> -->
                            <!-- <a href="" class="btn btn-success btn-sm">Excel</a><br /><br /> -->
                            <table class="table table-hover" id="example">
								<thead>
									<tr>
                                        <th>No</th>
                                        <th>Kode pengembalian</th>
										<th>Kode pengajuan</th>
                                        <th>Tanggal pengembalian</th>
                                        <th>Jumlah</th>
                                        <th>Denda</th>
                                        <th>Note</th>
                                        <th>Status</th>
                                        <!-- <th><i class="fa fa-cog"></i></th> -->
								    </tr>
								</thead>
								<tbody>
									<?php
										$sess = $_SESSION['kode'];
                                        $dataPengajuan = $allController->getPengembalian("kode_pengajuan", $sess);
										$no = 1;
										if (is_array($dataPengajuan)):
											foreach ($dataPengajuan['item'] as $key => $row):
                                    ?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $row['kode_pengembalian']; ?></td>
										<td><?= $row['kode_pengajuan']; ?></td>
										<td><?= $row['tgl_pengembalian']; ?></td>
										<td><?= $row['jumlah']; ?></td>
										<td>Rp. <?= number_format($row['denda'], 2, ',', '.'); ?></td>
										<td><?= $row['note_pengembalian']; ?></td>
										<td><b style='color: #1cc88a;'><?= $row['status']; ?></b></td>
										</td>
									</tr>
									<?php endforeach ?>
									<?php endif ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<!-- <p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p> -->
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> -->
	<script src="../assets/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap.min.js"></script> -->
	<script src="../assets/js/dataTables.bootstrap.min.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
        $('#alert').ready(function() {
            $('#alert').fadeOut(3000);
        });
    </script>
</body>

</html>
