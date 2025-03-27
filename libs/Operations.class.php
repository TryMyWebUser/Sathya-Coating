<?php

class Operations
{

    public static function getPageCate()
    {
        $conn = Database::getConnect();
        $sql = "SELECT * FROM `cate` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getCategory()
    {
        $category = $_GET['data'];
        $conn = Database::getConnect();
        $sql = "SELECT * FROM `ps-category` WHERE `cate` = '$category'";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getProCategory($conn)
    {
        $sql = "SELECT * FROM `ps-category` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getProducts()
    {
        $conn = Database::getConnect();
        $sql = "SELECT * FROM `product-service` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getCateChecker($conn)
    {
        $sql = "SELECT * FROM `cate` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getProductChecker($conn)
    {
        $sql = "SELECT * FROM `product-service` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }

    public static function getProductPage($page, $conn)
    {
        $sql = "SELECT * FROM `product-service` WHERE `category` = '$page'";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getPS()
    {
        $getData = $_GET['data'];
        $conn = Database::getConnect();
        $sql = "SELECT * FROM `product-service` WHERE `category` = '$getData'";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    
    public static function getCate($conn)
    {
        $getID = $_GET['edit_id'];
        $sql = "SELECT * FROM `ps-category` WHERE `id` = '$getID'";
        $result = $conn->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }
    public static function getProduct($conn)
    {
        $getID = $_GET['edit_id'];
        $sql = "SELECT * FROM `product-service` WHERE `id` = '$getID'";
        $result = $conn->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }
    public static function getEditCate($conn)
    {
        $getID = $_GET['edit_id'];
        $sql = "SELECT * FROM `cate` WHERE `id` = '$getID'";
        $result = $conn->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }
    public static function getEditCategory($conn)
    {
        $getID = $_GET['edit_id'];
        $sql = "SELECT * FROM `ps-category` WHERE `id` = '$getID'";
        $result = $conn->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }

    public static function getGallery($conn)
    {
        $sql = "SELECT * FROM `gallery` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }

    public static function getContact($conn)
    {
        $sql = "SELECT * FROM `contact` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getContactus($conn)
    {
        $getID = $_GET['edit_id'];
        $sql = "SELECT * FROM `contact` WHERE `id` = '$getID'";
        $result = $conn->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }
    public static function getSocial($conn)
    {
        $sql = "SELECT * FROM `social` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getMedia($conn)
    {
        $getID = $_GET['edit_id'];
        $sql = "SELECT * FROM `social` WHERE `id` = '$getID'";
        $result = $conn->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }
    
    public static function getReviews($conn)
    {
        $sql = "SELECT * FROM `review` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getReview($conn)
    {
        $getID = $_GET['edit_id'];
        $sql = "SELECT * FROM `review` WHERE `id` = '$getID'";
        $result = $conn->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }

    public static function getAboutUs($conn)
    {
        $sql = "SELECT * FROM `aboutus` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getAbout($conn)
    {
        $getID = $_GET['edit_id'];
        $sql = "SELECT * FROM `aboutus` WHERE `id` = '$getID'";
        $result = $conn->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }

    public static function getHomeHeros($conn)
    {
        $sql = "SELECT * FROM `home-hero` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getHomeHero($conn)
    {
        $getID = $_GET['edit_id'];
        $sql = "SELECT * FROM `home-hero` WHERE `id` = '$getID'";
        $result = $conn->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }
    public static function getHomeAboutUs($conn)
    {
        $sql = "SELECT * FROM `home-about` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getHomeAbout($conn)
    {
        $getID = $_GET['edit_id'];
        $sql = "SELECT * FROM `home-about` WHERE `id` = '$getID'";
        $result = $conn->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }
    public static function getHomeFeateres($conn)
    {
        $sql = "SELECT * FROM `home-feateres` ORDER BY `created_at` ASC";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }
    public static function getHomeFeatere($conn)
    {
        $getID = $_GET['edit_id'];
        $sql = "SELECT * FROM `home-feateres` WHERE `id` = '$getID'";
        $result = $conn->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }
}

?>