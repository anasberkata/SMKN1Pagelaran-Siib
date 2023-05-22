<?php
session_start();
include "../templates/header.php";

$roles = query("SELECT * FROM users_role");

if (isset($_POST["edit_profile"])) {
    if (profile_edit($_POST) > 0) {
        echo "<script>
            alert('Profile berhasil diubah!');
            document.location.href = 'profile.php';
          </script>";
    } else {
        echo "<script>
            alert('Profile gagal diubah!');
            document.location.href = 'profile.php';
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
                        <h6>Ubah Profile</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="profile.php" class="btn btn-sm btn-info text-white"><i
                                class="material-icons opacity-10">arrow_left</i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body pb-4">
                <div class="row">
                    <div class="col-12">
                        <form role="form" class="text-start" method="POST" action="">

                            <input type="hidden" name="id" value="<?= $user["id_user"]; ?>">

                            <div class="input-group input-group-outline my-3">
                                <input type="text" class="form-control" name="nama" value="<?= $user["nama"]; ?>">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <input type="email" class="form-control" name="email" value="<?= $user["email"]; ?>">
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <input type="text" class="form-control" name="username"
                                    value="<?= $user["username"]; ?>">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <input type="password" class="form-control" name="password"
                                    value="<?= $user["password"]; ?>">
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <select class="form-select form-control mb-3" name="role">
                                    <option value="<?= $user["role_id"]; ?>"><?= $user["role"]; ?></option>
                                    <?php foreach ($roles as $r): ?>
                                        <option value="<?= $r["id_role"] ?>"><?= $r["role"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2"
                                    name="edit_profile">Ubah</button>
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