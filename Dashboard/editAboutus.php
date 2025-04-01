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

    $conn = Database::getConnect();
    $about = Operations::getAbout($conn);
    
    // Handle About Us form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // Update About Us (updateAboutUs)
        if (isset($_POST['update'])) {
            $getID = $_GET['edit_id'];
            $img1 = $_FILES['img1'];
            $img2 = $_FILES['img2'];
            $exp = $_POST['exp'];
            $title = $_POST['title'];
            $dec = $_POST['dec'];
            $point = $_POST['point'];

            // Call updateAboutUs to modify data
            $error = User::updateAboutUs($getID, $img1, $img2, $exp, $title, $dec, $point, $conn);
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
                                    <h6 class="mb-0 text-uppercase">Edit About Us Page</h6>
                                    <p class="<?= $error ? 'text-danger' : 'text-success' ?>"><?= $error ?></p>
                                    <hr />
                                    <form class="row g-3" method="POST" enctype="multipart/form-data">
                                        <div class="col-12">
                                            <label class="form-label">Image 1 (Optional)</label>
                                            <input type="file" name="img1" class="form-control"/>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Image 2 (Optional)</label>
                                            <input type="file" name="img2" class="form-control"/>
                                        </div>
                                        <div class="col-12">
<<<<<<< HEAD
                                            <label class="form-label">Experience</label>
                                            <input type="text" name="exp" class="form-control" value="<?= $about['exp'] ?>"/>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" value="<?= $about['title'] ?>"/>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="dec" rows="4"><?= $about['dec'] ?></textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Points - Use (,)</label>
                                            <textarea class="form-control" name="point" rows="3"><?= $about['points'] ?></textarea>
=======
                                            <label class="form-label"><b>Experience</b></label>
                                            <div class="quill-editor" data-name="exp"><?= $about['exp'] ?></div>
                                            <input type="hidden" name="exp" value="<?= htmlspecialchars($about['exp']) ?>">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label"><b>Title</b></label>
                                            <div class="quill-editor" data-name="title"><?= $about['title'] ?></div>
                                            <input type="hidden" name="title" value="<?= htmlspecialchars($about['title']) ?>">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label"><b>Description</b></label>
                                            <div class="quill-editor" data-name="dec"><?= $about['dec'] ?></div>
                                            <input type="hidden" name="dec" value="<?= htmlspecialchars($about['dec']) ?>">
                                        </div>

                                        <!-- <div class="col-12">
                                            <label class="form-label"><b>Points - Use (,)</b></label>
                                            <div class="quill-editor" data-name="point">< ?= $about['points'] ?></div>
                                            <input type="hidden" name="point" value="< ?= htmlspecialchars($about['points']) ?>">
                                        </div> -->
                                        <div class="col-12">
                                            <label class="form-label">Points - Use (,)</label>
                                            <input type="text" class="form-control" name="point" value="<?= htmlspecialchars($about['points']) ?>" placeholder="Enter points separated by commas">
>>>>>>> developer
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" name="update" class="btn btn-warning">Save</button>
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