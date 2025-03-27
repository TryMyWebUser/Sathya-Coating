<?php

include "../libs/load.php";

// Secure delete operation
if (isset($_GET['delete_id'])) {
    $conn = Database::getConnect();
    
    $delete_id = intval($_GET['delete_id']); // Convert to integer to prevent SQL injection
    $qry = $conn->query("SELECT * FROM `ps-category` WHERE `id` = '$delete_id' ")->fetch_array();
    $cate = $qry['category'];
    $q = $conn->query("SELECT * FROM `product-service` WHERE `category` = '$cate' ")->fetch_array();
    $qID = $q['id'];
    $sql = "DELETE FROM `ps-category` WHERE `id` = '$delete_id'";
    $result = $conn->query($sql);
    if ($result) {
        header("Location: viewPS.php");
        header("Location: deletePS.php?delete_id=".$qID);
    } else {
        header("Location: viewPS.php?error=Failed to delete image");
    }
} 

?>