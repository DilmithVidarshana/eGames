<?php

require "connection.php";

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Games | Admins | eGames</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/icon.png" />

</head>

<body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#ccffff 0%,#ffff99 100%);">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center">
                <label class="form-label text-primary fw-bold fs-1">Manage All Games</label>
            </div>

            <div class="col-12 mt-3">
                <div class="row">
                    <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control" id="t" />
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-warning" onclick="manageGameSearch(0);">Search User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $query = "SELECT * FROM `games`";
            $pageno;

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }


            $game_rs = Database::search($query);
            $game_num = $game_rs->num_rows;



            $selected_num = $game_rs->num_rows;
            ?>
            <div class="col-12 mt-3 mb-3">
                <div class="row">


                </div>




                <div class="col-12 mt-3 mb-3">
                    <div class="row">
                        <div class="col-12" id="manage_game_result">


                            <table class="table offset-1">
                                <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($x = 0; $x < $game_num; $x++) {
                                        $selected_data = $game_rs->fetch_assoc();

                                    ?>
                                        <tr>
                                            <?php

                                            $image_rs = Database::search("SELECT * FROM `images` WHERE `games_id`='" . $selected_data["id"] . "'");
                                            $image_data = $image_rs->fetch_assoc();

                                            ?>

                                            <td><img src="<?php echo $image_data["code"] ?>" class="rounded-circle" style="height: 150px;width:150px;" /></td>
                                            <td><?php echo $selected_data["title"]; ?></td>
                                            <td>$<?php echo $selected_data["price"] ?>.00</td>

                                            <td>
                                                <?php

                                                if ($selected_data["status"] == 1) {
                                                ?>
                                                    <button id="ub<?php echo $selected_data['id']; ?>" class="btn btn-danger" onclick="blockGames('<?php echo $selected_data['id']; ?>');">Block</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button id="ub<?php echo $selected_data['id']; ?>" class="btn btn-success" onclick="blockGames('<?php echo $selected_data['id']; ?>');">Unblock</button>
                                                <?php

                                                }

                                                ?>
                                            </td>
                                        </tr>
                                    <?php

                                    }

                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>





            </div>
        </div>
     

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
</body>

</html>