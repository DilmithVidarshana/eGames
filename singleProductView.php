<?php
require "connection.php";

if (isset($_GET["id"])) {

    $gid = $_GET["id"];

    $game = Database::search("SELECT * FROM `games` WHERE `id` = '" . $gid . "'");
    $game_num = $game->num_rows;

    if ($game_num == 1) {
        $game_data = $game->fetch_assoc()

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
            <link rel="stylesheet" href="style.css" />
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="icon" href="resource/icon.png" />
            <title><?php echo $game_data["title"] ?>|eGAmes</title>
        </head>

        <body style="background-color:#000000;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-10">
                                <div class="row">
                                    <h1 class="text-light fw-bold offset-2"><?php echo $game_data["title"] ?></h1>
                                </div>
                            </div>

                            <?php

                            $image_rs = Database::search("SELECT * FROM `gscreens` WHERE `games_id`='" . $gid . "'");
                            $image_num = $image_rs->num_rows;

                            $mimage_rs = Database::search("SELECT * FROM `images` WHERE `games_id`='" . $gid . "'");
                            $mimage_num = $mimage_rs->num_rows;
                            $mimage_data = $mimage_rs->fetch_assoc();

                            $video_rs = Database::search("SELECT * FROM `videos` WHERE `games_id`='" . $gid . "'");
                                        $video_data = $video_rs->fetch_assoc();
                            
                            if($image_num==0){
                              ?>
                                <div class="col-6 col-lg-6 mt-5">
                                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php

                                      
                                        ?>
                                        <div class="carousel-item active">
                                            <img src="<?php echo $mimage_data["code"] ?>" class="d-block w-100" alt="...">
                                        </div>
                                        <?php
                                        
                                        ?>
                                        <div class="carousel-item">
                                            
                                            <a href="<?php echo $video_data["vcode"]?>"><i class="bi bi-play-fill offset-5 fs-5 btn btn-danger"></i></a>
                                           
                                          
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        <?php

                            }else{

                            
                                $image_data = $image_rs->fetch_assoc();
                            ?>


                                <div class="col-6 col-lg-6 mt-5">
                                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php

                                          
                                            ?>
                                            <div class="carousel-item active">
                                                <img src="<?php echo $mimage_data["code"] ?>" class="d-block w-100" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="<?php echo $image_data["scode"] ?>" class="d-block w-100" alt="...">
                                            </div>
                                            <?php
                                            $video_rs = Database::search("SELECT * FROM `videos` WHERE `games_id`='" . $gid . "'");
                                            $video_data = $video_rs->fetch_assoc()
                                            ?>
                                            <div class="carousel-item">
                                                
                                                <a href="<?php echo $video_data["vcode"]?>"><i class="bi bi-play-fill offset-5 fs-5 btn btn-danger"></i></a>
                                               
                                              
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="col-6 col-lg-6">
                                <div class="col-10 offset-2">
                                    <h1 class="text-light"><?php echo $game_data["title"] ?></h1>
                                </div>
                                <div class="col-10 offset-2">
                                    <h1 class="text-light">$<?php echo $game_data["price"] ?>.00</h1>
                                </div>
                                <div class="col-10 offset-2 d-grid">
                                    <button class="btn btn-success" type="submit" id="payhere-payment" onclick="payNow(<?php echo $gid; ?>);">Buy Now</button>
                                </div>
                                <div class="col-10 offset-2 d-grid mt-3">
                                    <button class="btn btn-outline-primary"><i class="bi bi-cart4"></i>&nbsp;&nbspAdd to cart</button>
                                </div>
                                <div class="col-10 offset-2 d-grid mt-3">
                                    <button class="btn btn-outline-danger"> <i class="bi bi-heart-fill text-danger fs-5" id='heart<?php echo $product_data["id"]; ?>'></i>&nbsp;&nbsp;Add to Wishlist</button>
                                </div>
                                <?php
                                $developer_rs = Database::search("SELECT * FROM `developer` WHERE `games_id`='" . $gid . "'");
                                $developer_data = $developer_rs->fetch_assoc();
                                ?>
                                <div class="col-10 offset-2 mt-3">
                                    <div class="row">
                                        <div class="col-5  mt-3">
                                            <span class="fs-5 text-light">Refund Type</span>
                                        </div>
                                        <div class="col-5  mt-3">
                                            <span class="fs-5 text-light"><?php echo $developer_data["refundt"] ?></span>
                                        </div>
                                        <hr class="text-light mt-3" />
                                    </div>
                                </div>
                                <div class="col-10 offset-2 mt-1">
                                    <div class="row">
                                        <div class="col-5  mt-1">
                                            <span class="fs-5 text-light">Developer</span>
                                        </div>
                                        <div class="col-5  mt-1">
                                            <span class="fs-5 text-light"><?php echo $developer_data["developer"] ?></span>
                                        </div>
                                        <hr class="text-light mt-1" />
                                    </div>
                                </div>
                                <div class="col-10 offset-2 mt-1">
                                    <div class="row">
                                        <div class="col-5  mt-1">
                                            <span class="fs-5 text-light">Release Date</span>
                                        </div>
                                        <div class="col-5  mt-1">
                                            <span class="fs-5 text-light"><?php echo $developer_data["relese_date"] ?></span>
                                        </div>
                                        <hr class="text-light mt-1" />
                                    </div>
                                </div>
                                <div class="col-10 offset-2 mt-1">
                                    <div class="row">
                                        <div class="col-5  mt-1">
                                            <span class="fs-5 text-light">Platform</span>
                                        </div>
                                        <div class="col-5  mt-1">
                                            <span class="fs-5 text-light"><i class="bi bi-windows"></i></span>
                                        </div>
                                        <hr class="text-light mt-1" />
                                    </div>
                                </div>
                                <div class="col-10 offset-2 mt-1">
                                    <div class="row">
                                        <div class="col-5 d-grid mt-1">
                                            <button class="btn btn-outline-light"><i class="bi bi-share-fill"></i>&nbsp;&nbsp;SHARE</button>
                                        </div>
                                        <div class="col-5 d-grid mt-1">
                                            <button class="btn btn-outline-light"><i class="bi bi-flag-fill"></i>&nbsp;&nbsp;Report</button>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <h1 class="fw-bold offset-4 text-light">Description</h1>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12 d-grid mt-2">

                                <textarea class="text-light" style="background-color:#000000;"><?php echo $game_data["description"] ?></textarea>
                            </div>

                            <?php
                            $minimum_requrment = Database::search("SELECT * FROM `systemm` WHERE `games_id`='" . $gid . "'");
                            $minimum_requrment_data = $minimum_requrment->fetch_assoc();
                            ?>
                            <div class="col-8">
                                <div class="row">
                                    <h1 class="fw-bold offset-4 text-light">System Requments</h1>
                                </div>
                            </div>
                            <hr class="text-light" />
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6 col-lg-6 border">
                                        <div class="row">
                                            <div class="col-12">
                                                <h1 class="fw-bold text-light">Minimum System Requments</h1>
                                            </div>

                                            <hr class="text-light mt-3" />

                                            <div class="col-6  col-lg-6">
                                                <span class="text-light">Processer:</span>
                                            </div>
                                            <div class="col-6 col-lg-6">
                                                <span class="text-light"><?php echo $minimum_requrment_data["proceesor"] ?></span>
                                            </div>

                                            <hr class="text-light mt-3" />

                                            <div class="col-6 col-lg-6">
                                                <span class="text-light">OS:</span>
                                            </div>
                                            <div class="col-6 col-lg-6">
                                                <span class="text-light"><?php echo $minimum_requrment_data["os"] ?></span>
                                            </div>

                                            <hr class="text-light mt-3" />

                                            <div class="col-6 col-lg-6">
                                                <span class="text-light">Ram:</span>
                                            </div>
                                            <div class="col-6 col-lg-6">
                                                <span class="text-light"><?php echo $minimum_requrment_data["ram"] ?></span>
                                            </div>

                                            <hr class="text-light mt-3" />

                                            <div class="col-6 col-lg-6">
                                                <span class="text-light">Vga:</span>
                                            </div>
                                            <div class="col-6 col-lg-6">
                                                <span class="text-light"><?php echo $minimum_requrment_data["vga"] ?></span>
                                            </div>

                                            <hr class="text-light mt-3" />

                                            <div class="col-6 col-lg-6">
                                                <span class="text-light">Hdd space:</span>
                                            </div>
                                            <div class="col-6 col-lg-6">
                                                <span class="text-light"><?php echo $minimum_requrment_data["hdd"] ?></span>
                                            </div>

                                            <hr class="text-light mt-3" />

                                        </div>
                                    </div>
                                    <?php
                                    $Recommended_requrment = Database::search("SELECT * FROM `systemr` WHERE `games_id`='" . $gid . "'");
                                    $Recommended_requrment_data = $Recommended_requrment->fetch_assoc();
                                    ?>
                                    <div class="col-6 col-lg-6 border">
                                        <div class="row">
                                            <div class="col-12">
                                                <h1 class="fw-bold text-light">Recommended System Requments</h1>
                                            </div>

                                            <hr class="text-light mt-3" />

                                            <div class="col-6  col-lg-6">
                                                <span class="text-light">Processer:</span>
                                            </div>
                                            <div class="col-6 col-lg-6">
                                                <span class="text-light"><?php echo $Recommended_requrment_data["processer"] ?></span>
                                            </div>

                                            <hr class="text-light mt-3" />

                                            <div class="col-6 col-lg-6">
                                                <span class="text-light">OS:</span>
                                            </div>
                                            <div class="col-6 col-lg-6">
                                                <span class="text-light"><?php echo $Recommended_requrment_data["os"] ?></span>
                                            </div>

                                            <hr class="text-light mt-3" />

                                            <div class="col-6 col-lg-6">
                                                <span class="text-light">Ram:</span>
                                            </div>
                                            <div class="col-6 col-lg-6">
                                                <span class="text-light"><?php echo $Recommended_requrment_data["ram"] ?></span>
                                            </div>

                                            <hr class="text-light mt-3" />

                                            <div class="col-6 col-lg-6">
                                                <span class="text-light">Vga:</span>
                                            </div>

                                            <div class="col-6 col-lg-6">
                                                <span class="text-light"><?php echo $Recommended_requrment_data["vga"] ?></span>
                                            </div>

                                            <hr class="text-light mt-3" />

                                            <div class="col-6 col-lg-6">
                                                <span class="text-light">Hdd space:</span>
                                            </div>
                                            <div class="col-6 col-lg-6">
                                                <span class="text-light"><?php echo $Recommended_requrment_data["hdd"] ?></span>
                                            </div>

                                            <hr class="text-light mt-3" />

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            include "footer.php"
                            ?>
                        </div>
                    </div>

                </div>

            </div>
            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>
<?php
    } else {
        echo ("Sorry for the Inconvenience");
    }
} else {
    echo ("Something went wrong");
}
?>