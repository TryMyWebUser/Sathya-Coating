<?php

include "../libs/load.php";

// Secure delete operation
if (isset($_GET['delete_id'])) {
    $conn = Database::getConnect();
    
    $delete_id = intval($_GET['delete_id']); // Convert to integer to prevent SQL injection
    $qry = $conn->query("SELECT * FROM `cate` where `id` = '$delete_id' ")->fetch_array();
    $cate = $qry['category'];
    $q = $conn->query("SELECT * FROM `product-service` WHERE `cate` = '$cate' ")->fetch_array();
    $cate1 = $qry['category'];
    $q1 = $conn->query("SELECT * FROM `product-service` WHERE `category` = '$cate1' ")->fetch_array();
    $qID = $q1['id'];
    $sql = "DELETE FROM `cate` WHERE `id` = '$delete_id'";
    $result = $conn->query($sql);
    if ($result) {
        header("Location: viewPS.php");
        header("Location: deleteCategory.php?delete_id=".$qID);
        header("Location: deletePS.php?delete_id=".$qID);
    } else {
        header("Location: viewPS.php?error=Failed to delete image");
    }
} 

?>