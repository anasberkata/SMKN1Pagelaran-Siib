<?php
session_start();
include "../templates/header.php";

$roles = query("SELECT * FROM users_role");

if (isset($_POST["add_user"])) {
    if (user_add($_POST) > 0) {
        echo "<script>
            alert('Pengguna berhasil ditambah!');
            document.location.href = 'users.php';
          </script>";
    } else {
        echo "<script>
            alert('Pengguna gagal ditambah!');
            document.location.href = 'users.php';
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
                        <h6>Tambah Pengguna</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="users.php" class="btn btn-sm btn-info text-white"><i
                                class="material-icons opacity-10">arrow_left</i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body pb-4">
                <div class="row">
                    <div class="col-12">
                        <form role="form" class="text-start" method="POST" action="">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <select class="form-select form-control mb-3" name="role" required>
                                    <option>Pilih Role</option>
                                    <?php foreach ($roles as $r): ?>
                                        <option value="<?= $r["id_role"] ?>"><?= $r["role"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2"
                                    name="add_user">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "../templates/footer.php";
?>