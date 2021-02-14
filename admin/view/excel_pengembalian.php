<?php
    require '../controller/admin_controller.php';
    $adminController = new AdminController();
?>
<table class="table table-hover" id="datatable">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode pengembalian</th>
            <th>Kode pengajuan</th>
            <th>Tanggal pengembalian</th>
            <th>Denda</th>
            <th>Note</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $dataPengembalian = $adminController->getPengembalian("kode_pengembalian");
            $no = 1;
            if (is_array($dataPengembalian)):
                foreach ($dataPengembalian['item'] as $key => $row):
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['kode_pengembalian']; ?></td>
            <td><?= $row['kode_pengajuan']; ?></td>
            <td><?= $row['tgl_pengembalian']; ?></td>
            <td>Rp. <?= number_format($row['denda'], 2, ',', '.'); ?></td>
            <td><?= $row['note_pengembalian']; ?></td>
            <td><b style='color: #1cc88a;'><?= $row['status']; ?></b></td>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
        </tbody>
    </table>