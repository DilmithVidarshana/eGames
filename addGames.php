<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resource/icon.png" />
    <title>eGames|Add Games</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="offset-5 mt-3 fw-bold">Add Games</h1>
            </div>

            <hr class="mt-3" />

            <div class="col-12">
                <div class="row">
                    <div class="col-6 col-lg-6">
                        <select class="form-select mt-3" id="category">

                            <option value="0">Select Category</option>
                            <?php
                            require "connection.php";
                            $category_rs = Database::search("SELECT * FROM `category`");
                            $category_num = $category_rs->num_rows;

                            for ($x = 0; $x < $category_num; $x++) {
                                $category_data = $category_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                            <?php
                            }

                            ?>

                        </select>
                    </div>

                    <div class="col-6 col-lg-6">
                        <input class="form-control mt-3" type="text" placeholder="Game title" id="title" />
                    </div>

                </div>
            </div>

            <hr class="mt-3" />

            <div class="col-12">

                <div class="col-6 col-lg-6 offset-3">
                    <div class="row">
                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="Price" id="price">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>

                </div>
            </div>
            <hr class="mt-3" />



            <div class="col-12">
                <div class="row">
                    <div class="col-3 col-lg-3">
                        <input class="form-control mt-3" type="text" placeholder="Refund Type" id="refund" />
                    </div>

                    <div class="col-3 col-lg-3">
                        <input class="form-control mt-3" type="text" placeholder="Developer" id="developer" />
                    </div>

                    <div class="col-3 col-lg-3">
                        <input class="form-control mt-3" type="text" placeholder="Publisher" id="publisher" />
                    </div>

                    <div class="col-3 col-lg-3">
                        <input class="form-control mt-3" type="text" placeholder="Releasedate" id="rd" />
                    </div>

                </div>
            </div>

            <hr class="mt-3" />

            <div class="col-12 d-grid">
                <Label class="fs-4 fw-bold">Game Description</Label>
                <textarea cols="30" rows="15" class="form-control" id="description"></textarea>
            </div>
            <hr class="mt-3" />

            <h1>Minimum Syestem requments</h1>
            <div class="col-12">
                <div class="row">
                    <div class="col-4 col-lg-4">
                        <input class="form-control mt-3" type="text" placeholder="Ram" id="mram" />
                    </div>

                    <div class="col-4 col-lg-4">
                        <input class="form-control mt-3" type="text" placeholder="vga" id="mvga" />
                    </div>

                    <div class="col-4 col-lg-4">
                        <input class="form-control mt-3" type="text" placeholder="Processer" id="mprocesser" />
                    </div>

                    <div class="col-4 col-lg-4 offset-2">
                        <input class="form-control mt-3" type="text" placeholder="Os" id="mos" />
                    </div>

                    <div class="col-4 col-lg-4">
                        <input class="form-control mt-3" type="text" placeholder="Hdd Space" id="mhdd" />
                    </div>

                </div>
            </div>

            <hr class="mt-3" />

            <h1>Recommended Syestem requments</h1>
            <div class="col-12">
                <div class="row">
                    <div class="col-4 col-lg-4">
                        <input class="form-control mt-3" type="text" placeholder="Ram" id="ram" />
                    </div>

                    <div class="col-4 col-lg-4">
                        <input class="form-control mt-3" type="text" placeholder="vga" id="vga" />
                    </div>

                    <div class="col-4 col-lg-4">
                        <input class="form-control mt-3" type="text" placeholder="Processer" id="processer" />
                    </div>

                    <div class="col-4 col-lg-4 offset-2">
                        <input class="form-control mt-3" type="text" placeholder="Os" id="os" />
                    </div>

                    <div class="col-4 col-lg-4">
                        <input class="form-control mt-3" type="text" placeholder="Hdd Space" id="hdd" />
                    </div>

                </div>
            </div>

            <hr class="mt-3" />

            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label fw-bold" style="font-size: 20px;">Add GAme Video</label>
                    </div>
                    
                    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                    <input type="text"  id="video" class="form-control" placeholder="Enter Youtube link"/>
                    </div>
                </div>

            </div>
            
            <hr class="mt-3" />
            
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label fw-bold" style="font-size: 20px;">Add GAme Images</label>
                    </div>
                    <div class="offset-lg-3 col-12 col-lg-6">
                        <div class="row">
                            <div class="col-4 border border-primary rounded">
                                <img src="resource/addproductimg.svg" class="img-fluid" style="height: 300px;" id="i0" />
                            </div>
                        </div>
                    </div>
                    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                        <input type="file" class="d-none" id="imageuploader" multiple />
                        <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Images</label>
                    </div>

                </div>
                <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                    <button class="btn btn-success" onclick="addGame();">Save Game</button>
                </div>
            </div>
        </div>


    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>