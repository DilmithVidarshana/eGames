<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){
if(isset($_GET["id"])){
    
    $email = $_SESSION["u"]["email"];
    $gid = $_GET["id"];

    $cart_rs = Database::search("SELECT * FROM `addtocart` WHERE `games_id`='".$gid."' AND `user_email`='".$email."'");
    $cart_num = $cart_rs->num_rows;

    $game_rs = Database::search("SELECT * FROM `games` WHERE `id`='".$gid."'");
    $game_data = $game_rs->fetch_assoc();


    if($cart_num == 0){

        $cart_data = $cart_rs->fetch_assoc();
 
        Database::iud("INSERT INTO `addtocart`(`games_id`,`user_email`) VALUES ('".$gid."','".$email."')");
        echo ("Product added successfully");

    }else{
     echo("Allready This game in the cart");

    }

}else{
    echo ("Something went wrong");
}
}else{
    echo ("Please Sign In or Register.");
}
?>