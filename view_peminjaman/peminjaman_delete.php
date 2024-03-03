<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id_peminjaman = $_GET["id_peminjaman"];

if (peminjaman_delete($id_peminjaman, $data) > 0) {
    echo "
		<script>
			alert('Data peminjaman berhasil dihapus!');
			document.location.href = 'peminjaman.php';
		</script>
	";
} else {
    echo "
		<script>
			alert('Data peminjaman gagal dihapus!');
			document.location.href = peminjaman.php';
		</script>
	";
}