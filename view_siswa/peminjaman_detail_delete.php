<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id_peminjaman = $_GET["id_peminjaman"];
$id_peminjaman_detail = $_GET["id_peminjaman_detail"];

if (peminjaman_detail_delete($id_peminjaman_detail, $id_peminjaman) > 0) {
    echo "
		<script>
			alert('Data barang peminjaman berhasil dihapus!');
			document.location.href = 'peminjaman_detail.php?id_peminjaman=' + $id_peminjaman;
		</script>
	";
} else {
    echo "
		<script>
			alert('Data barang peminjaman gagal dihapus!');
			document.location.href = peminjaman_detail.php?id_peminjaman=' + $id_peminjaman;
		</script>
	";
}