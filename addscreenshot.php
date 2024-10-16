<?php
require "connection.php";

if (isset($_GET["id"])) 

    $gid = $_GET["id"];

    $game = Database::search("SELECT * FROM `games` WHERE `id` = '" . $gid . "'");
    $game_num = $game->num_rows;

    if ($game_num == 1) 
        $game_data = $game->fetch_assoc()

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resource/icon.png" />
    <title>Add Screen Shot</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <div class="col-12">
                <div class="row">
                    <div class="col-6 offset-6">

                        <label class="form-label fw-bold" style="font-size: 20px;">Add Screen Shot </label>
                    </div>
                    <div class="offset-lg-3 col-12 col-lg-6 mt-3">
                        <div class="row">
                            <div class="col-4 border border-primary rounded">
                                <img src="resource/addproductimg.svg" class="img-fluid" style="height: 300px;" id="i0" />
                            </div>
                        </div>
                    </div>
                    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                        <input type="file" class="d-none" id="imageuploader" multiple />
                        <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Screen Shot</label>
                    </div>
                   
                </div>
                <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                    <button class="btn btn-success" onclick="addScreenShot(<?php echo $game_data['id']?>);">Save Screen Shot</button>
                </div>
            </div>
    </div>
</div>
<script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
</body>
</html>