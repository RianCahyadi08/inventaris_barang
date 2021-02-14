<?php

    $conn = mysqli_connect("localhost", "root", "", "db_kp");

    class AllController {

        function getMaxKodeKaryawan($column) {
            global $conn;

            $query      = mysqli_query($conn, "SELECT max($column) as kodeTerbesar FROM tbl_karyawan");
            $data       = mysqli_fetch_array($query);
            $kode       = $data['kodeTerbesar'];
    
            $urutan = (int) substr($kode, 3, 3);
    
            $urutan++;
            $huruf = "KK";
            $kode = $huruf . sprintf("%03s", $urutan);
            return $kode;
        }

        function getMaxKodeBarang($column) {
            global $conn;

            $query      = mysqli_query($conn, "SELECT max($column) as kodeTerbesar FROM tbl_barang");
            $data       = mysqli_fetch_array($query);
            $kode       = $data['kodeTerbesar'];
    
            $urutan = (int) substr($kode, 3, 3);
    
            $urutan++;
            $huruf = "KB";
            $kode = $huruf . sprintf("%03s", $urutan);
            return $kode;
        }

        function getMaxKodePengajuan($column) {
            global $conn;

            $query      = mysqli_query($conn, "SELECT max($column) as kodeTerbesar FROM tbl_pengajuan");
            $data       = mysqli_fetch_array($query);
            $kode       = $data['kodeTerbesar'];
    
            $urutan = (int) substr($kode, 3, 3);
    
            $urutan++;
            $huruf = "KP";
            $kode = $huruf . sprintf("%03s", $urutan);
            return $kode;
        }

        function getBarangWhere($id) {
            global $conn;

            $query  = mysqli_query($conn, "SELECT * FROM tbl_barang WHERE id_barang = $id");
            $data   = mysqli_fetch_array($query);

            return $data["kode_barang"];
        }

        function loginKaryawan() {
            session_start();
            global $conn;

            $item = [];
            $dataKaryawan = [
                'email'     => htmlspecialchars($_POST['email']),
                'password'  => htmlspecialchars(sha1($_POST['password']))
            ];

            $sql = "SELECT * FROM tbl_karyawan WHERE email = '$dataKaryawan[email]' AND password = '$dataKaryawan[password]'";
            $result = mysqli_query($conn, $sql);
            $data   = mysqli_fetch_assoc($result);
            $nums   = mysqli_num_rows($result);

            // echo $nums;
            if ($nums > 0) {
                $response = array(
                    $_SESSION['nama']   = $data['nama'],
                    $_SESSION['kode']   = $data['kode_karyawan'],
                    'message'           => "Berhasil login",
                    'message_type'      => "success",
                    'status'            => 200,
                    'item'              => $dataKaryawan
                );
                header("location:../view/dashboard.php");
            } else {
                $response = array(
                'message'   => "Failed",
                'status'    => 400,
                $_SESSION['message']        = "Gagal login, silahkan coba lagi",
                $_SESSION['message_type']   = "danger",
                'item'      => $dataKaryawan
            );
                header("location:../");
            }

            return $response;
            // echo json_encode($response);
        }

        function logout() {
            session_start();
            session_destroy();
            session_unset();
            header("location:../");
        }

        function registrasiKaryawan() {
            session_start();
            global $conn;

            $item = [];
            $dataKaryawan = [
                'nip'           => htmlspecialchars($_POST['nip']),
                'nama'          => htmlspecialchars($_POST['nama']),
                'email'         => htmlspecialchars($_POST['email']),
                'password'      => htmlspecialchars(sha1($_POST['password'])),
                'no_telp'       => htmlspecialchars($_POST['no_telp']),
                'divisi'        => htmlspecialchars($_POST['divisi']),
                'kode_karyawan' => htmlspecialchars($_POST['kode_karyawan'])
            ];
            
            $sql = "INSERT INTO tbl_karyawan (nip, nama, email, password, no_telp, divisi, kode_karyawan) VALUES ('$dataKaryawan[nip]', '$dataKaryawan[nama]', '$dataKaryawan[email]', '$dataKaryawan[password]', '$dataKaryawan[no_telp]', '$dataKaryawan[divisi]', '$dataKaryawan[kode_karyawan]')";
            $result = mysqli_query($conn, $sql);
            // if ($result > 0) {
            //     echo "Success";
            // } else {
            //     echo mysqli_error($conn);
            // }
            if ($result > 0) {
                $response = array(
                    'message'   => "Success",
                    'status'    => 200,
                    $_SESSION['message']        = "Berhasil registrasi, silahkan login",
                    $_SESSION['message_type']   = "success",
                    'item'      => $dataKaryawan
                );
                header("location:../");
            } else {
                $response = array(
                    'message'   => "Failed",
                    'status'    => 400,
                    $_SESSION['message']        = "Gagal registrasi, silahkan coba lagi",
                    $_SESSION['message_type']   = "danger",
                    'item'      => $dataKaryawan
                );
                header("location:../");
            }
            

            // echo json_encode($response);
            // header("location:../");
        }

        function getBarang() {
            global $conn;

            $sql        = "SELECT * FROM tbl_barang ORDER BY kode_barang ASC";
            $result     = mysqli_query($conn, $sql);
            $row        = mysqli_num_rows($result);
            $item       = [];

            if ($row > 0) {
                while ( $data = mysqli_fetch_assoc($result) ) {
                    $item[] = array(
                        'id'                    => $data['id_barang'],
                        'nama_barang'           => $data['nama_barang'],
                        'stok_barang'           => $data['stok_barang'],
                        'deskripsi_barang'      => $data['deskripsi_barang'],
                        'gambar_barang'         => $data['gambar_barang'],
                        'kode_barang'           => $data['kode_barang']
                    );
                }
                $response = array(
                    'message'   => "Success",
                    'status'    => 200,
                    'item'      => $item
                );
            } else {
                $response = array(
                    'message'   => "Failed",
                    'status'    => 400,
                    'item'      => $item
                );
            }

            return $response;
        }

        function getTotalBarang() {
            global $conn;

            $sql        = "SELECT * FROM tbl_barang";
            $result     = mysqli_query($conn, $sql);
            $row        = mysqli_num_rows($result);

            if ($row > 0) {
                return $row;
            }

            return $row;
        }

        function getTotalPengajuan($column) {
            global $conn;

            $sql        = "SELECT * FROM tbl_pengajuan WHERE kode_karyawan = '$column'";
            $result     = mysqli_query($conn, $sql);
            $row        = mysqli_num_rows($result);

            if ($row > 0) {
                return $row;
            }

            return $row;
        }

        function getTotalPengembalian($column, $where) {
            global $conn;

            $sql        = "SELECT * FROM tbl_pengembalian INNER JOIN tbl_pengajuan ON tbl_pengembalian.kode_pengajuan = tbl_pengajuan.kode_pengajuan WHERE tbl_pengajuan.kode_karyawan = '$where'";
            $result     = mysqli_query($conn, $sql);
            $row        = mysqli_num_rows($result);

            if ($row > 0) {
                return $row;
            }

            return $row;
        }

        function pengajuanPeminjaman() {
            session_start();
            global $conn;

            $dataPengajuanPeminjaman = 
            [
                'kode_pengajuan'                    => htmlspecialchars($_POST['kode_pengajuan']),
                'kode_barang'                       => htmlspecialchars($_POST['kode_barang']),
                'kode_karyawan'                     => htmlspecialchars($_POST['kode_karyawan']),
                'rencana_tgl_peminjaman'            => htmlspecialchars($_POST['rencana_tgl_peminjaman']),
                'rencana_tgl_pengambilan'           => htmlspecialchars($_POST['rencana_tgl_pengambilan']),
                'rencana_tgl_pengembalian'          => htmlspecialchars($_POST['rencana_tgl_pengembalian']),
                'jumlah'                            => htmlspecialchars($_POST['jumlah']),
                'note'                              => htmlspecialchars($_POST['note']),
                'status'                            => htmlspecialchars($_POST['status']),
            ];
            
            $sql = "INSERT INTO tbl_pengajuan (kode_pengajuan, kode_barang, kode_karyawan, rencana_tgl_peminjaman, rencana_tgl_pengambilan, rencana_tgl_pengembalian, jumlah, note_pengajuan, status) VALUES ('$dataPengajuanPeminjaman[kode_pengajuan]', '$dataPengajuanPeminjaman[kode_barang]', '$dataPengajuanPeminjaman[kode_karyawan]', '$dataPengajuanPeminjaman[rencana_tgl_peminjaman]', '$dataPengajuanPeminjaman[rencana_tgl_pengambilan]', '$dataPengajuanPeminjaman[rencana_tgl_pengembalian]', '$dataPengajuanPeminjaman[jumlah]', '$dataPengajuanPeminjaman[note]', '$dataPengajuanPeminjaman[status]')";
            $result = mysqli_query($conn, $sql);
            // if ($result > 0) {
            //     echo "Success";
            // } else {
            //     echo mysqli_error($conn);
            // }
            if ($result > 0) {
                $response = array(
                    'message'   => "Success",
                    'status'    => 200,
                    $_SESSION['message']        = "Berhasil mengajukan peminjaman barang",
                    $_SESSION['message_type']   = "success",
                    'item'      => $dataPengajuanPeminjaman
                );
                header("location:../view/dashboard_pengajuan.php");
            } else {
                $response = array(
                    'message'   => "Failed",
                    'status'    => 400,
                    $_SESSION['message']        = "Gagal mengajukan peminjaman barang, silahkan coba lagi",
                    $_SESSION['message_type']   = "danger",
                    'item'      => $dataPengajuanPeminjaman
                );
                header("location:../view/pengajuan.php");
            }            
        }

        function getPengajuan($column, $where) {
            global $conn;

            $sql        = "SELECT * FROM tbl_pengajuan INNER JOIN tbl_barang ON tbl_pengajuan.kode_barang = tbl_barang.kode_barang INNER JOIN tbl_karyawan ON tbl_pengajuan.kode_karyawan = tbl_karyawan.kode_karyawan WHERE tbl_karyawan.kode_karyawan = '$where'";
            $result     = mysqli_query($conn, $sql);
            $row        = mysqli_num_rows($result);
            $item       = [];

            if ($row > 0) {
                while ( $data = mysqli_fetch_assoc($result) ) {
                    $item[] = array(
                        'id'                        => $data['id_pengajuan'],
                        'rencana_tgl_peminjaman'    => $data['rencana_tgl_peminjaman'],
                        'rencana_tgl_pengambilan'   => $data['rencana_tgl_pengambilan'],
                        'rencana_tgl_pengembalian'  => $data['rencana_tgl_pengembalian'],
                        'jumlah'                    => $data['jumlah'],
                        'note_pengajuan'            => $data['note_pengajuan'],
                        'status'                    => $data['status'],
                        'kode_barang'               => $data['kode_barang'],
                        'kode_karyawan'             => $data['kode_karyawan'],
                        'kode_pengajuan'            => $data['kode_pengajuan']
                    );
                }

                $respon = array(
                    'message'   => "Success",
                    'status'    => 200,
                    'item'      => $item
                );
                
                return $respon;

            } else { 
                $respon = array(
                    'message'   => "Failed",
                    'status'    => 400,
                    'item'      => $item
                );

                return $respon;
            }
        }

        // function getPengajuan($param) {
        //     global $conn;

        //     $sql        = "SELECT * FROM tbl_pengajuan WHERE kode_pengajuan = '$param' ORDER BY kode_pengajuan ASC";
        //     $result     = mysqli_query($conn, $sql);
        //     $row        = mysqli_num_rows($result);
        //     $item       = [];

        //     if ($row > 0) {
        //         while ( $data = mysqli_fetch_assoc($result) ) {
        //             $item[] = array(
        //                 'id'                            => $data['id_pengajuan'],
        //                 'rencana_tgl_peminjaman'        => $data['rencana_tgl_peminjaman'],
        //                 'rencana_tgl_pengambilan'       => $data['rencana_tgl_pengambilan'],
        //                 'rencana_tgl_pengembalian'      => $data['rencana_tgl_pengembalian'],
        //                 'jumlah'                        => $data['jumlah'],
        //                 'note'                          => $data['note'],
        //                 'status'                        => $data['status'],
        //                 'kode_pengajuan'                => $data['kode_pengajuan']
        //             );
        //         }
        //         $response = array(
        //             'message'   => "Success",
        //             'status'    => 200,
        //             'item'      => $item
        //         );
        //     } else {
        //         $response = array(
        //             'message'   => "Failed",
        //             'status'    => 400,
        //             'item'      => $item
        //         );
        //     }

        //     return $response;
        // }

        function getPengembalian($column, $where) {
            global $conn;

            $sql        = "SELECT * FROM tbl_pengembalian INNER JOIN tbl_pengajuan ON tbl_pengembalian.kode_pengajuan = tbl_pengajuan.kode_pengajuan WHERE tbl_pengajuan.kode_karyawan = '$where'";
            $result     = mysqli_query($conn, $sql);
            $row        = mysqli_num_rows($result);
            $item       = [];

            if ($row > 0) {
                while ( $data = mysqli_fetch_assoc($result) ) {
                    $item[] = array(
                        'id'                        => $data['id_pengembalian'],
                        'kode_pengembalian'         => $data['kode_pengembalian'],
                        'tgl_pengembalian'          => $data['tgl_pengembalian'],
                        'jumlah'                    => $data['jumlah'],
                        'denda'                     => $data['denda'],
                        'note_pengembalian'         => $data['note_pengembalian'],
                        'status'                    => $data['status'],
                        'kode_pengajuan'            => $data['kode_pengajuan'],
                    );
                }

                $respon = array(
                    'message'   => "Success",
                    'status'    => 200,
                    'item'      => $item
                );
                
                return $respon;

            } else { 
                $respon = array(
                    'message'   => "Failed",
                    'status'    => 400,
                    'item'      => $item
                );

                return $respon;
            }
        }

    }
?>