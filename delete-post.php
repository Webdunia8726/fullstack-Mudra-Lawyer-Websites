<?php
// Include the database connection file
include 'db.php';

// Check if the post ID is provided
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Prepare and execute the DELETE query
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $post_id);

    if ($stmt->execute()) {
        // Post successfully deleted, redirect to dashboard
        header("Location: dashboard.php?message=Post+deleted+successfully");
        exit();
    } else {
        echo "Error deleting post: " . $conn->error;
    }
} else {
    echo "No post ID provided!";
}
?>
