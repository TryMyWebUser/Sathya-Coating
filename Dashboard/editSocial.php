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
        // Social media form submission
        if (isset($_POST['submit_link']) && isset($_POST['fb']) && isset($_POST['insta']) && isset($_POST['wa']) && isset($_POST['yt'])) {
            $getID = $_GET['edit_id'];
            $fb = $_POST['fb'];
            $insta = $_POST['insta'];
            $wa = $_POST['wa'];
            $yt = $_POST['yt'];

            $error = User::updateSocial($fb, $insta, $wa, $yt, $getID);
        }
    }

    $conn = Database::getConnect();
    $social = Operations::getMedia($conn);

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
                                    <h6 class="mb-0 text-uppercase">Social Medias</h6>
                                    <p class="<?= $error ? 'text-danger' : 'text-success' ?>"><?= $error ?></p>
                                    <hr />
                                    <form class="row g-3" method="POST">
                                        <div class="col-12">
                                            <label class="form-label">Facebook - Use (Full Link)</label>
                                            <input type="text" name="fb" class="form-control" value="<?= htmlspecialchars($social['facebook']) ?>"/>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Instagram - Use (Full Link)</label>
                                            <input type="text" name="insta" class="form-control" value="<?= htmlspecialchars($social['instagram']) ?>"/>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">WhatsApp - Use (Number Only)</label>
                                            <input type="text" name="wa" class="form-control" value="<?= htmlspecialchars($social['whatsapp']) ?>"/>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">YouTube - Use (Full Link)</label>
                                            <input type="text" name="yt" class="form-control" value="<?= htmlspecialchars($social['youtube']) ?>"/>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" name="submit_link" class="btn btn-primary">Save</button>
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