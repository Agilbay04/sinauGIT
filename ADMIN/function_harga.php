<?php
    session_start();
    require 'connection.php';

        // Buat ID varchar auto increment
        $date       = date(dmy);
        $cri_id     = mysqli_query($conn, "SELECT max(ID_DET_LAPTOP) AS id FROM det_laptop");
        $cari       = mysqli_fetch_array($cri_id);
        $kode       = substr($cari['id'],10,13);
        $id_tbh     = $kode+1;
        
        if($id_tbh<10){
            $id="PRD".$date."000".$id_tbh;
        }
        elseif($id_tbh>=10 && $id_tbh<100){
            $id="PRD".$date."00".$id_tbh;
        }
        elseif($id_tbh>=100 && $id_tbh<1000){
            $id="PRD".$date."0".$id_tbh;
        }else{
            $id="PRD".$id_tbh;
        }

    if(isset($_POST['simpan']))
    {
        $id1        = htmlspecialchars($_POST["laptop"]);
        $beli       = htmlspecialchars($_POST["beli"]);
        $jual       = htmlspecialchars($_POST["jual"]);
        $garansi    = htmlspecialchars($_POST["garansi"]);
        $lama       = htmlspecialchars($_POST["lama"]);
        $tanggal    = date("Y-m-d");
            
            $insert_sql = "INSERT INTO det_laptop VALUES('".$id."','".$id1."','".$beli."','".$jual."','','".$garansi."','".$lama."','')";
            $var = mysqli_query($conn, $insert_sql);
            if($var)
            {
                header("Location: data_produk.php?result=success");
            }else
            {
                // header("Location: harga_laptop.php?result=failed");
                var_dump($insert_sql);
            }    
    } else 
    {
        header("Location: harga_laptop.php");
    } 
?>
