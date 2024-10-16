<?php
require "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;



if(isset($_POST["e"])){
    $email = $_POST["e"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='".$email."'");
    $admin_num =  $admin_rs->num_rows;

    if($admin_num > 0){
        
        $code = uniqid();

        Database::iud("UPDATE `admin` SET `virification_cod`='".$code."' WHERE `email`='".$email."'");
            
        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kcod555@gmail.com';
            $mail->Password = 'namdbkfkxsdpzurn';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('kcod555@gmail.com', 'Admin Verification Code');
            $mail->addReplyTo('kcod555@gmail.com', 'Admin Verification COde');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'eGames Admin  Verification Code';
            $bodyContent = '<h1 style="color:blue">Your Verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo ('Success');
            }

    }else{
        echo("You are not valid user");
    }

}else{
    echo("Email field should not be empty");
}
?>