<?php
  session_start();
  require 'connection.php';

  if(!isset($_SESSION["login"])){
    header("Location: index.php?status=notlogin");
  }
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
        echo "<script>alert('Ada masalah saat memosting');</script>";;
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
      <div class="card-body p-3">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Tambah Postingan!</h1>
              </div>
              <form action="function_tbhPOS.php" class="user" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="judul" placeholder="Judul Postingan" name="judul">
                </div>                
                <div class=form-group>
                    <div class="custom-file">
                      <input type="file" name="fotoPOS" id="fotoPOS" class="custom-file-input">
                      <label for="fotoPOS" class="custom-file-label"> Pilih foto.... </label>
                    </div>
                </div>
                <div class="input-group mb-3">
                  <textarea class="form-control" aria-label="With textarea" placeholder="Isi Postingan" name="isi"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block" name="posting"> Posting </button>
                <a href="data_posting.php" class="btn btn-primary btn-user btn-block" name="batal"> Batal </a>
                <!-- <hr> -->
                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a> -->
              </form>
              <!-- <hr> -->
            </div>
          </div>
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
