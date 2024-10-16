<?php
require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resource/icon.png" />
    <title>eGames|advance Search</title>
</head>

<body style="background-color:#000000;">
    <div class="container-fluid">
        <div class="row">


            <div class="col-12">
                <div class="row">
                    <div class="col-12 ">
                        <div class="row">

                            <div class="col-8">
                                <label class="form-label fs-1 fw-bolder text-white offset-4">Update games</label>
                            </div>


                            <div class="col-12">
                                <hr class="text-white" />
                            </div>

                            <div class="col-11 col-lg-2 border-0 border-end border-1 border-white">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="adminpanel.php">Admin Panel</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Update </li>
                                    </ol>
                                </nav>
                                <nav class="nav nav-pills flex-column">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Keyword" aria-label="Recipient's username" aria-describedby="basic-addon2" id="t">
                                        <span class="input-group-text" id="basic-addon2" onclick="search(0)"><i class="bi bi-search"></i></span>
                                    </div>
                                      <?php
                                      $category_rs = Database::search("SELECT * FROM `category`");
                                      $category_num = $category_rs->num_rows;
                                      ?>
                                    <select class="form-select" id="c">
                                        <option value="0">Select Category</option>
                                         <?php
                                         for($x=0;$x<$category_num;$x++){
                                            $category_data= $category_rs->fetch_assoc();
                                         ?>
                                            <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                                          <?php
                                         }
                                          ?>
                                    </select>
                              
                            </div>

                            <?php
                          


                            $games_rs = Database::search("SELECT * FROM `games` WHERE `status`='1' ");
                            $games_num = $games_rs->num_rows;


                            ?>


                            <div class="col-12 col-lg-9" id="view_area">
                                <div class="row">
                                    <?php
                                    for ($x = 0; $x < $games_num; $x++) {
                                        $games_data = $games_rs->fetch_assoc();
                                    ?>

                                        <!-- have Products -->


                                        <div class="card mt-3 mx-3 " style="width: 18rem; background-color:#000000;">
                                            <?php

                                            $image_rs = Database::search("SELECT * FROM `images` WHERE `games_id`='" . $games_data["id"] . "'");
                                            $image_data = $image_rs->fetch_assoc();

                                            ?>
                                            <img src="<?php echo $image_data["code"] ?>" class="card-img-top" />
                                            <div class="card-body">
                                                <h5 class="card-title text-white"><?php echo $games_data["title"] ?></h5>
                                                <p class="card-text text-white">$<?php echo $games_data["price"] ?>.00</p>
                                                <button class="btn btn-outline-success" onclick="blockGames(<?php echo $games_data['id']; ?>);">Block Game</button>
                                                <a href='<?php echo "upadteGameDetails.php?id=" . $games_data["id"]; ?>' class="col-12 btn btn-outline-primary mt-2">Update</a>
                                                <a href='<?php echo "addscreenshot.php?id=" . $games_data["id"]; ?>' class="col-12 btn btn-outline-primary mt-2">Addgame Screen Shot</a>
                                               
                                            </div>
                                        </div>


                                        <!-- have Products -->

                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>






                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="bootstrap.bundle.js"></script>
<script src="script.js"></script>
</body>

</html>