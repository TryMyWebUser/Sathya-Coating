<!-- Footer Start -->
<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Footer Header Start -->
                <div class="footer-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <!-- Footer Logo Start -->
                            <div class="footer-logo">
                                <img src="assets/images/footer-logo.png" alt="Footer Logo" style="width: 20rem;" />
                            </div>
                            <!-- Footer Logo End -->
                        </div>

                        <div class="col-md-6">
                            <!-- Footer Social Link Start -->
                            <div class="footer-social-links">
                                <div class="footer-social-link-title">
                                    <h3>follow our socials</h3>
                                </div>
                                <?php $social = Operations::getSocials($conn); ?>
                                <ul>
                                    <li>
                                        <a href="<?= $social['facebook'] ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="<?= $social['instagram'] ?>"><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://wa.me/<?= $social['whatsapp'] ?>"><i class="fa-brands fa-whatsapp"></i></a>
                                    </li>
                                    <li>
                                        <a href="<?= $social['youtube'] ?>"><i class="fa-brands fa-youtube"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Footer Social Link End -->
                        </div>
                    </div>
                </div>
                <!-- Footer Header End -->
            </div>

            <div class="col-lg-3 col-md-6">
                <!-- Footer Links Start -->
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <!-- <li><a href="index.php">Home</a></li> -->
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="gallery.php">Gallery</a></li>
                        <li><a href="testimonials.php">Testimonials</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </div>
                <!-- Footer Links End -->
            </div>

            <!-- <div class="col-lg-3 col-md-6">
                <div class="footer-links">
                    <h3>portfolio</h3>
                    <ul>
                        <li><a href="project-single.html">luxury home design</a></li>
                        <li><a href="project-single.html">residential interior design</a></li>
                        <li><a href="project-single.html">commercial space design</a></li>
                        <li><a href="project-single.html">residential interior design</a></li>
                        <li><a href="project-single.html">renovation and restoration design</a></li>
                    </ul>
                </div>
            </div> -->

            <?php $con = Operations::getCContactus($conn); ?>
            <div class="col-lg-3 col-md-6">
                <!-- Footer Contact Box Start -->
                <div class="footer-contact-box footer-links">
                    <h3>contact us</h3>
                    <!-- Footer Contact Item Start -->
                    <div class="footer-contact-item">
                        <div class="icon-box">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="footer-contact-content">
                            <?php
                                $num = explode(',', $con['number']);
                                foreach ($num as $value) {
                            ?>
                            <p><a href="tel:+91<?= $value ?>" style="color: #fff;">+91 <?= $value ?></a></p>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- Footer Contact Item End -->

                    <!-- Footer Contact Item Start -->
                    <div class="footer-contact-item">
                        <div class="icon-box">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="footer-contact-content">
                            <?php
                                $mail = explode(',', $con['email']);
                                foreach ($mail as $value) {
                            ?>
                            <p><a href="mailto:<?= $value ?>" style="color: #fff;"><?= $value ?></a></p>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- Footer Contact Item End -->

                    <!-- Footer Contact Item Start -->
                    <div class="footer-contact-item">
                        <div class="icon-box">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="footer-contact-content">
                            <p><?= $con['address'] ?></p>
                        </div>
                    </div>
                    <!-- Footer Contact Item End -->
                </div>
                <!-- Footer Contact Box End -->
            </div>

            <div class="col-lg-3 col-md-6">
                <!-- Footer Newsletter Form Start -->
                <div class="footer-latest-news footer-links">
                    <h3>Reach Us</h3>

                    <div class="footer-newsletter-form">
                        <?= $con['map'] ?>
                    </div>
                </div>
                <!-- Footer Newsletter Form End -->
            </div>
        </div>

        <!-- Footer Copyright Section Start -->
        <div class="footer-copyright">
            <div class="row">
                <div class="col-md-12">
                    <!-- Footer Copyright Start -->
                    <div class="footer-copyright-text">
                        <p>Designed and Developed By <a href="https://trymywebsites/"> Trymywebsites </a></p>
                    </div>
                    <!-- Footer Copyright End -->
                </div>
            </div>
        </div>
        <!-- Footer Copyright Section End -->
    </div>
</footer>
<!-- Footer End -->

<!-- Jquery Library File -->
<script src="assets/js/jquery-3.7.1.min.js"></script>
<!-- Bootstrap js file -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Validator js file -->
<script src="assets/js/validator.min.js"></script>
<!-- SlickNav js file -->
<script src="assets/js/jquery.slicknav.js"></script>
<!-- Swiper js file -->
<script src="assets/js/swiper-bundle.min.js"></script>
<!-- Counter js file -->
<script src="assets/js/jquery.waypoints.min.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<!-- Isotop js file -->
<script src="assets/js/isotope.min.js"></script>
<!-- Magnific js file -->
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<!-- SmoothScroll -->
<script src="assets/js/SmoothScroll.js"></script>
<!-- Parallax js -->
<script src="assets/js/parallaxie.js"></script>
<!-- MagicCursor js file -->
<script src="assets/js/gsap.min.js"></script>
<script src="assets/js/magiccursor.js"></script>
<!-- Text Effect js file -->
<script src="assets/js/SplitText.js"></script>
<script src="assets/js/ScrollTrigger.min.js"></script>
<!-- YTPlayer js File -->
<script src="assets/js/jquery.mb.YTPlayer.min.js"></script>
<!-- Wow js file -->
<script src="assets/js/wow.min.js"></script>
<!-- Main Custom js file -->
<script src="assets/js/function.js"></script>