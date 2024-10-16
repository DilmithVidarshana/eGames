<?php
session_start();
require "connection.php";

$txt = $_POST["t"];



$query = "SELECT * FROM `games` INNER JOIN `invoice` ON `games`.`id`=`invoice`.`games_id` WHERE `invoice`.`games_id`=`games`.`id`";

if (!empty($txt)) {
    $query .= " AND `order` LIKE '%" . $txt . "%'";
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

                <tbody>
                    <tr>
                        <th scope="row" class="text-white"><?php echo $selected_data["id"]; ?></th>

                        <td class="text-white"><?php echo $selected_data["order"] ?></td>

                        <?php
                        $gid = $selected_data["games_id"];
                        $image_rs = Database::search("SELECT * FROM `images` WHERE `games_id`='" . $selected_data["id"] . "' ");
                        $image_data = $image_rs->fetch_assoc();
                        ?>
                        <td> <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-start" style="height: 100px;width:100px;" /></td>
                        <?php
                        $games_rs = Database::search("SELECT * FROM `games` WHERE `id`='" . $gid . "' ");
                        $games_data = $games_rs->fetch_assoc();
                        ?>
                        <td class="text-white"><?php echo $selected_data["title"] ?></td>
                        <td class="text-white">$<?php echo $selected_data["total"] ?>.00</td>
                        <td class="text-white"><?php echo $selected_data["date"] ?></td>
                    </tr>

                <?php
            }
                ?>
                </tbody>




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
                                            ?> onclick=" purchesHistorySearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                    } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php

                for ($x = 1; $x <= $number_of_pages; $x++) {
                    if ($x == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick=" purchesHistorySearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick=" purchesHistorySearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
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