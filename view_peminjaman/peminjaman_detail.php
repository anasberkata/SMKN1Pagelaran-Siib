<?php
session_start();
include "../templates/header.php";

$id_peminjaman = $_GET["id_peminjaman"];

$peminjaman_detail = query(
    "SELECT * FROM peminjaman_detail
    INNER JOIN inventaris ON peminjaman_detail.id_inventaris = inventaris.id_inventaris
    WHERE id_peminjaman = $id_peminjaman"
);

$peminjaman = query(
    "SELECT * FROM peminjaman
    INNER JOIN users ON peminjaman.id_peminjam = users.id_user
    WHERE id_peminjaman = $id_peminjaman"
)[0];
?>

<div class="row mb-4">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-12 mb-3">
                        <ul class="list-group">
                            <li class="list-group-item active" aria-current="true">
                                <h6 class="text-white">Detail Data Peminjaman Alat & Bahan</h6>
                            </li>
                            <li class="list-group-item">
                                <b>
                                    <?= $peminjaman["nama"] ?>
                                </b>
                            </li>
                            <li class="list-group-item">
                                Tanggal Peminjaman :
                                <?= date('d F Y', strtotime($peminjaman["tanggal_peminjaman"])); ?>
                            </li>
                            <li class="list-group-item">
                                Tanggal Pengembalian :
                                <?= date('d F Y', strtotime($peminjaman["tanggal_pengembalian"])); ?>
                            </li>
                            <li class="list-group-item">
                                Status :
                                <br>
                                <a href="peminjaman_approve.php?id_peminjaman=<?= $peminjaman["id_peminjaman"] ?>">
                                    <?php if ($peminjaman["approve"] == 1): ?>
                                        <span class="btn btn-success btn-sm mt-3">Approve</span>
                                    <?php elseif ($peminjaman["approve"] == 2): ?>
                                        <span class="btn btn-warning btn-sm mt-3">Belum Approve</span>
                                    <?php else: ?>
                                        <span class="btn btn-danger btn-sm mt-3">Ditolak</span>
                                    <?php endif; ?>
                                </a>
                                |

                                <a href="peminjaman_status.php?id_peminjaman=<?= $peminjaman["id_peminjaman"] ?>">
                                    <?php if ($peminjaman["status_peminjaman"] == 1): ?>
                                        <span class="btn btn-success btn-sm mt-3">Sudah Dikembalikan</span>
                                    <?php else: ?>
                                        <span class="btn btn-danger btn-sm mt-3">Belum Dikembalikan</span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-12 my-auto text-end">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <a href="peminjaman.php" class="btn btn-sm btn-primary text-white"><i
                                    class="material-icons opacity-10">arrow_left</i>
                                Kembali</a>
                            <?php if ($user["role_id"] == 1): ?>
                                <a href="peminjaman_detail_add.php?id_peminjaman=<?= $id_peminjaman; ?>"
                                    class="btn btn-sm btn-info text-white"><i class="material-icons opacity-10">add</i>
                                    Tambah</a>
                            <?php endif; ?>
                            <a href="peminjaman_detail_print.php?id_peminjaman=<?= $id_peminjaman; ?>"
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
                                <?php if ($user["role_id"] == 1): ?>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            <?php foreach ($peminjaman_detail as $pd): ?>
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
                                            <?= $pd["merk"]; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="mb-0 text-sm">
                                            <?= $pd["qty_peminjaman"]; ?>
                                        </span>
                                    </td>
                                    <?php if ($user["role_id"] == 1): ?>
                                        <td class="align-middle text-center">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <a href="peminjaman_detail_edit.php?id_peminjaman_detail=<?= $pd["id_peminjaman_detail"] ?>&id_peminjaman=<?= $id_peminjaman ?>"
                                                    class="btn btn-sm btn-info text-white"><i
                                                        class="material-icons opacity-10">edit</i></a>
                                                <a href="peminjaman_detail_delete.php?id_peminjaman_detail=<?= $pd["id_peminjaman_detail"] ?>&id_peminjaman=<?= $id_peminjaman ?>"
                                                    class="btn btn-sm btn-danger text-white"
                                                    onclick="return confirm('Yakin ingin menghapus <?= $pd['nama_barang']; ?>?');"><i
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