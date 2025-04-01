<?php

include "../libs/load.php";

// Secure delete operation
if (isset($_GET['delete_id'])) {
    $conn = Database::getConnect();
    
    $delete_id = intval($_GET['delete_id']); // Convert to integer to prevent SQL injection

    // Get review details to check image path
    $qry = $conn->query("SELECT * FROM `review` WHERE `id` = '$delete_id'")->fetch_assoc();

    if ($qry) {
        $imagePath = $qry['image']; // Correct field name is 'image'

        // Delete review record
        $sql = "DELETE FROM `review` WHERE `id` = '$delete_id'";
        $result = $conn->query($sql);

        if ($result) {
            // Check if the image exists and is not the default
            if (!empty($imagePath) && $imagePath !== "assets/images/user.png") {
                // Check if the file exists before attempting to delete
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Delete the file
                }
            }
            // Redirect after successful deletion
            header("Location: viewReviews.php");
            exit;
        } else {
            header("Location: viewReviews.php?error=Failed to delete review.");
            exit;
        }
    } else {
        header("Location: viewReviews.php?error=Review not found.");
        exit;
    }
} else {
    header("Location: viewReviews.php?error=Invalid request.");
    exit;
}

?>