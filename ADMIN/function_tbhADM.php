<?php
    require 'connection.php';

        // Buat ID varchar auto increment
        $cri_id     = mysqli_query($conn, "SELECT max(ID_USER) AS id FROM user");
        $date       = date(dmy);
        $cari       = mysqli_fetch_array($cri_id);
        $kode       = substr($cari['id'],10,13);
        $id_tbh     = $kode+1;
        
        if($id_tbh<10){
            $id="ADM".$date."000".$id_tbh;
        }
        elseif($id_tbh>=10 && $id_tbh<100){
            $id="ADM".$date."00".$id_tbh;
        }
        elseif($id_tbh>=100 && $id_tbh<1000){
            $id="ADM".$date."0".$id_tbh;
        }else{
            $id="ADM".$date.$id_tbh;
        }

    if(isset($_POST['register']))
    {
        $nama       = htmlspecialchars($_POST["nama"]);
        $jk         = htmlspecialchars($_POST["jk"]);
        $alamat     = htmlspecialchars($_POST["alamat"]);
        $nohp       = htmlspecialchars($_POST["nohp"]);
        $email      = htmlspecialchars(strtolower(stripslashes($_POST["email"])));
        $password   = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["password"]));
        $password2  = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["password2"]));  
        $fotoProfil = upload();
        $tanggal    = date("Y-m-d H:i:s");
        $result     = mysqli_query($conn, "SELECT EMAIL_USER FROM user WHERE EMAIL_USER = '$email'");
        
        if(empty($foto)) {
            $fotoProfil = 'user.png';
        }

        // if(!$fotoProfil) {
        //     return false;
        // }

        // Cek apakah username yang ditambahkan sudah ada
        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                    alert('Email ini telah terdaftar, gunakan email lain!');
                </script>";
            return false;
        }
            
        // Cek konfirmasi password
        if($password !== $password2) {
            header("Location: tambah_admin.php?confirm=false");   
        } else 
        {
            // insert data ke database
            $password = password_hash($password, PASSWORD_BCRYPT);
            $insert_sql = "INSERT INTO user VALUES ('".$id."','".$nama."','".$jk."','".$alamat."','".$nohp."','".$email."', '".$password."','".$fotoProfil."','',1,'".$tanggal."','')";
            $var = mysqli_query($conn, $insert_sql);
            if($var == true)
            {
                header("Location: data_admin.php?message=success");
            }else
            {
                var_dump($insert_sql);
                // header("Location: data_admin.php?message=failed");
            }
        }        
    } else 
    {
        header("Location: data_admin.php");
    }
    
    // function upload foto profil admin
    function upload() {
        $namaFile   = $_FILES['fotoProfil']['name'];
        $ukuranFile = $_FILES['fotoProfil']['size'];
        $error      = $_FILES['fotoProfil']['error'];
        $tmpName    = $_FILES['fotoProfil']['tmp_name'];
    
        // cek apakah tidak ada gambar yang di upload
        // if($error === 4){
        //     header("Location: tambah_admin.php?upload=nothing");
        // } else
        // {
        //     header("Location: tambah_admin.php?upload=right");
        // }
    
        // cek apakah itu upload gambar atau bukan
        $ekstensiGambarValid  = ['jpg', 'jpeg', 'png', 'svg'];
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
