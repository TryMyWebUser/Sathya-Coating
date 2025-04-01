<?php

include "../libs/load.php";

// Secure delete operation
if (isset($_GET['delete_id'])) {
    $conn = Database::getConnect();

    $delete_id = intval($_GET['delete_id']); // Convert to integer to prevent SQL injection

    // Check if category exists
    $qry = $conn->query("SELECT * FROM `ps-category` WHERE `id` = '$delete_id' ")->fetch_array();
    if (!$qry) {
        header("Location: viewPS.php?error=Category not found");
        exit;
    }

    $cate = $qry['category'];

    // Check if there is a related product/service
    $q = $conn->query("SELECT * FROM `product-service` WHERE `category` = '$cate' ")->fetch_array();
    $qID = $q ? $q['id'] : null;

    // Delete category
    $sql = "DELETE FROM `ps-category` WHERE `id` = '$delete_id'";
    $result = $conn->query($sql);

    if ($result) {
        // If a related product/service exists, delete it
        if ($qID) {
            header("Location: deletePS.php?delete_id=" . $qID);
            exit;
        } else {
            header("Location: viewPS.php?success=Category deleted successfully");
            exit;
        }
    } else {
        header("Location: viewPS.php?error=Failed to delete category");
        exit;
    }
}

?>