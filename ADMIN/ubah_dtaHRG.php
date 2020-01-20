<?php
  session_start();
  require 'connection.php';

  if(!isset($_SESSION["login"])){
    header("Location: index.php?status=notlogin");
  }

  $id  = $_GET['id']; 
  $sql = mysqli_query($conn, "SELECT * FROM det_laptop WHERE ID_DET_LAPTOP = '". $id ."'");
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

  <title>RIZQUINA Admin | Edit Harga</title>

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

    if(isset($_GET['result']))
    {
      $result = $_GET['result'];

      if($result === 'failed')
      {
        echo "<script>alert('Ada masalah, coba lagi');</script>";;
      }else
      {
        
      }

    }else
    {
      $result = '';
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
                <h1 class="h4 text-gray-900 mb-4">Ubah Harga!</h1>
              </div>
              <form action="edit_harga.php" class="user" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="id" placeholder="" name="id" value="<?= $_GET['id']; ?>" hidden>
                </div>
                <div class="input-group">
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
                <?php $status = $row['STATUS_GARANSI']; 
                    if($status == 0){
                        $status = "Tidak";
                    } else {
                        $status = "Ada";
                    }
                ?>  
                <div class="input-group mb-3">
                  <select class="custom-select" id="inputGroupSelect01" name="garansi">
                    <option selected  value="<?= $row['STATUS_GARANSI']; ?>"><?= $status; ?></option>
                    <option value="1">Ada</option>
                    <option value="0">Tidak</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="lama" placeholder="Lama Garansi" name="lama" value="<?= $row['LAMA_GARANSI']; ?>">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block" name="simpan"> Simpan </button>
                <a href="data_produk.php" class="btn btn-primary btn-user btn-block" name="batal"> Batal </a>
              </form>
<?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/igorescobar/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){

                // Format mata uang.
                $('.beli').mask('0.000.000.000', {reverse: true});

            })
        </script>

        <script type="text/javascript">
            $(document).ready(function(){

                // Format mata uang.
                $('.jual').mask('0.000.000.000', {reverse: true});

            })
        </script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
