<?php
session_start();
include "header.php";

$id_peminjam = $user["id_user"];
$peminjam = query("SELECT * FROM users WHERE id_user = $id_peminjam");

if (isset($_POST["add_peminjaman"])) {
    $id_peminjaman_baru = peminjaman_add($_POST);

    if ($id_peminjaman_baru > 0) {
        echo "<script>
            alert('Peminjaman berhasil ditambah!');
            document.location.href = 'peminjaman_detail.php?id_peminjaman=$id_peminjaman_baru';
          </script>";
    } else {
        echo "<script>
            alert('Peminjaman gagal ditambah!');
            document.location.href = 'peminjaman.php';
          </script>";
    }
}
?>

<div class="row mb-4 mx-1 justify-content-center">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Tambah Peminjaman</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="dashboard.php" class="btn btn-sm btn-info text-white"><i
                                class="material-icons opacity-10">arrow_left</i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body pb-4">
                <form role="form" class="text-start" method="POST" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <input type="hidden" class="form-control" name="id_petugas" value="1">
                            <input type="hidden" class="form-control" value="<?= $user["id_user"]; ?>"
                                name="id_peminjam">

                            <label class="form-label">Nama Peminjam</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" value="<?= $user["nama"]; ?>" readonly>
                            </div>

                            <label class="form-label">Tanggal Peminjaman</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="date" class="form-control" name="tanggal_peminjaman" required>
                            </div>

                            <label class="form-label">Tanggal Pengembalian</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="date" class="form-control" name="tanggal_pengembalian" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 mb-2"
                                    name="add_peminjaman">Tambah</button>
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