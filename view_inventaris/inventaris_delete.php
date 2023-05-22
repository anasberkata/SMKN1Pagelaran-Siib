<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id = $_GET["id_inventaris"];

if (inventaris_delete($id) > 0) {
    echo "
		<script>
			alert('Barang berhasil dihapus!');
			document.location.href = 'inventaris.php';
		</script>
	";
} else {
    echo "
		<script>
			alert('Barang gagal dihapus!');
			document.location.href = inventaris.php';
		</script>
	";
}