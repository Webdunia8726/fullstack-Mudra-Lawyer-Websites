<?php

include 'includes/db.php';  // Correct the path to 'includes/db.php'

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $paragraph = $_POST['paragraph'];

    // Image upload handling
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a real image
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check !== false) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Insert blog details into database
            $sql = "INSERT INTO blogs (title, image, paragraph) VALUES ('$title', '$image', '$paragraph')";
            if ($conn->query($sql) === TRUE) {
                echo "Blog uploaded successfully!";
                header("Location: dashboard.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
}
?>
s