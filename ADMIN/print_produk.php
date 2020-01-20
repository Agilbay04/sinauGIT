<?php

require_once __DIR__ . '/vendor/autoload.php';
require 'connection.php';
$sql = mysqli_query($conn, "SELECT * FROM laptop LEFT JOIN det_laptop ON laptop.ID_LAPTOP=det_laptop.ID_LAPTOP");

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
    <h1>Data Produk</h1>
    <h3>RIZQUINA Laptop</h3>
    <p><b>Alamat: </b>Jl. Mastrip</p>
    <hr>
    <p class="tgl">Tanggal: '.date("Y-m-d H:i:s").'</p>
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th class="text-center">No.</th>
            <th class="text-center">ID Laptop</th>
            <th class="text-center">Gambar Laptop</th>
            <th class="text-center">Nama Laptop</th>
            <th class="text-center">Processor</th>
            <th class="text-center">RAM</th>
            <th class="text-center">Harddisk</th>
            <th class="text-center">VGA</th>
            <th class="text-center">Ukuran Layar</th>
            <th class="text-center">Sound Card</th>
            <th class="text-center">Stok</th>
            <th class="text-center">Harga Beli</th>
            <th class="text-center">Harga Jual</th>
            <th class="text-center">Garansi</th>
            <th class="text-center">Lama Garansi</th>
        </tr>';
        $i = 1; 
        while($row = mysqli_fetch_assoc($sql)) { 
        // $tgl = date('d-m-Y', strtotime($row['TANGGAL_DAFTAR'])); // Ubah format tanggal jadi dd-mm-yyyy                     
        $html .= '<tr>
        <td class="text-center">'.  $i .'</td>
        <td class="text-center"><b>#'. $row["ID_DET_LAPTOP"] .'</b></td>
        <td class="text-center"><img src="img/'. $row["GAMBAR_LAPTOP"] .'>" alt="gambar laptop" width="100"></td>
        <td class="text-center">'. $row["NAMA_LAPTOP"] .'</td>
        <td class="text-center">'. $row["PROCESSOR"] .'</td>
        <td class="text-center">'. $row["RAM"] .'</td>
        <td class="text-center">'. $row["HARDDISK"] .'</td>
        <td class="text-center">'. $row["VGA"] .'</td>
        <td class="text-center">'. $row["UKURAN_LAYAR"] .'</td>
        <td class="text-center">'. $row["SOUND_CARD"] .'</td>
        <td class="text-center">'. $row["stok_detail"] .'</td>
        <td class="text-center">Rp.'. number_format($row["HARGA_BELI"]) .'</td>
        <td class="text-center">Rp.'. number_format($row["HARGA_JUAL"]) .'</td>';
        $garansi = $row["STATUS_GARANSI"]; 
            if($garansi === '0'){
                $garansi = "TIDAK ADA";
            } elseif($garansi == 1) {
                $garansi ="ADA";
            }
        $html .= '<td class="text-center">'. $garansi .'</td>
        <td class="text-center">'. $row["LAMA_GARANSI"] .'</td>
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
$mpdf->WriteHTML($html);
$mpdf->Output('rekap-data-produk.pdf', \Mpdf\Output\Destination::INLINE);

?>

