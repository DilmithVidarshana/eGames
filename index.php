<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resource/icon.png" />
    <title>Create Account</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-3 col-lg-3 offset-5 mt-3">
                        <img src="resource/logo.png" />
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-1 col-lg-1 py-1 offset-3 mt-3 d-grid">
                        <button class="btn btn-primary " style="height:50px;"><i class="bi bi-facebook"></i></button>
                    </div>
                    <div class="col-1 col-lg-1 py-1  mt-3 d-grid ">
                        <button class="btn btn-light "><i class="bi bi-google"></i></button>
                    </div>
                    <div class="col-1 col-lg-1 py-1  mt-3 d-grid ">
                        <button class="btn btn-info "><i class="bi bi-playstation"></i></button>
                    </div>
                    <div class="col-1 col-lg-1 py-1  mt-3 d-grid ">
                        <button class="btn btn-success "><i class="bi bi-xbox"></i></button>
                    </div>
                    <div class="col-1 col-lg-1 py-1  mt-3 d-grid ">
                        <button class="btn btn-danger "><i class="bi bi-nintendo-switch"></i></button>
                    </div>

                </div>

            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-4 col-lg-4 mt-3">
                        <hr />
                    </div>
                    <div class="col-1 col-lg-1">
                        <p class="fw-bold mt-3 offset-1">OR</p>
                    </div>
                    <div class="col-6 col-lg-6 mt-3">
                        <hr />
                    </div>

                </div>

            </div>
            <!--Create Account-->
            <div class="col-12 " id="signUpBox">
                <div class="row">
                    <div class="col-4 col-lg-4 offset-4">
                        <h1 class="fw-bold">Create Account</h1>
                    </div>
                    <div class="col-12 d-none" id="msgdiv">
                        <div class="alert alert-danger" role="alert" id="alertdiv">
                            <i class="bi bi-x-octagon-fill fs-5" id="msg">

                            </i>
                        </div>
                    </div>
                    <div class="col-6 col-lg-6 mt-3">
                        <p class="fw-bold">First Name</p>
                        <input class="form-control" placeholder="First Name" id="firstname" />
                    </div>
                    <div class="col-6 col-lg-6 mt-3">
                        <p class="fw-bold">Last Name</p>
                        <input class="form-control" placeholder="Last Name" id="lastname" />
                    </div>
                    <div class="col-6 col-lg-6">
                        <p class="fw-bold mt-3">Email</p>
                        <input class="form-control" placeholder="Email" id="email" />
                    </div>
                    <div class="col-6 col-lg-6">
                        <p class="fw-bold mt-3">Password</p>
                        <input class="form-control" type="password" placeholder="Password" id="password" />
                    </div>
                    <div class="col-6 col-lg-6">
                        <p class="fw-bold mt-3">Mobile</p>
                        <input class="form-control" placeholder="Mobile" id="mobile" />
                    </div>
                    <div class="col-6 col-lg-6">
                        <p class="fw-bold mt-3">Gender</p>
                        <select class="form-select mt-3" id="gender">
                            <?php

                            require "connection.php";

                            $rs = Database::search("SELECT * FROM `gender`");
                            $n = $rs->num_rows;

                            for ($x = 0; $x < $n; $x++) {
                                $d = $rs->fetch_assoc();

                            ?>

                                <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>

                            <?php

                            }

                            ?>
                        </select>
                    </div>
                    <div class="col-6 col-lg-6 mt-3 d-grid">
                        <button class="btn btn-success" onclick="signUp();">Create Account</button>
                    </div>
                    <div class="col-6 col-lg-6 mt-3 d-grid">
                        <button class="btn btn-danger" onclick="changeView();">Sign In</button>
                    </div>

                </div>

            </div>
            <!--Create Account-->

            <!--sign In--->
            <div class="col-12 d-none" id="signInBox">
                <div class="row">
                    <div class="col-4 col-lg-4 offset-4">
                        <h1 class="fw-bold">Sign In</h1>
                    </div>
                    <div class="col-12">
                        <span class="text-danger" id="msg2"></span>
                    </div>
                    <?php

                    $email = "";
                    $password = "";

                    if (isset($_COOKIE["email"])) {
                        $email = $_COOKIE["email"];
                    }

                    if (isset($_COOKIE["password"])) {
                        $password = $_COOKIE["password"];
                    }

                    ?>

                    <div class="col-6 col-lg-6">
                        <p class="fw-bold">Email</p>
                        <input class="form-control" placeholder="Email" id="email2" value="<?php echo $email?>" />
                    </div>
                    <div class="col-6 col-lg-6">
                        <p class="fw-bold">Password</p>
                        <input class="form-control" type="password" placeholder="Password" id="password2" value="<?php echo $password ?>" />
                    </div>
                    <div class="col-6 col-lg-6 mt-3">
                        <input type="checkbox" id="rememberme" />
                        <span>Remember me</span>
                    </div>
                    <div class="col-6 col-lg-6 mt-3">
                        <a href="#" onclick="forgotPassword();">Forget Password</a>
                    </div>
                    <div class="col-6 col-lg-6 mt-3 d-grid">
                        <button class="btn btn-success" onclick="signIn();">Sign IN</button>
                    </div>

                    <div class="col-6 col-lg-6 mt-3 d-grid">
                        <button class="btn btn-danger" onclick="changeView();">Create Account</button>
                    </div>
                </div>
            </div>
            <!--sign In--->
              <!-- modal -->

              <div class="modal" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reset Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="npi"/>
                                        <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword1();"><i id="e1" class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp"/>
                                        <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();"><i id="e2" class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="vc"/>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal -->

            <!-- footer -->

            <div class="col-12 fixed-bottom d-none d-lg-block">
                <p class="text-center">&copy; 2022 eGames.com || All Right Reserved</p>
            </div>

            <!-- footer -->

        </div>

    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>