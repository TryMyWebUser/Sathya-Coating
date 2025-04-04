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
        if (isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['page']))
        {
            $page = $_POST['page'] ?? "";
            $title = $_POST['title'] ?? "";
            $error = User::setPageCategory($page, $title);
        }

        // Check if both username and password keys exist in $_POST
        if (isset($_POST['submit_cate']) && isset($_POST['title']) && isset($_POST['cate']))
        {
            $cate = $_POST['cate'] ?? "";
            $category = $_POST['title'] ?? "";
            $error = User::setCategory($cate, $category);
        }
    }

    $category = Operations::getPageCate();

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
                                <form class="form-horizontal" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Page Select</label>
                                        <select class="form-select" id="inlineFormCustomSelect" name="page" required>
                                            <option>Choose The Page...</option>
                                            <option value="service">Service Page</option>
                                            <option value="product">Product Page</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
<<<<<<< HEAD
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Title" name="title" required>
=======
                                        <label class="form-label"><b>Title</b></label>
                                        <div class="quill-editor" data-name="title"></div>
                                        <input type="hidden" name="title" required>
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
                        
                        <div class="col-12">
                            <div class="card card-body">
                                <form class="form-horizontal" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Select Category</label>
                                        <select class="form-select" id="inlineFormCustomSelect" name="cate" required>
                                            <option>Choose Category...</option>
                                            <?php
                                                foreach ($category as $cate) {
                                            ?>
                                            <option value="<?= $cate['category'] ?>"><?= $cate['category'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
<<<<<<< HEAD
                                        <label class="form-label">Sub Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Sub Title" name="title" required>
=======
                                        <label class="form-label"><b>Sub Title</b></label>
                                        <div class="quill-editor" data-name="sub_title"></div>
                                        <input type="hidden" name="sub_title" required>
>>>>>>> developer
                                    </div>
                                    <div class="col-12">
                                        <div class="d-md-flex align-items-center">
                                            <div class="ms-auto mt-3 mt-md-0">
                                                <button type="submit" name="submit_cate" class="btn btn-primary hstack gap-6">
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