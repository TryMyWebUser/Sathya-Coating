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
                            <h1 class="text-anime-style-2" data-cursor="-opaque">Conatct us</h1>
                            <nav class="wow fadeInUp">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">conatct us</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- Page Header Box End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Page Contact Us Start -->
        <div class="page-contact-us">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Contact Us Image Start -->
                        <div class="contact-us-image">
                            <figure class="image-anime reveal">
                                <img src="assets/images/contact-us-image.jpg" alt="" />
                            </figure>
                        </div>
                        <!-- Contact Us Image End -->
                    </div>

                    <div class="col-lg-6">
                        <!-- Contact Us Form Start -->
                        <div class="contact-us-form">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">contact form</h3>
                                <h2 class="text-anime-style-2" data-cursor="-opaque">We would love to hear <span>from you</span></h2>
                            </div>
                            <!-- Section Title End -->

                            <!-- Contact Form Start -->
                            <div class="contact-form">
                                <!-- Contact Form Start -->
                                <form id="contactForm" action="#" method="POST" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="row">
                                        <div class="form-group col-md-6 mb-4">
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Name*" required />
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="form-group col-md-6 mb-4">
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Email Address*" required />
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="form-group col-md-12 mb-4">
                                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Your Phone" required />
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="form-group col-md-12 mb-5">
                                            <textarea name="message" class="form-control" id="message" rows="4" placeholder="Your Message"></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="col-md-12">
                                            <button type="submit" class="btn-default">submit</button>
                                            <div id="msgSubmit" class="h3 hidden"></div>
                                        </div>
                                    </div>
                                </form>
                                <!-- Contact Form End -->
                            </div>
                            <!-- Contact Form End -->
                        </div>
                        <!-- Contact Us Form End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Contact Us End -->

        <!-- Google Map Section Start -->
        <?php $con = Operations::getCContactus($conn); ?>
        <div class="google-map">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Our contact</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">Get in touch with us</h2>
                        </div>
                        <!-- Section Title End -->
                    </div>

                    <div class="col-lg-12">
                        <!-- Google Map IFrame Start -->
                        <div class="google-map-iframe">
                            <?= $con['map'] ?>
                        </div>
                        <!-- Google Map IFrame End -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <!-- Contact Info Box Start -->
                        <div class="contact-info-box">
                            <!-- Conatct Info Item Start -->
                            <div class="contact-info-item wow fadeInUp">
                                <!-- Icon Box Start -->
                                <div class="icon-box">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <!-- Icon Box End -->

                                <!-- Contact Info Content Start -->
                                <div class="contact-info-content">
                                    <h3>phone number</h3>
                                    <?php
                                        $num = explode(',', $con['number']);
                                        foreach ($num as $value) {
                                    ?>
                                    <p><a href="tel:+91<?= $value ?>" style="color: #000;">+91 <?= $value ?></a></p>
                                    <?php } ?>
                                </div>
                                <!-- Contact Info Content End -->
                            </div>
                            <!-- Conatct Info Item End -->

                            <!-- Conatct Info Item Start -->
                            <div class="contact-info-item wow fadeInUp" data-wow-delay="0.2s">
                                <!-- Icon Box Start -->
                                <div class="icon-box">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>
                                <!-- Icon Box End -->

                                <!-- Contact Info Content Start -->
                                <div class="contact-info-content">
                                    <h3>e-mail support</h3>
                                    <?php
                                        $mail = explode(',', $con['email']);
                                        foreach ($mail as $value) {
                                    ?>
                                    <p><a href="mailto:<?= $value ?>" style="color: #000;"><?= $value ?></a></p>
                                    <?php } ?>
                                </div>
                                <!-- Contact Info Content End -->
                            </div>
                            <!-- Conatct Info Item End -->

                            <!-- Conatct Info Item Start -->
                            <div class="contact-info-item wow fadeInUp" data-wow-delay="0.4s">
                                <!-- Icon Box Start -->
                                <div class="icon-box">
                                    <i class="fa-solid fa-house"></i>
                                </div>
                                <!-- Icon Box End -->

                                <!-- Contact Info Content Start -->
                                <div class="contact-info-content">
                                    <h3>Adderss</h3>
                                    <p><?= $con['address'] ?></p>
                                </div>
                                <!-- Contact Info Content End -->
                            </div>
                            <!-- Conatct Info Item End -->
                        </div>
                        <!-- Contact Info Box End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Google Map Section End -->

        <?php include "temp/footer.php" ?>

    </body>

</html>