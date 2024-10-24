<?php
include 'includes/db.php';

// Check if the blog ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the blog from the database
    $sql = "DELETE FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: dashboard.php");
}
?>
