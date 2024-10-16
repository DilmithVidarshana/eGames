<?php
session_start();
require "connection.php";

$txt = $_POST["t"];

$wacth_rs = Database::search("SELECT * FROM `wacthlist`");
$watch_data = $wacth_rs->fetch_assoc();

$query = "SELECT * FROM `games` WHERE `id`='" . $watch_data["games_id"] . "'";

if (!empty($txt)) {
    $query .= " AND `title` LIKE '%" . $txt . "%'";
}

?>

<div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 text-center">
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

                <div class="card mb-3 mx-0 mx-lg-2 col-12" style="background-color: #3F3E3E;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <?php
                            $img = array();

                            $images_rs = Database::search("SELECT * FROM `images` WHERE `games_id`='" . $selected_data["id"] . "'");
                            $images_data = $images_rs->fetch_assoc();

                            ?>
                            <img src="<?php echo $images_data["code"]; ?>" class="img-fluid rounded-start" style="height: 200px;" />
                        </div>
                        <div class="col-md-5">
                            <div class="card-body">
                                <?php

                                

                                ?>
                                <h5 class="card-title fs-2 fw-bold text-white mt-5"><?php echo $selected_data["title"]; ?></h5>
                                <h5 class="card-title  fw-bold text-white ">$<?php echo $selected_data["price"]; ?>.00</h5>
                            </div>
                        </div>
                        <div class="col-md-3 mt-5">
                            <div class="card-body d-lg-grid">
                                <div class="row">
                                    <a href="#" class="btn btn-outline-success mb-2">Buy Now</a>
                                    <button class="col-5 btn btn-outline-danger mt-2 border border-danger" onclick='addToWatchlist(<?php echo $games_data["id"]; ?>);'>
                                        <i class="bi bi-heart-fill text-dark fs-5" id='heart<?php echo $selected_data["id"]; ?>'></i>
                                    </button>
                                    <button class="col-5 btn btn-outline-info mt-2 mx-2" onclick="addToCart(<?php echo $selected_data['id']; ?>);"><i class="bi bi-cart4"></i>&nbsp;&nbsp;</button>
                                </div>
                            </div>
                        </div>
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
                                            ?> onclick="wacthlistSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php

                for ($x = 1; $x <= $number_of_pages; $x++) {
                    if ($x == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="wacthlistSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="wacthlistSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="wacthlistSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!--  -->
</div>