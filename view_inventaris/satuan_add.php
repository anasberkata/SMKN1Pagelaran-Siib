<?php
session_start();
include "../templates/header.php";

if (isset($_POST["add_satuan"])) {
    if (satuan_add($_POST) > 0) {
        echo "<script>
            alert('Barang berhasil ditambah!');
            document.location.href = 'satuan.php';
          </script>";
    } else {
        echo "<script>
            alert('Barang gagal ditambah!');
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
                        <h6>Tambah Satuan Barang</h6>
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
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Nama Satuan</label>
                                <input type="text" class="form-control" name="satuan" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 mb-2"
                                    name="add_satuan">Tambah</button>
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