<?php

    require '../controller/all_controller.php';
    $allController = new AllController();

    $aksi = $_GET['aksi'];
    switch ($aksi) {
        case "login-karyawan":
            $allController->loginKaryawan();
            // header("location../view/dashboard.php");
            break;
        case "registrasi-karyawan":
            $allController->registrasiKaryawan();
            break;
        case "pengajuan-peminjaman":
            $allController->pengajuanPeminjaman();
            break;
        case "logout":
            $allController->logout();
            break;
    }

?>