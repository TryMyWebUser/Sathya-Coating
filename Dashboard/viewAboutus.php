<?php
    include "../libs/load.php";

    // Start a session
    Session::start();

    if (!Session::get('login_user')) {
        header("Location: index.php");
        exit;
    }

    $conn = Database::getConnect();
    $aboutus = Operations::getAboutUs($conn);
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

                <div class="card bg-transparent shadow-none">
                    <div class="card-body">
                        <div class="row row-cols-12 row-cols-lg-12 justify-content-center g-lg-12">
                            <?php
                                if (!empty($aboutus)) {
                                    foreach ($aboutus as $row) {
                                        $points = explode(',', $row['points']);
                            ?>
                            <div class="col">
                                <div class="card">
                                    <!-- Carousel/Slider for Images -->
                                    <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="<?= $row['img1'] ?>" class="d-block w-100" alt="Image 1" />
                                            </div>
                                            <div class="carousel-item">
                                                <img src="<?= $row['img2'] ?>" class="d-block w-100" alt="Image 2" />
                                            </div>
                                        </div>
                                        <!-- Carousel Controls -->
                                        <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>

                                    <div class="card-body border-bottom">
                                        <p class="card-text">Experience: <?= $row['exp'] ?></p>
                                        <h5 class="card-title"><?= $row['title'] ?></h5>
                                        <p class="card-text"><?= $row['dec'] ?></p>

                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <?php
                                            foreach ($points as $point) {
                                                $point = trim($point);
                                                if (!empty($point)) {
                                        ?>
                                        <li class="list-group-item"> - <?= $point ?></li>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </ul>
                                    <div class="card-body border-top d-flex justify-content-between">
                                    <a href="editAboutus.php?edit_id=<?= $row['id'] ?>" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="deleteAboutus.php?delete_id=<?= $row['id'] ?>" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    }
                                } else { echo "<p>About Us Not Found</p>"; }
                            ?>
                        </div>
                        <!--end row-->
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
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" />
        <!-- Bootstrap Bundle with Popper -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    </body>
    
</html>