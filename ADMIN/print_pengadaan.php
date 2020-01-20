<?php

require_once __DIR__ . '/vendor/autoload.php';
require 'connection.php';
$sql = mysqli_query($conn, "SELECT * FROM pengadaan_barang inner join detail_pengadaan on detail_pengadaan.ID_PENGADAAN_BARANG = pengadaan_barang.ID_PENGADAAN_BARANG inner join user on pengadaan_barang.ID_USER = user.ID_USER inner join det_laptop on detail_pengadaan.ID_DET_LAPTOP = det_laptop.ID_DET_LAPTOP inner join laptop on det_laptop.ID_LAPTOP = laptop.ID_LAPTOP");

$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/print.css">
</head>
<body>
    <h1>Data Pengadaan</h1>
    <h3>RIZQUINA Laptop</h3>
    <p><b>Alamat: </b>Jl. Mastrip</p>
    <hr>
    <p class="tgl">Tanggal: '.date("Y-m-d H:i:s").'</p>
    <table class="tbl1" border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th class="text-center">No.</th>
            <th class="text-center">ID Pengadaan</th>
            <th class="text-center">Nama Admin</th>
            <th class="text-center">Nama Laptop</th>
            <th class="text-center">Stok</th>
            <th class="text-center">Tanggal Pengadaan</th>
        </tr>';
        $i = 1; 
        while($row = mysqli_fetch_assoc($sql)) { 
        $tgl = date('d-m-Y', strtotime($row['TANGGAL_TRANSAKSI'])); // Ubah format tanggal jadi dd-mm-yyyy                     
        $html .= '<tr>
            <td class="text-center">'. $i .'</td>
            <td class="text-center"><b>#'. $row["ID_PENGADAAN_BARANG"] .'</b></td>
            <td class="text-center">'. $row["NAMA_USER"] .'</td>
            <td class="text-center">'. $row["NAMA_LAPTOP"] .'</td>
            <td class="text-center">'. $row["detail_stok_pengadaan"] .'</td>
            <td class="text-center">'. $row["TANGGAL_PENGADAAN_BARANG"] .'</td>
        </tr>';
        $i++;
        }
    $html .= '</table>
        <hr>
        <table width="80%" border="0" align="center" cellspacing="0" cellpadding="2">
            <tr class="ttd">
            <td width="60%">&nbsp;</td>
            <td>Jember, '.date("d-m-Y").'</td>	
            </tr>
            <tr class="ttd">
            <td>&nbsp;</td>
            <td>Pemilik Toko</td>	
            </tr>
            <tr class="ttd">
            <td>&nbsp;</td>
            <td>RIZQUINA Laptop</td>	
            </tr>
            <tr class="ttd">
            <td>&nbsp;</td>
            <td>&nbsp;</td>	
            </tr>
            <tr class="ttd">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
            <tr class="ttd">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
            <tr class="ttd">
            <td>&nbsp;</td>
            <td>Bpk. Andreanto</td>
            </tr>
        </table>
</body>
</html>';
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
$mpdf->WriteHTML($html);
$mpdf->Output('rekap-pengadaan.pdf', \Mpdf\Output\Destination::INLINE);

?>

