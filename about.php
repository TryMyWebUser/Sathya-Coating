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
        
        <?php include "temp/header.php"; $hero = Operations::getBGHero($conn); ?>

        <!-- Page Header Start -->
        <div class="page-header parallaxie" style="background-image: url('<?= $hero['img'] ?>');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Page Header Box Start -->
                        <div class="page-header-box">
                            <h1 class="text-anime-style-2" data-cursor="-opaque">About us</h1>
                            <nav class="wow fadeInUp">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">about us</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- Page Header Box End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- About Us Section Start -->
        <?php
            $about = Operations::getAboutUs($conn);
            if (!empty($about)) {
                foreach ($about as $ab) {
        ?>
        <div class="about-us page-about-us">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <!-- About Us Images Start -->
                        <div class="about-us-images">
                            <!-- About Image 1 Start -->
                            <div class="about-img-1">
                                <figure class="image-anime reveal">
                                    <img src="assets/<?= $ab['img1'] ?>" alt="" />
                                </figure>
                            </div>
                            <!-- About Image 1 End -->

                            <!-- About Image 2 Start -->
                            <div class="about-img-2">
                                <figure class="image-anime reveal">
                                    <img src="assets/<?= $ab['img2'] ?>" alt="" />
                                </figure>

                                <!-- Feedback Counter Start -->
                                <div class="experience-counter">
                                    <?php $exp = explode('+', $ab['exp']); ?>
                                    <h3><span class="counter"><?= $exp[0] ?></span>+</h3>
                                    <p><?= $exp[1] ?></p>
                                </div>
                                <!-- Feedback Counter End -->
                            </div>
                            <!-- About Image 2 End -->

                        </div>
                        <!-- About Us Images End -->
                    </div>

                    <div class="col-lg-6">
                        <!-- About Us Content Start -->
                        <div class="about-us-content">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h2 class="text-anime-style-2" data-cursor="-opaque"><?= $ab['title'] ?></h2>
                                <p class="wow fadeInUp" data-wow-delay="0.2s">
                                <?= $ab['dec'] ?>
                                </p>
                            </div>
                            <!-- Section Title End -->

                            <!-- About Us Content Body Start -->
                            <div class="about-us-content-body">
                                <!-- About Content Info Start -->
                                <div class="about-us-content-info">
                                    <!-- About Us Content List Start -->
                                    <div class="about-us-content-list wow fadeInUp" data-wow-delay="0.4s">
                                        <ul>
                                            <?php
                                                $point = explode(',', $ab['points']);
                                                foreach ($point as $value) {
                                            ?>
                                            <li><?= $value ?></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <!-- About Us Content List End -->

                                    <!-- About Us Content Button Start -->
                                    <div class="about-us-content-btn wow fadeInUp" data-wow-delay="0.6s">
                                        <a href="contact.php" class="btn-default">contect now</a>
                                    </div>
                                    <!-- About Us Content Button End -->
                                </div>
                                <!-- About Content Info End -->

                            </div>
                            <!-- About Us Content Body End -->
                        </div>
                        <!-- About Us Content End -->
                    </div>
                </div>
            </div>
        </div>
        <?php } } else { echo "<p>About Content Not Found</p>"; } ?>
        <!-- About Us Section End -->

        <?php include "temp/footer.php" ?>

    </body>

</html>