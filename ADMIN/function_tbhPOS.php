<?php
    session_start();
    require 'connection.php';

    // Buat ID varchar auto increment
    $cri_id     = mysqli_query($conn, "SELECT max(ID_POSTING) AS id FROM posting");
    $date       = date(dmy);
    $cari       = mysqli_fetch_array($cri_id);
    $kode       = substr($cari['id'],10,13);
    $id_tbh     = $kode+1;
    
    if($id_tbh<10){
        $id="POS".$date."000".$id_tbh;
    }
    elseif($id_tbh>=10 && $id_tbh<100){
        $id="POS".$date."00".$id_tbh;
    }
    elseif($id_tbh>=100 && $id_tbh<1000){
        $id="POS".$date."0".$id_tbh;
    }else{
        $id="POS".$date.$id_tbh;
    }

    if(isset($_POST['posting']))
    {
        $id_user    = $_SESSION["ID_USER"];
        $judul      = htmlspecialchars($_POST["judul"]);
        $fotoPOS    = upload();
        $isi        = htmlspecialchars($_POST["isi"]); 
        $tanggal    = date("Y-m-d H:i:s");

        if(!$fotoPOS) {
            return false;
        }
            // insert data ke database
            $password = password_hash($password, PASSWORD_BCRYPT);
            $insert_sql = "INSERT INTO posting VALUES('".$id."','".$id_user."','".$judul."','".$fotoPOS."','".$isi."','".$tanggal."')";
            
            $var = mysqli_query($conn, $insert_sql);
            if($var == true)
            {
                header("Location: data_posting.php?message=success");
            }else
            {
                header("Location: tambah_posting.php?message=failed");
            }        
    } else 
    {
        header("Location: tambah_posting.php");
    }
    
    // function upload foto profil admin
    function upload() {
        $namaFile   = $_FILES['fotoPOS']['name'];
        $ukuranFile = $_FILES['fotoPOS']['size'];
        $error      = $_FILES['fotoPOS']['error'];
        $tmpName    = $_FILES['fotoPOS']['tmp_name'];
    
        // cek apakah tidak ada gambar yang di upload
        if($error === 4){
            header("Location: tambah_posting.php?upload=nothing");
        } else
        {
            header("Location: tambah_posting.php?upload=right");
        }
    
        // cek apakah itu upload gambar atau bukan
        $ekstensiGambarValid  = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar       = explode('.', $namaFile);
        $ekstensiGambar       = strtolower(end($ekstensiGambar));
        if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
                    alert('Yang anda upload bukan Gambar');
                </script>";
            return false;
            }
    
        // cek jika ukuran gambar terlalu besar
        if($ukuranFile > 1000000) {
            echo "<script>
                    alert('Ukuran Gambar terlalu besar, maksimal 1 Mb');
                </script>";
            return false;
        }
    
        // lolos pengecekan, gambar siap upload
        // generate nama baru
        $namaFileBaru  = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;
        move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
        return $namaFileBaru;
    } 
?>
