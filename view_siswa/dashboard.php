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

$inventaris = query("SELECT * FROM inventaris WHERE NOT qty = 0");

?>


<div class="row mb-4 mx-1">
    <div class="col-12 col-md-6">
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
                                </tr>
                                <?php $n++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-127">
                        <h6>Data Kesediaan Alat / Barang</h6>
                    </div>

                </div>
            </div>
            <div class="card-body pb-3">
                <div class="row">
                    <?php foreach ($inventaris as $i): ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card mb-3">
                                <div class="el-card-item">
                                    <div class="el-card-avatar el-overlay-1">
                                        <img src="../assets/img/barang/<?= $i["gambar"]; ?>" alt="inventaris"
                                            class="img-thumbnail" />
                                    </div>
                                    <div class="el-card-content text-center">
                                        <h4 class="my-2">
                                            <?= $i["nama_barang"]; ?>
                                        </h4>
                                        <p class="small">
                                            Qty :
                                            <?= $i["qty"]; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include "footer.php";
?>