<?php
session_start();
include "../templates/header.php";

$id = $_GET["id_pengajuan"];
$p = query(
    "SELECT * FROM pengajuan
    WHERE id_pengajuan = $id"
)[0];

if (isset($_POST["edit_pengajuan"])) {
    if (pengajuan_edit($_POST) > 0) {
        echo "<script>
            alert('Pengajuan berhasil diubah!');
            document.location.href = 'pengajuan.php';
          </script>";
    } else {
        echo "<script>
            alert('Pengajuan gagal diubah!');
            document.location.href = 'pengajuan.php';
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
                        <h6>Ubah Pengajuan</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="pengajuan.php" class="btn btn-sm btn-info text-white"><i
                                class="material-icons opacity-10">arrow_left</i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body pb-4">
                <form role="form" class="text-start" method="POST" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <label class="form-label">Tanggal Pengajuan</label>
                            <div class="input-group input-group-outline my-3">
                                <input type="date" class="form-control" name="tanggal_pengajuan"
                                    value="<?= $p["tanggal_pengajuan"]; ?>">
                                <input type="hidden" class="form-control" name="id_pengajuan"
                                    value="<?= $p["id_pengajuan"] ?>">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 mb-2"
                                    name="edit_pengajuan">Ubah</button>
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