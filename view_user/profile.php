<?php
session_start();
include "../templates/header.php";
?>

<div class="row mb-4">
    <div class="col-12 col-md-6">
        <div class="card card-body">
            <div class="row gx-4 mb-2">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="../assets/img/bruce-mars.jpg" alt="profile_image"
                            class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            <?= $user["nama"] ?>
                        </h5>
                        <p class="mb-0 font-weight-normal text-sm">
                            <?= $user["role"] ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Informasi Profil</h6>
                                </div>
                                <div class="col-md-4 text-end">
                                    <a href="profile_edit.php">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Edit Profile"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nama
                                        Lengkap:</strong>
                                    &nbsp;
                                    <?= $user["nama"] ?>
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                        class="text-dark">Email:</strong>
                                    &nbsp;
                                    <?= $user["email"] ?>
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                        class="text-dark">Username:</strong>
                                    &nbsp;
                                    <?= $user["username"] ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "../templates/footer.php";
?>