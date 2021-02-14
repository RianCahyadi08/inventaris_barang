<?php
    require '../controller/admin_controller.php';
    $adminController = new AdminController();
?>
<style type="text/css">
    table{
    margin: 20px auto;
    border-collapse: collapse;
    }
    table th,
    table td{
    border: 1px solid #3c3c3c;
    padding: 3px 8px;
    }
</style>
<title>Report pengajuan peminjaman barang</title>
<h2 style="text-align:center;">Report pengajuan peminjaman barang</h2>
<table class="table table-bordered table-hover" id="datatable">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode pengajuan</th>
            <th>Kode barang</th>
            <th>Kode karyawan</th>
            <th>Rencana tanggal peminjaman</th>
            <th>Rencana tanggal pengambilan</th>
            <th>Rencana tanggal pengembalian</th>
            <th>Jumlah</th>
            <th>Note</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $dataPengajuan = $adminController->getPengajuan("kode_pengajuan");
            $no = 1;
            if (is_array($dataPengajuan)):
                foreach ($dataPengajuan['item'] as $key => $row):
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['kode_pengajuan']; ?></td>
            <td><?= $row['kode_barang']; ?></td>
            <td><?= $row['kode_karyawan']; ?></td>
            <td><?= $row['rencana_tgl_peminjaman']; ?></td>
            <td><?= $row['rencana_tgl_pengambilan']; ?></td>
            <td><?= $row['rencana_tgl_pengembalian']; ?></td>
            <td><?= $row['jumlah']; ?></td>
            <td><?= $row['note_pengajuan']; ?></td>
            <td>
                <?php
                    if ($row['status'] == "Wait") {
                        echo "<b style='color: #4e73df;'>$row[status]</b>";
                    } elseif ($row['status'] == "Done") {
                        echo "<b style='color: #1cc88a;'>$row[status]</b>";
                    } elseif ($row['status'] == "On Progress") {
                        echo "<b style='color: #f6c23e;'>$row[status]</b>";
                    }
                ?>
            </td>
        </tr>                         
        <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>
<div style="text-align:right;"><?= date("l jS \of F Y"); ?></div>
<script>
    window.print();
    window.setTimeout(function(){ 
        window.location.replace('../view/dashboard_pengajuan.php');
    } ,2000);
</script>