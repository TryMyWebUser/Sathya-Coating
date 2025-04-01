<?php
    include "../libs/load.php";

    // Start a session
    Session::start();

    if (!Session::get('login_user')) {
        header("Location: index.php");
        exit;
    }

    $conn = Database::getConnect();
    $review = Operations::getReviews($conn);
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

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">Reviews Details</h5>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table align-middle">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>User</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (!empty($review)) {
                                            foreach ($review as $row) {
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                <img src="<?= $row['image'] ?>" class="rounded-circle" width="44" height="44" alt="" />
                                                <div class="">
                                                    <p class="mb-0"><?= $row['name'] ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $row['rating'] ?></td>
                                        <td><?= $row['review'] ?></td>
                                        <td>
                                            <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                                <a href="editReview.php?edit_id=<?= $row['id'] ?>" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                                <a href="deleteReview.php?delete_id=<?= $row['id'] ?>" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        } else { echo "<tr><td>Review Not Found</td></tr>"; }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </main>
            <!--end page main-->

            <!--Start Back To Top Button-->
            <a href="javaScript:;" class="back-to-top"><i class="bx bxs-up-arrow-alt"></i></a>
            <!--End Back To Top Button-->

        </div>
        <!--end wrapper-->

        <?php include "temp/footer.php" ?>

    </body>

</html>