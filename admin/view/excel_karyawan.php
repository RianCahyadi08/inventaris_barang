<?php
    require '../controller/admin_controller.php';
    $adminController = new AdminController();
?>
<table class="table table-hover" id="datatable">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode karyawan</th>
            <th>Nip</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No telp</th>
            <th>Divisi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $dataKaryawan = $adminController->getKaryawan("kode_karyawan");
            $no = 1;
            if (is_array($dataKaryawan)):
                foreach ($dataKaryawan['item'] as $key => $row):
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['kode_karyawan']; ?></td>
            <td><?= $row['nip']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['no_telp']; ?></td>
            <td><?= $row['divisi']; ?></td>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
        </tbody>
    </table>