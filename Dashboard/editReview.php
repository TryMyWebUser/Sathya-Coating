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
        if (isset($_POST['submit']) && isset($_FILES['img']) && isset($_POST['review']) && isset($_POST['name']) && isset($_POST['rating'])) {
            $getID = $_GET['edit_id'];
            $img = $_FILES['img'] ?? null;
            $review = $_POST['review'];
            $name = $_POST['name'];
            $rating = $_POST['rating'];

            // Call a function to save the contact data (you need to create this function)
            $error = User::updateReview($getID, $review, $name, $rating, $img);
        }
    }

    $conn = Database::getConnect();
    $review = Operations::getReview($conn);

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
                                    <h6 class="mb-0 text-uppercase">Edit Review Page</h6>
                                    <p class="<?= $error ? 'text-danger' : 'text-success' ?>"><?= $error ?></p>
                                    <hr />
                                    <form class="row g-3" method="POST" enctype="multipart/form-data">
                                        <div class="col-12">
                                            <label class="form-label">User Image (Optional)</label>
                                            <input type="file" name="img" class="form-control"/>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($review['name']) ?>" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Rating</label>
                                            <input type="number" name="rating" min="1" max="5" class="form-control" value="<?= $review['rating'] ?>"/>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Review</label>
                                            <div class="quill-editor" data-name="review"><?= isset($review['review']) ? htmlspecialchars($review['review']) : '' ?></div>
                                            <input type="hidden" name="review" value="<?= isset($review['review']) ? htmlspecialchars($review['review']) : '' ?>">
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
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