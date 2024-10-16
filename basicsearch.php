<?php
session_start();
require "connection.php";

$txt = $_POST["t"];


$query = "SELECT * FROM `games` WHERE `status`='1' ";

if (!empty($txt)) {
    $query .= " AND `title` LIKE '%" . $txt . "%'";
}

?>

<div class="row">
    <div class="offset-lg-1 col-12 col-lg-11 text-center">
        <div class="row">

            <?php


            if ("0" != ($_POST["page"])) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $game_rs = Database::search($query);
            $game_num = $game_rs->num_rows;

            $results_per_page = 10;
            $number_of_pages = ceil($game_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

            ?>

                <div class="card mt-3 mx-3 bg-dark" style="width: 18rem; ">
                    <?php

                    $image_rs = Database::search("SELECT * FROM `images` WHERE `games_id`='" . $selected_data["id"] . "'");
                    $image_data = $image_rs->fetch_assoc();

                    ?>
                    <img src="<?php echo $image_data["code"] ?>" class="card-img-top" />
                    <div class="card-body">
                        <h5 class="card-title text-white"><?php echo $selected_data["title"] ?></h5>
                        <p class="card-text text-white">$<?php echo $selected_data["price"] ?>.00</p>
                        <button class="btn btn-outline-danger" onclick='addToWatchlist(<?php echo $selected_data["id"]; ?>)'><i class="bi bi-heart-fill"></i></button>
                        <button class="btn btn-outline-success" onclick="addToCart(<?php echo $selected__data['id']; ?>);"><i class="bi bi-cart4"></i></button>
                        <a href='<?php echo "singleProductView.php?id=" .  $selected_data["id"]; ?>' class="col-12 btn btn-outline-primary mt-2">Buy Now</a>
                    </div>
                </div>

            <?php

            }
            ?>



        </div>
    </div>
    <!--  -->
    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php

                for ($x = 1; $x <= $number_of_pages; $x++) {
                    if ($x == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!--  -->
</div>