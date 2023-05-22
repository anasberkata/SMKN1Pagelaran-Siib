<?php
session_start();
include "../templates/header.php";

$kondisi = query("SELECT * FROM kondisi");

if (isset($_POST["add_inventaris"])) {
    if (inventaris_add($_POST) > 0) {
        echo "<script>
            alert('Barang berhasil ditambah!');
            document.location.href = 'inventaris.php';
          </script>";
    } else {
        echo "<script>
            alert('Barang gagal ditambah!');
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
                        <h6>Tambah Barang Inventaris</h6>
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
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Kode Barang</label>
                                <input type="text" class="form-control" name="kode" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <input type="file" class="form-control" name="gambar" required>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Merk</label>
                                <input type="text" class="form-control" name="merk" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Qty</label>
                                <input type="number" class="form-control" name="qty" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Harga (Rp.)</label>
                                <input type="number" class="form-control" name="harga" required>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Tahun Perolehan</label>
                                <input type="number" min="2020" max="2100" step="1" class="form-control"
                                    name="tahun_perolehan" required>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <select class="form-select form-control mb-3" name="id_kondisi" required>
                                    <option>Pilih Kondisi</option>
                                    <?php foreach ($kondisi as $k): ?>
                                        <option value="<?= $k["id_kondisi"] ?>"><?= $k["kondisi"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 mb-2"
                                    name="add_inventaris">Tambah</button>
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