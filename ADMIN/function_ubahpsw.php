<?php
    require 'connection.php';
    $id = $_POST['id'];

    $psw1 = $_POST['password'];
    $psw2 = $_POST['password2'];
    
    if($psw1 !== $psw2) {  
        echo "<script>alert('Konfirmasi password tidak cocok');document.location.href='index.php'</script>\n";
        exit;
    } else {
        $psw1 = password_hash($psw1, PASSWORD_BCRYPT);
        $sql = mysqli_query($conn, "UPDATE user SET PASSWORD_USER = '".$psw1."' WHERE ID_USER='".$id."'");
        echo "<script>alert('Berhasil mengubah password');document.location.href='index.php'</script>\n";
    }
?>