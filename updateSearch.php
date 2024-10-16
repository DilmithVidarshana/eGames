<?php

require "connection.php";

$txt = $_POST["t"];
$category = $_POST["cat"];



$query = "SELECT * FROM `games`";
$status = 0;



    if (!empty($txt)) {
        $query .= " WHERE `title` LIKE '%" . $txt . "%'";
        $status = 1;
    }

    if ($status == 0 && $category != 0) {
        $query .= " WHERE `category_id`='" . $category . "'";
        $status = 1;
    } else if ($status != 0 && $category != 0) {
        $query .= " AND `category_id`='" . $category . "'";
    }

    $gid = 0;




if ($_POST["page"] != "0") {

    $pageno = $_POST["page"];
} else {

    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 10;
$number_of_pages = ceil($product_num / $results_per_page);

$viewed_results_count = ((int)$pageno - 1) * $results_per_page;

$query .= " LIMIT " . $results_per_page . " OFFSET " . $viewed_results_count . "";
$results_rs = Database::search($query);
$results_num = $results_rs->num_rows;

while ($results_data = $results_rs->fetch_assoc()) {
?>

    <div class="col-12 col-lg-9" id="view_area">
        <div class="row">

            <!-- have Products -->


            <div class="card mt-3 mx-3 " style="width: 18rem; background-color:#000000;">
                <?php

                $image_rs = Database::search("SELECT * FROM `images` WHERE `games_id`='" .$results_data["id"] . "'");
                $image_data = $image_rs->fetch_assoc();

                ?>
                <img src="<?php echo $image_data["code"] ?>" class="card-img-top" />
                <div class="card-body">
                    <h5 class="card-title text-white"><?php echo $results_data["title"] ?></h5>
                    <p class="card-text text-white">$<?php echo $results_data["price"] ?>.00</p>
                    <button class="btn btn-outline-danger" onclick='addToWatchlist(<?php echo $results_data["id"]; ?>'>Block Games</button>
                    <a href='<?php echo "upadteGameDetails.php?id=" . $results_data["id"]; ?>' class="col-12 btn btn-outline-primary mt-2">Update</a>
                </div>
            </div>


            <!-- have Products -->


        </div>
    </div>

<?php
}

?>



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