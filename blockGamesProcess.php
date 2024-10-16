<?php

require "connection.php";

if(isset($_GET["id"])){

    $gid= $_GET["id"];

    $games_rs = Database::search("SELECT * FROM `games` WHERE `id`='".$gid."'");
    $games_num = $games_rs->num_rows;

    if($games_num ==1){

        $games_data =$games_rs->fetch_assoc();

        if($games_data["status"]==1){
            Database::iud("UPDATE `games` SET `status`='0' Where `id`='".$gid."'");
            echo("block");
            
        }else if($games_data["status"]==0){
            Database::iud("UPDATE `games` SET `status`='1' WHERE `id`='".$gid."'");
            echo("Unblocked");
        }
        
    }else{
        echo("Cannot find the user.Please try again later.");
    }

}else{
    echo("Somthing Went Wrong");
}

?>