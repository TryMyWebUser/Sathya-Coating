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
                            <h1 class="text-anime-style-2" data-cursor="-opaque">Services</h1>
                            <nav class="wow fadeInUp">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">services</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- Page Header Box End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Our Services Section Start -->
        <div class="page-services">
            <div class="container">
                <div class="row">
                    <?php
                        $data = Operations::getFPS($conn);
                        if (!empty($data)) {
                            foreach ($data as $item) {
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <!-- Service Item Start -->
                        <div class="service-item wow fadeInUp">
                            <!-- Service Image Start -->
                            <div class="service-image">
                                <a href="#" data-cursor-text="View">
                                    <figure class="image-anime">
                                        <?php if (!empty($item['img'])) { ?>
                                        <img src="assets/<?= $item['img'] ?>" alt="" />
                                        <?php } else { ?>
                                        <img src="assets/images/service-1.jpg" alt="" />
                                        <?php } ?>
                                    </figure>
                                </a>
                            </div>
                            <!-- Service Image End -->

                            <!-- Service Button Start -->
                            <?php if (!empty($item['file'])) { ?>
                            <div class="service-btn">
                                <a href="<?= $item['file'] ?>" type="button" download="<?= $item['file'] ?>">
                                    <button type="button">
                                        <img src="assets/images/arrow-white.svg" alt="" />
                                    </button>
                                </a>
                            </div>
                            <?php } ?>
                            <!-- Service Button End -->

                            <!-- Service Content Start -->
                            <div class="service-content">
                                <h3><a href="#"><?= $item['title'] ?></a></h3>
                                <p><?= $item['dec'] ?></p>
                            </div>
                            <!-- Service Content End -->
                        </div>
                        <!-- Service Item End -->
                    </div>
                    <?php
                            }
                        } else { echo "<p>Services Not Found</p>"; }
                    ?>
                </div>
            </div>
        </div>
        <!-- Our Services Section End -->

        <?php include "temp/footer.php" ?>
        
    </body>

</html>