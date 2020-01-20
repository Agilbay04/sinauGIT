<?php

require_once __DIR__ . '/vendor/autoload.php';
require 'connection.php';
$sql = mysqli_query($conn, $sql = "SELECT * FROM user WHERE HAK_AKSES_USER = 2");

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
    <h1>Data Pelanggan</h1>
    <h3>RIZQUINA Laptop</h3>
    <p><b>Alamat: </b>Jl. Mastrip</p>
    <hr>
    <p class="tgl">Tanggal: '.date("Y-m-d H:i:s").'</p>
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th class="text-center">No.</th>
            <th class="text-center">ID Pelanggan</th>
            <th class="text-center">Nama Pelanggan</th>
            <th class="text-center">Jenis Kelamin</th>
            <th class="text-center">Alamat</th>
            <th class="text-center">No. HP</th>
            <th class="text-center">Email</th>
            <th class="text-center">Foto Profil</th>
            <th class="text-center">Tanggal Daftar</th>
        </tr>';
        $i = 1; 
        while($row = mysqli_fetch_assoc($sql)) { 
        $tgl = date('d-m-Y', strtotime($row['TANGGAL_DAFTAR'])); // Ubah format tanggal jadi dd-mm-yyyy                     
        $html .= '<tr>
            <td class="text-center">'.$i .'</td>
            <td class="text-center"><b>#'.$row["ID_USER"].'</b></td>
            <td class="text-center">'.$row["NAMA_USER"].'</td>
            <td class="text-center">'.$row["JENIS_KELAMIN"].'</td>
            <td class="text-center">'.$row["ALAMAT_USER"].'</td>
            <td class="text-center">'.$row["NO_HP_USER"].'</td>
            <td class="text-center">'.$row["EMAIL_USER"].'</td>
            <td class="text-center"><img src="img/'.$row["FOTO_PROFIL_USER"].'" alt="gambar" width="50"></td>
            <td class="text-center">'.$row["TANGGAL_DAFTAR"].'</td>
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
$mpdf->Output('rekap-data-pelanggan.pdf', \Mpdf\Output\Destination::INLINE);

?>

