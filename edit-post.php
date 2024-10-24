<?php
// Include the database connection file
include 'db.php';

// Get the post ID from the URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Fetch the post details from the database
    $sql = "SELECT * FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    // Check if the post exists
    if (!$post) {
        echo "Post not found!";
        exit();
    }
} else {
    echo "No post ID provided!";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve the form data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $tags = $_POST['tags'];
    $meta_description = $_POST['meta_description'];
    $slug = $_POST['slug'];

    // Update the post in the database
    $sql = "UPDATE posts SET title = ?, content = ?, category_id = ?, tags = ?, meta_description = ?, slug = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssisssi', $title, $content, $category_id, $tags, $meta_description, $slug, $post_id);

    if ($stmt->execute()) {
        echo "Post updated successfully!";
        // Redirect to the dashboard or post listing page
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating post: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS file for styling -->
</head>
<body>

<h2>Edit Post</h2>

<form action="" method="POST">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($post['title']); ?>" required><br><br>

    <label for="content">Content:</label>
    <textarea name="content" id="content" rows="10" required><?php echo htmlspecialchars($post['content']); ?></textarea><br><br>

    <label for="category_id">Category:</label>
    <input type="text" name="category_id" id="category_id" value="<?php echo htmlspecialchars($post['category_id']); ?>"><br><br>

    <label for="tags">Tags:</label>
    <input type="text" name="tags" id="tags" value="<?php echo htmlspecialchars($post['tags']); ?>"><br><br>

    <label for="meta_description">Meta Description:</label>
    <textarea name="meta_description" id="meta_description" rows="3"><?php echo htmlspecialchars($post['meta_description']); ?></textarea><br><br>

    <label for="slug">Slug (URL):</label>
    <input type="text" name="slug" id="slug" value="<?php echo htmlspecialchars($post['slug']); ?>" required><br><br>

    <button type="submit">Update Post</button>
</form>

</body>
</html>
