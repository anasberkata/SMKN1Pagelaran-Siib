<?php
session_start();
include "../templates/header.php";

if (isset($_POST["add_pengajuan"])) {
    $id_pengajuan_baru = pengajuan_add($_POST);

    if ($id_pengajuan_baru > 0) {
        echo "<script>
            alert('Pengajuan berhasil ditambah!');
            document.location.href = 'pengajuan_detail.php?id_pengajuan=$id_pengajuan_baru';
          </script>";
    } else {
        echo "<script>
            alert('Pengajuan gagal ditambah!');
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
                        <h6>Tambah Pengajuan</h6>
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
                                <input type="date" class="form-control" name="tanggal_pengajuan" required>
                                <input type="hidden" class="form-control" name="id_user"
                                    value="<?= $user["id_user"] ?>">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 mb-2"
                                    name="add_pengajuan">Tambah</button>
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