<?php

require "connection.php";

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage user | Admins | eGames</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="icon" href="resource/icon.png" />

</head>

<body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#ccffff 0%,#ffff99 100%);">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center">
                <label class="form-label text-primary fw-bold fs-1">Manage All Users</label>
            </div>

            <div class="col-12 mt-3">
                <div class="row">
                    <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control" id="t"/>
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-warning" onclick="manageUserSearch(0)">Search User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $query = "SELECT * FROM `user`";
            $pageno;

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }

            $user_rs = Database::search($query);
            $user_num = $user_rs->num_rows;

        

            $selected_num = $user_rs->num_rows;
            ?>
            <div class="col-12 mt-3 mb-3">
                <div class="row">


                </div>




                <div class="col-12 mt-3 mb-3" id="manage_user_result">
                    <div class="row">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($x = 0; $x < $user_num; $x++) {
                                    $selected_data = $user_rs->fetch_assoc();

                                ?>
                               
                                 <?php

                                 $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" .$selected_data["email"] . "'");
                                 $image_num = $image_rs->num_rows;
                                 $image_data = $image_rs->fetch_assoc();
                                 
                 
                                 ?>
                                
                                    <tr>
                                        <?php
                                        if($image_num==0){
                                        ?>
                                        <td><img src="resource/logo.png" class="rounded-circle" style="height: 150px;width:150px"/></td>
                                        <?php
                                        }else{
                                        ?>
                                        <td><img src="<?php echo $image_data["code"]?>" class="rounded-circle" style="height: 150px;width:150px"/></td>
                                        <?php
                                        }
                                        ?>
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

                            </tbody>
                        </table>
                    </div>
                </div>





            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
</body>

</html>