<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cart | eGames</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resource/icon.png" />
</head>

<body style="background-color:#000000;">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";



            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

                $total = 0;
                $subtotal = 0;
                $shipping = 0;

            ?>

                <div class="col-12 pt-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-12 ">
                    <div class="row">

                        <div class="col-8">
                            <label class="form-label fs-1 fw-bolder text-white offset-4">Cart <i class="bi bi-cart4 fs-1 text-success"></i></label>
                        </div>


                        <hr class="text-white" />

                        <div class="col-12">
                            <div class="row">
                                <div class="offset-lg-2 col-12 col-lg-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Search in Cart..." id="t"/>
                                </div>
                                <div class="col-12 col-lg-2 d-grid mb-3">
                                    <button class="btn btn-primary" onclick="cartSearch(0)">Search</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="text-white" />
                        </div>

                        <?php

                        $cart_rs = Database::search("SELECT * FROM `addtocart` WHERE `user_email`='" . $email . "'");
                        $cart_num = $cart_rs->num_rows;

                        if ($cart_num == 0) {

                        ?>
                            <!-- Empty View -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptyCart"></div>
                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-1 fw-bold">
                                            You have no items in your Cart yet.
                                        </label>
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                        <a href="home.php" class="btn btn-outline-info fs-3 fw-bold">
                                            Go To eGames Store
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Empty View -->
                        <?php

                        } else {
                        ?>

                            <!-- games -->
                            <div class="col-12 col-lg-9" id="cart_result">
                                <div class="row">

                                    <?php

                                    for ($x = 0; $x < $cart_num; $x++) {
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $game_rs = Database::search("SELECT * FROM `games` WHERE `id`='" . $cart_data["games_id"] . "'");
                                        $game_data = $game_rs->fetch_assoc();

                                        $total = $total + ($game_data["price"]);
                                    ?>

                                        <div class="card mb-3 mx-0 col-12" style="background-color: #353434;border-radius: 20px;">
                                            <div class="row g-0">
                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">

                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-4">
                                                    <?php
                                                    $img = array();

                                                    $images_rs = Database::search("SELECT * FROM `images` WHERE `games_id`='" . $cart_data["games_id"] . "'");
                                                    $images_data = $images_rs->fetch_assoc();

                                                    ?>

                                                    <img src="<?php echo $images_data["code"]; ?>" class="img-fluid rounded-start" style="height: 200px;" />
                                                    </span>

                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">

                                                        <h3 class="card-title text-white"><?php echo $game_data["title"] ?></h3>
                                                        <br>
                                                        <span class="fw-bold fs-5 text-white">$.<?php echo $game_data["price"] ?>.00</span>
                                                        <br>
                                                        <span class="fw-bold  fs-5 text-white"><?php echo $game_data["description"] ?></span>&nbsp;
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="card-body d-grid">
                                                    <a href='<?php echo "singleProductView.php?id=" . $game_data["id"]; ?>' class="col-12 btn btn-outline-primary mt-2">Buy Now</a>
                                                        <a class="btn btn-outline-danger mb-2 mt-3" onclick="deleteFromCart(<?php echo $cart_data['id']; ?>);">Remove</a>
                                                    </div>
                                                </div>

                                                <hr>


                                            </div>
                                        </div>

                                    <?php

                                    }

                                    ?>




                                </div>
                            </div>
                            <!-- games -->

                            <!-- summary -->
                            <div class="col-12 col-lg-3">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fs-3 fw-bold text-white">Summary</label>
                                    </div>

                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <div class="col-6 mb-3">
                                        <span class="fs-6 fw-bold text-white">items (<?php echo $cart_num; ?>)</span>
                                    </div>

                                    <div class="col-6 text-end mb-3">
                                        <span class="fs-6 fw-bold text-white">$. <?php echo $total; ?> .00</span>
                                    </div>


                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>

                                    <div class="col-6 mt-2">
                                        <span class="fs-4 fw-bold text-white">Total</span>
                                    </div>

                                    <div class="col-6 mt-2 text-end">
                                        <span class="fs-4 fw-bold text-white">Rs. <?php echo ($shipping + $total); ?> .00</span>
                                    </div>

                                    <div class="col-12 mt-3 mb-3 d-grid">
                                        <button class="btn btn-success" type="submit" id="payhere-payment" onclick="payNow(<?php echo $game_data['id']; ?>);">Buy Now</button>
                                    </div>

                                </div>
                            </div>

                            <!-- summary -->

                        <?php
                        }

                        ?>





                    </div>
                </div>

            <?php

            } else {
                echo ("Please Sign In or Register");
            }

            include "footer.php";

            ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>

</html>