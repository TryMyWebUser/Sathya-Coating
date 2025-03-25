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

                    <!-- Testimonial Item Start -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="testimonial-item p-4 shadow rounded bg-light">
                            <!-- Testimonial Image Start -->
                            <div class="testimonial-image text-center mb-3">
                                <img src="assets/images/team-1.jpg" alt="User 1" class="rounded-circle" width="80" height="80">
                            </div>
                            <!-- Testimonial Image End -->

                            <!-- Testimonial Content Start -->
                            <div class="testimonial-content text-center">
                                <p class="mb-3">"Sathya coatings provided us with high-performance formulations that exceeded our expectations!"</p>
                                <h5 class="mb-1">John Doe</h5>
                                <small class="text-muted">CEO, ABC Industries</small>
                            </div>
                            <!-- Testimonial Content End -->
                        </div>
                    </div>
                    <!-- Testimonial Item End -->

                    <!-- Testimonial Item Start -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="testimonial-item p-4 shadow rounded bg-light">
                            <div class="testimonial-image text-center mb-3">
                                <img src="assets/images/team-2.jpg" alt="User 2" class="rounded-circle" width="80" height="80">
                            </div>
                            <div class="testimonial-content text-center">
                                <p class="mb-3">"Their customised solutions helped us enhance the durability of our products effectively."</p>
                                <h5 class="mb-1">Jane Smith</h5>
                                <small class="text-muted">Project Manager, XYZ Corp</small>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial Item End -->

                    <!-- Testimonial Item Start -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="testimonial-item p-4 shadow rounded bg-light">
                            <div class="testimonial-image text-center mb-3">
                                <img src="assets/images/team-3.jpg" alt="User 3" class="rounded-circle" width="80" height="80">
                            </div>
                            <div class="testimonial-content text-center">
                                <p class="mb-3">"Excellent customer service and superior formulations. Highly recommended!"</p>
                                <h5 class="mb-1">Michael Lee</h5>
                                <small class="text-muted">Director, LMN Enterprises</small>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial Item End -->

                </div>
            </div>
        </div>
        <!-- Our Project End -->

        <?php include "temp/footer.php" ?>

    </body>

</html>