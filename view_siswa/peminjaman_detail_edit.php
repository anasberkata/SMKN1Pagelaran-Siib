<?php
session_start();
include "header.php";

$id_peminjaman = $_GET["id_peminjaman"];
$id_peminjaman_detail = $_GET["id_peminjaman_detail"];

$pd = query("SELECT * FROM peminjaman_detail
            INNER JOIN inventaris ON peminjaman_detail.id_inventaris = inventaris.id_inventaris
            WHERE id_peminjaman_detail = $id_peminjaman_detail
            ")[0];

if (isset($_POST["edit_peminjaman_detail"])) {
    if (peminjaman_detail_edit($_POST) > 0) {
        echo "<script>
            alert('Data peminjaman berhasil diubah!');
            document.location.href = 'peminjaman_detail.php?id_peminjaman=' + $id_peminjaman;
          </script>";
    } else {
        echo "<script>
            alert('Data peminjaman gagal diubah!');
            document.location.href = 'peminjaman_detail.php?id_peminjaman=' + $id_peminjaman;
          </script>";
    }
}
?>
<div class="row mb-4 mx-1 justify-content-center">
    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Ubah Data Detail Peminjaman</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="peminjaman_detail.php?id_peminjaman=<?= $id_peminjaman ?>"
                            class="btn btn-sm btn-info text-white"><i class="material-icons opacity-10">arrow_left</i>
                            Kembali</a>
                    </div>
                </div>
            </div>

            <div class="card-body pb-4">
                <form role="form" class="text-start" method="POST" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <h4 class="card-title">Data Peminjaman :
                                <?= $pd["nama_barang"]; ?>
                            </h4>
                            <!-- <input type="hidden" class="form-control" name="id_petugas" value="<?= $user["id_user"] ?>"> -->
                            <input type="hidden" value="<?= $pd["id_peminjaman"]; ?>" name="id_peminjaman" />
                            <input type="hidden" value="<?= $pd["id_peminjaman_detail"]; ?>"
                                name="id_peminjaman_detail" />
                            <input type="hidden" value="<?= $pd["id_inventaris"]; ?>" name="id_inventaris" />

                            <label class="form-label">Qty Peminjaman</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="number" class="form-control" value="<?= $pd["qty_peminjaman"] ?>"
                                    name="qty_peminjaman">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 mb-2"
                                    name="edit_peminjaman_detail">Ubah</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>