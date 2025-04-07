<?php

    include "../libs/load.php";

    // Start a session
    Session::start();

    if (!Session::get('login_user'))
    {
        header("Location: index.php");
        exit;
    }

    $error = "";

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        // Check if both username and password keys exist in $_POST
        if (isset($_POST['submit']) && isset($_POST['header']) && isset($_POST['title']) && isset($_POST['dec']) && isset($_POST['b1']) && isset($_POST['b2']))
        {
            $getID = $_GET['edit_id'];
            $img = $_FILES['img'] ?? "";
            $header = $_POST['header'] ?? "";
            $title = $_POST['title'] ?? "";
            $dec = $_POST['dec'] ?? "";
            $b1 = $_POST['b1'] ?? "";
            $b2 = $_POST['b2'] ?? "";
            $error = User::updateHomeHero($getID, $img, $header, $title, $dec, $b1, $b2);
        }
    }

    $conn = Database::getConnect();
    $hero = Operations::getHomeHero($conn)

?>

<!DOCTYPE html>
<html lang="en" class="minimal-theme">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <?php include "temp/head.php"; ?>

    </head>

    <body>
        <!--start wrapper-->
        <div class="wrapper">

            <?php include "temp/header.php"; ?>

            <?php include "temp/sideheader.php"; ?>

            <!--start content-->
            <main class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-body">
                                <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label"><b>Slider Background Image Upload</b></label>
                                        <input type="file" name="img" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><b>Header</b></label>
                                        <div class="quill-editor" data-name="header"><?= htmlspecialchars($hero['header']) ?></div>
                                        <input type="hidden" name="header" value="<?= htmlspecialchars($hero['header']) ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><b>Title</b></label>
                                        <div class="quill-editor" data-name="title"><?= htmlspecialchars($hero['title']) ?></div>
                                        <input type="hidden" name="title" value="<?= htmlspecialchars($hero['title']) ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><b>Description</b></label>
                                        <div class="quill-editor" data-name="dec"><?= htmlspecialchars($hero['dec']) ?></div>
                                        <input type="hidden" name="dec" value="<?= htmlspecialchars($hero['dec']) ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><b>Button Text 1</b></label>
                                        <input type="text" class="form-control" placeholder="Enter Button Text" name="b1" 
                                            value="<?= isset($hero['button_text1']) ? htmlspecialchars($hero['button_text1']) : '' ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><b>Button Text 2</b></label>
                                        <input type="text" class="form-control" placeholder="Enter Button Text" name="b2" 
                                            value="<?= isset($hero['button_text2']) ? htmlspecialchars($hero['button_text2']) : '' ?>">
                                    </div>

                                    <div class="col-12">
                                        <div class="d-md-flex align-items-center">
                                            <div class="ms-auto mt-3 mt-md-0">
                                                <button type="submit" name="submit" class="btn btn-primary hstack gap-6">
                                                    <i class="ti ti-send fs-4"></i>
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </main>

        </div>

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class="bx bxs-up-arrow-alt"></i></a>
        <!--End Back To Top Button-->

        <?php include "temp/footer.php"; ?>
        
    </body>
</html>