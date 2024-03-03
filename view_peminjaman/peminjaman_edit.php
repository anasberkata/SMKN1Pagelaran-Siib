<?php
session_start();
include "../templates/header.php";

$id_peminjaman = $_GET["id_peminjaman"];
$p = query(
    "SELECT * FROM peminjaman
    INNER JOIN users ON peminjaman.id_peminjam = users.id_user
    WHERE id_peminjaman = $id_peminjaman"
)[0];

$peminjam = query("SELECT * FROM users WHERE role_id = 4");

if (isset($_POST["edit_peminjaman"])) {
    if (peminjaman_edit($_POST) > 0) {
        echo "<script>
            alert('Data peminjaman berhasil diubah!');
            document.location.href = 'peminjaman.php';
          </script>";
    } else {
        echo "<script>
            alert('Data peminjaman gagal diubah!');
            document.location.href = 'peminjaman.php';
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
                        <h6>Ubah Data Peminjaman</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="peminjaman.php" class="btn btn-sm btn-info text-white"><i
                                class="material-icons opacity-10">arrow_left</i> Kembali</a>
                    </div>
                </div>
            </div>

            <div class="card-body pb-4">
                <form role="form" class="text-start" method="POST" action="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <!-- <input type="hidden" class="form-control" name="id_petugas" value="<?= $user["id_user"] ?>"> -->
                            <input type="hidden" value="<?= $p["id_peminjaman"]; ?>" name="id_peminjaman" />

                            <label class="form-label">Nama Peminjam</label>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-select form-control" name="id_peminjam">
                                    <option value="<?= $p["id_peminjam"]; ?>">
                                        <?= $p["nama"]; ?>
                                    </option>
                                    <?php foreach ($peminjam as $pe): ?>
                                        <option value="<?= $pe["id_user"] ?>">
                                            <?= $pe["nama"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <label class="form-label">Tanggal Peminjaman</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="date" class="form-control" value="<?= $p["tanggal_peminjaman"] ?>"
                                    name="tanggal_peminjaman">
                            </div>

                            <label class="form-label">Tanggal Pengembalian</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="date" class="form-control" value="<?= $p["tanggal_pengembalian"]; ?>"
                                    name="tanggal_pengembalian">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 mb-2"
                                    name="edit_peminjaman">Ubah</button>
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