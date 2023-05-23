<?php
session_start();
include "../templates/header.php";

$id_pengajuan = $_GET["id_pengajuan"];

$pengajuan_detail = query(
    "SELECT * FROM pengajuan_detail
    WHERE id_pengajuan = $id_pengajuan"
);

$pengajuan = query(
    "SELECT * FROM pengajuan
    WHERE id_pengajuan = $id_pengajuan"
)[0];

$total_pengajuan = query(
    "SELECT SUM(jumlah) AS amount FROM pengajuan_detail WHERE id_pengajuan = $id_pengajuan"
)[0];
?>

<div class="row mb-4">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Data Detail Pengajuan Tanggal :
                            <?= date('d F Y', strtotime($pengajuan["tanggal_pengajuan"])); ?>
                        </h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <a href="pengajuan.php" class="btn btn-sm btn-primary text-white"><i
                                    class="material-icons opacity-10">arrow_left</i>
                                Kembali</a>
                            <?php if ($user["role_id"] == 1): ?>
                                <a href="pengajuan_detail_add.php?id_pengajuan=<?= $id_pengajuan; ?>"
                                    class="btn btn-sm btn-info text-white"><i class="material-icons opacity-10">add</i>
                                    Tambah</a>
                            <?php endif; ?>
                            <a href="pengajuan_detail_print.php?id_pengajuan=<?= $id_pengajuan; ?>"
                                class="btn btn-sm btn-warning text-white" target="_blank"><i
                                    class="material-icons opacity-10">print</i> Print</a>

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
                                    Nama Barang</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Spesifikasi</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Qty</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Harga</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Jumlah</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Keterangan</th>
                                <?php if ($user["role_id"] == 1): ?>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            <?php foreach ($pengajuan_detail as $pd): ?>
                                <tr>
                                    <td class="text-center text-sm">
                                        <span class="mb-0 text-sm">
                                            <?= $n; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm">
                                            <?= $pd["nama_barang"]; ?>
                                        </h6>
                                    </td>
                                    <td>
                                        <span class="mb-0 text-sm">
                                            <?= $pd["spesifikasi"]; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="mb-0 text-sm">
                                            <?= $pd["qty"]; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="mb-0 text-sm">
                                            Rp.
                                            <?= number_format($pd["harga"], 0, ',', '.'); ?>
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <span class="mb-0 text-sm">Rp.
                                            <?= number_format($pd["jumlah"], 0, ',', '.'); ?>
                                        </span>
                                    </td>
                                    <td class="text-start">
                                        <span class="mb-0 text-sm">
                                            <?= $pd["keterangan"]; ?>
                                        </span>
                                    </td>
                                    <?php if ($user["role_id"] == 1): ?>
                                        <td class="align-middle text-center">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <a href="pengajuan_detail_edit.php?id_pengajuan_detail=<?= $pd["id_pengajuan_detail"] ?>&id_pengajuan=<?= $id_pengajuan ?>"
                                                    class="btn btn-sm btn-info text-white"><i
                                                        class="material-icons opacity-10">edit</i></a>
                                                <a href="pengajuan_detail_delete.php?id_pengajuan_detail=<?= $pd["id_pengajuan_detail"] ?>&id_pengajuan=<?= $id_pengajuan ?>"
                                                    class="btn btn-sm btn-danger text-white"
                                                    onclick="return confirm('Yakin ingin menghapus <?= $pd['nama_barang']; ?>?');"><i
                                                        class="material-icons opacity-10">delete</i></a>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <?php $n++; ?>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="5"
                                    class="mb-0 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-end">
                                    Total</td>
                                <td class="text-end">
                                    <span class="mb-0 text-sm text-bold">Rp.
                                        <?= number_format($total_pengajuan["amount"], 0, ',', '.'); ?>
                                    </span>
                                </td>
                            </tr>
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