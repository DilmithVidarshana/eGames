<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $gid = $_GET["id"];
    $umail = $_SESSION["u"]["email"];

    $array = [];
    $order_id = uniqid();
    $merchant_id = "1221085";
    $merchant_secret = "MzQ3OTAwMzM3NjQxOTE1NDEzMzc0MjUwNTk0NjYwMjg1MTY1MzE1Nw==";
    $currency = "USD";


    $game_rs = Database::search("SELECT * FROM `games` WHERE `id`='" . $gid . "'");
    $game_data = $game_rs->fetch_assoc();


    $amount = ((int)$game_data["price"]);

    $hash = strtoupper(
        md5(
            $merchant_id .
                $order_id .
                number_format($amount, 2, '.', '') .
                $currency .
                strtoupper(md5($merchant_secret))
        )
    );

 

    $fname = $_SESSION["u"]["fname"];
    $lname = $_SESSION["u"]["lname"];
    $mobile = $_SESSION["u"]["mobile"];
    $array["id"] = $order_id;
    $array["amount"] =  $amount;
    $array["fname"] = $fname;
    $array["lname"] = $lname;
    $array["mobile"] = $mobile;
    $array["mail"] = $umail;
    $array["merchant_id"] = $merchant_id;
    $array["currency"] = $currency;
    $array["hash"] = $hash;

    echo json_encode($array);
} else {
    echo ("1");
}
