<?php
session_start();
include "header.php";

$id_peminjam = $user["id_user"];

$peminjaman = query(
    "SELECT peminjaman.*, petugas.nama AS nama_petugas, peminjam.nama AS nama_peminjam 
    FROM peminjaman
    INNER JOIN users AS petugas ON peminjaman.id_petugas = petugas.id_user
    INNER JOIN users AS peminjam ON peminjaman.id_peminjam = peminjam.id_user
    WHERE id_peminjam = $id_peminjam"
);

?>


<div class="row mb-4 mx-1">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Data Peminjaman</h6>
                    </div>

                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <a href="peminjaman_add.php" class="btn btn-sm btn-info text-white"><i
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
                                    Nama Peminjam</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Tanggal Peminjaman</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Tanggal Pengembalian</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Petugas</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            <?php foreach ($peminjaman as $p): ?>
                                <tr>
                                    <td class="text-center text-sm">
                                        <span class="mb-0 text-sm">
                                            <?= $n; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm">
                                            <?= $p["nama_peminjam"]; ?>
                                        </h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm">
                                            <?= date('d F Y', strtotime($p["tanggal_peminjaman"])); ?>
                                        </h6>
                                        <p class="text-sm mt-2">
                                            Status :
                                            <br>
                                            <span>
                                                <?php if ($p["approve"] == 1): ?>
                                                    <span class="badge bg-success">Approve</span>
                                                <?php elseif ($p["approve"] == 2): ?>
                                                    <span class="badge bg-warning">Belum Approve</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">Ditolak</span>
                                                <?php endif; ?>
                                            </span>
                                        </p>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm">
                                            <?= date('d F Y', strtotime($p["tanggal_pengembalian"])); ?>
                                        </h6>
                                        <p class="text-sm mt-2">
                                            Status :
                                            <br>
                                            <span>
                                                <?php if ($p["status_peminjaman"] == 1): ?>
                                                    <span class="badge bg-success">Sudah Dikembalikan</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">Belum Dikembalikan</span>
                                                <?php endif; ?>
                                            </span>
                                        </p>
                                    </td>
                                    <td>
                                        <span class="mb-0 text-sm">
                                            <?= $p["nama_petugas"]; ?>
                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="btn-group btn-group-toggle mt-3" data-toggle="buttons">
                                            <a href="peminjaman_detail.php?id_peminjaman=<?= $p["id_peminjaman"] ?>"
                                                class="btn btn-sm btn-primary text-white">Input</a>
                                            <a href="peminjaman_edit.php?id_peminjaman=<?= $p["id_peminjaman"] ?>"
                                                class="btn btn-sm btn-info text-white"><i
                                                    class="material-icons opacity-10">edit</i></a>
                                            <a href="peminjaman_detail_print.php?id_peminjaman=<?= $p["id_peminjaman"] ?>"
                                                class="btn btn-sm btn-warning text-white" target="_blank"><i
                                                    class="material-icons opacity-10">print</i> Print</a>
                                            <!-- <a href="peminjaman_delete.php?id_peminjaman=<?= $p["id_peminjaman"] ?>"
                                                    class="btn btn-sm btn-danger text-white"
                                                    onclick="return confirm('Yakin ingin menghapus <?= $p['tanggal_peminjaman']; ?> peminjam <?= $p['nama_peminjam']; ?>?');"><i
                                                        class="material-icons opacity-10">delete</i></a> -->
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
include "footer.php";
?>