<?php
// Load file koneksi.php
require 'connection.php';
// Ambil data NIS yang dikirim oleh form_ubah.php melalui URL
$id = $_POST['id'];
// Ambil Data yang Dikirim dari Form
$nama = $_POST['nama'];
$jk   = $_POST['jk'];
$alamat = $_POST['alamat'];
$nohp = $_POST['nohp'];
$email = $_POST['email'];

// Cek apakah user ingin mengubah fotonya atau tidak
if (isset($_POST['ubah'])) { // Jika user menceklis checkbox yang ada di form ubah, lakukan :
  // Ambil data foto yang dipilih dari form
  $foto = $_FILES['foto']['name'];
  $tmp = $_FILES['foto']['tmp_name'];
  $ukuran =$_FILES['foto']['size'];

  // cek apakah itu upload gambar atau bukan
  $ekstensiGambarValid  = ['jpg', 'jpeg', 'png', 'svg'];
  $ekstensiGambar       = explode('.', $foto);
  $ekstensiGambar       = strtolower(end($ekstensiGambar));
  if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      echo "<script>
              alert('Yang anda upload bukan Gambar');
          </script>";
      return false;
      }

  // cek jika ukuran gambar terlalu besar
  if($ukuran > 1000000) {
      echo "<script>
              alert('Ukuran Gambar terlalu besar, maksimal 1 Mb');
          </script>";
      return false;
    }

  // Rename nama fotonya dengan menambahkan tanggal dan jam upload
  $fotobaru = date('dmYHis') . $foto;

  // Set path folder tempat menyimpan fotonya
  $path = "img/" . $fotobaru;
  // Proses upload
  if (move_uploaded_file($tmp, $path)) { // Cek apakah gambar berhasil diupload atau tidak
    // Query untuk menampilkan data siswa berdasarkan NIS yang dikirim
    $query   = "SELECT * FROM user WHERE ID_USER='" . $id . "'";
    $sql     = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
    $data    = mysqli_fetch_assoc($sql); // Ambil data dari hasil eksekusi $sql
    // Cek apakah file foto sebelumnya ada di folder images
    if (is_file("img/" . $data['FOTO_PROFIL_USER'])) // Jika foto ada
      unlink("img/" . $data['FOTO_PROFIL_USER']); // Hapus file foto sebelumnya yang ada di folder images

    // Proses ubah data ke Database
    $query = "UPDATE user SET NAMA_USER='" . $nama . "', JENIS_KELAMIN='" . $jk . "', ALAMAT_USER='" . $alamat . "', NO_HP_USER='" . $nohp . "', EMAIL_USER='" . $email . "', FOTO_PROFIL_USER='" . $fotobaru . "' WHERE ID_USER='" . $id . "'";
    $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
    if ($sql) { // Cek jika proses simpan ke database sukses atau tidak
      // Jika Sukses, Lakukan :
      echo "<script>alert('Data Berhasil Disimpan');document.location.href='data_admin.php'</script>\n"; // Redirect ke halaman admin.php
    } else {
      // Jika Gagal, Lakukan :
      echo "<script>alert('Data Gagal Disimpan karena gagal terhubung ke server');document.location.href='data_admin.php'</script>\n";
    }
  } else {
    // Jika gambar gagal diupload, Lakukan :
    echo "<script>alert('Data Gagal Disimpan karena gagal upload foto');document.location.href='data_admin.php'</script>\n";
  }
} else { // Jika user tidak menceklis checkbox yang ada di form ubah, lakukan :
  // Proses ubah data ke Database
  $query = "UPDATE user SET NAMA_USER='" . $nama . "', JENIS_KELAMIN='" . $jk . "', ALAMAT_USER='" . $alamat . "', NO_HP_USER='" . $nohp . "', EMAIL_USER='" . $email . "' WHERE ID_USER='" . $id . "'";
  $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
  
  if ($sql) { // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    echo "<script>alert('Data Berhasil Disimpan');document.location.href='data_admin.php'</script>\n"; // Redirect ke halaman admin.php
  } else {
    // Jika Gagal, Lakukan :
    echo "<script>alert('Data Gagal Disimpan karena gagal terhubung ke server');document.location.href='data_admin.php'</script>\n";
  }
}
?>