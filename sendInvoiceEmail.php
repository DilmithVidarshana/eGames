<?php
session_start();
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$page = $_POST["page"];

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];


        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kcod555@gmail.com';
            $mail->Password = 'namdbkfkxsdpzurn';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('kcod555@gmail.com', 'eGames Invoice');
            $mail->addReplyTo('kcod555@gmail.com', 'eGames Invoice');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'eGames Invoice';
            $bodyContent = '<h1 style="color:blue">Hello '.$_SESSION["u"]["fname"].' Your Invoice  </h1>';
            $mail->Body    = $bodyContent."".$page;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }
        }else{
            echo "invaild user";
        }
?>