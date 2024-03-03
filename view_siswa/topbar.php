<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 my-3 shadow-none border-radius-xl bg-white" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <a class="navbar-brand" href="#">
                <img src="../assets/img/logo sekolah.png" class="navbar-brand-img h-100" alt="main_logo"
                    style="width: 50px">
                <span class="ms-1 font-weight-bold">SMKN 1 Pagelaran</span>
            </a>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <ul class="navbar-nav ms-md-auto pe-md-3 justify-content-end">
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="dashboard.php" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-home me-sm-1"></i>
                        <span class="d-sm-inline d-none">Beranda</span>
                    </a>
                </li>

                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="peminjaman.php" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-receipt me-sm-1"></i>
                        <span class="d-sm-inline d-none">Peminjaman</span>
                    </a>
                </li>

                <li class="nav-item dropdown px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user cursor-pointer"></i>
                        <span class="d-sm-inline d-none">
                            <?= $user["nama"]; ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="profile.php">
                                <div class="d-flex py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">Profile
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="../logout.php"
                                onclick="return confirm('Yakin ingin keluar dari aplikasi?');">
                                <div class="d-flex py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">Logout
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>