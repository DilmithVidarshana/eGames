<?php
require "connection.php";
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/icon.png" />
    <title>Admin Home</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-2">
                <div class="row">
                    <div class="col-12 align-items-start bg-dark vh-100">
                        <div class="row g-1 text-center">

                            <div class="col-12 mt-5">

                                <h4 class="text-white"><?php echo $_SESSION["au"]["fname"] ?></h4>
                                <hr class="border border-1 border-white" />
                            </div>
                            <div class="nav flex-column nav-pills me-3 mt-3" role="tablist" aria-orientation="vertical">
                                <nav class="nav flex-column">
                                    <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                                    <a class="nav-link" href="userView.php">Manage User</a>
                                    <a class="nav-link" href="manageGames.php">Manage Games</a>
                                    <hr class="text-white" />
                                    <button class="btn btn-outline-success mt-3" onclick="window.location='sellingHistory.php'">Selling History</button>
                                    <button class="btn btn-outline-primary mt-3" onclick="window.location='addGames.php'">Add Games</button>
                                    <button class="btn btn-outline-warning mt-3" onclick="window.location='updateGames.php'">Update Games Details</button>
                                    <hr class="text-white" />
                                    <a href="#" class="fw-bold" onclick="adminSignout();">Sign Out</a>
                                    <hr class="text-white" />

                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-10">
                <div class="row">

                    <div class=" fw-bold mb-1 mt-3">
                        <h2 class="fw-bold">Dashboard</h2>
                    </div>
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <div class="row g-1">

                            <div class="col-6 col-lg-6 px-1 shadow">
                                <div class="row g-1">
                                    <div class="col-12 bg-primary text-white text-center rounded" style="height: 100px;">
                                        <br />
                                        <?php
                                        $games_rs = Database::search("SELECT * FROM `games` WHERE `status`='1'");
                                        $games_num = $games_rs->num_rows;
                                        ?>
                                        <span class="fs-4 fw-bold">Active Games</span><br />
                                        <span class="fs-4 fw-bold"><?php echo $games_num ?></span>
                                    </div>

                                </div>
                            </div>

                            <div class="col-6 col-lg-6 px-1 shadow">
                                <div class="row g-1">
                                    <div class="col-12 bg-primary text-white text-center rounded" style="height: 100px;">
                                        <br />
                                        <?php
                                        $user_rs = Database::search("SELECT * FROM `user`");
                                        $user_num = $user_rs->num_rows;
                                        ?>
                                        <span class="fs-4 fw-bold">Active Users</span><br />
                                        <span class="fs-4 fw-bold"><?php echo $user_num ?></span>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-12 bg-dark mt-3">
                        <div class="row">
                            <div class="col-12 col-lg-2 text-center my-3">
                                <label class="form-label fs-4 fw-bold text-white">Total Active Time</label>
                            </div>
                            <div class="col-12 col-lg-10 text-center my-3">
                                <?php

                                $start_date = new DateTime("2023-02-22 00:00:00");

                                $tdate = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $tdate->setTimezone($tz);

                                $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                                $difference = $end_date->diff($start_date);

                                ?>
                                <label class="form-label fs-4 fw-bold text-warning">
                                    <?php

                                    echo $difference->format('%Y') . " Years " . $difference->format('%m') . " Months " .
                                        $difference->format('%d') . " Days " . $difference->format('%H') . " Hours " .
                                        $difference->format('%i') . " Minutes " . $difference->format('%s') . " Seconds ";
                                    ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-6 offset-3">
                            <h1>Most Selling Game</h1>

                          <?php
                          $m_games = Database::search("SELECT games.title, developer.publisher, developer.relese_date, developer.developer, images.code, COUNT(invoice.games_id) as game_count
                          FROM invoice
                          INNER JOIN games ON games.id = invoice.games_id
                          INNER JOIN developer ON developer.games_id = games.id
                          INNER JOIN images ON images.games_id = games.id
                          GROUP BY games.id, games.title, developer.publisher, developer.relese_date, developer.developer, images.code
                          ORDER BY game_count DESC
                          LIMIT 1;");
                          $m_data = $m_games->fetch_assoc();
                          ?>
                            
                            <div class="card" style="width: 550px;">
                                <img src="<?php echo $m_data["code"]?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h1 class="card-title"><?php echo $m_data["title"]?></h1>
                                    <p class="card-text fs-3 fw-bold">Developer:&nbsp;&nbsp;<?php echo $m_data["developer"]?></p>
                                    <p class="card-text fs-3 fw-bold">Publisher:&nbsp;&nbsp;<?php echo $m_data["publisher"]?></p>
                                    <p class="card-text fs-3 fw-bold">Release Date:&nbsp;&nbsp;<?php echo $m_data["relese_date"]?></p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <script src="bootstrap.bundle.js"></script>
                <script src="script.js"></script>
</body>

</html>