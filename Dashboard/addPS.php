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
    $category = Operations::getProCategory($conn);

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
            $file = $_FILES['file'] ?? "";
            $img = $_FILES['img'] ?? "";
            $cate = $_POST['cate'] ?? "";
            $error = User::setPS($title, $dec, $file, $img, $cate, $conn);
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
                                        <label class="form-label">Services Page Category (*)</label>
                                        <select class="form-select" id="inlineFormCustomSelect" name="cate">
                                            <option>Select Category</option>
                                            <?php
                                                foreach ($category as $cate) {
                                            ?>
                                            <option value="<?= $cate['category'] ?>"><?= $cate['category'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
<<<<<<< HEAD
                                        <label class="form-label">Background Image Upload (Optional)</label>
                                        <input type="file" name="img" class="form-control" accept=".jpg, .jpeg, .png, .gif">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">PDF Upload (Optional)</label>
                                        <input type="file" name="file" class="form-control" accept=".pdf">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Title (*)</label>
                                        <input type="text" class="form-control" placeholder="Enter Title" name="title" required>
                                    </div>
                                    <div class="mb-3">
                                    <label class="form-label">Description (*)</label>
                                    <textarea class="form-control" name="dec" placeholder="Description" rows="4" required></textarea>
=======
                                        <label class="form-label"><b>Background Image Upload (Optional)</b></label>
                                        <input type="file" name="img" class="form-control" accept=".jpg, .jpeg, .png, .gif">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><b>PDF Upload (Optional)</b></label>
                                        <input type="file" name="file" class="form-control" accept=".pdf">
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
>>>>>>> developer
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