<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once "PHPMailer/src/Exception.php";
    require_once "PHPMailer/src/PHPMailer.php";
    require_once "PHPMailer/src/SMTP.php";

    require_once "connection.php";


    if(isset($_POST['reset']))
    {
        //Menyimpan data kedalam variabel
        $emailUser = htmlspecialchars(stripcslashes($_POST['email']));
        //Membuat token untuk lupa password
        $tokenUser = uniqid();
        //Query
        $query_update = "UPDATE user SET token_user = '".$tokenUser."' WHERE email_user = '".$emailUser."'";
        $query_search = "SELECT * FROM user WHERE email_user = '".$emailUser."'";
        $result = mysqli_query($conn,$query_search);

        //Url
        $url_reset_password = "http://".$_SERVER['HTTP_HOST']."/git/gitHub/Kelompok4_TIFD/E41181645_Bayu_Agil/ADMIN/reset_pswADM.php?token=".$tokenUser;

        if(mysqli_num_rows($result) > 0)
        {

            if(mysqli_query($conn, $query_update))
            {

                //Inisiasi Mailer
                $mail = new PHPMailer(true);

                try
                {

                    //Konfigurasi Server
                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "kurak4647@gmail.com";
                    $mail->Password = "@12Kurakura";
                    $mail->SMTPSecure = "ssl";
                    $mail->Port = 465;

                    //Penerima
                    $mail->setFrom('kurak4647@gmail.com','Admin');
                    $mail->addAddress($emailUser, 'Pengguna');
                    $mail->addReplyTo('noreply@rizquinastore.com','No-Reply');

                    //Content
                    $mail->isHTML(true);
                    $mail->Subject = "Reset Password";
                    $mail->Body = "<h1> Pelanggan yang terhormat. </h1>
                                   <p> Anda meminta sebuah link untuk reset password anda di website kami. </p>
                                   <p> Apabila anda merasa tidak memintanya, harap abaikan email ini. </p>
                                   <p> <a href='".$url_reset_password."'> Reset Password </a> </p>                    
                                   ";
                    $mail->AltBody = "Alternativ Load";

                    //Mengirim Email
                    $mail->send();

                    //Redirect home
                    header("Location: index.php?resetpass=true");

                }catch(Exception $e)
                {
                    echo $mail->ErrorInfo;
                }

            }else
            {
                header("Location: index.php?errorprocess=true");
            }

        }else
        {
            header("Location: index.php?usernotfound=true");
        }


    }else
    {
        header("Location: index.php?error=accessdenied");
    }

?>