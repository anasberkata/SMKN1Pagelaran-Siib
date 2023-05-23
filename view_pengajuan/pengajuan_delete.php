<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id = $_GET["id_pengajuan"];

if (pengajuan_delete($id) > 0) {
    echo "
		<script>
			alert('Pengajuan berhasil dihapus!');
			document.location.href = 'pengajuan.php';
		</script>
	";
} else {
    echo "
		<script>
			alert('Pengajuan gagal dihapus!');
			document.location.href = pengajuan.php';
		</script>
	";
}