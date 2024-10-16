<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resource/icon.png" />
    <title>eGames|Home</title>
</head>

<body style="background-color:#000000;">
    <div class="container-fluid">
        <div class="row">
            <?php include "header.php" ?>
            <hr class="text-white" />
            <div class="col-12">
                <div class="row">
                    <div class="col-2 col-lg-2 offset-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search Games" aria-label="Username" aria-describedby="basic-addon1" id="basic_search_txt">
                            <span class="btn btn-light" id="basic-addon1" onclick="basicSearch(0);"><i class="bi bi-search"></i></span>
                        </div>

                    </div>
                    <div class="col-1 col-lg-1 d-grid ">
                        <button class="btn btn-outline-light">Discover</button>
                    </div>
                    <div class="col-1 col-lg-1 d-grid">
                        <a href="advanceSearch.php" class="btn btn-outline-light">Browse</a>
                    </div>
                    <div class="col-1 col-lg-1 d-grid">
                        <button class="btn btn-outline-light">News</button>
                    </div>
                </div>

            </div>
            <hr class="text-light mt-3" />

            <div class="col-12" id="basicSearchResult">
                <div class="row">
                    <!-- carousel -->

                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 col-lg-6 offset-2">
                                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner" style="border-radius: 10px; width:900px">
                                        <div class="carousel-item active">
                                            <img src="resource/wacth_dogs.jpg" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="resource/cod.jpg" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="resource/gothem_knight.jpg" class="d-block w-100" alt="...">
                                        </div>
                                    </div>

                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- carousel -->
                    <!-- category name -->
                    <?php

                    $c_rs = Database::search("SELECT * FROM `category`");
                    $c_num = $c_rs->num_rows;

                    for ($y = 0; $y < $c_num; $y++) {
                        $cdata = $c_rs->fetch_assoc();


                    ?>
                        <div class="col-12 mt-3 mb-3">
                            <a href="#" class="text-decoration-none link-light fs-3 fw-bold"><?php echo $cdata["name"]; ?></a> &nbsp;&nbsp;
                            <a href="#" class="text-decoration-none link-light fs-6">See All &nbsp; &rarr;</a>
                        </div>
                        <hr class="text-light mt-3" />
                        <!-- category name -->
                        <!-- Products -->

                        <div class="col-12 mb-3">

                            <div class="col-12">
                                <div class="row justify-content-center gap-2">

                                    <?php

                                    $games_rs = Database::search("SELECT * FROM `games` WHERE `category_id`='" . $cdata["id"] . "' AND 
                                    `status`='1' ORDER BY `price` ASC LIMIT 4 OFFSET 0");
                                    $games_num = $games_rs->num_rows;

                                    for ($z = 0; $z < $games_num; $z++) {
                                        $games_data = $games_rs->fetch_assoc();

                                    ?>

                                        <div class="card col-6 col-lg-2 mt-2 mb-2" style="width: 18rem; background-color:#000000;">

                                            <?php

                                            $image_rs = Database::search("SELECT * FROM `images` WHERE `games_id`='" . $games_data["id"] . "'");
                                            $image_data = $image_rs->fetch_assoc();

                                            ?>

                                            <img src="<?php echo $image_data["code"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 180px; background-color:#000000;" />
                                            <div class="card-body ms-0 m-0 text-center">
                                                <h5 class="card-title fs-6 fw-bold text-light"><?php echo $games_data["title"]; ?></h5>
                                                <span class="card-text text-light">$ <?php echo $games_data["price"]; ?> .00</span> <br />

                                                <div class="col-12">
                                                    <div class="row">
                                                        <button class="col-5 btn btn-outline-success mt-2 mx-2" onclick="addToCart(<?php echo $games_data['id']; ?>);"><i class="bi bi-cart4"></i>&nbsp;&nbsp;</button>


                                                        <?php
                                                        if (isset($_SESSION["u"])) {
                                                            $watchlist_rs = Database::search("SELECT * FROM `wacthlist` WHERE `games_id`='" . $games_data["id"] . "' AND 
                                                    `user_email`='" . $_SESSION["u"]["email"] . "'");
                                                            $watchlist_num = $watchlist_rs->num_rows;

                                                            if ($watchlist_num == 1) {
                                                        ?>
                                                                <button class="col-5 btn btn-outline-danger mt-2 border border-danger" onclick='addToWatchlist(<?php echo $games_data["id"]; ?>);'>
                                                                    <i class="bi bi-heart-fill text-danger fs-5" id='heart<?php echo $games_data["id"]; ?>'></i>
                                                                </button>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <button class="col-5 btn btn-outline-danger mt-2 border border-danger" onclick='addToWatchlist(<?php echo $games_data["id"]; ?>);'>
                                                                    <i class="bi bi-heart-fill text-dark fs-5" id='heart<?php echo $games_data["id"]; ?>'></i>
                                                                </button>
                                                        <?php
                                                            }
                                                        }


                                                        ?>
                                                        <a href='<?php echo "singleProductView.php?id=" . $games_data["id"]; ?>' class="col-12 btn btn-outline-primary mt-2">Buy Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php

                                    }

                                    ?>

                                </div>
                            </div>

                        </div>
                        <!-- Products -->
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php include "footer.php" ?>
        </div>
    </div>






    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>