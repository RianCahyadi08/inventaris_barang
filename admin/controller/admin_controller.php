<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<script src="../js/sweetalert.min.js"></script>
<?php

    $conn = mysqli_connect("localhost", "root", "", "db_kp");

    class AdminController {

        function getTotalTable($table) {
            global $conn;

            $sql        = "SELECT * FROM $table";
            $result     = mysqli_query($conn, $sql);
            $row        = mysqli_num_rows($result);

            if ($row > 0) {
                return $row;
            } elseif ($row == 0) {
                return 0;
            }
        }

        function loginAdmin() {
            session_start();
            global $conn;

            $item = [];
            $dataAdmin = [
                'email'     => htmlspecialchars($_POST['email']),
                'password'  => htmlspecialchars(sha1($_POST['password']))
            ];

            $sql = "SELECT * FROM tbl_admin WHERE email = '$dataAdmin[email]' AND password = '$dataAdmin[password]'";
            $result = mysqli_query($conn, $sql);
            $data   = mysqli_fetch_assoc($result);
            $nums   = mysqli_num_rows($result);

            // echo $nums;
            if ($nums > 0) {
                $response = array(
                    $_SESSION['username']   = $data['username'],
                    'message'           => "Berhasil login",
                    'message_type'      => "success",
                    'status'            => 200,
                    'item'              => $dataAdmin
                );
                echo "
                <script type='text/javascript'>
                    setTimeout(function () { 
                        swal({
                                title: 'Berhasil login',
                                type: 'success',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: true
                            });  
                        },10); 
                        window.setTimeout(function(){ 
                        window.location.replace('../view/dashboard.php');
                    } ,2000); 
                </script>";
            } else {
                $response = array(
                'message'   => "Failed",
                'status'    => 400,
                $_SESSION['message']        = "Gagal login, silahkan coba lagi",
                $_SESSION['message_type']   = "danger",
                'item'      => $dataAdmin
            );
                echo "
                <script type='text/javascript'>
                    setTimeout(function () { 
                        swal({
                                title: 'Gagal login',
                                text: 'email atau password salah, silahkan coba lagi',
                                type: 'failed',
                                icon: 'warning',
                                timer: 2000,
                                showConfirmButton: true
                            });  
                        },10); 
                        window.setTimeout(function(){ 
                        window.location.replace('../');
                    } ,2000); 
                </script>";
            }

            return $response;
        }

        function logout() {
            session_start();
            session_destroy();
            session_unset();
            echo "
                <script type='text/javascript'>
                    setTimeout(function () { 
                            swal({
                                    title: 'Berhasil logout',
                                    type: 'success',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: true
                                });  
                        },10); 
                        window.setTimeout(function(){ 
                        window.location.replace('../');
                    } ,2000); 
                </script>";
        }

        function getMaxKode($table, $column) {
            global $conn;

            $query      = mysqli_query($conn, "SELECT max($column) as kodeTerbesar FROM $table");
            $data       = mysqli_fetch_array($query);
            $kode       = $data['kodeTerbesar'];
    
            $urutan = (int) substr($kode, 3, 3);
    
            $urutan++;

            if ($table == "tbl_barang") {
                $huruf = "KB";
                $kode = $huruf . sprintf("%03s", $urutan);
            } elseif ($table == "tbl_karyawan") {
                $huruf = "KK";
                $kode = $huruf . sprintf("%03s", $urutan);
            } elseif ($table == "tbl_pengajuan") {
                $huruf = "KP";
                $kode = $huruf . sprintf("%03s", $urutan);
            } elseif ($table == "tbl_pengembalian") {
                $huruf = "KP";
                $kode = $huruf . sprintf("%03s", $urutan);
            }

            return $kode;
        }

        function tambahBarang() {
            session_start();

            global $conn;

            $item = [];

            $dataBarang = 
                [
                    'nama_barang'       => htmlspecialchars($_POST['nama-barang']),
                    'stok_barang'       => htmlentities($_POST['stok-barang']),
                    'deskripsi_barang'  => htmlspecialchars($_POST['deskripsi-barang']),
                    'nama_gambar'       => $_FILES['gambar-barang']['name'],
                    'tmp_gambar'        => $_FILES['gambar-barang']['tmp_name'],
                    'size_gambar'       => $_FILES['gambar-barang']['size'],
                    'kode_barang'       => htmlspecialchars($_POST['kode-barang'])
                ];
            
            // var_dump($dataBarang);

            $path = "../../dir/".$dataBarang['nama_gambar'];
            
            if (move_uploaded_file($dataBarang['tmp_gambar'], $path)) {
                $sql        = "INSERT INTO tbl_barang (nama_barang, stok_barang, deskripsi_barang, gambar_barang, kode_barang) VALUES ('$dataBarang[nama_barang]', '$dataBarang[stok_barang]', '$dataBarang[deskripsi_barang]', '$dataBarang[nama_gambar]', '$dataBarang[kode_barang]')";
                $result     = mysqli_query($conn, $sql);
                if ($result > 0){
                    $item       = $dataBarang;
                    echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Success menambah data',
                                        type: 'success',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/dashboard_barang.php');
                            } ,2000); 
                        </script>";
                } else {
                    echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Gagal menambah data',
                                        type: 'failed',
                                        icon: 'warning',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/tambah_barang.php');
                            } ,2000); 
                        </script>";
                }
            } else {
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                            swal({
                                        title: 'Gagal mengupload data',
                                        type: 'failed',
                                        icon: 'warning',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                            },10); 
                            window.setTimeout(function(){ 
                            window.location.replace('../view/tambah_barang.php');
                            } ,2000); 
                        </script>";
            }
        }

        function getBarang($column) {
            global $conn;

            $sql        = "SELECT * FROM tbl_barang ORDER BY $column ASC";
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

            json_encode($respon);
        }

        function getBarangWhere($id) {
            global $conn;

            $sql        = "SELECT * FROM tbl_barang WHERE id_barang = $id";
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

            json_encode($respon);
        }

        function updateBarang() {
            session_start();

            global $conn;

            $item = [];

            $dataBarang = 
                [
                    'id'                => $_POST['id'],
                    'kode_barang'       => $_POST['kode-barang'],
                    'nama_barang'       => htmlspecialchars($_POST['nama-barang']),
                    'stok_barang'       => htmlspecialchars($_POST['stok-barang']),
                    'deskripsi_barang'  => htmlspecialchars($_POST['deskripsi-barang']),
                    'nama_gambar'       => $_FILES['gambar-barang']['name'],
                    'tmp_gambar'        => $_FILES['gambar-barang']['tmp_name'],
                    'size_gambar'       => $_FILES['gambar-barang']['size'],
                    'checkbox'          => isset($_POST['check'])
                ];

            if ( isset($_POST['check']) ) {
                $path = "../../dir/".$dataBarang['nama_gambar'];
                if ( move_uploaded_file($dataBarang['tmp_gambar'], $path) ) {
                    $sql    = "SELECT * FROM tbl_barang WHERE id_barang = '$dataBarang[id]'";
                    $result = mysqli_query($conn, $sql);
                    $data   = mysqli_fetch_assoc($result);
                    if ( is_file("../../dir/".$data['gambar_barang']) ) {
                        unlink("../../dir/".$data['gambar_barang']);
                        $sql    = "UPDATE tbl_barang set nama_barang = '$dataBarang[nama_barang]', stok_barang = '$dataBarang[stok_barang]', deskripsi_barang = '$dataBarang[deskripsi_barang]', gambar_barang = '$dataBarang[nama_gambar]' WHERE id_barang = '$dataBarang[id]'";
                        $result = mysqli_query($conn, $sql);
                        $respon = array(
                            'message'   => "Success",
                            'status'    => 200,
                            $_SESSION['message']        = "Berhasil meng-update data",
                            $_SESSION['message_type']   = "success",
                            'item'      => $dataBarang
                        );
                        echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Success update data',
                                        type: 'success',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/dashboard_barang.php');
                            } ,2000); 
                        </script>";
                    }
                }
            } else {
                $sql    = "UPDATE tbl_barang set nama_barang = '$dataBarang[nama_barang]', stok_barang = '$dataBarang[stok_barang]',  deskripsi_barang = '$dataBarang[deskripsi_barang]' WHERE id_barang = '$dataBarang[id]'";
                $result = mysqli_query($conn, $sql);
                $respon = array(
                    'message'   => "Success",
                    'status'    => 200,
                    $_SESSION['message']        = "Berhasil meng-update data",
                    $_SESSION['message_type']   = "success",
                    'item'      => $dataBarang
                );
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Success update data',
                                        type: 'success',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/dashboard_barang.php');
                            } ,2000); 
                        </script>";
            }
        }

        function deleteBarang()
        {
            session_start();
            
            global $conn;

            $dataBarang = 
                [
                    'id'    => $_GET['id']         
                ];

            $sql    = "SELECT * FROM tbl_barang WHERE id_barang = '$dataBarang[id]'";
            $result = mysqli_query($conn, $sql);
            $data   = mysqli_fetch_assoc($result);

            if (is_file("../../dir/".$data['gambar_barang'])) {
                unlink("../../dir/".$data['gambar_barang']);
                $sql    = "DELETE FROM tbl_barang WHERE id_barang = '$dataBarang[id]'";
                $result = mysqli_query($conn, $sql);
                $respon = array(
                    'message'   => "Success",
                    'status'    => 200,
                    $_SESSION['message']        = "Berhasil menghapus data",
                    $_SESSION['message_type']   = "success",
                    'item'      => $dataBarang
                );
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Success delete data',
                                        type: 'success',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/dashboard_barang.php');
                            } ,2000); 
                        </script>";
            } else {
                $respon = array(
                    'message'   => "Failed",
                    'status'    => 400,
                    'item'      => $dataBarang
                );
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Gagal delete data',
                                        type: 'failed',
                                        icon: 'warning',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/dashboard_barang.php');
                            } ,2000); 
                        </script>";
            }

            json_encode($respon);
        }

        function tambahKaryawan() {
            session_start();
            global $conn;

            $item = [];
            $dataKaryawan = [
                'nip'           => htmlspecialchars($_POST['nip']),
                'nama'          => htmlspecialchars($_POST['nama']),
                'email'         => htmlspecialchars($_POST['email']),
                'password'      => htmlspecialchars(sha1($_POST['password'])),
                'no_telp'       => htmlspecialchars($_POST['no-telp']),
                'divisi'        => htmlspecialchars($_POST['divisi']),
                'kode_karyawan' => htmlspecialchars($_POST['kode-karyawan'])
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
                    $_SESSION['message']        = "Berhasil menambah data",
                    $_SESSION['message_type']   = "success",
                    'item'      => $dataKaryawan
                );
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Success menambah data',
                                        type: 'success',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/dashboard_karyawan.php');
                            } ,2000); 
                        </script>";
            } else {
                $response = array(
                    'message'   => "Failed",
                    'status'    => 400,
                    $_SESSION['message']        = "Gagal menambah data, silahkan coba lagi",
                    $_SESSION['message_type']   = "danger",
                    'item'      => $dataKaryawan
                );
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Gagal menambah data, silahkan coba lagi',
                                        type: 'failed',
                                        icon: 'warning',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/tambah_karyawan.php');
                            } ,2000); 
                        </script>";
            }
            

            // echo json_encode($response);
            // header("location:../");
        }

        function getKaryawan($column) {
            global $conn;

            $sql        = "SELECT * FROM tbl_karyawan ORDER BY $column ASC";
            $result     = mysqli_query($conn, $sql);
            $row        = mysqli_num_rows($result);
            $item       = [];

            if ($row > 0) {
                while ( $data = mysqli_fetch_assoc($result) ) {
                    $item[] = array(
                        'id'                    => $data['id_karyawan'],
                        'kode_karyawan'         => $data['kode_karyawan'],
                        'nip'                   => $data['nip'],
                        'nama'                  => $data['nama'],
                        'email'                 => $data['email'],
                        'password'              => $data['password'],
                        'no_telp'               => $data['no_telp'],
                        'divisi'                => $data['divisi']
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

            json_encode($respon);
        }

        function getkaryawanWhere($id) {
            global $conn;

            $sql        = "SELECT * FROM tbl_karyawan WHERE id_karyawan = $id";
            $result     = mysqli_query($conn, $sql);
            $row        = mysqli_num_rows($result);
            $item       = [];

            if ($row > 0) {
                while ( $data = mysqli_fetch_assoc($result) ) {
                    $item[] = array(
                        'id'                    => $data['id_karyawan'],
                        'kode_karyawan'         => $data['kode_karyawan'],
                        'nip'                   => $data['nip'],
                        'nama'                  => $data['nama'],
                        'email'                 => $data['email'],
                        'password'              => $data['password'],
                        'no_telp'               => $data['no_telp'],
                        'divisi'                => $data['divisi']
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

            json_encode($respon);
        }

        function updateKaryawan() {
            session_start();
            global $conn;

            $item = [];

            $dataKaryawan = 
                [
                    'id'                    => htmlspecialchars($_POST['id']),
                    'kode_karyawan'         => htmlspecialchars($_POST['kode-karyawan']),
                    'nip'                   => htmlspecialchars($_POST['nip']),
                    'nama'                  => htmlspecialchars($_POST['nama']),
                    'email'                 => htmlspecialchars($_POST['email']),
                    'no_telp'               => htmlspecialchars($_POST['no-telp']),
                    'divisi'                => htmlspecialchars($_POST['divisi'])
                ];
            
            $sql = "UPDATE tbl_karyawan SET kode_karyawan = '$dataKaryawan[kode_karyawan]', nip = '$dataKaryawan[nip]', nama = '$dataKaryawan[nama]', email = '$dataKaryawan[email]', no_telp = '$dataKaryawan[no_telp]', divisi = '$dataKaryawan[divisi]' WHERE id_karyawan = '$dataKaryawan[id]'";
            $result = mysqli_query($conn, $sql);
            if ($result > 0) {
                $respon = array(
                    'message'   => "Success",
                    'status'    => 200,
                    'item'      => $item
                );
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Success update data',
                                        type: 'success',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/dashboard_karyawan.php');
                            } ,2000); 
                        </script>";
            } else {
                $respon = array(
                    'message'   => "Failed",
                    'status'    => 400,
                    'item'      => $item
                );
                echo "
                <script type='text/javascript'>
                    setTimeout(function () { 
                        swal({
                                title: 'Gagal update data',
                                type: 'success',
                                icon: 'warning',
                                timer: 2000,
                                showConfirmButton: true
                            });  
                        },10); 
                        window.setTimeout(function(){ 
                        window.location.replace('../view/dashboard_karyawan.php');
                    } ,2000); 
                </script>";
            }
        }

        function deleteKaryawan() {
            session_start();
            
            global $conn;

            $dataKaryawan = 
                [
                    'id'    => $_GET['id']         
                ];

            $sql    = "DELETE FROM tbl_karyawan WHERE id_karyawan = '$dataKaryawan[id]'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $respon = array(
                    'message'   => "Success",
                    'status'    => 200,
                    $_SESSION['message']        = "Berhasil menghapus data",
                    $_SESSION['message_type']   = "success",
                    'item'      => $dataKaryawan
                );
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Success delete data',
                                        type: 'success',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/dashboard_karyawan.php');
                            } ,2000); 
                        </script>";
            } else {
                $respon = array(
                    'message'   => "Failed",
                    'status'    => 400,
                    $_SESSION['message']        = "Gagal menghapus data",
                    $_SESSION['message_type']   = "failed",
                    'item'      => $dataKaryawan
                );
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Gagal delete data',
                                        type: 'success',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/dashboard_karyawan.php');
                            } ,2000); 
                        </script>";
            }
        }

        function getPengajuan($column) {
            global $conn;

            $sql        = "SELECT * FROM tbl_pengajuan INNER JOIN tbl_barang ON tbl_pengajuan.kode_barang = tbl_barang.kode_barang INNER JOIN tbl_karyawan ON tbl_pengajuan.kode_karyawan = tbl_karyawan.kode_karyawan ORDER BY '$column' ASC";
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

        function tambahPengajuan() {
            session_start();
            global $conn;

            $item = [];
            $dataPengajuan = [
                'rencana_tgl_peminjaman'    => htmlspecialchars($_POST['rencana-tgl-peminjaman']),
                'rencana_tgl_pengambilan'   => htmlspecialchars($_POST['rencana-tgl-pengambilan']),
                'rencana_tgl_pengembalian'  => htmlspecialchars($_POST['rencana-tgl-pengembalian']),
                'jumlah'                    => htmlspecialchars($_POST['jumlah']),
                'note'                      => htmlspecialchars($_POST['note']),
                'status'                    => htmlspecialchars($_POST['status']),
                'kode_barang'               => htmlspecialchars($_POST['kode-barang']),
                'kode_karyawan'             => htmlspecialchars($_POST['kode-karyawan']),
                'kode_pengajuan'            => htmlspecialchars($_POST['kode-pengajuan'])
            ];
            
            $sql = "INSERT INTO tbl_pengajuan (rencana_tgl_peminjaman, rencana_tgl_pengambilan, rencana_tgl_pengembalian, jumlah, note_pengajuan, status, kode_barang, kode_karyawan, kode_pengajuan) VALUES ('$dataPengajuan[rencana_tgl_peminjaman]', '$dataPengajuan[rencana_tgl_pengambilan]', '$dataPengajuan[rencana_tgl_pengembalian]', '$dataPengajuan[jumlah]', '$dataPengajuan[note]', '$dataPengajuan[status]', '$dataPengajuan[kode_barang]', '$dataPengajuan[kode_karyawan]', '$dataPengajuan[kode_pengajuan]')";
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
                    $_SESSION['message']        = "Berhasil menambah data",
                    $_SESSION['message_type']   = "success",
                    'item'      => $dataPengajuan
                );
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Success menambah data',
                                        type: 'success',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/dashboard_pengajuan.php');
                            } ,2000); 
                        </script>";
            } else {
                $response = array(
                    'message'   => "Failed",
                    'status'    => 400,
                    $_SESSION['message']        = "Gagal menambah data, silahkan coba lagi",
                    $_SESSION['message_type']   = "danger",
                    'item'      => $dataPengajuan
                );
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Gagal menambah data, silahkan coba lagi',
                                        type: 'failed',
                                        icon: 'warning',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/tambah_karyawan.php');
                            } ,2000); 
                        </script>";
            }
        }

        function getPengajuanWhere($id) {
            global $conn;

            $sql        = "SELECT * FROM tbl_pengajuan WHERE id_pengajuan = $id";
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

            json_encode($respon);
        }

        function updatePengajuan() {
            session_start();
            global $conn;

            $item = [];

            $dataPengajuan = 
                [
                    'id'                        => htmlspecialchars($_POST['id']),
                    'rencana_tgl_peminjaman'    => htmlspecialchars($_POST['rencana-tgl-peminjaman']),
                    'rencana_tgl_pengambilan'   => htmlspecialchars($_POST['rencana-tgl-pengambilan']),
                    'rencana_tgl_pengembalian'  => htmlspecialchars($_POST['rencana-tgl-pengembalian']),
                    'jumlah'                    => htmlspecialchars($_POST['jumlah']),
                    'note'                      => htmlspecialchars($_POST['note']),
                    'status'                    => htmlspecialchars($_POST['status']),
                    'kode_barang'               => htmlspecialchars($_POST['kode-barang']),
                    'kode_karyawan'             => htmlspecialchars($_POST['kode-karyawan']),
                    'kode_pengajuan'            => htmlspecialchars($_POST['kode-pengajuan'])
                ];

            $sql = "UPDATE tbl_pengajuan SET rencana_tgl_peminjaman = '$dataPengajuan[rencana_tgl_peminjaman]', rencana_tgl_pengambilan = '$dataPengajuan[rencana_tgl_pengambilan]', rencana_tgl_pengembalian = '$dataPengajuan[rencana_tgl_pengembalian]', jumlah = '$dataPengajuan[jumlah]', note_pengajuan = '$dataPengajuan[note]', status = '$dataPengajuan[status]' WHERE id_pengajuan = '$dataPengajuan[id]'";
            $result = mysqli_query($conn, $sql);
            if ($result > 0) {
                // echo "berhasil !";
                $respon = array(
                    'message'   => "Success",
                    'status'    => 200,
                    'item'      => $item
                );
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Success update data',
                                        type: 'success',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/dashboard_pengajuan.php');
                            } ,2000); 
                        </script>";
            } else {
                $respon = array(
                    'message'   => "Failed",
                    'status'    => 400,
                    'item'      => $item
                );
                echo "
                <script type='text/javascript'>
                    setTimeout(function () { 
                        swal({
                                title: 'Gagal update data',
                                type: 'success',
                                icon: 'warning',
                                timer: 2000,
                                showConfirmButton: true
                            });  
                        },10); 
                        window.setTimeout(function(){ 
                        window.location.replace('../view/dashboard_pengajuan.php');
                    } ,2000); 
                </script>";
            }
        }

        function deletePengajuan() {
            session_start();
            
            global $conn;

            $dataPengajuan = 
                [
                    'id'    => $_GET['id']         
                ];

            $sql    = "DELETE FROM tbl_pengajuan WHERE id_pengajuan = '$dataPengajuan[id]'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $respon = array(
                    'message'   => "Success",
                    'status'    => 200,
                    $_SESSION['message']        = "Berhasil menghapus data",
                    $_SESSION['message_type']   = "success",
                    'item'      => $dataPengajuan
                );
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Success delete data',
                                        type: 'success',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/dashboard_pengajuan.php');
                            } ,2000); 
                        </script>";
            } else {
                $respon = array(
                    'message'   => "Failed",
                    'status'    => 400,
                    $_SESSION['message']        = "Gagal menghapus data",
                    $_SESSION['message_type']   = "failed",
                    'item'      => $dataPengajuan
                );
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Gagal delete data',
                                        type: 'failed',
                                        icon: 'warning',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/dashboard_pengajuan.php');
                            } ,2000); 
                        </script>";
            }
        }

        function getPengembalian($column) {
            global $conn;

            $sql        = "SELECT * FROM tbl_pengembalian ORDER BY $column ASC";
            $result     = mysqli_query($conn, $sql);
            $row        = mysqli_num_rows($result);
            $item       = [];

            if ($row > 0) {
                while ( $data = mysqli_fetch_assoc($result) ) {
                    $item[] = array(
                        'id'                    => $data['id_pengembalian'],
                        'jumlah_pengembalian'   => $data['jumlah'],
                        'tgl_pengembalian'      => $data['tgl_pengembalian'],
                        'denda'                 => $data['denda'],
                        'note_pengembalian'     => $data['note_pengembalian'],
                        'status'                => $data['status'],
                        'kode_pengajuan'        => $data['kode_pengajuan'],
                        'kode_pengembalian'     => $data['kode_pengembalian']
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

            json_encode($respon);
        }

        function tambahPengembalian() {
            session_start();
            global $conn;

            $item = [];
            $dataPengembalian = [
                'kode_pengembalian'     => htmlspecialchars($_POST['kode-pengembalian']),
                'jumlah_pengembalian'   => htmlspecialchars($_POST['jumlah-pengembalian']),
                'tgl_pengembalian'      => htmlspecialchars($_POST['tgl-pengembalian']),
                'denda'                 => htmlspecialchars($_POST['denda']),
                'note'                  => htmlspecialchars($_POST['note']),
                'status'                => htmlspecialchars($_POST['status']),
                'kode_pengajuan'        => htmlspecialchars($_POST['kode-pengajuan']),
            ];
            
            $sql = "INSERT INTO tbl_pengembalian (kode_pengembalian, jumlah, tgl_pengembalian, denda, note_pengembalian, status, kode_pengajuan) VALUES ('$dataPengembalian[kode_pengembalian]', $dataPengembalian[jumlah_pengembalian] , '$dataPengembalian[tgl_pengembalian]', '$dataPengembalian[denda]', '$dataPengembalian[note]', '$dataPengembalian[status]', '$dataPengembalian[kode_pengajuan]')";
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
                    $_SESSION['message']        = "Berhasil menambah data",
                    $_SESSION['message_type']   = "success",
                    'item'      => $dataPengembalian
                );
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Success menambah data',
                                        type: 'success',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/dashboard_pengembalian.php');
                            } ,2000); 
                        </script>";
            } else {
                echo mysqli_error($conn);
                // $response = array(
                //     'message'   => "Failed",
                //     'status'    => 400,
                //     $_SESSION['message']        = "Gagal menambah data, silahkan coba lagi",
                //     $_SESSION['message_type']   = "danger",
                //     'item'      => $dataPengembalian
                // );
                // echo "
                //         <script type='text/javascript'>
                //             setTimeout(function () { 
                //                 swal({
                //                         title: 'Gagal menambah data, silahkan coba lagi',
                //                         type: 'failed',
                //                         icon: 'warning',
                //                         timer: 2000,
                //                         showConfirmButton: true
                //                     });  
                //                 },10); 
                //                 window.setTimeout(function(){ 
                //                 window.location.replace('../view/tambah_pengembalian.php');
                //             } ,2000); 
                //         </script>";
            }
            

            // echo json_encode($response);
            // header("location:../");
        }

        function getPengembalianWhere($id) {
            global $conn;

            $sql        = "SELECT * FROM tbl_pengembalian WHERE id_pengembalian = $id";
            $result     = mysqli_query($conn, $sql);
            $row        = mysqli_num_rows($result);
            $item       = [];

            if ($row > 0) {
                while ( $data = mysqli_fetch_assoc($result) ) {
                    $item[] = array(
                        'id'                    => $data['id_pengembalian'],
                        'jumlah_pengembalian'   => $data['jumlah'],
                        'tgl_pengembalian'      => $data['tgl_pengembalian'],
                        'denda'                 => $data['denda'],
                        'note_pengembalian'     => $data['note_pengembalian'],
                        'status'                => $data['status'],
                        'kode_pengajuan'        => $data['kode_pengajuan'],
                        'kode_pengembalian'     => $data['kode_pengembalian']
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

            json_encode($respon);
        }

        function updatePengembalian() {
            session_start();
            global $conn;

            $item = [];

            $dataPengembalian = 
                [
                    'id'                    => htmlspecialchars($_POST['id']),
                    'jumlah_pengembalian'   => htmlspecialchars($_POST['jumlah-pengembalian']),
                    'kode_pengembalian'     => htmlspecialchars($_POST['kode-pengembalian']),
                    'tgl_pengembalian'      => htmlspecialchars($_POST['tgl-pengembalian']),
                    'denda'                 => htmlspecialchars($_POST['denda']),
                    'note'                  => htmlspecialchars($_POST['note']),
                    'status'                => htmlspecialchars($_POST['status']),
                    'kode_pengajuan'        => htmlspecialchars($_POST['kode-pengajuan'])
                ];
            
            $sql = "UPDATE tbl_pengembalian SET kode_pengembalian = '$dataPengembalian[kode_pengembalian]', jumlah = '$dataPengembalian[jumlah_pengembalian]', tgl_pengembalian = '$dataPengembalian[tgl_pengembalian]', denda = '$dataPengembalian[denda]', note_pengembalian = '$dataPengembalian[note]', status = '$dataPengembalian[status]', kode_pengajuan = '$dataPengembalian[kode_pengajuan]' WHERE id_pengembalian = '$dataPengembalian[id]'";
            $result = mysqli_query($conn, $sql);
            if ($result > 0) {
                $respon = array(
                    'message'   => "Success",
                    'status'    => 200,
                    'item'      => $item
                );
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Success update data',
                                        type: 'success',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/dashboard_pengembalian.php');
                            } ,2000); 
                        </script>";
            } else {
                $respon = array(
                    'message'   => "Failed",
                    'status'    => 400,
                    'item'      => $item
                );
                echo "
                <script type='text/javascript'>
                    setTimeout(function () { 
                        swal({
                                title: 'Gagal update data',
                                type: 'success',
                                icon: 'warning',
                                timer: 2000,
                                showConfirmButton: true
                            });  
                        },10); 
                        window.setTimeout(function(){ 
                        window.location.replace('../view/dashboard_pengembalian.php');
                    } ,2000); 
                </script>";
            }
        }

        function deletePengembalian() {
            session_start();
            
            global $conn;

            $dataPengembalian = 
                [
                    'id'    => $_GET['id']         
                ];

            $sql    = "DELETE FROM tbl_pengembalian WHERE id_pengembalian = '$dataPengembalian[id]'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $respon = array(
                    'message'   => "Success",
                    'status'    => 200,
                    $_SESSION['message']        = "Berhasil menghapus data",
                    $_SESSION['message_type']   = "success",
                    'item'      => $dataPengembalian
                );
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Success delete data',
                                        type: 'success',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/dashboard_pengembalian.php');
                            } ,2000); 
                        </script>";
            } else {
                $respon = array(
                    'message'   => "Failed",
                    'status'    => 400,
                    $_SESSION['message']        = "Gagal menghapus data",
                    $_SESSION['message_type']   = "failed",
                    'item'      => $dataPengembalian
                );
                echo "
                        <script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                        title: 'Gagal delete data',
                                        type: 'failed',
                                        icon: 'warning',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });  
                                },10); 
                                window.setTimeout(function(){ 
                                window.location.replace('../view/dashboard_pengembalian.php');
                            } ,2000); 
                        </script>";
            }
        }

    }
?>
