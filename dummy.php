<?php

    // $conn = mysqli_connect("localhost", "root", "", "db_kp");

    // $query      = mysqli_query($conn, "SELECT max(kode_karyawan) as kodeTerbesar FROM tbl_karyawan");
    // $data       = mysqli_fetch_array($query);
    // $kode   = $data['kodeTerbesar'];
    // $urutan = (int) substr($kode, 3, 3);
    // $urutan++;
    // $huruf  = "KK";
    // $kode   = $huruf . sprintf("%03s", $urutan);
    // for ($x = 1; $x <= 20; $x++) {
    //     $sql = "INSERT INTO tbl_karyawan (nip, nama, email, password, no_telp, divisi, kode_karyawan) VALUES ('1712100[$x]', 'Nama[$x]', 'email$x@gmail.com', 'sha($x)', '08177952581$x', 'Divisi $x', '$kode[$x]')";
    //     $result = mysqli_query($conn, $sql);

    //     if ($result > 0) {
    //         echo "berhasil !";
    //     } else {
    //         echo "Failed !";
    //         echo mysqli_error($conn);
    //     }
    // }

?>