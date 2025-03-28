<?php

    include "../libs/load.php";

    // Start a session
    Session::start();

    if (!Session::get('login_user'))
    {
        header("Location: index.php");
        exit;
    }

    $conn = Database::getConnect();
    $hero = Operations::getBGHero($conn);

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
                    <div class="row g-3">
                        <?php
                            if (!empty($hero)) {
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <!-- Card -->
                            <div class="card">
                                <img class="card-img-top img-responsive" src="<?= $hero['img']; ?>" alt="Card image" />
                                <div class="card-body">
                                    <a href="deleteBGHero.php?delete_id=<?= $hero['id']; ?>" class="btn btn-outline-danger btn-sm ms-1" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 32 32">
                                            <path fill="currentColor" d="M13.5 6.5V7h5v-.5a2.5 2.5 0 0 0-5 0m-2 .5v-.5a4.5 4.5 0 1 1 9 0V7H28a1 1 0 1 1 0 2h-1.508L24.6 25.568A5 5 0 0 1 19.63 30h-7.26a5 5 0 0 1-4.97-4.432L5.508 9H4a1 1 0 0 1 0-2zM9.388 25.34a3 3 0 0 0 2.98 2.66h7.263a3 3 0 0 0 2.98-2.66L24.48 9H7.521zM13 12.5a1 1 0 0 1 1 1v10a1 1 0 1 1-2 0v-10a1 1 0 0 1 1-1m7 1a1 1 0 1 0-2 0v10a1 1 0 1 0 2 0z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <!-- Card -->
                        </div>
                        <?php 
                            } else { echo "<p>BG Image Not Found</p>"; }
                        ?>
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