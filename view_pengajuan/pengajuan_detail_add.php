<?php
session_start();
include "../templates/header.php";

$id_pengajuan = $_GET["id_pengajuan"];

if (isset($_POST["add_pengajuan_detail"])) {
    if (pengajuan_detail_add($_POST) > 0) {
        echo "<script>
            alert('Barang berhasil ditambah!');
            document.location.href = 'pengajuan_detail.php?id_pengajuan=$id_pengajuan';
          </script>";
    } else {
        echo "<script>
            alert('Barang gagal ditambah!');
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
                        <h6>Tambah Barang Pengajuan</h6>
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

                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" required>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Spesifikasi</label>
                                <input type="text" class="form-control" name="spesifikasi">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Qty</label>
                                <input type="number" class="form-control" name="qty" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Harga (Rp.)</label>
                                <input type="number" class="form-control" name="harga" required>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 mb-2"
                                    name="add_pengajuan_detail">Tambah</button>
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