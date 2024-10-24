<?php
include 'includes/db.php';

// Check if the blog ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch blog details from the database
    $sql = "SELECT title, paragraph, image FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($title, $paragraph, $image);
    $stmt->fetch();
    $stmt->close();
}

// Update blog logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $paragraph = $_POST['paragraph'];
    $image = $_FILES['image']['name'];

    if ($image) {
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
    } else {
        $image = $_POST['existing_image'];
    }

    // Update blog in the database
    $sql = "UPDATE blogs SET title = ?, paragraph = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $paragraph, $image, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
<style>
      /* Add Blog Page Styling */
      body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .edit-blog-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="text"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .image-preview {
            margin-top: 10px;
        }

        .image-preview img {
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100px;
            height: auto;
        }
    </style>
</style>
    <script src="https://cdn.tiny.cloud/1/fpg2gjvpoyjcr1uqteuetuw9xtxhrn3dtgn07yfozkyia57a/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            toolbar: 'undo redo | formatselect | bold italic backcolor | \
                      alignleft aligncenter alignright alignjustify | \
                      bullist numlist outdent indent | removeformat | help',
            height: 400,
            menubar: false,
        });
    </script>
</head>
<body>
    <h1>Edit Blog</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Blog Title:</label><br>
        <input type="text" name="title" value="<?php echo $title; ?>" required><br><br>

        <label for="paragraph">Blog Content:</label><br>
        <textarea name="paragraph" required><?php echo $paragraph; ?></textarea><br><br>

        <label for="image">Upload Image:</label><br>
        <input type="file" name="image"><br>
        <input type="hidden" name="existing_image" value="<?php echo $image; ?>">
        <img src="uploads/<?php echo $image; ?>" width="100"><br><br>

        <button type="submit">Update Blog</button>
    </form>
</body>
</html>
