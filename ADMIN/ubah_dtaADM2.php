<?php
  session_start();
  require_once 'connection.php';

  if(!isset($_SESSION["login"])){
    header("Location: index.php?status=notlogin");
  }

  $id  = $_GET['id']; 
  $sql = mysqli_query($conn, "SELECT * FROM user WHERE ID_USER = '".$id."'");
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

  <title>SB Admin 2 - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

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
                <h1 class="h4 text-gray-900 mb-4">Ubah Data!</h1>
              </div>
              <form action="edit_admin2.php" class="user" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="ID" name="id" value="<?= $row['ID_USER'];?>" hidden>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="Name" placeholder="Nama Lengkap" name="nama" value="<?= $row["NAMA_USER"]; ?>">
                </div>
                <div class="input-group mb-3">
                  <select class="custom-select" id="inputGroupSelect01" name="jk">
                    <option selected value="<?= $row['JENIS_KELAMIN']; ?>"><?= $row["JENIS_KELAMIN"]; ?></option>
                    <option value="1">Laki-laki</option>
                    <option value="2">Perempuan</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <textarea class="form-control" aria-label="With textarea" placeholder="Alamat" name="alamat"><?= $row["ALAMAT_USER"]; ?></textarea>
                </div>
                <div class="form-group">    
                  <input type="text" class="form-control form-control-user" id="NoHp" placeholder="No Handphone" name="nohp" value="<?= $row["NO_HP_USER"]; ?>">
                </div>
                    <!-- <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
                  </div> -->
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Alamat Email" name="email" value="<?= $row["EMAIL_USER"]; ?>">
                </div>
                <?php $foto = $row["FOTO_PROFIL_USER"]; ?>
                <div class=form-group>
                    <div class="custom-file">
                      <input type="file" name="foto" id="foto" value="<?= $foto; ?>" class="custom-file-input">
                      <label for="fotoProfil" class="custom-file-label"></label>
                      <input type="checkbox" aria-label="Checkbox for following text input" name="ubah"> Silahkan Ceklist jika ingin mengubah foto
                    </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="exampleInputEmail" name="token" readonly hidden value="<?= $row['TOKEN_USER']; ?>">
                </div>
                <div class="form-group">
                  <input type="date" class="form-control form-control-user" id="exampleInputEmail" name="tanggal" readonly hidden value="<?= $row['TANGGAL_DAFTAR']; ?>">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="exampleInputEmail" name="aktivasi" readonly hidden value="<?= $row['STATUS_AKTIVASI']; ?>">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block" name="edit"> Ubah </button>
                <a href="profil.php" class="btn btn-primary btn-user btn-block" name="batal">Batal</a>
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
