<?php include "libs/load.php" ?>

<!-- Preloader Start -->
<div class="preloader">
    <div class="loading-container">
        <div class="loading"></div>
        <div id="loading-icon"><img src="assets/logo.png" alt="Preloader" /></div>
    </div>
</div>
<!-- Preloader End -->

<!-- Header Start -->
<header class="main-header">
    <div class="header-sticky">
        <nav class="container">
            <div class="navbar navbar-expand-lg">
                <!-- Logo Start -->
                <a class="navbar-brand" href="index.php">
                    <img src="assets/sathya_logo.png" class="me-2" style="width: 18rem;" alt="Logo" />
                </a>
                <!-- Logo End -->

                <!-- Main Menu Start -->
                <div class="collapse navbar-collapse main-menu">
                    <div class="nav-menu-wrapper">
                        <ul class="navbar-nav mr-auto" id="menu">
                            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                            <li class="nav-item submenu">
                                <a class="nav-link" href="services.php" onclick="window.location.href='services.php'; return false;">Turn Key Solution</a>
                                <ul>
                                    <?php
                                        $conn = Database::getConnect();
                                        $cate = Operations::getCCate($conn);
                                        foreach ($cate as $c) {
                                            if ($c['page'] === 'service') {
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="services.php?data=<?= urlencode($c['category']) ?>"><?= $c['category'] ?></a>
                                    </li>
                                    <?php } } ?>
                                </ul>
                            </li>
                            <li class="nav-item submenu">
                                <a class="nav-link" href="projects.php" onclick="window.location.href='projects.php'; return false;">Products</a>
                                <ul>
                                    <?php
                                        $cate = Operations::getCCate($conn);
                                        foreach ($cate as $c) {
                                            if ($c['page'] === 'product') {
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="projects.php?data=<?= urlencode($c['category']) ?>"><?= $c['category'] ?></a>
                                    </li>
                                    <?php } } ?>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                            <li class="nav-item"><a class="nav-link" href="testimonials.php">Testimonials</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                        </ul>
                    </div>
                    <!-- Header Btn Start -->
                    <div class="header-btn d-inline-flex">
                        <a href="https://wa.me/+919994924939" class="btn-default">Get Quote</a>
                    </div>
                    <!-- Header Btn End -->
                </div>
                <!-- Main Menu End -->
                <div class="navbar-toggle"></div>
            </div>
        </nav>
        <div class="responsive-menu"></div>
    </div>
</header>
<!-- Header End -->