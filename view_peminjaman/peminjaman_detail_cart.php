<?php

$id_peminjaman = $_GET["id_peminjaman"];

if (isset($_POST['edit_cart'])) {
    foreach ($_POST['quantity'] as $key => $val) {
        if ($val == 0) {
            unset($_SESSION['cart'][$key]);
        } else {
            $_SESSION['cart'][$key]['quantity'] = $val;
        }
    }

    echo "<script>
            document.location.href = 'peminjaman_detail_add.php?page=peminjaman_detail_cart&id_peminjaman=' + $id_peminjaman;
          </script>";
}

if (isset($_POST["add_peminjaman_detail"])) {
    if (peminjaman_detail_add($_POST) > 0) {
        // Clear the cart
        $_SESSION['cart'] = array();

        echo "<script>
            alert('Data peminjaman berhasil ditambah!');
            document.location.href = 'peminjaman_detail.php?id_peminjaman=' + $id_peminjaman;
          </script>";
    } else {
        echo "<script>
            alert('Data peminjaman gagal ditambah!');
            document.location.href = 'peminjaman_detail.php?id_peminjaman=' + $id_peminjaman;
          </script>";
    }
}
?>

<h6 class="card-title">Keranjang Barang</h6>

<form method="post" action="">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Qty Peminjaman</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($_SESSION['cart'])): ?>

                    <?php
                    $ids = implode(',', array_keys($_SESSION['cart']));
                    $cart = query("SELECT * FROM inventaris WHERE id_inventaris IN ($ids) ORDER BY nama_barang ASC");
                    ?>

                    <?php $i = 1; ?>
                    <?php foreach ($cart as $c): ?>
                        <tr>
                            <td>
                                <?= $i; ?>
                            </td>
                            <td>
                                <?= $_SESSION['cart'][$c['id_inventaris']]['nama_barang'] ?>
                            </td>
                            <td>
                                <input class="form-control" type="number" id="input-number"
                                    name="quantity[<?= $c['id_inventaris'] ?>]"
                                    value="<?= $_SESSION['cart'][$c['id_inventaris']]['quantity'] ?>" />
                            </td>
                        </tr>

                        <input type="hidden" value="<?= $id_peminjaman ?>" name="id_peminjaman">
                        <input type="hidden" value="<?= $_SESSION['cart'][$c['id_inventaris']]['nama_barang'] ?>"
                            name="nama_barang[<?= $c['id_inventaris'] ?>]">
                        <input type="hidden" value="<?= $_SESSION['cart'][$c['id_inventaris']]['id_inventaris'] ?>"
                            name="id_inventaris[<?= $c['id_inventaris'] ?>]">

                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Keranjang kosong</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <br />

        <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
            <a href="peminjaman_detail_add.php?page=products&id_peminjaman=<?= $id_peminjaman; ?>"
                class="btn btn-warning">Kembali ke halaman barang</a>
            <button type="submit" name="edit_cart" class="btn btn-dark">Update Keranjang Peminjaman</button>
            <button type="submit" name="add_peminjaman_detail" class="btn btn-primary">Ajukan Peminjaman</button>
        </div>
    </div>
</form>

<br />

<p class="small my-2">*Untuk menghapus item, ubah Qty Peminjaman menjadi 0. </p>

<script>
    const inputNumber = document.getElementById('input-number');
    inputNumber.addEventListener('change', () => {
        if (inputNumber.value < 0) {
            inputNumber.value = 0;
        }
    });
</script>