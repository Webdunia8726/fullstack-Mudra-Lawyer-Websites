<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get blog title and paragraph
    $title = $_POST['title'];
    $paragraph = $_POST['paragraph'];

    // Get the uploaded image
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);

    // Move the uploaded file to the uploads directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        // Insert the new blog into the database
        $sql = "INSERT INTO blogs (title, paragraph, image) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $title, $paragraph, $image);

        if ($stmt->execute()) {
            echo "<script>alert('Blog added successfully!'); window.location.href='dashboard.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Blog</title>
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- TinyMCE Script with Your API Key -->
    <script src="https://cdn.tiny.cloud/1/fpg2gjvpoyjcr1uqteuetuw9xtxhrn3dtgn07yfozkyia57a/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
    tinymce.init({
        selector: '#paragraph',  // Target the textarea for blog content
        height: 400,             // Set editor height
        plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount',  // Add desired plugins
        toolbar: 'undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | blockquote subscript superscript | removeformat | image link media | code preview fullscreen',  // Toolbar options
        menubar: 'file edit view insert format tools table help',  // Show the menubar
        content_css: 'default',   // Use the default content style
        branding: false,          // Remove TinyMCE branding
        style_formats: [
            { title: 'Headings', items: [
                { title: 'Heading 1', block: 'h1' },
                { title: 'Heading 2', block: 'h2' },
                { title: 'Heading 3', block: 'h3' },
                { title: 'Heading 4', block: 'h4' },
                { title: 'Heading 5', block: 'h5' },
                { title: 'Heading 6', block: 'h6' }
            ]},
            { title: 'Inline', items: [
                { title: 'Bold', inline: 'strong' },
                { title: 'Italic', inline: 'em' },
                { title: 'Underline', inline: 'u' },
                { title: 'Strikethrough', inline: 'strike' },
                { title: 'Superscript', inline: 'sup' },
                { title: 'Subscript', inline: 'sub' }
            ]},
            { title: 'Blocks', items: [
                { title: 'Paragraph', block: 'p' },
                { title: 'Blockquote', block: 'blockquote' },
                { title: 'Preformatted', block: 'pre' }
            ]},
            { title: 'Alignment', items: [
                { title: 'Align Left', block: 'div', classes: 'text-left' },
                { title: 'Align Center', block: 'div', classes: 'text-center' },
                { title: 'Align Right', block: 'div', classes: 'text-right' }
            ]}
        ]
    });
    </script>

    <style>
        /* Add Blog Page Styling */
        .add-blog-container {
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
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="add-blog-container">
        <h1>Add New Blog</h1>

        <form action="add-blog.php" method="POST" enctype="multipart/form-data">
            <label for="title">Blog Title:</label><br>
            <input type="text" id="title" name="title" required><br><br>

            <label for="paragraph">Blog Content:</label><br>
            <textarea id="paragraph" name="paragraph" rows="10"></textarea><br><br>

            <label for="image">Upload Image:</label><br>
            <input type="file" id="image" name="image" required><br><br>

            <button type="submit" class="btn">Add Blog</button>
        </form>
    </div>
</body>
</html>
