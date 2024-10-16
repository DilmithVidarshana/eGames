<?php
require "connection.php";
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="col-12" style="background-color: #878281;">
        <div class="row mt-1 mb-1">

            <div class=" col-12 col-lg-12 align-self-start mt-2">

                <?php

                session_start();

                if (isset($_SESSION["u"])) {
                    $data = $_SESSION["u"];

                ?>

                    <span class="text-lg-start"><b>Welcome </b><?php echo $data["fname"]; ?></span> |
                    <span class="text-lg-start fw-bold signout btn btn-outline-light" onclick="signout();">Sign Out</span> |
                    <span class="text-lg-start fw-bold">Help and Contact</span>
                    <?php


                    $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $data["email"] . "'");
                    $image_num = $image_rs->num_rows;
                    ?>

                    <div class="offset-lg-8 col-12 col-lg-3 align-self-end">
                        <div class="row">

                            <?php
                            if ($image_num == 0) {
                            ?>
                                <div class="col-1 col-lg-3  rounded">
                                   <a href="profile.php" ><img src="resource/icon.png" class="rounded-circle" /></a>
                                </div>

                            <?php
                            } else {
                                $image_data = $image_rs->fetch_assoc();
                            ?>
                                <div class="col-3 col-lg-3  rounded">
                                    <a href="profile.php"> <img src="<?php echo $image_data["code"] ?>" class="rounded-circle" style="height: 100px;width:100px;" id="viewImg" /></a>
                                </div>
                            <?php
                            }
                            ?>

                            <div class="col-2 col-lg-3 dropdown mx-3">
                                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    eGames
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                                    <li><a class="dropdown-item" href="library.php">Library</a></li>
                                    <li><a class="dropdown-item" href="wacthlist.php">Watchlist</a></li>
                                    <li><a class="dropdown-item" href="cart.php">Cart</a></li>
                                    <li><a class="dropdown-item" href="purchesHistory.php">Purchase History</a></li>
                                    <li><a class="dropdown-item" href="message.php">Message</a></li>

                                </ul>
                            </div>

                            <div class="col-1 col-lg-3 ms-5 ms-lg-0 mt-1 cart-icon" onclick="window.location='cart.php';"></div>

                        </div>
                    </div>
                <?php

                } else {

                ?>

                    <a href="index.php" class="text-decoration-none fw-bold">Sign In or Register</a> |
                    <span class="text-lg-start fw-bold">Help and Contact</span>
                    <div class="offset-lg-10 col-12 col-lg-3 align-self-end">
                        <div class="col-1 col-lg-3  rounded">
                            <img src="resource/icon.png" class="rounded-circle" />
                        </div>
                    </div>
            </div>


        <?php

                }

        ?>




        </div>



    </div>
    </div>



    <script src="script.js"></script>
</body>

</html>