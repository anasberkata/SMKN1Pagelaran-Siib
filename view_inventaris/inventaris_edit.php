<?php
session_start();
include "../templates/header.php";

$id = $_GET["id_inventaris"];
$i = query(
    "SELECT * FROM inventaris
    INNER JOIN kondisi ON inventaris.id_kondisi = kondisi.id_kondisi
    INNER JOIN satuan ON inventaris.id_satuan = satuan.id_satuan
    WHERE id_inventaris = $id"
)[0];

$kondisi = query("SELECT * FROM kondisi");
$satuan = query("SELECT * FROM satuan");

if (isset($_POST["edit_inventaris"])) {
    if (inventaris_edit($_POST) > 0) {
        echo "<script>
            alert('Barang berhasil diubah!');
            document.location.href = 'inventaris.php';
          </script>";
    } else {
        echo "<script>
            alert('Barang gagal diubah!');
            document.location.href = 'inventaris.php';
          </script>";
    }
}
?>

<div class="row mb-4">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Ubah Barang Inventaris</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="inventaris.php" class="btn btn-sm btn-info text-white"><i
                                class="material-icons opacity-10">arrow_left</i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body pb-4">
                <form role="form" class="text-start" method="POST" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 col-md-6">

                            <input type="hidden" name="id_inventaris" value="<?= $i["id_inventaris"]; ?>">
                            <input type="hidden" name="gambar_lama" value="<?= $i["gambar"]; ?>">

                            <label class="form-label">Kode Barang</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" name="kode" value="<?= $i["kode"]; ?>">
                            </div>

                            <label class="form-label">Gambar Barang</label>
                            <div class="input-group input-group-outline mb-4">
                                <img src="../assets/img/barang/<?= $i["gambar"] ?>" class="img-thumbnail w-20">
                                <input type="file" class="form-control" name="gambar">
                            </div>

                            <label class="form-label">Nama Barang</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" name="nama_barang"
                                    value="<?= $i["nama_barang"]; ?>">
                            </div>

                            <label class="form-label">Merk</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" name="merk" value="<?= $i["merk"]; ?>">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">Qty</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="number" class="form-control" name="qty" value="<?= $i["qty"]; ?>">
                            </div>

                            <label class="form-label">Satuan</label>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-select form-control" name="id_satuan" required>
                                    <option value="<?= $i["id_satuan"]; ?>">
                                        <?= $i["satuan"]; ?>
                                    </option>
                                    <?php foreach ($satuan as $s): ?>
                                        <option value="<?= $s["id_satuan"] ?>">
                                            <?= $s["satuan"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <label class="form-label">Harga Satuan (Rp.)</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="number" class="form-control" name="harga" value="<?= $i["harga"]; ?>">
                            </div>

                            <label class="form-label">Tahun Perolehan</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="number" class="form-control" name="tahun_perolehan"
                                    value="<?= $i["tahun_perolehan"]; ?>">
                            </div>

                            <label class="form-label">Kondisi</label>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-select form-control" name="id_kondisi" required>
                                    <option value="<?= $i["id_kondisi"]; ?>">
                                        <?= $i["kondisi"]; ?>
                                    </option>
                                    <?php foreach ($kondisi as $k): ?>
                                        <option value="<?= $k["id_kondisi"] ?>">
                                            <?= $k["kondisi"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 mb-2"
                                    name="edit_inventaris">Ubah</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include "../templates/footer.php";
?>