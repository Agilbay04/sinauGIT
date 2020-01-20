<?php
  session_start();
  require 'connection.php';

  if(!isset($_SESSION["login"])){
    header("Location: index.php?status=notlogin");
  }

  $id  = $_GET['id'];
  $sql = mysqli_query($conn, "SELECT * FROM laptop WHERE ID_LAPTOP='". $id ."'");
  while($row = mysqli_fetch_assoc($sql)) {
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>RIZQUINA Admin - Tambah Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <?php 
    if(isset($_GET['upload']))
    {
      $upload = $_GET['upload'];

      if($upload === 'nothing')
      {
        echo "<script>alert('Masukkan gambar terlebih dahulu');</script>";
      } else 
      {

      }
    } else
    {
      $upload = '';
    }

    if(isset($_GET['message']))
    {
      $message = $_GET['message'];

      if($message === 'failed')
      {
        echo "<script>alert('Ada masalah saat menambahkan produk');</script>";;
      }else
      {
        
      }

    }else
    {
      $message = '';
    }
  ?>

  <div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">
  <div class="col-lg-7 mt-5">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Ubah Produk!</h1>
              </div>
              <form action="edit_produk.php" class="user" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="Name" placeholder="id" name="id" value="<?= $_GET['id']; ?>" hidden>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="Name" placeholder="Nama Laptop" name="nama" value="<?= $row['NAMA_LAPTOP']; ?>">
                </div>
                <?php $foto = $row['GAMBAR_LAPTOP']; ?>
                <div class=form-group>
                    <div class="custom-file">
                      <input type="file" name="fotoPRD" id="fotoPRD" class="custom-file-input" value="<?= $foto; ?>">
                      <label for="fotoProfil" class="custom-file-label"> Pilih Gambar Laptop .... </label>
                      <input type="checkbox" aria-label="Checkbox for following text input" name="ubah"> Silahkan Ceklist jika ingin mengubah foto
                    </div>
                </div>
                <div class="form-group">    
                  <input type="text" class="form-control form-control-user" id="processor" placeholder="Processor" name="processor" value="<?= $row['PROCESSOR']; ?>">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="ram" placeholder="RAM" name="ram" value="<?= $row['RAM']; ?>">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="harddisk" placeholder="Harddisk" name="harddisk" value="<?= $row['HARDDISK']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="vga" placeholder="VGA" name="vga" value="<?= $row['VGA']; ?>">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="layar" placeholder="Ukuran Layar" name="layar" value="<?= $row['UKURAN_LAYAR']; ?>">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="sound" placeholder="Sound Card" name="sound" value="<?= $row['SOUND_CARD']; ?>">
                </div>
                <!-- <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input type="text" class="form-control" id="beli" placeholder="Harga Beli" name="beli" value="<?= $row['HARGA_BELI']; ?>" require>
                </div>
                <br>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>    
                  <input type="text" class="form-control" id="jual" placeholder="Harga Jual" name="jual" value="<?= $row['HARGA_JUAL']; ?>" require>
                </div>
                <br>
                <?php $garansi = $row['STATUS_GARANSI']; 
                  if($garansi == 0){
                    $garansi = "Tidak";
                  } elseif($garansi == 1){
                    $garansi = "Ada";
                  }
                ?>  
                <div class="input-group mb-3">
                  <select class="custom-select" id="inputGroupSelect01" name="garansi">
                    <option selected value="<?= $row['STATUS_GARANSI']; ?>"><?= $garansi; ?></option>
                    <option value="1">Ada</option>
                    <option value="0">Tidak</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="lama" placeholder="Lama Garansi" name="lama" value="<?= $row['LAMA_GARANSI']; ?>">
                </div> -->
                <button type="submit" class="btn btn-primary btn-user btn-block" name="simpan"> Simpan </button>
                <a href="data_produk.php" class="btn btn-primary btn-user btn-block" name="batal"> Batal </a>
                <!-- <hr> -->
                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">   
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a> -->
              </form>
  <?php } ?>
              <!-- <hr> -->
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
