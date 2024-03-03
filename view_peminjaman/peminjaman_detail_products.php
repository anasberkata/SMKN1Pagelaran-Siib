<?php

$inventaris = query("SELECT * FROM inventaris WHERE NOT qty = 0");

if (isset($_GET['action']) && $_GET['action'] == "add") {
    $id = intval($_GET['id']);

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        $sql_s = "SELECT * FROM inventaris WHERE id_inventaris={$id}";
        $query_s = mysqli_query($conn, $sql_s);
        if (mysqli_num_rows($query_s) != 0) {
            $row_s = mysqli_fetch_array($query_s);
            $_SESSION['cart'][$row_s['id_inventaris']] = array(
                "nama_barang" => $row_s['nama_barang'],
                "id_inventaris" => $row_s['id_inventaris'],
                "quantity" => 1
            );
        } else {
            $message = "Barang ini tidak ada!";
        }
    }
}
?>

<h6 class="card-title">Daftar Barang</h6>

<?php foreach ($inventaris as $i): ?>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1">
                    <img src="../assets/img/barang/<?= $i["gambar"]; ?>" alt="inventaris" class="img-thumbnail" />
                </div>
                <div class="el-card-content text-center">
                    <h4 class="my-2">
                        <?= $i["nama_barang"]; ?>
                    </h4>
                    <p class="small">
                        Qty :
                        <?= $i["qty"]; ?>
                    </p>
                    <a href="peminjaman_detail_add.php?page=peminjaman_detail_products&action=add&id=<?= $i["id_inventaris"]; ?>&id_peminjaman=<?= $id_peminjaman ?>"
                        class="btn btn-info">Tambah</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>