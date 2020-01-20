<?php
// Load file koneksi.php
require 'connection.php';
// Ambil data NIS yang dikirim oleh admin.php melalui URL
$id = $_GET['id'];
// Query untuk menampilkan data siswa berdasarkan NIS yang dikirim
$query = "SELECT * FROM user WHERE ID_USER='".$id."'";
$sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
$data = mysqli_fetch_array($sql); // Ambil data dari hasil eksekusi $sql
// Cek apakah file fotonya ada di folder images
if(is_file("img".$data['FOTO_PROFIL_USER'])) // Jika foto ada
  unlink("img".$data['FOTO_PROFIL_USER']); // Hapus foto yang telah diupload dari folder images
// Query untuk menghapus data siswa berdasarkan NIS yang dikirim
$query2 = "DELETE FROM user WHERE ID_USER='".$id."'";
$sql2 = mysqli_query($conn, $query2); // Eksekusi/Jalankan query dari variabel $query
if($sql2){ // Cek jika proses simpan ke database sukses atau tidak
  // Jika Sukses, Lakukan :
    echo "<script>alert('Data Berhasil Dihapus');document.location.href='data_admin.php'</script>\n"; // Redirect ke halaman admin.php
}else{
  // Jika Gagal, Lakukan :
    echo "<script>alert('Data Gagal Dihapus');document.location.href='data_admin.php'</script>\n";
}
?>