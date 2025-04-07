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
                            <h1 class="text-anime-style-2" data-cursor="-opaque">Our products</h1>
                            <nav class="wow fadeInUp">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">our products</li>
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
                            </div>
                            <!-- Why Choose Item List End -->
                        </div>
                        <!-- Why Choose Content End -->
                    </div>

                </div>
                
                <?php
                        }
                    } else { echo "<p>Products Not Found</p>"; }
                ?>
                    
            </div>
        </div>
        
        <!-- Our Project End -->
        <?php } else { ?>
        <div class="page-testimonials py-5">
            <div class="container">
                <div class="row">
                    <?php
                        $cate = Operations::getCCate($conn);
                        foreach ($cate as $c) {
                            if ($c['page'] === 'product') {
                    ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="testimonial-item p-4 shadow rounded bg-light">
                            <div class="testimonial-content text-center m-0">
                                <a class="nav-link" href="projects.php?data=<?= urlencode($c['category']) ?>"><?= $c['category'] ?></a>
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