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
                            <h1 class="text-anime-style-2" data-cursor="-opaque">Turn Key Solution</h1>
                            <nav class="wow fadeInUp">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">turn key solution</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- Page Header Box End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <?php if (isset($_GET['data'])) { ?>
        <!-- Our Project Start -->
        <div class="why-choose-us">
            <div class="container">
                <?php
                    $data = Operations::getFPS($conn);
                    $f = Operations::getProCategory($conn);
                    if (!empty($data)) {
                        foreach ($data as $item) {
                ?>
                <div class="row">
                    
                    <div class="col-lg-6">
                        <!-- Why Choose Images Images Start -->
                        <div class="why-choose-image">
                            <!-- Why Choose Box 1 Start -->
                            <div class="why-choose-img-box-1s">
                                <div class="why-choose-img-1">
                                    <figure class="image-anime reveal">
                                        <?php if (!empty($item['img'])) { ?>
                                        <img src="assets/<?= $item['img'] ?>" alt="" />
                                        <?php } else { ?>
                                        <img src="assets/images/service-1.jpg" alt="" />
                                        <?php } ?>
                                    </figure>
                                </div>
                            </div>
                            <!-- Why Choose Box 1 End -->
                        </div>
                        <!-- Why Choose Images Images End -->
                    </div>
                    
                    <div class="col-lg-6">
                        <!-- Why Choose Content Start -->
                        <div class="why-choose-content">
                            <!-- Section Title Start -->
                            <div class="section-title m-0 p-0">
                                <!--<h3 class="wow fadeInUp m-0">Our Products</h3>-->
                                <h2 class="text-anime-style-2 m-0" data-cursor="-opaque"><?= $item['title'] ?></span></h2>
                            </div>
                            <!-- Section Title End -->

                            <!-- Why Choose Item List Start -->
                            <div class="why-choose-item-list">
                                <!-- Why Choose Item Start -->
                                <div class="why-choose-item wow fadeInUp" data-wow-delay="0.4s">

                                    <!-- Why Choose Item Content Start -->
                                    <div class="about-us-content-list wow fadeInUp" data-wow-delay="0.4s">
                                        <div class="wow fadeInUp m-0" data-wow-delay="0.2s"><?= $item['dec'] ?></div>
                                    </div>
                                    <!-- Why Choose Item Content End -->
                                </div>
                                <!-- Why Choose Item End -->
                                <?php if (!empty($f['file'])) { ?>
                                <!--<div class="btn">-->
                                <!--    <a href="<?= $f['file'] ?>" type="button" download="<?= $f['file'] ?>">-->
                                <!--        <button type="button" class="btn btn-success">-->
                                <!--            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">-->
                                <!--              <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>-->
                                <!--              <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>-->
                                <!--            </svg>-->
                                <!--        </button>-->
                                <!--    </a>-->
                                <!--</div>-->
                                <div class="about-us-content-btn wow fadeInUp" data-wow-delay="0.6s">
                                    <a href="<?= $f['file'] ?>" class="btn-default">read more</a>
                                </div>
                                <?php } ?>
                            </div>
                            <!-- Why Choose Item List End -->
                        </div>
                        <!-- Why Choose Content End -->
                    </div>

                </div>
                
                <?php
                        }
                    } else { echo "<p>Services Not Found</p>"; }
                ?>
            </div>
        </div>
        
        <!-- Our Services Section End -->
        <?php } else { ?>
        <div class="page-testimonials py-5">
            <div class="container">
                <div class="row">
                    <?php
                        $cate = Operations::getCCate($conn);
                        foreach ($cate as $c) {
                            if ($c['page'] === 'service') {
                    ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="testimonial-item p-4 shadow rounded bg-light">
                            <div class="testimonial-content text-center m-0">
                                <a class="nav-link" href="services.php?data=<?= urlencode($c['category']) ?>"><?= $c['category'] ?></a>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php include "temp/footer.php" ?>
        
    </body>

</html>