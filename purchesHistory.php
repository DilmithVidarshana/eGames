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

<body style="background-color:#000000;">
    <div class="container-fluid">
        <div class="row">
            <?php include "header.php" ?>
            <div class="col-8">
                <h1 class="text-white fw-bold offset-4">Purces History</h1>
            </div>
            <hr class="text-white" />
            <div class="col-12">
                <div class="row">
                    <div class="col-2 border-0 border-end border-1 border-white">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Purches History </li>
                            </ol>
                        </nav>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Keyword" aria-label="Recipient's username" aria-describedby="basic-addon2" id="t">
                            <span class="input-group-text" id="basic-addon2" onclick="purchesHistorySearch(0)"><i class="bi bi-search"></i></span>
                        </div>

                    </div>
                    <?php


                    if (isset($_SESSION["u"])) {
                        $umail = $_SESSION["u"]["email"];

                        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $umail . "'");
                        $invoice_num = $invoice_rs->num_rows;

                    ?>
                        <?php
                        if ($invoice_num == 0) {
                        ?>
                            <div class="col-12 bg-body text-center" style="height: 450px;">
                                <span class="fs-1 fw-bolder text-black-50 d-block" style="margin-top: 200px;">
                                    You have not purchased any product yet...
                                </span>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-10 ">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-white">#</th>
                                            <th scope="col" class="text-white">Order Id</th>
                                            <th scope="col" class="text-white">Image</th>
                                            <th scope="col" class="text-white">Name</th>
                                            <th scope="col" class="text-white">price</th>
                                            <th scope="col" class="text-white">Purches Date</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    for ($x = 0; $x < $invoice_num; $x++) {
                                        $invoice_data = $invoice_rs->fetch_assoc();
                                    ?>
                                        <tbody id="purches_result">
                                            <tr>
                                                <th scope="row" class="text-white"><?php echo $invoice_data["id"]; ?></th>

                                                <td class="text-white"><?php echo $invoice_data["order"] ?></td>

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
                                                <td class="text-white"><?php echo $games_data["title"] ?></td>
                                                <td class="text-white">$<?php echo $invoice_data["total"] ?>.00</td>
                                                <td class="text-white"><?php echo $invoice_data["date"] ?></td>
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
                        }
                    }
    ?>
    <?php include "footer.php" ?>
        </div>
    </div>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>