<?php

include "../libs/load.php";

// Secure delete operation
if (isset($_GET['delete_id'])) {
    $conn = Database::getConnect();

    $delete_id = intval($_GET['delete_id']); // Convert to integer to prevent SQL injection

    // Check if the category exists
    $qry = $conn->query("SELECT * FROM `cate` WHERE `id` = '$delete_id' ")->fetch_array();
    if (!$qry) {
        header("Location: viewPS.php?error=Category not found.");
        exit;
    }

    $cate = $qry['category'];

    // Check if any products or services are linked to this category
    $q = $conn->query("SELECT * FROM `product-service` WHERE `category` = '$cate' ")->fetch_array();
    $qID = $q ? $q['id'] : null;

    // Delete the category
    $sql = "DELETE FROM `cate` WHERE `id` = '$delete_id'";
    $result = $conn->query($sql);

    if ($result) {
        // If related products/services exist, delete them
        if ($qID) {
            header("Location: deletePS.php?delete_id=" . $qID);
        }
        header("Location: viewPS.php?success=Category deleted successfully.");
    } else {
        header("Location: viewPS.php?error=Failed to delete category.");
        exit;
    }
}

?>