<?php

// require_once __DIR__ . '/vendor/autoload.php';
require_once '../vendor/autoload.php';
require '../functions.php';

$id_peminjaman = $_GET["id_peminjaman"];
$p = query(
    "SELECT peminjaman.*, petugas.nama AS nama_petugas, peminjam.nama AS nama_peminjam 
    FROM peminjaman
    INNER JOIN users AS petugas ON peminjaman.id_petugas = petugas.id_user
    INNER JOIN users AS peminjam ON peminjaman.id_peminjam = peminjam.id_user
    WHERE id_peminjaman = $id_peminjaman"
)[0];

$peminjaman_detail = query(
    "SELECT * FROM peminjaman_detail
    INNER JOIN inventaris ON peminjaman_detail.id_inventaris = inventaris.id_inventaris
    WHERE id_peminjaman = $id_peminjaman"
);

$html = '
    <table cellpadding="20px" cellspacing="0" width="100%">
        <tr>
            <td width="20%">
                <img src="../assets/img/logo jabar.png" width="10%">
            </td>
            <td width="60%" style="text-align: center; font-size: 10;">
                <h4>PEMERINTAH PROVINSI JAWA BARAT</h4>
                <h4>DINAS PENDIDIKAN</h4>
                <h2>SMK NEGERI 1 PAGELARAN</h2>
                <p>Jl. Raya Pasir Pari Desa. Sindangkerta Kec. Pagelaran Kab. Cianjur</p>
                <p>Kode Pos 43266 Telp. 0263-2343003 E-Mail : smkn01pgl@gmail.com</p>
            </td>
            <td width="20%"></td>
        </tr>
    </table>

    <hr style="border: 2px solid #000;">

    <table width="100%" style="margin-bottom: 20px;">
        <tr>
            <td width="100%" style="text-align: center;">
                <p style="font-size: 12px; font-style: bold;">
                DAFTAR PEMINJAMAN ALAT / BAHAN / FASILITAS
                <br>
                TAHUN PELAJARAN ' . date("Y") . '-' . date("Y", strtotime("+1 year", strtotime(date("Y")))) . '
                </p>
            </td>
        </tr>
    </table>

    <br>
    <table style="font-size: 10;">
        <tr>
            <td>Nama Lengkap</td>
            <td>: ' . $p["nama_peminjam"] . '</td>
        </tr>
        <tr>
            <td>NIP / NIS</td>
            <td>: ' . $p["id_user"] . '</td>
        </tr>
        <tr>
            <td>Phone</td>
            <td>: ' . $p["phone"] . '</td>
        </tr>
        <tr>
            <td>Lama Peminjaman</td>
            <td>: ' . date('d F Y', strtotime($p["tanggal_peminjaman"])) . ' s/d ' . date('d F Y', strtotime($p["tanggal_pengembalian"])) . '</td>
        </tr>
    </table>

    <br>

    <table border="1" cellpadding="10px" cellspacing="0" width="100%" style="font-size: 10px">
        <tr style="background-color: #6495ED; font-style: bold; text-align: center">
            <td>No.</td>
            <td>Nama Inventaris</td>
            <td>Qty Peminjaman</td>
        </tr>';
$i = 1;
foreach ($peminjaman_detail as $pd) {
    $html .=
        '<tr>
            <td style="text-align: center;">' . $i . '</td>
            <td>' . $pd["nama_barang"] . '</td>
            <td>' . $pd["qty_peminjaman"] . '</td>
        </tr>';
    $i++;
}
$html .=
    '
    </table>

    <br>

    <table width="100%" style="margin-top: 20px; font-size: 10px;">
        <tr>
            <td width="40%" style="text-align: center;">
                <p style="font-size: 10;">
                <br>
                Mengetahui,
                <br>
                Petugas
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <strong>' . $p["nama_petugas"] . '</strong>
                </p>
            </td>
            <td width="30%"></td>
            <td width="40%" style="text-align: center;">
                <p style="font-size: 10;">
                Pagelaran,' . date("d F Y") . '
                <br>
                Peminjam
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <strong>' . $p["nama_peminjam"] . '</strong>
                </p>
            </td>
        </tr>
    </table>
</body>
';

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A5-P']);

// $stylesheet = file_get_contents('style_print.css');
// $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML("$html", \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('Data Peminjaman Alat dan Bahan per Tanggal ' . date("d M Y") . '.pdf', 'I');
// $mpdf->Output();