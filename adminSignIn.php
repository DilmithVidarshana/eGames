<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resource/icon.png" />
    <title>eGames| Admin Signin</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <img src="resource/logo.png" class="offset-5 mt-3" />
                <h1 class="fw-bold offset-4 mt-3">Welcome To eGAmes</h1>
            </div>

            <div class="col-12">
                <div class="col-6">
                    <input class="form-control offset-6 mt-3" placeholder="Enter Your Email" id="email" />
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-3 offset-3 mt-3 d-grid">
                        <button href="adminPanel.php" class="btn btn-outline-primary" onclick="veryfication()">Go to admin panel</button>
                    </div>
                    <div class="col-3  mt-3 d-grid">
                        <a href="index.php" class="btn btn-outline-danger">Go to Castemer Log IN</a>
                    </div>
                </div>
            </div>

            <!--model--->
            <div class="modal" tabindex="-1" id="verificationModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reset Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">



                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="vcode" />
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Goto admin Panel</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--model--->

            <div class="col-12 fixed-bottom d-none d-lg-block offset-4">
                <span class="text-center">Egames &copy;All rigth</span>

            </div>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>