<?php
session_start();
include "../templates/header.php";

$users = query(
    "SELECT * FROM users
    INNER JOIN users_role ON users.role_id = users_role.id_role"
);
?>

<div class="row mb-4">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Daftar Pengguna</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="user_add.php" class="btn btn-sm btn-info text-white"><i
                                class="material-icons opacity-10">add</i> Tambah</a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="data-table">
                        <thead>
                            <tr>
                                <th
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                    No.</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Nama</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Username</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Email
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($users as $u): ?>
                                <tr>
                                    <td class="text-center text-sm">
                                        <span class="mb-0 text-sm">
                                            <?= $i; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm">
                                            <?= $u["nama"]; ?>
                                        </h6>
                                    </td>
                                    <td>
                                        <span class="mb-0 text-sm">
                                            <?= $u["username"]; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="mb-0 text-sm">
                                            <?= $u["email"]; ?>
                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <a href="user_edit.php?id_user=<?= $u["id_user"] ?>"
                                                class="btn btn-sm btn-info text-white"><i
                                                    class="material-icons opacity-10">edit</i></a>
                                            <a href="user_delete.php?id_user=<?= $u["id_user"] ?>"
                                                class="btn btn-sm btn-danger text-white"
                                                onclick="return confirm('Yakin ingin menghapus <?= $u['nama']; ?>?');"><i
                                                    class="material-icons opacity-10">delete</i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "../templates/footer.php";
?>