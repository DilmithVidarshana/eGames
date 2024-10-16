<?php


session_start();
require "connection.php";

if(isset($_SESSION["u"])){
    if(isset($_GET["id"])){

        $email = $_SESSION["u"]["email"];
        $gid = $_GET["id"];

        $watchlist_rs = Database::search("SELECT * FROM `wacthlist` WHERE `games_id`='" . $gid . "' AND 
        `user_email`='" . $email . "'");
        $watchlist_num =$watchlist_rs->num_rows;

        if($watchlist_num == 1){

            $watchlist_data = $watchlist_rs->fetch_assoc();
            $gamelist_id = $watchlist_data["id"];

            Database::iud("DELETE FROM `wacthlist` WHERE `id`='".$gamelist_id."'");
            echo (" Game removed");

        }else{

            Database::iud("INSERT INTO `wacthlist`(`games_id`,`user_email`) VALUES ('" . $gid . "','" . $email . "')");
            echo (" Game added");

        }

    }else{
        echo ("Something Went Wrong");
    }

}else{
    echo ("Please Login First");
}

?>
