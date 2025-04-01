<?php

include "../libs/load.php";

// Secure delete operation
if (isset($_GET['delete_id'])) {
    $conn = Database::getConnect();
    
    $delete_id = intval($_GET['delete_id']); // Convert to integer to prevent SQL injection
    $qry = $conn->query("SELECT * FROM `home-about` where `id` = '$delete_id' ")->fetch_array();
    $sql = "DELETE FROM `home-about` WHERE `id` = '$delete_id'";
    $result = $conn->query($sql);
    if ($result) {
        if(!empty($qry['img1']) && !empty($qry['img2'])){
            if(is_file($qry['img1']) && is_file($qry['img1'])) {
                unlink($qry['img1']);
                unlink($qry['img2']);
                header("Location: viewAbout.php");
            }
        }
    } else {
        header("Location: viewAbout.php?error=Failed to delete image");
    }
} 

?>