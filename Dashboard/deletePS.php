<?php

include "../libs/load.php";

// Secure delete operation
if (isset($_GET['delete_id'])) {
    $conn = Database::getConnect();
    
    $delete_id = intval($_GET['delete_id']); // Convert to integer to prevent SQL injection
    $qry = $conn->query("SELECT * FROM `product-service` where `id` = '$delete_id' ")->fetch_array();
    $sql = "DELETE FROM `product-service` WHERE `id` = '$delete_id'";
    $result = $conn->query($sql);
    if ($result) {
        if(!empty($qry['img']) && !empty($qry['file'])){
            if(is_file($qry['img']) && is_file($qry['file'])) {
                unlink($qry['img']);
                unlink($qry['file']);
                header("Location: viewPS.php");
            } else {
                header("Location: viewPS.php");
            }
        } else {
            header("Location: viewPS.php");
        }
    } else {
        header("Location: viewPS.php?error=Failed to delete image");
    }
} 

?>