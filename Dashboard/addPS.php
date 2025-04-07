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

    $conn = Database::getConnect();
    $category = Operations::getCateChecker($conn);

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        // Check if both username and password keys exist in $_POST
        if (
            isset($_POST['submit']) &&
            isset($_POST['title']) &&
            isset($_POST['dec']) &&
            isset($_POST['cate'])
        ) {
            $title = $_POST['title'] ?? "";
            $dec = $_POST['dec'] ?? "";
            $img = $_FILES['img'] ?? "";
            $cate = $_POST['cate'] ?? "";
            $error = User::setPS($title, $dec, $img, $cate, $conn);
        } else {
            $error = "Invalid form submission";
        }        
    }

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
                                <p class="<?= $error ? 'text-danger' : 'text-success' ?>"><?= $error ?></p>
                                <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label">Page Category (*)</label>
                                        <select class="form-select" id="inlineFormCustomSelect" name="cate" required>
                                            <option>Select Category</option>
                                            <option disabled>Products:</option>
                                            <?php
                                                foreach ($category as $cate) {
                                                    if ($cate['page'] === 'product') {
                                            ?>
                                            <option value="<?= $cate['category'] ?>"><?= $cate['category'] ?></option>
                                            <?php } } ?>
                                            <option disabled>Services:</option>
                                            <?php
                                                foreach ($category as $cate) {
                                                    if ($cate['page'] === 'service') {
                                            ?>
                                            <option value="<?= $cate['category'] ?>"><?= $cate['category'] ?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><b>Image Upload</b></label>
                                        <input type="file" name="img" class="form-control" accept=".jpg, .jpeg, .png, .gif" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><b>Title (*)</b></label>
                                        <div class="quill-editor" data-name="title"></div>
                                        <input type="hidden" name="title" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><b>Description (*)</b></label>
                                        <div class="quill-editor" data-name="dec"></div>
                                        <input type="hidden" name="dec" required>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-md-flex align-items-center">
                                            <div class="ms-auto mt-3 mt-md-0">
                                                <button type="submit" name="submit" class="btn btn-primary hstack gap-6">
                                                    <i class="ti ti-send fs-4"></i>
                                                    Submit
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