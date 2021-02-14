<?php 
	session_start();
	if ($_SESSION == null) {
		header("location:../");
    }
    
    require "../controller/all_controller.php";
	$allController = new AllController();

	$id 	= $_GET['id'];
	$kode 	= $_SESSION['kode']; 
?>
<!doctype html>
<html lang="en">

<head>
	<title>Pengajuan</title>
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
	<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
	<link rel="stylesheet" href="../assets/css/jquery-ui.css">
	<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
	<script src="../assets/js/jquery-1.12.4.js"></script>
	<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
	<script src="../assets/js/jquery-ui.js"></script>
	<script>

		$(function(){
			$( "#tgl-peminjaman" ).datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				changeMonth: true,
				changeYear: true,
				showButtonPanel: true,
				dateFormat: 'yy-mm-dd',
				minDate: 0
			});
		});
		$(function(){
			$( "#tgl-pengambilan" ).datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				changeMonth: true,
				changeYear: true,
				showButtonPanel: true,
				dateFormat: 'yy-mm-dd',
				minDate: 0
			});
		});
		$(function(){
			$( "#tgl-pengembalian" ).datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				changeMonth: true,
				changeYear: true,
				showButtonPanel: true,
				dateFormat: 'yy-mm-dd',
				minDate: 0
			});
		});
	</script>
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
									<li><a href="dashboard_pengajuan.php" class="active">Data pengajuan</a></li>
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
							<h3 class="panel-title">Pengajuan peminjaman barang</h3>
						</div>
                        <style>
                            .form-group {
                                width: 40%;
                            }
                        </style>
						<div class="panel-body">
                            <form action="../model/aksi_karyawan.php?aksi=pengajuan-peminjaman" method="post">
								<div class="form-group">
									<span>Kode pengajuan</span>
									<input type="text" name="kode_pengajuan" class="form-control" placeholder="Kode pengajuan . . ." value="<?= $allController->getMaxKodePengajuan("kode_pengajuan"); ?>" readonly>
								</div>
								<div class="form-group">
									<span>Kode barang</span>
									<input type="text" name="kode_barang" class="form-control" placeholder="Kode barang . . ." value="<?= $allController->getBarangWhere($id); ?>" readonly>
								</div>
								<div class="form-group">
									<span>Kode karyawan</span>
									<input type="text" name="kode_karyawan" class="form-control" placeholder="Kode karyawan . . ." value="<?= $kode; ?>" readonly>
								</div>
                                <div class="form-group">
                                    <span>Rencana tanggal peminjaman</span>
                                    <input type="text" class="form-control" id="tgl-peminjaman" name="rencana_tgl_peminjaman" placeholder="Rencana tanggal peminjaman . . ." autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <span>Rencana tanggal pengambilan</span>
                                    <input type="text" class="form-control" id="tgl-pengambilan" name="rencana_tgl_pengambilan" placeholder="Rencana tanggal pengambilan . . ." autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <span>Rencana tanggal pengembalian</span>
                                    <input type="text" class="form-control" id="tgl-pengembalian" name="rencana_tgl_pengembalian" placeholder="Rencana tanggal pengembalian . . ." autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <span>Jumlah</span>
                                    <input type="number" class="form-control" id="datepicker" name="jumlah" placeholder="Jumlah yang dipinjam . . .">
                                </div>
                                <div class="form-group">
                                    <span>Note</span>
									<textarea name="note" class="form-control" cols="30" rows="10" placeholder="Note . . ."></textarea>
                                </div>
                                <div class="form-group">
                                    <span>Status</span>
                                    <input type="text" class="form-control" name="status" placeholder="Status peminjaman . . ." value="Wait" readonly>
                                </div>
								<div class="form-group">
									<button class="btn btn-primary btn-lg">Simpan</button>
								</div>
                            </form>
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
	<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
</body>

</html>
