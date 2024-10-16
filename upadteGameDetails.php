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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resource/icon.png" />
    <title>eGames|Update Games Details</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="offset-5 mt-3 fw-bold">Update Games</h1>
            </div>

            <hr class="mt-3" />

            <div class="col-12">
                <div class="row">
                    <div class="col-6 col-lg-6">
                        <select class="form-select mt-3" id="category" disabled>

                            <option value="0">Select Category</option>
                            <?php
                          
                            $category_rs = Database::search("SELECT * FROM `category` WHERE `id`='" . $game_data['category_id'] . "'");
                            $category_data = $category_rs->fetch_assoc();

                          
                            ?>
                                <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                            <?php
                          

                            ?>

                        </select>
                    </div>

                    <div class="col-6 col-lg-6">
                        <input class="form-control mt-3" type="text" placeholder="Game title" value="<?php echo $game_data["title"]?>"  disabled/>
                    </div>

                </div>
            </div>

            <hr class="mt-3" />

            <div class="col-12">

                <div class="col-6 col-lg-6 offset-3">
                    <div class="row">
                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="Price" id="price" value="<?php echo $game_data["price"]?>">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>

                </div>
            </div>
            <hr class="mt-3" />



            <div class="col-12">
                <div class="row">
                    <?php
                    $developer_rs = Database::search("SELECT * FROM `developer` WHERE `games_id`='".$gid."'");
                    $developer_data = $developer_rs->fetch_assoc();
                    ?>
                    <div class="col-3 col-lg-3">
                        <input class="form-control mt-3" type="text" placeholder="Refund Type"  value="<?php echo $developer_data["refundt"]?>" disabled/>
                    </div>

                    <div class="col-3 col-lg-3">
                        <input class="form-control mt-3" type="text" placeholder="Developer"  value="<?php echo $developer_data["developer"]?>" disabled/>
                    </div>

                    <div class="col-3 col-lg-3">
                        <input class="form-control mt-3" type="text" placeholder="Publisher"  value="<?php echo $developer_data["publisher"]?>" disabled/>
                    </div>

                    <div class="col-3 col-lg-3">
                        <input class="form-control mt-3" type="text" placeholder="Releasedate"  value="<?php echo $developer_data["relese_date"]?>" disabled/>
                    </div>

                </div>
            </div>

            <hr class="mt-3" />

            <div class="col-12 d-grid">
                <Label class="fs-4 fw-bold">Game Description</Label>
                <textarea cols="30" rows="15" class="form-control" id="description" ><?php echo $game_data["description"]?></textarea>
            </div>
            <hr class="mt-3" />

            <h1>Minimum Syestem requments</h1>
            <div class="col-12">
                <div class="row">
                <?php
                    $systemm_rs = Database::search("SELECT * FROM `systemm` WHERE `games_id`='".$gid."'");
                    $systemm_data = $systemm_rs->fetch_assoc();
                    ?>
                    <div class="col-4 col-lg-4">
                        <input class="form-control mt-3" type="text" placeholder="Ram"  value="<?php  echo $systemm_data["ram"]?>" disabled/>
                    </div>

                    <div class="col-4 col-lg-4">
                        <input class="form-control mt-3" type="text" placeholder="vga"  value="<?php  echo $systemm_data["vga"]?>" disabled/>
                    </div>

                    <div class="col-4 col-lg-4">
                        <input class="form-control mt-3" type="text" placeholder="Processer"  value="<?php  echo $systemm_data["proceesor"]?>" disabled />
                    </div>

                    <div class="col-4 col-lg-4 offset-2">
                        <input class="form-control mt-3" type="text" placeholder="Os"  value="<?php  echo $systemm_data["hdd"]?>" disabled/>
                    </div>

                    <div class="col-4 col-lg-4">
                        <input class="form-control mt-3" type="text" placeholder="Hdd Space"  value="<?php  echo $systemm_data["os"]?>" disabled/>
                    </div>

                </div>
            </div>

            <hr class="mt-3"/>

            <h1>Recommended Syestem requments</h1>
            <div class="col-12">
                <div class="row">
                <?php
                    $systemr_rs = Database::search("SELECT * FROM `systemr` WHERE `games_id`='".$gid."'");
                    $systemr_data = $systemr_rs->fetch_assoc();
                    ?>
                    <div class="col-4 col-lg-4">
                        <input class="form-control mt-3" type="text" placeholder="Ram"  value="<?php echo $systemr_data["ram"]?>" disabled/>
                    </div>

                    <div class="col-4 col-lg-4">
                        <input class="form-control mt-3" type="text" placeholder="vga"  value="<?php echo $systemr_data["vga"]?>" disabled/>
                    </div>

                    <div class="col-4 col-lg-4">
                        <input class="form-control mt-3" type="text" placeholder="Processer"  value="<?php echo $systemr_data["processer"]?>" disabled/>
                    </div>

                    <div class="col-4 col-lg-4 offset-2">
                        <input class="form-control mt-3" type="text" placeholder="Os"  value="<?php echo $systemr_data["hdd"]?>" disabled/>
                    </div>

                    <div class="col-4 col-lg-4">
                        <input class="form-control mt-3" type="text" placeholder="Hdd Space"  value="<?php echo $systemr_data["os"]?>" disabled/>
                    </div>

                </div>
            </div>

            <hr class="mt-3"/>

            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label fw-bold" style="font-size: 20px;">Update Games Images</label>
                    </div>
                    <?php
                    $images = Database::search("SELECT * FROM `images` WHERE `games_id`='".$gid."'");
                    $images_data = $images->fetch_assoc();
                    $screen = Database::search("SELECT * FROM `gscreens` WHERE `games_id`='".$gid."'");
                    $screen_data = $screen->fetch_assoc();
                    ?>
                    <div class="offset-lg-3 col-12 col-lg-6">
                        <div class="row">
                            <div class="col-4 border border-primary rounded">
                                <img src="<?php echo $images_data["code"]?>" class="img-fluid" style="height: 300px;"  />
                            </div>
                            <div class="col-4 border border-primary rounded">
                                <img src="<?php echo $screen_data["scode"]?>" class="img-fluid" style="height: 300px;"  />
                            </div>
                            <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                            <input type="file" class="d-none" id="imageuploader" multiple />
                            <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Images</label>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                    <button class="btn btn-success" onclick="updateGames(<?php echo $gid?>);">Update Game</button>
                </div>
            </div>
        </div>


    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>