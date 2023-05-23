<?php
session_start();
include "../templates/header.php";

$inventaris = query("SELECT * FROM inventaris");
$total_inventaris = count($inventaris);

$pengajuan = query("SELECT * FROM pengajuan");
$total_pengajuan = count($pengajuan);

$pengguna = query("SELECT * FROM users");
$total_pengguna = count($pengguna);

$inventaris_rusak = query(
  "SELECT * FROM inventaris WHERE id_kondisi = 2"
);

?>

<div class="row">

  <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
    <div class="card mb-4">
      <div class="card-header p-3 pt-2">
        <div
          class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">weekend</i>
        </div>
        <div class="text-end pt-1">
          <p class="text-sm mb-0 text-capitalize">Inventaris</p>
          <h4 class="mb-0">
            <?= $total_inventaris ?>
          </h4>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-sm-6">
    <div class="card mb-4">
      <div class="card-header p-3 pt-2">
        <div
          class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">receipt_long</i>
        </div>
        <div class="text-end pt-1">
          <p class="text-sm mb-0 text-capitalize">Pengajuan</p>
          <h4 class="mb-0">
            <?= $total_pengajuan ?>
          </h4>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
    <div class="card mb-4">
      <div class="card-header p-3 pt-2">
        <div
          class="icon icon-lg icon-shape bg-gradient-success shadow-primary text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">person</i>
        </div>
        <div class="text-end pt-1">
          <p class="text-sm mb-0 text-capitalize">Pengguna</p>
          <h4 class="mb-0">
            <?= $total_pengguna ?>
          </h4>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="row mb-4">
  <div class="col-12 col-md-12">
    <div class="card">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-lg-6 col-7">
            <h6>Alat / Barang Inventaris yang Rusak</h6>
          </div>
          <div class="col-lg-6 col-5 my-auto text-end">

          </div>
        </div>
      </div>
      <div class="card-body px-0 pb-2">
        <div class="table-responsive">
          <table class="table align-items-center mb-0" id="data-table">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                  No.</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                  Gambar
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                  Nama Barang</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                  Merk</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                  Qty
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                  Harga
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                  Total Harga
                </th>
              </tr>
            </thead>
            <tbody>
              <?php $n = 1; ?>
              <?php foreach ($inventaris as $i): ?>
                <tr>
                  <td class="text-center text-sm">
                    <span class="mb-0 text-sm">
                      <?= $n; ?>
                    </span>
                  </td>
                  <td class="w-20">
                    <span class="mb-0 text-sm">
                      <img src="../assets/img/barang/<?= $i["gambar"]; ?>" class="img-thumbnail" width="50%">
                    </span>
                  </td>
                  <td>
                    <span class="mb-0 text-sm">
                      <?= $i["nama_barang"]; ?>
                    </span>
                  </td>
                  <td>
                    <span class="mb-0 text-sm">
                      <?= $i["merk"]; ?>
                    </span>
                  </td>
                  <td>
                    <span class="mb-0 text-sm">
                      <?= $i["qty"]; ?>
                    </span>
                  </td>
                  <td>
                    <span class="mb-0 text-sm">
                      Rp.
                      <?= number_format($i["harga"], 0, ',', '.'); ?>
                    </span>
                  </td>
                  <td>
                    <span class="mb-0 text-sm">
                      Rp.
                      <?= number_format($i["qty"] * $i["harga"], 0, ',', '.'); ?>
                    </span>
                  </td>
                  <td>
                </tr>
                <?php $n++; ?>
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