<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id_pengajuan = $_GET["id_pengajuan"];
$id_pengajuan_detail = $_GET["id_pengajuan_detail"];

if (pengajuan_detail_delete($id_pengajuan_detail) > 0) {
    echo "
		<script>
			alert('Pengajuan berhasil dihapus!');
			document.location.href = 'pengajuan_detail.php?id_pengajuan=$id_pengajuan';
		</script>
	";
} else {
    echo "
		<script>
			alert('Pengajuan gagal dihapus!');
			document.location.href = pengajuan_detail.php?id_pengajuan=$id_pengajuan';
		</script>
	";
}