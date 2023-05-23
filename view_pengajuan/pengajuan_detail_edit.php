<?php
session_start();
include "../templates/header.php";

$id_pengajuan = $_GET["id_pengajuan"];
$id_pengajuan_detail = $_GET["id_pengajuan_detail"];

$pd = query(
    "SELECT * FROM pengajuan_detail
    WHERE id_pengajuan_detail = $id_pengajuan_detail"
)[0];

if (isset($_POST["edit_pengajuan_detail"])) {
    if (pengajuan_detail_edit($_POST) > 0) {
        echo "<script>
            alert('Barang berhasil diubah!');
            document.location.href = 'pengajuan_detail.php?id_pengajuan=$id_pengajuan';
          </script>";
    } else {
        echo "<script>
            alert('Barang gagal diubah!');
            document.location.href = 'pengajuan_detail.php?id_pengajuan=$id_pengajuan';
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
                        <h6>Ubah Barang Pengajuan</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="pengajuan_detail.php?id_pengajuan=<?= $id_pengajuan; ?>"
                            class="btn btn-sm btn-info text-white"><i class="material-icons opacity-10">arrow_left</i>
                            Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body pb-4">
                <form role="form" class="text-start" method="POST" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 col-md-12">

                            <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan; ?>">
                            <input type="hidden" name="id_pengajuan_detail" value="<?= $id_pengajuan_detail; ?>">

                            <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" name="nama_barang"
                                    value="<?= $pd["nama_barang"]; ?>">
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <input type="text" class="form-control" name="spesifikasi"
                                    value="<?= $pd["spesifikasi"]; ?>">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <input type="number" class="form-control" name="qty" value="<?= $pd["qty"]; ?>">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <input type="number" class="form-control" name="harga" value="<?= $pd["harga"]; ?>">
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <input type="text" class="form-control" name="keterangan"
                                    value="<?= $pd["keterangan"]; ?>">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 mb-2"
                                    name="edit_pengajuan_detail">Ubah</button>
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