<?php

    $report = $_GET['report'];

    switch($report) {
        case "excel-barang":
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Data Barang.xls");
            include "excel_barang.php";
            break;
        case "excel-pengajuan":
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Data Pengajuan.xls");
            include "excel_pengajuan.php";
            break;
        case "excel-pengembalian":
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Data Pengembalian.xls");
            include "excel_pengembalian.php";
        break;
        case "excel-karyawan":
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Data Karyawan.xls");
            include "excel_karyawan.php";
        break;
        case "pdf-pengajuan":
            include "pdf_pengajuan.php";
        break;
    }

?>