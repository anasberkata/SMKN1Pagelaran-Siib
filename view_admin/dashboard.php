<?php
session_start();
include "../templates/header.php";
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
          <h4 class="mb-0">200</h4>
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
          <h4 class="mb-0">20</h4>
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
          <h4 class="mb-0">2</h4>
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
            <h6>Projects</h6>
          </div>
          <div class="col-lg-6 col-5 my-auto text-end">

          </div>
        </div>
      </div>
      <div class="card-body px-0 pb-2">
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Companies</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Members</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Budget
                </th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                  Completion</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="../assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm me-3" alt="xd">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">Material XD Version</h6>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="avatar-group mt-2">
                    <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                      data-bs-placement="bottom" title="Ryan Tompson">
                      <img src="../assets/img/team-1.jpg" alt="team1">
                    </a>
                    <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                      data-bs-placement="bottom" title="Romina Hadid">
                      <img src="../assets/img/team-2.jpg" alt="team2">
                    </a>
                    <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                      data-bs-placement="bottom" title="Alexander Smith">
                      <img src="../assets/img/team-3.jpg" alt="team3">
                    </a>
                    <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                      data-bs-placement="bottom" title="Jessica Doe">
                      <img src="../assets/img/team-4.jpg" alt="team4">
                    </a>
                  </div>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold"> $14,000 </span>
                </td>
                <td class="align-middle">
                  <div class="progress-wrapper w-75 mx-auto">
                    <div class="progress-info">
                      <div class="progress-percentage">
                        <span class="text-xs font-weight-bold">60%</span>
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </td>
              </tr>
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