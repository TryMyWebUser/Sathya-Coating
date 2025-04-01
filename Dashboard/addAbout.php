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

    // Handle About Us form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Add About Us (setAboutUs)
        if (isset($_POST['submit'])) {
            $img1 = $_FILES['img1'];
            $img2 = $_FILES['img2'];
            $exp = $_POST['exp'];
            $title = $_POST['title'];
            $dec = $_POST['dec'];
            $point = $_POST['point'];

            // Call setAboutUs to insert data
            $error = User::setHomeAboutUs($img1, $img2, $exp, $title, $dec, $point);
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
                    <div class="col-xl-8 mx-auto">

                        <div class="card">
                            <div class="card-body">
                                <div class="border p-3 rounded">
                                    <h6 class="mb-0 text-uppercase">About Us Page</h6>
                                    <p class="<?= $error ? 'text-danger' : 'text-success' ?>"><?= $error ?></p>
                                    <hr />
                                    <form class="row g-3" method="POST" enctype="multipart/form-data">
                                        <div class="col-12">
<<<<<<< HEAD
                                            <label class="form-label">Image 1</label>
                                            <input type="file" name="img1" class="form-control" required/>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Image 2</label>
                                            <input type="file" name="img2" class="form-control" required/>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Experience</label>
                                            <input type="text" name="exp" class="form-control" required/>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" required/>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="dec" rows="4" required></textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Points - Use (,)</label>
                                            <textarea class="form-control" name="point" rows="3" required></textarea>
=======
                                            <label class="form-label"><b>Image 1</b></label>
                                            <input type="file" name="img1" class="form-control" required/>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label"><b>Image 2</b></label>
                                            <input type="file" name="img2" class="form-control" required/>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label"><b>Experience</b></label>
                                            <div class="quill-editor" data-name="exp"></div>
                                            <input type="hidden" name="exp" required>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label"><b>Title</b></label>
                                            <div class="quill-editor" data-name="title"></div>
                                            <input type="hidden" name="title" required>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label"><b>Description</b></label>
                                            <div class="quill-editor" data-name="dec"></div>
                                            <input type="hidden" name="dec" required>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label"><b>Points - Use (,)</b></label>
                                            <div class="quill-editor" data-name="point"></div>
                                            <input type="hidden" name="point" required>
>>>>>>> developer
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