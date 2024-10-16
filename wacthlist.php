<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/icon.png" />
    <title>eGames|wacthlist</title>

</head>

<body style="background-color:#000000;">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";

            if (isset($_SESSION["u"])) {

            ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="row">

                                <div class="col-8">
                                    <label class="form-label fs-1 fw-bolder text-white offset-4">Watchlist &hearts;</label>
                                </div>


                                <hr class="text-white" />


                                <div class="col-12">
                                    <div class="row">
                                        <div class="offset-lg-2 col-12 col-lg-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Search in Watchlist..." id="t" />
                                        </div>
                                        <div class="col-12 col-lg-2 mb-3 d-grid">
                                            <button class="btn btn-primary" onclick="wacthlistSearch(0)">Search</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="text-white" />
                                </div>

                                <div class="col-11 col-lg-2 border-0 border-end border-1 border-primary">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                        </ol>
                                    </nav>
                                    <nav class="nav nav-pills flex-column">
                                        <a class="nav-link active" aria-current="page" href="#">My Watchlist</a>
                                        <a class="nav-link" href="cart.php">My Cart</a>

                                    </nav>
                                </div>

                                <?php

                                $email = $_SESSION["u"]["email"];

                                $watchlist_rs = Database::search("SELECT * FROM `wacthlist` WHERE `user_email`='" . $email . "'");
                                $watchlist_num = $watchlist_rs->num_rows;

                                if ($watchlist_num == 0) {

                                ?>
                                    <!-- empty view -->
                                    <div class="col-12 col-lg-9">
                                        <div class="row">
                                            <div class="col-12 emptyView"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bold">You have no items in your Watchlist yet.</label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                <a href="home.php" class="btn btn-outline-warning fs-3 fw-bold">Go To eGames Store</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- empty view -->
                                <?php

                                } else {
                                ?>
                                    <div class="col-12 col-lg-9" id="wacthlist_result">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < $watchlist_num; $x++) {
                                                $watchlist_data = $watchlist_rs->fetch_assoc();
                                            ?>

                                                <!-- have games -->


                                                <div class="card mb-3 mx-0 mx-lg-2 col-12" style="background-color: #3F3E3E;">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">
                                                            <?php
                                                            $img = array();

                                                            $images_rs = Database::search("SELECT * FROM `images` WHERE `games_id`='" . $watchlist_data["games_id"] . "'");
                                                            $images_data = $images_rs->fetch_assoc();

                                                            ?>
                                                            <img src="<?php echo $images_data["code"]; ?>" class="img-fluid rounded-start" style="height: 200px;" />
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="card-body">
                                                                <?php

                                                                $game_rs = Database::search("SELECT * FROM `games` WHERE `id`='" . $watchlist_data["games_id"] . "'");
                                                                $games_data = $game_rs->fetch_assoc();

                                                                ?>
                                                                <h5 class="card-title fs-2 fw-bold text-white mt-5"><?php echo $games_data["title"]; ?></h5>
                                                                <h5 class="card-title  fw-bold text-white ">$<?php echo $games_data["price"]; ?>.00</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-5">
                                                            <div class="card-body d-lg-grid">
                                                                <div class="row">
                                                                    <a href='<?php echo "singleProductView.php?id=" . $games_data["id"]; ?>' class="col-12 btn btn-outline-primary mt-2">Buy Now</a>
                                                                    <button class="col-5 btn btn-outline-danger mt-2 border border-danger" onclick='addToWatchlist(<?php echo $games_data["id"]; ?>);'>
                                                                        <i class="bi bi-heart-fill text-dark fs-5" id='heart<?php echo $games_data["id"]; ?>'></i>
                                                                    </button>
                                                                    <button class="col-5 btn btn-outline-info mt-2 mx-2" onclick="addToCart(<?php echo $games_data['id']; ?>);"><i class="bi bi-cart4"></i>&nbsp;&nbsp;</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- have games -->

                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                }

                                ?>





                            </div>
                        </div>
                    </div>
                </div>

            <?php

            } else {
                echo ("Please Login First");
            }

            ?>

            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>