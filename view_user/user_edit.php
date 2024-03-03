<?php
session_start();
include "../templates/header.php";

$id = $_GET["id_user"];
$u = query(
    "SELECT * FROM users
    INNER JOIN users_role ON users.role_id = users_role.id_role
    WHERE id_user = $id"
)[0];

$roles = query("SELECT * FROM users_role");

if (isset($_POST["edit_user"])) {
    if (user_edit($_POST) > 0) {
        echo "<script>
            alert('Pengguna berhasil diubah!');
            document.location.href = 'users.php';
          </script>";
    } else {
        echo "<script>
            alert('Pengguna gagal diubah!');
            document.location.href = 'users.php';
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
                        <h6>Ubah Pengguna</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="users.php" class="btn btn-sm btn-info text-white"><i
                                class="material-icons opacity-10">arrow_left</i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body pb-4">
                <form role="form" class="text-start" method="POST" action="">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <input type="hidden" name="id" value="<?= $u["id_user"]; ?>">

                            <label class="form-label">Nomor Induk Pegawai</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" name="nomor_induk"
                                    value="<?= $u["nomor_induk"]; ?>">
                            </div>

                            <label class="form-label">Nama Lengkap</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" name="nama" value="<?= $u["nama"]; ?>">
                            </div>

                            <label class="form-label">Phone</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" name="phone" value="<?= $u["phone"]; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">E-Mail</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="email" class="form-control" name="email" value="<?= $u["email"]; ?>">
                            </div>

                            <label class="form-label">Username</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" name="username" value="<?= $u["username"]; ?>">
                            </div>

                            <label class="form-label">Password</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="password" class="form-control" name="password"
                                    value="<?= $u["password"]; ?>">
                            </div>

                            <label class="form-label">Role</label>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-select form-control mb-3" name="role">
                                    <option value="<?= $u["role_id"]; ?>">
                                        <?= $u["role"]; ?>
                                    </option>
                                    <?php foreach ($roles as $r): ?>
                                        <option value="<?= $r["id_role"] ?>">
                                            <?= $r["role"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <input type="hidden" name="id_kelas" value="<?= $u["id_kelas"]; ?>">

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 mb-2"
                                    name="edit_user">Ubah</button>
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