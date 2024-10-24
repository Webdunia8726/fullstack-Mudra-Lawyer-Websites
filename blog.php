<?php
include 'includes/db.php'; // Include database connection

// Fetch blogs from the database
$sql = "SELECT id, title, image, paragraph FROM blogs ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog List</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<style>
    /* Global Styles */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        margin-top: 30px;
        font-size: 40px !important;
        color: #333;
        margin-bottom: 30px;
    }

    /* Blog Container */
    .blog-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Blog Card */
    .blog-card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    
    }

    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    /* Blog Card Image */
    .blog-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-bottom: 5px solid #007bff;
    }

    /* Blog Card Content */
    .blog-card h2 {
        font-size: 1.2em;
        margin: 15px 15px 5px;
        color: #333;
    }

    .blog-card p {
        font-size: 1em;
        color: #666;
        margin: 0 15px 20px;
    }

    .read-more {
        display: block;
        padding: 12px;
        background-color: #007bff;
        color: white;
        text-align: center;
        font-weight: bold;
        text-decoration: none;
        border-radius: 0 0 15px 15px;
        transition: background-color 0.3s ease;
        font-size: 1em;
    }

    .read-more:hover {
        background-color: #0056b3;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .blog-card img {
            height: 180px;
        }

        .blog-card h2 {
            font-size: 1.5em;
        }

        .read-more {
            font-size: 0.9em;
            padding: 10px;
        }
    }

    @media (max-width: 480px) {
        .blog-card img {
            height: 150px;
        }

        .blog-card h2 {
            font-size: 1.3em;
        }

        .read-more {
            font-size: 0.85em;
            padding: 8px;
        }
    }
    /* Blog card styling */
.blog-card {
    background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%); /* Subtle gradient background */
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); /* Slightly larger shadow for depth */
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 20px; /* Add padding for content */
}

/* Hover effect */
.blog-card:hover {
    transform: translateY(-10px); /* Move up on hover */
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2); /* Increase shadow on hover */
}

/* Blog image styling inside the card */
.blog-card img {
    width: 100%;
    height: auto;
    border-radius: 10px;
    margin-bottom: 15px;
    transition: transform 0.3s ease; /* Smooth image zoom on hover */
}

.blog-card:hover img {
    transform: scale(1.05); /* Slight zoom on hover */
}

/* Blog card title styling */
.blog-card h3 {
    font-size: 1.5rem;
    color: #333;
    font-weight: bold;
    margin-bottom: 10px;
}

/* Blog card description */
.blog-card p {
    font-size: 1rem;
    color: #555;
    line-height: 1.6;
    margin-bottom: 15px;
}

/* Add subtle border and spacing for the content */
.blog-card .content {
    border-top: 1px solid #eee;
    padding-top: 15px;
}

/* Button or link at the bottom of the card */
.blog-card a {
    text-align: center;
    padding: 10px 15px;
    background-color: #007bff;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

.blog-card a:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

</style>
<body>

<!-- navbar start -->
 
<!-- navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.html">
    <img src="assets/images/logolayer.png" alt="Logo" class="img-fluid logo">
    <span class="logotext ms-2">Mudra Legal</span> <!-- Adds spacing next to the logo -->

    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="blog.php">Blog</a>
        </li>
       
        
      
          
      
    </div>
  </div>
</nav>
 <!-- navbar end -->
<h1>Latest Blog Posts</h1>

<div class="blog-container">
    <?php
    if ($result->num_rows > 0) {
        // Output each blog post as a card
        while($row = $result->fetch_assoc()) {
            // Limit the paragraph to 40 words
            $excerpt = implode(' ', array_slice(explode(' ', $row['paragraph']), 0, 40)) . '...';
    ?>
            <div class="blog-card">
                <img src="uploads/<?php echo $row['image']; ?>" alt="Blog Image">
                <h2><?php echo $row['title']; ?></h2>
                <p><?php echo $excerpt; ?></p>
                <a href="blog-details.php?id=<?php echo $row['id']; ?>" class="read-more">Read More</a>
            </div>
    <?php
        }
    } else {
        echo "<p>No blogs found</p>";
    }
    ?>
</div>

<!-- watsapp button start -->
 <!-- WhatsApp Button -->
 <a href="https://wa.link/ta23rp" class="whatsapp-button" target="_blank" title="Contact us on WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Call Button -->
<a href="tel:+91 99194 60444" class="call-button" title="Call us">
    <i class="fas fa-phone-alt"></i>
</a>

 <!-- watsapp button end -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
