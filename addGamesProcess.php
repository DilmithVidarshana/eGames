<?php

session_start();
require "connection.php";

$aid = $_SESSION["au"]["id"];

$category = $_POST["ca"];
$title = $_POST["title"];
$price = $_POST["price"];
$refund = $_POST["refund"];
$developer = $_POST["developer"];
$publisher = $_POST["publisher"];
$description = $_POST["description"];
$rd = $_POST["rs"];
$mram = $_POST["mram"];
$mvga = $_POST["mvga"];
$mproceesear = $_POST["mpr"];
$mos = $_POST["mos"];
$mhdd = $_POST["mhdd"];
$ram = $_POST["ram"];
$vga = $_POST["vga"];
$processer = $_POST["pr"];
$os = $_POST["os"];
$hdd = $_POST["hdd"];
$video = $_POST["video"];


if ($category == "0") {
    echo ("Please select a Category");
} else if (empty($title)) {
    echo ("Please Enter a Title");
} else if (strlen($title) >= 100) {
    echo ("Title should have lover than 100 characters");
} else if (empty($price)) {
    echo ("Please Enter the Price");
} else if (empty($refund)) {
    echo ("Please Enter the refund type");
} else if (empty($developer)) {
    echo ("Please Enter the delivery");
} else if (empty($publisher)) {
    echo ("Please Enter the publisher");
} else if (empty($description)) {
    echo ("Please Enter a Description.");
} else {



    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    Database::iud("INSERT INTO `games`
    (`price`,`title`,`description`,`status`,`category_id`,`admin_id`,`date`) VALUES 
    ('" . $price . "','" . $title . "','" . $description . "','" . $status . "','" . $category . "','" . $aid . "','" . $date . "')");
     $games_id = Database::$connection->insert_id;
     
 Database::iud("INSERT INTO `developer`
 (`refundt`,`developer`,`publisher`,`games_id`,`relese_date`) VALUES 
 ('" . $refund . "','" . $developer . "','" . $publisher . "','" . $games_id . "','".$rd."')");

    Database::iud("INSERT INTO `systemm`
   (`ram`,`vga`,`proceesor`,`hdd`,`os`,`games_id`) VALUES
   ('" . $mram . "','" . $mvga . "','" . $mproceesear . "','" . $mhdd . "','" . $mos . "','" . $games_id . "')");

    Database::iud("INSERT INTO `systemr`
    (`ram`,`vga`,`processer`,`hdd`,`os`,`games_id`) VALUES
    ('" . $ram . "','" . $vga . "','" . $processer . "','" . $hdd . "','" . $os . "','" . $games_id . "')");
   


   Database::iud("INSERT INTO `videos`(`vcode`,`games_id`)VALUES('".$video."','".$games_id."')");

    echo ("Product saved successfully");




    $length = sizeof($_FILES);

    if($length <= 3 && $length > 0){

        $allowed_img_extentions = array ("image/jpg","image/jpeg","image/png","image/svg+xml");

        for($x = 0; $x < $length;$x++){
            if(isset($_FILES["image".$x])){

                $img_file = $_FILES["image".$x];
                $file_extention = $img_file["type"];

                if(in_array($file_extention,$allowed_img_extentions)){

                    $new_img_extention;

                    if($file_extention == "image/jpg"){
                        $new_img_extention = ".jpg";
                    }else if($file_extention == "image/jpeg"){
                        $new_img_extention = ".jpeg";
                    }else if($file_extention == "image/png"){
                        $new_img_extention = ".png";
                    }else if($file_extention == "image/svg+xml"){
                        $new_img_extention = ".svg";
                    }

                    $file_name = "resource//Games//".$title."_".$x."_".uniqid().$new_img_extention;
                    move_uploaded_file($img_file["tmp_name"],$file_name);

                    Database::iud("INSERT INTO `images`(`code`,`games_id`) VALUES ('".$file_name."','".$games_id."')");

                }else{
                    echo ("Invalid Image type");
                }

            }
        }

        echo ("Game image saved successfully");

    }else{
        echo ("Invalid image count");
    }


}