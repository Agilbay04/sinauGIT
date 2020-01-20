<?php

    require_once  "connection.php";

    if(isset($_POST['update']))
    {
        //Menyimpan data kedalam variabel
        $token = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['tokenUser']));
        $passwordUser = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['password']));
        $passwordUser2 = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['password2']));
        $hashedPassword = password_hash($passwordUser, PASSWORD_BCRYPT);
        $hashedPassword2 = password_hash($passwordUser2, PASSWORD_BCRYPT);

        if($passwordUser != $passwordUser2){
            header("Location: reset_pswADM.php?confirm=false");
        } else {
        //Query
            $query = "UPDATE user SET PASSWORD_USER = '".$hashedPassword."' WHERE TOKEN_USER = '".$token."'";
            //Query Hapus Token
            $query_token = "UPDATE user SET TOKEN_USER = '' WHERE TOKEN_USER = '".$token."'";

            //Eksekusi query
            if(mysqli_query($conn, $query))
            {

                if(mysqli_query($conn, $query_token))
                {
                    header("Location: login.php?resetpassword=success");
                }else
                {
                    header("Location:login.php?resetpassword=fail");
                }

            }else
            {
                echo "Lah kok error";
                print_r($result);
            }
        }
    }else
    {
        header("Location: login.php?access=error");
    }

?>