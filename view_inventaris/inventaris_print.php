<?php
require_once '../vendor/autoload.php';
require '../functions.php';

$inventaris = query(
    "SELECT * FROM inventaris
    INNER JOIN kondisi ON inventaris.id_kondisi = kondisi.id_kondisi"
);

$html = '<body>
    <table cellpadding="20px" cellspacing="0" width="100%">
        <tr>
            <td width="100%" style="text-align: center; font-size: 10;">
                <p>BUKU INVENTARIS SARANA PRASARANA</p>
                <p>SMK NEGERI 1 PAGELARAN - CIANJUR</p>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-bottom: 20px;">
        <tr>
            <td width="30%">
                <p style="font-size: 10;">
                Program Keahlian : <strong>Teknik Komputer Jaringan</strong>
                <br>
                Ketua Program Keahlian : <strong>Iwan Hermawan, S.Kom</strong>
                </p>
            </td>
            <td width="40%"></td>
            <td width="30%">
                <p style="font-size: 10;">
                Tahun Ajaran / Anggaran : <strong>' . date("Y") . '-' . date("Y", strtotime("+1 year", strtotime(date("Y")))) . '</strong>
                <br>
                Periode Laporan / Bulan : <strong>' . date("F") . '</strong>
                </p>
            </td>
        </tr>
    </table>

    <table border="1" cellpadding="10px" cellspacing="0" width="100%" style="font-size: 10px">
        <tr style="background-color: #6495ED; font-weight: bold; color: #fff;">
            <td style="text-align: center;">NO.</td>
            <td style="text-align: center;">NAMA BARANG</td>
            <td style="text-align: center;">MERK</td>
            <td style="text-align: center;">QTY</td>
            <td style="text-align: center;">HARGA</td>
            <td style="text-align: center;">TOTAL HARGA</td>
            <td style="text-align: center;">TAHUN PEROLEHAN</td>
            <td style="text-align: center;">KONDISI</td>
        </tr>';

$no = 1;
foreach ($inventaris as $i) {
    $html .=
        '<tr>
            <td style="text-align: center;">' . $no . '</td>
            <td>' . $i["nama_barang"] . '</td>
            <td>' . $i["merk"] . '</td>
            <td style="text-align: center;">' . $i["qty"] . '</td>
            <td style="text-align: right;">Rp. ' . number_format($i["harga"], 0, ',', '.') . '</td>
            <td style="text-align: right;">Rp. ' . number_format($i["qty"] * $i["harga"], 0, ',', '.') . '</td>
            <td style="text-align: center;">' . $i["tahun_perolehan"] . '</td>
            <td style="text-align: center;">' . $i["kondisi"] . '</td>
        </tr>';
    $no++;
}

$html .= '</table>
</body>';

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
                Kepala Lab Teknik Komputer Jaringan
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
    </table>';

$html .= '
<table width="100%" style="margin-top: 20px;">
        <tr>
            <td width="30%"></td>
            <td width="40%" style="text-align: center;">
                <p style="font-size: 10;">
                Mengetahui,
                <br>
                Kepala Sekolah
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <strong>Faisal Sandi, S.Pd., M.Pd</strong>
                <br>
                NIP. 19850410 2010011 0 17
                </p>
            </td>
            <td width="30%"></td>
        </tr>
    </table>';

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4',
    'orientation' => 'L',
]);

$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('Buku Inventaris Sarpras.pdf', 'I');
// $mpdf->Output();
