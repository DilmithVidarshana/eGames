<?php
require "connection.php";

if (isset($_GET["id"])) {

    $gid = $_GET["id"];
   
    $length = sizeof($_FILES);
    Database::iud("DELETE FROM `gscreens` WHERE `games_id`='".$gid."'");
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

                    $file_name = "resource//ss//".$gid."_".$x."_".uniqid().$new_img_extention;
                    move_uploaded_file($img_file["tmp_name"],$file_name);

                    Database::iud("INSERT INTO `gscreens`(`scode`,`games_id`) VALUES ('".$file_name."','".$gid."')");

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
