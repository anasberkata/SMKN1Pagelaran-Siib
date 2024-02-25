<?php
session_start();
include "../templates/header.php";

$satuan = query(
    "SELECT * FROM satuan"
);
?>

<div class="row mb-4">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Daftar Satuan Barang</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <?php if ($user["role_id"] == 1): ?>
                                <a href="satuan_add.php" class="btn btn-sm btn-info text-white"><i
                                        class="material-icons opacity-10">add</i> Tambah</a>
                            <?php endif; ?>
                            <!-- <a href="satuan_print.php" class="btn btn-sm btn-warning text-white" target="_blank"><i
                                    class="material-icons opacity-10">print</i> Print</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="data-table">
                        <thead>
                            <tr>
                                <th
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                    No.</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Satuan</th>
                                <?php if ($user["role_id"] == 1): ?>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            <?php foreach ($satuan as $s): ?>
                                <tr>
                                    <td class="text-center text-sm">
                                        <span class="mb-0 text-sm">
                                            <?= $n; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm">
                                            <?= $s["satuan"]; ?>
                                        </h6>
                                    </td>
                                    <?php if ($user["role_id"] == 1): ?>
                                        <td class="align-middle text-center">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <a href="satuan_edit.php?id_satuan=<?= $s["id_satuan"] ?>"
                                                    class="btn btn-sm btn-info text-white"><i
                                                        class="material-icons opacity-10">edit</i></a>
                                                <a href="satuan_delete.php?id_satuan=<?= $s["id_satuan"] ?>"
                                                    class="btn btn-sm btn-danger text-white"
                                                    onclick="return confirm('Yakin ingin menghapus <?= $s['nama_barang']; ?>?');"><i
                                                        class="material-icons opacity-10">delete</i></a>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <?php $n++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "../templates/footer.php";
?>