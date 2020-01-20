<?php
// Load file koneksi.php
require 'connection.php';
// Ambil data NIS yang dikirim oleh form_ubah.php melalui URL
$id = $_POST['id'];
// Ambil Data yang Dikirim dari Form
$beli = $_POST['beli'];
$jual = $_POST['jual'];
$garansi = $_POST['garansi'];
$lama = $_POST['lama'];

    // Proses ubah data ke Database
    $query = "UPDATE det_laptop SET HARGA_BELI='" . $beli . "', HARGA_JUAL='" . $jual . "', STATUS_GARANSI='" . $garansi . "', LAMA_GARANSI='" . $lama . "'  WHERE ID_DET_LAPTOP='" . $id . "'";
    $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
    if ($sql) { // Cek jika proses simpan ke database sukses atau tidak
      // Jika Sukses, Lakukan :
      echo "<script>alert('Data Berhasil Disimpan');document.location.href='data_produk.php'</script>\n"; // Redirect ke halaman admin.php
    } else {
      // Jika Gagal, Lakukan :
        echo "<script>alert('Data Gagal Disimpan karena gagal terhubung ke server');document.location.href='data_produk.php'</script>\n";
    }
?>