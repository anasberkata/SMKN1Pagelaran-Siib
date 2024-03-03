<?php
session_start();
include "../templates/header.php";

$kelas = query("SELECT * FROM kelas");

if (isset($_POST["add_user"])) {
    if (user_add($_POST) > 0) {
        echo "<script>
            alert('Pengguna berhasil ditambah!');
            document.location.href = 'siswa.php';
          </script>";
    } else {
        echo "<script>
            alert('Pengguna gagal ditambah!');
            document.location.href = 'siswa.php';
          </script>";
    }
}
?>

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Tambah Siswa</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="siswa.php" class="btn btn-sm btn-info text-white"><i
                                class="material-icons opacity-10">arrow_left</i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body pb-4">
                <form role="form" class="text-start" method="POST" action="">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label class="form-label">Nomor Induk Siswa</label>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">NIP (Nomor Induk Siswa)</label>
                                <input type="text" class="form-control" name="nomor_induk" required>
                            </div>

                            <label class="form-label">Nana Lengkap</label>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>

                            <label class="form-label">Phone</label>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">Kelas</label>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-select form-control" name="id_kelas" required>
                                    <option>Pilih Kelas</option>
                                    <?php foreach ($kelas as $k): ?>
                                        <option value="<?= $k["id_kelas"] ?>">
                                            <?= $k["kelas"] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <label class="form-label">E-Mail</label>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>

                            <label class="form-label">Username</label>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>

                            <label class="form-label">Password</label>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>

                            <input type="hidden" class="form-control" name="role" value="4">

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 mb-2"
                                    name="add_user">Tambah</button>
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