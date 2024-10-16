<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["e"])){

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
    $n = $rs->num_rows;

    if($n == 1){

        $code = uniqid();

        Database::iud("UPDATE `user` SET `veryfication_code`='".$code."' WHERE 
        `email`='".$email."'");

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kcod555@gmail.com';
            $mail->Password = 'namdbkfkxsdpzurn';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('kcod555@gmail.com', 'eGames Veryfication_Code');
            $mail->addReplyTo('kcod555@gmail.com', 'eGames Veryfication_Code');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'eGames Verification';
            $bodyContent = '<h1 style="color:blue">Hello '.$email.' Your Veryfication Code is '.$code.' </h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }

    }else{
        echo ("Invalid Email address");
    }

}

?>