<?php
// Load file koneksi.php
require 'connection.php';
// Ambil data NIS yang dikirim oleh admin.php melalui URL
$id = $_GET['id'];
// Query untuk menampilkan data siswa berdasarkan NIS yang dikirim
$query = "SELECT * FROM bukti_bayar WHERE ID_TRANSAKSI='".$id."'";
$sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
$data = mysqli_fetch_array($sql); // Ambil data dari hasil eksekusi $sql
// Cek apakah file fotonya ada di folder images
if(is_file("../../Project_Web_Revamp/assets/images/user_bukti_bayar".$data['BUKTI_BAYAR'])) // Jika foto ada
  unlink("../../Project_Web_Revamp/assets/images/user_bukti_bayar".$data['BUKTI_BAYAR']); // Hapus foto yang telah diupload dari folder images
// Query untuk menghapus data siswa berdasarkan NIS yang dikirim
$query2 = "DELETE FROM transaksi WHERE ID_TRANSAKSI = '".$id."'";
$query2 = "DELETE FROM detail_transaksi WHERE ID_TRANSAKSI = '".$id."'";
$query2 = "DELETE FROM bukti_bayar WHERE ID_TRANSAKSI = '".$id."'";
$sql2 = mysqli_query($conn, $query2); // Eksekusi/Jalankan query dari variabel $query
if($sql2){ // Cek jika proses simpan ke database sukses atau tidak
  // Jika Sukses, Lakukan :
    echo "<script>alert('Data Berhasil Dihapus');document.location.href='data_transaksi.php'</script>\n"; // Redirect ke halaman admin.php
}else{
  // Jika Gagal, Lakukan :
    echo "<script>alert('Data Gagal Dihapus');document.location.href='data_transaksi.php'</script>\n";
}
?>