<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resource/icon.png" />
    <title>eGames|Profile</title>
</head>

<body style="background-color:#000000;">
    <div class="container-fluid">
        <div class="row">
            <?php include "header.php" ?>


            <?php

            require "connection.php";

            if (isset($_SESSION["au"])) {

                $email = $_SESSION["au"]["email"];
            }
            $details_rs = Database::search("SELECT * FROM `admin`  
             WHERE `email`='" . $email . "'");

            $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $email . "'");

            $data = $details_rs->fetch_assoc();
            $image_data = $image_rs->fetch_assoc();
            ?>
            <div class="col-12">
                <h1 class="fw-bold text-white offset-5">My Profile</h1>
            </div>
            <hr class="text-white" />
            <div class="col-12">
                <div class="row">
                    <div class="col-3 col-lg-3 mt-2 rounded">
                        <img src="resource/wacth_dogs.jpg" class="rounded-circle" style="height: 250px;width:250px;" />
                    </div>
                    <div class="col-9 col-lg-9">
                        <h1 class="text-white fw-bold offset-3 mt-2"><?php echo $data["email"]?></h1>
                        <span class="text-white fw-bold offset-3 fs-4" style="text-decoration: underline;">#User</span>
                        <button class="btn btn-success offset-2">Update Profile</button>

                    </div>
                </div>
                <hr class="text-white" />

                <div class="col-12 d-grid">
                    <div class="row">
                        <div class="col-6 col-lg-6 mt-3">
                            <input class="form-control  " type="text" value="<?php echo $data["email"]?>"/>
                        </div>
                        <div class="col-6 col-lg-6 mt-3">
                            <input class="form-control  " type="text" value="<?php echo $data["fname"]?>"/>
                        </div>
                        <div class="col-6 col-lg-6 mt-3">
                            <input class="form-control " type="text" value="<?php echo $data["lname"]?>"/>
                        </div>
                        <div class="col-6 col-lg-6 mt-3">
                            <input class="form-control  " type="text" value="<?php echo $data["name"]?>"/>
                        </div>
                        <div class="col-6 col-lg-6 mt-3">
                            <input class="form-control  " type="text" value="<?php echo $data["password"]?>" />
                        </div>
                        <div class="col-6 col-lg-6 mt-3">
                            <input class="form-control  " type="text" value="<?php echo $data["date_time"]?>"/>
                        </div>
                    </div>
                    <button class="btn btn-success mt-3">Update</button>
                </div>

                <?php include "footer.php" ?>
            </div>
        </div>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
</body>

</html>