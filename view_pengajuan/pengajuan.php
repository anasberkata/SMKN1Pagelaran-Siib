<?php
session_start();
include "../templates/header.php";

$pengajuan = query(
    "SELECT * FROM pengajuan
    INNER JOIN users ON pengajuan.id_user = users.id_user"
);
?>

<div class="row mb-4">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Data Pengajuan</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <a href="pengajuan_add.php" class="btn btn-sm btn-info text-white"><i
                                    class="material-icons opacity-10">add</i> Tambah</a>
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
                                    Tanggal Pengajuan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Yang Mengajukan</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            <?php foreach ($pengajuan as $p): ?>
                                <tr>
                                    <td class="text-center text-sm">
                                        <span class="mb-0 text-sm">
                                            <?= $n; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm">
                                            <?= date('d F Y', strtotime($p["tanggal_pengajuan"])); ?>
                                        </h6>
                                    </td>
                                    <td>
                                        <span class="mb-0 text-sm">
                                            <?= $p["nama"]; ?>
                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <a href="pengajuan_detail.php?id_pengajuan=<?= $p["id_pengajuan"] ?>"
                                                class="btn btn-sm btn-primary text-white"><i
                                                    class="material-icons opacity-10">input</i> Input</a>
                                            <a href="pengajuan_edit.php?id_pengajuan=<?= $p["id_pengajuan"] ?>"
                                                class="btn btn-sm btn-info text-white"><i
                                                    class="material-icons opacity-10">edit</i></a>
                                            <a href="pengajuan_delete.php?id_pengajuan=<?= $p["id_pengajuan"] ?>"
                                                class="btn btn-sm btn-danger text-white"
                                                onclick="return confirm('Yakin ingin menghapus <?= $p['tanggal_pengajuan']; ?>?');"><i
                                                    class="material-icons opacity-10">delete</i></a>
                                        </div>
                                    </td>
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