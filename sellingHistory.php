<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resource/icon.png" />
    <title>eGames|Purces History</title>
</head>

<body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#ccffff 0%,#ffff99 100%);">
    <div class="container-fluid">
        <div class="row">

            <div class="col-8">
                <h1 class=" fw-bold offset-4">Selling History</h1>
            </div>
            <hr class="text-white" />
            <div class="col-12">
                <div class="row">
                    <div class="col-2 border-0 border-end border-1 border-dark">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="adminpanel.php">Admin Panel</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Selling History </li>
                            </ol>
                        </nav>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Order Number" aria-label="Recipient's username" aria-describedby="basic-addon2" id="selling_search_txt">
                            <span class="input-group-text btn btn-secondary" id="basic-addon2" onclick="sellinghistory(0)"><i class="bi bi-search"></i></span>
                        </div>
                    </div>
                    <?php
                    require "connection.php";



                    $invoice_rs = Database::search("SELECT * FROM `invoice` ");
                    $invoice_num = $invoice_rs->num_rows;

                    ?>


                    <div class="col-10 " >
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Order Id</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">price</th>
                                    <th scope="col">Purches Date</th>
                                </tr>
                            </thead>
                            <?php
                            for ($x = 0; $x < $invoice_num; $x++) {
                                $invoice_data = $invoice_rs->fetch_assoc();
                            ?>
                                <tbody id="sellingHistorySearchResult">
                                    <tr>
                                        <th scope="row"><?php echo $invoice_data["id"]; ?></th>

                                        <td><?php echo $invoice_data["order"] ?></td>

                                        <?php
                                        $gid = $invoice_data["games_id"];
                                        $image_rs = Database::search("SELECT * FROM `images` WHERE `games_id`='" . $gid . "' ");
                                        $image_data = $image_rs->fetch_assoc();
                                        ?>
                                        <td> <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-start" style="height: 100px;width:100px;" /></td>
                                        <?php
                                        $games_rs = Database::search("SELECT * FROM `games` WHERE `id`='" . $gid . "' ");
                                        $games_data = $games_rs->fetch_assoc();
                                        ?>
                                        <td><?php echo $games_data["title"] ?></td>
                                        <td>$<?php echo $invoice_data["total"] ?>.00</td>
                                        <td><?php echo $invoice_data["date"] ?></td>
                                    </tr>

                                <?php
                            }
                                ?>
                                </tbody>
                        </table>
                    </div>
                </div>


            </div>
            <?php

            ?>
        </div>
    </div>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>