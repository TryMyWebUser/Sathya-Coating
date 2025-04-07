<?php

    include "../libs/load.php";

    // Start a session
    Session::start();

    // Redirect if the user is not logged in
    if (!Session::get('login_user')) {
        header("Location: index.php");
        exit;
    }

    $error = "";

    // Handle contact page form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Contact form submission
        if (isset($_POST['submit']) && isset($_POST['map']) && isset($_POST['number']) && isset($_POST['email']) && isset($_POST['address'])) {
            $map = $_POST['map'];
            $number = $_POST['number'];
            $email = $_POST['email'];
            $address = $_POST['address'];

            // Call a function to save the contact data (you need to create this function)
            $error = User::setContact($map, $number, $email, $address);
        }

        // Social media form submission
        if (isset($_POST['submit_link']) && isset($_POST['link']) && isset($_POST['wa']) && isset($_POST['yt'])) {
            $link = $_POST['link'];
            $wa = $_POST['wa'];
            $yt = $_POST['yt'];

            $error = User::setSocial($link, $wa, $yt);
        }
    }

?>

<!DOCTYPE html>
<html lang="en" class="minimal-theme">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <?php include "temp/head.php" ?>

    </head>

    <body>
        <!--start wrapper-->
        <div class="wrapper">
            
            <?php include "temp/header.php" ?>

            <?php include "temp/sideheader.php" ?>

            <!--start content-->
            <main class="page-content">

                <div class="row">
                    <div class="col-xl-6 mx-auto">

                        <div class="card">
                            <div class="card-body">
                                <div class="border p-3 rounded">
                                    <h6 class="mb-0 text-uppercase">Contact Page</h6>
                                    <p class="<?= $error ? 'text-danger' : 'text-success' ?>"><?= $error ?></p>
                                    <hr />
                                    <form class="row g-3" method="POST">
                                        <div class="col-12">
                                            <label class="form-label">Google Map - Use (HTML Iframe)</label>
                                            <input type="text" name="map" class="form-control" required/>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Numbers - Use (,)</label>
                                            <input type="text" name="number" class="form-control" required/>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Emails - Use (,)</label>
                                            <input type="text" name="email" class="form-control" required/>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Address - Use (&lt;br&gt; for next line print)</label>
                                            <textarea class="form-control" name="address" rows="4" cols="4" required></textarea>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-3 rounded">
                                    <h6 class="mb-0 text-uppercase">Social Medias</h6>
                                    <p class="<?= $error ? 'text-danger' : 'text-success' ?>"><?= $error ?></p>
                                    <hr />
                                    <form class="row g-3" method="POST">
                                        <div class="col-12">
                                            <label class="form-label">Linkedin - Use (Full Link)</label>
                                            <input type="text" name="link" class="form-control" required/>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">WhatsApp - Use (Number Only)</label>
                                            <input type="text" name="wa" class="form-control" required/>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">YouTube - Use (Full Link)</label>
                                            <input type="text" name="yt" class="form-control" required/>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" name="submit_link" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--end row-->

            </main>
            <!--end page main-->
        </div>
        <!--end wrapper-->

        <?php include "temp/footer.php" ?>

    </body>

</html>