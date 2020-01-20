<?php
session_start();
require 'connection.php';
if(isset($_POST['login'])) {
    
    $email    = $_POST["email"];
    $password = $_POST["password"];
    $result   = mysqli_query($conn, "SELECT * FROM user WHERE EMAIL_USER = '$email' AND HAK_AKSES_USER != 2");
    $cek      = mysqli_num_rows($result);
    
    if($cek === 1) {
        $row    = mysqli_fetch_assoc($result);
        $id     = $row['ID_USER'];
        $nama   = $row['NAMA_USER'];
        $foto   = $row['FOTO_PROFIL_USER'];
        $jk     = $row['JENIS_KELAMIN'];
        $alamat = $row['ALAMAT_USER'];
        $email  = $row['EMAIL_USER'];
        $hak    = $row['HAK_AKSES_USER'];
        if($row['HAK_AKSES_USER'] == 2){
            header("Location: login.php?status=false");
        } else {
            if(password_verify($password, $row['PASSWORD_USER'])){
                $_SESSION['ID_USER']   = $id;
                $_SESSION['NAMA_USER'] = $nama;
                $_SESSION['FOTO_PROFIL_USER'] = $foto;
                $_SESSION['JENIS_KELAMIN'] = $jk;
                $_SESSION['ALAMAT_USER'] = $alamat;
                $_SESSION['EMAIL_USER'] = $email;
                $_SESSION['HAK_AKSES_USER'] = $hak;
                $_SESSION["login"] = true;
                header("Location: index.php?status=true");
            } else {
                header("Location: index.php?status=false");
            }
        }
    } else {
        header("Location: index.php?status=nothing");
    }
} else {
    echo ""; 
}