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


            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];
            }
            $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON 
            gender.id=user.gender_id WHERE `email`='" . $email . "'");

            $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "'");
            $image_num = $image_rs->num_rows;

            $data = $details_rs->fetch_assoc();

            ?>
            <div class="col-12">
                <h1 class="fw-bold text-white offset-5">My Profile</h1>
            </div>
            <hr class="text-white" />
            <div class="col-12">
                <div class="row">
                    <?php
                    if($image_num==0){
                    ?>
                    <div class="col-3 col-lg-3 mt-2 rounded">
                        <img src="resource/wacth_dogs.jpg" class="rounded-circle" style="height: 250px;width:250px;" id="viewImg" />
                    </div>
                    <?php
                    }else{
                        $image_data = $image_rs->fetch_assoc();
                     ?>
                        <div class="col-3 col-lg-3 mt-2 rounded">
                        <img src="<?php echo $image_data["code"]?>" class="rounded-circle" style="height: 250px;width:250px;" id="viewImg" />
                    </div>
                    <?php
                    }
                    ?>
                    <div class="col-9 col-lg-9">
                        <h1 class="text-white fw-bold offset-3 mt-2"><?php echo $data["email"]?></h1>
                        <span class="text-white fw-bold offset-3 fs-4" style="text-decoration: underline;">#User</span>
                        <input type="file" class="d-none" id="profileimg" accept="image/*" />
                        <label for="profileimg" class="btn btn-primary " onclick="changeImage();">Update Profile Image</label>

                    </div>
                </div>
                <hr class="text-white" />

                <div class="col-12 d-grid">
                    <div class="row">
                        <div class="col-6 col-lg-6 mt-3">
                            <input class="form-control  " type="text" value="<?php echo $data["email"]?>" disabled/>
                        </div>
                        <div class="col-6 col-lg-6 mt-3">
                            <input class="form-control  " type="text" value="<?php echo $data["fname"]?>" id="f"/>
                        </div>
                        <div class="col-6 col-lg-6 mt-3">
                            <input class="form-control " type="text" value="<?php echo $data["lname"]?>" id="l"/>
                        </div>
                        <div class="col-6 col-lg-6 mt-3">
                            <input class="form-control  " type="text" value="<?php echo $data["name"]?>" disabled/>
                        </div>
                        <div class="col-6 col-lg-6 mt-3">
                            <input class="form-control  " type="password" value="<?php echo $data["password"]?>" disabled />
                        </div>
                        <div class="col-6 col-lg-6 mt-3">
                            <input class="form-control  " type="text" value="<?php echo $data["date_time"]?>" disabled/>
                        </div>
                    </div>
                    <button class="btn btn-success mt-3" onclick="updateProfile();">Update</button>
                </div>

                <?php include "footer.php" ?>
            </div>
        </div>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
</body>

</html>