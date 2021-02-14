<?php
    require '../controller/admin_controller.php';
    $adminController = new AdminController();
?>
<table class="table table-hover" id="datatable">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode barang</th>
            <th>Nama barang</th>
            <th>stok barang</th>
            <th>deskripsi barang</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $dataBarang = $adminController->getBarang("kode_barang");
            $no = 1;
            if (is_array($dataBarang)):
                foreach ($dataBarang['item'] as $key => $row):
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['kode_barang']; ?></td>
            <td><?= $row['nama_barang']; ?></td>
            <td><?= $row['stok_barang']; ?></td>
            <td><?= $row['deskripsi_barang']; ?></td>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
        </tbody>
    </table>