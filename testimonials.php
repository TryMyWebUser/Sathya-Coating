<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="Trymywebsites" />
        
        <?php include "temp/head.php" ?>

        <style>
            .testimonial-item {
                transition: all 0.3s ease-in-out;
            }

            .testimonial-item:hover {
                transform: translateY(-5px);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }

            .testimonial-image img {
                border: 3px solid #007bff;
            }
        </style>
        
    </head>
    <body>
        
        <?php include "temp/header.php" ?>

        <!-- Page Header Start -->
        <div class="page-header parallaxie">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Page Header Box Start -->
                        <div class="page-header-box">
                            <h1 class="text-anime-style-2" data-cursor="-opaque">Our Testimonials</h1>
                            <nav class="wow fadeInUp">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">our Testimonials</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- Page Header Box End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Our Project Start -->
        <div class="page-testimonials py-5">
            <div class="container">
                <div class="row">
                    <?php
                        $test = Operations::getReviews($conn);
                        if (!empty($test)) {
                            foreach ($test as $t) {
                    ?>
                    <!-- Testimonial Item Start -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="testimonial-item p-4 shadow rounded bg-light">
                            <div class="testimonial-image text-center mb-3">
                                <?php if ($t['image'] === 'assets/images/user.png') { ?>
                                    <img src="Dashboard/<?= $t['image'] ?>" alt="User 2" class="rounded-circle" width="80" height="80">
                                <?php } else {?>
                                <img src="assets/<?= $t['image'] ?>" alt="User 2" class="rounded-circle" width="80" height="80">
                                <?php } ?>
                            </div>
                            <div class="testimonial-content text-center">
                                <p class="mb-3"><?= $t['review'] ?></p>
                                <h5 class="mb-1"><?= $t['name'] ?></h5>
                                <small class="text-muted">
                                    <?php for ($i = 0; $i < $t['rating']; $i++) { ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" style="color: #ffc107;" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                        </svg>
                                    <?php } ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial Item End -->
                    <?php } } else { echo "<p>Testimonials Not Found</p>"; } ?>
                </div>
            </div>
        </div>
        <!-- Our Project End -->

        <?php include "temp/footer.php" ?>

    </body>

</html>