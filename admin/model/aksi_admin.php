<?php

    require '../controller/admin_controller.php';
    $adminController = new AdminController();

    $aksi   = $_GET['aksi'];
    switch($aksi) {
        case "login-admin":
            $adminController->loginAdmin();
            break;
        case "logout":
            $adminController->logout();
            break;
        case "tambah-barang":
            $adminController->tambahBarang();
            break;
        case "update-barang":
            $adminController->updateBarang();
            break;
        case "delete-barang":
            $adminController->deleteBarang();
            break;
        // 
        
        case "tambah-karyawan":
            $adminController->tambahKaryawan();
            break;
        case "update-karyawan":
            $adminController->updateKaryawan();
            break;
        case "delete-karyawan":
            $adminController->deleteKaryawan();
            break;

        case "tambah-pengajuan":
            $adminController->tambahPengajuan();
            break;
        case "update-pengajuan":
            $adminController->updatePengajuan();
            break;
        case "delete-pengajuan":
            $adminController->deletePengajuan();
            break;

        case "tambah-pengembalian":
            $adminController->tambahPengembalian();
            break;
        case "update-pengembalian":
            $adminController->updatePengembalian();
            break;
        case "delete-pengembalian":
            $adminController->deletePengembalian();
             break;
    }

?>