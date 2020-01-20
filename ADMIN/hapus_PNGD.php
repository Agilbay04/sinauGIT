<?php
// Load file koneksi.php
require 'connection.php';
// Ambil data NIS yang dikirim oleh admin.php melalui URL
$id = $_GET['id'];
// Query untuk menghapus data siswa berdasarkan NIS yang dikirim
$query2 = "DELETE FROM pengadaan_barang WHERE ID_PENGADAAN_BARANG = '".$id."'";
$query2 = "DELETE FROM detail_pengadaan WHERE ID_PENGADAAN_BARANG = '".$id."'";
$sql2 = mysqli_query($conn, $query2); // Eksekusi/Jalankan query dari variabel $query
if($sql2){ // Cek jika proses simpan ke database sukses atau tidak
  // Jika Sukses, Lakukan :
    echo "<script>alert('Data Berhasil Dihapus');document.location.href='data_pengadaan.php'</script>\n"; // Redirect ke halaman admin.php
}else{
  // Jika Gagal, Lakukan :
    echo "<script>alert('Data Gagal Dihapus');document.location.href='data_pengadaan.php'</script>\n";
}
?>