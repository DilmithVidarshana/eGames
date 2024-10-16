<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resource/icon.png" />
    <title>eGames|invoice</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php require "connection.php";
              session_start();
              
            if (isset($_SESSION["u"])) {
                $umail = $_SESSION["u"]["email"];
                $order_id = $_GET["id"];
            }
            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order`='" . $order_id . "'");
            $invoice_data = $invoice_rs->fetch_assoc();

            ?>
            <div class="12" id="page">
                <div class="row">
                    <div class="col-12">
                        <img src="resource/logo.png" class="offset-5" />
                        <h1 class="fw-bold offset-5">Thank You</h1>
                    </div>
                    <hr />
                    <div class="col-12">

                        <span class="fw-bold fs-4 offset-5">Hi&nbsp;<?php echo $_SESSION["u"]["fname"] ?></span>
                        <h1 class="offset-4 fw-bold mt-3">INVOICE ID:&nbsp; #<?php echo $invoice_data["order"] ?></h1>
                        <span class=" fs-4 offset-4 mt-2">Thanks for purchase from eGames.inc</span>

                    </div>
                    <hr />
                    <div class="col-12">
                        <div class="row">
                            <div class="col-5 offset-1">
                                <h1 class="fs-3">Order ID:</h1>
                                <span class="fw-bold fs-5">#<?php echo $invoice_data["order"] ?></span>
                            </div>
                            <div class="col-6">
                                <h1 class="fs-3">Bill To:</h1>
                                <span class="fw-bold fs-5"><?php echo $_SESSION["u"]["fname"] ?></span>
                            </div>
                            <div class="col-5 offset-1">
                                <h1 class="fs-3">Order Date:</h1>
                                <span class="fw-bold fs-5"><?php echo $invoice_data["date"] ?></span>
                            </div>
                            <div class="col-6">
                                <h1 class="fs-3">Source:</h1>
                                <span class="fw-bold fs-5">eGames</span>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <table class="table">
                                <?php
                                $gid = $invoice_data["games_id"];

                                $games_rs = Database::search("SELECT * FROM `games` WHERE `id`='" . $gid . "' ");
                                $games_data = $games_rs->fetch_assoc();

                                $developer_rs = Database::search("SELECT * FROM `developer` WHERE `games_id`='" . $gid . "' ");
                                $developer_data = $developer_rs->fetch_assoc();
                                ?>

                                <thead>
                                    <tr>
                                        <th scope="col">name</th>
                                        <th scope="col">Publisher</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $games_data["title"] ?></td>
                                        <td><?php echo $developer_data["publisher"] ?></td>
                                        <td>$<?php echo $games_data["price"] ?>.00</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td></td>
                                        <td class="fw-bold">Total</td>
                                        <td>$<?php echo $invoice_data["total"] ?>.00</td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>
                    </div>
                    <hr />
                </div>
            </div>

            <div class="col-12">
                <div class="col-12 btn-toolbar justify-content-end">
                    <button class="btn btn-dark fs-5 me-2" onclick="printInvoice();"><i class="bi bi-printer-fill"></i> print</button>
                    <button class="btn btn-danger fs-5 me-2 bi bi-filetype-pdf" onclick="sendInvoice()"> Send Email</button>
                </div>
            </div>
            <hr class="mt-3"/>
            <?php include "footer.php" ?>
        </div>
    </div>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>