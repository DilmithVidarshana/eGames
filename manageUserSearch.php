<?php

require "connection.php";

$txt = $_POST["t"];


$query = "SELECT * FROM `user`";

if (!empty($txt)) {
    $query .= " WHERE `email`  LIKE '%" . $txt . "%'";
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

            $user_rs = Database::search($query);
            $user_num = $user_rs->num_rows;

            $results_per_page = 10;
            $number_of_pages = ceil($user_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

            ?>

  
                <tbody>
                <tr>
                <?php
                              
                                ?>
                                      
                                      <?php

$image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" .$selected_data["email"] . "'");
$image_data = $image_rs->fetch_assoc();

?>
                                    <tr>
                                    <td><img src="<?php echo $image_data["code"]?>" class="rounded-circle" style="height: 150px;width:150px"/></td>
                                        <td><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></td>
                                        <td><?php echo $selected_data["email"] ?></td>

                                        <td>
                                            <?php

                                            if ($selected_data["status"] == 1) {
                                            ?>
                                                <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-danger" onclick="blockuser('<?php echo $selected_data['email']; ?>');">Block</button>
                                            <?php
                                            } else {
                                            ?>
                                                <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-success" onclick="blockuser('<?php echo $selected_data['email']; ?>');">Unblock</button>
                                            <?php

                                            }

                                            ?>
                                        </td>
                                    </tr>
                                <?php

                                }

                                ?>

                                            </td>
                                        </tr>
                       
                </tbody>
                </table>



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
                                            ?> onclick="manageUserSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php

                for ($x = 1; $x <= $number_of_pages; $x++) {
                    if ($x == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="manageUserSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="manageUserSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="manageUserSearchh(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!--  -->
</div>