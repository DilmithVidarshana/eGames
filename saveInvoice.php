<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

$o_id = $_POST["o"];
$g_id = $_POST["i"];
$mail = $_POST["m"];
$amount = $_POST["a"];

$product_rs = Database::search("SELECT * FROM `games` WHERE `id`='".$g_id."'");
$product_data = $product_rs->fetch_assoc();


$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `invoice`(`order`,`date`,`total`,`status`,`games_id`,`user_email`) VALUES 
('".$o_id."','".$date."','".$amount."','1','".$g_id."','".$mail."')");

echo ("1");

}

?>