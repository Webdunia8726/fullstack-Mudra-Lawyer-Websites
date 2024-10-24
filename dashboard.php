<?php
session_start();
include 'includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Fetch all blogs from the database
$sql = "SELECT id, title, paragraph, image FROM blogs";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .dashboard-container {
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

        .btn {
            padding: 8px 15px;
            margin-right: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .blog-table {
            width: 100%;
            border-collapse: collapse;
        }

        .blog-table th, .blog-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .blog-table th {
            background-color: #f8f8f8;
        }

        .blog-table img {
            border-radius: 5px;
        }

        .edit {
            background-color: #28a745;
        }

        .delete {
            background-color: #dc3545;
        }

        .view {
            background-color: #17a2b8;
        }

        .edit:hover {
            background-color: #218838;
        }

        .delete:hover {
            background-color: #c82333;
        }

        .view:hover {
            background-color: #138496;
        }

        .logout-btn {
            background-color: #dc3545; /* Bootstrap's danger color */
            float: right; /* Align to the right */
            margin-bottom: 20px;
        }

        .logout-btn:hover {
            background-color: #c82333; /* Darker red on hover */
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Blog Dashboard</h1>

        <a href="add-blog.php" class="btn">Add New Blog</a>
        <a href="logout.php" class="btn logout-btn">Logout</a> <!-- Logout Button -->

        <table class="blog-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo substr($row['paragraph'], 0, 40) . '...'; ?></td>
                    <td><img src="uploads/<?php echo $row['image']; ?>" width="80"></td>
                    <td>
                        <a href="edit-blog.php?id=<?php echo $row['id']; ?>" class="btn edit">Edit</a>
                        <a href="delete-blog.php?id=<?php echo $row['id']; ?>" class="btn delete" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</a>
                        <a href="blog-details.php?id=<?php echo $row['id']; ?>" class="btn view">View</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
