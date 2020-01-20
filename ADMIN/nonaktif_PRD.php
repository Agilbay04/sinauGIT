<?php 
    require 'connection.php';
    $id = $_GET['id'];

    // mencari id laptop di tabel detail laptop, setelah itu status di ubah jadi 0 jika produk di nonaktifkan
    $query = "UPDATE det_laptop SET STATUS = 0  WHERE ID_LAPTOP = '".$id."'";
    $sql = mysqli_query($conn, $query);

    if($sql){
        echo "<script>alert('Produk dinonaktifkan');document.location.href='data_produk.php'</script>\n";
    } else {
        echo "";
    }
?>