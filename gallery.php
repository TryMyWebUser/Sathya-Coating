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
                            <h1 class="text-anime-style-2" data-cursor="-opaque">Image gallery</h1>
                            <nav class="wow fadeInUp">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">image gallery</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- Page Header Box End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Photo Gallery Section Start -->
        <div class="page-gallery">
            <div class="container">
                <!-- gallery section start -->
                <div class="row gallery-items page-gallery-box">
                    <?php
                        $gallery = Operations::getGallery($conn);
                        if (!empty($gallery)) {
                            foreach ($gallery as $g) {
                    ?>
                    <div class="col-lg-4 col-6">
                        <!-- image gallery start -->
                        <div class="photo-gallery wow fadeInUp" data-cursor-text="View">
                            <a href="assets/<?= $g['img'] ?>">
                                <figure class="image-anime">
                                    <img src="assets/<?= $g['img'] ?>" alt="" />
                                </figure>
                            </a>
                        </div>
                        <!-- image gallery end -->
                    </div>
                    <?php } } else { echo "<p>Gallery Image is Not Found</p>"; } ?>
                </div>
                <!-- gallery section end -->
            </div>
        </div>
        <!-- Photo Gallery Section End -->

        <?php include "temp/footer.php" ?>

    </body>

</html>