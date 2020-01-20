<?php
    session_start();
    require 'connection.php';
    if(isset($_POST['simpan']))
    {
        $id         = htmlspecialchars($_POST["laptop"]);
        $stok       = htmlspecialchars($_POST["stok"]);
        $tanggal    = date("Y-m-d");
        $id_us      = $_SESSION["ID_USER"];
        
        //Mengambil data terakhir transaksi pengadaan
        //Membuat query untuk mengambil data terakhir transaksi pengadaan
        $query_pengadaan = "select * from pengadaan_barang order by ID_PENGADAAN_BARANG desc limit 1 ";

        //Menjalankan query 
        $result_pengadaan = mysqli_query($conn,$query_pengadaan);

        //Memeriksa apakah ada transaksi sebelumnya
        if(mysqli_num_rows($result_pengadaan) > 0)
        {
            $result_row = mysqli_fetch_assoc($result_pengadaan);
            $id_pengadaan_barang = $result_row['ID_PENGADAAN_BARANG'] + 1;

            //Membuat query untuk memasukkan kedalam pengadaan
            $query_insert_pengadaan = "insert into pengadaan_barang values ('".$id_pengadaan_barang."','".$id_us."','".$tanggal."')";
            //Membuat query untuk memasukkan kedalam detail pengadaan
            $query_insert_detail_pengadaan = "insert into detail_pengadaan values ('','".$id_pengadaan_barang."','".$id."','".$stok."')";

            echo $query_insert_pengadaan;
            
            //Menjalankan query
            if($result_insert_pengadaan = mysqli_query($conn,$query_insert_pengadaan))
            {
                //Menjalankan query insert detail
                if($result_insert_detail_pengadaan = mysqli_query($conn,$query_insert_detail_pengadaan))
                {
                    header("Location: data_pengadaan.php?insertsuccess=true");
                }
            }else
            {
                echo $result_insert_pengadaan;
            }
            

        }else
        {
            $id_pengadaan_barang = 1;

            //Membuat query untuk memasukkan kedalam pengadaan
            $query_insert_pengadaan = "insert into pengadaan_barang values ('".$id_pengadaan_barang."','".$id_us."','".$tanggal."')";
            //Membuat query untuk memasukkan kedalam detail pengadaan
            $query_insert_detail_pengadaan = "insert into detail_pengadaan values ('','".$id_pengadaan_barang."','".$id."','".$stok."')";

            //Menjalankan query
            if($result_insert_pengadaan = mysqli_query($conn,$query_insert_pengadaan))
            {
                //Menjalankan query insert detail
                if($result_insert_detail_pengadaan = mysqli_query($conn,$query_insert_detail_pengadaan))
                {
                    header("Location: data_pengadaan.php?insertsuccess=true");
                }
            }
            

        }

            // $insert_sql2 = "INSERT INTO pengadaan_barang VALUES('','".$id_us."','".$tanggal."')";
            // $var2 = mysqli_query($conn, $insert_sql2);
            
            // // $insert_sql = "INSERT INTO det_laptop VALUES('','".$id."','".$beli."','".$jual."','".$stok."','".$garansi."','".$lama."')";
            // // $var = mysqli_query($conn, $insert_sql);
            // if($var == true)
            // {
            //     header("Location: data_produk.php?result=success");
            //     $insert_sql2 = "INSERT INTO detail_pengadaan_barang VALUES('','".$id_us."','".$tanggal."')";
            //     $var2 = mysqli_query($conn, $insert_sql2);
            // }else
            // {
            //     header("Location: pengadaan_brg.php?result=failed");
            // }    
    } else 
    {
        header("Location: pengadaan_brg.php");
    } 
?>
