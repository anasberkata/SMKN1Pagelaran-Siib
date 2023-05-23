<?php
require_once '../vendor/autoload.php';
require '../functions.php';

$id_pengajuan = $_GET["id_pengajuan"];

$pengajuan_detail = query(
    "SELECT * FROM pengajuan_detail
    WHERE id_pengajuan = $id_pengajuan"
);

$total_pengajuan = query(
    "SELECT SUM(jumlah) AS amount FROM pengajuan_detail WHERE id_pengajuan = $id_pengajuan"
)[0];

$html = '<body>
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
                DAFTAR PENGAJUAN KEBUTUHAN ALAT / BAHAN / FASILITAS
                <br>
                TAHUN PELAJARAN ' . date("Y") . '-' . date("Y", strtotime("+1 year", strtotime(date("Y")))) . '
                </p>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-bottom: 20px;">
        <tr>
            <td width="40%" style="text-align: left;">
                <p style="font-size: 12px; font-style: bold;">
                Program Keahlian    : Teknik Komputer Jaringan
                <br>
                Semester    :
                </p>
            </td>
            <td width="60%"></td>
        </tr>
    </table>

    <table border="1" cellpadding="10px" cellspacing="0" width="100%" style="font-size: 10px">
        <tr style="background-color: #6495ED; font-weight: bold; color: #fff;">
            <td style="text-align: center;">NO.</td>
            <td style="text-align: center;">NAMA ALAT / BARANG</td>
            <td style="text-align: center;">SPESIFIKASI</td>
            <td style="text-align: center;">QTY</td>
            <td style="text-align: center;">HARGA SATUAN</td>
            <td style="text-align: center;">TOTAL HARGA</td>
            <td style="text-align: center;">KETERANGAN</td>
        </tr>';

$no = 1;
foreach ($pengajuan_detail as $pd) {
    $html .=
        '<tr>
            <td style="text-align: center;">' . $no . '</td>
            <td>' . $pd["nama_barang"] . '</td>
            <td>' . $pd["spesifikasi"] . '</td>
            <td style="text-align: center;">' . $pd["qty"] . '</td>
            <td style="text-align: right;">Rp. ' . number_format($pd["harga"], 0, ',', '.') . '</td>
            <td style="text-align: right;">Rp. ' . number_format($pd["jumlah"], 0, ',', '.') . '</td>
            <td style="text-align: left;">' . $pd["keterangan"] . '</td>
        </tr>';
    $no++;
}

$html .= '
    <tr>
        <td colspan="5" style="text-align: right;">TOTAL</td>
        <td>Rp. ' . number_format($total_pengajuan["amount"], 0, ',', '.') . '</td>
        <td></td>
    </tr>
</table>';

$html .= '
<table width="100%" style="margin-top: 20px;">
        <tr>
            <td width="30%" style="text-align: center;">
                <p style="font-size: 10;">
                Mengetahui,
                <br>
                Kepala Kompetensi Teknik Komputer Jaringan
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <strong>Iwan Hermawan, S.Kom</strong>
                <br>
                NIP. 19830222 2022211 0 11
                </p>
            </td>
            <td width="40%"></td>
            <td width="30%" style="text-align: center;">
                <p style="font-size: 10;">
                Pagelaran,' . date("d F Y") . '
                <br>
                Pengelola / Unit Kerja / Yang Mengusulkan
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <strong>Beni Agustian</strong>
                </p>
            </td>
        </tr>
    </table>
</body>';

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4',
    'orientation' => 'P',
]);

$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('Lembar Pengajuan Alat & Bahan.pdf', 'I');
// $mpdf->Output();
