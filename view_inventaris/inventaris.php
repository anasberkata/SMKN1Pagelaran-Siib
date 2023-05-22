<?php
session_start();
include "../templates/header.php";

$inventaris = query(
    "SELECT * FROM inventaris
    INNER JOIN kondisi ON inventaris.id_kondisi = kondisi.id_kondisi"
);
?>

<div class="row mb-4">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Daftar Inventaris</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="inventaris_add.php" class="btn btn-sm btn-info text-white"><i
                                class="material-icons opacity-10">add</i> Tambah</a>
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
                                    Kode</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Gambar
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Nama Barang</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Merk</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Qty
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Harga
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Total Harga
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Tahun Perolehan
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Kondisi
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            <?php foreach ($inventaris as $i): ?>
                                <tr>
                                    <td class="text-center text-sm">
                                        <span class="mb-0 text-sm">
                                            <?= $n; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm">
                                            <?= $i["kode"]; ?>
                                        </h6>
                                    </td>
                                    <td>
                                        <span class="mb-0 text-sm">
                                            <img src="../assets/img/barang/<?= $i["gambar"]; ?>" class="img-thumbnail">
                                        </span>
                                    </td>
                                    <td>
                                        <span class="mb-0 text-sm">
                                            <?= $i["nama_barang"]; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="mb-0 text-sm">
                                            <?= $i["merk"]; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="mb-0 text-sm">
                                            <?= $i["qty"]; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="mb-0 text-sm">
                                            Rp.
                                            <?= number_format($i["harga"], 2, ',', '.'); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="mb-0 text-sm">
                                            Rp.
                                            <?= number_format($i["qty"] * $i["harga"], 2, ',', '.'); ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="mb-0 text-sm">
                                            <?= $i["tahun_perolehan"]; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="mb-0 text-sm">
                                            <?= $i["kondisi"]; ?>
                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <a href="inventaris_edit.php?id_inventaris=<?= $i["id_inventaris"] ?>"
                                                class="btn btn-sm btn-info text-white"><i
                                                    class="material-icons opacity-10">edit</i></a>
                                            <a href="inventaris_delete.php?id_inventaris=<?= $i["id_inventaris"] ?>"
                                                class="btn btn-sm btn-danger text-white"
                                                onclick="return confirm('Yakin ingin menghapus <?= $i['nama_barang']; ?>?');"><i
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