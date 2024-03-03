<?php
session_start();

if (isset($_SESSION['login'])) {
  header("Location: ../view_admin/dashboard.php");
  exit;
}

include "auth_header.php";
?>

<div class="container my-auto">
  <div class="row">
    <div class="col-lg-4 col-md-8 col-12 mx-auto">
      <div class="card z-index-0 fadeIn3 fadeInBottom">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1 text-center">
            <img src="../assets/img/Logo Sekolah.png" width="20%">
            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sistem Informasi <br> Inventaris Barang</h4>
            <p class="mt-3 text-white">
              SMK NEGERI 1 PAGELARAN
              <br>
              Admin Page
            </p>
          </div>
        </div>
        <div class="card-body">

          <?php if (isset($_GET["pesan"])): ?>
            <p class="alert alert-danger my-4" style="font-style: italic; color: #fff; text-align: center;">
              <?= $_GET["pesan"]; ?>
            </p>
          <?php endif; ?>

          <form role="form" class="text-start" method="POST" action="cek_login.php">
            <div class="input-group input-group-outline my-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" name="username">
            </div>
            <div class="input-group input-group-outline mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password">
            </div>
            <div class="text-center">
              <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
include "auth_footer.php";
?>