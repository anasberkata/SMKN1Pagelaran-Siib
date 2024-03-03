<?php
session_start();
include "../templates/header.php";

$id_peminjaman = $_GET["id_peminjaman"];
$peminjaman = query(
    "SELECT * FROM peminjaman
    INNER JOIN users ON peminjaman.id_peminjam = users.id_user
    WHERE id_peminjaman = $id_peminjaman"
)[0];

$peminjaman_detail = query(
    "SELECT * FROM peminjaman_detail
    INNER JOIN inventaris ON peminjaman_detail.id_inventaris = inventaris.id_inventaris
    WHERE id_peminjaman = $id_peminjaman"
);

if (isset($_POST["save_status_pengembalian"])) {

    if (status_pengembalian_save($_POST) > 0) {
        echo "<script>
            alert('Data pengembalian berhasil diubah!');
            document.location.href = 'peminjaman.php';
          </script>";
    } else {
        echo "<script>
            alert('Data pengembalian gagal diubah!');
            document.location.href = 'peminjaman.php';
          </script>";
    }
}
?>

<div class="row mb-4">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-12 mb-3">
                        <h5>Halaman Pengambalian</h5>
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
                        </ul>
                    </div>
                    <div class="col-lg-6 col-12 my-auto text-end">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <a href="peminjaman.php" class="btn btn-sm btn-primary text-white"><i
                                    class="material-icons opacity-10">arrow_left</i>
                                Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pb-2">
                <div class="row">
                    <div class="col-12">
                        <form role="form" class="text-start" method="POST" action="" enctype="multipart/form-data">

                            <input type="hidden" value="<?= $id_peminjaman ?>" name="id_peminjaman" />
                            <input type="hidden" value="1" name="status_pengembalian" />

                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                No.</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama Barang</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Spesifikasi</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Qty Peminjaman</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Qty Pengembalian</th>
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
                                                <td>
                                                    <span class="mb-0 text-sm">
                                                        <label class="form-label">Qty Pengembalian</label>
                                                        <div class="input-group input-group-outline mb-3">
                                                            <input type="number" class="form-control"
                                                                name="qty_pengembalian<?= $pd["id_inventaris"]; ?>"
                                                                required>
                                                        </div>
                                                    </span>
                                                </td>
                                            </tr>

                                            <input type="hidden" value="<?= $pd["id_inventaris"]; ?>"
                                                name="id_inventaris<?= $pd["id_inventaris"]; ?>" />

                                            <?php $n++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-start mt-3">
                                <button type="submit" class="btn bg-gradient-primary mb-2"
                                    name="save_status_pengembalian">Barang Dikembalikan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "../templates/footer.php";
?>