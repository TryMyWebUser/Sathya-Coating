<?php

    include "../libs/load.php";

    // Start a session
    Session::start();

    // Redirect if the user is already logged in
    if (Session::get('login_user'))
    {
        header('Location: welcome.php');
        exit;
    }

    $error = "";

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        // Check if both username and password keys exist in $_POST
        if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['password']))
        {
            $username = $_POST['username'] ?? "";
            $password = $_POST['password'] ?? "";
            $error = User::login($username, $password);
        }
    }

?>

<!DOCTYPE html>
<html lang="en" class="minimal-theme">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="assets/images/favicon.png" type="image/png" />
        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/bootstrap-extended.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href="assets/css/icons.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="assets/font/bootstrap-icons.css" />

        <!-- loader-->
        <link href="assets/css/pace.min.css" rel="stylesheet" />

        <title>Sathya Coating - Admin Login</title>
    </head>

    <body>
        <!--start wrapper-->
        <div class="wrapper">
            <!--start content-->
            <main class="authentication-content">
                <div class="container-fluid">
                    <div class="authentication-card">
                        <div class="card shadow rounded-0 overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                                    <img src="assets/images/error/login-img.jpg" class="img-fluid" alt="" />
                                </div>
                                <div class="col-lg-6">
                                    <div class="card-body p-4 p-sm-5">
                                        <h5 class="card-title">Admin - Sign In</h5><br>
                                        <form class="form-body" method="POST">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="inputEmailAddress" class="form-label">Email Address or Username</label>
                                                    <div class="ms-auto position-relative">
                                                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                                                        <input type="text" name="username" class="form-control radius-30 ps-5" id="inputEmailAddress" placeholder="Email Address or Username" required/>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                                    <div class="ms-auto position-relative">
                                                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                                        <input type="password" name="password" class="form-control radius-30 ps-5" id="inputChoosePassword" placeholder="Enter Password" required/>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" name="submit" class="btn btn-primary radius-30">Login</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!--end page main-->
        </div>
        <!--end wrapper-->

        <!--plugins-->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/pace.min.js"></script>
    </body>

</html>