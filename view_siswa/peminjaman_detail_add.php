<?php
session_start();
include "header.php";

$id_peminjaman = $_GET["id_peminjaman"];

if (isset($_GET['page'])) {
    $pages = array("peminjaman_detail_products", "peminjaman_detail_cart");

    if (in_array($_GET['page'], $pages)) {
        $_page = $_GET['page'];
    } else {
        $_page = "peminjaman_detail_products";
    }
} else {
    $_page = "peminjaman_detail_products";
}
?>

<div class="row mb-4 mx-1">
    <div class="col-12 col-md-8 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Tambah Barang</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="peminjaman_detail.php?id_peminjaman=<?= $id_peminjaman ?>"
                            class="btn btn-sm btn-info text-white"><i class="material-icons opacity-10">arrow_left</i>
                            Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body pb-4">
                <form role="form" class="text-start" method="POST" action="" enctype="multipart/form-data">
                    <div class="row">
                        <?php require($_page . ".php"); ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <h6>Keranjang Barang</h6>
                    </div>
                </div>
            </div>
            <div class="card-body pb-4">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <form role="form" class="text-start" method="POST" action="" enctype="multipart/form-data">
                            <?php if (!empty($_SESSION['cart'])): ?>
                                <ul>
                                    <?php
                                    $ids = implode(',', array_keys($_SESSION['cart']));
                                    $cart = query("SELECT * FROM inventaris WHERE id_inventaris IN ($ids) ORDER BY nama_barang ASC");
                                    ?>

                                    <?php foreach ($cart as $c): ?>

                                        <li>
                                            <?= $c['nama_barang'] ?> x
                                            <?= $_SESSION['cart'][$c['id_inventaris']]['quantity'] ?>
                                        </li>

                                    <?php endforeach; ?>
                                </ul>
                                <hr />
                                <a href="peminjaman_detail_add.php?page=peminjaman_detail_cart&id_peminjaman=<?= $id_peminjaman ?>"
                                    class="btn btn-dark">Check Out</a>

                            <?php else: ?>
                                <p>Keranjang kosong</p>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>