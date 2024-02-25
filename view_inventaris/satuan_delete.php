<?php
session_start();

if (!isset($_SESSION['login'])) {
	header("Location: ../index.php");
	exit;
}

require "../functions.php";

$id = $_GET["id_satuan"];

if (satuan_delete($id) > 0) {
	echo "
		<script>
			alert('Satuan berhasil dihapus!');
			document.location.href = 'satuan.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('Satuan gagal dihapus!');
			document.location.href = satuan.php';
		</script>
	";
}