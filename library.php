<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resource/icon.png" />
    <title>eGames|Library</title>
</head>

<body style="background-color:#000000;">
    <div class="container-fluid">
        <div class="row">
            <?php include "header.php" ?>
            <div class="col-12">
                <h1 class="fw-bold text-white offset-5">My Games</h1>
            </div>
            <hr class="text-white" />

            <div class="col-11 col-lg-2 border-0 border-end border-1 border-white">
                <a href="home.php" class="btn btn-outline-secondary text-white" style="height: 50px; width:200px">Home</a>
                <a href="wacthlist.php" class="btn btn-outline-secondary text-white mt-3" style="height: 50px; width:200px">Wacthlist</a>
                <a href="cart.php" class="btn btn-outline-secondary text-white mt-3" style="height: 50px; width:200px">Cart</a>
            </div>

            <div class="col-12 col-lg-9">
                <div class="row">

                    <?php
               

                    if (isset($_SESSION["u"])) {
                        $umail = $_SESSION["u"]["email"];
                    }

                    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $umail . "'");
                    $invoice_num = $invoice_rs->num_rows;



                    for ($x = 0; $x < $invoice_num; $x++) {
                        $invoice_data = $invoice_rs->fetch_assoc();

                    ?>
                        <div class="col-3">
                            <div class="row">

                                <div class="card" style="width: 18rem;background-color:#000000;">
                                    <?php


                                    $img = array();

                                    $images_rs = Database::search("SELECT * FROM `images` WHERE `games_id`='" . $invoice_data["games_id"] . "'");
                                    $images_data = $images_rs->fetch_assoc();

                                    ?>

                                    <img src="<?php echo $images_data["code"] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <?php
                                        $game_rs = Database::search("SELECT * FROM `games` WHERE `id`='" . $invoice_data["games_id"] . "'");
                                        $games_data = $game_rs->fetch_assoc();
                                        ?>
                                        <h5 class="card-title text-white"><?php echo $games_data["title"] ?></h5>
                                        <p class="card-text text-white">$<?php echo $games_data["price"] ?>.00</p>
                                        <a href="" class="btn btn-primary">Instrall</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>

            </div>
            <?php include "footer.php" ?>
        </div>
    </div>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>