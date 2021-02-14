<?php 
	require "../controller/all_controller.php";
	$allController = new AllController();
?>
<!doctype html>
<html lang="en" class="fullscreen-bg">
<head>
	<title>Registrasi karyawan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="../assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet"> -->
	<!-- ICONS -->
	<!-- <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png"> -->
	<!-- <link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png"> -->
	<link rel="icon" type="image/png" sizes="96x96" href="../assets/img/logo-wgs.jpeg">
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
	<link rel="stylesheet" href="../assets/css/jquery-ui.css">
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
	<script src="../assets/js/jquery-1.12.4.js"></script>
    <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
	<script src="../assets/js/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#tgl-lahir" ).datepicker();
            }  
        );
  </script>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
	    <div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<p class="lead">Registrasi</p>
							</div>
							<form class="form-auth-small" action="../model/aksi_karyawan.php?aksi=registrasi-karyawan" method="POST">
								<div class="form-group">
									<label for="nip" class="control-label sr-only">Nip</label>
									<input type="number" class="form-control" name="nip" placeholder="Masukan nip anda . . ." required>
								</div>
                                <div class="form-group">
									<label for="nama" class="control-label sr-only">Nama</label>
									<input type="text" class="form-control" name="nama" placeholder="Masukan nama anda . . ." required>
								</div>
                                <div class="form-group">
									<label for="email" class="control-label sr-only">Email</label>
									<input type="email" class="form-control" name="email" placeholder="Masukan email anda . . ." required>
								</div>
                                <div class="form-group">
									<label for="password" class="control-label sr-only">Password</label>
									<input type="password" class="form-control" name="password" placeholder="Masukan password anda . . ." required>
								</div>
                                <div class="form-group">
									<label for="no_telp" class="control-label sr-only">No telp</label>
									<input type="number" class="form-control" name="no_telp" placeholder="Masukan no telepon anda . . ." required>
								</div>
                                <div class="form-group">
									<label for="divisi" class="control-label sr-only">Divisi</label>
									<input type="text" class="form-control" name="divisi" placeholder="Masukan divisi anda . . ." required>
								</div>
                                <div class="form-group">
									<label for="kode_karyawan" class="control-label sr-only">Kode karyawan</label>
									<input type="hidden" class="form-control" name="kode_karyawan" value="<?= $allController->getMaxKodeKaryawan("kode_karyawan"); ?>" placeholder="Kode karyawan anda . . .">
								</div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">REGISTRASI</button>
                                </div>
                                <div class="bottom">
									<span class="helper-text"><i class="lnr lnr-home"></i> <a href="../index.php">Kembali login</a></span>
								</div>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Inventaris barang</h1>
							<p>Anonymous</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
