<?php
session_start();
include "../templates/header.php";

$id = $_GET["id_satuan"];
$i = query(
    "SELECT * FROM satuan
    WHERE id_satuan = $id"
)[0];

if (isset($_POST["edit_satuan"])) {
    if (satuan_edit($_POST) > 0) {
        echo "<script>
            alert('Barang berhasil diubah!');
            document.location.href = 'satuan.php';
          </script>";
    } else {
        echo "<script>
            alert('Barang gagal diubah!');
            document.location.href = 'satuan.php';
          </script>";
    }
}
?>

<div class="row mb-4">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Ubah Satuan Barang</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="satuan.php" class="btn btn-sm btn-info text-white"><i
                                class="material-icons opacity-10">arrow_left</i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body pb-4">
                <form role="form" class="text-start" method="POST" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 col-md-12">

                            <input type="hidden" name="id_satuan" value="<?= $i["id_satuan"]; ?>">

                            <label class="form-label">Kode Barang</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" name="satuan" value="<?= $i["satuan"]; ?>">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 mb-2"
                                    name="edit_satuan">Ubah</button>
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