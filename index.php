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

        <!-- Hero Section Start -->
        <div class="hero hero-slider-layout">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php
                        $hero = Operations::getHomeHeros($conn);
                        if (!empty($hero)) {
                            foreach ($hero as $h) {
                    ?>
                    <!-- Hero Slide Start -->
                    <div class="swiper-slide">
                        <div class="hero-slide">
                            <!-- Slider Image Start -->
                            <div class="hero-slider-image">
                                <img src="assets/<?= $h['img'] ?>" alt="not found">
                            </div>
                            <!-- Slider Image End -->

                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-lg-10">
                                        <!-- Hero Content Start -->
                                        <div class="hero-content">
                                            <!-- Section Title Start -->
                                            <!--<div class="section-title">-->
                                                <div class="wow fadeInUp"><?= $h['header'] ?></div>
                                                <div class="text-anime-style-2" data-cursor="-opaque"><?= $h['title'] ?></div>
                                                <div class="wow fadeInUp" data-wow-delay="0.2s"><?= $h['dec'] ?></div>
                                            <!--</div>-->
                                            <!-- Section Title End -->
                    
                                            <!-- Hero Button Start -->
                                            <div class="hero-btn wow fadeInUp" data-wow-delay="0.4s">
                                                <a href="projects.php" class="btn-default"><?= $h['button_text1'] ?></a>
                                                <a href="services.php" class="btn-default btn-highlighted"><?= $h['button_text2'] ?></a>
                                            </div>
                                            <!-- Hero Button End -->
                                        </div>
                                        <!-- Hero Content End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Hero Slide End -->
                    <?php } } ?>
                </div>
                <div class="hero-pagination"></div>
            </div>        
        </div>
        <!-- Hero Section End -->

        <!-- About Us Section Start -->
        <?php
            $about = Operations::getHomeAboutUs($conn);
            if (!empty($about)) {
                foreach ($about as $ab) {
        ?>
        <div class="about-us">
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
                                <!--<h3 class="wow fadeInUp">About US</h3>-->
                                <h2 class="text-anime-style-2" data-cursor="-opaque"><?= $ab['title'] ?></span></h2>
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
                                        <a href="about.php" class="btn-default">Read More</a>
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

        <!-- Why Choose Us Section Start -->
        <?php
            $fea = Operations::getHomeFeateres($conn);
            if (!empty($fea)) {
                foreach ($fea as $f) {
        ?>
        <div class="why-choose-us">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <!-- Why Choose Content Start -->
                        <div class="why-choose-content">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <!--<h3 class="wow fadeInUp">Our Features</h3>-->
                                <h2 class="text-anime-style-2" data-cursor="-opaque"><?= $f['title'] ?></span></h2>
                                <!--<p class="wow fadeInUp" data-wow-delay="0.2s">< ?= $f['dec'] ?></p>-->
                            </div>
                            <!-- Section Title End -->

                            <!-- Why Choose Item List Start -->
                            <div class="why-choose-item-list">
                                <!-- Why Choose Item Start -->
                                <div class="why-choose-item wow fadeInUp" data-wow-delay="0.4s">

                                    <!-- Why Choose Item Content Start -->
                                    <div class="about-us-content-list wow fadeInUp" data-wow-delay="0.4s">
                                        <ul>
                                            <?php
                                                $point = explode(',', $f['points']);
                                                foreach ($point as $value) {
                                            ?>
                                            <li><?= $value ?></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <!-- Why Choose Item Content End -->
                                </div>
                                <!-- Why Choose Item End -->
                            </div>
                            <!-- Why Choose Item List End -->
                        </div>
                        <!-- Why Choose Content End -->
                    </div>

                    <div class="col-lg-6">
                        <!-- Why Choose Images Images Start -->
                        <div class="why-choose-image">
                            <!-- Why Choose Box 1 Start -->
                            <div class="why-choose-img-box-1s">
                                <div class="why-choose-img-1">
                                    <figure class="image-anime reveal">
                                        <img src="assets/<?= $f['img'] ?>" alt="" />
                                    </figure>
                                </div>
                            </div>
                            <!-- Why Choose Box 1 End -->
                        </div>
                        <!-- Why Choose Images Images End -->
                    </div>
                </div>
            </div>
        </div>
        <?php } } else { echo "<p>Features Not Found</p>"; } ?>
        <!-- Why Choose Us Section End -->

        <?php include "temp/footer.php" ?>

    </body>

</html>